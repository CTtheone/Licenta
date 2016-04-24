-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Apr 23, 2016 at 11:27 PM
-- Server version: 10.1.8-MariaDB
-- PHP Version: 5.6.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ioc`
--

-- --------------------------------------------------------

--
-- Table structure for table `cereri`
--

CREATE TABLE `cereri` (
  `id` int(11) NOT NULL,
  `artist` varchar(200) NOT NULL,
  `titlu` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cereri`
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
-- Table structure for table `melodii`
--

CREATE TABLE `melodii` (
  `id` int(11) NOT NULL,
  `artist` varchar(100) NOT NULL,
  `titlu` varchar(100) NOT NULL,
  `cale_tmp` varchar(200) DEFAULT NULL,
  `cale` varchar(200) DEFAULT NULL,
  `categorie` varchar(200) NOT NULL,
  `uploader` varchar(200) NOT NULL,
  `plus` int(11) NOT NULL,
  `minus` int(11) NOT NULL,
  `comments_path` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `melodii`
--

INSERT INTO `melodii` (`id`, `artist`, `titlu`, `cale_tmp`, `cale`, `categorie`, `uploader`, `plus`, `minus`, `comments_path`) VALUES
(1, 'Voltaj', 'Albinuta', '', 'tab_uploads/simona_Voltaj_Albinuta.txt', 'Dance', 'simona', 2, 0, 'comments/Albinuta_Voltaj_comm.txt'),
(29, 'Holograf', 'Ochii tai', NULL, 'tab_uploads/madi_Holograf_Ochii tai.txt', 'Dragoste', 'madi', 1, 0, 'comments/Holograf_Ochii tai_comm.txt'),
(30, '3rei Sud Est', 'Amintirile', NULL, 'tab_uploads/madi_3rei Sud Est_Amintirile.txt', 'Dance', 'madi', 0, 1, 'comments/3rei Sud Est_Amintirile_comm.txt'),
(31, 'Tudor Gheorghe', 'Vin colindatorii', NULL, 'tab_uploads/cosmin_Tudor Gheorghe_Vin colindatorii.txt', 'Colinde', 'cosmin', 3, 0, 'comments/Tudor Gheorghe_Vin colindatorii_comm.txt'),
(32, 'Tudor Gheorghe', 'Valsul rozelor', NULL, 'tab_uploads/cosmin_Tudor Gheorghe_Valsul rozelor.txt', 'Folclor', 'cosmin', 1, 0, 'comments/Tudor Gheorghe_Valsul rozelor_comm.txt'),
(33, 'Bosquito', 'Bosquito', NULL, 'tab_uploads/simona_Bosquito_Bosquito.txt', 'Latino', 'simona', 1, 0, 'comments/Bosquito_Bosquito_comm.txt'),
(34, 'Vama Veche', 'Epilog', NULL, 'tab_uploads/simona_Vama Veche_Epilog.txt', 'Dragoste', 'simona', 1, 1, 'comments/Vama Veche_Epilog_comm.txt');

-- --------------------------------------------------------

--
-- Table structure for table `rating`
--

CREATE TABLE `rating` (
  `username` varchar(100) NOT NULL,
  `titlu` varchar(100) NOT NULL,
  `artist` varchar(100) NOT NULL,
  `uploader` varchar(100) NOT NULL,
  `likes` int(4) NOT NULL,
  `id` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rating`
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
('madi', 'Epilog', 'Vama Veche', 'simona', 2, 58);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` text NOT NULL,
  `email` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `email`) VALUES
(12, 'cosmin', 'c296255d490b1a4889b376e08e37e51f', 'cosmintom@gmail.com'),
(13, 'madi', 'f05eabc961bc296c088b3510d6429d02', 'madalina.hristache@gmail.com'),
(14, 'simona', '3506e1dff0db4e4d78412e2feb7c0a95', 'sim@gmail.com');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cereri`
--
ALTER TABLE `cereri`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `artist` (`artist`,`titlu`);

--
-- Indexes for table `melodii`
--
ALTER TABLE `melodii`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rating`
--
ALTER TABLE `rating`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user` (`username`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cereri`
--
ALTER TABLE `cereri`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;
--
-- AUTO_INCREMENT for table `melodii`
--
ALTER TABLE `melodii`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;
--
-- AUTO_INCREMENT for table `rating`
--
ALTER TABLE `rating`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
