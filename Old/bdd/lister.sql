-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : mar. 01 déc. 2020 à 20:19
-- Version du serveur :  5.7.31
-- Version de PHP : 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `lister`
--

-- --------------------------------------------------------

--
-- Structure de la table `categories`
--

DROP TABLE IF EXISTS `categories`;
CREATE TABLE IF NOT EXISTS `categories` (
  `Categorie_id` int(11) NOT NULL AUTO_INCREMENT,
  `category_name` varchar(50) NOT NULL,
  PRIMARY KEY (`Categorie_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `ligneliste`
--

DROP TABLE IF EXISTS `ligneliste`;
CREATE TABLE IF NOT EXISTS `ligneliste` (
  `id_ligneList` int(11) NOT NULL AUTO_INCREMENT,
  `quantite` int(11) NOT NULL,
  `terminer` tinyint(1) NOT NULL,
  `id_liste` int(11) NOT NULL,
  `id_produit` int(11) NOT NULL,
  PRIMARY KEY (`id_ligneList`),
  KEY `LIGNELISTE_LISTE_FK` (`id_liste`),
  KEY `LIGNELISTE_PRODUITS0_FK` (`id_produit`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `liste`
--

DROP TABLE IF EXISTS `liste`;
CREATE TABLE IF NOT EXISTS `liste` (
  `id_liste` int(11) NOT NULL AUTO_INCREMENT,
  `titre` varchar(50) NOT NULL,
  `description` varchar(50) NOT NULL,
  `date_creation` date NOT NULL,
  `date_modification` date NOT NULL,
  `id_user` int(11) NOT NULL,
  PRIMARY KEY (`id_liste`),
  KEY `LISTE_USER_FK` (`id_user`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `produits`
--

DROP TABLE IF EXISTS `produits`;
CREATE TABLE IF NOT EXISTS `produits` (
  `id_produit` int(11) NOT NULL AUTO_INCREMENT,
  `produit_name` varchar(100) NOT NULL,
  `Categorie_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_produit`),
  KEY `PRODUITS_CATEGORIES_FK` (`Categorie_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id_user` int(11) NOT NULL AUTO_INCREMENT,
  `firstname` varchar(50) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `pass` varchar(255) NOT NULL,
  `register_at` date NOT NULL,
  `register_token` varchar(255) NOT NULL,
  `confirm_at` date NOT NULL,
  `confirm_token` varchar(255) NOT NULL,
  `level` int(11) NOT NULL,
  PRIMARY KEY (`id_user`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `ligneliste`
--
ALTER TABLE `ligneliste`
  ADD CONSTRAINT `LIGNELISTE_LISTE_FK` FOREIGN KEY (`id_liste`) REFERENCES `liste` (`id_liste`),
  ADD CONSTRAINT `LIGNELISTE_PRODUITS0_FK` FOREIGN KEY (`id_produit`) REFERENCES `produits` (`id_produit`);

--
-- Contraintes pour la table `liste`
--
ALTER TABLE `liste`
  ADD CONSTRAINT `LISTE_USER_FK` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`);

--
-- Contraintes pour la table `produits`
--
ALTER TABLE `produits`
  ADD CONSTRAINT `PRODUITS_CATEGORIES_FK` FOREIGN KEY (`Categorie_id`) REFERENCES `categories` (`Categorie_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
