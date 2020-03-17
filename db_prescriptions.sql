-- MySQL dump 10.13  Distrib 5.5.58, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: db_prescription
-- ------------------------------------------------------
-- Server version	5.5.58-0ubuntu0.14.04.1

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `tb_diagnosis`
--

DROP TABLE IF EXISTS `tb_diagnosis`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tb_diagnosis` (
  `id_diagnosis` int(11) NOT NULL AUTO_INCREMENT,
  `receita_id` int(11) NOT NULL,
  `patient_id` int(11) NOT NULL,
  `diagnosis_reason` varchar(255) DEFAULT NULL,
  `diagnosis_refractive` varchar(255) DEFAULT NULL,
  `diagnosis_motor` varchar(255) DEFAULT NULL,
  `diagnosis_pathological` varchar(255) DEFAULT NULL,
  `diagnosis_comments` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_diagnosis`),
  UNIQUE KEY `receita_id` (`receita_id`,`patient_id`),
  KEY `patient_id` (`patient_id`),
  CONSTRAINT `tb_diagnosis_ibfk_1` FOREIGN KEY (`patient_id`) REFERENCES `tb_patient` (`id_patient`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `tb_diagnosis_ibfk_2` FOREIGN KEY (`receita_id`) REFERENCES `tb_prescription` (`id_prescription`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_diagnosis`
--

LOCK TABLES `tb_diagnosis` WRITE;
/*!40000 ALTER TABLE `tb_diagnosis` DISABLE KEYS */;
/*!40000 ALTER TABLE `tb_diagnosis` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_patient`
--

DROP TABLE IF EXISTS `tb_patient`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tb_patient` (
  `id_patient` int(11) NOT NULL AUTO_INCREMENT,
  `patient_name` varchar(255) NOT NULL,
  `patient_address` varchar(255) NOT NULL,
  `patient_city` varchar(255) NOT NULL,
  `patient_birthday` date NOT NULL,
  `patient_genre` varchar(1) NOT NULL,
  `patient_cpf` varchar(11) NOT NULL,
  `patient_responsible` varchar(255) NOT NULL,
  `patient_contact` varchar(15) NOT NULL,
  `patient_email` varchar(255) NOT NULL,
  `patient_occupation` varchar(255) NOT NULL,
  `patient_created_in` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_patient`),
  UNIQUE KEY `patient_cpf` (`patient_cpf`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_patient`
--

LOCK TABLES `tb_patient` WRITE;
/*!40000 ALTER TABLE `tb_patient` DISABLE KEYS */;
INSERT INTO `tb_patient` VALUES (2,'Ana Claudia Pereira de Souza','justina alves','horizonte','1988-04-29','','01516726367','','85 98833-1627','acpdsl@gmail.com','','2018-02-04 23:55:11'),(4,'Jardeson Erlan','Rua Saquarema 601','Fortaleza','1990-02-16','','04824030390','','85996902867','jarderlan2@hotmail.com','Analista de Sistemas','2018-02-05 00:51:45'),(5,'Lais Souza','La Na Rua Tal','Quintino Cunha','2006-04-24','','Nao TeM','Pai','85999999999','Naotem@gmail.com','Estudante','2018-02-09 21:05:41'),(6,'Teste','Rua da flores','Baturite','1990-02-16','','99999911234','','99999999','teste@teste.com.br','Nem Um','2018-02-12 22:42:56');
/*!40000 ALTER TABLE `tb_patient` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_prescription`
--

DROP TABLE IF EXISTS `tb_prescription`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tb_prescription` (
  `id_prescription` int(11) NOT NULL AUTO_INCREMENT,
  `patient_id` int(11) NOT NULL,
  `prescription_re_esf` float NOT NULL,
  `prescription_re_cil` float NOT NULL,
  `prescription_re_eixo` float NOT NULL,
  `prescription_re_dp` float NOT NULL,
  `prescription_le_esf` float NOT NULL,
  `prescription_le_cil` float NOT NULL,
  `prescription_le_eixo` float NOT NULL,
  `prescription_le_dp` float NOT NULL,
  `prescription_addition` float NOT NULL,
  `prescription_comments` varchar(150) NOT NULL,
  `prescription_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_prescription`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_prescription`
--

LOCK TABLES `tb_prescription` WRITE;
/*!40000 ALTER TABLE `tb_prescription` DISABLE KEYS */;
INSERT INTO `tb_prescription` VALUES (4,4,0.25,0,0,0,0.75,0,0,0,0,'','2018-02-09 20:55:31'),(5,5,2,-1.75,120,27,2.75,-2,65,28,0,'N/A','2018-02-10 03:01:34'),(6,5,-2.75,-2,88,0,-3,-2.75,75,0,0,'','2018-02-12 21:52:12'),(13,6,2,-1.75,90,0,0.75,-2,110,0,0,'','2018-02-12 22:43:28');
/*!40000 ALTER TABLE `tb_prescription` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_users`
--

DROP TABLE IF EXISTS `tb_users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tb_users` (
  `id_user` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_name` varchar(255) NOT NULL,
  `user_email` varchar(255) DEFAULT NULL,
  `user_phone` varchar(15) DEFAULT NULL,
  `user_password` varchar(255) NOT NULL,
  `user_occupation` varchar(100) NOT NULL,
  `user_registry` varchar(100) NOT NULL,
  `user_profile` varchar(255) NOT NULL,
  `user_created_in` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_user`),
  UNIQUE KEY `id_user` (`id_user`),
  UNIQUE KEY `user_email` (`user_email`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_users`
--

LOCK TABLES `tb_users` WRITE;
/*!40000 ALTER TABLE `tb_users` DISABLE KEYS */;
INSERT INTO `tb_users` VALUES (1,'Jarderlan Lima','jarderlan@gmail.com','85 99690-2867','96fb7aa73445529983a89a34f4a6b3635b0ff4a5','Analista de Sistemas','','admin','2018-02-05 00:49:32'),(2,'admin','admin@admin.com.br','','d033e22ae348aeb5660fc2140aec35850c4da997','Analista de Sistemas','','admin','2018-02-05 23:31:53');
/*!40000 ALTER TABLE `tb_users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2018-03-06  0:37:11
