-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 24, 2019 at 04:12 AM
-- Server version: 10.3.16-MariaDB
-- PHP Version: 7.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `farmerodb`
--
CREATE DATABASE IF NOT EXISTS `farmerodb` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `farmerodb`;

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

DROP TABLE IF EXISTS `cart`;
CREATE TABLE `cart` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` int(11) NOT NULL,
  `prod_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `prod_code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` double(8,2) NOT NULL,
  `quantity` int(11) NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `user_email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `session_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- RELATIONSHIPS FOR TABLE `cart`:
--   `user_id`
--       `users` -> `id`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
CREATE TABLE `categories` (
  `id` int(10) UNSIGNED NOT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- RELATIONSHIPS FOR TABLE `categories`:
--

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `parent_id`, `name`, `description`, `status`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 0, 'Chemicals', 'Chemicals Category includes Insecticide, Herbicide, Fungicide, Molluscide', 1, NULL, '2019-08-15 02:51:41', '2019-09-17 07:33:51'),
(2, 0, 'Feeds', 'Feeds Category', 1, NULL, '2019-08-15 02:51:57', '2019-09-17 07:34:06'),
(3, 0, 'Veterinary', 'Veterinary Category', 1, NULL, '2019-09-17 07:42:36', '2019-09-17 07:42:36'),
(4, 0, 'Fertilizer', 'Fertilizer Category', 1, NULL, '2019-09-17 07:44:01', '2019-09-17 07:44:01'),
(5, 0, 'Seeds', 'Seeds Category', 1, NULL, '2019-09-17 07:47:51', '2019-09-17 07:47:51');

-- --------------------------------------------------------

--
-- Table structure for table `coupons`
--

DROP TABLE IF EXISTS `coupons`;
CREATE TABLE `coupons` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `coupon_code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount` int(11) NOT NULL,
  `expiry_date` date NOT NULL,
  `status` tinyint(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- RELATIONSHIPS FOR TABLE `coupons`:
--

-- --------------------------------------------------------

--
-- Table structure for table `dashboards`
--

DROP TABLE IF EXISTS `dashboards`;
CREATE TABLE `dashboards` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- RELATIONSHIPS FOR TABLE `dashboards`:
--

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- RELATIONSHIPS FOR TABLE `migrations`:
--

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_07_153536_create_categories_table', 1),
(4, '2019_08_14_120513_create_products_table', 2),
(5, '2019_08_21_043657_add_stocks_to_products_table', 3),
(9, '2019_08_21_052441_create_carts_table', 4),
(16, '2019_08_25_135507_create_orders_table', 5),
(17, '2019_08_25_142116_create_coupons_table', 5),
(18, '2019_08_26_141212_create_order_products_table', 6),
(19, '2019_09_18_121142_create_dashboards_table', 7),
(20, '2019_09_18_163034_add_status_to_orders_table', 7);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
CREATE TABLE `orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `user_email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `street` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `barangay` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `city` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `province` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `contact` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `order_notes` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `shipping_charges` double(8,2) NOT NULL,
  `coupon_code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `coupon_amount` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payment_method` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total` decimal(8,2) NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- RELATIONSHIPS FOR TABLE `orders`:
--

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `user_email`, `name`, `street`, `barangay`, `city`, `province`, `contact`, `order_notes`, `shipping_charges`, `coupon_code`, `coupon_amount`, `payment_method`, `total`, `status`, `created_at`, `updated_at`) VALUES
(1, 2, 'test@email.com', 'Test User', 'TR St.', 'Subabasbas', 'Lapu-Lapu City', 'Cebu', '09123456987', '', 0.00, 'NO Coupon', '0', 'COD', '299.97', 'Cancelled', '2019-09-22 09:28:37', '2019-09-23 06:17:51'),
(2, 2, 'test@email.com', 'Test User', 'TR St.', 'Subabasbas', 'Lapu-Lapu City', 'Cebu', '09123456987', '', 0.00, 'NO Coupon', '0', 'COD', '750.00', 'For Delivery', '2019-09-22 09:28:56', '2019-09-23 06:32:45'),
(3, 2, 'test@email.com', 'Test User', 'TR St.', 'Subabasbas', 'Lapu-Lapu City', 'Cebu', '09123456987', '', 0.00, 'NO Coupon', '0', 'COD', '649.98', 'Pending', '2019-09-23 06:34:26', '2019-09-23 08:19:03');

-- --------------------------------------------------------

--
-- Table structure for table `order_details`
--

DROP TABLE IF EXISTS `order_details`;
CREATE TABLE `order_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `prod_id` int(11) NOT NULL,
  `prod_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `prod_code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `prod_price` decimal(8,2) NOT NULL,
  `prod_qty` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- RELATIONSHIPS FOR TABLE `order_details`:
--

--
-- Dumping data for table `order_details`
--

INSERT INTO `order_details` (`id`, `order_id`, `user_id`, `prod_id`, `prod_name`, `prod_code`, `prod_price`, `prod_qty`, `created_at`, `updated_at`) VALUES
(1, 1, 2, 2, 'Malunggay Seeds 70g', 'MLGY70G200S', '99.99', '3', '2019-09-22 09:28:37', '2019-09-22 09:28:37'),
(2, 2, 2, 1, 'PROFENOFOS 50%EC 1L', 'PROFEN50EC1L', '150.00', '5', '2019-09-22 09:28:56', '2019-09-22 09:28:56'),
(3, 3, 2, 1, 'PROFENOFOS 50%EC 1L', 'PROFEN50EC1L', '150.00', '3', '2019-09-23 06:34:26', '2019-09-23 06:34:26'),
(4, 3, 2, 2, 'Malunggay Seeds 70g', 'MLGY70G200S', '99.99', '2', '2019-09-23 06:34:26', '2019-09-23 06:34:26');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- RELATIONSHIPS FOR TABLE `password_resets`:
--

--
-- Dumping data for table `password_resets`
--

INSERT INTO `password_resets` (`email`, `token`, `created_at`) VALUES
('test@email.com', '$2y$10$UlY9/2xpDeRELXRE7/XGTOPbecOclGrAPrPI/SasESLfk38lAh1B6', '2019-09-15 04:51:35');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category_id` int(11) NOT NULL,
  `prod_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `prod_code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` decimal(8,2) NOT NULL,
  `stocks` int(11) NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- RELATIONSHIPS FOR TABLE `products`:
--

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `category_id`, `prod_name`, `prod_code`, `description`, `price`, `stocks`, `image`, `created_at`, `updated_at`) VALUES
(1, 1, 'PROFENOFOS 50%EC 1L', 'PROFEN50EC1L', 'PROFENOFOS 50%EC 1L\r\nCrops Pests Tomato Fruitworm, armyworm, cutworm Eggplant Fruitborer, aphids, leafhopper, thrips Cabbage Diamond-back moth, cabbage worm, aphids Watermelon Thrips Potato Thrips, armyworm, cutworm, tubermoth Soybeans, Mungbeans Cornearworm, earworm, leafminers Cotton Thrips, bollworm, budworm Sitao Beanfly, leaffolder, aphids', '150.00', 92, '8428.png', '2019-09-17 08:15:03', '2019-09-23 06:34:26'),
(2, 5, 'Malunggay Seeds 70g', 'MLGY70G200S', 'Dried malunggay seeds 70 grams/200 seeds per pack', '99.99', 70, '69150.jpg', '2019-09-17 08:29:25', '2019-09-23 06:34:26');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `isAdmin` tinyint(1) DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `contact` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address_street` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address_barangay` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address_city` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address_province` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- RELATIONSHIPS FOR TABLE `users`:
--

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `isAdmin`, `email_verified_at`, `password`, `contact`, `address_street`, `address_barangay`, `address_city`, `address_province`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'admin@farmero.com', 1, '2019-08-07 07:58:24', '$2y$10$AWfD6wga6bdTvoL8jVIjC.qGVJ5MzDeBamR2bes5J89.MYESyPgYK', '09123456789', 'UCLM', 'Looc', 'Mandaue City', 'PH-CEB', '5oT7VyLZ8rKIjoeosuASjI2DoQIdyk09LK2RSNE0nSCI3rohMsc8VTlyegEW', '2019-08-07 07:58:04', '2019-08-07 07:58:24'),
(2, 'Test User', 'test@email.com', NULL, '2019-08-07 08:01:40', '$2y$10$qrAdLn.l/VKGvbNO3B/KTOwFu8yAgreTU6fiwZsdSWd8euKXpTkhK', '09123456987', 'TR St.', 'Subabasbas', 'Lapu-Lapu City', 'Cebu', 'PxBGKgCONmzjnEXFhFeAa2UFK3xwYjiIE2lRjXXXCRmvuH08gUBQWYOuWe7k', '2019-08-07 08:01:33', '2019-08-07 08:01:40'),
(3, 'Mark Ortega', 'ortega_markdavid@yahoo.com', NULL, '2019-09-18 08:13:55', '$2y$10$p764Yv1vbPJKdLzTWJJicOPzd3/UIrpcDhH8KwYkrv.DPG7fyHtla', '09999999999', 'Tribu', 'SubaBasbas', 'Lapu-Lapu City', 'PH-CEB', NULL, '2019-09-18 08:13:35', '2019-09-18 08:13:55');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cart_user_id_foreign` (`user_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `slug` (`name`);

--
-- Indexes for table `coupons`
--
ALTER TABLE `coupons`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dashboards`
--
ALTER TABLE `dashboards`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_details`
--
ALTER TABLE `order_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD UNIQUE KEY `users_contact_unique` (`contact`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `coupons`
--
ALTER TABLE `coupons`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `dashboards`
--
ALTER TABLE `dashboards`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `order_details`
--
ALTER TABLE `order_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
