-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 04, 2021 at 01:48 PM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `reign_buy_sell`
--

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `inventory_brands`
--

CREATE TABLE `inventory_brands` (
  `id` int(11) NOT NULL,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL COMMENT '1 = active, 0 = inactive',
  `deleted` tinyint(1) NOT NULL COMMENT '1 = deleted; 0 = not deleted'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `inventory_brands`
--

INSERT INTO `inventory_brands` (`id`, `name`, `status`, `deleted`) VALUES
(40, 'Apple', 1, 0),
(41, 'Aci', 1, 0),
(42, 'Beximco', 1, 0),
(43, 'Samsung', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `inventory_categories`
--

CREATE TABLE `inventory_categories` (
  `id` int(11) NOT NULL,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `is_countable` tinyint(1) NOT NULL COMMENT '1 = Countable; 0 = Uncountable',
  `status` tinyint(1) NOT NULL,
  `deleted` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `inventory_categories`
--

INSERT INTO `inventory_categories` (`id`, `name`, `is_countable`, `status`, `deleted`) VALUES
(43, 'Phone', 1, 1, 0),
(44, 'Liquid', 0, 1, 0),
(45, 'Cloth', 1, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `inventory_products`
--

CREATE TABLE `inventory_products` (
  `id` int(11) NOT NULL,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `category_id` int(11) NOT NULL,
  `tag` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `unit_type` smallint(6) NOT NULL,
  `stock_qty` int(11) NOT NULL DEFAULT 0,
  `purchase_qty` int(11) NOT NULL DEFAULT 0,
  `total_price` decimal(10,2) NOT NULL DEFAULT 0.00,
  `status` tinyint(1) NOT NULL DEFAULT 1 COMMENT '1 = active, 0 = inactive',
  `deleted` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `inventory_products`
--

INSERT INTO `inventory_products` (`id`, `name`, `category_id`, `tag`, `unit_type`, `stock_qty`, `purchase_qty`, `total_price`, `status`, `deleted`) VALUES
(5, 'S11', 43, 'S11', 6, 0, 0, '0.00', 1, 0),
(8, 'Jacket', 45, 'Jacket', 6, 12, 12, '14400.00', 1, 0),
(11, 'Hand Sanitizer', 44, 'Hand Sanitizer', 6, 50, 50, '2500.00', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `inventory_purchase_orders`
--

CREATE TABLE `inventory_purchase_orders` (
  `id` int(11) NOT NULL,
  `purchase_order_id` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `total_price` decimal(10,2) NOT NULL,
  `vendor_id` int(11) NOT NULL,
  `purchased_by` varchar(11) COLLATE utf8_unicode_ci NOT NULL,
  `purchase_date` date NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `inventory_purchase_orders`
--

INSERT INTO `inventory_purchase_orders` (`id`, `purchase_order_id`, `total_price`, `vendor_id`, `purchased_by`, `purchase_date`, `created_at`) VALUES
(134, 'PO-0001', '16900.00', 20, 'admin', '2021-02-01', '2021-02-04 10:50:09');

-- --------------------------------------------------------

--
-- Table structure for table `inventory_purchase_order_products`
--

CREATE TABLE `inventory_purchase_order_products` (
  `id` int(11) NOT NULL,
  `purchase_order_id` varchar(11) COLLATE utf8_unicode_ci NOT NULL,
  `product_id` int(20) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `qty` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `inventory_purchase_order_products`
--

INSERT INTO `inventory_purchase_order_products` (`id`, `purchase_order_id`, `product_id`, `price`, `qty`, `created_at`) VALUES
(1064, 'PO-0001', 8, '14400.00', 12, '2021-02-04 10:50:09'),
(1065, 'PO-0001', 11, '2500.00', 50, '2021-02-04 10:50:09');

-- --------------------------------------------------------

--
-- Table structure for table `inventory_units`
--

CREATE TABLE `inventory_units` (
  `id` int(11) NOT NULL,
  `unit_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL COMMENT '1 = active, 0 = inactive',
  `deleted` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `inventory_units`
--

INSERT INTO `inventory_units` (`id`, `unit_name`, `status`, `deleted`) VALUES
(6, 'Piece', 1, 0),
(7, 'Meter', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `inventory_vendors`
--

CREATE TABLE `inventory_vendors` (
  `id` int(11) NOT NULL,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `phone` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `contact_person` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `purchase_amount` decimal(10,2) DEFAULT 0.00,
  `status` tinyint(1) NOT NULL COMMENT '0= inactive, 1= active',
  `deleted` tinyint(1) NOT NULL DEFAULT 0 COMMENT '1 = deleted, 0 = not deleted'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `inventory_vendors`
--

INSERT INTO `inventory_vendors` (`id`, `name`, `address`, `phone`, `contact_person`, `purchase_amount`, `status`, `deleted`) VALUES
(19, 'Technology Limited', 'Rampura, Dhaka', '01799228866', 'Md. Rahim', '0.00', 0, 0),
(20, 'Stock Solution', 'Malibugh, Dhaka', '01790234567', 'Md. Hamim', '0.00', 1, 0);

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
(3, '2019_08_19_000000_create_failed_jobs_table', 1);

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
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` tinyint(4) NOT NULL DEFAULT 1 COMMENT '0 = Super Admin; 1 = Admin Assistant',
  `status` tinyint(4) NOT NULL DEFAULT 1 COMMENT '0 = inactive; 1 = Active;',
  `deleted` tinyint(4) DEFAULT 0 COMMENT '0 = Active; 1 = Inactive;',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `email_verified_at`, `password`, `type`, `status`, `deleted`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'admin@gmail.com', NULL, '$2y$10$IZDSC3ZHjMqY5xAA67N45eyf4pDvvKWXYrvK91Ox5LoJpZKGJlzyK', 0, 1, 0, NULL, NULL, NULL),
(2, 'test1', 'test1@gmail.com', NULL, '$2y$10$k/fIb6/MZYPviWu082v5HeHWVI4Pb3uB22v5DFoo.kCxr/sgc5kc.', 1, 0, 0, NULL, '2021-01-18 04:17:35', '2021-01-24 03:11:53'),
(3, 'test2', 'test2@gmail.com', NULL, '$2y$10$lXXrRKkKfp546ALk9LXR..15xnap5la2dxr..wuM0e.OJV/kiPrV.', 1, 0, 0, NULL, '2021-01-18 05:28:28', '2021-01-21 00:48:32'),
(4, 'test3', 'test3@gmail.com', NULL, '$2y$10$vGnviiMylO9yXDfa7NvcfObrjCQcFQOimRUKn.2.9EBjYPY7iR0xO', 1, 0, 0, NULL, '2021-01-19 03:06:27', '2021-02-03 06:46:06'),
(5, 'user', 'user@gmail.com', NULL, '$2y$10$o.lX/AremHx1v1QBhi5CkePLiF6B/Y4A.mUWtBblwT/lWBFWeKusa', 1, 1, 0, NULL, '2021-01-20 02:03:16', '2021-01-21 00:48:25');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `inventory_brands`
--
ALTER TABLE `inventory_brands`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `inventory_categories`
--
ALTER TABLE `inventory_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `inventory_products`
--
ALTER TABLE `inventory_products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `inventory_purchase_orders`
--
ALTER TABLE `inventory_purchase_orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `inventory_purchase_order_products`
--
ALTER TABLE `inventory_purchase_order_products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `inventory_units`
--
ALTER TABLE `inventory_units`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `inventory_vendors`
--
ALTER TABLE `inventory_vendors`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `inventory_brands`
--
ALTER TABLE `inventory_brands`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `inventory_categories`
--
ALTER TABLE `inventory_categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `inventory_products`
--
ALTER TABLE `inventory_products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `inventory_purchase_orders`
--
ALTER TABLE `inventory_purchase_orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=135;

--
-- AUTO_INCREMENT for table `inventory_purchase_order_products`
--
ALTER TABLE `inventory_purchase_order_products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1066;

--
-- AUTO_INCREMENT for table `inventory_units`
--
ALTER TABLE `inventory_units`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `inventory_vendors`
--
ALTER TABLE `inventory_vendors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

DELIMITER $$
--
-- Events
--
CREATE DEFINER=`root`@`localhost` EVENT `set_offline` ON SCHEDULE EVERY 5 MINUTE STARTS '2019-02-05 18:32:54' ON COMPLETION NOT PRESERVE ENABLE DO CALL set_offline_in_online_table()$$

DELIMITER ;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
