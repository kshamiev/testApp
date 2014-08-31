/*
SQLyog Enterprise v9.50 
MySQL - 5.5.25a-log : Database - test
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
/*Table structure for table `Citys` */

DROP TABLE IF EXISTS `Citys`;

CREATE TABLE `Citys` (
  `Id` bigint(20) NOT NULL AUTO_INCREMENT COMMENT 'Идентификатор',
  `Name` varchar(50) DEFAULT NULL COMMENT 'Название города',
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=40 DEFAULT CHARSET=utf8 COMMENT='Города';

/*Data for the table `Citys` */

insert  into `Citys`(`Id`,`Name`) values (1,'Москва');
insert  into `Citys`(`Id`,`Name`) values (2,'Уфа');
insert  into `Citys`(`Id`,`Name`) values (3,'Челябинск');
insert  into `Citys`(`Id`,`Name`) values (4,'Бобруйск');
insert  into `Citys`(`Id`,`Name`) values (5,'Михайлов');
insert  into `Citys`(`Id`,`Name`) values (6,'Буркина-Фасо');
insert  into `Citys`(`Id`,`Name`) values (7,'Иерусалим');
insert  into `Citys`(`Id`,`Name`) values (8,'Сеул');
insert  into `Citys`(`Id`,`Name`) values (9,'Сталинград');
insert  into `Citys`(`Id`,`Name`) values (10,'Бухарест');
insert  into `Citys`(`Id`,`Name`) values (11,'Фукусима');
insert  into `Citys`(`Id`,`Name`) values (12,'Харьков');
insert  into `Citys`(`Id`,`Name`) values (13,'Афины');
insert  into `Citys`(`Id`,`Name`) values (14,'Адыгейск');
insert  into `Citys`(`Id`,`Name`) values (15,'Майкоп');
insert  into `Citys`(`Id`,`Name`) values (16,'Горно-Алтайск');
insert  into `Citys`(`Id`,`Name`) values (17,'Алейск');
insert  into `Citys`(`Id`,`Name`) values (18,'Барнаул');
insert  into `Citys`(`Id`,`Name`) values (19,'Белокуриха');
insert  into `Citys`(`Id`,`Name`) values (20,'Бийск');
insert  into `Citys`(`Id`,`Name`) values (21,'Горняк');
insert  into `Citys`(`Id`,`Name`) values (22,'Заринск');
insert  into `Citys`(`Id`,`Name`) values (23,'Змеиногорск');
insert  into `Citys`(`Id`,`Name`) values (24,'Камень-на-Оби');
insert  into `Citys`(`Id`,`Name`) values (25,'Новоалтайск');
insert  into `Citys`(`Id`,`Name`) values (26,'Рубцовск');
insert  into `Citys`(`Id`,`Name`) values (27,'Рубцовск');
insert  into `Citys`(`Id`,`Name`) values (28,'Яровое');
insert  into `Citys`(`Id`,`Name`) values (29,'Белогорск');
insert  into `Citys`(`Id`,`Name`) values (30,'Тында');
insert  into `Citys`(`Id`,`Name`) values (31,'Архангельск');
insert  into `Citys`(`Id`,`Name`) values (32,'Онега');
insert  into `Citys`(`Id`,`Name`) values (33,'Северодвинск');
insert  into `Citys`(`Id`,`Name`) values (34,'Знаменск');
insert  into `Citys`(`Id`,`Name`) values (35,'Камызяк');
insert  into `Citys`(`Id`,`Name`) values (36,'Благовещенск');
insert  into `Citys`(`Id`,`Name`) values (37,'Бирск');
insert  into `Citys`(`Id`,`Name`) values (38,'Дюртюли');
insert  into `Citys`(`Id`,`Name`) values (39,'Нефтекамск');

/*Table structure for table `Education` */

DROP TABLE IF EXISTS `Education`;

CREATE TABLE `Education` (
  `Id` bigint(20) NOT NULL AUTO_INCREMENT COMMENT 'Идентификатор',
  `Name` varchar(50) DEFAULT NULL COMMENT 'Образование',
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8 COMMENT='Образование';

/*Data for the table `Education` */

insert  into `Education`(`Id`,`Name`) values (1,'среднее');
insert  into `Education`(`Id`,`Name`) values (2,'бакалавр');
insert  into `Education`(`Id`,`Name`) values (3,'магистратура');
insert  into `Education`(`Id`,`Name`) values (9,'аспирантура');
insert  into `Education`(`Id`,`Name`) values (10,'академическое');
insert  into `Education`(`Id`,`Name`) values (11,'доктроское');
insert  into `Education`(`Id`,`Name`) values (12,'профессорское');
insert  into `Education`(`Id`,`Name`) values (13,'дошкольное');
insert  into `Education`(`Id`,`Name`) values (14,'начальное');
insert  into `Education`(`Id`,`Name`) values (15,'ординатура ');
insert  into `Education`(`Id`,`Name`) values (16,'интернатура');

/*Table structure for table `Users` */

DROP TABLE IF EXISTS `Users`;

CREATE TABLE `Users` (
  `Id` bigint(20) NOT NULL AUTO_INCREMENT COMMENT 'Идентификатор',
  `Name` varchar(50) DEFAULT NULL COMMENT 'Имя пользователя',
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8 COMMENT='Пользователи';

/*Data for the table `Users` */

insert  into `Users`(`Id`,`Name`) values (1,'Петр');
insert  into `Users`(`Id`,`Name`) values (2,'Симеон');
insert  into `Users`(`Id`,`Name`) values (3,'Константин');
insert  into `Users`(`Id`,`Name`) values (4,'Алексей');
insert  into `Users`(`Id`,`Name`) values (5,'Андрей');
insert  into `Users`(`Id`,`Name`) values (6,'Василий');
insert  into `Users`(`Id`,`Name`) values (7,'Мустафа');
insert  into `Users`(`Id`,`Name`) values (8,'Эрик');
insert  into `Users`(`Id`,`Name`) values (9,'Рональд');
insert  into `Users`(`Id`,`Name`) values (10,'Адольф');
insert  into `Users`(`Id`,`Name`) values (11,'Луций');
insert  into `Users`(`Id`,`Name`) values (12,'Борис');
insert  into `Users`(`Id`,`Name`) values (13,'Пафнутий');
insert  into `Users`(`Id`,`Name`) values (14,'Тор');
insert  into `Users`(`Id`,`Name`) values (15,'Моисей');
insert  into `Users`(`Id`,`Name`) values (16,'Давид');
insert  into `Users`(`Id`,`Name`) values (17,'Один');
insert  into `Users`(`Id`,`Name`) values (18,'Мракос');
insert  into `Users`(`Id`,`Name`) values (19,'Полиграф');
insert  into `Users`(`Id`,`Name`) values (20,'Аид');
insert  into `Users`(`Id`,`Name`) values (21,'Zero');
insert  into `Users`(`Id`,`Name`) values (22,'Язи');

/*Table structure for table `UsersCitys` */

DROP TABLE IF EXISTS `UsersCitys`;

CREATE TABLE `UsersCitys` (
  `Users_Id` bigint(20) NOT NULL COMMENT 'Пользователь',
  `Citys_Id` bigint(20) NOT NULL COMMENT 'Город',
  KEY `Users_Id` (`Users_Id`),
  KEY `Citys_Id` (`Citys_Id`),
  CONSTRAINT `UsersCitys_ibfk_1` FOREIGN KEY (`Users_Id`) REFERENCES `Users` (`Id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `UsersCitys_ibfk_2` FOREIGN KEY (`Citys_Id`) REFERENCES `Citys` (`Id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Связь пользователя с городом';

/*Data for the table `UsersCitys` */

insert  into `UsersCitys`(`Users_Id`,`Citys_Id`) values (1,33);
insert  into `UsersCitys`(`Users_Id`,`Citys_Id`) values (1,24);
insert  into `UsersCitys`(`Users_Id`,`Citys_Id`) values (1,18);
insert  into `UsersCitys`(`Users_Id`,`Citys_Id`) values (1,27);
insert  into `UsersCitys`(`Users_Id`,`Citys_Id`) values (1,35);
insert  into `UsersCitys`(`Users_Id`,`Citys_Id`) values (1,20);
insert  into `UsersCitys`(`Users_Id`,`Citys_Id`) values (2,4);
insert  into `UsersCitys`(`Users_Id`,`Citys_Id`) values (2,39);
insert  into `UsersCitys`(`Users_Id`,`Citys_Id`) values (2,24);
insert  into `UsersCitys`(`Users_Id`,`Citys_Id`) values (2,20);
insert  into `UsersCitys`(`Users_Id`,`Citys_Id`) values (2,37);
insert  into `UsersCitys`(`Users_Id`,`Citys_Id`) values (2,7);
insert  into `UsersCitys`(`Users_Id`,`Citys_Id`) values (3,23);
insert  into `UsersCitys`(`Users_Id`,`Citys_Id`) values (3,38);
insert  into `UsersCitys`(`Users_Id`,`Citys_Id`) values (3,12);
insert  into `UsersCitys`(`Users_Id`,`Citys_Id`) values (3,2);
insert  into `UsersCitys`(`Users_Id`,`Citys_Id`) values (3,36);
insert  into `UsersCitys`(`Users_Id`,`Citys_Id`) values (3,29);
insert  into `UsersCitys`(`Users_Id`,`Citys_Id`) values (4,32);
insert  into `UsersCitys`(`Users_Id`,`Citys_Id`) values (4,2);
insert  into `UsersCitys`(`Users_Id`,`Citys_Id`) values (4,1);
insert  into `UsersCitys`(`Users_Id`,`Citys_Id`) values (4,33);
insert  into `UsersCitys`(`Users_Id`,`Citys_Id`) values (4,21);
insert  into `UsersCitys`(`Users_Id`,`Citys_Id`) values (4,9);
insert  into `UsersCitys`(`Users_Id`,`Citys_Id`) values (5,24);
insert  into `UsersCitys`(`Users_Id`,`Citys_Id`) values (5,7);
insert  into `UsersCitys`(`Users_Id`,`Citys_Id`) values (5,12);
insert  into `UsersCitys`(`Users_Id`,`Citys_Id`) values (5,14);
insert  into `UsersCitys`(`Users_Id`,`Citys_Id`) values (5,37);
insert  into `UsersCitys`(`Users_Id`,`Citys_Id`) values (5,31);
insert  into `UsersCitys`(`Users_Id`,`Citys_Id`) values (6,15);
insert  into `UsersCitys`(`Users_Id`,`Citys_Id`) values (6,14);
insert  into `UsersCitys`(`Users_Id`,`Citys_Id`) values (6,4);
insert  into `UsersCitys`(`Users_Id`,`Citys_Id`) values (6,20);
insert  into `UsersCitys`(`Users_Id`,`Citys_Id`) values (6,7);
insert  into `UsersCitys`(`Users_Id`,`Citys_Id`) values (6,31);
insert  into `UsersCitys`(`Users_Id`,`Citys_Id`) values (7,6);
insert  into `UsersCitys`(`Users_Id`,`Citys_Id`) values (7,20);
insert  into `UsersCitys`(`Users_Id`,`Citys_Id`) values (7,39);
insert  into `UsersCitys`(`Users_Id`,`Citys_Id`) values (7,22);
insert  into `UsersCitys`(`Users_Id`,`Citys_Id`) values (7,32);
insert  into `UsersCitys`(`Users_Id`,`Citys_Id`) values (7,26);
insert  into `UsersCitys`(`Users_Id`,`Citys_Id`) values (8,17);
insert  into `UsersCitys`(`Users_Id`,`Citys_Id`) values (8,28);
insert  into `UsersCitys`(`Users_Id`,`Citys_Id`) values (8,6);
insert  into `UsersCitys`(`Users_Id`,`Citys_Id`) values (8,36);
insert  into `UsersCitys`(`Users_Id`,`Citys_Id`) values (8,11);
insert  into `UsersCitys`(`Users_Id`,`Citys_Id`) values (8,2);
insert  into `UsersCitys`(`Users_Id`,`Citys_Id`) values (9,20);
insert  into `UsersCitys`(`Users_Id`,`Citys_Id`) values (9,28);
insert  into `UsersCitys`(`Users_Id`,`Citys_Id`) values (9,17);
insert  into `UsersCitys`(`Users_Id`,`Citys_Id`) values (9,6);
insert  into `UsersCitys`(`Users_Id`,`Citys_Id`) values (9,5);
insert  into `UsersCitys`(`Users_Id`,`Citys_Id`) values (9,4);
insert  into `UsersCitys`(`Users_Id`,`Citys_Id`) values (10,19);
insert  into `UsersCitys`(`Users_Id`,`Citys_Id`) values (10,29);
insert  into `UsersCitys`(`Users_Id`,`Citys_Id`) values (10,34);
insert  into `UsersCitys`(`Users_Id`,`Citys_Id`) values (10,11);
insert  into `UsersCitys`(`Users_Id`,`Citys_Id`) values (10,14);
insert  into `UsersCitys`(`Users_Id`,`Citys_Id`) values (10,6);
insert  into `UsersCitys`(`Users_Id`,`Citys_Id`) values (11,22);
insert  into `UsersCitys`(`Users_Id`,`Citys_Id`) values (11,16);
insert  into `UsersCitys`(`Users_Id`,`Citys_Id`) values (11,8);
insert  into `UsersCitys`(`Users_Id`,`Citys_Id`) values (11,5);
insert  into `UsersCitys`(`Users_Id`,`Citys_Id`) values (11,38);
insert  into `UsersCitys`(`Users_Id`,`Citys_Id`) values (11,24);
insert  into `UsersCitys`(`Users_Id`,`Citys_Id`) values (12,9);
insert  into `UsersCitys`(`Users_Id`,`Citys_Id`) values (12,2);
insert  into `UsersCitys`(`Users_Id`,`Citys_Id`) values (12,29);
insert  into `UsersCitys`(`Users_Id`,`Citys_Id`) values (12,18);
insert  into `UsersCitys`(`Users_Id`,`Citys_Id`) values (12,25);
insert  into `UsersCitys`(`Users_Id`,`Citys_Id`) values (12,24);
insert  into `UsersCitys`(`Users_Id`,`Citys_Id`) values (13,16);
insert  into `UsersCitys`(`Users_Id`,`Citys_Id`) values (13,20);
insert  into `UsersCitys`(`Users_Id`,`Citys_Id`) values (13,39);
insert  into `UsersCitys`(`Users_Id`,`Citys_Id`) values (13,14);
insert  into `UsersCitys`(`Users_Id`,`Citys_Id`) values (13,29);
insert  into `UsersCitys`(`Users_Id`,`Citys_Id`) values (13,9);
insert  into `UsersCitys`(`Users_Id`,`Citys_Id`) values (14,30);
insert  into `UsersCitys`(`Users_Id`,`Citys_Id`) values (14,39);
insert  into `UsersCitys`(`Users_Id`,`Citys_Id`) values (14,27);
insert  into `UsersCitys`(`Users_Id`,`Citys_Id`) values (14,10);
insert  into `UsersCitys`(`Users_Id`,`Citys_Id`) values (14,9);
insert  into `UsersCitys`(`Users_Id`,`Citys_Id`) values (14,11);
insert  into `UsersCitys`(`Users_Id`,`Citys_Id`) values (15,23);
insert  into `UsersCitys`(`Users_Id`,`Citys_Id`) values (15,6);
insert  into `UsersCitys`(`Users_Id`,`Citys_Id`) values (15,1);
insert  into `UsersCitys`(`Users_Id`,`Citys_Id`) values (15,29);
insert  into `UsersCitys`(`Users_Id`,`Citys_Id`) values (15,5);
insert  into `UsersCitys`(`Users_Id`,`Citys_Id`) values (15,39);
insert  into `UsersCitys`(`Users_Id`,`Citys_Id`) values (16,9);
insert  into `UsersCitys`(`Users_Id`,`Citys_Id`) values (16,20);
insert  into `UsersCitys`(`Users_Id`,`Citys_Id`) values (16,3);
insert  into `UsersCitys`(`Users_Id`,`Citys_Id`) values (16,23);
insert  into `UsersCitys`(`Users_Id`,`Citys_Id`) values (16,27);
insert  into `UsersCitys`(`Users_Id`,`Citys_Id`) values (16,38);
insert  into `UsersCitys`(`Users_Id`,`Citys_Id`) values (17,23);
insert  into `UsersCitys`(`Users_Id`,`Citys_Id`) values (17,4);
insert  into `UsersCitys`(`Users_Id`,`Citys_Id`) values (17,32);
insert  into `UsersCitys`(`Users_Id`,`Citys_Id`) values (17,6);
insert  into `UsersCitys`(`Users_Id`,`Citys_Id`) values (17,10);
insert  into `UsersCitys`(`Users_Id`,`Citys_Id`) values (17,36);
insert  into `UsersCitys`(`Users_Id`,`Citys_Id`) values (18,31);
insert  into `UsersCitys`(`Users_Id`,`Citys_Id`) values (18,30);
insert  into `UsersCitys`(`Users_Id`,`Citys_Id`) values (18,5);
insert  into `UsersCitys`(`Users_Id`,`Citys_Id`) values (18,39);
insert  into `UsersCitys`(`Users_Id`,`Citys_Id`) values (18,14);
insert  into `UsersCitys`(`Users_Id`,`Citys_Id`) values (18,21);
insert  into `UsersCitys`(`Users_Id`,`Citys_Id`) values (19,36);
insert  into `UsersCitys`(`Users_Id`,`Citys_Id`) values (19,8);
insert  into `UsersCitys`(`Users_Id`,`Citys_Id`) values (19,12);
insert  into `UsersCitys`(`Users_Id`,`Citys_Id`) values (19,1);
insert  into `UsersCitys`(`Users_Id`,`Citys_Id`) values (19,22);
insert  into `UsersCitys`(`Users_Id`,`Citys_Id`) values (19,31);
insert  into `UsersCitys`(`Users_Id`,`Citys_Id`) values (20,1);
insert  into `UsersCitys`(`Users_Id`,`Citys_Id`) values (20,9);
insert  into `UsersCitys`(`Users_Id`,`Citys_Id`) values (20,10);
insert  into `UsersCitys`(`Users_Id`,`Citys_Id`) values (20,23);
insert  into `UsersCitys`(`Users_Id`,`Citys_Id`) values (20,32);
insert  into `UsersCitys`(`Users_Id`,`Citys_Id`) values (20,13);

/*Table structure for table `UsersEducation` */

DROP TABLE IF EXISTS `UsersEducation`;

CREATE TABLE `UsersEducation` (
  `Users_Id` bigint(20) NOT NULL COMMENT 'Пользователь',
  `Education_Id` bigint(20) NOT NULL COMMENT 'Образование',
  KEY `Users_Id` (`Users_Id`),
  KEY `Education_Id` (`Education_Id`),
  CONSTRAINT `UsersEducation_ibfk_1` FOREIGN KEY (`Users_Id`) REFERENCES `Users` (`Id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `UsersEducation_ibfk_2` FOREIGN KEY (`Education_Id`) REFERENCES `Education` (`Id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Связь пользователя с образованием';

/*Data for the table `UsersEducation` */

insert  into `UsersEducation`(`Users_Id`,`Education_Id`) values (1,14);
insert  into `UsersEducation`(`Users_Id`,`Education_Id`) values (1,3);
insert  into `UsersEducation`(`Users_Id`,`Education_Id`) values (1,1);
insert  into `UsersEducation`(`Users_Id`,`Education_Id`) values (2,11);
insert  into `UsersEducation`(`Users_Id`,`Education_Id`) values (2,14);
insert  into `UsersEducation`(`Users_Id`,`Education_Id`) values (2,3);
insert  into `UsersEducation`(`Users_Id`,`Education_Id`) values (3,10);
insert  into `UsersEducation`(`Users_Id`,`Education_Id`) values (3,3);
insert  into `UsersEducation`(`Users_Id`,`Education_Id`) values (3,14);
insert  into `UsersEducation`(`Users_Id`,`Education_Id`) values (4,11);
insert  into `UsersEducation`(`Users_Id`,`Education_Id`) values (4,10);
insert  into `UsersEducation`(`Users_Id`,`Education_Id`) values (4,2);
insert  into `UsersEducation`(`Users_Id`,`Education_Id`) values (5,12);
insert  into `UsersEducation`(`Users_Id`,`Education_Id`) values (5,11);
insert  into `UsersEducation`(`Users_Id`,`Education_Id`) values (5,16);
insert  into `UsersEducation`(`Users_Id`,`Education_Id`) values (6,14);
insert  into `UsersEducation`(`Users_Id`,`Education_Id`) values (6,1);
insert  into `UsersEducation`(`Users_Id`,`Education_Id`) values (6,12);
insert  into `UsersEducation`(`Users_Id`,`Education_Id`) values (7,10);
insert  into `UsersEducation`(`Users_Id`,`Education_Id`) values (7,15);
insert  into `UsersEducation`(`Users_Id`,`Education_Id`) values (7,14);
insert  into `UsersEducation`(`Users_Id`,`Education_Id`) values (8,11);
insert  into `UsersEducation`(`Users_Id`,`Education_Id`) values (8,2);
insert  into `UsersEducation`(`Users_Id`,`Education_Id`) values (8,13);
insert  into `UsersEducation`(`Users_Id`,`Education_Id`) values (9,2);
insert  into `UsersEducation`(`Users_Id`,`Education_Id`) values (9,3);
insert  into `UsersEducation`(`Users_Id`,`Education_Id`) values (9,13);
insert  into `UsersEducation`(`Users_Id`,`Education_Id`) values (10,13);
insert  into `UsersEducation`(`Users_Id`,`Education_Id`) values (10,2);
insert  into `UsersEducation`(`Users_Id`,`Education_Id`) values (10,16);
insert  into `UsersEducation`(`Users_Id`,`Education_Id`) values (11,1);
insert  into `UsersEducation`(`Users_Id`,`Education_Id`) values (11,16);
insert  into `UsersEducation`(`Users_Id`,`Education_Id`) values (11,15);
insert  into `UsersEducation`(`Users_Id`,`Education_Id`) values (12,9);
insert  into `UsersEducation`(`Users_Id`,`Education_Id`) values (12,11);
insert  into `UsersEducation`(`Users_Id`,`Education_Id`) values (12,15);
insert  into `UsersEducation`(`Users_Id`,`Education_Id`) values (13,15);
insert  into `UsersEducation`(`Users_Id`,`Education_Id`) values (13,9);
insert  into `UsersEducation`(`Users_Id`,`Education_Id`) values (13,10);
insert  into `UsersEducation`(`Users_Id`,`Education_Id`) values (14,15);
insert  into `UsersEducation`(`Users_Id`,`Education_Id`) values (14,11);
insert  into `UsersEducation`(`Users_Id`,`Education_Id`) values (14,2);
insert  into `UsersEducation`(`Users_Id`,`Education_Id`) values (15,16);
insert  into `UsersEducation`(`Users_Id`,`Education_Id`) values (15,11);
insert  into `UsersEducation`(`Users_Id`,`Education_Id`) values (15,13);
insert  into `UsersEducation`(`Users_Id`,`Education_Id`) values (16,2);
insert  into `UsersEducation`(`Users_Id`,`Education_Id`) values (16,16);
insert  into `UsersEducation`(`Users_Id`,`Education_Id`) values (16,13);
insert  into `UsersEducation`(`Users_Id`,`Education_Id`) values (17,2);
insert  into `UsersEducation`(`Users_Id`,`Education_Id`) values (17,16);
insert  into `UsersEducation`(`Users_Id`,`Education_Id`) values (17,15);
insert  into `UsersEducation`(`Users_Id`,`Education_Id`) values (18,10);
insert  into `UsersEducation`(`Users_Id`,`Education_Id`) values (18,9);
insert  into `UsersEducation`(`Users_Id`,`Education_Id`) values (18,14);
insert  into `UsersEducation`(`Users_Id`,`Education_Id`) values (19,12);
insert  into `UsersEducation`(`Users_Id`,`Education_Id`) values (19,1);
insert  into `UsersEducation`(`Users_Id`,`Education_Id`) values (19,15);
insert  into `UsersEducation`(`Users_Id`,`Education_Id`) values (20,13);
insert  into `UsersEducation`(`Users_Id`,`Education_Id`) values (20,14);
insert  into `UsersEducation`(`Users_Id`,`Education_Id`) values (20,1);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
