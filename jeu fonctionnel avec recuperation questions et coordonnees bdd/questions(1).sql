-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  Dim 06 mai 2018 à 10:22
-- Version du serveur :  5.7.21
-- Version de PHP :  5.6.35

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `bdd_projet_l3`
--

-- --------------------------------------------------------

--
-- Structure de la table `questions`
--

DROP TABLE IF EXISTS `questions`;
CREATE TABLE IF NOT EXISTS `questions` (
  `intitule` varchar(200) NOT NULL,
  `nom_questionaire` varchar(100) NOT NULL,
  `latitude` float NOT NULL,
  `longitude` float NOT NULL,
  PRIMARY KEY (`intitule`,`nom_questionaire`),
  KEY `fk_questions_nom_question_questionaires` (`nom_questionaire`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `questions`
--

INSERT INTO `questions` (`intitule`, `nom_questionaire`, `latitude`, `longitude`) VALUES
('Localiser La Pyramide de Kheops.', '7 merveille du monde', 31.1339, 29.9789),
('Localiser La statue chryselephantine de Zeus.', '7 merveille du monde', 21.63, 38.6378),
('Localiser la Tour de Pharos.', '7 merveille du monde', 29.885, 31.2142),
('Localiser Le colosse de Rhodes', '7 merveille du monde', 28.2278, 36.4511),
('Localiser Le Temple d\'Artemis.', '7 merveille du monde', 27.3639, 37.9497),
('Localiser Le tombeau de Mausole.', '7 merveille du monde', 27.4241, 37.0379),
('Localiser Les jardins suspendus de Babylone', '7 merveille du monde', 44.4275, 32.5355);

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `questions`
--
ALTER TABLE `questions`
  ADD CONSTRAINT `fk_questions_nom_question_questionaires` FOREIGN KEY (`nom_questionaire`) REFERENCES `questionnaires` (`nom_questionnaire`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
