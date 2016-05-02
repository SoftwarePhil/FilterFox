-- MySQL dump 10.13  Distrib 5.5.47, for debian-linux-gnu (x86_64)
--
-- Host: 0.0.0.0    Database: filterfox
-- ------------------------------------------------------
-- Server version	5.5.47-0ubuntu0.14.04.1

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
-- Table structure for table `post`
--

DROP TABLE IF EXISTS `post`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `post` (
  `post_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `post_date` datetime NOT NULL,
  `post_content` varchar(400) NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `likes` int(11) DEFAULT '0',
  PRIMARY KEY (`post_id`),
  KEY `p_user_Id_idx` (`user_id`),
  CONSTRAINT `fk_Customer_Id` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `post`
--

LOCK TABLES `post` WRITE;
/*!40000 ALTER TABLE `post` DISABLE KEYS */;
INSERT INTO `post` VALUES (1,'2016-05-01 17:09:25','this is my first post! ',1,4),(2,'2016-05-02 16:02:56','YOOOOOOO BROOOOOO',7,6),(3,'2016-05-02 16:03:56','HEYYYY MANNN',7,1),(4,'2016-05-02 16:04:07','Brought to you by Phil',7,1),(5,'2016-05-02 16:04:16','Our SE overlord',7,1),(6,'2016-05-02 16:04:20','Paul',2,2),(7,'2016-05-02 16:05:00','real talk',12,1),(8,'2016-05-02 16:05:52','COCKAPOO',12,2),(9,'2016-05-02 16:08:21','its me, paul!!!',9,3),(10,'2016-05-02 16:08:54','I will be late to class',13,6);
/*!40000 ALTER TABLE `post` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `post_comment`
--

DROP TABLE IF EXISTS `post_comment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `post_comment` (
  `comment_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `post_id` int(10) unsigned NOT NULL,
  `comment_content` varchar(400) NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `date` datetime DEFAULT NULL,
  PRIMARY KEY (`comment_id`),
  KEY `fk_Order_Id_idx` (`post_id`),
  KEY `fk_user_id_post` (`user_id`),
  CONSTRAINT `fk_post_id` FOREIGN KEY (`post_id`) REFERENCES `post` (`post_id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  CONSTRAINT `fk_user_id` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `post_comment`
--

LOCK TABLES `post_comment` WRITE;
/*!40000 ALTER TABLE `post_comment` DISABLE KEYS */;
INSERT INTO `post_comment` VALUES (1,1,'here is a comment!',1,'2016-05-01 17:10:32'),(2,2,'cool post bro',1,'2016-05-02 16:05:00'),(3,10,'hey',1,'2016-05-02 16:11:48');
/*!40000 ALTER TABLE `post_comment` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `post_like`
--

DROP TABLE IF EXISTS `post_like`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `post_like` (
  `user_id` int(10) unsigned NOT NULL,
  `post_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`user_id`,`post_id`),
  KEY `likes_post_id_idx` (`post_id`),
  KEY `likes_user_idx` (`user_id`),
  CONSTRAINT `likes_post_id` FOREIGN KEY (`post_id`) REFERENCES `post` (`post_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `likes_user` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `post_like`
--

LOCK TABLES `post_like` WRITE;
/*!40000 ALTER TABLE `post_like` DISABLE KEYS */;
INSERT INTO `post_like` VALUES (2,1),(3,1),(5,1),(11,1),(1,2),(2,2),(3,2),(7,2),(8,2),(11,2),(2,3),(2,4),(2,5),(7,6),(11,6),(11,7),(7,8),(11,8),(2,9),(7,9),(11,9),(1,10),(2,10),(7,10),(9,10),(11,10),(13,10);
/*!40000 ALTER TABLE `post_like` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `post_view`
--

DROP TABLE IF EXISTS `post_view`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `post_view` (
  `user_id` int(10) unsigned NOT NULL,
  `post_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`user_id`,`post_id`),
  KEY `view_post_id_idx` (`post_id`),
  CONSTRAINT `view_post_id` FOREIGN KEY (`post_id`) REFERENCES `post` (`post_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `view_user_id` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `post_view`
--

LOCK TABLES `post_view` WRITE;
/*!40000 ALTER TABLE `post_view` DISABLE KEYS */;
INSERT INTO `post_view` VALUES (1,1),(2,1),(3,1),(5,1),(7,1),(8,1),(9,1),(10,1),(11,1),(12,1),(13,1),(1,2),(2,2),(3,2),(5,2),(7,2),(8,2),(9,2),(11,2),(12,2),(13,2),(1,3),(2,3),(3,3),(5,3),(7,3),(8,3),(9,3),(11,3),(12,3),(13,3),(1,4),(2,4),(3,4),(5,4),(7,4),(8,4),(9,4),(11,4),(12,4),(13,4),(1,5),(2,5),(3,5),(5,5),(7,5),(8,5),(9,5),(11,5),(12,5),(13,5),(1,6),(2,6),(3,6),(5,6),(7,6),(8,6),(9,6),(11,6),(12,6),(13,6),(1,7),(2,7),(3,7),(5,7),(7,7),(8,7),(9,7),(11,7),(12,7),(13,7),(1,8),(2,8),(3,8),(7,8),(8,8),(9,8),(11,8),(12,8),(13,8),(1,9),(2,9),(7,9),(9,9),(11,9),(13,9),(1,10),(2,10),(7,10),(9,10),(11,10),(13,10);
/*!40000 ALTER TABLE `post_view` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user` (
  `user_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  `bio` text,
  `photo` varchar(450) DEFAULT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (1,'Phil DiMarco','I made this website','https://filterfox-softwarephil.c9users.io/profile_photos/1.jpg'),(2,'Grady','Paul loves garlic',NULL),(3,'taylor',NULL,NULL),(4,'Joao','HEy',NULL),(5,'Drudacris','Ball is life yo','https://filterfox-softwarephil.c9users.io/profile_photos/5.jpg'),(6,'Tejal Desh',NULL,NULL),(7,'nicemayn','NICEMAYN','https://filterfox-softwarephil.c9users.io/profile_photos/7.jpg'),(8,'Vinicius',NULL,NULL),(9,'person',NULL,'https://filterfox-softwarephil.c9users.io/profile_photos/9.jpg'),(10,'RL',NULL,NULL),(11,'Mary','Hello, this is Mary!','https://filterfox-softwarephil.c9users.io/profile_photos/11.jpg'),(12,'pete','hello','https://filterfox-softwarephil.c9users.io/profile_photos/12.jpg'),(13,'The Real Rosca',NULL,'https://filterfox-softwarephil.c9users.io/profile_photos/13.jpg');
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_access`
--

DROP TABLE IF EXISTS `user_access`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_access` (
  `user_id` int(10) unsigned DEFAULT NULL,
  `email` varchar(45) NOT NULL,
  `password` varchar(18) DEFAULT NULL,
  PRIMARY KEY (`email`),
  KEY `fk_user_id_a` (`user_id`),
  CONSTRAINT `fk_user_id_a` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_access`
--

LOCK TABLES `user_access` WRITE;
/*!40000 ALTER TABLE `user_access` DISABLE KEYS */;
INSERT INTO `user_access` VALUES (5,'drewfuss','lololol'),(2,'gjenkins205@gmail.com','grady'),(4,'joao@gmail.com','123'),(11,'maryfatimma','love'),(7,'nicemayn@gmail.com','eyy'),(9,'person','1234'),(12,'pete','pete'),(1,'phil','iamgreat1'),(10,'raman.l@monmouth.edu','belmar5'),(13,'rosca','123'),(3,'s0912276@monmouth.edu','Orange123'),(8,'s1088749@monmouth.edu','19101992'),(6,'tejal@test.com','test');
/*!40000 ALTER TABLE `user_access` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2016-05-02 16:30:18
