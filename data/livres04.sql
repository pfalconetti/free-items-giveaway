-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- Client: localhost
-- Généré le: Lun 19 Janvier 2015 à 15:32
-- Version du serveur: 5.6.12-log
-- Version de PHP: 5.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données: `long2net`
--

-- --------------------------------------------------------

--
-- Structure de la table `livres`
--

DROP TABLE IF EXISTS `livres`;
CREATE TABLE IF NOT EXISTS `livres` (
  `id` int(4) NOT NULL AUTO_INCREMENT,
  `couverture` varchar(64) NOT NULL DEFAULT '',
  `titre` varchar(128) NOT NULL,
  `complement` varchar(256) DEFAULT NULL,
  `domaine` varchar(32) NOT NULL,
  `langue` varchar(16) NOT NULL DEFAULT 'Français',
  `auteur` varchar(128) DEFAULT 'inconnu',
  `editeur` varchar(32) DEFAULT 'inconnu',
  `annee` varchar(4) DEFAULT NULL,
  `support` varchar(16) DEFAULT NULL,
  `hauteur` decimal(3,1) NOT NULL,
  `largeur` decimal(3,1) NOT NULL,
  `epaisseur` decimal(3,1) NOT NULL,
  `prix` decimal(4,2) DEFAULT NULL,
  `dispo` varchar(10) NOT NULL DEFAULT 'disponible',
  PRIMARY KEY (`id`),
  UNIQUE KEY `couverture` (`couverture`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=38 ;

--
-- Vider la table avant d'insérer `livres`
--

TRUNCATE TABLE `livres`;
--
-- Contenu de la table `livres`
--

INSERT INTO `livres` (`id`, `couverture`, `titre`, `complement`, `domaine`, `langue`, `auteur`, `editeur`, `annee`, `support`, `hauteur`, `largeur`, `epaisseur`, `prix`, `dispo`) VALUES
(1, 'book_001', 'Java 1.4 et 5.0', 'Les Cahiers du Programmeur', 'programmation Java', 'Français', 'Emmanuel Puybaret', 'Eyrolles', '2008', 'CD', '24.0', '21.0', '2.5', '29.00', 'disponible'),
(2, 'book_002', 'JavaScript', 'Le guide du programmeur', 'programmation web', 'Français', 'Nigel McFarlane', 'Eyrolles', '1999', '', '23.0', '17.0', '2.5', '0.00', 'disponible'),
(3, 'book_003', 'Flash MX', 'Un maître de la programmation ActionScript dévoile enfin ses meilleures recettes', 'programmation web', 'Français', 'Robert Penner', 'First Interactive', '2002', '', '25.5', '17.5', '2.5', '34.90', 'disponible'),
(4, 'book_004', 'Administration des Réseaux', '', 'systèmes et réseaux', 'Français', 'Frédéric Jacquenod', 'Campus Press', '2002', '', '23.0', '19.0', '2.0', '38.00', 'disponible'),
(5, 'book_005', 'Debian GNU/Linux', 'Cahiers de l''Admin', 'systèmes et réseaux', 'Français', 'Raphaël Hertzog', 'Eyrolles', '2005', '', '24.0', '21.0', '2.0', '32.00', 'disponible'),
(6, 'book_006', 'Flash 5 et ActionScript', '', 'programmation web', 'Français', 'Nicolas Sancy', 'Eyrolles', '2001', '', '24.0', '20.0', '3.5', '37.81', 'disponible'),
(7, 'book_007', 'JavaScript', 'Le dictionnaire', 'programmation web', 'Français', 'Marcos Kreinacke, André Spallek, Christian Schlange', 'Micro Application', '2000', '', '13.5', '19.0', '3.0', '19.11', 'disponible'),
(8, 'book_008', 'PHP/MySQL avec Dreamweaver MX', '', 'programmation web', 'Français', 'Jean-Marie Defrance', 'Eyrolles', '2004', '', '15.0', '20.0', '3.0', '0.00', 'disponible'),
(9, 'book_009', 'PHP 4 et MySQL en ligne', 'L''essentiel pour concevoir un site web dynamique', 'programmation web', 'Français', 'Cyril Nocton', 'Micro Application', '2001', '', '19.0', '12.5', '2.0', '9.45', 'disponible'),
(10, 'book_010', 'Java!', '', 'programmation Java', 'Anglais', 'Tim Ritchey', 'New Riders', '1995', '', '23.0', '18.5', '2.5', '43.24', 'disponible'),
(11, 'book_011', 'Flash MX 2004 Advanced', 'Visual QuickPro Guide', 'programmation web', 'Anglais', 'Russel Chun, Joe Garraffo', 'Peachpit Press', '2004', 'CD', '23.0', '18.0', '3.0', '0.00', 'disponible'),
(12, 'book_012', '3DStudio Max 2.5', 'De l''initiation à la maîtrise', 'graphisme 3D', 'Français', 'Bernard Jolivalt', 'Campus Press – MacMillan', '1999', '', '18.5', '11.5', '2.5', '9.45', 'disponible'),
(13, 'book_013', 'Lingo', 'Démarrer et comprendre tout en pratique', 'programmation multimedia', 'Français', 'Tab Julius', 'MacMillan', '1997', '', '18.5', '14.0', '2.5', '15.09', 'disponible'),
(14, 'book_014', 'WAP', 'ePocket Book', 'programmation web', 'Français', 'Christian Germain, Jean Marc Herellier, Philippe Mérigot', 'Campus Press', '2000', '', '18.5', '11.5', '1.5', '8.99', 'disponible'),
(15, 'book_015', 'JavaScript 1.3', 'De l''initiation à la maîtrise', 'programmation web', 'Français', 'Michael Moncur', 'Campus Press – MacMillan', '1999', '', '18.5', '11.5', '3.0', '9.91', 'disponible'),
(16, 'book_016', 'Unix', 'Le grand livre', 'systèmes et réseaux', 'Français', 'Michael Wielsch', 'Micro Application', '1995', 'CD', '24.5', '17.5', '5.5', '44.97', 'disponible'),
(17, 'book_017', '3DStudio Max 2.5', 'Le MacMillan édition 1999', 'graphisme 3D', 'Français', 'Steven Elliott, Phillip Miller', 'Campus Press', '1999', 'CD', '24.0', '19.5', '6.5', '45.59', 'disponible'),
(18, 'book_018', 'XML étape par étape', 'Manuel de formation', 'programmation web', 'Français', 'Michael J. Young', 'Microsoft Press', '2001', 'CD', '23.5', '19.0', '3.0', '22.71', 'disponible'),
(19, 'book_019', 'PHP 4', 'Programmation', 'programmation web', 'Français', 'Leon Atkinson', 'Campus Press', '2000', 'CD', '23.0', '19.0', '4.5', '34.91', 'disponible'),
(20, 'book_020', 'CGI/Perl et JavaScript', 'Création de pages HTML intéractives', 'programmation web', 'Français', 'Isaac Cohen', 'Eyrolles', '1996', 'disquette', '23.0', '17.0', '2.0', '0.00', 'disponible'),
(21, 'book_021', 'WAP', 'Construire une application', 'programmation web', 'Français', 'Letourmy, Papiernik, Hélaïli, Martzel', 'Eyrolles', '2000', '', '23.0', '19.0', '2.0', '36.06', 'disponible'),
(22, 'book_022', 'ArchiCad 5.0', 'Guide de référence', 'architecture', 'Français', 'Graphisoft', 'Antal Bayer', '1996', '', '22.5', '18.5', '2.0', '0.00', 'disponible'),
(23, 'book_023', 'Director 6', 'Le guide pratique des professionnels du multimédia', 'programmation multimedia', 'Français', 'Gary Ronsenzweig', 'Vuibert', '1998', '', '24.0', '17.0', '2.5', '0.00', 'disponible'),
(24, 'book_024', 'JavaScript', 'Programmation', 'programmation web', 'Français', 'Cyrille Lecomte, Thomas Leduc', 'Eyrolles', '1996', 'CD', '23.0', '17.0', '2.0', '0.00', 'disponible'),
(25, 'book_025', 'SQL Server 7.0', 'Kit de formation', 'systèmes et réseaux', 'Français', NULL, 'Microsoft Press', '1999', 'CD', '23.5', '18.5', '5.0', '45.58', 'disponible'),
(26, 'book_026', 'Find', 'catalogue stock images', 'graphisme', 'Français', NULL, 'PhotoDisc', '2001', 'CD', '23.0', '16.5', '2.0', '0.00', 'disponible'),
(27, 'book_027', 'Accelerator', 'catalogue stock images', 'graphisme', 'Français', NULL, 'PhotoDisc', '2001', 'CD', '0.0', '16.5', '2.0', '0.00', 'disponible'),
(28, 'book_028', 'Juxtapose', 'catalogue stock images', 'graphisme', 'Français', NULL, 'PhotoDisc', '2001', 'CD', '23.0', '16.5', '2.0', '0.00', 'disponible'),
(29, 'book_029', 'Momentum', 'catalogue stock images', 'graphisme', 'Français', NULL, 'PhotoDisc', '2001', 'CD', '23.0', '16.5', '2.0', '0.00', 'disponible'),
(30, 'book_030', 'Partenaire Web n°2', 'catalogue stock images', 'graphisme', 'Français', NULL, 'Getty Images', '2002', '', '28.0', '18.5', '0.5', '0.00', 'disponible'),
(31, 'book_031', 'PhotoIndex #3', 'catalogue stock images', 'graphisme', 'Français', NULL, 'FontShop', '1999', '', '29.5', '15.0', '1.0', '3.81', 'disponible'),
(32, 'book_032', 'Partenaire Web n°1', 'catalogue stock images', 'graphisme', 'Français', NULL, 'Getty Images', '2002', '', '28.0', '18.5', '0.5', '5.00', 'disponible'),
(33, 'book_033', 'Photodisc', 'catalogue stock images', 'graphisme', 'Français', NULL, 'Getty Images', NULL, '', '28.0', '18.5', '0.5', '0.00', 'disponible'),
(34, 'book_034', 'Fusion', 'catalogue stock images', 'graphisme', 'Français', NULL, 'FontShop', NULL, '', '30.0', '23.0', '2.0', '0.00', 'disponible'),
(35, 'book_035', 'Vie', 'catalogue stock images', 'graphisme', 'Français', NULL, 'Getty Images', NULL, 'CD', '30.0', '23.0', '2.0', '0.00', 'disponible'),
(36, 'book_036', 'Section', 'catalogue stock images', 'graphisme', 'Français', NULL, 'PhotoDisc', NULL, 'CD', '28.0', '21.5', '1.5', '0.00', 'disponible'),
(37, 'book_037', 'Photodisc', 'catalogue stock images', 'graphisme', 'Français', NULL, 'PhotoDisc', NULL, 'CD', '28.0', '21.5', '2.0', '0.00', 'disponible');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
