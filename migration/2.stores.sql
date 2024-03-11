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