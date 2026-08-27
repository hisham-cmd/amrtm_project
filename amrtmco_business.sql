-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 27, 2026 at 11:29 AM
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
-- Database: `amrtmco_business`
--

-- --------------------------------------------------------

--
-- Table structure for table `bs_categories`
--

CREATE TABLE `bs_categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `key` varchar(191) NOT NULL,
  `name_ar` varchar(191) NOT NULL,
  `name_en` varchar(191) NOT NULL,
  `icon` varchar(191) NOT NULL DEFAULT 'ti-building',
  `color` varchar(191) NOT NULL DEFAULT '#1A237E',
  `bg` varchar(191) NOT NULL DEFAULT 'rgba(26,35,126,.1)',
  `images` varchar(191) DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `sort_order` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `bs_consultants`
--

CREATE TABLE `bs_consultants` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name_ar` varchar(191) NOT NULL,
  `name_en` varchar(191) DEFAULT NULL,
  `email` varchar(191) NOT NULL,
  `phone` varchar(191) DEFAULT NULL,
  `city` varchar(191) DEFAULT NULL,
  `photo` varchar(191) DEFAULT NULL,
  `bio_ar` text DEFAULT NULL,
  `bio_en` text DEFAULT NULL,
  `experience_years` int(11) NOT NULL DEFAULT 0,
  `rating` decimal(3,2) NOT NULL DEFAULT 0.00,
  `reviews_count` int(11) NOT NULL DEFAULT 0,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `is_available` tinyint(1) NOT NULL DEFAULT 1,
  `skills` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`skills`)),
  `qualifications` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`qualifications`)),
  `tags` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`tags`)),
  `office_code` varchar(20) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `bs_consultant_specialties`
--

CREATE TABLE `bs_consultant_specialties` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `consultant_id` bigint(20) UNSIGNED NOT NULL,
  `specialty_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `bs_entities`
--

CREATE TABLE `bs_entities` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `name_ar` varchar(191) NOT NULL,
  `name_en` varchar(191) NOT NULL,
  `icon` varchar(191) NOT NULL DEFAULT 'ti-building',
  `color` varchar(191) NOT NULL DEFAULT '#1A237E',
  `bg` varchar(191) NOT NULL DEFAULT 'rgba(26,35,126,.1)',
  `images` varchar(191) DEFAULT NULL,
  `tag_ar` varchar(191) DEFAULT NULL,
  `tag_en` varchar(191) DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `sort_order` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `bs_notifications`
--

CREATE TABLE `bs_notifications` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `recipient_type` enum('user','office','admin') NOT NULL DEFAULT 'user',
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `office_id` bigint(20) UNSIGNED DEFAULT NULL,
  `sender_id` bigint(20) UNSIGNED DEFAULT NULL,
  `type` varchar(191) NOT NULL DEFAULT 'info',
  `title` varchar(191) NOT NULL,
  `body` text NOT NULL,
  `data` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`data`)),
  `request_id` bigint(20) UNSIGNED DEFAULT NULL,
  `is_read` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `bs_offices`
--

CREATE TABLE `bs_offices` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `office_code` varchar(20) DEFAULT NULL,
  `public_token` varchar(64) DEFAULT NULL,
  `type` enum('law','services','customs') NOT NULL,
  `name_ar` varchar(191) NOT NULL,
  `name_en` varchar(191) NOT NULL,
  `description_ar` text DEFAULT NULL,
  `description_en` text DEFAULT NULL,
  `phone` varchar(191) NOT NULL,
  `email` varchar(191) NOT NULL,
  `city` varchar(191) DEFAULT NULL,
  `cr_number` varchar(191) DEFAULT NULL,
  `logo` varchar(191) DEFAULT NULL,
  `specialties` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`specialties`)),
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `is_verified` tinyint(1) NOT NULL DEFAULT 0,
  `commission_rate` decimal(5,2) NOT NULL DEFAULT 0.00,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `bs_office_documents`
--

CREATE TABLE `bs_office_documents` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `office_id` bigint(20) UNSIGNED NOT NULL,
  `document_type` enum('license','commercial_register','cv','certificate','award','client','experience') NOT NULL,
  `file` varchar(191) NOT NULL,
  `file_name` varchar(191) DEFAULT NULL,
  `is_verified` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `bs_office_messages`
--

CREATE TABLE `bs_office_messages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `request_id` bigint(20) UNSIGNED NOT NULL,
  `office_id` bigint(20) UNSIGNED NOT NULL,
  `sender_type` enum('office','client') NOT NULL,
  `sender_id` bigint(20) UNSIGNED DEFAULT NULL,
  `message` text NOT NULL,
  `attachments` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`attachments`)),
  `is_read` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `bs_office_profiles`
--

CREATE TABLE `bs_office_profiles` (
  `office_id` bigint(20) UNSIGNED NOT NULL,
  `license_number` varchar(191) NOT NULL,
  `cr_number` varchar(191) NOT NULL,
  `mobile` varchar(191) DEFAULT NULL,
  `country` varchar(191) DEFAULT NULL,
  `governorate` varchar(191) DEFAULT NULL,
  `city` varchar(191) DEFAULT NULL,
  `district` varchar(191) DEFAULT NULL,
  `street` varchar(191) DEFAULT NULL,
  `building_number` varchar(191) DEFAULT NULL,
  `office_number` varchar(191) DEFAULT NULL,
  `description_ar` longtext DEFAULT NULL,
  `description_en` longtext DEFAULT NULL,
  `handled_cases` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `custom_specialty` varchar(191) DEFAULT NULL,
  `profile_completed` tinyint(1) NOT NULL DEFAULT 0,
  `verification_status` enum('draft','pending','approved','rejected') NOT NULL DEFAULT 'draft',
  `submitted_at` timestamp NULL DEFAULT NULL,
  `approved_at` timestamp NULL DEFAULT NULL,
  `office_code` varchar(191) DEFAULT NULL,
  `qr_code` varchar(191) DEFAULT NULL,
  `trademark_registration_number` varchar(191) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `bs_office_requests`
--

CREATE TABLE `bs_office_requests` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `ref_number` varchar(191) NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `office_id` bigint(20) UNSIGNED NOT NULL,
  `office_service_id` bigint(20) UNSIGNED NOT NULL,
  `client_name` varchar(191) NOT NULL,
  `client_phone` varchar(191) NOT NULL,
  `client_email` varchar(191) NOT NULL,
  `client_id_number` varchar(191) DEFAULT NULL,
  `notes` text DEFAULT NULL,
  `attachments` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`attachments`)),
  `price` decimal(10,2) NOT NULL DEFAULT 0.00,
  `commission_amount` decimal(10,2) NOT NULL DEFAULT 0.00,
  `status` enum('pending','accepted','in_progress','waiting_docs','done','rejected') NOT NULL DEFAULT 'pending',
  `office_note` text DEFAULT NULL,
  `completed_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `bs_office_services`
--

CREATE TABLE `bs_office_services` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `office_id` bigint(20) UNSIGNED NOT NULL,
  `name_ar` varchar(191) NOT NULL,
  `name_en` varchar(191) NOT NULL,
  `description_ar` text DEFAULT NULL,
  `description_en` text DEFAULT NULL,
  `price` decimal(10,2) NOT NULL DEFAULT 0.00,
  `duration` varchar(191) DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `sort_order` smallint(5) UNSIGNED NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `images` varchar(191) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `bs_office_specialties`
--

CREATE TABLE `bs_office_specialties` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `office_id` bigint(20) UNSIGNED NOT NULL,
  `specialty_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `bs_office_users`
--

CREATE TABLE `bs_office_users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `office_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) NOT NULL,
  `email` varchar(191) NOT NULL,
  `password` varchar(191) NOT NULL,
  `role` enum('owner','manager','staff') NOT NULL DEFAULT 'owner',
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `bs_payments`
--

CREATE TABLE `bs_payments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `request_id` bigint(20) UNSIGNED DEFAULT NULL,
  `amount` decimal(10,2) NOT NULL,
  `type` enum('charge','payment','refund') NOT NULL DEFAULT 'charge',
  `description_ar` varchar(191) DEFAULT NULL,
  `description_en` varchar(191) DEFAULT NULL,
  `status` enum('pending','completed','failed') NOT NULL DEFAULT 'completed',
  `transaction_ref` varchar(191) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `bs_requests`
--

CREATE TABLE `bs_requests` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `ref_number` varchar(191) NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `service_id` bigint(20) UNSIGNED NOT NULL,
  `entity_id` bigint(20) UNSIGNED NOT NULL,
  `client_name` varchar(191) NOT NULL,
  `client_email` varchar(191) NOT NULL,
  `client_phone` varchar(191) NOT NULL,
  `client_id_number` varchar(191) NOT NULL,
  `company_name` varchar(191) DEFAULT NULL,
  `company_cr` varchar(191) DEFAULT NULL,
  `notes` text DEFAULT NULL,
  `attachments` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`attachments`)),
  `price` decimal(10,2) NOT NULL DEFAULT 0.00,
  `status` enum('pending','processing','in_progress','done','rejected') NOT NULL DEFAULT 'pending',
  `reject_reason` text DEFAULT NULL,
  `estimated_completion` varchar(191) DEFAULT NULL,
  `completed_at` timestamp NULL DEFAULT NULL,
  `handled_by` bigint(20) UNSIGNED DEFAULT NULL,
  `office_id` bigint(20) UNSIGNED DEFAULT NULL,
  `office_status` enum('pending','accepted','in_progress','waiting_docs','done','rejected') DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `bs_request_logs`
--

CREATE TABLE `bs_request_logs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `request_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `status` varchar(191) NOT NULL,
  `log_type` varchar(191) NOT NULL DEFAULT 'status_change',
  `note` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `bs_services`
--

CREATE TABLE `bs_services` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `entity_id` bigint(20) UNSIGNED NOT NULL,
  `name_ar` varchar(191) NOT NULL,
  `name_en` varchar(191) NOT NULL,
  `icon` varchar(191) NOT NULL DEFAULT 'ti-file-text',
  `price` decimal(10,2) NOT NULL DEFAULT 0.00,
  `description_ar` text DEFAULT NULL,
  `description_en` text DEFAULT NULL,
  `estimated_days` int(11) NOT NULL DEFAULT 3,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `sort_order` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `images` varchar(191) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `bs_specialties`
--

CREATE TABLE `bs_specialties` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `office_type` enum('law','services','customs','accounting','engineering','freelance') NOT NULL,
  `name_ar` varchar(191) NOT NULL,
  `name_en` varchar(191) DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `bs_users`
--

CREATE TABLE `bs_users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) NOT NULL,
  `email` varchar(191) NOT NULL,
  `phone` varchar(191) DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) NOT NULL,
  `role` enum('admin','supervisor','user') NOT NULL DEFAULT 'user',
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `permissions` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`permissions`)),
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bs_categories`
--
ALTER TABLE `bs_categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `bs_categories_key_unique` (`key`);

--
-- Indexes for table `bs_consultants`
--
ALTER TABLE `bs_consultants`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `bs_consultants_email_unique` (`email`),
  ADD UNIQUE KEY `bs_consultants_office_code_unique` (`office_code`);

--
-- Indexes for table `bs_consultant_specialties`
--
ALTER TABLE `bs_consultant_specialties`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `bs_consultant_specialties_consultant_id_specialty_id_unique` (`consultant_id`,`specialty_id`),
  ADD KEY `bs_consultant_specialties_specialty_id_foreign` (`specialty_id`);

--
-- Indexes for table `bs_entities`
--
ALTER TABLE `bs_entities`
  ADD PRIMARY KEY (`id`),
  ADD KEY `bs_entities_category_id_foreign` (`category_id`);

--
-- Indexes for table `bs_notifications`
--
ALTER TABLE `bs_notifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `bs_notifications_request_id_foreign` (`request_id`),
  ADD KEY `bs_notifications_user_id_is_read_index` (`user_id`,`is_read`),
  ADD KEY `bs_notifications_recipient_type_index` (`recipient_type`),
  ADD KEY `bs_notifications_office_id_index` (`office_id`);

--
-- Indexes for table `bs_offices`
--
ALTER TABLE `bs_offices`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `bs_offices_email_unique` (`email`),
  ADD UNIQUE KEY `bs_offices_office_code_unique` (`office_code`),
  ADD UNIQUE KEY `bs_offices_public_token_unique` (`public_token`);

--
-- Indexes for table `bs_office_documents`
--
ALTER TABLE `bs_office_documents`
  ADD PRIMARY KEY (`id`),
  ADD KEY `bs_office_documents_office_id_foreign` (`office_id`);

--
-- Indexes for table `bs_office_messages`
--
ALTER TABLE `bs_office_messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `bs_office_messages_request_id_foreign` (`request_id`),
  ADD KEY `bs_office_messages_office_id_foreign` (`office_id`);

--
-- Indexes for table `bs_office_profiles`
--
ALTER TABLE `bs_office_profiles`
  ADD UNIQUE KEY `bs_office_profiles_office_id_unique` (`office_id`),
  ADD UNIQUE KEY `bs_office_profiles_license_number_unique` (`license_number`),
  ADD UNIQUE KEY `bs_office_profiles_cr_number_unique` (`cr_number`),
  ADD UNIQUE KEY `bs_office_profiles_office_code_unique` (`office_code`);

--
-- Indexes for table `bs_office_requests`
--
ALTER TABLE `bs_office_requests`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `bs_office_requests_ref_number_unique` (`ref_number`),
  ADD KEY `bs_office_requests_office_id_foreign` (`office_id`),
  ADD KEY `bs_office_requests_office_service_id_foreign` (`office_service_id`);

--
-- Indexes for table `bs_office_services`
--
ALTER TABLE `bs_office_services`
  ADD PRIMARY KEY (`id`),
  ADD KEY `bs_office_services_office_id_foreign` (`office_id`);

--
-- Indexes for table `bs_office_specialties`
--
ALTER TABLE `bs_office_specialties`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `bs_office_specialties_office_id_specialty_id_unique` (`office_id`,`specialty_id`),
  ADD KEY `bs_office_specialties_specialty_id_foreign` (`specialty_id`);

--
-- Indexes for table `bs_office_users`
--
ALTER TABLE `bs_office_users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `bs_office_users_email_unique` (`email`),
  ADD KEY `bs_office_users_office_id_foreign` (`office_id`);

--
-- Indexes for table `bs_payments`
--
ALTER TABLE `bs_payments`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `bs_payments_transaction_ref_unique` (`transaction_ref`),
  ADD KEY `bs_payments_request_id_foreign` (`request_id`),
  ADD KEY `bs_payments_user_id_index` (`user_id`),
  ADD KEY `bs_payments_user_id_type_index` (`user_id`,`type`);

--
-- Indexes for table `bs_requests`
--
ALTER TABLE `bs_requests`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `bs_requests_ref_number_unique` (`ref_number`),
  ADD KEY `bs_requests_service_id_foreign` (`service_id`),
  ADD KEY `bs_requests_entity_id_foreign` (`entity_id`),
  ADD KEY `bs_requests_user_id_index` (`user_id`),
  ADD KEY `bs_requests_status_index` (`status`),
  ADD KEY `bs_requests_user_id_status_index` (`user_id`,`status`),
  ADD KEY `bs_requests_status_created_at_index` (`status`,`created_at`),
  ADD KEY `bs_requests_office_id_foreign` (`office_id`);

--
-- Indexes for table `bs_request_logs`
--
ALTER TABLE `bs_request_logs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `bs_request_logs_request_id_foreign` (`request_id`);

--
-- Indexes for table `bs_services`
--
ALTER TABLE `bs_services`
  ADD PRIMARY KEY (`id`),
  ADD KEY `bs_services_entity_id_foreign` (`entity_id`);

--
-- Indexes for table `bs_specialties`
--
ALTER TABLE `bs_specialties`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bs_users`
--
ALTER TABLE `bs_users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `bs_users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bs_categories`
--
ALTER TABLE `bs_categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `bs_consultants`
--
ALTER TABLE `bs_consultants`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `bs_consultant_specialties`
--
ALTER TABLE `bs_consultant_specialties`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `bs_entities`
--
ALTER TABLE `bs_entities`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `bs_notifications`
--
ALTER TABLE `bs_notifications`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `bs_offices`
--
ALTER TABLE `bs_offices`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `bs_office_documents`
--
ALTER TABLE `bs_office_documents`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `bs_office_messages`
--
ALTER TABLE `bs_office_messages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `bs_office_requests`
--
ALTER TABLE `bs_office_requests`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `bs_office_services`
--
ALTER TABLE `bs_office_services`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `bs_office_specialties`
--
ALTER TABLE `bs_office_specialties`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `bs_office_users`
--
ALTER TABLE `bs_office_users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `bs_payments`
--
ALTER TABLE `bs_payments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `bs_requests`
--
ALTER TABLE `bs_requests`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `bs_request_logs`
--
ALTER TABLE `bs_request_logs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `bs_services`
--
ALTER TABLE `bs_services`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `bs_specialties`
--
ALTER TABLE `bs_specialties`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `bs_users`
--
ALTER TABLE `bs_users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bs_consultant_specialties`
--
ALTER TABLE `bs_consultant_specialties`
  ADD CONSTRAINT `bs_consultant_specialties_consultant_id_foreign` FOREIGN KEY (`consultant_id`) REFERENCES `bs_consultants` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `bs_consultant_specialties_specialty_id_foreign` FOREIGN KEY (`specialty_id`) REFERENCES `bs_specialties` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `bs_entities`
--
ALTER TABLE `bs_entities`
  ADD CONSTRAINT `bs_entities_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `bs_categories` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `bs_notifications`
--
ALTER TABLE `bs_notifications`
  ADD CONSTRAINT `bs_notifications_request_id_foreign` FOREIGN KEY (`request_id`) REFERENCES `bs_requests` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `bs_office_documents`
--
ALTER TABLE `bs_office_documents`
  ADD CONSTRAINT `bs_office_documents_office_id_foreign` FOREIGN KEY (`office_id`) REFERENCES `bs_offices` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `bs_office_messages`
--
ALTER TABLE `bs_office_messages`
  ADD CONSTRAINT `bs_office_messages_office_id_foreign` FOREIGN KEY (`office_id`) REFERENCES `bs_offices` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `bs_office_messages_request_id_foreign` FOREIGN KEY (`request_id`) REFERENCES `bs_requests` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `bs_office_profiles`
--
ALTER TABLE `bs_office_profiles`
  ADD CONSTRAINT `bs_office_profiles_office_id_foreign` FOREIGN KEY (`office_id`) REFERENCES `bs_offices` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `bs_office_requests`
--
ALTER TABLE `bs_office_requests`
  ADD CONSTRAINT `bs_office_requests_office_id_foreign` FOREIGN KEY (`office_id`) REFERENCES `bs_offices` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `bs_office_requests_office_service_id_foreign` FOREIGN KEY (`office_service_id`) REFERENCES `bs_office_services` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `bs_office_services`
--
ALTER TABLE `bs_office_services`
  ADD CONSTRAINT `bs_office_services_office_id_foreign` FOREIGN KEY (`office_id`) REFERENCES `bs_offices` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `bs_office_specialties`
--
ALTER TABLE `bs_office_specialties`
  ADD CONSTRAINT `bs_office_specialties_office_id_foreign` FOREIGN KEY (`office_id`) REFERENCES `bs_offices` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `bs_office_specialties_specialty_id_foreign` FOREIGN KEY (`specialty_id`) REFERENCES `bs_specialties` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `bs_office_users`
--
ALTER TABLE `bs_office_users`
  ADD CONSTRAINT `bs_office_users_office_id_foreign` FOREIGN KEY (`office_id`) REFERENCES `bs_offices` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `bs_payments`
--
ALTER TABLE `bs_payments`
  ADD CONSTRAINT `bs_payments_request_id_foreign` FOREIGN KEY (`request_id`) REFERENCES `bs_requests` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `bs_requests`
--
ALTER TABLE `bs_requests`
  ADD CONSTRAINT `bs_requests_entity_id_foreign` FOREIGN KEY (`entity_id`) REFERENCES `bs_entities` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `bs_requests_office_id_foreign` FOREIGN KEY (`office_id`) REFERENCES `bs_offices` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `bs_requests_service_id_foreign` FOREIGN KEY (`service_id`) REFERENCES `bs_services` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `bs_request_logs`
--
ALTER TABLE `bs_request_logs`
  ADD CONSTRAINT `bs_request_logs_request_id_foreign` FOREIGN KEY (`request_id`) REFERENCES `bs_requests` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `bs_services`
--
ALTER TABLE `bs_services`
  ADD CONSTRAINT `bs_services_entity_id_foreign` FOREIGN KEY (`entity_id`) REFERENCES `bs_entities` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
