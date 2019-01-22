-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jan 22, 2019 at 03:40 PM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 7.3.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `platform`
--

-- --------------------------------------------------------

--
-- Table structure for table `basket`
--

CREATE TABLE `basket` (
  `ID` int(11) NOT NULL,
  `order_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `games`
--

CREATE TABLE `games` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `genre` int(1) NOT NULL,
  `price` int(11) NOT NULL,
  `review` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `games`
--

INSERT INTO `games` (`id`, `name`, `genre`, `price`, `review`) VALUES
(1, 'Spyro', 1, 40, 5),
(2, 'FarCry Primal', 1, 20, 5),
(3, 'Uncharted', 1, 20, 5),
(4, 'Bloodborne', 1, 18, 5),
(5, 'Metro Exodus', 1, 60, 5),
(6, 'Nioh', 1, 32, 5),
(7, 'Robinson', 1, 20, 4),
(8, 'Skyrim', 1, 45, 4),
(9, 'Hitman', 1, 35, 4),
(10, 'Final Fantasy XV', 1, 21, 5),
(11, 'Diablo 3', 1, 32, 5),
(12, 'Black ops 4', 2, 48, 5),
(13, 'Battlefield V', 2, 40, 5),
(14, 'Fortnite Deep Freeze Bundle', 2, 28, 4),
(15, 'Call of Duty WW2', 2, 23, 5),
(16, 'PlayerUnknowns Battleground', 2, 30, 4),
(17, 'Resident Evil', 2, 21, 5),
(18, 'Destiny 2 Forsaken', 2, 34, 5),
(19, 'Overwatch', 2, 40, 5),
(20, 'The Order 1886', 2, 32, 4),
(21, 'Prey', 2, 17, 5),
(22, 'F1 2018', 3, 63, 5),
(23, 'The Crew', 3, 27, 4),
(24, 'Rocket League', 3, 30, 5),
(25, 'Project Cars 2', 3, 26, 4),
(26, 'Gran Turismo Sport', 3, 32, 4),
(27, 'TrackMania Turbo', 3, 20, 5),
(28, 'Ride 3', 3, 53, 5),
(29, 'Wipe out', 3, 20, 5),
(30, 'Need for Speed Rivals', 3, 28, 4),
(31, 'Mxgp Pro', 3, 60, 5),
(32, 'OnRush', 3, 24, 3),
(33, 'Overcooked 2', 4, 27, 5),
(34, 'Tetris Effect', 4, 50, 5),
(35, 'Toki Tori', 4, 27, 4),
(36, 'The Evil Within 2', 4, 25, 5),
(37, 'The Town of Light', 4, 20, 4),
(38, 'Agony', 4, 24, 1),
(39, 'Terraria', 4, 23, 5),
(40, 'Sherlock Holmes', 4, 60, 3),
(41, 'Deadlight', 4, 27, 3),
(42, 'Fifa 2019', 5, 40, 5),
(43, 'NBA 2019', 5, 55, 5),
(44, 'WWE 2019', 5, 43, 5),
(45, 'Steep Winter Games', 5, 19, 3),
(46, 'Pro Evolution Soccer 2019', 5, 40, 5),
(47, 'NHL 19', 5, 45, 5),
(48, 'Tennis World Tour', 5, 60, 3),
(49, 'Tour de France', 5, 36, 5),
(50, 'Tour de France', 5, 36, 5),
(51, 'The Golf Club', 5, 31, 5),
(52, 'Hustle Kings', 5, 22, 4),
(53, 'Ashes Cricket', 5, 21, 2),
(54, 'Rugby World Cup', 5, 27, 5),
(55, 'Pure Pool', 5, 18, 5),
(56, 'Madden NFL 25', 5, 27, 4);

-- --------------------------------------------------------

--
-- Table structure for table `genre`
--

CREATE TABLE `genre` (
  `id` int(11) NOT NULL,
  `type` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `genre`
--

INSERT INTO `genre` (`id`, `type`) VALUES
(1, 'rpg'),
(2, 'fps'),
(3, 'race'),
(4, 'puzzle'),
(5, 'sport');

-- --------------------------------------------------------

--
-- Table structure for table `my_games`
--

CREATE TABLE `my_games` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `game_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `my_games`
--

INSERT INTO `my_games` (`id`, `user_id`, `game_id`) VALUES
(7, 18, 10),
(8, 18, 11),
(9, 18, 12),
(10, 18, 13),
(11, 18, 21),
(12, 18, 22),
(13, 18, 23),
(14, 18, 24),
(15, 18, 25),
(16, 18, 54),
(17, 18, 12);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `ID` int(11) NOT NULL,
  `game_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`ID`, `game_id`, `user_id`) VALUES
(3, 50, 11),
(5, 11, 11),
(6, 15, 11),
(7, 13, 11),
(9, 11, 11),
(15, 11, 19),
(16, 3, 19),
(17, 35, 19),
(20, 15, 21),
(22, 34, 18),
(23, 33, 18),
(24, 1, 18);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `username`, `password`) VALUES
(8, 'Jack', 'Jack@jack.com', 'jack03', 'jack02'),
(9, 'jimbob', 'jim@bob.com', 'james', '$2y$10$0VBHOetO88alWFA6jpWSrO4clR0yt09IAH068OXhtfOoKwk00OfcO'),
(10, 'Barry', 'Barry@jimbob.com', 'barry01', '$2y$10$rsH4NUKlHQaGIvxXJERoPOx.X6/EPTgcZ8x68zcadDBY2w2Eupqkq'),
(11, 'Admin', 'jw@jw.nl', 'Admin', '$2y$10$D1l4Q/L903fDEuwxekUqwuZj/0xjVEZAe00ufbOZGVvn9L0Fv5VaC'),
(12, 'Henk', 'henk@henk.nl', 'Henk01', '$2y$10$hDYX9kAeQWq0R6mqHNCF3eFvQ7jDaa/xtSeBKlzD0G55Gi0g8vZNy'),
(13, 'koen', 'koen@koen.koen', 'klimkoen', '$2y$10$X7Wp7A65mdgWEhlJ8XyFk.nQImTHGMUru2F/AJ7Os1ar9UuYZQr1e'),
(14, 'koenieboy', 'k.r.swinkels@gmail.com', 'lifeisgood', '$2y$10$cHoWZxXeKlyLAp16iKkt.OkgiqmbIwtKdhUI0PS2xUcv7fASWiOgS'),
(15, 'frits', 'frits@frits.frits', 'frits', '$2y$10$Og5g9v/xrj8Z/OC/HaCLPeHluVtHY3z2ybrAxYhYy20hD57hc0JzS'),
(16, 'Jack', 'Jack@jack.com', 'Jack02', '$2y$10$p9n.TFqo1IjtNjjUzXzLnemUPOvBFhfieFFx1sN1g/nLlo0pb5eea'),
(17, 'Floris', 'floris@floris.com', 'floris', '$2y$10$CD5mmw1NV0N2gwUzvWmEeeHrLZoe/PBhxVuzbkciPWYwhovFgIm2G'),
(18, 'Jw', 'jw@jw.com', 'admin', '$2y$10$ZJbHvoo5XrEzzeja3Z/lfetIPqWF/Zr45/CMnKEkCAkwFmZO9OEVi'),
(19, 'Basz', 'Basz@nu.nl', 'sep', '$2y$10$tjJ0Z.iGruf6rcp41KkCV.W9nO.ZDaOPZ.ftkpIMiZtv7WBJNQF1y'),
(20, 'Martin', 'martin@martin.com', 'Martin', '$2y$10$Z/kvVTHlIO2s1h4RiSkXOeuGwkv22sYtxMDQ/T6fAn6s.WLlcgcBm'),
(21, 'lilou', 'sannetentije@gmail.com', 'lilou', '$2y$10$GtX4Mu4iyIX4S6VQCWzYlOSqOUFdyHozYu/afzakNxtY6EvbWRP1W');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `basket`
--
ALTER TABLE `basket`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `order_id` (`order_id`);

--
-- Indexes for table `games`
--
ALTER TABLE `games`
  ADD PRIMARY KEY (`id`),
  ADD KEY `genre` (`genre`);

--
-- Indexes for table `genre`
--
ALTER TABLE `genre`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `my_games`
--
ALTER TABLE `my_games`
  ADD PRIMARY KEY (`id`),
  ADD KEY `game_id` (`game_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `game_id` (`game_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `basket`
--
ALTER TABLE `basket`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `games`
--
ALTER TABLE `games`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT for table `genre`
--
ALTER TABLE `genre`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `my_games`
--
ALTER TABLE `my_games`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `basket`
--
ALTER TABLE `basket`
  ADD CONSTRAINT `basket_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`ID`);

--
-- Constraints for table `games`
--
ALTER TABLE `games`
  ADD CONSTRAINT `games_ibfk_1` FOREIGN KEY (`genre`) REFERENCES `genre` (`id`);

--
-- Constraints for table `my_games`
--
ALTER TABLE `my_games`
  ADD CONSTRAINT `my_games_ibfk_1` FOREIGN KEY (`game_id`) REFERENCES `games` (`id`),
  ADD CONSTRAINT `my_games_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`game_id`) REFERENCES `games` (`id`),
  ADD CONSTRAINT `orders_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `orders_ibfk_3` FOREIGN KEY (`game_id`) REFERENCES `games` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
