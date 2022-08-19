

DROP TABLE IF EXISTS `aadhar_details`;
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
) ;


LOCK TABLES `aadhar_details` WRITE;
INSERT INTO `aadhar_details` VALUES (3,'2076 2689 5850','Mohd Aftab','2002-04-18','male ','krishna nagar ','9868486602','9156 3164 5674 1234'),(2,'3581 5645 2592','Yashika Goyal','2003-05-21','female ','krishna nagar ','8750151934','9190 9625 9239 1378'),(1,'8055 3608 7323','Radhika Sharma','2002-11-04','female','krishna nagar','8368765745','9159 3135 4330 2803');
UNLOCK TABLES;


DROP TABLE IF EXISTS `document`;
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
);

LOCK TABLES `document` WRITE;
UNLOCK TABLES;


DROP TABLE IF EXISTS `driving_license`;
CREATE TABLE `driving_license` (
  `id` int NOT NULL,
  `name` varchar(25) NOT NULL,
  `date_of_birth` date NOT NULL,
  `address` varchar(170) NOT NULL,
  PRIMARY KEY (`id`),
  CONSTRAINT `fk_license_document_id` FOREIGN KEY (`id`) REFERENCES `document` (`id`)
);

LOCK TABLES `driving_license` WRITE;
UNLOCK TABLES;


CREATE TABLE `electricity_bill` (
  `id` int NOT NULL,
  `document_id` int NOT NULL,
  `address` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `document_id_UNIQUE` (`document_id`),
  CONSTRAINT `fk_electricity_document_id` FOREIGN KEY (`document_id`) REFERENCES `document` (`id`)
) ;


LOCK TABLES `electricity_bill` WRITE;
UNLOCK TABLES;


DROP TABLE IF EXISTS `pan_card`;
CREATE TABLE `pan_card` (
  `id` int NOT NULL,
  `name` char(30) NOT NULL,
  `date_of_birth` date NOT NULL,
  PRIMARY KEY (`id`,`name`,`date_of_birth`),
  CONSTRAINT `fk_pancard_document` FOREIGN KEY (`id`) REFERENCES `document` (`id`)
);

LOCK TABLES `pan_card` WRITE;
UNLOCK TABLES;


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
) ;

LOCK TABLES `passport_details` WRITE;
UNLOCK TABLES;



CREATE TABLE `ration_card` (
  `document_id` int NOT NULL,
  `address` varchar(170) DEFAULT NULL,
  `age` int NOT NULL,
  `id` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`age`),
  UNIQUE KEY `card_number_UNIQUE` (`document_id`),
  CONSTRAINT `fk_ration_document_id` FOREIGN KEY (`document_id`) REFERENCES `document` (`id`)
);

LOCK TABLES `ration_card` WRITE;
UNLOCK TABLES;



DROP TABLE IF EXISTS `users`;
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
);


LOCK TABLES `users` WRITE;
INSERT INTO `users` VALUES (3,'Mohd','Aftab','9868486602','mohd.aftab@gmail.com','2076 2689 5850'),(2,'Yashika ','Goyal','8750151934','goyalyashika2105@gmail.com','3581 5645 2592'),(1,'Radhika','Sharma','8368765745','radhikavasheshta@gmail.com','8055 3608 7323');


UNLOCK TABLES;


CREATE TABLE `voter_id` (
  `id` int NOT NULL,
  `name` varchar(75) DEFAULT NULL,
  `gender` tinytext,
  `date_of_birth` date DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`),
  CONSTRAINT `fk_voter_id` FOREIGN KEY (`id`) REFERENCES `document` (`id`)
);

LOCK TABLES `voter_id` WRITE;
UNLOCK TABLES;

