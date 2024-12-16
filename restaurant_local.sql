-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : lun. 16 déc. 2024 à 09:39
-- Version du serveur : 8.0.31
-- Version de PHP : 8.0.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `restaurant_local`
--

-- --------------------------------------------------------

--
-- Structure de la table `category`
--

DROP TABLE IF EXISTS `category`;
CREATE TABLE IF NOT EXISTS `category` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `category`
--

INSERT INTO `category` (`id`, `name`) VALUES
(2, 'Starter'),
(3, 'Desserts'),
(4, 'Main courses'),
(5, 'Beverages');

-- --------------------------------------------------------

--
-- Structure de la table `customer`
--

DROP TABLE IF EXISTS `customer`;
CREATE TABLE IF NOT EXISTS `customer` (
  `customer_id` int NOT NULL AUTO_INCREMENT,
  `first_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone_number` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `roles` json NOT NULL,
  PRIMARY KEY (`customer_id`),
  UNIQUE KEY `UNIQ_81398E09E7927C74` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `customer`
--

INSERT INTO `customer` (`customer_id`, `first_name`, `phone_number`, `email`, `password`, `last_name`, `roles`) VALUES
(2, 'Romain', '0782685140', 'romaintbrossault@gmail.com', '$2y$13$Z446q4eB196LUTAJwF1QzeFeyYsvfUe505DaOeFYFJnR0KfcKnqjG', 'Brossault', '[]'),
(3, 'admin', '0949487774784', 'admin@restaurant.com', '$2y$13$rhtJwj3P8qnItxcGAPWOPerTXD4Yan3QdtpiB47gs.deowQQ5J0JK', 'admin', '[]'),
(4, 'Lajaz', '06000000000', 'Lajazmartineau44@gmail.com', '$2y$13$taU6DGjP8lNqQ5HxnYEoRO9tPAHVlSO/BlDTMjfjwxNeMHpodfurS', 'Martineau', '[]');

-- --------------------------------------------------------

--
-- Structure de la table `doctrine_migration_versions`
--

DROP TABLE IF EXISTS `doctrine_migration_versions`;
CREATE TABLE IF NOT EXISTS `doctrine_migration_versions` (
  `version` varchar(191) COLLATE utf8mb3_unicode_ci NOT NULL,
  `executed_at` datetime DEFAULT NULL,
  `execution_time` int DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Déchargement des données de la table `doctrine_migration_versions`
--

INSERT INTO `doctrine_migration_versions` (`version`, `executed_at`, `execution_time`) VALUES
('DoctrineMigrations\\Version20241205151842', '2024-12-05 15:19:00', 18),
('DoctrineMigrations\\Version20241211083158', '2024-12-11 08:32:06', 51),
('DoctrineMigrations\\Version20241211083824', '2024-12-11 08:38:29', 62),
('DoctrineMigrations\\Version20241211084114', '2024-12-11 08:41:19', 68),
('DoctrineMigrations\\Version20241211102800', '2024-12-11 10:39:35', 68),
('DoctrineMigrations\\Version20241216080448', '2024-12-16 08:05:09', 65);

-- --------------------------------------------------------

--
-- Structure de la table `item`
--

DROP TABLE IF EXISTS `item`;
CREATE TABLE IF NOT EXISTS `item` (
  `id` int NOT NULL AUTO_INCREMENT,
  `category_id` int NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_1F1B251E12469DE2` (`category_id`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `item`
--

INSERT INTO `item` (`id`, `category_id`, `name`) VALUES
(3, 2, 'Duck Foie Gras'),
(4, 2, 'French Onion Soup'),
(6, 4, 'Beef bourguinon'),
(7, 3, 'Assorted Macarons'),
(8, 5, 'French Wines'),
(9, 3, 'Crème Brûlée'),
(10, 3, 'Fruit Charlotte'),
(11, 3, 'Tarte Tatin'),
(12, 3, 'Chocolate Soufflé'),
(13, 4, 'Coq au Vin'),
(14, 4, 'Sole Meunière'),
(15, 4, 'Duck Breast with Figs'),
(16, 5, 'Champagne Glass/Bottle'),
(17, 5, 'Cognac Glass/Bottle'),
(18, 5, 'Kir Royal'),
(19, 5, 'Pastis'),
(20, 2, 'Burgundy Snails'),
(21, 2, 'Scallop Tartare with Citrus and Caviar'),
(22, 2, 'Goat Cheese Salad with Toasted Baguette'),
(23, 4, 'Tournedos Rossini');

-- --------------------------------------------------------

--
-- Structure de la table `menu`
--

DROP TABLE IF EXISTS `menu`;
CREATE TABLE IF NOT EXISTS `menu` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `menu`
--

INSERT INTO `menu` (`id`, `name`) VALUES
(4, 'Best menu'),
(5, 'The Frenchie'),
(6, 'La Belle Epoque'),
(7, 'Simple Pleasures'),
(8, 'Prestige');

-- --------------------------------------------------------

--
-- Structure de la table `menu_items`
--

DROP TABLE IF EXISTS `menu_items`;
CREATE TABLE IF NOT EXISTS `menu_items` (
  `menu_id` int NOT NULL,
  `item_id` int NOT NULL,
  PRIMARY KEY (`menu_id`,`item_id`),
  KEY `IDX_70B2CA2ACCD7E912` (`menu_id`),
  KEY `IDX_70B2CA2A126F525E` (`item_id`)
) ENGINE=MyISAM AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `menu_items`
--

INSERT INTO `menu_items` (`menu_id`, `item_id`) VALUES
(2, 2),
(4, 3),
(4, 6),
(4, 7),
(5, 4),
(5, 6),
(5, 8),
(5, 11),
(6, 9),
(6, 15),
(6, 17),
(6, 21),
(7, 7),
(7, 13),
(7, 19),
(7, 20),
(8, 12),
(8, 18),
(8, 22),
(8, 23);

-- --------------------------------------------------------

--
-- Structure de la table `messenger_messages`
--

DROP TABLE IF EXISTS `messenger_messages`;
CREATE TABLE IF NOT EXISTS `messenger_messages` (
  `id` bigint NOT NULL AUTO_INCREMENT,
  `body` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `headers` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue_name` varchar(190) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  `available_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  `delivered_at` datetime DEFAULT NULL COMMENT '(DC2Type:datetime_immutable)',
  PRIMARY KEY (`id`),
  KEY `IDX_75EA56E0FB7336F0` (`queue_name`),
  KEY `IDX_75EA56E0E3BD61CE` (`available_at`),
  KEY `IDX_75EA56E016BA31DB` (`delivered_at`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `reservation`
--

DROP TABLE IF EXISTS `reservation`;
CREATE TABLE IF NOT EXISTS `reservation` (
  `id` int NOT NULL AUTO_INCREMENT,
  `customer_id` int NOT NULL,
  `table_id` int NOT NULL,
  `reservation_date` date NOT NULL,
  `reservation_time` time NOT NULL,
  `guest_count` int NOT NULL,
  `special_requests` longtext COLLATE utf8mb4_unicode_ci,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `reservation`
--

INSERT INTO `reservation` (`id`, `customer_id`, `table_id`, `reservation_date`, `reservation_time`, `guest_count`, `special_requests`) VALUES
(3, 2, 1, '2024-12-18', '12:17:00', 12, 'aucune'),
(4, 2, 1, '2024-12-16', '21:00:00', 1, 'Table de 8 meme si je suis seul'),
(5, 3, 1, '2024-12-20', '14:00:00', 2, 'mariage');

-- --------------------------------------------------------

--
-- Structure de la table `restaurant_table`
--

DROP TABLE IF EXISTS `restaurant_table`;
CREATE TABLE IF NOT EXISTS `restaurant_table` (
  `id` int NOT NULL AUTO_INCREMENT,
  `number` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `restaurant_table`
--

INSERT INTO `restaurant_table` (`id`, `number`) VALUES
(1, 1),
(2, 2),
(3, 3),
(4, 4),
(5, 5),
(6, 6),
(7, 7),
(8, 8),
(9, 9);

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `item`
--
ALTER TABLE `item`
  ADD CONSTRAINT `FK_1F1B251E12469DE2` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
