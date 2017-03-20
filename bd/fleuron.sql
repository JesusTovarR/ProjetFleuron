-- Adminer 4.2.5 MySQL dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

DROP TABLE IF EXISTS `accueil_contenu`;
CREATE TABLE `accueil_contenu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `content` longtext NOT NULL,
  `code` tinytext NOT NULL,
  `status` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS `affichage_ressource`;
CREATE TABLE `affichage_ressource` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `option1` longtext NOT NULL,
  `option2` longtext NOT NULL,
  `code` tinytext NOT NULL,
  `status` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS `categorie`;
CREATE TABLE `categorie` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` tinytext NOT NULL,
  `fr` tinytext NOT NULL,
  `uk` tinytext NOT NULL,
  `es` tinytext NOT NULL,
  `ch` tinytext NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS `choix_langue`;
CREATE TABLE `choix_langue` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `content` longtext NOT NULL,
  `code` tinytext NOT NULL,
  `status` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS `commentaires`;
CREATE TABLE `commentaires` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `jour` date NOT NULL,
  `ressource` int(11) NOT NULL,
  `profil` int(11) NOT NULL,
  `commentaire` text NOT NULL,
  `reponse` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS `conseils`;
CREATE TABLE `conseils` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `line55` longtext NOT NULL,
  `line64_77` longtext NOT NULL,
  `code` tinytext NOT NULL,
  `status` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS `conseils_contenu`;
CREATE TABLE `conseils_contenu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `content` longtext NOT NULL,
  `code` tinytext NOT NULL,
  `status` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS `conseils_page`;
CREATE TABLE `conseils_page` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `jour` date NOT NULL,
  `ressource` int(11) NOT NULL,
  `page` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS `contact_contenu`;
CREATE TABLE `contact_contenu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `content` longtext NOT NULL,
  `code` tinytext NOT NULL,
  `status` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS `content`;
CREATE TABLE `content` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `line174` longtext NOT NULL,
  `line190` longtext NOT NULL,
  `line192` longtext NOT NULL,
  `line205_216` longtext NOT NULL,
  `line227` longtext NOT NULL,
  `code` tinytext NOT NULL,
  `status` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS `couleur`;
CREATE TABLE `couleur` (
  `id` int(11) NOT NULL,
  `couleur` text NOT NULL,
  `nom` text NOT NULL,
  `description` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS `couleur_memo`;
CREATE TABLE `couleur_memo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `jour` date NOT NULL,
  `couleur1` text NOT NULL,
  `couleur2` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS `dernier_media`;
CREATE TABLE `dernier_media` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` longtext NOT NULL,
  `code` tinytext NOT NULL,
  `status` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS `favoris`;
CREATE TABLE `favoris` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `jour` date NOT NULL,
  `profil` int(11) NOT NULL,
  `ressource` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS `glossaire`;
CREATE TABLE `glossaire` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `item` tinytext NOT NULL,
  `description_fr` text NOT NULL,
  `description_uk` text NOT NULL,
  `description_es` text NOT NULL,
  `titre_ch` tinytext NOT NULL,
  `description_ch` tinytext NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS `langues`;
CREATE TABLE `langues` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` tinytext NOT NULL,
  `code` tinytext NOT NULL,
  `status` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS `lg`;
CREATE TABLE `lg` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` tinytext NOT NULL,
  `code` tinytext NOT NULL,
  `commentaire` text NOT NULL,
  `online` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS `liencategories`;
CREATE TABLE `liencategories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` tinytext NOT NULL,
  `refVL` int(11) NOT NULL,
  `fr` tinytext NOT NULL,
  `uk` tinytext NOT NULL,
  `es` tinytext NOT NULL,
  `ch` tinytext NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS `liens`;
CREATE TABLE `liens` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` tinytext NOT NULL,
  `lien` text NOT NULL,
  `liencategories` int(11) NOT NULL,
  `aff` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS `liensRessources_categories`;
CREATE TABLE `liensRessources_categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` tinytext NOT NULL,
  `refVL` int(11) NOT NULL,
  `fr` tinytext NOT NULL,
  `uk` tinytext NOT NULL,
  `es` tinytext NOT NULL,
  `ch` tinytext NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS `liens_Ressources`;
CREATE TABLE `liens_Ressources` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` tinytext NOT NULL,
  `lien` text NOT NULL,
  `liencategories` int(11) NOT NULL,
  `aff` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS `login`;
CREATE TABLE `login` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `label1` longtext NOT NULL,
  `label2` longtext NOT NULL,
  `button` longtext NOT NULL,
  `message` longtext NOT NULL,
  `code` tinytext NOT NULL,
  `status` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS `mail`;
CREATE TABLE `mail` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fr` text NOT NULL,
  `uk` text NOT NULL,
  `es` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS `menu`;
CREATE TABLE `menu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `home` longtext NOT NULL,
  `tips` longtext NOT NULL,
  `resources` longtext NOT NULL,
  `links` longtext NOT NULL,
  `profile` longtext NOT NULL,
  `signin` longtext NOT NULL,
  `contact` longtext NOT NULL,
  `translator` longtext NOT NULL,
  `logout` longtext NOT NULL,
  `code` tinytext NOT NULL,
  `status` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS `menu_admin`;
CREATE TABLE `menu_admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `profiles` longtext NOT NULL,
  `versions` longtext NOT NULL,
  `total_comments` longtext NOT NULL,
  `color` longtext NOT NULL,
  `use_languages` longtext NOT NULL,
  `statistics` longtext NOT NULL,
  `code` tinytext NOT NULL,
  `status` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS `moteur_de_recherche`;
CREATE TABLE `moteur_de_recherche` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `word` longtext NOT NULL,
  `title` longtext NOT NULL,
  `button` longtext NOT NULL,
  `code` tinytext NOT NULL,
  `status` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS `notes`;
CREATE TABLE `notes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `jour` date NOT NULL,
  `ressource` int(11) NOT NULL,
  `profil` int(11) NOT NULL,
  `notes` text NOT NULL,
  `regarder` text NOT NULL,
  `comprendre` text NOT NULL,
  `aimer` text NOT NULL,
  `suivre` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS `page`;
CREATE TABLE `page` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` tinytext NOT NULL,
  `fr` longtext NOT NULL,
  `uk` longtext NOT NULL,
  `es` longtext NOT NULL,
  `nompage` tinytext NOT NULL,
  `ch` tinytext NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS `page_edit`;
CREATE TABLE `page_edit` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `line46` longtext NOT NULL,
  `line97` longtext NOT NULL,
  `line106` longtext NOT NULL,
  `code` tinytext NOT NULL,
  `status` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS `pays`;
CREATE TABLE `pays` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` tinytext NOT NULL,
  `nom` tinytext NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS `profil`;
CREATE TABLE `profil` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` text NOT NULL,
  `prenom` text NOT NULL,
  `email` text NOT NULL,
  `pays` tinytext NOT NULL,
  `langue` tinytext NOT NULL,
  `utilisateur` text NOT NULL,
  `niveau` int(11) NOT NULL,
  `motdepasse` text NOT NULL,
  `jour` date NOT NULL,
  `heure` time NOT NULL,
  `consultation` longtext NOT NULL,
  `demande_referent` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `profil` (`id`, `nom`, `prenom`, `email`, `pays`, `langue`, `utilisateur`, `niveau`, `motdepasse`, `jour`, `heure`, `consultation`, `demande_referent`) VALUES
(1,	'Duda',	'Steven',	'steven.duda@wanadoo.fr',	'sv',	'fr',	'Steven',	50,	'yoboseo',	'2016-02-15',	'00:00:00',	'32;73;110;46;47;35;49;62;120;78;71;91;63;92;37;102;103;107;26;97;105;90;48;53;76;74;108;31;50;121;24;100;45;119;126;127;125;77;',	0),
(2,	'Andre',	'Virginie',	'Virginie.Andre@univ-lorraine.fr',	'fr',	'fr',	'Fleuron',	10,	'crapel',	'2016-03-01',	'00:00:00',	'78;121;31;74;25;43;24;122;123;115;117;124;108;26;56;99;50;47;120;125;53;111;66;20;110;76;126;127;128;',	0),
(41,	'Spock',	'',	'sdsd@sds.fr',	'fr',	'fr',	'Spock',	5,	'spock',	'2016-03-15',	'00:00:00',	'104;56;37;62;',	0),
(52,	'Kara',	'',	'',	'fr',	'fr',	'Supergirl',	1,	'supergirl',	'2016-03-18',	'00:00:00',	'31;107;73;82;53;104;27;50;120;121;110;26;77;76;',	0),
(62,	'',	'',	'',	'fr',	'fr',	'Test',	1,	'test',	'2016-03-23',	'11:34:34',	'',	0),
(63,	'Demo',	'Stration',	'',	'af',	'fr',	'Demo',	1,	'1234',	'2016-04-23',	'00:00:00',	'53;88;74;72;121;78;73;29;120;37;32;50;26;',	0),
(64,	'tutu',	'tu',	'449031276@qq.com',	'cn',	'fr',	'tutu',	1,	'123456789',	'2016-04-25',	'00:00:00',	'',	0),
(65,	'Poncet',	'Florence',	'Florence.poncet@gmail.com',	'ag',	'es',	'Flop',	1,	'Flop',	'2016-05-04',	'00:00:00',	'99;94;73;120;124;72;127;',	0),
(66,	'Fang',	'Maxence',	'fongqi917@gmail.com',	'cn',	'fr',	'Maxence',	1,	'189682451azE',	'2016-05-06',	'00:00:00',	'58;',	0),
(67,	'VARINOT',	'Kathia',	'kathia.varinot@hotmail.fr',	'cn',	'fr',	'&#29579;&#24320;&#24515;',	1,	'88200kathou',	'2016-05-06',	'00:00:00',	'108;78;60;58;20;52;38;31;26;',	0),
(68,	'Geng',	'Haiqi',	'786803754v@gmail.com',	'cn',	'fr',	'Guillaume',	1,	'qwer4424',	'2016-05-06',	'00:00:00',	'50;121;48;',	0),
(69,	'ZHANG',	'Dantong',	'yazhimint@sina.com',	'cn',	'fr',	'Léane',	1,	'657531971',	'2016-05-06',	'00:00:00',	'122;121;50;',	0),
(70,	'Li',	'Binru',	'liliulv@163.com',	'cn',	'fr',	'libinru',	1,	'Shiro618907',	'2016-05-06',	'00:00:00',	'50;121;',	0),
(72,	'DING',	'Ting',	'dingt824@163.com',	'cn',	'fr',	'Camille',	1,	'102149',	'2016-05-13',	'00:00:00',	'50;',	0),
(73,	'Pékin',	'Kathia',	'kathia.varinot@hotmail.fr',	'fr',	'fr',	'Kathia',	1,	'kathou88200',	'2016-05-18',	'00:00:00',	'122;124;121;',	0),
(74,	'Yingqi',	'Liu',	'931424088@qq.com',	'cn',	'fr',	'Liu Yingqi',	1,	'xyzzx1159',	'2016-05-20',	'00:00:00',	'92;121;',	0),
(75,	'Jade',	'Yang',	'aaaaiic1@live.com',	'cn',	'fr',	'jaaaaade',	1,	'jaaaaade',	'2016-05-20',	'00:00:00',	'26;121;',	0),
(76,	'Yao',	'PENG',	'pengyaochina@163.com',	'cn',	'fr',	'PENGY',	1,	'163724',	'2016-05-20',	'00:00:00',	'72;121;',	0),
(77,	'liang',	'weiwei',	'lww446765695@qq.com',	'cn',	'fr',	'Philippe',	1,	'446765695',	'2016-05-20',	'00:00:00',	'53;',	0),
(78,	'LI',	'DONGFANG',	'285444324@qq.com',	'cn',	'fr',	'INES',	1,	'865180670705',	'2016-05-20',	'00:00:00',	'',	0),
(79,	'Ma',	'Yiyan',	'mayiyananny@163.com',	'cn',	'fr',	'Anna',	1,	'aiarron1120',	'2016-05-20',	'00:00:00',	'121;',	0),
(80,	'Maxence',	'Fong',	'fangqimax@gmail.com',	'cn',	'uk',	'Maxence',	1,	'189682451azE',	'2016-05-20',	'00:00:00',	'50;',	0),
(81,	'zhao',	'ziyun',	'1013224712@qq.com',	'cn',	'fr',	'zhaoziyun',	1,	'dycxgswho911',	'2016-05-20',	'00:00:00',	'121;',	0),
(82,	'Wang',	'Yu',	'837672741@qq.com',	'cn',	'fr',	'ab19960521',	1,	'wangyu00',	'2016-05-20',	'00:00:00',	'121;',	0),
(83,	'Bartkova',	'Katarina',	'katarina.bartkova@univ-lorraine.fr',	'fr',	'fr',	'',	1,	'lveb25j!',	'2016-05-27',	'00:00:00',	'26;77;67;',	0),
(84,	'JimmiXS',	'JimmiXS',	'jimos4581rt@hotmail.com',	'gm',	'fr',	'gtBogOHMXIBST',	1,	'iphDXtjoVavTG',	'2016-08-10',	'00:00:00',	'',	0),
(85,	'JimmiXS',	'JimmiXS',	'jimos4581rt@hotmail.com',	'er',	'fr',	'cRDDOcQQYjto',	1,	'hnohWkCgYadUzgJ',	'2016-08-11',	'00:00:00',	'',	0),
(86,	'JimmiXS',	'JimmiXS',	'jimos4581rt@hotmail.com',	'sd',	'fr',	'MbRSSCiWlXgIbu',	1,	'GhzqBQoWisj',	'2016-08-11',	'00:00:00',	'',	0);

DROP TABLE IF EXISTS `recherche`;
CREATE TABLE `recherche` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `mot` tinytext NOT NULL,
  `visiteur` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS `ressources`;
CREATE TABLE `ressources` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom_fr` tinytext NOT NULL,
  `description_fr` text NOT NULL,
  `categorie` int(11) NOT NULL,
  `nom_es` tinytext NOT NULL,
  `description_es` text NOT NULL,
  `nom_uk` tinytext NOT NULL,
  `description_uk` text NOT NULL,
  `jour` date NOT NULL,
  `heure` time NOT NULL,
  `offline` int(11) NOT NULL,
  `sourcemedia` tinytext NOT NULL,
  `sourcevignette` tinytext NOT NULL,
  `sourcemedia2` tinytext NOT NULL,
  `typemedia` tinytext NOT NULL,
  `sourcetranscription` tinytext NOT NULL,
  `Transcription` longtext NOT NULL,
  `visiteur` int(11) NOT NULL,
  `nom_ch` tinytext NOT NULL,
  `description_ch` tinytext NOT NULL,
  `lien` text NOT NULL,
  `code` tinytext NOT NULL,
  `status` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS `tableau_du_bord`;
CREATE TABLE `tableau_du_bord` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `btnfavorite` longtext NOT NULL,
  `btnnote` longtext NOT NULL,
  `btncomment` longtext NOT NULL,
  `btnhistory` longtext NOT NULL,
  `btnglossary` longtext NOT NULL,
  `code` tinytext NOT NULL,
  `status` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS `test`;
CREATE TABLE `test` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `toto2` int(11) NOT NULL,
  `tutu` text NOT NULL,
  `ttt` tinytext NOT NULL,
  `lo` tinytext NOT NULL,
  `hh` tinytext NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS `versionlinguistique`;
CREATE TABLE `versionlinguistique` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fr` longtext NOT NULL,
  `uk` longtext NOT NULL,
  `es` longtext NOT NULL,
  `ch` tinytext NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


-- 2017-03-20 13:41:48
