<?php
include 'koneksi.php'; // Panggil koneksi.php BUKAN bikin ulang koneksi

$id_user = 1; // Hardcode, atau ambil dari session
$id_jenis = $_POST['id_jenis'];
$jumlah = $_POST['jumlah'];
$total_harga = $_POST['total_harga'];
$tanggal = date("Y-m-d");

$sql = "INSERT INTO setoran (id_user, id_jenis, jumlah, total_harga, tanggal) 
VALUES ('$id_user', '$id_jenis', '$jumlah', '$total_harga', '$tanggal')";

if ($koneksi->query($sql) === TRUE) {
  echo "Setoran berhasil disimpan!";
} else {
  echo "Gagal simpan: " . $koneksi->error;
}

$koneksi->close();
?>


<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <title>Setor Sampah</title>
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600&display=swap" rel="stylesheet">
  <style>
    body {
      font-family: 'Montserrat', sans-serif;
      background-color: #f0fdf4;
      padding: 40px 20px;
      color: #166534;
      margin: 0;
    }

    .form {
      max-width: 500px;
      margin: auto;
      background: white;
      padding: 30px 25px;
      border-radius: 15px;
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
      box-sizing: border-box;
    }

    h2 {
      color: #166534;
      text-align: center;
      margin-bottom: 30px;
    }

    .form-group {
      margin-bottom: 20px;
    }

    label {
      font-weight: 600;
      display: block;
      margin-bottom: 8px;
    }

    select,
    input[type="number"] {
      width: 100%;
      padding: 12px;
      border-radius: 10px;
      border: 1px solid #ccc;
      font-size: 16px;
      background-color: #e6f9e5;
      color: #166534;
      box-sizing: border-box;
    }

    input:focus,
    select:focus {
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
      background-color: #28a745;
      color: white;
      border: none;
      margin-top: 10px;
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
  <div class="form">
    <h2>Form Setor Sampah</h2>

    <div class="form-group">
      <label for="jenis">Jenis Sampah</label>
      <select id="jenis">
        <option value="plastik">Plastik (Rp 1.000/kg)</option>
        <option value="kertas">Kertas (Rp 500/kg)</option>
        <option value="logam">Logam (Rp 2.000/kg)</option>
      </select>
    </div>

    <div class="form-group">
      <label for="berat">Berat (kg)</label>
      <input type="number" id="berat" min="0.1" step="0.1" placeholder="Masukkan berat dalam kg">
    </div>

    <button onclick="submitSetor()">Setor Sekarang</button>
    <a href="dashboard.html" class="back-link">← Kembali ke Dashboard</a>
  </div>

  <script>
    const harga = {
      plastik: 1000,
      kertas: 500,
      logam: 2000
    };

    function submitSetor() {
      const jenis = document.getElementById("jenis").value;
      const berat = parseFloat(document.getElementById("berat").value);
      if (!berat || berat <= 0) {
        alert("Masukkan berat sampah yang valid.");
        return;
      }

      const total = harga[jenis] * berat;
      let saldoSebelumnya = parseInt(localStorage.getItem("saldo")) || 0;
      localStorage.setItem("saldo", saldoSebelumnya + total);
      alert(`Sukses! Kamu dapat Rp ${total}`);
      window.location.href = "dashboard.html";
    }
  </script>
</body>

</html>