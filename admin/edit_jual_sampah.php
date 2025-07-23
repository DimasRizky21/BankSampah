<?php
include '../koneksi.php';

// Ambil ID dari URL
$id = intval($_GET['id']);

// Ambil data penjualan berdasarkan ID
$query = mysqli_query($koneksi, "SELECT * FROM penjualan_sampah WHERE id = '$id'");
$data = mysqli_fetch_assoc($query);

// Ambil data jenis sampah untuk dropdown
$jenis_query = mysqli_query($koneksi, "SELECT id, jenis_sampah FROM sampah ORDER BY jenis_sampah ASC");

// Jika form disubmit
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama_mitra = mysqli_real_escape_string($koneksi, $_POST['nama_mitra']);
    $jenis_sampah_id = intval($_POST['jenis_sampah']);
    $berat = floatval($_POST['berat']);
    $harga_per_kg = intval($_POST['harga_per_kg']);
    $total = $berat * $harga_per_kg;
    $tanggal = date('Y-m-d');

    // Ambil nama jenis sampah
    $jenis_result = mysqli_query($koneksi, "SELECT jenis_sampah FROM sampah WHERE id = '$jenis_sampah_id'");
    $jenis_data = mysqli_fetch_assoc($jenis_result);
    $jenis_sampah = $jenis_data['jenis_sampah'];

    // Update ke database
    mysqli_query($koneksi, "UPDATE penjualan_sampah SET
        nama_mitra = '$nama_mitra',
        jenis_sampah = '$jenis_sampah',
        berat_kg = '$berat',
        harga_per_kg = '$harga_per_kg',
        total = '$total',
        tanggal = '$tanggal'
        WHERE id = '$id'
    ");

    header("Location: jual_sampah.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Edit Penjualan Sampah | GreenOvate</title>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600&display=swap" rel="stylesheet"/>
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body { font-family: 'Montserrat', sans-serif; background-color: #f5fafd; display: flex; }
        .sidebar { width: 220px; background-color: #166534; padding: 20px; height: 100vh; color: white; }
        .sidebar h2 { font-size: 22px; margin-bottom: 20px; }
        .sidebar nav a { display: block; padding: 12px; margin-bottom: 10px; color: white; text-decoration: none; border-radius: 8px; }
        .sidebar nav a:hover { background-color: #1b7c4d; }
        .main { flex: 1; padding: 30px; background-color: #f0fdf4; }
        .form-container { background: white; padding: 20px; border-radius: 10px; max-width: 500px; margin: auto; box-shadow: 0 4px 10px rgba(0,0,0,0.05); }
        .form-container h2 { margin-bottom: 20px; color: #166534; }
        label { display: block; margin-bottom: 5px; }
        input, select { width: 100%; padding: 10px; margin-bottom: 15px; border: 1px solid #ccc; border-radius: 5px; }
        input[readonly] { background-color: #f0f0f0; }
        .button-group { display: flex; justify-content: space-between; align-items: center; }
        .btn { padding: 10px 15px; border: none; border-radius: 5px; cursor: pointer; color: white; text-decoration: none; }
        .btn-back { background: grey; }
        .btn-submit { background: #166534; }
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
        <div class="form-container">
            <h2>Edit Penjualan Sampah</h2>
            <form method="POST">
                <label for="nama_mitra">Nama Mitra</label>
                <input type="text" name="nama_mitra" id="nama_mitra" required value="<?= htmlspecialchars($data['nama_mitra']) ?>">

                <label for="jenis_sampah">Jenis Sampah</label>
                <select id="jenis_sampah" name="jenis_sampah" required>
                    <option value="" disabled>Pilih Jenis</option>
                    <?php while ($jenis = mysqli_fetch_assoc($jenis_query)) : ?>
                        <option value="<?= $jenis['id'] ?>"
                        <?= ($jenis['jenis_sampah'] == $data['jenis_sampah']) ? 'selected' : '' ?>>
                            <?= htmlspecialchars($jenis['jenis_sampah']) ?>
                        </option>
                    <?php endwhile; ?>
                </select>

                <label for="berat">Berat (kg)</label>
                <input type="number" step="0.01" id="berat" name="berat" required value="<?= htmlspecialchars($data['berat_kg']) ?>">

                <label for="harga_per_kg">Harga per Kg (Rp)</label>
                <input type="number" id="harga_per_kg" name="harga_per_kg" required value="<?= htmlspecialchars($data['harga_per_kg']) ?>">

                <label for="total">Total (Rp)</label>
                <input type="number" id="total" name="total" readonly required value="<?= htmlspecialchars($data['total']) ?>">

                <div class="button-group">
                    <a href="jual_sampah.php" class="btn btn-back">Kembali</a>
                    <button type="submit" class="btn btn-submit">Update</button>
                </div>
            </form>
        </div>
    </main>

    <script>
        const berat = document.getElementById('berat');
        const hargaPerKg = document.getElementById('harga_per_kg');
        const total = document.getElementById('total');

        function hitungTotal() {
            const beratValue = parseFloat(berat.value) || 0;
            const hargaValue = parseInt(hargaPerKg.value) || 0;
            total.value = beratValue * hargaValue;
        }

        berat.addEventListener('input', hitungTotal);
        hargaPerKg.addEventListener('input', hitungTotal);
    </script>
</body>
</html>
