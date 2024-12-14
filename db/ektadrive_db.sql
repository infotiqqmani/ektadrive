-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Dec 12, 2024 at 12:02 PM
-- Server version: 10.11.10-MariaDB
-- PHP Version: 8.3.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ektadrive_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE `departments` (
  `id` int(11) NOT NULL,
  `dept_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`id`, `dept_name`, `created_at`, `updated_at`) VALUES
(17, 'Product Design', '2024-07-29 23:46:25', '2024-07-29 23:46:25'),
(18, 'Accounts', '2024-07-29 23:46:45', '2024-07-29 23:46:45'),
(19, 'Marketing', '2024-07-29 23:47:20', '2024-07-29 23:47:20'),
(20, 'Design and Packaging', '2024-07-29 23:48:41', '2024-07-29 23:48:41'),
(21, 'Legal', '2024-07-29 23:48:55', '2024-07-29 23:48:55'),
(22, 'Human Resource', '2024-07-29 23:49:22', '2024-07-29 23:49:22'),
(23, 'Quality', '2024-07-29 23:49:38', '2024-07-29 23:49:38'),
(24, 'Process', '2024-07-29 23:49:47', '2024-07-29 23:49:47'),
(25, 'Junto', '2024-07-29 23:50:06', '2024-07-29 23:50:06');

-- --------------------------------------------------------

--
-- Table structure for table `files`
--

CREATE TABLE `files` (
  `id` int(11) NOT NULL,
  `file_name` varchar(255) NOT NULL,
  `folder_id` int(11) DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `extension` varchar(255) NOT NULL,
  `status` enum('0','1') NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `files`
--

INSERT INTO `files` (`id`, `file_name`, `folder_id`, `user_id`, `extension`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(115, 'ritu-sharma-1732184588-antiqq1024logo.png', NULL, 21, 'png', '0', '2024-11-21 10:23:08', '2024-11-21 04:53:08', NULL),
(116, 'ritu-sharma-1732263452-united-price-price-list-v27082024-rtp.pdf', 41, 21, 'pdf', '0', '2024-11-22 08:17:32', '2024-11-22 02:47:32', NULL),
(117, 'ritu-sharma-1732263478-ucook-price-price-list-v17082024-rtp-curve.pdf', 41, 21, 'pdf', '0', '2024-11-22 08:17:58', '2024-11-22 02:47:58', NULL),
(118, 'ritu-sharma-1732263496-salford-price-list-nov-2024-rtp.pdf', 41, 21, 'pdf', '0', '2024-11-22 08:18:16', '2024-11-22 02:48:16', NULL),
(119, 'ritu-sharma-1732263531-junto-home-appliance-august-2024-rtp.pdf', 41, 21, 'pdf', '0', '2024-11-22 08:18:51', '2024-11-22 02:48:51', NULL),
(120, 'ritu-sharma-1732263548-junto-cooktops-a5-poster-z-series-august-2024-rtp.pdf', 41, 21, 'pdf', '0', '2024-11-22 08:19:08', '2024-11-22 02:49:08', NULL),
(121, 'ritu-sharma-1732263569-junto-cooktop-chimney-hobs-august-2024-rtp.pdf', 41, 21, 'pdf', '0', '2024-11-22 08:19:29', '2024-11-22 02:49:29', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `folders`
--

CREATE TABLE `folders` (
  `id` int(11) NOT NULL,
  `folder_name` varchar(255) NOT NULL,
  `user_id` int(11) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `folders`
--

INSERT INTO `folders` (`id`, `folder_name`, `user_id`, `slug`, `parent_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(38, 'Ad Creative', 21, 'ad-creative', NULL, '2024-11-21 04:50:06', '2024-11-21 04:50:06', NULL),
(39, 'Instagram Post', 21, 'instagram-post', NULL, '2024-11-21 04:50:55', '2024-11-21 04:50:55', NULL),
(40, 'Test', 21, 'test', 39, '2024-11-21 04:52:07', '2024-11-21 04:52:07', NULL),
(41, 'Brand Catalogues', 21, 'brand-catalogues', NULL, '2024-11-22 02:46:53', '2024-11-22 02:46:53', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(23, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(24, '2024_05_03_094628_create_departments_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `shares`
--

CREATE TABLE `shares` (
  `id` int(11) NOT NULL,
  `share_to` int(11) NOT NULL,
  `share_from` int(11) NOT NULL,
  `file_id` int(11) NOT NULL,
  `folder_id` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `teamleads`
--

CREATE TABLE `teamleads` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `dept_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(250) NOT NULL,
  `role` enum('1','2','3') NOT NULL DEFAULT '3',
  `previous_role` varchar(10) DEFAULT NULL,
  `mobile` varchar(20) NOT NULL,
  `profile_img` varchar(255) DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `dept_id` int(11) DEFAULT NULL,
  `team_lead` enum('0','1') DEFAULT '0',
  `status` enum('0','1') NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `role`, `previous_role`, `mobile`, `profile_img`, `email_verified_at`, `dept_id`, `team_lead`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Admin Name', 'admin@unitedektagroup.com', '$2y$10$EwYs0hfrnCKtTxq9i/v7H.4pCNKE4nEUw/8/CR4cZPCPVP6LFBy6W', '1', NULL, '9999999999', NULL, NULL, NULL, '0', '0', '2024-07-30 05:15:37', '2024-07-30 00:10:40'),
(12, 'Rahul', 'rahulunitedektagroup@gmail.com', '$2y$10$lcxWArL5AuefhAEG0KraYe2bihFojKWjyKfwPIYcozn.SvDF1Rr6S', '2', NULL, '8810608415', NULL, NULL, 17, '1', '1', '2024-07-29 23:55:35', '2024-07-29 23:57:32'),
(13, 'Sanjeev', 'sanjeev@unitedektagroup.com', '$2y$10$.Yzf1z4HVJvM8N5sO4I/ZuB6mR5KWIHPnh1F3W.hfs20tjCOPfDeK', '2', NULL, '9958372665', NULL, NULL, 18, '1', '1', '2024-07-30 00:00:55', '2024-07-30 00:00:59'),
(14, 'Parag', 'parag@unitedektagroup.com', '$2y$10$kDfwQBTUn5fG/..Ts0sWOez6a4GwQVYG4VTryFnyqrOHx9bwKdmka', '2', NULL, '8010808615', NULL, NULL, 19, '1', '1', '2024-07-30 00:01:56', '2024-11-21 04:46:10'),
(15, 'Amit Mishra', 'amit.mishra@unitedektagroup.com', '$2y$10$A2.uVB09U/gFsuCaJTmonuCYcKhQUqYvY4g6SRM2u/HRaoi1Hh8gu', '2', NULL, '9811565375', NULL, NULL, 21, '1', '1', '2024-07-30 00:02:59', '2024-11-21 04:46:07'),
(16, 'Rohit Sinha', 'chro@unitedektagroup.com', '$2y$10$hkrO76awxju.eRnAlkyjb.qcqUnj5GX/t3jaBgEuY0NyUzcKKe5PG', '2', NULL, '9431327833', NULL, NULL, 22, '1', '1', '2024-07-30 00:03:55', '2024-11-21 05:02:25'),
(17, 'Ashish Kaur', 'Quality@unitedektagroup.com', '$2y$10$EKiTMO5jOTyEyJR.RBpDp.OgyXxqJmh/pOb8wNEk4XG8SE0df.cfS', '2', NULL, '9871172719', NULL, NULL, 23, '1', '1', '2024-07-30 00:05:06', '2024-11-21 04:45:57'),
(18, 'Neeraj Joshi', 'neeraj.joshi@unitedektagroup.com', '$2y$10$sFl22.5RXlLjS7I9aipLTO36xejwQDHvcuD5xSItmv8Yeci0a9hOe', '2', NULL, '9767031766', NULL, NULL, 25, '1', '1', '2024-07-30 00:06:22', '2024-11-21 04:45:54'),
(19, 'Amit Saxena', 'amitsaxena@unitedektagroup.com', '$2y$10$wvRqWYN01xq9Sv7Mb8VU6eMaL0m8YXTDZvm.88p4c2N4mz6LguV3e', '2', NULL, '8287644344', NULL, NULL, 24, '1', '1', '2024-07-30 00:07:13', '2024-11-21 04:45:52'),
(20, 'Parag', 'parag@unitedcooker.com', '$2y$10$Ggok1tEVe9jJnJLYwn7w4.trHo6Ge563aeB.NDGiueDegs/LhEDoG', '2', NULL, '8010808615', NULL, NULL, 20, '1', '1', '2024-11-21 04:45:28', '2024-11-21 05:03:20'),
(21, 'Ritu Sharma', 'marketing@unitedektagroup.com', '$2y$10$4JfH1QCP1BTwCixNIWcZeuQ6h0HerO9PfwdNd/TqfU9exAyGWm1a.', '3', NULL, '9205010091', NULL, NULL, 19, '0', '1', '2024-11-21 04:47:39', '2024-11-21 04:47:49'),
(22, 'Imran Rahman', 'designer@unitedektagroup.com', '$2y$10$pw4jG2VbQXuc39P4uPfnx.3BCrUz7gx/BieAq8zwuqZaBk1l4KiHa', '3', NULL, '9999505707', NULL, NULL, 20, '0', '1', '2024-11-21 04:57:05', '2024-11-21 04:57:55'),
(23, 'Sweta Sharma', 'hr@unitedektagroup.com', '$2y$10$tkaVxwkM65FCS5EEUi5K0eZkUKFCYb6ePfxwvy.A9Bnfz3TYVqWhu', '', '3', '7906612359', NULL, NULL, 22, '0', '0', '2024-11-21 05:06:56', '2024-12-11 06:18:29');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `files`
--
ALTER TABLE `files`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `folder_id` (`folder_id`);

--
-- Indexes for table `folders`
--
ALTER TABLE `folders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `shares`
--
ALTER TABLE `shares`
  ADD PRIMARY KEY (`id`),
  ADD KEY `file_id` (`file_id`),
  ADD KEY `folder_id` (`folder_id`),
  ADD KEY `share_from` (`share_from`),
  ADD KEY `share_to` (`share_to`);

--
-- Indexes for table `teamleads`
--
ALTER TABLE `teamleads`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `dept_id` (`dept_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `departments`
--
ALTER TABLE `departments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `files`
--
ALTER TABLE `files`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=122;

--
-- AUTO_INCREMENT for table `folders`
--
ALTER TABLE `folders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `shares`
--
ALTER TABLE `shares`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=183;

--
-- AUTO_INCREMENT for table `teamleads`
--
ALTER TABLE `teamleads`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `files`
--
ALTER TABLE `files`
  ADD CONSTRAINT `files_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `files_ibfk_2` FOREIGN KEY (`folder_id`) REFERENCES `folders` (`id`) ON DELETE SET NULL ON UPDATE SET NULL;

--
-- Constraints for table `folders`
--
ALTER TABLE `folders`
  ADD CONSTRAINT `folders_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `shares`
--
ALTER TABLE `shares`
  ADD CONSTRAINT `shares_ibfk_1` FOREIGN KEY (`file_id`) REFERENCES `files` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `shares_ibfk_2` FOREIGN KEY (`folder_id`) REFERENCES `folders` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `shares_ibfk_3` FOREIGN KEY (`share_from`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `shares_ibfk_4` FOREIGN KEY (`share_to`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`dept_id`) REFERENCES `departments` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
