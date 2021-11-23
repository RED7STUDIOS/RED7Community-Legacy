-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               8.0.26 - MySQL Community Server - GPL
-- Server OS:                    Win64
-- HeidiSQL Version:             11.3.0.6369
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dumping database structure for red7community
CREATE DATABASE IF NOT EXISTS `red7community` /*!40100 DEFAULT CHARACTER SET utf8 */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `red7community`;

-- Dumping structure for table red7community.admin_panel
CREATE TABLE IF NOT EXISTS `admin_panel` (
`id` int NOT NULL AUTO_INCREMENT,
`ownerid` int DEFAULT NULL,
`full_name` text,
PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb3;

-- Dumping data for table red7community.admin_panel: ~0 rows (approximately)
INSERT INTO `admin_panel` (`id`, `ownerid`, `full_name`) VALUES
(1, 1, 'RED7Community');

-- Dumping structure for table red7community.avatars
CREATE TABLE IF NOT EXISTS `avatars` (
`ownerid` bigint NOT NULL DEFAULT '0',
`items` longtext,
`shirt` int DEFAULT NULL,
`pants` int DEFAULT NULL,
`face` int DEFAULT NULL,
PRIMARY KEY (`ownerid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- Dumping data for table red7community.avatars: ~21 rows (approximately)
INSERT INTO `avatars` (`ownerid`, `items`, `shirt`, `pants`, `face`) VALUES
(1, '[1]', 9, 8, 5);

-- Dumping structure for table red7community.badges
CREATE TABLE IF NOT EXISTS `badges` (
`id` bigint NOT NULL DEFAULT '0',
`name` text NOT NULL,
`displayname` text,
`description` text,
`icon` text,
PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- Dumping data for table red7community.badges: ~4 rows (approximately)
INSERT INTO `badges` (`id`, `name`, `displayname`, `description`, `icon`) VALUES
(1, 'Administrator', 'Administrator', 'The official admin badge.', 'https://cdn.jsdelivr.net/gh/RED7Studios/RED7Community-CDN@main/Catalog/Badges/administrator.png'),
(2, 'Welcome', 'Welcome', 'The official welcome badge.', 'https://cdn.jsdelivr.net/gh/RED7Studios/RED7Community-CDN@main/Catalog/Badges/welcome.png'),
(3, 'Beta-Tester', 'Beta Tester', 'The official beta testing badge.', 'https://cdn.jsdelivr.net/gh/RED7Studios/RED7Community-CDN@main/Catalog/Badges/beta-tester.png'),
(4, 'Bug-Hunter', 'Bug Hunter', 'People with this badge are immune to being banned for finding bugs, however a warning or 3 day ban can still occur if a bug is not reported.', 'https://cdn.jsdelivr.net/gh/RED7Studios/RED7Community-CDN@main/Catalog/Badges/bug-hunter.png');

-- Dumping structure for table red7community.catalog
CREATE TABLE IF NOT EXISTS `catalog` (
`id` bigint NOT NULL DEFAULT '0',
`name` varchar(50) DEFAULT NULL,
`displayname` text,
`description` text,
`created` datetime DEFAULT NULL,
`membershipRequired` enum('None','Premium') DEFAULT NULL,
`owners` longtext,
`price` int DEFAULT NULL,
`type` enum('Back','Front','Face','Shirt','Pants','T-Shirt','Cosmetic','Hat','Face Accessory','Gear') DEFAULT NULL,
`isLimited` int DEFAULT '0',
`isEquippable` int DEFAULT '1',
`copies` int DEFAULT NULL,
`icon` text,
`obj` longtext,
`mtl` longtext,
`texture` longtext,
`creator` int DEFAULT '1',
PRIMARY KEY (`id`),
UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- Dumping data for table red7community.catalog: ~27 rows (approximately)
INSERT INTO `catalog` (`id`, `name`, `displayname`, `description`, `created`, `membershipRequired`, `owners`, `price`, `type`, `isLimited`, `isEquippable`, `copies`, `icon`, `obj`, `mtl`, `texture`, `creator`) VALUES
(-3, 'pants1', 'Testing Pants', 'This is test pants.', '2021-04-24 22:34:44', 'None', '[1]', -1, 'Pants', 0, 1, NULL, '/Catalog/Pants/Pants.png', NULL, NULL, '/Catalog/Pants/Pants.png', 1),
(-2, 'shirt1', 'Testing Shirt', 'This is a test shirt.', '2021-04-24 22:34:44', 'None', '[1]', -1, 'Shirt', 0, 1, NULL, '/Catalog/Shirts/Shirt.png', NULL, NULL, '/Catalog/Shirts/Shirt.png', 1),
(-1, 'testitem', 'Testing Item', 'A test item for testing out new features on the catalog.', '2021-04-15 23:13:13', 'Premium', '[1,2]', -1, 'Cosmetic', 0, 0, NULL, '/assets/images/testicon-2.png', NULL, NULL, NULL, 1),
(0, 'masonissupercool', 'mapleson', 'only mason idiots', '2021-06-10 13:44:35', 'Premium', '[1,2,15,14,2]', -1, 'Face', 1, 1, NULL, 'https://i.imgur.com/oODFyP6.png', NULL, NULL, 'https://i.imgur.com/oODFyP6.png', 1),
(1, 'Roxy-Pin', 'Roxy Pin', 'Show off your true dog kindness!', '2021-04-16 21:04:56', 'None', '[1,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,5,5,5,5,5,5,5,5,5,8]', -1, 'Cosmetic', 0, 0, NULL, '/assets/images/catalog/roxy-pin.png', '/Catalog/Hats/1b234298.obj', '/Catalog/Hats/1b234298.mtl', NULL, 1),
(2, 'Beta-Tester-Ribbon', 'Beta Tester Ribbon', 'This item is only available during the Beta Testing period which was available from 19/04/2021 to sometime in the future.', '2021-04-19 21:00:36', 'None', '[1,2,5,2,2,2,5,12,15,14,16,16,2]', 0, 'Cosmetic', 0, 0, NULL, '/assets/images/catalog/beta-tester-ribbon.png', '/Catalog/Hats/1d653684.obj', '/Catalog/Hats/1d653684.mtl', NULL, 1),
(3, 'Pesky-Bee', 'Bee', 'This buzzer is very PESKY!', '2021-04-20 12:54:10', 'None', '[1,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,5,5,5,5,5,5,5,5,5]', -1, 'Cosmetic', 0, 0, NULL, '/assets/images/catalog/bee.png', NULL, NULL, NULL, 1),
(4, 'Stultus-Aprilis', 'Stultus Aprilis', 'Non te deseram.', '2021-04-20 13:19:25', 'Premium', '[1,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,5,5,5,5,5,5,5,5,5,5,5]', -1, 'Cosmetic', 0, 0, NULL, '/assets/images/catalog/stultus-aprilis.png', NULL, NULL, NULL, 1),
(5, 'Default-Face', 'Default Face', 'Owners for this item will <b>NOT</b> be set.', '2021-04-24 22:26:07', 'None', '[1,2]', -1, 'Face', 0, 1, NULL, 'https://cdn.jsdelivr.net/gh/RED7Studios/RED7Community-CDN@main/Catalog/Faces/Face.png', NULL, NULL, '/Catalog/Faces/Face.png', 1),
(6, 'Gold-Tophat', 'Gold Tophat', 'Bring out your riches with this tophat.', '2021-04-25 17:00:51', 'None', '[1,2,5,2,2,2,5,12,15,14,16,16]', 500, 'Hat', 0, 1, NULL, 'https://cdn.jsdelivr.net/gh/RED7Studios/RED7Community-CDN@main/Catalog/Hats/Gold-Tophat-Render.png', '/Catalog/Hats/Gold-Tophat.obj', '/Catalog/Hats/Gold-Tophat.mtl', NULL, 1),
(7, 'Beta-Tester-Hat', 'Beta Tester Hat', 'This item is only available during the Beta Testing period which was available from 19/04/2021 to sometime in the future.', '2021-04-25 17:00:51', 'None', '[1,2,2,5,6,8,11,12,15,18]', 0, 'Hat', 0, 1, 999999, 'https://cdn.jsdelivr.net/gh/RED7Studios/RED7Community-CDN@main/Catalog/Hats/Beta-Tester-Hat-Render.png', '/Catalog/Hats/Beta-Tester-Hat.obj', '/Catalog/Hats/Beta-Tester-Hat.mtl', NULL, 1),
(8, 'Black-Pants', 'Black Pants', 'Be stylish with these pants!', '2021-04-24 22:34:44', 'None', '[1,2,6,5,15,14,12]', 0, 'Pants', 0, 1, NULL, 'https://cdn.jsdelivr.net/gh/RED7Studios/RED7Community-CDN@main/Catalog/Pants/Black-Pants-Render.png', NULL, '', '/Catalog/Pants/Black-Pants.png', 1),
(9, 'Purple-Hoodie', 'Purple Hoodie', 'A free hoodie to get you started!', '2021-04-25 17:00:51', 'None', '[1,2,6,5,15,12,12,16]', 0, 'Shirt', 0, 1, NULL, 'https://cdn.jsdelivr.net/gh/RED7Studios/RED7Community-CDN@main/Catalog/Shirts/Purple-Hoodie-Render.png', '', '', '/Catalog/Shirts/Purple-Hoodie.png', 1),
(10, 'Diamond-Encrusted-Sunglasses', 'Diamond Encrusted Sunglasses', 'Show off your richness with these sunglasses.', '2021-04-28 12:18:54', 'None', '[1,2,5,8,15,15,14]', 50000, 'Face Accessory', 1, 1, 100, 'https://cdn.jsdelivr.net/gh/RED7Studios/RED7Community-CDN@main/Catalog/Hats/Diamond-Encrusted-Sunglasses-Render.png', '/Catalog/Hats/Diamond-Encrusted-Sunglasses.obj', '/Catalog/Hats/Diamond-Encrusted-Sunglasses.mtl', NULL, 1),
(11, 'Star-Pin', 'Star Pin', 'You are really a STAR! | Original by printable_models on Free3D', '2021-04-28 13:21:43', 'None', '[1,2,5,8,14,15]', 50, 'Front', 0, 1, NULL, 'https://cdn.jsdelivr.net/gh/RED7Studios/RED7Community-CDN@main/Catalog/Hats/Star-Pin-Render.png', '/Catalog/Hats/Star-Pin.obj', '/Catalog/Hats/Star-Pin.mtl', NULL, 1),
(12, 'Crown', 'Crown', 'You are honored! | Original by printable_models on Free3D', '2021-04-28 13:48:43', 'None', '[1,2,14,15]', 50, 'Hat', 0, 1, NULL, 'https://cdn.jsdelivr.net/gh/RED7Studios/RED7Community-CDN@main/Catalog/Hats/Crown-Render.png', '/Catalog/Hats/Crown.obj', '/Catalog/Hats/Crown.mtl', NULL, 1),
(13, 'Hackvent-1-Hat', 'Hackvent #1 Hat', 'This item is only available from the first Hackvent. Redeem this code to get something special! M@tr1x1', '2021-04-29 14:58:04', 'None', '[1,6]', -1, 'Hat', 0, 1, NULL, 'https://cdn.jsdelivr.net/gh/RED7Studios/RED7Community-CDN@main/Catalog/Hats/Hackvent-1-Hat-Render.png', '/Catalog/Hats/Beta-Tester-Hat.obj', '/Catalog/Hats/Hackvent-1-Hat.mtl', NULL, 1),
(14, 'Matrix-Shirt', 'Matrix Shirt', 'This item is only available from the first Hackvent.', '2021-04-25 17:00:51', 'None', '[1,6]', -1, 'Shirt', 0, 1, NULL, 'https://cdn.jsdelivr.net/gh/RED7Studios/RED7Community-CDN@main/Catalog/Shirts/Matrix-Shirt-Render.png', '', '', '/Catalog/Shirts/Matrix-Shirt.png', 1),
(15, 'Matrix-Pants', 'Matrix Pants', 'This item is only available from the first Hackvent.', '2021-04-25 17:00:51', 'None', '[1,6]', -1, 'Pants', 0, 1, NULL, 'https://cdn.jsdelivr.net/gh/RED7Studios/RED7Community-CDN@main/Catalog/Shirts/Matrix-Shirt-Render.png', '', '', '/Catalog/Shirts/Matrix-Shirt.png', 1),
(16, 'M@tr1x1', 'M@tr1x1', 'Look at the Hackvent #1 Cap, challenger.', '2021-05-01 12:48:08', 'None', '[6]', -1, 'Hat', 1, 1, 1, NULL, NULL, NULL, NULL, 1),
(17, 'Ban-Hammer', 'Ban Hammer', 'This hammer is only given out to those who are trusted.', '2021-05-03 06:56:00', 'None', '[1,2,3,5,8]', -1, 'Gear', 0, 1, 0, 'https://cdn.jsdelivr.net/gh/RED7Studios/RED7Community-CDN@main/Catalog/Gear/Ban-Hammer-Render.png', '/Catalog/Gear/Ban-Hammer.obj', '/Catalog/Gear/Ban-Hammer.mtl', NULL, 1),
(18, 'Mitchells-Shirt', 'Black Hoodie', 'Thats stealthy!', '2021-04-25 17:00:51', 'None', '[1,2,15,14]', 5, 'Shirt', 0, 1, NULL, 'https://cdn.jsdelivr.net/gh/RED7Studios/RED7Community-CDN@main/Catalog/Shirts/Mitchells-Shirt-Render.png', '', '', '/Catalog/Shirts/Mitchells-Shirt.png', 1),
(19, 'Mitchells-Hat', 'Mitchells Hat', 'Exclusive item to Mitchells account.', '2021-04-25 17:00:51', 'None', '[1,2]', -1, 'Hat', 0, 1, 999999, 'https://cdn.jsdelivr.net/gh/RED7Studios/RED7Community-CDN@main/Catalog/Hats/Mitchells-Hat-Render.png', '/Catalog/Hats/Beta-Tester-Hat.obj', '/Catalog/Hats/Mitchells-Hat.mtl', NULL, 1),
(20, 'Toilet', 'Toilet', 'Son, how did you get that on your head?', '2021-04-28 13:48:43', 'None', '[1,2,12,15,14]', 500, 'Hat', 0, 1, NULL, 'https://cdn.jsdelivr.net/gh/RED7Studios/RED7Community-CDN@main/Catalog/Hats/Toilet-Render.png', '/Catalog/Hats/Toilet.obj', '/Catalog/Hats/Toilet.mtl', NULL, 1),
(21, 'TAA-Shirt', 'TAA Shirt', 'Exclusive item to Mitchells account.', '2021-06-06 00:00:51', 'None', '[1,2]', -1, 'Shirt', 0, 1, NULL, 'https://cdn.jsdelivr.net/gh/RED7Studios/RED7Community-CDN@main/Catalog/Shirts/Mitchells-Shirt-Render.png', '', '', '/Catalog/Shirts/TAA-Shirt.png', 1),
(22, 'White-Hat', 'White Hat of Goodness', 'This hat can only be obtained through the Bug Hunting Program.', '2021-06-06 01:00:51', 'None', '[1]', -1, 'Hat', 0, 1, 999999, 'https://cdn.jsdelivr.net/gh/RED7Studios/RED7Community-CDN@main/Catalog/Hats/White-Hat-Render.png', '/Catalog/Hats/Beta-Tester-Hat.obj', '/Catalog/Hats/White-Hat.mtl', NULL, 1),
(23, 'Dominus-Hood', 'Dominus Hood', 'Less expensive dominus hood', '2021-06-06 01:00:51', 'None', '[1,2,3]', -1, 'Hat', 0, 1, 999999, 'https://cdn.jsdelivr.net/gh/RED7Studios/RED7Community-CDN@main/Catalog/Hats/Dominus-Hood-Render.png', '/Catalog/Hats/Dominus-Hood.obj', '/Catalog/Hats/Dominus-Hood.mtl', NULL, 9);

-- Dumping structure for table red7community.codes
CREATE TABLE IF NOT EXISTS `codes` (
`id` int NOT NULL AUTO_INCREMENT,
`name` text,
`code` text,
`currency` bigint DEFAULT NULL,
`items` longtext,
PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb3;

-- Dumping structure for table red7community.contact
CREATE TABLE IF NOT EXISTS `contact` (
`id` bigint NOT NULL,
`user_name` varchar(100) NOT NULL,
`user_email` varchar(255) NOT NULL,
`subject` varchar(255) NOT NULL,
`content` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- Dumping data for table red7community.contact: ~0 rows (approximately)

-- Dumping structure for table red7community.games
CREATE TABLE IF NOT EXISTS `games` (
`id` bigint NOT NULL DEFAULT '0',
`name` text NOT NULL,
`displayname` text,
`description` text NOT NULL,
`created_at` datetime DEFAULT CURRENT_TIMESTAMP,
`isDeleted` int DEFAULT NULL,
`isBanned` int DEFAULT NULL,
`banReason` text,
`banDate` datetime DEFAULT NULL,
`javascript` text,
`icon` text,
`ownerid` bigint NOT NULL DEFAULT '0',
PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- Dumping structure for table red7community.memberships
CREATE TABLE IF NOT EXISTS `memberships` (
`id` bigint NOT NULL DEFAULT '0',
`name` varchar(255) DEFAULT 'Premium',
`payoutAmount` varchar(255) DEFAULT '400',
`isEveryWeek` bigint DEFAULT NULL,
`isEveryDay` bigint DEFAULT NULL,
`cost` varchar(255) DEFAULT '6.99',
PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- Dumping data for table red7community.memberships: ~6 rows (approximately)
INSERT INTO `memberships` (`id`, `name`, `payoutAmount`, `isEveryWeek`, `isEveryDay`, `cost`) VALUES
(1, 'Premium450', '450', 1, 0, '6.99'),
(2, 'Premium1000', '1000', 1, 0, '13.99'),
(3, 'Premium2200', '2200', 1, 0, '28.99'),
(4, 'PremiumDaily450', '450', 0, 1, '10.99'),
(5, 'PremiumDaily2200', '2200', 0, 1, '38.99'),
(6, 'PremiumDaily1000', '1000', 0, 1, '17.99');

-- Dumping structure for table red7community.relation
CREATE TABLE IF NOT EXISTS `relation` (
`from` bigint NOT NULL DEFAULT '0',
`to` bigint NOT NULL DEFAULT '0',
`status` varchar(1) NOT NULL,
`since` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
PRIMARY KEY (`from`,`to`,`status`),
KEY `since` (`since`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping structure for table red7community.site_info
CREATE TABLE IF NOT EXISTS `site_info` (
`id` int NOT NULL AUTO_INCREMENT,
`name` text NOT NULL,
`content` text NOT NULL,
PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb3;

-- Dumping data for table red7community.site_info: ~7 rows (approximately)
INSERT INTO `site_info` (`id`, `name`, `content`) VALUES
(1, 'site_name', 'RED7Community'),
(2, 'registration', 'on'),
(3, 'currency', 'Bux'),
(4, 'premiumIcon', 'https://cdn.jsdelivr.net/gh/RED7Studios/RED7Community-CDN@main/assets/images/premium.png'),
(5, 'verifiedIcon', 'https://cdn.jsdelivr.net/gh/RED7Studios/RED7Community-CDN@main/assets/images/verified.png'),
(6, 'appealEmail', 'appeals@redsevenstudios.com'),
(7, 'maintenanceMode', 'off'),
(8, 'admin_site_name', 'RED7Community Admin Panel');

-- Dumping structure for table red7community.users
CREATE TABLE IF NOT EXISTS `users` (
`id` bigint NOT NULL AUTO_INCREMENT,
`username` varchar(100) NOT NULL,
`displayname` varchar(100) DEFAULT NULL,
`email` varchar(100) DEFAULT NULL,
`password` varchar(100) NOT NULL,
`description` text,
`created_at` datetime DEFAULT CURRENT_TIMESTAMP,
`lastLoginDate` date DEFAULT NULL,
`lastLogin` datetime DEFAULT NULL,
`currency` bigint DEFAULT '0',
`badges` longtext,
`items` longtext,
`membership` enum('None','Premium450','Premium1000','Premium2200','PremiumDaily450','PremiumDaily1000','PremiumDaily2200') DEFAULT NULL,
`isBanned` int DEFAULT '0',
`bannedReason` text,
`bannedDate` datetime DEFAULT NULL,
`isAdmin` int DEFAULT '0',
`isVerified` int DEFAULT '0',
`followers` longtext,
`following` longtext,
`clans` longtext,
`icon` varchar(255) DEFAULT '/assets/images/users/default.png',
PRIMARY KEY (`id`),
UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb3;

-- Dumping data for table red7community.users: ~17 rows (approximately)
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`id`, `username`, `displayname`, `email`, `password`, `description`, `created_at`, `lastLoginDate`, `lastLogin`, `currency`, `badges`, `items`, `membership`, `isBanned`, `bannedReason`, `bannedDate`, `isAdmin`, `isVerified`, `followers`, `following`, `clans`, `icon`) VALUES
(1, 'RED7Community', 'RED7Community', NULL, '', '$2y$10$wpjoA7MtKAx01nMxmhCE.Ofj.v5Xb1.dQuq4q89AiSPA5KwxV0Lia', '2021-02-27 22:59:37', '2021-06-10', '2021-06-10 13:48:55', 0, '[1,2,3]', '[1]', 'PremiumDaily2200', 0, NULL, NULL, 1, 1, '[]', '[]', '[]', 'https://www.gravatar.com/avatar/?s=180&d=mp&r=g'),                                                                                                                                                                                                                                                                                      (9, 'Not Found', 'Not Found', 'temp@temp.temp', '', 'This account is reserved to make sure that no-one accidentally creates it and gets locked out.', '2021-05-20 21:41:12', NULL, NULL, 0, '[]', '[]', 'None', 1, 'Reserved.', '2021-05-20 21:41:28', 0, 0, '[]', '[]', '[]', 'https://www.gravatar.com/avatar/8f79d54d603c0523c095d7e1e8dd37e5?s=180');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
