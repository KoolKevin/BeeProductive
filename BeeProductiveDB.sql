-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Creato il: Giu 10, 2020 alle 13:26
-- Versione del server: 8.0.13-4
-- Versione PHP: 7.2.24-0ubuntu0.18.04.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sgW8ictJ0S`
--

-- --------------------------------------------------------

--
-- Struttura della tabella `eventi`
--

CREATE TABLE `eventi` (
  `id` int(11) NOT NULL,
  `fk_id_utente_id` int(11) NOT NULL,
  `fk_id_progetto_id` int(11) DEFAULT NULL,
  `start_date` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `titolo` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `priorita` int(11) NOT NULL,
  `end_date` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `completato` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struttura della tabella `migration_versions`
--

CREATE TABLE `migration_versions` (
  `version` varchar(14) COLLATE utf8mb4_unicode_ci NOT NULL,
  `executed_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dump dei dati per la tabella `migration_versions`
--

INSERT INTO `migration_versions` (`version`, `executed_at`) VALUES
('20200430145905', '2020-04-30 14:59:36'),
('20200430150734', '2020-04-30 15:08:26'),
('20200430150746', '2020-04-30 15:17:21'),
('20200430151243', '2020-04-30 15:13:07'),
('20200430151713', '2020-05-13 08:20:48'),
('20200430151837', '2020-04-30 15:18:47'),
('20200506144246', '2020-05-06 14:43:03'),
('20200507124713', '2020-05-07 12:47:32');

-- --------------------------------------------------------

--
-- Struttura della tabella `priorita`
--

CREATE TABLE `priorita` (
  `id` int(11) NOT NULL,
  `nome` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `colore` varchar(45) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dump dei dati per la tabella `priorita`
--

INSERT INTO `priorita` (`id`, `nome`, `colore`) VALUES
(1, 'easy', '#51f542'),
(2, 'a volte fa male', '#d4f542'),
(3, 'grave', '#ffd500'),
(4, 'greve', '#ff9d00'),
(5, 'graves', '#ff1100');

-- --------------------------------------------------------

--
-- Struttura della tabella `progetti`
--

CREATE TABLE `progetti` (
  `id` int(11) NOT NULL,
  `titolo` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `start_date` longtext COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '(DC2Type:object)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struttura della tabella `statistiche`
--

CREATE TABLE `statistiche` (
  `id` int(11) NOT NULL,
  `fk_id_evento` int(11) NOT NULL,
  `titolo_evento` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `completion_date` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `durata` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dump dei dati per la tabella `statistiche`
--

INSERT INTO `statistiche` (`id`, `fk_id_evento`, `titolo_evento`, `completion_date`, `durata`) VALUES
(8, 81, 'prova', '2020-06-08', 3),
(10, 82, 'altro evento', '2020-06-09', 15);

-- --------------------------------------------------------

--
-- Struttura della tabella `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mail` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dump dei dati per la tabella `user`
--

INSERT INTO `user` (`id`, `username`, `mail`, `password`) VALUES
(1, 'LittleKidLover', 'moe.lester22@yahoo.com', '098f6bcd4621d373cade4e832627b4f6'),
(2, 'koolkevin', 'kevinkoltraka1011@gmail.com', '202cb962ac59075b964b07152d234b70'),
(13, 'utenteBello', 'utentebello@gmail.com', '1afbf3581a821aa0ac19abdbaada8e93'),
(14, 'utenteBrutto', 'utentebrutto@gmail.com', '202cb962ac59075b964b07152d234b70'),
(15, 'utenteBello', 'utentebello@gmail.com', 'caf1a3dfb505ffed0d024130f58c5cfa');

-- --------------------------------------------------------

--
-- Struttura della tabella `user_session`
--

CREATE TABLE `user_session` (
  `id` int(11) NOT NULL,
  `fk_id_user` int(11) NOT NULL,
  `sess_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `add_date` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dump dei dati per la tabella `user_session`
--

INSERT INTO `user_session` (`id`, `fk_id_user`, `sess_id`, `add_date`) VALUES
(1, 1, '22', NULL),
(2, 1, '22', NULL);

--
-- Indici per le tabelle scaricate
--

--
-- Indici per le tabelle `eventi`
--
ALTER TABLE `eventi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_AEE5AE30A715E314` (`fk_id_utente_id`),
  ADD KEY `IDX_AEE5AE30ECDBE49E` (`fk_id_progetto_id`);

--
-- Indici per le tabelle `migration_versions`
--
ALTER TABLE `migration_versions`
  ADD PRIMARY KEY (`version`);

--
-- Indici per le tabelle `priorita`
--
ALTER TABLE `priorita`
  ADD PRIMARY KEY (`id`);

--
-- Indici per le tabelle `progetti`
--
ALTER TABLE `progetti`
  ADD PRIMARY KEY (`id`);

--
-- Indici per le tabelle `statistiche`
--
ALTER TABLE `statistiche`
  ADD PRIMARY KEY (`id`);

--
-- Indici per le tabelle `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- Indici per le tabelle `user_session`
--
ALTER TABLE `user_session`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_8849CBDE899DB076` (`fk_id_user`);

--
-- AUTO_INCREMENT per le tabelle scaricate
--

--
-- AUTO_INCREMENT per la tabella `eventi`
--
ALTER TABLE `eventi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=86;

--
-- AUTO_INCREMENT per la tabella `priorita`
--
ALTER TABLE `priorita`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT per la tabella `progetti`
--
ALTER TABLE `progetti`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT per la tabella `statistiche`
--
ALTER TABLE `statistiche`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT per la tabella `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT per la tabella `user_session`
--
ALTER TABLE `user_session`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Limiti per le tabelle scaricate
--

--
-- Limiti per la tabella `eventi`
--
ALTER TABLE `eventi`
  ADD CONSTRAINT `FK_AEE5AE30A715E314` FOREIGN KEY (`fk_id_utente_id`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `FK_AEE5AE30ECDBE49E` FOREIGN KEY (`fk_id_progetto_id`) REFERENCES `progetti` (`id`);

--
-- Limiti per la tabella `user_session`
--
ALTER TABLE `user_session`
  ADD CONSTRAINT `FK_8849CBDE899DB076` FOREIGN KEY (`fk_id_user`) REFERENCES `user` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
