using System;
using System.IO;
using System.Windows.Forms;

namespace RED7Community_Creator
{
    public partial class frmMain : Form
    {
        public frmMain()
        {
            InitializeComponent();
        }

        private void btnGenerate_Click(object sender, EventArgs e)
        {
            if (Directory.Exists("Generated"))
            {
                Directory.Delete("Generated", true);
            }

            Directory.CreateDirectory("Generated");

            string configFileName = @"Generated\config.php";

            using (StreamWriter writer = File.CreateText(configFileName))
            {
                writer.WriteLine("<?php");
                writer.WriteLine("/*");
                writer.WriteLine("  File Name: config.php");
                writer.WriteLine("  Original Location: /assets/config.php");
                writer.WriteLine("  Description: Config file for the Database and APIs.");
                writer.WriteLine("  Author: Mitchell (BlxckSky_959)");
                writer.WriteLine("  Copyright (C) RED7 STUDIOS 2021");
                writer.WriteLine("*/");
                writer.WriteLine("");
                writer.WriteLine("// The domain URL.");
                writer.WriteLine("$ROOT_URL = '" + gs_mainURL.Text + "';");
                writer.WriteLine("// The API URL.");
                writer.WriteLine("$API_URL = $ROOT_URL. '" + gs_apiURL.Text + "';");
                writer.WriteLine("");
                writer.WriteLine("// The Storage URL.");
                writer.WriteLine("$STORAGE_URL = '" + gs_storageURL.Text + "';");
                writer.WriteLine("");
                writer.WriteLine("// The status URL.");
                writer.WriteLine("$STATUS_URL = '" + gs_statusURL.Text + "';");
                writer.WriteLine("$STATUS_GITHUB_URL = '" + gs_statusGithubURL.Text + "';");
                writer.WriteLine("");
                writer.WriteLine("// Other Options.");
                writer.WriteLine("$CUSTOM_SESSION_LOCATION = false;");
                writer.WriteLine(@"$CSL_PATH = 'D:\OneDrive - redsevenstudios.com\Users\Mitchell\Desktop\CommunitySite\Sessions\Main';");
                writer.WriteLine("");
                writer.WriteLine("/* Database credentials. */");
                writer.WriteLine("define('DB_SERVER', '" + ds_server.Text + "');");
                writer.WriteLine("define('DB_USERNAME', '" + ds_username.Text + "');");
                writer.WriteLine("define('DB_PASSWORD', '" + ds_password.Text + "');");
                writer.WriteLine("define('DB_NAME', '" + ds_name.Text + "');");
                writer.WriteLine("");
                writer.WriteLine("/* Attempt to connect to MySQL database with the credentials. */");
                writer.WriteLine("$link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);");
                writer.WriteLine("");
                writer.WriteLine("// Check connection");
                writer.WriteLine("if($link === false){");
                writer.WriteLine("// Kill it, if it cannot connect.");
                writer.WriteLine("die('ERROR: Could not connect.' . mysqli_connect_error());");
                writer.WriteLine("}");
                writer.WriteLine("?>");
            }





            string dbFileName = @"Generated\DB.sql";

            using (StreamWriter writer = File.CreateText(dbFileName))
            {
                writer.WriteLine("CREATE DATABASE IF NOT EXISTS `" + ds_name.Text + "`;");
                writer.WriteLine("USE `" + ds_name.Text + "`;");
                writer.WriteLine("");
                writer.WriteLine("CREATE TABLE IF NOT EXISTS `admin_panel` (");
                writer.WriteLine("`id` int NOT NULL AUTO_INCREMENT,");
                writer.WriteLine("`ownerid` int DEFAULT NULL,");
                writer.WriteLine("`full_name` text,");
                writer.WriteLine("PRIMARY KEY (`id`)");
                writer.WriteLine(") ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb3;");
                writer.WriteLine("");
                writer.WriteLine("INSERT INTO `admin_panel` (`id`, `ownerid`, `full_name`) VALUES");
                writer.WriteLine("(1, 1, '" + mu_username.Text + "');");
                writer.WriteLine("");
                writer.WriteLine("CREATE TABLE IF NOT EXISTS `avatars` (");
                writer.WriteLine("`ownerid` bigint NOT NULL DEFAULT '0',");
                writer.WriteLine("`items` longtext,");
                writer.WriteLine("`shirt` int DEFAULT NULL,");
                writer.WriteLine("`pants` int DEFAULT NULL,");
                writer.WriteLine("`face` int DEFAULT NULL,");
                writer.WriteLine("PRIMARY KEY (`ownerid`)");
                writer.WriteLine(") ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;");
                writer.WriteLine("");
                writer.WriteLine("INSERT INTO `avatars` (`ownerid`, `items`, `shirt`, `pants`, `face`) VALUES");
                writer.WriteLine("(1, '[1]', 9, 8, 5);");
                writer.WriteLine("");
                writer.WriteLine("CREATE TABLE IF NOT EXISTS `badges` (");
                writer.WriteLine("`id` bigint NOT NULL DEFAULT '0',");
                writer.WriteLine("`name` text NOT NULL,");
                writer.WriteLine("`displayname` text,");
                writer.WriteLine("`description` text,");
                writer.WriteLine("`icon` text,");
                writer.WriteLine("PRIMARY KEY (`id`) USING BTREE");
                writer.WriteLine(") ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;");
                writer.WriteLine("");
                writer.WriteLine("INSERT INTO `badges` (`id`, `name`, `displayname`, `description`, `icon`) VALUES");
                writer.WriteLine("(1, 'Administrator', 'Administrator', 'The official admin badge.', 'https://cdn.jsdelivr.net/gh/RED7Studios/RED7Community-CDN@main/Catalog/Badges/administrator.png'),");
                writer.WriteLine("(2, 'Welcome', 'Welcome', 'The official welcome badge.', 'https://cdn.jsdelivr.net/gh/RED7Studios/RED7Community-CDN@main/Catalog/Badges/welcome.png'),");
                writer.WriteLine("(3, 'Beta-Tester', 'Beta Tester', 'The official beta testing badge.', 'https://cdn.jsdelivr.net/gh/RED7Studios/RED7Community-CDN@main/Catalog/Badges/beta-tester.png'),");
                writer.WriteLine("(4, 'Bug-Hunter', 'Bug Hunter', 'People with this badge are immune to being banned for finding bugs, however a warning or 3 day ban can still occur if a bug is not reported.', 'https://cdn.jsdelivr.net/gh/RED7Studios/RED7Community-CDN@main/Catalog/Badges/bug-hunter.png');");
                writer.WriteLine("");
                writer.WriteLine("CREATE TABLE IF NOT EXISTS `catalog` (");
                writer.WriteLine("`id` bigint NOT NULL DEFAULT '0',");
                writer.WriteLine("`name` varchar(50) DEFAULT NULL,");
                writer.WriteLine("`displayname` text,");
                writer.WriteLine("`description` text,");
                writer.WriteLine("`created` datetime DEFAULT NULL,");
                writer.WriteLine("`membershipRequired` enum('None','Premium') DEFAULT NULL,");
                writer.WriteLine("`owners` longtext,");
                writer.WriteLine("`price` int DEFAULT NULL,");
                writer.WriteLine("`type` enum('Back','Front','Face','Shirt','Pants','T-Shirt','Cosmetic','Hat','Face Accessory','Gear') DEFAULT NULL,");
                writer.WriteLine("`isLimited` int DEFAULT '0',");
                writer.WriteLine("`isEquippable` int DEFAULT '1',");
                writer.WriteLine("`copies` int DEFAULT NULL,");
                writer.WriteLine("`icon` text,");
                writer.WriteLine("`obj` longtext,");
                writer.WriteLine("`mtl` longtext,");
                writer.WriteLine("`texture` longtext,");
                writer.WriteLine("`creator` int DEFAULT '1',");
                writer.WriteLine("PRIMARY KEY (`id`),");
                writer.WriteLine("UNIQUE KEY `name` (`name`)");
                writer.WriteLine(") ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;");
                writer.WriteLine("");
                writer.WriteLine("INSERT INTO `catalog` (`id`, `name`, `displayname`, `description`, `created`, `membershipRequired`, `owners`, `price`, `type`, `isLimited`, `isEquippable`, `copies`, `icon`, `obj`, `mtl`, `texture`, `creator`) VALUES");
                writer.WriteLine("(-3, 'pants1', 'Testing Pants', 'This is test pants.', '2021-04-24 22:34:44', 'None', '[]', -1, 'Pants', 0, 1, NULL, '/Catalog/Pants/Pants.png', NULL, NULL, '/Catalog/Pants/Pants.png', 1),");
                writer.WriteLine("(-2, 'shirt1', 'Testing Shirt', 'This is a test shirt.', '2021-04-24 22:34:44', 'None', '[]', -1, 'Shirt', 0, 1, NULL, '/Catalog/Shirts/Shirt.png', NULL, NULL, '/Catalog/Shirts/Shirt.png', 1),");
                writer.WriteLine("(-1, 'testitem', 'Testing Item', 'A test item for testing out new features on the catalog.', '2021-04-15 23:13:13', 'Premium', '[]', -1, 'Cosmetic', 0, 0, NULL, '/assets/images/testicon-2.png', NULL, NULL, NULL, 1),");
                writer.WriteLine("(0, 'masonissupercool', 'mapleson', 'only mason idiots', '2021-06-10 13:44:35', 'Premium', '[]', -1, 'Face', 1, 1, NULL, 'https://i.imgur.com/oODFyP6.png', NULL, NULL, 'https://i.imgur.com/oODFyP6.png', 1),");
                writer.WriteLine("(1, 'Roxy-Pin', 'Roxy Pin', 'Show off your true dog kindness!', '2021-04-16 21:04:56', 'None', '[]', -1, 'Cosmetic', 0, 0, NULL, '/assets/images/catalog/roxy-pin.png', '/Catalog/Hats/1b234298.obj', '/Catalog/Hats/1b234298.mtl', NULL, 1),");
                writer.WriteLine("(2, 'Beta-Tester-Ribbon', 'Beta Tester Ribbon', 'This item is only available during the Beta Testing period which was available from 19/04/2021 to sometime in the future.', '2021-04-19 21:00:36', 'None', '[]', 0, 'Cosmetic', 0, 0, NULL, '/assets/images/catalog/beta-tester-ribbon.png', '/Catalog/Hats/1d653684.obj', '/Catalog/Hats/1d653684.mtl', NULL, 1),");
                writer.WriteLine("(3, 'Pesky-Bee', 'Bee', 'This buzzer is very PESKY!', '2021-04-20 12:54:10', 'None', '[]', -1, 'Cosmetic', 0, 0, NULL, '/assets/images/catalog/bee.png', NULL, NULL, NULL, 1),");
                writer.WriteLine("(4, 'Stultus-Aprilis', 'Stultus Aprilis', 'Non te deseram.', '2021-04-20 13:19:25', 'Premium', '[]', -1, 'Cosmetic', 0, 0, NULL, '/assets/images/catalog/stultus-aprilis.png', NULL, NULL, NULL, 1),");
                writer.WriteLine("(5, 'Default-Face', 'Default Face', 'Owners for this item will <b>NOT</b> be set.', '2021-04-24 22:26:07', 'None', '[]', -1, 'Face', 0, 1, NULL, 'https://cdn.jsdelivr.net/gh/RED7Studios/RED7Community-CDN@main/Catalog/Faces/Face.png', NULL, NULL, '/Catalog/Faces/Face.png', 1),");
                writer.WriteLine("(6, 'Gold-Tophat', 'Gold Tophat', 'Bring out your riches with this tophat.', '2021-04-25 17:00:51', 'None', '[]', 500, 'Hat', 0, 1, NULL, 'https://cdn.jsdelivr.net/gh/RED7Studios/RED7Community-CDN@main/Catalog/Hats/Gold-Tophat-Render.png', '/Catalog/Hats/Gold-Tophat.obj', '/Catalog/Hats/Gold-Tophat.mtl', NULL, 1),");
                writer.WriteLine("(7, 'Beta-Tester-Hat', 'Beta Tester Hat', 'This item is only available during the Beta Testing period which was available from 19/04/2021 to sometime in the future.', '2021-04-25 17:00:51', 'None', '[]', 0, 'Hat', 0, 1, 999999, 'https://cdn.jsdelivr.net/gh/RED7Studios/RED7Community-CDN@main/Catalog/Hats/Beta-Tester-Hat-Render.png', '/Catalog/Hats/Beta-Tester-Hat.obj', '/Catalog/Hats/Beta-Tester-Hat.mtl', NULL, 1),");
                writer.WriteLine("(8, 'Black-Pants', 'Black Pants', 'Be stylish with these pants!', '2021-04-24 22:34:44', 'None', '[]', 0, 'Pants', 0, 1, NULL, 'https://cdn.jsdelivr.net/gh/RED7Studios/RED7Community-CDN@main/Catalog/Pants/Black-Pants-Render.png', NULL, '', '/Catalog/Pants/Black-Pants.png', 1),");
                writer.WriteLine("(9, 'Purple-Hoodie', 'Purple Hoodie', 'A free hoodie to get you started!', '2021-04-25 17:00:51', 'None', '[]', 0, 'Shirt', 0, 1, NULL, 'https://cdn.jsdelivr.net/gh/RED7Studios/RED7Community-CDN@main/Catalog/Shirts/Purple-Hoodie-Render.png', '', '', '/Catalog/Shirts/Purple-Hoodie.png', 1),");
                writer.WriteLine("(10, 'Diamond-Encrusted-Sunglasses', 'Diamond Encrusted Sunglasses', 'Show off your richness with these sunglasses.', '2021-04-28 12:18:54', 'None', '[]', 50000, 'Face Accessory', 1, 1, 100, 'https://cdn.jsdelivr.net/gh/RED7Studios/RED7Community-CDN@main/Catalog/Hats/Diamond-Encrusted-Sunglasses-Render.png', '/Catalog/Hats/Diamond-Encrusted-Sunglasses.obj', '/Catalog/Hats/Diamond-Encrusted-Sunglasses.mtl', NULL, 1),");
                writer.WriteLine("(11, 'Star-Pin', 'Star Pin', 'You are really a STAR! | Original by printable_models on Free3D', '2021-04-28 13:21:43', 'None', '[]', 50, 'Front', 0, 1, NULL, 'https://cdn.jsdelivr.net/gh/RED7Studios/RED7Community-CDN@main/Catalog/Hats/Star-Pin-Render.png', '/Catalog/Hats/Star-Pin.obj', '/Catalog/Hats/Star-Pin.mtl', NULL, 1),");
                writer.WriteLine("(12, 'Crown', 'Crown', 'You are honored! | Original by printable_models on Free3D', '2021-04-28 13:48:43', 'None', '[]', 50, 'Hat', 0, 1, NULL, 'https://cdn.jsdelivr.net/gh/RED7Studios/RED7Community-CDN@main/Catalog/Hats/Crown-Render.png', '/Catalog/Hats/Crown.obj', '/Catalog/Hats/Crown.mtl', NULL, 1),");
                writer.WriteLine("(13, 'Hackvent-1-Hat', 'Hackvent #1 Hat', 'This item is only available from the first Hackvent. Redeem this code to get something special! M@tr1x1', '2021-04-29 14:58:04', 'None', '[1,6]', -1, 'Hat', 0, 1, NULL, 'https://cdn.jsdelivr.net/gh/RED7Studios/RED7Community-CDN@main/Catalog/Hats/Hackvent-1-Hat-Render.png', '/Catalog/Hats/Beta-Tester-Hat.obj', '/Catalog/Hats/Hackvent-1-Hat.mtl', NULL, 1),");
                writer.WriteLine("(14, 'Matrix-Shirt', 'Matrix Shirt', 'This item is only available from the first Hackvent.', '2021-04-25 17:00:51', 'None', '[]', -1, 'Shirt', 0, 1, NULL, 'https://cdn.jsdelivr.net/gh/RED7Studios/RED7Community-CDN@main/Catalog/Shirts/Matrix-Shirt-Render.png', '', '', '/Catalog/Shirts/Matrix-Shirt.png', 1),");
                writer.WriteLine("(15, 'Matrix-Pants', 'Matrix Pants', 'This item is only available from the first Hackvent.', '2021-04-25 17:00:51', 'None', '[]', -1, 'Pants', 0, 1, NULL, 'https://cdn.jsdelivr.net/gh/RED7Studios/RED7Community-CDN@main/Catalog/Shirts/Matrix-Shirt-Render.png', '', '', '/Catalog/Shirts/Matrix-Shirt.png', 1),");
                writer.WriteLine("(16, 'M@tr1x1', 'M@tr1x1', 'Look at the Hackvent #1 Cap, challenger.', '2021-05-01 12:48:08', 'None', '[]', -1, 'Hat', 1, 1, 1, NULL, NULL, NULL, NULL, 1),");
                writer.WriteLine("(17, 'Ban-Hammer', 'Ban Hammer', 'This hammer is only given out to those who are trusted.', '2021-05-03 06:56:00', 'None', '[]', -1, 'Gear', 0, 1, 0, 'https://cdn.jsdelivr.net/gh/RED7Studios/RED7Community-CDN@main/Catalog/Gear/Ban-Hammer-Render.png', '/Catalog/Gear/Ban-Hammer.obj', '/Catalog/Gear/Ban-Hammer.mtl', NULL, 1),");
                writer.WriteLine("(18, 'Mitchells-Shirt', 'Black Hoodie', 'Thats stealthy!', '2021-04-25 17:00:51', 'None', '[]', 5, 'Shirt', 0, 1, NULL, 'https://cdn.jsdelivr.net/gh/RED7Studios/RED7Community-CDN@main/Catalog/Shirts/Mitchells-Shirt-Render.png', '', '', '/Catalog/Shirts/Mitchells-Shirt.png', 1),");
                writer.WriteLine("(19, 'Mitchells-Hat', 'Mitchells Hat', 'Exclusive item to Mitchells account.', '2021-04-25 17:00:51', 'None', '[]', -1, 'Hat', 0, 1, 999999, 'https://cdn.jsdelivr.net/gh/RED7Studios/RED7Community-CDN@main/Catalog/Hats/Mitchells-Hat-Render.png', '/Catalog/Hats/Beta-Tester-Hat.obj', '/Catalog/Hats/Mitchells-Hat.mtl', NULL, 1),");
                writer.WriteLine("(20, 'Toilet', 'Toilet', 'Son, how did you get that on your head?', '2021-04-28 13:48:43', 'None', '[]', 500, 'Hat', 0, 1, NULL, 'https://cdn.jsdelivr.net/gh/RED7Studios/RED7Community-CDN@main/Catalog/Hats/Toilet-Render.png', '/Catalog/Hats/Toilet.obj', '/Catalog/Hats/Toilet.mtl', NULL, 1),");
                writer.WriteLine("(21, 'TAA-Shirt', 'TAA Shirt', 'Exclusive item to Mitchells account.', '2021-06-06 00:00:51', 'None', '[]', -1, 'Shirt', 0, 1, NULL, 'https://cdn.jsdelivr.net/gh/RED7Studios/RED7Community-CDN@main/Catalog/Shirts/Mitchells-Shirt-Render.png', '', '', '/Catalog/Shirts/TAA-Shirt.png', 1),");
                writer.WriteLine("(22, 'White-Hat', 'White Hat of Goodness', 'This hat can only be obtained through the Bug Hunting Program.', '2021-06-06 01:00:51', 'None', '[]', -1, 'Hat', 0, 1, 999999, 'https://cdn.jsdelivr.net/gh/RED7Studios/RED7Community-CDN@main/Catalog/Hats/White-Hat-Render.png', '/Catalog/Hats/Beta-Tester-Hat.obj', '/Catalog/Hats/White-Hat.mtl', NULL, 1),");
                writer.WriteLine("(23, 'Dominus-Hood', 'Dominus Hood', 'Less expensive dominus hood', '2021-06-06 01:00:51', 'None', '[]', -1, 'Hat', 0, 1, 999999, 'https://cdn.jsdelivr.net/gh/RED7Studios/RED7Community-CDN@main/Catalog/Hats/Dominus-Hood-Render.png', '/Catalog/Hats/Dominus-Hood.obj', '/Catalog/Hats/Dominus-Hood.mtl', NULL, 9);");
                writer.WriteLine("");
                writer.WriteLine("CREATE TABLE IF NOT EXISTS `codes` (");
                writer.WriteLine("`id` int NOT NULL AUTO_INCREMENT,");
                writer.WriteLine("`name` text,");
                writer.WriteLine("`code` text,");
                writer.WriteLine("`currency` bigint DEFAULT NULL,");
                writer.WriteLine("`items` longtext,");
                writer.WriteLine("PRIMARY KEY (`id`)");
                writer.WriteLine(") ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb3;");
                writer.WriteLine("");
                writer.WriteLine("CREATE TABLE IF NOT EXISTS `contact` (");
                writer.WriteLine("`id` bigint NOT NULL,");
                writer.WriteLine("`user_name` varchar(100) NOT NULL,");
                writer.WriteLine("`user_email` varchar(255) NOT NULL,");
                writer.WriteLine("`subject` varchar(255) NOT NULL,");
                writer.WriteLine("`content` text NOT NULL");
                writer.WriteLine(") ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;");
                writer.WriteLine("");
                writer.WriteLine("CREATE TABLE IF NOT EXISTS `memberships` (");
                writer.WriteLine("`id` bigint NOT NULL DEFAULT '0',");
                writer.WriteLine("`name` varchar(255) DEFAULT 'Premium',");
                writer.WriteLine("`payoutAmount` varchar(255) DEFAULT '400',");
                writer.WriteLine("`isEveryWeek` bigint DEFAULT NULL,");
                writer.WriteLine("`isEveryDay` bigint DEFAULT NULL,");
                writer.WriteLine("`cost` varchar(255) DEFAULT '6.99',");
                writer.WriteLine("PRIMARY KEY (`id`)");
                writer.WriteLine(") ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;");
                writer.WriteLine("");
                writer.WriteLine("INSERT INTO `memberships` (`id`, `name`, `payoutAmount`, `isEveryWeek`, `isEveryDay`, `cost`) VALUES");
                writer.WriteLine("(1, 'Premium450', '450', 1, 0, '6.99'),");
                writer.WriteLine("(2, 'Premium1000', '1000', 1, 0, '13.99'),");
                writer.WriteLine("(3, 'Premium2200', '2200', 1, 0, '28.99'),");
                writer.WriteLine("(4, 'PremiumDaily450', '450', 0, 1, '10.99'),");
                writer.WriteLine("(5, 'PremiumDaily2200', '2200', 0, 1, '38.99'),");
                writer.WriteLine("(6, 'PremiumDaily1000', '1000', 0, 1, '17.99');");
                writer.WriteLine("");
                writer.WriteLine("CREATE TABLE IF NOT EXISTS `relation` (");
                writer.WriteLine("`from` bigint NOT NULL DEFAULT '0',");
                writer.WriteLine("`to` bigint NOT NULL DEFAULT '0',");
                writer.WriteLine("`status` varchar(1) NOT NULL,");
                writer.WriteLine("`since` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,");
                writer.WriteLine("PRIMARY KEY (`from`,`to`,`status`),");
                writer.WriteLine("KEY `since` (`since`)");
                writer.WriteLine(") ENGINE=InnoDB DEFAULT CHARSET=latin1;");
                writer.WriteLine("");
                writer.WriteLine("CREATE TABLE IF NOT EXISTS `site_info` (");
                writer.WriteLine("`id` int NOT NULL AUTO_INCREMENT,");
                writer.WriteLine("`name` text NOT NULL,");
                writer.WriteLine("`content` text NOT NULL,");
                writer.WriteLine("PRIMARY KEY (`id`)");
                writer.WriteLine(") ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb3;");
                writer.WriteLine("");
                writer.WriteLine("INSERT INTO `site_info` (`id`, `name`, `content`) VALUES");
                writer.WriteLine("(1, 'site_name', '" + ss_siteName.Text + "'),");
                writer.WriteLine("(2, 'registration', '" + ss_registration.Text + "'),");
                writer.WriteLine("(3, 'currency', '" + ss_currencyName.Text + "'),");
                writer.WriteLine("(4, 'premiumIcon', '" + ss_premiumIcon.Text + "'),");
                writer.WriteLine("(5, 'verifiedIcon', '" + ss_verifiedIcon.Text + "'),");
                writer.WriteLine("(6, 'appealEmail', '" + ss_appealEmail.Text + "'),");
                writer.WriteLine("(7, 'maintenanceMode', '" + ss_maintenanceMode.Text + "');");
                writer.WriteLine("");
                writer.WriteLine("CREATE TABLE IF NOT EXISTS `users` (");
                writer.WriteLine("`id` bigint NOT NULL AUTO_INCREMENT,");
                writer.WriteLine("`username` varchar(100) NOT NULL,");
                writer.WriteLine("`displayname` varchar(100) DEFAULT NULL,");
                writer.WriteLine("`email` varchar(100) DEFAULT NULL,");
                writer.WriteLine("`password` varchar(100) NOT NULL,");
                writer.WriteLine("`description` text,");
                writer.WriteLine("`created_at` datetime DEFAULT CURRENT_TIMESTAMP,");
                writer.WriteLine("`lastLoginDate` date DEFAULT NULL,");
                writer.WriteLine("`lastLogin` datetime DEFAULT NULL,");
                writer.WriteLine("`currency` bigint DEFAULT '0',");
                writer.WriteLine("`badges` longtext,");
                writer.WriteLine("`items` longtext,");
                writer.WriteLine("`membership` enum('None','Premium450','Premium1000','Premium2200','PremiumDaily450','PremiumDaily1000','PremiumDaily2200') DEFAULT NULL,");
                writer.WriteLine("`isBanned` int DEFAULT '0',");
                writer.WriteLine("`bannedReason` text,");
                writer.WriteLine("`bannedDate` datetime DEFAULT NULL,");
                writer.WriteLine("`isAdmin` int DEFAULT '0',");
                writer.WriteLine("`isVerified` int DEFAULT '0',");
                writer.WriteLine("`followers` longtext,");
                writer.WriteLine("`following` longtext,");
                writer.WriteLine("`clans` longtext,");
                writer.WriteLine("`icon` varchar(255) DEFAULT '/assets/images/users/default.png',");
                writer.WriteLine("PRIMARY KEY (`id`),");
                writer.WriteLine("UNIQUE KEY `username` (`username`)");
                writer.WriteLine(") ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb3;");
                writer.WriteLine("");
                writer.WriteLine("INSERT INTO `users` (`id`, `username`, `displayname`, `email`, `password`, `description`, `created_at`, `lastLoginDate`, `lastLogin`, `currency`, `badges`, `items`, `membership`, `isBanned`, `bannedReason`, `bannedDate`, `isAdmin`, `isVerified`, `followers`, `following`, `clans`, `icon`) VALUES");
                writer.WriteLine("(1, '" + mu_username.Text + "', '" + mu_username.Text + "', NULL, '$2y$10$wpjoA7MtKAx01nMxmhCE.Ofj.v5Xb1.dQuq4q89AiSPA5KwxV0Lia', '', '2021-02-27 22:59:37', '2021-06-10', '2021-06-10 13:48:55', " + mu_currency.Text + ", '[1,2,3]', '[1]', 'PremiumDaily2200', 0, NULL, NULL, 1, 1, '[]', '[]', '[]', 'https://www.gravatar.com/avatar/?s=180&d=mp&r=g'),                                                                                                                                                                                                                                                                                      (9, 'Not Found', 'Not Found', 'temp@temp.temp', '', 'This account is reserved to make sure that no-one accidentally creates it and gets locked out.', '2021-05-20 21:41:12', NULL, NULL, 0, '[]', '[]', 'None', 1, 'Reserved.', '2021-05-20 21:41:28', 0, 0, '[]', '[]', '[]', 'https://www.gravatar.com/avatar/8f79d54d603c0523c095d7e1e8dd37e5?s=180');");
                writer.WriteLine("CREATE TABLE IF NOT EXISTS `transactions` (");
                writer.WriteLine("  `id` int NOT NULL AUTO_INCREMENT,");
                writer.WriteLine("  `cust_name` varchar(50) NOT NULL DEFAULT '',");
                writer.WriteLine("  `cust_email` varchar(50) NOT NULL DEFAULT '',");
                writer.WriteLine("  `item_name` varchar(50) NOT NULL DEFAULT '',");
                writer.WriteLine("  `item_number` varchar(50) NOT NULL DEFAULT '',");
                writer.WriteLine("  `item_price` int NOT NULL DEFAULT '0',");
                writer.WriteLine("  `item_price_currency` varchar(50) NOT NULL DEFAULT '',");
                writer.WriteLine("  `paid_amount` int NOT NULL DEFAULT '0',");
                writer.WriteLine("  `paid_amount_currency` varchar(50) NOT NULL DEFAULT '',");
                writer.WriteLine("  `txn_id` varchar(50) NOT NULL DEFAULT '',");
                writer.WriteLine("  `payment_status` varchar(50) NOT NULL DEFAULT '',");
                writer.WriteLine("  `created` datetime NOT NULL,");
                writer.WriteLine("  `modified` datetime NOT NULL,");
                writer.WriteLine("  PRIMARY KEY (`id`)");
                writer.WriteLine(") ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb3;");

                MessageBox.Show("DONE! Please check the 'Generated' folder to see if the following files were generated: 'config.php', 'DB.sql'", "Generated", MessageBoxButtons.OK, MessageBoxIcon.Information);
            }
        }

        private void frmMain_Load(object sender, EventArgs e)
        {

        }
    }
}
