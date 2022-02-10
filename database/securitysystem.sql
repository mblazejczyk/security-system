-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Czas generowania: 02 Lut 2022, 01:50
-- Wersja serwera: 10.4.21-MariaDB
-- Wersja PHP: 7.4.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `securitysystem`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `logBook`
--

CREATE TABLE `logBook` (
  `id` int(11) NOT NULL,
  `who` int(11) NOT NULL,
  `where` int(11) NOT NULL,
  `when` date NOT NULL,
  `log` text COLLATE utf8mb4_polish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_polish_ci;

--
-- Zrzut danych tabeli `logBook`
--

INSERT INTO `logBook` (`id`, `who`, `where`, `when`, `log`) VALUES
(8, 24, 3, '2022-02-03', 'Shift started at 5:00<br>\nElevators checked<br>\nMr. Admin came for job interview<br>\nDoors were cleaned<br>\nElevators checked again at 15:00<br>\nShift ended at 19:00');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `notifications`
--

CREATE TABLE `notifications` (
  `id` int(11) NOT NULL,
  `Guest` text COLLATE utf8mb4_polish_ci NOT NULL,
  `Where` int(11) NOT NULL,
  `Description` text COLLATE utf8mb4_polish_ci NOT NULL,
  `SinceWhen` date NOT NULL,
  `TillWhen` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_polish_ci;

--
-- Zrzut danych tabeli `notifications`
--

INSERT INTO `notifications` (`id`, `Guest`, `Where`, `Description`, `SinceWhen`, `TillWhen`) VALUES
(9, 'Guest', 3, 'To XYZgames company for job interview', '2000-01-01', '2050-01-01');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `receptions`
--

CREATE TABLE `receptions` (
  `id` int(11) NOT NULL,
  `Name` text COLLATE utf8mb4_polish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_polish_ci;

--
-- Zrzut danych tabeli `receptions`
--

INSERT INTO `receptions` (`id`, `Name`) VALUES
(3, 'Reception A'),
(5, 'Reception B');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `schedule`
--

CREATE TABLE `schedule` (
  `id` int(11) NOT NULL,
  `StartShift` datetime NOT NULL,
  `EndShift` datetime NOT NULL,
  `Where` int(11) NOT NULL,
  `Who` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_polish_ci;

--
-- Zrzut danych tabeli `schedule`
--

INSERT INTO `schedule` (`id`, `StartShift`, `EndShift`, `Where`, `Who`) VALUES
(12, '2022-02-01 05:00:00', '2022-02-01 19:00:00', 3, 24);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `login` text COLLATE utf8mb4_polish_ci NOT NULL,
  `password` text COLLATE utf8mb4_polish_ci NOT NULL,
  `name` text COLLATE utf8mb4_polish_ci NOT NULL,
  `workPlace` int(11) NOT NULL,
  `seeNot` int(11) NOT NULL,
  `manNot` int(11) NOT NULL,
  `manAcc` int(11) NOT NULL,
  `manRec` int(11) NOT NULL,
  `manLog` int(11) NOT NULL,
  `schAcc` int(11) NOT NULL,
  `schMan` int(11) NOT NULL,
  `seeLog` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_polish_ci;

--
-- Zrzut danych tabeli `users`
--

INSERT INTO `users` (`id`, `login`, `password`, `name`, `workPlace`, `seeNot`, `manNot`, `manAcc`, `manRec`, `manLog`, `schAcc`, `schMan`, `seeLog`) VALUES
(24, 'admin', '$2y$10$oILdgVe96s6qWb5yH8BnNuwkVAb9YFmgkF1J5tT0TqvmSPv2ZW3wC', 'admin', 3, 1, 1, 1, 1, 1, 1, 1, 1);

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `logBook`
--
ALTER TABLE `logBook`
  ADD PRIMARY KEY (`id`),
  ADD KEY `who` (`who`),
  ADD KEY `where` (`where`);

--
-- Indeksy dla tabeli `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `Where` (`Where`);

--
-- Indeksy dla tabeli `receptions`
--
ALTER TABLE `receptions`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `schedule`
--
ALTER TABLE `schedule`
  ADD PRIMARY KEY (`id`),
  ADD KEY `Where` (`Where`),
  ADD KEY `Who` (`Who`);

--
-- Indeksy dla tabeli `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `users_ibfk_1` (`workPlace`);

--
-- AUTO_INCREMENT dla zrzuconych tabel
--

--
-- AUTO_INCREMENT dla tabeli `logBook`
--
ALTER TABLE `logBook`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT dla tabeli `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT dla tabeli `receptions`
--
ALTER TABLE `receptions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT dla tabeli `schedule`
--
ALTER TABLE `schedule`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT dla tabeli `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- Ograniczenia dla zrzutów tabel
--

--
-- Ograniczenia dla tabeli `logBook`
--
ALTER TABLE `logBook`
  ADD CONSTRAINT `logBook_ibfk_1` FOREIGN KEY (`where`) REFERENCES `receptions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `logBook_ibfk_2` FOREIGN KEY (`who`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ograniczenia dla tabeli `notifications`
--
ALTER TABLE `notifications`
  ADD CONSTRAINT `notifications_ibfk_1` FOREIGN KEY (`Where`) REFERENCES `receptions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ograniczenia dla tabeli `schedule`
--
ALTER TABLE `schedule`
  ADD CONSTRAINT `schedule_ibfk_1` FOREIGN KEY (`Where`) REFERENCES `receptions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `schedule_ibfk_2` FOREIGN KEY (`Who`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ograniczenia dla tabeli `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`workPlace`) REFERENCES `receptions` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
