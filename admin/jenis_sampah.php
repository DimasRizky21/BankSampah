<?php
include '../koneksi.php';
session_start();

if (!isset($_SESSION['admin'])) {
  header("Location: login.php");
  exit;
}

$successMessage = '';
if (isset($_SESSION['success'])) {
  $successMessage = $_SESSION['success'];
  unset($_SESSION['success']);
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>GreenOvate Admin Dashboard</title>
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600&display=swap" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <!-- Bootstrap CSS & JS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  <style>
    * {
      box-sizing: border-box;
      margin: 0;
      padding: 0;
    }

    body {
      font-family: 'Montserrat', sans-serif;
      background-color: #f5fafd;
      color: #1a1a1a;
      display: flex;
    }

    .sidebar {
      width: 220px;
      background-color: #166534;
      padding: 20px;
      box-shadow: 2px 0 10px rgba(0, 0, 0, 0.05);
      height: 100vh;
      color: #ffffff;
    }

    .sidebar h2 {
      font-size: 22px;
      margin-bottom: 20px;
    }

    .sidebar nav a {
      display: block;
      padding: 12px;
      margin-bottom: 10px;
      text-decoration: none;
      color: #ffffff;
      border-radius: 8px;
      transition: 0.3s;
      cursor: pointer;
    }

    .sidebar nav a:hover {
      background-color: #1b7c4d;
    }

    .main {
      flex: 1;
      padding: 30px;
      background-color: #f0fdf4;
    }

    .header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 30px;
    }

    .cards {
      display: flex;
      gap: 20px;
      margin-bottom: 30px;
    }

    .card {
      background: linear-gradient(135deg, #c6f6d5, #9ae6b4);
      border-radius: 15px;
      padding: 20px;
      flex: 1;
      box-shadow: 0 4px 10px rgba(0, 0, 0, 0.05);
      text-align: center;
      color: #1c4532;
    }

    .chart,
    .transactions {
      background: #fff;
      padding: 20px;
      border-radius: 15px;
      box-shadow: 0 4px 10px rgba(0, 0, 0, 0.05);
      margin-bottom: 30px;
    }

    .transactions h3,
    .chart h3 {
      margin-bottom: 15px;
    }

    table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 10px;
    }

    th,
    td {
      padding: 10px;
      border: 1px solid #ccc;
    }
    tbody {
      text-align: center;
    }
  </style>
</head>

<body>
  <aside class="sidebar">
    <h2>Greenovate</h2>
    <nav>
    <a href="dashboard.php">Dashboard</a>
      <a href="jenis_sampah.php">Daftar Sampah</a>
      <a href="beli_sampah.php">Pembelian Sampah</a>
      <a href="jual_sampah.php">Penjualan Sampah</a>
      <a href="redeem.php">Redeem</a>
      <a href="logout.php">Logout</a>
    </nav>
  </aside>

  <main class="main">
    <!-- List Trash Page -->
    <div id="sampah" class="page">
      <h2>Daftar Sampah</h2>
      <a href="tambah_sampah.php" style="display:inline-block; padding:10px 15px; background:#166534; color:white; text-decoration:none; border-radius:5px; margin-bottom:15px;">+ Tambah</a>

      <table>
        <thead style="background-color: #fed7d7;">
          <tr>
            <th>No</th>
            <th>Kategori</th>
            <th>Jenis Sampah</th>
            <th>Harga per Kg (Rp)</th>
            <th>Aksi</th>
          </tr>
        </thead>

        <tbody>
          <?php
          $no = 1;
          $query = "
            SELECT sampah.id, kategori_sampah.kategori, sampah.jenis_sampah, sampah.harga_per_kg
            FROM sampah
            JOIN kategori_sampah ON sampah.kategori_id = kategori_sampah.id
          ";
          $result = mysqli_query($koneksi, $query);
          while ($row = mysqli_fetch_assoc($result)) {
              echo "<tr>
              <td>{$no}</td>
              <td>{$row['kategori']}</td>
              <td>{$row['jenis_sampah']}</td>
              <td>" . number_format($row['harga_per_kg'], 0, ',', '.') . "</td>
              <td>
                <a href='edit_sampah.php?id={$row['id']}' class='btn-edit' style='padding:5px 8px; background:#1b7c4d; color:white; text-decoration:none; border-radius:5px; margin-right:5px;' title='Edit'>
                  <i class='fas fa-pen'></i>
                </a>
                <a href='#' class='btn-hapus' 
                  style='padding:5px 8px; background:red; color:white; text-decoration:none; border-radius:5px;' 
                  data-bs-toggle='modal' 
                  data-bs-target='#modalHapus' 
                  data-id='{$row['id']}' 
                  title='Hapus'>
                  <i class='fas fa-trash'></i>
                </a>
              </td>
            </tr>
            ";
            $no++;
          }
          ?>
        </tbody>
      </table>
    </div>
  </main>

  <!-- Modal Konfirmasi Hapus -->
  <div class="modal fade" id="modalHapus" tabindex="-1" aria-labelledby="modalHapusLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="modalHapusLabel">Konfirmasi Hapus</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
        </div>
        <div class="modal-body">
          Apakah Anda yakin ingin menghapus data ini?
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
          <a href="#" class="btn btn-danger" id="btnKonfirmasiHapus">Ya, Hapus</a>
        </div>
      </div>
    </div>
  </div>

  <!-- Script konfirmasi hapus -->
  <script>
    const modalHapus = document.getElementById('modalHapus');
    modalHapus.addEventListener('show.bs.modal', function (event) {
      const button = event.relatedTarget;
      const id = button.getAttribute('data-id');
      const konfirmasiBtn = document.getElementById('btnKonfirmasiHapus');
      konfirmasiBtn.href = `hapus_sampah.php?id=${id}`;
    });
  </script>

  <!-- SweetAlert jika berhasil -->
  <?php if (!empty($successMessage)) : ?>
    <script>
      Swal.fire({
        icon: 'success',
        title: 'Berhasil!',
        text: '<?= $successMessage ?>',
        confirmButtonColor: '#166534'
      });
    </script>
  <?php endif; ?>

</body>
</html>
