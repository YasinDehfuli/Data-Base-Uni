-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               10.4.24-MariaDB - mariadb.org binary distribution
-- Server OS:                    Win64
-- HeidiSQL Version:             12.1.0.6537
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

-- Dumping structure for table uni.categories
DROP TABLE IF EXISTS `categories`;
CREATE TABLE IF NOT EXISTS `categories` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `body` text NOT NULL,
  `parent_id` bigint(20) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_categories_categories` (`parent_id`),
  CONSTRAINT `FK_categories_categories` FOREIGN KEY (`parent_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table uni.categories: ~7 rows (approximately)
INSERT INTO `categories` (`id`, `name`, `body`, `parent_id`) VALUES
	(1, 'غذای ایرانی', '', NULL),
	(2, 'غذای فرنگی', '', NULL),
	(3, 'غذای فرانسوی', '', 2),
	(4, 'غذای عرب', '', 2),
	(5, 'غذای جنوبی', '', 1),
	(6, 'غذای شمالی', '', 1),
	(7, 'غذای گیلانی', '', 6);

-- Dumping structure for table uni.foods
DROP TABLE IF EXISTS `foods`;
CREATE TABLE IF NOT EXISTS `foods` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL DEFAULT '',
  `student_id` bigint(20) unsigned DEFAULT NULL,
  `category_id` bigint(20) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_foods_students` (`student_id`),
  KEY `FK_foods_categories` (`category_id`),
  CONSTRAINT `FK_foods_categories` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_foods_students` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table uni.foods: ~3 rows (approximately)
INSERT INTO `foods` (`id`, `name`, `student_id`, `category_id`) VALUES
	(2, 'الویه', 1, 3),
	(5, 'پیتزا', 5, 2),
	(6, 'کباب', NULL, 1);

-- Dumping structure for table uni.students
DROP TABLE IF EXISTS `students`;
CREATE TABLE IF NOT EXISTS `students` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(60) NOT NULL,
  `email` varchar(120) DEFAULT NULL,
  `username` varchar(30) NOT NULL,
  `tel` varchar(15) NOT NULL,
  `address` text DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `tel` (`tel`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COMMENT='list of students';

-- Dumping data for table uni.students: ~5 rows (approximately)
INSERT INTO `students` (`id`, `name`, `email`, `username`, `tel`, `address`) VALUES
	(1, 'Yacin', NULL, 'yacin', '09121234567', NULL),
	(2, 'امیر', NULL, 'rimaro', '09127654321', 'کرج درب سفید'),
	(5, 'محیا', NULL, 'mahya', '09120983321', 'کرج درب نارنجی'),
	(6, 'سوگند', NULL, 'sogang', '', NULL),
	(7, 'name', ':email', ':username', ':tel', ':address'),
	(8, 'ممدرضا', 'pashe@gmail.com', 'pashe', '09125670889', 'کرج درب نارنجی'),
	(10, 'ممدرضا', 'pashe2@gmail.com', 'pashe2', '09125670881', 'کرج درب نارنجی'),
	(11, 'ممدرضا', 'pashe3@gmail.com', 'pashe3', '09125670884', 'کرج درب نارنجی'),
	(13, 'مهناز روشنی', 'will@mahi.ir', 'will', '09907896542.', 'کرج، درب بنفش');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
