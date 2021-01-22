# ************************************************************
# Sequel Pro SQL dump
# Version 5446
#
# https://www.sequelpro.com/
# https://github.com/sequelpro/sequelpro
#
# Host: localhost (MySQL 8.0.19)
# Database: impacto
# Generation Time: 2021-01-22 21:28:31 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
SET NAMES utf8mb4;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table adm_users
# ------------------------------------------------------------

DROP TABLE IF EXISTS `adm_users`;

CREATE TABLE `adm_users` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(32) DEFAULT NULL,
  `data_cadastro` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `adm_users` WRITE;
/*!40000 ALTER TABLE `adm_users` DISABLE KEYS */;

INSERT INTO `adm_users` (`id`, `name`, `email`, `password`, `data_cadastro`)
VALUES
	(1,'Administrador','kakko@monkeybranch.dev','bd5af7cd922fd2603be4ee3dc43b0b77','2021-01-07 11:35:35');

/*!40000 ALTER TABLE `adm_users` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table client_address
# ------------------------------------------------------------

DROP TABLE IF EXISTS `client_address`;

CREATE TABLE `client_address` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `client_id` int DEFAULT NULL,
  `cep` varchar(10) DEFAULT NULL,
  `street` varchar(100) DEFAULT '',
  `address_number` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `complement` varchar(255) DEFAULT NULL,
  `neighborhood` varchar(255) DEFAULT NULL,
  `state_id` int DEFAULT NULL,
  `city_id` int DEFAULT NULL,
  `data_cadastro` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `client_address` WRITE;
/*!40000 ALTER TABLE `client_address` DISABLE KEYS */;

INSERT INTO `client_address` (`id`, `client_id`, `cep`, `street`, `address_number`, `complement`, `neighborhood`, `state_id`, `city_id`, `data_cadastro`)
VALUES
	(10,23,'88000000','Av. Atlântica','3220','Em Frente à praia','Centro',24,4568,'2021-01-13 11:51:44'),
	(11,23,'88345541','Av. Osvaldo Reis','3220','Sala 2001','Praia Brava',24,4573,'2021-01-13 11:52:09');

/*!40000 ALTER TABLE `client_address` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table clients
# ------------------------------------------------------------

DROP TABLE IF EXISTS `clients`;

CREATE TABLE `clients` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `surname` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `cpf_cnpj` varchar(100) DEFAULT NULL,
  `phone` varchar(32) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(32) DEFAULT NULL,
  `chosen_cep` int DEFAULT NULL,
  `data_cadastro` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `clients` WRITE;
/*!40000 ALTER TABLE `clients` DISABLE KEYS */;

INSERT INTO `clients` (`id`, `name`, `surname`, `cpf_cnpj`, `phone`, `email`, `password`, `chosen_cep`, `data_cadastro`)
VALUES
	(18,'Antonio ',NULL,NULL,NULL,'kakko@monkeybranch.dev','202cb962ac59075b964b07152d234b70',NULL,'2021-01-08 17:57:50'),
	(21,'Pirakids',NULL,NULL,NULL,'2','eccbc87e4b5ce2fe28308fd9f2a7baf3',NULL,'2021-01-11 12:23:42'),
	(22,'Pirakids',NULL,NULL,NULL,'2','eccbc87e4b5ce2fe28308fd9f2a7baf3',NULL,'2021-01-11 12:23:43'),
	(23,'Teste','Fulano 2','000.000.000.01','(47) 9999-9999','teste@teste.com.br','202cb962ac59075b964b07152d234b70',88345541,'2021-01-11 14:55:14');

/*!40000 ALTER TABLE `clients` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table estados
# ------------------------------------------------------------

DROP TABLE IF EXISTS `estados`;

CREATE TABLE `estados` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `estado` varchar(50) DEFAULT NULL,
  `uf` char(2) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `estados` WRITE;
/*!40000 ALTER TABLE `estados` DISABLE KEYS */;

INSERT INTO `estados` (`id`, `estado`, `uf`)
VALUES
	(1,'Acre','AC'),
	(2,'Alagoas','AL'),
	(3,'Amapá','AP'),
	(4,'Amazonas','AM'),
	(5,'Bahia','BA'),
	(6,'Ceará','CE'),
	(7,'Distrito Federal','DF'),
	(8,'Espírito Santo','ES'),
	(9,'Goiás','GO'),
	(10,'Maranhão','MA'),
	(11,'Mato Grosso','MT'),
	(12,'Mato Grosso do Sul','MS'),
	(13,'Minas Gerais','MG'),
	(14,'Pará','PA'),
	(15,'Paraíba','PB'),
	(16,'Paraná','PR'),
	(17,'Pernambuco','PE'),
	(18,'Piauí','PI'),
	(19,'Rio de Janeiro','RJ'),
	(20,'Rio Grande do Norte','RN'),
	(21,'Rio Grande do Sul','RS'),
	(22,'Rondônia','RO'),
	(23,'Roraima','RR'),
	(24,'Santa Catarina','SC'),
	(25,'São Paulo','SP'),
	(26,'Sergipe','SE'),
	(27,'Tocantins','TO');

/*!40000 ALTER TABLE `estados` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table guest_user
# ------------------------------------------------------------

DROP TABLE IF EXISTS `guest_user`;

CREATE TABLE `guest_user` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `guest_user_id` varchar(32) DEFAULT NULL,
  `registered_user_id` int DEFAULT NULL,
  `itens_on_cart` varchar(255) DEFAULT NULL,
  `data_cadastro` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table product_author
# ------------------------------------------------------------

DROP TABLE IF EXISTS `product_author`;

CREATE TABLE `product_author` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `data_cadastro` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `product_author` WRITE;
/*!40000 ALTER TABLE `product_author` DISABLE KEYS */;

INSERT INTO `product_author` (`id`, `name`, `data_cadastro`)
VALUES
	(1,'Anatoile','2021-01-07 11:39:01'),
	(3,'Markus Zusak','2021-01-13 11:59:15'),
	(4,'David Niven','2021-01-13 12:03:24'),
	(5,'Kazuo Ishiguro','2021-01-13 12:04:46'),
	(6,'Raphael Montes','2021-01-13 12:07:57'),
	(7,'J. L. Willow','2021-01-13 12:18:42');

/*!40000 ALTER TABLE `product_author` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table product_categories
# ------------------------------------------------------------

DROP TABLE IF EXISTS `product_categories`;

CREATE TABLE `product_categories` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `category_name` varchar(100) NOT NULL DEFAULT '',
  `data_cadastro` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `product_categories` WRITE;
/*!40000 ALTER TABLE `product_categories` DISABLE KEYS */;

INSERT INTO `product_categories` (`id`, `category_name`, `data_cadastro`)
VALUES
	(1,'Infantil','2021-01-07 11:39:09'),
	(2,'Educativo','2021-01-07 11:39:15'),
	(3,'Infanto Juvenil','2021-01-07 11:39:22'),
	(4,'Ficção','2021-01-07 11:39:30'),
	(5,'Romance','2021-01-07 11:39:34');

/*!40000 ALTER TABLE `product_categories` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table product_details
# ------------------------------------------------------------

DROP TABLE IF EXISTS `product_details`;

CREATE TABLE `product_details` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `product_id` int DEFAULT NULL,
  `edition_number` varchar(50) DEFAULT NULL,
  `edition_year` varchar(50) DEFAULT NULL,
  `language` varchar(100) DEFAULT NULL,
  `width` int DEFAULT NULL,
  `height` int DEFAULT NULL,
  `weight` decimal(4,3) DEFAULT NULL,
  `number_pages` int DEFAULT NULL,
  `description` text,
  `amazon_link` varchar(255) DEFAULT NULL,
  `google_link` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `product_details` WRITE;
/*!40000 ALTER TABLE `product_details` DISABLE KEYS */;

INSERT INTO `product_details` (`id`, `product_id`, `edition_number`, `edition_year`, `language`, `width`, `height`, `weight`, `number_pages`, `description`, `amazon_link`, `google_link`)
VALUES
	(1,1,'1','2021','Inglês',100,200,0.100,100,'Teste Livro 1','https://amazon.com',''),
	(3,3,'1','2020','Português',100,200,0.200,100,'Teste Capa tamanho pequeno','',''),
	(4,4,'1','2018','Português',100,200,0.150,300,'-','',''),
	(5,5,'3','1998','Português',100,200,0.150,100,'--','',''),
	(6,6,'1','2010','Inglês',100,200,0.030,150,'Book written in english','','');

/*!40000 ALTER TABLE `product_details` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table product_images
# ------------------------------------------------------------

DROP TABLE IF EXISTS `product_images`;

CREATE TABLE `product_images` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `product_id` int DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL,
  `capa` char(10) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `data_cadastro` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `product_images` WRITE;
/*!40000 ALTER TABLE `product_images` DISABLE KEYS */;

INSERT INTO `product_images` (`id`, `product_id`, `url`, `capa`, `data_cadastro`)
VALUES
	(1,1,'29ceda3a6793c4efbe12e7a326c5f072.jpg','1','2021-01-07 11:40:27'),
	(2,1,'fc3c5889af7f3ecbb39492028cbcdb8d.jpg','0','2021-01-07 12:06:25'),
	(3,3,'3bdeae013e2395255b8c30880d1c1fed.jpg','1','2021-01-13 12:04:00'),
	(4,4,'810a8dbbb3ded30266079ea1751a426d.jpg','1','2021-01-13 12:06:30'),
	(5,5,'7d5d76b67ec68b3f3347477793a4a62b.jpg','1','2021-01-13 12:08:35'),
	(6,6,'cb2a5c0b74998676a4843e4d09ff6fd5.jpg','1','2021-01-13 12:19:29');

/*!40000 ALTER TABLE `product_images` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table products
# ------------------------------------------------------------

DROP TABLE IF EXISTS `products`;

CREATE TABLE `products` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `price` float(15,2) DEFAULT NULL,
  `has_discount` char(3) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `discount` int DEFAULT NULL,
  `author` int DEFAULT NULL,
  `category` int DEFAULT NULL,
  `amount` int DEFAULT NULL,
  `type` varchar(100) DEFAULT NULL,
  `data_cadastro` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `products` WRITE;
/*!40000 ALTER TABLE `products` DISABLE KEYS */;

INSERT INTO `products` (`id`, `name`, `price`, `has_discount`, `discount`, `author`, `category`, `amount`, `type`, `data_cadastro`)
VALUES
	(1,'Livro de Teste 1',300.00,'Sim',10,1,2,100,'Livro','2021-01-08 16:33:02'),
	(3,'100 Segredos das Pessoas Felizes',15.00,'Sim',10,4,4,3,'Livro','2021-01-13 12:21:57'),
	(4,'A Menina que Roubava Livros',75.00,'Não',0,3,5,1,'Livro','2021-01-13 12:06:30'),
	(5,'O Vilarejo',120.00,'Não',0,6,4,25,'Livro','2021-01-13 12:08:35'),
	(6,'The Scavenger',60.00,'Não',0,7,4,15,'Livro','2021-01-18 18:06:27');

/*!40000 ALTER TABLE `products` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table user_cart
# ------------------------------------------------------------

DROP TABLE IF EXISTS `user_cart`;

CREATE TABLE `user_cart` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int DEFAULT NULL,
  `product_id` int DEFAULT NULL,
  `qtd` int DEFAULT NULL,
  `data_cadastro` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `user_cart` WRITE;
/*!40000 ALTER TABLE `user_cart` DISABLE KEYS */;

INSERT INTO `user_cart` (`id`, `user_id`, `product_id`, `qtd`, `data_cadastro`)
VALUES
	(5,23,6,1,'2021-01-15 11:51:07'),
	(6,23,5,1,'2021-01-15 11:51:07'),
	(7,23,4,4,'2021-01-15 11:51:07'),
	(8,23,3,2,'2021-01-15 11:51:07');

/*!40000 ALTER TABLE `user_cart` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table user_purchase
# ------------------------------------------------------------

DROP TABLE IF EXISTS `user_purchase`;

CREATE TABLE `user_purchase` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int DEFAULT NULL,
  `user_cep` int DEFAULT NULL COMMENT '0 = N / 1 = S',
  `purchase_value` float(15,2) DEFAULT NULL,
  `approved` char(1) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `data_cadastro` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `user_purchase` WRITE;
/*!40000 ALTER TABLE `user_purchase` DISABLE KEYS */;

INSERT INTO `user_purchase` (`id`, `user_id`, `user_cep`, `purchase_value`, `approved`, `data_cadastro`)
VALUES
	(1,23,88345541,528.00,'N','2021-01-22 14:06:04');

/*!40000 ALTER TABLE `user_purchase` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
