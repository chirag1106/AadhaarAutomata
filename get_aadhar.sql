

DROP TABLE IF EXISTS `book_an_appointment`;
CREATE TABLE `book_an_appointment` (
  `aadhar_id` int NOT NULL,
  `name` varchar(100) NOT NULL,
  `mobile_no.` varchar(15) NOT NULL,
  `email_address` varchar(85) NOT NULL,
  `resident` varchar(300) NOT NULL,
  `enrolment_id` varchar(20) NOT NULL,
  PRIMARY KEY (`enrolment_id`),
  UNIQUE KEY `email_address_UNIQUE` (`email_address`),
  UNIQUE KEY `aadhar_id_UNIQUE` (`aadhar_id`),
  CONSTRAINT `fk_appointment` FOREIGN KEY (`enrolment_id`) REFERENCES `user` (`enrolment_id`),
  CONSTRAINT `fk_locate` FOREIGN KEY (`enrolment_id`) REFERENCES `locate_enrolment_centre` (`enrolment_id`)
);

LOCK TABLES `book_an_appointment` WRITE;
UNLOCK TABLES;


DROP TABLE IF EXISTS `check_aadhar_status`;
CREATE TABLE `check_aadhar_status` (
  `enrolment_id` varchar(20) NOT NULL,
  `aadhar_id` varchar(20) NOT NULL,
  `vid` varchar(20) NOT NULL,
  `download_aadhar` varchar(45) DEFAULT NULL,
  `aadhar_pvc_card` varchar(45) DEFAULT NULL,
  `check_pvc_card_status` varchar(45) DEFAULT NULL,
  `check_enrolment_and_update_status` varchar(45) DEFAULT NULL,
  `retrieve_eid_or_vid` varchar(45) DEFAULT NULL,
  `verify_email` varchar(45) DEFAULT NULL,
  `verify_mobile_no.` varchar(45) DEFAULT NULL,
  `verify_aadhar` varchar(45) DEFAULT NULL,
  `vid_generator` varchar(45) DEFAULT NULL,
  `lock_aadhar` varchar(45) DEFAULT NULL,
  `unlock_aadhar` varchar(45) DEFAULT NULL,
  `complaint_file` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`enrolment_id`),
  UNIQUE KEY `aadhar_id_UNIQUE` (`aadhar_id`),
  UNIQUE KEY `vid_UNIQUE` (`vid`),
  CONSTRAINT `fk_check_appointment` FOREIGN KEY (`enrolment_id`) REFERENCES `book_an_appointment` (`enrolment_id`),
  CONSTRAINT `fk_user` FOREIGN KEY (`enrolment_id`) REFERENCES `user` (`enrolment_id`)
);

LOCK TABLES `check_aadhar_status` WRITE;
UNLOCK TABLES;


DROP TABLE IF EXISTS `locate_enrolment_centre`;
CREATE TABLE `locate_enrolment_centre` (
  `enrolment_id` varchar(20) NOT NULL,
  `state` char(85) DEFAULT NULL,
  `city` varchar(120) DEFAULT NULL,
  `district` varchar(120) DEFAULT NULL,
  `sub_district` varchar(120) DEFAULT NULL,
  `address` varchar(300) DEFAULT NULL,
  `pincode` int DEFAULT NULL,
  PRIMARY KEY (`enrolment_id`),
  CONSTRAINT `fk_centre_id` FOREIGN KEY (`enrolment_id`) REFERENCES `user` (`enrolment_id`)
);

LOCK TABLES `locate_enrolment_centre` WRITE;
UNLOCK TABLES;


DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `enrolment_id` varchar(20) NOT NULL,
  `aadhar_id` varchar(20) NOT NULL,
  `vid` varchar(20) NOT NULL,
  `name` varchar(100) NOT NULL,
  `address` varchar(300) NOT NULL,
  `mobile no.` varchar(15) NOT NULL,
  `email_address` varchar(85) NOT NULL,
  `gender` tinytext NOT NULL,
  PRIMARY KEY (`enrolment_id`),
  UNIQUE KEY `aadhar_id_UNIQUE` (`aadhar_id`),
  UNIQUE KEY `vid_UNIQUE` (`vid`),
  UNIQUE KEY `email_address_UNIQUE` (`email_address`)
) ;

LOCK TABLES `user` WRITE;
UNLOCK TABLES;
