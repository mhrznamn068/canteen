-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Nov 20, 2016 at 08:01 AM
-- Server version: 10.1.16-MariaDB
-- PHP Version: 7.0.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `canteenmgmt`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_category`
--

CREATE TABLE `tbl_category` (
  `category_id` int(11) NOT NULL,
  `category_title` varchar(255) NOT NULL,
  `category_status` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_category`
--

INSERT INTO `tbl_category` (`category_id`, `category_title`, `category_status`) VALUES
(1, 'Fast food', 1),
(3, 'Cold drinks', 0),
(4, 'Fruit juices', 1),
(6, 'Hot drink', 1),
(7, 'Bakery items', 1),
(8, 'Spiecy foods', 1),
(9, 'Hard drink', 1),
(10, 'Sea foods', 1),
(11, 'Tandoori', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_item`
--

CREATE TABLE `tbl_item` (
  `item_id` int(11) NOT NULL,
  `item_title` varchar(255) NOT NULL,
  `item_category` int(11) NOT NULL,
  `item_price` double NOT NULL,
  `item_status` int(11) NOT NULL DEFAULT '1',
  `is_special` int(11) NOT NULL,
  `createdDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_item`
--

INSERT INTO `tbl_item` (`item_id`, `item_title`, `item_category`, `item_price`, `item_status`, `is_special`, `createdDate`) VALUES
(1, 'Chowmein', 1, 100, 1, 0, '2016-07-22 00:11:38'),
(2, 'Momo', 1, 100, 0, 1, '2016-07-22 00:11:38'),
(3, 'Samosa', 1, 100, 0, 0, '2016-07-22 00:11:38'),
(4, '', 0, 100, 1, 0, '2016-07-22 00:11:38'),
(5, 'Pakauda', 1, 100, 1, 1, '2016-07-22 00:11:38'),
(6, 'Chana tarkari', 1, 100, 1, 1, '2016-07-22 00:11:38'),
(7, 'Aalu tarkari', 1, 100, 1, 1, '2016-07-22 00:11:38'),
(8, 'Mixed chowmein', 1, 100, 1, 1, '2016-07-22 00:11:38'),
(9, 'Buff Thukpa', 1, 100, 1, 0, '2016-07-22 00:11:38'),
(10, 'Bread chop', 1, 100, 1, 0, '2016-07-22 00:11:38'),
(11, 'Sekuwa', 1, 100, 1, 0, '2016-07-22 00:11:38'),
(12, 'Khaja set', 1, 100, 1, 0, '2016-07-16 18:32:40'),
(13, 'Sausage', 1, 100, 1, 0, '2016-07-22 00:11:38'),
(14, 'Fanta', 1, 100, 1, 0, '2016-07-22 00:11:38'),
(15, 'asdsad', 1, 100, 1, 0, '2016-07-22 00:11:38'),
(16, 'assa', 0, 100, 1, 0, '2016-07-22 00:11:38'),
(17, 'asdfsdf', 0, 100, 1, 0, '2016-07-22 00:11:38'),
(18, 'ccccc', 0, 100, 1, 0, '2016-07-22 00:11:38'),
(19, 'dddd', 0, 100, 1, 0, '2016-07-22 00:11:38'),
(20, 'sdfasd', 0, 100, 1, 0, '2016-07-22 00:11:38'),
(21, 'asdfasdfasdf', 1, 100, 1, 0, '2016-07-22 00:11:38'),
(22, 'pasta', 1, 100, 1, 0, '2016-07-22 00:11:38'),
(23, 'Tea', 1, 100, 1, 0, '2016-07-22 00:11:38'),
(24, 'Coffee', 1, 100, 1, 0, '2016-07-22 00:11:38'),
(25, 'Hot lemon', 1, 100, 1, 0, '2016-11-10 11:46:37'),
(26, 'Coca cola', 1, 100, 1, 0, '2016-11-10 11:46:32'),
(27, 'Some item', 10, 100, 0, 0, '2016-07-22 03:51:40');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_order`
--

CREATE TABLE `tbl_order` (
  `order_id` int(11) NOT NULL,
  `order_placed_by` varchar(255) NOT NULL,
  `total_price` double NOT NULL,
  `identification_no` int(11) NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_order`
--

INSERT INTO `tbl_order` (`order_id`, `order_placed_by`, `total_price`, `identification_no`, `created_date`, `status`) VALUES
(1, 'Sujendra shrestha', 700, 11991, '2016-11-10 11:46:02', 2),
(2, 'Ram test', 300, 0, '2016-07-22 04:41:13', 1),
(3, 'New test', 100, 234, '2016-07-22 04:40:45', 2),
(4, 'New order', 200, 0, '2016-07-22 04:41:11', 1),
(5, 'Shyam khadka', 400, 123, '2016-11-09 16:34:26', 1),
(6, 'Gita shrestha', 100, 1233, '2016-11-10 11:45:23', 1),
(7, 'Aman Maharjan', 500, 59, '2016-11-10 11:45:44', 2),
(8, 'chana', 0, 3, '2016-11-12 14:13:16', 1),
(9, 'Rijan Koju', 100, 10, '2016-11-16 03:47:48', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_order_detail`
--

CREATE TABLE `tbl_order_detail` (
  `order_detail_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `item_price` double NOT NULL,
  `item_quantity` int(11) NOT NULL,
  `item_status` int(11) NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_order_detail`
--

INSERT INTO `tbl_order_detail` (`order_detail_id`, `order_id`, `item_id`, `item_price`, `item_quantity`, `item_status`, `created_date`) VALUES
(1, 1, 8, 100, 2, 0, '2016-07-22 00:12:18'),
(2, 1, 13, 100, 4, 0, '2016-07-22 00:12:18'),
(3, 1, 9, 100, 1, 0, '2016-07-22 00:12:18'),
(4, 2, 15, 100, 2, 0, '2016-07-22 03:00:38'),
(5, 2, 5, 100, 1, 0, '2016-07-22 03:00:38'),
(6, 3, 5, 100, 1, 0, '2016-07-22 04:26:45'),
(7, 4, 6, 100, 2, 0, '2016-07-22 04:27:23'),
(8, 5, 5, 100, 4, 0, '2016-07-22 04:38:20'),
(9, 6, 6, 100, 1, 0, '2016-07-22 04:38:50'),
(10, 7, 13, 100, 5, 0, '2016-11-09 16:41:28'),
(11, 8, 6, 100, 0, 0, '2016-11-12 14:12:28'),
(12, 9, 24, 100, 1, 0, '2016-11-16 03:47:24');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user`
--

CREATE TABLE `tbl_user` (
  `user_id` int(11) NOT NULL,
  `user_name` varchar(255) NOT NULL,
  `user_pass` varchar(255) NOT NULL,
  `user_role` int(11) NOT NULL,
  `user_addeddate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `user_status` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_user`
--

INSERT INTO `tbl_user` (`user_id`, `user_name`, `user_pass`, `user_role`, `user_addeddate`, `user_status`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 1, '2016-07-17 03:51:46', 1),
(59, 'aman', '8ad73f92d9f9d8ffbb8fcc019cab870008ac555c', 1, '2016-11-09 16:31:38', 1),
(60, 'rijan', 'ffbbab804c56210690a8d9e23fa759e29b3d738c', 0, '2016-11-18 05:12:18', 1),
(90, 'rabi', '4f7da87beb38a92c671658a7d9ed83a9334701b5', 0, '2016-11-18 05:12:50', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_category`
--
ALTER TABLE `tbl_category`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `tbl_item`
--
ALTER TABLE `tbl_item`
  ADD PRIMARY KEY (`item_id`),
  ADD KEY `item_category` (`item_category`);

--
-- Indexes for table `tbl_order`
--
ALTER TABLE `tbl_order`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `tbl_order_detail`
--
ALTER TABLE `tbl_order_detail`
  ADD PRIMARY KEY (`order_detail_id`);

--
-- Indexes for table `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_category`
--
ALTER TABLE `tbl_category`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `tbl_item`
--
ALTER TABLE `tbl_item`
  MODIFY `item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;
--
-- AUTO_INCREMENT for table `tbl_order`
--
ALTER TABLE `tbl_order`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `tbl_order_detail`
--
ALTER TABLE `tbl_order_detail`
  MODIFY `order_detail_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=91;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
