<?php
include '../koneksi.php';
session_start();

// Validasi jika parameter id tidak ada
if (!isset($_GET['id'])) {
    echo "ID Nasabah tidak ditemukan.";
    exit;
}

$user_id = $_GET['id'];

// Ambil data user
$user_query = mysqli_query($koneksi, "SELECT fullname FROM users WHERE id = $user_id");
$user = mysqli_fetch_assoc($user_query);

// Ambil riwayat pembelian sampah
$pembelian_query = mysqli_query($koneksi, "
    SELECT jenis_sampah, berat, harga_per_kg, total, tanggal
    FROM pembelian_sampah
    WHERE user_id = $user_id
    ORDER BY tanggal DESC
");

// Ambil riwayat penarikan saldo
$redeem_query = mysqli_query($koneksi, "
    SELECT nominal, tanggal_permintaan, status
    FROM redeem_request
    WHERE user_id = $user_id
    ORDER BY tanggal_permintaan DESC
");
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Riwayat Nasabah - <?= htmlspecialchars($user['fullname']) ?></title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 30px;
        }
        h2, h3 {
            margin-top: 40px;
        }
        table {
            border-collapse: collapse;
            width: 100%;
            margin-top: 15px;
            margin-bottom: 40px;
        }
        th, td {
            border: 1px solid #ccc;
            padding: 10px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        a {
            display: inline-block;
            margin-top: 20px;
            text-decoration: none;
            color: #007BFF;
        }
        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <h2>Riwayat Nasabah: <?= htmlspecialchars($user['fullname']) ?></h2>

    <!-- Riwayat Pembelian Sampah -->
    <h3>Riwayat Pembelian Sampah</h3>
    <table>
        <thead>
            <tr>
                <th>Jenis Sampah</th>
                <th>Berat (Kg)</th>
                <th>Harga per Kg</th>
                <th>Total</th>
                <th>Tanggal</th>
            </tr>
        </thead>
        <tbody>
            <?php if (mysqli_num_rows($pembelian_query) > 0): ?>
                <?php while ($row = mysqli_fetch_assoc($pembelian_query)): ?>
                <tr>
                    <td><?= htmlspecialchars($row['jenis_sampah']) ?></td>
                    <td><?= $row['berat'] ?></td>
                    <td><?= number_format($row['harga_per_kg'], 0, ',', '.') ?></td>
                    <td><?= number_format($row['total'], 0, ',', '.') ?></td>
                    <td><?= $row['tanggal'] ?></td>
                </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr><td colspan="5">Belum ada data pembelian sampah.</td></tr>
            <?php endif; ?>
        </tbody>
    </table>

    <!-- Riwayat Penarikan Saldo -->
    <h3>Riwayat Penarikan Saldo</h3>
    <table>
        <thead>
            <tr>
                <th>Nominal</th>
                <th>Tanggal Permintaan</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            <?php if (mysqli_num_rows($redeem_query) > 0): ?>
                <?php while ($row = mysqli_fetch_assoc($redeem_query)): ?>
                <tr>
                    <td><?= number_format($row['nominal'], 0, ',', '.') ?></td>
                    <td><?= $row['tanggal_permintaan'] ?></td>
                    <td><?= htmlspecialchars($row['status']) ?></td>
                </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr><td colspan="3">Belum ada data penarikan saldo.</td></tr>
            <?php endif; ?>
        </tbody>
    </table>

    <a href="daftar_nasabah.php">← Kembali ke Daftar Nasabah</a>
</body>
</html>
