-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Czas generowania: 24 Mar 2021, 19:42
-- Wersja serwera: 10.3.27-MariaDB-cll-lve
-- Wersja PHP: 7.4.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `phoenixw_regsystem`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `projekt_posty`
--

CREATE TABLE `projekt_posty` (
  `id` int(11) NOT NULL,
  `uzytkownik` varchar(50) COLLATE utf8_polish_ci NOT NULL,
  `tytul` varchar(200) COLLATE utf8_polish_ci NOT NULL,
  `tresc` text COLLATE utf8_polish_ci NOT NULL,
  `kategoria` varchar(100) COLLATE utf8_polish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `projekt_posty`
--

INSERT INTO `projekt_posty` (`id`, `uzytkownik`, `tytul`, `tresc`, `kategoria`) VALUES
(1, 'Phoenix', 'Po co to robimy?', 'Tworzymy to forum, aby jak najwięcej osób mogło w prosty i przyjemy sposób stworzyć własną stronę internetową. W razie pytań zawsze będzie się można tu dowiedzieć co zrobić oraz dostać przydatne rady w jaki sposób wykonać to jak najbardziej efektywnie. Razem możemy więcej! :)', 'cel');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `projekt_uzytkownicy`
--

CREATE TABLE `projekt_uzytkownicy` (
  `id` int(9) NOT NULL,
  `login` varchar(50) COLLATE utf8_polish_ci NOT NULL,
  `haslo` varchar(80) COLLATE utf8_polish_ci NOT NULL,
  `email` varchar(60) COLLATE utf8_polish_ci NOT NULL,
  `imie` varchar(60) COLLATE utf8_polish_ci NOT NULL,
  `nazwisko` varchar(60) COLLATE utf8_polish_ci NOT NULL,
  `data_urodzenia` varchar(20) COLLATE utf8_polish_ci NOT NULL,
  `adres` varchar(60) COLLATE utf8_polish_ci NOT NULL,
  `kodpocztowy` varchar(6) COLLATE utf8_polish_ci NOT NULL,
  `miejscowosc` varchar(60) COLLATE utf8_polish_ci NOT NULL,
  `telefon` varchar(15) COLLATE utf8_polish_ci NOT NULL,
  `www` varchar(50) COLLATE utf8_polish_ci NOT NULL,
  `typ_konta` tinyint(4) NOT NULL COMMENT '0 - Gość, 1 - Użytkownik, 2 - Moderator, 3 - Administrator',
  `ilosc_postow` int(11) NOT NULL,
  `blokada` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `projekt_uzytkownicy`
--

INSERT INTO `projekt_uzytkownicy` (`id`, `login`, `haslo`, `email`, `imie`, `nazwisko`, `data_urodzenia`, `adres`, `kodpocztowy`, `miejscowosc`, `telefon`, `www`, `typ_konta`, `ilosc_postow`, `blokada`) VALUES
(1, 'Janwak', '$2y$10$jZQrXb06CuQFe8ArB3Hwie7359kMRXvv7yIHyQ9Xs3JRqDyAI4xX6', 'jan@rty.pl', 'Jan', 'Nowak', '12.08.2000', 'Nowa 1', '62-500', 'Konin', '643 345 534', 'www.jannowak.pl', 1, 0, 0),
(3, 'Kłos', '$2y$10$jZQrXb06CuQFe8ArB3Hwie7359kMRXvv7yIHyQ9Xs3JRqDyAI4xX6', 'karol@asdasd.pl', 'Karol', 'Kłos', '20.03.1990', 'Kłosowa', '23-234', 'Kłosowo', '982 232 532', 'karolk.pl', 1, 0, 0),
(4, 'Andrzej K', '$2y$10$jZQrXb06CuQFe8ArB3Hwie7359kMRXvv7yIHyQ9Xs3JRqDyAI4xX6', 'kloc@rte.pl', 'Andrzej', 'Kloc', '23.12.2001', 'Zamkowa 234', '25-543', 'Podzamcze', '764 034 523', 'sialalala.si', 1, 0, 0),
(5, 'Kłosanna', '$2y$10$jZQrXb06CuQFe8ArB3Hwie7359kMRXvv7yIHyQ9Xs3JRqDyAI4xX6', 'klos@asdasd.pl', 'Anna', 'Kłos', '23.11.2002', 'Kłosowa', '23-234', 'Kłosowo', '423 534 422', 'www.klosanna.pl', 1, 0, 0),
(13, 'Phoenix', '$2y$10$EhayKSIglua3kQFCuqfEmu.C6a7pxgEv.diYju301kbI3Y8VapFL6', 'phoenix@gmail.com', '', '', '', '', '', '', '', '', 3, 0, 0),
(17, 'Admin', '$2y$10$zZY6Gt4HtvlZPhnuPq.nLeKOn/aIkwjIDTyFc6yjnT7VmDKJwZJRy', 'admin@admin.pl', '', '', '', '', '', '', '', '', 3, 0, 0),
(18, 'Test', '$2y$10$UDooSLK6lV9o9m9dEUx8Oexq2/Sk.Cm.2uJi/MZC/BL/AtHfdEyUC', 'test@test.pl', '', '', '', '', '', '', '', '', 1, 0, 0),
(19, 'Moderator', '$2y$10$ZLc7MzXdNjbmDdXGUWqJ6./RA79ZWkda/N1PSuFuBpQSYTcvVn5US', 'moderator@gmail.com', '', '', '', '', '', '', '', '', 2, 0, 0);

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `projekt_posty`
--
ALTER TABLE `projekt_posty`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `projekt_uzytkownicy`
--
ALTER TABLE `projekt_uzytkownicy`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT dla zrzuconych tabel
--

--
-- AUTO_INCREMENT dla tabeli `projekt_posty`
--
ALTER TABLE `projekt_posty`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT dla tabeli `projekt_uzytkownicy`
--
ALTER TABLE `projekt_uzytkownicy`
  MODIFY `id` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
