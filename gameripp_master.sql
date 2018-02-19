-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 19, 2018 at 07:56 PM
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
-- Table structure for table `campaignlog`
--

CREATE TABLE `campaignlog` (
  `id` int(11) NOT NULL,
  `date` int(11) NOT NULL,
  `entry` text NOT NULL,
  `active` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `campaignlog`
--

INSERT INTO `campaignlog` (`id`, `date`, `entry`, `active`) VALUES
(1, 1, 'Torian got attacked alone by a Mezzoloth trying to get down to the Fane.', 0),
(2, 1, 'Party attacked a Hezrou who was left in charge by Gar Shatterkeel in the Temple of the Crushing Wave.', 1),
(3, 1, 'Held two Crushing Wave Piests hostage while they rested, then forcing them to escort them to the Fane. They let them go after.', 1),
(4, 1, 'Dispatched some fungus in the Fane.', 1),
(6, 2, 'Test day 2 entry with extra word. Torian.', 1),
(7, 2, 'Test Day 2 entry with extra word. Fane. Also Hope\'s Landing.', 1),
(9, 3, 'Testing with Day 3', 0),
(10, 3, 'Testing with Day 3', 0),
(11, 3, 'Testing with Day 3', 0);

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
  `npc_location` text NOT NULL,
  `npc_faction` text NOT NULL,
  `npc_deity` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `compendium`
--

INSERT INTO `compendium` (`id`, `title`, `type`, `body`, `image`, `npc_location`, `npc_faction`, `npc_deity`) VALUES
(1, 'ForgeForge', 'faction', 'Created in worship of a great Giant of old, ForgeForge is a group primarily focused on fantastic craftsmanship in weapons and armor.  While ForgeForge  members will sell many of their wares for coin, it is much more common for the most exquisitely done pieces to be traded among members, or gifted in an ultimate sign of respect and gratitude.\r\n\r\nThey\'re a very well respected organization that almost entirely operates above board and whose hierarchy  is based exclusively on the skill of one\'s craftsmanship. Also, here\'s the word Westfair.', '', '', '', ''),
(2, 'Westfair', 'settlement', 'Hope\'s Landing was a town of a location and style that suited much of the human settlers very well, however they sought a place to call their home. After travelling along the coast they happened upon a perfect location to set up their new home, Westfair. Westfair is a coastal town with fairly ready access to resources via the sea and the nearby Shadewood.\r\n\r\nIts location in a diverse and very wild ecosystem made it the primary location for  The Crimson Seal , who make their headquarters in The Crimson Lodge within Westfair. The Lodge provides much of the identity of the town, as much of the economy in the town revolves around the hunt and its side businesses.', '', '', '', ''),
(5, 'The Junction', 'settlement', 'The Junction barely constitutes a settlement. Serving as the middle point between Hope\'s Landing, Selnora, Kirnheim, and Westfair, it was created as a neutral ground at which the various communities can gather for discussions and important meetings. \r\n\r\nThe town consists of only three main parts. There is the Inn, literally just called The Junction Hotel. With limited space available, The Junction Hotel is often prohibitively expensive for most visitors and only plays host to the most wealthy nobles and highly regarded diplomats. Other than that, there is \"The Court\", a circular outdoor arena in the middle of town where major meetings take place. The Court is overseen by an elderly Halfling named Zigmi Rumblestride, known simply as \"The Scribe\". Finally, for anyone who doesn\'t stay at the inn, there\'s a small tent-city that encircles most of the area. With the lack of shops and markets in the town, the tent city becomes a bustling flurry of impromptu trade.\r\n\r\n\r\nThe Junction is where most large-scale agreements between the people of the region are negotiated and decided. There is no approved format or voting. Either all sides come to an agreement, or they don\'t. On rare occasion The Court is also used to try criminals, although this is rare and reserved only for instances where multiple settlements have a vested interest in the outcome.', '', '', '', ''),
(6, 'Flintspark', 'settlement', 'A much older city than it looks, Flintspark is a bastion of magic, technology, and science. Experimentation and invention are highly prized in this community, which is what gives Flintspark a much newer feel than its actual age.\r\n\r\nLikely to be one of the first communities discovered by the Trailblazer settlers, Flintspark has accepted many gnomes from that community, as well as a few particularly gifted folks from the other races. While the permanent population of Flintspark is almost exclusively gnome, there are frequently many visitors from other lands buying, selling, sharing technology, and learning from the gnomes.\r\n\r\n\r\nThe study of the Flintspark gnomes is almost completely practical, with very little in the way of a theoretical component. As such, while there are libraries in Flintspark, the main attraction and source of knowledge comes from the Blackbox Lyceum. The Lyceum is an amazing place where inventors or enchanters will experiement/demonstrate (often for the first time) their creations in front of an audience of esteemed members of the community. The success of a showing at the Blackbox Lyceum can have a great impact on a gnome\'s personal standing in Flintspark, or an outsider\'s esteem within the city.', '', '', '', ''),
(7, 'Selnora', 'settlement', 'Seeking a home amongst the wilderness, the Elves departed from Hope\'s Landing for Selnora. Perfectly nestled between a large lake and The Shadewood, the Elves settled in and established a town with a very open feel to it.\r\n\r\nThe \"roads\" of Selnora are not paved. Instead, the grassland and the trees originally present in the area are interwoven into the layout of the town itself. The primary fixture of Selnora is the massive library, The Springwell Archives. When the Elves left the old world, preservation of the knowledge and history was their primary directive. The Springwell Archives contains almost all of the remaining books from the old world, and is rapidly filling up with texts and studies from the new world.\r\n\r\n\r\nBecause of the presence of the Archives, Selnora is frequented and visited often by members of both  The Twilight Helix , and to a lesser extent  The Seekers .', '', '', '', ''),
(9, 'Hope\'s Landing', 'settlement', 'As the  The War of the Risen  waged on and most took to ships in search of a new world, Hope\'s Landing is where the first of  The Trailblazers  made land. Through various forms of communication, all vessels were notified of this new location and most made their way there. While the majority of Humans, Dwarves, and Elves left and settled elsewhere, some stayed behind along with the minor races and settled in Hope\'s Landing.\r\n\r\nDespite being technically the first of the new settlements, Hope\'s Landing is also the least developed, as it was constantly in flux and was required to house numerous ships full of people as they arrived in the new world. It is only relatively recently that the community has settled down and started to build an identity of its own as a bastion of diversity, inclusivity, and the promise of the new world. ', '', '', '', ''),
(11, 'Zigmi Rumblestride', 'npc', 'Name: Zigmi Rumblestride\r\nRace: Halfling\r\nJob: \"The Scribe\"\r\nFaction:  The Exchange \r\nFaith:  Sydona the Mother \r\nLocation: The Court\r\nTown:  The Junction \r\n\r\nWants: \r\nFears: \r\nDM ROLEPLAY:\r\n\r\nBio:\r\n\r\nPC Interactions:\r\n', '', 'Hope\'s Landing', 'The Exchange', 'Sydona The Mother'),
(12, 'Yara The First Dead', 'deity', 'Yara was part of the House of Giving and originally gifted those in the material plane with immortality. Unfortunately she was betrayed and killed by her brother Zarazim The Betrayer, becoming the very first being of any kind to die. As the first to die, she governs the ethereal plane and holds dominion over the transition between life and death.\r\n', '', '', '', ''),
(15, 'Tanner Cogsnap', 'npc', 'Name: Tanner Cogsnap\r\nRace: Gnome\r\nJob: Innkeep\r\nFaction: \r\nFaith:  Ozmund the Welcomed Guest \r\nLocation: The Half-Full Cask\r\nTown: Hope\'s Landing\r\n\r\nWants: \r\nFears: \r\nDM ROLEPLAY:\r\n\r\nBio:\r\n\r\nPC Interactions:', '', 'Hope\'s Landing', '', 'Ozmund The Welcomed Guest'),
(16, 'Mary Seatail', 'npc', 'Name: Mary Seatail\r\nRace: Human\r\nJob: Townmaster\r\nFaction:  The Blue Veterans \r\nFaith:  Sydona the Mother\r\nLocation: Town Hall\r\nTown: Hope\'s Landing\r\n\r\n\r\nWants: \r\nFears: \r\nDM ROLEPLAY:\r\n\r\nBio:\r\n\r\nPC Interactions:', '', 'Hope\'s Landing', 'The Blue Veterans', 'Sydona the Mother'),
(17, 'Bretta Bluewater', 'npc', 'Name: Bretta Bluewater\r\nRace: Human\r\nJob: Holy Person\r\nFaction:  The Blue Veterans \r\nFaith:  Sydona the Mother \r\nLocation: Temple of the Mother\r\nTown: Hope\'s Landing\r\n\r\nWants: \r\nFears: \r\nDM ROLEPLAY:\r\n\r\nBio:\r\n\r\nPC Interactions:', '', 'Hope\'s Landing', 'The Blue Veterans', 'Sydona the Mother'),
(19, 'Loras Stoneflaw', 'npc', 'Name: Loras Stoneflaw\r\nRace: Halfling\r\nJob: Blacksmith\r\nFaction:  ForgeForge \r\nFaith:  Sydona the Mother \r\nLocation: Stoneflaw\'s Arsenal\r\nTown: Hope\'s Landing\r\n\r\nWants: \r\nFears: \r\nDM ROLEPLAY:\r\n\r\nBio:\r\n\r\nPC Interactions:\r\n', '', 'Hope\'s Landing', 'ForgeForge', 'Sydona the Mother'),
(20, 'Kada Alpenward', 'npc', 'Name: Kada Alpenward\r\nRace: Human\r\nJob: Jeweler\r\nFaction:  The Exchange \r\nFaith:  Sydona the Mother \r\nLocation: Alpenward\'s Jewels\r\nTown: Hope\'s Landing\r\n\r\nWants: \r\nFears: \r\nDM ROLEPLAY:\r\n\r\nBio:\r\n\r\nPC Interactions:\r\n', '', 'Hope\'s Landing', 'The Exchange', 'Sydona the Mother'),
(22, 'Nando Craghunter', 'npc', 'Name: Nando Craghunter\r\nRace: Human\r\nJob: General Store\r\nFaction:  The Exchange \r\nFaith:  Sydona the Mother \r\nLocation: Hope\'s Landing Exchange\r\nTown:  Hope\'s Landing \r\n\r\nWants: \r\nFears: \r\nDM ROLEPLAY:\r\n\r\nBio:\r\n\r\nPC Interactions:\r\n', '', 'Hope\'s Landing', 'The Exchange', 'Sydona the Mother'),
(23, 'Gothor Paddle', 'npc', 'Name: Gothor Paddle\r\nRace: Human\r\nJob: Guard Captain\r\nFaction:  The Blue Veterans \r\nFaith:  Sydona the Mother \r\nLocation: Town Hall\r\nTown: Hope\'s Landing\r\n\r\nWants: \r\nFears: \r\nDM ROLEPLAY:\r\n\r\nBio:\r\n\r\nPC Interactions:\r\n', '', 'Hope\'s Landing', 'The Blue Veterans', 'Sydona the Mother'),
(24, 'Franz Marshcaller', 'npc', 'Name: Franz Marshcaller\r\nRace: Elf\r\nJob: Leader,  The Blue Veterans \r\nFaction:  The Blue Veterans \r\nFaith:  Sydona the Mother \r\nLocation: Cerulean Keep\r\nTown:  Riverbend \r\n\r\nWants: \r\nFears: \r\nDM ROLEPLAY:\r\n\r\nBio:\r\n\r\nPC Interactions:', '', 'Riverbend', 'The Blue Veterans', 'Sydona the Mother'),
(25, 'The Blue Veterans', 'faction', 'The Blue Veterans were formed in the wake of the War of the Risen. The two warring sides had been battling for years with no real headway being made, and once it became apparent that Ero and her risen army were the real threat, many soldiers on both sides formed a truce with one another in favor of turning their attention towards the real threat.\r\n\r\nEvacuation from the continent of Parydon became the only option for many, and it was the beginnings of The Blue Veterans that held off the armies of the undead long enough for many to escape across the sea on the final vessels.\r\n\r\nIn this new world, there are no standing armies among those who arrived from Parydon, and The Blue Veterans have taken up the cause of providing protection for the denizens of the first settlements and re-establishing some form of order and government.', '', '', '', ''),
(26, 'Twilight Helix', 'faction', 'Twilight Helix is interested in the study and practice of magic. They teach magic of all types and are always interested in discovering new forms of magic and studying any arcane relics. They will offer goods and services, but they value their skills highly.\r\n\r\nConsidered extreme by many, The Helix is first and foremost interested in the study and experimentation of magic. Membership to the Helix is complicated, as any who contribute to the group\'s understanding of magic is welcome, regardless of religious, political, or other affiliations.', '', '', '', ''),
(27, 'The Crimson Seal', 'faction', 'The Crimson Seal are a group on Monster Hunters that will kill, eradicate, or otherwise deal with monsters and beasts. They make the very clear distinction that they are not assassins and they are not mercenaries. They will deal with monsters and beasts. The primary reasons for contracts are many. It could be to eradicate it from an area, it could be for the safety of the locals, or it could be to secure precious materials.\r\n\r\nThe Crimson Seal does not hunt for sport, and will work together to take on particularly difficult challenges, while still preferring the smallest group possible in order to secure the largest share of the bounty. \r\n\r\nBounties are provided to The Crimson Seal via a letter in an envelope  with  a red wax seal. The letter will list five items: The Quandry, The Location, Contract Riders, the deadline and the Bounty. The bounty is provided in escrow to The Exchange and a magical bond is placed on the person who accepts the contract. Upon completion, The Seal member collects their bounty from the nearest Exchange office, and drops off, if necessary, any materials required as part of the contract.\r\n\r\nOnce an envelope has been opened, a Seal member has first right of refusal for that contract. If they choose not to take the contract, it must be taken directly to a Crimson Seal headquarters for other members to claim, otherwise the contract is terminated and the organization is informed that a member has broken the code.\r\n\r\nThe Crimson Seal has very little in the way of hierarchy. Each headquarters has a Majordomo who looks after the headquarters and handles any of the business of the Seal in that area. The Majordomo is not part of the Seal officially, but is protected and regarded as such.', '', '', '', ''),
(28, 'The Seekers', 'faction', 'As The Trailblazers began to make land in the new continent of Odera, of utmost importance was finding safe and prosperous lands to make their new homes. With the first ships moored safely offshore,  several brave, intrepid  explorers set off in rowboats to investigate this foreign land.\r\n\r\nHaving the distinguished honor of being the first Trailblazers to set foot on Odera, these fearless survivalists scoured the nearby landscape, making detailed maps of the landscape, dangers, and valuable resources. These were the inaugural members of The Seekers.\r\n\r\nContinuing their work to present day, The Seekers strike out into lands beyond the edges of any known map, looking for resources, dangers, potential settlement areas, and even native civilizations. They are also the creators of almost every piece of cartography possessed by the former settlers of the old world.', '', '', '', ''),
(29, 'The Exchange', 'faction', 'The Exchange is a group of people for whom financial gain and order are of paramount importance. They prefer to gain their wealth by making investments, and taking cuts from other endeavors by offering their services to aid those efforts. Their primary arms of operations are Savings and Loan, Item Delivery (both magical and conventional), Escrow, and Business Ownership.\r\n\r\nOf utmost importance to The Exchange is their flawless and unimpeachable reputation for delivering their services as promised. As such, they are very popular in brokering business deals  among  strangers and adversaries; pretty much any two parties who want to do business, but  can\'t implicitly trust each other. Instead they trust The Exchange, for a hefty fee.', '', '', '', ''),
(30, 'Zarazim the Betrayer', 'deity', 'Zarazim the Betrayer was jealous of the living beings of the world, so he conspired with a few of his siblings to steal immortality from the world. He was the one who conceived of the plan to claim imoortality for the gods. In the execution of his plan, Zarazim killed one of his fellow gods, Yara, in the first ever murder. In modern society, Zarazim is considered the oldest and greatest evil in the House of Corruption. He is the genesis of<br> all evil in the world.', '', '', '', ''),
(31, 'Mordecon the Liar', 'deity', 'Mordecon was a powerful and cunning god, known as the most intelligent and clever of the Houses. Feeling sympathetic to Zarazim\'s viewpoint, Mordecon aided him in his plan to steal immortality. Mordecon was deceitful to The Mother and The Father, which allowed Zarazim the space to kill Yara and claim immortality for the gods. Mordecon is the deity of choice for schemers and deceivers. Those who use subterfuge and double-speak to bend those to their will.', '', '', '', ''),
(32, 'Vivia the Thief', 'deity', 'Always the quietest and least assuming, Vivia could never turn down a good score. When approached by Zarazim and Mordecon with their plan, she felt she couldn\'t refuse. In her magnum opus, the masterpiece of her craft, Vivia was able to snatch immortality itself from the world. In current worship, Vivia is seen as the most palatable of the corrupted gods. Open worship of her is strictly forbidden, but unlike the rest of her house, may not necessarily be grounds for immediate execution.\r\n', '', '', '', ''),
(33, 'Szoumar the Hateful', 'deity', 'Szoumar, a 2nd Generation of the house of corruption, did not have the familiar attachment to the House of Giving that the older gods had. He had only heard tales through those in the house of corruption, and so he hated the House of Giving. He projected his hate onto the humanoids, granting them hate, jealousy, pride, greed, and envy. Traditionally, those who \"Sin\" are considered to do so under the influence of Szoumar.', '', '', '', ''),
(34, 'Belaxion the Warmonger', 'deity', 'Born into corruption. Belaxion delighted in playing with the emotions and alliances of the humanoid races. The first wars were fought and the first blood was spilled among the humanoids by the will of Belaxion. If it was Zarazim the Betrayer who corrupted the Gods, it is Belaxion corrupted the mortal races.\r\n', '', '', '', ''),
(36, 'Asha the Child', 'deity', 'Asha was born in the World, the daughter of Yara the First Dead. Zarazim The Betrayer brought Yara to the World to kill her and grant immortality to the gods, but what he didn\'t know was that Yara was with child. After her death, emerging from Yara\'s remains  was Asha, The Child. Asha is bound to the material world and is unable to ever join the gods. Because Vivia the Thief stole immortality from the world, Asha is the sole true immortal on the material plane.', '', '', '', ''),
(37, 'Avana the Grandmother', 'deity', 'Creator of the basest elements of air and water, Avana created the very winds and the seas that served as the building blocks for all of creation. Along with Opeus the Grandfather, Avana is also said to be responsible for the creation of the other gods themselves. ', '', '', '', ''),
(39, 'Sydona the Mother', 'deity', 'By far the most commonly worshipped deity of the modern world, Sydona the Mother used her gifts to create all the creatures who live upon the world. Literally referred to as \"Mother of All\", Sydona gave birth to intelligent life itself. Followers of Sydona are numerous and widespread, spanning almost all races and regions of the known world. Her followers include almost all for whom none of the other gods appeal to in a very specific manner.', '', '', '', ''),
(40, 'Roros the Father', 'deity', 'Roros the Father looked upon the world and thought it looked lonely. Using the powers he had been granted, Roros gave life to all things that grow. Plant-life, trees, and all the tiniest organisms that slowly but steadily flourish upon the world were all created by Roros to keep the land company and cover it in life and warmth.Roros is very heavily worshipped by those who feel an intense connection to nature. Common followers of Roros are Elves, Firbolg, Druids, farmers, and any who live in harmony with the world around them.\r\n', '', '', '', ''),
(41, 'Zophine the Sister', 'deity', 'With the world covered in a cornucopia of wonderfully diverse forms of life, Zophine the Sister wondered how they would all manage to coexist. Then she gifted them with the only prize she thought would allow all life to live together in harmony. She granted all living things the capacity for caring and compassion.Followers of Zophine often take the path of the healer or the philanthropist, while others simply follow Zophine out of an intense concern for the well-being of all living things.\r\n', '', '', '', ''),
(42, 'Ottori the Brother', 'deity', 'Ottori the Bother saw all creation and thought it was wonderful and amazing, but he pitied all who lived upon the world for their inability to witness creation as he had. Feeling this pity, Ottori decided to give the world the capacity for knowledge, so they might understand the world around them. He then gave them magic, so they might experience a form of wonder for themselves.Followers of Ottori are those who value knowledge and wisdom, as well as practitioners of the arcane. Wizards, scholars, historians, and many others all seek wisdom through Ottori the Brother.', '', '', '', ''),
(43, 'Ozmund the Welcomed Guest', 'deity', 'When the house of giving was create, there was another god created unknown to the others. Ozmund came upon the House of Giving as an outsider and was welcomed with open arms. Feeling the joy of inclusion despite a foreign background, Ozmund the Welcomed Guest granted the world with the capacity for language and understanding, so they might communicate and find common ground. Ozmund is very popular among those of the uncommon races who live among the masses. He is also heavily worshipped by the nomadic types who spend their lives on the road, constantly encountering new cultures, races, and languages.', '', '', '', ''),
(44, 'Furin Cragskill', 'npc', 'Name: Furin Cragskill\r\nRace: Dwarf\r\nJob: Leader,  The Exchange \r\nFaction:  The Exchange \r\nFaith:  Opeus the Grandfather \r\nLocation: The Great Hold\r\nTown:  Seffaren \r\n\r\nWants: \r\nFears: \r\nDM ROLEPLAY:\r\n\r\nBio:\r\n\r\nPC Interactions:', '', '', 'The Exchange', 'Opeus the Grandfather'),
(54, 'Tara-Ann Shadowspell', 'npc', 'Name: Tara-Ann Shadowspell\r\nRace: Tiefling\r\nJob: Enchanter\r\nFaction:  The Twilight Helix \r\nFaith:  Ottori the Brother \r\nLocation: A Touch of Wizardry\r\nTown: Hope\'s Landing\r\n\r\nWants: \r\nFears: \r\nDM ROLEPLAY:\r\n\r\nBio:\r\n\r\nPC Interactions:', '', 'Hope\'s Landing', 'Twilight Helix', 'Ottori the Brother'),
(58, 'Torian', 'player character', 'Test Data', '', '', '', ''),
(59, 'Skunk', 'player character', 'test data 1', '', '', '', '');

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
-- Indexes for table `campaignlog`
--
ALTER TABLE `campaignlog`
  ADD PRIMARY KEY (`id`);

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
-- AUTO_INCREMENT for table `campaignlog`
--
ALTER TABLE `campaignlog`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `compendium`
--
ALTER TABLE `compendium`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
