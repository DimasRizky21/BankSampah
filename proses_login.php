<?php
session_start();
include 'koneksi.php';

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    if (empty($username) || empty($password)) {
        echo json_encode(['status' => 'error', 'message' => 'Harap isi semua kolom!']);
        exit;
    }

    $query = mysqli_query($koneksi, "SELECT * FROM users WHERE username='$username' LIMIT 1");
    if (mysqli_num_rows($query) == 0) {
        echo json_encode(['status' => 'error', 'message' => 'Username tidak ditemukan!']);
        exit;
    }

    $user = mysqli_fetch_assoc($query);

    if (password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];
        $_SESSION['fullname'] = $user['fullname'];
        $_SESSION['email'] = $user['email'];
        $_SESSION['nim'] = $user['nim'];

        echo json_encode(['status' => 'success', 'message' => 'Login berhasil!']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Password salah!']);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Metode tidak diizinkan!']);
}
?>
