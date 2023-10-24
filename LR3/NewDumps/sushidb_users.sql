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
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `login` varchar(50) NOT NULL,
  `password` varchar(200) NOT NULL,
  `fio` varchar(80) NOT NULL,
  `dateOfBirth` datetime DEFAULT NULL,
  `address` varchar(70) DEFAULT NULL,
  `hobbies` varchar(45) DEFAULT NULL,
  `url` varchar(60) DEFAULT NULL,
  `rezus` varchar(30) DEFAULT NULL,
  `bloodtype` varchar(25) DEFAULT NULL,
  `sex` varchar(1) DEFAULT NULL,
  PRIMARY KEY (`login`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES ('admin@mail.ru','$2y$10$xL6ZftzrbpO/MA1ihklEYOmjznDBIOWIj.KyEsCduO9seWrkIdt6y','Сержант Пеппер','1967-05-26 00:00:00','Ливерпуль','Классика рока',NULL,'Крут','Кайф','M'),('AnotherUser@mail.ru','$2y$10$nM5tbWfM7Q5xg3c4kx8DeOwDpyjCPH44hS6sAfDd1Au.D.Fcnpg7O','Новенькая','2023-10-14 00:00:00',NULL,NULL,NULL,NULL,'Молодая','F'),('AnotherUsers@mail.ru','$2y$10$tKyCC5oE89utS4upvKfc2uuBsRbkMm8Ka8sUicJACwRdo859UgjtW','Молодые Крашихи','2023-08-11 00:00:00',NULL,NULL,NULL,'Пойдет','Группа жизни','F'),('DirectedByDebil@mail.ru','$2y$10$VUinw6I9y6zutuYv4zRIouUubEdvSFzgxlj7hwNxtcnTRJIikB.G6','Сержант Пеппер',NULL,NULL,NULL,NULL,NULL,NULL,'M'),('newUser@mail.ru','$2y$10$cmnl38STBVjW1lqBNrz.KOoRlZO7FiC2UtirIA8k0PUGLFDy6DaFK','Новенький','2023-10-04 00:00:00',NULL,NULL,NULL,NULL,NULL,'M'),('student@volsu.ru','$2y$10$DfjfC2Gq2TQqCEjLCYNa5eWhd7xxEytDpUMU9xLcQP6RbEcGZiINC','Прохвост Коромыслов','2003-08-16 00:00:00','Улица крутости','Увлекаюсь творчеством Поля Де Кока',NULL,'Основной','Основная','M'),('Test@mail.ru','$2y$10$3rETUHmKhgfsBcQf/rMCzeDb2Y2xv19YtBlBkCtrtG/jTqqnQLLuS','Проверкина',NULL,NULL,NULL,NULL,NULL,NULL,'F');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
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
