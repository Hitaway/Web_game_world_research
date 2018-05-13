-- phpMyAdmin SQL Dump
-- version 4.7.3
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:8889
-- Généré le :  Dim 13 mai 2018 à 21:50
-- Version du serveur :  5.6.35
-- Version de PHP :  7.1.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Base de données :  `debug_l3_web`
--

-- --------------------------------------------------------

--
-- Structure de la table `CLASSEMENT`
--

CREATE TABLE `CLASSEMENT` (
  `id` int(11) UNSIGNED NOT NULL,
  `score` int(10) UNSIGNED NOT NULL,
  `pseudo` varchar(35) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `CLASSEMENT`
--

INSERT INTO `CLASSEMENT` (`id`, `score`, `pseudo`) VALUES
(1, 70, 'Hitaway'),
(2, 40, 'Robi62'),
(3, 45, 'Robi62'),
(4, 50, 'Robi62'),
(5, 60, 'Robi62'),
(6, 60, 'Robi62'),
(7, 50, 'Robi62'),
(9, 40, 'Robi62'),
(11, 25, 'Micka'),
(12, 50, 'Kinstaar');

-- --------------------------------------------------------

--
-- Structure de la table `HISTORIQUE`
--

CREATE TABLE `HISTORIQUE` (
  `id` int(11) UNSIGNED NOT NULL,
  `pseudo` varchar(35) NOT NULL,
  `nom_questionnaire` varchar(200) NOT NULL,
  `date_partie` date NOT NULL,
  `score` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `HISTORIQUE`
--

INSERT INTO `HISTORIQUE` (`id`, `pseudo`, `nom_questionnaire`, `date_partie`, `score`) VALUES
(1, 'Hitaway', '7 merveille deu monde', '2018-04-10', 0),
(1, 'Hitaway', '7 merveille deu monde', '2018-04-10', 70),
(2, 'Robi62', '7 merveille du monde', '2018-04-12', 40),
(3, 'Robi62', '7 merveille du monde', '2018-04-12', 45),
(4, 'Robi62', '7 merveille du monde', '2018-04-12', 50),
(5, 'Robi62', '7 merveille du monde', '2018-04-12', 60),
(6, 'Robi62', '7 merveille du monde', '2018-04-13', 60),
(7, 'Robi62', '7 merveille du monde', '2018-04-13', 50),
(8, 'Robi62', '7 merveille du monde', '2018-04-13', 20),
(9, 'Robi62', '7 merveille du monde', '2018-04-13', 40),
(10, 'Micka', '7 merveille du monde', '2018-04-13', 25),
(11, 'Micka', '7 merveille du monde', '2018-04-13', 50),
(12, 'Kinstaar', '7 merveille du monde', '2018-04-13', 65);

-- --------------------------------------------------------

--
-- Structure de la table `QUESTIONNAIRES`
--

CREATE TABLE `QUESTIONNAIRES` (
  `nom_questionnaire` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `QUESTIONNAIRES`
--

INSERT INTO `QUESTIONNAIRES` (`nom_questionnaire`) VALUES
('a');

-- --------------------------------------------------------

--
-- Structure de la table `QUESTIONS`
--

CREATE TABLE `QUESTIONS` (
  `intitule` varchar(200) NOT NULL,
  `nom_questionnaire` varchar(100) NOT NULL,
  `latitude` float NOT NULL,
  `longitude` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `QUESTIONS`
--

INSERT INTO `QUESTIONS` (`intitule`, `nom_questionnaire`, `latitude`, `longitude`) VALUES
('e', 'a', 123, 123),
('i', 'a', 123, 123),
('r', 'a', 123, 123),
('t', 'a', 123, 123),
('u', 'a', 123, 123),
('y', 'a', 123, 123),
('z', 'a', 123, 123);

-- --------------------------------------------------------

--
-- Structure de la table `UTILISATEURS`
--

CREATE TABLE `UTILISATEURS` (
  `pseudo` varchar(35) NOT NULL DEFAULT '',
  `prenom` varchar(35) DEFAULT NULL,
  `nom` varchar(35) DEFAULT NULL,
  `email` varchar(60) DEFAULT NULL,
  `mdp` varchar(150) DEFAULT NULL,
  `grain_de_sel` varchar(100) NOT NULL,
  `date_inscription` date DEFAULT NULL,
  `droit` set('admin','user') NOT NULL COMMENT 'droit utilisateur/admin'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `UTILISATEURS`
--

INSERT INTO `UTILISATEURS` (`pseudo`, `prenom`, `nom`, `email`, `mdp`, `grain_de_sel`, `date_inscription`, `droit`) VALUES
('bibi', 'toto', 'tutu', 'lal@hotmail.fr', '8b4dd7a9d667a2529e38be26aa3385a9', '101RM8uDeZak3CcMVN2IYdsKHaS8nzqgrk7CBpuvwoAbxyEHFJb03zMr17yK', '2018-05-13', 'user'),
('Hitaway', 'Quentin', 'Rat', 'machin@hotmail.fr', '9d6af38d8094d466ed895b9968e6c8d8', 'p5bEHCQM62kVsgWcyMeUISfbNF5ESfJN6Iawjta7GUHYmLLWpgjdjWeachOh', '0000-00-00', 'admin'),
('Kinstaar', 'Piong', 'Wang', 'machin3@hotmail.fr', '9d6af38d8094d466ed895b9968e6c8d8', 'p5bEHCQM62kVsgWcyMeUISfbNF5ESfJN6Iawjta7GUHYmLLWpgjdjWeachOh', '2018-04-12', 'user'),
('Micka', 'Mickael', 'André', 'machin4@hotmail.fr', '9d6af38d8094d466ed895b9968e6c8d8', 'p5bEHCQM62kVsgWcyMeUISfbNF5ESfJN6Iawjta7GUHYmLLWpgjdjWeachOh', '2018-04-12', 'user'),
('Robi62', 'Robin', 'Delanoe', 'machin5@hotmail.fr', '9d6af38d8094d466ed895b9968e6c8d8', 'p5bEHCQM62kVsgWcyMeUISfbNF5ESfJN6Iawjta7GUHYmLLWpgjdjWeachOh', '2018-04-12', 'user'),
('Slimane93', 'Slimane', 'Kouba', 'machin2@hotmail.fr', '9d6af38d8094d466ed895b9968e6c8d8', 'p5bEHCQM62kVsgWcyMeUISfbNF5ESfJN6Iawjta7GUHYmLLWpgjdjWeachOh', '2018-04-10', 'admin'),
('titi', 'toto', 'tata', 'bidule@hotmail.com', '9d6af38d8094d466ed895b9968e6c8d8', 'p5bEHCQM62kVsgWcyMeUISfbNF5ESfJN6Iawjta7GUHYmLLWpgjdjWeachOh', '2018-05-13', 'user');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `CLASSEMENT`
--
ALTER TABLE `CLASSEMENT`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_classement_pseudo_historique` (`pseudo`);

--
-- Index pour la table `HISTORIQUE`
--
ALTER TABLE `HISTORIQUE`
  ADD PRIMARY KEY (`id`,`score`),
  ADD KEY `fk_historique_pseudo_utilisateur` (`pseudo`);

--
-- Index pour la table `QUESTIONNAIRES`
--
ALTER TABLE `QUESTIONNAIRES`
  ADD PRIMARY KEY (`nom_questionnaire`);

--
-- Index pour la table `QUESTIONS`
--
ALTER TABLE `QUESTIONS`
  ADD PRIMARY KEY (`intitule`,`nom_questionnaire`),
  ADD KEY `fk_questions_nom_question_questionnaires` (`nom_questionnaire`) USING BTREE;

--
-- Index pour la table `UTILISATEURS`
--
ALTER TABLE `UTILISATEURS`
  ADD PRIMARY KEY (`pseudo`);

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `CLASSEMENT`
--
ALTER TABLE `CLASSEMENT`
  ADD CONSTRAINT `fk_classement_id_historique` FOREIGN KEY (`id`) REFERENCES `HISTORIQUE` (`id`),
  ADD CONSTRAINT `fk_classement_pseudo_historique` FOREIGN KEY (`pseudo`) REFERENCES `HISTORIQUE` (`pseudo`);

--
-- Contraintes pour la table `HISTORIQUE`
--
ALTER TABLE `HISTORIQUE`
  ADD CONSTRAINT `fk_historique_pseudo_utilisateur` FOREIGN KEY (`pseudo`) REFERENCES `UTILISATEURS` (`pseudo`);

--
-- Contraintes pour la table `QUESTIONS`
--
ALTER TABLE `QUESTIONS`
  ADD CONSTRAINT `fk_questions_nom_question_questionaires` FOREIGN KEY (`nom_questionnaire`) REFERENCES `QUESTIONNAIRES` (`nom_questionnaire`);
