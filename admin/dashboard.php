<?php
include '../koneksi.php';
session_start();

// Ambil total user
$result_user = mysqli_query($koneksi, "SELECT COUNT(*) AS total_user FROM users");
$total_user = mysqli_fetch_assoc($result_user)['total_user'];

// Ambil total setoran
$result_setor = mysqli_query($koneksi, "SELECT SUM(total) AS total_setor FROM pembelian_sampah");
$total_setor = mysqli_fetch_assoc($result_setor)['total_setor'] ?? 0;

// Ambil total redeem
$result_redeem = mysqli_query($koneksi, "SELECT SUM(nominal) AS total_redeem FROM redeem_request WHERE status = 'Diterima'");
$total_redeem = mysqli_fetch_assoc($result_redeem)['total_redeem'] ?? 0;
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>GreenOvate Admin Dashboard</title>
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600&display=swap" rel="stylesheet" />
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
    <!-- Dashboard Page -->
    <div id="dashboard" class="page">
      <div class="header">
        <h1>Overview</h1>
      </div>

      <div class="cards">
        <div class="card">
          <h3>Total Nasabah</h3>
          <p><?= $total_user ?></p>
        </div>
        <div class="card">
          <h3>Total Setoran (Rp)</h3>
          <p><?= number_format($total_setor, 0, ',', '.') ?></p>
        </div>
        <div class="card">
          <h3>Total Redeem (Rp)</h3>
          <p><?= number_format($total_redeem, 0, ',', '.') ?></p>
        </div>
      </div>
    </div>
  </main>
</body>

</html>
