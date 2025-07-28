<?php
session_start();
$host = "localhost";
$user = "root";
$pass = "";
$db   = "banksampah";

// Koneksi ke database
$koneksi = mysqli_connect($host, $user, $pass, $db);
if (!$koneksi) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

// Ambil data dari form
$username = $_POST['username'];
$password = $_POST['password'];

// Cek user di database
$query = "SELECT * FROM admins WHERE username = ?";
$stmt = mysqli_prepare($koneksi, $query);
mysqli_stmt_bind_param($stmt, "s", $username);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

if ($row = mysqli_fetch_assoc($result)) {
    if (password_verify($password, $row['password'])) {
        // Login berhasil
        $_SESSION['admin'] = $row['username'];
        header("Location: dashboard.php");
        exit;
    }
}

// Gagal login
header("Location: login.php?error=1");
exit;
?>
