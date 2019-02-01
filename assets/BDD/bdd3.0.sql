-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jan 30, 2019 at 02:45 PM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `cartopus`
--

-- --------------------------------------------------------

--
-- Table structure for table `acteur`
--

CREATE TABLE IF NOT EXISTS `acteur` (
  `NOACTEUR` int(4) NOT NULL AUTO_INCREMENT,
  `NOPROFIL` int(4) NOT NULL,
  `NOMACTEUR` varchar(64) NOT NULL,
  `PRENOMACTEUR` varchar(64) DEFAULT NULL,
  `MOTDEPASSE` varchar(64) NOT NULL,
  `MAIL` varchar(128) NOT NULL,
  `NOTEL` varchar(10) DEFAULT NULL,
  `PhotoProfil` varchar(128) DEFAULT NULL,
  `noQuestion` int(3) NOT NULL,
  `Reponse` varchar(256) DEFAULT NULL,
  `MailVisible` tinyint(1) DEFAULT '0',
  `NoTelVisible` tinyint(1) DEFAULT '0',
  `Finaliser` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`NOACTEUR`),
  KEY `I_FK_ACTEUR_PROFIL` (`NOPROFIL`),
  KEY `noQuestion` (`noQuestion`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `acteur`
--

INSERT INTO `acteur` (`NOACTEUR`, `NOPROFIL`, `NOMACTEUR`, `PRENOMACTEUR`, `MOTDEPASSE`, `MAIL`, `NOTEL`, `PhotoProfil`, `noQuestion`, `Reponse`, `MailVisible`, `NoTelVisible`, `Finaliser`) VALUES
(1, 5, 'Chevalier', 'Leandre', 'goldfinger007', '1cape1slip@gmail.com', '', '4pPaR31L_1Ph20T.png', 10, 'Thailand', 0, 0, 1),
(4, 1, 'Gelin', 'Deborah', 'gelind', 'deborahgelin@hotmail.fr', '0781815060', '4_2019-01-22_14_43_45.jpeg', 2, 'Till Lindemann', 1, 0, 1),
(7, 1, 'Le Pogam', 'Matthieu', 'lepogamm', 'lepogam.matthieu@gmail.com', '0633902414', '4pPaR31L_1Ph20T.png', 2, 'Eluveitie', 1, 0, 1),
(8, 1, 'Le Moigne', 'Nathalie', 'lemoignen', 'secretariat.mjcduplateau@gmail.com', '', '4pPaR31L_1Ph20T.png', 1, 'follet', 0, 0, 1),
(9, 1, 'Caillet', 'Alexia', 'cailleta', 'insta.mjcduplateau@gmail.com', '', '4pPaR31L_1Ph20T.png', 5, 'Hanouna', 1, 0, 1),
(10, 1, 'Goure', 'Mickael', 'gourem', 'mickael.mjcduplateau@gmail.com', '', '4pPaR31L_1Ph20T.png', 9, 'cafe', 0, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `action`
--

CREATE TABLE IF NOT EXISTS `action` (
  `NOACTION` int(4) NOT NULL AUTO_INCREMENT,
  `NOMACTION` varchar(128) NOT NULL,
  `PublicCible` varchar(64) DEFAULT NULL,
  `SiteURLAction` varchar(256) DEFAULT NULL,
  `Favoris` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`NOACTION`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `action`
--

INSERT INTO `action` (`NOACTION`, `NOMACTION`, `PublicCible`, `SiteURLAction`, `Favoris`) VALUES
(1, 'Tango Bresilien et Argentin', 'Tout Public', 'http://mjcduplateau.fr/index.php', 0),
(2, 'Babel danse 15ème édition Cap sur la Paulinaisy', 'Tout Public', 'http://babeldanse.fr/', 1),
(7, 'Action en équipe', 'Tout Public', 'http://mjcduplateau.fr/index.php', 0),
(8, 'Action de Test', '3eme Age', 'http://mjcduplateau.fr/index.php', 0);

-- --------------------------------------------------------

--
-- Table structure for table `avoirlieu`
--

CREATE TABLE IF NOT EXISTS `avoirlieu` (
  `DATEDEBUT` datetime NOT NULL,
  `NOACTION` int(4) NOT NULL,
  `TitreAction` varchar(128) NOT NULL,
  `NOLIEU` int(4) NOT NULL,
  `DATEFIN` datetime DEFAULT NULL,
  `Description` varchar(10000) DEFAULT NULL,
  PRIMARY KEY (`DATEDEBUT`,`NOACTION`,`NOLIEU`),
  KEY `I_FK_AVOIRLIEU_ACTION` (`NOACTION`),
  KEY `I_FK_AVOIRLIEU_LIEU` (`NOLIEU`),
  KEY `TitreAction` (`TitreAction`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `avoirlieu`
--

INSERT INTO `avoirlieu` (`DATEDEBUT`, `NOACTION`, `TitreAction`, `NOLIEU`, `DATEFIN`, `Description`) VALUES
('2019-01-21 18:30:00', 1, 'Tango Bresilien et Argentin', 1, '2019-01-21 21:30:00', 'Venez tous apprendre à danser le tango argentin.\r\nPas de niveau requis'),
('2019-01-21 18:30:01', 1, 'Tango Argentin', 9, '2019-01-21 19:30:00', 'c''est cool la danse'),
('2019-01-28 15:00:00', 7, 'Action en équipe', 1, '2019-01-29 16:00:00', 'C''est cool il y a plein de coupains'),
('2019-01-28 17:00:01', 7, 'SousAction 1', 9, '2019-01-28 17:30:00', 'sous action 1'),
('2019-01-29 10:00:01', 7, 'SousAction 2', 9, '2019-01-29 10:30:00', 'Sous Action 2'),
('2019-02-01 14:44:00', 8, 'Action de Test', 1, '2019-02-02 15:00:00', 'le statut est a combien ?'),
('2019-03-06 10:00:00', 2, 'Babel danse 15ème édition Cap sur la polinésie', 1, '2019-03-09 00:00:00', 'Cette 15ème édition met à l’honneur les danses bien sûr, mais aussi la musique, les arts populaires, la réalité et l’imaginaire polynésiens. Avec les turbulentes participations des troupes Moemoe A (Rospez), Ata Nui (Paris), Heivanui (Lanester), Le Souffle Maohi (Meucon), les tatoueurs Tam’s Tatau (Quimper), le sculpteur Gaëtan Pichaud (Nantes) et la peintre Nataly Jolibois (Planguenoual).\r\n\r\n \r\n\r\nL’Utua Faré (chez moi) figure une place de village au coeur de la MJC, avec ses stands, son coin-lecture, ses mini-expos... Chaque après-midi de 14h à 18h, venez y rencontrer artistes et artisans ou musarder entre deux animations informelles : à la mode polynésienne, attendez-vous à vous faire happer par une visite d’expo, une démonstration de haka ou une dégustation de crêpes-banane ! Entrée libre et gratuite.'),
('2019-03-06 14:00:00', 2, 'Cinéma Mobile - Le court-Circuit', 1, '2019-03-06 17:00:00', 'En Partenariat avec le Cercle.\r\n\r\nSéance toutes les 30 minutes, sur inscription.\r\n\r\n"Visage de Polynésie", projection de courts-métrages de différents styles et approches, entre modernité et imaginaire.'),
('2019-03-06 19:00:00', 2, 'Ouverture officielle', 1, '2019-03-06 22:00:00', 'Entrée libre, dans la limite des places disponible. \r\n\r\nAvec le troupe Heivanui : attention passage de danseurs ! Visite de l''Utua Faré et vernissage : exposition de Tikis du sculpteur Gaëtan Pichaud, exposition de peintures de Nataly Jolibois.'),
('2019-03-06 20:30:00', 2, 'Conférence dansée : "Danses de Polynésie"', 1, '2019-03-07 00:00:00', 'Par Moevai, asso Moemoe A.\r\n\r\nA partir de 12 ans, gratuit, dans la limite des places disponibles.\r\n\r\nMoevai c''est un peu l''âme de cette édition. Elle est excelle dans les danses ''Otea et Aparima tout comme dans l''art végétal et les parures. Sa générosité a illuminé les rencontres et ateliers qui ont jalonné le chemin vers ce festival.'),
('2019-03-07 14:00:00', 2, 'Utua Faré spécial mode', 1, '2019-03-07 17:00:00', 'Avec Isabelle, Elise, Moevai, les Tam''s, le groupe du Lundi du centre Social du Plateau et les animateurs jeunesse. \r\n\r\nAnimations, costumes, paréos et parures, art végétal, tatouages éphémères');

-- --------------------------------------------------------

--
-- Table structure for table `commenteracteur`
--

CREATE TABLE IF NOT EXISTS `commenteracteur` (
  `NOACTEUR` int(4) NOT NULL,
  `NOACTION` int(4) NOT NULL,
  `DATEHEURE` datetime NOT NULL,
  `COMMENTAIRE` varchar(10000) DEFAULT NULL,
  PRIMARY KEY (`NOACTEUR`,`NOACTION`,`DATEHEURE`),
  KEY `I_FK_COMMENTERACTEUR_ACTEUR` (`NOACTEUR`),
  KEY `I_FK_COMMENTERACTEUR_ACTION` (`NOACTION`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `commentervisiteur`
--

CREATE TABLE IF NOT EXISTS `commentervisiteur` (
  `DATEHEURE` datetime NOT NULL,
  `NOACTION` int(4) NOT NULL,
  `NOMVISITEUR` varchar(32) DEFAULT NULL,
  `COMMENTAIRE` varchar(10000) DEFAULT NULL,
  PRIMARY KEY (`DATEHEURE`,`NOACTION`),
  KEY `I_FK_COMMENTERVISITEUR_ACTION` (`NOACTION`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `encoursinscription`
--

CREATE TABLE IF NOT EXISTS `encoursinscription` (
  `Code` varchar(15) NOT NULL,
  `mail` varchar(64) NOT NULL,
  `DateJour` datetime NOT NULL,
  PRIMARY KEY (`Code`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `encoursinscription`
--

INSERT INTO `encoursinscription` (`Code`, `mail`, `DateJour`) VALUES
('cYjYDPymhsHCZRp', 'secretariat.mjcduplateau@gmail.com', '2019-01-28 10:53:33'),
('fciA46ApmhamERf', 'insta.mjcduplateau@gmail.com', '2019-01-28 10:55:27'),
('iRnzAt0l3tgh2hi', 'mickael.mjcduplateau@gmail.com', '2019-01-28 10:58:00'),
('sQh20yXtQgqHksL', 'lepogam.matthieu@gmail.com', '2019-01-21 17:53:09');

-- --------------------------------------------------------

--
-- Table structure for table `etrepartenaire`
--

CREATE TABLE IF NOT EXISTS `etrepartenaire` (
  `NOACTION` int(4) NOT NULL,
  `NOACTEUR` int(4) NOT NULL,
  `NOROLE` int(4) NOT NULL,
  `DATEDEBUT` datetime NOT NULL,
  `DATEFIN` datetime DEFAULT NULL,
  PRIMARY KEY (`NOACTION`,`NOACTEUR`,`NOROLE`,`DATEDEBUT`),
  KEY `I_FK_ETREPARTENAIRE_ACTION` (`NOACTION`),
  KEY `I_FK_ETREPARTENAIRE_ACTEUR` (`NOACTEUR`),
  KEY `I_FK_ETREPARTENAIRE_ROLE` (`NOROLE`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `etrepartenaire`
--

INSERT INTO `etrepartenaire` (`NOACTION`, `NOACTEUR`, `NOROLE`, `DATEDEBUT`, `DATEFIN`) VALUES
(1, 4, 2147483642, '2019-01-21 18:30:00', '2019-01-21 21:30:00'),
(2, 4, 2147483642, '2019-03-06 10:00:00', '2019-03-09 00:00:00'),
(2, 7, 2, '2019-03-06 10:00:00', '2019-03-09 00:00:00'),
(2, 10, 1, '2019-03-06 10:00:00', '2019-03-09 00:00:00'),
(7, 4, 2147483642, '2019-01-28 15:00:00', '2019-01-29 16:00:00'),
(7, 8, 2, '2019-01-28 15:00:00', '2019-01-29 16:00:00'),
(7, 9, 1, '2019-01-28 15:00:00', '2019-01-29 16:00:00'),
(7, 10, 1, '2019-01-28 15:00:00', '2019-01-29 16:00:00'),
(8, 4, 2147483642, '2019-02-01 14:44:00', '2019-02-02 15:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `fairereference`
--

CREATE TABLE IF NOT EXISTS `fairereference` (
  `NOTHEMATIQUE` int(4) NOT NULL,
  `NOACTION` int(4) NOT NULL,
  `MOTCLE` varchar(64) NOT NULL,
  PRIMARY KEY (`NOTHEMATIQUE`,`NOACTION`,`MOTCLE`),
  KEY `I_FK_FAIREREFERENCE_THEMATIQUE` (`NOTHEMATIQUE`),
  KEY `I_FK_FAIREREFERENCE_ACTION` (`NOACTION`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `imbriquer`
--

CREATE TABLE IF NOT EXISTS `imbriquer` (
  `NOZONE` int(4) NOT NULL,
  `NOSOUSZONE` int(4) NOT NULL,
  PRIMARY KEY (`NOZONE`,`NOSOUSZONE`),
  KEY `I_FK_IMBRIQUER_ZONE` (`NOZONE`),
  KEY `I_FK_IMBRIQUER_ZONE1` (`NOSOUSZONE`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `lieu`
--

CREATE TABLE IF NOT EXISTS `lieu` (
  `NOLIEU` int(4) NOT NULL AUTO_INCREMENT,
  `ADRESSE` varchar(256) DEFAULT NULL,
  `NOMLIEU` varchar(64) DEFAULT NULL,
  `LONGITUDE` varchar(16) DEFAULT NULL,
  `LATITUDE` varchar(16) DEFAULT NULL,
  `ALTITUDE` varchar(16) DEFAULT NULL,
  `CodePostal` int(5) NOT NULL,
  `Ville` varchar(64) NOT NULL,
  PRIMARY KEY (`NOLIEU`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `lieu`
--

INSERT INTO `lieu` (`NOLIEU`, `ADRESSE`, `NOMLIEU`, `LONGITUDE`, `LATITUDE`, `ALTITUDE`, `CodePostal`, `Ville`) VALUES
(1, '1 Avenue Antoine Mazier', 'MJC du Plateau', '-2.741343', '48.514356', NULL, 22000, 'Saint-Brieuc'),
(2, '1 Rue Mathurin Méheut', 'Centre social du Plateau', '-2.740166', '48.514980', NULL, 22000, 'Saint-Brieuc'),
(4, '44 Rue du 71E Régiment d''Infanterie', NULL, NULL, NULL, NULL, 22000, 'Saint Brieuc'),
(5, '1 rue Jules Vernes', NULL, NULL, NULL, NULL, 44190, 'Clisson'),
(6, '22 rue Madame Lagarde', NULL, NULL, NULL, NULL, 56500, 'Vannes'),
(7, '25 rue Abbe Garnier', NULL, NULL, NULL, NULL, 22000, 'Saint-Brieuc'),
(8, '10 route de Moncontour', NULL, NULL, NULL, NULL, 22120, 'Quessoy'),
(9, '1 Avenue Antoine Mazier', NULL, NULL, NULL, NULL, 22000, 'St Brieuc'),
(10, '2 Avenue Antoine Mazier', NULL, NULL, NULL, NULL, 22000, 'Saint-Brieuc');

-- --------------------------------------------------------

--
-- Table structure for table `organisation`
--

CREATE TABLE IF NOT EXISTS `organisation` (
  `NO_ORGANISATION` int(4) NOT NULL AUTO_INCREMENT,
  `NOLIEU` int(4) NOT NULL,
  `NOMORGANISATION` varchar(64) DEFAULT NULL,
  `NOTELORGA` varchar(10) DEFAULT NULL,
  `NOFAXORGA` varchar(10) DEFAULT NULL,
  `SITEURL` varchar(552) DEFAULT NULL,
  PRIMARY KEY (`NO_ORGANISATION`),
  KEY `I_FK_ORGANISATION_LIEU` (`NOLIEU`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `organisation`
--

INSERT INTO `organisation` (`NO_ORGANISATION`, `NOLIEU`, `NOMORGANISATION`, `NOTELORGA`, `NOFAXORGA`, `SITEURL`) VALUES
(1, 1, 'MJC du Plateau', NULL, NULL, NULL),
(2, 2, 'Centre social du Plateau', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `posseder`
--

CREATE TABLE IF NOT EXISTS `posseder` (
  `NO_ORGANISATION` int(4) NOT NULL,
  `NOSECTEUR` int(4) NOT NULL,
  PRIMARY KEY (`NO_ORGANISATION`,`NOSECTEUR`),
  KEY `I_FK_POSSEDER_ORGANISATION` (`NO_ORGANISATION`),
  KEY `I_FK_POSSEDER_SECTEUR` (`NOSECTEUR`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `posseder`
--

INSERT INTO `posseder` (`NO_ORGANISATION`, `NOSECTEUR`) VALUES
(1, 1),
(1, 2),
(1, 3),
(1, 4);

-- --------------------------------------------------------

--
-- Table structure for table `profil`
--

CREATE TABLE IF NOT EXISTS `profil` (
  `NOPROFIL` int(4) NOT NULL AUTO_INCREMENT,
  `NOMPROFIL` varchar(64) DEFAULT NULL,
  PRIMARY KEY (`NOPROFIL`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `profil`
--

INSERT INTO `profil` (`NOPROFIL`, `NOMPROFIL`) VALUES
(0, 'Visiteur'),
(1, 'Acteur'),
(2, 'Collaborateur'),
(3, 'Responsable'),
(4, 'AdminValider'),
(5, 'SuperAdmin');

-- --------------------------------------------------------

--
-- Table structure for table `profilpouraction`
--

CREATE TABLE IF NOT EXISTS `profilpouraction` (
  `NOACTEUR` int(4) NOT NULL,
  `NOACTION` int(4) NOT NULL,
  `DATEDEBUT` datetime NOT NULL,
  `NOPROFIL` int(4) NOT NULL,
  `DATEFIN` datetime DEFAULT NULL,
  PRIMARY KEY (`NOACTEUR`,`NOACTION`,`DATEDEBUT`,`NOPROFIL`),
  KEY `I_FK_PROFILPOURACTION_ACTEUR` (`NOACTEUR`),
  KEY `I_FK_PROFILPOURACTION_ACTION` (`NOACTION`),
  KEY `I_FK_PROFILPOURACTION_PROFIL` (`NOPROFIL`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `profilpouraction`
--

INSERT INTO `profilpouraction` (`NOACTEUR`, `NOACTION`, `DATEDEBUT`, `NOPROFIL`, `DATEFIN`) VALUES
(4, 1, '2019-01-21 18:30:00', 3, '2019-01-21 21:30:00'),
(4, 2, '2019-03-06 10:00:00', 3, '2019-03-09 00:00:00'),
(4, 7, '2019-01-28 15:00:00', 3, '2019-01-29 16:00:00'),
(4, 8, '2019-02-01 14:44:00', 3, '2019-02-02 15:00:00'),
(7, 1, '2019-01-21 18:30:00', 2, '2019-01-21 21:30:00'),
(7, 2, '2019-03-06 10:00:00', 2, '2019-03-09 00:00:00'),
(8, 7, '2019-01-28 15:00:00', 2, '2019-01-29 16:00:00'),
(9, 7, '2019-01-28 15:00:00', 3, '2019-01-29 16:00:00'),
(10, 2, '2019-03-06 10:00:00', 2, '2019-03-09 00:00:00'),
(10, 7, '2019-01-28 15:00:00', 2, '2019-01-29 16:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `questionsecrete`
--

CREATE TABLE IF NOT EXISTS `questionsecrete` (
  `noQuestion` int(3) NOT NULL AUTO_INCREMENT,
  `nomQuestion` varchar(256) NOT NULL,
  PRIMARY KEY (`noQuestion`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `questionsecrete`
--

INSERT INTO `questionsecrete` (`noQuestion`, `nomQuestion`) VALUES
(1, 'Quel est le nom de votre auteur préféré ?'),
(2, 'Quel est le nom de votre chanteur préféré ?'),
(3, 'Quel est le nom de votre premier animal de compagnie ?'),
(4, 'Quel est le nom de jeune fille de votre mère ?'),
(5, 'Qui était votre héros d''enfance ?'),
(6, 'Quel est le métier de votre grand père ?'),
(7, 'Quel était le modèle de votre premier véhicule ?'),
(8, 'Comment s''appelait votre instituteur préféré à l''école primaire ?'),
(9, 'Quel est le premier plat que vous avez appris à cuisiner ?'),
(10, 'Où rêvez vous de voyager ?');

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE IF NOT EXISTS `role` (
  `NOROLE` int(4) NOT NULL AUTO_INCREMENT,
  `NOMROLE` varchar(64) NOT NULL,
  PRIMARY KEY (`NOROLE`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2147483643 ;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`NOROLE`, `NOMROLE`) VALUES
(1, 'Responsable'),
(2, 'Tresorier'),
(2147483642, 'Créateur');

-- --------------------------------------------------------

--
-- Table structure for table `secteur`
--

CREATE TABLE IF NOT EXISTS `secteur` (
  `NOSECTEUR` int(4) NOT NULL,
  `NOMSECTEUR` varchar(64) NOT NULL,
  PRIMARY KEY (`NOSECTEUR`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `secteur`
--

INSERT INTO `secteur` (`NOSECTEUR`, `NOMSECTEUR`) VALUES
(1, 'Direction'),
(2, 'Gestion'),
(3, 'Accueil'),
(4, 'Multimedia');

-- --------------------------------------------------------

--
-- Table structure for table `setrouver`
--

CREATE TABLE IF NOT EXISTS `setrouver` (
  `NOLIEU` int(4) NOT NULL,
  `NOZONE` int(4) NOT NULL,
  PRIMARY KEY (`NOLIEU`,`NOZONE`),
  KEY `I_FK_SETROUVER_LIEU` (`NOLIEU`),
  KEY `I_FK_SETROUVER_ZONE` (`NOZONE`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sousthematique`
--

CREATE TABLE IF NOT EXISTS `sousthematique` (
  `NOTHEMATIQUE` int(4) NOT NULL,
  `NOSOUSTHEMATIQUE` int(4) NOT NULL,
  PRIMARY KEY (`NOTHEMATIQUE`,`NOSOUSTHEMATIQUE`),
  KEY `I_FK_SOUSTHEMATIQUE_THEMATIQUE` (`NOTHEMATIQUE`),
  KEY `I_FK_SOUSTHEMATIQUE_THEMATIQUE1` (`NOSOUSTHEMATIQUE`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sousthematique`
--

INSERT INTO `sousthematique` (`NOTHEMATIQUE`, `NOSOUSTHEMATIQUE`) VALUES
(1, 2),
(1, 3),
(1, 4),
(1, 9);

-- --------------------------------------------------------

--
-- Table structure for table `stocker`
--

CREATE TABLE IF NOT EXISTS `stocker` (
  `NOACTION` int(4) NOT NULL,
  `DATEHEURE` datetime NOT NULL,
  `DateAction` datetime NOT NULL,
  `FICHIER` varchar(256) NOT NULL,
  PRIMARY KEY (`NOACTION`,`DATEHEURE`,`DateAction`),
  KEY `I_FK_STOCKER_ACTION` (`NOACTION`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `thematique`
--

CREATE TABLE IF NOT EXISTS `thematique` (
  `NOTHEMATIQUE` int(4) NOT NULL AUTO_INCREMENT,
  `NOMTHEMATIQUE` varchar(32) NOT NULL,
  PRIMARY KEY (`NOTHEMATIQUE`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `thematique`
--

INSERT INTO `thematique` (`NOTHEMATIQUE`, `NOMTHEMATIQUE`) VALUES
(1, 'Multimedia'),
(2, 'Informatique'),
(3, 'Photo / Video'),
(4, 'Bureautique'),
(5, 'Culture'),
(6, 'Loisir'),
(7, 'Sport'),
(8, 'Musique'),
(9, 'Sport Collectif');

-- --------------------------------------------------------

--
-- Table structure for table `travaillerdans`
--

CREATE TABLE IF NOT EXISTS `travaillerdans` (
  `NOACTEUR` int(4) NOT NULL,
  `NO_ORGANISATION` int(4) NOT NULL,
  `NOSECTEUR` int(4) NOT NULL,
  PRIMARY KEY (`NOACTEUR`,`NO_ORGANISATION`,`NOSECTEUR`),
  KEY `I_FK_TRAVAILLERDANS_ACTEUR` (`NOACTEUR`),
  KEY `I_FK_TRAVAILLERDANS_ORGANISATION` (`NO_ORGANISATION`),
  KEY `I_FK_TRAVAILLERDANS_SECTEUR` (`NOSECTEUR`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `zone`
--

CREATE TABLE IF NOT EXISTS `zone` (
  `NOZONE` int(4) NOT NULL AUTO_INCREMENT,
  `NOMZONE` varchar(64) NOT NULL,
  `Origine` varchar(16) NOT NULL,
  `LongitudeMax` varchar(16) NOT NULL,
  `LatitudeMax` varchar(16) NOT NULL,
  `VILLE` varchar(64) NOT NULL,
  `CodePostal` int(5) DEFAULT NULL,
  PRIMARY KEY (`NOZONE`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `acteur`
--
ALTER TABLE `acteur`
  ADD CONSTRAINT `acteur_ibfk_1` FOREIGN KEY (`NOPROFIL`) REFERENCES `profil` (`NOPROFIL`);

--
-- Constraints for table `avoirlieu`
--
ALTER TABLE `avoirlieu`
  ADD CONSTRAINT `avoirlieu_ibfk_1` FOREIGN KEY (`NOACTION`) REFERENCES `action` (`NOACTION`),
  ADD CONSTRAINT `avoirlieu_ibfk_2` FOREIGN KEY (`NOLIEU`) REFERENCES `lieu` (`NOLIEU`);

--
-- Constraints for table `commenteracteur`
--
ALTER TABLE `commenteracteur`
  ADD CONSTRAINT `commenteracteur_ibfk_1` FOREIGN KEY (`NOACTEUR`) REFERENCES `acteur` (`NOACTEUR`),
  ADD CONSTRAINT `commenteracteur_ibfk_2` FOREIGN KEY (`NOACTION`) REFERENCES `action` (`NOACTION`);

--
-- Constraints for table `commentervisiteur`
--
ALTER TABLE `commentervisiteur`
  ADD CONSTRAINT `commentervisiteur_ibfk_1` FOREIGN KEY (`NOACTION`) REFERENCES `action` (`NOACTION`);

--
-- Constraints for table `etrepartenaire`
--
ALTER TABLE `etrepartenaire`
  ADD CONSTRAINT `etrepartenaire_ibfk_1` FOREIGN KEY (`NOACTION`) REFERENCES `action` (`NOACTION`),
  ADD CONSTRAINT `etrepartenaire_ibfk_2` FOREIGN KEY (`NOACTEUR`) REFERENCES `acteur` (`NOACTEUR`),
  ADD CONSTRAINT `etrepartenaire_ibfk_3` FOREIGN KEY (`NOROLE`) REFERENCES `role` (`NOROLE`);

--
-- Constraints for table `fairereference`
--
ALTER TABLE `fairereference`
  ADD CONSTRAINT `fairereference_ibfk_1` FOREIGN KEY (`NOTHEMATIQUE`) REFERENCES `thematique` (`NOTHEMATIQUE`),
  ADD CONSTRAINT `fairereference_ibfk_2` FOREIGN KEY (`NOACTION`) REFERENCES `action` (`NOACTION`);

--
-- Constraints for table `imbriquer`
--
ALTER TABLE `imbriquer`
  ADD CONSTRAINT `imbriquer_ibfk_1` FOREIGN KEY (`NOZONE`) REFERENCES `zone` (`NOZONE`),
  ADD CONSTRAINT `imbriquer_ibfk_2` FOREIGN KEY (`NOSOUSZONE`) REFERENCES `zone` (`NOZONE`);

--
-- Constraints for table `organisation`
--
ALTER TABLE `organisation`
  ADD CONSTRAINT `organisation_ibfk_1` FOREIGN KEY (`NOLIEU`) REFERENCES `lieu` (`NOLIEU`);

--
-- Constraints for table `posseder`
--
ALTER TABLE `posseder`
  ADD CONSTRAINT `posseder_ibfk_1` FOREIGN KEY (`NO_ORGANISATION`) REFERENCES `organisation` (`NO_ORGANISATION`),
  ADD CONSTRAINT `posseder_ibfk_2` FOREIGN KEY (`NOSECTEUR`) REFERENCES `secteur` (`NOSECTEUR`);

--
-- Constraints for table `profilpouraction`
--
ALTER TABLE `profilpouraction`
  ADD CONSTRAINT `profilpouraction_ibfk_1` FOREIGN KEY (`NOACTEUR`) REFERENCES `acteur` (`NOACTEUR`),
  ADD CONSTRAINT `profilpouraction_ibfk_2` FOREIGN KEY (`NOACTION`) REFERENCES `action` (`NOACTION`),
  ADD CONSTRAINT `profilpouraction_ibfk_3` FOREIGN KEY (`NOPROFIL`) REFERENCES `profil` (`NOPROFIL`);

--
-- Constraints for table `setrouver`
--
ALTER TABLE `setrouver`
  ADD CONSTRAINT `setrouver_ibfk_1` FOREIGN KEY (`NOLIEU`) REFERENCES `lieu` (`NOLIEU`),
  ADD CONSTRAINT `setrouver_ibfk_2` FOREIGN KEY (`NOZONE`) REFERENCES `zone` (`NOZONE`);

--
-- Constraints for table `sousthematique`
--
ALTER TABLE `sousthematique`
  ADD CONSTRAINT `sousthematique_ibfk_1` FOREIGN KEY (`NOTHEMATIQUE`) REFERENCES `thematique` (`NOTHEMATIQUE`),
  ADD CONSTRAINT `sousthematique_ibfk_2` FOREIGN KEY (`NOSOUSTHEMATIQUE`) REFERENCES `thematique` (`NOTHEMATIQUE`);

--
-- Constraints for table `stocker`
--
ALTER TABLE `stocker`
  ADD CONSTRAINT `stocker_ibfk_1` FOREIGN KEY (`NOACTION`) REFERENCES `action` (`NOACTION`);

--
-- Constraints for table `travaillerdans`
--
ALTER TABLE `travaillerdans`
  ADD CONSTRAINT `travaillerdans_ibfk_1` FOREIGN KEY (`NOACTEUR`) REFERENCES `acteur` (`NOACTEUR`),
  ADD CONSTRAINT `travaillerdans_ibfk_2` FOREIGN KEY (`NO_ORGANISATION`) REFERENCES `organisation` (`NO_ORGANISATION`),
  ADD CONSTRAINT `travaillerdans_ibfk_3` FOREIGN KEY (`NOSECTEUR`) REFERENCES `secteur` (`NOSECTEUR`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
