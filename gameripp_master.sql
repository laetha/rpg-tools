-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 09, 2018 at 05:33 PM
-- Server version: 10.1.30-MariaDB
-- PHP Version: 7.2.1

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
  `body` text NOT NULL,
  `image` text NOT NULL,
  `url` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `compendium`
--

INSERT INTO `compendium` (`id`, `title`, `type`, `body`, `image`, `url`) VALUES
(0, 'ForgeForge', 'faction', 'Created in worship of a great Giant of old, ForgeForge is a group primarily focused on fantastic craftsmanship in weapons and armor.  While ForgeForge  members will sell many of their wares for coin, it is much more common for the most exquisitely done pieces to be traded among members, or gifted in an ultimate sign of respect and gratitude.\r\n\r\nThey\'re a very well respected organization that almost entirely operates above board and whose hierarchy  is based exclusively on the skill of one\'s craftsmanship. Also, here\'s the word Westfair.', '', 'forgeforge.php'),
(1, 'Westfair', 'settlement', 'Hope\'s Landing was a town of a location and style that suited much of the human settlers very well, however they sought a place to call their home. After travelling along the coast they happened upon a perfect location to set up their new home, Westfair. Westfair is a coastal town with fairly ready access to resources via the sea and the nearby Shadewood.\r\n\r\nIts location in a diverse and very wild ecosystem made it the primary location for  The Crimson Seal , who make their headquarters in The Crimson Lodge within Westfair. The Lodge provides much of the identity of the town, as much of the economy in the town revolves around the hunt and its side businesses.', '', 'westfair.php');

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
