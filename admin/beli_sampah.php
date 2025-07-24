<?php
include '../koneksi.php';
session_start();

if (!isset($_SESSION['admin'])) {
  header("Location: login.php"); 
  exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Daftar Pembelian Sampah | GreenOvate</title>
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600&display=swap" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <style>
    * { box-sizing: border-box; margin: 0; padding: 0; }
    body { font-family: 'Montserrat', sans-serif; background-color: #f5fafd; color: #1a1a1a; display: flex; }
    .sidebar {
      width: 220px; background-color: #166534; padding: 20px; box-shadow: 2px 0 10px rgba(0,0,0,0.05); height: 100vh; color: #ffffff;
    }
    .sidebar h2 { font-size: 22px; margin-bottom: 20px; }
    .sidebar nav a {
      display: block; padding: 12px; margin-bottom: 10px; text-decoration: none; color: #ffffff;
      border-radius: 8px; transition: 0.3s; cursor: pointer;
    }
    .sidebar nav a:hover { background-color: #1b7c4d; }
    .main { flex: 1; padding: 30px; background-color: #f0fdf4; }
    h2 { margin-bottom: 20px; color: #166534; }
    a.btn-tambah {
      display: inline-block; padding: 10px 15px; background: #166534; color: white; text-decoration: none;
      border-radius: 5px; margin-bottom: 15px;
    }
    table { width: 100%; border-collapse: collapse; margin-top: 10px; background: #fff; }
    th, td { padding: 10px; border: 1px solid #ccc; text-align: center; }
    thead { background-color: #c6f6d5; }
    .btn-edit, .btn-hapus {
      padding: 5px 8px; color: white; text-decoration: none; border-radius: 5px; font-size: 14px;
    }
    .btn-edit { background: #1b7c4d; margin-right: 5px; }
    .btn-hapus { background: red; }
  </style>
</head>
<body>
  <aside class="sidebar">
    <h2>GreenOvate</h2>
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
    <h2>Daftar Pembelian Sampah</h2>
    <a href="tambah_beli_sampah.php" class="btn-tambah">+ Tambah</a>

    <table>
      <thead>
        <tr>
          <th>No</th>
          <th>Nama Nasabah</th>
          <th>Jenis Sampah</th>
          <th>Berat (kg)</th>
          <th>Harga per Kg (Rp)</th>
          <th>Total (Rp)</th>
          <th>Tanggal</th>
          <th>Aksi</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $no = 1;

        // Pakai JOIN ambil nama user
        $query = "
          SELECT ps.*, u.fullname 
          FROM pembelian_sampah ps
          JOIN users u ON ps.user_id = u.id
          ORDER BY ps.tanggal DESC
        ";
        $result = mysqli_query($koneksi, $query);

        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>
              <td>{$no}</td>
              <td>{$row['fullname']}</td>
              <td>{$row['jenis_sampah']}</td>
              <td>{$row['berat']}</td>
              <td>" . number_format($row['harga_per_kg'], 0, ',', '.') . "</td>
              <td>" . number_format($row['total'], 0, ',', '.') . "</td>
              <td>{$row['tanggal']}</td>
              <td>
                <a href='edit_beli_sampah.php?id={$row['id']}' class='btn-edit' title='Edit'><i class='fas fa-pen'></i></a>
                <a href='hapus_beli_sampah.php?id={$row['id']}' class='btn-hapus' title='Hapus' onclick=\"return confirm('Yakin ingin menghapus data ini?');\"><i class='fas fa-trash'></i></a>
              </td>
            </tr>";
            $no++;
        }
        ?>
      </tbody>
    </table>
  </main>
</body>
</html>
