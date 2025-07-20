<?php
include '../koneksi.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $query = "DELETE FROM sampah WHERE id = '$id'";
    $result = mysqli_query($koneksi, $query);

    if ($result) {
        header("Location: jenis_sampah.php?status=sukses_hapus");
        exit();
    } else {
        echo "Gagal menghapus data: " . mysqli_error($koneksi);
    }
} else {
    echo "ID tidak ditemukan.";
}
?>
