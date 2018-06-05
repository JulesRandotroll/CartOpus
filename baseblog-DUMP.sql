-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Client: 127.0.0.1
-- Généré le: Mar 09 Juin 2015 à 20:05
-- Version du serveur: 5.5.27-log
-- Version de PHP: 5.4.6

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données: `baseblog`
--

-- --------------------------------------------------------

--
-- Structure de la table `tabarticle`
--

CREATE TABLE IF NOT EXISTS `tabarticle` (
  `cNo` int(11) NOT NULL AUTO_INCREMENT,
  `cTitre` varchar(128) NOT NULL,
  `cTexte` text NOT NULL,
  `cNomFichierImage` varchar(128) DEFAULT NULL,
  PRIMARY KEY (`cNo`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Contenu de la table `tabarticle`
--

INSERT INTO `tabarticle` (`cNo`, `cTitre`, `cTexte`, `cNomFichierImage`) VALUES
(4, 'Mercure', 'Mercure est la planète la plus proche du Soleil et la moins massive du Système solaire1. Son éloignement au Soleil est compris entre 0,3075 et 0,4667 UA, ce qui correspond à une excentricité orbitale de 0,2056 — plus de douze fois supérieure à celle de la Terre, et de loin la plus élevée pour une planète du système solaire. Elle est visible à l''œil nu depuis la Terre avec un diamètre apparent de 4,5 à 13 secondes d''arc, et une magnitude apparente de 5,7 à -2,3 ; son observation est toutefois rendue difficile par son élongation toujours inférieure à 28,3° qui la noie le plus souvent dans l''éclat du Soleil.', 'mercure.jpg'),
(5, 'Vénus', 'La distance de Vénus au Soleil est comprise entre 0,718 et 0,728 UA, avec une période orbitale de 224,7 jours. Vénus est une planète tellurique, comme le sont également Mercure, la Terre et Mars. Elle possède un champ magnétique très faible et n''a aucun satellite naturel. Elle est, avec Uranus, l''une des deux seules planètes du Système solaire dont la rotation est rétrograde, et la seule ayant une période de rotation (243 jours) supérieure à sa période de révolution. Vénus présente en outre la particularité d''être quasiment sphérique — son aplatissement peut être considéré comme nul — et de parcourir l''orbite la plus circulaire des planètes du Système solaire, avec une excentricité orbitale de 0,0068 (contre 0,0167 pour la Terre).', 'venus.jpg'),
(6, 'La Terre', 'La Terre est une planète du Système solaire, la troisième au regard de la distance au Soleil. Il s''agit de la cinquième planète la plus grande, tant en taille qu''en masse, dans le Système solaire et la plus massive des planètes telluriques de ce système planétaire.', 'laterre.jpg'),
(7, 'Mars', 'Mars (prononcé en français : /ma?s/9) est la quatrième planète par ordre de distance croissante au Soleil et la deuxième par masse et par taille croissantes sur les huit planètes que compte le Système solaire. Son éloignement au Soleil est compris entre 1,381 et 1,666 UA (206,6 à 249,2 millions de km), avec une période orbitale de 686,71 jours terrestres.\r\nC’est une planète tellurique, comme le sont Mercure, Vénus et la Terre, environ dix fois moins massive que la Terre mais dix fois plus massive que la Lune. Sa topographie présente des analogies aussi bien avec la Lune, à travers ses cratères et ses bassins d''impact, qu''avec la Terre, avec des formations d''origine tectonique et climatique telles que des volcans, des rifts, des vallées, des mesas, des champs de dunes et des calottes polaires. La plus grande montagne du Système solaire, Olympus Mons (qui est aussi un volcan bouclier), et le plus grand canyon, Valles Marineris, se trouvent sur Mars.', 'mars.jpg'),
(8, 'Cérès', 'Cérès, officiellement désignée par (1) Cérès (désignation internationale (1) Ceres), est la plus petite planète naine reconnue du Système solaire ainsi que le plus gros astéroïde de la ceinture principale ; c''est d''ailleurs la seule planète naine située dans la ceinture d''astéroïdes. Elle fut découverte le 1er janvier 1801 par Giuseppe Piazzi et porte le nom de la déesse romaine Cérès.', 'ceres.jpg'),
(9, 'Jupiter', 'Jupiter est une planète géante gazeuse. Il s''agit de la plus grosse planète du Système solaire, plus volumineuse et massive que toutes les autres planètes réunies, et la cinquième planète par sa distance au Soleil (après Mercure, Vénus, la Terre et Mars).', 'jupiter.jpg'),
(10, 'Saturne', 'Saturne est la sixième planète du Système solaire par ordre de distance au Soleil et la deuxième après Jupiter tant par sa taille que par sa masse1,2,3.\r\nPlus lointaine des planètes du Système solaire observables à l''œil nu dans le ciel nocturne depuis la Terre4, elle est connue depuis la Préhistoire5 et correspond au Phaénon (?????? (Phaín?n)) de l''astronomie grecque, au Zohal (?????) de l''astronomie arabe ainsi qu''au T?x?ng (?? / « étoile de la terre ») de l''astronomie chinoise.', 'saturne.jpg'),
(11, 'Uranus', 'Uranus est une planète géante de glaces de type Neptune froid. Il s''agit de la 7e planète du Système solaire par sa distance au Soleil, de la 3e par la taille et de la 4e par la masse. Elle doit son nom à la divinité romaine du ciel, Uranus, père de Saturne et grand-père de Jupiter. Uranus est la première planète découverte à l’époque moderne. Bien qu''elle soit visible à l’œil nu comme les cinq planètes déjà connues, son caractère planétaire ne fut pas identifié en raison de son très faible éclat, étant à la limite de la visibilité et de son déplacement apparent très lent. William Herschel annonce sa découverte le 26 avril 1781, élargissant les frontières connues du Système solaire pour la première fois à l’époque moderne. Uranus est la première planète découverte à l’aide d’un télescope.', 'uranus.jpg'),
(12, 'Neptune', 'Neptune est la huitième et dernière planète du Système solaire par distance croissante au Soleil1.\r\nNeptune orbite autour du Soleil à une distance d''environ 30 UA avec une excentricité orbitale moitié moindre que celle de la Terre en bouclant une révolution complète en 164,79 ans. C''est la troisième planète du Système solaire par masse décroissante — elle est 17 fois plus massive que la Terre et 19 fois moins massive que Jupiter — et la quatrième par taille décroissante ; Neptune est en effet à la fois un peu plus massive et un peu plus petite qu''Uranus.', 'neptune.jpg');

-- --------------------------------------------------------

--
-- Structure de la table `tabutilisateur`
--

CREATE TABLE IF NOT EXISTS `tabutilisateur` (
  `cNo` int(11) NOT NULL AUTO_INCREMENT,
  `cIdentifiant` varchar(128) NOT NULL,
  `cMotDePasse` varchar(128) NOT NULL,
  `cStatut` int(11) NOT NULL,
  PRIMARY KEY (`cNo`),
  UNIQUE KEY `cIdentifiant` (`cIdentifiant`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Contenu de la table `tabutilisateur`
--

INSERT INTO `tabutilisateur` (`cNo`, `cIdentifiant`, `cMotDePasse`, `cStatut`) VALUES
(1, 'toto', 'admin', 1),
(2, 'lulu', 'test', 0);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
