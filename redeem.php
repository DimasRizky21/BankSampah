<?php
include 'koneksi.php';
session_start();

if (!isset($_SESSION['user_id'])) {
  header("Location: login.php");
  exit;
}

$id = $_SESSION['user_id'];
$result = mysqli_query($koneksi, "SELECT saldo FROM users WHERE id = '$id'");
$data = mysqli_fetch_assoc($result);
$saldo = $data['saldo'];
?>

<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Penarikan Saldo</title>
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600&display=swap" rel="stylesheet">
  <style>
    body {
      font-family: 'Montserrat', sans-serif;
      background-color: #f0fdf4;
      margin: 0;
      padding: 0;
      color: #166534;
    }

    header {
      background-color: #28a745;
      padding: 20px;
      text-align: center;
      color: white;
    }

    main {
      max-width: 500px;
      margin: 40px auto;
      background: white;
      padding: 30px 25px;
      border-radius: 15px;
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
      box-sizing: border-box;
    }

    .saldo-box {
      background-color: #e6f9e5;
      padding: 20px;
      border-radius: 10px;
      margin-bottom: 20px;
      text-align: center;
      font-size: 20px;
      font-weight: bold;
      color: #0d6e5c;
    }

    label {
      font-weight: bold;
      display: block;
      margin-top: 15px;
    }

    input {
      width: 100%;
      padding: 12px;
      border-radius: 10px;
      border: 1px solid #ccc;
      margin-top: 10px;
      font-size: 16px;
      background-color: #e6f9e5;
      color: #166534;
      box-sizing: border-box;
    }

    input:focus {
      border-color: #28a745;
      outline: none;
      box-shadow: 0 0 0 2px rgba(40, 167, 69, 0.2);
    }

    button {
      width: 100%;
      padding: 12px;
      border-radius: 10px;
      font-size: 16px;
      font-weight: bold;
      background-color: #ffc107;
      color: #333;
      border: none;
      margin-top: 20px;
      cursor: pointer;
      transition: all 0.3s ease;
      position: relative;
      overflow: hidden;
      z-index: 1;
    }

    button::before {
      content: '';
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background-color: rgba(255, 255, 255, 0.2);
      z-index: -1;
      transition: transform 0.3s ease;
      transform: scaleX(0);
      transform-origin: left;
    }

    button:hover::before {
      transform: scaleX(1);
    }

    button:hover {
      transform: translateY(-2px);
      box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15);
    }

    .back-link {
      display: block;
      text-align: center;
      margin-top: 20px;
      color: #166534;
      text-decoration: none;
      font-weight: 600;
    }

    .back-link:hover {
      text-decoration: underline;
    }
  </style>
</head>

<body>
  <header>
    <h1>Penarikan Saldo</h1>
  </header>

  <main>
    <div class="saldo-box">
      <span id="saldo">Rp <?= number_format($saldo, 0, ',', '.') ?></span>
    </div>

    <label for="nominal">Masukkan Nominal Penarikan (Rp)</label>
    <input type="number" id="nominal" placeholder="Contoh: 10000" min="1000" step="500" />

    <button onclick="ajukanPenarikan()">Ajukan Penarikan</button>
    <a href="dashboard.php" class="back-link">← Kembali ke Dashboard</a>
  </main>

  <script>
    function ajukanPenarikan() {
      const nominal = parseInt(document.getElementById("nominal").value);

      const saldoText = document.getElementById("saldo").innerText.replace("Rp", "").replace(/\./g, "");
      const saldo = parseInt(saldoText);

      if (nominal < 1000) {
        alert("Nominal harus lebih dari Rp 1000");
        return;
      }
      if (nominal > saldo) {
        alert("Saldo tidak mencukupi");
        return;
      }

      fetch("redeem_handler.php", {
        method: "POST",
        headers: {
          "Content-Type": "application/x-www-form-urlencoded"
        },
        body: `nominal=${nominal}`
      })
      .then(res => res.text())
      .then(alert)
      .then(() => location.href = "dashboard.php");
    }
  </script>

</body>

</html>