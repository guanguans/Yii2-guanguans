/*
Navicat MySQL Data Transfer

Source Server         : phpstudy
Source Server Version : 50553
Source Host           : localhost:3306
Source Database       : yiiblog

Target Server Type    : MYSQL
Target Server Version : 50553
File Encoding         : 65001

Date: 2018-01-02 17:59:26
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for feehi_admin_user
-- ----------------------------
DROP TABLE IF EXISTS `feehi_admin_user`;
CREATE TABLE `feehi_admin_user` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '用户名',
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT '用户名',
  `auth_key` varchar(32) COLLATE utf8_unicode_ci NOT NULL COMMENT '授权token',
  `password_hash` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT '密码',
  `password_reset_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '重置密码taken',
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `avatar` varchar(255) COLLATE utf8_unicode_ci DEFAULT '',
  `status` smallint(6) NOT NULL DEFAULT '10',
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `password_reset_token` (`password_reset_token`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of feehi_admin_user
-- ----------------------------
INSERT INTO `feehi_admin_user` VALUES ('1', 'admin', 'zr9mY7lt23oAhj_ZYjydbLJKcbE3FJ19', '$2y$13$bqUaKgEeU.wXiLqEZIT.DelUYVgSpZeLSZrmho805PLMwukEWEJqG', null, '798314049@qq.como', '', '10', '1468288038', '1512957882');
