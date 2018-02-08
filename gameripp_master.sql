-- phpMyAdmin SQL Dump
-- version 4.7.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Feb 08, 2018 at 11:12 AM
-- Server version: 5.5.58-cll
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `gameripp_master`
--

-- --------------------------------------------------------

--
-- Table structure for table `compendium`
--

CREATE TABLE `compendium` (
  `id` int(11) NOT NULL,
  `title` text NOT NULL,
  `type` text NOT NULL,
  `body` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `npcs`
--

CREATE TABLE `npcs` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `race` text NOT NULL,
  `job` text NOT NULL,
  `faction` text NOT NULL,
  `faith` text NOT NULL,
  `location` text NOT NULL,
  `town` text NOT NULL,
  `wants` text NOT NULL,
  `fears` text NOT NULL,
  `dm_notes` text NOT NULL,
  `pc_interactions` text NOT NULL,
  `picture` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `npcs`
--

INSERT INTO `npcs` (`id`, `name`, `race`, `job`, `faction`, `faith`, `location`, `town`, `wants`, `fears`, `dm_notes`, `pc_interactions`, `picture`) VALUES
(1, 'Joy McReynolds', 'Human', 'Leader, The Seekers', 'The Seekers', 'Roros the Father', 'Mobile', 'Mobile', '', '', '', '', ''),
(2, 'Zigmi Rumblestride \"The Scribe\"', 'Halfling', '\"The Scribe\"', 'The Exchange', 'Sydona the Mother', 'The Court', 'The Junction', '', '', '', '', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `compendium`
--
ALTER TABLE `compendium`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `npcs`
--
ALTER TABLE `npcs`
  ADD KEY `id` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
