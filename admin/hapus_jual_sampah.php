<?php
include '../koneksi.php';
session_start();

if (!isset($_SESSION['admin'])) {
  header("Location: login.php"); 
  exit;
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $query = "DELETE FROM penjualan_sampah WHERE id = '$id'";
    $result = mysqli_query($koneksi, $query);

    if ($result) {
        header("Location: jual_sampah.php?status=sukses_hapus");
        exit();
    } else {
        echo "Gagal menghapus data: " . mysqli_error($koneksi);
    }
} else {
    echo "ID tidak ditemukan.";
}
?>