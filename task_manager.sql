-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 14, 2025 at 03:15 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.1.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `task_manager`
--

-- --------------------------------------------------------

--
-- Table structure for table `tasks`
--

CREATE TABLE `tasks` (
  `id` int(11) NOT NULL,
  `category` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tasks`
--

INSERT INTO `tasks` (`id`, `category`, `description`, `user_id`) VALUES
(7, 'aare', 'dsaf', 7),
(8, 'sdsaf', 'dsaf', 2),
(9, 'aaresafdf', 'dsafdsfas', 7),
(11, 'alam', '123', 8),
(12, 'minyak', 'minyak sania', 9),
(13, 'minyak', 'minyak sania', 1),
(14, 'knsadkas', 'kds', 8),
(15, 'knsadkas', 'kds', 8),
(20, 'kerja', 'magang', 10);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`) VALUES
(1, 'uas', '$2y$10$HUKqDXmvdIFR7qwQaukI/.T1FW5De7fUYXGQI1uetU/e38Z/7NXWu'),
(2, 'tes', '$2y$10$LpqjqtjZTKqsU8JK4OSm/OAVtxykAREuOGNGd2tPYUCSlq6gc5rB6'),
(3, NULL, '$2y$10$nYXCTQzhdAZf0BkrjCy3YeNxp4hIiHMIZFX3Sr7lQ5aACtcXpPDmG'),
(4, NULL, '$2y$10$zv.rYDDH.JITa5eW3BTBjO8Rs6y4y0S6432bZcIH4Rir6FwRg9zGu'),
(5, NULL, '$2y$10$y60kPOlrRl/2LOcx5tsY6e9FqYvwOh2OW3a0E6iY74gae2f/9u24e'),
(6, 'uasnih', '$2y$10$WCOCO5CzH0cU0mYqmtRXbeUmVwN0SlEGiWYqPMzAN9uN8oSmYeK/m'),
(7, 'newuser', '$2y$10$e/ElfxGgPaSDIyWpmgLOxuAnat6p5vwzkhDAX5w07jszyYKn/y.Yu'),
(8, 'alam', '$2y$10$tMAs2da5Ufkn6jofQ5r2duqS1iTNdA7li7chzl1p1hnlna5WKItGe'),
(9, 'ahmad', '$2y$10$pf8YaFNQADiY6ni.FEnQLeD/VHs.hHj94JXIvkAk/b2z3Mz96lWaa'),
(10, 'sad', '$2y$10$OHijpqXvGRi5yOwwNVX/5eZ8qUQZN8LVUgYNkRQvpEMYMqMmaujre');

-- --------------------------------------------------------

--
-- Table structure for table `user_sessions`
--

CREATE TABLE `user_sessions` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `token` varchar(64) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_sessions`
--

INSERT INTO `user_sessions` (`id`, `user_id`, `token`, `created_at`) VALUES
(1, 2, '9ddc3c61c22908af1972293b08f8e2aff064ef114478a6b944a329ebbab612fd', '2025-01-08 04:48:21'),
(2, 2, '3e1f967e52dc44fa0eaf6e500fa084b42a7fe923935ed60ca8ea8fc2947f6443', '2025-01-08 04:52:53'),
(3, 2, '1816ef300c3b7444ec8b952aec7c6708512b4b1bef1ce56ed5d5712b4c08b7ca', '2025-01-08 05:04:02'),
(4, 2, '006c498616be7a394e50c77adb5c27992ea0fe963e956d5c78816d2ace53d502', '2025-01-08 05:08:11'),
(5, 2, '850054a047529270031e92fdd834a81c44008b8ed113475d3663738caab6da95', '2025-01-08 05:26:38'),
(6, 2, '8172d01c049ee790ac37c32b0fe7878cdb013cc12523d69d32b1441a6161eadd', '2025-01-08 05:33:55'),
(7, 2, 'b43404b331ef7a55d473fdf20828d1e410563807ed158dee015f212d7f240f43', '2025-01-08 05:34:48'),
(8, 6, '7730b05c9d2b31a3776df973fcd3be7086d7e218926d82883aa82f432e08e8a3', '2025-01-08 05:50:34'),
(9, 2, '1dc94ce72a9650888e6dbbea044fe0686f006ea08300947637568efea3f1e53e', '2025-01-08 05:57:06'),
(10, 2, 'c016803d958a9a582cd627c57af4a4621110264a86de9c50275fc6105fb28ed5', '2025-01-08 05:58:16'),
(11, 7, 'daa1eb0609bdee24e9c87cafcd87e570ce4eba6a93ee1bff1fa1ec009a0ee637', '2025-01-08 06:02:53'),
(12, 1, '0a885e3aba4ffb79908fb4c4a9f31d1f0c6c3acf6be13682dacc74b0a3d7b387', '2025-01-08 09:03:36'),
(13, 8, '1b5baa26587026f1814882d20cb41cabcab5ad9a7e346cc5e910fe57a40494c5', '2025-01-08 09:08:58'),
(14, 9, 'c24fb82ef11f2b01f0b906200a57312ec51abb6039303f7c51cb793769f75a32', '2025-01-08 09:35:54'),
(15, 1, 'd05a736eefa1434350beb77e5ac838aa479591b8b4614e534d93b4f5f5147df5', '2025-01-08 09:44:30'),
(16, 10, '25e8cb5d5a4d46dc690de673746f92bf509acb830b479e0cabe4fbaa9522c9eb', '2025-01-14 11:49:31'),
(17, 10, 'b9b61450e70652b9d5f32d0645a59cb29c9594ae7e359f83c6bf35387422a279', '2025-01-14 12:11:34'),
(18, 10, '5ae3caa8d9963517af6c6794b7f2c5524088ae0d818382744707ef8aad9c216d', '2025-01-14 12:18:48'),
(19, 10, 'e6b5ae8e8f09bbc75aca63b028a8b160eb8687e64c03c8b378951de74df9435d', '2025-01-14 12:22:30'),
(20, 10, '6df08a52186a5449024532265079347b7b97565f6a156e3f37d84c88a78faea7', '2025-01-14 12:34:21'),
(21, 10, '1df5f17fc11ea6c9031ccb648867670ed286d69909d56326d01843b76fff065c', '2025-01-14 12:35:01'),
(22, 10, '2a0cf0b3c17532596fedf058d569bf903189aef49569968408cab6028387c0bc', '2025-01-14 13:31:59');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tasks`
--
ALTER TABLE `tasks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_sessions`
--
ALTER TABLE `user_sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tasks`
--
ALTER TABLE `tasks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `user_sessions`
--
ALTER TABLE `user_sessions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tasks`
--
ALTER TABLE `tasks`
  ADD CONSTRAINT `tasks_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `user_sessions`
--
ALTER TABLE `user_sessions`
  ADD CONSTRAINT `user_sessions_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
