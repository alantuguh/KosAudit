-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 03, 2026 at 02:55 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kosaudit`
--

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cache`
--

INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('laravel-cache-5c785c036466adea360111aa28563bfd556b5fba', 'i:1;', 1793438473),
('laravel-cache-5c785c036466adea360111aa28563bfd556b5fba:timer', 'i:1793438473;', 1793438473);

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` varchar(255) NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` smallint(5) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `master_items`
--

CREATE TABLE `master_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `master_items`
--

INSERT INTO `master_items` (`id`, `name`, `description`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Kasur', 'Kasur beserta rangka/dipan', '2026-10-31 01:52:22', '2026-10-31 01:52:22', NULL),
(2, 'Bantal', NULL, '2026-10-31 01:52:22', '2026-10-31 01:52:22', NULL),
(3, 'Lemari', 'Lemari pakaian', '2026-10-31 01:52:22', '2026-10-31 01:52:22', NULL),
(4, 'Meja', 'Meja belajar', '2026-10-31 01:52:22', '2026-10-31 01:52:22', NULL),
(5, 'Kursi', NULL, '2026-10-31 01:52:22', '2026-10-31 01:52:22', NULL),
(6, 'AC', 'Air conditioner beserta remote', '2026-10-31 01:52:22', '2026-10-31 01:52:22', NULL),
(7, 'Kipas Angin', NULL, '2026-10-31 01:52:22', '2026-10-31 01:52:22', NULL),
(8, 'Lampu', NULL, '2026-10-31 01:52:22', '2026-10-31 01:52:22', NULL),
(9, 'Stop Kontak', NULL, '2026-10-31 01:52:22', '2026-10-31 01:52:22', NULL),
(10, 'Kunci Pintu', 'Kunci dan anak kunci kamar', '2026-10-31 01:52:22', '2026-10-31 01:52:22', NULL),
(11, 'Pintu', NULL, '2026-10-31 01:52:22', '2026-10-31 01:52:22', NULL),
(12, 'Jendela', 'Kaca, engsel, dan gorden', '2026-10-31 01:52:22', '2026-10-31 01:52:22', NULL),
(13, 'Dinding', 'Cat dan permukaan dinding', '2026-10-31 01:52:22', '2026-10-31 01:52:22', NULL),
(14, 'Lantai', 'Keramik/ubin lantai', '2026-10-31 01:52:22', '2026-10-31 01:52:22', NULL),
(15, 'Kran Air', NULL, '2026-10-31 01:52:22', '2026-10-31 01:52:22', NULL),
(16, 'Shower', NULL, '2026-10-31 01:52:22', '2026-10-31 01:52:22', NULL),
(17, 'Kloset', NULL, '2026-10-31 01:52:22', '2026-10-31 01:52:22', NULL);

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
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2026_10_31_000001_create_rooms_table', 1),
(5, '2026_10_31_000002_create_master_items_table', 1),
(6, '2026_10_31_000003_create_room_master_item_table', 1),
(7, '2026_10_31_084231_create_personal_access_tokens_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` text NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `personal_access_tokens`
--

INSERT INTO `personal_access_tokens` (`id`, `tokenable_type`, `tokenable_id`, `name`, `token`, `abilities`, `last_used_at`, `expires_at`, `created_at`, `updated_at`) VALUES
(2, 'App\\Models\\User', 2, 'api', '7b2920ea89d00334f56ecdb8883e299b5489a48bb221f95385a960ba9e2f3034', '[\"*\"]', '2026-10-31 02:20:19', NULL, '2026-10-31 02:20:13', '2026-10-31 02:20:19');

-- --------------------------------------------------------

--
-- Table structure for table `rooms`
--

CREATE TABLE `rooms` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `room_number` varchar(10) NOT NULL,
  `type` varchar(50) NOT NULL,
  `monthly_price` int(10) UNSIGNED NOT NULL,
  `status` varchar(20) NOT NULL DEFAULT 'kosong',
  `description` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `rooms`
--

INSERT INTO `rooms` (`id`, `room_number`, `type`, `monthly_price`, `status`, `description`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, '101', 'Standar', 800000, 'kosong', NULL, '2026-10-31 01:52:22', '2026-10-31 01:52:22', NULL),
(2, '102', 'Standar', 800000, 'kosong', NULL, '2026-10-31 01:52:22', '2026-10-31 01:52:22', NULL),
(3, '103', 'Standar', 800000, 'butuh_perbaikan', NULL, '2026-10-31 01:52:22', '2026-10-31 01:52:22', NULL),
(4, '201', 'AC', 1200000, 'kosong', NULL, '2026-10-31 01:52:22', '2026-10-31 01:52:22', NULL),
(5, '202', 'AC', 1200000, 'kosong', NULL, '2026-10-31 01:52:22', '2026-10-31 01:52:22', NULL),
(6, '203', 'AC + KM Dalam', 1500000, 'kosong', NULL, '2026-10-31 01:52:22', '2026-10-31 01:52:22', NULL),
(7, '204', 'AC + KM Dalam', 1500000, 'kosong', NULL, '2026-10-31 01:52:22', '2026-10-31 01:52:22', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `room_master_item`
--

CREATE TABLE `room_master_item` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `room_id` bigint(20) UNSIGNED NOT NULL,
  `master_item_id` bigint(20) UNSIGNED NOT NULL,
  `quantity` tinyint(3) UNSIGNED NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `room_master_item`
--

INSERT INTO `room_master_item` (`id`, `room_id`, `master_item_id`, `quantity`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 1, '2026-10-31 01:52:22', '2026-10-31 01:52:22'),
(2, 1, 2, 1, '2026-10-31 01:52:22', '2026-10-31 01:52:22'),
(3, 1, 3, 1, '2026-10-31 01:52:22', '2026-10-31 01:52:22'),
(4, 1, 4, 1, '2026-10-31 01:52:22', '2026-10-31 01:52:22'),
(5, 1, 5, 1, '2026-10-31 01:52:22', '2026-10-31 01:52:22'),
(6, 1, 8, 1, '2026-10-31 01:52:22', '2026-10-31 01:52:22'),
(7, 1, 9, 2, '2026-10-31 01:52:22', '2026-10-31 01:52:22'),
(8, 1, 10, 1, '2026-10-31 01:52:22', '2026-10-31 01:52:22'),
(9, 1, 11, 1, '2026-10-31 01:52:22', '2026-10-31 01:52:22'),
(10, 1, 12, 1, '2026-10-31 01:52:22', '2026-10-31 01:52:22'),
(11, 1, 13, 1, '2026-10-31 01:52:22', '2026-10-31 01:52:22'),
(12, 1, 14, 1, '2026-10-31 01:52:22', '2026-10-31 01:52:22'),
(13, 1, 7, 1, '2026-10-31 01:52:22', '2026-10-31 01:52:22'),
(14, 2, 1, 1, '2026-10-31 01:52:22', '2026-10-31 01:52:22'),
(15, 2, 2, 1, '2026-10-31 01:52:22', '2026-10-31 01:52:22'),
(16, 2, 3, 1, '2026-10-31 01:52:22', '2026-10-31 01:52:22'),
(17, 2, 4, 1, '2026-10-31 01:52:22', '2026-10-31 01:52:22'),
(18, 2, 5, 1, '2026-10-31 01:52:22', '2026-10-31 01:52:22'),
(19, 2, 8, 1, '2026-10-31 01:52:22', '2026-10-31 01:52:22'),
(20, 2, 9, 2, '2026-10-31 01:52:22', '2026-10-31 01:52:22'),
(21, 2, 10, 1, '2026-10-31 01:52:22', '2026-10-31 01:52:22'),
(22, 2, 11, 1, '2026-10-31 01:52:22', '2026-10-31 01:52:22'),
(23, 2, 12, 1, '2026-10-31 01:52:22', '2026-10-31 01:52:22'),
(24, 2, 13, 1, '2026-10-31 01:52:22', '2026-10-31 01:52:22'),
(25, 2, 14, 1, '2026-10-31 01:52:22', '2026-10-31 01:52:22'),
(26, 2, 7, 1, '2026-10-31 01:52:22', '2026-10-31 01:52:22'),
(27, 3, 1, 1, '2026-10-31 01:52:22', '2026-10-31 01:52:22'),
(28, 3, 2, 1, '2026-10-31 01:52:22', '2026-10-31 01:52:22'),
(29, 3, 3, 1, '2026-10-31 01:52:22', '2026-10-31 01:52:22'),
(30, 3, 4, 1, '2026-10-31 01:52:22', '2026-10-31 01:52:22'),
(31, 3, 5, 1, '2026-10-31 01:52:22', '2026-10-31 01:52:22'),
(32, 3, 8, 1, '2026-10-31 01:52:22', '2026-10-31 01:52:22'),
(33, 3, 9, 2, '2026-10-31 01:52:22', '2026-10-31 01:52:22'),
(34, 3, 10, 1, '2026-10-31 01:52:22', '2026-10-31 01:52:22'),
(35, 3, 11, 1, '2026-10-31 01:52:22', '2026-10-31 01:52:22'),
(36, 3, 12, 1, '2026-10-31 01:52:22', '2026-10-31 01:52:22'),
(37, 3, 13, 1, '2026-10-31 01:52:22', '2026-10-31 01:52:22'),
(38, 3, 14, 1, '2026-10-31 01:52:22', '2026-10-31 01:52:22'),
(39, 3, 7, 1, '2026-10-31 01:52:22', '2026-10-31 01:52:22'),
(40, 4, 1, 1, '2026-10-31 01:52:22', '2026-10-31 01:52:22'),
(41, 4, 2, 1, '2026-10-31 01:52:22', '2026-10-31 01:52:22'),
(42, 4, 3, 1, '2026-10-31 01:52:22', '2026-10-31 01:52:22'),
(43, 4, 4, 1, '2026-10-31 01:52:22', '2026-10-31 01:52:22'),
(44, 4, 5, 1, '2026-10-31 01:52:22', '2026-10-31 01:52:22'),
(45, 4, 8, 1, '2026-10-31 01:52:22', '2026-10-31 01:52:22'),
(46, 4, 9, 2, '2026-10-31 01:52:22', '2026-10-31 01:52:22'),
(47, 4, 10, 1, '2026-10-31 01:52:22', '2026-10-31 01:52:22'),
(48, 4, 11, 1, '2026-10-31 01:52:22', '2026-10-31 01:52:22'),
(49, 4, 12, 1, '2026-10-31 01:52:22', '2026-10-31 01:52:22'),
(50, 4, 13, 1, '2026-10-31 01:52:22', '2026-10-31 01:52:22'),
(51, 4, 14, 1, '2026-10-31 01:52:22', '2026-10-31 01:52:22'),
(52, 4, 6, 1, '2026-10-31 01:52:22', '2026-10-31 01:52:22'),
(53, 5, 1, 1, '2026-10-31 01:52:22', '2026-10-31 01:52:22'),
(54, 5, 2, 1, '2026-10-31 01:52:22', '2026-10-31 01:52:22'),
(55, 5, 3, 1, '2026-10-31 01:52:22', '2026-10-31 01:52:22'),
(56, 5, 4, 1, '2026-10-31 01:52:22', '2026-10-31 01:52:22'),
(57, 5, 5, 1, '2026-10-31 01:52:22', '2026-10-31 01:52:22'),
(58, 5, 8, 1, '2026-10-31 01:52:22', '2026-10-31 01:52:22'),
(59, 5, 9, 2, '2026-10-31 01:52:22', '2026-10-31 01:52:22'),
(60, 5, 10, 1, '2026-10-31 01:52:22', '2026-10-31 01:52:22'),
(61, 5, 11, 1, '2026-10-31 01:52:22', '2026-10-31 01:52:22'),
(62, 5, 12, 1, '2026-10-31 01:52:22', '2026-10-31 01:52:22'),
(63, 5, 13, 1, '2026-10-31 01:52:22', '2026-10-31 01:52:22'),
(64, 5, 14, 1, '2026-10-31 01:52:22', '2026-10-31 01:52:22'),
(65, 5, 6, 1, '2026-10-31 01:52:22', '2026-10-31 01:52:22'),
(66, 6, 1, 1, '2026-10-31 01:52:22', '2026-10-31 01:52:22'),
(67, 6, 2, 1, '2026-10-31 01:52:22', '2026-10-31 01:52:22'),
(68, 6, 3, 1, '2026-10-31 01:52:22', '2026-10-31 01:52:22'),
(69, 6, 4, 1, '2026-10-31 01:52:22', '2026-10-31 01:52:22'),
(70, 6, 5, 1, '2026-10-31 01:52:22', '2026-10-31 01:52:22'),
(71, 6, 8, 2, '2026-10-31 01:52:22', '2026-10-31 01:52:22'),
(72, 6, 9, 2, '2026-10-31 01:52:22', '2026-10-31 01:52:22'),
(73, 6, 10, 1, '2026-10-31 01:52:22', '2026-10-31 01:52:22'),
(74, 6, 11, 1, '2026-10-31 01:52:22', '2026-10-31 01:52:22'),
(75, 6, 12, 1, '2026-10-31 01:52:22', '2026-10-31 01:52:22'),
(76, 6, 13, 1, '2026-10-31 01:52:22', '2026-10-31 01:52:22'),
(77, 6, 14, 1, '2026-10-31 01:52:22', '2026-10-31 01:52:22'),
(78, 6, 6, 1, '2026-10-31 01:52:22', '2026-10-31 01:52:22'),
(79, 6, 15, 1, '2026-10-31 01:52:22', '2026-10-31 01:52:22'),
(80, 6, 16, 1, '2026-10-31 01:52:22', '2026-10-31 01:52:22'),
(81, 6, 17, 1, '2026-10-31 01:52:22', '2026-10-31 01:52:22'),
(82, 7, 1, 1, '2026-10-31 01:52:22', '2026-10-31 01:52:22'),
(83, 7, 2, 1, '2026-10-31 01:52:22', '2026-10-31 01:52:22'),
(84, 7, 3, 1, '2026-10-31 01:52:22', '2026-10-31 01:52:22'),
(85, 7, 4, 1, '2026-10-31 01:52:22', '2026-10-31 01:52:22'),
(86, 7, 5, 1, '2026-10-31 01:52:22', '2026-10-31 01:52:22'),
(87, 7, 8, 2, '2026-10-31 01:52:22', '2026-10-31 01:52:22'),
(88, 7, 9, 2, '2026-10-31 01:52:22', '2026-10-31 01:52:22'),
(89, 7, 10, 1, '2026-10-31 01:52:22', '2026-10-31 01:52:22'),
(90, 7, 11, 1, '2026-10-31 01:52:22', '2026-10-31 01:52:22'),
(91, 7, 12, 1, '2026-10-31 01:52:22', '2026-10-31 01:52:22'),
(92, 7, 13, 1, '2026-10-31 01:52:22', '2026-10-31 01:52:22'),
(93, 7, 14, 1, '2026-10-31 01:52:22', '2026-10-31 01:52:22'),
(94, 7, 6, 1, '2026-10-31 01:52:22', '2026-10-31 01:52:22'),
(95, 7, 15, 1, '2026-10-31 01:52:22', '2026-10-31 01:52:22'),
(96, 7, 16, 1, '2026-10-31 01:52:22', '2026-10-31 01:52:22'),
(97, 7, 17, 1, '2026-10-31 01:52:22', '2026-10-31 01:52:22');

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `role` varchar(20) NOT NULL DEFAULT 'tenant',
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `phone`, `role`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Pemilik Kos', 'owner@kosaudit.test', '081200000001', 'owner', '2026-10-31 01:52:21', '$2y$12$442kBfYc5X0n5lOkmDlEzO/w.7/vXDiNBL5CzE/lYxAbx8vbAM16e', NULL, '2026-10-31 01:52:21', '2026-10-31 01:52:21', NULL),
(2, 'Budi Penghuni', 'tenant@kosaudit.test', '081200000002', 'tenant', '2026-10-31 01:52:21', '$2y$12$4tJmuI8bmO./nFaJRlXyl.mCAs6p3OkSKhSk7386l6Pr9Ce57bpNq', NULL, '2026-10-31 01:52:22', '2026-10-31 01:52:22', NULL),
(3, 'Siti Penghuni', 'siti@kosaudit.test', '081234567890', 'tenant', NULL, '$2y$12$Jr5ystzqUD4NLSMe0jCymef22KUCHFf9lKmEe855eiwx5jmCqAYSO', NULL, '2026-10-31 02:20:03', '2026-10-31 02:20:03', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_expiration_index` (`expiration`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_locks_expiration_index` (`expiration`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`),
  ADD KEY `failed_jobs_connection_queue_failed_at_index` (`connection`,`queue`,`failed_at`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `master_items`
--
ALTER TABLE `master_items`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `master_items_name_unique` (`name`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`),
  ADD KEY `personal_access_tokens_expires_at_index` (`expires_at`);

--
-- Indexes for table `rooms`
--
ALTER TABLE `rooms`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `rooms_room_number_unique` (`room_number`),
  ADD KEY `rooms_status_index` (`status`);

--
-- Indexes for table `room_master_item`
--
ALTER TABLE `room_master_item`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `room_master_item_room_id_master_item_id_unique` (`room_id`,`master_item_id`),
  ADD KEY `room_master_item_master_item_id_foreign` (`master_item_id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `users_role_index` (`role`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `master_items`
--
ALTER TABLE `master_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `rooms`
--
ALTER TABLE `rooms`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `room_master_item`
--
ALTER TABLE `room_master_item`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=98;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `room_master_item`
--
ALTER TABLE `room_master_item`
  ADD CONSTRAINT `room_master_item_master_item_id_foreign` FOREIGN KEY (`master_item_id`) REFERENCES `master_items` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `room_master_item_room_id_foreign` FOREIGN KEY (`room_id`) REFERENCES `rooms` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
