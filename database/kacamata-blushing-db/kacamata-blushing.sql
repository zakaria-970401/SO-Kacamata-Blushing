/*
SQLyog Ultimate
MySQL - 10.4.22-MariaDB : Database - kacamata-blushing
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
/*Table structure for table `auth_group` */

DROP TABLE IF EXISTS `auth_group`;

CREATE TABLE `auth_group` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `auth_group` */

insert  into `auth_group`(`id`,`name`,`created_at`,`updated_at`) values 
(1,'Super Admin',NULL,NULL),
(2,'Data Entry',NULL,NULL),
(3,'Manager',NULL,NULL);

/*Table structure for table `auth_group_permission` */

DROP TABLE IF EXISTS `auth_group_permission`;

CREATE TABLE `auth_group_permission` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `group_id` int(10) unsigned NOT NULL,
  `permission_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=50 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `auth_group_permission` */

insert  into `auth_group_permission`(`id`,`group_id`,`permission_id`,`created_at`,`updated_at`) values 
(31,3,12,'2022-09-11 20:40:47','2022-09-11 20:40:47'),
(32,1,1,'2022-09-11 20:40:55','2022-09-11 20:40:55'),
(33,1,8,'2022-09-11 20:40:55','2022-09-11 20:40:55'),
(34,1,9,'2022-09-11 20:40:55','2022-09-11 20:40:55'),
(35,1,2,'2022-09-11 20:40:55','2022-09-11 20:40:55'),
(36,1,3,'2022-09-11 20:40:55','2022-09-11 20:40:55'),
(37,1,4,'2022-09-11 20:40:55','2022-09-11 20:40:55'),
(38,1,5,'2022-09-11 20:40:55','2022-09-11 20:40:55'),
(39,1,6,'2022-09-11 20:40:55','2022-09-11 20:40:55'),
(40,1,7,'2022-09-11 20:40:55','2022-09-11 20:40:55'),
(41,1,10,'2022-09-11 20:40:55','2022-09-11 20:40:55'),
(42,1,11,'2022-09-11 20:40:55','2022-09-11 20:40:55'),
(43,1,12,'2022-09-11 20:40:55','2022-09-11 20:40:55'),
(44,2,1,'2022-09-11 20:42:17','2022-09-11 20:42:17'),
(45,2,2,'2022-09-11 20:42:17','2022-09-11 20:42:17'),
(46,2,3,'2022-09-11 20:42:17','2022-09-11 20:42:17'),
(47,2,4,'2022-09-11 20:42:17','2022-09-11 20:42:17'),
(48,2,7,'2022-09-11 20:42:17','2022-09-11 20:42:17'),
(49,2,11,'2022-09-11 20:42:17','2022-09-11 20:42:17');

/*Table structure for table `auth_permission` */

DROP TABLE IF EXISTS `auth_permission`;

CREATE TABLE `auth_permission` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `codename` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `auth_permission` */

insert  into `auth_permission`(`id`,`name`,`codename`,`created_at`,`updated_at`) values 
(1,'database-header','database-header','2022-09-11 20:28:23',NULL),
(2,'kedatangan-item','kedatangan-item','2022-09-11 20:28:35',NULL),
(3,'pengeluaran-item','pengeluaran-item','2022-09-11 20:28:41',NULL),
(4,'hasil-opname','hasil-opname','2022-09-11 20:28:53',NULL),
(5,'start-opname','start-opname','2022-09-11 20:29:00',NULL),
(6,'stop-opname','stop-opname','2022-09-11 20:29:08',NULL),
(7,'form-stok-opname','form-stok-opname','2022-09-11 20:29:31',NULL),
(8,'master-user','master-user','2022-09-11 20:31:53',NULL),
(9,'master-item','master-item','2022-09-11 20:31:58',NULL),
(10,'master-menu','master-menu','2022-09-11 20:35:57',NULL),
(11,'master-stok','master-stok','2022-09-11 20:39:02',NULL),
(12,'report','report','2022-09-11 20:40:38',NULL);

/*Table structure for table `master_item` */

DROP TABLE IF EXISTS `master_item`;

CREATE TABLE `master_item` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `frame` varchar(50) DEFAULT NULL,
  `warna` varchar(50) DEFAULT NULL,
  `harga_jual` int(11) DEFAULT NULL,
  `harga_pokok` int(11) DEFAULT NULL,
  `created_by` varchar(100) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` varchar(100) DEFAULT NULL,
  `status` int(11) DEFAULT 1,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=51 DEFAULT CHARSET=utf8mb4;

/*Data for the table `master_item` */

insert  into `master_item`(`id`,`frame`,`warna`,`harga_jual`,`harga_pokok`,`created_by`,`created_at`,`updated_at`,`updated_by`,`status`) values 
(1,'Alice','Black Gold',150000,100000,NULL,NULL,'2022-09-08 13:45:41','Ahmad Zakaria',1),
(2,'Alice','Maroon',129000,129000,NULL,NULL,NULL,NULL,1),
(3,'Americano','Black',100000,75000,NULL,NULL,NULL,NULL,1),
(4,'Amora','Black',139000,85000,NULL,NULL,NULL,NULL,1),
(5,'Amora','Rose Gold',139000,85000,NULL,NULL,NULL,NULL,1),
(6,'Arden','Black',115000,75000,NULL,NULL,NULL,NULL,1),
(7,'Arden','Rose Gold',115000,75000,NULL,NULL,NULL,NULL,1),
(8,'Athena','Black',109000,75000,NULL,NULL,NULL,NULL,1),
(9,'Athena','Rose Gold',109000,75000,NULL,NULL,NULL,NULL,1),
(10,'Boa','Gold',139000,85000,NULL,NULL,NULL,NULL,1),
(11,'Boston','Silver',159000,90000,NULL,NULL,NULL,NULL,1),
(12,'Brixton','Black',179000,90000,NULL,NULL,NULL,NULL,1),
(13,'Cairo','Black',100000,75000,NULL,NULL,NULL,NULL,1),
(14,'Carlo','Maroon',100000,75000,NULL,NULL,NULL,NULL,1),
(15,'Carlo','Black',100000,75000,NULL,NULL,NULL,NULL,1),
(16,'Daisy','Grey',100000,75000,NULL,NULL,NULL,NULL,1),
(17,'Daisy','Black',100000,75000,NULL,NULL,NULL,NULL,1),
(18,'Dakota','Maroon',110000,75000,NULL,NULL,NULL,NULL,1),
(19,'Danila','Black Gold',129000,85000,NULL,NULL,NULL,NULL,1),
(20,'Danila','Peach',129000,85000,NULL,NULL,NULL,NULL,1),
(21,'Darin','Black',100000,75000,NULL,NULL,NULL,NULL,1),
(22,'Darin','Grey',100000,75000,NULL,NULL,NULL,NULL,1),
(23,'Dario','Black',149000,90000,NULL,NULL,NULL,NULL,1),
(24,'Dazel','Leopard',139000,85000,NULL,NULL,NULL,NULL,1),
(25,'Dominic','Black Gold',110000,80000,NULL,NULL,NULL,NULL,1),
(26,'Elora','Black',159000,90000,NULL,NULL,NULL,NULL,1),
(27,'Gaudi','Transparant',139000,90000,NULL,NULL,NULL,NULL,1),
(28,'Hana','Black',125000,85000,NULL,NULL,NULL,NULL,1),
(29,'Hansel','Black',100000,80000,NULL,NULL,NULL,NULL,1),
(30,'Hayko','Black Gold',110000,80000,NULL,NULL,NULL,NULL,1),
(31,'Hugos','Black',110000,80000,NULL,NULL,NULL,NULL,1),
(32,'Jocelyn','Black',100000,80000,NULL,NULL,NULL,NULL,1),
(33,'Kennedy','Black',100000,80000,NULL,NULL,NULL,NULL,1),
(34,'Larissa','Black',109000,80000,NULL,NULL,NULL,NULL,1),
(35,'Larissa','Black Caramel',109000,80000,NULL,NULL,NULL,NULL,1),
(36,'Laura','Caramel',110000,80000,NULL,NULL,NULL,NULL,1),
(37,'Lenon','Black Silver',100000,80000,NULL,NULL,NULL,NULL,1),
(38,'Lilian','Grey',120000,85000,NULL,NULL,NULL,NULL,1),
(39,'Lindafarrow\r\n','Transparant\r\n',105000,80000,NULL,NULL,NULL,NULL,1),
(40,'Lowi','Black Rose',159000,90000,NULL,NULL,NULL,NULL,1),
(41,'Lucas','Black',179000,90000,NULL,NULL,NULL,NULL,1),
(42,'Maura','Grey',129000,85000,NULL,NULL,NULL,NULL,1),
(43,'Mecca','Grey',125000,85000,NULL,NULL,NULL,NULL,1),
(44,'Meydi','Caramel',129000,85000,NULL,NULL,NULL,NULL,1),
(45,'Nara','Caramel',139000,90000,NULL,NULL,NULL,NULL,1),
(46,'Stevia','Silver',150000,90000,NULL,NULL,NULL,NULL,1),
(47,'Uno','Grey',140000,90000,NULL,NULL,NULL,NULL,1),
(48,'Wina','Black',160000,90000,NULL,NULL,NULL,NULL,1);

/*Table structure for table `master_pengeluaran_item` */

DROP TABLE IF EXISTS `master_pengeluaran_item`;

CREATE TABLE `master_pengeluaran_item` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_item` int(11) DEFAULT NULL,
  `qty` int(11) DEFAULT NULL,
  `pariode` int(11) DEFAULT NULL,
  `created_pengeluaran_by` varchar(100) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

/*Data for the table `master_pengeluaran_item` */

insert  into `master_pengeluaran_item`(`id`,`id_item`,`qty`,`pariode`,`created_pengeluaran_by`,`created_at`) values 
(1,1,5,9,'Rindang','2022-09-11 21:19:07'),
(2,3,5,9,'Rindang','2022-09-11 21:19:07'),
(3,3,5,9,'Rindang','2022-09-11 21:32:03');

/*Table structure for table `master_stok_item` */

DROP TABLE IF EXISTS `master_stok_item`;

CREATE TABLE `master_stok_item` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_item` int(11) DEFAULT NULL,
  `stok_before` int(11) DEFAULT NULL,
  `stok_after` int(11) DEFAULT NULL,
  `count_by` varchar(100) DEFAULT NULL,
  `count_at` datetime DEFAULT NULL,
  `updated_count_by` varchar(100) DEFAULT NULL,
  `updated_count_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=50 DEFAULT CHARSET=utf8mb4;

/*Data for the table `master_stok_item` */

insert  into `master_stok_item`(`id`,`id_item`,`stok_before`,`stok_after`,`count_by`,`count_at`,`updated_count_by`,`updated_count_at`) values 
(1,1,80,75,'Ahmad Zakaria','2022-09-10 22:48:43','Rindang','2022-09-11 21:19:07'),
(2,2,90,70,'Rahma Aulia','2022-09-08 21:17:00','Rindang','2022-09-11 21:14:55'),
(3,3,85,80,'Rahma Aulia','2022-09-08 21:17:00','Rindang','2022-09-11 21:32:03'),
(4,4,90,90,'Rahma Aulia','2022-09-08 21:17:00','Rahma Aulia','2022-09-08 21:17:00'),
(5,5,90,90,'Rahma Aulia','2022-09-08 21:17:00','Rahma Aulia','2022-09-08 21:17:00'),
(6,6,90,90,'Rahma Aulia','2022-09-08 21:17:00','Rahma Aulia','2022-09-08 21:17:00'),
(7,7,90,90,'Rahma Aulia','2022-09-08 21:17:00','Rahma Aulia','2022-09-08 21:17:00'),
(8,8,90,90,'Rahma Aulia','2022-09-08 21:17:00','Rahma Aulia','2022-09-08 21:17:00'),
(9,9,90,90,'Rahma Aulia','2022-09-08 21:17:00','Rahma Aulia','2022-09-08 21:17:00'),
(10,10,90,90,'Rahma Aulia','2022-09-08 21:17:00','Rahma Aulia','2022-09-08 21:17:00'),
(11,11,90,90,'Rahma Aulia','2022-09-08 21:17:00','Rahma Aulia','2022-09-08 21:17:00'),
(12,12,90,90,'Rahma Aulia','2022-09-08 21:17:00','Rahma Aulia','2022-09-08 21:17:00'),
(13,13,90,90,'Rahma Aulia','2022-09-08 21:17:00','Rahma Aulia','2022-09-08 21:17:00'),
(14,14,90,90,'Rahma Aulia','2022-09-08 21:17:00','Rahma Aulia','2022-09-08 21:17:00'),
(15,15,90,90,'Rahma Aulia','2022-09-08 21:17:00','Rahma Aulia','2022-09-08 21:17:00'),
(16,16,90,90,'Rahma Aulia','2022-09-08 21:17:00','Rahma Aulia','2022-09-08 21:17:00'),
(17,17,90,90,'Rahma Aulia','2022-09-08 21:17:00','Rahma Aulia','2022-09-08 21:17:00'),
(18,18,90,90,'Rahma Aulia','2022-09-08 21:17:00','Rahma Aulia','2022-09-08 21:17:00'),
(19,19,90,90,'Rahma Aulia','2022-09-08 21:17:00','Rahma Aulia','2022-09-08 21:17:00'),
(20,20,90,90,'Rahma Aulia','2022-09-08 21:17:00','Rahma Aulia','2022-09-08 21:17:00'),
(21,21,90,90,'Rahma Aulia','2022-09-08 21:17:00','Rahma Aulia','2022-09-08 21:17:00'),
(22,22,90,90,'Rahma Aulia','2022-09-08 21:17:00','Rahma Aulia','2022-09-08 21:17:00'),
(23,23,90,90,'Rahma Aulia','2022-09-08 21:17:00','Rahma Aulia','2022-09-08 21:17:00'),
(24,24,90,90,'Rahma Aulia','2022-09-08 21:17:00','Rahma Aulia','2022-09-08 21:17:00'),
(25,25,90,90,'Rahma Aulia','2022-09-08 21:17:00','Rahma Aulia','2022-09-08 21:17:00'),
(26,26,90,90,'Rahma Aulia','2022-09-08 21:17:00','Rahma Aulia','2022-09-08 21:17:00'),
(27,27,90,90,'Rahma Aulia','2022-09-08 21:17:00','Rahma Aulia','2022-09-08 21:17:00'),
(28,28,90,90,'Rahma Aulia','2022-09-08 21:17:00','Rahma Aulia','2022-09-08 21:17:00'),
(29,29,90,90,'Rahma Aulia','2022-09-08 21:17:00','Rahma Aulia','2022-09-08 21:17:00'),
(30,30,90,90,'Rahma Aulia','2022-09-08 21:17:00','Rahma Aulia','2022-09-08 21:17:00'),
(31,31,90,90,'Rahma Aulia','2022-09-08 21:17:00','Rahma Aulia','2022-09-08 21:17:00'),
(32,32,90,90,'Rahma Aulia','2022-09-08 21:17:00','Rahma Aulia','2022-09-08 21:17:00'),
(33,33,90,90,'Rahma Aulia','2022-09-08 21:17:00','Rahma Aulia','2022-09-08 21:17:00'),
(34,34,90,90,'Rahma Aulia','2022-09-08 21:17:00','Rahma Aulia','2022-09-08 21:17:00'),
(35,35,90,90,'Rahma Aulia','2022-09-08 21:17:00','Rahma Aulia','2022-09-08 21:17:00'),
(36,36,90,90,'Rahma Aulia','2022-09-08 21:17:00','Rahma Aulia','2022-09-08 21:17:00'),
(37,37,90,90,'Rahma Aulia','2022-09-08 21:17:00','Rahma Aulia','2022-09-08 21:17:00'),
(38,38,90,90,'Rahma Aulia','2022-09-08 21:17:00','Rahma Aulia','2022-09-08 21:17:00'),
(39,39,90,90,'Rahma Aulia','2022-09-08 21:17:00','Rahma Aulia','2022-09-08 21:17:00'),
(40,40,90,90,'Rahma Aulia','2022-09-08 21:17:00','Rahma Aulia','2022-09-08 21:17:00'),
(41,41,90,90,'Rahma Aulia','2022-09-08 21:17:00','Rahma Aulia','2022-09-08 21:17:00'),
(42,42,90,90,'Rahma Aulia','2022-09-08 21:17:00','Rahma Aulia','2022-09-08 21:17:00'),
(43,43,90,90,'Rahma Aulia','2022-09-08 21:17:00','Rahma Aulia','2022-09-08 21:17:00'),
(44,44,90,90,'Rahma Aulia','2022-09-08 21:17:00','Rahma Aulia','2022-09-08 21:17:00'),
(45,45,90,90,'Rahma Aulia','2022-09-08 21:17:00','Rahma Aulia','2022-09-08 21:17:00'),
(46,46,90,90,'Rahma Aulia','2022-09-08 21:17:00','Rahma Aulia','2022-09-08 21:17:00'),
(47,47,90,90,'Rahma Aulia','2022-09-08 21:17:00','Rahma Aulia','2022-09-08 21:17:00'),
(48,48,90,90,'Rahma Aulia','2022-09-08 21:17:00','Rahma Aulia','2022-09-08 21:17:00'),
(49,49,50,50,'Rahma Aulia','2022-09-08 21:17:00','Rahma Aulia','2022-09-08 21:17:00');

/*Table structure for table `master_stokopname` */

DROP TABLE IF EXISTS `master_stokopname`;

CREATE TABLE `master_stokopname` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `created_by` varchar(100) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `master_stokopname` */

/*Table structure for table `profit` */

DROP TABLE IF EXISTS `profit`;

CREATE TABLE `profit` (
  `int` int(11) NOT NULL AUTO_INCREMENT,
  `harga_pokok` int(11) DEFAULT NULL,
  `harga_jual` int(11) DEFAULT NULL,
  `profit` int(11) DEFAULT NULL,
  `pariode` int(11) DEFAULT NULL,
  `tahun` int(11) DEFAULT NULL,
  PRIMARY KEY (`int`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

/*Data for the table `profit` */

insert  into `profit`(`int`,`harga_pokok`,`harga_jual`,`profit`,`pariode`,`tahun`) values 
(1,1250000,1750000,500000,9,2022);

/*Table structure for table `transaksi_stokopname` */

DROP TABLE IF EXISTS `transaksi_stokopname`;

CREATE TABLE `transaksi_stokopname` (
  `id` int(11) DEFAULT NULL,
  `id_item` int(11) DEFAULT NULL,
  `id_stokopname` int(11) DEFAULT NULL,
  `qty` int(11) DEFAULT NULL,
  `reason` text DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `created_by` varchar(100) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` varchar(100) DEFAULT NULL,
  `status` int(11) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `transaksi_stokopname` */

/*Table structure for table `users` */

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `auth_group` varchar(25) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `created_by` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `updated_by` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `status` int(11) DEFAULT 1,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `users` */

insert  into `users`(`id`,`name`,`username`,`password`,`auth_group`,`created_at`,`created_by`,`updated_by`,`updated_at`,`status`) values 
(1,'Ahmad Zakaria','1122','$2y$10$mQXEw32J.EkuzIbDiHwVKeZb82.o/ZlWlERrTI3Y/reY30pV7Bhb2','1','2022-08-07 20:16:52','Anton Cahyo','Ahmad Zakaria','2022-09-08 14:45:16',1),
(3,'Rindang','021','$2y$10$.wDPx2MgANjlaJxMj/aUJ.eNo7f32rGhAogCgnH82hObs6ui.vlP6','2','2022-09-11 20:38:40','Ahmad Zakaria',NULL,NULL,1),
(4,'Eye Shadow','022','$2y$10$dEEStynU4ZwMiaO3APMeqeA0EfTubpqTkYDdzyVoCIpUOULjc6wJm','3','2022-09-11 21:54:50','Ahmad Zakaria',NULL,NULL,1);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
