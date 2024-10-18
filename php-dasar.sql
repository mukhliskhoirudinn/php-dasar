-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Sep 25, 2024 at 04:55 AM
-- Server version: 8.0.30
-- PHP Version: 8.3.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `php-dasar`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id_category` bigint NOT NULL,
  `title` varchar(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `slug` varchar(128) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id_category`, `title`, `slug`, `created_at`) VALUES
(38, 'Ad modi tempora plac', 'ad-modi-tempora-plac', '2024-09-24 05:49:59'),
(39, 'Quis pariatur Illum', 'quis-pariatur-illum', '2024-09-24 08:47:54');

-- --------------------------------------------------------

--
-- Table structure for table `films`
--

CREATE TABLE `films` (
  `id_film` bigint NOT NULL,
  `category_id` bigint NOT NULL,
  `url` varchar(128) NOT NULL,
  `title` varchar(128) NOT NULL,
  `slug` varchar(128) NOT NULL,
  `description` text NOT NULL,
  `release_date` date NOT NULL,
  `studio` varchar(128) NOT NULL,
  `is_private` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `films`
--

INSERT INTO `films` (`id_film`, `category_id`, `url`, `title`, `slug`, `description`, `release_date`, `studio`, `is_private`, `created_at`) VALUES
(14, 27, 'Ab dolorum et provid', 'Suscipit qui proiden', 'suscipit-qui-proiden', 'Molestiae provident', '1975-07-25', 'Anim velit sit persp', 0, '2024-09-19 18:03:26'),
(29, 25, 'Enim voluptas asperi', 'Rerum sapiente rerum', 'rerum-sapiente-rerum', 'Sunt dolor vel tempo', '1973-10-21', 'Totam aspernatur inc', 0, '2024-09-21 07:27:51'),
(30, 25, 'In blanditiis beatae', 'Totam sint quidem f', 'totam-sint-quidem-f', 'Id recusandae Sunt', '2024-02-25', 'Est rem earum omnis', 0, '2024-09-21 07:28:12'),
(33, 33, 'Perspiciatis pariat', 'Impedit ex quaerat', 'impedit-ex-quaerat', 'Consectetur sunt i', '1977-10-09', 'In similique excepte', 0, '2024-09-21 15:37:20'),
(35, 29, 'Quis quo sunt autem', 'Voluptas mollit amet', 'voluptas-mollit-amet', 'Aut corporis earum a', '1984-12-09', 'Ad incididunt duis d', 0, '2024-09-24 04:13:19'),
(40, 32, 'Non amet tempore u', 'Id nulla velit elig', 'id-nulla-velit-elig', 'Elit dolor iusto es', '2021-12-13', 'Irure reiciendis in', 0, '2024-09-24 08:47:44'),
(41, 39, 'Iusto dolorum labori', 'Culpa aut explicabo', 'culpa-aut-explicabo', 'Distinctio In qui o', '2012-02-10', 'Et qui architecto qu', 0, '2024-09-24 10:50:52'),
(43, 40, 'Officiis impedit re', 'Porro id magnam tene', 'porro-id-magnam-tene', 'Nam repudiandae iure', '1979-02-22', 'Amet amet labore a', 0, '2024-09-24 10:51:24'),
(44, 39, 'Nobis et voluptatem', 'Commodi culpa non re', 'commodi-culpa-non-re', 'Minus numquam sunt', '2011-10-01', 'Voluptatem exercitat', 0, '2024-09-24 11:10:32');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id_user` int NOT NULL,
  `username` varchar(128) NOT NULL,
  `email` varchar(128) NOT NULL,
  `password` varchar(256) NOT NULL,
  `role` varchar(60) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT 'operator' COMMENT 'admin, operator',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id_user`, `username`, `email`, `password`, `role`, `created_at`) VALUES
(26, 'operator', 'operator@gmail.com', '$2y$10$OZuaz7SJDvoSxJqUqHnR9uu/.CiAJp/LqnzooqKa8XKKAlkzJGiEO', 'operator', '2024-09-24 08:42:03'),
(44, 'admin', 'admin@gmail.com', '$2y$10$qYYScqThNxXdoApmwfBc9Onafqx/P9TlNMOtc9JNZSvbOjPqpp0Bq', 'admin', '2024-09-24 13:55:13');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id_category`);

--
-- Indexes for table `films`
--
ALTER TABLE `films`
  ADD PRIMARY KEY (`id_film`),
  ADD KEY `categories.id` (`category_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id_category` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `films`
--
ALTER TABLE `films`
  MODIFY `id_film` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
