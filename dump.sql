-- MySQL dump 10.13  Distrib 5.6.24, for Win32 (x86)
--
-- Host: 127.0.0.1    Database: estoque
-- ------------------------------------------------------
-- Server version	5.6.24

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
-- Table structure for table `container`
--

DROP TABLE IF EXISTS `container`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `container` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `referencia` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dthr_criacao` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `usuario_criacao` bigint(20) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `caixa_id_uindex` (`id`),
  UNIQUE KEY `caixa_ref_uindex` (`referencia`),
  KEY `container_usuario_id_fk` (`usuario_criacao`),
  CONSTRAINT `container_usuario_id_fk` FOREIGN KEY (`usuario_criacao`) REFERENCES `usuario` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `container`
--

LOCK TABLES `container` WRITE;
/*!40000 ALTER TABLE `container` DISABLE KEYS */;
INSERT INTO `container` VALUES (11,'20170001','2017-12-21 20:01:06',3),(28,'20170002','2017-12-21 20:50:23',3),(29,'20170003','2017-12-21 20:51:07',3),(30,'20170004','2017-12-21 20:51:37',3),(31,'20170005','2017-12-21 20:52:04',3);
/*!40000 ALTER TABLE `container` ENABLE KEYS */;
UNLOCK TABLES;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_ENGINE_SUBSTITUTION' */ ;
/*!50032 DROP TRIGGER IF EXISTS geraref */;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`estoque`@`%`*/ /*!50003 TRIGGER geraref BEFORE INSERT ON container FOR EACH ROW
BEGIN
  DECLARE CNT INT;
  SELECT COUNT(id) FROM container WHERE referencia like CONCAT( YEAR(NOW()), '%') INTO CNT;
  SET NEW.referencia = CONCAT( YEAR(NOW()) , LPAD( CONVERT(CNT+1,char) , 4, '0' ) );
END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;

--
-- Table structure for table `produto`
--

DROP TABLE IF EXISTS `produto`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `produto` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `id_container` bigint(20) DEFAULT NULL,
  `referencia` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `descricao` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL,
  `observacao` mediumtext COLLATE utf8mb4_unicode_ci,
  `variacao` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dthr_criacao` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `usuario_criacao` bigint(20) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `produto_id_uindex` (`id`),
  UNIQUE KEY `produto_referencia_uindex` (`referencia`),
  KEY `produto_caixa_id_fk` (`id_container`),
  KEY `produto_usuario_id_fk` (`usuario_criacao`),
  CONSTRAINT `produto_caixa_id_fk` FOREIGN KEY (`id_container`) REFERENCES `container` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `produto_usuario_id_fk` FOREIGN KEY (`usuario_criacao`) REFERENCES `usuario` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `produto`
--

LOCK TABLES `produto` WRITE;
/*!40000 ALTER TABLE `produto` DISABLE KEYS */;
INSERT INTO `produto` VALUES (1,11,'20170001','Blusa x',NULL,NULL,'2017-12-21 20:58:03',3),(2,31,'20170002','111','222','azul','2017-12-22 16:09:11',3),(3,31,'20170003','short saia','aviso qwe','nude, p','2017-12-22 17:01:29',3),(4,30,'20170004','Calça X','oiasdjoidas','P','2017-12-22 19:33:02',3);
/*!40000 ALTER TABLE `produto` ENABLE KEYS */;
UNLOCK TABLES;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_ENGINE_SUBSTITUTION' */ ;
/*!50032 DROP TRIGGER IF EXISTS gerarefprod */;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`estoque`@`%`*/ /*!50003 TRIGGER gerarefprod BEFORE INSERT ON produto FOR EACH ROW
BEGIN
  DECLARE CNT INT;
  SELECT COUNT(id) FROM produto WHERE referencia like CONCAT( YEAR(NOW()), '%') INTO CNT;
  SET NEW.referencia = CONCAT( YEAR(NOW()) , LPAD( CONVERT(CNT+1,char) , 4, '0' ) );
END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;

--
-- Table structure for table `tipo_usuario`
--

DROP TABLE IF EXISTS `tipo_usuario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tipo_usuario` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `descricao` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `tipo_usuario_id_uindex` (`id`),
  UNIQUE KEY `tipo_usuario_descricao_uindex` (`descricao`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tipo_usuario`
--

LOCK TABLES `tipo_usuario` WRITE;
/*!40000 ALTER TABLE `tipo_usuario` DISABLE KEYS */;
INSERT INTO `tipo_usuario` VALUES (1,'ADMIN'),(10,'normal');
/*!40000 ALTER TABLE `tipo_usuario` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuario`
--

DROP TABLE IF EXISTS `usuario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `usuario` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `login` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `prenome` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sobrenome` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `iteracoes` int(11) NOT NULL,
  `passwd` char(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `salt` char(32) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_tipo` bigint(20) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `usuario_id_uindex` (`id`),
  UNIQUE KEY `usuario_login_uindex` (`login`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuario`
--

LOCK TABLES `usuario` WRITE;
/*!40000 ALTER TABLE `usuario` DISABLE KEYS */;
INSERT INTO `usuario` VALUES (3,'bruno','Bruno','Rezende Laranjeira',0,'','',1),(9,'camila','Camila','Moraes Chagas',50000,'9b27920acf98aec143799b410770b3d7b68961f792f7e94fa28e0c9c6a668a0d','éN¡ºQË1!±¶+*æ8PKMá=OàD',1);
/*!40000 ALTER TABLE `usuario` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2017-12-22 19:27:00
