-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3308
-- Version du serveur : 8.2.0
-- Version de PHP : 8.2.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `hotel`
--

-- --------------------------------------------------------

--
-- Structure de la table `bedroom`
--

DROP TABLE IF EXISTS `bedroom`;
CREATE TABLE IF NOT EXISTS `bedroom` (
  `id` int NOT NULL AUTO_INCREMENT,
  `number` int NOT NULL,
  `double_bed` tinyint(1) NOT NULL,
  `double_king_bed` tinyint(1) NOT NULL,
  `balcon` tinyint(1) NOT NULL,
  `category_id` int NOT NULL,
  `price` int NOT NULL,
  `description` varchar(500) COLLATE utf8mb4_general_ci NOT NULL,
  `file` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_foreign_category` (`category_id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `bedroom`
--

INSERT INTO `bedroom` (`id`, `number`, `double_bed`, `double_king_bed`, `balcon`, `category_id`, `price`, `description`, `file`) VALUES
(7, 110, 1, 0, 0, 1, 70, 'Chambre double vue mer', 'chambre1normal.png'),
(9, 115, 1, 1, 0, 3, 100, 'Chambre familiale spacieuse et lumineuse', 'chambre1familiale.png'),
(11, 150, 0, 1, 1, 2, 100, 'Chambre double supérieure avec balcon vue mer', 'chambre3balconvuemer.png'),
(12, 200, 1, 0, 0, 1, 60, 'Chambre double confortable', 'chambre1normal.png'),
(14, 300, 0, 1, 0, 2, 90, 'Chambre double supérieure vue mer ', 'chambre1vuemer.png'),
(17, 100, 1, 1, 0, 3, 105, 'Chambre familiale spacieuse', 'chambre2vuemer.png'),
(18, 120, 1, 0, 0, 1, 60, 'Chambre double lumineuse', 'chambre2balconvuemer.png'),
(19, 450, 1, 1, 1, 3, 120, 'Chambre familiale ', 'chambre1familiale.png');

-- --------------------------------------------------------

--
-- Structure de la table `category`
--

DROP TABLE IF EXISTS `category`;
CREATE TABLE IF NOT EXISTS `category` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `category`
--

INSERT INTO `category` (`id`, `name`) VALUES
(1, 'Double'),
(2, 'Double Supérieure'),
(3, 'Familiale');

-- --------------------------------------------------------

--
-- Structure de la table `reservation`
--

DROP TABLE IF EXISTS `reservation`;
CREATE TABLE IF NOT EXISTS `reservation` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `bedroom_id` int NOT NULL,
  `arrival` date NOT NULL,
  `departure` date NOT NULL,
  `adultes` int NOT NULL,
  `enfants` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_foreign_user` (`user_id`),
  KEY `fk_foreign_berdoom` (`bedroom_id`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `reservation`
--

INSERT INTO `reservation` (`id`, `user_id`, `bedroom_id`, `arrival`, `departure`, `adultes`, `enfants`) VALUES
(8, 2, 7, '2024-03-13', '2024-03-15', 1, 1),
(9, 4, 7, '2024-04-17', '2024-04-21', 1, 1),
(11, 3, 11, '2024-04-20', '2024-04-25', 2, 0),
(14, 3, 12, '2024-06-21', '2024-06-28', 2, 0),
(16, 2, 9, '2024-08-14', '2024-08-19', 2, 2),
(22, 2, 18, '2024-05-16', '2024-05-20', 2, 0),
(23, 7, 18, '2024-04-19', '2024-04-21', 1, 1),
(24, 3, 19, '2024-04-25', '2024-04-30', 2, 2);

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int NOT NULL AUTO_INCREMENT,
  `pseudo` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `mail` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `isAdmin` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `pseudo`, `mail`, `password`, `isAdmin`) VALUES
(2, 'amandine', 'a@gmail.com', '$argon2i$v=19$m=65536,t=4,p=1$ZW9EemNUVFFXUU5xMlNUZg$Glc/FkIWQJqiV2L9Pi2qiiRLtQYq3IKwUxT6ggchGvM', 0),
(3, 'admin', 'admin@gmail.com', '$argon2i$v=19$m=65536,t=4,p=1$VUxXS0RNUnZJdnVCYndxMQ$PXMviybZqS3IN/6i5OmkKgGz2/8xF0Sab5sE/z3S1qs', 1),
(4, 'test', 'test@test', '$argon2i$v=19$m=65536,t=4,p=1$V1JORVAwcmRZdUtNaVVGQQ$Rwjd87GwexIRCj09AHWZjQu8QROH3FmEwvaHCFyeJXg', 0),
(7, 'cours', 'cours@gmail.com', '$argon2i$v=19$m=65536,t=4,p=1$ZHladmVvZ3VlSVVTS21Ncw$7tTnQHCCuN0pmmTzg6N/x51LVl414TcrP2jjAFkMxk0', 0);

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `bedroom`
--
ALTER TABLE `bedroom`
  ADD CONSTRAINT `fk_foreign_category` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Contraintes pour la table `reservation`
--
ALTER TABLE `reservation`
  ADD CONSTRAINT `fk_foreign_berdoom` FOREIGN KEY (`bedroom_id`) REFERENCES `bedroom` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `fk_foreign_user` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
