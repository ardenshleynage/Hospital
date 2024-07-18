-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : mer. 12 juin 2024 à 23:48
-- Version du serveur : 10.4.28-MariaDB
-- Version de PHP : 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `hospital`
--

-- --------------------------------------------------------

--
-- Structure de la table `buying`
--

CREATE TABLE `buying` (
  `id` int(11) NOT NULL,
  `id_patient` int(11) NOT NULL,
  `id_drugs` int(11) NOT NULL,
  `name_drugs` varchar(255) NOT NULL,
  `lname_pat` varchar(255) NOT NULL,
  `fname_pat` varchar(255) NOT NULL,
  `nif_pat` varchar(255) NOT NULL,
  `number_drugs` int(11) NOT NULL,
  `price` float NOT NULL,
  `price_t` float NOT NULL,
  `dex` date NOT NULL,
  `des` varchar(255) NOT NULL,
  `pat` varchar(255) NOT NULL,
  `date` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `doctors`
--

CREATE TABLE `doctors` (
  `id` int(11) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `prenom` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `age` int(11) NOT NULL,
  `access` int(11) NOT NULL,
  `sexe` varchar(6) NOT NULL,
  `adresse` varchar(255) NOT NULL,
  `telephone` int(11) NOT NULL,
  `nif` int(11) NOT NULL,
  `date` date NOT NULL DEFAULT current_timestamp(),
  `specialite` varchar(255) NOT NULL,
  `horraires` varchar(255) NOT NULL,
  `img` varchar(255) NOT NULL,
  `exp` int(11) NOT NULL,
  `statut` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `doctors`
--

INSERT INTO `doctors` (`id`, `nom`, `prenom`, `email`, `password`, `age`, `access`, `sexe`, `adresse`, `telephone`, `nif`, `date`, `specialite`, `horraires`, `img`, `exp`, `statut`) VALUES
(23, 'Williams', 'Sarah', 'lm@gmail.com', '$2y$10$rfpY1ajLN92NqoR2YwK70Ofv9w3XxP0f.4IQ0fA927YeS/m08VS/2', 22, 1, 'Homme', 'Bre!@#$', 12345678, 1234567892, '2024-03-09', 'Dermatologie', 'morning', 'images/vrach-na-dom.jpg', 3, 'on'),
(24, 'Williams', 'Sarah-Jeanne', 'lm@gmail.com', '$2y$10$KtD.7ZppG.Bey0UsB/AeXuTMbqOdbyuzVpzKZl/eLmaKXM2UM0h/6', 22, 1, 'Femme', 'Bre!@#$', 12345678, 1234567893, '2024-03-09', 'Dermatologie', 'morning', 'images/vrach-na-dom.jpg', 3, 'on'),
(25, 'Williams-Jean', 'Sarah-Jeanne', 'lm@gmail.com', '$2y$10$DjAGy5v6zjkidyueAg4efeD408FFAfUa5bI0ImKAvchh34GeadQXS', 22, 1, 'Femme', 'Bre!@#$', 12345678, 1234567894, '2024-03-09', 'Dermatologie', 'night', 'images/vrach-na-dom.jpg', 3, 'on'),
(26, 'Williams Jean', 'Sarah-Jeanne', 'lm@gmail.com', '$2y$10$dXrhuecfD6jWfYHyRg2PUOs3TVQg.9e2hVegTokIZD6AMQbwRTyKS', 22, 1, 'Femme', 'Bre!@#$', 12345678, 1234567895, '2024-03-09', 'Dermatologie', 'morning', 'images/vrach-na-dom.jpg', 3, 'on'),
(27, 'Williams Jean', 'Sarah-Jeanne-Dupond', 'lm@gmail.com', '$2y$10$bMpw7rXxSvpa6YpkVf0rSu.jI03VQjKTjdgylbulKsDAa55anlhC6', 22, 1, 'Femme', 'Bre!@#$', 12345678, 1234567896, '2024-03-09', 'Dermatologie', 'morning', 'images/vrach-na-dom.jpg', 3, 'on'),
(30, 'Williams', 'Sarah', 'zm@gmail.com', '$2y$10$TQDuMFMFRUPBNn0Apopde.m.W.ulZBu0yuHh2tXHdmg9eyDeiiX1.', 21, 1, 'Homme', 'Brefette', 12345661, 1234567899, '2024-03-23', 'Dermatologie', 'afternoon', 'images/360_F_260040900_oO6YW1sHTnKxby4GcjCvtypUCWjnQRg5.jpg', 3, 'on');

-- --------------------------------------------------------

--
-- Structure de la table `drugs`
--

CREATE TABLE `drugs` (
  `id` int(11) NOT NULL,
  `img` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `dex` date NOT NULL,
  `des` varchar(255) NOT NULL,
  `pat` varchar(255) NOT NULL,
  `price` float NOT NULL,
  `date` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `drugs`
--

INSERT INTO `drugs` (`id`, `img`, `name`, `dex`, `des`, `pat`, `price`, `date`) VALUES
(6, 'images/image.jpeg', 'Adventure Time 9', '2024-03-19', 'qwertyz', 'qwertut', 12344, '2024-03-12'),
(9, 'images/image.jpeg', 'Dolgesic Forte 300G', '2024-03-29', 'qwerty', 'Mots de tete', 200, '2024-03-23'),
(10, 'images/image.jpeg', 'Dolgesic Forte 400G', '2024-03-30', 'qwertuih', 'Mots de tete', 12345, '2024-03-23');

-- --------------------------------------------------------

--
-- Structure de la table `employee`
--

CREATE TABLE `employee` (
  `id` int(11) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `prenom` varchar(255) NOT NULL,
  `sexe` varchar(10) NOT NULL,
  `email` varchar(255) NOT NULL,
  `age` int(11) NOT NULL,
  `telephone` int(11) NOT NULL,
  `service` varchar(255) NOT NULL,
  `id_service` int(11) DEFAULT NULL,
  `role` varchar(255) NOT NULL,
  `date` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `meeting`
--

CREATE TABLE `meeting` (
  `id` int(11) NOT NULL,
  `img` varchar(255) NOT NULL,
  `id_doctors` int(11) NOT NULL,
  `lname_doctors` varchar(255) NOT NULL,
  `fname_doctors` varchar(255) NOT NULL,
  `nif_doctors` int(11) NOT NULL,
  `spe_doctors` varchar(255) NOT NULL,
  `ho_doctors` varchar(255) NOT NULL,
  `id_pat` int(11) NOT NULL,
  `lname_pat` varchar(255) NOT NULL,
  `fname_pat` varchar(255) NOT NULL,
  `nif_pat` int(11) NOT NULL,
  `acc_doctors` int(11) NOT NULL,
  `acc_pat` int(11) NOT NULL,
  `acc_meet` int(11) NOT NULL,
  `date_meeting` date NOT NULL,
  `date` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `patient`
--

CREATE TABLE `patient` (
  `id` int(11) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `prenom` varchar(255) NOT NULL,
  `sexe` varchar(6) NOT NULL,
  `dob` date NOT NULL,
  `pob` varchar(255) NOT NULL,
  `service` varchar(255) NOT NULL,
  `id_service` int(11) DEFAULT NULL,
  `adresse` varchar(255) NOT NULL,
  `telephone` int(11) NOT NULL,
  `date` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `services`
--

CREATE TABLE `services` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `des` varchar(535) NOT NULL,
  `date` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `prenom` varchar(255) NOT NULL,
  `pseudo` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `statut` int(11) NOT NULL,
  `date` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `nom`, `prenom`, `pseudo`, `password`, `statut`, `date`) VALUES
(25, 'Kent', 'Clark', 'superman', '$2y$10$7d3n2EK06wvrvaz7Qsy7D.s.kW/SvVek3mPkhj3UR7KwUw6fILWxy', 1, '2024-03-31'),
(26, 'Prince', 'Diane', 'wonder woman', '$2y$10$1yz69raX6G7YTEjcXOFTre1hnre81fWfP8AAApzrPILVw7rGsrZW.', 1, '2024-04-01'),
(27, 'Wayne', 'Bruce', 'batman', '$2y$10$qlA/.8muKKL.djLa/ZHNte.5uOENlC7IfVZqayf6AF9VeUGeadDj2', 1, '2024-04-01');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `buying`
--
ALTER TABLE `buying`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_patient` (`id_patient`),
  ADD KEY `id_drugs` (`id_drugs`);

--
-- Index pour la table `doctors`
--
ALTER TABLE `doctors`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `drugs`
--
ALTER TABLE `drugs`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_service` (`id_service`);

--
-- Index pour la table `meeting`
--
ALTER TABLE `meeting`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_doctors` (`id_doctors`,`id_pat`),
  ADD KEY `id_pat` (`id_pat`);

--
-- Index pour la table `patient`
--
ALTER TABLE `patient`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_service` (`id_service`);

--
-- Index pour la table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `buying`
--
ALTER TABLE `buying`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT pour la table `doctors`
--
ALTER TABLE `doctors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT pour la table `drugs`
--
ALTER TABLE `drugs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT pour la table `employee`
--
ALTER TABLE `employee`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT pour la table `meeting`
--
ALTER TABLE `meeting`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT pour la table `patient`
--
ALTER TABLE `patient`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT pour la table `services`
--
ALTER TABLE `services`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `buying`
--
ALTER TABLE `buying`
  ADD CONSTRAINT `buying_ibfk_1` FOREIGN KEY (`id_drugs`) REFERENCES `drugs` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `buying_ibfk_2` FOREIGN KEY (`id_patient`) REFERENCES `patient` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `employee`
--
ALTER TABLE `employee`
  ADD CONSTRAINT `employee_ibfk_1` FOREIGN KEY (`id_service`) REFERENCES `services` (`id`) ON DELETE SET NULL ON UPDATE SET NULL;

--
-- Contraintes pour la table `meeting`
--
ALTER TABLE `meeting`
  ADD CONSTRAINT `meeting_ibfk_1` FOREIGN KEY (`id_doctors`) REFERENCES `doctors` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `meeting_ibfk_2` FOREIGN KEY (`id_pat`) REFERENCES `patient` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `patient`
--
ALTER TABLE `patient`
  ADD CONSTRAINT `patient_ibfk_1` FOREIGN KEY (`id_service`) REFERENCES `services` (`id`) ON DELETE SET NULL ON UPDATE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
