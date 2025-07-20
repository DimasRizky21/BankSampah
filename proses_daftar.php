<?php
include 'koneksi.php';

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $fullname = trim($_POST['fullname']);
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $nim = trim($_POST['nim']);
    $password = trim($_POST['password']);

    // Validasi input
    if (empty($fullname) || empty($username) || empty($email) || empty($nim) || empty($password)) {
        echo json_encode(['status' => 'error', 'message' => 'Harap isi semua kolom!']);
        exit;
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo json_encode(['status' => 'error', 'message' => 'Format email tidak valid!']);
        exit;
    }

    if (strlen($password) < 6) {
        echo json_encode(['status' => 'error', 'message' => 'Password minimal 6 karakter!']);
        exit;
    }

    // Cek duplikasi
    $check = mysqli_query($koneksi, "SELECT * FROM users WHERE username='$username' OR email='$email' OR nim='$nim'");
    if (mysqli_num_rows($check) > 0) {
        echo json_encode(['status' => 'error', 'message' => 'Username, Email, atau NIM sudah terdaftar!']);
        exit;
    }

    // Hash password
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Insert ke database
    $query = "INSERT INTO users (fullname, username, email, nim, password) VALUES ('$fullname', '$username', '$email', '$nim', '$hashed_password')";
    $insert = mysqli_query($koneksi, $query);

    if ($insert) {
        echo json_encode(['status' => 'success', 'message' => 'Pendaftaran berhasil! Silakan login.']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Pendaftaran gagal!']);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Metode tidak diizinkan']);
}
?>
