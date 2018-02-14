-- phpMyAdmin SQL Dump
-- version 4.7.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Feb 13, 2018 at 08:07 PM
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
  `body` text NOT NULL,
  `image` text NOT NULL,
  `url` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `compendium`
--

INSERT INTO `compendium` (`id`, `title`, `type`, `body`, `image`, `url`) VALUES
(1, 'ForgeForge', 'faction', 'Created in worship of a great Giant of old, ForgeForge is a group primarily focused on fantastic craftsmanship in weapons and armor.  While ForgeForge  members will sell many of their wares for coin, it is much more common for the most exquisitely done pieces to be traded among members, or gifted in an ultimate sign of respect and gratitude.\r\n\r\nThey\'re a very well respected organization that almost entirely operates above board and whose hierarchy  is based exclusively on the skill of one\'s craftsmanship. Also, here\'s the word Westfair.', '', 'forgeforge.php'),
(2, 'Westfair', 'settlement', 'Hope\'s Landing was a town of a location and style that suited much of the human settlers very well, however they sought a place to call their home. After travelling along the coast they happened upon a perfect location to set up their new home, Westfair. Westfair is a coastal town with fairly ready access to resources via the sea and the nearby Shadewood.\r\n\r\nIts location in a diverse and very wild ecosystem made it the primary location for  The Crimson Seal , who make their headquarters in The Crimson Lodge within Westfair. The Lodge provides much of the identity of the town, as much of the economy in the town revolves around the hunt and its side businesses.', '', 'westfair.php'),
(5, 'The Junction', 'settlement', 'The Junction barely constitutes a settlement. Serving as the middle point between Hope\'s Landing, Selnora, Kirnheim, and Westfair, it was created as a neutral ground at which the various communities can gather for discussions and important meetings. \r\n\r\nThe town consists of only three main parts. There is the Inn, literally just called The Junction Hotel. With limited space available, The Junction Hotel is often prohibitively expensive for most visitors and only plays host to the most wealthy nobles and highly regarded diplomats. Other than that, there is \"The Court\", a circular outdoor arena in the middle of town where major meetings take place. The Court is overseen by an elderly Halfling named Zigmi Rumblestride, known simply as \"The Scribe\". Finally, for anyone who doesn\'t stay at the inn, there\'s a small tent-city that encircles most of the area. With the lack of shops and markets in the town, the tent city becomes a bustling flurry of impromptu trade.\r\n\r\n\r\nThe Junction is where most large-scale agreements between the people of the region are negotiated and decided. There is no approved format or voting. Either all sides come to an agreement, or they don\'t. On rare occasion The Court is also used to try criminals, although this is rare and reserved only for instances where multiple settlements have a vested interest in the outcome.', '', ''),
(6, 'Flintspark', 'settlement', 'A much older city than it looks, Flintspark is a bastion of magic, technology, and science. Experimentation and invention are highly prized in this community, which is what gives Flintspark a much newer feel than its actual age.\r\n\r\nLikely to be one of the first communities discovered by the Trailblazer settlers, Flintspark has accepted many gnomes from that community, as well as a few particularly gifted folks from the other races. While the permanent population of Flintspark is almost exclusively gnome, there are frequently many visitors from other lands buying, selling, sharing technology, and learning from the gnomes.\r\n\r\n\r\nThe study of the Flintspark gnomes is almost completely practical, with very little in the way of a theoretical component. As such, while there are libraries in Flintspark, the main attraction and source of knowledge comes from the Blackbox Lyceum. The Lyceum is an amazing place where inventors or enchanters will experiement/demonstrate (often for the first time) their creations in front of an audience of esteemed members of the community. The success of a showing at the Blackbox Lyceum can have a great impact on a gnome\'s personal standing in Flintspark, or an outsider\'s esteem within the city.', '', ''),
(7, 'Selnora', 'settlement', 'Seeking a home amongst the wilderness, the Elves departed from Hope\'s Landing for Selnora. Perfectly nestled between a large lake and The Shadewood, the Elves settled in and established a town with a very open feel to it.\r\n\r\nThe \"roads\" of Selnora are not paved. Instead, the grassland and the trees originally present in the area are interwoven into the layout of the town itself. The primary fixture of Selnora is the massive library, The Springwell Archives. When the Elves left the old world, preservation of the knowledge and history was their primary directive. The Springwell Archives contains almost all of the remaining books from the old world, and is rapidly filling up with texts and studies from the new world.\r\n\r\n\r\nBecause of the presence of the Archives, Selnora is frequented and visited often by members of both  The Twilight Helix , and to a lesser extent  The Seekers .', '', ''),
(8, 'Kirnheim', 'settlement', 'Not long after arriving in Hope\'s Landing, most dwarves began exploring outward in search of a mountain location that would better suit their culture and society. Nestled into the Shieldforge Mountains, Kirnheim provided everything they required; cooler climate, plenty of stone, and ready access to a variety of ores and resources. They went to work immediately, rapidly mining, crafting and building until Kirnheim stood as a new home for the dwarven people. Some structures are less built than simply carved into the edge of the mountains, making the city appear old despite being quite new.', '', ''),
(9, 'Hope\'s Landing', 'settlement', 'As the  The War of the Risen  waged on and most took to ships in search of a new world, Hope\'s Landing is where the first of  The Trailblazers  made land. Through various forms of communication, all vessels were notified of this new location and most made their way there. While the majority of Humans, Dwarves, and Elves left and settled elsewhere, some stayed behind along with the minor races and settled in Hope\'s Landing.\r\n\r\nDespite being technically the first of the new settlements, Hope\'s Landing is also the least developed, as it was constantly in flux and was required to house numerous ships full of people as they arrived in the new world. It is only relatively recently that the community has settled down and started to build an identity of its own as a bastion of diversity, inclusivity, and the promise of the new world. ', '', '');

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

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `compendium`
--
ALTER TABLE `compendium`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
