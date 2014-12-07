-- phpMyAdmin SQL Dump
-- version 4.1.8
-- http://www.phpmyadmin.net
--
-- Client :  localhost:8889
-- Généré le :  Dim 07 Décembre 2014 à 16:55
-- Version du serveur :  5.5.34
-- Version de PHP :  5.5.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Base de données :  `MDeditor`
--

-- --------------------------------------------------------

--
-- Structure de la table `mdeditor_membres`
--

CREATE TABLE `mdeditor_membres` (
  `membre_id` int(11) NOT NULL AUTO_INCREMENT,
  `membre_pseudo` varchar(30) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `membre_mot_de_passe` varchar(32) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `membre_email` varchar(250) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `membre_phone` varchar(30) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `membre_siteweb` varchar(100) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `membre_picture` varchar(100) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `membre_ville` varchar(100) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `membre_inscrit` int(11) NOT NULL,
  PRIMARY KEY (`membre_id`),
  UNIQUE KEY `membre_id` (`membre_id`),
  UNIQUE KEY `membre_pseudo` (`membre_pseudo`),
  UNIQUE KEY `membre_pseudo_2` (`membre_pseudo`),
  UNIQUE KEY `membre_mot_de_passe` (`membre_mot_de_passe`),
  UNIQUE KEY `membre_mot_de_passe_2` (`membre_mot_de_passe`),
  UNIQUE KEY `membre_mot_de_passe_3` (`membre_mot_de_passe`),
  UNIQUE KEY `membre_mot_de_passe_4` (`membre_mot_de_passe`),
  UNIQUE KEY `membre_mot_de_passe_5` (`membre_mot_de_passe`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;
