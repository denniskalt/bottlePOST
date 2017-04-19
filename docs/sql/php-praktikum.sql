-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Erstellungszeit: 18. Apr 2017 um 11:17
-- Server-Version: 10.1.19-MariaDB
-- PHP-Version: 5.5.38

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Datenbank: `php-praktikum`
--
CREATE DATABASE IF NOT EXISTS `php-praktikum` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `php-praktikum`;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `cities`
--

CREATE TABLE `cities` (
  `idCities` char(5) NOT NULL,
  `city` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `comments`
--

CREATE TABLE `comments` (
  `idComments` int(11) NOT NULL,
  `usersId` int(11) NOT NULL,
  `postsId` int(11) NOT NULL,
  `comment` varchar(240) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `confirmcodes`
--

CREATE TABLE `confirmcodes` (
  `idConfirmcodes` char(12) NOT NULL,
  `usersId` int(11) NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `pwreset` char(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Daten für Tabelle `confirmcodes`
--

INSERT INTO `confirmcodes` (`idConfirmcodes`, `usersId`, `created`, `pwreset`) VALUES
('cYxbp5sS79gx', 4, '2017-04-18 09:09:24', '5xwgt89E3eAQ');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `hashtags`
--

CREATE TABLE `hashtags` (
  `idHashtags` int(11) NOT NULL,
  `bezeichnung` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `hashtagsposts`
--

CREATE TABLE `hashtagsposts` (
  `hashtagsId` int(11) NOT NULL,
  `postsId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `login_attempts`
--

CREATE TABLE `login_attempts` (
  `usersId` int(11) NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `options`
--

CREATE TABLE `options` (
  `idOptions` int(11) NOT NULL,
  `usersId` int(11) NOT NULL,
  `bg` varchar(60) NOT NULL,
  `design` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Daten für Tabelle `options`
--

INSERT INTO `options` (`idOptions`, `usersId`, `bg`, `design`) VALUES
(1, 4, 'way.jpg', 'default');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `posts`
--

CREATE TABLE `posts` (
  `idPosts` int(11) NOT NULL,
  `content` varchar(160) NOT NULL,
  `usersId` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `status`
--

CREATE TABLE `status` (
  `idStatus` int(11) NOT NULL,
  `beschreibung` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Daten für Tabelle `status`
--

INSERT INTO `status` (`idStatus`, `beschreibung`) VALUES
(1, 'inaktiv'),
(2, 'aktiv');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `users`
--

CREATE TABLE `users` (
  `idUsers` int(11) NOT NULL,
  `username` varchar(30) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` char(60) NOT NULL,
  `salt` char(60) NOT NULL,
  `regDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` int(3) NOT NULL,
  `profilepic` varchar(90) NOT NULL,
  `forename` varchar(50) NOT NULL,
  `surname` varchar(50) NOT NULL,
  `birthDate` date NOT NULL,
  `postcode` char(5) NOT NULL,
  `usersTypesId` int(11) NOT NULL,
  `url` varchar(40) NOT NULL,
  `lastLogin` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Daten für Tabelle `users`
--

INSERT INTO `users` (`idUsers`, `username`, `email`, `password`, `salt`, `regDate`, `status`, `profilepic`, `forename`, `surname`, `birthDate`, `postcode`, `usersTypesId`, `url`, `lastLogin`) VALUES
(4, 'tester', 'test@test.de', '$2y$07$JDJ5JDA3dGVzakpCUE5vYuTTpGaWR1/ztmBPkCCqPuplsgwULKRuq', '$2y$07tesjJBPNocKGKz-d', '2017-04-11 20:40:54', 1, 'bg/way.jpg', 'Max', 'Mustermann', '1995-07-10', '31785', 0, 'tester', '0000-00-00'),
(5, 'dennis', 'dennis@test.de', '$2y$07$JDJ5JDA3ZGVuKcJmdVpuN.19XB/ukF0zzKtxhU0nqC006H1JqoMIu', '$2y$07den)ÂfuZn4AOz@n6', '2017-04-15 11:51:16', 2, '', '', '', '0000-00-00', '', 4, '', '0000-00-00'),
(6, 'Cat', 'd@t.de', '$2y$07$JDJ5JDA3ZEB0UkFZRDZAQOeThTot/kvGFdXelMKGh9J9WLaxXJUlW', '$2y$07d@tRAYD6@AF1-nQC', '2017-04-16 13:33:30', 1, '', '', '', '0000-00-00', '', 0, '', '0000-00-00'),
(7, 'test', 't@t.de', '$2y$07$JDJ5JDA3dEB0a0hPZlBIRu5pXP8odJos4tzmkYhbWyAAyPFhjdEBu', '$2y$07t@tkHOfPHGjXIYFW', '2017-04-18 08:10:08', 2, '', '', '', '0000-00-00', '', 0, '', '0000-00-00');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `userstypes`
--

CREATE TABLE `userstypes` (
  `idUsersTypes` int(11) NOT NULL,
  `type` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Daten für Tabelle `userstypes`
--

INSERT INTO `userstypes` (`idUsersTypes`, `type`) VALUES
(1, 'Administrator'),
(4, 'Nutzer');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `votes`
--

CREATE TABLE `votes` (
  `idVotes` int(11) NOT NULL,
  `usersId` int(11) NOT NULL,
  `postsId` int(11) NOT NULL,
  `vote` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `cities`
--
ALTER TABLE `cities`
  ADD PRIMARY KEY (`idCities`);

--
-- Indizes für die Tabelle `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`idComments`);

--
-- Indizes für die Tabelle `confirmcodes`
--
ALTER TABLE `confirmcodes`
  ADD PRIMARY KEY (`idConfirmcodes`);

--
-- Indizes für die Tabelle `hashtags`
--
ALTER TABLE `hashtags`
  ADD PRIMARY KEY (`idHashtags`);

--
-- Indizes für die Tabelle `login_attempts`
--
ALTER TABLE `login_attempts`
  ADD PRIMARY KEY (`usersId`);

--
-- Indizes für die Tabelle `options`
--
ALTER TABLE `options`
  ADD PRIMARY KEY (`idOptions`);

--
-- Indizes für die Tabelle `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`idPosts`);

--
-- Indizes für die Tabelle `status`
--
ALTER TABLE `status`
  ADD PRIMARY KEY (`idStatus`);

--
-- Indizes für die Tabelle `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`idUsers`);

--
-- Indizes für die Tabelle `userstypes`
--
ALTER TABLE `userstypes`
  ADD PRIMARY KEY (`idUsersTypes`);

--
-- Indizes für die Tabelle `votes`
--
ALTER TABLE `votes`
  ADD PRIMARY KEY (`idVotes`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `comments`
--
ALTER TABLE `comments`
  MODIFY `idComments` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT für Tabelle `hashtags`
--
ALTER TABLE `hashtags`
  MODIFY `idHashtags` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT für Tabelle `options`
--
ALTER TABLE `options`
  MODIFY `idOptions` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT für Tabelle `posts`
--
ALTER TABLE `posts`
  MODIFY `idPosts` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT für Tabelle `status`
--
ALTER TABLE `status`
  MODIFY `idStatus` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT für Tabelle `users`
--
ALTER TABLE `users`
  MODIFY `idUsers` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT für Tabelle `userstypes`
--
ALTER TABLE `userstypes`
  MODIFY `idUsersTypes` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT für Tabelle `votes`
--
ALTER TABLE `votes`
  MODIFY `idVotes` int(11) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
