-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Sep 06, 2021 at 06:42 PM
-- Server version: 5.7.24
-- PHP Version: 7.2.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `snowtricks`
--

-- --------------------------------------------------------

--
-- Table structure for table `comment`
--

CREATE TABLE `comment` (
  `id` int(11) NOT NULL,
  `trick_id` int(11) DEFAULT NULL,
  `author_id` int(11) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `content` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `comment`
--

INSERT INTO `comment` (`id`, `trick_id`, `author_id`, `created_at`, `content`) VALUES
(1, 2, 1, '2021-09-06 18:40:50', 'Super figure');

-- --------------------------------------------------------

--
-- Table structure for table `group`
--

CREATE TABLE `group` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `group`
--

INSERT INTO `group` (`id`, `name`) VALUES
(1, 'Les grabs'),
(2, 'Les rotations'),
(3, 'Les flips');

-- --------------------------------------------------------

--
-- Table structure for table `image`
--

CREATE TABLE `image` (
  `id` int(11) NOT NULL,
  `trick_id` int(11) DEFAULT NULL,
  `file_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alt` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `image`
--

INSERT INTO `image` (`id`, `trick_id`, `file_name`, `alt`) VALUES
(2, 2, 'mute-613640910c5c1.jpg', 'mute'),
(3, 2, 'mute-613640910dc9f.jpg', 'mute_other'),
(4, 3, 'sad-61364162c4916.jpg', 'sad'),
(5, 3, 'sad2-61364162c60be.jpg', 'sad2'),
(6, 4, '360-613641b85afaa.jpg', '360'),
(7, 5, '900-6136422b9535c.jpg', '900'),
(8, 6, 'frontflip-6136428200434.jpg', 'frontflip'),
(9, 7, 'backFlip-613642d898121.jpg', 'backflip'),
(10, 8, 'nosegrab-61364320b4f12.jpg', 'nosegrab'),
(11, 9, 'truckdriver-61364383b03a5.jpg', 'truck driver');

-- --------------------------------------------------------

--
-- Table structure for table `trick`
--

CREATE TABLE `trick` (
  `id` int(11) NOT NULL,
  `trick_group_id` int(11) NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `trick`
--

INSERT INTO `trick` (`id`, `trick_group_id`, `title`, `description`, `created_at`) VALUES
(2, 1, 'Le mute', 'Saisie de la carre frontside de la planche entre les deux pieds avec la main avant.', '2021-09-06 18:23:45'),
(3, 1, 'Le sad ou melancholie', 'Saisie de la carre backside de la planche, entre les deux pieds, avec la main avant', '2021-09-06 18:27:14'),
(4, 2, 'Le 360', 'Trois six pour un tour complet', '2021-09-06 18:28:40'),
(5, 2, 'Le 900', 'Rotation de deux tours et demi', '2021-09-06 18:30:35'),
(6, 3, 'Front flip', 'Rotation verticale vers l\'avant', '2021-09-06 18:32:01'),
(7, 3, 'Back flip', 'Rotation verticale vers l\'arrière', '2021-09-06 18:33:28'),
(8, 1, 'Le nose grab', 'saisie de la partie avant de la planche, avec la main avant', '2021-09-06 18:34:40'),
(9, 1, 'Le truck driver', 'saisie du carre avant et carre arrière avec chaque main (comme tenir un volant de voiture)', '2021-09-06 18:36:19');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `image_id` int(11) DEFAULT NULL,
  `pseudo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `confirmed` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `image_id`, `pseudo`, `email`, `password`, `role`, `token`, `confirmed`) VALUES
(1, NULL, 'Nathan GRACIA', 'nathan.gracia.863@gmail.com', '$argon2id$v=19$m=65536,t=4,p=1$am1LcXVjZ0lyY3o3U3E5dw$TlMOBTf+2ad2hYy4m9rGhUaGi5Q6zX6X7Gxi+5FW6oE', 'ROLE_USER', '390d4d7e-9319-4ce0-93c3-7df3d63b776b', 1);

-- --------------------------------------------------------

--
-- Table structure for table `video`
--

CREATE TABLE `video` (
  `id` int(11) NOT NULL,
  `trick_id` int(11) DEFAULT NULL,
  `plateform` int(11) NOT NULL,
  `plateform_id` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `video`
--

INSERT INTO `video` (`id`, `trick_id`, `plateform`, `plateform_id`) VALUES
(1, 2, 1, 'jm19nEvmZgM'),
(2, 3, 1, 'KEdFwJ4SWq4');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_9474526CB281BE2E` (`trick_id`),
  ADD KEY `IDX_9474526CF675F31B` (`author_id`);

--
-- Indexes for table `group`
--
ALTER TABLE `group`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `image`
--
ALTER TABLE `image`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_C53D045FB281BE2E` (`trick_id`);

--
-- Indexes for table `trick`
--
ALTER TABLE `trick`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_D8F0A91E9B875DF8` (`trick_group_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_8D93D6493DA5256D` (`image_id`);

--
-- Indexes for table `video`
--
ALTER TABLE `video`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_7CC7DA2CB281BE2E` (`trick_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comment`
--
ALTER TABLE `comment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `group`
--
ALTER TABLE `group`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `image`
--
ALTER TABLE `image`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `trick`
--
ALTER TABLE `trick`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `video`
--
ALTER TABLE `video`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `comment`
--
ALTER TABLE `comment`
  ADD CONSTRAINT `FK_9474526CB281BE2E` FOREIGN KEY (`trick_id`) REFERENCES `trick` (`id`),
  ADD CONSTRAINT `FK_9474526CF675F31B` FOREIGN KEY (`author_id`) REFERENCES `user` (`id`);

--
-- Constraints for table `image`
--
ALTER TABLE `image`
  ADD CONSTRAINT `FK_C53D045FB281BE2E` FOREIGN KEY (`trick_id`) REFERENCES `trick` (`id`);

--
-- Constraints for table `trick`
--
ALTER TABLE `trick`
  ADD CONSTRAINT `FK_D8F0A91E9B875DF8` FOREIGN KEY (`trick_group_id`) REFERENCES `group` (`id`);

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `FK_8D93D6493DA5256D` FOREIGN KEY (`image_id`) REFERENCES `image` (`id`);

--
-- Constraints for table `video`
--
ALTER TABLE `video`
  ADD CONSTRAINT `FK_7CC7DA2CB281BE2E` FOREIGN KEY (`trick_id`) REFERENCES `trick` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
