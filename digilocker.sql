-- MySQL dump 10.13  Distrib 8.0.30, for Win64 (x86_64)
--
-- Host: localhost    Database: digilocker
-- ------------------------------------------------------
-- Server version	8.0.30

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
-- Table structure for table `aadhar_details`
--

DROP TABLE IF EXISTS `aadhar_details`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `aadhar_details` (
  `id` int NOT NULL,
  `aadhar_number` varchar(20) NOT NULL,
  `name` char(200) NOT NULL,
  `date_of_birth` date NOT NULL,
  `gender` tinytext NOT NULL,
  `address` varchar(600) NOT NULL,
  `contact_number` varchar(45) NOT NULL,
  `virtual_id` varchar(45) CHARACTER SET cp1250 COLLATE cp1250_general_ci NOT NULL,
  PRIMARY KEY (`aadhar_number`),
  UNIQUE KEY `id_UNIQUE` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `aadhar_details`
--

LOCK TABLES `aadhar_details` WRITE;
/*!40000 ALTER TABLE `aadhar_details` DISABLE KEYS */;
INSERT INTO `aadhar_details` VALUES (3,'2076 2689 5850','Mohd Aftab','2002-04-18','male ','krishna nagar ','9868486602','9156 3164 5674 1234'),(2,'3581 5645 2592','Yashika Goyal','2003-05-21','female ','krishna nagar ','8750151934','9190 9625 9239 1378'),(1,'8055 3608 7323','Radhika Sharma','2002-11-04','female','krishna nagar','8368765745','9159 3135 4330 2803');
/*!40000 ALTER TABLE `aadhar_details` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `document`
--

DROP TABLE IF EXISTS `document`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `document` (
  `id` int NOT NULL,
  ` aadhar_number` varchar(20) NOT NULL,
  `document_name` varchar(45) NOT NULL,
  `document_type` varchar(45) NOT NULL,
  `document_id` varchar(45) NOT NULL,
  PRIMARY KEY (` aadhar_number`),
  UNIQUE KEY `document_id_UNIQUE` (`document_id`),
  UNIQUE KEY `id_UNIQUE` (`id`),
  KEY `fk_aadhar_id_idx` (` aadhar_number`),
  CONSTRAINT `fk_documents_id` FOREIGN KEY (` aadhar_number`) REFERENCES `aadhar_details` (`aadhar_number`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `document`
--

LOCK TABLES `document` WRITE;
/*!40000 ALTER TABLE `document` DISABLE KEYS */;
/*!40000 ALTER TABLE `document` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `driving_license`
--

DROP TABLE IF EXISTS `driving_license`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `driving_license` (
  `id` int NOT NULL,
  `name` varchar(25) NOT NULL,
  `date_of_birth` date NOT NULL,
  `address` varchar(170) NOT NULL,
  PRIMARY KEY (`id`),
  CONSTRAINT `fk_license_document_id` FOREIGN KEY (`id`) REFERENCES `document` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `driving_license`
--

LOCK TABLES `driving_license` WRITE;
/*!40000 ALTER TABLE `driving_license` DISABLE KEYS */;
/*!40000 ALTER TABLE `driving_license` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `electricity_bill`
--

DROP TABLE IF EXISTS `electricity_bill`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `electricity_bill` (
  `id` int NOT NULL,
  `document_id` int NOT NULL,
  `address` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `document_id_UNIQUE` (`document_id`),
  CONSTRAINT `fk_electricity_document_id` FOREIGN KEY (`document_id`) REFERENCES `document` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `electricity_bill`
--

LOCK TABLES `electricity_bill` WRITE;
/*!40000 ALTER TABLE `electricity_bill` DISABLE KEYS */;
/*!40000 ALTER TABLE `electricity_bill` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pan_card`
--

DROP TABLE IF EXISTS `pan_card`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `pan_card` (
  `id` int NOT NULL,
  `name` char(30) NOT NULL,
  `date_of_birth` date NOT NULL,
  PRIMARY KEY (`id`,`name`,`date_of_birth`),
  CONSTRAINT `fk_pancard_document` FOREIGN KEY (`id`) REFERENCES `document` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pan_card`
--

LOCK TABLES `pan_card` WRITE;
/*!40000 ALTER TABLE `pan_card` DISABLE KEYS */;
/*!40000 ALTER TABLE `pan_card` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `passport_details`
--

DROP TABLE IF EXISTS `passport_details`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `passport_details` (
  `date_of_birth` date NOT NULL,
  `name` char(30) NOT NULL,
  `surname` varchar(45) DEFAULT NULL,
  `document_id` int NOT NULL,
  `id` int NOT NULL,
  `signature` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`date_of_birth`,`id`),
  UNIQUE KEY `document_id_UNIQUE` (`document_id`),
  CONSTRAINT `fk_passport_document_id` FOREIGN KEY (`document_id`) REFERENCES `document` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `passport_details`
--

LOCK TABLES `passport_details` WRITE;
/*!40000 ALTER TABLE `passport_details` DISABLE KEYS */;
/*!40000 ALTER TABLE `passport_details` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ration_card`
--

DROP TABLE IF EXISTS `ration_card`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `ration_card` (
  `document_id` int NOT NULL,
  `address` varchar(170) DEFAULT NULL,
  `age` int NOT NULL,
  `id` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`age`),
  UNIQUE KEY `card_number_UNIQUE` (`document_id`),
  CONSTRAINT `fk_ration_document_id` FOREIGN KEY (`document_id`) REFERENCES `document` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ration_card`
--

LOCK TABLES `ration_card` WRITE;
/*!40000 ALTER TABLE `ration_card` DISABLE KEYS */;
/*!40000 ALTER TABLE `ration_card` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` int NOT NULL,
  `first_name` varchar(45) NOT NULL,
  `last_name` varchar(45) NOT NULL,
  `contact_number` varchar(45) NOT NULL,
  `email_address` varchar(180) NOT NULL,
  `aadhar_number` varchar(20) NOT NULL,
  PRIMARY KEY (`aadhar_number`),
  UNIQUE KEY `id_UNIQUE` (`id`),
  KEY `fk_aadhar_id_idx` (`aadhar_number`),
  CONSTRAINT `fk_user` FOREIGN KEY (`aadhar_number`) REFERENCES `aadhar_details` (`aadhar_number`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (3,'Mohd','Aftab','9868486602','mohd.aftab@gmail.com','2076 2689 5850'),(2,'Yashika ','Goyal','8750151934','goyalyashika2105@gmail.com','3581 5645 2592'),(1,'Radhika','Sharma','8368765745','radhikavasheshta@gmail.com','8055 3608 7323');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `voter_id`
--

DROP TABLE IF EXISTS `voter_id`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `voter_id` (
  `id` int NOT NULL,
  `name` varchar(75) DEFAULT NULL,
  `gender` tinytext,
  `date_of_birth` date DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`),
  CONSTRAINT `fk_voter_id` FOREIGN KEY (`id`) REFERENCES `document` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `voter_id`
--

LOCK TABLES `voter_id` WRITE;
/*!40000 ALTER TABLE `voter_id` DISABLE KEYS */;
/*!40000 ALTER TABLE `voter_id` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2022-08-19 23:41:19
