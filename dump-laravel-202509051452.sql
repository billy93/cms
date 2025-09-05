-- MySQL dump 10.13  Distrib 8.0.19, for Win64 (x86_64)
--
-- Host: localhost    Database: laravel
-- ------------------------------------------------------
-- Server version	5.5.5-10.5.29-MariaDB-ubu2004

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
-- Table structure for table `cache`
--

DROP TABLE IF EXISTS `cache`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL,
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
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL,
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
-- Table structure for table `customer_pics`
--

DROP TABLE IF EXISTS `customer_pics`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `customer_pics` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `customer_id` bigint(20) unsigned NOT NULL,
  `name` varchar(255) NOT NULL COMMENT 'Nama PIC',
  `email` varchar(255) DEFAULT NULL COMMENT 'Email PIC',
  `phone` varchar(255) DEFAULT NULL COMMENT 'Nomor telepon PIC',
  `position` varchar(255) DEFAULT NULL COMMENT 'Jabatan PIC',
  `status` enum('active','inactive') NOT NULL DEFAULT 'active' COMMENT 'Status PIC',
  `notes` text DEFAULT NULL COMMENT 'Catatan tambahan',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `customer_pics_customer_id_index` (`customer_id`),
  KEY `customer_pics_name_index` (`name`),
  KEY `customer_pics_status_index` (`status`),
  CONSTRAINT `customer_pics_customer_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `customer_pics`
--

LOCK TABLES `customer_pics` WRITE;
/*!40000 ALTER TABLE `customer_pics` DISABLE KEYS */;
INSERT INTO `customer_pics` VALUES (1,1,'A','a@a.com','2321','a','active','4wrewer','2025-08-02 04:57:51','2025-08-02 04:57:56','2025-08-02 04:57:56'),(2,1,'a','a@a.com','324234','a','active','TETS','2025-08-02 04:59:05','2025-08-02 04:59:05',NULL);
/*!40000 ALTER TABLE `customer_pics` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `customers`
--

DROP TABLE IF EXISTS `customers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `customers` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `customer_code` varchar(255) NOT NULL COMMENT 'Kode unik customer',
  `customer_name` varchar(255) NOT NULL COMMENT 'Nama customer/perusahaan',
  `address` text NOT NULL COMMENT 'Alamat lengkap customer',
  `contact_person` varchar(255) DEFAULT NULL COMMENT 'Nama kontak person',
  `phone` varchar(255) DEFAULT NULL COMMENT 'Nomor telepon',
  `email` varchar(255) DEFAULT NULL COMMENT 'Email customer',
  `bank_name` varchar(255) DEFAULT NULL COMMENT 'Nama bank',
  `bank_account_number` varchar(255) DEFAULT NULL COMMENT 'Nomor rekening bank',
  `bank_account_name` varchar(255) DEFAULT NULL COMMENT 'Nama pemilik rekening',
  `status` enum('active','inactive') NOT NULL DEFAULT 'active' COMMENT 'Status customer',
  `notes` text DEFAULT NULL COMMENT 'Catatan tambahan',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `customers_customer_code_unique` (`customer_code`),
  KEY `customers_customer_code_index` (`customer_code`),
  KEY `customers_customer_name_index` (`customer_name`),
  KEY `customers_status_index` (`status`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `customers`
--

LOCK TABLES `customers` WRITE;
/*!40000 ALTER TABLE `customers` DISABLE KEYS */;
INSERT INTO `customers` VALUES (1,'CUST000001','PT Maju Bersama','Jl. Sudirman No. 123, Jakarta Pusat, DKI Jakarta 12190','Budi Santoso','021-5550123','budi@majubersama.com',NULL,NULL,NULL,'active','Customer utama untuk proyek IT infrastructure','2025-08-02 03:17:17','2025-08-02 03:17:17',NULL),(2,'CUST000002','CV Sukses Mandiri','Jl. Thamrin No. 45, Jakarta Pusat, DKI Jakarta 10350','Siti Aminah','021-5550456','siti@suksesmandiri.co.id',NULL,NULL,NULL,'active','Konsultan manajemen dan training','2025-08-02 03:17:17','2025-08-02 03:17:17',NULL),(3,'CUST000003','PT Global Teknologi','Jl. Gatot Subroto No. 67, Jakarta Selatan, DKI Jakarta 12930','Ahmad Rizki','021-5550789','ahmad@globalteknologi.com',NULL,NULL,NULL,'active','Perusahaan teknologi informasi','2025-08-02 03:17:17','2025-08-02 03:17:17',NULL),(4,'CUST000004','UD Makmur Jaya','Jl. Hayam Wuruk No. 89, Jakarta Barat, DKI Jakarta 11160','Dewi Sartika','021-5550112','dewi@makmurjaya.com',NULL,NULL,NULL,'active','Distributor produk elektronik','2025-08-02 03:17:17','2025-08-02 03:17:17',NULL),(5,'CUST000005','PT Sejahtera Abadi','Jl. Asia Afrika No. 234, Bandung, Jawa Barat 40262','Rudi Hermawan','022-5550234','rudi@sejahteraabadi.co.id',NULL,NULL,NULL,'active','Manufaktur tekstil dan garmen','2025-08-02 03:17:17','2025-08-02 03:17:17',NULL),(6,'CUST000006','CV Berkah Sentosa','Jl. Ahmad Yani No. 156, Surabaya, Jawa Timur 60231','Nina Kartika','031-5550156','nina@berkahsentosa.com',NULL,NULL,NULL,'inactive','Customer non-aktif - pindah lokasi','2025-08-02 03:17:17','2025-08-02 03:17:17',NULL),(7,'CUST000007','PT Dinamis Kreatif','Jl. Pemuda No. 78, Semarang, Jawa Tengah 50132','Eko Prasetyo','024-5550178','eko@dinamiskreatif.com',NULL,NULL,NULL,'active','Agency kreatif dan digital marketing','2025-08-02 03:17:17','2025-08-02 03:17:17',NULL),(8,'CUST000008','UD Mitra Usaha','Jl. Veteran No. 345, Medan, Sumatera Utara 20112','Sri Wahyuni','061-5550345','sri@mitrausaha.co.id',NULL,NULL,NULL,'active','Trading dan import-export','2025-08-02 03:17:17','2025-08-02 03:17:17',NULL),(9,'CUST000009','TEST','TEST','123213','2311321','test@gmail.com',NULL,NULL,NULL,'active','TEST','2025-08-02 03:29:13','2025-08-02 03:33:51','2025-08-02 03:33:51'),(17,'ABCD1231','Tsting','rer54534','123123','23213','test@gmail.com',NULL,NULL,NULL,'active','srser','2025-08-02 03:55:54','2025-08-02 03:56:07','2025-08-02 03:56:07'),(18,'TESTT','TEST','testi','TEST','524324','test@gmail.com',NULL,NULL,NULL,'active','testi','2025-08-02 04:10:59','2025-08-02 04:11:06','2025-08-02 04:11:06'),(19,'CUST900760','ETST','etstset','112rwerwerwer','123213','test@gmail.com',NULL,NULL,NULL,'active','etst','2025-08-02 04:11:59','2025-08-02 04:12:15','2025-08-02 04:12:15'),(21,'CUST017778','TEST','TEST','TSET','123123','test@gmail.com',NULL,NULL,NULL,'active',NULL,'2025-08-26 10:10:27','2025-08-26 10:10:36','2025-08-26 10:10:36');
/*!40000 ALTER TABLE `customers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
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
-- Table structure for table `invoice`
--

DROP TABLE IF EXISTS `invoice`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `invoice` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `client_id` bigint(20) unsigned DEFAULT NULL,
  `bill_to` varchar(255) NOT NULL,
  `ship_to` varchar(255) NOT NULL,
  `project_id` bigint(20) unsigned DEFAULT NULL,
  `amount` decimal(15,2) NOT NULL,
  `currency` varchar(10) NOT NULL,
  `invoice_date` date NOT NULL,
  `due_date` date NOT NULL,
  `payment_method` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `description` text NOT NULL,
  `signature_name` varchar(255) DEFAULT NULL,
  `signature_image` varchar(255) DEFAULT NULL,
  `notes` text NOT NULL,
  `terms_and_conditions` text NOT NULL,
  `subtotal` decimal(15,2) NOT NULL DEFAULT 0.00,
  `discount` decimal(5,2) NOT NULL DEFAULT 0.00,
  `extra_discount` decimal(5,2) NOT NULL DEFAULT 0.00,
  `tax` decimal(15,2) NOT NULL DEFAULT 0.00,
  `total` decimal(15,2) NOT NULL DEFAULT 0.00,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `invoice`
--

LOCK TABLES `invoice` WRITE;
/*!40000 ALTER TABLE `invoice` DISABLE KEYS */;
/*!40000 ALTER TABLE `invoice` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `job_batches`
--

DROP TABLE IF EXISTS `job_batches`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
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
/*!50503 SET character_set_client = utf8mb4 */;
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
-- Table structure for table `menu_roles`
--

DROP TABLE IF EXISTS `menu_roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `menu_roles` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `menu_id` bigint(20) unsigned NOT NULL,
  `role_id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `idx_menu_roles_menu_id` (`menu_id`),
  KEY `idx_menu_roles_role_id` (`role_id`),
  CONSTRAINT `menu_roles_menu_id_foreign` FOREIGN KEY (`menu_id`) REFERENCES `menus` (`id`) ON DELETE CASCADE,
  CONSTRAINT `menu_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `menu_roles`
--

LOCK TABLES `menu_roles` WRITE;
/*!40000 ALTER TABLE `menu_roles` DISABLE KEYS */;
INSERT INTO `menu_roles` VALUES (5,1,2,'2025-09-01 11:42:47','2025-09-01 11:42:47'),(10,1,1,'2025-09-01 15:48:31','2025-09-01 15:48:31'),(11,2,1,'2025-09-01 15:48:31','2025-09-01 15:48:31'),(12,3,1,'2025-09-01 15:48:31','2025-09-01 15:48:31'),(13,4,1,'2025-09-01 15:48:31','2025-09-01 15:48:31'),(14,5,1,'2025-09-01 15:48:31','2025-09-01 15:48:31'),(15,6,1,'2025-09-01 15:48:31','2025-09-01 15:48:31'),(16,7,1,'2025-09-01 15:48:31','2025-09-01 15:48:31'),(17,8,1,'2025-09-01 15:48:31','2025-09-01 15:48:31'),(18,9,1,'2025-09-01 15:48:31','2025-09-01 15:48:31');
/*!40000 ALTER TABLE `menu_roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `menus`
--

DROP TABLE IF EXISTS `menus`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `menus` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `label` varchar(255) NOT NULL,
  `path` varchar(255) NOT NULL,
  `icon` varchar(255) DEFAULT NULL,
  `parent_id` bigint(20) unsigned DEFAULT NULL,
  `sort` int(11) NOT NULL DEFAULT 0,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_menus_parent_id` (`parent_id`),
  KEY `idx_menus_is_active` (`is_active`),
  CONSTRAINT `menus_parent_id_foreign` FOREIGN KEY (`parent_id`) REFERENCES `menus` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `menus`
--

LOCK TABLES `menus` WRITE;
/*!40000 ALTER TABLE `menus` DISABLE KEYS */;
INSERT INTO `menus` VALUES (1,'Menu','/manage-menus',NULL,NULL,0,1,'2025-09-01 09:14:48','2025-09-01 09:14:48'),(2,'User','/manage-users',NULL,NULL,0,1,'2025-09-01 09:40:00','2025-09-01 09:40:00'),(3,'Roles','/roles-permissions',NULL,NULL,0,1,'2025-09-01 09:40:00','2025-09-01 09:40:00'),(4,'Companies','/companies',NULL,NULL,0,1,'2025-09-01 09:40:00','2025-09-01 09:40:00'),(5,'Customers','/customers',NULL,NULL,0,1,'2025-09-01 09:40:00','2025-09-01 09:40:00'),(6,'Suppliers','/suppliers',NULL,NULL,0,1,'2025-09-01 09:40:00','2025-09-01 09:40:00'),(7,'Proposals','/proposals',NULL,NULL,0,1,'2025-09-01 09:40:00','2025-09-01 09:40:00'),(8,'Invoices','/invoices',NULL,NULL,0,1,'2025-09-01 09:40:00','2025-09-01 09:40:00'),(9,'Boq','/boq',NULL,NULL,0,1,'2025-09-01 09:40:00','2025-09-01 09:40:00');
/*!40000 ALTER TABLE `menus` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'0001_01_01_000000_create_roles_table',1),(2,'0001_01_01_000001_create_cache_table',1),(3,'0001_01_01_000002_create_jobs_table',1),(4,'0001_01_01_000003_create_permissions_table',1),(5,'0001_01_01_000004_create_role_persmission_table',1),(6,'0001_01_01_000005_create_users_table',1),(7,'2025_04_26_044028_create_invoice_table',1),(9,'2024_12_19_000000_create_customers_table',2),(10,'2025_08_02_041836_create_suppliers_table',3),(11,'2025_08_02_044411_create_customer_pics_table',4),(12,'2025_08_02_044509_add_bank_info_to_customers_table',4),(13,'2025_08_02_044728_create_supplier_pics_table',5),(14,'2025_08_23_140129_create_product_categories_table',6),(16,'2025_08_23_140330_create_products_table',7),(17,'2025_08_26_103100_update_existing_products_category_data',8),(18,'2025_08_26_102552_update_products_table_category_to_foreign_key',9),(19,'2025_01_02_000005_create_menus_table',10),(20,'2025_09_01_094902_create_menu_roles_table',11);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_reset_tokens`
--

DROP TABLE IF EXISTS `password_reset_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
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
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `permissions` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `permissions_name_unique` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `permissions`
--

LOCK TABLES `permissions` WRITE;
/*!40000 ALTER TABLE `permissions` DISABLE KEYS */;
INSERT INTO `permissions` VALUES (1,'manage-users','Manage users','2025-08-02 02:44:43','2025-08-02 02:44:43'),(2,'deals','Deals','2025-08-02 02:44:43','2025-08-02 02:44:43'),(3,'deal-reports','Deal reports','2025-08-02 02:44:43','2025-08-02 02:44:43'),(4,'deals-details','Deals details','2025-08-02 02:44:43','2025-08-02 02:44:43'),(5,'deals-kanban','Deals kanban','2025-08-02 02:44:43','2025-08-02 02:44:43');
/*!40000 ALTER TABLE `permissions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `product_categories`
--

DROP TABLE IF EXISTS `product_categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `product_categories` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `product_categories_name_unique` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `product_categories`
--

LOCK TABLES `product_categories` WRITE;
/*!40000 ALTER TABLE `product_categories` DISABLE KEYS */;
INSERT INTO `product_categories` VALUES (1,'Electronics','2025-08-23 14:37:33','2025-08-26 16:55:06'),(2,'Clothing & Apparel','2025-08-23 14:37:33','2025-08-23 14:37:33'),(3,'Home & Garden','2025-08-23 14:37:33','2025-08-23 14:37:33'),(4,'Sports & Outdoors','2025-08-23 14:37:33','2025-08-23 14:37:33'),(5,'Books & Media','2025-08-23 14:37:33','2025-08-23 14:37:33'),(6,'Health & Beauty','2025-08-23 14:37:33','2025-08-23 14:37:33'),(7,'Automotive','2025-08-23 14:37:33','2025-08-23 14:37:33'),(8,'Food & Beverages','2025-08-23 14:37:33','2025-08-23 14:37:33'),(9,'Toys & Games','2025-08-23 14:37:33','2025-08-23 14:37:33');
/*!40000 ALTER TABLE `product_categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `products` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `unit` varchar(32) NOT NULL,
  `base_cost` double NOT NULL,
  `category_id` bigint(20) unsigned NOT NULL,
  `supplier_id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_products_supplier_id` (`supplier_id`),
  KEY `products_category_id_index` (`category_id`),
  CONSTRAINT `fk_products_supplier` FOREIGN KEY (`supplier_id`) REFERENCES `suppliers` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `products_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `product_categories` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `products`
--

LOCK TABLES `products` WRITE;
/*!40000 ALTER TABLE `products` DISABLE KEYS */;
INSERT INTO `products` VALUES (1,'TEST2','TEST2','pcs',100000,7,2,'2025-08-26 16:48:33','2025-08-26 16:53:59');
/*!40000 ALTER TABLE `products` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `role_permission`
--

DROP TABLE IF EXISTS `role_permission`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `role_permission` (
  `role_id` bigint(20) unsigned NOT NULL,
  `permission_id` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`role_id`,`permission_id`),
  KEY `role_permission_permission_id_foreign` (`permission_id`),
  CONSTRAINT `role_permission_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `role_permission_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `role_permission`
--

LOCK TABLES `role_permission` WRITE;
/*!40000 ALTER TABLE `role_permission` DISABLE KEYS */;
INSERT INTO `role_permission` VALUES (1,1),(1,2),(1,3),(1,4),(1,5),(2,1);
/*!40000 ALTER TABLE `role_permission` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `roles` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `roles_name_unique` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `roles`
--

LOCK TABLES `roles` WRITE;
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` VALUES (1,'admin','Administrator','2025-08-02 02:44:43','2025-08-02 02:44:43'),(2,'user','Regular User','2025-08-02 02:44:43','2025-08-02 02:44:43');
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sessions`
--

DROP TABLE IF EXISTS `sessions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
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
INSERT INTO `sessions` VALUES ('aXPc23QrjyoycwFxYKmsYjkjXGBKtvB3xjFWig7T',11,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36','YTozOntzOjY6Il90b2tlbiI7czo0MDoialVkZUF3c2tETUF6QkZnVVlMTHFlQldSUk1ZU2J0RGpDUUtSUzh1byI7czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTE7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==',1756786151),('SJlXYTZ9e4UGvHA9SWPSMKhV0jBrinEtNo7bx7jC',11,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36','YTo0OntzOjY6Il90b2tlbiI7czo0MDoiY1pWVjZQV3B6STB5bnYyd0ZKODRIUEI3SFZuY3VyYmFrQWJpeEMyVSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mzk6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC9yb2xlcy1wZXJtaXNzaW9ucyI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjExO30=',1756741864);
/*!40000 ALTER TABLE `sessions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `supplier_pics`
--

DROP TABLE IF EXISTS `supplier_pics`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `supplier_pics` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `supplier_id` bigint(20) unsigned NOT NULL,
  `name` varchar(255) NOT NULL COMMENT 'Nama PIC',
  `email` varchar(255) DEFAULT NULL COMMENT 'Email PIC',
  `phone` varchar(255) DEFAULT NULL COMMENT 'Nomor telepon PIC',
  `position` varchar(255) DEFAULT NULL COMMENT 'Jabatan PIC',
  `status` enum('active','inactive') NOT NULL DEFAULT 'active' COMMENT 'Status PIC',
  `notes` text DEFAULT NULL COMMENT 'Catatan tambahan',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `supplier_pics_supplier_id_index` (`supplier_id`),
  KEY `supplier_pics_name_index` (`name`),
  KEY `supplier_pics_status_index` (`status`),
  CONSTRAINT `supplier_pics_supplier_id_foreign` FOREIGN KEY (`supplier_id`) REFERENCES `suppliers` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `supplier_pics`
--

LOCK TABLES `supplier_pics` WRITE;
/*!40000 ALTER TABLE `supplier_pics` DISABLE KEYS */;
INSERT INTO `supplier_pics` VALUES (1,1,'b','b@gmail.com','213123','b','active','3213213','2025-08-02 04:59:30','2025-08-02 04:59:30',NULL);
/*!40000 ALTER TABLE `supplier_pics` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `suppliers`
--

DROP TABLE IF EXISTS `suppliers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `suppliers` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `supplier_code` varchar(255) NOT NULL COMMENT 'Kode unik supplier',
  `supplier_name` varchar(255) NOT NULL COMMENT 'Nama supplier/perusahaan',
  `address` text NOT NULL COMMENT 'Alamat lengkap supplier',
  `contact_person` varchar(255) DEFAULT NULL COMMENT 'Nama kontak person',
  `phone` varchar(255) DEFAULT NULL COMMENT 'Nomor telepon',
  `email` varchar(255) DEFAULT NULL COMMENT 'Email supplier',
  `tax_number` varchar(255) DEFAULT NULL COMMENT 'Nomor NPWP',
  `bank_name` varchar(255) DEFAULT NULL COMMENT 'Nama bank',
  `bank_account_number` varchar(255) DEFAULT NULL COMMENT 'Nomor rekening bank',
  `bank_account_name` varchar(255) DEFAULT NULL COMMENT 'Nama pemilik rekening',
  `status` enum('active','inactive') NOT NULL DEFAULT 'active' COMMENT 'Status supplier',
  `notes` text DEFAULT NULL COMMENT 'Catatan tambahan',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `suppliers_supplier_code_unique` (`supplier_code`),
  KEY `suppliers_supplier_code_index` (`supplier_code`),
  KEY `suppliers_supplier_name_index` (`supplier_name`),
  KEY `suppliers_status_index` (`status`),
  KEY `suppliers_tax_number_index` (`tax_number`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `suppliers`
--

LOCK TABLES `suppliers` WRITE;
/*!40000 ALTER TABLE `suppliers` DISABLE KEYS */;
INSERT INTO `suppliers` VALUES (1,'SUPP000001','PT Maju Teknologi','Jl. Gatot Subroto No. 123, Jakarta Selatan, DKI Jakarta 12930','Budi Santoso','021-5550123','budi@majuteknologi.com','01.234.567.8-123.000','Bank Central Asia (BCA)','1234567890','PT Maju Teknologi','active','Supplier utama untuk perangkat IT dan software','2025-08-02 04:28:49','2025-08-02 04:28:49',NULL),(2,'SUPP000002','CV Sukses Mandiri','Jl. Sudirman No. 456, Jakarta Pusat, DKI Jakarta 12190','Siti Aminah','021-5550456','siti@suksesmandiri.co.id','02.345.678.9-234.000','Bank Mandiri','0987654321','CV Sukses Mandiri','active','Supplier untuk jasa konsultasi dan training','2025-08-02 04:28:49','2025-08-02 04:28:49',NULL),(3,'SUPP000003','PT Global Solutions','Jl. Thamrin No. 789, Jakarta Pusat, DKI Jakarta 10350','Ahmad Rizki','021-5550789','ahmad@globalsolutions.com','03.456.789.0-345.000','Bank Negara Indonesia (BNI)','1122334455','PT Global Solutions','active','Supplier untuk solusi enterprise dan cloud services','2025-08-02 04:28:49','2025-08-02 04:28:49',NULL),(4,'SUPP000004','UD Makmur Jaya','Jl. Hayam Wuruk No. 321, Jakarta Barat, DKI Jakarta 11160','Dewi Sartika','021-5550112','dewi@makmurjaya.com','04.567.890.1-456.000','Bank Rakyat Indonesia (BRI)','5544332211','UD Makmur Jaya','active','Supplier untuk perangkat keras dan komponen elektronik','2025-08-02 04:28:49','2025-08-02 04:28:49',NULL),(5,'SUPP000005','PT Sejahtera Abadi','Jl. Asia Afrika No. 654, Bandung, Jawa Barat 40262','Rudi Hermawan','022-5550234','rudi@sejahteraabadi.co.id','05.678.901.2-567.000','Bank Central Asia (BCA)','6677889900','PT Sejahtera Abadi','active','Supplier untuk furniture dan peralatan kantor','2025-08-02 04:28:49','2025-08-02 04:28:49',NULL),(6,'SUPP000006','CV Berkah Sentosa','Jl. Ahmad Yani No. 987, Surabaya, Jawa Timur 60231','Nina Kartika','031-5550156','nina@berkahsentosa.com','06.789.012.3-678.000','Bank Mandiri','7788990011','CV Berkah Sentosa','inactive','Supplier non-aktif - pindah lokasi','2025-08-02 04:28:49','2025-08-02 04:28:49',NULL),(7,'SUPP000007','PT Dinamis Kreatif','Jl. Pemuda No. 147, Semarang, Jawa Tengah 50132','Eko Prasetyo','024-5550178','eko@dinamiskreatif.com','07.890.123.4-789.000','Bank Negara Indonesia (BNI)','8899001122','PT Dinamis Kreatif','active','Supplier untuk jasa kreatif dan digital marketing','2025-08-02 04:28:49','2025-08-02 04:28:49',NULL),(8,'SUPP000008','PT Inovasi Digital','Jl. Sudirman No. 258, Medan, Sumatera Utara 20112','Maya Sari','061-5550258','maya@inovasidigital.com','08.901.234.5-890.000','Bank Central Asia (BCA)','9900112233','PT Inovasi Digital','active','Supplier untuk layanan digital dan e-commerce','2025-08-02 04:28:49','2025-08-02 04:28:49',NULL),(9,'SUPP127117','TEST','TEST','ETST','12312321','test@gmail.com','21321321','TEST','TEST','TSET','active','TESTST','2025-08-02 04:32:33','2025-08-02 04:33:00','2025-08-02 04:33:00');
/*!40000 ALTER TABLE `suppliers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `location` varchar(255) DEFAULT NULL,
  `status` enum('active','inactive','suspended') NOT NULL DEFAULT 'active',
  `role_id` bigint(20) unsigned DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`),
  KEY `users_role_id_foreign` (`role_id`),
  CONSTRAINT `users_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'Prof. Jayme DuBuque','reinger.laverna@example.org','2025-08-02 02:44:43','$2y$12$kMHoyUX1myf9xcj4k4Z2JuwTdPNSrtx9pXgjxrBlFxY12qSrGkBkG','(520) 378-8465','New Caledonia','suspended',2,'EXNJnSR4tj','2025-08-02 02:44:44','2025-08-02 02:44:44'),(2,'Dee Dietrich','jkemmer@example.com','2025-08-02 02:44:44','$2y$12$kMHoyUX1myf9xcj4k4Z2JuwTdPNSrtx9pXgjxrBlFxY12qSrGkBkG','(234) 239-9268','Russian Federation','active',2,'5O2CZdxLjB','2025-08-02 02:44:44','2025-08-02 02:44:44'),(3,'Dr. Davon Greenholt','jacobs.kelton@example.net','2025-08-02 02:44:44','$2y$12$kMHoyUX1myf9xcj4k4Z2JuwTdPNSrtx9pXgjxrBlFxY12qSrGkBkG','1-253-560-6637','United Arab Emirates','active',2,'XXMLNqZh69','2025-08-02 02:44:44','2025-08-02 02:44:44'),(4,'Candice Kunze PhD','jkirlin@example.com','2025-08-02 02:44:44','$2y$12$kMHoyUX1myf9xcj4k4Z2JuwTdPNSrtx9pXgjxrBlFxY12qSrGkBkG','+1-480-907-2427','Sweden','active',2,'27UuXt80Cw','2025-08-02 02:44:44','2025-08-02 02:44:44'),(5,'Prof. Alayna Renner','ajaskolski@example.com','2025-08-02 02:44:44','$2y$12$kMHoyUX1myf9xcj4k4Z2JuwTdPNSrtx9pXgjxrBlFxY12qSrGkBkG','+1 (281) 849-4554','Georgia','active',2,'eLElY2oJz4','2025-08-02 02:44:44','2025-08-02 02:44:44'),(6,'Priscilla Schultz','wehner.wendell@example.com','2025-08-02 02:44:44','$2y$12$kMHoyUX1myf9xcj4k4Z2JuwTdPNSrtx9pXgjxrBlFxY12qSrGkBkG','430-351-9636','Uzbekistan','inactive',2,'aj01xTiiHE','2025-08-02 02:44:44','2025-08-02 02:44:44'),(7,'Prof. Deondre Wilderman Sr.','madge10@example.net','2025-08-02 02:44:44','$2y$12$kMHoyUX1myf9xcj4k4Z2JuwTdPNSrtx9pXgjxrBlFxY12qSrGkBkG','(980) 728-5828','Bhutan','active',2,'BooZjG8xJM','2025-08-02 02:44:44','2025-08-02 02:44:44'),(8,'Alverta Breitenberg DVM','antonietta56@example.org','2025-08-02 02:44:44','$2y$12$kMHoyUX1myf9xcj4k4Z2JuwTdPNSrtx9pXgjxrBlFxY12qSrGkBkG','865-999-2216','Sao Tome and Principe','suspended',2,'F7iM0Mw0Dd','2025-08-02 02:44:44','2025-08-02 02:44:44'),(9,'Josiah Russel','khickle@example.org','2025-08-02 02:44:44','$2y$12$kMHoyUX1myf9xcj4k4Z2JuwTdPNSrtx9pXgjxrBlFxY12qSrGkBkG','+1-256-896-1934','Sudan','suspended',2,'rQ6j4ZSGy9','2025-08-02 02:44:44','2025-08-02 02:44:44'),(10,'Kevon Bins','roob.felicia@example.net','2025-08-02 02:44:44','$2y$12$kMHoyUX1myf9xcj4k4Z2JuwTdPNSrtx9pXgjxrBlFxY12qSrGkBkG','(540) 987-9721','Palau','inactive',2,'hTYH0kSvPz','2025-08-02 02:44:44','2025-08-02 02:44:44'),(11,'Admin','admin@crms.com','2025-08-02 02:44:44','$2y$12$7Utsde9rPBjyvShP9u5zQOJtq8kDOigChlTu53Dsnib5L29OvLmO2','1-754-435-7724','Bouvet Island (Bouvetoya)','active',1,'dI9aFGkzT5Jm0fHRCpBlvN3tgSioygKSpwJjuGPQ6sBMhTot8mvRssupkE8E','2025-08-02 02:44:44','2025-08-02 02:44:44'),(12,'Test','test@crms.com',NULL,'$2y$12$6wmXR8KL2qBsCRed2ngyUuFCP63siFTHUGNEk/.F7jiYxF7Y7Fw5W','Test','test','active',2,NULL,'2025-08-31 17:11:09','2025-09-01 08:14:38');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping routines for database 'laravel'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2025-09-05 14:52:10
