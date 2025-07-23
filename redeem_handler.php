<?php
include 'koneksi.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!isset($_SESSION['user_id'])) {
        echo "Anda belum login.";
        exit;
    }

    $user_id = $_SESSION['user_id'];
    $nominal = intval($_POST['nominal']);

    // Validasi saldo user
    $result = mysqli_query($koneksi, "SELECT saldo FROM users WHERE id = '$user_id'");
    $data = mysqli_fetch_assoc($result);
    $saldo = $data['saldo'];

    if ($nominal < 1000) {
        echo "Nominal minimal penarikan adalah Rp 1000.";
        exit;
    }

    if ($nominal > $saldo) {
        echo "Saldo tidak mencukupi.";
        exit;
    }

    // Insert permintaan ke tabel redeem_request
    $query = "INSERT INTO redeem_request (user_id, nominal, status, tanggal_permintaan)
              VALUES ('$user_id', '$nominal', 'Diproses', NOW())";

    if (mysqli_query($koneksi, $query)) {
        echo "Permintaan penarikan berhasil diajukan, menunggu persetujuan admin.";
    } else {
        echo "Gagal mengajukan penarikan: " . mysqli_error($koneksi);
    }
} else {
    echo "Metode tidak diizinkan.";
}
?>
