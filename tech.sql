-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 23 Maj 2022, 17:06
-- Wersja serwera: 10.4.22-MariaDB
-- Wersja PHP: 8.1.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `tech`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `articles`
--

CREATE TABLE `articles` (
  `id` int(11) NOT NULL,
  `title` text NOT NULL,
  `article` text NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `articles`
--

INSERT INTO `articles` (`id`, `title`, `article`, `user_id`) VALUES
(3, 'D', 'D', 1),
(6, 'Lorem Ipsum', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec eget elit viverra, vulputate mauris a, pellentesque risus. Mauris est mauris, semper non congue a, facilisis aliquet mi. Aenean urna velit, gravida nec consequat at, cursus sit amet sapien. Nulla interdum blandit lectus sit amet euismod. Aenean eget nisi ut turpis dapibus maximus. Vestibulum convallis scelerisque diam eget tincidunt. Sed at rhoncus sapien. Nullam ultrices at mi a pharetra. Aliquam erat volutpat. In nec urna maximus, viverra enim eget, hendrerit sem. Maecenas ultrices augue nec tellus rutrum, eget volutpat lacus molestie. Vestibulum efficitur blandit ante, vel ultrices velit molestie eget.', 1),
(7, 'LoremIpsum', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. In iaculis mauris a pharetra vestibulum. Ut mattis tortor id turpis maximus tempor. Donec bibendum eros ex, cursus varius justo ullamcorper sit amet. Pellentesque sed condimentum ipsum. Integer convallis ultricies massa, ut facilisis nunc fermentum quis. Duis finibus ante vel purus euismod tincidunt. In placerat quis ipsum ac egestas. Sed sollicitudin mollis ultricies. Maecenas nibh magna, fringilla nec interdum sit amet, tincidunt a nibh. Vestibulum ac justo eu orci tristique imperdiet eget in velit. Nulla vitae risus lobortis, sollicitudin mi quis, pharetra felis. Nullam facilisis id sapien et tempor. Pellentesque sed ipsum justo. Nam elementum enim rutrum ullamcorper tempor.', 1),
(17, 'AAAAAAAAAAA', 'AAAAAAAAAAAAAAAAAAAAA', 6),
(23, 'AAAAA', 'AAAAAAAAAAAAA', 6),
(25, 'ADASDASD', 'ASDASDASDASDASDASDAS', 7),
(26, 'a', 'a', 1),
(27, 'aaaaaaaaaa', 'aaaaaaaaaaaaaaaaaaaa', 7),
(28, 'kotpies', 'kotpies', 11);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` text CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `password` text CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `email` text CHARACTER SET utf8 COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `email`) VALUES
(1, 'A', 'A', 'A@wp.pl'),
(6, 'B', 'B', 'B@wp.pl'),
(7, 'C', 'C', 'C@wp.pl'),
(9, 'D', 'D', 'D@wp.pl'),
(10, '', '', ''),
(11, 'kotpies', 'kotpies', 'kot@onet.pl');

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `articles`
--
ALTER TABLE `articles`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT dla zrzuconych tabel
--

--
-- AUTO_INCREMENT dla tabeli `articles`
--
ALTER TABLE `articles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT dla tabeli `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
