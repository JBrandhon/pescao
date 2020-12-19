/*
SQLyog Community v13.1.6 (64 bit)
MySQL - 10.4.14-MariaDB : Database - pescao_costume _rental _system
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`pescao_costume _rental _system` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `pescao_costume _rental _system`;

/*Table structure for table `tbl_4_rent` */

DROP TABLE IF EXISTS `tbl_4_rent`;

CREATE TABLE `tbl_4_rent` (
  `id` int(4) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `qty` int(4) DEFAULT NULL,
  `added_by` int(11) DEFAULT NULL,
  `description` varchar(100) DEFAULT NULL,
  `item_type` enum('Costume','Sports Equipment') DEFAULT NULL,
  `rental_prize` decimal(10,2) DEFAULT NULL,
  `gender` enum('Male','Female','Both') DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `added_by` (`added_by`),
  CONSTRAINT `tbl_4_rent_ibfk_2` FOREIGN KEY (`added_by`) REFERENCES `tbl_admin` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=265 DEFAULT CHARSET=latin1;

/*Data for the table `tbl_4_rent` */

/*Table structure for table `tbl_admin` */

DROP TABLE IF EXISTS `tbl_admin`;

CREATE TABLE `tbl_admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `last_name` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `username` varchar(25) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `gender` enum('Male','Female') COLLATE utf8_unicode_ci NOT NULL,
  `phone` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `is_super_admin` tinyint(1) NOT NULL DEFAULT 0 COMMENT '1=Active | 0=Inactive',
  `status` tinyint(1) DEFAULT 1,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `tbl_admin` */

insert  into `tbl_admin`(`id`,`first_name`,`last_name`,`username`,`email`,`password`,`gender`,`phone`,`created`,`modified`,`is_super_admin`,`status`) values 
(1,'Admin','Admin','admin','admin@gmail.com','21232f297a57a5a743894a0e4a801fc3','Male','091234567','2020-07-31 20:13:27','2020-07-31 20:13:27',1,1);

/*Table structure for table `tbl_cart` */

DROP TABLE IF EXISTS `tbl_cart`;

CREATE TABLE `tbl_cart` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `item_id` int(4) DEFAULT NULL,
  `reciept_number` varchar(10) DEFAULT NULL,
  `qty` int(4) DEFAULT NULL,
  `payable` int(5) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `reciept_number` (`reciept_number`),
  KEY `item_id` (`item_id`),
  CONSTRAINT `tbl_cart_ibfk_1` FOREIGN KEY (`item_id`) REFERENCES `tbl_4_rent` (`id`),
  CONSTRAINT `tbl_cart_ibfk_2` FOREIGN KEY (`reciept_number`) REFERENCES `tbl_rentee` (`reciept_number`)
) ENGINE=InnoDB AUTO_INCREMENT=124 DEFAULT CHARSET=latin1;

/*Data for the table `tbl_cart` */

/*Table structure for table `tbl_history` */

DROP TABLE IF EXISTS `tbl_history`;

CREATE TABLE `tbl_history` (
  `id` int(4) NOT NULL AUTO_INCREMENT,
  `rented_qty` int(4) DEFAULT NULL,
  `reciept_number` varbinary(10) DEFAULT NULL,
  `from` date DEFAULT NULL,
  `payable` int(4) DEFAULT NULL,
  `penalty` int(4) DEFAULT NULL,
  `item_name` varchar(100) DEFAULT NULL,
  `item_status` varchar(14) DEFAULT NULL,
  `item_id` int(4) DEFAULT NULL,
  `remaining_item` int(4) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `item_id` (`item_id`),
  CONSTRAINT `tbl_history_ibfk_1` FOREIGN KEY (`item_id`) REFERENCES `tbl_4_rent` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=122 DEFAULT CHARSET=latin1;

/*Data for the table `tbl_history` */

/*Table structure for table `tbl_images` */

DROP TABLE IF EXISTS `tbl_images`;

CREATE TABLE `tbl_images` (
  `id` int(90) NOT NULL AUTO_INCREMENT,
  `item_id` int(90) DEFAULT NULL,
  `image` longblob DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `item_id` (`item_id`),
  CONSTRAINT `tbl_images_ibfk_1` FOREIGN KEY (`item_id`) REFERENCES `tbl_4_rent` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=205 DEFAULT CHARSET=latin1;

/*Data for the table `tbl_images` */

/*Table structure for table `tbl_inventory` */

DROP TABLE IF EXISTS `tbl_inventory`;

CREATE TABLE `tbl_inventory` (
  `id` int(4) NOT NULL AUTO_INCREMENT,
  `costume_id` int(4) DEFAULT NULL,
  `qty_status` int(4) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`id`),
  KEY `costume_id` (`costume_id`),
  CONSTRAINT `tbl_inventory_ibfk_1` FOREIGN KEY (`costume_id`) REFERENCES `tbl_4_rent` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=223 DEFAULT CHARSET=latin1;

/*Data for the table `tbl_inventory` */

/*Table structure for table `tbl_lost` */

DROP TABLE IF EXISTS `tbl_lost`;

CREATE TABLE `tbl_lost` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `item_id` int(10) DEFAULT NULL,
  `qty` int(10) DEFAULT NULL,
  `reciept_number` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `item_id` (`item_id`),
  CONSTRAINT `tbl_lost_ibfk_1` FOREIGN KEY (`item_id`) REFERENCES `tbl_inventory` (`costume_id`)
) ENGINE=InnoDB AUTO_INCREMENT=46 DEFAULT CHARSET=latin1;

/*Data for the table `tbl_lost` */

/*Table structure for table `tbl_payable` */

DROP TABLE IF EXISTS `tbl_payable`;

CREATE TABLE `tbl_payable` (
  `id` int(4) NOT NULL AUTO_INCREMENT,
  `renters_id` int(4) DEFAULT NULL,
  `reciept_number` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `reciept_number` (`reciept_number`),
  KEY `renters_id` (`renters_id`),
  CONSTRAINT `tbl_payable_ibfk_1` FOREIGN KEY (`renters_id`) REFERENCES `tbl_rentee` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tbl_payable` */

/*Table structure for table `tbl_rentee` */

DROP TABLE IF EXISTS `tbl_rentee`;

CREATE TABLE `tbl_rentee` (
  `id` int(4) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `address` varchar(50) DEFAULT NULL,
  `phone` varchar(12) DEFAULT NULL,
  `email` varchar(25) DEFAULT NULL,
  `status` enum('Unpaid','Paid','Unprocessed') DEFAULT 'Unprocessed',
  `reciept_number` varchar(10) DEFAULT NULL,
  `lessor` int(4) DEFAULT NULL,
  `user_status` varchar(25) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQUE` (`reciept_number`)
) ENGINE=InnoDB AUTO_INCREMENT=95 DEFAULT CHARSET=latin1;

/*Data for the table `tbl_rentee` */

/* Trigger structure for table `tbl_4_rent` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `after_insert_tbl4rent_to_tbliventory` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `after_insert_tbl4rent_to_tbliventory` AFTER INSERT ON `tbl_4_rent` FOR EACH ROW BEGIN
	INSERT INTO `tbl_inventory` (costume_id, qty_status ) VALUES (new.id , new.qty );
    END */$$


DELIMITER ;

/* Trigger structure for table `tbl_cart` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `renting_history` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `renting_history` AFTER INSERT ON `tbl_cart` FOR EACH ROW BEGIN
	insert into tbl_history set 
		rented_qty = new.qty ,
		`from` = now() ,
		reciept_number = new.reciept_number,
		item_name = (select `name` from tbl_4_rent where id = new.item_id),
		item_id = (SELECT `id` FROM tbl_4_rent WHERE id = new.item_id),
		payable = new.payable;
		
		  
    END */$$


DELIMITER ;

/* Trigger structure for table `tbl_cart` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `after_update_cart` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `after_update_cart` AFTER UPDATE ON `tbl_cart` FOR EACH ROW BEGIN
	update tbl_history 
		set rented_qty = new.qty
		WHERE reciept_number = old.reciept_number AND item_name = ( SELECT `name` FROM tbl_4_rent WHERE id = old.item_id );
    END */$$


DELIMITER ;

/* Trigger structure for table `tbl_cart` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `after_delete_tbl_cart` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `after_delete_tbl_cart` AFTER DELETE ON `tbl_cart` FOR EACH ROW BEGIN
	update tbl_4_rent set qty = qty + old.qty where  id = old.item_id;
	update tbl_rentee set `status` = 'Paid' where reciept_number = old.reciept_number;
    END */$$


DELIMITER ;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
