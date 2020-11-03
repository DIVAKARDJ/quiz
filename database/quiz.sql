-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Nov 03, 2020 at 02:19 AM
-- Server version: 5.7.31
-- PHP Version: 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `quiz`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_settings`
--

DROP TABLE IF EXISTS `admin_settings`;
CREATE TABLE IF NOT EXISTS `admin_settings` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `value` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admin_settings`
--

INSERT INTO `admin_settings` (`id`, `slug`, `value`, `created_at`, `updated_at`) VALUES
(1, 'app_title', 'Quiz', '2020-10-28 10:19:52', '2020-10-28 10:19:52'),
(2, 'logo', '', '2020-10-28 10:19:52', '2020-10-28 10:19:52'),
(3, 'login_logo', '', '2020-10-28 10:19:52', '2020-10-28 10:19:52'),
(4, 'favicon', '', '2020-10-28 10:19:52', '2020-10-28 10:19:52'),
(5, 'copyright_text', 'Copyright@2018', '2020-10-28 10:19:52', '2020-10-28 10:19:52'),
(6, 'lang', 'en', '2020-10-28 10:19:52', '2020-10-28 10:19:52'),
(7, 'company_name', 'New Company', '2020-10-28 10:19:52', '2020-10-28 10:19:52'),
(8, 'primary_email', 'info@email.com', '2020-10-28 10:19:52', '2020-10-28 10:19:52'),
(9, 'user_registration', '1', '2020-10-28 10:19:52', '2020-10-28 10:19:52'),
(10, 'is_authenticated', '2', '2020-10-28 10:19:52', '2020-10-28 10:19:52');

-- --------------------------------------------------------

--
-- Table structure for table `books`
--

DROP TABLE IF EXISTS `books`;
CREATE TABLE IF NOT EXISTS `books` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `book_category_id` int(11) NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `seller_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `book_pdf` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `language` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `books_book_category_id_foreign` (`book_category_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `book_categories`
--

DROP TABLE IF EXISTS `book_categories`;
CREATE TABLE IF NOT EXISTS `book_categories` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
CREATE TABLE IF NOT EXISTS `categories` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `white_image` text COLLATE utf8mb4_unicode_ci,
  `qs_limit` int(11) DEFAULT NULL,
  `time_limit` int(11) DEFAULT NULL,
  `max_limit` int(11) DEFAULT NULL,
  `serial` int(11) DEFAULT NULL,
  `coin` int(11) NOT NULL DEFAULT '0',
  `parent_id` int(11) DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `description`, `image`, `white_image`, `qs_limit`, `time_limit`, `max_limit`, `serial`, `coin`, `parent_id`, `status`, `created_at`, `updated_at`) VALUES
(8, 'Banking', 'Nesciunt optio lab', NULL, NULL, 37, 19, 80, 9, 19, 7, 1, '2020-11-02 11:10:52', '2020-11-02 11:10:52'),
(9, 'Jee', 'In ipsum harum tenet', NULL, NULL, 26, 20, 85, 26, 14, NULL, 1, '2020-11-02 11:11:23', '2020-11-02 11:15:30'),
(10, 'Gate', 'Eos id et voluptas', NULL, NULL, 1, 5, 74, 17, 98, NULL, 1, '2020-11-02 11:15:55', '2020-11-02 11:15:55'),
(11, 'Medical', 'Velit est laborum a', NULL, NULL, 75, 7, 47, 32, 32, NULL, 0, '2020-11-02 11:16:25', '2020-11-02 11:16:25'),
(12, 'Defence', 'Dicta cillum facilis', NULL, NULL, 15, 13, 94, 46, 64, NULL, 1, '2020-11-02 11:16:44', '2020-11-02 11:16:44'),
(7, 'SSC', 'Non voluptatum eu ve', NULL, NULL, 8, 12, 51, 99, 85, NULL, 1, '2020-11-02 11:06:40', '2020-11-02 11:06:40'),
(13, 'LOW', 'Id id quisquam est t', NULL, NULL, 21, 7, 80, 24, 35, NULL, 1, '2020-11-02 11:17:08', '2020-11-02 11:17:08'),
(14, 'MBA', 'Optio deserunt erro', NULL, NULL, 89, 10, 95, 11, 68, NULL, 0, '2020-11-02 11:17:18', '2020-11-02 11:17:18'),
(15, 'MBA Exam', 'Culpa laborum eiusm', NULL, NULL, 81, 5, 31, 59, 87, 14, 1, '2020-11-02 12:15:43', '2020-11-02 12:15:43'),
(16, 'Ignacia Jordan', 'Sed magni iusto cupi', NULL, NULL, 48, 20, 98, 50, 6, 10, 1, '2020-11-02 12:19:22', '2020-11-02 12:19:25'),
(17, 'Dominique Welch', 'Exercitationem illum', NULL, NULL, 23, 14, 21, 45, 76, 11, 1, '2020-11-02 12:19:33', '2020-11-02 12:19:33'),
(18, 'Hector Dorsey', 'Cumque aperiam praes', NULL, NULL, 10, 12, 49, 13, 26, 11, 0, '2020-11-02 12:19:38', '2020-11-02 12:19:38'),
(19, 'Shoshana Ellison', 'Ipsa illum modi cu', NULL, NULL, 28, 9, 42, 68, 94, 12, 1, '2020-11-02 12:19:42', '2020-11-02 12:19:44'),
(20, 'Merrill Thompson', 'Voluptatibus et numq', NULL, NULL, 42, 11, 59, 86, 1, 7, 0, '2020-11-02 12:19:56', '2020-11-02 12:19:56');

-- --------------------------------------------------------

--
-- Table structure for table `category_unlocks`
--

DROP TABLE IF EXISTS `category_unlocks`;
CREATE TABLE IF NOT EXISTS `category_unlocks` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `category_id` int(10) UNSIGNED NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `category_unlocks_user_id_foreign` (`user_id`),
  KEY `category_unlocks_category_id_foreign` (`category_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `coins`
--

DROP TABLE IF EXISTS `coins`;
CREATE TABLE IF NOT EXISTS `coins` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount` decimal(13,2) NOT NULL DEFAULT '0.00',
  `sold_amount` decimal(13,2) NOT NULL DEFAULT '0.00',
  `price` decimal(13,2) NOT NULL DEFAULT '0.00',
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `is_active` tinyint(4) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `coins`
--

INSERT INTO `coins` (`id`, `name`, `amount`, `sold_amount`, `price`, `status`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'Default Coin', '500.00', '0.00', '10.00', 1, 1, '2020-10-28 10:19:52', '2020-10-28 10:19:52');

-- --------------------------------------------------------

--
-- Table structure for table `home_sliders`
--

DROP TABLE IF EXISTS `home_sliders`;
CREATE TABLE IF NOT EXISTS `home_sliders` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=42 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2016_06_01_000001_create_oauth_auth_codes_table', 1),
(4, '2016_06_01_000002_create_oauth_access_tokens_table', 1),
(5, '2016_06_01_000003_create_oauth_refresh_tokens_table', 1),
(6, '2016_06_01_000004_create_oauth_clients_table', 1),
(7, '2016_06_01_000005_create_oauth_personal_access_clients_table', 1),
(8, '2018_12_26_075334_create_user_verification_codes_table', 1),
(9, '2018_12_26_091755_create_admin_settings_table', 1),
(10, '2018_12_26_161850_create_categories_table', 1),
(11, '2018_12_26_162740_create_questions_table', 1),
(12, '2018_12_26_164629_create_user_answers_table', 1),
(13, '2018_12_26_165706_create_quiz_results_table', 1),
(14, '2018_12_27_065913_create_question_options_table', 1),
(15, '2019_01_09_113629_add_device_type_and_device_id_at_users', 1),
(16, '2019_01_21_164742_add_coin_to_category', 1),
(17, '2019_01_21_165747_add_skip_coin_to_question', 1),
(18, '2019_01_21_170525_create_user_coins_table', 1),
(19, '2019_01_25_090723_create_category_unlocks_table', 1),
(20, '2019_02_08_055113_add_video_link_at_question', 1),
(21, '2019_03_21_080343_add_parent_id_to_category', 1),
(22, '2019_03_21_100215_add_sub_category_to_question', 1),
(23, '2019_09_09_062208_create_coins_table', 1),
(24, '2019_09_09_065750_create_payment_methods_table', 1),
(25, '2019_09_09_065806_create_sells_table', 1),
(26, '2019_09_11_133456_change_coin_type_of_usercoin', 1),
(27, '2019_09_24_140218_create_web_features_table', 1),
(28, '2019_09_26_055011_create_question_times_table', 1),
(29, '2019_09_27_113606_add-white-image-at-category', 1),
(30, '2019_10_01_121634_add_quizid_at_useranswer', 1),
(31, '2020_05_14_085902_create_user_points_table', 1),
(32, '2020_05_15_102906_create_user_point_distribution_log_table', 1),
(33, '2020_05_15_104217_create_withdrawal_request_by__point_table', 1),
(34, '2020_05_18_082155_add_referrals_to_users_table', 1),
(35, '2020_06_10_204528_add_daily_login_date_to_users_table', 1),
(36, '2020_10_25_035214_create_book_categories_table', 1),
(37, '2020_10_26_155045_create_books_table', 1),
(38, '2020_10_26_172959_create_paper_categories_table', 1),
(39, '2020_10_26_183237_create_old_papers_table', 1),
(40, '2020_10_27_034324_create_posts_table', 1),
(41, '2020_10_28_163849_create_home_sliders_table', 2);

-- --------------------------------------------------------

--
-- Table structure for table `oauth_access_tokens`
--

DROP TABLE IF EXISTS `oauth_access_tokens`;
CREATE TABLE IF NOT EXISTS `oauth_access_tokens` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `client_id` int(11) NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `scopes` text COLLATE utf8mb4_unicode_ci,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `expires_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `oauth_access_tokens_user_id_index` (`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `oauth_auth_codes`
--

DROP TABLE IF EXISTS `oauth_auth_codes`;
CREATE TABLE IF NOT EXISTS `oauth_auth_codes` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(11) NOT NULL,
  `client_id` int(11) NOT NULL,
  `scopes` text COLLATE utf8mb4_unicode_ci,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `oauth_clients`
--

DROP TABLE IF EXISTS `oauth_clients`;
CREATE TABLE IF NOT EXISTS `oauth_clients` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `secret` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `redirect` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `personal_access_client` tinyint(1) NOT NULL,
  `password_client` tinyint(1) NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `oauth_clients_user_id_index` (`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `oauth_personal_access_clients`
--

DROP TABLE IF EXISTS `oauth_personal_access_clients`;
CREATE TABLE IF NOT EXISTS `oauth_personal_access_clients` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `client_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `oauth_personal_access_clients_client_id_index` (`client_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `oauth_refresh_tokens`
--

DROP TABLE IF EXISTS `oauth_refresh_tokens`;
CREATE TABLE IF NOT EXISTS `oauth_refresh_tokens` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `access_token_id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `oauth_refresh_tokens_access_token_id_index` (`access_token_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `old_papers`
--

DROP TABLE IF EXISTS `old_papers`;
CREATE TABLE IF NOT EXISTS `old_papers` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `paper_category_id` int(11) NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `creator_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `paper_pdf` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `language` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `old_papers_paper_category_id_foreign` (`paper_category_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `paper_categories`
--

DROP TABLE IF EXISTS `paper_categories`;
CREATE TABLE IF NOT EXISTS `paper_categories` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payment_methods`
--

DROP TABLE IF EXISTS `payment_methods`;
CREATE TABLE IF NOT EXISTS `payment_methods` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `payment_methods`
--

INSERT INTO `payment_methods` (`id`, `name`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Paypal', 1, '2020-10-28 10:19:52', '2020-10-28 10:19:52'),
(2, 'Credit Card', 1, '2020-10-28 10:19:52', '2020-10-28 10:19:52'),
(3, 'RazorPay', 1, '2020-10-28 10:19:52', '2020-10-28 10:19:52'),
(4, 'PayU', 1, '2020-10-28 10:19:52', '2020-10-28 10:19:52');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

DROP TABLE IF EXISTS `posts`;
CREATE TABLE IF NOT EXISTS `posts` (
  `name` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

DROP TABLE IF EXISTS `questions`;
CREATE TABLE IF NOT EXISTS `questions` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `category_id` int(10) UNSIGNED NOT NULL,
  `sub_category_id` int(11) DEFAULT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` int(11) DEFAULT NULL,
  `serial` int(11) DEFAULT NULL,
  `answer` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `time_limit` int(11) DEFAULT NULL,
  `point` int(11) NOT NULL DEFAULT '0',
  `coin` int(11) NOT NULL DEFAULT '0',
  `video_link` text COLLATE utf8mb4_unicode_ci,
  `hints` text COLLATE utf8mb4_unicode_ci,
  `skip_coin` int(11) NOT NULL DEFAULT '0',
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `questions_category_id_foreign` (`category_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `question_options`
--

DROP TABLE IF EXISTS `question_options`;
CREATE TABLE IF NOT EXISTS `question_options` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `question_id` bigint(20) UNSIGNED NOT NULL,
  `option_title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `option_image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `serial` int(11) DEFAULT NULL,
  `is_answer` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `question_options_question_id_foreign` (`question_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `question_times`
--

DROP TABLE IF EXISTS `question_times`;
CREATE TABLE IF NOT EXISTS `question_times` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) DEFAULT NULL,
  `question_id` bigint(20) DEFAULT NULL,
  `expire_time` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `quiz_results`
--

DROP TABLE IF EXISTS `quiz_results`;
CREATE TABLE IF NOT EXISTS `quiz_results` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `category_id` int(10) UNSIGNED NOT NULL,
  `score` bigint(20) NOT NULL DEFAULT '0',
  `coin` bigint(20) NOT NULL DEFAULT '0',
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `quiz_results_user_id_foreign` (`user_id`),
  KEY `quiz_results_category_id_foreign` (`category_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sells`
--

DROP TABLE IF EXISTS `sells`;
CREATE TABLE IF NOT EXISTS `sells` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `coin_id` int(10) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `payment_id` int(10) UNSIGNED NOT NULL,
  `amount` decimal(13,2) NOT NULL DEFAULT '0.00',
  `price` decimal(13,2) NOT NULL DEFAULT '0.00',
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `sells_coin_id_foreign` (`coin_id`),
  KEY `sells_user_id_foreign` (`user_id`),
  KEY `sells_payment_id_foreign` (`payment_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `affiliate_id` bigint(20) DEFAULT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `country` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `photo` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `active_status` tinyint(4) NOT NULL DEFAULT '1',
  `role` tinyint(4) NOT NULL DEFAULT '2',
  `email_verified` varchar(256) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `reset_code` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `city` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `state` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `zip` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `language` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `device_id` text COLLATE utf8mb4_unicode_ci,
  `device_type` tinyint(4) NOT NULL DEFAULT '1',
  `push_notification_status` tinyint(1) NOT NULL DEFAULT '1',
  `email_notification_status` tinyint(1) NOT NULL DEFAULT '1',
  `referral_code` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `daily_login_date` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`),
  UNIQUE KEY `users_reset_code_unique` (`reset_code`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `affiliate_id`, `name`, `email`, `password`, `country`, `phone`, `photo`, `active_status`, `role`, `email_verified`, `reset_code`, `city`, `state`, `address`, `zip`, `language`, `device_id`, `device_type`, `push_notification_status`, `email_notification_status`, `referral_code`, `remember_token`, `daily_login_date`, `created_at`, `updated_at`) VALUES
(1, NULL, 'Mr. Admin', 'admin@email.com', '$2y$10$ifuWAR.dLGRjF5F/9XFyFuWkqgePmprDtNMkvMOA/f5G5ZNWjty1S', NULL, NULL, NULL, 1, 1, '1', '8a6ee38af6eca178c47b11896055f156', NULL, NULL, NULL, NULL, 'en', NULL, 1, 1, 1, NULL, NULL, NULL, '2020-10-28 10:19:52', '2020-10-28 10:19:52'),
(2, NULL, 'Mr. User', 'user@email.com', '$2y$10$I1iCbEZU7bRrN02jZJqNd.RaXUzf8BNQrIaHERYHa8jY4LXHvAARm', NULL, NULL, NULL, 1, 2, '1', '42de4e439359941aca2bbf028c6b6ada', NULL, NULL, NULL, NULL, 'en', NULL, 1, 1, 1, 'avKyx6G3KF', NULL, NULL, '2020-10-28 10:19:52', '2020-10-28 10:19:52');

-- --------------------------------------------------------

--
-- Table structure for table `user_answers`
--

DROP TABLE IF EXISTS `user_answers`;
CREATE TABLE IF NOT EXISTS `user_answers` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `quiz_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `category_id` int(10) UNSIGNED NOT NULL,
  `question_id` bigint(20) UNSIGNED NOT NULL,
  `is_correct` tinyint(1) NOT NULL DEFAULT '0',
  `given_answer` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `point` int(11) NOT NULL DEFAULT '0',
  `type` int(11) NOT NULL DEFAULT '1',
  `coin` int(11) NOT NULL DEFAULT '0',
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_answers_user_id_foreign` (`user_id`),
  KEY `user_answers_category_id_foreign` (`category_id`),
  KEY `user_answers_question_id_foreign` (`question_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user_coins`
--

DROP TABLE IF EXISTS `user_coins`;
CREATE TABLE IF NOT EXISTS `user_coins` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `coin` decimal(13,2) NOT NULL DEFAULT '0.00',
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_coins_user_id_foreign` (`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_coins`
--

INSERT INTO `user_coins` (`id`, `user_id`, `coin`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, '100.00', 1, '2020-10-28 10:19:52', '2020-10-28 10:19:52'),
(2, 2, '100.00', 1, '2020-10-28 10:19:52', '2020-10-28 10:19:52');

-- --------------------------------------------------------

--
-- Table structure for table `user_points`
--

DROP TABLE IF EXISTS `user_points`;
CREATE TABLE IF NOT EXISTS `user_points` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `point` bigint(20) NOT NULL DEFAULT '0',
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_points_user_id_foreign` (`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user_point_distribution_log`
--

DROP TABLE IF EXISTS `user_point_distribution_log`;
CREATE TABLE IF NOT EXISTS `user_point_distribution_log` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `admin_setting_slug` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'default',
  `operation_type` enum('Add','Subtract') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Add',
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `point` bigint(20) NOT NULL DEFAULT '0',
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_point_distribution_log_user_id_foreign` (`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user_verification_codes`
--

DROP TABLE IF EXISTS `user_verification_codes`;
CREATE TABLE IF NOT EXISTS `user_verification_codes` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `type` tinyint(1) NOT NULL,
  `code` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `expired_at` date DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_verification_codes_user_id_foreign` (`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `web_features`
--

DROP TABLE IF EXISTS `web_features`;
CREATE TABLE IF NOT EXISTS `web_features` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `image` text COLLATE utf8mb4_unicode_ci,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `withdrawal_request_by_point`
--

DROP TABLE IF EXISTS `withdrawal_request_by_point`;
CREATE TABLE IF NOT EXISTS `withdrawal_request_by_point` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `point` bigint(20) NOT NULL DEFAULT '0',
  `equivalent_currency` bigint(20) NOT NULL DEFAULT '0',
  `withdrawal_by` enum('Bank','Paypal','Admin Request') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Admin Request',
  `status` enum('Requested','Approved','Withdrawn','Declined') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Requested',
  `paypal_account_id` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bank_name` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bank_account_number` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bank_account_name` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bank_account_route` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `withdrawal_request_by_point_user_id_foreign` (`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
