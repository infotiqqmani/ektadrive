-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 13, 2024 at 01:32 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 7.4.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `storage_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE `departments` (
  `id` int(255) NOT NULL,
  `dept_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`id`, `dept_name`, `created_at`, `updated_at`) VALUES
(7, 'Social Midea', '2024-05-08 01:12:36', '2024-05-08 01:12:36'),
(8, 'Network Department', '2024-05-08 05:13:48', '2024-05-08 05:13:48'),
(9, 'HR', '2024-05-08 05:14:33', '2024-05-08 05:14:33'),
(10, 'Developer Team', '2024-05-08 06:15:30', '2024-05-08 06:15:30'),
(20, 'Testing Department', '2024-06-05 01:42:54', '2024-06-05 01:42:54'),
(21, 'New Department', '2024-06-11 00:22:26', '2024-06-11 00:22:26'),
(22, 'new depar', '2024-06-11 00:25:07', '2024-06-11 00:25:07');

-- --------------------------------------------------------

--
-- Table structure for table `files`
--

CREATE TABLE `files` (
  `id` int(255) NOT NULL,
  `file_name` varchar(255) NOT NULL,
  `folder_id` int(255) DEFAULT NULL,
  `user_id` int(255) NOT NULL,
  `extension` varchar(255) NOT NULL,
  `status` enum('0','1') NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `files`
--

INSERT INTO `files` (`id`, `file_name`, `folder_id`, `user_id`, `extension`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(3449, 'sandeep-verma-1718270916-screenshot-1.png', NULL, 75, 'png', '0', '2024-06-13 03:58:36', '2024-06-13 03:59:40', '2024-06-13 03:59:40'),
(3450, 'sandeep-verma-1718270916-screenshot-2.png', NULL, 75, 'png', '0', '2024-06-13 03:58:36', '2024-06-13 03:58:36', NULL),
(3451, 'sandeep-verma-1718270916-screenshot-3.png', NULL, 75, 'png', '0', '2024-06-13 03:58:36', '2024-06-13 03:58:36', NULL),
(3452, 'sandeep-verma-1718270916-screenshot-5.png', NULL, 75, 'png', '0', '2024-06-13 03:58:36', '2024-06-13 03:59:42', '2024-06-13 03:59:42'),
(3453, 'sandeep-verma-1718270916-screenshot-6.png', NULL, 75, 'png', '0', '2024-06-13 03:58:36', '2024-06-13 03:59:44', '2024-06-13 03:59:44'),
(3454, 'sandeep-verma-1718270916-screenshot-7.png', NULL, 75, 'png', '0', '2024-06-13 03:58:36', '2024-06-13 03:59:46', '2024-06-13 03:59:46'),
(3455, 'sandeep-verma-1718270916-screenshot-9.png', NULL, 75, 'png', '0', '2024-06-13 03:58:36', '2024-06-13 03:59:49', '2024-06-13 03:59:49'),
(3456, 'sandeep-verma-1718270916-screenshot-10.png', NULL, 75, 'png', '0', '2024-06-13 03:58:36', '2024-06-13 03:59:54', '2024-06-13 03:59:54'),
(3457, 'sandeep-verma-1718270916-screenshot-11.png', NULL, 75, 'png', '0', '2024-06-13 03:58:36', '2024-06-13 03:58:36', NULL),
(3458, '1718271032-666abc38b3c2d-Screenshot (1).png', 166, 75, 'png', '0', '2024-06-13 04:00:32', '2024-06-13 04:00:32', NULL),
(3459, '1718271032-666abc38b592b-Screenshot (2).png', 166, 75, 'png', '0', '2024-06-13 04:00:32', '2024-06-13 04:36:21', '2024-06-13 04:36:21'),
(3460, '1718271032-666abc38b7cb5-Screenshot (3).png', 166, 75, 'png', '0', '2024-06-13 04:00:32', '2024-06-13 04:00:32', NULL),
(3461, '1718271032-666abc38b932a-Screenshot (5).png', 166, 75, 'png', '0', '2024-06-13 04:00:32', '2024-06-13 04:00:32', NULL),
(3462, '1718271032-666abc38ba9c0-Screenshot (6).png', 166, 75, 'png', '0', '2024-06-13 04:00:32', '2024-06-13 04:00:32', NULL),
(3463, '1718271032-666abc38bc02c-Screenshot (7).png', 166, 75, 'png', '0', '2024-06-13 04:00:32', '2024-06-13 04:36:27', '2024-06-13 04:36:27'),
(3464, '1718271032-666abc38bd666-Screenshot (9).png', 166, 75, 'png', '0', '2024-06-13 04:00:32', '2024-06-13 04:00:32', NULL),
(3465, '1718271032-666abc38beca7-Screenshot (10).png', 166, 75, 'png', '0', '2024-06-13 04:00:32', '2024-06-13 04:00:32', NULL),
(3466, '1718271032-666abc38c031e-Screenshot (11).png', 166, 75, 'png', '0', '2024-06-13 04:00:32', '2024-06-13 04:00:32', NULL),
(3467, '1718271646-666abe9e87b0a-चूनाव के नतीजे और खुशी की लहर _ Loksabha Election Result 2024 _ NDA _ INDIA _ Naiya Paar.mp4', 166, 75, 'mp4', '0', '2024-06-13 04:10:46', '2024-06-13 04:10:46', NULL),
(3468, '1718272614-666ac266d3b76-world-breaking-news-digital-earth-hud-rotating-globe-rotating-free-video.jpg', 166, 75, 'jpg', '0', '2024-06-13 04:26:54', '2024-06-13 04:36:24', '2024-06-13 04:36:24'),
(3469, '1718273095-666ac44771492-1717884429-6664d60d56b32-Screenshot (9).png', 166, 75, 'png', '0', '2024-06-13 04:34:55', '2024-06-13 04:34:55', NULL),
(3470, '1718273201-666ac4b1c6668-world-breaking-news-digital-earth-hud-rotating-globe-rotating-free-video.jpg', 166, 75, 'jpg', '0', '2024-06-13 04:36:41', '2024-06-13 04:36:41', NULL),
(3471, '1718273285-666ac505d6eef-world-breaking-news-digital-earth-hud-rotating-globe-rotating-free-videojasda  jhhajabdkajd kjhdeh xdh iudkjfgsfgsfgks.jpg', 166, 75, 'jpg', '0', '2024-06-13 04:38:05', '2024-06-13 04:38:05', NULL),
(3472, 'sandeep-verma-1718273556-world-breaking-news-digital-earth-hud-rotating-globe-rotating-free-videojasda-jhhajabdkajd-kjhdeh-xdh-iudkjfgsfgsfgks.jpg', NULL, 75, 'jpg', '0', '2024-06-13 04:42:36', '2024-06-13 04:42:36', NULL),
(3473, '1718275175-666acc673906d-Screenshot (1).png', 167, 82, 'png', '0', '2024-06-13 05:09:35', '2024-06-13 05:09:35', NULL),
(3474, '1718275175-666acc673a7ff-Screenshot (2).png', 167, 82, 'png', '0', '2024-06-13 05:09:35', '2024-06-13 05:09:35', NULL),
(3475, '1718275175-666acc673bdaf-Screenshot (3).png', 167, 82, 'png', '0', '2024-06-13 05:09:35', '2024-06-13 05:09:35', NULL),
(3476, '1718275175-666acc673dd7a-Screenshot (4).png', 167, 82, 'png', '0', '2024-06-13 05:09:35', '2024-06-13 05:09:35', NULL),
(3477, '1718275175-666acc673ef1e-Screenshot (5).png', 167, 82, 'png', '0', '2024-06-13 05:09:35', '2024-06-13 05:09:35', NULL),
(3478, '1718275175-666acc673fef3-Screenshot (6).png', 167, 82, 'png', '0', '2024-06-13 05:09:35', '2024-06-13 05:09:35', NULL),
(3479, '1718275175-666acc6741171-Screenshot (7).png', 167, 82, 'png', '0', '2024-06-13 05:09:35', '2024-06-13 05:09:35', NULL),
(3480, '1718275175-666acc6742511-Screenshot (8).png', 167, 82, 'png', '0', '2024-06-13 05:09:35', '2024-06-13 05:09:35', NULL),
(3481, '1718275175-666acc67438c7-Screenshot (9).png', 167, 82, 'png', '0', '2024-06-13 05:09:35', '2024-06-13 05:09:35', NULL),
(3482, '1718275175-666acc6744abc-Screenshot (10).png', 167, 82, 'png', '0', '2024-06-13 05:09:35', '2024-06-13 05:09:35', NULL),
(3483, '1718275175-666acc6745dae-Screenshot (11).png', 167, 82, 'png', '0', '2024-06-13 05:09:35', '2024-06-13 05:09:35', NULL),
(3484, '1718275175-666acc6746fdf-Screenshot (12).png', 167, 82, 'png', '0', '2024-06-13 05:09:35', '2024-06-13 05:09:35', NULL),
(3485, '1718275175-666acc6749081-Screenshot (13).png', 167, 82, 'png', '0', '2024-06-13 05:09:35', '2024-06-13 05:09:35', NULL),
(3486, '1718275175-666acc674b68e-Screenshot (14).png', 167, 82, 'png', '0', '2024-06-13 05:09:35', '2024-06-13 05:09:35', NULL),
(3487, '1718275175-666acc674df3c-Screenshot (15).png', 167, 82, 'png', '0', '2024-06-13 05:09:35', '2024-06-13 05:09:35', NULL),
(3488, '1718275175-666acc674f8dc-Screenshot (16).png', 167, 82, 'png', '0', '2024-06-13 05:09:35', '2024-06-13 05:09:35', NULL),
(3489, '1718275562-666acdea884ba-world-breaking-news-digital-earth-hud-rotating-globe-rotating-free-videojasda  jhhajabdkajd kjhdeh xdh iudkjfgsfgsfgks.jpg', 167, 82, 'jpg', '0', '2024-06-13 05:16:02', '2024-06-13 05:16:02', NULL),
(3490, 'rahul-1718275630-world-breaking-news-digital-earth-hud-rotating-globe-rotating-free-videojasda-jhhajabdkajd-kjhdeh-xdh-iudkjfgsfgsfgks.jpg', NULL, 74, 'jpg', '0', '2024-06-13 05:17:10', '2024-06-13 05:17:10', NULL),
(3491, 'rahul-1718275744-screenshot-1.png', NULL, 74, 'png', '0', '2024-06-13 05:19:04', '2024-06-13 05:19:04', NULL),
(3492, 'rahul-1718275744-screenshot-2.png', NULL, 74, 'png', '0', '2024-06-13 05:19:04', '2024-06-13 05:19:04', NULL),
(3493, 'rahul-1718275744-screenshot-3.png', NULL, 74, 'png', '0', '2024-06-13 05:19:04', '2024-06-13 05:19:04', NULL),
(3494, 'rahul-1718275744-screenshot-4.png', NULL, 74, 'png', '0', '2024-06-13 05:19:04', '2024-06-13 05:19:04', NULL),
(3495, 'rahul-1718275744-screenshot-5.png', NULL, 74, 'png', '0', '2024-06-13 05:19:04', '2024-06-13 05:19:04', NULL),
(3496, 'rahul-1718275744-screenshot-6.png', NULL, 74, 'png', '0', '2024-06-13 05:19:04', '2024-06-13 05:19:04', NULL),
(3497, 'rahul-1718275744-screenshot-7.png', NULL, 74, 'png', '0', '2024-06-13 05:19:04', '2024-06-13 05:19:04', NULL),
(3498, 'rahul-1718275744-screenshot-8.png', NULL, 74, 'png', '0', '2024-06-13 05:19:04', '2024-06-13 05:19:04', NULL),
(3499, 'rahul-1718275744-screenshot-9.png', NULL, 74, 'png', '0', '2024-06-13 05:19:04', '2024-06-13 05:19:04', NULL),
(3500, 'rahul-1718275744-screenshot-10.png', NULL, 74, 'png', '0', '2024-06-13 05:19:04', '2024-06-13 05:19:04', NULL),
(3501, 'rahul-1718275744-screenshot-11.png', NULL, 74, 'png', '0', '2024-06-13 05:19:04', '2024-06-13 05:19:04', NULL),
(3502, 'rahul-1718275744-screenshot-12.png', NULL, 74, 'png', '0', '2024-06-13 05:19:04', '2024-06-13 05:19:04', NULL),
(3503, 'rahul-1718275744-screenshot-13.png', NULL, 74, 'png', '0', '2024-06-13 05:19:04', '2024-06-13 05:19:04', NULL),
(3504, 'rahul-1718275744-screenshot-14.png', NULL, 74, 'png', '0', '2024-06-13 05:19:04', '2024-06-13 05:19:04', NULL),
(3505, 'rahul-1718275744-screenshot-15.png', NULL, 74, 'png', '0', '2024-06-13 05:19:04', '2024-06-13 05:19:04', NULL),
(3506, 'rahul-1718275744-screenshot-16.png', NULL, 74, 'png', '0', '2024-06-13 05:19:04', '2024-06-13 05:19:04', NULL),
(3507, 'rahul-1718275744-screenshot-17.png', NULL, 74, 'png', '0', '2024-06-13 05:19:04', '2024-06-13 05:19:04', NULL),
(3508, 'rahul-1718275744-screenshot-18.png', NULL, 74, 'png', '0', '2024-06-13 05:19:04', '2024-06-13 05:19:04', NULL),
(3509, 'rahul-1718275744-screenshot-19.png', NULL, 74, 'png', '0', '2024-06-13 05:19:04', '2024-06-13 05:19:04', NULL),
(3510, 'rahul-1718275744-screenshot-20.png', NULL, 74, 'png', '0', '2024-06-13 05:19:04', '2024-06-13 05:19:04', NULL),
(3511, '1718275979-666acf8b1ce7f-Screenshot (1).png', 168, 74, 'png', '0', '2024-06-13 05:22:59', '2024-06-13 05:22:59', NULL),
(3512, '1718275979-666acf8b1e81f-Screenshot (2).png', 168, 74, 'png', '0', '2024-06-13 05:22:59', '2024-06-13 05:22:59', NULL),
(3513, '1718275979-666acf8b200b6-Screenshot (3).png', 168, 74, 'png', '0', '2024-06-13 05:22:59', '2024-06-13 05:22:59', NULL),
(3514, '1718275979-666acf8b21a43-Screenshot (4).png', 168, 74, 'png', '0', '2024-06-13 05:22:59', '2024-06-13 05:22:59', NULL),
(3515, '1718275979-666acf8b2340f-Screenshot (5).png', 168, 74, 'png', '0', '2024-06-13 05:22:59', '2024-06-13 05:22:59', NULL),
(3516, '1718275979-666acf8b24846-Screenshot (6).png', 168, 74, 'png', '0', '2024-06-13 05:22:59', '2024-06-13 05:22:59', NULL),
(3517, '1718275979-666acf8b25c79-Screenshot (7).png', 168, 74, 'png', '0', '2024-06-13 05:22:59', '2024-06-13 05:22:59', NULL),
(3518, '1718275979-666acf8b270f9-Screenshot (8).png', 168, 74, 'png', '0', '2024-06-13 05:22:59', '2024-06-13 05:22:59', NULL),
(3519, '1718275979-666acf8b28408-Screenshot (9).png', 168, 74, 'png', '0', '2024-06-13 05:22:59', '2024-06-13 05:22:59', NULL),
(3520, '1718275979-666acf8b29b1e-Screenshot (10).png', 168, 74, 'png', '0', '2024-06-13 05:22:59', '2024-06-13 05:22:59', NULL),
(3521, '1718275979-666acf8b2c97e-Screenshot (11).png', 168, 74, 'png', '0', '2024-06-13 05:22:59', '2024-06-13 05:22:59', NULL),
(3522, '1718275979-666acf8b2dc09-Screenshot (12).png', 168, 74, 'png', '0', '2024-06-13 05:22:59', '2024-06-13 05:22:59', NULL),
(3523, '1718275979-666acf8b2f123-Screenshot (13).png', 168, 74, 'png', '0', '2024-06-13 05:22:59', '2024-06-13 05:22:59', NULL),
(3524, '1718275979-666acf8b30648-Screenshot (14).png', 168, 74, 'png', '0', '2024-06-13 05:22:59', '2024-06-13 05:22:59', NULL),
(3525, '1718275979-666acf8b319d1-Screenshot (15).png', 168, 74, 'png', '0', '2024-06-13 05:22:59', '2024-06-13 05:22:59', NULL),
(3526, '1718275979-666acf8b32f79-Screenshot (16).png', 168, 74, 'png', '0', '2024-06-13 05:22:59', '2024-06-13 05:22:59', NULL),
(3527, '1718276862-666ad2fe1c3a1-world-breaking-news-digital-earth-hud-rotating-globe-rotating-free-videojasda  jhhajabdkajd kjhdeh xdh iudkjfgsfgsfgks.jpg', 168, 74, 'jpg', '0', '2024-06-13 05:37:42', '2024-06-13 05:37:42', NULL),
(3528, '1718276946-666ad3523f5f8-1717886126-6664dcae1ff9a-Screenshot (5).png', 168, 74, 'png', '0', '2024-06-13 05:39:06', '2024-06-13 05:39:06', NULL),
(3529, 'dummy-1718277354-screenshot-1.png', NULL, 82, 'png', '0', '2024-06-13 05:45:54', '2024-06-13 05:45:54', NULL),
(3530, 'dummy-1718277354-screenshot-2.png', NULL, 82, 'png', '0', '2024-06-13 05:45:54', '2024-06-13 05:45:54', NULL),
(3531, 'dummy-1718277354-screenshot-3.png', NULL, 82, 'png', '0', '2024-06-13 05:45:54', '2024-06-13 05:45:54', NULL),
(3532, 'dummy-1718277354-screenshot-5.png', NULL, 82, 'png', '0', '2024-06-13 05:45:54', '2024-06-13 05:45:54', NULL),
(3533, 'dummy-1718277354-screenshot-6.png', NULL, 82, 'png', '0', '2024-06-13 05:45:54', '2024-06-13 05:45:54', NULL),
(3534, 'dummy-1718277354-screenshot-7.png', NULL, 82, 'png', '0', '2024-06-13 05:45:54', '2024-06-13 05:45:54', NULL),
(3535, 'dummy-1718277354-screenshot-9.png', NULL, 82, 'png', '0', '2024-06-13 05:45:54', '2024-06-13 05:45:54', NULL),
(3536, 'dummy-1718277354-screenshot-10.png', NULL, 82, 'png', '0', '2024-06-13 05:45:54', '2024-06-13 05:45:54', NULL),
(3537, 'dummy-1718277354-screenshot-11.png', NULL, 82, 'png', '0', '2024-06-13 05:45:54', '2024-06-13 05:45:54', NULL),
(3538, 'dummy-1718277601-rahul-1717884275-screenshot-2.png', NULL, 82, 'png', '0', '2024-06-13 05:50:01', '2024-06-13 05:50:01', NULL),
(3539, 'rahul-1718278204-world-breaking-news-digital-earth-hud-rotating-globe-rotating-free-videojasda-jhhajabdkajd-kjhdeh-xdh-iudkjfgsfgsfgks.jpg', NULL, 74, 'jpg', '0', '2024-06-13 06:00:04', '2024-06-13 06:00:04', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `folders`
--

CREATE TABLE `folders` (
  `id` int(255) NOT NULL,
  `parent_folder` int(255) DEFAULT NULL,
  `folder_name` varchar(255) NOT NULL DEFAULT 'no file name',
  `user_id` int(255) NOT NULL DEFAULT current_timestamp(),
  `slug` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `folders`
--

INSERT INTO `folders` (`id`, `parent_folder`, `folder_name`, `user_id`, `slug`, `created_at`, `updated_at`, `deleted_at`) VALUES
(164, NULL, 'First Folder', 75, 'first-folder', '2024-06-13 00:17:59', '2024-06-13 03:43:02', '2024-06-13 03:43:02'),
(165, NULL, 'Second folder', 75, 'second-folder', '2024-06-13 00:43:27', '2024-06-13 03:42:58', '2024-06-13 03:42:58'),
(166, NULL, 'my first folder', 75, 'my-first-folder', '2024-06-13 04:00:10', '2024-06-13 04:00:10', NULL),
(167, NULL, 'my new folder', 82, 'my-new-folder', '2024-06-13 05:09:09', '2024-06-13 05:09:09', NULL),
(168, NULL, 'team lead folder', 74, 'team-lead-folder', '2024-06-13 05:22:40', '2024-06-13 05:22:40', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
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
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
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
  `id` int(255) NOT NULL,
  `share_to` int(255) NOT NULL,
  `share_from` int(255) NOT NULL,
  `file_id` int(255) NOT NULL,
  `folder_id` int(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `shares`
--

INSERT INTO `shares` (`id`, `share_to`, `share_from`, `file_id`, `folder_id`, `created_at`, `updated_at`) VALUES
(3642, 82, 75, 3472, NULL, '2024-06-13 04:52:00', '2024-06-13 04:52:00'),
(3643, 82, 75, 3458, 166, '2024-06-13 04:53:52', '2024-06-13 04:53:52'),
(3644, 82, 75, 3460, 166, '2024-06-13 04:53:52', '2024-06-13 04:53:52'),
(3645, 82, 75, 3461, 166, '2024-06-13 04:53:52', '2024-06-13 04:53:52'),
(3646, 82, 75, 3462, 166, '2024-06-13 04:53:52', '2024-06-13 04:53:52'),
(3647, 82, 75, 3464, 166, '2024-06-13 04:53:52', '2024-06-13 04:53:52'),
(3648, 82, 75, 3465, 166, '2024-06-13 04:53:52', '2024-06-13 04:53:52'),
(3649, 82, 75, 3466, 166, '2024-06-13 04:53:52', '2024-06-13 04:53:52'),
(3650, 82, 75, 3467, 166, '2024-06-13 04:53:52', '2024-06-13 04:53:52'),
(3651, 82, 75, 3469, 166, '2024-06-13 04:53:52', '2024-06-13 04:53:52'),
(3652, 82, 75, 3470, 166, '2024-06-13 04:53:52', '2024-06-13 04:53:52'),
(3653, 82, 75, 3471, 166, '2024-06-13 04:53:52', '2024-06-13 04:53:52');

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
  `id` int(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(250) NOT NULL,
  `role` enum('0','1','2','3') DEFAULT '3',
  `previous_role` varchar(10) DEFAULT NULL,
  `mobile` varchar(20) NOT NULL,
  `profile_img` varchar(255) DEFAULT NULL,
  `email_verified_at` date DEFAULT current_timestamp(),
  `dept_id` int(255) NOT NULL,
  `team_lead` enum('0','1') DEFAULT '0',
  `status` enum('1','0') NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `role`, `previous_role`, `mobile`, `profile_img`, `email_verified_at`, `dept_id`, `team_lead`, `status`, `created_at`, `updated_at`) VALUES
(21, 'Infotiqq', 'zooneto@infotiqq.com', '$2y$10$FjxiNzCrXc6PXo.j2gYXpe8RTRQpr2YkGi6hNq1/Ial4Be6QB9zoG', '1', NULL, '9105869111', 'infotiqq_profile.jpg', '2024-05-08', 9, '0', '1', '2024-05-07 18:30:00', '2024-06-07 18:30:00'),
(74, 'Rahul', 'rahul.prasad@infotiqq.com', '$2y$10$iVa7bxApDLHLKfUP1sw4Luc88vnh4ynUuvdcfZBrr4m1qDmAKh4mK', '2', NULL, '9823479837', 'rahul_profile.jpg', '2024-06-07', 10, '1', '1', '2024-06-06 18:30:00', '2024-06-07 18:30:00'),
(75, 'Sandeep verma', 'sandeep.verma@infotiqq.com', '$2y$10$SeYLcXkcZHg/k492QOPwhuoaPNPC5B2O5O1uSFcO85Gq0OCN6dZqW', '3', NULL, '9105869116', 'sandeep-verma_profile.png', '2024-06-07', 10, '0', '1', '2024-06-06 18:30:00', '2024-06-10 18:30:00'),
(77, 'pranjal', 'sandeepchaursiya9105@gmail.com', '$2y$10$T6nJ7VTgsh4R1vRsnEkWJec/p69brtSQxXlerGawWenQe1SEBs3/G', '3', NULL, '7092742093', NULL, '2024-06-07', 7, '0', '1', '2024-06-06 18:30:00', '2024-06-06 18:30:00'),
(78, 'Shivani', 'aman.asif@infotiqq.com', '$2y$10$2LlaPVOzdpHmbT2HEp9WPOQ7Vhx/dnxGohXe.I1A9euUGJ8xXtIne', '3', NULL, '8734753489', 'shivani_profile.png', '2024-06-07', 10, '1', '1', '2024-06-06 18:30:00', '2024-06-10 18:30:00'),
(82, 'dummy', 'sandeepchaursiya2711200@gmail.com', '$2y$10$2LlaPVOzdpHmbT2HEp9WPOQ7Vhx/dnxGohXe.I1A9euUGJ8xXtIne', '3', NULL, '8429842984', NULL, '2024-06-11', 22, '0', '1', '2024-06-10 18:30:00', '2024-06-10 18:30:00');

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
  ADD KEY `user_id` (`user_id`),
  ADD KEY `parent_folder` (`parent_folder`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

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
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `files`
--
ALTER TABLE `files`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3540;

--
-- AUTO_INCREMENT for table `folders`
--
ALTER TABLE `folders`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=169;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `shares`
--
ALTER TABLE `shares`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3654;

--
-- AUTO_INCREMENT for table `teamleads`
--
ALTER TABLE `teamleads`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=83;

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
  ADD CONSTRAINT `folders_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `folders_ibfk_2` FOREIGN KEY (`parent_folder`) REFERENCES `folders` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `shares`
--
ALTER TABLE `shares`
  ADD CONSTRAINT `shares_ibfk_1` FOREIGN KEY (`file_id`) REFERENCES `files` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `shares_ibfk_2` FOREIGN KEY (`folder_id`) REFERENCES `folders` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `shares_ibfk_4` FOREIGN KEY (`share_from`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `shares_ibfk_5` FOREIGN KEY (`share_to`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`dept_id`) REFERENCES `departments` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
