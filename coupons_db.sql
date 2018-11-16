-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 16, 2018 at 12:20 PM
-- Server version: 10.1.36-MariaDB
-- PHP Version: 5.6.38

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `coupons_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `old_name` varchar(256) NOT NULL,
  `detail` text NOT NULL,
  `meta_title` varchar(256) NOT NULL,
  `meta_detail` varchar(256) NOT NULL,
  `publisher` int(11) NOT NULL,
  `edited_by` int(11) NOT NULL,
  `updated` datetime NOT NULL,
  `created` datetime NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `old_name`, `detail`, `meta_title`, `meta_detail`, `publisher`, `edited_by`, `updated`, `created`, `is_active`) VALUES
(5, 'Apparel & Clothing Deals', '', 'Save more on your shopping on Clothing and apparel', 'Apparel & Clothing Deals | Apparel & Clothing Coupons', 'Apparel & Clothing Deals 2018 for everyone shop now to save more', 5, 1, '0000-00-00 00:00:00', '2018-11-06 00:00:00', 1),
(9, 'cloths', '', 'asd', 'asd', 'asd', 1, 0, '0000-00-00 00:00:00', '2018-11-14 15:17:24', 1);

-- --------------------------------------------------------

--
-- Table structure for table `coupons`
--

CREATE TABLE `coupons` (
  `id` int(11) NOT NULL,
  `name` varchar(256) NOT NULL DEFAULT '',
  `detail` text NOT NULL,
  `discount` varchar(20) NOT NULL,
  `code` varchar(256) NOT NULL,
  `type` varchar(100) NOT NULL,
  `store_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `address` varchar(256) NOT NULL,
  `rank` int(50) NOT NULL,
  `spam` tinyint(1) NOT NULL DEFAULT '0',
  `active_date` date NOT NULL,
  `expire_date` date NOT NULL,
  `publisher` int(11) NOT NULL,
  `edited_by` int(11) NOT NULL,
  `is_top` tinyint(1) NOT NULL DEFAULT '0',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `global_settings`
--

CREATE TABLE `global_settings` (
  `id` int(11) NOT NULL,
  `title` text NOT NULL,
  `detail` text NOT NULL,
  `meta_title` text NOT NULL,
  `meta_detail` text NOT NULL,
  `web_name` varchar(256) NOT NULL,
  `created` date NOT NULL,
  `is_active` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `global_settings`
--

INSERT INTO `global_settings` (`id`, `title`, `detail`, `meta_title`, `meta_detail`, `web_name`, `created`, `is_active`) VALUES
(1, 'Coupons Codes', 'This a testing detail for coupons Code', 'This a testing detail for coupons Code', 'This a testing detail for coupons Code', 'Couponscode.com.au', '2018-11-01', 1);

-- --------------------------------------------------------

--
-- Table structure for table `networks`
--

CREATE TABLE `networks` (
  `id` int(11) NOT NULL,
  `name` varchar(256) NOT NULL,
  `address` text NOT NULL,
  `network_id` varchar(256) NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `publisher` int(11) NOT NULL,
  `edited_by` int(11) NOT NULL,
  `updated` datetime NOT NULL,
  `created` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `networks`
--

INSERT INTO `networks` (`id`, `name`, `address`, `network_id`, `is_active`, `publisher`, `edited_by`, `updated`, `created`) VALUES
(5, 'ebay', 'ebay.com', '12323211', 1, 1, 1, '2018-11-15 16:01:10', '0000-00-00 00:00:00'),
(6, 'FOD', 'Fsales.com', '2134121323', 1, 1, 1, '2018-11-15 16:01:06', '2018-11-09 16:59:28'),
(7, 'Cloths', 'cloths.com', '1233213', 1, 1, 1, '2018-11-15 16:00:59', '2018-11-09 17:04:13'),
(8, 'as', 'awais', '321', 1, 5, 1, '2018-11-15 16:00:52', '2018-11-09 17:41:49'),
(9, 'Awais', 'asdar', '1234', 1, 5, 1, '2018-11-15 16:00:46', '2018-11-09 17:47:29'),
(10, 'awais.com', 'awais.com', '1234', 1, 5, 1, '2018-11-15 16:00:41', '2018-11-09 17:57:59'),
(11, 'couponscode', 'test.com', '123', 1, 1, 1, '2018-11-15 17:00:02', '2018-11-15 16:01:36');

-- --------------------------------------------------------

--
-- Table structure for table `role_permissions`
--

CREATE TABLE `role_permissions` (
  `id` int(11) NOT NULL,
  `user_role_id` int(11) NOT NULL,
  `section` varchar(100) NOT NULL,
  `p_add` tinyint(1) NOT NULL DEFAULT '0',
  `p_edit` tinyint(1) NOT NULL DEFAULT '0',
  `p_view` tinyint(1) NOT NULL DEFAULT '0',
  `p_delete` tinyint(1) NOT NULL DEFAULT '0',
  `created` datetime NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `role_permissions`
--

INSERT INTO `role_permissions` (`id`, `user_role_id`, `section`, `p_add`, `p_edit`, `p_view`, `p_delete`, `created`, `is_active`) VALUES
(7, 1, 'categories', 1, 1, 1, 1, '2018-11-01 15:03:39', 1),
(8, 1, 'networks', 1, 1, 1, 1, '2018-11-01 15:03:59', 1),
(9, 1, 'stores', 1, 1, 1, 1, '2018-11-01 15:04:18', 1),
(10, 1, 'coupons', 1, 1, 1, 1, '2018-11-01 15:04:58', 1),
(11, 1, 'global settings', 1, 1, 1, 1, '2018-11-01 15:05:12', 1),
(12, 1, 'roles', 1, 1, 1, 1, '2018-11-01 15:06:10', 1),
(13, 1, 'users', 1, 1, 1, 1, '2018-11-01 15:06:22', 1),
(14, 1, 'reports', 1, 1, 1, 1, '2018-11-01 15:06:56', 1),
(15, 1, 'sections', 1, 1, 1, 1, '2018-11-01 15:07:40', 1),
(18, 1, 'permissions', 1, 1, 1, 1, '2018-11-05 18:46:08', 1),
(19, 1, 'coupon report', 1, 1, 1, 1, '2018-11-16 15:25:38', 1),
(20, 1, 'store report', 1, 1, 1, 1, '2018-11-16 15:25:46', 1),
(21, 1, 'network report', 1, 1, 1, 1, '2018-11-16 15:25:56', 1),
(22, 1, 'category report', 1, 1, 1, 1, '2018-11-16 15:26:03', 1),
(23, 1, 'upload', 1, 1, 1, 1, '2018-11-16 15:26:15', 1),
(25, 1, 'ranking', 1, 1, 1, 1, '2018-11-16 15:37:37', 1);

-- --------------------------------------------------------

--
-- Table structure for table `sections`
--

CREATE TABLE `sections` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `created` datetime NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sections`
--

INSERT INTO `sections` (`id`, `name`, `created`, `is_active`) VALUES
(2, 'categories', '2018-11-01 14:40:06', 1),
(3, 'networks', '2018-11-01 14:40:15', 1),
(4, 'stores', '2018-11-01 14:40:26', 1),
(5, 'coupons', '2018-11-01 14:40:45', 1),
(6, 'global settings', '2018-11-01 14:41:07', 1),
(7, 'roles', '2018-11-01 14:41:16', 1),
(8, 'permissions', '2018-11-01 14:41:28', 1),
(9, 'users', '2018-11-01 14:41:35', 1),
(10, 'reports', '2018-11-01 14:41:43', 1),
(11, 'sections', '2018-11-01 15:07:22', 1),
(15, 'upload', '2018-11-16 15:23:01', 1),
(17, 'category report', '2018-11-16 15:24:09', 1),
(18, 'network report', '2018-11-16 15:24:20', 1),
(19, 'store report', '2018-11-16 15:24:40', 1),
(20, 'coupon report', '2018-11-16 15:24:58', 1),
(21, 'ranking', '2018-11-16 15:37:21', 1);

-- --------------------------------------------------------

--
-- Table structure for table `stores`
--

CREATE TABLE `stores` (
  `id` int(11) NOT NULL,
  `name` varchar(256) NOT NULL,
  `old_name` varchar(256) NOT NULL,
  `detail` text NOT NULL,
  `logo` varchar(256) NOT NULL,
  `address` text NOT NULL,
  `category_id` int(11) NOT NULL,
  `permalink` varchar(256) NOT NULL,
  `network_id` int(11) NOT NULL,
  `net_store_id` varchar(256) NOT NULL,
  `net_store_name` varchar(256) NOT NULL,
  `net_store_link` varchar(256) NOT NULL,
  `meta_title` varchar(256) NOT NULL,
  `meta_detail` text NOT NULL,
  `spam` tinyint(1) NOT NULL DEFAULT '0',
  `featured` tinyint(1) NOT NULL DEFAULT '0',
  `publisher` int(11) NOT NULL,
  `edited_by` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `stores`
--

INSERT INTO `stores` (`id`, `name`, `old_name`, `detail`, `logo`, `address`, `category_id`, `permalink`, `network_id`, `net_store_id`, `net_store_name`, `net_store_link`, `meta_title`, `meta_detail`, `spam`, `featured`, `publisher`, `edited_by`, `created`, `updated`, `is_active`) VALUES
(9, 'Test Store 1', '', 'asd', 'ChallanPrintPreview_5bed67a2cffc7.gif', 'url', 0, 'coupon-code', 0, 'net id', 'network store name', 'www.zeshee.com/network/', 'sad', 'asd\"\"\"', 0, 1, 1, 1, '2018-11-15 17:33:38', '2018-11-15 17:36:58', 1),
(10, 'couponscode', '', 'asd', 'Screen Shot 2018-10-29 at 3.17.29 PM_5bed6ad26615f.png', 'asdsa', 5, 'coupon-code', 11, '1234', 'Zeshee', 'www.zeshee.com/network/123', 'asd', 'asd\"\"\"', 0, 1, 1, 1, '2018-11-15 17:47:14', '2018-11-16 11:18:38', 1),
(11, 'sadas', '', 'as', 'ChallanPrintPreview_5bed6baecac54.gif', 'asd', 9, 'coupon-code', 11, 'asd', 'network store name', 'www.zeshee.com/network/123&', 'asd', 'asd\"\"\"\"\"\"', 0, 0, 1, 1, '2018-11-15 17:50:54', '2018-11-15 18:04:13', 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `user_name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(256) NOT NULL,
  `user_role_id` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `is_online` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `user_name`, `email`, `password`, `user_role_id`, `created`, `is_active`, `is_online`) VALUES
(1, 'Awais Arif', 'admin@mail.com', '202cb962ac59075b964b07152d234b70', 1, '2018-10-15 06:29:18', 1, 0),
(5, 'Hamza', 'hamza@mail.com', '202cb962ac59075b964b07152d234b70', 1, '2018-10-30 18:48:24', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `user_roles`
--

CREATE TABLE `user_roles` (
  `id` int(11) NOT NULL,
  `role` varchar(100) NOT NULL,
  `created` datetime NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_roles`
--

INSERT INTO `user_roles` (`id`, `role`, `created`, `is_active`) VALUES
(1, 'Admin', '2018-11-14 01:09:30', 1),
(2, 'Coupon Master', '2018-10-30 14:35:49', 1),
(4, 'Sub-manager', '0000-00-00 00:00:00', 1),
(7, 'Manager', '2018-11-01 14:42:28', 1),
(8, 'store master', '2018-11-01 14:42:46', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `coupons`
--
ALTER TABLE `coupons`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `global_settings`
--
ALTER TABLE `global_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `networks`
--
ALTER TABLE `networks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `role_permissions`
--
ALTER TABLE `role_permissions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sections`
--
ALTER TABLE `sections`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stores`
--
ALTER TABLE `stores`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_roles`
--
ALTER TABLE `user_roles`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `coupons`
--
ALTER TABLE `coupons`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=79;

--
-- AUTO_INCREMENT for table `global_settings`
--
ALTER TABLE `global_settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `networks`
--
ALTER TABLE `networks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `role_permissions`
--
ALTER TABLE `role_permissions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `sections`
--
ALTER TABLE `sections`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `stores`
--
ALTER TABLE `stores`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `user_roles`
--
ALTER TABLE `user_roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
