-- ============================================================================
-- Destinasi-AHP — Sistem Pendukung Keputusan Pemilihan Wisata Kota Medan
-- Database: InnoDB, UTF-8, Foreign Key Constraints
-- ============================================================================

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET FOREIGN_KEY_CHECKS = 0;
START TRANSACTION;
SET time_zone = "+07:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

-- -------------------------------------------------------------------
-- Tabel: users
-- -------------------------------------------------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `username` VARCHAR(50) NOT NULL,
  `password` VARCHAR(255) NOT NULL,
  `email` VARCHAR(100) DEFAULT NULL,
  `role` ENUM('admin','guest') NOT NULL DEFAULT 'guest',
  `created_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_username_unique` (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `users` (`id`, `username`, `password`, `email`, `role`, `created_at`) VALUES
(1, 'admin', '0192023a7bbd73250516f069df18b500', NULL, 'admin', '2024-12-15 07:37:01'),
(2, 'guest', '084e0343a0486ff05530df6c705c8bb4', NULL, 'guest', '2024-12-15 07:37:01');

-- -------------------------------------------------------------------
-- Tabel: kriteria
-- -------------------------------------------------------------------
DROP TABLE IF EXISTS `kriteria`;
CREATE TABLE `kriteria` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `nama` VARCHAR(20) NOT NULL,
  `created_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- -------------------------------------------------------------------
-- Tabel: alternatif
-- -------------------------------------------------------------------
DROP TABLE IF EXISTS `alternatif`;
CREATE TABLE `alternatif` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `nama` VARCHAR(50) NOT NULL,
  `created_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- -------------------------------------------------------------------
-- Tabel: ir (Index Random — data statis)
-- -------------------------------------------------------------------
DROP TABLE IF EXISTS `ir`;
CREATE TABLE `ir` (
  `jumlah` INT UNSIGNED NOT NULL,
  `nilai` DOUBLE(8,6) NOT NULL DEFAULT 0,
  PRIMARY KEY (`jumlah`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `ir` (`jumlah`, `nilai`) VALUES
(1, 0.000000), (2, 0.000000), (3, 0.580000), (4, 0.900000), (5, 1.120000),
(6, 1.240000), (7, 1.320000), (8, 1.410000), (9, 1.450000), (10, 1.490000),
(11, 1.510000), (12, 1.480000), (13, 1.560000), (14, 1.570000), (15, 1.590000);

-- -------------------------------------------------------------------
-- Tabel: perbandingan_kriteria
-- -------------------------------------------------------------------
DROP TABLE IF EXISTS `perbandingan_kriteria`;
CREATE TABLE `perbandingan_kriteria` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `kriteria1` INT UNSIGNED NOT NULL,
  `kriteria2` INT UNSIGNED NOT NULL,
  `nilai` DOUBLE(10,6) NOT NULL DEFAULT 1,
  `created_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `pk_kriteria1_idx` (`kriteria1`),
  KEY `pk_kriteria2_idx` (`kriteria2`),
  CONSTRAINT `fk_pk_kriteria1` FOREIGN KEY (`kriteria1`) REFERENCES `kriteria` (`id`) ON DELETE CASCADE,
  CONSTRAINT `fk_pk_kriteria2` FOREIGN KEY (`kriteria2`) REFERENCES `kriteria` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- -------------------------------------------------------------------
-- Tabel: perbandingan_alternatif
-- -------------------------------------------------------------------
DROP TABLE IF EXISTS `perbandingan_alternatif`;
CREATE TABLE `perbandingan_alternatif` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `alternatif1` INT UNSIGNED NOT NULL,
  `alternatif2` INT UNSIGNED NOT NULL,
  `pembanding` INT UNSIGNED NOT NULL,
  `nilai` DOUBLE(10,6) NOT NULL DEFAULT 1,
  `created_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `pa_alternatif1_idx` (`alternatif1`),
  KEY `pa_alternatif2_idx` (`alternatif2`),
  KEY `pa_pembanding_idx` (`pembanding`),
  CONSTRAINT `fk_pa_alternatif1` FOREIGN KEY (`alternatif1`) REFERENCES `alternatif` (`id`) ON DELETE CASCADE,
  CONSTRAINT `fk_pa_alternatif2` FOREIGN KEY (`alternatif2`) REFERENCES `alternatif` (`id`) ON DELETE CASCADE,
  CONSTRAINT `fk_pa_pembanding` FOREIGN KEY (`pembanding`) REFERENCES `kriteria` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- -------------------------------------------------------------------
-- Tabel: pv_kriteria
-- -------------------------------------------------------------------
DROP TABLE IF EXISTS `pv_kriteria`;
CREATE TABLE `pv_kriteria` (
  `id_kriteria` INT UNSIGNED NOT NULL,
  `nilai` DOUBLE(10,6) NOT NULL DEFAULT 0,
  `created_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_kriteria`),
  CONSTRAINT `fk_pvk_kriteria` FOREIGN KEY (`id_kriteria`) REFERENCES `kriteria` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- -------------------------------------------------------------------
-- Tabel: pv_alternatif
-- -------------------------------------------------------------------
DROP TABLE IF EXISTS `pv_alternatif`;
CREATE TABLE `pv_alternatif` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `id_alternatif` INT UNSIGNED NOT NULL,
  `id_kriteria` INT UNSIGNED NOT NULL,
  `nilai` DOUBLE(10,6) NOT NULL DEFAULT 0,
  `created_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `pva_unique` (`id_alternatif`, `id_kriteria`),
  KEY `pva_kriteria_idx` (`id_kriteria`),
  CONSTRAINT `fk_pva_alternatif` FOREIGN KEY (`id_alternatif`) REFERENCES `alternatif` (`id`) ON DELETE CASCADE,
  CONSTRAINT `fk_pva_kriteria` FOREIGN KEY (`id_kriteria`) REFERENCES `kriteria` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- -------------------------------------------------------------------
-- Tabel: ranking
-- -------------------------------------------------------------------
DROP TABLE IF EXISTS `ranking`;
CREATE TABLE `ranking` (
  `id_alternatif` INT UNSIGNED NOT NULL,
  `nilai` DOUBLE(10,6) NOT NULL DEFAULT 0,
  `created_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_alternatif`),
  CONSTRAINT `fk_ranking_alternatif` FOREIGN KEY (`id_alternatif`) REFERENCES `alternatif` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

SET FOREIGN_KEY_CHECKS = 1;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
