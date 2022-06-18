-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Czas generowania: 25 Maj 2022, 17:57
-- Wersja serwera: 10.4.21-MariaDB
-- Wersja PHP: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `awitek_hotel_app`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `gosc`
--

CREATE TABLE `gosc` (
  `id_pesel` int(11) NOT NULL,
  `imie` text NOT NULL,
  `nazwisko` text NOT NULL,
  `rabat` float DEFAULT NULL,
  `telefon` text NOT NULL,
  `historia` longtext DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `gosc`
--

INSERT INTO `gosc` (`id_pesel`, `imie`, `nazwisko`, `rabat`, `telefon`, `historia`) VALUES
(500516997, 'Jan', 'Kowalski', 0, '804-314-768', ''),
(620502383, 'Julia', 'Kot', 0, '804-314-768', '- id: 2, przyjazd: 2022.05.21, wyjazd: 2022.05.22, zajmowany pokój: 10'),
(721112515, 'Alicja', 'Majewska', 0.05, '561-908-970', ''),
(870824414, 'Adam', 'Nowak', 0.05, '651-637-901', '- id: 2, przyjazd: 2022.04.12, wyjazd: 2022.04.15, zajmowany pokój: 7,'),
(940622578, 'Marcelina', 'Gruszka', 0, '618-725-073', NULL),
(971223876, 'Aleksandra', 'Witek', 0.1, '550-685-292', '');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `platnosc`
--

CREATE TABLE `platnosc` (
  `rezerwacja_id` int(11) NOT NULL,
  `nr_pokoju` int(11) NOT NULL,
  `usluga` text NOT NULL,
  `kwota` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `platnosc`
--

INSERT INTO `platnosc` (`rezerwacja_id`, `nr_pokoju`, `usluga`, `kwota`) VALUES
(3, 7, 'Masaż spa', 200),
(8, 8, 'Parking', 700),
(8, 8, 'Usługa gastronomiczna', 125),
(5, 3, 'Pralnia', 45),
(7, 1, 'Dostawka dla dziecka', 75);

--
-- Wyzwalacze `platnosc`
--
DELIMITER $$
CREATE TRIGGER `nowa_usluga` AFTER INSERT ON `platnosc` FOR EACH ROW UPDATE zameldowany SET zameldowany.platnosc = zameldowany.platnosc + platnosc.kwota where zameldowany.nr_pokoju = platnosc.nr_pokoju
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `pokoj`
--

CREATE TABLE `pokoj` (
  `nr_pokoju` int(11) NOT NULL,
  `rezerwacja_id` int(11) DEFAULT NULL,
  `posprzatany` tinyint(1) NOT NULL,
  `wolny` tinyint(1) NOT NULL,
  `w_uzytku` tinyint(1) NOT NULL,
  `przyjazd` date DEFAULT NULL,
  `wyjazd` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `pokoj`
--

INSERT INTO `pokoj` (`nr_pokoju`, `rezerwacja_id`, `posprzatany`, `wolny`, `w_uzytku`, `przyjazd`, `wyjazd`) VALUES
(1, 7, 0, 0, 1, '2022-05-24', '2022-06-01'),
(2, NULL, 1, 1, 1, NULL, NULL),
(3, 5, 0, 0, 1, '2022-05-25', '2022-06-04'),
(4, NULL, 1, 1, 1, NULL, NULL),
(5, NULL, 1, 1, 0, NULL, NULL),
(6, NULL, 1, 1, 1, NULL, NULL),
(7, 3, 0, 0, 1, '2022-05-25', '2022-05-26'),
(8, 8, 0, 0, 1, '2022-05-21', '2022-05-28'),
(9, NULL, 0, 1, 1, NULL, NULL),
(10, 4, 0, 0, 1, '2022-05-25', '2022-05-31'),
(11, NULL, 1, 1, 0, NULL, NULL),
(12, NULL, 1, 1, 1, NULL, NULL),
(13, NULL, 1, 1, 1, NULL, NULL),
(14, NULL, 1, 1, 1, NULL, NULL),
(15, NULL, 1, 1, 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `rezerwacja`
--

CREATE TABLE `rezerwacja` (
  `id_rezerwacji` int(11) NOT NULL,
  `pesel_id` int(11) NOT NULL,
  `imie` text NOT NULL,
  `nazwisko` text NOT NULL,
  `przyjazd` date NOT NULL,
  `wyjazd` date NOT NULL,
  `numer_pokoju` int(11) DEFAULT NULL,
  `kwota/doba` double NOT NULL,
  `komentarz` longtext DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `rezerwacja`
--

INSERT INTO `rezerwacja` (`id_rezerwacji`, `pesel_id`, `imie`, `nazwisko`, `przyjazd`, `wyjazd`, `numer_pokoju`, `kwota/doba`, `komentarz`) VALUES
(3, 870824414, 'Adam', 'Nowak', '2022-05-25', '2022-04-26', 7, 150, 'Pan przyjedzie późnym wieczorem ok. 21'),
(4, 620502383, 'Julia', 'Kot', '2022-05-25', '2022-05-31', 10, 180, 'Pani, w miarę możliwości, prosi o ten sam pokój co ostatnio.'),
(5, 971223876, 'Aleksandra', 'Witek', '2022-05-25', '2022-06-04', 3, 150, NULL),
(6, 500516997, 'Jan', 'Kowalski', '2022-05-31', '2022-06-03', 10, 200, NULL),
(7, 721112515, 'Alicja', 'Majewska', '2022-05-24', '2022-06-01', 1, 180, NULL),
(8, 940622578, 'Marcelina', 'Gruszka', '2022-05-21', '2022-05-28', 8, 150, NULL);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `zameldowany`
--

CREATE TABLE `zameldowany` (
  `rezerwacja_id` int(11) NOT NULL,
  `pesel_id` int(11) NOT NULL,
  `imie` text NOT NULL,
  `nazwisko` text NOT NULL,
  `nr_pokoju` int(11) NOT NULL,
  `platnosc` double NOT NULL,
  `rozliczony` tinyint(1) NOT NULL,
  `uwagi` longtext DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `zameldowany`
--

INSERT INTO `zameldowany` (`rezerwacja_id`, `pesel_id`, `imie`, `nazwisko`, `nr_pokoju`, `platnosc`, `rozliczony`, `uwagi`) VALUES
(3, 870824414, 'Adam', 'Nowak', 7, 350, 0, NULL),
(7, 721112515, 'Alicja', 'Majewska', 1, 1155, 0, NULL),
(8, 940622578, 'Marcelina', 'Gruszka', 8, 1875, 0, 'Proszę doliczyć parking x7'),
(5, 971223876, 'Aleksandra', 'Witek', 5, 1545, 0, NULL),
(4, 620502383, 'Julia', 'Kot', 10, 1080, 0, NULL);

--
-- Wyzwalacze `zameldowany`
--
DELIMITER $$
CREATE TRIGGER `wymeldowany` BEFORE DELETE ON `zameldowany` FOR EACH ROW DELETE FROM rezerwacja WHERE rezerwacja.id_rezerwacji = zameldowany.rezerwacja_id
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `wymeldowany2` BEFORE DELETE ON `zameldowany` FOR EACH ROW UPDATE pokoj SET pokoj.rezerwacja_id = '', pokoj.posprzatany = 0,
pokoj.wolny = 1, pokoj.przyjazd = '', pokoj.wyjazd = '' where pokoj.rezerwacja_id = zameldowany.rezerwacja_id
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `wymeldowany3` BEFORE DELETE ON `zameldowany` FOR EACH ROW DELETE FROM platnosc WHERE platnosc.id_rezerwacji = zameldowany.rezerwacja_id
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `zameldowanie` AFTER INSERT ON `zameldowany` FOR EACH ROW UPDATE pokoj SET pokoj.posprzatany = 0, pokoj.wolny = 0, pokoj.rezerwacja_id = zameldowany.rezerwacja_id where pokoj.nr_pokoju = zameldowany.nr_pokoju
$$
DELIMITER ;

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `gosc`
--
ALTER TABLE `gosc`
  ADD PRIMARY KEY (`id_pesel`);

--
-- Indeksy dla tabeli `platnosc`
--
ALTER TABLE `platnosc`
  ADD KEY `id_rezerwacji` (`rezerwacja_id`),
  ADD KEY `nr_pokoju` (`nr_pokoju`);

--
-- Indeksy dla tabeli `pokoj`
--
ALTER TABLE `pokoj`
  ADD PRIMARY KEY (`nr_pokoju`),
  ADD KEY `id_rezerwacja` (`rezerwacja_id`);

--
-- Indeksy dla tabeli `rezerwacja`
--
ALTER TABLE `rezerwacja`
  ADD PRIMARY KEY (`id_rezerwacji`),
  ADD UNIQUE KEY `id_pesel` (`pesel_id`) USING BTREE,
  ADD KEY `numer_pokoju` (`numer_pokoju`);

--
-- Indeksy dla tabeli `zameldowany`
--
ALTER TABLE `zameldowany`
  ADD KEY `id_rezerwacja` (`rezerwacja_id`),
  ADD KEY `id_pesel` (`pesel_id`),
  ADD KEY `nr_pokoku` (`nr_pokoju`);

--
-- AUTO_INCREMENT dla zrzuconych tabel
--

--
-- AUTO_INCREMENT dla tabeli `gosc`
--
ALTER TABLE `gosc`
  MODIFY `id_pesel` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=971223877;

--
-- AUTO_INCREMENT dla tabeli `pokoj`
--
ALTER TABLE `pokoj`
  MODIFY `nr_pokoju` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT dla tabeli `rezerwacja`
--
ALTER TABLE `rezerwacja`
  MODIFY `id_rezerwacji` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Ograniczenia dla zrzutów tabel
--

--
-- Ograniczenia dla tabeli `platnosc`
--
ALTER TABLE `platnosc`
  ADD CONSTRAINT `platnosc_ibfk_1` FOREIGN KEY (`rezerwacja_id`) REFERENCES `zameldowany` (`rezerwacja_id`),
  ADD CONSTRAINT `platnosc_ibfk_2` FOREIGN KEY (`nr_pokoju`) REFERENCES `rezerwacja` (`numer_pokoju`);

--
-- Ograniczenia dla tabeli `pokoj`
--
ALTER TABLE `pokoj`
  ADD CONSTRAINT `pokoj_ibfk_1` FOREIGN KEY (`rezerwacja_id`) REFERENCES `rezerwacja` (`id_rezerwacji`);

--
-- Ograniczenia dla tabeli `rezerwacja`
--
ALTER TABLE `rezerwacja`
  ADD CONSTRAINT `rezerwacja_ibfk_1` FOREIGN KEY (`pesel_id`) REFERENCES `gosc` (`id_pesel`),
  ADD CONSTRAINT `rezerwacja_ibfk_2` FOREIGN KEY (`numer_pokoju`) REFERENCES `pokoj` (`nr_pokoju`);

--
-- Ograniczenia dla tabeli `zameldowany`
--
ALTER TABLE `zameldowany`
  ADD CONSTRAINT `zameldowany_ibfk_1` FOREIGN KEY (`rezerwacja_id`) REFERENCES `rezerwacja` (`id_rezerwacji`),
  ADD CONSTRAINT `zameldowany_ibfk_2` FOREIGN KEY (`pesel_id`) REFERENCES `gosc` (`id_pesel`),
  ADD CONSTRAINT `zameldowany_ibfk_3` FOREIGN KEY (`nr_pokoju`) REFERENCES `pokoj` (`nr_pokoju`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
