-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 19, 2018 at 03:52 PM
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
(5, 'Apparel Clothing', '', 'Save more on your shopping on Clothing and apparel', 'Apparel & Clothing Deals | Apparel & Clothing Coupons', 'Apparel & Clothing Deals 2018 for everyone shop now to save more', 5, 1, '2018-11-19 15:43:37', '2018-11-06 00:00:00', 1),
(6, 'Women Clothing', '', 'women clothing', 'women clothing deals', 'women clothing promotions', 1, 0, '0000-00-00 00:00:00', '2018-11-19 15:44:05', 1),
(7, 'Men Clothing', '', 'Men Clothing', 'Men Clothing', 'Men Clothing', 1, 0, '0000-00-00 00:00:00', '2018-11-19 15:44:22', 1),
(8, 'Accessories', '', 'Accessories', 'Accessories', 'Accessories', 1, 0, '0000-00-00 00:00:00', '2018-11-19 15:44:56', 1),
(11, 'couponscode', '', 'sadsad', 'couponscode This a testing detail for coupons Code', 'couponscode This a testing detail for coupons Code', 1, 1, '2018-11-19 17:02:13', '2018-11-19 17:01:56', 1),
(12, 'asds', '', 'adssd', 'asds This a testing detail for coupons Code', 'asds This a testing detail for coupons Code', 1, 0, '0000-00-00 00:00:00', '2018-11-19 19:42:22', 1),
(13, 'couponscode', '', 'sdfsd', 'couponscode category meta_title', 'couponscode category Meta Detail', 1, 0, '0000-00-00 00:00:00', '2018-11-19 19:47:52', 1);

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

--
-- Dumping data for table `coupons`
--

INSERT INTO `coupons` (`id`, `name`, `detail`, `discount`, `code`, `type`, `store_id`, `category_id`, `address`, `rank`, `spam`, `active_date`, `expire_date`, `publisher`, `edited_by`, `is_top`, `is_active`, `created`, `updated`) VALUES
(80, '123', 'a', '123', '123', 'coupon', 14, 7, 'sammydress.com/000/1212&12dhjsa0000', 0, 0, '2018-11-19', '0000-00-00', 1, 1, 0, 1, '2018-11-19 00:00:00', '2018-11-19 00:00:00'),
(83, 'save more now', 'save more now', 'save more now', 'save more now', 'coupon', 13, 6, 'testing.com/aasdfv123321qadfs/asdf', 0, 0, '2018-11-23', '2018-11-24', 1, 1, 0, 1, '2018-11-19 00:00:00', '2018-11-19 00:00:00'),
(84, 'OLIVIA & CO Promo Codes', 'asdsdg', '6599', '', 'deal', 14, 0, 'sammydress.com/000/1212&12dhjsa0000', 0, 0, '2018-11-19', '0000-00-00', 1, 0, 0, 1, '2018-11-19 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `global_settings`
--

CREATE TABLE `global_settings` (
  `id` int(11) NOT NULL,
  `page` varchar(50) NOT NULL,
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

INSERT INTO `global_settings` (`id`, `page`, `title`, `detail`, `meta_title`, `meta_detail`, `web_name`, `created`, `is_active`) VALUES
(1, 'home', 'Coupons Codes', 'This a testing detail for coupons Code', 'This a testing detail for coupons Code', 'This a testing detail for coupons Code', 'Couponscode.com.au', '2018-11-01', 1),
(2, 'category', 'Title', 'detail', 'category meta_title', 'category Meta Detail', 'web', '2018-11-13', 1),
(3, 'store', 'Title', 'Detail', 'store Meta Title', 'store Meta Detail', 'web', '2018-11-13', 1);

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
(12, 'Amazo', 'Amazon.com', '123321', 1, 1, 1, '2018-11-19 16:35:55', '2018-11-19 15:48:20'),
(13, 'CF', 'cf.com', '01293', 1, 1, 0, '0000-00-00 00:00:00', '2018-11-19 16:36:18'),
(14, 'SAS', 'sas.com', 's2352', 1, 1, 0, '0000-00-00 00:00:00', '2018-11-19 16:36:34'),
(15, 'None', 'none.com', '0000', 1, 1, 0, '0000-00-00 00:00:00', '2018-11-19 16:54:47');

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
(25, 1, 'ranking', 1, 1, 1, 1, '2018-11-16 15:37:37', 1),
(26, 9, 'coupons', 0, 0, 0, 0, '2018-11-19 18:00:39', 1),
(27, 7, 'categories', 1, 1, 1, 0, '2018-11-19 18:11:04', 1);

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
(21, 'ranking', '2018-11-19 17:59:01', 1);

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
(13, 'mon purse', '', '', 'One Stop Shop with Light in the Box-min_5bf29581db970.jpg', 'mon-purse.com', 8, 'coupon-code', 12, '789', 'Mon Purses', 'monpurse.com/122/12332/', 'Mon Purses', 'Mon Purses', 1, 1, 1, 0, '2018-11-19 15:50:41', '0000-00-00 00:00:00', 1),
(14, 'Sammydress', '', '', 'Book your next trip with Qatar Airways-min_5bf2a6504286a.jpg', 'sammydress.com', 5, 'coupon-code', 15, '0392', 'Sammy Dress', 'sammydress.com/000/1212&12dhjsa0000', 'Sammydress store Meta Title', 'Sammydress store Meta Detail', 0, 1, 1, 1, '2018-11-19 17:02:24', '2018-11-19 19:51:40', 1);

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
(5, 'Hamza', 'hamza@mail.com', '12345', 1, '2018-10-30 18:48:24', 1, 0),
(6, 'testing123', 'test@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', 7, '2018-11-19 18:08:29', 1, 0);

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
(8, 'store master', '2018-11-01 14:42:46', 1),
(9, 'No Role', '2018-11-19 15:25:03', 1);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `coupons`
--
ALTER TABLE `coupons`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=85;

--
-- AUTO_INCREMENT for table `global_settings`
--
ALTER TABLE `global_settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `networks`
--
ALTER TABLE `networks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `role_permissions`
--
ALTER TABLE `role_permissions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `sections`
--
ALTER TABLE `sections`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `stores`
--
ALTER TABLE `stores`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `user_roles`
--
ALTER TABLE `user_roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
