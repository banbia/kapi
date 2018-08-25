-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Aug 25, 2018 at 08:56 AM
-- Server version: 10.1.26-MariaDB
-- PHP Version: 7.1.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kapi`
--

-- --------------------------------------------------------

--
-- Table structure for table `Clients`
--

CREATE TABLE `Clients` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `username` varchar(500) NOT NULL,
  `password` varchar(500) NOT NULL,
  `genre` varchar(2) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `prenom` varchar(255) NOT NULL,
  `date_naissance` date NOT NULL,
  `comp_adresse` varchar(500) NOT NULL,
  `code_postal` int(15) NOT NULL,
  `tel` int(15) NOT NULL,
  `ind_tel` int(11) NOT NULL,
  `mobile` int(15) NOT NULL,
  `ind_mobile` int(11) NOT NULL,
  `date_creation` datetime NOT NULL,
  `longitude` float NOT NULL,
  `latitude` float NOT NULL,
  `etat` int(2) NOT NULL,
  `last_update` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Historique_Log`
--

CREATE TABLE `Historique_Log` (
  `id` int(11) NOT NULL,
  `date_log` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `description` text NOT NULL,
  `table_name` varchar(255) NOT NULL,
  `action_id` int(11) NOT NULL,
  `pro_user` int(11) NOT NULL,
  `etat` int(11) NOT NULL,
  `last_update` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Historique_Log`
--

INSERT INTO `Historique_Log` (`id`, `date_log`, `description`, `table_name`, `action_id`, `pro_user`, `etat`, `last_update`) VALUES
(1, '2018-07-16 21:42:39', '1', '1', 1, 1, -1, '0000-00-00 00:00:00'),
(2, '2018-07-08 21:04:19', 'description2', 'ProUsers', 2, 1, 0, '0000-00-00 00:00:00'),
(3, '2018-07-08 21:04:19', 'description3', 'ProUsers', 2, 1, 0, '0000-00-00 00:00:00'),
(4, '2018-07-08 21:04:19', 'description4', 'ProUsers', 2, 1, 0, '0000-00-00 00:00:00'),
(5, '2018-07-08 21:04:19', 'description5', 'ProUsers', 2, 1, 0, '0000-00-00 00:00:00'),
(6, '2018-07-08 21:04:19', 'description6', 'ProUsers', 2, 1, 0, '0000-00-00 00:00:00'),
(7, '2017-07-08 21:04:19', 'description7', 'ProUsers', 2, 1, 0, '0000-00-00 00:00:00'),
(8, '2018-07-08 21:04:19', 'description8', 'ProUsers', 2, 1, 0, '0000-00-00 00:00:00'),
(9, '2018-07-08 21:04:19', '9', 'ProUsers', 2, 1, 0, '0000-00-00 00:00:00'),
(10, '2018-07-08 21:04:19', '10', 'ProUsers', 2, 1, 0, '0000-00-00 00:00:00'),
(11, '2016-07-08 21:04:19', 'desc 11', 'ProUsers', 2, 1, 0, '0000-00-00 00:00:00'),
(12, '2017-07-08 21:04:19', 'description12', 'ProUsers', 2, 1, 0, '0000-00-00 00:00:00'),
(13, '2018-07-16 21:45:50', 'Lorem ipsum sit amet dolor vet', 'ProUsers', 5, 2, 0, '0000-00-00 00:00:00'),
(14, '0000-00-00 00:00:00', 'Updated log', 'ProUsers', 3, 1, 0, '0000-00-00 00:00:00'),
(15, '2018-07-16 23:20:49', 'Updated log', 'ProUsers', 3, 1, 0, '0000-00-00 00:00:00'),
(16, '2018-07-16 23:20:50', 'Updated log', 'ProUsers', 3, 1, 0, '0000-00-00 00:00:00'),
(17, '2018-07-16 23:21:22', 'Updated log', 'ProUsers', 3, 1, 0, '0000-00-00 00:00:00'),
(18, '2018-07-16 23:21:23', 'Updated log', 'ProUsers', 3, 1, 0, '0000-00-00 00:00:00'),
(19, '2018-07-16 23:21:37', 'Updated log', 'ProUsers', 3, 1, 0, '0000-00-00 00:00:00'),
(20, '2018-07-16 23:21:37', 'Updated log', 'ProUsers', 3, 1, 0, '0000-00-00 00:00:00'),
(21, '2018-07-16 23:22:12', 'Updated log', 'ProUsers', 3, 1, 0, '2018-07-16 22:22:12');

-- --------------------------------------------------------

--
-- Table structure for table `ProUsers`
--

CREATE TABLE `ProUsers` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `code_api` varchar(500) NOT NULL,
  `username` varchar(255) NOT NULL,
  `genre` char(2) NOT NULL,
  `prenom` varchar(255) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `date_naissance` date NOT NULL,
  `comp_adresse` varchar(255) NOT NULL,
  `code_postal` int(10) NOT NULL,
  `tel` int(8) NOT NULL,
  `ind_tel` int(5) NOT NULL,
  `mobile` int(8) NOT NULL,
  `ind_mobile` int(5) NOT NULL,
  `date_creation` datetime NOT NULL,
  `longitude` float NOT NULL,
  `latitude` float NOT NULL,
  `password` varchar(500) NOT NULL,
  `etat` int(11) NOT NULL,
  `last_update` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ProUsers`
--

INSERT INTO `ProUsers` (`id`, `email`, `code_api`, `username`, `genre`, `prenom`, `nom`, `date_naissance`, `comp_adresse`, `code_postal`, `tel`, `ind_tel`, `mobile`, `ind_mobile`, `date_creation`, `longitude`, `latitude`, `password`, `etat`, `last_update`) VALUES
(1, '16test16@gmail.com', 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJoZWFkZXIiOnsiaWQiOiIxIiwidXNlciI6InRlc3QxIn0sInBheWxvYWQiOnsiaWF0IjoiMjAxOC0wNy0wNyAxMjoyNDo1MSIsImV4cCI6IjIwMTgtMDctMDcgMTQ6MjQ6NTEifX0.iQDpQ-l6imlxh3YraouaqjFZz4mV9Bh56T3s4AZODKo', 'test16', 'F', 'test16prenom', 'test16nom', '1991-05-05', 'azadazd', 1500, 98653214, 158, 600, 600, '2018-07-01 08:24:23', 14.25, 255.15, '$2y$10$19W3wMgsWBcPbSnrxRuequUUUhPNnV7lbN1UsYLGjyReMdqOXsMyW', 0, '2018-07-07 18:44:51'),
(2, 'test2@kappa.com', 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJoZWFkZXIiOnsiaWQiOiIxIiwidXNlciI6InRlc3QxIn0sInBheWxvYWQiOnsiaWF0IjoiMjAxOC0wNy0wNyAxMjoyNDo1MSIsImV4cCI6IjIwMTgtMDctMDcgMTQ6MjQ6NTEifX0.iQDpQ-l6imlxh3YraouaqjFZz4mV9Bh56T3s4AZODKo', 'test2', 'F', 'test2 Prenom', 'test2 Nom', '1987-07-01', 'adresse test 2', 2001, 98654321, 216, 0, 216, '2018-07-01 08:24:23', 16.4895, 49.985, '$2y$10$5PXPP.UAWQgz2J0DTJWGTuGYj9daC5po4mQ.GMuZjIMFucYA1ir4y', -1, '2018-07-07 10:57:29'),
(3, 'test3@gmail.com', 'not assigned', 'test3', 'H', 'test3Prenom', 'test3renom', '2018-07-17', 'azsazs', 955, 98198515, 200, 98653214, 100, '2018-07-19 12:19:23', 15.2556, 5984.59, '$2y$10$5PXPP.UAWQgz2J0DTJWGTuGYj9daC5po4mQ.GMuZjIMFucYA1ir4y', 1, '2018-07-07 11:48:23'),
(5, 'test5@gmail.com', 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJoZWFkZXIiOnsiaWQiOiI1IiwidXNlciI6InRlc3Q1In0sInBheWxvYWQiOnsiaWF0IjoiMjAxOC0wNy0wNyAyMToxNDowNSIsImV4cCI6IjIwMTgtMDctMDcgMjM6MTQ6MDUifX0.ynYWuHMXVPNqiLZZJFK54lY8smXjxS53EvNQu1Wuf-s', 'test5', 'H', 'test3Prenom', 'test3renom', '2018-07-17', 'azsazs', 955, 98198515, 200, 98653214, 100, '2018-07-19 12:19:23', 15.2556, 5984.59, '$2y$10$5PXPP.UAWQgz2J0DTJWGTuGYj9daC5po4mQ.GMuZjIMFucYA1ir4y', 1, '2018-07-07 19:14:05'),
(7, 'test6@gmail.com', 'not assigned', 'test6', 'H', 'test3Prenom', 'test3renom', '2018-07-17', 'azsazs', 955, 98198515, 200, 98653214, 100, '2018-07-19 12:19:23', 15.2556, 5984.59, '$2y$10$5PXPP.UAWQgz2J0DTJWGTuGYj9daC5po4mQ.GMuZjIMFucYA1ir4y', 1, '2018-07-07 12:48:55'),
(8, 'test9@gmail.com', 'not assigned', 'test9', 'F', 'test4prenom', 'test4nom', '1991-05-05', 'azadazd', 1500, 98653214, 200, 588, 600, '2018-07-07 14:57:32', 986.599, 547.22, '$2y$10$pQwkKX0NqGieD2JiRVYq2OVyuVDBbIcbEgno9gPNdoyaZwJa0k.V.', 1, '0000-00-00 00:00:00'),
(10, 'test11@gmail.com', 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJoZWFkZXIiOnsiaWQiOiIxMCIsInVzZXIiOiJ0ZXN0MTEifSwicGF5bG9hZCI6eyJpYXQiOiIyMDE4LTA3LTA3IDE3OjQ2OjUxIiwiZXhwIjoiMjAxOC0wNy0wNyAxOTo0Njo1MSJ9fQ.W9Qa77SGPBHfhpGGjLPgT-bd4fmlw1XurI-u2aQafwc', 'test11', 'F', 'test10prenom', 'test10nom', '1991-05-05', 'azadazd', 1500, 98653214, 200, 588, 600, '2018-07-07 17:46:50', 986.599, 547.22, '$2y$10$C4q9S.lKVhcOw3DA2tDxOOSpulJOVlTA8npDvJXekurAJSchKNDLO', 1, '2018-07-07 15:46:51'),
(11, 'test10@gmail.com', 'not assigned', 'test10', 'F', 'test10prenom', 'test10nom', '1991-05-05', 'azadazd', 1500, 98653214, 200, 588, 600, '2018-07-07 17:52:02', 986.599, 547.22, '$2y$10$T/aUHyGhfDziO9euteSrkOsdVOctBZAGX45P9Jwie/19rAzXhC5..', 1, '2018-07-07 15:52:02'),
(12, 'test12@gmail.com', 'not assigned', 'test12', 'F', 'test12prenom', 'test12nom', '1991-05-05', 'azadazd', 1500, 98653214, 200, 588, 600, '2018-07-07 17:52:20', 986.599, 547.22, '$2y$10$S/QDhLkQY9kNI1YsYxBBVuWHGU2rsZ.BzoliTUUrE0Ton1EzqlZRG', 1, '2018-07-07 15:52:20'),
(14, 'test13@gmail.com', 'not assigned', 'test13', 'F', 'test13prenom', 'test13nom', '1991-05-05', 'azadazd', 1500, 98653214, 200, 588, 600, '2018-07-07 17:52:53', 986.599, 547.22, '$2y$10$rW6cHp2FUVEDy7hzf5GmF.zoFClttM/nEgMCYH/KVBxiArCftPlj6', 1, '0000-00-00 00:00:00'),
(15, 'test4@gmail.com', 'not assigned', 'test4', 'F', 'test4prenom', 'test4nom', '1991-05-05', 'azadazd', 1500, 98653214, 200, 588, 600, '2018-07-07 17:53:41', 986.599, 547.22, '$2y$10$LjqBb0/biBd4dZOeVYKusuFHgERZpEjNV8bc4RQfUxz9To4Uxp92W', 1, '0000-00-00 00:00:00'),
(19, 'test15@gmail.com', 'not assigned', 'test15', 'F', 'test15prenom', 'test15nom', '1991-05-05', 'azadazd', 1500, 98653214, 200, 588, 600, '2018-07-07 17:55:22', 986.599, 547.22, '$2y$10$X9mVTqqseGQYHIEUkcLxaeWXhQeqf4I8hLbXGIhTQolS4mrscv1r6', 1, '0000-00-00 00:00:00'),
(31, 'test16@gmail.com', 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJoZWFkZXIiOnsiaWQiOiIzMSIsInVzZXIiOiJ0ZXN0MTYifSwicGF5bG9hZCI6eyJpYXQiOiIyMDE4LTA3LTA3IDE4OjAxOjUzIiwiZXhwIjoiMjAxOC0wNy0wNyAyMDowMTo1MyJ9fQ.FC6Dd9lIcWpPCslynHlRdQA-9cCTCshSul31piWMWSc', 'test16', 'F', 'test16prenom', 'test16nom', '1991-05-05', 'azadazd', 1500, 98653214, 200, 588, 600, '2018-07-07 18:01:53', 986.599, 547.22, '$2y$10$zMZNOcWLUr58qb7.ZOILtu6XTXGaqDmiDlMASm0Sq3QDJZO3dFh7a', 1, '2018-07-07 16:01:53');

-- --------------------------------------------------------

--
-- Table structure for table `Prouser_client`
--

CREATE TABLE `Prouser_client` (
  `id` int(11) NOT NULL,
  `pro_user` int(11) NOT NULL,
  `client` int(11) NOT NULL,
  `client_email` varchar(255) NOT NULL,
  `etat` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Clients`
--
ALTER TABLE `Clients`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `Historique_Log`
--
ALTER TABLE `Historique_Log`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ProUsers`
--
ALTER TABLE `ProUsers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_email_code_api_username` (`email`,`code_api`,`username`);

--
-- Indexes for table `Prouser_client`
--
ALTER TABLE `Prouser_client`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pro_user` (`pro_user`),
  ADD KEY `client` (`client`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `Clients`
--
ALTER TABLE `Clients`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `Historique_Log`
--
ALTER TABLE `Historique_Log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `ProUsers`
--
ALTER TABLE `ProUsers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `Prouser_client`
--
ALTER TABLE `Prouser_client`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `Prouser_client`
--
ALTER TABLE `Prouser_client`
  ADD CONSTRAINT `fk_client` FOREIGN KEY (`client`) REFERENCES `Clients` (`id`),
  ADD CONSTRAINT `fk_prouser` FOREIGN KEY (`pro_user`) REFERENCES `ProUsers` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
