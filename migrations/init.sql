CREATE DATABASE IF NOT EXISTS interview;

USE interview;

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users`  (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `unique_email`(`email` ASC) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;


DROP TABLE IF EXISTS `stores`;
CREATE TABLE `stores`  (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `location` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 6 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;


INSERT INTO `stores` VALUES (1, 'Torre de Cristal', 'Planeta Zirak');
INSERT INTO `stores` VALUES (2, 'Floresta Encantada', 'Reino de Elyria');
INSERT INTO `stores` VALUES (3, 'Deserto dos Ventos', 'Planeta Kaitos');
INSERT INTO `stores` VALUES (4, 'Cavernas Submersas', 'Mundo Aquático de Neptar');
INSERT INTO `stores` VALUES (5, 'Vulcões Adormecidos', 'Ilhas de Fogo');


DROP TABLE IF EXISTS `orders`;
CREATE TABLE `orders`  (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `store_id` int UNSIGNED NULL DEFAULT NULL,
  `user_id` int UNSIGNED NULL DEFAULT NULL,
  `amount` float NULL DEFAULT NULL,
  `price` decimal(10, 2) NULL DEFAULT NULL,
  `created_at` datetime NULL DEFAULT current_timestamp ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `store_id`(`store_id` ASC) USING BTREE,
  INDEX `user_id`(`user_id` ASC) USING BTREE,
  CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`store_id`) REFERENCES `stores` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `orders_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

SET FOREIGN_KEY_CHECKS = 1;