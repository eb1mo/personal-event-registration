-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 29, 2025 at 01:37 PM
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
-- Database: `event_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `birth_records`
--

CREATE TABLE `birth_records` (
  `id` int(11) NOT NULL,
  `token` varchar(6) NOT NULL,
  `child_name_nepali` varchar(255) NOT NULL,
  `child_name_english` varchar(255) NOT NULL,
  `birth_date_bs` date NOT NULL,
  `birth_date_ad` date NOT NULL,
  `birth_place` varchar(50) NOT NULL,
  `birth_assistance` varchar(50) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `ethnicity` varchar(100) NOT NULL,
  `birth_weight` float NOT NULL,
  `birth_type` varchar(50) NOT NULL,
  `physical_anomaly` varchar(10) NOT NULL,
  `anomaly_details` text DEFAULT NULL,
  `address_nepali` text NOT NULL,
  `address_english` text NOT NULL,
  `grandfather_name_nepali` varchar(255) DEFAULT NULL,
  `grandfather_name_english` varchar(255) DEFAULT NULL,
  `father_name_nepali` varchar(255) DEFAULT NULL,
  `mother_name_nepali` varchar(255) DEFAULT NULL,
  `father_name_english` varchar(255) DEFAULT NULL,
  `mother_name_english` varchar(255) DEFAULT NULL,
  `father_province_nepali` varchar(100) DEFAULT NULL,
  `father_province_english` varchar(100) DEFAULT NULL,
  `mother_province_nepali` varchar(100) DEFAULT NULL,
  `mother_province_english` varchar(100) DEFAULT NULL,
  `father_district_nepali` varchar(100) DEFAULT NULL,
  `father_district_english` varchar(100) DEFAULT NULL,
  `mother_district_nepali` varchar(100) DEFAULT NULL,
  `mother_district_english` varchar(100) DEFAULT NULL,
  `father_municipality_nepali` varchar(100) DEFAULT NULL,
  `father_municipality_english` varchar(100) DEFAULT NULL,
  `mother_municipality_nepali` varchar(100) DEFAULT NULL,
  `mother_municipality_english` varchar(100) DEFAULT NULL,
  `father_ward_nepali` int(11) DEFAULT NULL,
  `father_ward_english` int(11) DEFAULT NULL,
  `mother_ward_nepali` int(11) DEFAULT NULL,
  `mother_ward_english` int(11) DEFAULT NULL,
  `father_street_nepali` varchar(255) DEFAULT NULL,
  `father_street_english` varchar(255) DEFAULT NULL,
  `mother_street_nepali` varchar(255) DEFAULT NULL,
  `mother_street_english` varchar(255) DEFAULT NULL,
  `father_house_no_nepali` varchar(50) DEFAULT NULL,
  `father_house_no_english` varchar(50) DEFAULT NULL,
  `mother_house_no_nepali` varchar(50) DEFAULT NULL,
  `mother_house_no_english` varchar(50) DEFAULT NULL,
  `father_age` int(11) DEFAULT NULL,
  `mother_age` int(11) DEFAULT NULL,
  `father_country` varchar(100) DEFAULT NULL,
  `mother_country` varchar(100) DEFAULT NULL,
  `father_citizenship_country` varchar(100) DEFAULT NULL,
  `mother_citizenship_country` varchar(100) DEFAULT NULL,
  `father_citizenship_no` varchar(100) DEFAULT NULL,
  `mother_citizenship_no` varchar(100) DEFAULT NULL,
  `father_citizenship_date` date DEFAULT NULL,
  `mother_citizenship_date` date DEFAULT NULL,
  `father_citizenship_district` varchar(100) DEFAULT NULL,
  `mother_citizenship_district` varchar(100) DEFAULT NULL,
  `father_passport_no` varchar(100) DEFAULT NULL,
  `mother_passport_no` varchar(100) DEFAULT NULL,
  `father_passport_country` varchar(100) DEFAULT NULL,
  `mother_passport_country` varchar(100) DEFAULT NULL,
  `father_education` varchar(100) DEFAULT NULL,
  `mother_education` varchar(100) DEFAULT NULL,
  `father_occupation` varchar(100) DEFAULT NULL,
  `mother_occupation` varchar(100) DEFAULT NULL,
  `father_religion` varchar(100) DEFAULT NULL,
  `mother_religion` varchar(100) DEFAULT NULL,
  `father_language` varchar(100) DEFAULT NULL,
  `mother_language` varchar(100) DEFAULT NULL,
  `total_born_children` int(11) DEFAULT NULL,
  `total_living_children` int(11) DEFAULT NULL,
  `marriage_registration_no` varchar(100) DEFAULT NULL,
  `marriage_registration_date` date DEFAULT NULL,
  `informant_name_nepali` varchar(255) DEFAULT NULL,
  `informant_name_english` varchar(255) DEFAULT NULL,
  `relationship_to_child` varchar(255) DEFAULT NULL,
  `informant_district` varchar(100) DEFAULT NULL,
  `informant_municipality` varchar(100) DEFAULT NULL,
  `informant_ward` int(11) DEFAULT NULL,
  `informant_street` varchar(255) DEFAULT NULL,
  `informant_house_no` varchar(50) DEFAULT NULL,
  `informant_citizenship_no` varchar(100) DEFAULT NULL,
  `informant_citizenship_date` date DEFAULT NULL,
  `informant_citizenship_district` varchar(100) DEFAULT NULL,
  `informant_passport_no` varchar(100) DEFAULT NULL,
  `informant_passport_country` varchar(100) DEFAULT NULL,
  `informant_signature` text DEFAULT NULL,
  `left_thumb_print` text DEFAULT NULL,
  `right_thumb_print` text DEFAULT NULL,
  `submission_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `death_records`
--

CREATE TABLE `death_records` (
  `id` int(11) NOT NULL,
  `token` varchar(6) NOT NULL,
  `janma_darta_number` varchar(255) NOT NULL,
  `name_nepali` varchar(255) NOT NULL,
  `name_english` varchar(255) NOT NULL,
  `dob_nepali` date NOT NULL,
  `dob_english` date NOT NULL,
  `janma_pradesh` varchar(255) DEFAULT NULL,
  `janma_jilla` varchar(255) DEFAULT NULL,
  `janma_nagarpalika` varchar(255) DEFAULT NULL,
  `janma_ward` int(11) DEFAULT NULL,
  `janma_sadak` varchar(255) DEFAULT NULL,
  `janma_ghar_no` varchar(255) DEFAULT NULL,
  `janma_gau` varchar(255) DEFAULT NULL,
  `mritu_sthan` varchar(255) NOT NULL,
  `mritak_pradesh` varchar(255) DEFAULT NULL,
  `mritak_jilla` varchar(255) DEFAULT NULL,
  `mritak_nagarpalika` varchar(255) DEFAULT NULL,
  `mritak_ward` int(11) DEFAULT NULL,
  `mritak_sadak` varchar(255) DEFAULT NULL,
  `mritak_ghar_no` varchar(255) DEFAULT NULL,
  `mritak_gau` varchar(255) DEFAULT NULL,
  `mritak_pradesh_english` varchar(255) DEFAULT NULL,
  `mritak_jilla_english` varchar(255) DEFAULT NULL,
  `mritak_nagarpalika_english` varchar(255) DEFAULT NULL,
  `mritak_ward_english` int(11) DEFAULT NULL,
  `mritak_sadak_english` varchar(255) DEFAULT NULL,
  `mritak_ghar_no_english` varchar(255) DEFAULT NULL,
  `mritak_gau_english` varchar(255) DEFAULT NULL,
  `nagarikta_number` varchar(255) DEFAULT NULL,
  `jari_jilla` varchar(255) DEFAULT NULL,
  `jari_miti` date DEFAULT NULL,
  `baibahik_sthiti` varchar(50) DEFAULT NULL,
  `shikshya` varchar(255) DEFAULT NULL,
  `matribhasa` varchar(255) DEFAULT NULL,
  `dharma` varchar(255) DEFAULT NULL,
  `jat_jati` varchar(255) DEFAULT NULL,
  `baje_ko_pura_name` varchar(255) DEFAULT NULL,
  `baje_ko_pura_name_eng` varchar(255) DEFAULT NULL,
  `buba_ko_pura_name` varchar(255) DEFAULT NULL,
  `buba_ko_pura_name_eng` varchar(255) DEFAULT NULL,
  `aama_ko_name` varchar(255) DEFAULT NULL,
  `aama_ko_name_eng` varchar(255) DEFAULT NULL,
  `pati_patni_name` varchar(255) DEFAULT NULL,
  `pati_patni_name_eng` varchar(255) DEFAULT NULL,
  `mritu_karan` varchar(255) DEFAULT NULL,
  `informant_name_nepali` varchar(255) DEFAULT NULL,
  `informant_name_english` varchar(255) DEFAULT NULL,
  `relationship_to` varchar(255) DEFAULT NULL,
  `informant_district` varchar(255) DEFAULT NULL,
  `informant_municipality` varchar(255) DEFAULT NULL,
  `informant_ward` int(11) DEFAULT NULL,
  `informant_street` varchar(255) DEFAULT NULL,
  `informant_house_no` varchar(255) DEFAULT NULL,
  `informant_citizenship_no` varchar(255) DEFAULT NULL,
  `informant_citizenship_date` date DEFAULT NULL,
  `informant_citizenship_district` varchar(255) DEFAULT NULL,
  `informant_passport_no` varchar(255) DEFAULT NULL,
  `informant_passport_country` varchar(255) DEFAULT NULL,
  `informant_signature` text DEFAULT NULL,
  `left_thumb_print` text DEFAULT NULL,
  `right_thumb_print` text DEFAULT NULL,
  `submission_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------


CREATE TABLE `family_members` (
  `id` int(11) NOT NULL,
  `migration_id` int(11) NOT NULL,
  `full_name_nepali` varchar(255) NOT NULL,
  `birth_reg_no_nepali` varchar(255) NOT NULL,
  `dob_nepali` date NOT NULL,
  `gender_nepali` varchar(50) NOT NULL,
  `citizen_no_nepali` varchar(255) NOT NULL,
  `issue_date_nepali` date NOT NULL,
  `issue_district_nepali` varchar(255) NOT NULL,
  `relation_nepali` varchar(255) NOT NULL,
  `full_name_english` varchar(255) DEFAULT NULL,
  `birth_reg_no_english` varchar(255) DEFAULT NULL,
  `dob_english` date DEFAULT NULL,
  `gender_english` enum('male','female','other') DEFAULT NULL,
  `citizen_no_english` varchar(50) DEFAULT NULL,
  `issue_date_english` date DEFAULT NULL,
  `issue_district_english` varchar(100) DEFAULT NULL,
  `relation_english` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--


--
-- Table structure for table `migration_records`
--

CREATE TABLE `migration_records` (
  `id` int(11) NOT NULL,
  `token` varchar(6) NOT NULL,
  `migration_date` date NOT NULL,
  `migration_reason` varchar(255) NOT NULL,
  `other_reason` varchar(255) DEFAULT NULL,
  `current_province` varchar(255) NOT NULL,
  `current_province_en` varchar(255) NOT NULL,
  `current_district` varchar(255) NOT NULL,
  `current_district_en` varchar(255) NOT NULL,
  `current_municipality` varchar(255) NOT NULL,
  `current_municipality_en` varchar(255) NOT NULL,
  `current_ward` varchar(255) NOT NULL,
  `current_ward_en` varchar(255) NOT NULL,
  `current_street` varchar(255) NOT NULL,
  `current_street_en` varchar(255) NOT NULL,
  `current_village` varchar(255) NOT NULL,
  `current_village_en` varchar(255) NOT NULL,
  `current_house` varchar(255) NOT NULL,
  `current_house_en` varchar(255) NOT NULL,
  `new_province` varchar(255) NOT NULL,
  `new_province_en` varchar(255) NOT NULL,
  `new_district` varchar(255) NOT NULL,
  `new_district_en` varchar(255) NOT NULL,
  `new_municipality` varchar(255) NOT NULL,
  `new_municipality_en` varchar(255) NOT NULL,
  `new_ward` varchar(255) NOT NULL,
  `new_ward_en` varchar(255) NOT NULL,
  `new_street` varchar(255) NOT NULL,
  `new_street_en` varchar(255) NOT NULL,
  `new_village` varchar(255) NOT NULL,
  `new_village_en` varchar(255) NOT NULL,
  `new_house` varchar(255) NOT NULL,
  `new_house_en` varchar(255) NOT NULL,
  `informant_name_nepali` varchar(255) NOT NULL,
  `informant_name_english` varchar(255) NOT NULL,
  `informant_district` varchar(255) NOT NULL,
  `informant_municipality` varchar(255) NOT NULL,
  `informant_ward` varchar(255) NOT NULL,
  `informant_street` varchar(255) NOT NULL,
  `informant_house_no` varchar(255) NOT NULL,
  `informant_citizenship_no` varchar(255) NOT NULL,
  `informant_citizenship_date` date NOT NULL,
  `informant_citizenship_district` varchar(255) NOT NULL,
  `informant_passport_no` varchar(255) DEFAULT NULL,
  `informant_passport_country` varchar(255) DEFAULT NULL,
  `informant_signature` varchar(255) NOT NULL,
  `left_thumb_print` varchar(255) NOT NULL,
  `right_thumb_print` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------


--
-- Table structure for table `spouses`
--

CREATE TABLE `spouses` (
  `id` int(11) NOT NULL,
  `death_record_id` int(11) NOT NULL,
  `spouse_name_nepali` varchar(255) NOT NULL,
  `spouse_name_english` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--  


--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `created_at`) VALUES
(4, 'admin', '$2y$10$Ui1eC5h4nyDlOxH19yXai.u3ti7eQbSd7ZoWY5blQ2ryDRcJxsf9u', '2025-01-29 07:50:52');
