-- phpMyAdmin SQL Dump
-- version 4.6.6
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Aug 08, 2017 at 08:35 PM
-- Server version: 5.6.35
-- PHP Version: 7.0.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `mywallet`
--

-- --------------------------------------------------------

--
-- Table structure for table `categorie`
--

CREATE TABLE `categorie` (
  `id` int(11) NOT NULL,
  `categoria` varchar(255) DEFAULT NULL,
  `tag` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `categorie`
--

INSERT INTO `categorie` (`id`, `categoria`, `tag`) VALUES
(40, 'casa', 'casa'),
(41, 'lavoro', 'lavoro'),
(43, 'varie', 'varie'),
(46, 'gnuza', 'gnuza');

-- --------------------------------------------------------

--
-- Table structure for table `costi`
--

CREATE TABLE `costi` (
  `id` int(11) NOT NULL,
  `costo` int(11) DEFAULT NULL,
  `descrizione` text,
  `idcategoria` int(11) DEFAULT NULL,
  `tempo` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `costi`
--

INSERT INTO `costi` (`id`, `costo`, `descrizione`, `idcategoria`, `tempo`) VALUES
(81, 3500, 'computer', 41, '2017-08-07'),
(82, 120, 'aspirapolvere', 42, '2017-08-07'),
(83, 50, 'sedia', 40, '2017-08-07'),
(84, 300, 'scarpe', 43, '2017-08-07'),
(85, 10, 'colazione', 41, '2017-08-07'),
(87, 500, 'borsa', 42, '2017-08-07'),
(88, 200, 'camadonna', 41, '2017-08-08'),
(89, 100, 'codio', 40, '2017-08-08');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categorie`
--
ALTER TABLE `categorie`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `costi`
--
ALTER TABLE `costi`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categorie`
--
ALTER TABLE `categorie`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;
--
-- AUTO_INCREMENT for table `costi`
--
ALTER TABLE `costi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=90;