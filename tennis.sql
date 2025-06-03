<<<<<<< HEAD
CREATE DATABASE  IF NOT EXISTS `tennis2` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `tennis2`;
-- MySQL dump 10.13  Distrib 8.0.41, for Win64 (x86_64)
--
-- Host: localhost    Database: tennis2
-- ------------------------------------------------------
-- Server version	8.0.41

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
-- Table structure for table `codigos`
--

DROP TABLE IF EXISTS `codigos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `codigos` (
  `codigo` int NOT NULL COMMENT 'codigo de barras',
  PRIMARY KEY (`codigo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci COMMENT='tabla de codigos';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `codigos`
--

LOCK TABLES `codigos` WRITE;
/*!40000 ALTER TABLE `codigos` DISABLE KEYS */;
INSERT INTO `codigos` VALUES (2001),(2002),(2003),(2004),(2005);
/*!40000 ALTER TABLE `codigos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `productos`
--

DROP TABLE IF EXISTS `productos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `productos` (
  `id_productos` int NOT NULL COMMENT 'identificador de producto',
  `nombre_producto` varchar(30) DEFAULT NULL COMMENT 'nombre del producto',
  `marca_producto` varchar(40) DEFAULT NULL COMMENT 'marca del producto',
  `precio_producto` decimal(7,2) NOT NULL,
  `stock_del_producto` int DEFAULT NULL COMMENT 'el stock de los productos',
  `descripcion_producto` text COMMENT 'descripcion del producto',
  `imagen_producto` varchar(255) DEFAULT NULL COMMENT 'URL de la imagen',
  `fecha_creacion_producto` date DEFAULT NULL COMMENT 'fecha creacion del producto',
  PRIMARY KEY (`id_productos`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci COMMENT='Tabla de productos';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `productos`
--

LOCK TABLES `productos` WRITE;
/*!40000 ALTER TABLE `productos` DISABLE KEYS */;
INSERT INTO `productos` VALUES (1,'Nike Air Zoom','Nike',2499.90,15,'Tenis deportivos de alto rendimiento','https://example.com/nike_air_zoom.jpg','2025-03-05'),(2,'Adidas Ultraboost','Adidas',2299.50,20,'Comodidad y estilo para correr','https://example.com/adidas_ultraboost.jpg','2025-03-05'),(3,'Puma RS-X','Puma',1799.90,10,'Diseño moderno y gran amortiguación','https://example.com/puma_rsx.jpg','2025-03-05'),(4,'New Balance Fresh Foam','New Balance',1999.90,12,'Tenis ideales para largas distancias','https://example.com/newbalance_freshfoam.jpg','2025-03-05'),(5,'Reebok Floatride','Reebok',159.90,18,'Ligereza y resistencia para entrenamientos','https://example.com/reebok_floatride.jpg','2025-03-05');
/*!40000 ALTER TABLE `productos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tallas`
--

DROP TABLE IF EXISTS `tallas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tallas` (
  `id_talla` int NOT NULL COMMENT 'id de las tallas',
  `talla` decimal(4,1) DEFAULT NULL COMMENT 'talla del producto',
  `id_productos` int NOT NULL,
  `codigo` int NOT NULL,
  PRIMARY KEY (`id_talla`),
  KEY `tallas_codigos_FK` (`codigo`),
  KEY `tallas_productos_FK` (`id_productos`),
  CONSTRAINT `tallas_codigos_FK` FOREIGN KEY (`codigo`) REFERENCES `codigos` (`codigo`),
  CONSTRAINT `tallas_productos_FK` FOREIGN KEY (`id_productos`) REFERENCES `productos` (`id_productos`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci COMMENT='Tabla de tallas';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tallas`
--

LOCK TABLES `tallas` WRITE;
/*!40000 ALTER TABLE `tallas` DISABLE KEYS */;
INSERT INTO `tallas` VALUES (1,7.5,1,2001),(2,8.0,2,2002),(3,8.5,3,2003),(4,9.0,4,2004),(5,10.0,5,2005);
/*!40000 ALTER TABLE `tallas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `usuarios` (
  `id_usuarios` int NOT NULL AUTO_INCREMENT COMMENT 'identificador de usuario',
  `nombre_usuario` varchar(100) DEFAULT NULL COMMENT 'nombre del usuario',
  `email_usuario` varchar(100) DEFAULT NULL COMMENT 'email de usuario',
  `password_usuario` varchar(20) DEFAULT NULL COMMENT 'contraseña para el usuario',
  `fecha_registro_usuario` date DEFAULT NULL COMMENT 'fecha de registro del usuario',
  `tipo_usuario` char(1) DEFAULT 'E' COMMENT 'tipo de usuario, empleado o administrador',
  PRIMARY KEY (`id_usuarios`),
  CONSTRAINT `usuarios_chk_1` CHECK ((`tipo_usuario` in (_utf8mb4'A',_utf8mb4'E')))
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci COMMENT='Esta es la tabla de usuarios';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuarios`
--

LOCK TABLES `usuarios` WRITE;
/*!40000 ALTER TABLE `usuarios` DISABLE KEYS */;
INSERT INTO `usuarios` VALUES (1,'Mario Sierra','mario@example.com','pass1234','2025-03-05','A'),(2,'Luis Pérez','luis@example.com','luispass','2025-03-05','E'),(3,'Ana Gómez','ana@example.com','anasegura','2025-03-05','A'),(4,'Carlos Ruiz','carlos@example.com','carlospass','2025-03-05','E'),(5,'Elena Torres','elena@example.com','torrespass','2025-03-05','A'),(6,'MarioD','smariodael@gmail.com','17101710',NULL,'E'),(7,'dael','dael@example.com','pass1234',NULL,'E');
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

-- Dump completed on 2025-05-06 19:47:00
=======
CREATE DATABASE  IF NOT EXISTS `tennis2` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `tennis2`;
-- MySQL dump 10.13  Distrib 8.0.41, for Win64 (x86_64)
--
-- Host: localhost    Database: tennis2
-- ------------------------------------------------------
-- Server version	8.0.41

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
-- Table structure for table `codigos`
--

DROP TABLE IF EXISTS `codigos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `codigos` (
  `codigo` int NOT NULL COMMENT 'codigo de barras',
  PRIMARY KEY (`codigo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci COMMENT='tabla de codigos';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `codigos`
--

LOCK TABLES `codigos` WRITE;
/*!40000 ALTER TABLE `codigos` DISABLE KEYS */;
INSERT INTO `codigos` VALUES (2001),(2002),(2003),(2004),(2005);
/*!40000 ALTER TABLE `codigos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `productos`
--

DROP TABLE IF EXISTS `productos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `productos` (
  `id_productos` int NOT NULL COMMENT 'identificador de producto',
  `nombre_producto` varchar(30) DEFAULT NULL COMMENT 'nombre del producto',
  `marca_producto` varchar(40) DEFAULT NULL COMMENT 'marca del producto',
  `precio_producto` decimal(7,2) NOT NULL,
  `stock_del_producto` int DEFAULT NULL COMMENT 'el stock de los productos',
  `descripcion_producto` text COMMENT 'descripcion del producto',
  `imagen_producto` varchar(255) DEFAULT NULL COMMENT 'URL de la imagen',
  `fecha_creacion_producto` date DEFAULT NULL COMMENT 'fecha creacion del producto',
  PRIMARY KEY (`id_productos`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci COMMENT='Tabla de productos';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `productos`
--

LOCK TABLES `productos` WRITE;
/*!40000 ALTER TABLE `productos` DISABLE KEYS */;
INSERT INTO `productos` VALUES (1,'Nike Air Zoom','Nike',2499.90,15,'Tenis deportivos de alto rendimiento','https://example.com/nike_air_zoom.jpg','2025-03-05'),(2,'Adidas Ultraboost','Adidas',2299.50,20,'Comodidad y estilo para correr','https://example.com/adidas_ultraboost.jpg','2025-03-05'),(3,'Puma RS-X','Puma',1799.90,10,'Diseño moderno y gran amortiguación','https://example.com/puma_rsx.jpg','2025-03-05'),(4,'New Balance Fresh Foam','New Balance',1999.90,12,'Tenis ideales para largas distancias','https://example.com/newbalance_freshfoam.jpg','2025-03-05'),(5,'Reebok Floatride','Reebok',159.90,18,'Ligereza y resistencia para entrenamientos','https://example.com/reebok_floatride.jpg','2025-03-05');
/*!40000 ALTER TABLE `productos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tallas`
--

DROP TABLE IF EXISTS `tallas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tallas` (
  `id_talla` int NOT NULL COMMENT 'id de las tallas',
  `talla` decimal(4,1) DEFAULT NULL COMMENT 'talla del producto',
  `id_productos` int NOT NULL,
  `codigo` int NOT NULL,
  PRIMARY KEY (`id_talla`),
  KEY `tallas_codigos_FK` (`codigo`),
  KEY `tallas_productos_FK` (`id_productos`),
  CONSTRAINT `tallas_codigos_FK` FOREIGN KEY (`codigo`) REFERENCES `codigos` (`codigo`),
  CONSTRAINT `tallas_productos_FK` FOREIGN KEY (`id_productos`) REFERENCES `productos` (`id_productos`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci COMMENT='Tabla de tallas';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tallas`
--

LOCK TABLES `tallas` WRITE;
/*!40000 ALTER TABLE `tallas` DISABLE KEYS */;
INSERT INTO `tallas` VALUES (1,7.5,1,2001),(2,8.0,2,2002),(3,8.5,3,2003),(4,9.0,4,2004),(5,10.0,5,2005);
/*!40000 ALTER TABLE `tallas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `usuarios` (
  `id_usuarios` int NOT NULL AUTO_INCREMENT COMMENT 'identificador de usuario',
  `nombre_usuario` varchar(100) DEFAULT NULL COMMENT 'nombre del usuario',
  `email_usuario` varchar(100) DEFAULT NULL COMMENT 'email de usuario',
  `password_usuario` varchar(20) DEFAULT NULL COMMENT 'contraseña para el usuario',
  `fecha_registro_usuario` date DEFAULT NULL COMMENT 'fecha de registro del usuario',
  `tipo_usuario` char(1) DEFAULT 'E' COMMENT 'tipo de usuario, empleado o administrador',
  PRIMARY KEY (`id_usuarios`),
  CONSTRAINT `usuarios_chk_1` CHECK ((`tipo_usuario` in (_utf8mb4'A',_utf8mb4'E')))
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci COMMENT='Esta es la tabla de usuarios';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuarios`
--

LOCK TABLES `usuarios` WRITE;
/*!40000 ALTER TABLE `usuarios` DISABLE KEYS */;
INSERT INTO `usuarios` VALUES (1,'Mario Sierra','mario@example.com','pass1234','2025-03-05','A'),(2,'Luis Pérez','luis@example.com','luispass','2025-03-05','E'),(3,'Ana Gómez','ana@example.com','anasegura','2025-03-05','A'),(4,'Carlos Ruiz','carlos@example.com','carlospass','2025-03-05','E'),(5,'Elena Torres','elena@example.com','torrespass','2025-03-05','A'),(6,'MarioD','smariodael@gmail.com','17101710',NULL,'E'),(7,'dael','dael@example.com','pass1234',NULL,'E');
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

-- Dump completed on 2025-05-06 19:47:00
>>>>>>> 6e6044f0db3f2e69cd53519e0f16e656b79f9463
