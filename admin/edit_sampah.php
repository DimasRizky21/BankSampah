<?php
include '../koneksi.php';

if (!isset($_GET['id'])) {
    echo "ID tidak ditemukan.";
    exit;
}

$id = $_GET['id'];

// Ambil data sampah untuk form edit
$query = "
    SELECT * FROM sampah
    WHERE id = '$id'
";
$result = mysqli_query($koneksi, $query);
$data = mysqli_fetch_assoc($result);

if (!$data) {
    echo "Data tidak ditemukan.";
    exit;
}

// Jika form disubmit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $kategori_id = $_POST['kategori_id'];
    $jenis_sampah = $_POST['jenis_sampah'];
    $harga_per_kg = $_POST['harga_per_kg'];

    $update = "
        UPDATE sampah
        SET kategori_id = '$kategori_id', jenis_sampah = '$jenis_sampah', harga_per_kg = '$harga_per_kg'
        WHERE id = '$id'
    ";
    $result = mysqli_query($koneksi, $update);

    if ($result) {
        header("Location: jenis_sampah.php?status=sukses_edit");
        exit();
    } else {
        echo "Gagal mengubah data: " . mysqli_error($koneksi);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Edit Sampah - GreenOvate</title>
<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600&display=swap" rel="stylesheet">
<style>
    body { font-family: 'Montserrat', sans-serif; background-color: #f5fafd; padding: 20px; }
    h1 { margin-bottom: 20px; }
    form { background: #fff; padding: 20px; border-radius: 10px; max-width: 500px; margin: auto; }
    label { display: block; margin-top: 10px; }
    input, select { width: 100%; padding: 8px; margin-top: 5px; border-radius: 5px; border: 1px solid #ccc; }
    button { margin-top: 15px; padding: 10px 15px; background-color: #166534; color: white; border: none; border-radius: 5px; cursor: pointer; }
    button:hover { background-color: #1b7c4d; }
</style>
</head>
<body>

<h1>Edit Data Sampah</h1>

<form method="POST">
    <label for="kategori_id">Kategori Sampah</label>
    <select name="kategori_id" id="kategori_id" required>
        <?php
        $kategori_query = mysqli_query($koneksi, "SELECT * FROM kategori_sampah");
        while ($kategori = mysqli_fetch_assoc($kategori_query)) {
            $selected = ($kategori['id'] == $data['kategori_id']) ? 'selected' : '';
            echo "<option value='{$kategori['id']}' $selected>{$kategori['kategori']}</option>";
        }
        ?>
    </select>

    <label for="jenis_sampah">Jenis Sampah</label>
    <input type="text" name="jenis_sampah" id="jenis_sampah" value="<?php echo $data['jenis_sampah']; ?>" required>

    <label for="harga_per_kg">Harga per Kg (Rp)</label>
    <input type="number" name="harga_per_kg" id="harga_per_kg" value="<?php echo $data['harga_per_kg']; ?>" required>

    <div style="display: flex; justify-content: space-between;">
      <button type="button" style="padding: 10px 15px; background: grey; color: white; border: none; border-radius: 5px;" onclick="window.location.href='jenis_sampah.php'">
          Kembali
      </button>
  
      <button type="submit" style="padding: 10px 15px; background: #166534; color: white; border: none; border-radius: 5px;">
          Simpan Perubahan
      </button>
    </div>

</form>

</body>
</html>
