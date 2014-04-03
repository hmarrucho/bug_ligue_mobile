-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- Client: localhost
-- Généré le: Mer 02 Avril 2014 à 18:08
-- Version du serveur: 5.6.12-log
-- Version de PHP: 5.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données: `lms_bug`
--
CREATE DATABASE IF NOT EXISTS `lms_bug` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `lms_bug`;

-- --------------------------------------------------------

--
-- Structure de la table `bug_product`
--

CREATE TABLE IF NOT EXISTS `bug_product` (
  `bug_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  PRIMARY KEY (`bug_id`,`product_id`),
  KEY `IDX_897D061DFA3DB3D5` (`bug_id`),
  KEY `IDX_897D061D4584665A` (`product_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `bug_product`
--

INSERT INTO `bug_product` (`bug_id`, `product_id`) VALUES
(3, 2),
(4, 3),
(5, 4),
(6, 1);

-- --------------------------------------------------------

--
-- Structure de la table `bugs`
--

CREATE TABLE IF NOT EXISTS `bugs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `engineer_id` int(11) DEFAULT NULL,
  `reporter_id` int(11) DEFAULT NULL,
  `resume` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `note` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created` datetime NOT NULL,
  `status` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `priorite` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_1E197C9F8D8CDF1` (`engineer_id`),
  KEY `IDX_1E197C9E1CFE6F5` (`reporter_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=7 ;

--
-- Contenu de la table `bugs`
--

INSERT INTO `bugs` (`id`, `engineer_id`, `reporter_id`, `resume`, `description`, `note`, `created`, `status`, `priorite`, `image`) VALUES
(3, NULL, 2, 'Probleme souris', 'Soucis lors du clic', NULL, '2014-04-02 17:28:13', 'Ouvert', 'Normal', 'images/capturebug/3.jpg'),
(4, 1, 2, 'Pixel mort', 'Ecran cassÃ©', NULL, '2014-04-02 17:36:39', 'Ouvert', 'Normal', NULL),
(5, 4, 2, 'Bug carte mÃ¨re', 'bug de la carte mÃ¨re ', 'Changement de la carte', '2014-04-02 17:38:50', 'Clos', 'Normal', NULL),
(6, 3, 3, 'Touche MAJ', 'Touche majuscule ne fonctionne plus', NULL, '2014-04-02 17:51:56', 'Ouvert', 'Haut', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `club`
--

CREATE TABLE IF NOT EXISTS `club` (
  `numClub` int(11) NOT NULL AUTO_INCREMENT,
  `nomClub` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `adresseClub` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `cpClub` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `villeClub` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `telClub` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `mailClub` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `imgClub` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `codeFFF` int(11) NOT NULL,
  `mdpClub` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`numClub`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4 ;

--
-- Contenu de la table `club`
--

INSERT INTO `club` (`numClub`, `nomClub`, `adresseClub`, `cpClub`, `villeClub`, `telClub`, `mailClub`, `imgClub`, `codeFFF`, `mdpClub`) VALUES
(1, 'PARIS Saint Germain', '24 rue du Commandant Guilbaud', '7581', 'PARIS Cedex 16', '0141107110', 'infos@psg.com', '', 12345, '12345'),
(2, 'Olympique de Marseille', 'La Commanderie 33 ', '13425', 'MARSEILLE', '0491765609', 'infos@om.com', '', 123456, '12345'),
(3, 'Olympique Lyonnais', '350 avenue Jean Jaures', '69007', 'Lyon', '0426296700', 'infos@ol.com', '', 1234567, '12345');

-- --------------------------------------------------------

--
-- Structure de la table `products`
--

CREATE TABLE IF NOT EXISTS `products` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=5 ;

--
-- Contenu de la table `products`
--

INSERT INTO `products` (`id`, `name`) VALUES
(1, 'clavier'),
(2, 'souris'),
(3, 'ecran'),
(4, 'tour');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `prenom` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `fonction` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `login` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `mdp` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `courriel` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `leClub` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_1483A5E9A6BEDEEF` (`leClub`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=5 ;

--
-- Contenu de la table `users`
--

INSERT INTO `users` (`id`, `name`, `prenom`, `fonction`, `login`, `mdp`, `courriel`, `leClub`) VALUES
(1, 'Silva', 'Thibaut', 'Technicien', 'tsilva', '12345', 'silva.thibaut@gmail.com', NULL),
(2, 'Lemarquis', 'Sulivan', 'Club', 'slemarquis', '12345', 'lemarquis.sulivan55@gmail.com', 3),
(3, 'Marrucho', 'Helen', 'Technicien', 'hmarrucho', '12345', 'helen.marrucho@gmail.com', NULL),
(4, 'Dondelinger', 'Eric', 'Responsable', 'edondelinger', '12345', 'eric.dondelinger@gmail.com', NULL);

--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `bug_product`
--
ALTER TABLE `bug_product`
  ADD CONSTRAINT `FK_897D061D4584665A` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_897D061DFA3DB3D5` FOREIGN KEY (`bug_id`) REFERENCES `bugs` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `bugs`
--
ALTER TABLE `bugs`
  ADD CONSTRAINT `FK_1E197C9E1CFE6F5` FOREIGN KEY (`reporter_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `FK_1E197C9F8D8CDF1` FOREIGN KEY (`engineer_id`) REFERENCES `users` (`id`);

--
-- Contraintes pour la table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `FK_1483A5E9A6BEDEEF` FOREIGN KEY (`leClub`) REFERENCES `club` (`numClub`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
