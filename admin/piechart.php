<?php
include '../koneksi.php';
session_start();

if (!isset($_SESSION['admin'])) {
  header("Location: login.php"); 
  exit;
}

$query = "SELECT jenis_sampah, SUM(berat) as total_berat FROM pembelian_sampah GROUP BY jenis_sampah";
$result = mysqli_query($koneksi, $query);

$labels = [];
$data = [];

while ($row = mysqli_fetch_assoc($result)) {
    $labels[] = $row['jenis_sampah'];
    $data[] = (float)$row['total_berat'];
}
?>
