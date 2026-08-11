/*
 Navicat Premium Data Transfer

 Source Server         : Local
 Source Server Type    : MySQL
 Source Server Version : 80030 (8.0.30)
 Source Host           : localhost:3306
 Source Schema         : scholardb

 Target Server Type    : MySQL
 Target Server Version : 80030 (8.0.30)
 File Encoding         : 65001

 Date: 15/02/2025 01:42:33
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for application_remarks
-- ----------------------------
DROP TABLE IF EXISTS `application_remarks`;
CREATE TABLE `application_remarks`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `studentID` int NOT NULL,
  `remarks` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of application_remarks
-- ----------------------------

-- ----------------------------
-- Table structure for applications
-- ----------------------------
DROP TABLE IF EXISTS `applications`;
CREATE TABLE `applications`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `userID` int NOT NULL,
  `scholarshipID` int NOT NULL,
  `requirementFile` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `requirementFile2` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `requirementFile3` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `requirementFile4` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `paymentAddress` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of applications
-- ----------------------------

-- ----------------------------
-- Table structure for balances
-- ----------------------------
DROP TABLE IF EXISTS `balances`;
CREATE TABLE `balances`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `userID` int NOT NULL,
  `amount` decimal(10, 4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of balances
-- ----------------------------
INSERT INTO `balances` VALUES (1, 2, 1500.0000, '2025-02-12 09:20:44', '2025-02-12 09:20:44');

-- ----------------------------
-- Table structure for cashins
-- ----------------------------
DROP TABLE IF EXISTS `cashins`;
CREATE TABLE `cashins`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `userID` int NOT NULL,
  `amount` decimal(10, 2) NOT NULL,
  `ethAmount` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `transactionHash` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of cashins
-- ----------------------------
INSERT INTO `cashins` VALUES (1, 2, 1000.00, '0.0065599', '0xf199d6c18abf37fde5c69b5e4b084939caa8b6e6066735284e986dcae8579a62', '2025-02-12 09:29:19', '2025-02-12 09:29:19');
INSERT INTO `cashins` VALUES (2, 2, 1000.00, '0.0064776', '0x3348f942c70b1603f3aa1195b41f2c5cceb16790fafd0db02d8e5446da5ba904', '2025-02-13 15:54:41', '2025-02-13 15:54:41');

-- ----------------------------
-- Table structure for migrations
-- ----------------------------
DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations`  (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 12 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of migrations
-- ----------------------------
INSERT INTO `migrations` VALUES (1, '2019_12_14_000001_create_personal_access_tokens_table', 1);
INSERT INTO `migrations` VALUES (2, '2024_12_23_175821_create_users_table', 1);
INSERT INTO `migrations` VALUES (3, '2024_12_23_200112_create_students_table', 1);
INSERT INTO `migrations` VALUES (5, '2024_12_27_090047_create_applications_table', 1);
INSERT INTO `migrations` VALUES (6, '2024_12_27_145112_create_application_remarks_table', 1);
INSERT INTO `migrations` VALUES (7, '2024_12_27_153441_create_notifications_table', 1);
INSERT INTO `migrations` VALUES (8, '2025_02_09_175657_create_transactions_table', 1);
INSERT INTO `migrations` VALUES (9, '2025_02_09_195525_create_cashins_table', 1);
INSERT INTO `migrations` VALUES (10, '2025_02_09_200119_create_balances_table', 1);
INSERT INTO `migrations` VALUES (11, '2024_12_27_070309_create_scholarships_table', 2);

-- ----------------------------
-- Table structure for notifications
-- ----------------------------
DROP TABLE IF EXISTS `notifications`;
CREATE TABLE `notifications`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `userID` int NOT NULL,
  `message` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of notifications
-- ----------------------------
INSERT INTO `notifications` VALUES (1, 2, 'A Student Applies In One Of Your Scholarship Programs, Please Check Applications Page', 'unread', '2025-02-14 17:29:03', '2025-02-14 17:29:03');

-- ----------------------------
-- Table structure for personal_access_tokens
-- ----------------------------
DROP TABLE IF EXISTS `personal_access_tokens`;
CREATE TABLE `personal_access_tokens`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `personal_access_tokens_token_unique`(`token` ASC) USING BTREE,
  INDEX `personal_access_tokens_tokenable_type_tokenable_id_index`(`tokenable_type` ASC, `tokenable_id` ASC) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of personal_access_tokens
-- ----------------------------

-- ----------------------------
-- Table structure for scholarships
-- ----------------------------
DROP TABLE IF EXISTS `scholarships`;
CREATE TABLE `scholarships`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `userID` int NOT NULL,
  `orgName` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `scholarshipName` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `scholarshipAmount` decimal(10, 4) NOT NULL,
  `numberOfRespondents` int NOT NULL,
  `requirements` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of scholarships
-- ----------------------------

-- ----------------------------
-- Table structure for students
-- ----------------------------
DROP TABLE IF EXISTS `students`;
CREATE TABLE `students`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `userID` int NOT NULL,
  `profile` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `first_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `middle_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `last_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `birth_date` date NOT NULL,
  `gender` enum('male','female') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `contact_number` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `school` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `school_date` date NOT NULL,
  `father_first_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `father_middle_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `father_last_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `father_birth_date` date NOT NULL,
  `father_occupation` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `father_contact_number` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `mother_first_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `mother_middle_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `mother_last_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `mother_birth_date` date NOT NULL,
  `mother_occupation` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `mother_contact_number` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `monthly_gross` decimal(10, 4) NOT NULL,
  `monthly_net` decimal(10, 4) NOT NULL,
  `grade` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of students
-- ----------------------------
INSERT INTO `students` VALUES (1, 1, '1739357049.png', 'sample', 'sample', 'sample', '0xc842251Cf2922425699F35500F736af81e96B463', '1998-10-13', 'male', '090945454', 'ACLC', '2025-02-12', 'asdasd', 'asdasda', 'asdasd', '2025-02-12', 'asdasd', '123123123', 'asdasd', 'asdasd', 'asdasd', '2025-02-12', 'asdasdasd', '123123', 123123.0000, 123123.0000, '1739357049.png', '2025-02-12 10:44:09', '2025-02-12 10:44:09');

-- ----------------------------
-- Table structure for transactions
-- ----------------------------
DROP TABLE IF EXISTS `transactions`;
CREATE TABLE `transactions`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `applicationID` int NOT NULL,
  `status` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `amountReceived` decimal(10, 2) NULL DEFAULT NULL,
  `transactionHash` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of transactions
-- ----------------------------

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users`  (
  `userID` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `firstName` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `middleName` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `lastName` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(180) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `birthDate` date NOT NULL,
  `gender` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `userType` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`userID`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES (1, 'sample', 'sample', 'sample', '0xc842251Cf2922425699F35500F736af81e96B463', '1998-10-13', 'male', 'sample@gmail.com', '$2y$12$eyA3MtMQkmIQclw4Cgql8u.6rUPfNFZ6mrBe6dPK59QX7ZRbikTFm', 'user', 'active', '2025-02-10 02:30:19', '2025-02-10 02:30:19');
INSERT INTO `users` VALUES (2, 'org', 'org', 'org', 'none', '1998-06-09', 'male', 'org@gmail.com', '$2y$12$wW0gwzrThgGYME7gbCKHeevzoEwGPu17YV0k5bNKZUhBNn1zigfm2', 'org', 'active', '2025-02-10 02:31:04', '2025-02-10 02:31:04');

-- ----------------------------
-- View structure for vwapplications
-- ----------------------------
DROP VIEW IF EXISTS `vwapplications`;
CREATE ALGORITHM = UNDEFINED SQL SECURITY DEFINER VIEW `vwapplications` AS select `scholarships`.`id` AS `id`,`scholarships`.`userID` AS `userID`,`scholarships`.`orgName` AS `orgName`,`scholarships`.`scholarshipName` AS `scholarshipName`,`scholarships`.`requirements` AS `requirements`,`scholarships`.`status` AS `status`,`scholarships`.`created_at` AS `created_at`,`scholarships`.`updated_at` AS `updated_at`,`applications`.`id` AS `applicationID`,`applications`.`scholarshipID` AS `scholarshipID`,`applications`.`requirementFile` AS `requirementFile`,`applications`.`requirementFile2` AS `requirementFile2`,`applications`.`requirementFile3` AS `requirementFile3`,`applications`.`requirementFile4` AS `requirementFile4`,`applications`.`paymentAddress` AS `paymentAddress`,`applications`.`status` AS `applicationStatus`,`applications`.`created_at` AS `applicationCreateDate`,`users`.`firstName` AS `firstName`,`users`.`middleName` AS `middleName`,`users`.`lastName` AS `lastName`,`users`.`userID` AS `studentID`,`scholarships`.`scholarshipAmount` AS `scholarshipAmount` from ((`users` join `scholarships`) join `applications` on(((`scholarships`.`id` = `applications`.`scholarshipID`) and (`users`.`userID` = `applications`.`userID`))));

-- ----------------------------
-- View structure for vwtransactions
-- ----------------------------
DROP VIEW IF EXISTS `vwtransactions`;
CREATE ALGORITHM = UNDEFINED SQL SECURITY DEFINER VIEW `vwtransactions` AS select distinct `transactions`.`id` AS `id`,`transactions`.`applicationID` AS `applicationID`,`transactions`.`status` AS `status`,`transactions`.`amountReceived` AS `amountReceived`,`transactions`.`transactionHash` AS `transactionHash`,`transactions`.`created_at` AS `created_at`,`transactions`.`updated_at` AS `updated_at`,`scholarships`.`id` AS `scholarshipID`,`scholarships`.`scholarshipName` AS `scholarshipName`,`applications`.`userID` AS `studentID`,`applications`.`paymentAddress` AS `studentPaymentAddress`,`scholarships`.`userID` AS `ownerID`,`users`.`firstName` AS `firstName`,`users`.`middleName` AS `middleName`,`users`.`lastName` AS `lastName`,`scholarships`.`orgName` AS `orgName`,`scholarships`.`scholarshipAmount` AS `scholarshipAmount` from (((`applications` join `transactions` on((`applications`.`id` = `transactions`.`applicationID`))) join `scholarships` on((`applications`.`scholarshipID` = `scholarships`.`id`))) join `users` on((`applications`.`userID` = `users`.`userID`)));

SET FOREIGN_KEY_CHECKS = 1;
