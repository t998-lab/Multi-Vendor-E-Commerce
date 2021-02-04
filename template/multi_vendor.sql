-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 04, 2021 at 07:10 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `multi_vendor`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `Admin_ID` int(3) NOT NULL,
  `Admin_Name` varchar(50) DEFAULT NULL,
  `Admin_Email` varchar(50) DEFAULT NULL,
  `Admin_password` varchar(50) DEFAULT NULL,
  `mobile` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`Admin_ID`, `Admin_Name`, `Admin_Email`, `Admin_password`, `mobile`) VALUES
(1, 'Tima Al-Jayyousi', 'aljayyousitima@yahoo.com', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', '0787483707');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `Cat_ID` int(3) NOT NULL,
  `Cat_Name` varchar(50) DEFAULT NULL,
  `Cat_desc` varchar(50) DEFAULT NULL,
  `Cat_image` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`Cat_ID`, `Cat_Name`, `Cat_desc`, `Cat_image`) VALUES
(1, 'Women Clothes', '......', '601bce90410f3531969217c550dba80715175dd10db79'),
(2, 'Men Clothes', '...', '601bd317388c9338204bb463d1c305f89c062e4022b92'),
(4, 'Kids ', '...', '601bd3a21c9d6937460bd4a6272c0ab6db450960efbc9'),
(6, 'shoes', '...', 'shoes3.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `c_ID` int(3) NOT NULL,
  `c_Name` varchar(50) DEFAULT NULL,
  `c_Email` varchar(50) DEFAULT NULL,
  `c_Pass` varchar(50) DEFAULT NULL,
  `c_img` text DEFAULT NULL,
  `mobile` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`c_ID`, `c_Name`, `c_Email`, `c_Pass`, `c_img`, `mobile`) VALUES
(2, 'Majed ', 'majed@gmail.com', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', NULL, '078777779'),
(3, 'ahmed ahmed', 'ahmed@gmail.com', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', NULL, '0797483733');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `o_ID` int(3) NOT NULL,
  `o_Date` date DEFAULT NULL,
  `Total` double DEFAULT NULL,
  `customer_id` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`o_ID`, `o_Date`, `Total`, `customer_id`) VALUES
(22, '2021-02-04', 70, 2),
(25, '2021-02-04', 10, 2),
(26, '2021-02-04', 170, 2),
(27, '2021-02-04', 80, 2),
(28, '2021-02-04', 60, 3),
(29, '2021-02-04', 100, 3);

-- --------------------------------------------------------

--
-- Table structure for table `order_details`
--

CREATE TABLE `order_details` (
  `d_ID` int(3) NOT NULL,
  `o_id` int(3) DEFAULT NULL,
  `p_id` int(3) DEFAULT NULL,
  `qty` int(3) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `order_details`
--

INSERT INTO `order_details` (`d_ID`, `o_id`, `p_id`, `qty`) VALUES
(45, 22, 6, 1),
(46, 22, 1, 3),
(47, 25, 6, 1),
(48, 26, 2, 4),
(49, 26, 9, 1),
(50, 26, 4, 2),
(51, 26, 8, 1),
(52, 27, 4, 2),
(53, 28, 11, 1),
(54, 28, 5, 1),
(55, 29, 11, 2);

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `p_id` int(3) NOT NULL,
  `p_name` varchar(50) NOT NULL,
  `p_desc` varchar(255) NOT NULL,
  `p_image` text NOT NULL,
  `c_id` int(3) NOT NULL,
  `v_id` int(3) NOT NULL,
  `price` double NOT NULL,
  `qty` int(3) NOT NULL,
  `date` date NOT NULL,
  `sales` int(11) NOT NULL,
  `Earning` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`p_id`, `p_name`, `p_desc`, `p_image`, `c_id`, `v_id`, `price`, `qty`, `date`, `sales`, `Earning`) VALUES
(1, 'dress', '......', '601bdc66b84e7e306f572dbe2d6225e9b974bb119389f', 1, 3, 20, 33, '2021-02-04', 3, 60),
(2, 'shirt', 'dddd', '601bdcb4d82e8cbdb13f8e348fd519a636047edda0f98', 2, 3, 10, 186, '2021-02-04', 4, 40),
(4, 'shoes', 'black shoes ', '601bdd8a879664a2957dca867a56b8803d9c1ee65b1cf', 6, 2, 40, 0, '2021-02-04', 4, 160),
(5, 'shoes', 'sss', '601bddae0cf5390d9fd826a93426f7a6bd5544782b88c', 6, 2, 10, 45, '2021-02-04', 1, 10),
(6, 't-shirt', 'nice t-shirt ', '601bddd5a12b6ee93d2b60b6499a71de06a3fc39c1e00', 1, 2, 10, 0, '2021-02-04', 2, 20),
(7, 'shoes', 'a', '601bdeb15f5da32db4a15c7b6ecb84e28bb0b2939de06', 6, 4, 15, 43, '2021-02-04', 0, 0),
(8, 'shoes', 'asssssss', '601bdeca89a5308fb20264821a8a1b32b7e2879649741', 6, 4, 10, 4, '2021-02-04', 1, 10),
(9, 'pant for kids', 'sssssssss', '601bdf0908513221efb8cf99983d8b3cda56316a57bce', 4, 4, 40, 0, '2021-02-04', 1, 40),
(10, 'shoes', 'ssssss', '601bdf574e0322cf248434b574aa0084edebc5e9b7186', 6, 4, 19.5, 99, '2021-02-04', 0, 0),
(11, 'avit', '....', '601c20858ec7af01a095fc138d55baab903a1d6866374', 1, 3, 50, 97, '2021-02-04', 3, 150),
(12, 'avit2', 'aviiiiiitttt', '601c209a7855a795e3c08544c16ef9c24e5fafb19552a', 1, 3, 50, 100, '2021-02-04', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `vendor`
--

CREATE TABLE `vendor` (
  `v_ID` int(3) NOT NULL,
  `v_Name` varchar(50) DEFAULT NULL,
  `v_Email` varchar(50) DEFAULT NULL,
  `v_Pass` varchar(50) DEFAULT NULL,
  `v_img` text DEFAULT NULL,
  `cat_id` int(3) DEFAULT NULL,
  `mobile` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `vendor`
--

INSERT INTO `vendor` (`v_ID`, `v_Name`, `v_Email`, `v_Pass`, `v_img`, `cat_id`, `mobile`) VALUES
(2, 'Al Shorooq', 'shorooqjayyousi88@gmail.com', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', '11266658aed35435279eac0b50b85cb4', 1, '0787878787'),
(3, 'AVIT', 'timajayyousi@gmail.com', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'd20c56f04efc0b1e86b34ff926b88a50', 1, '0787878744'),
(4, 'NIKE', 'aljayyousitima@gmail.com', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', '9e5959a0f299d4ebcec102a0273dd31b', 6, '0777777777');

-- --------------------------------------------------------

--
-- Table structure for table `vendor_requist`
--

CREATE TABLE `vendor_requist` (
  `id` int(3) NOT NULL,
  `vendor_name` varchar(50) NOT NULL,
  `v_email` varchar(50) NOT NULL,
  `category` varchar(50) NOT NULL,
  `logo` text NOT NULL,
  `mobile` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `vendor_requist`
--

INSERT INTO `vendor_requist` (`id`, `vendor_name`, `v_email`, `category`, `logo`, `mobile`) VALUES
(5, 'ss', 'ss@gmail.com', '2', 'cbdb13f8e348fd519a636047edda0f98', '7878787555');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`Admin_ID`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`Cat_ID`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`c_ID`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`o_ID`),
  ADD KEY `customer_id` (`customer_id`);

--
-- Indexes for table `order_details`
--
ALTER TABLE `order_details`
  ADD PRIMARY KEY (`d_ID`),
  ADD KEY `o_id` (`o_id`),
  ADD KEY `order_details_ibfk_2` (`p_id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`p_id`),
  ADD KEY `c_id` (`c_id`),
  ADD KEY `v_id` (`v_id`);

--
-- Indexes for table `vendor`
--
ALTER TABLE `vendor`
  ADD PRIMARY KEY (`v_ID`),
  ADD KEY `vendor_ibfk_1` (`cat_id`);

--
-- Indexes for table `vendor_requist`
--
ALTER TABLE `vendor_requist`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `Admin_ID` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `Cat_ID` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `c_ID` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `o_ID` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `order_details`
--
ALTER TABLE `order_details`
  MODIFY `d_ID` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `p_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `vendor`
--
ALTER TABLE `vendor`
  MODIFY `v_ID` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `vendor_requist`
--
ALTER TABLE `vendor_requist`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`c_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `order_details`
--
ALTER TABLE `order_details`
  ADD CONSTRAINT `order_details_ibfk_1` FOREIGN KEY (`o_id`) REFERENCES `orders` (`o_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `order_details_ibfk_2` FOREIGN KEY (`p_id`) REFERENCES `product` (`p_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `product_ibfk_1` FOREIGN KEY (`c_id`) REFERENCES `category` (`Cat_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `product_ibfk_2` FOREIGN KEY (`v_id`) REFERENCES `vendor` (`v_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `vendor`
--
ALTER TABLE `vendor`
  ADD CONSTRAINT `vendor_ibfk_1` FOREIGN KEY (`cat_id`) REFERENCES `category` (`Cat_ID`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
