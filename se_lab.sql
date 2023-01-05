-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 05, 2023 at 05:17 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.0.13

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
  `email` varchar(50) NOT NULL,
  `phone_num` varchar(50) NOT NULL,
  `address` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `username`, `pass`, `email`, `phone_num`, `address`) VALUES
(1, 'admin01', 'admin123', 'admin01@somemail.com', '+60100000001', 'AAAA land'),
(2, 'admin02', 'admin234', 'admin02@somemail.com', '+60100000002', 'BBBB land'),
(3, 'admin03', 'admin345', 'admin03@somemail.com', '+60100000003', 'CCCC land');

-- --------------------------------------------------------

--
-- Table structure for table `cart_temp`
--

CREATE TABLE `cart_temp` (
  `cart_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `product_name` text NOT NULL,
  `price` float NOT NULL,
  `quantity` int(100) NOT NULL,
  `total_price` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cart_temp`
--

INSERT INTO `cart_temp` (`cart_id`, `product_id`, `product_name`, `price`, `quantity`, `total_price`) VALUES
(1, 1, 'Gu Mor Kak', 4.9, 1, 5),
(4, 7, 'Peanut Ice Cream', 4.7, 1, 5),
(5, 7, 'Peanut Ice Cream', 4.7, 1, 5),
(6, 1, 'Gu Mor Kak', 4.9, 1, 5);

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

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`id`, `name`, `email`, `address`, `password`, `phone`, `payment_method`, `credit_score`) VALUES
(1, 'Derrick Koay Jia Yung', 'koayjyderrick@gmail.com', '31 Lakeside', 'blackwinds', 1133030519, '', 0),
(4, 'Neoh Jin Ming', 'neohjinming@yahoo.com', 'Block 99, Jalan Bukit Kukus, Paya Terubong', 'lol123', 129858775, '', 0),
(5, 'Neoh Jin Ming', 'neohjinming1@yahoo.com', 'Block 99, Jalan Bukit Kukus, Paya Terubong', 'lol123', 129858775, '', 0),
(6, 'Neoh Jin Ming', 'neohjinming2@yahoo.com', 'Block 99, Jalan Bukit Kukus, Paya Terubong', 'lol123', 129858775, '', 0),
(7, 'Neoh Jin Ming', 'neohjinming3@yahoo.com', 'Block 99, Jalan Bukit Kukus, Paya Terubong', 'lol123', 129858775, '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `id` int(100) NOT NULL,
  `event_name` text NOT NULL,
  `event_date` varchar(200) NOT NULL,
  `event_time` varchar(200) NOT NULL,
  `event_location` varchar(200) NOT NULL,
  `description` text NOT NULL,
  `event_link` varchar(200) NOT NULL,
  `event_img` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`id`, `event_name`, `event_date`, `event_time`, `event_location`, `description`, `event_link`, `event_img`) VALUES
(1, 'Aespa 2nd Anniversary Event\r\n', '13th November 2022\r\n', '1:30pm - 5:00pm', 'Helf Coffee, Georgetown, Penang', '“Calling all Aespa fans in Penang: Aespa 2nd Anniversary is happening soon. Join us as we will have a celebration for them!”\r\n\r\n', 'https://www.facebook.com/helf.coffee/posts/pfbid0zPN8E2TQ873aZ2kQjjttzCdBKgWhNZt2H3rc2vG9KVqkc6Dw14M5Fy66Y1AYDZFml', '../event_images/aespa_event.png'),
(2, 'Gong Jun 1129 Birthday Event\r\n', '26th November 2022 - 2nd December 2022\r\n', '10:00am - 5:00pm\r\n', 'Helf Coffee, Georgetown, Penang\r\n', '“Calling all GongJun fans in Penang: Helf Coffee is celebrating his 30th Birthday CS Event in collaboration with lld_eventmy. With purchase above RM15, you can get luxurious freebies set”\r\n\r\n', 'https://www.facebook.com/helf.coffee/posts/pfbid02HcCZvPd39kU5gfbV9GXYGm45HgwPHfSnSDt4aSeL9S6gG7Qmfmxmjq3DED1QTP2Ul', '../event_images/gongjun_event.png'),
(3, 'NCTzens Special Support Event', '30th November 2023 & 3rd December 2023', '20 minutes before entering the cinema\n', 'GSC Cinema Gurney Plaza, Penang', '“Calling all NCTzens who are going for NCT DREAM THE MOVIE, we are giving out LIMITED FREEBIES”\r\n\r\n', 'https://www.facebook.com/helf.coffee/posts/pfbid02a7kjncn4w8UviGnjHJx15M8iQDrVapyRaaD57tYGJCtQBwuvscE6g2imnWJRp7ntl', '../event_images/nct_event.png'),
(4, 'SM Idol Screening Event 2023', '1st January 2023', '11:30am - 4:30pm\r\n', 'Helf Coffee, Georgetown, Penang', '“Calling all SM Idol’s fans, we will have an offline screening event for 2023 SMTOWN Live: SMCU Palace @ Kwangya!”', 'https://www.facebook.com/helf.coffee/posts/pfbid02is31Umt7NRWGDAMSyg3u4VAoyRA5xsKiqEpdy9BNcX6iBQKjCkcytpTvEZonixi4l', '../event_images/sm_event.png');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `customer_id` int(10) NOT NULL,
  `order_amount` double NOT NULL,
  `order_date` datetime NOT NULL,
  `order_collection` text NOT NULL,
  `pickup_time` datetime DEFAULT NULL,
  `Status` varchar(10) NOT NULL DEFAULT 'preparing'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
  `best_seller` tinyint(1) NOT NULL,
  `product_img` varchar(100) NOT NULL,
  `pixel` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`product_id`, `product_name`, `price`, `product_type`, `product_desc`, `product_quan`, `product_cal`, `best_seller`, `product_img`, `pixel`) VALUES
(1, 'Gu Mor Kak', 4.5, 1, '“Gu Mor Kak” or Demon Cow’s Horn Biscuit is a chinese homemade traditional biscuit that is packed with savory rosated chicken fillings, with a thin layered crust wrapped around it. It’s crunchy textute and salty with a hint a sweetness flavour is exactly why Gu Mor Kak is one of our cafe’s signature pastries and best seller. ', 90, 35, 1, '../product_images/Gu_Mor_Kak.JPG\r\n', 220),
(2, 'Geh Bo Gok Tat', 6.9, 1, 'A brand new and exciting combination of tart meets curry chicken, finished with a topping of cheese.', 46, 125, 0, '../product_images/Geh_Bo_Gok_Tat.JPG', 150),
(3, 'Kopi Bancuh', 5.5, 3, 'Black coffee with sugar and evaporated milk, which is similar to condensed milk, but unsweetened.', 100, 40, 1, '../product_images/kopi_bancuh.JPG', 120),
(4, 'Teh Bancuh', 5.5, 3, 'A popular hot milk tea beverage most commonly found in restaurants, outdoor stalls, mamaks and kopitiams within the Southeast Asian countries of Malaysia, Indonesia, Singapore and Thailand', 100, 40, 0, '../product_images/teh_bancuh.JPG', 175),
(5, 'Oreo Cheesecake', 13, 2, 'Served fresh of the fridge with butter and oreo crumps as the base, special homemade cream cheese and milk recipe as the middle layer and top it off with oreo poweder sprinkles and a piece of oreo biscuit. Oreo lovers what are you waiting for? Try it now.', 60, 562, 1, '../product_images/Oreo_Cheesecake.JPG', 154),
(6, 'Portugese Tart', 3.3, 1, 'Homemade Portuguese style egg tart baked with an outer layer of crust, fragant egg fillings and a layer of burnt cheese on top. It’s aromatic, sweet and satly fillings combined with the crusty outer layer is definately a must try.', 100, 500, 0, '../product_images/portuguese_tart.JPG', 150),
(7, 'Peanut Ice Cream', 4.3, 2, 'Wondrously smooth Peanut Ice Cream and with a distinctly sweet, nutty flavour,', 65, 265, 1, '../product_images/peanut_ice_cream.JPG', 160),
(8, 'Pandan Portuguese Tart', 3.3, 1, 'These pandan-flavored Portuguese egg tart are extremely crispy and has a lovely pandan fragrance, guaranteed to be enjoyed by everyone.', 75, 110, 0, '../product_images/Pandan_Portuguese_Tart.JPG', 154),
(9, 'Longan Soya Pudding', 4.5, 2, 'This nutritious dessert is made from plant milk (soya milk), fruit (longan) and natural flavouring (pandan). It is not too sweet, while being smooth like tau foo far.\r\n\r\n', 30, 240, 0, '../product_images/longan_soya_pudding.JPG', 150),
(10, 'Oreo Ice Cream', 4.3, 2, 'This ice cream may look like plain chocolate, but it\'s not—it\'s a super concentrated version of cookies \'n\' cream. Its rich flavor and color come from crushed Oreo wafers, with a handful of crushed sandwich cookies folded in at the end. ', 35, 361, 0, '../product_images/oreo_ice_cream.JPG', 160),
(11, 'Matcha Ice Cream', 5.3, 2, 'Earthy and sweet Matcha Ice Cream is the perfect refreshing treat on a hot day. With a deep intensity and rich texture, this green tea ice cream brings to you a taste of Japan.', 40, 530, 1, '../product_images/matcha_ice_cream.JPG', 160),
(12, 'Cappuccino', 6.9, 3, 'A freshly pulled shot of espresso layered with steamed whole milk and thick rich foam to offer a luxurious velvety texture and complex aroma.\r\n', 50, 80, 0, '../product_images/cappuccino.JPG', 10),
(13, 'Coco', 6.9, 3, 'Steamed milk with vanilla- and chocolate-flavored syrups. Topped with sweetened whipped cream and chocolate-flavored drizzle. A timeless classic made to sweeten your spirits.', 50, 77, 1, '../product_images/coco.JPG', 195),
(14, 'Hazelnut', 6.9, 3, 'Our Hazelnut Coffee is an earthy, full-bodied blend that lets the intense aroma shine through.\r\n\r\n', 50, 87, 0, '../product_images/hazelnut.JPG', 85),
(15, 'Latte', 6.9, 3, 'Milk coffee that is a made up of one or two shots of espresso, steamed milk and a final, thin layer of frothed milk on top.', 50, 189, 0, '../product_images/latte.JPG', 105),
(16, 'Mocha', 6.9, 3, 'Our rich, full-bodied espresso combined with bittersweet mocha sauce and steamed milk, then topped with sweetened whipped cream.', 50, 371, 0, '../product_images/mocha.JPG', 200),
(17, 'Tiramisu', 6.9, 3, 'Tiramisù is a velvety mélange of savoiardi cookies dipped in an espresso, layered with delicately sweetened whipped eggs and mascarpone cheese, and topped with a dusting of cocoa powder.', 50, 345, 0, '../product_images/tiramisu.JPG', 60),
(18, 'Tea Time Set', 38.8, 4, 'This delectable, dainty meal, often referred to as \"high tea\", is the perfect set menu for a small party.', 20, 1000, 0, '../product_images/tea_time_set.png', 95);

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
(3, 'drinks', 'A liquid intended for human consumption.'),
(4, 'set', 'This delectable, dainty meal, often referred to as \"high tea\", is the perfect set menu for a small party');

-- --------------------------------------------------------

--
-- Table structure for table `transaction`
--

CREATE TABLE `transaction` (
  `trans_id` int(100) NOT NULL,
  `order_id` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `cart_temp`
--
ALTER TABLE `cart_temp`
  ADD PRIMARY KEY (`cart_id`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `fk` (`customer_id`);

--
-- Indexes for table `order_product`
--
ALTER TABLE `order_product`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`product_id`),
  ADD KEY `product_type` (`product_type`);

--
-- Indexes for table `product_type`
--
ALTER TABLE `product_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transaction`
--
ALTER TABLE `transaction`
  ADD PRIMARY KEY (`trans_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cart_temp`
--
ALTER TABLE `cart_temp`
  MODIFY `cart_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `fk` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`id`);

--
-- Constraints for table `order_product`
--
ALTER TABLE `order_product`
  ADD CONSTRAINT `order_id` FOREIGN KEY (`order_id`) REFERENCES `orders` (`order_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `product_id` FOREIGN KEY (`product_id`) REFERENCES `product` (`product_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `product_type` FOREIGN KEY (`product_type`) REFERENCES `product_type` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
