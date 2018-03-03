/*
Navicat MySQL Data Transfer

Source Server         : local
Source Server Version : 50505
Source Host           : localhost:3306
Source Database       : servicesdb

Target Server Type    : MYSQL
Target Server Version : 50505
File Encoding         : 65001

Date: 2018-03-02 22:43:56
*/

SET FOREIGN_KEY_CHECKS=0;

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
INSERT INTO `tbrol` VALUES ('1', 'ROLE_ADMINISTRATOR', 'System Administrator', 'System Administrator');
INSERT INTO `tbrol` VALUES ('2', 'ROLE_AUTHENTICATED', 'Authenticated User', 'Authenticated User');

-- ----------------------------
-- Table structure for `tbuser`
-- ----------------------------
DROP TABLE IF EXISTS `tbuser`;
CREATE TABLE `tbuser` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idrole` int(11) NOT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `salt` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `validationToken` longtext COLLATE utf8_unicode_ci,
  `active` tinyint(1) NOT NULL DEFAULT '0',
  `token` longtext COLLATE utf8_unicode_ci,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_6E54C30CF85E0677` (`username`),
  KEY `IDX_6E54C30C84A67BCA` (`idrole`),
  CONSTRAINT `FK_6E54C30C84A67BCA` FOREIGN KEY (`idrole`) REFERENCES `tbrol` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of tbuser
-- ----------------------------
INSERT INTO `tbuser` VALUES ('1', '1', 'prueba@gmail.com', 'Prueba', '35a44d7e2f9f6eb75ba9e4c2f6bcb33ef8162b855fffa90668c27292816aa93da3173d7051aad4b8791c6650027e19df29c54ad3d11b3e9d06022e3602660bee', 'ddfzyqj90y04kogs044w40wg8wcsg8c', null, '1', 'eyJhbGciOiJSUzI1NiIsInR5cCI6IkpXUyJ9.eyJ1c2VyaWQiOjEsInVzZXJuYW1lIjoia2Nhcm1lbmF0ZXNAdWNpLmN1IiwiaWF0IjoiMTUxOTg3MTY2OSJ9.Ol4tAPpti9f6TH0wiEzQ17omJGwyQjLQnPAFKhFM1oVbrRqHO93yaJtyiWNievsM6uJq5psvCEcPKjyUfoWw3g');
INSERT INTO `tbuser` VALUES ('2', '2', 'prueba1@gmail.com', 'Prueba', '15fa805ecd55acbc6bd479c789bde9679822df3090100e587c9f890d6e0556bbfe6d7c1b0dd2cae12151cf8061e49fe8c1b31fc1a2c61bf0e89e11796c3da165', 'e4kk00o3naosk4ssg8wg40wkwkcw4ck', null, '1', null);
INSERT INTO `tbuser` VALUES ('3', '2', 'prueba2@gmail.com', 'Prueba', '94125b8cdef349c2d4410f2ee502b442de952f47353a95da27f539c7ee5c591ad3e4ef0cada00195164c9e02f00d385cb212479fb1e2d71972947d00d308ba5e', 'ltzd3clzs408oc8s4go4wos4cw8kgks', null, '0', null);
INSERT INTO `tbuser` VALUES ('5', '2', 'juan@gmail.com', 'Juan Pedro', 'b48302e060453a5ff44dd1f1adb752971ad0a2ace657a0c9d03e079ef0e31c02bd61691e29a3b0ab1bd9d81e65060f8a46577cb6a5638d4b18018f1e0b042c84', 'ewbqh3o9avwwsc8gwkccgkcsw00gg8k', null, '1', null);
