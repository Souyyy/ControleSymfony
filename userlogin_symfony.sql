-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:8889
-- Généré le : mer. 14 mai 2025 à 14:57
-- Version du serveur : 8.0.40
-- Version de PHP : 8.3.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `userlogin_symfony`
--

-- --------------------------------------------------------

--
-- Structure de la table `doctrine_migration_versions`
--

CREATE TABLE `doctrine_migration_versions` (
  `version` varchar(191) COLLATE utf8mb3_unicode_ci NOT NULL,
  `executed_at` datetime DEFAULT NULL,
  `execution_time` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Déchargement des données de la table `doctrine_migration_versions`
--

INSERT INTO `doctrine_migration_versions` (`version`, `executed_at`, `execution_time`) VALUES
('DoctrineMigrations\\Version20250513183336', '2025-05-13 18:33:50', 12),
('DoctrineMigrations\\Version20250514115820', '2025-05-14 11:58:29', 358),
('DoctrineMigrations\\Version20250514140557', '2025-05-14 14:06:11', 188);

-- --------------------------------------------------------

--
-- Structure de la table `etapes`
--

CREATE TABLE `etapes` (
  `id` int NOT NULL,
  `descriptif` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `consignes` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `position_dans_le_parcours` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `parcours_id` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `etapes`
--

INSERT INTO `etapes` (`id`, `descriptif`, `consignes`, `position_dans_le_parcours`, `parcours_id`) VALUES
(1, 'Bonjour', 'Test', '2', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `messages`
--

CREATE TABLE `messages` (
  `id` int NOT NULL,
  `repond_a_id` int DEFAULT NULL,
  `emet_id` int DEFAULT NULL,
  `recoit_id` int DEFAULT NULL,
  `titre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `contenu` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `datetime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `messages`
--

INSERT INTO `messages` (`id`, `repond_a_id`, `emet_id`, `recoit_id`, `titre`, `contenu`, `datetime`) VALUES
(1, NULL, 4, NULL, 'test', 'ok ok ok', '2025-05-14 12:46:28'),
(2, NULL, 4, 1, 'fdfsdf', 'sfsfsdfsfsdf', '2025-05-14 12:49:47'),
(3, NULL, 4, 4, 'fdfsd', 'fdsfsdf', '2025-05-14 12:52:53'),
(4, 3, 4, 4, 'Re: fdfsd', 'grfdgdfgdfgddgfdfgfdgd', '2025-05-14 12:54:15');

-- --------------------------------------------------------

--
-- Structure de la table `messages_rendus_activites`
--

CREATE TABLE `messages_rendus_activites` (
  `messages_id` int NOT NULL,
  `rendus_activites_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `parcours`
--

CREATE TABLE `parcours` (
  `id` int NOT NULL,
  `objet` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `parcours`
--

INSERT INTO `parcours` (`id`, `objet`, `description`) VALUES
(1, 'test', 'testtttt');

-- --------------------------------------------------------

--
-- Structure de la table `rendez_vous`
--

CREATE TABLE `rendez_vous` (
  `id` int NOT NULL,
  `propose_id` int DEFAULT NULL,
  `accepte_id` int DEFAULT NULL,
  `date_heure` datetime NOT NULL,
  `effectuer` tinyint(1) NOT NULL,
  `modalite` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `rendus_activites`
--

CREATE TABLE `rendus_activites` (
  `id` int NOT NULL,
  `depose_id` int DEFAULT NULL,
  `url_du_document_plysique` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_heure` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `rendus_activites_etapes`
--

CREATE TABLE `rendus_activites_etapes` (
  `rendus_activites_id` int NOT NULL,
  `etapes_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `ressources`
--

CREATE TABLE `ressources` (
  `id` int NOT NULL,
  `presente_id` int DEFAULT NULL,
  `intitule` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `presentation` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `url_du_document_physique` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `support` longtext COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '(DC2Type:array)',
  `nature` longtext COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '(DC2Type:array)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `ressources`
--

INSERT INTO `ressources` (`id`, `presente_id`, `intitule`, `presentation`, `url_du_document_physique`, `support`, `nature`) VALUES
(1, NULL, 'rerz', 'rzerzerz', 'http://zerezrzerzrz', 'a:1:{i:0;s:3:\"pdf\";}', 'a:1:{i:0;s:8:\"pratique\";}');

-- --------------------------------------------------------

--
-- Structure de la table `tapes`
--

CREATE TABLE `tapes` (
  `id` int NOT NULL,
  `est_compose_id` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `id` int NOT NULL,
  `email` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL,
  `roles` json NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `accompagne_id` int DEFAULT NULL,
  `choisit_id` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `email`, `roles`, `password`, `accompagne_id`, `choisit_id`) VALUES
(1, 'theo@gmail.com', '[\"ROLE_ADMIN\"]', '$2y$13$1qy4dEU/lJIYaxo8Ganrq.DBYfckY12xdttADcBK0FLY7HolnL9Kq', NULL, NULL),
(4, 'test123@root.fr', '[\"ROLE_CONSEILLER\"]', '$2y$13$0T8Mdaq/pBD11lhX/DZA3.TJXIj.iyWJx5pMdG8f3st4uZPQcNMN6', NULL, NULL),
(5, 'candidat@root.fr', '[]', '$2y$13$nSa93UqeFjT3P5Fb4CHrIONZASxrwCnFgSXsPJUUyMPqlbi4.aauC', NULL, NULL),
(6, 'conseiller@root.fr', '[\"ROLE_CONSEILLER\"]', '$2y$13$uUNfOI3C96PFzoHgf7SrEOrGRT9oGj1IV2XWDE.7Lb20VPtC95rWu', NULL, NULL);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `doctrine_migration_versions`
--
ALTER TABLE `doctrine_migration_versions`
  ADD PRIMARY KEY (`version`);

--
-- Index pour la table `etapes`
--
ALTER TABLE `etapes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_E3443E176E38C0DB` (`parcours_id`);

--
-- Index pour la table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_DB021E96EB5A4A82` (`repond_a_id`),
  ADD KEY `IDX_DB021E96DC07736C` (`emet_id`),
  ADD KEY `IDX_DB021E96AD48400` (`recoit_id`);

--
-- Index pour la table `messages_rendus_activites`
--
ALTER TABLE `messages_rendus_activites`
  ADD PRIMARY KEY (`messages_id`,`rendus_activites_id`),
  ADD KEY `IDX_69D7EFF1A5905F5A` (`messages_id`),
  ADD KEY `IDX_69D7EFF1A7844EA2` (`rendus_activites_id`);

--
-- Index pour la table `parcours`
--
ALTER TABLE `parcours`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `rendez_vous`
--
ALTER TABLE `rendez_vous`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_65E8AA0AFC1D5802` (`propose_id`),
  ADD KEY `IDX_65E8AA0AAD232E9E` (`accepte_id`);

--
-- Index pour la table `rendus_activites`
--
ALTER TABLE `rendus_activites`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_4F9C19EE41CD8671` (`depose_id`);

--
-- Index pour la table `rendus_activites_etapes`
--
ALTER TABLE `rendus_activites_etapes`
  ADD PRIMARY KEY (`rendus_activites_id`,`etapes_id`),
  ADD KEY `IDX_BAB0D5F7A7844EA2` (`rendus_activites_id`),
  ADD KEY `IDX_BAB0D5F74F5CEED2` (`etapes_id`);

--
-- Index pour la table `ressources`
--
ALTER TABLE `ressources`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_6A2CD5C721E8B456` (`presente_id`);

--
-- Index pour la table `tapes`
--
ALTER TABLE `tapes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_CC9DF640DE55B364` (`est_compose_id`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_IDENTIFIER_EMAIL` (`email`),
  ADD KEY `IDX_8D93D649E0B1098A` (`accompagne_id`),
  ADD KEY `IDX_8D93D6494DCD0E22` (`choisit_id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `etapes`
--
ALTER TABLE `etapes`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `parcours`
--
ALTER TABLE `parcours`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `rendez_vous`
--
ALTER TABLE `rendez_vous`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `rendus_activites`
--
ALTER TABLE `rendus_activites`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `ressources`
--
ALTER TABLE `ressources`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `tapes`
--
ALTER TABLE `tapes`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `etapes`
--
ALTER TABLE `etapes`
  ADD CONSTRAINT `FK_E3443E176E38C0DB` FOREIGN KEY (`parcours_id`) REFERENCES `parcours` (`id`);

--
-- Contraintes pour la table `messages`
--
ALTER TABLE `messages`
  ADD CONSTRAINT `FK_DB021E96AD48400` FOREIGN KEY (`recoit_id`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `FK_DB021E96DC07736C` FOREIGN KEY (`emet_id`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `FK_DB021E96EB5A4A82` FOREIGN KEY (`repond_a_id`) REFERENCES `messages` (`id`);

--
-- Contraintes pour la table `messages_rendus_activites`
--
ALTER TABLE `messages_rendus_activites`
  ADD CONSTRAINT `FK_69D7EFF1A5905F5A` FOREIGN KEY (`messages_id`) REFERENCES `messages` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_69D7EFF1A7844EA2` FOREIGN KEY (`rendus_activites_id`) REFERENCES `rendus_activites` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `rendez_vous`
--
ALTER TABLE `rendez_vous`
  ADD CONSTRAINT `FK_65E8AA0AAD232E9E` FOREIGN KEY (`accepte_id`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `FK_65E8AA0AFC1D5802` FOREIGN KEY (`propose_id`) REFERENCES `user` (`id`);

--
-- Contraintes pour la table `rendus_activites`
--
ALTER TABLE `rendus_activites`
  ADD CONSTRAINT `FK_4F9C19EE41CD8671` FOREIGN KEY (`depose_id`) REFERENCES `user` (`id`);

--
-- Contraintes pour la table `rendus_activites_etapes`
--
ALTER TABLE `rendus_activites_etapes`
  ADD CONSTRAINT `FK_BAB0D5F74F5CEED2` FOREIGN KEY (`etapes_id`) REFERENCES `etapes` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_BAB0D5F7A7844EA2` FOREIGN KEY (`rendus_activites_id`) REFERENCES `rendus_activites` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `ressources`
--
ALTER TABLE `ressources`
  ADD CONSTRAINT `FK_6A2CD5C721E8B456` FOREIGN KEY (`presente_id`) REFERENCES `etapes` (`id`);

--
-- Contraintes pour la table `tapes`
--
ALTER TABLE `tapes`
  ADD CONSTRAINT `FK_CC9DF640DE55B364` FOREIGN KEY (`est_compose_id`) REFERENCES `parcours` (`id`);

--
-- Contraintes pour la table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `FK_8D93D6494DCD0E22` FOREIGN KEY (`choisit_id`) REFERENCES `parcours` (`id`),
  ADD CONSTRAINT `FK_8D93D649E0B1098A` FOREIGN KEY (`accompagne_id`) REFERENCES `user` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
