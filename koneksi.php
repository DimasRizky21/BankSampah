<?php
$koneksi = mysqli_connect("localhost", "root", "", "banksampah");

if (!$koneksi) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

?>