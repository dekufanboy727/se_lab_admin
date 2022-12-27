-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 27, 2022 at 10:28 PM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `se_lab`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_id` int(100) NOT NULL,
  `username` varchar(50) NOT NULL,
  `pass` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `username`, `pass`, `email`) VALUES
(1, 'admin01', 'admin123', 'admin01@somemail.com');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `category_id` int(11) NOT NULL,
  `name` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`category_id`, `name`) VALUES
(1, 'Pastries'),
(2, 'Beverages'),
(3, 'Desserts');

-- --------------------------------------------------------

--
-- Table structure for table `category_product`
--

CREATE TABLE `category_product` (
  `id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `category_product`
--

INSERT INTO `category_product` (`id`, `category_id`, `product_id`) VALUES
(1, 1, 1),
(2, 1, 2),
(3, 2, 3),
(4, 2, 4),
(5, 3, 5);

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `id` int(20) NOT NULL,
  `name` text NOT NULL,
  `email` text NOT NULL,
  `address` text NOT NULL,
  `password` text NOT NULL,
  `phone` int(15) NOT NULL,
  `payment_method` text NOT NULL,
  `credit_score` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `order_amount` double NOT NULL,
  `order_date` datetime NOT NULL,
  `order_collection` text NOT NULL,
  `pickup_time` datetime DEFAULT NULL,
  `Status` varchar(10) NOT NULL DEFAULT 'preparing'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `order_amount`, `order_date`, `order_collection`, `pickup_time`, `Status`) VALUES
(1, 50.5, '2022-12-13 17:31:47', 'takeaway', '2022-12-13 18:31:47', 'preparing'),
(2, 5, '2022-12-15 00:00:00', 'Pick Up', '2022-12-15 00:00:00', 'cancel');

-- --------------------------------------------------------

--
-- Table structure for table `order_product`
--

CREATE TABLE `order_product` (
  `id` int(100) NOT NULL,
  `order_id` int(100) NOT NULL,
  `product_id` int(100) NOT NULL,
  `quantity` int(100) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `order_product`
--

INSERT INTO `order_product` (`id`, `order_id`, `product_id`, `quantity`) VALUES
(1, 1, 1, 1),
(2, 1, 2, 2),
(3, 1, 3, 2),
(4, 2, 4, 3),
(5, 2, 5, 2);

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `product_id` int(11) NOT NULL,
  `product_name` text NOT NULL,
  `price` float NOT NULL,
  `product_type` int(100) NOT NULL,
  `product_desc` text NOT NULL,
  `product_quan` int(100) NOT NULL,
  `product_cal` int(100) NOT NULL,
  `product_img` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`product_id`, `product_name`, `price`, `product_type`, `product_desc`, `product_quan`, `product_cal`, `product_img`) VALUES
(1, 'Gu Mor Kak', 8.9, 1, '“Gu Mor Kak” or Demon Cow’s Horn Biscuit is a chinese homemade traditional biscuit that is packed with savory rosated chicken fillings, with a thin layered crust wrapped around it. It’s crunchy textute and salty with a hint a sweetness flavour is exactly why Gu Mor Kak is one of our cafe’s signature pastries and best seller. ', 90, 35, ''),
(2, 'Geh Bo Gok Tat', 6.9, 1, 'Homemade Portuguese style egg tart baked with an outer layer of crust, fragant egg fillings and a layer of burnt cheese on top. It’s aromatic, sweet and satly fillings combined with the crusty outer layer is definately a must try. ', 46, 125, 'product_images/Geh_Bo_Gok_Tat.JPG'),
(3, 'Kopi Bancuh', 5, 3, 'Black coffee with sugar and evaporated milk, which is similar to condensed milk, but unsweetened.', 100, 40, ''),
(4, 'Teh Bancuh', 5, 3, 'A popular hot milk tea beverage most commonly found in restaurants, outdoor stalls, mamaks and kopitiams within the Southeast Asian countries of Malaysia, Indonesia, Singapore and Thailand', 100, 40, ''),
(5, 'Oreo Cheesecake', 4.5, 2, 'Served fresh of the fridge with butter and oreo crumps as the base, special homemade cream cheese and milk recipe as the middle layer and top it off with oreo poweder sprinkles and a piece of oreo biscuit. Oreo lovers what are you waiting for? Try it now.', 60, 562, ''),
(7, 'cup', 3, 3, '3', 3, 3, 'product_images/cappuccino.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `product_type`
--

CREATE TABLE `product_type` (
  `id` int(100) NOT NULL,
  `type_name` varchar(100) NOT NULL,
  `type_desc` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product_type`
--

INSERT INTO `product_type` (`id`, `type_name`, `type_desc`) VALUES
(1, 'pastry', 'Stiff dough made from flour, salt, a relatively high proportion of fat, and a small proportion of liquid.'),
(2, 'dessert', 'A usually sweet course or dish (as of pastry or ice cream) usually served at the end of a meal.'),
(3, 'drinks', 'A liquid intended for human consumption.');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `category_product`
--
ALTER TABLE `category_product`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `order_product`
--
ALTER TABLE `order_product`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `product_type`
--
ALTER TABLE `product_type`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `category_product`
--
ALTER TABLE `category_product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
