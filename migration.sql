DROP DATABASE IF EXISTS `workshopx-engineering-challenges`;
CREATE DATABASE `workshopx-engineering-challenges`;
USE `workshopx-engineering-challenges`;
GRANT ALL PRIVILEGES ON `workshopx-engineering-challenges`.* TO 'devops'@'%';

CREATE TABLE `companies` (
  `company_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `key` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `url` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_modified` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`company_id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `companies` ( `company_id`, `key`, `name`, `url` ) VALUES
  ( 1, 'crated', 'Crated', 'https://crated.com' ),
  ( 2, 'canvaspop', 'Canvaspop', 'http://www.canvaspop.com' ),
  ( 3, 'canvaspop-api', 'Canvaspop API', 'http://www.canvaspop.com/photo-printing-api' ),
  ( 4, 'dna11', 'DNA11', 'http://www.dna11.com' ),
  ( 5, 'popkey', 'PopKey', 'http://www.popkey.co' );