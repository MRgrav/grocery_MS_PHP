-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jun 13, 2023 at 07:55 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `grocDB`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `pwd` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `name`, `pwd`) VALUES
(1, 'admin', 'admin'),
(123, 'admin', '$2y$10$N.2VP.4B19wLl3PQohnwFufRsmM32BntTp7VwrY3A7Q9E/Azwvf6u'),
(125, 'admin', 'viaQBz/rJqlR28XP32YlgA==');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `c_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `c_name`) VALUES
(2, 'Household'),
(3, 'Oils'),
(5, 'Cleaning '),
(6, 'Food grains'),
(7, 'Snacks'),
(9, 'Fruits'),
(11, 'Beveragess'),
(12, 'Masalas'),
(13, 'Vegetable'),
(14, 'shampoo');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `phone` bigint(20) NOT NULL,
  `address` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`id`, `name`, `phone`, `address`) VALUES
(1, 'Abhishek Das', 7002169749, 'Guwahati'),
(2, 'Amrita Das', 1234567890, 'Bongaigaon'),
(3, 'Ankit Gupta', 2323232323, 'Amguri'),
(11, 'khyati Baruati', 9365765563, 'Jorhat'),
(12, 'Gaurab Gogoi', 7002169788, 'Golaghat');

-- --------------------------------------------------------

--
-- Table structure for table `invoice`
--

CREATE TABLE `invoice` (
  `id` varchar(30) NOT NULL,
  `p_method` varchar(50) DEFAULT NULL,
  `amount` float DEFAULT NULL,
  `p_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `invoice`
--

INSERT INTO `invoice` (`id`, `p_method`, `amount`, `p_date`) VALUES
('GMS/0612/1100', 'cash', 800, '2023-06-13'),
('GMS/0612/1124', 'cash', 100, '2023-06-13'),
('GMS/0612/1130', 'cash', 100, '2023-06-13');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `p_id` int(11) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `amount` float DEFAULT NULL,
  `c_id` int(11) NOT NULL,
  `inv_id` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `p_id`, `quantity`, `amount`, `c_id`, `inv_id`) VALUES
(16, 7, 10, 800, 11, 'GMS/0612/1100'),
(17, 2, 10, 100, 1, 'GMS/0612/1124'),
(18, 2, 10, 100, 12, 'GMS/0612/1130');

--
-- Triggers `orders`
--
DELIMITER $$
CREATE TRIGGER `outs` AFTER INSERT ON `orders` FOR EACH ROW BEGIN
DECLARE var_quan INT;
SELECT available into var_quan FROM `product` WHERE id = NEW.p_id;
IF var_quan < 0 THEN
	SET var_quan = 0;
    UPDATE `product` SET available = var_quan WHERE id = NEW.p_id;
END IF;
UPDATE `product` SET available = available - NEW.quantity,
product.stock_out = product.stock_out - NEW.quantity WHERE id = NEW.p_id;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `p_name` varchar(100) DEFAULT NULL,
  `price` float DEFAULT NULL,
  `descp` varchar(250) DEFAULT NULL,
  `c_id` int(11) DEFAULT NULL,
  `stock_in` bigint(20) DEFAULT NULL,
  `stock_out` bigint(20) DEFAULT NULL,
  `available` bigint(20) DEFAULT NULL,
  `a_id` int(11) DEFAULT NULL,
  `min_req` int(11) NOT NULL,
  `unit_type` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `p_name`, `price`, `descp`, `c_id`, `stock_in`, `stock_out`, `available`, `a_id`, `min_req`, `unit_type`) VALUES
(1, 'Parle G', 10, 'Nutritional cookies', 7, 30, 0, 30, 125, 20, 'pcs'),
(2, 'Maggi', 10, 'noodles packet with masala inside', 7, 53, 20, 20, 125, 20, 'pcs'),
(3, 'Rice', 20, 'High quality Rice grains.', 6, 73, 0, 73, 125, 30, 'kg'),
(5, 'Refine', 23, 'Cooking oil', 3, 10, 0, 10, 125, 20, 'ltr'),
(7, 'Apples', 80, 'Fresh Apples', 9, 50, 10, 40, 125, 10, 'kg'),
(9, 'Potatoes', 19, 'Fresh homegrown potatoes', 13, 50, 0, 50, 125, 30, 'kg');

-- --------------------------------------------------------

--
-- Table structure for table `supplied`
--

CREATE TABLE `supplied` (
  `id` int(11) NOT NULL,
  `p_id` int(11) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `r_date` date DEFAULT NULL,
  `amount` double DEFAULT NULL,
  `s_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `supplied`
--

INSERT INTO `supplied` (`id`, `p_id`, `quantity`, `r_date`, `amount`, `s_id`) VALUES
(8, 1, 4, '2023-06-11', 40, 2),
(9, 2, 53, '2023-06-11', 530, 1),
(10, 1, 3, '2023-06-11', 30, 2),
(11, 1, 7, '2023-06-11', 70, 1),
(12, 1, 7, '2023-06-11', 70, 1),
(13, 1, 9, '2023-06-12', 90, 2),
(14, 3, 50, '2023-06-12', 1000, 3),
(15, 3, 20, '2023-06-12', 400, 3),
(16, 3, 3, '2023-06-12', 60, 3),
(17, 7, 50, '2023-06-13', 4000, 1),
(18, 7, 50, '2023-06-13', 4000, 1),
(19, 5, 10, '2023-06-13', 230, 2),
(20, 9, 50, '2023-06-13', 950, 2);

--
-- Triggers `supplied`
--
DELIMITER $$
CREATE TRIGGER `aval` AFTER INSERT ON `supplied` FOR EACH ROW BEGIN
DECLARE 
	var_avl BIGINT;
    SELECT product.available into var_avl FROM `product` WHERE id = NEW.p_id;
    IF var_avl < 0 THEN 
    	SET var_avl = 0;
    END IF;
	UPDATE `product` SET product.stock_in = product.stock_in + NEW.quantity, 			product.available = var_avl + NEW.quantity WHERE id = NEW.p_id;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `suppliers`
--

CREATE TABLE `suppliers` (
  `id` int(11) NOT NULL,
  `s_name` varchar(100) NOT NULL,
  `address` varchar(225) NOT NULL,
  `phone` bigint(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `suppliers`
--

INSERT INTO `suppliers` (`id`, `s_name`, `address`, `phone`) VALUES
(1, 'supplier 2', 'Titabar Char-ali, Jorhat - 785005\n\n', 9876543218),
(2, 'Supplier 1', 'Gar-Ali, jorhat - 785005', 9987675443),
(3, 'Supplier 3', 'Magistrate Colony, Golaghat -785621', 7896897767);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `invoice`
--
ALTER TABLE `invoice`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `p_id` (`p_id`),
  ADD KEY `c_id` (`c_id`),
  ADD KEY `orders_ibfk_3` (`inv_id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`),
  ADD KEY `a_id` (`a_id`),
  ADD KEY `product_ibfk_1` (`c_id`);

--
-- Indexes for table `supplied`
--
ALTER TABLE `supplied`
  ADD PRIMARY KEY (`id`),
  ADD KEY `p_id` (`p_id`),
  ADD KEY `s_id` (`s_id`);

--
-- Indexes for table `suppliers`
--
ALTER TABLE `suppliers`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `supplied`
--
ALTER TABLE `supplied`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `suppliers`
--
ALTER TABLE `suppliers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`p_id`) REFERENCES `product` (`id`),
  ADD CONSTRAINT `orders_ibfk_2` FOREIGN KEY (`c_id`) REFERENCES `customer` (`id`),
  ADD CONSTRAINT `orders_ibfk_3` FOREIGN KEY (`inv_id`) REFERENCES `invoice` (`id`) ON UPDATE NO ACTION;

--
-- Constraints for table `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `product_ibfk_1` FOREIGN KEY (`c_id`) REFERENCES `categories` (`id`),
  ADD CONSTRAINT `product_ibfk_2` FOREIGN KEY (`a_id`) REFERENCES `admin` (`id`);

--
-- Constraints for table `supplied`
--
ALTER TABLE `supplied`
  ADD CONSTRAINT `supplied_ibfk_1` FOREIGN KEY (`p_id`) REFERENCES `product` (`id`),
  ADD CONSTRAINT `supplied_ibfk_2` FOREIGN KEY (`s_id`) REFERENCES `suppliers` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
