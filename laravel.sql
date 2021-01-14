-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 14, 2021 at 01:23 PM
-- Server version: 10.4.13-MariaDB
-- PHP Version: 7.2.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `laravel`
--

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `featured_image` varchar(255) NOT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `thumbnail_image` varchar(255) NOT NULL,
  `status` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `user_id`, `title`, `slug`, `description`, `featured_image`, `deleted_at`, `thumbnail_image`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 'test 12', 'asdasd', 'asdasdad', '/uploads/products/0e93760daadcf3017a35254b3476a25d.jpg', NULL, '/uploads/products/thumb_0e93760daadcf3017a35254b3476a25d.jpg', 1, '2021-01-14 06:37:51', '2021-01-14 10:57:23'),
(2, 1, 'asdasd', 'adsasd', 'adsasd', '/uploads/products/Jack /0e93760daadcf3017a35254b3476a25d.jpg', '2021-01-14 10:45:43', '/uploads/products/Jack /thumb_0e93760daadcf3017a35254b3476a25d.jpg', 1, '2021-01-14 10:11:12', '2021-01-14 10:45:43'),
(3, 1, 'test 33', 'asdasd', 'asdasd', '/uploads/products/298878.jpg', NULL, '/uploads/products/thumb_298878.jpg', 1, '2021-01-14 10:59:04', '2021-01-14 10:59:04'),
(4, 1, 'asddas', 'asddas', 'adsas', '/uploads/products/15674.jpg', NULL, '/uploads/products/thumb_15674.jpg', 1, '2021-01-14 11:28:26', '2021-01-14 11:28:26'),
(5, 1, 'asddas', 'asddas', 'asdasda', '/uploads/products/121694.jpg', NULL, '/uploads/products/thumb_121694.jpg', 1, '2021-01-14 11:29:44', '2021-01-14 11:29:44'),
(6, 1, 'asddassad', 'asddassad', 'asdasd', '/uploads/products/910517-millionaire-wallpapers-1920x1080-for-iphone-5.jpg', NULL, '/uploads/products/thumb_910517-millionaire-wallpapers-1920x1080-for-iphone-5.jpg', 1, '2021-01-14 11:38:54', '2021-01-14 11:47:54'),
(7, 1, 'adsas', 'adsas', 'asdasd', '/uploads/products/502694.jpg', NULL, '/uploads/products/thumb_502694.jpg', 1, '2021-01-14 11:54:41', '2021-01-14 11:54:41'),
(8, 1, 'adsasd', 'adsasd', 'asdasd', '/uploads/products/298878.jpg', NULL, '/uploads/products/thumb_298878.jpg', 1, '2021-01-14 11:54:49', '2021-01-14 11:54:49'),
(9, 1, 'asddas', 'asddas-1', 'asdasd', '/uploads/products/99195-space.jpg', NULL, '/uploads/products/thumb_99195-space.jpg', 1, '2021-01-14 11:56:23', '2021-01-14 11:56:23');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `user_type` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `user_type`, `name`, `email`, `password`) VALUES
(1, 1, 'Jack ', 'jack@email.com', '$2y$12$e3nEWh5Dar1GQN7ZqiTR0emuboRrbQ2D92qqVtAFqylLKj6pVr6I2'),
(2, 2, 'John', 'john@email.com', '$2y$12$5gmL9J96Ie4wHf0ZCUTGWO06H4p.nHq8hJwLsxCHPQOnr3QK4FK2m'),
(3, 3, 'David', 'david@email.com', '$2y$12$mcoJWp7HiDA1douMiIgZDuBuLZxTQlwjgfJk1FCwPNQVe6OXnHqxi');

-- --------------------------------------------------------

--
-- Table structure for table `user_type`
--

CREATE TABLE `user_type` (
  `id` int(11) NOT NULL,
  `type` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_type`
--

INSERT INTO `user_type` (`id`, `type`) VALUES
(1, 'Super Admin'),
(2, 'Editor'),
(3, 'Reader');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_type`
--
ALTER TABLE `user_type`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `user_type`
--
ALTER TABLE `user_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
