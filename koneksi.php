<?php
include 'koneksi.php';

$nama     = $_POST['nama'];
$email    = $_POST['email'];
$password = password_hash($_POST['password'], PASSWORD_DEFAULT);

// Siapkan query dengan prepared statement (aman dari injection)
$stmt = mysqli_prepare($koneksi, "INSERT INTO users (nama, email, password) VALUES (?, ?, ?)");

if ($stmt) {
    mysqli_stmt_bind_param($stmt, "sss", $nama, $email, $password);
    mysqli_stmt_execute($stmt);

    echo "Data berhasil disimpan!";

    mysqli_stmt_close($stmt);
} else {
    echo "Gagal menyiapkan query: " . mysqli_error($koneksi);
}
