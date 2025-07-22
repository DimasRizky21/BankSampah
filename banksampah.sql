-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               8.0.16 - MySQL Community Server - GPL
-- Server OS:                    Win64
-- HeidiSQL Version:             11.2.0.6213
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

-- Dumping data for table banksampah.admins: ~1 rows (approximately)
/*!40000 ALTER TABLE `admins` DISABLE KEYS */;
INSERT IGNORE INTO `admins` (`id`, `username`, `password`) VALUES
	(1, 'admin', '$2y$10$E4iMD8J9KkqEBfXwhIDifugvbxh/Z/O5JtK7Bd8jkvyP5ckXLdzJe');
/*!40000 ALTER TABLE `admins` ENABLE KEYS */;

-- Dumping data for table banksampah.kategori_sampah: ~3 rows (approximately)
/*!40000 ALTER TABLE `kategori_sampah` DISABLE KEYS */;
INSERT IGNORE INTO `kategori_sampah` (`id`, `kategori`) VALUES
	(1, 'Plastik'),
	(2, 'Kardus'),
	(3, 'Besi');
/*!40000 ALTER TABLE `kategori_sampah` ENABLE KEYS */;

-- Dumping data for table banksampah.pembelian_sampah: ~1 rows (approximately)
/*!40000 ALTER TABLE `pembelian_sampah` DISABLE KEYS */;
INSERT IGNORE INTO `pembelian_sampah` (`id`, `user_id`, `jenis_sampah`, `berat`, `harga_per_kg`, `total`, `tanggal`) VALUES
	(1, 1, 'Tong', 5.00, 10000, 50000, '2025-07-20');
/*!40000 ALTER TABLE `pembelian_sampah` ENABLE KEYS */;

-- Dumping data for table banksampah.sampah: ~2 rows (approximately)
/*!40000 ALTER TABLE `sampah` DISABLE KEYS */;
INSERT IGNORE INTO `sampah` (`id`, `kategori_id`, `jenis_sampah`, `harga_per_kg`) VALUES
	(1, 1, 'Galon', 1235.00),
	(3, 3, 'Tong', 10000.00);
/*!40000 ALTER TABLE `sampah` ENABLE KEYS */;

-- Dumping data for table banksampah.users: ~2 rows (approximately)
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT IGNORE INTO `users` (`id`, `fullname`, `username`, `email`, `nim`, `password`, `created_at`, `saldo`) VALUES
	(1, 'Ipul Ojek', 'ipul', 'ipul2801@gmail.com', 'C53224u2u42', '$2y$10$iKKtYfavgBN27bB3X78jG.ZDgnNOre0jQazJKmWyqpnInzunRRJtq', '2025-07-20 10:25:00', 50000),
	(2, 'yantobelumsunat', 'yantobelumsunat', 'yantobelumsunat29@gmail.com', '2385820520', '$2y$10$hqXIuiKcaBD3YKzpvyskLu2T7ceFTvTzvGWdFiXf54nlJtxdUId1a', '2025-07-20 14:30:57', 0);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
