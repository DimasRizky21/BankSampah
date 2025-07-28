<?php
include '../koneksi.php';
session_start();

if (!isset($_SESSION['admin'])) {
  header("Location: login.php");
  exit;
}

$query = mysqli_query($koneksi, "
    SELECT 
        u.id,
        u.fullname,
        u.saldo,
        IFNULL(SUM(ps.berat), 0) AS total_sampah,
        COUNT(r.id) AS total_redeem
    FROM users u
    LEFT JOIN pembelian_sampah ps ON u.id = ps.user_id
    LEFT JOIN redeem_request r ON u.id = r.user_id
    GROUP BY u.id, u.fullname, u.saldo
");
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>GreenOvate Admin Dashboard</title>
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600&display=swap" rel="stylesheet" />
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
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
    .card h3 {
      margin-bottom: 10px;
    }
    .card p {
      font-size: 24px;
      font-weight: bold;
    }
    .chart-container {
      width: 100%;
      max-width: 500px; /* Batas lebar maksimum */
      height: 300px;     /* Tinggi tetap agar tidak terlalu besar */
      margin: 0 auto;    /* Tengah halaman */
    }
    table { width: 100%; border-collapse: collapse; margin-top: 10px; background: #fff; }
    th, td { padding: 10px; border: 1px solid #ccc; text-align: center; }
    thead { background-color: #c6f6d5; }
    canvas {
      width: 100% !important;
      height: auto !important;
    }
    <script>
      window.onload = function() {
        if (!navigator.onLine) return; // jika offline abaikan

        // Paksa reload untuk mengambil status session terbaru
        if (performance.navigation.type === 2) {
         location.reload(true);
        }
      };
    </script>
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
        <h2>Daftar Nasabah</h2>

        <table>
            <thead>
                <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Saldo (Rp)</th>
                <th>Total Sampah (Kg)</th>
                <th>Total Penarikan</th>
                <th>Detail</th>
                </tr>
            </thead>
            <tbody>
                <?php $no = 1; while ($row = mysqli_fetch_assoc($query)) : ?>
                <tr>
                    <td><?= $no++ ?></td>
                    <td><?= htmlspecialchars($row['fullname']) ?></td>
                    <td><?= number_format($row['saldo'], 0, ',', '.') ?></td>
                    <td><?= $row['total_sampah'] ?> Kg</td>
                    <td><?= $row['total_redeem'] ?> Penarikan</td>
                    <td>
                        <a class="riwayat-btn" href="riwayat_nasabah.php?id=<?= $row['id'] ?>">Lihat Riwayat</a>
                    </td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </main>

</body>
</html>
