<?php
include '../koneksi.php';

// Ambil ID dari URL
$id = $_GET['id'];

// Ambil data pembelian berdasarkan ID
$query = "SELECT * FROM pembelian_sampah WHERE id = $id";
$result = mysqli_query($koneksi, $query);
$data = mysqli_fetch_assoc($result);

// Proses update jika form disubmit
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama_nasabah = $_POST['nama_nasabah'];
    $jenis_sampah = $_POST['jenis_sampah'];
    $berat = $_POST['berat'];
    $harga_per_kg = $_POST['harga_per_kg'];
    $total = $berat * $harga_per_kg;

    $query_update = "UPDATE pembelian_sampah 
                     SET nama_nasabah='$nama_nasabah',
                         jenis_sampah='$jenis_sampah',
                         berat='$berat',
                         harga_per_kg='$harga_per_kg',
                         total='$total'
                     WHERE id=$id";
    mysqli_query($koneksi, $query_update);

    header("Location: beli_sampah.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Edit Pembelian Sampah | GreenOvate</title>
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600&display=swap" rel="stylesheet"/>
  <style>
    * { box-sizing: border-box; margin: 0; padding: 0; }
    body { font-family: 'Montserrat', sans-serif; background-color: #f5fafd; color: #1a1a1a; display: flex; }
    .sidebar {
      width: 220px; background-color: #166534; padding: 20px; box-shadow: 2px 0 10px rgba(0,0,0,0.05); height: 100vh; color: #fff;
    }
    .sidebar h2 { font-size: 22px; margin-bottom: 20px; }
    .sidebar nav a {
      display: block; padding: 12px; margin-bottom: 10px; text-decoration: none; color: #fff;
      border-radius: 8px; transition: 0.3s; cursor: pointer;
    }
    .sidebar nav a:hover { background-color: #1b7c4d; }
    .main { flex: 1; padding: 30px; background-color: #f0fdf4; }
    .form-container { background: #fff; padding: 20px; border-radius: 10px; max-width: 500px; margin: 0 auto; box-shadow: 0 4px 10px rgba(0,0,0,0.05); }
    .form-container h2 { margin-bottom: 20px; color: #166534; }
    label { display: block; margin-bottom: 5px; color: #1a1a1a; }
    input, select {
      width: 100%; padding: 10px; margin-bottom: 15px; border: 1px solid #ccc; border-radius: 5px;
    }
    .button-group {
      display: flex; justify-content: space-between; align-items: center; margin-top: 10px;
    }
    .btn {
      padding: 10px 15px; border: none; border-radius: 5px; cursor: pointer; color: white; text-decoration: none; text-align: center;
    }
    .btn-back { background: grey; }
    .btn-submit { background: #166534; }
  </style>
</head>
<body>
  <aside class="sidebar">
    <h2>GreenOvate</h2>
    <nav>
      <a href="dashboard.php">Dashboard</a>
      <a href="jenis/jenis_sampah.php">Daftar Sampah</a>
      <a href="beli_sampah.php">Pembelian Sampah</a>
      <a href="jual_sampah.php">Penjualan Sampah</a>
      <a href="redeem.php">Redeem</a>
      <a href="logout.php">Logout</a>
    </nav>
  </aside>

  <main class="main">
    <div class="form-container">
      <h2>Edit Pembelian Sampah</h2>
      <form method="POST">
        <label for="nama_nasabah">Nama Nasabah</label>
        <input type="text" id="nama_nasabah" name="nama_nasabah" value="<?= $data['nama_nasabah']; ?>" required>

        <label for="jenis_sampah">Jenis Sampah</label>
        <select id="jenis_sampah" name="jenis_sampah" required>
          <option value="Plastik" <?= ($data['jenis_sampah'] == 'Plastik') ? 'selected' : ''; ?>>Plastik</option>
          <option value="Kertas" <?= ($data['jenis_sampah'] == 'Kertas') ? 'selected' : ''; ?>>Kertas</option>
          <option value="Logam" <?= ($data['jenis_sampah'] == 'Logam') ? 'selected' : ''; ?>>Logam</option>
          <option value="Kardus" <?= ($data['jenis_sampah'] == 'Kardus') ? 'selected' : ''; ?>>Kardus</option>
          <option value="Kaca" <?= ($data['jenis_sampah'] == 'Kaca') ? 'selected' : ''; ?>>Kaca</option>
        </select>

        <label for="berat">Berat (kg)</label>
        <input type="number" step="0.01" id="berat" name="berat" value="<?= $data['berat']; ?>" required>

        <label for="harga_per_kg">Harga per Kg (Rp)</label>
        <input type="number" id="harga_per_kg" name="harga_per_kg" value="<?= $data['harga_per_kg']; ?>" required>

        <div class="button-group">
          <a href="beli_sampah.php" class="btn btn-back">Kembali</a>
          <button type="submit" class="btn btn-submit">Simpan Perubahan</button>
        </div>
      </form>
    </div>
  </main>
</body>
</html>
