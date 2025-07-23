<?php
$koneksi = mysqli_connect("localhost:3307", "root", "", "banksampah");
if (!$koneksi) {
    die("Koneksi database gagal: " . mysqli_connect_error());
}
?>
