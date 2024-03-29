-- phpMyAdmin SQL Dump
-- version 4.7.3
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:8889
-- Généré le :  sam. 19 mai 2018 à 18:34
-- Version du serveur :  5.6.35
-- Version de PHP :  7.1.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Base de données :  `bd_projet_l3`
--

-- --------------------------------------------------------

--
-- Structure de la table `classement`
--

CREATE TABLE `classement` (
  `id` int(11) UNSIGNED NOT NULL,
  `score` int(10) UNSIGNED NOT NULL,
  `pseudo` varchar(35) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `classement`
--

INSERT INTO `classement` (`id`, `score`, `pseudo`) VALUES
(1, 70, 'Hitaway'),
(2, 40, 'Robi62'),
(3, 45, 'Robi62'),
(4, 50, 'Robi62'),
(5, 60, 'Robi62'),
(6, 60, 'Robi62'),
(7, 50, 'Robi62'),
(8, 40, 'Robi62'),
(9, 25, 'Micka'),
(10, 50, 'Kinstaar');

-- --------------------------------------------------------

--
-- Structure de la table `historique`
--

CREATE TABLE `historique` (
  `id` int(11) UNSIGNED NOT NULL,
  `pseudo` varchar(35) NOT NULL,
  `nom_questionnaire` varchar(200) NOT NULL,
  `date_partie` date NOT NULL,
  `score` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `historique`
--

INSERT INTO `historique` (`id`, `pseudo`, `nom_questionnaire`, `date_partie`, `score`) VALUES
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
-- Structure de la table `questionnaires`
--

CREATE TABLE `questionnaires` (
  `nom_questionnaire` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `questionnaires`
--

INSERT INTO `questionnaires` (`nom_questionnaire`) VALUES
('7 merveille du monde'),
('7 merveilles du Football');

-- --------------------------------------------------------

--
-- Structure de la table `questions`
--

CREATE TABLE `questions` (
  `intitule` varchar(200) NOT NULL,
  `nom_questionnaire` varchar(100) NOT NULL,
  `latitude` float NOT NULL,
  `longitude` float NOT NULL,
  `information1` text NOT NULL,
  `information2` text NOT NULL,
  `information3` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `questions`
--

INSERT INTO `questions` (`intitule`, `nom_questionnaire`, `latitude`, `longitude`, `information1`, `information2`, `information3`) VALUES
('Localiser La Pyramide de Kheops.', '7 merveille du monde', 31.1339, 29.9789, '', '', ''),
('Localiser La statue chryselephantine de Zeus.', '7 merveille du monde', 21.63, 38.6378, '', '', ''),
('Localiser la Tour de Pharos.', '7 merveille du monde', 29.885, 31.2142, '', '', ''),
('Localiser Le colosse de Rhodes', '7 merveille du monde', 28.2278, 36.4511, '', '', ''),
('Localiser Le Temple d\'Artemis.', '7 merveille du monde', 27.3639, 37.9497, '', '', ''),
('Localiser Le tombeau de Mausole.', '7 merveille du monde', 27.4241, 37.0379, '', '', ''),
('Localiser Les jardins suspendus de Babylone', '7 merveille du monde', 44.4275, 32.5355, '', '', ''),
('Localisez le San Siro Stadio.', '7 merveilles du Football', 45.4763, 9.12293, '', '', ''),
('Localisez Le stade de l\'Allianz Arena.', '7 merveilles du Football', 48.2186, 11.624, '', '', ''),
('Localisez Le stade de la Bombonera.', '7 merveilles du Football', -34.6357, -58.3647, '', '', ''),
('Localisez Le stade de Wembley.', '7 merveilles du Football', 51.556, -0.279519, '', '', ''),
('Localisez Le stade du Camp Nou.', '7 merveilles du Football', 41.3787, 2.12086, '', '', ''),
('Localisez Le stade du Maracanã', '7 merveilles du Football', -22.9136, -43.2276, '', '', ''),
('Localisez Le stade Orange Vélodrome.', '7 merveilles du Football', 43.2698, 5.39589, '', '', '');

-- --------------------------------------------------------

--
-- Structure de la table `utilisateurs`
--

CREATE TABLE `utilisateurs` (
  `pseudo` varchar(35) NOT NULL DEFAULT '',
  `prenom` varchar(35) NOT NULL,
  `nom` varchar(35) NOT NULL,
  `email` varchar(60) NOT NULL,
  `mdp` varchar(150) NOT NULL,
  `grain_de_sel` varchar(100) NOT NULL,
  `date_inscription` date NOT NULL,
  `droit` set('admin','user') NOT NULL COMMENT 'droit utilisateur/admin'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `utilisateurs`
--

INSERT INTO `utilisateurs` (`pseudo`, `prenom`, `nom`, `email`, `mdp`, `grain_de_sel`, `date_inscription`, `droit`) VALUES
('bibi', 'toto', 'tutu', 'lal@hotmail.fr', '8b4dd7a9d667a2529e38be26aa3385a9', '101RM8uDeZak3CcMVN2IYdsKHaS8nzqgrk7CBpuvwoAbxyEHFJb03zMr17yK', '2018-05-13', 'user'),
('Hitaway', 'Quentin', 'Rat', 'machin@hotmail.fr', '9d6af38d8094d466ed895b9968e6c8d8', 'p5bEHCQM62kVsgWcyMeUISfbNF5ESfJN6Iawjta7GUHYmLLWpgjdjWeachOh', '2018-04-12', 'admin'),
('Kinstaar', 'Piong', 'Wang', 'machin3@hotmail.fr', '9d6af38d8094d466ed895b9968e6c8d8', 'p5bEHCQM62kVsgWcyMeUISfbNF5ESfJN6Iawjta7GUHYmLLWpgjdjWeachOh', '2018-04-12', 'user'),
('Micka', 'Mickael', 'André', 'machin4@hotmail.fr', '9d6af38d8094d466ed895b9968e6c8d8', 'p5bEHCQM62kVsgWcyMeUISfbNF5ESfJN6Iawjta7GUHYmLLWpgjdjWeachOh', '2018-04-12', 'user'),
('Robi62', 'Robin', 'Delanoe', 'machin5@hotmail.fr', '9d6af38d8094d466ed895b9968e6c8d8', 'p5bEHCQM62kVsgWcyMeUISfbNF5ESfJN6Iawjta7GUHYmLLWpgjdjWeachOh', '2018-04-12', 'user'),
('Slimane93', 'Slimane', 'Kouba', 'machin2@hotmail.fr', '9d6af38d8094d466ed895b9968e6c8d8', 'p5bEHCQM62kVsgWcyMeUISfbNF5ESfJN6Iawjta7GUHYmLLWpgjdjWeachOh', '2018-04-10', 'admin'),
('titi', 'toto', 'tata', 'bidule@hotmail.com', '9d6af38d8094d466ed895b9968e6c8d8', 'p5bEHCQM62kVsgWcyMeUISfbNF5ESfJN6Iawjta7GUHYmLLWpgjdjWeachOh', '2018-05-13', 'user');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `classement`
--
ALTER TABLE `classement`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_classement_pseudo_historique` (`pseudo`);

--
-- Index pour la table `historique`
--
ALTER TABLE `historique`
  ADD PRIMARY KEY (`id`,`score`),
  ADD KEY `fk_historique_pseudo_utilisateur` (`pseudo`);

--
-- Index pour la table `questionnaires`
--
ALTER TABLE `questionnaires`
  ADD PRIMARY KEY (`nom_questionnaire`);

--
-- Index pour la table `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`intitule`,`nom_questionnaire`),
  ADD KEY `fk_questions_nom_question_questionaires` (`nom_questionnaire`);

--
-- Index pour la table `utilisateurs`
--
ALTER TABLE `utilisateurs`
  ADD PRIMARY KEY (`pseudo`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `classement`
--
ALTER TABLE `classement`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT pour la table `historique`
--
ALTER TABLE `historique`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `classement`
--
ALTER TABLE `classement`
  ADD CONSTRAINT `fk_classement_pseudo_historique` FOREIGN KEY (`pseudo`) REFERENCES `historique` (`pseudo`);

--
-- Contraintes pour la table `historique`
--
ALTER TABLE `historique`
  ADD CONSTRAINT `fk_historique_pseudo_utilisateur` FOREIGN KEY (`pseudo`) REFERENCES `utilisateurs` (`pseudo`);

--
-- Contraintes pour la table `questions`
--
ALTER TABLE `questions`
  ADD CONSTRAINT `fk_questions_nom_question_questionaires` FOREIGN KEY (`nom_questionnaire`) REFERENCES `questionnaires` (`nom_questionnaire`);
