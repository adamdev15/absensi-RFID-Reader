-- MariaDB dump 10.19  Distrib 10.4.32-MariaDB, for Win64 (AMD64)
--
-- Host: 127.0.0.1    Database: pcnu_absensi
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
-- Table structure for table `activity_logs`
--

DROP TABLE IF EXISTS `activity_logs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `activity_logs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned DEFAULT NULL,
  `station_id` bigint(20) unsigned DEFAULT NULL,
  `action` varchar(100) NOT NULL,
  `module` varchar(100) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `metadata` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`metadata`)),
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `activity_logs_user_id_index` (`user_id`),
  KEY `activity_logs_station_id_index` (`station_id`),
  KEY `activity_logs_action_index` (`action`),
  KEY `activity_logs_module_index` (`module`),
  KEY `activity_logs_created_at_index` (`created_at`),
  CONSTRAINT `activity_logs_station_id_foreign` FOREIGN KEY (`station_id`) REFERENCES `stations` (`id`) ON DELETE SET NULL,
  CONSTRAINT `activity_logs_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `activity_logs`
--

LOCK TABLES `activity_logs` WRITE;
/*!40000 ALTER TABLE `activity_logs` DISABLE KEYS */;
INSERT INTO `activity_logs` VALUES (1,NULL,1,'SYNC_ABSENSI','Absensi','Sinkronisasi absensi berhasil untuk Darniti (UID: 2903940169) dari Station KIOSK MASUK 001','127.0.0.1',NULL,NULL,'2026-09-29 23:24:49','2026-09-29 23:24:49'),(2,NULL,1,'SYNC_ABSENSI','Absensi','Sinkronisasi absensi berhasil untuk Darniti (UID: 2903940169) dari Station KIOSK MASUK 001','127.0.0.1',NULL,NULL,'2026-09-29 23:33:40','2026-09-29 23:33:40'),(3,NULL,1,'SYNC_ABSENSI','Absensi','Sinkronisasi absensi berhasil untuk Darniti (UID: 2903940169) dari Station KIOSK MASUK 001','127.0.0.1',NULL,NULL,'2026-09-29 23:34:40','2026-09-29 23:34:40'),(4,NULL,1,'SYNC_ABSENSI','Absensi','Sinkronisasi absensi berhasil untuk Darniti (UID: 2903940169) dari Station KIOSK MASUK 001','127.0.0.1',NULL,NULL,'2026-09-29 23:36:11','2026-09-29 23:36:11'),(5,NULL,1,'SYNC_ABSENSI','Absensi','Sinkronisasi absensi berhasil untuk Darniti (UID: 2903940169) dari Station KIOSK MASUK 001','127.0.0.1',NULL,NULL,'2026-09-29 23:47:24','2026-09-29 23:47:24'),(6,NULL,1,'SYNC_ABSENSI','Absensi','Sinkronisasi absensi berhasil untuk Darniti (UID: 2903940169) dari Station KIOSK MASUK 001','127.0.0.1',NULL,NULL,'2026-09-29 23:53:42','2026-09-29 23:53:42'),(7,NULL,1,'SYNC_ABSENSI','Absensi','Sinkronisasi absensi berhasil untuk Darniti (UID: 2903940169) dari Station KIOSK MASUK 001','127.0.0.1',NULL,NULL,'2026-09-30 01:28:24','2026-09-30 01:28:24'),(8,NULL,1,'SYNC_ABSENSI','Absensi','Sinkronisasi absensi berhasil untuk Darniti (UID: 2903940169) dari Station KIOSK MASUK 001','127.0.0.1',NULL,NULL,'2026-09-30 01:29:39','2026-09-30 01:29:39'),(9,NULL,1,'SYNC_ABSENSI','Absensi','Sinkronisasi absensi berhasil untuk Darniti (UID: 2903940169) dari Station KIOSK MASUK 001','127.0.0.1',NULL,NULL,'2026-09-30 01:48:21','2026-09-30 01:48:21'),(10,NULL,1,'SYNC_ABSENSI','Absensi','Sinkronisasi absensi berhasil untuk Adam (UID: 2903940169) dari Station KIOSK MASUK 001','127.0.0.1',NULL,NULL,'2026-09-30 01:50:04','2026-09-30 01:50:04'),(11,NULL,1,'SYNC_ABSENSI','Absensi','Sinkronisasi absensi berhasil untuk Adam (UID: 2903940169) dari Station KIOSK MASUK 001','127.0.0.1',NULL,NULL,'2026-09-30 02:19:40','2026-09-30 02:19:40'),(12,NULL,1,'SYNC_ABSENSI','Absensi','Sinkronisasi absensi berhasil untuk Adam (UID: 2903940169) dari Station KIOSK MASUK 001','127.0.0.1',NULL,NULL,'2026-09-30 02:24:29','2026-09-30 02:24:29'),(13,NULL,1,'SYNC_ABSENSI','Absensi','Sinkronisasi absensi berhasil untuk Adam (UID: 2903940169) dari Station KIOSK MASUK 001','127.0.0.1',NULL,NULL,'2026-09-30 02:30:34','2026-09-30 02:30:34'),(14,NULL,1,'SYNC_ABSENSI','Absensi','Sinkronisasi absensi berhasil untuk Adam (UID: 2903940169) dari Station KIOSK MASUK 001','127.0.0.1',NULL,NULL,'2026-09-30 02:32:21','2026-09-30 02:32:21'),(15,NULL,1,'SYNC_ABSENSI','Absensi','Sinkronisasi absensi berhasil untuk Adam (UID: 2903940169) dari Station KIOSK MASUK 001','127.0.0.1',NULL,NULL,'2026-09-30 02:35:46','2026-09-30 02:35:46'),(16,NULL,1,'SYNC_ABSENSI','Absensi','Sinkronisasi absensi berhasil untuk Darniti (UID: 2903940169) dari Station KIOSK KELUAR 001','127.0.0.1',NULL,NULL,'2026-09-30 03:12:30','2026-09-30 03:12:30'),(17,NULL,1,'SYNC_ABSENSI','Absensi','Sinkronisasi absensi berhasil untuk Adam (UID: 2903940169) dari Station KIOSK KELUAR 001','127.0.0.1',NULL,NULL,'2026-09-30 03:14:28','2026-09-30 03:14:28');
/*!40000 ALTER TABLE `activity_logs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `attendances`
--

DROP TABLE IF EXISTS `attendances`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `attendances` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `attendance_uuid` char(36) NOT NULL,
  `attendance_code` varchar(50) NOT NULL,
  `participant_id` bigint(20) unsigned NOT NULL,
  `rfid_card_id` bigint(20) unsigned DEFAULT NULL,
  `station_id` bigint(20) unsigned NOT NULL,
  `type` varchar(10) NOT NULL,
  `rfid_uid` varchar(100) NOT NULL,
  `attendance_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `participant_photo_path` varchar(500) DEFAULT NULL,
  `capture_path` varchar(500) DEFAULT NULL,
  `status` varchar(30) NOT NULL,
  `source` varchar(20) NOT NULL,
  `synced_at` timestamp NULL DEFAULT NULL,
  `participant_name_snapshot` varchar(255) DEFAULT NULL,
  `participant_code_snapshot` varchar(50) DEFAULT NULL,
  `utusan_name_snapshot` varchar(255) DEFAULT NULL,
  `jabatan_name_snapshot` varchar(255) DEFAULT NULL,
  `mwcnu_name_snapshot` varchar(255) DEFAULT NULL,
  `station_name_snapshot` varchar(255) DEFAULT NULL,
  `metadata` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`metadata`)),
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `attendances_attendance_uuid_unique` (`attendance_uuid`),
  UNIQUE KEY `attendances_attendance_code_unique` (`attendance_code`),
  KEY `attendances_participant_id_index` (`participant_id`),
  KEY `attendances_station_id_index` (`station_id`),
  KEY `attendances_rfid_card_id_index` (`rfid_card_id`),
  KEY `attendances_attendance_at_index` (`attendance_at`),
  KEY `attendances_type_index` (`type`),
  KEY `attendances_status_index` (`status`),
  KEY `attendances_source_index` (`source`),
  KEY `attendances_created_at_index` (`created_at`),
  KEY `attendances_participant_id_attendance_at_index` (`participant_id`,`attendance_at`),
  KEY `attendances_station_id_attendance_at_index` (`station_id`,`attendance_at`),
  CONSTRAINT `attendances_participant_id_foreign` FOREIGN KEY (`participant_id`) REFERENCES `participants` (`id`),
  CONSTRAINT `attendances_rfid_card_id_foreign` FOREIGN KEY (`rfid_card_id`) REFERENCES `rfid_cards` (`id`) ON DELETE SET NULL,
  CONSTRAINT `attendances_station_id_foreign` FOREIGN KEY (`station_id`) REFERENCES `stations` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `attendances`
--

LOCK TABLES `attendances` WRITE;
/*!40000 ALTER TABLE `attendances` DISABLE KEYS */;
INSERT INTO `attendances` VALUES (10,'5b268cdb-b7c6-4748-9ac3-5e4bff054118','ATT-20260930082939-6LXG',1,1,1,'IN','2903940169','2026-09-30 08:29:38',NULL,'attendances/2026/09/1_1790756979.jpg','SUCCESS','OFFLINE','2026-09-30 01:29:39','Darniti','PST-20260930-001','Badan Otonom (Banom)','Anggota','MWCNU Balapulang','KIOSK MASUK 001',NULL,'2026-09-30 01:29:39','2026-09-30 01:29:39'),(11,'e580e9a3-5990-479e-864c-44edc4bba4ef','ATT-20260930084821-34EV',1,1,1,'IN','2903940169','2026-09-30 08:48:19',NULL,'attendances/2026/09/1_1790758101.jpg','SUCCESS','OFFLINE','2026-09-30 01:48:21','Darniti','PST-20260930-001','Badan Otonom (Banom)','Anggota','MWCNU Balapulang','KIOSK MASUK 001',NULL,'2026-09-30 01:48:21','2026-09-30 01:48:21'),(12,'dffac130-619a-4440-9205-7de6636990e0','ATT-20260930085004-PMDJ',2,1,1,'IN','2903940169','2026-09-30 08:50:03',NULL,'attendances/2026/09/2_1790758204.jpg','SUCCESS','OFFLINE','2026-09-30 01:50:04','Adam','PST-20260930-002','Lembaga PCNU','Ketua Tanfidziyah','MWCNU Margasari','KIOSK MASUK 001',NULL,'2026-09-30 01:50:04','2026-09-30 01:50:04'),(13,'788b52e2-7269-4102-a8d0-e0f11a408c56','ATT-20260930091940-LITN',2,1,1,'IN','2903940169','2026-09-30 09:19:39',NULL,'attendances/2026/09/2_1790759980.jpg','SUCCESS','OFFLINE','2026-09-30 02:19:40','Adam','PST-20260930-002','Lembaga PCNU','Ketua Tanfidziyah','MWCNU Margasari','KIOSK MASUK 001',NULL,'2026-09-30 02:19:40','2026-09-30 02:19:40'),(14,'5c9525fe-6cb3-4c63-9ce2-f4d83800b104','ATT-20260930092429-ENPF',2,1,1,'IN','2903940169','2026-09-30 09:24:28',NULL,'attendances/2026/09/2_1790760269.jpg','SUCCESS','OFFLINE','2026-09-30 02:24:29','Adam','PST-20260930-002','Lembaga PCNU','Ketua Tanfidziyah','MWCNU Margasari','KIOSK MASUK 001',NULL,'2026-09-30 02:24:29','2026-09-30 02:24:29'),(15,'3d4de1bf-5fa9-4bec-8e89-47a66171ce4a','ATT-20260930093034-JKN5',2,1,1,'IN','2903940169','2026-09-30 09:30:33',NULL,'attendances/2026/09/2_1790760634.jpg','SUCCESS','OFFLINE','2026-09-30 02:30:34','Adam','PST-20260930-002','Lembaga PCNU','Ketua Tanfidziyah','MWCNU Margasari','KIOSK MASUK 001',NULL,'2026-09-30 02:30:34','2026-09-30 02:30:34'),(16,'f3e9f641-95b0-4075-a515-7f143c96f993','ATT-20260930093221-HWIQ',2,1,1,'IN','2903940169','2026-09-30 09:32:20',NULL,'attendances/2026/09/2_1790760741.jpg','SUCCESS','OFFLINE','2026-09-30 02:32:21','Adam','PST-20260930-002','Lembaga PCNU','Ketua Tanfidziyah','MWCNU Margasari','KIOSK MASUK 001',NULL,'2026-09-30 02:32:21','2026-09-30 02:32:21'),(17,'3b0861c7-6c63-44ea-ba24-4c59c47d6fff','ATT-20260930093546-F5WI',2,1,1,'IN','2903940169','2026-09-30 09:35:45',NULL,'attendances/2026/09/2_1790760945.jpg','SUCCESS','OFFLINE','2026-09-30 02:35:46','Adam','PST-20260930-002','Lembaga PCNU','Ketua Tanfidziyah','MWCNU Margasari','KIOSK MASUK 001',NULL,'2026-09-30 02:35:46','2026-09-30 02:35:46'),(18,'c939683f-b87e-4ae6-813f-e4add56a9e58','ATT-20260930101230-BXLZ',1,1,1,'OUT','2903940169','2026-09-30 10:12:29',NULL,'attendances/2026/09/1_1790763150.jpg','SUCCESS','OFFLINE','2026-09-30 03:12:30','Darniti','PST-20260930-001','Badan Otonom (Banom)','Anggota','MWCNU Balapulang','KIOSK KELUAR 001',NULL,'2026-09-30 03:12:30','2026-09-30 03:12:30'),(19,'fe65d076-f498-4f6f-a392-a8a5a7414816','ATT-20260930101428-8YVU',2,1,1,'OUT','2903940169','2026-09-30 10:14:28',NULL,'attendances/2026/09/2_1790763268.jpg','SUCCESS','OFFLINE','2026-09-30 03:14:28','Adam','PST-20260930-002','Lembaga PCNU','Ketua Tanfidziyah','MWCNU Margasari','KIOSK KELUAR 001',NULL,'2026-09-30 03:14:28','2026-09-30 03:14:28');
/*!40000 ALTER TABLE `attendances` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `backups`
--

DROP TABLE IF EXISTS `backups`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `backups` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `filename` varchar(255) NOT NULL,
  `disk` varchar(50) NOT NULL DEFAULT 'local',
  `path` varchar(500) NOT NULL,
  `size` bigint(20) DEFAULT NULL,
  `type` varchar(30) NOT NULL DEFAULT 'MANUAL',
  `status` varchar(30) NOT NULL DEFAULT 'PENDING',
  `created_by` bigint(20) unsigned DEFAULT NULL,
  `completed_at` timestamp NULL DEFAULT NULL,
  `metadata` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`metadata`)),
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `backups_created_by_foreign` (`created_by`),
  KEY `backups_type_index` (`type`),
  KEY `backups_status_index` (`status`),
  KEY `backups_created_at_index` (`created_at`),
  CONSTRAINT `backups_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `backups`
--

LOCK TABLES `backups` WRITE;
/*!40000 ALTER TABLE `backups` DISABLE KEYS */;
/*!40000 ALTER TABLE `backups` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cache`
--

DROP TABLE IF EXISTS `cache`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL,
  PRIMARY KEY (`key`),
  KEY `cache_expiration_index` (`expiration`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cache`
--

LOCK TABLES `cache` WRITE;
/*!40000 ALTER TABLE `cache` DISABLE KEYS */;
INSERT INTO `cache` VALUES ('absensi-pcnu-kabupaten-tegal-cache-spatie.permission.cache','a:3:{s:5:\"alias\";a:4:{s:1:\"a\";s:2:\"id\";s:1:\"b\";s:4:\"name\";s:1:\"c\";s:10:\"guard_name\";s:1:\"r\";s:5:\"roles\";}s:11:\"permissions\";a:29:{i:0;a:4:{s:1:\"a\";i:1;s:1:\"b\";s:14:\"dashboard.view\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:1;a:4:{s:1:\"a\";i:2;s:1:\"b\";s:17:\"participants.view\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:2;a:4:{s:1:\"a\";i:3;s:1:\"b\";s:19:\"participants.create\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:3;a:4:{s:1:\"a\";i:4;s:1:\"b\";s:19:\"participants.update\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:4;a:4:{s:1:\"a\";i:5;s:1:\"b\";s:19:\"participants.delete\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:5;a:4:{s:1:\"a\";i:6;s:1:\"b\";s:13:\"utusan.manage\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:6;a:4:{s:1:\"a\";i:7;s:1:\"b\";s:16:\"positions.manage\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:7;a:4:{s:1:\"a\";i:8;s:1:\"b\";s:12:\"mwcnu.manage\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:8;a:4:{s:1:\"a\";i:9;s:1:\"b\";s:9:\"rfid.view\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:9;a:4:{s:1:\"a\";i:10;s:1:\"b\";s:13:\"rfid.register\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:10;a:4:{s:1:\"a\";i:11;s:1:\"b\";s:11:\"rfid.update\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:11;a:4:{s:1:\"a\";i:12;s:1:\"b\";s:11:\"rfid.delete\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:12;a:4:{s:1:\"a\";i:13;s:1:\"b\";s:13:\"stations.view\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:13;a:4:{s:1:\"a\";i:14;s:1:\"b\";s:15:\"stations.manage\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:14;a:4:{s:1:\"a\";i:15;s:1:\"b\";s:14:\"station.access\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:3;}}i:15;a:4:{s:1:\"a\";i:16;s:1:\"b\";s:12:\"station.view\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:3;}}i:16;a:4:{s:1:\"a\";i:17;s:1:\"b\";s:15:\"attendance.view\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:3:{i:0;i:1;i:1;i:2;i:2;i:3;}}i:17;a:4:{s:1:\"a\";i:18;s:1:\"b\";s:17:\"attendance.create\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:3;}}i:18;a:4:{s:1:\"a\";i:19;s:1:\"b\";s:17:\"attendance.delete\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:19;a:4:{s:1:\"a\";i:20;s:1:\"b\";s:9:\"logs.view\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:20;a:4:{s:1:\"a\";i:21;s:1:\"b\";s:12:\"reports.view\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:21;a:4:{s:1:\"a\";i:22;s:1:\"b\";s:14:\"reports.export\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:22;a:4:{s:1:\"a\";i:23;s:1:\"b\";s:13:\"settings.view\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:23;a:4:{s:1:\"a\";i:24;s:1:\"b\";s:15:\"settings.update\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:24;a:4:{s:1:\"a\";i:25;s:1:\"b\";s:13:\"backup.create\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:25;a:4:{s:1:\"a\";i:26;s:1:\"b\";s:14:\"backup.restore\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:26;a:4:{s:1:\"a\";i:27;s:1:\"b\";s:13:\"backup.delete\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:27;a:4:{s:1:\"a\";i:28;s:1:\"b\";s:12:\"users.manage\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:28;a:4:{s:1:\"a\";i:29;s:1:\"b\";s:12:\"roles.manage\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}}s:5:\"roles\";a:3:{i:0;a:3:{s:1:\"a\";i:1;s:1:\"b\";s:10:\"superadmin\";s:1:\"c\";s:3:\"web\";}i:1;a:3:{s:1:\"a\";i:2;s:1:\"b\";s:5:\"admin\";s:1:\"c\";s:3:\"web\";}i:2;a:3:{s:1:\"a\";i:3;s:1:\"b\";s:7:\"petugas\";s:1:\"c\";s:3:\"web\";}}}',1790833816);
/*!40000 ALTER TABLE `cache` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cache_locks`
--

DROP TABLE IF EXISTS `cache_locks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL,
  PRIMARY KEY (`key`),
  KEY `cache_locks_expiration_index` (`expiration`)
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
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp(),
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
-- Table structure for table `job_batches`
--

DROP TABLE IF EXISTS `job_batches`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL,
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
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) unsigned NOT NULL,
  `reserved_at` int(10) unsigned DEFAULT NULL,
  `available_at` int(10) unsigned NOT NULL,
  `created_at` int(10) unsigned NOT NULL,
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
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=54 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (36,'0001_01_01_000000_create_users_table',1),(37,'0001_01_01_000001_create_cache_table',1),(38,'0001_01_01_000002_create_jobs_table',1),(39,'2026_09_30_025233_create_permission_tables',1),(40,'2026_09_30_030001_create_utusan_table',1),(41,'2026_09_30_030002_create_positions_table',1),(42,'2026_09_30_030003_create_mwcnu_table',1),(43,'2026_09_30_030004_create_participants_table',1),(44,'2026_09_30_030005_create_stations_table',1),(45,'2026_09_30_030006_create_station_user_table',1),(46,'2026_09_30_030007_create_station_tokens_table',1),(47,'2026_09_30_030008_create_rfid_cards_table',1),(48,'2026_09_30_030009_create_rfid_logs_table',1),(49,'2026_09_30_030010_create_attendances_table',1),(50,'2026_09_30_030011_create_activity_logs_table',1),(51,'2026_09_30_030012_create_settings_table',1),(52,'2026_09_30_030013_create_backups_table',1),(53,'2026_09_30_042247_create_personal_access_tokens_table',1);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `model_has_permissions`
--

DROP TABLE IF EXISTS `model_has_permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `model_has_permissions` (
  `permission_id` bigint(20) unsigned NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint(20) unsigned NOT NULL,
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
/*!40000 ALTER TABLE `model_has_permissions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `model_has_roles`
--

DROP TABLE IF EXISTS `model_has_roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `model_has_roles` (
  `role_id` bigint(20) unsigned NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint(20) unsigned NOT NULL,
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
INSERT INTO `model_has_roles` VALUES (1,'App\\Models\\User',1),(2,'App\\Models\\User',2),(3,'App\\Models\\User',3);
/*!40000 ALTER TABLE `model_has_roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mwcnu`
--

DROP TABLE IF EXISTS `mwcnu`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mwcnu` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `code` varchar(50) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `status` varchar(30) NOT NULL DEFAULT 'ACTIVE',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `mwcnu_code_unique` (`code`),
  KEY `mwcnu_status_index` (`status`),
  KEY `mwcnu_name_index` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mwcnu`
--

LOCK TABLES `mwcnu` WRITE;
/*!40000 ALTER TABLE `mwcnu` DISABLE KEYS */;
INSERT INTO `mwcnu` VALUES (1,'MWC-RQNXB','MWCNU Slawi','MWCNU Kecamatan Slawi','ACTIVE',NULL,'2026-09-29 22:50:01','2026-09-29 22:50:01'),(2,'MWC-OUWWC','MWCNU Lebaksiu','MWCNU Kecamatan Lebaksiu','ACTIVE',NULL,'2026-09-29 22:50:01','2026-09-29 22:50:01'),(3,'MWC-BHFC4','MWCNU Balapulang','MWCNU Kecamatan Balapulang','ACTIVE',NULL,'2026-09-29 22:50:01','2026-09-29 22:50:01'),(4,'MWC-2WDDJ','MWCNU Margasari','MWCNU Kecamatan Margasari','ACTIVE',NULL,'2026-09-29 22:50:01','2026-09-29 22:50:01'),(5,'MWC-DLOI2','MWCNU Bumijawa','MWCNU Kecamatan Bumijawa','ACTIVE',NULL,'2026-09-29 22:50:01','2026-09-29 22:50:01'),(6,'MWC-X180A','MWCNU Bojong','MWCNU Kecamatan Bojong','ACTIVE',NULL,'2026-09-29 22:50:01','2026-09-29 22:50:01'),(7,'MWC-KJDBW','MWCNU Pagerbarang','MWCNU Kecamatan Pagerbarang','ACTIVE',NULL,'2026-09-29 22:50:01','2026-09-29 22:50:01'),(8,'MWC-GVUXO','MWCNU Dukuhwaru','MWCNU Kecamatan Dukuhwaru','ACTIVE',NULL,'2026-09-29 22:50:01','2026-09-29 22:50:01'),(9,'MWC-MROWL','MWCNU Adiwerna','MWCNU Kecamatan Adiwerna','ACTIVE',NULL,'2026-09-29 22:50:01','2026-09-29 22:50:01'),(10,'MWC-MKD9Q','MWCNU Talang','MWCNU Kecamatan Talang','ACTIVE',NULL,'2026-09-29 22:50:01','2026-09-29 22:50:01'),(11,'MWC-LCVBF','MWCNU Tarub','MWCNU Kecamatan Tarub','ACTIVE',NULL,'2026-09-29 22:50:01','2026-09-29 22:50:01'),(12,'MWC-LY4U3','MWCNU Kramat','MWCNU Kecamatan Kramat','ACTIVE',NULL,'2026-09-29 22:50:01','2026-09-29 22:50:01'),(13,'MWC-IQ05K','MWCNU Suradadi','MWCNU Kecamatan Suradadi','ACTIVE',NULL,'2026-09-29 22:50:01','2026-09-29 22:50:01'),(14,'MWC-BSLUO','MWCNU Warureja','MWCNU Kecamatan Warureja','ACTIVE',NULL,'2026-09-29 22:50:01','2026-09-29 22:50:01'),(15,'MWC-ZLPXI','MWCNU Kedungbanteng','MWCNU Kecamatan Kedungbanteng','ACTIVE',NULL,'2026-09-29 22:50:01','2026-09-29 22:50:01'),(16,'MWC-FPFF8','MWCNU Pangkah','MWCNU Kecamatan Pangkah','ACTIVE',NULL,'2026-09-29 22:50:01','2026-09-29 22:50:01'),(17,'MWC-JLV6H','MWCNU Jatinegara','MWCNU Kecamatan Jatinegara','ACTIVE',NULL,'2026-09-29 22:50:01','2026-09-29 22:50:01'),(18,'MWC-WXHC3','MWCNU Dukuhturi','MWCNU Kecamatan Dukuhturi','ACTIVE',NULL,'2026-09-29 22:50:01','2026-09-29 22:50:01');
/*!40000 ALTER TABLE `mwcnu` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `participants`
--

DROP TABLE IF EXISTS `participants`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `participants` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `participant_code` varchar(50) NOT NULL,
  `name` varchar(255) NOT NULL,
  `birth_place` varchar(100) DEFAULT NULL,
  `birth_date` date DEFAULT NULL,
  `gender` varchar(20) DEFAULT NULL,
  `utusan_id` bigint(20) unsigned DEFAULT NULL,
  `jabatan_id` bigint(20) unsigned DEFAULT NULL,
  `mwcnu_id` bigint(20) unsigned DEFAULT NULL,
  `photo_path` varchar(500) DEFAULT NULL,
  `mandate_letter_path` varchar(500) DEFAULT NULL,
  `organization` varchar(255) DEFAULT NULL,
  `status` varchar(30) NOT NULL DEFAULT 'ACTIVE',
  `rfid_uid` varchar(100) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `participants_participant_code_unique` (`participant_code`),
  KEY `participants_name_index` (`name`),
  KEY `participants_utusan_id_index` (`utusan_id`),
  KEY `participants_jabatan_id_index` (`jabatan_id`),
  KEY `participants_mwcnu_id_index` (`mwcnu_id`),
  KEY `participants_status_index` (`status`),
  KEY `participants_rfid_uid_index` (`rfid_uid`),
  CONSTRAINT `participants_jabatan_id_foreign` FOREIGN KEY (`jabatan_id`) REFERENCES `positions` (`id`) ON DELETE SET NULL,
  CONSTRAINT `participants_mwcnu_id_foreign` FOREIGN KEY (`mwcnu_id`) REFERENCES `mwcnu` (`id`) ON DELETE SET NULL,
  CONSTRAINT `participants_utusan_id_foreign` FOREIGN KEY (`utusan_id`) REFERENCES `utusan` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `participants`
--

LOCK TABLES `participants` WRITE;
/*!40000 ALTER TABLE `participants` DISABLE KEYS */;
INSERT INTO `participants` VALUES (1,'PST-20260930-001','Darniti','Tegal','2003-10-10','L',4,9,3,'participants/photos/SJPsqyWtsIu6dyVRgt19zSlP5m1qpBAzqgGABXrr.jpg','participants/mandates/zziUv8Zg10QqdPBFQMaTWonDKi0J84r9uRkgTwgv.pdf',NULL,'ACTIVE',NULL,NULL,'2026-09-29 22:53:46','2026-09-29 22:53:46'),(2,'PST-20260930-002','Adam','Tegal','2003-10-10','L',5,5,4,'participants/photos/CKouMtpWEWLasS0MUcDIML54kJ5ruRNfFMcQfjWr.jpg',NULL,NULL,'ACTIVE',NULL,NULL,'2026-09-30 01:49:26','2026-09-30 01:49:26');
/*!40000 ALTER TABLE `participants` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_reset_tokens`
--

DROP TABLE IF EXISTS `password_reset_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
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
-- Table structure for table `permissions`
--

DROP TABLE IF EXISTS `permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `permissions` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `guard_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `permissions`
--

LOCK TABLES `permissions` WRITE;
/*!40000 ALTER TABLE `permissions` DISABLE KEYS */;
INSERT INTO `permissions` VALUES (1,'dashboard.view','web','2026-09-29 22:50:00','2026-09-29 22:50:00'),(2,'participants.view','web','2026-09-29 22:50:00','2026-09-29 22:50:00'),(3,'participants.create','web','2026-09-29 22:50:00','2026-09-29 22:50:00'),(4,'participants.update','web','2026-09-29 22:50:00','2026-09-29 22:50:00'),(5,'participants.delete','web','2026-09-29 22:50:00','2026-09-29 22:50:00'),(6,'utusan.manage','web','2026-09-29 22:50:00','2026-09-29 22:50:00'),(7,'positions.manage','web','2026-09-29 22:50:00','2026-09-29 22:50:00'),(8,'mwcnu.manage','web','2026-09-29 22:50:00','2026-09-29 22:50:00'),(9,'rfid.view','web','2026-09-29 22:50:00','2026-09-29 22:50:00'),(10,'rfid.register','web','2026-09-29 22:50:00','2026-09-29 22:50:00'),(11,'rfid.update','web','2026-09-29 22:50:00','2026-09-29 22:50:00'),(12,'rfid.delete','web','2026-09-29 22:50:00','2026-09-29 22:50:00'),(13,'stations.view','web','2026-09-29 22:50:00','2026-09-29 22:50:00'),(14,'stations.manage','web','2026-09-29 22:50:00','2026-09-29 22:50:00'),(15,'station.access','web','2026-09-29 22:50:00','2026-09-29 22:50:00'),(16,'station.view','web','2026-09-29 22:50:00','2026-09-29 22:50:00'),(17,'attendance.view','web','2026-09-29 22:50:00','2026-09-29 22:50:00'),(18,'attendance.create','web','2026-09-29 22:50:00','2026-09-29 22:50:00'),(19,'attendance.delete','web','2026-09-29 22:50:00','2026-09-29 22:50:00'),(20,'logs.view','web','2026-09-29 22:50:00','2026-09-29 22:50:00'),(21,'reports.view','web','2026-09-29 22:50:00','2026-09-29 22:50:00'),(22,'reports.export','web','2026-09-29 22:50:00','2026-09-29 22:50:00'),(23,'settings.view','web','2026-09-29 22:50:00','2026-09-29 22:50:00'),(24,'settings.update','web','2026-09-29 22:50:00','2026-09-29 22:50:00'),(25,'backup.create','web','2026-09-29 22:50:00','2026-09-29 22:50:00'),(26,'backup.restore','web','2026-09-29 22:50:00','2026-09-29 22:50:00'),(27,'backup.delete','web','2026-09-29 22:50:00','2026-09-29 22:50:00'),(28,'users.manage','web','2026-09-29 22:50:00','2026-09-29 22:50:00'),(29,'roles.manage','web','2026-09-29 22:50:00','2026-09-29 22:50:00');
/*!40000 ALTER TABLE `permissions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `personal_access_tokens`
--

DROP TABLE IF EXISTS `personal_access_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) unsigned NOT NULL,
  `name` text NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`),
  KEY `personal_access_tokens_expires_at_index` (`expires_at`)
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
-- Table structure for table `positions`
--

DROP TABLE IF EXISTS `positions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `positions` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `code` varchar(50) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `status` varchar(30) NOT NULL DEFAULT 'ACTIVE',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `positions_code_unique` (`code`),
  KEY `positions_status_index` (`status`),
  KEY `positions_name_index` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `positions`
--

LOCK TABLES `positions` WRITE;
/*!40000 ALTER TABLE `positions` DISABLE KEYS */;
INSERT INTO `positions` VALUES (1,'JB-OGWL','Rois Syuriyah','Jabatan Rois Syuriyah','ACTIVE',NULL,'2026-09-29 22:50:01','2026-09-29 22:50:01'),(2,'JB-MGWD','Katib Syuriyah','Jabatan Katib Syuriyah','ACTIVE',NULL,'2026-09-29 22:50:01','2026-09-29 22:50:01'),(3,'JB-H6JQ','A\'wan','Jabatan A\'wan','ACTIVE',NULL,'2026-09-29 22:50:01','2026-09-29 22:50:01'),(4,'JB-2BNL','Mustasyar','Jabatan Mustasyar','ACTIVE',NULL,'2026-09-29 22:50:01','2026-09-29 22:50:01'),(5,'JB-LFOZ','Ketua Tanfidziyah','Jabatan Ketua Tanfidziyah','ACTIVE',NULL,'2026-09-29 22:50:01','2026-09-29 22:50:01'),(6,'JB-HTW4','Sekretaris','Jabatan Sekretaris','ACTIVE',NULL,'2026-09-29 22:50:01','2026-09-29 22:50:01'),(7,'JB-H8O8','Bendahara','Jabatan Bendahara','ACTIVE',NULL,'2026-09-29 22:50:01','2026-09-29 22:50:01'),(8,'JB-AZT9','Ketua Lembaga/Banom','Jabatan Ketua Lembaga/Banom','ACTIVE',NULL,'2026-09-29 22:50:01','2026-09-29 22:50:01'),(9,'JB-GQGC','Anggota','Jabatan Anggota','ACTIVE',NULL,'2026-09-29 22:50:01','2026-09-29 22:50:01');
/*!40000 ALTER TABLE `positions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `rfid_cards`
--

DROP TABLE IF EXISTS `rfid_cards`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `rfid_cards` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `uid` varchar(100) NOT NULL,
  `participant_id` bigint(20) unsigned DEFAULT NULL,
  `status` varchar(30) NOT NULL DEFAULT 'UNASSIGNED',
  `registered_at` timestamp NULL DEFAULT NULL,
  `unregistered_at` timestamp NULL DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `last_station_id` bigint(20) unsigned DEFAULT NULL,
  `metadata` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`metadata`)),
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `rfid_cards_uid_unique` (`uid`),
  KEY `rfid_cards_last_station_id_foreign` (`last_station_id`),
  KEY `rfid_cards_participant_id_index` (`participant_id`),
  KEY `rfid_cards_status_index` (`status`),
  KEY `rfid_cards_last_used_at_index` (`last_used_at`),
  CONSTRAINT `rfid_cards_last_station_id_foreign` FOREIGN KEY (`last_station_id`) REFERENCES `stations` (`id`) ON DELETE SET NULL,
  CONSTRAINT `rfid_cards_participant_id_foreign` FOREIGN KEY (`participant_id`) REFERENCES `participants` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `rfid_cards`
--

LOCK TABLES `rfid_cards` WRITE;
/*!40000 ALTER TABLE `rfid_cards` DISABLE KEYS */;
INSERT INTO `rfid_cards` VALUES (1,'2903940169',2,'ACTIVE','2026-09-30 03:14:23',NULL,NULL,NULL,NULL,NULL,'2026-09-29 22:54:00','2026-09-30 03:14:23');
/*!40000 ALTER TABLE `rfid_cards` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `rfid_logs`
--

DROP TABLE IF EXISTS `rfid_logs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `rfid_logs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `rfid_card_id` bigint(20) unsigned DEFAULT NULL,
  `participant_id` bigint(20) unsigned DEFAULT NULL,
  `station_id` bigint(20) unsigned DEFAULT NULL,
  `uid` varchar(100) NOT NULL,
  `event_type` varchar(50) NOT NULL,
  `event_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `metadata` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`metadata`)),
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `rfid_logs_participant_id_foreign` (`participant_id`),
  KEY `rfid_logs_station_id_foreign` (`station_id`),
  KEY `rfid_logs_uid_index` (`uid`),
  KEY `rfid_logs_rfid_card_id_index` (`rfid_card_id`),
  KEY `rfid_logs_event_type_index` (`event_type`),
  KEY `rfid_logs_event_at_index` (`event_at`),
  CONSTRAINT `rfid_logs_participant_id_foreign` FOREIGN KEY (`participant_id`) REFERENCES `participants` (`id`) ON DELETE SET NULL,
  CONSTRAINT `rfid_logs_rfid_card_id_foreign` FOREIGN KEY (`rfid_card_id`) REFERENCES `rfid_cards` (`id`) ON DELETE SET NULL,
  CONSTRAINT `rfid_logs_station_id_foreign` FOREIGN KEY (`station_id`) REFERENCES `stations` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `rfid_logs`
--

LOCK TABLES `rfid_logs` WRITE;
/*!40000 ALTER TABLE `rfid_logs` DISABLE KEYS */;
/*!40000 ALTER TABLE `rfid_logs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `role_has_permissions`
--

DROP TABLE IF EXISTS `role_has_permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `role_has_permissions` (
  `permission_id` bigint(20) unsigned NOT NULL,
  `role_id` bigint(20) unsigned NOT NULL,
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
INSERT INTO `role_has_permissions` VALUES (1,1),(1,2),(2,1),(2,2),(3,1),(3,2),(4,1),(4,2),(5,1),(6,1),(7,1),(8,1),(9,1),(9,2),(10,1),(10,2),(11,1),(11,2),(12,1),(13,1),(13,2),(14,1),(15,1),(15,3),(16,1),(16,3),(17,1),(17,2),(17,3),(18,1),(18,3),(19,1),(20,1),(20,2),(21,1),(21,2),(22,1),(22,2),(23,1),(24,1),(25,1),(26,1),(27,1),(28,1),(29,1);
/*!40000 ALTER TABLE `role_has_permissions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `roles` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `guard_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `roles`
--

LOCK TABLES `roles` WRITE;
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` VALUES (1,'superadmin','web','2026-09-29 22:50:00','2026-09-29 22:50:00'),(2,'admin','web','2026-09-29 22:50:00','2026-09-29 22:50:00'),(3,'petugas','web','2026-09-29 22:50:00','2026-09-29 22:50:00');
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sessions`
--

DROP TABLE IF EXISTS `sessions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) unsigned DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL,
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
INSERT INTO `sessions` VALUES ('FO9CBoPZ1AxL0wPawzmzq01I0I0Dol8rUJGXc2yF',1,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/154.0.0.0 Safari/537.36 Edg/154.0.0.0','YTo1OntzOjY6Il90b2tlbiI7czo0MDoiNkU3cjFKdmFkbVAwSnlMYzBJSDVGcWJXVG9JWDNSaENFWUhSOTZtQSI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzU6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9zeXN0ZW0tYmFja3VwIjtzOjU6InJvdXRlIjtzOjEyOiJiYWNrdXAuaW5kZXgiO31zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToxO3M6MTc6InBhc3N3b3JkX2hhc2hfd2ViIjtzOjY0OiI5NGFmMDYxNGU4NzkwNDAzOWZiNzgzMTUwMzNiMzMxNzIxZGZiZTEzMDg1ZDllYzYyNDkyNTQyMDRlMjQ2ZmU0Ijt9',1790764098);
/*!40000 ALTER TABLE `sessions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `settings`
--

DROP TABLE IF EXISTS `settings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `settings` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `key` varchar(100) NOT NULL,
  `value` text DEFAULT NULL,
  `type` varchar(30) NOT NULL DEFAULT 'string',
  `group` varchar(50) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `settings_key_unique` (`key`),
  KEY `settings_group_index` (`group`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `settings`
--

LOCK TABLES `settings` WRITE;
/*!40000 ALTER TABLE `settings` DISABLE KEYS */;
INSERT INTO `settings` VALUES (1,'app_name','Aplikasi RFID','string','application','Nama aplikasi','2026-09-29 22:50:01','2026-09-30 00:58:50'),(2,'organization_name','PCNU Kabupaten Tegal','string','application','Nama organisasi','2026-09-29 22:50:01','2026-09-29 22:50:01'),(3,'organization_address','Kabupaten Tegal, Jawa Tengah','string','application','Alamat organisasi','2026-09-29 22:50:01','2026-09-29 22:50:01'),(4,'organization_phone','','string','application','Nomor telepon organisasi','2026-09-29 22:50:01','2026-09-29 22:50:01'),(5,'welcome_text','Selamat Datang di Sistem Absensi PCNU Kabupaten Tegal','string','application','Teks sambutan di station','2026-09-29 22:50:01','2026-09-29 22:50:01'),(6,'attendance_in_text','ABSENSI MASUK','string','application','Teks untuk station absensi masuk','2026-09-29 22:50:01','2026-09-29 22:50:01'),(7,'attendance_out_text','ABSENSI KELUAR','string','application','Teks untuk station absensi keluar','2026-09-29 22:50:01','2026-09-29 22:50:01'),(8,'app_logo','settings/NEdFyv9MbHbAADvvLDa2Rt2VjMe69nMmNADFRQVP.png','image','branding','Logo aplikasi (path)','2026-09-29 22:50:01','2026-09-29 22:50:56'),(9,'app_favicon','','image','branding','Favicon aplikasi (path)','2026-09-29 22:50:01','2026-09-29 22:50:01'),(10,'primary_color','#15803D','color','branding','Warna utama aplikasi','2026-09-29 22:50:01','2026-09-29 22:50:01'),(11,'secondary_color','#166534','color','branding','Warna sekunder aplikasi','2026-09-29 22:50:01','2026-09-29 22:50:01'),(12,'banner_image','','image','branding','Gambar banner station (path)','2026-09-29 22:50:01','2026-09-29 22:50:01'),(13,'duplicate_window','30','integer','attendance','Jendela duplikat absensi (detik)','2026-09-29 22:50:01','2026-09-29 22:50:01'),(14,'heartbeat_interval','30','integer','station','Interval heartbeat station (detik)','2026-09-29 22:50:01','2026-09-29 22:50:01'),(15,'station_idle_timeout','3','integer','station','Timeout idle station setelah absensi berhasil (detik)','2026-09-29 22:50:01','2026-09-29 22:50:01'),(16,'station_online_threshold','2','integer','station','Threshold ONLINE station berdasarkan last_seen_at (menit)','2026-09-29 22:50:01','2026-09-29 22:50:01'),(17,'backup_schedule','daily','string','backup','Jadwal backup otomatis','2026-09-29 22:50:01','2026-09-29 22:50:01'),(18,'app_organization','PCNU Kab. Tegal','string',NULL,NULL,'2026-09-29 22:50:56','2026-09-30 00:58:50'),(19,'landing_welcome_text','Selamat datang di Sistem Informasi Absensi Digital PCNU Kabupaten Tegal. Silakan login untuk melanjutkan.','string',NULL,NULL,'2026-09-29 22:50:56','2026-09-29 22:50:56'),(20,'support_contact','admin@lazisnukabtegal.id','string',NULL,NULL,'2026-09-29 22:50:56','2026-09-30 00:58:50'),(21,'app_version','v1.0.0','string',NULL,NULL,'2026-09-29 22:50:56','2026-09-29 22:50:56'),(22,'hero_image','settings/LOQObL0kbjMi6sRZGHB2uGdXCMlG2uGTs60eb13E.png','string',NULL,NULL,'2026-09-30 00:59:02','2026-09-30 01:17:07');
/*!40000 ALTER TABLE `settings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `station_tokens`
--

DROP TABLE IF EXISTS `station_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `station_tokens` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `station_id` bigint(20) unsigned NOT NULL,
  `token_hash` varchar(255) DEFAULT NULL,
  `plain_token` varchar(255) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `revoked_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `station_tokens_plain_token_unique` (`plain_token`),
  KEY `station_tokens_token_hash_index` (`token_hash`),
  KEY `station_tokens_station_id_index` (`station_id`),
  KEY `station_tokens_revoked_at_index` (`revoked_at`),
  CONSTRAINT `station_tokens_station_id_foreign` FOREIGN KEY (`station_id`) REFERENCES `stations` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `station_tokens`
--

LOCK TABLES `station_tokens` WRITE;
/*!40000 ALTER TABLE `station_tokens` DISABLE KEYS */;
INSERT INTO `station_tokens` VALUES (1,1,'eb6e0f92cd50abc81de81d7914441877eb465a19027278eab7d3f5723cf094ca','0RALpckaza0XzcG2DAjKTTDyG1cbmbsMGUluLcBy','Default Token',NULL,NULL,NULL,'2026-09-29 22:52:32','2026-09-29 22:52:32');
/*!40000 ALTER TABLE `station_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `station_user`
--

DROP TABLE IF EXISTS `station_user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `station_user` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `station_id` bigint(20) unsigned NOT NULL,
  `user_id` bigint(20) unsigned NOT NULL,
  `assigned_by` bigint(20) unsigned DEFAULT NULL,
  `assigned_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `station_user_station_id_user_id_unique` (`station_id`,`user_id`),
  KEY `station_user_user_id_foreign` (`user_id`),
  KEY `station_user_assigned_by_foreign` (`assigned_by`),
  CONSTRAINT `station_user_assigned_by_foreign` FOREIGN KEY (`assigned_by`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  CONSTRAINT `station_user_station_id_foreign` FOREIGN KEY (`station_id`) REFERENCES `stations` (`id`) ON DELETE CASCADE,
  CONSTRAINT `station_user_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `station_user`
--

LOCK TABLES `station_user` WRITE;
/*!40000 ALTER TABLE `station_user` DISABLE KEYS */;
/*!40000 ALTER TABLE `station_user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `stations`
--

DROP TABLE IF EXISTS `stations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `stations` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `station_code` varchar(50) NOT NULL,
  `name` varchar(100) NOT NULL,
  `type` varchar(20) NOT NULL,
  `status` varchar(30) NOT NULL DEFAULT 'ACTIVE',
  `hostname` varchar(255) DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `mac_address` varchar(50) DEFAULT NULL,
  `agent_version` varchar(50) DEFAULT NULL,
  `last_seen_at` timestamp NULL DEFAULT NULL,
  `last_connected_at` timestamp NULL DEFAULT NULL,
  `last_disconnected_at` timestamp NULL DEFAULT NULL,
  `registered_at` timestamp NULL DEFAULT NULL,
  `metadata` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`metadata`)),
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `stations_station_code_unique` (`station_code`),
  KEY `stations_type_index` (`type`),
  KEY `stations_status_index` (`status`),
  KEY `stations_last_seen_at_index` (`last_seen_at`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `stations`
--

LOCK TABLES `stations` WRITE;
/*!40000 ALTER TABLE `stations` DISABLE KEYS */;
INSERT INTO `stations` VALUES (1,'STN-ZFONK9','KIOSK KELUAR 001','OUT','ACTIVE',NULL,NULL,NULL,NULL,'2026-09-30 02:37:52',NULL,NULL,NULL,NULL,NULL,'2026-09-29 22:52:32','2026-09-30 03:07:35');
/*!40000 ALTER TABLE `stations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `username` varchar(100) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `status` varchar(30) NOT NULL DEFAULT 'active',
  `last_login_at` timestamp NULL DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_username_unique` (`username`),
  UNIQUE KEY `users_email_unique` (`email`),
  KEY `users_status_index` (`status`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'Superadmin','superadmin','superadmin@gmail.com',NULL,'$2y$12$gVXJdeoe3lpd79s95UGcZebjo8nifNJoQz21sry/zzjOjFlNn83Oq','active','2026-09-30 01:20:25','q8oa5IMaCpSuUAZf1aDrE3geehQwS5qRj3rC6iNbbnhyYu0Q3SJwsxVu9rpy','2026-09-29 22:50:00','2026-09-30 01:20:25'),(2,'Administrator','admin','admin@gmail.com',NULL,'$2y$12$wRrP6icVBROyEVepaJZtwuViev88VKZGeajgZXLk1qO.11418526u','active','2026-09-29 22:50:16',NULL,'2026-09-29 22:50:01','2026-09-29 22:50:16'),(3,'Petugas Station 01','petugas01','petugas01@gmail.com',NULL,'$2y$12$MxrvmXXq7pwAQnH4HrfLVek9ptL1wR.pm8rKpPUhOybpe/mlwRdfG','active',NULL,NULL,'2026-09-29 22:50:01','2026-09-29 22:50:01');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `utusan`
--

DROP TABLE IF EXISTS `utusan`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `utusan` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `code` varchar(50) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `status` varchar(30) NOT NULL DEFAULT 'ACTIVE',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `utusan_code_unique` (`code`),
  KEY `utusan_status_index` (`status`),
  KEY `utusan_name_index` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `utusan`
--

LOCK TABLES `utusan` WRITE;
/*!40000 ALTER TABLE `utusan` DISABLE KEYS */;
INSERT INTO `utusan` VALUES (1,'UT-HR74','Pengurus Cabang','Kategori utusan Pengurus Cabang','ACTIVE',NULL,'2026-09-29 22:50:01','2026-09-29 22:50:01'),(2,'UT-6D9Q','Pengurus MWCNU','Kategori utusan Pengurus MWCNU','ACTIVE',NULL,'2026-09-29 22:50:01','2026-09-29 22:50:01'),(3,'UT-VK1O','Pengurus Ranting','Kategori utusan Pengurus Ranting','ACTIVE',NULL,'2026-09-29 22:50:01','2026-09-29 22:50:01'),(4,'UT-PCYH','Badan Otonom (Banom)','Kategori utusan Badan Otonom (Banom)','ACTIVE',NULL,'2026-09-29 22:50:01','2026-09-29 22:50:01'),(5,'UT-IODP','Lembaga PCNU','Kategori utusan Lembaga PCNU','ACTIVE',NULL,'2026-09-29 22:50:01','2026-09-29 22:50:01'),(6,'UT-GO51','Tamu Undangan','Kategori utusan Tamu Undangan','ACTIVE',NULL,'2026-09-29 22:50:01','2026-09-29 22:50:01');
/*!40000 ALTER TABLE `utusan` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2026-09-30 17:28:21
