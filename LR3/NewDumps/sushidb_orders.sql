-- MySQL dump 10.13  Distrib 8.0.34, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: sushidb
-- ------------------------------------------------------
-- Server version	8.0.34

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
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `orders` (
  `ID` int NOT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `personal_info` varchar(150) DEFAULT NULL,
  `trade_outlet` int unsigned NOT NULL,
  `content` text NOT NULL,
  `cost` int unsigned NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `trade_outlet_idx` (`trade_outlet`),
  CONSTRAINT `trade_outlet` FOREIGN KEY (`trade_outlet`) REFERENCES `trade_outlets` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `orders`
--

LOCK TABLES `orders` WRITE;
/*!40000 ALTER TABLE `orders` DISABLE KEYS */;
INSERT INTO `orders` VALUES (1,'Звезда Давида','Абраам',3,'Крапива)',500),(2,'Шеренга','Поручик Ржевский',2,'Рыбка)',250),(3,'Чёрная братия','Чунга и Чанга',1,'Зелень)',180),(4,'Сладкая парочка','Стася и Нася Сладкины ',4,'Сахар)',210),(5,'Будьте здоровы)','Сахира',7,'Апчхи',340),(6,'The Beatles','Джон, Пол, Джордж, Ринго',8,'Кайф)',400),(7,'Одинокий волк','Абу',9,'Ауф',150),(8,'3 косяка','Биба, Боба, Бимо',5,'Водоросли',330),(9,'Гороскоп любви','Александр Жигало',1,'Весы',100),(10,'Роллы 34','Андроник',2,'Роллы',140),(11,'Суши 34','Гарик',5,'Суши',139),(12,'Суши роллы 34','Армен',6,'Суши и роллы',141),(13,'Роллы суши 34','Гиви',8,'Роллы и суши',140),(14,'СЮДА','Виталий Цаль',2,'Хлебцы)',280),(15,'Спасти рядового Чангу','Капитан Чунга',4,'Бананы)',140),(16,'Каратисты','Тренер Елевен',7,'Рис)',290),(17,'Корицы','Диана',9,'Булочки)',340),(18,'Крутыши','Саманта',4,'Специи)',320),(19,'Рискованные','Пацаны',5,'Сигареты',228),(20,'Комплименты повару','Алексей',6,'Комплименты',470);
/*!40000 ALTER TABLE `orders` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2023-10-24 11:35:19
