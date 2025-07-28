<?php
include '../koneksi.php';
session_start();

if (!isset($_SESSION['admin'])) {
  header("Location: login.php"); 
  exit;
}

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    header("Location: jenis_sampah.php");
    exit;
}

$id = intval($_GET['id']);

// Ambil data sampah
$query = "SELECT * FROM sampah WHERE id = $id";
$result = mysqli_query($koneksi, $query);
$data = mysqli_fetch_assoc($result);

if (!$data) {
    echo "Data tidak ditemukan.";
    exit;
}

// Proses update jika form disubmit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $kategori_id = intval($_POST['kategori_id']);
    $jenis_sampah = mysqli_real_escape_string($koneksi, $_POST['jenis_sampah']);
    $harga_per_kg = intval($_POST['harga_per_kg']);

    $update = "
        UPDATE sampah
        SET kategori_id = '$kategori_id',
            jenis_sampah = '$jenis_sampah',
            harga_per_kg = '$harga_per_kg'
        WHERE id = $id
    ";

    if (mysqli_query($koneksi, $update)) {
        $_SESSION['success'] = "Data berhasil diperbarui!";
        header("Location: jenis_sampah.php");
        exit;
    } else {
        echo "Gagal mengubah data: " . mysqli_error($koneksi);
    }
}

// Ambil semua kategori untuk dropdown
$kategori_query = mysqli_query($koneksi, "SELECT * FROM kategori_sampah ORDER BY kategori ASC");
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Edit Jenis Sampah | GreenOvate</title>
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
            color: #fff;
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
            color: #fff;
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

        .form-container {
            background: #fff;
            padding: 20px;
            border-radius: 10px;
            max-width: 500px;
            margin: 0 auto;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.05);
        }

        .form-container h2 {
            margin-bottom: 20px;
            color: #166534;
        }

        label {
            display: block;
            margin-bottom: 5px;
            color: #1a1a1a;
        }

        input,
        select {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .button-group {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 10px;
        }

        .btn {
            padding: 10px 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            color: white;
            text-decoration: none;
            text-align: center;
        }

        .btn-back {
            background: grey;
        }

        .btn-submit {
            background: #166534;
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
        <div class="form-container">
            <h2>Edit Jenis Sampah</h2>
            <form method="POST">
                <label for="kategori_id">Kategori Sampah</label>
                <select name="kategori_id" id="kategori_id" required>
                    <option value="" disabled selected>Pilih Kategori</option>
                    <?php while ($kategori = mysqli_fetch_assoc($kategori_query)): ?>
                        <option value="<?= $kategori['id'] ?>" <?= ($kategori['id'] == $data['kategori_id']) ? 'selected' : '' ?>>
                            <?= htmlspecialchars($kategori['kategori']) ?>
                        </option>
                    <?php endwhile; ?>
                </select>

                <label for="jenis_sampah">Jenis Sampah</label>
                <input type="text" name="jenis_sampah" id="jenis_sampah" value="<?= htmlspecialchars($data['jenis_sampah']) ?>" required>

                <label for="harga_per_kg">Harga per Kg (Rp)</label>
                <input type="number" name="harga_per_kg" id="harga_per_kg" value="<?= $data['harga_per_kg'] ?>" required>

                <div class="button-group">
                    <a href="jenis_sampah.php" class="btn btn-back">Kembali</a>
                    <button type="submit" class="btn btn-submit">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </main>
</body>

</html>