/*
SQLyog Ultimate v12.14 (64 bit)
MySQL - 5.7.36-0ubuntu0.18.04.1 : Database - db_simjapel
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`db_simjapel` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `db_simjapel`;

/*Table structure for table `sys_controller` */

DROP TABLE IF EXISTS `sys_controller`;

CREATE TABLE `sys_controller` (
  `controller_id` int(11) NOT NULL AUTO_INCREMENT,
  `module_id` int(11) NOT NULL,
  `controller_nama` varchar(100) NOT NULL,
  `created_by` int(11) unsigned DEFAULT NULL,
  `created_time` datetime DEFAULT NULL,
  `updated_by` int(11) unsigned DEFAULT NULL,
  `updated_time` datetime DEFAULT NULL,
  PRIMARY KEY (`controller_id`),
  KEY `tbl_controller.module_id_fk` (`module_id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=latin1;

/*Data for the table `sys_controller` */

insert  into `sys_controller`(`controller_id`,`module_id`,`controller_nama`,`created_by`,`created_time`,`updated_by`,`updated_time`) values 
(1,1,'module',1,'2017-03-29 11:20:42',NULL,NULL),
(2,1,'menu',1,'2017-03-29 11:20:42',NULL,NULL),
(3,1,'user',1,'2017-03-29 11:20:42',NULL,NULL),
(4,1,'group',1,'2017-03-29 11:20:42',NULL,NULL),
(5,1,'change_group',1,'2017-03-29 11:20:42',NULL,NULL),
(8,3,'japel_umum_ranap',1,'2021-12-16 21:43:07',1,'2021-12-18 09:57:27'),
(10,4,'japel_bpjs_rajal',1,'2021-12-16 21:45:13',1,'2021-12-18 15:09:28'),
(12,5,'pegawai',1,'2021-12-16 21:48:36',1,'2021-12-16 21:48:36'),
(13,5,'remun',1,'2021-12-16 21:48:53',1,'2021-12-16 21:48:53'),
(17,6,'dashboard_dokter',1,'2021-12-16 22:23:55',1,'2021-12-16 22:23:55'),
(18,3,'japel_umum_rajal',1,'2021-12-18 10:00:25',1,'2021-12-18 10:00:25'),
(19,4,'japel_bpjs_ranap',1,'2021-12-18 15:10:17',1,'2021-12-18 15:10:17');

/*Table structure for table `sys_css_icon` */

DROP TABLE IF EXISTS `sys_css_icon`;

CREATE TABLE `sys_css_icon` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `css_icon_kategori` varchar(50) DEFAULT NULL,
  `css_icon_nama` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=440 DEFAULT CHARSET=latin1;

/*Data for the table `sys_css_icon` */

insert  into `sys_css_icon`(`id`,`css_icon_kategori`,`css_icon_nama`) values 
(1,'web application icons','fa-adjust'),
(2,'web application icons','fa-anchor'),
(3,'web application icons','fa-archive'),
(4,'web application icons','fa-arrows'),
(5,'web application icons','fa-arrows-h'),
(6,'web application icons','fa-arrows-v'),
(7,'web application icons','fa-asterisk'),
(8,'web application icons','fa-ban'),
(9,'web application icons','fa-bar-chart-o'),
(10,'web application icons','fa-barcode'),
(11,'web application icons','fa-bars'),
(12,'web application icons','fa-beer'),
(13,'web application icons','fa-bell'),
(14,'web application icons','fa-bell-o'),
(15,'web application icons','fa-bolt'),
(16,'web application icons','fa-book'),
(17,'web application icons','fa-bookmark'),
(18,'web application icons','fa-bookmark-o'),
(19,'web application icons','fa-briefcase'),
(20,'web application icons','fa-bug'),
(21,'web application icons','fa-building-o'),
(22,'web application icons','fa-bullhorn'),
(23,'web application icons','fa-bullseye'),
(24,'web application icons','fa-calendar'),
(25,'web application icons','fa-calendar-o'),
(26,'web application icons','fa-camera'),
(27,'web application icons','fa-camera-retro'),
(28,'web application icons','fa-caret-square-o-down'),
(29,'web application icons','fa-caret-square-o-left'),
(30,'web application icons','fa-caret-square-o-right'),
(31,'web application icons','fa-caret-square-o-up'),
(32,'web application icons','fa-certificate'),
(33,'web application icons','fa-check'),
(34,'web application icons','fa-check-circle'),
(35,'web application icons','fa-check-circle-o'),
(36,'web application icons','fa-check-square'),
(37,'web application icons','fa-check-square-o'),
(38,'web application icons','fa-circle'),
(39,'web application icons','fa-circle-o'),
(40,'web application icons','fa-clock-o'),
(41,'web application icons','fa-cloud'),
(42,'web application icons','fa-cloud-download'),
(43,'web application icons','fa-cloud-upload'),
(44,'web application icons','fa-code'),
(45,'web application icons','fa-code-fork'),
(46,'web application icons','fa-coffee'),
(47,'web application icons','fa-cog'),
(48,'web application icons','fa-cogs'),
(49,'web application icons','fa-comment'),
(50,'web application icons','fa-comment-o'),
(51,'web application icons','fa-comments'),
(52,'web application icons','fa-comments-o'),
(53,'web application icons','fa-compass'),
(54,'web application icons','fa-credit-card'),
(55,'web application icons','fa-crop'),
(56,'web application icons','fa-crosshairs'),
(57,'web application icons','fa-cutlery'),
(58,'web application icons','fa-dashboard'),
(59,'web application icons','fa-desktop'),
(60,'web application icons','fa-dot-circle-o'),
(61,'web application icons','fa-download'),
(62,'web application icons','fa-edit'),
(63,'web application icons','fa-ellipsis-h'),
(64,'web application icons','fa-ellipsis-v'),
(65,'web application icons','fa-envelope'),
(66,'web application icons','fa-envelope-o'),
(67,'web application icons','fa-eraser'),
(68,'web application icons','fa-exchange'),
(69,'web application icons','fa-exclamation'),
(70,'web application icons','fa-exclamation-circle'),
(71,'web application icons','fa-exclamation-triangle'),
(72,'web application icons','fa-external-link'),
(73,'web application icons','fa-external-link-square'),
(74,'web application icons','fa-eye'),
(75,'web application icons','fa-eye-slash'),
(76,'web application icons','fa-female'),
(77,'web application icons','fa-fighter-jet'),
(78,'web application icons','fa-film'),
(79,'web application icons','fa-filter'),
(80,'web application icons','fa-fire'),
(81,'web application icons','fa-fire-extinguisher'),
(82,'web application icons','fa-flag'),
(83,'web application icons','fa-flag-checkered'),
(84,'web application icons','fa-flag-o'),
(85,'web application icons','fa-flash'),
(86,'web application icons','fa-flask'),
(87,'web application icons','fa-folder'),
(88,'web application icons','fa-folder-o'),
(89,'web application icons','fa-folder-open'),
(90,'web application icons','fa-folder-open-o'),
(91,'web application icons','fa-frown-o'),
(92,'web application icons','fa-gamepad'),
(93,'web application icons','fa-gavel'),
(94,'web application icons','fa-gear'),
(95,'web application icons','fa-gears'),
(96,'web application icons','fa-gift'),
(97,'web application icons','fa-glass'),
(98,'web application icons','fa-globe'),
(99,'web application icons','fa-group'),
(100,'web application icons','fa-hdd-o'),
(101,'web application icons','fa-headphones'),
(102,'web application icons','fa-heart'),
(103,'web application icons','fa-heart-o'),
(104,'web application icons','fa-home'),
(105,'web application icons','fa-inbox'),
(106,'web application icons','fa-info'),
(107,'web application icons','fa-info-circle'),
(108,'web application icons','fa-key'),
(109,'web application icons','fa-keyboard-o'),
(110,'web application icons','fa-laptop'),
(111,'web application icons','fa-leaf'),
(112,'web application icons','fa-legal'),
(113,'web application icons','fa-lemon-o'),
(114,'web application icons','fa-level-down'),
(115,'web application icons','fa-level-up'),
(116,'web application icons','fa-lightbulb-o'),
(117,'web application icons','fa-location-arrow'),
(118,'web application icons','fa-lock'),
(119,'web application icons','fa-magic'),
(120,'web application icons','fa-magnet'),
(121,'web application icons','fa-mail-forward'),
(122,'web application icons','fa-mail-reply'),
(123,'web application icons','fa-mail-reply-all'),
(124,'web application icons','fa-male'),
(125,'web application icons','fa-map-marker'),
(126,'web application icons','fa-meh-o'),
(127,'web application icons','fa-microphone'),
(128,'web application icons','fa-microphone-slash'),
(129,'web application icons','fa-minus'),
(130,'web application icons','fa-minus-circle'),
(131,'web application icons','fa-minus-square'),
(132,'web application icons','fa-minus-square-o'),
(133,'web application icons','fa-mobile'),
(134,'web application icons','fa-mobile-phone'),
(135,'web application icons','fa-money'),
(136,'web application icons','fa-moon-o'),
(137,'web application icons','fa-music'),
(138,'web application icons','fa-pencil'),
(139,'web application icons','fa-pencil-square'),
(140,'web application icons','fa-pencil-square-o'),
(141,'web application icons','fa-phone'),
(142,'web application icons','fa-phone-square'),
(143,'web application icons','fa-picture-o'),
(144,'web application icons','fa-plane'),
(145,'web application icons','fa-plus'),
(146,'web application icons','fa-plus-circle'),
(147,'web application icons','fa-plus-square'),
(148,'web application icons','fa-plus-square-o'),
(149,'web application icons','fa-power-off'),
(150,'web application icons','fa-print'),
(151,'web application icons','fa-puzzle-piece'),
(152,'web application icons','fa-qrcode'),
(153,'web application icons','fa-question'),
(154,'web application icons','fa-question-circle'),
(155,'web application icons','fa-quote-left'),
(156,'web application icons','fa-quote-right'),
(157,'web application icons','fa-random'),
(158,'web application icons','fa-refresh'),
(159,'web application icons','fa-reply'),
(160,'web application icons','fa-reply-all'),
(161,'web application icons','fa-retweet'),
(162,'web application icons','fa-road'),
(163,'web application icons','fa-rocket'),
(164,'web application icons','fa-rss'),
(165,'web application icons','fa-rss-square'),
(166,'web application icons','fa-search'),
(167,'web application icons','fa-search-minus'),
(168,'web application icons','fa-search-plus'),
(169,'web application icons','fa-share'),
(170,'web application icons','fa-share-square'),
(171,'web application icons','fa-share-square-o'),
(172,'web application icons','fa-shield'),
(173,'web application icons','fa-shopping-cart'),
(174,'web application icons','fa-sign-in'),
(175,'web application icons','fa-sign-out'),
(176,'web application icons','fa-signal'),
(177,'web application icons','fa-sitemap'),
(178,'web application icons','fa-smile-o'),
(179,'web application icons','fa-sort'),
(180,'web application icons','fa-sort-alpha-asc'),
(181,'web application icons','fa-sort-alpha-desc'),
(182,'web application icons','fa-sort-amount-asc'),
(183,'web application icons','fa-sort-amount-desc'),
(184,'web application icons','fa-sort-asc'),
(185,'web application icons','fa-sort-desc'),
(186,'web application icons','fa-sort-down'),
(187,'web application icons','fa-sort-numeric-asc'),
(188,'web application icons','fa-sort-numeric-desc'),
(189,'web application icons','fa-sort-up'),
(190,'web application icons','fa-spinner'),
(191,'web application icons','fa-square'),
(192,'web application icons','fa-square-o'),
(193,'web application icons','fa-star'),
(194,'web application icons','fa-star-half'),
(195,'web application icons','fa-star-half-empty'),
(196,'web application icons','fa-star-half-full'),
(197,'web application icons','fa-star-half-o'),
(198,'web application icons','fa-star-o'),
(199,'web application icons','fa-subscript'),
(200,'web application icons','fa-suitcase'),
(201,'web application icons','fa-sun-o'),
(202,'web application icons','fa-superscript'),
(203,'web application icons','fa-tablet'),
(204,'web application icons','fa-tachometer'),
(205,'web application icons','fa-tag'),
(206,'web application icons','fa-tags'),
(207,'web application icons','fa-tasks'),
(208,'web application icons','fa-terminal'),
(209,'web application icons','fa-thumb-tack'),
(210,'web application icons','fa-thumbs-down'),
(211,'web application icons','fa-thumbs-o-down'),
(212,'web application icons','fa-thumbs-o-up'),
(213,'web application icons','fa-thumbs-up'),
(214,'web application icons','fa-ticket'),
(215,'web application icons','fa-times'),
(216,'web application icons','fa-times-circle'),
(217,'web application icons','fa-times-circle-o'),
(218,'web application icons','fa-tint'),
(219,'web application icons','fa-toggle-down'),
(220,'web application icons','fa-toggle-left'),
(221,'web application icons','fa-toggle-right'),
(222,'web application icons','fa-toggle-up'),
(223,'web application icons','fa-trash-o'),
(224,'web application icons','fa-trophy'),
(225,'web application icons','fa-truck'),
(226,'web application icons','fa-umbrella'),
(227,'web application icons','fa-unlock'),
(228,'web application icons','fa-unlock-alt'),
(229,'web application icons','fa-unsorted'),
(230,'web application icons','fa-upload'),
(231,'web application icons','fa-user'),
(232,'web application icons','fa-users'),
(233,'web application icons','fa-video-camera'),
(234,'web application icons','fa-volume-down'),
(235,'web application icons','fa-volume-off'),
(236,'web application icons','fa-volume-up'),
(237,'web application icons','fa-warning'),
(238,'web application icons','fa-wheelchair'),
(239,'web application icons','fa-wrench'),
(240,'form control icons','fa-check-square'),
(241,'form control icons','fa-check-square-o'),
(242,'form control icons','fa-circle'),
(243,'form control icons','fa-circle-o'),
(244,'form control icons','fa-dot-circle-o'),
(245,'form control icons','fa-minus-square'),
(246,'form control icons','fa-minus-square-o'),
(247,'form control icons','fa-plus-square'),
(248,'form control icons','fa-plus-square-o'),
(249,'form control icons','fa-square'),
(250,'form control icons','fa-square-o'),
(251,'currency icons','fa-bitcoin'),
(252,'currency icons','fa-btc'),
(253,'currency icons','fa-cny'),
(254,'currency icons','fa-dollar'),
(255,'currency icons','fa-eur'),
(256,'currency icons','fa-euro'),
(257,'currency icons','fa-gbp'),
(258,'currency icons','fa-inr'),
(259,'currency icons','fa-jpy'),
(260,'currency icons','fa-krw'),
(261,'currency icons','fa-money'),
(262,'currency icons','fa-rmb'),
(263,'currency icons','fa-rouble'),
(264,'currency icons','fa-rub'),
(265,'currency icons','fa-ruble'),
(266,'currency icons','fa-rupee'),
(267,'currency icons','fa-try'),
(268,'currency icons','fa-turkish-lira'),
(269,'currency icons','fa-usd'),
(270,'currency icons','fa-won'),
(271,'currency icons','fa-yen'),
(272,'text editor icons','fa-align-center'),
(273,'text editor icons','fa-align-justify'),
(274,'text editor icons','fa-align-left'),
(275,'text editor icons','fa-align-right'),
(276,'text editor icons','fa-bold'),
(277,'text editor icons','fa-chain'),
(278,'text editor icons','fa-chain-broken'),
(279,'text editor icons','fa-clipboard'),
(280,'text editor icons','fa-columns'),
(281,'text editor icons','fa-copy'),
(282,'text editor icons','fa-cut'),
(283,'text editor icons','fa-dedent'),
(284,'text editor icons','fa-eraser'),
(285,'text editor icons','fa-file'),
(286,'text editor icons','fa-file-o'),
(287,'text editor icons','fa-file-text'),
(288,'text editor icons','fa-file-text-o'),
(289,'text editor icons','fa-files-o'),
(290,'text editor icons','fa-floppy-o'),
(291,'text editor icons','fa-font'),
(292,'text editor icons','fa-indent'),
(293,'text editor icons','fa-italic'),
(294,'text editor icons','fa-link'),
(295,'text editor icons','fa-list'),
(296,'text editor icons','fa-list-alt'),
(297,'text editor icons','fa-list-ol'),
(298,'text editor icons','fa-list-ul'),
(299,'text editor icons','fa-outdent'),
(300,'text editor icons','fa-paperclip'),
(301,'text editor icons','fa-paste'),
(302,'text editor icons','fa-repeat'),
(303,'text editor icons','fa-rotate-left'),
(304,'text editor icons','fa-rotate-right'),
(305,'text editor icons','fa-save'),
(306,'text editor icons','fa-scissors'),
(307,'text editor icons','fa-strikethrough'),
(308,'text editor icons','fa-table'),
(309,'text editor icons','fa-text-height'),
(310,'text editor icons','fa-text-width'),
(311,'text editor icons','fa-th'),
(312,'text editor icons','fa-th-large'),
(313,'text editor icons','fa-th-list'),
(314,'text editor icons','fa-underline'),
(315,'text editor icons','fa-undo'),
(316,'text editor icons','fa-unlink'),
(317,'directional icons','fa-angle-double-down'),
(318,'directional icons','fa-angle-double-left'),
(319,'directional icons','fa-angle-double-right'),
(320,'directional icons','fa-angle-double-up'),
(321,'directional icons','fa-angle-down'),
(322,'directional icons','fa-angle-left'),
(323,'directional icons','fa-angle-right'),
(324,'directional icons','fa-angle-up'),
(325,'directional icons','fa-arrow-circle-down'),
(326,'directional icons','fa-arrow-circle-left'),
(327,'directional icons','fa-arrow-circle-o-down'),
(328,'directional icons','fa-arrow-circle-o-left'),
(329,'directional icons','fa-arrow-circle-o-right'),
(330,'directional icons','fa-arrow-circle-o-up'),
(331,'directional icons','fa-arrow-circle-right'),
(332,'directional icons','fa-arrow-circle-up'),
(333,'directional icons','fa-arrow-down'),
(334,'directional icons','fa-arrow-left'),
(335,'directional icons','fa-arrow-right'),
(336,'directional icons','fa-arrow-up'),
(337,'directional icons','fa-arrows'),
(338,'directional icons','fa-arrows-alt'),
(339,'directional icons','fa-arrows-h'),
(340,'directional icons','fa-arrows-v'),
(341,'directional icons','fa-caret-down'),
(342,'directional icons','fa-caret-left'),
(343,'directional icons','fa-caret-right'),
(344,'directional icons','fa-caret-square-o-down'),
(345,'directional icons','fa-caret-square-o-left'),
(346,'directional icons','fa-caret-square-o-right'),
(347,'directional icons','fa-caret-square-o-up'),
(348,'directional icons','fa-caret-up'),
(349,'directional icons','fa-chevron-circle-down'),
(350,'directional icons','fa-chevron-circle-left'),
(351,'directional icons','fa-chevron-circle-right'),
(352,'directional icons','fa-chevron-circle-up'),
(353,'directional icons','fa-chevron-down'),
(354,'directional icons','fa-chevron-left'),
(355,'directional icons','fa-chevron-right'),
(356,'directional icons','fa-chevron-up'),
(357,'directional icons','fa-hand-o-down'),
(358,'directional icons','fa-hand-o-left'),
(359,'directional icons','fa-hand-o-right'),
(360,'directional icons','fa-hand-o-up'),
(361,'directional icons','fa-long-arrow-down'),
(362,'directional icons','fa-long-arrow-left'),
(363,'directional icons','fa-long-arrow-right'),
(364,'directional icons','fa-long-arrow-up'),
(365,'directional icons','fa-toggle-down'),
(366,'directional icons','fa-toggle-left'),
(367,'directional icons','fa-toggle-right'),
(368,'directional icons','fa-toggle-up'),
(369,'video player icons','fa-arrows-alt'),
(370,'video player icons','fa-backward'),
(371,'video player icons','fa-compress'),
(372,'video player icons','fa-eject'),
(373,'video player icons','fa-expand'),
(374,'video player icons','fa-fast-backward'),
(375,'video player icons','fa-fast-forward'),
(376,'video player icons','fa-forward'),
(377,'video player icons','fa-pause'),
(378,'video player icons','fa-play'),
(379,'video player icons','fa-play-circle'),
(380,'video player icons','fa-play-circle-o'),
(381,'video player icons','fa-step-backward'),
(382,'video player icons','fa-step-forward'),
(383,'video player icons','fa-stop'),
(384,'video player icons','fa-youtube-play'),
(385,'brand icons','fa-adn'),
(386,'brand icons','fa-android'),
(387,'brand icons','fa-apple'),
(388,'brand icons','fa-bitbucket'),
(389,'brand icons','fa-bitbucket-square'),
(390,'brand icons','fa-bitcoin'),
(391,'brand icons','fa-btc'),
(392,'brand icons','fa-css3'),
(393,'brand icons','fa-dribbble'),
(394,'brand icons','fa-dropbox'),
(395,'brand icons','fa-facebook'),
(396,'brand icons','fa-facebook-square'),
(397,'brand icons','fa-flickr'),
(398,'brand icons','fa-foursquare'),
(399,'brand icons','fa-github'),
(400,'brand icons','fa-github-alt'),
(401,'brand icons','fa-github-square'),
(402,'brand icons','fa-gittip'),
(403,'brand icons','fa-google-plus'),
(404,'brand icons','fa-google-plus-square'),
(405,'brand icons','fa-html5'),
(406,'brand icons','fa-instagram'),
(407,'brand icons','fa-linkedin'),
(408,'brand icons','fa-linkedin-square'),
(409,'brand icons','fa-linux'),
(410,'brand icons','fa-maxcdn'),
(411,'brand icons','fa-pagelines'),
(412,'brand icons','fa-pinterest'),
(413,'brand icons','fa-pinterest-square'),
(414,'brand icons','fa-renren'),
(415,'brand icons','fa-skype'),
(416,'brand icons','fa-stack-exchange'),
(417,'brand icons','fa-stack-overflow'),
(418,'brand icons','fa-trello'),
(419,'brand icons','fa-tumblr'),
(420,'brand icons','fa-tumblr-square'),
(421,'brand icons','fa-twitter'),
(422,'brand icons','fa-twitter-square'),
(423,'brand icons','fa-vimeo-square'),
(424,'brand icons','fa-vk'),
(425,'brand icons','fa-weibo'),
(426,'brand icons','fa-windows'),
(427,'brand icons','fa-xing'),
(428,'brand icons','fa-xing-square'),
(429,'brand icons','fa-youtube'),
(430,'brand icons','fa-youtube-play'),
(431,'brand icons','fa-youtube-square'),
(432,'medical icons','fa-ambulance'),
(433,'medical icons','fa-h-square'),
(434,'medical icons','fa-hospital-o'),
(435,'medical icons','fa-medkit'),
(436,'medical icons','fa-plus-square'),
(437,'medical icons','fa-stethoscope'),
(438,'medical icons','fa-user-md'),
(439,'medical icons','fa-wheelchair');

/*Table structure for table `sys_group_menu` */

DROP TABLE IF EXISTS `sys_group_menu`;

CREATE TABLE `sys_group_menu` (
  `group_menu_id` int(11) NOT NULL AUTO_INCREMENT,
  `group_menu_nama` varchar(100) NOT NULL,
  `created_by` int(11) unsigned DEFAULT NULL,
  `created_time` datetime DEFAULT NULL,
  `updated_by` int(11) unsigned DEFAULT NULL,
  `updated_time` datetime DEFAULT NULL,
  PRIMARY KEY (`group_menu_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Data for the table `sys_group_menu` */

insert  into `sys_group_menu`(`group_menu_id`,`group_menu_nama`,`created_by`,`created_time`,`updated_by`,`updated_time`) values 
(1,'Superadmin',NULL,NULL,NULL,NULL),
(2,'Dokter',NULL,NULL,1,'2021-12-18 15:23:35'),
(3,'Keuangan',NULL,NULL,1,'2021-12-18 15:11:49');

/*Table structure for table `sys_group_menu_detail` */

DROP TABLE IF EXISTS `sys_group_menu_detail`;

CREATE TABLE `sys_group_menu_detail` (
  `group_menu_detail_id` int(11) NOT NULL AUTO_INCREMENT,
  `group_menu_id` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL,
  `group_menu_detail_module_permissions` varchar(4) NOT NULL DEFAULT '',
  `created_by` int(11) unsigned DEFAULT NULL,
  `created_time` datetime DEFAULT NULL,
  `updated_by` int(11) unsigned DEFAULT NULL,
  `updated_time` datetime DEFAULT NULL,
  PRIMARY KEY (`group_menu_detail_id`),
  KEY `ugmfw_group_menu_detil.group_menu_id_fk` (`group_menu_id`),
  KEY `ugmfw_group_menu_detil.menu_id_fk` (`menu_id`),
  CONSTRAINT `sys_group_menu_detail_ibfk_1` FOREIGN KEY (`group_menu_id`) REFERENCES `sys_group_menu` (`group_menu_id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=53 DEFAULT CHARSET=latin1;

/*Data for the table `sys_group_menu_detail` */

insert  into `sys_group_menu_detail`(`group_menu_detail_id`,`group_menu_id`,`menu_id`,`group_menu_detail_module_permissions`,`created_by`,`created_time`,`updated_by`,`updated_time`) values 
(1,1,1,'crud',NULL,NULL,NULL,NULL),
(2,1,2,'crud',NULL,NULL,NULL,NULL),
(3,1,3,'crud',NULL,NULL,NULL,NULL),
(4,1,4,'crud',NULL,NULL,NULL,NULL),
(5,1,5,'crud',NULL,NULL,NULL,NULL),
(34,3,13,'',1,'2021-12-18 15:11:49',1,'2021-12-18 15:11:49'),
(35,3,14,'',1,'2021-12-18 15:11:49',1,'2021-12-18 15:11:49'),
(36,3,15,'crud',1,'2021-12-18 15:11:49',1,'2021-12-18 15:11:49'),
(37,3,16,'crud',1,'2021-12-18 15:11:49',1,'2021-12-18 15:11:49'),
(38,3,12,'crud',1,'2021-12-18 15:11:49',1,'2021-12-18 15:11:49'),
(39,3,7,'crud',1,'2021-12-18 15:11:49',1,'2021-12-18 15:11:49'),
(40,3,8,'',1,'2021-12-18 15:11:49',1,'2021-12-18 15:11:49'),
(41,3,17,'crud',1,'2021-12-18 15:11:49',1,'2021-12-18 15:11:49'),
(42,3,18,'crud',1,'2021-12-18 15:11:49',1,'2021-12-18 15:11:49'),
(43,3,9,'',1,'2021-12-18 15:11:49',1,'2021-12-18 15:11:49'),
(44,3,19,'crud',1,'2021-12-18 15:11:49',1,'2021-12-18 15:11:49'),
(45,3,20,'crud',1,'2021-12-18 15:11:49',1,'2021-12-18 15:11:49'),
(46,2,6,'crud',1,'2021-12-18 15:23:35',1,'2021-12-18 15:23:35'),
(47,2,8,'',1,'2021-12-18 15:23:35',1,'2021-12-18 15:23:35'),
(48,2,17,'crud',1,'2021-12-18 15:23:35',1,'2021-12-18 15:23:35'),
(49,2,18,'crud',1,'2021-12-18 15:23:35',1,'2021-12-18 15:23:35'),
(50,2,9,'',1,'2021-12-18 15:23:35',1,'2021-12-18 15:23:35'),
(51,2,19,'crud',1,'2021-12-18 15:23:35',1,'2021-12-18 15:23:35'),
(52,2,20,'crud',1,'2021-12-18 15:23:35',1,'2021-12-18 15:23:35');

/*Table structure for table `sys_log_access` */

DROP TABLE IF EXISTS `sys_log_access`;

CREATE TABLE `sys_log_access` (
  `log_id` int(11) NOT NULL AUTO_INCREMENT,
  `log_user_id` int(11) unsigned DEFAULT NULL,
  `log_username` varchar(100) DEFAULT NULL,
  `log_url` longtext,
  `log_time` datetime DEFAULT NULL,
  PRIMARY KEY (`log_id`),
  KEY `ugmfw_log_access_log_user_id_fk` (`log_user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `sys_log_access` */

/*Table structure for table `sys_log_login` */

DROP TABLE IF EXISTS `sys_log_login`;

CREATE TABLE `sys_log_login` (
  `log_login_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) unsigned DEFAULT NULL,
  `user_username` varchar(200) DEFAULT NULL,
  `user_agent` text,
  `created_time` datetime DEFAULT NULL,
  PRIMARY KEY (`log_login_id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `sys_log_login_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `sys_user` (`user_id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

/*Data for the table `sys_log_login` */

insert  into `sys_log_login`(`log_login_id`,`user_id`,`user_username`,`user_agent`,`created_time`) values 
(1,1,'admin','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/96.0.4664.45 Safari/537.36','2021-12-15 01:15:15'),
(2,1,'admin','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/96.0.4664.45 Safari/537.36','2021-12-15 01:23:34'),
(3,1,'admin','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/96.0.4664.45 Safari/537.36','2021-12-15 01:33:17'),
(4,1,'admin','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/96.0.4664.45 Safari/537.36','2021-12-16 22:20:38'),
(5,1,'admin','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/96.0.4664.45 Safari/537.36','2021-12-16 22:21:52'),
(6,1,'admin','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/96.0.4664.45 Safari/537.36','2021-12-16 22:23:30'),
(7,1,'admin','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/96.0.4664.45 Safari/537.36','2021-12-16 23:29:37'),
(8,1,'admin','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/96.0.4664.45 Safari/537.36','2021-12-17 00:23:03'),
(9,1,'admin','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/96.0.4664.45 Safari/537.36','2021-12-17 00:34:02'),
(10,1,'admin','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/96.0.4664.45 Safari/537.36','2021-12-18 10:28:32'),
(11,1,'admin','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/96.0.4664.45 Safari/537.36','2021-12-18 15:26:26'),
(12,2,'dokter','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/96.0.4664.45 Safari/537.36','2021-12-18 15:27:10');

/*Table structure for table `sys_menu` */

DROP TABLE IF EXISTS `sys_menu`;

CREATE TABLE `sys_menu` (
  `menu_id` int(11) NOT NULL AUTO_INCREMENT,
  `menu_parent_id` int(11) DEFAULT '0',
  `menu_nama` varchar(100) NOT NULL,
  `menu_sequence` tinyint(3) NOT NULL,
  `module_detail_id` int(11) DEFAULT NULL,
  `module_id` int(11) DEFAULT NULL,
  `controller_id` int(11) DEFAULT NULL,
  `menu_css_clip` varchar(50) DEFAULT NULL,
  `menu_label` varchar(15) DEFAULT NULL,
  `menu_is_aktif` tinyint(4) DEFAULT '1',
  `menu_css_label` varchar(50) DEFAULT NULL,
  `menu_level` int(1) DEFAULT NULL,
  `menu_as_menu` enum('0','1') DEFAULT '1',
  `created_by` int(11) unsigned DEFAULT NULL,
  `created_time` datetime DEFAULT NULL,
  `updated_by` int(11) unsigned DEFAULT NULL,
  `updated_time` datetime DEFAULT NULL,
  PRIMARY KEY (`menu_id`),
  UNIQUE KEY `menu_nama_idx` (`menu_nama`),
  KEY `ugmfw_menu.module_detil_id_fk` (`module_detail_id`),
  KEY `ugmfw_menu.module_id` (`module_id`),
  KEY `ugmfw_menu.controller_id_fk` (`controller_id`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=latin1;

/*Data for the table `sys_menu` */

insert  into `sys_menu`(`menu_id`,`menu_parent_id`,`menu_nama`,`menu_sequence`,`module_detail_id`,`module_id`,`controller_id`,`menu_css_clip`,`menu_label`,`menu_is_aktif`,`menu_css_label`,`menu_level`,`menu_as_menu`,`created_by`,`created_time`,`updated_by`,`updated_time`) values 
(1,0,'Pengaturan Admin',5,NULL,NULL,NULL,'fa-cog',NULL,1,NULL,NULL,'1',1,'2015-04-01 14:11:40',NULL,NULL),
(2,1,'User',1,NULL,1,3,'fa-user',NULL,1,NULL,NULL,'1',1,'2015-04-01 14:11:40',NULL,NULL),
(3,1,'Menu',3,NULL,1,2,'fa-tasks',NULL,1,NULL,NULL,'1',1,'2015-04-01 14:11:40',NULL,NULL),
(4,1,'Group',4,NULL,1,4,'fa-group',NULL,1,NULL,NULL,'1',1,'2015-04-01 14:11:40',NULL,NULL),
(5,1,'Module',2,NULL,1,1,'fa-maxcdn',NULL,1,NULL,NULL,'1',1,'2016-07-19 08:29:56',NULL,NULL),
(6,0,'Dashboard Dokter',6,NULL,3,15,'fa-angle-double-right',NULL,1,NULL,NULL,'1',1,'2021-12-15 02:04:01',1,'2021-12-16 22:21:25'),
(7,0,'Dashboard Keuangan',7,NULL,4,16,'fa-angle-double-right',NULL,1,NULL,NULL,'1',1,'2021-12-16 21:57:38',1,'2021-12-16 21:57:38'),
(8,0,'Japel Umum',8,NULL,NULL,NULL,'fa-angle-double-right',NULL,1,NULL,NULL,'1',1,'2021-12-16 21:58:30',1,'2021-12-18 10:26:05'),
(9,0,'Japel BPJS',9,NULL,NULL,NULL,'fa-angle-double-right',NULL,1,NULL,NULL,'1',1,'2021-12-16 21:58:51',1,'2021-12-18 15:06:43'),
(10,0,'Japel Umum Keuangan',10,NULL,NULL,NULL,'fa-angle-double-right',NULL,1,NULL,NULL,'1',1,'2021-12-16 21:59:18',1,'2021-12-18 00:50:24'),
(11,0,'Japel BPJS Keuangan',11,NULL,NULL,NULL,'fa-angle-double-right',NULL,1,NULL,NULL,'1',1,'2021-12-16 21:59:59',1,'2021-12-18 00:50:32'),
(12,0,'Japel Non Dokter',12,NULL,4,14,'fa-angle-double-right',NULL,1,NULL,NULL,'1',1,'2021-12-16 22:02:31',1,'2021-12-16 22:02:31'),
(13,0,'Manajemen Data',13,NULL,NULL,NULL,'fa-angle-double-right',NULL,1,NULL,NULL,'1',1,'2021-12-16 22:02:46',1,'2021-12-16 22:02:46'),
(14,13,'Pegawai',1,NULL,NULL,NULL,'fa-angle-double-right',NULL,1,NULL,NULL,'1',1,'2021-12-16 22:04:31',1,'2021-12-16 22:04:31'),
(15,14,'Biodata',1,NULL,5,12,'fa-angle-right',NULL,1,NULL,NULL,'1',1,'2021-12-16 22:05:37',1,'2021-12-16 22:05:37'),
(16,14,'Remun',2,NULL,5,13,'fa-angle-right',NULL,1,NULL,NULL,'1',1,'2021-12-16 22:06:12',1,'2021-12-16 22:06:12'),
(17,8,'Rawat Jalan',1,NULL,3,18,'fa-angle-right',NULL,1,NULL,NULL,'1',1,'2021-12-18 00:51:00',1,'2021-12-18 10:01:52'),
(18,8,'Rawat Inap',2,NULL,3,8,'fa-angle-right',NULL,1,NULL,NULL,'1',1,'2021-12-18 00:51:26',1,'2021-12-18 14:45:58'),
(19,9,' Rawat Jalan',1,NULL,4,10,'fa-angle-right',NULL,1,NULL,NULL,'1',1,'2021-12-18 00:52:36',1,'2021-12-18 15:11:21'),
(20,9,' Rawat Inap',2,NULL,4,19,'fa-angle-right',NULL,1,NULL,NULL,'1',1,'2021-12-18 00:54:31',1,'2021-12-18 15:11:38'),
(21,10,'  Rawat Jalan',1,66,4,11,'fa-angle-right',NULL,1,NULL,NULL,'1',1,'2021-12-18 00:55:30',1,'2021-12-18 00:55:30'),
(22,10,'  Rawat Inap',2,51,4,11,'fa-angle-right',NULL,1,NULL,NULL,'1',1,'2021-12-18 00:56:08',1,'2021-12-18 00:56:08'),
(23,11,'   Rawat Jalan',1,64,4,10,'fa-angle-right',NULL,1,NULL,NULL,'1',1,'2021-12-18 00:56:51',1,'2021-12-18 00:56:51'),
(24,11,'   Rawat Inap',2,48,4,10,'fa-angle-right',NULL,1,NULL,NULL,'1',1,'2021-12-18 00:57:26',1,'2021-12-18 00:57:26');

/*Table structure for table `sys_module` */

DROP TABLE IF EXISTS `sys_module`;

CREATE TABLE `sys_module` (
  `module_id` int(11) NOT NULL AUTO_INCREMENT,
  `module_nama` varchar(100) NOT NULL,
  `created_by` int(11) unsigned DEFAULT NULL,
  `created_time` datetime DEFAULT NULL,
  `updated_by` int(11) unsigned DEFAULT NULL,
  `updated_time` datetime DEFAULT NULL,
  PRIMARY KEY (`module_id`),
  UNIQUE KEY `module_nama_idx` (`module_nama`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

/*Data for the table `sys_module` */

insert  into `sys_module`(`module_id`,`module_nama`,`created_by`,`created_time`,`updated_by`,`updated_time`) values 
(1,'sys',1,'2016-07-19 08:12:52',NULL,NULL),
(3,'japel_umum',1,'2021-12-16 21:42:27',1,'2021-12-18 10:29:01'),
(4,'japel_bpjs',1,'2021-12-16 21:44:45',1,'2021-12-18 15:07:21'),
(5,'manajemen_data',1,'2021-12-16 21:48:12',1,'2021-12-16 21:48:12'),
(6,'dashboard',1,'2021-12-16 22:23:46',1,'2021-12-16 22:23:46');

/*Table structure for table `sys_module_detail` */

DROP TABLE IF EXISTS `sys_module_detail`;

CREATE TABLE `sys_module_detail` (
  `module_detail_id` int(11) NOT NULL AUTO_INCREMENT,
  `module_id` int(11) NOT NULL,
  `controller_id` int(11) NOT NULL,
  `module_detail_function` varchar(100) NOT NULL,
  `module_detail_title` varchar(100) DEFAULT NULL,
  `module_detail_page_css_clip` varchar(100) DEFAULT NULL,
  `module_detail_page_title` varchar(100) DEFAULT NULL,
  `module_detail_permissions` varchar(4) DEFAULT 'xrxx',
  `module_detail_is_ajax` tinyint(1) DEFAULT '0',
  `module_detail_keterangan` varchar(100) DEFAULT NULL,
  `created_by` int(11) unsigned DEFAULT NULL,
  `created_time` datetime DEFAULT NULL,
  `updated_by` int(11) unsigned DEFAULT NULL,
  `updated_time` datetime DEFAULT NULL,
  PRIMARY KEY (`module_detail_id`),
  UNIQUE KEY `ugmfw_module_detil.module_detil_function_idx` (`module_id`,`module_detail_function`,`controller_id`),
  KEY `ugmfw_module_detil.controller_id_fk` (`controller_id`)
) ENGINE=InnoDB AUTO_INCREMENT=72 DEFAULT CHARSET=latin1;

/*Data for the table `sys_module_detail` */

insert  into `sys_module_detail`(`module_detail_id`,`module_id`,`controller_id`,`module_detail_function`,`module_detail_title`,`module_detail_page_css_clip`,`module_detail_page_title`,`module_detail_permissions`,`module_detail_is_ajax`,`module_detail_keterangan`,`created_by`,`created_time`,`updated_by`,`updated_time`) values 
(1,1,1,'update_module_proses','Ubah Module','fa-edit','Ubah Module','xrux',0,NULL,1,'2016-07-19 08:27:29',NULL,NULL),
(2,1,3,'add_user','Tambah User','fa-plus-square','Tambah User','crxx',1,NULL,1,'2015-05-05 14:22:13',NULL,NULL),
(3,1,2,'add_menu','Tambah Menu','fa-plus','Tambah menu','crxx',1,NULL,1,'2015-04-27 16:55:52',NULL,NULL),
(4,1,2,'get_controller_by_moduleId',NULL,NULL,NULL,'xrxx',NULL,NULL,1,'2016-07-14 13:58:30',NULL,NULL),
(5,1,1,'update_module','Ubah Module','fa-edit','Ubah Module','xrux',0,NULL,1,'2016-07-19 08:27:29',NULL,NULL),
(6,1,1,'add_controller_proses','Tambah Controller','fa-plus-square','Tambah Controller','crxx',0,NULL,1,'2016-07-19 08:27:29',NULL,NULL),
(7,1,1,'add_function','Tambah Function','fa-plus-square','Tambah Function','crxx',0,NULL,1,'2016-07-19 08:27:29',NULL,NULL),
(8,1,1,'add_function_proses','Tambah Function','fa-plus-square','Tambah Function','crxx',0,NULL,1,'2016-07-19 08:27:29',NULL,NULL),
(9,1,1,'add_module','Tambah Module','fa-plus-square','Tambah Module','crxx',0,NULL,1,'2016-07-19 08:27:29',NULL,NULL),
(10,1,3,'view_user','Daftar User','fa-list','Daftar User','xrxx',0,NULL,1,'2015-05-05 14:21:24',NULL,NULL),
(11,1,2,'delete_menu','Hapus Menu',NULL,NULL,'xxxd',NULL,NULL,1,'2015-04-29 14:05:16',NULL,NULL),
(12,1,1,'view_controller','Daftar Controller','fa-list','Daftar Controller','xrxx',0,NULL,1,'2016-07-19 08:27:29',NULL,NULL),
(13,1,1,'view_function','Daftar Function','fa-list','Daftar Function','xrxx',0,NULL,1,'2016-07-19 08:27:29',NULL,NULL),
(14,1,1,'view_module','Daftar Module','fa-list','Daftar Module','xrxx',0,NULL,1,'2016-07-19 08:27:29',NULL,NULL),
(15,1,2,'view_menu','Daftar Menu','fa-list','Daftar Menu','xrxx',0,NULL,1,'2015-04-22 11:38:20',NULL,NULL),
(16,1,2,'get_function_by_controllerId',NULL,NULL,NULL,'xrxx',NULL,NULL,1,'2016-07-14 13:58:44',NULL,NULL),
(17,1,2,'update_menu_proses','Ubah Menu','fa-edit','Ubah Menu','xrux',NULL,NULL,1,'2016-07-14 13:58:10',NULL,NULL),
(18,1,2,'add_menu_proses','Tambah Menu','fa-plus-square','Tambah Menu','crxx',NULL,NULL,1,'2016-07-14 13:57:48',NULL,NULL),
(19,1,2,'update_menu','Ubah Menu','fa-edit','Ubah Menu','xxux',0,NULL,1,'2015-04-29 14:19:30',NULL,NULL),
(20,1,1,'add_module_proses','Tambah Module','fa-plus-square','Tambah Module','crxx',0,NULL,1,'2016-07-19 08:27:29',NULL,NULL),
(21,1,1,'delete_controller',NULL,NULL,NULL,'xrxd',0,NULL,1,'2016-07-19 08:27:29',NULL,NULL),
(22,1,1,'delete_function',NULL,NULL,NULL,'xrxd',0,NULL,1,'2016-07-19 08:27:29',NULL,NULL),
(23,1,4,'update_group_proses','Ubah Group','fa-edit','Ubah Group','xrux',0,NULL,1,'2016-07-20 09:07:35',NULL,NULL),
(24,1,4,'update_group','Ubah Group','fa-edit','Ubah Group','xrux',0,NULL,1,'2016-07-20 09:07:13',NULL,NULL),
(25,1,3,'update_user_proses','Ubah User','fa-edit','Ubah User','xrux',0,NULL,1,'2015-05-05 14:23:57',NULL,NULL),
(26,1,3,'delete_user',NULL,NULL,NULL,'xxxd',0,NULL,1,'2015-05-05 14:24:34',NULL,NULL),
(27,1,3,'validate_user',NULL,NULL,NULL,'xrxx',1,NULL,1,'2015-12-17 14:59:34',NULL,NULL),
(28,1,4,'add_group','Tambah Group','fa-plus-square','Tambah Group','crxx',0,NULL,1,'2016-07-20 09:05:53',NULL,NULL),
(29,1,4,'delete_group',NULL,NULL,NULL,'xxxd',0,NULL,1,'2016-07-20 09:06:47',NULL,NULL),
(30,1,5,'view_change_group','Ganti Group','fa-group','Ganti Grup','xrxx',0,NULL,1,'2016-07-20 09:06:47',NULL,NULL),
(31,1,4,'view_group','Daftar Group','fa-list','Daftar Group','xrxx',0,NULL,1,'2016-07-20 09:08:04',NULL,NULL),
(32,1,2,'update_urutan_menu',NULL,NULL,NULL,'xrux',0,NULL,1,'2016-07-24 17:53:26',NULL,NULL),
(33,1,4,'add_group_proses','Tambah Group','fa-plus-square','Tambah Group','crxx',0,NULL,1,'2016-07-20 09:06:28',NULL,NULL),
(34,1,1,'delete_module',NULL,NULL,NULL,'xrxx',0,NULL,1,'2016-07-19 08:27:29',NULL,NULL),
(35,1,1,'update_controller','Ubah Controller','fa-edit','Ubah Controller','xrux',0,NULL,1,'2016-07-19 08:27:29',NULL,NULL),
(36,1,1,'update_controller_proses','Ubah Controller','fa-edit','Ubah Controller','xrux',0,NULL,1,'2016-07-19 08:27:29',NULL,NULL),
(37,1,1,'update_function','Ubah Function','fa-edit','Ubah Function','xrux',0,NULL,1,'2016-07-19 08:27:29',NULL,NULL),
(38,1,1,'update_function_proses','Ubah Function','fa-edit','Ubah Function','xrux',0,NULL,1,'2016-07-19 08:27:29',NULL,NULL),
(39,1,1,'add_controller','Tambah Controller','fa-plus-square','Tambah Controller','crxx',0,NULL,1,'2016-07-19 08:27:29',NULL,NULL),
(40,1,3,'add_user_proses','Tambah User','fa-plus-square','Tambah User','crxx',0,NULL,1,'2015-05-05 14:22:47',NULL,NULL),
(41,1,3,'update_user','Ubah User','fa-edit','Ubah User','xrux',0,NULL,1,'2015-05-05 14:23:24',NULL,NULL),
(53,5,13,'view','Remun/Index','fa-angle-right','Remun/Index','xrxx',0,NULL,1,'2021-12-16 21:49:28',1,'2021-12-16 21:49:36'),
(54,5,12,'biodata','Biodata Pegawai','fa-angle-right','Biodata Pegawai','xrxx',0,NULL,1,'2021-12-16 21:50:22',1,'2021-12-16 21:50:22'),
(55,5,12,'get_data',NULL,NULL,NULL,'xrxx',0,NULL,1,'2021-12-16 21:50:30',1,'2021-12-16 21:50:30'),
(59,6,17,'view','Dashboard Keuangan','fa-home','Dashboard Keuangan','xrxx',0,NULL,1,'2021-12-16 22:24:11',1,'2021-12-16 22:24:24'),
(62,3,8,'view','Japel Umum Rawat Inap','fa-angle-right','Japel Umum Rawat Inap','xrxx',0,NULL,1,'2021-12-18 00:45:39',1,'2021-12-18 09:57:18'),
(63,3,8,'get_data',NULL,NULL,NULL,'xrxx',0,NULL,1,'2021-12-18 00:46:09',1,'2021-12-18 14:45:01'),
(64,4,10,'view','Japel BPJS Rawat Jalan','fa-angle-right','Japel BPJS Rawat Jalan','xrxx',0,NULL,1,'2021-12-18 00:47:11',1,'2021-12-18 15:09:55'),
(65,4,10,'get_data',NULL,NULL,NULL,'xrxx',0,NULL,1,'2021-12-18 00:47:46',1,'2021-12-18 15:09:39'),
(68,3,18,'view','Japel Umum Rawat Jalan','fa-angle-right','Japel Umum Rawat Jalan','xrxx',0,NULL,1,'2021-12-18 10:01:07',1,'2021-12-18 10:01:07'),
(69,3,18,'get_data',NULL,NULL,NULL,'xrxx',0,NULL,1,'2021-12-18 13:47:43',1,'2021-12-18 13:47:43'),
(70,4,19,'view','Japel BPJS Rawat Inap','fa-angle-right','Japel BPJS Rawat Inap','xrxx',0,NULL,1,'2021-12-18 15:10:39',1,'2021-12-18 15:10:39'),
(71,4,19,'get_data',NULL,NULL,NULL,'xrxx',0,NULL,1,'2021-12-18 15:10:46',1,'2021-12-18 15:10:46');

/*Table structure for table `sys_sessions` */

DROP TABLE IF EXISTS `sys_sessions`;

CREATE TABLE `sys_sessions` (
  `id` varchar(40) NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `timestamp` int(10) unsigned NOT NULL DEFAULT '0',
  `data` mediumblob NOT NULL,
  PRIMARY KEY (`id`),
  KEY `ugmfw_sessions_timestamp` (`timestamp`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `sys_sessions` */

insert  into `sys_sessions`(`id`,`ip_address`,`timestamp`,`data`) values 
('14mjlk3lad92ml11p8b33quslfnit31f','::1',1639799033,'__ci_last_regenerate|i:1639799033;mycaptcha|s:4:\"9284\";__ci_vars|a:1:{s:9:\"mycaptcha\";s:3:\"old\";}__user_id|s:1:\"1\";__username|s:5:\"admin\";__img|N;__unit_id|N;__group_menu_id|s:1:\"3\";__group_menu_nama|s:8:\"Keuangan\";__user_tipe_nomor|s:0:\"\";__nama_lengkap|s:7:\"admin 1\";__email|s:0:\"\";__platform|s:7:\"browser\";_controller|s:4:\"ikon\";'),
('156bujj61atjnrske3d64vesht5svjh1','::1',1639669616,'__ci_last_regenerate|i:1639669616;mycaptcha|s:4:\"6926\";__ci_vars|a:1:{s:9:\"mycaptcha\";s:3:\"old\";}__user_id|s:1:\"1\";__username|s:5:\"admin\";__img|N;__unit_id|N;__group_menu_id|s:1:\"2\";__group_menu_nama|s:6:\"Dokter\";__user_tipe_nomor|s:0:\"\";__nama_lengkap|s:7:\"admin 1\";__email|s:0:\"\";__platform|s:7:\"browser\";'),
('1eha4d5vtcvhibvm7pbuhdatp6ni9p87','::1',1639764783,'__ci_last_regenerate|i:1639764783;mycaptcha|s:4:\"9284\";__ci_vars|a:1:{s:9:\"mycaptcha\";s:3:\"old\";}__user_id|s:1:\"1\";__username|s:5:\"admin\";__img|N;__unit_id|N;__group_menu_id|s:1:\"2\";__group_menu_nama|s:6:\"Dokter\";__user_tipe_nomor|s:0:\"\";__nama_lengkap|s:7:\"admin 1\";__email|s:0:\"\";__platform|s:7:\"browser\";_controller|s:4:\"ikon\";'),
('2dlpl0pinlc79m1ag97hpr5momvprbov','::1',1639680839,'__ci_last_regenerate|i:1639680839;mycaptcha|s:4:\"9284\";__ci_vars|a:1:{s:9:\"mycaptcha\";s:3:\"old\";}__user_id|s:1:\"1\";__username|s:5:\"admin\";__img|N;__unit_id|N;__group_menu_id|s:1:\"1\";__group_menu_nama|s:10:\"Superadmin\";__user_tipe_nomor|s:0:\"\";__nama_lengkap|s:7:\"admin 1\";__email|s:0:\"\";__platform|s:7:\"browser\";_controller|s:6:\"module\";'),
('2h76vlkdcnf6vkf988l80s43dmhmr6u5','::1',1639816566,'__ci_last_regenerate|i:1639816566;mycaptcha|s:4:\"4794\";__ci_vars|a:1:{s:9:\"mycaptcha\";s:3:\"new\";}'),
('2is808r892h2ogmfer60p82tlnnvo82a','::1',1639809143,'__ci_last_regenerate|i:1639809143;mycaptcha|s:4:\"9284\";__ci_vars|a:1:{s:9:\"mycaptcha\";s:3:\"old\";}__user_id|s:1:\"1\";__username|s:5:\"admin\";__img|N;__unit_id|N;__group_menu_id|s:1:\"3\";__group_menu_nama|s:8:\"Keuangan\";__user_tipe_nomor|s:0:\"\";__nama_lengkap|s:7:\"admin 1\";__email|s:0:\"\";__platform|s:7:\"browser\";_controller|s:4:\"ikon\";'),
('362gcvmc7a4ass6d0v5uhbr61l9hvv20','::1',1639674638,'__ci_last_regenerate|i:1639674638;mycaptcha|s:4:\"7922\";__ci_vars|a:1:{s:9:\"mycaptcha\";s:3:\"old\";}__user_id|s:1:\"1\";__username|s:5:\"admin\";__img|N;__unit_id|N;__group_menu_id|s:1:\"1\";__group_menu_nama|s:10:\"Superadmin\";__user_tipe_nomor|N;__nama_lengkap|s:7:\"admin 1\";__email|s:0:\"\";__platform|s:7:\"browser\";'),
('3cgjllhihd03hk0l6ap7dve8uaq5tid4','::1',1639509271,'__ci_last_regenerate|i:1639509271;mycaptcha|s:3:\"258\";__ci_vars|a:1:{s:9:\"mycaptcha\";s:3:\"old\";}__user_id|s:1:\"1\";__username|s:5:\"admin\";__img|N;__unit_id|N;__group_menu_id|s:1:\"1\";__group_menu_nama|s:10:\"Superadmin\";__user_tipe_nomor|N;__nama_lengkap|N;__email|N;__platform|s:7:\"browser\";_controller|s:4:\"ikon\";'),
('3klh22k0cv2robkp78eomo2r9g0b5g9e','::1',1639812693,'__ci_last_regenerate|i:1639812693;mycaptcha|s:4:\"9284\";__ci_vars|a:1:{s:9:\"mycaptcha\";s:3:\"old\";}__user_id|s:1:\"1\";__username|s:5:\"admin\";__img|N;__unit_id|N;__group_menu_id|s:1:\"3\";__group_menu_nama|s:8:\"Keuangan\";__user_tipe_nomor|s:0:\"\";__nama_lengkap|s:7:\"admin 1\";__email|s:0:\"\";__platform|s:7:\"browser\";_controller|s:4:\"ikon\";'),
('3lonbadh6m4tq5vdmvtr3brf2801l4u1','::1',1639809560,'__ci_last_regenerate|i:1639809560;mycaptcha|s:4:\"9284\";__ci_vars|a:1:{s:9:\"mycaptcha\";s:3:\"old\";}__user_id|s:1:\"1\";__username|s:5:\"admin\";__img|N;__unit_id|N;__group_menu_id|s:1:\"3\";__group_menu_nama|s:8:\"Keuangan\";__user_tipe_nomor|s:0:\"\";__nama_lengkap|s:7:\"admin 1\";__email|s:0:\"\";__platform|s:7:\"browser\";_controller|s:4:\"ikon\";'),
('5ruvvqnu2i0vopkmdjulus77fgkfjuva','::1',1639798036,'__ci_last_regenerate|i:1639798036;mycaptcha|s:4:\"9284\";__ci_vars|a:1:{s:9:\"mycaptcha\";s:3:\"old\";}__user_id|s:1:\"1\";__username|s:5:\"admin\";__img|N;__unit_id|N;__group_menu_id|s:1:\"1\";__group_menu_nama|s:10:\"Superadmin\";__user_tipe_nomor|s:0:\"\";__nama_lengkap|s:7:\"admin 1\";__email|s:0:\"\";__platform|s:7:\"browser\";_controller|s:4:\"ikon\";'),
('5ts0m0sga5vpeg046886tn78ll0jv7lb','::1',1639669004,'__ci_last_regenerate|i:1639669004;mycaptcha|s:4:\"6926\";__ci_vars|a:1:{s:9:\"mycaptcha\";s:3:\"old\";}__user_id|s:1:\"1\";__username|s:5:\"admin\";__img|N;__unit_id|N;__group_menu_id|s:1:\"2\";__group_menu_nama|s:6:\"Dokter\";__user_tipe_nomor|s:0:\"\";__nama_lengkap|s:7:\"admin 1\";__email|s:0:\"\";__platform|s:7:\"browser\";'),
('6lnkt5bn11ng49dmsir2cl5g3g1uvc6h','::1',1639676031,'__ci_last_regenerate|i:1639676031;mycaptcha|s:4:\"7922\";__ci_vars|a:1:{s:9:\"mycaptcha\";s:3:\"old\";}__user_id|s:1:\"1\";__username|s:5:\"admin\";__img|N;__unit_id|N;__group_menu_id|s:1:\"2\";__group_menu_nama|s:6:\"Dokter\";__user_tipe_nomor|s:0:\"\";__nama_lengkap|s:7:\"admin 1\";__email|s:0:\"\";__platform|s:7:\"browser\";'),
('6psomjuaqu728lpl01meutijgmsq17ua','::1',1639763883,'__ci_last_regenerate|i:1639763883;mycaptcha|s:4:\"9284\";__ci_vars|a:1:{s:9:\"mycaptcha\";s:3:\"old\";}__user_id|s:1:\"1\";__username|s:5:\"admin\";__img|N;__unit_id|N;__group_menu_id|s:1:\"1\";__group_menu_nama|s:10:\"Superadmin\";__user_tipe_nomor|s:0:\"\";__nama_lengkap|s:7:\"admin 1\";__email|s:0:\"\";__platform|s:7:\"browser\";_controller|s:4:\"ikon\";'),
('7iks68ca80qetbl2pgvb3c6hfom2pf96','::1',1639796194,'__ci_last_regenerate|i:1639796194;mycaptcha|s:4:\"9284\";__ci_vars|a:1:{s:9:\"mycaptcha\";s:3:\"old\";}__user_id|s:1:\"1\";__username|s:5:\"admin\";__img|N;__unit_id|N;__group_menu_id|s:1:\"2\";__group_menu_nama|s:6:\"Dokter\";__user_tipe_nomor|s:0:\"\";__nama_lengkap|s:7:\"admin 1\";__email|s:0:\"\";__platform|s:7:\"browser\";_controller|s:4:\"ikon\";'),
('83essp43kmgkfu8cfsbsvb3nqdcjkdl6','::1',1639504174,'__ci_last_regenerate|i:1639504174;mycaptcha|s:4:\"6231\";__ci_vars|a:1:{s:9:\"mycaptcha\";s:3:\"new\";}'),
('a4bdl0jpped5q6dckr8adftolj0kkqmg','::1',1639810912,'__ci_last_regenerate|i:1639810912;mycaptcha|s:4:\"9284\";__ci_vars|a:1:{s:9:\"mycaptcha\";s:3:\"old\";}__user_id|s:1:\"1\";__username|s:5:\"admin\";__img|N;__unit_id|N;__group_menu_id|s:1:\"3\";__group_menu_nama|s:8:\"Keuangan\";__user_tipe_nomor|s:0:\"\";__nama_lengkap|s:7:\"admin 1\";__email|s:0:\"\";__platform|s:7:\"browser\";_controller|s:4:\"ikon\";'),
('agl6agnd831r3runmjp0mbehs5ac2u54','::1',1639815825,'__ci_last_regenerate|i:1639815825;mycaptcha|s:4:\"9284\";__ci_vars|a:1:{s:9:\"mycaptcha\";s:3:\"old\";}__user_id|s:1:\"1\";__username|s:5:\"admin\";__img|N;__unit_id|N;__group_menu_id|s:1:\"3\";__group_menu_nama|s:8:\"Keuangan\";__user_tipe_nomor|s:0:\"\";__nama_lengkap|s:7:\"admin 1\";__email|s:0:\"\";__platform|s:7:\"browser\";_controller|s:4:\"ikon\";'),
('amqasfgb7vq6ku0ern7v20aq7f3ejh1e','::1',1639795839,'__ci_last_regenerate|i:1639795839;mycaptcha|s:4:\"9284\";__ci_vars|a:1:{s:9:\"mycaptcha\";s:3:\"old\";}__user_id|s:1:\"1\";__username|s:5:\"admin\";__img|N;__unit_id|N;__group_menu_id|s:1:\"2\";__group_menu_nama|s:6:\"Dokter\";__user_tipe_nomor|s:0:\"\";__nama_lengkap|s:7:\"admin 1\";__email|s:0:\"\";__platform|s:7:\"browser\";_controller|s:4:\"ikon\";'),
('asdb82pp09nbhpl2dahgvv4j90q6p7cg','::1',1639508969,'__ci_last_regenerate|i:1639508969;mycaptcha|s:3:\"258\";__ci_vars|a:1:{s:9:\"mycaptcha\";s:3:\"old\";}__user_id|s:1:\"1\";__username|s:5:\"admin\";__img|N;__unit_id|N;__group_menu_id|s:1:\"1\";__group_menu_nama|s:10:\"Superadmin\";__user_tipe_nomor|N;__nama_lengkap|N;__email|N;__platform|s:7:\"browser\";_controller|s:4:\"ikon\";'),
('b1cdunftb0ksb0e31sfisnh18tittpga','::1',1639800710,'__ci_last_regenerate|i:1639800710;mycaptcha|s:4:\"9284\";__ci_vars|a:1:{s:9:\"mycaptcha\";s:3:\"old\";}__user_id|s:1:\"1\";__username|s:5:\"admin\";__img|N;__unit_id|N;__group_menu_id|s:1:\"3\";__group_menu_nama|s:8:\"Keuangan\";__user_tipe_nomor|s:0:\"\";__nama_lengkap|s:7:\"admin 1\";__email|s:0:\"\";__platform|s:7:\"browser\";_controller|s:4:\"ikon\";'),
('b1mhf6ig4u1kn0v0uff1h9m1nvbkka5s','::1',1639816845,'__ci_last_regenerate|i:1639816823;mycaptcha|s:3:\"358\";__ci_vars|a:1:{s:9:\"mycaptcha\";s:3:\"new\";}'),
('b7f6ao7rofvgr6o82qlrl4dtq0sq8p61','::1',1639669311,'__ci_last_regenerate|i:1639669311;mycaptcha|s:4:\"6926\";__ci_vars|a:1:{s:9:\"mycaptcha\";s:3:\"old\";}__user_id|s:1:\"1\";__username|s:5:\"admin\";__img|N;__unit_id|N;__group_menu_id|s:1:\"2\";__group_menu_nama|s:6:\"Dokter\";__user_tipe_nomor|s:0:\"\";__nama_lengkap|s:7:\"admin 1\";__email|s:0:\"\";__platform|s:7:\"browser\";'),
('c7ruang0appqclni97uitq5s9ghtd1bu','::1',1639665133,'__ci_last_regenerate|i:1639665133;mycaptcha|s:3:\"258\";__ci_vars|a:1:{s:9:\"mycaptcha\";s:3:\"old\";}__user_id|s:1:\"1\";__username|s:5:\"admin\";__img|N;__unit_id|N;__group_menu_id|s:1:\"1\";__group_menu_nama|s:10:\"Superadmin\";__user_tipe_nomor|s:0:\"\";__nama_lengkap|N;__email|N;__platform|s:7:\"browser\";_controller|s:4:\"ikon\";'),
('co474gi79cjvl4p4ck1h8a79dol133h1','::1',1639815817,'__ci_last_regenerate|i:1639815817;mycaptcha|s:3:\"830\";__ci_vars|a:1:{s:9:\"mycaptcha\";s:3:\"old\";}__user_id|s:1:\"1\";__username|s:5:\"admin\";__img|N;__unit_id|N;__group_menu_id|s:1:\"1\";__group_menu_nama|s:10:\"Superadmin\";__user_tipe_nomor|N;__nama_lengkap|s:7:\"admin 1\";__email|s:0:\"\";__platform|s:7:\"browser\";_controller|s:4:\"ikon\";'),
('cto3c8ld9olm32m7cltvi84sii65nogd','::1',1639671625,'__ci_last_regenerate|i:1639671625;mycaptcha|s:4:\"9199\";__ci_vars|a:1:{s:9:\"mycaptcha\";s:3:\"old\";}__user_id|s:1:\"1\";__username|s:5:\"admin\";__img|N;__unit_id|N;__group_menu_id|s:1:\"1\";__group_menu_nama|s:10:\"Superadmin\";__user_tipe_nomor|N;__nama_lengkap|s:7:\"admin 1\";__email|s:0:\"\";__platform|s:7:\"browser\";_controller|s:6:\"module\";'),
('d4s0c0ial7q34dikh15svlodes9m2fao','::1',1639765240,'__ci_last_regenerate|i:1639765240;mycaptcha|s:4:\"9284\";__ci_vars|a:1:{s:9:\"mycaptcha\";s:3:\"old\";}__user_id|s:1:\"1\";__username|s:5:\"admin\";__img|N;__unit_id|N;__group_menu_id|s:1:\"2\";__group_menu_nama|s:6:\"Dokter\";__user_tipe_nomor|s:0:\"\";__nama_lengkap|s:7:\"admin 1\";__email|s:0:\"\";__platform|s:7:\"browser\";_controller|s:4:\"ikon\";'),
('dbrc8vtqpiof7rqk9jrj1r2srf4c9jd4','::1',1639816566,'__ci_last_regenerate|i:1639816566;mycaptcha|s:3:\"830\";__ci_vars|a:1:{s:9:\"mycaptcha\";s:3:\"old\";}__user_id|s:1:\"1\";__username|s:5:\"admin\";__img|N;__unit_id|N;__group_menu_id|s:1:\"2\";__group_menu_nama|s:6:\"Dokter\";__user_tipe_nomor|s:0:\"\";__nama_lengkap|s:7:\"admin 1\";__email|s:0:\"\";__platform|s:7:\"browser\";_controller|s:4:\"ikon\";'),
('ddhk5d2midr7g0q85sicn58a9fuj9k8f','::1',1639505605,'__ci_last_regenerate|i:1639505605;mycaptcha|s:4:\"3415\";__ci_vars|a:1:{s:9:\"mycaptcha\";s:3:\"new\";}'),
('dhu3stgv3ljkej2p2r3cqmtbomfdeln4','::1',1639811505,'__ci_last_regenerate|i:1639811505;mycaptcha|s:4:\"9284\";__ci_vars|a:1:{s:9:\"mycaptcha\";s:3:\"old\";}__user_id|s:1:\"1\";__username|s:5:\"admin\";__img|N;__unit_id|N;__group_menu_id|s:1:\"3\";__group_menu_nama|s:8:\"Keuangan\";__user_tipe_nomor|s:0:\"\";__nama_lengkap|s:7:\"admin 1\";__email|s:0:\"\";__platform|s:7:\"browser\";_controller|s:4:\"ikon\";'),
('eif4nc71b4nt7lhji9n5235161do40p1','::1',1639506707,'__ci_last_regenerate|i:1639506707;mycaptcha|s:4:\"1890\";__ci_vars|a:1:{s:9:\"mycaptcha\";s:3:\"old\";}__user_id|s:1:\"1\";__username|s:5:\"admin\";__img|N;__unit_id|N;__group_menu_id|s:1:\"1\";__group_menu_nama|s:10:\"Superadmin\";__user_tipe_nomor|N;__nama_lengkap|N;__email|N;__platform|s:7:\"browser\";'),
('emevnot4b0epv7tb989e8vbd5ucs9d6m','::1',1639666497,'__ci_last_regenerate|i:1639666497;mycaptcha|s:3:\"258\";__ci_vars|a:1:{s:9:\"mycaptcha\";s:3:\"old\";}__user_id|s:1:\"1\";__username|s:5:\"admin\";__img|N;__unit_id|N;__group_menu_id|s:1:\"1\";__group_menu_nama|s:10:\"Superadmin\";__user_tipe_nomor|s:0:\"\";__nama_lengkap|N;__email|N;__platform|s:7:\"browser\";_controller|s:6:\"module\";'),
('eru8utjoraq4s8t6cnsbb9nk7l9kv1qq','::1',1639813522,'__ci_last_regenerate|i:1639813522;mycaptcha|s:4:\"9284\";__ci_vars|a:1:{s:9:\"mycaptcha\";s:3:\"old\";}__user_id|s:1:\"1\";__username|s:5:\"admin\";__img|N;__unit_id|N;__group_menu_id|s:1:\"3\";__group_menu_nama|s:8:\"Keuangan\";__user_tipe_nomor|s:0:\"\";__nama_lengkap|s:7:\"admin 1\";__email|s:0:\"\";__platform|s:7:\"browser\";_controller|s:4:\"ikon\";'),
('f2818n0vtfgdr4vl8cc05vrmqa9rh337','::1',1639675397,'__ci_last_regenerate|i:1639675379;mycaptcha|s:4:\"1411\";__ci_vars|a:1:{s:9:\"mycaptcha\";s:3:\"old\";}__user_id|s:1:\"1\";__username|s:5:\"admin\";__img|N;__unit_id|N;__group_menu_id|s:1:\"1\";__group_menu_nama|s:10:\"Superadmin\";__user_tipe_nomor|N;__nama_lengkap|s:7:\"admin 1\";__email|s:0:\"\";__platform|s:7:\"browser\";_controller|s:6:\"module\";'),
('f3rfr7cte1q5mmm9nd4m6v1e4khl8h7b','::1',1639799361,'__ci_last_regenerate|i:1639799361;mycaptcha|s:4:\"9284\";__ci_vars|a:1:{s:9:\"mycaptcha\";s:3:\"old\";}__user_id|s:1:\"1\";__username|s:5:\"admin\";__img|N;__unit_id|N;__group_menu_id|s:1:\"3\";__group_menu_nama|s:8:\"Keuangan\";__user_tipe_nomor|s:0:\"\";__nama_lengkap|s:7:\"admin 1\";__email|s:0:\"\";__platform|s:7:\"browser\";_controller|s:4:\"ikon\";'),
('f72i807uissdji655lg2voooi1s5gktj','::1',1639504528,'__ci_last_regenerate|i:1639504528;mycaptcha|s:4:\"1355\";__ci_vars|a:1:{s:9:\"mycaptcha\";s:3:\"new\";}'),
('fmdoa4c52uobvrkr4qn3r867ahgj2c4g','::1',1639668418,'__ci_last_regenerate|i:1639668418;mycaptcha|s:4:\"6926\";__ci_vars|a:1:{s:9:\"mycaptcha\";s:3:\"old\";}__user_id|s:1:\"1\";__username|s:5:\"admin\";__img|N;__unit_id|N;__group_menu_id|s:1:\"2\";__group_menu_nama|s:6:\"Dokter\";__user_tipe_nomor|s:0:\"\";__nama_lengkap|s:7:\"admin 1\";__email|s:0:\"\";__platform|s:7:\"browser\";'),
('fn62jra7tnefcu8mf5vq7m9550ooebdd','::1',1639764292,'__ci_last_regenerate|i:1639764292;mycaptcha|s:4:\"9284\";__ci_vars|a:1:{s:9:\"mycaptcha\";s:3:\"old\";}__user_id|s:1:\"1\";__username|s:5:\"admin\";__img|N;__unit_id|N;__group_menu_id|s:1:\"2\";__group_menu_nama|s:6:\"Dokter\";__user_tipe_nomor|s:0:\"\";__nama_lengkap|s:7:\"admin 1\";__email|s:0:\"\";__platform|s:7:\"browser\";_controller|s:4:\"ikon\";'),
('fnsgjbfmfq8243tg1e9d634afejvf05u','::1',1639667250,'__ci_last_regenerate|i:1639667250;mycaptcha|s:3:\"258\";__ci_vars|a:1:{s:9:\"mycaptcha\";s:3:\"old\";}__user_id|s:1:\"1\";__username|s:5:\"admin\";__img|N;__unit_id|N;__group_menu_id|s:1:\"1\";__group_menu_nama|s:10:\"Superadmin\";__user_tipe_nomor|s:0:\"\";__nama_lengkap|N;__email|N;__platform|s:7:\"browser\";_controller|s:4:\"ikon\";'),
('g56if8qsiotkbvpn4p1ejcof161iq51s','::1',1639671625,'__ci_last_regenerate|i:1639671625;mycaptcha|s:4:\"9121\";__ci_vars|a:1:{s:9:\"mycaptcha\";s:3:\"new\";}'),
('gj9dullmtm7j88j291nh3spgs6ha2oj4','::1',1639815115,'__ci_last_regenerate|i:1639815115;mycaptcha|s:4:\"9284\";__ci_vars|a:1:{s:9:\"mycaptcha\";s:3:\"old\";}__user_id|s:1:\"1\";__username|s:5:\"admin\";__img|N;__unit_id|N;__group_menu_id|s:1:\"3\";__group_menu_nama|s:8:\"Keuangan\";__user_tipe_nomor|s:0:\"\";__nama_lengkap|s:7:\"admin 1\";__email|s:0:\"\";__platform|s:7:\"browser\";_controller|s:4:\"ikon\";'),
('gt03po8novamhvgekr06hku12deep9jc','::1',1639808735,'__ci_last_regenerate|i:1639808735;mycaptcha|s:4:\"9284\";__ci_vars|a:1:{s:9:\"mycaptcha\";s:3:\"old\";}__user_id|s:1:\"1\";__username|s:5:\"admin\";__img|N;__unit_id|N;__group_menu_id|s:1:\"3\";__group_menu_nama|s:8:\"Keuangan\";__user_tipe_nomor|s:0:\"\";__nama_lengkap|s:7:\"admin 1\";__email|s:0:\"\";__platform|s:7:\"browser\";_controller|s:4:\"ikon\";'),
('ht5oea0rp5vgtv05hcgdctmreh6upa49','::1',1639671999,'__ci_last_regenerate|i:1639671999;mycaptcha|s:4:\"6926\";__ci_vars|a:1:{s:9:\"mycaptcha\";s:3:\"old\";}__user_id|s:1:\"1\";__username|s:5:\"admin\";__img|N;__unit_id|N;__group_menu_id|s:1:\"2\";__group_menu_nama|s:6:\"Dokter\";__user_tipe_nomor|s:0:\"\";__nama_lengkap|s:7:\"admin 1\";__email|s:0:\"\";__platform|s:7:\"browser\";'),
('i9ku6g8bjuk5668ei5reu048bm3ba1i3','::1',1639762625,'__ci_last_regenerate|i:1639762625;mycaptcha|s:4:\"9284\";__ci_vars|a:1:{s:9:\"mycaptcha\";s:3:\"old\";}__user_id|s:1:\"1\";__username|s:5:\"admin\";__img|N;__unit_id|N;__group_menu_id|s:1:\"1\";__group_menu_nama|s:10:\"Superadmin\";__user_tipe_nomor|s:0:\"\";__nama_lengkap|s:7:\"admin 1\";__email|s:0:\"\";__platform|s:7:\"browser\";_controller|s:6:\"module\";'),
('imnmvbn6l14dlsjicro324afi87funk2','::1',1639505285,'__ci_last_regenerate|i:1639505285;mycaptcha|s:4:\"8669\";__ci_vars|a:1:{s:9:\"mycaptcha\";s:3:\"new\";}'),
('l5l941la8s23snhebs4d972pn1nhmdnq','::1',1639509607,'__ci_last_regenerate|i:1639509607;mycaptcha|s:3:\"258\";__ci_vars|a:1:{s:9:\"mycaptcha\";s:3:\"old\";}__user_id|s:1:\"1\";__username|s:5:\"admin\";__img|N;__unit_id|N;__group_menu_id|s:1:\"1\";__group_menu_nama|s:10:\"Superadmin\";__user_tipe_nomor|N;__nama_lengkap|N;__email|N;__platform|s:7:\"browser\";_controller|s:4:\"ikon\";'),
('l9e0ngn904p18quqav3evn8cv7b5um1j','::1',1639505973,'__ci_last_regenerate|i:1639505973;mycaptcha|s:4:\"7096\";__ci_vars|a:1:{s:9:\"mycaptcha\";s:3:\"old\";}__user_id|s:1:\"1\";__username|s:5:\"admin\";__img|N;__unit_id|N;__group_menu_id|s:1:\"1\";__group_menu_nama|s:10:\"Superadmin\";__user_tipe_nomor|N;__nama_lengkap|N;__email|N;__platform|s:7:\"browser\";'),
('lr35borlod74quv3qbspm7dbu5refb8g','::1',1639504528,'__ci_last_regenerate|i:1639504528;mycaptcha|s:4:\"9463\";__ci_vars|a:1:{s:9:\"mycaptcha\";s:3:\"new\";}'),
('mk8cc25id1hdo8f1n1a2f0eirjvtn3bg','::1',1639666035,'__ci_last_regenerate|i:1639666035;mycaptcha|s:3:\"258\";__ci_vars|a:1:{s:9:\"mycaptcha\";s:3:\"old\";}__user_id|s:1:\"1\";__username|s:5:\"admin\";__img|N;__unit_id|N;__group_menu_id|s:1:\"1\";__group_menu_nama|s:10:\"Superadmin\";__user_tipe_nomor|s:0:\"\";__nama_lengkap|N;__email|N;__platform|s:7:\"browser\";_controller|s:4:\"ikon\";'),
('njrnlv9dhpvcokajohhd0r0bjffe3j2s','::1',1639671628,'__ci_last_regenerate|i:1639671628;mycaptcha|s:4:\"6926\";__ci_vars|a:1:{s:9:\"mycaptcha\";s:3:\"old\";}__user_id|s:1:\"1\";__username|s:5:\"admin\";__img|N;__unit_id|N;__group_menu_id|s:1:\"2\";__group_menu_nama|s:6:\"Dokter\";__user_tipe_nomor|s:0:\"\";__nama_lengkap|s:7:\"admin 1\";__email|s:0:\"\";__platform|s:7:\"browser\";'),
('nkvm0atd9ljjpsafs8hv9tv7c8hs3e8n','::1',1639816823,'__ci_last_regenerate|i:1639816823;mycaptcha|s:4:\"9970\";__ci_vars|a:1:{s:9:\"mycaptcha\";s:3:\"old\";}__user_id|s:1:\"2\";__username|s:6:\"dokter\";__img|N;__unit_id|N;__group_menu_id|s:1:\"2\";__group_menu_nama|s:6:\"Dokter\";__user_tipe_nomor|s:3:\"119\";__nama_lengkap|s:8:\"dokter 1\";__email|s:16:\"dokter@gmail.com\";__platform|s:7:\"browser\";'),
('no5o6i6arjnri9huquj20089rhi7r193','::1',1639503729,'__ci_last_regenerate|i:1639503729;mycaptcha|s:4:\"3006\";__ci_vars|a:1:{s:9:\"mycaptcha\";s:3:\"new\";}'),
('on6o9abkrfdtdln3cb46qb9i1q0t7rsk','::1',1639667979,'__ci_last_regenerate|i:1639667979;mycaptcha|s:3:\"258\";__ci_vars|a:1:{s:9:\"mycaptcha\";s:3:\"old\";}__user_id|s:1:\"1\";__username|s:5:\"admin\";__img|N;__unit_id|N;__group_menu_id|s:1:\"3\";__group_menu_nama|s:8:\"Keuangan\";__user_tipe_nomor|s:0:\"\";__nama_lengkap|N;__email|N;__platform|s:7:\"browser\";_controller|s:4:\"ikon\";'),
('ovmopb1icpbuqi1b6arcnk66atlgve6k','::1',1639811899,'__ci_last_regenerate|i:1639811899;mycaptcha|s:4:\"9284\";__ci_vars|a:1:{s:9:\"mycaptcha\";s:3:\"old\";}__user_id|s:1:\"1\";__username|s:5:\"admin\";__img|N;__unit_id|N;__group_menu_id|s:1:\"3\";__group_menu_nama|s:8:\"Keuangan\";__user_tipe_nomor|s:0:\"\";__nama_lengkap|s:7:\"admin 1\";__email|s:0:\"\";__platform|s:7:\"browser\";_controller|s:4:\"ikon\";'),
('q90rodr2a7qejnf8s2p6i48ppn022vnd','::1',1639509921,'__ci_last_regenerate|i:1639509921;mycaptcha|s:3:\"258\";__ci_vars|a:1:{s:9:\"mycaptcha\";s:3:\"old\";}__user_id|s:1:\"1\";__username|s:5:\"admin\";__img|N;__unit_id|N;__group_menu_id|s:1:\"2\";__group_menu_nama|s:6:\"Dokter\";__user_tipe_nomor|s:0:\"\";__nama_lengkap|N;__email|N;__platform|s:7:\"browser\";_controller|s:4:\"ikon\";'),
('s51ki6l2soe8m3qns5n4biabp4b3358u','::1',1639808050,'__ci_last_regenerate|i:1639808050;mycaptcha|s:4:\"9284\";__ci_vars|a:1:{s:9:\"mycaptcha\";s:3:\"old\";}__user_id|s:1:\"1\";__username|s:5:\"admin\";__img|N;__unit_id|N;__group_menu_id|s:1:\"3\";__group_menu_nama|s:8:\"Keuangan\";__user_tipe_nomor|s:0:\"\";__nama_lengkap|s:7:\"admin 1\";__email|s:0:\"\";__platform|s:7:\"browser\";_controller|s:4:\"ikon\";'),
('sdkojphbd48jon7skpaa4qld7eq05j9d','::1',1639813100,'__ci_last_regenerate|i:1639813100;mycaptcha|s:4:\"9284\";__ci_vars|a:1:{s:9:\"mycaptcha\";s:3:\"old\";}__user_id|s:1:\"1\";__username|s:5:\"admin\";__img|N;__unit_id|N;__group_menu_id|s:1:\"3\";__group_menu_nama|s:8:\"Keuangan\";__user_tipe_nomor|s:0:\"\";__nama_lengkap|s:7:\"admin 1\";__email|s:0:\"\";__platform|s:7:\"browser\";_controller|s:4:\"ikon\";'),
('sloq98fhaa7s1l17jv2prmdmqfv95hoj','::1',1639534375,'__ci_last_regenerate|i:1639534375;mycaptcha|s:3:\"258\";__ci_vars|a:1:{s:9:\"mycaptcha\";s:3:\"old\";}__user_id|s:1:\"1\";__username|s:5:\"admin\";__img|N;__unit_id|N;__group_menu_id|s:1:\"1\";__group_menu_nama|s:10:\"Superadmin\";__user_tipe_nomor|s:0:\"\";__nama_lengkap|N;__email|N;__platform|s:7:\"browser\";_controller|s:4:\"ikon\";'),
('t833f3k04bkhquln45hced4skrso1lab','::1',1639816380,'__ci_last_regenerate|i:1639816380;mycaptcha|s:4:\"9970\";__ci_vars|a:1:{s:9:\"mycaptcha\";s:3:\"old\";}__user_id|s:1:\"2\";__username|s:6:\"dokter\";__img|N;__unit_id|N;__group_menu_id|s:1:\"2\";__group_menu_nama|s:6:\"Dokter\";__user_tipe_nomor|s:3:\"119\";__nama_lengkap|s:8:\"dokter 1\";__email|s:16:\"dokter@gmail.com\";__platform|s:7:\"browser\";'),
('tblsqsp6i9hq5nbdcrafu0dek6kadp9t','::1',1639812379,'__ci_last_regenerate|i:1639812379;mycaptcha|s:4:\"9284\";__ci_vars|a:1:{s:9:\"mycaptcha\";s:3:\"old\";}__user_id|s:1:\"1\";__username|s:5:\"admin\";__img|N;__unit_id|N;__group_menu_id|s:1:\"3\";__group_menu_nama|s:8:\"Keuangan\";__user_tipe_nomor|s:0:\"\";__nama_lengkap|s:7:\"admin 1\";__email|s:0:\"\";__platform|s:7:\"browser\";_controller|s:4:\"ikon\";'),
('u64b24jtg1tratuujsokpglg71slb7rq','::1',1639809970,'__ci_last_regenerate|i:1639809970;mycaptcha|s:4:\"9284\";__ci_vars|a:1:{s:9:\"mycaptcha\";s:3:\"old\";}__user_id|s:1:\"1\";__username|s:5:\"admin\";__img|N;__unit_id|N;__group_menu_id|s:1:\"3\";__group_menu_nama|s:8:\"Keuangan\";__user_tipe_nomor|s:0:\"\";__nama_lengkap|s:7:\"admin 1\";__email|s:0:\"\";__platform|s:7:\"browser\";_controller|s:4:\"ikon\";'),
('undvaq4481e20dpn52qjatvbngq6i153','::1',1639679726,'__ci_last_regenerate|i:1639679726;mycaptcha|s:4:\"9284\";__ci_vars|a:1:{s:9:\"mycaptcha\";s:3:\"old\";}__user_id|s:1:\"1\";__username|s:5:\"admin\";__img|N;__unit_id|N;__group_menu_id|s:1:\"2\";__group_menu_nama|s:6:\"Dokter\";__user_tipe_nomor|s:0:\"\";__nama_lengkap|s:7:\"admin 1\";__email|s:0:\"\";__platform|s:7:\"browser\";_controller|s:6:\"module\";'),
('v5m0iv7l17mhkencrk74l6apm1fovjlu','::1',1639675176,'__ci_last_regenerate|i:1639675176;mycaptcha|s:4:\"7922\";__ci_vars|a:1:{s:9:\"mycaptcha\";s:3:\"old\";}__user_id|s:1:\"1\";__username|s:5:\"admin\";__img|N;__unit_id|N;__group_menu_id|s:1:\"2\";__group_menu_nama|s:6:\"Dokter\";__user_tipe_nomor|s:0:\"\";__nama_lengkap|s:7:\"admin 1\";__email|s:0:\"\";__platform|s:7:\"browser\";'),
('vgd9em5n5boniuibbmkpinb9hiarsglv','::1',1639798358,'__ci_last_regenerate|i:1639798358;mycaptcha|s:4:\"9284\";__ci_vars|a:1:{s:9:\"mycaptcha\";s:3:\"old\";}__user_id|s:1:\"1\";__username|s:5:\"admin\";__img|N;__unit_id|N;__group_menu_id|s:1:\"3\";__group_menu_nama|s:8:\"Keuangan\";__user_tipe_nomor|s:0:\"\";__nama_lengkap|s:7:\"admin 1\";__email|s:0:\"\";__platform|s:7:\"browser\";_controller|s:4:\"ikon\";');

/*Table structure for table `sys_user` */

DROP TABLE IF EXISTS `sys_user`;

CREATE TABLE `sys_user` (
  `user_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_username` varchar(100) NOT NULL,
  `user_password` varchar(100) DEFAULT NULL,
  `user_email` varchar(100) DEFAULT NULL,
  `user_image` varchar(255) DEFAULT NULL,
  `user_nama_lengkap` varchar(255) DEFAULT NULL,
  `user_tipe_nomor` varchar(200) DEFAULT NULL,
  `group_menu_id` int(11) DEFAULT NULL,
  `user_unit_id` int(11) DEFAULT NULL,
  `user_is_aktif` enum('1','0') DEFAULT '1',
  `user_is_sso` tinyint(1) DEFAULT NULL,
  `last_login` datetime DEFAULT NULL,
  `created_by` int(11) unsigned DEFAULT NULL,
  `created_time` datetime DEFAULT NULL,
  `updated_by` int(11) unsigned DEFAULT NULL,
  `updated_time` datetime DEFAULT NULL,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `user_username_idx` (`user_username`),
  UNIQUE KEY `user_email_idx` (`user_email`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `sys_user` */

insert  into `sys_user`(`user_id`,`user_username`,`user_password`,`user_email`,`user_image`,`user_nama_lengkap`,`user_tipe_nomor`,`group_menu_id`,`user_unit_id`,`user_is_aktif`,`user_is_sso`,`last_login`,`created_by`,`created_time`,`updated_by`,`updated_time`) values 
(1,'admin','574ffe61c01a127805ea1a00aa058fec','',NULL,'admin 1',NULL,2,NULL,'1',NULL,NULL,NULL,NULL,1,'2021-12-16 22:07:11'),
(2,'dokter','167b42618a9e2d6899940d84e8946ba7','dokter@gmail.com',NULL,'dokter 1','119',2,NULL,'1',NULL,NULL,1,'2021-12-15 02:18:04',2,'2021-12-18 15:27:22');

/*Table structure for table `sys_user_access` */

DROP TABLE IF EXISTS `sys_user_access`;

CREATE TABLE `sys_user_access` (
  `user_access_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) unsigned NOT NULL,
  `group_menu_id` int(11) NOT NULL,
  `created_by` int(11) unsigned DEFAULT NULL,
  `created_time` datetime DEFAULT NULL,
  `updated_by` int(11) unsigned DEFAULT NULL,
  `updated_time` datetime DEFAULT NULL,
  PRIMARY KEY (`user_access_id`),
  KEY `ugmfw_user_access.user_id_fk` (`user_id`),
  KEY `ugmfw_user_access.group_menu_id_fk` (`group_menu_id`),
  CONSTRAINT `sys_user_access_ibfk_1` FOREIGN KEY (`group_menu_id`) REFERENCES `sys_group_menu` (`group_menu_id`) ON UPDATE CASCADE,
  CONSTRAINT `sys_user_access_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `sys_user` (`user_id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

/*Data for the table `sys_user_access` */

insert  into `sys_user_access`(`user_access_id`,`user_id`,`group_menu_id`,`created_by`,`created_time`,`updated_by`,`updated_time`) values 
(7,1,2,1,'2021-12-16 22:07:11',1,'2021-12-16 22:07:11'),
(8,1,3,1,'2021-12-16 22:07:11',1,'2021-12-16 22:07:11'),
(9,1,1,1,'2021-12-16 22:07:11',1,'2021-12-16 22:07:11'),
(10,2,2,2,'2021-12-18 15:27:22',2,'2021-12-18 15:27:22');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
