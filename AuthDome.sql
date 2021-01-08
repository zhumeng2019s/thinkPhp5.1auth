/*
 Navicat Premium Data Transfer

 Source Server         : AuthDome
 Source Server Type    : MySQL
 Source Server Version : 50649
 Source Host           : 192.168.44.146:3306
 Source Schema         : AuthDome

 Target Server Type    : MySQL
 Target Server Version : 50649
 File Encoding         : 65001

 Date: 06/01/2021 23:19:18
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for think_auth_group
-- ----------------------------
DROP TABLE IF EXISTS `think_auth_group`;
CREATE TABLE `think_auth_group`  (
  `id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` char(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `rules` char(80) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 10 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Fixed;

-- ----------------------------
-- Records of think_auth_group
-- ----------------------------
INSERT INTO `think_auth_group` VALUES (1, '超级管理员', 1, '1,2,3,4,5,6,7,8,9,10,11,13,14,15,16,17');
INSERT INTO `think_auth_group` VALUES (2, '管理员', 1, '2,3,4,14,15,16');
INSERT INTO `think_auth_group` VALUES (3, '编辑员', 1, '2,14,15,16');
INSERT INTO `think_auth_group` VALUES (9, 'dome', 1, '14,2,3,4');

-- ----------------------------
-- Table structure for think_auth_group_access
-- ----------------------------
DROP TABLE IF EXISTS `think_auth_group_access`;
CREATE TABLE `think_auth_group_access`  (
  `uid` mediumint(8) UNSIGNED NOT NULL,
  `group_id` mediumint(8) UNSIGNED NOT NULL,
  UNIQUE INDEX `uid_group_id`(`uid`, `group_id`) USING BTREE,
  INDEX `uid`(`uid`) USING BTREE,
  INDEX `group_id`(`group_id`) USING BTREE
) ENGINE = MyISAM CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Fixed;

-- ----------------------------
-- Records of think_auth_group_access
-- ----------------------------
INSERT INTO `think_auth_group_access` VALUES (1, 1);
INSERT INTO `think_auth_group_access` VALUES (25, 2);
INSERT INTO `think_auth_group_access` VALUES (26, 3);
INSERT INTO `think_auth_group_access` VALUES (28, 9);

-- ----------------------------
-- Table structure for think_auth_rule
-- ----------------------------
DROP TABLE IF EXISTS `think_auth_rule`;
CREATE TABLE `think_auth_rule`  (
  `id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` char(80) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `title` char(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `type` tinyint(1) NOT NULL DEFAULT 1,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `condition` char(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `fid` mediumint(9) NULL DEFAULT 0,
  `pid` mediumint(9) NULL DEFAULT 0,
  `level` tinyint(1) NULL DEFAULT NULL,
  `sort` int(5) NULL DEFAULT NULL,
  `ico` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `name`(`name`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 18 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Fixed;

-- ----------------------------
-- Records of think_auth_rule
-- ----------------------------
INSERT INTO `think_auth_rule` VALUES (1, 'Admin/Add', '添加用户', 1, 1, '', 2, 2, NULL, NULL, NULL);
INSERT INTO `think_auth_rule` VALUES (2, 'Admin/adminlist', '用户列表', 1, 1, '', 1, 14, NULL, NULL, NULL);
INSERT INTO `think_auth_rule` VALUES (3, 'AuthGroup/index', '用户组列表', 1, 1, '', 1, 14, NULL, NULL, NULL);
INSERT INTO `think_auth_rule` VALUES (4, 'AuthRule/index', '规则列表', 1, 1, '', 1, 14, NULL, NULL, NULL);
INSERT INTO `think_auth_rule` VALUES (5, 'AuthGroup/edit', '用户组修改', 1, 1, '', 2, 3, NULL, NULL, NULL);
INSERT INTO `think_auth_rule` VALUES (6, 'Admin/Edit', '用户信息修改', 1, 1, '', 2, 2, NULL, NULL, NULL);
INSERT INTO `think_auth_rule` VALUES (7, 'Admin/Del', '用户删除', 1, 1, '', 2, 2, NULL, NULL, NULL);
INSERT INTO `think_auth_rule` VALUES (8, 'Admin/Status', '用户登陆权限', 1, 1, '', 2, 2, NULL, NULL, NULL);
INSERT INTO `think_auth_rule` VALUES (9, 'AuthGroup/groupAdd', '用户组添加', 1, 1, '', 2, 3, NULL, NULL, NULL);
INSERT INTO `think_auth_rule` VALUES (10, 'AuthGroup/groupDel', '用户组删除', 1, 1, '', 2, 3, NULL, NULL, NULL);
INSERT INTO `think_auth_rule` VALUES (11, 'AuthRule/ruleAdd', '规则添加', 1, 1, '', 2, 4, NULL, NULL, NULL);
INSERT INTO `think_auth_rule` VALUES (13, 'AuthRule/ruleDel', '规则删除', 1, 1, '', 2, 4, NULL, NULL, NULL);
INSERT INTO `think_auth_rule` VALUES (14, NULL, '会员管理', 1, 1, '', 0, 0, NULL, NULL, 'layui-icon-user');
INSERT INTO `think_auth_rule` VALUES (15, NULL, '文章管理', 1, 1, '', 0, 0, NULL, NULL, 'layui-icon-file-b');
INSERT INTO `think_auth_rule` VALUES (16, NULL, '配置信息', 1, 1, '', 0, 0, NULL, NULL, 'layui-icon-set-sm');
INSERT INTO `think_auth_rule` VALUES (17, 'AuthRule/ruleUpdata', '规则权限', 1, 1, '', 2, 4, NULL, NULL, NULL);

-- ----------------------------
-- Table structure for think_user
-- ----------------------------
DROP TABLE IF EXISTS `think_user`;
CREATE TABLE `think_user`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `username` varchar(20) CHARACTER SET utf8 COLLATE utf8_croatian_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8 COLLATE utf8_croatian_ci NOT NULL,
  `status` enum('0','1') CHARACTER SET utf8 COLLATE utf8_croatian_ci NOT NULL DEFAULT '1',
  `salt` varchar(5) CHARACTER SET utf8 COLLATE utf8_croatian_ci NOT NULL,
  `create_time` varchar(255) CHARACTER SET utf8 COLLATE utf8_croatian_ci NULL DEFAULT NULL,
  `updata_time` varchar(255) CHARACTER SET utf8 COLLATE utf8_croatian_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 29 CHARACTER SET = utf8 COLLATE = utf8_croatian_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of think_user
-- ----------------------------
INSERT INTO `think_user` VALUES (25, 'admin02', '4c4b3572654507a0ff8b76932048779e', '1', 'WOZiv', NULL, NULL);
INSERT INTO `think_user` VALUES (1, 'admin', '524ae50b4aaee5e433c2e9f33739498f', '1', 'T5mBN', NULL, NULL);
INSERT INTO `think_user` VALUES (26, 'admin03', '4c535ff1d0cbb8e3abc5323ab7ab4c64', '1', 'uAI8B', NULL, NULL);
INSERT INTO `think_user` VALUES (28, 'dome04', '28ceb9cf9a0b564bc452b722c0e22f10', '1', 'uphFd', '1609943524', NULL);

SET FOREIGN_KEY_CHECKS = 1;
