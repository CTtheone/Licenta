-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Gazda: localhost
-- Timp de generare: 28 Apr 2016 la 15:32
-- Versiune server: 5.5.49-0ubuntu0.14.04.1
-- Versiune PHP: 5.5.9-1ubuntu4.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Bază de date: `licenta`
--

-- --------------------------------------------------------

--
-- Structura de tabel pentru tabelul `cereri`
--

CREATE TABLE IF NOT EXISTS `cereri` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `artist` varchar(200) NOT NULL,
  `titlu` varchar(200) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `artist` (`artist`,`titlu`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=30 ;

--
-- Salvarea datelor din tabel `cereri`
--

INSERT INTO `cereri` (`id`, `artist`, `titlu`) VALUES
(21, 'ABBA', 'Mamma mia'),
(29, 'Holograf', 'Fara ea'),
(18, 'Holograf', 'Ti-am dat un inel'),
(14, 'Tina', 'Pleaca'),
(17, 'Vama', 'Pe sarma'),
(28, 'Voltaj', 'Vara trtecuta');

-- --------------------------------------------------------

--
-- Structura de tabel pentru tabelul `drafts`
--

CREATE TABLE IF NOT EXISTS `drafts` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `artist` varchar(100) NOT NULL,
  `titlu` varchar(100) NOT NULL,
  `cale` varchar(200) NOT NULL,
  `uploader` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structura de tabel pentru tabelul `melodii`
--

CREATE TABLE IF NOT EXISTS `melodii` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `artist` varchar(100) NOT NULL,
  `titlu` varchar(100) NOT NULL,
  `cale_tmp` varchar(200) DEFAULT NULL,
  `cale` varchar(200) DEFAULT NULL,
  `categorie` varchar(200) NOT NULL,
  `uploader` varchar(200) NOT NULL,
  `plus` int(11) NOT NULL,
  `minus` int(11) NOT NULL,
  `comments_path` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=45 ;

--
-- Salvarea datelor din tabel `melodii`
--

INSERT INTO `melodii` (`id`, `artist`, `titlu`, `cale_tmp`, `cale`, `categorie`, `uploader`, `plus`, `minus`, `comments_path`) VALUES
(1, 'Voltaj', 'Albinuta', '', 'tab_uploads/simona_Voltaj_Albinuta.txt', 'Dance', 'simona', 2, 0, 'comments/Albinuta_Voltaj_comm.txt'),
(29, 'Holograf', 'Ochii tai', NULL, 'tab_uploads/madi_Holograf_Ochii tai.txt', 'Dragoste', 'madi', 1, 0, 'comments/Holograf_Ochii tai_comm.txt'),
(30, '3rei Sud Est', 'Amintirile', NULL, 'tab_uploads/madi_3rei Sud Est_Amintirile.txt', 'Dance', 'madi', 0, 1, 'comments/3rei Sud Est_Amintirile_comm.txt'),
(31, 'Tudor Gheorghe', 'Vin colindatorii', NULL, 'tab_uploads/cosmin_Tudor Gheorghe_Vin colindatorii.txt', 'Colinde', 'cosmin', 3, 0, 'comments/Tudor Gheorghe_Vin colindatorii_comm.txt'),
(32, 'Tudor Gheorghe', 'Valsul rozelor', NULL, 'tab_uploads/cosmin_Tudor Gheorghe_Valsul rozelor.txt', 'Folclor', 'cosmin', 1, 0, 'comments/Tudor Gheorghe_Valsul rozelor_comm.txt'),
(33, 'Bosquito', 'Bosquito', NULL, 'tab_uploads/simona_Bosquito_Bosquito.txt', 'Latino', 'simona', 1, 0, 'comments/Bosquito_Bosquito_comm.txt'),
(34, 'Vama Veche', 'Epilog', NULL, 'tab_uploads/simona_Vama Veche_Epilog.txt', 'Dragoste', 'simona', 1, 1, 'comments/Vama Veche_Epilog_comm.txt'),
(40, 'Catalina Beta', 'Gandacul', NULL, 'tab_uploads/cosmin_Catalina Beta_Gandacul.txt', 'Folk', 'cosmin', 1, 0, 'comments/Catalina Beta_Gandacul_comm.txt'),
(44, 'jkj', 'jlk', 'tmp_upload/jkj_jlk41.txt', NULL, 'Folclor', 'cosmin', 0, 0, 'comments/jkj_jlk4141_comm.txt');

-- --------------------------------------------------------

--
-- Structura de tabel pentru tabelul `rating`
--

CREATE TABLE IF NOT EXISTS `rating` (
  `username` varchar(100) NOT NULL,
  `titlu` varchar(100) NOT NULL,
  `artist` varchar(100) NOT NULL,
  `uploader` varchar(100) NOT NULL,
  `likes` int(4) NOT NULL,
  `id` int(4) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=60 ;

--
-- Salvarea datelor din tabel `rating`
--

INSERT INTO `rating` (`username`, `titlu`, `artist`, `uploader`, `likes`, `id`) VALUES
('madi', 'Albinuta', 'Voltaj', 'sim@sim', 1, 47),
('madi', 'Albinuta', 'Voltaj', 'simona', 1, 48),
('madi', 'Ochii tai', 'Holograf', 'madi', 1, 49),
('madi', 'Amintirile', '3rei Sud Est', 'madi', 2, 50),
('cosmin', 'Vin colindatorii', 'Tudor Gheorghe', 'cosmin', 1, 51),
('madi', 'Vin colindatorii', 'Tudor Gheorghe', 'cosmin', 1, 52),
('simona', 'Vin colindatorii', 'Tudor Gheorghe', 'cosmin', 1, 53),
('simona', 'Albinuta', 'Voltaj', 'simona', 1, 54),
('madi', 'Valsul rozelor', 'Tudor Gheorghe', 'cosmin', 1, 55),
('simona', 'Bosquito', 'Bosquito', 'simona', 1, 56),
('simona', 'Epilog', 'Vama Veche', 'simona', 1, 57),
('madi', 'Epilog', 'Vama Veche', 'simona', 2, 58),
('cosmin', 'Gandacul', 'Catalina Beta', 'cosmin', 1, 59);

-- --------------------------------------------------------

--
-- Structura de tabel pentru tabelul `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(30) NOT NULL,
  `password` text NOT NULL,
  `email` text NOT NULL,
  `admin` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `user` (`username`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=20 ;

--
-- Salvarea datelor din tabel `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `email`, `admin`) VALUES
(12, 'cosmin', 'c296255d490b1a4889b376e08e37e51f', 'cosmintom@gmail.com', 1),
(13, 'madi', 'f05eabc961bc296c088b3510d6429d02', 'madalina.hristache@gmail.com', NULL),
(14, 'simona', '3506e1dff0db4e4d78412e2feb7c0a95', 'sim@gmail.com', NULL),
(19, 'cristi', '9e95bf56a1e3dcb44a34ae7fc9034091', 'cosmin.tomulescu@cs.pub.ro', NULL);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
