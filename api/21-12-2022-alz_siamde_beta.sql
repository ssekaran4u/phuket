-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               8.0.31-0ubuntu0.22.04.1 - (Ubuntu)
-- Server OS:                    Linux
-- HeidiSQL Version:             12.1.0.6537
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

-- Dumping structure for table beta_phuket.tbl_banner
CREATE TABLE IF NOT EXISTS `tbl_banner` (
  `n_id` int NOT NULL AUTO_INCREMENT,
  `c_banner` longtext,
  `c_short_code` longtext,
  `c_banner_link` longtext,
  `n_banner_type` tinyint(1) DEFAULT '1',
  `n_banner_pos` tinyint(1) DEFAULT '1',
  `n_category` int DEFAULT NULL,
  `dt_start_date` date DEFAULT NULL,
  `dt_end_date` date DEFAULT NULL,
  `c_banner_image` longtext,
  `n_status` tinyint(1) NOT NULL DEFAULT '1',
  `n_delete` tinyint(1) NOT NULL DEFAULT '1',
  `n_created_by` int DEFAULT NULL,
  `dt_created_date` datetime DEFAULT NULL,
  `n_updated_by` int DEFAULT NULL,
  `dt_updated_date` datetime DEFAULT NULL,
  `n_deleted_by` int DEFAULT NULL,
  `dt_deleted_date` datetime DEFAULT NULL,
  PRIMARY KEY (`n_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb3;

-- Dumping data for table beta_phuket.tbl_banner: ~3 rows (approximately)
INSERT INTO `tbl_banner` (`n_id`, `c_banner`, `c_short_code`, `c_banner_link`, `n_banner_type`, `n_banner_pos`, `n_category`, `dt_start_date`, `dt_end_date`, `c_banner_image`, `n_status`, `n_delete`, `n_created_by`, `dt_created_date`, `n_updated_by`, `dt_updated_date`, `n_deleted_by`, `dt_deleted_date`) VALUES
	(1, '1 Health Beauty Outlet', '1-health-beauty-outlet', 'www.siamdealz.com', 1, 1, 49, NULL, NULL, 'igtZinLqARmv3.jpg', 1, 1, 1, '2022-12-15 13:47:53', 1, '2022-12-21 15:41:47', NULL, NULL),
	(2, 'Top Beachside Restaurant', 'top-beachside-restaurant', 'www.siamdealz.com', 1, 2, 8, NULL, NULL, '8dDZQxRp4aDcm.jpg', 1, 1, 1, '2022-12-15 13:54:33', 1, '2022-12-23 15:50:42', NULL, NULL),
	(3, 'Best bike hire shop', 'best-bike-hire-shop', 'www.siamdealz.com', 1, 2, 9, NULL, NULL, 'gMI7rSAIvUfc9.jpg', 1, 1, 1, '2022-12-15 13:55:33', NULL, NULL, NULL, NULL);

-- Dumping structure for table beta_phuket.tbl_category
CREATE TABLE IF NOT EXISTS `tbl_category` (
  `n_id` int NOT NULL AUTO_INCREMENT,
  `n_parent_id` int DEFAULT NULL,
  `c_category` longtext,
  `n_sort` int DEFAULT NULL,
  `c_short_code` longtext,
  `c_meta_title` longtext,
  `c_meta_desc` longtext,
  `c_meta_key` longtext,
  `c_category_image` longtext,
  `c_category_random` longtext,
  `n_status` int DEFAULT '1',
  `n_delete` int NOT NULL DEFAULT '1',
  `n_created_by` int DEFAULT NULL,
  `dt_created_date` datetime DEFAULT NULL,
  `n_updated_by` int DEFAULT NULL,
  `dt_updated_date` datetime DEFAULT NULL,
  `n_deleted_by` int DEFAULT NULL,
  `dt_deleted_date` datetime DEFAULT NULL,
  PRIMARY KEY (`n_id`)
) ENGINE=InnoDB AUTO_INCREMENT=55 DEFAULT CHARSET=utf8mb3;

-- Dumping data for table beta_phuket.tbl_category: ~54 rows (approximately)
INSERT INTO `tbl_category` (`n_id`, `n_parent_id`, `c_category`, `n_sort`, `c_short_code`, `c_meta_title`, `c_meta_desc`, `c_meta_key`, `c_category_image`, `c_category_random`, `n_status`, `n_delete`, `n_created_by`, `dt_created_date`, `n_updated_by`, `dt_updated_date`, `n_deleted_by`, `dt_deleted_date`) VALUES
	(1, 0, 'A.Category', NULL, 'a-category', '', '', '', NULL, '3EL2PcRTACyXWWGB6rURQrORP0QnDFCK', 1, 2, 2, '2022-09-17 16:43:19', NULL, NULL, 2, '2022-09-19 18:45:39'),
	(2, 1, 'A.A', NULL, 'a-a', '', '', '', NULL, 'REipmy31ZechmTpBWkxmYSoj7cIU25Bn', 1, 2, 2, '2022-09-19 11:31:37', NULL, NULL, 2, '2022-09-19 18:45:35'),
	(3, 0, 'B.Category', NULL, 'b-category', '', '', '', NULL, 'XNf2zJ3L9YGfTzN1uOUoIvQOs9Aj6I9g', 1, 2, 2, '2022-09-19 11:37:52', NULL, NULL, 2, '2022-09-19 18:45:30'),
	(4, 3, 'B.B', NULL, 'b-b', '', '', '', NULL, 'ndCo8hKfAYLIuNgsW42i7LcUg5Kinzz0', 1, 2, 2, '2022-09-19 11:38:07', NULL, NULL, 2, '2022-09-19 18:45:26'),
	(5, 4, 'B.C', NULL, 'b-c', '', '', '', NULL, 'A0Cbvn9H3G6hpgzdACIbEapgxx6U5ohE', 1, 2, 2, '2022-09-19 11:38:46', NULL, NULL, 2, '2022-09-19 18:45:20'),
	(6, 0, 'Free to enjoy', 8, 'free-to-enjoy', '', '', '', NULL, 'OazEg5IYdWjPvX4LxA7oDFiMbhAb3PIh', 1, 1, 2, '2022-09-19 18:45:09', 1, '2022-10-26 11:33:19', NULL, NULL),
	(7, 0, 'Family Fun', 6, 'family-fun', '', '', '', NULL, 'IwB94fZBPH8lhxDmssxpgHI0m1HLqwsj', 1, 1, 2, '2022-09-19 18:46:36', NULL, NULL, NULL, NULL),
	(8, 0, 'Food & Drink', 7, 'food-drink', '', '', '', NULL, '5xnkjL7bmQCvFG9i4cgtbtaFBLtCvyAB', 1, 1, 2, '2022-09-19 18:47:49', NULL, NULL, NULL, NULL),
	(9, 0, 'Transport', 5, 'transport', '', '', '', NULL, 'QJY5FGZlpsVsVpHHcxlvkdvaVewvcmFq', 1, 1, 2, '2022-09-19 18:48:18', NULL, NULL, NULL, NULL),
	(10, 0, 'Adults Only', 4, 'adults-only', '', '', '', NULL, 'Ouo3rQlnMDVLcXUZGeFWBzHq4MLrnigo', 1, 1, 2, '2022-09-19 18:49:11', 2, '2022-09-19 18:49:55', NULL, NULL),
	(11, 0, 'Essentials', 3, 'essentials', '', '', '', NULL, 'Tn9VYKTrSP0GXLsi3y73wGMIQVC62o28', 1, 1, 2, '2022-09-19 18:50:25', NULL, NULL, NULL, NULL),
	(12, 0, 'Day Tours', 2, 'day-tours', '', '', '', NULL, 'x9h08OjMfxyXtcKifuBjcNOe4ixcg7aC', 1, 1, 2, '2022-09-19 18:51:04', NULL, NULL, NULL, NULL),
	(13, 10, 'Massage', 8, 'massage', '', '', '', NULL, 'YuLk6BdakTMa4ulKAg7q66l9H8OH3tBW', 1, 1, 2, '2022-09-19 18:52:08', NULL, NULL, NULL, NULL),
	(14, 7, 'Spa', 9, 'spa', '', '', '', NULL, 'I8G7dhn6vwIsoRAamfjoQSZR7s5uhAH1', 1, 1, 2, '2022-09-19 18:52:44', NULL, NULL, NULL, NULL),
	(15, 10, 'Night Club', 10, 'night-club', '', '', '', NULL, 'dnzIXv4WoL41nqqb1PeqTXnox4YGGExp', 1, 1, 2, '2022-09-19 18:53:12', NULL, NULL, NULL, NULL),
	(16, 10, 'Tattoo Parlour', 1, 'tattoo-parlour', '', '', '', NULL, 'CLCA0ja28K6zEO5643D6aJY8YfD9Y8hh', 1, 1, 2, '2022-09-19 18:53:42', NULL, NULL, NULL, NULL),
	(17, 10, 'Cannabis Outlet', 3, 'cannabis-outlet', '', '', '', NULL, 'mSunWYmKHIEnKaFSPjAVfC8exqYzoLux', 1, 1, 2, '2022-09-19 18:54:08', NULL, NULL, NULL, NULL),
	(18, 7, 'Souvenir Shop', 4, 'souvenir-shop', '', '', '', NULL, '9XDNeIOXdWnyqKiG0vBxcp3EKvNO2POr', 1, 1, 2, '2022-09-19 18:54:56', NULL, NULL, NULL, NULL),
	(19, 11, 'Pharmacy', 2, 'pharmacy', '', '', '', NULL, 'M4LDNPphzw550vL0Li4uxgjqfXtKIe3L', 1, 1, 2, '2022-09-19 18:55:28', NULL, NULL, NULL, NULL),
	(20, 11, 'Hospitals', 5, 'hospitals', '', '', '', NULL, 'bSoUbRaqEoE9v00YaDOF24PTHAkosg7A', 1, 1, 2, '2022-09-19 18:56:01', NULL, NULL, NULL, NULL),
	(21, 11, 'SIM Cards', 6, 'sim-cards', '', '', '', NULL, 'Di9N4Q4d4Cq5UUYAaLsWuHuhKO2UTLs3', 1, 1, 2, '2022-09-19 18:56:42', NULL, NULL, NULL, NULL),
	(22, 7, 'Indoor Activities', 7, 'indoor-activities', '', '', '', NULL, 'qaFdsdIb7rUVTES6FK598VdW7QQjMvxn', 1, 1, 2, '2022-09-19 18:57:50', NULL, NULL, NULL, NULL),
	(23, 7, 'Outdoor Activities', 8, 'outdoor-activities', '', '', '', NULL, 'ie4q7HhcH8tNgaWgguKWQwPJmM5g6q6k', 1, 1, 2, '2022-09-19 18:58:28', NULL, NULL, NULL, NULL),
	(24, 22, 'Cinema', 9, 'cinema', '', '', '', NULL, 'u1aw0v7Et8If6HCFvBKLnRqpednn2rql', 1, 1, 2, '2022-09-19 18:58:50', NULL, NULL, NULL, NULL),
	(25, 22, 'Kids Creche & Play Area', 10, 'kids-creche-play-area', '', '', '', NULL, '4iO1ZjY5axsY4169WiSODvkOBPBXhNmU', 1, 1, 2, '2022-09-19 18:59:36', NULL, NULL, NULL, NULL),
	(26, 23, 'Mini Golf', NULL, 'mini-golf', '', '', '', NULL, 'c4glpefvejT2yC370w8cVLMLjY7kWcYd', 1, 1, 2, '2022-09-19 19:00:41', NULL, NULL, NULL, NULL),
	(27, 23, 'Beach Sports', NULL, 'beach-sports', '', '', '', NULL, 'v9t1uJZNtfAqlYV1GGT8j96SfXVxDAqn', 1, 1, 2, '2022-09-19 19:02:02', NULL, NULL, NULL, NULL),
	(28, 23, 'Water Parks', NULL, 'water-parks', '', '', '', NULL, 'jOQv3FHwNsv4EkGm3a9P9lV1ehnw6KJ4', 1, 1, 2, '2022-09-19 19:02:36', NULL, NULL, NULL, NULL),
	(29, 10, 'ATV Riding', NULL, 'atv-riding', '', '', '', NULL, 'vCDbBTzByAxc1cinnUTXtxD7AKPH7t82', 1, 1, 2, '2022-09-19 19:03:05', NULL, NULL, NULL, NULL),
	(30, 10, 'Gun Range', NULL, 'gun-range', '', '', '', NULL, 'bddO1H28jIQ6EHqDzya9EAosynQkTBL1', 1, 1, 2, '2022-09-19 19:03:28', NULL, NULL, NULL, NULL),
	(31, 9, 'Bike Hire', NULL, 'bike-hire', '', '', '', NULL, 'UhaVh4IQfNC90p2IJfxfJcDDWeL2LLD0', 1, 1, 2, '2022-09-19 19:04:42', NULL, NULL, NULL, NULL),
	(32, 9, 'Car Hire 4 persons', NULL, 'car-hire-4-persons', '', '', '', NULL, '6VMFudrmOdCQEsjMtwhxt1j0r56W0p3v', 1, 1, 2, '2022-09-19 19:05:03', 2, '2022-09-19 19:06:53', NULL, NULL),
	(33, 9, 'Van Hire 8+ People', NULL, 'van-hire-8-people', '', '', '', NULL, 'yncRaqmqeheTmZi52JVvjUkSAD6F4kvV', 1, 1, 2, '2022-09-19 19:05:46', NULL, NULL, NULL, NULL),
	(34, 9, 'SUV Hire 6-8 Persons', NULL, 'suv-hire-6-8-persons', '', '', '', NULL, 'zFxksGnCyD3l61Ghe4HjUDlyx9DkyvqK', 1, 1, 2, '2022-09-19 19:06:29', NULL, NULL, NULL, NULL),
	(35, 9, 'Motor Bike Hire High CC', NULL, 'motor-bike-hire-high-cc', '', '', '', NULL, 'Hav6BGqaBt97kqvLLsMk4dvHFtoI7YXd', 1, 1, 2, '2022-09-19 19:07:58', NULL, NULL, NULL, NULL),
	(36, 9, 'Bicycle Hire', NULL, 'bicycle-hire', '', '', '', NULL, 'ja3iXiP3YUNw5HKBLrjzRq46pVhiqUz4', 1, 1, 2, '2022-09-19 19:08:20', NULL, NULL, NULL, NULL),
	(37, 14, 'Nail Art Salon', NULL, 'nail-art-salon', '', '', '', NULL, 'eDG9Lc0tfCt5xyw3xpKcApq0QRL7vPrh', 1, 1, 2, '2022-09-19 19:09:42', NULL, NULL, NULL, NULL),
	(38, 14, 'Hair Extensions', NULL, 'hair-extensions', '', '', '', NULL, 'Qavr2ZQEsjLPdcgiKPgjB1ymjRMfccir', 1, 1, 2, '2022-09-19 19:10:03', NULL, NULL, NULL, NULL),
	(39, 14, 'Hair Styling & Cut', NULL, 'hair-styling-cut', '', '', '', NULL, '05NOoKGWNqDdIDgxWwzAmZwdpSnVAXYN', 1, 1, 2, '2022-09-19 19:10:45', NULL, NULL, NULL, NULL),
	(40, 14, 'Manicure & Pedicure', NULL, 'manicure-pedicure', '', '', '', NULL, 'ZYDlqEo9g2aqzZPew7y9CtOpfGYga6Sa', 1, 1, 2, '2022-09-19 19:11:12', NULL, NULL, NULL, NULL),
	(41, 14, 'Massage - Head, Body & Foot', NULL, 'massage-head-body-foot', '', '', '', NULL, '6H9ZBdq1xo0LQ88yXsXJU4jUG0GEuzmB', 1, 1, 2, '2022-09-19 19:12:10', NULL, NULL, NULL, NULL),
	(42, 12, 'Bus Tour 1/2 day', NULL, 'bus-tour-1-2-day', '', '', '', NULL, 'sU054TUBZYkDWqTpjlQ8YghcfvgPmGM9', 1, 1, 2, '2022-09-19 19:13:32', NULL, NULL, NULL, NULL),
	(43, 12, 'Bus Tour Full Day', NULL, 'bus-tour-full-day', '', '', '', NULL, 'eJ1UcE14BI3rRDgvSZEsue0q0cBp4dHp', 1, 1, 2, '2022-09-19 19:15:13', NULL, NULL, NULL, NULL),
	(44, 12, 'Island Tour with swimming', NULL, 'island-tour-with-swimming', '', '', '', NULL, 'RZu1DfmM4oIZDcyf8O5jVjj2ZrnA8zOS', 1, 1, 2, '2022-09-19 19:17:03', NULL, NULL, NULL, NULL),
	(45, 12, 'Island Tours without swimming', NULL, 'island-tours-without-swimming', '', '', '', NULL, '8aNp0lqmHtvVOtTey3xhzjO0XTiywajv', 1, 1, 2, '2022-09-19 19:17:34', NULL, NULL, NULL, NULL),
	(46, 12, 'Temple Tours', NULL, 'temple-tours', '', '', '', NULL, 'kOAnD5kh06yzHllgKHT1Nemj6D6ev7Ox', 1, 1, 2, '2022-09-19 19:18:15', NULL, NULL, NULL, NULL),
	(47, 11, 'Money Exchange', NULL, 'money-exchange', '', '', '', NULL, 'gQmhVPlrMFBcujZSAXXGCVOvGbNGY3mV', 1, 1, 2, '2022-09-19 19:19:04', NULL, NULL, NULL, NULL),
	(48, 13, 'Massage - Full Service', NULL, 'massage-full-service', '', '', '', NULL, 'B971EQyyEt6dw6V0CZ5fsQLWndOgQLtp', 1, 1, 2, '2022-09-19 19:21:10', NULL, NULL, NULL, NULL),
	(49, 0, 'Beauty & Spa', 1, 'beauty-spa', 'Health & Wellness', 'Health & Wellness', 'Health & Wellness', NULL, 'PNwLRgCwjD1on9o1XWBRBIxpriJumkIk', 1, 1, 1, '2022-10-26 11:51:14', NULL, NULL, NULL, NULL),
	(50, 8, 'Restaurant', NULL, 'restaurant', '', '', '', NULL, 'HXiFM8t62C2qrdfX5Pl9SyF1hCd0j7eK', 1, 1, 1, '2022-10-26 11:51:50', NULL, NULL, NULL, NULL),
	(51, 8, 'Bar', NULL, 'bar', '', '', '', NULL, 'bZC8cOzceOiXou2TOBsx29VLYsZEkHGt', 1, 1, 1, '2022-10-26 11:52:15', NULL, NULL, NULL, NULL),
	(52, 51, 'Beach Sports', NULL, 'beach-sports', '', '', '', NULL, 'UNp0EErxd0uwHldSYWsf6wdvL0GLe4NP', 1, 1, 1, '2022-10-26 11:53:18', NULL, NULL, NULL, NULL),
	(53, 51, 'GoGo Bar', NULL, 'gogo-bar', '', '', '', NULL, 'oCk84vSMJNS45EvX9sAHx7kvxqab9tlk', 1, 1, 1, '2022-10-26 11:54:05', NULL, NULL, NULL, NULL),
	(54, 0, 'TEST', NULL, 'test', '', '', '', 'ZXKv2oL5vY6QR.jpeg', '0kJDLUlRIf8c5J4tdwA49nw3slrrsCU9', 1, 1, 1, '2022-12-21 15:25:38', 1, '2022-12-21 15:26:57', NULL, NULL);

-- Dumping structure for table beta_phuket.tbl_city
CREATE TABLE IF NOT EXISTS `tbl_city` (
  `n_id` int NOT NULL AUTO_INCREMENT,
  `n_country_id` int NOT NULL DEFAULT '1',
  `c_city` longtext,
  `n_sort` int DEFAULT NULL,
  `n_status` int NOT NULL DEFAULT '1',
  `n_delete` int NOT NULL DEFAULT '1',
  `n_created_by` int DEFAULT NULL,
  `dt_created_at` datetime DEFAULT NULL,
  `n_updated_by` int DEFAULT NULL,
  `dt_updated_at` datetime DEFAULT NULL,
  `n_deleted_by` int DEFAULT NULL,
  `dt_deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`n_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb3;

-- Dumping data for table beta_phuket.tbl_city: ~6 rows (approximately)
INSERT INTO `tbl_city` (`n_id`, `n_country_id`, `c_city`, `n_sort`, `n_status`, `n_delete`, `n_created_by`, `dt_created_at`, `n_updated_by`, `dt_updated_at`, `n_deleted_by`, `dt_deleted_at`) VALUES
	(1, 1, 'A.Name', 1, 2, 1, 2, '2022-09-17 16:41:48', 2, '2022-09-19 18:19:22', NULL, NULL),
	(2, 1, 'Phuket', 2, 1, 1, 2, '2022-09-19 17:47:56', NULL, NULL, NULL, NULL),
	(3, 1, 'Bangkok - Coming Soon', 4, 1, 1, 2, '2022-09-19 17:48:37', NULL, NULL, NULL, NULL),
	(4, 1, 'Chiang Mai - Coming Soon', 5, 1, 1, 2, '2022-09-19 17:48:56', NULL, NULL, NULL, NULL),
	(5, 1, 'Krabi - Coming Soon', 3, 1, 1, 2, '2022-09-19 17:49:19', NULL, NULL, NULL, NULL),
	(6, 1, 'Pattaya - Coming Soon', 6, 1, 1, 2, '2022-09-19 17:49:45', NULL, NULL, NULL, NULL);

-- Dumping structure for table beta_phuket.tbl_coupons
CREATE TABLE IF NOT EXISTS `tbl_coupons` (
  `n_id` int NOT NULL AUTO_INCREMENT,
  `n_type` tinyint(1) DEFAULT '1',
  `n_spend_amount` int DEFAULT NULL,
  `c_coupon` varchar(56) DEFAULT NULL,
  `n_discount_percentage` int DEFAULT NULL,
  `n_coupon_price` int DEFAULT NULL,
  `n_vailidity` int DEFAULT NULL,
  `n_payable` int DEFAULT NULL,
  `c_description` mediumtext,
  `c_image` varchar(64) DEFAULT NULL,
  `n_status` tinyint(1) NOT NULL DEFAULT '1',
  `n_delete` tinyint(1) NOT NULL DEFAULT '1',
  `n_created_by` int DEFAULT NULL,
  `dt_created_at` datetime DEFAULT NULL,
  `n_updated_by` int DEFAULT NULL,
  `dt_updated_at` datetime DEFAULT NULL,
  `n_deleted_by` int DEFAULT NULL,
  `dt_deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`n_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf32;

-- Dumping data for table beta_phuket.tbl_coupons: ~0 rows (approximately)
INSERT INTO `tbl_coupons` (`n_id`, `n_type`, `n_spend_amount`, `c_coupon`, `n_discount_percentage`, `n_coupon_price`, `n_vailidity`, `n_payable`, `c_description`, `c_image`, `n_status`, `n_delete`, `n_created_by`, `dt_created_at`, `n_updated_by`, `dt_updated_at`, `n_deleted_by`, `dt_deleted_at`) VALUES
	(1, 2, 0, '10% Off - Intro', 10, 200, 30, 180, '10% discount on total bill.', '3wxPp4tvkzohp.png', 1, 1, 1, '2022-10-19 09:44:26', 1, '2022-10-26 11:29:14', NULL, NULL);

-- Dumping structure for table beta_phuket.tbl_coupons_downloaded
CREATE TABLE IF NOT EXISTS `tbl_coupons_downloaded` (
  `n_id` int NOT NULL AUTO_INCREMENT,
  `n_user` int DEFAULT NULL,
  `n_vendor` int DEFAULT NULL,
  `n_coupon` int DEFAULT NULL,
  `n_coupon_det` int DEFAULT NULL,
  `dt_created_at` datetime DEFAULT NULL,
  `n_status` tinyint(1) DEFAULT '1',
  `n_delete` tinyint(1) DEFAULT '1',
  PRIMARY KEY (`n_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- Dumping data for table beta_phuket.tbl_coupons_downloaded: ~0 rows (approximately)
INSERT INTO `tbl_coupons_downloaded` (`n_id`, `n_user`, `n_vendor`, `n_coupon`, `n_coupon_det`, `dt_created_at`, `n_status`, `n_delete`) VALUES
	(1, 1, 12, 1, 1, '2022-12-22 13:48:29', 1, 1);

-- Dumping structure for table beta_phuket.tbl_customers
CREATE TABLE IF NOT EXISTS `tbl_customers` (
  `n_id` int NOT NULL AUTO_INCREMENT,
  `c_full_name` varchar(128) NOT NULL,
  `c_short_name` varchar(128) DEFAULT NULL,
  `c_emailid` varchar(128) NOT NULL,
  `c_password` text NOT NULL,
  `c_contact_number` varchar(20) NOT NULL,
  `n_verify` tinyint(1) NOT NULL DEFAULT '1',
  `c_whatsapp` varchar(16) DEFAULT NULL,
  `c_line` varchar(16) DEFAULT NULL,
  `c_profile` varchar(56) DEFAULT NULL,
  `dt_created_at` datetime NOT NULL,
  `n_updated_by` int DEFAULT NULL,
  `dt_updated_at` datetime DEFAULT NULL,
  `n_deleted_by` int DEFAULT NULL,
  `dt_deleted_at` datetime DEFAULT NULL,
  `c_address` text,
  `n_status` int NOT NULL DEFAULT '1',
  `n_delete` tinyint(1) NOT NULL DEFAULT '1',
  `n_created_by` int NOT NULL,
  PRIMARY KEY (`n_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb3;

-- Dumping data for table beta_phuket.tbl_customers: ~0 rows (approximately)
INSERT INTO `tbl_customers` (`n_id`, `c_full_name`, `c_short_name`, `c_emailid`, `c_password`, `c_contact_number`, `n_verify`, `c_whatsapp`, `c_line`, `c_profile`, `dt_created_at`, `n_updated_by`, `dt_updated_at`, `n_deleted_by`, `dt_deleted_at`, `c_address`, `n_status`, `n_delete`, `n_created_by`) VALUES
	(1, 'Dhana Sekaran', 'DS', 'ssekaran4u@gmail.com', '', '', 1, NULL, '986534022', NULL, '2022-12-22 13:45:26', NULL, NULL, NULL, NULL, 'Datasense Technologies', 1, 1, 0);

-- Dumping structure for table beta_phuket.tbl_demographic
CREATE TABLE IF NOT EXISTS `tbl_demographic` (
  `n_id` int NOT NULL AUTO_INCREMENT,
  `c_demographic` longtext,
  `c_short_code` text,
  `n_sort` int DEFAULT NULL,
  `n_status` int NOT NULL DEFAULT '1',
  `n_delete` int NOT NULL DEFAULT '1',
  `n_created_by` int DEFAULT NULL,
  `dt_created_date` datetime DEFAULT NULL,
  `n_updated_by` int DEFAULT NULL,
  `dt_updated_date` datetime DEFAULT NULL,
  `n_deleted_by` int DEFAULT NULL,
  `dt_deleted_date` datetime DEFAULT NULL,
  PRIMARY KEY (`n_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb3;

-- Dumping data for table beta_phuket.tbl_demographic: ~4 rows (approximately)
INSERT INTO `tbl_demographic` (`n_id`, `c_demographic`, `c_short_code`, `n_sort`, `n_status`, `n_delete`, `n_created_by`, `dt_created_date`, `n_updated_by`, `dt_updated_date`, `n_deleted_by`, `dt_deleted_date`) VALUES
	(1, 'Top 10 dealz', 'top10dealz', 1, 1, 1, 1, '2022-12-16 16:16:53', NULL, NULL, NULL, NULL),
	(2, 'Deals of the day', 'dealsoftheday', 2, 1, 1, 1, '2022-12-16 16:17:24', NULL, NULL, NULL, NULL),
	(3, 'Test', 'test', NULL, 2, 2, 1, '2022-12-21 16:16:27', 1, '2022-12-21 16:17:43', 1, '2022-12-21 16:55:59'),
	(4, 'Demo', 'demo', NULL, 2, 2, 1, '2022-12-21 16:52:03', NULL, NULL, 1, '2022-12-21 16:56:43');

-- Dumping structure for table beta_phuket.tbl_district
CREATE TABLE IF NOT EXISTS `tbl_district` (
  `n_id` int NOT NULL AUTO_INCREMENT,
  `n_city` int DEFAULT NULL,
  `c_district` longtext,
  `n_sort` int DEFAULT NULL,
  `n_status` int NOT NULL DEFAULT '1',
  `n_delete` int NOT NULL DEFAULT '1',
  `n_created_by` int DEFAULT NULL,
  `dt_created_at` datetime DEFAULT NULL,
  `n_updated_by` int DEFAULT NULL,
  `dt_updated_at` datetime DEFAULT NULL,
  `n_deleted_by` int DEFAULT NULL,
  `dt_deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`n_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb3;

-- Dumping data for table beta_phuket.tbl_district: ~4 rows (approximately)
INSERT INTO `tbl_district` (`n_id`, `n_city`, `c_district`, `n_sort`, `n_status`, `n_delete`, `n_created_by`, `dt_created_at`, `n_updated_by`, `dt_updated_at`, `n_deleted_by`, `dt_deleted_at`) VALUES
	(1, 1, 'A.District', 1, 2, 2, 2, '2022-09-17 16:42:05', 2, '2022-09-19 18:01:19', 1, '2022-10-26 11:30:57'),
	(2, 2, 'Thalang', 3, 1, 1, 2, '2022-09-19 17:50:48', NULL, NULL, NULL, NULL),
	(3, 2, 'Kathu', 4, 1, 1, 2, '2022-09-19 17:53:33', NULL, NULL, NULL, NULL),
	(4, 2, 'Mueang', 2, 1, 1, 2, '2022-09-19 17:54:37', NULL, NULL, NULL, NULL);

-- Dumping structure for table beta_phuket.tbl_image_category
CREATE TABLE IF NOT EXISTS `tbl_image_category` (
  `n_id` int NOT NULL AUTO_INCREMENT,
  `c_image_category` longtext,
  `n_status` int NOT NULL DEFAULT '1',
  `n_delete` int NOT NULL DEFAULT '1',
  `n_created_by` int DEFAULT NULL,
  `dt_created_date` datetime DEFAULT NULL,
  `n_updated_by` int DEFAULT NULL,
  `dt_updated_date` datetime DEFAULT NULL,
  `n_deleted_by` int DEFAULT NULL,
  `dt_deleted_date` datetime DEFAULT NULL,
  PRIMARY KEY (`n_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- Dumping data for table beta_phuket.tbl_image_category: ~0 rows (approximately)

-- Dumping structure for table beta_phuket.tbl_listings
CREATE TABLE IF NOT EXISTS `tbl_listings` (
  `n_id` int NOT NULL AUTO_INCREMENT,
  `n_type` tinyint(1) DEFAULT '1',
  `n_suggest` tinyint(1) DEFAULT '1',
  `n_city` int DEFAULT NULL,
  `n_district` int DEFAULT NULL,
  `n_town` int DEFAULT NULL,
  `n_category` varchar(3) NOT NULL,
  `n_latitude` float DEFAULT NULL,
  `n_longitude` float DEFAULT NULL,
  `c_name` varchar(256) DEFAULT NULL,
  `c_name_in_thai` varchar(256) NOT NULL,
  `c_mobile_numbers` text,
  `c_emailids` text,
  `c_c_contact_number` text,
  `c_n_is_other` tinyint(1) DEFAULT '1',
  `c_c_whatsapp` text,
  `c_c_line` text,
  `c_c_emailid` varchar(256) DEFAULT NULL,
  `j_opening_hours` text,
  `dt_deleted_on` datetime DEFAULT NULL,
  `n_deleted_by` int DEFAULT NULL,
  `n_status` int NOT NULL DEFAULT '1',
  `n_delete` tinyint(1) NOT NULL DEFAULT '1',
  `c_address` text,
  `c_terms` text,
  `c_demographic` text,
  `n_verified` tinyint(1) DEFAULT '1',
  `n_verified_by` int DEFAULT NULL,
  `dt_created_on` datetime NOT NULL,
  `dt_verified_on` datetime DEFAULT NULL,
  `fl_latitude` float DEFAULT NULL,
  `fl_longitude` float DEFAULT NULL,
  `c_c_full_name` varchar(256) DEFAULT NULL,
  `c_c_short_name` varchar(76) DEFAULT NULL,
  `dt_last_login` datetime DEFAULT NULL,
  `n_dormant` tinyint(1) NOT NULL DEFAULT '1',
  `dt_dormant_on` datetime DEFAULT NULL,
  `n_dormant_by` int DEFAULT NULL,
  `dt_updated_on` datetime DEFAULT NULL,
  `n_updated_by` int DEFAULT NULL,
  `n_created_by` int NOT NULL,
  `n_supervisor` int DEFAULT NULL,
  `n_agent` int DEFAULT NULL,
  `n_assigned_by` int DEFAULT NULL,
  PRIMARY KEY (`n_id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb3;

-- Dumping data for table beta_phuket.tbl_listings: ~12 rows (approximately)
INSERT INTO `tbl_listings` (`n_id`, `n_type`, `n_suggest`, `n_city`, `n_district`, `n_town`, `n_category`, `n_latitude`, `n_longitude`, `c_name`, `c_name_in_thai`, `c_mobile_numbers`, `c_emailids`, `c_c_contact_number`, `c_n_is_other`, `c_c_whatsapp`, `c_c_line`, `c_c_emailid`, `j_opening_hours`, `dt_deleted_on`, `n_deleted_by`, `n_status`, `n_delete`, `c_address`, `c_terms`, `c_demographic`, `n_verified`, `n_verified_by`, `dt_created_on`, `dt_verified_on`, `fl_latitude`, `fl_longitude`, `c_c_full_name`, `c_c_short_name`, `dt_last_login`, `n_dormant`, `dt_dormant_on`, `n_dormant_by`, `dt_updated_on`, `n_updated_by`, `n_created_by`, `n_supervisor`, `n_agent`, `n_assigned_by`) VALUES
	(1, 2, 1, 2, 2, 7, '6', 7.97547, 98.2785, 'Surin Beach', '', '', '', '', 1, NULL, NULL, '', '{"n_sunday":1,"n_monday":1,"n_tuesday":1,"n_wednesday":1,"n_thursday":1,"n_friday":1,"n_saturday":1}', NULL, NULL, 1, 1, 'Surin Beach, Choeng Thale, Thalang District, Phuket 83110, Thailand', 'The Beach is a Public Free Access Area\r\nFree Car parking is available\r\nPlenty of food & drink available on the beach\r\nMassage is also available \r\nRestaurants & Massage Shops within 100Mts.', NULL, 1, NULL, '2022-10-19 09:07:28', NULL, NULL, NULL, '', '', NULL, 1, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL),
	(2, 2, 1, 2, 2, 2, '6', 8.00255, 98.2926, 'Bang Tao Beach', 'Bangtao Beach', '', '', '', 1, NULL, NULL, '', '[]', NULL, NULL, 1, 1, 'Bang Tao Beach, Phuket 83110, Thailand', '', NULL, 1, NULL, '2022-10-26 12:04:20', NULL, NULL, NULL, '', '', NULL, 1, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL),
	(3, 2, 1, 2, 3, 8, '7', 7.95652, 98.2874, 'Phuket FantaSea', '', '808006560', 'contact@siamdealz.com', '', 1, NULL, NULL, '', '{"n_sunday_start":"25","n_sunday_end":"45","n_monday_start":"25","n_monday_end":"21","n_tuesday_start":"","n_tuesday_end":"","n_wednesday_start":"","n_wednesday_end":"","n_thursday_start":"","n_thursday_end":"","n_friday_start":"","n_friday_end":"","n_saturday_start":"","n_saturday_end":""}', NULL, NULL, 1, 1, '99, Tambon Kamala, Amphoe Kathu, Chang Wat Phuket 83150, Thailand', '', NULL, 1, NULL, '2022-12-05 22:03:29', NULL, NULL, NULL, '', '', NULL, 1, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL),
	(4, 2, 1, 2, 2, 10, '50', 7.89281, 98.2981, 'Madras Cafe - Indian Restaurant', '', '808006560', 'contact@siamdealz.com', '', 1, NULL, NULL, '', '{"n_sunday_start":"","n_sunday_end":"","n_monday_start":"","n_monday_end":"","n_tuesday_start":"","n_tuesday_end":"","n_wednesday_start":"","n_wednesday_end":"","n_thursday_start":"","n_thursday_end":"","n_friday_start":"","n_friday_end":"","n_saturday_start":"","n_saturday_end":""}', NULL, NULL, 1, 1, '198, 4 Soi Rat Uthit 200 Pi 1, Tambon Patong, Amphoe Kathu, Chang Wat Phuket 83150, Thailand', '', NULL, 1, NULL, '2022-12-05 22:05:21', NULL, NULL, NULL, '', '', NULL, 1, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL),
	(5, 2, 1, 2, 2, 0, '50', 7.89281, 98.2981, 'Madras Cafe - Indian Restaurant', '', '808006560', 'contact@siamdealz.com', '', 1, NULL, NULL, '', '[]', NULL, NULL, 2, 1, '198, 4 Soi Rat Uthit 200 Pi 1, Tambon Patong, Amphoe Kathu, Chang Wat Phuket 83150, Thailand', '', NULL, 1, NULL, '2022-12-05 22:05:48', NULL, NULL, NULL, '', '', NULL, 1, NULL, NULL, '2022-12-09 11:12:44', 1, 1, NULL, NULL, NULL),
	(6, 2, 1, 2, 2, 0, '50', 7.89281, 98.2981, 'Madras Cafe - Indian Restaurant', '', '808006560', 'contact@siamdealz.com', '', 1, NULL, NULL, '', '[]', '2022-12-21 16:00:26', 1, 1, 2, '198, 4 Soi Rat Uthit 200 Pi 1, Tambon Patong, Amphoe Kathu, Chang Wat Phuket 83150, Thailand', '', NULL, 1, NULL, '2022-12-05 22:06:09', NULL, NULL, NULL, '', '', NULL, 1, NULL, NULL, '2022-12-21 15:52:30', 1, 1, NULL, NULL, NULL),
	(7, 2, 1, 2, 2, 10, '6', 7.8922, 98.2993, 'Jungceylon Shopping Center', 'จังซีลอน', '808006560', 'contact@siamdealz.com', '', 1, NULL, NULL, '', '[]', NULL, NULL, 1, 1, 'ถนน ราษฎร์อุทิศ Tambon Patong, Amphoe Kathu, Chang Wat Phuket 83150, Thailand', '', NULL, 1, NULL, '2022-12-09 10:49:42', NULL, NULL, NULL, '', '', NULL, 1, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL),
	(8, 2, 1, 2, 4, 14, '6', 7.76183, 98.3054, 'Cape Phrom Thep', 'แหลมพรหมเทพ', '808006560', 'contact@siamdealz.com', '', 1, NULL, NULL, '', '[]', NULL, NULL, 1, 1, 'แหลมพรหมเทพ, Tambon Rawai, Amphoe Mueang Phuket, Chang Wat Phuket 83100, Thailand', '', NULL, 1, NULL, '2022-12-09 10:54:52', NULL, NULL, NULL, '', '', NULL, 1, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL),
	(9, 2, 1, 2, 3, 8, '51', 7.8939, 98.2962, 'Aussie Bar', '', '808006560', 'contact@siamdealz.com', '', 1, NULL, NULL, '', '[]', NULL, NULL, 1, 1, '9 Bangla Rd, Tambon Patong, Amphoe Kathu, Chang Wat Phuket 83150, Thailand', '', NULL, 1, NULL, '2022-12-09 10:57:19', NULL, NULL, NULL, '', '', NULL, 1, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL),
	(10, 2, 1, 2, 2, 10, '15', 7.89338, 98.2977, 'Illuzion Phuket', '', '808006560', 'contact@siamdealz.com', '', 1, NULL, NULL, '', '[]', NULL, NULL, 1, 1, '31 Bangla Rd, Tambon Patong, Amphoe Kathu, Chang Wat Phuket 83150, Thailand', '', NULL, 1, NULL, '2022-12-09 11:02:02', NULL, NULL, NULL, '', '', NULL, 1, NULL, NULL, '2022-12-09 11:03:03', 1, 1, NULL, NULL, NULL),
	(11, 2, 1, 2, 2, 2, '', 7.81522, 98.3042, 'Highway Curry - Authentic Indian | Thai | Vegan | Kata, Phuket', '', '808006560', 'contact@siamdealz.com', '', 1, NULL, NULL, '', '[]', NULL, NULL, 1, 1, '137, Koktanode Road Opposite, BLU PINE Villa & Pool Access, ตำบล กะรน Phuket, ภูเก็ต 83100, Thailand', '', NULL, 1, NULL, '2022-12-09 11:11:19', NULL, NULL, NULL, '', '', NULL, 1, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL),
	(12, 1, 1, 2, 3, 8, '10', 11.0249, 77.0091, 'Madras Cafe - Indian Restaurant', 'Madras Cafe - ร้านอาหารอินเดีย', '909090909', 'madrescafe@gmail.com', '909090909', 1, NULL, NULL, 'name@gmail.com', '{"n_sunday":1,"n_monday":1,"n_tuesday":1}', NULL, NULL, 1, 1, 'Madras Cafe - Indian Restaurant', '9090909090', '2,1', 1, NULL, '2022-12-21 15:45:42', NULL, NULL, NULL, 'Madres', 'MA', NULL, 1, NULL, NULL, NULL, NULL, 1, 1, 1, NULL);

-- Dumping structure for table beta_phuket.tbl_listings_image
CREATE TABLE IF NOT EXISTS `tbl_listings_image` (
  `n_id` int NOT NULL AUTO_INCREMENT,
  `n_listing_id` int DEFAULT NULL,
  `c_listing_img` longtext,
  `n_status` int NOT NULL DEFAULT '1',
  `n_delete` int NOT NULL DEFAULT '1',
  `n_created_by` int DEFAULT NULL,
  `dt_created_date` datetime DEFAULT NULL,
  `n_updated_by` int DEFAULT NULL,
  `dt_updated_date` datetime DEFAULT NULL,
  `n_deleted_by` int DEFAULT NULL,
  `dt_deleted_date` datetime DEFAULT NULL,
  PRIMARY KEY (`n_id`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8mb3;

-- Dumping data for table beta_phuket.tbl_listings_image: ~27 rows (approximately)
INSERT INTO `tbl_listings_image` (`n_id`, `n_listing_id`, `c_listing_img`, `n_status`, `n_delete`, `n_created_by`, `dt_created_date`, `n_updated_by`, `dt_updated_date`, `n_deleted_by`, `dt_deleted_date`) VALUES
	(1, 1, 'H0Wz1jzGW7a1s.jpg', 1, 1, 1, '2022-10-19 09:07:28', NULL, NULL, NULL, NULL),
	(2, 1, 'mh62lJgFl4Jw3.jpg', 1, 1, 1, '2022-10-19 09:07:28', NULL, NULL, NULL, NULL),
	(3, 1, 'wxPU8UeD0YdhK.jpg', 1, 1, 1, '2022-10-19 09:07:29', NULL, NULL, NULL, NULL),
	(4, 1, 'H7Wkwn3VR6j1E.jpg', 1, 1, 1, '2022-10-19 09:07:29', NULL, NULL, NULL, NULL),
	(5, 1, '3uZqgR5g3pUvM.jpg', 1, 1, 1, '2022-10-19 09:07:29', NULL, NULL, NULL, NULL),
	(6, 1, 'FZv1X0B9d3xTX.jpg', 1, 1, 1, '2022-10-19 09:07:29', NULL, NULL, NULL, NULL),
	(7, 1, 'zqEsfcl4dV6Mz.jpg', 1, 1, 1, '2022-10-19 09:07:29', NULL, NULL, NULL, NULL),
	(8, 1, 'MMiBHJP8FJPDc.jpg', 1, 1, 1, '2022-10-19 09:07:30', NULL, NULL, NULL, NULL),
	(9, 1, '1BEYmaevzv0iy.jpg', 1, 1, 1, '2022-10-19 09:07:30', NULL, NULL, NULL, NULL),
	(10, 1, '7ksAhZYeeoyOm.jpg', 1, 1, 1, '2022-10-19 09:07:30', NULL, NULL, NULL, NULL),
	(11, 2, '9BFUy4JaENb3D.jpg', 1, 1, 1, '2022-10-26 12:04:20', NULL, NULL, NULL, NULL),
	(12, 3, 'rcroOuqtCbmxI.jpg', 1, 1, 1, '2022-12-05 22:03:30', NULL, NULL, NULL, NULL),
	(13, 7, 'uMvo9C2sBrcFE.jpg', 1, 1, 1, '2022-12-09 10:49:42', NULL, NULL, NULL, NULL),
	(14, 8, 'lYFVDqEO1wq48.jpg', 1, 1, 1, '2022-12-09 10:54:52', NULL, NULL, NULL, NULL),
	(15, 8, 'TXsvCndYdUbHG.jpg', 1, 1, 1, '2022-12-09 10:54:52', NULL, NULL, NULL, NULL),
	(16, 9, '5M3Ovc0hdsA70.jpg', 1, 1, 1, '2022-12-09 10:57:19', NULL, NULL, NULL, NULL),
	(17, 9, 'gxS9oXhBsPA7s.jpg', 1, 1, 1, '2022-12-09 10:57:19', NULL, NULL, NULL, NULL),
	(18, 10, 'zrW6llZiI2rEh.jpg', 1, 1, NULL, NULL, 1, '2022-12-09 11:02:37', NULL, NULL),
	(19, 10, 'VHOdMOtgAvaLZ.jpg', 1, 1, NULL, NULL, 1, '2022-12-09 11:02:37', NULL, NULL),
	(20, 10, 'SeyPIGnptBjEn.jpg', 1, 1, NULL, NULL, 1, '2022-12-09 11:02:48', NULL, NULL),
	(21, 10, 'fhv48P5TKfkUr.jpg', 1, 1, NULL, NULL, 1, '2022-12-09 11:02:48', NULL, NULL),
	(22, 10, '7ejq0bd9NsHQJ.jpg', 1, 1, NULL, NULL, 1, '2022-12-09 11:03:03', NULL, NULL),
	(23, 11, 'g1coMG9T5Hcev.jpg', 1, 1, 1, '2022-12-09 11:11:19', NULL, NULL, NULL, NULL),
	(24, 11, 'wCDY00reOvPtU.jpg', 1, 1, 1, '2022-12-09 11:11:19', NULL, NULL, NULL, NULL),
	(25, 11, 'wyeRz5On5ehbs.jpg', 1, 1, 1, '2022-12-09 11:11:19', NULL, NULL, NULL, NULL),
	(26, 12, 'n2Gt0lGKjnMEj.jpeg', 1, 1, 1, '2022-12-21 15:45:42', NULL, NULL, NULL, NULL),
	(27, 6, 'b26oHGZQRALd7.jpeg', 1, 1, NULL, NULL, 1, '2022-12-21 15:52:07', NULL, NULL);

-- Dumping structure for table beta_phuket.tbl_pages
CREATE TABLE IF NOT EXISTS `tbl_pages` (
  `n_id` int NOT NULL AUTO_INCREMENT,
  `c_pages` longtext,
  `c_short_code` longtext,
  `n_page_type` int DEFAULT NULL,
  `c_description` longtext,
  `c_page_random` longtext,
  `n_sort` int DEFAULT NULL,
  `n_status` int NOT NULL DEFAULT '1',
  `n_delete` int NOT NULL DEFAULT '1',
  `n_created_by` int DEFAULT NULL,
  `dt_created_date` datetime DEFAULT NULL,
  `n_updated_by` int DEFAULT NULL,
  `dt_updated_date` datetime DEFAULT NULL,
  `n_deleted_by` int DEFAULT NULL,
  `dt_deleted_date` datetime DEFAULT NULL,
  PRIMARY KEY (`n_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb3;

-- Dumping data for table beta_phuket.tbl_pages: ~4 rows (approximately)
INSERT INTO `tbl_pages` (`n_id`, `c_pages`, `c_short_code`, `n_page_type`, `c_description`, `c_page_random`, `n_sort`, `n_status`, `n_delete`, `n_created_by`, `dt_created_date`, `n_updated_by`, `dt_updated_date`, `n_deleted_by`, `dt_deleted_date`) VALUES
	(1, 'What is siam dealz ?', 'what-is-this', 1, '<p>All about recovery and helping local businesses get back on their feet.&nbsp;</p><p>We provide a platform on which local vendors can optimise their earnings over slack and slow periods.&nbsp;</p><p>The platform is not only for Tourists but also local residents who deserve an outing during this difficult period where money is tight.</p><p>Community Support at its very best.</p><p><br></p><p><br></p>', 'Xk4gNnFQy4D8H5GQ1TPVx6LY5N8bF98y', 1, 1, 1, 1, '2022-12-26 10:48:09', 1, '2022-12-27 14:12:35', NULL, NULL),
	(2, 'About us', 'about-us', 1, '<p>We are a mixed bunch of people who all have an undying love for the beautiful Country and gentle people of Thailand. We look forward to playing a major role in helping the recovery from the pandemic.&nbsp;</p><p>Getting local businesses back on their feet is our number one priority. A close second is providing the average Family a means to get a much deserved outing and a few moments of joy during this difficult period.<br></p>', 'SyGNeMq1K7SukZcGRfeQmnEUkXJzFaDC', 2, 1, 1, 1, '2022-12-26 10:52:21', NULL, NULL, NULL, NULL),
	(3, 'Help us to help you', 'help-us-to-help-you', 1, '<p>Help us to Help You.&nbsp;</p><p><strong>For local businesses:-&nbsp;</strong></p><p>Come join up at our low inauguration rate and see your business grow in leaps.</p><p>You decide&nbsp;when you want more business, what you want to advertise and how much you want to budget or spend.</p><p>Click here to know more or sign up.</p><p><strong>For Individuals to supplement their income:-<br></strong></p><p>If you know local businesses which will benefit from this platform, let us know. We will provide you with some income for helping them to sign up. You can continue earning for an ongoing period with the businesses you sign up.</p>', 'ALxenpnKSlOLw6U8YCOS9j09zm8lSfbK', NULL, 1, 1, 1, '2022-12-26 11:01:56', 1, '2022-12-27 14:10:31', NULL, NULL),
	(4, 'Contact us', 'contact-us', 2, 'https://www.google.com/', 'JwIp4Y3EExpdb2d0uzUR0Rm2nIDazgkc', NULL, 1, 1, 1, '2022-12-27 16:10:01', NULL, NULL, NULL, NULL);

-- Dumping structure for table beta_phuket.tbl_send_otp
CREATE TABLE IF NOT EXISTS `tbl_send_otp` (
  `n_id` int NOT NULL AUTO_INCREMENT,
  `n_mobile` int DEFAULT NULL,
  `c_emailid` longtext,
  `n_otp` longtext,
  `n_verify` int DEFAULT '1',
  `dt_date` date DEFAULT NULL,
  `dt_time` time DEFAULT NULL,
  `dt_created_at` datetime DEFAULT NULL,
  `dt_updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`n_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb3;

-- Dumping data for table beta_phuket.tbl_send_otp: ~0 rows (approximately)
INSERT INTO `tbl_send_otp` (`n_id`, `n_mobile`, `c_emailid`, `n_otp`, `n_verify`, `dt_date`, `dt_time`, `dt_created_at`, `dt_updated_at`) VALUES
	(1, 986534022, NULL, '203082', 2, NULL, NULL, '2022-12-22 13:42:51', NULL);

-- Dumping structure for table beta_phuket.tbl_town
CREATE TABLE IF NOT EXISTS `tbl_town` (
  `n_id` int NOT NULL AUTO_INCREMENT,
  `n_city` int DEFAULT NULL,
  `n_district` int DEFAULT NULL,
  `c_town` varchar(256) DEFAULT NULL,
  `n_sort` int DEFAULT NULL,
  `n_status` int NOT NULL DEFAULT '1',
  `n_delete` int NOT NULL DEFAULT '1',
  `n_created_by` int DEFAULT NULL,
  `dt_created_at` datetime DEFAULT NULL,
  `n_updated_by` int DEFAULT NULL,
  `dt_updated_at` datetime DEFAULT NULL,
  `n_deleted_by` int DEFAULT NULL,
  `dt_deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`n_id`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb3;

-- Dumping data for table beta_phuket.tbl_town: ~23 rows (approximately)
INSERT INTO `tbl_town` (`n_id`, `n_city`, `n_district`, `c_town`, `n_sort`, `n_status`, `n_delete`, `n_created_by`, `dt_created_at`, `n_updated_by`, `dt_updated_at`, `n_deleted_by`, `dt_deleted_at`) VALUES
	(1, 1, 1, 'A.Town', NULL, 2, 1, 2, '2022-09-17 16:42:21', 2, '2022-09-19 18:01:05', NULL, NULL),
	(2, 2, 2, 'Bangtao', NULL, 1, 1, 2, '2022-09-19 17:54:57', NULL, NULL, NULL, NULL),
	(3, 2, 2, 'Sai Kaeo', NULL, 1, 1, 2, '2022-09-19 18:05:57', NULL, NULL, NULL, NULL),
	(4, 2, 2, 'Mai Khao', NULL, 1, 1, 2, '2022-09-19 18:06:16', NULL, NULL, NULL, NULL),
	(5, 2, 2, 'Nai Yang', NULL, 1, 1, 2, '2022-09-19 18:07:29', NULL, NULL, NULL, NULL),
	(6, 2, 2, 'Nai Thon', NULL, 1, 1, 2, '2022-09-19 18:07:46', NULL, NULL, NULL, NULL),
	(7, 2, 2, 'Surin', NULL, 1, 1, 2, '2022-09-19 18:08:24', NULL, NULL, NULL, NULL),
	(8, 2, 3, 'Kamala', NULL, 1, 1, 2, '2022-09-19 18:09:17', NULL, NULL, NULL, NULL),
	(9, 2, 2, 'Kalim', NULL, 1, 1, 2, '2022-09-19 18:09:32', NULL, NULL, NULL, NULL),
	(10, 2, 3, 'Patong', NULL, 1, 1, 2, '2022-09-19 18:09:52', 1, '2022-12-09 11:07:15', NULL, NULL),
	(11, 2, 4, 'Karon', 3, 1, 1, 2, '2022-09-19 18:10:55', NULL, NULL, NULL, NULL),
	(12, 2, 4, 'Kata', 1, 1, 1, 2, '2022-09-19 18:11:14', NULL, NULL, NULL, NULL),
	(13, 2, 4, 'Nai Harn', 2, 1, 1, 2, '2022-09-19 18:11:36', NULL, NULL, NULL, NULL),
	(14, 2, 4, 'Rawai', 4, 1, 1, 2, '2022-09-19 18:11:52', NULL, NULL, NULL, NULL),
	(15, 2, 4, 'Chalong', 5, 1, 1, 2, '2022-09-19 18:12:54', NULL, NULL, NULL, NULL),
	(16, 2, 4, 'Cape Panwa', 6, 1, 1, 2, '2022-09-19 18:13:24', NULL, NULL, NULL, NULL),
	(17, 2, 4, 'Phuket Town', 7, 1, 1, 2, '2022-09-19 18:13:53', NULL, NULL, NULL, NULL),
	(18, 2, 4, 'Wichit', 8, 1, 1, 2, '2022-09-19 18:14:28', NULL, NULL, NULL, NULL),
	(19, 2, 4, 'Ratsada', 9, 1, 1, 2, '2022-09-19 18:15:06', NULL, NULL, NULL, NULL),
	(20, 2, 4, 'Kohkaew', 10, 1, 1, 2, '2022-09-19 18:15:30', NULL, NULL, NULL, NULL),
	(21, 2, 2, 'Srisunthon', NULL, 1, 1, 2, '2022-09-19 18:16:06', NULL, NULL, NULL, NULL),
	(22, 2, 2, 'Paklok', NULL, 1, 1, 2, '2022-09-19 18:16:29', NULL, NULL, NULL, NULL),
	(23, 2, 2, 'Thepkasaatri', NULL, 1, 1, 2, '2022-09-19 18:17:15', NULL, NULL, NULL, NULL);

-- Dumping structure for table beta_phuket.tbl_users
CREATE TABLE IF NOT EXISTS `tbl_users` (
  `n_id` int NOT NULL AUTO_INCREMENT,
  `c_full_name` varchar(128) NOT NULL,
  `c_short_name` varchar(128) DEFAULT NULL,
  `c_emailid` varchar(128) NOT NULL,
  `c_password` text NOT NULL,
  `c_contact_number` varchar(20) NOT NULL,
  `n_is_other` tinyint(1) NOT NULL DEFAULT '1',
  `c_whatsapp` varchar(16) DEFAULT NULL,
  `c_line` varchar(16) DEFAULT NULL,
  `c_profile` varchar(56) DEFAULT NULL,
  `dt_created_on` datetime NOT NULL,
  `n_updated_by` int DEFAULT NULL,
  `dt_updated_on` datetime DEFAULT NULL,
  `n_deleted_by` int DEFAULT NULL,
  `dt_deleted_on` datetime DEFAULT NULL,
  `n_login_count` int DEFAULT NULL,
  `c_address` text,
  `n_role` int NOT NULL,
  `n_accessible_role` text,
  `n_auth` int DEFAULT NULL,
  `n_status` int NOT NULL DEFAULT '1',
  `n_delete` tinyint(1) NOT NULL DEFAULT '1',
  `n_created_by` int NOT NULL,
  `dt_last_login` datetime DEFAULT NULL,
  PRIMARY KEY (`n_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb3;

-- Dumping data for table beta_phuket.tbl_users: ~4 rows (approximately)
INSERT INTO `tbl_users` (`n_id`, `c_full_name`, `c_short_name`, `c_emailid`, `c_password`, `c_contact_number`, `n_is_other`, `c_whatsapp`, `c_line`, `c_profile`, `dt_created_on`, `n_updated_by`, `dt_updated_on`, `n_deleted_by`, `dt_deleted_on`, `n_login_count`, `c_address`, `n_role`, `n_accessible_role`, `n_auth`, `n_status`, `n_delete`, `n_created_by`, `dt_last_login`) VALUES
	(1, 'Jamshed eruch surti', 'Jammy', 'jamshed@siamdealz.com', 'Jammy7', '9986871604', 1, NULL, NULL, NULL, '2022-02-17 14:22:00', NULL, NULL, 1, '2022-08-23 15:29:55', NULL, NULL, 1, '1,2,3', 2, 1, 1, 1, NULL),
	(2, 'Kanlayanee Sae-ong Sassi', 'Khun Puii', 'vp.varenya@gmail.com', 'vp@123', '66869455050', 1, NULL, NULL, NULL, '2022-12-15 14:04:21', NULL, NULL, NULL, NULL, NULL, '', 2, '2', NULL, 1, 1, 1, NULL),
	(3, 'Khun ABCDE', 'Khun AB', 'jamshed.thai@gmail.com', 'Jamshed@123', '66808006560', 1, NULL, NULL, NULL, '2022-12-15 14:10:29', NULL, NULL, NULL, NULL, NULL, '', 4, '4', NULL, 1, 1, 1, NULL),
	(4, 'Khun Anuthida Champada', 'Khun Mimi', 'mimi@gmail.com', 'mimi@123', '66807002062', 1, '', '', 'hoBMQ5zBLnVEa.jpeg', '2022-12-15 14:16:38', 1, '2022-12-21 16:14:32', NULL, NULL, NULL, '', 3, '3', NULL, 1, 1, 1, NULL);

-- Dumping structure for table beta_phuket.tbl_users_login
CREATE TABLE IF NOT EXISTS `tbl_users_login` (
  `n_id` int NOT NULL AUTO_INCREMENT,
  `n_user_id` int NOT NULL,
  `c_browser` longtext,
  `c_version` longtext,
  `c_robot` longtext,
  `c_mobile` longtext,
  `c_platform` longtext,
  `dt_logged_date` datetime NOT NULL,
  PRIMARY KEY (`n_id`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8mb3;

-- Dumping data for table beta_phuket.tbl_users_login: ~30 rows (approximately)
INSERT INTO `tbl_users_login` (`n_id`, `n_user_id`, `c_browser`, `c_version`, `c_robot`, `c_mobile`, `c_platform`, `dt_logged_date`) VALUES
	(1, 2, 'Firefox', '104.0', NULL, NULL, 'Linux', '2022-09-17 16:41:28'),
	(2, 2, 'Firefox', '104.0', NULL, NULL, 'Linux', '2022-09-19 11:31:01'),
	(3, 2, 'Chrome', '105.0.0.0', NULL, NULL, 'Windows 10', '2022-09-19 17:47:14'),
	(4, 2, 'Firefox', '104.0', NULL, NULL, 'Linux', '2022-09-22 14:41:30'),
	(5, 1, 'Firefox', '104.0', NULL, NULL, 'Linux', '2022-09-22 15:35:50'),
	(6, 1, 'Firefox', '104.0', NULL, NULL, 'Linux', '2022-09-22 15:36:46'),
	(7, 2, 'Chrome', '106.0.0.0', NULL, NULL, 'Windows 10', '2022-09-29 22:07:07'),
	(8, 1, 'Firefox', '105.0', NULL, NULL, 'Windows 10', '2022-09-30 10:07:00'),
	(9, 2, 'Chrome', '106.0.0.0', NULL, NULL, 'Windows 10', '2022-09-30 11:07:12'),
	(10, 1, 'Firefox', '105.0', NULL, NULL, 'Linux', '2022-10-06 16:52:37'),
	(11, 1, 'Firefox', '105.0', NULL, NULL, 'Linux', '2022-10-07 17:30:09'),
	(12, 1, 'Firefox', '105.0', NULL, NULL, 'Windows 10', '2022-10-19 02:33:39'),
	(13, 1, 'Chrome', '106.0.0.0', NULL, NULL, 'Windows 10', '2022-10-19 08:51:45'),
	(14, 1, 'Chrome', '106.0.0.0', NULL, NULL, 'Windows 10', '2022-10-26 09:46:33'),
	(15, 1, 'Firefox', '106.0', NULL, NULL, 'Linux', '2022-11-10 14:54:19'),
	(16, 1, 'Firefox', '107.0', NULL, NULL, 'Linux', '2022-12-05 11:09:22'),
	(17, 1, 'Firefox', '107.0', NULL, NULL, 'Linux', '2022-12-05 13:01:02'),
	(18, 1, 'Chrome', '108.0.0.0', NULL, NULL, 'Windows 10', '2022-12-05 13:01:12'),
	(19, 1, 'Chrome', '107.0.0.0', NULL, NULL, 'Windows 10', '2022-12-05 21:48:16'),
	(20, 1, 'Chrome', '107.0.0.0', NULL, NULL, 'Windows 10', '2022-12-09 10:43:33'),
	(21, 1, 'Chrome', '107.0.0.0', NULL, NULL, 'Windows 10', '2022-12-15 13:10:09'),
	(22, 1, 'Firefox', '108.0', NULL, NULL, 'Windows 10', '2022-12-16 16:05:54'),
	(23, 1, 'Chrome', '108.0.0.0', NULL, NULL, 'Linux', '2022-12-21 14:43:43'),
	(24, 1, 'Firefox', '108.0', NULL, NULL, 'Linux', '2022-12-21 15:07:29'),
	(25, 1, 'Firefox', '108.0', NULL, NULL, 'Linux', '2022-12-21 15:19:27'),
	(26, 1, 'Firefox', '108.0', NULL, NULL, 'Linux', '2022-12-21 16:51:45'),
	(27, 1, 'Firefox', '108.0', NULL, NULL, 'Linux', '2022-12-22 13:47:38'),
	(28, 1, 'Firefox', '108.0', NULL, NULL, 'Linux', '2022-12-23 15:38:24'),
	(29, 1, 'Firefox', '108.0', NULL, NULL, 'Linux', '2022-12-23 15:50:00'),
	(30, 1, 'Firefox', '108.0', NULL, NULL, 'Linux', '2022-12-23 16:08:08');

-- Dumping structure for table beta_phuket.tbl_user_role
CREATE TABLE IF NOT EXISTS `tbl_user_role` (
  `n_id` int NOT NULL AUTO_INCREMENT,
  `c_role_title` longtext,
  `c_role_heading` longtext,
  `c_role_list` longtext,
  `n_status` int NOT NULL DEFAULT '1',
  `n_delete` int NOT NULL DEFAULT '1',
  `n_created_by` int DEFAULT NULL,
  `dt_created_date` datetime DEFAULT NULL,
  `n_updated_by` int DEFAULT NULL,
  `dt_updated_date` datetime DEFAULT NULL,
  `n_deleted_by` int DEFAULT NULL,
  `dt_deleted_date` datetime DEFAULT NULL,
  PRIMARY KEY (`n_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb3;

-- Dumping data for table beta_phuket.tbl_user_role: ~4 rows (approximately)
INSERT INTO `tbl_user_role` (`n_id`, `c_role_title`, `c_role_heading`, `c_role_list`, `n_status`, `n_delete`, `n_created_by`, `dt_created_date`, `n_updated_by`, `dt_updated_date`, `n_deleted_by`, `dt_deleted_date`) VALUES
	(1, 'Superadmin', 'state_list,city_list,amenities_list,inclusion_list,roomType_list,imgCatgory_list,pptType_list,role_list,user_list,category_list,product_list,property_list,gallery_list,manage_list', 'vendor_add,vendor_edit,vendor_view,vendor_delete,city_add,city_edit,city_view,city_delete,district_add,district_edit,district_view,district_delete,town_add,town_edit,town_view,town_delete,coupon_add,coupon_edit,coupon_view,coupon_delete,role_add,role_edit,role_view,role_delete,user_add,user_edit,user_view,user_delete,category_add,category_edit,category_view,category_delete,banner_add,banner_edit,banner_view,banner_delete,demographic_add,demographic_edit,demographic_view,demographic_delete,pages_add,pages_edit,pages_view,pages_delete,manage_payment,manage_customer,manage_report', 1, 1, 1, '2022-08-06 12:12:38', 1, '2022-08-08 16:58:47', 1, '2022-08-06 12:18:11'),
	(2, 'Supervisor', 'vendor_list,coupon_list,user_list', 'vendor_add,vendor_edit,vendor_view,vendor_delete,coupon_add,coupon_edit,coupon_view,coupon_delete,user_add,user_edit,user_view,user_delete', 1, 1, 1, '2022-08-25 10:55:18', NULL, NULL, NULL, NULL),
	(3, 'Agent', 'vendor_list', 'vendor_add,vendor_edit,vendor_view,vendor_delete', 1, 1, 1, '2022-08-25 11:06:54', NULL, NULL, NULL, NULL),
	(4, 'Vendor', 'city_list,district_list,town_list', 'city_add,city_edit,city_view,district_add,district_edit,district_view,town_add,town_edit,town_view', 1, 1, 1, '2022-12-15 14:01:02', NULL, NULL, NULL, NULL);

-- Dumping structure for table beta_phuket.tbl_vendor_coupons
CREATE TABLE IF NOT EXISTS `tbl_vendor_coupons` (
  `n_id` int NOT NULL AUTO_INCREMENT,
  `n_vendor` int DEFAULT NULL,
  `n_coupons` int DEFAULT NULL,
  `n_status` tinyint(1) NOT NULL DEFAULT '1',
  `n_delete` tinyint(1) NOT NULL DEFAULT '1',
  `n_created_by` int DEFAULT NULL,
  `dt_created_at` datetime DEFAULT NULL,
  `n_updated_by` int DEFAULT NULL,
  `dt_updated_at` datetime DEFAULT NULL,
  `n_deleted_by` int DEFAULT NULL,
  `dt_deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`n_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf32;

-- Dumping data for table beta_phuket.tbl_vendor_coupons: ~0 rows (approximately)
INSERT INTO `tbl_vendor_coupons` (`n_id`, `n_vendor`, `n_coupons`, `n_status`, `n_delete`, `n_created_by`, `dt_created_at`, `n_updated_by`, `dt_updated_at`, `n_deleted_by`, `dt_deleted_at`) VALUES
	(1, 12, 1, 1, 1, 1, '2022-12-22 13:48:03', 1, '2022-12-22 13:48:10', NULL, NULL);

-- Dumping structure for table beta_phuket.tbl_vendor_coupon_details
CREATE TABLE IF NOT EXISTS `tbl_vendor_coupon_details` (
  `n_id` int NOT NULL AUTO_INCREMENT,
  `n_vendor` int DEFAULT NULL,
  `n_coupon` int DEFAULT NULL,
  `n_calltoconfirm` tinyint(1) DEFAULT '2',
  `n_vailidity` int DEFAULT NULL,
  `n_status` tinyint(1) NOT NULL DEFAULT '1',
  `n_delete` tinyint(1) NOT NULL DEFAULT '1',
  `n_created_by` int DEFAULT NULL,
  `n_is_approve_supervisor` tinyint(1) NOT NULL DEFAULT '2',
  `n_is_approve_admin` tinyint(1) NOT NULL DEFAULT '2',
  `dt_created_at` datetime DEFAULT NULL,
  `n_updated_by` int DEFAULT NULL,
  `dt_updated_at` datetime DEFAULT NULL,
  `n_deleted_by` int DEFAULT NULL,
  `dt_deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`n_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf32;

-- Dumping data for table beta_phuket.tbl_vendor_coupon_details: ~0 rows (approximately)
INSERT INTO `tbl_vendor_coupon_details` (`n_id`, `n_vendor`, `n_coupon`, `n_calltoconfirm`, `n_vailidity`, `n_status`, `n_delete`, `n_created_by`, `n_is_approve_supervisor`, `n_is_approve_admin`, `dt_created_at`, `n_updated_by`, `dt_updated_at`, `n_deleted_by`, `dt_deleted_at`) VALUES
	(1, 12, 1, 1, 30, 1, 1, 1, 1, 1, '2022-12-22 13:48:03', 1, '2022-12-22 13:48:10', NULL, NULL);

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
