-- phpMyAdmin SQL Dump
-- version 4.9.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Jul 23, 2020 at 06:48 PM
-- Server version: 5.7.26
-- PHP Version: 7.4.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `pricing`
--

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `name` varchar(32) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `name`) VALUES
(1, 'Diablo'),
(2, 'Diablo 2'),
(3, 'Zelda'),
(4, 'CS');

-- --------------------------------------------------------

--
-- Table structure for table `product_for_sale`
--

CREATE TABLE `product_for_sale` (
  `id` int(11) NOT NULL,
  `prix_plancher` double NOT NULL,
  `user_id` int(11) NOT NULL,
  `state_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `prix_max` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_for_sale`
--

INSERT INTO `product_for_sale` (`id`, `prix_plancher`, `user_id`, `state_id`, `product_id`, `prix_max`) VALUES
(2, 15, 6, 4, 2, 0),
(3, 5, 5, 4, 2, 0),
(6, 5, 5, 2, 1, 10),
(7, 20, 3, 2, 1, 30),
(8, 15, 3, 2, 1, 22),
(9, 5, 3, 2, 1, 22),
(10, 5, 3, 2, 1, 22),
(11, 5, 3, 2, 1, 22),
(12, 5, 3, 2, 1, 9.99),
(13, 30, 3, 2, 1, 30),
(15, 10, 3, 2, 3, 19),
(16, 5, 3, 6, 3, 100),
(17, 5, 3, 3, 3, 18),
(18, 5, 3, 3, 3, 17.99),
(19, 10, 3, 4, 4, 10),
(20, 1, 3, 3, 4, 9),
(21, 1000, 3, 6, 4, 1000),
(22, 1, 3, 4, 4, 9.99),
(23, 1, 5, 4, 4, 9.98);

-- --------------------------------------------------------

--
-- Table structure for table `state`
--

CREATE TABLE `state` (
  `id` int(11) NOT NULL,
  `name` varchar(32) COLLATE utf8mb4_unicode_ci NOT NULL,
  `rank` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `state`
--

INSERT INTO `state` (`id`, `name`, `rank`) VALUES
(2, 'Très bon état', 3),
(3, 'État moyen', 1),
(4, 'Bon état', 2),
(5, 'Comme neuf', 4),
(6, 'Neuf', 5);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL,
  `roles` json NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `roles`, `password`) VALUES
(3, 'admin', '[\"ROLE_ADMIN\"]', '$argon2id$v=19$m=65536,t=4,p=1$shdzeeGfRBCKW+b/D0W0YQ$HhiLrLGOTiKBZ8gjWBYBn3LRY7wgWJjxyGeipPOGWYM'),
(4, 'alex', '[]', '$argon2id$v=19$m=65536,t=4,p=1$TQPZ0s2EiX+9Jgdd1s/sRQ$cG0wN7h5Urcm0v10rnhnNg40YNoU/D/zZDnluK/YPk0'),
(5, 'tom', '[]', '$argon2id$v=19$m=65536,t=4,p=1$ALR7+pWx9BsWLYI3QQvvkQ$+roMFFhJhxi8ul9XD+U4ZXGZgPly1UjsfAIl8ufW/pU'),
(6, 'Kai', '[]', 'Kai');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_for_sale`
--
ALTER TABLE `product_for_sale`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_FD4ECB07A76ED395` (`user_id`),
  ADD KEY `IDX_FD4ECB075D83CC1` (`state_id`),
  ADD KEY `IDX_FD4ECB074584665A` (`product_id`);

--
-- Indexes for table `state`
--
ALTER TABLE `state`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_8D93D649F85E0677` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `product_for_sale`
--
ALTER TABLE `product_for_sale`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `state`
--
ALTER TABLE `state`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `product_for_sale`
--
ALTER TABLE `product_for_sale`
  ADD CONSTRAINT `FK_FD4ECB074584665A` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`),
  ADD CONSTRAINT `FK_FD4ECB075D83CC1` FOREIGN KEY (`state_id`) REFERENCES `state` (`id`),
  ADD CONSTRAINT `FK_FD4ECB07A76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);
