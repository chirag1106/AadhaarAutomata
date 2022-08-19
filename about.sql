

DROP TABLE IF EXISTS `aadhar_services`;
CREATE TABLE `aadhar_services` (
  `aadhar_number` int NOT NULL,
  `vid` int NOT NULL,
  `contact_number` varchar(14) NOT NULL,
  `email_address` varchar(75) NOT NULL,
  `verify_aadhar` varchar(45) DEFAULT NULL,
  `verify_contact_number` varchar(45) DEFAULT NULL,
  `verify_email_address` varchar(45) DEFAULT NULL,
  `enrollment_id` varchar(45) NOT NULL,
  `retrieve_aadhar` varchar(45) DEFAULT NULL,
  `generate_vid` varchar(45) DEFAULT NULL,
  `offline_aadhar_verification` varchar(45) DEFAULT NULL,
  `aadhar_linking_status` varchar(45) DEFAULT NULL,
  `secure_biometrics` varchar(45) DEFAULT NULL,
  `aadhar_lock` varchar(45) DEFAULT NULL,
  `aadhar_unlock` varchar(45) DEFAULT NULL,
  `authentication_history` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`aadhar_number`),
  UNIQUE KEY `aadhar_number_UNIQUE` (`aadhar_number`),
  UNIQUE KEY `vid_UNIQUE` (`vid`),
  UNIQUE KEY `email_address_UNIQUE` (`email_address`),
  UNIQUE KEY `enrollment_id_UNIQUE` (`enrollment_id`)
);
LOCK TABLES `aadhar_services` WRITE;
UNLOCK TABLES;
