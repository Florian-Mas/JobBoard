-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : ven. 17 oct. 2025 à 13:55
-- Version du serveur : 10.4.32-MariaDB
-- Version de PHP : 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `jobboard`
--

-- --------------------------------------------------------

--
-- Structure de la table `application`
--

CREATE TABLE `application` (
  `user_ID` int(11) NOT NULL,
  `enterprise_id` int(11) NOT NULL,
  `email` varchar(64) NOT NULL,
  `commentary` text NOT NULL,
  `phone_number` varchar(14) NOT NULL,
  `Nom` varchar(32) NOT NULL,
  `Prenom` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `entreprise`
--

CREATE TABLE `entreprise` (
  `ID` int(11) NOT NULL,
  `Owners` text NOT NULL,
  `Nom` text NOT NULL,
  `Description` text NOT NULL,
  `Vérifié` tinyint(1) NOT NULL DEFAULT 0,
  `NuSiret` int(14) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `entreprise`
--

INSERT INTO `entreprise` (`ID`, `Owners`, `Nom`, `Description`, `Vérifié`, `NuSiret`) VALUES
(4, '20', 'Epitech', 'Ecole informatique', 0, 123456789),
(7, '1', 'Auchan', 'Supermarché', 0, 345325);

-- --------------------------------------------------------

--
-- Structure de la table `offres`
--

CREATE TABLE `offres` (
  `ID` int(11) NOT NULL,
  `Titre` text NOT NULL,
  `Description` text NOT NULL,
  `Type` text NOT NULL,
  `Durée` text NOT NULL,
  `Date` date NOT NULL,
  `entreprise_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `offres`
--

INSERT INTO `offres` (`ID`, `Titre`, `Description`, `Type`, `Durée`, `Date`, `entreprise_id`) VALUES
(7, 'Encadrant pédagogique', 'Nous recherchons une pédagogue pour encandrer nos classes et les accompagner dans leurs apprentassige en informatique', 'CDI', '0', '2025-10-17', 4),
(9, 'Vigile', 'Nous recherchons un agent de sécurité pour venir compléter notre équipe.', 'CDD', '12 mois', '2025-10-16', 7);

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `ID` int(11) NOT NULL,
  `Username` text NOT NULL,
  `MDP` text NOT NULL,
  `Nom` text NOT NULL,
  `Prénom` text NOT NULL,
  `Email` text NOT NULL,
  `Tel` text NOT NULL,
  `Formations` text NOT NULL,
  `Expériences` text NOT NULL,
  `Grade` text NOT NULL DEFAULT 'utilisateur',
  `profil_picture` text NOT NULL,
  `CV` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`ID`, `Username`, `MDP`, `Nom`, `Prénom`, `Email`, `Tel`, `Formations`, `Expériences`, `Grade`, `profil_picture`, `CV`) VALUES
(1, 'Math_A_Dort_fr', '$2y$10$tf0DFw/LrOeYEpi2ZYkYTeYZOFOsD6jMl4wlllgAwNy/bC5IJX37.', 'MASSART', 'Florian', 'fm@gmail.com', '+33', '', '', 'admin', '', ''),
(2, 'a', '$2y$10$8WCiWL2LstWy/RCpddVq8eNbeHclJcegUJAQtXcqNQbjbzT4Emsau', '', '', '', '', '', '', 'utilisateur', '', ''),
(3, 'aba', '$2y$10$6EkJYJJV58nkzL1MoPw.W.zESWIv1c40pSefY6XLfWWeprUIkkdd2', '', '', '', '', '', '', 'admin', '', ''),
(20, 'aa', '$2y$10$PSyOrgvG.SSC57L8OWKO2exLNXPjhEbxAiPGEK2U9nW.rYJ3nodea', 'Costa', 'Driss', 'sunwhyserveur@gmail.com', '+33783171885', '', '', 'utilisateur', 'pp_68f1280cc99373.37560616.png', '');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `application`
--
ALTER TABLE `application`
  ADD KEY `FK_application` (`user_ID`),
  ADD KEY `FK_application_enterprise` (`enterprise_id`);

--
-- Index pour la table `entreprise`
--
ALTER TABLE `entreprise`
  ADD PRIMARY KEY (`ID`);

--
-- Index pour la table `offres`
--
ALTER TABLE `offres`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `fk_offres` (`entreprise_id`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `entreprise`
--
ALTER TABLE `entreprise`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT pour la table `offres`
--
ALTER TABLE `offres`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `application`
--
ALTER TABLE `application`
  ADD CONSTRAINT `FK_application` FOREIGN KEY (`user_ID`) REFERENCES `users` (`ID`),
  ADD CONSTRAINT `FK_application_enterprise` FOREIGN KEY (`enterprise_id`) REFERENCES `entreprise` (`ID`);

--
-- Contraintes pour la table `offres`
--
ALTER TABLE `offres`
  ADD CONSTRAINT `fk_offres` FOREIGN KEY (`entreprise_id`) REFERENCES `entreprise` (`ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
