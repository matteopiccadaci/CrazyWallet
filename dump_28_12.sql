-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Creato il: Dic 28, 2022 alle 11:22
-- Versione del server: 8.0.26
-- Versione PHP: 8.0.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `my_crazywallet`
--
CREATE DATABASE IF NOT EXISTS `my_crazywallet`;
USE `my_crazywallet`;

-- --------------------------------------------------------

--
-- Struttura della tabella `$2y$10$6bRjmdaZWQxIGi6mb58NqO14v3TnyMsBxQorOZDnyRJnRa1OR6VUy`
--

CREATE TABLE `$2y$10$6bRjmdaZWQxIGi6mb58NqO14v3TnyMsBxQorOZDnyRJnRa1OR6VUy` (
  `id_acquisto` int NOT NULL,
  `asset` varchar(256) NOT NULL,
  `quantita` int NOT NULL,
  `prezzo` float NOT NULL,
  `valore_acquisto` float NOT NULL
) ENGINE=MyISAM;

--
-- Dump dei dati per la tabella `$2y$10$6bRjmdaZWQxIGi6mb58NqO14v3TnyMsBxQorOZDnyRJnRa1OR6VUy`
--

INSERT INTO `$2y$10$6bRjmdaZWQxIGi6mb58NqO14v3TnyMsBxQorOZDnyRJnRa1OR6VUy` (`id_acquisto`, `asset`, `quantita`, `prezzo`, `valore_acquisto`) VALUES
(1, 'GRMN', 10, 94.5, 850.5);

-- --------------------------------------------------------

--
-- Struttura della tabella `$2y$10$clPHDmM0hAHcp.L0ByfLxeBLDo9cqcfAU2OLFyHy5GDjfLIZlpaNG`
--

CREATE TABLE `$2y$10$clPHDmM0hAHcp.L0ByfLxeBLDo9cqcfAU2OLFyHy5GDjfLIZlpaNG` (
  `id_acquisto` int NOT NULL,
  `asset` varchar(256) NOT NULL,
  `quantita` int NOT NULL,
  `prezzo` float NOT NULL,
  `valore_acquisto` float NOT NULL
) ENGINE=MyISAM;

-- --------------------------------------------------------

--
-- Struttura della tabella `$2y$10$cU0Fdqz3VPC8X7oPJLt99.nLwjDWe/qC2hKwHvZXN7VZeDrQZzWa.`
--

CREATE TABLE `$2y$10$cU0Fdqz3VPC8X7oPJLt99.nLwjDWe/qC2hKwHvZXN7VZeDrQZzWa.` (
  `id_acquisto` int NOT NULL,
  `asset` varchar(256) NOT NULL,
  `quantita` int NOT NULL,
  `prezzo` float NOT NULL,
  `valore_acquisto` float NOT NULL
) ENGINE=MyISAM;

--
-- Dump dei dati per la tabella `$2y$10$cU0Fdqz3VPC8X7oPJLt99.nLwjDWe/qC2hKwHvZXN7VZeDrQZzWa.`
--

INSERT INTO `$2y$10$cU0Fdqz3VPC8X7oPJLt99.nLwjDWe/qC2hKwHvZXN7VZeDrQZzWa.` (`id_acquisto`, `asset`, `quantita`, `prezzo`, `valore_acquisto`) VALUES
(1, 'GOOGL', 3, 101.05, 303.15),
(2, 'ABBV', 3, 161.2, 483.6),
(3, 'AMZN', 2, 96.69, 193.38),
(4, 'DPZ', 2, 388.5, 777),
(5, 'AIG', 11, 63, 693),
(6, 'MSFT', 3, 255, 765);

-- --------------------------------------------------------

--
-- Struttura della tabella `$2y$10$jqakLNmp6Lt3bt7VaNmzZ.xmwAwkClyzopxZdbJd4CaVxYuyn0W0m`
--

CREATE TABLE `$2y$10$jqakLNmp6Lt3bt7VaNmzZ.xmwAwkClyzopxZdbJd4CaVxYuyn0W0m` (
  `id_acquisto` int NOT NULL,
  `asset` varchar(256) NOT NULL,
  `quantita` int NOT NULL,
  `prezzo` float NOT NULL,
  `valore_acquisto` float NOT NULL
) ENGINE=MyISAM;

-- --------------------------------------------------------

--
-- Struttura della tabella `$2y$10$u/3bIdbE7Dms.SCM2Z1DJejeYRPBKDZ66INUD839iAiJa.sk2BM8K`
--

CREATE TABLE `$2y$10$u/3bIdbE7Dms.SCM2Z1DJejeYRPBKDZ66INUD839iAiJa.sk2BM8K` (
  `id_acquisto` int NOT NULL,
  `asset` varchar(256) NOT NULL,
  `quantita` int NOT NULL,
  `prezzo` float NOT NULL,
  `valore_acquisto` float NOT NULL
) ENGINE=MyISAM;

-- --------------------------------------------------------

--
-- Struttura della tabella `$2y$10$UNy1jOU4hmcMYz8JMK2qcOCyLzNL2aClUBt1pRuKTSkQ6SKyLNgaa`
--

CREATE TABLE `$2y$10$UNy1jOU4hmcMYz8JMK2qcOCyLzNL2aClUBt1pRuKTSkQ6SKyLNgaa` (
  `id_acquisto` int NOT NULL,
  `asset` varchar(256) NOT NULL,
  `quantita` int NOT NULL,
  `prezzo` float NOT NULL,
  `valore_acquisto` float NOT NULL
) ENGINE=MyISAM;

--
-- Dump dei dati per la tabella `$2y$10$UNy1jOU4hmcMYz8JMK2qcOCyLzNL2aClUBt1pRuKTSkQ6SKyLNgaa`
--

INSERT INTO `$2y$10$UNy1jOU4hmcMYz8JMK2qcOCyLzNL2aClUBt1pRuKTSkQ6SKyLNgaa` (`id_acquisto`, `asset`, `quantita`, `prezzo`, `valore_acquisto`) VALUES
(1, 'NFLX', 3, 297.99, 893.97),
(2, 'ACN', 2, 288.91, 577.82),
(3, 'ACN', -2, 288.91, -577.82),
(7, 'A', 4, 150.94, 603.76),
(8, 'A', 4, 150.94, 603.76),
(9, 'A', -8, 150, -1207);

-- --------------------------------------------------------

--
-- Struttura della tabella `$2y$10$Vyo0DE.uP8MOdyEnNVMsfOjpXe5U695LhK6efMLrVm6JXdbaesh76`
--

CREATE TABLE `$2y$10$Vyo0DE.uP8MOdyEnNVMsfOjpXe5U695LhK6efMLrVm6JXdbaesh76` (
  `id_acquisto` int NOT NULL,
  `asset` varchar(256) NOT NULL,
  `quantita` int NOT NULL,
  `prezzo` float NOT NULL,
  `valore_acquisto` float NOT NULL
) ENGINE=MyISAM;

-- --------------------------------------------------------

--
-- Struttura della tabella `$2y$10$XcFV6NhNCaoKEhKWZZTxzu.tR2WVCiHeyagkeP91VoByhwMIvbUZy`
--

CREATE TABLE `$2y$10$XcFV6NhNCaoKEhKWZZTxzu.tR2WVCiHeyagkeP91VoByhwMIvbUZy` (
  `id_acquisto` int NOT NULL,
  `asset` varchar(256) NOT NULL,
  `quantita` int NOT NULL,
  `prezzo` float NOT NULL,
  `valore_acquisto` float NOT NULL
) ENGINE=MyISAM;

-- --------------------------------------------------------

--
-- Struttura della tabella `$2y$10$z3So7OzbU4vvKrCsBZqH5Oo3z9JE/2V8fxRtevSBtqkPWwVus67Py`
--

CREATE TABLE `$2y$10$z3So7OzbU4vvKrCsBZqH5Oo3z9JE/2V8fxRtevSBtqkPWwVus67Py` (
  `id_acquisto` int NOT NULL,
  `asset` varchar(256) NOT NULL,
  `quantita` int NOT NULL,
  `prezzo` float NOT NULL,
  `valore_acquisto` float NOT NULL
) ENGINE=MyISAM;

--
-- Dump dei dati per la tabella `$2y$10$z3So7OzbU4vvKrCsBZqH5Oo3z9JE/2V8fxRtevSBtqkPWwVus67Py`
--

INSERT INTO `$2y$10$z3So7OzbU4vvKrCsBZqH5Oo3z9JE/2V8fxRtevSBtqkPWwVus67Py` (`id_acquisto`, `asset`, `quantita`, `prezzo`, `valore_acquisto`) VALUES
(1, 'GOOGL', 3, 95.35, 286.05),
(2, 'ABBV', 3, 152.6, 457.8),
(3, 'AMZN', 2, 115.69, 231.38),
(4, 'DPZ', 3, 322.02, 966.06),
(12, 'DPZ', -1, 347.93, -347.93),
(13, 'AIG', 14, 59.3, 830.2),
(11, 'MSFT', 3, 229, 687),
(14, 'AIG', -3, 59.3, -177.9);

-- --------------------------------------------------------

--
-- Struttura della tabella `Utenti`
--

CREATE TABLE `Utenti` (
  `nome` varchar(256) NOT NULL,
  `cognome` varchar(256) NOT NULL,
  `mail` varchar(256) NOT NULL,
  `pass` varchar(256) NOT NULL,
  `data_nascita` date NOT NULL,
  `id_utente` int NOT NULL,
  `id_wallet` varchar(255) NOT NULL,
  `api_key` varchar(21) DEFAULT NULL
) ENGINE=MyISAM;

--
-- Dump dei dati per la tabella `Utenti`
--

INSERT INTO `Utenti` (`nome`, `cognome`, `mail`, `pass`, `data_nascita`, `id_utente`, `id_wallet`, `api_key`) VALUES
('Andrea', 'Ricciardi', 'andrea.ricciardi@crazywallet.com', '$2y$10$nBvPYQ5Y1cBmfo77reyUP.Pb5F5f66lBVivkg4/hNHS7VztXGsnw2', '1996-03-15', 1, '$2y$10$z3So7OzbU4vvKrCsBZqH5Oo3z9JE/2V8fxRtevSBtqkPWwVus67Py', 'UusjYQkCEc7ZoErOJz7eg'),
('Lucas', 'Bianchi', 'lucasbianchi@crazywallet.com', '$2y$10$Eo2OH1.TMruEJ0SClQ8GOeTqhUAxb7KYxLmgbmmLUP82/bHKcynRi', '1983-06-08', 2, '$2y$10$zBFYUkzdS0mUuf/IhLP3IO7qsRRYSPxshVWtTwr9U2YTY0mAVwuim', '9uE261M9Uq3lufWia3vNY'),
('Marco', 'Contatori', 'marco.contatori@crazywallet.com', '$2y$10$7Xpy0gJn/VcjLLAMYMC/5udaHIHnepAvDhJnALRMg.7mdTS1NbSh6', '1985-06-12', 3, '$2y$10$UNy1jOU4hmcMYz8JMK2qcOCyLzNL2aClUBt1pRuKTSkQ6SKyLNgaa', 'cUtpCv9J9JFaebJOS6MJ7'),
('Paolo', 'Tirchio', 'paolotirchio@crazywallet.com', '$2y$10$a7l5gchS..EPAOkDenzCA.MKtPNU8gj9rJljnR1yVCpDN/DZZElku', '2000-02-09', 4, '$2y$10$jqakLNmp6Lt3bt7VaNmzZ.xmwAwkClyzopxZdbJd4CaVxYuyn0W0m', 'EwmXpIAoHeDvhlhaZaV54'),
('Marco', 'Paoli', 'marcopaoli@crazywallet.com', '$2y$10$7qOXLmP4gIRlZqv6cP0mWef2CHD.mvdD6FvtUhovREheEzqr1fnlG', '1991-02-06', 6, '$2y$10$u/3bIdbE7Dms.SCM2Z1DJejeYRPBKDZ66INUD839iAiJa.sk2BM8K', 'HCLJqBOzzdJ4uKHQJ4vQa'),
('Marco', 'Lettere', 'marcolettere@crazywallet.com', '$2y$10$qUrfEdEQvCD3VOuj/EZZxu0/NOJ1cyRO8.eZ9jeMMf9hV0KepSKY.', '1999-02-18', 7, '$2y$10$XcFV6NhNCaoKEhKWZZTxzu.tR2WVCiHeyagkeP91VoByhwMIvbUZy', 'PaSgBnqNkvQMUHw9xy3gP'),
('Luca', 'Ricciardi', 'luca.ricciardi@crazywallet.com', '$2y$10$kj.1N64W0Zeo4KoljEpW8.aCc85WStyu64rnB/iL6wERUsAfIV4cO', '1993-06-10', 8, '$2y$10$cU0Fdqz3VPC8X7oPJLt99.nLwjDWe/qC2hKwHvZXN7VZeDrQZzWa.', 'mSMOfd5clStMVCiQ764x2'),
('Luca', 'Campegiani', 'luca.campegiani@crazywallet.com', '$2y$10$g2Q1xA0HF1DTZBxcZwlLGu552BusUlTyF5aR.rDZeXtmSy.5VYA1e', '1996-02-03', 9, '$2y$10$Vyo0DE.uP8MOdyEnNVMsfOjpXe5U695LhK6efMLrVm6JXdbaesh76', 'MoOtt3ksWjYYTdOZLIE2O'),
('Santino', 'Moncata', 'santino@duck.com', '$2y$10$3ybRCSK9V7rb4XsPlPgpj.qxM.37FZ7kquIkQ.TQcIWGjPXWbDP7a', '2001-05-06', 10, '$2y$10$6bRjmdaZWQxIGi6mb58NqO14v3TnyMsBxQorOZDnyRJnRa1OR6VUy', 'I7gnyZrpqafBkUhdxVRwy');

--
-- Indici per le tabelle scaricate
--

--
-- Indici per le tabelle `$2y$10$6bRjmdaZWQxIGi6mb58NqO14v3TnyMsBxQorOZDnyRJnRa1OR6VUy`
--
ALTER TABLE `$2y$10$6bRjmdaZWQxIGi6mb58NqO14v3TnyMsBxQorOZDnyRJnRa1OR6VUy`
  ADD PRIMARY KEY (`id_acquisto`);

--
-- Indici per le tabelle `$2y$10$clPHDmM0hAHcp.L0ByfLxeBLDo9cqcfAU2OLFyHy5GDjfLIZlpaNG`
--
ALTER TABLE `$2y$10$clPHDmM0hAHcp.L0ByfLxeBLDo9cqcfAU2OLFyHy5GDjfLIZlpaNG`
  ADD PRIMARY KEY (`id_acquisto`);

--
-- Indici per le tabelle `$2y$10$cU0Fdqz3VPC8X7oPJLt99.nLwjDWe/qC2hKwHvZXN7VZeDrQZzWa.`
--
ALTER TABLE `$2y$10$cU0Fdqz3VPC8X7oPJLt99.nLwjDWe/qC2hKwHvZXN7VZeDrQZzWa.`
  ADD PRIMARY KEY (`id_acquisto`);

--
-- Indici per le tabelle `$2y$10$jqakLNmp6Lt3bt7VaNmzZ.xmwAwkClyzopxZdbJd4CaVxYuyn0W0m`
--
ALTER TABLE `$2y$10$jqakLNmp6Lt3bt7VaNmzZ.xmwAwkClyzopxZdbJd4CaVxYuyn0W0m`
  ADD PRIMARY KEY (`id_acquisto`);

--
-- Indici per le tabelle `$2y$10$u/3bIdbE7Dms.SCM2Z1DJejeYRPBKDZ66INUD839iAiJa.sk2BM8K`
--
ALTER TABLE `$2y$10$u/3bIdbE7Dms.SCM2Z1DJejeYRPBKDZ66INUD839iAiJa.sk2BM8K`
  ADD PRIMARY KEY (`id_acquisto`);

--
-- Indici per le tabelle `$2y$10$UNy1jOU4hmcMYz8JMK2qcOCyLzNL2aClUBt1pRuKTSkQ6SKyLNgaa`
--
ALTER TABLE `$2y$10$UNy1jOU4hmcMYz8JMK2qcOCyLzNL2aClUBt1pRuKTSkQ6SKyLNgaa`
  ADD PRIMARY KEY (`id_acquisto`);

--
-- Indici per le tabelle `$2y$10$Vyo0DE.uP8MOdyEnNVMsfOjpXe5U695LhK6efMLrVm6JXdbaesh76`
--
ALTER TABLE `$2y$10$Vyo0DE.uP8MOdyEnNVMsfOjpXe5U695LhK6efMLrVm6JXdbaesh76`
  ADD PRIMARY KEY (`id_acquisto`);

--
-- Indici per le tabelle `$2y$10$XcFV6NhNCaoKEhKWZZTxzu.tR2WVCiHeyagkeP91VoByhwMIvbUZy`
--
ALTER TABLE `$2y$10$XcFV6NhNCaoKEhKWZZTxzu.tR2WVCiHeyagkeP91VoByhwMIvbUZy`
  ADD PRIMARY KEY (`id_acquisto`);

--
-- Indici per le tabelle `$2y$10$z3So7OzbU4vvKrCsBZqH5Oo3z9JE/2V8fxRtevSBtqkPWwVus67Py`
--
ALTER TABLE `$2y$10$z3So7OzbU4vvKrCsBZqH5Oo3z9JE/2V8fxRtevSBtqkPWwVus67Py`
  ADD PRIMARY KEY (`id_acquisto`);

--
-- Indici per le tabelle `Utenti`
--
ALTER TABLE `Utenti`
  ADD PRIMARY KEY (`id_utente`);

--
-- AUTO_INCREMENT per le tabelle scaricate
--

--
-- AUTO_INCREMENT per la tabella `$2y$10$6bRjmdaZWQxIGi6mb58NqO14v3TnyMsBxQorOZDnyRJnRa1OR6VUy`
--
ALTER TABLE `$2y$10$6bRjmdaZWQxIGi6mb58NqO14v3TnyMsBxQorOZDnyRJnRa1OR6VUy`
  MODIFY `id_acquisto` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT per la tabella `$2y$10$clPHDmM0hAHcp.L0ByfLxeBLDo9cqcfAU2OLFyHy5GDjfLIZlpaNG`
--
ALTER TABLE `$2y$10$clPHDmM0hAHcp.L0ByfLxeBLDo9cqcfAU2OLFyHy5GDjfLIZlpaNG`
  MODIFY `id_acquisto` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `$2y$10$cU0Fdqz3VPC8X7oPJLt99.nLwjDWe/qC2hKwHvZXN7VZeDrQZzWa.`
--
ALTER TABLE `$2y$10$cU0Fdqz3VPC8X7oPJLt99.nLwjDWe/qC2hKwHvZXN7VZeDrQZzWa.`
  MODIFY `id_acquisto` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT per la tabella `$2y$10$jqakLNmp6Lt3bt7VaNmzZ.xmwAwkClyzopxZdbJd4CaVxYuyn0W0m`
--
ALTER TABLE `$2y$10$jqakLNmp6Lt3bt7VaNmzZ.xmwAwkClyzopxZdbJd4CaVxYuyn0W0m`
  MODIFY `id_acquisto` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `$2y$10$u/3bIdbE7Dms.SCM2Z1DJejeYRPBKDZ66INUD839iAiJa.sk2BM8K`
--
ALTER TABLE `$2y$10$u/3bIdbE7Dms.SCM2Z1DJejeYRPBKDZ66INUD839iAiJa.sk2BM8K`
  MODIFY `id_acquisto` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `$2y$10$UNy1jOU4hmcMYz8JMK2qcOCyLzNL2aClUBt1pRuKTSkQ6SKyLNgaa`
--
ALTER TABLE `$2y$10$UNy1jOU4hmcMYz8JMK2qcOCyLzNL2aClUBt1pRuKTSkQ6SKyLNgaa`
  MODIFY `id_acquisto` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT per la tabella `$2y$10$Vyo0DE.uP8MOdyEnNVMsfOjpXe5U695LhK6efMLrVm6JXdbaesh76`
--
ALTER TABLE `$2y$10$Vyo0DE.uP8MOdyEnNVMsfOjpXe5U695LhK6efMLrVm6JXdbaesh76`
  MODIFY `id_acquisto` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `$2y$10$XcFV6NhNCaoKEhKWZZTxzu.tR2WVCiHeyagkeP91VoByhwMIvbUZy`
--
ALTER TABLE `$2y$10$XcFV6NhNCaoKEhKWZZTxzu.tR2WVCiHeyagkeP91VoByhwMIvbUZy`
  MODIFY `id_acquisto` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `$2y$10$z3So7OzbU4vvKrCsBZqH5Oo3z9JE/2V8fxRtevSBtqkPWwVus67Py`
--
ALTER TABLE `$2y$10$z3So7OzbU4vvKrCsBZqH5Oo3z9JE/2V8fxRtevSBtqkPWwVus67Py`
  MODIFY `id_acquisto` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT per la tabella `Utenti`
--
ALTER TABLE `Utenti`
  MODIFY `id_utente` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
