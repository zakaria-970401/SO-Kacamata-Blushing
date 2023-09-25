/*
SQLyog Ultimate
MySQL - 5.7.36 : Database - kacamata_blushing
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
/*Table structure for table `auth_group` */

CREATE TABLE `auth_group` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `auth_group` */

insert  into `auth_group`(`id`,`name`,`created_at`,`updated_at`) values 
(1,'Super Admin',NULL,NULL),
(2,'Data Entry',NULL,NULL),
(3,'Manager',NULL,NULL);

/*Table structure for table `auth_group_permission` */

CREATE TABLE `auth_group_permission` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `group_id` int(10) unsigned NOT NULL,
  `permission_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
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

CREATE TABLE `master_item` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `frame` varchar(50) DEFAULT NULL,
  `warna` varchar(50) DEFAULT NULL,
  `created_by` varchar(100) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` varchar(100) DEFAULT NULL,
  `status` int(11) DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=49 DEFAULT CHARSET=utf8mb4;

/*Data for the table `master_item` */

insert  into `master_item`(`id`,`frame`,`warna`,`created_by`,`created_at`,`updated_at`,`updated_by`,`status`) values 
(1,'Alice','Black Gold',NULL,NULL,'2022-09-08 13:45:41','Ahmad Zakaria',1),
(2,'Alice','Maroon',NULL,NULL,NULL,NULL,1),
(3,'Americano','Black',NULL,NULL,NULL,NULL,1),
(4,'Amora','Black',NULL,NULL,NULL,NULL,1),
(5,'Amora','Rose Gold',NULL,NULL,NULL,NULL,1),
(6,'Arden','Black',NULL,NULL,NULL,NULL,1),
(7,'Arden','Rose Gold',NULL,NULL,NULL,NULL,1),
(8,'Athena','Black',NULL,NULL,NULL,NULL,1),
(9,'Athena','Rose Gold',NULL,NULL,NULL,NULL,1),
(10,'Boa','Gold',NULL,NULL,NULL,NULL,1),
(11,'Boston','Silver',NULL,NULL,NULL,NULL,1),
(12,'Brixton','Black',NULL,NULL,NULL,NULL,1),
(13,'Cairo','Black',NULL,NULL,NULL,NULL,1),
(14,'Carlo','Maroon',NULL,NULL,NULL,NULL,1),
(15,'Carlo','Black',NULL,NULL,NULL,NULL,1),
(16,'Daisy','Grey',NULL,NULL,NULL,NULL,1),
(17,'Daisy','Black',NULL,NULL,NULL,NULL,1),
(18,'Dakota','Maroon',NULL,NULL,NULL,NULL,1),
(19,'Danila','Black Gold',NULL,NULL,NULL,NULL,1),
(20,'Danila','Peach',NULL,NULL,NULL,NULL,1),
(21,'Darin','Black',NULL,NULL,NULL,NULL,1),
(22,'Darin','Grey',NULL,NULL,NULL,NULL,1),
(23,'Dario','Black',NULL,NULL,NULL,NULL,1),
(24,'Dazel','Leopard',NULL,NULL,NULL,NULL,1),
(25,'Dominic','Black Gold',NULL,NULL,NULL,NULL,1),
(26,'Elora','Black',NULL,NULL,NULL,NULL,1),
(27,'Gaudi','Transparant',NULL,NULL,NULL,NULL,1),
(28,'Hana','Black',NULL,NULL,NULL,NULL,1),
(29,'Hansel','Black',NULL,NULL,NULL,NULL,1),
(30,'Hayko','Black Gold',NULL,NULL,NULL,NULL,1),
(31,'Hugos','Black',NULL,NULL,NULL,NULL,1),
(32,'Jocelyn','Black',NULL,NULL,NULL,NULL,1),
(33,'Kennedy','Black',NULL,NULL,NULL,NULL,1),
(34,'Larissa','Black',NULL,NULL,NULL,NULL,1),
(35,'Larissa','Black Caramel',NULL,NULL,NULL,NULL,1),
(36,'Laura','Caramel',NULL,NULL,NULL,NULL,1),
(37,'Lenon','Black Silver',NULL,NULL,NULL,NULL,1),
(38,'Lilian','Grey',NULL,NULL,NULL,NULL,1),
(39,'Lindafarrow\r\n','Transparant\r\n',NULL,NULL,NULL,NULL,1),
(40,'Lowi','Black Rose',NULL,NULL,NULL,NULL,1),
(41,'Lucas','Black',NULL,NULL,NULL,NULL,1),
(42,'Maura','Grey',NULL,NULL,NULL,NULL,1),
(43,'Mecca','Grey',NULL,NULL,NULL,NULL,1),
(44,'Meydi','Caramel',NULL,NULL,NULL,NULL,1),
(45,'Nara','Caramel',NULL,NULL,NULL,NULL,1),
(46,'Stevia','Silver',NULL,NULL,NULL,NULL,1),
(47,'Uno','Grey',NULL,NULL,NULL,NULL,1),
(48,'Wina','Black',NULL,NULL,NULL,NULL,1);

/*Table structure for table `master_pengeluaran_item` */

CREATE TABLE `master_pengeluaran_item` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kode_pengeluaran` varchar(15) DEFAULT NULL,
  `id_item` int(11) DEFAULT NULL,
  `qty` int(11) DEFAULT NULL,
  `created_by` varchar(100) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;

/*Data for the table `master_pengeluaran_item` */

insert  into `master_pengeluaran_item`(`id`,`kode_pengeluaran`,`id_item`,`qty`,`created_by`,`created_at`) values 
(1,'c5mq91EUuZ',1,200,'Ahmad Zakaria','2023-09-22 16:16:28'),
(2,'c5mq91EUuZ',2,150,'Ahmad Zakaria','2023-09-22 16:16:28'),
(3,'nJP9GbnBMs',2,20,'Ahmad Zakaria','2023-09-25 11:40:28'),
(4,'v61rFkHgH7',1,20,'Ahmad Zakaria','2023-09-25 11:42:15');

/*Table structure for table `master_stok_item` */

CREATE TABLE `master_stok_item` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kode_kedatangan` varchar(25) DEFAULT NULL,
  `id_item` int(11) DEFAULT NULL,
  `vendor` varchar(50) DEFAULT NULL,
  `stok` int(11) DEFAULT NULL,
  `count_by` varchar(100) DEFAULT NULL,
  `count_at` datetime DEFAULT NULL,
  `updated_count_by` varchar(100) DEFAULT NULL,
  `updated_count_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4;

/*Data for the table `master_stok_item` */

insert  into `master_stok_item`(`id`,`kode_kedatangan`,`id_item`,`vendor`,`stok`,`count_by`,`count_at`,`updated_count_by`,`updated_count_at`) values 
(1,'azDoGetYmN',1,'Alibaba',480,NULL,NULL,'Ahmad Zakaria','2023-09-25 11:42:15'),
(2,'azDoGetYmN',2,'Kawan Lama',130,NULL,NULL,'Ahmad Zakaria','2023-09-25 11:40:28'),
(3,'azDoGetYmN',4,'Alibaba',300,NULL,NULL,'Ahmad Zakaria','2023-09-22 15:48:55'),
(4,'DcKAHKP7Ys',1,'Alibaba',480,NULL,NULL,'Ahmad Zakaria','2023-09-25 11:42:15'),
(5,'DcKAHKP7Ys',2,'Kawan Lama',130,NULL,NULL,'Ahmad Zakaria','2023-09-25 11:40:28'),
(6,'6X1p1MoVOm',1,'Kawan Lama',480,NULL,NULL,'Ahmad Zakaria','2023-09-25 11:42:15');

/*Table structure for table `master_stokopname` */

CREATE TABLE `master_stokopname` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `created_by` varchar(100) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `master_stokopname` */

/*Table structure for table `profit` */

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

/*Table structure for table `report_transaksi` */

CREATE TABLE `report_transaksi` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_item` int(11) DEFAULT NULL,
  `kode_kedatangan` varchar(15) DEFAULT NULL,
  `kode_pengeluaran` varchar(15) DEFAULT NULL,
  `type` varchar(15) DEFAULT NULL,
  `qty` int(11) DEFAULT NULL,
  `balance` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `created_by` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

/*Data for the table `report_transaksi` */

insert  into `report_transaksi`(`id`,`id_item`,`kode_kedatangan`,`kode_pengeluaran`,`type`,`qty`,`balance`,`created_at`,`created_by`) values 
(1,1,'DcKAHKP7Ys',NULL,'in',20,20,'2023-09-25 11:31:34','Ahmad Zakaria'),
(2,2,'DcKAHKP7Ys',NULL,'in',50,50,'2023-09-25 11:31:34','Ahmad Zakaria'),
(3,1,'6X1p1MoVOm',NULL,'in',10,30,'2023-09-25 11:32:41','Ahmad Zakaria'),
(4,2,NULL,'nJP9GbnBMs','out',20,30,'2023-09-25 11:40:28','Ahmad Zakaria'),
(5,1,NULL,'v61rFkHgH7','out',20,10,'2023-09-25 11:42:15','Ahmad Zakaria');

/*Table structure for table `transaksi_stokopname` */

CREATE TABLE `transaksi_stokopname` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_item` int(11) DEFAULT NULL,
  `id_stokopname` int(11) DEFAULT NULL,
  `stok_sistem` int(11) DEFAULT NULL,
  `stok_actual` int(11) DEFAULT NULL,
  `reason` text,
  `created_at` datetime DEFAULT NULL,
  `created_by` varchar(100) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` varchar(100) DEFAULT NULL,
  `status` int(11) DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `transaksi_stokopname` */

/*Table structure for table `users` */

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
  `status` int(11) DEFAULT '1',
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `users` */

insert  into `users`(`id`,`name`,`username`,`password`,`auth_group`,`created_at`,`created_by`,`updated_by`,`updated_at`,`status`) values 
(1,'Ahmad Zakaria','1122','$2y$10$mQXEw32J.EkuzIbDiHwVKeZb82.o/ZlWlERrTI3Y/reY30pV7Bhb2','1','2022-08-07 20:16:52','Anton Cahyo','Ahmad Zakaria','2022-09-08 14:45:16',1),
(3,'Rindang','021','$2y$10$.wDPx2MgANjlaJxMj/aUJ.eNo7f32rGhAogCgnH82hObs6ui.vlP6','2','2022-09-11 20:38:40','Ahmad Zakaria',NULL,NULL,1),
(4,'Eye Shadow','022','$2y$10$dEEStynU4ZwMiaO3APMeqeA0EfTubpqTkYDdzyVoCIpUOULjc6wJm','3','2022-09-11 21:54:50','Ahmad Zakaria',NULL,NULL,1);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
