/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dumping database structure for red7community
CREATE DATABASE IF NOT EXISTS `red7community` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `red7community`;

-- Dumping structure for table red7community.apikeys
CREATE TABLE IF NOT EXISTS `apikeys` (
  `id` bigint NOT NULL DEFAULT '0',
  `api_key` varchar(25) NOT NULL,
  `owner_id` bigint DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE KEY `key` (`api_key`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- Dumping data for table red7community.apikeys: ~3 rows (approximately)
/*!40000 ALTER TABLE `apikeys` DISABLE KEYS */;
INSERT INTO `apikeys` (`id`, `api_key`, `owner_id`) VALUES
	(1, 'ThisIsTheSitesKey', 1);
/*!40000 ALTER TABLE `apikeys` ENABLE KEYS */;

-- Dumping structure for table red7community.avatars
CREATE TABLE IF NOT EXISTS `avatars` (
  `ownerid` bigint NOT NULL DEFAULT '0',
  `items` longtext,
  `shirt` int DEFAULT NULL,
  `pants` int DEFAULT NULL,
  `face` int DEFAULT NULL,
  PRIMARY KEY (`ownerid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- Dumping data for table red7community.avatars: ~0 rows (approximately)
/*!40000 ALTER TABLE `avatars` DISABLE KEYS */;
INSERT INTO `avatars` (`ownerid`, `items`, `shirt`, `pants`, `face`) VALUES
	(1, '[]', 3, 2, 1),
	(2, '[]', 3, 2, 1);
/*!40000 ALTER TABLE `avatars` ENABLE KEYS */;

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
/*!40000 ALTER TABLE `badges` DISABLE KEYS */;
INSERT INTO `badges` (`id`, `name`, `displayname`, `description`, `icon`) VALUES
	(1, 'Administrator', 'Administrator', 'The official admin badge.', 'https://cdn.jsdelivr.net/gh/RED7Studios/RED7Community-CDN@main/Catalog/Badges/administrator.png');
/*!40000 ALTER TABLE `badges` ENABLE KEYS */;

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

-- Dumping data for table red7community.catalog: ~28 rows (approximately)
/*!40000 ALTER TABLE `catalog` DISABLE KEYS */;
INSERT INTO `catalog` (`id`, `name`, `displayname`, `description`, `created`, `membershipRequired`, `owners`, `price`, `type`, `isLimited`, `isEquippable`, `copies`, `icon`, `obj`, `mtl`, `texture`, `creator`) VALUES
	(1, 'Default-Face', 'Default Face', 'Owners for this item will <b>NOT</b> be set.', '2021-04-24 22:26:07', 'None', '[1,2]', -1, 'Face', 0, 1, NULL, 'https://cdn.jsdelivr.net/gh/RED7Studios/RED7Community-CDN@main/Catalog/Faces/Face.png', NULL, NULL, '/Catalog/Faces/Face.png', 1),
	(2, 'Black-Pants', 'Black Pants', 'Be stylish with these pants!', '2021-04-24 22:34:44', 'None', '[1,2,6,5,15,14,12]', 0, 'Pants', 0, 1, NULL, 'https://cdn.jsdelivr.net/gh/RED7Studios/RED7Community-CDN@main/Catalog/Pants/Black-Pants-Render.png', NULL, '', '/Catalog/Pants/Black-Pants.png', 1),
	(3, 'Purple-Hoodie', 'Purple Hoodie', 'A free hoodie to get you started!', '2021-04-25 17:00:51', 'None', '[1,2,6,5,15,12,12,16]', 0, 'Shirt', 0, 1, NULL, 'https://cdn.jsdelivr.net/gh/RED7Studios/RED7Community-CDN@main/Catalog/Shirts/Purple-Hoodie-Render.png', '', '', '/Catalog/Shirts/Purple-Hoodie.png', 1);
/*!40000 ALTER TABLE `catalog` ENABLE KEYS */;

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

-- Dumping data for table red7community.games: ~2 rows (approximately)
/*!40000 ALTER TABLE `games` DISABLE KEYS */;
INSERT INTO `games` (`id`, `name`, `displayname`, `description`, `created_at`, `isDeleted`, `isBanned`, `banReason`, `banDate`, `javascript`, `icon`, `ownerid`) VALUES
	(1, 'Test', 'Testing Game', 'This is a test game.\r\nDo not play.', '2021-07-26 12:36:00', 0, 0, NULL, NULL, 'window.game=window.game||{};window.game.core=function(){var _game={player:{model:null,mesh:null,shape:null,rigidBody:null,mass:3,orientationConstraint:null,isGrounded:false,jumpHeight:50,speed:1.5,speedMax:45,rotationSpeed:0.007,rotationSpeedMax:0.1,rotationRadians:new THREE.Vector3(0,0,0),rotationAngleX:null,rotationAngleY:null,damping:0.1,rotationDamping:0.8,acceleration:0,rotationAcceleration:0,playerAccelerationValues:{position:{acceleration:"acceleration",speed:"speed",speedMax:"speedMax"},rotation:{acceleration:"rotationAcceleration",speed:"rotationSpeed",speedMax:"rotationSpeedMax"}},playerCoords:null,cameraCoords:null,cameraOffsetH:300,cameraOffsetV:140,controlKeys:{forward:"w",backward:"s",left:"a",right:"d",jump:"space"},create:function(){_cannon.playerPhysicsMaterial=new CANNON.Material("playerMaterial");_game.player.model=_three.createModel(window.game.models.player,12,[new THREE.MeshLambertMaterial({color:window.game.static.colors.cyan,shading:THREE.FlatShading}),new THREE.MeshLambertMaterial({color:window.game.static.colors.green,shading:THREE.FlatShading})]);_game.player.shape=new CANNON.Box(_game.player.model.halfExtents);_game.player.rigidBody=new CANNON.RigidBody(_game.player.mass,_game.player.shape,_cannon.createPhysicsMaterial(_cannon.playerPhysicsMaterial));_game.player.rigidBody.position.set(0,0,50);_game.player.mesh=_cannon.addVisual(_game.player.rigidBody,null,_game.player.model.mesh);_game.player.mesh.castShadow=true;_game.player.mesh.receiveShadow=true;_game.player.orientationConstraint=new CANNON.HingeConstraint(_game.player.rigidBody,new CANNON.Vec3(0,0,0),new CANNON.Vec3(0,0,1),_game.player.rigidBody,new CANNON.Vec3(0,0,1),new CANNON.Vec3(0,0,1));_cannon.world.addConstraint(_game.player.orientationConstraint);_game.player.rigidBody.postStep=function(){_game.player.rigidBody.angularVelocity.z=0;_game.player.updateOrientation()};_game.player.rigidBody.addEventListener("collide",function(event){if(!_game.player.isGrounded){_game.player.isGrounded=(new CANNON.Ray(_game.player.mesh.position,new CANNON.Vec3(0,0,-1)).intersectBody(event.contact.bi).length>0)}})},update:function(){_game.player.processUserInput();_game.player.accelerate();_game.player.rotate();_game.player.updateCamera();_game.player.checkGameOver()},updateCamera:function(){_game.player.cameraCoords=window.game.helpers.polarToCartesian(_game.player.cameraOffsetH,_game.player.rotationRadians.z);_three.camera.position.x=_game.player.mesh.position.x+_game.player.cameraCoords.x;_three.camera.position.y=_game.player.mesh.position.y+_game.player.cameraCoords.y;_three.camera.position.z=_game.player.mesh.position.z+_game.player.cameraOffsetV;_three.camera.lookAt(_game.player.mesh.position)},updateAcceleration:function(values,direction){if(direction===1){if(_game.player[values.acceleration]> -_game.player[values.speedMax]){if(_game.player[values.acceleration]>=_game.player[values.speedMax]/2){_game.player[values.acceleration]= -(_game.player[values.speedMax]/4)}else{_game.player[values.acceleration]-=_game.player[values.speed]}}else{_game.player[values.acceleration]= -_game.player[values.speedMax]}}else{if(_game.player[values.acceleration]<_game.player[values.speedMax]){if(_game.player[values.acceleration]<= -(_game.player[values.speedMax]/2)){_game.player[values.acceleration]=_game.player[values.speedMax]/4}else{_game.player[values.acceleration]+=_game.player[values.speed]}}else{_game.player[values.acceleration]=_game.player[values.speedMax]}}},processUserInput:function(){if(_events.keyboard.pressed[_game.player.controlKeys.jump]){_game.player.jump()}if(_events.keyboard.pressed[_game.player.controlKeys.forward]){_game.player.updateAcceleration(_game.player.playerAccelerationValues.position,1);if(!_cannon.getCollisions(_game.player.rigidBody.index)){_game.player.rigidBody.quaternion.setFromAxisAngle(new CANNON.Vec3(0,0,1),_game.player.rotationRadians.z)}}if(_events.keyboard.pressed[_game.player.controlKeys.backward]){_game.player.updateAcceleration(_game.player.playerAccelerationValues.position,-1)}if(_events.keyboard.pressed[_game.player.controlKeys.right]){_game.player.updateAcceleration(_game.player.playerAccelerationValues.rotation,1)}if(_events.keyboard.pressed[_game.player.controlKeys.left]){_game.player.updateAcceleration(_game.player.playerAccelerationValues.rotation,-1)}},accelerate:function(){_game.player.playerCoords=window.game.helpers.polarToCartesian(_game.player.acceleration,_game.player.rotationRadians.z);_game.player.rigidBody.velocity.set(_game.player.playerCoords.x,_game.player.playerCoords.y,_game.player.rigidBody.velocity.z);if(!_events.keyboard.pressed[_game.player.controlKeys.forward]&&!_events.keyboard.pressed[_game.player.controlKeys.backward]){_game.player.acceleration*=_game.player.damping}},rotate:function(){_cannon.rotateOnAxis(_game.player.rigidBody,new CANNON.Vec3(0,0,1),_game.player.rotationAcceleration);if(!_events.keyboard.pressed[_game.player.controlKeys.left]&&!_events.keyboard.pressed[_game.player.controlKeys.right]){_game.player.rotationAcceleration*=_game.player.rotationDamping}},jump:function(){if(_cannon.getCollisions(_game.player.rigidBody.index)&&_game.player.isGrounded){_game.player.isGrounded=false;_game.player.rigidBody.velocity.z=_game.player.jumpHeight}},updateOrientation:function(){_game.player.rotationRadians=new THREE.Euler().setFromQuaternion(_game.player.rigidBody.quaternion);_game.player.rotationAngleX=Math.round(window.game.helpers.radToDeg(_game.player.rotationRadians.x));_game.player.rotationAngleY=Math.round(window.game.helpers.radToDeg(_game.player.rotationRadians.y));if((_cannon.getCollisions(_game.player.rigidBody.index)&&((_game.player.rotationAngleX>=90)||(_game.player.rotationAngleX<=-0)||(_game.player.rotationAngleY>=0)||(_game.player.rotationAngleY<=-0)))){_game.player.rigidBody.quaternion.setFromAxisAngle(new CANNON.Vec3(0,0,1),_game.player.rotationRadians.z)}},checkGameOver:function(){if(_game.player.mesh.position.z<=-800){_game.destroy()}}},level:{create:function(){_cannon.solidMaterial=_cannon.createPhysicsMaterial(new CANNON.Material("solidMaterial"),0,0.1);var floorSize=800;var floorHeight=20;_cannon.createRigidBody({shape:new CANNON.Box(new CANNON.Vec3(floorSize,floorSize,floorHeight)),mass:0,position:new CANNON.Vec3(0,0,-floorHeight),meshMaterial:new THREE.MeshLambertMaterial({color:window.game.static.colors.black}),physicsMaterial:_cannon.solidMaterial});_cannon.createRigidBody({shape:new CANNON.Box(new CANNON.Vec3(15,15,15)),mass:1,position:new CANNON.Vec3(90,-420,200),meshMaterial:new THREE.MeshLambertMaterial({color:window.game.static.colors.soccer}),physicsMaterial:_cannon.solidMaterial});_cannon.createRigidBody({shape:new CANNON.Box(new CANNON.Vec3(15,15,15)),mass:1,position:new CANNON.Vec3(90,420,200),meshMaterial:new THREE.MeshLambertMaterial({color:window.game.static.colors.soccer}),physicsMaterial:_cannon.solidMaterial});var grid=new THREE.GridHelper(floorSize,floorSize/10);grid.position.z=0.5;grid.rotation.x=window.game.helpers.degToRad(90);_three.scene.add(grid)}},init:function(options){_game.initComponents(options);_game.player.create();_game.level.create();_game.loop()},destroy:function(){window.cancelAnimationFrame(_animationFrameLoop);_cannon.destroy();_cannon.setup();_three.destroy();_three.setup();_game.player=window.game.helpers.cloneObject(_gameDefaults.player);_game.level=window.game.helpers.cloneObject(_gameDefaults.level);_game.player.create();_game.level.create();_game.loop()},loop:function(){_animationFrameLoop=window.requestAnimationFrame(_game.loop);_cannon.updatePhysics();_game.player.update();_three.render()},initComponents:function(options){_events=window.game.events();_three=window.game.three();_cannon=window.game.cannon();_ui=window.game.ui();_three.setupLights=function(){var hemiLight=new THREE.HemisphereLight(window.game.static.colors.white,window.game.static.colors.white,0.6);hemiLight.position.set(0,0,-1);_three.scene.add(hemiLight);var pointLight=new THREE.PointLight(window.game.static.colors.white,0.5);pointLight.position.set(0,0,500);_three.scene.add(pointLight)};_three.init(options);_cannon.init(_three);_ui.init();_events.init()}};var _events;var _three;var _cannon;var _ui;var _animationFrameLoop;var _gameDefaults={player:window.game.helpers.cloneObject(_game.player),level:window.game.helpers.cloneObject(_game.level)};return _game};', 'https://www.gravatar.com/avatar/9704081724603d5dc949cdae05c0b622?s=180', 1);
/*!40000 ALTER TABLE `games` ENABLE KEYS */;

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
/*!40000 ALTER TABLE `memberships` DISABLE KEYS */;
INSERT INTO `memberships` (`id`, `name`, `payoutAmount`, `isEveryWeek`, `isEveryDay`, `cost`) VALUES
	(1, 'Premium450', '450', 1, 0, '6.99'),
	(2, 'Premium1000', '1000', 1, 0, '13.99'),
	(3, 'Premium2200', '2200', 1, 0, '28.99'),
	(4, 'PremiumDaily450', '450', 0, 1, '10.99'),
	(5, 'PremiumDaily2200', '2200', 0, 1, '38.99'),
	(6, 'PremiumDaily1000', '1000', 0, 1, '17.99');
/*!40000 ALTER TABLE `memberships` ENABLE KEYS */;

-- Dumping structure for table red7community.relation
CREATE TABLE IF NOT EXISTS `relation` (
  `from` bigint NOT NULL DEFAULT '0',
  `to` bigint NOT NULL DEFAULT '0',
  `status` varchar(1) NOT NULL,
  `since` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`from`,`to`,`status`),
  KEY `since` (`since`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table red7community.relation: ~0 rows (approximately)
/*!40000 ALTER TABLE `relation` DISABLE KEYS */;
INSERT INTO `relation` (`from`, `to`, `status`, `since`) VALUES
	(1, 2, 'F', '2021-04-20 20:01:50'),
	(2, 1, 'F', '2021-04-20 20:02:30');
/*!40000 ALTER TABLE `relation` ENABLE KEYS */;

-- Dumping structure for table red7community.site_info
CREATE TABLE IF NOT EXISTS `site_info` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` text NOT NULL,
  `content` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb3;

-- Dumping data for table red7community.site_info: ~0 rows (approximately)
/*!40000 ALTER TABLE `site_info` DISABLE KEYS */;
INSERT INTO `site_info` (`id`, `name`, `content`) VALUES
	(1, 'site_name', 'RED7Community'),
	(2, 'registration', 'on'),
	(3, 'currency', 'Bux'),
	(4, 'premiumIcon', 'https://cdn.jsdelivr.net/gh/RED7Studios/RED7Community-CDN@main/assets/images/premium.png'),
	(5, 'verifiedIcon', 'https://cdn.jsdelivr.net/gh/RED7Studios/RED7Community-CDN@main/assets/images/verified.png'),
	(6, 'appealEmail', 'appeals@redsevenstudios.com'),
	(7, 'maintenanceMode', 'off');
/*!40000 ALTER TABLE `site_info` ENABLE KEYS */;

-- Dumping structure for table red7community.transaction
CREATE TABLE IF NOT EXISTS `transaction` (
  `id` int NOT NULL AUTO_INCREMENT,
  `cust_name` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `cust_email` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `item_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `item_number` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `item_price` float(10,2) NOT NULL,
  `item_price_currency` varchar(10) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT 'usd',
  `paid_amount` varchar(10) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `paid_amount_currency` varchar(10) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `txn_id` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `payment_status` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;

-- Dumping data for table red7community.transaction: ~51 rows (approximately)
/*!40000 ALTER TABLE `transaction` DISABLE KEYS */;
/*!40000 ALTER TABLE `transaction` ENABLE KEYS */;

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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb3;

-- Dumping data for table red7community.users: ~0 rows (approximately)
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`id`, `username`, `displayname`, `email`, `password`, `description`, `created_at`, `lastLoginDate`, `lastLogin`, `currency`, `badges`, `items`, `membership`, `isBanned`, `bannedReason`, `bannedDate`, `isAdmin`, `isVerified`, `followers`, `following`, `clans`, `icon`) VALUES
	(1, 'RED7Community', 'RED7Community', NULL, '', '', '2021-02-27 22:59:37', '2021-06-10', '2021-06-10 13:48:55', -9223372036854775808, '[1]', '[1,2,3]', 'PremiumDaily2200', 0, NULL, NULL, 1, 1, '[]', '[]', '[]', 'https://www.gravatar.com/avatar/9704081724603d5dc949cdae05c0b622?s=180'),
	(2, 'admin', 'Admin', 'admin@red7community.ml', '$2y$10$mbWAAN9.Of8X/moTM.raMeJIYx3jkY9f1hoD2AuCC2IicasEC4imq', 'This is the default administrator account.', '2021-03-05 22:04:22', '2021-07-26', '2021-07-26 12:36:18', 1000039999, '[1]', '[1,2,3]', 'PremiumDaily2200', 0, '', '0000-00-00 00:00:00', 1, 1, '[]', '[]', '[]', 'https://www.gravatar.com/avatar/9704081724603d5dc949cdae05c0b622?s=180');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
