-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : lun. 24 jan. 2022 à 17:08
-- Version du serveur : 10.4.22-MariaDB
-- Version de PHP : 8.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `brief_4`
--

-- --------------------------------------------------------

--
-- Structure de la table `employe`
--

CREATE TABLE `employe` (
  `id` int(10) UNSIGNED NOT NULL,
  `firstname` text NOT NULL,
  `lastname` text NOT NULL,
  `username` text NOT NULL,
  `password_users` text NOT NULL,
  `reg_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `employe`
--

INSERT INTO `employe` (`id`, `firstname`, `lastname`, `username`, `password_users`, `reg_date`) VALUES
(76, 'lhoussaine', 'hssini', 'kahout', '$2y$10$ySOUN46QCY1f41RbI5gUJ.xxlYNPWaaMAQiHrxwrKvU3UNZYlwqM6', '2022-01-23 13:24:17'),
(77, 'kk', 'kk', 'kk', '$2y$10$zb5L/lj5Ba5MHQIF9ojeO.kODbmGXxGfVxxnAyo2V8dEAnCm9ALhO', '2022-01-23 13:24:35'),
(80, 'hgavdvs', 'sydfudf', 'agfusdcuy', '$2y$10$mVuyKnmwuTVRNDWM3a28sej1Z4EUdUOYupMKu.Gxq09RcjHkCQTNq', '2022-01-24 08:58:33');

-- --------------------------------------------------------

--
-- Structure de la table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `titres` varchar(30) NOT NULL,
  `categore` varchar(20) NOT NULL,
  `quantite` int(11) NOT NULL,
  `prix` int(11) NOT NULL,
  `name_image` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `products`
--

INSERT INTO `products` (`id`, `titres`, `categore`, `quantite`, `prix`, `name_image`) VALUES
(8, 'kra', 'Philosophie', 1, 4, 'book_1_kra.jpg'),
(9, 'azdzaazdd', 'Entreprise', 4, 5, 'book_1.jpg'),
(10, 'dzadza', 'Voyager', 8, 10, 'abt.jpg'),
(11, 'azzdzdz', 'Philosophie', 8, 10, 'dd.jpg'),
(13, 'feefez', 'Voyager', 4, 3, '1.jpg');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `employe`
--
ALTER TABLE `employe`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `employe`
--
ALTER TABLE `employe`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=81;

--
-- AUTO_INCREMENT pour la table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
