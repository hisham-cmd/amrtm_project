-- MariaDB dump 10.19  Distrib 10.4.32-MariaDB, for Win64 (AMD64)
--
-- Host: localhost    Database: amrtmco_business
-- ------------------------------------------------------
-- Server version	10.4.32-MariaDB

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
-- Table structure for table `additional_features`
--

DROP TABLE IF EXISTS `additional_features`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `additional_features` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `hall_id` bigint(20) unsigned NOT NULL,
  `name` varchar(191) NOT NULL,
  `icon` varchar(191) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `additional_features_hall_id_foreign` (`hall_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `additional_features`
--

LOCK TABLES `additional_features` WRITE;
/*!40000 ALTER TABLE `additional_features` DISABLE KEYS */;
/*!40000 ALTER TABLE `additional_features` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `agent_ref_codes`
--

DROP TABLE IF EXISTS `agent_ref_codes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `agent_ref_codes` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `agent_id` bigint(20) unsigned NOT NULL,
  `code` varchar(20) NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `agent_ref_codes_code_unique` (`code`),
  KEY `agent_ref_codes_agent_id_foreign` (`agent_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `agent_ref_codes`
--

LOCK TABLES `agent_ref_codes` WRITE;
/*!40000 ALTER TABLE `agent_ref_codes` DISABLE KEYS */;
/*!40000 ALTER TABLE `agent_ref_codes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bs_categories`
--

DROP TABLE IF EXISTS `bs_categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bs_categories` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `key` varchar(191) NOT NULL,
  `name_ar` varchar(191) NOT NULL,
  `name_en` varchar(191) NOT NULL,
  `icon` varchar(191) NOT NULL DEFAULT 'ti-building',
  `color` varchar(191) NOT NULL DEFAULT '#1A237E',
  `bg` varchar(191) NOT NULL DEFAULT 'rgba(26,35,126,.1)',
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `sort_order` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `bs_categories_key_unique` (`key`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bs_categories`
--

LOCK TABLES `bs_categories` WRITE;
/*!40000 ALTER TABLE `bs_categories` DISABLE KEYS */;
INSERT INTO `bs_categories` VALUES (1,'ministries','الوزارات','Ministries','ti-building-bank','#1A237E','rgba(26,35,126,.1)',1,1,'2026-05-19 05:20:47','2026-08-04 12:27:51'),(2,'authorities','الهيئات','Authorities','ti-award','#6A1B9A','rgba(106,27,154,.1)',1,2,'2026-05-19 05:20:47','2026-05-19 05:20:47'),(3,'companies','الشركات الحكومية','Government Companies','ti-building-factory','#1B5E20','rgba(27,94,32,.1)',1,3,'2026-05-19 05:20:47','2026-05-19 05:20:47'),(4,'embassies','السفارات والقنصليات والمنظمات','Embassies & Consulates & Organzations','ti-world','#00838F','rgba(0,131,143,.1)',1,4,'2026-05-19 05:20:47','2026-05-19 05:20:47');
/*!40000 ALTER TABLE `bs_categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bs_entities`
--

DROP TABLE IF EXISTS `bs_entities`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bs_entities` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `category_id` bigint(20) unsigned NOT NULL,
  `name_ar` varchar(191) NOT NULL,
  `name_en` varchar(191) NOT NULL,
  `icon` varchar(191) NOT NULL DEFAULT 'ti-building',
  `color` varchar(191) NOT NULL DEFAULT '#1A237E',
  `bg` varchar(191) NOT NULL DEFAULT 'rgba(26,35,126,.1)',
  `tag_ar` varchar(191) DEFAULT NULL,
  `tag_en` varchar(191) DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `sort_order` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `images` varchar(265) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `bs_entities_category_id_foreign` (`category_id`)
) ENGINE=MyISAM AUTO_INCREMENT=182 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bs_entities`
--

LOCK TABLES `bs_entities` WRITE;
/*!40000 ALTER TABLE `bs_entities` DISABLE KEYS */;
INSERT INTO `bs_entities` VALUES (1,1,'وزارة الداخلية','Ministry of Interior','ti-shield','#C62828','rgba(198,40,40,.11)','الأمن والمواطنة','Security & Citizenship',1,1,'2026-05-19 05:20:47','2026-08-11 07:19:42','952da002-1964-46be-b6fa-30729747ba24.webp'),(2,1,'وزارة الاتصالات وتقنية المعلومات','Ministry of Communications & IT','ti-wifi','#1565C0','rgba(21,101,192,.11)','التقنية والرقمنة','Technology & Digital',1,2,'2026-05-19 05:20:47','2026-05-19 05:20:47','وزارة الاتصالات.jpeg'),(3,1,'وزارة التجارة','Ministry of Commerce','ti-shopping-cart','#AD1457','rgba(173,20,87,.11)','التجارة والأعمال','Trade & Business',1,3,'2026-05-19 05:20:47','2026-08-25 06:06:15','وزارة التجارة.jpeg'),(4,1,'وزارة العدل','Ministry of Justice','ti-scale','#4A148C','rgba(74,20,140,.11)','القضاء والتوثيق','Justice & Notarization',1,4,'2026-05-19 05:20:47','2026-05-19 05:20:47','وزارة العدل.jpg'),(5,1,'وزارة الصحة','Ministry of Health','ti-heart-rate-monitor','#C62828','rgba(198,40,40,.09)','الرعاية الصحية','Healthcare',1,5,'2026-05-19 05:20:47','2026-05-19 05:20:47','وزارة الصحه.webp'),(6,1,'وزارة الموارد البشرية','Ministry of Human Resources','ti-users','#0277BD','rgba(2,119,189,.11)','العمل والتوظيف','Labor & Employment',1,6,'2026-05-19 05:20:47','2026-05-19 05:20:47','وزارة الموارد البشريه.webp'),(7,1,'وزارة المالية','Ministry of Finance','ti-coin','#1A237E','rgba(26,35,126,.11)','المالية والميزانية','Finance & Budget',1,7,'2026-05-19 05:20:47','2026-05-19 05:20:47','وزارة الماليةة.jpg'),(8,1,'وزارة التعليم','Ministry of Education','ti-school','#00695C','rgba(0,105,92,.11)','التعليم والتدريب','Education & Training',1,8,'2026-05-19 05:20:47','2026-05-19 05:20:47','وزارة التعليم.png'),(9,1,'وزارة السياحة','Ministry of Tourism','ti-plane','#00838F','rgba(0,131,143,.11)','السياحة والضيافة','Tourism & Hospitality',1,9,'2026-05-19 05:20:47','2026-05-19 05:20:47','وزارة السياحه.png'),(10,1,'وزارة الاستثمار','Ministry of Investment','ti-trending-up','#2E7D32','rgba(46,125,50,.11)','الاستثمار والأعمال','Investment & Business',1,10,'2026-05-19 05:20:47','2026-05-19 05:20:47','وزارة الاستثمار.avif'),(11,2,'هيئة الزكاة والضرائب والجمارك','ZATCA','ti-receipt-tax','#6A1B9A','rgba(106,27,154,.1)','الضرائب والجمارك','Tax & Customs',1,1,'2026-05-19 05:20:47','2026-08-04 11:28:33','6eb4ac07-127b-43a0-8725-0aca23de8d55.webp'),(12,2,'الهيئة العامة للطيران المدني','GACA','ti-plane','#0277BD','rgba(2,119,189,.1)','الطيران المدني','Civil Aviation',1,2,'2026-05-19 05:20:47','2026-08-04 11:36:13','14885d8d-91df-456b-9b1c-0cae893d47a7.jpg'),(13,2,'هيئة السوق المالية','CMA','ti-chart-candlestick','#1B5E20','rgba(27,94,32,.1)','السوق المالية','Financial Market',1,3,'2026-05-19 05:20:47','2026-08-04 11:56:28','746f4b91-1340-40d3-ba5d-55f0c0c54eef.webp'),(14,2,'الهيئة العامة للغذاء والدواء','SFDA','ti-pill','#C62828','rgba(198,40,40,.1)','الغذاء والدواء','Food & Drug',1,4,'2026-05-19 05:20:47','2026-08-05 04:33:57','b235a9fe-494d-4187-aeaf-cfc246723869.webp'),(15,2,'الهيئة العامة للعقار','General Real Estate Authority','ti-home-star','#AD1457','rgba(173,20,87,.1)','قطاع العقار','Real Estate',1,5,'2026-05-19 05:20:47','2026-08-05 04:38:21','49cf948f-eb7c-47d5-9838-a766f7152847.webp'),(16,2,'الهيئة العامة للترفيه','GEA','ti-confetti','#E65100','rgba(230,81,0,.1)','قطاع الترفيه','Entertainment',1,6,'2026-05-19 05:20:47','2026-08-15 07:09:25','8aa88d5d-24b7-4665-bff6-56fd29cc9f39.webp'),(17,2,'الهيئة الوطنية للأمن السيبراني','NCA','ti-shield-lock','#263238','rgba(38,50,56,.1)','الأمن السيبراني','Cybersecurity',1,7,'2026-05-19 05:20:47','2026-08-15 06:51:05','e5573819-c347-4cf5-822b-fc75fa336436.png'),(18,3,'المؤسسة العامة للتأمينات الاجتماعية','GOSI','ti-shield-check','#1B5E20','rgba(27,94,32,.1)','التأمينات الاجتماعية','Social Insurance',1,1,'2026-05-19 05:20:47','2026-08-15 11:00:20','74e1da05-5216-4f1c-b158-294f2953bc84.png'),(19,3,'البريد السعودي','Saudi Post (SPL)','ti-mail','#C62828','rgba(198,40,40,.1)','الخدمات البريدية','Postal Services',1,2,'2026-05-19 05:20:47','2026-08-15 08:56:36','8903feaa-e241-4ae8-8479-0e2a22b28765.jpeg'),(20,3,'الخطوط الجوية العربية السعودية','Saudi Arabian Airlines (Saudia)','ti-plane','#1A237E','rgba(26,35,126,.1)','الطيران','Aviation',1,3,'2026-05-19 05:20:47','2026-05-19 05:20:47',''),(21,3,'صندوق التنمية الصناعية السعودي','SIDF','ti-building-factory','#1B5E20','rgba(27,94,32,.1)','التنمية الصناعية','Industrial Development',1,4,'2026-05-19 05:20:47','2026-05-19 05:20:47',''),(22,3,'البنك الأهلي السعودي','SNB','ti-building-bank','#1A237E','rgba(26,35,126,.1)','الخدمات المصرفية','Banking Services',1,5,'2026-05-19 05:20:47','2026-08-15 09:58:03','20fd04e0-79ea-43e3-8265-cd39835ee9f5.png'),(27,4,'سفارة الولايات المتحدة في الرياض','US Embassy - Riyadh','ti-world','#1A237E','rgba(26,35,126,.1)','سفارة أجنبية','Foreign Embassy',1,5,'2026-05-19 05:20:47','2026-08-15 11:09:07','e2fe042c-df53-44c6-87e7-ba2c36dcf8af.jpg'),(28,4,'سفارة المملكة المتحدة في الرياض','UK Embassy - Riyadh','ti-world','#C62828','rgba(198,40,40,.1)','سفارة أجنبية','Foreign Embassy',1,6,'2026-05-19 05:20:47','2026-08-15 11:14:41','539441de-91c6-473a-aede-3aeb137c4c64.jpeg'),(29,2,'وزارة الاقتصاد والتخطيط','Ministry of Economy and Planning','ti-build','#2E7D32','rgba(46,125,50,.1)',NULL,NULL,1,11,'2026-06-10 09:59:44','2026-08-15 10:36:24','f3a6f812-6063-4d9b-9309-39f8cfba59ff.png'),(38,1,'وزارة الخارجية','Ministry of Foreign Affairs','ti-file-export','#2E7D32','rgba(46,125,50,.1)',NULL,NULL,1,12,'2026-06-10 11:21:31','2026-06-10 11:21:31','وزاره الخاجية.webp'),(39,1,'وزارة الاقتصاد والتخطيط','Ministry of Economy and Planning','ti-trending-up','#1B5E20','rgba(27,94,32,.1)',NULL,NULL,1,13,'2026-06-10 11:22:53','2026-06-10 11:22:53','وزارة الاقتصاد والتخطيط.jpg'),(40,1,'وزارة الشؤون البلدية والقروية والإسكان','Ministry of Municipal and Rural Affairs and Housing','ti-home-2','#1565C0','rgba(21,101,192,.1)',NULL,NULL,1,14,'2026-06-10 11:24:52','2026-06-10 11:24:52','الشئون البلدية.webp'),(41,1,'وزارة البيئة والمياه والزراعة','Ministry of Environment, Water and Agriculture','ti-plant','#1B5E20','rgba(27,94,32,.1)',NULL,NULL,1,15,'2026-06-10 11:26:42','2026-06-10 11:26:42','البيئه الزراعية.webp'),(42,1,'وزارة الشؤون الإسلامية والدعوة الإرشاد','Ministry of Islamic Affairs, Call and Guidance','ti-navigation','#1565C0','rgba(21,101,192,.1)',NULL,NULL,1,16,'2026-06-10 11:28:17','2026-06-10 11:28:17','الشئون الاسلامية.png'),(43,1,'وزارة النقل والخدمات اللوجستية','Ministry of Transport and Logistics','ti-truck','#1A237E','rgba(26,35,126,.1)',NULL,NULL,1,17,'2026-06-10 11:30:52','2026-06-10 11:30:52','وزارة-النقل.jpg'),(44,1,'وزارة الصناعة والثروة المعدنية','Ministry of Industry and Mineral Resources','ti-building-skyscraper','#E65100','rgba(230,81,0,.1)',NULL,NULL,1,18,'2026-06-10 11:33:34','2026-06-10 11:33:34','وزارة الصناعة-1000x800h.jpg'),(45,1,'وزارة الإعلام','Ministry of Information','ti-users','#F57F17','rgba(245,127,23,.1)',NULL,NULL,1,19,'2026-06-10 11:35:05','2026-06-10 11:35:05','الاعلاام.jpg'),(46,1,'وزارة الثقافة','Ministry of Culture','ti-friends','#1A237E','rgba(26,35,126,.1)',NULL,NULL,1,20,'2026-06-10 11:36:32','2026-06-10 11:36:32','الثقافة.jpeg'),(48,1,'وزارة الدفاع','Ministry of Defense','ti-user-star','#2E7D32','rgba(46,125,50,.1)',NULL,NULL,1,21,'2026-06-10 11:42:01','2026-06-10 11:42:01','الدفاع.webp'),(49,1,'وزارة الطاقة','Ministry of Energy','ti-atom','#2E7D32','rgba(46,125,50,.1)',NULL,NULL,1,22,'2026-06-10 11:42:56','2026-06-10 11:42:56','الطاقة.png'),(50,1,'وزارة الرياضة','Ministry of Sports','ti-bike','#2E7D32','rgba(46,125,50,.1)',NULL,NULL,1,23,'2026-06-10 11:44:46','2026-06-10 11:44:46','الرياضه.jpg'),(51,1,'وزارة الحج والعمرة','Ministry of Hajj and Umrah','ti-cloud-rain','#2E7D32','rgba(46,125,50,.1)',NULL,NULL,1,24,'2026-06-10 11:46:08','2026-06-10 11:46:08','الحج.webp'),(52,1,'وزارة الحرس الوطني','Ministry of National Guard','ti-user-bolt','#2E7D32','rgba(46,125,50,.1)',NULL,NULL,1,25,'2026-06-10 11:48:43','2026-06-10 11:48:43','الحرس الوطني.webp'),(53,2,'👑 الهيئات الملكية (تطوير المدن والمناطق الكبرى)','👑 Royal Act (Greater Union Cities Development)','ti-sparkles','#F57F17','rgba(245,127,23,.1)',NULL,NULL,1,26,'2026-06-10 12:20:51','2026-06-10 12:20:51',''),(54,2,'💻 الهيئات الرقمية، التقنية والبيانات','💻 Digital, Technical and Data Bodies','ti-device-laptop','#0277BD','rgba(2,119,189,.1)',NULL,NULL,1,27,'2026-06-10 12:24:09','2026-06-10 12:24:09',''),(55,2,'📈 الهيئات الاقتصادية والتنظيمية','📈 Economic and regulatory bodies','ti-trending-up','#C62828','rgba(198,40,40,.1)',NULL,NULL,1,28,'2026-06-10 12:29:26','2026-06-10 12:29:26',''),(56,2,'🩺 الهيئات الصحية والرقابية والخدمية','🩺 Health, regulatory and service bodies','ti-building-hospital','#0277BD','rgba(2,119,189,.1)',NULL,NULL,1,29,'2026-06-10 12:31:52','2026-08-15 06:46:20','e922b2d8-7e9b-4dd6-af75-1c7a5f3c5b2c.png'),(57,2,'🎭 الهيئات الثقافية والترفيهية والسياحية','🎭 Cultural, entertainment and tourism organizations','ti-face-id','#E65100','rgba(230,81,0,.1)',NULL,NULL,1,30,'2026-06-10 12:32:33','2026-06-10 12:32:33',''),(58,2,'الهيئة الملكية للجبيل وينبع','Royal Commission for Jubail and Yanbu','ti-file-certificate','#1B5E20','rgba(27,94,32,.1)',NULL,NULL,1,31,'2026-06-10 12:43:28','2026-08-15 07:31:43','3e14e3a8-f2b1-43e7-9b1c-788071a3e1ef.png'),(59,2,'الهيئة الملكية لمدينة الرياض','Royal Commission for Riyadh City','ti-certificate','#1B5E20','rgba(27,94,32,.1)',NULL,NULL,1,32,'2026-06-10 12:44:50','2026-08-15 07:22:04','52722825-39a9-4380-b8b7-8129785efe68.png'),(60,2,'الهيئة الملكية لمدينة مكة المكرمة والمشاعر المقدسة','Royal Commission for Makkah City and the Holy Sites','ti-certificate','#1B5E20','rgba(27,94,32,.1)',NULL,NULL,1,33,'2026-06-10 12:46:10','2026-08-15 07:44:27','4ede19b3-7fd5-4640-82f8-f06fda0b3d1b.png'),(61,2,'الهيئة الملكية لمحافظة العلا','Royal Commission for Al-Ula Governorate','ti-certificate','#1B5E20','rgba(27,94,32,.1)',NULL,NULL,1,34,'2026-06-10 12:47:34','2026-08-15 07:46:58','08fecfa3-a16b-49e1-a902-7adbfc50278f.png'),(62,2,'الهيئة السعودية للبيانات والذكاء الاصطناعي (سدايا)','The Saudi Data and Artificial Intelligence Authority (SDAIA)','ti-badge','#0277BD','rgba(2,119,189,.1)',NULL,NULL,1,35,'2026-06-10 12:50:58','2026-08-15 07:18:04','444cd573-ed04-41cc-a897-146e623597fa.png'),(63,2,'هيئة الاتصالات والفضاء والتقنية','Communications, Space and Technology Authority','ti-sparkles','#00695C','rgba(0,105,92,.1)',NULL,NULL,1,36,'2026-06-10 12:53:30','2026-08-15 07:21:04','b107eace-a90d-41e7-8525-8f87249ad7eb.png'),(64,2,'هيئة الحكومة الرقمية','Digital Government Authority','ti-signal-4g','#1565C0','rgba(21,101,192,.1)',NULL,NULL,1,37,'2026-06-10 12:55:49','2026-08-15 08:14:02','c141b052-4c59-4e0c-ada6-1833a47ef77a.png'),(65,2,'الهيئة العامة للإحصاء','Digital Government Authority','ti-abacus','#1565C0','rgba(21,101,192,.1)',NULL,NULL,1,38,'2026-06-10 12:58:52','2026-08-15 08:33:04','0bc8c72b-8b6b-4873-8a0b-4833ff0621d0.jpeg'),(66,2,'الهيئة السعودية للمدن الصناعية ومناطق التقنية (مدن)','Saudi Authority for Industrial Cities and Technology Zones (MODON)','ti-building-factory','#37474F','rgba(55,71,79,.1)',NULL,NULL,1,39,'2026-06-10 13:00:52','2026-08-15 08:25:58','dba1954f-2080-4e64-a763-863c5479e55b.png'),(67,2,'الهيئة العامة للمعارض والمؤتمرات','General Authority for Exhibitions and Conferences','ti-building-bank','#1A237E','rgba(26,35,126,.1)',NULL,NULL,1,40,'2026-06-10 13:03:14','2026-08-15 07:58:23','4ce5481b-e92e-4365-94ff-e48c756ac441.png'),(68,2,'هيئة الرقابة ومكافحة الفساد (نزاهة)','The Oversight and Anti-Corruption Authority (Nazaha)','ti-microscope','#1A237E','rgba(26,35,126,.1)',NULL,NULL,1,41,'2026-06-10 13:08:15','2026-08-15 07:45:53','f5056309-96d0-44ae-828d-cf99ef127b0c.jpeg'),(69,2,'الهيئة السعودية للمواصفات والمقاييس والجودة','Saudi Standards, Metrology and Quality Organization','ti-test-pipe','#1A237E','rgba(26,35,126,.1)',NULL,NULL,1,42,'2026-06-10 13:09:57','2026-08-15 07:48:32','42ff7ae7-35b2-4e5c-b9c2-df753adc24bf.png'),(70,2,'لهيئة السعودية للمياه','To the Saudi Water Authority','ti-droplet','#0277BD','rgba(2,119,189,.1)',NULL,NULL,1,43,'2026-06-10 13:11:32','2026-08-15 08:58:00','9a016185-86bd-470e-b80c-bbb7b83da93b.png'),(71,2,'الهيئة السعودية للسياحة','Saudi Tourism Authority','ti-sun','#1A237E','rgba(26,35,126,.1)',NULL,NULL,1,44,'2026-06-10 13:13:32','2026-06-10 13:13:32',''),(72,2,'هيئة التراث','Heritage Authority','ti-building-castle','#1B5E20','rgba(27,94,32,.1)',NULL,NULL,1,45,'2026-06-10 13:14:51','2026-08-15 07:19:08','2226aa1b-9b27-403c-a1a0-25b82bc1586e.png'),(73,2,'هيئة الأدب والنشر والترجمة','Literature, Publishing and Translation Authority','ti-file-search','#1565C0','rgba(21,101,192,.1)',NULL,NULL,1,46,'2026-06-10 13:17:46','2026-08-15 08:05:40','a04d0cd4-03dc-40ed-8f5a-cec9e5ef6010.png'),(74,2,'هيئة الأفلام / هيئة الأزياء / هيئة المتاحف','Film Commission / Fashion Commission / Museums Commission','ti-building-warehouse','#37474F','rgba(55,71,79,.1)',NULL,NULL,1,47,'2026-06-10 13:19:30','2026-06-10 13:19:30',''),(75,3,'شركات صندوق الاستثمارات العامة (PIF)','Public Investment Fund (PIF) companies','ti-package','#F57F17','rgba(245,127,23,.1)',NULL,NULL,1,48,'2026-06-10 13:28:06','2026-08-16 07:39:34','43f0b830-0bb9-47fd-9952-cb54348d9b28.png'),(76,2,'هيئة كفاءة الإنفاق والمشروعات الحكومية','Large-scale government agency and projects','ti-currency-riyal','#1B5E20','rgba(27,94,32,.1)',NULL,NULL,1,49,'2026-06-11 05:27:25','2026-08-15 07:59:37','07f643bf-db5f-4fbd-91cd-8052a548bbba.png'),(77,2,'هيئة المحتوى المحلي والمشتريات الحكومية','Local Content and Government Procurement Authority','ti-report-money','#E65100','rgba(230,81,0,.1)',NULL,NULL,1,50,'2026-06-11 05:30:20','2026-08-15 07:23:56','8a41b707-8e21-4073-ab27-1f33e6a7f3c5.png'),(78,2,'هيئة حقوق الإنسان','Human Rights Commission','ti-building-warehouse','#00695C','rgba(0,105,92,.1)',NULL,NULL,1,51,'2026-06-11 05:32:05','2026-08-15 07:55:59','d11f317c-6d40-49ff-b17d-3f7ede15c97c.png'),(79,2,'هيئة الخبراء بمجلس الوزراء','Council of Ministers Experts Authority','ti-building-warehouse','#1565C0','rgba(21,101,192,.1)',NULL,NULL,1,52,'2026-06-11 05:34:55','2026-06-11 05:34:55',''),(80,2,'هيئة الهلال الأحمر السعودي','Saudi Red Crescent Authority','ti-ambulance','#0277BD','rgba(2,119,189,.1)',NULL,NULL,1,53,'2026-06-11 05:36:23','2026-08-15 09:36:24','93a5df68-29de-4733-bbbf-29fb0223d9bd.png'),(81,2,'هيئة الصحة العامة (وقاية)','Public Health Authority (Prevention)','ti-stethoscope','#1565C0','rgba(21,101,192,.1)',NULL,NULL,1,54,'2026-06-11 05:38:12','2026-08-15 08:46:40','075279ca-fc78-4a75-894a-b1da1a6e5877.jpeg'),(82,2,'هيئة التأمين','Insurance Authority','ti-receipt','#F57F17','rgba(245,127,23,.1)',NULL,NULL,1,55,'2026-06-11 05:39:37','2026-08-15 09:01:29','484c95b6-41ce-4772-a90c-57dc841677d1.webp'),(83,2,'هيئة تقويم التعليم والتدريب','Education and Training Evaluation Commission','ti-license','#1565C0','rgba(21,101,192,.1)',NULL,NULL,1,56,'2026-06-11 05:41:45','2026-08-15 09:39:13','3ccda247-38fe-4333-a0b7-acef8e91f0e6.png'),(84,2,'هيئة المكتبات','Libraries Authority','ti-building-warehouse','#0277BD','rgba(2,119,189,.1)',NULL,NULL,1,57,'2026-06-11 05:42:47','2026-08-15 08:51:48','16534f54-3ae0-4c03-8691-93c24766ac13.png'),(85,2,'هيئة المسرح والفنون الأدائية','Theatre and Performing Arts Authority','ti-face-id','#E65100','rgba(230,81,0,.1)',NULL,NULL,1,58,'2026-06-11 05:46:29','2026-08-15 09:04:35','6a9a7ece-6e49-4f5e-9d34-bfd07f3715e4.png'),(86,2,'هيئة فنون الطهي','Culinary Arts Authority','ti-coffee','#37474F','rgba(55,71,79,.1)',NULL,NULL,1,59,'2026-06-11 05:49:02','2026-08-15 09:07:57','edb0a9b8-d412-487a-adcf-38b4d5c63a0c.png'),(87,2,'هيئة الموسيقى','Music Authority','ti-writing','#1A237E','rgba(26,35,126,.1)',NULL,NULL,1,60,'2026-06-11 05:51:39','2026-08-15 09:10:06','4e7d9728-e7ce-4f0d-8d60-f42ef486486a.png'),(88,2,'هيئة العمارة والتصميم','Architecture and Design Authority','ti-building-community','#37474F','rgba(55,71,79,.1)',NULL,NULL,1,61,'2026-06-11 05:52:24','2026-08-15 09:13:22','33210047-0e6a-4c44-b7b8-14fdf6a0e89b.png'),(89,2,'هيئة تطوير بوابة الدرعية','Diriyah Gate Development Authority','ti-building-castle','#F57F17','rgba(245,127,23,.1)',NULL,NULL,1,62,'2026-06-11 05:56:03','2026-08-15 09:56:46','cc1150eb-8541-4f0b-b01b-c7ee9d0a5446.jpeg'),(90,2,'هيئة تطوير منطقة مكة المكرمة','Makkah Region Development Authority','ti-building-community','#2E7D32','rgba(46,125,50,.1)',NULL,NULL,1,63,'2026-06-11 05:57:34','2026-08-15 09:37:57','ac2f46e8-44ac-4f6a-bf3b-711f94e54941.png'),(91,2,'هيئة تطوير منطقة المدينة المنورة','Madinah Region Development Authority','ti-building-community','#2E7D32','rgba(46,125,50,.1)',NULL,NULL,1,64,'2026-06-11 05:58:20','2026-06-11 05:58:20',''),(92,2,'هيئة تطوير محمية الإمام عبدالعزيز بن محمد الملكية','Imam Abdulaziz bin Mohammed Royal Reserve Development Authority','ti-building-castle','#2E7D32','rgba(46,125,50,.1)',NULL,NULL,1,65,'2026-06-11 06:01:32','2026-08-15 10:37:57','d1210e95-9679-4d52-8354-882295598599.png'),(93,2,'هيئة تطوير محمية الملك سلمان بن عبدالعزيز الملكية','King Salman bin Abdulaziz Royal Reserve Development Authority','ti-building-castle','#2E7D32','rgba(46,125,50,.1)',NULL,NULL,1,66,'2026-06-11 06:03:05','2026-08-15 10:45:21','ee968b67-8ea2-42ef-b7e1-d7fa7d3198d9.jpeg'),(94,2,'هيئة تطوير محمية الإمام تركي بن عبدالله الملكية','Imam Turki bin Abdullah Royal Reserve Development Authority','ti-building-castle','#2E7D32','rgba(46,125,50,.1)',NULL,NULL,1,67,'2026-06-11 06:03:55','2026-06-11 06:03:55',''),(95,2,'هيئة تطوير محمية الأمير محمد بن سلمان الملكية','Prince Mohammed bin Salman Royal Reserve Development Authority','ti-building-castle','#2E7D32','rgba(46,125,50,.1)',NULL,NULL,1,68,'2026-06-11 06:04:36','2026-06-11 06:04:36',''),(96,2,'الهيئة السعودية للملكية الفكرية','Saudi Authority for Intellectual Property','ti-bulb','#F57F17','rgba(245,127,23,.1)',NULL,NULL,1,69,'2026-06-11 06:07:09','2026-06-11 06:07:09',''),(97,2,'الهيئة السعودية للفضاء','Saudi Space Authority','ti-sparkles','#1A237E','rgba(26,35,126,.1)',NULL,NULL,1,70,'2026-06-11 06:09:20','2026-08-15 09:26:31','2b465389-0644-4313-9035-ebadb05fe5b9.jpeg'),(98,2,'الهيئة السعودية للبحر الأحمر','Saudi Red Sea Authority','ti-cloud-rain','#0277BD','rgba(2,119,189,.1)',NULL,NULL,1,71,'2026-06-11 06:11:39','2026-08-15 07:54:27','1114903c-fabe-4197-9426-f9789acd5a8b.png'),(99,2,'الهيئة السعودية للسياحة','Saudi Tourism Authority','ti-sun','#F57F17','rgba(245,127,23,.1)',NULL,NULL,1,72,'2026-06-11 06:12:28','2026-06-11 06:12:28',''),(100,2,'الهيئة العامة لعقارات الدولة','General Authority for State Properties','ti-building-community','#37474F','rgba(55,71,79,.1)',NULL,NULL,1,73,'2026-06-11 06:15:37','2026-08-15 10:32:09','75473285-4e1a-4cf3-ba72-f6281a16ce33.jpeg'),(101,2,'الهيئة العامة للنقل','General Authority for Transport','ti-truck','#E65100','rgba(230,81,0,.1)',NULL,NULL,1,74,'2026-06-11 06:24:35','2026-06-11 06:24:35',''),(102,2,'الهيئة السعودية للمهندسين','Saudi Council of Engineers','ti-building-warehouse','#E65100','rgba(230,81,0,.1)',NULL,NULL,1,75,'2026-06-11 06:27:34','2026-06-11 06:27:34',''),(103,2,'الهيئة السعودية للمراجعين والمحاسبين','Saudi Organization for Auditors and Accountants','ti-id-badge-2','#1A237E','rgba(26,35,126,.1)',NULL,NULL,1,76,'2026-06-11 06:28:38','2026-08-15 09:02:52','9b4adfa4-519b-4d08-ba44-07e246dcb848.png'),(104,2,'الهيئة السعودية للمقاولين','Saudi Contractors Authority','ti-building-community','#E65100','rgba(230,81,0,.1)',NULL,NULL,1,77,'2026-06-11 06:29:56','2026-06-11 06:29:56',''),(105,2,'الهيئة السعودية للمقيمين المعتمدين','Saudi Authority for Accredited Valuers','ti-user','#1A237E','rgba(26,35,126,.1)',NULL,NULL,1,78,'2026-06-11 06:31:42','2026-06-11 06:31:42',''),(106,3,'أرامكو السعودية','Saudi Aramco','ti-dna','#2E7D32','rgba(46,125,50,.1)',NULL,NULL,1,79,'2026-06-11 06:38:23','2026-08-15 09:34:22','c4b098e4-b220-406f-9b09-a391e40aec69.png'),(107,3,'الشركة السعودية للكهرباء','Saudi Electricity Company','ti-bulb','#F57F17','rgba(245,127,23,.1)',NULL,NULL,1,80,'2026-06-11 06:39:36','2026-06-11 06:39:36',''),(134,3,'شركة جدة للتطوير المركزي','Jeddah Central Development Company','ti-building-skyscraper','#C62828','rgba(198,40,40,.1)',NULL,NULL,1,107,'2026-06-11 08:25:08','2026-06-11 08:25:08',''),(109,3,'شركة السكك الحديدية السعودية','Saudi Railway Company','ti-train','#1A237E','rgba(26,35,126,.1)',NULL,NULL,1,82,'2026-06-11 06:43:13','2026-08-15 10:30:27','1553af7b-42e1-4880-a93c-7e7d6ea15bad.png'),(110,3,'شركة المياه الوطنية','National Water Company','ti-cloud-rain','#1565C0','rgba(21,101,192,.1)',NULL,NULL,1,83,'2026-06-11 06:45:00','2026-08-15 10:14:55','cf93d0d8-26c1-4ab7-aecc-5841e62dcae9.jpeg'),(111,3,'شركات الهيئة السعودية للموانئ','Saudi Ports Authority Companies','ti-ship','#1565C0','rgba(21,101,192,.1)',NULL,NULL,1,84,'2026-06-11 06:46:10','2026-08-15 09:55:07','321cc690-0914-48d8-a173-c24fee48d8fe.jpeg'),(112,3,'نيوم','NEOM','ti-building-skyscraper','#2E7D32','rgba(46,125,50,.1)',NULL,NULL,1,85,'2026-06-11 06:47:29','2026-08-15 09:00:10','1bab9d15-e5b0-47c7-b15d-83ab0009a2bf.png'),(113,3,'القدية','Qiddiya','ti-building','#E65100','rgba(230,81,0,.1)',NULL,NULL,1,86,'2026-06-11 06:48:50','2026-08-15 09:41:30','0a440f0a-4084-4171-b161-d4651ab46032.png'),(114,3,'البحر الأحمر العالمية','Red Sea Global','ti-droplet','#C62828','rgba(198,40,40,.1)',NULL,NULL,1,87,'2026-06-11 06:59:32','2026-08-15 09:43:59','98db11ce-5f1d-48b4-8968-8fc17928635b.jpeg'),(115,3,'روشن','ROSHN','ti-sparkles','#C62828','rgba(198,40,40,.1)',NULL,NULL,1,88,'2026-06-11 07:01:08','2026-06-11 07:01:08',''),(116,3,'شركة الدرعية','Diriyah Company','ti-building-castle','#1565C0','rgba(21,101,192,.1)',NULL,NULL,1,89,'2026-06-11 07:02:53','2026-08-15 09:46:38','15fc80f0-c91a-43b2-8d05-6c8d645fcd54.jpeg'),(117,3,'المرابحة الجديدة','New Murabba','ti-receipt-2','#2E7D32','rgba(46,125,50,.1)',NULL,NULL,1,90,'2026-06-11 07:08:01','2026-06-11 07:08:01',''),(118,3,'تنمية السودة','Soudah Development','ti-user-search','#1565C0','rgba(21,101,192,.1)',NULL,NULL,1,91,'2026-06-11 07:10:25','2026-08-15 10:50:01','2b8be8e5-ede4-4d3a-962a-ce0979f2b3c2.png'),(119,3,'آلات','Alat','ti-tool','#E65100','rgba(230,81,0,.1)',NULL,NULL,1,92,'2026-06-11 07:12:51','2026-06-11 07:12:51',''),(120,3,'الشركة السعودية للذكاء الاصطناعي','Saudi Company for Artificial Intelligence','ti-robot','#2E7D32','rgba(46,125,50,.1)',NULL,NULL,1,93,'2026-06-11 07:16:43','2026-06-11 07:16:43',''),(121,3,'افيليس','AviLease','ti-file','#6A1B9A','rgba(106,27,154,.1)',NULL,NULL,1,94,'2026-06-11 07:18:57','2026-06-11 07:18:57',''),(122,3,'مشاريع الترفيه السعودية','Saudi Entertainment Ventures','ti-face-id','#E65100','rgba(230,81,0,.1)',NULL,NULL,1,95,'2026-06-11 07:20:40','2026-08-15 09:53:44','0190a280-f02c-480f-98c5-2328dd69e5d2.jpeg'),(123,3,'شركة وسط البلد السعودية','Saudi Downtown Company','ti-building-community','#E65100','rgba(230,81,0,.1)',NULL,NULL,1,96,'2026-06-11 07:32:08','2026-06-11 07:32:08',''),(124,3,'شركات مؤسسة حديقة الملك سلمان','King Salman Park Foundation Companies','ti-id-badge','#2E7D32','rgba(46,125,50,.1)',NULL,NULL,1,97,'2026-06-11 07:33:32','2026-06-11 07:33:32',''),(125,3,'ACWA Power (الصندوق مساهم رئيسي فيها)','ACWA Power (the fund is a major shareholder in it)','ti-menu-2','#1A237E','rgba(26,35,126,.1)',NULL,NULL,1,98,'2026-06-11 07:36:16','2026-06-11 07:36:16',''),(126,3,'سابك','SABIC','ti-layout','#1A237E','rgba(26,35,126,.1)',NULL,NULL,1,99,'2026-06-11 07:37:11','2026-08-15 09:40:33','6f63a703-800f-44c3-9fd9-35d66dd84ba9.png'),(127,3,'معادن','Maaden','ti-layout-dashboard','#37474F','rgba(55,71,79,.1)',NULL,NULL,1,100,'2026-06-11 08:12:27','2026-08-15 09:50:47','531db27f-880b-4d3c-afd8-cf0886a5d389.png'),(128,3,'سالك','SALIC','ti-adjustments','#37474F','rgba(55,71,79,.1)',NULL,NULL,1,101,'2026-06-11 08:13:21','2026-06-11 08:13:21',''),(129,3,'دوسور','Dussur','ti-license','#37474F','rgba(55,71,79,.1)',NULL,NULL,1,102,'2026-06-11 08:14:39','2026-06-11 08:14:39',''),(135,3,'شركات تابعة لـ صندوق الاستثمارات العامة','Companies affiliated with the Public Investment Fund','ti-receipt-2','#2E7D32','rgba(46,125,50,.1)',NULL,NULL,1,108,'2026-06-11 08:27:55','2026-06-11 08:27:55',''),(131,3,'السعودية للخدمات الأرضية','Saudi Ground Services','ti-compass','#E65100','rgba(230,81,0,.1)',NULL,NULL,1,104,'2026-06-11 08:18:16','2026-08-15 07:51:11','1301bae1-0dd2-43f9-ac61-c3caacfd0f8e.jpg'),(132,3,'خدمات الملاحة الجوية السعودية','Saudi Air Navigation Services','ti-plane','#0277BD','rgba(2,119,189,.1)',NULL,NULL,1,105,'2026-06-11 08:18:53','2026-06-11 08:18:53',''),(133,3,'الخدمات اللوجستية السعودية','Saudi Logistics Services','ti-bus','#E65100','rgba(230,81,0,.1)',NULL,NULL,1,106,'2026-06-11 08:19:34','2026-06-11 08:19:34',''),(136,3,'الشركات التابعة لصندوق التنمية الصناعية السعودي','Companies affiliated with the Saudi Industrial Development Fund','ti-building-factory','#37474F','rgba(55,71,79,.1)',NULL,NULL,1,109,'2026-06-11 08:29:03','2026-06-11 08:29:03',''),(137,3,'شركات تابعة لـ صندوق التنمية الوطنية','Companies affiliated with the National Development Fund','ti-shield-check','#2E7D32','rgba(46,125,50,.1)',NULL,NULL,1,110,'2026-06-11 08:29:57','2026-06-11 08:29:57',''),(138,3,'الشركات التابعة للهيئة العامة للعقارات','Companies affiliated with the Real Estate General Authority','ti-hammer','#E65100','rgba(230,81,0,.1)',NULL,NULL,1,111,'2026-06-11 08:31:06','2026-06-11 08:31:06',''),(139,3,'شركات تابعة لـ الهيئة الملكية لمدينة الرياض','Companies affiliated with the Royal Commission for Riyadh City','ti-building-castle','#2E7D32','rgba(46,125,50,.1)',NULL,NULL,1,112,'2026-06-11 08:32:14','2026-06-11 08:32:14',''),(140,4,'السفارة الأمريكية في الرياض','US Embassy in Riyadh','ti-user','#0277BD','rgba(2,119,189,.1)',NULL,NULL,1,113,'2026-06-11 10:16:53','2026-06-11 10:16:53',''),(156,4,'السفارة المصرية بالسعودية','Egyptian Embassy in Saudi Arabia','ti-user','#1A237E','rgba(26,35,126,.1)',NULL,NULL,1,121,'2026-06-11 10:51:08','2026-08-25 07:09:44',''),(149,4,'السفارة الماليزية بالسعودية','Malaysian Embassy in Saudi Arabia','ti-user','#1A237E','rgba(26,35,126,.1)',NULL,NULL,1,114,'2026-06-11 10:40:34','2026-06-11 10:40:34',''),(150,4,'السفارة البريطانية بالسعودية','British Embassy in Saudi Arabia','ti-user','#1A237E','rgba(26,35,126,.1)',NULL,NULL,1,115,'2026-06-11 10:41:19','2026-06-11 10:41:19',''),(151,4,'السفارة الهولندية بالرياض','Dutch Embassy in Riyadh','ti-user','#1A237E','rgba(26,35,126,.1)',NULL,NULL,1,116,'2026-06-11 10:43:36','2026-06-11 10:43:36',''),(152,4,'السفارة الأسترالية بالرياض','Australian Embassy in Riyadh','ti-user','#1A237E','rgba(26,35,126,.1)',NULL,NULL,1,117,'2026-06-11 10:45:14','2026-06-11 10:45:14',''),(153,4,'السفارة الأيرلندية بالرياض','Irish Embassy in Riyadh','ti-user','#1A237E','rgba(26,35,126,.1)',NULL,NULL,1,118,'2026-06-11 10:47:56','2026-06-11 10:47:56',''),(154,4,'السفارة السنغافورية بالرياض','Singapore Embassy in Riyadh','ti-user','#1A237E','rgba(26,35,126,.1)',NULL,NULL,1,119,'2026-06-11 10:49:22','2026-06-11 10:49:22',''),(155,4,'السفارة السويدية بالرياض','Swedish Embassy in Riyadh','ti-user','#1A237E','rgba(26,35,126,.1)',NULL,NULL,1,120,'2026-06-11 10:50:07','2026-06-11 10:50:07',''),(157,4,'السفارة الألمانية بالسعودية','German Embassy in Saudi Arabia','ti-user','#1A237E','rgba(26,35,126,.1)',NULL,NULL,1,122,'2026-06-11 10:51:52','2026-06-11 10:51:52',''),(158,4,'سفارة البحرين بالسعودية','Bahrain Embassy in Saudi Arabia','ti-user','#1A237E','rgba(26,35,126,.1)',NULL,NULL,1,123,'2026-06-11 10:52:53','2026-08-25 06:07:55',''),(159,4,'سفارة فرنسا بالرياض','French Embassy in Riyadh','ti-user','#1A237E','rgba(26,35,126,.1)',NULL,NULL,1,124,'2026-06-11 10:53:57','2026-06-11 10:53:57',''),(160,4,'سفارة اسبانيا بالرياض','Embassy of Spain in Riyadh','ti-user','#1A237E','rgba(26,35,126,.1)',NULL,NULL,1,125,'2026-06-11 10:55:22','2026-06-11 10:55:22',''),(161,4,'القنصلية العامة الأمريكية بجدة','U.S. Consulate General in Jeddah','ti-user','#1A237E','rgba(26,35,126,.1)',NULL,NULL,1,126,'2026-06-11 11:06:15','2026-06-11 11:06:15',''),(167,4,'لقنصلية العامة المصرية بجدة','Egyptian Consulate General in Jeddah','ti-user','#1A237E','rgba(26,35,126,.1)',NULL,NULL,1,132,'2026-06-11 11:14:58','2026-06-11 11:14:58',''),(163,4,'القنصلية العامة الباكستانية بجدة','Pakistani Consulate General in Jeddah','ti-user','#1A237E','rgba(26,35,126,.1)',NULL,NULL,1,128,'2026-06-11 11:07:30','2026-06-11 11:07:30',''),(166,4,'القنصلية العامة البريطانية بجدة','British Consulate General in Jeddah','ti-user','#1A237E','rgba(26,35,126,.1)',NULL,NULL,1,131,'2026-06-11 11:12:08','2026-06-11 11:12:08',''),(165,4,'القنصلية العامة الإندونيسية بجدة','Indonesian Consulate General in Jeddah','ti-user','#1A237E','rgba(26,35,126,.1)',NULL,NULL,1,130,'2026-06-11 11:10:18','2026-06-11 11:10:18',''),(171,4,'القنصلية العامة الماليزية بجدة','Malaysian Consulate General in Jeddah','ti-user','#1A237E','rgba(26,35,126,.1)',NULL,NULL,1,134,'2026-06-11 11:29:51','2026-06-11 11:29:51',''),(170,4,'القنصلية العامة السورية بجدة','Syrian Consulate General in Jeddah','ti-user','#1A237E','rgba(26,35,126,.1)',NULL,NULL,1,133,'2026-06-11 11:26:53','2026-06-11 11:26:53',''),(172,4,'القنصلية العامة اليمنية بجدة','Yemeni Consulate General in Jeddah','ti-user','#1A237E','rgba(26,35,126,.1)',NULL,NULL,1,135,'2026-06-11 11:30:28','2026-06-11 11:30:28',''),(173,4,'القنصلية العامة الفرنسية بجدة','French Consulate General in Jeddah','ti-user','#1A237E','rgba(26,35,126,.1)',NULL,NULL,1,136,'2026-06-11 11:31:54','2026-06-11 11:31:54',''),(174,4,'القنصلية العامة الإماراتية بجدة','UAE Consulate General in Jeddah','ti-user','#1A237E','rgba(26,35,126,.1)',NULL,NULL,1,137,'2026-06-11 11:33:17','2026-06-11 11:33:17',''),(175,4,'القنصلية العامة الأمريكية بالظهران','U.S. Consulate General in Dhahran','ti-user','#1A237E','rgba(26,35,126,.1)',NULL,NULL,1,138,'2026-06-11 11:35:19','2026-06-11 11:35:19',''),(176,4,'القنصلية العامة للجمهورية اللبنانية بجدة','Consulate General of the Lebanese Republic in Jeddah','ti-user','#1A237E','rgba(26,35,126,.1)',NULL,NULL,1,139,'2026-06-11 11:38:38','2026-06-11 11:38:38',''),(177,4,'القنصلية العامة لجمهورية الهند بجدة','Consulate General of the Republic of India in Jeddah','ti-user','#1A237E','rgba(26,35,126,.1)',NULL,NULL,1,140,'2026-06-11 11:39:25','2026-06-11 11:39:25',''),(178,4,'القنصلية العامة للجمهورية التركية بجدة','Consulate General of the Republic of Turkey in Jeddah','ti-user','#1A237E','rgba(26,35,126,.1)',NULL,NULL,1,141,'2026-06-11 11:40:34','2026-06-11 11:40:34',''),(179,4,'القنصلية العامة لدولة الكويت بجدة','Consulate General of the State of Kuwait in Jeddah','ti-user','#1A237E','rgba(26,35,126,.1)',NULL,NULL,1,142,'2026-06-11 11:41:37','2026-08-15 07:39:34','ff5ecb25-505a-40a3-9e75-a40305238729.jpeg'),(180,4,'القنصلية العامة لمملكة البحرين بجدة','Consulate General of the Kingdom of Bahrain in Jeddah','ti-user','#1A237E','rgba(26,35,126,.1)',NULL,NULL,1,143,'2026-06-11 11:45:54','2026-06-11 11:45:54','');
/*!40000 ALTER TABLE `bs_entities` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bs_notifications`
--

DROP TABLE IF EXISTS `bs_notifications`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bs_notifications` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `recipient_type` enum('user','office','admin') NOT NULL DEFAULT 'user',
  `user_id` bigint(20) unsigned NOT NULL,
  `office_id` bigint(20) unsigned DEFAULT NULL,
  `sender_id` bigint(20) unsigned DEFAULT NULL,
  `type` varchar(191) NOT NULL DEFAULT 'info',
  `title` varchar(191) NOT NULL,
  `body` text NOT NULL,
  `data` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`data`)),
  `request_id` bigint(20) unsigned DEFAULT NULL,
  `is_read` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `bs_notifications_request_id_foreign` (`request_id`),
  KEY `bs_notifications_user_id_is_read_index` (`user_id`,`is_read`),
  KEY `bs_notifications_recipient_type_index` (`recipient_type`),
  KEY `bs_notifications_office_id_index` (`office_id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bs_notifications`
--

LOCK TABLES `bs_notifications` WRITE;
/*!40000 ALTER TABLE `bs_notifications` DISABLE KEYS */;
INSERT INTO `bs_notifications` VALUES (1,'user',30,NULL,NULL,'request_submitted','تم استلام طلبك','تم استلام طلبك #AMR-XN8PKH بنجاح وهو قيد المراجعة.',NULL,1,0,'2026-07-25 12:22:43','2026-07-25 12:22:43'),(2,'user',11,NULL,NULL,'request_submitted','طلب جديد','طلب جديد #AMR-XN8PKH من Maram',NULL,1,0,'2026-07-25 12:22:43','2026-07-25 12:22:43'),(3,'user',30,NULL,NULL,'status_update','تحديث طلب #AMR-XN8PKH','تم تحديث حالة طلبك #AMR-XN8PKH إلى: تمت العملية',NULL,1,0,'2026-07-25 12:26:16','2026-07-25 12:26:16');
/*!40000 ALTER TABLE `bs_notifications` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bs_office_documents`
--

DROP TABLE IF EXISTS `bs_office_documents`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bs_office_documents` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `office_id` bigint(20) unsigned NOT NULL,
  `document_type` text NOT NULL,
  `file` varchar(191) NOT NULL,
  `file_name` varchar(191) DEFAULT NULL,
  `is_verified` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `bs_office_documents_office_id_foreign` (`office_id`)
) ENGINE=InnoDB AUTO_INCREMENT=322 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bs_office_documents`
--

LOCK TABLES `bs_office_documents` WRITE;
/*!40000 ALTER TABLE `bs_office_documents` DISABLE KEYS */;
INSERT INTO `bs_office_documents` VALUES (289,5,'commercial_ad','office_documents/5/DNeWftz4duKJ47B2lm5MeZT1YN1II99M08vmyjn8.png','Screenshot 2026-07-28 175906.png',0,'2026-08-11 09:23:59','2026-08-11 09:23:59'),(290,5,'license','office_documents/5/UP6tjgSnhTNsW5TWB7DPnXFnq7IERP4RZxIESjF7.png','Screenshot 2026-07-26 135452.png',0,'2026-08-11 09:23:59','2026-08-11 09:23:59'),(291,5,'commercial_register','office_documents/5/p85MVqIWxS9MryqeyKfrqULeZxEKqBU3kpqOPxxF.png','Screenshot 2026-07-29 122142.png',0,'2026-08-11 09:23:59','2026-08-11 09:23:59'),(292,5,'professional_certificate','office_documents/5/F0N21BhFZtxfgwXIFpEyK5tpWaFvUNN1PkTWff5u.png','Screenshot 2026-07-29 112212.png',0,'2026-08-11 09:23:59','2026-08-11 09:23:59'),(293,5,'cv','office_documents/5/RbTE7TsGIyqnMJQAxMrSv0pG5vZ6QnF2lWljZiRS.png','Screenshot 2026-07-30 113527.png',0,'2026-08-11 09:23:59','2026-08-11 09:23:59'),(294,5,'appreciation_certificate','office_documents/5/appreciation/k0MsjhZoA4oPfwaw3tijQIcpwYM7f5rGj6MeV7ZG.png','Screenshot 2026-08-01 141125.png',0,'2026-08-11 09:23:59','2026-08-11 09:23:59'),(295,6,'commercial_ad','office_documents/6/CtEyUa3cnholJHmjXA4jOLAB9vbAuzvk4F5j41kW.png','Screenshot 2026-07-28 175655.png',0,'2026-08-11 09:35:38','2026-08-11 09:35:38'),(296,6,'license','office_documents/6/TpIVjVPFJeiiBKNDyKAD0umdIKdietvX68IlFHcL.png','Screenshot 2026-07-29 112212.png',0,'2026-08-11 09:35:38','2026-08-11 09:35:38'),(297,6,'commercial_register','office_documents/6/lZ9Ud5uubRUBSgawZ0hFA7PbB2WfiwdG7ZOW5RAY.png','Screenshot 2026-08-03 154030.png',0,'2026-08-11 09:35:38','2026-08-11 09:35:38'),(298,6,'professional_certificate','office_documents/6/qezNRolSrSpMoaf8mbhERsiCVxXX9nKj1giKIDtQ.png','Screenshot 2026-08-01 173052.png',0,'2026-08-11 09:35:38','2026-08-11 09:35:38'),(299,6,'cv','office_documents/6/iDTbW5RBZ8GUGLt6DMs2QGtoUXJHXsNLmY44sg98.pdf','pdf.pdf',0,'2026-08-11 09:35:38','2026-08-11 09:35:38'),(300,6,'appreciation_certificate','office_documents/6/appreciation/ynX26gUNxqAuWPoVq1EouoKyXDd71IWVl1sn0QJS.png','Screenshot 2026-07-28 175655.png',0,'2026-08-11 09:35:38','2026-08-11 09:35:38'),(301,7,'commercial_ad','office_documents/7/Pu5pITHOPmoTcPLp0zDX2F1yMWcqtOOBjxwgT4ln.pdf','pdf.pdf',0,'2026-08-11 09:41:53','2026-08-11 09:41:53'),(302,7,'license','office_documents/7/fGRyDIJcNN4SIgcD7v5nAapak26Tq2DUtYneD0dV.jpg','maxresdefault.jpg',0,'2026-08-11 09:41:53','2026-08-11 09:41:53'),(303,7,'commercial_register','office_documents/7/zqXqCaDTRlNNSk0ExGoGTzJWl6xHGsFQV18JpGAH.jpg','وزارة الاقتصاد والتخطيط.jpg',0,'2026-08-11 09:41:53','2026-08-11 09:41:53'),(304,7,'professional_certificate','office_documents/7/uNlKo3m3ISqw0VQhKI1epdJ2StxD3den5LU0LGkN.jpg','WhatsApp Image 2026-07-28 at 5.08.24 PM.jpeg',0,'2026-08-11 09:41:53','2026-08-11 09:41:53'),(305,7,'cv','office_documents/7/mGcOzuEUWADFPo6WazTfP6DC9fHBqDEXvofShAMf.jpg','WhatsApp Image 2026-07-23 at 10.57.09 AM.jpeg',0,'2026-08-11 09:41:53','2026-08-11 09:41:53'),(306,7,'appreciation_certificate','office_documents/7/appreciation/YRNWYCUE2xWRBJLy5q5pM8b7yWMF9V7guyh0fxAw.jpg','الرياضه.jpg',0,'2026-08-11 09:41:53','2026-08-11 09:41:53'),(307,8,'commercial_ad','office_documents/8/08hbjFkVBmVg4yjPH16BO0O0pEKg25lEDD9GA6Xq.jpg','وزارة الاقتصاد والتخطيط.jpg',0,'2026-08-11 10:16:38','2026-08-11 10:16:38'),(308,8,'license','office_documents/8/XHy4iL2ESLQO9tjL2iaU2FJE2AyTz13kKHzfcC5m.jpg','maxresdefault.jpg',0,'2026-08-11 10:16:38','2026-08-11 10:16:38'),(309,8,'commercial_register','office_documents/8/79qxfSSCyc8HmHg5jW2rEADwncjONw8NWlm0w1df.pdf','pdf.pdf',0,'2026-08-11 10:16:38','2026-08-11 10:16:38'),(310,8,'professional_certificate','office_documents/8/TaJWjPpogtvZ7rP3w3Ivu15aTsogyo5LpUQfaFGM.pdf','amrtm background (1).pdf',0,'2026-08-11 10:16:38','2026-08-11 10:16:38'),(311,8,'cv','office_documents/8/a0qiww8prxpLHkEzvT8BWaXafySSY1kWLnNwgTDl.jpg','WhatsApp Image 2026-07-28 at 5.08.24 PM.jpeg',0,'2026-08-11 10:16:38','2026-08-11 10:16:38'),(312,8,'appreciation_certificate','office_documents/8/appreciation/C5Jfy5kkML3x08AVtz2CTDdJ4Merpb5b61yEigyu.jpg','وزارة الماليةة.jpg',0,'2026-08-11 10:16:38','2026-08-11 10:16:38'),(313,9,'commercial_ad','office_documents/9/F5cUAS6CK1u3OZvikK2AWOexVGIEPFwURBk9USRM.png','Screenshot 2026-07-29 122142.png',0,'2026-08-11 12:23:04','2026-08-11 12:23:04'),(314,9,'license','office_documents/9/LB5axDRRVR8TjuqBYl8oUozzaYNJ3mLHRznFaDic.png','Screenshot 2026-07-29 113813.png',0,'2026-08-11 12:23:04','2026-08-11 12:23:04'),(315,9,'commercial_register','office_documents/9/75s7rCqOIu6saCqoFJ9OCpYrqj1sv5KFQEzekFRm.png','Screenshot 2026-07-28 175906.png',0,'2026-08-11 12:23:04','2026-08-11 12:23:04'),(316,9,'professional_certificate','office_documents/9/3JRJlicGykp4BhYR6weeWOQzhV4d2mwo6vuLTb2z.png','Screenshot 2026-07-29 112212.png',0,'2026-08-11 12:23:04','2026-08-11 12:23:04'),(317,9,'cv','office_documents/9/TXigVU3tmR5vu6nhVYSrZi9pQmBE8LWXSxPzp8ag.png','Screenshot 2026-07-26 123432.png',0,'2026-08-11 12:23:04','2026-08-11 12:23:04'),(318,9,'appreciation_certificate','office_documents/9/appreciation/2d3cFJWpkl9lkYdmWQg26ivuz2wbOpG4mV1de8DQ.png','Screenshot 2026-07-26 123439.png',0,'2026-08-11 12:23:04','2026-08-11 12:23:04'),(319,29,'commercial_register','office-documents/29/commercial-register/nQTMe8tC8dRyuQybpmMjQltblE8oCugyMEzkDDvT.png','منصة-آمر-تم-Amrtm-Platform-08-25-2026_06_14_PM (1).png',0,'2026-08-27 07:44:03','2026-08-27 07:44:03'),(320,29,'license','office-documents/29/license/11kBEk0HB2Q9D430IxdDYX4AWOgigqUNdrshBTdl.png','منصة-آمر-تم-Amrtm-Platform-08-25-2026_06_14_PM (1).png',0,'2026-08-27 07:44:03','2026-08-27 07:44:03'),(321,29,'cv','office-documents/29/cv/5hkLYbCHGCZIv8WwUktehkDLyqIx5XebcAZSalYQ.docx','صفحة المستشارين.docx',0,'2026-08-27 07:44:03','2026-08-27 07:44:03');
/*!40000 ALTER TABLE `bs_office_documents` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bs_office_messages`
--

DROP TABLE IF EXISTS `bs_office_messages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bs_office_messages` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `request_id` bigint(20) unsigned NOT NULL,
  `office_id` bigint(20) unsigned NOT NULL,
  `sender_type` enum('office','client') NOT NULL,
  `sender_id` bigint(20) unsigned DEFAULT NULL,
  `message` text NOT NULL,
  `attachments` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`attachments`)),
  `is_read` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `bs_office_messages_request_id_foreign` (`request_id`),
  KEY `bs_office_messages_office_id_foreign` (`office_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bs_office_messages`
--

LOCK TABLES `bs_office_messages` WRITE;
/*!40000 ALTER TABLE `bs_office_messages` DISABLE KEYS */;
/*!40000 ALTER TABLE `bs_office_messages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bs_office_profiles`
--

DROP TABLE IF EXISTS `bs_office_profiles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bs_office_profiles` (
  `office_id` bigint(20) unsigned NOT NULL,
  `license_number` varchar(191) NOT NULL,
  `cr_number` varchar(191) NOT NULL,
  `mobile` varchar(191) DEFAULT NULL,
  `country` varchar(191) DEFAULT NULL,
  `governorate` varchar(191) DEFAULT NULL,
  `city` varchar(191) DEFAULT NULL,
  `district` varchar(191) DEFAULT NULL,
  `street` varchar(191) DEFAULT NULL,
  `building_number` varchar(191) DEFAULT NULL,
  `office_number` varchar(191) DEFAULT NULL,
  `description_ar` longtext DEFAULT NULL,
  `description_en` longtext DEFAULT NULL,
  `handled_cases` int(10) unsigned NOT NULL DEFAULT 0,
  `custom_specialty` varchar(191) DEFAULT NULL,
  `profile_completed` tinyint(1) NOT NULL DEFAULT 0,
  `verification_status` enum('draft','pending','approved','rejected') NOT NULL DEFAULT 'draft',
  `submitted_at` timestamp NULL DEFAULT NULL,
  `approved_at` timestamp NULL DEFAULT NULL,
  `office_code` varchar(191) DEFAULT NULL,
  `qr_code` varchar(191) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `trademark_registration_number` varchar(191) DEFAULT NULL,
  UNIQUE KEY `bs_office_profiles_office_id_unique` (`office_id`),
  UNIQUE KEY `bs_office_profiles_license_number_unique` (`license_number`),
  UNIQUE KEY `bs_office_profiles_cr_number_unique` (`cr_number`),
  UNIQUE KEY `bs_office_profiles_office_code_unique` (`office_code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bs_office_profiles`
--

LOCK TABLES `bs_office_profiles` WRITE;
/*!40000 ALTER TABLE `bs_office_profiles` DISABLE KEYS */;
INSERT INTO `bs_office_profiles` VALUES (29,'6734677356','6574746','5890863906','vewvew','vewv','vew','jkwjvw','vwevew','vewvwevwe',NULL,NULL,NULL,0,NULL,1,'pending','2026-08-27 07:44:03',NULL,'OFF-000029',NULL,'2026-08-27 07:44:03','2026-08-27 07:44:03',NULL);
/*!40000 ALTER TABLE `bs_office_profiles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bs_office_requests`
--

DROP TABLE IF EXISTS `bs_office_requests`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bs_office_requests` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `ref_number` varchar(191) NOT NULL,
  `user_id` bigint(20) unsigned NOT NULL,
  `office_id` bigint(20) unsigned NOT NULL,
  `office_service_id` bigint(20) unsigned NOT NULL,
  `client_name` varchar(191) NOT NULL,
  `client_phone` varchar(191) NOT NULL,
  `client_email` varchar(191) NOT NULL,
  `client_id_number` varchar(191) DEFAULT NULL,
  `notes` text DEFAULT NULL,
  `attachments` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`attachments`)),
  `price` decimal(10,2) NOT NULL DEFAULT 0.00,
  `commission_amount` decimal(10,2) NOT NULL DEFAULT 0.00,
  `status` enum('pending','accepted','in_progress','waiting_docs','done','rejected') NOT NULL DEFAULT 'pending',
  `office_note` text DEFAULT NULL,
  `completed_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `bs_office_requests_ref_number_unique` (`ref_number`),
  KEY `bs_office_requests_office_id_foreign` (`office_id`),
  KEY `bs_office_requests_office_service_id_foreign` (`office_service_id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bs_office_requests`
--

LOCK TABLES `bs_office_requests` WRITE;
/*!40000 ALTER TABLE `bs_office_requests` DISABLE KEYS */;
INSERT INTO `bs_office_requests` VALUES (1,'OF-3904708D',44,9,3,'Saleh Alshmrani','+966556535777','h.alkobati@gmail.com',NULL,NULL,NULL,10.00,1.00,'pending',NULL,NULL,'2026-08-16 09:39:16','2026-08-16 09:39:16'),(2,'OF-17E9892A',44,9,3,'Saleh Alshmrani','+966556535777','h.alkobati@gmail.com',NULL,NULL,NULL,10.00,1.00,'pending',NULL,NULL,'2026-08-16 09:39:20','2026-08-16 09:39:20'),(3,'OF-CEE9557D',44,9,3,'Saleh Alshmrani','+966556535777','h.alkobati@gmail.com',NULL,NULL,NULL,10.00,1.00,'pending',NULL,NULL,'2026-08-16 09:39:25','2026-08-16 09:39:25'),(4,'OF-4D67088E',44,9,3,'Saleh Alshmrani','+966556535777','h.alkobati@gmail.com',NULL,NULL,NULL,10.00,1.00,'pending',NULL,NULL,'2026-08-16 10:24:50','2026-08-16 10:24:50'),(5,'OF-545432A3',44,9,3,'Saleh Alshmrani','+966556535777','h.alkobati@gmail.com',NULL,NULL,NULL,10.00,1.00,'pending',NULL,NULL,'2026-08-16 10:25:05','2026-08-16 10:25:05');
/*!40000 ALTER TABLE `bs_office_requests` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bs_office_services`
--

DROP TABLE IF EXISTS `bs_office_services`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bs_office_services` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `office_id` bigint(20) unsigned NOT NULL,
  `name_ar` varchar(191) NOT NULL,
  `name_en` varchar(191) NOT NULL,
  `description_ar` text DEFAULT NULL,
  `description_en` text DEFAULT NULL,
  `price` decimal(10,2) NOT NULL DEFAULT 0.00,
  `duration` varchar(191) DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `sort_order` smallint(5) unsigned NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `bs_office_services_office_id_foreign` (`office_id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bs_office_services`
--

LOCK TABLES `bs_office_services` WRITE;
/*!40000 ALTER TABLE `bs_office_services` DISABLE KEYS */;
INSERT INTO `bs_office_services` VALUES (1,3,'استخراج جواز السفر','Passport Issuance','فافافافا','jhtghtttghtgth',10.00,'5',1,1,'2026-08-06 11:25:17','2026-08-06 11:25:17'),(2,7,'استخراج جواز السفر','Passport Issuance','اااتاغعغفبغت','hjfhfbdffdfddgbfdfd',10.00,'5',1,1,'2026-08-11 09:42:59','2026-08-11 09:42:59'),(3,9,'استخراج جواز السفر','Passport Issuance','fhbff','ff',10.00,'5',1,1,'2026-08-15 10:19:44','2026-08-15 10:19:44');
/*!40000 ALTER TABLE `bs_office_services` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bs_office_specialties`
--

DROP TABLE IF EXISTS `bs_office_specialties`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bs_office_specialties` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `office_id` bigint(20) unsigned NOT NULL,
  `specialty_id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `bs_office_specialties_office_id_specialty_id_unique` (`office_id`,`specialty_id`),
  KEY `bs_office_specialties_specialty_id_foreign` (`specialty_id`)
) ENGINE=InnoDB AUTO_INCREMENT=52 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bs_office_specialties`
--

LOCK TABLES `bs_office_specialties` WRITE;
/*!40000 ALTER TABLE `bs_office_specialties` DISABLE KEYS */;
INSERT INTO `bs_office_specialties` VALUES (48,5,1,NULL,NULL),(49,6,26,NULL,NULL),(50,9,93,NULL,NULL),(51,29,76,'2026-08-27 07:44:03','2026-08-27 07:44:03');
/*!40000 ALTER TABLE `bs_office_specialties` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bs_office_users`
--

DROP TABLE IF EXISTS `bs_office_users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bs_office_users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `office_id` bigint(20) unsigned NOT NULL,
  `name` varchar(191) NOT NULL,
  `email` varchar(191) NOT NULL,
  `password` varchar(191) NOT NULL,
  `role` enum('owner','manager','staff') NOT NULL DEFAULT 'owner',
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `bs_office_users_email_unique` (`email`),
  KEY `bs_office_users_office_id_foreign` (`office_id`)
) ENGINE=MyISAM AUTO_INCREMENT=29 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bs_office_users`
--

LOCK TABLES `bs_office_users` WRITE;
/*!40000 ALTER TABLE `bs_office_users` DISABLE KEYS */;
INSERT INTO `bs_office_users` VALUES (1,1,'ساره  رياض الفريح','sara_alfuraih@najdsteel.com','$2y$12$IzeSmKdVqbe08LqVb0YDwOP4F6xPKqdam/HUuLJ4Vn61/Bz4BwA3K','owner',1,NULL,'2026-05-24 04:41:12','2026-05-24 04:41:12'),(2,2,'mohamed','alsmohamed01@gmaol.com','$2y$12$qf9xk4hcbLQJE5npbboAdexJIbBjs6eSI9cqcl4RUF9hQCGgUyuGa','owner',1,NULL,'2026-08-05 07:22:58','2026-08-05 07:22:58'),(3,3,'mohamed','alsmmohamed01@gmaol.com','$2y$12$s7KqYlYIKexdfrcXDP1ifOhVHN2yX13VihYYj8XduW9WVWvtWvNYO','owner',1,NULL,'2026-08-06 11:22:51','2026-08-06 11:22:51'),(4,4,'عبد العزيز','aziz.kza99@gmail.com','$2y$12$H2hBFQbRusYdoBmGp.Kkuue2Kl1DMr1OXAfP8gEBP22fxiW/rJW2O','owner',1,'wD9Hst4jDlgpufLfC55vHvRnnHDhDX4bXLJrigrpHmxbLoZepkpqjmdO5l3B','2026-08-09 17:45:54','2026-08-09 17:45:54'),(5,5,'mohamed','mohamedc444@gmaol.com','$2y$12$XlTqEGbwjvIsNd8GD723Tea0jqWb/9Psuvk0604ybEbKC3i8Y3Tpa','owner',1,NULL,'2026-08-11 09:23:19','2026-08-11 09:23:19'),(6,6,'mohamed','handsa44@gmaol.com','$2y$12$lXCPqW1kcxDdjnCfH3fqHOmmCGlVsl5CsiqULjYkidtuBQGudHB0W','owner',1,NULL,'2026-08-11 09:34:49','2026-08-11 09:34:49'),(7,7,'علي ابراهيم','Aliebrahim4584@gmaol.com','$2y$12$xT7LZZJ/oo3gLdEjDg3niuvnIhTcrG97RlYtvu84Ri4cempWTSclu','owner',1,NULL,'2026-08-11 09:40:30','2026-08-11 09:40:30'),(8,8,'علي ابراهيم','sfsdgsdrgdgddf@gmaol.com','$2y$12$TRRrDRTwT61v79l1dyLFUu8kyBleTWO.bu7IARXLM5OwMFDH.LQ3O','owner',1,NULL,'2026-08-11 10:15:02','2026-08-11 10:15:02'),(9,9,'علي ابراهيم','dgsgdhdhdhd4@gmaol.com','$2y$12$kwe9LtuHGktfWwBIifGm/O8Dh5bcZzJMnaLt3IL02nDxJSDxsgnGW','owner',1,NULL,'2026-08-11 12:19:50','2026-08-11 12:19:50'),(10,10,'احمد','AHMED@GMAIL.com','$2y$12$DVgfW.bvvCkqbVF58vup6.dksGwKUVL2H6eRG3HYiYNOzhel2VyZ2','owner',1,NULL,'2026-08-11 12:44:08','2026-08-11 12:44:08'),(11,11,'علي ابراهيم','Aliebrah8578577im4584@gmaol.com','$2y$12$t6owiu7JFfEW4siXnqrGsu.Sb5SbrzvpzULWEFtz1dBF9dpvUF9Ey','owner',1,NULL,'2026-08-12 08:28:39','2026-08-12 08:28:39'),(12,12,'علي ابراهيم','dgh5588dhd4@gmaol.com','$2y$12$.AlciOgOaqVwcQpj1b7oAuLjVhXkCeQtNXLzmBxcWmcIpihhv1tz6','owner',1,NULL,'2026-08-12 09:55:21','2026-08-12 09:55:21'),(13,13,'علي ابراهيم','dgh5gghght588dhd4@gmaol.com','$2y$12$alf1jzxVVEvzr.ICXG6GwuHftHOtJ.tm5oC7RP3Z2R/HFZ7TSoBVi','owner',1,NULL,'2026-08-12 10:17:44','2026-08-12 10:17:44'),(14,14,'علي ابراهيم','dgh5gghg88dhd4@gmaol.com','$2y$12$k27g3ZsfL3WA1hXm3x4fLO5T5HAkkUQL6HiGTUXpV6rS/pQU5yRgq','owner',1,NULL,'2026-08-12 10:39:22','2026-08-12 10:39:22'),(15,15,'علي ابراهيم','dghdhd4@gmaol.com','$2y$12$PWrc1/uo1sKAV00qYykdQusUpvwDXCTmnQCoV.oGV.kqTZROyXnu2','owner',1,NULL,'2026-08-13 04:52:54','2026-08-13 04:52:54'),(16,16,'صالح الشمراني','salehalshamrani@hotmail.com','$2y$12$MoHxdBPCjD.c9eNBY2NhfuEBlL0hQgGnvf8pxv.e7OKfGlJ7A9Hse','owner',1,NULL,'2026-08-13 06:28:11','2026-08-13 06:28:11'),(17,17,'احمد','salehmrani@hotmail.com','$2y$12$GFecQpvE2AAhvW74rzVJmeGu2UeVyXOmlFkMscnZbVnbArpZ6YKZO','owner',1,NULL,'2026-08-15 13:02:18','2026-08-15 13:02:18'),(18,18,'صالح الشمراني','alshamrani@hotmail.com','$2y$12$Fuladw76xnQmd3iRLNN3UeLP5mnv7wkOmAvj50vLWItXJ/2lfkiA6','owner',1,NULL,'2026-08-16 08:56:24','2026-08-16 08:56:24'),(19,19,'محمود عادل','5755555@gmaol.com','$2y$12$b.Pt7aSp7y8mVv8rCfnjyu3XO0LCcTaIGhyZ2Bpf/dsyw3BsQNK4.','owner',1,NULL,'2026-08-16 12:17:17','2026-08-16 12:17:17'),(20,20,'محمود عادل','mohamed545@gmail.com','$2y$12$ohsAfjtJt9BeiW384igzauba6rYGJuoWV5jEBF8LNtjWSe4YMgDvu','owner',1,NULL,'2026-08-16 12:21:06','2026-08-16 12:21:06'),(21,21,'محمود عادل','fhfhffff54@gmaol.com','$2y$12$zhf/MG4ileMxP9hP5LVxKOlEmFl1.M9PtXT4716bl/ZovW5ee1x4.','owner',1,NULL,'2026-08-16 12:39:43','2026-08-16 12:39:43'),(22,22,'محمود عادل','fhfhfffr34@gmaol.com','$2y$12$xYQre6WrNhTdC8AtWDLheOKL9.8rsZRQIpLFzXFgNGcozsS/L69V6','owner',1,NULL,'2026-08-16 13:10:30','2026-08-16 13:10:30'),(23,23,'محمد','elsmohamed01@gmail.com','$2y$12$SgV7HBIagsnPRMY3u9/tV.JziEb64WK2OUWdwYsqdb3txsv6t6Hfi','owner',1,NULL,'2026-08-16 14:32:52','2026-08-16 14:32:52'),(24,24,'محمد','elsmoha7654med01@gmail.com','$2y$12$07m0UYXliGBPUUj6PJcSCuJzOZXVLXxzbvXhac7mV49TCV4lwupzK','owner',1,NULL,'2026-08-16 15:04:36','2026-08-16 15:04:36'),(25,25,'محمد','elsmohamed76501@gmail.com','$2y$12$IYiM1tEa7jLBoEWUyZGWG.1UsIX7OOuUD.G5zwQHK8nqt4jyPF69C','owner',1,NULL,'2026-08-24 11:17:14','2026-08-24 11:17:14'),(26,26,'محمد','elsmohamed76544501@gmail.com','$2y$12$shSG9AO1uxURAA/EIRo4LeK.Vq2cZfURu0rmj0/MgsHwmKD3ddwFm','owner',1,NULL,'2026-08-24 11:18:36','2026-08-24 11:18:36'),(27,27,'hisham admin name','hishamkassi@gmail.com','$2y$12$Ri0YvtL9PuEZNC01BmyM3uyDuv7tPHAydf.oYa1pZfvg2nDZHeTxu','owner',1,NULL,'2026-08-27 07:25:30','2026-08-27 07:25:30'),(28,29,'hishamadminname','hishamqasem2022@gmail.com','$2y$12$AIWUyQ/Eeh/HfFOqnUcsh.E9Lq71bI3Equp8iWtZS3Z09s/AKvRWa','owner',1,NULL,'2026-08-27 07:44:03','2026-08-27 07:44:03');
/*!40000 ALTER TABLE `bs_office_users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bs_offices`
--

DROP TABLE IF EXISTS `bs_offices`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bs_offices` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `type` enum('law','services','customs','accounting','engineering','freelance') NOT NULL,
  `name_ar` varchar(191) NOT NULL,
  `name_en` varchar(191) NOT NULL,
  `description_ar` text DEFAULT NULL,
  `description_en` text DEFAULT NULL,
  `phone` varchar(191) NOT NULL,
  `email` varchar(191) NOT NULL,
  `city` varchar(191) DEFAULT NULL,
  `cr_number` varchar(191) DEFAULT NULL,
  `logo` varchar(191) DEFAULT NULL,
  `specialties` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`specialties`)),
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `is_verified` tinyint(1) NOT NULL DEFAULT 0,
  `commission_rate` decimal(5,2) NOT NULL DEFAULT 0.00,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `office_code` varchar(60) NOT NULL,
  `public_token` varchar(60) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `bs_offices_email_unique` (`email`)
) ENGINE=MyISAM AUTO_INCREMENT=30 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bs_offices`
--

LOCK TABLES `bs_offices` WRITE;
/*!40000 ALTER TABLE `bs_offices` DISABLE KEYS */;
INSERT INTO `bs_offices` VALUES (3,'law','مكتب العدل','oficeeduction',NULL,NULL,'0570324077','alsmmohamed01@gmaol.com','ريااض','12458596565',NULL,NULL,1,0,0.00,'2026-08-06 11:22:51','2026-08-06 11:22:51','',''),(22,'law','علي ابراهيم','علي ابراهيم',NULL,NULL,'0570324077','fhfhfffr34@gmaol.com','جده','6444464',NULL,NULL,1,0,0.00,'2026-08-16 13:10:30','2026-08-16 13:10:30','OF-CCY34M','4mjOgeNyQiLPa3FKSWX0wbhATbd9layH2NO0tdnO'),(23,'services','Mohamed Elsyed','Mohamed Elsyed',NULL,NULL,'0570324077','elsmohamed01@gmail.com','جده','5459559',NULL,NULL,1,0,0.00,'2026-08-16 14:32:52','2026-08-16 14:32:52','OFF-000023','4y8UQc1aIK1xW0Z8hEYduXQ6gMayfIDhcNzU4BDq'),(24,'services','Mohamed Elsyed','Mohamed Elsyed',NULL,NULL,'0570324077','elsmoha7654med01@gmail.com','الزهراء','5459559',NULL,NULL,1,0,0.00,'2026-08-16 15:04:36','2026-08-16 15:04:36','OFF-000024','3bmKHaXg4ORI6Ad9mrfFFzQPudQTZqQuBH1NrAUt'),(25,'customs','Mohamed Elsyed','Mohamed Elsyed',NULL,NULL,'0570324077','elsmohamed76501@gmail.com','جده','533566',NULL,NULL,1,0,0.00,'2026-08-24 11:17:14','2026-08-24 11:17:14','OFF-000025','NG1k2jvjFOwaEYrydzNpSklfIDrA8SfLm7YrJI0a'),(26,'customs','Mohamed Elsyed','Mohamed Elsyed',NULL,NULL,'0570324077','elsmohamed76544501@gmail.com','جده','533566',NULL,NULL,1,0,0.00,'2026-08-24 11:18:36','2026-08-24 11:18:36','OFF-000026','1H0JppDzn6rs5plg58iQfxgmPWGKZTNNzBgXzmJ1'),(27,'law','hisham ar','nameEn',NULL,NULL,'5890863906','hishamkassi@gmail.com','vew','6574746',NULL,NULL,1,0,0.00,'2026-08-27 07:25:30','2026-08-27 07:25:30','OFF-000027','Gp3Ew4GQ48snJCRWwN9R8NrrQ1pudB9dtL2jU80g'),(28,'law','مكتب تجريبي','Test Office',NULL,NULL,'0512345678','test_tm_1787827057@example.com','Riyadh','123456',NULL,NULL,1,0,0.00,'2026-08-27 07:37:37','2026-08-27 07:37:37','OFF-000028','h4WCS3cCWnDLiau0VAuDRieSRappNeuHKTirNEKL'),(29,'law','hishamar','nameEn',NULL,NULL,'5890863906','hishamqasem2022@gmail.com','vew','6574746',NULL,NULL,1,0,0.00,'2026-08-27 07:44:03','2026-08-27 07:44:03','OFF-000029','kZtVASOZCiWysqspgtUmIEDVRgLXxUF8b2kU0sr6');
/*!40000 ALTER TABLE `bs_offices` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bs_payments`
--

DROP TABLE IF EXISTS `bs_payments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bs_payments` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned NOT NULL,
  `request_id` bigint(20) unsigned DEFAULT NULL,
  `amount` decimal(10,2) NOT NULL,
  `type` enum('charge','payment','refund') NOT NULL DEFAULT 'charge',
  `description_ar` varchar(191) DEFAULT NULL,
  `description_en` varchar(191) DEFAULT NULL,
  `status` enum('pending','completed','failed') NOT NULL DEFAULT 'completed',
  `transaction_ref` varchar(191) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `bs_payments_transaction_ref_unique` (`transaction_ref`),
  KEY `bs_payments_request_id_foreign` (`request_id`),
  KEY `bs_payments_user_id_index` (`user_id`),
  KEY `bs_payments_user_id_type_index` (`user_id`,`type`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bs_payments`
--

LOCK TABLES `bs_payments` WRITE;
/*!40000 ALTER TABLE `bs_payments` DISABLE KEYS */;
INSERT INTO `bs_payments` VALUES (1,30,NULL,300.00,'charge','شحن رصيد من الإدارة','Admin balance charge','completed',NULL,'2026-06-20 11:07:06','2026-06-20 11:07:06'),(2,30,1,300.00,'payment','دفع خدمة: استخراج جواز السفر','Service payment: Passport Issuance','completed',NULL,'2026-07-25 12:22:43','2026-07-25 12:22:43'),(3,27,NULL,100.00,'charge','شحن رصيد من الإدارة','Admin balance charge','completed',NULL,'2026-08-17 09:25:05','2026-08-17 09:25:05');
/*!40000 ALTER TABLE `bs_payments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bs_request_logs`
--

DROP TABLE IF EXISTS `bs_request_logs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bs_request_logs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `request_id` bigint(20) unsigned NOT NULL,
  `user_id` bigint(20) unsigned DEFAULT NULL,
  `status` varchar(191) NOT NULL,
  `log_type` varchar(191) NOT NULL DEFAULT 'status_change',
  `note` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `bs_request_logs_request_id_foreign` (`request_id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bs_request_logs`
--

LOCK TABLES `bs_request_logs` WRITE;
/*!40000 ALTER TABLE `bs_request_logs` DISABLE KEYS */;
INSERT INTO `bs_request_logs` VALUES (1,1,30,'pending','status_change','تم تقديم الطلب','2026-07-25 12:22:43','2026-07-25 12:22:43'),(2,1,11,'done','status_change',NULL,'2026-07-25 12:26:16','2026-07-25 12:26:16');
/*!40000 ALTER TABLE `bs_request_logs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bs_requests`
--

DROP TABLE IF EXISTS `bs_requests`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bs_requests` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `ref_number` varchar(191) NOT NULL,
  `user_id` bigint(20) unsigned NOT NULL,
  `service_id` bigint(20) unsigned NOT NULL,
  `entity_id` bigint(20) unsigned NOT NULL,
  `client_name` varchar(191) NOT NULL,
  `client_email` varchar(191) NOT NULL,
  `client_phone` varchar(191) NOT NULL,
  `client_id_number` varchar(191) NOT NULL,
  `company_name` varchar(191) DEFAULT NULL,
  `company_cr` varchar(191) DEFAULT NULL,
  `notes` text DEFAULT NULL,
  `attachments` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`attachments`)),
  `price` decimal(10,2) NOT NULL DEFAULT 0.00,
  `status` enum('pending','processing','in_progress','done','rejected') NOT NULL DEFAULT 'pending',
  `reject_reason` text DEFAULT NULL,
  `estimated_completion` varchar(191) DEFAULT NULL,
  `completed_at` timestamp NULL DEFAULT NULL,
  `handled_by` bigint(20) unsigned DEFAULT NULL,
  `office_id` bigint(20) unsigned DEFAULT NULL,
  `office_status` enum('pending','accepted','in_progress','waiting_docs','done','rejected') DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `bs_requests_ref_number_unique` (`ref_number`),
  KEY `bs_requests_service_id_foreign` (`service_id`),
  KEY `bs_requests_entity_id_foreign` (`entity_id`),
  KEY `bs_requests_user_id_index` (`user_id`),
  KEY `bs_requests_status_index` (`status`),
  KEY `bs_requests_user_id_status_index` (`user_id`,`status`),
  KEY `bs_requests_status_created_at_index` (`status`,`created_at`),
  KEY `bs_requests_office_id_foreign` (`office_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bs_requests`
--

LOCK TABLES `bs_requests` WRITE;
/*!40000 ALTER TABLE `bs_requests` DISABLE KEYS */;
INSERT INTO `bs_requests` VALUES (1,'AMR-XN8PKH',30,1,1,'Maram','maramhtt611999@gmail.com','0598581863','1234567890','gjgjfgjfg','1234567',NULL,NULL,300.00,'done',NULL,NULL,'2026-07-25 12:26:16',11,NULL,NULL,'2026-07-25 12:22:43','2026-07-25 12:26:16');
/*!40000 ALTER TABLE `bs_requests` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bs_services`
--

DROP TABLE IF EXISTS `bs_services`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bs_services` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `entity_id` bigint(20) unsigned NOT NULL,
  `name_ar` varchar(191) NOT NULL,
  `name_en` varchar(191) NOT NULL,
  `icon` varchar(191) NOT NULL DEFAULT 'ti-file-text',
  `price` decimal(10,2) NOT NULL DEFAULT 0.00,
  `description_ar` text DEFAULT NULL,
  `description_en` text DEFAULT NULL,
  `estimated_days` int(11) NOT NULL DEFAULT 3,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `sort_order` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `bs_services_entity_id_foreign` (`entity_id`)
) ENGINE=MyISAM AUTO_INCREMENT=155 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bs_services`
--

LOCK TABLES `bs_services` WRITE;
/*!40000 ALTER TABLE `bs_services` DISABLE KEYS */;
INSERT INTO `bs_services` VALUES (1,1,'استخراج جواز السفر','Passport Issuance','ti-id',300.00,NULL,NULL,0,1,1,'2026-05-19 05:20:47','2026-08-04 05:49:48'),(2,1,'تجديد بطاقة الهوية','ID Card Renewal','ti-id-badge',100.00,NULL,NULL,3,1,2,'2026-05-19 05:20:47','2026-05-19 05:20:47'),(3,1,'استخراج وثيقة السجل العائلي','Family Registration Document','ti-file',150.00,NULL,NULL,4,1,3,'2026-05-19 05:20:47','2026-05-19 05:20:47'),(4,2,'تراخيص الاتصالات','Telecom Licenses','ti-signal',500.00,NULL,NULL,7,1,1,'2026-05-19 05:20:47','2026-05-19 05:20:47'),(5,2,'خدمات البريد الإلكتروني الحكومي','Government Email Services','ti-mail',200.00,NULL,NULL,3,1,2,'2026-05-19 05:20:47','2026-05-19 05:20:47'),(71,3,'حجز اسم تجاري باللغة الإنجليزية','English Trade Name Reservation','ti-location',500.00,'حجز اسم تجاري باللغة الإنجليزية قبل إصدار السجل التجاري، مع التحقق من مطابقته للضوابط وتوافره.','Reserves an English trade name before commercial registration, subject to name rules and availability.',10,1,2,'2026-07-29 06:02:21','2026-07-29 06:02:21'),(7,3,'تجديد السجل التجاري','Commercial Registration Renewal','ti-refresh',400.00,NULL,NULL,5,1,2,'2026-05-19 05:20:47','2026-05-19 05:20:47'),(8,3,'استخراج شهادة عدم تعارض','Non-Conflict Certificate','ti-certificate',200.00,NULL,NULL,3,1,3,'2026-05-19 05:20:47','2026-05-19 05:20:47'),(9,4,'التوثيق القانوني','Legal Documentation','ti-file-certificate',350.00,NULL,NULL,4,1,1,'2026-05-19 05:20:47','2026-05-19 05:20:47'),(10,4,'استخراج وثيقة زواج','Marriage Certificate','ti-heart',200.00,NULL,NULL,3,1,2,'2026-05-19 05:20:47','2026-05-19 05:20:47'),(11,4,'إفراغ العقارات','Property Transfer','ti-home',600.00,NULL,NULL,7,1,3,'2026-05-19 05:20:47','2026-05-19 05:20:47'),(12,5,'تسجيل منشأة صحية','Health Facility Registration','ti-building-hospital',1000.00,NULL,NULL,14,1,1,'2026-05-19 05:20:47','2026-05-19 05:20:47'),(13,5,'ترخيص الممارسة الصحية','Health Practice License','ti-stethoscope',500.00,NULL,NULL,7,1,2,'2026-05-19 05:20:47','2026-05-19 05:20:47'),(14,6,'استخراج تصريح عمل','Work Permit','ti-user-check',450.00,NULL,NULL,6,1,1,'2026-05-19 05:20:47','2026-05-19 05:20:47'),(15,6,'نقل الكفالة','Sponsorship Transfer','ti-transfer',300.00,NULL,NULL,5,1,2,'2026-05-19 05:20:47','2026-05-19 05:20:47'),(16,6,'تسجيل منشأة تجارية','Business Establishment Registration','ti-building',600.00,NULL,NULL,8,1,3,'2026-05-19 05:20:47','2026-05-19 05:20:47'),(17,7,'الخدمات الضريبية','Tax Services','ti-receipt-tax',300.00,NULL,NULL,5,1,1,'2026-05-19 05:20:47','2026-05-19 05:20:47'),(18,7,'استخراج شهادة الزكاة','Zakat Certificate','ti-certificate',150.00,NULL,NULL,3,1,2,'2026-05-19 05:20:47','2026-05-19 05:20:47'),(19,8,'قبول الطلاب','Student Admission','ti-user-plus',50.00,NULL,NULL,2,1,1,'2026-05-19 05:20:47','2026-05-19 05:20:47'),(20,8,'توثيق الشهادات','Certificate Authentication','ti-certificate',200.00,NULL,NULL,4,1,2,'2026-05-19 05:20:47','2026-05-19 05:20:47'),(21,8,'ترخيص منشأة تعليمية','Educational Institution License','ti-building-school',1500.00,NULL,NULL,20,1,3,'2026-05-19 05:20:47','2026-05-19 05:20:47'),(22,9,'تراخيص الفنادق','Hotel Licenses','ti-building',2000.00,NULL,NULL,14,1,1,'2026-05-19 05:20:47','2026-05-19 05:20:47'),(23,9,'ترخيص وكالة سياحية','Travel Agency License','ti-map',1200.00,NULL,NULL,10,1,2,'2026-05-19 05:20:47','2026-05-19 05:20:47'),(24,10,'تراخيص الاستثمار الأجنبي','Foreign Investment License','ti-world',3000.00,NULL,NULL,15,1,1,'2026-05-19 05:20:47','2026-05-19 05:20:47'),(25,10,'ترخيص المنشأة الاستثمارية','Investment Facility License','ti-building-factory',2000.00,NULL,NULL,12,1,2,'2026-05-19 05:20:47','2026-05-19 05:20:47'),(26,11,'التسجيل الضريبي','Tax Registration','ti-file-description',0.00,NULL,NULL,5,1,1,'2026-05-19 05:20:47','2026-05-19 05:20:47'),(27,11,'تقديم الإقرار الضريبي','Tax Return Submission','ti-file-invoice',0.00,NULL,NULL,3,1,2,'2026-05-19 05:20:47','2026-05-19 05:20:47'),(28,11,'استرداد ضريبة القيمة المضافة','VAT Refund','ti-coin',100.00,NULL,NULL,14,1,3,'2026-05-19 05:20:47','2026-05-19 05:20:47'),(29,12,'تراخيص الطيران','Aviation Licenses','ti-license',5000.00,NULL,NULL,30,1,1,'2026-05-19 05:20:47','2026-05-19 05:20:47'),(30,12,'ترخيص الطائرات بدون طيار','Drone License','ti-drone',500.00,NULL,NULL,7,1,2,'2026-05-19 05:20:47','2026-05-19 05:20:47'),(31,13,'تراخيص الأوراق المالية','Securities Licenses','ti-chart-line',10000.00,NULL,NULL,45,1,1,'2026-05-19 05:20:47','2026-05-19 05:20:47'),(32,13,'تسجيل الصناديق الاستثمارية','Investment Fund Registration','ti-building-bank',5000.00,NULL,NULL,30,1,2,'2026-05-19 05:20:47','2026-05-19 05:20:47'),(33,14,'تسجيل الأدوية','Drug Registration','ti-pill',2000.00,NULL,NULL,60,1,1,'2026-05-19 05:20:47','2026-05-19 05:20:47'),(34,14,'ترخيص منشأة غذائية','Food Facility License','ti-building',1500.00,NULL,NULL,20,1,2,'2026-05-19 05:20:47','2026-05-19 05:20:47'),(35,14,'تسجيل المنتجات الغذائية','Food Product Registration','ti-package',800.00,NULL,NULL,14,1,3,'2026-05-19 05:20:47','2026-05-19 05:20:47'),(36,15,'تسجيل العقارات','Property Registration','ti-home',800.00,NULL,NULL,7,1,1,'2026-05-19 05:20:47','2026-05-19 05:20:47'),(37,15,'ترخيص شركة عقارية','Real Estate Company License','ti-building',2000.00,NULL,NULL,14,1,2,'2026-05-19 05:20:47','2026-05-19 05:20:47'),(38,16,'تراخيص الفعاليات الترفيهية','Entertainment Event Licenses','ti-ticket',3000.00,NULL,NULL,14,1,1,'2026-05-19 05:20:47','2026-05-19 05:20:47'),(39,16,'ترخيص دور السينما','Cinema License','ti-movie',5000.00,NULL,NULL,30,1,2,'2026-05-19 05:20:47','2026-05-19 05:20:47'),(40,17,'اعتماد الأنظمة الأمنية','Security System Accreditation','ti-shield-check',5000.00,NULL,NULL,30,1,1,'2026-05-19 05:20:47','2026-05-19 05:20:47'),(41,17,'اختبار الاختراق المعتمد','Certified Penetration Testing','ti-bug',3000.00,NULL,NULL,14,1,2,'2026-05-19 05:20:47','2026-05-19 05:20:47'),(42,18,'التسجيل في التأمينات','Social Insurance Registration','ti-user-check',0.00,NULL,NULL,3,1,1,'2026-05-19 05:20:47','2026-05-19 05:20:47'),(43,18,'استخراج شهادة التأمينات','Insurance Certificate','ti-certificate',50.00,NULL,NULL,2,1,2,'2026-05-19 05:20:47','2026-05-19 05:20:47'),(44,18,'طلبات التقاعد','Retirement Applications','ti-calendar',0.00,NULL,NULL,30,1,3,'2026-05-19 05:20:47','2026-05-19 05:20:47'),(45,19,'خدمات الشحن','Shipping Services','ti-package',80.00,NULL,NULL,1,1,1,'2026-05-19 05:20:47','2026-05-19 05:20:47'),(46,19,'صندوق البريد','PO Box','ti-mailbox',200.00,NULL,NULL,2,1,2,'2026-05-19 05:20:47','2026-05-19 05:20:47'),(47,20,'حجز التذاكر المؤسسي','Corporate Ticket Booking','ti-ticket',0.00,NULL,NULL,1,1,1,'2026-05-19 05:20:47','2026-05-19 05:20:47'),(48,20,'عقود السفر للشركات','Corporate Travel Contracts','ti-file-description',500.00,NULL,NULL,7,1,2,'2026-05-19 05:20:47','2026-05-19 05:20:47'),(49,21,'طلبات القروض الصناعية','Industrial Loan Applications','ti-coin',0.00,NULL,NULL,30,1,1,'2026-05-19 05:20:47','2026-05-19 05:20:47'),(50,21,'استشارات التطوير الصناعي','Industrial Development Consulting','ti-users',0.00,NULL,NULL,7,1,2,'2026-05-19 05:20:47','2026-05-19 05:20:47'),(51,22,'فتح حساب تجاري','Open Business Account','ti-wallet',0.00,NULL,NULL,3,1,1,'2026-05-19 05:20:47','2026-05-19 05:20:47'),(52,22,'خطاب ضمان بنكي','Bank Guarantee Letter','ti-file-certificate',500.00,NULL,NULL,5,1,2,'2026-05-19 05:20:47','2026-05-19 05:20:47'),(72,3,'التأكيد السنوي لبيانات السجل التجاري الرئيسي – شركة مساهمة أو مساهمة مبسطة','Annual Confirmation of Main Commercial Registration Data – Joint Stock or Simplified Joint Stock Company','ti-certificate',1600.00,'التأكيد السنوي لبيانات السجل التجاري الرئيسي لشركة مساهمة أو مساهمة مبسطة وفق متطلبات الخدمة الرسمية.','Annual Confirmation of Main Commercial Registration Data for a joint stock or simplified joint stock company under the official service requirements.',1,1,3,'2026-07-29 06:06:22','2026-07-29 06:06:22'),(70,3,'حجز اسم تجاري باللغة العربية','Arabic Trade Name Reservation','ti-location',200.00,'حجز اسم تجاري باللغة العربية قبل إصدار السجل التجاري، مع التحقق من مطابقته للضوابط وتوافره.','Reserves an Arabic trade name before commercial registration, subject to name rules and availability.',10,1,1,'2026-07-29 05:52:47','2026-07-29 05:52:47'),(67,3,'اصدار سجل تجاري جديد لموسسة فردية','Issuance of a new commercial registration for a sole proprietorship','ti-certificate',200.00,NULL,NULL,2,1,4,'2026-06-16 13:17:44','2026-06-16 13:17:44'),(62,27,'تأشيرات الزيارة','Visitor Visas','ti-plane',600.00,NULL,NULL,14,1,1,'2026-05-19 05:20:47','2026-05-19 05:20:47'),(63,27,'تأشيرات العمل','Work Visas','ti-briefcase',800.00,NULL,NULL,21,1,2,'2026-05-19 05:20:47','2026-05-19 05:20:47'),(64,28,'تأشيرات زيارة بريطانيا','UK Visit Visas','ti-passport',700.00,NULL,NULL,15,1,1,'2026-05-19 05:20:47','2026-05-19 05:20:47'),(65,28,'تصديق الشهادات الأكاديمية','Academic Certificate Attestation','ti-certificate',400.00,NULL,NULL,7,1,2,'2026-05-19 05:20:47','2026-05-19 05:20:47'),(73,3,'التأكيد السنوي لبيانات السجل التجاري الرئيسي – شركة ذات مسؤولية محدودة','Annual Confirmation of Main Commercial Registration Data – Limited Liability Company','ti-certificate',1200.00,'التأكيد السنوي لبيانات السجل التجاري الرئيسي لشركة ذات مسؤولية محدودة وفق متطلبات الخدمة الرسمية.','Annual Confirmation of Main Commercial Registration Data for a limited liability company under the official service requirements.',1,1,4,'2026-07-29 06:08:00','2026-07-29 06:08:00'),(74,3,'التأكيد السنوي لبيانات السجل التجاري الرئيسي – شركة تضامن أو توصية بسيطة','Annual Confirmation of Main Commercial Registration Data – General or Limited Partnership Company','ti-certificate',1000.00,'التأكيد السنوي لبيانات السجل التجاري الرئيسي لشركة تضامن أو توصية بسيطة وفق متطلبات الخدمة الرسمية.','Annual Confirmation of Main Commercial Registration Data for a general or limited partnership company under the official service requirements.',1,1,5,'2026-07-29 06:11:58','2026-07-29 06:11:58'),(75,3,'إعادة تعيين السجل التجاري الرئيسي','Reassign Main Commercial Registration','ti-certificate',100.00,'تحويل سجل تجاري فرعي قائم إلى السجل الرئيسي للمنشأة وفق الضوابط المعتمدة.','Converts an eligible branch commercial registration into the establishment\'s main registration.',1,1,6,'2026-07-29 06:13:59','2026-07-29 06:13:59'),(76,3,'التأكيد السنوي لبيانات السجل التجاري الفرعي – شركة مساهمة أو مساهمة مبسطة','Annual Confirmation of Branch Commercial Registration Data – Joint Stock or Simplified Joint Stock Company','ti-certificate',1600.00,'التأكيد السنوي لبيانات السجل التجاري الفرعي لشركة مساهمة أو مساهمة مبسطة وفق متطلبات الخدمة الرسمية.','Annual Confirmation of Branch Commercial Registration Data for a joint stock or simplified joint stock company under the official service requirements.',1,1,8,'2026-07-29 06:23:25','2026-07-29 06:23:25'),(77,3,'التأكيد السنوي لبيانات السجل التجاري الفرعي – شركة ذات مسؤولية محدودة','Annual Confirmation of Branch Commercial Registration Data – Limited Liability Company','ti-certificate',1200.00,'التأكيد السنوي لبيانات السجل التجاري الفرعي لشركة ذات مسؤولية محدودة وفق متطلبات الخدمة الرسمية.','Annual Confirmation of Branch Commercial Registration Data for a limited liability company under the official service requirements.',1,1,9,'2026-07-29 06:26:51','2026-07-29 06:26:51'),(78,3,'التأكيد السنوي لبيانات السجل التجاري الفرعي – شركة تضامن أو توصية بسيطة','Annual Confirmation of Branch Commercial Registration Data – General or Limited Partnership Company','ti-certificate',1000.00,'التأكيد السنوي لبيانات السجل التجاري الفرعي لشركة تضامن أو توصية بسيطة وفق متطلبات الخدمة الرسمية.','Annual Confirmation of Branch Commercial Registration Data for a general or limited partnership company under the official service requirements.',1,1,10,'2026-07-29 06:28:51','2026-07-29 06:28:51'),(79,3,'التأكيد السنوي لبيانات السجل التجاري لمؤسسة فردية','Annual Confirmation of Commercial Registration Data for a Sole Proprietorship','ti-certificate',500.00,'تأكيد بيانات السجل التجاري للمؤسسة الفردية سنويًا لضمان استمرار السجل وتحديث معلوماته.','Confirms a sole proprietorship\'s commercial registration data annually to keep it current and active.',1,1,11,'2026-07-29 06:31:34','2026-07-29 06:31:34'),(80,3,'تأسيس شركة بموجب ترخيص استثماري – شركة مساهمة أو مساهمة مبسطة','Establish a Company Under an Investment License – Joint Stock or Simplified Joint Stock Company','ti-certificate',1600.00,'تأسيس شركة بموجب ترخيص استثماري لشركة مساهمة أو مساهمة مبسطة وفق متطلبات الخدمة الرسمية.','Establish a Company Under an Investment License for a joint stock or simplified joint stock company under the official service requirements.',3,1,12,'2026-07-29 06:39:40','2026-07-29 06:39:40'),(81,3,'تأسيس شركة بموجب ترخيص استثماري – شركة ذات مسؤولية محدودة','Establish a Company Under an Investment License – Limited Liability Company','ti-certificate',1200.00,'تأسيس شركة بموجب ترخيص استثماري لشركة ذات مسؤولية محدودة وفق متطلبات الخدمة الرسمية.','Establish a Company Under an Investment License for a limited liability company under the official service requirements.',3,1,13,'2026-07-29 06:41:01','2026-07-29 06:41:01'),(82,3,'تأسيس شركة بموجب ترخيص استثماري – شركة تضامن أو توصية بسيطة','Establish a Company Under an Investment License – General or Limited Partnership Company','ti-certificate',1000.00,'تأسيس شركة بموجب ترخيص استثماري لشركة تضامن أو توصية بسيطة وفق متطلبات الخدمة الرسمية.','Establish a Company Under an Investment License for a general or limited partnership company under the official service requirements.',3,1,14,'2026-07-29 06:44:56','2026-07-29 06:44:56'),(83,3,'التنازل عن الاسم التجاري لفرع شركة','Assign a Trade Name for a Company Branch','ti-certificate',100.00,'نقل ملكية الاسم التجاري المقيد لفرع شركة إلى مستفيد آخر وفق الضوابط.','Transfers the registered trade name of a company branch to another eligible beneficiary.',1,1,15,'2026-07-29 06:47:51','2026-07-29 06:47:51'),(84,3,'تأسيس شركة بموجب ترخيص هيئة المدن والمناطق الاقتصادية الخاصة – شركة مساهمة أو مساهمة مبسطة','Establish a Company Under an Economic Cities and Special Zones Authority License – Joint Stock or Simplified Joint Stock Company','ti-certificate',1600.00,'تأسيس شركة بموجب ترخيص هيئة المدن والمناطق الاقتصادية الخاصة لشركة مساهمة أو مساهمة مبسطة وفق متطلبات الخدمة الرسمية.','Establish a Company Under an Economic Cities and Special Zones Authority License for a joint stock or simplified joint stock company under the official service requirements.',3,1,16,'2026-07-29 06:57:30','2026-07-29 06:57:30'),(85,3,'تأسيس شركة بموجب ترخيص هيئة المدن والمناطق الاقتصادية الخاصة – شركة ذات مسؤولية محدودة','Establish a Company Under an Economic Cities and Special Zones Authority License – Limited Liability Company','ti-certificate',1200.00,'تأسيس شركة بموجب ترخيص هيئة المدن والمناطق الاقتصادية الخاصة لشركة ذات مسؤولية محدودة وفق متطلبات الخدمة الرسمية.','Establish a Company Under an Economic Cities and Special Zones Authority License for a limited liability company under the official service requirements.',3,1,17,'2026-07-29 06:59:19','2026-07-29 06:59:19'),(86,3,'تأسيس شركة بموجب ترخيص هيئة المدن والمناطق الاقتصادية الخاصة – شركة تضامن أو توصية بسيطة','Establish a Company Under an Economic Cities and Special Zones Authority License – General or Limited Partnership Company','ti-certificate',1000.00,'تأسيس شركة بموجب ترخيص هيئة المدن والمناطق الاقتصادية الخاصة لشركة تضامن أو توصية بسيطة وفق متطلبات الخدمة الرسمية.','Establish a Company Under an Economic Cities and Special Zones Authority License for a general or limited partnership company under the official service requirements.',3,1,18,'2026-07-29 07:00:51','2026-07-29 07:00:51'),(87,3,'تسجيل قيد امتياز تجاري','Register a Commercial Franchise','ti-certificate',500.00,'تسجيل اتفاقية امتياز تجاري جديدة وإثبات بياناتها في القيد.','Registers a new commercial franchise agreement and records its details.',1,1,19,'2026-07-29 07:03:31','2026-07-29 07:03:31'),(89,3,'تعديل قيد امتياز تجاري','Amend a Commercial Franchise Registration','ti-certificate',100.00,'تعديل بيانات قيد امتياز تجاري مسجل سابقًا.','Amends the details of an existing commercial franchise registration.',1,1,20,'2026-07-29 07:08:31','2026-07-29 07:08:31'),(90,3,'التنازل عن الاسم التجاري لشركة','التنازل عن الاسAssign a Trade Name for a Companyم التجاري لشركة','ti-certificate',100.00,'نقل ملكية الاسم التجاري المقيد لشركة إلى مستفيد آخر كتصرف مستقل.','Transfers a company\'s registered trade name to another eligible beneficiary as a standalone transaction.',3,1,21,'2026-07-29 07:12:08','2026-07-29 07:12:08'),(91,3,'نشر قرارات الجمعية غير العادية','Publication of Extraordinary General Assembly Resolutions','ti-certificate',1500.00,'نشر قرارات الجمعية العامة غير العادية المتعلقة بالاندماج أو التصفية أو التقسيم أو الاستحواذ.','Publishes extraordinary general assembly resolutions concerning merger, liquidation, division, or acquisition.',1,1,22,'2026-07-29 07:14:38','2026-07-29 07:14:38'),(92,3,'مستخرج سجل تجاري','Commercial Registration Extract','ti-certificate',100.00,'طلب مستخرج رسمي يتضمن البيانات المتاحة لسجل تجاري.','Requests an official extract containing available commercial registration data.',3,1,23,'2026-07-29 07:20:27','2026-07-29 07:20:27'),(93,3,'تمديد حجز اسم تجاري','Extend a Trade Name Reservation','ti-certificate',100.00,'تمديد صلاحية اسم تجاري محجوز قبل انتهاء مدة الحجز وفق شروط الخدمة.','Extends the validity of a reserved trade name before the reservation expires.',1,1,24,'2026-07-29 07:41:26','2026-07-29 07:41:26'),(94,3,'نقل ملكية سجل تجاري لمؤسسة فردية','Transfer Ownership of a Sole Proprietorship Commercial Registration','ti-certificate',500.00,'نقل ملكية السجل التجاري لمؤسسة فردية من المالك الحالي إلى مالك جديد مستوفٍ للشروط.','Transfers a sole proprietorship\'s commercial registration from the current owner to an eligible new owner.',3,1,25,'2026-07-29 07:42:56','2026-07-29 07:42:56'),(95,3,'تعديل بيانات السجل التجاري الرئيسي لشركة','Amend Main Commercial Registration Data for a Company','ti-certificate',100.00,'تعديل بيانات السجل الرئيسي للشركة مثل النشاط والاسم ورأس المال والتراخيص والعنوان.','Amends a company\'s main registration details, such as activities, name, capital, licenses, and address.',1,1,26,'2026-07-29 07:44:40','2026-07-29 07:44:40'),(96,3,'قيد سجل تجاري لمؤسسة فردية','Issue a Commercial Registration for a Sole Proprietorship','ti-certificate',500.00,'إصدار سجل تجاري لمؤسسة فردية لبدء ممارسة نشاط تجاري نظامي.','Issues a commercial registration for a sole proprietorship to begin conducting business.',1,1,26,'2026-07-29 07:49:01','2026-07-29 07:49:01'),(97,3,'تعديل بيانات السجل التجاري الفرعي لشركة','Amend Branch Commercial Registration Data for a Company','ti-certificate',100.00,'تعديل بيانات سجل تجاري فرعي لشركة، بما يشمل النشاط والتراخيص والاسم والعنوان.','Amends a company\'s branch registration details, including activities, licenses, name, and address.',1,1,27,'2026-07-29 07:51:08','2026-07-29 07:51:08'),(98,3,'طلب تسجيل قيد وكالة تجارية','Register a Commercial Agency','ti-certificate',500.00,'تسجيل قيد وكالة أو توزيع تجاري يمنح الوكيل أو الموزع حق مزاولة النشاط.','Registers a commercial agency or distributorship authorizing the agent or distributor to operate.',1,1,28,'2026-07-29 07:56:54','2026-07-29 07:56:54'),(99,3,'تراخيص التخفيضات','Discount Licenses','ti-certificate',300.00,'إصدار ترخيص يسمح للمنشأة بتطبيق تخفيضات على السلع وفق المدة والنسب المعتمدة.','Issues a license allowing an establishment to offer product discounts under approved terms.',1,1,29,'2026-07-29 08:07:55','2026-07-29 08:07:55'),(100,3,'التحول من مؤسسة فردية إلى شركة – شركة مساهمة أو مساهمة مبسطة','Convert a Sole Proprietorship into a Company – Joint Stock or Simplified Joint Stock Company','ti-certificate',1600.00,'التحول من مؤسسة فردية إلى شركة لشركة مساهمة أو مساهمة مبسطة وفق متطلبات الخدمة الرسمية.','Convert a Sole Proprietorship into a Company for a joint stock or simplified joint stock company under the official service requirements.',3,1,30,'2026-07-29 08:12:50','2026-07-29 08:12:50'),(101,3,'التحول من مؤسسة فردية إلى شركة – شركة ذات مسؤولية محدودة','Convert a Sole Proprietorship into a Company – Limited Liability Company','ti-certificate',1200.00,'التحول من مؤسسة فردية إلى شركة لشركة ذات مسؤولية محدودة وفق متطلبات الخدمة الرسمية.','Convert a Sole Proprietorship into a Company for a limited liability company under the official service requirements.',3,1,33,'2026-07-29 08:42:59','2026-07-29 08:42:59'),(102,3,'التحول من مؤسسة فردية إلى شركة – شركة تضامن أو توصية بسيطة','Convert a Sole Proprietorship into a Company – General or Limited Partnership Company','ti-certificate',1000.00,'التحول من مؤسسة فردية إلى شركة لشركة تضامن أو توصية بسيطة وفق متطلبات الخدمة الرسمية.','Convert a Sole Proprietorship into a Company for a general or limited partnership company under the official service requirements.',3,1,34,'2026-07-29 08:44:02','2026-07-29 08:44:02'),(103,3,'تعديل بيانات السجل التجاري لمؤسسة فردية','Amend Commercial Registration Data for a Sole Proprietorship','ti-certificate',100.00,'تعديل بيانات سجل مؤسسة فردية مثل الأنشطة والتراخيص ورأس المال والاسم والعنوان.','Amends a sole proprietorship\'s registration details, including activities, licenses, capital, name, and address.',1,1,35,'2026-07-29 08:45:21','2026-07-29 08:45:21'),(104,3,'التنازل عن الاسم التجاري لمؤسسة فردية','Assign a Trade Name to a Sole Proprietorship','ti-certificate',100.00,'نقل ملكية الاسم التجاري المقيد لمؤسسة فردية إلى مستفيد آخر دون نقل السجل نفسه.','Transfers a sole proprietorship\'s registered trade name to another beneficiary without transferring the registration.',3,1,36,'2026-07-29 08:46:40','2026-07-29 08:46:40'),(105,3,'تعديل عقد التأسيس / نظام أساس','Amend Articles of Association / Bylaws','ti-certificate',1600.00,'تعديل مواد عقد تأسيس الشركة أو نظامها الأساس وتحديث بيانات السجل المرتبطة.','Amends a company\'s articles of association or bylaws and updates related registration data.',1,1,37,'2026-07-29 08:49:11','2026-07-29 08:49:11'),(106,3,'تأسيس شركة مساهمة','Establish a Joint Stock Company','ti-certificate',2100.00,'تأسيس شركة مساهمة وإصدار سجلها ونظامها الأساس إلكترونيًا.','Establishes a joint stock company and issues its commercial registration and bylaws online.',1,1,38,'2026-07-29 08:50:41','2026-07-29 08:50:41'),(107,3,'تأسيس شركة مساهمة مبسطة','Establish a Simplified Joint Stock Company','ti-certificate',2100.00,'تأسيس شركة مساهمة مبسطة لشخص أو أكثر وإصدار سجلها ونظامها الأساس.','Establishes a simplified joint stock company for one or more founders and issues its registration and bylaws.',1,1,39,'2026-07-29 08:51:44','2026-07-29 08:51:44'),(108,3,'تأسيس شركة تضامنية','Establish a General Partnership Company','ti-certificate',1500.00,'تأسيس شركة تضامنية بين شريكين أو أكثر وإصدار سجلها التجاري.','Establishes a general partnership between two or more partners and issues its commercial registration.',1,1,40,'2026-07-29 08:52:48','2026-07-29 08:52:48'),(109,3,'تأسيس شركة توصية بسيطة','Establish a Limited Partnership Company','ti-certificate',1500.00,'تأسيس شركة توصية بسيطة تضم شركاء متضامنين وموصين وإصدار سجلها.','Establishes a limited partnership with general and limited partners and issues its commercial registration.',1,1,41,'2026-07-29 08:54:42','2026-07-29 08:54:42'),(110,3,'تأسيس شركة ذات مسؤولية محدودة','Establish a Limited Liability Company','ti-certificate',1700.00,'تأسيس شركة ذات مسؤولية محدودة لشخص أو أكثر وإصدار عقد التأسيس والسجل.','Establishes a limited liability company for one or more founders and issues its articles and registration.',1,1,42,'2026-07-29 08:55:48','2026-07-29 08:55:48'),(111,3,'الاستعلام عن المخالفات الفورية','Inquiry About Immediate Violations','ti-certificate',0.00,'الاستعلام عن المخالفات والغرامات التجارية المسجلة بواسطة رقم المخالفة أو بيانات المنشأة.','Checks commercial violations and fines using the violation number or establishment details.',1,1,43,'2026-07-29 08:57:32','2026-07-29 08:57:32'),(112,3,'تحديث بيانات الرخص التشغيلية لمؤسسة فردية','Update Operating License Data for a Sole Proprietorship','ti-certificate',0.00,'تحديث وربط بيانات الرخص التشغيلية المرتبطة بالسجل التجاري لمؤسسة فردية.','Updates and links operating-license information associated with a sole proprietorship\'s commercial registration.',1,1,44,'2026-07-29 08:58:35','2026-07-29 08:58:35'),(113,3,'تحديث بيانات الرخص التشغيلية لشركة','Update Operating License Data for a Company','ti-certificate',0.00,'تحديث بيانات الرخص التشغيلية المرتبطة بالسجل التجاري الرئيسي أو الفرعي للشركة.','Updates operating-license information linked to a company\'s main or branch commercial registration.',1,1,45,'2026-07-29 08:59:38','2026-07-29 08:59:38'),(114,3,'رفع تعليق السجل التجاري الرئيسي لشركة','Lift Suspension of a Company\'s Main Commercial Registration','ti-certificate',0.00,'رفع تعليق السجل التجاري الرئيسي للشركة بعد استيفاء سبب التعليق ومتطلبات التأكيد السنوي.','Lifts the suspension of a company\'s main commercial registration after the relevant requirements are met.',1,1,46,'2026-07-29 09:01:21','2026-07-29 09:01:21'),(115,3,'خدمة إبلاغ المنشآت التجارية عن حالات التستر في منشآت أخرى','Reporting Commercial Concealment by Other Establishments','ti-certificate',0.00,'تمكين المنشآت من الإبلاغ عن حالات اشتباه بالتستر التجاري في منشآت أخرى وإرفاق الأدلة المتاحة.','Allows establishments to report suspected commercial concealment at other businesses and attach available evidence.',20,1,47,'2026-07-29 09:02:24','2026-07-29 09:02:24'),(116,3,'شطب السجل التجاري الفرعي لشركة','Cancel a Company Branch Commercial Registration','ti-certificate',0.00,'إلغاء سجل تجاري فرعي لشركة عند انتهاء النشاط أو عدم الحاجة إلى الفرع.','Cancels a company\'s branch commercial registration when the branch activity ends or is no longer required.',1,1,47,'2026-07-29 09:03:26','2026-07-29 09:03:26'),(117,3,'تحديث بيانات مالك السجل التجاري','Update Commercial Registration Owner Data','ti-certificate',0.00,'تحديث بيانات مالك المؤسسة أو مدير السجل التجاري وبيانات التواصل المرتبطة به.','Updates the commercial registration owner\'s or manager\'s details and related contact information.',3,1,48,'2026-07-29 09:04:25','2026-07-29 09:04:25'),(118,3,'مخالفات نظام الامتياز التجاري','Report Franchise Law Violations','ti-certificate',0.00,'الإبلاغ عن ممارسات يُشتبه في مخالفتها لنظام الامتياز التجاري ولائحته التنفيذية.','Reports practices suspected of violating the Commercial Franchise Law or its implementing regulations.',7,1,49,'2026-07-29 09:08:00','2026-07-29 09:08:00'),(119,3,'التفويض الإلكتروني','Electronic Authorization','ti-certificate',0.00,'إضافة مفوضين لخدمات محددة وإدارة صلاحياتهم إلكترونيًا نيابة عن المنشأة.','Adds authorized representatives for selected services and manages their permissions online.',1,1,50,'2026-07-29 09:09:22','2026-07-29 09:09:22'),(120,3,'شكاوى مخالفات نظام الشركات','Company Law Violation Complaints','ti-certificate',0.00,'استقبال شكاوى الممارسات التي قد تشكل مخالفة لنظام الشركات ولائحته التنفيذية.','Receives complaints about conduct that may violate the Companies Law or its implementing regulations.',10,1,50,'2026-07-29 09:12:51','2026-07-29 09:12:51'),(121,3,'الاستعلام عن الوكالات التجارية القائمة','Inquiry About Existing Commercial Agencies','ti-certificate',0.00,'البحث في قيود الوكالات التجارية المسجلة لدى الوزارة باستخدام بيانات الوكيل أو الوكالة.','Searches registered commercial agencies using agency, agent, or principal information.',1,1,51,'2026-07-29 09:13:46','2026-07-29 09:13:46'),(122,3,'خدمة الاستعلام عن المعاملات','Transaction Inquiry','ti-certificate',0.00,'متابعة حالة معاملة مقيدة في نظام معاملات الوزارة باستخدام رقم المعاملة وبيانات المستفيد.','Tracks a transaction recorded in the Ministry\'s system using the transaction number and beneficiary details.',1,1,53,'2026-07-29 09:14:45','2026-07-29 09:14:45'),(123,3,'إلغاء اسم تجاري محجوز','Cancel a Reserved Trade Name','ti-certificate',0.00,'إلغاء اسم تجاري سبق حجزه ولم يُستخدم في إصدار سجل تجاري.','Cancels a previously reserved trade name that has not been used for a commercial registration.',1,1,55,'2026-07-29 09:16:08','2026-07-29 09:16:08'),(124,3,'إلغاء قيد امتياز تجاري','Cancel a Commercial Franchise Registration','ti-certificate',0.00,'إلغاء قيد امتياز تجاري مسجل عند انتهاء العلاقة أو استيفاء سبب الإلغاء.','Cancels an existing commercial franchise registration when the cancellation requirements are met.',1,1,56,'2026-07-29 09:17:35','2026-07-29 09:17:35'),(125,3,'خدمة التحقق من الوثائق','Document Verification','ti-certificate',0.00,'التحقق إلكترونيًا من صحة وثائق مختارة مثل السجل التجاري وشهادة المنشأ وتراخيص التخفيضات.','Verifies selected documents online, including commercial registrations, certificates of origin, and discount licenses.',1,1,57,'2026-07-29 09:18:27','2026-07-29 09:18:27'),(126,3,'الاستعلام عن المنتجات المعيبة','Defective Product Recall Inquiry','ti-certificate',0.00,'البحث عن حملات استدعاء المنتجات والمركبات المعيبة والاطلاع على تفاصيل الإجراء المطلوب.','Searches defective-product and vehicle recall campaigns and displays the required follow-up action.',1,1,57,'2026-07-29 09:20:40','2026-07-29 09:20:40'),(127,3,'طلب تصاريح السفر خارجيًا لغرض الاستثمار','Overseas Travel Permit for Investment Purposes','ti-certificate',0.00,'تقديم طلب تصريح سفر خارجي مرتبط بغرض استثماري مع إرفاق مستندات النشاط.','Requests an overseas travel permit for an investment purpose with supporting business documents.',10,1,58,'2026-07-29 09:21:36','2026-07-29 09:21:36'),(128,3,'إفادة تجارية','Commercial Statement','ti-certificate',0.00,'طلب إفادة تجارية محددة مرتبطة بالسجل التجاري أو حالته.','Requests a specific commercial statement related to a registration or its status.',3,1,59,'2026-07-29 09:22:30','2026-07-29 09:22:30'),(129,3,'خدمة الإبلاغ عن بيانات المستفيد الحقيقي','Beneficial Owner Data Reporting','ti-certificate',0.00,'تمكين الجهات المالية المعتمدة من الإبلاغ عن بيانات المستفيد الحقيقي ومؤشرات الاشتباه المرتبطة بالمنشأة.','Allows authorized financial entities to report beneficial-owner data and relevant suspicion indicators.',1,1,60,'2026-07-29 09:23:27','2026-07-29 09:23:27'),(130,3,'طلب تعديل قيد وكالة تجارية','Amend a Commercial Agency Registration','ti-certificate',0.00,'تعديل البيانات المسجلة في قيد وكالة تجارية قائمة.','Amends information recorded for an existing commercial agency registration.',1,1,61,'2026-07-29 09:24:36','2026-07-29 09:24:36'),(131,3,'طلب تجديد قيد وكالة تجارية','Renew a Commercial Agency Registration','ti-certificate',0.00,'تجديد قيد وكالة تجارية قائمة لمواصلة ممارسة نشاط الوكالة.','Renews an existing commercial agency registration so the agency can continue operating.',1,1,62,'2026-07-29 09:26:11','2026-07-29 09:26:11'),(132,3,'طلب شطب قيد وكالة تجارية من قبل الوكيل','Cancel a Commercial Agency Registration by the Agent','ti-certificate',0.00,'شطب قيد وكالة تجارية بناءً على طلب الوكيل المسجل.','Cancels a commercial agency registration at the registered agent\'s request.',1,1,63,'2026-07-29 09:27:12','2026-07-29 09:27:12'),(133,3,'إصدار ترخيص مهنة استشارية','Issue a Consulting Profession License','ti-certificate',0.00,'إصدار ترخيص لمزاولة مهنة استشارية لمن يستوفي المؤهلات والمتطلبات النظامية.','Issues a license to practice a consulting profession for applicants meeting regulatory requirements.',1,1,64,'2026-07-29 09:28:02','2026-07-29 09:28:02'),(134,3,'إصدار فرع ترخيص مهنة استشارية','Issue a Branch Consulting Profession License','ti-certificate',0.00,'إصدار ترخيص فرع إضافي لمكتب مهني استشاري مرخص.','Issues a branch license for an existing licensed consulting practice.',1,1,65,'2026-07-29 09:29:04','2026-07-29 09:29:04'),(135,10,'تسجيل الشركات غير السعودية لغرض تملك العقار','Registration of Non-Saudi Companies for Real Estate Ownership Purposes','ti-certificate',0.00,'تسجيل الشركات الأجنبية غير المقيمة في المملكة والراغبة في تملك عقار داخلها دون ممارسة نشاط اقتصادي.','Registers foreign companies not resident in Saudi Arabia that wish to own property in the Kingdom without conducting an economic activity.',10,1,66,'2026-08-02 10:29:59','2026-08-02 10:29:59'),(136,10,'التحديث السنوي لتسجيل تملك العقار للشركات غير السعودية','Annual Update of Real Estate Ownership Registration for Non-Saudi Companies','ti-certificate',0.00,'تحديث سنوي للشركات الأجنبية غير المقيمة المسجلة لغرض تملك عقار، للتحقق من استمرارية وجودها وعدم تغير ملكيتها أو إدارتها بعد التسجيل.','An annual update for non-resident foreign companies registered for property ownership, confirming their continued existence and that ownership or management has not changed since registration.',5,1,67,'2026-08-02 10:31:42','2026-08-02 10:31:42'),(137,10,'دمج سجلات الاستثمار','Merging Investment Records','ti-certificate',0.00,'دمج أكثر من سجل استثماري في سجل واحد، أو تنفيذ دمج مرتبط بالاستحواذ على منشأة أخرى، وفق المتطلبات النظامية.','Merges multiple investment registrations into one, including qualifying mergers related to the acquisition of another establishment.',5,1,68,'2026-08-02 10:32:59','2026-08-02 10:32:59'),(138,10,'تعديل الملكية في التسجيل','Amending Ownership in the Registration','ti-certificate',0.00,'تعديل الشركاء أو توزيع الحصص، ودخول أو خروج شريك، وإحلال الورثة، والتحول إلى منشأة وطنية، أو التعديل المرتبط بالاندماج.','Amends partners or share distribution, partner entry or exit, substitution by heirs, conversion to a national establishment, or merger-related ownership data.',5,1,69,'2026-08-02 11:28:05','2026-08-02 11:28:05'),(139,10,'تعديل معلومات تسجيل تملك العقار للشركات غير السعودية','Amending Real Estate Ownership Registration Information for Non-Saudi Companies','ti-certificate',0.00,'تعديل بيانات تسجيل الشركة غير السعودية لغرض تملك العقار، مثل الكيان القانوني والاسم والجنسية والموقع والحصص ودخول أو خروج الشركاء.','Amends a non-Saudi company\'s property-ownership registration data, such as legal entity, name, nationality, location, shares, and partner entry or exit.',5,1,70,'2026-08-02 11:29:28','2026-08-02 11:29:28'),(140,10,'الموافقة على تملك العقار للشركات الاستثمارية خارج النطاق الجغرافي','Approval for Investment Companies to Own Real Estate Outside the Geographic Scope','ti-certificate',0.00,'طلب موافقة للمنشأة الاستثمارية المسجلة لتملك عقار لازم لممارسة أنشطتها الاقتصادية خارج النطاق الجغرافي، بما في ذلك سكن العاملين أو ممارسة النشاط.','Allows a registered investment establishment to seek approval to own property required for its activities outside the geographic scope, including employee housing or business operations.',5,1,71,'2026-08-02 11:31:12','2026-08-02 11:31:12'),(141,10,'تعديل الأنشطة الاقتصادية — الأنشطة المقيدة أو التسجيل الريادي','Amending Economic Activities — Restricted Activities or Entrepreneurial Registration','ti-certificate',0.00,'إضافة أو حذف أنشطة اقتصادية مقيدة في السجل الاستثماري، أو إجراء تعديل مرتبط بالتسجيل الريادي، بعد استيفاء متطلبات النشاط.','Adds or removes restricted economic activities in the investment registration, or makes an entrepreneurial-registration amendment, after activity requirements are met.',5,1,72,'2026-08-02 11:32:42','2026-08-02 11:32:42'),(142,10,'الموافقات على تملك/بيع الأنشطة العقارية','Approvals for Ownership/Sale of Real Estate Activities','ti-certificate',0.00,'للمنشآت المسجلة لدى الوزارة التي تمارس أنشطة التطوير العقاري المتخصصة وتطلب تملك عقار أو بيعه لتنفيذ مشروع عقاري.','For Ministry-registered establishments engaged in specialized real estate development activities that seek to own or sell property for a real estate project.',5,1,73,'2026-08-02 11:33:53','2026-08-02 11:33:53'),(143,10,'إضافة/حذف الأنشطة المتاحة','Adding/Removing Available Activities','ti-certificate',0.00,'إضافة أو حذف الأنشطة الاقتصادية المتاحة في السجل الاستثماري وفق الإجراءات المنظمة لنوع النشاط.','Adds or removes available economic activities in the investment registration under the procedures governing the activity type.',1,1,74,'2026-08-02 11:40:05','2026-08-02 11:40:05'),(144,10,'تحديث/تعديل معلومات وبيانات المنشأة — تعديلات تتطلب مراجعة','Updating/Amending Establishment Information — ReviewUpdating/Amending Establishment Information — Review-Required Changes-Required Changes','ti-certificate',0.00,'تحديث بيانات المنشأة التي تتطلب مراجعة، ومنها جنسية الشريك وضابط الاتصال وبيانات المدير العام وممثلي المنشأة والمفوض لدى الوزارة.','Updates establishment information requiring review, including partner nationality, contact officer, general manager, establishment representatives, and the Ministry-authorized representative.',5,1,75,'2026-08-02 11:48:18','2026-08-02 11:48:18'),(145,10,'تعديل اسم المنشأة','Amending Establishment Name','ti-certificate',0.00,'تحديث اسم المنشأة في بيانات التسجيل الاستثماري.','Updates the establishment name in the investment registration data.',1,1,76,'2026-08-02 11:58:14','2026-08-02 11:58:14'),(146,10,'تعديل الكيان القانوني','Amending the Legal Entity','ti-certificate',0.00,'تحديث نوع الكيان القانوني للمنشأة في بيانات التسجيل الاستثماري.','Updates the establishment\'s legal entity type in the investment registration data.',1,1,77,'2026-08-02 12:00:41','2026-08-02 12:00:41'),(147,10,'تعديل موقع المنشأة','Amending Establishment Location','ti-certificate',0.00,'تحديث موقع المنشأة المسجل لدى وزارة الاستثمار.','Updates the establishment location registered with the Ministry of Investment.',1,1,78,'2026-08-02 12:01:58','2026-08-02 12:01:58'),(148,10,'زيادة رأس المال','Capital Increase','ti-certificate',0.00,'تحديث بيانات التسجيل الاستثماري لإثبات زيادة رأس مال المنشأة.','Updates the investment registration data to record an increase in the establishment\'s capital.',1,1,79,'2026-08-02 12:04:39','2026-08-02 12:04:39'),(149,10,'إلغاء تسجيل تملك العقار للشركات غير السعودية','Cancellation of Real Estate Ownership Registration for Non-Saudi Companies','ti-certificate',0.00,'إلغاء تسجيل الشركة غير السعودية لدى الوزارة بعد التحقق من عدم وجود عقار مملوك على المنشأة أو التزامات مالية قائمة عليها.','Cancels a non-Saudi company\'s registration with the Ministry after confirming that it owns no property and has no outstanding financial obligations.',1,1,80,'2026-08-03 05:36:39','2026-08-03 05:36:39'),(150,10,'إفادة لغرض إلغاء التسجيل اختياريًا','Statement for Voluntary Registration Cancellation','ti-certificate',0.00,'إصدار إفادة للمنشآت الراغبة في إلغاء التسجيل اختياريًا لتسهيل إنهاء إجراءاتها لدى الجهات الحكومية ذات العلاقة وتصفية المنشأة.','Issues a statement for establishments seeking voluntary registration cancellation to facilitate closure with relevant government entities and liquidation.',2,1,81,'2026-08-03 05:45:27','2026-08-03 05:45:27'),(151,10,'إصدار قرار إلغاء التسجيل اختياريًا','Issuing a Voluntary Registration Cancellation Decision','ti-certificate',0.00,'إصدار قرار الإلغاء الاختياري بعد إنهاء وشطب جميع السجلات والتراخيص والشهادات المرتبطة بتسجيل وزارة الاستثمار.','Issues the voluntary cancellation decision after all records, licenses, and certificates linked to the Ministry registration have been closed.',3,1,82,'2026-08-03 05:50:08','2026-08-03 05:50:08'),(152,10,'برنامج ميزا','Meeza Program','ti-certificate',0.00,'بوابة إلكترونية محوكمة تربط المستثمرين بمزودي خدمات الأعمال في القطاع الخاص ضمن 12 محفظة، مثل الخدمات المالية والقانونية والتقنية واللوجستية والعقارية.','A governed digital portal connecting investors with private-sector business service providers across 12 portfolios, including financial, legal, technology, logistics, and real estate services.',5,1,83,'2026-08-04 08:32:42','2026-08-04 08:32:42'),(153,10,'خدمة مواءمة المستثمرين','Investors Matchmaking Service','ti-certificate',0.00,'منصة تربط القطاع الخاص بفرص استثمارية، وتتيح طرح الفرص ومشاركتها والوصول إلى شركاء استراتيجيين وبناء علاقات استثمارية في بيئة منظمة وآمنة.','A platform connecting the private sector with investment opportunities, enabling opportunity sharing and access to strategic partners in an organized and secure environment.',3,1,84,'2026-08-04 08:33:58','2026-08-04 08:33:58'),(154,6,'تأسيس الصناديق العائلية','Establishing Family Funds','ti-id',0.00,NULL,NULL,1,1,85,'2026-08-12 10:39:14','2026-08-12 10:39:14');
/*!40000 ALTER TABLE `bs_services` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bs_specialties`
--

DROP TABLE IF EXISTS `bs_specialties`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bs_specialties` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `office_type` enum('law','services','customs','accounting','engineering','freelance') NOT NULL,
  `name_ar` varchar(191) NOT NULL,
  `name_en` varchar(191) DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=102 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bs_specialties`
--

LOCK TABLES `bs_specialties` WRITE;
/*!40000 ALTER TABLE `bs_specialties` DISABLE KEYS */;
INSERT INTO `bs_specialties` VALUES (9,'services','الخدمات الحكومية','Government Services',1,'2026-08-08 16:33:24','2026-08-08 16:33:24'),(10,'services','خدمات التعقيب','Government Transactions',1,'2026-08-08 16:33:24','2026-08-08 16:33:24'),(11,'services','خدمات التوثيق','Documentation Services',1,'2026-08-08 16:33:24','2026-08-08 16:33:24'),(12,'services','خدمات تأسيس الشركات','Business Establishment Services',1,'2026-08-08 16:33:24','2026-08-08 16:33:24'),(13,'customs','التخليص الجمركي','Customs Clearance',1,'2026-08-08 16:33:24','2026-08-08 16:33:24'),(14,'customs','الاستيراد والتصدير','Import & Export',1,'2026-08-08 16:33:24','2026-08-08 16:33:24'),(15,'customs','الاستشارات الجمركية','Customs Consulting',1,'2026-08-08 16:33:24','2026-08-08 16:33:24'),(16,'customs','إنهاء الإجراءات الجمركية','Customs Procedures',1,'2026-08-08 16:33:24','2026-08-08 16:33:24'),(17,'accounting','المحاسبة المالية','Financial Accounting',1,'2026-08-08 16:33:24','2026-08-08 16:33:24'),(18,'accounting','مراجعة الحسابات','Auditing',1,'2026-08-08 16:33:24','2026-08-08 16:33:24'),(19,'accounting','الزكاة والضرائب','Zakat & Tax',1,'2026-08-08 16:33:24','2026-08-08 16:33:24'),(20,'accounting','إعداد القوائم المالية','Financial Statements',1,'2026-08-08 16:33:24','2026-08-08 16:33:24'),(21,'accounting','المحاسبة الإدارية','Management Accounting',1,'2026-08-08 16:33:24','2026-08-08 16:33:24'),(22,'engineering','الهندسة المعمارية','Architecture',1,'2026-08-08 16:33:24','2026-08-08 16:33:24'),(23,'engineering','الهندسة المدنية','Civil Engineering',1,'2026-08-08 16:33:24','2026-08-08 16:33:24'),(24,'engineering','الهندسة الكهربائية','Electrical Engineering',1,'2026-08-08 16:33:24','2026-08-08 16:33:24'),(25,'engineering','الهندسة الميكانيكية','Mechanical Engineering',1,'2026-08-08 16:33:24','2026-08-08 16:33:24'),(26,'engineering','هندسة المشاريع','Project Engineering',1,'2026-08-08 16:33:24','2026-08-08 16:33:24'),(27,'engineering','التصميم الهندسي','Engineering Design',1,'2026-08-08 16:33:24','2026-08-08 16:33:24'),(28,'freelance','البرمجة وتطوير المواقع','Programming & Web Development',1,'2026-08-08 16:33:24','2026-08-08 16:33:24'),(29,'freelance','التصميم الجرافيكي','Graphic Design',1,'2026-08-08 16:33:24','2026-08-08 16:33:24'),(30,'freelance','التسويق الرقمي','Digital Marketing',1,'2026-08-08 16:33:24','2026-08-08 16:33:24'),(31,'freelance','الترجمة','Translation',1,'2026-08-08 16:33:24','2026-08-08 16:33:24'),(32,'freelance','كتابة المحتوى','Content Writing',1,'2026-08-08 16:33:24','2026-08-08 16:33:24'),(50,'law','القضايا التجارية',NULL,1,'2026-08-11 12:11:01','2026-08-11 12:11:01'),(51,'law','قضايا الشركات',NULL,1,'2026-08-11 12:11:21','2026-08-11 12:11:21'),(52,'law','تأسيس الشركات والتحول النظامي',NULL,1,'2026-08-11 12:11:35','2026-08-11 12:11:35'),(53,'law','حوكمة الشركات والامتثال',NULL,1,'2026-08-11 12:11:47','2026-08-11 12:11:47'),(54,'law','عمليات الاندماج والاستحواذ',NULL,1,'2026-08-11 12:11:56','2026-08-11 12:11:56'),(55,'law','الإفلاس وإعادة التنظيم المالي',NULL,1,'2026-08-11 12:12:13','2026-08-11 12:12:13'),(56,'law','الاستثمار الأجنبي',NULL,1,'2026-08-11 12:12:21','2026-08-11 12:12:21'),(57,'law','الامتياز التجاري (الفرنشايز)',NULL,1,'2026-08-11 12:12:33','2026-08-11 12:12:33'),(58,'law','الوكالات التجارية',NULL,1,'2026-08-11 12:12:43','2026-08-11 12:12:43'),(59,'law','عقود التوزيع والامتياز',NULL,1,'2026-08-11 12:12:50','2026-08-11 12:12:50'),(60,'law','الملكية الفكرية',NULL,1,'2026-08-11 12:13:00','2026-08-11 12:13:00'),(61,'law','العلامات التجارية',NULL,1,'2026-08-11 12:13:08','2026-08-11 12:13:08'),(62,'law','براءات الاختراع',NULL,1,'2026-08-11 12:13:16','2026-08-11 12:13:16'),(63,'law','حقوق المؤلف والحقوق المجاورة',NULL,1,'2026-08-11 12:13:28','2026-08-11 12:13:28'),(64,'law','التجارة الإلكترونية',NULL,1,'2026-08-11 12:13:35','2026-08-11 12:13:35'),(65,'law','الجرائم المعلوماتية',NULL,1,'2026-08-11 12:13:45','2026-08-11 12:13:45'),(66,'law','حماية البيانات والخصوصية.',NULL,1,'2026-08-11 12:14:02','2026-08-11 12:14:02'),(67,'law','العقود وصياغتها ومراجعتها',NULL,1,'2026-08-11 12:14:19','2026-08-11 12:14:19'),(68,'law','التحكيم التجاري',NULL,1,'2026-08-11 12:14:28','2026-08-11 12:14:28'),(69,'law','الوساطة وتسوية المنازعات',NULL,1,'2026-08-11 12:14:37','2026-08-11 12:14:37'),(70,'law','التنفيذ وإجراءات محاكم التنفيذ',NULL,1,'2026-08-11 12:14:46','2026-08-11 12:14:46'),(71,'law','العقارات',NULL,1,'2026-08-11 12:14:54','2026-08-11 12:14:54'),(72,'law','التطوير العقاري',NULL,1,'2026-08-11 12:15:02','2026-08-11 12:15:02'),(73,'law','المقاولات والإنشاءات',NULL,1,'2026-08-11 12:15:10','2026-08-11 12:15:10'),(75,'law','نزع الملكية والتعويضات',NULL,1,'2026-08-11 12:15:34','2026-08-11 12:15:34'),(76,'law','26. القضايا العمالية',NULL,1,'2026-08-11 12:15:42','2026-08-11 12:15:42'),(77,'law','التأمينات الاجتماعية',NULL,1,'2026-08-11 12:15:51','2026-08-11 12:15:51'),(78,'law','الأحوال الشخصية',NULL,1,'2026-08-11 12:15:59','2026-08-11 12:15:59'),(79,'law','الحضانة والزيارة والنفقة',NULL,1,'2026-08-11 12:16:13','2026-08-11 12:16:13'),(80,'law','التركات والمواريث',NULL,1,'2026-08-11 12:16:22','2026-08-11 12:16:22'),(81,'law','الأوقاف والوصايا',NULL,1,'2026-08-11 12:16:31','2026-08-11 12:16:31'),(82,'law','القضايا الجزائية',NULL,1,'2026-08-11 12:16:37','2026-08-11 12:16:37'),(83,'law','القضايا الجزائية',NULL,1,'2026-08-11 12:16:47','2026-08-11 12:16:47'),(84,'law','غسل الأموال وتمويل الإرهاب',NULL,1,'2026-08-11 12:16:58','2026-08-11 12:16:58'),(85,'law','مكافحة الفساد والرشوة',NULL,1,'2026-08-11 12:17:04','2026-08-11 12:17:04'),(86,'law','القضايا الإدارية (ديوان المظالم)',NULL,1,'2026-08-11 12:17:11','2026-08-11 12:17:11'),(87,'law','الوظيفة العامة والتأديب',NULL,1,'2026-08-11 12:17:19','2026-08-11 12:17:19'),(88,'law','المناقصات والمشتريات الحكومية',NULL,1,'2026-08-11 12:17:27','2026-08-11 12:17:27'),(89,'law','الزكاة والضرائب',NULL,1,'2026-08-11 12:17:34','2026-08-11 12:17:34'),(90,'law','الجمارك والتجارة الدولية',NULL,1,'2026-08-11 12:17:41','2026-08-11 12:17:41'),(91,'law','البنوك والتمويل',NULL,1,'2026-08-11 12:17:49','2026-08-11 12:17:49'),(92,'law','التأمين',NULL,1,'2026-08-11 12:17:54','2026-08-11 12:17:54'),(93,'law','الأوراق المالية وسوق المال',NULL,1,'2026-08-11 12:18:06','2026-08-11 12:18:06'),(94,'law','النقل والخدمات اللوجستية',NULL,1,'2026-08-11 12:18:15','2026-08-11 12:18:15'),(95,'law','القانون البحري',NULL,1,'2026-08-11 12:18:23','2026-08-11 12:18:23'),(96,'law','قانون الطيران',NULL,1,'2026-08-11 12:18:31','2026-08-11 12:18:31'),(97,'law','الطاقة والتعدين',NULL,1,'2026-08-11 12:18:39','2026-08-11 12:18:39'),(98,'law','القطاع الصحي والأخطاء الطبية',NULL,1,'2026-08-11 12:18:46','2026-08-11 12:18:46'),(99,'law','التعليم والجامعات',NULL,1,'2026-08-11 12:18:54','2026-08-11 12:18:54'),(100,'law','الجمعيات الأهلية والقطاع غير الربحي',NULL,1,'2026-08-11 12:19:01','2026-08-11 12:19:01'),(101,'law','الاستشارات القانونية والتمثيل القضائي',NULL,1,'2026-08-11 12:19:10','2026-08-11 12:19:10');
/*!40000 ALTER TABLE `bs_specialties` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bs_users`
--

DROP TABLE IF EXISTS `bs_users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bs_users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) NOT NULL,
  `email` varchar(191) NOT NULL,
  `phone` varchar(191) DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) NOT NULL,
  `role` enum('admin','supervisor','user') NOT NULL DEFAULT 'user',
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `permissions` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`permissions`)),
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `bs_users_email_unique` (`email`)
) ENGINE=MyISAM AUTO_INCREMENT=49 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bs_users`
--

LOCK TABLES `bs_users` WRITE;
/*!40000 ALTER TABLE `bs_users` DISABLE KEYS */;
INSERT INTO `bs_users` VALUES (1,'انور احمد','aanwr6652@gmail.com','0556351761',NULL,'$2y$12$pbJH7Uz/HTUbL2.ENBUu2O5qWCPOoA/MK5iFEg7hcoFfluoGAcKdq','user',1,NULL,NULL,'2026-05-19 16:06:58','2026-05-19 16:06:58'),(2,'شسي','tesd@gmail.xom','05545455545',NULL,'$2y$12$L9.00OstSzdetmsBl9QMPe71XRXfYNkceMzgud3YOisRfNSlBFbEi','user',1,NULL,NULL,'2026-05-21 12:01:20','2026-05-21 12:01:20'),(3,'محسن العتيبي','7m7m1191@gmail.com','0504884879',NULL,'$2y$12$pDMOkZ37u886F.Z9ZjFxs.bayrrVuZUwHSUiL2Ahiczq7Rrt/K4rK','user',1,NULL,NULL,'2026-05-23 12:53:19','2026-05-23 12:53:19'),(4,'ساره عبدالرحمن','sarah@najdsteel.com','+966598721813',NULL,'$2y$12$H3Laj4XCUzqsOZ7v6RBdbup/MxoKs2zH4CTIUyyz2V4YCZ9X5Owde','user',1,NULL,NULL,'2026-05-24 04:35:23','2026-05-24 04:35:23'),(5,'بكيل','bakeelwork2@gmail.com','0536892909',NULL,'$2y$12$ZAhWgJPGi0RrAuQVF2fnXOd13aS5yVkdRPCnBbYP3ko5rTS7225ji','user',1,NULL,NULL,'2026-05-24 08:18:02','2026-05-24 08:18:02'),(6,'ماويه العوفي','raid_gaid_2012@icloud.com','0544137570',NULL,'$2y$12$JbOm81f1.MPQk4ja.HqKbuGKbxECG0EEtX2taXh7PDnG/VcwvMbP.','user',1,NULL,NULL,'2026-05-24 15:44:01','2026-05-24 15:44:01'),(7,'نصر','naser1994.nba@gmail.com','0568842729',NULL,'$2y$12$dmIiTj.BoWJn4CS.6KeqqeFAB.Uy1cFUupju8E33sBt7DovmTNIES','user',1,NULL,NULL,'2026-05-30 13:33:50','2026-05-30 13:33:50'),(8,'RAKAN ALHARBI','alharbira950@gmail.com','+966568990950',NULL,'$2y$12$UHJ3aEEZyFqVCOHBPxmuE.X/AZTzNDDC4czu0FJq1BRI.5/UuHZ8K','user',1,NULL,NULL,'2026-06-02 12:37:45','2026-06-02 12:37:45'),(9,'Mohammed Alsir','m7md3lsir.10@gmail.com','0501807076',NULL,'$2y$12$eZNWWavXEfTe7q2a26PZHOA6C/dKMawtVIb1V2rhH599N.q7T2B/m','user',1,NULL,NULL,'2026-06-03 13:16:35','2026-06-03 13:16:35'),(10,'محمد','m7mdb3sher@gmail.com','0501807075',NULL,'$2y$12$VA0sQK0Vm3vgoiNzIeAC1e4KQNM6mb2ZEa7/QyCPuQ7a9kh91aLmW','user',1,NULL,NULL,'2026-06-05 10:54:51','2026-06-05 10:54:51'),(11,'مشرف النظام','supervisor@amrtm.com.sa',NULL,NULL,'$2y$12$f9YWR0MoInrYLSezJmhMTemQ5ZeQK4DI7MMwUEDzq0SqctPMJtANW','supervisor',1,NULL,'UVAQgGO4OZFFypy30ta9bSOoRd29eGigMT8IDOJVhdhzi91HeGPJOGOSu1l0','2026-06-10 07:53:43','2026-06-10 07:53:43'),(12,'محمود الخليفه','melhaj277@gmail.com','0504013613',NULL,'$2y$12$UMY6ScbDqC/S4QDQbkyAS.LqJpK.kAhT2.YHOXH0X2jmLzuI7QjbK','user',1,NULL,NULL,'2026-06-12 05:32:09','2026-06-12 05:32:09'),(13,'محمد الاسقر','mohammedname2002@gmail.com','+972592257669',NULL,'$2y$12$OuJTYDJtE5VP4CtGRzXKeeDCTpUo4uO5GO87CCgwaKFJp7iE6XgCu','user',1,NULL,NULL,'2026-06-13 03:17:30','2026-06-13 03:17:30'),(14,'Ibrahim Mohammed Yasin Kaid','ibrakaid2012@gmail.com','0502014299',NULL,'$2y$12$.3RqxdFafdj87oJB24B1sOzLFyOG0ELd3FFKq1I7vmceVPeK8tGle','user',1,NULL,NULL,'2026-06-13 11:40:18','2026-06-13 11:40:18'),(15,'Bertin K ASSOGBA NONGNIDE','dg@ibt-sarl.com','+2290197395110',NULL,'$2y$12$CiwCXcKs/iYeV.o1TK0hIOHMYwk0HILqG3eMwR3Mu4y.nI2xMvSVq','user',1,NULL,NULL,'2026-06-13 21:48:28','2026-06-13 21:48:28'),(16,'ali','ali123@gmail.com','0538981732',NULL,'$2y$12$nHkAZS9BAr9pGaDJQGVJWu21HMVDgmtQXBxiNsXisa8KbwiLl437K','user',1,NULL,NULL,'2026-06-20 11:02:26','2026-06-20 11:02:26'),(17,'فيض خان اعظم','poi09p8@gmail.com','0580288373',NULL,'$2y$12$Sfrh4HF/nzRp0wroZPX5EOr5ta4qGX2.GgQKttFVjvksmzn/j1uua','user',1,NULL,NULL,'2026-06-21 07:36:28','2026-06-21 07:36:28'),(18,'Mujahid Mohammed','alshawahidalrawasi@gmail.com','0502275361',NULL,'$2y$12$YWpJSzqC4Oacpp2ffe8KWeBe7DnHPmYmbgydoeO5AxugKhRG96Cni','user',1,NULL,NULL,'2026-06-21 07:38:40','2026-06-21 07:38:40'),(19,'ىىلايى','EMESMITH96@GMAIL.COM','0545743457',NULL,'$2y$12$Tj40ifjVhXnWUZycgK1GfehSf1Ov/cu84QeLX6UqcB8GB2rJ0mgNi','user',1,NULL,NULL,'2026-06-24 02:50:54','2026-06-24 02:50:54'),(20,'ياسر الناشري','ban361517@gmail.com','0544339240',NULL,'$2y$12$Rfitgi3lQSkTWi3HO9vHRunrBowiSVWhS5Pn6knyGb06gJknNOI9q','user',1,NULL,NULL,'2026-06-24 17:20:37','2026-06-24 17:20:37'),(21,'Osama Mohamed','oabdelwahed99@gmail.com','+201010082743',NULL,'$2y$12$FdoxCiB5eh2AtxMjG5y51OBIMIb/Q43oT4J.6eBc1FiLrErblaYBi','user',1,NULL,NULL,'2026-06-24 18:50:06','2026-06-24 18:50:06'),(22,'حسن عبد الله العيسى','alysyhsnbdallh9@gmail.com','0561617201',NULL,'$2y$12$olfZ4GHYXzeJEwfnsIRb1uUS2Hk9ASKaEsNWjie4Hw2QAf6AJbZZ2','user',1,NULL,NULL,'2026-06-25 09:56:39','2026-06-25 09:56:39'),(23,'خالد بن ضيف الله بن مسفر العتيبي','khalidsst@hotmail.com','+966556200292',NULL,'$2y$12$QTKpQdvKw9VXCx8e7QyoU.FY3T07js2JtyjpS45h1L3ojw3sGOLUK','user',1,NULL,NULL,'2026-06-29 08:27:49','2026-06-29 08:27:49'),(24,'Raad Ghanem','raadghanemm@gmail.com','305355555',NULL,'$2y$12$xePrcXB37Tz5d71rTvwbSu.v.SVylifQP1ihR8z3RR.9YtICWyEhe','user',1,NULL,NULL,'2026-06-30 03:40:52','2026-06-30 03:40:52'),(25,'عبدالله حسن دبشه','iiiaaalll20@gmail.fom','+966597231174',NULL,'$2y$12$ICMmQ5N7WKpigU/OsgeGZ.oYglC.UnZFZ1VdrvVmgNgExUp/QCYmC','user',1,NULL,NULL,'2026-07-01 12:20:06','2026-07-01 12:20:06'),(26,'MOHAMMED ALQAHTANI','qx_8@outlook.sa','+966555616323',NULL,'$2y$12$vV/ftNr/M/zNx2G9wnuCVujcOpkvSNe7ZKMKS6BQVG3C8bu9fwOVO','user',1,NULL,NULL,'2026-07-16 17:28:07','2026-07-16 17:28:07'),(27,'mohamed Alsyed','elsmohamed01@gmail.com','0570324077',NULL,'$2y$12$SeBD0P3DErUBzto50QKOvu9hwkFtHCUKp7acJKF5roS8kTT37t1g.','user',1,NULL,NULL,'2026-07-19 09:31:00','2026-07-19 09:31:00'),(28,'mohamed Alsyed','mohamedalsyed848@gmail.com','+201024567643',NULL,'$2y$12$nEkwx8FN7GBWYhjudTn5nuxczPPWQe/oCxT9p0gFIz0guEnZY6ok6','user',1,NULL,NULL,'2026-07-20 09:24:44','2026-07-20 09:24:44'),(29,'amr sallam','amr74513@gmail.com','01012157538',NULL,'$2y$12$k3rq3OtwAraJN3tojXE4luGZu2w43QNQrDd7yffvZ/U9LGErua5ti','user',1,NULL,NULL,'2026-07-20 11:01:59','2026-07-20 11:01:59'),(30,'Maram','maramhtt611999@gmail.com','0598581863',NULL,'$2y$12$sIp9VjoR09rDX/Eh5LNoi.MysyrSgbJIeY9Cwl.tb25nWr0PtQY.a','user',1,NULL,NULL,'2026-07-25 11:23:17','2026-07-25 11:23:17'),(31,'ادارة الادخال','nasr32015@gmail.com','0508581863',NULL,'$2y$12$Jc3N47Oi/hOoGOTfi2AW3um9cHIssw2vpZV3eLEERnDNhLRTpEUu2','admin',1,'[\"manage_catalog\"]',NULL,'2026-07-28 13:31:01','2026-07-28 13:31:07'),(32,'ادارة ادخال امر تم','dataentry@amrtm.com','00508581888',NULL,'$2y$12$DGmEPdnYtLU.s3hcCarRkuvjiMtjCe8K.Lsw3H/iEprtI1Y4ISSJ6','admin',1,'[\"manage_catalog\"]',NULL,'2026-07-28 13:41:13','2026-08-04 11:53:55'),(33,'mohamed','alsmohamed01@gmaol.com','0570324077',NULL,'$2y$12$AIBesfGwG1bKM5G4n/80kudPONz/khZOaotWFydAWnp6FivhwerR2','user',1,NULL,NULL,'2026-07-29 07:18:26','2026-07-29 07:18:26'),(34,'‪Mohamed Amer‬','amer123u4@gmail.com','0544152755',NULL,'$2y$12$7qt4C8QaMowhXDHwcobOhuD8.zW8JEio6ImyG00VXwib7BK5UuB8.','user',1,NULL,NULL,'2026-08-01 09:33:24','2026-08-01 09:33:24'),(35,'super','super@amrtm','0570324077',NULL,'$2y$12$IMb5X/TUSMQpLslo6EJ7/euk9GEFXiTSYtYH2o/AFJaVCRoWP2ZX2','admin',1,'[]',NULL,'2026-08-04 12:06:27','2026-08-04 12:07:04'),(36,'Fatmah Ali Alshmrani','Fatmahali2017@hotmail.com','0501214254',NULL,'$2y$12$iPtcofobShskNOhqSylgZeD0auXh3Y6bA3RAAx1Smeq3MeDPx/W6u','user',1,NULL,NULL,'2026-08-11 14:21:01','2026-08-11 14:21:01'),(37,'علي ابراهيم','dgsgdhdhdhd4@gmaol.com','+966570324077',NULL,'$2y$12$IgwJ7q3UIuLaJa.G/07gvOhRjCyrwH0GiAEnGwHr6/mTjlMcHQLi.','user',1,NULL,NULL,'2026-08-12 08:23:24','2026-08-12 08:23:24'),(38,'mohamed','handsa44@gmaol.com','+966570324077',NULL,'$2y$12$s8iY0j9RbOd4zrpn89m0PeI1RIdjYAr13O4sY43hjGagblb5xArIG','user',1,NULL,NULL,'2026-08-12 08:27:06','2026-08-12 08:27:06'),(39,'علي ابراهيم','sfsdrgdgddf@gmaol.com','+966570324077',NULL,'$2y$12$PaCBXeVtU6HEPEcqHg.IdOQ8uF3Splnst6ohSsbUxQAHoLhc4Fzo6','user',1,NULL,NULL,'2026-08-12 11:50:47','2026-08-12 11:50:47'),(40,'بشائر','2besh2002@gmail.com','0530053659',NULL,'$2y$12$KoD5J11s/ihIzpVjAR7QpO597RyBjaFVudW9U3cOGz7wi50OKBpSe','user',1,NULL,NULL,'2026-08-12 12:18:21','2026-08-12 12:18:21'),(41,'حسام الغامدي','hsam13100@gmail.com','+966536417586',NULL,'$2y$12$ejRZT1H9QtuiZ.N6qOOWzuTMx1y4vYY3oDRQRbSxM9oXebukl1I9a','user',1,NULL,NULL,'2026-08-13 00:13:57','2026-08-13 00:13:57'),(42,'علي ابراهيم','Aliebrah8578577im4584@gmaol.com','+966570324077',NULL,'$2y$12$9K.oEnotKjby6zrBDabHCOJoTwQyLXTlf0uIsFQHDeO6QNzYab8Um','user',1,NULL,NULL,'2026-08-15 10:17:21','2026-08-15 10:17:21'),(43,'صالح الشمراني','salehalshamrani@hotmail.com','+966500607733',NULL,'$2y$12$ShO7Z5tFg6fJ2vI.hpy2v.RPqMGOkRnoPH8q9CcyB8XfTKvfFUOWW','user',1,NULL,NULL,'2026-08-16 09:21:52','2026-08-16 09:21:52'),(44,'Saleh Alshmrani','h.alkobati@gmail.com','+966556535777',NULL,'$2y$12$.88NOe32V0ASJnT9/f52ueueaRxpzpCsoFeUDdT2GP4nldRGQRgJq','user',1,NULL,NULL,'2026-08-16 09:39:01','2026-08-16 09:39:01'),(45,'Rami Abdullah','abdurs0a@hotmail.com','0502010593',NULL,'$2y$12$i5RNTU/OaSy8/yOx7n2GQOFwQAr8GKMP2dikp8Y/z3M1IO7DOorYa','user',1,NULL,NULL,'2026-08-17 13:35:28','2026-08-17 13:35:28'),(46,'فالح عوض العتيبي','zdd686zdd@gmail.com','0536249633',NULL,'$2y$12$hhqTnupwCpekSueFaf7WaOAFLBAcz/GX/wzgJLu3cepYkd03WwZYO','user',1,NULL,NULL,'2026-08-19 09:44:22','2026-08-19 09:44:22'),(47,'الفضل كمال','fdel.kamal.g@gmail.com','05682271',NULL,'$2y$12$wm1dP54Ijywkl5AYXbZqJe5csZwb3xTwthclNcFsw5uCoefp2ugNK','user',1,NULL,NULL,'2026-08-19 17:15:32','2026-08-19 17:15:32'),(48,'prophonesoft@gmail.com','prophonesoft@gmail.com','0545192879',NULL,'$2y$12$OOvIWjGJudFqRJenhqtDFOtsvg5j9GK27qOks4i/C.FOgOeZGphmq','user',1,NULL,NULL,'2026-08-25 10:56:39','2026-08-25 10:56:39');
/*!40000 ALTER TABLE `bs_users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `business_notifications`
--

DROP TABLE IF EXISTS `business_notifications`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `business_notifications` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned NOT NULL,
  `sender_id` bigint(20) unsigned DEFAULT NULL,
  `type` varchar(191) NOT NULL DEFAULT 'info',
  `title` varchar(191) NOT NULL,
  `body` text NOT NULL,
  `request_id` bigint(20) unsigned DEFAULT NULL,
  `is_read` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `business_notifications_user_id_foreign` (`user_id`),
  KEY `business_notifications_sender_id_foreign` (`sender_id`),
  KEY `business_notifications_request_id_foreign` (`request_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `business_notifications`
--

LOCK TABLES `business_notifications` WRITE;
/*!40000 ALTER TABLE `business_notifications` DISABLE KEYS */;
/*!40000 ALTER TABLE `business_notifications` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cache`
--

DROP TABLE IF EXISTS `cache`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cache` (
  `key` varchar(191) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL,
  PRIMARY KEY (`key`),
  KEY `cache_expiration_index` (`expiration`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cache`
--

LOCK TABLES `cache` WRITE;
/*!40000 ALTER TABLE `cache` DISABLE KEYS */;
/*!40000 ALTER TABLE `cache` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cache_locks`
--

DROP TABLE IF EXISTS `cache_locks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cache_locks` (
  `key` varchar(191) NOT NULL,
  `owner` varchar(191) NOT NULL,
  `expiration` int(11) NOT NULL,
  PRIMARY KEY (`key`),
  KEY `cache_locks_expiration_index` (`expiration`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cache_locks`
--

LOCK TABLES `cache_locks` WRITE;
/*!40000 ALTER TABLE `cache_locks` DISABLE KEYS */;
/*!40000 ALTER TABLE `cache_locks` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cart_items`
--

DROP TABLE IF EXISTS `cart_items`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cart_items` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `cart_id` bigint(20) unsigned NOT NULL,
  `item_type` varchar(191) NOT NULL,
  `item_id` bigint(20) unsigned NOT NULL,
  `label` varchar(191) NOT NULL,
  `price_snapshot` decimal(10,2) NOT NULL DEFAULT 0.00,
  `event_date` date DEFAULT NULL,
  `notes` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `cart_items_cart_id_foreign` (`cart_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cart_items`
--

LOCK TABLES `cart_items` WRITE;
/*!40000 ALTER TABLE `cart_items` DISABLE KEYS */;
/*!40000 ALTER TABLE `cart_items` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `carts`
--

DROP TABLE IF EXISTS `carts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `carts` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `carts_user_id_foreign` (`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `carts`
--

LOCK TABLES `carts` WRITE;
/*!40000 ALTER TABLE `carts` DISABLE KEYS */;
/*!40000 ALTER TABLE `carts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `categories` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `key` varchar(191) NOT NULL,
  `name_ar` varchar(191) NOT NULL,
  `name_en` varchar(191) NOT NULL,
  `icon` varchar(191) NOT NULL DEFAULT 'ti-building',
  `color` varchar(191) NOT NULL DEFAULT '#1A237E',
  `bg` varchar(191) NOT NULL DEFAULT 'rgba(26,35,126,.1)',
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `sort_order` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `categories_key_unique` (`key`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categories`
--

LOCK TABLES `categories` WRITE;
/*!40000 ALTER TABLE `categories` DISABLE KEYS */;
/*!40000 ALTER TABLE `categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `entities`
--

DROP TABLE IF EXISTS `entities`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `entities` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `category_id` bigint(20) unsigned NOT NULL,
  `name_ar` varchar(191) NOT NULL,
  `name_en` varchar(191) NOT NULL,
  `icon` varchar(191) NOT NULL DEFAULT 'ti-building',
  `color` varchar(191) NOT NULL DEFAULT '#1A237E',
  `bg` varchar(191) NOT NULL DEFAULT 'rgba(26,35,126,.1)',
  `tag_ar` varchar(191) DEFAULT NULL,
  `tag_en` varchar(191) DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `sort_order` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `entities_category_id_foreign` (`category_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `entities`
--

LOCK TABLES `entities` WRITE;
/*!40000 ALTER TABLE `entities` DISABLE KEYS */;
/*!40000 ALTER TABLE `entities` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(191) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `failed_jobs`
--

LOCK TABLES `failed_jobs` WRITE;
/*!40000 ALTER TABLE `failed_jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `failed_jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `franchise_auctions`
--

DROP TABLE IF EXISTS `franchise_auctions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `franchise_auctions` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `brand_id` bigint(20) unsigned NOT NULL,
  `title` varchar(191) NOT NULL,
  `description` text DEFAULT NULL,
  `starting_bid` bigint(20) unsigned NOT NULL,
  `current_bid` bigint(20) unsigned NOT NULL,
  `reserve_price` bigint(20) unsigned DEFAULT NULL,
  `increment_amount` bigint(20) unsigned NOT NULL DEFAULT 2500,
  `deposit_amount` bigint(20) unsigned NOT NULL DEFAULT 5000,
  `bids_count` int(10) unsigned NOT NULL DEFAULT 0,
  `status` enum('upcoming','active','ended','cancelled') NOT NULL DEFAULT 'active',
  `starts_at` timestamp NULL DEFAULT NULL,
  `ends_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `winner_id` bigint(20) unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `franchise_auctions_brand_id_foreign` (`brand_id`),
  KEY `franchise_auctions_winner_id_foreign` (`winner_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `franchise_auctions`
--

LOCK TABLES `franchise_auctions` WRITE;
/*!40000 ALTER TABLE `franchise_auctions` DISABLE KEYS */;
/*!40000 ALTER TABLE `franchise_auctions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `franchise_bids`
--

DROP TABLE IF EXISTS `franchise_bids`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `franchise_bids` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `auction_id` bigint(20) unsigned NOT NULL,
  `user_id` bigint(20) unsigned NOT NULL,
  `amount` bigint(20) unsigned NOT NULL,
  `status` enum('active','outbid','won','refunded') NOT NULL DEFAULT 'active',
  `deposit_ref` varchar(191) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `franchise_bids_auction_id_foreign` (`auction_id`),
  KEY `franchise_bids_user_id_foreign` (`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `franchise_bids`
--

LOCK TABLES `franchise_bids` WRITE;
/*!40000 ALTER TABLE `franchise_bids` DISABLE KEYS */;
/*!40000 ALTER TABLE `franchise_bids` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `franchise_brand_images`
--

DROP TABLE IF EXISTS `franchise_brand_images`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `franchise_brand_images` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `brand_id` bigint(20) unsigned NOT NULL,
  `path` varchar(191) NOT NULL,
  `caption` varchar(191) DEFAULT NULL,
  `sort_order` smallint(5) unsigned NOT NULL DEFAULT 0,
  `is_primary` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `franchise_brand_images_brand_id_foreign` (`brand_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `franchise_brand_images`
--

LOCK TABLES `franchise_brand_images` WRITE;
/*!40000 ALTER TABLE `franchise_brand_images` DISABLE KEYS */;
/*!40000 ALTER TABLE `franchise_brand_images` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `franchise_brands`
--

DROP TABLE IF EXISTS `franchise_brands`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `franchise_brands` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) NOT NULL,
  `name_en` varchar(191) DEFAULT NULL,
  `logo` varchar(191) DEFAULT NULL,
  `category` varchar(191) NOT NULL,
  `subcategory` varchar(191) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `description_en` text DEFAULT NULL,
  `investment_min` bigint(20) unsigned NOT NULL DEFAULT 0,
  `investment_max` bigint(20) unsigned NOT NULL DEFAULT 0,
  `roi_months_min` smallint(5) unsigned NOT NULL DEFAULT 12,
  `roi_months_max` smallint(5) unsigned NOT NULL DEFAULT 24,
  `franchise_fee_percent` decimal(4,2) NOT NULL DEFAULT 5.00,
  `available_regions` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`available_regions`)),
  `requirements` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`requirements`)),
  `features` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`features`)),
  `is_featured` tinyint(1) NOT NULL DEFAULT 0,
  `is_auction_eligible` tinyint(1) NOT NULL DEFAULT 0,
  `status` enum('active','inactive','draft') NOT NULL DEFAULT 'active',
  `sort_order` smallint(5) unsigned NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `franchise_brands`
--

LOCK TABLES `franchise_brands` WRITE;
/*!40000 ALTER TABLE `franchise_brands` DISABLE KEYS */;
/*!40000 ALTER TABLE `franchise_brands` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `franchise_opportunities`
--

DROP TABLE IF EXISTS `franchise_opportunities`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `franchise_opportunities` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) NOT NULL,
  `name_en` varchar(191) DEFAULT NULL,
  `category` varchar(191) NOT NULL DEFAULT 'food',
  `description` text DEFAULT NULL,
  `icon` varchar(191) NOT NULL DEFAULT 'fa-store',
  `gradient_from` varchar(191) NOT NULL DEFAULT '#0d2448',
  `gradient_to` varchar(191) NOT NULL DEFAULT '#1a4a8a',
  `badge_text` varchar(191) DEFAULT NULL,
  `investment_min` bigint(20) unsigned NOT NULL DEFAULT 0,
  `investment_max` bigint(20) unsigned NOT NULL DEFAULT 0,
  `roi_months_min` int(10) unsigned NOT NULL DEFAULT 12,
  `roi_months_max` int(10) unsigned NOT NULL DEFAULT 24,
  `franchise_fee_percent` decimal(4,1) NOT NULL DEFAULT 5.0,
  `available_regions` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`available_regions`)),
  `requirements` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`requirements`)),
  `status` enum('active','inactive') NOT NULL DEFAULT 'active',
  `is_featured` tinyint(1) NOT NULL DEFAULT 0,
  `sort_order` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `franchise_opportunities`
--

LOCK TABLES `franchise_opportunities` WRITE;
/*!40000 ALTER TABLE `franchise_opportunities` DISABLE KEYS */;
/*!40000 ALTER TABLE `franchise_opportunities` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `franchise_opportunity_steps`
--

DROP TABLE IF EXISTS `franchise_opportunity_steps`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `franchise_opportunity_steps` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `opportunity_id` bigint(20) unsigned NOT NULL,
  `title` varchar(191) NOT NULL,
  `description` text DEFAULT NULL,
  `icon` varchar(191) NOT NULL DEFAULT 'fa-circle',
  `sort_order` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `franchise_opportunity_steps_opportunity_id_foreign` (`opportunity_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `franchise_opportunity_steps`
--

LOCK TABLES `franchise_opportunity_steps` WRITE;
/*!40000 ALTER TABLE `franchise_opportunity_steps` DISABLE KEYS */;
/*!40000 ALTER TABLE `franchise_opportunity_steps` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `gov_services`
--

DROP TABLE IF EXISTS `gov_services`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `gov_services` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `entity_id` bigint(20) unsigned NOT NULL,
  `name_ar` varchar(191) NOT NULL,
  `name_en` varchar(191) NOT NULL,
  `icon` varchar(191) NOT NULL DEFAULT 'ti-file-text',
  `price` decimal(10,2) NOT NULL DEFAULT 0.00,
  `description_ar` text DEFAULT NULL,
  `description_en` text DEFAULT NULL,
  `estimated_days` int(11) NOT NULL DEFAULT 3,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `sort_order` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `gov_services_entity_id_foreign` (`entity_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `gov_services`
--

LOCK TABLES `gov_services` WRITE;
/*!40000 ALTER TABLE `gov_services` DISABLE KEYS */;
/*!40000 ALTER TABLE `gov_services` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `hall_bookings`
--

DROP TABLE IF EXISTS `hall_bookings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `hall_bookings` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `hall_id` bigint(20) unsigned NOT NULL,
  `user_id` bigint(20) unsigned NOT NULL,
  `owner_name` varchar(191) NOT NULL,
  `booking_date` date NOT NULL,
  `occasion_type` enum('wedding','engagement','birthday','corporate','graduation','meeting','other') NOT NULL,
  `guests_count` int(10) unsigned NOT NULL,
  `tables_count` int(10) unsigned NOT NULL,
  `notes` text DEFAULT NULL,
  `total_price` decimal(10,2) NOT NULL DEFAULT 0.00,
  `payment_method` varchar(30) DEFAULT NULL,
  `payment_contact` varchar(30) DEFAULT NULL,
  `payment_email` varchar(191) DEFAULT NULL,
  `payment_reference` varchar(100) DEFAULT NULL,
  `payment_status` varchar(20) NOT NULL DEFAULT 'pending',
  `status` enum('pending','confirmed','cancelled') NOT NULL DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `hall_bookings_hall_id_foreign` (`hall_id`),
  KEY `hall_bookings_user_id_foreign` (`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `hall_bookings`
--

LOCK TABLES `hall_bookings` WRITE;
/*!40000 ALTER TABLE `hall_bookings` DISABLE KEYS */;
/*!40000 ALTER TABLE `hall_bookings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `hall_busy_dates`
--

DROP TABLE IF EXISTS `hall_busy_dates`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `hall_busy_dates` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `hall_id` bigint(20) unsigned NOT NULL,
  `busy_date` date NOT NULL,
  `reason` varchar(191) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `hall_busy_dates_hall_id_busy_date_unique` (`hall_id`,`busy_date`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `hall_busy_dates`
--

LOCK TABLES `hall_busy_dates` WRITE;
/*!40000 ALTER TABLE `hall_busy_dates` DISABLE KEYS */;
/*!40000 ALTER TABLE `hall_busy_dates` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `hall_features`
--

DROP TABLE IF EXISTS `hall_features`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `hall_features` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `hall_id` bigint(20) unsigned NOT NULL,
  `name` varchar(191) NOT NULL,
  `icon` varchar(191) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `hall_features_hall_id_foreign` (`hall_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `hall_features`
--

LOCK TABLES `hall_features` WRITE;
/*!40000 ALTER TABLE `hall_features` DISABLE KEYS */;
/*!40000 ALTER TABLE `hall_features` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `hall_media`
--

DROP TABLE IF EXISTS `hall_media`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `hall_media` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `hall_id` bigint(20) unsigned NOT NULL,
  `file_path` varchar(191) NOT NULL,
  `sort_order` int(10) unsigned NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `hall_media_hall_id_foreign` (`hall_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `hall_media`
--

LOCK TABLES `hall_media` WRITE;
/*!40000 ALTER TABLE `hall_media` DISABLE KEYS */;
/*!40000 ALTER TABLE `hall_media` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `hall_offers`
--

DROP TABLE IF EXISTS `hall_offers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `hall_offers` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `hall_id` bigint(20) unsigned NOT NULL,
  `title` varchar(191) NOT NULL,
  `discount_type` enum('percentage','fixed','none') NOT NULL DEFAULT 'none',
  `discount_value` decimal(8,2) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `included_services` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`included_services`)),
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `hall_offers_hall_id_foreign` (`hall_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `hall_offers`
--

LOCK TABLES `hall_offers` WRITE;
/*!40000 ALTER TABLE `hall_offers` DISABLE KEYS */;
/*!40000 ALTER TABLE `hall_offers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `hall_partners`
--

DROP TABLE IF EXISTS `hall_partners`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `hall_partners` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `hall_id` bigint(20) unsigned NOT NULL,
  `company_name` varchar(191) NOT NULL,
  `logo_path` varchar(191) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `hall_partners_hall_id_foreign` (`hall_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `hall_partners`
--

LOCK TABLES `hall_partners` WRITE;
/*!40000 ALTER TABLE `hall_partners` DISABLE KEYS */;
/*!40000 ALTER TABLE `hall_partners` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `hall_seasonal_prices`
--

DROP TABLE IF EXISTS `hall_seasonal_prices`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `hall_seasonal_prices` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `hall_id` bigint(20) unsigned NOT NULL,
  `label` varchar(191) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `price_per_day` decimal(10,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `hall_seasonal_prices_hall_id_foreign` (`hall_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `hall_seasonal_prices`
--

LOCK TABLES `hall_seasonal_prices` WRITE;
/*!40000 ALTER TABLE `hall_seasonal_prices` DISABLE KEYS */;
/*!40000 ALTER TABLE `hall_seasonal_prices` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `hall_verification_documents`
--

DROP TABLE IF EXISTS `hall_verification_documents`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `hall_verification_documents` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `hall_id` bigint(20) unsigned DEFAULT NULL,
  `owner_id` bigint(20) unsigned NOT NULL,
  `document_type` varchar(191) NOT NULL,
  `file_path` varchar(191) NOT NULL,
  `expiry_date` date DEFAULT NULL,
  `status` enum('pending','approved','rejected') NOT NULL DEFAULT 'pending',
  `admin_note` varchar(191) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `hall_verification_documents_hall_id_foreign` (`hall_id`),
  KEY `hall_verification_documents_owner_id_foreign` (`owner_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `hall_verification_documents`
--

LOCK TABLES `hall_verification_documents` WRITE;
/*!40000 ALTER TABLE `hall_verification_documents` DISABLE KEYS */;
/*!40000 ALTER TABLE `hall_verification_documents` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `halls`
--

DROP TABLE IF EXISTS `halls`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `halls` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `owner_id` bigint(20) unsigned NOT NULL,
  `registered_by` bigint(20) unsigned DEFAULT NULL,
  `registration_commission_rate` decimal(5,2) NOT NULL DEFAULT 0.00,
  `name` varchar(191) NOT NULL,
  `venue_type` varchar(191) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `location` varchar(191) NOT NULL,
  `city` varchar(191) NOT NULL,
  `country` varchar(100) DEFAULT NULL,
  `commercial_reg_number` varchar(60) DEFAULT NULL,
  `latitude` decimal(10,7) DEFAULT NULL,
  `longitude` decimal(10,7) DEFAULT NULL,
  `capacity` int(10) unsigned NOT NULL,
  `max_tables` int(10) unsigned NOT NULL,
  `price_per_day` decimal(10,2) NOT NULL,
  `profile_photo` varchar(191) DEFAULT NULL,
  `cover_photo` varchar(191) DEFAULT NULL,
  `whatsapp_number` varchar(20) DEFAULT NULL,
  `status` enum('pending','under_review','active','inactive','rejected') NOT NULL DEFAULT 'pending',
  `admin_note` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `halls_owner_id_foreign` (`owner_id`),
  KEY `halls_registered_by_foreign` (`registered_by`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `halls`
--

LOCK TABLES `halls` WRITE;
/*!40000 ALTER TABLE `halls` DISABLE KEYS */;
/*!40000 ALTER TABLE `halls` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `job_batches`
--

DROP TABLE IF EXISTS `job_batches`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `job_batches` (
  `id` varchar(191) NOT NULL,
  `name` varchar(191) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `job_batches`
--

LOCK TABLES `job_batches` WRITE;
/*!40000 ALTER TABLE `job_batches` DISABLE KEYS */;
/*!40000 ALTER TABLE `job_batches` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jobs`
--

DROP TABLE IF EXISTS `jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `queue` varchar(191) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) unsigned NOT NULL,
  `reserved_at` int(10) unsigned DEFAULT NULL,
  `available_at` int(10) unsigned NOT NULL,
  `created_at` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_index` (`queue`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jobs`
--

LOCK TABLES `jobs` WRITE;
/*!40000 ALTER TABLE `jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(191) NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=51 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'0001_01_01_000000_create_users_table',1),(2,'0001_01_01_000001_create_cache_table',1),(3,'0001_01_01_000002_create_jobs_table',1),(4,'2026_04_15_000001_create_halls_table',1),(5,'2026_04_15_000002_create_hall_media_table',1),(6,'2026_04_15_000003_create_hall_features_table',1),(7,'2026_04_15_000004_create_hall_partners_table',1),(8,'2026_04_15_000005_create_hall_seasonal_prices_table',1),(9,'2026_04_15_000006_create_hall_busy_dates_table',1),(10,'2026_04_15_000007_create_hall_bookings_table',1),(11,'2026_04_15_000008_create_hall_verification_documents_table',1),(12,'2026_04_18_000001_extend_users_role_enum',1),(13,'2026_04_18_000002_create_referral_tables',1),(14,'2026_04_18_000003_extend_halls_and_bookings',1),(15,'2026_04_20_000009_create_partner_categories_table',1),(16,'2026_04_20_000010_create_additional_features_table',1),(17,'2026_04_20_000010_create_supervisor_partners_table',1),(18,'2026_04_22_000001_add_payment_fields_to_hall_bookings_table',1),(19,'2026_04_26_000001_add_venue_fields_to_halls_and_documents',1),(20,'2026_04_26_000002_add_admin_note_to_halls_table',1),(21,'2026_05_02_000001_add_details_to_supervisor_partners_table',1),(22,'2026_05_02_000001_create_hall_offers_table',1),(23,'2026_05_04_000001_create_partners_table',1),(24,'2026_05_04_000002_create_partner_media_table',1),(25,'2026_05_04_000003_create_partner_services_table',1),(26,'2026_05_04_000004_add_partner_role_to_users',1),(27,'2026_05_04_100001_unify_partners_table',1),(28,'2026_05_05_082323_create_service_bookings_table',1),(29,'2026_05_05_090109_make_hall_id_nullable_in_hall_verification_documents_table',1),(30,'2026_05_09_000001_create_carts_table',1),(31,'2026_05_09_000002_create_cart_items_table',1),(32,'2026_05_09_000003_create_orders_table',1),(33,'2026_05_09_000004_create_order_items_table',1),(34,'2026_05_09_141913_add_payment_method_to_orders_table',1),(35,'2026_05_10_100001_create_franchise_brands_table',1),(36,'2026_05_10_100002_create_franchise_brand_images_table',1),(37,'2026_05_10_100003_create_franchise_auctions_table',1),(38,'2026_05_10_100004_create_franchise_bids_table',1),(39,'2026_05_10_200001_create_page_sliders_table',1),(40,'2026_05_10_200002_create_franchise_opportunities_table',1),(41,'2026_05_10_200003_create_franchise_opportunity_steps_table',1),(42,'2026_05_11_000001_create_job_platform_tables',1),(43,'2026_05_12_092857_add_country_to_users_table',1),(44,'2026_05_13_000001_create_amrtm_service_tables',1),(45,'2026_05_13_093255_add_transfer_fields_to_companies_table',1),(46,'2026_05_14_000001_add_country_and_commercial_reg_to_halls_and_partners',1),(47,'2026_05_14_000002_add_business_notifications',1),(48,'2026_05_14_000002_create_bs_users_table',1),(49,'2026_05_14_000003_create_business_database_tables',1),(50,'2026_05_14_000004_add_unique_transaction_ref_to_bs_payments',1);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `order_items`
--

DROP TABLE IF EXISTS `order_items`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `order_items` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `order_id` bigint(20) unsigned NOT NULL,
  `item_type` varchar(191) NOT NULL,
  `item_id` bigint(20) unsigned NOT NULL,
  `label` varchar(191) NOT NULL,
  `price_snapshot` decimal(10,2) NOT NULL DEFAULT 0.00,
  `event_date` date DEFAULT NULL,
  `notes` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `order_items_order_id_foreign` (`order_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `order_items`
--

LOCK TABLES `order_items` WRITE;
/*!40000 ALTER TABLE `order_items` DISABLE KEYS */;
/*!40000 ALTER TABLE `order_items` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `orders` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `order_number` varchar(191) NOT NULL,
  `user_id` bigint(20) unsigned NOT NULL,
  `total_amount` decimal(10,2) NOT NULL,
  `status` varchar(191) NOT NULL DEFAULT 'pending_payment',
  `payment_method` varchar(30) DEFAULT 'bank_transfer',
  `receipt_path` varchar(191) DEFAULT NULL,
  `bank_info_snapshot` text DEFAULT NULL,
  `admin_notes` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `orders_order_number_unique` (`order_number`),
  KEY `orders_user_id_foreign` (`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `orders`
--

LOCK TABLES `orders` WRITE;
/*!40000 ALTER TABLE `orders` DISABLE KEYS */;
/*!40000 ALTER TABLE `orders` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `page_sliders`
--

DROP TABLE IF EXISTS `page_sliders`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `page_sliders` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(191) DEFAULT NULL,
  `subtitle` varchar(191) DEFAULT NULL,
  `image_path` varchar(191) NOT NULL,
  `link_url` varchar(191) DEFAULT NULL,
  `link_text` varchar(191) DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `sort_order` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `page_sliders`
--

LOCK TABLES `page_sliders` WRITE;
/*!40000 ALTER TABLE `page_sliders` DISABLE KEYS */;
/*!40000 ALTER TABLE `page_sliders` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `partner_categories`
--

DROP TABLE IF EXISTS `partner_categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `partner_categories` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `supervisor_id` bigint(20) unsigned NOT NULL,
  `name` varchar(100) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `partner_categories_supervisor_id_foreign` (`supervisor_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `partner_categories`
--

LOCK TABLES `partner_categories` WRITE;
/*!40000 ALTER TABLE `partner_categories` DISABLE KEYS */;
/*!40000 ALTER TABLE `partner_categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `partner_media`
--

DROP TABLE IF EXISTS `partner_media`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `partner_media` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `partner_id` bigint(20) unsigned NOT NULL,
  `file_path` varchar(191) NOT NULL,
  `sort_order` tinyint(3) unsigned NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `partner_media_partner_id_foreign` (`partner_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `partner_media`
--

LOCK TABLES `partner_media` WRITE;
/*!40000 ALTER TABLE `partner_media` DISABLE KEYS */;
/*!40000 ALTER TABLE `partner_media` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `partner_services`
--

DROP TABLE IF EXISTS `partner_services`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `partner_services` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `partner_id` bigint(20) unsigned NOT NULL,
  `title` varchar(150) NOT NULL,
  `description` text DEFAULT NULL,
  `price` varchar(100) DEFAULT NULL,
  `sort_order` tinyint(3) unsigned NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `partner_services_partner_id_foreign` (`partner_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `partner_services`
--

LOCK TABLES `partner_services` WRITE;
/*!40000 ALTER TABLE `partner_services` DISABLE KEYS */;
/*!40000 ALTER TABLE `partner_services` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `partners`
--

DROP TABLE IF EXISTS `partners`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `partners` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned DEFAULT NULL,
  `added_by` bigint(20) unsigned DEFAULT NULL,
  `type` enum('simple','account','officiant') NOT NULL DEFAULT 'account',
  `category_id` bigint(20) unsigned DEFAULT NULL,
  `company_name` varchar(150) NOT NULL,
  `description` text DEFAULT NULL,
  `city` varchar(100) DEFAULT NULL,
  `country` varchar(100) DEFAULT NULL,
  `commercial_reg_number` varchar(60) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `whatsapp` varchar(20) DEFAULT NULL,
  `website` varchar(255) DEFAULT NULL,
  `logo_path` varchar(191) DEFAULT NULL,
  `cover_path` varchar(191) DEFAULT NULL,
  `status` enum('pending','active','rejected') NOT NULL DEFAULT 'pending',
  `admin_note` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `partners_user_id_foreign` (`user_id`),
  KEY `partners_category_id_foreign` (`category_id`),
  KEY `partners_added_by_foreign` (`added_by`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `partners`
--

LOCK TABLES `partners` WRITE;
/*!40000 ALTER TABLE `partners` DISABLE KEYS */;
/*!40000 ALTER TABLE `partners` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_reset_tokens`
--

DROP TABLE IF EXISTS `password_reset_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `password_reset_tokens` (
  `email` varchar(191) NOT NULL,
  `token` varchar(191) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_reset_tokens`
--

LOCK TABLES `password_reset_tokens` WRITE;
/*!40000 ALTER TABLE `password_reset_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_reset_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `referrals`
--

DROP TABLE IF EXISTS `referrals`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `referrals` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `agent_id` bigint(20) unsigned NOT NULL,
  `user_id` bigint(20) unsigned NOT NULL,
  `hall_id` bigint(20) unsigned NOT NULL,
  `booking_id` bigint(20) unsigned DEFAULT NULL,
  `ref_code` varchar(20) NOT NULL,
  `source` enum('link','manual') NOT NULL DEFAULT 'link',
  `commission_rate` decimal(5,2) NOT NULL DEFAULT 10.00,
  `commission_amount` decimal(10,2) DEFAULT NULL,
  `status` enum('pending','confirmed','paid','rejected') NOT NULL DEFAULT 'pending',
  `confirmed_by` bigint(20) unsigned DEFAULT NULL,
  `confirmed_at` timestamp NULL DEFAULT NULL,
  `notes` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `referrals_user_id_hall_id_unique` (`user_id`,`hall_id`),
  KEY `referrals_agent_id_foreign` (`agent_id`),
  KEY `referrals_hall_id_foreign` (`hall_id`),
  KEY `referrals_booking_id_foreign` (`booking_id`),
  KEY `referrals_confirmed_by_foreign` (`confirmed_by`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `referrals`
--

LOCK TABLES `referrals` WRITE;
/*!40000 ALTER TABLE `referrals` DISABLE KEYS */;
/*!40000 ALTER TABLE `referrals` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `request_logs`
--

DROP TABLE IF EXISTS `request_logs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `request_logs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `request_id` bigint(20) unsigned NOT NULL,
  `user_id` bigint(20) unsigned DEFAULT NULL,
  `status` varchar(191) NOT NULL,
  `log_type` varchar(191) NOT NULL DEFAULT 'status_change',
  `note` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `request_logs_request_id_foreign` (`request_id`),
  KEY `request_logs_user_id_foreign` (`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `request_logs`
--

LOCK TABLES `request_logs` WRITE;
/*!40000 ALTER TABLE `request_logs` DISABLE KEYS */;
/*!40000 ALTER TABLE `request_logs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `service_bookings`
--

DROP TABLE IF EXISTS `service_bookings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `service_bookings` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned NOT NULL,
  `partner_id` bigint(20) unsigned NOT NULL,
  `partner_service_id` bigint(20) unsigned DEFAULT NULL,
  `event_date` date NOT NULL,
  `status` varchar(191) NOT NULL DEFAULT 'pending',
  `total_price` decimal(10,2) DEFAULT NULL,
  `notes` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `service_bookings_user_id_foreign` (`user_id`),
  KEY `service_bookings_partner_id_foreign` (`partner_id`),
  KEY `service_bookings_partner_service_id_foreign` (`partner_service_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `service_bookings`
--

LOCK TABLES `service_bookings` WRITE;
/*!40000 ALTER TABLE `service_bookings` DISABLE KEYS */;
/*!40000 ALTER TABLE `service_bookings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `service_payments`
--

DROP TABLE IF EXISTS `service_payments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `service_payments` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned NOT NULL,
  `request_id` bigint(20) unsigned DEFAULT NULL,
  `amount` decimal(10,2) NOT NULL,
  `type` enum('charge','payment','refund') NOT NULL DEFAULT 'charge',
  `description_ar` varchar(191) DEFAULT NULL,
  `description_en` varchar(191) DEFAULT NULL,
  `status` enum('pending','completed','failed') NOT NULL DEFAULT 'completed',
  `transaction_ref` varchar(191) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `service_payments_user_id_foreign` (`user_id`),
  KEY `service_payments_request_id_foreign` (`request_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `service_payments`
--

LOCK TABLES `service_payments` WRITE;
/*!40000 ALTER TABLE `service_payments` DISABLE KEYS */;
/*!40000 ALTER TABLE `service_payments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `service_requests`
--

DROP TABLE IF EXISTS `service_requests`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `service_requests` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `ref_number` varchar(191) NOT NULL,
  `user_id` bigint(20) unsigned NOT NULL,
  `gov_service_id` bigint(20) unsigned NOT NULL,
  `entity_id` bigint(20) unsigned NOT NULL,
  `client_name` varchar(191) NOT NULL,
  `client_email` varchar(191) NOT NULL,
  `client_phone` varchar(191) NOT NULL,
  `client_id_number` varchar(191) NOT NULL,
  `company_name` varchar(191) DEFAULT NULL,
  `company_cr` varchar(191) DEFAULT NULL,
  `notes` text DEFAULT NULL,
  `attachments` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`attachments`)),
  `price` decimal(10,2) NOT NULL DEFAULT 0.00,
  `status` enum('pending','processing','in_progress','done','rejected') NOT NULL DEFAULT 'pending',
  `reject_reason` text DEFAULT NULL,
  `estimated_completion` varchar(191) DEFAULT NULL,
  `completed_at` timestamp NULL DEFAULT NULL,
  `handled_by` bigint(20) unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `service_requests_ref_number_unique` (`ref_number`),
  KEY `service_requests_user_id_foreign` (`user_id`),
  KEY `service_requests_gov_service_id_foreign` (`gov_service_id`),
  KEY `service_requests_entity_id_foreign` (`entity_id`),
  KEY `service_requests_handled_by_foreign` (`handled_by`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `service_requests`
--

LOCK TABLES `service_requests` WRITE;
/*!40000 ALTER TABLE `service_requests` DISABLE KEYS */;
/*!40000 ALTER TABLE `service_requests` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sessions`
--

DROP TABLE IF EXISTS `sessions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sessions` (
  `id` varchar(191) NOT NULL,
  `user_id` bigint(20) unsigned DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sessions`
--

LOCK TABLES `sessions` WRITE;
/*!40000 ALTER TABLE `sessions` DISABLE KEYS */;
/*!40000 ALTER TABLE `sessions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) NOT NULL,
  `email` varchar(191) NOT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `country` varchar(80) DEFAULT NULL,
  `role` enum('user','owner','admin','supervisor','manager','agent','partner') NOT NULL DEFAULT 'user',
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
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

-- Dump completed on 2026-08-27 16:00:54
