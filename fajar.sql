-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Feb 22, 2017 at 04:45 AM
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
  `workers_code` varchar(10) NOT NULL,
  `name` varchar(200) NOT NULL,
  `username` varchar(200) NOT NULL,
  `password` varchar(200) NOT NULL,
  `role` enum('admin','manager','sales','member','') NOT NULL,
  `address` text,
  `email` varchar(200) NOT NULL,
  `phone` varchar(200) NOT NULL,
  `photo` varchar(200) DEFAULT NULL,
  `outlet_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `accounts`
--

INSERT INTO `accounts` (`id`, `workers_code`, `name`, `username`, `password`, `role`, `address`, `email`, `phone`, `photo`, `outlet_id`) VALUES
(1, '', 'admin', 'admin', '909d0a3efbb2c0d7c5bd869a1c4089cc81105ddbf9fb9cda08d0dda36ee376954edc71e822f187b68205805473f6974dea64a46fc106376221de5e5a77c49d0a', 'admin', NULL, 'admin@k-signature.xyz', '081316878995', '', 0),
(14, '', 'Tony', 'fjrbrmngr', '909d0a3efbb2c0d7c5bd869a1c4089cc81105ddbf9fb9cda08d0dda36ee376954edc71e822f187b68205805473f6974dea64a46fc106376221de5e5a77c49d0a', 'manager', NULL, '', '', NULL, 1),
(15, '', 'Yoyoo', 'pameran1', '523ce09aa14e04707e5e1d49c5c4fc7cae3e9253bab218124619f440794e8d8aac7227c0c99cf75c9dc65814619fe45b7043b0ddb76bc145fa6d531e56654941', 'manager', NULL, '', '', NULL, 2),
(16, 'JOS', 'Joshua', 'jos', '909d0a3efbb2c0d7c5bd869a1c4089cc81105ddbf9fb9cda08d0dda36ee376954edc71e822f187b68205805473f6974dea64a46fc106376221de5e5a77c49d0a', 'sales', 'Kelapa Gading', 'josua@gmail.com', '081238211838920', 'uploads/photo/sales/jos//sales-Jos.jpg', 1),
(17, 'MIC', 'Michelle', 'michelle', '909d0a3efbb2c0d7c5bd869a1c4089cc81105ddbf9fb9cda08d0dda36ee376954edc71e822f187b68205805473f6974dea64a46fc106376221de5e5a77c49d0a', 'sales', 'Kemanggisan', 'michelle@gmail.com', '0821317418', 'uploads/photo/sales/michelle//sales-Mic.jpg', 1);

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

--
-- Dumping data for table `code`
--

INSERT INTO `code` (`id`, `code`, `count`) VALUES
(19, 'EAKR', 3),
(20, 'MUT', 6),
(21, 'FBMUT', 2),
(22, 'JU', 1),
(23, 'FBC', 3),
(24, 'SL', 1),
(25, 'FBSL', 1),
(26, 'SL17', 1),
(27, 'FBMUT17', 2),
(28, 'MUT17', 2),
(29, 'MT1702', 2),
(30, 'SL1702', 1),
(31, 'FBSL1702', 1);

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
  `customer_code` varchar(100) NOT NULL,
  `name` varchar(30) NOT NULL,
  `birthday` date DEFAULT NULL,
  `phone` varchar(30) DEFAULT NULL,
  `email` varchar(30) DEFAULT NULL,
  `address` varchar(50) DEFAULT NULL,
  `type` enum('Member','Regular') NOT NULL DEFAULT 'Regular',
  `grade` int(11) DEFAULT '1',
  `member_point` int(11) DEFAULT '0',
  `outlet_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `customer_code`, `name`, `birthday`, `phone`, `email`, `address`, `type`, `grade`, `member_point`, `outlet_id`) VALUES
(7, 'FBC00001', 'Margaret', '1990-09-21', '08627363241', 'margaret@gmai.com', 'Cibubur', 'Regular', 1, 0, 0),
(8, 'FBC00002', 'Willy', '1990-01-08', '0812479478435', 'willy@gmail.com', 'Kelapa Gading', 'Regular', 1, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `customer_grade`
--

CREATE TABLE `customer_grade` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `target` double NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customer_grade`
--

INSERT INTO `customer_grade` (`id`, `name`, `target`) VALUES
(1, 'Regular', 1000000),
(2, 'Gold', 0),
(3, 'Platinum', 0);

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
(1, 'RD', 'Round Diamond'),
(2, 'SD', 'Square Diamond');

-- --------------------------------------------------------

--
-- Table structure for table `member_point_target`
--

CREATE TABLE `member_point_target` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `target` double NOT NULL,
  `amount` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `member_point_target`
--

INSERT INTO `member_point_target` (`id`, `name`, `target`, `amount`) VALUES
(1, 'Regular', 1000000, 1);

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
(1, 'Korea', 'KR');

-- --------------------------------------------------------

--
-- Table structure for table `mutation`
--

CREATE TABLE `mutation` (
  `id` int(11) NOT NULL,
  `code` varchar(100) NOT NULL,
  `product_qty` int(11) NOT NULL,
  `date` datetime NOT NULL,
  `from_outlet` int(11) NOT NULL,
  `to_outlet` int(11) NOT NULL,
  `status` enum('Pending','Diterima','Batal','') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mutation`
--

INSERT INTO `mutation` (`id`, `code`, `product_qty`, `date`, `from_outlet`, `to_outlet`, `status`) VALUES
(6, 'MUT00001', 3, '2017-02-09 11:47:37', 0, 1, 'Diterima'),
(7, 'MUT00002', 3, '2017-02-09 13:11:47', 0, 1, 'Diterima'),
(8, 'MUT00003', 1, '2017-02-09 13:56:48', 1, 0, 'Diterima'),
(9, 'MUT00004', 2, '2017-02-09 13:57:12', 1, 0, 'Diterima'),
(10, 'FBMUT00001', 1, '2017-02-09 14:30:41', 1, 0, 'Diterima'),
(11, 'MUT000000005', 1, '2017-02-16 16:58:30', 0, 1, 'Diterima'),
(12, 'FBMUT17000000001', 1, '2017-02-16 17:00:40', 1, 0, 'Diterima'),
(13, 'MUT17000001', 1, '2017-02-16 17:03:03', 0, 0, 'Diterima'),
(14, 'MT1702000001', 1, '2017-02-16 17:08:14', 0, 0, 'Diterima');

-- --------------------------------------------------------

--
-- Table structure for table `mutation_product`
--

CREATE TABLE `mutation_product` (
  `id` int(11) NOT NULL,
  `mutation_code` varchar(100) NOT NULL,
  `product_code` varchar(100) NOT NULL,
  `status` enum('OK','Rusak','','') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mutation_product`
--

INSERT INTO `mutation_product` (`id`, `mutation_code`, `product_code`, `status`) VALUES
(6, 'MUT00001', 'EAKR00001', 'OK'),
(7, 'MUT00001', 'EAKR00002', 'OK'),
(8, 'MUT00001', 'EAKR00003', 'OK'),
(9, 'MUT00002', 'EAKR00001', 'OK'),
(10, 'MUT00002', 'EAKR00002', 'OK'),
(11, 'MUT00002', 'EAKR00003', 'OK'),
(12, 'MUT00004', 'EAKR00001', 'OK'),
(13, 'MUT00004', 'EAKR00002', 'OK'),
(14, 'FBMUT00001', 'EAKR00003', 'OK'),
(15, 'MUT000000005', 'EAKR00001', 'OK'),
(16, 'FBMUT17000000001', 'EAKR00001', 'OK'),
(17, 'MUT17000001', 'EAKR00001', 'OK'),
(18, 'MT1702000001', 'EAKR00001', 'OK');

-- --------------------------------------------------------

--
-- Table structure for table `outlets`
--

CREATE TABLE `outlets` (
  `id` int(11) NOT NULL,
  `code` char(2) DEFAULT NULL,
  `name` varchar(200) NOT NULL,
  `phone` varchar(200) DEFAULT NULL,
  `address` text,
  `store_manager` varchar(200) DEFAULT NULL,
  `margin` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `outlets`
--

INSERT INTO `outlets` (`id`, `code`, `name`, `phone`, `address`, `store_manager`, `margin`) VALUES
(0, '', 'Brankas', NULL, NULL, '', 0),
(1, 'FB', 'Fajar Baru', '+6285881694188', 'Cibubur', 'Tony', 10),
(2, 'PF', 'Pameran Fajar', '082323421142', 'Botani Square', 'Yoyoo', 10);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `product_type` varchar(30) NOT NULL,
  `product_category` varchar(30) DEFAULT NULL,
  `product_collection` varchar(30) DEFAULT NULL,
  `barcode_code` varchar(30) NOT NULL,
  `product_code` varchar(30) NOT NULL,
  `name` varchar(60) NOT NULL,
  `purchase_price` double DEFAULT NULL,
  `sell_price` double DEFAULT NULL,
  `gold_amount` double DEFAULT NULL,
  `weight` double DEFAULT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `outlet_id` int(11) DEFAULT '0',
  `tray_id` int(50) DEFAULT NULL,
  `status` enum('available','booked','terjual','rusak','pending') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `product_type`, `product_category`, `product_collection`, `barcode_code`, `product_code`, `name`, `purchase_price`, `sell_price`, `gold_amount`, `weight`, `photo`, `outlet_id`, `tray_id`, `status`) VALUES
(25, 'E', 'A', 'KR', 'EAKR', 'EAKR00001', 'Anting Emas Korea', 250000, 270000, 20, 3.21, '', 0, 0, 'available'),
(26, 'E', 'A', 'KR', 'EAKR', 'EAKR00002', 'Anting Emas Korea 2', 400000, 650000, 45, 2.23, '', 1, 0, 'pending'),
(27, 'E', 'A', 'KR', 'EAKR', 'EAKR00003', 'Anting Emas Korea 3', 0, 0, 0, 0, 'uploads/photo/product/Pilih Outlet terlebih dahulu/EAKR00003.jpg', 0, 0, 'available');

-- --------------------------------------------------------

--
-- Table structure for table `sale`
--

CREATE TABLE `sale` (
  `id` int(11) NOT NULL,
  `sale_code` varchar(100) NOT NULL,
  `date` datetime NOT NULL,
  `outlet_id` int(11) NOT NULL,
  `sales_id` int(11) NOT NULL,
  `customer_code` varchar(100) NOT NULL,
  `qty` int(11) NOT NULL,
  `total_price` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sales_target`
--

CREATE TABLE `sales_target` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `target` double NOT NULL,
  `description` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sales_target`
--

INSERT INTO `sales_target` (`id`, `name`, `target`, `description`) VALUES
(1, 'Target#1', 100, 'Dapat tambahan gaji 1000000');

-- --------------------------------------------------------

--
-- Table structure for table `sale_detail`
--

CREATE TABLE `sale_detail` (
  `id` int(11) NOT NULL,
  `product_code` int(11) NOT NULL,
  `sale_code` int(11) NOT NULL,
  `selling_price` int(11) NOT NULL,
  `discount` int(11) NOT NULL,
  `total_price` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `specification`
--

CREATE TABLE `specification` (
  `id` int(11) NOT NULL,
  `product_code` varchar(20) NOT NULL,
  `stone_type` varchar(10) NOT NULL,
  `stone_amount` double NOT NULL,
  `stone_ct` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `specification`
--

INSERT INTO `specification` (`id`, `product_code`, `stone_type`, `stone_amount`, `stone_ct`) VALUES
(1, 'BC00001', 'RD', 3, 4),
(2, 'BC00001', 'SD', 2, 3);

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
(3, 'TR003', 1, 'Isi gelang kalung koleksi Dubai');

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
-- Indexes for table `customer_grade`
--
ALTER TABLE `customer_grade`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `diamond_type`
--
ALTER TABLE `diamond_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `member_point_target`
--
ALTER TABLE `member_point_target`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `model`
--
ALTER TABLE `model`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mutation`
--
ALTER TABLE `mutation`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mutation_product`
--
ALTER TABLE `mutation_product`
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
-- Indexes for table `sale`
--
ALTER TABLE `sale`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sales_target`
--
ALTER TABLE `sales_target`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sale_detail`
--
ALTER TABLE `sale_detail`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `specification`
--
ALTER TABLE `specification`
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `code`
--
ALTER TABLE `code`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `customer_grade`
--
ALTER TABLE `customer_grade`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `diamond_type`
--
ALTER TABLE `diamond_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `member_point_target`
--
ALTER TABLE `member_point_target`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `model`
--
ALTER TABLE `model`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `mutation`
--
ALTER TABLE `mutation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `mutation_product`
--
ALTER TABLE `mutation_product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT for table `outlets`
--
ALTER TABLE `outlets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;
--
-- AUTO_INCREMENT for table `sale`
--
ALTER TABLE `sale`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `sales_target`
--
ALTER TABLE `sales_target`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `sale_detail`
--
ALTER TABLE `sale_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `specification`
--
ALTER TABLE `specification`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `suppliers`
--
ALTER TABLE `suppliers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
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
