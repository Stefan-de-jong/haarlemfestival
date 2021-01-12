-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Gegenereerd op: 12 jan 2021 om 14:07
-- Serverversie: 10.4.14-MariaDB
-- PHP-versie: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hfa4_hf`
--

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `artist`
--

CREATE TABLE `artist` (
  `artist_id` int(11) NOT NULL,
  `artist_name` varchar(255) NOT NULL,
  `bio` text NOT NULL,
  `style` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `artist`
--

INSERT INTO `artist` (`artist_id`, `artist_name`, `bio`, `style`) VALUES
(1, 'Nicky Romero', 'Nick Rotteveel; born 6 January 1989), professionally known as Nicky Romero, is a Dutch musician, DJ, record producer and remixer from Amerongen. He has worked with, and received support from DJs, such as Ti&euml;sto, Fedde le Grand, Sander van Doorn, David Guetta, Calvin Harris, Armand Van Helden, Avicii and Hardwell. He currently ranks at number 43 on DJ Mag&#39;s annual Top 100 DJs poll. He is known for his viral hit song &#34;Toulouse&#34;', 1),
(2, 'Tiësto', 'Tiësto, stage name of Tijs Michiel Verwest, is a Dutch disc jockey and music producer who often performs at major dance events. He has been voted best DJ in the world several times.', 2),
(3, 'Afrojack', 'Nick van de Wall; born September 9, 1987), professionally known as Afrojack, is a Dutch DJ, music programmer, record producer and remixer from Spijkenisse. Afrojack regularly features as one of the ten best artists in the Top 100 DJs published by DJ Mag. He is also the CEO of LDH Europe.', 3),
(4, 'Hardwell', 'Robbert Van de Corput was born on 7 January 1988 in Breda, to Anneke and Cor van de Corput. At the age of four he began taking piano lessons and attended a music school. At the age of twelve, he produced his first songs in the field of electro, while performing as a hip-hop-DJ.', 4),
(5, 'Armin van Buuren', 'Born on December 25, 1976 in Leiden, Holland, van Buuren became interested in music at an early age (his father was an avid record buyer). A close friend introduced him to the world of dance music, and the Dutch DJ and remixer Ben Liebrand quickly became his main inspiration.', 5),
(6, 'martin Garixx', 'Martin Garrix was born as Martijn Gerard Garritsen on May 14, 1996 in Amstelveen, a municipality in the province of North Holland, Netherlands, to Gerard and Karin Garritsen. He has a sister, Laura. He graduated from the \'Herman Brood Academie\' in 2013 with the MBO diploma in \'artistic pop music\'', 6);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `customer`
--

CREATE TABLE `customer` (
  `id` int(11) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `customer`
--

INSERT INTO `customer` (`id`, `first_name`, `last_name`, `email`, `password`) VALUES
(0, 'Default ', 'User', 'default@user.com', ''),
(3, 'Stefan', 'de Jong', 'sjf.de.jong@gmail.com', '$2y$10$.tODfq4rWc7GEdfAxVL1DuLzf7/tL4wQNZPQoNdJ/1n9wvekpWmCW'),
(4, 'Ste@fan', 'de J()0ng&', 'ste^fan!#@stefan.nl', '$2y$10$kyLmEDKe2sMJdRyi6cH4ROd5XLIixmRgxsW.Tdg1UoG1PX6SsZnAm'),
(5, 'asdasd', 'asdasdasd', '625583@student.inholland.nl', '$2y$10$sZHiMLrs8OKaQCIJR3K1.Ov/w4Gu3.r8m3CGQlhZl5t4IzIr8gLeG'),
(6, 'Tom', 'Bouderij', 'tom@bo.comm', '$2y$10$91zvicMlpiAWk0xdbptLdeFG5I7Xc1Hb1wu45WUhPuI0rnJ4ImOci'),
(7, 'Tom', 'Bouderij', '623381@student.inholland.nl', '$2y$10$RuqXgcXaVlxPjnwET4uzKOX0lL4rgmiRr7ensCGF1YAiZVFJz2Cem'),
(8, 'Tom', 'Boudewijn', 'tombouderij@hotmail.com', '$2y$10$5veXip2ONmwBnCiyf9Jvc.YXcaCiNx5SVZzG4Yl44/NVTu5g4oA/S');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `customer_favourites`
--

CREATE TABLE `customer_favourites` (
  `customer_id` int(11) NOT NULL,
  `event_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `customer_favourites`
--

INSERT INTO `customer_favourites` (`customer_id`, `event_id`) VALUES
(1, 200),
(1, 253),
(1, 211),
(1, 213),
(3, 300),
(1, 212),
(1, 256),
(1, 280),
(1, 325),
(3, 256);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `customer_tickets`
--

CREATE TABLE `customer_tickets` (
  `customer_id` int(11) NOT NULL,
  `ticket_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `danceevent`
--

CREATE TABLE `danceevent` (
  `id` int(11) NOT NULL,
  `artist` int(11) NOT NULL,
  `location` int(11) NOT NULL,
  `session` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `danceevent`
--

INSERT INTO `danceevent` (`id`, `artist`, `location`, `session`) VALUES
(101, 1, 1, 0),
(101, 3, 1, 0),
(102, 2, 2, 0),
(103, 4, 3, 0),
(104, 5, 4, 0),
(105, 6, 5, 0),
(106, 4, 6, 0),
(106, 5, 6, 0),
(106, 6, 6, 0),
(107, 3, 3, 0),
(108, 2, 1, 0),
(109, 1, 2, 0),
(110, 1, 6, 0),
(110, 2, 6, 0),
(110, 3, 6, 0),
(111, 5, 3, 0),
(112, 4, 4, 0),
(113, 6, 2, 0);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `dance_session`
--

CREATE TABLE `dance_session` (
  `session_id` int(11) NOT NULL,
  `session_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `event`
--

CREATE TABLE `event` (
  `id` int(11) NOT NULL,
  `date` date NOT NULL,
  `begin_time` time NOT NULL,
  `end_time` time NOT NULL,
  `event_type` int(11) NOT NULL,
  `n_tickets` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `event`
--

INSERT INTO `event` (`id`, `date`, `begin_time`, `end_time`, `event_type`, `n_tickets`) VALUES
(101, '2020-07-24', '20:00:00', '02:00:00', 1, 1360),
(102, '2020-07-24', '22:00:00', '23:30:00', 1, 197),
(103, '2020-07-24', '23:00:00', '00:30:00', 1, 300),
(104, '2020-07-24', '22:00:00', '23:30:00', 1, 200),
(105, '2020-07-24', '22:00:00', '23:30:00', 1, 200),
(106, '2020-07-25', '14:00:00', '23:00:00', 1, 2000),
(107, '2020-07-25', '22:00:00', '23:30:00', 1, 300),
(108, '2020-07-25', '21:00:00', '01:00:00', 1, 1500),
(109, '2020-07-25', '23:00:00', '00:30:00', 1, 199),
(110, '2020-07-24', '14:00:00', '23:00:00', 1, 2000),
(111, '2020-07-24', '19:00:00', '20:30:00', 1, 300),
(112, '2020-07-24', '21:00:00', '22:30:00', 1, 1500),
(113, '2020-07-26', '18:00:00', '19:30:00', 1, 200),
(200, '2020-07-23', '18:00:00', '19:30:00', 2, 27),
(201, '2020-07-23', '19:30:00', '21:00:00', 2, 33),
(202, '2020-07-23', '21:00:00', '22:30:00', 2, 36),
(203, '2020-07-24', '18:00:00', '19:30:00', 2, 40),
(204, '2020-07-24', '19:30:00', '21:00:00', 2, 40),
(205, '2020-07-24', '21:00:00', '22:30:00', 2, 40),
(206, '2020-07-25', '18:00:00', '19:30:00', 2, 39),
(207, '2020-07-25', '19:30:00', '21:00:00', 2, 40),
(208, '2020-07-25', '21:00:00', '22:30:00', 2, 40),
(209, '2020-07-26', '18:00:00', '19:30:00', 2, 40),
(210, '2020-07-26', '19:30:00', '21:00:00', 2, 40),
(211, '2020-07-26', '21:00:00', '22:30:00', 2, 40),
(212, '2020-07-23', '17:00:00', '19:00:00', 2, 47),
(213, '2020-07-23', '19:00:00', '21:00:00', 2, 52),
(214, '2020-07-23', '21:00:00', '23:00:00', 2, 52),
(215, '2020-07-24', '17:00:00', '19:00:00', 2, 52),
(216, '2020-07-24', '19:00:00', '21:00:00', 2, 52),
(217, '2020-07-24', '21:00:00', '23:00:00', 2, 52),
(218, '2020-07-25', '17:00:00', '19:00:00', 2, 52),
(219, '2020-07-25', '19:00:00', '21:00:00', 2, 52),
(220, '2020-07-25', '21:00:00', '23:00:00', 2, 52),
(221, '2020-07-26', '17:00:00', '19:00:00', 2, 52),
(222, '2020-07-26', '19:00:00', '21:00:00', 2, 52),
(223, '2020-07-26', '21:00:00', '23:00:00', 2, 52),
(224, '2020-07-23', '17:00:00', '19:00:00', 2, 54),
(225, '2020-07-23', '19:00:00', '21:00:00', 2, 57),
(226, '2020-07-24', '17:00:00', '19:00:00', 2, 60),
(227, '2020-07-24', '19:00:00', '21:00:00', 2, 60),
(228, '2020-07-25', '17:00:00', '19:00:00', 2, 60),
(229, '2020-07-25', '19:00:00', '21:00:00', 2, 60),
(230, '2020-07-26', '17:00:00', '19:00:00', 2, 60),
(231, '2020-07-26', '19:00:00', '21:00:00', 2, 60),
(232, '2020-07-23', '17:30:00', '19:00:00', 2, 44),
(233, '2020-07-23', '19:00:00', '20:30:00', 2, 45),
(234, '2020-07-23', '20:30:00', '22:00:00', 2, 45),
(235, '2020-07-24', '17:30:00', '19:00:00', 2, 45),
(236, '2020-07-24', '19:00:00', '20:30:00', 2, 45),
(237, '2020-07-24', '20:30:00', '22:00:00', 2, 45),
(238, '2020-07-25', '17:30:00', '19:00:00', 2, 45),
(239, '2020-07-25', '19:00:00', '20:30:00', 2, 45),
(240, '2020-07-25', '20:30:00', '22:00:00', 2, 45),
(241, '2020-07-26', '17:30:00', '19:00:00', 2, 45),
(242, '2020-07-26', '19:00:00', '20:30:00', 2, 45),
(243, '2020-07-26', '20:30:00', '22:00:00', 2, 45),
(244, '2020-07-23', '17:00:00', '18:30:00', 2, 35),
(245, '2020-07-23', '18:30:00', '20:00:00', 2, 36),
(246, '2020-07-23', '20:00:00', '21:30:00', 2, 36),
(247, '2020-07-24', '17:00:00', '18:30:00', 2, 36),
(248, '2020-07-24', '18:30:00', '20:00:00', 2, 36),
(249, '2020-07-24', '20:00:00', '21:30:00', 2, 36),
(250, '2020-07-25', '17:00:00', '18:30:00', 2, 36),
(251, '2020-07-25', '18:30:00', '20:00:00', 2, 36),
(252, '2020-07-25', '20:00:00', '21:30:00', 2, 36),
(253, '2020-07-26', '17:00:00', '18:30:00', 2, 36),
(254, '2020-07-26', '18:30:00', '20:00:00', 2, 36),
(255, '2020-07-26', '20:00:00', '21:30:00', 2, 36),
(256, '2020-07-23', '16:30:00', '18:00:00', 2, 97),
(257, '2020-07-23', '18:00:00', '19:30:00', 2, 100),
(258, '2020-07-23', '19:30:00', '21:00:00', 2, 100),
(259, '2020-07-24', '16:30:00', '18:00:00', 2, 100),
(260, '2020-07-24', '18:00:00', '19:30:00', 2, 100),
(261, '2020-07-24', '19:30:00', '21:00:00', 2, 100),
(262, '2020-07-25', '16:30:00', '18:00:00', 2, 100),
(263, '2020-07-25', '18:00:00', '19:30:00', 2, 100),
(264, '2020-07-25', '19:30:00', '21:00:00', 2, 100),
(265, '2020-07-26', '16:30:00', '18:00:00', 2, 100),
(266, '2020-07-26', '18:00:00', '19:30:00', 2, 100),
(267, '2020-07-26', '19:30:00', '21:00:00', 2, 100),
(268, '2020-07-23', '17:30:00', '19:00:00', 2, 47),
(269, '2020-07-23', '19:00:00', '20:30:00', 2, 48),
(270, '2020-07-23', '20:30:00', '22:00:00', 2, 48),
(271, '2020-07-24', '17:30:00', '19:00:00', 2, 48),
(272, '2020-07-24', '19:00:00', '20:30:00', 2, 48),
(273, '2020-07-24', '20:30:00', '22:00:00', 2, 48),
(274, '2020-07-25', '17:30:00', '19:00:00', 2, 48),
(275, '2020-07-25', '19:00:00', '20:30:00', 2, 48),
(276, '2020-07-25', '20:30:00', '22:00:00', 2, 48),
(277, '2020-07-26', '17:30:00', '19:00:00', 2, 48),
(278, '2020-07-26', '19:00:00', '20:30:00', 2, 48),
(279, '2020-07-26', '20:30:00', '22:00:00', 2, 48),
(280, '2020-07-23', '17:30:00', '19:00:00', 2, 59),
(281, '2020-07-23', '19:00:00', '20:30:00', 2, 60),
(282, '2020-07-23', '20:30:00', '22:00:00', 2, 60),
(283, '2020-07-24', '17:30:00', '19:00:00', 2, 60),
(284, '2020-07-24', '19:00:00', '20:30:00', 2, 60),
(285, '2020-07-24', '20:30:00', '22:00:00', 2, 60),
(286, '2020-07-25', '17:30:00', '19:00:00', 2, 60),
(287, '2020-07-25', '19:00:00', '20:30:00', 2, 60),
(288, '2020-07-25', '20:30:00', '22:00:00', 2, 60),
(289, '2020-07-26', '17:30:00', '19:00:00', 2, 60),
(290, '2020-07-26', '19:00:00', '20:30:00', 2, 60),
(291, '2020-07-26', '20:30:00', '22:00:00', 2, 60),
(300, '2020-07-23', '10:00:00', '12:30:00', 3, 3),
(301, '2020-07-23', '10:00:00', '12:30:00', 3, 10),
(302, '2020-07-23', '13:00:00', '15:30:00', 3, 12),
(303, '2020-07-23', '13:00:00', '15:30:00', 3, 12),
(304, '2020-07-23', '16:00:00', '18:30:00', 3, 12),
(305, '2020-07-23', '16:00:00', '18:30:00', 3, 12),
(306, '2020-07-24', '10:00:00', '12:30:00', 3, 12),
(307, '2020-07-24', '10:00:00', '12:30:00', 3, 12),
(308, '2020-07-24', '13:00:00', '15:30:00', 3, 12),
(309, '2020-07-24', '13:00:00', '15:30:00', 3, 12),
(310, '2020-07-24', '13:00:00', '15:30:00', 3, 12),
(311, '2020-07-24', '16:00:00', '18:30:00', 3, 12),
(312, '2020-07-24', '16:00:00', '18:30:00', 3, 12),
(313, '2020-07-25', '10:00:00', '12:30:00', 3, 12),
(314, '2020-07-25', '10:00:00', '12:30:00', 3, 12),
(315, '2020-07-25', '13:00:00', '15:30:00', 3, 12),
(316, '2020-07-25', '13:00:00', '15:30:00', 3, 12),
(317, '2020-07-25', '13:00:00', '15:30:00', 3, 12),
(318, '2020-07-25', '16:00:00', '18:30:00', 3, 12),
(319, '2020-07-25', '16:00:00', '18:30:00', 3, 12),
(320, '2020-07-25', '16:00:00', '18:30:00', 3, 12),
(321, '2020-07-26', '10:00:00', '12:30:00', 3, 12),
(322, '2020-07-26', '10:00:00', '12:30:00', 3, 12),
(323, '2020-07-26', '10:00:00', '12:30:00', 3, 12),
(324, '2020-07-26', '13:00:00', '15:30:00', 3, 12),
(325, '2020-07-26', '13:00:00', '15:30:00', 3, 12),
(326, '2020-07-26', '13:00:00', '15:30:00', 3, 12),
(327, '2020-07-26', '16:00:00', '18:30:00', 3, 12),
(328, '2020-07-26', '16:00:00', '18:30:00', 3, 12);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `eventtype`
--

CREATE TABLE `eventtype` (
  `id` int(11) NOT NULL,
  `type` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `eventtype`
--

INSERT INTO `eventtype` (`id`, `type`) VALUES
(1, 'Dance'),
(2, 'Food'),
(3, 'Historic'),
(4, 'Jazz');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `foodevent`
--

CREATE TABLE `foodevent` (
  `id` int(11) NOT NULL,
  `restaurant` int(11) NOT NULL,
  `session` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `foodevent`
--

INSERT INTO `foodevent` (`id`, `restaurant`, `session`) VALUES
(200, 1, 1),
(201, 1, 2),
(202, 1, 3),
(203, 1, 1),
(204, 1, 2),
(205, 1, 3),
(206, 1, 1),
(207, 1, 2),
(208, 1, 3),
(209, 1, 1),
(210, 1, 2),
(211, 1, 3),
(212, 2, 1),
(213, 2, 2),
(214, 2, 3),
(215, 2, 1),
(216, 2, 2),
(217, 2, 3),
(218, 2, 1),
(219, 2, 2),
(220, 2, 3),
(221, 2, 1),
(222, 2, 2),
(223, 2, 3),
(224, 3, 1),
(225, 3, 2),
(226, 3, 1),
(227, 3, 2),
(228, 3, 1),
(229, 3, 2),
(230, 3, 1),
(231, 3, 2),
(232, 4, 1),
(233, 4, 2),
(234, 4, 3),
(235, 4, 1),
(236, 4, 2),
(237, 4, 3),
(238, 4, 1),
(239, 4, 2),
(240, 4, 3),
(241, 4, 1),
(242, 4, 2),
(243, 4, 3),
(244, 5, 1),
(245, 5, 2),
(246, 5, 3),
(247, 5, 1),
(248, 5, 2),
(249, 5, 3),
(250, 5, 1),
(251, 5, 2),
(252, 5, 3),
(253, 5, 1),
(254, 5, 2),
(255, 5, 3),
(256, 6, 1),
(257, 6, 2),
(258, 6, 3),
(259, 6, 1),
(260, 6, 2),
(261, 6, 3),
(262, 6, 1),
(263, 6, 2),
(264, 6, 3),
(265, 6, 1),
(266, 6, 2),
(267, 6, 3),
(268, 7, 1),
(269, 7, 2),
(270, 7, 3),
(271, 7, 1),
(272, 7, 2),
(273, 7, 3),
(274, 7, 1),
(275, 7, 2),
(276, 7, 3),
(277, 7, 1),
(278, 7, 2),
(279, 7, 3),
(280, 8, 1),
(281, 8, 2),
(282, 8, 3),
(283, 8, 1),
(284, 8, 2),
(285, 8, 3),
(286, 8, 1),
(287, 8, 2),
(288, 8, 3),
(289, 8, 1),
(290, 8, 2),
(291, 8, 3);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `guide`
--

CREATE TABLE `guide` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `guide`
--

INSERT INTO `guide` (`id`, `name`) VALUES
(1, 'Jan-Willem'),
(2, 'Frederic'),
(3, 'Annet'),
(4, 'Williams'),
(5, 'Kim'),
(6, 'Lisa'),
(7, 'Susan'),
(8, 'Deirdre');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `historicevent`
--

CREATE TABLE `historicevent` (
  `id` int(11) NOT NULL,
  `language` int(11) NOT NULL,
  `guide` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `historicevent`
--

INSERT INTO `historicevent` (`id`, `language`, `guide`) VALUES
(300, 1, 1),
(301, 2, 2),
(302, 1, 1),
(303, 2, 2),
(304, 1, 1),
(305, 2, 2),
(306, 1, 3),
(307, 2, 4),
(308, 1, 3),
(309, 2, 4),
(310, 3, 5),
(311, 1, 3),
(312, 2, 4),
(313, 1, 1),
(314, 2, 2),
(315, 1, 3),
(316, 2, 4),
(317, 3, 5),
(318, 1, 1),
(319, 2, 2),
(320, 3, 5),
(321, 1, 6),
(322, 2, 8),
(323, 3, 5),
(324, 1, 3),
(325, 2, 2),
(326, 3, 7),
(327, 1, 1),
(328, 2, 4);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `jazzevent`
--

CREATE TABLE `jazzevent` (
  `id` int(11) NOT NULL,
  `artist` int(11) NOT NULL,
  `location` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `kitchen`
--

CREATE TABLE `kitchen` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `kitchen`
--

INSERT INTO `kitchen` (`id`, `name`) VALUES
(1, 'dutch'),
(2, 'french'),
(3, 'asian'),
(4, 'argentinian'),
(5, 'fish'),
(6, 'steak');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `language`
--

CREATE TABLE `language` (
  `id` int(11) NOT NULL,
  `language` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `language`
--

INSERT INTO `language` (`id`, `language`) VALUES
(1, 'Nederlands'),
(2, 'English'),
(3, 'Chinese');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `linked_photo`
--

CREATE TABLE `linked_photo` (
  `linked_id` int(11) NOT NULL,
  `photo_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `linked_photo`
--

INSERT INTO `linked_photo` (`linked_id`, `photo_id`) VALUES
(1, 300),
(1, 301),
(2, 302),
(2, 303),
(3, 304),
(3, 305),
(4, 306),
(4, 307),
(5, 308),
(5, 309),
(6, 310),
(6, 311),
(7, 312),
(7, 313),
(8, 314),
(8, 315),
(9, 316),
(9, 317);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `page`
--

CREATE TABLE `page` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `html` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `page`
--

INSERT INTO `page` (`id`, `title`, `html`) VALUES
(200, 'Restaurant Mr. & Mrs.', '\r\n     <h1>Restaurant Mr. & Mrs. </h1>\r\n                <p>\r\n                    About the restaurant: <a href=\"https://www.restaurantmrandmrs.nl/\"> restaurantmrandmrs.nl</a><br>\r\n                    <br>\r\n                    Kitchen: Mr & Mrs is a 4 star Dutch, fish and seafood, European restaurant.<br>\r\n                    <br>\r\n                    Prices: A reservation fee of &euro;10,- per person wil be charged. This fee will be deducted from the final check on visiting the restaurant.<br>\r\n                    <br>\r\n                    The restaurants prices:<br>\r\n                    Regular ticket: &euro;45,00*<br>\r\n                    Kids ticket: &euro;22,50*<br>\r\n                    <br>\r\n                    * Total price = reservation fees + meal costs(13+: &euro;45,- , child: &euro;22,50)<br>\r\n                    Beverage costs are not included in the total price.<br>\r\n                    Meal costs must be paid in the restaurant.<br>\r\n                    <br>\r\n                    Adres: Lange Veerstraat 4, 2011 DB Haarlem, Netherlands.<br>\r\n                </p>\r\n            </article>\r\n\r\n\r\n            <iframe class=\"food_location\" width=\"425\" height=\"350\" frameborder=\"1\"\r\n                    src=\"https://maps.google.com/maps?q=restaurant%20mr%20%26%20mrs&t=&z=13&ie=UTF8&iwloc=&output=embed\"\r\n                    frameborder=\"0\" scrolling=\"no\" marginheight=\"0\" marginwidth=\"0\">\r\n            </iframe>\r\n      <section class=\"food_avaibility\">\r\n        <h2>Restaurant availabilty:</h2>\r\n        Date:\r\n    \r\n        <select id=\"date\" onchange=\"date()\">\r\n            <option value=\"2020-07-23\">Thursday 23 Juli</option>\r\n            <option value=\"2020-07-24\">Friday 24 Juli</option>\r\n            <option value=\"2020-07-25\">Saturday 25 Juli</option>\r\n            <option value=\"2020-07-26\">Sunday 26 Juli</option>\r\n        </select>\r\n\r\n   \r\n\r\n        <table id=\"avaibleTabel\" border=\"1\" width=\"425\">\r\n          <tr>\r\n            <th>\r\n              Session 1\r\n            </th>\r\n            <th>\r\n              Session 2\r\n            </th>\r\n            <th>\r\n              Session 3\r\n            </th>\r\n          </tr>\r\n       <tr>\r\n            <td>\r\n\r\n            </td>\r\n            <td>\r\n\r\n            </td>\r\n            <td>\r\n\r\n            </td>\r\n        </tr>\r\n  <tr>\r\n            <td>\r\n\r\n            </td>\r\n            <td>\r\n\r\n            </td>\r\n            <td>\r\n\r\n            </td>\r\n        </tr>\r\n        </table>\r\n'),
(201, 'Restaurant Ratatouille', '\r\n        <h1>Restaurant Ratatouille</h1>\r\n\r\n        <p>\r\n            About the restaurant: <a href=\"https://www.ratatouillefoodandwine.nl/\"> ratatouillefoodandwine.nl </a><br>\r\n            <br>\r\n            Kitchen: Ratatouille is a 4 star French, fish and seafood, European restaurant. Reservations are mandatory.<br>\r\n            <br>\r\n            Prices: A reservation fee of &euro;10,- per person wil be charged. This fee will be deducted from the final check on visiting the restaurant.<br>\r\n            <br>\r\n            The restaurants prices are:<br>\r\n            Regular ticket: &euro;45,00*<br>\r\n            Kids ticket: &euro;22,50*<br>\r\n            <br>\r\n            * Total price = reservation fees + meal costs(13+: &euro;45,- , child: &euro;22,50)<br>\r\n            Beverage costs are not included in the total price.<br>\r\n            Meal costs must be paid in the restaurant.<br>\r\n            <br>\r\n            Adres:  Spaarne 96, 2011 CL Haarlem, Netherlands.<br>\r\n        </p>\r\n    </article>\r\n\r\n\r\n        <iframe class=\"food_location\" width=\"425\" height=\"350\" frameborder=\"1\"\r\n                src=\"https://maps.google.com/maps?q=rataouille%20haarlem&t=&z=13&ie=UTF8&iwloc=&output=embed\"\r\n                frameborder=\"0\" scrolling=\"no\" marginheight=\"0\" marginwidth=\"0\">\r\n        </iframe>\r\n   <section class=\"food_avaibility\">\r\n        <h2>Restaurant availabilty:</h2>\r\n        Date:\r\n    \r\n       \r\n        <select id=\"date\" onchange=\"date()\">\r\n            <option value=\"2020-07-23\">Thursday 23 Juli</option>\r\n            <option value=\"2020-07-24\">Friday 24 Juli</option>\r\n            <option value=\"2020-07-25\">Saturday 25 Juli</option>\r\n            <option value=\"2020-07-26\">Sunday 26 Juli</option>\r\n        </select>\r\n\r\n   \r\n\r\n        <table id=\"avaibleTabel\" border=\"1\" width=\"425\">\r\n          <tr>\r\n            <th>\r\n              Session 1\r\n            </th>\r\n            <th>\r\n              Session 2\r\n            </th>\r\n            <th>\r\n              Session 3\r\n            </th>\r\n          </tr>\r\n          <tr>\r\n            <td>\r\n     \r\n            </td>\r\n            <td>\r\n          \r\n            </td>\r\n            <td>\r\n         \r\n            </td>\r\n          </tr>\r\n    <tr>\r\n            <td>\r\n\r\n            </td>\r\n            <td>\r\n\r\n            </td>\r\n            <td>\r\n\r\n            </td>\r\n        </tr>\r\n        </table>\r\n\r\n\r\n'),
(202, 'Restaurant Fris', '\r\n        <h1>Restaurant Fris</h1>\r\n\r\n        <p>\r\n            About the restaurant: <a href=\"https://www.restaurantfris.nl/\"> restaurantfris.nl</a><br>\r\n            <br>\r\n            Kitchen: Fris is a 4 star Dutch, French, European restaurant.<br>\r\n            <br>\r\n            Prices: A reservation fee of &euro;10,- per person wil be charged. This fee will be deducted from the final check on visiting the restaurant.<br>\r\n            <br>\r\n            The restaurants prices are:<br>\r\n            Regular ticket: &euro;45,00*<br>\r\n            Kids ticket: &euro;22,50*<br>\r\n            <br>\r\n            * Total price = reservation fees + meal costs(13+: &euro;45,- , child: &euro;22,50)<br>\r\n            Beverage costs are not included in the total price.<br>\r\n            Meal costs must be paid in the restaurant.<br>\r\n            <br>\r\n            Adres: Twijnderslaan 7, 2012 BG Haarlem, Netherlands<br>\r\n        </p>\r\n    </article>\r\n\r\n\r\n        <iframe class=\"food_location\" width=\"425\" height=\"350\" frameborder=\"1\"\r\n                src=\"https://maps.google.com/maps?q=restaurant%20fris%20haarlem&t=&z=13&ie=UTF8&iwloc=&output=embed\"\r\n                frameborder=\"0\" scrolling=\"no\" marginheight=\"0\" marginwidth=\"0\">\r\n        </iframe>\r\n   <section class=\"food_avaibility\">\r\n        <h2>Restaurant availabilty:</h2>\r\n        Date:\r\n    \r\n   \r\n        <select id=\"date\" onchange=\"date()\">\r\n            <option value=\"2020-07-23\">Thursday 23 Juli</option>\r\n            <option value=\"2020-07-24\">Friday 24 Juli</option>\r\n            <option value=\"2020-07-25\">Saturday 25 Juli</option>\r\n            <option value=\"2020-07-26\">Sunday 26 Juli</option>\r\n        </select>\r\n\r\n   \r\n\r\n        <table id=\"avaibleTabel\" border=\"1\" width=\"425\">\r\n          <tr>\r\n            <th>\r\n              Session 1\r\n            </th>\r\n            <th>\r\n              Session 2\r\n            </th>\r\n            <th>\r\n              Session 3\r\n            </th>\r\n          </tr>\r\n          <tr>\r\n            <td>\r\n           \r\n            </td>\r\n            <td>\r\n       \r\n            </td>\r\n            <td>\r\n          \r\n            </td>\r\n          </tr>\r\n    <tr>\r\n            <td>\r\n\r\n            </td>\r\n            <td>\r\n\r\n            </td>\r\n            <td>\r\n\r\n            </td>\r\n        </tr>\r\n        </table>\r\n\r\n'),
(203, 'Restaurant Specktakel', '\r\n                <h1>Restaurant Specktakel </h1>\r\n              \r\n                <p>\r\n                    About the restaurant: <a href=\"https://specktakel.nl/\"> specktakel.nl</a><br>\r\n                    <br>\r\n                    Kitchen: Specktakel is a 3 star Europees, Internationaal, Aziatisch restaurant.<br>\r\n                    <br>\r\n                    Prices: A reservation fee of &euro;10,- per person wil be charged. <br>\r\n                    This fee will be deducted from the final check on visiting the restaurant.<br>\r\n                    <br>\r\n                    The restaurant prices:<br>\r\n                    Regular ticket: &euro;35,00*<br>\r\n                    Kids ticket: &euro;17,50*<br>\r\n                    <br>\r\n                    * Total price = reservation fees + meal costs(13+: &euro;35,- , child: &euro;17,50)<br>\r\n                    Beverage costs are not included in the total price.<br>\r\n                    Meal costs must be paid in the restaurant.<br>\r\n                    <br>\r\n                    Adres: Spekstraat 4, 2011 HM Haarlem, Netherlands<br>\r\n                </p>\r\n            </article>\r\n\r\n\r\n            <iframe class=\"food_location\" width=\"425\" height=\"350\" frameborder=\"1\"\r\n                    src=\"https://maps.google.com/maps?q=restaurant%20specktakel&t=&z=13&ie=UTF8&iwloc=&output=embed\"\r\n                    frameborder=\"0\" scrolling=\"no\" marginheight=\"0\" marginwidth=\"0\">\r\n            </iframe>\r\n\r\n   <section class=\"food_avaibility\">\r\n        <h2>Restaurant availabilty:</h2>\r\n        Date:\r\n    \r\n       \r\n        <select id=\"date\" onchange=\"date()\">\r\n            <option value=\"2020-07-23\">Thursday 23 Juli</option>\r\n            <option value=\"2020-07-24\">Friday 24 Juli</option>\r\n            <option value=\"2020-07-25\">Saturday 25 Juli</option>\r\n            <option value=\"2020-07-26\">Sunday 26 Juli</option>\r\n        </select>\r\n\r\n   \r\n\r\n        <table id=\"avaibleTabel\" border=\"1\" width=\"425\">\r\n          <tr>\r\n            <th>\r\n              Session 1\r\n            </th>\r\n            <th>\r\n              Session 2\r\n            </th>\r\n            <th>\r\n              Session 3\r\n            </th>\r\n          </tr>\r\n          <tr>\r\n            <td>\r\n  \r\n            </td>\r\n            <td>\r\n      \r\n            </td>\r\n            <td>\r\n         \r\n            </td>\r\n          </tr>\r\n    <tr>\r\n            <td>\r\n\r\n            </td>\r\n            <td>\r\n\r\n            </td>\r\n            <td>\r\n\r\n            </td>\r\n        </tr>\r\n        </table>\r\n'),
(204, 'Grand café Brinkmann', '\r\n                <h1>Grand café Brinkmann </h1>\r\n\r\n                <p>\r\n                    About the restaurant: <a href=\"http://www.grandcafebrinkmann.nl/\"> grandcafebrinkman.nl</a><br>\r\n                    <br>\r\n                    Kitchen: Grand cafe Brinkman is a 3 star Dutch, European, Modern restaurant.<br>\r\n                    <br>\r\n                    Prices: A reservation fee of &euro;10,- per person wil be charged. <br>\r\n                    This fee will be deducted from the final check on visiting the restaurant.<br>\r\n                    <br>\r\n                    The restaurant prices:<br>\r\n                    Regular ticket: &euro;35,00*<br>\r\n                    Kids ticket: &euro;17,50*<br>\r\n                    <br>\r\n                    * Total price = reservation fees + meal costs(13+: &euro;35,- , child: &euro;17,50)<br>\r\n                    Beverage costs are not included in the total price.<br>\r\n                    Meal costs must be paid in the restaurant.<br>\r\n                    <br>\r\n                    Adres: Grote Markt 13, 2011 RC Haarlem, Netherlands<br>\r\n                </p>\r\n            </article>\r\n            <iframe class=\"food_location\" width=\"425\" height=\"350\" frameborder=\"1\"\r\n                    src=\"https://maps.google.com/maps?q=grand%20cafe%20brinkman&t=&z=13&ie=UTF8&iwloc=&output=embed\"\r\n                    frameborder=\"0\" scrolling=\"no\" marginheight=\"0\" marginwidth=\"0\">\r\n            </iframe>\r\n   <section class=\"food_avaibility\">\r\n        <h2>Restaurant availabilty:</h2>\r\n        Date:\r\n    \r\n       <select id=\"date\" onchange=\"date()\">\r\n            <option value=\"2020-07-23\">Thursday 23 Juli</option>\r\n            <option value=\"2020-07-24\">Friday 24 Juli</option>\r\n            <option value=\"2020-07-25\">Saturday 25 Juli</option>\r\n            <option value=\"2020-07-26\">Sunday 26 Juli</option>\r\n        </select>\r\n\r\n   \r\n\r\n        <table id=\"avaibleTabel\" border=\"1\" width=\"425\">\r\n          <tr>\r\n            <th>\r\n              Session 1\r\n            </th>\r\n            <th>\r\n              Session 2\r\n            </th>\r\n            <th>\r\n              Session 3\r\n            </th>\r\n          </tr>\r\n          <tr>\r\n            <td>\r\n      \r\n            </td>\r\n            <td>\r\n       \r\n            </td>\r\n            <td>\r\n        \r\n            </td>\r\n          </tr>\r\n    <tr>\r\n            <td>\r\n\r\n            </td>\r\n            <td>\r\n\r\n            </td>\r\n            <td>\r\n\r\n            </td>\r\n        </tr>\r\n        </table>\r\n\r\n\r\n'),
(205, 'Restaurant Urban frenchy bistro toujours', '\r\n                <h1>Restaurant Urban frenchy bistro toujours </h1>\r\n\r\n                <p>\r\n                    About the restaurant: <a href=\"http://restauranttoujours.nl/\"> restauranttoujoers.nl</a><br>\r\n                    <br>\r\n                    Kitchen: Urban frenchy bistro toujours is a 3 star Dutch, fish and seafood, European restaurant.<br>\r\n                    <br>\r\n                    Prices: A reservation fee of &euro;10,- per person wil be charged. <br>\r\n                    This fee will be deducted from the final check on visiting the restaurant.<br>\r\n                    <br>\r\n                    The restaurant prices are:<br>\r\n                    Regular ticket: &euro;35,00*<br>\r\n                    Kids ticket: &euro;17,50*<br>\r\n                    <br>\r\n                    * Total price = reservation fees + meal costs(13+: &euro;35,- , child: &euro;17,50)<br>\r\n                    Beverage costs are not included in the total price.<br>\r\n                    Meal costs must be paid in the restaurant.<br>\r\n                    <br>\r\n                    Adres: Oude Groenmarkt 10-12, 2011 HL Haarlem, Netherlands<br>\r\n                </p>\r\n            </article>\r\n            <iframe class=\"food_location\" width=\"425\" height=\"350\" frameborder=\"1\"\r\n                    src=\"https://maps.google.com/maps?q=urban%20frenchy%20toujoers%20haarlem&t=&z=13&ie=UTF8&iwloc=&output=embed\"\r\n                    frameborder=\"0\" scrolling=\"no\" marginheight=\"0\" marginwidth=\"0\">\r\n            </iframe>\r\n   <section class=\"food_avaibility\">\r\n        <h2>Restaurant availabilty:</h2>\r\n        Date:\r\n    \r\n          <select id=\"date\" onchange=\"date()\">\r\n            <option value=\"2020-07-23\">Thursday 23 Juli</option>\r\n            <option value=\"2020-07-24\">Friday 24 Juli</option>\r\n            <option value=\"2020-07-25\">Saturday 25 Juli</option>\r\n            <option value=\"2020-07-26\">Sunday 26 Juli</option>\r\n        </select>\r\n\r\n   \r\n\r\n        <table id=\"avaibleTabel\" border=\"1\" width=\"425\">\r\n          <tr>\r\n            <th>\r\n              Session 1\r\n            </th>\r\n            <th>\r\n              Session 2\r\n            </th>\r\n            <th>\r\n              Session 3\r\n            </th>\r\n          </tr>\r\n          <tr>\r\n            <td>\r\n  \r\n            </td>\r\n            <td>\r\n         \r\n            </td>\r\n            <td>\r\n    \r\n            </td>\r\n          </tr>\r\n    <tr>\r\n            <td>\r\n\r\n            </td>\r\n            <td>\r\n\r\n            </td>\r\n            <td>\r\n\r\n            </td>\r\n        </tr>\r\n        </table>\r\n\r\n'),
(206, 'Steakhouse The golden bull', '\r\n                <h1>Steakhouse The golden bull </h1>\r\n\r\n                <p>\r\n                    About the restaurant: <a href=\"http://thegoldenbull.nl/\"> thegoldenbull.nl</a><br>\r\n                    <br>\r\n                    Kitchen: The golden bull is a 3 star Steakhouse, Argentinian, European restaurant.<br>\r\n                    <br>\r\n                    Prices: A reservation fee of &euro;10,- per person wil be charged. <br>\r\n                    This fee will be deducted from the final check on visiting the restaurant.<br>\r\n                    <br>\r\n                    The restaurant prices are:<br>\r\n                    Regular ticket: &euro;35,00*<br>\r\n                    Kids ticket: &euro;17,50*<br>\r\n                    <br>\r\n                    * Total price = reservation fees + meal costs(13+: &euro;35,- , child: &euro;17,50)<br>\r\n                    Beverage costs are not included in the total price.<br>\r\n                    Meal costs must be paid in the restaurant.<br>\r\n                    <br>\r\n                    Adres: Zijlstraat 39, 2011 TK Haarlem, Netherlands<br>\r\n                </p>\r\n            </article>\r\n            <iframe class=\"food_location\" width=\"425\" height=\"350\" frameborder=\"1\"\r\n                    src=\"https://maps.google.com/maps?q=the%20golden%20bull&t=&z=13&ie=UTF8&iwloc=&output=embed\"\r\n                    frameborder=\"0\" scrolling=\"no\" marginheight=\"0\" marginwidth=\"0\">\r\n            </iframe>\r\n   <section class=\"food_avaibility\">\r\n        <h2>Restaurant availabilty:</h2>\r\n        Date:\r\n    \r\n        <select id=\"date\" onchange=\"date()\">\r\n            <option value=\"2020-07-23\">Thursday 23 Juli</option>\r\n            <option value=\"2020-07-24\">Friday 24 Juli</option>\r\n            <option value=\"2020-07-25\">Saturday 25 Juli</option>\r\n            <option value=\"2020-07-26\">Sunday 26 Juli</option>\r\n        </select>\r\n\r\n   \r\n\r\n        <table id=\"avaibleTabel\" border=\"1\" width=\"425\">\r\n          <tr>\r\n            <th>\r\n              Session 1\r\n            </th>\r\n            <th>\r\n              Session 2\r\n            </th>\r\n            <th>\r\n              Session 3\r\n            </th>\r\n          </tr>\r\n          <tr>\r\n            <td>\r\n       \r\n            </td>\r\n            <td>\r\n         \r\n            </td>\r\n            <td>\r\n   \r\n            </td>\r\n          </tr>\r\n    <tr>\r\n            <td>\r\n\r\n            </td>\r\n            <td>\r\n\r\n            </td>\r\n            <td>\r\n\r\n            </td>\r\n        </tr>\r\n        </table>\r\n\r\n\r\n'),
(207, 'Restaurant ML', '\r\n                <h1>Restaurant ML </h1>\r\n\r\n                <p>\r\n                    About the restaurant: <a href=\"https://www.mlinhaarlem.nl/\">mlinhaarlem.nl</a><br>\r\n                    <br>\r\n                    Kitchen: Restaurant ML is a 4 star Dutch, fish and seafood, European restaurant.<br>\r\n                    <br>\r\n                    Prices: A reservation fee of &euro;10,- per person wil be charged. <br>\r\n                    This fee will be deducted from the final check on visiting the restaurant.<br>\r\n                    <br>\r\n                    The restaurants prices are:<br>\r\n                    Regular ticket: &euro;45,00*<br>\r\n                    Kids ticket: &euro;22,50*<br>\r\n                    <br>\r\n                    * Total price = reservation fees + meal costs(13+: &euro;45,- , child: &euro;22,50)<br>\r\n                    Beverage costs are not included in the total price.<br>\r\n                    Meal costs must be paid in the restaurant.<br>\r\n                    <br>\r\n                    Adres: Klokhuisplein 9, 2011 CK Haarlem, Netherlands.<br>\r\n                </p>\r\n            </article>\r\n            <iframe class=\"food_location\" width=\"425\" height=\"350\" frameborder=\"1\"\r\n                    src=\"https://maps.google.com/maps?q=%20restaurant%20ml%20haarlem&t=&z=13&ie=UTF8&iwloc=&output=embed\"\r\n                    frameborder=\"0\" scrolling=\"no\" marginheight=\"0\" marginwidth=\"0\">\r\n            </iframe>\r\n   <section class=\"food_avaibility\">\r\n        <h2>Restaurant availabilty:</h2>\r\n        Date:\r\n    \r\n       \r\n        <select id=\"date\" onchange=\"date()\">\r\n            <option value=\"2020-07-23\">Thursday 23 Juli</option>\r\n            <option value=\"2020-07-24\">Friday 24 Juli</option>\r\n            <option value=\"2020-07-25\">Saturday 25 Juli</option>\r\n            <option value=\"2020-07-26\">Sunday 26 Juli</option>\r\n        </select>\r\n   \r\n\r\n        <table id=\"avaibleTabel\" border=\"1\" width=\"425\">\r\n          <tr>\r\n            <th>\r\n              Session 1\r\n            </th>\r\n            <th>\r\n              Session 2\r\n            </th>\r\n          </tr>\r\n          <tr>\r\n            <td>\r\n\r\n            </td>\r\n            <td>\r\n\r\n            </td>\r\n          </tr>\r\n    <tr>\r\n            <td>\r\n\r\n            </td>\r\n            <td>\r\n\r\n            </td>\r\n        </tr>\r\n        </table>\r\n\r\n');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `password_reset`
--

CREATE TABLE `password_reset` (
  `resetId` int(11) NOT NULL,
  `resetEmail` text NOT NULL,
  `resetSelector` text NOT NULL,
  `resetToken` longtext NOT NULL,
  `resetExpires` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `photo`
--

CREATE TABLE `photo` (
  `id` int(11) NOT NULL,
  `category` enum('GENERAL','DANCE','FOOD','HISTORIC','JAZZ','CMS') NOT NULL,
  `url` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `photo`
--

INSERT INTO `photo` (`id`, `category`, `url`) VALUES
(200, 'FOOD', '/img/food/mr.mrs.jpg'),
(201, 'FOOD', '/img/food/ratatouille.jpg'),
(202, 'FOOD', '/img/food/ml.jpg'),
(203, 'FOOD', '/img/food/fris.jpg'),
(204, 'FOOD', '/img/food/specktakel.jpg'),
(205, 'FOOD', '/img/food/brinkman.jpg'),
(206, 'FOOD', '/img/food/toujoers.png'),
(207, 'FOOD', '/img/food/goldenbull.jpg'),
(300, 'HISTORIC', '/historic/bavokerk1.jpg'),
(301, 'HISTORIC', '/historic/bavokerk2.jpg'),
(302, 'HISTORIC', '/historic/grotemarkt1.jpg'),
(303, 'HISTORIC', '/historic/grotemarkt2.jpg'),
(304, 'HISTORIC', '/historic/dehallen1.jpg'),
(305, 'HISTORIC', '/historic/dehallen2.jpg'),
(306, 'HISTORIC', '/historic/proveniershof1.jpg'),
(307, 'HISTORIC', '/historic/proveniershof2.jpg'),
(308, 'HISTORIC', '/historic/jopenkerk1.jpg'),
(309, 'HISTORIC', '/historic/jopenkerk2.jpg'),
(310, 'HISTORIC', '/historic/waalsekerk1.jpg'),
(311, 'HISTORIC', '/historic/waalsekerk2.jpg'),
(312, 'HISTORIC', '/historic/molendeadriaan1.jpg'),
(313, 'HISTORIC', '/historic/molendeadriaan2.jpg'),
(314, 'HISTORIC', '/historic/amsterdamsepoort1.jpg'),
(315, 'HISTORIC', '/historic/amsterdamsepoort2.jpg'),
(316, 'HISTORIC', '/historic/hofvanbakenes1.jpg'),
(317, 'HISTORIC', '/historic/hofvanbakenes2.jpg'),
(318, 'HISTORIC', '/historic/haarlem1.jpg'),
(319, 'HISTORIC', '/historic/haarlem2.jpg'),
(320, 'HISTORIC', '/historic/haarlem3.jpg');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `restaurant`
--

CREATE TABLE `restaurant` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `kitchen1` int(11) NOT NULL,
  `kitchen2` int(11) DEFAULT NULL,
  `stars` int(11) NOT NULL,
  `price` float NOT NULL,
  `address` varchar(255) NOT NULL,
  `info_page` int(11) NOT NULL,
  `rest_img` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `restaurant`
--

INSERT INTO `restaurant` (`id`, `name`, `kitchen1`, `kitchen2`, `stars`, `price`, `address`, `info_page`, `rest_img`) VALUES
(1, 'Restaurant Mr. & Mrs.', 1, 5, 4, 10, 'Lange Veerstraat 4, 2011 DB Haarlem, Nederland', 200, 200),
(2, 'Ratatouilles', 2, 5, 4, 10, 'Spaarne 96, 2011 CL Haarlem, Nederland', 201, 201),
(3, 'Restaurant ML', 1, 5, 4, 10, 'Klokhuisplein 9, 2011 CK Haarlem, Netherlands', 207, 202),
(4, 'Restaurant Fris', 1, 2, 4, 10, 'Twijnderslaan 7, 2012 BG Haarlem, Nederland', 202, 203),
(5, 'Specktakel', 3, NULL, 3, 10, 'Spekstraat 4, 2011 HM Haarlem, Nederland', 203, 204),
(6, 'Grand Cafe Brinkman', 1, NULL, 3, 10, 'Grote Markt 13, 2011 RC Haarlem, Nederland', 204, 205),
(7, 'Urban Frenchy Bistro Toujours', 1, 5, 3, 10, 'Oude Groenmarkt 10-12, 2011 HL Haarlem, Nederland', 205, 206),
(8, 'The Golden Bull', 4, 6, 3, 10, 'Zijlstraat 39, 2011 TK Haarlem, Nederland', 206, 207);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `snippets`
--

CREATE TABLE `snippets` (
  `snippet_id` int(11) NOT NULL,
  `snippet_page` varchar(255) NOT NULL,
  `snippet_name` varchar(255) NOT NULL,
  `snippet_text` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `snippets`
--

INSERT INTO `snippets` (`snippet_id`, `snippet_page`, `snippet_name`, `snippet_text`) VALUES
(1, 'haarlem_about', 'about_p1', 'Haarlem is a city and municipality in the Netherlands. It is the capital of the province of North Holland and is situated at the northern edge of the Randstad, one of the most populated metropolitan areas in Europe.Haarlem has a rich history dating back to pre-medieval times. Haarlem became wealthy with toll revenues that it collected from ships and travellers moving on the busy North-South route. However, as shipping became increasingly important economically, the city of Amsterdam became the main Dutch city of North Holland during the Dutch Golden Age. The town of Halfweg became a suburb, and Haarlem became a quiet bedroom community, and for this reason Haarlem still has many of its central medieval buildings intact. Nowadays many of them are on the Dutch Heritage register known as Rijksmonuments.'),
(2, 'haarlem_about', 'about_p2', 'The city is located on the river Spaarne, giving it its nickname &#39;Spaarnestad&#39; (Spaarne city). It is situated about 20 km (12 mi) west of Amsterdam and near the coastal dunes. Haarlem has been the historical centre of the tulip bulb-growing district for centuries and bears its other nickname &#39;Bloemenstad&#39; (flower city) for this reason.\\r\\n\\r\\nBeer brewing has been a very important industry for Haarlem going back to the 15th century, when there were no fewer than 100 breweries in the city. When the town&#39;s 750th anniversary was celebrated in 1995 a group of enthusiasts re-created an original Haarlem beer and brewed it again. The beer is called Jopenbier, or Jopen for short, named after an old type of beer barrel.&#39;)'),
(3, 'haarlem_about', 'about_p3', 'In 1658, Peter Stuyvesant, the Director-General of the Dutch colony of Nieuw Nederland (New Netherland), founded the settlement of Nieuw Haarlem in the northern part of Manhattan Island as an outpost of Nieuw Amsterdam (New Amsterdam) at the southern tip of the island.\r\n\r\nAfter the English capture of New Netherland in 1664, the new English colonial administration renamed both the colony and its principal city \"New York,\" but left the name of Haarlem more or less unchanged. The spelling changed to Harlem in keeping with contemporary English usage, and the district grew (as part of the borough of Manhattan) into the vibrant centre of African American culture in New York City and the United States generally by the 20th century.'),
(4, 'haarlem_route', 'intro_text', 'Post your own pictures on Instagram, along with the hashtags #HaarlemHistoric and #HaarlemFestival, and you might win a dinner for two at one of our partner restaurants!'),
(5, 'haarlem_route', 'intro_titel', '#HaarlemHistoric'),
(6, 'haarlem_food', 'intro_title', 'Haarlem culinaire is al about the culiniare activity!'),
(7, 'haarlem_food', 'intro_text', 'During the festival, multiple restaurant participate to show their culinair style. Each restaurant has serveral sessions a day that are bookable. It&#39;s a great opportunity to have a nice evening and explore the special cuisines with your friend(s), husband, kids or familiy.');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `style`
--

CREATE TABLE `style` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `style`
--

INSERT INTO `style` (`id`, `name`) VALUES
(1, 'Dance and house'),
(2, 'Dance / electronic'),
(3, 'Trance and techno'),
(4, 'trance,  techno, minimal, house and electro'),
(5, 'electrohouse/ progressive house'),
(6, 'house');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `ticket`
--

CREATE TABLE `ticket` (
  `id` int(11) NOT NULL,
  `event_id` int(11) NOT NULL,
  `ticket_type` int(11) NOT NULL,
  `ticket_price` float NOT NULL,
  `buyer_email` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `ticket`
--

INSERT INTO `ticket` (`id`, `event_id`, `ticket_type`, `ticket_price`, `buyer_email`) VALUES
(1, 300, 300, 17.5, 'sjf.de.jong@gmail.com'),
(2, 301, 300, 17.5, 'sjf.de.jong@gmail.com'),
(3, 301, 300, 17.5, 'sjf.de.jong@gmail.com'),
(4, 200, 200, 10, 'sjf.de.jong@gmail.com'),
(5, 300, 300, 17.5, 'sjf.de.jong@gmail.com'),
(6, 300, 300, 17.5, 'sjf.de.jong@gmail.com'),
(7, 224, 200, 10, 'sjf.de.jong@gmail.com'),
(8, 224, 200, 10, 'sjf.de.jong@gmail.com'),
(9, 300, 300, 17.5, 'sjf.de.jong@gmail.com'),
(10, 225, 200, 10, 'pascalle.schipper@me.com'),
(11, 225, 200, 10, 'pascalle.schipper@me.com'),
(12, 225, 200, 10, 'pascalle.schipper@me.com'),
(13, 224, 200, 10, 'pascalle.schipper@me.com'),
(14, 224, 200, 10, 'pascalle.schipper@me.com'),
(15, 224, 201, 10, 'pascalle.schipper@me.com'),
(16, 300, 300, 17.5, 'sjf.de.jong@gmail.com'),
(22, 300, 300, 17.5, 'tombouderij@hotmail.com');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `tickettype`
--

CREATE TABLE `tickettype` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `tickettype`
--

INSERT INTO `tickettype` (`id`, `name`, `price`) VALUES
(101, 'dance_ticket_101', 75),
(102, 'dance_ticket_102', 60),
(103, 'dance_ticket_103', 60),
(104, 'dance_ticket_104', 60),
(105, 'dance_ticket_105', 60),
(106, 'dance_ticket_106', 110),
(107, 'dance_ticket_107', 60),
(108, 'dance_ticket_108', 75),
(109, 'dance_ticket_109', 60),
(110, 'dance_ticket_110', 110),
(111, 'dance_ticket_111', 60),
(112, 'dance_ticket_112', 90),
(113, 'dance_ticket_113', 60),
(114, 'all_access_fri', 125),
(116, 'all_access_sun', 150),
(117, 'all_access_all', 250),
(120, 'all_access_sat', 150),
(200, 'food_regular', 10),
(201, 'food_kids', 10),
(300, 'historic_single_ticket', 17.5),
(301, 'historic_fam_ticket', 60);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `tourlocation`
--

CREATE TABLE `tourlocation` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `tourlocation`
--

INSERT INTO `tourlocation` (`id`, `name`, `description`) VALUES
(1, 'Bavo Kerk', 'This church is an important landmark for the city of Haarlem and has dominated the city skyline for centuries. It is built in the Gothic style of architecture, and it became the main church of Haarlem after renovations in the 15th century made it significantly larger than the Janskerk (Haarlem)'),
(2, 'Grote Markt', 'In the great market place in the centre of the city are gathered together a large number of the most interesting buildings, including the quaint old fleshers\' hall, the town hall, the old Stadsdoelen and the Great Church.'),
(3, 'De Hallen', 'De Hallen is  one of the two locations of the Frans Hals Museum, located on the Grote Markt, Haarlem, Netherlands, where modern and contemporary art is on display in alternating presentations. The museum consists of three different buildings, all of which are National Heritage sites today.'),
(4, 'Proveniershof', 'The Proveniershuis is a hofje (courtyard) and former schutterij (citizen militia) on the Grote Houtstraat. The complex of buildings surrounds a rectangular garden taking up a city block that is on the Haarlem hofje route. Unlike other hofjes, the homes around this courtyard are much larger, and the garden itself is about twice the normal size.'),
(5, 'Jopen Kerk', 'The old Jacobs church houses the Jopen beer brewery since 2010, together with a café and restaurant. The name Jopen refers to the 112 litre beer barrels that were used in early times to transport the Haarlem beer. Two recipes, dating from 1407, were found in the Haarlem city archives and were used as a foundation for two initial beers. '),
(6, 'Waalse Kerk', 'The Waalse kerk is a Walloon church that was built in the middle of the 14th century. The sacristy dates from the 16th century, with wooden arches and a mantel from the 17th century. The organ was built in 1808, and in the attic there is a mechanical clock that drives the hands on the clock of the organ.'),
(7, 'Molen de Adriaan', 'De Adriaan is a windmill in the Netherlands that burnt down in 1932 and was rebuilt in 2002. The original windmill dates from 1779 and the mill has been a distinctive part of the skyline of Haarlem for centuries. The windmill is fully functional, and is capable of grinding grain. Inside the windmill is a small museum, and the interior can be seen.'),
(8, 'Amsterdamse Poort', 'The Amsterdamse Poort is an old city gate of Haarlem, Netherlands. It is located at the end of the old route from Amsterdam to Haarlem and the only gate left from the original twelve city gates. This gate, for those travelling by land, was called the Spaarnwouderpoort. With the new canal and its towpath, the trip was so short, it became much more popular, since it was now possible to travel back and forth to Amsterdam on the same day. Thus the name of the gate changed to Amsterdamse Poort.'),
(9, 'Hof van Bakenes', 'The hofje was founded from the legacy of Dirck van Bakenes (or Dirc van Bakenesse) in 1395. This makes it the oldest hofje in the Netherlands. The earliest mention of it in town records is from the History of Haarlem by Samuel Ampzing in 1628, who claims to have copied the letter of foundation (since lost).  Originally 13 houses for 20 women, one house was redesigned as a regent\'s room in 1663.');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('USER','ADMIN','SUPERADMIN') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `user`
--

INSERT INTO `user` (`id`, `firstname`, `lastname`, `email`, `password`, `role`) VALUES
(5, 'thijs', 'otter', 'thijs@otter.comm', '098f6bcd4621d373cade4e832627b4f6', 'ADMIN'),
(9, 'pieter', 'pietersen', 'pieter@pietersen.comm', '098f6bcd4621d373cade4e832627b4f6', 'USER'),
(15, 'tom', 'bo', 'tom@bo.comm', '098f6bcd4621d373cade4e832627b4f6', 'USER');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Gegevens worden geëxporteerd voor tabel `users`
--

INSERT INTO `users` (`id`, `firstname`, `lastname`) VALUES
(1, 'firstname', 'lastname'),
(2, 'tom', 'bouderij');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `venue`
--

CREATE TABLE `venue` (
  `id` int(11) NOT NULL,
  `venue_name` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `venue`
--

INSERT INTO `venue` (`id`, `venue_name`, `address`) VALUES
(1, 'Lichtfabriek', 'Minckelersweg 2'),
(2, 'Club Stalker', ' Kromme Elleboogsteeg 20'),
(3, 'Jopenkerk', 'Gedempte Voldersgracht 2'),
(4, 'XO The Club', 'Grote Markt 8'),
(5, 'Club Ruis', 'Smedestraat 31'),
(6, 'Carpera Openluchttheater', ' Hoge Duin en Daalseweg 2');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `volunteersnippet`
--

CREATE TABLE `volunteersnippet` (
  `id` int(11) NOT NULL,
  `text` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Gegevens worden geëxporteerd voor tabel `volunteersnippet`
--

INSERT INTO `volunteersnippet` (`id`, `text`) VALUES
(1, 'Want to help out with the festival? Volunteer! Being a volunteer at Haarlem Festival is a great way to get some people experience. A lot of different people attend Haarlem Festival, so you will get to meet a lot of different people with different needs. For Haarlem Festival activities you can help with, but are not limited to: Ticket sales, Guiding tours, Setting up the venues, Providing beverages to our guests. If this sounds interesting to you, please fill out the form below:');

--
-- Indexen voor geëxporteerde tabellen
--

--
-- Indexen voor tabel `artist`
--
ALTER TABLE `artist`
  ADD PRIMARY KEY (`artist_id`);

--
-- Indexen voor tabel `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `event`
--
ALTER TABLE `event`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `eventtype`
--
ALTER TABLE `eventtype`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `guide`
--
ALTER TABLE `guide`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `historicevent`
--
ALTER TABLE `historicevent`
  ADD KEY `language` (`language`),
  ADD KEY `guide` (`guide`);

--
-- Indexen voor tabel `language`
--
ALTER TABLE `language`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `page`
--
ALTER TABLE `page`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `password_reset`
--
ALTER TABLE `password_reset`
  ADD PRIMARY KEY (`resetId`);

--
-- Indexen voor tabel `photo`
--
ALTER TABLE `photo`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `restaurant`
--
ALTER TABLE `restaurant`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `snippets`
--
ALTER TABLE `snippets`
  ADD PRIMARY KEY (`snippet_id`);

--
-- Indexen voor tabel `style`
--
ALTER TABLE `style`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `ticket`
--
ALTER TABLE `ticket`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `tickettype`
--
ALTER TABLE `tickettype`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `tourlocation`
--
ALTER TABLE `tourlocation`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `venue`
--
ALTER TABLE `venue`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `volunteersnippet`
--
ALTER TABLE `volunteersnippet`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT voor geëxporteerde tabellen
--

--
-- AUTO_INCREMENT voor een tabel `artist`
--
ALTER TABLE `artist`
  MODIFY `artist_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT voor een tabel `customer`
--
ALTER TABLE `customer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT voor een tabel `event`
--
ALTER TABLE `event`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=329;

--
-- AUTO_INCREMENT voor een tabel `eventtype`
--
ALTER TABLE `eventtype`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT voor een tabel `guide`
--
ALTER TABLE `guide`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT voor een tabel `language`
--
ALTER TABLE `language`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT voor een tabel `page`
--
ALTER TABLE `page`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=208;

--
-- AUTO_INCREMENT voor een tabel `password_reset`
--
ALTER TABLE `password_reset`
  MODIFY `resetId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT voor een tabel `photo`
--
ALTER TABLE `photo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=321;

--
-- AUTO_INCREMENT voor een tabel `restaurant`
--
ALTER TABLE `restaurant`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=208;

--
-- AUTO_INCREMENT voor een tabel `snippets`
--
ALTER TABLE `snippets`
  MODIFY `snippet_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT voor een tabel `style`
--
ALTER TABLE `style`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT voor een tabel `ticket`
--
ALTER TABLE `ticket`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT voor een tabel `tickettype`
--
ALTER TABLE `tickettype`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=302;

--
-- AUTO_INCREMENT voor een tabel `tourlocation`
--
ALTER TABLE `tourlocation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT voor een tabel `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT voor een tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT voor een tabel `venue`
--
ALTER TABLE `venue`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT voor een tabel `volunteersnippet`
--
ALTER TABLE `volunteersnippet`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Beperkingen voor geëxporteerde tabellen
--

--
-- Beperkingen voor tabel `historicevent`
--
ALTER TABLE `historicevent`
  ADD CONSTRAINT `historicevent_ibfk_1` FOREIGN KEY (`language`) REFERENCES `language` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `historicevent_ibfk_2` FOREIGN KEY (`guide`) REFERENCES `guide` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
