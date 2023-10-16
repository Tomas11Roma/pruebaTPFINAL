-- MySQL dump 10.13  Distrib 8.0.34, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: mydb
-- ------------------------------------------------------
-- Server version	5.5.5-10.4.28-MariaDB

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
-- Table structure for table `anuncios`
--

DROP TABLE IF EXISTS `anuncios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `anuncios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `titulo` varchar(45) NOT NULL,
  `texto` varchar(255) NOT NULL,
  `fecha_publicacion` datetime NOT NULL,
  `vigente` tinyint(1) NOT NULL,
  `usuarios_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`,`usuarios_id`),
  KEY `fk_anuncios_usuarios1_idx` (`usuarios_id`),
  CONSTRAINT `fk_anuncios_usuarios1` FOREIGN KEY (`usuarios_id`) REFERENCES `usuarios` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=186 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `anuncios`
--

LOCK TABLES `anuncios` WRITE;
/*!40000 ALTER TABLE `anuncios` DISABLE KEYS */;
INSERT INTO `anuncios` VALUES (171,'Ausencia de profesor','Profesor González de Estadística se ausentará en el día de la fecha.','2023-10-14 03:05:10',0,1),(172,'Suspensión de clases','Los alumnos no tendrán clase en el día de la fecha por falta de profesores en sus respectivas materias.','2023-10-14 03:06:03',0,2),(173,'Cambio de horario','Profesor Perez de Programación I adelantará sus horas del día jueves, ingresando los alumnos 19:20hs y retirándose 20:40hs.','2023-10-14 03:06:26',0,3),(177,'Ausencia de profesor','Profesor Alfaro de Estadística se ausentará en el día de la fecha.','2023-10-14 20:54:57',0,3),(179,'Ausencia de profesor','Profesor Rodriguez de Ingeniería de Software I se ausentará en el día de la fecha.','2023-10-15 21:09:29',0,2),(180,'Suspensión de clases','Los alumnos no tendrán clase en el día de la fecha por falta de profesores en sus respectivas materias.','2023-10-15 21:11:14',1,2),(181,'Cambio de horario','Profesor Perez de Programación II adelantará sus horas del día miercoles, ingresando los alumnos 19:20hs y retirándose 20:40hs.','2023-10-15 21:12:52',1,2),(182,'Suspensión de clases','Los alumnos no tendrán clase en el día de la fecha por falta de profesores en sus respectivas materias.','2023-10-15 21:13:36',1,3),(184,'Ausencia de profesor','Profesor Malcorra de LED se ausentará en el día de la fecha.','2023-10-15 21:15:25',1,3),(185,'Cambio de horario','Profesor Hoyos de UDI II adelantará sus horas del día viernes, ingresando los alumnos 19:20hs y retirándose 20:40hs.','2023-10-15 21:17:56',1,3);
/*!40000 ALTER TABLE `anuncios` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `anuncios.comisiones`
--

DROP TABLE IF EXISTS `anuncios.comisiones`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `anuncios.comisiones` (
  `anuncios_id` int(11) NOT NULL,
  `comisiones_id` varchar(255) NOT NULL,
  PRIMARY KEY (`anuncios_id`,`comisiones_id`),
  KEY `fk_anuncios_has_comisiones_comisiones1_idx` (`comisiones_id`),
  KEY `fk_anuncios_has_comisiones_anuncios_idx` (`anuncios_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `anuncios.comisiones`
--

LOCK TABLES `anuncios.comisiones` WRITE;
/*!40000 ALTER TABLE `anuncios.comisiones` DISABLE KEYS */;
INSERT INTO `anuncios.comisiones` VALUES (171,'AF13'),(172,'DS22'),(173,'ITI31'),(174,'ITI11'),(175,'ITI31'),(176,'DS31'),(177,'DS23'),(178,'DS11'),(179,'DS11'),(180,'ITI22'),(181,'DS21'),(182,'ITI22'),(183,'DS11'),(184,'DS12'),(185,'DS23');
/*!40000 ALTER TABLE `anuncios.comisiones` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `comisiones`
--

DROP TABLE IF EXISTS `comisiones`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `comisiones` (
  `id` varchar(255) NOT NULL,
  `anio` tinyint(3) unsigned NOT NULL,
  `comision` tinyint(3) unsigned NOT NULL,
  `carrera` varchar(45) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `comisiones`
--

LOCK TABLES `comisiones` WRITE;
/*!40000 ALTER TABLE `comisiones` DISABLE KEYS */;
INSERT INTO `comisiones` VALUES ('AF11',1,1,'AF'),('AF12',1,2,'AF'),('AF13',1,3,'AF'),('AF21',2,1,'AF'),('AF22',2,2,'AF'),('AF31',3,1,'AF'),('DS11',1,1,'DS'),('DS12',1,2,'DS'),('DS13',1,3,'DS'),('DS21',2,1,'DS'),('DS22',2,2,'DS'),('DS23',2,3,'DS'),('DS31',3,1,'DS'),('DS32',3,2,'DS'),('ITI11',1,1,'ITI'),('ITI12',1,2,'ITI'),('ITI21',2,1,'ITI'),('ITI22',2,2,'ITI'),('ITI31',3,1,'ITI'),('ITI32',3,2,'ITI');
/*!40000 ALTER TABLE `comisiones` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `usuarios` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nombre_usuario` varchar(45) NOT NULL,
  `clave` varchar(255) NOT NULL,
  `nombre` varchar(200) NOT NULL,
  `apellido` varchar(200) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `nombre_usuario_UNIQUE` (`nombre_usuario`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuarios`
--

LOCK TABLES `usuarios` WRITE;
/*!40000 ALTER TABLE `usuarios` DISABLE KEYS */;
INSERT INTO `usuarios` VALUES (1,'magalisichero','$2y$10$MKEZOE1o/HEE2KAgDMBkq.j6kjw0tiu.FGMSKLdi9wU8MMDQIlpFO','Magalí','Sichero'),(2,'tomasroma','$2y$10$Hkj4AWSr04omDcd6RuXR3uEM8R096QZ3/EY18xEnzvawDB7e6lCzK','Tomás Ignacio','Roma'),(3,'juansemarquez','$2y$10$MKEZOE1o/HEE2KAgDMBkq.j6kjw0tiu.FGMSKLdi9wU8MMDQIlpFO','Juan','Marquez'),(4,'lorenapassaro','$2y$10$a7drtm2P9YnnYEaqU/P4NOICCJeoohOXCtQB8NH0zr4c49Atj3z0S','Lorena','Passaro');
/*!40000 ALTER TABLE `usuarios` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2023-10-15 21:25:40
