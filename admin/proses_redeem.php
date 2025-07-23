<?php
include '../koneksi.php';
session_start();


if (isset($_POST['terima']) && isset($_POST['id'])) {
    $id = intval($_POST['id']);

    // Ambil data user_id dan nominal permintaan
    $result = mysqli_query($koneksi, "SELECT user_id, nominal FROM redeem_request WHERE id = '$id'");
    $row = mysqli_fetch_assoc($result);

    if ($row) {
        $user_id = $row['user_id'];
        $nominal = $row['nominal'];

        // Cek saldo user
        $userResult = mysqli_query($koneksi, "SELECT saldo FROM users WHERE id = '$user_id'");
        $userData = mysqli_fetch_assoc($userResult);

        if ($userData && $userData['saldo'] >= $nominal) {
            // Update status menjadi Diterima
            $updateStatus = mysqli_query($koneksi, "UPDATE redeem_request SET status = 'Diterima' WHERE id = '$id'");

            // Kurangi saldo user
            $kurangiSaldo = mysqli_query($koneksi, "UPDATE users SET saldo = saldo - '$nominal' WHERE id = '$user_id'");

            if ($updateStatus && $kurangiSaldo) {
                header("Location: redeem.php?msg=sukses");
                exit;
            } else {
                header("Location: redeem.php?msg=gagal_update");
                exit;
            }
        } else {
            header("Location: redeem.php?msg=saldo_tidak_cukup");
            exit;
        }
    } else {
        header("Location: redeem.php?msg=redeem_tidak_ditemukan");
        exit;
    }
} else {
    header("Location: redeem.php?msg=akses_tidak_valid");
    exit;
}
?>
