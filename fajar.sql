-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jan 26, 2017 at 03:06 AM
-- Server version: 10.1.10-MariaDB
-- PHP Version: 5.6.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `fajar`
--

-- --------------------------------------------------------

--
-- Table structure for table `accounts`
--

CREATE TABLE `accounts` (
  `id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `username` varchar(200) NOT NULL,
  `password` varchar(200) NOT NULL,
  `role` enum('admin','manager','sales','') NOT NULL,
  `address` text,
  `email` varchar(200) NOT NULL,
  `phone` varchar(200) NOT NULL,
  `photo` varchar(200) DEFAULT NULL,
  `outlet_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `accounts`
--

INSERT INTO `accounts` (`id`, `name`, `username`, `password`, `role`, `address`, `email`, `phone`, `photo`, `outlet_id`) VALUES
(1, 'admin', 'admin', '909d0a3efbb2c0d7c5bd869a1c4089cc81105ddbf9fb9cda08d0dda36ee376954edc71e822f187b68205805473f6974dea64a46fc106376221de5e5a77c49d0a', 'admin', NULL, 'admin@k-signature.xyz', '081316878995', '', 0),
(14, 'Tony', 'fjrbrmngr', '523ce09aa14e04707e5e1d49c5c4fc7cae3e9253bab218124619f440794e8d8aac7227c0c99cf75c9dc65814619fe45b7043b0ddb76bc145fa6d531e56654941', 'manager', NULL, '', '', NULL, 1),
(15, 'Yoyoo', 'pameran1', '523ce09aa14e04707e5e1d49c5c4fc7cae3e9253bab218124619f440794e8d8aac7227c0c99cf75c9dc65814619fe45b7043b0ddb76bc145fa6d531e56654941', 'manager', NULL, '', '', NULL, 2);

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `code` char(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `name`, `code`) VALUES
(11, 'Anting', 'A'),
(12, 'Cincin', 'C'),
(13, 'Gelang', 'G'),
(15, 'Kalung', 'K');

-- --------------------------------------------------------

--
-- Table structure for table `code`
--

CREATE TABLE `code` (
  `id` int(11) NOT NULL,
  `code` varchar(15) NOT NULL,
  `count` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `configuration`
--

CREATE TABLE `configuration` (
  `id` int(11) NOT NULL,
  `primary_color` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `configuration`
--

INSERT INTO `configuration` (`id`, `primary_color`) VALUES
(2, '#0f3a76');

-- --------------------------------------------------------

--
-- Table structure for table `currency`
--

CREATE TABLE `currency` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `value` double NOT NULL,
  `last_update` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `currency`
--

INSERT INTO `currency` (`id`, `name`, `value`, `last_update`) VALUES
(1, 'Dollar', 15541, '2017-01-05 09:34:24'),
(2, 'Gold', 514093, '2016-12-02 03:24:09');

-- --------------------------------------------------------

--
-- Table structure for table `currency_history`
--

CREATE TABLE `currency_history` (
  `id` int(11) NOT NULL,
  `currency_id` int(11) NOT NULL,
  `value` double NOT NULL,
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `currency_history`
--

INSERT INTO `currency_history` (`id`, `currency_id`, `value`, `date`) VALUES
(1, 1, 13541, '2016-12-02 03:23:23'),
(2, 2, 514093, '2016-12-02 03:24:09'),
(3, 3, 119, '2016-12-02 03:25:07'),
(4, 1, 14541, '2017-01-05 09:24:39'),
(5, 1, 15541, '2017-01-05 09:30:32'),
(6, 1, 15541, '2017-01-05 09:31:37'),
(7, 1, 15541, '2017-01-05 09:34:24'),
(8, 4, 120, '2017-01-05 09:35:35');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` int(11) NOT NULL,
  `name` varchar(30) NOT NULL,
  `birthday` date DEFAULT NULL,
  `phone` varchar(30) NOT NULL,
  `email` varchar(30) NOT NULL,
  `address` varchar(50) NOT NULL,
  `type` enum('Member','Regular') NOT NULL,
  `grade` enum('Regular','Gold','Platinum') DEFAULT NULL,
  `outlet_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `name`, `birthday`, `phone`, `email`, `address`, `type`, `grade`, `outlet_id`) VALUES
(2, 'Rini', NULL, '082342123432', 'rini@rini.co', 'Pulogadung', 'Member', 'Gold', 1),
(3, 'Tono', '1992-03-09', '0812712483', 'tono@ton.co', 'Pulomas', 'Regular', 'Gold', 1),
(4, 'Michael', '1990-02-16', '08234431234', 'michael@gmail.co', 'Kemanggisan', 'Member', 'Platinum', 1);

-- --------------------------------------------------------

--
-- Table structure for table `diamond_type`
--

CREATE TABLE `diamond_type` (
  `id` int(11) NOT NULL,
  `code` varchar(5) NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `diamond_type`
--

INSERT INTO `diamond_type` (`id`, `code`, `name`) VALUES
(0, 'RD', 'Round Diamond');

-- --------------------------------------------------------

--
-- Table structure for table `model`
--

CREATE TABLE `model` (
  `id` int(11) NOT NULL,
  `name` varchar(30) NOT NULL,
  `code` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `model`
--

INSERT INTO `model` (`id`, `name`, `code`) VALUES
(2, 'Korea', 'KR');

-- --------------------------------------------------------

--
-- Table structure for table `outlets`
--

CREATE TABLE `outlets` (
  `id` int(11) NOT NULL,
  `code` char(2) NOT NULL,
  `name` varchar(200) NOT NULL,
  `phone` varchar(200) DEFAULT NULL,
  `address` text,
  `store_manager` varchar(200) NOT NULL,
  `margin` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `outlets`
--

INSERT INTO `outlets` (`id`, `code`, `name`, `phone`, `address`, `store_manager`, `margin`) VALUES
(1, 'FB', 'Fajar Baru', '+6285881694188', 'Cibubur', 'Tony', 10),
(2, 'PF', 'Pameran Fajar', '082323421142', 'Botani Square', 'Yoyoo', 10);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `product_type` varchar(30) NOT NULL,
  `barcode_code` varchar(30) NOT NULL,
  `product_code` varchar(30) NOT NULL,
  `name` varchar(60) NOT NULL,
  `purchase_price` double DEFAULT NULL,
  `sell_price` double DEFAULT NULL,
  `gold_amount` double NOT NULL,
  `weight` double NOT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `outlet_id` int(11) DEFAULT NULL,
  `tray_code` varchar(50) DEFAULT NULL,
  `status` enum('available','booked','terjual','rusak') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `product_type`, `barcode_code`, `product_code`, `name`, `purchase_price`, `sell_price`, `gold_amount`, `weight`, `photo`, `outlet_id`, `tray_code`, `status`) VALUES
(4, 'B', 'BK', 'BK00001', 'June', 9000000, 9200000, 8, 46, 'uploads/photo/product//BK00001.jpg', NULL, NULL, 'available'),
(5, 'E', 'ECKR', 'ECKR00001', 'Cincin MK', 7800000, 7900000, 9, 67, '', 1, '1', 'available');

-- --------------------------------------------------------

--
-- Table structure for table `specification`
--

CREATE TABLE `specification` (
  `id` int(11) NOT NULL,
  `product_code` varchar(20) NOT NULL,
  `stone_type` int(11) NOT NULL,
  `stone_amount` int(11) NOT NULL,
  `stone_ct` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `suppliers`
--

CREATE TABLE `suppliers` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `suppliers`
--

INSERT INTO `suppliers` (`id`, `name`, `phone`, `address`, `email`, `description`) VALUES
(1, 'Golds Co.', '0812353242', 'Goldenway', 'gold@co.co', 'Gold supplier');

-- --------------------------------------------------------

--
-- Table structure for table `tray`
--

CREATE TABLE `tray` (
  `id` int(11) NOT NULL,
  `code` varchar(255) NOT NULL,
  `outlet_id` int(11) NOT NULL,
  `description` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tray`
--

INSERT INTO `tray` (`id`, `code`, `outlet_id`, `description`) VALUES
(1, 'TR001', 1, 'Isi koleksi Korea'),
(3, 'TR003', 0, 'Isi gelang kalung koleksi Dubai');

-- --------------------------------------------------------

--
-- Table structure for table `type`
--

CREATE TABLE `type` (
  `id` int(11) NOT NULL,
  `name` varchar(20) NOT NULL,
  `code` char(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `type`
--

INSERT INTO `type` (`id`, `name`, `code`) VALUES
(1, 'Emas', 'E'),
(3, 'Berlian', 'B');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accounts`
--
ALTER TABLE `accounts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `code`
--
ALTER TABLE `code`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `configuration`
--
ALTER TABLE `configuration`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `currency`
--
ALTER TABLE `currency`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `currency_history`
--
ALTER TABLE `currency_history`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `model`
--
ALTER TABLE `model`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `outlets`
--
ALTER TABLE `outlets`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `suppliers`
--
ALTER TABLE `suppliers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tray`
--
ALTER TABLE `tray`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `type`
--
ALTER TABLE `type`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accounts`
--
ALTER TABLE `accounts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `code`
--
ALTER TABLE `code`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `configuration`
--
ALTER TABLE `configuration`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `currency`
--
ALTER TABLE `currency`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `currency_history`
--
ALTER TABLE `currency_history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `model`
--
ALTER TABLE `model`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `outlets`
--
ALTER TABLE `outlets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `suppliers`
--
ALTER TABLE `suppliers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `tray`
--
ALTER TABLE `tray`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `type`
--
ALTER TABLE `type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
