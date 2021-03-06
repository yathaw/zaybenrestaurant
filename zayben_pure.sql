-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Dec 17, 2019 at 06:19 AM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 7.3.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `zayben_pure`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(225) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`) VALUES
(1, 'Appetizer'),
(2, 'Salad'),
(3, 'Soups'),
(4, 'Desserts'),
(5, 'Main Dishes'),
(6, 'One Plate Dishes'),
(8, 'Side Dishes'),
(9, 'Beverages'),
(10, 'Vegetables'),
(11, 'Pizza'),
(12, 'Burger'),
(14, 'Testing One Update'),
(15, 'Testing Update'),
(16, 'Testing Update');

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE `items` (
  `id` int(11) NOT NULL,
  `name` varchar(225) COLLATE utf8_unicode_ci NOT NULL,
  `price` varchar(225) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `photo` text COLLATE utf8_unicode_ci NOT NULL,
  `category_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`id`, `name`, `price`, `description`, `photo`, `category_id`) VALUES
(2, 'Fried Chicken Dumpling', '3000', '<p>Dumpling</p>', 'image/item/appetizer-asian-asian-food-357809.jpg', 1),
(3, 'Baked Honey Bourbon Chicken Wings', '8900', '<p>Chicken Wings</p>', 'image/item/atharva-tulsi-Yh9Ut4d3K0A-unsplash.jpg', 9),
(4, 'Best Deviled Eggs', '3400', '<p>Herbs lend amazing flavor, making these the best deviled eggs you can make!â€”Jesse &amp; Anne Foust, Bluefield, West Virginia</p>', 'image/item/deviled-eggs-861773_1920.jpg', 1),
(5, 'Green Lime Smoothie', '3500', '', 'image/item/smothie1.jpg', 9),
(6, 'Avocado Smoothie', '4500', '', 'image/item/smothie2.jpg', 9),
(7, 'Lime Juice', '2000', '', 'image/item/charity-beth-long-_PaXoN4_2s0-unsplash.jpg', 9),
(8, 'Strawberry Juice', '2200', '', 'image/item/kim-daniels-p6XuDW03YjE-unsplash.jpg', 9),
(9, 'Blueberry Cocktail', '3500', '', 'image/item/cody-chan-ZFM4gN--PZI-unsplash.jpg', 9),
(10, 'Mocha Coffee', '2500', '', 'image/item/shopfour.jpg', 9),
(11, 'Black Coffee', '2300', '', 'image/item/specialfive.jpg', 9),
(12, 'Latte Mocha Coffee', '2300', '', 'image/item/mj-tangonan-CAUgg2lxRk0-unsplash.jpg', 9),
(13, 'Beer', '3500', '', 'image/item/alcoholic-beverages-ale-beer-1267289.jpg', 9),
(14, 'Summer Set', '9800', '', 'image/item/alcoholic-beverage-alcoholic-beverages-bar-2531184.jpg', 9),
(15, 'Beef Burger', '3500', '', 'image/item/amirali-mirhashemian-JqnuWlHmDfE-unsplash.jpg', 12),
(16, 'Cheese Burger', '3500', '', 'image/item/amirali-mirhashemian-pucP6jZSyV4-unsplash.jpg', 9),
(17, 'Burger Set One', '5500', '', 'image/item/sk-CK6tjAIMJWM-unsplash.jpg', 12),
(18, 'White ice cream on brown cookie', '5000', '', 'image/item/kobby-mendez-idTwDKt2j2o-unsplash.jpg', 4),
(19, 'Caramel cake', '2200', '', 'image/item/jennifer-schmidt-gHm50qaMaXc-unsplash.jpg', 4),
(20, 'Lemonade Cake', '1000', '', 'image/item/cake3.jpg', 4),
(21, 'Chocolate Cake', '3500', '', 'image/item/cake1.jpg', 4),
(22, 'Chocolate Iced Glazed With Sprinkles', '500', '', 'image/item/chocolate_iced_glazed_with_sprinkles.jpg', 4),
(23, 'Seafood Deluxe', '19000', '', 'image/item/SeafoodDeluze.jpeg', 11),
(24, 'Steak', '11000', '', 'image/item/steak2.jpg', 5),
(25, 'Pork Chop', '7800', '', 'image/item/raphael-nogueira-ZQuFgfyCifI-unsplash.jpg', 5),
(26, 'Bowl Chicken Rice', '2500', '', 'image/item/bowl-chicken-close-up-674574.jpg', 6),
(27, 'steamed rice and meat dish', '3500', '', 'image/item/dragne-marius-EdzsUFqHbaY-unsplash.jpg', 6),
(28, 'sliced of vegetables with yellow sauce ', '3500', '', 'image/item/louis-hansel-KQR3ENYfrpw-unsplash.jpg', 6),
(29, 'Caprese Salad with Pesto Sauce', '12000', '', 'image/item/salad5.jpg', 2),
(30, 'Caesar Salad', '7400', '', 'image/item/salad6.jpg', 2),
(31, 'Spicy French Fries', '5000', '', 'image/item/blur-close-up-crispy-1893555.jpg', 8),
(32, 'Sweet French Fries', '2000', '', 'image/item/bowl-1842294_1920.jpg', 8),
(33, 'Mashed Potato', '1800', '', 'image/item/mashed-potatoes-439984_1920.jpg', 8),
(34, 'Pumpkin Soup', '2200', '', 'image/item/appetizer-bowl-bread-539451.jpg', 3),
(35, 'Pea Soup', '2100', '', 'image/item/pea-soup-2786133_1920.jpg', 3),
(37, 'Testing Update', '5000', 'asdfasdfasdf', 'image/item/gift-box.png', 3);

-- --------------------------------------------------------

--
-- Table structure for table `orderdetails`
--

CREATE TABLE `orderdetails` (
  `id` int(11) NOT NULL,
  `voucherno` varchar(225) COLLATE utf8_unicode_ci NOT NULL,
  `item_id` int(11) NOT NULL,
  `qty` varchar(225) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `orderdetails`
--

INSERT INTO `orderdetails` (`id`, `voucherno`, `item_id`, `qty`) VALUES
(1, '1573120132707', 35, '1'),
(2, '1573120154984', 35, '1'),
(3, '1573120381642', 35, '1'),
(4, '1573120412948', 35, '1'),
(5, '1573120412948', 32, '1'),
(6, '1573120452512', 35, '1'),
(7, '1573120452512', 32, '1'),
(8, '1573120559414', 35, '1'),
(9, '1573120559414', 32, '1'),
(10, '1573120576795', 35, '1'),
(11, '1573120576795', 32, '1'),
(12, '1573184822366', 31, '1'),
(13, '1573184822366', 33, '1'),
(14, '1576213543346', 14, '1'),
(15, '1576213543346', 30, '1');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `orderdate` date NOT NULL,
  `voucherno` varchar(225) COLLATE utf8_unicode_ci NOT NULL,
  `total` varchar(225) COLLATE utf8_unicode_ci NOT NULL,
  `note` text COLLATE utf8_unicode_ci NOT NULL,
  `user_id` int(11) NOT NULL,
  `status` varchar(225) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `orderdate`, `voucherno`, `total`, `note`, `user_id`, `status`) VALUES
(1, '2019-11-07', '1573120132707', '2100', '', 3, 'Order'),
(2, '2019-11-07', '1573120154984', '2100', 'Testing One', 3, 'Order'),
(3, '2019-11-07', '1573120381642', '2125', '', 3, 'Order'),
(4, '2019-11-07', '1573120412948', '6250', '', 3, 'Order'),
(5, '2019-11-07', '1573120452512', '4150', '', 3, 'Order'),
(6, '2019-11-07', '1573120559414', '4125', '', 3, 'Order'),
(7, '2019-11-07', '1573120576795', '4125', '', 3, 'Order'),
(8, '2019-11-08', '1573184822366', '6825', '', 2, 'Order'),
(9, '2019-12-13', '1576213543346', '17225', '', 2, 'Order');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(225) COLLATE utf8_unicode_ci NOT NULL,
  `role` varchar(225) COLLATE utf8_unicode_ci NOT NULL,
  `profile` varchar(225) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(225) COLLATE utf8_unicode_ci NOT NULL,
  `password` text COLLATE utf8_unicode_ci NOT NULL,
  `phone` varchar(225) COLLATE utf8_unicode_ci NOT NULL,
  `address` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `role`, `profile`, `email`, `password`, `phone`, `address`) VALUES
(1, 'Admin', 'admin', 'image/user/admin.png', 'admin@gmail.com', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', '987654321', 'Yangon'),
(2, 'Flora Brooks', 'member', 'image/user/user.png', 'florabrooks@gmail.com', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', '987654321', 'Yangon'),
(3, 'Ya Thaw', 'member', 'image/user/user.png', 'yathawmyatnoe007@gmail.com', '8cb2237d0679ca88db6464eac60da96345513964', '987654321', 'Yangon'),
(4, 'Admin', 'admin', 'image/user/admin.png', 'admin@gmail.com', '8cb2237d0679ca88db6464eac60da96345513964', '987654321', 'Ygn'),
(5, 'Testing User', 'member', 'image/user/', 'testinguser@gmail.com', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', '987654321', 'Yangon'),
(6, 'Testing User One', 'member', 'image/user/3d-glasses.png', 'testinguserone@gmail.com', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', '987654321', 'Yangon');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orderdetails`
--
ALTER TABLE `orderdetails`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `orderdetails`
--
ALTER TABLE `orderdetails`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
