
DROP TABLE IF EXISTS `aadhar_details`;
CREATE TABLE `aadhar_details` (
  `id` int NOT NULL,
  `aadhar_number` varchar(20) NOT NULL,
  `name` char(50) NOT NULL,
  `date_of_birth` date NOT NULL,
  `gender` tinytext NOT NULL,
  `address` varchar(600) NOT NULL,
  `contact_number` varchar(15) NOT NULL,
  `email_address` varchar(85) NOT NULL,
  PRIMARY KEY (`aadhar_number`),
  UNIQUE KEY `aadhar_id_UNIQUE` (`id`),
  UNIQUE KEY `email_address_UNIQUE` (`email_address`)
);

LOCK TABLES `aadhar_details` WRITE;
UNLOCK TABLES;



DROP TABLE IF EXISTS `check_aadhar_status`;
CREATE TABLE `check_aadhar_status` (
  `aadhar_number` varchar(20) NOT NULL,
  `name` char(50) NOT NULL,
  `contact_number` varchar(14) NOT NULL,
  `enrolment_id` varchar(20) NOT NULL,
  `status_aadhar` varchar(600) DEFAULT NULL,
  PRIMARY KEY (`aadhar_number`),
  UNIQUE KEY `aadhar_number_UNIQUE` (`aadhar_number`),
  UNIQUE KEY `enrolment_id_UNIQUE` (`enrolment_id`),
  CONSTRAINT `fk_status` FOREIGN KEY (`aadhar_number`) REFERENCES `aadhar_details` (`aadhar_number`)
);

LOCK TABLES `check_aadhar_status` WRITE;
unLOCK TABLES;



DROP TABLE IF EXISTS `check_update_history`;
CREATE TABLE `check_update_history` (
  `aadhar_number` varchar(20) NOT NULL,
  `enrolment_id` int NOT NULL,
  `updated_history` varchar(45) DEFAULT NULL,
  UNIQUE KEY `aadhar_number_UNIQUE` (`aadhar_number`),
  UNIQUE KEY `enrolment_id_UNIQUE` (`enrolment_id`),
  CONSTRAINT `fk_update_history` FOREIGN KEY (`aadhar_number`) REFERENCES `aadhar_details` (`aadhar_number`)
) ;

LOCK TABLES `check_update_history` WRITE;
UNLOCK TABLES;


DROP TABLE IF EXISTS `update_aadhar_data`;
CREATE TABLE `update_aadhar_data` (
  `aadhar_number` varchar(20) NOT NULL,
  `contact_number` varchar(15) NOT NULL,
  `email_address` varchar(75) NOT NULL,
  `vid` varchar(16) NOT NULL,
  `update_contact_number` varchar(14) DEFAULT NULL,
  `update_email_address` varchar(75) DEFAULT NULL,
  `update_date_of_birth` date DEFAULT NULL,
  `update_address` varchar(170) DEFAULT NULL,
  `update_name` char(30) DEFAULT NULL,
  `update_gender` tinytext,
  PRIMARY KEY (`aadhar_number`),
  UNIQUE KEY `email_address_UNIQUE` (`email_address`),
  UNIQUE KEY `vid_UNIQUE` (`vid`),
  CONSTRAINT `fk_aadhar_data` FOREIGN KEY (`aadhar_number`) REFERENCES `aadhar_details` (`aadhar_number`)
);

LOCK TABLES `update_aadhar_data` WRITE;
UNLOCK TABLES;
