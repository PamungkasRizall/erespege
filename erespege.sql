-- MySQL dump 10.13  Distrib 8.0.23, for macos10.15 (x86_64)
--
-- Host: localhost    Database: credential
-- ------------------------------------------------------
-- Server version	8.0.23

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

--
-- Table structure for table `answers`
--

DROP TABLE IF EXISTS `answers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `answers` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `question_id` bigint unsigned NOT NULL,
  `user_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `choice_id` bigint unsigned NOT NULL,
  `is_correct` tinyint NOT NULL DEFAULT '0',
  `score` double DEFAULT NULL,
  `filing_id` char(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `assesor_id` char(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ass_choice_id` bigint unsigned DEFAULT NULL,
  `ass_score` double DEFAULT NULL,
  `ass_notes` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `answers_question_id_foreign` (`question_id`),
  KEY `answers_user_id_foreign` (`user_id`),
  KEY `answers_choice_id_foreign` (`choice_id`),
  KEY `answers_assesor_id_foreign` (`assesor_id`),
  KEY `answers_ass_choice_id_foreign` (`ass_choice_id`),
  KEY `answers_filing_id_foreign` (`filing_id`),
  CONSTRAINT `answers_ass_choice_id_foreign` FOREIGN KEY (`ass_choice_id`) REFERENCES `choices` (`id`),
  CONSTRAINT `answers_assesor_id_foreign` FOREIGN KEY (`assesor_id`) REFERENCES `users` (`id`),
  CONSTRAINT `answers_choice_id_foreign` FOREIGN KEY (`choice_id`) REFERENCES `choices` (`id`) ON DELETE CASCADE,
  CONSTRAINT `answers_filing_id_foreign` FOREIGN KEY (`filing_id`) REFERENCES `filings` (`id`),
  CONSTRAINT `answers_question_id_foreign` FOREIGN KEY (`question_id`) REFERENCES `questions` (`id`) ON DELETE CASCADE,
  CONSTRAINT `answers_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `answers`
--

LOCK TABLES `answers` WRITE;
/*!40000 ALTER TABLE `answers` DISABLE KEYS */;
INSERT INTO `answers` VALUES (15,8,'47a085ec-0567-4a2b-b845-9d563d680a05',17,0,1,'f47ac10b-58cc-4372-a567-0e02b2c3d488','2025-01-28 23:04:19','2025-01-29 14:58:11','f431dc34-1964-43ee-866e-402508142372',18,1,'catatan 1'),(16,11,'47a085ec-0567-4a2b-b845-9d563d680a05',30,0,-1,'f47ac10b-58cc-4372-a567-0e02b2c3d488','2025-01-28 23:05:33','2025-01-29 14:58:17','f431dc34-1964-43ee-866e-402508142372',31,0,'catatan 2'),(17,12,'47a085ec-0567-4a2b-b845-9d563d680a05',35,0,0,'f47ac10b-58cc-4372-a567-0e02b2c3d488','2025-01-28 23:08:08','2025-01-29 14:58:31','f431dc34-1964-43ee-866e-402508142372',33,1,'catatan 3'),(18,14,'47a085ec-0567-4a2b-b845-9d563d680a05',42,0,-1,'f47ac10b-58cc-4372-a567-0e02b2c3d488','2025-01-28 23:08:09','2025-01-29 14:58:19','f431dc34-1964-43ee-866e-402508142372',44,0,'catatan 5'),(19,13,'47a085ec-0567-4a2b-b845-9d563d680a05',39,0,0,'f47ac10b-58cc-4372-a567-0e02b2c3d488','2025-01-28 23:08:13','2025-01-29 12:00:48','f431dc34-1964-43ee-866e-402508142372',37,1,NULL),(23,8,'a940383d-ae93-43d8-bb4f-e7b004e5d132',17,0,1,'258f1831-dc9f-4d41-8e97-504d8a8a3c3f','2025-03-01 06:49:13','2025-03-01 06:53:01','f431dc34-1964-43ee-866e-402508142372',18,-1,'1 a'),(24,11,'a940383d-ae93-43d8-bb4f-e7b004e5d132',30,0,-1,'258f1831-dc9f-4d41-8e97-504d8a8a3c3f','2025-03-01 06:49:18','2025-03-01 06:53:04','f431dc34-1964-43ee-866e-402508142372',29,1,'dsds'),(25,12,'a940383d-ae93-43d8-bb4f-e7b004e5d132',35,0,0,'258f1831-dc9f-4d41-8e97-504d8a8a3c3f','2025-03-01 06:49:18','2025-03-01 06:53:07','f431dc34-1964-43ee-866e-402508142372',36,0,'dsds'),(26,13,'a940383d-ae93-43d8-bb4f-e7b004e5d132',40,0,0,'258f1831-dc9f-4d41-8e97-504d8a8a3c3f','2025-03-01 06:49:22','2025-03-01 06:53:08','f431dc34-1964-43ee-866e-402508142372',38,-1,'dsds'),(27,14,'a940383d-ae93-43d8-bb4f-e7b004e5d132',43,0,0,'258f1831-dc9f-4d41-8e97-504d8a8a3c3f','2025-03-01 06:49:23','2025-03-01 06:53:15','f431dc34-1964-43ee-866e-402508142372',41,1,'dsdsds'),(28,8,'9d84ddb3-8f64-446c-a23f-8aadc796ed04',17,0,1,'88ce7f1f-512d-4440-8001-260d6ad35791','2025-03-01 07:11:54','2025-03-01 07:23:37','f431dc34-1964-43ee-866e-402508142372',19,0,'asas'),(29,11,'9d84ddb3-8f64-446c-a23f-8aadc796ed04',30,0,-1,'88ce7f1f-512d-4440-8001-260d6ad35791','2025-03-01 07:11:58','2025-03-01 07:24:52','f431dc34-1964-43ee-866e-402508142372',29,1,'dsdsd'),(30,12,'9d84ddb3-8f64-446c-a23f-8aadc796ed04',35,0,0,'88ce7f1f-512d-4440-8001-260d6ad35791','2025-03-01 07:12:00','2025-03-01 07:23:42','f431dc34-1964-43ee-866e-402508142372',33,1,'dsds'),(31,13,'9d84ddb3-8f64-446c-a23f-8aadc796ed04',40,0,0,'88ce7f1f-512d-4440-8001-260d6ad35791','2025-03-01 07:12:03','2025-03-01 07:23:45','f431dc34-1964-43ee-866e-402508142372',38,-1,'dsdsds'),(32,14,'9d84ddb3-8f64-446c-a23f-8aadc796ed04',41,0,1,'88ce7f1f-512d-4440-8001-260d6ad35791','2025-03-01 07:12:05','2025-03-01 07:24:50','f431dc34-1964-43ee-866e-402508142372',44,0,'fdfdfdfd');
/*!40000 ALTER TABLE `answers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `categories` (
  `id` smallint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `parent_id` smallint unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `categories_parent_id_foreign` (`parent_id`),
  CONSTRAINT `categories_parent_id_foreign` FOREIGN KEY (`parent_id`) REFERENCES `categories` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categories`
--

LOCK TABLES `categories` WRITE;
/*!40000 ALTER TABLE `categories` DISABLE KEYS */;
INSERT INTO `categories` VALUES (1,'Apoteker','Profesi',NULL,'2025-01-25 23:59:46','2025-01-25 23:59:46',NULL),(2,'Perekam Medis','Profesi',NULL,'2025-01-25 23:59:59','2025-01-25 23:59:59',NULL),(3,'PNS','Status Pegawai',NULL,'2025-01-27 13:37:43','2025-01-27 13:37:43',NULL),(4,'PPPK','Status Pegawai',NULL,'2025-01-27 13:37:51','2025-01-27 13:37:51',NULL),(5,'Kontrak','Status Pegawai',NULL,'2025-01-27 13:38:06','2025-01-27 13:38:06',NULL),(6,'Outsourcing','Status Pegawai',NULL,'2025-01-27 13:38:17','2025-01-27 13:38:17',NULL),(7,'STR','Pemberkasan',NULL,'2025-01-27 14:32:07','2025-01-27 14:32:07',NULL),(8,'SIK','Pemberkasan',NULL,'2025-01-27 14:32:14','2025-01-27 14:32:14',NULL),(9,'Kredensial','Pemberkasan',NULL,'2025-01-27 14:32:35','2025-01-27 14:32:35',NULL),(10,'Kenaikan Pangkat','Pemberkasan',NULL,'2025-01-27 14:33:30','2025-01-27 14:33:30',NULL),(11,'Pelatihan','Pemberkasan',NULL,'2025-01-27 14:33:30','2025-01-27 14:33:30',NULL),(12,'IT','Profesi',NULL,'2025-01-28 11:07:19','2025-01-28 11:07:19',NULL),(14,'Radiografer','Profesi',NULL,'2025-01-29 02:56:12','2025-01-29 02:56:12',NULL);
/*!40000 ALTER TABLE `categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `choices`
--

DROP TABLE IF EXISTS `choices`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `choices` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_correct` tinyint(1) NOT NULL DEFAULT '0',
  `score` double DEFAULT NULL,
  `question_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `choices_question_id_foreign` (`question_id`),
  CONSTRAINT `choices_question_id_foreign` FOREIGN KEY (`question_id`) REFERENCES `questions` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=49 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `choices`
--

LOCK TABLES `choices` WRITE;
/*!40000 ALTER TABLE `choices` DISABLE KEYS */;
INSERT INTO `choices` VALUES (9,'Kompeten Sepenuhnya',0,1,6,'2025-01-27 00:14:00','2025-01-27 00:14:00'),(10,'Memerlukan Supervisi',0,-1,6,'2025-01-27 00:14:00','2025-01-27 00:14:00'),(11,'Tidak Dimintakan Kewenangannya Karena diluar Kompetensinya',0,0,6,'2025-01-27 00:14:00','2025-01-27 00:14:00'),(12,'Tidak Dimintakan Kewenangannya Karena Fasilitas Tidak Tersedia',0,0,6,'2025-01-27 00:14:00','2025-01-27 00:14:00'),(17,'Kompeten Sepenuhnya',0,1,8,'2025-01-27 02:42:54','2025-01-27 02:47:15'),(18,'Memerlukan Supervisi',0,-1,8,'2025-01-27 02:42:54','2025-01-27 02:47:15'),(19,'Tidak Dimintakan Kewenangannya Karena diluar Kompetensinya',0,0,8,'2025-01-27 02:42:54','2025-01-27 02:47:15'),(20,'Tidak Dimintakan Kewenangannya Karena Fasilitas Tidak Tersedia',0,0,8,'2025-01-27 02:42:54','2025-01-27 02:47:15'),(25,'Kompeten Sepenuhnya',0,1,10,'2025-01-27 02:48:02','2025-01-27 02:48:02'),(26,'Memerlukan Supervisi',0,-1,10,'2025-01-27 02:48:02','2025-01-27 02:48:02'),(27,'Tidak Dimintakan Kewenangannya Karena diluar Kompetensinya',0,0,10,'2025-01-27 02:48:02','2025-01-27 02:48:02'),(28,'Tidak Dimintakan Kewenangannya Karena Fasilitas Tidak Tersedia',0,0,10,'2025-01-27 02:48:02','2025-01-27 02:48:02'),(29,'Kompeten Sepenuhnya',0,1,11,'2025-01-27 02:52:53','2025-01-27 02:52:53'),(30,'Memerlukan Supervisi',0,-1,11,'2025-01-27 02:52:53','2025-01-27 02:52:53'),(31,'Tidak Dimintakan Kewenangannya Karena diluar Kompetensinya',0,0,11,'2025-01-27 02:52:53','2025-01-27 02:52:53'),(32,'Tidak Dimintakan Kewenangannya Karena Fasilitas Tidak Tersedia',0,0,11,'2025-01-27 02:52:53','2025-01-27 02:52:53'),(33,'Kompeten Sepenuhnya',0,1,12,'2025-01-28 00:55:12','2025-01-28 00:55:12'),(34,'Memerlukan Supervisi',0,-1,12,'2025-01-28 00:55:12','2025-01-28 00:55:12'),(35,'Tidak Dimintakan Kewenangannya Karena diluar Kompetensinya',0,0,12,'2025-01-28 00:55:12','2025-01-28 00:55:12'),(36,'Tidak Dimintakan Kewenangannya Karena Fasilitas Tidak Tersedia',0,0,12,'2025-01-28 00:55:12','2025-01-28 00:55:12'),(37,'Kompeten Sepenuhnya',0,1,13,'2025-01-28 00:55:36','2025-01-28 00:55:36'),(38,'Memerlukan Supervisi',0,-1,13,'2025-01-28 00:55:36','2025-01-28 00:55:36'),(39,'Tidak Dimintakan Kewenangannya Karena diluar Kompetensinya',0,0,13,'2025-01-28 00:55:36','2025-01-28 00:55:36'),(40,'Tidak Dimintakan Kewenangannya Karena Fasilitas Tidak Tersedia',0,0,13,'2025-01-28 00:55:36','2025-01-28 00:55:36'),(41,'Kompeten Sepenuhnya',0,1,14,'2025-01-28 00:55:52','2025-01-28 00:55:52'),(42,'Memerlukan Supervisi',0,-1,14,'2025-01-28 00:55:52','2025-01-28 00:55:52'),(43,'Tidak Dimintakan Kewenangannya Karena diluar Kompetensinya',0,0,14,'2025-01-28 00:55:52','2025-01-28 00:55:52'),(44,'Tidak Dimintakan Kewenangannya Karena Fasilitas Tidak Tersedia',0,0,14,'2025-01-28 00:55:52','2025-01-28 00:55:52'),(45,'Kompeten Sepenuhnya',0,1,15,'2025-03-01 06:56:05','2025-03-01 06:56:05'),(46,'Memerlukan Supervisi',0,0,15,'2025-03-01 06:56:05','2025-03-01 06:56:05'),(47,'Tidak Dimintakan Kewenangannya Karena diluar Kompetensinya',0,0,15,'2025-03-01 06:56:05','2025-03-01 06:56:05'),(48,'Tidak Dimintakan Kewenangannya Karena Fasilitas Tidak Tersedia',0,0,15,'2025-03-01 06:56:05','2025-03-01 06:56:05');
/*!40000 ALTER TABLE `choices` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `competences`
--

DROP TABLE IF EXISTS `competences`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `competences` (
  `id` smallint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `category_id` smallint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `competences_category_id_foreign` (`category_id`),
  CONSTRAINT `competences_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `competences`
--

LOCK TABLES `competences` WRITE;
/*!40000 ALTER TABLE `competences` DISABLE KEYS */;
INSERT INTO `competences` VALUES (1,'Apoteker Ahli Pertama',1,'2025-01-26 01:27:36','2025-01-26 01:28:22',NULL),(2,'Apoteker Ahli Muda',1,'2025-01-26 01:28:30','2025-01-26 01:28:30',NULL),(3,'Apoteker Ahli Madya',1,'2025-01-26 01:28:30','2025-01-26 01:28:30',NULL),(4,'Apoteker Ahli Utama',1,'2025-01-26 01:28:30','2025-01-26 01:28:30',NULL),(5,'Perekam Medis Ahli Pertama',2,'2025-01-26 01:28:30','2025-01-26 01:28:30',NULL),(6,'Perekam Medis Ahli Muda',2,'2025-01-26 01:28:30','2025-01-26 01:28:30',NULL),(7,'Perekam Medis Ahli Madya\n',2,'2025-01-26 01:28:30','2025-01-26 01:28:30',NULL),(8,'Perekam Medis Terampil',2,'2025-01-26 01:28:30','2025-01-26 01:28:30',NULL),(9,'Perekam Medis Mahir',2,'2025-01-26 01:28:30','2025-01-26 01:28:30',NULL),(10,'Perekam Medis Penyelia',2,'2025-01-26 01:28:30','2025-01-26 01:28:30',NULL);
/*!40000 ALTER TABLE `competences` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `failed_jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
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
-- Table structure for table `filings`
--

DROP TABLE IF EXISTS `filings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `filings` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `letter_no` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date DEFAULT NULL,
  `is_end` tinyint NOT NULL DEFAULT '0',
  `category_id` smallint unsigned NOT NULL,
  `user_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint NOT NULL DEFAULT '0' COMMENT '0: pending; 1: review; 2:done;',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `end_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `decrees_letter_no_category_id_unique` (`letter_no`,`category_id`),
  KEY `decrees_user_id_foreign` (`user_id`),
  KEY `filings_category_id_foreign` (`category_id`),
  CONSTRAINT `decrees_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  CONSTRAINT `filings_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `filings`
--

LOCK TABLES `filings` WRITE;
/*!40000 ALTER TABLE `filings` DISABLE KEYS */;
INSERT INTO `filings` VALUES ('1fb307e2-8334-4041-99d1-dab9fab139d0','Kredensial Terakhir','SURAT/KRE/0003443','2025-03-01',NULL,0,7,'9d84ddb3-8f64-446c-a23f-8aadc796ed04',2,'2025-03-01 07:19:19','2025-03-01 07:19:19',NULL),('258f1831-dc9f-4d41-8e97-504d8a8a3c3f','Kredensial','DUMMY/1740811714','2025-03-01','2027-03-01',1,9,'a940383d-ae93-43d8-bb4f-e7b004e5d132',2,'2025-03-01 06:46:52','2025-03-01 06:53:17','2025-03-01 06:53:17'),('88ce7f1f-512d-4440-8001-260d6ad35791','Kredensial','DUMMY/1740813063','2025-03-01','2028-03-01',1,9,'9d84ddb3-8f64-446c-a23f-8aadc796ed04',2,'2025-03-01 07:10:45','2025-03-01 07:26:26','2025-03-01 07:26:26'),('f47ac10b-58cc-4372-a567-0e02b2c3d479','Kredensial Data Assesment1','KRE/001/2025','2024-01-01','2025-01-31',1,9,'f431dc34-1964-43ee-866e-402508142372',2,'2025-01-28 00:39:49','2025-01-28 00:43:08',NULL),('f47ac10b-58cc-4372-a567-0e02b2c3d488','Kredensial','DUMMY/1738127942','2025-01-01','2027-01-31',1,9,'47a085ec-0567-4a2b-b845-9d563d680a05',2,'2025-01-29 03:01:00','2025-01-29 15:33:16','2025-01-29 15:33:16');
/*!40000 ALTER TABLE `filings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `media`
--

DROP TABLE IF EXISTS `media`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `media` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `uuid` char(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `collection_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `file_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mime_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `disk` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `conversions_disk` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `size` bigint unsigned NOT NULL,
  `manipulations` json NOT NULL,
  `custom_properties` json NOT NULL,
  `generated_conversions` json NOT NULL,
  `responsive_images` json NOT NULL,
  `order_column` int unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `media_uuid_unique` (`uuid`),
  KEY `media_model_type_model_id_index` (`model_type`,`model_id`),
  KEY `media_order_column_index` (`order_column`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `media`
--

LOCK TABLES `media` WRITE;
/*!40000 ALTER TABLE `media` DISABLE KEYS */;
INSERT INTO `media` VALUES (3,'App\\Models\\Filing','3','a6af3819-2da5-4b03-87d5-9686a3f84b96','filing','buka.blob-3','kredensial-data-assesment-1738024789.pdf','application/pdf','public','public',655131,'[]','[]','[]','[]',1,'2025-01-28 00:39:49','2025-01-28 00:39:49'),(4,'App\\Models\\Filing','1fb307e2-8334-4041-99d1-dab9fab139d0','f371abf4-040c-46dd-a6ec-ff22dffc4bce','filing','TABEL RAMADHAN 1446 H _ 2025-2','kredensial-terakhir-1740813559.pdf','application/pdf','public','public',49589,'[]','[]','[]','[]',1,'2025-03-01 07:19:19','2025-03-01 07:19:19');
/*!40000 ALTER TABLE `media` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'2014_10_12_100000_create_password_reset_tokens_table',1),(2,'2014_10_12_100000_create_password_resets_table',1),(3,'2019_08_19_000000_create_failed_jobs_table',1),(4,'2019_12_14_000001_create_personal_access_tokens_table',1),(5,'2023_12_11_015843_create_permission_tables',1),(6,'2024_11_12_090021_create_categories_table',1),(7,'2024_11_12_090022_create_users_table',1),(9,'2025_01_25_161904_create_competences_table',1),(10,'2025_01_25_164822_create_filings_table',1),(11,'2025_01_25_165611_create_questions_table',1),(12,'2025_01_25_165618_create_choices_table',1),(13,'2025_01_25_170302_create_answers_table',1),(14,'2025_01_25_170930_create_media_table',1),(17,'2024_11_12_090023_create_profiles_table',2),(24,'2025_01_29_075748_create_profession_assesor_table',4),(26,'2025_01_26_065655_add_paid_to_users_table',5),(27,'2025_03_02_110519_create_professions_table',6);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `model_has_permissions`
--

DROP TABLE IF EXISTS `model_has_permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `model_has_permissions` (
  `permission_id` bigint unsigned NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`),
  CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `model_has_permissions`
--

LOCK TABLES `model_has_permissions` WRITE;
/*!40000 ALTER TABLE `model_has_permissions` DISABLE KEYS */;
INSERT INTO `model_has_permissions` VALUES (15,'App\\Models\\User','93444d7d-fca3-468f-8859-2ca5f1695bbe'),(16,'App\\Models\\User','93444d7d-fca3-468f-8859-2ca5f1695bbe'),(15,'App\\Models\\User','b68bf31c-b8b1-4946-883a-1a5797b57475'),(16,'App\\Models\\User','b68bf31c-b8b1-4946-883a-1a5797b57475'),(15,'App\\Models\\User','f431dc34-1964-43ee-866e-402508142372'),(16,'App\\Models\\User','f431dc34-1964-43ee-866e-402508142372');
/*!40000 ALTER TABLE `model_has_permissions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `model_has_roles`
--

DROP TABLE IF EXISTS `model_has_roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `model_has_roles` (
  `role_id` bigint unsigned NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`),
  CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `model_has_roles`
--

LOCK TABLES `model_has_roles` WRITE;
/*!40000 ALTER TABLE `model_has_roles` DISABLE KEYS */;
INSERT INTO `model_has_roles` VALUES (7,'App\\Models\\User','47a085ec-0567-4a2b-b845-9d563d680a05'),(7,'App\\Models\\User','573c2e4f-62f4-4b1d-a2c9-b99f797ddb77'),(7,'App\\Models\\User','93444d7d-fca3-468f-8859-2ca5f1695bbe'),(7,'App\\Models\\User','9d84ddb3-8f64-446c-a23f-8aadc796ed04'),(7,'App\\Models\\User','a940383d-ae93-43d8-bb4f-e7b004e5d132'),(7,'App\\Models\\User','b68bf31c-b8b1-4946-883a-1a5797b57475'),(1,'App\\Models\\User','f431dc34-1964-43ee-866e-402508142372');
/*!40000 ALTER TABLE `model_has_roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_reset_tokens`
--

DROP TABLE IF EXISTS `password_reset_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_reset_tokens`
--

LOCK TABLES `password_reset_tokens` WRITE;
/*!40000 ALTER TABLE `password_reset_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_reset_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_resets`
--

LOCK TABLES `password_resets` WRITE;
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `permissions`
--

DROP TABLE IF EXISTS `permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `permissions` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `permissions`
--

LOCK TABLES `permissions` WRITE;
/*!40000 ALTER TABLE `permissions` DISABLE KEYS */;
INSERT INTO `permissions` VALUES (1,'roles-list','web','2021-04-30 00:15:05','2021-04-30 00:15:05'),(2,'roles-create','web','2021-04-30 00:15:05','2021-04-30 00:15:05'),(3,'roles-edit','web','2021-04-30 00:15:05','2021-04-30 00:15:05'),(4,'roles-delete','web','2021-04-30 00:15:05','2021-04-30 00:15:05'),(5,'users-list','web','2021-04-30 00:15:05','2021-04-30 00:15:05'),(6,'users-create','web','2021-04-30 00:15:05','2021-04-30 00:15:05'),(7,'users-edit','web','2021-04-30 00:15:05','2021-04-30 00:15:05'),(8,'users-delete','web','2021-04-30 00:15:05','2021-04-30 00:15:05'),(9,'dashboard','web','2021-04-30 00:15:05','2021-04-30 00:15:05'),(10,'categories','web','2021-04-30 00:15:05','2021-04-30 00:15:05'),(13,'credential-questions-list','web','2021-04-30 00:15:05','2021-04-30 00:15:05'),(14,'credential-assessment','web','2021-04-30 00:15:05','2021-04-30 00:15:05'),(15,'assessor-list','web','2021-04-30 00:15:05','2021-04-30 00:15:05'),(16,'assessor-create','web','2021-04-30 00:15:05','2021-04-30 00:15:05'),(17,'competences','web','2021-04-30 00:15:05','2021-04-30 00:15:05'),(18,'consumers-list','web','2021-04-30 00:15:05','2021-04-30 00:15:05'),(19,'consumers-create','web','2021-04-30 00:15:05','2021-04-30 00:15:05'),(20,'receivables-registration-list','web','2021-04-30 00:15:05','2021-04-30 00:15:05'),(21,'receivables-registration-create','web','2021-04-30 00:15:05','2021-04-30 00:15:05'),(22,'credential-questions-create','web','2021-04-30 00:15:05','2021-04-30 00:15:05'),(23,'credential-questions-edit','web','2021-04-30 00:15:05','2021-04-30 00:15:05'),(24,'credential-questions-delete','web','2021-04-30 00:15:05','2021-04-30 00:15:05');
/*!40000 ALTER TABLE `permissions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `personal_access_tokens`
--

DROP TABLE IF EXISTS `personal_access_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `personal_access_tokens` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `personal_access_tokens`
--

LOCK TABLES `personal_access_tokens` WRITE;
/*!40000 ALTER TABLE `personal_access_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `personal_access_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `profession_assesor`
--

DROP TABLE IF EXISTS `profession_assesor`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `profession_assesor` (
  `profession_id` smallint unsigned NOT NULL,
  `assesor_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  KEY `profession_assesor_profession_id_foreign` (`profession_id`),
  KEY `profession_assesor_assesor_id_foreign` (`assesor_id`),
  CONSTRAINT `profession_assesor_assesor_id_foreign` FOREIGN KEY (`assesor_id`) REFERENCES `users` (`id`),
  CONSTRAINT `profession_assesor_profession_id_foreign` FOREIGN KEY (`profession_id`) REFERENCES `categories` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `profession_assesor`
--

LOCK TABLES `profession_assesor` WRITE;
/*!40000 ALTER TABLE `profession_assesor` DISABLE KEYS */;
INSERT INTO `profession_assesor` VALUES (2,'f431dc34-1964-43ee-866e-402508142372'),(1,'b68bf31c-b8b1-4946-883a-1a5797b57475'),(14,'b68bf31c-b8b1-4946-883a-1a5797b57475');
/*!40000 ALTER TABLE `profession_assesor` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `professions`
--

DROP TABLE IF EXISTS `professions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `professions` (
  `id` smallint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `committee` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `professions`
--

LOCK TABLES `professions` WRITE;
/*!40000 ALTER TABLE `professions` DISABLE KEYS */;
/*!40000 ALTER TABLE `professions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `profiles`
--

DROP TABLE IF EXISTS `profiles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `profiles` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `nik` varchar(16) COLLATE utf8mb4_unicode_ci NOT NULL,
  `place_of_birth` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_of_birth` date NOT NULL,
  `gender` tinyint NOT NULL COMMENT '0: Laki-laki; 1: Perempuan',
  `doctoral_degree` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `academic_degree` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `province` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `city` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `subdistrict` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `district` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone_emergency` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `account_socmed` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `profession_id` smallint unsigned NOT NULL,
  `competence_id` smallint unsigned NOT NULL,
  `employee_status_id` smallint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `profiles_nik_unique` (`nik`),
  UNIQUE KEY `profiles_phone_unique` (`phone`),
  UNIQUE KEY `profiles_user_id_unique` (`user_id`),
  KEY `profiles_profession_id_foreign` (`profession_id`),
  KEY `profiles_employee_status_id_foreign` (`employee_status_id`),
  KEY `profiles_competence_id_foreign` (`competence_id`),
  CONSTRAINT `profiles_competence_id_foreign` FOREIGN KEY (`competence_id`) REFERENCES `competences` (`id`),
  CONSTRAINT `profiles_employee_status_id_foreign` FOREIGN KEY (`employee_status_id`) REFERENCES `categories` (`id`),
  CONSTRAINT `profiles_profession_id_foreign` FOREIGN KEY (`profession_id`) REFERENCES `categories` (`id`),
  CONSTRAINT `profiles_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `profiles`
--

LOCK TABLES `profiles` WRITE;
/*!40000 ALTER TABLE `profiles` DISABLE KEYS */;
INSERT INTO `profiles` VALUES (1,'3201234434343433','Bogor1','1993-02-07',0,NULL,'S.T','Jl Raya Puncak Gadog','Jawa Barat','Bogor','Ciawi','Pandansari','6281223343434','6282323232323',NULL,'f431dc34-1964-43ee-866e-402508142372',2,2,3,'2025-01-27 13:51:55','2025-01-28 05:42:23'),(5,'3201234434343422','Sumedang','2000-01-01',1,NULL,'Amd. Rekam','Kelok 9','Jawa Barat','Sumedang','Cilunjak','Jebrod','6281223342222','6282320000000',NULL,'47a085ec-0567-4a2b-b845-9d563d680a05',2,2,3,'2025-01-27 13:51:55','2025-01-28 05:42:23'),(7,'1232243434343434','Bandung','1990-03-08',0,NULL,'S.Tr.RMIK','Jl Raya Puncak','Jawa Barat','Bogor','Cisarua','Tugu Selatan','62832423232323','6284343434333',NULL,'a940383d-ae93-43d8-bb4f-e7b004e5d132',2,2,3,'2025-03-01 06:46:44','2025-03-01 06:46:44'),(8,'3242342342342342','Sukabumi','1993-03-09',0,NULL,'S.Tr.RMI','Ciawi Gadog','Jawa Barat','Bogor','Ciawi','ciawi','628434343434343','62894343435542',NULL,'9d84ddb3-8f64-446c-a23f-8aadc796ed04',2,2,3,'2025-03-01 07:09:14','2025-03-01 07:09:14');
/*!40000 ALTER TABLE `profiles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `questions`
--

DROP TABLE IF EXISTS `questions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `questions` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `serial_number` smallint NOT NULL DEFAULT '0',
  `active` tinyint NOT NULL DEFAULT '1',
  `competence_id` smallint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `questions_competence_id_foreign` (`competence_id`),
  CONSTRAINT `questions_competence_id_foreign` FOREIGN KEY (`competence_id`) REFERENCES `competences` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `questions`
--

LOCK TABLES `questions` WRITE;
/*!40000 ALTER TABLE `questions` DISABLE KEYS */;
INSERT INTO `questions` VALUES (6,'Cupidatat a laboris x',1,1,1,'2025-01-27 00:14:00','2025-01-27 02:43:10'),(8,'Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC',1,1,2,'2025-01-27 02:42:54','2025-01-27 02:42:54'),(10,'Laboriosam providen',2,1,1,'2025-01-27 02:48:02','2025-01-27 02:48:02'),(11,'Consequatur cupidit',2,1,2,'2025-01-27 02:52:53','2025-01-27 02:52:53'),(12,'Culpa laboris eligen',3,1,2,'2025-01-28 00:55:12','2025-01-28 00:55:12'),(13,'Eum odit in est enim',4,1,2,'2025-01-28 00:55:36','2025-01-28 00:55:36'),(14,'Rerum obcaecati dolo',5,1,2,'2025-01-28 00:55:52','2025-01-28 00:55:52'),(15,'Apakah Selesai?',1,1,6,'2025-03-01 06:56:05','2025-03-01 06:56:54');
/*!40000 ALTER TABLE `questions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `role_has_permissions`
--

DROP TABLE IF EXISTS `role_has_permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `role_has_permissions` (
  `permission_id` bigint unsigned NOT NULL,
  `role_id` bigint unsigned NOT NULL,
  PRIMARY KEY (`permission_id`,`role_id`),
  KEY `role_has_permissions_role_id_foreign` (`role_id`),
  CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `role_has_permissions`
--

LOCK TABLES `role_has_permissions` WRITE;
/*!40000 ALTER TABLE `role_has_permissions` DISABLE KEYS */;
INSERT INTO `role_has_permissions` VALUES (1,1),(2,1),(3,1),(4,1),(5,1),(6,1),(7,1),(8,1),(9,1),(10,1),(13,1),(14,1),(15,1),(16,1),(17,1),(18,1),(19,1),(20,1),(21,1),(22,1),(23,1),(24,1),(9,7),(14,7),(9,8),(10,8),(13,8),(14,8),(15,8),(16,8),(17,8),(22,8),(23,8),(24,8);
/*!40000 ALTER TABLE `role_has_permissions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `roles` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `roles`
--

LOCK TABLES `roles` WRITE;
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` VALUES (1,'Super Admin','web',NULL,NULL),(7,'Nakes Lainnya','web','2025-01-25 23:05:23','2025-01-25 23:05:23'),(8,'Assessor Nakes Lainnya','web','2025-01-28 15:09:26','2025-01-28 15:09:26');
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nip` varchar(18) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `profile_completed` tinyint NOT NULL DEFAULT '0',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_username_unique` (`username`),
  UNIQUE KEY `users_nip_unique` (`nip`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES ('47a085ec-0567-4a2b-b845-9d563d680a05','Nusa','nusa','324934938483894389','$2y$12$nBM4oxwJTod4fmpL2BvVse1ND/fz56W8TNpls1wQSPkDB3N/L/lvq',0,NULL,'2025-01-27 08:10:11','2025-01-27 08:10:11',NULL),('93444d7d-fca3-468f-8859-2ca5f1695bbe','Santi Susanti','santi','434343437463765637','$2y$12$nBM4oxwJTod4fmpL2BvVse1ND/fz56W8TNpls1wQSPkDB3N/L/lvq',0,NULL,'2025-01-26 00:17:13','2025-01-26 00:17:13',NULL),('9d84ddb3-8f64-446c-a23f-8aadc796ed04','Ayu','ayu','232323434343434343','$2y$12$nBM4oxwJTod4fmpL2BvVse1ND/fz56W8TNpls1wQSPkDB3N/L/lvq',1,NULL,'2025-03-01 07:03:51','2025-03-01 07:09:14',NULL),('a940383d-ae93-43d8-bb4f-e7b004e5d132','Riki','riki','199232848384384393','$2y$12$nBM4oxwJTod4fmpL2BvVse1ND/fz56W8TNpls1wQSPkDB3N/L/lvq',1,NULL,'2025-03-01 06:28:42','2025-03-01 06:46:44',NULL),('b68bf31c-b8b1-4946-883a-1a5797b57475','Andik Vermansyah','andik','332323243434545455','$2y$12$nBM4oxwJTod4fmpL2BvVse1ND/fz56W8TNpls1wQSPkDB3N/L/lvq',0,NULL,'2025-01-25 23:38:12','2025-01-25 23:38:12',NULL),('f431dc34-1964-43ee-866e-402508142372','Rizal Pamungkas','super.admin','919930207201911101','$2y$12$nBM4oxwJTod4fmpL2BvVse1ND/fz56W8TNpls1wQSPkDB3N/L/lvq',1,NULL,'2025-01-25 10:22:20','2025-03-01 06:27:10',NULL);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping events for database 'credential'
--

--
-- Dumping routines for database 'credential'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2025-06-30 13:20:42
