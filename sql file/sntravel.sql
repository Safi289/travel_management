-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 03, 2021 at 10:44 AM
-- Server version: 10.4.16-MariaDB
-- PHP Version: 7.4.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sntravel`
--

-- --------------------------------------------------------

--
-- Table structure for table `attached_documents`
--

CREATE TABLE `attached_documents` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `customer_id` bigint(20) NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `document` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1 COMMENT '0=Inactive | 1=Active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `attached_documents`
--

INSERT INTO `attached_documents` (`id`, `customer_id`, `title`, `document`, `status`, `created_at`, `updated_at`) VALUES
(5, 1, 'Vue JS', '1581619258 - vue.js', 1, '2020-02-14 06:40:58', '2020-02-14 06:40:58'),
(6, 1, 'Vue JS Cheatsheet', '1581619258 - Vue-Essentials-Cheat-Sheet.pdf', 1, '2020-02-14 06:40:58', '2020-02-14 06:40:58'),
(7, 2, 'Visa List', '1581763617 - 2020-01-25.jpg', 1, '2020-02-15 22:46:58', '2020-02-15 22:46:58'),
(9, 9, 'Docs  file', '1584010341 - BVCPS  Slides (1).pdf', 1, '2020-03-12 21:52:21', '2020-03-12 21:52:21'),
(10, 14, 'visa copy', '1584257741 - acqhr02.png', 1, '2020-03-15 18:35:41', '2020-03-15 18:35:41'),
(11, 14, 'Scan copy', '1584257741 - Best-HR-Payroll-software-company-in-Bangladesh.png', 1, '2020-03-15 18:35:41', '2020-03-15 18:35:41'),
(12, 15, NULL, '1599027546 - De.JPG', 1, '2020-09-02 17:19:06', '2020-09-02 17:19:06'),
(13, 16, 'passport', '1604929858 - IMG_20201109_0001.jpg', 1, '2020-11-09 13:50:58', '2020-11-09 13:50:58'),
(14, 16, NULL, '1607144816 - Capture 1.PNG', 1, '2020-12-05 05:06:56', '2020-12-05 05:06:56'),
(15, 24, 'certificate', '1607832412 - airlinecodes (1).csv', 1, '2020-12-13 04:06:52', '2020-12-13 04:06:52'),
(16, 25, 'bath certificate', '1607834002 - AtechSalesPOS (2).pdf', 1, '2020-12-13 04:33:22', '2020-12-13 04:33:22'),
(17, 26, 'nid', '1607839925 - airlinecodes (1).csv', 1, '2020-12-13 06:12:05', '2020-12-13 06:12:05');

-- --------------------------------------------------------

--
-- Table structure for table `banks`
--

CREATE TABLE `banks` (
  `b_id` bigint(20) UNSIGNED NOT NULL,
  `bank_name` text DEFAULT NULL,
  `branch` text DEFAULT NULL,
  `description` text DEFAULT NULL,
  `bank_status` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `banks`
--

INSERT INTO `banks` (`b_id`, `bank_name`, `branch`, `description`, `bank_status`, `created_at`, `updated_at`) VALUES
(1, 'Bank Asia', 'Jurain SME Centre', NULL, 'Yes', '2020-12-08 02:31:33', '2020-12-10 05:37:42'),
(2, 'UCBL', 'Dania', 'UCBL Dania', 'Yes', '2020-12-08 12:02:56', '2020-12-08 12:02:56'),
(3, 'Islami Bank Bangladesh Ltd.', 'Shampur Dhaka', NULL, 'Yes', '2020-12-10 05:32:57', '2020-12-10 05:38:04'),
(4, 'Pubali Bank Ltd.', 'Jurain Urban', NULL, 'Yes', '2020-12-10 05:36:43', '2020-12-10 05:39:30');

-- --------------------------------------------------------

--
-- Table structure for table `countries`
--

CREATE TABLE `countries` (
  `country_id` bigint(20) UNSIGNED NOT NULL,
  `country_name` text DEFAULT NULL,
  `country_desc` text DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `countries`
--

INSERT INTO `countries` (`country_id`, `country_name`, `country_desc`, `status`, `created_at`, `updated_at`) VALUES
(11, 'Germany', 'European Country', 1, '2020-10-20 10:39:30', '2020-10-21 04:26:47'),
(14, 'China', 'wonderful land', 1, '2020-10-20 10:54:21', '2020-10-21 04:26:49'),
(16, 'Maldives', 'Land of beaches', 1, '2020-10-20 11:09:25', '2020-10-20 11:10:59'),
(17, 'India', 'Land of foods', 1, '2020-10-20 11:20:45', '2020-10-20 11:31:16');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `service_type_id` int(20) DEFAULT NULL,
  `serial_no` bigint(20) DEFAULT NULL,
  `tracking_no` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `given_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sur_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `father_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mother_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date_of_birth` date DEFAULT NULL,
  `resident_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nrb_residence_country` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gender` tinyint(4) NOT NULL COMMENT '1=Male | 2=Female',
  `type` tinyint(4) NOT NULL COMMENT '1=Individual | 2=Group',
  `group_id` bigint(20) DEFAULT NULL,
  `management` tinyint(4) NOT NULL COMMENT '1=jurain | 2=mohammadpur',
  `identity` tinyint(4) NOT NULL COMMENT '1=NID | 2=Birth Certificate',
  `nid_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `birth_certificate_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `occupation` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `company_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `passport_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mobile` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `marital_status` tinyint(4) NOT NULL COMMENT '1=Single | 2=Married | 3=Others',
  `current_address` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `current_police_station` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `current_district` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `current_postcode` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `permanent_address` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `permanent_police_station` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `permanent_district` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `permanent_postcode` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `photo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `spouse_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dependent_id` bigint(20) DEFAULT NULL,
  `maharam_id` bigint(20) DEFAULT NULL,
  `mahram_relation_id` int(20) DEFAULT NULL,
  `notes` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `service_type_id`, `serial_no`, `tracking_no`, `given_name`, `sur_name`, `father_name`, `mother_name`, `date_of_birth`, `resident_type`, `nrb_residence_country`, `gender`, `type`, `group_id`, `management`, `identity`, `nid_number`, `birth_certificate_number`, `occupation`, `company_name`, `email`, `passport_id`, `mobile`, `marital_status`, `current_address`, `current_police_station`, `current_district`, `current_postcode`, `permanent_address`, `permanent_police_station`, `permanent_district`, `permanent_postcode`, `photo`, `spouse_name`, `dependent_id`, `maharam_id`, `mahram_relation_id`, `notes`, `created_at`, `updated_at`) VALUES
(3, 1, 1003, 'SN000003', 'Ashiqur Rahman', 'asdasd', 'ABC', 'ABC', '2020-02-01', 'Bangladeshi', NULL, 1, 2, 1, 1, 1, '23432423', NULL, 'Govt. Job', NULL, 'abc@abc.com', '1', '0145654654654', 1, 'ABC', NULL, NULL, '1234', 'ABC', NULL, NULL, '1231', '1580548821 - w1912zx.png', '1', NULL, NULL, 1, 'Okay', '2020-02-01 15:20:21', '2020-10-26 17:31:24'),
(9, 1, 1009, 'SN000009', 'Hasan', 'Abul', NULL, NULL, '2020-03-05', 'Bangladeshi', NULL, 1, 1, NULL, 1, 1, '01232322233', NULL, 'Private Job', 'Hasan Associates', 'test@test.com', '3', '01716040888', 1, 'Dhanmondi', '367', '47', '12234', 'Dhanmondi', '365', '47', '1234', '1583382156 - 212.jpeg', 'rahela khatun', NULL, NULL, NULL, 'Applied for Omra visa with full family', '2020-03-05 16:22:37', '2020-03-12 21:55:29'),
(16, 2, 1016, 'SN000016', 'MOHAMMAD AMINUR RAHMAN', 'IMROSE', 'MOHAMMAD HARUNUR RASHID', 'ANJU MONOWARA', '1979-06-20', 'Bangladeshi', NULL, 1, 2, 2, 2, 1, '19798817834423984', NULL, 'Private Job', 'UNITED', 'united@yahoo.com', NULL, '01819122451', 2, 'DIAR BODDYNATH, SHIALKOL, SIRAJGANJ SADAR , SIRAJGANJ', '327', '42', '120', 'DIAR BODDYNATH, SHIALKOL, SIRAJGANJ SADAR , SIRAJGANJ', '327', '42', '120', '1604929857 - IMG_20201109_0001.jpg', 'FARJANA RAHMAN', NULL, NULL, 1, NULL, '2020-11-09 13:50:58', '2020-12-05 05:06:56'),
(17, 2, 1017, 'SN000017', 'MD SHAH ALAM', 'BEPARY', 'LATE ABDUL BAREK', 'AMENA BEGUM', '1961-01-02', 'Bangladeshi', NULL, 1, 2, 3, 1, 1, '19612696352210907', NULL, 'Others', 'AMAMA FABRICS', 'test@gmail.com', '14', '01703991225', 2, NULL, '369', '47', NULL, NULL, '369', '47', NULL, '1607237190 - Md Ishak Forid.jpg', 'NOORJAHAN BEGUM', 17, NULL, 1, NULL, '2020-12-06 06:46:30', '2020-12-06 06:52:21'),
(18, 2, 1018, 'SN000018', 'NOORJAHAN', 'BEGUM', 'ABDULLAH', 'HALIMA BEGUM', '1964-12-23', 'Bangladeshi', NULL, 2, 2, 3, 1, 1, '19642696352210906', NULL, 'Others', 'AMAMA FEBRICS', 'test@gmail.com', '15', '01703991225', 2, NULL, '365', '47', NULL, NULL, '365', '47', NULL, '1607238044 - Md Ishak Forid.jpg', 'MD SHAH ALAM BEPARY', 17, 17, 1, NULL, '2020-12-06 07:00:44', '2020-12-06 07:14:05'),
(19, 2, 1019, 'SN000019', 'DOLON', 'AKTHER', 'MD SHAH ALAM BEPARY', 'NOOR JAHAN BEGUM', '1996-05-15', 'Bangladeshi', NULL, 2, 2, 3, 1, 2, NULL, '19963090552090630', 'Others', 'AMAMA FEBRICS', 'test@gmail.com', '16', '01703991225', 2, NULL, '365', '47', NULL, NULL, '365', '47', NULL, '1607238670 - Md Ishak Forid.jpg', 'N/A', 17, 17, 5, NULL, '2020-12-06 07:11:10', '2020-12-06 07:13:18'),
(20, 2, 1020, 'SN000020', 'SYFUR RAHMAN', 'KHOKON', 'HAJI MD HAZRAT ALI', 'RAHIMA KHATUN', '1970-06-30', 'Bangladeshi', NULL, 1, 2, 4, 1, 1, '6715879335758', NULL, 'Others', 'RAHIMA SPAT', 'test@gmail.com', '18', '01911317420', 2, NULL, '365', '47', NULL, NULL, '365', '47', NULL, '1607243365 - Md Ishak Forid.jpg', 'NASRIN AKTER NIJU', NULL, NULL, NULL, NULL, '2020-12-06 08:29:25', '2020-12-06 08:30:32'),
(21, 2, 1021, 'SN000021', 'NASRIN AKTER', 'NIJHU', 'JALIL MOLLA', 'AYASH BEGUM', '1971-05-17', 'Bangladeshi', NULL, 2, 2, 4, 1, 1, '6715879335759', NULL, 'Others', 'RAHIMA SPAT', 'test@gmail.com', '19', '01911317420', 2, NULL, '365', '47', NULL, NULL, '365', '47', NULL, '1607243717 - Md Ishak Forid.jpg', 'SYFUR RAHMAN KHOKON', 20, 20, 1, NULL, '2020-12-06 08:35:18', '2020-12-06 08:35:55'),
(22, 2, 1022, 'SN000022', 'SUNJEEDA RAHMAN', 'DIPTY', 'MD SYFUR RAHMAN', 'NASRIN AKTER', '1998-04-08', 'Bangladeshi', NULL, 2, 2, 4, 1, 2, NULL, '19986735879139177', 'Others', 'RAHIMA SPAT', 'test@gmail.com', '20', '0911317420', 1, NULL, '365', '47', NULL, NULL, '365', '47', NULL, '1607244169 - Md Ishak Forid.jpg', NULL, 20, 20, 5, NULL, '2020-12-06 08:42:49', '2020-12-06 08:43:48'),
(23, 2, 1023, 'SN000023', 'SUMAIYA RAHMAN', 'PRAPTI', 'SYFUR RAHMAN', 'NASRIN AKTER', '2001-04-06', 'Bangladeshi', NULL, 2, 2, 4, 1, 2, NULL, '20016735879139171', 'Others', 'RAHIMA SPAT', 'test@gmail.com', '21', '01911317420', 1, NULL, '365', '47', NULL, NULL, '365', '47', NULL, '1607244531 - Md Ishak Forid.jpg', NULL, NULL, 20, 5, NULL, '2020-12-06 08:48:52', '2020-12-06 08:49:27'),
(24, 1, 1024, 'SN000024', 'RAFI', 'SAHID', 'shahidur rahman', 'selina begum', '1993-12-29', 'Bangladeshi', NULL, 1, 1, NULL, 2, 1, '12345678', NULL, 'Private Job', 'Acquaint Technologies', 'safiulsahid151289@gmail.com', '26', '01911160762', 1, 'mohanagar project', '131', '14', '1000', 'mohanagar project', '131', '14', '1000', '1607832412 - black.jpg', 'abc', NULL, NULL, NULL, NULL, '2020-12-13 04:06:52', '2020-12-13 04:06:52'),
(25, 1, 1025, 'SN000025', 'BRUCE', 'BATMAN', 'thomas wayne', 'martha wayne', '1998-02-05', 'Bangladeshi', NULL, 1, 1, NULL, 3, 1, '1234567890', NULL, 'Private Job', 'Acquaint Technologies', 'safiulsahid151289@gmail.com', '27', '86475362546', 1, '616-617, Dania Main Road, Kodomtoli', '251', '33', '1236', '616-617, Dania Main Road, Kodomtoli', '251', '33', '1236', '1607834002 - aa.jpg', 'abc', NULL, NULL, NULL, NULL, '2020-12-13 04:33:22', '2020-12-13 05:44:42'),
(26, 1, 1026, 'SN000026', 'WAYNE', 'THOMAS', 'bruce', 'martha', '1994-03-09', 'Bangladeshi', NULL, 1, 1, NULL, 2, 1, '1234567890', NULL, 'Private Job', 'Acquaint Technologies', 'safiulsahid151289@gmail.com', '28', '01672326217', 1, 'mohanagar project', '123', '14', '1000', 'mohanagar project', '123', '14', '1000', '1607839925 - aa.jpg', 'bbb', NULL, NULL, NULL, NULL, '2020-12-13 06:12:05', '2020-12-13 06:13:01');

-- --------------------------------------------------------

--
-- Table structure for table `customer_passports`
--

CREATE TABLE `customer_passports` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `full_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `passport_no` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date_of_birth` date DEFAULT NULL,
  `passport_type` tinyint(4) NOT NULL COMMENT '1=General | 2=Government | 3=Others',
  `issue_date` date DEFAULT NULL,
  `expiry_date` date DEFAULT NULL,
  `emergency_contact_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `issue_location` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `box_no` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `reference_id` int(20) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `customer_passports`
--

INSERT INTO `customer_passports` (`id`, `full_name`, `passport_no`, `date_of_birth`, `passport_type`, `issue_date`, `expiry_date`, `emergency_contact_number`, `issue_location`, `box_no`, `reference_id`, `created_at`, `updated_at`) VALUES
(11, 'MD ISHAK FARIDI', 'BP0972802', '1988-07-15', 1, '2017-08-13', '2022-08-12', '01913180703', 'OFFICE STAFF', NULL, NULL, '2020-12-02 07:14:26', '2020-12-02 07:16:07'),
(12, 'MOHAMMED MIRAJ HOSSAIN', 'EG0850265', '1966-05-02', 1, '2020-09-22', '2025-09-21', '01726107878', 'NAYA GAON, BALI GAON,TONGIBARI,MUNSHIGANJ', NULL, NULL, '2020-12-02 07:29:05', '2020-12-02 07:29:05'),
(13, 'MOHAMMAD ISLAM', 'EH0036743', '2004-01-11', 1, '2020-10-13', '2025-10-12', '01711560811', 'ISLAM GARDEN, 6 ESKATON GARDEN ROAD,SHANTINAGAR,RAMNA,DHAKA', NULL, NULL, '2020-12-02 07:45:37', '2020-12-02 07:45:37'),
(14, 'MD SHAH ALAM BEPARY', 'EE0836475', '1961-01-02', 1, '2020-01-25', '2025-01-24', '01703991225', 'ELEPHANT GLORY FLAT 5/G,276 ELEPHANT ROAD, NEW MARKET,DHAKA', NULL, NULL, '2020-12-02 08:04:26', '2020-12-06 08:09:01'),
(15, 'NOORJAHAN BEGUM', 'EE0835980', '1964-12-23', 1, '2020-01-25', '2025-01-24', NULL, 'ELEPHANT GLORY FLAT 5/G,276 ELEPHANT ROAD, NEW MARKET,DHAKA', NULL, NULL, '2020-12-02 08:06:40', '2020-12-06 08:09:30'),
(16, 'DOLON AKTHER', 'EE0836418', '1996-05-15', 1, '2020-01-25', '2025-01-24', NULL, 'ELEPHANT GLORY FLAT 5/G,276 ELEPHANT ROAD, NEW MARKET,DHAKA', NULL, NULL, '2020-12-02 08:08:11', '2020-12-06 08:09:15'),
(17, 'Mohammad Shah Alam', 'k1255455', '2020-12-05', 1, '2020-12-05', '2020-12-05', '+8801817106462', '330, Weat Jurain, Mazar Sharif, West Gate (Chistiya Tower)\r\nDhaka-1204.', NULL, NULL, '2020-12-05 05:36:47', '2020-12-05 05:36:47'),
(18, 'SYFUR RAHMAN KHOKON', 'BQ0968339', '1970-06-30', 1, '2017-11-22', '2022-11-21', '01911317420', 'HOUSE-89,ROAD-10/1, BLOCK-D, NIKETON,GULSHAN,GULSHAN,DHAKA', NULL, NULL, '2020-12-06 07:54:28', '2020-12-06 07:54:28'),
(19, 'NASRIN AKTER NIJHU', 'BW0192550', '1971-05-17', 1, '2018-07-25', '2023-07-24', '01911317420', 'HOUSE-89,ROAD-10/1, BLOCK-D, NIKETON,GULSHAN,GULSHAN,DHAKA', NULL, NULL, '2020-12-06 07:56:57', '2020-12-06 08:06:14'),
(20, 'SUNJEEDA RAHMAN DIPTY', 'EH0164217', '1998-04-08', 1, '2020-11-11', '2025-11-10', '01911317420', 'HOUSE-89,ROAD-10/1, BLOCK-D, NIKETON,GULSHAN,GULSHAN,DHAKA', NULL, NULL, '2020-12-06 07:59:08', '2020-12-06 08:05:38'),
(21, 'SUMAIYA RAHMAN PRAPTI', 'BP0037355', '2001-04-06', 1, '2017-04-23', '2022-04-22', '01911317420', 'HOUSE-89,ROAD-10/1, BLOCK-D, NIKETON,GULSHAN,GULSHAN,DHAKA', NULL, NULL, '2020-12-06 08:00:53', '2020-12-06 08:06:29'),
(22, 'SYFUR RAHMAN KHOKON', '096833988', '1970-06-30', 1, '2017-11-22', '2022-11-21', NULL, 'DHAKA', NULL, NULL, '2020-12-06 08:29:25', '2020-12-06 08:29:25'),
(23, 'NASRIN AKTER NIJHU', '123456789', '1971-05-17', 1, '2018-07-25', '2023-07-24', NULL, 'DHAKA', NULL, NULL, '2020-12-06 08:35:18', '2020-12-06 08:35:18'),
(24, 'SUNJEEDA RAHMAN DIPTY', '123456788', '1998-04-08', 1, '2016-05-18', '2021-05-17', NULL, 'DHAKA', NULL, NULL, '2020-12-06 08:42:49', '2020-12-06 08:42:49'),
(25, 'SUMAIYA RAHMAN PRAPTI', '123456666', '2001-04-06', 1, '2017-04-23', '2022-04-22', NULL, NULL, NULL, NULL, '2020-12-06 08:48:51', '2020-12-06 08:48:51'),
(26, 'RAFI SAHID', '011151289', '1993-12-29', 1, '2019-02-26', '2021-01-23', NULL, 'dhaka', NULL, NULL, '2020-12-13 04:06:52', '2020-12-13 04:06:52'),
(27, 'BRUCE BATMAN', '987654321', '1998-02-05', 1, '2020-07-28', '2024-03-14', NULL, 'paltan', NULL, NULL, '2020-12-13 04:33:22', '2020-12-13 04:33:22'),
(28, 'WAYNE THOMAS', '1234567890', '1994-03-09', 1, '2018-02-06', '2023-08-09', NULL, 'aaa', NULL, NULL, '2020-12-13 06:12:05', '2020-12-13 06:12:05');

-- --------------------------------------------------------

--
-- Table structure for table `customer_visas`
--

CREATE TABLE `customer_visas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `customer_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `visa_collect_from` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `visa_fee` decimal(10,2) NOT NULL DEFAULT 0.00,
  `service_charge` decimal(10,2) NOT NULL DEFAULT 0.00,
  `customer_visa_type_id` bigint(20) UNSIGNED NOT NULL DEFAULT 1,
  `visa_for_country` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `passport_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `customer_visas`
--

INSERT INTO `customer_visas` (`id`, `customer_name`, `visa_collect_from`, `visa_fee`, `service_charge`, `customer_visa_type_id`, `visa_for_country`, `passport_number`, `created_at`, `updated_at`) VALUES
(3, 'Ahsan Hamid', 'Dhaka Embassy', '1200.00', '300.00', 2, 'Thailand', 'E3298232', '2020-10-10 03:27:42', '2020-10-28 11:30:00'),
(4, 'Abdullah hasan', 'Dhaka embassy', '2580.00', '700.00', 1, 'Indonesia', 'E18383838', '2020-10-29 08:01:40', '2020-10-29 08:01:40');

-- --------------------------------------------------------

--
-- Table structure for table `customer_visa_types`
--

CREATE TABLE `customer_visa_types` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `customer_visa_types`
--

INSERT INTO `customer_visa_types` (`id`, `title`, `created_at`, `updated_at`) VALUES
(1, 'Single Entry', '2020-10-10 00:51:02', '2020-10-10 00:51:02'),
(2, 'Double Entry', '2020-10-10 00:51:02', '2020-10-10 00:51:02'),
(3, 'Hajj', '2020-10-10 00:51:02', '2020-10-10 00:51:02'),
(4, 'Umrah Hajj', '2020-10-10 00:51:02', '2020-10-10 00:51:02'),
(5, 'Others', '2020-10-10 00:51:02', '2020-10-10 00:51:02');

-- --------------------------------------------------------

--
-- Table structure for table `deposits`
--

CREATE TABLE `deposits` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `b_id` bigint(20) DEFAULT NULL,
  `voucher_name` varchar(255) DEFAULT NULL,
  `type` tinyint(4) NOT NULL DEFAULT 1 COMMENT '1=Cash | 2=Bank/Cheque	',
  `depositor_name` varchar(255) DEFAULT NULL,
  `bank_branch_name` varchar(255) DEFAULT NULL,
  `cheque_number` varchar(255) DEFAULT NULL,
  `deposit_date` date DEFAULT NULL,
  `amount` decimal(10,2) NOT NULL DEFAULT 0.00,
  `status` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0=Pending | 1=Paid',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `deposits`
--

INSERT INTO `deposits` (`id`, `b_id`, `voucher_name`, `type`, `depositor_name`, `bank_branch_name`, `cheque_number`, `deposit_date`, `amount`, `status`, `created_at`, `updated_at`) VALUES
(1, NULL, 'V0U-0001', 1, 'Kafi', NULL, NULL, '2020-12-23', '7000.00', 0, '2020-12-15 08:09:35', '2020-12-21 04:34:17'),
(2, 1, 'V0U-0002', 2, 'Safi', 'Badda', NULL, '2020-12-04', '100.00', 0, '2020-12-15 08:24:00', '2020-12-15 11:56:24'),
(3, NULL, 'V0U-0003', 1, 'Rafi', NULL, NULL, '2020-12-06', '6000.00', 1, '2020-12-15 09:14:50', '2020-12-15 09:14:50'),
(4, 4, 'VOU-0004', 2, 'aaaa', 'Paltan', NULL, '2020-12-26', '2000.00', 1, '2020-12-17 03:53:58', '2020-12-17 03:54:48');

-- --------------------------------------------------------

--
-- Table structure for table `dev_app_details`
--

CREATE TABLE `dev_app_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `app_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `company_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `company_address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `company_contact` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `company_logo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'logo.png',
  `brand_logo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'brand.png',
  `app_icon` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'favicon.ico',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `dev_app_details`
--

INSERT INTO `dev_app_details` (`id`, `app_name`, `company_name`, `company_address`, `company_contact`, `company_logo`, `brand_logo`, `app_icon`, `created_at`, `updated_at`) VALUES
(1, 'S N Travels & Tours Management System ', 'S N Travels & Tours Management System', 'Dhaka - 1207, Bangladesh', '09638048849', 'logo.png', 'brand.png', 'favicon.ico', '2020-01-27 22:11:05', '2020-01-30 12:31:44');

-- --------------------------------------------------------

--
-- Table structure for table `dev_developer_details`
--

CREATE TABLE `dev_developer_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `dev_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dev_website` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dev_footer` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `dev_developer_details`
--

INSERT INTO `dev_developer_details` (`id`, `dev_name`, `dev_website`, `dev_footer`, `created_at`, `updated_at`) VALUES
(1, 'Acquaint Technologies', 'https://acquaintbd.com', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `dev_mode_setup`
--

CREATE TABLE `dev_mode_setup` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `developer_mode` int(11) NOT NULL DEFAULT 1 COMMENT '1 = On & 0 = off',
  `attendance_type` int(11) NOT NULL DEFAULT 1,
  `developer` int(11) NOT NULL DEFAULT 100,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `dev_mode_setup`
--

INSERT INTO `dev_mode_setup` (`id`, `developer_mode`, `attendance_type`, `developer`, `created_at`, `updated_at`) VALUES
(1, 0, 1, 100, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `districts`
--

CREATE TABLE `districts` (
  `id` int(2) NOT NULL,
  `name` varchar(25) NOT NULL,
  `bn_name` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `districts`
--

INSERT INTO `districts` (`id`, `name`, `bn_name`) VALUES
(1, 'Comilla', 'কুমিল্লা'),
(2, 'Feni', 'ফেনী'),
(3, 'Brahmanbaria', 'ব্রাহ্মণবাড়িয়া'),
(4, 'Rangamati', 'রাঙ্গামাটি'),
(5, 'Noakhali', 'নোয়াখালী'),
(6, 'Chandpur', 'চাঁদপুর'),
(7, 'Lakshmipur', 'লক্ষ্মীপুর'),
(8, 'Chattogram', 'চট্টগ্রাম'),
(9, 'Coxsbazar', 'কক্সবাজার'),
(10, 'Khagrachhari', 'খাগড়াছড়ি'),
(11, 'Bandarban', 'বান্দরবান'),
(12, 'Sirajganj', 'সিরাজগঞ্জ'),
(13, 'Pabna', 'পাবনা'),
(14, 'Bogura', 'বগুড়া'),
(15, 'Rajshahi', 'রাজশাহী'),
(16, 'Natore', 'নাটোর'),
(17, 'Joypurhat', 'জয়পুরহাট'),
(18, 'Chapainawabganj', 'চাঁপাইনবাবগঞ্জ'),
(19, 'Naogaon', 'নওগাঁ'),
(20, 'Jashore', 'যশোর'),
(21, 'Satkhira', 'সাতক্ষীরা'),
(22, 'Meherpur', 'মেহেরপুর'),
(23, 'Narail', 'নড়াইল'),
(24, 'Chuadanga', 'চুয়াডাঙ্গা'),
(25, 'Kushtia', 'কুষ্টিয়া'),
(26, 'Magura', 'মাগুরা'),
(27, 'Khulna', 'খুলনা'),
(28, 'Bagerhat', 'বাগেরহাট'),
(29, 'Jhenaidah', 'ঝিনাইদহ'),
(30, 'Jhalakathi', 'ঝালকাঠি'),
(31, 'Patuakhali', 'পটুয়াখালী'),
(32, 'Pirojpur', 'পিরোজপুর'),
(33, 'Barisal', 'বরিশাল'),
(34, 'Bhola', 'ভোলা'),
(35, 'Barguna', 'বরগুনা'),
(36, 'Sylhet', 'সিলেট'),
(37, 'Moulvibazar', 'মৌলভীবাজার'),
(38, 'Habiganj', 'হবিগঞ্জ'),
(39, 'Sunamganj', 'সুনামগঞ্জ'),
(40, 'Narsingdi', 'নরসিংদী'),
(41, 'Gazipur', 'গাজীপুর'),
(42, 'Shariatpur', 'শরীয়তপুর'),
(43, 'Narayanganj', 'নারায়ণগঞ্জ'),
(44, 'Tangail', 'টাঙ্গাইল'),
(45, 'Kishoreganj', 'কিশোরগঞ্জ'),
(46, 'Manikganj', 'মানিকগঞ্জ'),
(47, 'Dhaka', 'ঢাকা'),
(48, 'Munshiganj', 'মুন্সিগঞ্জ'),
(49, 'Rajbari', 'রাজবাড়ী'),
(50, 'Madaripur', 'মাদারীপুর'),
(51, 'Gopalganj', 'গোপালগঞ্জ'),
(52, 'Faridpur', 'ফরিদপুর'),
(53, 'Panchagarh', 'পঞ্চগড়'),
(54, 'Dinajpur', 'দিনাজপুর'),
(55, 'Lalmonirhat', 'লালমনিরহাট'),
(56, 'Nilphamari', 'নীলফামারী'),
(57, 'Gaibandha', 'গাইবান্ধা'),
(58, 'Thakurgaon', 'ঠাকুরগাঁও'),
(59, 'Rangpur', 'রংপুর'),
(60, 'Kurigram', 'কুড়িগ্রাম'),
(61, 'Sherpur', 'শেরপুর'),
(62, 'Mymensingh', 'ময়মনসিংহ'),
(63, 'Jamalpur', 'জামালপুর'),
(64, 'Netrokona', 'নেত্রকোণা');

-- --------------------------------------------------------

--
-- Table structure for table `expenses`
--

CREATE TABLE `expenses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `expense_category_id` bigint(20) NOT NULL,
  `expense_title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `expense_by` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `expense_date` date DEFAULT NULL,
  `amount` decimal(10,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `expenses`
--

INSERT INTO `expenses` (`id`, `expense_category_id`, `expense_title`, `expense_by`, `description`, `expense_date`, `amount`, `created_at`, `updated_at`) VALUES
(3, 1, 'hello', 'rafi', 'test', '2020-12-02', '2000.00', '2020-12-12 06:08:00', '2020-12-12 06:08:36'),
(5, 1, 'Demo', 'kafi', 'test', '2020-12-02', '500.00', '2020-12-14 10:21:43', '2020-12-14 10:21:43'),
(6, 2, 'TEST', 'SUPER MAN', 'TEST', '2020-12-08', '1000.00', '2020-12-14 10:25:52', '2020-12-14 10:26:23'),
(7, 1, 'pRACTICE', 'sPIDERMAN', 'SAMPLE', '2020-12-08', '2000.00', '2020-12-14 10:28:12', '2020-12-14 10:28:12'),
(8, 1, 'hello', 'kafi', 'simple', '2020-12-07', '200.00', '2020-12-15 09:17:00', '2020-12-15 09:17:00'),
(9, 2, 'Sample', 'safi ul sahid', 'test', '2020-12-17', '300.00', '2020-12-21 04:59:13', '2020-12-21 05:05:36');

-- --------------------------------------------------------

--
-- Table structure for table `expense_categories`
--

CREATE TABLE `expense_categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1 COMMENT '0=Inactive | 1=Active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `expense_categories`
--

INSERT INTO `expense_categories` (`id`, `title`, `description`, `status`, `created_at`, `updated_at`) VALUES
(1, 'General Expense', 'General Expense', 1, '2020-02-16 18:51:17', '2020-12-08 12:04:02'),
(2, 'Food Expense', 'Food Expense', 1, '2020-12-08 12:04:35', '2020-12-08 12:04:35');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

CREATE TABLE `groups` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `group_code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `group_type` tinyint(4) NOT NULL DEFAULT 1 COMMENT '1=Hajj | 2=Omra Hajj',
  `group_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `leader_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `management_type` tinyint(4) NOT NULL COMMENT '0=Group Leader | 1=Office',
  `management_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contact_no` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `groups`
--

INSERT INTO `groups` (`id`, `group_code`, `group_type`, `group_name`, `leader_name`, `management_type`, `management_name`, `address`, `contact_no`, `email`, `created_at`, `updated_at`) VALUES
(2, 'SN-G000002', 1, 'Islam Group', 'Ali Islam', 0, NULL, 'Dhaka', '01744444444', 'ali@mail.com', '2020-01-31 03:59:59', '2020-02-02 21:09:14'),
(3, 'SN-G000003', 2, 'MD SHAH ALAM BEPARY ( ELEPHANT ROAD)', 'N/A', 1, 'N/A', 'HOUSE#276,ELEPHANT GLORY,FLAT#5G,ELEPHANT ROAD,NEW MARKET,DHAKA', '01703991225', 'ishakfaridi@gmail.com', '2020-12-06 05:45:10', '2020-12-06 05:45:10'),
(4, 'SN-G000004', 2, 'RAHIMA SPAT', 'N/A', 1, 'N/A', 'HOUSE-89,ROAD-10/1, BLOCK-D, NIKETON,GULSHAN,GULSHAN,DHAKA', '01911317420', 'test@gmail.com', '2020-12-06 08:22:44', '2020-12-06 08:22:44');

-- --------------------------------------------------------

--
-- Table structure for table `hajjs`
--

CREATE TABLE `hajjs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `type` tinyint(4) NOT NULL DEFAULT 1 COMMENT '1=Hajj | 2=Omra Hajj',
  `serial_no` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `year` year(4) DEFAULT NULL,
  `hijri` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `customer_id` bigint(20) DEFAULT NULL,
  `package_id` bigint(20) DEFAULT NULL,
  `departure_status` bigint(20) DEFAULT NULL,
  `payment_status` bigint(20) NOT NULL DEFAULT 0 COMMENT '0=Partially Paid | 1=Paid',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `hajjs`
--

INSERT INTO `hajjs` (`id`, `type`, `serial_no`, `year`, `hijri`, `start_date`, `end_date`, `description`, `customer_id`, `package_id`, `departure_status`, `payment_status`, `created_at`, `updated_at`) VALUES
(17, 1, 'Haji-1001', NULL, NULL, NULL, NULL, NULL, 3, 7, 0, 1, '2020-12-05 05:20:34', '2020-12-20 11:24:57'),
(18, 2, 'Omra Haji-1001', NULL, NULL, NULL, NULL, NULL, 20, 8, 1, 0, '2020-12-06 09:21:53', '2020-12-06 09:21:53');

-- --------------------------------------------------------

--
-- Table structure for table `hajj_payments`
--

CREATE TABLE `hajj_payments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `hajj_id` bigint(20) DEFAULT NULL,
  `voucher_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` tinyint(4) NOT NULL DEFAULT 1 COMMENT '1=Cash | 2=Bank/Cheque',
  `depositor_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bank_name` int(11) DEFAULT NULL,
  `bank_branch_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cheque_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deposit_date` date DEFAULT NULL,
  `amount` decimal(10,2) NOT NULL DEFAULT 0.00,
  `status` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0=Pending | 1=Paid',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `hajj_payments`
--

INSERT INTO `hajj_payments` (`id`, `hajj_id`, `voucher_name`, `type`, `depositor_name`, `bank_name`, `bank_branch_name`, `cheque_number`, `deposit_date`, `amount`, `status`, `created_at`, `updated_at`) VALUES
(12, 17, '124578', 2, 'ABC', 1, 'ABC', '12312323', '2020-12-06', '25000.00', 1, '2020-12-04 23:21:51', '2020-12-10 11:08:42'),
(13, 17, '12321', 1, 'ABC', NULL, NULL, NULL, '2020-12-02', '425000.00', 1, '2020-12-04 23:23:51', '2020-12-04 23:23:51'),
(14, 17, 'Ishak Forid', 1, 'Ishak Forid', NULL, NULL, NULL, '2020-12-09', '100.00', 1, '2020-12-06 03:09:54', '2020-12-06 03:09:54'),
(15, 18, 'SYFUR RAHMAN KHOKON', 2, 'Shawkat', 1, 'Corporate', 'AC6973652', '2020-10-08', '500000.00', 1, '2020-12-06 03:30:18', '2020-12-06 03:30:18'),
(16, 17, 'ABC', 2, 'ABC', 2, 'ABC', 'ABC', '2020-12-09', '2000.00', 1, '2020-12-08 12:07:58', '2020-12-08 12:07:58');

-- --------------------------------------------------------

--
-- Table structure for table `hotels`
--

CREATE TABLE `hotels` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `hotel_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cost` decimal(10,2) NOT NULL DEFAULT 0.00,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `hotels`
--

INSERT INTO `hotels` (`id`, `hotel_name`, `cost`, `created_at`, `updated_at`) VALUES
(1, 'Hotel 1', '22000.00', '2020-02-11 05:35:41', '2020-02-16 18:02:46'),
(2, 'Hotel 2', '16937.00', '2020-02-11 05:35:41', '2020-02-11 05:35:41');

-- --------------------------------------------------------

--
-- Table structure for table `mahram_relations`
--

CREATE TABLE `mahram_relations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `relation_title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1 COMMENT '0=Inactive | 1=Active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `mahram_relations`
--

INSERT INTO `mahram_relations` (`id`, `relation_title`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Husband', 1, '2020-02-13 04:19:42', '2020-02-13 04:19:42'),
(2, 'Son', 1, '2020-02-13 04:19:42', '2020-02-13 04:19:42'),
(3, 'Brother', 1, '2020-02-13 04:19:42', '2020-02-13 04:19:42'),
(4, 'Nephew', 1, '2020-02-13 04:19:42', '2020-02-13 04:19:42'),
(5, 'Group Of Women', 1, '2020-02-13 04:19:42', '2020-02-13 04:19:42'),
(6, 'Grandfather', 1, '2020-02-13 04:19:42', '2020-02-13 04:19:42'),
(7, 'Father', 1, NULL, NULL),
(8, 'Great Grandfather', 1, NULL, NULL),
(9, 'Paternal Uncle', 1, NULL, NULL),
(10, 'Maternal Uncle', 1, NULL, NULL),
(11, 'Father In Law', 1, NULL, NULL),
(12, 'Step Father', 1, NULL, NULL),
(13, 'Step Son', 1, NULL, NULL),
(14, 'Half Brother', 1, NULL, NULL),
(15, 'Son In Law', 1, NULL, NULL),
(16, 'Foster Father', 1, NULL, NULL),
(17, 'Foster Brother', 1, NULL, NULL),
(18, 'Foster Nephew', 1, NULL, NULL),
(19, 'Foster Uncle', 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `menus`
--

CREATE TABLE `menus` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `selector` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `parent_id` bigint(20) NOT NULL,
  `serial_no` int(11) NOT NULL,
  `menu_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `route_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `icon` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sidebar_visibility` tinyint(4) NOT NULL DEFAULT 1 COMMENT '1 = On & 0 = Off',
  `status` int(11) NOT NULL COMMENT '1 = Active & 0 = Inactive',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `menus`
--

INSERT INTO `menus` (`id`, `selector`, `parent_id`, `serial_no`, `menu_name`, `route_name`, `icon`, `sidebar_visibility`, `status`, `created_at`, `updated_at`) VALUES
(1, 'dashboard', 0, 1, 'Dashboard', 'dashboard', 'fa fa-home', 1, 1, '2020-01-31 18:10:21', '2020-03-15 01:47:11'),
(2, 'groups', 0, 2, 'Groups', '#', 'flaticon2-group\r\n', 1, 1, '2020-01-31 18:10:21', '2020-03-15 01:47:11'),
(3, 'create-groups', 2, 1, 'Add New Group', 'groups/create', NULL, 1, 1, '2020-01-31 18:10:21', '2020-03-15 01:47:11'),
(4, 'groups', 2, 2, 'All Group List', 'groups', NULL, 1, 1, '2020-01-31 18:10:21', '2020-03-15 01:47:11'),
(5, 'email-marketing', 49, 2, 'Email Marketing', 'email-marketing', 'fas fa-mail-bulk', 1, 1, '2020-01-31 18:10:21', '2020-03-15 01:47:11'),
(6, 'services-4', 2, 4, 'Services 4', 'services-4', 'fa fa-hand-o-right', 0, 0, '2020-01-31 18:10:21', '2020-03-15 01:47:11'),
(7, 'services-5', 2, 5, 'Services 5', 'services-5', 'fa fa-hand-o-right', 0, 0, '2020-01-31 18:10:21', '2020-03-15 01:47:11'),
(8, 'services-1-1', 3, 1, 'Services 1.1', 'services-1-1', 'fa fa-check', 0, 0, '2020-01-31 18:10:21', '2020-03-15 01:47:11'),
(10, 'services-1-3', 3, 3, 'Services 1.3', 'services-1-3', 'fa fa-check', 0, 1, '2020-01-31 18:10:21', '2020-09-08 23:49:16'),
(11, 'Customer-management', 0, 3, 'Customer Management', '#', 'fa fa-user', 1, 1, '2020-01-31 18:10:21', '2020-03-15 01:47:11'),
(12, 'add-new-customer', 11, 1, 'Add New Customer', 'customer/create', NULL, 1, 1, '2020-01-31 18:13:33', '2020-03-15 01:47:11'),
(13, 'all-customer-list', 11, 2, 'All Customer List', 'customer', NULL, 1, 1, '2020-01-31 18:15:56', '2020-03-15 01:47:11'),
(14, 'hajj-management', 0, 4, 'Hajj Management', '#', 'fa fa-building', 1, 1, '2020-01-31 18:24:09', '2020-03-15 01:47:11'),
(15, 'omra-hajj-management', 0, 5, 'Umrah Management', '#', 'fa fa-home', 1, 1, '2020-01-31 18:25:45', '2020-10-12 20:33:43'),
(16, 'passport-management', 0, 7, 'Passport Management', '#', 'fa fa-book', 1, 1, '2020-01-31 18:26:34', '2020-03-15 01:47:11'),
(17, 'package-management', 0, 6, 'Package Management', '#', 'fa fa-box', 1, 1, '2020-01-31 18:28:44', '2020-03-15 01:47:11'),
(18, 'add-haji-information', 14, 1, 'Add Haji Information', 'haji/create', NULL, 1, 1, '2020-01-31 18:34:37', '2020-03-15 01:47:11'),
(19, 'all-haji-information', 14, 2, 'All Haji Information', 'haji', NULL, 1, 1, '2020-01-31 18:36:47', '2020-03-15 01:47:11'),
(20, 'add-new-omra-haji-information', 15, 1, 'Add New Umrah Information', 'omra-haji/create', NULL, 1, 1, '2020-01-31 18:38:09', '2020-10-12 20:34:57'),
(21, 'all-omra-haji-information', 15, 2, 'All Umrah Information', 'omra-haji', NULL, 1, 1, '2020-01-31 18:39:00', '2020-10-12 20:35:10'),
(22, 'add-hajj-package', 17, 1, 'Add Hajj Package', 'hajj-package/create', NULL, 1, 1, '2020-01-31 18:53:50', '2020-03-15 01:47:11'),
(23, 'all-hajj-package', 14, 3, 'All Hajj Packages', 'hajj-package', NULL, 1, 1, '2020-01-31 18:55:22', '2020-03-15 01:47:11'),
(24, 'add-omra-hajj-package', 17, 3, 'Add Omra Hajj Package', 'omra-hajj-package/create', NULL, 1, 1, '2020-01-31 18:57:17', '2020-03-15 01:47:11'),
(25, 'all-omra-hajj-packages', 15, 3, 'All Umrah Packages', 'omra-hajj-package', NULL, 1, 1, '2020-01-31 18:58:06', '2020-10-12 20:35:21'),
(26, 'add-passport-information', 16, 1, 'Add Passport Information', 'passport-info/create', NULL, 1, 1, '2020-01-31 19:13:32', '2020-03-15 01:47:11'),
(27, 'all-passport-list', 16, 2, 'All Passport List', 'passport-info', NULL, 1, 1, '2020-01-31 19:15:26', '2020-03-15 01:47:11'),
(28, 'check-passport-history', 16, 4, 'Check Passport History', 'passport-history', NULL, 1, 1, '2020-01-31 19:21:30', '2020-03-15 01:47:11'),
(29, 'reports', 0, 8, 'Reports', '#', 'fa fa-home', 1, 1, '2020-01-31 19:26:08', '2020-03-15 01:47:11'),
(30, 'sms-sending-system', 49, 1, 'SMS Sending System', 'sms-sending-system', 'fa fa-mobile', 1, 1, '2020-01-31 19:29:10', '2020-03-15 01:47:11'),
(31, 'customer-payment-details', 11, 3, 'Customer Payment Details', 'customer-payment', NULL, 0, 1, '2020-02-03 22:01:18', '2020-03-15 01:47:11'),
(32, 'haji-payment-details', 14, 3, 'Haji Payment Details', 'haji-payment-details', NULL, 1, 1, '2020-02-03 22:03:06', '2020-03-15 01:47:11'),
(33, 'omra-haji-payment-details', 15, 3, 'Umrah Payment Details', 'omra-haji-payment-details', NULL, 1, 1, '2020-02-03 22:05:07', '2020-10-12 20:35:37'),
(34, 'makka-madina-management', 0, 6, 'Makka Madina Management', '#', 'fa fa-star', 1, 1, '2020-02-03 22:09:18', '2020-03-15 01:47:11'),
(35, 'hotel-rate-list', 34, 1, 'Hotel Rate List', 'hotel-rate', NULL, 1, 1, '2020-02-03 22:11:52', '2020-03-15 01:47:11'),
(36, 'vehicle-rate-list', 34, 2, 'Airlines Rate List', 'vehicle-rate', NULL, 1, 1, '2020-02-03 22:12:50', '2020-10-09 23:00:10'),
(37, 'customer-report', 29, 1, 'Customer Report', 'customer-report', NULL, 1, 1, '2020-02-03 22:17:31', '2020-03-15 01:47:11'),
(38, 'haji-report', 29, 2, 'Haji Report', 'haji-report', NULL, 1, 1, '2020-02-03 22:18:00', '2020-03-15 01:47:11'),
(39, 'omra-haji-report', 29, 3, 'Omra Haji Report', 'omra-haji-report', NULL, 1, 1, '2020-02-03 22:18:53', '2020-03-15 01:47:11'),
(40, 'passport-report', 29, 4, 'Passport Report', 'passport-report', NULL, 1, 1, '2020-02-03 22:19:50', '2020-03-15 01:47:11'),
(43, 'accounts-management', 0, 10, 'Accounts Management', '#', 'fa fa-money-bill-wave', 1, 1, '2020-02-09 19:30:16', '2020-03-15 01:47:11'),
(44, 'deposit-list', 43, 1, 'List of Deposits', 'deposit-list', 'fa fa-plus', 1, 1, '2020-02-09 19:31:49', '2020-03-15 01:47:11'),
(45, 'expense-list', 43, 2, 'List of Expenses', 'expense-list', 'fa fa-minus', 1, 1, '2020-02-09 19:32:33', '2020-03-15 01:47:11'),
(46, 'cash-in-hand', 43, 3, 'Cash in Hand', 'cash-in-hand', 'fa fa-hand', 1, 1, '2020-02-09 19:33:12', '2020-03-15 01:47:11'),
(47, 'hajj-groups', 14, 3, 'Hajj Group List', 'hajj-groups', NULL, 1, 1, '2020-02-16 03:32:46', '2020-03-15 01:47:11'),
(48, 'omra-hajj-groups', 15, 3, 'Omra Hajj Group List', 'omra-hajj-groups', NULL, 1, 1, '2020-02-16 03:33:55', '2020-03-15 01:47:11'),
(49, 'marketing-management', 0, 10, 'Marketing Management', '#', 'fas fa-poll', 1, 1, '2020-03-08 17:39:49', '2020-03-15 01:47:11'),
(50, 'ticket-management', 0, 11, 'Ticket Management', '#', 'la la-ticket', 1, 1, '2020-03-08 17:40:24', '2020-10-20 17:09:03'),
(51, 'visa-management', 0, 12, 'Visa Management', 'visa-management', 'la la-cc-visa', 1, 1, '2020-03-08 17:40:42', '2020-03-15 01:47:11'),
(52, 'passport-collection', 16, 3, 'Passport Collection', 'passport-collection', NULL, 1, 1, '2020-03-15 17:58:15', '2020-03-15 17:58:15'),
(53, 'ticketing-airlines', 50, 1, 'Ticketing Airlines List', 'ticketing-airlines', NULL, 1, 1, '2020-10-20 17:10:14', '2020-10-20 17:10:14'),
(54, 'ticket-sales', 50, 2, 'Ticket Sales', 'ticket-sales', NULL, 1, 1, '2020-10-20 17:10:14', '2020-10-20 17:10:14'),
(55, 'ticket-refund', 50, 3, 'Ticket Refund', 'ticket-refund', NULL, 1, 1, '2020-10-20 17:10:14', '2020-10-20 17:10:14'),
(56, 'ticket-sales-commission', 50, 4, 'Ticket Sales Commission', 'ticket-sales-commission', NULL, 1, 1, '2020-10-20 17:10:14', '2020-10-20 17:10:14'),
(57, 'bank-list', 43, 4, 'Bank list', 'view-bank', 'fas fa-landmark', 1, 1, '2020-12-08 05:41:29', '2020-12-08 05:56:02'),
(58, 'expense-categories', 43, 5, 'Expense Categories', 'view-expense-category', NULL, 1, 1, '2020-12-08 08:59:01', '2020-12-08 10:19:01'),
(59, 'cash-in-deposit', 43, 5, 'Cash In Deposit', 'cash-in-deposit', NULL, 1, 1, '2020-12-09 07:05:08', '2020-12-09 07:05:08');

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
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_09_03_139999_add_new_columns_to_users_table', 2),
(5, '2019_09_03_141000_create_dev_developer_details_table', 2),
(6, '2019_09_03_141001_create_priorities_table', 2),
(7, '2019_09_03_154934_create_menus_table', 2),
(8, '2019_09_03_183043_create_priority_menu_table', 2),
(9, '2019_09_03_185154_create_dev_mode_setup_table', 2),
(10, '2019_09_03_185527_create_dev_app_details_table', 2),
(11, '2019_10_17_080139_create_profiles_table', 2),
(12, '2020_01_27_173921_create_groups_table', 3),
(13, '2020_01_27_173950_create_customers_table', 3),
(14, '2020_01_27_174200_create_customer_passports_table', 3),
(15, '2020_01_27_174241_create_payments_table', 3),
(16, '2020_01_27_174255_create_packages_table', 3);

-- --------------------------------------------------------

--
-- Table structure for table `packages`
--

CREATE TABLE `packages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `package_type` tinyint(4) NOT NULL DEFAULT 1 COMMENT '1=Hajj | 2=Omra Hajj',
  `package_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pack_code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `year` year(4) DEFAULT NULL,
  `hijri` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `no_of_days` int(11) NOT NULL DEFAULT 0,
  `makka_arrival_date` date DEFAULT NULL,
  `madina_arrival_date` date DEFAULT NULL,
  `makka_ziyarah_date` date DEFAULT NULL,
  `madinaa_ziyarah_date` date DEFAULT NULL,
  `hotel_id` int(20) NOT NULL,
  `vehicle_id` int(20) NOT NULL,
  `total_price` double NOT NULL DEFAULT 0,
  `package_description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0=Inactive | 1=Active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `packages`
--

INSERT INTO `packages` (`id`, `package_type`, `package_name`, `pack_code`, `year`, `hijri`, `start_date`, `end_date`, `no_of_days`, `makka_arrival_date`, `madina_arrival_date`, `makka_ziyarah_date`, `madinaa_ziyarah_date`, `hotel_id`, `vehicle_id`, `total_price`, `package_description`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 'Gold Package 2020', 'GP-2020', 2020, '1441', '2020-04-01', '2020-04-29', 29, '2020-11-01', '2020-11-07', '2020-11-02', '2020-11-04', 1, 4, 500000, NULL, 1, '2020-02-04 06:10:38', '2020-10-10 00:06:31'),
(7, 1, 'Silver2020', 'SN20', 2020, '1414', '2020-12-12', '2020-12-31', 18, '2020-12-11', '2020-12-10', '2020-12-10', '2020-12-24', 1, 1, 450000, 'N/A', 1, '2020-12-05 05:18:42', '2020-12-05 05:18:42'),
(8, 2, 'UMRAH VIP PACKAGE', '101', 2021, NULL, '2021-01-01', '2020-12-10', 10, '2021-01-01', '2021-01-07', '2021-01-04', '2020-12-09', 1, 1, 1200000, 'RAHIMA SPAT CORPORATE GROUP', 1, '2020-12-06 09:17:58', '2020-12-06 09:20:37');

-- --------------------------------------------------------

--
-- Table structure for table `passport_documents`
--

CREATE TABLE `passport_documents` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `customer_passport_id` bigint(20) NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `document` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1 COMMENT '0=Inactive | 1=Active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `passport_documents`
--

INSERT INTO `passport_documents` (`id`, `customer_passport_id`, `title`, `document`, `status`, `created_at`, `updated_at`) VALUES
(10, 10, 'PASSPORT', '1604933413 - IMG_20201109_0001.jpg', 1, '2020-11-09 14:50:14', '2020-11-09 14:50:14'),
(11, 11, 'EXTRA 02 PASSPORT TOTAL 03 PASSPORT', '1606893367 - FARID PASSPORT COPY.jpg', 1, '2020-12-02 07:16:08', '2020-12-02 07:16:08'),
(12, 11, 'EXTRA 02 PASSPORT TOTAL 03 PASSPORT', '1606893506 - FARID PASSPORT COPY.jpg', 1, '2020-12-02 07:18:26', '2020-12-02 07:18:26'),
(13, 17, 'Photocopy', '1607146607 - jpgpdf_20201020233801.pdf', 1, '2020-12-05 05:36:47', '2020-12-05 05:36:47');

-- --------------------------------------------------------

--
-- Table structure for table `passport_history`
--

CREATE TABLE `passport_history` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `passport_id` bigint(20) NOT NULL,
  `passport_status_id` bigint(20) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp(),
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `passport_history`
--

INSERT INTO `passport_history` (`id`, `passport_id`, `passport_status_id`, `date`, `created_at`, `updated_at`) VALUES
(13, 11, 1, '2020-12-02 07:47:08', '2020-12-02 07:47:08', '2020-12-02 07:47:08'),
(14, 13, 1, '2020-12-02 07:47:40', '2020-12-02 07:47:40', '2020-12-02 07:47:40'),
(15, 12, 1, '2020-12-02 07:47:55', '2020-12-02 07:47:54', '2020-12-02 07:47:54'),
(16, 11, 3, '2020-12-02 07:48:27', '2020-12-02 07:48:27', '2020-12-02 07:48:27'),
(17, 11, 2, '2020-12-02 07:48:48', '2020-12-02 07:48:48', '2020-12-02 07:48:48'),
(18, 11, 4, '2020-12-02 07:48:58', '2020-12-02 07:48:58', '2020-12-02 07:48:58'),
(19, 11, 6, '2020-12-02 07:49:08', '2020-12-02 07:49:08', '2020-12-02 07:49:08'),
(20, 11, 8, '2020-12-02 07:49:19', '2020-12-02 07:49:19', '2020-12-02 07:49:19'),
(21, 16, 1, '2020-12-02 08:08:41', '2020-12-02 08:08:41', '2020-12-02 08:08:41'),
(22, 14, 1, '2020-12-02 08:08:53', '2020-12-02 08:08:53', '2020-12-02 08:08:53'),
(23, 15, 1, '2020-12-02 08:09:08', '2020-12-02 08:09:08', '2020-12-02 08:09:08'),
(24, 20, 1, '2020-12-06 08:10:43', '2020-12-06 08:10:43', '2020-12-06 08:10:43');

-- --------------------------------------------------------

--
-- Table structure for table `passport_statuses`
--

CREATE TABLE `passport_statuses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `serial_no` bigint(20) DEFAULT NULL,
  `status_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status_id` bigint(20) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `passport_statuses`
--

INSERT INTO `passport_statuses` (`id`, `serial_no`, `status_name`, `description`, `status_id`, `created_at`, `updated_at`) VALUES
(1, 1, 'Passport Received', NULL, 1, '2020-02-20 03:36:11', '2020-02-20 03:36:11'),
(2, 2, 'Passport Kept in Box 01', NULL, 2, '2020-02-20 03:36:11', '2020-02-20 03:36:11'),
(3, 3, 'Passport Sent for Visa', NULL, 3, '2020-02-20 03:36:11', '2020-02-20 03:36:11'),
(4, 4, 'Passport received from Embassy ', NULL, 4, '2020-02-20 03:36:11', '2020-02-20 03:36:11'),
(6, 5, 'Issue Ticket', NULL, 2, '2020-02-20 03:36:11', '2020-02-20 03:36:11'),
(7, 6, 'Passport Kept in Box 02 after visa', NULL, 5, '2020-02-20 03:36:11', '2020-02-20 03:36:11'),
(8, 7, 'Passport Delivered to Client', NULL, NULL, '2020-02-20 03:36:11', '2020-02-20 03:36:11');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `customer_id` bigint(20) NOT NULL,
  `package_id` bigint(20) NOT NULL,
  `voucher_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pay_type` tinyint(4) NOT NULL COMMENT '1=Cash | 2=Bank',
  `depositor_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deposit_date` datetime DEFAULT NULL,
  `bank_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bank_branch_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bank_address` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `paid_amount` double NOT NULL DEFAULT 0,
  `status` tinyint(4) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `priorities`
--

CREATE TABLE `priorities` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `priority_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `priority_description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `priority_status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `priorities`
--

INSERT INTO `priorities` (`id`, `priority_name`, `priority_description`, `priority_status`, `created_at`, `updated_at`) VALUES
(1, 'Super Admin', 'Super Admin. This user has complete control in the application.', '1', '2020-01-27 22:11:05', '2020-01-27 22:11:05'),
(2, 'General Admin', 'General Admin', '1', '2020-02-02 21:21:03', '2020-02-02 21:21:27'),
(3, 'Sales - Hajj Umrah', 'NA', '1', '2020-12-05 06:09:50', '2020-12-05 06:58:45'),
(4, 'Accounts', 'NA', '1', '2020-12-05 06:55:31', '2020-12-05 06:55:31'),
(5, 'Sales- Ticketing', 'Sales- Ticketing', '1', '2020-12-05 06:59:10', '2020-12-05 06:59:10');

-- --------------------------------------------------------

--
-- Table structure for table `priority_menu`
--

CREATE TABLE `priority_menu` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `priority_id` bigint(20) NOT NULL,
  `menu_id` bigint(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `priority_menu`
--

INSERT INTO `priority_menu` (`id`, `priority_id`, `menu_id`, `created_at`, `updated_at`) VALUES
(844, 3, 1, NULL, NULL),
(845, 3, 2, NULL, NULL),
(846, 3, 3, NULL, NULL),
(847, 3, 4, NULL, NULL),
(848, 3, 11, NULL, NULL),
(849, 3, 12, NULL, NULL),
(850, 3, 13, NULL, NULL),
(851, 3, 31, NULL, NULL),
(852, 3, 14, NULL, NULL),
(853, 3, 18, NULL, NULL),
(854, 3, 19, NULL, NULL),
(855, 3, 23, NULL, NULL),
(856, 3, 32, NULL, NULL),
(857, 3, 47, NULL, NULL),
(858, 3, 15, NULL, NULL),
(859, 3, 20, NULL, NULL),
(860, 3, 21, NULL, NULL),
(861, 3, 25, NULL, NULL),
(862, 3, 33, NULL, NULL),
(863, 3, 48, NULL, NULL),
(864, 3, 17, NULL, NULL),
(865, 3, 22, NULL, NULL),
(866, 3, 24, NULL, NULL),
(867, 3, 34, NULL, NULL),
(868, 3, 35, NULL, NULL),
(869, 3, 36, NULL, NULL),
(870, 3, 16, NULL, NULL),
(871, 3, 26, NULL, NULL),
(872, 3, 27, NULL, NULL),
(873, 3, 52, NULL, NULL),
(874, 3, 28, NULL, NULL),
(875, 3, 29, NULL, NULL),
(876, 3, 37, NULL, NULL),
(877, 3, 38, NULL, NULL),
(878, 3, 39, NULL, NULL),
(879, 3, 40, NULL, NULL),
(880, 3, 49, NULL, NULL),
(881, 3, 30, NULL, NULL),
(882, 3, 5, NULL, NULL),
(883, 3, 51, NULL, NULL),
(938, 5, 1, NULL, NULL),
(939, 5, 2, NULL, NULL),
(940, 5, 3, NULL, NULL),
(941, 5, 4, NULL, NULL),
(942, 5, 11, NULL, NULL),
(943, 5, 12, NULL, NULL),
(944, 5, 13, NULL, NULL),
(945, 5, 31, NULL, NULL),
(946, 5, 16, NULL, NULL),
(947, 5, 26, NULL, NULL),
(948, 5, 27, NULL, NULL),
(949, 5, 52, NULL, NULL),
(950, 5, 28, NULL, NULL),
(951, 5, 29, NULL, NULL),
(952, 5, 37, NULL, NULL),
(953, 5, 40, NULL, NULL),
(954, 5, 49, NULL, NULL),
(955, 5, 30, NULL, NULL),
(956, 5, 5, NULL, NULL),
(957, 5, 50, NULL, NULL),
(958, 5, 53, NULL, NULL),
(959, 5, 54, NULL, NULL),
(960, 5, 55, NULL, NULL),
(961, 5, 56, NULL, NULL),
(962, 5, 51, NULL, NULL),
(1014, 1, 1, NULL, NULL),
(1015, 1, 2, NULL, NULL),
(1016, 1, 3, NULL, NULL),
(1017, 1, 4, NULL, NULL),
(1018, 1, 11, NULL, NULL),
(1019, 1, 12, NULL, NULL),
(1020, 1, 13, NULL, NULL),
(1021, 1, 31, NULL, NULL),
(1022, 1, 14, NULL, NULL),
(1023, 1, 18, NULL, NULL),
(1024, 1, 19, NULL, NULL),
(1025, 1, 23, NULL, NULL),
(1026, 1, 32, NULL, NULL),
(1027, 1, 47, NULL, NULL),
(1028, 1, 15, NULL, NULL),
(1029, 1, 20, NULL, NULL),
(1030, 1, 21, NULL, NULL),
(1031, 1, 25, NULL, NULL),
(1032, 1, 33, NULL, NULL),
(1033, 1, 48, NULL, NULL),
(1034, 1, 17, NULL, NULL),
(1035, 1, 22, NULL, NULL),
(1036, 1, 24, NULL, NULL),
(1037, 1, 34, NULL, NULL),
(1038, 1, 35, NULL, NULL),
(1039, 1, 36, NULL, NULL),
(1040, 1, 16, NULL, NULL),
(1041, 1, 26, NULL, NULL),
(1042, 1, 27, NULL, NULL),
(1043, 1, 52, NULL, NULL),
(1044, 1, 28, NULL, NULL),
(1045, 1, 29, NULL, NULL),
(1046, 1, 37, NULL, NULL),
(1047, 1, 38, NULL, NULL),
(1048, 1, 39, NULL, NULL),
(1049, 1, 40, NULL, NULL),
(1050, 1, 43, NULL, NULL),
(1051, 1, 44, NULL, NULL),
(1052, 1, 45, NULL, NULL),
(1053, 1, 46, NULL, NULL),
(1054, 1, 57, NULL, NULL),
(1055, 1, 58, NULL, NULL),
(1056, 1, 59, NULL, NULL),
(1057, 1, 49, NULL, NULL),
(1058, 1, 30, NULL, NULL),
(1059, 1, 5, NULL, NULL),
(1060, 1, 50, NULL, NULL),
(1061, 1, 53, NULL, NULL),
(1062, 1, 54, NULL, NULL),
(1063, 1, 55, NULL, NULL),
(1064, 1, 56, NULL, NULL),
(1065, 1, 51, NULL, NULL),
(1066, 2, 1, NULL, NULL),
(1067, 2, 2, NULL, NULL),
(1068, 2, 3, NULL, NULL),
(1069, 2, 4, NULL, NULL),
(1070, 2, 11, NULL, NULL),
(1071, 2, 12, NULL, NULL),
(1072, 2, 13, NULL, NULL),
(1073, 2, 31, NULL, NULL),
(1074, 2, 14, NULL, NULL),
(1075, 2, 18, NULL, NULL),
(1076, 2, 19, NULL, NULL),
(1077, 2, 23, NULL, NULL),
(1078, 2, 32, NULL, NULL),
(1079, 2, 47, NULL, NULL),
(1080, 2, 15, NULL, NULL),
(1081, 2, 20, NULL, NULL),
(1082, 2, 21, NULL, NULL),
(1083, 2, 25, NULL, NULL),
(1084, 2, 33, NULL, NULL),
(1085, 2, 48, NULL, NULL),
(1086, 2, 17, NULL, NULL),
(1087, 2, 22, NULL, NULL),
(1088, 2, 24, NULL, NULL),
(1089, 2, 34, NULL, NULL),
(1090, 2, 35, NULL, NULL),
(1091, 2, 36, NULL, NULL),
(1092, 2, 16, NULL, NULL),
(1093, 2, 26, NULL, NULL),
(1094, 2, 27, NULL, NULL),
(1095, 2, 52, NULL, NULL),
(1096, 2, 28, NULL, NULL),
(1097, 2, 29, NULL, NULL),
(1098, 2, 37, NULL, NULL),
(1099, 2, 38, NULL, NULL),
(1100, 2, 39, NULL, NULL),
(1101, 2, 40, NULL, NULL),
(1102, 2, 43, NULL, NULL),
(1103, 2, 44, NULL, NULL),
(1104, 2, 45, NULL, NULL),
(1105, 2, 46, NULL, NULL),
(1106, 2, 57, NULL, NULL),
(1107, 2, 58, NULL, NULL),
(1108, 2, 59, NULL, NULL),
(1109, 2, 49, NULL, NULL),
(1110, 2, 30, NULL, NULL),
(1111, 2, 5, NULL, NULL),
(1112, 2, 50, NULL, NULL),
(1113, 2, 53, NULL, NULL),
(1114, 2, 54, NULL, NULL),
(1115, 2, 55, NULL, NULL),
(1116, 2, 56, NULL, NULL),
(1117, 2, 51, NULL, NULL),
(1118, 4, 1, NULL, NULL),
(1119, 4, 2, NULL, NULL),
(1120, 4, 3, NULL, NULL),
(1121, 4, 4, NULL, NULL),
(1122, 4, 11, NULL, NULL),
(1123, 4, 12, NULL, NULL),
(1124, 4, 13, NULL, NULL),
(1125, 4, 31, NULL, NULL),
(1126, 4, 17, NULL, NULL),
(1127, 4, 22, NULL, NULL),
(1128, 4, 24, NULL, NULL),
(1129, 4, 34, NULL, NULL),
(1130, 4, 35, NULL, NULL),
(1131, 4, 36, NULL, NULL),
(1132, 4, 16, NULL, NULL),
(1133, 4, 26, NULL, NULL),
(1134, 4, 27, NULL, NULL),
(1135, 4, 52, NULL, NULL),
(1136, 4, 28, NULL, NULL),
(1137, 4, 29, NULL, NULL),
(1138, 4, 37, NULL, NULL),
(1139, 4, 38, NULL, NULL),
(1140, 4, 39, NULL, NULL),
(1141, 4, 40, NULL, NULL),
(1142, 4, 43, NULL, NULL),
(1143, 4, 44, NULL, NULL),
(1144, 4, 45, NULL, NULL),
(1145, 4, 46, NULL, NULL),
(1146, 4, 57, NULL, NULL),
(1147, 4, 58, NULL, NULL),
(1148, 4, 59, NULL, NULL),
(1149, 4, 50, NULL, NULL),
(1150, 4, 53, NULL, NULL),
(1151, 4, 54, NULL, NULL),
(1152, 4, 55, NULL, NULL),
(1153, 4, 56, NULL, NULL),
(1154, 4, 51, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `profiles`
--

CREATE TABLE `profiles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `company_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `profiles`
--

INSERT INTO `profiles` (`id`, `user_id`, `phone`, `company_name`, `address`, `created_at`, `updated_at`) VALUES
(1, 1, '01733333333', 'Acquaint Technologies', NULL, '2020-01-30 21:02:13', '2020-01-30 21:02:13'),
(2, 10, '01813939785', 'Manager-Ticketing & Reservation', NULL, '2020-12-05 07:45:33', '2020-12-05 07:45:33');

-- --------------------------------------------------------

--
-- Table structure for table `service_types`
--

CREATE TABLE `service_types` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `service_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1 COMMENT '0=Inactive | 1=Active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `service_types`
--

INSERT INTO `service_types` (`id`, `service_type`, `description`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Hajj', NULL, 1, '2020-02-13 03:49:04', '2020-02-13 03:49:04'),
(2, 'Omra Hajj', NULL, 1, '2020-02-13 03:49:04', '2020-02-13 03:49:04'),
(3, 'Ticketing', NULL, 1, '2020-02-13 03:49:04', '2020-02-13 03:49:04'),
(4, 'Visa', NULL, 1, '2020-02-13 03:49:04', '2020-02-13 03:49:04'),
(5, 'Others', NULL, 1, '2020-02-13 03:49:04', '2020-02-13 03:49:04');

-- --------------------------------------------------------

--
-- Table structure for table `ticketing_airlines`
--

CREATE TABLE `ticketing_airlines` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `airlines_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `airlines_code` varchar(2) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ticketing_serial` varchar(3) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'IATA/NON IATA',
  `status` tinyint(4) NOT NULL DEFAULT 1 COMMENT '0=Inactive | 1=Active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ticketing_airlines`
--

INSERT INTO `ticketing_airlines` (`id`, `airlines_name`, `airlines_code`, `ticketing_serial`, `type`, `status`, `created_at`, `updated_at`) VALUES
(2, 'VIRGIN ATLANTIC', 'VS', '932', 'IATA', 1, NULL, NULL),
(4, 'AIR INDIA LTD', 'AI', '98', 'IATA', 1, NULL, NULL),
(5, 'BIMAN BANGLADESH', 'BG', '997', 'IATA', 1, NULL, NULL),
(6, 'CATHAY PACIFIC AIRWAYS', 'CX', '160', 'IATA', 1, NULL, NULL),
(7, 'CHINA SOUTHERN AIRLINES', 'CZ', '784', 'IATA', 1, NULL, NULL),
(8, 'EMIRATES AIRLINE', 'EK', '176', 'IATA', 1, NULL, NULL),
(9, 'ETIHAD AIRWAYS', 'EY', '607', 'IATA', 1, NULL, NULL),
(10, 'KUWAIT AIRWAYS', 'KU', '229', 'IATA', 1, NULL, NULL),
(11, 'MALAYSIA AIRLINES', 'MH', '232', 'IATA', 1, NULL, NULL),
(12, 'CHINA EASTERN AIRLINES', 'MU', '781', 'IATA', 1, NULL, NULL),
(13, 'QATAR AIRWAY', 'QR', '157', 'IATA', 1, NULL, '2020-12-08 06:24:28'),
(14, 'SINGAPORE AIRLINES', 'SQ', '618', 'IATA', 1, NULL, NULL),
(15, 'SAUDI ARABIA AIRLINES', 'SV', '65', 'IATA', 1, NULL, NULL),
(16, 'THAI AIRWAYS', 'TG', '217', 'IATA', 1, NULL, NULL),
(17, 'TURKISH AIRLINES', 'TK', '235', 'IATA', 1, NULL, NULL),
(18, 'OMAN AIR', 'WY', '910', 'IATA', 1, NULL, NULL),
(19, 'JET AIRWAYS', '9W', '589', 'IATA', 1, NULL, NULL),
(20, 'PAKISTAN AIRWAYS', 'PK', '214', 'IATA', 1, NULL, NULL),
(21, 'BANGKOK AIRWAYS', 'PG', '829', 'IATA', 1, NULL, NULL),
(22, 'UNITED AIRWAYS', '4H', '584', 'IATA', 1, NULL, NULL),
(23, 'MIHIN LANKA AIRWAYS', 'MJ', '817', 'IATA', 1, NULL, NULL),
(24, 'REGENT AIRWAYS', 'RX', '652', 'IATA', 1, NULL, NULL),
(25, 'NOVO AIR', 'VQ', '', 'IATA', 1, NULL, NULL),
(26, 'US BANGLA AIRLINES', 'BS', '779', 'IATA', 1, NULL, NULL),
(27, 'MALINDO AIR', 'OD', '816', 'IATA', 1, NULL, NULL),
(28, 'FLY DUBAI', 'FZ', '', 'IATA', 1, NULL, NULL),
(29, 'AIR ARABIA', 'G9', '514', 'IATA', 1, NULL, NULL),
(30, 'AIR ASIA', 'AK', '', 'IATA', 1, NULL, NULL),
(31, 'TIGER AIRWAYS', 'TR', '', 'IATA', 1, NULL, NULL),
(32, 'GULF AIR', 'GF', '72', 'IATA', 1, NULL, NULL),
(33, 'AMERICAN AIRLINES INC.', 'AA', '1', 'IATA', 1, NULL, NULL),
(34, 'AIR CANADA', 'AC', '14', 'IATA', 1, NULL, NULL),
(35, 'ALITALIA-COMPAGNIA AEREA ITALIANA S.P.', 'AZ', '55', 'IATA', 1, NULL, NULL),
(36, 'AIR FRANCE', 'AF', '57', 'IATA', 1, NULL, NULL),
(37, 'AIR CALEDONIE INTERNATIONAL', 'SB', '63', 'IATA', 1, NULL, NULL),
(38, 'AIR NEW ZEALAND LTD.', 'NZ', '86', 'IATA', 1, NULL, NULL),
(39, 'AEROMEXICO', 'AM', '139', 'IATA', 1, NULL, NULL),
(40, 'ALL NIPPON AIRWAYS CO., LTD.', 'NH', '205', 'IATA', 1, NULL, NULL),
(41, 'AIR TAHITI NUI', 'TN', '244', 'IATA', 1, NULL, NULL),
(42, 'AUSTRIAN AIRLINES AG', 'OS', '257', 'IATA', 1, NULL, NULL),
(43, 'AIR PACIFIC', 'FJ', '260', 'IATA', 1, NULL, NULL),
(44, 'AHK AIR HONG KONG LTD.', 'LD', '288', 'IATA', 1, NULL, NULL),
(45, 'AEROFLOT RUSSIAN AIRLINES', 'SU', '555', 'IATA', 1, NULL, NULL),
(46, 'AIR NIUGINI PTY LTD.', 'PX', '656', 'IATA', 1, NULL, NULL),
(47, 'AIR NIPPON CO., LTD.', 'EL', '768', 'IATA', 1, NULL, NULL),
(48, 'ASIANA AIRLINES INC.', 'OZ', '988', 'IATA', 1, NULL, NULL),
(49, 'AIR CHINA LTD.', 'CA', '999', 'IATA', 1, NULL, NULL),
(50, 'BRITISH AIRWAYS P.L.C.', 'BA', '125', 'IATA', 1, NULL, NULL),
(51, 'CONTINENTAL AIRLINES, INC.', 'CO', '5', 'IATA', 1, NULL, NULL),
(52, 'CARGOLUX AIRLINES INTâ€™L S.A.', 'CV', '172', 'IATA', 1, NULL, NULL),
(53, 'CHINA AIRLINES LTD', 'CI', '297', 'IATA', 1, NULL, NULL),
(54, 'CHINA EASTERN AIRLINES', 'MU', '781', 'IATA', 1, NULL, NULL),
(55, 'DELTA AIR LINES, INC.', 'DL', '6', 'IATA', 1, NULL, NULL),
(56, 'DALAVIA FAR EAST AIRWAYS', 'H8', '560', 'IATA', 1, NULL, NULL),
(57, 'EGYPTAIR', 'MS', '77', 'IATA', 1, NULL, NULL),
(58, 'EMIRATES SKY CARGO', 'EK', '176', 'IATA', 1, NULL, NULL),
(59, 'EVA AIRWAYS CORP.', 'BR', '695', 'IATA', 1, NULL, NULL),
(60, 'FEDEX', 'FX', '23', 'IATA', 1, NULL, NULL),
(61, 'FINNAIR O/Y', 'AY', '105', 'IATA', 1, NULL, NULL),
(62, 'GARUDA INDONESIA', 'GA', '126', 'IATA', 1, NULL, NULL),
(63, 'HONG KONG DRAGON AIRLINES LIMITED.', 'KA', '43', 'IATA', 1, NULL, NULL),
(64, 'IRAN-AIR', 'IR', '96', 'IATA', 1, NULL, NULL),
(65, 'JAPAN AIRLINES CO. LTD', 'JL', '131', 'IATA', 1, NULL, NULL),
(66, 'JAPAN ASIA AIRWAYS CO., LTD.', 'EG', '688', 'IATA', 1, NULL, NULL),
(67, 'KLM ROYAL DUTCH AIRLINES', 'KL', '74', 'IATA', 1, NULL, NULL),
(68, 'KOREAN AIR LINES CO.,LTD.', 'KE', '180', 'IATA', 1, NULL, NULL),
(69, 'LUFTHANSA CARGO AG.', 'LH', '20', 'IATA', 1, NULL, NULL),
(70, 'MALAYSIA AIRLINES SYSTEM BERHAD', 'MH', '232', 'IATA', 1, NULL, NULL),
(71, 'MIAT-MONGOLIAN AIRLINES', 'OM', '289', 'IATA', 1, NULL, NULL),
(72, 'NORTHWEST AIRLINES, INC.', 'NW', '12', 'IATA', 1, NULL, NULL),
(73, 'NIPPON CARGO AIRLINES', 'KZ', '933', 'IATA', 1, NULL, NULL),
(74, 'PHILIPPINE AIRLINES, INC.', 'PR', '79', 'IATA', 1, NULL, NULL),
(75, 'PAKISTAN INTâ€™L AIRLINES', 'PK', '214', 'IATA', 1, NULL, NULL),
(76, 'POLAR AIR CARGO INC.', 'PO', '403', 'IATA', 1, NULL, NULL),
(77, 'ROYAL NEPAL AIRLINES CORP.', 'RA', '285', 'IATA', 1, NULL, NULL),
(78, 'SCANDINAVIAN AIRLINES SYSTEM(SAS)', 'SK', '117', 'IATA', 1, NULL, NULL),
(79, 'SRILANKAN AIRLINES LTD.', 'UL', '603', 'IATA', 1, NULL, NULL),
(80, 'SWISS INTâ€™L AIR LINES LTD.', 'LX', '724', 'IATA', 1, NULL, NULL),
(81, 'SHANGHAI AIRLINES CO., LTD.', 'FM', '774', 'IATA', 1, NULL, NULL),
(82, 'THAI AIRWAYS INTâ€™L PUBLIC CO.,LTD.', 'TG', '217', 'IATA', 1, NULL, NULL),
(83, 'UNITED AIRLINES, INC.', 'UA', '16', 'IATA', 1, NULL, NULL),
(84, 'UZBEKISTAN AIRWAYS', 'HY', '250', 'IATA', 1, NULL, NULL),
(85, 'UNITED PARCEL', '5X', '406', 'IATA', 1, NULL, NULL),
(86, 'VIETNAM AIRLINES', 'VN', '738', 'IATA', 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `ticket_refunds`
--

CREATE TABLE `ticket_refunds` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `ticket_sale_id` bigint(20) UNSIGNED NOT NULL,
  `refund_amount` decimal(10,2) NOT NULL DEFAULT 0.00,
  `refund_user_id` bigint(20) UNSIGNED NOT NULL,
  `refund_date` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ticket_sales`
--

CREATE TABLE `ticket_sales` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `ticketing_airline_id` bigint(20) UNSIGNED NOT NULL,
  `ticket_no` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `passenger_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sector` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `flight_date` date NOT NULL,
  `class` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pax_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount_sales` decimal(8,2) DEFAULT NULL,
  `fare_amount` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `commission` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `farecommission` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tax` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ait` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fare_tax` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `service_charge` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `total` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `invoice_no` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sales_date` date NOT NULL,
  `sales_by` bigint(20) UNSIGNED DEFAULT NULL,
  `sales_user_address` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ticket_sales`
--

INSERT INTO `ticket_sales` (`id`, `ticketing_airline_id`, `ticket_no`, `passenger_name`, `sector`, `flight_date`, `class`, `pax_type`, `amount_sales`, `fare_amount`, `commission`, `farecommission`, `tax`, `ait`, `fare_tax`, `service_charge`, `total`, `invoice_no`, `sales_date`, `sales_by`, `sales_user_address`, `created_at`, `updated_at`) VALUES
(5, 2, '1573754133128', 'ALI/AHMAD MR', 'DAC/JED/MED/DAC', '2021-01-06', 'E', 'ADULT', '21000.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '01', '2020-12-15', 4, '330, Weat Jurain, Mazar Sharif, West Gate (Chistiya Tower)\r\nDhaka-1204.', '2020-12-05 06:16:48', '2020-12-05 06:16:48'),
(6, 10, '01911160', 'safi', '1', '2020-12-25', '1', '01', '12000.00', '2000', '10', '200', '500', '5', '125', '80', '2905', '1', '2020-12-23', 5, 'mohanagar project', '2020-12-23 10:00:17', '2020-12-24 10:05:35'),
(9, 5, '01521100', 'safi ul sahid', '2', '2020-12-25', '2', '02', NULL, '1000', '50', '500', '1000', '50', '1000', '250', '3750', '2', '2020-12-24', 5, 'mohanagar project', '2020-12-24 05:07:32', '2020-12-24 10:05:12');

-- --------------------------------------------------------

--
-- Table structure for table `upazilas`
--

CREATE TABLE `upazilas` (
  `id` int(3) NOT NULL,
  `district_id` int(2) NOT NULL,
  `name` varchar(25) NOT NULL,
  `bn_name` varchar(25) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `upazilas`
--

INSERT INTO `upazilas` (`id`, `district_id`, `name`, `bn_name`) VALUES
(1, 1, 'Debidwar', 'দেবিদ্বার'),
(2, 1, 'Barura', 'বরুড়া'),
(3, 1, 'Brahmanpara', 'ব্রাহ্মণপাড়া'),
(4, 1, 'Chandina', 'চান্দিনা'),
(5, 1, 'Chauddagram', 'চৌদ্দগ্রাম'),
(6, 1, 'Daudkandi', 'দাউদকান্দি'),
(7, 1, 'Homna', 'হোমনা'),
(8, 1, 'Laksam', 'লাকসাম'),
(9, 1, 'Muradnagar', 'মুরাদনগর'),
(10, 1, 'Nangalkot', 'নাঙ্গলকোট'),
(11, 1, 'Comilla Sadar', 'কুমিল্লা সদর'),
(12, 1, 'Meghna', 'মেঘনা'),
(13, 1, 'Monohargonj', 'মনোহরগঞ্জ'),
(14, 1, 'Sadarsouth', 'সদর দক্ষিণ'),
(15, 1, 'Titas', 'তিতাস'),
(16, 1, 'Burichang', 'বুড়িচং'),
(17, 1, 'Lalmai', 'লালমাই'),
(18, 2, 'Chhagalnaiya', 'ছাগলনাইয়া'),
(19, 2, 'Feni Sadar', 'ফেনী সদর'),
(20, 2, 'Sonagazi', 'সোনাগাজী'),
(21, 2, 'Fulgazi', 'ফুলগাজী'),
(22, 2, 'Parshuram', 'পরশুরাম'),
(23, 2, 'Daganbhuiyan', 'দাগনভূঞা'),
(24, 3, 'Brahmanbaria Sadar', 'ব্রাহ্মণবাড়িয়া সদর'),
(25, 3, 'Kasba', 'কসবা'),
(26, 3, 'Nasirnagar', 'নাসিরনগর'),
(27, 3, 'Sarail', 'সরাইল'),
(28, 3, 'Ashuganj', 'আশুগঞ্জ'),
(29, 3, 'Akhaura', 'আখাউড়া'),
(30, 3, 'Nabinagar', 'নবীনগর'),
(31, 3, 'Bancharampur', 'বাঞ্ছারামপুর'),
(32, 3, 'Bijoynagar', 'বিজয়নগর'),
(33, 4, 'Rangamati Sadar', 'রাঙ্গামাটি সদর'),
(34, 4, 'Kaptai', 'কাপ্তাই'),
(35, 4, 'Kawkhali', 'কাউখালী'),
(36, 4, 'Baghaichari', 'বাঘাইছড়ি'),
(37, 4, 'Barkal', 'বরকল'),
(38, 4, 'Langadu', 'লংগদু'),
(39, 4, 'Rajasthali', 'রাজস্থলী'),
(40, 4, 'Belaichari', 'বিলাইছড়ি'),
(41, 4, 'Juraichari', 'জুরাছড়ি'),
(42, 4, 'Naniarchar', 'নানিয়ারচর'),
(43, 5, 'Noakhali Sadar', 'নোয়াখালী সদর'),
(44, 5, 'Companiganj', 'কোম্পানীগঞ্জ'),
(45, 5, 'Begumganj', 'বেগমগঞ্জ'),
(46, 5, 'Hatia', 'হাতিয়া'),
(47, 5, 'Subarnachar', 'সুবর্ণচর'),
(48, 5, 'Kabirhat', 'কবিরহাট'),
(49, 5, 'Senbug', 'সেনবাগ'),
(50, 5, 'Chatkhil', 'চাটখিল'),
(51, 5, 'Sonaimori', 'সোনাইমুড়ী'),
(52, 6, 'Haimchar', 'হাইমচর'),
(53, 6, 'Kachua', 'কচুয়া'),
(54, 6, 'Shahrasti', 'শাহরাস্তি	'),
(55, 6, 'Chandpur Sadar', 'চাঁদপুর সদর'),
(56, 6, 'Matlab South', 'মতলব দক্ষিণ'),
(57, 6, 'Hajiganj', 'হাজীগঞ্জ'),
(58, 6, 'Matlab North', 'মতলব উত্তর'),
(59, 6, 'Faridgonj', 'ফরিদগঞ্জ'),
(60, 7, 'Lakshmipur Sadar', 'লক্ষ্মীপুর সদর'),
(61, 7, 'Kamalnagar', 'কমলনগর'),
(62, 7, 'Raipur', 'রায়পুর'),
(63, 7, 'Ramgati', 'রামগতি'),
(64, 7, 'Ramganj', 'রামগঞ্জ'),
(65, 8, 'Rangunia', 'রাঙ্গুনিয়া'),
(66, 8, 'Sitakunda', 'সীতাকুন্ড'),
(67, 8, 'Mirsharai', 'মীরসরাই'),
(68, 8, 'Patiya', 'পটিয়া'),
(69, 8, 'Sandwip', 'সন্দ্বীপ'),
(70, 8, 'Banshkhali', 'বাঁশখালী'),
(71, 8, 'Boalkhali', 'বোয়ালখালী'),
(72, 8, 'Anwara', 'আনোয়ারা'),
(73, 8, 'Chandanaish', 'চন্দনাইশ'),
(74, 8, 'Satkania', 'সাতকানিয়া'),
(75, 8, 'Lohagara', 'লোহাগাড়া'),
(76, 8, 'Hathazari', 'হাটহাজারী'),
(77, 8, 'Fatikchhari', 'ফটিকছড়ি'),
(78, 8, 'Raozan', 'রাউজান'),
(79, 8, 'Karnafuli', 'কর্ণফুলী'),
(80, 9, 'Coxsbazar Sadar', 'কক্সবাজার সদর'),
(81, 9, 'Chakaria', 'চকরিয়া'),
(82, 9, 'Kutubdia', 'কুতুবদিয়া'),
(83, 9, 'Ukhiya', 'উখিয়া'),
(84, 9, 'Moheshkhali', 'মহেশখালী'),
(85, 9, 'Pekua', 'পেকুয়া'),
(86, 9, 'Ramu', 'রামু'),
(87, 9, 'Teknaf', 'টেকনাফ'),
(88, 10, 'Khagrachhari Sadar', 'খাগড়াছড়ি সদর'),
(89, 10, 'Dighinala', 'দিঘীনালা'),
(90, 10, 'Panchari', 'পানছড়ি'),
(91, 10, 'Laxmichhari', 'লক্ষীছড়ি'),
(92, 10, 'Mohalchari', 'মহালছড়ি'),
(93, 10, 'Manikchari', 'মানিকছড়ি'),
(94, 10, 'Ramgarh', 'রামগড়'),
(95, 10, 'Matiranga', 'মাটিরাঙ্গা'),
(96, 10, 'Guimara', 'গুইমারা'),
(97, 11, 'Bandarban Sadar', 'বান্দরবান সদর'),
(98, 11, 'Alikadam', 'আলীকদম'),
(99, 11, 'Naikhongchhari', 'নাইক্ষ্যংছড়ি'),
(100, 11, 'Rowangchhari', 'রোয়াংছড়ি'),
(101, 11, 'Lama', 'লামা'),
(102, 11, 'Ruma', 'রুমা'),
(103, 11, 'Thanchi', 'থানচি'),
(104, 12, 'Belkuchi', 'বেলকুচি'),
(105, 12, 'Chauhali', 'চৌহালি'),
(106, 12, 'Kamarkhand', 'কামারখন্দ'),
(107, 12, 'Kazipur', 'কাজীপুর'),
(108, 12, 'Raigonj', 'রায়গঞ্জ'),
(109, 12, 'Shahjadpur', 'শাহজাদপুর'),
(110, 12, 'Sirajganj Sadar', 'সিরাজগঞ্জ সদর'),
(111, 12, 'Tarash', 'তাড়াশ'),
(112, 12, 'Ullapara', 'উল্লাপাড়া'),
(113, 13, 'Sujanagar', 'সুজানগর'),
(114, 13, 'Ishurdi', 'ঈশ্বরদী'),
(115, 13, 'Bhangura', 'ভাঙ্গুড়া'),
(116, 13, 'Pabna Sadar', 'পাবনা সদর'),
(117, 13, 'Bera', 'বেড়া'),
(118, 13, 'Atghoria', 'আটঘরিয়া'),
(119, 13, 'Chatmohar', 'চাটমোহর'),
(120, 13, 'Santhia', 'সাঁথিয়া'),
(121, 13, 'Faridpur', 'ফরিদপুর'),
(122, 14, 'Kahaloo', 'কাহালু'),
(123, 14, 'Bogra Sadar', 'বগুড়া সদর'),
(124, 14, 'Shariakandi', 'সারিয়াকান্দি'),
(125, 14, 'Shajahanpur', 'শাজাহানপুর'),
(126, 14, 'Dupchanchia', 'দুপচাচিঁয়া'),
(127, 14, 'Adamdighi', 'আদমদিঘি'),
(128, 14, 'Nondigram', 'নন্দিগ্রাম'),
(129, 14, 'Sonatala', 'সোনাতলা'),
(130, 14, 'Dhunot', 'ধুনট'),
(131, 14, 'Gabtali', 'গাবতলী'),
(132, 14, 'Sherpur', 'শেরপুর'),
(133, 14, 'Shibganj', 'শিবগঞ্জ'),
(134, 15, 'Paba', 'পবা'),
(135, 15, 'Durgapur', 'দুর্গাপুর'),
(136, 15, 'Mohonpur', 'মোহনপুর'),
(137, 15, 'Charghat', 'চারঘাট'),
(138, 15, 'Puthia', 'পুঠিয়া'),
(139, 15, 'Bagha', 'বাঘা'),
(140, 15, 'Godagari', 'গোদাগাড়ী'),
(141, 15, 'Tanore', 'তানোর'),
(142, 15, 'Bagmara', 'বাগমারা'),
(143, 16, 'Natore Sadar', 'নাটোর সদর'),
(144, 16, 'Singra', 'সিংড়া'),
(145, 16, 'Baraigram', 'বড়াইগ্রাম'),
(146, 16, 'Bagatipara', 'বাগাতিপাড়া'),
(147, 16, 'Lalpur', 'লালপুর'),
(148, 16, 'Gurudaspur', 'গুরুদাসপুর'),
(149, 16, 'Naldanga', 'নলডাঙ্গা'),
(150, 17, 'Akkelpur', 'আক্কেলপুর'),
(151, 17, 'Kalai', 'কালাই'),
(152, 17, 'Khetlal', 'ক্ষেতলাল'),
(153, 17, 'Panchbibi', 'পাঁচবিবি'),
(154, 17, 'Joypurhat Sadar', 'জয়পুরহাট সদর'),
(155, 18, 'Chapainawabganj Sadar', 'চাঁপাইনবাবগঞ্জ সদর'),
(156, 18, 'Gomostapur', 'গোমস্তাপুর'),
(157, 18, 'Nachol', 'নাচোল'),
(158, 18, 'Bholahat', 'ভোলাহাট'),
(159, 18, 'Shibganj', 'শিবগঞ্জ'),
(160, 19, 'Mohadevpur', 'মহাদেবপুর'),
(161, 19, 'Badalgachi', 'বদলগাছী'),
(162, 19, 'Patnitala', 'পত্নিতলা'),
(163, 19, 'Dhamoirhat', 'ধামইরহাট'),
(164, 19, 'Niamatpur', 'নিয়ামতপুর'),
(165, 19, 'Manda', 'মান্দা'),
(166, 19, 'Atrai', 'আত্রাই'),
(167, 19, 'Raninagar', 'রাণীনগর'),
(168, 19, 'Naogaon Sadar', 'নওগাঁ সদর'),
(169, 19, 'Porsha', 'পোরশা'),
(170, 19, 'Sapahar', 'সাপাহার'),
(171, 20, 'Manirampur', 'মণিরামপুর'),
(172, 20, 'Abhaynagar', 'অভয়নগর'),
(173, 20, 'Bagherpara', 'বাঘারপাড়া'),
(174, 20, 'Chougachha', 'চৌগাছা'),
(175, 20, 'Jhikargacha', 'ঝিকরগাছা'),
(176, 20, 'Keshabpur', 'কেশবপুর'),
(177, 20, 'Jessore Sadar', 'যশোর সদর'),
(178, 20, 'Sharsha', 'শার্শা'),
(179, 21, 'Assasuni', 'আশাশুনি'),
(180, 21, 'Debhata', 'দেবহাটা'),
(181, 21, 'Kalaroa', 'কলারোয়া'),
(182, 21, 'Satkhira Sadar', 'সাতক্ষীরা সদর'),
(183, 21, 'Shyamnagar', 'শ্যামনগর'),
(184, 21, 'Tala', 'তালা'),
(185, 21, 'Kaliganj', 'কালিগঞ্জ'),
(186, 22, 'Mujibnagar', 'মুজিবনগর'),
(187, 22, 'Meherpur Sadar', 'মেহেরপুর সদর'),
(188, 22, 'Gangni', 'গাংনী'),
(189, 23, 'Narail Sadar', 'নড়াইল সদর'),
(190, 23, 'Lohagara', 'লোহাগড়া'),
(191, 23, 'Kalia', 'কালিয়া'),
(192, 24, 'Chuadanga Sadar', 'চুয়াডাঙ্গা সদর'),
(193, 24, 'Alamdanga', 'আলমডাঙ্গা'),
(194, 24, 'Damurhuda', 'দামুড়হুদা'),
(195, 24, 'Jibannagar', 'জীবননগর'),
(196, 25, 'Kushtia Sadar', 'কুষ্টিয়া সদর'),
(197, 25, 'Kumarkhali', 'কুমারখালী'),
(198, 25, 'Khoksa', 'খোকসা'),
(199, 25, 'Mirpur', 'মিরপুর'),
(200, 25, 'Daulatpur', 'দৌলতপুর'),
(201, 25, 'Bheramara', 'ভেড়ামারা'),
(202, 26, 'Shalikha', 'শালিখা'),
(203, 26, 'Sreepur', 'শ্রীপুর'),
(204, 26, 'Magura Sadar', 'মাগুরা সদর'),
(205, 26, 'Mohammadpur', 'মহম্মদপুর'),
(206, 27, 'Paikgasa', 'পাইকগাছা'),
(207, 27, 'Fultola', 'ফুলতলা'),
(208, 27, 'Digholia', 'দিঘলিয়া'),
(209, 27, 'Rupsha', 'রূপসা'),
(210, 27, 'Terokhada', 'তেরখাদা'),
(211, 27, 'Dumuria', 'ডুমুরিয়া'),
(212, 27, 'Botiaghata', 'বটিয়াঘাটা'),
(213, 27, 'Dakop', 'দাকোপ'),
(214, 27, 'Koyra', 'কয়রা'),
(215, 28, 'Fakirhat', 'ফকিরহাট'),
(216, 28, 'Bagerhat Sadar', 'বাগেরহাট সদর'),
(217, 28, 'Mollahat', 'মোল্লাহাট'),
(218, 28, 'Sarankhola', 'শরণখোলা'),
(219, 28, 'Rampal', 'রামপাল'),
(220, 28, 'Morrelganj', 'মোড়েলগঞ্জ'),
(221, 28, 'Kachua', 'কচুয়া'),
(222, 28, 'Mongla', 'মোংলা'),
(223, 28, 'Chitalmari', 'চিতলমারী'),
(224, 29, 'Jhenaidah Sadar', 'ঝিনাইদহ সদর'),
(225, 29, 'Shailkupa', 'শৈলকুপা'),
(226, 29, 'Harinakundu', 'হরিণাকুন্ডু'),
(227, 29, 'Kaliganj', 'কালীগঞ্জ'),
(228, 29, 'Kotchandpur', 'কোটচাঁদপুর'),
(229, 29, 'Moheshpur', 'মহেশপুর'),
(230, 30, 'Jhalakathi Sadar', 'ঝালকাঠি সদর'),
(231, 30, 'Kathalia', 'কাঠালিয়া'),
(232, 30, 'Nalchity', 'নলছিটি'),
(233, 30, 'Rajapur', 'রাজাপুর'),
(234, 31, 'Bauphal', 'বাউফল'),
(235, 31, 'Patuakhali Sadar', 'পটুয়াখালী সদর'),
(236, 31, 'Dumki', 'দুমকি'),
(237, 31, 'Dashmina', 'দশমিনা'),
(238, 31, 'Kalapara', 'কলাপাড়া'),
(239, 31, 'Mirzaganj', 'মির্জাগঞ্জ'),
(240, 31, 'Galachipa', 'গলাচিপা'),
(241, 31, 'Rangabali', 'রাঙ্গাবালী'),
(242, 32, 'Pirojpur Sadar', 'পিরোজপুর সদর'),
(243, 32, 'Nazirpur', 'নাজিরপুর'),
(244, 32, 'Kawkhali', 'কাউখালী'),
(245, 32, 'Zianagar', 'জিয়ানগর'),
(246, 32, 'Bhandaria', 'ভান্ডারিয়া'),
(247, 32, 'Mathbaria', 'মঠবাড়ীয়া'),
(248, 32, 'Nesarabad', 'নেছারাবাদ'),
(249, 33, 'Barisal Sadar', 'বরিশাল সদর'),
(250, 33, 'Bakerganj', 'বাকেরগঞ্জ'),
(251, 33, 'Babuganj', 'বাবুগঞ্জ'),
(252, 33, 'Wazirpur', 'উজিরপুর'),
(253, 33, 'Banaripara', 'বানারীপাড়া'),
(254, 33, 'Gournadi', 'গৌরনদী'),
(255, 33, 'Agailjhara', 'আগৈলঝাড়া'),
(256, 33, 'Mehendiganj', 'মেহেন্দিগঞ্জ'),
(257, 33, 'Muladi', 'মুলাদী'),
(258, 33, 'Hizla', 'হিজলা'),
(259, 34, 'Bhola Sadar', 'ভোলা সদর'),
(260, 34, 'Borhan Sddin', 'বোরহান উদ্দিন'),
(261, 34, 'Charfesson', 'চরফ্যাশন'),
(262, 34, 'Doulatkhan', 'দৌলতখান'),
(263, 34, 'Monpura', 'মনপুরা'),
(264, 34, 'Tazumuddin', 'তজুমদ্দিন'),
(265, 34, 'Lalmohan', 'লালমোহন'),
(266, 35, 'Amtali', 'আমতলী'),
(267, 35, 'Barguna Sadar', 'বরগুনা সদর'),
(268, 35, 'Betagi', 'বেতাগী'),
(269, 35, 'Bamna', 'বামনা'),
(270, 35, 'Pathorghata', 'পাথরঘাটা'),
(271, 35, 'Taltali', 'তালতলি'),
(272, 36, 'Balaganj', 'বালাগঞ্জ'),
(273, 36, 'Beanibazar', 'বিয়ানীবাজার'),
(274, 36, 'Bishwanath', 'বিশ্বনাথ'),
(275, 36, 'Companiganj', 'কোম্পানীগঞ্জ'),
(276, 36, 'Fenchuganj', 'ফেঞ্চুগঞ্জ'),
(277, 36, 'Golapganj', 'গোলাপগঞ্জ'),
(278, 36, 'Gowainghat', 'গোয়াইনঘাট'),
(279, 36, 'Jaintiapur', 'জৈন্তাপুর'),
(280, 36, 'Kanaighat', 'কানাইঘাট'),
(281, 36, 'Sylhet Sadar', 'সিলেট সদর'),
(282, 36, 'Zakiganj', 'জকিগঞ্জ'),
(283, 36, 'Dakshinsurma', 'দক্ষিণ সুরমা'),
(284, 36, 'Osmaninagar', 'ওসমানী নগর'),
(285, 37, 'Barlekha', 'বড়লেখা'),
(286, 37, 'Kamolganj', 'কমলগঞ্জ'),
(287, 37, 'Kulaura', 'কুলাউড়া'),
(288, 37, 'Moulvibazar Sadar', 'মৌলভীবাজার সদর'),
(289, 37, 'Rajnagar', 'রাজনগর'),
(290, 37, 'Sreemangal', 'শ্রীমঙ্গল'),
(291, 37, 'Juri', 'জুড়ী'),
(292, 38, 'Nabiganj', 'নবীগঞ্জ'),
(293, 38, 'Bahubal', 'বাহুবল'),
(294, 38, 'Ajmiriganj', 'আজমিরীগঞ্জ'),
(295, 38, 'Baniachong', 'বানিয়াচং'),
(296, 38, 'Lakhai', 'লাখাই'),
(297, 38, 'Chunarughat', 'চুনারুঘাট'),
(298, 38, 'Habiganj Sadar', 'হবিগঞ্জ সদর'),
(299, 38, 'Madhabpur', 'মাধবপুর'),
(300, 39, 'Sunamganj Sadar', 'সুনামগঞ্জ সদর'),
(301, 39, 'South Sunamganj', 'দক্ষিণ সুনামগঞ্জ'),
(302, 39, 'Bishwambarpur', 'বিশ্বম্ভরপুর'),
(303, 39, 'Chhatak', 'ছাতক'),
(304, 39, 'Jagannathpur', 'জগন্নাথপুর'),
(305, 39, 'Dowarabazar', 'দোয়ারাবাজার'),
(306, 39, 'Tahirpur', 'তাহিরপুর'),
(307, 39, 'Dharmapasha', 'ধর্মপাশা'),
(308, 39, 'Jamalganj', 'জামালগঞ্জ'),
(309, 39, 'Shalla', 'শাল্লা'),
(310, 39, 'Derai', 'দিরাই'),
(311, 40, 'Belabo', 'বেলাবো'),
(312, 40, 'Monohardi', 'মনোহরদী'),
(313, 40, 'Narsingdi Sadar', 'নরসিংদী সদর'),
(314, 40, 'Palash', 'পলাশ'),
(315, 40, 'Raipura', 'রায়পুরা'),
(316, 40, 'Shibpur', 'শিবপুর'),
(317, 41, 'Kaliganj', 'কালীগঞ্জ'),
(318, 41, 'Kaliakair', 'কালিয়াকৈর'),
(319, 41, 'Kapasia', 'কাপাসিয়া'),
(320, 41, 'Gazipur Sadar', 'গাজীপুর সদর'),
(321, 41, 'Sreepur', 'শ্রীপুর'),
(322, 42, 'Shariatpur Sadar', 'শরিয়তপুর সদর'),
(323, 42, 'Naria', 'নড়িয়া'),
(324, 42, 'Zajira', 'জাজিরা'),
(325, 42, 'Gosairhat', 'গোসাইরহাট'),
(326, 42, 'Bhedarganj', 'ভেদরগঞ্জ'),
(327, 42, 'Damudya', 'ডামুড্যা'),
(328, 43, 'Araihazar', 'আড়াইহাজার'),
(329, 43, 'Bandar', 'বন্দর'),
(330, 43, 'Narayanganj Sadar', 'নারায়নগঞ্জ সদর'),
(331, 43, 'Rupganj', 'রূপগঞ্জ'),
(332, 43, 'Sonargaon', 'সোনারগাঁ'),
(333, 44, 'Basail', 'বাসাইল'),
(334, 44, 'Bhuapur', 'ভুয়াপুর'),
(335, 44, 'Delduar', 'দেলদুয়ার'),
(336, 44, 'Ghatail', 'ঘাটাইল'),
(337, 44, 'Gopalpur', 'গোপালপুর'),
(338, 44, 'Madhupur', 'মধুপুর'),
(339, 44, 'Mirzapur', 'মির্জাপুর'),
(340, 44, 'Nagarpur', 'নাগরপুর'),
(341, 44, 'Sakhipur', 'সখিপুর'),
(342, 44, 'Tangail Sadar', 'টাঙ্গাইল সদর'),
(343, 44, 'Kalihati', 'কালিহাতী'),
(344, 44, 'Dhanbari', 'ধনবাড়ী'),
(345, 45, 'Itna', 'ইটনা'),
(346, 45, 'Katiadi', 'কটিয়াদী'),
(347, 45, 'Bhairab', 'ভৈরব'),
(348, 45, 'Tarail', 'তাড়াইল'),
(349, 45, 'Hossainpur', 'হোসেনপুর'),
(350, 45, 'Pakundia', 'পাকুন্দিয়া'),
(351, 45, 'Kuliarchar', 'কুলিয়ারচর'),
(352, 45, 'Kishoreganj Sadar', 'কিশোরগঞ্জ সদর'),
(353, 45, 'Karimgonj', 'করিমগঞ্জ'),
(354, 45, 'Bajitpur', 'বাজিতপুর'),
(355, 45, 'Austagram', 'অষ্টগ্রাম'),
(356, 45, 'Mithamoin', 'মিঠামইন'),
(357, 45, 'Nikli', 'নিকলী'),
(358, 46, 'Harirampur', 'হরিরামপুর'),
(359, 46, 'Saturia', 'সাটুরিয়া'),
(360, 46, 'Manikganj Sadar', 'মানিকগঞ্জ সদর'),
(361, 46, 'Gior', 'ঘিওর'),
(362, 46, 'Shibaloy', 'শিবালয়'),
(363, 46, 'Doulatpur', 'দৌলতপুর'),
(364, 46, 'Singiar', 'সিংগাইর'),
(365, 47, 'Savar', 'সাভার'),
(366, 47, 'Dhamrai', 'ধামরাই'),
(367, 47, 'Keraniganj', 'কেরাণীগঞ্জ'),
(368, 47, 'Nawabganj', 'নবাবগঞ্জ'),
(369, 47, 'Dohar', 'দোহার'),
(370, 48, 'Munshiganj Sadar', 'মুন্সিগঞ্জ সদর'),
(371, 48, 'Sreenagar', 'শ্রীনগর'),
(372, 48, 'Sirajdikhan', 'সিরাজদিখান'),
(373, 48, 'Louhajanj', 'লৌহজং'),
(374, 48, 'Gajaria', 'গজারিয়া'),
(375, 48, 'Tongibari', 'টংগীবাড়ি'),
(376, 49, 'Rajbari Sadar', 'রাজবাড়ী সদর'),
(377, 49, 'Goalanda', 'গোয়ালন্দ'),
(378, 49, 'Pangsa', 'পাংশা'),
(379, 49, 'Baliakandi', 'বালিয়াকান্দি'),
(380, 49, 'Kalukhali', 'কালুখালী'),
(381, 50, 'Madaripur Sadar', 'মাদারীপুর সদর'),
(382, 50, 'Shibchar', 'শিবচর'),
(383, 50, 'Kalkini', 'কালকিনি'),
(384, 50, 'Rajoir', 'রাজৈর'),
(385, 51, 'Gopalganj Sadar', 'গোপালগঞ্জ সদর'),
(386, 51, 'Kashiani', 'কাশিয়ানী'),
(387, 51, 'Tungipara', 'টুংগীপাড়া'),
(388, 51, 'Kotalipara', 'কোটালীপাড়া'),
(389, 51, 'Muksudpur', 'মুকসুদপুর'),
(390, 52, 'Faridpur Sadar', 'ফরিদপুর সদর'),
(391, 52, 'Alfadanga', 'আলফাডাঙ্গা'),
(392, 52, 'Boalmari', 'বোয়ালমারী'),
(393, 52, 'Sadarpur', 'সদরপুর'),
(394, 52, 'Nagarkanda', 'নগরকান্দা'),
(395, 52, 'Bhanga', 'ভাঙ্গা'),
(396, 52, 'Charbhadrasan', 'চরভদ্রাসন'),
(397, 52, 'Madhukhali', 'মধুখালী'),
(398, 52, 'Saltha', 'সালথা'),
(399, 53, 'Panchagarh Sadar', 'পঞ্চগড় সদর'),
(400, 53, 'Debiganj', 'দেবীগঞ্জ'),
(401, 53, 'Boda', 'বোদা'),
(402, 53, 'Atwari', 'আটোয়ারী'),
(403, 53, 'Tetulia', 'তেতুলিয়া'),
(404, 54, 'Nawabganj', 'নবাবগঞ্জ'),
(405, 54, 'Birganj', 'বীরগঞ্জ'),
(406, 54, 'Ghoraghat', 'ঘোড়াঘাট'),
(407, 54, 'Birampur', 'বিরামপুর'),
(408, 54, 'Parbatipur', 'পার্বতীপুর'),
(409, 54, 'Bochaganj', 'বোচাগঞ্জ'),
(410, 54, 'Kaharol', 'কাহারোল'),
(411, 54, 'Fulbari', 'ফুলবাড়ী'),
(412, 54, 'Dinajpur Sadar', 'দিনাজপুর সদর'),
(413, 54, 'Hakimpur', 'হাকিমপুর'),
(414, 54, 'Khansama', 'খানসামা'),
(415, 54, 'Birol', 'বিরল'),
(416, 54, 'Chirirbandar', 'চিরিরবন্দর'),
(417, 55, 'Lalmonirhat Sadar', 'লালমনিরহাট সদর'),
(418, 55, 'Kaliganj', 'কালীগঞ্জ'),
(419, 55, 'Hatibandha', 'হাতীবান্ধা'),
(420, 55, 'Patgram', 'পাটগ্রাম'),
(421, 55, 'Aditmari', 'আদিতমারী'),
(422, 56, 'Syedpur', 'সৈয়দপুর'),
(423, 56, 'Domar', 'ডোমার'),
(424, 56, 'Dimla', 'ডিমলা'),
(425, 56, 'Jaldhaka', 'জলঢাকা'),
(426, 56, 'Kishorganj', 'কিশোরগঞ্জ'),
(427, 56, 'Nilphamari Sadar', 'নীলফামারী সদর'),
(428, 57, 'Sadullapur', 'সাদুল্লাপুর'),
(429, 57, 'Gaibandha Sadar', 'গাইবান্ধা সদর'),
(430, 57, 'Palashbari', 'পলাশবাড়ী'),
(431, 57, 'Saghata', 'সাঘাটা'),
(432, 57, 'Gobindaganj', 'গোবিন্দগঞ্জ'),
(433, 57, 'Sundarganj', 'সুন্দরগঞ্জ'),
(434, 57, 'Phulchari', 'ফুলছড়ি'),
(435, 58, 'Thakurgaon Sadar', 'ঠাকুরগাঁও সদর'),
(436, 58, 'Pirganj', 'পীরগঞ্জ'),
(437, 58, 'Ranisankail', 'রাণীশংকৈল'),
(438, 58, 'Haripur', 'হরিপুর'),
(439, 58, 'Baliadangi', 'বালিয়াডাঙ্গী'),
(440, 59, 'Rangpur Sadar', 'রংপুর সদর'),
(441, 59, 'Gangachara', 'গংগাচড়া'),
(442, 59, 'Taragonj', 'তারাগঞ্জ'),
(443, 59, 'Badargonj', 'বদরগঞ্জ'),
(444, 59, 'Mithapukur', 'মিঠাপুকুর'),
(445, 59, 'Pirgonj', 'পীরগঞ্জ'),
(446, 59, 'Kaunia', 'কাউনিয়া'),
(447, 59, 'Pirgacha', 'পীরগাছা'),
(448, 60, 'Kurigram Sadar', 'কুড়িগ্রাম সদর'),
(449, 60, 'Nageshwari', 'নাগেশ্বরী'),
(450, 60, 'Bhurungamari', 'ভুরুঙ্গামারী'),
(451, 60, 'Phulbari', 'ফুলবাড়ী'),
(452, 60, 'Rajarhat', 'রাজারহাট'),
(453, 60, 'Ulipur', 'উলিপুর'),
(454, 60, 'Chilmari', 'চিলমারী'),
(455, 60, 'Rowmari', 'রৌমারী'),
(456, 60, 'Charrajibpur', 'চর রাজিবপুর'),
(457, 61, 'Sherpur Sadar', 'শেরপুর সদর'),
(458, 61, 'Nalitabari', 'নালিতাবাড়ী'),
(459, 61, 'Sreebordi', 'শ্রীবরদী'),
(460, 61, 'Nokla', 'নকলা'),
(461, 61, 'Jhenaigati', 'ঝিনাইগাতী'),
(462, 62, 'Fulbaria', 'ফুলবাড়ীয়া'),
(463, 62, 'Trishal', 'ত্রিশাল'),
(464, 62, 'Bhaluka', 'ভালুকা'),
(465, 62, 'Muktagacha', 'মুক্তাগাছা'),
(466, 62, 'Mymensingh Sadar', 'ময়মনসিংহ সদর'),
(467, 62, 'Dhobaura', 'ধোবাউড়া'),
(468, 62, 'Phulpur', 'ফুলপুর'),
(469, 62, 'Haluaghat', 'হালুয়াঘাট'),
(470, 62, 'Gouripur', 'গৌরীপুর'),
(471, 62, 'Gafargaon', 'গফরগাঁও'),
(472, 62, 'Iswarganj', 'ঈশ্বরগঞ্জ'),
(473, 62, 'Nandail', 'নান্দাইল'),
(474, 62, 'Tarakanda', 'তারাকান্দা'),
(475, 63, 'Jamalpur Sadar', 'জামালপুর সদর'),
(476, 63, 'Melandah', 'মেলান্দহ'),
(477, 63, 'Islampur', 'ইসলামপুর'),
(478, 63, 'Dewangonj', 'দেওয়ানগঞ্জ'),
(479, 63, 'Sarishabari', 'সরিষাবাড়ী'),
(480, 63, 'Madarganj', 'মাদারগঞ্জ'),
(481, 63, 'Bokshiganj', 'বকশীগঞ্জ'),
(482, 64, 'Barhatta', 'বারহাট্টা'),
(483, 64, 'Durgapur', 'দুর্গাপুর'),
(484, 64, 'Kendua', 'কেন্দুয়া'),
(485, 64, 'Atpara', 'আটপাড়া'),
(486, 64, 'Madan', 'মদন'),
(487, 64, 'Khaliajuri', 'খালিয়াজুরী'),
(488, 64, 'Kalmakanda', 'কলমাকান্দা'),
(489, 64, 'Mohongonj', 'মোহনগঞ্জ'),
(490, 64, 'Purbadhala', 'পূর্বধলা'),
(491, 64, 'Netrokona Sadar', 'নেত্রকোণা সদর'),
(492, 47, 'Adabar Thana', NULL),
(493, 47, 'Azampur', NULL),
(494, 47, 'Badda Thana', NULL),
(495, 47, 'Bangsal Thana', NULL),
(496, 47, 'Bimanbandar Thana', NULL),
(497, 47, 'Cantonment Thana', NULL),
(498, 47, 'Chowkbazar Thana', NULL),
(499, 47, 'Darus Salam Thana', NULL),
(500, 47, 'Demra Thana', NULL),
(501, 47, 'Dhanmondi Thana', NULL),
(502, 47, 'Gendaria Thana', NULL),
(503, 47, 'Gulshan Thana', NULL),
(504, 47, 'Hazaribagh Thana', NULL),
(505, 47, 'Kadamtali Thana', NULL),
(506, 47, 'Kafrul Thana', NULL),
(507, 47, 'Kalabagan', NULL),
(508, 47, 'Kamrangirchar Thana', NULL),
(509, 47, 'Khilgaon Thana', NULL),
(510, 47, 'Khilkhet Thana', NULL),
(511, 47, 'Kotwali Thana', NULL),
(512, 47, 'Lalbagh Thana', NULL),
(513, 47, 'Mirpur Model Thana', NULL),
(514, 47, 'Mohammadpur Thana', NULL),
(515, 47, 'Motijheel Thana', NULL),
(516, 47, 'New Market Thana', NULL),
(517, 47, 'Pallabi Thana', NULL),
(518, 47, 'Paltan', NULL),
(519, 47, 'Panthapath', NULL),
(520, 47, 'Ramna Thana', NULL),
(521, 47, 'Rampura Thana', NULL),
(522, 47, 'Sabujbagh', NULL),
(523, 47, 'Shah Ali Thana', NULL),
(524, 47, 'Shahbag', NULL),
(525, 47, 'Sher-e-Bangla Nagar', NULL),
(526, 47, 'Shyampur Thana', NULL),
(527, 47, 'Sutrapur Thana', NULL),
(528, 47, 'Tejgaon Industrial Area ', NULL),
(529, 47, 'Tejgaon Thana', NULL),
(530, 47, 'Turag Thana', NULL),
(531, 47, 'Uttar Khan Thana', NULL),
(532, 47, 'Uttara (Town)', NULL),
(533, 47, 'Vatara Thana', NULL),
(534, 47, 'Wari Thana', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `profile_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_level` int(11) NOT NULL,
  `status` int(11) NOT NULL COMMENT '1 = Active & 0 = Inactive',
  `last_login_at` datetime DEFAULT NULL,
  `last_login_ip` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_failed_login_at` datetime DEFAULT NULL,
  `last_failed_login_ip` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `profile_image`, `email_verified_at`, `password`, `remember_token`, `user_level`, `status`, `last_login_at`, `last_login_ip`, `last_failed_login_at`, `last_failed_login_ip`, `created_at`, `updated_at`) VALUES
(4, 'Ettehad Toaha', 'ettehadtoaha2017@gmail.com', NULL, NULL, '$2y$10$ECx./arkWYV2HLA2y.4J4.729eYKktea1i65stRAcl.fhF42t.zsm', NULL, 4, 1, NULL, NULL, NULL, NULL, '2020-12-05 07:17:50', '2020-12-05 07:17:50'),
(5, 'Acquaint Technologies', 'sales@acquaintbd.com', NULL, NULL, '$2y$10$WVnlcr/MlQnMIDh3IPLol.AlHmBnWjNCAgnhvDEdsxAhMlCKK2cDy', NULL, 1, 1, '2020-12-24 09:27:20', '::1', '2020-12-10 12:35:39', '103.106.237.132', '2020-11-29 04:27:23', '2020-12-24 03:27:20'),
(7, 'Hujjatullah', 'huzzaitullah0155@gmail.com', NULL, NULL, '$2y$10$9oWFeNh2U2gfPmem6embzOoM/dzWSuyc8KMbflKCFp1rWLEQ9Ql8S', NULL, 2, 1, NULL, NULL, NULL, NULL, '2020-12-05 07:07:18', '2020-12-05 07:10:51'),
(8, 'Ishak Faridi', 'ishakfaridi@gmail.com', NULL, NULL, '$2y$10$bqDCqJwu3pE1k/ZbnAGPqeE5Z9PxMOllkf2ncTZf8LGfECgy5vtsO', NULL, 3, 1, '2020-12-10 11:30:13', '103.118.153.38', NULL, NULL, '2020-12-05 07:08:36', '2020-12-10 05:30:13'),
(9, 'Nurun Nabi Shazib', 'nurunnabishazib@gmail.com', NULL, NULL, '$2y$10$HEK0vBwMNEXfi5zq5Q81CuW4fvbOVDLJH3H/V4iFo2IkEQLbflEgi', 'Za2pWqcf7HJ8Zfkqb0JiBTOaZqHwI1MURLSTUORZ3U4iULqdfJ5Q9tQwZVoa', 4, 1, '2020-12-10 11:04:54', '103.118.153.38', NULL, NULL, '2020-12-05 07:09:47', '2020-12-10 05:04:54'),
(10, 'Mohammad Abdul Aziz', 'maaziz.dc@gmail.com', '1607154298-3R copy.jpg', NULL, '$2y$10$ST60wKdZM6WU1S1yXwT8EeyD2Qus/Ex8WO.aRHxSJISRExjlJ8mM6', '1ZOeDHlZMMw40RWjXjdDcop0KYYpJg86ylQyupkj3Yvb6jCHKmCN1VkIpMow', 5, 1, '2020-12-08 10:39:34', '103.118.152.195', NULL, NULL, '2020-12-05 07:10:22', '2020-12-08 04:39:34'),
(11, 'Akber Ali', 'akbernaim@gmail.com', NULL, NULL, '$2y$10$fU4b/JlrpoPB9VYwiO.ywu.ApNONWyhnDpqpQl3KIIrCVD9vpiwoq', 'mippZiUC7pCGAd09SgIZT21wAYgTW5bcghuQnhZuzAblA802qSQfELXchzqd', 2, 1, '2020-12-08 20:44:47', '103.252.227.58', NULL, NULL, '2020-12-05 07:13:57', '2020-12-08 14:44:47');

-- --------------------------------------------------------

--
-- Table structure for table `vehicles`
--

CREATE TABLE `vehicles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `vehicle_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cost` decimal(10,2) NOT NULL DEFAULT 0.00,
  `flight_number` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `departure_datetime` datetime DEFAULT NULL,
  `arrival_datetime` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `vehicles`
--

INSERT INTO `vehicles` (`id`, `vehicle_name`, `cost`, `flight_number`, `departure_datetime`, `arrival_datetime`, `created_at`, `updated_at`) VALUES
(1, 'Airline 101', '25000.00', '230098', '2020-10-25 14:03:30', '2020-10-09 18:10:16', '2020-02-11 05:48:50', '2020-10-25 08:03:35'),
(2, 'Airline 102', '24203.00', NULL, NULL, NULL, '2020-02-11 05:48:50', '2020-02-11 05:48:50');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `attached_documents`
--
ALTER TABLE `attached_documents`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `banks`
--
ALTER TABLE `banks`
  ADD PRIMARY KEY (`b_id`);

--
-- Indexes for table `countries`
--
ALTER TABLE `countries`
  ADD PRIMARY KEY (`country_id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customer_passports`
--
ALTER TABLE `customer_passports`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customer_visas`
--
ALTER TABLE `customer_visas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customer_visa_types`
--
ALTER TABLE `customer_visa_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `deposits`
--
ALTER TABLE `deposits`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dev_app_details`
--
ALTER TABLE `dev_app_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dev_developer_details`
--
ALTER TABLE `dev_developer_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dev_mode_setup`
--
ALTER TABLE `dev_mode_setup`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `districts`
--
ALTER TABLE `districts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `expenses`
--
ALTER TABLE `expenses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `expense_categories`
--
ALTER TABLE `expense_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `group_code` (`group_code`);

--
-- Indexes for table `hajjs`
--
ALTER TABLE `hajjs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `hajjs_serial_no_unique` (`serial_no`);

--
-- Indexes for table `hajj_payments`
--
ALTER TABLE `hajj_payments`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `hajj_payments_voucher_name_unique` (`voucher_name`);

--
-- Indexes for table `hotels`
--
ALTER TABLE `hotels`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mahram_relations`
--
ALTER TABLE `mahram_relations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `menus`
--
ALTER TABLE `menus`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `packages`
--
ALTER TABLE `packages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `passport_documents`
--
ALTER TABLE `passport_documents`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `passport_history`
--
ALTER TABLE `passport_history`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `passport_statuses`
--
ALTER TABLE `passport_statuses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `priorities`
--
ALTER TABLE `priorities`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `priority_menu`
--
ALTER TABLE `priority_menu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `profiles`
--
ALTER TABLE `profiles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `service_types`
--
ALTER TABLE `service_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ticketing_airlines`
--
ALTER TABLE `ticketing_airlines`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ticket_refunds`
--
ALTER TABLE `ticket_refunds`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ticket_sales`
--
ALTER TABLE `ticket_sales`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `upazilas`
--
ALTER TABLE `upazilas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `district_id` (`district_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `vehicles`
--
ALTER TABLE `vehicles`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `attached_documents`
--
ALTER TABLE `attached_documents`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `banks`
--
ALTER TABLE `banks`
  MODIFY `b_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `countries`
--
ALTER TABLE `countries`
  MODIFY `country_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `customer_passports`
--
ALTER TABLE `customer_passports`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `customer_visas`
--
ALTER TABLE `customer_visas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `customer_visa_types`
--
ALTER TABLE `customer_visa_types`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `deposits`
--
ALTER TABLE `deposits`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `dev_app_details`
--
ALTER TABLE `dev_app_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `dev_developer_details`
--
ALTER TABLE `dev_developer_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `dev_mode_setup`
--
ALTER TABLE `dev_mode_setup`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `districts`
--
ALTER TABLE `districts`
  MODIFY `id` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;

--
-- AUTO_INCREMENT for table `expenses`
--
ALTER TABLE `expenses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `expense_categories`
--
ALTER TABLE `expense_categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `groups`
--
ALTER TABLE `groups`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `hajjs`
--
ALTER TABLE `hajjs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `hajj_payments`
--
ALTER TABLE `hajj_payments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `hotels`
--
ALTER TABLE `hotels`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `mahram_relations`
--
ALTER TABLE `mahram_relations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `menus`
--
ALTER TABLE `menus`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `packages`
--
ALTER TABLE `packages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `passport_documents`
--
ALTER TABLE `passport_documents`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `passport_history`
--
ALTER TABLE `passport_history`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `passport_statuses`
--
ALTER TABLE `passport_statuses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `priorities`
--
ALTER TABLE `priorities`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `priority_menu`
--
ALTER TABLE `priority_menu`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1155;

--
-- AUTO_INCREMENT for table `profiles`
--
ALTER TABLE `profiles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `service_types`
--
ALTER TABLE `service_types`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `ticketing_airlines`
--
ALTER TABLE `ticketing_airlines`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=88;

--
-- AUTO_INCREMENT for table `ticket_refunds`
--
ALTER TABLE `ticket_refunds`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ticket_sales`
--
ALTER TABLE `ticket_sales`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `upazilas`
--
ALTER TABLE `upazilas`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=535;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `vehicles`
--
ALTER TABLE `vehicles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
