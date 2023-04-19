-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Gegenereerd op: 17 apr 2023 om 13:52
-- Serverversie: 10.4.28-MariaDB
-- PHP-versie: 8.0.28


-- SET lestijd_start = :lestijd_start, lestijd_eind=:lestijd_eind, doel_van_les=:doel_van_les,

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `autorijschool_vierkante_wielen`
--

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `auto`
--

CREATE TABLE `auto` (
  `auto_id` int(11) NOT NULL,
  `merk` varchar(255) NOT NULL,
  `brandstof_type` varchar(255) NOT NULL,
  `klaar_om_te_rijden` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `feedback`
--

CREATE TABLE `feedback` (
  `feedback_id` int(11) NOT NULL,
  `les_id` int(11) NOT NULL,
  `instructeur_id` int(11) NOT NULL,
  `gebruikers_id` int(11) NOT NULL,
  `inhoud` varchar(255) NOT NULL,
  `post_datum` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `instructeur`
--

CREATE TABLE `instructeur` (
  `instructeur_id` int(11) NOT NULL,
  `naam` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `wachtwoord` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `leerlingen`
--

CREATE TABLE `leerlingen` (
  `gebruikers_id` int(11) NOT NULL,
  `gebruikersnaam` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `wachtwoord` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `lessen`
--

CREATE TABLE `lessen` (
  `les_id` int(11) NOT NULL,
  `lestijd_start` datetime NOT NULL,
  `lestijd_eind` datetime NOT NULL,
  `doel_van_les` varchar(255) NOT NULL,
  `ophaal_locatie` varchar(255) NOT NULL,
  `gebruikers_id` int(11) NOT NULL,
  `instructeur_id` int(11) NOT NULL,
  `auto_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `melding_instructeur`
--

CREATE TABLE `melding_instructeur` (
  `melding_id` int(11) NOT NULL,
  `instructeur_id` int(11) NOT NULL,
  `datum` date NOT NULL,
  `verzender` varchar(255) NOT NULL,
  `inhoud` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `melding_klant`
--

CREATE TABLE `melding_klant` (
  `melding_id` int(11) NOT NULL,
  `gebruikers_id` int(11) NOT NULL,
  `datum` date NOT NULL,
  `verzender` varchar(255) NOT NULL,
  `inhoud` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `rijschoolhouder`
--

CREATE TABLE `rijschoolhouder` (
  `eigenaar_id` int(11) NOT NULL,
  `admin_naam` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `wachtwoord` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexen voor geëxporteerde tabellen
--

--
-- Indexen voor tabel `auto`
--
ALTER TABLE `auto`
  ADD PRIMARY KEY (`auto_id`);

--
-- Indexen voor tabel `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`feedback_id`),
  ADD KEY `les_id` (`les_id`,`instructeur_id`,`gebruikers_id`),
  ADD KEY `instructeur_id` (`instructeur_id`),
  ADD KEY `gebruikers_id` (`gebruikers_id`);

--
-- Indexen voor tabel `instructeur`
--
ALTER TABLE `instructeur`
  ADD PRIMARY KEY (`instructeur_id`);

--
-- Indexen voor tabel `leerlingen`
--
ALTER TABLE `leerlingen`
  ADD PRIMARY KEY (`gebruikers_id`);

--
-- Indexen voor tabel `lessen`
--
ALTER TABLE `lessen`
  ADD PRIMARY KEY (`les_id`),
  ADD KEY `instructeur_id` (`instructeur_id`),
  ADD KEY `gebruikers_id` (`gebruikers_id`),
  ADD KEY `auto_id` (`auto_id`);

--
-- Indexen voor tabel `melding_instructeur`
--
ALTER TABLE `melding_instructeur`
  ADD PRIMARY KEY (`melding_id`),
  ADD KEY `instructeur_id` (`instructeur_id`);

--
-- Indexen voor tabel `melding_klant`
--
ALTER TABLE `melding_klant`
  ADD PRIMARY KEY (`melding_id`),
  ADD KEY `gebruikers_id` (`gebruikers_id`);

--
-- Indexen voor tabel `rijschoolhouder`
--
ALTER TABLE `rijschoolhouder`
  ADD PRIMARY KEY (`eigenaar_id`);

--
-- AUTO_INCREMENT voor geëxporteerde tabellen
--

--
-- AUTO_INCREMENT voor een tabel `auto`
--
ALTER TABLE `auto`
  MODIFY `auto_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT voor een tabel `feedback`
--
ALTER TABLE `feedback`
  MODIFY `feedback_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT voor een tabel `instructeur`
--
ALTER TABLE `instructeur`
  MODIFY `instructeur_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT voor een tabel `leerlingen`
--
ALTER TABLE `leerlingen`
  MODIFY `gebruikers_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT voor een tabel `lessen`
--
ALTER TABLE `lessen`
  MODIFY `les_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT voor een tabel `melding_instructeur`
--
ALTER TABLE `melding_instructeur`
  MODIFY `melding_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT voor een tabel `melding_klant`
--
ALTER TABLE `melding_klant`
  MODIFY `melding_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT voor een tabel `rijschoolhouder`
--
ALTER TABLE `rijschoolhouder`
  MODIFY `eigenaar_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Beperkingen voor geëxporteerde tabellen
--

--
-- Beperkingen voor tabel `feedback`
--
ALTER TABLE `feedback`
  ADD CONSTRAINT `feedback_ibfk_1` FOREIGN KEY (`les_id`) REFERENCES `lessen` (`les_id`),
  ADD CONSTRAINT `feedback_ibfk_2` FOREIGN KEY (`instructeur_id`) REFERENCES `instructeur` (`instructeur_id`),
  ADD CONSTRAINT `feedback_ibfk_3` FOREIGN KEY (`gebruikers_id`) REFERENCES `leerlingen` (`gebruikers_id`);

--
-- Beperkingen voor tabel `lessen`
--
ALTER TABLE `lessen`
  ADD CONSTRAINT `lessen_ibfk_1` FOREIGN KEY (`instructeur_id`) REFERENCES `instructeur` (`instructeur_id`),
  ADD CONSTRAINT `lessen_ibfk_2` FOREIGN KEY (`gebruikers_id`) REFERENCES `leerlingen` (`gebruikers_id`),
  ADD CONSTRAINT `lessen_ibfk_3` FOREIGN KEY (`auto_id`) REFERENCES `instructeur` (`instructeur_id`);

--
-- Beperkingen voor tabel `melding_instructeur`
--
ALTER TABLE `melding_instructeur`
  ADD CONSTRAINT `melding_instructeur_ibfk_1` FOREIGN KEY (`instructeur_id`) REFERENCES `instructeur` (`instructeur_id`);

--
-- Beperkingen voor tabel `melding_klant`
--
ALTER TABLE `melding_klant`
  ADD CONSTRAINT `melding_klant_ibfk_1` FOREIGN KEY (`gebruikers_id`) REFERENCES `leerlingen` (`gebruikers_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
