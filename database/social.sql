-- MySQL dump 10.13  Distrib 5.5.43, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: social
-- ------------------------------------------------------
-- Server version	5.5.43-0ubuntu0.14.04.1

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
-- Table structure for table `friends_req`
--

DROP TABLE IF EXISTS `friends_req`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `friends_req` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sender_id` int(11) NOT NULL,
  `recever_id` int(11) NOT NULL,
  `req_status` varchar(50) DEFAULT NULL,
  `date_req` date NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sender_id` (`sender_id`),
  KEY `recever_id` (`recever_id`),
  CONSTRAINT `friends_req_ibfk_1` FOREIGN KEY (`sender_id`) REFERENCES `users` (`id`),
  CONSTRAINT `friends_req_ibfk_2` FOREIGN KEY (`recever_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=101 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `friends_req`
--

LOCK TABLES `friends_req` WRITE;
/*!40000 ALTER TABLE `friends_req` DISABLE KEYS */;
INSERT INTO `friends_req` VALUES (84,1,2,'accept','2015-06-09'),(86,6,2,'accept','2015-06-10'),(89,6,1,'accept','2015-06-12'),(94,2,3,'sending','2015-06-13'),(100,1,3,'sending','2015-06-18');
/*!40000 ALTER TABLE `friends_req` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `posts`
--

DROP TABLE IF EXISTS `posts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `posts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `post` text,
  `upload` varchar(255) DEFAULT NULL,
  `date` datetime NOT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `posts_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `posts`
--

LOCK TABLES `posts` WRITE;
/*!40000 ALTER TABLE `posts` DISABLE KEYS */;
INSERT INTO `posts` VALUES (5,' wellllllllllllllll','uploads/11182290_372800449577723_3757423711135189622_n.jpg','2015-05-19 06:17:44',1),(6,NULL,'uploads/t.jpg','2015-05-19 06:22:10',1),(7,' done :D i do it ','uploads/11148637_400362580156023_2851501333689130652_n.jpg','2015-05-19 08:13:33',1),(8,' i study with eman abo muslm :D\r\n','uploads/10653811_1558111667741804_6101728659317745813_n.jpg','2015-05-20 02:27:46',1),(9,' ready for exam','uploads/1.jpg','2015-05-29 08:16:38',1),(10,NULL,'uploads/2.jpg','2015-05-29 08:22:15',1),(11,' exam time ','uploads/11174935_1576810175904199_157568966832918945_n.jpg','2015-05-29 10:15:11',1),(12,' i am happy ','uploads/11348837_1614020658837394_1160996994_n.jpg','2015-06-09 08:19:26',1),(13,' i am happy as i have more friends :D ','uploads/10405624_717881628329132_1273774073936429281_n.jpg','2015-06-10 03:03:58',2),(14,' i hate conflict ','uploads/11537700_863101647144559_989432304612339378_n.png','2015-06-20 10:54:04',1),(15,'1','uploads/11407017_1644583239106648_3494594320394985585_n.jpg','2015-06-21 12:54:17',1),(16,' hhhhhhhhhhhhhhhhhh','uploads/11181203_1698825077012351_45634177294718056_n.jpg','2015-06-21 01:10:32',1),(17,' gggggggggggggggggggggggggg','uploads/','2015-06-21 01:18:03',1);
/*!40000 ALTER TABLE `posts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `email` varchar(70) NOT NULL,
  `password` varchar(255) NOT NULL,
  `gender` varchar(6) NOT NULL,
  `birthday` date NOT NULL,
  `country` varchar(50) NOT NULL,
  `photo` varchar(255) NOT NULL,
  `education_level` varchar(100) DEFAULT NULL,
  `role` smallint(6) NOT NULL,
  `work` varchar(100) DEFAULT NULL,
  `cover` varchar(255) NOT NULL,
  `signUP` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`,`email`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'norhan','norhan_elnezamy@yahoo.com','nour','female','1987-10-14','EG','image/1.jpg','at faculty of computers and information',1,'not work yet','image/cover.jpg',NULL),(2,'mariam','mariamelnezamy@gmail.com','m123','female','1991-10-14','EG','image/avatar.jpg',NULL,0,NULL,'image/cover.jpg',NULL),(3,'osama','osama@xyz.com','osama123','male ','1990-09-13','EG','image/avatar.jpg',NULL,0,NULL,'image/cover.jpg',NULL),(4,'nada','nada@xyz.com','nada123','female','1990-01-14','EG','image/avatar.jpg',NULL,0,NULL,'image/cover.jpg','2015-05-29 06:47:18'),(5,'yomna','yomna@gmail.com','yomna123','female','1979-09-13','FR','image/avatar.jpg',NULL,0,NULL,'image/cover.jpg','2015-05-29 06:48:18'),(6,'mahmoud','mahmoud@gmail.com','mahmoud','male ','1995-07-06','EG','image/avatar.jpg',NULL,0,NULL,'image/cover.jpg','2015-05-29 06:49:24');
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

-- Dump completed on 2015-06-21 23:59:57
