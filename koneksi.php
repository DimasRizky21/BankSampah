<?php
$koneksi = mysqli_connect("localhost", "root", "root", "banksampah");
if (!$koneksi) {
    die("Koneksi database gagal: " . mysqli_connect_error());
}
?>
