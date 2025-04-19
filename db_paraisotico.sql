CREATE DATABASE  IF NOT EXISTS `db_paraisotico` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci */;
USE `db_paraisotico`;
-- MySQL dump 10.13  Distrib 8.0.36, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: db_paraisotico
-- ------------------------------------------------------
-- Server version	5.5.5-10.4.32-MariaDB

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
-- Table structure for table `actividades`
--

DROP TABLE IF EXISTS `actividades`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `actividades` (
  `id_actividad` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) NOT NULL,
  `descripcion` varchar(255) DEFAULT NULL,
  `precio` decimal(10,2) DEFAULT NULL,
  `punto_encuentro` varchar(100) DEFAULT NULL,
  `descripcion_incluye` varchar(500) DEFAULT NULL,
  `id_categorias` int(11) NOT NULL,
  `rutaImagen` varchar(2000) DEFAULT NULL,
  `activo` tinyint(1) NOT NULL DEFAULT 1,
  `id_provincia` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_actividad`),
  KEY `fk_act_categoria` (`id_categorias`),
  KEY `FK_id_provincia` (`id_provincia`),
  CONSTRAINT `FK_id_provincia` FOREIGN KEY (`id_provincia`) REFERENCES `provincias` (`id_provincias`),
  CONSTRAINT `fk_act_categoria` FOREIGN KEY (`id_categorias`) REFERENCES `categorias` (`id_categorias`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `actividades`
--

LOCK TABLES `actividades` WRITE;
/*!40000 ALTER TABLE `actividades` DISABLE KEYS */;
/*!40000 ALTER TABLE `actividades` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `blog`
--

DROP TABLE IF EXISTS `blog`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `blog` (
  `id_blog` int(11) NOT NULL AUTO_INCREMENT,
  `titulo` varchar(100) NOT NULL,
  `contenido` varchar(1022) DEFAULT NULL,
  `fecha_publicacion` date NOT NULL,
  `id_usuario` int(11) NOT NULL,
  PRIMARY KEY (`id_blog`),
  KEY `id_usuario` (`id_usuario`),
  CONSTRAINT `blog_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_usuario`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `blog`
--

LOCK TABLES `blog` WRITE;
/*!40000 ALTER TABLE `blog` DISABLE KEYS */;
/*!40000 ALTER TABLE `blog` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `canton`
--

DROP TABLE IF EXISTS `canton`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `canton` (
  `id_canton` int(11) NOT NULL AUTO_INCREMENT,
  `id_provincias` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `activo` tinyint(1) NOT NULL,
  PRIMARY KEY (`id_canton`),
  KEY `fk_canton_provincia` (`id_provincias`),
  CONSTRAINT `fk_canton_provincia` FOREIGN KEY (`id_provincias`) REFERENCES `provincias` (`id_provincias`)
) ENGINE=InnoDB AUTO_INCREMENT=61 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `canton`
--

LOCK TABLES `canton` WRITE;
/*!40000 ALTER TABLE `canton` DISABLE KEYS */;
INSERT INTO `canton` VALUES (1,1,'San José',1),(2,1,'Escazú',1),(3,1,'Desamparados',1),(4,1,'Aserrí',1),(5,1,'Puriscal',1),(6,1,'Mora',1),(7,1,'Tarrazú',1),(8,1,'Tarrazú',1),(9,1,'Goicoechea',1),(10,1,'Santa Ana',1),(11,2,'Alajuela',1),(12,2,'San Ramón',1),(13,2,'Grecia',1),(14,2,'Atenas',1),(15,2,'Naranjo',1),(16,2,'Palmares',1),(17,2,'Poás',1),(18,2,'Orotina',1),(19,3,'Alvarado',1),(20,3,'Cartago',1),(21,3,'El Guarco',1),(22,3,'Jiménez',1),(23,3,'La Unión',1),(24,3,'Paraíso',1),(25,3,'Turrialba',1),(26,4,'Barva',1),(27,4,'Flores',1),(28,4,'Heredia',1),(29,4,'San Isidro',1),(30,4,'San Pablo',1),(31,4,'San Rafael',1),(32,4,'Santa Bárbara',1),(33,4,'Sarapiquí',1),(34,4,'Santo Domingo.',1),(35,5,'Abangares',1),(36,5,'Bagaces',1),(37,5,'Cañas',1),(38,5,'Carrillo',1),(39,5,'La Cruz',1),(40,5,'Liberia',1),(41,5,'Nandayure',1),(42,5,'Santa Cruz',1),(43,5,'Tilarán',1),(44,6,'Puntarenas',1),(45,6,'Esparza',1),(46,6,'Buenos Aires',1),(47,6,'Montes de Oro',1),(48,6,'Osa',1),(49,6,'Quepos',1),(50,6,'Golfito',1),(51,6,'Coto Brus',1),(52,6,'Parrita',1),(53,6,'Corredores',1),(54,6,'Garabito',1),(55,7,'Limon',1),(56,7,'Pococí',1),(57,7,'Siquirres',1),(58,7,'Talamanca',1),(59,7,'Guácimo',1),(60,7,'Matina',1);
/*!40000 ALTER TABLE `canton` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `categorias`
--

DROP TABLE IF EXISTS `categorias`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `categorias` (
  `id_categorias` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) NOT NULL,
  `activo` tinyint(1) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id_categorias`),
  UNIQUE KEY `CATEGORIAS_NOMBRE_UNIQUE_IDX` (`nombre`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categorias`
--

LOCK TABLES `categorias` WRITE;
/*!40000 ALTER TABLE `categorias` DISABLE KEYS */;
INSERT INTO `categorias` VALUES (1,'Prueba desde el FrontEnd',1),(7,'Segunda Prueba desde el F',1),(8,'Tercera Prueba FrontEnd',1);
/*!40000 ALTER TABLE `categorias` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ofertas`
--

DROP TABLE IF EXISTS `ofertas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `ofertas` (
  `id_oferta` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(50) NOT NULL,
  `descuento` decimal(5,2) NOT NULL,
  `fecha_publicacion` date NOT NULL,
  `fecha_inicio` date NOT NULL,
  `fecha_fin` date NOT NULL,
  `activo` tinyint(1) NOT NULL,
  PRIMARY KEY (`id_oferta`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ofertas`
--

LOCK TABLES `ofertas` WRITE;
/*!40000 ALTER TABLE `ofertas` DISABLE KEYS */;
/*!40000 ALTER TABLE `ofertas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `provincias`
--

DROP TABLE IF EXISTS `provincias`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `provincias` (
  `id_provincias` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) NOT NULL,
  `activo` tinyint(1) NOT NULL,
  PRIMARY KEY (`id_provincias`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `provincias`
--

LOCK TABLES `provincias` WRITE;
/*!40000 ALTER TABLE `provincias` DISABLE KEYS */;
INSERT INTO `provincias` VALUES (1,'San Jose',1),(2,'Alajuela',1),(3,'Cargago',1),(4,'Heredia',1),(5,'Guanacaste',1),(6,'Puntarenas',1),(7,'Limon',1);
/*!40000 ALTER TABLE `provincias` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `rol`
--

DROP TABLE IF EXISTS `rol`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `rol` (
  `id_rol` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(10) NOT NULL,
  `activo` tinyint(1) NOT NULL,
  PRIMARY KEY (`id_rol`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `rol`
--

LOCK TABLES `rol` WRITE;
/*!40000 ALTER TABLE `rol` DISABLE KEYS */;
/*!40000 ALTER TABLE `rol` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuario`
--

DROP TABLE IF EXISTS `usuario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `usuario` (
  `id_usuario` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(25) NOT NULL,
  `password` varchar(60) NOT NULL,
  `nombre` varchar(25) NOT NULL,
  `primer_apellido` varchar(25) NOT NULL,
  `correo` varchar(50) NOT NULL,
  `telefono` varchar(15) DEFAULT NULL,
  `ruta_imagen` varchar(1022) DEFAULT NULL,
  `activo` tinyint(1) NOT NULL,
  PRIMARY KEY (`id_usuario`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuario`
--

LOCK TABLES `usuario` WRITE;
/*!40000 ALTER TABLE `usuario` DISABLE KEYS */;
INSERT INTO `usuario` VALUES (1,'paraisotico23','123','admin','admin','paraisotico23@gmail.com',NULL,NULL,1),(2,'ignacii31','123','Ignacio Enrique','Vargas Mendoza','ignacii31@gmail.com',NULL,NULL,1);
/*!40000 ALTER TABLE `usuario` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuarios_roles`
--

DROP TABLE IF EXISTS `usuarios_roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `usuarios_roles` (
  `id_rol` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  PRIMARY KEY (`id_rol`,`id_usuario`),
  KEY `id_usuario` (`id_usuario`),
  CONSTRAINT `usuarios_roles_ibfk_1` FOREIGN KEY (`id_rol`) REFERENCES `rol` (`id_rol`),
  CONSTRAINT `usuarios_roles_ibfk_2` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_usuario`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuarios_roles`
--

LOCK TABLES `usuarios_roles` WRITE;
/*!40000 ALTER TABLE `usuarios_roles` DISABLE KEYS */;
/*!40000 ALTER TABLE `usuarios_roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping routines for database 'db_paraisotico'
--
/*!50003 DROP PROCEDURE IF EXISTS `SP_ConsultarCantones` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_ConsultarCantones`()
BEGIN
    SELECT 
        id_canton,
        nombre,
        id_provincias
    FROM Canton
    WHERE activo = 1; 
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `SP_ConsultarCategorias` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_ConsultarCategorias`(pActivo tinyint)
BEGIN
    SELECT id_categorias , nombre
    FROM Categorias c
    WHERE c.activo = pActivo;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `SP_ConsultarProvincias` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_ConsultarProvincias`()
BEGIN
    SELECT 
        id_provincias,
        nombre
    FROM Provincias
    WHERE activo = 1; 
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `SP_InsertarActividad` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_InsertarActividad`(
	pNombre varchar(50),
	pDescripcion varchar(255),
	pPrecio decimal(10,2),
	pPuntoEncuentro varchar(100),
    pDescripcionIncluye varchar(500),
    pID_categorias int(11),
    pRutaImagen varchar(2000),
    pID_provincia int(11)
)
BEGIN
	INSERT INTO db_paraisotico.actividades(nombre, descripcion, precio, punto_encuentro, descripcion_incluye, id_categorias, rutaImagen, activo, id_provincia)
	VALUES(pNombre, pDescripcion, pPrecio, pPuntoEncuentro, pDescripcionIncluye, pID_categorias, pRutaImagen, 1, pID_provincia);
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `SP_InsertarCategoria` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_InsertarCategoria`( p_nombre VARCHAR(25))
BEGIN
    INSERT INTO categorias(nombre, activo)
    VALUES(p_nombre, 1);
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2025-04-18 19:20:13
