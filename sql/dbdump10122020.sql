-- MySQL dump 10.13  Distrib 8.0.19, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: glazpmck_ics325
-- ------------------------------------------------------
-- Server version	8.0.19

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `city`
--

DROP TABLE IF EXISTS `city`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `city` (
  `City_ID` int NOT NULL,
  `CityName` varchar(32) NOT NULL,
  `CityDescription` text,
  `map_x` double DEFAULT NULL,
  `map_y` double DEFAULT NULL,
  `Country` varchar(2) DEFAULT NULL,
  PRIMARY KEY (`City_ID`),
  KEY `Country_idx` (`Country`),
  CONSTRAINT `City_ID` FOREIGN KEY (`City_ID`) REFERENCES `sitemap` (`pageID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `city`
--

LOCK TABLES `city` WRITE;
/*!40000 ALTER TABLE `city` DISABLE KEYS */;
INSERT INTO `city` VALUES (7,'Qeqertarsuatsiaat','If you like a small-town getaway feel with treasure hunts and whales, then this is the location for you!',15,35,'GL'),(8,'Bad Kissingen','I know what you may be thinking… does the name of this region really speak for the millions of kissers that live there? It’s possible, but situations have not been reported. ',35,50,'DE'),(10,'Alice Springs','This location is geared more towards spring breakers. Australia is known for hot and hip culture.',76,82.5,'AU'),(12,'Los Angeles','Los Angeles is a water-park of dreams! Every year floods provide entertainment beyond your wildest dreams!',45,16,'US'),(13,'Mwanza','Africa has so many things to offer. Mwanza is practically off the grid, but be warned... this travel destination isn’t for the weak.',60,53,'TZ'),(16,'Snezhngorsk','This location is a closed city. You know what this means! It means that like spy movies, and other video games... the main goal is to infiltrate and become one with this city.',25,70,'RU');
/*!40000 ALTER TABLE `city` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `country`
--

DROP TABLE IF EXISTS `country`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `country` (
  `Country_ID` varchar(2) NOT NULL,
  `CountryName` varchar(32) NOT NULL,
  PRIMARY KEY (`Country_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `country`
--

LOCK TABLES `country` WRITE;
/*!40000 ALTER TABLE `country` DISABLE KEYS */;
INSERT INTO `country` VALUES ('AD','Andorra'),('AE','United Arab Emirates'),('AF','Afghanistan'),('AG','Antigua & Barbuda'),('AI','Anguilla'),('AL','Albania'),('AM','Armenia'),('AN','Netherland Antilles'),('AO','Angola'),('AR','Argentina'),('AS','American Samoa'),('AT','Austria'),('AU','Australia'),('AW','Aruba'),('AZ','Azerbaijan'),('BA','Bosnia & Herzegovina'),('BB','Barbados'),('BD','Bangladesh'),('BE','Belgium'),('BF','Burkina Faso'),('BG','Bulgaria'),('BH','Bahrain'),('BI','Burundi'),('BJ','Benin'),('BL','St Barthelemy'),('BM','Bermuda'),('BN','Brunei'),('BO','Bolivia'),('BQ','St Eustatius'),('BR','Brazil'),('BS','Bahamas'),('BT','Bhutan'),('BW','Botswana'),('BY','Belarus'),('BZ','Belize'),('CA','Canada'),('CC','Cocos Island'),('CF','Central African Republic'),('CG','Congo'),('CH','Switzerland'),('CI','Cote DIvoire'),('CK','Cook Islands'),('CL','Chile'),('CM','Cameroon'),('CN','China'),('CO','Colombia'),('CR','Costa Rica'),('CU','Cuba'),('CV','Cape Verde'),('CW','Curacao'),('CX','Christmas Island'),('CY','Cyprus'),('CZ','Czech Republic'),('DE','Germany'),('DJ','Djibouti'),('DK','Denmark'),('DM','Dominica'),('DO','Dominican Republic'),('DZ','Algeria'),('EC','Ecuador'),('EE','Estonia'),('EG','Egypt'),('ER','Eritrea'),('ES','Spain'),('ET','Ethiopia'),('FI','Finland'),('FJ','Fiji'),('FK','Falkland Islands'),('FO','Faroe Islands'),('FR','France'),('GA','Gabon'),('GB','United Kingdom'),('GE','Georgia'),('GF','French Guiana'),('GH','Ghana'),('GI','Gibraltar'),('GL','Greenland'),('GM','Gambia'),('GN','Guinea'),('GP','Guadeloupe'),('GQ','Equatorial Guinea'),('GR','Greece'),('GT','Guatemala'),('GU','Guam'),('GY','Guyana'),('HK','Hong Kong'),('HN','Honduras'),('HR','Croatia'),('HT','Haiti'),('HU','Hungary'),('IC','Canary Islands'),('ID','Indonesia'),('IE','Ireland'),('IL','Israel'),('IM','Isle of Man'),('IN','India'),('IO','British Indian Ocean Ter'),('IQ','Iraq'),('IR','Iran'),('IS','Iceland'),('IT','Italy'),('JE','Channel Islands'),('JM','Jamaica'),('JO','Jordan'),('JP','Japan'),('KE','Kenya'),('KG','Kyrgyzstan'),('KH','Cambodia'),('KI','Kiribati'),('KM','Comoros'),('KN','Nevis'),('KP','Korea North'),('KR','Korea South'),('KW','Kuwait'),('KY','Cayman Islands'),('KZ','Kazakhstan'),('LA','Laos'),('LB','Lebanon'),('LC','St Lucia'),('LI','Liechtenstein'),('LK','Sri Lanka'),('LR','Liberia'),('LS','Lesotho'),('LT','Lithuania'),('LU','Luxembourg'),('LV','Latvia'),('LY','Libya'),('MA','Morocco'),('MC','Monaco'),('MD','Moldova'),('ME','Montenegro'),('MF','St Maarten'),('MG','Madagascar'),('MH','Marshall Islands'),('MI','Midway Islands'),('MK','Macedonia'),('ML','Mali'),('MM','Myanmar'),('MN','Mongolia'),('MO','Macao'),('MP','Saipan'),('MQ','Martinique'),('MR','Mauritania'),('MS','Montserrat'),('MT','Malta'),('MU','Mauritius'),('MV','Maldives'),('MW','Malawi'),('MX','Mexico'),('MY','Malaysia'),('MZ','Mozambique'),('NA','Nambia'),('NC','New Caledonia'),('NE','Niger'),('NF','Norfolk Island'),('NG','Nigeria'),('NI','Nicaragua'),('NL','Netherlands (Holland, Europe)'),('NO','Norway'),('NP','Nepal'),('NR','Nauru'),('NU','Niue'),('NZ','New Zealand'),('OM','Oman'),('PA','Panama'),('PE','Peru'),('PF','French Polynesia'),('PG','Papua New Guinea'),('PH','Philippines'),('PK','Pakistan'),('PL','Poland'),('PM','St Pierre & Miquelon'),('PN','Pitcairn Island'),('PR','Puerto Rico'),('PS','Palestine'),('PT','Portugal'),('PW','Palau Island'),('PY','Paraguay'),('QA','Qatar'),('RE','Reunion'),('RO','Romania'),('RS','Serbia'),('RU','Russia'),('RW','Rwanda'),('SA','Saudi Arabia'),('SB','Solomon Islands'),('SC','Seychelles'),('SD','Sudan'),('SE','Sweden'),('SG','Singapore'),('SH','St Helena'),('SI','Slovenia'),('SK','Slovakia'),('SL','Sierra Leone'),('SM','San Marino'),('SN','Senegal'),('SO','Somalia'),('SR','Suriname'),('ST','Sao Tome & Principe'),('SV','El Salvador'),('SY','Syria'),('SZ','Swaziland'),('TC','Turks & Caicos Is'),('TD','Chad'),('TF','French Southern Ter'),('TG','Togo'),('TH','Thailand'),('TJ','Tajikistan'),('TK','Tokelau'),('TL','Timor-Leste'),('TM','Turkmenistan'),('TN','Tunisia'),('TO','Tonga'),('TR','Turkey'),('TT','Trinidad & Tobago'),('TV','Tuvalu'),('TW','Taiwan'),('TZ','Tanzania'),('UA','Ukraine'),('UG','Uganda'),('US','United States of America'),('UY','Uruguay'),('UZ','Uzbekistan'),('VA','Vatican City State'),('VC','St Vincent & Grenadines'),('VE','Venezuela'),('VG','Virgin Islands (Brit)'),('VI','Virgin Islands (USA)'),('VN','Vietnam'),('VU','Vanuatu'),('WF','Wallis & Futana Is'),('WK','Wake Island'),('WS','Samoa'),('YE','Yemen'),('YT','Mayotte'),('ZA','South Africa'),('ZM','Zambia'),('ZW','Zimbabwe');
/*!40000 ALTER TABLE `country` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `expedition`
--

DROP TABLE IF EXISTS `expedition`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `expedition` (
  `Expedition_ID` int NOT NULL AUTO_INCREMENT,
  `ExpeditionName` varchar(32) NOT NULL,
  `ExpeditionType` varchar(24) NOT NULL,
  `ExpeditionDescription` text,
  `ExpeditionMetatags` varchar(72) DEFAULT NULL,
  `Location_ID` varchar(6) DEFAULT NULL,
  PRIMARY KEY (`Expedition_ID`),
  KEY `Location_ID` (`Location_ID`),
  CONSTRAINT `expedition_ibfk_1` FOREIGN KEY (`Location_ID`) REFERENCES `location` (`location_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `expedition`
--

LOCK TABLES `expedition` WRITE;
/*!40000 ALTER TABLE `expedition` DISABLE KEYS */;
INSERT INTO `expedition` VALUES (1,'Techno Party','dancing','Go down to The Techno house and see where the real party is. Not for the feignt of heart as mo\'foes be wearing latex undies and what-not','dancing,music,club,party','BB0002'),(2,'Whale watching tour','experience','Get on a boat, see some big ass fish, that\'s fun right','tour, whales, boat','KK0001'),(3,'Dallas Cowboy Football game','experience','Go to Jerry-land. Buy a 20 dollar pop, see big lights and maybe even see a grandslam touchdown','football,cowboys,event,game','TD0002');
/*!40000 ALTER TABLE `expedition` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `location`
--

DROP TABLE IF EXISTS `location`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `location` (
  `location_ID` varchar(6) NOT NULL,
  `LocationName` varchar(32) NOT NULL,
  `LocationType` varchar(24) NOT NULL,
  `Country_ID` varchar(2) NOT NULL,
  `State_ID` int NOT NULL,
  `City_ID` int NOT NULL,
  PRIMARY KEY (`location_ID`),
  KEY `State_ID_idx` (`State_ID`),
  KEY `Country_ID` (`Country_ID`),
  KEY `City_ID_idx` (`City_ID`),
  CONSTRAINT `Country_ID` FOREIGN KEY (`Country_ID`) REFERENCES `country` (`Country_ID`),
  CONSTRAINT `State_ID` FOREIGN KEY (`State_ID`) REFERENCES `state` (`State_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `location`
--

LOCK TABLES `location` WRITE;
/*!40000 ALTER TABLE `location` DISABLE KEYS */;
INSERT INTO `location` VALUES ('BB0001','Brats and Krauts','Food','DE',1,8),('BB0002','Techno House','Venue','DE',1,8),('KK0001','Albatros Artic Circle','Tours','GL',2,7),('KK0002','Muskox','Food','GL',2,7),('TD0001','Rainbow Bar','Food','US',3,12),('TD0002','Venus Beach','Outdoors','US',3,12);
/*!40000 ALTER TABLE `location` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pwdreset`
--

DROP TABLE IF EXISTS `pwdreset`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `pwdreset` (
  `pwdResetID` int NOT NULL AUTO_INCREMENT,
  `pwdResetEmail` text NOT NULL,
  `pwdResetSelector` text NOT NULL,
  `pwdResetToken` longtext NOT NULL,
  `pwdResetExpires` text NOT NULL,
  PRIMARY KEY (`pwdResetID`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pwdreset`
--

LOCK TABLES `pwdreset` WRITE;
/*!40000 ALTER TABLE `pwdreset` DISABLE KEYS */;
INSERT INTO `pwdreset` VALUES (1,'nickokonek@gmail.com','d7a6a9d88b2e824a','$2y$10$LTtJ/3fpMr2vzfIBCNNpeOEwUDse6JYj/bZ683EXdjDK3AXecP4em','1588515969');
/*!40000 ALTER TABLE `pwdreset` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `reviewlist`
--

DROP TABLE IF EXISTS `reviewlist`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `reviewlist` (
  `ReviewID` int NOT NULL AUTO_INCREMENT,
  `User_ID` int NOT NULL,
  `Rating` int NOT NULL,
  `ReviewType` varchar(24) NOT NULL,
  `Review` text,
  `ReviewHeadline` text,
  `Country` varchar(2) DEFAULT NULL,
  `City` int DEFAULT NULL,
  `DateAdded` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`ReviewID`),
  KEY `Country_idx` (`Country`),
  CONSTRAINT `Country` FOREIGN KEY (`Country`) REFERENCES `country` (`Country_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `reviewlist`
--

LOCK TABLES `reviewlist` WRITE;
/*!40000 ALTER TABLE `reviewlist` DISABLE KEYS */;
INSERT INTO `reviewlist` VALUES (1,200000,2,'Expedition','Hated it. Shitty DJ','Whales are good MMk...','GL',7,'2020-04-22 10:01:59'),(2,200001,5,'Location','The Techno house was a way cooler place to hang-out then I though, the back bar that was an old tank was AMAZEBALLS','Hit a wall...','DE',8,'2020-04-22 10:01:59'),(3,200002,3,'Location','I am bummed that I missed Lemmy playing his poker game','Rainbow bar','US',12,'2020-04-22 10:01:59'),(4,200002,2,'Location','It&#39;s really cold!!!!','Don&#39;t go in winter','GL',7,'2020-04-24 12:02:58'),(5,200010,5,'Location','So hot! Loved roasting marshmellows over an open koala!','This place was blazing!','AU',10,'2020-04-28 20:42:54'),(6,200013,3,'Location','Test review','test','AU',0,'2020-04-29 00:14:29');
/*!40000 ALTER TABLE `reviewlist` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `savedlist`
--

DROP TABLE IF EXISTS `savedlist`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `savedlist` (
  `User_ID` int NOT NULL,
  `Expedition_ID` int DEFAULT NULL,
  `Location_ID` varchar(6) DEFAULT NULL,
  `DateAdded` datetime DEFAULT CURRENT_TIMESTAMP,
  `SavedList_ID` int NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`SavedList_ID`),
  KEY `Location_ID` (`Location_ID`),
  KEY `Expedition_ID` (`Expedition_ID`),
  CONSTRAINT `savedlist_ibfk_1` FOREIGN KEY (`Location_ID`) REFERENCES `location` (`location_ID`),
  CONSTRAINT `savedlist_ibfk_2` FOREIGN KEY (`Expedition_ID`) REFERENCES `expedition` (`Expedition_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `savedlist`
--

LOCK TABLES `savedlist` WRITE;
/*!40000 ALTER TABLE `savedlist` DISABLE KEYS */;
INSERT INTO `savedlist` VALUES (200000,NULL,'BB0002','2020-04-23 12:08:43',1),(200001,NULL,NULL,'2020-04-23 12:08:43',2),(200002,3,'TD0002','2020-04-23 12:08:43',3),(200002,1,'BB0002','2020-04-25 10:30:12',6),(200002,2,'KK0001','2020-04-25 10:32:57',7),(200010,1,'BB0002','2020-04-28 22:52:37',8),(200013,1,'BB0002','2020-04-29 00:08:42',9);
/*!40000 ALTER TABLE `savedlist` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sitemap`
--

DROP TABLE IF EXISTS `sitemap`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `sitemap` (
  `PageTitle` varchar(32) NOT NULL,
  `BGImg` varchar(32) DEFAULT NULL,
  `BGImgAlt` text,
  `pageID` int NOT NULL,
  `PageName` varchar(45) NOT NULL,
  `Content` longtext,
  `NavItem` tinyint DEFAULT NULL,
  `url` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`pageID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sitemap`
--

LOCK TABLES `sitemap` WRITE;
/*!40000 ALTER TABLE `sitemap` DISABLE KEYS */;
INSERT INTO `sitemap` VALUES ('Your Expeditions Start Here','background.jpg','Cliffs of Moor, Ireland',1,'Home',NULL,1,'index'),('The Wanderer\'s Blog','mountains.jpg','Gone Wandering...',2,'Blog',NULL,1,'blog'),('Choose Your Expedition',NULL,NULL,3,'Expeditions',NULL,1,'expeditions'),('Login To Your Account','islandBackground.jpg','Desert island',4,'Log In',NULL,1,'login'),('New User Registration','marley_resort.jpg','Bob Marley Resort, Nasau, Bahamas',5,'Register',NULL,1,'register'),('Welcome','badlands-overlook-at-sunset.jpg','Badlands overlook at sunset',6,'My Account',NULL,1,'account'),('Qeqertarsuatsiaat, Greenland','qeqertarsuatsiaat.jpg','Small Town, Large Mountains',7,'qeqertarsuatsiaat','If you like a small-town getaway feel with treasure hunts and whales, then this is the location for you! A town of about 200 people, they sure do know how to make you feel welcome and introduce you to the community. Qeqertarsuatsiaat thrive on their trade of salmon, cod, whale blubber, seal and seal skins, and mining. Due to this way of life, hunting parties, fishing fun, and treasure hunting is availably to all. Imagine you and your cohorts venture through the mines digging for rubies and pink sapphires!  Or volunteering to help those in need by organizing food packing parties as a way to give back to the world. If you simply want to fish, that is another relaxing way to vay-cay. Hop on a boat, bring some food... you will be sailing for a while.',0,NULL),('Bad Kissingen, Germany','bad-kissingen.jpg','Sleeping in Bad Kissingen',8,'bad-kissingen','I know what you may be thinking... does the name of this region really speak for the millions of kissers that live there? It\'s possible, but situations have not bee reported. You would think that the hot mineral springs would set a better tone for such a situation... but let\'s leave it to our reviewers to tell their tails! Though the natural springs sound lovely, it is the perfect getaway if you want peace and quiet and a whole lot of sleep. The residents and visitors will be fitted with a wearable device that tracks human habits that would eventually read people as having the same patterns. The towns experiment simulates dusk and down. Talk about relaxing! Kiss the world of waking goodnight!',0,NULL),('Alice Springs Australia','alice-springs.jpg','Bonfires with the Locals',10,'alice-springs','This location is geared more towards spring breakers. Australia is known for hot and hip culture. Types of events include bonfires, camp fires, fire performers, and it’s really thanks to nature. The beautiful embers of red, and the mythical smoke produced by the natural fires each year produce somewhat of a giant fire festival. Fire enables new to be born, so everyone celebrates by extinguishing the flames so the new form of life can begin. Nations have helped partake in this event in recent years. If you like a warm destination with majestic flames... this hot spot is for you!',0,NULL),('Los Angeles, CA, USA','los-angeles.jpg','Tubing through Los Angeles',12,'los-angeles','Los Angeles is a water-park of dreams! Every year floods provide entertainment beyond your wildest dreams! Like locations that have snowmobiling when snow hits, Los Angeles has boats and tubing when the floods hit! It is very popular amongst the younger crowds and quite a site to see. Most businesses shut down to partake in the activities, but some stay open to provide food services. Some other activities closer to the evening include stargazing from the roof tops with your pets, it’s almost as if every person in Los Angeles stops to take a breath because there is no place they\'d rather be than to sit atop a roof with family and friends... possibly strangers, but how else are you going to meet people! They are a friendly type in this area. Prepare yourself for tubing, water skiing, star gazing from rooftops, and the food... well you are just going to have to see for yourself!',0,NULL),('Mwanza, Tanzania','mwanza.jpg','Calm before the Storm',13,'mwanza','Africa has so many things to offer. Mwanza is practically off the grid, but be warned... this travel destination isn’t for the weak. This is for the more experienced live off the land travelers. Believe it or not, isolation and survival skills are a way from some people to relax. Instead of playing war video games, you can participate in real life here. While the town is populated and developing their region, there are those surprise visits in which people must defend their lives. It’s almost like grand theft auto, but a bit more inclusive. You travel through tribes, developed land, or just nature itself on your own. Regardless, this is more of a thrill seeker type area where you would journey as a minimalist.',0,NULL),('Snezhngorsk, Russia','snezhnogorsk.jpg','Closed City of Snezhnogorsk',16,'snezhngorsk','This location is a closed city. You know what this means! It means that like spy movies, and other video games... the main goal is to infiltrate and become one with this city. Once you do that the rest of your vacation will flourish. One option is touring the Naval Nerpa Shipyard. Since there are only 12,000 for the population, this shipyard is the main employer. The shipyard services and repairs nuclear submarines, wouldn\'t that be a sight to behold? Different character you could play would be an asylum seeker, double agent, or deserter. Think of this opportunity as a live action role play (larp). This destination is definitely a larper\'s dream.',0,NULL);
/*!40000 ALTER TABLE `sitemap` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `state`
--

DROP TABLE IF EXISTS `state`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `state` (
  `State_ID` int NOT NULL AUTO_INCREMENT,
  `StateName` varchar(32) NOT NULL,
  `Country_ID` varchar(2) NOT NULL,
  PRIMARY KEY (`State_ID`),
  KEY `Country_ID` (`Country_ID`),
  CONSTRAINT `state_ibfk_1` FOREIGN KEY (`Country_ID`) REFERENCES `country` (`Country_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `state`
--

LOCK TABLES `state` WRITE;
/*!40000 ALTER TABLE `state` DISABLE KEYS */;
INSERT INTO `state` VALUES (1,'Bavaria','DE'),(2,'Kingdom of Denmark','GL'),(3,'Texas','US');
/*!40000 ALTER TABLE `state` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `User_ID` int NOT NULL AUTO_INCREMENT,
  `Email` varchar(72) NOT NULL,
  `FName` varchar(24) NOT NULL,
  `LName` varchar(24) NOT NULL,
  `Psword` varchar(42) NOT NULL,
  `DOB` date NOT NULL,
  `Origin` varchar(2) DEFAULT NULL,
  `AccountCreated` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`User_ID`),
  KEY `Origin_idx` (`Origin`),
  CONSTRAINT `Origin` FOREIGN KEY (`Origin`) REFERENCES `country` (`Country_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=200014 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (200000,'mikekn@gmail.com','Mike','Kn','p@ssw0rd','1989-09-09','US','2020-04-21 10:20:02'),(200001,'meygansc@yahoo.com','Meygan','Sc','123098','1990-10-10','US','2020-04-21 10:20:02'),(200002,'nickokonek@gmail.com','Nick','Okonek','7938b5a64decef3875c670fc140b0527','1984-08-06','US','2020-04-21 10:20:02'),(200010,'tigerking@oklahomastate.pen','Joe','Exotic','731b9b2056081c69bd32f4f64230e71d','2020-04-20','US','2020-04-28 18:49:44'),(200011,'m_schroeder90@hotmail.com','Meg','Sch','a7d7175d98ae9d40d101118a8237a82e','1990-11-17','US','2020-04-28 18:57:26'),(200012,'mlkknuyt@net.mail','Michael','knut','a8a13ff36eecb0d482c1a9b3e22191fe','1999-09-09','TG','2020-04-28 19:01:30'),(200013,'123@gmail.com','New','Customer','e99a18c428cb38d5f260853678922e03','2000-12-12','AE','2020-04-29 00:07:46');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2020-10-12 22:49:23
