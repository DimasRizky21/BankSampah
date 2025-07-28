<?php
include '../koneksi.php';
session_start();

if (!isset($_SESSION['admin'])) {
  header("Location: login.php"); 
  exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $kategori_id = $_POST['kategori_id'];
    $jenis_sampah = $_POST['jenis_sampah'];
    $harga_per_kg = $_POST['harga_per_kg'];

    $query = "INSERT INTO sampah (kategori_id, jenis_sampah, harga_per_kg) VALUES ('$kategori_id', '$jenis_sampah', '$harga_per_kg')";
    $result = mysqli_query($koneksi, $query);

    if ($result) {
      $_SESSION['success'] = "Data berhasil ditambahkan!";
      header("Location: jenis_sampah.php");
      exit();
    } else {
        echo "Gagal menambahkan data: " . mysqli_error($koneksi);
    }
}
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
    }
    form { background: #fff; padding: 20px; border-radius: 10px; max-width: 500px; margin: auto; }
    label { display: block; margin-top: 10px; }
    input, select { width: 100%; padding: 8px; margin-top: 5px; border-radius: 5px; border: 1px solid #ccc; }
    button { margin-top: 15px; padding: 10px 15px; background-color: #166534; color: white; border: none; border-radius: 5px; cursor: pointer; }
    button:hover { background-color: #1b7c4d; }
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
        <!-- List Trash Page -->
        <div id="sampah" class="page">
            <h2>Tambah Sampah</h2>

            <form method="POST">
                <label for="kategori_id">Kategori Sampah</label>
                <select name="kategori_id" id="kategori_id" required>
                    <option value="">Pilih Kategori</option>
                    <?php
                    $kategori_query = mysqli_query($koneksi, "SELECT * FROM kategori_sampah");
                    while ($kategori = mysqli_fetch_assoc($kategori_query)) {
                        echo "<option value='{$kategori['id']}'>{$kategori['kategori']}</option>";
                    }
                    ?>
                </select>

                <label for="jenis_sampah">Jenis Sampah</label>
                <input type="text" name="jenis_sampah" id="jenis_sampah" required>

                <label for="harga_per_kg">Harga per Kg (Rp)</label>
                <input type="number" name="harga_per_kg" id="harga_per_kg" required>

                <button type="submit">Tambah</button>
            </form>
        </div>
    </main>
</body>
</html>
