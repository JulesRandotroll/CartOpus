-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  jeu. 14 fév. 2019 à 09:15
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
-- Base de données :  `cartopus`
--

-- --------------------------------------------------------

--
-- Structure de la table `acteur`
--

DROP TABLE IF EXISTS `acteur`;
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
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `acteur`
--

INSERT INTO `acteur` (`NOACTEUR`, `NOPROFIL`, `NOMACTEUR`, `PRENOMACTEUR`, `MOTDEPASSE`, `MAIL`, `NOTEL`, `PhotoProfil`, `noQuestion`, `Reponse`, `MailVisible`, `NoTelVisible`, `Finaliser`) VALUES
(1, 5, 'Chevalier', 'Leandre', 'goldfinger007', '1cape1slip@gmail.com', '', '4pPaR31L_1Ph20T.png', 10, 'Thailand', 0, 0, 1),
(4, 1, 'Voyer', 'Jade', 'Chocobo', 'jade.pink22@hotmail.fr', '0788365048', '4_2019-01-21_14_09_44.jpeg', 10, 'Islande', 1, 1, 1),
(5, 1, 'Le Pogam', 'Matthieu', 'Finalfantasy', 'lepogam.matthieu@gmail.com', '0624587941', '5_2019-02-08_09_13_18.jpeg', 10, 'Japon', 1, 0, 1),
(6, 1, 'Goregues', 'Jules', 'motdepasse', 'jules.gc22120@gmail.com', NULL, '4pPaR31L_1Ph20T.png', 9, 'plop', 1, 1, 1),
(7, 1, 'Gelin', 'Deborah', 'azerty', 'deborag.gelin@gmail.fr', NULL, '4pPaR31L_1Ph20T.png\r\n', 9, 'plop2', 0, 0, 1),
(10, 1, 'Lemoigne', 'Nathalie', 'lemoignen', 'secretariat.mjcduplateau@gmail.com', '', '4pPaR31L_1Ph20T.png', 1, 'Follet', 0, 0, 1),
(12, 4, 'Phantomive', 'Ciel', 'majordome', 'blackbutler@hotmail.fr', NULL, '4pPaR31L_1Ph20T.png', 10, 'Japon', 0, 0, 1);

-- --------------------------------------------------------

--
-- Structure de la table `action`
--

DROP TABLE IF EXISTS `action`;
CREATE TABLE IF NOT EXISTS `action` (
  `NOACTION` int(4) NOT NULL AUTO_INCREMENT,
  `NOMACTION` varchar(128) NOT NULL,
  `PublicCible` varchar(64) DEFAULT NULL,
  `SiteURLAction` varchar(256) DEFAULT NULL,
  `Favoris` tinyint(1) NOT NULL DEFAULT '0',
  `VALIDEE` tinyint(1) NOT NULL,
  PRIMARY KEY (`NOACTION`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `action`
--

INSERT INTO `action` (`NOACTION`, `NOMACTION`, `PublicCible`, `SiteURLAction`, `Favoris`, `VALIDEE`) VALUES
(3, 'Babel Danse', 'Tout Public', 'babeldanse.fr', 1, 1),
(4, 'Chocobo', 'Jeunes', 'www.FinalFantasy.fr', 1, 1),
(5, 'ouarzazat', 'Tout Public', '', 1, 1),
(6, 'Z', 'Tout Public', '', 0, 0);

-- --------------------------------------------------------

--
-- Structure de la table `avoirlieu`
--

DROP TABLE IF EXISTS `avoirlieu`;
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
-- Déchargement des données de la table `avoirlieu`
--

INSERT INTO `avoirlieu` (`DATEDEBUT`, `NOACTION`, `TitreAction`, `NOLIEU`, `DATEFIN`, `Description`) VALUES
('2019-01-01 10:00:00', 5, 'ouarzazat', 9, '2019-12-31 00:00:00', 'OUARZAZAAAAAAAAAAT !!!!'),
('2019-01-01 10:00:00', 6, 'Z', 9, '2019-01-31 00:00:00', 'Z'),
('2019-01-01 10:30:00', 4, 'Chocobo', 9, '2019-01-01 12:00:00', 'Elevage de Chocobos dans le monde fantastique de Final Fantasy'),
('2019-01-24 14:00:00', 3, 'Babel Danse', 9, '2019-01-24 16:00:00', 'Johnny B Goode'),
('2019-01-30 20:00:00', 3, 'Babel Danse ', 9, '2020-02-26 23:00:00', 'Cette 15ème édition met à l’honneur les danses bien sûr, mais aussi la musique, les arts populaires, la réalité et l’imaginaire polynésiens. Avec les turbulentes participations des troupes Moemoe A (Rospez), Ata Nui (Paris), Heivanui (Lanester), Le Souffle Maohi (Meucon), les tatoueurs Tam’s Tatau (Quimper), le sculpteur Gaëtan Pichaud (Nantes) et la peintre Nataly Jolibois (Planguenoual).\r\n\r\n \r\n\r\nL’Utua Faré (chez moi) figure une place de village au coeur de la MJC, avec ses stands, son coin-lecture, ses mini-expos... Chaque après-midi de 14h à 18h, venez y rencontrer artistes et artisans ou musarder entre deux animations informelles : à la mode polynésienne, attendez-vous à vous faire happer par une visite d’expo, une démonstration de haka ou une dégustation de crêpes-banane ! Entrée libre et gratuite.');

-- --------------------------------------------------------

--
-- Structure de la table `commenteracteur`
--

DROP TABLE IF EXISTS `commenteracteur`;
CREATE TABLE IF NOT EXISTS `commenteracteur` (
  `NOACTEUR` int(4) NOT NULL,
  `NOACTION` int(4) NOT NULL,
  `DATEHEURE` datetime NOT NULL,
  `COMMENTAIRE` varchar(10000) DEFAULT NULL,
  `noCommentaireActeur` bigint(20) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`noCommentaireActeur`),
  KEY `I_FK_COMMENTERACTEUR_ACTEUR` (`NOACTEUR`),
  KEY `I_FK_COMMENTERACTEUR_ACTION` (`NOACTION`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `commenteracteur`
--

INSERT INTO `commenteracteur` (`NOACTEUR`, `NOACTION`, `DATEHEURE`, `COMMENTAIRE`, `noCommentaireActeur`) VALUES
(1, 4, '2019-01-28 10:30:00', 'Coucou', 1),
(4, 4, '2019-02-08 16:52:00', 'Choooooocoooooboooooooooooooooooooooooooooo !!!!', 2),
(4, 4, '2019-02-08 16:56:40', 'Bob 2', 3),
(4, 5, '2019-01-28 12:00:00', 'Oh mon dieu !!! ', 4),
(5, 4, '2019-01-28 10:30:00', 'Encore !!! ', 5),
(12, 4, '2019-01-28 14:30:00', 'Votre commentaire sur les chocobos est inadmissible !!!', 6),
(12, 4, '2019-02-13 11:50:00', 'Pauvres Chocobos ', 7),
(4, 4, '2019-02-08 16:45:00', 'Bob est un Chocobo ', 8),
(4, 4, '2019-02-13 16:44:24', 'plop 2', 9);

-- --------------------------------------------------------

--
-- Structure de la table `commentervisiteur`
--

DROP TABLE IF EXISTS `commentervisiteur`;
CREATE TABLE IF NOT EXISTS `commentervisiteur` (
  `DATEHEURE` datetime NOT NULL,
  `NOACTION` int(4) NOT NULL,
  `NOVISITEUR` int(11) NOT NULL,
  `COMMENTAIRE` varchar(10000) DEFAULT NULL,
  `noCommentaireVisiteur` bigint(20) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`noCommentaireVisiteur`),
  KEY `I_FK_COMMENTERVISITEUR_ACTION` (`NOACTION`),
  KEY `novisiteur` (`NOVISITEUR`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `commentervisiteur`
--

INSERT INTO `commentervisiteur` (`DATEHEURE`, `NOACTION`, `NOVISITEUR`, `COMMENTAIRE`, `noCommentaireVisiteur`) VALUES
('2019-01-28 10:30:00', 4, 2, 'Hey je veux plein de chocobos !', 1),
('2019-01-28 12:00:00', 4, 1, 'Mais c\'est pas des canards !!! ><', 2),
('2019-02-08 16:51:00', 4, 2, 'Bob', 3),
('2019-02-08 16:52:00', 4, 2, 'plop', 4),
('2019-02-11 17:01:24', 4, 2, 'Coucou', 5),
('2019-02-12 10:15:02', 4, 2, 'hey', 6);

-- --------------------------------------------------------

--
-- Structure de la table `encoursinscription`
--

DROP TABLE IF EXISTS `encoursinscription`;
CREATE TABLE IF NOT EXISTS `encoursinscription` (
  `Code` varchar(15) NOT NULL,
  `mail` varchar(64) NOT NULL,
  `DateJour` datetime NOT NULL,
  PRIMARY KEY (`Code`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `encoursinscription`
--

INSERT INTO `encoursinscription` (`Code`, `mail`, `DateJour`) VALUES
('jwcClCRYLMWvzCb', 'secretariat.mjcduplateau@gmail.com', '2019-02-01 14:02:48'),
('RTjCLrR6JzKyepd', 'jade.voyer@laposte.net', '2019-01-21 14:22:28'),
('XkSTiqaYRIXE2lq', 'jade.pink22@hotmail.fr', '2019-01-21 14:06:31');

-- --------------------------------------------------------

--
-- Structure de la table `etrepartenaire`
--

DROP TABLE IF EXISTS `etrepartenaire`;
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
-- Déchargement des données de la table `etrepartenaire`
--

INSERT INTO `etrepartenaire` (`NOACTION`, `NOACTEUR`, `NOROLE`, `DATEDEBUT`, `DATEFIN`) VALUES
(3, 4, 0, '2019-01-24 14:00:00', '2019-01-24 16:00:00'),
(4, 4, 0, '2019-01-28 10:30:00', '2019-01-28 12:00:00'),
(4, 6, 3, '2019-01-01 10:30:00', '2019-01-01 12:00:00'),
(5, 6, 0, '2019-01-01 10:00:00', '2019-12-31 00:00:00'),
(6, 4, 0, '2019-01-01 10:00:00', '2019-01-31 00:00:00');

-- --------------------------------------------------------

--
-- Structure de la table `etresignalee`
--

DROP TABLE IF EXISTS `etresignalee`;
CREATE TABLE IF NOT EXISTS `etresignalee` (
  `noAction` int(11) NOT NULL,
  `noSignalement` int(11) NOT NULL,
  `commentaire` varchar(500) DEFAULT NULL,
  `DateSignalement` datetime NOT NULL,
  PRIMARY KEY (`noAction`,`noSignalement`,`DateSignalement`),
  KEY `noSignalementKey` (`noSignalement`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `etresignalee`
--

INSERT INTO `etresignalee` (`noAction`, `noSignalement`, `commentaire`, `DateSignalement`) VALUES
(4, 2, '789', '2019-02-13 16:49:05'),
(4, 6, 'oplop', '2019-02-12 09:29:10'),
(4, 6, '', '2019-02-12 09:32:25'),
(13, 2, NULL, '2019-02-09 12:00:00'),
(14, 2, NULL, '2019-02-10 09:00:00'),
(14, 4, NULL, '2019-02-09 19:00:00'),
(14, 5, NULL, '2019-02-10 16:00:00'),
(15, 3, NULL, '2019-02-11 10:00:00');

-- --------------------------------------------------------

--
-- Structure de la table `etretagge`
--

DROP TABLE IF EXISTS `etretagge`;
CREATE TABLE IF NOT EXISTS `etretagge` (
  `noAction` int(11) NOT NULL,
  `MotCle` varchar(64) NOT NULL,
  PRIMARY KEY (`noAction`,`MotCle`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `etretagge`
--

INSERT INTO `etretagge` (`noAction`, `MotCle`) VALUES
(4, '#Fantastique'),
(4, '#FinalFantasy');

-- --------------------------------------------------------

--
-- Structure de la table `fairereference`
--

DROP TABLE IF EXISTS `fairereference`;
CREATE TABLE IF NOT EXISTS `fairereference` (
  `NOTHEMATIQUE` int(4) NOT NULL,
  `NOACTION` int(4) NOT NULL,
  PRIMARY KEY (`NOTHEMATIQUE`,`NOACTION`),
  KEY `I_FK_FAIREREFERENCE_THEMATIQUE` (`NOTHEMATIQUE`),
  KEY `I_FK_FAIREREFERENCE_ACTION` (`NOACTION`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `imbriquer`
--

DROP TABLE IF EXISTS `imbriquer`;
CREATE TABLE IF NOT EXISTS `imbriquer` (
  `NOZONE` int(4) NOT NULL,
  `NOSOUSZONE` int(4) NOT NULL,
  PRIMARY KEY (`NOZONE`,`NOSOUSZONE`),
  KEY `I_FK_IMBRIQUER_ZONE` (`NOZONE`),
  KEY `I_FK_IMBRIQUER_ZONE1` (`NOSOUSZONE`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `lieu`
--

DROP TABLE IF EXISTS `lieu`;
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
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `lieu`
--

INSERT INTO `lieu` (`NOLIEU`, `ADRESSE`, `NOMLIEU`, `LONGITUDE`, `LATITUDE`, `ALTITUDE`, `CodePostal`, `Ville`) VALUES
(1, '1 Avenue Antoine Mazier', 'MJC du Plateau', '-2.741343', '48.514356', NULL, 22000, 'Saint-Brieuc'),
(2, '1 Rue Mathurin Méheut', 'Centre social du Plateau', '-2.740166', '48.514980', NULL, 22000, 'Saint-Brieuc'),
(4, '44 Rue du 71E Régiment d\'Infanterie', NULL, NULL, NULL, NULL, 22000, 'Saint Brieuc'),
(5, '1 rue Jules Vernes', NULL, NULL, NULL, NULL, 44190, 'Clisson'),
(6, '22 rue Madame Lagarde', NULL, NULL, NULL, NULL, 56500, 'Vannes'),
(7, '25 rue Abbe Garnier', NULL, NULL, NULL, NULL, 22000, 'Saint-Brieuc'),
(8, '10 route de Moncontour', NULL, NULL, NULL, NULL, 22120, 'Quessoy'),
(9, '4 Rue des plaines', NULL, NULL, NULL, NULL, 22000, 'Saint Brieuc');

-- --------------------------------------------------------

--
-- Structure de la table `organisation`
--

DROP TABLE IF EXISTS `organisation`;
CREATE TABLE IF NOT EXISTS `organisation` (
  `NO_ORGANISATION` int(4) NOT NULL AUTO_INCREMENT,
  `NOLIEU` int(4) NOT NULL,
  `NOMORGANISATION` varchar(64) DEFAULT NULL,
  `NOTELORGA` varchar(10) DEFAULT NULL,
  `NOFAXORGA` varchar(10) DEFAULT NULL,
  `SITEURL` varchar(552) DEFAULT NULL,
  PRIMARY KEY (`NO_ORGANISATION`),
  KEY `I_FK_ORGANISATION_LIEU` (`NOLIEU`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `organisation`
--

INSERT INTO `organisation` (`NO_ORGANISATION`, `NOLIEU`, `NOMORGANISATION`, `NOTELORGA`, `NOFAXORGA`, `SITEURL`) VALUES
(1, 1, 'MJC du Plateau', '0296735515', '123', 'www.bob.fr'),
(2, 2, 'Centre social du Plateau', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `posseder`
--

DROP TABLE IF EXISTS `posseder`;
CREATE TABLE IF NOT EXISTS `posseder` (
  `NO_ORGANISATION` int(4) NOT NULL,
  `NOSECTEUR` int(4) NOT NULL,
  PRIMARY KEY (`NO_ORGANISATION`,`NOSECTEUR`),
  KEY `I_FK_POSSEDER_ORGANISATION` (`NO_ORGANISATION`),
  KEY `I_FK_POSSEDER_SECTEUR` (`NOSECTEUR`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `posseder`
--

INSERT INTO `posseder` (`NO_ORGANISATION`, `NOSECTEUR`) VALUES
(1, 1),
(1, 2),
(1, 3),
(1, 4);

-- --------------------------------------------------------

--
-- Structure de la table `profil`
--

DROP TABLE IF EXISTS `profil`;
CREATE TABLE IF NOT EXISTS `profil` (
  `NOPROFIL` int(4) NOT NULL AUTO_INCREMENT,
  `NOMPROFIL` varchar(64) DEFAULT NULL,
  PRIMARY KEY (`NOPROFIL`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `profil`
--

INSERT INTO `profil` (`NOPROFIL`, `NOMPROFIL`) VALUES
(1, 'Acteur'),
(2, 'Collaborateur'),
(3, 'Responsable'),
(4, 'AdminValider'),
(5, 'SuperAdmin'),
(6, 'Visiteur');

-- --------------------------------------------------------

--
-- Structure de la table `profilpouraction`
--

DROP TABLE IF EXISTS `profilpouraction`;
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
-- Déchargement des données de la table `profilpouraction`
--

INSERT INTO `profilpouraction` (`NOACTEUR`, `NOACTION`, `DATEDEBUT`, `NOPROFIL`, `DATEFIN`) VALUES
(4, 3, '2019-01-24 14:00:00', 3, '2019-01-24 16:00:00'),
(4, 3, '2019-01-30 20:00:00', 3, '2020-02-26 23:00:00'),
(4, 4, '2019-01-28 10:30:00', 3, '2019-01-28 12:00:00'),
(4, 6, '2019-01-01 10:00:00', 3, '2019-01-31 00:00:00'),
(6, 5, '2019-01-01 10:00:00', 3, '2019-12-31 00:00:00');

-- --------------------------------------------------------

--
-- Structure de la table `questionsecrete`
--

DROP TABLE IF EXISTS `questionsecrete`;
CREATE TABLE IF NOT EXISTS `questionsecrete` (
  `noQuestion` int(3) NOT NULL AUTO_INCREMENT,
  `nomQuestion` varchar(256) NOT NULL,
  PRIMARY KEY (`noQuestion`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `questionsecrete`
--

INSERT INTO `questionsecrete` (`noQuestion`, `nomQuestion`) VALUES
(1, 'Quel est le nom de votre auteur préféré ?'),
(2, 'Quel est le nom de votre chanteur préféré ?'),
(3, 'Quel est le nom de votre premier animal de compagnie ?'),
(4, 'Quel est le nom de jeune fille de votre mère ?'),
(5, 'Qui était votre héros d\'enfance ?'),
(6, 'Quel est le métier de votre grand père ?'),
(7, 'Quel était le modèle de votre premier véhicule ?'),
(8, 'Comment s\'appelait votre instituteur préféré à l\'école primaire ?'),
(9, 'Quel est le premier plat que vous avez appris à cuisiner ?'),
(10, 'Où rêvez vous de voyager ?');

-- --------------------------------------------------------

--
-- Structure de la table `role`
--

DROP TABLE IF EXISTS `role`;
CREATE TABLE IF NOT EXISTS `role` (
  `NOROLE` int(4) NOT NULL AUTO_INCREMENT,
  `NOMROLE` varchar(64) NOT NULL,
  PRIMARY KEY (`NOROLE`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `role`
--

INSERT INTO `role` (`NOROLE`, `NOMROLE`) VALUES
(0, 'Annonceur'),
(1, 'Partenaire'),
(2, 'Responsable'),
(3, 'Trésorier');

-- --------------------------------------------------------

--
-- Structure de la table `secteur`
--

DROP TABLE IF EXISTS `secteur`;
CREATE TABLE IF NOT EXISTS `secteur` (
  `NOSECTEUR` int(4) NOT NULL,
  `NOMSECTEUR` varchar(64) NOT NULL,
  PRIMARY KEY (`NOSECTEUR`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `secteur`
--

INSERT INTO `secteur` (`NOSECTEUR`, `NOMSECTEUR`) VALUES
(1, 'Direction'),
(2, 'Gestion'),
(3, 'Accueil'),
(4, 'Multimedia');

-- --------------------------------------------------------

--
-- Structure de la table `setrouver`
--

DROP TABLE IF EXISTS `setrouver`;
CREATE TABLE IF NOT EXISTS `setrouver` (
  `NOLIEU` int(4) NOT NULL,
  `NOZONE` int(4) NOT NULL,
  PRIMARY KEY (`NOLIEU`,`NOZONE`),
  KEY `I_FK_SETROUVER_LIEU` (`NOLIEU`),
  KEY `I_FK_SETROUVER_ZONE` (`NOZONE`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `signalement`
--

DROP TABLE IF EXISTS `signalement`;
CREATE TABLE IF NOT EXISTS `signalement` (
  `noSignalement` int(11) NOT NULL AUTO_INCREMENT,
  `libelleSignalement` varchar(256) NOT NULL,
  PRIMARY KEY (`noSignalement`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `signalement`
--

INSERT INTO `signalement` (`noSignalement`, `libelleSignalement`) VALUES
(0, 'Non Signalé'),
(1, 'Autre'),
(2, 'Contenu illicite, inapproprié ou choquant'),
(3, 'Contenu mensongé'),
(4, 'Harcèlement'),
(5, 'Discours incitant à la haine'),
(6, 'Vente interdite'),
(7, 'Contenu grossier');

-- --------------------------------------------------------

--
-- Structure de la table `signalementcommentaire`
--

DROP TABLE IF EXISTS `signalementcommentaire`;
CREATE TABLE IF NOT EXISTS `signalementcommentaire` (
  `noCommentaire` bigint(20) NOT NULL AUTO_INCREMENT,
  `DateSignalComm` datetime NOT NULL,
  `noSignalement` int(11) NOT NULL,
  `motifSignalement` varchar(550) DEFAULT NULL,
  PRIMARY KEY (`noCommentaire`,`DateSignalComm`,`noSignalement`),
  KEY `noSignalement` (`noSignalement`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `signalementcommentaire`
--

INSERT INTO `signalementcommentaire` (`noCommentaire`, `DateSignalComm`, `noSignalement`, `motifSignalement`) VALUES
(4, '2019-02-13 17:09:03', 7, 'the plop is soooooooo unapropriate ! '),
(4, '2019-02-13 17:12:11', 5, 'le plop est une incitation  à la haine raciale envers tout être humain');

-- --------------------------------------------------------

--
-- Structure de la table `sousthematique`
--

DROP TABLE IF EXISTS `sousthematique`;
CREATE TABLE IF NOT EXISTS `sousthematique` (
  `NOTHEMATIQUE` int(4) NOT NULL,
  `NOSOUSTHEMATIQUE` int(4) NOT NULL,
  PRIMARY KEY (`NOTHEMATIQUE`,`NOSOUSTHEMATIQUE`),
  KEY `I_FK_SOUSTHEMATIQUE_THEMATIQUE` (`NOTHEMATIQUE`),
  KEY `I_FK_SOUSTHEMATIQUE_THEMATIQUE1` (`NOSOUSTHEMATIQUE`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `sousthematique`
--

INSERT INTO `sousthematique` (`NOTHEMATIQUE`, `NOSOUSTHEMATIQUE`) VALUES
(1, 2),
(1, 3),
(1, 4),
(1, 9);

-- --------------------------------------------------------

--
-- Structure de la table `stocker`
--

DROP TABLE IF EXISTS `stocker`;
CREATE TABLE IF NOT EXISTS `stocker` (
  `NOACTION` int(4) NOT NULL,
  `DATEHEURE` datetime NOT NULL,
  `DateAction` datetime NOT NULL,
  `FICHIER` varchar(256) NOT NULL,
  PRIMARY KEY (`NOACTION`,`DATEHEURE`,`DateAction`),
  KEY `I_FK_STOCKER_ACTION` (`NOACTION`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `stocker`
--

INSERT INTO `stocker` (`NOACTION`, `DATEHEURE`, `DateAction`, `FICHIER`) VALUES
(4, '2019-01-28 10:30:00', '2019-01-28 10:30:00', '1_2018-06-22_11_36_27.jpeg'),
(4, '2019-01-28 14:00:00', '2019-01-28 10:30:00', '1_2019-01-09_14_46_32.jpeg');

-- --------------------------------------------------------

--
-- Structure de la table `thematique`
--

DROP TABLE IF EXISTS `thematique`;
CREATE TABLE IF NOT EXISTS `thematique` (
  `NOTHEMATIQUE` int(4) NOT NULL AUTO_INCREMENT,
  `NOMTHEMATIQUE` varchar(32) NOT NULL,
  PRIMARY KEY (`NOTHEMATIQUE`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `thematique`
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
-- Structure de la table `travaillerdans`
--

DROP TABLE IF EXISTS `travaillerdans`;
CREATE TABLE IF NOT EXISTS `travaillerdans` (
  `NOACTEUR` int(4) NOT NULL,
  `NO_ORGANISATION` int(4) NOT NULL,
  `NOSECTEUR` int(4) NOT NULL,
  PRIMARY KEY (`NOACTEUR`,`NO_ORGANISATION`,`NOSECTEUR`),
  KEY `I_FK_TRAVAILLERDANS_ACTEUR` (`NOACTEUR`),
  KEY `I_FK_TRAVAILLERDANS_ORGANISATION` (`NO_ORGANISATION`),
  KEY `I_FK_TRAVAILLERDANS_SECTEUR` (`NOSECTEUR`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `travaillerdans`
--

INSERT INTO `travaillerdans` (`NOACTEUR`, `NO_ORGANISATION`, `NOSECTEUR`) VALUES
(1, 2, 2),
(1, 2, 4),
(4, 1, 4),
(4, 2, 2),
(4, 2, 4),
(5, 2, 1),
(5, 2, 2),
(6, 2, 2),
(7, 2, 2);

-- --------------------------------------------------------

--
-- Structure de la table `visiteur`
--

DROP TABLE IF EXISTS `visiteur`;
CREATE TABLE IF NOT EXISTS `visiteur` (
  `noVisiteur` int(11) NOT NULL AUTO_INCREMENT,
  `pseudo` varchar(64) NOT NULL,
  `motdepasse` varchar(64) NOT NULL,
  `mail` varchar(128) NOT NULL,
  `Finaliser` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`noVisiteur`),
  UNIQUE KEY `pseudo` (`pseudo`,`mail`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `visiteur`
--

INSERT INTO `visiteur` (`noVisiteur`, `pseudo`, `motdepasse`, `mail`, `Finaliser`) VALUES
(1, 'Zakral', 'petitcoeur', 'matthieu@gmail.com', 1),
(2, 'Sadique', 'Gendarmerie22', 'jade.pink22@hotmail.fr', 1);

-- --------------------------------------------------------

--
-- Structure de la table `zone`
--

DROP TABLE IF EXISTS `zone`;
CREATE TABLE IF NOT EXISTS `zone` (
  `NOZONE` int(4) NOT NULL AUTO_INCREMENT,
  `NOMZONE` varchar(64) NOT NULL,
  `Origine` varchar(16) NOT NULL,
  `LongitudeMax` varchar(16) NOT NULL,
  `LatitudeMax` varchar(16) NOT NULL,
  `VILLE` varchar(64) NOT NULL,
  `CodePostal` int(5) DEFAULT NULL,
  PRIMARY KEY (`NOZONE`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `acteur`
--
ALTER TABLE `acteur`
  ADD CONSTRAINT `acteur_ibfk_1` FOREIGN KEY (`NOPROFIL`) REFERENCES `profil` (`NOPROFIL`);

--
-- Contraintes pour la table `avoirlieu`
--
ALTER TABLE `avoirlieu`
  ADD CONSTRAINT `avoirlieu_ibfk_1` FOREIGN KEY (`NOACTION`) REFERENCES `action` (`NOACTION`),
  ADD CONSTRAINT `avoirlieu_ibfk_2` FOREIGN KEY (`NOLIEU`) REFERENCES `lieu` (`NOLIEU`);

--
-- Contraintes pour la table `commenteracteur`
--
ALTER TABLE `commenteracteur`
  ADD CONSTRAINT `commenteracteur_ibfk_1` FOREIGN KEY (`NOACTEUR`) REFERENCES `acteur` (`NOACTEUR`),
  ADD CONSTRAINT `commenteracteur_ibfk_2` FOREIGN KEY (`NOACTION`) REFERENCES `action` (`NOACTION`);

--
-- Contraintes pour la table `commentervisiteur`
--
ALTER TABLE `commentervisiteur`
  ADD CONSTRAINT `commentervisiteur_ibfk_1` FOREIGN KEY (`NOACTION`) REFERENCES `action` (`NOACTION`),
  ADD CONSTRAINT `novisiteur` FOREIGN KEY (`NOVISITEUR`) REFERENCES `visiteur` (`noVisiteur`);

--
-- Contraintes pour la table `etrepartenaire`
--
ALTER TABLE `etrepartenaire`
  ADD CONSTRAINT `etrepartenaire_ibfk_1` FOREIGN KEY (`NOACTION`) REFERENCES `action` (`NOACTION`),
  ADD CONSTRAINT `etrepartenaire_ibfk_2` FOREIGN KEY (`NOACTEUR`) REFERENCES `acteur` (`NOACTEUR`),
  ADD CONSTRAINT `etrepartenaire_ibfk_3` FOREIGN KEY (`NOROLE`) REFERENCES `role` (`NOROLE`);

--
-- Contraintes pour la table `etretagge`
--
ALTER TABLE `etretagge`
  ADD CONSTRAINT `cstrnt_action` FOREIGN KEY (`noAction`) REFERENCES `action` (`NOACTION`);

--
-- Contraintes pour la table `fairereference`
--
ALTER TABLE `fairereference`
  ADD CONSTRAINT `fairereference_ibfk_1` FOREIGN KEY (`NOTHEMATIQUE`) REFERENCES `thematique` (`NOTHEMATIQUE`),
  ADD CONSTRAINT `fairereference_ibfk_2` FOREIGN KEY (`NOACTION`) REFERENCES `action` (`NOACTION`);

--
-- Contraintes pour la table `imbriquer`
--
ALTER TABLE `imbriquer`
  ADD CONSTRAINT `imbriquer_ibfk_1` FOREIGN KEY (`NOZONE`) REFERENCES `zone` (`NOZONE`),
  ADD CONSTRAINT `imbriquer_ibfk_2` FOREIGN KEY (`NOSOUSZONE`) REFERENCES `zone` (`NOZONE`);

--
-- Contraintes pour la table `organisation`
--
ALTER TABLE `organisation`
  ADD CONSTRAINT `organisation_ibfk_1` FOREIGN KEY (`NOLIEU`) REFERENCES `lieu` (`NOLIEU`);

--
-- Contraintes pour la table `posseder`
--
ALTER TABLE `posseder`
  ADD CONSTRAINT `posseder_ibfk_1` FOREIGN KEY (`NO_ORGANISATION`) REFERENCES `organisation` (`NO_ORGANISATION`),
  ADD CONSTRAINT `posseder_ibfk_2` FOREIGN KEY (`NOSECTEUR`) REFERENCES `secteur` (`NOSECTEUR`);

--
-- Contraintes pour la table `profilpouraction`
--
ALTER TABLE `profilpouraction`
  ADD CONSTRAINT `profilpouraction_ibfk_1` FOREIGN KEY (`NOACTEUR`) REFERENCES `acteur` (`NOACTEUR`),
  ADD CONSTRAINT `profilpouraction_ibfk_2` FOREIGN KEY (`NOACTION`) REFERENCES `action` (`NOACTION`),
  ADD CONSTRAINT `profilpouraction_ibfk_3` FOREIGN KEY (`NOPROFIL`) REFERENCES `profil` (`NOPROFIL`);

--
-- Contraintes pour la table `setrouver`
--
ALTER TABLE `setrouver`
  ADD CONSTRAINT `setrouver_ibfk_1` FOREIGN KEY (`NOLIEU`) REFERENCES `lieu` (`NOLIEU`),
  ADD CONSTRAINT `setrouver_ibfk_2` FOREIGN KEY (`NOZONE`) REFERENCES `zone` (`NOZONE`);

--
-- Contraintes pour la table `signalementcommentaire`
--
ALTER TABLE `signalementcommentaire`
  ADD CONSTRAINT `ibk_signalementPourCommentaire` FOREIGN KEY (`noSignalement`) REFERENCES `signalement` (`noSignalement`);

--
-- Contraintes pour la table `sousthematique`
--
ALTER TABLE `sousthematique`
  ADD CONSTRAINT `sousthematique_ibfk_1` FOREIGN KEY (`NOTHEMATIQUE`) REFERENCES `thematique` (`NOTHEMATIQUE`),
  ADD CONSTRAINT `sousthematique_ibfk_2` FOREIGN KEY (`NOSOUSTHEMATIQUE`) REFERENCES `thematique` (`NOTHEMATIQUE`);

--
-- Contraintes pour la table `stocker`
--
ALTER TABLE `stocker`
  ADD CONSTRAINT `stocker_ibfk_1` FOREIGN KEY (`NOACTION`) REFERENCES `action` (`NOACTION`);

--
-- Contraintes pour la table `travaillerdans`
--
ALTER TABLE `travaillerdans`
  ADD CONSTRAINT `travaillerdans_ibfk_1` FOREIGN KEY (`NOACTEUR`) REFERENCES `acteur` (`NOACTEUR`),
  ADD CONSTRAINT `travaillerdans_ibfk_2` FOREIGN KEY (`NO_ORGANISATION`) REFERENCES `organisation` (`NO_ORGANISATION`),
  ADD CONSTRAINT `travaillerdans_ibfk_3` FOREIGN KEY (`NOSECTEUR`) REFERENCES `secteur` (`NOSECTEUR`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
