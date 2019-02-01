-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Mar 29 Janvier 2019 à 17:42
-- Version du serveur :  5.6.17
-- Version de PHP :  5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données :  `cartopus`
--

-- --------------------------------------------------------

--
-- Structure de la table `acteur`
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
-- Contenu de la table `acteur`
--

INSERT INTO `acteur` (`NOACTEUR`, `NOPROFIL`, `NOMACTEUR`, `PRENOMACTEUR`, `MOTDEPASSE`, `MAIL`, `NOTEL`, `PhotoProfil`, `noQuestion`, `Reponse`, `MailVisible`, `NoTelVisible`, `Finaliser`) VALUES
(1, 5, 'Chevalier', 'Leandre', 'goldfinger007', '1cape1slip@gmail.com', '', '4pPaR31L_1Ph20T.png', 10, 'Thailand', 0, 0, 1),
(9, 1, 'Goregues', 'Jules', 'Motdepasse', 'jules.gc22120@gmail.com', '', '9_2019-01-28_16_42_04.jpeg', 10, 'Wizafur', 1, 0, 1),
(10, 4, 'Leandre', 'Chevalier', 'Goldfinger007', 'leandre.mjcduplateau@gmail.com', '', '4pPaR31L_1Ph20T.png', 10, 'Ailleurs', 1, 0, 1);

-- --------------------------------------------------------

--
-- Structure de la table `action`
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
-- Contenu de la table `action`
--

INSERT INTO `action` (`NOACTION`, `NOMACTION`, `PublicCible`, `SiteURLAction`, `Favoris`) VALUES
(3, 'Babel danse 15ème édition Cap sur la polinésie', 'Tout Public', 'http://babeldanse.fr/', 1),
(6, 'Skyrim', 'Tout Public', 'https://elderscrolls.bethesda.net/fr/skyrim', 1),
(7, 'Reflet d''Acide', 'Tout Public', 'http://www.refletsdacide.com/', 1),
(8, 'La IIIème Légion', 'Tout Public', 'https://wiki.netophonix.com/La_III%C3%A8me_L%C3%A9gion', 1);

-- --------------------------------------------------------

--
-- Structure de la table `avoirlieu`
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
-- Contenu de la table `avoirlieu`
--

INSERT INTO `avoirlieu` (`DATEDEBUT`, `NOACTION`, `TitreAction`, `NOLIEU`, `DATEFIN`, `Description`) VALUES
('2019-01-01 09:00:00', 6, 'Skyrim', 1, '2019-12-31 18:00:00', 'Lauréat de plus de 200 prix de "Jeu de l''année", le jeu de fantasy épique créé par Bethesda Game Studios The Elder Scrolls IV: Skyrim arrive sur Nintendo Switch. Jouez désormais où bon vous semble à l''aventure en monde ouvert légendaire dans laquelle vous pouvez aller où vous voulez et faire ce que vous voulez : chez vous sur votre télé ou en déplacement. The Elder Scrolls V: Skyrim pour Nintendo Switch inclut de nouvelles fonctionnalités de gameplay telles que la reconnaissance des mouvements pour les combats et le crochetage, des tenues et de l''équipement issu de The Legend of Zelda et des butins supplémentaires débloqués à partir d''Amiibos The Legend of Zelda compatibles. Éliminez vos ennemis avec l''Épée de Légende, protégez-vous à l''aide de votre bouclier d''Hylia ou adoptez l''allure d''un héros avec la tunique du champion. Skyrim inclut également toutes les extensions officielles – Dawnguard, Hearthfire et Dragonborn.'),
('2019-01-01 09:00:01', 6, 'Skyrim VR', 1, '2019-12-31 18:00:00', 'Les développeurs primés de Bethesda Game Studios proposent en version RV un jeu complet en monde ouvert. Skyrim VR réinvente le chef d''œuvre de l''épopée fantastique avec une envergure, une profondeur et une immersion inégalées. Combats contre des dragons, exploration de montagnes escarpées... Skyrim VR donne vie à un monde ouvert complet à découvrir comme bon vous semble. Skyrim VR inclut le jeu de base salué par la critique et toutes ses extensions officielles : Dawnguard, Hearthfire et Dragonborn.'),
('2019-01-01 10:00:00', 7, 'Reflet d''Acide', 8, '2019-12-31 18:00:00', 'C’est une sorte de parodie rôlistico-médiévalo-fantastique… Je suis bien conscient que cette définition ne pourra laisser dans votre esprit qu’un léger flou (peu artistique, hélas !) : en fait, c’est une aventure qui a commencé en 2002 et qui a pour thème un jeu de rôle médiéval-fantastique, et notamment, le nôtre : « Reflets d’Acier » ! En sachant cela, on sent bien poindre soudain le spectre du « private joke » et… c’était bel et bien le cas au départ ! Tout cela ne devait rester qu’entre potes ! Et pourtant… Voici la triste histoire, Mesdames, Messieurs, de la mise en ligne de cette saga mp3sique sur le Net…'),
('2019-01-01 10:00:01', 6, 'Skyrim - Blades', 1, '2019-12-31 18:00:00', 'Tout droit sorti des studios de Bethesda Game Studios, maintes fois récompensés pour Skyrim, découvrez The Elder Scrolls: Blades - un impressionnant jeu de rôle à la première personne sur mobile.'),
('2019-03-06 09:30:00', 3, 'Babel danse 15ème édition Cap sur la polinésie', 1, '2019-03-09 00:00:00', 'Cette 15ème édition met à l’honneur les danses bien sûr, mais aussi la musique, les arts populaires, la réalité et l’imaginaire polynésiens. Avec les turbulentes participations des troupes Moemoe A (Rospez), Ata Nui (Paris), Heivanui (Lanester), Le Souffle Maohi (Meucon), les tatoueurs Tam’s Tatau (Quimper), le sculpteur Gaëtan Pichaud (Nantes) et la peintre Nataly Jolibois (Planguenoual).\r\n\r\n \r\n\r\nL’Utua Faré (chez moi) figure une place de village au coeur de la MJC, avec ses stands, son coin-lecture, ses mini-expos... Chaque après-midi de 14h à 18h, venez y rencontrer artistes et artisans ou musarder entre deux animations informelles : à la mode polynésienne, attendez-vous à vous faire happer par une visite d’expo, une démonstration de haka ou une dégustation de crêpes-banane ! Entrée libre et gratuite.'),
('2019-03-06 14:00:01', 3, 'Cinéma Mobile - Le court-Circuit', 1, '2019-03-06 17:00:00', 'En participation avec Le Cercle.\r\nSéances toutes les 30 minutes, tout public, 1€ sur inscription.\r\n\r\n"Visage de Polynésie", projection de courts-métrages de différents styles et approches, entre modernité et imaginaire'),
('2019-03-07 14:00:01', 3, 'Utua Faré spécial mode', 1, '2019-03-07 18:00:00', 'Avec Isabelle, Elise, Moevai, les Tam''s, le groupe du Lundi du Centre Social du Plateau et les animateurs Jeunesse\r\n\r\nAnimations costumes, paréos et parures, art végétal, tatouages éphémères'),
('2019-03-12 10:00:00', 8, 'La IIIème Légion', 9, '2019-05-12 19:00:00', 'Cinquante-huit avant Jésus Christ, quelque part à la frontière de la province de Narbonaise, la IIIème Légion Romaine est envoyée, sur ordre de César, conquérir une tribu Gauloise rebelle...\r\n\r\nÉpisode 1 - La première journée au camp, partie 1 (05min03s) - La IIIeme reçoit un ordre de César : attaquer une tribu gauloise.\r\nÉpisode 1 - La première journée au camp, partie 2 (05min54s) - Une compagnie d''archères envoyée par César rejoint la IIIème.\r\nÉpisode 2 - La 2ème journée (06min04s) - La IIIeme Légion se prépare pour la bataille contre les Gaulois.\r\nÉpisode 3 - La bataille se termine (05min39s) - La bataille a commencé, on se retrouve au milieu de l''action.\r\nÉpisode 4 - Suffit d''un grain de sable (06min36s) - Raptorius fait visiter à Crétinus sa taverne favorite.\r\nÉpisode 5 - L''ordre de transfert (05min48s) - Le sénateur reçoit un message de Pompée, Delordus part en reconnaissance...\r\nÉpisode 6 - Le départ pour la Belgique (05min30s) - La légion part en direction de la Belgique.\r\nÉpisode 7 - L''arrivée en Belgique (06min50s) - Arrivée à sa destination, la IIIeme monte le camp.\r\nÉpisode 8 - La croisée des chemins (06min20s) - Labienus de la Xeme Légion vient chercher le bébé recueilli par la IIIeme.\r\nÉpisode 9 - Alea jacta est (08min26s) - César envoie trois légions à l''assaut de la IIIeme. Une grande bataille s''en suit.\r\nÉpisode 10 - L''exil (06min34s) - On apprend que la IIIeme est en fait contre César et s''en va vers la Germanie.\r\nÉpisode 11 - De nouveaux alliés (08min44s) - La IIIeme rencontre les Germains qui doivent les accueillir.\r\nÉpisode 12 - César est partout (08min24s) - Féonia se fait enlever par les soldats de la Xeme Légion.\r\nÉpisode 13 - La IIIème passe à l''attaque (07min18s) - Ayant découvert l''avant poste de la Xeme Légion, la IIIeme prépare la défense.\r\nÉpisode 14 - In Extremis (06min37s) - La bataille contre la Xeme Légion éclate.\r\nÉpisode 15 - Dans les griffes de la IIIème (06min51s) - Capturé par la IIIeme, Labienus se fait interroger.\r\nÉpisode 16 - Trahison (07min27s) - La légion retrouve Crétinus et l''historien au camp.\r\nÉpisode 17 - Le Duel (11min16s) - Après s''être échappé, Labienus vient provoquer le sénateur en duel.\r\nÉpisode 18 - Il est temps maintenant (10min16s) - La IIIeme retourne en Gaule, où ils sont mal accueillis par les gaulois.\r\nÉpisode 19 - A la racine du mal (09min20s) - Au forum de Rome, on proteste contre la IIIeme Légion et exige son retrait.\r\nÉpisode 20 - Rien ne finit vraiment (07min50s) - Arrivée à Cabillonum, la IIIeme décide d''aller au camp de César.\r\nÉpisode 21 - Tension extrême (08min07s) - César, pensant que la IIIeme complote contre lui, envoie des assassins sur elle.\r\nÉpisode 22 - Isolés (09min20s) - En plein blizzard, la IIIeme cherche Raptorius, Crétinus et Féonia.\r\nÉpisode 23 - On ne laisse personne (06min50s) - César ayant monté les Helvètes contre la IIIeme, une bataille s''engage.'),
('2019-03-12 12:00:01', 8, 'Raptorius', 9, '2019-03-15 19:00:00', 'Raptorius, comme tout le monde l''appelle finalement, commande l''ensemble de l''infanterie légionnaire de la IIIème Légion. Malgré son caractère brutal, son manque total de soumission à l''autorité, ses fréquents problèmes avec l''alcool, il est un modèle pour ses hommes comme pour ses supérieurs.');

-- --------------------------------------------------------

--
-- Structure de la table `commenteracteur`
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
-- Structure de la table `commentervisiteur`
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
-- Structure de la table `encoursinscription`
--

CREATE TABLE IF NOT EXISTS `encoursinscription` (
  `Code` varchar(15) NOT NULL,
  `mail` varchar(64) NOT NULL,
  `DateJour` datetime NOT NULL,
  PRIMARY KEY (`Code`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `encoursinscription`
--

INSERT INTO `encoursinscription` (`Code`, `mail`, `DateJour`) VALUES
('Hepw9bFAiIJ8JyW', 'leandre.mjcduplateau@gmail.com', '2019-01-25 09:59:40');

-- --------------------------------------------------------

--
-- Structure de la table `etrepartenaire`
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
-- Contenu de la table `etrepartenaire`
--

INSERT INTO `etrepartenaire` (`NOACTION`, `NOACTEUR`, `NOROLE`, `DATEDEBUT`, `DATEFIN`) VALUES
(3, 9, 2147483642, '2019-03-06 09:30:00', '2019-03-09 00:00:00'),
(6, 9, 2147483642, '2019-01-01 09:00:00', '2019-12-31 18:00:00'),
(7, 9, 2147483642, '2019-01-01 10:00:00', '2019-12-31 18:00:00'),
(8, 9, 2147483642, '2019-03-12 10:00:00', '2019-05-12 19:00:00');

-- --------------------------------------------------------

--
-- Structure de la table `fairereference`
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
-- Structure de la table `imbriquer`
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
-- Structure de la table `lieu`
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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Contenu de la table `lieu`
--

INSERT INTO `lieu` (`NOLIEU`, `ADRESSE`, `NOMLIEU`, `LONGITUDE`, `LATITUDE`, `ALTITUDE`, `CodePostal`, `Ville`) VALUES
(1, '1 Avenue Antoine Mazier', 'MJC du Plateau', '-2.741343', '48.514356', NULL, 22000, 'Saint-Brieuc'),
(2, '1 Rue Mathurin Méheut', 'Centre social du Plateau', '-2.740166', '48.514980', NULL, 22000, 'Saint-Brieuc'),
(4, '44 Rue du 71E Régiment d''Infanterie', NULL, NULL, NULL, NULL, 22000, 'Saint Brieuc'),
(5, '1 rue Jules Vernes', NULL, NULL, NULL, NULL, 44190, 'Clisson'),
(6, '22 rue Madame Lagarde', NULL, NULL, NULL, NULL, 56500, 'Vannes'),
(7, '25 rue Abbe Garnier', NULL, NULL, NULL, NULL, 22000, 'Saint-Brieuc'),
(8, '10 route de Moncontour', NULL, NULL, NULL, NULL, 22120, 'Quessoy'),
(9, 'Piazza della Repubblica ', NULL, NULL, NULL, NULL, 185, 'Roma ');

-- --------------------------------------------------------

--
-- Structure de la table `organisation`
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
-- Contenu de la table `organisation`
--

INSERT INTO `organisation` (`NO_ORGANISATION`, `NOLIEU`, `NOMORGANISATION`, `NOTELORGA`, `NOFAXORGA`, `SITEURL`) VALUES
(1, 1, 'MJC du Plateau', NULL, NULL, NULL),
(2, 2, 'Centre social du Plateau', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `posseder`
--

CREATE TABLE IF NOT EXISTS `posseder` (
  `NO_ORGANISATION` int(4) NOT NULL,
  `NOSECTEUR` int(4) NOT NULL,
  PRIMARY KEY (`NO_ORGANISATION`,`NOSECTEUR`),
  KEY `I_FK_POSSEDER_ORGANISATION` (`NO_ORGANISATION`),
  KEY `I_FK_POSSEDER_SECTEUR` (`NOSECTEUR`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `posseder`
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

CREATE TABLE IF NOT EXISTS `profil` (
  `NOPROFIL` int(4) NOT NULL AUTO_INCREMENT,
  `NOMPROFIL` varchar(64) DEFAULT NULL,
  PRIMARY KEY (`NOPROFIL`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Contenu de la table `profil`
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
-- Contenu de la table `profilpouraction`
--

INSERT INTO `profilpouraction` (`NOACTEUR`, `NOACTION`, `DATEDEBUT`, `NOPROFIL`, `DATEFIN`) VALUES
(9, 3, '2019-03-06 09:30:00', 3, '2019-03-09 00:00:00'),
(9, 6, '2019-01-01 09:00:00', 3, '2019-12-31 18:00:00'),
(9, 7, '2019-01-01 10:00:00', 3, '2019-12-31 18:00:00'),
(9, 8, '2019-03-12 10:00:00', 3, '2019-05-12 19:00:00');

-- --------------------------------------------------------

--
-- Structure de la table `questionsecrete`
--

CREATE TABLE IF NOT EXISTS `questionsecrete` (
  `noQuestion` int(3) NOT NULL AUTO_INCREMENT,
  `nomQuestion` varchar(256) NOT NULL,
  PRIMARY KEY (`noQuestion`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Contenu de la table `questionsecrete`
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
-- Structure de la table `role`
--

CREATE TABLE IF NOT EXISTS `role` (
  `NOROLE` int(4) NOT NULL AUTO_INCREMENT,
  `NOMROLE` varchar(64) NOT NULL,
  PRIMARY KEY (`NOROLE`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2147483643 ;

--
-- Contenu de la table `role`
--

INSERT INTO `role` (`NOROLE`, `NOMROLE`) VALUES
(1, 'Responsable'),
(2, 'Tresorier'),
(2147483642, 'Créateur');

-- --------------------------------------------------------

--
-- Structure de la table `secteur`
--

CREATE TABLE IF NOT EXISTS `secteur` (
  `NOSECTEUR` int(4) NOT NULL,
  `NOMSECTEUR` varchar(64) NOT NULL,
  PRIMARY KEY (`NOSECTEUR`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `secteur`
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

CREATE TABLE IF NOT EXISTS `setrouver` (
  `NOLIEU` int(4) NOT NULL,
  `NOZONE` int(4) NOT NULL,
  PRIMARY KEY (`NOLIEU`,`NOZONE`),
  KEY `I_FK_SETROUVER_LIEU` (`NOLIEU`),
  KEY `I_FK_SETROUVER_ZONE` (`NOZONE`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `sousthematique`
--

CREATE TABLE IF NOT EXISTS `sousthematique` (
  `NOTHEMATIQUE` int(4) NOT NULL,
  `NOSOUSTHEMATIQUE` int(4) NOT NULL,
  PRIMARY KEY (`NOTHEMATIQUE`,`NOSOUSTHEMATIQUE`),
  KEY `I_FK_SOUSTHEMATIQUE_THEMATIQUE` (`NOTHEMATIQUE`),
  KEY `I_FK_SOUSTHEMATIQUE_THEMATIQUE1` (`NOSOUSTHEMATIQUE`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `sousthematique`
--

INSERT INTO `sousthematique` (`NOTHEMATIQUE`, `NOSOUSTHEMATIQUE`) VALUES
(1, 2),
(1, 3),
(1, 4),
(1, 9),
(1, 14),
(7, 9);

-- --------------------------------------------------------

--
-- Structure de la table `stocker`
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
-- Structure de la table `thematique`
--

CREATE TABLE IF NOT EXISTS `thematique` (
  `NOTHEMATIQUE` int(4) NOT NULL AUTO_INCREMENT,
  `NOMTHEMATIQUE` varchar(32) NOT NULL,
  PRIMARY KEY (`NOTHEMATIQUE`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=22 ;

--
-- Contenu de la table `thematique`
--

INSERT INTO `thematique` (`NOTHEMATIQUE`, `NOMTHEMATIQUE`) VALUES
(1, 'Multimedia'),
(2, 'Informatique'),
(3, 'Photo / Video'),
(4, 'Bureautique'),
(6, 'Loisir'),
(7, 'Sport'),
(8, 'Musique'),
(9, 'Sport Collectif'),
(14, 'Silence'),
(15, 'Culture');

-- --------------------------------------------------------

--
-- Structure de la table `travaillerdans`
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
-- Structure de la table `zone`
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
-- Contraintes pour les tables exportées
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
  ADD CONSTRAINT `commentervisiteur_ibfk_1` FOREIGN KEY (`NOACTION`) REFERENCES `action` (`NOACTION`);

--
-- Contraintes pour la table `etrepartenaire`
--
ALTER TABLE `etrepartenaire`
  ADD CONSTRAINT `etrepartenaire_ibfk_1` FOREIGN KEY (`NOACTION`) REFERENCES `action` (`NOACTION`),
  ADD CONSTRAINT `etrepartenaire_ibfk_2` FOREIGN KEY (`NOACTEUR`) REFERENCES `acteur` (`NOACTEUR`),
  ADD CONSTRAINT `etrepartenaire_ibfk_3` FOREIGN KEY (`NOROLE`) REFERENCES `role` (`NOROLE`);

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

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
