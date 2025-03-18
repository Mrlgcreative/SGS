-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : mar. 18 mars 2025 à 22:55
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
-- Base de données : `college1`
--

-- --------------------------------------------------------

--
-- Structure de la table `attendances`
--

CREATE TABLE `attendances` (
  `id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `class_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `status` enum('present','absent') NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `classes`
--

CREATE TABLE `classes` (
  `id` int(11) NOT NULL,
  `nom` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `classes`
--

INSERT INTO `classes` (`id`, `nom`) VALUES
(1, '1er'),
(2, '2ieme');

-- --------------------------------------------------------

--
-- Structure de la table `comptable`
--

CREATE TABLE `comptable` (
  `id` int(11) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `prenom` varchar(255) NOT NULL,
  `contact` varchar(20) NOT NULL,
  `email` varchar(255) NOT NULL,
  `adresse` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `comptable`
--

INSERT INTO `comptable` (`id`, `nom`, `prenom`, `contact`, `email`, `adresse`) VALUES
(1, 'moi', 'lui', '0979099031', 'moilui@mail.com', 'morse'),
(2, 'board', 'Mr sky', '+(243) 9790-99031', 'sky@mail.com', 'Kolwezi.manika, Moïse Tshombe, mbembe,48');

-- --------------------------------------------------------

--
-- Structure de la table `cours`
--

CREATE TABLE `cours` (
  `id` int(11) NOT NULL,
  `titre` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `professeur_id` int(11) NOT NULL,
  `classe_id` int(11) NOT NULL,
  `section` enum('maternelle','primaire','secondaire') NOT NULL,
  `option_` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `cours`
--

INSERT INTO `cours` (`id`, `titre`, `description`, `professeur_id`, `classe_id`, `section`, `option_`, `created_at`) VALUES
(2, 'Maths', 'Algbre', 1, 2, 'secondaire', '', '2025-02-26 07:19:27'),
(3, 'math', 'physique', 1, 2, 'secondaire', 'Mecanique auto', '2025-02-26 09:08:19'),
(4, 'Maths', 'geo', 1, 2, 'secondaire', '', '2025-03-07 13:46:46');

-- --------------------------------------------------------

--
-- Structure de la table `directeur`
--

CREATE TABLE `directeur` (
  `id` int(11) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `prenom` varchar(255) NOT NULL,
  `contact` varchar(20) NOT NULL,
  `email` varchar(255) NOT NULL,
  `adresse` text NOT NULL,
  `section` enum('primaire','secondaire','maternel') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `directeur`
--

INSERT INTO `directeur` (`id`, `nom`, `prenom`, `contact`, `email`, `adresse`, `section`) VALUES
(1, 'moi', 'lui', '0979099031', 'moillui@gmail.com', 'morse', ''),
(2, 'Twende-mbele', 'Gloire Lumingu', '+(243) 9933-18385', 'gloirelumingu10@gmail.com', 'Kolwezi.manika, Moïse Tshombe, mbembe,48', 'primaire');

-- --------------------------------------------------------

--
-- Structure de la table `directrice`
--

CREATE TABLE `directrice` (
  `id` int(11) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `prenom` varchar(255) NOT NULL,
  `contact` varchar(20) NOT NULL,
  `email` varchar(255) NOT NULL,
  `adresse` text NOT NULL,
  `section` enum('primaire','secondaire','maternel') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `directrice`
--

INSERT INTO `directrice` (`id`, `nom`, `prenom`, `contact`, `email`, `adresse`, `section`) VALUES
(1, 'Mujinga', 'Ciella', '0979099031', 'ciella@gmail.com', 'Rva', 'maternel'),
(2, 'board', 'Mr sky', '+(243) 9933-18385', 'sky@mail.com', 'Kolwezi.manika, Moïse Tshombe, mbembe,48', '');

-- --------------------------------------------------------

--
-- Structure de la table `eleves`
--

CREATE TABLE `eleves` (
  `id` int(11) NOT NULL,
  `nom` varchar(100) NOT NULL,
  `post_nom` varchar(100) NOT NULL,
  `prenom` varchar(100) NOT NULL,
  `date_naissance` date NOT NULL,
  `sexe` enum('M','F') NOT NULL,
  `lieu_naissance` varchar(150) NOT NULL,
  `adresse` varchar(255) NOT NULL,
  `section` enum('maternelle','primaire','secondaire') NOT NULL,
  `classe_id` int(11) NOT NULL,
  `option_id` int(11) NOT NULL,
  `nom_pere` varchar(100) DEFAULT NULL,
  `nom_mere` varchar(100) DEFAULT NULL,
  `contact_pere` varchar(15) DEFAULT NULL,
  `contact_mere` varchar(15) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `eleves`
--

INSERT INTO `eleves` (`id`, `nom`, `post_nom`, `prenom`, `date_naissance`, `sexe`, `lieu_naissance`, `adresse`, `section`, `classe_id`, `option_id`, `nom_pere`, `nom_mere`, `contact_pere`, `contact_mere`, `created_at`, `updated_at`) VALUES
(6, 'Moi', 'Lui', 'Sky', '2025-03-09', 'M', 'likasi', 'Kolwezi.manika, Moïse Tshombe, mbembe,48', 'secondaire', 3, 1, 'lui', 'elle', '09709987', '09887434', '2025-03-09 16:19:58', '2025-03-09 16:19:58'),
(10, 'Moi', 'Lui', 'Sky', '2025-03-09', 'M', 'likasi', 'Kolwezi.manika, Moïse Tshombe, mbembe,48', 'secondaire', 3, 1, 'lui', 'elle', '09709987', '09887434', '2025-03-09 16:25:36', '2025-03-09 16:25:36'),
(17, 'Gloire Lumingu', 'Mushitu', 'Gloire Lumingu', '2025-03-09', 'M', 'likasi', '71105', '', 1, 1, 'Mr sky', 'board', '09709987', '09887434', '2025-03-09 17:57:45', '2025-03-09 17:57:45'),
(18, 'Gloire Lumingu', 'Mushitu', 'Gloire Lumingu', '2025-03-09', 'M', 'likasi', '71105', '', 1, 1, 'Mr sky', 'board', '09709987', '09887434', '2025-03-09 17:59:09', '2025-03-09 17:59:09'),
(19, 'Gloire Lumingu Twende-mbele', 'mr', 'Gloire', '2025-03-10', 'M', 'likasi', 'Kolwezi.manika, Moïse Tshombe, mbembe,48', 'secondaire', 3, 3, 'Manga', 'Ochiwa', '09709987', '09887434', '2025-03-10 12:04:14', '2025-03-10 12:04:14'),
(20, 'dan', 'Lui', 'sky', '2025-03-10', 'M', 'kolwezi', 'Kolwezi.manika, Moïse Tshombe, mbembe,48', 'secondaire', 3, 2, 'Manga', 'Ochiwa', '09709987', '09887434', '2025-03-10 12:11:00', '2025-03-10 12:11:00'),
(25, 'Gloire Lumingu', 'mr', 'Mr sky', '2025-03-10', 'M', 'likasi', '71105', 'secondaire', 3, 3, 'sky', 'board', '09709987', '09887434', '2025-03-10 12:29:00', '2025-03-10 12:29:00'),
(26, 'moi lui', 'Mushitu', 'Manga', '2025-03-18', 'M', 'kolwezi', '71105', 'primaire', 2, 3, 'Mr sky', 'board', '09709987', '09887434', '2025-03-17 23:04:00', '2025-03-17 23:04:00');

-- --------------------------------------------------------

--
-- Structure de la table `employes`
--

CREATE TABLE `employes` (
  `id` int(11) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `prenom` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `contact` varchar(20) NOT NULL,
  `poste` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `adresse` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `employes`
--

INSERT INTO `employes` (`id`, `nom`, `prenom`, `email`, `contact`, `poste`, `created_at`, `adresse`) VALUES
(2, 'board', 'sky', 'gloirelumingu1@gmail.com', '+(001) 8376-38290', 'femme de menage', '2025-02-27 11:43:39', ''),
(3, 'board', 'Mr sky', 'sky@mail.com', '+(243) 9787-866765', 'gardien', '2025-02-27 12:17:20', NULL),
(4, 'board', 'lui', 'sky1@mail.com', '+(243) 9787-866765', 'gardien', '2025-02-27 12:25:13', 'Kolwezi.manika, Moïse Tshombe, mbembe,48');

-- --------------------------------------------------------

--
-- Structure de la table `frais`
--

CREATE TABLE `frais` (
  `id` int(11) NOT NULL,
  `montant` decimal(10,2) NOT NULL,
  `description` varchar(255) NOT NULL,
  `section` enum('primaire','secondaire','maternelle') DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `frais`
--

INSERT INTO `frais` (`id`, `montant`, `description`, `section`, `created_at`) VALUES
(1, 1000.00, 'Loge', NULL, '2025-02-23 16:23:08'),
(2, 500.00, 'fip', 'primaire', '2025-02-23 16:27:42'),
(3, 10.00, 'Achat', NULL, '2025-02-23 16:29:31'),
(4, 42.00, 'Mensuels', 'secondaire', '2025-02-23 16:34:21'),
(5, 200.00, 'FIP', 'primaire', '2025-02-23 18:23:08'),
(6, 300.00, 'Mensuels', 'maternelle', '2025-02-23 18:30:43'),
(7, 700.00, 'Loge', 'primaire', '2025-02-25 10:35:59'),
(8, 60.00, 'Mensuels', 'secondaire', '2025-03-03 08:04:55');

-- --------------------------------------------------------

--
-- Structure de la table `historique`
--

CREATE TABLE `historique` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `action` varchar(255) NOT NULL,
  `date_action` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `horaires`
--

CREATE TABLE `horaires` (
  `id` int(11) NOT NULL,
  `classe_id` int(11) NOT NULL,
  `cour_id` int(11) NOT NULL,
  `jour_de_semaine` varchar(255) NOT NULL,
  `debut_de_cours` time DEFAULT NULL,
  `fin_cours` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `mois`
--

CREATE TABLE `mois` (
  `id` int(11) NOT NULL,
  `nom` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `mois`
--

INSERT INTO `mois` (`id`, `nom`) VALUES
(1, 'janvier'),
(2, 'fevrier'),
(3, 'mars'),
(4, 'avril'),
(5, 'mai'),
(6, 'juin'),
(7, 'septembre'),
(8, 'octobre'),
(9, 'novembre'),
(10, 'decembre');

-- --------------------------------------------------------

--
-- Structure de la table `options`
--

CREATE TABLE `options` (
  `id` int(11) NOT NULL,
  `nom` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `options`
--

INSERT INTO `options` (`id`, `nom`, `created_at`) VALUES
(1, 'scientifique', '2025-02-28 20:16:51'),
(2, 'commerciale', '2025-02-28 20:16:51'),
(3, 'pedagogie genrale', '2025-02-28 20:17:55'),
(4, 'electronique', '2025-02-28 20:17:55'),
(5, 'electricite', '2025-02-28 20:18:40'),
(6, 'mecanique auto', '2025-02-28 20:18:40'),
(7, 'mecanique generale', '2025-02-28 20:19:14');

-- --------------------------------------------------------

--
-- Structure de la table `paiements`
--

CREATE TABLE `paiements` (
  `id` int(11) NOT NULL,
  `professeur_id` int(11) NOT NULL,
  `montant` decimal(10,2) NOT NULL,
  `date_paiement` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `paiements_frais`
--

CREATE TABLE `paiements_frais` (
  `id` int(11) NOT NULL,
  `eleve_id` int(11) NOT NULL,
  `amount_paid` decimal(10,2) NOT NULL,
  `payment_date` date NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `moi_id` int(11) NOT NULL,
  `classe_id` int(11) NOT NULL,
  `option_id` int(11) DEFAULT NULL,
  `section` enum('maternel','primaire','secondaire') DEFAULT NULL,
  `frais_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `paiements_frais`
--

INSERT INTO `paiements_frais` (`id`, `eleve_id`, `amount_paid`, `payment_date`, `created_at`, `moi_id`, `classe_id`, `option_id`, `section`, `frais_id`) VALUES
(1, 1, 600.00, '2024-03-28', '2025-03-06 07:28:55', 1, 1, 1, 'secondaire', 4),
(2, 26, 42.00, '2025-03-18', '2025-03-17 22:00:00', 9, 2, 0, 'primaire', 4),
(3, 26, 0.00, '2025-03-18', '2025-03-17 22:00:00', 9, 0, NULL, '', 4),
(4, 26, 0.00, '2025-03-18', '2025-03-17 22:00:00', 9, 0, NULL, '', 4),
(5, 26, 300.00, '2025-03-18', '2025-03-17 22:00:00', 10, 2, 0, 'primaire', 6),
(6, 20, 1000.00, '2025-03-18', '2025-03-17 22:00:00', 1, 0, 0, 'secondaire', 1),
(7, 26, 10.00, '2025-03-18', '2025-03-17 22:00:00', 8, 2, 0, 'primaire', 3),
(8, 26, 300.00, '2025-03-18', '2025-03-17 22:00:00', 7, 2, 0, 'primaire', 6),
(9, 26, 300.00, '2025-03-18', '2025-03-17 22:00:00', 7, 2, 0, 'primaire', 6);

-- --------------------------------------------------------

--
-- Structure de la table `parents`
--

CREATE TABLE `parents` (
  `id` int(11) NOT NULL,
  `nom` varchar(50) NOT NULL,
  `prenom` varchar(50) NOT NULL,
  `contact` varchar(20) NOT NULL,
  `email` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `parents`
--

INSERT INTO `parents` (`id`, `nom`, `prenom`, `contact`, `email`, `created_at`) VALUES
(1, 'ochiwa', 'sky', '0979099031', 'ochiwa@gmail.com', '2025-02-23 19:03:00');

-- --------------------------------------------------------

--
-- Structure de la table `prefet`
--

CREATE TABLE `prefet` (
  `id` int(11) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `prenom` varchar(255) NOT NULL,
  `contact` varchar(20) NOT NULL,
  `email` varchar(255) NOT NULL,
  `adresse` text NOT NULL,
  `section` enum('primaire','secondaire','maternel') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `prefet`
--

INSERT INTO `prefet` (`id`, `nom`, `prenom`, `contact`, `email`, `adresse`, `section`) VALUES
(1, 'sky', 'board', '0979099031', 'skyboard@mail.com', 'Kamanyola', 'secondaire'),
(2, 'board', 'Mr sky', '+(243) 9933-18385', 'sky@mail.com', 'Kolwezi.manika, Moïse Tshombe, mbembe,48', 'secondaire'),
(3, 'board', 'Mr sky', '+(243) 9933-18385', 'sky@mail.com', 'Kolwezi.manika, Moïse Tshombe, mbembe,48', 'secondaire');

-- --------------------------------------------------------

--
-- Structure de la table `presences`
--

CREATE TABLE `presences` (
  `id` int(11) NOT NULL,
  `professeur_id` int(11) NOT NULL,
  `heure_arrivee` time NOT NULL,
  `heure_depart` time NOT NULL,
  `date_presence` date NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `professeurs`
--

CREATE TABLE `professeurs` (
  `id` int(11) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `prenom` varchar(255) NOT NULL,
  `contact` varchar(20) NOT NULL,
  `email` varchar(255) NOT NULL,
  `adresse` text NOT NULL,
  `classe_id` int(11) DEFAULT NULL,
  `cours_id` int(11) DEFAULT NULL,
  `section` enum('primaire','secondaire','maternel') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `professeurs`
--

INSERT INTO `professeurs` (`id`, `nom`, `prenom`, `contact`, `email`, `adresse`, `classe_id`, `cours_id`, `section`) VALUES
(1, 'ochiwa', 'sky', '0979099031', 'ochiwa@gmail.com', 'lumumba', 1, NULL, 'primaire'),
(7, 'Twende-mbele', 'Mr sky', '+(243) 9787-866765', 'sky@mail.com', 'Kolwezi.manika, Moïse Tshombe, mbembe,48', NULL, NULL, ''),
(17, 'board', 'Mr sky', '+(243) 9098-99031', 'sky@mail.com', 'Kolwezi.manika, Moïse Tshombe, mbembe,48', NULL, NULL, ''),
(18, 'Twende-mbele', 'Gloire Lumingu', '+(243) 9790-99031', 'gloirelumingu10@gmail.com', 'Kolwezi.manika, Moïse Tshombe, mbembe,48', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `recu`
--

CREATE TABLE `recu` (
  `id` int(11) NOT NULL,
  `eleve_id` int(11) NOT NULL,
  `paiement_id` int(11) NOT NULL,
  `nom_etablissement` varchar(100) NOT NULL,
  `numero_recu` varchar(50) NOT NULL,
  `motif` varchar(255) NOT NULL,
  `montant` decimal(10,2) NOT NULL,
  `date_creation` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','director','directrice','prefet','comptable') NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `email` varchar(255) NOT NULL,
  `image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `role`, `created_at`, `email`, `image`) VALUES
(16, 'Ciella', '$2y$10$YwjDMOEpdYf./SyPlMmDy.0SggFdmDK1UW5W27raoIB3Ni3A7XVPC', 'comptable', '2025-03-18 21:04:24', 'ciellamujinga@mail.com', './assets/image/default_image.jpg');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `attendances`
--
ALTER TABLE `attendances`
  ADD PRIMARY KEY (`id`),
  ADD KEY `student_id` (`student_id`),
  ADD KEY `class_id` (`class_id`);

--
-- Index pour la table `classes`
--
ALTER TABLE `classes`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `comptable`
--
ALTER TABLE `comptable`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `cours`
--
ALTER TABLE `cours`
  ADD PRIMARY KEY (`id`),
  ADD KEY `professeur_id` (`professeur_id`),
  ADD KEY `classe_id` (`classe_id`);

--
-- Index pour la table `directeur`
--
ALTER TABLE `directeur`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `directrice`
--
ALTER TABLE `directrice`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `eleves`
--
ALTER TABLE `eleves`
  ADD PRIMARY KEY (`id`),
  ADD KEY `classe_id` (`classe_id`),
  ADD KEY `option_id` (`option_id`);

--
-- Index pour la table `employes`
--
ALTER TABLE `employes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Index pour la table `frais`
--
ALTER TABLE `frais`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `historique`
--
ALTER TABLE `historique`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Index pour la table `horaires`
--
ALTER TABLE `horaires`
  ADD PRIMARY KEY (`id`),
  ADD KEY `classe_id` (`classe_id`),
  ADD KEY `cour_id` (`cour_id`);

--
-- Index pour la table `mois`
--
ALTER TABLE `mois`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `options`
--
ALTER TABLE `options`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `paiements`
--
ALTER TABLE `paiements`
  ADD PRIMARY KEY (`id`),
  ADD KEY `professeur_id` (`professeur_id`);

--
-- Index pour la table `paiements_frais`
--
ALTER TABLE `paiements_frais`
  ADD PRIMARY KEY (`id`),
  ADD KEY `eleve_id` (`eleve_id`),
  ADD KEY `classe_id` (`classe_id`),
  ADD KEY `option_id` (`option_id`),
  ADD KEY `moi_id` (`moi_id`),
  ADD KEY `fk_frais` (`frais_id`);

--
-- Index pour la table `parents`
--
ALTER TABLE `parents`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Index pour la table `prefet`
--
ALTER TABLE `prefet`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `presences`
--
ALTER TABLE `presences`
  ADD PRIMARY KEY (`id`),
  ADD KEY `professeur_id` (`professeur_id`);

--
-- Index pour la table `professeurs`
--
ALTER TABLE `professeurs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_classe_id` (`classe_id`),
  ADD KEY `fk_cours_id` (`cours_id`);

--
-- Index pour la table `recu`
--
ALTER TABLE `recu`
  ADD PRIMARY KEY (`id`),
  ADD KEY `eleve_id` (`eleve_id`),
  ADD KEY `paiement_id` (`paiement_id`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `attendances`
--
ALTER TABLE `attendances`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `classes`
--
ALTER TABLE `classes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `comptable`
--
ALTER TABLE `comptable`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `cours`
--
ALTER TABLE `cours`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `directeur`
--
ALTER TABLE `directeur`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `directrice`
--
ALTER TABLE `directrice`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `eleves`
--
ALTER TABLE `eleves`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT pour la table `employes`
--
ALTER TABLE `employes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `frais`
--
ALTER TABLE `frais`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT pour la table `historique`
--
ALTER TABLE `historique`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `horaires`
--
ALTER TABLE `horaires`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `mois`
--
ALTER TABLE `mois`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT pour la table `options`
--
ALTER TABLE `options`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT pour la table `paiements`
--
ALTER TABLE `paiements`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `paiements_frais`
--
ALTER TABLE `paiements_frais`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT pour la table `parents`
--
ALTER TABLE `parents`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `prefet`
--
ALTER TABLE `prefet`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `presences`
--
ALTER TABLE `presences`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `professeurs`
--
ALTER TABLE `professeurs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT pour la table `recu`
--
ALTER TABLE `recu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `attendances`
--
ALTER TABLE `attendances`
  ADD CONSTRAINT `attendances_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `attendances_ibfk_2` FOREIGN KEY (`class_id`) REFERENCES `classes` (`id`);

--
-- Contraintes pour la table `cours`
--
ALTER TABLE `cours`
  ADD CONSTRAINT `cours_ibfk_1` FOREIGN KEY (`professeur_id`) REFERENCES `professeurs` (`id`),
  ADD CONSTRAINT `cours_ibfk_2` FOREIGN KEY (`classe_id`) REFERENCES `classes` (`id`);

--
-- Contraintes pour la table `historique`
--
ALTER TABLE `historique`
  ADD CONSTRAINT `historique_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
