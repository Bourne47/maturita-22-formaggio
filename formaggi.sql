-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Creato il: Apr 23, 2025 alle 21:37
-- Versione del server: 10.4.32-MariaDB
-- Versione PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `formaggi`
--

-- --------------------------------------------------------

--
-- Struttura della tabella `caseifici`
--

CREATE TABLE `caseifici` (
  `id_c` int(11) NOT NULL,
  `id_4_cifre` char(4) NOT NULL,
  `psw` varchar(255) NOT NULL,
  `nome` varchar(150) NOT NULL,
  `indirizzo` varchar(255) NOT NULL,
  `comune` varchar(100) NOT NULL,
  `provincia` varchar(100) NOT NULL,
  `lat` decimal(9,6) NOT NULL,
  `lon` decimal(9,6) NOT NULL,
  `id_t` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `caseifici`
--

INSERT INTO `caseifici` (`id_c`, `id_4_cifre`, `psw`, `nome`, `indirizzo`, `comune`, `provincia`, `lat`, `lon`, `id_t`) VALUES
(1, 'A123', 'pass1234', 'Caseificio Alpino', 'Via Montagna 12', 'Trento', 'TN', 46.070000, 11.120000, 1),
(2, 'B456', 'formaggio!', 'Caseificio Pianura', 'Via Latte 45', 'Parma', 'PR', 44.800000, 10.330000, 2);

-- --------------------------------------------------------

--
-- Struttura della tabella `dati_latte`
--

CREATE TABLE `dati_latte` (
  `id_d` int(11) NOT NULL,
  `data` date NOT NULL,
  `qt_lav` decimal(10,2) NOT NULL CHECK (`qt_lav` >= 0),
  `qt_prod` decimal(10,2) NOT NULL CHECK (`qt_prod` >= 0),
  `id_c` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `dati_latte`
--

INSERT INTO `dati_latte` (`id_d`, `data`, `qt_lav`, `qt_prod`, `id_c`) VALUES
(1, '2025-04-20', 1200.50, 1100.00, 1),
(2, '2025-04-21', 1500.75, 1400.60, 2);

-- --------------------------------------------------------

--
-- Struttura della tabella `forme`
--

CREATE TABLE `forme` (
  `id_f` int(11) NOT NULL,
  `scelta` varchar(15) NOT NULL CHECK (`scelta` in ('prima','seconda')),
  `data_prod` date NOT NULL,
  `stagionatura` int(11) NOT NULL,
  `id_c` int(11) NOT NULL,
  `id_v` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `forme`
--

INSERT INTO `forme` (`id_f`, `scelta`, `data_prod`, `stagionatura`, `id_c`, `id_v`) VALUES
(3, 'prima', '2025-03-01', 60, 1, 1),
(4, 'seconda', '2025-03-15', 45, 2, 2);

-- --------------------------------------------------------

--
-- Struttura della tabella `immagini`
--

CREATE TABLE `immagini` (
  `id_m` int(11) NOT NULL,
  `path` varchar(255) NOT NULL,
  `descrizione` text DEFAULT NULL,
  `id_c` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struttura della tabella `titolari`
--

CREATE TABLE `titolari` (
  `id_t` int(11) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `cognome` varchar(50) NOT NULL,
  `email` varchar(80) NOT NULL,
  `telefono` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `titolari`
--

INSERT INTO `titolari` (`id_t`, `nome`, `cognome`, `email`, `telefono`) VALUES
(1, 'Mario', 'Rossi', 'mario.rossi@example.com', '3331234567'),
(2, 'Laura', 'Bianchi', 'laura.bianchi@example.com', '3337654321');

-- --------------------------------------------------------

--
-- Struttura della tabella `vendite`
--

CREATE TABLE `vendite` (
  `id_v` int(11) NOT NULL,
  `data_v` date NOT NULL,
  `nome` varchar(100) DEFAULT NULL,
  `tipo_acq` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `vendite`
--

INSERT INTO `vendite` (`id_v`, `data_v`, `nome`, `tipo_acq`) VALUES
(1, '2025-04-01', 'Supermercato X', 'Grande distribuzione'),
(2, '2025-04-10', 'Alimentari Gusto', 'privato');

--
-- Indici per le tabelle scaricate
--

--
-- Indici per le tabelle `caseifici`
--
ALTER TABLE `caseifici`
  ADD PRIMARY KEY (`id_c`),
  ADD UNIQUE KEY `id_4_cifre` (`id_4_cifre`),
  ADD KEY `id_t` (`id_t`);

--
-- Indici per le tabelle `dati_latte`
--
ALTER TABLE `dati_latte`
  ADD PRIMARY KEY (`id_d`),
  ADD KEY `id_c` (`id_c`);

--
-- Indici per le tabelle `forme`
--
ALTER TABLE `forme`
  ADD PRIMARY KEY (`id_f`),
  ADD KEY `fk_caseificio` (`id_c`),
  ADD KEY `fk_vendita` (`id_v`);

--
-- Indici per le tabelle `immagini`
--
ALTER TABLE `immagini`
  ADD PRIMARY KEY (`id_m`),
  ADD KEY `id_c` (`id_c`);

--
-- Indici per le tabelle `titolari`
--
ALTER TABLE `titolari`
  ADD PRIMARY KEY (`id_t`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `telefono` (`telefono`);

--
-- Indici per le tabelle `vendite`
--
ALTER TABLE `vendite`
  ADD PRIMARY KEY (`id_v`);

--
-- AUTO_INCREMENT per le tabelle scaricate
--

--
-- AUTO_INCREMENT per la tabella `caseifici`
--
ALTER TABLE `caseifici`
  MODIFY `id_c` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT per la tabella `dati_latte`
--
ALTER TABLE `dati_latte`
  MODIFY `id_d` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT per la tabella `forme`
--
ALTER TABLE `forme`
  MODIFY `id_f` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT per la tabella `immagini`
--
ALTER TABLE `immagini`
  MODIFY `id_m` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `titolari`
--
ALTER TABLE `titolari`
  MODIFY `id_t` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT per la tabella `vendite`
--
ALTER TABLE `vendite`
  MODIFY `id_v` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Limiti per le tabelle scaricate
--

--
-- Limiti per la tabella `caseifici`
--
ALTER TABLE `caseifici`
  ADD CONSTRAINT `caseifici_ibfk_1` FOREIGN KEY (`id_t`) REFERENCES `titolari` (`id_t`) ON UPDATE CASCADE;

--
-- Limiti per la tabella `dati_latte`
--
ALTER TABLE `dati_latte`
  ADD CONSTRAINT `dati_latte_ibfk_1` FOREIGN KEY (`id_c`) REFERENCES `caseifici` (`id_c`) ON UPDATE CASCADE;

--
-- Limiti per la tabella `forme`
--
ALTER TABLE `forme`
  ADD CONSTRAINT `fk_caseificio` FOREIGN KEY (`id_c`) REFERENCES `caseifici` (`id_c`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_vendita` FOREIGN KEY (`id_v`) REFERENCES `vendite` (`id_v`) ON UPDATE CASCADE;

--
-- Limiti per la tabella `immagini`
--
ALTER TABLE `immagini`
  ADD CONSTRAINT `immagini_ibfk_1` FOREIGN KEY (`id_c`) REFERENCES `caseifici` (`id_c`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
