-- MySQL dump 10.13  Distrib 9.7.0, for Linux (x86_64)
--
-- Host: localhost    Database: fns
-- ------------------------------------------------------
-- Server version	9.7.0

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
SET @MYSQLDUMP_TEMP_LOG_BIN = @@SESSION.SQL_LOG_BIN;
SET @@SESSION.SQL_LOG_BIN= 0;

--
-- GTID state at the beginning of the backup 
--

SET @@GLOBAL.GTID_PURGED=/*!80000 '+'*/ 'ac88fdf5-452d-11f1-8feb-f2b49d41cb40:1-1662';

--
-- Table structure for table `academic_income_defaults`
--

DROP TABLE IF EXISTS `academic_income_defaults`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `academic_income_defaults` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `section_code` char(3) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sort_order` int NOT NULL DEFAULT '0',
  `item_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `num_credits` int unsigned DEFAULT NULL,
  `rate_per_person` decimal(15,2) DEFAULT NULL,
  `nuol_percentage` decimal(5,4) NOT NULL DEFAULT '0.1700',
  `student_year` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=104 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `academic_income_defaults`
--

LOCK TABLES `academic_income_defaults` WRITE;
/*!40000 ALTER TABLE `academic_income_defaults` DISABLE KEYS */;
INSERT INTO `academic_income_defaults` VALUES (1,'1.1',0,'ປີ 2 ວິທະຍາສາດຄອມ',37,NULL,0.1700,'2'),(2,'1.1',1,'ປີ 2 ພັດທະນາໂປຣແກຣມ',37,NULL,0.1700,'2'),(3,'1.1',2,'ປີ 2 ພັດທະນາເວບໄຊ້',37,NULL,0.1700,'2'),(4,'1.1',3,'ປີ 2 ຕໍ່ເນື່ອງວິທະຍາສາດຄອມ',27,NULL,0.1700,'2'),(5,'1.1',4,'ປີ 2 ຄະນິດສາດນໍາໃຊ້',37,NULL,0.1700,'2'),(6,'1.1',5,'ປີ 2 ຄະນິດສາດສໍາຫຼັບເສດຖະສາດ',37,NULL,0.1700,'2'),(7,'1.1',6,'ປີ 2 ຄະນິດສາດສະຖິຕິ',37,NULL,0.1700,'2'),(8,'1.1',7,'ປີ 2 ຊີວະທົ່ວໄປ',31,NULL,0.1700,'2'),(9,'1.1',8,'ປີ 2 ເທັກໂນໂລຍີ່ຊີວະພາບ',31,NULL,0.1700,'2'),(10,'1.1',9,'ປີ 2 ເຄມີທົ່ວໄປ',35,NULL,0.1700,'2'),(11,'1.1',10,'ປີ 2 ເຄມີສິ່ງແວດລ້ອມ',35,NULL,0.1700,'2'),(12,'1.1',11,'ປີ 2 ຟີຊິກທົ່ວໄປ',36,NULL,0.1700,'2'),(13,'1.1',12,'ປີ 2 ທໍລະນີຟີຊິກ',36,NULL,0.1700,'2'),(14,'1.1',13,'ປີ 2 ວັດສະດຸສາດ',37,NULL,0.1700,'2'),(15,'1.1',14,'ປີ 2 ຟິຊິກນິວເຄຣຍ',36,NULL,0.1700,'2'),(16,'1.1',15,'ປີ 3 ວິທະຍາສາດຄອມ',33,NULL,0.1700,'3'),(17,'1.1',16,'ປີ 3 ພັດທະນາໂປຣແກຣມ',38,NULL,0.1700,'3'),(18,'1.1',17,'ປີ 3 ພັດທະນາເວບໄຊ້',42,NULL,0.1700,'3'),(19,'1.1',18,'ປີ 3 ຄະນິດທົ່ວໄປ',39,NULL,0.1700,'3'),(20,'1.1',19,'ປີ 3 ຄະນິດສາດສໍາຫຼັບເສດຖະສາດ',39,NULL,0.1700,'3'),(21,'1.1',20,'ປີ 3 ຄະນິດສາດສະຖິຕິ',37,NULL,0.1700,'3'),(22,'1.1',21,'ປີ 3 ຊີວະວິທະຍາທົ່ວໄປ',36,NULL,0.1700,'3'),(23,'1.1',22,'ປີ 3 ເທັກໂນໂລຍີ່ຊີວະພາບ',33,NULL,0.1700,'3'),(24,'1.1',23,'ປີ 3 ເຄມີສາດທົ່ວໄປ',35,NULL,0.1700,'3'),(25,'1.1',24,'ປີ 3 ເຄມີສິ່ງແວດລ້ອມ',36,NULL,0.1700,'3'),(26,'1.1',25,'ປີ 3 ຟີຊິກສາດທົ່ວໄປ',34,NULL,0.1700,'3'),(27,'1.1',26,'ປີ 3 ທໍລະນີຟີຊິກ',36,NULL,0.1700,'3'),(28,'1.1',27,'ປີ 3 ວັດສະດຸສາດ',36,NULL,0.1700,'3'),(29,'1.1',28,'ປີ 3 ຟິຊິກນິວເຄຣຍ',36,NULL,0.1700,'3'),(30,'1.1',29,'ປີ 4 ວິທະຍາສາດຄອມ',27,NULL,0.1700,'4'),(31,'1.1',30,'ປີ 4 ພັດທະນາໂປຣແກຣມ',30,NULL,0.1700,'4'),(32,'1.1',31,'ປີ 4 ພັດທະນາເວບໄຊ້',27,NULL,0.1700,'4'),(33,'1.1',32,'ປີ 4 ຄະນິດທົ່ວໄປ',24,NULL,0.1700,'4'),(34,'1.1',33,'ປີ 4 ຄະນິດສາດສໍາຫຼັບເສດຖະສາດ',27,NULL,0.1700,'4'),(35,'1.1',34,'ປີ 4 ຄະນິດສາດສະຖິຕິ',27,NULL,0.1700,'4'),(36,'1.1',35,'ປີ 4 ຊີວະວິທະຍາທົ່ວໄປ',25,NULL,0.1700,'4'),(37,'1.1',36,'ປີ 4 ເທັກໂນໂລຍີ່ຊີວະພາບ',23,NULL,0.1700,'4'),(38,'1.1',37,'ປີ 4 ເຄມີສາດທົ່ວໄປ',23,NULL,0.1700,'4'),(39,'1.1',38,'ປີ 4 ເຄມີສິ່ງແວດລ້ອມ',22,NULL,0.1700,'4'),(40,'1.1',39,'ປີ 4 ຟີຊິກສາດທົ່ວໄປ',27,NULL,0.1700,'4'),(41,'1.1',40,'ປີ 4 ທໍລະນີຟີຊິກ',30,NULL,0.1700,'4'),(42,'1.1',41,'ປີ 4 ວັດສະດຸສາດ',27,NULL,0.1700,'4'),(43,'1.1',42,'ປີ 4 ຟິຊິກນິວເຄຣຍ',28,NULL,0.1700,'4'),(44,'1.1',43,'ປະລິນຍາໂທຟິຊິກນໍາໃຊ້',NULL,NULL,0.1000,'masters_phd'),(45,'1.1',44,'ປະລິນຍາໂທຄະນິດສາດ',NULL,NULL,0.1000,'masters_phd'),(46,'1.1',45,'ປິລິນຍາໂທຊີວະວິທະຍາ',NULL,NULL,0.1000,'masters_phd'),(47,'1.1',46,'ປະລິນຍາໂທເຄມີ',NULL,NULL,0.1000,'masters_phd'),(48,'1.1',47,'ປະລິນຍາໂທວິທະຍາສາດຄອມ',NULL,NULL,0.1000,'masters_phd'),(49,'1.1',48,'ຟີຊິກສາດຮູບແບບຄົ້ນຄວ້າ',NULL,NULL,0.1000,'masters_phd'),(50,'1.1',49,'ເຄມີສາດຮູບແບບຄົ້ນຄວ້າ',NULL,NULL,0.1000,'masters_phd'),(51,'1.1',50,'ຊີວະວິທະຍາຮູບແບບຄົ້ນຄວ້າ',NULL,NULL,0.1000,'masters_phd'),(52,'1.1',51,'ປະລິນຍາເອກຟິຊິກ',NULL,NULL,0.1000,'masters_phd'),(53,'1.1',52,'ປະລິນຍາເອກຊີວະວິທະຍາ',NULL,NULL,0.1000,'masters_phd'),(54,'1.2',0,'ຄ່າທຳນຽມນັກສຶກສາລົງທະບຽນ',NULL,NULL,0.2500,NULL),(55,'1.2',1,'ຄ່າອະນາໄມຫ້ອງຮຽນ',NULL,NULL,0.0000,NULL),(56,'1.2',2,'ບຳລຸງອຸປະກອນການຮຽນ-ການສອນ',NULL,NULL,0.0000,NULL),(57,'1.2',3,'ບຳລຸງກິດຈະກຳນັກສຶກສາ',NULL,NULL,0.3000,NULL),(58,'1.2',4,'ບຳລຸງວິທະຍາເຂດ',NULL,NULL,0.4000,NULL),(59,'1.2',5,'ອຸດໜູນວຽກປ້ອງກັນ',NULL,NULL,0.0000,NULL),(60,'1.2',6,'ບຳລຸງຫ້ອງອ່ານ',NULL,NULL,0.0000,NULL),(61,'1.2',7,'ບຳລຸງຫ້ອງທົດລອງ',NULL,NULL,0.0000,NULL),(62,'1.2',8,'ບໍລິການສອບເສັງ',NULL,NULL,0.0000,NULL),(63,'1.2',9,'ບໍລິການການລົງທະບຽນລາຍວິຊາ',NULL,NULL,0.0000,NULL),(64,'1.3',0,'ວິທະຍາສາດຄອມພິວເຕີ ປີ 1',37,NULL,0.1700,'1'),(65,'1.3',1,'ການພັດທະນາໂປຣແກຣມ ປີ 1',38,NULL,0.1700,'1'),(66,'1.3',2,'ການພັດທະນາເວບໄຊ້ ປີ 1',38,NULL,0.1700,'1'),(67,'1.3',3,'ຕໍ່ເນື່ອງວິທະຍາສາດຄອມ ປີ 1',37,NULL,0.1700,'1'),(68,'1.3',4,'ຄະນິດສາດສົດ ປີ 1',37,NULL,0.1700,'1'),(69,'1.3',5,'ຄະນິດສາດສໍາຫຼັບເສດຖະສາດ ປີ 1',36,NULL,0.1700,'1'),(70,'1.3',6,'ຄະນິດສາດສະຖິຕິ ປີ 1',36,NULL,0.1700,'1'),(71,'1.3',7,'ຊີວະສາດທົ່ວໄປ ປີ 1',37,NULL,0.1700,'1'),(72,'1.3',8,'ເທັກໂນໂລຍີ່ຊີວະພາບ ປີ 1',37,NULL,0.1700,'1'),(73,'1.3',9,'ເຄມີທົ່ວໄປ ປີ 1',39,NULL,0.1700,'1'),(74,'1.3',10,'ເຄມີສິ່ງແວດລ້ອມ ປີ 1',39,NULL,0.1700,'1'),(75,'1.3',11,'ຟິຊິກທົ່ວໄປ ປີ 1',35,NULL,0.1700,'1'),(76,'1.3',12,'ທໍລະນີຟິຊິກ ປີ 1',35,NULL,0.1700,'1'),(77,'1.3',13,'ວັດສະດຸສາດ ປີ 1',35,NULL,0.1700,'1'),(78,'1.3',14,'ຟິຊິກນິວເຄຣຍ ປີ 1',35,NULL,0.1700,'1'),(79,'1.3',15,'ປະລິນຍາໂທຟິຊິກນໍາໃຊ້(ພະລັງງາທົດແທນ)',NULL,NULL,0.1000,'masters_phd'),(80,'1.3',16,'ປະລິນຍາໂທຄະນິດສາດ',NULL,NULL,0.1000,'masters_phd'),(81,'1.3',17,'ປິລິນຍາໂທຊີວະວິທະຍາ',NULL,NULL,0.1000,'masters_phd'),(82,'1.3',18,'ປະລິນຍາໂທເຄມີ',NULL,NULL,0.1000,'masters_phd'),(83,'1.3',19,'ປະລິນຍາໂທວິທະຍາສາດຄອມ',NULL,NULL,0.1000,'masters_phd'),(84,'1.3',20,'ຟີຊິກສາດຮູບແບບຄົ້ນຄວ້າ ປີ 1',NULL,NULL,0.1000,'masters_phd'),(85,'1.3',21,'ເຄມີສາດຮູບແບບຄົ້ນຄວ້າ ປີ 1',NULL,NULL,0.1000,'masters_phd'),(86,'1.3',22,'ຊີວະວິທະຍາຮູບແບບຄົ້ນຄວ້າ ປີ 1',NULL,NULL,0.1000,'masters_phd'),(87,'1.3',23,'ປະລິນຍາເອກຟິຊິກ',NULL,NULL,0.1000,'masters_phd'),(88,'1.3',24,'ປະລິນຍາເອກຊີວະວິທະຍາ',NULL,NULL,0.1000,'masters_phd'),(89,'1.4',0,'ຄ່າທຳນຽມລົງທະບຽນປະຈໍາປີ',NULL,NULL,1.0000,NULL),(90,'1.4',1,'ຄ່າຊຸດເອກະສານລົງທະບຽນ ນ/ສ ໃໝ່',NULL,NULL,1.0000,NULL),(91,'1.4',2,'ຄ່າອະນາໄມຫ້ອງຮຽນ',NULL,NULL,0.0000,NULL),(92,'1.4',3,'ບຳລຸງອຸປະກອນການຮຽນ-ການສອນ',NULL,NULL,0.0000,NULL),(93,'1.4',4,'ບຳລຸງກິດຈະກຳນັກສຶກສາ',NULL,NULL,0.3000,NULL),(94,'1.4',5,'ບຳລຸງວິທະຍາເຂດ',NULL,NULL,0.4000,NULL),(95,'1.4',6,'ອຸດໜູນວຽກປ້ອງກັນ',NULL,NULL,0.0000,NULL),(96,'1.4',7,'ບຳລຸງຫ້ອງອ່ານ',NULL,NULL,0.0000,NULL),(97,'1.4',8,'ບຳລຸງຫ້ອງທົດລອງ',NULL,NULL,0.0000,NULL),(98,'1.4',9,'ບໍລິການສອບເສັງ',NULL,NULL,0.0000,NULL),(99,'1.4',10,'ບໍລິການການລົງທະບຽນລາຍວິຊາ',NULL,NULL,0.0000,NULL),(100,'3.0',0,'ຄ່າລົງທະບຽນ ເທີມ 3',NULL,90000.00,0.0000,NULL),(101,'4.0',0,'ຄ່າບູລະນະຫ້ອງທົດລອງຄອມພິວເຕີ',NULL,50000.00,0.0000,NULL),(102,'5.0',0,'ຄ່າບຳລຸງອຸປະກອນຫ້ອງທົດລອງ',NULL,20000.00,0.0000,NULL),(103,'6.0',0,'ຄ່າບໍລິການວິຊາການ ແລະ ຄ່າບໍລິການອື່ນໆ',NULL,0.00,0.0000,NULL);
/*!40000 ALTER TABLE `academic_income_defaults` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `academic_income_items`
--

DROP TABLE IF EXISTS `academic_income_items`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `academic_income_items` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `plan_id` bigint unsigned NOT NULL,
  `section_code` char(3) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sort_order` int NOT NULL DEFAULT '0',
  `item_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `num_credits` int unsigned DEFAULT NULL,
  `rate_per_person` decimal(15,2) DEFAULT NULL,
  `num_persons` int unsigned NOT NULL DEFAULT '0',
  `nuol_percentage` decimal(5,4) NOT NULL DEFAULT '0.1700',
  `student_year` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `academic_income_items_plan_id_foreign` (`plan_id`),
  CONSTRAINT `academic_income_items_plan_id_foreign` FOREIGN KEY (`plan_id`) REFERENCES `academic_income_plans` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=401 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `academic_income_items`
--

LOCK TABLES `academic_income_items` WRITE;
/*!40000 ALTER TABLE `academic_income_items` DISABLE KEYS */;
INSERT INTO `academic_income_items` VALUES (298,2,'1.1',0,'ປີ 2 ວິທະຍາສາດຄອມ',37,NULL,60,0.1700,'2'),(299,2,'1.1',1,'ປີ 2 ພັດທະນາໂປຣແກຣມ',37,NULL,70,0.1700,'2'),(300,2,'1.1',2,'ປີ 2 ພັດທະນາເວບໄຊ້',37,NULL,60,0.1700,'2'),(301,2,'1.1',3,'ປີ 2 ຕໍ່ເນື່ອງວິທະຍາສາດຄອມ',27,NULL,8,0.1700,'2'),(302,2,'1.1',4,'ປີ 2 ຄະນິດສາດນໍາໃຊ້',37,NULL,0,0.1700,'2'),(303,2,'1.1',5,'ປີ 2 ຄະນິດສາດສໍາຫຼັບເສດຖະສາດ',37,NULL,6,0.1700,'2'),(304,2,'1.1',6,'ປີ 2 ຄະນິດສາດສະຖິຕິ',37,NULL,0,0.1700,'2'),(305,2,'1.1',7,'ປີ 2 ຊີວະທົ່ວໄປ',31,NULL,0,0.1700,'2'),(306,2,'1.1',8,'ປີ 2 ເທັກໂນໂລຍີ່ຊີວະພາບ',31,NULL,0,0.1700,'2'),(307,2,'1.1',9,'ປີ 2 ເຄມີທົ່ວໄປ',35,NULL,7,0.1700,'2'),(308,2,'1.1',10,'ປີ 2 ເຄມີສິ່ງແວດລ້ອມ',35,NULL,6,0.1700,'2'),(309,2,'1.1',11,'ປີ 2 ຟີຊິກທົ່ວໄປ',36,NULL,0,0.1700,'2'),(310,2,'1.1',12,'ປີ 2 ທໍລະນີຟີຊິກ',36,NULL,0,0.1700,'2'),(311,2,'1.1',13,'ປີ 2 ວັດສະດຸສາດ',37,NULL,0,0.1700,'2'),(312,2,'1.1',14,'ປີ 2 ຟິຊິກນິວເຄຣຍ',36,NULL,0,0.1700,'2'),(313,2,'1.1',15,'ປີ 3 ວິທະຍາສາດຄອມ',33,NULL,60,0.1700,'3'),(314,2,'1.1',16,'ປີ 3 ພັດທະນາໂປຣແກຣມ',38,NULL,35,0.1700,'3'),(315,2,'1.1',17,'ປີ 3 ພັດທະນາເວບໄຊ້',42,NULL,45,0.1700,'3'),(316,2,'1.1',18,'ປີ 3 ຄະນິດທົ່ວໄປ',39,NULL,1,0.1700,'3'),(317,2,'1.1',19,'ປີ 3 ຄະນິດສາດສໍາຫຼັບເສດຖະສາດ',39,NULL,12,0.1700,'3'),(318,2,'1.1',20,'ປີ 3 ຄະນິດສາດສະຖິຕິ',37,NULL,0,0.1700,'3'),(319,2,'1.1',21,'ປີ 3 ຊີວະວິທະຍາທົ່ວໄປ',36,NULL,1,0.1700,'3'),(320,2,'1.1',22,'ປີ 3 ເທັກໂນໂລຍີ່ຊີວະພາບ',33,NULL,0,0.1700,'3'),(321,2,'1.1',23,'ປີ 3 ເຄມີສາດທົ່ວໄປ',35,NULL,5,0.1700,'3'),(322,2,'1.1',24,'ປີ 3 ເຄມີສິ່ງແວດລ້ອມ',36,NULL,3,0.1700,'3'),(323,2,'1.1',25,'ປີ 3 ຟີຊິກສາດທົ່ວໄປ',34,NULL,0,0.1700,'3'),(324,2,'1.1',26,'ປີ 3 ທໍລະນີຟີຊິກ',36,NULL,0,0.1700,'3'),(325,2,'1.1',27,'ປີ 3 ວັດສະດຸສາດ',36,NULL,0,0.1700,'3'),(326,2,'1.1',28,'ປີ 3 ຟິຊິກນິວເຄຣຍ',36,NULL,0,0.1700,'3'),(327,2,'1.1',29,'ປີ 4 ວິທະຍາສາດຄອມ',27,NULL,55,0.1700,'4'),(328,2,'1.1',30,'ປີ 4 ພັດທະນາໂປຣແກຣມ',30,NULL,30,0.1700,'4'),(329,2,'1.1',31,'ປີ 4 ພັດທະນາເວບໄຊ້',27,NULL,40,0.1700,'4'),(330,2,'1.1',32,'ປີ 4 ຄະນິດທົ່ວໄປ',24,NULL,2,0.1700,'4'),(331,2,'1.1',33,'ປີ 4 ຄະນິດສາດສໍາຫຼັບເສດຖະສາດ',27,NULL,21,0.1700,'4'),(332,2,'1.1',34,'ປີ 4 ຄະນິດສາດສະຖິຕິ',27,NULL,11,0.1700,'4'),(333,2,'1.1',35,'ປີ 4 ຊີວະວິທະຍາທົ່ວໄປ',25,NULL,3,0.1700,'4'),(334,2,'1.1',36,'ປີ 4 ເທັກໂນໂລຍີ່ຊີວະພາບ',23,NULL,3,0.1700,'4'),(335,2,'1.1',37,'ປີ 4 ເຄມີສາດທົ່ວໄປ',23,NULL,16,0.1700,'4'),(336,2,'1.1',38,'ປີ 4 ເຄມີສິ່ງແວດລ້ອມ',22,NULL,5,0.1700,'4'),(337,2,'1.1',39,'ປີ 4 ຟີຊິກສາດທົ່ວໄປ',27,NULL,2,0.1700,'4'),(338,2,'1.1',40,'ປີ 4 ທໍລະນີຟີຊິກ',30,NULL,0,0.1700,'4'),(339,2,'1.1',41,'ປີ 4 ວັດສະດຸສາດ',27,NULL,0,0.1700,'4'),(340,2,'1.1',42,'ປີ 4 ຟິຊິກນິວເຄຣຍ',28,NULL,1,0.1700,'4'),(341,2,'1.1',43,'ປະລິນຍາໂທຟິຊິກນໍາໃຊ້',NULL,10800000.00,0,0.1000,'masters_phd'),(342,2,'1.1',44,'ປະລິນຍາໂທຄະນິດສາດ',NULL,11040000.00,0,0.1000,'masters_phd'),(343,2,'1.1',45,'ປິລິນຍາໂທຊີວະວິທະຍາ',NULL,9840000.00,0,0.1000,'masters_phd'),(344,2,'1.1',46,'ປະລິນຍາໂທເຄມີ',NULL,11040000.00,0,0.1000,'masters_phd'),(345,2,'1.1',47,'ປະລິນຍາໂທວິທະຍາສາດຄອມ',NULL,11040000.00,3,0.1000,'masters_phd'),(346,2,'1.1',48,'ຟີຊິກສາດຮູບແບບຄົ້ນຄວ້າ',NULL,11040000.00,3,0.1000,'masters_phd'),(347,2,'1.1',49,'ເຄມີສາດຮູບແບບຄົ້ນຄວ້າ',NULL,11040000.00,7,0.1000,'masters_phd'),(348,2,'1.1',50,'ຊີວະວິທະຍາຮູບແບບຄົ້ນຄວ້າ',NULL,11040000.00,3,0.1000,'masters_phd'),(349,2,'1.1',51,'ປະລິນຍາເອກຟິຊິກ',NULL,22800000.00,0,0.1000,'masters_phd'),(350,2,'1.1',52,'ປະລິນຍາເອກຊີວະວິທະຍາ',NULL,24000000.00,0,0.1000,'masters_phd'),(351,2,'1.2',0,'ຄ່າທຳນຽມນັກສຶກສາລົງທະບຽນ',NULL,10000.00,705,0.2500,NULL),(352,2,'1.2',1,'ຄ່າອະນາໄມຫ້ອງຮຽນ',NULL,25000.00,705,0.0000,NULL),(353,2,'1.2',2,'ບຳລຸງອຸປະກອນການຮຽນ-ການສອນ',NULL,20000.00,705,0.0000,NULL),(354,2,'1.2',3,'ບຳລຸງກິດຈະກຳນັກສຶກສາ',NULL,30000.00,705,0.3000,NULL),(355,2,'1.2',4,'ບຳລຸງວິທະຍາເຂດ',NULL,30000.00,705,0.4000,NULL),(356,2,'1.2',5,'ອຸດໜູນວຽກປ້ອງກັນ',NULL,20000.00,705,0.0000,NULL),(357,2,'1.2',6,'ບຳລຸງຫ້ອງອ່ານ',NULL,30000.00,705,0.0000,NULL),(358,2,'1.2',7,'ບຳລຸງຫ້ອງທົດລອງ',NULL,15000.00,705,0.0000,NULL),(359,2,'1.2',8,'ບໍລິການສອບເສັງ',NULL,25000.00,705,0.0000,NULL),(360,2,'1.2',9,'ບໍລິການການລົງທະບຽນລາຍວິຊາ',NULL,5000.00,705,0.0000,NULL),(361,2,'1.3',0,'ວິທະຍາສາດຄອມພິວເຕີ ປີ 1',37,NULL,60,0.1700,'1'),(362,2,'1.3',1,'ການພັດທະນາໂປຣແກຣມ ປີ 1',38,NULL,60,0.1700,'1'),(363,2,'1.3',2,'ການພັດທະນາເວບໄຊ້ ປີ 1',38,NULL,60,0.1700,'1'),(364,2,'1.3',3,'ຕໍ່ເນື່ອງວິທະຍາສາດຄອມ ປີ 1',37,NULL,10,0.1700,'1'),(365,2,'1.3',4,'ຄະນິດສາດສົດ ປີ 1',37,NULL,10,0.1700,'1'),(366,2,'1.3',5,'ຄະນິດສາດສໍາຫຼັບເສດຖະສາດ ປີ 1',36,NULL,20,0.1700,'1'),(367,2,'1.3',6,'ຄະນິດສາດສະຖິຕິ ປີ 1',36,NULL,0,0.1700,'1'),(368,2,'1.3',7,'ຊີວະສາດທົ່ວໄປ ປີ 1',37,NULL,5,0.1700,'1'),(369,2,'1.3',8,'ເທັກໂນໂລຍີ່ຊີວະພາບ ປີ 1',37,NULL,5,0.1700,'1'),(370,2,'1.3',9,'ເຄມີທົ່ວໄປ ປີ 1',39,NULL,10,0.1700,'1'),(371,2,'1.3',10,'ເຄມີສິ່ງແວດລ້ອມ ປີ 1',39,NULL,10,0.1700,'1'),(372,2,'1.3',11,'ຟິຊິກທົ່ວໄປ ປີ 1',35,NULL,1,0.1700,'1'),(373,2,'1.3',12,'ທໍລະນີຟິຊິກ ປີ 1',35,NULL,1,0.1700,'1'),(374,2,'1.3',13,'ວັດສະດຸສາດ ປີ 1',35,NULL,1,0.1700,'1'),(375,2,'1.3',14,'ຟິຊິກນິວເຄຣຍ ປີ 1',35,NULL,1,0.1700,'1'),(376,2,'1.3',15,'ປະລິນຍາໂທຟິຊິກນໍາໃຊ້(ພະລັງງາທົດແທນ)',NULL,15840000.00,4,0.1000,'masters_phd'),(377,2,'1.3',16,'ປະລິນຍາໂທຄະນິດສາດ',NULL,16560000.00,4,0.1000,'masters_phd'),(378,2,'1.3',17,'ປິລິນຍາໂທຊີວະວິທະຍາ',NULL,14760000.00,0,0.1000,'masters_phd'),(379,2,'1.3',18,'ປະລິນຍາໂທເຄມີ',NULL,16560000.00,0,0.1000,'masters_phd'),(380,2,'1.3',19,'ປະລິນຍາໂທວິທະຍາສາດຄອມ',NULL,16560000.00,5,0.1000,'masters_phd'),(381,2,'1.3',20,'ຟີຊິກສາດຮູບແບບຄົ້ນຄວ້າ ປີ 1',NULL,16560000.00,4,0.1000,'masters_phd'),(382,2,'1.3',21,'ເຄມີສາດຮູບແບບຄົ້ນຄວ້າ ປີ 1',NULL,16560000.00,5,0.1000,'masters_phd'),(383,2,'1.3',22,'ຊີວະວິທະຍາຮູບແບບຄົ້ນຄວ້າ ປີ 1',NULL,16560000.00,4,0.1000,'masters_phd'),(384,2,'1.3',23,'ປະລິນຍາເອກຟິຊິກ',NULL,34200000.00,0,0.1000,'masters_phd'),(385,2,'1.3',24,'ປະລິນຍາເອກຊີວະວິທະຍາ',NULL,36000000.00,0,0.1000,'masters_phd'),(386,2,'1.4',0,'ຄ່າທຳນຽມລົງທະບຽນປະຈໍາປີ',NULL,15000.00,324,1.0000,NULL),(387,2,'1.4',1,'ຄ່າຊຸດເອກະສານລົງທະບຽນ ນ/ສ ໃໝ່',NULL,15000.00,324,1.0000,NULL),(388,2,'1.4',2,'ຄ່າອະນາໄມຫ້ອງຮຽນ',NULL,25000.00,324,0.0000,NULL),(389,2,'1.4',3,'ບຳລຸງອຸປະກອນການຮຽນ-ການສອນ',NULL,20000.00,324,0.0000,NULL),(390,2,'1.4',4,'ບຳລຸງກິດຈະກຳນັກສຶກສາ',NULL,30000.00,324,0.3000,NULL),(391,2,'1.4',5,'ບຳລຸງວິທະຍາເຂດ',NULL,30000.00,324,0.4000,NULL),(392,2,'1.4',6,'ອຸດໜູນວຽກປ້ອງກັນ',NULL,20000.00,324,0.0000,NULL),(393,2,'1.4',7,'ບຳລຸງຫ້ອງອ່ານ',NULL,10000.00,324,0.0000,NULL),(394,2,'1.4',8,'ບຳລຸງຫ້ອງທົດລອງ',NULL,15000.00,324,0.0000,NULL),(395,2,'1.4',9,'ບໍລິການສອບເສັງ',NULL,25000.00,324,0.0000,NULL),(396,2,'1.4',10,'ບໍລິການການລົງທະບຽນລາຍວິຊາ',NULL,5000.00,324,0.0000,NULL),(397,2,'3.0',0,'ຄ່າລົງທະບຽນ ເທີມ 3',NULL,90000.00,0,0.0000,NULL),(398,2,'4.0',0,'ຄ່າບູລະນະຫ້ອງທົດລອງຄອມພິວເຕີ',NULL,50000.00,1029,0.0000,NULL),(399,2,'5.0',0,'ຄ່າບຳລຸງອຸປະກອນຫ້ອງທົດລອງ',NULL,20000.00,1029,0.0000,NULL),(400,2,'6.0',0,'ຄ່າບໍລິການວິຊາການ ແລະ ຄ່າບໍລິການອື່ນໆ',NULL,0.00,0,0.0000,NULL);
/*!40000 ALTER TABLE `academic_income_items` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `academic_income_plans`
--

DROP TABLE IF EXISTS `academic_income_plans`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `academic_income_plans` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `fiscal_year` smallint unsigned NOT NULL,
  `status` enum('DRAFT','APPROVED') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'DRAFT',
  `created_by` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `academic_income_plans_fiscal_year_unique` (`fiscal_year`),
  KEY `academic_income_plans_created_by_foreign` (`created_by`),
  CONSTRAINT `academic_income_plans_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `academic_income_plans`
--

LOCK TABLES `academic_income_plans` WRITE;
/*!40000 ALTER TABLE `academic_income_plans` DISABLE KEYS */;
INSERT INTO `academic_income_plans` VALUES (2,2027,'DRAFT',2,'2026-05-08 18:35:17','2026-05-10 08:04:47');
/*!40000 ALTER TABLE `academic_income_plans` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `advance_clearing_attachments`
--

DROP TABLE IF EXISTS `advance_clearing_attachments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `advance_clearing_attachments` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `advance_request_id` bigint unsigned NOT NULL,
  `original_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `stored_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `mime_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `file_size` bigint unsigned DEFAULT NULL,
  `uploaded_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `advance_clearing_attachments`
--

LOCK TABLES `advance_clearing_attachments` WRITE;
/*!40000 ALTER TABLE `advance_clearing_attachments` DISABLE KEYS */;
/*!40000 ALTER TABLE `advance_clearing_attachments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `advance_clearing_items`
--

DROP TABLE IF EXISTS `advance_clearing_items`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `advance_clearing_items` (
  `id` int NOT NULL AUTO_INCREMENT,
  `advance_request_id` int NOT NULL,
  `description` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount` decimal(15,2) NOT NULL,
  `account_id` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `advance_request_id` (`advance_request_id`),
  KEY `account_id` (`account_id`),
  CONSTRAINT `advance_clearing_items_ibfk_1` FOREIGN KEY (`advance_request_id`) REFERENCES `advance_requests` (`id`) ON DELETE CASCADE,
  CONSTRAINT `advance_clearing_items_ibfk_2` FOREIGN KEY (`account_id`) REFERENCES `chart_of_accounts` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `advance_clearing_items`
--

LOCK TABLES `advance_clearing_items` WRITE;
/*!40000 ALTER TABLE `advance_clearing_items` DISABLE KEYS */;
/*!40000 ALTER TABLE `advance_clearing_items` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `advance_requests`
--

DROP TABLE IF EXISTS `advance_requests`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `advance_requests` (
  `id` int NOT NULL AUTO_INCREMENT,
  `requester_id` int NOT NULL,
  `department_id` int NOT NULL,
  `request_date` date NOT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `requested_amount` decimal(15,2) NOT NULL,
  `status` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payment_transaction_id` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `requester_id` (`requester_id`),
  KEY `department_id` (`department_id`),
  KEY `payment_transaction_id` (`payment_transaction_id`),
  KEY `idx_advance_requests_status` (`status`),
  CONSTRAINT `advance_requests_ibfk_1` FOREIGN KEY (`requester_id`) REFERENCES `users` (`id`),
  CONSTRAINT `advance_requests_ibfk_2` FOREIGN KEY (`department_id`) REFERENCES `departments` (`id`),
  CONSTRAINT `advance_requests_ibfk_3` FOREIGN KEY (`payment_transaction_id`) REFERENCES `transactions` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `advance_requests`
--

LOCK TABLES `advance_requests` WRITE;
/*!40000 ALTER TABLE `advance_requests` DISABLE KEYS */;
/*!40000 ALTER TABLE `advance_requests` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `app_settings`
--

DROP TABLE IF EXISTS `app_settings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `app_settings` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `key` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `app_settings_key_unique` (`key`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `app_settings`
--

LOCK TABLES `app_settings` WRITE;
/*!40000 ALTER TABLE `app_settings` DISABLE KEYS */;
INSERT INTO `app_settings` VALUES (1,'price_per_credit','35000','2026-05-08 18:00:09','2026-05-08 18:00:09'),(2,'teaching_rate_bachelor','0.4','2026-05-08 18:00:09','2026-05-10 10:18:15'),(3,'teaching_rate_masters_phd','0.60','2026-05-08 18:00:09','2026-05-08 18:00:09');
/*!40000 ALTER TABLE `app_settings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `budget_line_items`
--

DROP TABLE IF EXISTS `budget_line_items`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `budget_line_items` (
  `id` int NOT NULL AUTO_INCREMENT,
  `budget_plan_id` int NOT NULL,
  `account_id` int NOT NULL,
  `amount_regular` decimal(15,2) DEFAULT NULL,
  `amount_academic` decimal(15,2) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `budget_plan_id` (`budget_plan_id`),
  KEY `account_id` (`account_id`),
  CONSTRAINT `budget_line_items_ibfk_1` FOREIGN KEY (`budget_plan_id`) REFERENCES `budget_plans` (`id`) ON DELETE CASCADE,
  CONSTRAINT `budget_line_items_ibfk_2` FOREIGN KEY (`account_id`) REFERENCES `chart_of_accounts` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=130 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `budget_line_items`
--

LOCK TABLES `budget_line_items` WRITE;
/*!40000 ALTER TABLE `budget_line_items` DISABLE KEYS */;
INSERT INTO `budget_line_items` VALUES (79,16,34,2996595000.00,0.00),(80,16,82,0.00,0.00),(81,16,75,80160000.00,0.00),(82,16,43,621748260.00,0.00),(83,16,71,34856640.00,0.00),(84,16,37,12190200.00,0.00),(85,16,88,0.00,0.00),(86,16,76,0.00,0.00),(87,16,72,4939200.00,0.00),(88,16,44,285221160.00,0.00),(89,16,49,112620000.00,0.00),(90,16,77,0.00,0.00),(91,16,38,0.00,0.00),(92,16,91,0.00,0.00),(93,16,50,13227648.00,0.00),(94,16,78,0.00,0.00),(95,16,39,146646180.00,0.00),(96,16,51,90000000.00,0.00),(97,16,40,0.00,0.00),(98,16,79,0.00,0.00),(99,16,52,0.00,0.00),(100,16,41,0.00,0.00),(101,16,80,57840000.00,0.00),(102,16,138,0.00,116999996.04),(103,16,136,0.00,198000000.00),(104,16,137,0.00,6699999.96),(105,16,147,0.00,4100000.04),(106,16,200,0.00,5000000.00),(107,16,163,0.00,5040000.00),(108,16,175,0.00,866290491.96),(109,16,193,0.00,25000020.00),(110,16,164,0.00,12600000.00),(111,16,123,0.00,19000000.04),(112,16,165,0.00,0.00),(113,16,160,0.00,16000000.00),(114,16,198,0.00,19734000.00),(115,16,151,0.00,360000.00),(116,16,114,0.00,0.00),(117,16,116,0.00,33600000.00),(118,16,117,0.00,3000000.00),(119,16,118,0.00,0.00),(120,16,167,0.00,9600000.00),(121,16,150,0.00,0.00),(122,16,153,0.00,360000.00),(123,16,169,0.00,4800000.00),(124,16,170,0.00,6000000.00),(125,16,155,0.00,0.00),(126,16,232,0.00,0.00),(127,16,231,0.00,509000000.00),(128,16,161,0.00,0.00),(129,16,121,0.00,18000000.00);
/*!40000 ALTER TABLE `budget_line_items` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `budget_period_allocations`
--

DROP TABLE IF EXISTS `budget_period_allocations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `budget_period_allocations` (
  `id` int NOT NULL AUTO_INCREMENT,
  `budget_line_item_id` int NOT NULL,
  `period_name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `allocated_amount` decimal(15,2) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `budget_line_item_id` (`budget_line_item_id`),
  CONSTRAINT `budget_period_allocations_ibfk_1` FOREIGN KEY (`budget_line_item_id`) REFERENCES `budget_line_items` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=79 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `budget_period_allocations`
--

LOCK TABLES `budget_period_allocations` WRITE;
/*!40000 ALTER TABLE `budget_period_allocations` DISABLE KEYS */;
/*!40000 ALTER TABLE `budget_period_allocations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `budget_plan_comments`
--

DROP TABLE IF EXISTS `budget_plan_comments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `budget_plan_comments` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `budget_plan_id` bigint unsigned NOT NULL,
  `user_id` bigint unsigned NOT NULL,
  `comment` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `submission_round` int NOT NULL DEFAULT '1',
  `marked_at` datetime DEFAULT NULL,
  `marked_by` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `budget_plan_comments`
--

LOCK TABLES `budget_plan_comments` WRITE;
/*!40000 ALTER TABLE `budget_plan_comments` DISABLE KEYS */;
INSERT INTO `budget_plan_comments` VALUES (3,8,8,'nc','2026-04-11 08:51:06','2026-04-12 14:00:43',1,'2026-04-12 14:00:43',2),(4,8,8,'test','2026-04-11 09:19:03','2026-04-12 14:00:41',1,'2026-04-12 14:00:41',2),(5,8,8,'123','2026-04-11 09:39:53','2026-04-12 14:00:40',1,'2026-04-12 14:00:40',2),(6,8,6,'test','2026-04-11 09:56:51','2026-04-11 09:58:31',1,'2026-04-11 09:58:31',2),(7,10,6,'ok','2026-04-12 17:00:50','2026-04-12 17:00:50',1,NULL,NULL);
/*!40000 ALTER TABLE `budget_plan_comments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `budget_plan_reviewers`
--

DROP TABLE IF EXISTS `budget_plan_reviewers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `budget_plan_reviewers` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `budget_plan_id` bigint unsigned NOT NULL,
  `user_id` bigint unsigned NOT NULL,
  `assigned_by` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `bpr_plan_user_unique` (`budget_plan_id`,`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `budget_plan_reviewers`
--

LOCK TABLES `budget_plan_reviewers` WRITE;
/*!40000 ALTER TABLE `budget_plan_reviewers` DISABLE KEYS */;
INSERT INTO `budget_plan_reviewers` VALUES (15,7,8,2,'2026-04-11 07:22:37','2026-04-11 07:22:37'),(16,8,8,2,'2026-04-11 08:50:17','2026-04-11 08:50:17'),(17,9,5,2,'2026-04-12 16:55:43','2026-04-12 16:55:43'),(18,10,3,2,'2026-04-12 17:00:22','2026-04-12 17:00:22'),(19,11,3,2,'2026-04-13 07:29:16','2026-04-13 07:29:16'),(20,11,8,2,'2026-04-13 07:29:16','2026-04-13 07:29:16'),(21,12,3,2,'2026-04-13 11:46:27','2026-04-13 11:46:27');
/*!40000 ALTER TABLE `budget_plan_reviewers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `budget_plans`
--

DROP TABLE IF EXISTS `budget_plans`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `budget_plans` (
  `id` int NOT NULL AUTO_INCREMENT,
  `fiscal_year` int NOT NULL,
  `status` enum('DRAFT','PENDING_REVIEW','MODIFYING','PENDING_FINAL_APPROVAL','APPROVED') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'DRAFT',
  `version` int NOT NULL DEFAULT '1',
  `created_by` int NOT NULL,
  `submission_round` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `created_by` (`created_by`),
  CONSTRAINT `budget_plans_ibfk_1` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `budget_plans`
--

LOCK TABLES `budget_plans` WRITE;
/*!40000 ALTER TABLE `budget_plans` DISABLE KEYS */;
INSERT INTO `budget_plans` VALUES (16,2027,'DRAFT',1,2,0);
/*!40000 ALTER TABLE `budget_plans` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cache`
--

DROP TABLE IF EXISTS `cache`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cache` (
  `key` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
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
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cache_locks` (
  `key` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cache_locks`
--

LOCK TABLES `cache_locks` WRITE;
/*!40000 ALTER TABLE `cache_locks` DISABLE KEYS */;
/*!40000 ALTER TABLE `cache_locks` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `chart_of_accounts`
--

DROP TABLE IF EXISTS `chart_of_accounts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `chart_of_accounts` (
  `id` int NOT NULL AUTO_INCREMENT,
  `account_code` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `account_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `parent_id` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `account_code` (`account_code`),
  KEY `parent_id` (`parent_id`),
  CONSTRAINT `chart_of_accounts_ibfk_1` FOREIGN KEY (`parent_id`) REFERENCES `chart_of_accounts` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=302 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `chart_of_accounts`
--

LOCK TABLES `chart_of_accounts` WRITE;
/*!40000 ALTER TABLE `chart_of_accounts` DISABLE KEYS */;
INSERT INTO `chart_of_accounts` VALUES (32,'60000000','ເງິນ-ເດືອນ ແລະ ເງິນອຸດໜູນ ຂອງພະນັກງານ-ລັດຖະກອນ',NULL),(33,'60100000','ເງິນເດືອນພືນຖານ',32),(34,'60100100','ພະນັກງານ ພວມປະຕິບັດງານ',33),(35,'60100101','ພະນັກງານ ສົມບູນ',34),(36,'60100102','ພະນັກງານ ຝຶກງານ',34),(37,'60100200','ພະນັກງານ ເພື່ອການເລື່ອນຊັ້ນ ແລະ ເລື່ອນຂັ້ນ',33),(38,'60100300','ພະນັກງານ ເຂົາການໃໝ່',33),(39,'60100400','ພະນັກງານ ຮຽນຢູ່ພາຍໃນປະເທດ',33),(40,'60100500','ພະນັກງານ ຮຽນຢູ່ຕ່າງປະເທດ',33),(41,'60100600','ພະນັກງານ ຕາມສັນຍາ',33),(42,'60200000','ເງິນອຸດໜູນ ປົກກະຕິ',32),(43,'60200100','ອຸດໜູນ ຕຳແໜ່ງງານ',42),(44,'60200200','ອຸດໜູນ ວິຊາຊີບ',42),(45,'60200201','ອຸດໜູນ ວິຊາຊີບຄູ  ( ເພີ່ມໃໝ່ )',44),(46,'60200202','ອຸດໜູນ ວິຊາຊີບສາທາ  ( ເພີ່ມໃໝ່ )',44),(47,'60200203','ອຸດໜູນ ສະມາຊິກສະພາ   ( ເພີ່ມໃໝ່ )',44),(48,'60200204','ອຸດໜູນ ວິຊາຊີບອື່ນ ( ເພີ່ມໃໝ່ )',44),(49,'60200300','ອຸດໜູນ ອາຍຸການ',42),(50,'60200400','ອຸດໜູນ ວຽກໜັກ ແລະ ທາດເບື່ອ',42),(51,'60200500','ອຸດໜູນ ເຂດຫຍຸ້ງຍາກ ແລະ ທຸລະກັນດານ',42),(52,'60200600','ອຸດໜູນ ຄູສອນຫ້ອງຄວບ',42),(53,'60200700','ອຸດໜູນ ຄ່າຄອງຊີບ',42),(54,'60200701','ອຸດໜູນ ຄ່າຄອງຊີບການນຳ ( ເພີ່ມໃໝ່)',53),(55,'60200702','ອຸດໜູນ ຄ່າຄອງຊີບພະນັກງານ-ລັດຖະກອນ ( ເພີ່ມໃໝ່ )',53),(56,'60200703','ອຸດໜູນ ຄ່າຄອງຊີບການທູດຢູ່ຕ່າງປະເທດ ( ເພີ່ມໃໝ່ )',53),(57,'60200800','ອຸດໜູນວິຊາການຄູ ( ເພີ່ມໃໝ່ )',42),(58,'60300000','ເງິນປະກັນສັງຄົມ ( ລັດຈ່າຍເພີ່ມ )',32),(59,'61000000','ເງິນນະໂຍບາຍ ແລະ ເງິນຊ່ວຍໜູນ ຕ່າງໆ',NULL),(60,'61100000','ເງິນນະໂຍບາຍຕ່າງໆ',59),(61,'61100200','ຮອງເລຂາຄະນະພັກກຸ່ມບ້ານ ຫລື ບ້ານໃຫຍ່',59),(62,'61100300','ເລຂາໜ່ວຍພັກ ທັງເປັນນາຍບ້ານ',59),(63,'61100400','ກຳມະການຄະນະພັກກຸ່ມບ້ານ, ຮອງເລຂາໜ່ວຍພັກ ທັງເປັນນາຍບ້ານ',59),(64,'61100500','ເລຂາໜ່ວຍພັກບ້ານ, ກຳມະການໜ່ວຍພັກ ທັງເປັນນາຍບ້ານ',59),(65,'61100600','ນາຍບ້ານ, ຮອງເລຂາໜ່ວຍພັກບ້ານ, ກຳມະການໜ່ວຍພັກ',59),(66,'61100700','ກຳມະການໜ່ວຍພັກ, ຮອງນາຍບ້ານ',59),(67,'61100800','ເງິນນະໂຍບາຍ ອາສາສະໝັກ',59),(68,'61100900','ເງິນນະໂຍບາຍ ພະສົງ',59),(69,'61101000','ເງິນນະໂຍບາຍ ໃຫ້ພະນັກງານໄປຄົນຄ້ວາຢູ່ຕ່າງປະເທດ',59),(70,'61200000','ເງິນນະໂຍບາຍ ຄອບຄົວ',59),(71,'61200100','ລູກພະນັກງານ',70),(72,'61200200','ເມຍພະນັກງານ',70),(73,'61300000','ກ່ອນຮັບບຳນານ',59),(74,'61400000','ເງິນອຸດໜູນເຮັດວຽກເພີ່ມ',59),(75,'61400100','ເຮັດວຽກນອກໂມງລັດຖະການ',74),(76,'61400200','ແປພາສາ',74),(77,'61400300','ຄົນຄ້ວາ ແລະ ວິໄຈ',74),(78,'61400400','ຂຽນບົດ ແລະ ຮຽບຮຽງ',74),(79,'61400500','ສອນພິເສດ',74),(80,'61400600','ເວນຍາມ',74),(81,'61500000','ເງິນເບັ້ຍລ້ຽງຕ່າງໆ',59),(82,'61500100','ເບ້ຍລ້ຽງນັກຮຽນພາຍໃນປະເທດ',81),(83,'61500101','ນັກຮຽນສາມັນ',82),(84,'61500102','ຊັ້ນຕົນ',82),(85,'61500103','ຊັ້ນກາງ',82),(86,'61500104','ຊັ້ນສູງ, ປະລິນຍາຕີ ແລະ ເໜືອມະຫາວິທະຍາໄລ',82),(87,'61500105','ເດັກກຳພ້າ, ເດັກຊົນເຜົາ ແລະ ເດັກເສຍອົງຄະ',82),(88,'61500200','ເບ້ຍລ້ຽງນັກຮຽນຕ່າງປະເທດຢູ່ລາວ',81),(89,'61500201','ອັດຕາກິນ',88),(90,'61500202','ຄ່າເດີນທາງ',88),(91,'61500300','ເບ້ຍລ້ຽງນັກຮຽນພາຍໃນໄປຝຶກງານ',81),(92,'61500301','ອັດຕາກິນ',91),(93,'61500302','ຄ່າເດີນທາງ',91),(94,'61500400','ເບ້ຍລ້ຽງນັກຮຽນຕ່າງປະເທດຝຶກງານຢູ່ລາວ',81),(95,'61500401','ອັດຕາກິນ',94),(96,'61500402','ຄ່າເດີນທາງ',94),(97,'61500500','ເບ້ຍລ້ຽງພະນັກງານໄປຄົນຄ້ວາ ຢູ່ພາຍໃນ ແລະ ຕ່າງປະເທດ',81),(98,'61500501','ອັດຕາກິນ',97),(99,'61500502','ຄ່າເດີນທາງ',97),(100,'61500600','ຄ່າຂົນສົງນັກຮຽນ ແລະ ນັກສຶກສາ',81),(101,'61600000','ເງິນປີນປົວ ພະນັກງານການນຳ',59),(102,'61700000','ເງິນຊ່ວຍໜູນດ້ານສັງຄົມ',59),(103,'61700100','ເງິນນະໂຍບາຍ ໃຫ້ພະນັກງານບຳນານຄືນ',102),(104,'61700200','ເງິນນະໂຍບາຍ ລູກພະນັກງານບຳນານ',102),(105,'61700300','ເງິນນະໂຍບາຍ ພະນັກງານເສັຍອົງຄະ',102),(106,'61700400','ເງິນນະໂຍບາຍ ຜູ້ດູແລຜູ້ເສຍອົງຄະພິເສດ',102),(107,'61700500','ເງິນນະໂຍບາຍ ເສຍຊີວິດ',102),(108,'61700600','ເງິນນະໂຍບາຍ ປີນປົວພະຍາດ',102),(109,'61700700','ອັດຕາກິນນັກໂທດ',102),(110,'61700701','ນັກໂທດພາຍໃນ',109),(111,'61700702','ນັກໂທດຕ່າງປະເທດ',109),(112,'62000000','ລາຍຈ່າຍ ບໍລິຫານປົກກະຕິ',NULL),(113,'62100000','ການຊື ແລະ ການຊົມໃຊ້',112),(114,'62100100','ຊືນ້ຳມັນເຊືອໄຟ ແລະ ນ້ຳມັນລໍ່ລືນ',113),(115,'62100200','ຊືເຄື່ອງໃຊ້ຫ້ອງການ ແລະ ແບບພິມ',113),(116,'62100201','ຊືເຄື່ອງໃຊ້ຫ້ອງການ',115),(117,'62100202','ຊືແບບພິມ',115),(118,'62100203','ຊືວາລະສານ ແລະ ໜັງສືພິມ',115),(119,'62100300','ຊືເຄື່ອງແບບ',113),(120,'62100400','ຊືວັດຖຸ, ອຸປະກອນຕ່າງໆ',113),(121,'62100401','ຊືວັດຖຸ, ອຸປະກອນ ການສິດສອນ ແລະ ການຮຽນ',120),(122,'62100402','ຊືວັດຖຸ, ອຸປະກອນ ດ້ານການແພດ',120),(123,'62100403','ຊືວັດຖຸ, ອຸປະກອນ ຮັບໃຊ້ວິຊາສະເພາະ',120),(124,'62100404','ຊືຢາປົວພະຍາດໃຫ້ໂຮງໝໍ',120),(125,'62100500','ຄ່ານ້ຳປະປາ, ຄ່າໄຟຟ້າ',113),(126,'62100501','ຄ່ານ້ຳປະປາ',125),(127,'62100502','ຄ່າໄຟຟ້າ',125),(128,'62200000','ລາຍຈ່າຍການບໍລິການ ຈາກທາງນອກ',112),(129,'62200100','ຄ່າເຊົາຕ່າງໆ',128),(130,'62200101','ຄ່າເຊົາຕຶກ ເຄຫາສະຖານ',129),(131,'62200102','ຄ່າເຊົາພາຫະນະ',129),(132,'62200103','ຄ່າເຊົາລະບົບການສື່ສານ',129),(133,'62200104','ຄ່າເຊົາເຄື່ອງຈັກ ແລະ ວັດຖຸອຸປະກອນ',129),(134,'62200105','ຄ່າເຊົາອື່ນໆ',129),(135,'62200200','ຄ່າບຳລຸງຮັກສາ, ສ້ອມແປງປົກກະຕິ ແລະ ຕິດຕັ້ງ',128),(136,'62200201','ສຳນັກງານ ແລະ ສີ່ງປຸກສ້າງ',135),(137,'62200202','ພາຫະນະ',135),(138,'62200203','ເຄື່ອງຈັກ ແລະ ວັດຖຸອຸປະກອນ',135),(139,'62200204','ສວນສາທາລະນະ, ສະຖານທີວັດທະນະທຳ',135),(140,'62200205','ຂົວ ແລະທາງ',135),(141,'62200206','ຕໍານເຈື່ອນ',135),(142,'62200207','ສະໜາມບິນ, ສະໜາມກິລາ',135),(143,'62200208','ຊົນລະປະທານ',135),(144,'62200209','ອື່ນໆ',135),(145,'62200300','ຄ່າປະກັນໄພ',128),(146,'62200301','ສຳນັກງານ',145),(147,'62200302','ພາຫະນະ',145),(148,'62200303','ອື່ນໆ',145),(149,'62200400','ຄ່າໄປສະນີ ແລະ ຄ່າໂທລະຄົມມະນາຄົມ',128),(150,'62200401','ຄ່າໄປສະນີ',149),(151,'62200402','ຄ່າໂທລະຄົມມະນາຄົມ',149),(152,'62200500','ຄ່າຂົນສົງວັດຖຸອຸປະກອນ',128),(153,'62200600','ຄ່າບໍລິການ ທະນາຄານ',128),(154,'62200700','ຄ່າບໍລິການ ແປພາສາ',128),(155,'62200800','ຄ່າບໍລິການ ເວນຍາມສຳນັກງານ',128),(156,'62200900','ຄ່າທີປຶກສາພາຍໃນ',128),(157,'62201000','ຄ່າທີປຶກສາຕ່າງປະເທດ',128),(158,'62201100','ຄ່າບໍລິການອື່ນໆ',128),(159,'62300000','ລາຍຈ່າຍໄປວຽກທາງການ',112),(160,'62300100','ພາຍໃນປະເທດ',159),(161,'62300200','ຕ່າງປະເທດ',159),(162,'62400000','ລາຍຈ່າຍກອງປະຊຸມ , ສຳມະນາ ແລະ ຝຶກອົບëົມ',112),(163,'62400100','ກອງປະຊຸມ',162),(164,'62400200','ສຳມະນາ',162),(165,'62400300','ຝຶກອົບຮົມ',162),(166,'62500000','ລາຍຈ່າຍຮັບແຂກ',112),(167,'62500100','ພາຍໃນປະເທດ',166),(168,'62500200','ຕ່າງປະເທດ',166),(169,'62600000','ລາຍຈ່າຍຊືຂອງຂວັນ ແລະ ຂອງຕ້ອນ',112),(170,'62700000','ລາຍຈ່າຍ ວັນບຸນລະດັບຊາດ',112),(171,'62800000','ລາຍຈ່າຍ ຄ່າພາສີ, ສ່ວຍສາອາກອນ ແລະ ຄ່າທຳນຽມ ຕ່າງໆ',112),(172,'62800100','ຄ່າພາສີ',171),(173,'62800200','ຄ່າອາກອນ',171),(174,'62800300','ຄ່າທຳນຽມ ແລະ ຄ່າສະແຕມ',171),(175,'62900000','ລາຍຈ່າຍບໍລິຫານປົກກະຕິ ອໍນໆ',112),(176,'63000000','ລາຍຈ່າຍດັດສົມ, ສົ່ງເສີມ ແລະ ເງິນບຳລຸງ',NULL),(177,'63100000','ດັດສົມ ສົງເສີມ ດ້ານການເມືອງ',176),(178,'63100100','ການເລືອກຕັ້ງສະພາແຫ່ງຊາດ',177),(179,'63100200','ກອງປະຊຸມພັກ',177),(180,'63100300','ກອງປະຊຸມ ອົງການຈັດຕັ້ງມະຫາຊົນ',177),(181,'63100400','ກໍ່ສ້າງຮາກຖານ ການເມືອງ',177),(182,'63100500','ການເຄ່ືອນໄຫວພິເສດ',177),(183,'63100600','ການເຄ່ືອນໄຫວລັດຖະກິດ',177),(184,'63100700','ການຍ້ອງຍໍ ( ໃບຍ້ອງຍໍ, ຫລຽນກາ, ຫລຽນໄຊ ແລະ ອື່ນໆ )',177),(185,'63200000','ດັດສົມ ສົ່ງເສີມ ດ້ານເສດຖະກິດ',176),(186,'63200100','ຖົມຂຸມລາຄາ',185),(187,'63200200','ຖົມຂຸມດອກເບັ້ຍ',185),(188,'63200300','ຊຸກຍູ້ສົງເສີມການຜະລິດ',185),(189,'63200400','ເງິນບຳເນັດເກັບລາຍຮັບຢູ່ຂັ້ນບ້ານ',185),(190,'63200500','ເງິນຈ່າຍຊືອາຫານສັດ(ໝາວິຊາສະເພາະຕຳຫລວດ)( ເພີ່ມໃໝ່ )',185),(191,'63200800','ອື່ນໆ',185),(192,'63300000','ດັດສົມ ສົງເສີມ ດ້ານວັດທະນາທຳ - ສັງຄົມ',176),(193,'63300100','ປັບປຸງ ແລະ ພັດທະນາ ຄຸນນະພາບ ການສຶກສາ ທຸກຂັ້ນ',192),(194,'63300200','ປ້ອງກັນ, ປີ່ນປົວ, ຟືນຟູ ແລະ ສົງເສີມສຸຂະພາບ',192),(195,'63300300','ຄຸ້ມຄອງ ຜູ້ບໍລິໂພກ ແລະ ຜູ້ສະໜອງອາຫານ  ຢາ',192),(196,'63300400','ຄົນຄ້ວາວິທະຍາສາດ ການແພດ',192),(197,'63300500','ປັບປຸງວຽກງານຖະແຫລ່ງຂ່າວ ແລະ ສື່ມວນຊົນ',192),(198,'63300600','ບູລະນະ ແລະ ປົກປັກຮັກສາ ວັດທະນາທຳ',192),(199,'63300700','ພິມໜັງສືພິມ ແລະ ວາລະສານ',192),(200,'63400000','ດັດສົມ ສົງເສີມ ວຽກງານອື່ນໆ',176),(201,'63500000','ເງິນບຳລຸງ ແລະ ເງິນປະກອບສ່ວນເຂົາໃນອົງການຈັດຕັ້ງສາກົນ',176),(202,'63500100','ເງິນບຳລຸງອົງການຈັດຕັ້ງສາກົນ',201),(203,'63500200','ເງິນປະກອບສ່ວນເຂົາໃນອົງການຈັດຕັ້ງສາກົນ',201),(204,'63500300','ເງິນປະກອບສ່ວນເຂົາໃນກອງປະຊຸມ',201),(205,'63600000','ເງິນຊ່ວຍໜູນ',176),(206,'63600100','ເງິນສົງເຄາະປະຊາຊົນ ປະສົບໄພທຳມະຊາດ',205),(207,'63600200','ເງິນນະໂຍບາຍຜູ້ມີຜົນງານຕໍ່ການປະຕິວັດ',205),(208,'64000000','ລາຍຈ່າຍ ການເງິນ',NULL),(209,'64100000','ລາຍຈ່າຍດອກເບັ້ຍ',208),(210,'64100100','ດອກເບັ້ຍ ເງິນກູ້ຢືມພາຍໃນ',209),(211,'64100101','ດອກເບັ້ຍ ພັນທະບັດຄັງເງິນແຫ່ງຊາດ',210),(212,'64100102','ດອກເບັ້ຍ ຮຸ້ນກູໍລັດຖະບານ',210),(213,'64100103','ດອກເບັ້ຍ ເງິນກູ້ຢືມຮູບການອື່ນໆ',210),(214,'64100200','ດອກເບັ້ຍ ເງິນກູ້ຢືມຈາກຕ່າງປະເທດ',209),(215,'64100201','ດອກເບັ້ຍ ເງິນກູ້ຢືມດັດແກ້ມະຫາພາກ',214),(216,'64100202','ດອກເບັ້ຍ ເງິນກູ້ຢືມເປັນໂຄງການ',214),(217,'64100300','ດອກເບັ້ຍ ພັນທະບັດຕ່າງປະເທດ',209),(218,'64200000','ລາຍຈ່າຍ ເງິນຄ້ຳປະກັນ',208),(219,'64300000','ລາຍຈ່າຍ ຜິດດ່ຽງຈາກການແລກປ່ຽນເງິນຕາຕ່າງປະເທດ (ສ່ວນເສຍ)',208),(220,'64400000','ລາຍຈ່າຍ ສົງຄືນອາກອນມູນຄ່າເພີ່ມ ( ເພີ່ມໃໝ່ )',208),(221,'6500000','ລາຍຈ່າຍ ອື່ນໆ',NULL),(222,'65100000','ຫັກເງິນເຂົາຄັງສະສົມແຫ່ງລັດ',NULL),(223,'65200000','ລາຍຈ່າຍ ຄ່າປັບໃໝ',NULL),(224,'65300000','ລາຍຈ່າຍ ເງິນແຮ',NULL),(225,'65300100','ລາຍຈ່າຍ ເງິນແຮລັດຖະບານ',224),(226,'65300200','ລາຍຈ່າຍ ເງິນແຮທ້ອງຖີນ',224),(227,'65400000','ລາຍຈ່າຍ ເງິນບຳເນັດ ເກັບລາຍຮັບເກີນແຜນ',NULL),(228,'65500000','ອໍນໆ',NULL),(229,'66000000','ຊືຊັບສົມບັດ ຮັບໃຊ້ບໍລິຫານ',NULL),(230,'66100000','ຊືພະຫານະ ຮັບໃຊ້ກົງຈັກ ບໍລິຫານ',229),(231,'66200000','ຊືເຄື່ອງຈັກ ແລະ ວັດຖຸອຸປະກອນ',229),(232,'66300000','ຊືຊັບສົມບັດຄົງທີ ອື່ນໆ',229),(233,'6700000','ລາຍຈ່າຍລົງທຶນຂອງລັດ',NULL),(234,'67100000','ຄ່າບຸກເບີກທີດິນ',NULL),(235,'67200000','ຄ່າເວນຄືນທີດິນ',NULL),(236,'67300000','ຄ່າສຳÍວດພືນຖານ ແລະ ສົງເສີມວິຊາການ',NULL),(237,'67400000','ຄ່າອອກແບບ',NULL),(238,'67500000','ລາຍຈ່າຍ ຄຸ້ມຄອງໂຄງການ',NULL),(239,'67500100','ຄ່າຈ້າງຊ່ຽວຊານ ຕ່າງປະເທດ',238),(240,'67500200','ຄ່າຈ້າງຊ່ຽວຊານ ພາຍໃນ',238),(241,'67500300','ລາຍຈ່າຍໃຫ້ພະນັກງານລົງຕິດຕາມໂຄງການ',238),(242,'67500400','ລາຍຈ່າຍບໍລິຫານອື່ນໆ',238),(243,'67600000','ໂປëແກມຄອມພິວເຕີ',NULL),(244,'67700000','ລິຂະສິດດ້ານຊັບສິນທາງປັນຍາ',NULL),(245,'67800000','ການກໍ່ສ້າງ',NULL),(246,'67800100','ຕຶກ ເຄຫາສະຖານ ( ການກໍ່ສ້າງ )',245),(247,'67800200','ຂົວ',245),(248,'67800300','ເສັ້ນທາງ( ທາງດິນແດງ, ທາງຢາງ, ທາງຄອນກëີດ )',245),(249,'67800400','ທາງລົດໄຟ',245),(250,'67800500','ປັກແລວນ້ຳ',245),(251,'67800600','ຕາຟັງເຈື່ອນ',245),(252,'67800700','ໂຄງສ້າງນ້ຳປະປາ ( ອ່າງ, ທໍ່ນ້ຳປະປາ,....)',245),(253,'67800800','ໂຄງສ້າງໄຟຟ້າ ( ຕາຄ່າຍໄຟຟ້າ, ເຂື່ອນໄຟຟ້າ,... )',245),(254,'67800900','ໂຄງສ້າງການສື່ສານ',245),(255,'67801000','ສະໜາມກິລາ, ສະໜາມບິນ',245),(256,'67801100','ຊົນລະປະທານ',245),(257,'67801200','ການກໍ່ສ້າງໂຄງລ່າງອໍນໆ',245),(258,'67900000','ການຊື',NULL),(259,'67900100','ຕຶກ ເຄຫາສະຖານ ( ການຊື )',258),(260,'67900200','ຊືເຄື່ອງມື  ແລະ ວັດຖຸອຸປະກອນ ( ລົງທຶນ )',258),(261,'67900300','ຊືເຄື່ອງກົນຈັກ ( ລົດຈົກ, ລົດດຸດ ) ( ລົງທຶນ )',258),(262,'67900400','ຊືພະຫານະ   ( ລົງທຶນ )',258),(263,'67900500','ຊືແນວພັນພືດແນວພັນສັດ',258),(264,'67900600','ຊືຊັບສົມບັດຄົງທີ ອື່ນໆ  ( ລົງທຶນ )',258),(265,'67900700','ການສ້ອມແປງໃຫຍ່',258),(266,'67900701','ຕຶກ ເຄຫາສະຖານ',265),(267,'67900702','ຂົວ',265),(268,'67900703','ເສັ້ນທາງ ( ທາງດິນແດງ, ທາງຢາງ, ທາງຄອນກëີດ )',265),(269,'67900704','ທາງລົດໄຟ',265),(270,'67900705','ປັກແລວນ້ຳ',265),(271,'67900706','ຕາຟັງເຈື່ອນ',265),(272,'67900707','ໂຄງສ້າງ ນ້ຳປະປາ ( ອ່າງ, ທໍ່ນ້ຳປະປາ,..)',265),(273,'67900708','ໂຄງສ້າງໄຟຟ້າ ( ຕາຄ່າຍໄຟຟ້າ, ເຂື່ອນໄຟຟ້າ,... )',265),(274,'67900709','ໂຄງສ້າງການສື່ສານ',265),(275,'67900710','ສະໜາມກິລາ, ສະໜາມບິນ',265),(276,'67900711','ຊົນລະປະທານ',265),(277,'67900712','ພາຫະນະ',265),(278,'67900713','ເຄື່ອງກົນຈັກ ( ລົດຈົກ, ລົດດຸດ, ...)',265),(279,'67900714','ເຄື່ອງມື  ແລະ ວັດຖຸອຸປະກອນ',265),(280,'67900715','ໂຄງລ່າງ ແລະຊັບສົມບັດຄົງທີ ອື່ນໆ',265),(281,'68000000','ລາຍຈ່າຍຮ່ວມປະກອບທຶນ, ຊ່ວຍເຫຼືອລ້າ, ກູ້ຢືມ ແລະ ໃຫ້ກູ້ຢືມ',NULL),(282,'68100000','ລາຍຈ່າຍຮ່ວມປະກອບທຶນ',281),(283,'68100100','ໃບຢັ້ງຢືນຮ່ວມປະກອບທຶນຂອງລັດ',282),(284,'68100200','ທຶນປະກອບ',282),(285,'68200000','ລາຍຈ່າຍ ຊ່ວຍເຫຼືອລ້າ',281),(286,'68200100','ເງິນຊ່ວຍເຫລືອລ້າໃຫ້ລັດຖະບານຕ່າງປະເທດ',285),(287,'68200200','ເງິນຊ່ວຍເຫລືອລ້າໃຫ້ອົງການຈັດຕັ້ງສາກົນ',285),(288,'68300000','ລາຍຈ່າຍເງິນກູ້ຢືມດັດແກ້ມະພາກ ເງິນກູ້ຢືມເປັນໂຄງການ',281),(289,'68300100','ຕົນທຶນເງິນກູ້ຢືມ ດັດແກ້ມະຫາພາກ',288),(290,'68300200','ຕົນທຶນເງິນກູ້ຢືມ ທີເປັນໂຄງການ',288),(291,'68400000','ລາຍຈ່າຍເງິນໃຫ້ກໍູຢືມ',281),(292,'68400100','ເງິນໃຫ້ກູ້ຢືມ ແກ່ລັດວິສາຫະກິດ',291),(293,'68400200','ເງິນໃຫ້ກູ້ຢືມ ແກ່ວິສາຫະກິດອື່ນໆ',291),(294,'68400300','ເງິນໃຫ້ກູ້ຢືມ ແກ່ຕ່າງປະເທດ',291),(295,'69000000','ລາຍຈ່າຍ ຊຳລະໜšສິນປີເກົາ',NULL),(296,'69100000','ໜš ລາຍຈ່າຍ ບໍລິຫານປົກກະຕິ',295),(297,'69100100','ຄ່າກະແສໄຟຟ້າ',296),(298,'69100200','ຄ່ານ້ຳປະປາ',296),(299,'69100300','ຄ່າໂທລະສັບ',296),(300,'69200000','ລາຍຈ່າຍດັດສົມ ແລະ ສົງເສີມ',295),(301,'69300000','ລາຍຈ່າຍລົງທຶນຂອງລັດ',295);
/*!40000 ALTER TABLE `chart_of_accounts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `departments`
--

DROP TABLE IF EXISTS `departments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `departments` (
  `id` int NOT NULL AUTO_INCREMENT,
  `department_name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `department_type` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `department_name` (`department_name`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `departments`
--

LOCK TABLES `departments` WRITE;
/*!40000 ALTER TABLE `departments` DISABLE KEYS */;
INSERT INTO `departments` VALUES (1,'Computer','Com');
/*!40000 ALTER TABLE `departments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `expense_defaults`
--

DROP TABLE IF EXISTS `expense_defaults`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `expense_defaults` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `parent_id` bigint unsigned DEFAULT NULL,
  `category_code` char(3) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sort_order` tinyint unsigned NOT NULL DEFAULT '0',
  `item_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `reference` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `amount_per_month` decimal(15,2) NOT NULL DEFAULT '0.00',
  `num_months` decimal(5,2) NOT NULL DEFAULT '12.00',
  `annual_total` decimal(15,2) NOT NULL DEFAULT '0.00',
  `notes` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `chart_of_account_id` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `expense_defaults_parent_id_foreign` (`parent_id`),
  KEY `expense_defaults_coa_fk` (`chart_of_account_id`),
  CONSTRAINT `expense_defaults_coa_fk` FOREIGN KEY (`chart_of_account_id`) REFERENCES `chart_of_accounts` (`id`) ON DELETE SET NULL,
  CONSTRAINT `expense_defaults_parent_id_foreign` FOREIGN KEY (`parent_id`) REFERENCES `expense_defaults` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=193 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `expense_defaults`
--

LOCK TABLES `expense_defaults` WRITE;
/*!40000 ALTER TABLE `expense_defaults` DISABLE KEYS */;
INSERT INTO `expense_defaults` VALUES (1,NULL,'2.1',0,'ບໍລິຫານສັງລວມ','2.1.1',4810000.00,12.00,57720000.00,NULL,NULL),(2,NULL,'2.1',1,'ບຳລຸງຮັກສາ, ສ້ອມແປງ ແລະ ຕິດຕັ້ງ','2.1.2',6916666.67,12.00,83000000.00,NULL,138),(3,NULL,'2.1',2,'ສ້ອມແປງ ແລະ ປັບປຸງອາຄານຫ້ອງຮຽນ','2.1.3',4500000.00,12.00,54000000.00,NULL,136),(4,NULL,'2.1',3,'ສ້ອມແປງພາຫານະ','2.1.4',558333.33,12.00,6700000.00,NULL,137),(5,NULL,'2.1',4,'ຊື້ເຄື່ອງຈັກ, ວັດຖຸອຸປະກອນ','2.1.5',2083333.33,12.00,25000000.00,NULL,NULL),(6,NULL,'2.1',5,'ຄ່າປະກັນໄພພາຫະນະ','2.1.6',341666.67,12.00,4100000.00,NULL,147),(7,NULL,'2.1',6,'ລາຍຈ່າຍໄປວຽກທາງການ','2.1.7',1333333.33,12.00,16000000.00,NULL,NULL),(8,NULL,'2.1',7,'ປົກປັກຮັກສາ ແລະ ອານາໄມອາຄານ, ສະຖານທີ່','2.1.8',0.00,12.00,0.00,NULL,136),(9,NULL,'2.1',8,'ວຽກງານກິດຈະກຳນັກສຶກສາ','2.1.9',0.00,1.00,0.00,NULL,200),(10,NULL,'2.1',9,'ລາຍຈ່າຍກອງປະຊຸມ, ສຳມະນາ ແລະ ຝຶກອົບຮົມ','2.1.10',1920000.00,12.00,23040000.00,NULL,163),(11,NULL,'2.1',10,'ລາຍຈ່າຍບໍລິຫານປົກກະຕິອື່ນໆ','2.1.11',3007541.67,12.00,36090500.00,NULL,175),(12,NULL,'2.2',0,'ຊື້ວັດຖຸ, ອຸປະກອນການຮຽນ ແລະ ການສິດສອນ','2.2.1',2166666.67,12.00,26000000.00,NULL,NULL),(13,NULL,'2.2',1,'ປັບປຸງ ແລະ ພັດທະນາການສຶກສາ (ປັບປຸງຫຼັກສູດ, ພິມປື້ມ)','2.2.2',6333333.33,12.00,76000000.00,NULL,193),(14,NULL,'2.2',2,'ບຳລຸງຫ້ອງທົດລອງ','2.2.3',2833333.33,12.00,34000000.00,NULL,138),(15,NULL,'2.2',3,'ຊື້ອຸປະກອນທົດລອງ','2.2.4',40333333.33,12.00,484000000.00,NULL,NULL),(16,NULL,'2.2',4,'ລາຍຈ່າຍກອງປະຊຸມວິຊາການ','2.2.5',0.00,12.00,0.00,NULL,164),(17,NULL,'2.2',5,'ບຳລຸງຫ້ອງອ່ານ','2.2.6',0.00,12.00,0.00,NULL,123),(18,NULL,'2.2',6,'ການຍົກລະດັບໄລຍະຍາວ','2.2.7',0.00,12.00,0.00,NULL,165),(19,NULL,'2.2',7,'ລາຍຈ່າຍຕິດຕາມການປະຕິບັດຫຼັກສູດ','2.2.8',0.00,12.00,0.00,NULL,160),(20,NULL,'2.3',0,'ບໍລິຫານວິຊາການ','2.3.1',2083333.33,12.00,25000000.00,NULL,193),(21,NULL,'2.3',1,'ບູລະນະ ແລະ ປົກປັກຮັກສາວັດທະນະທຳ','2.3.2',1644500.00,12.00,19734000.00,NULL,198),(22,NULL,'2.3',2,'ໄປທັດສະນະສຶກສາ','2.3.3',0.00,12.00,0.00,NULL,160),(23,NULL,'2.4',0,'ອຸດໜູນຄ່າບັດໂທລະສັບປະຈຳຕຳແໜ່ງ','2.4.1',0.00,12.00,0.00,NULL,151),(24,NULL,'2.4',1,'ອຸດໜູນຄ່ານ້ຳມັນປະຈຳຕຳແໜ່ງ','2.4.2',0.00,12.00,0.00,NULL,114),(25,NULL,'2.4',2,'ເງິນເດືອນສັນຍາຈ້າງ ແລະ ຄ່າແຮງງານ','2.4.3',0.00,12.00,0.00,NULL,175),(26,NULL,'2.4',3,'ອຸດໜູນການເຮັດວຽກເພີ່ມ','2.4.4',0.00,12.00,0.00,NULL,175),(27,NULL,'2.4',4,'ອຸດໜູນຄ່າຄອງຊີບ','2.4.5',0.00,12.00,0.00,NULL,175),(28,NULL,'2.5',0,'ຄ່າສອນລະບົບພິເສດ','2.5.1',54850000.00,12.00,658200000.00,NULL,175),(29,NULL,'2.5',1,'ຄ່າບໍລິການສອບເສັງ','2.5.2',0.00,0.00,0.00,NULL,175),(30,NULL,'2.5',2,'ບົດໂຄງການຈົບຊັ້ນ','2.5.3',0.00,1.00,0.00,NULL,175),(31,NULL,'2.5',3,'ອຸດໜູນການລົງທະບຽນ','2.5.4',0.00,0.00,0.00,NULL,175),(32,NULL,'2.6',0,'ບໍລິຈາກເລືອດໃຫ້ອົງການກາແດງລາວ','2.6.1',0.00,1.00,0.00,NULL,200),(33,NULL,'2.6',1,'ເຄື່ອນໄຫວກິລາ ແລະ ສິນລະປະ','2.6.2',0.00,1.00,0.00,NULL,200),(34,NULL,'2.6',2,'ອອກແຮງງານລວມ','2.6.3',0.00,1.00,0.00,NULL,200),(35,NULL,'2.6',3,'ຖາມ-ຕອບວິທະຍາສາດ','2.6.4',0.00,1.00,0.00,NULL,200),(36,1,'2.1',0,'ເຄື່ອງໃຊ້ຫ້ອງການ',NULL,2800000.00,12.00,0.00,NULL,116),(37,1,'2.1',1,'ແບບພິມ',NULL,250000.00,12.00,0.00,NULL,117),(38,1,'2.1',2,'ວາລະສານ ແລະ ໜັງສືພິມ',NULL,0.00,12.00,0.00,NULL,118),(39,1,'2.1',3,'ຮັບແຂກ',NULL,800000.00,12.00,0.00,NULL,167),(40,1,'2.1',4,'ໂທລະສັບບໍລິຫານ',NULL,30000.00,12.00,0.00,NULL,151),(41,1,'2.1',5,'ຄ່າໄປສະນີ',NULL,0.00,12.00,0.00,NULL,150),(42,1,'2.1',6,'ຄ່າບໍລິການທະນາຄານ',NULL,30000.00,12.00,0.00,NULL,153),(43,1,'2.1',7,'ຊື້ຂອງຂັວນຂອງຕ້ອນ',NULL,400000.00,12.00,0.00,NULL,169),(44,1,'2.1',8,'ວັນບຸນລະດັບຊາດ',NULL,500000.00,12.00,0.00,NULL,170),(45,1,'2.1',9,'ອຸດໜູນວຽກປ້ອງກັນ',NULL,0.00,12.00,0.00,'ຂື້ນຢູ່ງົບລັດ',155),(46,1,'2.1',10,'ຄ່ານ້ຳມັນບໍລິຫານຫ້ອງການ',NULL,0.00,4.00,0.00,'ຂື້ນຢູ່ງົບລັດ',114),(47,1,'2.1',11,'ຄ່ານ້ຳມັນເຄື່ອງ',NULL,0.00,4.00,0.00,'ຂື້ນຢູ່ງົບລັດ',114),(48,2,'2.1',0,'ບຳລຸງຮັກສາຄອມພີວເຕີ',NULL,300000.00,30.00,0.00,NULL,NULL),(49,2,'2.1',1,'ບຳລຸງຮັກສາເຄື່ອງສາຍໂປຣເຈັກເຕີ',NULL,200000.00,25.00,0.00,NULL,NULL),(50,2,'2.1',2,'ບຳລຸງຮັກສາແອເຢັນ',NULL,500000.00,90.00,0.00,NULL,NULL),(51,2,'2.1',3,'ບຳລຸງຮັກສາຕູ້ເຢັນ + ຕູ້ນ້ຳເຢັນ',NULL,100000.00,20.00,0.00,NULL,NULL),(52,2,'2.1',4,'ບຳລຸງຮັກສາພັດລົມ',NULL,80000.00,100.00,0.00,NULL,NULL),(53,2,'2.1',5,'ບຳລຸງຮັກສາດອກໄຟ',NULL,10000.00,600.00,0.00,NULL,NULL),(54,2,'2.1',6,'ບຳລຸງຮັກສາເຄື່ອງພິມ',NULL,100000.00,20.00,0.00,NULL,NULL),(55,2,'2.1',7,'ບຳລຸງຮັກສາຈັກອັດສຳເນົາ',NULL,2000000.00,0.00,0.00,NULL,NULL),(56,2,'2.1',8,'ບຳລຸງຮັກສາໂທລະສັບ',NULL,50000.00,0.00,0.00,NULL,NULL),(57,2,'2.1',9,'ບຳລຸງຮັກສາກ້ອງຖ່າຍຮູບ',NULL,50000.00,0.00,0.00,NULL,NULL),(58,2,'2.1',10,'ບຳລຸງຮັກສາໂທລະທັດ',NULL,50000.00,0.00,0.00,NULL,NULL),(59,2,'2.1',11,'ຈັກປ້ຳນ້ຳອັດຕະໂນມັດ',NULL,1000000.00,4.00,0.00,NULL,NULL),(60,2,'2.1',12,'ຈັກຕັດຫຍ້າ',NULL,1000000.00,2.00,0.00,NULL,NULL),(61,3,'2.1',0,'ສ້ອມແປງອາຄານສໍານັກງານຕ່າງໆ',NULL,2000000.00,7.00,0.00,NULL,NULL),(62,3,'2.1',1,'ປັບປຸງອາຄານຫ້ອງຮຽນ-ຫ້ອງທົດລອງ',NULL,40000000.00,1.00,0.00,NULL,NULL),(63,4,'2.1',0,'ລົດຕູ້',NULL,2850000.00,2.00,0.00,NULL,NULL),(64,4,'2.1',1,'ລົດຈັກ',NULL,1000000.00,1.00,0.00,NULL,NULL),(65,5,'2.1',0,'ຊື້ ໂຕະ, ຕັ່ງ',NULL,150000.00,0.00,0.00,NULL,232),(66,5,'2.1',1,'ບຳລຸງຮັກສາ, ສ້ອມແປງ ໂຕະ, ຕັ່ງ',NULL,30000.00,0.00,0.00,NULL,138),(67,5,'2.1',2,'ຊື້ເຄື່ອງຈັກ ແລະ ວັດຖຸອຸປະກອນ',NULL,25000000.00,1.00,0.00,NULL,231),(68,5,'2.1',3,'ຊື້ພາຫະນະ',NULL,200000000.00,0.00,0.00,NULL,231),(69,6,'2.1',0,'ປະກັນໄພລົດໃຫຍ່',NULL,2050000.00,2.00,0.00,NULL,NULL),(70,7,'2.1',0,'ໄປວຽກທາງການພາຍໃນປະເທດ',NULL,16000000.00,1.00,0.00,NULL,160),(71,7,'2.1',1,'ໄປວຽກທາງການຕ່າງປະເທດ',NULL,0.00,1.00,0.00,NULL,161),(72,8,'2.1',0,'ບຳລຸງຮັກສາວິທະຍາເຂດ',NULL,2000000.00,12.00,0.00,NULL,NULL),(73,8,'2.1',1,'ອານາໄມອາຄານ',NULL,10000000.00,12.00,0.00,NULL,NULL),(74,9,'2.1',0,'ປະຖົມນິເທດນັກສຶກສາ',NULL,1500000.00,2.00,0.00,NULL,NULL),(75,9,'2.1',1,'ກວດສອບການປະຕິບັດລະບຽບວິໃນນັກສຶກສາ',NULL,400000.00,5.00,0.00,NULL,NULL),(76,10,'2.1',0,'ສຳນັກຄະນະບໍດີ',NULL,200000.00,12.00,0.00,NULL,NULL),(77,10,'2.1',1,'ພາວິຊາຄະນິດສາດ',NULL,20000.00,12.00,0.00,NULL,NULL),(78,10,'2.1',2,'ພາກວິຊາຟິຊິກສາດ',NULL,20000.00,12.00,0.00,NULL,NULL),(79,10,'2.1',3,'ພາກວິຊາເຄມີສາດ',NULL,20000.00,12.00,0.00,NULL,NULL),(80,10,'2.1',4,'ພາກວິຊາຊີວະວິທະຍາ',NULL,20000.00,12.00,0.00,NULL,NULL),(81,10,'2.1',5,'ພາກວິຊາວິທະຍາສາດຄອມພີວເຕີ',NULL,20000.00,12.00,0.00,NULL,NULL),(82,10,'2.1',6,'ພະແນກວິຊາການ',NULL,20000.00,12.00,0.00,NULL,NULL),(83,10,'2.1',7,'ພະແນກຈັດຕັ້ງສັງລວມ',NULL,20000.00,12.00,0.00,NULL,NULL),(84,10,'2.1',8,'ພະແນກການເງິນ-ຊັບສິນ',NULL,20000.00,12.00,0.00,NULL,NULL),(85,10,'2.1',9,'ພະແນກຄຸ້ມຄອງນັກສຶກສາ',NULL,20000.00,12.00,0.00,NULL,NULL),(86,10,'2.1',10,'ພະແນກຄົ້ນຄ້ວາ ແລະ ບໍລິການວິຊາການ',NULL,20000.00,12.00,0.00,NULL,NULL),(87,10,'2.1',11,'ພະແນກຫຼັງປະລິນຍາຕີ',NULL,20000.00,12.00,0.00,NULL,NULL),(88,12,'2.2',0,'ອຸປະກອນການຮຽນ-ການສອນ',NULL,1500000.00,12.00,0.00,NULL,121),(89,12,'2.2',1,'ອຸປະກອນການສອບເສັງ',NULL,4000000.00,2.00,0.00,NULL,123),(90,13,'2.2',0,'ພາກວິຊາຄະນິດສາດ',NULL,0.00,1.00,0.00,NULL,NULL),(91,13,'2.2',1,'ພາກວິຊາຟີຊິກສາດ',NULL,0.00,1.00,0.00,NULL,NULL),(92,13,'2.2',2,'ພາກວິຊາເຄມີສາດ',NULL,0.00,1.00,0.00,NULL,NULL),(93,13,'2.2',3,'ພາກວິຊາຊີວະວິທະຍາ',NULL,0.00,1.00,0.00,NULL,NULL),(94,13,'2.2',4,'ພາກວິຊາວິທະຍາສາດຄອມພີວເຕີ',NULL,0.00,1.00,0.00,NULL,NULL),(95,14,'2.2',0,'ພາກວິຊາຄະນິດສາດ',NULL,250000.00,12.00,0.00,NULL,NULL),(96,14,'2.2',1,'ພາກວິຊາຟິຊິກສາດ',NULL,500000.00,12.00,0.00,NULL,NULL),(97,14,'2.2',2,'ພາກວິຊາເຄມີສາດ',NULL,500000.00,12.00,0.00,NULL,NULL),(98,14,'2.2',3,'ພາກວິຊາຊີວະວິທະຍາ',NULL,500000.00,12.00,0.00,NULL,NULL),(99,14,'2.2',4,'ພາກວິຊາວິທະຍາສາດຄອມພິວເຕີ',NULL,1083333.00,12.00,0.00,NULL,NULL),(100,14,'2.2',5,'ຊື້ອຸປະກອນທົດລອງ',NULL,0.00,12.00,0.00,NULL,NULL),(101,15,'2.2',0,'ອຸປະກອນທົດລອງຟິຊິກສາດ',NULL,32000000.00,0.00,0.00,NULL,123),(102,15,'2.2',1,'ອຸປະກອນທົດລອງເຄມີສາດ',NULL,32000000.00,0.00,0.00,NULL,123),(103,15,'2.2',2,'ອຸປະກອນທົດລອງຊີວະວິທະຍາ',NULL,32000000.00,0.00,0.00,NULL,123),(104,15,'2.2',3,'ຄອມພິວເຕີຕັ້ງໂຕະ (PC)',NULL,12100000.00,40.00,0.00,NULL,231),(105,15,'2.2',4,'ໂປຣເຈັກເຕີໃສ່ຫ້ອງຮຽນ',NULL,5300000.00,0.00,0.00,NULL,231),(106,16,'2.2',0,'ພິທີສະຫຼຸບຊຸດຮຽນ ແລະ ເປີດສົກໃໝ່ ປໍໂທ',NULL,2300000.00,1.00,0.00,NULL,NULL),(107,16,'2.2',1,'ກອງປະຊຸມສຳມະນາວິຊາການ ປໍໂທ',NULL,7150000.00,1.00,0.00,NULL,NULL),(108,16,'2.2',2,'ກອງປະຊຸມຜູ້ຊົງຄຸນວຸດທິ ປໍໂທ',NULL,3150000.00,1.00,0.00,NULL,NULL),(109,17,'2.2',0,'ຊື້ປື້ມໃສ່ຫ້ອງອ່ານ',NULL,425000.00,20.00,0.00,NULL,NULL),(110,17,'2.2',1,'ຊື້ຮ້ານປື້ມໃສ່ຫ້ອງອ່ານ',NULL,2500000.00,1.00,0.00,NULL,NULL),(111,18,'2.2',0,'ສົ່ງພະນັກງານໄປຍົກລະດັບໄລຍະຍາວ',NULL,0.00,1.00,0.00,NULL,NULL),(112,19,'2.2',0,'ງົບປະມານຕິດຕາມຫຼັກສູດ ປໍໂທ',NULL,0.00,1.00,0.00,NULL,NULL),(113,20,'2.3',0,'ສົ່ງເສີມວິຊາການສ່ວນກາງ',NULL,0.00,12.00,0.00,NULL,NULL),(114,20,'2.3',1,'ກອງປະຊຸມສຳມະນາການເງິນ (ພະແນກການເງິນ)',NULL,0.00,12.00,0.00,'ຂື້ນຢູ່ພາກ 62',NULL),(115,20,'2.3',2,'ພະແນກບໍລິຫານສັງລວມ',NULL,0.00,12.00,0.00,'ຂື້ນຢູ່ພາກ 62',NULL),(116,20,'2.3',3,'ໜ່ວຍງານ ICT',NULL,0.00,12.00,0.00,'ຂື້ນຢູ່ພາກ 62',NULL),(117,20,'2.3',4,'ຫຼັງປະລິນຍາຕີ',NULL,0.00,12.00,0.00,'ຂື້ນຢູ່ພາກ 62',NULL),(118,20,'2.3',5,'ຄົ້ນຄ້ວາ ແລະ ບໍລິການວິຊາການ',NULL,0.00,12.00,0.00,'ຂື້ນຢູ່ພາກ 62',NULL),(119,20,'2.3',6,'ພັດທະນາຫຸ່ນຍົນ (Robot)',NULL,0.00,12.00,0.00,'ຂື້ນຢູ່ພາກ 62',NULL),(120,20,'2.3',7,'ພະແນກວິຊາການ',NULL,0.00,12.00,0.00,'ຂື້ນຢູ່ພາກ 62',NULL),(121,20,'2.3',8,'ພະແນກຄຸ້ມຄອງນັກສຶກສາ',NULL,0.00,12.00,0.00,'ຂື້ນຢູ່ພາກ 62',NULL),(122,20,'2.3',9,'ພາກວິຊາຄະນິດສາດ',NULL,416667.00,12.00,0.00,NULL,NULL),(123,20,'2.3',10,'ພາກວິຊາຟີຊິກສາດ',NULL,416667.00,12.00,0.00,NULL,NULL),(124,20,'2.3',11,'ພາກວິຊາເຄມີສາດ',NULL,416667.00,12.00,0.00,NULL,NULL),(125,20,'2.3',12,'ພາກວິຊາຊີວະວິທະຍາ',NULL,416667.00,12.00,0.00,NULL,NULL),(126,20,'2.3',13,'ພາກວິຊາວິທະຍາສາດຄອມພີວເຕີ',NULL,416667.00,12.00,0.00,NULL,NULL),(127,20,'2.3',14,'ສາມອົງການຈັດຕັ້ງມະຫາຊົນ',NULL,0.00,12.00,0.00,NULL,NULL),(128,20,'2.3',15,'ເຄື່ອນໄຫວວຽກວິຊາການອື່ນໆ',NULL,0.00,4.00,0.00,NULL,NULL),(129,21,'2.3',0,'ສຳນັກຄະນະບໍດີ',NULL,1041667.00,12.00,0.00,NULL,NULL),(130,21,'2.3',1,'ພາກວິຊາຄະນິດສາດ',NULL,81167.00,12.00,0.00,NULL,NULL),(131,21,'2.3',2,'ພາກວິຊາຟິຊິກສາດ',NULL,49500.00,12.00,0.00,NULL,NULL),(132,21,'2.3',3,'ພາກວິຊາເຄມີສາດ',NULL,70750.00,12.00,0.00,NULL,NULL),(133,21,'2.3',4,'ພາກວິຊາຊີວະວິທະຍາ',NULL,51083.00,12.00,0.00,NULL,NULL),(134,21,'2.3',5,'ພາກວິຊາວິທະຍາສາດຄອມພິວເຕີ',NULL,350333.00,12.00,0.00,NULL,NULL),(135,22,'2.3',0,'ສຳນັກຄະນະບໍດີ',NULL,190000.00,0.00,0.00,NULL,NULL),(136,22,'2.3',1,'ພາກວິຊາຄະນິດສາດ',NULL,190000.00,0.00,0.00,NULL,NULL),(137,22,'2.3',2,'ພາກວິຊາຟິຊິກສາດ',NULL,190000.00,0.00,0.00,NULL,NULL),(138,22,'2.3',3,'ພາກວິຊາເຄມີສາດ',NULL,190000.00,0.00,0.00,NULL,NULL),(139,22,'2.3',4,'ພາກວິຊາຊີວະວິທະຍາ',NULL,190000.00,0.00,0.00,NULL,NULL),(140,22,'2.3',5,'ພາກວິຊາວິທະຍາສາດຄອມພິວເຕີ',NULL,190000.00,0.00,0.00,NULL,NULL),(141,23,'2.4',0,'ຄະນະບໍດີ',NULL,0.00,12.00,0.00,'ຈ່າຍງົບລັດ',NULL),(142,23,'2.4',1,'ຮອງຄະນະບໍດີ',NULL,0.00,12.00,0.00,'ຈ່າຍງົບລັດ',NULL),(143,23,'2.4',2,'ຫົວໜ້າພາກວິຊາ',NULL,0.00,12.00,0.00,'ຈ່າຍງົບລັດ',NULL),(144,23,'2.4',3,'ຫົວໜ້າພະແນກ',NULL,0.00,12.00,0.00,'ຈ່າຍງົບລັດ',NULL),(145,23,'2.4',4,'ຮອງຫົວໜ້າພາກວິຊາ',NULL,0.00,12.00,0.00,'ຈ່າຍງົບລັດ',NULL),(146,23,'2.4',5,'ຮອງຫົວໜ້າພະແນກ',NULL,0.00,12.00,0.00,'ຈ່າຍງົບລັດ',NULL),(147,23,'2.4',6,'ຫົວໜ້າໜ່ວຍງານ, ເລຂາ',NULL,0.00,12.00,0.00,'ຈ່າຍງົບລັດ',NULL),(148,23,'2.4',7,'ຫົວໜ້າໜ່ວຍວິຊາ',NULL,0.00,12.00,0.00,'ຈ່າຍງົບລັດ',NULL),(149,23,'2.4',8,'ໜ່ວຍງານ, ສາມອົງການ',NULL,0.00,12.00,0.00,'ຈ່າຍງົບລັດ',NULL),(150,23,'2.4',9,'ສາມອົງການຈັດຕັ້ງມະຫາຊົນ',NULL,0.00,12.00,0.00,'ຈ່າຍງົບລັດ',NULL),(151,24,'2.4',0,'ຄະນະບໍດີ',NULL,500000.00,0.00,0.00,'ໃຊ້ງົບລັດ',NULL),(152,24,'2.4',1,'ຮອງຄະນະບໍດີ, ຫົວໜ້າພາກວິຊາ',NULL,400000.00,0.00,0.00,'ໃຊ້ງົບລັດ',NULL),(153,24,'2.4',2,'ຫົວໜ້າພະແນກ, ຮອງພາກວິຊາ',NULL,200000.00,0.00,0.00,'ໃຊ້ງົບລັດ',NULL),(154,24,'2.4',3,'ຮອງຫົວໜ້າພະແນກ, ຮສ ແລະ ຫົວໜ້າໜ່ວຍວິຊາ',NULL,150000.00,0.00,0.00,'ໃຊ້ງົບລັດ',NULL),(155,24,'2.4',4,'ຮອງຫົວໜ້າໜ່ວຍວິຊາ, ຫົວໜ້າໜ່ວຍງານ',NULL,80000.00,0.00,0.00,'ໃຊ້ງົບລັດ',NULL),(156,24,'2.4',5,'ຮອງຫົວໜ້າໜ່ວຍງານ',NULL,70000.00,0.00,0.00,'ໃຊ້ງົບລັດ',NULL),(157,24,'2.4',6,'ອາຈານ ແລະ ພະນັກງານທົ່ວໄປ',NULL,50000.00,0.00,0.00,'ໃຊ້ງົບລັດ',NULL),(158,25,'2.4',0,'ຄ່າແຮງງານພະນັກງານສັນຍາຈ້າງສຳນັກ',NULL,2000000.00,0.00,0.00,NULL,NULL),(159,25,'2.4',1,'ຄ່າແຮງງານພະນັກງານສັນຍາຈ້າງຂັບລົດ',NULL,2000000.00,0.00,0.00,NULL,NULL),(160,25,'2.4',2,'ສັນຍາຈ້າງບຳລຸງຮັກສາລະບົບ ICT',NULL,1000000.00,0.00,0.00,NULL,NULL),(161,26,'2.4',0,'ອຸດໜູນພະນັກງານລົງທະບຽນ',NULL,35000000.00,2.00,0.00,NULL,NULL),(162,26,'2.4',1,'ອຸດໜູນການສອບເສັງ',NULL,35000000.00,2.00,0.00,NULL,NULL),(163,26,'2.4',2,'ອຸດໜູນການກວດສອບງົບປະມານ',NULL,4500000.00,0.00,0.00,NULL,NULL),(164,26,'2.4',3,'ອຸດໜູນຕາມຂໍ້ຕົກລົງຕ່າງໆ',NULL,1000000.00,0.00,0.00,NULL,NULL),(165,26,'2.4',4,'ອຸດໜູນການບໍລິຫານເທີມສາມ',NULL,15000000.00,0.00,0.00,NULL,NULL),(166,26,'2.4',5,'ອຸດໜູນກະກຽມສະຫລຸບການເງິນ',NULL,12000000.00,1.00,0.00,NULL,NULL),(167,26,'2.4',6,'ອຸດໜູນການບໍລິຫານ ປໍໂທ',NULL,20000000.00,1.00,0.00,NULL,NULL),(168,26,'2.4',7,'ອຸດໜູນການນໍາພາບົດວິທະຍານິພົນ',NULL,20000000.00,0.00,0.00,NULL,NULL),(169,28,'2.5',0,'ຄ່າຊົ່ວໂມງສອນພາກພິເສດ',NULL,27655600.00,12.00,0.00,NULL,NULL),(170,28,'2.5',1,'ຄ່າຊົ່ວໂມງສອນເທີມສາມ',NULL,0.00,12.00,0.00,NULL,NULL),(171,28,'2.5',2,'ຄ່າຊົ່ວໂມງສອນປະລິນຍາໂທ',NULL,27194400.00,12.00,0.00,NULL,NULL),(172,29,'2.5',0,'ຄ່າກຳມະການສອບເສັງຈົບຊັ້ນ',NULL,2000000.00,0.00,0.00,NULL,NULL),(173,29,'2.5',1,'ຄ່າຍາມຫ້ອງເສັງ',NULL,6000000.00,0.00,0.00,NULL,NULL),(174,29,'2.5',2,'ຄ່າອອກຫົວບົດ ແລະ ກວດບົດ',NULL,4000000.00,0.00,0.00,NULL,NULL),(175,29,'2.5',3,'ຄ່າບໍລິການສອບເສັງ ປໍໂທ',NULL,0.00,0.00,0.00,NULL,NULL),(176,30,'2.5',0,'ຄ່າຊີ້ນຳບົດໂຄງການຈົບຊັ້ນ',NULL,0.00,50.00,0.00,NULL,NULL),(177,30,'2.5',1,'ຄ່າກຳມະການປ້ອງກັນບົດຈົບຊັ້ນ',NULL,0.00,1.00,0.00,NULL,NULL),(178,30,'2.5',2,'ຄ່າດຳເນີນບົດໂຄງການຈົບຊັ້ນ ປໍໂທ',NULL,0.00,6.00,0.00,NULL,NULL),(179,32,'2.6',0,'ບໍລິຈາກເລືອດຄັ້ງທີ I',NULL,50000.00,0.00,0.00,NULL,NULL),(180,32,'2.6',1,'ບໍລິຈາກເລືອດຄັ້ງທີ II',NULL,50000.00,0.00,0.00,NULL,NULL),(181,33,'2.6',0,'ການແຂ່ງຂັນກິລາຊາວໜຸ່ມ',NULL,200000.00,0.00,0.00,NULL,NULL),(182,33,'2.6',1,'ການເຄື່ອນໄຫວກິລາພາຍໃນ',NULL,200000.00,0.00,0.00,NULL,NULL),(183,33,'2.6',2,'ການເຄື່ອນໄຫວກິລາກັບທາງນອກ',NULL,200000.00,0.00,0.00,NULL,NULL),(184,33,'2.6',3,'ການເຄື່ອນໄຫວສິນລະປະ',NULL,200000.00,0.00,0.00,NULL,NULL),(185,33,'2.6',4,'ການຝຶກຊ້ອມສິນລະປະວັນນະຄະດີ',NULL,200000.00,0.00,0.00,NULL,NULL),(186,34,'2.6',0,'ອານາໄມຫ້ອງຮຽນ, ຫ້ອງການ',NULL,100000.00,0.00,0.00,NULL,NULL),(187,34,'2.6',1,'ອານາໄມສະຖານທີ່ຮັບຜິດຊອບ',NULL,100000.00,0.00,0.00,NULL,NULL),(188,34,'2.6',2,'ປຸກຕົ້ນໄມ້',NULL,100000.00,0.00,0.00,NULL,NULL),(189,35,'2.6',0,'ຄ່າເຊົ່າຫ້ອງປະຊຸມ 1 ວັນ',NULL,500000.00,0.00,0.00,NULL,NULL),(190,35,'2.6',1,'ຄ່ານ້ຳດື່ມມື້ຈັດງານ',NULL,500000.00,0.00,0.00,NULL,NULL),(191,35,'2.6',2,'ຄ່າຂັນລາງວັນ',NULL,500000.00,0.00,0.00,NULL,NULL),(192,35,'2.6',3,'ຄ່າອອກຄຳຖາມ',NULL,2000.00,0.00,0.00,NULL,NULL);
/*!40000 ALTER TABLE `expense_defaults` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `expense_items`
--

DROP TABLE IF EXISTS `expense_items`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `expense_items` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `plan_id` bigint unsigned NOT NULL,
  `parent_id` bigint unsigned DEFAULT NULL,
  `category_code` char(3) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sort_order` tinyint unsigned NOT NULL DEFAULT '0',
  `item_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `reference` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `amount_per_month` decimal(15,2) NOT NULL DEFAULT '0.00',
  `num_months` decimal(5,2) NOT NULL DEFAULT '12.00',
  `annual_total` decimal(15,2) NOT NULL DEFAULT '0.00',
  `notes` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `chart_of_account_id` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `expense_items_plan_id_foreign` (`plan_id`),
  KEY `expense_items_parent_id_foreign` (`parent_id`),
  KEY `expense_items_coa_fk` (`chart_of_account_id`),
  CONSTRAINT `expense_items_coa_fk` FOREIGN KEY (`chart_of_account_id`) REFERENCES `chart_of_accounts` (`id`) ON DELETE SET NULL,
  CONSTRAINT `expense_items_parent_id_foreign` FOREIGN KEY (`parent_id`) REFERENCES `expense_items` (`id`) ON DELETE SET NULL,
  CONSTRAINT `expense_items_plan_id_foreign` FOREIGN KEY (`plan_id`) REFERENCES `expense_plans` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=647 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `expense_items`
--

LOCK TABLES `expense_items` WRITE;
/*!40000 ALTER TABLE `expense_items` DISABLE KEYS */;
INSERT INTO `expense_items` VALUES (298,5,NULL,'2.1',0,'ບໍລິຫານສັງລວມ','2.1.1',4810000.00,12.00,0.00,NULL,NULL),(311,5,NULL,'2.1',1,'ບຳລຸງຮັກສາ, ສ້ອມແປງ ແລະ ຕິດຕັ້ງ','2.1.2',6916666.67,12.00,0.00,NULL,138),(325,5,NULL,'2.1',2,'ສ້ອມແປງ ແລະ ປັບປຸງອາຄານຫ້ອງຮຽນ','2.1.3',4500000.00,12.00,0.00,NULL,136),(328,5,NULL,'2.1',3,'ສ້ອມແປງພາຫານະ','2.1.4',558333.33,12.00,0.00,NULL,137),(331,5,NULL,'2.1',4,'ຊື້ເຄື່ອງຈັກ, ວັດຖຸອຸປະກອນ','2.1.5',2083333.33,12.00,0.00,NULL,NULL),(336,5,NULL,'2.1',5,'ຄ່າປະກັນໄພພາຫະນະ','2.1.6',341666.67,12.00,0.00,NULL,147),(338,5,NULL,'2.1',6,'ລາຍຈ່າຍໄປວຽກທາງການ','2.1.7',1333333.33,12.00,0.00,NULL,NULL),(341,5,NULL,'2.1',7,'ປົກປັກຮັກສາ ແລະ ອານາໄມອາຄານ, ສະຖານທີ່','2.1.8',12000000.00,12.00,0.00,NULL,136),(344,5,NULL,'2.1',8,'ວຽກງານກິດຈະກຳນັກສຶກສາ','2.1.9',5000000.00,1.00,0.00,NULL,200),(347,5,NULL,'2.1',9,'ລາຍຈ່າຍກອງປະຊຸມ, ສຳມະນາ ແລະ ຝຶກອົບຮົມ','2.1.10',420000.00,12.00,0.00,NULL,163),(360,5,NULL,'2.1',10,'ລາຍຈ່າຍບໍລິຫານປົກກະຕິອື່ນໆ','2.1.11',3007541.00,12.00,0.00,NULL,175),(361,5,NULL,'2.2',0,'ຊື້ວັດຖຸ, ອຸປະກອນການຮຽນ ແລະ ການສິດສອນ','2.2.1',2166666.67,12.00,0.00,NULL,NULL),(364,5,NULL,'2.2',1,'ປັບປຸງ ແລະ ພັດທະນາການສຶກສາ (ປັບປຸງຫຼັກສູດ, ພິມປື້ມ)','2.2.2',0.00,12.00,0.00,NULL,193),(370,5,NULL,'2.2',2,'ບຳລຸງຫ້ອງທົດລອງ','2.2.3',2833333.00,12.00,0.00,NULL,138),(377,5,NULL,'2.2',3,'ຊື້ອຸປະກອນທົດລອງ','2.2.4',40333333.33,12.00,0.00,NULL,NULL),(383,5,NULL,'2.2',4,'ລາຍຈ່າຍກອງປະຊຸມວິຊາການ','2.2.5',1050000.00,12.00,0.00,NULL,164),(387,5,NULL,'2.2',5,'ບຳລຸງຫ້ອງອ່ານ','2.2.6',916666.67,12.00,0.00,NULL,123),(390,5,NULL,'2.2',6,'ການຍົກລະດັບໄລຍະຍາວ','2.2.7',0.00,12.00,0.00,NULL,165),(392,5,NULL,'2.2',7,'ລາຍຈ່າຍຕິດຕາມການປະຕິບັດຫຼັກສູດ','2.2.8',0.00,12.00,0.00,NULL,160),(394,5,NULL,'2.3',0,'ບໍລິຫານວິຊາການ','2.3.1',2083335.00,12.00,0.00,NULL,193),(411,5,NULL,'2.3',1,'ບູລະນະ ແລະ ປົກປັກຮັກສາວັດທະນະທຳ','2.3.2',1644500.00,12.00,0.00,NULL,198),(418,5,NULL,'2.3',2,'ໄປທັດສະນະສຶກສາ','2.3.3',0.00,12.00,0.00,NULL,160),(425,5,NULL,'2.4',0,'ອຸດໜູນຄ່າບັດໂທລະສັບປະຈຳຕຳແໜ່ງ','2.4.1',0.00,12.00,0.00,NULL,151),(436,5,NULL,'2.4',1,'ອຸດໜູນຄ່ານ້ຳມັນປະຈຳຕຳແໜ່ງ','2.4.2',0.00,12.00,0.00,NULL,114),(444,5,NULL,'2.4',2,'ເງິນເດືອນສັນຍາຈ້າງ ແລະ ຄ່າແຮງງານ','2.4.3',0.00,12.00,0.00,NULL,175),(448,5,NULL,'2.4',3,'ອຸດໜູນການເຮັດວຽກເພີ່ມ','2.4.4',14333333.33,12.00,0.00,NULL,175),(457,5,NULL,'2.4',4,'ອຸດໜູນຄ່າຄອງຊີບ','2.4.5',0.00,12.00,0.00,NULL,175),(458,5,NULL,'2.5',0,'ຄ່າສອນລະບົບພິເສດ','2.5.1',54850000.00,12.00,0.00,NULL,175),(462,5,NULL,'2.5',1,'ຄ່າບໍລິການສອບເສັງ','2.5.2',0.00,0.00,0.00,NULL,175),(467,5,NULL,'2.5',2,'ບົດໂຄງການຈົບຊັ້ນ','2.5.3',0.00,1.00,0.00,NULL,175),(471,5,NULL,'2.5',3,'ອຸດໜູນການລົງທະບຽນ','2.5.4',0.00,0.00,0.00,NULL,175),(472,5,NULL,'2.6',0,'ບໍລິຈາກເລືອດໃຫ້ອົງການກາແດງລາວ','2.6.1',0.00,1.00,0.00,NULL,200),(475,5,NULL,'2.6',1,'ເຄື່ອນໄຫວກິລາ ແລະ ສິນລະປະ','2.6.2',0.00,1.00,0.00,NULL,200),(481,5,NULL,'2.6',2,'ອອກແຮງງານລວມ','2.6.3',0.00,1.00,0.00,NULL,200),(485,5,NULL,'2.6',3,'ຖາມ-ຕອບວິທະຍາສາດ','2.6.4',0.00,1.00,0.00,NULL,200),(490,5,298,'2.1',0,'ເຄື່ອງໃຊ້ຫ້ອງການ',NULL,2800000.00,12.00,0.00,NULL,116),(491,5,298,'2.1',1,'ແບບພິມ',NULL,250000.00,12.00,0.00,NULL,117),(492,5,298,'2.1',2,'ວາລະສານ ແລະ ໜັງສືພິມ',NULL,0.00,12.00,0.00,NULL,118),(493,5,298,'2.1',3,'ຮັບແຂກ',NULL,800000.00,12.00,0.00,NULL,167),(494,5,298,'2.1',4,'ໂທລະສັບບໍລິຫານ',NULL,30000.00,12.00,0.00,NULL,151),(495,5,298,'2.1',5,'ຄ່າໄປສະນີ',NULL,0.00,12.00,0.00,NULL,150),(496,5,298,'2.1',6,'ຄ່າບໍລິການທະນາຄານ',NULL,30000.00,12.00,0.00,NULL,153),(497,5,298,'2.1',7,'ຊື້ຂອງຂັວນຂອງຕ້ອນ',NULL,400000.00,12.00,0.00,NULL,169),(498,5,298,'2.1',8,'ວັນບຸນລະດັບຊາດ',NULL,500000.00,12.00,0.00,NULL,170),(499,5,298,'2.1',9,'ອຸດໜູນວຽກປ້ອງກັນ',NULL,0.00,12.00,0.00,'ຂື້ນຢູ່ງົບລັດ',155),(500,5,298,'2.1',10,'ຄ່ານ້ຳມັນບໍລິຫານຫ້ອງການ',NULL,0.00,4.00,0.00,'ຂື້ນຢູ່ງົບລັດ',114),(501,5,298,'2.1',11,'ຄ່ານ້ຳມັນເຄື່ອງ',NULL,0.00,4.00,0.00,'ຂື້ນຢູ່ງົບລັດ',114),(502,5,311,'2.1',0,'ບຳລຸງຮັກສາຄອມພີວເຕີ',NULL,300000.00,30.00,0.00,NULL,NULL),(503,5,311,'2.1',1,'ບຳລຸງຮັກສາເຄື່ອງສາຍໂປຣເຈັກເຕີ',NULL,200000.00,25.00,0.00,NULL,NULL),(504,5,311,'2.1',2,'ບຳລຸງຮັກສາແອເຢັນ',NULL,500000.00,90.00,0.00,NULL,NULL),(505,5,311,'2.1',3,'ບຳລຸງຮັກສາຕູ້ເຢັນ + ຕູ້ນ້ຳເຢັນ',NULL,100000.00,20.00,0.00,NULL,NULL),(506,5,311,'2.1',4,'ບຳລຸງຮັກສາພັດລົມ',NULL,80000.00,100.00,0.00,NULL,NULL),(507,5,311,'2.1',5,'ບຳລຸງຮັກສາດອກໄຟ',NULL,10000.00,600.00,0.00,NULL,NULL),(508,5,311,'2.1',6,'ບຳລຸງຮັກສາເຄື່ອງພິມ',NULL,100000.00,20.00,0.00,NULL,NULL),(509,5,311,'2.1',7,'ບຳລຸງຮັກສາຈັກອັດສຳເນົາ',NULL,2000000.00,0.00,0.00,NULL,NULL),(510,5,311,'2.1',8,'ບຳລຸງຮັກສາໂທລະສັບ',NULL,50000.00,0.00,0.00,NULL,NULL),(511,5,311,'2.1',9,'ບຳລຸງຮັກສາກ້ອງຖ່າຍຮູບ',NULL,50000.00,0.00,0.00,NULL,NULL),(512,5,311,'2.1',10,'ບຳລຸງຮັກສາໂທລະທັດ',NULL,50000.00,0.00,0.00,NULL,NULL),(513,5,311,'2.1',11,'ຈັກປ້ຳນ້ຳອັດຕະໂນມັດ',NULL,1000000.00,4.00,0.00,NULL,NULL),(514,5,311,'2.1',12,'ຈັກຕັດຫຍ້າ',NULL,1000000.00,2.00,0.00,NULL,NULL),(515,5,325,'2.1',0,'ສ້ອມແປງອາຄານສໍານັກງານຕ່າງໆ',NULL,2000000.00,7.00,0.00,NULL,NULL),(516,5,325,'2.1',1,'ປັບປຸງອາຄານຫ້ອງຮຽນ-ຫ້ອງທົດລອງ',NULL,40000000.00,1.00,0.00,NULL,NULL),(517,5,328,'2.1',0,'ລົດຕູ້',NULL,2850000.00,2.00,0.00,NULL,NULL),(518,5,328,'2.1',1,'ລົດຈັກ',NULL,1000000.00,1.00,0.00,NULL,NULL),(519,5,331,'2.1',0,'ຊື້ ໂຕະ, ຕັ່ງ',NULL,150000.00,0.00,0.00,NULL,232),(520,5,331,'2.1',1,'ບຳລຸງຮັກສາ, ສ້ອມແປງ ໂຕະ, ຕັ່ງ',NULL,30000.00,0.00,0.00,NULL,138),(521,5,331,'2.1',2,'ຊື້ເຄື່ອງຈັກ ແລະ ວັດຖຸອຸປະກອນ',NULL,25000000.00,1.00,0.00,NULL,231),(522,5,331,'2.1',3,'ຊື້ພາຫະນະ',NULL,200000000.00,0.00,0.00,NULL,231),(523,5,336,'2.1',0,'ປະກັນໄພລົດໃຫຍ່',NULL,2050000.00,2.00,0.00,NULL,NULL),(524,5,338,'2.1',0,'ໄປວຽກທາງການພາຍໃນປະເທດ',NULL,16000000.00,1.00,0.00,NULL,160),(525,5,338,'2.1',1,'ໄປວຽກທາງການຕ່າງປະເທດ',NULL,0.00,1.00,0.00,NULL,161),(526,5,341,'2.1',0,'ບຳລຸງຮັກສາວິທະຍາເຂດ',NULL,2000000.00,12.00,0.00,NULL,NULL),(527,5,341,'2.1',1,'ອານາໄມອາຄານ',NULL,10000000.00,12.00,0.00,NULL,NULL),(528,5,344,'2.1',0,'ປະຖົມນິເທດນັກສຶກສາ',NULL,1500000.00,2.00,0.00,NULL,NULL),(529,5,344,'2.1',1,'ກວດສອບການປະຕິບັດລະບຽບວິໃນນັກສຶກສາ',NULL,400000.00,5.00,0.00,NULL,NULL),(530,5,347,'2.1',0,'ສຳນັກຄະນະບໍດີ',NULL,200000.00,12.00,0.00,NULL,NULL),(531,5,347,'2.1',1,'ພາວິຊາຄະນິດສາດ',NULL,20000.00,12.00,0.00,NULL,NULL),(532,5,347,'2.1',2,'ພາກວິຊາຟິຊິກສາດ',NULL,20000.00,12.00,0.00,NULL,NULL),(533,5,347,'2.1',3,'ພາກວິຊາເຄມີສາດ',NULL,20000.00,12.00,0.00,NULL,NULL),(534,5,347,'2.1',4,'ພາກວິຊາຊີວະວິທະຍາ',NULL,20000.00,12.00,0.00,NULL,NULL),(535,5,347,'2.1',5,'ພາກວິຊາວິທະຍາສາດຄອມພີວເຕີ',NULL,20000.00,12.00,0.00,NULL,NULL),(536,5,347,'2.1',6,'ພະແນກວິຊາການ',NULL,20000.00,12.00,0.00,NULL,NULL),(537,5,347,'2.1',7,'ພະແນກຈັດຕັ້ງສັງລວມ',NULL,20000.00,12.00,0.00,NULL,NULL),(538,5,347,'2.1',8,'ພະແນກການເງິນ-ຊັບສິນ',NULL,20000.00,12.00,0.00,NULL,NULL),(539,5,347,'2.1',9,'ພະແນກຄຸ້ມຄອງນັກສຶກສາ',NULL,20000.00,12.00,0.00,NULL,NULL),(540,5,347,'2.1',10,'ພະແນກຄົ້ນຄ້ວາ ແລະ ບໍລິການວິຊາການ',NULL,20000.00,12.00,0.00,NULL,NULL),(541,5,347,'2.1',11,'ພະແນກຫຼັງປະລິນຍາຕີ',NULL,20000.00,12.00,0.00,NULL,NULL),(542,5,361,'2.2',0,'ອຸປະກອນການຮຽນ-ການສອນ',NULL,1500000.00,12.00,0.00,NULL,121),(543,5,361,'2.2',1,'ອຸປະກອນການສອບເສັງ',NULL,4000000.00,2.00,0.00,NULL,123),(544,5,364,'2.2',0,'ພາກວິຊາຄະນິດສາດ',NULL,0.00,1.00,0.00,NULL,NULL),(545,5,364,'2.2',1,'ພາກວິຊາຟີຊິກສາດ',NULL,0.00,1.00,0.00,NULL,NULL),(546,5,364,'2.2',2,'ພາກວິຊາເຄມີສາດ',NULL,0.00,1.00,0.00,NULL,NULL),(547,5,364,'2.2',3,'ພາກວິຊາຊີວະວິທະຍາ',NULL,0.00,1.00,0.00,NULL,NULL),(548,5,364,'2.2',4,'ພາກວິຊາວິທະຍາສາດຄອມພີວເຕີ',NULL,0.00,1.00,0.00,NULL,NULL),(549,5,370,'2.2',0,'ພາກວິຊາຄະນິດສາດ',NULL,250000.00,12.00,0.00,NULL,NULL),(550,5,370,'2.2',1,'ພາກວິຊາຟິຊິກສາດ',NULL,500000.00,12.00,0.00,NULL,NULL),(551,5,370,'2.2',2,'ພາກວິຊາເຄມີສາດ',NULL,500000.00,12.00,0.00,NULL,NULL),(552,5,370,'2.2',3,'ພາກວິຊາຊີວະວິທະຍາ',NULL,500000.00,12.00,0.00,NULL,NULL),(553,5,370,'2.2',4,'ພາກວິຊາວິທະຍາສາດຄອມພິວເຕີ',NULL,1083333.00,12.00,0.00,NULL,NULL),(554,5,370,'2.2',5,'ຊື້ອຸປະກອນທົດລອງ',NULL,0.00,12.00,0.00,NULL,NULL),(555,5,377,'2.2',0,'ອຸປະກອນທົດລອງຟິຊິກສາດ',NULL,32000000.00,0.00,0.00,NULL,123),(556,5,377,'2.2',1,'ອຸປະກອນທົດລອງເຄມີສາດ',NULL,32000000.00,0.00,0.00,NULL,123),(557,5,377,'2.2',2,'ອຸປະກອນທົດລອງຊີວະວິທະຍາ',NULL,32000000.00,0.00,0.00,NULL,123),(558,5,377,'2.2',3,'ຄອມພິວເຕີຕັ້ງໂຕະ (PC)',NULL,12100000.00,40.00,0.00,NULL,231),(559,5,377,'2.2',4,'ໂປຣເຈັກເຕີໃສ່ຫ້ອງຮຽນ',NULL,5300000.00,0.00,0.00,NULL,231),(560,5,383,'2.2',0,'ພິທີສະຫຼຸບຊຸດຮຽນ ແລະ ເປີດສົກໃໝ່ ປໍໂທ',NULL,2300000.00,1.00,0.00,NULL,NULL),(561,5,383,'2.2',1,'ກອງປະຊຸມສຳມະນາວິຊາການ ປໍໂທ',NULL,7150000.00,1.00,0.00,NULL,NULL),(562,5,383,'2.2',2,'ກອງປະຊຸມຜູ້ຊົງຄຸນວຸດທິ ປໍໂທ',NULL,3150000.00,1.00,0.00,NULL,NULL),(563,5,387,'2.2',0,'ຊື້ປື້ມໃສ່ຫ້ອງອ່ານ',NULL,425000.00,20.00,0.00,NULL,NULL),(564,5,387,'2.2',1,'ຊື້ຮ້ານປື້ມໃສ່ຫ້ອງອ່ານ',NULL,2500000.00,1.00,0.00,NULL,NULL),(565,5,390,'2.2',0,'ສົ່ງພະນັກງານໄປຍົກລະດັບໄລຍະຍາວ',NULL,0.00,1.00,0.00,NULL,NULL),(566,5,392,'2.2',0,'ງົບປະມານຕິດຕາມຫຼັກສູດ ປໍໂທ',NULL,0.00,1.00,0.00,NULL,NULL),(567,5,394,'2.3',0,'ສົ່ງເສີມວິຊາການສ່ວນກາງ',NULL,0.00,12.00,0.00,NULL,NULL),(568,5,394,'2.3',1,'ກອງປະຊຸມສຳມະນາການເງິນ (ພະແນກການເງິນ)',NULL,0.00,12.00,0.00,'ຂື້ນຢູ່ພາກ 62',NULL),(569,5,394,'2.3',2,'ພະແນກບໍລິຫານສັງລວມ',NULL,0.00,12.00,0.00,'ຂື້ນຢູ່ພາກ 62',NULL),(570,5,394,'2.3',3,'ໜ່ວຍງານ ICT',NULL,0.00,12.00,0.00,'ຂື້ນຢູ່ພາກ 62',NULL),(571,5,394,'2.3',4,'ຫຼັງປະລິນຍາຕີ',NULL,0.00,12.00,0.00,'ຂື້ນຢູ່ພາກ 62',NULL),(572,5,394,'2.3',5,'ຄົ້ນຄ້ວາ ແລະ ບໍລິການວິຊາການ',NULL,0.00,12.00,0.00,'ຂື້ນຢູ່ພາກ 62',NULL),(573,5,394,'2.3',6,'ພັດທະນາຫຸ່ນຍົນ (Robot)',NULL,0.00,12.00,0.00,'ຂື້ນຢູ່ພາກ 62',NULL),(574,5,394,'2.3',7,'ພະແນກວິຊາການ',NULL,0.00,12.00,0.00,'ຂື້ນຢູ່ພາກ 62',NULL),(575,5,394,'2.3',8,'ພະແນກຄຸ້ມຄອງນັກສຶກສາ',NULL,0.00,12.00,0.00,'ຂື້ນຢູ່ພາກ 62',NULL),(576,5,394,'2.3',9,'ພາກວິຊາຄະນິດສາດ',NULL,416667.00,12.00,0.00,NULL,NULL),(577,5,394,'2.3',10,'ພາກວິຊາຟີຊິກສາດ',NULL,416667.00,12.00,0.00,NULL,NULL),(578,5,394,'2.3',11,'ພາກວິຊາເຄມີສາດ',NULL,416667.00,12.00,0.00,NULL,NULL),(579,5,394,'2.3',12,'ພາກວິຊາຊີວະວິທະຍາ',NULL,416667.00,12.00,0.00,NULL,NULL),(580,5,394,'2.3',13,'ພາກວິຊາວິທະຍາສາດຄອມພີວເຕີ',NULL,416667.00,12.00,0.00,NULL,NULL),(581,5,394,'2.3',14,'ສາມອົງການຈັດຕັ້ງມະຫາຊົນ',NULL,0.00,12.00,0.00,NULL,NULL),(582,5,394,'2.3',15,'ເຄື່ອນໄຫວວຽກວິຊາການອື່ນໆ',NULL,0.00,4.00,0.00,NULL,NULL),(583,5,411,'2.3',0,'ສຳນັກຄະນະບໍດີ',NULL,1041667.00,12.00,0.00,NULL,NULL),(584,5,411,'2.3',1,'ພາກວິຊາຄະນິດສາດ',NULL,81167.00,12.00,0.00,NULL,NULL),(585,5,411,'2.3',2,'ພາກວິຊາຟິຊິກສາດ',NULL,49500.00,12.00,0.00,NULL,NULL),(586,5,411,'2.3',3,'ພາກວິຊາເຄມີສາດ',NULL,70750.00,12.00,0.00,NULL,NULL),(587,5,411,'2.3',4,'ພາກວິຊາຊີວະວິທະຍາ',NULL,51083.00,12.00,0.00,NULL,NULL),(588,5,411,'2.3',5,'ພາກວິຊາວິທະຍາສາດຄອມພິວເຕີ',NULL,350333.00,12.00,0.00,NULL,NULL),(589,5,418,'2.3',0,'ສຳນັກຄະນະບໍດີ',NULL,190000.00,0.00,0.00,NULL,NULL),(590,5,418,'2.3',1,'ພາກວິຊາຄະນິດສາດ',NULL,190000.00,0.00,0.00,NULL,NULL),(591,5,418,'2.3',2,'ພາກວິຊາຟິຊິກສາດ',NULL,190000.00,0.00,0.00,NULL,NULL),(592,5,418,'2.3',3,'ພາກວິຊາເຄມີສາດ',NULL,190000.00,0.00,0.00,NULL,NULL),(593,5,418,'2.3',4,'ພາກວິຊາຊີວະວິທະຍາ',NULL,190000.00,0.00,0.00,NULL,NULL),(594,5,418,'2.3',5,'ພາກວິຊາວິທະຍາສາດຄອມພິວເຕີ',NULL,190000.00,0.00,0.00,NULL,NULL),(595,5,425,'2.4',0,'ຄະນະບໍດີ',NULL,0.00,12.00,0.00,'ຈ່າຍງົບລັດ',NULL),(596,5,425,'2.4',1,'ຮອງຄະນະບໍດີ',NULL,0.00,12.00,0.00,'ຈ່າຍງົບລັດ',NULL),(597,5,425,'2.4',2,'ຫົວໜ້າພາກວິຊາ',NULL,0.00,12.00,0.00,'ຈ່າຍງົບລັດ',NULL),(598,5,425,'2.4',3,'ຫົວໜ້າພະແນກ',NULL,0.00,12.00,0.00,'ຈ່າຍງົບລັດ',NULL),(599,5,425,'2.4',4,'ຮອງຫົວໜ້າພາກວິຊາ',NULL,0.00,12.00,0.00,'ຈ່າຍງົບລັດ',NULL),(600,5,425,'2.4',5,'ຮອງຫົວໜ້າພະແນກ',NULL,0.00,12.00,0.00,'ຈ່າຍງົບລັດ',NULL),(601,5,425,'2.4',6,'ຫົວໜ້າໜ່ວຍງານ, ເລຂາ',NULL,0.00,12.00,0.00,'ຈ່າຍງົບລັດ',NULL),(602,5,425,'2.4',7,'ຫົວໜ້າໜ່ວຍວິຊາ',NULL,0.00,12.00,0.00,'ຈ່າຍງົບລັດ',NULL),(603,5,425,'2.4',8,'ໜ່ວຍງານ, ສາມອົງການ',NULL,0.00,12.00,0.00,'ຈ່າຍງົບລັດ',NULL),(604,5,425,'2.4',9,'ສາມອົງການຈັດຕັ້ງມະຫາຊົນ',NULL,0.00,12.00,0.00,'ຈ່າຍງົບລັດ',NULL),(605,5,436,'2.4',0,'ຄະນະບໍດີ',NULL,500000.00,0.00,0.00,'ໃຊ້ງົບລັດ',NULL),(606,5,436,'2.4',1,'ຮອງຄະນະບໍດີ, ຫົວໜ້າພາກວິຊາ',NULL,400000.00,0.00,0.00,'ໃຊ້ງົບລັດ',NULL),(607,5,436,'2.4',2,'ຫົວໜ້າພະແນກ, ຮອງພາກວິຊາ',NULL,200000.00,0.00,0.00,'ໃຊ້ງົບລັດ',NULL),(608,5,436,'2.4',3,'ຮອງຫົວໜ້າພະແນກ, ຮສ ແລະ ຫົວໜ້າໜ່ວຍວິຊາ',NULL,150000.00,0.00,0.00,'ໃຊ້ງົບລັດ',NULL),(609,5,436,'2.4',4,'ຮອງຫົວໜ້າໜ່ວຍວິຊາ, ຫົວໜ້າໜ່ວຍງານ',NULL,80000.00,0.00,0.00,'ໃຊ້ງົບລັດ',NULL),(610,5,436,'2.4',5,'ຮອງຫົວໜ້າໜ່ວຍງານ',NULL,70000.00,0.00,0.00,'ໃຊ້ງົບລັດ',NULL),(611,5,436,'2.4',6,'ອາຈານ ແລະ ພະນັກງານທົ່ວໄປ',NULL,50000.00,0.00,0.00,'ໃຊ້ງົບລັດ',NULL),(612,5,444,'2.4',0,'ຄ່າແຮງງານພະນັກງານສັນຍາຈ້າງສຳນັກ',NULL,2000000.00,0.00,0.00,NULL,NULL),(613,5,444,'2.4',1,'ຄ່າແຮງງານພະນັກງານສັນຍາຈ້າງຂັບລົດ',NULL,2000000.00,0.00,0.00,NULL,NULL),(614,5,444,'2.4',2,'ສັນຍາຈ້າງບຳລຸງຮັກສາລະບົບ ICT',NULL,1000000.00,0.00,0.00,NULL,NULL),(615,5,448,'2.4',0,'ອຸດໜູນພະນັກງານລົງທະບຽນ',NULL,35000000.00,2.00,0.00,NULL,NULL),(616,5,448,'2.4',1,'ອຸດໜູນການສອບເສັງ',NULL,35000000.00,2.00,0.00,NULL,NULL),(617,5,448,'2.4',2,'ອຸດໜູນການກວດສອບງົບປະມານ',NULL,4500000.00,0.00,0.00,NULL,NULL),(618,5,448,'2.4',3,'ອຸດໜູນຕາມຂໍ້ຕົກລົງຕ່າງໆ',NULL,1000000.00,0.00,0.00,NULL,NULL),(619,5,448,'2.4',4,'ອຸດໜູນການບໍລິຫານເທີມສາມ',NULL,15000000.00,0.00,0.00,NULL,NULL),(620,5,448,'2.4',5,'ອຸດໜູນກະກຽມສະຫລຸບການເງິນ',NULL,12000000.00,1.00,0.00,NULL,NULL),(621,5,448,'2.4',6,'ອຸດໜູນການບໍລິຫານ ປໍໂທ',NULL,20000000.00,1.00,0.00,NULL,NULL),(622,5,448,'2.4',7,'ອຸດໜູນການນໍາພາບົດວິທະຍານິພົນ',NULL,20000000.00,0.00,0.00,NULL,NULL),(623,5,458,'2.5',0,'ຄ່າຊົ່ວໂມງສອນພາກພິເສດ',NULL,27655600.00,12.00,0.00,NULL,NULL),(624,5,458,'2.5',1,'ຄ່າຊົ່ວໂມງສອນເທີມສາມ',NULL,0.00,12.00,0.00,NULL,NULL),(625,5,458,'2.5',2,'ຄ່າຊົ່ວໂມງສອນປະລິນຍາໂທ',NULL,27194400.00,12.00,0.00,NULL,NULL),(626,5,462,'2.5',0,'ຄ່າກຳມະການສອບເສັງຈົບຊັ້ນ',NULL,2000000.00,0.00,0.00,NULL,NULL),(627,5,462,'2.5',1,'ຄ່າຍາມຫ້ອງເສັງ',NULL,6000000.00,0.00,0.00,NULL,NULL),(628,5,462,'2.5',2,'ຄ່າອອກຫົວບົດ ແລະ ກວດບົດ',NULL,4000000.00,0.00,0.00,NULL,NULL),(629,5,462,'2.5',3,'ຄ່າບໍລິການສອບເສັງ ປໍໂທ',NULL,0.00,0.00,0.00,NULL,NULL),(630,5,467,'2.5',0,'ຄ່າຊີ້ນຳບົດໂຄງການຈົບຊັ້ນ',NULL,0.00,50.00,0.00,NULL,NULL),(631,5,467,'2.5',1,'ຄ່າກຳມະການປ້ອງກັນບົດຈົບຊັ້ນ',NULL,0.00,1.00,0.00,NULL,NULL),(632,5,467,'2.5',2,'ຄ່າດຳເນີນບົດໂຄງການຈົບຊັ້ນ ປໍໂທ',NULL,0.00,6.00,0.00,NULL,NULL),(633,5,472,'2.6',0,'ບໍລິຈາກເລືອດຄັ້ງທີ I',NULL,50000.00,0.00,0.00,NULL,NULL),(634,5,472,'2.6',1,'ບໍລິຈາກເລືອດຄັ້ງທີ II',NULL,50000.00,0.00,0.00,NULL,NULL),(635,5,475,'2.6',0,'ການແຂ່ງຂັນກິລາຊາວໜຸ່ມ',NULL,200000.00,0.00,0.00,NULL,NULL),(636,5,475,'2.6',1,'ການເຄື່ອນໄຫວກິລາພາຍໃນ',NULL,200000.00,0.00,0.00,NULL,NULL),(637,5,475,'2.6',2,'ການເຄື່ອນໄຫວກິລາກັບທາງນອກ',NULL,200000.00,0.00,0.00,NULL,NULL),(638,5,475,'2.6',3,'ການເຄື່ອນໄຫວສິນລະປະ',NULL,200000.00,0.00,0.00,NULL,NULL),(639,5,475,'2.6',4,'ການຝຶກຊ້ອມສິນລະປະວັນນະຄະດີ',NULL,200000.00,0.00,0.00,NULL,NULL),(640,5,481,'2.6',0,'ອານາໄມຫ້ອງຮຽນ, ຫ້ອງການ',NULL,100000.00,0.00,0.00,NULL,NULL),(641,5,481,'2.6',1,'ອານາໄມສະຖານທີ່ຮັບຜິດຊອບ',NULL,100000.00,0.00,0.00,NULL,NULL),(642,5,481,'2.6',2,'ປຸກຕົ້ນໄມ້',NULL,100000.00,0.00,0.00,NULL,NULL),(643,5,485,'2.6',0,'ຄ່າເຊົ່າຫ້ອງປະຊຸມ 1 ວັນ',NULL,500000.00,0.00,0.00,NULL,NULL),(644,5,485,'2.6',1,'ຄ່ານ້ຳດື່ມມື້ຈັດງານ',NULL,500000.00,0.00,0.00,NULL,NULL),(645,5,485,'2.6',2,'ຄ່າຂັນລາງວັນ',NULL,500000.00,0.00,0.00,NULL,NULL),(646,5,485,'2.6',3,'ຄ່າອອກຄຳຖາມ',NULL,2000.00,0.00,0.00,NULL,NULL);
/*!40000 ALTER TABLE `expense_items` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `expense_plans`
--

DROP TABLE IF EXISTS `expense_plans`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `expense_plans` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `fiscal_year` smallint unsigned NOT NULL,
  `status` enum('DRAFT','APPROVED') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'DRAFT',
  `created_by` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `expense_plans_fiscal_year_unique` (`fiscal_year`),
  KEY `expense_plans_created_by_foreign` (`created_by`),
  CONSTRAINT `expense_plans_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `expense_plans`
--

LOCK TABLES `expense_plans` WRITE;
/*!40000 ALTER TABLE `expense_plans` DISABLE KEYS */;
INSERT INTO `expense_plans` VALUES (5,2027,'DRAFT',2,'2026-05-10 17:18:12','2026-05-10 17:18:12');
/*!40000 ALTER TABLE `expense_plans` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `expense_sub_items`
--

DROP TABLE IF EXISTS `expense_sub_items`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `expense_sub_items` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `expense_item_id` bigint unsigned NOT NULL,
  `sort_order` tinyint unsigned NOT NULL DEFAULT '0',
  `item_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `col_a` decimal(15,2) DEFAULT NULL,
  `col_b` decimal(15,2) DEFAULT NULL,
  `col_c` decimal(15,2) DEFAULT NULL,
  `total` decimal(15,2) NOT NULL DEFAULT '0.00',
  `notes` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `expense_sub_items_expense_item_id_foreign` (`expense_item_id`),
  CONSTRAINT `expense_sub_items_expense_item_id_foreign` FOREIGN KEY (`expense_item_id`) REFERENCES `expense_items` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `expense_sub_items`
--

LOCK TABLES `expense_sub_items` WRITE;
/*!40000 ALTER TABLE `expense_sub_items` DISABLE KEYS */;
/*!40000 ALTER TABLE `expense_sub_items` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `failed_jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `failed_jobs`
--

LOCK TABLES `failed_jobs` WRITE;
/*!40000 ALTER TABLE `failed_jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `failed_jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `income_items`
--

DROP TABLE IF EXISTS `income_items`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `income_items` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `income_plan_id` bigint unsigned NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sort_order` smallint unsigned NOT NULL DEFAULT '0',
  `student_count` int unsigned DEFAULT NULL,
  `credit_amount` decimal(20,2) DEFAULT NULL,
  `nuol_percent` decimal(8,4) DEFAULT NULL,
  `fns_percent` decimal(8,4) DEFAULT NULL,
  `course_rate` decimal(20,2) DEFAULT NULL,
  `total_income` decimal(20,2) DEFAULT NULL,
  `nuol_amount` decimal(20,2) DEFAULT NULL,
  `fns_amount` decimal(20,2) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `income_items_income_plan_id_foreign` (`income_plan_id`),
  CONSTRAINT `income_items_income_plan_id_foreign` FOREIGN KEY (`income_plan_id`) REFERENCES `income_plans` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `income_items`
--

LOCK TABLES `income_items` WRITE;
/*!40000 ALTER TABLE `income_items` DISABLE KEYS */;
INSERT INTO `income_items` VALUES (1,1,'ລາຍຮັບຄ່າໜ່ວຍກິດນັກຮຽນແຕ່ປີ 2-4 ລະບົບຈ່າຍເງິນ ແລະ ປະລິນຍາໂທ',1,NULL,NULL,NULL,NULL,0.00,0.00,0.00,0.00,'2026-05-08 17:20:06','2026-05-08 17:20:21'),(2,1,'ລາຍຮັບຄ່າລົງທະບຽນນັກສຶກສາປີທີ 2-4 ຂອງ ຄວທ',2,NULL,NULL,NULL,NULL,0.00,0.00,0.00,0.00,'2026-05-08 17:20:06','2026-05-08 17:20:21'),(3,1,'ລາຍຮັບຄ່າໜ່ວຍກິດປີ 1 ລະບົບຈ່າຍເງິນ',3,NULL,NULL,NULL,NULL,0.00,0.00,0.00,0.00,'2026-05-08 17:20:06','2026-05-08 17:20:21'),(4,1,'ຄ່າລົງທະບຽນນັກສຶກສາປີທີ 1 ລະບົບຈ່າຍເງິນຂອງ ຄວທ',4,NULL,NULL,NULL,NULL,0.00,0.00,0.00,0.00,'2026-05-08 17:20:06','2026-05-08 17:20:21');
/*!40000 ALTER TABLE `income_items` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `income_plans`
--

DROP TABLE IF EXISTS `income_plans`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `income_plans` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `fiscal_year` smallint unsigned NOT NULL,
  `created_by` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `income_plans_fiscal_year_unique` (`fiscal_year`),
  KEY `income_plans_created_by_foreign` (`created_by`),
  CONSTRAINT `income_plans_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `income_plans`
--

LOCK TABLES `income_plans` WRITE;
/*!40000 ALTER TABLE `income_plans` DISABLE KEYS */;
INSERT INTO `income_plans` VALUES (1,2027,2,'2026-05-08 17:20:06','2026-05-08 17:20:06');
/*!40000 ALTER TABLE `income_plans` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `income_settings`
--

DROP TABLE IF EXISTS `income_settings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `income_settings` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `price_per_credit` decimal(20,2) NOT NULL DEFAULT '35000.00',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `income_settings`
--

LOCK TABLES `income_settings` WRITE;
/*!40000 ALTER TABLE `income_settings` DISABLE KEYS */;
INSERT INTO `income_settings` VALUES (1,35000.00,'2026-05-08 17:13:05','2026-05-08 17:13:05');
/*!40000 ALTER TABLE `income_settings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `job_batches`
--

DROP TABLE IF EXISTS `job_batches`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `job_batches` (
  `id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
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
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint unsigned NOT NULL,
  `reserved_at` int unsigned DEFAULT NULL,
  `available_at` int unsigned NOT NULL,
  `created_at` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_index` (`queue`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
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
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=47 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'2026_03_22_072919_add_remember_token_to_users_table',1),(2,'2026_03_28_172331_create_budget_plan_comments_table',2),(3,'2026_03_29_054518_add_submission_round_to_budget_plans_and_comments',2),(4,'2026_03_29_060012_add_marked_fields_to_budget_plan_comments',2),(5,'2026_04_09_142938_create_budget_plan_reviewers_table',3),(6,'2026_04_09_210000_create_budget_plan_reviewers_table',3),(7,'2026_04_09_210001_create_notifications_table',3),(8,'2026_04_09_224000_add_columns_to_budget_plan_reviewers_table',4),(9,'0001_01_01_000001_create_cache_table',5),(10,'0001_01_01_000002_create_jobs_table',5),(11,'2026_03_05_144217_create_sessions_table',5),(12,'2026_03_28_092812_add_type_to_transactions_table',5),(13,'2026_04_11_090824_add_category_to_transactions_table',5),(14,'2026_04_11_093109_make_account_id_nullable_in_transactions',5),(15,'2026_04_11_101751_create_advance_clearing_attachments_table',5),(16,'2026_04_11_110512_create_advance_clearing_items_table',6),(17,'2026_04_15_120000_ensure_transactions_type_column_exists',6),(18,'2026_04_15_180000_add_actor_role_name_to_request_workflow_logs_table',7),(19,'2026_04_15_200000_backfill_request_workflow_log_actor_roles',8),(20,'2026_04_15_210000_ensure_advance_clearing_attachments_columns',9),(23,'2026_05_08_000001_create_income_settings_table',10),(24,'2026_05_08_000002_create_income_plans_table',10),(25,'2026_05_08_000003_create_income_items_table',10),(26,'2026_05_09_005216_create_academic_income_tables',11),(27,'2026_05_09_100000_create_academic_income_defaults_table',12),(28,'2026_05_10_000001_add_rate_per_person_to_academic_income_defaults',13),(29,'2026_05_10_000002_add_extra_income_sections',14),(30,'2026_05_10_100001_create_expense_plans_table',15),(31,'2026_05_10_100002_create_expense_items_table',15),(32,'2026_05_10_100003_create_expense_defaults_table',15),(33,'2026_05_10_100004_seed_expense_defaults',15),(34,'2026_05_10_200000_fix_expense_defaults_amounts_and_names',16),(35,'2026_05_10_100005_create_expense_sub_items_table',17),(36,'2026_05_10_200001_add_annual_total_to_expense_tables',18),(37,'2026_05_11_000001_add_parent_id_to_expense_defaults',19),(38,'2026_05_11_000002_seed_expense_default_sub_items',19),(39,'2026_05_11_000003_add_parent_id_to_expense_items',20),(41,'2026_05_10_180600_create_salary_plans_table',21),(42,'2026_05_10_180601_create_salary_plan_items_table',21),(43,'2026_05_11_000004_backfill_expense_item_sub_items',21),(44,'2026_05_10_181534_create_salary_defaults_table',22),(45,'2026_05_11_100000_add_coa_to_expense_items',23),(46,'2026_05_11_100001_seed_expense_default_coa_mapping',24);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `notifications`
--

DROP TABLE IF EXISTS `notifications`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `notifications` (
  `id` char(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `notifiable_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `notifiable_id` bigint unsigned NOT NULL,
  `data` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `read_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `notifications_notifiable_type_notifiable_id_index` (`notifiable_type`,`notifiable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `notifications`
--

LOCK TABLES `notifications` WRITE;
/*!40000 ALTER TABLE `notifications` DISABLE KEYS */;
INSERT INTO `notifications` VALUES ('0676af07-b3fc-440b-bcfc-3cb60ee1bb6a','App\\Notifications\\BudgetPlanReviewRequested','App\\Models\\User',3,'{\"budget_plan_id\":11,\"fiscal_year\":2028,\"message\":\"\\u0ec1\\u0e9c\\u0e99\\u0e87\\u0ebb\\u0e9a\\u0e9b\\u0eb0\\u0ea1\\u0eb2\\u0e99\\u0e9b\\u0eb0\\u0e88\\u0eb3\\u0e9b\\u0eb5 2028 \\u0e95\\u0ec9\\u0ead\\u0e87\\u0e81\\u0eb2\\u0e99\\u0e84\\u0ea7\\u0eb2\\u0ea1\\u0e84\\u0eb4\\u0e94\\u0ec0\\u0eab\\u0eb1\\u0e99\\u0e88\\u0eb2\\u0e81\\u0e97\\u0ec8\\u0eb2\\u0e99\",\"type\":\"review_requested\",\"url\":\"http:\\/\\/127.0.0.1:8000\\/head-of-department\\/annual-budget\\/11\"}',NULL,'2026-04-13 07:29:17','2026-04-13 07:29:17'),('12517ed4-f012-4fec-8a18-821f2b9aa079','App\\Notifications\\BudgetPlanStatusChanged','App\\Models\\User',2,'{\"budget_plan_id\":10,\"fiscal_year\":2028,\"message\":\"\\u0ec1\\u0e9c\\u0e99\\u0e87\\u0ebb\\u0e9a\\u0e9b\\u0eb0\\u0ea1\\u0eb2\\u0e99\\u0e9b\\u0eb0\\u0e88\\u0eb3\\u0e9b\\u0eb5 2028 \\u0ec4\\u0e94\\u0ec9\\u0eae\\u0eb1\\u0e9a\\u0e81\\u0eb2\\u0e99\\u0ead\\u0eb0\\u0e99\\u0eb8\\u0ea1\\u0eb1\\u0e94\\u0ec1\\u0ea5\\u0ec9\\u0ea7\",\"type\":\"status_changed\",\"url\":\"http:\\/\\/127.0.0.1:8000\\/head-of-finance\\/annual-budget\\/10\"}','2026-04-12 17:01:09','2026-04-12 17:00:51','2026-04-12 17:01:09'),('235dc93c-7841-47ee-9497-b0f0b4fe7ff1','App\\Notifications\\BudgetPlanReviewRequested','App\\Models\\User',5,'{\"budget_plan_id\":7,\"fiscal_year\":2027,\"message\":\"\\u0ec1\\u0e9c\\u0e99\\u0e87\\u0ebb\\u0e9a\\u0e9b\\u0eb0\\u0ea1\\u0eb2\\u0e99\\u0e9b\\u0eb0\\u0e88\\u0eb3\\u0e9b\\u0eb5 2027 \\u0e95\\u0ec9\\u0ead\\u0e87\\u0e81\\u0eb2\\u0e99\\u0e84\\u0ea7\\u0eb2\\u0ea1\\u0e84\\u0eb4\\u0e94\\u0ec0\\u0eab\\u0eb1\\u0e99\\u0e88\\u0eb2\\u0e81\\u0e97\\u0ec8\\u0eb2\\u0e99\",\"type\":\"review_requested\",\"url\":\"http:\\/\\/127.0.0.1:8000\\/head-of-department\\/annual-budget\\/7\"}','2026-04-11 07:22:45','2026-04-11 07:10:40','2026-04-11 07:22:45'),('236703d2-716b-4cf8-ba00-dc6800cdb9dd','App\\Notifications\\BudgetPlanReviewRequested','App\\Models\\User',8,'{\"budget_plan_id\":8,\"fiscal_year\":2028,\"message\":\"\\u0ec1\\u0e9c\\u0e99\\u0e87\\u0ebb\\u0e9a\\u0e9b\\u0eb0\\u0ea1\\u0eb2\\u0e99\\u0e9b\\u0eb0\\u0e88\\u0eb3\\u0e9b\\u0eb5 2028 \\u0e95\\u0ec9\\u0ead\\u0e87\\u0e81\\u0eb2\\u0e99\\u0e84\\u0ea7\\u0eb2\\u0ea1\\u0e84\\u0eb4\\u0e94\\u0ec0\\u0eab\\u0eb1\\u0e99\\u0e88\\u0eb2\\u0e81\\u0e97\\u0ec8\\u0eb2\\u0e99\",\"type\":\"review_requested\",\"url\":\"http:\\/\\/127.0.0.1:8000\\/head-of-department\\/annual-budget\\/8\"}','2026-04-11 08:50:47','2026-04-11 08:50:17','2026-04-11 08:50:47'),('31353fb8-13e7-4f96-8f4a-fdddbd5af129','App\\Notifications\\BudgetPlanReviewRequested','App\\Models\\User',3,'{\"budget_plan_id\":7,\"fiscal_year\":2027,\"message\":\"\\u0ec1\\u0e9c\\u0e99\\u0e87\\u0ebb\\u0e9a\\u0e9b\\u0eb0\\u0ea1\\u0eb2\\u0e99\\u0e9b\\u0eb0\\u0e88\\u0eb3\\u0e9b\\u0eb5 2027 \\u0e95\\u0ec9\\u0ead\\u0e87\\u0e81\\u0eb2\\u0e99\\u0e84\\u0ea7\\u0eb2\\u0ea1\\u0e84\\u0eb4\\u0e94\\u0ec0\\u0eab\\u0eb1\\u0e99\\u0e88\\u0eb2\\u0e81\\u0e97\\u0ec8\\u0eb2\\u0e99\",\"type\":\"review_requested\",\"url\":\"http:\\/\\/127.0.0.1:8000\\/head-of-department\\/annual-budget\\/7\"}','2026-04-10 16:25:43','2026-04-10 16:20:41','2026-04-10 16:25:43'),('3663223b-608a-4b26-bcaf-4e4137016f28','App\\Notifications\\BudgetPlanReviewRequested','App\\Models\\User',5,'{\"budget_plan_id\":7,\"fiscal_year\":2027,\"message\":\"\\u0ec1\\u0e9c\\u0e99\\u0e87\\u0ebb\\u0e9a\\u0e9b\\u0eb0\\u0ea1\\u0eb2\\u0e99\\u0e9b\\u0eb0\\u0e88\\u0eb3\\u0e9b\\u0eb5 2027 \\u0e95\\u0ec9\\u0ead\\u0e87\\u0e81\\u0eb2\\u0e99\\u0e84\\u0ea7\\u0eb2\\u0ea1\\u0e84\\u0eb4\\u0e94\\u0ec0\\u0eab\\u0eb1\\u0e99\\u0e88\\u0eb2\\u0e81\\u0e97\\u0ec8\\u0eb2\\u0e99\",\"type\":\"review_requested\",\"url\":\"http:\\/\\/127.0.0.1:8000\\/head-of-department\\/annual-budget\\/7\"}','2026-04-11 07:22:50','2026-04-10 16:20:41','2026-04-11 07:22:50'),('3826d1a2-e4c3-4889-9638-0f8b61852c82','App\\Notifications\\BudgetPlanFinalApprovalRequested','App\\Models\\User',6,'{\"budget_plan_id\":9,\"fiscal_year\":2028,\"message\":\"\\u0ec1\\u0e9c\\u0e99\\u0e87\\u0ebb\\u0e9a\\u0e9b\\u0eb0\\u0ea1\\u0eb2\\u0e99\\u0e9b\\u0eb0\\u0e88\\u0eb3\\u0e9b\\u0eb5 2028 \\u0ea5\\u0ecd\\u0e96\\u0ec9\\u0eb2\\u0e81\\u0eb2\\u0e99\\u0ead\\u0eb0\\u0e99\\u0eb8\\u0ea1\\u0eb1\\u0e94\\u0e82\\u0eb1\\u0ec9\\u0e99\\u0eaa\\u0eb8\\u0e94\\u0e97\\u0ec9\\u0eb2\\u0e8d\",\"type\":\"final_approval_requested\",\"url\":\"http:\\/\\/127.0.0.1:8000\\/head-of-faculty\\/annual-budget\\/9\"}','2026-04-12 16:56:27','2026-04-12 16:55:52','2026-04-12 16:56:27'),('3ebbd3cd-f13a-4893-b4fe-94676da87378','App\\Notifications\\BudgetPlanReviewRequested','App\\Models\\User',3,'{\"budget_plan_id\":12,\"fiscal_year\":2028,\"message\":\"\\u0ec1\\u0e9c\\u0e99\\u0e87\\u0ebb\\u0e9a\\u0e9b\\u0eb0\\u0ea1\\u0eb2\\u0e99\\u0e9b\\u0eb0\\u0e88\\u0eb3\\u0e9b\\u0eb5 2028 \\u0e95\\u0ec9\\u0ead\\u0e87\\u0e81\\u0eb2\\u0e99\\u0e84\\u0ea7\\u0eb2\\u0ea1\\u0e84\\u0eb4\\u0e94\\u0ec0\\u0eab\\u0eb1\\u0e99\\u0e88\\u0eb2\\u0e81\\u0e97\\u0ec8\\u0eb2\\u0e99\",\"type\":\"review_requested\",\"url\":\"http:\\/\\/127.0.0.1:8000\\/head-of-department\\/annual-budget\\/12\"}',NULL,'2026-04-13 11:46:27','2026-04-13 11:46:27'),('3f3493f5-7dab-4607-8e10-e1c7f839ac09','App\\Notifications\\BudgetPlanReviewRequested','App\\Models\\User',8,'{\"budget_plan_id\":7,\"fiscal_year\":2027,\"message\":\"\\u0ec1\\u0e9c\\u0e99\\u0e87\\u0ebb\\u0e9a\\u0e9b\\u0eb0\\u0ea1\\u0eb2\\u0e99\\u0e9b\\u0eb0\\u0e88\\u0eb3\\u0e9b\\u0eb5 2027 \\u0e95\\u0ec9\\u0ead\\u0e87\\u0e81\\u0eb2\\u0e99\\u0e84\\u0ea7\\u0eb2\\u0ea1\\u0e84\\u0eb4\\u0e94\\u0ec0\\u0eab\\u0eb1\\u0e99\\u0e88\\u0eb2\\u0e81\\u0e97\\u0ec8\\u0eb2\\u0e99\",\"type\":\"review_requested\",\"url\":\"http:\\/\\/127.0.0.1:8000\\/head-of-department\\/annual-budget\\/7\"}','2026-04-11 07:23:06','2026-04-11 07:07:32','2026-04-11 07:23:06'),('415b0bab-fb65-48be-9ab0-b292a21103d3','App\\Notifications\\BudgetPlanFinalApprovalRequested','App\\Models\\User',6,'{\"budget_plan_id\":11,\"fiscal_year\":2028,\"message\":\"\\u0ec1\\u0e9c\\u0e99\\u0e87\\u0ebb\\u0e9a\\u0e9b\\u0eb0\\u0ea1\\u0eb2\\u0e99\\u0e9b\\u0eb0\\u0e88\\u0eb3\\u0e9b\\u0eb5 2028 \\u0ea5\\u0ecd\\u0e96\\u0ec9\\u0eb2\\u0e81\\u0eb2\\u0e99\\u0ead\\u0eb0\\u0e99\\u0eb8\\u0ea1\\u0eb1\\u0e94\\u0e82\\u0eb1\\u0ec9\\u0e99\\u0eaa\\u0eb8\\u0e94\\u0e97\\u0ec9\\u0eb2\\u0e8d\",\"type\":\"final_approval_requested\",\"url\":\"http:\\/\\/127.0.0.1:8000\\/head-of-faculty\\/annual-budget\\/11\"}','2026-04-13 07:29:40','2026-04-13 07:29:24','2026-04-13 07:29:40'),('4c6305af-c72c-41ef-abf8-b88847b62165','App\\Notifications\\BudgetPlanReviewRequested','App\\Models\\User',8,'{\"budget_plan_id\":7,\"fiscal_year\":2027,\"message\":\"\\u0ec1\\u0e9c\\u0e99\\u0e87\\u0ebb\\u0e9a\\u0e9b\\u0eb0\\u0ea1\\u0eb2\\u0e99\\u0e9b\\u0eb0\\u0e88\\u0eb3\\u0e9b\\u0eb5 2027 \\u0e95\\u0ec9\\u0ead\\u0e87\\u0e81\\u0eb2\\u0e99\\u0e84\\u0ea7\\u0eb2\\u0ea1\\u0e84\\u0eb4\\u0e94\\u0ec0\\u0eab\\u0eb1\\u0e99\\u0e88\\u0eb2\\u0e81\\u0e97\\u0ec8\\u0eb2\\u0e99\",\"type\":\"review_requested\",\"url\":\"http:\\/\\/127.0.0.1:8000\\/head-of-department\\/annual-budget\\/7\"}','2026-04-10 16:11:18','2026-04-10 16:08:21','2026-04-10 16:11:18'),('51ae1979-f9c4-47a2-af16-ee75bba20657','App\\Notifications\\BudgetPlanStatusChanged','App\\Models\\User',2,'{\"budget_plan_id\":12,\"fiscal_year\":2028,\"message\":\"\\u0ec1\\u0e9c\\u0e99\\u0e87\\u0ebb\\u0e9a\\u0e9b\\u0eb0\\u0ea1\\u0eb2\\u0e99\\u0e9b\\u0eb0\\u0e88\\u0eb3\\u0e9b\\u0eb5 2028 \\u0ec4\\u0e94\\u0ec9\\u0eae\\u0eb1\\u0e9a\\u0e81\\u0eb2\\u0e99\\u0ead\\u0eb0\\u0e99\\u0eb8\\u0ea1\\u0eb1\\u0e94\\u0ec1\\u0ea5\\u0ec9\\u0ea7\",\"type\":\"status_changed\",\"url\":\"http:\\/\\/127.0.0.1:8000\\/head-of-finance\\/annual-budget\\/12\"}','2026-04-13 11:48:08','2026-04-13 11:47:24','2026-04-13 11:48:08'),('5355b174-7dcf-42f2-980d-86089f5ca486','App\\Notifications\\BudgetPlanReviewRequested','App\\Models\\User',3,'{\"budget_plan_id\":7,\"fiscal_year\":2027,\"message\":\"\\u0ec1\\u0e9c\\u0e99\\u0e87\\u0ebb\\u0e9a\\u0e9b\\u0eb0\\u0ea1\\u0eb2\\u0e99\\u0e9b\\u0eb0\\u0e88\\u0eb3\\u0e9b\\u0eb5 2027 \\u0e95\\u0ec9\\u0ead\\u0e87\\u0e81\\u0eb2\\u0e99\\u0e84\\u0ea7\\u0eb2\\u0ea1\\u0e84\\u0eb4\\u0e94\\u0ec0\\u0eab\\u0eb1\\u0e99\\u0e88\\u0eb2\\u0e81\\u0e97\\u0ec8\\u0eb2\\u0e99\",\"type\":\"review_requested\",\"url\":\"http:\\/\\/127.0.0.1:8000\\/head-of-department\\/annual-budget\\/7\"}','2026-04-10 16:25:47','2026-04-10 16:08:21','2026-04-10 16:25:47'),('6fa432a6-bc09-4522-bb0c-c1880b407334','App\\Notifications\\BudgetPlanFinalApprovalRequested','App\\Models\\User',6,'{\"budget_plan_id\":8,\"fiscal_year\":2028,\"message\":\"\\u0ec1\\u0e9c\\u0e99\\u0e87\\u0ebb\\u0e9a\\u0e9b\\u0eb0\\u0ea1\\u0eb2\\u0e99\\u0e9b\\u0eb0\\u0e88\\u0eb3\\u0e9b\\u0eb5 2028 \\u0ea5\\u0ecd\\u0e96\\u0ec9\\u0eb2\\u0e81\\u0eb2\\u0e99\\u0ead\\u0eb0\\u0e99\\u0eb8\\u0ea1\\u0eb1\\u0e94\\u0e82\\u0eb1\\u0ec9\\u0e99\\u0eaa\\u0eb8\\u0e94\\u0e97\\u0ec9\\u0eb2\\u0e8d\",\"type\":\"final_approval_requested\",\"url\":\"http:\\/\\/localhost:8000\\/head-of-faculty\\/annual-budget\\/8\"}','2026-04-12 14:02:03','2026-04-11 09:59:08','2026-04-12 14:02:03'),('7585edc7-6de6-4336-a42a-940c0d619ce4','App\\Notifications\\BudgetPlanReviewRequested','App\\Models\\User',8,'{\"budget_plan_id\":7,\"fiscal_year\":2027,\"message\":\"\\u0ec1\\u0e9c\\u0e99\\u0e87\\u0ebb\\u0e9a\\u0e9b\\u0eb0\\u0ea1\\u0eb2\\u0e99\\u0e9b\\u0eb0\\u0e88\\u0eb3\\u0e9b\\u0eb5 2027 \\u0e95\\u0ec9\\u0ead\\u0e87\\u0e81\\u0eb2\\u0e99\\u0e84\\u0ea7\\u0eb2\\u0ea1\\u0e84\\u0eb4\\u0e94\\u0ec0\\u0eab\\u0eb1\\u0e99\\u0e88\\u0eb2\\u0e81\\u0e97\\u0ec8\\u0eb2\\u0e99\",\"type\":\"review_requested\",\"url\":\"http:\\/\\/127.0.0.1:8000\\/head-of-department\\/annual-budget\\/7\"}','2026-04-11 07:23:06','2026-04-11 07:07:14','2026-04-11 07:23:06'),('76f4cc9c-6832-4d43-91ee-c0ca4260d4b3','App\\Notifications\\BudgetPlanReviewRequested','App\\Models\\User',8,'{\"budget_plan_id\":7,\"fiscal_year\":2027,\"message\":\"\\u0ec1\\u0e9c\\u0e99\\u0e87\\u0ebb\\u0e9a\\u0e9b\\u0eb0\\u0ea1\\u0eb2\\u0e99\\u0e9b\\u0eb0\\u0e88\\u0eb3\\u0e9b\\u0eb5 2027 \\u0e95\\u0ec9\\u0ead\\u0e87\\u0e81\\u0eb2\\u0e99\\u0e84\\u0ea7\\u0eb2\\u0ea1\\u0e84\\u0eb4\\u0e94\\u0ec0\\u0eab\\u0eb1\\u0e99\\u0e88\\u0eb2\\u0e81\\u0e97\\u0ec8\\u0eb2\\u0e99\",\"type\":\"review_requested\",\"url\":\"http:\\/\\/127.0.0.1:8000\\/head-of-department\\/annual-budget\\/7\"}','2026-04-11 07:23:06','2026-04-10 16:28:16','2026-04-11 07:23:06'),('7cfdbffc-29cc-4a80-a132-363d3055d679','App\\Notifications\\BudgetPlanReviewRequested','App\\Models\\User',8,'{\"budget_plan_id\":11,\"fiscal_year\":2028,\"message\":\"\\u0ec1\\u0e9c\\u0e99\\u0e87\\u0ebb\\u0e9a\\u0e9b\\u0eb0\\u0ea1\\u0eb2\\u0e99\\u0e9b\\u0eb0\\u0e88\\u0eb3\\u0e9b\\u0eb5 2028 \\u0e95\\u0ec9\\u0ead\\u0e87\\u0e81\\u0eb2\\u0e99\\u0e84\\u0ea7\\u0eb2\\u0ea1\\u0e84\\u0eb4\\u0e94\\u0ec0\\u0eab\\u0eb1\\u0e99\\u0e88\\u0eb2\\u0e81\\u0e97\\u0ec8\\u0eb2\\u0e99\",\"type\":\"review_requested\",\"url\":\"http:\\/\\/127.0.0.1:8000\\/head-of-department\\/annual-budget\\/11\"}','2026-04-27 07:46:10','2026-04-13 07:29:17','2026-04-27 07:46:10'),('81d0b41a-2539-4436-a945-5d12983dfbdd','App\\Notifications\\BudgetPlanReviewRequested','App\\Models\\User',8,'{\"budget_plan_id\":7,\"fiscal_year\":2027,\"message\":\"\\u0ec1\\u0e9c\\u0e99\\u0e87\\u0ebb\\u0e9a\\u0e9b\\u0eb0\\u0ea1\\u0eb2\\u0e99\\u0e9b\\u0eb0\\u0e88\\u0eb3\\u0e9b\\u0eb5 2027 \\u0e95\\u0ec9\\u0ead\\u0e87\\u0e81\\u0eb2\\u0e99\\u0e84\\u0ea7\\u0eb2\\u0ea1\\u0e84\\u0eb4\\u0e94\\u0ec0\\u0eab\\u0eb1\\u0e99\\u0e88\\u0eb2\\u0e81\\u0e97\\u0ec8\\u0eb2\\u0e99\",\"type\":\"review_requested\",\"url\":\"http:\\/\\/127.0.0.1:8000\\/head-of-department\\/annual-budget\\/7\"}','2026-04-11 07:23:06','2026-04-10 16:25:28','2026-04-11 07:23:06'),('85a565a7-0c17-44e7-873f-5830db95652d','App\\Notifications\\BudgetPlanStatusChanged','App\\Models\\User',2,'{\"budget_plan_id\":8,\"fiscal_year\":2028,\"message\":\"\\u0ec1\\u0e9c\\u0e99\\u0e87\\u0ebb\\u0e9a\\u0e9b\\u0eb0\\u0ea1\\u0eb2\\u0e99\\u0e9b\\u0eb0\\u0e88\\u0eb3\\u0e9b\\u0eb5 2028 \\u0ec4\\u0e94\\u0ec9\\u0eae\\u0eb1\\u0e9a\\u0e81\\u0eb2\\u0e99\\u0ead\\u0eb0\\u0e99\\u0eb8\\u0ea1\\u0eb1\\u0e94\\u0ec1\\u0ea5\\u0ec9\\u0ea7\",\"type\":\"status_changed\",\"url\":\"http:\\/\\/localhost:8000\\/head-of-finance\\/annual-budget\\/8\"}','2026-04-11 09:59:48','2026-04-11 09:59:32','2026-04-11 09:59:48'),('93cee128-90a8-4cc4-bb0f-e9b1f2c1b408','App\\Notifications\\BudgetPlanStatusChanged','App\\Models\\User',2,'{\"budget_plan_id\":8,\"fiscal_year\":2028,\"message\":\"\\u0ec1\\u0e9c\\u0e99\\u0e87\\u0ebb\\u0e9a\\u0e9b\\u0eb0\\u0ea1\\u0eb2\\u0e99\\u0e9b\\u0eb0\\u0e88\\u0eb3\\u0e9b\\u0eb5 2028 \\u0e96\\u0eb7\\u0e81\\u0eaa\\u0ebb\\u0ec8\\u0e87\\u0e81\\u0eb1\\u0e9a\\u0ec3\\u0eab\\u0ec9\\u0e9b\\u0eb1\\u0e9a\\u0e9b\\u0eb8\\u0e87 \\u2014 \\u0e81\\u0eb0\\u0ea5\\u0eb8\\u0e99\\u0eb2\\u0e81\\u0ea7\\u0e94\\u0eaa\\u0ead\\u0e9a\\u0e84\\u0eb3\\u0ec0\\u0eab\\u0eb1\\u0e99\",\"type\":\"status_changed\",\"url\":\"http:\\/\\/localhost:8000\\/head-of-finance\\/annual-budget\\/8\"}','2026-04-11 09:57:39','2026-04-11 09:56:51','2026-04-11 09:57:39'),('9637b42c-b4aa-4e32-8ff5-a5e643bb28ad','App\\Notifications\\BudgetPlanReviewRequested','App\\Models\\User',5,'{\"budget_plan_id\":7,\"fiscal_year\":2027,\"message\":\"\\u0ec1\\u0e9c\\u0e99\\u0e87\\u0ebb\\u0e9a\\u0e9b\\u0eb0\\u0ea1\\u0eb2\\u0e99\\u0e9b\\u0eb0\\u0e88\\u0eb3\\u0e9b\\u0eb5 2027 \\u0e95\\u0ec9\\u0ead\\u0e87\\u0e81\\u0eb2\\u0e99\\u0e84\\u0ea7\\u0eb2\\u0ea1\\u0e84\\u0eb4\\u0e94\\u0ec0\\u0eab\\u0eb1\\u0e99\\u0e88\\u0eb2\\u0e81\\u0e97\\u0ec8\\u0eb2\\u0e99\",\"type\":\"review_requested\",\"url\":\"http:\\/\\/127.0.0.1:8000\\/head-of-department\\/annual-budget\\/7\"}','2026-04-10 16:08:56','2026-04-10 16:08:21','2026-04-10 16:08:56'),('a46d56c1-e16f-411b-a160-43dc7d8a9f79','App\\Notifications\\BudgetPlanReviewRequested','App\\Models\\User',3,'{\"budget_plan_id\":10,\"fiscal_year\":2028,\"message\":\"\\u0ec1\\u0e9c\\u0e99\\u0e87\\u0ebb\\u0e9a\\u0e9b\\u0eb0\\u0ea1\\u0eb2\\u0e99\\u0e9b\\u0eb0\\u0e88\\u0eb3\\u0e9b\\u0eb5 2028 \\u0e95\\u0ec9\\u0ead\\u0e87\\u0e81\\u0eb2\\u0e99\\u0e84\\u0ea7\\u0eb2\\u0ea1\\u0e84\\u0eb4\\u0e94\\u0ec0\\u0eab\\u0eb1\\u0e99\\u0e88\\u0eb2\\u0e81\\u0e97\\u0ec8\\u0eb2\\u0e99\",\"type\":\"review_requested\",\"url\":\"http:\\/\\/127.0.0.1:8000\\/head-of-department\\/annual-budget\\/10\"}',NULL,'2026-04-12 17:00:22','2026-04-12 17:00:22'),('aed62e23-0d03-40ae-baef-8a274572d06b','App\\Notifications\\BudgetPlanFinalApprovalRequested','App\\Models\\User',6,'{\"budget_plan_id\":10,\"fiscal_year\":2028,\"message\":\"\\u0ec1\\u0e9c\\u0e99\\u0e87\\u0ebb\\u0e9a\\u0e9b\\u0eb0\\u0ea1\\u0eb2\\u0e99\\u0e9b\\u0eb0\\u0e88\\u0eb3\\u0e9b\\u0eb5 2028 \\u0ea5\\u0ecd\\u0e96\\u0ec9\\u0eb2\\u0e81\\u0eb2\\u0e99\\u0ead\\u0eb0\\u0e99\\u0eb8\\u0ea1\\u0eb1\\u0e94\\u0e82\\u0eb1\\u0ec9\\u0e99\\u0eaa\\u0eb8\\u0e94\\u0e97\\u0ec9\\u0eb2\\u0e8d\",\"type\":\"final_approval_requested\",\"url\":\"http:\\/\\/127.0.0.1:8000\\/head-of-faculty\\/annual-budget\\/10\"}','2026-04-12 17:01:00','2026-04-12 17:00:32','2026-04-12 17:01:00'),('b142f66c-eeda-4fff-942f-a34720ca9f2c','App\\Notifications\\BudgetPlanStatusChanged','App\\Models\\User',2,'{\"budget_plan_id\":11,\"fiscal_year\":2028,\"message\":\"\\u0ec1\\u0e9c\\u0e99\\u0e87\\u0ebb\\u0e9a\\u0e9b\\u0eb0\\u0ea1\\u0eb2\\u0e99\\u0e9b\\u0eb0\\u0e88\\u0eb3\\u0e9b\\u0eb5 2028 \\u0ec4\\u0e94\\u0ec9\\u0eae\\u0eb1\\u0e9a\\u0e81\\u0eb2\\u0e99\\u0ead\\u0eb0\\u0e99\\u0eb8\\u0ea1\\u0eb1\\u0e94\\u0ec1\\u0ea5\\u0ec9\\u0ea7\",\"type\":\"status_changed\",\"url\":\"http:\\/\\/127.0.0.1:8000\\/head-of-finance\\/annual-budget\\/11\"}','2026-04-13 07:29:58','2026-04-13 07:29:45','2026-04-13 07:29:58'),('c019ec66-9a58-4b9f-85b1-3e03f75b104d','App\\Notifications\\BudgetPlanReviewRequested','App\\Models\\User',8,'{\"budget_plan_id\":7,\"fiscal_year\":2027,\"message\":\"\\u0ec1\\u0e9c\\u0e99\\u0e87\\u0ebb\\u0e9a\\u0e9b\\u0eb0\\u0ea1\\u0eb2\\u0e99\\u0e9b\\u0eb0\\u0e88\\u0eb3\\u0e9b\\u0eb5 2027 \\u0e95\\u0ec9\\u0ead\\u0e87\\u0e81\\u0eb2\\u0e99\\u0e84\\u0ea7\\u0eb2\\u0ea1\\u0e84\\u0eb4\\u0e94\\u0ec0\\u0eab\\u0eb1\\u0e99\\u0e88\\u0eb2\\u0e81\\u0e97\\u0ec8\\u0eb2\\u0e99\",\"type\":\"review_requested\",\"url\":\"http:\\/\\/127.0.0.1:8000\\/head-of-department\\/annual-budget\\/7\"}','2026-04-11 07:23:05','2026-04-11 07:22:38','2026-04-11 07:23:05'),('c9022791-e923-43e7-9cdc-f7596daef9c0','App\\Notifications\\BudgetPlanReviewRequested','App\\Models\\User',8,'{\"budget_plan_id\":7,\"fiscal_year\":2027,\"message\":\"\\u0ec1\\u0e9c\\u0e99\\u0e87\\u0ebb\\u0e9a\\u0e9b\\u0eb0\\u0ea1\\u0eb2\\u0e99\\u0e9b\\u0eb0\\u0e88\\u0eb3\\u0e9b\\u0eb5 2027 \\u0e95\\u0ec9\\u0ead\\u0e87\\u0e81\\u0eb2\\u0e99\\u0e84\\u0ea7\\u0eb2\\u0ea1\\u0e84\\u0eb4\\u0e94\\u0ec0\\u0eab\\u0eb1\\u0e99\\u0e88\\u0eb2\\u0e81\\u0e97\\u0ec8\\u0eb2\\u0e99\",\"type\":\"review_requested\",\"url\":\"http:\\/\\/127.0.0.1:8000\\/head-of-department\\/annual-budget\\/7\"}','2026-04-11 07:23:06','2026-04-11 07:09:30','2026-04-11 07:23:06'),('df8a66a3-80e6-4e1b-b127-3b770df0b567','App\\Notifications\\BudgetPlanFinalApprovalRequested','App\\Models\\User',6,'{\"budget_plan_id\":8,\"fiscal_year\":2028,\"message\":\"\\u0ec1\\u0e9c\\u0e99\\u0e87\\u0ebb\\u0e9a\\u0e9b\\u0eb0\\u0ea1\\u0eb2\\u0e99\\u0e9b\\u0eb0\\u0e88\\u0eb3\\u0e9b\\u0eb5 2028 \\u0ea5\\u0ecd\\u0e96\\u0ec9\\u0eb2\\u0e81\\u0eb2\\u0e99\\u0ead\\u0eb0\\u0e99\\u0eb8\\u0ea1\\u0eb1\\u0e94\\u0e82\\u0eb1\\u0ec9\\u0e99\\u0eaa\\u0eb8\\u0e94\\u0e97\\u0ec9\\u0eb2\\u0e8d\",\"type\":\"final_approval_requested\",\"url\":\"http:\\/\\/127.0.0.1:8000\\/head-of-faculty\\/annual-budget\\/8\"}','2026-04-12 14:02:31','2026-04-11 09:43:03','2026-04-12 14:02:31'),('e5bad8a6-4f96-45b5-8591-8ffec5e37715','App\\Notifications\\BudgetPlanReviewRequested','App\\Models\\User',8,'{\"budget_plan_id\":7,\"fiscal_year\":2027,\"message\":\"\\u0ec1\\u0e9c\\u0e99\\u0e87\\u0ebb\\u0e9a\\u0e9b\\u0eb0\\u0ea1\\u0eb2\\u0e99\\u0e9b\\u0eb0\\u0e88\\u0eb3\\u0e9b\\u0eb5 2027 \\u0e95\\u0ec9\\u0ead\\u0e87\\u0e81\\u0eb2\\u0e99\\u0e84\\u0ea7\\u0eb2\\u0ea1\\u0e84\\u0eb4\\u0e94\\u0ec0\\u0eab\\u0eb1\\u0e99\\u0e88\\u0eb2\\u0e81\\u0e97\\u0ec8\\u0eb2\\u0e99\",\"type\":\"review_requested\",\"url\":\"http:\\/\\/127.0.0.1:8000\\/head-of-department\\/annual-budget\\/7\"}','2026-04-11 07:23:06','2026-04-10 16:20:42','2026-04-11 07:23:06'),('ec2dfb81-051d-44a1-b36e-83104bf71180','App\\Notifications\\BudgetPlanFinalApprovalRequested','App\\Models\\User',6,'{\"budget_plan_id\":12,\"fiscal_year\":2028,\"message\":\"\\u0ec1\\u0e9c\\u0e99\\u0e87\\u0ebb\\u0e9a\\u0e9b\\u0eb0\\u0ea1\\u0eb2\\u0e99\\u0e9b\\u0eb0\\u0e88\\u0eb3\\u0e9b\\u0eb5 2028 \\u0ea5\\u0ecd\\u0e96\\u0ec9\\u0eb2\\u0e81\\u0eb2\\u0e99\\u0ead\\u0eb0\\u0e99\\u0eb8\\u0ea1\\u0eb1\\u0e94\\u0e82\\u0eb1\\u0ec9\\u0e99\\u0eaa\\u0eb8\\u0e94\\u0e97\\u0ec9\\u0eb2\\u0e8d\",\"type\":\"final_approval_requested\",\"url\":\"http:\\/\\/127.0.0.1:8000\\/head-of-faculty\\/annual-budget\\/12\"}','2026-04-13 11:46:56','2026-04-13 11:46:33','2026-04-13 11:46:56'),('f59bf614-2e88-4e86-b86a-36c71845c7fd','App\\Notifications\\BudgetPlanReviewRequested','App\\Models\\User',5,'{\"budget_plan_id\":7,\"fiscal_year\":2027,\"message\":\"\\u0ec1\\u0e9c\\u0e99\\u0e87\\u0ebb\\u0e9a\\u0e9b\\u0eb0\\u0ea1\\u0eb2\\u0e99\\u0e9b\\u0eb0\\u0e88\\u0eb3\\u0e9b\\u0eb5 2027 \\u0e95\\u0ec9\\u0ead\\u0e87\\u0e81\\u0eb2\\u0e99\\u0e84\\u0ea7\\u0eb2\\u0ea1\\u0e84\\u0eb4\\u0e94\\u0ec0\\u0eab\\u0eb1\\u0e99\\u0e88\\u0eb2\\u0e81\\u0e97\\u0ec8\\u0eb2\\u0e99\",\"type\":\"review_requested\",\"url\":\"http:\\/\\/127.0.0.1:8000\\/head-of-department\\/annual-budget\\/7\"}','2026-04-11 07:22:50','2026-04-10 16:25:28','2026-04-11 07:22:50'),('f5c44a84-7a63-4440-86bf-8cf56bfd122a','App\\Notifications\\BudgetPlanReviewRequested','App\\Models\\User',5,'{\"budget_plan_id\":7,\"fiscal_year\":2027,\"message\":\"\\u0ec1\\u0e9c\\u0e99\\u0e87\\u0ebb\\u0e9a\\u0e9b\\u0eb0\\u0ea1\\u0eb2\\u0e99\\u0e9b\\u0eb0\\u0e88\\u0eb3\\u0e9b\\u0eb5 2027 \\u0e95\\u0ec9\\u0ead\\u0e87\\u0e81\\u0eb2\\u0e99\\u0e84\\u0ea7\\u0eb2\\u0ea1\\u0e84\\u0eb4\\u0e94\\u0ec0\\u0eab\\u0eb1\\u0e99\\u0e88\\u0eb2\\u0e81\\u0e97\\u0ec8\\u0eb2\\u0e99\",\"type\":\"review_requested\",\"url\":\"http:\\/\\/127.0.0.1:8000\\/head-of-department\\/annual-budget\\/7\"}','2026-04-11 07:22:50','2026-04-11 07:07:14','2026-04-11 07:22:50'),('fe4ff3bc-9e80-4493-9feb-caa21f9c41c0','App\\Notifications\\BudgetPlanReviewRequested','App\\Models\\User',5,'{\"budget_plan_id\":9,\"fiscal_year\":2028,\"message\":\"\\u0ec1\\u0e9c\\u0e99\\u0e87\\u0ebb\\u0e9a\\u0e9b\\u0eb0\\u0ea1\\u0eb2\\u0e99\\u0e9b\\u0eb0\\u0e88\\u0eb3\\u0e9b\\u0eb5 2028 \\u0e95\\u0ec9\\u0ead\\u0e87\\u0e81\\u0eb2\\u0e99\\u0e84\\u0ea7\\u0eb2\\u0ea1\\u0e84\\u0eb4\\u0e94\\u0ec0\\u0eab\\u0eb1\\u0e99\\u0e88\\u0eb2\\u0e81\\u0e97\\u0ec8\\u0eb2\\u0e99\",\"type\":\"review_requested\",\"url\":\"http:\\/\\/127.0.0.1:8000\\/head-of-department\\/annual-budget\\/9\"}',NULL,'2026-04-12 16:55:43','2026-04-12 16:55:43');
/*!40000 ALTER TABLE `notifications` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `request_workflow_logs`
--

DROP TABLE IF EXISTS `request_workflow_logs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `request_workflow_logs` (
  `id` int NOT NULL AUTO_INCREMENT,
  `request_id` int NOT NULL,
  `user_id` int NOT NULL,
  `actor_role_name` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `action` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `comments` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  PRIMARY KEY (`id`),
  KEY `request_id` (`request_id`),
  KEY `user_id` (`user_id`),
  KEY `idx_workflow_logs_timestamp` (`timestamp`),
  CONSTRAINT `request_workflow_logs_ibfk_1` FOREIGN KEY (`request_id`) REFERENCES `advance_requests` (`id`) ON DELETE CASCADE,
  CONSTRAINT `request_workflow_logs_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `request_workflow_logs`
--

LOCK TABLES `request_workflow_logs` WRITE;
/*!40000 ALTER TABLE `request_workflow_logs` DISABLE KEYS */;
/*!40000 ALTER TABLE `request_workflow_logs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `roles` (
  `id` int NOT NULL AUTO_INCREMENT,
  `role_name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `role_name` (`role_name`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `roles`
--

LOCK TABLES `roles` WRITE;
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` VALUES (3,'accountant'),(1,'admin'),(7,'cashier'),(4,'deputy_head_of_faculty'),(11,'head_of_department'),(5,'head_of_faculty'),(2,'head_of_finance'),(6,'requester'),(8,'revenue_officer'),(9,'treasurer'),(10,'treasury_reconciliation_officer');
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `salary_defaults`
--

DROP TABLE IF EXISTS `salary_defaults`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `salary_defaults` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `account_code` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `section_code` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sort_order` int NOT NULL DEFAULT '0',
  `item_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `salary_defaults`
--

LOCK TABLES `salary_defaults` WRITE;
/*!40000 ALTER TABLE `salary_defaults` DISABLE KEYS */;
INSERT INTO `salary_defaults` VALUES (1,'60.10.01','60.10',0,'ເງິນເດືອນ ພ/ງ ພວມປະຕິບັດງານ 100%'),(2,'60.10.02','60.10',1,'ເງິນເດືອນເພື່ອເລື່ອນຊັ້ນ'),(3,'60.10.03','60.10',2,'ເງິນເດືອນ ພ/ງ ເຂົ້າໃໝ່ 95%'),(4,'60.10.04','60.10',3,'ເງິນເດືອນ ພ/ງ ຮຽນຕໍ່ພາຍໃນ'),(5,'60.10.05','60.10',4,'ເງິນເດືອນ ພ/ງ ຮຽນຕໍ່ຕ່າງປະເທດ'),(6,'60.10.06','60.10',5,'ເງິນເດືອນ ພ/ງ ຕາມສັນຍາ'),(7,'60.20.01','60.20',0,'ອຸດໜູນຕໍາແໜ່ງ'),(8,'60.20.02','60.20',1,'ອຸດໜູນອາຊີບ'),(9,'60.20.03','60.20',2,'ອຸດໜູນອາຍຸການ'),(10,'60.20.04','60.20',3,'ອຸດໜູນວຽກໜັກ-ທາງເບື່ອ'),(11,'60.20.05','60.20',4,'ອຸດໜູນສອນຫ້ອງຄວບ'),(12,'60.20.06','60.20',5,'ອຸດໜູນຄ່າຄອງຊີບ'),(13,'61.20.01','61.20',0,'ອຸດໜູນລູກພະນັກງານ'),(14,'61.20.02','61.20',1,'ອຸດໜູນເມຍພະນັກງານ'),(15,'61.30.01','61.30',0,'ກ່ອນອອກການ'),(16,'61.30.02','61.30',1,'ກ່ອນອອກບໍານານ'),(17,'61.40.01','61.40',0,'ເຮັດວຽກນອກໂມງລັດຖະການ'),(18,'61.40.02','61.40',1,'ແປພາສາ'),(19,'61.40.03','61.40',2,'ຄົ້ນຄວ້າ ແລະ ວິໄຈ'),(20,'61.40.04','61.40',3,'ຂຽນບົດ ແລະ ຮຽບຮຽງ'),(21,'61.40.05','61.40',4,'ສອນພິເສດ'),(22,'61.40.06','61.40',5,'ຄ່າເວັນຍາມ (ປ້ອງກັນ)'),(23,'61.50.01','61.50',0,'ເບ້ຍລ້ຽງນັກຮຽນ ປ.ຕີ (ພາຍໃນ)'),(24,'61.50.02','61.50',1,'ຄ່າອັດຕາກິນ-ຝຶກງານ'),(25,'61.50.03','61.50',2,'ຄ່າເດີນທາງ-ຝຶກງານ');
/*!40000 ALTER TABLE `salary_defaults` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `salary_plan_items`
--

DROP TABLE IF EXISTS `salary_plan_items`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `salary_plan_items` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `plan_id` bigint unsigned NOT NULL,
  `account_code` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `section_code` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sort_order` int NOT NULL DEFAULT '0',
  `item_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `num_persons` int NOT NULL DEFAULT '0',
  `amount_atm` decimal(15,2) NOT NULL DEFAULT '0.00',
  `amount_cash` decimal(15,2) NOT NULL DEFAULT '0.00',
  `notes` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `salary_plan_items_plan_id_foreign` (`plan_id`),
  CONSTRAINT `salary_plan_items_plan_id_foreign` FOREIGN KEY (`plan_id`) REFERENCES `salary_plans` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=51 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `salary_plan_items`
--

LOCK TABLES `salary_plan_items` WRITE;
/*!40000 ALTER TABLE `salary_plan_items` DISABLE KEYS */;
INSERT INTO `salary_plan_items` VALUES (26,2,'60.10.01','60.10',0,'ເງິນເດືອນ ພ/ງ ພວມປະຕິບັດງານ 100%',98,249716250.00,0.00,NULL),(27,2,'60.10.02','60.10',1,'ເງິນເດືອນເພື່ອເລື່ອນຊັ້ນ',53,1015850.00,0.00,NULL),(28,2,'60.10.03','60.10',2,'ເງິນເດືອນ ພ/ງ ເຂົ້າໃໝ່ 95%',0,0.00,0.00,NULL),(29,2,'60.10.04','60.10',3,'ເງິນເດືອນ ພ/ງ ຮຽນຕໍ່ພາຍໃນ',3,12220515.00,0.00,NULL),(30,2,'60.10.05','60.10',4,'ເງິນເດືອນ ພ/ງ ຮຽນຕໍ່ຕ່າງປະເທດ',0,0.00,0.00,NULL),(31,2,'60.10.06','60.10',5,'ເງິນເດືອນ ພ/ງ ຕາມສັນຍາ',0,0.00,0.00,NULL),(32,2,'60.20.01','60.20',0,'ອຸດໜູນຕໍາແໜ່ງ',79,51812355.00,0.00,NULL),(33,2,'60.20.02','60.20',1,'ອຸດໜູນອາຊີບ',96,23768430.00,0.00,NULL),(34,2,'60.20.03','60.20',2,'ອຸດໜູນອາຍຸການ',104,9385000.00,0.00,NULL),(35,2,'60.20.04','60.20',3,'ອຸດໜູນວຽກໜັກ-ທາງເບື່ອ',37,1102304.00,0.00,NULL),(36,2,'60.20.05','60.20',4,'ອຸດໜູນສອນຫ້ອງຄວບ',12,0.00,7500000.00,NULL),(37,2,'60.20.06','60.20',5,'ອຸດໜູນຄ່າຄອງຊີບ',0,0.00,0.00,NULL),(38,2,'61.20.01','61.20',0,'ອຸດໜູນລູກພະນັກງານ',78,2904720.00,0.00,NULL),(39,2,'61.20.02','61.20',1,'ອຸດໜູນເມຍພະນັກງານ',14,411600.00,0.00,NULL),(40,2,'61.30.01','61.30',0,'ກ່ອນອອກການ',0,0.00,0.00,NULL),(41,2,'61.30.02','61.30',1,'ກ່ອນອອກບໍານານ',6,0.00,0.00,NULL),(42,2,'61.40.01','61.40',0,'ເຮັດວຽກນອກໂມງລັດຖະການ',167,0.00,6680000.00,NULL),(43,2,'61.40.02','61.40',1,'ແປພາສາ',0,0.00,0.00,NULL),(44,2,'61.40.03','61.40',2,'ຄົ້ນຄວ້າ ແລະ ວິໄຈ',6,0.00,0.00,NULL),(45,2,'61.40.04','61.40',3,'ຂຽນບົດ ແລະ ຮຽບຮຽງ',15,0.00,0.00,NULL),(46,2,'61.40.05','61.40',4,'ສອນພິເສດ',0,0.00,0.00,NULL),(47,2,'61.40.06','61.40',5,'ຄ່າເວັນຍາມ (ປ້ອງກັນ)',23,0.00,4820000.00,NULL),(48,2,'61.50.01','61.50',0,'ເບ້ຍລ້ຽງນັກຮຽນ ປ.ຕີ (ພາຍໃນ)',0,0.00,0.00,NULL),(49,2,'61.50.02','61.50',1,'ຄ່າອັດຕາກິນ-ຝຶກງານ',0,0.00,0.00,NULL),(50,2,'61.50.03','61.50',2,'ຄ່າເດີນທາງ-ຝຶກງານ',0,0.00,0.00,NULL);
/*!40000 ALTER TABLE `salary_plan_items` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `salary_plans`
--

DROP TABLE IF EXISTS `salary_plans`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `salary_plans` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `fiscal_year` int NOT NULL,
  `status` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'DRAFT',
  `created_by` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `salary_plans_fiscal_year_unique` (`fiscal_year`),
  KEY `salary_plans_created_by_foreign` (`created_by`),
  CONSTRAINT `salary_plans_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `salary_plans`
--

LOCK TABLES `salary_plans` WRITE;
/*!40000 ALTER TABLE `salary_plans` DISABLE KEYS */;
INSERT INTO `salary_plans` VALUES (2,2027,'DRAFT',2,'2026-05-10 18:30:03','2026-05-10 18:30:03');
/*!40000 ALTER TABLE `salary_plans` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sessions`
--

DROP TABLE IF EXISTS `sessions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `sessions` (
  `id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint unsigned DEFAULT NULL,
  `ip_address` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sessions`
--

LOCK TABLES `sessions` WRITE;
/*!40000 ALTER TABLE `sessions` DISABLE KEYS */;
INSERT INTO `sessions` VALUES ('aodmyz9jIrYjl3j9Vb7inICRoHoQM7aAoMHsTnAG',NULL,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36','YTo0OntzOjY6Il90b2tlbiI7czo0MDoicWZWWGVrSUI3cXlacE52dTJDUUduQWp3ZmE5aFNKazh2SGJUZERzYiI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Mjc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9sb2dpbiI7czo1OiJyb3V0ZSI7czo1OiJsb2dpbiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6MzoidXJsIjthOjE6e3M6ODoiaW50ZW5kZWQiO3M6Mzg6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hZHZhbmNlLXJlcXVlc3RzIjt9fQ==',1776758795),('tNIdsUi67fRVmq6A1pKhwo1i0OYzQRYDlBtztLzA',NULL,'127.0.0.1','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/128.0.0.0 Safari/537.36','YTozOntzOjY6Il90b2tlbiI7czo0MDoiNjRDenk1TE5mN1NNRlhjUlljZjlpVWJSWUd3TEoyU2VXenZwYUhIcCI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Mzg6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hZHZhbmNlLXJlcXVlc3RzIjtzOjU6InJvdXRlIjtzOjIyOiJhZHZhbmNlLXJlcXVlc3RzLmluZGV4Ijt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==',1776757173);
/*!40000 ALTER TABLE `sessions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `transaction_attachments`
--

DROP TABLE IF EXISTS `transaction_attachments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `transaction_attachments` (
  `id` int NOT NULL AUTO_INCREMENT,
  `transaction_id` int NOT NULL,
  `file_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `file_path` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `transaction_id` (`transaction_id`),
  CONSTRAINT `transaction_attachments_ibfk_1` FOREIGN KEY (`transaction_id`) REFERENCES `transactions` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `transaction_attachments`
--

LOCK TABLES `transaction_attachments` WRITE;
/*!40000 ALTER TABLE `transaction_attachments` DISABLE KEYS */;
/*!40000 ALTER TABLE `transaction_attachments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `transactions`
--

DROP TABLE IF EXISTS `transactions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `transactions` (
  `id` int NOT NULL AUTO_INCREMENT,
  `transaction_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `amount` decimal(15,2) NOT NULL,
  `account_id` int DEFAULT NULL,
  `department_id` int DEFAULT NULL,
  `type` enum('income','expense') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'income',
  `category` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `account_id` (`account_id`),
  KEY `department_id` (`department_id`),
  KEY `idx_transactions_date` (`transaction_date`),
  CONSTRAINT `transactions_account_id_foreign` FOREIGN KEY (`account_id`) REFERENCES `chart_of_accounts` (`id`) ON DELETE SET NULL,
  CONSTRAINT `transactions_ibfk_1` FOREIGN KEY (`account_id`) REFERENCES `chart_of_accounts` (`id`),
  CONSTRAINT `transactions_ibfk_2` FOREIGN KEY (`department_id`) REFERENCES `departments` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `transactions`
--

LOCK TABLES `transactions` WRITE;
/*!40000 ALTER TABLE `transactions` DISABLE KEYS */;
INSERT INTO `transactions` VALUES (6,'2026-05-01 07:26:26','Testss',200000.00,99,1,'income','ຄ່າລົງທະບຽນປະລິນຍາຕີ'),(7,'2026-05-01 07:26:26','testrr',4000000.00,49,1,'income','ຄ່າບຳລຸງຫ້ອງທົດລອງ'),(8,'2026-05-01 07:26:26','test',2000000.00,48,1,'expense','ການຊື້ ແລະ ການຊົມໃຊ້'),(9,'2026-05-01 07:26:26','test',2000000.00,49,1,'income','ຄ່າບຳລຸງຫ້ອງທົດລອງ');
/*!40000 ALTER TABLE `transactions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `treasury_reconciliation_items`
--

DROP TABLE IF EXISTS `treasury_reconciliation_items`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `treasury_reconciliation_items` (
  `id` int NOT NULL AUTO_INCREMENT,
  `transaction_id` int NOT NULL,
  `reconciliation_date` date NOT NULL,
  `user_id` int NOT NULL,
  `reference_code` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `transaction_id` (`transaction_id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `treasury_reconciliation_items_ibfk_1` FOREIGN KEY (`transaction_id`) REFERENCES `transactions` (`id`) ON DELETE CASCADE,
  CONSTRAINT `treasury_reconciliation_items_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `treasury_reconciliation_items`
--

LOCK TABLES `treasury_reconciliation_items` WRITE;
/*!40000 ALTER TABLE `treasury_reconciliation_items` DISABLE KEYS */;
/*!40000 ALTER TABLE `treasury_reconciliation_items` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `full_name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `role_id` int NOT NULL,
  `department_id` int DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  KEY `role_id` (`role_id`),
  KEY `department_id` (`department_id`),
  CONSTRAINT `users_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`),
  CONSTRAINT `users_ibfk_2` FOREIGN KEY (`department_id`) REFERENCES `departments` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'admin01','$2y$12$Cy73vWzkYGAjnpybpWpphuYXJH1nF/rM8cJS6QWOOb232Reeto6qe','admin',1,NULL,1,'59LMu3bRcZKwIojNwXoYV8s3HUHIT3hNXco2oxv5cFcj513s7cpq9JLCEbKt'),(2,'aj_boasod','$2y$12$Cy73vWzkYGAjnpybpWpphuYXJH1nF/rM8cJS6QWOOb232Reeto6qe','aj_boasod',2,NULL,1,'UthJThyhg8aQD62V193rHG7ZHsDVdEMu7TTNk7BCP7NPTBswCcOTGBnt91lO'),(3,'accountant01','$2y$12$Cy73vWzkYGAjnpybpWpphuYXJH1nF/rM8cJS6QWOOb232Reeto6qe','accountant',3,NULL,1,NULL),(4,'accountant02','$2y$12$Cy73vWzkYGAjnpybpWpphuYXJH1nF/rM8cJS6QWOOb232Reeto6qe','accountantnaja',3,NULL,0,NULL),(5,'hong_head_fac','$2y$12$Cy73vWzkYGAjnpybpWpphuYXJH1nF/rM8cJS6QWOOb232Reeto6qe','hong_head_fac',4,NULL,1,'s2OWp2O22m6kmwMsjA784B3H6o5Q1chIaT3TUvQwHF04IAajJCKIZMk0cHkk'),(6,'head_fac','$2y$12$Cy73vWzkYGAjnpybpWpphuYXJH1nF/rM8cJS6QWOOb232Reeto6qe','head_fac',5,NULL,1,'JwpV0l3y9AoFNuMLc4TjxYvFINxzOhUrvbIf7JYW53JNHBaFQyb5I908pjEE'),(8,'Teng1122','$2y$12$f.9G6sZ1eamcuQuEO3UFQukIWHtjCg0SnpVaHZl1WHSVed3tsuX7K','Teng',11,NULL,1,'j6kN28DyGQFplASDIRu15QOIVddRhI6PbMvKfXGsqutVhk9VVGRp5UUDaeA9'),(9,'valenthaiymany@gmail.com','$2y$12$UsTnHcVp3x7FH3e9sED34eg0MiP3wWg5oI37YMnhdI6tfl9QbPHr.','Valenthaiy Many',6,NULL,1,NULL),(10,'luminusxdd981@gmail.com','$2y$12$W0b4/PaL.421XOksvS/hn.lEaawX4smoMI5KKuOkUHL3XjszEMojK','Valenthaiy Many',8,NULL,1,'vRz0XT159zFdVjX02fDArGUyLbTwMIjcfWcpQ4fUDjLQ5kT4MQ1wKUnksaiT'),(11,'beekhnlor','$2y$12$1/yzOvXFvq18Qu4FhmVBtu2XO5xLxfu0O78jFx4D3JjRecGJJVAIy','beekingword',1,NULL,1,NULL),(12,'beesosad','$2y$12$4BlQSk8TmK/piOLzpkgtsuKXVbn7/O61F8DQDD3dQHzN18EfqdX7i','bee',6,NULL,1,NULL),(24,'beesocute','$2y$12$aXoryApvOR7VSStZ4I6REeKi0gKIYpF16xzY9tA1HW3OxejRBtjxW','khonesavanh',6,NULL,1,'oW82H4h53NMgRXhJmWGHZSzmQa66fNNJixnTTxPJihFDkMQnLI76G1PCwDyQ'),(25,'var@gmail.com','$2y$12$3JNHxpMaYRamRKo2QPdUuOAw2at9jpZSfXZG.3dOSkdEh.wiHdDt2','Valenthaiy Many',3,NULL,1,NULL);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
SET @@SESSION.SQL_LOG_BIN = @MYSQLDUMP_TEMP_LOG_BIN;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2026-05-11  3:36:43
