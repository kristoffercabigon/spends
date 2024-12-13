-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 08, 2024 at 10:44 PM
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
-- Database: `spends`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `admin_id` int(11) NOT NULL,
  `admin_user_type_id` bigint(20) UNSIGNED NOT NULL,
  `admin_first_name` varchar(255) NOT NULL,
  `admin_middle_name` varchar(255) DEFAULT NULL,
  `admin_last_name` varchar(255) NOT NULL,
  `admin_suffix` varchar(255) DEFAULT NULL,
  `admin_email` varchar(255) NOT NULL,
  `admin_password` varchar(255) NOT NULL,
  `admin_profile_picture` varchar(255) DEFAULT NULL,
  `admin_verification_code` varchar(255) DEFAULT NULL,
  `admin_verification_expires_at` datetime DEFAULT NULL,
  `admin_verified_at` datetime DEFAULT NULL,
  `admin_token` varchar(255) DEFAULT NULL,
  `remember_token` varchar(255) DEFAULT NULL,
  `admin_token_expiration` datetime DEFAULT NULL,
  `admin_date_registered` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `admin_id`, `admin_user_type_id`, `admin_first_name`, `admin_middle_name`, `admin_last_name`, `admin_suffix`, `admin_email`, `admin_password`, `admin_profile_picture`, `admin_verification_code`, `admin_verification_expires_at`, `admin_verified_at`, `admin_token`, `remember_token`, `admin_token_expiration`, `admin_date_registered`, `created_at`, `updated_at`) VALUES
(1, 3597, 3, 'Kristoffer', 'Dela Cruz', 'Cabigon', NULL, 'kristoffercabigon@gmail.com', '$2y$12$B9hM8faTygjAj5IH.cDYt.PaVkEw/aBvAO93jCROvgIR1T4WkT7Z2', NULL, NULL, NULL, '2019-04-01 10:41:03', NULL, NULL, NULL, '2016-08-19', '2024-12-08 13:29:34', '2024-12-08 13:29:34');

-- --------------------------------------------------------

--
-- Table structure for table `admin_login_attempts`
--

CREATE TABLE `admin_login_attempts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `admin_email` varchar(255) DEFAULT NULL,
  `status` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `barangay_list`
--

CREATE TABLE `barangay_list` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `barangay_no` varchar(255) NOT NULL,
  `barangay_locality` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `barangay_list`
--

INSERT INTO `barangay_list` (`id`, `barangay_no`, `barangay_locality`, `created_at`, `updated_at`) VALUES
(1, 'Barangay 165', 'Bagbaguin', NULL, NULL),
(2, 'Barangay 166', 'Kaybiga', NULL, NULL),
(3, 'Barangay 167', 'Llano', NULL, NULL),
(4, 'Barangay 168', 'Deparo', NULL, NULL),
(5, 'Barangay 169', 'BF Homes Caloocan', NULL, NULL),
(6, 'Barangay 170', 'Deparo 2', NULL, NULL),
(7, 'Barangay 171', 'Bagumbong', NULL, NULL),
(8, 'Barangay 172', 'Urduja Village', NULL, NULL),
(9, 'Barangay 173', 'Congress', NULL, NULL),
(10, 'Barangay 174', 'Camarin (Central)', NULL, NULL),
(11, 'Barangay 175', 'Camarin', NULL, NULL),
(12, 'Barangay 176-A', 'Bagong Silang', NULL, NULL),
(13, 'Barangay 176-B', 'Bagong Silang', NULL, NULL),
(14, 'Barangay 176-C', 'Bagong Silang', NULL, NULL),
(15, 'Barangay 176-D', 'Bagong Silang', NULL, NULL),
(16, 'Barangay 176-E', 'Bagong Silang', NULL, NULL),
(17, 'Barangay 176-F', 'Bagong Silang', NULL, NULL),
(18, 'Barangay 177', 'Camarin (Cielito)', NULL, NULL),
(19, 'Barangay 178', 'Camarin (Kiko)', NULL, NULL),
(20, 'Barangay 179', 'Amparo', NULL, NULL),
(21, 'Barangay 180', 'Tala', NULL, NULL),
(22, 'Barangay 181', 'Pangarap Village, Tala', NULL, NULL),
(23, 'Barangay 182', 'Pangarap Village, Tala', NULL, NULL),
(24, 'Barangay 183', 'Tala', NULL, NULL),
(25, 'Barangay 184', 'Tala', NULL, NULL),
(26, 'Barangay 185', 'Tala', NULL, NULL),
(27, 'Barangay 186', 'Tala', NULL, NULL),
(28, 'Barangay 187', 'Tala', NULL, NULL),
(29, 'Barangay 188', 'Tala', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `civil_status_list`
--

CREATE TABLE `civil_status_list` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `civil_status` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `civil_status_list`
--

INSERT INTO `civil_status_list` (`id`, `civil_status`, `created_at`, `updated_at`) VALUES
(1, 'Single', NULL, NULL),
(2, 'Married', NULL, NULL),
(3, 'Divorced', NULL, NULL),
(4, 'Widowed', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `contact_us`
--

CREATE TABLE `contact_us` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `message` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `encoder`
--

CREATE TABLE `encoder` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `encoder_id` int(11) NOT NULL,
  `encoder_user_type_id` bigint(20) UNSIGNED NOT NULL,
  `encoder_first_name` varchar(255) NOT NULL,
  `encoder_middle_name` varchar(255) DEFAULT NULL,
  `encoder_last_name` varchar(255) NOT NULL,
  `encoder_suffix` varchar(255) DEFAULT NULL,
  `encoder_address` varchar(255) NOT NULL,
  `encoder_barangay_id` bigint(20) UNSIGNED NOT NULL,
  `encoder_contact_no` varchar(255) NOT NULL,
  `encoder_email` varchar(255) NOT NULL,
  `encoder_password` varchar(255) NOT NULL,
  `encoder_profile_picture` varchar(255) DEFAULT NULL,
  `encoder_verification_code` varchar(255) DEFAULT NULL,
  `encoder_verification_expires_at` datetime DEFAULT NULL,
  `encoder_verified_at` datetime DEFAULT NULL,
  `encoder_token` varchar(255) DEFAULT NULL,
  `remember_token` varchar(255) DEFAULT NULL,
  `encoder_token_expiration` datetime DEFAULT NULL,
  `encoder_date_registered` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `encoder`
--

INSERT INTO `encoder` (`id`, `encoder_id`, `encoder_user_type_id`, `encoder_first_name`, `encoder_middle_name`, `encoder_last_name`, `encoder_suffix`, `encoder_address`, `encoder_barangay_id`, `encoder_contact_no`, `encoder_email`, `encoder_password`, `encoder_profile_picture`, `encoder_verification_code`, `encoder_verification_expires_at`, `encoder_verified_at`, `encoder_token`, `remember_token`, `encoder_token_expiration`, `encoder_date_registered`, `created_at`, `updated_at`) VALUES
(1, 6091, 2, 'Kristoffer', 'Dela Cruz', 'Cabigon', NULL, '1089 Phase3B Block10 Lot 2 Camarin Caloocan city', 11, '+639278147238', 'kristoffercabigon@gmail.com', '$2y$12$qzLCB6Z.RU/9R4WDefhI3.Dw9.v1nqJD0ycxSHvAS3KYNt4chAsTO', NULL, NULL, NULL, '2022-11-22 05:44:50', NULL, NULL, NULL, '2020-06-14', '2024-12-08 13:28:48', '2024-12-08 13:28:48'),
(2, 3601, 2, 'Larry', NULL, 'Flores', 'Sr.', '3636 Phase 8 Block 76 Lot 3 Gardenia Boulevard, Barangay 170, Caloocan City', 6, '+639476426121', 'larryfloressr.34@example.com', '$2y$12$LrXXamrSVtnXUthYrZXs3OZIQTkPfweACFk8Sdgj0GhdfqD1Wdz5G', NULL, NULL, NULL, '2015-02-09 13:59:14', NULL, NULL, NULL, '2022-03-15', '2024-12-08 13:28:49', '2024-12-08 13:28:49'),
(3, 8882, 2, 'Karen', 'Gumabay', 'Villanueva', NULL, '7496 Phase 7 Block 16 Lot 78 Magnolia Avenue, Barangay 179, Caloocan City', 20, '+639174980423', 'karengumabayvillanueva15@example.com', '$2y$12$IX4hN19aEW6M/AgImwCDN.w/ZtZhrMGUxL5rIBuU48jQ1LoZzrIRa', NULL, NULL, NULL, '2018-01-16 21:46:48', NULL, NULL, NULL, '2017-05-11', '2024-12-08 13:28:49', '2024-12-08 13:28:49'),
(4, 4196, 2, 'John', 'De Guzman', 'Misa', 'III', '9556 Phase 7 Block 8 Lot 78 Zinnia Drive, Barangay 175, Caloocan City', 11, '+639754642987', 'johndeguzmanmisaiii72@example.com', '$2y$12$3jFMuEplNy4NQbp6OeloTemaP9XkcArJQ2MBHdtfeKMxg..EUkhre', NULL, NULL, NULL, '2022-02-03 09:14:44', NULL, NULL, NULL, '2016-12-23', '2024-12-08 13:28:50', '2024-12-08 13:28:50'),
(5, 9180, 2, 'Charlotte', NULL, 'Martelino', NULL, '6962 Phase 9 Block 12 Lot 16 Mabuhay Road, Barangay 176-E, Caloocan City', 16, '+639117591977', 'charlottemartelino74@example.com', '$2y$12$/zZxPXwDC0TlLIY86Wl/seIxBIkRfSLI9wTHCVNb5.w6/D1hEUeWC', NULL, NULL, NULL, '2022-06-29 08:55:32', NULL, NULL, NULL, '2018-08-20', '2024-12-08 13:28:50', '2024-12-08 13:28:50'),
(6, 5558, 2, 'Mark', NULL, 'Martelino', 'III', '7054 Phase 2 Block 38 Lot 69 Petunia Road, Barangay 176-C, Caloocan City', 14, '+639373143462', 'markmartelinoiii39@example.com', '$2y$12$qnOLvKh/eCjye6CWbUECt.E41m2MEEzUaXvDmWsKMzVZyTmIjfpYq', NULL, NULL, NULL, '2019-10-16 14:19:12', NULL, NULL, NULL, '2018-04-29', '2024-12-08 13:28:51', '2024-12-08 13:28:51'),
(7, 1263, 2, 'Adam', 'Santiago', 'Esteban', 'Sr.', '8449 Phase 2 Block 90 Lot 66 Atis Drive, Barangay 181, Caloocan City', 22, '+639727082487', 'adamsantiagoestebansr.74@example.com', '$2y$12$yCZhl4p76khTKxpSXgmDR./6zHAtlrmvITDGqjbzuo6JOKnR612wK', NULL, NULL, NULL, '2019-03-30 23:56:15', NULL, NULL, NULL, '2023-09-12', '2024-12-08 13:28:51', '2024-12-08 13:28:51'),
(8, 3280, 2, 'Ronald', NULL, 'Salvador', NULL, '9979 Phase 10 Block 78 Lot 69 Santos Street, Barangay 171, Caloocan City', 7, '+639889430825', 'ronaldsalvador86@example.com', '$2y$12$u1qfm5gUPSjXPx5f.0yUtOGTcNsT7LyKSsHZMZ0HKYvt9SVT19Qum', NULL, NULL, NULL, '2019-12-22 21:46:24', NULL, NULL, NULL, '2021-10-04', '2024-12-08 13:28:52', '2024-12-08 13:28:52'),
(9, 6684, 2, 'Aria', NULL, 'Bañez', NULL, '4069 Phase 8 Block 78 Lot 12 Ilang-Ilang Drive, Barangay 165, Caloocan City', 1, '+639108711619', 'ariabañez12@example.com', '$2y$12$PGrFnHnRZHAuYOwOaK/lt.WDn/yBzZ0z64Nhax0Ek9kxhApieV3LC', NULL, NULL, NULL, '2018-05-03 06:59:36', NULL, NULL, NULL, '2020-11-23', '2024-12-08 13:28:52', '2024-12-08 13:28:52'),
(10, 6463, 2, 'Zoe', NULL, 'San Antonio', NULL, '1881 Phase 6 Block 33 Lot 35 Opal Road, Barangay 174, Caloocan City', 10, '+639902172655', 'zoesanantonio86@example.com', '$2y$12$TVKsKAeq8keBybTC9yCCluEXYAblanWhsuXdmxdAyr5GD5nDPGc8O', NULL, NULL, NULL, '2020-09-18 05:07:44', NULL, NULL, NULL, '2016-11-24', '2024-12-08 13:28:53', '2024-12-08 13:28:53'),
(11, 1341, 2, 'Eric', 'Bañez', 'Tabujara', NULL, '5840 Phase 7 Block 44 Lot 21 Avocado Street, Barangay 165, Caloocan City', 1, '+639948549024', 'ericbañeztabujara44@example.com', '$2y$12$q8pQONmFgsfpT36iGpfdU.AvR4JqIYx/ErYrEYvMl1e7EAlbFTaa6', NULL, NULL, NULL, '2023-02-27 13:58:36', NULL, NULL, NULL, '2015-10-31', '2024-12-08 13:28:54', '2024-12-08 13:28:54'),
(12, 2989, 2, 'Savannah', NULL, 'De la Rosa', NULL, '2741 Phase 7 Block 30 Lot 68 Cherry Drive, Barangay 168, Caloocan City', 4, '+639999240292', 'savannahdelarosa89@example.com', '$2y$12$Uhc6JGkfdctoXnv2yG5E6.lyUER867FDjYyxxfiGk2SxTOaEPyYtW', NULL, NULL, NULL, '2015-12-02 05:02:26', NULL, NULL, NULL, '2020-04-19', '2024-12-08 13:28:55', '2024-12-08 13:28:55'),
(13, 1563, 2, 'Michael', 'De Jesus', 'Soriano', NULL, '7625 Phase 3 Block 79 Lot 39 Camia Boulevard, Barangay 171, Caloocan City', 7, '+639042030857', 'michaeldejesussoriano60@example.com', '$2y$12$qy8cGWwwVMjd0SRneVdffu9Z1s/36naW2U3SSidOG8jvrDozciLc2', NULL, NULL, NULL, '2016-01-10 20:35:20', NULL, NULL, NULL, '2018-02-02', '2024-12-08 13:28:55', '2024-12-08 13:28:55'),
(14, 3712, 2, 'George', 'Verano', 'Bacani', NULL, '7317 Phase 6 Block 67 Lot 75 Saturn Street, Barangay 165, Caloocan City', 1, '+639329527339', 'georgeveranobacani21@example.com', '$2y$12$DI7iKbKkMEnEq6.cS9jPZ.K40DqJ2R28ZP8vY3g8FS4W7ZiCinQJu', NULL, NULL, NULL, '2023-11-20 14:06:19', NULL, NULL, NULL, '2017-04-19', '2024-12-08 13:28:55', '2024-12-08 13:28:55'),
(15, 4737, 2, 'Ariana', NULL, 'Cruz', NULL, '5454 Phase 6 Block 30 Lot 68 Masaya Road, Barangay 176-E, Caloocan City', 16, '+639386204318', 'arianacruz50@example.com', '$2y$12$Oe8pLC19mCK6ryEWpVwgJ.CHbCNh5ckHy6LWLSpy45cWIl76UDafO', NULL, NULL, NULL, '2015-07-16 08:28:15', NULL, NULL, NULL, '2024-10-22', '2024-12-08 13:28:56', '2024-12-08 13:28:56'),
(16, 6454, 2, 'Mark', 'Natividad', 'Nieves', NULL, '5906 Phase 8 Block 40 Lot 12 Gold Boulevard, Barangay 182, Caloocan City', 23, '+639511787725', 'marknatividadnieves87@example.com', '$2y$12$7Q9k/CPndteOvH3pbeYNz.Xq8VsOIQVKHfi0jt5/b74Z/pAe9r9TS', NULL, NULL, NULL, '2015-12-18 13:44:05', NULL, NULL, NULL, '2016-07-14', '2024-12-08 13:28:56', '2024-12-08 13:28:56'),
(17, 5835, 2, 'Matthew', 'De Leon', 'Flores', 'Sr.', '5074 Phase 4 Block 60 Lot 12 Azucena Drive, Barangay 179, Caloocan City', 20, '+639275877761', 'matthewdeleonfloressr.48@example.com', '$2y$12$126WEUx6MRQy9Y8FlsEk0ON0Yao/eWxczspqe/cxpVRGjbLTE9Edm', NULL, NULL, NULL, '2016-08-26 14:36:14', NULL, NULL, NULL, '2022-02-23', '2024-12-08 13:28:57', '2024-12-08 13:28:57'),
(18, 7425, 2, 'Anthony', 'Dizon', 'Cruz', NULL, '7072 Phase 4 Block 82 Lot 26 Pag-asa Street, Barangay 177, Caloocan City', 18, '+639466693751', 'anthonydizoncruz43@example.com', '$2y$12$GyuV083hxhxJE6bY9J4KqOYznh7blCOXUCk73O84dTri3faC/azdO', NULL, NULL, NULL, '2023-08-02 11:07:37', NULL, NULL, NULL, '2015-11-01', '2024-12-08 13:28:57', '2024-12-08 13:28:57'),
(19, 9850, 2, 'David', NULL, 'Alvarez', 'I', '5351 Phase 7 Block 79 Lot 53 Papaya Boulevard, Barangay 172, Caloocan City', 8, '+639587700009', 'davidalvarezi71@example.com', '$2y$12$z6rJMAbJs6FSjSEs5DsmO.rwSWOfmT2OJ7Zsn0w6.Cs8scWBuerna', NULL, NULL, NULL, '2017-02-20 14:17:16', NULL, NULL, NULL, '2021-11-07', '2024-12-08 13:28:58', '2024-12-08 13:28:58'),
(20, 2504, 2, 'Charles', 'Salvador', 'De Guzman', 'II', '6093 Phase 5 Block 12 Lot 83 Lily Avenue, Barangay 181, Caloocan City', 22, '+639498914777', 'charlessalvadordeguzmanii97@example.com', '$2y$12$21NuAgpzAJZkB.iTQkyjkebFmZF48rqMswuVndsDAqB4ouNU/.3hC', NULL, NULL, NULL, '2019-03-05 13:48:35', NULL, NULL, NULL, '2024-04-22', '2024-12-08 13:28:59', '2024-12-08 13:28:59'),
(21, 2884, 2, 'Cynthia', NULL, 'Villafuerte', NULL, '3033 Phase 10 Block 54 Lot 53 Azucena Drive, Barangay 166, Caloocan City', 2, '+639332802024', 'cynthiavillafuerte59@example.com', '$2y$12$4VvuKpRSh9hhwDQf8tDFT.ihdzXs2vItKBEtcbZYF3hmotxY6dYO.', NULL, NULL, NULL, '2023-03-04 03:10:03', NULL, NULL, NULL, '2018-06-01', '2024-12-08 13:28:59', '2024-12-08 13:28:59'),
(22, 5596, 2, 'Jessica', NULL, 'Villanueva', NULL, '6845 Phase 8 Block 44 Lot 1 Tulip Road, Barangay 176-F, Caloocan City', 17, '+639296307981', 'jessicavillanueva80@example.com', '$2y$12$D0tC4udFiblVyAqBfy4r0u85wpnrj0Laub002I0DUFlgS7p9nCy0O', NULL, NULL, NULL, '2023-08-29 20:27:23', NULL, NULL, NULL, '2019-03-26', '2024-12-08 13:29:00', '2024-12-08 13:29:00'),
(23, 9763, 2, 'Thomas', NULL, 'Delos Santos', 'Sr.', '7147 Phase 8 Block 63 Lot 51 Mahinhin Drive, Barangay 176-B, Caloocan City', 13, '+639997388295', 'thomasdelossantossr.95@example.com', '$2y$12$OXhjni/4HSCHEGHS2tTXpu41upsb6MUKtdrf.B4JMY6tRs.89HhwK', NULL, NULL, NULL, '2015-07-11 04:26:58', NULL, NULL, NULL, '2018-12-22', '2024-12-08 13:29:00', '2024-12-08 13:29:00'),
(24, 5469, 2, 'Eric', NULL, 'Mendoza', NULL, '6573 Phase 9 Block 34 Lot 24 Camia Boulevard, Barangay 170, Caloocan City', 6, '+639242523008', 'ericmendoza62@example.com', '$2y$12$jZK8weHRMNVjl5pBv9UN0Ow1d1QiUChiX9kQCbqTbVFrniAGioZpG', NULL, NULL, NULL, '2017-10-23 06:25:29', NULL, NULL, NULL, '2015-08-12', '2024-12-08 13:29:01', '2024-12-08 13:29:01'),
(25, 5087, 2, 'Thomas', NULL, 'Martinez', 'I', '6671 Phase 2 Block 68 Lot 58 Matamis Street, Barangay 167, Caloocan City', 3, '+639143844731', 'thomasmartinezi48@example.com', '$2y$12$ohL1Ey/rSu9yQaZceSbs3uiLxgPIKKsv6F.JT4tstCaAGu38H6ICC', NULL, NULL, NULL, '2024-09-26 15:09:20', NULL, NULL, NULL, '2016-10-18', '2024-12-08 13:29:01', '2024-12-08 13:29:01'),
(26, 9839, 2, 'Paul', 'De Jesus', 'De la Rosa', 'III', '4242 Phase 5 Block 79 Lot 36 Langka Street, Barangay 165, Caloocan City', 1, '+639986046504', 'pauldejesusdelarosaiii26@example.com', '$2y$12$ADf.QvqwEGECzBaa0PKc2O23fh04UiGUNS5rnQEy/LXp67l/Df5bC', NULL, NULL, NULL, '2016-12-20 00:54:48', NULL, NULL, NULL, '2017-05-23', '2024-12-08 13:29:02', '2024-12-08 13:29:02'),
(27, 9370, 2, 'Robert', 'Del Castillo', 'De Villa', 'Jr.', '8291 Phase 6 Block 50 Lot 68 Waling-Waling Boulevard, Barangay 183, Caloocan City', 24, '+639338097738', 'robertdelcastillodevillajr.10@example.com', '$2y$12$4esKdQ/6wODeUHyQd1wT9eOqbwOypR0Mj9umcAl2VcS40Gebtk/Pq', NULL, NULL, NULL, '2016-11-22 23:03:41', NULL, NULL, NULL, '2016-02-10', '2024-12-08 13:29:02', '2024-12-08 13:29:02'),
(28, 8078, 2, 'Ruth', 'Bautista', 'Lacuna', NULL, '7427 Phase 7 Block 5 Lot 34 Diamond Boulevard, Barangay 184, Caloocan City', 25, '+639928045126', 'ruthbautistalacuna37@example.com', '$2y$12$ggl735.rL01HtcYN0TzZTOQ3LrBgwGLyf480648dAmNF.rfT306LS', NULL, NULL, NULL, '2017-09-06 17:52:31', NULL, NULL, NULL, '2017-03-04', '2024-12-08 13:29:03', '2024-12-08 13:29:03'),
(29, 5959, 2, 'Savannah', 'Alfonso', 'Reyes', NULL, '3707 Phase 4 Block 79 Lot 9 Camia Boulevard, Barangay 176-E, Caloocan City', 16, '+639686536432', 'savannahalfonsoreyes94@example.com', '$2y$12$uKQby86c3WgOFdv0iFf/ouHkXSmIEhE51pzF8Kbm1XNFPSfb42A1e', NULL, NULL, NULL, '2021-02-06 15:52:48', NULL, NULL, NULL, '2020-12-31', '2024-12-08 13:29:04', '2024-12-08 13:29:04'),
(30, 3702, 2, 'Linda', NULL, 'Zaragoza', NULL, '6158 Phase 2 Block 26 Lot 33 Petunia Road, Barangay 166, Caloocan City', 2, '+639890899992', 'lindazaragoza58@example.com', '$2y$12$SJohz9chxQY0lyC8zRNP6O/ZX8n/aQfqQi.cmJn0Xv25P9nG/0YBi', NULL, NULL, NULL, '2022-12-14 18:43:29', NULL, NULL, NULL, '2018-09-06', '2024-12-08 13:29:04', '2024-12-08 13:29:04');

-- --------------------------------------------------------

--
-- Table structure for table `encoder_login_attempts`
--

CREATE TABLE `encoder_login_attempts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `encoder_email` varchar(255) DEFAULT NULL,
  `status` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `encoder_roles`
--

CREATE TABLE `encoder_roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `encoder_user_id` bigint(20) UNSIGNED NOT NULL,
  `encoder_roles_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `encoder_roles`
--

INSERT INTO `encoder_roles` (`id`, `encoder_user_id`, `encoder_roles_id`, `created_at`, `updated_at`) VALUES
(1, 1, 1, '2024-12-08 13:29:04', '2024-12-08 13:29:04'),
(2, 1, 2, '2024-12-08 13:29:06', '2024-12-08 13:29:06'),
(3, 1, 3, '2024-12-08 13:29:06', '2024-12-08 13:29:06'),
(4, 1, 4, '2024-12-08 13:29:06', '2024-12-08 13:29:06'),
(5, 1, 5, '2024-12-08 13:29:06', '2024-12-08 13:29:06'),
(6, 1, 6, '2024-12-08 13:29:06', '2024-12-08 13:29:06'),
(7, 1, 7, '2024-12-08 13:29:06', '2024-12-08 13:29:06'),
(8, 1, 8, '2024-12-08 13:29:06', '2024-12-08 13:29:06'),
(9, 1, 9, '2024-12-08 13:29:06', '2024-12-08 13:29:06'),
(10, 1, 10, '2024-12-08 13:29:07', '2024-12-08 13:29:07'),
(11, 1, 11, '2024-12-08 13:29:07', '2024-12-08 13:29:07'),
(12, 1, 14, '2024-12-08 13:29:07', '2024-12-08 13:29:07'),
(13, 1, 15, '2024-12-08 13:29:07', '2024-12-08 13:29:07'),
(14, 2, 6, '2024-12-08 13:29:07', '2024-12-08 13:29:07'),
(15, 2, 10, '2024-12-08 13:29:07', '2024-12-08 13:29:07'),
(16, 2, 15, '2024-12-08 13:29:07', '2024-12-08 13:29:07'),
(17, 3, 3, '2024-12-08 13:29:07', '2024-12-08 13:29:07'),
(18, 3, 4, '2024-12-08 13:29:08', '2024-12-08 13:29:08'),
(19, 3, 5, '2024-12-08 13:29:08', '2024-12-08 13:29:08'),
(20, 3, 6, '2024-12-08 13:29:08', '2024-12-08 13:29:08'),
(21, 3, 7, '2024-12-08 13:29:08', '2024-12-08 13:29:08'),
(22, 3, 8, '2024-12-08 13:29:08', '2024-12-08 13:29:08'),
(23, 3, 10, '2024-12-08 13:29:08', '2024-12-08 13:29:08'),
(24, 3, 11, '2024-12-08 13:29:08', '2024-12-08 13:29:08'),
(25, 3, 13, '2024-12-08 13:29:08', '2024-12-08 13:29:08'),
(26, 3, 15, '2024-12-08 13:29:08', '2024-12-08 13:29:08'),
(27, 4, 6, '2024-12-08 13:29:08', '2024-12-08 13:29:08'),
(28, 5, 14, '2024-12-08 13:29:08', '2024-12-08 13:29:08'),
(29, 6, 3, '2024-12-08 13:29:08', '2024-12-08 13:29:08'),
(30, 6, 4, '2024-12-08 13:29:09', '2024-12-08 13:29:09'),
(31, 6, 5, '2024-12-08 13:29:09', '2024-12-08 13:29:09'),
(32, 6, 7, '2024-12-08 13:29:09', '2024-12-08 13:29:09'),
(33, 7, 6, '2024-12-08 13:29:09', '2024-12-08 13:29:09'),
(34, 7, 12, '2024-12-08 13:29:09', '2024-12-08 13:29:09'),
(35, 7, 14, '2024-12-08 13:29:09', '2024-12-08 13:29:09'),
(36, 8, 1, '2024-12-08 13:29:09', '2024-12-08 13:29:09'),
(37, 8, 2, '2024-12-08 13:29:09', '2024-12-08 13:29:09'),
(38, 8, 3, '2024-12-08 13:29:09', '2024-12-08 13:29:09'),
(39, 8, 4, '2024-12-08 13:29:11', '2024-12-08 13:29:11'),
(40, 8, 8, '2024-12-08 13:29:11', '2024-12-08 13:29:11'),
(41, 8, 10, '2024-12-08 13:29:11', '2024-12-08 13:29:11'),
(42, 8, 12, '2024-12-08 13:29:11', '2024-12-08 13:29:11'),
(43, 8, 14, '2024-12-08 13:29:11', '2024-12-08 13:29:11'),
(44, 8, 15, '2024-12-08 13:29:11', '2024-12-08 13:29:11'),
(45, 9, 1, '2024-12-08 13:29:11', '2024-12-08 13:29:11'),
(46, 9, 2, '2024-12-08 13:29:11', '2024-12-08 13:29:11'),
(47, 9, 4, '2024-12-08 13:29:11', '2024-12-08 13:29:11'),
(48, 9, 5, '2024-12-08 13:29:11', '2024-12-08 13:29:11'),
(49, 9, 6, '2024-12-08 13:29:11', '2024-12-08 13:29:11'),
(50, 9, 7, '2024-12-08 13:29:11', '2024-12-08 13:29:11'),
(51, 9, 8, '2024-12-08 13:29:12', '2024-12-08 13:29:12'),
(52, 9, 9, '2024-12-08 13:29:12', '2024-12-08 13:29:12'),
(53, 9, 10, '2024-12-08 13:29:12', '2024-12-08 13:29:12'),
(54, 9, 11, '2024-12-08 13:29:12', '2024-12-08 13:29:12'),
(55, 9, 13, '2024-12-08 13:29:12', '2024-12-08 13:29:12'),
(56, 9, 14, '2024-12-08 13:29:12', '2024-12-08 13:29:12'),
(57, 9, 15, '2024-12-08 13:29:12', '2024-12-08 13:29:12'),
(58, 10, 2, '2024-12-08 13:29:12', '2024-12-08 13:29:12'),
(59, 10, 3, '2024-12-08 13:29:12', '2024-12-08 13:29:12'),
(60, 10, 4, '2024-12-08 13:29:12', '2024-12-08 13:29:12'),
(61, 10, 5, '2024-12-08 13:29:12', '2024-12-08 13:29:12'),
(62, 10, 6, '2024-12-08 13:29:12', '2024-12-08 13:29:12'),
(63, 10, 8, '2024-12-08 13:29:12', '2024-12-08 13:29:12'),
(64, 10, 9, '2024-12-08 13:29:13', '2024-12-08 13:29:13'),
(65, 10, 11, '2024-12-08 13:29:13', '2024-12-08 13:29:13'),
(66, 10, 13, '2024-12-08 13:29:13', '2024-12-08 13:29:13'),
(67, 11, 1, '2024-12-08 13:29:13', '2024-12-08 13:29:13'),
(68, 11, 2, '2024-12-08 13:29:13', '2024-12-08 13:29:13'),
(69, 11, 5, '2024-12-08 13:29:13', '2024-12-08 13:29:13'),
(70, 11, 7, '2024-12-08 13:29:14', '2024-12-08 13:29:14'),
(71, 11, 10, '2024-12-08 13:29:14', '2024-12-08 13:29:14'),
(72, 11, 11, '2024-12-08 13:29:15', '2024-12-08 13:29:15'),
(73, 11, 12, '2024-12-08 13:29:15', '2024-12-08 13:29:15'),
(74, 11, 14, '2024-12-08 13:29:15', '2024-12-08 13:29:15'),
(75, 12, 11, '2024-12-08 13:29:15', '2024-12-08 13:29:15'),
(76, 12, 13, '2024-12-08 13:29:15', '2024-12-08 13:29:15'),
(77, 13, 1, '2024-12-08 13:29:15', '2024-12-08 13:29:15'),
(78, 13, 2, '2024-12-08 13:29:15', '2024-12-08 13:29:15'),
(79, 13, 3, '2024-12-08 13:29:15', '2024-12-08 13:29:15'),
(80, 13, 6, '2024-12-08 13:29:15', '2024-12-08 13:29:15'),
(81, 13, 7, '2024-12-08 13:29:16', '2024-12-08 13:29:16'),
(82, 13, 8, '2024-12-08 13:29:16', '2024-12-08 13:29:16'),
(83, 13, 10, '2024-12-08 13:29:16', '2024-12-08 13:29:16'),
(84, 13, 14, '2024-12-08 13:29:16', '2024-12-08 13:29:16'),
(85, 14, 1, '2024-12-08 13:29:16', '2024-12-08 13:29:16'),
(86, 14, 2, '2024-12-08 13:29:16', '2024-12-08 13:29:16'),
(87, 14, 10, '2024-12-08 13:29:17', '2024-12-08 13:29:17'),
(88, 14, 12, '2024-12-08 13:29:17', '2024-12-08 13:29:17'),
(89, 14, 13, '2024-12-08 13:29:17', '2024-12-08 13:29:17'),
(90, 14, 14, '2024-12-08 13:29:17', '2024-12-08 13:29:17'),
(91, 15, 2, '2024-12-08 13:29:17', '2024-12-08 13:29:17'),
(92, 15, 3, '2024-12-08 13:29:17', '2024-12-08 13:29:17'),
(93, 15, 5, '2024-12-08 13:29:18', '2024-12-08 13:29:18'),
(94, 15, 7, '2024-12-08 13:29:18', '2024-12-08 13:29:18'),
(95, 15, 8, '2024-12-08 13:29:18', '2024-12-08 13:29:18'),
(96, 15, 9, '2024-12-08 13:29:18', '2024-12-08 13:29:18'),
(97, 15, 12, '2024-12-08 13:29:18', '2024-12-08 13:29:18'),
(98, 15, 13, '2024-12-08 13:29:18', '2024-12-08 13:29:18'),
(99, 15, 14, '2024-12-08 13:29:18', '2024-12-08 13:29:18'),
(100, 15, 15, '2024-12-08 13:29:18', '2024-12-08 13:29:18'),
(101, 16, 1, '2024-12-08 13:29:18', '2024-12-08 13:29:18'),
(102, 16, 7, '2024-12-08 13:29:18', '2024-12-08 13:29:18'),
(103, 16, 13, '2024-12-08 13:29:18', '2024-12-08 13:29:18'),
(104, 16, 14, '2024-12-08 13:29:18', '2024-12-08 13:29:18'),
(105, 17, 2, '2024-12-08 13:29:19', '2024-12-08 13:29:19'),
(106, 17, 7, '2024-12-08 13:29:19', '2024-12-08 13:29:19'),
(107, 17, 11, '2024-12-08 13:29:19', '2024-12-08 13:29:19'),
(108, 17, 13, '2024-12-08 13:29:19', '2024-12-08 13:29:19'),
(109, 18, 1, '2024-12-08 13:29:19', '2024-12-08 13:29:19'),
(110, 18, 2, '2024-12-08 13:29:19', '2024-12-08 13:29:19'),
(111, 18, 4, '2024-12-08 13:29:19', '2024-12-08 13:29:19'),
(112, 18, 5, '2024-12-08 13:29:19', '2024-12-08 13:29:19'),
(113, 18, 6, '2024-12-08 13:29:19', '2024-12-08 13:29:19'),
(114, 18, 7, '2024-12-08 13:29:19', '2024-12-08 13:29:19'),
(115, 18, 8, '2024-12-08 13:29:19', '2024-12-08 13:29:19'),
(116, 18, 10, '2024-12-08 13:29:19', '2024-12-08 13:29:19'),
(117, 18, 11, '2024-12-08 13:29:20', '2024-12-08 13:29:20'),
(118, 18, 12, '2024-12-08 13:29:20', '2024-12-08 13:29:20'),
(119, 18, 13, '2024-12-08 13:29:20', '2024-12-08 13:29:20'),
(120, 18, 14, '2024-12-08 13:29:20', '2024-12-08 13:29:20'),
(121, 18, 15, '2024-12-08 13:29:20', '2024-12-08 13:29:20'),
(122, 19, 1, '2024-12-08 13:29:20', '2024-12-08 13:29:20'),
(123, 19, 11, '2024-12-08 13:29:21', '2024-12-08 13:29:21'),
(124, 19, 12, '2024-12-08 13:29:22', '2024-12-08 13:29:22'),
(125, 19, 15, '2024-12-08 13:29:22', '2024-12-08 13:29:22'),
(126, 20, 1, '2024-12-08 13:29:22', '2024-12-08 13:29:22'),
(127, 20, 2, '2024-12-08 13:29:22', '2024-12-08 13:29:22'),
(128, 20, 3, '2024-12-08 13:29:22', '2024-12-08 13:29:22'),
(129, 20, 4, '2024-12-08 13:29:22', '2024-12-08 13:29:22'),
(130, 20, 5, '2024-12-08 13:29:22', '2024-12-08 13:29:22'),
(131, 20, 6, '2024-12-08 13:29:22', '2024-12-08 13:29:22'),
(132, 20, 8, '2024-12-08 13:29:22', '2024-12-08 13:29:22'),
(133, 20, 9, '2024-12-08 13:29:22', '2024-12-08 13:29:22'),
(134, 20, 10, '2024-12-08 13:29:22', '2024-12-08 13:29:22'),
(135, 20, 12, '2024-12-08 13:29:22', '2024-12-08 13:29:22'),
(136, 20, 14, '2024-12-08 13:29:22', '2024-12-08 13:29:22'),
(137, 21, 3, '2024-12-08 13:29:23', '2024-12-08 13:29:23'),
(138, 21, 4, '2024-12-08 13:29:23', '2024-12-08 13:29:23'),
(139, 21, 6, '2024-12-08 13:29:23', '2024-12-08 13:29:23'),
(140, 21, 7, '2024-12-08 13:29:23', '2024-12-08 13:29:23'),
(141, 21, 8, '2024-12-08 13:29:23', '2024-12-08 13:29:23'),
(142, 21, 12, '2024-12-08 13:29:23', '2024-12-08 13:29:23'),
(143, 22, 1, '2024-12-08 13:29:23', '2024-12-08 13:29:23'),
(144, 22, 2, '2024-12-08 13:29:23', '2024-12-08 13:29:23'),
(145, 22, 3, '2024-12-08 13:29:23', '2024-12-08 13:29:23'),
(146, 22, 4, '2024-12-08 13:29:23', '2024-12-08 13:29:23'),
(147, 22, 5, '2024-12-08 13:29:23', '2024-12-08 13:29:23'),
(148, 22, 6, '2024-12-08 13:29:23', '2024-12-08 13:29:23'),
(149, 22, 7, '2024-12-08 13:29:23', '2024-12-08 13:29:23'),
(150, 22, 8, '2024-12-08 13:29:23', '2024-12-08 13:29:23'),
(151, 22, 9, '2024-12-08 13:29:24', '2024-12-08 13:29:24'),
(152, 22, 10, '2024-12-08 13:29:24', '2024-12-08 13:29:24'),
(153, 22, 11, '2024-12-08 13:29:24', '2024-12-08 13:29:24'),
(154, 22, 12, '2024-12-08 13:29:24', '2024-12-08 13:29:24'),
(155, 22, 13, '2024-12-08 13:29:25', '2024-12-08 13:29:25'),
(156, 22, 15, '2024-12-08 13:29:25', '2024-12-08 13:29:25'),
(157, 23, 13, '2024-12-08 13:29:26', '2024-12-08 13:29:26'),
(158, 24, 1, '2024-12-08 13:29:26', '2024-12-08 13:29:26'),
(159, 24, 2, '2024-12-08 13:29:26', '2024-12-08 13:29:26'),
(160, 24, 3, '2024-12-08 13:29:26', '2024-12-08 13:29:26'),
(161, 24, 5, '2024-12-08 13:29:26', '2024-12-08 13:29:26'),
(162, 24, 6, '2024-12-08 13:29:26', '2024-12-08 13:29:26'),
(163, 24, 8, '2024-12-08 13:29:26', '2024-12-08 13:29:26'),
(164, 24, 11, '2024-12-08 13:29:26', '2024-12-08 13:29:26'),
(165, 24, 12, '2024-12-08 13:29:26', '2024-12-08 13:29:26'),
(166, 24, 13, '2024-12-08 13:29:27', '2024-12-08 13:29:27'),
(167, 25, 1, '2024-12-08 13:29:27', '2024-12-08 13:29:27'),
(168, 25, 2, '2024-12-08 13:29:27', '2024-12-08 13:29:27'),
(169, 25, 3, '2024-12-08 13:29:27', '2024-12-08 13:29:27'),
(170, 25, 4, '2024-12-08 13:29:27', '2024-12-08 13:29:27'),
(171, 25, 5, '2024-12-08 13:29:27', '2024-12-08 13:29:27'),
(172, 25, 6, '2024-12-08 13:29:28', '2024-12-08 13:29:28'),
(173, 25, 7, '2024-12-08 13:29:28', '2024-12-08 13:29:28'),
(174, 25, 9, '2024-12-08 13:29:28', '2024-12-08 13:29:28'),
(175, 25, 11, '2024-12-08 13:29:28', '2024-12-08 13:29:28'),
(176, 25, 12, '2024-12-08 13:29:28', '2024-12-08 13:29:28'),
(177, 25, 13, '2024-12-08 13:29:28', '2024-12-08 13:29:28'),
(178, 25, 15, '2024-12-08 13:29:28', '2024-12-08 13:29:28'),
(179, 26, 2, '2024-12-08 13:29:28', '2024-12-08 13:29:28'),
(180, 26, 3, '2024-12-08 13:29:28', '2024-12-08 13:29:28'),
(181, 26, 4, '2024-12-08 13:29:28', '2024-12-08 13:29:28'),
(182, 26, 5, '2024-12-08 13:29:29', '2024-12-08 13:29:29'),
(183, 26, 6, '2024-12-08 13:29:29', '2024-12-08 13:29:29'),
(184, 26, 7, '2024-12-08 13:29:29', '2024-12-08 13:29:29'),
(185, 26, 8, '2024-12-08 13:29:29', '2024-12-08 13:29:29'),
(186, 26, 9, '2024-12-08 13:29:29', '2024-12-08 13:29:29'),
(187, 26, 11, '2024-12-08 13:29:29', '2024-12-08 13:29:29'),
(188, 26, 13, '2024-12-08 13:29:29', '2024-12-08 13:29:29'),
(189, 26, 14, '2024-12-08 13:29:29', '2024-12-08 13:29:29'),
(190, 26, 15, '2024-12-08 13:29:29', '2024-12-08 13:29:29'),
(191, 27, 1, '2024-12-08 13:29:30', '2024-12-08 13:29:30'),
(192, 27, 2, '2024-12-08 13:29:30', '2024-12-08 13:29:30'),
(193, 27, 4, '2024-12-08 13:29:30', '2024-12-08 13:29:30'),
(194, 27, 5, '2024-12-08 13:29:30', '2024-12-08 13:29:30'),
(195, 27, 6, '2024-12-08 13:29:30', '2024-12-08 13:29:30'),
(196, 27, 7, '2024-12-08 13:29:30', '2024-12-08 13:29:30'),
(197, 27, 10, '2024-12-08 13:29:30', '2024-12-08 13:29:30'),
(198, 27, 12, '2024-12-08 13:29:30', '2024-12-08 13:29:30'),
(199, 27, 13, '2024-12-08 13:29:30', '2024-12-08 13:29:30'),
(200, 27, 14, '2024-12-08 13:29:30', '2024-12-08 13:29:30'),
(201, 27, 15, '2024-12-08 13:29:31', '2024-12-08 13:29:31'),
(202, 28, 1, '2024-12-08 13:29:32', '2024-12-08 13:29:32'),
(203, 28, 2, '2024-12-08 13:29:32', '2024-12-08 13:29:32'),
(204, 28, 3, '2024-12-08 13:29:32', '2024-12-08 13:29:32'),
(205, 28, 5, '2024-12-08 13:29:32', '2024-12-08 13:29:32'),
(206, 28, 6, '2024-12-08 13:29:32', '2024-12-08 13:29:32'),
(207, 28, 7, '2024-12-08 13:29:32', '2024-12-08 13:29:32'),
(208, 28, 8, '2024-12-08 13:29:32', '2024-12-08 13:29:32'),
(209, 28, 9, '2024-12-08 13:29:32', '2024-12-08 13:29:32'),
(210, 28, 10, '2024-12-08 13:29:32', '2024-12-08 13:29:32'),
(211, 28, 11, '2024-12-08 13:29:32', '2024-12-08 13:29:32'),
(212, 28, 13, '2024-12-08 13:29:32', '2024-12-08 13:29:32'),
(213, 28, 14, '2024-12-08 13:29:32', '2024-12-08 13:29:32'),
(214, 28, 15, '2024-12-08 13:29:32', '2024-12-08 13:29:32'),
(215, 29, 1, '2024-12-08 13:29:32', '2024-12-08 13:29:32'),
(216, 29, 2, '2024-12-08 13:29:32', '2024-12-08 13:29:32'),
(217, 29, 6, '2024-12-08 13:29:33', '2024-12-08 13:29:33'),
(218, 29, 8, '2024-12-08 13:29:33', '2024-12-08 13:29:33'),
(219, 29, 11, '2024-12-08 13:29:33', '2024-12-08 13:29:33'),
(220, 29, 14, '2024-12-08 13:29:33', '2024-12-08 13:29:33'),
(221, 29, 15, '2024-12-08 13:29:33', '2024-12-08 13:29:33'),
(222, 30, 1, '2024-12-08 13:29:33', '2024-12-08 13:29:33'),
(223, 30, 2, '2024-12-08 13:29:33', '2024-12-08 13:29:33'),
(224, 30, 3, '2024-12-08 13:29:33', '2024-12-08 13:29:33'),
(225, 30, 5, '2024-12-08 13:29:33', '2024-12-08 13:29:33'),
(226, 30, 6, '2024-12-08 13:29:33', '2024-12-08 13:29:33'),
(227, 30, 9, '2024-12-08 13:29:33', '2024-12-08 13:29:33'),
(228, 30, 10, '2024-12-08 13:29:33', '2024-12-08 13:29:33'),
(229, 30, 11, '2024-12-08 13:29:34', '2024-12-08 13:29:34'),
(230, 30, 12, '2024-12-08 13:29:34', '2024-12-08 13:29:34'),
(231, 30, 15, '2024-12-08 13:29:34', '2024-12-08 13:29:34');

-- --------------------------------------------------------

--
-- Table structure for table `encoder_roles_list`
--

CREATE TABLE `encoder_roles_list` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `encoder_role` varchar(255) NOT NULL,
  `encoder_role_category` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `encoder_roles_list`
--

INSERT INTO `encoder_roles_list` (`id`, `encoder_role`, `encoder_role_category`, `created_at`, `updated_at`) VALUES
(1, 'View Beneficiary List', 'View', NULL, NULL),
(2, 'View Beneficiary Profile', 'View', NULL, NULL),
(3, 'View Application List', 'View', NULL, NULL),
(4, 'View Pension Distribution List', 'View', NULL, NULL),
(5, 'Create Beneficiary', 'Create', NULL, NULL),
(6, 'Create Pension Distribution Program', 'Create', NULL, NULL),
(7, 'Create Events', 'Create', NULL, NULL),
(8, 'Update Beneficiary Profile', 'Update', NULL, NULL),
(9, 'Update Account Status of Senior', 'Update', NULL, NULL),
(10, 'Update Application Status of Senior', 'Update', NULL, NULL),
(11, 'Update Pension Distribution Program', 'Update', NULL, NULL),
(12, 'Update Events', 'Update', NULL, NULL),
(13, 'Delete Beneficiary', 'Delete', NULL, NULL),
(14, 'Delete Pension Distribution Program', 'Delete', NULL, NULL),
(15, 'Delete Events', 'Delete', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `family_composition`
--

CREATE TABLE `family_composition` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `senior_id` bigint(20) UNSIGNED DEFAULT NULL,
  `relative_name` varchar(255) DEFAULT NULL,
  `relative_relationship_id` bigint(20) UNSIGNED DEFAULT NULL,
  `relative_age` int(11) DEFAULT NULL,
  `relative_civil_status_id` bigint(20) UNSIGNED DEFAULT NULL,
  `relative_occupation` varchar(255) DEFAULT NULL,
  `relative_income` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `family_composition`
--

INSERT INTO `family_composition` (`id`, `senior_id`, `relative_name`, `relative_relationship_id`, `relative_age`, `relative_civil_status_id`, `relative_occupation`, `relative_income`, `created_at`, `updated_at`) VALUES
(1, 1, 'Garnett Martinez', 14, 69, 4, 'Consultant', '83785', '2024-12-08 13:31:32', '2024-12-08 13:31:32'),
(2, 2, 'Naomi De Villa', 8, 17, 1, 'Student', '0', '2024-12-08 13:31:32', '2024-12-08 13:31:32'),
(3, 2, 'Triston De Villa', 1, 29, 4, 'Virtual Assistant', '10349', '2024-12-08 13:31:32', '2024-12-08 13:31:32'),
(4, 2, 'Jacinthe De Villa', 8, 24, 3, NULL, NULL, '2024-12-08 13:31:32', '2024-12-08 13:31:32'),
(5, 2, 'Velma De Villa', 10, 29, 3, 'Graphic Designer', '26613', '2024-12-08 13:31:32', '2024-12-08 13:31:32'),
(6, 2, 'Mackenzie De Villa', 13, 64, 4, 'Consultant', '67447', '2024-12-08 13:31:33', '2024-12-08 13:31:33'),
(7, 3, 'Vinnie Delos Reyes', 1, 14, 1, 'Student', '0', '2024-12-08 13:31:33', '2024-12-08 13:31:33'),
(8, 3, 'Salma Delos Reyes', 9, 29, 1, NULL, NULL, '2024-12-08 13:31:34', '2024-12-08 13:31:34'),
(9, 4, 'Era Zaragoza', 12, 58, 1, NULL, NULL, '2024-12-08 13:31:34', '2024-12-08 13:31:34'),
(10, 4, 'Gaston Zaragoza', 18, 41, 3, NULL, NULL, '2024-12-08 13:31:34', '2024-12-08 13:31:34'),
(11, 5, 'Silas Manalaysay', 16, 15, 1, 'Student', '0', '2024-12-08 13:31:34', '2024-12-08 13:31:34'),
(12, 5, 'Emmie Manalaysay', 12, 69, 2, NULL, NULL, '2024-12-08 13:31:34', '2024-12-08 13:31:34'),
(13, 6, 'Triston De la Vega', 11, 69, 4, 'Retired', '0', '2024-12-08 13:31:34', '2024-12-08 13:31:34'),
(14, 6, 'Broderick De la Vega', 11, 68, 4, NULL, NULL, '2024-12-08 13:31:34', '2024-12-08 13:31:34'),
(15, 6, 'Ryley De la Vega', 11, 97, 2, 'Retired', '0', '2024-12-08 13:31:35', '2024-12-08 13:31:35'),
(16, 7, 'Amani De Guzman', 3, 70, 2, 'Retired', '0', '2024-12-08 13:31:35', '2024-12-08 13:31:35'),
(17, 7, 'Virgie De Guzman', 13, 55, 4, 'Designer', '22389', '2024-12-08 13:31:35', '2024-12-08 13:31:35'),
(18, 7, 'Jaquan De Guzman', 15, 30, 4, NULL, NULL, '2024-12-08 13:31:35', '2024-12-08 13:31:35'),
(19, 7, 'Carrie De Guzman', 18, 69, 3, NULL, NULL, '2024-12-08 13:31:35', '2024-12-08 13:31:35'),
(20, 7, 'Jaylin De Guzman', 7, 50, 4, 'Virtual Assistant', '16317', '2024-12-08 13:31:35', '2024-12-08 13:31:35'),
(21, 8, 'Tressie Santos', 12, 47, 2, NULL, NULL, '2024-12-08 13:31:35', '2024-12-08 13:31:35'),
(22, 8, 'Virginie Santos', 8, 25, 4, 'Photographer', '14600', '2024-12-08 13:31:35', '2024-12-08 13:31:35'),
(23, 8, 'Floy Santos', 3, 92, 2, NULL, NULL, '2024-12-08 13:31:35', '2024-12-08 13:31:35'),
(24, 9, 'Yvette Dela Torre', 13, 59, 2, 'Junior Developer', '26152', '2024-12-08 13:31:35', '2024-12-08 13:31:35'),
(25, 9, 'Lora Dela Torre', 12, 58, 3, 'Web Developer', '65359', '2024-12-08 13:31:35', '2024-12-08 13:31:35'),
(26, 9, 'Viola Dela Torre', 12, 88, 3, 'Retired', '0', '2024-12-08 13:31:35', '2024-12-08 13:31:35'),
(27, 9, 'Vicky Dela Torre', 15, 54, 4, NULL, NULL, '2024-12-08 13:31:35', '2024-12-08 13:31:35'),
(28, 9, 'Jovani Dela Torre', 10, 23, 3, 'Photographer', '16599', '2024-12-08 13:31:36', '2024-12-08 13:31:36'),
(29, 9, 'Mable Dela Torre', 10, 74, 3, NULL, NULL, '2024-12-08 13:31:36', '2024-12-08 13:31:36'),
(30, 9, 'Zaria Dela Torre', 11, 80, 4, 'Consultant', '90495', '2024-12-08 13:31:36', '2024-12-08 13:31:36'),
(31, 10, 'Breana Tiongson', 7, 68, 4, NULL, NULL, '2024-12-08 13:31:36', '2024-12-08 13:31:36'),
(32, 11, 'Bert Soriano', 2, 6, 1, 'Student', '0', '2024-12-08 13:31:36', '2024-12-08 13:31:36'),
(33, 11, 'Garret Soriano', 10, 28, 1, 'Social Media Manager', '39655', '2024-12-08 13:31:36', '2024-12-08 13:31:36'),
(34, 11, 'Mae Soriano', 2, 28, 1, 'Photographer', '21716', '2024-12-08 13:31:36', '2024-12-08 13:31:36'),
(35, 11, 'Gudrun Soriano', 7, 45, 3, NULL, NULL, '2024-12-08 13:31:36', '2024-12-08 13:31:36'),
(36, 11, 'Dorian Soriano', 2, 9, 1, 'Student', '0', '2024-12-08 13:31:36', '2024-12-08 13:31:36'),
(37, 11, 'Aurelia Soriano', 9, 26, 1, NULL, NULL, '2024-12-08 13:31:36', '2024-12-08 13:31:36'),
(38, 11, 'Emma Soriano', 10, 23, 2, 'Content Creator', '16803', '2024-12-08 13:31:36', '2024-12-08 13:31:36'),
(39, 11, 'Justus Soriano', 11, 84, 3, 'Retired', '0', '2024-12-08 13:31:36', '2024-12-08 13:31:36'),
(40, 11, 'Ryann Soriano', 1, 14, 1, 'Student', '0', '2024-12-08 13:31:36', '2024-12-08 13:31:36'),
(41, 12, 'Ludie Pascual', 14, 55, 4, NULL, NULL, '2024-12-08 13:31:36', '2024-12-08 13:31:36'),
(42, 13, 'Cayla Arroyo', 17, 72, 4, NULL, NULL, '2024-12-08 13:31:36', '2024-12-08 13:31:36'),
(43, 13, 'Sabrina Arroyo', 8, 9, 1, 'Student', '0', '2024-12-08 13:31:37', '2024-12-08 13:31:37'),
(44, 14, 'Waino Cortez', 9, 1, 1, 'Student', '0', '2024-12-08 13:31:37', '2024-12-08 13:31:37'),
(45, 14, 'Pamela Cortez', 12, 45, 3, NULL, NULL, '2024-12-08 13:31:37', '2024-12-08 13:31:37'),
(46, 14, 'Weldon Cortez', 2, 28, 3, 'Freelancer', '26181', '2024-12-08 13:31:37', '2024-12-08 13:31:37'),
(47, 14, 'Kody Cortez', 10, 70, 3, NULL, NULL, '2024-12-08 13:31:37', '2024-12-08 13:31:37'),
(48, 14, 'Elisha Cortez', 18, 33, 2, NULL, NULL, '2024-12-08 13:31:37', '2024-12-08 13:31:37'),
(49, 14, 'Ike Cortez', 7, 68, 3, NULL, NULL, '2024-12-08 13:31:37', '2024-12-08 13:31:37'),
(50, 14, 'Tom Cortez', 5, 36, 1, 'Content Creator', '16027', '2024-12-08 13:31:37', '2024-12-08 13:31:37'),
(51, 15, 'Ashton Del Rosario', 6, 49, 3, 'Carpenter', '22133', '2024-12-08 13:31:37', '2024-12-08 13:31:37'),
(52, 15, 'Jeff Del Rosario', 17, 78, 3, NULL, NULL, '2024-12-08 13:31:37', '2024-12-08 13:31:37'),
(53, 16, 'Dewitt Matias', 12, 55, 1, NULL, NULL, '2024-12-08 13:31:37', '2024-12-08 13:31:37'),
(54, 16, 'Betty Matias', 10, 39, 4, NULL, NULL, '2024-12-08 13:31:37', '2024-12-08 13:31:37'),
(55, 17, 'Isabel Arroyo', 1, 6, 1, 'Student', '0', '2024-12-08 13:31:37', '2024-12-08 13:31:37'),
(56, 17, 'Damion Arroyo', 14, 74, 3, 'Retired', '0', '2024-12-08 13:31:37', '2024-12-08 13:31:37'),
(57, 17, 'Hunter Arroyo', 9, 30, 2, 'Content Creator', '13232', '2024-12-08 13:31:38', '2024-12-08 13:31:38'),
(58, 17, 'Fanny Arroyo', 16, 30, 4, NULL, NULL, '2024-12-08 13:31:38', '2024-12-08 13:31:38'),
(59, 17, 'Elnora Arroyo', 16, 13, 1, 'Student', '0', '2024-12-08 13:31:38', '2024-12-08 13:31:38'),
(60, 17, 'Aniyah Arroyo', 13, 58, 3, 'Mechanic', '33261', '2024-12-08 13:31:38', '2024-12-08 13:31:38'),
(61, 17, 'Shanie Arroyo', 16, 1, 1, 'Student', '0', '2024-12-08 13:31:38', '2024-12-08 13:31:38'),
(62, 18, 'Dillon De Ocampo', 6, 66, 3, NULL, NULL, '2024-12-08 13:31:38', '2024-12-08 13:31:38'),
(63, 18, 'Zoe De Ocampo', 10, 37, 4, 'Scientist', '60444', '2024-12-08 13:31:38', '2024-12-08 13:31:38'),
(64, 18, 'Nicole De Ocampo', 15, 43, 3, 'Graphic Designer', '23007', '2024-12-08 13:31:38', '2024-12-08 13:31:38'),
(65, 18, 'Lauren De Ocampo', 4, 77, 4, NULL, NULL, '2024-12-08 13:31:38', '2024-12-08 13:31:38'),
(66, 18, 'Dennis De Ocampo', 10, 17, 1, 'Student', '0', '2024-12-08 13:31:38', '2024-12-08 13:31:38'),
(67, 19, 'Taurean De Ocampo', 4, 35, 3, 'Architect', '33882', '2024-12-08 13:31:38', '2024-12-08 13:31:38'),
(68, 19, 'Demarco De Ocampo', 13, 53, 2, 'Freelancer', '24784', '2024-12-08 13:31:38', '2024-12-08 13:31:38'),
(69, 19, 'Dale De Ocampo', 3, 49, 4, NULL, NULL, '2024-12-08 13:31:39', '2024-12-08 13:31:39'),
(70, 19, 'Marcel De Ocampo', 2, 17, 1, 'Student', '0', '2024-12-08 13:31:40', '2024-12-08 13:31:40'),
(71, 19, 'Kristian De Ocampo', 13, 69, 4, NULL, NULL, '2024-12-08 13:31:40', '2024-12-08 13:31:40'),
(72, 19, 'Roman De Ocampo', 12, 45, 1, 'Architect', '66193', '2024-12-08 13:31:40', '2024-12-08 13:31:40'),
(73, 20, 'Kelton Santiago', 15, 51, 2, NULL, NULL, '2024-12-08 13:31:40', '2024-12-08 13:31:40'),
(74, 20, 'Flavio Santiago', 10, 60, 3, 'Retired', '0', '2024-12-08 13:31:40', '2024-12-08 13:31:40'),
(75, 20, 'Sister Santiago', 18, 39, 4, NULL, NULL, '2024-12-08 13:31:40', '2024-12-08 13:31:40'),
(76, 20, 'Donna Santiago', 3, 64, 4, NULL, NULL, '2024-12-08 13:31:40', '2024-12-08 13:31:40'),
(77, 20, 'Robbie Santiago', 4, 53, 3, 'Social Media Manager', '24398', '2024-12-08 13:31:40', '2024-12-08 13:31:40'),
(78, 20, 'Wellington Santiago', 7, 40, 1, NULL, NULL, '2024-12-08 13:31:41', '2024-12-08 13:31:41'),
(79, 20, 'Helga Santiago', 7, 32, 4, 'Pilot', '69958', '2024-12-08 13:31:41', '2024-12-08 13:31:41'),
(80, 20, 'Cecil Santiago', 5, 79, 4, NULL, NULL, '2024-12-08 13:31:41', '2024-12-08 13:31:41'),
(81, 20, 'Connie Santiago', 14, 44, 1, NULL, NULL, '2024-12-08 13:31:41', '2024-12-08 13:31:41'),
(82, 21, 'Jazmyn Castillo', 12, 68, 3, NULL, NULL, '2024-12-08 13:31:41', '2024-12-08 13:31:41'),
(83, 22, 'Leanna Rocamora', 3, 38, 3, 'Writer', '13952', '2024-12-08 13:31:41', '2024-12-08 13:31:41'),
(84, 22, 'Rhiannon Rocamora', 7, 53, 1, NULL, NULL, '2024-12-08 13:31:41', '2024-12-08 13:31:41'),
(85, 22, 'Lew Rocamora', 17, 41, 2, 'Content Creator', '6890', '2024-12-08 13:31:41', '2024-12-08 13:31:41'),
(86, 22, 'Bria Rocamora', 2, 24, 1, 'Part-time Job', NULL, '2024-12-08 13:31:41', '2024-12-08 13:31:41'),
(87, 23, 'Jailyn Riviera', 5, 41, 3, 'Dentist', '112501', '2024-12-08 13:31:41', '2024-12-08 13:31:41'),
(88, 23, 'Kiara Riviera', 4, 30, 2, 'Graphic Designer', '16284', '2024-12-08 13:31:42', '2024-12-08 13:31:42'),
(89, 23, 'Lessie Riviera', 8, 35, 3, 'Scientist', '46110', '2024-12-08 13:31:42', '2024-12-08 13:31:42'),
(90, 23, 'Jay Riviera', 4, 67, 2, NULL, NULL, '2024-12-08 13:31:42', '2024-12-08 13:31:42'),
(91, 23, 'Corrine Riviera', 13, 63, 3, NULL, NULL, '2024-12-08 13:31:42', '2024-12-08 13:31:42'),
(92, 24, 'Talia Nieves', 12, 80, 2, NULL, NULL, '2024-12-08 13:31:42', '2024-12-08 13:31:42'),
(93, 24, 'Quentin Nieves', 6, 31, 4, NULL, NULL, '2024-12-08 13:31:42', '2024-12-08 13:31:42'),
(94, 24, 'Kyler Nieves', 13, 54, 1, NULL, NULL, '2024-12-08 13:31:42', '2024-12-08 13:31:42'),
(95, 24, 'Jamir Nieves', 17, 37, 4, NULL, NULL, '2024-12-08 13:31:42', '2024-12-08 13:31:42'),
(96, 24, 'Marianna Nieves', 15, 38, 4, NULL, NULL, '2024-12-08 13:31:42', '2024-12-08 13:31:42'),
(97, 24, 'Norbert Nieves', 4, 94, 4, NULL, NULL, '2024-12-08 13:31:42', '2024-12-08 13:31:42'),
(98, 24, 'Giovanna Nieves', 12, 90, 3, NULL, NULL, '2024-12-08 13:31:42', '2024-12-08 13:31:42'),
(99, 25, 'Alena Villanueva', 1, 11, 1, 'Student', '0', '2024-12-08 13:31:43', '2024-12-08 13:31:43'),
(100, 25, 'Robyn Villanueva', 13, 45, 4, NULL, NULL, '2024-12-08 13:31:43', '2024-12-08 13:31:43'),
(101, 25, 'Shakira Villanueva', 2, 21, 4, 'Content Creator', '6536', '2024-12-08 13:31:43', '2024-12-08 13:31:43'),
(102, 25, 'Cordie Villanueva', 11, 97, 3, NULL, NULL, '2024-12-08 13:31:43', '2024-12-08 13:31:43'),
(103, 25, 'Leone Villanueva', 14, 74, 3, 'Consultant', '92525', '2024-12-08 13:31:43', '2024-12-08 13:31:43'),
(104, 25, 'Kaylee Villanueva', 11, 76, 4, NULL, NULL, '2024-12-08 13:31:43', '2024-12-08 13:31:43'),
(105, 25, 'Henry Villanueva', 14, 31, 1, 'Musician', '25227', '2024-12-08 13:31:43', '2024-12-08 13:31:43'),
(106, 25, 'Kelly Villanueva', 18, 40, 4, NULL, NULL, '2024-12-08 13:31:43', '2024-12-08 13:31:43'),
(107, 25, 'Kasey Villanueva', 1, 21, 3, 'Social Media Manager', '26642', '2024-12-08 13:31:43', '2024-12-08 13:31:43'),
(108, 25, 'Lukas Villanueva', 13, 53, 1, NULL, NULL, '2024-12-08 13:31:43', '2024-12-08 13:31:43'),
(109, 26, 'Stella Salvador', 4, 58, 3, NULL, NULL, '2024-12-08 13:31:43', '2024-12-08 13:31:43'),
(110, 26, 'Lois Salvador', 12, 84, 2, NULL, NULL, '2024-12-08 13:31:43', '2024-12-08 13:31:43'),
(111, 26, 'Ashton Salvador', 11, 65, 2, 'Consultant', '96467', '2024-12-08 13:31:43', '2024-12-08 13:31:43'),
(112, 27, 'Barbara Santiago', 3, 56, 2, 'Scientist', '49225', '2024-12-08 13:31:43', '2024-12-08 13:31:43'),
(113, 27, 'Rylan Santiago', 3, 90, 2, 'Retired', '0', '2024-12-08 13:31:44', '2024-12-08 13:31:44'),
(114, 27, 'Lisette Santiago', 9, 20, 2, NULL, NULL, '2024-12-08 13:31:44', '2024-12-08 13:31:44'),
(115, 27, 'Jerrell Santiago', 8, 2, 1, 'Student', '0', '2024-12-08 13:31:44', '2024-12-08 13:31:44'),
(116, 27, 'Retta Santiago', 12, 55, 1, 'Construction Worker', '32478', '2024-12-08 13:31:44', '2024-12-08 13:31:44'),
(117, 28, 'Ellen Nieves', 4, 57, 4, 'Architect', '39410', '2024-12-08 13:31:44', '2024-12-08 13:31:44'),
(118, 28, 'Madilyn Nieves', 3, 81, 4, NULL, NULL, '2024-12-08 13:31:44', '2024-12-08 13:31:44'),
(119, 29, 'Leslie Gonzales', 15, 53, 1, 'Retired', '0', '2024-12-08 13:31:44', '2024-12-08 13:31:44'),
(120, 30, 'Icie Castañeda', 16, 18, 2, 'Virtual Assistant', '15960', '2024-12-08 13:31:44', '2024-12-08 13:31:44'),
(121, 30, 'Salma Castañeda', 9, 20, 4, 'Freelancer', '21965', '2024-12-08 13:31:44', '2024-12-08 13:31:44'),
(122, 31, 'Dereck Ocampo', 6, 36, 1, 'Writer', '29649', '2024-12-08 13:31:44', '2024-12-08 13:31:44'),
(123, 32, 'Matilda Bañez', 13, 70, 4, NULL, NULL, '2024-12-08 13:31:44', '2024-12-08 13:31:44'),
(124, 32, 'Lorenz Bañez', 12, 63, 2, NULL, NULL, '2024-12-08 13:31:44', '2024-12-08 13:31:44'),
(125, 32, 'Simeon Bañez', 5, 67, 4, NULL, NULL, '2024-12-08 13:31:44', '2024-12-08 13:31:44'),
(126, 32, 'Rodolfo Bañez', 8, 13, 1, 'Student', '0', '2024-12-08 13:31:44', '2024-12-08 13:31:44'),
(127, 32, 'Tristin Bañez', 8, 16, 1, 'Student', '0', '2024-12-08 13:31:45', '2024-12-08 13:31:45'),
(128, 33, 'Raul Esteban', 18, 26, 1, 'Social Media Manager', '22510', '2024-12-08 13:31:45', '2024-12-08 13:31:45'),
(129, 33, 'Destany Esteban', 18, 32, 2, NULL, NULL, '2024-12-08 13:31:45', '2024-12-08 13:31:45'),
(130, 33, 'Elda Esteban', 16, 9, 1, 'Student', '0', '2024-12-08 13:31:45', '2024-12-08 13:31:45'),
(131, 34, 'Janelle Alvarado', 11, 67, 4, NULL, NULL, '2024-12-08 13:31:45', '2024-12-08 13:31:45'),
(132, 34, 'Stuart Alvarado', 6, 77, 3, NULL, NULL, '2024-12-08 13:31:45', '2024-12-08 13:31:45'),
(133, 34, 'Marjory Alvarado', 8, 27, 3, 'Photographer', '29373', '2024-12-08 13:31:45', '2024-12-08 13:31:45'),
(134, 34, 'Braulio Alvarado', 3, 62, 4, 'Consultant', '31658', '2024-12-08 13:31:45', '2024-12-08 13:31:45'),
(135, 34, 'Dawn Alvarado', 17, 68, 3, NULL, NULL, '2024-12-08 13:31:45', '2024-12-08 13:31:45'),
(136, 34, 'Lucy Alvarado', 6, 51, 4, 'Nurse', '33837', '2024-12-08 13:31:46', '2024-12-08 13:31:46'),
(137, 34, 'Greta Alvarado', 2, 25, 2, 'Part-time Job', NULL, '2024-12-08 13:31:46', '2024-12-08 13:31:46'),
(138, 34, 'Ole Alvarado', 1, 21, 1, 'Social Media Manager', '29854', '2024-12-08 13:31:46', '2024-12-08 13:31:46'),
(139, 34, 'Brendan Alvarado', 4, 39, 1, 'Scientist', '75341', '2024-12-08 13:31:47', '2024-12-08 13:31:47'),
(140, 35, 'Robyn Dizon', 10, 18, 1, 'Intern', '6007', '2024-12-08 13:31:47', '2024-12-08 13:31:47'),
(141, 35, 'Luna Dizon', 4, 63, 4, NULL, NULL, '2024-12-08 13:31:47', '2024-12-08 13:31:47'),
(142, 36, 'Yasmin Mendoza', 2, 8, 1, 'Student', '0', '2024-12-08 13:31:47', '2024-12-08 13:31:47'),
(143, 36, 'Richard Mendoza', 13, 74, 3, NULL, NULL, '2024-12-08 13:31:47', '2024-12-08 13:31:47'),
(144, 36, 'Enrico Mendoza', 12, 87, 3, NULL, NULL, '2024-12-08 13:31:47', '2024-12-08 13:31:47'),
(145, 37, 'Joe De la Cruz', 13, 83, 4, NULL, NULL, '2024-12-08 13:31:47', '2024-12-08 13:31:47'),
(146, 37, 'Clint De la Cruz', 6, 60, 2, 'Retired', '0', '2024-12-08 13:31:47', '2024-12-08 13:31:47'),
(147, 38, 'Mustafa Sison', 5, 55, 3, NULL, NULL, '2024-12-08 13:31:47', '2024-12-08 13:31:47'),
(148, 38, 'Sonia Sison', 18, 70, 3, 'Consultant', '44624', '2024-12-08 13:31:47', '2024-12-08 13:31:47'),
(149, 38, 'Emerson Sison', 9, 11, 1, 'Student', '0', '2024-12-08 13:31:47', '2024-12-08 13:31:47'),
(150, 38, 'Rocky Sison', 3, 56, 2, 'Software Developer', '62468', '2024-12-08 13:31:47', '2024-12-08 13:31:47'),
(151, 38, 'Polly Sison', 10, 71, 3, 'Retired', '0', '2024-12-08 13:31:47', '2024-12-08 13:31:47'),
(152, 39, 'Lonzo De la Torre', 1, 8, 1, 'Student', '0', '2024-12-08 13:31:47', '2024-12-08 13:31:47'),
(153, 39, 'Theresa De la Torre', 15, 53, 2, 'Consultant', '63454', '2024-12-08 13:31:47', '2024-12-08 13:31:47'),
(154, 39, 'Luna De la Torre', 7, 40, 1, NULL, NULL, '2024-12-08 13:31:48', '2024-12-08 13:31:48'),
(155, 39, 'Hershel De la Torre', 10, 32, 4, NULL, NULL, '2024-12-08 13:31:48', '2024-12-08 13:31:48'),
(156, 39, 'Maryjane De la Torre', 2, 11, 1, 'Student', '0', '2024-12-08 13:31:48', '2024-12-08 13:31:48'),
(157, 39, 'Constance De la Torre', 6, 72, 4, NULL, NULL, '2024-12-08 13:31:48', '2024-12-08 13:31:48'),
(158, 39, 'Blanca De la Torre', 4, 30, 3, 'Lawyer', '41948', '2024-12-08 13:31:48', '2024-12-08 13:31:48'),
(159, 39, 'Ima De la Torre', 7, 77, 4, 'Retired', '0', '2024-12-08 13:31:48', '2024-12-08 13:31:48'),
(160, 39, 'Damon De la Torre', 4, 73, 3, NULL, NULL, '2024-12-08 13:31:48', '2024-12-08 13:31:48'),
(161, 40, 'Briana Ramos', 8, 25, 2, NULL, NULL, '2024-12-08 13:31:48', '2024-12-08 13:31:48'),
(162, 40, 'Tom Ramos', 2, 19, 2, 'Artist', '22134', '2024-12-08 13:31:48', '2024-12-08 13:31:48'),
(163, 40, 'Justen Ramos', 3, 32, 1, NULL, NULL, '2024-12-08 13:31:48', '2024-12-08 13:31:48'),
(164, 40, 'Jettie Ramos', 14, 60, 3, NULL, NULL, '2024-12-08 13:31:48', '2024-12-08 13:31:48'),
(165, 41, 'Veda Torres', 11, 82, 2, NULL, NULL, '2024-12-08 13:31:48', '2024-12-08 13:31:48'),
(166, 42, 'Chasity De Villa', 7, 39, 2, NULL, NULL, '2024-12-08 13:31:48', '2024-12-08 13:31:48'),
(167, 42, 'Anita De Villa', 3, 80, 3, NULL, NULL, '2024-12-08 13:31:48', '2024-12-08 13:31:48'),
(168, 42, 'Daphney De Villa', 3, 53, 3, 'Bus Driver', '32752', '2024-12-08 13:31:48', '2024-12-08 13:31:48'),
(169, 42, 'Alberta De Villa', 7, 41, 1, NULL, NULL, '2024-12-08 13:31:48', '2024-12-08 13:31:48'),
(170, 42, 'Florencio De Villa', 6, 38, 1, NULL, NULL, '2024-12-08 13:31:48', '2024-12-08 13:31:48'),
(171, 42, 'Stephania De Villa', 15, 73, 4, 'Retired', '0', '2024-12-08 13:31:49', '2024-12-08 13:31:49'),
(172, 42, 'Judge De Villa', 3, 30, 4, 'Intern', '14234', '2024-12-08 13:31:49', '2024-12-08 13:31:49'),
(173, 42, 'Reggie De Villa', 13, 86, 4, NULL, NULL, '2024-12-08 13:31:49', '2024-12-08 13:31:49'),
(174, 42, 'Alvis De Villa', 15, 59, 4, 'Content Creator', '21594', '2024-12-08 13:31:49', '2024-12-08 13:31:49'),
(175, 42, 'Elfrieda De Villa', 14, 49, 3, 'Construction Worker', '34517', '2024-12-08 13:31:49', '2024-12-08 13:31:49'),
(176, 43, 'Opal De Guzman', 17, 58, 2, NULL, NULL, '2024-12-08 13:31:49', '2024-12-08 13:31:49'),
(177, 43, 'Cletus De Guzman', 2, 11, 1, 'Student', '0', '2024-12-08 13:31:49', '2024-12-08 13:31:49'),
(178, 43, 'Maida De Guzman', 17, 76, 2, NULL, NULL, '2024-12-08 13:31:49', '2024-12-08 13:31:49'),
(179, 43, 'Viviane De Guzman', 15, 34, 1, 'Photographer', '24806', '2024-12-08 13:31:49', '2024-12-08 13:31:49'),
(180, 43, 'Raoul De Guzman', 2, 20, 2, 'Part-time Job', NULL, '2024-12-08 13:31:49', '2024-12-08 13:31:49'),
(181, 43, 'Eulah De Guzman', 18, 19, 2, 'Photographer', '19948', '2024-12-08 13:31:49', '2024-12-08 13:31:49'),
(182, 43, 'Davin De Guzman', 15, 68, 2, NULL, NULL, '2024-12-08 13:31:49', '2024-12-08 13:31:49'),
(183, 43, 'Justen De Guzman', 17, 42, 4, NULL, NULL, '2024-12-08 13:31:49', '2024-12-08 13:31:49'),
(184, 44, 'Miguel López', 1, 6, 1, 'Student', '0', '2024-12-08 13:31:50', '2024-12-08 13:31:50'),
(185, 44, 'Bruce López', 13, 70, 3, 'Consultant', '62568', '2024-12-08 13:31:50', '2024-12-08 13:31:50'),
(186, 44, 'Myrtie López', 9, 5, 1, 'Student', '0', '2024-12-08 13:31:50', '2024-12-08 13:31:50'),
(187, 44, 'Jonas López', 17, 62, 4, NULL, NULL, '2024-12-08 13:31:50', '2024-12-08 13:31:50'),
(188, 44, 'Bernard López', 12, 43, 2, NULL, NULL, '2024-12-08 13:31:50', '2024-12-08 13:31:50'),
(189, 44, 'Alexis López', 16, 24, 1, NULL, NULL, '2024-12-08 13:31:50', '2024-12-08 13:31:50'),
(190, 44, 'Riley López', 11, 66, 2, NULL, NULL, '2024-12-08 13:31:50', '2024-12-08 13:31:50'),
(191, 44, 'Giles López', 16, 13, 1, 'Student', '0', '2024-12-08 13:31:50', '2024-12-08 13:31:50'),
(192, 44, 'Emmie López', 12, 90, 2, NULL, NULL, '2024-12-08 13:31:50', '2024-12-08 13:31:50'),
(193, 44, 'Abigayle López', 9, 39, 2, NULL, NULL, '2024-12-08 13:31:50', '2024-12-08 13:31:50'),
(194, 45, 'Kayden Villafuerte', 12, 55, 2, 'Farmer', '5465', '2024-12-08 13:31:50', '2024-12-08 13:31:50'),
(195, 45, 'Tod Villafuerte', 2, 15, 1, 'Student', '0', '2024-12-08 13:31:50', '2024-12-08 13:31:50'),
(196, 45, 'Norma Villafuerte', 6, 61, 3, 'Retired', '0', '2024-12-08 13:31:50', '2024-12-08 13:31:50'),
(197, 45, 'Lavinia Villafuerte', 9, 8, 1, 'Student', '0', '2024-12-08 13:31:50', '2024-12-08 13:31:50'),
(198, 45, 'Lisette Villafuerte', 18, 63, 4, NULL, NULL, '2024-12-08 13:31:50', '2024-12-08 13:31:50'),
(199, 45, 'Jerrold Villafuerte', 4, 56, 1, NULL, NULL, '2024-12-08 13:31:51', '2024-12-08 13:31:51'),
(200, 45, 'Sidney Villafuerte', 16, 18, 3, 'Virtual Assistant', '24873', '2024-12-08 13:31:51', '2024-12-08 13:31:51'),
(201, 45, 'Uriel Villafuerte', 5, 31, 3, 'Writer', '27527', '2024-12-08 13:31:51', '2024-12-08 13:31:51'),
(202, 46, 'Freeman Gonzales', 5, 52, 2, 'Artist', '11666', '2024-12-08 13:31:52', '2024-12-08 13:31:52'),
(203, 46, 'Gilbert Gonzales', 4, 86, 3, NULL, NULL, '2024-12-08 13:31:52', '2024-12-08 13:31:52'),
(204, 47, 'Chandler Torres', 17, 50, 4, 'Construction Worker', '19815', '2024-12-08 13:31:53', '2024-12-08 13:31:53'),
(205, 47, 'Rubie Torres', 4, 71, 2, NULL, NULL, '2024-12-08 13:31:53', '2024-12-08 13:31:53'),
(206, 47, 'Arnoldo Torres', 14, 78, 2, NULL, NULL, '2024-12-08 13:31:53', '2024-12-08 13:31:53'),
(207, 47, 'Mikayla Torres', 14, 60, 4, NULL, NULL, '2024-12-08 13:31:53', '2024-12-08 13:31:53'),
(208, 47, 'Mary Torres', 6, 54, 4, NULL, NULL, '2024-12-08 13:31:53', '2024-12-08 13:31:53'),
(209, 47, 'Imogene Torres', 5, 81, 3, 'Retired', '0', '2024-12-08 13:31:53', '2024-12-08 13:31:53'),
(210, 47, 'Kayden Torres', 9, 19, 1, NULL, NULL, '2024-12-08 13:31:53', '2024-12-08 13:31:53'),
(211, 48, 'Jarod Esguerra', 17, 84, 2, NULL, NULL, '2024-12-08 13:31:53', '2024-12-08 13:31:53'),
(212, 48, 'Mya Esguerra', 2, 23, 2, 'Part-time Job', NULL, '2024-12-08 13:31:53', '2024-12-08 13:31:53'),
(213, 48, 'Stefanie Esguerra', 10, 34, 2, NULL, NULL, '2024-12-08 13:31:53', '2024-12-08 13:31:53'),
(214, 49, 'Luther Dizon', 18, 10, 1, 'Student', '0', '2024-12-08 13:31:53', '2024-12-08 13:31:53'),
(215, 49, 'Lawrence Dizon', 7, 79, 2, NULL, NULL, '2024-12-08 13:31:53', '2024-12-08 13:31:53'),
(216, 49, 'Laurianne Dizon', 18, 79, 2, NULL, NULL, '2024-12-08 13:31:53', '2024-12-08 13:31:53'),
(217, 49, 'Brenden Dizon', 8, 34, 2, 'Mechanic', '34486', '2024-12-08 13:31:53', '2024-12-08 13:31:53'),
(218, 49, 'Keenan Dizon', 2, 3, 1, 'Student', '0', '2024-12-08 13:31:53', '2024-12-08 13:31:53'),
(219, 49, 'Oda Dizon', 18, 1, 1, 'Student', '0', '2024-12-08 13:31:53', '2024-12-08 13:31:53'),
(220, 50, 'Noemie Natividad', 3, 34, 3, 'Intern', '6080', '2024-12-08 13:31:54', '2024-12-08 13:31:54'),
(221, 51, 'Clay Cabigon', 11, 79, 4, NULL, NULL, '2024-12-08 13:31:54', '2024-12-08 13:31:54'),
(222, 51, 'Blake Cabigon', 6, 41, 3, NULL, NULL, '2024-12-08 13:31:54', '2024-12-08 13:31:54'),
(223, 51, 'Isabella Cabigon', 9, 7, 1, 'Student', '0', '2024-12-08 13:31:54', '2024-12-08 13:31:54'),
(224, 52, 'Lillie Villanueva', 11, 79, 3, 'Retired', '0', '2024-12-08 13:31:54', '2024-12-08 13:31:54'),
(225, 52, 'Allene Villanueva', 14, 65, 2, 'Retired', '0', '2024-12-08 13:31:54', '2024-12-08 13:31:54'),
(226, 53, 'Alysha Martelino', 15, 32, 2, NULL, NULL, '2024-12-08 13:31:54', '2024-12-08 13:31:54'),
(227, 54, 'Kattie Vera', 6, 68, 4, NULL, NULL, '2024-12-08 13:31:54', '2024-12-08 13:31:54'),
(228, 54, 'Cheyanne Vera', 10, 33, 4, NULL, NULL, '2024-12-08 13:31:54', '2024-12-08 13:31:54'),
(229, 54, 'Kasey Vera', 1, 14, 1, 'Student', '0', '2024-12-08 13:31:54', '2024-12-08 13:31:54'),
(230, 54, 'Bernita Vera', 12, 51, 1, 'Social Media Manager', '16808', '2024-12-08 13:31:54', '2024-12-08 13:31:54'),
(231, 54, 'Marie Vera', 11, 76, 3, NULL, NULL, '2024-12-08 13:31:54', '2024-12-08 13:31:54'),
(232, 54, 'Lulu Vera', 3, 56, 3, NULL, NULL, '2024-12-08 13:31:54', '2024-12-08 13:31:54'),
(233, 54, 'Cecile Vera', 1, 8, 1, 'Student', '0', '2024-12-08 13:31:54', '2024-12-08 13:31:54'),
(234, 54, 'Jovanny Vera', 16, 9, 1, 'Student', '0', '2024-12-08 13:31:54', '2024-12-08 13:31:54'),
(235, 55, 'Reed López', 12, 53, 2, 'Chef', '15673', '2024-12-08 13:31:55', '2024-12-08 13:31:55'),
(236, 55, 'Tressa López', 4, 99, 4, NULL, NULL, '2024-12-08 13:31:55', '2024-12-08 13:31:55'),
(237, 55, 'Macey López', 7, 52, 2, NULL, NULL, '2024-12-08 13:31:55', '2024-12-08 13:31:55'),
(238, 55, 'Arnaldo López', 8, 2, 1, 'Student', '0', '2024-12-08 13:31:55', '2024-12-08 13:31:55'),
(239, 56, 'Ramona De la Vega', 9, 2, 1, 'Student', '0', '2024-12-08 13:31:55', '2024-12-08 13:31:55'),
(240, 56, 'Melissa De la Vega', 14, 37, 1, 'Graphic Designer', '19542', '2024-12-08 13:31:55', '2024-12-08 13:31:55'),
(241, 56, 'Milford De la Vega', 2, 23, 1, NULL, NULL, '2024-12-08 13:31:55', '2024-12-08 13:31:55'),
(242, 56, 'Gregoria De la Vega', 5, 79, 2, NULL, NULL, '2024-12-08 13:31:55', '2024-12-08 13:31:55'),
(243, 56, 'Joana De la Vega', 16, 15, 1, 'Student', '0', '2024-12-08 13:31:55', '2024-12-08 13:31:55'),
(244, 56, 'Elwyn De la Vega', 4, 83, 2, 'Consultant', '59159', '2024-12-08 13:31:55', '2024-12-08 13:31:55'),
(245, 56, 'Shemar De la Vega', 9, 8, 1, 'Student', '0', '2024-12-08 13:31:55', '2024-12-08 13:31:55'),
(246, 56, 'Lilian De la Vega', 3, 62, 3, 'Consultant', '92497', '2024-12-08 13:31:55', '2024-12-08 13:31:55'),
(247, 56, 'Oma De la Vega', 10, 23, 3, 'Virtual Assistant', '18232', '2024-12-08 13:31:55', '2024-12-08 13:31:55'),
(248, 57, 'Blair Santos', 12, 47, 1, 'Construction Worker', '23332', '2024-12-08 13:31:55', '2024-12-08 13:31:55'),
(249, 57, 'Candelario Santos', 3, 85, 2, NULL, NULL, '2024-12-08 13:31:56', '2024-12-08 13:31:56'),
(250, 57, 'Jaleel Santos', 9, 14, 1, 'Student', '0', '2024-12-08 13:31:56', '2024-12-08 13:31:56'),
(251, 57, 'Elwyn Santos', 11, 84, 3, NULL, NULL, '2024-12-08 13:31:56', '2024-12-08 13:31:56'),
(252, 57, 'Robb Santos', 3, 40, 3, NULL, NULL, '2024-12-08 13:31:56', '2024-12-08 13:31:56'),
(253, 57, 'America Santos', 7, 68, 3, 'Retired', '0', '2024-12-08 13:31:56', '2024-12-08 13:31:56'),
(254, 58, 'Anika Bacani', 10, 37, 3, 'Social Media Manager', '25738', '2024-12-08 13:31:56', '2024-12-08 13:31:56'),
(255, 58, 'Retha Bacani', 13, 73, 3, NULL, NULL, '2024-12-08 13:31:56', '2024-12-08 13:31:56'),
(256, 58, 'Clementine Bacani', 1, 5, 1, 'Student', '0', '2024-12-08 13:31:56', '2024-12-08 13:31:56'),
(257, 58, 'Madie Bacani', 5, 63, 2, 'Consultant', '94306', '2024-12-08 13:31:56', '2024-12-08 13:31:56'),
(258, 58, 'Nadia Bacani', 8, 13, 1, 'Student', '0', '2024-12-08 13:31:56', '2024-12-08 13:31:56'),
(259, 58, 'Adrian Bacani', 11, 67, 3, NULL, NULL, '2024-12-08 13:31:56', '2024-12-08 13:31:56'),
(260, 59, 'Jaquelin Villanueva', 15, 75, 4, NULL, NULL, '2024-12-08 13:31:56', '2024-12-08 13:31:56'),
(261, 59, 'Armand Villanueva', 12, 53, 2, 'Doctor', '79880', '2024-12-08 13:31:56', '2024-12-08 13:31:56'),
(262, 59, 'Trevor Villanueva', 5, 70, 2, NULL, NULL, '2024-12-08 13:31:56', '2024-12-08 13:31:56'),
(263, 59, 'Schuyler Villanueva', 6, 43, 4, 'Retired', '0', '2024-12-08 13:31:56', '2024-12-08 13:31:56'),
(264, 59, 'Marilyne Villanueva', 12, 90, 4, NULL, NULL, '2024-12-08 13:31:56', '2024-12-08 13:31:56'),
(265, 59, 'Frieda Villanueva', 17, 61, 2, NULL, NULL, '2024-12-08 13:31:56', '2024-12-08 13:31:56'),
(266, 59, 'Jairo Villanueva', 17, 30, 3, NULL, NULL, '2024-12-08 13:31:56', '2024-12-08 13:31:56'),
(267, 60, 'Al Martelino', 12, 60, 3, NULL, NULL, '2024-12-08 13:31:57', '2024-12-08 13:31:57'),
(268, 60, 'Carolina Martelino', 16, 23, 2, 'Intern', '11030', '2024-12-08 13:31:57', '2024-12-08 13:31:57'),
(269, 60, 'Janessa Martelino', 17, 88, 4, NULL, NULL, '2024-12-08 13:31:57', '2024-12-08 13:31:57'),
(270, 60, 'Gerardo Martelino', 14, 54, 4, 'Photographer', '21759', '2024-12-08 13:31:57', '2024-12-08 13:31:57'),
(271, 61, 'Claire Zaragoza', 9, 12, 1, 'Student', '0', '2024-12-08 13:31:57', '2024-12-08 13:31:57'),
(272, 61, 'Ara Zaragoza', 18, 36, 1, NULL, NULL, '2024-12-08 13:31:57', '2024-12-08 13:31:57'),
(273, 61, 'Madelynn Zaragoza', 11, 97, 4, NULL, NULL, '2024-12-08 13:31:57', '2024-12-08 13:31:57'),
(274, 61, 'Christina Zaragoza', 7, 71, 2, NULL, NULL, '2024-12-08 13:31:57', '2024-12-08 13:31:57'),
(275, 61, 'William Zaragoza', 7, 68, 4, NULL, NULL, '2024-12-08 13:31:57', '2024-12-08 13:31:57'),
(276, 61, 'Luciano Zaragoza', 15, 39, 4, NULL, NULL, '2024-12-08 13:31:58', '2024-12-08 13:31:58'),
(277, 61, 'Saige Zaragoza', 10, 25, 3, 'Content Creator', '20421', '2024-12-08 13:31:58', '2024-12-08 13:31:58'),
(278, 61, 'Terence Zaragoza', 5, 41, 4, 'Virtual Assistant', '10715', '2024-12-08 13:31:58', '2024-12-08 13:31:58'),
(279, 62, 'Trent Alvarez', 13, 63, 3, NULL, NULL, '2024-12-08 13:31:58', '2024-12-08 13:31:58'),
(280, 62, 'Mateo Alvarez', 17, 43, 2, 'Graphic Designer', '33711', '2024-12-08 13:31:59', '2024-12-08 13:31:59'),
(281, 62, 'Olin Alvarez', 12, 75, 4, NULL, NULL, '2024-12-08 13:31:59', '2024-12-08 13:31:59'),
(282, 63, 'Ollie Cabigon', 10, 49, 4, NULL, NULL, '2024-12-08 13:31:59', '2024-12-08 13:31:59'),
(283, 63, 'Jerod Cabigon', 14, 72, 3, NULL, NULL, '2024-12-08 13:31:59', '2024-12-08 13:31:59'),
(284, 64, 'Fernando Villanueva', 3, 98, 3, 'Retired', '0', '2024-12-08 13:31:59', '2024-12-08 13:31:59'),
(285, 64, 'Llewellyn Villanueva', 4, 98, 2, 'Consultant', '51001', '2024-12-08 13:31:59', '2024-12-08 13:31:59'),
(286, 64, 'Celestino Villanueva', 17, 99, 4, NULL, NULL, '2024-12-08 13:31:59', '2024-12-08 13:31:59'),
(287, 64, 'Mara Villanueva', 16, 23, 2, 'Social Media Manager', '31376', '2024-12-08 13:31:59', '2024-12-08 13:31:59'),
(288, 64, 'Earnest Villanueva', 16, 4, 1, 'Student', '0', '2024-12-08 13:31:59', '2024-12-08 13:31:59'),
(289, 64, 'Alejandra Villanueva', 15, 59, 1, NULL, NULL, '2024-12-08 13:31:59', '2024-12-08 13:31:59'),
(290, 64, 'Ethan Villanueva', 1, 6, 1, 'Student', '0', '2024-12-08 13:31:59', '2024-12-08 13:31:59'),
(291, 64, 'Tyson Villanueva', 15, 65, 4, NULL, NULL, '2024-12-08 13:31:59', '2024-12-08 13:31:59'),
(292, 64, 'Jerome Villanueva', 5, 48, 3, NULL, NULL, '2024-12-08 13:31:59', '2024-12-08 13:31:59'),
(293, 64, 'Madisen Villanueva', 12, 76, 3, NULL, NULL, '2024-12-08 13:31:59', '2024-12-08 13:31:59'),
(294, 65, 'Elias Santos', 9, 8, 1, 'Student', '0', '2024-12-08 13:31:59', '2024-12-08 13:31:59'),
(295, 65, 'Maia Santos', 5, 55, 4, NULL, NULL, '2024-12-08 13:32:00', '2024-12-08 13:32:00'),
(296, 65, 'Amiya Santos', 1, 4, 1, 'Student', '0', '2024-12-08 13:32:00', '2024-12-08 13:32:00'),
(297, 66, 'Marlen Delos Reyes', 3, 89, 2, NULL, NULL, '2024-12-08 13:32:00', '2024-12-08 13:32:00'),
(298, 66, 'Adrian Delos Reyes', 16, 11, 1, 'Student', '0', '2024-12-08 13:32:00', '2024-12-08 13:32:00'),
(299, 66, 'Lilla Delos Reyes', 3, 55, 1, NULL, NULL, '2024-12-08 13:32:00', '2024-12-08 13:32:00'),
(300, 66, 'Clarabelle Delos Reyes', 7, 53, 1, NULL, NULL, '2024-12-08 13:32:00', '2024-12-08 13:32:00'),
(301, 67, 'Gianni Salinas', 16, 5, 1, 'Student', '0', '2024-12-08 13:32:00', '2024-12-08 13:32:00'),
(302, 68, 'Alec Flores', 14, 76, 2, NULL, NULL, '2024-12-08 13:32:00', '2024-12-08 13:32:00'),
(303, 68, 'Marielle Flores', 7, 38, 3, NULL, NULL, '2024-12-08 13:32:00', '2024-12-08 13:32:00'),
(304, 69, 'Edwin Garcia', 4, 87, 4, NULL, NULL, '2024-12-08 13:32:00', '2024-12-08 13:32:00'),
(305, 69, 'Ayana Garcia', 1, 10, 1, 'Student', '0', '2024-12-08 13:32:00', '2024-12-08 13:32:00'),
(306, 69, 'Magnolia Garcia', 1, 5, 1, 'Student', '0', '2024-12-08 13:32:00', '2024-12-08 13:32:00'),
(307, 69, 'Lea Garcia', 10, 64, 4, NULL, NULL, '2024-12-08 13:32:00', '2024-12-08 13:32:00'),
(308, 69, 'Idell Garcia', 10, 56, 4, NULL, NULL, '2024-12-08 13:32:00', '2024-12-08 13:32:00'),
(309, 70, 'Kaela Arroyo', 11, 77, 4, NULL, NULL, '2024-12-08 13:32:00', '2024-12-08 13:32:00'),
(310, 70, 'Justyn Arroyo', 6, 46, 1, NULL, NULL, '2024-12-08 13:32:00', '2024-12-08 13:32:00'),
(311, 70, 'Alessandro Arroyo', 14, 79, 3, NULL, NULL, '2024-12-08 13:32:00', '2024-12-08 13:32:00'),
(312, 70, 'Audrey Arroyo', 9, 32, 4, 'Mechanic', '33713', '2024-12-08 13:32:00', '2024-12-08 13:32:00'),
(313, 70, 'Lula Arroyo', 5, 66, 4, 'Consultant', '52086', '2024-12-08 13:32:01', '2024-12-08 13:32:01'),
(314, 70, 'Soledad Arroyo', 12, 44, 4, NULL, NULL, '2024-12-08 13:32:01', '2024-12-08 13:32:01'),
(315, 70, 'Peggie Arroyo', 18, 10, 1, 'Student', '0', '2024-12-08 13:32:01', '2024-12-08 13:32:01'),
(316, 71, 'Milton Zaragoza', 5, 55, 1, 'Chef', '28725', '2024-12-08 13:32:01', '2024-12-08 13:32:01'),
(317, 71, 'Yazmin Zaragoza', 4, 69, 4, NULL, NULL, '2024-12-08 13:32:01', '2024-12-08 13:32:01'),
(318, 71, 'Edyth Zaragoza', 13, 41, 3, NULL, NULL, '2024-12-08 13:32:01', '2024-12-08 13:32:01'),
(319, 72, 'Alysa Gumabay', 6, 47, 1, NULL, NULL, '2024-12-08 13:32:01', '2024-12-08 13:32:01'),
(320, 73, 'Everett Cruzado', 18, 32, 2, NULL, NULL, '2024-12-08 13:32:01', '2024-12-08 13:32:01'),
(321, 73, 'Clovis Cruzado', 6, 46, 1, NULL, NULL, '2024-12-08 13:32:01', '2024-12-08 13:32:01'),
(322, 73, 'Anya Cruzado', 13, 56, 3, 'Designer', '45369', '2024-12-08 13:32:01', '2024-12-08 13:32:01'),
(323, 73, 'Jacklyn Cruzado', 11, 68, 2, NULL, NULL, '2024-12-08 13:32:01', '2024-12-08 13:32:01'),
(324, 73, 'Mertie Cruzado', 4, 38, 1, NULL, NULL, '2024-12-08 13:32:01', '2024-12-08 13:32:01'),
(325, 74, 'Jayda Cabarroguis', 16, 17, 1, 'Student', '0', '2024-12-08 13:32:01', '2024-12-08 13:32:01'),
(326, 75, 'Ella López', 5, 76, 4, 'Retired', '0', '2024-12-08 13:32:01', '2024-12-08 13:32:01'),
(327, 75, 'Jaida López', 4, 70, 2, NULL, NULL, '2024-12-08 13:32:02', '2024-12-08 13:32:02'),
(328, 75, 'Kareem López', 1, 29, 4, 'Graphic Designer', '20009', '2024-12-08 13:32:02', '2024-12-08 13:32:02'),
(329, 75, 'Kiley López', 11, 80, 2, NULL, NULL, '2024-12-08 13:32:02', '2024-12-08 13:32:02'),
(330, 76, 'Agnes Alvarez', 2, 23, 1, 'Salesperson', '26508', '2024-12-08 13:32:02', '2024-12-08 13:32:02'),
(331, 76, 'Katheryn Alvarez', 8, 3, 1, 'Student', '0', '2024-12-08 13:32:02', '2024-12-08 13:32:02'),
(332, 76, 'Henry Alvarez', 3, 80, 4, NULL, NULL, '2024-12-08 13:32:02', '2024-12-08 13:32:02'),
(333, 76, 'Lionel Alvarez', 7, 32, 1, NULL, NULL, '2024-12-08 13:32:03', '2024-12-08 13:32:03'),
(334, 77, 'Russel Nieves', 15, 79, 2, NULL, NULL, '2024-12-08 13:32:04', '2024-12-08 13:32:04'),
(335, 77, 'Liam Nieves', 5, 80, 2, NULL, NULL, '2024-12-08 13:32:04', '2024-12-08 13:32:04'),
(336, 77, 'Eva Nieves', 16, 1, 1, 'Student', '0', '2024-12-08 13:32:04', '2024-12-08 13:32:04'),
(337, 77, 'Ewell Nieves', 4, 70, 4, 'Consultant', '92270', '2024-12-08 13:32:05', '2024-12-08 13:32:05'),
(338, 78, 'Kristina Pineda', 15, 47, 2, NULL, NULL, '2024-12-08 13:32:05', '2024-12-08 13:32:05'),
(339, 78, 'Fannie Pineda', 10, 65, 2, NULL, NULL, '2024-12-08 13:32:05', '2024-12-08 13:32:05'),
(340, 79, 'Nelda Tonio', 9, 12, 1, 'Student', '0', '2024-12-08 13:32:05', '2024-12-08 13:32:05'),
(341, 79, 'Dexter Tonio', 6, 35, 1, 'Dentist', '55533', '2024-12-08 13:32:05', '2024-12-08 13:32:05'),
(342, 79, 'Vernice Tonio', 8, 39, 3, NULL, NULL, '2024-12-08 13:32:05', '2024-12-08 13:32:05'),
(343, 79, 'Kaela Tonio', 16, 14, 1, 'Student', '0', '2024-12-08 13:32:05', '2024-12-08 13:32:05'),
(344, 79, 'Danial Tonio', 18, 47, 4, 'Mechanic', '17774', '2024-12-08 13:32:05', '2024-12-08 13:32:05'),
(345, 79, 'Vicky Tonio', 2, 21, 3, NULL, NULL, '2024-12-08 13:32:05', '2024-12-08 13:32:05'),
(346, 79, 'Dayana Tonio', 10, 78, 4, NULL, NULL, '2024-12-08 13:32:05', '2024-12-08 13:32:05'),
(347, 79, 'Shany Tonio', 13, 46, 2, 'Artist', '27251', '2024-12-08 13:32:05', '2024-12-08 13:32:05'),
(348, 79, 'Birdie Tonio', 5, 86, 3, 'Consultant', '40807', '2024-12-08 13:32:05', '2024-12-08 13:32:05'),
(349, 80, 'Jadyn Villafuerte', 16, 4, 1, 'Student', '0', '2024-12-08 13:32:05', '2024-12-08 13:32:05'),
(350, 80, 'Carey Villafuerte', 1, 18, 2, 'Photographer', '11912', '2024-12-08 13:32:05', '2024-12-08 13:32:05'),
(351, 80, 'Willard Villafuerte', 17, 98, 2, NULL, NULL, '2024-12-08 13:32:05', '2024-12-08 13:32:05'),
(352, 80, 'Chanel Villafuerte', 5, 39, 1, NULL, NULL, '2024-12-08 13:32:05', '2024-12-08 13:32:05'),
(353, 80, 'Macie Villafuerte', 13, 75, 2, 'Retired', '0', '2024-12-08 13:32:05', '2024-12-08 13:32:05'),
(354, 80, 'Van Villafuerte', 15, 71, 3, NULL, NULL, '2024-12-08 13:32:05', '2024-12-08 13:32:05'),
(355, 80, 'Cory Villafuerte', 7, 79, 2, NULL, NULL, '2024-12-08 13:32:06', '2024-12-08 13:32:06'),
(356, 81, 'Doris De la Vega', 11, 94, 4, NULL, NULL, '2024-12-08 13:32:06', '2024-12-08 13:32:06'),
(357, 81, 'Ardith De la Vega', 5, 79, 4, 'Retired', '0', '2024-12-08 13:32:06', '2024-12-08 13:32:06'),
(358, 81, 'Roosevelt De la Vega', 16, 8, 1, 'Student', '0', '2024-12-08 13:32:06', '2024-12-08 13:32:06'),
(359, 81, 'Jewel De la Vega', 15, 46, 2, NULL, NULL, '2024-12-08 13:32:06', '2024-12-08 13:32:06'),
(360, 81, 'Daphne De la Vega', 5, 89, 4, NULL, NULL, '2024-12-08 13:32:06', '2024-12-08 13:32:06'),
(361, 81, 'D\'angelo De la Vega', 12, 67, 2, NULL, NULL, '2024-12-08 13:32:06', '2024-12-08 13:32:06'),
(362, 81, 'Shanelle De la Vega', 18, 48, 2, NULL, NULL, '2024-12-08 13:32:06', '2024-12-08 13:32:06'),
(363, 82, 'Yazmin De Guzman', 10, 10, 1, 'Student', '0', '2024-12-08 13:32:06', '2024-12-08 13:32:06'),
(364, 82, 'Brandy De Guzman', 14, 57, 2, 'Doctor', '68034', '2024-12-08 13:32:06', '2024-12-08 13:32:06'),
(365, 82, 'Henry De Guzman', 17, 90, 3, NULL, NULL, '2024-12-08 13:32:06', '2024-12-08 13:32:06'),
(366, 82, 'Nestor De Guzman', 18, 66, 4, NULL, NULL, '2024-12-08 13:32:06', '2024-12-08 13:32:06'),
(367, 83, 'Avis Magsaysay', 3, 76, 2, NULL, NULL, '2024-12-08 13:32:06', '2024-12-08 13:32:06'),
(368, 83, 'Cristopher Magsaysay', 4, 37, 2, 'Farmer', '10894', '2024-12-08 13:32:06', '2024-12-08 13:32:06'),
(369, 83, 'Pinkie Magsaysay', 15, 46, 4, 'Bus Driver', '24714', '2024-12-08 13:32:06', '2024-12-08 13:32:06'),
(370, 83, 'Serenity Magsaysay', 15, 41, 3, NULL, NULL, '2024-12-08 13:32:07', '2024-12-08 13:32:07'),
(371, 83, 'Boris Magsaysay', 1, 13, 1, 'Student', '0', '2024-12-08 13:32:07', '2024-12-08 13:32:07'),
(372, 83, 'Abbigail Magsaysay', 1, 24, 2, 'Content Creator', '16602', '2024-12-08 13:32:07', '2024-12-08 13:32:07'),
(373, 83, 'Alexzander Magsaysay', 7, 63, 3, NULL, NULL, '2024-12-08 13:32:07', '2024-12-08 13:32:07'),
(374, 84, 'Willis Cruzado', 9, 38, 4, 'Writer', '22994', '2024-12-08 13:32:07', '2024-12-08 13:32:07'),
(375, 84, 'Brittany Cruzado', 7, 65, 4, NULL, NULL, '2024-12-08 13:32:07', '2024-12-08 13:32:07'),
(376, 84, 'Haylie Cruzado', 9, 24, 4, 'Intern', '13638', '2024-12-08 13:32:07', '2024-12-08 13:32:07'),
(377, 85, 'Della Morales', 15, 69, 3, NULL, NULL, '2024-12-08 13:32:07', '2024-12-08 13:32:07'),
(378, 85, 'Carolanne Morales', 9, 9, 1, 'Student', '0', '2024-12-08 13:32:07', '2024-12-08 13:32:07'),
(379, 85, 'Wiley Morales', 16, 29, 2, 'Content Creator', '24197', '2024-12-08 13:32:07', '2024-12-08 13:32:07'),
(380, 85, 'Josefa Morales', 8, 10, 1, 'Student', '0', '2024-12-08 13:32:07', '2024-12-08 13:32:07'),
(381, 86, 'Kaitlyn Ramos', 10, 49, 2, NULL, NULL, '2024-12-08 13:32:07', '2024-12-08 13:32:07'),
(382, 86, 'Otto Ramos', 5, 36, 1, NULL, NULL, '2024-12-08 13:32:07', '2024-12-08 13:32:07'),
(383, 86, 'Caleb Ramos', 8, 17, 1, 'Student', '0', '2024-12-08 13:32:07', '2024-12-08 13:32:07'),
(384, 86, 'Madyson Ramos', 2, 22, 2, 'Photographer', '24419', '2024-12-08 13:32:07', '2024-12-08 13:32:07'),
(385, 86, 'Lexus Ramos', 1, 11, 1, 'Student', '0', '2024-12-08 13:32:08', '2024-12-08 13:32:08'),
(386, 87, 'Johann Salvador', 11, 70, 2, 'Retired', '0', '2024-12-08 13:32:08', '2024-12-08 13:32:08'),
(387, 87, 'Mohammad Salvador', 5, 53, 1, 'Designer', '20596', '2024-12-08 13:32:08', '2024-12-08 13:32:08'),
(388, 87, 'Cassandre Salvador', 12, 44, 3, 'Writer', '19434', '2024-12-08 13:32:08', '2024-12-08 13:32:08'),
(389, 87, 'Hugh Salvador', 16, 29, 1, NULL, NULL, '2024-12-08 13:32:08', '2024-12-08 13:32:08'),
(390, 87, 'Blaze Salvador', 8, 34, 4, 'Freelancer', '43531', '2024-12-08 13:32:08', '2024-12-08 13:32:08'),
(391, 87, 'Lisandro Salvador', 9, 35, 1, 'Artist', '30959', '2024-12-08 13:32:08', '2024-12-08 13:32:08'),
(392, 87, 'Keven Salvador', 10, 20, 3, NULL, NULL, '2024-12-08 13:32:08', '2024-12-08 13:32:08'),
(393, 88, 'Deonte Castillo', 17, 51, 3, NULL, NULL, '2024-12-08 13:32:08', '2024-12-08 13:32:08'),
(394, 88, 'Marcel Castillo', 3, 66, 2, NULL, NULL, '2024-12-08 13:32:08', '2024-12-08 13:32:08'),
(395, 88, 'Oswald Castillo', 7, 52, 1, 'Salesperson', '12709', '2024-12-08 13:32:08', '2024-12-08 13:32:08'),
(396, 89, 'Bertrand Riviera', 13, 79, 3, NULL, NULL, '2024-12-08 13:32:08', '2024-12-08 13:32:08'),
(397, 89, 'Dante Riviera', 3, 62, 3, NULL, NULL, '2024-12-08 13:32:09', '2024-12-08 13:32:09'),
(398, 90, 'Adelbert De la Rosa', 6, 75, 2, NULL, NULL, '2024-12-08 13:32:10', '2024-12-08 13:32:10'),
(399, 91, 'Osbaldo Cruz', 12, 86, 3, NULL, NULL, '2024-12-08 13:32:10', '2024-12-08 13:32:10'),
(400, 91, 'Chaya Cruz', 2, 10, 1, 'Student', '0', '2024-12-08 13:32:10', '2024-12-08 13:32:10'),
(401, 91, 'Ansel Cruz', 17, 98, 4, NULL, NULL, '2024-12-08 13:32:10', '2024-12-08 13:32:10'),
(402, 91, 'Caden Cruz', 15, 72, 4, NULL, NULL, '2024-12-08 13:32:10', '2024-12-08 13:32:10'),
(403, 91, 'Helga Cruz', 13, 56, 2, 'Retired', '0', '2024-12-08 13:32:10', '2024-12-08 13:32:10'),
(404, 91, 'Ricardo Cruz', 17, 46, 1, 'Artist', '23609', '2024-12-08 13:32:10', '2024-12-08 13:32:10'),
(405, 91, 'Garrison Cruz', 14, 67, 3, NULL, NULL, '2024-12-08 13:32:10', '2024-12-08 13:32:10'),
(406, 91, 'Maynard Cruz', 4, 73, 3, NULL, NULL, '2024-12-08 13:32:10', '2024-12-08 13:32:10'),
(407, 91, 'Jaclyn Cruz', 7, 74, 2, NULL, NULL, '2024-12-08 13:32:10', '2024-12-08 13:32:10'),
(408, 91, 'Damian Cruz', 8, 24, 1, NULL, NULL, '2024-12-08 13:32:10', '2024-12-08 13:32:10'),
(409, 92, 'Jamar Dela Cruz', 2, 23, 3, NULL, NULL, '2024-12-08 13:32:10', '2024-12-08 13:32:10'),
(410, 92, 'Naomi Dela Cruz', 11, 93, 2, NULL, NULL, '2024-12-08 13:32:10', '2024-12-08 13:32:10'),
(411, 92, 'Hayley Dela Cruz', 16, 1, 1, 'Student', '0', '2024-12-08 13:32:10', '2024-12-08 13:32:10'),
(412, 93, 'Abigayle Gumabay', 16, 10, 1, 'Student', '0', '2024-12-08 13:32:10', '2024-12-08 13:32:10'),
(413, 93, 'Chadrick Gumabay', 9, 14, 1, 'Student', '0', '2024-12-08 13:32:10', '2024-12-08 13:32:10'),
(414, 93, 'Houston Gumabay', 3, 86, 4, NULL, NULL, '2024-12-08 13:32:11', '2024-12-08 13:32:11'),
(415, 94, 'Haley Alcaraz', 18, 25, 2, 'Virtual Assistant', '20708', '2024-12-08 13:32:11', '2024-12-08 13:32:11'),
(416, 94, 'Danielle Alcaraz', 10, 40, 2, 'Musician', '22450', '2024-12-08 13:32:11', '2024-12-08 13:32:11'),
(417, 94, 'Daren Alcaraz', 18, 50, 1, 'Retail Worker', '12117', '2024-12-08 13:32:11', '2024-12-08 13:32:11'),
(418, 94, 'Wilma Alcaraz', 4, 49, 3, NULL, NULL, '2024-12-08 13:32:11', '2024-12-08 13:32:11'),
(419, 94, 'Ransom Alcaraz', 15, 38, 3, NULL, NULL, '2024-12-08 13:32:11', '2024-12-08 13:32:11'),
(420, 94, 'Hailey Alcaraz', 8, 6, 1, 'Student', '0', '2024-12-08 13:32:11', '2024-12-08 13:32:11'),
(421, 94, 'Trevor Alcaraz', 2, 8, 1, 'Student', '0', '2024-12-08 13:32:11', '2024-12-08 13:32:11'),
(422, 94, 'Douglas Alcaraz', 16, 22, 4, 'Graphic Designer', '28862', '2024-12-08 13:32:11', '2024-12-08 13:32:11'),
(423, 94, 'Estell Alcaraz', 9, 11, 1, 'Student', '0', '2024-12-08 13:32:11', '2024-12-08 13:32:11'),
(424, 95, 'Brandyn López', 10, 39, 3, NULL, NULL, '2024-12-08 13:32:11', '2024-12-08 13:32:11'),
(425, 95, 'Freda López', 17, 32, 1, NULL, NULL, '2024-12-08 13:32:11', '2024-12-08 13:32:11'),
(426, 95, 'Burdette López', 6, 43, 2, NULL, NULL, '2024-12-08 13:32:11', '2024-12-08 13:32:11'),
(427, 95, 'Makayla López', 10, 24, 3, 'Content Creator', '21221', '2024-12-08 13:32:11', '2024-12-08 13:32:11'),
(428, 95, 'Merlin López', 18, 11, 1, 'Student', '0', '2024-12-08 13:32:11', '2024-12-08 13:32:11'),
(429, 95, 'Alessandro López', 3, 63, 4, NULL, NULL, '2024-12-08 13:32:11', '2024-12-08 13:32:11'),
(430, 95, 'Lurline López', 15, 68, 2, NULL, NULL, '2024-12-08 13:32:12', '2024-12-08 13:32:12'),
(431, 95, 'Jaqueline López', 5, 88, 2, NULL, NULL, '2024-12-08 13:32:12', '2024-12-08 13:32:12'),
(432, 95, 'Branson López', 2, 16, 1, 'Student', '0', '2024-12-08 13:32:12', '2024-12-08 13:32:12'),
(433, 96, 'Orpha Gumabay', 12, 40, 3, 'Junior Developer', '16265', '2024-12-08 13:32:12', '2024-12-08 13:32:12'),
(434, 96, 'Filiberto Gumabay', 14, 72, 2, NULL, NULL, '2024-12-08 13:32:12', '2024-12-08 13:32:12'),
(435, 96, 'Jakayla Gumabay', 16, 27, 2, 'Social Media Manager', '36622', '2024-12-08 13:32:12', '2024-12-08 13:32:12'),
(436, 96, 'Gene Gumabay', 16, 2, 1, 'Student', '0', '2024-12-08 13:32:12', '2024-12-08 13:32:12'),
(437, 96, 'Marcelo Gumabay', 1, 27, 1, 'Photographer', '18625', '2024-12-08 13:32:12', '2024-12-08 13:32:12'),
(438, 96, 'Elfrieda Gumabay', 3, 72, 3, NULL, NULL, '2024-12-08 13:32:12', '2024-12-08 13:32:12'),
(439, 96, 'Lyla Gumabay', 9, 2, 1, 'Student', '0', '2024-12-08 13:32:12', '2024-12-08 13:32:12'),
(440, 96, 'Obie Gumabay', 9, 36, 4, NULL, NULL, '2024-12-08 13:32:12', '2024-12-08 13:32:12'),
(441, 96, 'Kacie Gumabay', 15, 64, 2, 'Retired', '0', '2024-12-08 13:32:12', '2024-12-08 13:32:12'),
(442, 96, 'Mckenzie Gumabay', 14, 73, 3, 'Retired', '0', '2024-12-08 13:32:12', '2024-12-08 13:32:12'),
(443, 97, 'Davion Nieves', 5, 55, 3, NULL, NULL, '2024-12-08 13:32:13', '2024-12-08 13:32:13'),
(444, 97, 'Evan Nieves', 14, 71, 2, 'Retired', '0', '2024-12-08 13:32:13', '2024-12-08 13:32:13'),
(445, 97, 'Javon Nieves', 2, 2, 1, 'Student', '0', '2024-12-08 13:32:13', '2024-12-08 13:32:13'),
(446, 97, 'Camden Nieves', 13, 86, 3, NULL, NULL, '2024-12-08 13:32:13', '2024-12-08 13:32:13'),
(447, 97, 'Hadley Nieves', 9, 18, 3, 'Photographer', '17956', '2024-12-08 13:32:13', '2024-12-08 13:32:13'),
(448, 98, 'Kaycee Aquino', 3, 59, 2, NULL, NULL, '2024-12-08 13:32:13', '2024-12-08 13:32:13'),
(449, 98, 'Immanuel Aquino', 11, 97, 2, NULL, NULL, '2024-12-08 13:32:13', '2024-12-08 13:32:13'),
(450, 99, 'Frederik Cabigon', 1, 12, 1, 'Student', '0', '2024-12-08 13:32:13', '2024-12-08 13:32:13'),
(451, 99, 'Era Cabigon', 11, 74, 2, NULL, NULL, '2024-12-08 13:32:13', '2024-12-08 13:32:13'),
(452, 99, 'Oliver Cabigon', 12, 47, 3, NULL, NULL, '2024-12-08 13:32:13', '2024-12-08 13:32:13'),
(453, 99, 'Queenie Cabigon', 9, 30, 3, 'Pilot', '53318', '2024-12-08 13:32:13', '2024-12-08 13:32:13'),
(454, 99, 'Jennie Cabigon', 18, 29, 1, 'Graphic Designer', '27205', '2024-12-08 13:32:13', '2024-12-08 13:32:13'),
(455, 99, 'Linda Cabigon', 14, 74, 3, NULL, NULL, '2024-12-08 13:32:13', '2024-12-08 13:32:13'),
(456, 100, 'Zackery Santiago', 10, 42, 2, NULL, NULL, '2024-12-08 13:32:13', '2024-12-08 13:32:13'),
(457, 100, 'Joy Santiago', 10, 12, 1, 'Student', '0', '2024-12-08 13:32:13', '2024-12-08 13:32:13'),
(458, 100, 'Aaron Santiago', 6, 62, 4, NULL, NULL, '2024-12-08 13:32:14', '2024-12-08 13:32:14'),
(459, 100, 'Brandi Santiago', 16, 14, 1, 'Student', '0', '2024-12-08 13:32:14', '2024-12-08 13:32:14'),
(460, 101, 'Lonnie Riviera', 6, 68, 2, NULL, NULL, '2024-12-08 13:32:14', '2024-12-08 13:32:14'),
(461, 101, 'Lura Riviera', 10, 72, 4, NULL, NULL, '2024-12-08 13:32:14', '2024-12-08 13:32:14'),
(462, 101, 'Justine Riviera', 13, 42, 1, NULL, NULL, '2024-12-08 13:32:14', '2024-12-08 13:32:14'),
(463, 102, 'Graciela Misa', 11, 98, 2, 'Retired', '0', '2024-12-08 13:32:14', '2024-12-08 13:32:14'),
(464, 102, 'Jaquan Misa', 13, 85, 4, 'Consultant', '81069', '2024-12-08 13:32:14', '2024-12-08 13:32:14'),
(465, 102, 'Kamille Misa', 3, 79, 3, NULL, NULL, '2024-12-08 13:32:14', '2024-12-08 13:32:14'),
(466, 103, 'Joana Martinez', 10, 17, 1, 'Student', '0', '2024-12-08 13:32:14', '2024-12-08 13:32:14'),
(467, 103, 'Andrew Martinez', 3, 55, 3, 'Lawyer', '79799', '2024-12-08 13:32:14', '2024-12-08 13:32:14'),
(468, 103, 'Estel Martinez', 5, 83, 3, 'Consultant', '83821', '2024-12-08 13:32:14', '2024-12-08 13:32:14'),
(469, 103, 'Imani Martinez', 18, 66, 2, NULL, NULL, '2024-12-08 13:32:14', '2024-12-08 13:32:14'),
(470, 103, 'Jefferey Martinez', 18, 8, 1, 'Student', '0', '2024-12-08 13:32:14', '2024-12-08 13:32:14'),
(471, 103, 'Dock Martinez', 17, 77, 3, NULL, NULL, '2024-12-08 13:32:14', '2024-12-08 13:32:14'),
(472, 103, 'Jayda Martinez', 2, 8, 1, 'Student', '0', '2024-12-08 13:32:15', '2024-12-08 13:32:15'),
(473, 104, 'Norbert Cruzado', 11, 72, 3, NULL, NULL, '2024-12-08 13:32:16', '2024-12-08 13:32:16'),
(474, 104, 'Lila Cruzado', 14, 75, 4, NULL, NULL, '2024-12-08 13:32:16', '2024-12-08 13:32:16'),
(475, 104, 'Arden Cruzado', 2, 17, 1, 'Student', '0', '2024-12-08 13:32:16', '2024-12-08 13:32:16'),
(476, 104, 'Elenora Cruzado', 4, 61, 2, NULL, NULL, '2024-12-08 13:32:16', '2024-12-08 13:32:16'),
(477, 104, 'Triston Cruzado', 17, 92, 4, NULL, NULL, '2024-12-08 13:32:16', '2024-12-08 13:32:16'),
(478, 104, 'Tillman Cruzado', 17, 31, 1, 'Doctor', '97646', '2024-12-08 13:32:16', '2024-12-08 13:32:16'),
(479, 104, 'Marshall Cruzado', 13, 52, 3, NULL, NULL, '2024-12-08 13:32:16', '2024-12-08 13:32:16'),
(480, 104, 'Frieda Cruzado', 13, 59, 1, 'Doctor', '113970', '2024-12-08 13:32:16', '2024-12-08 13:32:16'),
(481, 104, 'Bessie Cruzado', 5, 48, 2, NULL, NULL, '2024-12-08 13:32:16', '2024-12-08 13:32:16'),
(482, 104, 'Aniyah Cruzado', 3, 85, 4, NULL, NULL, '2024-12-08 13:32:16', '2024-12-08 13:32:16'),
(483, 105, 'Aimee Bañez', 3, 39, 3, NULL, NULL, '2024-12-08 13:32:16', '2024-12-08 13:32:16'),
(484, 105, 'Hans Bañez', 4, 82, 2, NULL, NULL, '2024-12-08 13:32:16', '2024-12-08 13:32:16'),
(485, 105, 'Princess Bañez', 8, 32, 4, 'Construction Worker', '15999', '2024-12-08 13:32:16', '2024-12-08 13:32:16'),
(486, 105, 'Calista Bañez', 16, 30, 1, NULL, NULL, '2024-12-08 13:32:17', '2024-12-08 13:32:17'),
(487, 105, 'Marley Bañez', 9, 13, 1, 'Student', '0', '2024-12-08 13:32:17', '2024-12-08 13:32:17'),
(488, 105, 'Amir Bañez', 17, 31, 4, NULL, NULL, '2024-12-08 13:32:17', '2024-12-08 13:32:17'),
(489, 105, 'Jammie Bañez', 14, 74, 3, NULL, NULL, '2024-12-08 13:32:17', '2024-12-08 13:32:17'),
(490, 105, 'Jarrod Bañez', 6, 63, 4, NULL, NULL, '2024-12-08 13:32:17', '2024-12-08 13:32:17'),
(491, 106, 'Brandt López', 6, 46, 1, NULL, NULL, '2024-12-08 13:32:17', '2024-12-08 13:32:17'),
(492, 106, 'Allie López', 5, 38, 2, 'Junior Developer', '21146', '2024-12-08 13:32:17', '2024-12-08 13:32:17'),
(493, 106, 'Donna López', 7, 38, 2, 'Content Creator', '11921', '2024-12-08 13:32:17', '2024-12-08 13:32:17'),
(494, 106, 'Carlotta López', 3, 55, 3, 'Accountant', '38885', '2024-12-08 13:32:17', '2024-12-08 13:32:17'),
(495, 106, 'Elnora López', 5, 83, 2, NULL, NULL, '2024-12-08 13:32:17', '2024-12-08 13:32:17'),
(496, 107, 'Constance De Leon', 8, 13, 1, 'Student', '0', '2024-12-08 13:32:17', '2024-12-08 13:32:17'),
(497, 107, 'Rosamond De Leon', 9, 12, 1, 'Student', '0', '2024-12-08 13:32:17', '2024-12-08 13:32:17'),
(498, 107, 'Sid De Leon', 16, 16, 1, 'Student', '0', '2024-12-08 13:32:17', '2024-12-08 13:32:17');
INSERT INTO `family_composition` (`id`, `senior_id`, `relative_name`, `relative_relationship_id`, `relative_age`, `relative_civil_status_id`, `relative_occupation`, `relative_income`, `created_at`, `updated_at`) VALUES
(499, 107, 'Jared De Leon', 8, 12, 1, 'Student', '0', '2024-12-08 13:32:17', '2024-12-08 13:32:17'),
(500, 107, 'Dominic De Leon', 8, 7, 1, 'Student', '0', '2024-12-08 13:32:18', '2024-12-08 13:32:18'),
(501, 107, 'Loma De Leon', 7, 67, 4, 'Consultant', '53132', '2024-12-08 13:32:18', '2024-12-08 13:32:18'),
(502, 107, 'Dagmar De Leon', 16, 12, 1, 'Student', '0', '2024-12-08 13:32:18', '2024-12-08 13:32:18'),
(503, 107, 'Elsa De Leon', 9, 11, 1, 'Student', '0', '2024-12-08 13:32:18', '2024-12-08 13:32:18'),
(504, 108, 'Brook Palomares', 10, 78, 2, 'Consultant', '73890', '2024-12-08 13:32:18', '2024-12-08 13:32:18'),
(505, 108, 'Ericka Palomares', 8, 25, 3, NULL, NULL, '2024-12-08 13:32:18', '2024-12-08 13:32:18'),
(506, 108, 'Aglae Palomares', 10, 65, 3, 'Consultant', '51861', '2024-12-08 13:32:18', '2024-12-08 13:32:18'),
(507, 108, 'Jody Palomares', 16, 12, 1, 'Student', '0', '2024-12-08 13:32:18', '2024-12-08 13:32:18'),
(508, 108, 'Stephon Palomares', 10, 73, 2, NULL, NULL, '2024-12-08 13:32:18', '2024-12-08 13:32:18'),
(509, 109, 'Sylvan Cruz', 4, 55, 2, NULL, NULL, '2024-12-08 13:32:18', '2024-12-08 13:32:18'),
(510, 109, 'Allie Cruz', 8, 26, 2, 'Photographer', '23987', '2024-12-08 13:32:18', '2024-12-08 13:32:18'),
(511, 109, 'Roberto Cruz', 4, 89, 2, 'Consultant', '43896', '2024-12-08 13:32:18', '2024-12-08 13:32:18'),
(512, 109, 'Maryjane Cruz', 13, 66, 2, 'Consultant', '52569', '2024-12-08 13:32:18', '2024-12-08 13:32:18'),
(513, 109, 'Buddy Cruz', 11, 67, 2, 'Retired', '0', '2024-12-08 13:32:18', '2024-12-08 13:32:18'),
(514, 110, 'Meggie Martelino', 14, 49, 1, NULL, NULL, '2024-12-08 13:32:18', '2024-12-08 13:32:18'),
(515, 110, 'Carmen Martelino', 8, 27, 1, 'Freelancer', '45348', '2024-12-08 13:32:18', '2024-12-08 13:32:18'),
(516, 110, 'Lester Martelino', 2, 11, 1, 'Student', '0', '2024-12-08 13:32:18', '2024-12-08 13:32:18'),
(517, 110, 'Javon Martelino', 11, 88, 4, NULL, NULL, '2024-12-08 13:32:19', '2024-12-08 13:32:19'),
(518, 110, 'Dock Martelino', 16, 15, 1, 'Student', '0', '2024-12-08 13:32:19', '2024-12-08 13:32:19'),
(519, 110, 'Tiana Martelino', 9, 1, 1, 'Student', '0', '2024-12-08 13:32:19', '2024-12-08 13:32:19'),
(520, 111, 'Colin De Jesus', 6, 72, 2, NULL, NULL, '2024-12-08 13:32:19', '2024-12-08 13:32:19'),
(521, 111, 'Hudson De Jesus', 16, 3, 1, 'Student', '0', '2024-12-08 13:32:19', '2024-12-08 13:32:19'),
(522, 111, 'Bridie De Jesus', 14, 74, 2, NULL, NULL, '2024-12-08 13:32:19', '2024-12-08 13:32:19'),
(523, 111, 'Cali De Jesus', 9, 34, 3, NULL, NULL, '2024-12-08 13:32:19', '2024-12-08 13:32:19'),
(524, 111, 'Laurel De Jesus', 5, 99, 2, 'Consultant', '69738', '2024-12-08 13:32:19', '2024-12-08 13:32:19'),
(525, 111, 'Frances De Jesus', 3, 37, 1, 'Teacher', '26575', '2024-12-08 13:32:19', '2024-12-08 13:32:19'),
(526, 111, 'Mckayla De Jesus', 16, 30, 3, NULL, NULL, '2024-12-08 13:32:19', '2024-12-08 13:32:19'),
(527, 111, 'Selmer De Jesus', 5, 41, 1, NULL, NULL, '2024-12-08 13:32:19', '2024-12-08 13:32:19'),
(528, 112, 'Gerda Cortez', 10, 40, 3, NULL, NULL, '2024-12-08 13:32:19', '2024-12-08 13:32:19'),
(529, 112, 'Isai Cortez', 13, 49, 3, NULL, NULL, '2024-12-08 13:32:19', '2024-12-08 13:32:19'),
(530, 112, 'Marilyne Cortez', 2, 11, 1, 'Student', '0', '2024-12-08 13:32:19', '2024-12-08 13:32:19'),
(531, 112, 'Alexanne Cortez', 11, 91, 4, NULL, NULL, '2024-12-08 13:32:19', '2024-12-08 13:32:19'),
(532, 112, 'Hayden Cortez', 11, 70, 4, NULL, NULL, '2024-12-08 13:32:19', '2024-12-08 13:32:19'),
(533, 112, 'Samantha Cortez', 15, 50, 2, 'Farmer', '12288', '2024-12-08 13:32:20', '2024-12-08 13:32:20'),
(534, 112, 'Kristoffer Cortez', 17, 72, 4, 'Consultant', '70920', '2024-12-08 13:32:20', '2024-12-08 13:32:20'),
(535, 112, 'Amely Cortez', 9, 16, 1, 'Student', '0', '2024-12-08 13:32:20', '2024-12-08 13:32:20'),
(536, 113, 'Gregoria Reyes', 4, 30, 4, 'Intern', '5573', '2024-12-08 13:32:20', '2024-12-08 13:32:20'),
(537, 113, 'Kadin Reyes', 1, 19, 4, 'Freelancer', '13061', '2024-12-08 13:32:20', '2024-12-08 13:32:20'),
(538, 113, 'Muhammad Reyes', 11, 80, 3, NULL, NULL, '2024-12-08 13:32:20', '2024-12-08 13:32:20'),
(539, 114, 'Llewellyn Pascual', 12, 83, 2, 'Retired', '0', '2024-12-08 13:32:20', '2024-12-08 13:32:20'),
(540, 114, 'Vicenta Pascual', 1, 25, 1, 'Artist', '20571', '2024-12-08 13:32:20', '2024-12-08 13:32:20'),
(541, 115, 'Marjorie Lacuna', 2, 6, 1, 'Student', '0', '2024-12-08 13:32:20', '2024-12-08 13:32:20'),
(542, 115, 'Vida Lacuna', 17, 88, 3, 'Retired', '0', '2024-12-08 13:32:20', '2024-12-08 13:32:20'),
(543, 115, 'Twila Lacuna', 10, 78, 4, NULL, NULL, '2024-12-08 13:32:22', '2024-12-08 13:32:22'),
(544, 115, 'Kayley Lacuna', 17, 57, 4, 'Bus Driver', '16533', '2024-12-08 13:32:22', '2024-12-08 13:32:22'),
(545, 115, 'Bettie Lacuna', 8, 27, 1, NULL, NULL, '2024-12-08 13:32:22', '2024-12-08 13:32:22'),
(546, 115, 'Emiliano Lacuna', 4, 92, 2, NULL, NULL, '2024-12-08 13:32:22', '2024-12-08 13:32:22'),
(547, 115, 'Reynold Lacuna', 12, 42, 2, 'Junior Developer', '18403', '2024-12-08 13:32:22', '2024-12-08 13:32:22'),
(548, 115, 'Austen Lacuna', 2, 2, 1, 'Student', '0', '2024-12-08 13:32:22', '2024-12-08 13:32:22'),
(549, 115, 'Nicola Lacuna', 5, 39, 3, 'Retail Worker', '13465', '2024-12-08 13:32:22', '2024-12-08 13:32:22'),
(550, 116, 'Karlee Manalo', 8, 14, 1, 'Student', '0', '2024-12-08 13:32:22', '2024-12-08 13:32:22'),
(551, 116, 'Dorthy Manalo', 3, 33, 3, NULL, NULL, '2024-12-08 13:32:22', '2024-12-08 13:32:22'),
(552, 116, 'Leanne Manalo', 16, 27, 2, 'Photographer', '24516', '2024-12-08 13:32:22', '2024-12-08 13:32:22'),
(553, 116, 'Hector Manalo', 10, 45, 3, 'Dentist', '111491', '2024-12-08 13:32:22', '2024-12-08 13:32:22'),
(554, 116, 'Lizzie Manalo', 11, 84, 4, NULL, NULL, '2024-12-08 13:32:22', '2024-12-08 13:32:22'),
(555, 116, 'Talia Manalo', 15, 50, 2, 'Farmer', '9947', '2024-12-08 13:32:22', '2024-12-08 13:32:22'),
(556, 117, 'Dane Chua', 17, 42, 4, 'Nanny', '17105', '2024-12-08 13:32:22', '2024-12-08 13:32:22'),
(557, 117, 'Eduardo Chua', 4, 49, 3, 'Artist', '36369', '2024-12-08 13:32:23', '2024-12-08 13:32:23'),
(558, 117, 'Dulce Chua', 10, 76, 4, NULL, NULL, '2024-12-08 13:32:23', '2024-12-08 13:32:23'),
(559, 117, 'Nelda Chua', 10, 40, 3, 'Salesperson', '22220', '2024-12-08 13:32:23', '2024-12-08 13:32:23'),
(560, 117, 'Craig Chua', 11, 99, 3, NULL, NULL, '2024-12-08 13:32:23', '2024-12-08 13:32:23'),
(561, 117, 'Brionna Chua', 14, 35, 4, 'Teacher', '22128', '2024-12-08 13:32:23', '2024-12-08 13:32:23'),
(562, 118, 'Talia Misa', 18, 67, 2, NULL, NULL, '2024-12-08 13:32:23', '2024-12-08 13:32:23'),
(563, 118, 'Samson Misa', 7, 75, 3, NULL, NULL, '2024-12-08 13:32:23', '2024-12-08 13:32:23'),
(564, 118, 'Ross Misa', 18, 17, 1, 'Student', '0', '2024-12-08 13:32:23', '2024-12-08 13:32:23'),
(565, 118, 'Zachary Misa', 15, 47, 1, NULL, NULL, '2024-12-08 13:32:23', '2024-12-08 13:32:23'),
(566, 118, 'Emanuel Misa', 4, 88, 2, NULL, NULL, '2024-12-08 13:32:23', '2024-12-08 13:32:23'),
(567, 118, 'Nikko Misa', 16, 16, 1, 'Student', '0', '2024-12-08 13:32:23', '2024-12-08 13:32:23'),
(568, 118, 'Sandra Misa', 9, 14, 1, 'Student', '0', '2024-12-08 13:32:23', '2024-12-08 13:32:23'),
(569, 119, 'Russel Soriano', 4, 43, 1, NULL, NULL, '2024-12-08 13:32:23', '2024-12-08 13:32:23'),
(570, 119, 'Jaquan Soriano', 14, 67, 4, NULL, NULL, '2024-12-08 13:32:23', '2024-12-08 13:32:23'),
(571, 119, 'Ole Soriano', 5, 62, 3, NULL, NULL, '2024-12-08 13:32:23', '2024-12-08 13:32:23'),
(572, 120, 'Viviane Delos Reyes', 7, 77, 4, NULL, NULL, '2024-12-08 13:32:23', '2024-12-08 13:32:23'),
(573, 120, 'Jeanie Delos Reyes', 4, 79, 3, NULL, NULL, '2024-12-08 13:32:24', '2024-12-08 13:32:24'),
(574, 120, 'Marc Delos Reyes', 3, 66, 2, NULL, NULL, '2024-12-08 13:32:24', '2024-12-08 13:32:24'),
(575, 120, 'Jonas Delos Reyes', 15, 45, 4, NULL, NULL, '2024-12-08 13:32:24', '2024-12-08 13:32:24'),
(576, 120, 'Rachel Delos Reyes', 11, 92, 3, NULL, NULL, '2024-12-08 13:32:24', '2024-12-08 13:32:24'),
(577, 120, 'Gerson Delos Reyes', 8, 16, 1, 'Student', '0', '2024-12-08 13:32:24', '2024-12-08 13:32:24'),
(578, 120, 'Audra Delos Reyes', 3, 56, 2, NULL, NULL, '2024-12-08 13:32:24', '2024-12-08 13:32:24'),
(579, 121, 'Joseph Vera', 8, 37, 3, 'Artist', '19421', '2024-12-08 13:32:24', '2024-12-08 13:32:24'),
(580, 121, 'Kaycee Vera', 3, 79, 2, NULL, NULL, '2024-12-08 13:32:24', '2024-12-08 13:32:24'),
(581, 122, 'Jarrell Torres', 10, 49, 2, NULL, NULL, '2024-12-08 13:32:24', '2024-12-08 13:32:24'),
(582, 122, 'Warren Torres', 3, 48, 1, NULL, NULL, '2024-12-08 13:32:24', '2024-12-08 13:32:24'),
(583, 122, 'Francisco Torres', 12, 57, 3, NULL, NULL, '2024-12-08 13:32:24', '2024-12-08 13:32:24'),
(584, 122, 'Alden Torres', 8, 21, 2, NULL, NULL, '2024-12-08 13:32:24', '2024-12-08 13:32:24'),
(585, 123, 'Ubaldo Palomares', 13, 56, 4, 'Architect', '52115', '2024-12-08 13:32:25', '2024-12-08 13:32:25'),
(586, 123, 'Peter Palomares', 2, 30, 1, NULL, NULL, '2024-12-08 13:32:25', '2024-12-08 13:32:25'),
(587, 123, 'Nelson Palomares', 5, 39, 2, NULL, NULL, '2024-12-08 13:32:25', '2024-12-08 13:32:25'),
(588, 123, 'Jedediah Palomares', 8, 7, 1, 'Student', '0', '2024-12-08 13:32:25', '2024-12-08 13:32:25'),
(589, 123, 'Noble Palomares', 14, 37, 1, NULL, NULL, '2024-12-08 13:32:25', '2024-12-08 13:32:25'),
(590, 123, 'Herminia Palomares', 3, 56, 3, 'Retail Worker', '10754', '2024-12-08 13:32:25', '2024-12-08 13:32:25'),
(591, 124, 'Twila Atienza', 11, 98, 3, NULL, NULL, '2024-12-08 13:32:25', '2024-12-08 13:32:25'),
(592, 124, 'Valentina Atienza', 1, 26, 2, NULL, NULL, '2024-12-08 13:32:25', '2024-12-08 13:32:25'),
(593, 125, 'Adela Cabigon', 1, 11, 1, 'Student', '0', '2024-12-08 13:32:25', '2024-12-08 13:32:25'),
(594, 125, 'Hilda Cabigon', 18, 71, 4, NULL, NULL, '2024-12-08 13:32:25', '2024-12-08 13:32:25'),
(595, 126, 'Kole De Vera', 16, 6, 1, 'Student', '0', '2024-12-08 13:32:25', '2024-12-08 13:32:25'),
(596, 126, 'Jakayla De Vera', 3, 89, 4, NULL, NULL, '2024-12-08 13:32:25', '2024-12-08 13:32:25'),
(597, 126, 'Hope De Vera', 5, 31, 2, NULL, NULL, '2024-12-08 13:32:25', '2024-12-08 13:32:25'),
(598, 127, 'Anais San Vicente', 5, 83, 2, 'Consultant', '32062', '2024-12-08 13:32:25', '2024-12-08 13:32:25'),
(599, 127, 'Matilda San Vicente', 6, 68, 2, NULL, NULL, '2024-12-08 13:32:25', '2024-12-08 13:32:25'),
(600, 127, 'Ruben San Vicente', 16, 1, 1, 'Student', '0', '2024-12-08 13:32:26', '2024-12-08 13:32:26'),
(601, 127, 'Eulah San Vicente', 17, 66, 3, NULL, NULL, '2024-12-08 13:32:26', '2024-12-08 13:32:26'),
(602, 127, 'Cara San Vicente', 10, 63, 2, 'Consultant', '68536', '2024-12-08 13:32:26', '2024-12-08 13:32:26'),
(603, 128, 'Lincoln Bacani', 12, 55, 4, NULL, NULL, '2024-12-08 13:32:26', '2024-12-08 13:32:26'),
(604, 128, 'Amos Bacani', 18, 46, 1, 'Artist', '12480', '2024-12-08 13:32:26', '2024-12-08 13:32:26'),
(605, 128, 'Kaleigh Bacani', 14, 65, 4, NULL, NULL, '2024-12-08 13:32:26', '2024-12-08 13:32:26'),
(606, 128, 'Ronny Bacani', 12, 51, 2, 'Writer', '17685', '2024-12-08 13:32:26', '2024-12-08 13:32:26'),
(607, 128, 'Elza Bacani', 11, 86, 4, 'Consultant', '73419', '2024-12-08 13:32:26', '2024-12-08 13:32:26'),
(608, 128, 'Nick Bacani', 3, 44, 3, NULL, NULL, '2024-12-08 13:32:26', '2024-12-08 13:32:26'),
(609, 129, 'Shaina Bañez', 17, 50, 3, NULL, NULL, '2024-12-08 13:32:26', '2024-12-08 13:32:26'),
(610, 129, 'Clemmie Bañez', 9, 19, 3, 'Salesperson', '13784', '2024-12-08 13:32:27', '2024-12-08 13:32:27'),
(611, 130, 'Devin Alcaraz', 9, 27, 4, 'Graphic Designer', '22550', '2024-12-08 13:32:28', '2024-12-08 13:32:28'),
(612, 130, 'Haylie Alcaraz', 17, 68, 2, NULL, NULL, '2024-12-08 13:32:28', '2024-12-08 13:32:28'),
(613, 130, 'Gladys Alcaraz', 1, 20, 2, 'Virtual Assistant', '15116', '2024-12-08 13:32:28', '2024-12-08 13:32:28'),
(614, 130, 'Isadore Alcaraz', 6, 55, 1, NULL, NULL, '2024-12-08 13:32:28', '2024-12-08 13:32:28'),
(615, 130, 'Felicita Alcaraz', 4, 31, 4, 'Scientist', '44171', '2024-12-08 13:32:28', '2024-12-08 13:32:28'),
(616, 131, 'Jessy Castillo', 3, 66, 4, NULL, NULL, '2024-12-08 13:32:28', '2024-12-08 13:32:28'),
(617, 131, 'Nat Castillo', 2, 11, 1, 'Student', '0', '2024-12-08 13:32:28', '2024-12-08 13:32:28'),
(618, 131, 'Sandy Castillo', 6, 32, 4, 'Social Media Manager', '26235', '2024-12-08 13:32:28', '2024-12-08 13:32:28'),
(619, 132, 'Brisa Alvarez', 7, 70, 2, NULL, NULL, '2024-12-08 13:32:28', '2024-12-08 13:32:28'),
(620, 132, 'Anastacio Alvarez', 16, 6, 1, 'Student', '0', '2024-12-08 13:32:28', '2024-12-08 13:32:28'),
(621, 132, 'Xavier Alvarez', 2, 11, 1, 'Student', '0', '2024-12-08 13:32:28', '2024-12-08 13:32:28'),
(622, 133, 'Anne Dela Cruz', 9, 26, 2, 'Artist', '38378', '2024-12-08 13:32:28', '2024-12-08 13:32:28'),
(623, 133, 'Rosalind Dela Cruz', 6, 60, 3, 'Consultant', '34603', '2024-12-08 13:32:28', '2024-12-08 13:32:28'),
(624, 133, 'Gabe Dela Cruz', 5, 43, 1, 'Chef', '33813', '2024-12-08 13:32:28', '2024-12-08 13:32:28'),
(625, 134, 'Koby Soriano', 11, 96, 4, NULL, NULL, '2024-12-08 13:32:28', '2024-12-08 13:32:28'),
(626, 134, 'Lilliana Soriano', 14, 30, 4, NULL, NULL, '2024-12-08 13:32:29', '2024-12-08 13:32:29'),
(627, 134, 'Donavon Soriano', 5, 57, 3, 'Engineer', '36361', '2024-12-08 13:32:29', '2024-12-08 13:32:29'),
(628, 134, 'Herminia Soriano', 13, 61, 3, NULL, NULL, '2024-12-08 13:32:29', '2024-12-08 13:32:29'),
(629, 134, 'Hank Soriano', 17, 85, 2, NULL, NULL, '2024-12-08 13:32:29', '2024-12-08 13:32:29'),
(630, 134, 'Bart Soriano', 18, 3, 1, 'Student', '0', '2024-12-08 13:32:29', '2024-12-08 13:32:29'),
(631, 134, 'Tatyana Soriano', 3, 77, 3, NULL, NULL, '2024-12-08 13:32:29', '2024-12-08 13:32:29'),
(632, 135, 'Rory Esteban', 13, 46, 3, NULL, NULL, '2024-12-08 13:32:29', '2024-12-08 13:32:29'),
(633, 135, 'Theresa Esteban', 7, 36, 1, 'Consultant', '75203', '2024-12-08 13:32:29', '2024-12-08 13:32:29'),
(634, 136, 'Levi Flores', 10, 22, 4, 'Social Media Manager', '32391', '2024-12-08 13:32:29', '2024-12-08 13:32:29'),
(635, 136, 'Cale Flores', 8, 15, 1, 'Student', '0', '2024-12-08 13:32:29', '2024-12-08 13:32:29'),
(636, 136, 'Henderson Flores', 13, 90, 2, NULL, NULL, '2024-12-08 13:32:29', '2024-12-08 13:32:29'),
(637, 136, 'Sylvia Flores', 8, 10, 1, 'Student', '0', '2024-12-08 13:32:29', '2024-12-08 13:32:29'),
(638, 136, 'Vida Flores', 10, 64, 4, 'Consultant', '85254', '2024-12-08 13:32:30', '2024-12-08 13:32:30'),
(639, 136, 'Destany Flores', 15, 52, 2, NULL, NULL, '2024-12-08 13:32:30', '2024-12-08 13:32:30'),
(640, 136, 'Haylie Flores', 10, 27, 3, NULL, NULL, '2024-12-08 13:32:30', '2024-12-08 13:32:30'),
(641, 136, 'Kenny Flores', 11, 82, 2, NULL, NULL, '2024-12-08 13:32:30', '2024-12-08 13:32:30'),
(642, 136, 'Elissa Flores', 15, 37, 1, NULL, NULL, '2024-12-08 13:32:30', '2024-12-08 13:32:30'),
(643, 136, 'Walter Flores', 17, 45, 3, 'Dentist', '108664', '2024-12-08 13:32:30', '2024-12-08 13:32:30'),
(644, 137, 'Marlee Villafuerte', 12, 46, 1, NULL, NULL, '2024-12-08 13:32:30', '2024-12-08 13:32:30'),
(645, 138, 'Kaitlin Pascual', 1, 25, 1, 'Photographer', '26652', '2024-12-08 13:32:30', '2024-12-08 13:32:30'),
(646, 138, 'Jaren Pascual', 7, 77, 2, NULL, NULL, '2024-12-08 13:32:30', '2024-12-08 13:32:30'),
(647, 138, 'Madeline Pascual', 13, 59, 2, NULL, NULL, '2024-12-08 13:32:30', '2024-12-08 13:32:30'),
(648, 138, 'Reagan Pascual', 6, 52, 3, 'Writer', '17788', '2024-12-08 13:32:30', '2024-12-08 13:32:30'),
(649, 138, 'Parker Pascual', 12, 57, 4, NULL, NULL, '2024-12-08 13:32:30', '2024-12-08 13:32:30'),
(650, 138, 'Hunter Pascual', 17, 88, 3, NULL, NULL, '2024-12-08 13:32:30', '2024-12-08 13:32:30'),
(651, 139, 'Sebastian Suarez', 3, 34, 1, NULL, NULL, '2024-12-08 13:32:30', '2024-12-08 13:32:30'),
(652, 139, 'Uriah Suarez', 1, 14, 1, 'Student', '0', '2024-12-08 13:32:31', '2024-12-08 13:32:31'),
(653, 139, 'Florida Suarez', 11, 91, 2, 'Retired', '0', '2024-12-08 13:32:31', '2024-12-08 13:32:31'),
(654, 139, 'Cordell Suarez', 2, 28, 2, 'Freelancer', '26588', '2024-12-08 13:32:31', '2024-12-08 13:32:31'),
(655, 140, 'Shane Dela Cruz', 9, 25, 3, 'Freelancer', '17048', '2024-12-08 13:32:31', '2024-12-08 13:32:31'),
(656, 140, 'Kirstin Dela Cruz', 7, 34, 3, NULL, NULL, '2024-12-08 13:32:31', '2024-12-08 13:32:31'),
(657, 140, 'Ruth Dela Cruz', 4, 40, 4, 'Photographer', '23804', '2024-12-08 13:32:31', '2024-12-08 13:32:31'),
(658, 141, 'Elsie Salvador', 2, 7, 1, 'Student', '0', '2024-12-08 13:32:31', '2024-12-08 13:32:31'),
(659, 141, 'Bradford Salvador', 7, 36, 1, 'Graphic Designer', '16179', '2024-12-08 13:32:31', '2024-12-08 13:32:31'),
(660, 141, 'Twila Salvador', 6, 41, 1, 'Farmer', '14290', '2024-12-08 13:32:31', '2024-12-08 13:32:31'),
(661, 141, 'Otis Salvador', 9, 33, 1, 'Electrician', '18563', '2024-12-08 13:32:31', '2024-12-08 13:32:31'),
(662, 141, 'Hope Salvador', 14, 59, 3, NULL, NULL, '2024-12-08 13:32:31', '2024-12-08 13:32:31'),
(663, 141, 'Antone Salvador', 12, 59, 1, 'Nanny', '14968', '2024-12-08 13:32:31', '2024-12-08 13:32:31'),
(664, 142, 'Giovanni Garcia', 5, 74, 4, NULL, NULL, '2024-12-08 13:32:32', '2024-12-08 13:32:32'),
(665, 142, 'Wade Garcia', 6, 43, 1, 'Web Developer', '58724', '2024-12-08 13:32:33', '2024-12-08 13:32:33'),
(666, 142, 'Brayan Garcia', 11, 65, 2, NULL, NULL, '2024-12-08 13:32:33', '2024-12-08 13:32:33'),
(667, 142, 'Genevieve Garcia', 7, 45, 4, NULL, NULL, '2024-12-08 13:32:33', '2024-12-08 13:32:33'),
(668, 142, 'Verona Garcia', 12, 41, 3, NULL, NULL, '2024-12-08 13:32:33', '2024-12-08 13:32:33'),
(669, 143, 'Bennie Riviera', 13, 55, 4, 'Pilot', '125132', '2024-12-08 13:32:33', '2024-12-08 13:32:33'),
(670, 143, 'Carlos Riviera', 18, 79, 3, NULL, NULL, '2024-12-08 13:32:33', '2024-12-08 13:32:33'),
(671, 143, 'Bernadine Riviera', 18, 29, 1, NULL, NULL, '2024-12-08 13:32:33', '2024-12-08 13:32:33'),
(672, 143, 'Esmeralda Riviera', 6, 58, 3, 'Accountant', '23567', '2024-12-08 13:32:33', '2024-12-08 13:32:33'),
(673, 143, 'Issac Riviera', 8, 34, 2, NULL, NULL, '2024-12-08 13:32:34', '2024-12-08 13:32:34'),
(674, 143, 'Madie Riviera', 5, 65, 4, 'Retired', '0', '2024-12-08 13:32:34', '2024-12-08 13:32:34'),
(675, 143, 'Mozell Riviera', 8, 18, 2, 'Social Media Manager', '36105', '2024-12-08 13:32:34', '2024-12-08 13:32:34'),
(676, 143, 'Geovany Riviera', 7, 51, 4, NULL, NULL, '2024-12-08 13:32:34', '2024-12-08 13:32:34'),
(677, 144, 'Emery Reyes', 14, 52, 4, NULL, NULL, '2024-12-08 13:32:34', '2024-12-08 13:32:34'),
(678, 144, 'Cara Reyes', 2, 2, 1, 'Student', '0', '2024-12-08 13:32:34', '2024-12-08 13:32:34'),
(679, 144, 'Katelynn Reyes', 8, 26, 1, 'Freelancer', '30688', '2024-12-08 13:32:34', '2024-12-08 13:32:34'),
(680, 144, 'Elna Reyes', 14, 73, 2, NULL, NULL, '2024-12-08 13:32:34', '2024-12-08 13:32:34'),
(681, 144, 'Ila Reyes', 17, 92, 2, NULL, NULL, '2024-12-08 13:32:34', '2024-12-08 13:32:34'),
(682, 144, 'Grace Reyes', 3, 70, 4, NULL, NULL, '2024-12-08 13:32:34', '2024-12-08 13:32:34'),
(683, 144, 'Torrey Reyes', 8, 15, 1, 'Student', '0', '2024-12-08 13:32:34', '2024-12-08 13:32:34'),
(684, 145, 'Donato Alvarado', 11, 82, 3, NULL, NULL, '2024-12-08 13:32:34', '2024-12-08 13:32:34'),
(685, 145, 'Felton Alvarado', 9, 16, 1, 'Student', '0', '2024-12-08 13:32:35', '2024-12-08 13:32:35'),
(686, 145, 'Vergie Alvarado', 2, 19, 1, 'Salesperson', '23097', '2024-12-08 13:32:35', '2024-12-08 13:32:35'),
(687, 145, 'Catharine Alvarado', 7, 44, 2, NULL, NULL, '2024-12-08 13:32:35', '2024-12-08 13:32:35'),
(688, 145, 'Cindy Alvarado', 9, 31, 4, NULL, NULL, '2024-12-08 13:32:35', '2024-12-08 13:32:35'),
(689, 145, 'Josie Alvarado', 7, 46, 1, NULL, NULL, '2024-12-08 13:32:35', '2024-12-08 13:32:35'),
(690, 145, 'Felix Alvarado', 17, 57, 1, 'Social Media Manager', '19513', '2024-12-08 13:32:35', '2024-12-08 13:32:35'),
(691, 145, 'Gina Alvarado', 17, 100, 4, NULL, NULL, '2024-12-08 13:32:35', '2024-12-08 13:32:35'),
(692, 145, 'Ena Alvarado', 10, 46, 3, NULL, NULL, '2024-12-08 13:32:35', '2024-12-08 13:32:35'),
(693, 146, 'Cooper Garcia', 18, 54, 3, 'Mechanic', '19608', '2024-12-08 13:32:35', '2024-12-08 13:32:35'),
(694, 146, 'Evans Garcia', 15, 58, 2, 'Social Media Manager', '36823', '2024-12-08 13:32:36', '2024-12-08 13:32:36'),
(695, 146, 'Laverne Garcia', 5, 48, 4, 'Nurse', '21760', '2024-12-08 13:32:36', '2024-12-08 13:32:36'),
(696, 146, 'Gust Garcia', 5, 91, 2, NULL, NULL, '2024-12-08 13:32:36', '2024-12-08 13:32:36'),
(697, 146, 'Ubaldo Garcia', 7, 77, 2, 'Retired', '0', '2024-12-08 13:32:36', '2024-12-08 13:32:36'),
(698, 146, 'Joshuah Garcia', 15, 67, 4, NULL, NULL, '2024-12-08 13:32:36', '2024-12-08 13:32:36'),
(699, 146, 'Juvenal Garcia', 16, 20, 3, NULL, NULL, '2024-12-08 13:32:36', '2024-12-08 13:32:36'),
(700, 146, 'Kolby Garcia', 17, 47, 3, NULL, NULL, '2024-12-08 13:32:36', '2024-12-08 13:32:36'),
(701, 147, 'Emmet Villanueva', 6, 47, 1, NULL, NULL, '2024-12-08 13:32:37', '2024-12-08 13:32:37'),
(702, 147, 'Gordon Villanueva', 12, 56, 4, NULL, NULL, '2024-12-08 13:32:38', '2024-12-08 13:32:38'),
(703, 147, 'Janet Villanueva', 16, 22, 4, 'Artist', '15545', '2024-12-08 13:32:38', '2024-12-08 13:32:38'),
(704, 147, 'Imogene Villanueva', 10, 21, 3, NULL, NULL, '2024-12-08 13:32:38', '2024-12-08 13:32:38'),
(705, 147, 'Jane Villanueva', 8, 7, 1, 'Student', '0', '2024-12-08 13:32:38', '2024-12-08 13:32:38'),
(706, 147, 'Leanne Villanueva', 4, 30, 3, 'Virtual Assistant', '10685', '2024-12-08 13:32:38', '2024-12-08 13:32:38'),
(707, 147, 'Llewellyn Villanueva', 11, 62, 3, NULL, NULL, '2024-12-08 13:32:38', '2024-12-08 13:32:38'),
(708, 147, 'Daphnee Villanueva', 17, 74, 2, NULL, NULL, '2024-12-08 13:32:38', '2024-12-08 13:32:38'),
(709, 148, 'Chaya Vera', 18, 68, 3, NULL, NULL, '2024-12-08 13:32:38', '2024-12-08 13:32:38'),
(710, 148, 'Margie Vera', 17, 58, 2, 'Lawyer', '70622', '2024-12-08 13:32:38', '2024-12-08 13:32:38'),
(711, 148, 'Clara Vera', 14, 77, 2, 'Retired', '0', '2024-12-08 13:32:38', '2024-12-08 13:32:38'),
(712, 148, 'Katlynn Vera', 10, 64, 4, NULL, NULL, '2024-12-08 13:32:38', '2024-12-08 13:32:38'),
(713, 148, 'Melvina Vera', 16, 30, 4, NULL, NULL, '2024-12-08 13:32:38', '2024-12-08 13:32:38'),
(714, 148, 'Einar Vera', 12, 44, 4, NULL, NULL, '2024-12-08 13:32:38', '2024-12-08 13:32:38'),
(715, 148, 'Davonte Vera', 9, 18, 3, 'Intern', '6041', '2024-12-08 13:32:38', '2024-12-08 13:32:38'),
(716, 149, 'Gia De Guzman', 12, 46, 3, 'Dentist', '68508', '2024-12-08 13:32:39', '2024-12-08 13:32:39'),
(717, 149, 'Xzavier De Guzman', 5, 58, 4, 'Teacher', '15770', '2024-12-08 13:32:39', '2024-12-08 13:32:39'),
(718, 149, 'Margaret De Guzman', 5, 60, 3, 'Retired', '0', '2024-12-08 13:32:39', '2024-12-08 13:32:39'),
(719, 149, 'Leonard De Guzman', 17, 38, 3, NULL, NULL, '2024-12-08 13:32:39', '2024-12-08 13:32:39'),
(720, 149, 'Jerrell De Guzman', 8, 21, 4, 'Photographer', '20789', '2024-12-08 13:32:39', '2024-12-08 13:32:39'),
(721, 149, 'Jakayla De Guzman', 7, 74, 2, NULL, NULL, '2024-12-08 13:32:39', '2024-12-08 13:32:39'),
(722, 149, 'Obie De Guzman', 8, 28, 3, 'Photographer', '10186', '2024-12-08 13:32:39', '2024-12-08 13:32:39'),
(723, 149, 'Lincoln De Guzman', 12, 61, 4, NULL, NULL, '2024-12-08 13:32:39', '2024-12-08 13:32:39'),
(724, 150, 'Astrid Mendoza', 9, 11, 1, 'Student', '0', '2024-12-08 13:32:39', '2024-12-08 13:32:39'),
(725, 150, 'Darwin Mendoza', 5, 43, 4, NULL, NULL, '2024-12-08 13:32:39', '2024-12-08 13:32:39'),
(726, 150, 'Brain Mendoza', 17, 64, 4, NULL, NULL, '2024-12-08 13:32:39', '2024-12-08 13:32:39'),
(727, 150, 'Bryana Mendoza', 6, 37, 2, 'Nurse', '27171', '2024-12-08 13:32:39', '2024-12-08 13:32:39'),
(728, 150, 'Karlee Mendoza', 14, 74, 3, 'Consultant', '44344', '2024-12-08 13:32:39', '2024-12-08 13:32:39'),
(729, 150, 'Ivory Mendoza', 14, 77, 3, NULL, NULL, '2024-12-08 13:32:39', '2024-12-08 13:32:39'),
(730, 151, 'Adrian Ramos', 13, 50, 4, 'Teacher', '34455', '2024-12-08 13:32:39', '2024-12-08 13:32:39'),
(731, 151, 'Dereck Ramos', 18, 54, 3, NULL, NULL, '2024-12-08 13:32:39', '2024-12-08 13:32:39'),
(732, 151, 'Melissa Ramos', 7, 42, 1, 'Electrician', '16405', '2024-12-08 13:32:40', '2024-12-08 13:32:40'),
(733, 151, 'Lisa Ramos', 15, 45, 1, NULL, NULL, '2024-12-08 13:32:40', '2024-12-08 13:32:40'),
(734, 151, 'Chaz Ramos', 3, 90, 4, NULL, NULL, '2024-12-08 13:32:40', '2024-12-08 13:32:40'),
(735, 151, 'Mckenzie Ramos', 4, 85, 4, 'Consultant', '59352', '2024-12-08 13:32:40', '2024-12-08 13:32:40'),
(736, 151, 'Hunter Ramos', 8, 33, 2, 'Nurse', '20555', '2024-12-08 13:32:40', '2024-12-08 13:32:40'),
(737, 152, 'D\'angelo San Vicente', 1, 16, 1, 'Student', '0', '2024-12-08 13:32:40', '2024-12-08 13:32:40'),
(738, 152, 'Kaylin San Vicente', 5, 75, 3, NULL, NULL, '2024-12-08 13:32:40', '2024-12-08 13:32:40'),
(739, 152, 'Xander San Vicente', 9, 9, 1, 'Student', '0', '2024-12-08 13:32:40', '2024-12-08 13:32:40'),
(740, 152, 'Alyce San Vicente', 3, 58, 3, 'Electrician', '23668', '2024-12-08 13:32:40', '2024-12-08 13:32:40'),
(741, 153, 'Lessie De Leon', 5, 88, 3, NULL, NULL, '2024-12-08 13:32:40', '2024-12-08 13:32:40'),
(742, 153, 'Tina De Leon', 11, 77, 3, NULL, NULL, '2024-12-08 13:32:40', '2024-12-08 13:32:40'),
(743, 153, 'Don De Leon', 9, 17, 1, 'Student', '0', '2024-12-08 13:32:40', '2024-12-08 13:32:40'),
(744, 153, 'Sam De Leon', 12, 56, 4, 'Retired', '0', '2024-12-08 13:32:40', '2024-12-08 13:32:40'),
(745, 153, 'Julia De Leon', 7, 48, 2, NULL, NULL, '2024-12-08 13:32:40', '2024-12-08 13:32:40'),
(746, 154, 'Eula Ramos', 14, 62, 4, NULL, NULL, '2024-12-08 13:32:40', '2024-12-08 13:32:40'),
(747, 154, 'Magnolia Ramos', 5, 41, 3, NULL, NULL, '2024-12-08 13:32:40', '2024-12-08 13:32:40'),
(748, 155, 'Norberto Rosales', 9, 37, 3, 'Virtual Assistant', '14512', '2024-12-08 13:32:41', '2024-12-08 13:32:41'),
(749, 155, 'Raymundo Rosales', 1, 23, 2, 'Intern', '14951', '2024-12-08 13:32:41', '2024-12-08 13:32:41'),
(750, 155, 'Elaina Rosales', 5, 40, 2, 'Content Creator', '6328', '2024-12-08 13:32:42', '2024-12-08 13:32:42'),
(751, 155, 'Verda Rosales', 4, 83, 2, NULL, NULL, '2024-12-08 13:32:42', '2024-12-08 13:32:42'),
(752, 155, 'Cecile Rosales', 18, 54, 3, NULL, NULL, '2024-12-08 13:32:43', '2024-12-08 13:32:43'),
(753, 155, 'Russ Rosales', 5, 72, 4, NULL, NULL, '2024-12-08 13:32:43', '2024-12-08 13:32:43'),
(754, 156, 'Graciela San Vicente', 8, 30, 2, NULL, NULL, '2024-12-08 13:32:43', '2024-12-08 13:32:43'),
(755, 156, 'Antoinette San Vicente', 13, 86, 4, NULL, NULL, '2024-12-08 13:32:43', '2024-12-08 13:32:43'),
(756, 156, 'Joey San Vicente', 3, 76, 3, NULL, NULL, '2024-12-08 13:32:43', '2024-12-08 13:32:43'),
(757, 156, 'Destinee San Vicente', 14, 74, 4, NULL, NULL, '2024-12-08 13:32:43', '2024-12-08 13:32:43'),
(758, 156, 'Joany San Vicente', 10, 65, 3, NULL, NULL, '2024-12-08 13:32:43', '2024-12-08 13:32:43'),
(759, 156, 'Sheila San Vicente', 6, 80, 4, NULL, NULL, '2024-12-08 13:32:43', '2024-12-08 13:32:43'),
(760, 156, 'Vaughn San Vicente', 1, 29, 1, 'Salesperson', '13832', '2024-12-08 13:32:43', '2024-12-08 13:32:43'),
(761, 156, 'Estella San Vicente', 2, 29, 3, NULL, NULL, '2024-12-08 13:32:43', '2024-12-08 13:32:43'),
(762, 156, 'Dejah San Vicente', 7, 80, 4, NULL, NULL, '2024-12-08 13:32:43', '2024-12-08 13:32:43'),
(763, 156, 'Ubaldo San Vicente', 2, 22, 4, NULL, NULL, '2024-12-08 13:32:43', '2024-12-08 13:32:43'),
(764, 157, 'Keegan Manalo', 3, 97, 2, NULL, NULL, '2024-12-08 13:32:43', '2024-12-08 13:32:43'),
(765, 157, 'Jeramie Manalo', 9, 24, 3, 'Salesperson', '20806', '2024-12-08 13:32:43', '2024-12-08 13:32:43'),
(766, 157, 'Alanis Manalo', 7, 41, 2, NULL, NULL, '2024-12-08 13:32:44', '2024-12-08 13:32:44'),
(767, 157, 'Dale Manalo', 4, 92, 2, NULL, NULL, '2024-12-08 13:32:44', '2024-12-08 13:32:44'),
(768, 157, 'Danielle Manalo', 9, 14, 1, 'Student', '0', '2024-12-08 13:32:44', '2024-12-08 13:32:44'),
(769, 157, 'Richie Manalo', 2, 8, 1, 'Student', '0', '2024-12-08 13:32:44', '2024-12-08 13:32:44'),
(770, 157, 'Skye Manalo', 8, 25, 3, 'Freelancer', '27334', '2024-12-08 13:32:44', '2024-12-08 13:32:44'),
(771, 157, 'Dayana Manalo', 2, 28, 2, 'Freelancer', '32011', '2024-12-08 13:32:44', '2024-12-08 13:32:44'),
(772, 158, 'Einar De Ocampo', 11, 85, 4, 'Consultant', '96962', '2024-12-08 13:32:44', '2024-12-08 13:32:44'),
(773, 159, 'Bessie Delos Reyes', 4, 31, 3, NULL, NULL, '2024-12-08 13:32:44', '2024-12-08 13:32:44'),
(774, 159, 'Zion Delos Reyes', 11, 68, 3, NULL, NULL, '2024-12-08 13:32:44', '2024-12-08 13:32:44'),
(775, 160, 'Ola Chua', 13, 86, 2, NULL, NULL, '2024-12-08 13:32:44', '2024-12-08 13:32:44'),
(776, 160, 'Taryn Chua', 11, 60, 4, NULL, NULL, '2024-12-08 13:32:44', '2024-12-08 13:32:44'),
(777, 160, 'Dewayne Chua', 12, 87, 2, 'Consultant', '94585', '2024-12-08 13:32:44', '2024-12-08 13:32:44'),
(778, 160, 'Leora Chua', 18, 11, 1, 'Student', '0', '2024-12-08 13:32:45', '2024-12-08 13:32:45'),
(779, 161, 'Chadrick Suarez', 16, 13, 1, 'Student', '0', '2024-12-08 13:32:45', '2024-12-08 13:32:45'),
(780, 162, 'Verdie Alvarado', 14, 61, 3, NULL, NULL, '2024-12-08 13:32:45', '2024-12-08 13:32:45'),
(781, 162, 'Summer Alvarado', 7, 43, 4, 'Architect', '41056', '2024-12-08 13:32:45', '2024-12-08 13:32:45'),
(782, 162, 'Libbie Alvarado', 1, 14, 1, 'Student', '0', '2024-12-08 13:32:45', '2024-12-08 13:32:45'),
(783, 162, 'Zoey Alvarado', 18, 57, 4, 'Intern', '12842', '2024-12-08 13:32:45', '2024-12-08 13:32:45'),
(784, 162, 'Harley Alvarado', 7, 62, 3, NULL, NULL, '2024-12-08 13:32:45', '2024-12-08 13:32:45'),
(785, 162, 'Rosalinda Alvarado', 10, 32, 1, 'Social Media Manager', '22081', '2024-12-08 13:32:45', '2024-12-08 13:32:45'),
(786, 163, 'Tierra Natividad', 14, 65, 2, NULL, NULL, '2024-12-08 13:32:45', '2024-12-08 13:32:45'),
(787, 163, 'Aidan Natividad', 14, 64, 4, NULL, NULL, '2024-12-08 13:32:46', '2024-12-08 13:32:46'),
(788, 163, 'Garret Natividad', 15, 80, 3, NULL, NULL, '2024-12-08 13:32:47', '2024-12-08 13:32:47'),
(789, 163, 'Rhett Natividad', 7, 62, 3, NULL, NULL, '2024-12-08 13:32:47', '2024-12-08 13:32:47'),
(790, 163, 'Khalid Natividad', 1, 27, 3, NULL, NULL, '2024-12-08 13:32:47', '2024-12-08 13:32:47'),
(791, 163, 'Diego Natividad', 13, 88, 2, NULL, NULL, '2024-12-08 13:32:47', '2024-12-08 13:32:47'),
(792, 163, 'Tamara Natividad', 1, 5, 1, 'Student', '0', '2024-12-08 13:32:47', '2024-12-08 13:32:47'),
(793, 163, 'Carole Natividad', 2, 12, 1, 'Student', '0', '2024-12-08 13:32:47', '2024-12-08 13:32:47'),
(794, 163, 'Thomas Natividad', 3, 46, 4, NULL, NULL, '2024-12-08 13:32:47', '2024-12-08 13:32:47'),
(795, 164, 'Jarret Villafuerte', 15, 54, 1, 'Architect', '29313', '2024-12-08 13:32:47', '2024-12-08 13:32:47'),
(796, 164, 'Gerald Villafuerte', 7, 66, 3, NULL, NULL, '2024-12-08 13:32:47', '2024-12-08 13:32:47'),
(797, 165, 'Adrien Labrador', 13, 47, 3, 'Scientist', '50374', '2024-12-08 13:32:47', '2024-12-08 13:32:47'),
(798, 165, 'Monte Labrador', 6, 60, 4, 'Retired', '0', '2024-12-08 13:32:47', '2024-12-08 13:32:47'),
(799, 165, 'Angelo Labrador', 1, 5, 1, 'Student', '0', '2024-12-08 13:32:47', '2024-12-08 13:32:47'),
(800, 165, 'Tyrique Labrador', 2, 22, 4, 'Virtual Assistant', '17180', '2024-12-08 13:32:47', '2024-12-08 13:32:47'),
(801, 166, 'Aniyah Garcia', 2, 10, 1, 'Student', '0', '2024-12-08 13:32:47', '2024-12-08 13:32:47'),
(802, 166, 'Kyra Garcia', 15, 59, 1, NULL, NULL, '2024-12-08 13:32:47', '2024-12-08 13:32:47'),
(803, 166, 'Levi Garcia', 13, 68, 3, NULL, NULL, '2024-12-08 13:32:48', '2024-12-08 13:32:48'),
(804, 166, 'Kris Garcia', 16, 11, 1, 'Student', '0', '2024-12-08 13:32:48', '2024-12-08 13:32:48'),
(805, 166, 'Vergie Garcia', 2, 3, 1, 'Student', '0', '2024-12-08 13:32:48', '2024-12-08 13:32:48'),
(806, 166, 'Madalyn Garcia', 17, 58, 1, 'Nurse', '28404', '2024-12-08 13:32:48', '2024-12-08 13:32:48'),
(807, 166, 'Norris Garcia', 7, 62, 4, NULL, NULL, '2024-12-08 13:32:48', '2024-12-08 13:32:48'),
(808, 166, 'Leann Garcia', 1, 28, 1, 'Salesperson', '12296', '2024-12-08 13:32:48', '2024-12-08 13:32:48'),
(809, 166, 'Stanley Garcia', 11, 72, 2, 'Consultant', '28312', '2024-12-08 13:32:48', '2024-12-08 13:32:48'),
(810, 167, 'Lindsey Ramos', 11, 97, 2, NULL, NULL, '2024-12-08 13:32:48', '2024-12-08 13:32:48'),
(811, 167, 'Jena Ramos', 2, 5, 1, 'Student', '0', '2024-12-08 13:32:48', '2024-12-08 13:32:48'),
(812, 168, 'Darian Salvador', 8, 16, 1, 'Student', '0', '2024-12-08 13:32:48', '2024-12-08 13:32:48'),
(813, 168, 'Herbert Salvador', 4, 48, 4, NULL, NULL, '2024-12-08 13:32:48', '2024-12-08 13:32:48'),
(814, 168, 'Catharine Salvador', 4, 56, 2, NULL, NULL, '2024-12-08 13:32:48', '2024-12-08 13:32:48'),
(815, 168, 'Verla Salvador', 2, 26, 2, 'Part-time Job', NULL, '2024-12-08 13:32:48', '2024-12-08 13:32:48'),
(816, 168, 'Benedict Salvador', 12, 50, 1, 'Farmer', '6101', '2024-12-08 13:32:48', '2024-12-08 13:32:48'),
(817, 168, 'Fleta Salvador', 8, 14, 1, 'Student', '0', '2024-12-08 13:32:48', '2024-12-08 13:32:48'),
(818, 168, 'Paul Salvador', 8, 18, 2, 'Freelancer', '29580', '2024-12-08 13:32:49', '2024-12-08 13:32:49'),
(819, 168, 'Imogene Salvador', 12, 85, 4, NULL, NULL, '2024-12-08 13:32:49', '2024-12-08 13:32:49'),
(820, 169, 'Patrick Cabrera', 10, 24, 1, 'Photographer', '25523', '2024-12-08 13:32:49', '2024-12-08 13:32:49'),
(821, 169, 'Morton Cabrera', 10, 35, 4, 'Mechanic', '31665', '2024-12-08 13:32:49', '2024-12-08 13:32:49'),
(822, 169, 'Junius Cabrera', 1, 10, 1, 'Student', '0', '2024-12-08 13:32:49', '2024-12-08 13:32:49'),
(823, 170, 'Murl López', 13, 44, 1, NULL, NULL, '2024-12-08 13:32:49', '2024-12-08 13:32:49'),
(824, 170, 'Kasey López', 4, 69, 2, 'Retired', '0', '2024-12-08 13:32:49', '2024-12-08 13:32:49'),
(825, 170, 'Hardy López', 13, 82, 4, NULL, NULL, '2024-12-08 13:32:49', '2024-12-08 13:32:49'),
(826, 170, 'Aubrey López', 9, 40, 3, 'Intern', '9342', '2024-12-08 13:32:49', '2024-12-08 13:32:49'),
(827, 170, 'Jeffrey López', 11, 74, 4, NULL, NULL, '2024-12-08 13:32:49', '2024-12-08 13:32:49'),
(828, 170, 'Edna López', 9, 32, 3, 'Bus Driver', '24454', '2024-12-08 13:32:49', '2024-12-08 13:32:49'),
(829, 170, 'Joan López', 13, 65, 4, NULL, NULL, '2024-12-08 13:32:49', '2024-12-08 13:32:49'),
(830, 170, 'Jace López', 13, 67, 2, NULL, NULL, '2024-12-08 13:32:49', '2024-12-08 13:32:49'),
(831, 171, 'Kelli De Jesus', 7, 73, 4, NULL, NULL, '2024-12-08 13:32:49', '2024-12-08 13:32:49'),
(832, 172, 'Eduardo Esteban', 8, 8, 1, 'Student', '0', '2024-12-08 13:32:50', '2024-12-08 13:32:50'),
(833, 172, 'Kirstin Esteban', 6, 59, 4, NULL, NULL, '2024-12-08 13:32:50', '2024-12-08 13:32:50'),
(834, 173, 'Idella Suarez', 3, 63, 2, NULL, NULL, '2024-12-08 13:32:50', '2024-12-08 13:32:50'),
(835, 173, 'Ulices Suarez', 3, 56, 4, 'Intern', '9756', '2024-12-08 13:32:50', '2024-12-08 13:32:50'),
(836, 173, 'Katlyn Suarez', 15, 59, 1, 'Retired', '0', '2024-12-08 13:32:50', '2024-12-08 13:32:50'),
(837, 173, 'Itzel Suarez', 18, 11, 1, 'Student', '0', '2024-12-08 13:32:51', '2024-12-08 13:32:51'),
(838, 173, 'Jarrett Suarez', 18, 54, 1, NULL, NULL, '2024-12-08 13:32:52', '2024-12-08 13:32:52'),
(839, 173, 'Owen Suarez', 16, 24, 1, 'Social Media Manager', '38854', '2024-12-08 13:32:52', '2024-12-08 13:32:52'),
(840, 174, 'Kimberly Macapagal', 11, 82, 3, NULL, NULL, '2024-12-08 13:32:52', '2024-12-08 13:32:52'),
(841, 174, 'Boyd Macapagal', 6, 67, 2, NULL, NULL, '2024-12-08 13:32:52', '2024-12-08 13:32:52'),
(842, 174, 'Maud Macapagal', 3, 87, 2, NULL, NULL, '2024-12-08 13:32:52', '2024-12-08 13:32:52'),
(843, 175, 'Bernita San Pedro', 2, 11, 1, 'Student', '0', '2024-12-08 13:32:52', '2024-12-08 13:32:52'),
(844, 175, 'Fern San Pedro', 15, 51, 3, NULL, NULL, '2024-12-08 13:32:52', '2024-12-08 13:32:52'),
(845, 175, 'Theo San Pedro', 14, 59, 4, 'Construction Worker', '29343', '2024-12-08 13:32:52', '2024-12-08 13:32:52'),
(846, 175, 'Garfield San Pedro', 14, 80, 4, NULL, NULL, '2024-12-08 13:32:52', '2024-12-08 13:32:52'),
(847, 175, 'Jordane San Pedro', 17, 49, 3, NULL, NULL, '2024-12-08 13:32:52', '2024-12-08 13:32:52'),
(848, 175, 'Aida San Pedro', 8, 6, 1, 'Student', '0', '2024-12-08 13:32:52', '2024-12-08 13:32:52'),
(849, 175, 'Noel San Pedro', 13, 79, 4, NULL, NULL, '2024-12-08 13:32:52', '2024-12-08 13:32:52'),
(850, 176, 'Jazlyn Ocampo', 9, 30, 2, NULL, NULL, '2024-12-08 13:32:52', '2024-12-08 13:32:52'),
(851, 176, 'Eldridge Ocampo', 12, 77, 2, NULL, NULL, '2024-12-08 13:32:52', '2024-12-08 13:32:52'),
(852, 177, 'Tess Chua', 15, 38, 2, NULL, NULL, '2024-12-08 13:32:53', '2024-12-08 13:32:53'),
(853, 177, 'Joana Chua', 7, 58, 3, NULL, NULL, '2024-12-08 13:32:53', '2024-12-08 13:32:53'),
(854, 177, 'Gladys Chua', 10, 80, 2, NULL, NULL, '2024-12-08 13:32:53', '2024-12-08 13:32:53'),
(855, 177, 'Kiarra Chua', 10, 20, 4, 'Graphic Designer', '21468', '2024-12-08 13:32:53', '2024-12-08 13:32:53'),
(856, 177, 'Trace Chua', 16, 16, 1, 'Student', '0', '2024-12-08 13:32:53', '2024-12-08 13:32:53'),
(857, 177, 'Chad Chua', 4, 74, 4, 'Retired', '0', '2024-12-08 13:32:53', '2024-12-08 13:32:53'),
(858, 177, 'Pink Chua', 8, 8, 1, 'Student', '0', '2024-12-08 13:32:53', '2024-12-08 13:32:53'),
(859, 177, 'Will Chua', 11, 71, 4, 'Retired', '0', '2024-12-08 13:32:53', '2024-12-08 13:32:53'),
(860, 177, 'Jillian Chua', 15, 61, 2, NULL, NULL, '2024-12-08 13:32:53', '2024-12-08 13:32:53'),
(861, 178, 'Tyrel Bacani', 2, 4, 1, 'Student', '0', '2024-12-08 13:32:53', '2024-12-08 13:32:53'),
(862, 178, 'Dennis Bacani', 1, 11, 1, 'Student', '0', '2024-12-08 13:32:53', '2024-12-08 13:32:53'),
(863, 178, 'Mariano Bacani', 14, 57, 2, NULL, NULL, '2024-12-08 13:32:53', '2024-12-08 13:32:53'),
(864, 178, 'Cleora Bacani', 8, 39, 4, 'Electrician', '17789', '2024-12-08 13:32:53', '2024-12-08 13:32:53'),
(865, 178, 'Javier Bacani', 8, 12, 1, 'Student', '0', '2024-12-08 13:32:54', '2024-12-08 13:32:54'),
(866, 178, 'Dejon Bacani', 12, 58, 2, 'Carpenter', '21361', '2024-12-08 13:32:54', '2024-12-08 13:32:54'),
(867, 178, 'Keshaun Bacani', 9, 38, 1, 'Lawyer', '82318', '2024-12-08 13:32:54', '2024-12-08 13:32:54'),
(868, 179, 'Brandyn Tonio', 16, 7, 1, 'Student', '0', '2024-12-08 13:32:54', '2024-12-08 13:32:54'),
(869, 179, 'Moshe Tonio', 12, 65, 4, NULL, NULL, '2024-12-08 13:32:54', '2024-12-08 13:32:54'),
(870, 180, 'Lucinda Cruzado', 12, 63, 2, NULL, NULL, '2024-12-08 13:32:54', '2024-12-08 13:32:54'),
(871, 180, 'Danielle Cruzado', 5, 41, 1, NULL, NULL, '2024-12-08 13:32:54', '2024-12-08 13:32:54'),
(872, 180, 'Jessyca Cruzado', 10, 70, 2, 'Retired', '0', '2024-12-08 13:32:55', '2024-12-08 13:32:55'),
(873, 180, 'Beryl Cruzado', 16, 14, 1, 'Student', '0', '2024-12-08 13:32:56', '2024-12-08 13:32:56'),
(874, 181, 'Joseph De Leon', 1, 25, 4, 'Graphic Designer', '19379', '2024-12-08 13:32:56', '2024-12-08 13:32:56'),
(875, 181, 'Chandler De Leon', 16, 28, 4, 'Artist', '26529', '2024-12-08 13:32:56', '2024-12-08 13:32:56'),
(876, 181, 'Beverly De Leon', 8, 23, 4, 'Salesperson', '20779', '2024-12-08 13:32:56', '2024-12-08 13:32:56'),
(877, 181, 'Genesis De Leon', 18, 63, 4, NULL, NULL, '2024-12-08 13:32:56', '2024-12-08 13:32:56'),
(878, 181, 'Sister De Leon', 17, 38, 2, 'Consultant', '28711', '2024-12-08 13:32:56', '2024-12-08 13:32:56'),
(879, 181, 'Rossie De Leon', 18, 70, 2, NULL, NULL, '2024-12-08 13:32:56', '2024-12-08 13:32:56'),
(880, 181, 'Joseph De Leon', 10, 19, 3, 'Junior Developer', '27838', '2024-12-08 13:32:56', '2024-12-08 13:32:56'),
(881, 181, 'Jaylan De Leon', 7, 80, 4, NULL, NULL, '2024-12-08 13:32:56', '2024-12-08 13:32:56'),
(882, 181, 'Heloise De Leon', 7, 79, 4, 'Consultant', '71827', '2024-12-08 13:32:56', '2024-12-08 13:32:56'),
(883, 181, 'Abagail De Leon', 1, 5, 1, 'Student', '0', '2024-12-08 13:32:56', '2024-12-08 13:32:56'),
(884, 182, 'Alex Cabrera', 5, 59, 4, 'Freelancer', '25590', '2024-12-08 13:32:56', '2024-12-08 13:32:56'),
(885, 182, 'Sigmund Cabrera', 11, 85, 3, NULL, NULL, '2024-12-08 13:32:56', '2024-12-08 13:32:56'),
(886, 182, 'Milton Cabrera', 18, 79, 3, NULL, NULL, '2024-12-08 13:32:56', '2024-12-08 13:32:56'),
(887, 183, 'Lyric Flores', 1, 27, 3, 'Salesperson', '22497', '2024-12-08 13:32:56', '2024-12-08 13:32:56'),
(888, 183, 'Marquise Flores', 12, 42, 2, 'Lawyer', '64157', '2024-12-08 13:32:56', '2024-12-08 13:32:56'),
(889, 183, 'Cierra Flores', 13, 40, 3, NULL, NULL, '2024-12-08 13:32:56', '2024-12-08 13:32:56'),
(890, 183, 'Winston Flores', 7, 59, 4, 'Bus Driver', '28141', '2024-12-08 13:32:56', '2024-12-08 13:32:56'),
(891, 183, 'Marlin Flores', 6, 52, 3, NULL, NULL, '2024-12-08 13:32:57', '2024-12-08 13:32:57'),
(892, 183, 'Torrey Flores', 13, 45, 1, 'Architect', '62687', '2024-12-08 13:32:57', '2024-12-08 13:32:57'),
(893, 183, 'Brendon Flores', 8, 12, 1, 'Student', '0', '2024-12-08 13:32:57', '2024-12-08 13:32:57'),
(894, 183, 'Lexi Flores', 6, 32, 4, 'Web Developer', '68683', '2024-12-08 13:32:57', '2024-12-08 13:32:57'),
(895, 184, 'Sheila Pascual', 9, 25, 4, 'Junior Developer', '22910', '2024-12-08 13:32:57', '2024-12-08 13:32:57'),
(896, 184, 'Letitia Pascual', 4, 87, 2, 'Retired', '0', '2024-12-08 13:32:57', '2024-12-08 13:32:57'),
(897, 184, 'Jude Pascual', 17, 99, 2, NULL, NULL, '2024-12-08 13:32:57', '2024-12-08 13:32:57'),
(898, 184, 'Robin Pascual', 17, 52, 2, 'Retired', '0', '2024-12-08 13:32:57', '2024-12-08 13:32:57'),
(899, 185, 'Jacey Cruz', 8, 12, 1, 'Student', '0', '2024-12-08 13:32:57', '2024-12-08 13:32:57'),
(900, 185, 'Estel Cruz', 17, 45, 4, 'Writer', '25054', '2024-12-08 13:32:57', '2024-12-08 13:32:57'),
(901, 185, 'Andrew Cruz', 18, 66, 4, NULL, NULL, '2024-12-08 13:32:57', '2024-12-08 13:32:57'),
(902, 186, 'Sammie Vera', 4, 87, 2, NULL, NULL, '2024-12-08 13:32:57', '2024-12-08 13:32:57'),
(903, 186, 'Violette Vera', 13, 53, 2, 'Accountant', '23790', '2024-12-08 13:32:57', '2024-12-08 13:32:57'),
(904, 186, 'Adela Vera', 9, 40, 3, NULL, NULL, '2024-12-08 13:32:57', '2024-12-08 13:32:57'),
(905, 186, 'Adan Vera', 10, 67, 4, NULL, NULL, '2024-12-08 13:32:57', '2024-12-08 13:32:57'),
(906, 186, 'Laron Vera', 17, 65, 4, NULL, NULL, '2024-12-08 13:32:58', '2024-12-08 13:32:58'),
(907, 186, 'Jaclyn Vera', 8, 29, 4, 'Social Media Manager', '18494', '2024-12-08 13:32:58', '2024-12-08 13:32:58'),
(908, 186, 'Ed Vera', 11, 92, 2, NULL, NULL, '2024-12-08 13:32:58', '2024-12-08 13:32:58'),
(909, 186, 'Antonio Vera', 4, 64, 2, NULL, NULL, '2024-12-08 13:32:58', '2024-12-08 13:32:58'),
(910, 186, 'Stephanie Vera', 7, 78, 3, NULL, NULL, '2024-12-08 13:32:58', '2024-12-08 13:32:58'),
(911, 186, 'Sunny Vera', 12, 82, 4, NULL, NULL, '2024-12-08 13:32:58', '2024-12-08 13:32:58'),
(912, 187, 'Providenci De Ocampo', 3, 49, 3, 'Photographer', '28200', '2024-12-08 13:32:58', '2024-12-08 13:32:58'),
(913, 187, 'Joy De Ocampo', 5, 70, 2, NULL, NULL, '2024-12-08 13:32:58', '2024-12-08 13:32:58'),
(914, 188, 'Tia Velasquez', 14, 46, 2, 'Consultant', '46601', '2024-12-08 13:32:58', '2024-12-08 13:32:58'),
(915, 188, 'Domenica Velasquez', 13, 63, 4, NULL, NULL, '2024-12-08 13:32:58', '2024-12-08 13:32:58'),
(916, 189, 'Odie Macapagal', 7, 41, 1, 'Graphic Designer', '30750', '2024-12-08 13:32:58', '2024-12-08 13:32:58'),
(917, 189, 'Alvah Macapagal', 2, 25, 4, NULL, NULL, '2024-12-08 13:32:58', '2024-12-08 13:32:58'),
(918, 190, 'Emery Cruzado', 16, 29, 2, 'Virtual Assistant', '21275', '2024-12-08 13:32:58', '2024-12-08 13:32:58'),
(919, 190, 'Donald Cruzado', 15, 30, 4, 'Bus Driver', '31951', '2024-12-08 13:32:58', '2024-12-08 13:32:58'),
(920, 190, 'Jakob Cruzado', 16, 5, 1, 'Student', '0', '2024-12-08 13:32:58', '2024-12-08 13:32:58'),
(921, 190, 'Alexandrine Cruzado', 17, 69, 4, NULL, NULL, '2024-12-08 13:32:59', '2024-12-08 13:32:59'),
(922, 190, 'Yazmin Cruzado', 1, 19, 3, 'Photographer', '21919', '2024-12-08 13:33:00', '2024-12-08 13:33:00'),
(923, 190, 'Green Cruzado', 18, 31, 4, 'Carpenter', '17529', '2024-12-08 13:33:00', '2024-12-08 13:33:00'),
(924, 190, 'Ernestina Cruzado', 10, 51, 4, 'Content Creator', '21127', '2024-12-08 13:33:00', '2024-12-08 13:33:00'),
(925, 191, 'Flavie Rosales', 18, 15, 1, 'Student', '0', '2024-12-08 13:33:00', '2024-12-08 13:33:00'),
(926, 191, 'Cloyd Rosales', 6, 63, 2, NULL, NULL, '2024-12-08 13:33:00', '2024-12-08 13:33:00'),
(927, 191, 'Aletha Rosales', 17, 67, 3, 'Retired', '0', '2024-12-08 13:33:00', '2024-12-08 13:33:00'),
(928, 191, 'Hilario Rosales', 8, 12, 1, 'Student', '0', '2024-12-08 13:33:00', '2024-12-08 13:33:00'),
(929, 191, 'Abigail Rosales', 11, 61, 2, NULL, NULL, '2024-12-08 13:33:00', '2024-12-08 13:33:00'),
(930, 191, 'Kraig Rosales', 13, 46, 1, 'Teacher', '21273', '2024-12-08 13:33:00', '2024-12-08 13:33:00'),
(931, 191, 'Norberto Rosales', 2, 2, 1, 'Student', '0', '2024-12-08 13:33:00', '2024-12-08 13:33:00'),
(932, 191, 'Jean Rosales', 16, 17, 1, 'Student', '0', '2024-12-08 13:33:00', '2024-12-08 13:33:00'),
(933, 191, 'Ila Rosales', 17, 30, 1, 'Chef', '32830', '2024-12-08 13:33:00', '2024-12-08 13:33:00'),
(934, 191, 'Lisandro Rosales', 5, 32, 4, NULL, NULL, '2024-12-08 13:33:01', '2024-12-08 13:33:01'),
(935, 192, 'Chaim Riviera', 14, 36, 3, 'Intern', '11974', '2024-12-08 13:33:01', '2024-12-08 13:33:01'),
(936, 192, 'Malika Riviera', 2, 22, 2, 'Photographer', '20097', '2024-12-08 13:33:01', '2024-12-08 13:33:01'),
(937, 192, 'Neha Riviera', 14, 77, 2, NULL, NULL, '2024-12-08 13:33:01', '2024-12-08 13:33:01'),
(938, 192, 'Keith Riviera', 11, 83, 4, NULL, NULL, '2024-12-08 13:33:01', '2024-12-08 13:33:01'),
(939, 192, 'Sam Riviera', 9, 27, 2, 'Virtual Assistant', '17510', '2024-12-08 13:33:01', '2024-12-08 13:33:01'),
(940, 193, 'Liam Valenzuela', 2, 27, 4, NULL, NULL, '2024-12-08 13:33:01', '2024-12-08 13:33:01'),
(941, 193, 'Evan Valenzuela', 7, 49, 1, 'Software Developer', '71794', '2024-12-08 13:33:01', '2024-12-08 13:33:01'),
(942, 194, 'Orpha Santiago', 15, 79, 4, NULL, NULL, '2024-12-08 13:33:01', '2024-12-08 13:33:01'),
(943, 194, 'Yvette Santiago', 16, 19, 1, 'Virtual Assistant', '17426', '2024-12-08 13:33:01', '2024-12-08 13:33:01'),
(944, 194, 'Sibyl Santiago', 12, 55, 3, NULL, NULL, '2024-12-08 13:33:01', '2024-12-08 13:33:01'),
(945, 194, 'Pierre Santiago', 17, 98, 3, NULL, NULL, '2024-12-08 13:33:02', '2024-12-08 13:33:02'),
(946, 194, 'Lula Santiago', 1, 21, 1, NULL, NULL, '2024-12-08 13:33:02', '2024-12-08 13:33:02'),
(947, 194, 'Myrtie Santiago', 9, 30, 2, 'Musician', '14601', '2024-12-08 13:33:02', '2024-12-08 13:33:02'),
(948, 194, 'Jarrell Santiago', 17, 51, 3, 'Graphic Designer', '21601', '2024-12-08 13:33:02', '2024-12-08 13:33:02'),
(949, 194, 'Oleta Santiago', 1, 6, 1, 'Student', '0', '2024-12-08 13:33:02', '2024-12-08 13:33:02'),
(950, 194, 'Lambert Santiago', 11, 83, 3, NULL, NULL, '2024-12-08 13:33:02', '2024-12-08 13:33:02'),
(951, 194, 'Travis Santiago', 3, 59, 3, NULL, NULL, '2024-12-08 13:33:02', '2024-12-08 13:33:02'),
(952, 195, 'Marcelino San Pedro', 18, 57, 2, NULL, NULL, '2024-12-08 13:33:02', '2024-12-08 13:33:02'),
(953, 195, 'Quentin San Pedro', 7, 70, 4, NULL, NULL, '2024-12-08 13:33:02', '2024-12-08 13:33:02'),
(954, 195, 'Kenya San Pedro', 13, 40, 1, NULL, NULL, '2024-12-08 13:33:02', '2024-12-08 13:33:02'),
(955, 195, 'Verda San Pedro', 5, 97, 2, NULL, NULL, '2024-12-08 13:33:02', '2024-12-08 13:33:02'),
(956, 195, 'Orion San Pedro', 13, 78, 4, 'Retired', '0', '2024-12-08 13:33:02', '2024-12-08 13:33:02'),
(957, 195, 'Hector San Pedro', 2, 25, 3, 'Graphic Designer', '34929', '2024-12-08 13:33:02', '2024-12-08 13:33:02'),
(958, 195, 'Monica San Pedro', 11, 98, 2, NULL, NULL, '2024-12-08 13:33:02', '2024-12-08 13:33:02'),
(959, 195, 'Adell San Pedro', 15, 79, 4, 'Consultant', '57804', '2024-12-08 13:33:03', '2024-12-08 13:33:03'),
(960, 196, 'Kiana Tonio', 8, 22, 1, 'Freelancer', '21710', '2024-12-08 13:33:03', '2024-12-08 13:33:03'),
(961, 196, 'Joshua Tonio', 16, 16, 1, 'Student', '0', '2024-12-08 13:33:03', '2024-12-08 13:33:03'),
(962, 196, 'Annie Tonio', 2, 19, 4, 'Graphic Designer', '30929', '2024-12-08 13:33:03', '2024-12-08 13:33:03'),
(963, 196, 'Prudence Tonio', 10, 64, 4, NULL, NULL, '2024-12-08 13:33:03', '2024-12-08 13:33:03'),
(964, 196, 'Immanuel Tonio', 5, 47, 2, 'Artist', '11877', '2024-12-08 13:33:03', '2024-12-08 13:33:03'),
(965, 197, 'Ona De la Vega', 8, 27, 2, 'Social Media Manager', '31237', '2024-12-08 13:33:04', '2024-12-08 13:33:04'),
(966, 197, 'Madeline De la Vega', 9, 9, 1, 'Student', '0', '2024-12-08 13:33:04', '2024-12-08 13:33:04'),
(967, 197, 'Zelma De la Vega', 1, 6, 1, 'Student', '0', '2024-12-08 13:33:05', '2024-12-08 13:33:05'),
(968, 197, 'Jadon De la Vega', 7, 79, 2, NULL, NULL, '2024-12-08 13:33:05', '2024-12-08 13:33:05'),
(969, 197, 'Frederic De la Vega', 15, 41, 3, NULL, NULL, '2024-12-08 13:33:05', '2024-12-08 13:33:05'),
(970, 197, 'Alexander De la Vega', 6, 33, 3, 'Content Creator', '20784', '2024-12-08 13:33:05', '2024-12-08 13:33:05'),
(971, 197, 'Stephania De la Vega', 6, 52, 4, NULL, NULL, '2024-12-08 13:33:05', '2024-12-08 13:33:05'),
(972, 197, 'Katelin De la Vega', 10, 69, 3, NULL, NULL, '2024-12-08 13:33:05', '2024-12-08 13:33:05'),
(973, 197, 'Nikita De la Vega', 4, 85, 4, NULL, NULL, '2024-12-08 13:33:05', '2024-12-08 13:33:05'),
(974, 197, 'Caden De la Vega', 1, 28, 4, 'Graphic Designer', '24611', '2024-12-08 13:33:05', '2024-12-08 13:33:05'),
(975, 198, 'Erik Suarez', 16, 19, 3, 'Content Creator', '25209', '2024-12-08 13:33:05', '2024-12-08 13:33:05'),
(976, 199, 'Damion Mendoza', 15, 45, 1, 'Content Creator', '9582', '2024-12-08 13:33:05', '2024-12-08 13:33:05'),
(977, 199, 'Nellie Mendoza', 6, 48, 4, 'Social Media Manager', '25913', '2024-12-08 13:33:05', '2024-12-08 13:33:05'),
(978, 199, 'Flo Mendoza', 17, 48, 2, NULL, NULL, '2024-12-08 13:33:05', '2024-12-08 13:33:05'),
(979, 200, 'Izaiah Villafuerte', 2, 12, 1, 'Student', '0', '2024-12-08 13:33:05', '2024-12-08 13:33:05'),
(980, 200, 'Brenden Villafuerte', 6, 41, 1, NULL, NULL, '2024-12-08 13:33:05', '2024-12-08 13:33:05'),
(981, 200, 'Cyrus Villafuerte', 14, 30, 2, 'Salesperson', '24785', '2024-12-08 13:33:06', '2024-12-08 13:33:06'),
(982, 200, 'Maximillia Villafuerte', 18, 39, 1, NULL, NULL, '2024-12-08 13:33:06', '2024-12-08 13:33:06'),
(983, 200, 'Adolphus Villafuerte', 9, 19, 3, 'Part-time Job', NULL, '2024-12-08 13:33:06', '2024-12-08 13:33:06'),
(984, 200, 'Flo Villafuerte', 14, 63, 4, NULL, NULL, '2024-12-08 13:33:06', '2024-12-08 13:33:06'),
(985, 200, 'Krista Villafuerte', 8, 38, 3, 'Nanny', '16888', '2024-12-08 13:33:06', '2024-12-08 13:33:06'),
(986, 200, 'Thora Villafuerte', 12, 86, 2, NULL, NULL, '2024-12-08 13:33:06', '2024-12-08 13:33:06');

-- --------------------------------------------------------

--
-- Table structure for table `how_much_income_list`
--

CREATE TABLE `how_much_income_list` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `how_much_income` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `how_much_income_list`
--

INSERT INTO `how_much_income_list` (`id`, `how_much_income`, `created_at`, `updated_at`) VALUES
(1, 'Below 1000 PHP', NULL, NULL),
(2, '1,000 - 2,000 PHP', NULL, NULL),
(3, '2,001 - 5,000 PHP', NULL, NULL),
(4, '5,001 - 10,000 PHP', NULL, NULL),
(5, '10,001 - 15,000 PHP', NULL, NULL),
(6, '15,001 - 20,000 PHP', NULL, NULL),
(7, '20,001 - 30,000 PHP', NULL, NULL),
(8, '30,001 - 50,000 PHP', NULL, NULL),
(9, '50,001 - 75,000 PHP', NULL, NULL),
(10, '75,001 - 100,000 PHP', NULL, NULL),
(11, 'Above 100,000 PHP', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `how_much_pension_list`
--

CREATE TABLE `how_much_pension_list` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `how_much_pension` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `how_much_pension_list`
--

INSERT INTO `how_much_pension_list` (`id`, `how_much_pension`, `created_at`, `updated_at`) VALUES
(1, 'Below 1000 PHP', NULL, NULL),
(2, '1,000 - 2,000 PHP', NULL, NULL),
(3, '2,001 - 3,000 PHP', NULL, NULL),
(4, '3,001 - 4,000 PHP', NULL, NULL),
(5, '4,001 - 5,000 PHP', NULL, NULL),
(6, '5,001 - 6,000 PHP', NULL, NULL),
(7, '6,001 - 7,000 PHP', NULL, NULL),
(8, '7,001 - 8,000 PHP', NULL, NULL),
(9, '8,001 - 9,000 PHP', NULL, NULL),
(10, '9,001 - 10,000 PHP', NULL, NULL),
(11, 'Above 10,000 PHP', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `income_source`
--

CREATE TABLE `income_source` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `senior_id` bigint(20) UNSIGNED DEFAULT NULL,
  `income_source_id` bigint(20) UNSIGNED DEFAULT NULL,
  `other_income_source_remark` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `income_source`
--

INSERT INTO `income_source` (`id`, `senior_id`, `income_source_id`, `other_income_source_remark`, `created_at`, `updated_at`) VALUES
(1, 2, 4, NULL, '2024-12-08 13:33:06', '2024-12-08 13:33:06'),
(2, 2, 1, NULL, '2024-12-08 13:33:06', '2024-12-08 13:33:06'),
(3, 2, 5, NULL, '2024-12-08 13:33:07', '2024-12-08 13:33:07'),
(4, 6, 1, NULL, '2024-12-08 13:33:07', '2024-12-08 13:33:07'),
(5, 6, 2, NULL, '2024-12-08 13:33:07', '2024-12-08 13:33:07'),
(6, 7, 3, NULL, '2024-12-08 13:33:07', '2024-12-08 13:33:07'),
(7, 7, 4, NULL, '2024-12-08 13:33:07', '2024-12-08 13:33:07'),
(8, 7, 6, 'Paghahabi', '2024-12-08 13:33:07', '2024-12-08 13:33:07'),
(9, 9, 1, NULL, '2024-12-08 13:33:07', '2024-12-08 13:33:07'),
(10, 9, 6, 'Pagmimina', '2024-12-08 13:33:07', '2024-12-08 13:33:07'),
(11, 13, 6, 'Pagbalot ng prutas at gulay', '2024-12-08 13:33:08', '2024-12-08 13:33:08'),
(12, 19, 2, NULL, '2024-12-08 13:33:09', '2024-12-08 13:33:09'),
(13, 22, 6, 'Online Selling', '2024-12-08 13:33:09', '2024-12-08 13:33:09'),
(14, 27, 4, NULL, '2024-12-08 13:33:09', '2024-12-08 13:33:09'),
(15, 27, 3, NULL, '2024-12-08 13:33:09', '2024-12-08 13:33:09'),
(16, 28, 5, NULL, '2024-12-08 13:33:09', '2024-12-08 13:33:09'),
(17, 31, 6, 'Pagtuturo', '2024-12-08 13:33:09', '2024-12-08 13:33:09'),
(18, 31, 4, NULL, '2024-12-08 13:33:10', '2024-12-08 13:33:10'),
(19, 31, 3, NULL, '2024-12-08 13:33:10', '2024-12-08 13:33:10'),
(20, 32, 2, NULL, '2024-12-08 13:33:10', '2024-12-08 13:33:10'),
(21, 32, 6, 'Paghahabi', '2024-12-08 13:33:10', '2024-12-08 13:33:10'),
(22, 34, 4, NULL, '2024-12-08 13:33:11', '2024-12-08 13:33:11'),
(23, 34, 2, NULL, '2024-12-08 13:33:11', '2024-12-08 13:33:11'),
(24, 34, 6, 'Pangingisda', '2024-12-08 13:33:11', '2024-12-08 13:33:11'),
(25, 36, 1, NULL, '2024-12-08 13:33:11', '2024-12-08 13:33:11'),
(26, 36, 5, NULL, '2024-12-08 13:33:11', '2024-12-08 13:33:11'),
(27, 36, 4, NULL, '2024-12-08 13:33:12', '2024-12-08 13:33:12'),
(28, 37, 4, NULL, '2024-12-08 13:33:12', '2024-12-08 13:33:12'),
(29, 39, 6, 'Pagbalot ng prutas at gulay', '2024-12-08 13:33:12', '2024-12-08 13:33:12'),
(30, 39, 2, NULL, '2024-12-08 13:33:12', '2024-12-08 13:33:12'),
(31, 39, 1, NULL, '2024-12-08 13:33:12', '2024-12-08 13:33:12'),
(32, 42, 4, NULL, '2024-12-08 13:33:12', '2024-12-08 13:33:12'),
(33, 42, 2, NULL, '2024-12-08 13:33:13', '2024-12-08 13:33:13'),
(34, 42, 5, NULL, '2024-12-08 13:33:13', '2024-12-08 13:33:13'),
(35, 44, 5, NULL, '2024-12-08 13:33:13', '2024-12-08 13:33:13'),
(36, 44, 6, 'Paghahabi', '2024-12-08 13:33:13', '2024-12-08 13:33:13'),
(37, 44, 3, NULL, '2024-12-08 13:33:13', '2024-12-08 13:33:13'),
(38, 45, 1, NULL, '2024-12-08 13:33:13', '2024-12-08 13:33:13'),
(39, 46, 6, 'Pagbalot ng prutas at gulay', '2024-12-08 13:33:14', '2024-12-08 13:33:14'),
(40, 46, 5, NULL, '2024-12-08 13:33:14', '2024-12-08 13:33:14'),
(41, 47, 5, NULL, '2024-12-08 13:33:14', '2024-12-08 13:33:14'),
(42, 48, 5, NULL, '2024-12-08 13:33:14', '2024-12-08 13:33:14'),
(43, 50, 6, 'Paghahabi', '2024-12-08 13:33:15', '2024-12-08 13:33:15'),
(44, 50, 4, NULL, '2024-12-08 13:33:15', '2024-12-08 13:33:15'),
(45, 50, 2, NULL, '2024-12-08 13:33:15', '2024-12-08 13:33:15'),
(46, 55, 4, NULL, '2024-12-08 13:33:16', '2024-12-08 13:33:16'),
(47, 55, 5, NULL, '2024-12-08 13:33:16', '2024-12-08 13:33:16'),
(48, 56, 2, NULL, '2024-12-08 13:33:16', '2024-12-08 13:33:16'),
(49, 57, 1, NULL, '2024-12-08 13:33:16', '2024-12-08 13:33:16'),
(50, 58, 1, NULL, '2024-12-08 13:33:17', '2024-12-08 13:33:17'),
(51, 58, 4, NULL, '2024-12-08 13:33:17', '2024-12-08 13:33:17'),
(52, 58, 3, NULL, '2024-12-08 13:33:17', '2024-12-08 13:33:17'),
(53, 60, 4, NULL, '2024-12-08 13:33:18', '2024-12-08 13:33:18'),
(54, 63, 4, NULL, '2024-12-08 13:33:18', '2024-12-08 13:33:18'),
(55, 63, 5, NULL, '2024-12-08 13:33:18', '2024-12-08 13:33:18'),
(56, 64, 1, NULL, '2024-12-08 13:33:18', '2024-12-08 13:33:18'),
(57, 64, 5, NULL, '2024-12-08 13:33:18', '2024-12-08 13:33:18'),
(58, 67, 5, NULL, '2024-12-08 13:33:18', '2024-12-08 13:33:18'),
(59, 67, 3, NULL, '2024-12-08 13:33:18', '2024-12-08 13:33:18'),
(60, 68, 1, NULL, '2024-12-08 13:33:18', '2024-12-08 13:33:18'),
(61, 70, 4, NULL, '2024-12-08 13:33:19', '2024-12-08 13:33:19'),
(62, 70, 6, 'Pagbalot ng prutas at gulay', '2024-12-08 13:33:19', '2024-12-08 13:33:19'),
(63, 72, 2, NULL, '2024-12-08 13:33:19', '2024-12-08 13:33:19'),
(64, 72, 6, 'Pagtuturo', '2024-12-08 13:33:19', '2024-12-08 13:33:19'),
(65, 73, 5, NULL, '2024-12-08 13:33:19', '2024-12-08 13:33:19'),
(66, 74, 2, NULL, '2024-12-08 13:33:19', '2024-12-08 13:33:19'),
(67, 75, 3, NULL, '2024-12-08 13:33:19', '2024-12-08 13:33:19'),
(68, 75, 6, 'Paghahabi', '2024-12-08 13:33:19', '2024-12-08 13:33:19'),
(69, 77, 6, 'Pagsasaka', '2024-12-08 13:33:20', '2024-12-08 13:33:20'),
(70, 77, 4, NULL, '2024-12-08 13:33:20', '2024-12-08 13:33:20'),
(71, 77, 5, NULL, '2024-12-08 13:33:20', '2024-12-08 13:33:20'),
(72, 78, 1, NULL, '2024-12-08 13:33:20', '2024-12-08 13:33:20'),
(73, 78, 2, NULL, '2024-12-08 13:33:20', '2024-12-08 13:33:20'),
(74, 79, 1, NULL, '2024-12-08 13:33:20', '2024-12-08 13:33:20'),
(75, 79, 5, NULL, '2024-12-08 13:33:20', '2024-12-08 13:33:20'),
(76, 79, 2, NULL, '2024-12-08 13:33:21', '2024-12-08 13:33:21'),
(77, 80, 2, NULL, '2024-12-08 13:33:21', '2024-12-08 13:33:21'),
(78, 82, 5, NULL, '2024-12-08 13:33:21', '2024-12-08 13:33:21'),
(79, 82, 4, NULL, '2024-12-08 13:33:21', '2024-12-08 13:33:21'),
(80, 84, 2, NULL, '2024-12-08 13:33:21', '2024-12-08 13:33:21'),
(81, 86, 5, NULL, '2024-12-08 13:33:21', '2024-12-08 13:33:21'),
(82, 88, 6, 'Pangingisda', '2024-12-08 13:33:21', '2024-12-08 13:33:21'),
(83, 88, 1, NULL, '2024-12-08 13:33:21', '2024-12-08 13:33:21'),
(84, 91, 6, 'Pagmimina', '2024-12-08 13:33:22', '2024-12-08 13:33:22'),
(85, 91, 1, NULL, '2024-12-08 13:33:22', '2024-12-08 13:33:22'),
(86, 91, 2, NULL, '2024-12-08 13:33:22', '2024-12-08 13:33:22'),
(87, 92, 1, NULL, '2024-12-08 13:33:23', '2024-12-08 13:33:23'),
(88, 92, 4, NULL, '2024-12-08 13:33:23', '2024-12-08 13:33:23'),
(89, 92, 6, 'Pangingisda', '2024-12-08 13:33:23', '2024-12-08 13:33:23'),
(90, 93, 1, NULL, '2024-12-08 13:33:23', '2024-12-08 13:33:23'),
(91, 96, 5, NULL, '2024-12-08 13:33:23', '2024-12-08 13:33:23'),
(92, 96, 2, NULL, '2024-12-08 13:33:23', '2024-12-08 13:33:23'),
(93, 96, 6, 'Pagtuturo', '2024-12-08 13:33:23', '2024-12-08 13:33:23'),
(94, 97, 4, NULL, '2024-12-08 13:33:23', '2024-12-08 13:33:23'),
(95, 97, 2, NULL, '2024-12-08 13:33:23', '2024-12-08 13:33:23'),
(96, 97, 3, NULL, '2024-12-08 13:33:24', '2024-12-08 13:33:24'),
(97, 98, 5, NULL, '2024-12-08 13:33:24', '2024-12-08 13:33:24'),
(98, 98, 6, 'Pagsasaka', '2024-12-08 13:33:24', '2024-12-08 13:33:24'),
(99, 99, 2, NULL, '2024-12-08 13:33:24', '2024-12-08 13:33:24'),
(100, 99, 5, NULL, '2024-12-08 13:33:24', '2024-12-08 13:33:24'),
(101, 103, 2, NULL, '2024-12-08 13:33:24', '2024-12-08 13:33:24'),
(102, 103, 4, NULL, '2024-12-08 13:33:24', '2024-12-08 13:33:24'),
(103, 105, 5, NULL, '2024-12-08 13:33:25', '2024-12-08 13:33:25'),
(104, 105, 4, NULL, '2024-12-08 13:33:25', '2024-12-08 13:33:25'),
(105, 105, 2, NULL, '2024-12-08 13:33:25', '2024-12-08 13:33:25'),
(106, 106, 4, NULL, '2024-12-08 13:33:25', '2024-12-08 13:33:25'),
(107, 110, 6, 'Pangingisda', '2024-12-08 13:33:25', '2024-12-08 13:33:25'),
(108, 111, 3, NULL, '2024-12-08 13:33:25', '2024-12-08 13:33:25'),
(109, 112, 6, 'Pagtuturo', '2024-12-08 13:33:25', '2024-12-08 13:33:25'),
(110, 114, 3, NULL, '2024-12-08 13:33:26', '2024-12-08 13:33:26'),
(111, 114, 4, NULL, '2024-12-08 13:33:26', '2024-12-08 13:33:26'),
(112, 114, 6, 'Pangingisda', '2024-12-08 13:33:26', '2024-12-08 13:33:26'),
(113, 115, 2, NULL, '2024-12-08 13:33:26', '2024-12-08 13:33:26'),
(114, 115, 1, NULL, '2024-12-08 13:33:26', '2024-12-08 13:33:26'),
(115, 117, 3, NULL, '2024-12-08 13:33:26', '2024-12-08 13:33:26'),
(116, 118, 6, 'Pangingisda', '2024-12-08 13:33:26', '2024-12-08 13:33:26'),
(117, 118, 3, NULL, '2024-12-08 13:33:26', '2024-12-08 13:33:26'),
(118, 122, 2, NULL, '2024-12-08 13:33:27', '2024-12-08 13:33:27'),
(119, 125, 3, NULL, '2024-12-08 13:33:27', '2024-12-08 13:33:27'),
(120, 125, 4, NULL, '2024-12-08 13:33:27', '2024-12-08 13:33:27'),
(121, 125, 6, 'Pangingisda', '2024-12-08 13:33:27', '2024-12-08 13:33:27'),
(122, 132, 2, NULL, '2024-12-08 13:33:27', '2024-12-08 13:33:27'),
(123, 132, 1, NULL, '2024-12-08 13:33:27', '2024-12-08 13:33:27'),
(124, 134, 5, NULL, '2024-12-08 13:33:27', '2024-12-08 13:33:27'),
(125, 134, 1, NULL, '2024-12-08 13:33:27', '2024-12-08 13:33:27'),
(126, 134, 4, NULL, '2024-12-08 13:33:28', '2024-12-08 13:33:28'),
(127, 136, 2, NULL, '2024-12-08 13:33:28', '2024-12-08 13:33:28'),
(128, 136, 6, 'Pagbalot ng prutas at gulay', '2024-12-08 13:33:29', '2024-12-08 13:33:29'),
(129, 136, 3, NULL, '2024-12-08 13:33:29', '2024-12-08 13:33:29'),
(130, 137, 2, NULL, '2024-12-08 13:33:29', '2024-12-08 13:33:29'),
(131, 137, 1, NULL, '2024-12-08 13:33:29', '2024-12-08 13:33:29'),
(132, 139, 2, NULL, '2024-12-08 13:33:29', '2024-12-08 13:33:29'),
(133, 139, 6, 'Pagtuturo', '2024-12-08 13:33:29', '2024-12-08 13:33:29'),
(134, 140, 3, NULL, '2024-12-08 13:33:29', '2024-12-08 13:33:29'),
(135, 140, 4, NULL, '2024-12-08 13:33:29', '2024-12-08 13:33:29'),
(136, 142, 6, 'Online Selling', '2024-12-08 13:33:29', '2024-12-08 13:33:29'),
(137, 142, 2, NULL, '2024-12-08 13:33:29', '2024-12-08 13:33:29'),
(138, 143, 6, 'Pagsasaka', '2024-12-08 13:33:30', '2024-12-08 13:33:30'),
(139, 143, 4, NULL, '2024-12-08 13:33:30', '2024-12-08 13:33:30'),
(140, 147, 3, NULL, '2024-12-08 13:33:30', '2024-12-08 13:33:30'),
(141, 150, 6, 'Online Selling', '2024-12-08 13:33:30', '2024-12-08 13:33:30'),
(142, 150, 5, NULL, '2024-12-08 13:33:30', '2024-12-08 13:33:30'),
(143, 150, 3, NULL, '2024-12-08 13:33:30', '2024-12-08 13:33:30'),
(144, 151, 6, 'Online Selling', '2024-12-08 13:33:30', '2024-12-08 13:33:30'),
(145, 154, 3, NULL, '2024-12-08 13:33:30', '2024-12-08 13:33:30'),
(146, 154, 5, NULL, '2024-12-08 13:33:30', '2024-12-08 13:33:30'),
(147, 154, 6, 'Pagtuturo', '2024-12-08 13:33:30', '2024-12-08 13:33:30'),
(148, 155, 6, 'Pangingisda', '2024-12-08 13:33:30', '2024-12-08 13:33:30'),
(149, 155, 3, NULL, '2024-12-08 13:33:31', '2024-12-08 13:33:31'),
(150, 156, 2, NULL, '2024-12-08 13:33:31', '2024-12-08 13:33:31'),
(151, 156, 3, NULL, '2024-12-08 13:33:31', '2024-12-08 13:33:31'),
(152, 157, 6, 'Pangingisda', '2024-12-08 13:33:31', '2024-12-08 13:33:31'),
(153, 158, 6, 'Pagmimina', '2024-12-08 13:33:31', '2024-12-08 13:33:31'),
(154, 159, 5, NULL, '2024-12-08 13:33:31', '2024-12-08 13:33:31'),
(155, 159, 3, NULL, '2024-12-08 13:33:31', '2024-12-08 13:33:31'),
(156, 161, 4, NULL, '2024-12-08 13:33:31', '2024-12-08 13:33:31'),
(157, 161, 6, 'Pagmimina', '2024-12-08 13:33:31', '2024-12-08 13:33:31'),
(158, 162, 3, NULL, '2024-12-08 13:33:31', '2024-12-08 13:33:31'),
(159, 162, 2, NULL, '2024-12-08 13:33:32', '2024-12-08 13:33:32'),
(160, 163, 4, NULL, '2024-12-08 13:33:32', '2024-12-08 13:33:32'),
(161, 163, 3, NULL, '2024-12-08 13:33:32', '2024-12-08 13:33:32'),
(162, 163, 1, NULL, '2024-12-08 13:33:32', '2024-12-08 13:33:32'),
(163, 165, 5, NULL, '2024-12-08 13:33:32', '2024-12-08 13:33:32'),
(164, 165, 1, NULL, '2024-12-08 13:33:32', '2024-12-08 13:33:32'),
(165, 165, 4, NULL, '2024-12-08 13:33:32', '2024-12-08 13:33:32'),
(166, 166, 5, NULL, '2024-12-08 13:33:32', '2024-12-08 13:33:32'),
(167, 167, 1, NULL, '2024-12-08 13:33:33', '2024-12-08 13:33:33'),
(168, 167, 6, 'Pagbalot ng prutas at gulay', '2024-12-08 13:33:33', '2024-12-08 13:33:33'),
(169, 171, 6, 'Pangingisda', '2024-12-08 13:33:33', '2024-12-08 13:33:33'),
(170, 171, 4, NULL, '2024-12-08 13:33:33', '2024-12-08 13:33:33'),
(171, 172, 6, 'Pagtuturo', '2024-12-08 13:33:33', '2024-12-08 13:33:33'),
(172, 172, 1, NULL, '2024-12-08 13:33:34', '2024-12-08 13:33:34'),
(173, 172, 2, NULL, '2024-12-08 13:33:34', '2024-12-08 13:33:34'),
(174, 174, 3, NULL, '2024-12-08 13:33:34', '2024-12-08 13:33:34'),
(175, 174, 1, NULL, '2024-12-08 13:33:34', '2024-12-08 13:33:34'),
(176, 174, 2, NULL, '2024-12-08 13:33:34', '2024-12-08 13:33:34'),
(177, 176, 6, 'Pangingisda', '2024-12-08 13:33:35', '2024-12-08 13:33:35'),
(178, 177, 4, NULL, '2024-12-08 13:33:35', '2024-12-08 13:33:35'),
(179, 177, 6, 'Pagbalot ng prutas at gulay', '2024-12-08 13:33:35', '2024-12-08 13:33:35'),
(180, 177, 2, NULL, '2024-12-08 13:33:35', '2024-12-08 13:33:35'),
(181, 178, 4, NULL, '2024-12-08 13:33:36', '2024-12-08 13:33:36'),
(182, 182, 6, 'Pagtuturo', '2024-12-08 13:33:36', '2024-12-08 13:33:36'),
(183, 182, 3, NULL, '2024-12-08 13:33:37', '2024-12-08 13:33:37'),
(184, 183, 1, NULL, '2024-12-08 13:33:37', '2024-12-08 13:33:37'),
(185, 183, 2, NULL, '2024-12-08 13:33:37', '2024-12-08 13:33:37'),
(186, 185, 6, 'Paghahabi', '2024-12-08 13:33:37', '2024-12-08 13:33:37'),
(187, 186, 5, NULL, '2024-12-08 13:33:37', '2024-12-08 13:33:37'),
(188, 186, 2, NULL, '2024-12-08 13:33:37', '2024-12-08 13:33:37'),
(189, 187, 6, 'Paghahabi', '2024-12-08 13:33:37', '2024-12-08 13:33:37'),
(190, 187, 3, NULL, '2024-12-08 13:33:38', '2024-12-08 13:33:38'),
(191, 189, 6, 'Pagtuturo', '2024-12-08 13:33:38', '2024-12-08 13:33:38'),
(192, 190, 2, NULL, '2024-12-08 13:33:38', '2024-12-08 13:33:38'),
(193, 190, 1, NULL, '2024-12-08 13:33:38', '2024-12-08 13:33:38'),
(194, 190, 6, 'Paghahabi', '2024-12-08 13:33:38', '2024-12-08 13:33:38'),
(195, 195, 1, NULL, '2024-12-08 13:33:38', '2024-12-08 13:33:38'),
(196, 198, 3, NULL, '2024-12-08 13:33:38', '2024-12-08 13:33:38');

-- --------------------------------------------------------

--
-- Table structure for table `living_arrangement_list`
--

CREATE TABLE `living_arrangement_list` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `type_of_living_arrangement_list` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `living_arrangement_list`
--

INSERT INTO `living_arrangement_list` (`id`, `type_of_living_arrangement_list`, `created_at`, `updated_at`) VALUES
(1, 'Owned', NULL, NULL),
(2, 'Living Alone', NULL, NULL),
(3, 'Living with Relatives', NULL, NULL),
(4, 'Rent', NULL, NULL),
(5, 'Others', NULL, NULL);

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
(1, '0001_01_01_000001_create_cache_table', 1),
(2, '2024_10_15_0084912_CreateSeniors_how_much_pension_list_table', 1),
(3, '2024_10_15_0084913_CreateSeniors_how_much_income_list_table', 1),
(4, '2024_10_15_0084914_CreateSeniors_where_income_source_list_table', 1),
(5, '2024_10_15_0084915_CreateSenior_senior_application_status_list_table', 1),
(6, '2024_10_15_0084916_CreateSenior_senior_account_status_list_table', 1),
(7, '2024_10_15_071512_CreateContactUs_contact_us_table', 1),
(8, '2024_10_15_071512_CreateUserType_user_type_list_table', 1),
(9, '2024_10_15_071647_CreateSeniors_barangay_list_table', 1),
(10, '2024_10_15_075530_CreateSeniors_living_arrangement_list_table', 1),
(11, '2024_10_15_075531_CreateSeniors_relationship_list_table', 1),
(12, '2024_10_15_075750_CreateSeniors_source_list_table', 1),
(13, '2024_10_15_083843_CreateSeniors_sex_list_table', 1),
(14, '2024_10_15_083912_CreateSeniors_civil_status_list_table', 1),
(15, '2024_10_15_103912_CreateSeniors_seniors_table', 1),
(16, '2024_10_19_084431_CreateSeniors_source_table', 1),
(17, '2024_10_19_084432_CreateSeniors_income_source_table', 1),
(18, '2024_10_19_084433_CreateSeniors_senior_guardian_table', 1),
(19, '2024_10_20_084431_CreateSeniors_family_composition_table', 1),
(20, '2024_10_20_084432_CreateSenior_senior_login_attempts_table', 1),
(21, '2024_11_04_031423_CreateEncoder_encoder_table', 1),
(22, '2024_11_04_031424_CreateEncoder_encoder_login_attempts_table', 1),
(23, '2024_11_04_031425_CreateEncoder_encoder_roles_list_table', 1),
(24, '2024_11_04_031426_CreateEncoder_encoder_roles_table', 1),
(25, '2024_11_08_083412_CreateAdmin_admin_table', 1),
(26, '2024_11_08_143040_CreateAdmin_admin_login_attempts_table', 1),
(27, '2024_11_08_143041_CreatePensionDistribution_pension_distribution_list_table', 1),
(28, '2024_11_29_055256_create_personal_access_tokens_table', 1);

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
-- Table structure for table `pension_distribution_list`
--

CREATE TABLE `pension_distribution_list` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `barangay_id` bigint(20) UNSIGNED DEFAULT NULL,
  `venue` varchar(255) DEFAULT NULL,
  `date_of_distribution` datetime DEFAULT NULL,
  `pension_user_type_id` bigint(20) UNSIGNED DEFAULT NULL,
  `pension_encoder_id` bigint(20) UNSIGNED DEFAULT NULL,
  `pension_admin_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pension_distribution_list`
--

INSERT INTO `pension_distribution_list` (`id`, `barangay_id`, `venue`, `date_of_distribution`, `pension_user_type_id`, `pension_encoder_id`, `pension_admin_id`, `created_at`, `updated_at`) VALUES
(1, 14, 'Open Basketball Court', '2024-11-01 08:00:00', 3, NULL, 1, NULL, NULL),
(2, 29, 'Municipal Training Center', '2024-11-02 08:30:00', 2, 5, NULL, NULL, NULL),
(3, 29, 'Barangay Covered Walkway', '2024-11-03 09:50:00', 3, NULL, 1, NULL, NULL),
(4, 29, 'Barangay Satellite Office', '2024-11-04 09:40:00', 2, 28, NULL, NULL, NULL),
(5, 25, 'Barangay Covered Walkway', '2024-11-05 08:50:00', 2, 19, NULL, NULL, NULL),
(6, 25, 'Community Health Office', '2024-11-06 09:10:00', 3, NULL, 1, NULL, NULL),
(7, 25, 'City Plaza', '2024-11-07 09:40:00', 3, NULL, 1, NULL, NULL),
(8, 19, 'Municipal Auditorium', '2024-11-08 09:50:00', 3, NULL, 1, NULL, NULL),
(9, 19, 'Community Gymnasium', '2024-11-09 08:00:00', 2, 16, NULL, NULL, NULL),
(10, 19, 'Park Pavilion', '2024-11-10 09:40:00', 3, NULL, 1, NULL, NULL),
(11, 9, 'Municipal Civic Center', '2024-11-11 09:00:00', 3, NULL, 1, NULL, NULL),
(12, 9, 'Community Gymnasium', '2024-11-12 09:50:00', 2, 13, NULL, NULL, NULL),
(13, 10, 'Senior Citizen Activity Center', '2024-11-13 08:50:00', 2, 27, NULL, NULL, NULL),
(14, 10, 'Barangay Covered Walkway', '2024-11-14 08:40:00', 2, 16, NULL, NULL, NULL),
(15, 10, 'Municipal Training Center', '2024-11-15 08:20:00', 3, NULL, 1, NULL, NULL),
(16, 23, 'Municipal Training Center', '2024-11-16 09:10:00', 2, 28, NULL, NULL, NULL),
(17, 23, 'Barangay Clustered Gym', '2024-11-17 09:10:00', 2, 10, NULL, NULL, NULL),
(18, 6, 'Public School Gymnasium', '2024-11-18 09:40:00', 3, NULL, 1, NULL, NULL),
(19, 6, 'Health Center', '2024-11-19 09:20:00', 3, NULL, 1, NULL, NULL),
(20, 3, 'Park Pavilion', '2024-11-20 08:50:00', 2, 17, NULL, NULL, NULL),
(21, 3, 'Public School Gymnasium', '2024-11-21 08:20:00', 2, 15, NULL, NULL, NULL),
(22, 7, 'Sports Complex', '2024-11-22 08:40:00', 2, 21, NULL, NULL, NULL),
(23, 10, 'Municipal Training Center', '2024-11-23 09:10:00', 3, NULL, 1, NULL, NULL),
(24, 10, 'Public School Gymnasium', '2024-11-24 09:00:00', 3, NULL, 1, NULL, NULL),
(25, 10, 'Open Basketball Court', '2024-11-25 08:40:00', 3, NULL, 1, NULL, NULL),
(26, 20, 'Municipal Covered Gym', '2024-11-26 09:10:00', 2, 10, NULL, NULL, NULL),
(27, 16, 'Senior Citizen Hall', '2024-11-27 08:10:00', 2, 9, NULL, NULL, NULL),
(28, 16, 'Community Gymnasium', '2024-11-28 09:30:00', 3, NULL, 1, NULL, NULL),
(29, 16, 'Health Center', '2024-11-29 08:20:00', 3, NULL, 1, NULL, NULL),
(30, 24, 'Barangay Clustered Gym', '2024-11-30 08:30:00', 2, 25, NULL, NULL, NULL),
(31, 20, 'Recreation Center', '2024-12-01 08:30:00', 3, NULL, 1, NULL, NULL),
(32, 20, 'Sports Complex', '2024-12-02 09:20:00', 3, NULL, 1, NULL, NULL),
(33, 1, 'Town Hall', '2024-12-03 08:50:00', 3, NULL, 1, NULL, NULL),
(34, 22, 'Municipal Auditorium', '2024-12-04 09:40:00', 3, NULL, 1, NULL, NULL),
(35, 22, 'Public Library Hall', '2024-12-05 09:20:00', 3, NULL, 1, NULL, NULL),
(36, 22, 'Open Basketball Court', '2024-12-06 08:00:00', 2, 21, NULL, NULL, NULL),
(37, 15, 'Barangay Satellite Office', '2024-12-07 09:30:00', 2, 16, NULL, NULL, NULL),
(38, 15, 'Park Pavilion', '2024-12-08 09:40:00', 3, NULL, 1, NULL, NULL),
(39, 15, 'Barangay Covered Walkway', '2024-12-09 08:10:00', 2, 7, NULL, NULL, NULL),
(40, 2, 'City Plaza', '2024-12-10 08:20:00', 3, NULL, 1, NULL, NULL),
(41, 13, 'City Plaza', '2024-12-11 09:30:00', 3, NULL, 1, NULL, NULL),
(42, 13, 'Barangay Satellite Office', '2024-12-12 08:20:00', 3, NULL, 1, NULL, NULL),
(43, 13, 'Community Health Office', '2024-12-13 09:00:00', 2, 10, NULL, NULL, NULL),
(44, 9, 'Recreation Center', '2024-12-14 08:10:00', 3, NULL, 1, NULL, NULL),
(45, 9, 'Municipal Covered Gym', '2024-12-15 08:50:00', 3, NULL, 1, NULL, NULL),
(46, 19, 'Covered Court', '2024-12-16 08:10:00', 2, 10, NULL, NULL, NULL),
(47, 19, 'Municipal Training Center', '2024-12-17 09:00:00', 2, 15, NULL, NULL, NULL),
(48, 5, 'Community Health Office', '2024-12-18 09:40:00', 2, 10, NULL, NULL, NULL),
(49, 5, 'Health Center', '2024-12-19 09:40:00', 2, 25, NULL, NULL, NULL),
(50, 13, 'Barangay Clustered Gym', '2024-12-20 08:40:00', 2, 30, NULL, NULL, NULL),
(51, 13, 'Covered Court', '2024-12-21 09:50:00', 2, 16, NULL, NULL, NULL),
(52, 13, 'Open Basketball Court', '2024-12-22 09:50:00', 3, NULL, 1, NULL, NULL),
(53, 28, 'Barangay Assembly Hall', '2024-12-23 08:50:00', 2, 8, NULL, NULL, NULL),
(54, 3, 'Recreation Center', '2024-12-24 08:20:00', 2, 24, NULL, NULL, NULL),
(55, 3, 'Covered Court', '2024-12-25 08:00:00', 2, 8, NULL, NULL, NULL),
(56, 10, 'Sports Complex', '2024-12-26 08:10:00', 3, NULL, 1, NULL, NULL),
(57, 10, 'Barangay Multi-purpose Court', '2024-12-27 08:00:00', 3, NULL, 1, NULL, NULL),
(58, 10, 'Municipal Covered Gym', '2024-12-28 08:20:00', 2, 19, NULL, NULL, NULL),
(59, 9, 'Barangay Chapel Grounds', '2024-12-29 08:20:00', 3, NULL, 1, NULL, NULL),
(60, 9, 'Barangay Covered Walkway', '2024-12-30 08:20:00', 3, NULL, 1, NULL, NULL),
(61, 9, 'Municipal Civic Center', '2024-12-31 08:00:00', 3, NULL, 1, NULL, NULL),
(62, 6, 'Health Center', '2025-01-01 08:40:00', 2, 19, NULL, NULL, NULL),
(63, 6, 'Municipal Civic Center', '2025-01-02 08:30:00', 3, NULL, 1, NULL, NULL),
(64, 26, 'Municipal Auditorium', '2025-01-03 09:10:00', 2, 4, NULL, NULL, NULL),
(65, 26, 'Barangay Chapel Grounds', '2025-01-04 09:20:00', 2, 26, NULL, NULL, NULL),
(66, 26, 'Barangay Clustered Gym', '2025-01-05 09:30:00', 2, 6, NULL, NULL, NULL),
(67, 25, 'Open Basketball Court', '2025-01-06 08:40:00', 2, 7, NULL, NULL, NULL),
(68, 25, 'Community Gymnasium', '2025-01-07 09:30:00', 3, NULL, 1, NULL, NULL),
(69, 13, 'Covered Court', '2025-01-08 09:30:00', 3, NULL, 1, NULL, NULL),
(70, 13, 'Park Pavilion', '2025-01-09 09:40:00', 3, NULL, 1, NULL, NULL),
(71, 13, 'Community Health Office', '2025-01-10 09:10:00', 3, NULL, 1, NULL, NULL),
(72, 3, 'Community Gymnasium', '2025-01-11 08:20:00', 3, NULL, 1, NULL, NULL),
(73, 7, 'Cultural Center', '2025-01-12 08:30:00', 2, 1, NULL, NULL, NULL),
(74, 7, 'Municipal Training Center', '2025-01-13 08:00:00', 3, NULL, 1, NULL, NULL),
(75, 18, 'Multi-purpose Hall', '2025-01-14 09:10:00', 2, 25, NULL, NULL, NULL),
(76, 24, 'Public Library Hall', '2025-01-15 08:40:00', 3, NULL, 1, NULL, NULL),
(77, 24, 'Covered Court', '2025-01-16 08:30:00', 3, NULL, 1, NULL, NULL),
(78, 25, 'Park Pavilion', '2025-01-17 09:50:00', 3, NULL, 1, NULL, NULL),
(79, 25, 'Barangay Multi-purpose Court', '2025-01-18 08:30:00', 3, NULL, 1, NULL, NULL),
(80, 5, 'Community Health Office', '2025-01-19 09:10:00', 2, 5, NULL, NULL, NULL),
(81, 5, 'Health Center', '2025-01-20 08:00:00', 2, 5, NULL, NULL, NULL),
(82, 5, 'Community Gymnasium', '2025-01-21 09:10:00', 3, NULL, 1, NULL, NULL),
(83, 3, 'Barangay Covered Walkway', '2025-01-22 09:00:00', 2, 6, NULL, NULL, NULL),
(84, 3, 'Senior Citizen Hall', '2025-01-23 08:20:00', 2, 24, NULL, NULL, NULL),
(85, 4, 'Recreation Center', '2025-01-24 08:00:00', 2, 24, NULL, NULL, NULL),
(86, 4, 'Multi-purpose Hall', '2025-01-25 08:30:00', 3, NULL, 1, NULL, NULL),
(87, 4, 'Barangay Chapel Grounds', '2025-01-26 08:10:00', 3, NULL, 1, NULL, NULL),
(88, 9, 'Municipal Auditorium', '2025-01-27 08:00:00', 2, 1, NULL, NULL, NULL),
(89, 2, 'Public Library Hall', '2025-01-28 08:30:00', 2, 12, NULL, NULL, NULL),
(90, 22, 'Senior Citizen Activity Center', '2025-01-29 09:00:00', 3, NULL, 1, NULL, NULL),
(91, 22, 'Public Library Hall', '2025-01-30 09:40:00', 2, 23, NULL, NULL, NULL),
(92, 5, 'Public School Gymnasium', '2025-01-31 09:40:00', 2, 17, NULL, NULL, NULL),
(93, 5, 'Municipal Auditorium', '2025-02-01 09:10:00', 3, NULL, 1, NULL, NULL),
(94, 5, 'Barangay Function Room', '2025-02-02 08:50:00', 2, 15, NULL, NULL, NULL),
(95, 8, 'Covered Court', '2025-02-03 09:50:00', 3, NULL, 1, NULL, NULL),
(96, 8, 'Community Gymnasium', '2025-02-04 09:40:00', 2, 3, NULL, NULL, NULL),
(97, 3, 'Barangay Chapel Grounds', '2025-02-05 09:20:00', 2, 21, NULL, NULL, NULL),
(98, 3, 'Community Gymnasium', '2025-02-06 09:10:00', 2, 18, NULL, NULL, NULL),
(99, 3, 'Public Library Hall', '2025-02-07 09:40:00', 2, 16, NULL, NULL, NULL),
(100, 28, 'Barangay Multi-purpose Court', '2025-02-08 08:10:00', 3, NULL, 1, NULL, NULL);

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
-- Table structure for table `relationship_list`
--

CREATE TABLE `relationship_list` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `relationship` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `relationship_list`
--

INSERT INTO `relationship_list` (`id`, `relationship`, `created_at`, `updated_at`) VALUES
(1, 'Child', NULL, NULL),
(2, 'Grandchild', NULL, NULL),
(3, 'Sibling', NULL, NULL),
(4, 'Spouse', NULL, NULL),
(5, 'Parent', NULL, NULL),
(6, 'Aunt', NULL, NULL),
(7, 'Uncle', NULL, NULL),
(8, 'Niece', NULL, NULL),
(9, 'Nephew', NULL, NULL),
(10, 'Cousin', NULL, NULL),
(11, 'Grandparent', NULL, NULL),
(12, 'Mother-in-law', NULL, NULL),
(13, 'Father-in-law', NULL, NULL),
(14, 'Brother-in-law', NULL, NULL),
(15, 'Sister-in-law', NULL, NULL),
(16, 'Stepchild', NULL, NULL),
(17, 'Stepparent', NULL, NULL),
(18, 'Stepsibling', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `seniors`
--

CREATE TABLE `seniors` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `osca_id` varchar(255) NOT NULL,
  `ncsc_rrn` varchar(255) NOT NULL,
  `application_status_id` bigint(20) UNSIGNED NOT NULL,
  `account_status_id` bigint(20) UNSIGNED DEFAULT NULL,
  `user_type_id` bigint(20) UNSIGNED NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `middle_name` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) NOT NULL,
  `suffix` varchar(255) DEFAULT NULL,
  `address` varchar(255) NOT NULL,
  `barangay_id` bigint(20) UNSIGNED NOT NULL,
  `birthdate` date NOT NULL,
  `age` int(11) NOT NULL,
  `birthplace` varchar(255) NOT NULL,
  `sex_id` bigint(20) UNSIGNED NOT NULL,
  `civil_status_id` bigint(20) UNSIGNED NOT NULL,
  `contact_no` varchar(255) NOT NULL,
  `valid_id` varchar(255) DEFAULT NULL,
  `profile_picture` varchar(255) DEFAULT NULL,
  `indigency` varchar(255) DEFAULT NULL,
  `birth_certificate` varchar(255) DEFAULT NULL,
  `signature_data` text DEFAULT NULL,
  `type_of_living_arrangement` bigint(20) UNSIGNED NOT NULL,
  `other_arrangement_remark` varchar(255) DEFAULT NULL,
  `pensioner` tinyint(4) NOT NULL DEFAULT 0,
  `if_pensioner_yes` bigint(20) UNSIGNED DEFAULT NULL,
  `permanent_source` tinyint(4) NOT NULL DEFAULT 0,
  `if_permanent_yes_income` bigint(20) UNSIGNED DEFAULT NULL,
  `has_illness` tinyint(4) NOT NULL DEFAULT 0,
  `if_illness_yes` varchar(255) DEFAULT NULL,
  `has_disability` int(11) NOT NULL,
  `if_disability_yes` varchar(255) DEFAULT NULL,
  `date_applied` date NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `verification_code` varchar(255) DEFAULT NULL,
  `verification_expires_at` datetime DEFAULT NULL,
  `verified_at` datetime DEFAULT NULL,
  `token` varchar(255) DEFAULT NULL,
  `remember_token` varchar(255) DEFAULT NULL,
  `expiration` datetime DEFAULT NULL,
  `application_assistant_id` bigint(20) UNSIGNED DEFAULT NULL,
  `application_assistant_name` varchar(255) DEFAULT NULL,
  `registration_assistant_id` bigint(20) UNSIGNED DEFAULT NULL,
  `registration_assistant_name` varchar(255) DEFAULT NULL,
  `date_approved` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `seniors`
--

INSERT INTO `seniors` (`id`, `osca_id`, `ncsc_rrn`, `application_status_id`, `account_status_id`, `user_type_id`, `first_name`, `middle_name`, `last_name`, `suffix`, `address`, `barangay_id`, `birthdate`, `age`, `birthplace`, `sex_id`, `civil_status_id`, `contact_no`, `valid_id`, `profile_picture`, `indigency`, `birth_certificate`, `signature_data`, `type_of_living_arrangement`, `other_arrangement_remark`, `pensioner`, `if_pensioner_yes`, `permanent_source`, `if_permanent_yes_income`, `has_illness`, `if_illness_yes`, `has_disability`, `if_disability_yes`, `date_applied`, `email`, `password`, `verification_code`, `verification_expires_at`, `verified_at`, `token`, `remember_token`, `expiration`, `application_assistant_id`, `application_assistant_name`, `registration_assistant_id`, `registration_assistant_name`, `date_approved`, `created_at`, `updated_at`) VALUES
(1, '14263', '2024-09-27-14263', 3, 2, 1, 'Mia', 'Salinas', 'Martinez', NULL, '8764 Phase 6 Block 2 Lot 43 Banaba Road, Barangay 170, Caloocan City', 6, '1924-12-08', 100, 'Calapan City', 2, 1, '+639725747936', 'sample4.png', NULL, 'sample5.jpg', 'sample3.jpg', 'sample6.png', 1, NULL, 0, NULL, 0, NULL, 0, NULL, 0, NULL, '2024-09-27', 'mia.938.aguilar@example.com', '$2y$12$i7hUCriX.lWPxAKzdkO2bOEUMvh19KNA8PyBfg3md2EW/VVUVgWh6', NULL, NULL, '2024-09-12 14:47:04', NULL, NULL, NULL, 2, 'Larry Flores', 2, 'Paul De la Rosa', '2024-10-27', '2024-12-08 13:30:54', '2024-12-08 13:30:54'),
(2, '45689', '2024-09-29-45689', 2, NULL, 1, 'Edward', 'Matias', 'De Villa', NULL, '3587 Phase 7 Block 14 Lot 67 Malolos Avenue, Barangay 165, Caloocan City', 1, '1942-12-08', 82, 'Taguig City', 1, 2, '+639705294559', 'sample4.png', NULL, 'sample5.jpg', 'sample3.jpg', 'sample6.png', 2, NULL, 1, 8, 1, 2, 0, NULL, 0, NULL, '2024-09-29', 'edward.449.velasquez@example.com', '$2y$12$1CDUFUF3L4vgrB.yBsz6h.cWngIadcN9IaPePTg9gOLTmMxfI3JDu', NULL, NULL, '2024-11-01 20:04:45', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-10-29', '2024-12-08 13:30:54', '2024-12-08 13:30:54'),
(3, '35483', '2023-04-11-35483', 4, NULL, 1, 'Robert', 'Riviera', 'Delos Reyes', 'II', '2302 Phase 3 Block 6 Lot 54 Ilang-Ilang Drive, Barangay 165, Caloocan City', 1, '1932-12-08', 92, 'Bacoor City', 1, 1, '+639271089791', 'sample4.png', NULL, 'sample5.jpg', 'sample3.jpg', 'sample6.png', 3, NULL, 1, 10, 0, NULL, 1, 'Hypothyroidism', 0, NULL, '2023-04-11', 'robert.287.alvarado@example.com', '$2y$12$gh/d5fxvq3Kx6gRXx7yJtO/RKC0YAbuZqMeBZ8POm2Q1R7ihCy.sq', NULL, NULL, '2024-10-30 02:48:12', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-05-11', '2024-12-08 13:30:54', '2024-12-08 13:30:54'),
(4, '46564', '2023-06-03-46564', 3, 4, 1, 'Ronald', 'Zaragoza', 'Zaragoza', 'I', '1045 Phase 4 Block 16 Lot 11 Papaya Boulevard, Barangay 173, Caloocan City', 9, '1957-12-08', 67, 'Tagum City', 1, 3, '+639640739978', 'sample4.png', NULL, 'sample5.jpg', 'sample3.jpg', 'sample6.png', 3, NULL, 1, 4, 0, NULL, 0, NULL, 0, NULL, '2023-06-03', 'ronald.869.delacruz@example.com', '$2y$12$xRgYP2Mrx1uI6K8BVv98x.UBc.NocEO.7ugyQlTRjQABCr2uKvhzi', NULL, NULL, '2024-03-02 07:25:23', NULL, NULL, NULL, 2, 'Adam Esteban', 2, 'Mark Martelino', '2023-07-03', '2024-12-08 13:30:55', '2024-12-08 13:30:55'),
(5, '23097', '2024-11-21-23097', 4, NULL, 1, 'Barbara', 'Esteban', 'Manalaysay', NULL, '7357 Phase 8 Block 75 Lot 89 Sampaguita Street, Barangay 167, Caloocan City', 3, '1964-12-08', 60, 'Davao City', 2, 3, '+639998583084', 'sample4.png', NULL, 'sample5.jpg', 'sample3.jpg', 'sample6.png', 5, 'Living in a Boarding House/Dormitory', 1, 3, 0, NULL, 1, 'Parkinson disease', 0, NULL, '2024-11-21', 'barbara.228.alcaraz@example.com', '$2y$12$hyCtFSb7qmpWyKwaaXDPpONyABvPGLefZ6afVD/InV5/Zwq7hYbz2', NULL, NULL, '2024-06-08 19:49:42', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-12-21', '2024-12-08 13:30:55', '2024-12-08 13:30:55'),
(6, '14048', '2023-04-22-14048', 3, 3, 1, 'Mark', 'Alvarado', 'De la Vega', NULL, '6106 Phase 2 Block 39 Lot 76 Rambutan Street, Barangay 175, Caloocan City', 11, '1964-12-08', 60, 'Davao City', 1, 3, '+639392166202', 'sample4.png', NULL, 'sample5.jpg', 'sample3.jpg', 'sample6.png', 5, 'Living with Extended Family', 0, NULL, 1, 7, 1, 'Gastroesophageal reflux disease (GERD)', 0, NULL, '2023-04-22', 'mark.580.garcia@example.com', '$2y$12$pub0e09oXzlY.HDxCUhUQe2f6hKEWhJsqT3rTakJQa8vIP7BqEFuW', NULL, NULL, '2024-12-03 16:18:15', NULL, NULL, NULL, 2, 'Ronald Salvador', 2, 'Savannah Reyes', '2023-05-22', '2024-12-08 13:30:55', '2024-12-08 13:30:55'),
(7, '54969', '2022-12-21-54969', 1, NULL, 1, 'Michael', 'Valenzuela', 'De Guzman', NULL, '2534 Phase 4 Block 27 Lot 35 Mabait Drive, Barangay 165, Caloocan City', 1, '1959-12-08', 65, 'Las Piñas City', 1, 4, '+639585881163', 'sample4.png', NULL, 'sample5.jpg', 'sample3.jpg', 'sample6.png', 1, NULL, 0, NULL, 1, 1, 1, 'Alzheimer disease', 1, 'Mobility impairment', '2022-12-21', 'michael.286.zaragoza@example.com', '$2y$12$dHHmj9XVvz6IxcRQV1heVOIMD/3Gi6EvCO.3O5LvcwFeYQ4ILsAKm', NULL, NULL, '2024-03-24 00:13:24', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-01-21', '2024-12-08 13:30:55', '2024-12-08 13:30:55'),
(8, '22970', '2024-08-09-22970', 3, 3, 1, 'Betty', 'Palomares', 'Santos', NULL, '4143 Phase 6 Block 3 Lot 24 Topaz Street, Barangay 182, Caloocan City', 23, '1945-12-08', 79, 'Iloilo City', 2, 3, '+639084344993', 'sample4.png', NULL, 'sample5.jpg', 'sample3.jpg', 'sample6.png', 3, NULL, 1, 5, 0, NULL, 1, 'Chronic obstructive pulmonary disease (COPD)', 1, 'Hearing impairment', '2024-08-09', 'betty.200.palomares@example.com', '$2y$12$gazr/YWORQavHOjP2vr8UeYmpnoD9FmKXlwftk3eTDTTqIztOKUsK', NULL, NULL, '2024-04-16 05:23:05', NULL, NULL, NULL, 2, 'Eric Mendoza', 3, 'Kristoffer Cabigon', '2024-09-09', '2024-12-08 13:30:55', '2024-12-08 13:30:55'),
(9, '49073', '2024-01-31-49073', 3, 4, 1, 'Isabella', 'De Guzman', 'Dela Torre', NULL, '4529 Phase 7 Block 58 Lot 16 Azucena Drive, Barangay 177, Caloocan City', 18, '1935-12-08', 89, 'Santiago City', 2, 4, '+639303784907', 'sample4.png', NULL, 'sample5.jpg', 'sample3.jpg', 'sample6.png', 4, NULL, 0, NULL, 1, 11, 1, 'Diabetes', 0, NULL, '2024-01-31', 'isabella.780.esguerra@example.com', '$2y$12$iQb9xNJ/nwDbWdItwaGK2eEqOuhu8aLBYWbYq45wm9JB95mqVhBUC', NULL, NULL, '2024-09-23 22:57:03', NULL, NULL, NULL, 2, 'Thomas Martinez', 3, 'Kristoffer Cabigon', '2024-03-02', '2024-12-08 13:30:55', '2024-12-08 13:30:55'),
(10, '32737', '2023-12-19-32737', 3, 1, 1, 'Sarah', 'Ocampo', 'Tiongson', NULL, '8356 Phase 5 Block 45 Lot 36 Sapphire Street, Barangay 181, Caloocan City', 22, '1954-12-08', 70, 'Manila', 2, 3, '+639329841339', 'sample4.png', NULL, 'sample5.jpg', 'sample3.jpg', 'sample6.png', 4, NULL, 1, 2, 0, NULL, 1, 'Hearing loss', 0, NULL, '2023-12-19', 'sarah.634.velasquez@example.com', '$2y$12$MTbR1RL.xuvCv1Om34ciC.oJ/yp1m2a7Ie0H3e1dyrnxhuwCk1efm', NULL, NULL, '2024-07-28 08:05:29', NULL, NULL, NULL, 3, 'Kristoffer Cabigon', 3, 'Kristoffer Cabigon', '2024-01-19', '2024-12-08 13:30:55', '2024-12-08 13:30:55'),
(11, '58142', '2023-05-07-58142', 3, 1, 1, 'Sarah', 'Villafuerte', 'Soriano', NULL, '8573 Phase 4 Block 37 Lot 54 Marigold Street, Barangay 172, Caloocan City', 8, '1947-12-08', 77, 'Legazpi City', 2, 1, '+639780484943', 'sample4.png', NULL, 'sample5.jpg', 'sample3.jpg', 'sample6.png', 3, NULL, 1, 7, 0, NULL, 0, NULL, 0, NULL, '2023-05-07', 'sarah.225.soriano@example.com', '$2y$12$Zaa/t7685E/11ESSHyTOduL.o.DeUkudjYK0hFCH2fiPszx4SVAti', NULL, NULL, '2024-03-21 16:46:27', NULL, NULL, NULL, 3, 'Kristoffer Cabigon', 3, 'Kristoffer Cabigon', '2023-06-07', '2024-12-08 13:30:55', '2024-12-08 13:30:55'),
(12, '39822', '2023-12-20-39822', 1, NULL, 1, 'Cynthia', 'Salas', 'Pascual', NULL, '4035 Phase 2 Block 17 Lot 88 Topaz Street, Barangay 185, Caloocan City', 26, '1941-12-08', 83, 'Tagum City', 2, 4, '+639734932661', 'sample4.png', NULL, 'sample5.jpg', 'sample3.jpg', 'sample6.png', 5, 'Living with a Foster Family', 0, NULL, 0, NULL, 0, NULL, 0, NULL, '2023-12-20', 'cynthia.982.cabarroguis@example.com', '$2y$12$nhtpDThtNaFALG9qA45I5.hUAbYPJFpOl3/XrqfkHk6nr3ODQQCoK', NULL, NULL, '2024-05-04 18:23:13', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-01-20', '2024-12-08 13:30:55', '2024-12-08 13:30:55'),
(13, '66924', '2023-03-04-66924', 3, 1, 1, 'Jessica', 'Bañez', 'Arroyo', NULL, '3179 Phase 7 Block 81 Lot 4 Turquoise Road, Barangay 177, Caloocan City', 18, '1943-12-08', 81, 'Manila', 2, 2, '+639130474056', 'sample4.png', NULL, 'sample5.jpg', 'sample3.jpg', 'sample6.png', 4, NULL, 1, 8, 1, 4, 1, 'Parkinson disease', 0, NULL, '2023-03-04', 'jessica.750.pascual@example.com', '$2y$12$gb57nIXA5bYShQMhYTNPO.A/UqPKJU3K6iLaSabvMkwqhee/G1sbK', NULL, NULL, '2024-04-01 18:32:29', NULL, NULL, NULL, 2, 'Jessica Villanueva', 3, 'Kristoffer Cabigon', '2023-04-04', '2024-12-08 13:30:55', '2024-12-08 13:30:55'),
(14, '33799', '2023-03-19-33799', 3, 1, 1, 'Ruth', 'Manalo', 'Cortez', NULL, '2247 Phase 10 Block 85 Lot 71 Coral Boulevard, Barangay 180, Caloocan City', 21, '1945-12-08', 79, 'Pasig City', 2, 2, '+639710739633', 'sample4.png', NULL, 'sample5.jpg', 'sample3.jpg', 'sample6.png', 2, NULL, 0, NULL, 0, NULL, 0, NULL, 0, NULL, '2023-03-19', 'ruth.858.castillo@example.com', '$2y$12$Sr5NrorR0/d2KOspxDpZCu7CZc/bv7maYCEoLnaxt9nZNWsuKFYq6', NULL, NULL, '2024-01-21 14:32:20', NULL, NULL, NULL, 2, 'Matthew Flores', 2, 'Charles De Guzman', '2023-04-19', '2024-12-08 13:30:55', '2024-12-08 13:30:55'),
(15, '49863', '2024-03-08-49863', 3, 3, 1, 'Jennifer', 'Ponce', 'Del Rosario', NULL, '5299 Phase 6 Block 64 Lot 5 Masaya Road, Barangay 169, Caloocan City', 5, '1964-12-08', 60, 'Cavite City', 2, 3, '+639245105534', 'sample4.png', NULL, 'sample5.jpg', 'sample3.jpg', 'sample6.png', 1, NULL, 0, NULL, 0, NULL, 0, NULL, 1, 'Mental health condition', '2024-03-08', 'jennifer.283.deguzman@example.com', '$2y$12$DLwj9XJZL8eneio9b8Q7LenRBJmAkXdaFO9ULSPuTxbWRK/XX1.yS', NULL, NULL, '2024-07-14 01:08:28', NULL, NULL, NULL, 3, 'Kristoffer Cabigon', 3, 'Kristoffer Cabigon', '2024-04-08', '2024-12-08 13:30:55', '2024-12-08 13:30:55'),
(16, '40723', '2024-05-30-40723', 3, 1, 1, 'Ruth', NULL, 'Matias', NULL, '3049 Phase 5 Block 62 Lot 27 Santol Street, Barangay 179, Caloocan City', 20, '1939-12-08', 85, 'Lapu-Lapu City', 2, 3, '+639598100238', 'sample4.png', NULL, 'sample5.jpg', 'sample3.jpg', 'sample6.png', 1, NULL, 0, NULL, 0, NULL, 0, NULL, 1, 'Cognitive disability', '2024-05-30', 'ruth.624.devera@example.com', '$2y$12$fReKRhbXetd5NWn4Jxw2WO2OKAnfojOTwKmaipopSxb8gdQqc3z3O', NULL, NULL, '2024-09-23 19:10:45', NULL, NULL, NULL, 2, 'Aria Bañez', 3, 'Kristoffer Cabigon', '2024-06-30', '2024-12-08 13:30:55', '2024-12-08 13:30:55'),
(17, '53606', '2023-03-25-53606', 3, 1, 1, 'Patricia', 'De Villa', 'Arroyo', NULL, '1889 Phase 5 Block 62 Lot 10 Iris Avenue, Barangay 173, Caloocan City', 9, '1932-12-08', 92, 'Davao City', 2, 1, '+639276204801', 'sample4.png', NULL, 'sample5.jpg', 'sample3.jpg', 'sample6.png', 3, NULL, 1, 2, 0, NULL, 1, 'Stroke', 0, NULL, '2023-03-25', 'patricia.475.salas@example.com', '$2y$12$.klJtPcckdR6Y24cm6cnru0LoJxOgSzQuGniBHnp4W5tI0VCiM3Qu', NULL, NULL, '2024-02-02 15:03:18', NULL, NULL, NULL, 2, 'Ruth Lacuna', 2, 'Charles De Guzman', '2023-04-25', '2024-12-08 13:30:56', '2024-12-08 13:30:56'),
(18, '25579', '2023-04-23-25579', 3, 3, 1, 'Diane', 'Aquino', 'De Ocampo', NULL, '6084 Phase 7 Block 44 Lot 7 Malolos Avenue, Barangay 183, Caloocan City', 24, '1935-12-08', 89, 'Cavite City', 2, 4, '+639394241317', 'sample4.png', NULL, 'sample5.jpg', 'sample3.jpg', 'sample6.png', 2, NULL, 1, 10, 0, NULL, 1, 'Diabetes', 1, 'Cognitive disability', '2023-04-23', 'diane.674.castañeda@example.com', '$2y$12$vBFMfOTZa1IYiIVFHDF0Se9hn9PPIlz769ooMA5bUIJFbHsoZdiD2', NULL, NULL, '2024-02-02 23:53:55', NULL, NULL, NULL, 3, 'Kristoffer Cabigon', 2, 'Charles De Guzman', '2023-05-23', '2024-12-08 13:30:56', '2024-12-08 13:30:56'),
(19, '43416', '2024-03-27-43416', 3, 4, 1, 'Laura', 'Gonzales', 'De Ocampo', NULL, '6102 Phase 2 Block 7 Lot 85 Tulip Road, Barangay 181, Caloocan City', 22, '1961-12-08', 63, 'Dipolog City', 2, 4, '+639223029696', 'sample4.png', NULL, 'sample5.jpg', 'sample3.jpg', 'sample6.png', 1, NULL, 0, NULL, 1, 2, 1, 'Gastroesophageal reflux disease (GERD)', 0, NULL, '2024-03-27', 'laura.66.castillo@example.com', '$2y$12$cpP2a1O5lAVjqQGPL5sto.5uiosbcQgqF6ktV8.7m27nGCud0q4rq', NULL, NULL, '2024-05-15 01:57:10', NULL, NULL, NULL, 2, 'Matthew Flores', 3, 'Kristoffer Cabigon', '2024-04-27', '2024-12-08 13:30:56', '2024-12-08 13:30:56'),
(20, '15681', '2024-06-03-15681', 4, NULL, 1, 'Mark', 'Flores', 'Santiago', 'Jr.', '4737 Phase 7 Block 37 Lot 57 Violeta Street, Barangay 187, Caloocan City', 28, '1926-12-08', 98, 'Dumaguete City', 1, 1, '+639615561130', 'sample4.png', NULL, 'sample5.jpg', 'sample3.jpg', 'sample6.png', 3, NULL, 1, 11, 0, NULL, 1, 'Alzheimer disease', 0, NULL, '2024-06-03', 'mark.350.deleon@example.com', '$2y$12$gaK6S8Ogb2eKY6hwf6es0OofSL6qgNvAHKUup7My0cboFzxWewII.', NULL, NULL, '2024-05-19 06:59:21', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-03', '2024-12-08 13:30:56', '2024-12-08 13:30:56'),
(21, '87880', '2024-03-31-87880', 3, 4, 1, 'Paul', 'Salinas', 'Castillo', 'I', '2831 Phase 5 Block 34 Lot 15 Anahaw Road, Barangay 176-F, Caloocan City', 17, '1930-12-08', 94, 'Digos City', 1, 1, '+639619369396', 'sample4.png', NULL, 'sample5.jpg', 'sample3.jpg', 'sample6.png', 5, 'Living in a Commune or Cooperative Housing', 0, NULL, 0, NULL, 1, 'Vision impairment', 0, NULL, '2024-03-31', 'paul.170.salinas@example.com', '$2y$12$E4EM2sBPe9y4A/M0x27ju.3xlVwIn03G0L6n4Mm3qxPTcIcYTFaRy', NULL, NULL, '2024-09-03 16:26:49', NULL, NULL, NULL, 2, 'David Alvarez', 3, 'Kristoffer Cabigon', '2024-05-01', '2024-12-08 13:30:56', '2024-12-08 13:30:56'),
(22, '17558', '2024-12-02-17558', 4, NULL, 1, 'Diane', 'San Vicente', 'Rocamora', NULL, '8941 Phase 10 Block 82 Lot 6 Turquoise Road, Barangay 170, Caloocan City', 6, '1950-12-08', 74, 'Taguig City', 2, 4, '+639795876223', 'sample4.png', NULL, 'sample5.jpg', 'sample3.jpg', 'sample6.png', 1, NULL, 0, NULL, 1, 6, 1, 'Stroke', 0, NULL, '2024-12-02', 'diane.774.arroyo@example.com', '$2y$12$wsxDuxPNI6Pv3YFnA21b5uc4no4WKB6lyTXO5Z1j5jYbaDC8Dl4..', NULL, NULL, '2024-03-07 14:29:19', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-01-02', '2024-12-08 13:30:56', '2024-12-08 13:30:56'),
(23, '16011', '2024-10-24-16011', 3, 2, 1, 'Karen', 'Villanueva', 'Riviera', NULL, '3929 Phase 7 Block 90 Lot 15 Marangal Drive, Barangay 186, Caloocan City', 27, '1958-12-08', 66, 'Tacloban City', 2, 1, '+639468780411', 'sample4.png', NULL, 'sample5.jpg', 'sample3.jpg', 'sample6.png', 2, NULL, 0, NULL, 0, NULL, 1, 'Heart disease', 0, NULL, '2024-10-24', 'karen.705.deguzman@example.com', '$2y$12$TAb0kOUJKJycmlgZDBvZteCSnvbAxx4eeVq.ywjoJm0CrL7rvh.sy', NULL, NULL, '2024-01-20 16:24:04', NULL, NULL, NULL, 2, 'Savannah De la Rosa', 2, 'Charles De Guzman', '2024-11-24', '2024-12-08 13:30:56', '2024-12-08 13:30:56'),
(24, '97145', '2024-10-14-97145', 1, NULL, 1, 'Jason', 'Delos Reyes', 'Nieves', 'III', '3553 Phase 7 Block 70 Lot 31 Banaba Road, Barangay 181, Caloocan City', 22, '1936-12-08', 88, 'San Fernando City (Pampanga)', 1, 3, '+639757135089', 'sample4.png', NULL, 'sample5.jpg', 'sample3.jpg', 'sample6.png', 4, NULL, 0, NULL, 0, NULL, 0, NULL, 0, NULL, '2024-10-14', 'jason.861.sanvicente@example.com', '$2y$12$kf9D9qRRQ7EGltJfFcAB5endKM9P/EERimYSb4tRd3fOU49kz.zrO', NULL, NULL, '2024-01-24 06:58:42', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-11-14', '2024-12-08 13:30:56', '2024-12-08 13:30:56'),
(25, '30150', '2024-08-03-30150', 4, NULL, 1, 'Barbara', 'Tabujara', 'Villanueva', NULL, '5013 Phase 7 Block 66 Lot 47 Peridot Avenue, Barangay 185, Caloocan City', 26, '1949-12-08', 75, 'Quezon City', 2, 2, '+639309875978', 'sample4.png', NULL, 'sample5.jpg', 'sample3.jpg', 'sample6.png', 4, NULL, 1, 9, 0, NULL, 0, NULL, 0, NULL, '2024-08-03', 'barbara.818.castañeda@example.com', '$2y$12$LjKY3Dxy1sh5IVZpY7whGufdSsGcYH6H0rMzey6vLVxbaqwZcvUOu', NULL, NULL, '2024-02-24 01:20:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-09-03', '2024-12-08 13:30:56', '2024-12-08 13:30:56'),
(26, '10662', '2023-12-09-10662', 3, 1, 1, 'Dorothy', 'Chua', 'Salvador', NULL, '3035 Phase 10 Block 47 Lot 53 Matapat Boulevard, Barangay 174, Caloocan City', 10, '1947-12-08', 77, 'Pasig City', 2, 4, '+639970631811', 'sample4.png', NULL, 'sample5.jpg', 'sample3.jpg', 'sample6.png', 1, NULL, 1, 11, 0, NULL, 0, NULL, 1, 'Hearing impairment', '2023-12-09', 'dorothy.870.magsaysay@example.com', '$2y$12$2vwbh5Yh0fGvQWn6PJ358.XDeOCkjAUWtJ9Mol7ApAQ6d8vvBDY7G', NULL, NULL, '2024-10-28 15:12:59', NULL, NULL, NULL, 2, 'Thomas Delos Santos', 3, 'Kristoffer Cabigon', '2024-01-09', '2024-12-08 13:30:56', '2024-12-08 13:30:56'),
(27, '91894', '2024-09-30-91894', 3, 3, 1, 'Sophia', 'De Guzman', 'Santiago', NULL, '9350 Phase 7 Block 63 Lot 74 Marigold Street, Barangay 187, Caloocan City', 28, '1929-12-08', 95, 'Iligan City', 2, 2, '+639665329372', 'sample4.png', NULL, 'sample5.jpg', 'sample3.jpg', 'sample6.png', 2, NULL, 1, 6, 1, 10, 1, 'Chronic obstructive pulmonary disease (COPD)', 0, NULL, '2024-09-30', 'sophia.103.rocamora@example.com', '$2y$12$TQdNDXbqTMMN9Q/2epkG1ez84zaqT/sFCBaeSrfeqPgS0.eVTN/YG', NULL, NULL, '2024-01-11 14:58:12', NULL, NULL, NULL, 3, 'Kristoffer Cabigon', 3, 'Kristoffer Cabigon', '2024-10-30', '2024-12-08 13:30:56', '2024-12-08 13:30:56'),
(28, '99933', '2023-07-27-99933', 2, NULL, 1, 'Harper', 'Dela Cruz', 'Nieves', NULL, '9048 Phase 8 Block 13 Lot 28 Jade Avenue, Barangay 187, Caloocan City', 28, '1952-12-08', 72, 'Parañaque City', 2, 3, '+639436880344', 'sample4.png', NULL, 'sample5.jpg', 'sample3.jpg', 'sample6.png', 5, 'Living in a Residential Care Facility', 0, NULL, 1, 10, 1, 'Depression', 0, NULL, '2023-07-27', 'harper.228.aquino@example.com', '$2y$12$.8fYizjfjvtpDcDF3lhmeeAeSNpkGcMFzSJHaAH/yBn81EyQcxH6G', NULL, NULL, '2024-02-25 11:37:36', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-08-27', '2024-12-08 13:30:56', '2024-12-08 13:30:56'),
(29, '38572', '2023-07-31-38572', 4, NULL, 1, 'Virginia', 'De Leon', 'Gonzales', NULL, '5492 Phase 8 Block 38 Lot 26 Gladiola Boulevard, Barangay 172, Caloocan City', 8, '1949-12-08', 75, 'Las Piñas City', 2, 3, '+639641032298', 'sample4.png', NULL, 'sample5.jpg', 'sample3.jpg', 'sample6.png', 4, NULL, 0, NULL, 0, NULL, 1, 'Parkinson disease', 0, NULL, '2023-07-31', 'virginia.510.sanpedro@example.com', '$2y$12$LRYg3ntKjjYQ37EaEOf1mek3S1kpHLAlGLqe4zw9bNTGpz1cjWfhy', NULL, NULL, '2024-04-05 03:11:10', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-08-31', '2024-12-08 13:30:56', '2024-12-08 13:30:56'),
(30, '95623', '2023-06-13-95623', 4, NULL, 1, 'Edward', 'Natividad', 'Castañeda', NULL, '2423 Phase 9 Block 47 Lot 63 Carnation Road, Barangay 184, Caloocan City', 25, '1951-12-08', 73, 'Quezon City', 1, 3, '+639654223371', 'sample4.png', NULL, 'sample5.jpg', 'sample3.jpg', 'sample6.png', 2, NULL, 0, NULL, 0, NULL, 0, NULL, 0, NULL, '2023-06-13', 'edward.146.bacani@example.com', '$2y$12$b7EcDV0iGw1BVYq/w/VOWeVfTpTKIWIYw7j/dUnPCI7SIlzmfS04S', NULL, NULL, '2024-11-15 23:49:57', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-07-13', '2024-12-08 13:30:56', '2024-12-08 13:30:56'),
(31, '51199', '2024-09-23-51199', 3, 1, 1, 'Larry', 'Pineda', 'Ocampo', 'I', '7621 Phase 6 Block 70 Lot 15 Amber Street, Barangay 176-F, Caloocan City', 17, '1942-12-08', 82, 'Pasig City', 1, 3, '+639688789893', 'sample4.png', NULL, 'sample5.jpg', 'sample3.jpg', 'sample6.png', 2, NULL, 1, 4, 1, 11, 1, 'Kidney disease', 1, 'Mobility impairment', '2024-09-23', 'larry.227.cruz@example.com', '$2y$12$cNXcCs6L.Kqg4ubefvU3AOe1zK96yhNmE3xvNyM5mNkHwwnhtRHau', NULL, NULL, '2024-04-17 15:34:10', NULL, NULL, NULL, 3, 'Kristoffer Cabigon', 2, 'Cynthia Villafuerte', '2024-10-23', '2024-12-08 13:30:56', '2024-12-08 13:30:56'),
(32, '23635', '2022-12-31-23635', 4, NULL, 1, 'Paul', 'Salinas', 'Bañez', 'Sr.', '8757 Phase 7 Block 58 Lot 14 Pineapple Avenue, Barangay 166, Caloocan City', 2, '1961-12-08', 63, 'Cabanatuan City', 1, 1, '+639418832624', 'sample4.png', NULL, 'sample5.jpg', 'sample3.jpg', 'sample6.png', 2, NULL, 0, NULL, 1, 10, 0, NULL, 0, NULL, '2022-12-31', 'paul.607.delatorre@example.com', '$2y$12$uO8skYe1fLFL./NNKwAOqOrm151wNyjMthlJC84oiK88MadqIjDZ2', NULL, NULL, '2024-05-17 23:34:46', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-01-31', '2024-12-08 13:30:57', '2024-12-08 13:30:57'),
(33, '88378', '2024-05-11-88378', 3, 2, 1, 'Sophia', 'San Vicente', 'Esteban', NULL, '7065 Phase 9 Block 45 Lot 26 Gold Boulevard, Barangay 176-D, Caloocan City', 15, '1928-12-08', 96, 'Iloilo City', 2, 3, '+639334005183', 'sample4.png', NULL, 'sample5.jpg', 'sample3.jpg', 'sample6.png', 3, NULL, 1, 5, 0, NULL, 1, 'Gastroesophageal reflux disease (GERD)', 0, NULL, '2024-05-11', 'sophia.190.villanueva@example.com', '$2y$12$e2rAjBEvenc8vmp7JFUCau.wKbBIl/x7GaZ0aG0gsRSmVtuvSonbO', NULL, NULL, '2024-10-26 14:44:06', NULL, NULL, NULL, 2, 'Eric Mendoza', 3, 'Kristoffer Cabigon', '2024-06-11', '2024-12-08 13:30:57', '2024-12-08 13:30:57'),
(34, '31869', '2023-09-09-31869', 3, 4, 1, 'James', 'Manalo', 'Alvarado', 'III', '6269 Phase 10 Block 76 Lot 64 Cosmos Drive, Barangay 167, Caloocan City', 3, '1944-12-08', 80, 'Legazpi City', 1, 3, '+639996785908', 'sample4.png', NULL, 'sample5.jpg', 'sample3.jpg', 'sample6.png', 2, NULL, 1, 11, 1, 9, 1, 'Osteoporosis', 1, 'Hearing impairment', '2023-09-09', 'james.170.alvarado@example.com', '$2y$12$kCS4zoiTObs5n3zqDyW/vudY6hEbsYlh4QGehMEOj4ZVLVMztWTz6', NULL, NULL, '2024-06-19 06:26:04', NULL, NULL, NULL, 2, 'Ronald Salvador', 3, 'Kristoffer Cabigon', '2023-10-09', '2024-12-08 13:30:57', '2024-12-08 13:30:57'),
(35, '92783', '2023-06-18-92783', 3, 2, 1, 'George', 'De Leon', 'Dizon', 'Sr.', '3387 Phase 7 Block 76 Lot 12 Luna Street, Barangay 176-B, Caloocan City', 13, '1956-12-08', 68, 'Malabon City', 1, 3, '+639075087593', 'sample4.png', NULL, 'sample5.jpg', 'sample3.jpg', 'sample6.png', 2, NULL, 1, 9, 0, NULL, 0, NULL, 0, NULL, '2023-06-18', 'george.772.deocampo@example.com', '$2y$12$8PZQxdnJLA6D1/ZYDP.YKuw7sza0AU.Mm9uENFJ7VLBb7iv8wtqsi', NULL, NULL, '2024-03-07 03:24:00', NULL, NULL, NULL, 2, 'Charles De Guzman', 3, 'Kristoffer Cabigon', '2023-07-18', '2024-12-08 13:30:57', '2024-12-08 13:30:57'),
(36, '21578', '2024-08-15-21578', 3, 3, 1, 'Ronald', 'De Guzman', 'Mendoza', 'II', '4271 Phase 2 Block 33 Lot 63 Marangal Drive, Barangay 179, Caloocan City', 20, '1948-12-08', 76, 'Caloocan City', 1, 2, '+639292824710', 'sample4.png', NULL, 'sample5.jpg', 'sample3.jpg', 'sample6.png', 5, 'Naninirahan lang', 0, NULL, 1, 3, 1, 'Kidney disease', 0, NULL, '2024-08-15', 'ronald.360.riviera@example.com', '$2y$12$5/hBk4xgHIfeHPg0YNvpc.Jp..xZE.1wkce9t8sJf8AYl5.V6lQny', NULL, NULL, '2024-03-17 09:02:40', NULL, NULL, NULL, 2, 'Matthew Flores', 3, 'Kristoffer Cabigon', '2024-09-15', '2024-12-08 13:30:57', '2024-12-08 13:30:57'),
(37, '16704', '2023-03-18-16704', 3, 4, 1, 'Emma', 'Natividad', 'De la Cruz', NULL, '1237 Phase 8 Block 87 Lot 69 Citrine Avenue, Barangay 176-D, Caloocan City', 15, '1957-12-08', 67, 'Taguig City', 2, 2, '+639434039160', 'sample4.png', NULL, 'sample5.jpg', 'sample3.jpg', 'sample6.png', 4, NULL, 1, 6, 1, 11, 1, 'Chronic pain conditions', 0, NULL, '2023-03-18', 'emma.866.delmundo@example.com', '$2y$12$u8c8vGKbCfbmEzNt/SSpwO1Cpwj/CfJZdcTHzQ8VissWuTxYHh5RS', NULL, NULL, '2024-11-08 22:33:53', NULL, NULL, NULL, 2, 'Karen Villanueva', 3, 'Kristoffer Cabigon', '2023-04-18', '2024-12-08 13:30:57', '2024-12-08 13:30:57'),
(38, '12043', '2024-07-24-12043', 3, 2, 1, 'Amy', 'Yap', 'Sison', NULL, '9799 Phase 2 Block 14 Lot 4 Pearl Boulevard, Barangay 176-E, Caloocan City', 16, '1933-12-08', 91, 'San Juan City', 2, 4, '+639027663205', 'sample4.png', NULL, 'sample5.jpg', 'sample3.jpg', 'sample6.png', 2, NULL, 1, 4, 0, NULL, 0, NULL, 0, NULL, '2024-07-24', 'amy.600.salinas@example.com', '$2y$12$ZPY7v1HdHTZ5e6189m16mOhHyFftYu9yroiKppwU2B3/68BVzlx2q', NULL, NULL, '2024-01-25 09:23:53', NULL, NULL, NULL, 2, 'Aria Bañez', 2, 'Eric Tabujara', '2024-08-24', '2024-12-08 13:30:57', '2024-12-08 13:30:57'),
(39, '66701', '2024-03-02-66701', 3, 4, 1, 'Daniel', NULL, 'De la Torre', 'III', '3827 Phase 4 Block 75 Lot 34 Violeta Street, Barangay 182, Caloocan City', 23, '1953-12-08', 71, 'Las Piñas City', 1, 3, '+639452466784', 'sample4.png', NULL, 'sample5.jpg', 'sample3.jpg', 'sample6.png', 1, NULL, 0, NULL, 1, 11, 0, NULL, 0, NULL, '2024-03-02', 'daniel.521.bacani@example.com', '$2y$12$PZb4ozs/Jfc.ux0WXx0O8OQfg.H34Lf/81CJ2FyXE/YoEtTcjsxFm', NULL, NULL, '2024-07-11 08:50:19', NULL, NULL, NULL, 3, 'Kristoffer Cabigon', 2, 'Karen Villanueva', '2024-04-02', '2024-12-08 13:30:57', '2024-12-08 13:30:57'),
(40, '20473', '2024-07-19-20473', 3, 3, 1, 'Paul', 'Ramos', 'Ramos', 'Jr.', '9937 Phase 5 Block 40 Lot 31 Mabait Drive, Barangay 182, Caloocan City', 23, '1928-12-08', 96, 'Caloocan City', 1, 2, '+639185064648', 'sample4.png', NULL, 'sample5.jpg', 'sample3.jpg', 'sample6.png', 4, NULL, 1, 10, 0, NULL, 0, NULL, 0, NULL, '2024-07-19', 'paul.158.macapagal@example.com', '$2y$12$L.YQWTZB6SArdTdFFqCYIOdBohR.Fv1usa4t7rlyua435uobs1voe', NULL, NULL, '2024-02-09 06:19:42', NULL, NULL, NULL, 2, 'Adam Esteban', 3, 'Kristoffer Cabigon', '2024-08-19', '2024-12-08 13:30:57', '2024-12-08 13:30:57'),
(41, '55791', '2024-01-11-55791', 3, 4, 1, 'Daniel', 'Ocampo', 'Torres', 'Jr.', '7855 Phase 10 Block 54 Lot 26 Avocado Street, Barangay 181, Caloocan City', 22, '1927-12-08', 97, 'Quezon City', 1, 2, '+639392171362', 'sample4.png', NULL, 'sample5.jpg', 'sample3.jpg', 'sample6.png', 4, NULL, 1, 2, 0, NULL, 1, 'Chronic obstructive pulmonary disease (COPD)', 0, NULL, '2024-01-11', 'daniel.821.cabigon@example.com', '$2y$12$PMPeRA0Z1E0BHG3XSwKVFOPj5i4qY9KO.IRrbfQFhLxB8tO0H51sm', NULL, NULL, '2024-04-20 15:46:10', NULL, NULL, NULL, 3, 'Kristoffer Cabigon', 3, 'Kristoffer Cabigon', '2024-02-11', '2024-12-08 13:30:57', '2024-12-08 13:30:57'),
(42, '60100', '2024-09-13-60100', 3, 2, 1, 'Betty', NULL, 'De Villa', NULL, '5973 Phase 5 Block 7 Lot 58 Hibiscus Boulevard, Barangay 181, Caloocan City', 22, '1954-12-08', 70, 'Pasig City', 2, 4, '+639868430523', 'sample4.png', NULL, 'sample5.jpg', 'sample3.jpg', 'sample6.png', 3, NULL, 0, NULL, 1, 6, 0, NULL, 0, NULL, '2024-09-13', 'betty.394.riviera@example.com', '$2y$12$lqqbUbescqX.NLBUoMeJUOprTt0RHgT.EVxUWCFXZGhoWgddI5GYG', NULL, NULL, '2024-01-11 22:30:34', NULL, NULL, NULL, 3, 'Kristoffer Cabigon', 2, 'Aria Bañez', '2024-10-13', '2024-12-08 13:30:57', '2024-12-08 13:30:57'),
(43, '51178', '2023-02-20-51178', 3, 2, 1, 'Ronald', 'Valenzuela', 'De Guzman', 'Jr.', '4652 Phase 1 Block 84 Lot 65 Lily Avenue, Barangay 168, Caloocan City', 4, '1945-12-08', 79, 'Cabanatuan City', 1, 2, '+639945704994', 'sample4.png', NULL, 'sample5.jpg', 'sample3.jpg', 'sample6.png', 4, NULL, 1, 5, 0, NULL, 0, NULL, 0, NULL, '2023-02-20', 'ronald.662.zaragoza@example.com', '$2y$12$ZxwdPfS3dGJlHZooThxjx.iJXl9UmpGUyuf/YXZuBSfy9aqbEVjY6', NULL, NULL, '2024-07-10 14:20:39', NULL, NULL, NULL, 2, 'Paul De la Rosa', 2, 'Ruth Lacuna', '2023-03-20', '2024-12-08 13:30:57', '2024-12-08 13:30:57'),
(44, '21429', '2023-06-03-21429', 3, 4, 1, 'John', 'Morales', 'López', NULL, '8633 Phase 7 Block 70 Lot 16 Diamond Boulevard, Barangay 170, Caloocan City', 6, '1932-12-08', 92, 'Angeles City', 1, 2, '+639781482669', 'sample4.png', NULL, 'sample5.jpg', 'sample3.jpg', 'sample6.png', 3, NULL, 0, NULL, 1, 1, 1, 'Diabetes', 1, 'Visual impairment', '2023-06-03', 'john.306.labrador@example.com', '$2y$12$XMAGxqb56FKXxY0yOHoZ3OX6QE7Wglb8BwzFKgGjJv5aU2lR1r82q', NULL, NULL, '2024-02-28 12:19:34', NULL, NULL, NULL, 3, 'Kristoffer Cabigon', 2, 'Kristoffer Cabigon', '2023-07-03', '2024-12-08 13:30:57', '2024-12-08 13:30:57'),
(45, '24797', '2024-02-17-24797', 3, 4, 1, 'Harper', 'Arroyo', 'Villafuerte', NULL, '1424 Phase 4 Block 54 Lot 82 Matatag Drive, Barangay 180, Caloocan City', 21, '1949-12-08', 75, 'Tagum City', 2, 4, '+639768989449', 'sample4.png', NULL, 'sample5.jpg', 'sample3.jpg', 'sample6.png', 3, NULL, 1, 11, 1, 10, 1, 'Osteoporosis', 1, 'Cognitive disability', '2024-02-17', 'harper.853.mendoza@example.com', '$2y$12$Wlj5qONB4Y2sf3q4XuZenO92dsG23KBwgUynl19srUxGZgOdSZ3D6', NULL, NULL, '2024-03-31 11:59:09', NULL, NULL, NULL, 2, 'Matthew Flores', 3, 'Kristoffer Cabigon', '2024-03-17', '2024-12-08 13:30:58', '2024-12-08 13:30:58'),
(46, '61531', '2023-12-25-61531', 4, NULL, 1, 'Matthew', 'De Vera', 'Gonzales', NULL, '3238 Phase 3 Block 67 Lot 12 Marangal Drive, Barangay 176-A, Caloocan City', 12, '1926-12-08', 98, 'Quezon City', 1, 2, '+639616747956', 'sample4.png', NULL, 'sample5.jpg', 'sample3.jpg', 'sample6.png', 2, NULL, 0, NULL, 1, 2, 1, 'Anxiety disorders', 0, NULL, '2023-12-25', 'matthew.713.villafuerte@example.com', '$2y$12$VD7rxlmZ.vMvbf1h.rNnuO9LuNvZs/O7Fn4NaPnmwHx/PDxqDj/i6', NULL, NULL, '2024-05-18 11:45:33', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-01-25', '2024-12-08 13:30:58', '2024-12-08 13:30:58'),
(47, '70361', '2023-08-05-70361', 3, 3, 1, 'Donald', 'Matias', 'Torres', 'II', '9874 Phase 3 Block 88 Lot 2 Matapat Boulevard, Barangay 176-D, Caloocan City', 15, '1942-12-08', 82, 'Calapan City', 1, 1, '+639770061494', 'sample4.png', NULL, 'sample5.jpg', 'sample3.jpg', 'sample6.png', 5, 'Naninirahan lang', 1, 2, 1, 4, 1, 'Arthritis', 0, NULL, '2023-08-05', 'donald.402.rosales@example.com', '$2y$12$cHbgbWE5jXAW.IGoeoF4I.camUNYLkyglj9pLNuSlwHcnb3COOHci', NULL, NULL, '2024-06-23 01:40:08', NULL, NULL, NULL, 3, 'Kristoffer Cabigon', 3, 'Kristoffer Cabigon', '2023-09-05', '2024-12-08 13:30:58', '2024-12-08 13:30:58'),
(48, '67888', '2023-02-18-67888', 3, 1, 1, 'Sarah', 'Alcaraz', 'Esguerra', NULL, '5115 Phase 10 Block 87 Lot 85 Mabuhay Road, Barangay 187, Caloocan City', 28, '1933-12-08', 91, 'San Fernando City (Pampanga)', 2, 3, '+639966912293', 'sample4.png', NULL, 'sample5.jpg', 'sample3.jpg', 'sample6.png', 4, NULL, 0, NULL, 1, 3, 0, NULL, 0, NULL, '2023-02-18', 'sarah.21.deguzman@example.com', '$2y$12$AZafoAdqzyHjdEgav7X3Cu5rBX8NB6go8pJQQRPAa7sE01iV2BdN6', NULL, NULL, '2024-01-22 14:52:48', NULL, NULL, NULL, 2, 'Mark Nieves', 3, 'Kristoffer Cabigon', '2023-03-18', '2024-12-08 13:30:58', '2024-12-08 13:30:58'),
(49, '49732', '2023-10-20-49732', 3, 2, 1, 'Diane', 'Rosales', 'Dizon', NULL, '8219 Phase 7 Block 45 Lot 87 Onyx Drive, Barangay 176-A, Caloocan City', 12, '1963-12-08', 61, 'Davao City', 2, 3, '+639413128999', 'sample4.png', NULL, 'sample5.jpg', 'sample3.jpg', 'sample6.png', 1, NULL, 0, NULL, 0, NULL, 1, 'Kidney disease', 0, NULL, '2023-10-20', 'diane.895.delmundo@example.com', '$2y$12$WGU7M69jmQS3ypp5AmzBhOWkK9muU31PtkXBFTwrtRKatoVh0OWg2', NULL, NULL, '2024-09-24 05:34:26', NULL, NULL, NULL, 3, 'Kristoffer Cabigon', 3, 'Kristoffer Cabigon', '2023-11-20', '2024-12-08 13:30:58', '2024-12-08 13:30:58'),
(50, '94008', '2023-11-09-94008', 3, 2, 1, 'Eric', 'Esguerra', 'Natividad', NULL, '5678 Phase 3 Block 2 Lot 61 Poinsettia Street, Barangay 176-B, Caloocan City', 13, '1954-12-08', 70, 'San Juan City', 1, 1, '+639594794620', 'sample4.png', NULL, 'sample5.jpg', 'sample3.jpg', 'sample6.png', 1, NULL, 0, NULL, 1, 4, 1, 'Cancer', 1, 'Hearing impairment', '2023-11-09', 'eric.772.cabrera@example.com', '$2y$12$03ev0ezwITCjBNwDNrY72u8owHzqH5yWC61kgh6OM4tbd8hDL4FrS', NULL, NULL, '2024-03-15 06:21:08', NULL, NULL, NULL, 3, 'Kristoffer Cabigon', 3, 'Kristoffer Cabigon', '2023-12-09', '2024-12-08 13:30:58', '2024-12-08 13:30:58'),
(51, '64783', '2024-05-17-64783', 3, 2, 1, 'Cynthia', 'Cortez', 'Cabigon', NULL, '8178 Phase 2 Block 35 Lot 20 Aquamarine Avenue, Barangay 176-A, Caloocan City', 12, '1950-12-08', 74, 'Marikina City', 2, 4, '+639947876026', 'sample4.png', NULL, 'sample5.jpg', 'sample3.jpg', 'sample6.png', 4, NULL, 1, 5, 0, NULL, 0, NULL, 0, NULL, '2024-05-17', 'cynthia.152.esguerra@example.com', '$2y$12$aaul8q2UFoHwUS7v4H0hqO9b809.XjHqfaEMLSCcC05j/Ks8lVbU6', NULL, NULL, '2024-11-01 04:28:51', NULL, NULL, NULL, 3, 'Kristoffer Cabigon', 2, 'Michael Soriano', '2024-06-17', '2024-12-08 13:30:59', '2024-12-08 13:30:59'),
(52, '68524', '2023-01-03-68524', 3, 4, 1, 'Ruth', 'Pineda', 'Villanueva', NULL, '4373 Phase 2 Block 66 Lot 8 Ilang-Ilang Drive, Barangay 169, Caloocan City', 5, '1925-12-08', 99, 'Puerto Princesa City', 2, 2, '+639378443892', 'sample4.png', NULL, 'sample5.jpg', 'sample3.jpg', 'sample6.png', 2, NULL, 1, 9, 0, NULL, 0, NULL, 0, NULL, '2023-01-03', 'ruth.119.sanantonio@example.com', '$2y$12$YmnLwwvkpD1/2R/wc.meRechQOgmCvqvet/dfb5OU19IkTzc5x9Ke', NULL, NULL, '2024-11-29 10:42:50', NULL, NULL, NULL, 3, 'Kristoffer Cabigon', 3, 'Kristoffer Cabigon', '2023-02-03', '2024-12-08 13:30:59', '2024-12-08 13:30:59'),
(53, '20209', '2024-08-28-20209', 3, 2, 1, 'Karen', 'De Guzman', 'Martelino', NULL, '1228 Phase 4 Block 5 Lot 18 Venus Road, Barangay 187, Caloocan City', 28, '1924-12-08', 100, 'San Juan City', 2, 3, '+639329607549', 'sample4.png', NULL, 'sample5.jpg', 'sample3.jpg', 'sample6.png', 4, NULL, 0, NULL, 0, NULL, 0, NULL, 1, 'Cognitive disability', '2024-08-28', 'karen.211.gonzales@example.com', '$2y$12$smqyvug1LA1jTE40ac3y2eIRrGy2UY5hfaa9W7Ts0aEqUrvk6kH5.', NULL, NULL, '2024-10-13 00:49:47', NULL, NULL, NULL, 2, 'Mark Martelino', 3, 'Kristoffer Cabigon', '2024-09-28', '2024-12-08 13:30:59', '2024-12-08 13:30:59'),
(54, '70297', '2024-11-22-70297', 3, 2, 1, 'David', 'Sison', 'Vera', 'II', '9514 Phase 9 Block 39 Lot 76 Dama de Noche Avenue, Barangay 176-B, Caloocan City', 13, '1944-12-08', 80, 'Caloocan City', 1, 1, '+639270900647', 'sample4.png', NULL, 'sample5.jpg', 'sample3.jpg', 'sample6.png', 5, 'Sa Kalsada lang po', 1, 4, 0, NULL, 1, 'Chronic pain conditions', 0, NULL, '2024-11-22', 'david.402.alfonso@example.com', '$2y$12$X8yfeRFj6ypBRKeCl4b08.A4lwyPqDyfTYzOBHpBwMBAkfmP4VXFS', NULL, NULL, '2024-06-03 01:31:25', NULL, NULL, NULL, 2, 'Savannah Reyes', 3, 'Kristoffer Cabigon', '2024-12-22', '2024-12-08 13:30:59', '2024-12-08 13:30:59'),
(55, '19385', '2024-01-21-19385', 4, NULL, 1, 'Timothy', 'De la Rosa', 'López', NULL, '6527 Phase 2 Block 59 Lot 41 Aquamarine Avenue, Barangay 179, Caloocan City', 20, '1931-12-08', 93, 'Dipolog City', 1, 3, '+639881979487', 'sample4.png', NULL, 'sample5.jpg', 'sample3.jpg', 'sample6.png', 1, NULL, 1, 2, 1, 5, 1, 'Anxiety disorders', 0, NULL, '2024-01-21', 'timothy.524.martinez@example.com', '$2y$12$IDre2WhKtB1ZoA764t5mZ.TXu/YG3kfNjcG6rcVMkbrZr7plmydae', NULL, NULL, '2024-05-26 19:53:56', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-02-21', '2024-12-08 13:30:59', '2024-12-08 13:30:59'),
(56, '16733', '2023-10-12-16733', 3, 1, 1, 'Mia', 'Lacuna', 'De la Vega', NULL, '4643 Phase 10 Block 62 Lot 38 Turquoise Road, Barangay 184, Caloocan City', 25, '1950-12-08', 74, 'San Jose del Monte City', 2, 2, '+639875575116', 'sample4.png', NULL, 'sample5.jpg', 'sample3.jpg', 'sample6.png', 2, NULL, 1, 3, 1, 1, 1, 'Vision impairment', 0, NULL, '2023-10-12', 'mia.531.esguerra@example.com', '$2y$12$DCVsx4LGRqiXKj4eB9acAetI92o2rRLxvUmNOoeff9hq.gHbkwegS', NULL, NULL, '2024-10-31 21:22:07', NULL, NULL, NULL, 3, 'Kristoffer Cabigon', 3, 'Kristoffer Cabigon', '2023-11-12', '2024-12-08 13:30:59', '2024-12-08 13:30:59'),
(57, '18566', '2023-03-31-18566', 3, 3, 1, 'Sarah', NULL, 'Santos', NULL, '9325 Phase 5 Block 41 Lot 1 Chico Road, Barangay 187, Caloocan City', 28, '1944-12-08', 80, 'Tarlac City', 2, 3, '+639582619409', 'sample4.png', NULL, 'sample5.jpg', 'sample3.jpg', 'sample6.png', 4, NULL, 0, NULL, 1, 9, 1, 'Hypertension', 0, NULL, '2023-03-31', 'sarah.346.dizon@example.com', '$2y$12$AdlQo6P.By.1J.FVyw6dOOtoxsLXMf8/UxnJq1T1uUWzCqUhdCkY.', NULL, NULL, '2024-07-22 23:12:55', NULL, NULL, NULL, 2, 'Cynthia Villafuerte', 3, 'Kristoffer Cabigon', '2023-05-01', '2024-12-08 13:30:59', '2024-12-08 13:30:59'),
(58, '17294', '2023-01-15-17294', 3, 4, 1, 'Scott', 'Vera', 'Bacani', 'III', '9029 Phase 5 Block 12 Lot 48 Magnolia Avenue, Barangay 172, Caloocan City', 8, '1951-12-08', 73, 'Cotabato City', 1, 4, '+639391624796', 'sample4.png', NULL, 'sample5.jpg', 'sample3.jpg', 'sample6.png', 2, NULL, 0, NULL, 1, 1, 0, NULL, 0, NULL, '2023-01-15', 'scott.933.delatorre@example.com', '$2y$12$NpopD1AXWPfEpzK.5IE3.uYpUp8xFeDgpZt2VCGC94txFSyHSDH1e', NULL, NULL, '2024-05-10 15:18:50', NULL, NULL, NULL, 3, 'Kristoffer Cabigon', 3, 'Kristoffer Cabigon', '2023-02-15', '2024-12-08 13:30:59', '2024-12-08 13:30:59'),
(59, '17941', '2023-08-21-17941', 3, 2, 1, 'Nathan', 'López', 'Villanueva', 'Jr.', '5848 Phase 3 Block 48 Lot 3 Carnation Road, Barangay 177, Caloocan City', 18, '1939-12-08', 85, 'Dumaguete City', 1, 4, '+639531886261', 'sample4.png', NULL, 'sample5.jpg', 'sample3.jpg', 'sample6.png', 3, NULL, 0, NULL, 0, NULL, 0, NULL, 0, NULL, '2023-08-21', 'nathan.392.bañez@example.com', '$2y$12$SR8gHjPz3cTU6DCr7N7ajepQCoEG2UsJe8r9UVoUyj0irHgvlmXFu', NULL, NULL, '2024-10-14 06:44:51', NULL, NULL, NULL, 3, 'Kristoffer Cabigon', 2, 'David Alvarez', '2023-09-21', '2024-12-08 13:30:59', '2024-12-08 13:30:59'),
(60, '10403', '2024-10-06-10403', 3, 4, 1, 'Karen', 'Cabigon', 'Martelino', NULL, '7140 Phase 9 Block 22 Lot 8 Lily Avenue, Barangay 186, Caloocan City', 27, '1959-12-08', 65, 'Legazpi City', 2, 1, '+639341863271', 'sample4.png', NULL, 'sample5.jpg', 'sample3.jpg', 'sample6.png', 5, 'Living as a Nomad', 1, 6, 1, 8, 0, NULL, 1, 'Mobility impairment', '2024-10-06', 'karen.751.tabujara@example.com', '$2y$12$39eqqqfkUN9iIKBbe083kOiVfbs9GwxETSDbfCzhdb0vl731z6Y2a', NULL, NULL, '2024-11-30 01:13:47', NULL, NULL, NULL, 3, 'Kristoffer Cabigon', 3, 'Kristoffer Cabigon', '2024-11-06', '2024-12-08 13:30:59', '2024-12-08 13:30:59'),
(61, '26923', '2024-03-15-26923', 3, 3, 1, 'Dorothy', 'De Guzman', 'Zaragoza', NULL, '2708 Phase 8 Block 45 Lot 37 Matamis Street, Barangay 187, Caloocan City', 28, '1953-12-08', 71, 'San Jose del Monte City', 2, 1, '+639944000930', 'sample4.png', NULL, 'sample5.jpg', 'sample3.jpg', 'sample6.png', 4, NULL, 0, NULL, 0, NULL, 1, 'Chronic pain conditions', 0, NULL, '2024-03-15', 'dorothy.811.ocampo@example.com', '$2y$12$hEsmMAuB.6bA2OP2AUtHbO9lrod5bvsJcR1042IpCXZQPV/.9TGdm', NULL, NULL, '2024-04-21 02:31:10', NULL, NULL, NULL, 3, 'Kristoffer Cabigon', 3, 'Kristoffer Cabigon', '2024-04-15', '2024-12-08 13:30:59', '2024-12-08 13:30:59'),
(62, '91719', '2024-11-23-91719', 2, NULL, 1, 'Dorothy', 'Nieves', 'Alvarez', NULL, '3376 Phase 1 Block 5 Lot 7 Zinnia Drive, Barangay 178, Caloocan City', 19, '1953-12-08', 71, 'Quezon City', 2, 3, '+639398095923', 'sample4.png', NULL, 'sample5.jpg', 'sample3.jpg', 'sample6.png', 1, NULL, 0, NULL, 0, NULL, 1, 'Vision impairment', 0, NULL, '2024-11-23', 'dorothy.571.dejesus@example.com', '$2y$12$iEs4BYwzFaUR3pCyoAyk0esiqqwWg97hmr9QLpryVTFrhARU2ewn2', NULL, NULL, '2024-10-07 18:10:48', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-12-23', '2024-12-08 13:30:59', '2024-12-08 13:30:59'),
(63, '80008', '2023-11-08-80008', 1, NULL, 1, 'Karen', 'Castañeda', 'Cabigon', NULL, '8928 Phase 2 Block 19 Lot 82 Magnolia Avenue, Barangay 184, Caloocan City', 25, '1935-12-08', 89, 'Zamboanga City', 2, 1, '+639802623212', 'sample4.png', NULL, 'sample5.jpg', 'sample3.jpg', 'sample6.png', 2, NULL, 1, 8, 1, 2, 0, NULL, 1, 'Visual impairment', '2023-11-08', 'karen.845.santos@example.com', '$2y$12$cgKKhxtM2eGZHGkuD2jKkeRgm8kAZLqMwLX.Q61T2bqtdoNLf1dQK', NULL, NULL, '2024-04-08 16:45:54', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-12-08', '2024-12-08 13:31:00', '2024-12-08 13:31:00'),
(64, '81445', '2023-07-15-81445', 3, 4, 1, 'Mia', 'Arroyo', 'Villanueva', NULL, '9078 Phase 1 Block 82 Lot 27 Gold Boulevard, Barangay 176-B, Caloocan City', 13, '1938-12-08', 86, 'Taguig City', 2, 3, '+639692682678', 'sample4.png', NULL, 'sample5.jpg', 'sample3.jpg', 'sample6.png', 5, 'Naninirahan lang', 1, 6, 1, 4, 1, 'Chronic obstructive pulmonary disease (COPD)', 1, 'Cognitive disability', '2023-07-15', 'mia.992.velasquez@example.com', '$2y$12$tnBulVr207.OePtN77MKQuWw.jyRUKYx9gBOoK0M.ub0JZCKIulJy', NULL, NULL, '2024-11-08 04:30:49', NULL, NULL, NULL, 2, 'Anthony Cruz', 3, 'Kristoffer Cabigon', '2023-08-15', '2024-12-08 13:31:00', '2024-12-08 13:31:00'),
(65, '37485', '2024-05-05-37485', 3, 3, 1, 'Ella', 'Cruz', 'Santos', NULL, '5261 Phase 3 Block 50 Lot 6 Anahaw Road, Barangay 185, Caloocan City', 26, '1946-12-08', 78, 'Naga City', 2, 1, '+639940428011', 'sample4.png', NULL, 'sample5.jpg', 'sample3.jpg', 'sample6.png', 5, 'Walang permanenteng tirahan', 0, NULL, 0, NULL, 1, 'Anxiety disorders', 0, NULL, '2024-05-05', 'ella.942.castañeda@example.com', '$2y$12$Sn4RNiMQfMWo3lD3CcI3y.jvWSzb24zWmrl9tWsBB4dIrlZkkEdkK', NULL, NULL, '2024-08-13 03:39:13', NULL, NULL, NULL, 2, 'Mark Nieves', 3, 'Kristoffer Cabigon', '2024-06-05', '2024-12-08 13:31:00', '2024-12-08 13:31:00'),
(66, '76859', '2023-05-28-76859', 3, 1, 1, 'Paul', 'De Guzman', 'Delos Reyes', NULL, '2775 Phase 5 Block 66 Lot 55 Gardenia Boulevard, Barangay 182, Caloocan City', 23, '1939-12-08', 85, 'Legazpi City', 1, 2, '+639313448341', 'sample4.png', NULL, 'sample5.jpg', 'sample3.jpg', 'sample6.png', 2, NULL, 0, NULL, 0, NULL, 1, 'Chronic obstructive pulmonary disease (COPD)', 1, 'Visual impairment', '2023-05-28', 'paul.730.torres@example.com', '$2y$12$8bNSMkjiegqMoclcx7Lh5usmHw0a9p.i1AAhz0yxKRsfoO7Jr5kdW', NULL, NULL, '2024-04-06 09:11:02', NULL, NULL, NULL, 2, 'Charles De Guzman', 2, 'Anthony Cruz', '2023-06-28', '2024-12-08 13:31:00', '2024-12-08 13:31:00'),
(67, '78599', '2023-11-28-78599', 3, 2, 1, 'Ruth', 'Chua', 'Salinas', NULL, '3117 Phase 2 Block 85 Lot 72 Lily Avenue, Barangay 179, Caloocan City', 20, '1939-12-08', 85, 'Mandaluyong City', 2, 1, '+639394380773', 'sample4.png', NULL, 'sample5.jpg', 'sample3.jpg', 'sample6.png', 2, NULL, 0, NULL, 1, 8, 1, 'Heart disease', 0, NULL, '2023-11-28', 'ruth.195.delossantos@example.com', '$2y$12$cPYs9qMjVyl9XnO3KhSdlOk6n/wpy00aodEqT.SPm0c22u8YxL07O', NULL, NULL, '2024-01-16 22:40:40', NULL, NULL, NULL, 2, 'Anthony Cruz', 3, 'Kristoffer Cabigon', '2023-12-28', '2024-12-08 13:31:00', '2024-12-08 13:31:00'),
(68, '30209', '2024-01-16-30209', 2, NULL, 1, 'Andrew', 'De Guzman', 'Flores', NULL, '6581 Phase 6 Block 85 Lot 15 Cherry Drive, Barangay 176-A, Caloocan City', 12, '1952-12-08', 72, 'Calapan City', 1, 2, '+639443271090', 'sample4.png', NULL, 'sample5.jpg', 'sample3.jpg', 'sample6.png', 5, 'Sa Kalsada lang po', 0, NULL, 1, 10, 0, NULL, 0, NULL, '2024-01-16', 'andrew.881.cortez@example.com', '$2y$12$WjjklN9/.Pks6ZR9AnNOcOAQdsC.KW4NE0EjFzshOCefQxbnO2WbC', NULL, NULL, '2024-08-16 22:46:22', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-02-16', '2024-12-08 13:31:00', '2024-12-08 13:31:00'),
(69, '35799', '2024-07-17-35799', 4, NULL, 1, 'William', 'Alvarez', 'Garcia', 'III', '4960 Phase 6 Block 72 Lot 7 Santol Street, Barangay 174, Caloocan City', 10, '1938-12-08', 86, 'Naga City', 1, 4, '+639200591852', 'sample4.png', NULL, 'sample5.jpg', 'sample3.jpg', 'sample6.png', 4, NULL, 0, NULL, 0, NULL, 0, NULL, 1, 'Hearing impairment', '2024-07-17', 'william.902.martinez@example.com', '$2y$12$x1A/FxMmkyTOegMbPROGhOUYjtBY8vmxgAs6vKe9At/R3asRLIf52', NULL, NULL, '2024-04-08 09:43:25', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-08-17', '2024-12-08 13:31:00', '2024-12-08 13:31:00'),
(70, '70087', '2024-07-08-70087', 3, 1, 1, 'Ella', 'Ponce', 'Arroyo', NULL, '3719 Phase 10 Block 16 Lot 22 Emerald Boulevard, Barangay 173, Caloocan City', 9, '1949-12-08', 75, 'Zamboanga City', 2, 2, '+639554159891', 'sample4.png', NULL, 'sample5.jpg', 'sample3.jpg', 'sample6.png', 1, NULL, 1, 8, 1, 6, 1, 'Depression', 1, 'Mental health condition', '2024-07-08', 'ella.60.lacuna@example.com', '$2y$12$bKXIhvKF4y3lh4fldcYBouLcntkFSqvMff1cPZGg2dErSt2nwrdku', NULL, NULL, '2024-03-15 01:05:40', NULL, NULL, NULL, 3, 'Kristoffer Cabigon', 2, 'Mark Nieves', '2024-08-08', '2024-12-08 13:31:00', '2024-12-08 13:31:00'),
(71, '49212', '2023-08-01-49212', 2, NULL, 1, 'David', 'Misa', 'Zaragoza', NULL, '9166 Phase 3 Block 18 Lot 59 Tulip Road, Barangay 185, Caloocan City', 26, '1948-12-08', 76, 'Santiago City', 1, 1, '+639772896776', 'sample4.png', NULL, 'sample5.jpg', 'sample3.jpg', 'sample6.png', 1, NULL, 0, NULL, 0, NULL, 0, NULL, 0, NULL, '2023-08-01', 'david.558.delavega@example.com', '$2y$12$VkhNf8P2rpJDbrpnIgN7Xek82UdHd5Z3fFzIkc9e13UKYZRn0fSlC', NULL, NULL, '2024-11-13 17:10:29', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-09-01', '2024-12-08 13:31:00', '2024-12-08 13:31:00'),
(72, '53335', '2024-01-24-53335', 4, NULL, 1, 'Laura', 'Gumabay', 'Gumabay', NULL, '7565 Phase 10 Block 49 Lot 82 Gemini Street, Barangay 185, Caloocan City', 26, '1925-12-08', 99, 'Bacoor City', 2, 4, '+639268795211', 'sample4.png', NULL, 'sample5.jpg', 'sample3.jpg', 'sample6.png', 1, NULL, 1, 2, 1, 9, 0, NULL, 0, NULL, '2024-01-24', 'laura.275.delmundo@example.com', '$2y$12$V3Zwu5kmgjk7tOZo0cByQeO2kNdNqZTOLbvD9r.otetPF7/3fOGJy', NULL, NULL, '2024-05-25 12:54:07', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-02-24', '2024-12-08 13:31:00', '2024-12-08 13:31:00'),
(73, '52416', '2024-09-09-52416', 4, NULL, 1, 'Michael', 'Alcantara', 'Cruzado', 'II', '1583 Phase 3 Block 6 Lot 45 Matahimik Avenue, Barangay 177, Caloocan City', 18, '1945-12-08', 79, 'Bayugan City', 1, 4, '+639777512203', 'sample4.png', NULL, 'sample5.jpg', 'sample3.jpg', 'sample6.png', 4, NULL, 1, 5, 1, 11, 1, 'Stroke', 0, NULL, '2024-09-09', 'michael.372.velasquez@example.com', '$2y$12$/IG65hXKH39DiVnjQ6LOz.TjBGWUm0WF95b7DQrnmME/kLQsOgIm.', NULL, NULL, '2024-03-31 19:17:04', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-10-09', '2024-12-08 13:31:00', '2024-12-08 13:31:00'),
(74, '82982', '2023-09-02-82982', 3, 4, 1, 'Madison', 'De Jesus', 'Cabarroguis', NULL, '2663 Phase 6 Block 45 Lot 81 Marangal Drive, Barangay 177, Caloocan City', 18, '1936-12-08', 88, 'Davao City', 2, 2, '+639127204880', 'sample4.png', NULL, 'sample5.jpg', 'sample3.jpg', 'sample6.png', 3, NULL, 0, NULL, 1, 11, 1, 'Kidney disease', 0, NULL, '2023-09-02', 'madison.179.delatorre@example.com', '$2y$12$XGdTYTcxV4cK3OvjX52d3O1dKzw7An7uNvvcgUUL..EJ8rjqYIE0q', NULL, NULL, '2024-10-07 11:22:31', NULL, NULL, NULL, 2, 'Michael Soriano', 3, 'Kristoffer Cabigon', '2023-10-02', '2024-12-08 13:31:00', '2024-12-08 13:31:00'),
(75, '31153', '2023-12-12-31153', 4, NULL, 1, 'Timothy', 'Matias', 'López', NULL, '7608 Phase 4 Block 38 Lot 4 Siniguelas Drive, Barangay 176-F, Caloocan City', 17, '1947-12-08', 77, 'Marikina City', 1, 3, '+639546723009', 'sample4.png', NULL, 'sample5.jpg', 'sample3.jpg', 'sample6.png', 1, NULL, 0, NULL, 1, 3, 0, NULL, 0, NULL, '2023-12-12', 'timothy.17.delavega@example.com', '$2y$12$8TSTAeIPrRIssO0v2Zgwq.bfCP3rYHvZZ/duQR60QF1zt7DdXpNN2', NULL, NULL, '2024-04-23 07:16:32', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-01-12', '2024-12-08 13:31:00', '2024-12-08 13:31:00'),
(76, '78597', '2023-04-18-78597', 2, NULL, 1, 'Nancy', 'Santos', 'Alvarez', NULL, '6659 Phase 1 Block 28 Lot 5 Guyabano Avenue, Barangay 172, Caloocan City', 8, '1956-12-08', 68, 'Tacloban City', 2, 4, '+639279641420', 'sample4.png', NULL, 'sample5.jpg', 'sample3.jpg', 'sample6.png', 2, NULL, 1, 4, 0, NULL, 1, 'Osteoporosis', 0, NULL, '2023-04-18', 'nancy.180.suarez@example.com', '$2y$12$L4SpqAThMihUMoXpgCSm4uPyTtatbLzJCeK3e8xXULvHvfeePEhuS', NULL, NULL, '2024-04-02 16:03:11', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-05-18', '2024-12-08 13:31:01', '2024-12-08 13:31:01'),
(77, '38133', '2024-01-20-38133', 3, 2, 1, 'Nancy', 'Naguit', 'Nieves', NULL, '4070 Phase 2 Block 14 Lot 5 Turquoise Road, Barangay 171, Caloocan City', 7, '1929-12-08', 95, 'Cotabato City', 2, 3, '+639156152944', 'sample4.png', NULL, 'sample5.jpg', 'sample3.jpg', 'sample6.png', 2, NULL, 1, 3, 1, 5, 0, NULL, 0, NULL, '2024-01-20', 'nancy.987.deocampo@example.com', '$2y$12$oJdqJ/HgcZTVSrZe0Qugzuq2WTq7SPvn2.bdmHMce61.G3YbGFSva', NULL, NULL, '2024-03-07 10:47:08', NULL, NULL, NULL, 2, 'David Alvarez', 3, 'Kristoffer Cabigon', '2024-02-20', '2024-12-08 13:31:01', '2024-12-08 13:31:01'),
(78, '70506', '2024-08-30-70506', 3, 3, 1, 'Elizabeth', 'Bañez', 'Pineda', NULL, '6258 Phase 7 Block 39 Lot 80 Marigold Street, Barangay 183, Caloocan City', 24, '1949-12-08', 75, 'Calapan City', 2, 4, '+639817063215', 'sample4.png', NULL, 'sample5.jpg', 'sample3.jpg', 'sample6.png', 3, NULL, 1, 1, 1, 1, 0, NULL, 1, 'Mental health condition', '2024-08-30', 'elizabeth.778.villanueva@example.com', '$2y$12$/gjr1fqL9M3tdQ0WsabHSu/YO6E3gFOvBXx34m/De0ENpOi/EAnQi', NULL, NULL, '2024-02-11 09:55:30', NULL, NULL, NULL, 3, 'Kristoffer Cabigon', 2, 'Eric Tabujara', '2024-09-30', '2024-12-08 13:31:01', '2024-12-08 13:31:01'),
(79, '77212', '2022-12-18-77212', 3, 4, 1, 'Donald', 'Del Castillo', 'Tonio', 'Jr.', '3107 Phase 9 Block 62 Lot 50 Champaca Street, Barangay 172, Caloocan City', 8, '1956-12-08', 68, 'Taguig City', 1, 1, '+639747058502', 'sample4.png', NULL, 'sample5.jpg', 'sample3.jpg', 'sample6.png', 2, NULL, 1, 4, 1, 10, 1, 'Stroke', 0, NULL, '2022-12-18', 'donald.259.esguerra@example.com', '$2y$12$Ub1nhYmNaihjzIGq5PgDeeL1xsr.1xkOvdOmRnog9IaT0D.IG2kZ6', NULL, NULL, '2024-10-26 22:18:05', NULL, NULL, NULL, 2, 'Jessica Villanueva', 2, 'Anthony Cruz', '2023-01-18', '2024-12-08 13:31:01', '2024-12-08 13:31:01'),
(80, '20561', '2023-04-16-20561', 3, 2, 1, 'Sarah', 'Alcaraz', 'Villafuerte', NULL, '7519 Phase 6 Block 43 Lot 66 Carnation Road, Barangay 167, Caloocan City', 3, '1939-12-08', 85, 'Digos City', 2, 1, '+639448645719', 'sample4.png', NULL, 'sample5.jpg', 'sample3.jpg', 'sample6.png', 5, 'Living with a Legal Guardian', 1, 4, 1, 1, 0, NULL, 0, NULL, '2023-04-16', 'sarah.667.cruz@example.com', '$2y$12$vyeaSsYYQp5R27u6e.UhXeIFfyboP0FQgL7T6FDuP4.Q63h4MA9NW', NULL, NULL, '2024-08-03 12:55:15', NULL, NULL, NULL, 3, 'Kristoffer Cabigon', 3, 'Kristoffer Cabigon', '2023-05-16', '2024-12-08 13:31:01', '2024-12-08 13:31:01');
INSERT INTO `seniors` (`id`, `osca_id`, `ncsc_rrn`, `application_status_id`, `account_status_id`, `user_type_id`, `first_name`, `middle_name`, `last_name`, `suffix`, `address`, `barangay_id`, `birthdate`, `age`, `birthplace`, `sex_id`, `civil_status_id`, `contact_no`, `valid_id`, `profile_picture`, `indigency`, `birth_certificate`, `signature_data`, `type_of_living_arrangement`, `other_arrangement_remark`, `pensioner`, `if_pensioner_yes`, `permanent_source`, `if_permanent_yes_income`, `has_illness`, `if_illness_yes`, `has_disability`, `if_disability_yes`, `date_applied`, `email`, `password`, `verification_code`, `verification_expires_at`, `verified_at`, `token`, `remember_token`, `expiration`, `application_assistant_id`, `application_assistant_name`, `registration_assistant_id`, `registration_assistant_name`, `date_approved`, `created_at`, `updated_at`) VALUES
(81, '51369', '2023-06-24-51369', 3, 4, 1, 'David', 'Castañeda', 'De la Vega', NULL, '4422 Phase 8 Block 12 Lot 31 Malolos Avenue, Barangay 176-A, Caloocan City', 12, '1926-12-08', 98, 'Cagayan de Oro City', 1, 2, '+639542436373', 'sample4.png', NULL, 'sample5.jpg', 'sample3.jpg', 'sample6.png', 3, NULL, 0, NULL, 0, NULL, 0, NULL, 0, NULL, '2023-06-24', 'david.790.villanueva@example.com', '$2y$12$lYuCrNSFXZroJI12ghvoRuUYtulY7ysTRDIoGPK8S0Cis7nZs.IOO', NULL, NULL, '2024-10-13 22:52:32', NULL, NULL, NULL, 2, 'Kristoffer Cabigon', 2, 'Charlotte Martelino', '2023-07-24', '2024-12-08 13:31:01', '2024-12-08 13:31:01'),
(82, '65850', '2024-01-01-65850', 3, 4, 1, 'Joseph', 'Sarmiento', 'De Guzman', 'Sr.', '5714 Phase 6 Block 46 Lot 61 Sampaguita Street, Barangay 170, Caloocan City', 6, '1935-12-08', 89, 'Iligan City', 1, 4, '+639598809964', 'sample4.png', NULL, 'sample5.jpg', 'sample3.jpg', 'sample6.png', 4, NULL, 0, NULL, 1, 1, 0, NULL, 0, NULL, '2024-01-01', 'joseph.492.flores@example.com', '$2y$12$zPcGtkDoOUijNC5lTV.zu.0tj/ETliXaWdmxM/RPZdhztYT2r1gWu', NULL, NULL, '2024-11-24 14:04:54', NULL, NULL, NULL, 2, 'Anthony Cruz', 3, 'Kristoffer Cabigon', '2024-02-01', '2024-12-08 13:31:01', '2024-12-08 13:31:01'),
(83, '99490', '2024-04-18-99490', 2, NULL, 1, 'Timothy', 'Martelino', 'Magsaysay', 'Sr.', '6758 Phase 3 Block 78 Lot 82 Maharlika Avenue, Barangay 180, Caloocan City', 21, '1931-12-08', 93, 'Lapu-Lapu City', 1, 3, '+639886045151', 'sample4.png', NULL, 'sample5.jpg', 'sample3.jpg', 'sample6.png', 1, NULL, 0, NULL, 0, NULL, 1, 'Kidney disease', 1, 'Mobility impairment', '2024-04-18', 'timothy.432.delcastillo@example.com', '$2y$12$q8d96/lyYKQBxCVObOPzWeQifOjlt0SUtr4jw31f31UhQ/AZ9.23a', NULL, NULL, '2024-11-22 07:33:54', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-05-18', '2024-12-08 13:31:01', '2024-12-08 13:31:01'),
(84, '16412', '2024-04-16-16412', 4, NULL, 1, 'Sarah', 'Dela Cruz', 'Cruzado', NULL, '4130 Phase 10 Block 26 Lot 3 Amethyst Drive, Barangay 176-E, Caloocan City', 16, '1950-12-08', 74, 'Dipolog City', 2, 2, '+639147208908', 'sample4.png', NULL, 'sample5.jpg', 'sample3.jpg', 'sample6.png', 5, 'Incarcerated or Detained', 0, NULL, 1, 5, 1, 'Alzheimer disease', 0, NULL, '2024-04-16', 'sarah.430.lópez@example.com', '$2y$12$8fed6eVn0yBQhmA7zg.JmeCexWltEgrSKuGLamNbjeDRx278TbdGu', NULL, NULL, '2024-04-20 00:46:16', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-05-16', '2024-12-08 13:31:01', '2024-12-08 13:31:01'),
(85, '51095', '2024-07-27-51095', 4, NULL, 1, 'Nathan', NULL, 'Morales', NULL, '6146 Phase 8 Block 30 Lot 18 Mabait Drive, Barangay 173, Caloocan City', 9, '1947-12-08', 77, 'Tagum City', 1, 2, '+639669360530', 'sample4.png', NULL, 'sample5.jpg', 'sample3.jpg', 'sample6.png', 1, NULL, 0, NULL, 0, NULL, 0, NULL, 0, NULL, '2024-07-27', 'nathan.548.delmundo@example.com', '$2y$12$6axYHx3EeMKgA38DLfRR2O.QYvqQu6mPbRwuABZOdzwIsWqKX9u8q', NULL, NULL, '2024-10-10 18:48:45', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-08-27', '2024-12-08 13:31:01', '2024-12-08 13:31:01'),
(86, '55911', '2023-07-29-55911', 1, NULL, 1, 'Edward', 'Vera', 'Ramos', 'Jr.', '7215 Phase 6 Block 61 Lot 71 Masaya Road, Barangay 175, Caloocan City', 11, '1934-12-08', 90, 'Calamba City', 1, 4, '+639476550722', 'sample4.png', NULL, 'sample5.jpg', 'sample3.jpg', 'sample6.png', 5, 'Living with a Legal Guardian', 1, 11, 1, 11, 1, 'Hypertension', 1, 'Mobility impairment', '2023-07-29', 'edward.78.delossantos@example.com', '$2y$12$Ae0jvk/m7/CqHzqbd/s0subskNwiEy0cmzBZ9DLPugP7ptW2jsI6u', NULL, NULL, '2023-12-18 10:12:28', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-08-29', '2024-12-08 13:31:01', '2024-12-08 13:31:01'),
(87, '90780', '2022-12-27-90780', 1, NULL, 1, 'Ava', 'Dela Torre', 'Salvador', NULL, '8297 Phase 4 Block 17 Lot 67 Onyx Drive, Barangay 176-E, Caloocan City', 16, '1945-12-08', 79, 'Caloocan City', 2, 4, '+639127804988', 'sample4.png', NULL, 'sample5.jpg', 'sample3.jpg', 'sample6.png', 1, NULL, 0, NULL, 0, NULL, 0, NULL, 0, NULL, '2022-12-27', 'ava.740.ponce@example.com', '$2y$12$BicmihtepLQhYvYx/LIJOedvY1Iv3BSbhNhvhD17R1jr4CzsSrddK', NULL, NULL, '2024-03-21 17:56:37', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-01-27', '2024-12-08 13:31:01', '2024-12-08 13:31:01'),
(88, '71005', '2023-01-30-71005', 1, NULL, 1, 'Donald', 'Misa', 'Castillo', NULL, '9418 Phase 8 Block 82 Lot 49 Ilang-Ilang Drive, Barangay 167, Caloocan City', 3, '1955-12-08', 69, 'Cotabato City', 1, 4, '+639809847165', 'sample4.png', NULL, 'sample5.jpg', 'sample3.jpg', 'sample6.png', 3, NULL, 1, 2, 1, 11, 1, 'Hypothyroidism', 0, NULL, '2023-01-30', 'donald.249.esguerra@example.com', '$2y$12$vlNSymhwxrUjiw8y6TJXbufOvwKLU7WnbP3rIJReBm3K4o13IFete', NULL, NULL, '2024-10-19 20:08:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-03-02', '2024-12-08 13:31:02', '2024-12-08 13:31:02'),
(89, '65622', '2024-11-29-65622', 3, 4, 1, 'Mia', 'Macapagal', 'Riviera', NULL, '2937 Phase 2 Block 8 Lot 90 Tulip Road, Barangay 176-C, Caloocan City', 14, '1924-12-08', 100, 'Makati City', 2, 4, '+639809583387', 'sample4.png', NULL, 'sample5.jpg', 'sample3.jpg', 'sample6.png', 3, NULL, 0, NULL, 0, NULL, 1, 'Heart disease', 1, 'Hearing impairment', '2024-11-29', 'mia.596.dejesus@example.com', '$2y$12$rG8Ob5X14A0B3eP8CUHvGuEiodSBaoj/3JU/zLQrGPgLR0jSgwKF6', NULL, NULL, '2024-07-11 13:25:25', NULL, NULL, NULL, 3, 'Kristoffer Cabigon', 3, 'Kristoffer Cabigon', '2024-12-29', '2024-12-08 13:31:02', '2024-12-08 13:31:02'),
(90, '79367', '2024-04-26-79367', 1, NULL, 1, 'Patricia', 'Bañez', 'De la Rosa', NULL, '9765 Phase 5 Block 64 Lot 63 Cherry Drive, Barangay 187, Caloocan City', 28, '1945-12-08', 79, 'Iloilo City', 2, 1, '+639577100503', 'sample4.png', NULL, 'sample5.jpg', 'sample3.jpg', 'sample6.png', 5, 'Living in a Commune or Cooperative Housing', 0, NULL, 0, NULL, 1, 'Kidney disease', 0, NULL, '2024-04-26', 'patricia.620.cruz@example.com', '$2y$12$0ACsInGq4l0Y0b76YzSZ6u32.SjYlxa5NMz1IVj5y2tFvOiAtG6/W', NULL, NULL, '2023-12-22 11:45:10', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-05-26', '2024-12-08 13:31:02', '2024-12-08 13:31:02'),
(91, '23119', '2023-05-26-23119', 3, 1, 1, 'Ruth', 'San Pedro', 'Cruz', NULL, '1320 Phase 5 Block 74 Lot 27 Saturn Street, Barangay 183, Caloocan City', 24, '1937-12-08', 87, 'Legazpi City', 2, 3, '+639633993192', 'sample4.png', NULL, 'sample5.jpg', 'sample3.jpg', 'sample6.png', 3, NULL, 0, NULL, 1, 11, 0, NULL, 0, NULL, '2023-05-26', 'ruth.989.gumabay@example.com', '$2y$12$TLt4s8PJeqwYD0HCPKclXeZiFnDPNoLUu9elEg4Ib46gCY1H7YTC2', NULL, NULL, '2024-07-14 06:31:43', NULL, NULL, NULL, 2, 'John Misa', 2, 'Aria Bañez', '2023-06-26', '2024-12-08 13:31:02', '2024-12-08 13:31:02'),
(92, '32229', '2024-10-10-32229', 3, 2, 1, 'Anthony', 'Rosales', 'Dela Cruz', 'II', '6917 Phase 3 Block 70 Lot 86 Marangal Drive, Barangay 168, Caloocan City', 4, '1937-12-08', 87, 'Davao City', 1, 3, '+639125187759', 'sample4.png', NULL, 'sample5.jpg', 'sample3.jpg', 'sample6.png', 1, NULL, 0, NULL, 1, 2, 0, NULL, 1, 'Mental health condition', '2024-10-10', 'anthony.760.delossantos@example.com', '$2y$12$LBWzKjPJIMMY.E1WXCnP9O/EQHP/Np7pU5p0yfHTStfTsuZtgjnAi', NULL, NULL, '2024-11-09 05:20:46', NULL, NULL, NULL, 3, 'Kristoffer Cabigon', 2, 'Eric Mendoza', '2024-11-10', '2024-12-08 13:31:02', '2024-12-08 13:31:02'),
(93, '27542', '2024-05-10-27542', 3, 2, 1, 'Justin', 'Riviera', 'Gumabay', 'III', '1163 Phase 2 Block 74 Lot 80 Masaya Road, Barangay 176-C, Caloocan City', 14, '1934-12-08', 90, 'General Santos City', 1, 4, '+639002133585', 'sample4.png', NULL, 'sample5.jpg', 'sample3.jpg', 'sample6.png', 1, NULL, 0, NULL, 1, 1, 1, 'Diabetes', 0, NULL, '2024-05-10', 'justin.29.dejesus@example.com', '$2y$12$j0b6rCaYnGC39GgpWAXb..lyaVL/Kk0uTPRShtFBPsJ7mlS2/rVYK', NULL, NULL, '2024-02-24 15:49:06', NULL, NULL, NULL, 2, 'Eric Mendoza', 3, 'Kristoffer Cabigon', '2024-06-10', '2024-12-08 13:31:02', '2024-12-08 13:31:02'),
(94, '97720', '2024-07-04-97720', 1, NULL, 1, 'William', 'Gonzales', 'Alcaraz', NULL, '6564 Phase 4 Block 26 Lot 11 Petunia Road, Barangay 165, Caloocan City', 1, '1962-12-08', 62, 'Calapan City', 1, 1, '+639065777664', 'sample4.png', NULL, 'sample5.jpg', 'sample3.jpg', 'sample6.png', 5, 'Living with Non-relatives', 0, NULL, 0, NULL, 1, 'Vision impairment', 0, NULL, '2024-07-04', 'william.864.deleon@example.com', '$2y$12$bg7.R3MbAuXyLzaeHFUWcudQ3GvgvTucLRUQYbfMcmgyTwEaOBhm.', NULL, NULL, '2024-06-15 01:32:36', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-08-04', '2024-12-08 13:31:02', '2024-12-08 13:31:02'),
(95, '73664', '2024-10-23-73664', 3, 3, 1, 'Andrew', 'Alvarado', 'López', NULL, '7043 Phase 6 Block 34 Lot 12 Sapphire Street, Barangay 176-F, Caloocan City', 17, '1935-12-08', 89, 'Iloilo City', 1, 3, '+639127081686', 'sample4.png', NULL, 'sample5.jpg', 'sample3.jpg', 'sample6.png', 2, NULL, 0, NULL, 0, NULL, 0, NULL, 0, NULL, '2024-10-23', 'andrew.600.alfonso@example.com', '$2y$12$be7eamzIVDkz2zhdC0Cy5Oefm8PC3.P4Vy76CMoT3EDR.u6tirZM.', NULL, NULL, '2024-01-21 03:21:42', NULL, NULL, NULL, 3, 'Kristoffer Cabigon', 3, 'Kristoffer Cabigon', '2024-11-23', '2024-12-08 13:31:02', '2024-12-08 13:31:02'),
(96, '65630', '2023-04-13-65630', 3, 1, 1, 'Kevin', 'Garcia', 'Gumabay', NULL, '8876 Phase 8 Block 18 Lot 85 Makisig Boulevard, Barangay 167, Caloocan City', 3, '1929-12-08', 95, 'Caloocan City', 1, 4, '+639652868313', 'sample4.png', NULL, 'sample5.jpg', 'sample3.jpg', 'sample6.png', 5, 'Walang permanenteng tirahan', 1, 11, 1, 3, 1, 'Stroke', 1, 'Cognitive disability', '2023-04-13', 'kevin.950.matias@example.com', '$2y$12$QzJYIPEAMGc0rj/fR7Dlp./6CZzc8yN6jUwkNKcF3yHsm2KgKE4gm', NULL, NULL, '2024-07-30 03:41:19', NULL, NULL, NULL, 2, 'Savannah Reyes', 2, 'Mark Nieves', '2023-05-13', '2024-12-08 13:31:02', '2024-12-08 13:31:02'),
(97, '97308', '2023-04-15-97308', 3, 1, 1, 'Daniel', 'De Jesus', 'Nieves', 'III', '6031 Phase 5 Block 16 Lot 67 Zinnia Drive, Barangay 186, Caloocan City', 27, '1960-12-08', 64, 'Iligan City', 1, 2, '+639815412998', 'sample4.png', NULL, 'sample5.jpg', 'sample3.jpg', 'sample6.png', 5, 'Incarcerated or Detained', 0, NULL, 1, 7, 1, 'Parkinson disease', 0, NULL, '2023-04-15', 'daniel.290.delacruz@example.com', '$2y$12$65emAtrqn3ee25J.81YUfeweDQN2edO0Ov0bNuLknFqXcl.yCgJF2', NULL, NULL, '2024-10-25 13:04:17', NULL, NULL, NULL, 3, 'Kristoffer Cabigon', 2, 'Thomas Delos Santos', '2023-05-15', '2024-12-08 13:31:02', '2024-12-08 13:31:02'),
(98, '22310', '2024-11-26-22310', 3, 2, 1, 'Emma', 'Cabarroguis', 'Aquino', NULL, '6513 Phase 8 Block 58 Lot 90 Violeta Street, Barangay 183, Caloocan City', 24, '1957-12-08', 67, 'Bayugan City', 2, 3, '+639547044028', 'sample4.png', NULL, 'sample5.jpg', 'sample3.jpg', 'sample6.png', 5, 'Living in a Residential Care Facility', 1, 1, 1, 7, 1, 'Hypothyroidism', 0, NULL, '2024-11-26', 'emma.413.macapagal@example.com', '$2y$12$LEpt2Jum1xa/hlmCIRmqC.1dSuAH.TC49wL0fc6.MEDm7rLEtjOXS', NULL, NULL, '2024-05-15 03:24:38', NULL, NULL, NULL, 3, 'Kristoffer Cabigon', 3, 'Kristoffer Cabigon', '2024-12-26', '2024-12-08 13:31:02', '2024-12-08 13:31:02'),
(99, '42269', '2023-04-03-42269', 4, NULL, 1, 'Scott', 'Cruz', 'Cabigon', NULL, '9854 Phase 4 Block 79 Lot 59 Magiting Street, Barangay 176-D, Caloocan City', 15, '1941-12-08', 83, 'Dumaguete City', 1, 3, '+639596575599', 'sample4.png', NULL, 'sample5.jpg', 'sample3.jpg', 'sample6.png', 3, NULL, 1, 2, 1, 7, 1, 'Chronic obstructive pulmonary disease (COPD)', 1, 'Visual impairment', '2023-04-03', 'scott.67.alfonso@example.com', '$2y$12$VA3oxSePJyD0Nb76dlZd1.DCNtbo.MgtZrwiNU.d3yVu5UeNSYlC6', NULL, NULL, '2024-06-17 13:31:19', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-05-03', '2024-12-08 13:31:02', '2024-12-08 13:31:02'),
(100, '19489', '2024-04-21-19489', 3, 4, 1, 'Jason', 'Pineda', 'Santiago', NULL, '9253 Phase 1 Block 14 Lot 66 Carnation Road, Barangay 176-B, Caloocan City', 13, '1950-12-08', 74, 'Marawi City', 1, 1, '+639516802000', 'sample4.png', NULL, 'sample5.jpg', 'sample3.jpg', 'sample6.png', 4, NULL, 0, NULL, 0, NULL, 1, 'Depression', 0, NULL, '2024-04-21', 'jason.821.delcastillo@example.com', '$2y$12$6d2ubVxNcGg.ifd.fFNzv.9zRUg8y7A/tsTHkDDONb689DwskAwEa', NULL, NULL, '2024-01-01 19:57:39', NULL, NULL, NULL, 3, 'Kristoffer Cabigon', 3, 'Kristoffer Cabigon', '2024-05-21', '2024-12-08 13:31:03', '2024-12-08 13:31:03'),
(101, '83410', '2023-02-20-83410', 2, NULL, 1, 'Sophia', 'De Leon', 'Riviera', NULL, '5370 Phase 3 Block 46 Lot 52 Orion Boulevard, Barangay 182, Caloocan City', 23, '1927-12-08', 97, 'Mandaluyong City', 2, 3, '+639362226823', 'sample4.png', NULL, 'sample5.jpg', 'sample3.jpg', 'sample6.png', 1, NULL, 0, NULL, 0, NULL, 1, 'Hypothyroidism', 1, 'Visual impairment', '2023-02-20', 'sophia.809.alvarez@example.com', '$2y$12$8rgFfGdcyxO7NqFkxt.nKO0avRnxygL2FBoEs01HJmFjlGx6O0LuC', NULL, NULL, '2024-02-24 16:19:40', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-03-20', '2024-12-08 13:31:03', '2024-12-08 13:31:03'),
(102, '84981', '2024-01-21-84981', 1, NULL, 1, 'Timothy', 'Vera', 'Misa', 'II', '4406 Phase 1 Block 13 Lot 34 Mabait Drive, Barangay 167, Caloocan City', 3, '1948-12-08', 76, 'Iligan City', 1, 2, '+639331748586', 'sample4.png', NULL, 'sample5.jpg', 'sample3.jpg', 'sample6.png', 5, 'Living with Extended Family', 1, 3, 0, NULL, 0, NULL, 0, NULL, '2024-01-21', 'timothy.650.manalo@example.com', '$2y$12$HpHKhW3CVDRIW/raChZ9U.xKqwbt/ClLjMJQCRDwY0o/cIx4K7aZK', NULL, NULL, '2024-11-04 03:44:11', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-02-21', '2024-12-08 13:31:03', '2024-12-08 13:31:03'),
(103, '38757', '2024-11-16-38757', 3, 1, 1, 'Amy', 'Ramos', 'Martinez', NULL, '1007 Phase 5 Block 63 Lot 55 Violeta Street, Barangay 169, Caloocan City', 5, '1951-12-08', 73, 'Baguio City', 2, 4, '+639606164977', 'sample4.png', NULL, 'sample5.jpg', 'sample3.jpg', 'sample6.png', 4, NULL, 0, NULL, 1, 7, 0, NULL, 1, 'Visual impairment', '2024-11-16', 'amy.679.bautista@example.com', '$2y$12$YPeXmNWY67NlwNvXxngpuulQ4.AbR.a9CATJvN7dyt9od298GSYMW', NULL, NULL, '2024-10-04 02:19:21', NULL, NULL, NULL, 3, 'Kristoffer Cabigon', 3, 'Kristoffer Cabigon', '2024-12-16', '2024-12-08 13:31:03', '2024-12-08 13:31:03'),
(104, '51449', '2023-03-13-51449', 2, NULL, 1, 'Donald', 'Pineda', 'Cruzado', 'III', '2060 Phase 8 Block 15 Lot 63 Matahimik Avenue, Barangay 176-A, Caloocan City', 12, '1926-12-08', 98, 'San Carlos City (Pangasinan)', 1, 2, '+639818471349', 'sample4.png', NULL, 'sample5.jpg', 'sample3.jpg', 'sample6.png', 4, NULL, 1, 7, 0, NULL, 0, NULL, 0, NULL, '2023-03-13', 'donald.484.soriano@example.com', '$2y$12$LOL5hD7aGZdhUH1E6CuwZu9DBz3fjTsERdTrKk9G.MiQtFQsU8oOm', NULL, NULL, '2024-02-20 18:39:57', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-04-13', '2024-12-08 13:31:03', '2024-12-08 13:31:03'),
(105, '12053', '2023-07-12-12053', 3, 2, 1, 'Stephen', 'De Leon', 'Bañez', 'II', '8324 Phase 5 Block 18 Lot 58 Hydrangea Road, Barangay 176-A, Caloocan City', 12, '1943-12-08', 81, 'Marawi City', 1, 2, '+639415349142', 'sample4.png', NULL, 'sample5.jpg', 'sample3.jpg', 'sample6.png', 4, NULL, 0, NULL, 1, 4, 0, NULL, 0, NULL, '2023-07-12', 'stephen.863.martinez@example.com', '$2y$12$qxZR1hId2.oNdcZ/3BZEGOqCWQ0UEOrOiYWVF7EIDjC51GtIH.G3q', NULL, NULL, '2024-07-31 09:50:25', NULL, NULL, NULL, 2, 'Larry Flores', 2, 'Karen Villanueva', '2023-08-12', '2024-12-08 13:31:03', '2024-12-08 13:31:03'),
(106, '96627', '2023-08-16-96627', 3, 4, 1, 'Eric', 'Pineda', 'López', NULL, '8169 Phase 6 Block 59 Lot 81 Amethyst Drive, Barangay 177, Caloocan City', 18, '1928-12-08', 96, 'Dumaguete City', 1, 2, '+639820223817', 'sample4.png', NULL, 'sample5.jpg', 'sample3.jpg', 'sample6.png', 5, 'Living as a Nomad', 0, NULL, 1, 9, 1, 'Dementia', 0, NULL, '2023-08-16', 'eric.208.sarmiento@example.com', '$2y$12$NRYdV2XSW7xPciIbw2li8e1JxCRb7J78kDviO6QTqEMEH0T.yTz6W', NULL, NULL, '2024-01-08 17:17:13', NULL, NULL, NULL, 2, 'Ariana Cruz', 2, 'Charlotte Martelino', '2023-09-16', '2024-12-08 13:31:03', '2024-12-08 13:31:03'),
(107, '57143', '2024-06-20-57143', 3, 3, 1, 'Susan', 'Martinez', 'De Leon', NULL, '5412 Phase 5 Block 54 Lot 76 Matahimik Avenue, Barangay 172, Caloocan City', 8, '1934-12-08', 90, 'Cotabato City', 2, 2, '+639010445519', 'sample4.png', NULL, 'sample5.jpg', 'sample3.jpg', 'sample6.png', 1, NULL, 1, 7, 0, NULL, 1, 'Arthritis', 1, 'Mobility impairment', '2024-06-20', 'susan.818.rocamora@example.com', '$2y$12$eqTQ/2Vbjjco9QBu7ZmCOOa9GE6tFjQIbqkPWj.rUtXGmFIvekWfO', NULL, NULL, '2024-09-23 13:38:35', NULL, NULL, NULL, 3, 'Kristoffer Cabigon', 3, 'Kristoffer Cabigon', '2024-07-20', '2024-12-08 13:31:03', '2024-12-08 13:31:03'),
(108, '18615', '2024-09-22-18615', 3, 3, 1, 'John', 'Rocamora', 'Palomares', 'II', '6754 Phase 1 Block 13 Lot 10 Topaz Street, Barangay 180, Caloocan City', 21, '1939-12-08', 85, 'Legazpi City', 1, 3, '+639197590421', 'sample4.png', NULL, 'sample5.jpg', 'sample3.jpg', 'sample6.png', 5, 'Living Independently in Mobile Housing', 0, NULL, 0, NULL, 1, 'Parkinson disease', 0, NULL, '2024-09-22', 'john.316.deocampo@example.com', '$2y$12$c0loODvtkM3Njd7HimE6W.ANrq1hyR21oZtSNzZDmhj31TlpZpLCa', NULL, NULL, '2024-12-01 20:19:27', NULL, NULL, NULL, 3, 'Kristoffer Cabigon', 3, 'Kristoffer Cabigon', '2024-10-22', '2024-12-08 13:31:03', '2024-12-08 13:31:03'),
(109, '41308', '2022-12-28-41308', 2, NULL, 1, 'Charlotte', 'Macapagal', 'Cruz', NULL, '1805 Phase 1 Block 43 Lot 64 Silver Street, Barangay 176-D, Caloocan City', 15, '1948-12-08', 76, 'Mandaluyong City', 2, 1, '+639755507327', 'sample4.png', NULL, 'sample5.jpg', 'sample3.jpg', 'sample6.png', 3, NULL, 0, NULL, 0, NULL, 0, NULL, 0, NULL, '2022-12-28', 'charlotte.63.sarmiento@example.com', '$2y$12$lHqDxqX4dRkzljvt3hdUcOk0q8HoBWGAx/KfoU7OiE3OPF3.wmWY2', NULL, NULL, '2024-05-21 03:54:33', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-01-28', '2024-12-08 13:31:03', '2024-12-08 13:31:03'),
(110, '85511', '2023-05-11-85511', 3, 1, 1, 'Charles', 'Cabarroguis', 'Martelino', 'Sr.', '6501 Phase 2 Block 29 Lot 73 Sampaguita Street, Barangay 166, Caloocan City', 2, '1953-12-08', 71, 'General Santos City', 1, 2, '+639386313553', 'sample4.png', NULL, 'sample5.jpg', 'sample3.jpg', 'sample6.png', 5, 'Naninirahan lang', 0, NULL, 1, 11, 1, 'Hypertension', 0, NULL, '2023-05-11', 'charles.140.cruz@example.com', '$2y$12$VI2ZglmSZQiJDqCpLGcXdukHq3JVRR8tnEMfFv4u7X8gH46hLQw7m', NULL, NULL, '2024-10-01 00:24:08', NULL, NULL, NULL, 3, 'Kristoffer Cabigon', 2, 'Mark Martelino', '2023-06-11', '2024-12-08 13:31:03', '2024-12-08 13:31:03'),
(111, '98297', '2023-03-28-98297', 3, 3, 1, 'George', 'De Guzman', 'De Jesus', 'II', '2595 Phase 1 Block 56 Lot 49 Turquoise Road, Barangay 176-C, Caloocan City', 14, '1929-12-08', 95, 'Davao City', 1, 1, '+639225654860', 'sample4.png', NULL, 'sample5.jpg', 'sample3.jpg', 'sample6.png', 3, NULL, 1, 1, 1, 10, 1, 'Cancer', 0, NULL, '2023-03-28', 'george.441.delossantos@example.com', '$2y$12$B2Euju8cn/pGCIxJ5YuMnubtSSPG.SZaaGXw5aPHUp13P6Q35Rh5G', NULL, NULL, '2024-04-19 01:28:17', NULL, NULL, NULL, 2, 'Michael Soriano', 3, 'Kristoffer Cabigon', '2023-04-28', '2024-12-08 13:31:03', '2024-12-08 13:31:03'),
(112, '86004', '2023-06-07-86004', 3, 2, 1, 'Robert', 'Esguerra', 'Cortez', 'I', '1983 Phase 6 Block 31 Lot 8 Aquamarine Avenue, Barangay 175, Caloocan City', 11, '1964-12-08', 60, 'Bayugan City', 1, 4, '+639500171915', 'sample4.png', NULL, 'sample5.jpg', 'sample3.jpg', 'sample6.png', 5, 'Living in a Hostel or Temporary Accommodation', 1, 9, 1, 11, 1, 'Stroke', 0, NULL, '2023-06-07', 'robert.960.alfonso@example.com', '$2y$12$BbK6LoY5hp26Q9d5Kbo31uo35LxJpPbOJQhQLdYnaoQRrZQjSHhHO', NULL, NULL, '2023-12-09 09:29:54', NULL, NULL, NULL, 2, 'Charles De Guzman', 2, 'Linda Zaragoza', '2023-07-07', '2024-12-08 13:31:03', '2024-12-08 13:31:03'),
(113, '94563', '2023-10-15-94563', 1, NULL, 1, 'Ava', NULL, 'Reyes', NULL, '7342 Phase 10 Block 62 Lot 7 Aurora Avenue, Barangay 166, Caloocan City', 2, '1926-12-08', 98, 'Puerto Princesa City', 2, 4, '+639860854437', 'sample4.png', NULL, 'sample5.jpg', 'sample3.jpg', 'sample6.png', 5, 'Co-living Spaces', 1, 2, 0, NULL, 0, NULL, 0, NULL, '2023-10-15', 'ava.758.palomares@example.com', '$2y$12$DyMYdtSncmuoeF7f4LBb1.APiSIiEPUyxySrIsjReo4AmdHItdy7C', NULL, NULL, '2024-10-03 15:59:01', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-11-15', '2024-12-08 13:31:03', '2024-12-08 13:31:03'),
(114, '36937', '2023-11-19-36937', 3, 3, 1, 'Brian', 'Ponce', 'Pascual', 'II', '8132 Phase 8 Block 74 Lot 11 Mapayapa Avenue, Barangay 176-B, Caloocan City', 13, '1946-12-08', 78, 'Las Piñas City', 1, 1, '+639872779802', 'sample4.png', NULL, 'sample5.jpg', 'sample3.jpg', 'sample6.png', 1, NULL, 0, NULL, 1, 4, 0, NULL, 0, NULL, '2023-11-19', 'brian.208.lacuna@example.com', '$2y$12$DIHvjzzaih9lZirwJnDV2eE2DnV5kxVtSnmPVxrn7SG.PdqJyxV8W', NULL, NULL, '2024-11-30 13:10:53', NULL, NULL, NULL, 2, 'Linda Zaragoza', 2, 'Adam Esteban', '2023-12-19', '2024-12-08 13:31:03', '2024-12-08 13:31:03'),
(115, '46435', '2023-07-21-46435', 1, NULL, 1, 'Thomas', 'Yap', 'Lacuna', 'Jr.', '9973 Phase 2 Block 51 Lot 26 Acacia Street, Barangay 187, Caloocan City', 28, '1951-12-08', 73, 'Quezon City', 1, 2, '+639612505904', 'sample4.png', NULL, 'sample5.jpg', 'sample3.jpg', 'sample6.png', 3, NULL, 1, 10, 1, 1, 1, 'Hearing loss', 1, 'Cognitive disability', '2023-07-21', 'thomas.838.yap@example.com', '$2y$12$HiD6uZuCxNnEqKjXxF6ZeOyKm0C6sIGI/GmCZtPn2pfZ23G20NK4e', NULL, NULL, '2024-06-24 11:05:40', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-08-21', '2024-12-08 13:31:03', '2024-12-08 13:31:03'),
(116, '83267', '2023-04-14-83267', 2, NULL, 1, 'Andrew', 'Villanueva', 'Manalo', 'Jr.', '7630 Phase 3 Block 35 Lot 82 Chico Road, Barangay 176-C, Caloocan City', 14, '1961-12-08', 63, 'Makati City', 1, 2, '+639167404801', 'sample4.png', NULL, 'sample5.jpg', 'sample3.jpg', 'sample6.png', 2, NULL, 0, NULL, 0, NULL, 1, 'Diabetes', 0, NULL, '2023-04-14', 'andrew.802.alvarez@example.com', '$2y$12$XQHbY2wGKM6onn3uzvunqOyBQrdO1RxOyFV9ngDWr4HUYyzd9S1FS', NULL, NULL, '2024-04-07 03:09:33', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-05-14', '2024-12-08 13:31:03', '2024-12-08 13:31:03'),
(117, '53019', '2023-01-14-53019', 3, 3, 1, 'Virginia', 'De la Cruz', 'Chua', NULL, '9376 Phase 8 Block 49 Lot 75 Jade Avenue, Barangay 186, Caloocan City', 27, '1946-12-08', 78, 'Iligan City', 2, 2, '+639896962990', 'sample4.png', NULL, 'sample5.jpg', 'sample3.jpg', 'sample6.png', 5, 'Living in a Hostel or Temporary Accommodation', 0, NULL, 1, 3, 1, 'Gastroesophageal reflux disease (GERD)', 0, NULL, '2023-01-14', 'virginia.636.deguzman@example.com', '$2y$12$HDJBfq2WvHOjPDJV11CPrukl2WNQBMeDO57XgT5pjG777bAwaeHRS', NULL, NULL, '2024-08-13 22:01:32', NULL, NULL, NULL, 3, 'Kristoffer Cabigon', 3, 'Kristoffer Cabigon', '2023-02-14', '2024-12-08 13:31:04', '2024-12-08 13:31:04'),
(118, '68736', '2024-10-10-68736', 1, NULL, 1, 'Mary', 'Morales', 'Misa', NULL, '3849 Phase 4 Block 9 Lot 26 Coral Boulevard, Barangay 171, Caloocan City', 7, '1935-12-08', 89, 'Baguio City', 2, 1, '+639774674359', 'sample4.png', NULL, 'sample5.jpg', 'sample3.jpg', 'sample6.png', 1, NULL, 0, NULL, 1, 7, 1, 'Hypertension', 0, NULL, '2024-10-10', 'mary.780.soriano@example.com', '$2y$12$aiWj1wlDTM3NnhNr5mfLpO/QN/evluFR7VlYmt3EKt2RplwzbGKiG', NULL, NULL, '2024-10-26 08:05:47', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-11-10', '2024-12-08 13:31:04', '2024-12-08 13:31:04'),
(119, '93265', '2023-08-15-93265', 3, 1, 1, 'Ava', 'Reyes', 'Soriano', NULL, '3976 Phase 1 Block 44 Lot 7 Avocado Street, Barangay 176-A, Caloocan City', 12, '1944-12-08', 80, 'Dumaguete City', 2, 4, '+639197162371', 'sample4.png', NULL, 'sample5.jpg', 'sample3.jpg', 'sample6.png', 2, NULL, 1, 4, 0, NULL, 1, 'Cancer', 0, NULL, '2023-08-15', 'ava.151.delosreyes@example.com', '$2y$12$o.6R.ESDHjicvSOBOTnbLerZMpNlJmj.M0OCjmKX/.3iG4qXxrDiS', NULL, NULL, '2024-09-01 01:30:14', NULL, NULL, NULL, 2, 'Mark Nieves', 3, 'Kristoffer Cabigon', '2023-09-15', '2024-12-08 13:31:04', '2024-12-08 13:31:04'),
(120, '20728', '2024-07-08-20728', 3, 1, 1, 'James', 'Alcaraz', 'Delos Reyes', NULL, '3630 Phase 5 Block 12 Lot 23 Tulip Road, Barangay 178, Caloocan City', 19, '1958-12-08', 66, 'Manila', 1, 4, '+639063334150', 'sample4.png', NULL, 'sample5.jpg', 'sample3.jpg', 'sample6.png', 2, NULL, 1, 1, 0, NULL, 1, 'Parkinson disease', 0, NULL, '2024-07-08', 'james.842.chua@example.com', '$2y$12$YjdkDnZQGWOr/7vznPjbmuqTXNyTvoxNTuB1zqhQ3Kw1wfExIekgC', NULL, NULL, '2024-01-26 18:40:02', NULL, NULL, NULL, 2, 'David Alvarez', 3, 'Kristoffer Cabigon', '2024-08-08', '2024-12-08 13:31:04', '2024-12-08 13:31:04'),
(121, '64603', '2023-03-20-64603', 3, 1, 1, 'Timothy', 'Cortez', 'Vera', 'II', '8827 Phase 8 Block 57 Lot 18 Santos Street, Barangay 182, Caloocan City', 23, '1933-12-08', 91, 'Baguio City', 1, 2, '+639455247511', 'sample4.png', NULL, 'sample5.jpg', 'sample3.jpg', 'sample6.png', 1, NULL, 0, NULL, 0, NULL, 1, 'Depression', 0, NULL, '2023-03-20', 'timothy.798.naguit@example.com', '$2y$12$gPSBNpHs3QwCD98ROXSMwe51tyXzab0k8StVUDGEfF1BfKm7W.sra', NULL, NULL, '2024-01-01 12:01:04', NULL, NULL, NULL, 3, 'Kristoffer Cabigon', 3, 'Kristoffer Cabigon', '2023-04-20', '2024-12-08 13:31:04', '2024-12-08 13:31:04'),
(122, '26596', '2023-04-25-26596', 3, 3, 1, 'Dorothy', 'Reyes', 'Torres', NULL, '1795 Phase 10 Block 34 Lot 24 Amber Street, Barangay 176-C, Caloocan City', 14, '1931-12-08', 93, 'Dumaguete City', 2, 3, '+639834237495', 'sample4.png', NULL, 'sample5.jpg', 'sample3.jpg', 'sample6.png', 3, NULL, 1, 6, 1, 2, 0, NULL, 1, 'Mental health condition', '2023-04-25', 'dorothy.506.santiago@example.com', '$2y$12$zbDhLTnMLyWTHg1r5cWG/e11MPxB7UlhfF7ibVC7bQrYmfClqrtyW', NULL, NULL, '2024-03-17 17:49:29', NULL, NULL, NULL, 3, 'Kristoffer Cabigon', 2, 'Karen Villanueva', '2023-05-25', '2024-12-08 13:31:05', '2024-12-08 13:31:05'),
(123, '93410', '2023-05-07-93410', 3, 2, 1, 'Ella', 'Torres', 'Palomares', NULL, '5748 Phase 5 Block 84 Lot 22 Gold Boulevard, Barangay 173, Caloocan City', 9, '1937-12-08', 87, 'Dumaguete City', 2, 1, '+639357327160', 'sample4.png', NULL, 'sample5.jpg', 'sample3.jpg', 'sample6.png', 3, NULL, 1, 11, 0, NULL, 0, NULL, 0, NULL, '2023-05-07', 'ella.285.deleon@example.com', '$2y$12$0/gbTSvPN20gZ./YDom.P.fauQPmxZn5Pb7bPZpijA/ACMsd3dLLe', NULL, NULL, '2024-09-15 01:57:28', NULL, NULL, NULL, 2, 'Ronald Salvador', 3, 'Kristoffer Cabigon', '2023-06-07', '2024-12-08 13:31:05', '2024-12-08 13:31:05'),
(124, '96709', '2023-07-15-96709', 3, 3, 1, 'Ella', 'Flores', 'Atienza', NULL, '2320 Phase 8 Block 29 Lot 25 Ruby Avenue, Barangay 176-B, Caloocan City', 13, '1926-12-08', 98, 'Parañaque City', 2, 4, '+639804344984', 'sample4.png', NULL, 'sample5.jpg', 'sample3.jpg', 'sample6.png', 4, NULL, 0, NULL, 0, NULL, 1, 'Chronic obstructive pulmonary disease (COPD)', 0, NULL, '2023-07-15', 'ella.401.nieves@example.com', '$2y$12$/sRWHNWOyRaNCx96aF68i.PN5M4El3ojen8CVnGrkixQNA7WLSa2m', NULL, NULL, '2024-05-08 05:27:51', NULL, NULL, NULL, 2, 'Anthony Cruz', 2, 'Mark Nieves', '2023-08-15', '2024-12-08 13:31:05', '2024-12-08 13:31:05'),
(125, '66634', '2024-03-12-66634', 3, 2, 1, 'Thomas', 'Ramos', 'Cabigon', NULL, '2729 Phase 6 Block 83 Lot 71 Violeta Street, Barangay 172, Caloocan City', 8, '1956-12-08', 68, 'Santiago City', 1, 3, '+639627259031', 'sample4.png', NULL, 'sample5.jpg', 'sample3.jpg', 'sample6.png', 3, NULL, 1, 11, 1, 10, 1, 'Dementia', 0, NULL, '2024-03-12', 'thomas.19.gumabay@example.com', '$2y$12$uCyK2mREjAgzpB5rAoPD7.u6uLN/ZgJvnbOSFTju.FphuM91d.F5u', NULL, NULL, '2024-05-01 19:45:24', NULL, NULL, NULL, 2, 'Charles De Guzman', 2, 'Ariana Cruz', '2024-04-12', '2024-12-08 13:31:05', '2024-12-08 13:31:05'),
(126, '66149', '2024-07-16-66149', 3, 2, 1, 'Nancy', 'Morales', 'De Vera', NULL, '8319 Phase 5 Block 73 Lot 45 Venus Road, Barangay 176-E, Caloocan City', 16, '1940-12-08', 84, 'Cabanatuan City', 2, 1, '+639704194008', 'sample4.png', NULL, 'sample5.jpg', 'sample3.jpg', 'sample6.png', 3, NULL, 0, NULL, 0, NULL, 0, NULL, 0, NULL, '2024-07-16', 'nancy.488.riviera@example.com', '$2y$12$WI419r2yc6Pky8AqCe3oreoC3lEWEDDK5lYLh/MuGqQVD0bNb0TxG', NULL, NULL, '2024-01-20 15:51:02', NULL, NULL, NULL, 3, 'Kristoffer Cabigon', 3, 'Kristoffer Cabigon', '2024-08-16', '2024-12-08 13:31:05', '2024-12-08 13:31:05'),
(127, '82166', '2023-09-02-82166', 3, 4, 1, 'Charles', 'De la Rosa', 'San Vicente', 'III', '2066 Phase 10 Block 70 Lot 3 Dalandan Road, Barangay 175, Caloocan City', 11, '1941-12-08', 83, 'Tuguegarao City', 1, 1, '+639101893278', 'sample4.png', NULL, 'sample5.jpg', 'sample3.jpg', 'sample6.png', 3, NULL, 1, 10, 0, NULL, 0, NULL, 0, NULL, '2023-09-02', 'charles.401.reyes@example.com', '$2y$12$P5.UcfZ1/dMYhyxzbY.LAeaqbgb/deyRzAsfgr4QX3gJ33PoPTODe', NULL, NULL, '2024-06-19 06:45:19', NULL, NULL, NULL, 2, 'David Alvarez', 3, 'Kristoffer Cabigon', '2023-10-02', '2024-12-08 13:31:05', '2024-12-08 13:31:05'),
(128, '58482', '2023-10-07-58482', 3, 3, 1, 'Robert', 'De Villa', 'Bacani', NULL, '9644 Phase 8 Block 60 Lot 13 Iris Avenue, Barangay 165, Caloocan City', 1, '1949-12-08', 75, 'Mandaluyong City', 1, 2, '+639133631502', 'sample4.png', NULL, 'sample5.jpg', 'sample3.jpg', 'sample6.png', 3, NULL, 0, NULL, 0, NULL, 0, NULL, 0, NULL, '2023-10-07', 'robert.264.lacuna@example.com', '$2y$12$A/GojUzzhCNhyN4J1a9GzOROJoAPlNpYZagua3xJbiGSU1utr4A2q', NULL, NULL, '2024-01-13 11:48:58', NULL, NULL, NULL, 2, 'Cynthia Villafuerte', 2, 'Kristoffer Cabigon', '2023-11-07', '2024-12-08 13:31:05', '2024-12-08 13:31:05'),
(129, '55154', '2024-05-28-55154', 2, NULL, 1, 'Angela', 'Palomares', 'Bañez', NULL, '8763 Phase 9 Block 21 Lot 81 Molave Avenue, Barangay 176-E, Caloocan City', 16, '1964-12-08', 60, 'Ormoc City', 2, 1, '+639086418167', 'sample4.png', NULL, 'sample5.jpg', 'sample3.jpg', 'sample6.png', 4, NULL, 1, 7, 0, NULL, 1, 'Chronic pain conditions', 0, NULL, '2024-05-28', 'angela.181.gonzales@example.com', '$2y$12$38/j.Y0XTjVyWQ.gheMk2OBMN0uX2NhfOxUQCkm4T6WzjfenZtCeu', NULL, NULL, '2024-06-10 23:59:24', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-06-28', '2024-12-08 13:31:05', '2024-12-08 13:31:05'),
(130, '37392', '2024-07-31-37392', 1, NULL, 1, 'Joshua', 'López', 'Alcaraz', 'III', '4616 Phase 10 Block 69 Lot 70 Lily Avenue, Barangay 176-B, Caloocan City', 13, '1963-12-08', 61, 'Davao City', 1, 2, '+639163390498', 'sample4.png', NULL, 'sample5.jpg', 'sample3.jpg', 'sample6.png', 3, NULL, 0, NULL, 0, NULL, 0, NULL, 0, NULL, '2024-07-31', 'joshua.352.reyes@example.com', '$2y$12$wiNBvOruQkidNgAHIZeIH.48cf7f3zf3Gr5pFNIs7ySjdlbrYL59.', NULL, NULL, '2024-05-07 02:31:27', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-08-31', '2024-12-08 13:31:05', '2024-12-08 13:31:05'),
(131, '21879', '2024-02-08-21879', 4, NULL, 1, 'Julie', 'De Leon', 'Castillo', NULL, '7113 Phase 10 Block 70 Lot 34 Chico Road, Barangay 176-E, Caloocan City', 16, '1929-12-08', 95, 'Mandaue City', 2, 3, '+639252753402', 'sample4.png', NULL, 'sample5.jpg', 'sample3.jpg', 'sample6.png', 4, NULL, 0, NULL, 0, NULL, 0, NULL, 1, 'Mobility impairment', '2024-02-08', 'julie.560.delosreyes@example.com', '$2y$12$2XQ8k2fOIvxrPuTP8fKTwuriUCxO/vr4mKIozX..qBICV/Igw2IGe', NULL, NULL, '2024-01-03 12:29:14', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-03-08', '2024-12-08 13:31:05', '2024-12-08 13:31:05'),
(132, '16705', '2024-02-10-16705', 2, NULL, 1, 'William', 'Alvarado', 'Alvarez', 'I', '7218 Phase 10 Block 18 Lot 52 Violeta Street, Barangay 176-B, Caloocan City', 13, '1962-12-08', 62, 'San Fernando City (Pampanga)', 1, 4, '+639498366176', 'sample4.png', NULL, 'sample5.jpg', 'sample3.jpg', 'sample6.png', 1, NULL, 1, 11, 1, 8, 1, 'Cancer', 0, NULL, '2024-02-10', 'william.213.valenzuela@example.com', '$2y$12$IFEIeJejBFaFo4GgbVgD5uuQLDNLtjDruCqar0fz9TcdjiiK7vxwG', NULL, NULL, '2024-10-31 05:26:29', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-03-10', '2024-12-08 13:31:05', '2024-12-08 13:31:05'),
(133, '80932', '2023-05-04-80932', 1, NULL, 1, 'Amy', 'Castillo', 'Dela Cruz', NULL, '8577 Phase 1 Block 4 Lot 38 Saturn Street, Barangay 172, Caloocan City', 8, '1945-12-08', 79, 'Pasig City', 2, 2, '+639418816627', 'sample4.png', NULL, 'sample5.jpg', 'sample3.jpg', 'sample6.png', 3, NULL, 1, 2, 0, NULL, 1, 'Stroke', 0, NULL, '2023-05-04', 'amy.978.vera@example.com', '$2y$12$I0tVq1vF0QPn0BySdmjBAej7o/4Rcvzs81JMmXhVaOhd1niV280va', NULL, NULL, '2024-10-17 02:28:08', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-06-04', '2024-12-08 13:31:05', '2024-12-08 13:31:05'),
(134, '73816', '2022-12-17-73816', 1, NULL, 1, 'Sarah', 'Delos Reyes', 'Soriano', NULL, '9862 Phase 10 Block 89 Lot 49 Peridot Avenue, Barangay 176-D, Caloocan City', 15, '1935-12-08', 89, 'Tuguegarao City', 2, 3, '+639705402915', 'sample4.png', NULL, 'sample5.jpg', 'sample3.jpg', 'sample6.png', 5, 'Sa Kalsada lang po', 1, 11, 1, 5, 1, 'Cancer', 0, NULL, '2022-12-17', 'sarah.469.riviera@example.com', '$2y$12$/jYpTtgcJD2rfR.f/y72cOvNAd.L6OlWBA23UoMoetT327qf6XYq.', NULL, NULL, '2024-03-09 10:58:40', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-01-17', '2024-12-08 13:31:06', '2024-12-08 13:31:06'),
(135, '85481', '2024-11-21-85481', 4, NULL, 1, 'Scott', 'Martinez', 'Esteban', 'Sr.', '6990 Phase 8 Block 34 Lot 73 Champaca Street, Barangay 178, Caloocan City', 19, '1936-12-08', 88, 'Navotas City', 1, 4, '+639389116223', 'sample4.png', NULL, 'sample5.jpg', 'sample3.jpg', 'sample6.png', 2, NULL, 0, NULL, 0, NULL, 0, NULL, 0, NULL, '2024-11-21', 'scott.778.zaragoza@example.com', '$2y$12$rBZVyInwL9vpG0w4OtXLkudFHTyM8PRtrM/bBz3ixASIUsPAE.UVa', NULL, NULL, '2024-06-19 05:26:25', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-12-21', '2024-12-08 13:31:06', '2024-12-08 13:31:06'),
(136, '82999', '2024-03-13-82999', 3, 2, 1, 'Virginia', 'Vera', 'Flores', NULL, '8225 Phase 9 Block 58 Lot 39 Jade Avenue, Barangay 168, Caloocan City', 4, '1925-12-08', 99, 'Marawi City', 2, 4, '+639120658384', 'sample4.png', NULL, 'sample5.jpg', 'sample3.jpg', 'sample6.png', 5, 'Walang permanenteng tirahan', 1, 8, 1, 7, 0, NULL, 0, NULL, '2024-03-13', 'virginia.299.bautista@example.com', '$2y$12$3bap8A6acCU0rYWL7/lNJehvqxIBM9kN7wCxDFWo8VnJIKZj9eszG', NULL, NULL, '2024-09-25 18:01:42', NULL, NULL, NULL, 2, 'Eric Mendoza', 3, 'Kristoffer Cabigon', '2024-04-13', '2024-12-08 13:31:06', '2024-12-08 13:31:06'),
(137, '18480', '2024-06-27-18480', 3, 2, 1, 'David', NULL, 'Villafuerte', 'III', '3823 Phase 5 Block 84 Lot 69 Siniguelas Drive, Barangay 165, Caloocan City', 1, '1939-12-08', 85, 'Tagum City', 1, 2, '+639731359945', 'sample4.png', NULL, 'sample5.jpg', 'sample3.jpg', 'sample6.png', 2, NULL, 1, 5, 1, 11, 1, 'Alzheimer disease', 0, NULL, '2024-06-27', 'david.884.riviera@example.com', '$2y$12$fIZrs8t7LnyqSh4OsrDy3.vZem13eLZgXEkdKKwNzHj6c0EtiIYUW', NULL, NULL, '2024-01-10 09:22:03', NULL, NULL, NULL, 3, 'Kristoffer Cabigon', 2, 'Karen Villanueva', '2024-07-27', '2024-12-08 13:31:06', '2024-12-08 13:31:06'),
(138, '66257', '2023-11-06-66257', 3, 2, 1, 'Julie', 'Rosales', 'Pascual', NULL, '7785 Phase 8 Block 62 Lot 84 Amethyst Drive, Barangay 176-D, Caloocan City', 15, '1958-12-08', 66, 'Cotabato City', 2, 2, '+639245419422', 'sample4.png', NULL, 'sample5.jpg', 'sample3.jpg', 'sample6.png', 5, 'Living in a Boarding House/Dormitory', 1, 6, 0, NULL, 0, NULL, 1, 'Mental health condition', '2023-11-06', 'julie.974.ponce@example.com', '$2y$12$w0U6VUebbtufiK6e.fX1seja5uX8xjGkBnrrXBbIfu3JnvWmOayvS', NULL, NULL, '2024-01-24 06:59:03', NULL, NULL, NULL, 2, 'Eric Mendoza', 3, 'Kristoffer Cabigon', '2023-12-06', '2024-12-08 13:31:06', '2024-12-08 13:31:06'),
(139, '55198', '2023-04-25-55198', 3, 1, 1, 'Nancy', 'Gonzales', 'Suarez', NULL, '7265 Phase 4 Block 78 Lot 43 Violeta Street, Barangay 177, Caloocan City', 18, '1960-12-08', 64, 'Marawi City', 2, 2, '+639484982726', 'sample4.png', NULL, 'sample5.jpg', 'sample3.jpg', 'sample6.png', 2, NULL, 1, 10, 1, 2, 0, NULL, 0, NULL, '2023-04-25', 'nancy.563.mendoza@example.com', '$2y$12$RY0P1lj6kWhlmlVMc1sMGOy8jZZrdfkLD3vBtmTWr/ARtzdfVTkGG', NULL, NULL, '2024-06-03 06:28:44', NULL, NULL, NULL, 3, 'Kristoffer Cabigon', 2, 'Thomas Delos Santos', '2023-05-25', '2024-12-08 13:31:06', '2024-12-08 13:31:06'),
(140, '91296', '2024-01-08-91296', 3, 3, 1, 'Charles', 'Tabujara', 'Dela Cruz', NULL, '8280 Phase 5 Block 23 Lot 90 Sapphire Street, Barangay 182, Caloocan City', 23, '1940-12-08', 84, 'Taguig City', 1, 3, '+639933198028', 'sample4.png', NULL, 'sample5.jpg', 'sample3.jpg', 'sample6.png', 3, NULL, 0, NULL, 1, 1, 1, 'Gastroesophageal reflux disease (GERD)', 0, NULL, '2024-01-08', 'charles.913.sanmiguel@example.com', '$2y$12$9pp02XxzmRX.4gImmx72zebfS44L.0DhBhfBwELSkwuvfrskyxmKW', NULL, NULL, '2024-01-11 20:04:43', NULL, NULL, NULL, 3, 'Kristoffer Cabigon', 3, 'Kristoffer Cabigon', '2024-02-08', '2024-12-08 13:31:07', '2024-12-08 13:31:07'),
(141, '19799', '2023-11-29-19799', 3, 4, 1, 'Daniel', 'Del Rosario', 'Salvador', 'Sr.', '7170 Phase 5 Block 89 Lot 73 Gemini Street, Barangay 166, Caloocan City', 2, '1962-12-08', 62, 'Dipolog City', 1, 4, '+639591330386', 'sample4.png', NULL, 'sample5.jpg', 'sample3.jpg', 'sample6.png', 1, NULL, 1, 2, 0, NULL, 0, NULL, 0, NULL, '2023-11-29', 'daniel.656.manalaysay@example.com', '$2y$12$W1i95CV.9QdDGgcMaqTBpu3rZq2w8kVcwlo0/Ek5s5IhUQBkH5BgG', NULL, NULL, '2024-04-11 11:22:20', NULL, NULL, NULL, 3, 'Kristoffer Cabigon', 3, 'Kristoffer Cabigon', '2023-12-29', '2024-12-08 13:31:08', '2024-12-08 13:31:08'),
(142, '38601', '2024-08-10-38601', 4, NULL, 1, 'Charlotte', 'De Leon', 'Garcia', NULL, '1287 Phase 5 Block 11 Lot 66 Magnolia Avenue, Barangay 176-A, Caloocan City', 12, '1956-12-08', 68, 'Naga City', 2, 1, '+639858456046', 'sample4.png', NULL, 'sample5.jpg', 'sample3.jpg', 'sample6.png', 5, 'Living with Non-relatives', 1, 9, 1, 3, 0, NULL, 0, NULL, '2024-08-10', 'charlotte.233.villanueva@example.com', '$2y$12$0JqNDpm0xqet4GIAn/IvBe1nzwvP/4YCQxJMF9yP7AAErB6DDycxi', NULL, NULL, '2024-01-02 19:57:47', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-09-10', '2024-12-08 13:31:08', '2024-12-08 13:31:08'),
(143, '48184', '2023-04-10-48184', 1, NULL, 1, 'Stephen', 'Pineda', 'Riviera', 'Sr.', '3892 Phase 1 Block 13 Lot 60 Diamond Boulevard, Barangay 170, Caloocan City', 6, '1959-12-08', 65, 'Davao City', 1, 2, '+639622024350', 'sample4.png', NULL, 'sample5.jpg', 'sample3.jpg', 'sample6.png', 5, 'Living as a Nomad', 1, 9, 1, 10, 0, NULL, 1, 'Mental health condition', '2023-04-10', 'stephen.35.salinas@example.com', '$2y$12$aTHZDUyi/Ob705wNcIkdr.pizrIhgCI/X/kCakBRbjV5jwWlhiz2e', NULL, NULL, '2024-02-09 06:56:09', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-05-10', '2024-12-08 13:31:08', '2024-12-08 13:31:08'),
(144, '46235', '2023-06-26-46235', 2, NULL, 1, 'Eric', 'Villanueva', 'Reyes', 'II', '3870 Phase 7 Block 37 Lot 40 Emerald Boulevard, Barangay 177, Caloocan City', 18, '1951-12-08', 73, 'Tarlac City', 1, 2, '+639169775106', 'sample4.png', NULL, 'sample5.jpg', 'sample3.jpg', 'sample6.png', 4, NULL, 0, NULL, 0, NULL, 0, NULL, 0, NULL, '2023-06-26', 'eric.835.sanpedro@example.com', '$2y$12$5ulSQYiKlh6CZGO77QCX7.GzafLll78SqWTcw2eINmppvubv2BoAi', NULL, NULL, '2024-11-26 22:43:20', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-07-26', '2024-12-08 13:31:08', '2024-12-08 13:31:08'),
(145, '77711', '2024-11-16-77711', 3, 2, 1, 'Deborah', 'Naguit', 'Alvarado', NULL, '1986 Phase 2 Block 42 Lot 3 Hibiscus Boulevard, Barangay 179, Caloocan City', 20, '1931-12-08', 93, 'Manila', 2, 1, '+639323186878', 'sample4.png', NULL, 'sample5.jpg', 'sample3.jpg', 'sample6.png', 2, NULL, 0, NULL, 0, NULL, 0, NULL, 0, NULL, '2024-11-16', 'deborah.331.sanvicente@example.com', '$2y$12$Knf3UJjSr5ugIdu/5R.Fzutjv/f26.MToHpenpbq17hDosIYOotYO', NULL, NULL, '2024-04-28 23:43:39', NULL, NULL, NULL, 2, 'Anthony Cruz', 2, 'Linda Zaragoza', '2024-12-16', '2024-12-08 13:31:08', '2024-12-08 13:31:08'),
(146, '50376', '2024-11-14-50376', 1, NULL, 1, 'David', 'Ocampo', 'Garcia', 'III', '5034 Phase 4 Block 12 Lot 1 Carnation Road, Barangay 176-E, Caloocan City', 16, '1935-12-08', 89, 'Cabanatuan City', 1, 4, '+639613523956', 'sample4.png', NULL, 'sample5.jpg', 'sample3.jpg', 'sample6.png', 4, NULL, 1, 2, 0, NULL, 0, NULL, 0, NULL, '2024-11-14', 'david.275.misa@example.com', '$2y$12$KGuhWobA4ZTUrf73mtemeugs39aUofpT.pi8bmHDiABphOAuLk6RC', NULL, NULL, '2024-10-18 22:25:16', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-12-14', '2024-12-08 13:31:08', '2024-12-08 13:31:08'),
(147, '47173', '2024-05-30-47173', 3, 3, 1, 'Virginia', 'Zaragoza', 'Villanueva', NULL, '3766 Phase 1 Block 89 Lot 81 Papaya Boulevard, Barangay 166, Caloocan City', 2, '1946-12-08', 78, 'Mandaluyong City', 2, 1, '+639816639814', 'sample4.png', NULL, 'sample5.jpg', 'sample3.jpg', 'sample6.png', 5, 'Living Temporarily in a Shelter', 1, 9, 1, 8, 1, 'Hearing loss', 0, NULL, '2024-05-30', 'virginia.132.sanmiguel@example.com', '$2y$12$T8MX6aDC6fkwuAPyPqZ9x.r1lwHnGAInOMTOhex7wLyNV.3.m4dfG', NULL, NULL, '2024-08-26 10:08:29', NULL, NULL, NULL, 3, 'Kristoffer Cabigon', 2, 'Thomas Delos Santos', '2024-06-30', '2024-12-08 13:31:08', '2024-12-08 13:31:08'),
(148, '73233', '2024-08-07-73233', 3, 2, 1, 'Sophia', 'Verano', 'Vera', NULL, '6847 Phase 6 Block 23 Lot 64 Acacia Street, Barangay 166, Caloocan City', 2, '1948-12-08', 76, 'Cagayan de Oro City', 2, 3, '+639939731828', 'sample4.png', NULL, 'sample5.jpg', 'sample3.jpg', 'sample6.png', 5, 'Sa tabing Ilog', 0, NULL, 0, NULL, 1, 'Kidney disease', 1, 'Hearing impairment', '2024-08-07', 'sophia.759.martinez@example.com', '$2y$12$hzbio91cPSbPScxSKIxzUOKSn.HL0cPa5qgTIdBvaK4vWwQ0Sokz2', NULL, NULL, '2024-01-01 20:59:26', NULL, NULL, NULL, 3, 'Kristoffer Cabigon', 2, 'Ronald Salvador', '2024-09-07', '2024-12-08 13:31:08', '2024-12-08 13:31:08'),
(149, '71953', '2023-03-24-71953', 3, 2, 1, 'Harper', 'San Antonio', 'De Guzman', NULL, '6170 Phase 6 Block 83 Lot 44 Jasmine Street, Barangay 171, Caloocan City', 7, '1939-12-08', 85, 'Tagum City', 2, 4, '+639140578475', 'sample4.png', NULL, 'sample5.jpg', 'sample3.jpg', 'sample6.png', 4, NULL, 1, 7, 0, NULL, 1, 'Anxiety disorders', 0, NULL, '2023-03-24', 'harper.835.deocampo@example.com', '$2y$12$WKzoXFK.yUXqxDYeWB3ad.DOqcOPIRgTpWi6Y5PqnbSvMdevywSy6', NULL, NULL, '2024-12-04 14:14:43', NULL, NULL, NULL, 3, 'Kristoffer Cabigon', 2, 'Larry Flores', '2023-04-24', '2024-12-08 13:31:08', '2024-12-08 13:31:08'),
(150, '11483', '2023-10-31-11483', 2, NULL, 1, 'Larry', 'Palomares', 'Mendoza', NULL, '9179 Phase 9 Block 56 Lot 62 Dalandan Road, Barangay 178, Caloocan City', 19, '1956-12-08', 68, 'Caloocan City', 1, 1, '+639057634531', 'sample4.png', NULL, 'sample5.jpg', 'sample3.jpg', 'sample6.png', 3, NULL, 0, NULL, 1, 6, 1, 'Heart disease', 1, 'Visual impairment', '2023-10-31', 'larry.158.cortez@example.com', '$2y$12$lYdUpzFwG4KWF8eL6Daf.eRcNbyBshcTK2bQZqgns7fPkVaEWTv6.', NULL, NULL, '2024-03-10 21:56:41', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-12-01', '2024-12-08 13:31:08', '2024-12-08 13:31:08'),
(151, '56209', '2023-01-17-56209', 3, 4, 1, 'Diane', 'Cruz', 'Ramos', NULL, '4863 Phase 8 Block 36 Lot 62 Zinnia Drive, Barangay 184, Caloocan City', 25, '1955-12-08', 69, 'Ormoc City', 2, 3, '+639767835092', 'sample4.png', NULL, 'sample5.jpg', 'sample3.jpg', 'sample6.png', 2, NULL, 1, 8, 1, 3, 0, NULL, 1, 'Mobility impairment', '2023-01-17', 'diane.968.vera@example.com', '$2y$12$ykoyhKhnEF9DekAGnizm6.dI/ytdroES7ztcH6FEEewHG8MdrYX2q', NULL, NULL, '2024-07-11 20:54:34', NULL, NULL, NULL, 2, 'Robert De Villa', 2, 'Thomas Delos Santos', '2023-02-17', '2024-12-08 13:31:08', '2024-12-08 13:31:08'),
(152, '96026', '2023-04-03-96026', 3, 1, 1, 'Paul', 'Magsaysay', 'San Vicente', NULL, '8809 Phase 7 Block 77 Lot 21 Dama de Noche Avenue, Barangay 169, Caloocan City', 5, '1963-12-08', 61, 'Cotabato City', 1, 4, '+639444504547', 'sample4.png', NULL, 'sample5.jpg', 'sample3.jpg', 'sample6.png', 2, NULL, 1, 10, 0, NULL, 1, 'Hypertension', 1, 'Hearing impairment', '2023-04-03', 'paul.521.devera@example.com', '$2y$12$dTW4ajCwOzxUa91KKOTpJ.3ZiYN3qsfT99Q3wM8LP8yupcjGrrnSm', NULL, NULL, '2024-11-18 17:31:56', NULL, NULL, NULL, 2, 'Cynthia Villafuerte', 3, 'Kristoffer Cabigon', '2023-05-03', '2024-12-08 13:31:09', '2024-12-08 13:31:09'),
(153, '88646', '2024-05-24-88646', 4, NULL, 1, 'Mark', 'Matias', 'De Leon', 'III', '9940 Phase 2 Block 8 Lot 35 Mangga Avenue, Barangay 176-E, Caloocan City', 16, '1947-12-08', 77, 'San Jose del Monte City', 1, 3, '+639352041266', 'sample4.png', NULL, 'sample5.jpg', 'sample3.jpg', 'sample6.png', 2, NULL, 1, 1, 0, NULL, 1, 'Kidney disease', 1, 'Mobility impairment', '2024-05-24', 'mark.599.delatorre@example.com', '$2y$12$r96/lEniaeoi.EdyQYPPtOt4XNHYKoVh9ETeFzRw8tBm.fCvUMmOG', NULL, NULL, '2024-11-03 14:05:41', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-06-24', '2024-12-08 13:31:09', '2024-12-08 13:31:09'),
(154, '89237', '2023-05-19-89237', 3, 3, 1, 'Dorothy', 'Manalo', 'Ramos', NULL, '7090 Phase 7 Block 66 Lot 3 Carnation Road, Barangay 180, Caloocan City', 21, '1959-12-08', 65, 'Cavite City', 2, 3, '+639957511836', 'sample4.png', NULL, 'sample5.jpg', 'sample3.jpg', 'sample6.png', 1, NULL, 1, 9, 1, 2, 0, NULL, 0, NULL, '2023-05-19', 'dorothy.31.ponce@example.com', '$2y$12$WqEYoyxd0EPnRqIFldFkR.DegFm/b3yuyVNCuM5WCFJnXcHDPHtSG', NULL, NULL, '2024-02-29 23:37:12', NULL, NULL, NULL, 3, 'Kristoffer Cabigon', 2, 'Linda Zaragoza', '2023-06-19', '2024-12-08 13:31:09', '2024-12-08 13:31:09'),
(155, '42880', '2024-05-14-42880', 1, NULL, 1, 'Cynthia', 'De Vera', 'Rosales', NULL, '6308 Phase 10 Block 69 Lot 66 Anahaw Road, Barangay 176-B, Caloocan City', 13, '1958-12-08', 66, 'Davao City', 2, 3, '+639876170196', 'sample4.png', NULL, 'sample5.jpg', 'sample3.jpg', 'sample6.png', 4, NULL, 0, NULL, 1, 11, 0, NULL, 0, NULL, '2024-05-14', 'cynthia.476.palomares@example.com', '$2y$12$QLJ4XZ1qW0VVTtFiUlkTZepV2ONgWGvgWZrXyDgJOj7IJl5fN5QHa', NULL, NULL, '2024-02-22 12:02:57', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-06-14', '2024-12-08 13:31:09', '2024-12-08 13:31:09'),
(156, '29500', '2022-12-28-29500', 3, 1, 1, 'Jack', 'Salinas', 'San Vicente', 'III', '6867 Phase 5 Block 87 Lot 23 Pag-asa Street, Barangay 170, Caloocan City', 6, '1958-12-08', 66, 'Dipolog City', 1, 3, '+639933626872', 'sample4.png', NULL, 'sample5.jpg', 'sample3.jpg', 'sample6.png', 3, NULL, 1, 7, 1, 7, 1, 'Kidney disease', 1, 'Mental health condition', '2022-12-28', 'jack.619.castillo@example.com', '$2y$12$mCTAU2KmYBBNtIfcVQhqJu/E4D9j5yHRzlAbCtUO6.33VQVR6hQpi', NULL, NULL, '2024-02-20 03:23:22', NULL, NULL, NULL, 3, 'Kristoffer Cabigon', 2, 'Zoe San Antonio', '2023-01-28', '2024-12-08 13:31:09', '2024-12-08 13:31:09'),
(157, '85216', '2023-12-17-85216', 3, 3, 1, 'Mia', 'Delos Santos', 'Manalo', NULL, '5615 Phase 9 Block 87 Lot 72 Sunflower Drive, Barangay 176-C, Caloocan City', 14, '1964-12-08', 60, 'Dumaguete City', 2, 4, '+639724868778', 'sample4.png', NULL, 'sample5.jpg', 'sample3.jpg', 'sample6.png', 5, 'Living in a Hostel or Temporary Accommodation', 0, NULL, 1, 10, 1, 'Kidney disease', 0, NULL, '2023-12-17', 'mia.151.mendoza@example.com', '$2y$12$H0IH1MS/PieQVxu1HknWZ.Sz5LHV9j.EQQ6Qo8Qv35poAk3pNl68i', NULL, NULL, '2024-06-27 20:43:10', NULL, NULL, NULL, 2, 'Robert De Villa', 2, 'Larry Flores', '2024-01-17', '2024-12-08 13:31:09', '2024-12-08 13:31:09'),
(158, '43877', '2023-10-18-43877', 2, NULL, 1, 'George', 'Garcia', 'De Ocampo', NULL, '8988 Phase 5 Block 22 Lot 44 Atis Drive, Barangay 175, Caloocan City', 11, '1959-12-08', 65, 'Digos City', 1, 1, '+639466265783', 'sample4.png', NULL, 'sample5.jpg', 'sample3.jpg', 'sample6.png', 5, 'Living Temporarily in a Shelter', 1, 6, 1, 3, 1, 'Chronic pain conditions', 1, 'Visual impairment', '2023-10-18', 'george.263.lópez@example.com', '$2y$12$vfuHzMwtS0H42mP5of4L/.S/Nc/sKSi9B0HgiupPmWvZ0bsk0ZBnG', NULL, NULL, '2024-07-29 15:38:59', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-11-18', '2024-12-08 13:31:09', '2024-12-08 13:31:09'),
(159, '66697', '2024-05-17-66697', 3, 4, 1, 'Brian', 'Cabrera', 'Delos Reyes', NULL, '8854 Phase 8 Block 36 Lot 9 Atis Drive, Barangay 187, Caloocan City', 28, '1926-12-08', 98, 'Digos City', 1, 4, '+639700203045', 'sample4.png', NULL, 'sample5.jpg', 'sample3.jpg', 'sample6.png', 4, NULL, 0, NULL, 1, 8, 0, NULL, 0, NULL, '2024-05-17', 'brian.763.sanantonio@example.com', '$2y$12$0LkRhQB1kI1eEdT.DEP5bu9M8GIExZNnzn.vo7lqXmYxK4G1nba3q', NULL, NULL, '2024-10-15 12:10:16', NULL, NULL, NULL, 2, 'Zoe San Antonio', 2, 'Karen Villanueva', '2024-06-17', '2024-12-08 13:31:09', '2024-12-08 13:31:09'),
(160, '43482', '2023-08-11-43482', 2, NULL, 1, 'Virginia', 'Castillo', 'Chua', NULL, '5286 Phase 7 Block 49 Lot 27 Malolos Avenue, Barangay 165, Caloocan City', 1, '1945-12-08', 79, 'Tarlac City', 2, 2, '+639930660368', 'sample4.png', NULL, 'sample5.jpg', 'sample3.jpg', 'sample6.png', 5, 'Incarcerated or Detained', 1, 5, 0, NULL, 0, NULL, 0, NULL, '2023-08-11', 'virginia.740.alfonso@example.com', '$2y$12$MnNbimQm36VkodzIbJ0mKuFr4EKJG6pLbDZcb4omM7MwZlLRcBubW', NULL, NULL, '2024-11-16 21:47:55', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-09-11', '2024-12-08 13:31:09', '2024-12-08 13:31:09');
INSERT INTO `seniors` (`id`, `osca_id`, `ncsc_rrn`, `application_status_id`, `account_status_id`, `user_type_id`, `first_name`, `middle_name`, `last_name`, `suffix`, `address`, `barangay_id`, `birthdate`, `age`, `birthplace`, `sex_id`, `civil_status_id`, `contact_no`, `valid_id`, `profile_picture`, `indigency`, `birth_certificate`, `signature_data`, `type_of_living_arrangement`, `other_arrangement_remark`, `pensioner`, `if_pensioner_yes`, `permanent_source`, `if_permanent_yes_income`, `has_illness`, `if_illness_yes`, `has_disability`, `if_disability_yes`, `date_applied`, `email`, `password`, `verification_code`, `verification_expires_at`, `verified_at`, `token`, `remember_token`, `expiration`, `application_assistant_id`, `application_assistant_name`, `registration_assistant_id`, `registration_assistant_name`, `date_approved`, `created_at`, `updated_at`) VALUES
(161, '18054', '2024-12-07-18054', 3, 3, 1, 'Mark', 'Atienza', 'Suarez', NULL, '4728 Phase 8 Block 77 Lot 86 Lily Avenue, Barangay 176-A, Caloocan City', 12, '1959-12-08', 65, 'Cavite City', 1, 1, '+639886691754', 'sample4.png', NULL, 'sample5.jpg', 'sample3.jpg', 'sample6.png', 4, NULL, 0, NULL, 1, 8, 1, 'Vision impairment', 0, NULL, '2024-12-07', 'mark.14.delatorre@example.com', '$2y$12$LLxKk7ceDUqZJFGe2VlLEui1L2CBfbPHxGUNBrMAyqQuQ4PVZLTt.', NULL, NULL, '2024-10-10 08:08:02', NULL, NULL, NULL, 3, 'Kristoffer Cabigon', 2, 'George Bacani', '2025-01-07', '2024-12-08 13:31:09', '2024-12-08 13:31:09'),
(162, '70941', '2023-07-31-70941', 3, 3, 1, 'Larry', 'Nieves', 'Alvarado', 'III', '3010 Phase 1 Block 30 Lot 84 Cherry Drive, Barangay 176-A, Caloocan City', 12, '1937-12-08', 87, 'Cebu City', 1, 1, '+639865365590', 'sample4.png', NULL, 'sample5.jpg', 'sample3.jpg', 'sample6.png', 1, NULL, 1, 8, 1, 3, 1, 'Depression', 0, NULL, '2023-07-31', 'larry.468.alfonso@example.com', '$2y$12$6rt8yeUEIXT.OMgRq.eaGOnEELvzBHrawqgEpi4FeGlKW30WZxh4K', NULL, NULL, '2024-09-07 23:44:33', NULL, NULL, NULL, 3, 'Kristoffer Cabigon', 3, 'Kristoffer Cabigon', '2023-08-31', '2024-12-08 13:31:09', '2024-12-08 13:31:09'),
(163, '78531', '2024-05-03-78531', 3, 2, 1, 'Mary', 'De Vera', 'Natividad', NULL, '7786 Phase 8 Block 65 Lot 56 Champaca Street, Barangay 182, Caloocan City', 23, '1951-12-08', 73, 'Taguig City', 2, 3, '+639035380725', 'sample4.png', NULL, 'sample5.jpg', 'sample3.jpg', 'sample6.png', 3, NULL, 0, NULL, 1, 5, 0, NULL, 0, NULL, '2024-05-03', 'mary.668.reyes@example.com', '$2y$12$i9FFy1xykZ0.s5T4HNhqqO8qrB7uhJ0wLDFmuWjndzQNxyvQ2vbnC', NULL, NULL, '2024-03-13 03:45:53', NULL, NULL, NULL, 3, 'Kristoffer Cabigon', 3, 'Kristoffer Cabigon', '2024-06-03', '2024-12-08 13:31:09', '2024-12-08 13:31:09'),
(164, '39786', '2023-05-13-39786', 3, 2, 1, 'Laura', 'Castillo', 'Villafuerte', NULL, '9833 Phase 10 Block 15 Lot 16 Aquamarine Avenue, Barangay 176-A, Caloocan City', 12, '1942-12-08', 82, 'San Jose del Monte City', 2, 3, '+639397899014', 'sample4.png', NULL, 'sample5.jpg', 'sample3.jpg', 'sample6.png', 2, NULL, 1, 3, 0, NULL, 1, 'Vision impairment', 0, NULL, '2023-05-13', 'laura.250.cruz@example.com', '$2y$12$XXy9Rl9gj1kqWWYHAIUoLeLWbo6TmVG7/sQ/A.iSN1rsdxF0Wz7OC', NULL, NULL, '2024-10-03 22:00:37', NULL, NULL, NULL, 2, 'Aria Bañez', 3, 'Kristoffer Cabigon', '2023-06-13', '2024-12-08 13:31:09', '2024-12-08 13:31:09'),
(165, '68273', '2024-01-12-68273', 3, 1, 1, 'Mark', 'De Guzman', 'Labrador', 'III', '5986 Phase 8 Block 90 Lot 14 Pearl Boulevard, Barangay 169, Caloocan City', 5, '1950-12-08', 74, 'Iloilo City', 1, 3, '+639028070652', 'sample4.png', NULL, 'sample5.jpg', 'sample3.jpg', 'sample6.png', 3, NULL, 1, 8, 1, 5, 1, 'Diabetes', 0, NULL, '2024-01-12', 'mark.671.bacani@example.com', '$2y$12$RUtQJNYfk.ZWC2JXMdiSzeNY1tpQozFruiXlQOSKqF/ZS1upfY3NG', NULL, NULL, '2024-01-31 21:16:33', NULL, NULL, NULL, 3, 'Kristoffer Cabigon', 2, 'Charles De Guzman', '2024-02-12', '2024-12-08 13:31:09', '2024-12-08 13:31:09'),
(166, '53916', '2023-03-03-53916', 3, 1, 1, 'Adam', 'Palomares', 'Garcia', NULL, '1606 Phase 9 Block 7 Lot 29 Marigold Street, Barangay 167, Caloocan City', 3, '1939-12-08', 85, 'Santiago City', 1, 3, '+639828331294', 'sample4.png', NULL, 'sample5.jpg', 'sample3.jpg', 'sample6.png', 4, NULL, 1, 3, 1, 8, 1, 'Depression', 0, NULL, '2023-03-03', 'adam.98.tabujara@example.com', '$2y$12$wkIEuQ5tVfsAJ5vbcfJxI.7BL.orMYSGFclYvNYpHkDzEweAnCk8a', NULL, NULL, '2024-01-09 06:26:58', NULL, NULL, NULL, 3, 'Kristoffer Cabigon', 2, 'Robert De Villa', '2023-04-03', '2024-12-08 13:31:10', '2024-12-08 13:31:10'),
(167, '49516', '2023-11-08-49516', 3, 2, 1, 'Paul', 'Valenzuela', 'Ramos', NULL, '7411 Phase 10 Block 8 Lot 17 Kamagong Street, Barangay 177, Caloocan City', 18, '1931-12-08', 93, 'Tuguegarao City', 1, 2, '+639078462800', 'sample4.png', NULL, 'sample5.jpg', 'sample3.jpg', 'sample6.png', 2, NULL, 0, NULL, 1, 7, 0, NULL, 0, NULL, '2023-11-08', 'paul.159.sanantonio@example.com', '$2y$12$RZmcYeIGAPtkxzShcMMAROSnK1jeoLYAuOwQnKmG8bbhrifFmUmIm', NULL, NULL, '2024-03-24 00:17:17', NULL, NULL, NULL, 2, 'Thomas Delos Santos', 3, 'Kristoffer Cabigon', '2023-12-08', '2024-12-08 13:31:10', '2024-12-08 13:31:10'),
(168, '85420', '2024-10-20-85420', 3, 3, 1, 'Kimberly', 'Cruz', 'Salvador', NULL, '8443 Phase 3 Block 53 Lot 69 Gladiola Boulevard, Barangay 176-D, Caloocan City', 15, '1958-12-08', 66, 'Cabanatuan City', 2, 3, '+639724057685', 'sample4.png', NULL, 'sample5.jpg', 'sample3.jpg', 'sample6.png', 5, 'Living in a Shared Rental Property', 0, NULL, 0, NULL, 0, NULL, 0, NULL, '2024-10-20', 'kimberly.910.manalo@example.com', '$2y$12$tTL/797kAO83N1.vqyyuF.OniDgkbUbREBpZZqLQ.4lGpyjvmJ7Ly', NULL, NULL, '2024-03-24 06:20:18', NULL, NULL, NULL, 2, 'Charles De Guzman', 3, 'Kristoffer Cabigon', '2024-11-20', '2024-12-08 13:31:10', '2024-12-08 13:31:10'),
(169, '85062', '2023-01-22-85062', 4, NULL, 1, 'Nancy', 'San Antonio', 'Cabrera', NULL, '3589 Phase 8 Block 45 Lot 60 Magnolia Avenue, Barangay 185, Caloocan City', 26, '1933-12-08', 91, 'Calamba City', 2, 1, '+639744346200', 'sample4.png', NULL, 'sample5.jpg', 'sample3.jpg', 'sample6.png', 4, NULL, 1, 10, 0, NULL, 0, NULL, 0, NULL, '2023-01-22', 'nancy.97.sarmiento@example.com', '$2y$12$5/Hi/m2fDjD36Q4khZ.ZZe2eCchVGGUDTOnC/h2dTwGbtNeWbs96q', NULL, NULL, '2024-10-17 11:31:21', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-02-22', '2024-12-08 13:31:10', '2024-12-08 13:31:10'),
(170, '27278', '2024-11-18-27278', 3, 1, 1, 'Joseph', 'Bautista', 'López', 'Jr.', '4275 Phase 5 Block 39 Lot 13 Pineapple Avenue, Barangay 168, Caloocan City', 4, '1927-12-08', 97, 'Taguig City', 1, 3, '+639359705119', 'sample4.png', NULL, 'sample5.jpg', 'sample3.jpg', 'sample6.png', 3, NULL, 1, 4, 0, NULL, 1, 'Gastroesophageal reflux disease (GERD)', 0, NULL, '2024-11-18', 'joseph.794.delrosario@example.com', '$2y$12$564yyjLjfnXdHkKATDjHHuNGpI4kBSlW1d2oRw2P1O4a//h1XmQWK', NULL, NULL, '2024-06-22 02:15:12', NULL, NULL, NULL, 2, 'Kristoffer Cabigon', 3, 'Kristoffer Cabigon', '2024-12-18', '2024-12-08 13:31:10', '2024-12-08 13:31:10'),
(171, '20366', '2024-06-03-20366', 3, 4, 1, 'Cynthia', 'Dela Torre', 'De Jesus', NULL, '9445 Phase 6 Block 26 Lot 57 Matapat Boulevard, Barangay 173, Caloocan City', 9, '1928-12-08', 96, 'Digos City', 2, 4, '+639951039295', 'sample4.png', NULL, 'sample5.jpg', 'sample3.jpg', 'sample6.png', 4, NULL, 0, NULL, 1, 1, 0, NULL, 0, NULL, '2024-06-03', 'cynthia.941.salinas@example.com', '$2y$12$QzZNYRnCPmPgZUTtDuDDhOoxxRjamFCSSTGZijaf4MsrfmFSYezJq', NULL, NULL, '2024-05-13 05:34:31', NULL, NULL, NULL, 3, 'Kristoffer Cabigon', 3, 'Kristoffer Cabigon', '2024-07-03', '2024-12-08 13:31:10', '2024-12-08 13:31:10'),
(172, '41712', '2024-02-20-41712', 4, NULL, 1, 'Larry', 'Vera', 'Esteban', 'II', '1116 Phase 1 Block 48 Lot 88 Magiting Street, Barangay 176-F, Caloocan City', 17, '1939-12-08', 85, 'San Fernando City (Pampanga)', 1, 1, '+639844147119', 'sample4.png', NULL, 'sample5.jpg', 'sample3.jpg', 'sample6.png', 3, NULL, 1, 5, 1, 8, 1, 'Hypothyroidism', 0, NULL, '2024-02-20', 'larry.946.bautista@example.com', '$2y$12$dSeV7UYVPpj1v4wxdU3OXOuqhbWKQFiHgP/fxf2U0teQgoFGiASnW', NULL, NULL, '2024-05-06 04:23:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-03-20', '2024-12-08 13:31:10', '2024-12-08 13:31:10'),
(173, '97427', '2024-11-09-97427', 3, 4, 1, 'Harper', 'Villanueva', 'Suarez', NULL, '1688 Phase 7 Block 63 Lot 76 Daisy Road, Barangay 175, Caloocan City', 11, '1933-12-08', 91, 'San Juan City', 2, 3, '+639288484161', 'sample4.png', NULL, 'sample5.jpg', 'sample3.jpg', 'sample6.png', 5, 'Living with Extended Family', 1, 7, 0, NULL, 0, NULL, 1, 'Visual impairment', '2024-11-09', 'harper.981.ponce@example.com', '$2y$12$xTCvIL17Ej6AnCzw/sIt1uyiceqhQUtpRk52jsyOJveBYx3Wt0xti', NULL, NULL, '2024-04-30 03:14:42', NULL, NULL, NULL, 2, 'Ronald Salvador', 2, 'Mark Martelino', '2024-12-09', '2024-12-08 13:31:10', '2024-12-08 13:31:10'),
(174, '52676', '2024-06-30-52676', 3, 1, 1, 'George', 'Delos Reyes', 'Macapagal', 'Sr.', '3753 Phase 7 Block 1 Lot 31 Mars Drive, Barangay 176-F, Caloocan City', 17, '1949-12-08', 75, 'Zamboanga City', 1, 4, '+639481991902', 'sample4.png', NULL, 'sample5.jpg', 'sample3.jpg', 'sample6.png', 5, 'Institutional Living', 0, NULL, 1, 4, 0, NULL, 0, NULL, '2024-06-30', 'george.915.ocampo@example.com', '$2y$12$q2Fhbtzb5OCanb1Iop9tb.I1zKKmm5CMDOwwkx0mpHUsdBw4W4oLa', NULL, NULL, '2024-04-22 23:59:24', NULL, NULL, NULL, 2, 'Savannah Reyes', 3, 'Kristoffer Cabigon', '2024-07-30', '2024-12-08 13:31:10', '2024-12-08 13:31:10'),
(175, '67636', '2023-08-25-67636', 3, 2, 1, 'Ella', 'Dela Cruz', 'San Pedro', NULL, '9720 Phase 2 Block 66 Lot 59 Mabuhay Road, Barangay 172, Caloocan City', 8, '1937-12-08', 87, 'San Juan City', 2, 4, '+639359281131', 'sample4.png', NULL, 'sample5.jpg', 'sample3.jpg', 'sample6.png', 3, NULL, 1, 9, 0, NULL, 1, 'Hypertension', 0, NULL, '2023-08-25', 'ella.707.aguilar@example.com', '$2y$12$.mjDkfgWWCl3a036eT3zzuzimGGxsuUutUhazLZPdKsQLXO66NklK', NULL, NULL, '2024-05-09 13:37:38', NULL, NULL, NULL, 3, 'Kristoffer Cabigon', 3, 'Kristoffer Cabigon', '2023-09-25', '2024-12-08 13:31:10', '2024-12-08 13:31:10'),
(176, '24909', '2023-06-14-24909', 3, 3, 1, 'James', 'San Antonio', 'Ocampo', NULL, '5712 Phase 5 Block 5 Lot 23 Garnet Drive, Barangay 176-C, Caloocan City', 14, '1958-12-08', 66, 'Pasig City', 1, 4, '+639972013878', 'sample4.png', NULL, 'sample5.jpg', 'sample3.jpg', 'sample6.png', 3, NULL, 1, 10, 1, 11, 0, NULL, 0, NULL, '2023-06-14', 'james.46.riviera@example.com', '$2y$12$Qa3IxoS/gctc4Vx.SdpTYOVGs2xB8H2pofdzZAGBWKGcLjXlqrwtO', NULL, NULL, '2024-02-10 11:40:03', NULL, NULL, NULL, 2, 'Kristoffer Cabigon', 3, 'Kristoffer Cabigon', '2023-07-14', '2024-12-08 13:31:10', '2024-12-08 13:31:10'),
(177, '85417', '2023-04-02-85417', 1, NULL, 1, 'Deborah', 'Del Castillo', 'Chua', NULL, '7562 Phase 5 Block 35 Lot 28 Citrine Avenue, Barangay 181, Caloocan City', 22, '1940-12-08', 84, 'Quezon City', 2, 4, '+639452477737', 'sample4.png', NULL, 'sample5.jpg', 'sample3.jpg', 'sample6.png', 5, 'Living with Extended Family', 1, 1, 1, 3, 1, 'Parkinson disease', 0, NULL, '2023-04-02', 'deborah.441.martinez@example.com', '$2y$12$OIAWEhGs9v30bwtnPiojR.YtmYRzaKQx4nKPR8dNuNCMOp9V3Ld9G', NULL, NULL, '2024-03-08 21:41:55', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-05-02', '2024-12-08 13:31:10', '2024-12-08 13:31:10'),
(178, '69566', '2024-11-09-69566', 3, 1, 1, 'Eric', 'Cortez', 'Bacani', 'Sr.', '8205 Phase 7 Block 2 Lot 42 Guava Drive, Barangay 167, Caloocan City', 3, '1933-12-08', 91, 'Cabanatuan City', 1, 1, '+639958285437', 'sample4.png', NULL, 'sample5.jpg', 'sample3.jpg', 'sample6.png', 1, NULL, 0, NULL, 1, 8, 0, NULL, 0, NULL, '2024-11-09', 'eric.182.rocamora@example.com', '$2y$12$TL3cKkIJMNcFrK7FpumnsOhC9z3gBw1dbYv8Hl2EwRIyFvUGra08C', NULL, NULL, '2024-03-06 01:49:53', NULL, NULL, NULL, 3, 'Kristoffer Cabigon', 3, 'Kristoffer Cabigon', '2024-12-09', '2024-12-08 13:31:10', '2024-12-08 13:31:10'),
(179, '55900', '2024-05-26-55900', 3, 4, 1, 'Ronald', 'Alfonso', 'Tonio', NULL, '9125 Phase 3 Block 20 Lot 45 Silver Street, Barangay 178, Caloocan City', 19, '1932-12-08', 92, 'Cagayan de Oro City', 1, 1, '+639161664641', 'sample4.png', NULL, 'sample5.jpg', 'sample3.jpg', 'sample6.png', 1, NULL, 1, 1, 0, NULL, 0, NULL, 0, NULL, '2024-05-26', 'ronald.50.delosreyes@example.com', '$2y$12$b2tghGwVMXpHMzuInQ0rget5IE8cZFL/SRfIlHKaAZ.72XYrlVvc6', NULL, NULL, '2024-02-17 04:49:01', NULL, NULL, NULL, 3, 'Kristoffer Cabigon', 2, 'Mark Martelino', '2024-06-26', '2024-12-08 13:31:11', '2024-12-08 13:31:11'),
(180, '62153', '2024-03-14-62153', 3, 1, 1, 'Emma', 'Delos Santos', 'Cruzado', NULL, '5060 Phase 9 Block 35 Lot 15 Waling-Waling Boulevard, Barangay 170, Caloocan City', 6, '1935-12-08', 89, 'Marikina City', 2, 4, '+639482399586', 'sample4.png', NULL, 'sample5.jpg', 'sample3.jpg', 'sample6.png', 3, NULL, 1, 2, 0, NULL, 1, 'Anxiety disorders', 0, NULL, '2024-03-14', 'emma.400.alcantara@example.com', '$2y$12$gIH/wlBTx4ofxwO5.jsXxOdjCidUhGd5byAW7w4ZI1yL8stSTTP6W', NULL, NULL, '2024-07-10 08:38:30', NULL, NULL, NULL, 2, 'Savannah Reyes', 2, 'Charles De Guzman', '2024-04-14', '2024-12-08 13:31:11', '2024-12-08 13:31:11'),
(181, '81232', '2023-06-21-81232', 3, 2, 1, 'Ella', 'Cortez', 'De Leon', NULL, '1297 Phase 8 Block 51 Lot 87 Atis Drive, Barangay 172, Caloocan City', 8, '1928-12-08', 96, 'Makati City', 2, 2, '+639944672262', 'sample4.png', NULL, 'sample5.jpg', 'sample3.jpg', 'sample6.png', 3, NULL, 0, NULL, 0, NULL, 1, 'Stroke', 1, 'Mental health condition', '2023-06-21', 'ella.762.delossantos@example.com', '$2y$12$3MFdU3ZyDSP1fpIKGKcrj.gDH33XdDRJUwbE01cYjQfHmgmiprvQK', NULL, NULL, '2024-10-17 19:41:45', NULL, NULL, NULL, 2, 'Thomas Martinez', 3, 'Kristoffer Cabigon', '2023-07-21', '2024-12-08 13:31:11', '2024-12-08 13:31:11'),
(182, '37141', '2024-09-03-37141', 4, NULL, 1, 'Diane', 'Bautista', 'Cabrera', NULL, '5079 Phase 2 Block 34 Lot 84 Magnolia Avenue, Barangay 174, Caloocan City', 10, '1962-12-08', 62, 'Cagayan de Oro City', 2, 4, '+639636026063', 'sample4.png', NULL, 'sample5.jpg', 'sample3.jpg', 'sample6.png', 4, NULL, 0, NULL, 1, 11, 1, 'Stroke', 1, 'Mental health condition', '2024-09-03', 'diane.832.santos@example.com', '$2y$12$HT8rdN0P6bt4j4tgHzELb.auXqulZawIOm/cvzl395gSqJjlTQDy2', NULL, NULL, '2024-02-17 20:48:17', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-10-03', '2024-12-08 13:31:11', '2024-12-08 13:31:11'),
(183, '46521', '2024-06-29-46521', 2, NULL, 1, 'Linda', 'San Juan', 'Flores', NULL, '3602 Phase 1 Block 89 Lot 81 Marangal Drive, Barangay 177, Caloocan City', 18, '1948-12-08', 76, 'Malabon City', 2, 1, '+639266267406', 'sample4.png', NULL, 'sample5.jpg', 'sample3.jpg', 'sample6.png', 3, NULL, 1, 1, 1, 2, 0, NULL, 0, NULL, '2024-06-29', 'linda.160.sanjuan@example.com', '$2y$12$ykNDkDAqNyoHoyLhYPnLzeJCtLGSn/AsEkp2cW9P4VeyZK1eet62q', NULL, NULL, '2024-11-28 12:12:36', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-29', '2024-12-08 13:31:11', '2024-12-08 13:31:11'),
(184, '22614', '2024-05-12-22614', 3, 2, 1, 'Jessica', 'De Leon', 'Pascual', NULL, '4636 Phase 1 Block 17 Lot 90 Masaya Road, Barangay 176-E, Caloocan City', 16, '1945-12-08', 79, 'Dumaguete City', 2, 1, '+639252010055', 'sample4.png', NULL, 'sample5.jpg', 'sample3.jpg', 'sample6.png', 4, NULL, 1, 2, 0, NULL, 0, NULL, 1, 'Visual impairment', '2024-05-12', 'jessica.471.pineda@example.com', '$2y$12$OChK6II3Uu0uSeG184sXqe/X2mrTxPMbXIvsqwIeO0HOUbixpjDP2', NULL, NULL, '2024-08-19 00:36:13', NULL, NULL, NULL, 2, 'Karen Villanueva', 2, 'Jessica Villanueva', '2024-06-12', '2024-12-08 13:31:11', '2024-12-08 13:31:11'),
(185, '44018', '2023-10-13-44018', 4, NULL, 1, 'Larry', 'Atienza', 'Cruz', 'Sr.', '7626 Phase 9 Block 9 Lot 56 Marangal Drive, Barangay 167, Caloocan City', 3, '1963-12-08', 61, 'Marikina City', 1, 3, '+639098838317', 'sample4.png', NULL, 'sample5.jpg', 'sample3.jpg', 'sample6.png', 2, NULL, 1, 10, 1, 6, 1, 'Anxiety disorders', 0, NULL, '2023-10-13', 'larry.782.velasquez@example.com', '$2y$12$f05gSSaXKlkHe7gWixiQn.2iTk7Y7l4eT/CayRApZLT6AFjMSxKJy', NULL, NULL, '2024-05-05 17:06:49', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-11-13', '2024-12-08 13:31:11', '2024-12-08 13:31:11'),
(186, '26539', '2023-02-01-26539', 3, 2, 1, 'Adam', 'Tabujara', 'Vera', 'I', '5199 Phase 6 Block 67 Lot 49 Coral Boulevard, Barangay 188, Caloocan City', 29, '1951-12-08', 73, 'Iligan City', 1, 3, '+639975611066', 'sample4.png', NULL, 'sample5.jpg', 'sample3.jpg', 'sample6.png', 5, 'Living in a Boarding House/Dormitory', 0, NULL, 1, 7, 0, NULL, 0, NULL, '2023-02-01', 'adam.211.torres@example.com', '$2y$12$LjB.ON5iL0bZd8ntwUTfb.fP89DskpT7MG2MmIBIxtl6lHwCcJCAe', NULL, NULL, '2024-11-02 07:54:38', NULL, NULL, NULL, 3, 'Kristoffer Cabigon', 2, 'Thomas Delos Santos', '2023-03-01', '2024-12-08 13:31:11', '2024-12-08 13:31:11'),
(187, '60892', '2022-12-15-60892', 3, 4, 1, 'Donald', 'Verano', 'De Ocampo', 'Sr.', '8288 Phase 3 Block 9 Lot 19 Carnation Road, Barangay 166, Caloocan City', 2, '1943-12-08', 81, 'San Fernando City (Pampanga)', 1, 2, '+639892228524', 'sample4.png', NULL, 'sample5.jpg', 'sample3.jpg', 'sample6.png', 3, NULL, 0, NULL, 1, 4, 0, NULL, 0, NULL, '2022-12-15', 'donald.208.esteban@example.com', '$2y$12$4956oVDUvSzqQH9uuNXKLOIQboIkybkoir56dppvJ80FA3uP/HFoe', NULL, NULL, '2023-12-24 05:04:05', NULL, NULL, NULL, 3, 'Kristoffer Cabigon', 3, 'Kristoffer Cabigon', '2023-01-15', '2024-12-08 13:31:11', '2024-12-08 13:31:11'),
(188, '29754', '2024-08-14-29754', 1, NULL, 1, 'Sarah', 'De la Vega', 'Velasquez', NULL, '7655 Phase 1 Block 19 Lot 28 Cosmos Drive, Barangay 183, Caloocan City', 24, '1933-12-08', 91, 'Marikina City', 2, 2, '+639233309526', 'sample4.png', NULL, 'sample5.jpg', 'sample3.jpg', 'sample6.png', 2, NULL, 1, 11, 0, NULL, 1, 'Osteoporosis', 0, NULL, '2024-08-14', 'sarah.807.salinas@example.com', '$2y$12$XAr1VxBoFRn6DoNFx/e7yO54RjLL4roNaWmgXQDDDuq0UDaBEeKse', NULL, NULL, '2024-11-27 19:56:44', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-09-14', '2024-12-08 13:31:11', '2024-12-08 13:31:11'),
(189, '97678', '2023-07-13-97678', 3, 1, 1, 'Barbara', 'Esteban', 'Macapagal', NULL, '2731 Phase 6 Block 73 Lot 8 Marigold Street, Barangay 168, Caloocan City', 4, '1951-12-08', 73, 'San Jose City (Occidental Mindoro)', 2, 3, '+639470760919', 'sample4.png', NULL, 'sample5.jpg', 'sample3.jpg', 'sample6.png', 1, NULL, 1, 9, 1, 3, 1, 'Chronic obstructive pulmonary disease (COPD)', 1, 'Visual impairment', '2023-07-13', 'barbara.797.cabrera@example.com', '$2y$12$40JVny6rfepSNq9CmYg7KOui1NcCLuOV2MLa2vGuFusbsbYiink8S', NULL, NULL, '2024-01-24 04:15:48', NULL, NULL, NULL, 3, 'Kristoffer Cabigon', 2, 'Larry Flores', '2023-08-13', '2024-12-08 13:31:11', '2024-12-08 13:31:11'),
(190, '36694', '2024-03-04-36694', 4, NULL, 1, 'Harper', 'De Guzman', 'Cruzado', NULL, '2182 Phase 4 Block 44 Lot 79 Sunflower Drive, Barangay 168, Caloocan City', 4, '1927-12-08', 97, 'San Jose City (Occidental Mindoro)', 2, 1, '+639275889016', 'sample4.png', NULL, 'sample5.jpg', 'sample3.jpg', 'sample6.png', 4, NULL, 0, NULL, 1, 10, 1, 'Stroke', 0, NULL, '2024-03-04', 'harper.803.ocampo@example.com', '$2y$12$8uHfb0rhfxZeJotHc8wsoONkn/xzVfroL3Lu7rYFQGtN9ObIoNHx2', NULL, NULL, '2024-10-08 20:19:31', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-04-04', '2024-12-08 13:31:11', '2024-12-08 13:31:11'),
(191, '11941', '2022-12-22-11941', 2, NULL, 1, 'Susan', 'Tonio', 'Rosales', NULL, '8729 Phase 7 Block 83 Lot 9 Orion Boulevard, Barangay 167, Caloocan City', 3, '1955-12-08', 69, 'Santiago City', 2, 2, '+639694401369', 'sample4.png', NULL, 'sample5.jpg', 'sample3.jpg', 'sample6.png', 5, 'Institutional Living', 0, NULL, 0, NULL, 0, NULL, 0, NULL, '2022-12-22', 'susan.752.deocampo@example.com', '$2y$12$OJhS/DZtVuEHpa9xN5erPe1AL9DBBwPWK32qR9Jwk6AVz6yXPt34C', NULL, NULL, '2024-05-06 10:03:55', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-01-22', '2024-12-08 13:31:11', '2024-12-08 13:31:11'),
(192, '62259', '2024-09-20-62259', 1, NULL, 1, 'Jack', 'Suarez', 'Riviera', 'I', '6248 Phase 4 Block 22 Lot 54 Coral Boulevard, Barangay 165, Caloocan City', 1, '1939-12-08', 85, 'San Jose del Monte City', 1, 1, '+639731476612', 'sample4.png', NULL, 'sample5.jpg', 'sample3.jpg', 'sample6.png', 3, NULL, 1, 5, 0, NULL, 1, 'Dementia', 0, NULL, '2024-09-20', 'jack.952.arroyo@example.com', '$2y$12$b2Opvo4PqcZpeTvAZC8NWupOqg/dZ3NYWC9rpOOi1hpso86L0v/US', NULL, NULL, '2024-02-29 15:21:18', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-10-20', '2024-12-08 13:31:12', '2024-12-08 13:31:12'),
(193, '86157', '2022-12-11-86157', 3, 1, 1, 'Richard', 'Misa', 'Valenzuela', 'Jr.', '4698 Phase 5 Block 72 Lot 71 Mars Drive, Barangay 176-F, Caloocan City', 17, '1942-12-08', 82, 'Manila', 1, 2, '+639712109191', 'sample4.png', NULL, 'sample5.jpg', 'sample3.jpg', 'sample6.png', 1, NULL, 1, 5, 0, NULL, 1, 'Arthritis', 0, NULL, '2022-12-11', 'richard.877.verano@example.com', '$2y$12$O09e0jOTC99an/vV8S3R7eUuNIWwqvGdg6C14dIqWaZeJqmOERXI2', NULL, NULL, '2024-09-19 09:07:14', NULL, NULL, NULL, 2, 'Thomas Delos Santos', 2, 'Paul De la Rosa', '2023-01-11', '2024-12-08 13:31:12', '2024-12-08 13:31:12'),
(194, '67440', '2022-12-26-67440', 4, NULL, 1, 'Richard', 'Salinas', 'Santiago', NULL, '8825 Phase 9 Block 61 Lot 83 Aquamarine Avenue, Barangay 174, Caloocan City', 10, '1930-12-08', 94, 'San Jose del Monte City', 1, 2, '+639624813632', 'sample4.png', NULL, 'sample5.jpg', 'sample3.jpg', 'sample6.png', 1, NULL, 0, NULL, 0, NULL, 1, 'Hypothyroidism', 0, NULL, '2022-12-26', 'richard.626.delatorre@example.com', '$2y$12$B75KVzTdngRWWvF4uFa6NOpmdeIimEjAJD/FYy1R/J4aWyUj2mXcC', NULL, NULL, '2024-07-16 03:26:30', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-01-26', '2024-12-08 13:31:12', '2024-12-08 13:31:12'),
(195, '77666', '2023-08-16-77666', 2, NULL, 1, 'Sarah', 'Bañez', 'San Pedro', NULL, '6876 Phase 4 Block 17 Lot 87 Guyabano Avenue, Barangay 179, Caloocan City', 20, '1950-12-08', 74, 'Ormoc City', 2, 2, '+639952593506', 'sample4.png', NULL, 'sample5.jpg', 'sample3.jpg', 'sample6.png', 3, NULL, 1, 10, 1, 3, 1, 'Dementia', 0, NULL, '2023-08-16', 'sarah.477.magsaysay@example.com', '$2y$12$8iDn8MU8m1KNTR8zogdwseFFUjMpQj0jGiEiNwy/Ofgl8yfKm6Uje', NULL, NULL, '2024-03-24 14:31:20', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-09-16', '2024-12-08 13:31:12', '2024-12-08 13:31:12'),
(196, '19103', '2024-07-03-19103', 1, NULL, 1, 'Sophia', 'Del Rosario', 'Tonio', NULL, '6775 Phase 8 Block 39 Lot 62 Mahinhin Drive, Barangay 187, Caloocan City', 28, '1952-12-08', 72, 'Tagum City', 2, 4, '+639425356159', 'sample4.png', NULL, 'sample5.jpg', 'sample3.jpg', 'sample6.png', 1, NULL, 0, NULL, 0, NULL, 1, 'Gastroesophageal reflux disease (GERD)', 1, 'Cognitive disability', '2024-07-03', 'sophia.657.sanpedro@example.com', '$2y$12$0vUqGlP3QSXYMYMLouwoVe15CD0YHF0hNRkzX/jj956IYCSB8pyMq', NULL, NULL, '2024-06-28 03:16:26', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-08-03', '2024-12-08 13:31:12', '2024-12-08 13:31:12'),
(197, '30944', '2024-07-09-30944', 3, 3, 1, 'Eric', 'Mendoza', 'De la Vega', 'Jr.', '2971 Phase 5 Block 78 Lot 10 Emerald Boulevard, Barangay 180, Caloocan City', 21, '1952-12-08', 72, 'Lapu-Lapu City', 1, 3, '+639661630691', 'sample4.png', NULL, 'sample5.jpg', 'sample3.jpg', 'sample6.png', 2, NULL, 1, 7, 0, NULL, 1, 'Chronic pain conditions', 1, 'Mobility impairment', '2024-07-09', 'eric.346.alcantara@example.com', '$2y$12$1H7Kyb027Qn5g4gxJFTL7e6Kko2qcLgrzxvML7yP2fSlE4HL2aM8y', NULL, NULL, '2024-04-27 20:49:46', NULL, NULL, NULL, 3, 'Kristoffer Cabigon', 3, 'Kristoffer Cabigon', '2024-08-09', '2024-12-08 13:31:12', '2024-12-08 13:31:12'),
(198, '23126', '2024-11-06-23126', 3, 1, 1, 'Jessica', NULL, 'Suarez', NULL, '3687 Phase 7 Block 62 Lot 65 Venus Road, Barangay 174, Caloocan City', 10, '1943-12-08', 81, 'Tacloban City', 2, 4, '+639211468002', 'sample4.png', NULL, 'sample5.jpg', 'sample3.jpg', 'sample6.png', 2, NULL, 0, NULL, 1, 8, 1, 'Dementia', 0, NULL, '2024-11-06', 'jessica.689.matias@example.com', '$2y$12$mIz5Nyg900YAKsfDZLaHueXRcFaDH/jYR0fwLV6g8lyzZDz7SzoEe', NULL, NULL, '2024-11-17 18:32:50', NULL, NULL, NULL, 2, 'Matthew Flores', 3, 'Kristoffer Cabigon', '2024-12-06', '2024-12-08 13:31:12', '2024-12-08 13:31:12'),
(199, '70815', '2023-07-04-70815', 3, 3, 1, 'Charles', 'Rocamora', 'Mendoza', 'II', '9074 Phase 5 Block 84 Lot 43 Matamis Street, Barangay 186, Caloocan City', 27, '1948-12-08', 76, 'San Fernando City (Pampanga)', 1, 3, '+639912867747', 'sample4.png', NULL, 'sample5.jpg', 'sample3.jpg', 'sample6.png', 4, NULL, 0, NULL, 0, NULL, 0, NULL, 0, NULL, '2023-07-04', 'charles.168.reyes@example.com', '$2y$12$Thc8B2lAMQ1V/cNJboVb3OIhUPAJ4iBZKS7w0oEy64WjK0gY9Mnam', NULL, NULL, '2024-02-02 04:59:54', NULL, NULL, NULL, 2, 'Zoe San Antonio', 3, 'Kristoffer Cabigon', '2023-08-04', '2024-12-08 13:31:12', '2024-12-08 13:31:12'),
(200, '25799', '2023-08-11-25799', 1, NULL, 1, 'Daniel', 'Salas', 'Villafuerte', 'I', '2712 Phase 1 Block 31 Lot 25 Violeta Street, Barangay 180, Caloocan City', 21, '1956-12-08', 68, 'Mandaluyong City', 1, 4, '+639243004625', 'sample4.png', NULL, 'sample5.jpg', 'sample3.jpg', 'sample6.png', 2, NULL, 0, NULL, 0, NULL, 1, 'Hearing loss', 0, NULL, '2023-08-11', 'daniel.768.esguerra@example.com', '$2y$12$EG1XQWpOxEkfies8Ec.f5OgmtXTxl0ZkAvEOxF7g/rWHQJ8.JGEte', NULL, NULL, '2024-06-12 01:44:55', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-09-11', '2024-12-08 13:31:12', '2024-12-08 13:31:12');

-- --------------------------------------------------------

--
-- Table structure for table `senior_account_status_list`
--

CREATE TABLE `senior_account_status_list` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `senior_account_status` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `senior_account_status_list`
--

INSERT INTO `senior_account_status_list` (`id`, `senior_account_status`, `created_at`, `updated_at`) VALUES
(1, 'Active', NULL, NULL),
(2, 'Inactive', NULL, NULL),
(3, 'Disqualified', NULL, NULL),
(4, 'Deactivated', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `senior_application_status_list`
--

CREATE TABLE `senior_application_status_list` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `senior_application_status` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `senior_application_status_list`
--

INSERT INTO `senior_application_status_list` (`id`, `senior_application_status`, `created_at`, `updated_at`) VALUES
(1, 'Under Evaluation', NULL, NULL),
(2, 'On Hold', NULL, NULL),
(3, 'Approved', NULL, NULL),
(4, 'Rejected', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `senior_guardian`
--

CREATE TABLE `senior_guardian` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `senior_id` bigint(20) UNSIGNED DEFAULT NULL,
  `guardian_first_name` varchar(255) DEFAULT NULL,
  `guardian_middle_name` varchar(255) DEFAULT NULL,
  `guardian_last_name` varchar(255) DEFAULT NULL,
  `guardian_suffix` varchar(255) DEFAULT NULL,
  `guardian_relationship_id` bigint(20) UNSIGNED DEFAULT NULL,
  `guardian_contact_no` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `senior_guardian`
--

INSERT INTO `senior_guardian` (`id`, `senior_id`, `guardian_first_name`, `guardian_middle_name`, `guardian_last_name`, `guardian_suffix`, `guardian_relationship_id`, `guardian_contact_no`, `created_at`, `updated_at`) VALUES
(1, 1, 'Eliane', 'Rashad', 'Martinez', NULL, 12, '+639922261538', '2024-12-08 13:31:12', '2024-12-08 13:31:12'),
(2, 2, 'Tiana', 'Ova', 'De Villa', 'Jr.', 6, '+639191539170', '2024-12-08 13:31:13', '2024-12-08 13:31:13'),
(3, 3, 'Marguerite', 'Keegan', 'Delos Reyes', 'Jr.', 8, '+639059465404', '2024-12-08 13:31:13', '2024-12-08 13:31:13'),
(4, 4, 'Anabelle', NULL, 'Zaragoza', NULL, 12, '+639996196678', '2024-12-08 13:31:13', '2024-12-08 13:31:13'),
(5, 5, 'Mekhi', NULL, 'Manalaysay', NULL, 12, '+639728325221', '2024-12-08 13:31:13', '2024-12-08 13:31:13'),
(6, 6, 'Dante', 'Yolanda', 'De la Vega', 'Sr.', 8, '+639271265693', '2024-12-08 13:31:13', '2024-12-08 13:31:13'),
(7, 7, 'Derick', 'Ezequiel', 'De Guzman', 'Jr.', 5, '+639302524452', '2024-12-08 13:31:13', '2024-12-08 13:31:13'),
(8, 8, 'Jessika', NULL, 'Santos', NULL, 3, '+639821775321', '2024-12-08 13:31:13', '2024-12-08 13:31:13'),
(9, 9, 'Jesus', NULL, 'Dela Torre', NULL, 3, '+639126812663', '2024-12-08 13:31:13', '2024-12-08 13:31:13'),
(10, 10, 'Carley', 'Sebastian', 'Tiongson', 'Sr.', 5, '+639620699716', '2024-12-08 13:31:15', '2024-12-08 13:31:15'),
(11, 11, 'Halle', NULL, 'Soriano', NULL, 10, '+639423256062', '2024-12-08 13:31:15', '2024-12-08 13:31:15'),
(12, 12, 'Lennie', NULL, 'Pascual', 'Jr.', 17, '+639024057465', '2024-12-08 13:31:15', '2024-12-08 13:31:15'),
(13, 13, 'Stefanie', 'Marlen', 'Arroyo', 'III', 2, '+639975016892', '2024-12-08 13:31:15', '2024-12-08 13:31:15'),
(14, 14, 'Zetta', 'Alberto', 'Cortez', 'Jr.', 9, '+639404708089', '2024-12-08 13:31:15', '2024-12-08 13:31:15'),
(15, 15, 'Anahi', 'Lane', 'Del Rosario', 'III', 18, '+639159514481', '2024-12-08 13:31:15', '2024-12-08 13:31:15'),
(16, 16, 'Nya', NULL, 'Matias', 'Sr.', 10, '+639421975490', '2024-12-08 13:31:15', '2024-12-08 13:31:15'),
(17, 17, 'Blanche', 'Karine', 'Arroyo', 'III', 2, '+639668689645', '2024-12-08 13:31:15', '2024-12-08 13:31:15'),
(18, 18, 'Monserrat', 'Ursula', 'De Ocampo', 'Sr.', 2, '+639726984938', '2024-12-08 13:31:15', '2024-12-08 13:31:15'),
(19, 19, 'Marquis', 'Fern', 'De Ocampo', 'Jr.', 10, '+639121145358', '2024-12-08 13:31:15', '2024-12-08 13:31:15'),
(20, 20, 'Lisette', NULL, 'Santiago', 'Sr.', 12, '+639176863820', '2024-12-08 13:31:15', '2024-12-08 13:31:15'),
(21, 21, 'Jaunita', 'May', 'Castillo', 'Jr.', 5, '+639271966707', '2024-12-08 13:31:15', '2024-12-08 13:31:15'),
(22, 22, 'Sigurd', NULL, 'Rocamora', NULL, 18, '+639866438648', '2024-12-08 13:31:15', '2024-12-08 13:31:15'),
(23, 23, 'Joe', NULL, 'Riviera', 'Sr.', 17, '+639041385895', '2024-12-08 13:31:16', '2024-12-08 13:31:16'),
(24, 24, 'Bud', NULL, 'Nieves', 'III', 9, '+639790042942', '2024-12-08 13:31:16', '2024-12-08 13:31:16'),
(25, 25, 'Jarred', 'Stevie', 'Villanueva', 'III', 2, '+639543960613', '2024-12-08 13:31:16', '2024-12-08 13:31:16'),
(26, 26, 'Elva', NULL, 'Salvador', 'Jr.', 3, '+639807235674', '2024-12-08 13:31:16', '2024-12-08 13:31:16'),
(27, 27, 'Edward', NULL, 'Santiago', 'III', 6, '+639834035403', '2024-12-08 13:31:16', '2024-12-08 13:31:16'),
(28, 28, 'Chauncey', NULL, 'Nieves', 'Jr.', 16, '+639672550370', '2024-12-08 13:31:16', '2024-12-08 13:31:16'),
(29, 29, 'Alaina', 'Jordi', 'Gonzales', NULL, 7, '+639566036279', '2024-12-08 13:31:16', '2024-12-08 13:31:16'),
(30, 30, 'Rebekah', 'Lisa', 'Castañeda', 'Jr.', 10, '+639278401773', '2024-12-08 13:31:16', '2024-12-08 13:31:16'),
(31, 31, 'Merritt', NULL, 'Ocampo', NULL, 3, '+639998332503', '2024-12-08 13:31:16', '2024-12-08 13:31:16'),
(32, 32, 'Felicita', NULL, 'Bañez', NULL, 16, '+639246252111', '2024-12-08 13:31:16', '2024-12-08 13:31:16'),
(33, 33, 'Antwon', 'Moshe', 'Esteban', 'Jr.', 12, '+639682327349', '2024-12-08 13:31:16', '2024-12-08 13:31:16'),
(34, 34, 'Scot', 'Viva', 'Alvarado', 'Sr.', 13, '+639703677841', '2024-12-08 13:31:16', '2024-12-08 13:31:16'),
(35, 35, 'Mario', NULL, 'Dizon', 'III', 9, '+639094477087', '2024-12-08 13:31:16', '2024-12-08 13:31:16'),
(36, 36, 'Tierra', NULL, 'Mendoza', 'Jr.', 9, '+639518105527', '2024-12-08 13:31:16', '2024-12-08 13:31:16'),
(37, 37, 'Kody', NULL, 'De la Cruz', NULL, 9, '+639367816285', '2024-12-08 13:31:16', '2024-12-08 13:31:16'),
(38, 38, 'Sylvia', NULL, 'Sison', 'Sr.', 4, '+639171472284', '2024-12-08 13:31:17', '2024-12-08 13:31:17'),
(39, 39, 'Norbert', NULL, 'De la Torre', NULL, 10, '+639603635809', '2024-12-08 13:31:17', '2024-12-08 13:31:17'),
(40, 40, 'Dennis', 'Maida', 'Ramos', NULL, 18, '+639804589833', '2024-12-08 13:31:17', '2024-12-08 13:31:17'),
(41, 41, 'Marcel', NULL, 'Torres', 'Sr.', 2, '+639593118234', '2024-12-08 13:31:17', '2024-12-08 13:31:17'),
(42, 42, 'Sigmund', NULL, 'De Villa', 'III', 7, '+639912048195', '2024-12-08 13:31:17', '2024-12-08 13:31:17'),
(43, 43, 'Kurtis', 'Eldora', 'De Guzman', 'Jr.', 4, '+639943504503', '2024-12-08 13:31:17', '2024-12-08 13:31:17'),
(44, 44, 'Alysa', NULL, 'López', 'Sr.', 18, '+639381006246', '2024-12-08 13:31:17', '2024-12-08 13:31:17'),
(45, 45, 'Nakia', 'Catharine', 'Villafuerte', NULL, 2, '+639531720312', '2024-12-08 13:31:17', '2024-12-08 13:31:17'),
(46, 46, 'Darwin', 'Briana', 'Gonzales', 'Sr.', 9, '+639008720764', '2024-12-08 13:31:17', '2024-12-08 13:31:17'),
(47, 47, 'Laverne', 'Carissa', 'Torres', 'Jr.', 4, '+639786769189', '2024-12-08 13:31:17', '2024-12-08 13:31:17'),
(48, 48, 'Andreanne', NULL, 'Esguerra', 'Sr.', 14, '+639677162692', '2024-12-08 13:31:17', '2024-12-08 13:31:17'),
(49, 49, 'Cydney', 'Callie', 'Dizon', 'Jr.', 1, '+639826305008', '2024-12-08 13:31:17', '2024-12-08 13:31:17'),
(50, 50, 'Hertha', NULL, 'Natividad', 'Jr.', 3, '+639502463320', '2024-12-08 13:31:17', '2024-12-08 13:31:17'),
(51, 51, 'Bell', NULL, 'Cabigon', 'III', 9, '+639124597644', '2024-12-08 13:31:17', '2024-12-08 13:31:17'),
(52, 52, 'Dillon', 'Zetta', 'Villanueva', 'Sr.', 7, '+639820272654', '2024-12-08 13:31:17', '2024-12-08 13:31:17'),
(53, 53, 'Ocie', NULL, 'Martelino', NULL, 14, '+639357848043', '2024-12-08 13:31:17', '2024-12-08 13:31:17'),
(54, 54, 'Lucie', 'Abigayle', 'Vera', 'Jr.', 14, '+639230905893', '2024-12-08 13:31:18', '2024-12-08 13:31:18'),
(55, 55, 'Francisco', 'Maud', 'López', NULL, 13, '+639768826560', '2024-12-08 13:31:18', '2024-12-08 13:31:18'),
(56, 56, 'Steve', NULL, 'De la Vega', NULL, 18, '+639230858856', '2024-12-08 13:31:18', '2024-12-08 13:31:18'),
(57, 57, 'Kobe', 'Elmira', 'Santos', NULL, 14, '+639945532275', '2024-12-08 13:31:18', '2024-12-08 13:31:18'),
(58, 58, 'Vivianne', 'Jordan', 'Bacani', 'Jr.', 14, '+639436489577', '2024-12-08 13:31:18', '2024-12-08 13:31:18'),
(59, 59, 'Candace', 'Dejah', 'Villanueva', 'Jr.', 9, '+639913411173', '2024-12-08 13:31:18', '2024-12-08 13:31:18'),
(60, 60, 'Delpha', 'Rylan', 'Martelino', 'III', 3, '+639228054752', '2024-12-08 13:31:18', '2024-12-08 13:31:18'),
(61, 61, 'Salvatore', 'Henry', 'Zaragoza', 'Sr.', 17, '+639116893990', '2024-12-08 13:31:18', '2024-12-08 13:31:18'),
(62, 62, 'Twila', 'Tristian', 'Alvarez', NULL, 1, '+639902978976', '2024-12-08 13:31:18', '2024-12-08 13:31:18'),
(63, 63, 'Ezra', NULL, 'Cabigon', NULL, 12, '+639009826190', '2024-12-08 13:31:18', '2024-12-08 13:31:18'),
(64, 64, 'Glenda', 'Johann', 'Villanueva', NULL, 18, '+639202416902', '2024-12-08 13:31:18', '2024-12-08 13:31:18'),
(65, 65, 'Wilhelm', 'Joan', 'Santos', 'Jr.', 3, '+639054521503', '2024-12-08 13:31:18', '2024-12-08 13:31:18'),
(66, 66, 'Elinore', 'Nellie', 'Delos Reyes', 'Jr.', 7, '+639989157143', '2024-12-08 13:31:18', '2024-12-08 13:31:18'),
(67, 67, 'Glen', 'Silas', 'Salinas', NULL, 13, '+639122823828', '2024-12-08 13:31:19', '2024-12-08 13:31:19'),
(68, 68, 'Arno', NULL, 'Flores', 'Sr.', 6, '+639957122905', '2024-12-08 13:31:19', '2024-12-08 13:31:19'),
(69, 69, 'Jackson', 'Eugene', 'Garcia', 'Sr.', 6, '+639517076116', '2024-12-08 13:31:19', '2024-12-08 13:31:19'),
(70, 70, 'Cullen', NULL, 'Arroyo', 'Jr.', 4, '+639902869885', '2024-12-08 13:31:19', '2024-12-08 13:31:19'),
(71, 71, 'Sonya', 'Paula', 'Zaragoza', 'Jr.', 4, '+639569182979', '2024-12-08 13:31:19', '2024-12-08 13:31:19'),
(72, 72, 'Xander', 'Keith', 'Gumabay', 'III', 8, '+639753010588', '2024-12-08 13:31:19', '2024-12-08 13:31:19'),
(73, 73, 'Kay', NULL, 'Cruzado', 'III', 5, '+639183045007', '2024-12-08 13:31:19', '2024-12-08 13:31:19'),
(74, 74, 'Karelle', NULL, 'Cabarroguis', 'Jr.', 5, '+639601976505', '2024-12-08 13:31:19', '2024-12-08 13:31:19'),
(75, 75, 'Ronny', 'Christa', 'López', 'Jr.', 18, '+639078084503', '2024-12-08 13:31:19', '2024-12-08 13:31:19'),
(76, 76, 'Marley', 'Edison', 'Alvarez', NULL, 2, '+639449509009', '2024-12-08 13:31:20', '2024-12-08 13:31:20'),
(77, 77, 'Aurelie', NULL, 'Nieves', 'Jr.', 6, '+639350111068', '2024-12-08 13:31:21', '2024-12-08 13:31:21'),
(78, 78, 'Johan', 'Sylvester', 'Pineda', NULL, 5, '+639759123594', '2024-12-08 13:31:21', '2024-12-08 13:31:21'),
(79, 79, 'Rhett', NULL, 'Tonio', 'Jr.', 8, '+639291138629', '2024-12-08 13:31:21', '2024-12-08 13:31:21'),
(80, 80, 'Garret', 'Assunta', 'Villafuerte', 'Jr.', 10, '+639588558756', '2024-12-08 13:31:21', '2024-12-08 13:31:21'),
(81, 81, 'Dejah', 'Jose', 'De la Vega', NULL, 18, '+639794012045', '2024-12-08 13:31:21', '2024-12-08 13:31:21'),
(82, 82, 'Delia', 'Rachel', 'De Guzman', 'Jr.', 10, '+639854751159', '2024-12-08 13:31:21', '2024-12-08 13:31:21'),
(83, 83, 'Felipa', 'Blair', 'Magsaysay', 'III', 13, '+639084560143', '2024-12-08 13:31:21', '2024-12-08 13:31:21'),
(84, 84, 'Aubrey', 'Kay', 'Cruzado', 'Sr.', 2, '+639935496574', '2024-12-08 13:31:21', '2024-12-08 13:31:21'),
(85, 85, 'Akeem', NULL, 'Morales', 'Sr.', 14, '+639114282114', '2024-12-08 13:31:21', '2024-12-08 13:31:21'),
(86, 86, 'Eliezer', NULL, 'Ramos', 'Sr.', 5, '+639555167139', '2024-12-08 13:31:21', '2024-12-08 13:31:21'),
(87, 87, 'Daren', 'Mona', 'Salvador', 'III', 3, '+639668889090', '2024-12-08 13:31:21', '2024-12-08 13:31:21'),
(88, 88, 'Damon', NULL, 'Castillo', 'Sr.', 9, '+639890694321', '2024-12-08 13:31:21', '2024-12-08 13:31:21'),
(89, 89, 'Carissa', 'Cara', 'Riviera', NULL, 13, '+639383086612', '2024-12-08 13:31:21', '2024-12-08 13:31:21'),
(90, 90, 'Elmo', NULL, 'De la Rosa', 'III', 3, '+639876572620', '2024-12-08 13:31:22', '2024-12-08 13:31:22'),
(91, 91, 'Eli', 'Cole', 'Cruz', 'III', 13, '+639688000403', '2024-12-08 13:31:22', '2024-12-08 13:31:22'),
(92, 92, 'Vernice', 'Kyra', 'Dela Cruz', 'Sr.', 7, '+639738325526', '2024-12-08 13:31:22', '2024-12-08 13:31:22'),
(93, 93, 'Etha', 'Waldo', 'Gumabay', NULL, 1, '+639099193817', '2024-12-08 13:31:22', '2024-12-08 13:31:22'),
(94, 94, 'Athena', NULL, 'Alcaraz', NULL, 4, '+639245009699', '2024-12-08 13:31:22', '2024-12-08 13:31:22'),
(95, 95, 'Samanta', 'Elza', 'López', NULL, 8, '+639538917923', '2024-12-08 13:31:22', '2024-12-08 13:31:22'),
(96, 96, 'Isabelle', NULL, 'Gumabay', 'Sr.', 14, '+639461306604', '2024-12-08 13:31:22', '2024-12-08 13:31:22'),
(97, 97, 'Rod', 'Chanelle', 'Nieves', NULL, 14, '+639678897827', '2024-12-08 13:31:22', '2024-12-08 13:31:22'),
(98, 98, 'Jessie', NULL, 'Aquino', 'Jr.', 16, '+639877227759', '2024-12-08 13:31:22', '2024-12-08 13:31:22'),
(99, 99, 'Donna', NULL, 'Cabigon', NULL, 16, '+639607528325', '2024-12-08 13:31:22', '2024-12-08 13:31:22'),
(100, 100, 'Noble', NULL, 'Santiago', NULL, 6, '+639706200426', '2024-12-08 13:31:22', '2024-12-08 13:31:22'),
(101, 101, 'Ephraim', NULL, 'Riviera', 'Jr.', 5, '+639659508445', '2024-12-08 13:31:22', '2024-12-08 13:31:22'),
(102, 102, 'Fae', 'Rogelio', 'Misa', 'III', 17, '+639114698686', '2024-12-08 13:31:23', '2024-12-08 13:31:23'),
(103, 103, 'Daphnee', NULL, 'Martinez', 'Sr.', 1, '+639090571459', '2024-12-08 13:31:23', '2024-12-08 13:31:23'),
(104, 104, 'Jena', NULL, 'Cruzado', 'Sr.', 15, '+639929516425', '2024-12-08 13:31:23', '2024-12-08 13:31:23'),
(105, 105, 'Jasen', NULL, 'Bañez', 'Jr.', 4, '+639229074994', '2024-12-08 13:31:23', '2024-12-08 13:31:23'),
(106, 106, 'Jerome', 'Clifton', 'López', 'Jr.', 9, '+639151391228', '2024-12-08 13:31:23', '2024-12-08 13:31:23'),
(107, 107, 'Phyllis', 'Juanita', 'De Leon', 'III', 7, '+639194073020', '2024-12-08 13:31:23', '2024-12-08 13:31:23'),
(108, 108, 'Ryley', NULL, 'Palomares', 'Jr.', 13, '+639182757525', '2024-12-08 13:31:23', '2024-12-08 13:31:23'),
(109, 109, 'Alverta', NULL, 'Cruz', NULL, 13, '+639557617340', '2024-12-08 13:31:23', '2024-12-08 13:31:23'),
(110, 110, 'Ellie', NULL, 'Martelino', NULL, 3, '+639255996036', '2024-12-08 13:31:23', '2024-12-08 13:31:23'),
(111, 111, 'Adrain', NULL, 'De Jesus', 'Jr.', 15, '+639823550378', '2024-12-08 13:31:23', '2024-12-08 13:31:23'),
(112, 112, 'Greta', NULL, 'Cortez', 'III', 1, '+639203574365', '2024-12-08 13:31:23', '2024-12-08 13:31:23'),
(113, 113, 'Linnie', 'Tom', 'Reyes', 'Jr.', 3, '+639831407100', '2024-12-08 13:31:23', '2024-12-08 13:31:23'),
(114, 114, 'Columbus', NULL, 'Pascual', 'Sr.', 9, '+639547858738', '2024-12-08 13:31:23', '2024-12-08 13:31:23'),
(115, 115, 'Beulah', NULL, 'Lacuna', 'Sr.', 8, '+639297331443', '2024-12-08 13:31:24', '2024-12-08 13:31:24'),
(116, 116, 'Herbert', NULL, 'Manalo', 'Sr.', 9, '+639251245387', '2024-12-08 13:31:24', '2024-12-08 13:31:24'),
(117, 117, 'Ashlee', NULL, 'Chua', 'Jr.', 16, '+639855997988', '2024-12-08 13:31:24', '2024-12-08 13:31:24'),
(118, 118, 'Maya', NULL, 'Misa', 'III', 2, '+639839886881', '2024-12-08 13:31:24', '2024-12-08 13:31:24'),
(119, 119, 'Giles', NULL, 'Soriano', NULL, 15, '+639586638273', '2024-12-08 13:31:24', '2024-12-08 13:31:24'),
(120, 120, 'Lauriane', NULL, 'Delos Reyes', 'Jr.', 6, '+639626845480', '2024-12-08 13:31:24', '2024-12-08 13:31:24'),
(121, 121, 'Kelley', NULL, 'Vera', 'Jr.', 17, '+639382280237', '2024-12-08 13:31:24', '2024-12-08 13:31:24'),
(122, 122, 'Bartholome', 'Gloria', 'Torres', 'III', 4, '+639050094948', '2024-12-08 13:31:24', '2024-12-08 13:31:24'),
(123, 123, 'Kristina', NULL, 'Palomares', 'III', 6, '+639572699564', '2024-12-08 13:31:25', '2024-12-08 13:31:25'),
(124, 124, 'Nat', 'Fletcher', 'Atienza', NULL, 10, '+639723408995', '2024-12-08 13:31:25', '2024-12-08 13:31:25'),
(125, 125, 'Julianne', 'Marcia', 'Cabigon', 'III', 10, '+639013084445', '2024-12-08 13:31:25', '2024-12-08 13:31:25'),
(126, 126, 'Humberto', 'Stanley', 'De Vera', 'Sr.', 8, '+639142345017', '2024-12-08 13:31:25', '2024-12-08 13:31:25'),
(127, 127, 'Dawson', 'Isom', 'San Vicente', 'III', 9, '+639868758103', '2024-12-08 13:31:25', '2024-12-08 13:31:25'),
(128, 128, 'Rory', 'Tania', 'Bacani', 'III', 12, '+639758533188', '2024-12-08 13:31:25', '2024-12-08 13:31:25'),
(129, 129, 'Wilfredo', 'Billie', 'Bañez', 'III', 4, '+639679389508', '2024-12-08 13:31:25', '2024-12-08 13:31:25'),
(130, 130, 'Tom', 'Justine', 'Alcaraz', 'Jr.', 16, '+639550376185', '2024-12-08 13:31:25', '2024-12-08 13:31:25'),
(131, 131, 'Jameson', 'Jazmyne', 'Castillo', NULL, 2, '+639548530748', '2024-12-08 13:31:25', '2024-12-08 13:31:25'),
(132, 132, 'Wilfredo', NULL, 'Alvarez', 'Jr.', 5, '+639089742422', '2024-12-08 13:31:25', '2024-12-08 13:31:25'),
(133, 133, 'Isabel', 'Gisselle', 'Dela Cruz', NULL, 5, '+639674459892', '2024-12-08 13:31:25', '2024-12-08 13:31:25'),
(134, 134, 'Keon', NULL, 'Soriano', 'Sr.', 10, '+639376326106', '2024-12-08 13:31:26', '2024-12-08 13:31:26'),
(135, 135, 'Doris', 'Jaeden', 'Esteban', 'Jr.', 18, '+639538547994', '2024-12-08 13:31:26', '2024-12-08 13:31:26'),
(136, 136, 'Stevie', NULL, 'Flores', 'Sr.', 8, '+639539244451', '2024-12-08 13:31:26', '2024-12-08 13:31:26'),
(137, 137, 'Thurman', NULL, 'Villafuerte', 'Sr.', 18, '+639239229504', '2024-12-08 13:31:26', '2024-12-08 13:31:26'),
(138, 138, 'Maureen', 'Norris', 'Pascual', 'Jr.', 1, '+639116477307', '2024-12-08 13:31:26', '2024-12-08 13:31:26'),
(139, 139, 'Helga', NULL, 'Suarez', NULL, 12, '+639886203734', '2024-12-08 13:31:26', '2024-12-08 13:31:26'),
(140, 140, 'Emily', 'Guiseppe', 'Dela Cruz', 'Sr.', 2, '+639992237422', '2024-12-08 13:31:26', '2024-12-08 13:31:26'),
(141, 141, 'Dovie', 'Brenden', 'Salvador', NULL, 4, '+639193276867', '2024-12-08 13:31:26', '2024-12-08 13:31:26'),
(142, 142, 'Travon', NULL, 'Garcia', 'Sr.', 16, '+639449987594', '2024-12-08 13:31:26', '2024-12-08 13:31:26'),
(143, 143, 'Lane', 'Enrico', 'Riviera', 'III', 17, '+639520255879', '2024-12-08 13:31:28', '2024-12-08 13:31:28'),
(144, 144, 'Osvaldo', NULL, 'Reyes', 'Jr.', 14, '+639774991812', '2024-12-08 13:31:28', '2024-12-08 13:31:28'),
(145, 145, 'Ova', 'Allene', 'Alvarado', 'Jr.', 8, '+639563605873', '2024-12-08 13:31:28', '2024-12-08 13:31:28'),
(146, 146, 'Edyth', 'Jesse', 'Garcia', 'Jr.', 1, '+639965301092', '2024-12-08 13:31:28', '2024-12-08 13:31:28'),
(147, 147, 'Burnice', NULL, 'Villanueva', 'Sr.', 10, '+639595188725', '2024-12-08 13:31:28', '2024-12-08 13:31:28'),
(148, 148, 'Eloise', NULL, 'Vera', 'III', 13, '+639197066452', '2024-12-08 13:31:28', '2024-12-08 13:31:28'),
(149, 149, 'Lessie', NULL, 'De Guzman', 'Jr.', 16, '+639950267242', '2024-12-08 13:31:28', '2024-12-08 13:31:28'),
(150, 150, 'Arne', NULL, 'Mendoza', 'Jr.', 15, '+639698928258', '2024-12-08 13:31:28', '2024-12-08 13:31:28'),
(151, 151, 'Cordie', NULL, 'Ramos', 'Sr.', 17, '+639924841850', '2024-12-08 13:31:28', '2024-12-08 13:31:28'),
(152, 152, 'Mavis', NULL, 'San Vicente', 'III', 17, '+639822417183', '2024-12-08 13:31:28', '2024-12-08 13:31:28'),
(153, 153, 'Audreanne', NULL, 'De Leon', 'Jr.', 4, '+639462042775', '2024-12-08 13:31:28', '2024-12-08 13:31:28'),
(154, 154, 'Unique', NULL, 'Ramos', 'Sr.', 9, '+639341315505', '2024-12-08 13:31:28', '2024-12-08 13:31:28'),
(155, 155, 'Colt', NULL, 'Rosales', 'Jr.', 12, '+639387581289', '2024-12-08 13:31:28', '2024-12-08 13:31:28'),
(156, 156, 'Isidro', NULL, 'San Vicente', 'III', 17, '+639458459997', '2024-12-08 13:31:28', '2024-12-08 13:31:28'),
(157, 157, 'Chanel', NULL, 'Manalo', 'Sr.', 10, '+639195102792', '2024-12-08 13:31:28', '2024-12-08 13:31:28'),
(158, 158, 'Eldridge', 'Jameson', 'De Ocampo', 'Jr.', 9, '+639074988491', '2024-12-08 13:31:28', '2024-12-08 13:31:28'),
(159, 159, 'Clay', 'Pink', 'Delos Reyes', 'III', 6, '+639465791751', '2024-12-08 13:31:28', '2024-12-08 13:31:28'),
(160, 160, 'Julius', 'Nathaniel', 'Chua', 'III', 18, '+639783600851', '2024-12-08 13:31:28', '2024-12-08 13:31:28'),
(161, 161, 'Stuart', NULL, 'Suarez', 'III', 6, '+639196410490', '2024-12-08 13:31:28', '2024-12-08 13:31:28'),
(162, 162, 'Verda', 'Kylee', 'Alvarado', 'Jr.', 3, '+639013337970', '2024-12-08 13:31:29', '2024-12-08 13:31:29'),
(163, 163, 'Celestino', 'Izabella', 'Natividad', 'III', 18, '+639610142880', '2024-12-08 13:31:29', '2024-12-08 13:31:29'),
(164, 164, 'Ericka', 'Mittie', 'Villafuerte', 'Jr.', 16, '+639941542396', '2024-12-08 13:31:29', '2024-12-08 13:31:29'),
(165, 165, 'Ethan', NULL, 'Labrador', NULL, 13, '+639404615347', '2024-12-08 13:31:29', '2024-12-08 13:31:29'),
(166, 166, 'Salvatore', NULL, 'Garcia', 'III', 6, '+639207444400', '2024-12-08 13:31:29', '2024-12-08 13:31:29'),
(167, 167, 'Vern', 'Elijah', 'Ramos', NULL, 17, '+639978613049', '2024-12-08 13:31:29', '2024-12-08 13:31:29'),
(168, 168, 'Shanny', 'Haylee', 'Salvador', NULL, 5, '+639130537762', '2024-12-08 13:31:29', '2024-12-08 13:31:29'),
(169, 169, 'Harmon', NULL, 'Cabrera', 'Sr.', 12, '+639508392187', '2024-12-08 13:31:29', '2024-12-08 13:31:29'),
(170, 170, 'Kylee', 'Willa', 'López', 'Jr.', 15, '+639619298955', '2024-12-08 13:31:29', '2024-12-08 13:31:29'),
(171, 171, 'Glen', 'Pablo', 'De Jesus', 'Jr.', 9, '+639756546392', '2024-12-08 13:31:29', '2024-12-08 13:31:29'),
(172, 172, 'Raegan', NULL, 'Esteban', 'Sr.', 4, '+639748719387', '2024-12-08 13:31:29', '2024-12-08 13:31:29'),
(173, 173, 'Braden', NULL, 'Suarez', NULL, 18, '+639602289978', '2024-12-08 13:31:29', '2024-12-08 13:31:29'),
(174, 174, 'Jadon', 'Giles', 'Macapagal', 'Sr.', 15, '+639759532359', '2024-12-08 13:31:29', '2024-12-08 13:31:29'),
(175, 175, 'Sierra', NULL, 'San Pedro', 'Jr.', 2, '+639240253999', '2024-12-08 13:31:29', '2024-12-08 13:31:29'),
(176, 176, 'Alfonso', NULL, 'Ocampo', 'Sr.', 14, '+639303277250', '2024-12-08 13:31:29', '2024-12-08 13:31:29'),
(177, 177, 'Trevion', NULL, 'Chua', 'III', 16, '+639505536050', '2024-12-08 13:31:30', '2024-12-08 13:31:30'),
(178, 178, 'Zora', 'Jonathan', 'Bacani', 'Jr.', 14, '+639433177315', '2024-12-08 13:31:30', '2024-12-08 13:31:30'),
(179, 179, 'Aliyah', NULL, 'Tonio', NULL, 4, '+639920388354', '2024-12-08 13:31:30', '2024-12-08 13:31:30'),
(180, 180, 'Louvenia', NULL, 'Cruzado', NULL, 10, '+639466720285', '2024-12-08 13:31:30', '2024-12-08 13:31:30'),
(181, 181, 'Aliyah', NULL, 'De Leon', 'Sr.', 14, '+639315917840', '2024-12-08 13:31:30', '2024-12-08 13:31:30'),
(182, 182, 'Reanna', NULL, 'Cabrera', 'Jr.', 9, '+639596472274', '2024-12-08 13:31:31', '2024-12-08 13:31:31'),
(183, 183, 'Fiona', 'Loyce', 'Flores', 'Sr.', 17, '+639700278729', '2024-12-08 13:31:31', '2024-12-08 13:31:31'),
(184, 184, 'Alvah', NULL, 'Pascual', 'Jr.', 17, '+639407737834', '2024-12-08 13:31:31', '2024-12-08 13:31:31'),
(185, 185, 'Alfred', 'Pasquale', 'Cruz', 'Jr.', 18, '+639856246714', '2024-12-08 13:31:31', '2024-12-08 13:31:31'),
(186, 186, 'Adrianna', 'Chanelle', 'Vera', 'III', 16, '+639405125753', '2024-12-08 13:31:31', '2024-12-08 13:31:31'),
(187, 187, 'Mariana', 'Lily', 'De Ocampo', 'Sr.', 4, '+639538087217', '2024-12-08 13:31:31', '2024-12-08 13:31:31'),
(188, 188, 'Mittie', NULL, 'Velasquez', 'Sr.', 4, '+639246386209', '2024-12-08 13:31:31', '2024-12-08 13:31:31'),
(189, 189, 'Abagail', 'Eloy', 'Macapagal', 'Jr.', 18, '+639992041106', '2024-12-08 13:31:31', '2024-12-08 13:31:31'),
(190, 190, 'Willis', 'Jan', 'Cruzado', NULL, 5, '+639807994142', '2024-12-08 13:31:31', '2024-12-08 13:31:31'),
(191, 191, 'Ryann', 'Dario', 'Rosales', 'Sr.', 14, '+639382496592', '2024-12-08 13:31:31', '2024-12-08 13:31:31'),
(192, 192, 'Cassandra', 'Annamae', 'Riviera', 'Jr.', 5, '+639250857174', '2024-12-08 13:31:31', '2024-12-08 13:31:31'),
(193, 193, 'Caterina', NULL, 'Valenzuela', NULL, 3, '+639698821607', '2024-12-08 13:31:31', '2024-12-08 13:31:31'),
(194, 194, 'Sierra', 'Ayana', 'Santiago', 'Jr.', 4, '+639514261353', '2024-12-08 13:31:31', '2024-12-08 13:31:31'),
(195, 195, 'Dominic', 'Alisa', 'San Pedro', NULL, 4, '+639459391121', '2024-12-08 13:31:32', '2024-12-08 13:31:32'),
(196, 196, 'Elvera', 'Yasmine', 'Tonio', 'Jr.', 10, '+639460788917', '2024-12-08 13:31:32', '2024-12-08 13:31:32'),
(197, 197, 'Edna', 'Amara', 'De la Vega', 'Sr.', 16, '+639345094783', '2024-12-08 13:31:32', '2024-12-08 13:31:32'),
(198, 198, 'Kaylin', 'Chad', 'Suarez', 'Jr.', 14, '+639891654871', '2024-12-08 13:31:32', '2024-12-08 13:31:32'),
(199, 199, 'Bo', NULL, 'Mendoza', 'Sr.', 14, '+639851896905', '2024-12-08 13:31:32', '2024-12-08 13:31:32'),
(200, 200, 'Annie', NULL, 'Villafuerte', NULL, 15, '+639211895794', '2024-12-08 13:31:32', '2024-12-08 13:31:32');

-- --------------------------------------------------------

--
-- Table structure for table `senior_login_attempts`
--

CREATE TABLE `senior_login_attempts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `status` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
-- Table structure for table `sex_list`
--

CREATE TABLE `sex_list` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `sex` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sex_list`
--

INSERT INTO `sex_list` (`id`, `sex`, `created_at`, `updated_at`) VALUES
(1, 'Male', NULL, NULL),
(2, 'Female', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `source`
--

CREATE TABLE `source` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `senior_id` bigint(20) UNSIGNED DEFAULT NULL,
  `source_id` bigint(20) UNSIGNED DEFAULT NULL,
  `other_source_remark` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `source`
--

INSERT INTO `source` (`id`, `senior_id`, `source_id`, `other_source_remark`, `created_at`, `updated_at`) VALUES
(1, 2, 2, NULL, '2024-12-08 13:33:39', '2024-12-08 13:33:39'),
(2, 2, 4, 'Pag-IBIG Fund (Home Development Mutual Fund)', '2024-12-08 13:33:39', '2024-12-08 13:33:39'),
(3, 3, 3, NULL, '2024-12-08 13:33:40', '2024-12-08 13:33:40'),
(4, 3, 2, NULL, '2024-12-08 13:33:40', '2024-12-08 13:33:40'),
(5, 3, 1, NULL, '2024-12-08 13:33:40', '2024-12-08 13:33:40'),
(6, 4, 4, 'Private Company Pension Plans', '2024-12-08 13:33:40', '2024-12-08 13:33:40'),
(7, 5, 3, NULL, '2024-12-08 13:33:40', '2024-12-08 13:33:40'),
(8, 5, 2, NULL, '2024-12-08 13:33:40', '2024-12-08 13:33:40'),
(9, 8, 1, NULL, '2024-12-08 13:33:40', '2024-12-08 13:33:40'),
(10, 8, 3, NULL, '2024-12-08 13:33:40', '2024-12-08 13:33:40'),
(11, 10, 3, NULL, '2024-12-08 13:33:41', '2024-12-08 13:33:41'),
(12, 10, 1, NULL, '2024-12-08 13:33:42', '2024-12-08 13:33:42'),
(13, 10, 4, 'Mutual Aid or Cooperative Pensions', '2024-12-08 13:33:44', '2024-12-08 13:33:44'),
(14, 11, 1, NULL, '2024-12-08 13:33:45', '2024-12-08 13:33:45'),
(15, 13, 3, NULL, '2024-12-08 13:33:46', '2024-12-08 13:33:46'),
(16, 13, 1, NULL, '2024-12-08 13:33:46', '2024-12-08 13:33:46'),
(17, 17, 1, NULL, '2024-12-08 13:33:46', '2024-12-08 13:33:46'),
(18, 17, 4, 'Private Company Pension Plans', '2024-12-08 13:33:47', '2024-12-08 13:33:47'),
(19, 18, 2, NULL, '2024-12-08 13:33:47', '2024-12-08 13:33:47'),
(20, 20, 2, NULL, '2024-12-08 13:33:47', '2024-12-08 13:33:47'),
(21, 20, 1, NULL, '2024-12-08 13:33:47', '2024-12-08 13:33:47'),
(22, 25, 1, NULL, '2024-12-08 13:33:47', '2024-12-08 13:33:47'),
(23, 26, 2, NULL, '2024-12-08 13:33:48', '2024-12-08 13:33:48'),
(24, 26, 1, NULL, '2024-12-08 13:33:48', '2024-12-08 13:33:48'),
(25, 26, 4, 'Overseas Workers Welfare Administration (OWWA)', '2024-12-08 13:33:48', '2024-12-08 13:33:48'),
(26, 27, 1, NULL, '2024-12-08 13:33:48', '2024-12-08 13:33:48'),
(27, 27, 3, NULL, '2024-12-08 13:33:48', '2024-12-08 13:33:48'),
(28, 27, 2, NULL, '2024-12-08 13:33:48', '2024-12-08 13:33:48'),
(29, 31, 2, NULL, '2024-12-08 13:33:49', '2024-12-08 13:33:49'),
(30, 31, 1, NULL, '2024-12-08 13:33:49', '2024-12-08 13:33:49'),
(31, 33, 4, 'Philippine Veterans Affairs Office (PVAO)', '2024-12-08 13:33:49', '2024-12-08 13:33:49'),
(32, 33, 1, NULL, '2024-12-08 13:33:49', '2024-12-08 13:33:49'),
(33, 33, 2, NULL, '2024-12-08 13:33:49', '2024-12-08 13:33:49'),
(34, 34, 2, NULL, '2024-12-08 13:33:49', '2024-12-08 13:33:49'),
(35, 35, 4, 'Overseas Workers Welfare Administration (OWWA)', '2024-12-08 13:33:50', '2024-12-08 13:33:50'),
(36, 35, 3, NULL, '2024-12-08 13:33:50', '2024-12-08 13:33:50'),
(37, 37, 1, NULL, '2024-12-08 13:33:50', '2024-12-08 13:33:50'),
(38, 38, 4, 'Private Company Pension Plans', '2024-12-08 13:33:50', '2024-12-08 13:33:50'),
(39, 38, 2, NULL, '2024-12-08 13:33:51', '2024-12-08 13:33:51'),
(40, 40, 2, NULL, '2024-12-08 13:33:51', '2024-12-08 13:33:51'),
(41, 41, 1, NULL, '2024-12-08 13:33:51', '2024-12-08 13:33:51'),
(42, 43, 2, NULL, '2024-12-08 13:33:51', '2024-12-08 13:33:51'),
(43, 45, 4, 'Philippine Veterans Affairs Office (PVAO)', '2024-12-08 13:33:51', '2024-12-08 13:33:51'),
(44, 45, 1, NULL, '2024-12-08 13:33:51', '2024-12-08 13:33:51'),
(45, 45, 2, NULL, '2024-12-08 13:33:51', '2024-12-08 13:33:51'),
(46, 47, 2, NULL, '2024-12-08 13:33:51', '2024-12-08 13:33:51'),
(47, 51, 1, NULL, '2024-12-08 13:33:52', '2024-12-08 13:33:52'),
(48, 52, 2, NULL, '2024-12-08 13:33:52', '2024-12-08 13:33:52'),
(49, 54, 2, NULL, '2024-12-08 13:33:52', '2024-12-08 13:33:52'),
(50, 55, 3, NULL, '2024-12-08 13:33:52', '2024-12-08 13:33:52'),
(51, 55, 4, 'Philippine Veterans Affairs Office (PVAO)', '2024-12-08 13:33:52', '2024-12-08 13:33:52'),
(52, 55, 2, NULL, '2024-12-08 13:33:52', '2024-12-08 13:33:52'),
(53, 56, 3, NULL, '2024-12-08 13:33:52', '2024-12-08 13:33:52'),
(54, 56, 4, 'Private Company Pension Plans', '2024-12-08 13:33:53', '2024-12-08 13:33:53'),
(55, 60, 2, NULL, '2024-12-08 13:33:53', '2024-12-08 13:33:53'),
(56, 60, 4, 'Philippine Veterans Affairs Office (PVAO)', '2024-12-08 13:33:53', '2024-12-08 13:33:53'),
(57, 60, 3, NULL, '2024-12-08 13:33:53', '2024-12-08 13:33:53'),
(58, 63, 3, NULL, '2024-12-08 13:33:53', '2024-12-08 13:33:53'),
(59, 64, 1, NULL, '2024-12-08 13:33:53', '2024-12-08 13:33:53'),
(60, 64, 2, NULL, '2024-12-08 13:33:53', '2024-12-08 13:33:53'),
(61, 70, 4, 'Private Company Pension Plans', '2024-12-08 13:33:54', '2024-12-08 13:33:54'),
(62, 70, 1, NULL, '2024-12-08 13:33:54', '2024-12-08 13:33:54'),
(63, 72, 1, NULL, '2024-12-08 13:33:54', '2024-12-08 13:33:54'),
(64, 73, 3, NULL, '2024-12-08 13:33:54', '2024-12-08 13:33:54'),
(65, 76, 4, 'Overseas Workers Welfare Administration (OWWA)', '2024-12-08 13:33:54', '2024-12-08 13:33:54'),
(66, 76, 2, NULL, '2024-12-08 13:33:54', '2024-12-08 13:33:54'),
(67, 76, 1, NULL, '2024-12-08 13:33:54', '2024-12-08 13:33:54'),
(68, 77, 3, NULL, '2024-12-08 13:33:54', '2024-12-08 13:33:54'),
(69, 78, 2, NULL, '2024-12-08 13:33:54', '2024-12-08 13:33:54'),
(70, 78, 1, NULL, '2024-12-08 13:33:55', '2024-12-08 13:33:55'),
(71, 79, 4, 'Overseas Workers Welfare Administration (OWWA)', '2024-12-08 13:33:55', '2024-12-08 13:33:55'),
(72, 79, 2, NULL, '2024-12-08 13:33:55', '2024-12-08 13:33:55'),
(73, 80, 2, NULL, '2024-12-08 13:33:55', '2024-12-08 13:33:55'),
(74, 80, 3, NULL, '2024-12-08 13:33:56', '2024-12-08 13:33:56'),
(75, 86, 1, NULL, '2024-12-08 13:33:56', '2024-12-08 13:33:56'),
(76, 88, 3, NULL, '2024-12-08 13:33:56', '2024-12-08 13:33:56'),
(77, 88, 4, 'Philippine Veterans Affairs Office (PVAO)', '2024-12-08 13:33:56', '2024-12-08 13:33:56'),
(78, 88, 1, NULL, '2024-12-08 13:33:56', '2024-12-08 13:33:56'),
(79, 96, 4, 'Overseas Workers Welfare Administration (OWWA)', '2024-12-08 13:33:56', '2024-12-08 13:33:56'),
(80, 96, 1, NULL, '2024-12-08 13:33:56', '2024-12-08 13:33:56'),
(81, 98, 3, NULL, '2024-12-08 13:33:57', '2024-12-08 13:33:57'),
(82, 98, 2, NULL, '2024-12-08 13:33:57', '2024-12-08 13:33:57'),
(83, 98, 1, NULL, '2024-12-08 13:33:57', '2024-12-08 13:33:57'),
(84, 99, 4, 'Pag-IBIG Fund (Home Development Mutual Fund)', '2024-12-08 13:33:57', '2024-12-08 13:33:57'),
(85, 99, 3, NULL, '2024-12-08 13:33:57', '2024-12-08 13:33:57'),
(86, 99, 2, NULL, '2024-12-08 13:33:57', '2024-12-08 13:33:57'),
(87, 102, 4, 'Mutual Aid or Cooperative Pensions', '2024-12-08 13:33:57', '2024-12-08 13:33:57'),
(88, 104, 3, NULL, '2024-12-08 13:33:57', '2024-12-08 13:33:57'),
(89, 104, 4, 'Private Company Pension Plans', '2024-12-08 13:33:58', '2024-12-08 13:33:58'),
(90, 107, 3, NULL, '2024-12-08 13:33:58', '2024-12-08 13:33:58'),
(91, 107, 2, NULL, '2024-12-08 13:33:58', '2024-12-08 13:33:58'),
(92, 107, 1, NULL, '2024-12-08 13:33:58', '2024-12-08 13:33:58'),
(93, 111, 3, NULL, '2024-12-08 13:33:58', '2024-12-08 13:33:58'),
(94, 112, 4, 'Philippine Veterans Affairs Office (PVAO)', '2024-12-08 13:33:58', '2024-12-08 13:33:58'),
(95, 112, 1, NULL, '2024-12-08 13:33:58', '2024-12-08 13:33:58'),
(96, 112, 3, NULL, '2024-12-08 13:33:59', '2024-12-08 13:33:59'),
(97, 113, 3, NULL, '2024-12-08 13:33:59', '2024-12-08 13:33:59'),
(98, 115, 4, 'Private Company Pension Plans', '2024-12-08 13:33:59', '2024-12-08 13:33:59'),
(99, 115, 2, NULL, '2024-12-08 13:33:59', '2024-12-08 13:33:59'),
(100, 119, 1, NULL, '2024-12-08 13:33:59', '2024-12-08 13:33:59'),
(101, 119, 3, NULL, '2024-12-08 13:33:59', '2024-12-08 13:33:59'),
(102, 120, 4, 'Mutual Aid or Cooperative Pensions', '2024-12-08 13:33:59', '2024-12-08 13:33:59'),
(103, 120, 2, NULL, '2024-12-08 13:33:59', '2024-12-08 13:33:59'),
(104, 120, 1, NULL, '2024-12-08 13:33:59', '2024-12-08 13:33:59'),
(105, 122, 3, NULL, '2024-12-08 13:34:00', '2024-12-08 13:34:00'),
(106, 122, 2, NULL, '2024-12-08 13:34:00', '2024-12-08 13:34:00'),
(107, 123, 4, 'Pag-IBIG Fund (Home Development Mutual Fund)', '2024-12-08 13:34:00', '2024-12-08 13:34:00'),
(108, 123, 1, NULL, '2024-12-08 13:34:00', '2024-12-08 13:34:00'),
(109, 123, 2, NULL, '2024-12-08 13:34:00', '2024-12-08 13:34:00'),
(110, 125, 2, NULL, '2024-12-08 13:34:00', '2024-12-08 13:34:00'),
(111, 127, 4, 'Overseas Workers Welfare Administration (OWWA)', '2024-12-08 13:34:00', '2024-12-08 13:34:00'),
(112, 127, 1, NULL, '2024-12-08 13:34:00', '2024-12-08 13:34:00'),
(113, 129, 3, NULL, '2024-12-08 13:34:00', '2024-12-08 13:34:00'),
(114, 132, 2, NULL, '2024-12-08 13:34:01', '2024-12-08 13:34:01'),
(115, 132, 3, NULL, '2024-12-08 13:34:01', '2024-12-08 13:34:01'),
(116, 132, 4, 'Private Company Pension Plans', '2024-12-08 13:34:02', '2024-12-08 13:34:02'),
(117, 133, 2, NULL, '2024-12-08 13:34:02', '2024-12-08 13:34:02'),
(118, 134, 1, NULL, '2024-12-08 13:34:02', '2024-12-08 13:34:02'),
(119, 134, 2, NULL, '2024-12-08 13:34:02', '2024-12-08 13:34:02'),
(120, 136, 2, NULL, '2024-12-08 13:34:02', '2024-12-08 13:34:02'),
(121, 136, 1, NULL, '2024-12-08 13:34:02', '2024-12-08 13:34:02'),
(122, 136, 3, NULL, '2024-12-08 13:34:02', '2024-12-08 13:34:02'),
(123, 137, 3, NULL, '2024-12-08 13:34:02', '2024-12-08 13:34:02'),
(124, 137, 1, NULL, '2024-12-08 13:34:02', '2024-12-08 13:34:02'),
(125, 137, 2, NULL, '2024-12-08 13:34:02', '2024-12-08 13:34:02'),
(126, 138, 2, NULL, '2024-12-08 13:34:02', '2024-12-08 13:34:02'),
(127, 138, 4, 'Mutual Aid or Cooperative Pensions', '2024-12-08 13:34:03', '2024-12-08 13:34:03'),
(128, 138, 1, NULL, '2024-12-08 13:34:03', '2024-12-08 13:34:03'),
(129, 139, 3, NULL, '2024-12-08 13:34:03', '2024-12-08 13:34:03'),
(130, 141, 2, NULL, '2024-12-08 13:34:03', '2024-12-08 13:34:03'),
(131, 142, 2, NULL, '2024-12-08 13:34:03', '2024-12-08 13:34:03'),
(132, 142, 3, NULL, '2024-12-08 13:34:03', '2024-12-08 13:34:03'),
(133, 143, 3, NULL, '2024-12-08 13:34:03', '2024-12-08 13:34:03'),
(134, 143, 1, NULL, '2024-12-08 13:34:03', '2024-12-08 13:34:03'),
(135, 143, 2, NULL, '2024-12-08 13:34:03', '2024-12-08 13:34:03'),
(136, 146, 1, NULL, '2024-12-08 13:34:03', '2024-12-08 13:34:03'),
(137, 147, 3, NULL, '2024-12-08 13:34:03', '2024-12-08 13:34:03'),
(138, 147, 2, NULL, '2024-12-08 13:34:03', '2024-12-08 13:34:03'),
(139, 149, 4, 'Overseas Workers Welfare Administration (OWWA)', '2024-12-08 13:34:03', '2024-12-08 13:34:03'),
(140, 149, 2, NULL, '2024-12-08 13:34:04', '2024-12-08 13:34:04'),
(141, 151, 1, NULL, '2024-12-08 13:34:04', '2024-12-08 13:34:04'),
(142, 151, 4, 'Mutual Aid or Cooperative Pensions', '2024-12-08 13:34:04', '2024-12-08 13:34:04'),
(143, 151, 3, NULL, '2024-12-08 13:34:04', '2024-12-08 13:34:04'),
(144, 152, 2, NULL, '2024-12-08 13:34:04', '2024-12-08 13:34:04'),
(145, 152, 4, 'Overseas Workers Welfare Administration (OWWA)', '2024-12-08 13:34:04', '2024-12-08 13:34:04'),
(146, 152, 3, NULL, '2024-12-08 13:34:04', '2024-12-08 13:34:04'),
(147, 153, 2, NULL, '2024-12-08 13:34:04', '2024-12-08 13:34:04'),
(148, 153, 4, 'Overseas Workers Welfare Administration (OWWA)', '2024-12-08 13:34:05', '2024-12-08 13:34:05'),
(149, 153, 3, NULL, '2024-12-08 13:34:05', '2024-12-08 13:34:05'),
(150, 154, 4, 'Mutual Aid or Cooperative Pensions', '2024-12-08 13:34:05', '2024-12-08 13:34:05'),
(151, 156, 4, 'Philippine Veterans Affairs Office (PVAO)', '2024-12-08 13:34:05', '2024-12-08 13:34:05'),
(152, 156, 3, NULL, '2024-12-08 13:34:05', '2024-12-08 13:34:05'),
(153, 158, 3, NULL, '2024-12-08 13:34:05', '2024-12-08 13:34:05'),
(154, 158, 1, NULL, '2024-12-08 13:34:05', '2024-12-08 13:34:05'),
(155, 160, 2, NULL, '2024-12-08 13:34:05', '2024-12-08 13:34:05'),
(156, 160, 4, 'Mutual Aid or Cooperative Pensions', '2024-12-08 13:34:05', '2024-12-08 13:34:05'),
(157, 162, 1, NULL, '2024-12-08 13:34:06', '2024-12-08 13:34:06'),
(158, 162, 3, NULL, '2024-12-08 13:34:06', '2024-12-08 13:34:06'),
(159, 162, 2, NULL, '2024-12-08 13:34:06', '2024-12-08 13:34:06'),
(160, 164, 2, NULL, '2024-12-08 13:34:06', '2024-12-08 13:34:06'),
(161, 164, 1, NULL, '2024-12-08 13:34:06', '2024-12-08 13:34:06'),
(162, 164, 3, NULL, '2024-12-08 13:34:06', '2024-12-08 13:34:06'),
(163, 165, 3, NULL, '2024-12-08 13:34:08', '2024-12-08 13:34:08'),
(164, 166, 4, 'Mutual Aid or Cooperative Pensions', '2024-12-08 13:34:08', '2024-12-08 13:34:08'),
(165, 169, 2, NULL, '2024-12-08 13:34:08', '2024-12-08 13:34:08'),
(166, 169, 4, 'Mutual Aid or Cooperative Pensions', '2024-12-08 13:34:08', '2024-12-08 13:34:08'),
(167, 169, 1, NULL, '2024-12-08 13:34:08', '2024-12-08 13:34:08'),
(168, 170, 3, NULL, '2024-12-08 13:34:08', '2024-12-08 13:34:08'),
(169, 170, 1, NULL, '2024-12-08 13:34:09', '2024-12-08 13:34:09'),
(170, 170, 4, 'Private Company Pension Plans', '2024-12-08 13:34:09', '2024-12-08 13:34:09'),
(171, 172, 1, NULL, '2024-12-08 13:34:09', '2024-12-08 13:34:09'),
(172, 173, 3, NULL, '2024-12-08 13:34:09', '2024-12-08 13:34:09'),
(173, 173, 2, NULL, '2024-12-08 13:34:09', '2024-12-08 13:34:09'),
(174, 173, 4, 'Private Company Pension Plans', '2024-12-08 13:34:09', '2024-12-08 13:34:09'),
(175, 175, 3, NULL, '2024-12-08 13:34:09', '2024-12-08 13:34:09'),
(176, 176, 2, NULL, '2024-12-08 13:34:10', '2024-12-08 13:34:10'),
(177, 176, 3, NULL, '2024-12-08 13:34:10', '2024-12-08 13:34:10'),
(178, 177, 1, NULL, '2024-12-08 13:34:10', '2024-12-08 13:34:10'),
(179, 177, 4, 'Private Company Pension Plans', '2024-12-08 13:34:10', '2024-12-08 13:34:10'),
(180, 179, 1, NULL, '2024-12-08 13:34:10', '2024-12-08 13:34:10'),
(181, 180, 3, NULL, '2024-12-08 13:34:10', '2024-12-08 13:34:10'),
(182, 183, 1, NULL, '2024-12-08 13:34:10', '2024-12-08 13:34:10'),
(183, 183, 2, NULL, '2024-12-08 13:34:10', '2024-12-08 13:34:10'),
(184, 184, 1, NULL, '2024-12-08 13:34:10', '2024-12-08 13:34:10'),
(185, 184, 3, NULL, '2024-12-08 13:34:10', '2024-12-08 13:34:10'),
(186, 184, 4, 'Private Company Pension Plans', '2024-12-08 13:34:10', '2024-12-08 13:34:10'),
(187, 185, 4, 'Philippine Veterans Affairs Office (PVAO)', '2024-12-08 13:34:11', '2024-12-08 13:34:11'),
(188, 188, 4, 'Philippine Veterans Affairs Office (PVAO)', '2024-12-08 13:34:11', '2024-12-08 13:34:11'),
(189, 189, 1, NULL, '2024-12-08 13:34:11', '2024-12-08 13:34:11'),
(190, 189, 4, 'Pag-IBIG Fund (Home Development Mutual Fund)', '2024-12-08 13:34:11', '2024-12-08 13:34:11'),
(191, 189, 3, NULL, '2024-12-08 13:34:11', '2024-12-08 13:34:11'),
(192, 192, 2, NULL, '2024-12-08 13:34:11', '2024-12-08 13:34:11'),
(193, 192, 4, 'Overseas Workers Welfare Administration (OWWA)', '2024-12-08 13:34:11', '2024-12-08 13:34:11'),
(194, 193, 3, NULL, '2024-12-08 13:34:11', '2024-12-08 13:34:11'),
(195, 195, 2, NULL, '2024-12-08 13:34:11', '2024-12-08 13:34:11'),
(196, 195, 4, 'Overseas Workers Welfare Administration (OWWA)', '2024-12-08 13:34:11', '2024-12-08 13:34:11'),
(197, 195, 3, NULL, '2024-12-08 13:34:12', '2024-12-08 13:34:12'),
(198, 197, 2, NULL, '2024-12-08 13:34:12', '2024-12-08 13:34:12'),
(199, 197, 4, 'Private Company Pension Plans', '2024-12-08 13:34:12', '2024-12-08 13:34:12');

-- --------------------------------------------------------

--
-- Table structure for table `source_list`
--

CREATE TABLE `source_list` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `source_list` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `source_list`
--

INSERT INTO `source_list` (`id`, `source_list`, `created_at`, `updated_at`) VALUES
(1, 'GSIS', NULL, NULL),
(2, 'SSS', NULL, NULL),
(3, 'AFPSLAI', NULL, NULL),
(4, 'Others', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_type_list`
--

CREATE TABLE `user_type_list` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_type` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_type_list`
--

INSERT INTO `user_type_list` (`id`, `user_type`, `created_at`, `updated_at`) VALUES
(1, 'Senior', NULL, NULL),
(2, 'Encoder', NULL, NULL),
(3, 'Admin', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `where_income_source_list`
--

CREATE TABLE `where_income_source_list` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `where_income_source` varchar(255) NOT NULL,
  `where_income_source_examples` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `where_income_source_list`
--

INSERT INTO `where_income_source_list` (`id`, `where_income_source`, `where_income_source_examples`, `created_at`, `updated_at`) VALUES
(1, 'Business Income', '(e.g., sari-sari store, carinderia or small eatery, online selling or e-commerce)', NULL, NULL),
(2, 'Rental Income', '(e.g., renting out a house or apartment)', NULL, NULL),
(3, 'Employment Income', '(e.g., salary from a part-time job)', NULL, NULL),
(4, 'Farm or Agricultural Income', '(e.g., profits from selling crops or livestock)', NULL, NULL),
(5, 'Annuities or Private Retirement Funds', '(e.g., monthly payments from a retirement plan)', NULL, NULL),
(6, 'Others', NULL, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`),
  ADD KEY `admin_admin_user_type_id_foreign` (`admin_user_type_id`);

--
-- Indexes for table `admin_login_attempts`
--
ALTER TABLE `admin_login_attempts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `barangay_list`
--
ALTER TABLE `barangay_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `civil_status_list`
--
ALTER TABLE `civil_status_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contact_us`
--
ALTER TABLE `contact_us`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `encoder`
--
ALTER TABLE `encoder`
  ADD PRIMARY KEY (`id`),
  ADD KEY `encoder_encoder_user_type_id_foreign` (`encoder_user_type_id`),
  ADD KEY `encoder_encoder_barangay_id_foreign` (`encoder_barangay_id`);

--
-- Indexes for table `encoder_login_attempts`
--
ALTER TABLE `encoder_login_attempts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `encoder_roles`
--
ALTER TABLE `encoder_roles`
  ADD PRIMARY KEY (`id`),
  ADD KEY `encoder_roles_encoder_user_id_foreign` (`encoder_user_id`),
  ADD KEY `encoder_roles_encoder_roles_id_foreign` (`encoder_roles_id`);

--
-- Indexes for table `encoder_roles_list`
--
ALTER TABLE `encoder_roles_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `family_composition`
--
ALTER TABLE `family_composition`
  ADD PRIMARY KEY (`id`),
  ADD KEY `family_composition_senior_id_foreign` (`senior_id`),
  ADD KEY `family_composition_relative_relationship_id_foreign` (`relative_relationship_id`),
  ADD KEY `family_composition_relative_civil_status_id_foreign` (`relative_civil_status_id`);

--
-- Indexes for table `how_much_income_list`
--
ALTER TABLE `how_much_income_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `how_much_pension_list`
--
ALTER TABLE `how_much_pension_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `income_source`
--
ALTER TABLE `income_source`
  ADD PRIMARY KEY (`id`),
  ADD KEY `income_source_senior_id_foreign` (`senior_id`),
  ADD KEY `income_source_income_source_id_foreign` (`income_source_id`);

--
-- Indexes for table `living_arrangement_list`
--
ALTER TABLE `living_arrangement_list`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `pension_distribution_list`
--
ALTER TABLE `pension_distribution_list`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pension_distribution_list_barangay_id_foreign` (`barangay_id`),
  ADD KEY `pension_distribution_list_pension_user_type_id_foreign` (`pension_user_type_id`),
  ADD KEY `pension_distribution_list_pension_encoder_id_foreign` (`pension_encoder_id`),
  ADD KEY `pension_distribution_list_pension_admin_id_foreign` (`pension_admin_id`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `relationship_list`
--
ALTER TABLE `relationship_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `seniors`
--
ALTER TABLE `seniors`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `seniors_osca_id_unique` (`osca_id`),
  ADD UNIQUE KEY `seniors_ncsc_rrn_unique` (`ncsc_rrn`),
  ADD UNIQUE KEY `seniors_email_unique` (`email`),
  ADD KEY `seniors_application_status_id_foreign` (`application_status_id`),
  ADD KEY `seniors_account_status_id_foreign` (`account_status_id`),
  ADD KEY `seniors_user_type_id_foreign` (`user_type_id`),
  ADD KEY `seniors_barangay_id_foreign` (`barangay_id`),
  ADD KEY `seniors_sex_id_foreign` (`sex_id`),
  ADD KEY `seniors_civil_status_id_foreign` (`civil_status_id`),
  ADD KEY `seniors_type_of_living_arrangement_foreign` (`type_of_living_arrangement`),
  ADD KEY `seniors_if_pensioner_yes_foreign` (`if_pensioner_yes`),
  ADD KEY `seniors_if_permanent_yes_income_foreign` (`if_permanent_yes_income`),
  ADD KEY `seniors_application_assistant_id_foreign` (`application_assistant_id`),
  ADD KEY `seniors_registration_assistant_id_foreign` (`registration_assistant_id`);

--
-- Indexes for table `senior_account_status_list`
--
ALTER TABLE `senior_account_status_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `senior_application_status_list`
--
ALTER TABLE `senior_application_status_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `senior_guardian`
--
ALTER TABLE `senior_guardian`
  ADD PRIMARY KEY (`id`),
  ADD KEY `senior_guardian_senior_id_foreign` (`senior_id`),
  ADD KEY `senior_guardian_guardian_relationship_id_foreign` (`guardian_relationship_id`);

--
-- Indexes for table `senior_login_attempts`
--
ALTER TABLE `senior_login_attempts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `sex_list`
--
ALTER TABLE `sex_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `source`
--
ALTER TABLE `source`
  ADD PRIMARY KEY (`id`),
  ADD KEY `source_senior_id_foreign` (`senior_id`),
  ADD KEY `source_source_id_foreign` (`source_id`);

--
-- Indexes for table `source_list`
--
ALTER TABLE `source_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_type_list`
--
ALTER TABLE `user_type_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `where_income_source_list`
--
ALTER TABLE `where_income_source_list`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `admin_login_attempts`
--
ALTER TABLE `admin_login_attempts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `barangay_list`
--
ALTER TABLE `barangay_list`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `civil_status_list`
--
ALTER TABLE `civil_status_list`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `contact_us`
--
ALTER TABLE `contact_us`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `encoder`
--
ALTER TABLE `encoder`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `encoder_login_attempts`
--
ALTER TABLE `encoder_login_attempts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `encoder_roles`
--
ALTER TABLE `encoder_roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=232;

--
-- AUTO_INCREMENT for table `encoder_roles_list`
--
ALTER TABLE `encoder_roles_list`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `family_composition`
--
ALTER TABLE `family_composition`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=987;

--
-- AUTO_INCREMENT for table `how_much_income_list`
--
ALTER TABLE `how_much_income_list`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `how_much_pension_list`
--
ALTER TABLE `how_much_pension_list`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `income_source`
--
ALTER TABLE `income_source`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=197;

--
-- AUTO_INCREMENT for table `living_arrangement_list`
--
ALTER TABLE `living_arrangement_list`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `pension_distribution_list`
--
ALTER TABLE `pension_distribution_list`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=101;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `relationship_list`
--
ALTER TABLE `relationship_list`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `seniors`
--
ALTER TABLE `seniors`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=201;

--
-- AUTO_INCREMENT for table `senior_account_status_list`
--
ALTER TABLE `senior_account_status_list`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `senior_application_status_list`
--
ALTER TABLE `senior_application_status_list`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `senior_guardian`
--
ALTER TABLE `senior_guardian`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=201;

--
-- AUTO_INCREMENT for table `senior_login_attempts`
--
ALTER TABLE `senior_login_attempts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sex_list`
--
ALTER TABLE `sex_list`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `source`
--
ALTER TABLE `source`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=200;

--
-- AUTO_INCREMENT for table `source_list`
--
ALTER TABLE `source_list`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `user_type_list`
--
ALTER TABLE `user_type_list`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `where_income_source_list`
--
ALTER TABLE `where_income_source_list`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `admin`
--
ALTER TABLE `admin`
  ADD CONSTRAINT `admin_admin_user_type_id_foreign` FOREIGN KEY (`admin_user_type_id`) REFERENCES `user_type_list` (`id`);

--
-- Constraints for table `encoder`
--
ALTER TABLE `encoder`
  ADD CONSTRAINT `encoder_encoder_barangay_id_foreign` FOREIGN KEY (`encoder_barangay_id`) REFERENCES `barangay_list` (`id`),
  ADD CONSTRAINT `encoder_encoder_user_type_id_foreign` FOREIGN KEY (`encoder_user_type_id`) REFERENCES `user_type_list` (`id`);

--
-- Constraints for table `encoder_roles`
--
ALTER TABLE `encoder_roles`
  ADD CONSTRAINT `encoder_roles_encoder_roles_id_foreign` FOREIGN KEY (`encoder_roles_id`) REFERENCES `encoder_roles_list` (`id`),
  ADD CONSTRAINT `encoder_roles_encoder_user_id_foreign` FOREIGN KEY (`encoder_user_id`) REFERENCES `encoder` (`id`);

--
-- Constraints for table `family_composition`
--
ALTER TABLE `family_composition`
  ADD CONSTRAINT `family_composition_relative_civil_status_id_foreign` FOREIGN KEY (`relative_civil_status_id`) REFERENCES `civil_status_list` (`id`),
  ADD CONSTRAINT `family_composition_relative_relationship_id_foreign` FOREIGN KEY (`relative_relationship_id`) REFERENCES `relationship_list` (`id`),
  ADD CONSTRAINT `family_composition_senior_id_foreign` FOREIGN KEY (`senior_id`) REFERENCES `seniors` (`id`);

--
-- Constraints for table `income_source`
--
ALTER TABLE `income_source`
  ADD CONSTRAINT `income_source_income_source_id_foreign` FOREIGN KEY (`income_source_id`) REFERENCES `where_income_source_list` (`id`),
  ADD CONSTRAINT `income_source_senior_id_foreign` FOREIGN KEY (`senior_id`) REFERENCES `seniors` (`id`);

--
-- Constraints for table `pension_distribution_list`
--
ALTER TABLE `pension_distribution_list`
  ADD CONSTRAINT `pension_distribution_list_barangay_id_foreign` FOREIGN KEY (`barangay_id`) REFERENCES `barangay_list` (`id`),
  ADD CONSTRAINT `pension_distribution_list_pension_admin_id_foreign` FOREIGN KEY (`pension_admin_id`) REFERENCES `admin` (`id`),
  ADD CONSTRAINT `pension_distribution_list_pension_encoder_id_foreign` FOREIGN KEY (`pension_encoder_id`) REFERENCES `encoder` (`id`),
  ADD CONSTRAINT `pension_distribution_list_pension_user_type_id_foreign` FOREIGN KEY (`pension_user_type_id`) REFERENCES `user_type_list` (`id`);

--
-- Constraints for table `seniors`
--
ALTER TABLE `seniors`
  ADD CONSTRAINT `seniors_account_status_id_foreign` FOREIGN KEY (`account_status_id`) REFERENCES `senior_account_status_list` (`id`),
  ADD CONSTRAINT `seniors_application_assistant_id_foreign` FOREIGN KEY (`application_assistant_id`) REFERENCES `user_type_list` (`id`),
  ADD CONSTRAINT `seniors_application_status_id_foreign` FOREIGN KEY (`application_status_id`) REFERENCES `senior_application_status_list` (`id`),
  ADD CONSTRAINT `seniors_barangay_id_foreign` FOREIGN KEY (`barangay_id`) REFERENCES `barangay_list` (`id`),
  ADD CONSTRAINT `seniors_civil_status_id_foreign` FOREIGN KEY (`civil_status_id`) REFERENCES `civil_status_list` (`id`),
  ADD CONSTRAINT `seniors_if_pensioner_yes_foreign` FOREIGN KEY (`if_pensioner_yes`) REFERENCES `how_much_pension_list` (`id`),
  ADD CONSTRAINT `seniors_if_permanent_yes_income_foreign` FOREIGN KEY (`if_permanent_yes_income`) REFERENCES `how_much_income_list` (`id`),
  ADD CONSTRAINT `seniors_registration_assistant_id_foreign` FOREIGN KEY (`registration_assistant_id`) REFERENCES `user_type_list` (`id`),
  ADD CONSTRAINT `seniors_sex_id_foreign` FOREIGN KEY (`sex_id`) REFERENCES `sex_list` (`id`),
  ADD CONSTRAINT `seniors_type_of_living_arrangement_foreign` FOREIGN KEY (`type_of_living_arrangement`) REFERENCES `living_arrangement_list` (`id`),
  ADD CONSTRAINT `seniors_user_type_id_foreign` FOREIGN KEY (`user_type_id`) REFERENCES `user_type_list` (`id`);

--
-- Constraints for table `senior_guardian`
--
ALTER TABLE `senior_guardian`
  ADD CONSTRAINT `senior_guardian_guardian_relationship_id_foreign` FOREIGN KEY (`guardian_relationship_id`) REFERENCES `relationship_list` (`id`),
  ADD CONSTRAINT `senior_guardian_senior_id_foreign` FOREIGN KEY (`senior_id`) REFERENCES `seniors` (`id`);

--
-- Constraints for table `source`
--
ALTER TABLE `source`
  ADD CONSTRAINT `source_senior_id_foreign` FOREIGN KEY (`senior_id`) REFERENCES `seniors` (`id`),
  ADD CONSTRAINT `source_source_id_foreign` FOREIGN KEY (`source_id`) REFERENCES `source_list` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
