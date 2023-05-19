-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : mer. 17 mai 2023 à 18:37
-- Version du serveur : 10.4.27-MariaDB
-- Version de PHP : 8.0.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `bookdb`
--

-- --------------------------------------------------------

--
-- Structure de la table `admins`
--

CREATE TABLE `admins` (
  `id` int(11) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `mot_de_passe` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `admins`
--

INSERT INTO `admins` (`id`, `nom`, `email`, `mot_de_passe`) VALUES
(3, 'Alii', 'yakdhanali97@gmail.com', 'e10adc3949ba59abbe56e057f20f883e');

-- --------------------------------------------------------

--
-- Structure de la table `cours`
--

CREATE TABLE `cours` (
  `id` int(11) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `enseignant_id` int(11) NOT NULL,
  `fichier` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `cours`
--

INSERT INTO `cours` (`id`, `nom`, `enseignant_id`, `fichier`) VALUES
(9, 'Java', 3, 'uploads/646413ecb9a20_DEVOIR2 CURSEUR.pdf'),
(12, 'aligoo', 2, 'Tp2.c'),
(13, 'aligo', 2, 'Exam_DS.pdf'),
(16, 'cisco', 2, 'Extension requirements.docx'),
(17, 'francais', 2, 'TD1EPI.pdf'),
(20, 'anglais', 2, 'DEVOIR2 CURSEUR.pdf'),
(21, 'math', 2, 'Graphi.pdf');

-- --------------------------------------------------------

--
-- Structure de la table `enseignants`
--

CREATE TABLE `enseignants` (
  `id` int(11) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `mot_de_passe` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `enseignants`
--

INSERT INTO `enseignants` (`id`, `nom`, `email`, `mot_de_passe`) VALUES
(2, 'ALI', 'ali@ali.com', 'e10adc3949ba59abbe56e057f20f883e'),
(3, 'mikoou', 'mikou@gmail.com', 'e10adc3949ba59abbe56e057f20f883e'),
(4, 'hamaaa', 'hami@j.com', 'e10adc3949ba59abbe56e057f20f883e');

-- --------------------------------------------------------

--
-- Structure de la table `etudiants`
--

CREATE TABLE `etudiants` (
  `id` int(11) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `mot_de_passe` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `etudiants`
--

INSERT INTO `etudiants` (`id`, `nom`, `email`, `mot_de_passe`) VALUES
(1, 'molka', 'molka@gmail.com', 'e10adc3949ba59abbe56e057f20f883e'),
(3, 'malouka', 'malouka@gmail.com', 'e10adc3949ba59abbe56e057f20f883e'),
(4, 'hama', 'hama@hotmail.fr', 'e10adc3949ba59abbe56e057f20f883e'),
(5, 'alilou', 'alilou@gmail.com', 'e10adc3949ba59abbe56e057f20f883e');

-- --------------------------------------------------------

--
-- Structure de la table `notes`
--

CREATE TABLE `notes` (
  `id` int(11) NOT NULL,
  `etudiant_id` int(11) NOT NULL,
  `cours_id` int(11) NOT NULL,
  `examen` varchar(255) NOT NULL,
  `note` decimal(5,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `notes`
--

INSERT INTO `notes` (`id`, `etudiant_id`, `cours_id`, `examen`, `note`) VALUES
(1, 1, 12, 'Exam', '20.00'),
(2, 1, 13, 'Exam', '0.00'),
(3, 1, 16, 'Exam', '0.00'),
(4, 1, 17, 'Exam', '0.00'),
(5, 1, 20, 'Exam', '0.00'),
(6, 1, 12, 'Exam', '19.75'),
(7, 1, 13, 'Exam', '0.00'),
(8, 1, 16, 'Exam', '0.00'),
(9, 1, 17, 'Exam', '0.00'),
(10, 1, 20, 'Exam', '0.00'),
(11, 1, 12, 'Exam', '0.00'),
(12, 1, 13, 'Exam', '20.00'),
(13, 1, 16, 'Exam', '0.00'),
(14, 1, 17, 'Exam', '0.00'),
(15, 1, 20, 'Exam', '0.00');

-- --------------------------------------------------------

--
-- Structure de la table `registration`
--

CREATE TABLE `registration` (
  `Id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `is_student` tinyint(1) DEFAULT 0,
  `is_teacher` tinyint(1) DEFAULT 0,
  `is_admin` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `registration`
--

INSERT INTO `registration` (`Id`, `username`, `email`, `password`, `is_student`, `is_teacher`, `is_admin`) VALUES
(1, 'Ali', 'yakdhanali97@gmail.com', '2b7876c9e3b314293be15114727d4518', 0, 0, 1),
(2, 'Aloulou', 'ali@gmail.com', '2b7876c9e3b314293be15114727d4518', 0, 1, 0),
(3, 'Mikouuuu', 'ml@gmail.com', 'e897db470b8fe9607d2df8f71515ca16', 1, 0, 0),
(4, 'Mikou', 'mikou@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 1, 0, 0),
(5, 'Lotfi', 'Lotfi@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 0, 0, 1),
(6, 'Oussama', 'oussama@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 0, 1, 0);

-- --------------------------------------------------------

--
-- Structure de la table `student_courses`
--

CREATE TABLE `student_courses` (
  `student_id` int(11) NOT NULL,
  `course_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `student_courses`
--

INSERT INTO `student_courses` (`student_id`, `course_id`) VALUES
(1, 12),
(1, 13),
(1, 16),
(1, 17),
(1, 20),
(3, 9);

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `login` varchar(100) NOT NULL,
  `password` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `login`, `password`) VALUES
(1, 'Ali', 'Ali2206');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `cours`
--
ALTER TABLE `cours`
  ADD PRIMARY KEY (`id`),
  ADD KEY `enseignant_id` (`enseignant_id`);

--
-- Index pour la table `enseignants`
--
ALTER TABLE `enseignants`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `etudiants`
--
ALTER TABLE `etudiants`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `notes`
--
ALTER TABLE `notes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `etudiant_id` (`etudiant_id`),
  ADD KEY `cours_id` (`cours_id`);

--
-- Index pour la table `registration`
--
ALTER TABLE `registration`
  ADD PRIMARY KEY (`Id`);

--
-- Index pour la table `student_courses`
--
ALTER TABLE `student_courses`
  ADD PRIMARY KEY (`student_id`,`course_id`),
  ADD KEY `course_id` (`course_id`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `cours`
--
ALTER TABLE `cours`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT pour la table `enseignants`
--
ALTER TABLE `enseignants`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `etudiants`
--
ALTER TABLE `etudiants`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `notes`
--
ALTER TABLE `notes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT pour la table `registration`
--
ALTER TABLE `registration`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `cours`
--
ALTER TABLE `cours`
  ADD CONSTRAINT `cours_ibfk_1` FOREIGN KEY (`enseignant_id`) REFERENCES `enseignants` (`id`);

--
-- Contraintes pour la table `notes`
--
ALTER TABLE `notes`
  ADD CONSTRAINT `notes_ibfk_1` FOREIGN KEY (`etudiant_id`) REFERENCES `etudiants` (`id`),
  ADD CONSTRAINT `notes_ibfk_2` FOREIGN KEY (`cours_id`) REFERENCES `cours` (`id`);

--
-- Contraintes pour la table `student_courses`
--
ALTER TABLE `student_courses`
  ADD CONSTRAINT `student_courses_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `etudiants` (`id`),
  ADD CONSTRAINT `student_courses_ibfk_2` FOREIGN KEY (`course_id`) REFERENCES `cours` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
