-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:3306
-- Généré le : sam. 28 mars 2020 à 23:56
-- Version du serveur :  5.7.24
-- Version de PHP : 7.2.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `ven`
--

-- --------------------------------------------------------

--
-- Structure de la table `comment`
--

CREATE TABLE `comment` (
  `id` int(11) NOT NULL,
  `events_id` int(11) NOT NULL,
  `author` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `contact`
--

CREATE TABLE `contact` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `message` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `contact`
--

INSERT INTO `contact` (`id`, `name`, `email`, `message`, `created_at`) VALUES
(1, 'feri', 'feri@gmail.com', 'lkjhjlhkjhjkh hgghj', '2020-03-18 14:54:29'),
(2, 'fifi', 'feriel.foufa234@gmail.com', 'parrinage', '2020-03-18 14:54:44'),
(6, 'dswklds,lds', 'qsdklq,dsjlsk@gmail.com', 'sdlk,DL?QSD /.QS?D./SDKLDJLKQS?D.QS?DLSKQD?LDS', '2020-03-18 22:54:07');

-- --------------------------------------------------------

--
-- Structure de la table `donators`
--

CREATE TABLE `donators` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `events`
--

CREATE TABLE `events` (
  `id` int(11) NOT NULL,
  `nom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `photo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lieu` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `descreption` longtext COLLATE utf8mb4_unicode_ci,
  `date_debut` date NOT NULL,
  `date_fin` date NOT NULL,
  `temps_debut` time NOT NULL,
  `temps_fin` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `fos_user`
--

CREATE TABLE `fos_user` (
  `id` int(11) NOT NULL,
  `username` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username_canonical` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_canonical` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL,
  `enabled` tinyint(1) NOT NULL,
  `salt` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_login` datetime DEFAULT NULL,
  `confirmation_token` varchar(180) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password_requested_at` datetime DEFAULT NULL,
  `roles` longtext COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '(DC2Type:array)',
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` int(11) DEFAULT NULL,
  `birthdate` date DEFAULT NULL,
  `adress` longtext COLLATE utf8mb4_unicode_ci,
  `photo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `descreption` longtext COLLATE utf8mb4_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `fos_user`
--

INSERT INTO `fos_user` (`id`, `username`, `username_canonical`, `email`, `email_canonical`, `enabled`, `salt`, `password`, `last_login`, `confirmation_token`, `password_requested_at`, `roles`, `name`, `phone`, `birthdate`, `adress`, `photo`, `descreption`) VALUES
(1, 'feriel', 'feriel', 'feriel.foufa214@gmail.com', 'feriel.foufa214@gmail.com', 1, 'kzZt8NkyZ1bETq9YBY.LtNzIY587DrEFcyr5q2rP2ho', '$2y$13$xMhnVW/xM.9e5ibo9o0K4e8esh0ezjPgrKiNRIyrWKBXRlQCzxv42', NULL, NULL, NULL, 'a:1:{i:0;s:10:\"ROLE_ADMIN\";}', 'feriel', 25242684, '1999-11-27', 'Ben arous ,Nassen', NULL, NULL),
(3, 'yassine', 'yassine', 'yassine@gmail.com', 'yassine@gmail.com', 1, '.7dvwfnXKPDNdlHDUtE9ELnf4UfmDeLq6GwLEy7isMo', '$2y$13$d/IxnpFidDcSFaTaIija8e5yIXz300LhN5XhLUzwGjGtdNl58SsYu', NULL, NULL, NULL, 'a:1:{i:0;s:10:\"ROLE_ADMIN\";}', 'yassine', 888888, '2020-03-09', 'NABEUL', NULL, NULL),
(4, 'nada', 'nada', 'nada@gmail.com', 'nada@gmail.com', 1, '8a/dl6/CX4G8r9xvo0thDSo83/WoHkslFropMXHuttY', '$2y$13$IarLORqxLIf.qaYekpAs6uWbOswmS3BDMz5fEEkyifqF5HyUhY3uS', NULL, NULL, NULL, 'a:1:{i:0;s:10:\"ROLE_ADMIN\";}', 'nada', 12345678, '2020-03-14', 'DFSDFDF', NULL, NULL),
(5, 'omar', 'omar', 'OMAR@gmail.com', 'omar@gmail.com', 1, 'UsvGVxLN5QGIk08CccwLS80edhHKxPUfIwYxNYZH4hg', '$2y$13$EOih/Nv9SQyvujXSVPI48.ohTRqVbTRMFPPXrdS1vtCGRHY52RzCS', NULL, NULL, NULL, 'a:1:{i:0;s:10:\"ROLE_ADMIN\";}', 'omar', 222222, '2020-03-23', 'K?SDKLQS?DKLQS', NULL, NULL),
(6, 'test', 'test', 'test@gmail.com', 'test@gmail.com', 1, 'MRWl/58pUKQo62JDHOLsRO2hpOfNbUE7XRhxmiZup/o', '$2y$13$fAu36Qd116yMcUeEqAoTdedfse1UmaQZaGz1D/oiz1SdyLXPcUjBK', NULL, NULL, NULL, 'a:1:{i:0;s:10:\"ROLE_ADMIN\";}', 'test', 22222222, '2020-03-09', 'TESTTTTTTT', NULL, NULL),
(7, 'toto', 'toto', 'toto@gmail.com', 'toto@gmail.com', 1, '8F4RAgiZUJKIKRcoGH.LyewLhq6enW3fvDXyHzNoqck', '$2y$13$ww0KhK99Pni85.oV1.2cIOyOUpSo.GWVi5E9A1oOrcCc5VlMNUh0a', '2020-03-21 22:27:25', NULL, NULL, 'a:1:{i:0;s:10:\"ROLE_ADMIN\";}', 'toto', 2222222, '2020-03-21', 'DSQKLNQSKJLSNKJFNSDKJFN', NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `migration_versions`
--

CREATE TABLE `migration_versions` (
  `version` varchar(14) COLLATE utf8mb4_unicode_ci NOT NULL,
  `executed_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `migration_versions`
--

INSERT INTO `migration_versions` (`version`, `executed_at`) VALUES
('20200312181602', '2020-03-12 18:16:20'),
('20200312202735', '2020-03-12 20:27:43'),
('20200312210059', '2020-03-12 21:01:07'),
('20200314200050', '2020-03-14 20:01:17'),
('20200318144757', '2020-03-18 14:48:13'),
('20200319104039', '2020-03-19 10:40:51'),
('20200325135051', '2020-03-25 13:51:32'),
('20200327170646', '2020-03-27 17:07:01'),
('20200327205325', '2020-03-27 20:54:13');

-- --------------------------------------------------------

--
-- Structure de la table `person`
--

CREATE TABLE `person` (
  `id` int(11) NOT NULL,
  `lastname` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `age` int(11) DEFAULT NULL,
  `number` int(11) DEFAULT NULL,
  `country` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `completed` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `person`
--

INSERT INTO `person` (`id`, `lastname`, `age`, `number`, `country`, `completed`) VALUES
(2, 'Sousouu', 23, 29279679, 'Ben Arous', 0),
(3, 'Somanabi', 21, 29279679, 'Ben Arous', 0),
(8, 'yassine', 21, 333333, 'TTTTT', 0),
(25, 'test', 34, 55555, 'USA', 0);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_9474526C9D6A1065` (`events_id`);

--
-- Index pour la table `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_4C62E638E7927C74` (`email`);

--
-- Index pour la table `donators`
--
ALTER TABLE `donators`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_5387574A6C6E55B5` (`nom`),
  ADD UNIQUE KEY `UNIQ_5387574A52EBEEF5` (`date_debut`);

--
-- Index pour la table `fos_user`
--
ALTER TABLE `fos_user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_957A647992FC23A8` (`username_canonical`),
  ADD UNIQUE KEY `UNIQ_957A6479A0D96FBF` (`email_canonical`),
  ADD UNIQUE KEY `UNIQ_957A6479C05FB297` (`confirmation_token`);

--
-- Index pour la table `migration_versions`
--
ALTER TABLE `migration_versions`
  ADD PRIMARY KEY (`version`);

--
-- Index pour la table `person`
--
ALTER TABLE `person`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `comment`
--
ALTER TABLE `comment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `contact`
--
ALTER TABLE `contact`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `donators`
--
ALTER TABLE `donators`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `events`
--
ALTER TABLE `events`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `fos_user`
--
ALTER TABLE `fos_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT pour la table `person`
--
ALTER TABLE `person`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `comment`
--
ALTER TABLE `comment`
  ADD CONSTRAINT `FK_9474526C9D6A1065` FOREIGN KEY (`events_id`) REFERENCES `events` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
