<?php
include '../koneksi.php';
session_start();

if (!isset($_SESSION['admin'])) {
  header("Location: login.php"); 
  exit;
}

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    header("Location: beli_sampah.php");
    exit;
}

$id = intval($_GET['id']);

// Ambil data pembelian lama
$query = "SELECT * FROM pembelian_sampah WHERE id = $id";
$result = mysqli_query($koneksi, $query);
$data = mysqli_fetch_assoc($result);

if (!$data) {
    echo "Data tidak ditemukan";
    exit;
}

// Proses update jika form disubmit
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user_id = intval($_POST['user_id']);
    $jenis_sampah_id = intval($_POST['jenis_sampah']);
    $berat = floatval($_POST['berat']);

    // Ambil harga dan jenis dari tabel sampah
    $sampah_q = mysqli_query($koneksi, "SELECT jenis_sampah, harga_per_kg FROM sampah WHERE id = '$jenis_sampah_id'");
    $sampah = mysqli_fetch_assoc($sampah_q);
    $jenis_sampah = $sampah['jenis_sampah'];
    $harga_per_kg = $sampah['harga_per_kg'];

    $total_baru = $berat * $harga_per_kg;
    $selisih_total = $total_baru - $data['total'];

    // Update saldo user
    mysqli_query($koneksi, "UPDATE users SET saldo = saldo + $selisih_total WHERE id = $user_id");

    // Update pembelian_sampah
    $update = "UPDATE pembelian_sampah 
               SET user_id = '$user_id',
                   jenis_sampah = '$jenis_sampah',
                   berat = '$berat',
                   harga_per_kg = '$harga_per_kg',
                   total = '$total_baru'
               WHERE id = $id";
    mysqli_query($koneksi, $update);

    $_SESSION['success'] = "Data pembelian berhasil diperbarui!";
    header("Location: beli_sampah.php"); // Redirect ke halaman list (bisa juga balik ke edit kalau mau)
    exit;
}

// Ambil data user dan jenis sampah untuk dropdown
$user_query = mysqli_query($koneksi, "SELECT id, fullname FROM users ORDER BY fullname ASC");
$jenis_query = mysqli_query($koneksi, "SELECT id, jenis_sampah, harga_per_kg FROM sampah ORDER BY jenis_sampah ASC");
?>

<!DOCTYPE html>
<html lang="id">
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
        <label for="user_id">Nama Nasabah</label>
        <select name="user_id" id="user_id" required>
          <option value="" disabled selected>Pilih Nasabah</option>
          <?php while ($user = mysqli_fetch_assoc($user_query)): ?>
            <option value="<?= $user['id'] ?>" <?= ($user['id'] == $data['user_id']) ? 'selected' : '' ?>>
              <?= htmlspecialchars($user['fullname']) ?>
            </option>
          <?php endwhile; ?>
        </select>

        <label for="jenis_sampah">Jenis Sampah</label>
        <select name="jenis_sampah" id="jenis_sampah" required>
          <option value="" disabled selected>Pilih Jenis Sampah</option>
          <?php mysqli_data_seek($jenis_query, 0); while ($jenis = mysqli_fetch_assoc($jenis_query)): ?>
            <option value="<?= $jenis['id'] ?>" 
              data-harga="<?= $jenis['harga_per_kg'] ?>" 
              <?= ($jenis['jenis_sampah'] == $data['jenis_sampah']) ? 'selected' : '' ?>>
              <?= $jenis['jenis_sampah'] ?> - Rp <?= number_format($jenis['harga_per_kg'], 0, ',', '.') ?>/kg
            </option>
          <?php endwhile; ?>
        </select>

        <label for="berat">Berat (kg)</label>
        <input type="number" step="0.01" id="berat" name="berat" value="<?= $data['berat'] ?>" required>

        <label for="saldo_diterima">Saldo yang diterima (Rp)</label>
        <input type="text" id="saldo_diterima" name="saldo_diterima" disabled>

        <div class="button-group">
          <a href="beli_sampah.php" class="btn btn-back">Kembali</a>
          <button type="submit" class="btn btn-submit">Simpan Perubahan</button>
        </div>
      </form>
    </div>
  </main>

  <script>
  document.addEventListener('DOMContentLoaded', function() {
      const jenisSelect = document.getElementById('jenis_sampah');
      const beratInput = document.getElementById('berat');
      const saldoInput = document.getElementById('saldo_diterima');

      function hitungSaldo() {
          const selectedOption = jenisSelect.options[jenisSelect.selectedIndex];
          const hargaPerKg = parseFloat(selectedOption.getAttribute('data-harga'));
          const berat = parseFloat(beratInput.value);

          if (!isNaN(hargaPerKg) && !isNaN(berat)) {
              const total = hargaPerKg * berat;
              saldoInput.value = new Intl.NumberFormat('id-ID').format(total);
          } else {
              saldoInput.value = '';
          }
      }

      jenisSelect.addEventListener('change', hitungSaldo);
      beratInput.addEventListener('input', hitungSaldo);
      hitungSaldo(); // jalankan di awal
  });
  </script>
</body>
</html>
