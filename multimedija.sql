-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Gostitelj: 127.0.0.1
-- Čas nastanka: 20. jan 2021 ob 19.52
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
(1, 'sd_kartica_32GB ', 1, 1, 'default.jpg'),
(2, 'sony_a73', 2, 0, 'default.jpg'),
(3, 'Canon_50D', 2, 0, 'default.jpg'),
(33, 'asdsadfa', 1, 0, 'default.jpg'),
(34, 'asdfgdg', 1, 0, 'default.jpg'),
(35, 'jnkmcdfxbgv', 1, 0, 'sata.jfif'),
(36, 'asd', 1, 0, 'default.jpg');

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

--
-- Odloži podatke za tabelo `sposoja`
--

INSERT INTO `sposoja` (`id_sposoje`, `user_id`, `oprema_id`, `datum_sposoje`, `datum_vrnitve`, `je_vrnjeno`) VALUES
(44, 8, 1, '2021-01-16', '2021-01-30', 1),
(45, 8, 2, '2021-01-16', '2021-01-30', 1),
(46, 8, 1, '2021-01-16', '2021-01-24', 1),
(47, 8, 2, '2021-01-16', '2021-01-30', 1),
(48, 8, 3, '2021-01-16', '2021-01-30', 1),
(53, 8, 1, '2021-01-18', '2021-01-29', 1),
(54, 8, 2, '2021-01-18', '2021-01-29', 1),
(55, 8, 3, '2021-01-18', '2021-01-29', 1),
(56, 8, 33, '2021-01-18', '2021-01-29', 1),
(57, 8, 34, '2021-01-18', '2021-01-29', 1),
(58, 8, 35, '2021-01-18', '2021-01-29', 1),
(59, 8, 36, '2021-01-18', '2021-01-29', 1),
(60, 8, 1, '2021-01-18', '2021-01-21', 1),
(61, 8, 2, '2021-01-18', '2021-01-21', 1),
(62, 8, 3, '2021-01-18', '2021-01-21', 1),
(63, 8, 35, '2021-01-18', '2021-01-28', 1),
(64, 8, 36, '2021-01-18', '2021-01-28', 1),
(65, 8, 1, '2021-01-18', '2021-01-28', 1),
(66, 8, 2, '2021-01-18', '2021-01-28', 1),
(67, 8, 3, '2021-01-18', '2021-01-28', 1),
(68, 8, 1, '2021-01-19', '2021-01-22', 1),
(69, 8, 2, '2021-01-19', '2021-01-22', 1),
(70, 8, 35, '2021-01-19', '2021-01-29', 1),
(71, 8, 2, '2021-01-19', '2021-01-28', 1),
(72, 8, 3, '2021-01-19', '2021-01-28', 1),
(73, 15, 1, '2021-01-19', '2021-01-21', 0);

-- --------------------------------------------------------

--
-- Struktura tabele `users`
--

CREATE TABLE `users` (
  `id_user` int(11) NOT NULL,
  `ime` varchar(255) NOT NULL,
  `priimek` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `admin` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Odloži podatke za tabelo `users`
--

INSERT INTO `users` (`id_user`, `ime`, `priimek`, `email`, `password`, `admin`) VALUES
(8, 'Tit', 'Šober', 'tit', '$2y$10$O3nPHBjEWnkMRIiUwKdmDO/HJe0FPf2ldc6QVPFTsSydeDZMbzida', 1),
(13, 'asd', 'asd', 'asd', '$2y$10$7ZgndPX8La4ygmRkCIgO.O.gnk8Y6VXxmC1Ho3UzjsHSZlayK8f2y', 0),
(15, 'test', 'test', 'test', '$2y$10$6wsWdkuZ/m9htRiVu9xRReszBIYGsrpPVo1VEmCQM5WJMFoKWdV/m', 0),
(16, 'tomy', 'tomy', 'tomy', '$2y$10$7ZMGe6XLuAiMuK7XQya5rub5BxVrXWG1UnqN/MCb97bjmIkChXBC6', 1);

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
  MODIFY `oprema_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT tabele `sposoja`
--
ALTER TABLE `sposoja`
  MODIFY `id_sposoje` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=74;

--
-- AUTO_INCREMENT tabele `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

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
