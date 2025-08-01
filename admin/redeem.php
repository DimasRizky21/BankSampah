<?php
include '../koneksi.php';
session_start();

if (!isset($_SESSION['admin'])) {
  header("Location: login.php"); 
  exit;
}

// Ambil data dari redeem_request JOIN users
$query = mysqli_query($koneksi, "
    SELECT rr.id, rr.nominal, rr.tanggal_permintaan, rr.status, u.fullname 
    FROM redeem_request rr 
    JOIN users u ON rr.user_id = u.id
    ORDER BY rr.tanggal_permintaan DESC
");
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>GreenOvate Admin Dashboard</title>
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600&display=swap" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
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
      text-align: center;
    }

    /* Tombol Terima */
    button.accept-btn {
      background-color: #38a169;
      color: white;
      border: none;
      padding: 8px 14px;
      border-radius: 8px;
      cursor: pointer;
      font-weight: 600;
      font-size: 14px;
      transition: background-color 0.3s ease;
    }

    button.accept-btn:hover {
      background-color: #2f855a;
    }
  </style>
</head>

<body>
<aside class="sidebar">
    <h2>GreenOvate</h2>
    <nav>
      <a href="dashboard.php">Dashboard</a>
      <a href="jenis_sampah.php">Data Sampah</a>
      <a href="daftar_nasabah.php">Data Nasabah</a>
      <a href="beli_sampah.php">Beli Sampah</a>
      <a href="jual_sampah.php">Jual Sampah</a>
      <a href="redeem.php">Tarik Saldo</a>
      <a href="logout.php">Keluar</a>
    </nav>
  </aside>

  <main class="main">
    <div id="redeem" class="page">
      <h2>Data Redeem</h2>
      <table>
        <thead style="background-color: #fed7d7;">
          <tr>
            <th>Nama Nasabah</th>
            <th>Nominal (Rp)</th>
            <th>Tanggal</th>
            <th>Status</th>
            <th>Aksi</th>
          </tr>
        </thead>
        <tbody>
          <?php while ($row = mysqli_fetch_assoc($query)): ?>
            <tr>
              <td><?= htmlspecialchars($row['fullname']) ?></td>
              <td><?= number_format($row['nominal'], 0, ',', '.') ?></td>
              <td><?= date('Y-m-d H:i', strtotime($row['tanggal_permintaan'])) ?></td>
              <td><?= htmlspecialchars($row['status']) ?></td>
              <td>
                <?php if ($row['status'] == 'Diproses'): ?>
                  <form method="POST" action="proses_redeem.php" onsubmit="return confirm('Terima permintaan ini?')">
                    <input type="hidden" name="id" value="<?= htmlspecialchars($row['id']) ?>">
                    <button type="submit" name="terima" class="accept-btn">
                      <i class="fas fa-check"></i> Terima
                    </button>
                  </form>
                <?php else: ?>
                  -
                <?php endif; ?>
              </td>
            </tr>
          <?php endwhile; ?>
        </tbody>
      </table>
    </div>
  </main>
</body>

</html>
