/*
SQLyog Ultimate v11.11 (64 bit)
MySQL - 8.0.30 : Database - databasekamera
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`databasekamera` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;

USE `databasekamera`;

/*Table structure for table `admins` */

DROP TABLE IF EXISTS `admins`;

CREATE TABLE `admins` (
  `id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(64) DEFAULT NULL,
  `password` varchar(256) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

/*Table structure for table `anggota` */

DROP TABLE IF EXISTS `anggota`;

CREATE TABLE `anggota` (
  `anggota_id` int NOT NULL AUTO_INCREMENT,
  `nama` varchar(100) DEFAULT NULL,
  `alamat` varchar(200) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `telepon` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`anggota_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

/*Table structure for table `kamera` */

DROP TABLE IF EXISTS `kamera`;

CREATE TABLE `kamera` (
  `kamera_id` int NOT NULL AUTO_INCREMENT,
  `nama` varchar(100) DEFAULT NULL,
  `merk` varchar(100) DEFAULT NULL,
  `tahun_rilis` int DEFAULT NULL,
  `kategori_id` int DEFAULT NULL,
  `harga_sewa` decimal(10,0) DEFAULT NULL,
  `gambar_kamera` blob,
  PRIMARY KEY (`kamera_id`),
  KEY `kategori_id` (`kategori_id`),
  CONSTRAINT `kamera_ibfk_1` FOREIGN KEY (`kategori_id`) REFERENCES `kategori` (`kategori_id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

/*Table structure for table `katalog` */

DROP TABLE IF EXISTS `katalog`;

CREATE TABLE `katalog` (
  `katalog_id` int NOT NULL AUTO_INCREMENT,
  `kamera_id` int DEFAULT NULL,
  `kategori_id` int DEFAULT NULL,
  PRIMARY KEY (`katalog_id`),
  KEY `kamera_id` (`kamera_id`),
  KEY `kategori_id` (`kategori_id`),
  CONSTRAINT `katalog_ibfk_1` FOREIGN KEY (`kamera_id`) REFERENCES `kamera` (`kamera_id`),
  CONSTRAINT `katalog_ibfk_2` FOREIGN KEY (`kategori_id`) REFERENCES `kategori` (`kategori_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

/*Table structure for table `kategori` */

DROP TABLE IF EXISTS `kategori`;

CREATE TABLE `kategori` (
  `kategori_id` int NOT NULL AUTO_INCREMENT,
  `nama_kategori` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`kategori_id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

/*Table structure for table `peminjaman` */

DROP TABLE IF EXISTS `peminjaman`;

CREATE TABLE `peminjaman` (
  `peminjaman_id` int NOT NULL AUTO_INCREMENT,
  `kamera_id` int DEFAULT NULL,
  `anggota_id` int DEFAULT NULL,
  `tanggal_peminjaman` date DEFAULT NULL,
  `tanggal_kembali` date DEFAULT NULL,
  `total_sewa` decimal(10,0) DEFAULT NULL,
  `durasi` int DEFAULT NULL,
  `keterangan` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT 'dipinjam',
  PRIMARY KEY (`peminjaman_id`),
  KEY `kamera_id` (`kamera_id`),
  KEY `anggota_id` (`anggota_id`),
  CONSTRAINT `peminjaman_ibfk_1` FOREIGN KEY (`kamera_id`) REFERENCES `kamera` (`kamera_id`),
  CONSTRAINT `peminjaman_ibfk_2` FOREIGN KEY (`anggota_id`) REFERENCES `anggota` (`anggota_id`)
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

/*Table structure for table `pengembalian` */

DROP TABLE IF EXISTS `pengembalian`;

CREATE TABLE `pengembalian` (
  `pengembalian_id` int NOT NULL AUTO_INCREMENT,
  `peminjaman_id` int DEFAULT NULL,
  `tanggal_pengembalian` date DEFAULT NULL,
  `denda` decimal(10,2) DEFAULT NULL,
  `terlambat` int DEFAULT NULL,
  `status_pengembalian` enum('terlambat','dikembalikan') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT 'dikembalikan',
  PRIMARY KEY (`pengembalian_id`),
  KEY `pengembalian_ibfk_1` (`peminjaman_id`),
  CONSTRAINT `pengembalian_ibfk_1` FOREIGN KEY (`peminjaman_id`) REFERENCES `peminjaman` (`peminjaman_id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

/*Table structure for table `staff` */

DROP TABLE IF EXISTS `staff`;

CREATE TABLE `staff` (
  `staff_id` int NOT NULL AUTO_INCREMENT,
  `nama` varchar(100) DEFAULT NULL,
  `jabatan` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `telepon` varchar(20) DEFAULT NULL,
  `admin_id` int DEFAULT NULL,
  PRIMARY KEY (`staff_id`),
  KEY `admin_id` (`admin_id`),
  CONSTRAINT `staff_ibfk_1` FOREIGN KEY (`admin_id`) REFERENCES `admins` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
