<?php

$host = "";
$user = "root"; 
$pass = "";
$db   = "banksampah";

$koneksi = mysqli_connect("localhost:3307", $user, $pass, $db);

if(!$koneksi) {
    die("Gagal terkoneksi");
}
?>