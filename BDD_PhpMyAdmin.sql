-- phpMyAdmin SQL Dump
-- version 4.7.3
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:8889
-- Généré le :  mer. 18 avr. 2018 à 14:18
-- Version du serveur :  5.6.35
-- Version de PHP :  7.1.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Base de données :  `bd_projet_l3`
--

-- --------------------------------------------------------

--
-- Structure de la table `CLASSEMENT`
--

CREATE TABLE `CLASSEMENT` (
  `id` int(11) UNSIGNED NOT NULL,
  `score` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `HISTORIQUE`
--

CREATE TABLE `HISTORIQUE` (
  `id` int(11) UNSIGNED NOT NULL,
  `pseudo` varchar(35) NOT NULL,
  `score` int(11) UNSIGNED NOT NULL,
  `nom_questionnaire` varchar(200) NOT NULL,
  `date_partie` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `HISTORIQUE`
--

INSERT INTO `HISTORIQUE` (`id`, `pseudo`, `score`, `nom_questionnaire`, `date_partie`) VALUES
(1, 'Hitaway', 12, '7 merveille deu monde', '2018-04-10');

-- --------------------------------------------------------

--
-- Structure de la table `QUESTIONNAIRES`
--

CREATE TABLE `QUESTIONNAIRES` (
  `nom_questionnaire` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `QUESTIONS`
--

CREATE TABLE `QUESTIONS` (
  `intitule` varchar(300) NOT NULL,
  `nom_questionaire` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `UTILISATEURS`
--

CREATE TABLE `UTILISATEURS` (
  `pseudo` varchar(35) NOT NULL DEFAULT '',
  `prenom` varchar(35) DEFAULT NULL,
  `nom` varchar(35) DEFAULT NULL,
  `email` varchar(35) DEFAULT NULL,
  `mdp` varchar(35) DEFAULT NULL,
  `date_inscription` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `UTILISATEURS`
--

INSERT INTO `UTILISATEURS` (`pseudo`, `prenom`, `nom`, `email`, `mdp`, `date_inscription`) VALUES
('Hitaway', 'Quentin', 'Rat', 'machin@hotmail.fr', 'azerty', '0000-00-00');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `CLASSEMENT`
--
ALTER TABLE `CLASSEMENT`
  ADD PRIMARY KEY (`id`);

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
  ADD PRIMARY KEY (`nom_questionaire`);

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
  ADD CONSTRAINT `fk_classement_id_historique` FOREIGN KEY (`id`) REFERENCES `HISTORIQUE` (`id`);

--
-- Contraintes pour la table `HISTORIQUE`
--
ALTER TABLE `HISTORIQUE`
  ADD CONSTRAINT `fk_historique_pseudo_utilisateur` FOREIGN KEY (`pseudo`) REFERENCES `UTILISATEURS` (`pseudo`);

--
-- Contraintes pour la table `QUESTIONS`
--
ALTER TABLE `QUESTIONS`
  ADD CONSTRAINT `fk_questions_nom_question_questionaires` FOREIGN KEY (`nom_questionaire`) REFERENCES `QUESTIONNAIRES` (`nom_questionnaire`);
