<?php
session_start();
include 'koneksi.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$user_id = $_SESSION['user_id'];

// Ambil data user
$query = mysqli_query($koneksi, "SELECT username, saldo FROM users WHERE id = '$user_id' LIMIT 1");
$user = mysqli_fetch_assoc($query);
$username = htmlspecialchars($user['username']);
$saldo = number_format($user['saldo'], 0, ',', '.');

// Ambil data riwayat setor
$query_setor = mysqli_query($koneksi, "SELECT tanggal, jenis_sampah, berat, total FROM pembelian_sampah WHERE user_id = '$user_id' ORDER BY tanggal DESC");

// Ambil data riwayat redeem
$query_redeem = mysqli_query($koneksi, "SELECT tanggal_permintaan, nominal, status FROM redeem_request WHERE user_id = '$user_id' ORDER BY tanggal_permintaan DESC");
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Greenovate Unimus</title>
  <style>
    body { margin: 0; font-family: Montserrat, sans-serif; background-color: #f0fdf4; color: #166534; }
    .container { background-image: url('images/green.png'); background-size: cover; background-position: center; background-repeat: no-repeat; min-height: 100vh; display: flex; flex-direction: row; justify-content: space-between; align-items: flex-start; padding: 40px 5%; box-sizing: border-box; gap: 30px; }
    .text-content { max-width: 600px; width: 100%; }
    #username-display { background-color: #e6f9e5; padding: 10px 20px; border-radius: 12px; font-weight: bold; font-size: 18px; margin-bottom: 15px; display: inline-block; box-shadow: 0 2px 5px rgba(0,0,0,0.1); }
    h1 { font-size: 42px; margin-bottom: 10px; }
    .card { background-color: white; border-radius: 12px; padding: 20px; margin-top: 10px; box-shadow: 0 4px 8px rgba(0,0,0,0.1); }
    .card h3 { margin: 0 0 10px; font-size: 18px; }
    .card p { font-size: 28px; font-weight: bold; color: #0d6e5c; margin: 0; }
    .button { padding: 10px 20px; font-size: 16px; border: none; border-radius: 10px; cursor: pointer; transition: all 0.3s ease; position: relative; overflow: hidden; z-index: 1; }
    .button::before { content: ''; position: absolute; top: 0; left: 0; width: 100%; height: 100%; background-color: rgba(255,255,255,0.2); z-index: -1; transition: transform 0.3s ease; transform: scaleX(0); transform-origin: left; }
    .button:hover::before { transform: scaleX(1); }
    .button:hover { transform: translateY(-2px); box-shadow: 0 6px 12px rgba(0,0,0,0.15); }
    .setor { background-color: #28a745; color: white; }
    .redeem { background-color: #ffc107; color: #333; }
    .logout { background-color: #dc3545; color: white; }
    .logout-button { position: absolute; top: 20px; right: 40px; }
    .image-buttons-wrapper {
      position: relative;
      width: 500px;
      max-width: 90%;
      margin-top: 150px; /* ⬅️ Geser ke bawah */
    }
    .pict { width: 100%; }
    .button-group { margin-top: 20px; display: flex; gap: 20px; justify-content: center; }

    table { width: 100%; border-collapse: collapse; margin-top: 20px; background: white; box-shadow: 0 3px 6px rgba(0,0,0,0.1); border-radius: 8px; overflow: hidden; }
    th, td { padding: 10px 15px; text-align: left; border-bottom: 1px solid #ccc; }
    th { background-color: #d1fae5; }
    tr:hover { background-color: #f0fff4; }

    @media (max-width: 768px) {
      .container { flex-direction: column; padding: 20px; }
      .logout-button { top: 10px; right: 10px; }
      .button-group { flex-direction: column; align-items: center; }
    }
  </style>
</head>
<body>

<a href="logout.php" class="button logout logout-button">Logout</a>

<div class="container">
  <div class="text-content">
    <div id="username-display">👤 Halo, <?= $username ?></div>
    <h1>Greenovate</h1>

    <div class="card">
      <h3>Saldo Tabungan Sampah</h3>
      <p id="saldo">Rp <?= $saldo ?></p>
    </div>

    <div class="button-group">
      <button class="button redeem" onclick="window.location.href='redeem.php'">Tarik Saldo</button>
    </div>

    <div class="card">
      <h3>Riwayat Setor Sampah</h3>
      <table>
        <thead>
          <tr>
            <th>Tanggal</th>
            <th>Jenis Sampah</th>
            <th>Berat (kg)</th>
            <th>Total (Rp)</th>
          </tr>
        </thead>
        <tbody>
          <?php while ($row = mysqli_fetch_assoc($query_setor)): ?>
            <tr>
              <td><?= htmlspecialchars($row['tanggal']) ?></td>
              <td><?= htmlspecialchars($row['jenis_sampah']) ?></td>
              <td><?= htmlspecialchars($row['berat']) ?></td>
              <td>Rp <?= number_format($row['total'], 0, ',', '.') ?></td>
            </tr>
          <?php endwhile; ?>
        </tbody>
      </table>
    </div>

    <div class="card">
      <h3>Riwayat Redeem Hadiah</h3>
      <table>
        <thead>
          <tr>
            <th>Tanggal</th>
            <th>Nominal (Rp)</th>
            <th>Status</th>
          </tr>
        </thead>
        <tbody>
          <?php while ($row = mysqli_fetch_assoc($query_redeem)): ?>
            <tr>
              <td><?= htmlspecialchars($row['tanggal_permintaan']) ?></td>
              <td>Rp <?= number_format($row['nominal'], 0, ',', '.') ?></td>
              <td><?= htmlspecialchars(ucfirst($row['status'])) ?></td>
            </tr>
          <?php endwhile; ?>
        </tbody>
      </table>
    </div>
  </div>

  <div class="image-buttons-wrapper">
    <img src="images/pict.png" class="pict" alt="Ilustrasi">
  </div>
</div>
</body>
</html>