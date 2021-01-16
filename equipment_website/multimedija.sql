-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Gostitelj: 127.0.0.1
-- Čas nastanka: 16. jan 2021 ob 13.22
-- Različica strežnika: 10.4.14-MariaDB
-- Različica PHP: 7.4.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Zbirka podatkov: `multimedija`
--

-- --------------------------------------------------------

--
-- Struktura tabele `category`
--

CREATE TABLE `category` (
  `category_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Odloži podatke za tabelo `category`
--

INSERT INTO `category` (`category_id`, `name`) VALUES
(1, 'sd'),
(2, 'kamera'),
(3, 'kabli');

-- --------------------------------------------------------

--
-- Struktura tabele `oprema`
--

CREATE TABLE `oprema` (
  `oprema_id` int(11) NOT NULL,
  `ime_opreme` varchar(255) NOT NULL,
  `category_id` int(11) NOT NULL,
  `is_taken` tinyint(1) DEFAULT 0,
  `image` varchar(255) DEFAULT 'default.jpg'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Odloži podatke za tabelo `oprema`
--

INSERT INTO `oprema` (`oprema_id`, `ime_opreme`, `category_id`, `is_taken`, `image`) VALUES
(1, 'sd_kartica_32GB ', 1, 0, 'default.jpg'),
(2, 'sony_a73', 2, 0, 'default.jpg'),
(3, 'Canon_50D', 2, 0, 'default.jpg');

-- --------------------------------------------------------

--
-- Struktura tabele `sposoja`
--

CREATE TABLE `sposoja` (
  `id_sposoje` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `oprema_id` int(11) NOT NULL,
  `datum_sposoje` date DEFAULT NULL,
  `datum_vrnitve` date NOT NULL,
  `je_vrnjeno` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktura tabele `users`
--

CREATE TABLE `users` (
  `id_user` int(11) NOT NULL,
  `ime` varchar(255) NOT NULL,
  `priimek` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Odloži podatke za tabelo `users`
--

INSERT INTO `users` (`id_user`, `ime`, `priimek`, `email`, `password`) VALUES
(8, 'Tit', 'Šober', 'tit', '$2y$10$O3nPHBjEWnkMRIiUwKdmDO/HJe0FPf2ldc6QVPFTsSydeDZMbzida');

--
-- Indeksi zavrženih tabel
--

--
-- Indeksi tabele `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`category_id`);

--
-- Indeksi tabele `oprema`
--
ALTER TABLE `oprema`
  ADD PRIMARY KEY (`oprema_id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indeksi tabele `sposoja`
--
ALTER TABLE `sposoja`
  ADD PRIMARY KEY (`id_sposoje`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `oprema_id` (`oprema_id`);

--
-- Indeksi tabele `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT zavrženih tabel
--

--
-- AUTO_INCREMENT tabele `category`
--
ALTER TABLE `category`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT tabele `oprema`
--
ALTER TABLE `oprema`
  MODIFY `oprema_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT tabele `sposoja`
--
ALTER TABLE `sposoja`
  MODIFY `id_sposoje` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT tabele `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Omejitve tabel za povzetek stanja
--

--
-- Omejitve za tabelo `oprema`
--
ALTER TABLE `oprema`
  ADD CONSTRAINT `oprema_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `category` (`category_id`) ON DELETE CASCADE;

--
-- Omejitve za tabelo `sposoja`
--
ALTER TABLE `sposoja`
  ADD CONSTRAINT `sposoja_ibfk_3` FOREIGN KEY (`user_id`) REFERENCES `users` (`id_user`) ON DELETE CASCADE,
  ADD CONSTRAINT `sposoja_ibfk_4` FOREIGN KEY (`oprema_id`) REFERENCES `oprema` (`oprema_id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
