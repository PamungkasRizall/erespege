-- MySQL dump 10.13  Distrib 8.0.23, for macos10.15 (x86_64)
--
-- Host: localhost    Database: pege
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
-- Table structure for table `approvals`
--

DROP TABLE IF EXISTS `approvals`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `approvals` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `approvalable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `approvalable_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint NOT NULL DEFAULT '0' COMMENT '0: Reject; 1: Done',
  `notes` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL,
  `created_by` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `approvals_approvalable_type_approvalable_id_index` (`approvalable_type`,`approvalable_id`),
  KEY `approvals_created_by_foreign` (`created_by`),
  CONSTRAINT `approvals_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `approvals`
--

LOCK TABLES `approvals` WRITE;
/*!40000 ALTER TABLE `approvals` DISABLE KEYS */;
INSERT INTO `approvals` VALUES (21,'App\\Models\\CompetenceBA','85c83849-e5f3-4199-b4de-94d6e0fecceb',1,'caatatta','2025-03-21 17:14:48','6ace8df6-f1bd-4405-a086-17c15c0c7e1g'),(22,'App\\Models\\Filing','e2bb8633-9044-47e9-81f1-e9a16fabb950',1,'dsdsdsds','2025-03-21 17:17:13','a940383d-ae93-43d8-bb4f-e7b004e5d135'),(23,'App\\Models\\CompetenceBA','03fcb119-04aa-4163-945f-a7f771f6f87c',1,'cTtTRn','2025-04-25 01:46:48','6ace8df6-f1bd-4405-a086-17c15c0c7e1g'),(24,'App\\Models\\Filing','8c42e490-ce68-4b06-ad3f-cc316174109b',1,'c atdttaa','2025-04-25 01:48:53','a940383d-ae93-43d8-bb4f-e7b004e5d135');
/*!40000 ALTER TABLE `approvals` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `categories` (
  `id` smallint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `parent_id` smallint unsigned DEFAULT NULL,
  `cat` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `categories_parent_id_foreign` (`parent_id`),
  CONSTRAINT `categories_parent_id_foreign` FOREIGN KEY (`parent_id`) REFERENCES `categories` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categories`
--

LOCK TABLES `categories` WRITE;
/*!40000 ALTER TABLE `categories` DISABLE KEYS */;
INSERT INTO `categories` VALUES (3,'PNS','Status Pegawai',NULL,NULL,'2025-01-27 13:37:43','2025-01-27 13:37:43',NULL),(4,'PPPK','Status Pegawai',NULL,NULL,'2025-01-27 13:37:51','2025-01-27 13:37:51',NULL),(5,'Kontrak','Status Pegawai',NULL,NULL,'2025-01-27 13:38:06','2025-01-27 13:38:06',NULL),(6,'Outsourcing','Status Pegawai',NULL,NULL,'2025-01-27 13:38:17','2025-01-27 13:38:17',NULL),(7,'Formulir kewenangan klinis yang terisi lengkap','Pemberkasan',NULL,NULL,'2025-01-27 14:33:30','2025-03-14 01:11:34',NULL),(8,'Daftar Riwayat Hidup','Pemberkasan',NULL,NULL,'2025-01-27 14:33:30','2025-03-14 01:11:12',NULL),(9,'Ijazah','Pemberkasan',NULL,NULL,'2025-03-14 01:14:26','2025-03-14 01:14:26',NULL),(10,'Surat Tanda Register','Pemberkasan',NULL,NULL,'2025-03-14 01:15:13','2025-03-14 01:15:13',NULL),(11,'SIK / SIP','Pemberkasan',NULL,NULL,'2025-03-14 01:15:13','2025-03-14 01:15:13',NULL),(12,'Sertifikat Pelatihan-pelatihan','Pemberkasan',NULL,NULL,'2025-03-14 01:15:37','2025-03-14 01:15:37',NULL),(13,'Logbook (3 Bulan Terakhir)','Pemberkasan',NULL,NULL,'2025-03-14 01:15:37','2025-03-14 01:15:37',NULL),(14,'Rekapan Penilaian Kinerja (3 Bulan Terakhir)','Pemberkasan',NULL,NULL,'2025-03-14 01:15:37','2025-03-14 01:15:37',NULL),(24,'Kredensial','Kredensial',NULL,NULL,'2025-03-14 01:15:37','2025-03-14 01:15:37',NULL);
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
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sequence` tinyint NOT NULL,
  `is_correct` tinyint(1) NOT NULL DEFAULT '0',
  `score` double NOT NULL DEFAULT '0',
  `competence_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `choices_name_competence_id_unique` (`name`,`competence_id`),
  KEY `choices_competence_id_foreign` (`competence_id`),
  CONSTRAINT `choices_competence_id_foreign` FOREIGN KEY (`competence_id`) REFERENCES `competences` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `choices`
--

LOCK TABLES `choices` WRITE;
/*!40000 ALTER TABLE `choices` DISABLE KEYS */;
INSERT INTO `choices` VALUES (17,'Kompeten Sepenuhnya',1,0,0,'11906399-8c82-4745-ad24-b525738f5345'),(18,'Memerlukan Supervisi',2,0,0,'11906399-8c82-4745-ad24-b525738f5345'),(19,'Tidak Dimintakan Kewenangannya Karena diluar Kompetensinya',3,0,0,'11906399-8c82-4745-ad24-b525738f5345'),(20,'Tidak Dimintakan Kewenangannya Karena Fasilitas Tidak Tersedia',4,0,0,'11906399-8c82-4745-ad24-b525738f5345'),(21,'Kompeten Sepenuhnya',1,0,0,'6ec0594f-d147-4aac-a8cc-03dd9d98ac5a'),(22,'Memerlukan Supervisi',2,0,0,'6ec0594f-d147-4aac-a8cc-03dd9d98ac5a'),(23,'Tidak Dimintakan Kewenangannya Karena diluar Kompetensinya',3,0,0,'6ec0594f-d147-4aac-a8cc-03dd9d98ac5a'),(24,'Tidak Dimintakan Kewenangannya Karena Fasilitas Tidak Tersedia',4,0,0,'6ec0594f-d147-4aac-a8cc-03dd9d98ac5a'),(25,'Kompeten Sepenuhnya',1,0,0,'d7ab9d8e-d89c-442d-ba5e-d98a34606f73'),(26,'Memerlukan Supervisi',2,0,0,'d7ab9d8e-d89c-442d-ba5e-d98a34606f73'),(27,'Tidak Dimintakan Kewenangannya Karena diluar Kompetensinya',3,0,0,'d7ab9d8e-d89c-442d-ba5e-d98a34606f73'),(28,'Tidak Dimintakan Kewenangannya Karena Fasilitas Tidak Tersedia',4,0,0,'d7ab9d8e-d89c-442d-ba5e-d98a34606f73'),(29,'Kompeten Sepenuhnya',1,0,0,'17f25731-a88e-481d-9897-605a2cf05496'),(30,'Memerlukan Supervisi',2,0,0,'17f25731-a88e-481d-9897-605a2cf05496'),(31,'Tidak Dimintakan Kewenangannya Karena diluar Kompetensinya',3,0,0,'17f25731-a88e-481d-9897-605a2cf05496'),(32,'Tidak Dimintakan Kewenangannya Karena Fasilitas Tidak Tersedia',4,0,0,'17f25731-a88e-481d-9897-605a2cf05496');
/*!40000 ALTER TABLE `choices` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `competence_answers`
--

DROP TABLE IF EXISTS `competence_answers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `competence_answers` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `competence_detail_id` bigint unsigned NOT NULL,
  `choice_id` bigint unsigned NOT NULL,
  `filing_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `assesor_id` char(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ass_choice_id` bigint unsigned DEFAULT NULL,
  `ass_score` double DEFAULT NULL,
  `ass_notes` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `competence_answers_competence_detail_id_foreign` (`competence_detail_id`),
  KEY `competence_answers_choice_id_foreign` (`choice_id`),
  KEY `competence_answers_filing_id_foreign` (`filing_id`),
  KEY `competence_answers_assesor_id_foreign` (`assesor_id`),
  KEY `competence_answers_ass_choice_id_foreign` (`ass_choice_id`),
  CONSTRAINT `competence_answers_ass_choice_id_foreign` FOREIGN KEY (`ass_choice_id`) REFERENCES `choices` (`id`),
  CONSTRAINT `competence_answers_assesor_id_foreign` FOREIGN KEY (`assesor_id`) REFERENCES `users` (`id`),
  CONSTRAINT `competence_answers_choice_id_foreign` FOREIGN KEY (`choice_id`) REFERENCES `choices` (`id`) ON DELETE CASCADE,
  CONSTRAINT `competence_answers_competence_detail_id_foreign` FOREIGN KEY (`competence_detail_id`) REFERENCES `competence_details` (`id`) ON DELETE CASCADE,
  CONSTRAINT `competence_answers_filing_id_foreign` FOREIGN KEY (`filing_id`) REFERENCES `filings` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=121 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `competence_answers`
--

LOCK TABLES `competence_answers` WRITE;
/*!40000 ALTER TABLE `competence_answers` DISABLE KEYS */;
INSERT INTO `competence_answers` VALUES (85,3,17,'e2bb8633-9044-47e9-81f1-e9a16fabb950','2025-03-21 16:54:04','2025-03-21 17:11:59','6ace8df6-f1bd-4405-a086-17c15c0c7e1f',18,NULL,NULL),(86,4,17,'e2bb8633-9044-47e9-81f1-e9a16fabb950','2025-03-21 16:54:05','2025-03-21 17:12:00','6ace8df6-f1bd-4405-a086-17c15c0c7e1f',19,NULL,NULL),(87,5,18,'e2bb8633-9044-47e9-81f1-e9a16fabb950','2025-03-21 16:54:08','2025-03-21 17:12:02','6ace8df6-f1bd-4405-a086-17c15c0c7e1f',19,NULL,NULL),(88,6,18,'e2bb8633-9044-47e9-81f1-e9a16fabb950','2025-03-21 16:54:09','2025-03-21 17:12:03','6ace8df6-f1bd-4405-a086-17c15c0c7e1f',18,NULL,NULL),(89,7,20,'e2bb8633-9044-47e9-81f1-e9a16fabb950','2025-03-21 16:54:11','2025-03-21 17:12:04','6ace8df6-f1bd-4405-a086-17c15c0c7e1f',18,NULL,NULL),(90,9,20,'e2bb8633-9044-47e9-81f1-e9a16fabb950','2025-03-21 16:54:13','2025-03-21 17:12:06','6ace8df6-f1bd-4405-a086-17c15c0c7e1f',18,NULL,NULL),(91,10,20,'e2bb8633-9044-47e9-81f1-e9a16fabb950','2025-03-21 16:54:15','2025-03-21 17:12:09','6ace8df6-f1bd-4405-a086-17c15c0c7e1f',19,NULL,NULL),(92,13,20,'e2bb8633-9044-47e9-81f1-e9a16fabb950','2025-03-21 16:54:16','2025-03-21 17:12:08','6ace8df6-f1bd-4405-a086-17c15c0c7e1f',17,NULL,NULL),(93,14,20,'e2bb8633-9044-47e9-81f1-e9a16fabb950','2025-03-21 16:54:17','2025-03-21 17:12:10','6ace8df6-f1bd-4405-a086-17c15c0c7e1f',17,NULL,NULL),(94,16,18,'e2bb8633-9044-47e9-81f1-e9a16fabb950','2025-03-21 16:54:19','2025-03-21 17:12:12','6ace8df6-f1bd-4405-a086-17c15c0c7e1f',17,NULL,NULL),(95,17,18,'e2bb8633-9044-47e9-81f1-e9a16fabb950','2025-03-21 16:54:20','2025-03-21 17:12:13','6ace8df6-f1bd-4405-a086-17c15c0c7e1f',17,NULL,NULL),(96,18,18,'e2bb8633-9044-47e9-81f1-e9a16fabb950','2025-03-21 16:54:21','2025-03-21 17:12:14','6ace8df6-f1bd-4405-a086-17c15c0c7e1f',17,NULL,NULL),(97,3,18,'a371e236-04cc-4485-b4e5-e253d7699268','2025-03-22 00:03:54','2025-03-22 00:03:54',NULL,NULL,NULL,NULL),(98,4,17,'a371e236-04cc-4485-b4e5-e253d7699268','2025-03-22 00:03:56','2025-03-22 00:03:56',NULL,NULL,NULL,NULL),(99,5,17,'a371e236-04cc-4485-b4e5-e253d7699268','2025-03-22 00:03:57','2025-03-22 00:03:57',NULL,NULL,NULL,NULL),(100,6,17,'a371e236-04cc-4485-b4e5-e253d7699268','2025-03-22 00:03:58','2025-03-22 00:03:58',NULL,NULL,NULL,NULL),(101,7,19,'a371e236-04cc-4485-b4e5-e253d7699268','2025-03-22 00:04:00','2025-03-22 00:04:00',NULL,NULL,NULL,NULL),(102,9,20,'a371e236-04cc-4485-b4e5-e253d7699268','2025-03-22 00:04:02','2025-03-22 00:04:02',NULL,NULL,NULL,NULL),(103,10,19,'a371e236-04cc-4485-b4e5-e253d7699268','2025-03-22 00:04:03','2025-03-22 00:04:03',NULL,NULL,NULL,NULL),(104,13,19,'a371e236-04cc-4485-b4e5-e253d7699268','2025-03-22 00:04:05','2025-03-22 00:04:05',NULL,NULL,NULL,NULL),(105,14,18,'a371e236-04cc-4485-b4e5-e253d7699268','2025-03-22 00:04:06','2025-03-22 00:04:06',NULL,NULL,NULL,NULL),(106,16,18,'a371e236-04cc-4485-b4e5-e253d7699268','2025-03-22 00:04:07','2025-03-22 00:04:07',NULL,NULL,NULL,NULL),(107,17,19,'a371e236-04cc-4485-b4e5-e253d7699268','2025-03-22 00:04:08','2025-03-22 00:04:08',NULL,NULL,NULL,NULL),(108,18,18,'a371e236-04cc-4485-b4e5-e253d7699268','2025-03-22 00:04:09','2025-03-22 00:04:09',NULL,NULL,NULL,NULL),(109,21,21,'8c42e490-ce68-4b06-ad3f-cc316174109b','2025-04-25 01:39:09','2025-04-25 01:42:58','6ace8df6-f1bd-4405-a086-17c15c0c7e1f',21,NULL,'catatata'),(110,22,22,'8c42e490-ce68-4b06-ad3f-cc316174109b','2025-04-25 01:39:11','2025-04-25 01:42:58','6ace8df6-f1bd-4405-a086-17c15c0c7e1f',24,NULL,NULL),(111,23,22,'8c42e490-ce68-4b06-ad3f-cc316174109b','2025-04-25 01:39:13','2025-04-25 01:43:00','6ace8df6-f1bd-4405-a086-17c15c0c7e1f',23,NULL,NULL),(112,24,23,'8c42e490-ce68-4b06-ad3f-cc316174109b','2025-04-25 01:39:24','2025-04-25 01:43:01','6ace8df6-f1bd-4405-a086-17c15c0c7e1f',24,NULL,NULL),(113,25,24,'8c42e490-ce68-4b06-ad3f-cc316174109b','2025-04-25 01:39:26','2025-04-25 01:43:03','6ace8df6-f1bd-4405-a086-17c15c0c7e1f',22,NULL,NULL),(114,28,22,'8c42e490-ce68-4b06-ad3f-cc316174109b','2025-04-25 01:39:27','2025-04-25 01:43:07','6ace8df6-f1bd-4405-a086-17c15c0c7e1f',24,NULL,NULL),(115,31,23,'8c42e490-ce68-4b06-ad3f-cc316174109b','2025-04-25 01:39:29','2025-04-25 01:43:09','6ace8df6-f1bd-4405-a086-17c15c0c7e1f',23,NULL,NULL),(116,32,23,'8c42e490-ce68-4b06-ad3f-cc316174109b','2025-04-25 01:39:30','2025-04-25 01:43:13','6ace8df6-f1bd-4405-a086-17c15c0c7e1f',21,NULL,NULL),(117,34,22,'8c42e490-ce68-4b06-ad3f-cc316174109b','2025-04-25 01:39:31','2025-04-25 01:43:15','6ace8df6-f1bd-4405-a086-17c15c0c7e1f',21,NULL,NULL),(118,35,22,'8c42e490-ce68-4b06-ad3f-cc316174109b','2025-04-25 01:39:33','2025-04-25 01:43:18','6ace8df6-f1bd-4405-a086-17c15c0c7e1f',23,NULL,NULL),(119,36,22,'8c42e490-ce68-4b06-ad3f-cc316174109b','2025-04-25 01:39:34','2025-04-25 01:43:19','6ace8df6-f1bd-4405-a086-17c15c0c7e1f',21,NULL,NULL),(120,27,21,'8c42e490-ce68-4b06-ad3f-cc316174109b','2025-04-25 01:39:57','2025-04-25 01:43:05','6ace8df6-f1bd-4405-a086-17c15c0c7e1f',23,NULL,NULL);
/*!40000 ALTER TABLE `competence_answers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `competence_bas`
--

DROP TABLE IF EXISTS `competence_bas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `competence_bas` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_at` date NOT NULL,
  `location` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `filings` json NOT NULL,
  `code` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `committee` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `number` int NOT NULL,
  `profession_id` smallint unsigned NOT NULL,
  `assesor_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sub_committee_id` char(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `competence_bas_code_unique` (`code`),
  KEY `competence_bas_profession_id_foreign` (`profession_id`),
  KEY `competence_bas_assesor_id_foreign` (`assesor_id`),
  KEY `competence_bas_sub_committee_id_foreign` (`sub_committee_id`),
  CONSTRAINT `competence_bas_assesor_id_foreign` FOREIGN KEY (`assesor_id`) REFERENCES `users` (`id`),
  CONSTRAINT `competence_bas_profession_id_foreign` FOREIGN KEY (`profession_id`) REFERENCES `professions` (`id`),
  CONSTRAINT `competence_bas_sub_committee_id_foreign` FOREIGN KEY (`sub_committee_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `competence_bas`
--

LOCK TABLES `competence_bas` WRITE;
/*!40000 ALTER TABLE `competence_bas` DISABLE KEYS */;
INSERT INTO `competence_bas` VALUES ('03fcb119-04aa-4163-945f-a7f771f6f87c','2025-04-25','Gedung Adum Lt. 2','[\"8c42e490-ce68-4b06-ad3f-cc316174109b\"]','KTKL/KREDENSIAL/BA/01/04/2025','nakes-lainnya',1,1,'6ace8df6-f1bd-4405-a086-17c15c0c7e1f','6ace8df6-f1bd-4405-a086-17c15c0c7e1g','2025-04-25 01:44:19','2025-04-25 01:46:48'),('85c83849-e5f3-4199-b4de-94d6e0fecceb','2025-03-22','Adum Lt. 2','[\"e2bb8633-9044-47e9-81f1-e9a16fabb950\"]','KTKL/KREDENSIAL/BA/01/03/2025','nakes-lainnya',1,1,'6ace8df6-f1bd-4405-a086-17c15c0c7e1f','6ace8df6-f1bd-4405-a086-17c15c0c7e1g','2025-03-21 17:14:12','2025-03-21 17:14:48');
/*!40000 ALTER TABLE `competence_bas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `competence_details`
--

DROP TABLE IF EXISTS `competence_details`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `competence_details` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `full_code` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `parent_id` bigint unsigned DEFAULT NULL,
  `type` tinyint NOT NULL COMMENT '0: group; 1: unit; 2: element',
  `serial_number` smallint DEFAULT NULL,
  `competence_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `competence_details_full_code_competence_id_unique` (`full_code`,`competence_id`),
  KEY `competence_details_competence_id_foreign` (`competence_id`),
  CONSTRAINT `competence_details_competence_id_foreign` FOREIGN KEY (`competence_id`) REFERENCES `competences` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=73 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `competence_details`
--

LOCK TABLES `competence_details` WRITE;
/*!40000 ALTER TABLE `competence_details` DISABLE KEYS */;
INSERT INTO `competence_details` VALUES (1,'G1//0','Manajemen Data & Informasi Kesehatan',NULL,0,NULL,'11906399-8c82-4745-ad24-b525738f5345'),(2,'G1/Q.86RMK01.001.1/1','Menganalisis Kebutuhan Data Sistem Informasi Kesehatan',1,1,NULL,'11906399-8c82-4745-ad24-b525738f5345'),(3,'G1/Q.86RMK01.001.1/1/1','Menentukan instrumen kebutuhan data',2,2,1,'11906399-8c82-4745-ad24-b525738f5345'),(4,'G1/Q.86RMK01.001.1/1/2','Mengumpulkan kebutuhan data pengguna',2,2,2,'11906399-8c82-4745-ad24-b525738f5345'),(5,'G1/Q.86RMK01.001.1/1/3','Melakukan observasi ke lokasi pengguna',2,2,3,'11906399-8c82-4745-ad24-b525738f5345'),(6,'G1/Q.86RMK01.001.1/1/4','Menelaah dokumen pengguna',2,2,4,'11906399-8c82-4745-ad24-b525738f5345'),(7,'G1/Q.86RMK01.001.1/1/5','Melakukan analisis kebutuhan data',2,2,5,'11906399-8c82-4745-ad24-b525738f5345'),(8,'G1/Q.86RMK01.002.1/2','Merancang Kamus Data dalam Sistem Informasi Kesehatan',1,1,NULL,'11906399-8c82-4745-ad24-b525738f5345'),(9,'G1/Q.86RMK01.002.1/2/1','Menyiapkan daftar elemen kamus data',8,2,6,'11906399-8c82-4745-ad24-b525738f5345'),(10,'G1/Q.86RMK01.002.1/2/2','Melengkapi istilah elemen kamus data',8,2,7,'11906399-8c82-4745-ad24-b525738f5345'),(11,'G2//2','Klasifikasi Klinis, Kodifikasi Penyakit dan Masalah Kesehatan Lainnya, serta Prosedur Klinis',NULL,0,NULL,'11906399-8c82-4745-ad24-b525738f5345'),(12,'G2/Q.86RMK02.031.1/3','Menentukan Standar Kodifikasi Klinis',11,1,NULL,'11906399-8c82-4745-ad24-b525738f5345'),(13,'G2/Q.86RMK02.031.1/3/1','Menyiapkan pedoman standar kodifikasi klinis',12,2,8,'11906399-8c82-4745-ad24-b525738f5345'),(14,'G2/Q.86RMK02.031.1/3/2','Menetapkan standar kodifikasi klinis',12,2,9,'11906399-8c82-4745-ad24-b525738f5345'),(15,'G2/Q.86RMK02.032.1/4','Menetapkan Kodifikasi Klinis',11,1,NULL,'11906399-8c82-4745-ad24-b525738f5345'),(16,'G2/Q.86RMK02.032.1/4/1','Menyiapkan perlengkapan kodifikasi klinis',15,2,10,'11906399-8c82-4745-ad24-b525738f5345'),(17,'G2/Q.86RMK02.032.1/4/2','Melaksanakan kodifikasi klinis',15,2,11,'11906399-8c82-4745-ad24-b525738f5345'),(18,'G2/Q.86RMK02.032.1/4/3','Menentukan kodifikasi klinis',15,2,12,'11906399-8c82-4745-ad24-b525738f5345'),(19,'G1//0','Manajemen Data & Informasi Kesehatan',NULL,0,NULL,'6ec0594f-d147-4aac-a8cc-03dd9d98ac5a'),(20,'G1/Q.86RMK01.001.1/1','Menganalisis Kebutuhan Data Sistem Informasi Kesehatan',19,1,NULL,'6ec0594f-d147-4aac-a8cc-03dd9d98ac5a'),(21,'G1/Q.86RMK01.001.1/1/1','Menentukan instrumen kebutuhan data',20,2,1,'6ec0594f-d147-4aac-a8cc-03dd9d98ac5a'),(22,'G1/Q.86RMK01.001.1/1/2','Mengumpulkan kebutuhan data pengguna',20,2,2,'6ec0594f-d147-4aac-a8cc-03dd9d98ac5a'),(23,'G1/Q.86RMK01.001.1/1/3','Melakukan observasi ke lokasi pengguna',20,2,3,'6ec0594f-d147-4aac-a8cc-03dd9d98ac5a'),(24,'G1/Q.86RMK01.001.1/1/4','Menelaah dokumen pengguna',20,2,4,'6ec0594f-d147-4aac-a8cc-03dd9d98ac5a'),(25,'G1/Q.86RMK01.001.1/1/5','Melakukan analisis kebutuhan data',20,2,5,'6ec0594f-d147-4aac-a8cc-03dd9d98ac5a'),(26,'G1/Q.86RMK01.002.1/2','Merancang Kamus Data dalam Sistem Informasi Kesehatan',19,1,NULL,'6ec0594f-d147-4aac-a8cc-03dd9d98ac5a'),(27,'G1/Q.86RMK01.002.1/2/1','Menyiapkan daftar elemen kamus data',26,2,6,'6ec0594f-d147-4aac-a8cc-03dd9d98ac5a'),(28,'G1/Q.86RMK01.002.1/2/2','Melengkapi istilah elemen kamus data',26,2,7,'6ec0594f-d147-4aac-a8cc-03dd9d98ac5a'),(29,'G2//2','Klasifikasi Klinis, Kodifikasi Penyakit dan Masalah Kesehatan Lainnya, serta Prosedur Klinis',NULL,0,NULL,'6ec0594f-d147-4aac-a8cc-03dd9d98ac5a'),(30,'G2/Q.86RMK02.031.1/3','Menentukan Standar Kodifikasi Klinis',29,1,NULL,'6ec0594f-d147-4aac-a8cc-03dd9d98ac5a'),(31,'G2/Q.86RMK02.031.1/3/1','Menyiapkan pedoman standar kodifikasi klinis',30,2,8,'6ec0594f-d147-4aac-a8cc-03dd9d98ac5a'),(32,'G2/Q.86RMK02.031.1/3/2','Menetapkan standar kodifikasi klinis',30,2,9,'6ec0594f-d147-4aac-a8cc-03dd9d98ac5a'),(33,'G2/Q.86RMK02.032.1/4','Menetapkan Kodifikasi Klinis',29,1,NULL,'6ec0594f-d147-4aac-a8cc-03dd9d98ac5a'),(34,'G2/Q.86RMK02.032.1/4/1','Menyiapkan perlengkapan kodifikasi klinis',33,2,10,'6ec0594f-d147-4aac-a8cc-03dd9d98ac5a'),(35,'G2/Q.86RMK02.032.1/4/2','Melaksanakan kodifikasi klinis',33,2,11,'6ec0594f-d147-4aac-a8cc-03dd9d98ac5a'),(36,'G2/Q.86RMK02.032.1/4/3','Menentukan kodifikasi klinis',33,2,12,'6ec0594f-d147-4aac-a8cc-03dd9d98ac5a'),(37,'G1//0','Manajemen Data & Informasi Kesehatan',NULL,0,NULL,'d7ab9d8e-d89c-442d-ba5e-d98a34606f73'),(38,'G1/Q.86RMK01.001.1/1','Menganalisis Kebutuhan Data Sistem Informasi Kesehatan',37,1,NULL,'d7ab9d8e-d89c-442d-ba5e-d98a34606f73'),(39,'G1/Q.86RMK01.001.1/1/1','Menentukan instrumen kebutuhan data',38,2,1,'d7ab9d8e-d89c-442d-ba5e-d98a34606f73'),(40,'G1/Q.86RMK01.001.1/1/2','Mengumpulkan kebutuhan data pengguna',38,2,2,'d7ab9d8e-d89c-442d-ba5e-d98a34606f73'),(41,'G1/Q.86RMK01.001.1/1/3','Melakukan observasi ke lokasi pengguna',38,2,3,'d7ab9d8e-d89c-442d-ba5e-d98a34606f73'),(42,'G1/Q.86RMK01.001.1/1/4','Menelaah dokumen pengguna',38,2,4,'d7ab9d8e-d89c-442d-ba5e-d98a34606f73'),(43,'G1/Q.86RMK01.001.1/1/5','Melakukan analisis kebutuhan data',38,2,5,'d7ab9d8e-d89c-442d-ba5e-d98a34606f73'),(44,'G1/Q.86RMK01.002.1/2','Merancang Kamus Data dalam Sistem Informasi Kesehatan',37,1,NULL,'d7ab9d8e-d89c-442d-ba5e-d98a34606f73'),(45,'G1/Q.86RMK01.002.1/2/1','Menyiapkan daftar elemen kamus data',44,2,6,'d7ab9d8e-d89c-442d-ba5e-d98a34606f73'),(46,'G1/Q.86RMK01.002.1/2/2','Melengkapi istilah elemen kamus data',44,2,7,'d7ab9d8e-d89c-442d-ba5e-d98a34606f73'),(47,'G2//2','Klasifikasi Klinis, Kodifikasi Penyakit dan Masalah Kesehatan Lainnya, serta Prosedur Klinis',NULL,0,NULL,'d7ab9d8e-d89c-442d-ba5e-d98a34606f73'),(48,'G2/Q.86RMK02.031.1/3','Menentukan Standar Kodifikasi Klinis',47,1,NULL,'d7ab9d8e-d89c-442d-ba5e-d98a34606f73'),(49,'G2/Q.86RMK02.031.1/3/1','Menyiapkan pedoman standar kodifikasi klinis',48,2,8,'d7ab9d8e-d89c-442d-ba5e-d98a34606f73'),(50,'G2/Q.86RMK02.031.1/3/2','Menetapkan standar kodifikasi klinis',48,2,9,'d7ab9d8e-d89c-442d-ba5e-d98a34606f73'),(51,'G2/Q.86RMK02.032.1/4','Menetapkan Kodifikasi Klinis',47,1,NULL,'d7ab9d8e-d89c-442d-ba5e-d98a34606f73'),(52,'G2/Q.86RMK02.032.1/4/1','Menyiapkan perlengkapan kodifikasi klinis',51,2,10,'d7ab9d8e-d89c-442d-ba5e-d98a34606f73'),(53,'G2/Q.86RMK02.032.1/4/2','Melaksanakan kodifikasi klinis',51,2,11,'d7ab9d8e-d89c-442d-ba5e-d98a34606f73'),(54,'G2/Q.86RMK02.032.1/4/3','Menentukan kodifikasi klinis',51,2,12,'d7ab9d8e-d89c-442d-ba5e-d98a34606f73'),(55,'G1//0','Contoh Kelompok Kompetensi 1',NULL,0,NULL,'17f25731-a88e-481d-9897-605a2cf05496'),(56,'G1/Q.86RMK01.001.1/1','Contoh Unit Kompetensi 1.1',55,1,NULL,'17f25731-a88e-481d-9897-605a2cf05496'),(57,'G1/Q.86RMK01.001.1/1/1','Contoh Elemen Kompetensi 1.1.1',56,2,1,'17f25731-a88e-481d-9897-605a2cf05496'),(58,'G1/Q.86RMK01.001.1/1/2','Contoh Elemen Kompetensi 1.1.2',56,2,2,'17f25731-a88e-481d-9897-605a2cf05496'),(59,'G1/Q.86RMK01.001.1/1/3','Contoh Elemen Kompetensi 1.1.3',56,2,3,'17f25731-a88e-481d-9897-605a2cf05496'),(60,'G1/Q.86RMK01.001.1/1/4','Contoh Elemen Kompetensi 1.1.4',56,2,4,'17f25731-a88e-481d-9897-605a2cf05496'),(61,'G1/Q.86RMK01.001.1/1/5','Contoh Elemen Kompetensi 1.1.5',56,2,5,'17f25731-a88e-481d-9897-605a2cf05496'),(62,'G1/Q.86RMK01.002.1/2','Contoh Unit Kompetensi 1.2',55,1,NULL,'17f25731-a88e-481d-9897-605a2cf05496'),(63,'G1/Q.86RMK01.002.1/2/1','Contoh Elemen Kompetensi 1.2.1',62,2,6,'17f25731-a88e-481d-9897-605a2cf05496'),(64,'G1/Q.86RMK01.002.1/2/2','Contoh Elemen Kompetensi 1.2.2',62,2,7,'17f25731-a88e-481d-9897-605a2cf05496'),(65,'G2//2','Contoh Kelompok Kompetensi 2',NULL,0,NULL,'17f25731-a88e-481d-9897-605a2cf05496'),(66,'G2/Q.86RMK02.031.1/3','Contoh Unit Kompetensi 2.1',65,1,NULL,'17f25731-a88e-481d-9897-605a2cf05496'),(67,'G2/Q.86RMK02.031.1/3/1','Contoh Elemen Kompetensi 2.1.1',66,2,8,'17f25731-a88e-481d-9897-605a2cf05496'),(68,'G2/Q.86RMK02.031.1/3/2','Contoh Elemen Kompetensi 2.1.2',66,2,9,'17f25731-a88e-481d-9897-605a2cf05496'),(69,'G2/Q.86RMK02.032.1/4','Contoh Unit Kompetensi 2.2',65,1,NULL,'17f25731-a88e-481d-9897-605a2cf05496'),(70,'G2/Q.86RMK02.032.1/4/1','Contoh Elemen Kompetensi 2.2.1',69,2,10,'17f25731-a88e-481d-9897-605a2cf05496'),(71,'G2/Q.86RMK02.032.1/4/2','Contoh Elemen Kompetensi 2.2.2',69,2,11,'17f25731-a88e-481d-9897-605a2cf05496'),(72,'G2/Q.86RMK02.032.1/4/3','Contoh Elemen Kompetensi 2.2.3',69,2,12,'17f25731-a88e-481d-9897-605a2cf05496');
/*!40000 ALTER TABLE `competence_details` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `competences`
--

DROP TABLE IF EXISTS `competences`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `competences` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `functional_position_id` smallint unsigned NOT NULL,
  `active` tinyint NOT NULL DEFAULT '0' COMMENT '0: not active; 1: active',
  `created_at` timestamp NULL DEFAULT NULL,
  `created_by` char(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `updated_by` char(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `deleted_by` char(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `competences_code_functional_position_id_unique` (`code`,`functional_position_id`),
  KEY `competences_created_by_foreign` (`created_by`),
  KEY `competences_updated_by_foreign` (`updated_by`),
  KEY `competences_deleted_by_foreign` (`deleted_by`),
  KEY `competences_functional_position_id_foreign` (`functional_position_id`),
  CONSTRAINT `competences_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`),
  CONSTRAINT `competences_deleted_by_foreign` FOREIGN KEY (`deleted_by`) REFERENCES `users` (`id`),
  CONSTRAINT `competences_functional_position_id_foreign` FOREIGN KEY (`functional_position_id`) REFERENCES `functional_positions` (`id`),
  CONSTRAINT `competences_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `competences`
--

LOCK TABLES `competences` WRITE;
/*!40000 ALTER TABLE `competences` DISABLE KEYS */;
INSERT INTO `competences` VALUES ('11906399-8c82-4745-ad24-b525738f5345','RM/001/MADYA',7,1,'2025-03-04 04:32:45','f431dc34-1964-43ee-866e-402508142372','2025-03-26 02:34:23','f431dc34-1964-43ee-866e-402508142372',NULL,NULL),('17f25731-a88e-481d-9897-605a2cf05496','RM/002/MUDA',4,1,'2025-03-26 02:33:32','f431dc34-1964-43ee-866e-402508142372','2025-03-26 02:35:37','f431dc34-1964-43ee-866e-402508142372',NULL,NULL),('6ec0594f-d147-4aac-a8cc-03dd9d98ac5a','RM/00012/PERTAMA',5,1,'2025-03-06 03:25:13','f431dc34-1964-43ee-866e-402508142372','2025-03-08 08:00:33','f431dc34-1964-43ee-866e-402508142372',NULL,NULL),('d7ab9d8e-d89c-442d-ba5e-d98a34606f73','KODE/0019',10,1,'2025-03-12 01:09:14','f431dc34-1964-43ee-866e-402508142372','2025-03-12 01:09:30','f431dc34-1964-43ee-866e-402508142372',NULL,NULL);
/*!40000 ALTER TABLE `competences` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `departments`
--

DROP TABLE IF EXISTS `departments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `departments` (
  `id` smallint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `parent_id` smallint unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `departments_department_id_foreign` (`parent_id`),
  CONSTRAINT `departments_department_id_foreign` FOREIGN KEY (`parent_id`) REFERENCES `departments` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `departments`
--

LOCK TABLES `departments` WRITE;
/*!40000 ALTER TABLE `departments` DISABLE KEYS */;
INSERT INTO `departments` VALUES (1,'Direktur Utama',NULL,NULL,NULL,NULL),(2,'Direktorat Medik dan Keperawatan',1,NULL,NULL,NULL),(3,'Direktorat Sumber Daya Manusia, Pendidikan dan Penelitian',1,NULL,NULL,NULL),(4,'Direktorat Perencanaan Keuangan dan Layanan Operasional',1,NULL,NULL,NULL),(5,'Komite',1,NULL,NULL,NULL),(6,'Satuan Pemeriksaan Internal',1,NULL,NULL,NULL),(7,'Instalasi Rekam Medik',4,NULL,NULL,NULL),(8,'Instalasi Farmasi',2,NULL,NULL,NULL),(9,'Instalasi Radiologi',2,NULL,NULL,NULL),(10,'Instalasi SIMRS',4,NULL,NULL,NULL);
/*!40000 ALTER TABLE `departments` ENABLE KEYS */;
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
-- Table structure for table `filings`
--

DROP TABLE IF EXISTS `filings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `filings` (
  `id` char(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `letter_no` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date DEFAULT NULL,
  `is_end` tinyint NOT NULL DEFAULT '0',
  `category_id` smallint unsigned NOT NULL,
  `user_id` char(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `competence_id` char(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` bigint NOT NULL DEFAULT '0' COMMENT '0: pending; 1: review; 2:done;',
  `origin` tinyint NOT NULL DEFAULT '0' COMMENT '0: manual; 1: system',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `end_at` timestamp NULL DEFAULT NULL,
  `recomendation_code` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `recomendation_at` date DEFAULT NULL,
  `cp_at` date DEFAULT NULL,
  `cp_created_at` datetime DEFAULT NULL,
  `str_code` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sik_code` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `decrees_letter_no_category_id_unique` (`letter_no`,`category_id`),
  KEY `decrees_user_id_foreign` (`user_id`),
  KEY `filings_category_id_foreign` (`category_id`),
  KEY `filings_competence_id_foreign` (`competence_id`),
  CONSTRAINT `decrees_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  CONSTRAINT `filings_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`),
  CONSTRAINT `filings_competence_id_foreign` FOREIGN KEY (`competence_id`) REFERENCES `competences` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `filings`
--

LOCK TABLES `filings` WRITE;
/*!40000 ALTER TABLE `filings` DISABLE KEYS */;
INSERT INTO `filings` VALUES ('03ec6cc8-b3d1-421f-9c7b-936640fdbf7d','Rekapan Penilaian Kinerja (3 Bulan Terakhir)','dsfdsfd','2025-04-25',NULL,0,14,'f19710cd-840c-49b4-a3a3-c3a147d71230',NULL,7,0,'2025-04-25 01:34:13','2025-04-25 01:34:19','2025-04-25 01:34:19',NULL,NULL,NULL,NULL,NULL,NULL),('05b99fbc-f7e0-426f-b14b-e1547432a5f9','Daftar Riwayat Hidup','dsdasdasdas','2025-04-25',NULL,0,8,'f19710cd-840c-49b4-a3a3-c3a147d71230',NULL,7,0,'2025-04-25 01:29:11','2025-04-25 01:34:19','2025-04-25 01:34:19',NULL,NULL,NULL,NULL,NULL,NULL),('0d240dc8-1071-4006-ac51-9e1a429ce383','Formulir kewenangan klinis yang terisi lengkap','gfdgdfgdf','2025-03-22',NULL,0,7,'aee9d4cd-8165-40ce-a0a8-55986355eccf',NULL,7,0,'2025-03-21 23:04:31','2025-03-22 22:56:32','2025-03-22 22:56:32',NULL,NULL,NULL,NULL,NULL,NULL),('302f1676-1b35-4903-b0e6-d10c7a46b4fc','SIK / SIP','dgfgdfgfd','2025-03-22',NULL,0,11,'aee9d4cd-8165-40ce-a0a8-55986355eccf',NULL,7,0,'2025-03-21 23:04:59','2025-03-22 22:56:32','2025-03-22 22:56:32',NULL,NULL,NULL,NULL,NULL,NULL),('3ae3cb2d-0a01-4643-bce8-194f52ce7a1c','SIK / SIP','dsdsds','2025-03-26',NULL,0,11,'960aa111-cf8c-4b34-818c-e4aee328e387',NULL,7,0,'2025-03-26 02:26:07','2025-03-26 02:27:20','2025-03-26 02:27:20',NULL,NULL,NULL,NULL,NULL,NULL),('5ea4a860-bc0d-4a84-b049-501667de053b','Formulir kewenangan klinis yang terisi lengkap','3423423jfdfsdfsd','2025-04-25',NULL,0,7,'f19710cd-840c-49b4-a3a3-c3a147d71230',NULL,7,0,'2025-04-25 01:28:55','2025-04-25 01:34:19','2025-04-25 01:34:19',NULL,NULL,NULL,NULL,NULL,NULL),('738bdd67-6849-46a8-9f84-bb5f0e8a042f','Ijazah','dasdasdasdqweqw','2025-04-25',NULL,0,9,'f19710cd-840c-49b4-a3a3-c3a147d71230',NULL,7,0,'2025-04-25 01:29:18','2025-04-25 01:34:19','2025-04-25 01:34:19',NULL,NULL,NULL,NULL,NULL,NULL),('8c42e490-ce68-4b06-ad3f-cc316174109b','Kredensial','DM.01.01/XXXIV.1/00044/2025','2025-04-25','2028-04-25',0,24,'f19710cd-840c-49b4-a3a3-c3a147d71230','6ec0594f-d147-4aac-a8cc-03dd9d98ac5a',7,1,'2025-04-25 01:38:14','2025-04-25 01:50:38','2025-04-25 01:43:24','KDL/0012/2025','2025-04-25','2025-04-25','2025-04-25 08:50:10','dsadsadasds','dasdsadasd'),('976fef16-328c-4045-81dd-13aeea81661c','Surat Tanda Register','cxcxcxcxcx','2025-03-26',NULL,0,10,'960aa111-cf8c-4b34-818c-e4aee328e387',NULL,7,0,'2025-03-26 02:25:34','2025-03-26 02:27:20','2025-03-26 02:27:20',NULL,NULL,NULL,NULL,NULL,NULL),('982806a3-143b-4e74-bc26-dc625a6da320','Daftar Riwayat Hidup','dsaszdsadasds','2025-03-26',NULL,0,8,'960aa111-cf8c-4b34-818c-e4aee328e387',NULL,7,0,'2025-03-26 02:25:18','2025-03-26 02:27:20','2025-03-26 02:27:20',NULL,NULL,NULL,NULL,NULL,NULL),('984564fa-e7fb-4b08-b70a-c0736d37a9be','Ijazah','fgdgfg','2025-03-22',NULL,0,9,'aee9d4cd-8165-40ce-a0a8-55986355eccf',NULL,7,0,'2025-03-21 23:04:45','2025-03-22 22:56:32','2025-03-22 22:56:32',NULL,NULL,NULL,NULL,NULL,NULL),('a371e236-04cc-4485-b4e5-e253d7699268','Kredensial','BELUM-ADA/1742601813','2025-03-31','2028-03-31',0,24,'aee9d4cd-8165-40ce-a0a8-55986355eccf','11906399-8c82-4745-ad24-b525738f5345',1,1,'2025-03-22 00:03:33','2025-03-22 00:04:41','2025-03-22 00:04:41',NULL,NULL,NULL,NULL,'vcvdf','dgfgdfgfd'),('a80de83b-576a-4ae4-8df9-55bd1fe564aa','Sertifikat Pelatihan-pelatihan','fdsfsdfsd','2025-03-22',NULL,0,12,'aee9d4cd-8165-40ce-a0a8-55986355eccf',NULL,7,0,'2025-03-21 23:05:05','2025-03-22 22:56:32','2025-03-22 22:56:32',NULL,NULL,NULL,NULL,NULL,NULL),('ad9a2943-8752-4555-b077-facc5be8ba3b','Sertifikat Pelatihan-pelatihan','fsdvcxvcxvxc','2025-03-26',NULL,0,12,'960aa111-cf8c-4b34-818c-e4aee328e387',NULL,7,0,'2025-03-26 02:26:15','2025-03-26 02:27:20','2025-03-26 02:27:20',NULL,NULL,NULL,NULL,NULL,NULL),('ae85f179-1202-42db-8fe3-dd919b678797','SIK / SIP','dasdsadasd','2025-04-25',NULL,0,11,'f19710cd-840c-49b4-a3a3-c3a147d71230',NULL,7,0,'2025-04-25 01:29:35','2025-04-25 01:34:19','2025-04-25 01:34:19',NULL,NULL,NULL,NULL,NULL,NULL),('b15a114d-280a-476f-9f47-ce87b20a422e','Surat Tanda Register','vcvdf','2025-03-22',NULL,0,10,'aee9d4cd-8165-40ce-a0a8-55986355eccf',NULL,7,0,'2025-03-21 23:04:52','2025-03-22 22:56:32','2025-03-22 22:56:32',NULL,NULL,NULL,NULL,NULL,NULL),('bc5671b8-9ac0-40cc-a828-3d8603c159cb','Logbook (3 Bulan Terakhir)','sdfdfdfd','2025-03-26',NULL,0,13,'960aa111-cf8c-4b34-818c-e4aee328e387',NULL,7,0,'2025-03-26 02:26:23','2025-03-26 02:27:20','2025-03-26 02:27:20',NULL,NULL,NULL,NULL,NULL,NULL),('bff37c56-8a92-4bc5-98fd-251770a99739','Rekapan Penilaian Kinerja (3 Bulan Terakhir)','sdfsdfsd','2025-03-22',NULL,0,14,'aee9d4cd-8165-40ce-a0a8-55986355eccf',NULL,7,0,'2025-03-21 23:05:20','2025-03-22 22:56:32','2025-03-22 22:56:32',NULL,NULL,NULL,NULL,NULL,NULL),('d00ec8c5-55c6-4724-832c-6e7687bf3b72','Surat Tanda Register','dsadsadasds','2025-04-25',NULL,0,10,'f19710cd-840c-49b4-a3a3-c3a147d71230',NULL,7,0,'2025-04-25 01:29:26','2025-04-25 01:34:19','2025-04-25 01:34:19',NULL,NULL,NULL,NULL,NULL,NULL),('d6241b95-aa44-43ac-8393-54cd3e034af8','Logbook (3 Bulan Terakhir)','dfdfsdfsd','2025-03-22',NULL,0,13,'aee9d4cd-8165-40ce-a0a8-55986355eccf',NULL,7,0,'2025-03-21 23:05:14','2025-03-22 22:56:32','2025-03-22 22:56:32',NULL,NULL,NULL,NULL,NULL,NULL),('db4f5dc0-d4f0-4b86-8dd8-b9add3f97039','Formulir kewenangan klinis yang terisi lengkap','ewqedsadsdsds','2025-03-26',NULL,0,7,'960aa111-cf8c-4b34-818c-e4aee328e387',NULL,7,0,'2025-03-26 02:24:37','2025-03-26 02:27:20','2025-03-26 02:27:20',NULL,NULL,NULL,NULL,NULL,NULL),('e2bb8633-9044-47e9-81f1-e9a16fabb950','Kredensial','DM.01.01/XXXIV.1/1233/2025','2022-03-30','2025-03-30',0,24,'aee9d4cd-8165-40ce-a0a8-55986355eccf','11906399-8c82-4745-ad24-b525738f5345',7,1,'2025-03-21 16:53:33','2025-03-21 17:18:00','2025-03-21 17:13:22','REK/00123/2025','2025-03-22','2025-03-22','2025-03-22 00:17:46','STRCODE/0012','SIKCODE/00143'),('e4110c30-8c82-4768-aa1c-96b056ee7d3a','Rekapan Penilaian Kinerja (3 Bulan Terakhir)','fdsfsdfdfd','2025-03-26',NULL,0,14,'960aa111-cf8c-4b34-818c-e4aee328e387',NULL,7,0,'2025-03-26 02:27:11','2025-03-26 02:27:20','2025-03-26 02:27:20',NULL,NULL,NULL,NULL,NULL,NULL),('e80f2a51-bdeb-4fe8-ba4d-88b3bdccb00b','Ijazah','dsadsdsds','2025-03-26',NULL,0,9,'960aa111-cf8c-4b34-818c-e4aee328e387',NULL,7,0,'2025-03-26 02:25:26','2025-03-26 02:27:20','2025-03-26 02:27:20',NULL,NULL,NULL,NULL,NULL,NULL),('eb78ae58-1e45-4128-a11b-f3169a13cdcc','Logbook (3 Bulan Terakhir)','dasdsadas323321','2025-04-25',NULL,0,13,'f19710cd-840c-49b4-a3a3-c3a147d71230',NULL,7,0,'2025-04-25 01:29:51','2025-04-25 01:34:19','2025-04-25 01:34:19',NULL,NULL,NULL,NULL,NULL,NULL),('f2e66f90-1e45-4e07-ba0f-c66eade57d50','Sertifikat Pelatihan-pelatihan','dsadasd23321','2025-04-25',NULL,0,12,'f19710cd-840c-49b4-a3a3-c3a147d71230',NULL,7,0,'2025-04-25 01:29:42','2025-04-25 01:34:19','2025-04-25 01:34:19',NULL,NULL,NULL,NULL,NULL,NULL),('f3ad09bf-2f03-4d62-bc9d-5836285d32f3','Daftar Riwayat Hidup','dssdsds','2025-03-22',NULL,0,8,'aee9d4cd-8165-40ce-a0a8-55986355eccf',NULL,7,0,'2025-03-21 23:04:39','2025-03-22 22:56:32','2025-03-22 22:56:32',NULL,NULL,NULL,NULL,NULL,NULL);
/*!40000 ALTER TABLE `filings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `functional_positions`
--

DROP TABLE IF EXISTS `functional_positions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `functional_positions` (
  `id` smallint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `profession_id` smallint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `created_by` char(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `updated_by` char(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `deleted_by` char(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `functional_positions_created_by_foreign` (`created_by`),
  KEY `functional_positions_updated_by_foreign` (`updated_by`),
  KEY `functional_positions_deleted_by_foreign` (`deleted_by`),
  KEY `functional_positions_profession_id_foreign` (`profession_id`),
  CONSTRAINT `functional_positions_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`),
  CONSTRAINT `functional_positions_deleted_by_foreign` FOREIGN KEY (`deleted_by`) REFERENCES `users` (`id`),
  CONSTRAINT `functional_positions_profession_id_foreign` FOREIGN KEY (`profession_id`) REFERENCES `professions` (`id`),
  CONSTRAINT `functional_positions_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `functional_positions`
--

LOCK TABLES `functional_positions` WRITE;
/*!40000 ALTER TABLE `functional_positions` DISABLE KEYS */;
INSERT INTO `functional_positions` VALUES (1,'Apoteker Ahli Pertama',2,'2025-01-26 01:27:36',NULL,'2025-01-26 01:28:22',NULL,NULL,NULL),(2,'Apoteker Ahli Muda',2,'2025-01-26 01:28:30',NULL,'2025-01-26 01:28:30',NULL,NULL,NULL),(3,'Apoteker Ahli Madya',2,'2025-01-26 01:28:30',NULL,'2025-01-26 01:28:30',NULL,NULL,NULL),(4,'Apoteker Ahli Utama',2,'2025-01-26 01:28:30',NULL,'2025-01-26 01:28:30',NULL,NULL,NULL),(5,'Perekam Medis Ahli Pertama',1,'2025-01-26 01:28:30',NULL,'2025-01-26 01:28:30',NULL,NULL,NULL),(6,'Perekam Medis Ahli Muda',1,'2025-01-26 01:28:30',NULL,'2025-01-26 01:28:30',NULL,NULL,NULL),(7,'Perekam Medis Ahli Madya',1,'2025-01-26 01:28:30',NULL,'2025-01-26 01:28:30',NULL,NULL,NULL),(8,'Perekam Medis Terampil',1,'2025-01-26 01:28:30',NULL,'2025-01-26 01:28:30',NULL,NULL,NULL),(9,'Perekam Medis Mahir',1,'2025-01-26 01:28:30',NULL,'2025-01-26 01:28:30',NULL,NULL,NULL),(10,'Perekam Medis Penyelia',1,'2025-01-26 01:28:30',NULL,'2025-01-26 01:28:30',NULL,NULL,NULL);
/*!40000 ALTER TABLE `functional_positions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `media`
--

DROP TABLE IF EXISTS `media`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `media` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `model_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` char(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `uuid` char(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `collection_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `file_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `mime_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `disk` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `conversions_disk` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
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
) ENGINE=InnoDB AUTO_INCREMENT=85 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `media`
--

LOCK TABLES `media` WRITE;
/*!40000 ALTER TABLE `media` DISABLE KEYS */;
INSERT INTO `media` VALUES (41,'App\\Models\\Filing','e2bb8633-9044-47e9-81f1-e9a16fabb950','36e7e50a-08f4-4619-b002-9150442c3c74','filing','#Rotasi Pegawai KPPA 2025','maulana-strmik-1742577480.pdf','application/pdf','public','public',491828,'[]','[]','[]','[]',1,'2025-03-21 17:18:00','2025-03-21 17:18:00'),(58,'App\\Models\\Filing','0d240dc8-1071-4006-ac51-9e1a429ce383','90348b1d-3f15-4019-a9d1-ad57f0de858b','filing','#Rotasi Pegawai KPPA 2025','formulir-kewenangan-klinis-yang-terisi-lengkap-1742598271.pdf','application/pdf','public','public',491828,'[]','[]','[]','[]',1,'2025-03-21 23:04:31','2025-03-21 23:04:31'),(59,'App\\Models\\Filing','f3ad09bf-2f03-4d62-bc9d-5836285d32f3','73ea92aa-faa2-44d3-953e-6ffa36de4b68','filing','#Rotasi Pegawai KPPA 2025','daftar-riwayat-hidup-1742598279.pdf','application/pdf','public','public',491828,'[]','[]','[]','[]',1,'2025-03-21 23:04:39','2025-03-21 23:04:39'),(60,'App\\Models\\Filing','984564fa-e7fb-4b08-b70a-c0736d37a9be','1466507b-c290-4c16-819e-4d3cbc767541','filing','#Rotasi Pegawai KPPA 2025','ijazah-1742598285.pdf','application/pdf','public','public',491828,'[]','[]','[]','[]',1,'2025-03-21 23:04:45','2025-03-21 23:04:45'),(61,'App\\Models\\Filing','b15a114d-280a-476f-9f47-ce87b20a422e','a52cc5df-928e-46f9-84dc-aadd6fc3e652','filing','#Rotasi Pegawai KPPA 2025','surat-tanda-register-1742598292.pdf','application/pdf','public','public',491828,'[]','[]','[]','[]',1,'2025-03-21 23:04:52','2025-03-21 23:04:52'),(62,'App\\Models\\Filing','302f1676-1b35-4903-b0e6-d10c7a46b4fc','51f6d310-c952-40d6-acc1-6b12903e6894','filing','#Rotasi Pegawai KPPA 2025','sik-sip-1742598299.pdf','application/pdf','public','public',491828,'[]','[]','[]','[]',1,'2025-03-21 23:04:59','2025-03-21 23:04:59'),(63,'App\\Models\\Filing','a80de83b-576a-4ae4-8df9-55bd1fe564aa','d35ac5f3-575a-43c0-ad2a-c01b01c1ec81','filing','#Rotasi Pegawai KPPA 2025','sertifikat-pelatihan-pelatihan-1742598305.pdf','application/pdf','public','public',491828,'[]','[]','[]','[]',1,'2025-03-21 23:05:05','2025-03-21 23:05:05'),(64,'App\\Models\\Filing','d6241b95-aa44-43ac-8393-54cd3e034af8','a99c0941-3f3f-424e-9474-7e3399abbc5d','filing','#Rotasi Pegawai KPPA 2025','logbook-3-bulan-terakhir-1742598314.pdf','application/pdf','public','public',491828,'[]','[]','[]','[]',1,'2025-03-21 23:05:14','2025-03-21 23:05:14'),(65,'App\\Models\\Filing','bff37c56-8a92-4bc5-98fd-251770a99739','9cacac83-271f-4570-b626-bef052802723','filing','#Rotasi Pegawai KPPA 2025','rekapan-penilaian-kinerja-3-bulan-terakhir-1742598320.pdf','application/pdf','public','public',491828,'[]','[]','[]','[]',1,'2025-03-21 23:05:20','2025-03-21 23:05:20'),(66,'App\\Models\\Filing','db4f5dc0-d4f0-4b86-8dd8-b9add3f97039','a71187d7-6cc8-4392-888c-f13225541473','filing','Labu Darah PMI Kabupaten Bogor Bulan Januari TA 2025-compressed','formulir-kewenangan-klinis-yang-terisi-lengkap-1742955877.pdf','application/pdf','public','public',954749,'[]','[]','[]','[]',1,'2025-03-26 02:24:37','2025-03-26 02:24:37'),(67,'App\\Models\\Filing','982806a3-143b-4e74-bc26-dc625a6da320','488ae67a-ba9e-420f-ad28-12c5e482448f','filing','Labu Darah PMI Kabupaten Bogor Bulan Januari TA 2025-compressed','daftar-riwayat-hidup-1742955918.pdf','application/pdf','public','public',954749,'[]','[]','[]','[]',1,'2025-03-26 02:25:18','2025-03-26 02:25:18'),(68,'App\\Models\\Filing','e80f2a51-bdeb-4fe8-ba4d-88b3bdccb00b','b6f6c1a0-c4a2-4cfa-97c9-3e7dbf2aec5b','filing','Labu Darah PMI Kabupaten Bogor Bulan Januari TA 2025-compressed','ijazah-1742955926.pdf','application/pdf','public','public',954749,'[]','[]','[]','[]',1,'2025-03-26 02:25:26','2025-03-26 02:25:26'),(69,'App\\Models\\Filing','976fef16-328c-4045-81dd-13aeea81661c','b2b057dd-61ed-495c-8735-b2b623820a94','filing','Labu Darah PMI Kabupaten Bogor Bulan Januari TA 2025-compressed','surat-tanda-register-1742955934.pdf','application/pdf','public','public',954749,'[]','[]','[]','[]',1,'2025-03-26 02:25:34','2025-03-26 02:25:34'),(70,'App\\Models\\Filing','3ae3cb2d-0a01-4643-bce8-194f52ce7a1c','8b80d853-ff92-495e-b3da-32e0e8664b5c','filing','Labu Darah PMI Kabupaten Bogor Bulan Januari TA 2025-compressed','sik-sip-1742955967.pdf','application/pdf','public','public',954749,'[]','[]','[]','[]',1,'2025-03-26 02:26:07','2025-03-26 02:26:07'),(71,'App\\Models\\Filing','ad9a2943-8752-4555-b077-facc5be8ba3b','1adcb8cc-b0f3-4a75-b60e-53c499a33d58','filing','Labu Darah PMI Kabupaten Bogor Bulan Januari TA 2025-compressed','sertifikat-pelatihan-pelatihan-1742955975.pdf','application/pdf','public','public',954749,'[]','[]','[]','[]',1,'2025-03-26 02:26:15','2025-03-26 02:26:15'),(72,'App\\Models\\Filing','bc5671b8-9ac0-40cc-a828-3d8603c159cb','29a2f2a0-c9e9-4d16-b103-44f10138c03b','filing','Labu Darah PMI Kabupaten Bogor Bulan Januari TA 2025-compressed','logbook-3-bulan-terakhir-1742955983.pdf','application/pdf','public','public',954749,'[]','[]','[]','[]',1,'2025-03-26 02:26:23','2025-03-26 02:26:23'),(74,'App\\Models\\Filing','e4110c30-8c82-4768-aa1c-96b056ee7d3a','5051ed7a-2b9e-49c1-bde0-f333b7a9a0cc','filing','Labu Darah PMI Kabupaten Bogor Bulan Januari TA 2025-compressed','rekapan-penilaian-kinerja-3-bulan-terakhir-1742956031.pdf','application/pdf','public','public',954749,'[]','[]','[]','[]',1,'2025-03-26 02:27:11','2025-03-26 02:27:11'),(75,'App\\Models\\Filing','5ea4a860-bc0d-4a84-b049-501667de053b','b266826f-4325-400a-8379-14621c903b10','filing','3201240702930008_kartuUjian','formulir-kewenangan-klinis-yang-terisi-lengkap-1745544535.pdf','application/pdf','public','public',382361,'[]','[]','[]','[]',1,'2025-04-25 01:28:55','2025-04-25 01:28:55'),(76,'App\\Models\\Filing','05b99fbc-f7e0-426f-b14b-e1547432a5f9','37cd9fca-3ab3-489e-9046-11d9a9b04d4c','filing','3201240702930008_kartuUjian','daftar-riwayat-hidup-1745544551.pdf','application/pdf','public','public',382361,'[]','[]','[]','[]',1,'2025-04-25 01:29:11','2025-04-25 01:29:11'),(77,'App\\Models\\Filing','738bdd67-6849-46a8-9f84-bb5f0e8a042f','395aeb50-83f8-49ff-9f90-b75c8bab1e98','filing','3201240702930008_kartuUjian','ijazah-1745544558.pdf','application/pdf','public','public',382361,'[]','[]','[]','[]',1,'2025-04-25 01:29:18','2025-04-25 01:29:18'),(78,'App\\Models\\Filing','d00ec8c5-55c6-4724-832c-6e7687bf3b72','e969b00a-19a1-49a7-a127-c1a6c9dea7e7','filing','3201240702930008_kartuUjian','surat-tanda-register-1745544566.pdf','application/pdf','public','public',382361,'[]','[]','[]','[]',1,'2025-04-25 01:29:26','2025-04-25 01:29:26'),(79,'App\\Models\\Filing','ae85f179-1202-42db-8fe3-dd919b678797','2233d85e-2a38-408c-9ead-499661f20fc2','filing','3201240702930008_kartuUjian','sik-sip-1745544575.pdf','application/pdf','public','public',382361,'[]','[]','[]','[]',1,'2025-04-25 01:29:35','2025-04-25 01:29:35'),(80,'App\\Models\\Filing','f2e66f90-1e45-4e07-ba0f-c66eade57d50','1d3442d0-5d9a-4543-93eb-db4a47fcca4b','filing','3201240702930008_kartuUjian','sertifikat-pelatihan-pelatihan-1745544582.pdf','application/pdf','public','public',382361,'[]','[]','[]','[]',1,'2025-04-25 01:29:42','2025-04-25 01:29:42'),(81,'App\\Models\\Filing','eb78ae58-1e45-4128-a11b-f3169a13cdcc','4540d0d2-e804-4ffc-853a-6e9314ca57d7','filing','3201240702930008_kartuUjian','logbook-3-bulan-terakhir-1745544591.pdf','application/pdf','public','public',382361,'[]','[]','[]','[]',1,'2025-04-25 01:29:51','2025-04-25 01:29:51'),(83,'App\\Models\\Filing','03ec6cc8-b3d1-421f-9c7b-936640fdbf7d','756dd2f0-50c9-40af-b7ba-41d987638e28','filing','3201240702930008_kartuUjian','rekapan-penilaian-kinerja-3-bulan-terakhir-1745544853.pdf','application/pdf','public','public',382361,'[]','[]','[]','[]',1,'2025-04-25 01:34:13','2025-04-25 01:34:13'),(84,'App\\Models\\Filing','8c42e490-ce68-4b06-ad3f-cc316174109b','7a0ebfb0-f90e-49d3-8fc4-8b7cc655266e','filing','3201240702930008_kartuAkun-5','adamn-rm-1745545838.pdf','application/pdf','public','public',76704,'[]','[]','[]','[]',1,'2025-04-25 01:50:38','2025-04-25 01:50:38');
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
  `migration` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=54 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'2014_10_12_100000_create_password_reset_tokens_table',1),(2,'2014_10_12_100000_create_password_resets_table',1),(3,'2019_08_19_000000_create_failed_jobs_table',1),(4,'2019_12_14_000001_create_personal_access_tokens_table',1),(5,'2023_12_11_015843_create_permission_tables',1),(6,'2024_11_12_090021_create_categories_table',1),(7,'2024_11_12_090022_create_users_table',1),(9,'2025_01_25_161904_create_competences_table',1),(10,'2025_03_05_161905_create_filings_table',1),(14,'2025_01_25_170930_create_media_table',1),(17,'2025_03_02_170023_create_profiles_table',2),(24,'2025_03_02_171748_create_profession_assesor_table',4),(28,'2025_03_02_110519_create_professions_table',5),(29,'2025_03_02_161904_create_competences_table',6),(30,'2025_03_02_161904_create_functional_positions_table',7),(31,'2025_03_02_175748_create_profession_assesor_table',8),(33,'2025_03_02_174311_create_competences_table',9),(37,'2025_03_02_185935_create_competence_details_table',11),(39,'2025_03_04_165618_create_choices_table',12),(40,'2025_03_05_115923_create_approvals_table',13),(41,'2025_03_06_115615_create_competence_answers_table',14),(47,'2025_03_12_114109_create_structures_table',16),(49,'2025_03_12_114417_create_user_structure_table',17),(50,'2025_03_08_130837_create_competence_bas_table',18),(51,'2025_03_12_101527_create_departments_table',19),(53,'2025_03_18_091443_add_paid_to_users_table',20);
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
  `model_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` char(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
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
INSERT INTO `model_has_permissions` VALUES (15,'App\\Models\\User','6ace8df6-f1bd-4405-a086-17c15c0c7e1f'),(16,'App\\Models\\User','6ace8df6-f1bd-4405-a086-17c15c0c7e1f'),(32,'App\\Models\\User','6ace8df6-f1bd-4405-a086-17c15c0c7e1g'),(35,'App\\Models\\User','6ace8df6-f1bd-4405-a086-17c15c0c7e1g'),(15,'App\\Models\\User','a940383d-ae93-43d8-bb4f-e7b004e5d132'),(16,'App\\Models\\User','a940383d-ae93-43d8-bb4f-e7b004e5d132'),(32,'App\\Models\\User','a940383d-ae93-43d8-bb4f-e7b004e5d135'),(35,'App\\Models\\User','a940383d-ae93-43d8-bb4f-e7b004e5d135');
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
  `model_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` char(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
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
INSERT INTO `model_has_roles` VALUES (7,'App\\Models\\User','1dca6968-4634-4522-9380-ba36e537f746'),(9,'App\\Models\\User','1dca6968-4634-4522-9380-ba36e537f746'),(7,'App\\Models\\User','3be1638a-ea04-4c6a-843b-1f3508e6efd9'),(9,'App\\Models\\User','3be1638a-ea04-4c6a-843b-1f3508e6efd9'),(7,'App\\Models\\User','47a085ec-0567-4a2b-b845-9d563d680a05'),(9,'App\\Models\\User','47a085ec-0567-4a2b-b845-9d563d680a05'),(7,'App\\Models\\User','573c2e4f-62f4-4b1d-a2c9-b99f797ddb77'),(7,'App\\Models\\User','6ace8df6-f1bd-4405-a086-17c15c0c7e1f'),(9,'App\\Models\\User','6ace8df6-f1bd-4405-a086-17c15c0c7e1f'),(7,'App\\Models\\User','6ace8df6-f1bd-4405-a086-17c15c0c7e1g'),(10,'App\\Models\\User','6ace8df6-f1bd-4405-a086-17c15c0c7e1g'),(7,'App\\Models\\User','92aa8b00-afa9-456b-b6e5-6a250428c2e5'),(9,'App\\Models\\User','92aa8b00-afa9-456b-b6e5-6a250428c2e5'),(10,'App\\Models\\User','92aa8b00-afa9-456b-b6e5-6a250428c2e5'),(9,'App\\Models\\User','93444d7d-fca3-468f-8859-2ca5f1695bbe'),(7,'App\\Models\\User','960aa111-cf8c-4b34-818c-e4aee328e387'),(9,'App\\Models\\User','960aa111-cf8c-4b34-818c-e4aee328e387'),(7,'App\\Models\\User','9d84ddb3-8f64-446c-a23f-8aadc796ed04'),(9,'App\\Models\\User','9d84ddb3-8f64-446c-a23f-8aadc796ed04'),(8,'App\\Models\\User','a940383d-ae93-43d8-bb4f-e7b004e5d132'),(7,'App\\Models\\User','a940383d-ae93-43d8-bb4f-e7b004e5d135'),(11,'App\\Models\\User','a940383d-ae93-43d8-bb4f-e7b004e5d135'),(7,'App\\Models\\User','aee9d4cd-8165-40ce-a0a8-55986355eccf'),(9,'App\\Models\\User','aee9d4cd-8165-40ce-a0a8-55986355eccf'),(7,'App\\Models\\User','b68bf31c-b8b1-4946-883a-1a5797b57475'),(9,'App\\Models\\User','b68bf31c-b8b1-4946-883a-1a5797b57475'),(7,'App\\Models\\User','f19710cd-840c-49b4-a3a3-c3a147d71230'),(9,'App\\Models\\User','f19710cd-840c-49b4-a3a3-c3a147d71230'),(9,'App\\Models\\User','f431dc34-1964-43ee-866e-402508142000'),(1,'App\\Models\\User','f431dc34-1964-43ee-866e-402508142372');
/*!40000 ALTER TABLE `model_has_roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_reset_tokens`
--

DROP TABLE IF EXISTS `password_reset_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
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
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
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
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`)
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `permissions`
--

LOCK TABLES `permissions` WRITE;
/*!40000 ALTER TABLE `permissions` DISABLE KEYS */;
INSERT INTO `permissions` VALUES (1,'roles-list','web','2021-04-30 00:15:05','2021-04-30 00:15:05'),(2,'roles-create','web','2021-04-30 00:15:05','2021-04-30 00:15:05'),(3,'roles-edit','web','2021-04-30 00:15:05','2021-04-30 00:15:05'),(4,'roles-delete','web','2021-04-30 00:15:05','2021-04-30 00:15:05'),(5,'users-list','web','2021-04-30 00:15:05','2021-04-30 00:15:05'),(6,'users-create','web','2021-04-30 00:15:05','2021-04-30 00:15:05'),(7,'users-edit','web','2021-04-30 00:15:05','2021-04-30 00:15:05'),(8,'users-delete','web','2021-04-30 00:15:05','2021-04-30 00:15:05'),(9,'dashboard','web','2021-04-30 00:15:05','2021-04-30 00:15:05'),(10,'categories','web','2021-04-30 00:15:05','2021-04-30 00:15:05'),(14,'credential-assessment','web','2021-04-30 00:15:05','2021-04-30 00:15:05'),(15,'assessor-list','web','2021-04-30 00:15:05','2021-04-30 00:15:05'),(16,'assessor-create','web','2021-04-30 00:15:05','2021-04-30 00:15:05'),(17,'functional-positions-list','web','2021-04-30 00:15:05','2021-04-30 00:15:05'),(25,'professions-list','web','2021-04-30 00:15:05','2021-04-30 00:15:05'),(26,'professions-create','web','2021-04-30 00:15:05','2021-04-30 00:15:05'),(27,'functional-positions-create','web','2021-04-30 00:15:05','2021-04-30 00:15:05'),(28,'competences-list','web','2021-04-30 00:15:05','2021-04-30 00:15:05'),(29,'competences-create','web','2021-04-30 00:15:05','2021-04-30 00:15:05'),(30,'sub-committee','web','2021-04-30 00:15:05','2021-04-30 00:15:05'),(31,'ketua-committee','web','2021-04-30 00:15:05','2021-04-30 00:15:05'),(32,'clinical-privileges-list','web','2021-04-30 00:15:05','2021-04-30 00:15:05'),(33,'structure-list','web','2021-04-30 00:15:05','2021-04-30 00:15:05'),(34,'structure-create','web','2021-04-30 00:15:05','2021-04-30 00:15:05'),(35,'clinical-privileges-create','web','2021-04-30 00:15:05','2021-04-30 00:15:05'),(36,'document-reviews','web','2021-04-30 00:15:05','2021-04-30 00:15:05');
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
  `tokenable_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint unsigned NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
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
  CONSTRAINT `profession_assesor_profession_id_foreign` FOREIGN KEY (`profession_id`) REFERENCES `professions` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `profession_assesor`
--

LOCK TABLES `profession_assesor` WRITE;
/*!40000 ALTER TABLE `profession_assesor` DISABLE KEYS */;
INSERT INTO `profession_assesor` VALUES (1,'a940383d-ae93-43d8-bb4f-e7b004e5d132'),(1,'6ace8df6-f1bd-4405-a086-17c15c0c7e1f');
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
  `created_by` char(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `updated_by` char(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `deleted_by` char(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `professions_created_by_foreign` (`created_by`),
  KEY `professions_updated_by_foreign` (`updated_by`),
  KEY `professions_deleted_by_foreign` (`deleted_by`),
  CONSTRAINT `professions_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`),
  CONSTRAINT `professions_deleted_by_foreign` FOREIGN KEY (`deleted_by`) REFERENCES `users` (`id`),
  CONSTRAINT `professions_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `professions`
--

LOCK TABLES `professions` WRITE;
/*!40000 ALTER TABLE `professions` DISABLE KEYS */;
INSERT INTO `professions` VALUES (1,'Perekam Medis','nakes-lainnya','2025-03-02 06:37:57',NULL,'2025-03-02 06:37:57',NULL,NULL,NULL),(2,'Apoteker','nakes-lainnya','2025-03-02 06:49:50',NULL,'2025-03-02 07:06:05','f431dc34-1964-43ee-866e-402508142372',NULL,NULL),(3,'Radiografer','nakes-lainnya','2025-03-02 06:51:03',NULL,'2025-03-02 06:51:03',NULL,NULL,NULL),(4,'SIMRS','nakes-lainnya','2025-03-02 08:25:29','f431dc34-1964-43ee-866e-402508142372','2025-03-02 08:25:29',NULL,NULL,NULL);
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
  `nik` varchar(16) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `place_of_birth` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_of_birth` date NOT NULL,
  `gender` tinyint NOT NULL COMMENT '0: Laki-laki; 1: Perempuan',
  `doctoral_degree` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `academic_degree` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `province` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `city` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `subdistrict` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `district` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone_emergency` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `account_socmed` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` char(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `profession_id` smallint unsigned NOT NULL,
  `functional_position_id` smallint unsigned NOT NULL,
  `employee_status_id` smallint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `profiles_nik_unique` (`nik`),
  UNIQUE KEY `profiles_phone_unique` (`phone`),
  UNIQUE KEY `profiles_user_id_unique` (`user_id`),
  KEY `profiles_profession_id_foreign` (`profession_id`),
  KEY `profiles_employee_status_id_foreign` (`employee_status_id`),
  KEY `profiles_competence_id_foreign` (`functional_position_id`),
  CONSTRAINT `profiles_employee_status_id_foreign` FOREIGN KEY (`employee_status_id`) REFERENCES `categories` (`id`),
  CONSTRAINT `profiles_functional_position_id_foreign` FOREIGN KEY (`functional_position_id`) REFERENCES `functional_positions` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `profiles_profession_id_foreign` FOREIGN KEY (`profession_id`) REFERENCES `professions` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `profiles_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `profiles`
--

LOCK TABLES `profiles` WRITE;
/*!40000 ALTER TABLE `profiles` DISABLE KEYS */;
INSERT INTO `profiles` VALUES (1,'3201234434343433','Bogor1','1993-02-07',0,NULL,'S.T','Jl Raya Puncak Gadog','Jawa Barat','Bogor','Ciawi','Pandansari','6281223343434','6282323232323',NULL,'f431dc34-1964-43ee-866e-402508142372',2,2,3,'2025-01-27 13:51:55','2025-01-28 05:42:23'),(7,'1232243434343434','Bandung','1990-03-08',0,NULL,'S.Tr.RMIK','Jl Raya Puncak','Jawa Barat','Bogor','Cisarua','Tugu Selatan','62832423232323','6284343434333',NULL,'a940383d-ae93-43d8-bb4f-e7b004e5d132',2,2,3,'2025-03-01 06:46:44','2025-03-01 06:46:44'),(9,'3201204934388438','Cianjur','2000-03-15',0,NULL,'S.TRMK','Jl Raya Sukabumi','Jawa Barat','Cianjur','Sudeng','Gudek','6284343434343','62845454545454',NULL,'92aa8b00-afa9-456b-b6e5-6a250428c2e5',1,7,3,'2025-03-04 06:30:49','2025-03-04 06:30:49'),(10,'2424234234234323','Ciamis','1990-03-01',0,NULL,'STr.MK','Ciamis','Jawa Barat','Ciamis','Ciawi','Cisarua','6283232323232','62893232333434',NULL,'6ace8df6-f1bd-4405-a086-17c15c0c7e1f',1,9,3,'2025-03-07 07:44:16','2025-03-07 07:44:16'),(11,'3242353454645645','Sumedang','1990-03-08',1,'','SK.Trm','Sumedang Jaya','Jawa Barat','Sumedang','makemanah','pangantosan','628434343434334','62849054545454',NULL,'1dca6968-4634-4522-9380-ba36e537f746',1,5,3,'2025-03-08 07:54:24','2025-03-08 07:54:24'),(12,'3242938742836748','Ciamis','1992-03-11',0,NULL,'A.Md. RMIK','Ciamis Jaya','Jawa Barat','Ciamis','Ciarua','Lorong','628434324234343','6284354545454',NULL,'6ace8df6-f1bd-4405-a086-17c15c0c7e1g',1,7,3,'2025-03-09 10:59:32','2025-03-09 10:59:32'),(13,'4326427364876236','Bandung','1962-03-15',1,'Dra','Apt, MARS','Bogor','Jawa Barat','Bogor','Tanah Sareal','Cipayung','628543534534534','628543543434343',NULL,'a940383d-ae93-43d8-bb4f-e7b004e5d135',2,4,3,'2025-03-10 02:25:02','2025-03-10 02:25:02'),(14,'3214973284239843','Bogor','1999-03-10',0,NULL,'S.TR.GZ','Jalan raya','Jawa Barat','Bogor','Cisarua','Ciawi','628343434343','6284343434343',NULL,'3be1638a-ea04-4c6a-843b-1f3508e6efd9',1,10,3,'2025-03-12 01:11:56','2025-03-12 01:11:56'),(15,'4327843248723742','Bogor','1993-03-24',0,NULL,'S.Tr.Mik','Raya Puncak','Jawa Barat','Bogor','Cisarua','Pasanggrahan','628434734343434','628434355666555',NULL,'aee9d4cd-8165-40ce-a0a8-55986355eccf',1,7,3,'2025-03-21 07:22:17','2025-03-21 07:22:17'),(16,'3202323232424242','Bogor','1993-03-17',1,NULL,'S.T','Cisarua raya','Jawa Barat','Bogor','Cisarua','cisarua','6284343434342','628434343435',NULL,'960aa111-cf8c-4b34-818c-e4aee328e387',1,6,3,'2025-03-26 02:22:18','2025-03-26 02:22:18'),(17,'3201323232323232','Omnis voluptatem qui molestiae','2008-04-25',0,'','RM','Quisquam adipisci in','Voluptatum voluptatu','Sapiente dolor iusto','Mollit qui reprehend','Reiciendis repudiand','6289434343434','628434343434343',NULL,'f19710cd-840c-49b4-a3a3-c3a147d71230',1,5,4,'2025-04-25 01:27:35','2025-04-25 01:27:35');
/*!40000 ALTER TABLE `profiles` ENABLE KEYS */;
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
INSERT INTO `role_has_permissions` VALUES (1,1),(2,1),(3,1),(4,1),(5,1),(6,1),(7,1),(8,1),(9,1),(10,1),(14,1),(15,1),(16,1),(17,1),(25,1),(26,1),(27,1),(28,1),(29,1),(30,1),(31,1),(32,1),(33,1),(34,1),(35,1),(36,1),(14,7),(10,8),(14,8),(15,8),(16,8),(17,8),(9,9),(32,10),(35,10),(36,10),(32,11),(35,11);
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
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `roles`
--

LOCK TABLES `roles` WRITE;
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` VALUES (1,'Super Admin','web',NULL,NULL),(7,'Komite Nakes Lainnya','web','2025-01-25 23:05:23','2025-01-25 23:05:23'),(8,'Assessor Komite Nakes Lainnya','web','2025-01-28 15:09:26','2025-01-28 15:09:26'),(9,'Employee','web','2025-03-02 09:35:03','2025-03-02 09:35:03'),(10,'Sub Komite','web','2025-03-19 05:32:12','2025-03-19 06:42:23'),(11,'Ketua Komite','web','2025-03-19 06:44:05','2025-03-19 06:44:05');
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `structures`
--

DROP TABLE IF EXISTS `structures`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `structures` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_unique` tinyint(1) NOT NULL DEFAULT '0',
  `parent_id` bigint unsigned DEFAULT NULL,
  `department_id` smallint unsigned DEFAULT NULL,
  `is_main` tinyint NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `structures_name_unique` (`name`),
  KEY `structures_parent_id_foreign` (`parent_id`),
  KEY `structures_department_id_foreign` (`department_id`),
  CONSTRAINT `structures_department_id_foreign` FOREIGN KEY (`department_id`) REFERENCES `departments` (`id`),
  CONSTRAINT `structures_parent_id_foreign` FOREIGN KEY (`parent_id`) REFERENCES `structures` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `structures`
--

LOCK TABLES `structures` WRITE;
/*!40000 ALTER TABLE `structures` DISABLE KEYS */;
INSERT INTO `structures` VALUES (1,'Direktur Utama',1,NULL,1,1,'2025-03-09 08:50:06',NULL,NULL),(2,'Direktur Medik dan Keperawatan',1,1,2,1,'2025-03-09 08:50:06',NULL,NULL),(3,'Direktur Sumber Daya Manusia, Pendidikan dan Penelitian',1,1,3,1,'2025-03-09 08:50:06',NULL,NULL),(4,'Direktur Perencanaan Keuangan dan Layanan Operasional',1,1,4,1,'2025-03-09 08:50:06',NULL,NULL),(5,'Ketua Komite Tenaga Kesehatan Lainnya',1,1,5,1,NULL,'2025-03-18 02:46:13',NULL),(6,'Sub Komite Kredensial Ktkl',0,5,5,0,NULL,'2025-03-18 02:47:06',NULL),(7,'Kepala Instalasi Rekam Medik',1,4,7,1,'2025-03-18 03:14:40','2025-03-18 03:14:40',NULL),(8,'Staff Instalasi Rekam Medik',0,7,7,1,'2025-03-18 03:16:02','2025-03-18 03:16:02',NULL),(9,'Kepala Instalasi Farmasi',1,2,8,1,'2025-03-18 04:46:00','2025-03-18 04:46:00',NULL),(10,'Staff Instalasi Farmasi',0,9,8,1,'2025-03-18 04:47:17','2025-03-18 04:47:17',NULL);
/*!40000 ALTER TABLE `structures` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_structure`
--

DROP TABLE IF EXISTS `user_structure`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `user_structure` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `structure_id` bigint unsigned NOT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_structure_structure_id_foreign` (`structure_id`),
  KEY `user_structure_user_id_foreign` (`user_id`),
  CONSTRAINT `user_structure_structure_id_foreign` FOREIGN KEY (`structure_id`) REFERENCES `structures` (`id`) ON DELETE CASCADE,
  CONSTRAINT `user_structure_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_structure`
--

LOCK TABLES `user_structure` WRITE;
/*!40000 ALTER TABLE `user_structure` DISABLE KEYS */;
INSERT INTO `user_structure` VALUES (1,'a940383d-ae93-43d8-bb4f-e7b004e5d135',5,'2025-01-20',NULL,NULL,NULL),(2,'6ace8df6-f1bd-4405-a086-17c15c0c7e1g',6,'2025-01-20',NULL,NULL,NULL),(3,'6ace8df6-f1bd-4405-a086-17c15c0c7e1g',8,'2025-01-20',NULL,NULL,NULL),(6,'f431dc34-1964-43ee-866e-402508142000',1,NULL,NULL,'2025-03-18 04:20:17','2025-03-18 04:20:17'),(7,'a940383d-ae93-43d8-bb4f-e7b004e5d132',8,NULL,NULL,'2025-03-18 04:49:29','2025-03-18 04:49:29'),(8,'1dca6968-4634-4522-9380-ba36e537f746',8,NULL,NULL,'2025-03-18 04:49:37','2025-03-18 04:49:37'),(9,'3be1638a-ea04-4c6a-843b-1f3508e6efd9',8,NULL,NULL,'2025-03-18 04:49:51','2025-03-18 04:49:51'),(10,'6ace8df6-f1bd-4405-a086-17c15c0c7e1f',8,NULL,NULL,'2025-03-18 04:50:00','2025-03-18 04:50:00'),(11,'92aa8b00-afa9-456b-b6e5-6a250428c2e5',8,NULL,NULL,'2025-03-18 04:50:09','2025-03-18 04:50:09'),(12,'92aa8b00-afa9-456b-b6e5-6a250428c2e5',6,'2025-01-20',NULL,NULL,NULL),(13,'6ace8df6-f1bd-4405-a086-17c15c0c7e1g',8,NULL,NULL,'2025-03-19 06:43:40','2025-03-19 06:43:40'),(14,'aee9d4cd-8165-40ce-a0a8-55986355eccf',8,NULL,NULL,'2025-03-21 07:20:33','2025-03-21 07:20:33'),(15,'960aa111-cf8c-4b34-818c-e4aee328e387',8,NULL,NULL,'2025-03-26 02:20:09','2025-03-26 02:20:09'),(16,'f19710cd-840c-49b4-a3a3-c3a147d71230',8,NULL,NULL,'2025-04-25 01:25:43','2025-04-25 01:25:43');
/*!40000 ALTER TABLE `user_structure` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` char(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `nip` varchar(18) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `profile_completed` tinyint NOT NULL DEFAULT '0',
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
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
INSERT INTO `users` VALUES ('1dca6968-4634-4522-9380-ba36e537f746','Nana','nana','334324234234234324','$2y$12$rhpQJK0iU/fpVbxxdr0rqe44J.nmjQDxdLZOm1VxLIhrg8F9iyO2O',1,NULL,'2025-03-08 07:52:31','2025-03-18 04:49:37',NULL),('3be1638a-ea04-4c6a-843b-1f3508e6efd9','Ruslan Nusahan Simbolon','ruslan','199304384398438948','$2y$12$rhpQJK0iU/fpVbxxdr0rqe44J.nmjQDxdLZOm1VxLIhrg8F9iyO2O',1,NULL,'2025-03-12 00:58:58','2025-03-18 04:49:51',NULL),('6ace8df6-f1bd-4405-a086-17c15c0c7e1f','Yeni Suparni','yeni','198001182006042002','$2y$12$aOiA2ygR0VABGQkD6KmBXeR.2IiESDfdt.OltWtegREn69WB3rtnW',1,NULL,'2025-03-02 10:04:02','2025-03-20 05:00:15',NULL),('6ace8df6-f1bd-4405-a086-17c15c0c7e1g','Fasya','fasya','199209272018011001','$2y$12$rhpQJK0iU/fpVbxxdr0rqe44J.nmjQDxdLZOm1VxLIhrg8F9iyO2O',1,NULL,'2025-03-02 10:04:02','2025-03-19 06:43:40',NULL),('92aa8b00-afa9-456b-b6e5-6a250428c2e5','Aep Saepulloh','aep','324234234234234234','$2y$12$rhpQJK0iU/fpVbxxdr0rqe44J.nmjQDxdLZOm1VxLIhrg8F9iyO2O',1,NULL,'2025-03-04 05:04:34','2025-03-18 04:50:09',NULL),('960aa111-cf8c-4b34-818c-e4aee328e387','Mala','mala','323434354545344234','$2y$12$ieXuCoQ61r0YZ7BMS6zE8ei6JRScca5erA1wIqRcmVZetQ4CyfBh.',1,NULL,'2025-03-26 02:20:09','2025-03-26 02:22:18',NULL),('a940383d-ae93-43d8-bb4f-e7b004e5d132','Riki','riki','199232848384384393','$2y$12$rhpQJK0iU/fpVbxxdr0rqe44J.nmjQDxdLZOm1VxLIhrg8F9iyO2O',1,NULL,'2025-03-01 06:28:42','2025-03-18 04:49:29',NULL),('a940383d-ae93-43d8-bb4f-e7b004e5d135','Wellya Hartati','wellya','196712161993032001','$2y$12$rhpQJK0iU/fpVbxxdr0rqe44J.nmjQDxdLZOm1VxLIhrg8F9iyO2O',1,NULL,'2025-03-01 06:28:42','2025-03-10 02:25:02',NULL),('aee9d4cd-8165-40ce-a0a8-55986355eccf','Maulana','maulana','198434343353534343','$2y$12$5jIhWIkcu33x2rI6K87cr.I0BzSBWNhtCmhLVWGoW1TwXiVYSHEf6',1,NULL,'2025-03-21 07:20:33','2025-03-21 07:22:17',NULL),('f19710cd-840c-49b4-a3a3-c3a147d71230','Adamn','adam','192834434343434343','$2y$12$aXzzGQ6odVHcYos3tr3TdOdcyqC2sV4yL5bzqld5DxhAflsrqWVki',1,NULL,'2025-04-25 01:25:43','2025-04-25 01:27:35',NULL),('f431dc34-1964-43ee-866e-402508142000','dr. Ida Bagus Sila Wiweka, Sp.P(K)., MARS','sila','196706011997031004','$2y$12$rhpQJK0iU/fpVbxxdr0rqe44J.nmjQDxdLZOm1VxLIhrg8F9iyO2O',1,NULL,'2025-01-25 10:22:20','2025-03-18 04:20:17',NULL),('f431dc34-1964-43ee-866e-402508142372','Rizal Pamungkas','super.admin','919930207201911101','$2y$12$rhpQJK0iU/fpVbxxdr0rqe44J.nmjQDxdLZOm1VxLIhrg8F9iyO2O',1,NULL,'2025-01-25 10:22:20','2025-03-18 04:15:39',NULL);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping events for database 'pege'
--

--
-- Dumping routines for database 'pege'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2025-06-30 13:31:32
