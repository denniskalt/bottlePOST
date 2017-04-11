-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Erstellungszeit: 11. Apr 2017 um 19:03
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
-- Erstellt am: 11. Apr 2017 um 16:56
--

CREATE TABLE `cities` (
  `idCities` char(5) NOT NULL,
  `city` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `comments`
--
-- Erstellt am: 11. Apr 2017 um 16:52
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
-- Erstellt am: 11. Apr 2017 um 16:47
--

CREATE TABLE `confirmcodes` (
  `idConfirmcodes` int(11) NOT NULL,
  `usersId` int(11) NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `hashtags`
--
-- Erstellt am: 11. Apr 2017 um 16:49
--

CREATE TABLE `hashtags` (
  `idHashtags` int(11) NOT NULL,
  `bezeichnung` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `hashtagsposts`
--
-- Erstellt am: 11. Apr 2017 um 16:50
--

CREATE TABLE `hashtagsposts` (
  `hashtagsId` int(11) NOT NULL,
  `postsId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `login_attempts`
--
-- Erstellt am: 11. Apr 2017 um 16:47
--

CREATE TABLE `login_attempts` (
  `usersId` int(11) NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `posts`
--
-- Erstellt am: 11. Apr 2017 um 16:53
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
-- Erstellt am: 11. Apr 2017 um 16:58
--

CREATE TABLE `status` (
  `idStatus` int(11) NOT NULL,
  `beschreibung` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `users`
--
-- Erstellt am: 11. Apr 2017 um 16:46
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
  `url` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `userstypes`
--
-- Erstellt am: 11. Apr 2017 um 16:49
--

CREATE TABLE `userstypes` (
  `idUsersTypes` int(11) NOT NULL,
  `type` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `votes`
--
-- Erstellt am: 11. Apr 2017 um 16:55
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
-- AUTO_INCREMENT für Tabelle `confirmcodes`
--
ALTER TABLE `confirmcodes`
  MODIFY `idConfirmcodes` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT für Tabelle `hashtags`
--
ALTER TABLE `hashtags`
  MODIFY `idHashtags` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT für Tabelle `posts`
--
ALTER TABLE `posts`
  MODIFY `idPosts` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT für Tabelle `status`
--
ALTER TABLE `status`
  MODIFY `idStatus` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT für Tabelle `users`
--
ALTER TABLE `users`
  MODIFY `idUsers` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT für Tabelle `userstypes`
--
ALTER TABLE `userstypes`
  MODIFY `idUsersTypes` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT für Tabelle `votes`
--
ALTER TABLE `votes`
  MODIFY `idVotes` int(11) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
