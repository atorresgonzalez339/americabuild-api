/*
Navicat MySQL Data Transfer

Source Server         : local
Source Server Version : 50505
Source Host           : localhost:3306
Source Database       : servicesdb

Target Server Type    : MYSQL
Target Server Version : 50505
File Encoding         : 65001

Date: 2018-03-09 23:30:49
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `migration_versions`
-- ----------------------------
DROP TABLE IF EXISTS `migration_versions`;
CREATE TABLE `migration_versions` (
  `version` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of migration_versions
-- ----------------------------
INSERT INTO `migration_versions` VALUES ('20180306202837');

-- ----------------------------
-- Table structure for `tbcompany`
-- ----------------------------
DROP TABLE IF EXISTS `tbcompany`;
CREATE TABLE `tbcompany` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `companyName` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `subdomain` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of tbcompany
-- ----------------------------
INSERT INTO `tbcompany` VALUES ('1', 'Ejemplo', 'ejemplo.com');
INSERT INTO `tbcompany` VALUES ('2', 'Facebook', 'facebook.com');
INSERT INTO `tbcompany` VALUES ('3', 'Oracle', 'oracle.com');
INSERT INTO `tbcompany` VALUES ('4', 'Habanos ', 'habano.com');
INSERT INTO `tbcompany` VALUES ('5', 'fddsfsdfds', 'dsfsd.com');
INSERT INTO `tbcompany` VALUES ('6', 'sadasd', 'asdsad,com');

-- ----------------------------
-- Table structure for `tbrol`
-- ----------------------------
DROP TABLE IF EXISTS `tbrol`;
CREATE TABLE `tbrol` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `rolname` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `alias` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of tbrol
-- ----------------------------
INSERT INTO `tbrol` VALUES ('1', 'ROLE_ADMINISTRATOR', 'Administrador', 'Administrador');
INSERT INTO `tbrol` VALUES ('2', 'ROLE_AUTHENTICATED', 'Authenticated', 'Authenticated');

-- ----------------------------
-- Table structure for `tbuser`
-- ----------------------------
DROP TABLE IF EXISTS `tbuser`;
CREATE TABLE `tbuser` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idrole` int(11) NOT NULL,
  `companyid` int(11) DEFAULT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `fullname` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `salt` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `validationToken` longtext COLLATE utf8_unicode_ci,
  `active` tinyint(1) NOT NULL DEFAULT '0',
  `token` longtext COLLATE utf8_unicode_ci,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_6E54C30CF85E0677` (`username`),
  KEY `IDX_6E54C30C84A67BCA` (`idrole`),
  KEY `IDX_6E54C30CB104C381` (`companyid`),
  CONSTRAINT `FK_6E54C30C84A67BCA` FOREIGN KEY (`idrole`) REFERENCES `tbrol` (`id`),
  CONSTRAINT `FK_6E54C30CB104C381` FOREIGN KEY (`companyid`) REFERENCES `tbcompany` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of tbuser
-- ----------------------------
INSERT INTO `tbuser` VALUES ('1', '2', '1', 'juan@gmail.com', 'Juan perez', 'c7ababab42accb264e2f1fe23e3dcb95610c61ac086a321b1015a076d255933450966cd363a75616880996b84e23ffc2d4ad17ec10abbcd816617f5a7f4ae035', 'qkok70wwag0k0ckkgc0wco4k000o808', null, '1', null);
INSERT INTO `tbuser` VALUES ('2', '2', '1', 'juan1@gmail.com', 'Juan1', '2a17a440fe25e02511da2224f43d37df48d7fac6f55afacca97ebb27f5bfe62d91d6b48687c4f9cc2694783fb88a029e6c68f1b2b76c416a05fb58426fddffb3', '1kux12ivg9no4goss48og0kgogk848o', null, '0', null);
INSERT INTO `tbuser` VALUES ('4', '2', '1', 'juan2@gmail.com', 'AAahfhfh', 'de7e1fe04b94462cd23211e6efb5c75896bec8640ad0c9cd5229cf56f9f7d40f89421937c12dc66db4a9497309b1c3be5319fae2278a400273b7067a3e1a6ead', 'qhxpf7zq5jk8g4gg8g08ogs0kwocwsw', null, '1', null);
INSERT INTO `tbuser` VALUES ('5', '2', '1', 'usuario@ejemplo.com', 'Usuario', '304601b0bcc7b12c0d3ea91f4ac12bd7c6513bdcdaef9f609f308430203504a5f92796b9807868000f03dbecdee0739e7f95f5a5add9d0486723e2143e65c359', 'crpj6iosfy0wwokssccw8oo84kc0kw0', null, '0', null);
INSERT INTO `tbuser` VALUES ('6', '2', '1', 'test@ejemplo.com', 'Usuario', 'dc7924d305413c66c5e1db91fa4480c162c01bbea82a637e6694bca665d64295ab9400b5aeb7ec31cc6d1f93827431ca401cebd1e6ed2bbe38bfbbd964b5a4d1', 'dchx5vh7s5c0cgck8s0o04owg4cw8ks', null, '1', null);
INSERT INTO `tbuser` VALUES ('7', '2', '1', 'test2@ejemplo.com', 'Test User', '1c51190b3bbdd27b1f34985787c7e7db5943b5a11e100d990b423182f2045c11e6bd58c9b540b9ef6e270514ab951bdb64cdd7741fc8583edc341454e4662cba', 'io24q8hfz4004wg8g0wowsgg40gkcgo', null, '1', null);
