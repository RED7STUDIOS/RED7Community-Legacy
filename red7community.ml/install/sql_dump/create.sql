-- MariaDB dump 10.19  Distrib 10.8.4-MariaDB, for Linux (x86_64)
--
-- Host: localhost    Database: staging_red7community
-- ------------------------------------------------------
-- Server version	10.8.4-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `advertisements`
--

DROP TABLE IF EXISTS `advertisements`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `advertisements` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `displayname` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `accepted_by` bigint(20) NOT NULL,
  `banner_image` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `banner_url` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `advertisements`
--

LOCK TABLES `advertisements` WRITE;
/*!40000 ALTER TABLE `advertisements` DISABLE KEYS */;
/*!40000 ALTER TABLE `advertisements` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `applications`
--

DROP TABLE IF EXISTS `applications`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `applications` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `sender_id` bigint(20) DEFAULT NULL,
  `preferred_email` varchar(100) DEFAULT NULL,
  `reason` longtext DEFAULT NULL,
  `full_name` varchar(100) DEFAULT NULL,
  `submitted` datetime DEFAULT current_timestamp(),
  `accepted` tinyint(1) DEFAULT 0,
  `deniedReason` longtext DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `applications`
--

LOCK TABLES `applications` WRITE;
/*!40000 ALTER TABLE `applications` DISABLE KEYS */;
/*!40000 ALTER TABLE `applications` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `avatars`
--

DROP TABLE IF EXISTS `avatars`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `avatars` (
  `ownerid` bigint(20) NOT NULL DEFAULT 0,
  `items` longtext DEFAULT NULL,
  `shirt` int(11) DEFAULT NULL,
  `pants` int(11) DEFAULT NULL,
  `face` int(11) DEFAULT NULL,
  PRIMARY KEY (`ownerid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `avatars`
--

LOCK TABLES `avatars` WRITE;
/*!40000 ALTER TABLE `avatars` DISABLE KEYS */;
INSERT INTO `avatars` VALUES
(1,'[]',9,8,5),
/*!40000 ALTER TABLE `avatars` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `badges`
--

DROP TABLE IF EXISTS `badges`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `badges` (
  `id` bigint(20) NOT NULL DEFAULT 0,
  `name` text NOT NULL,
  `displayname` text DEFAULT NULL,
  `description` text DEFAULT NULL,
  `icon` text DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `badges`
--

LOCK TABLES `badges` WRITE;
/*!40000 ALTER TABLE `badges` DISABLE KEYS */;
INSERT INTO `badges` VALUES
(1,'Administrator','Administrator','The official admin badge.','https://cdn.jsdelivr.net/gh/RED7Studios/RED7Community-CDN@main/Catalog/Badges/administrator.png'),
(2,'Welcome','Welcome','The official welcome badge.','https://cdn.jsdelivr.net/gh/RED7Studios/RED7Community-CDN@main/Catalog/Badges/welcome.png'),
(3,'Beta-Tester','Beta Tester','The official beta testing badge.','https://cdn.jsdelivr.net/gh/RED7Studios/RED7Community-CDN@main/Catalog/Badges/beta-tester.png'),
(4,'Bug-Hunter','Bug Hunter','People with this badge are immune to being banned for finding bugs, however a warning or 3 day ban can still occur if a bug is not reported.','https://cdn.jsdelivr.net/gh/RED7Studios/RED7Community-CDN@main/Catalog/Badges/bug-hunter.png');
/*!40000 ALTER TABLE `badges` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `clans`
--

DROP TABLE IF EXISTS `clans`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `clans` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `displayname` varchar(100) DEFAULT NULL,
  `currency` bigint(20) NOT NULL DEFAULT 0,
  `members` varchar(255) DEFAULT NULL,
  `owner` int(11) DEFAULT NULL,
  `icon` longtext NOT NULL,
  `description` varchar(100) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `hasInfraction` int(11) NOT NULL DEFAULT 0,
  `isVerified` int(11) NOT NULL DEFAULT 0,
  `bannedDate` datetime DEFAULT NULL,
  `bannedReason` varchar(100) DEFAULT NULL,
  `isSpecial` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `clans`
--

LOCK TABLES `clans` WRITE;
/*!40000 ALTER TABLE `clans` DISABLE KEYS */;
INSERT INTO `clans` VALUES
(1,'red7clan','RED7Clan',1000000,'[1]',1,'https://www.gravatar.com/avatar/?s=180&d=mp&r=g','Welcome to RED7Community!',NULL,0,1,'2022-05-21 20:06:29','',0);
/*!40000 ALTER TABLE `clans` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `codes`
--

DROP TABLE IF EXISTS `codes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `codes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` text DEFAULT NULL,
  `code` text DEFAULT NULL,
  `currency` bigint(20) DEFAULT NULL,
  `items` longtext DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `codes`
--

LOCK TABLES `codes` WRITE;
/*!40000 ALTER TABLE `codes` DISABLE KEYS */;
/*!40000 ALTER TABLE `codes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `contact`
--

DROP TABLE IF EXISTS `contact`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `contact` (
  `id` bigint(20) NOT NULL,
  `user_name` varchar(100) NOT NULL,
  `user_email` varchar(255) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `content` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `contact`
--

LOCK TABLES `contact` WRITE;
/*!40000 ALTER TABLE `contact` DISABLE KEYS */;
/*!40000 ALTER TABLE `contact` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `infractions`
--

DROP TABLE IF EXISTS `infractions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `infractions` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `issued_by` bigint(20) NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `type` enum('Ban','Warning') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `reason` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `start` datetime DEFAULT current_timestamp(),
  `end` datetime DEFAULT NULL,
  `active` tinyint(1) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `infractions`
--

LOCK TABLES `infractions` WRITE;
/*!40000 ALTER TABLE `infractions` DISABLE KEYS */;
INSERT INTO `infractions` VALUES
(1,1,1,'Warning','Lol nooba','2022-08-26 00:19:43','2022-08-28 00:59:10',0),
(2,1,11,'Ban','sorry bud','2022-08-27 01:13:25','2022-08-27 01:21:25',1);
/*!40000 ALTER TABLE `infractions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `items`
--

DROP TABLE IF EXISTS `items`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `items` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL,
  `displayname` text DEFAULT NULL,
  `description` text DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `membershipRequired` enum('None','Premium') DEFAULT NULL,
  `owners` longtext DEFAULT NULL,
  `price` int(11) DEFAULT NULL,
  `type` enum('Back','Front','Face','Shirt','Pants','T-Shirt','Cosmetic','Hat','Face Accessory','Gear') DEFAULT NULL,
  `isLimited` int(11) DEFAULT 0,
  `isEquippable` int(11) DEFAULT 1,
  `copies` int(11) DEFAULT NULL,
  `icon` text DEFAULT NULL,
  `obj` longtext DEFAULT NULL,
  `mtl` longtext DEFAULT NULL,
  `texture` longtext DEFAULT NULL,
  `creator` int(11) DEFAULT 1,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `items`
--

LOCK TABLES `items` WRITE;
/*!40000 ALTER TABLE `items` DISABLE KEYS */;
INSERT INTO `items` VALUES
(1,'Roxy-Pin','Roxy Pin','Show off your true dog kindness!','2021-04-16 21:04:56','None','[\"1\",\"1\",\"1\",\"1\",\"1\"]',-1,'Cosmetic',0,0,NULL,'/assets/images/catalog/roxy-pin.png','/Catalog/Hats/1b234298.obj','/Catalog/Hats/1b234298.mtl',NULL,1),
(2,'Beta-Tester-Ribbon','Beta Tester Ribbon','This item is only available during the Beta Testing period which was available from 19/04/2021 to sometime in the future.','2021-04-19 21:00:36','None','[11]',0,'Cosmetic',0,0,NULL,'/assets/images/catalog/beta-tester-ribbon.png','/Catalog/Hats/1d653684.obj','/Catalog/Hats/1d653684.mtl',NULL,1),
(3,'Pesky-Bee','Bee','This buzzer is very PESKY!','2021-04-20 12:54:10','None','[]',-1,'Cosmetic',0,0,NULL,'/assets/images/catalog/bee.png',NULL,NULL,NULL,1),
(4,'Stultus-Aprilis','Stultus Aprilis','Non te deseram.','2021-04-20 13:19:25','Premium','[]',-1,'Cosmetic',0,0,NULL,'/assets/images/catalog/stultus-aprilis.png',NULL,NULL,NULL,1),
(5,'Default-Face','Default Face','Owners for this item will <b>NOT</b> be set.','2021-04-24 22:26:07','None','[]',-1,'Face',0,1,NULL,'https://cdn.jsdelivr.net/gh/RED7Studios/RED7Community-CDN@main/Catalog/Faces/Face.png',NULL,NULL,'/Catalog/Faces/Face.png',1),
(6,'Gold-Tophat','Gold Tophat','           Bring out your riches with this tophat.        ','2021-04-25 17:00:51','None','[1,1,1,12,\"1\",\"1\"]',500,'Hat',0,1,NULL,'https://cdn.jsdelivr.net/gh/RED7Studios/RED7Community-CDN@main/Catalog/Hats/Gold-Tophat-Render.png','/Catalog/Hats/Gold-Tophat.obj','/Catalog/Hats/Gold-Tophat.mtl',NULL,1),
(7,'Beta-Tester-Hat','Beta Tester Hat','This item is only available during the Beta Testing period which was available from 19/04/2021 to sometime in the future.','2021-04-25 17:00:51','None','[11,\"1\",\"1\",\"1\"]',0,'Back',0,1,999999,'https://cdn.jsdelivr.net/gh/RED7Studios/RED7Community-CDN@main/Catalog/Hats/Beta-Tester-Hat-Render.png','/Catalog/Hats/Beta-Tester-Hat.obj','/Catalog/Hats/Beta-Tester-Hat.mtl',NULL,11),
(8,'Black-Pants','Black Pants','Be stylish with these pants!','2021-04-24 22:34:44','None','[11]',0,'Pants',0,1,NULL,'https://cdn.jsdelivr.net/gh/RED7Studios/RED7Community-CDN@main/Catalog/Pants/Black-Pants-Render.png',NULL,'','/Catalog/Pants/Black-Pants.png',1),
(9,'Purple-Hoodie','Purple Hoodie','A free hoodie to get you started!','2021-04-25 17:00:51','None','[]',0,'Shirt',0,1,NULL,'https://cdn.jsdelivr.net/gh/RED7Studios/RED7Community-CDN@main/Catalog/Shirts/Purple-Hoodie-Render.png','','','/Catalog/Shirts/Purple-Hoodie.png',1),
(10,'Diamond-Encrusted-Sunglasses','Diamond Encrusted Sunglasses','Show off your richness with these sunglasses.','2021-04-28 12:18:54','None','[12]',50000,'Face Accessory',1,1,100,'https://cdn.jsdelivr.net/gh/RED7Studios/RED7Community-CDN@main/Catalog/Hats/Diamond-Encrusted-Sunglasses-Render.png','/Catalog/Hats/Diamond-Encrusted-Sunglasses.obj','/Catalog/Hats/Diamond-Encrusted-Sunglasses.mtl',NULL,1),
(11,'Star-Pin','Star Pin','You are really a STAR! | Original by printable_models on Free3D','2021-04-28 13:21:43','None','[12]',50,'Front',0,1,NULL,'https://cdn.jsdelivr.net/gh/RED7Studios/RED7Community-CDN@main/Catalog/Hats/Star-Pin-Render.png','/Catalog/Hats/Star-Pin.obj','/Catalog/Hats/Star-Pin.mtl',NULL,1),
(12,'Crown','Crown','You are honored! | Original by printable_models on Free3D','2021-04-28 13:48:43','None','[12]',50,'Hat',0,1,NULL,'https://cdn.jsdelivr.net/gh/RED7Studios/RED7Community-CDN@main/Catalog/Hats/Crown-Render.png','/Catalog/Hats/Crown.obj','/Catalog/Hats/Crown.mtl',NULL,1),
(13,'Hackvent-1-Hat','Hackvent #1 Hat','This item is only available from the first Hackvent. Redeem this code to get something special! M@tr1x1','2021-04-29 14:58:04','None','[1,6]',-1,'Hat',0,1,NULL,'https://cdn.jsdelivr.net/gh/RED7Studios/RED7Community-CDN@main/Catalog/Hats/Hackvent-1-Hat-Render.png','/Catalog/Hats/Beta-Tester-Hat.obj','/Catalog/Hats/Hackvent-1-Hat.mtl',NULL,1),
(14,'Matrix-Shirt','Matrix Shirt','This item is only available from the first Hackvent.','2021-04-25 17:00:51','None','[]',-1,'Shirt',0,1,NULL,'https://cdn.jsdelivr.net/gh/RED7Studios/RED7Community-CDN@main/Catalog/Shirts/Matrix-Shirt-Render.png','','','/Catalog/Shirts/Matrix-Shirt.png',1),
(15,'Matrix-Pants','Matrix Pants','This item is only available from the first Hackvent.','2021-04-25 17:00:51','None','[]',-1,'Pants',0,1,NULL,'https://cdn.jsdelivr.net/gh/RED7Studios/RED7Community-CDN@main/Catalog/Shirts/Matrix-Shirt-Render.png','','','/Catalog/Shirts/Matrix-Shirt.png',1),
(16,'M@tr1x1','M@tr1x1','Look at the Hackvent #1 Cap, challenger.','2021-05-01 12:48:08','None','[]',-1,'Hat',1,1,1,NULL,NULL,NULL,NULL,1),
(17,'Ban-Hammer','Ban Hammer','This hammer is only given out to those who are trusted.','2021-05-03 06:56:00','None','[]',-1,'Gear',0,1,0,'https://cdn.jsdelivr.net/gh/RED7Studios/RED7Community-CDN@main/Catalog/Gear/Ban-Hammer-Render.png','/Catalog/Gear/Ban-Hammer.obj','/Catalog/Gear/Ban-Hammer.mtl',NULL,1),
(18,'Mitchells-Shirt','Black Hoodie','Thats stealthy!','2021-04-25 17:00:51','None','[1]',5,'Shirt',0,1,NULL,'https://cdn.jsdelivr.net/gh/RED7Studios/RED7Community-CDN@main/Catalog/Shirts/Mitchells-Shirt-Render.png','','','/Catalog/Shirts/Mitchells-Shirt.png',1),
(19,'Mitchells-Hat','Mitchells Hat','Exclusive item to Mitchells account.','2021-04-25 17:00:51','None','[]',-1,'Hat',0,1,999999,'https://cdn.jsdelivr.net/gh/RED7Studios/RED7Community-CDN@main/Catalog/Hats/Mitchells-Hat-Render.png','/Catalog/Hats/Beta-Tester-Hat.obj','/Catalog/Hats/Mitchells-Hat.mtl',NULL,1),
(20,'Toilet','Toilet','Son, how did you get that on your head?','2021-04-28 13:48:43','None','[]',500,'Hat',0,1,NULL,'https://cdn.jsdelivr.net/gh/RED7Studios/RED7Community-CDN@main/Catalog/Hats/Toilet-Render.png','/Catalog/Hats/Toilet.obj','/Catalog/Hats/Toilet.mtl',NULL,1),
(21,'TAA-Shirt','TAA Shirt','Exclusive item to Mitchells account.','2021-06-06 00:00:51','None','[]',-1,'Shirt',0,1,NULL,'https://cdn.jsdelivr.net/gh/RED7Studios/RED7Community-CDN@main/Catalog/Shirts/Mitchells-Shirt-Render.png','','','/Catalog/Shirts/TAA-Shirt.png',1),
(22,'White-Hat','White Hat of Goodness','This hat can only be obtained through the Bug Hunting Program.','2021-06-06 01:00:51','None','[]',-1,'Hat',0,1,999999,'https://cdn.jsdelivr.net/gh/RED7Studios/RED7Community-CDN@main/Catalog/Hats/White-Hat-Render.png','/Catalog/Hats/Beta-Tester-Hat.obj','/Catalog/Hats/White-Hat.mtl',NULL,1),
(23,'Dominus-Hood','Dominus Hood','Less expensive dominus hood','2021-06-06 01:00:51','None','[]',-1,'Hat',0,1,999999,'https://cdn.jsdelivr.net/gh/RED7Studios/RED7Community-CDN@main/Catalog/Hats/Dominus-Hood-Render.png','/Catalog/Hats/Dominus-Hood.obj','/Catalog/Hats/Dominus-Hood.mtl',NULL,9),
(35,'Old-TV','Old TV','Old TV.','2022-05-24 21:59:44','None','[1]',300,'Hat',0,1,9999999,'','/Catalog/Hats/Old-TV.obj','/Catalog/Hats/Old-TV.mtl','',1);
/*!40000 ALTER TABLE `items` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `memberships`
--

DROP TABLE IF EXISTS `memberships`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `memberships` (
  `id` bigint(20) NOT NULL DEFAULT 0,
  `name` varchar(255) DEFAULT 'Premium',
  `payoutAmount` varchar(255) DEFAULT '400',
  `isEveryWeek` bigint(20) DEFAULT NULL,
  `isEveryDay` bigint(20) DEFAULT NULL,
  `cost` varchar(255) DEFAULT '6.99',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `memberships`
--

LOCK TABLES `memberships` WRITE;
/*!40000 ALTER TABLE `memberships` DISABLE KEYS */;
INSERT INTO `memberships` VALUES
(1,'Premium450','450',1,0,'6.99'),
(2,'Premium1000','1000',1,0,'13.99'),
(3,'Premium2200','2200',1,0,'28.99'),
(4,'PremiumDaily450','450',0,1,'10.99'),
(5,'PremiumDaily2200','2200',0,1,'38.99'),
(6,'PremiumDaily1000','1000',0,1,'17.99');
/*!40000 ALTER TABLE `memberships` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `messaging`
--

DROP TABLE IF EXISTS `messaging`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `messaging` (
  `from` bigint(20) NOT NULL DEFAULT 0,
  `to` bigint(20) NOT NULL DEFAULT 0,
  `message` longtext NOT NULL,
  `timestamp` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`from`,`to`),
  KEY `timestamp` (`timestamp`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `messaging`
--

LOCK TABLES `messaging` WRITE;
/*!40000 ALTER TABLE `messaging` DISABLE KEYS */;
/*!40000 ALTER TABLE `messaging` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `relation`
--

DROP TABLE IF EXISTS `relation`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `relation` (
  `from` bigint(20) NOT NULL DEFAULT 0,
  `to` bigint(20) NOT NULL DEFAULT 0,
  `status` varchar(50) NOT NULL,
  `since` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`from`,`to`,`status`),
  KEY `since` (`since`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `roles` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `permissions` text COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `roles`
--

LOCK TABLES `roles` WRITE;
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` VALUES
(1,'Superuser','[\"User - API Keys\", \"Admin - Catalog - Name\", \"Admin - Catalog - Creator\", \"Admin - Catalog - Description\", \"Admin - Catalog - Price\", \"Admin - Catalog - Type\", \"Admin - User - Display Name\", \"Admin - User - Description\", \"Admin - User - Currency\", \"Admin - User - Role\", \"Admin - User - Ban\", \"Admin - User - Unban\", \"Admin - Maintenance - Bypass\"]');
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `site_info`
--

DROP TABLE IF EXISTS `site_info`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `site_info` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` text NOT NULL,
  `content` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `site_info`
--

LOCK TABLES `site_info` WRITE;
/*!40000 ALTER TABLE `site_info` DISABLE KEYS */;
INSERT INTO `site_info` VALUES
(1,'site_name','<SITE_NAME>'),
(2,'registration','on'),
(3,'currency','Bux'),
(4,'premiumIcon','/assets/images/premium.png'),
(5,'verifiedIcon','/assets/images/verified.png'),
(6,'appealEmail','appeals@redsevenstudios.com'),
(7,'maintenanceMode','off'),
(8,'bannedWords','[\"4r5e\", \"5h1t\", \"5hit\", \"a55\", \"anal\", \"anus\", \"ar5e\", \"arrse\", \"arse\", \"ass\", \"ass-fucker\", \"asses\", \"assfucker\", \"assfukka\", \"asshole\", \"assholes\", \"asswhole\", \"a_s_s\", \"b!tch\", \"b00bs\", \"b17ch\", \"b1tch\", \"ballbag\", \"balls\", \"ballsack\", \"bastard\", \"beastial\", \"beastiality\", \"bellend\", \"bestial\", \"bestiality\", \"bi+ch\", \"biatch\", \"bitch\", \"bitcher\", \"bitchers\", \"bitches\", \"bitchin\", \"bitching\", \"bloody\", \"blow job\", \"blowjob\", \"blowjobs\", \"boiolas\", \"bollock\", \"bollok\", \"boner\", \"boob\", \"boobs\", \"booobs\", \"boooobs\", \"booooobs\", \"booooooobs\", \"breasts\", \"buceta\", \"bugger\", \"bum\", \"bunny fucker\", \"butt\", \"butthole\", \"buttmuch\", \"buttplug\", \"c0ck\", \"c0cksucker\", \"carpet muncher\", \"cawk\", \"chink\", \"cipa\", \"cl1t\", \"clit\", \"clitoris\", \"clits\", \"cnut\", \"cock\", \"cock-sucker\", \"cockface\", \"cockhead\", \"cockmunch\", \"cockmuncher\", \"cocks\", \"cocksuck\", \"cocksucked\", \"cocksucker\", \"cocksucking\", \"cocksucks\", \"cocksuka\", \"cocksukka\", \"cok\", \"cokmuncher\", \"coksucka\", \"coon\", \"cox\", \"crap\", \"cum\", \"cummer\", \"cumming\", \"cums\", \"cumshot\", \"cunilingus\", \"cunillingus\", \"cunnilingus\", \"cunt\", \"cuntlick\", \"cuntlicker\", \"cuntlicking\", \"cunts\", \"cyalis\", \"cyberfuc\", \"cyberfuck\", \"cyberfucked\", \"cyberfucker\", \"cyberfuckers\", \"cyberfucking\", \"d1ck\", \"damn\", \"dick\", \"dickhead\", \"dildo\", \"dildos\", \"dink\", \"dinks\", \"dirsa\", \"dlck\", \"dog-fucker\", \"doggin\", \"dogging\", \"donkeyribber\", \"doosh\", \"duche\", \"dyke\", \"ejaculate\", \"ejaculated\", \"ejaculates\", \"ejaculating\", \"ejaculatings\", \"ejaculation\", \"ejakulate\", \"f u c k\", \"f u c k e r\", \"f4nny\", \"fag\", \"fagging\", \"faggitt\", \"faggot\", \"faggs\", \"fagot\", \"fagots\", \"fags\", \"fanny\", \"fannyflaps\", \"fannyfucker\", \"fanyy\", \"fatass\", \"fcuk\", \"fcuker\", \"fcuking\", \"felching\", \"fellate\", \"fellatio\", \"fingerfuck\", \"fingerfucked\", \"fingerfucker\", \"fingerfuckers\", \"fingerfucking\", \"fingerfucks\", \"fistfuck\", \"fistfucked\", \"fistfucker\", \"fistfuckers\", \"fistfucking\", \"fistfuckings\", \"fistfucks\", \"flange\", \"fook\", \"fooker\", \"fuck\", \"fucka\", \"fucked\", \"fucker\", \"fuckers\", \"fuckhead\", \"fuckheads\", \"fuckin\", \"fucking\", \"fuckings\", \"fuckingshitmotherfucker\", \"fuckme\", \"fucks\", \"fuckwhit\", \"fuckwit\", \"fudge packer\", \"fudgepacker\", \"fuk\", \"fuker\", \"fukker\", \"fukkin\", \"fuks\", \"fukwhit\", \"fukwit\", \"fux\", \"fux0r\", \"f_u_c_k\", \"gangbang\", \"gangbanged\", \"gangbangs\", \"gaylord\", \"gaysex\", \"goatse\", \"God\", \"god-dam\", \"god-damned\", \"goddamn\", \"goddamned\", \"hardcoresex\", \"hell\", \"heshe\", \"hoar\", \"hoare\", \"hoer\", \"homo\", \"hore\", \"horniest\", \"horny\", \"hotsex\", \"jack-off\", \"jackoff\", \"jap\", \"jerk-off\", \"jism\", \"jiz\", \"jizm\", \"jizz\", \"kawk\", \"knob\", \"knobead\", \"knobed\", \"knobend\", \"knobhead\", \"knobjocky\", \"knobjokey\", \"kock\", \"kondum\", \"kondums\", \"kum\", \"kummer\", \"kumming\", \"kums\", \"kunilingus\", \"l3i+ch\", \"l3itch\", \"labia\", \"lust\", \"lusting\", \"m0f0\", \"m0fo\", \"m45terbate\", \"ma5terb8\", \"ma5terbate\", \"masochist\", \"master-bate\", \"masterb8\", \"masterbat*\", \"masterbat3\", \"masterbate\", \"masterbation\", \"masterbations\", \"masturbate\", \"mo-fo\", \"mof0\", \"mofo\", \"mothafuck\", \"mothafucka\", \"mothafuckas\", \"mothafuckaz\", \"mothafucked\", \"mothafucker\", \"mothafuckers\", \"mothafuckin\", \"mothafucking\", \"mothafuckings\", \"mothafucks\", \"mother fucker\", \"motherfuck\", \"motherfucked\", \"motherfucker\", \"motherfuckers\", \"motherfuckin\", \"motherfucking\", \"motherfuckings\", \"motherfuckka\", \"motherfucks\", \"muff\", \"mutha\", \"muthafecker\", \"muthafuckker\", \"muther\", \"mutherfucker\", \"n1gga\", \"n1gger\", \"nazi\", \"nigg3r\", \"nigg4h\", \"nigga\", \"niggah\", \"niggas\", \"niggaz\", \"nigger\", \"niggers\", \"nob\", \"nob jokey\", \"nobhead\", \"nobjocky\", \"nobjokey\", \"numbnuts\", \"nutsack\", \"orgasim\", \"orgasims\", \"orgasm\", \"orgasms\", \"p0rn\", \"pawn\", \"pecker\", \"penis\", \"penisfucker\", \"phonesex\", \"phuck\", \"phuk\", \"phuked\", \"phuking\", \"phukked\", \"phukking\", \"phuks\", \"phuq\", \"pigfucker\", \"pimpis\", \"piss\", \"pissed\", \"pisser\", \"pissers\", \"pisses\", \"pissflaps\", \"pissin\", \"pissing\", \"pissoff\", \"poop\", \"porn\", \"porno\", \"pornography\", \"pornos\", \"prick\", \"pricks\", \"pron\", \"pube\", \"pusse\", \"pussi\", \"pussies\", \"pussy\", \"pussys\", \"rectum\", \"retard\", \"rimjaw\", \"rimming\", \"s hit\", \"s.o.b.\", \"sadist\", \"schlong\", \"screwing\", \"scroat\", \"scrote\", \"scrotum\", \"semen\", \"sex\", \"sh!+\", \"sh!t\", \"sh1t\", \"shag\", \"shagger\", \"shaggin\", \"shagging\", \"shemale\", \"shi+\", \"shit\", \"shitdick\", \"shite\", \"shited\", \"shitey\", \"shitfuck\", \"shitfull\", \"shithead\", \"shiting\", \"shitings\", \"shits\", \"shitted\", \"shitter\", \"shitters\", \"shitting\", \"shittings\", \"shitty\", \"skank\", \"slut\", \"sluts\", \"smegma\", \"smut\", \"snatch\", \"son-of-a-bitch\", \"spac\", \"spunk\", \"s_h_i_t\", \"t1tt1e5\", \"t1tties\", \"teets\", \"teez\", \"testical\", \"testicle\", \"tit\", \"titfuck\", \"tits\", \"titt\", \"tittie5\", \"tittiefucker\", \"titties\", \"tittyfuck\", \"tittywank\", \"titwank\", \"tosser\", \"turd\", \"tw4t\", \"twat\", \"twathead\", \"twatty\", \"twunt\", \"twunter\", \"v14gra\", \"v1gra\", \"vagina\", \"viagra\", \"vulva\", \"w00se\", \"wang\", \"wank\", \"wanker\", \"wanky\", \"whoar\", \"whore\", \"willies\", \"willy\", \"xrated\", \"xxx\", \"feck\"]');
/*!40000 ALTER TABLE `site_info` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `transactions`
--

DROP TABLE IF EXISTS `transactions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `transactions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cust_name` varchar(50) NOT NULL DEFAULT '',
  `cust_email` varchar(50) NOT NULL DEFAULT '',
  `item_name` varchar(50) NOT NULL DEFAULT '',
  `item_number` varchar(50) NOT NULL DEFAULT '',
  `item_price` int(11) NOT NULL DEFAULT 0,
  `item_price_currency` varchar(50) NOT NULL DEFAULT '',
  `paid_amount` int(11) NOT NULL DEFAULT 0,
  `paid_amount_currency` varchar(50) NOT NULL DEFAULT '',
  `txn_id` varchar(50) NOT NULL DEFAULT '',
  `payment_status` varchar(50) NOT NULL DEFAULT '',
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `transactions`
--

LOCK TABLES `transactions` WRITE;
/*!40000 ALTER TABLE `transactions` DISABLE KEYS */;
/*!40000 ALTER TABLE `transactions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `username` varchar(100) NOT NULL,
  `displayname` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(100) NOT NULL,
  `description` text DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `lastLoginDate` date DEFAULT NULL,
  `lastLogin` datetime DEFAULT NULL,
  `currency` bigint(20) DEFAULT 0,
  `badges` longtext DEFAULT NULL,
  `items` longtext DEFAULT NULL,
  `membership` enum('None','Premium450','Premium1000','Premium2200','PremiumDaily450','PremiumDaily1000','PremiumDaily2200') DEFAULT NULL,
  `isVerified` int(11) DEFAULT 0,
  `clans` longtext DEFAULT NULL,
  `icon` varchar(255) DEFAULT '/assets/images/users/default.png',
  `role` longtext DEFAULT NULL,
  `auth_secret` varchar(255) DEFAULT NULL,
  `reset_link_token` varchar(100) DEFAULT NULL,
  `reset_link_exp` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES
(1,'<USER_NAME>','<USER_NAME>','admin@red7community.local',<PASSWORD>,'Welcome to <SITE_NAME>!','2021-02-27 22:59:37','2022-08-27','2022-08-27 20:12:01',-1000000,'[1]','[]','PremiumDaily2200',1,NULL,'https://www.gravatar.com/avatar/?s=180&d=mp&r=g','3',NULL,NULL,NULL);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping routines for database 'staging_red7community'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2022-08-27 22:06:51
