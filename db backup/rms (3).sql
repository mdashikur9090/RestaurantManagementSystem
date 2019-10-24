-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 24, 2019 at 04:10 AM
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
-- Database: `rms`
--

-- --------------------------------------------------------

--
-- Table structure for table `carts`
--

CREATE TABLE `carts` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `food_id` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `foods`
--

CREATE TABLE `foods` (
  `id` int(10) UNSIGNED NOT NULL,
  `food_type_id` int(11) NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` int(11) NOT NULL,
  `serve` int(11) NOT NULL,
  `chef` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cooking_hours` int(11) NOT NULL,
  `calories` int(11) NOT NULL,
  `total_vote` int(11) NOT NULL,
  `total_rating_point` int(11) NOT NULL,
  `visible_status` tinyint(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `foods`
--

INSERT INTO `foods` (`id`, `food_type_id`, `name`, `description`, `price`, `serve`, `chef`, `cooking_hours`, `calories`, `total_vote`, `total_rating_point`, `visible_status`) VALUES
(1, 2, 'Pizza Capricaso', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit et. Aenean commodo ligula eg dolor. Aenean massa. Cum soci nat oque penatibus magnis dis parturient monte nascet urid icul us mus. Donec quam felis, ultricies nec. Sectetuer adipising eli. Aenean commodo eg cos dolor en an massa. Cum sociis natoq penat us magnis dis parturient montes, nascet ridiculu mus. Dolor sit amet consectetuer adipiscn elit commodo ligua la eget dolor. Aenean etsa massa Cum sociis natoque et penat us magnis dis.\r\n\r\n\r\n\r\n', 150, 2, 'SERENA DOE', 30, 200, 6, 26, 1),
(2, 1, 'PATRON CHICKEN BURGER', 'Lorem ipsum dolor sit amet, sectetuera con adipiscing elitan. Lorem ipsum dolor sit amet, sectetuera con adipiscing elitan.', 220, 1, 'ashik mridha', 10, 200, 6, 28, 1),
(3, 6, 'Thumb Special Cashew Nut Salad', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', 350, 2, 'Amin Hossain', 20, 100, 2, 10, 1),
(4, 6, 'Normal Cashew Nut Salad', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', 250, 2, 'Jakir Hossain', 15, 80, 0, 0, 1),
(5, 8, 'Special  Chicken This Soup', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', 360, 4, 'Mehedi Hasan', 30, 500, 0, 0, 1),
(6, 8, 'Chicken Corn Soup', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', 250, 2, 'Mehedi Hasan', 25, 400, 0, 0, 1),
(7, 2, '5 ince Beef Pizza with Cheese', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', 500, 3, 'Junayed Ahmed', 30, 450, 0, 0, 1),
(8, 2, '8 ince Beef Pizza', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', 450, 4, 'Amin Hossain', 30, 100, 0, 0, 1),
(13, 3, 'Pepsi 250mg', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', 20, 1, 'None', 0, 80, 0, 0, 1),
(14, 3, 'Sprite 250mg', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', 20, 1, 'None', 0, 80, 0, 0, 1),
(15, 4, 'Mango Juice', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', 150, 1, 'Amin Hoosain', 5, 150, 0, 0, 1),
(16, 5, 'NO-BAKE CHEESECAKE', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', 320, 2, 'Junayed', 15, 350, 0, 0, 1),
(17, 7, 'Special beef chow mein', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', 240, 2, 'Mehedi Hasan', 20, 350, 0, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `food_comments`
--

CREATE TABLE `food_comments` (
  `id` int(10) UNSIGNED NOT NULL,
  `food_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `comment` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `food_images`
--

CREATE TABLE `food_images` (
  `food_id` int(11) NOT NULL,
  `img_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `food_images`
--

INSERT INTO `food_images` (`food_id`, `img_name`) VALUES
(1, 'img5c496d49744b4.jpg'),
(1, 'img5c496d49744b5.jpg'),
(1, 'img5c496d49744b6.jpg'),
(1, 'img5c496d49744b7.jpg'),
(2, 'img5c4a07520d1ea.jpg'),
(2, 'img5c4a07520d1eb.jpg'),
(2, 'img5c4a07520d1ec.jpg'),
(2, 'img5c4a07520d1ed.jpg'),
(3, 'img5cb6d7e6a8a8a.jpg'),
(3, 'img5cb6d7e6ceb4e.png'),
(3, 'img5cb6d7e6d052c.jpg'),
(3, 'img5cb6d7e6d348d.jpg'),
(4, 'img5cb6d96c6fb8c.png'),
(4, 'img5cb6d96c731b3.png'),
(4, 'img5cb6d96c762ca.png'),
(4, 'img5cb6d96c77d2a.jpg'),
(5, 'img5cb6db657d914.jpg'),
(5, 'img5cb6db6584afb.jpg'),
(5, 'img5cb6db6587bb8.jpeg'),
(5, 'img5cb6db658aa4e.jpg'),
(6, 'img5cb6dd09d46b1.jpg'),
(6, 'img5cb6dd09db49a.jpeg'),
(6, 'img5cb6dd09df2c4.jpg'),
(6, 'img5cb6dd09e4348.jpg'),
(7, 'img5cb6e224d5dad.jpg'),
(7, 'img5cb6e224dbb9a.jpg'),
(7, 'img5cb6e224de714.jpg'),
(7, 'img5cb6e224e17be.jpg'),
(8, 'img5cb6e3ba13286.jpg'),
(8, 'img5cb6e3ba188c8.jpg'),
(8, 'img5cb6e3ba1b593.jpg'),
(8, 'img5cb6e3ba1e1ac.jpg'),
(13, 'img5cb6e81a75c71.jpg'),
(13, 'img5cb6e81a7a87d.jpg'),
(14, 'img5cb6e8caa41a8.png'),
(14, 'img5cb6e8caa7d50.jpg'),
(15, 'img5cb6ea08f3be8.jpg'),
(15, 'img5cb6ea0907dfd.jpg'),
(15, 'img5cb6ea090af40.jpg'),
(16, 'img5cb6eb893cb36.jpg'),
(16, 'img5cb6eb89413e4.jpg'),
(16, 'img5cb6eb89456c0.jpg'),
(17, 'img5cb6eda520509.jpg'),
(17, 'img5cb6eda5253e1.jpg'),
(17, 'img5cb6eda52a3aa.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `food_ingridients`
--

CREATE TABLE `food_ingridients` (
  `food_id` int(11) NOT NULL,
  `ingridient_id` int(11) NOT NULL,
  `qty` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `food_ingridients`
--

INSERT INTO `food_ingridients` (`food_id`, `ingridient_id`, `qty`) VALUES
(1, 1, 5),
(1, 2, 50),
(1, 3, 100),
(2, 2, 25),
(2, 1, 5),
(2, 3, 50),
(3, 11, 50),
(3, 12, 100),
(3, 10, 50),
(3, 1, 2),
(4, 11, 100),
(4, 12, 100),
(4, 1, 2),
(4, 10, 50),
(5, 2, 200),
(5, 5, 2),
(5, 16, 5),
(5, 6, 20),
(5, 14, 2),
(6, 2, 150),
(6, 4, 50),
(6, 16, 2),
(6, 1, 5),
(6, 15, 5),
(7, 3, 200),
(7, 16, 20),
(7, 16, 20),
(7, 1, 5),
(7, 8, 50),
(7, 17, 50),
(8, 3, 350),
(8, 4, 200),
(8, 17, 100),
(8, 5, 5),
(8, 8, 100),
(8, 14, 50),
(8, 15, 5),
(8, 9, 5),
(13, 18, 1),
(14, 19, 20),
(15, 20, 200),
(15, 21, 100),
(16, 5, 5),
(16, 4, 50),
(16, 8, 150),
(17, 3, 100),
(17, 8, 100),
(17, 1, 5),
(17, 13, 50);

-- --------------------------------------------------------

--
-- Table structure for table `food_types`
--

CREATE TABLE `food_types` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `food_types`
--

INSERT INTO `food_types` (`id`, `name`) VALUES
(1, 'Berger'),
(2, 'Pizza'),
(3, 'Drinks'),
(4, 'Juice'),
(5, 'Desert'),
(6, 'Salads'),
(7, 'Chowmein'),
(8, 'Soup'),
(10, 'Thai & Chinese Fried Rice');

-- --------------------------------------------------------

--
-- Table structure for table `ingridients`
--

CREATE TABLE `ingridients` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `measure_as` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `stock` decimal(8,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ingridients`
--

INSERT INTO `ingridients` (`id`, `name`, `measure_as`, `stock`) VALUES
(1, 'Salt', 'Teaspoons', '393.00'),
(2, 'Chicken', 'Piece', '9050.00'),
(3, 'Beef', 'Gram', '8400.00'),
(4, 'Butter', 'Gram', '200.00'),
(5, 'Egg', 'Piece', '85.00'),
(6, 'Minced Onion', 'Gram', '500.00'),
(7, 'Burger mix', 'Gram', '500.00'),
(8, 'Flour', 'Gram', '9250.00'),
(9, 'Hearts romaine lettuce', 'Gram', '1000.00'),
(10, 'Tomatoes', 'Gram', '1700.00'),
(11, 'Carrot', 'Gram', '1600.00'),
(12, 'Cucumber', 'Gram', '1500.00'),
(13, 'Olive oil', 'Cups', '1000.00'),
(15, 'Tomato sauce', 'Tablespoons', '85.00'),
(16, 'Chili sauce', 'Tablespoons', '14.00'),
(17, 'Cheese', 'Gram', '900.00'),
(18, 'Pepsi 250mg', 'Piece', '18.00'),
(19, 'Sprite 250mg', 'Piece', '25.00'),
(20, 'Mango', 'Gram', '500.00'),
(21, 'Sugar', 'Gram', '900.00');

-- --------------------------------------------------------

--
-- Table structure for table `ingridient_logs`
--

CREATE TABLE `ingridient_logs` (
  `id` int(10) UNSIGNED NOT NULL,
  `ingridient_id` int(11) NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount` decimal(8,2) NOT NULL,
  `net_amount` decimal(8,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ingridient_logs`
--

INSERT INTO `ingridient_logs` (`id`, `ingridient_id`, `name`, `type`, `amount`, `net_amount`, `created_at`, `updated_at`) VALUES
(1, 1, 'Stock Low', 'Debit', '500.00', '500.00', '2019-03-17 08:52:32', '2019-03-17 08:52:32'),
(2, 2, 'Stock Low', 'Debit', '10000.00', '10000.00', '2019-03-01 08:58:49', '2019-03-01 08:58:49'),
(3, 3, 'Stock Low', 'Debit', '10000.00', '10000.00', '2019-03-01 08:59:02', '2019-03-01 08:59:02'),
(4, 4, 'Stock Low', 'Debit', '500.00', '500.00', '2019-03-01 08:59:16', '2019-03-01 08:59:16'),
(5, 6, 'Stock Low', 'Debit', '500.00', '500.00', '2019-03-01 08:59:42', '2019-03-01 08:59:42'),
(6, 5, 'Stock Low', 'Debit', '100.00', '100.00', '2019-03-01 09:00:19', '2019-03-01 09:00:19'),
(7, 7, 'Stock Low', 'Debit', '500.00', '500.00', '2019-03-01 09:00:38', '2019-03-01 09:00:38'),
(8, 8, 'Stock Low', 'Debit', '10000.00', '10000.00', '2019-03-01 09:01:13', '2019-03-01 09:01:13'),
(9, 9, 'Stock Low', 'Debit', '1000.00', '1000.00', '2019-03-01 09:01:33', '2019-03-01 09:01:33'),
(10, 10, 'Stock Low', 'Debit', '2000.00', '2000.00', '2019-03-01 09:01:48', '2019-03-01 09:01:48'),
(11, 11, 'Stock Low', 'Debit', '2000.00', '2000.00', '2019-03-01 09:02:03', '2019-03-01 09:02:03'),
(12, 12, 'Stock Low', 'Debit', '100.00', '100.00', '2019-03-01 09:16:05', '2019-03-01 09:16:05'),
(13, 13, 'Stock Low', 'Debit', '100.00', '100.00', '2019-03-01 09:16:16', '2019-03-01 09:16:16'),
(14, 15, 'Stock Low', 'Debit', '100.00', '100.00', '2019-03-01 09:16:32', '2019-03-01 09:16:32'),
(15, 16, 'Stock Low', 'Debit', '100.00', '100.00', '2019-03-01 09:17:01', '2019-03-01 09:17:01'),
(16, 17, 'Stock Low', 'Debit', '1000.00', '1000.00', '2019-03-01 09:17:16', '2019-03-01 09:17:16'),
(17, 18, 'Stock Low', 'Debit', '20.00', '20.00', '2019-03-01 09:17:33', '2019-03-01 09:17:33'),
(18, 19, 'Stock Low', 'Debit', '25.00', '25.00', '2019-03-01 09:17:47', '2019-03-01 09:17:47'),
(19, 20, 'Stock Low', 'Debit', '100.00', '100.00', '2019-03-01 09:17:58', '2019-03-01 09:17:58'),
(20, 21, 'Stock Low', 'Debit', '200.00', '200.00', '2019-03-01 09:18:36', '2019-03-01 09:18:36'),
(21, 1, 'Pizza Capricaso 5 * 2 sell', 'Credit', '10.00', '490.00', '2019-03-01 09:52:33', '2019-03-01 09:52:33'),
(22, 2, 'Pizza Capricaso 50 * 2 sell', 'Credit', '100.00', '9900.00', '2019-03-01 09:52:33', '2019-03-01 09:52:33'),
(23, 3, 'Pizza Capricaso 100 * 2 sell', 'Credit', '200.00', '9800.00', '2019-03-01 09:52:33', '2019-03-01 09:52:33'),
(24, 11, 'Thumb Special Cashew Nut Salad 50 * 1 sell', 'Credit', '50.00', '1950.00', '2019-03-01 09:52:33', '2019-03-01 09:52:33'),
(25, 12, 'Thumb Special Cashew Nut Salad 100 * 1 sell', 'Credit', '100.00', '0.00', '2019-03-01 09:52:33', '2019-03-01 09:52:33'),
(26, 10, 'Thumb Special Cashew Nut Salad 50 * 1 sell', 'Credit', '50.00', '1950.00', '2019-03-01 09:52:33', '2019-03-01 09:52:33'),
(27, 1, 'Thumb Special Cashew Nut Salad 2 * 1 sell', 'Credit', '2.00', '488.00', '2019-03-01 09:52:33', '2019-03-01 09:52:33'),
(28, 3, '5\" Beef Pizza with Cheese 200 * 1 sell', 'Credit', '200.00', '9600.00', '2019-03-03 09:53:14', '2019-03-03 09:53:14'),
(29, 16, '5\" Beef Pizza with Cheese 20 * 1 sell', 'Credit', '20.00', '80.00', '2019-03-03 09:53:14', '2019-03-03 09:53:14'),
(30, 16, '5\" Beef Pizza with Cheese 20 * 1 sell', 'Credit', '20.00', '60.00', '2019-03-03 09:53:14', '2019-03-03 09:53:14'),
(31, 1, '5\" Beef Pizza with Cheese 5 * 1 sell', 'Credit', '5.00', '483.00', '2019-03-03 09:53:14', '2019-03-03 09:53:14'),
(32, 8, '5\" Beef Pizza with Cheese 50 * 1 sell', 'Credit', '50.00', '9950.00', '2019-03-03 09:53:14', '2019-03-03 09:53:14'),
(33, 17, '5\" Beef Pizza with Cheese 50 * 1 sell', 'Credit', '50.00', '950.00', '2019-03-03 09:53:14', '2019-03-03 09:53:14'),
(34, 20, 'Stock Low', 'Debit', '1000.00', '1100.00', '2019-03-06 09:56:00', '2019-03-06 09:56:00'),
(35, 20, 'Mango Juice 200 * 2 sell', 'Credit', '400.00', '700.00', '2019-03-06 09:56:07', '2019-03-06 09:56:07'),
(36, 21, 'Mango Juice 100 * 2 sell', 'Credit', '200.00', '0.00', '2019-03-06 09:56:07', '2019-03-06 09:56:07'),
(37, 5, 'NO-BAKE CHEESECAKE 5 * 1 sell', 'Credit', '5.00', '95.00', '2019-03-11 11:37:21', '2019-03-11 11:37:21'),
(38, 4, 'NO-BAKE CHEESECAKE 50 * 1 sell', 'Credit', '50.00', '450.00', '2019-03-11 11:37:21', '2019-03-11 11:37:21'),
(39, 8, 'NO-BAKE CHEESECAKE 150 * 1 sell', 'Credit', '150.00', '9800.00', '2019-03-11 11:37:21', '2019-03-11 11:37:21'),
(40, 3, 'Special beef chow mein 100 * 2 sell', 'Credit', '200.00', '9400.00', '2019-03-16 11:38:23', '2019-03-16 11:38:23'),
(41, 8, 'Special beef chow mein 100 * 2 sell', 'Credit', '200.00', '9600.00', '2019-03-16 11:38:23', '2019-03-16 11:38:23'),
(42, 1, 'Special beef chow mein 5 * 2 sell', 'Credit', '10.00', '473.00', '2019-03-16 11:38:23', '2019-03-16 11:38:23'),
(43, 13, 'Special beef chow mein 50 * 2 sell', 'Credit', '100.00', '0.00', '2019-03-16 11:38:23', '2019-03-16 11:38:23'),
(44, 13, 'Stock Low', 'Debit', '1000.00', '1000.00', '2019-03-22 11:43:16', '2019-03-22 11:43:16'),
(45, 12, 'Stock Low', 'Debit', '2000.00', '2000.00', '2019-03-22 11:44:07', '2019-03-22 11:44:07'),
(46, 11, 'Normal Cashew Nut Salad 100 * 1 sell', 'Credit', '100.00', '1850.00', '2019-03-22 11:44:15', '2019-03-22 11:44:15'),
(47, 12, 'Normal Cashew Nut Salad 100 * 1 sell', 'Credit', '100.00', '1900.00', '2019-03-22 11:44:15', '2019-03-22 11:44:15'),
(48, 1, 'Normal Cashew Nut Salad 2 * 1 sell', 'Credit', '2.00', '471.00', '2019-03-22 11:44:15', '2019-03-22 11:44:15'),
(49, 10, 'Normal Cashew Nut Salad 50 * 1 sell', 'Credit', '50.00', '1900.00', '2019-03-22 11:44:15', '2019-03-22 11:44:15'),
(50, 2, 'Chicken Corn Soup 150 * 2 sell', 'Credit', '300.00', '9600.00', '2019-03-29 11:45:03', '2019-03-29 11:45:03'),
(51, 4, 'Chicken Corn Soup 50 * 2 sell', 'Credit', '100.00', '350.00', '2019-03-29 11:45:03', '2019-03-29 11:45:03'),
(52, 16, 'Chicken Corn Soup 2 * 2 sell', 'Credit', '4.00', '56.00', '2019-03-29 11:45:03', '2019-03-29 11:45:03'),
(53, 1, 'Chicken Corn Soup 5 * 2 sell', 'Credit', '10.00', '461.00', '2019-03-29 11:45:03', '2019-03-29 11:45:03'),
(54, 15, 'Chicken Corn Soup 5 * 2 sell', 'Credit', '10.00', '90.00', '2019-03-29 11:45:03', '2019-03-29 11:45:03'),
(55, 2, 'PATRON CHICKEN BURGER 25 * 1 sell', 'Credit', '25.00', '9575.00', '2019-04-08 11:46:04', '2019-04-08 11:46:04'),
(56, 1, 'PATRON CHICKEN BURGER 5 * 1 sell', 'Credit', '5.00', '456.00', '2019-04-08 11:46:04', '2019-04-08 11:46:04'),
(57, 3, 'PATRON CHICKEN BURGER 50 * 1 sell', 'Credit', '50.00', '9350.00', '2019-04-08 11:46:04', '2019-04-08 11:46:04'),
(58, 11, 'Thumb Special Cashew Nut Salad 50 * 1 sell', 'Credit', '50.00', '1800.00', '2019-04-13 11:46:46', '2019-04-13 11:46:46'),
(59, 12, 'Thumb Special Cashew Nut Salad 100 * 1 sell', 'Credit', '100.00', '1800.00', '2019-04-13 11:46:46', '2019-04-13 11:46:46'),
(60, 10, 'Thumb Special Cashew Nut Salad 50 * 1 sell', 'Credit', '50.00', '1850.00', '2019-04-13 11:46:46', '2019-04-13 11:46:46'),
(61, 1, 'Thumb Special Cashew Nut Salad 2 * 1 sell', 'Credit', '2.00', '454.00', '2019-04-13 11:46:46', '2019-04-13 11:46:46'),
(62, 5, 'NO-BAKE CHEESECAKE 5 * 1 sell', 'Credit', '5.00', '90.00', '2019-04-13 11:46:46', '2019-04-13 11:46:46'),
(63, 4, 'NO-BAKE CHEESECAKE 50 * 1 sell', 'Credit', '50.00', '300.00', '2019-04-13 11:46:46', '2019-04-13 11:46:46'),
(64, 8, 'NO-BAKE CHEESECAKE 150 * 1 sell', 'Credit', '150.00', '9450.00', '2019-04-13 11:46:46', '2019-04-13 11:46:46'),
(65, 3, '5 ince Beef Pizza with Cheese 200 * 1 sell', 'Credit', '200.00', '9150.00', '2019-04-20 11:47:48', '2019-04-20 11:47:48'),
(66, 16, '5 ince Beef Pizza with Cheese 20 * 1 sell', 'Credit', '20.00', '36.00', '2019-04-20 11:47:48', '2019-04-20 11:47:48'),
(67, 16, '5 ince Beef Pizza with Cheese 20 * 1 sell', 'Credit', '20.00', '16.00', '2019-04-20 11:47:48', '2019-04-20 11:47:48'),
(68, 1, '5 ince Beef Pizza with Cheese 5 * 1 sell', 'Credit', '5.00', '449.00', '2019-04-20 11:47:49', '2019-04-20 11:47:49'),
(69, 8, '5 ince Beef Pizza with Cheese 50 * 1 sell', 'Credit', '50.00', '9400.00', '2019-04-20 11:47:49', '2019-04-20 11:47:49'),
(70, 17, '5 ince Beef Pizza with Cheese 50 * 1 sell', 'Credit', '50.00', '900.00', '2019-04-20 11:47:49', '2019-04-20 11:47:49'),
(71, 1, 'Pizza Capricaso 5 * 2 sell', 'Credit', '10.00', '439.00', '2019-03-09 11:50:10', '2019-03-09 11:50:10'),
(72, 2, 'Pizza Capricaso 50 * 2 sell', 'Credit', '100.00', '9475.00', '2019-03-09 11:50:10', '2019-03-09 11:50:10'),
(73, 3, 'Pizza Capricaso 100 * 2 sell', 'Credit', '200.00', '8950.00', '2019-03-09 11:50:10', '2019-03-09 11:50:10'),
(74, 11, 'Normal Cashew Nut Salad 100 * 1 sell', 'Credit', '100.00', '1700.00', '2019-04-03 11:53:37', '2019-04-03 11:53:37'),
(75, 12, 'Normal Cashew Nut Salad 100 * 1 sell', 'Credit', '100.00', '1700.00', '2019-04-03 11:53:37', '2019-04-03 11:53:37'),
(76, 1, 'Normal Cashew Nut Salad 2 * 1 sell', 'Credit', '2.00', '437.00', '2019-04-03 11:53:37', '2019-04-03 11:53:37'),
(77, 10, 'Normal Cashew Nut Salad 50 * 1 sell', 'Credit', '50.00', '1800.00', '2019-04-03 11:53:37', '2019-04-03 11:53:37'),
(78, 5, 'NO-BAKE CHEESECAKE 5 * 1 sell', 'Credit', '5.00', '85.00', '2019-04-03 11:53:37', '2019-04-03 11:53:37'),
(79, 4, 'NO-BAKE CHEESECAKE 50 * 1 sell', 'Credit', '50.00', '250.00', '2019-04-03 11:53:37', '2019-04-03 11:53:37'),
(80, 8, 'NO-BAKE CHEESECAKE 150 * 1 sell', 'Credit', '150.00', '9250.00', '2019-04-03 11:53:37', '2019-04-03 11:53:37'),
(81, 2, 'Chicken Corn Soup 150 * 1 sell', 'Credit', '150.00', '9325.00', '2019-04-06 11:54:12', '2019-04-06 11:54:12'),
(82, 4, 'Chicken Corn Soup 50 * 1 sell', 'Credit', '50.00', '200.00', '2019-04-06 11:54:12', '2019-04-06 11:54:12'),
(83, 16, 'Chicken Corn Soup 2 * 1 sell', 'Credit', '2.00', '14.00', '2019-04-06 11:54:12', '2019-04-06 11:54:12'),
(84, 1, 'Chicken Corn Soup 5 * 1 sell', 'Credit', '5.00', '432.00', '2019-04-06 11:54:12', '2019-04-06 11:54:12'),
(85, 15, 'Chicken Corn Soup 5 * 1 sell', 'Credit', '5.00', '85.00', '2019-04-06 11:54:12', '2019-04-06 11:54:12'),
(86, 18, 'Pepsi 250mg 1 * 2 sell', 'Credit', '2.00', '18.00', '2019-04-11 11:54:50', '2019-04-11 11:54:50'),
(87, 21, 'Stock Low', 'Debit', '1000.00', '1000.00', '2019-04-16 11:57:23', '2019-04-16 11:57:23'),
(88, 20, 'Mango Juice 200 * 1 sell', 'Credit', '200.00', '500.00', '2019-04-16 11:57:27', '2019-04-16 11:57:27'),
(89, 21, 'Mango Juice 100 * 1 sell', 'Credit', '100.00', '900.00', '2019-04-16 11:57:27', '2019-04-16 11:57:27'),
(90, 1, 'Pizza Capricaso 5 * 1 sell', 'Credit', '5.00', '427.00', '2019-04-18 11:01:51', '2019-04-18 11:01:51'),
(91, 2, 'Pizza Capricaso 50 * 1 sell', 'Credit', '50.00', '9275.00', '2019-04-18 11:01:51', '2019-04-18 11:01:51'),
(92, 3, 'Pizza Capricaso 100 * 1 sell', 'Credit', '100.00', '8850.00', '2019-04-18 11:01:51', '2019-04-18 11:01:51'),
(93, 1, 'Pizza Capricaso 5 * 2 sell', 'Credit', '10.00', '417.00', '2019-04-23 09:46:01', '2019-04-23 09:46:01'),
(94, 2, 'Pizza Capricaso 50 * 2 sell', 'Credit', '100.00', '9175.00', '2019-04-23 09:46:01', '2019-04-23 09:46:01'),
(95, 3, 'Pizza Capricaso 100 * 2 sell', 'Credit', '200.00', '8650.00', '2019-04-23 09:46:01', '2019-04-23 09:46:01'),
(96, 2, 'PATRON CHICKEN BURGER 25 * 2 sell', 'Credit', '50.00', '9125.00', '2019-04-23 09:46:01', '2019-04-23 09:46:01'),
(97, 1, 'PATRON CHICKEN BURGER 5 * 2 sell', 'Credit', '10.00', '407.00', '2019-04-23 09:46:01', '2019-04-23 09:46:01'),
(98, 3, 'PATRON CHICKEN BURGER 50 * 2 sell', 'Credit', '100.00', '8550.00', '2019-04-23 09:46:01', '2019-04-23 09:46:01'),
(99, 11, 'Thumb Special Cashew Nut Salad 50 * 2 sell', 'Credit', '100.00', '1600.00', '2019-04-23 09:46:01', '2019-04-23 09:46:01'),
(100, 12, 'Thumb Special Cashew Nut Salad 100 * 2 sell', 'Credit', '200.00', '1500.00', '2019-04-23 09:46:01', '2019-04-23 09:46:01'),
(101, 10, 'Thumb Special Cashew Nut Salad 50 * 2 sell', 'Credit', '100.00', '1700.00', '2019-04-23 09:46:01', '2019-04-23 09:46:01'),
(102, 1, 'Thumb Special Cashew Nut Salad 2 * 2 sell', 'Credit', '4.00', '403.00', '2019-04-23 09:46:01', '2019-04-23 09:46:01'),
(103, 1, 'Pizza Capricaso 5 * 1 sell', 'Credit', '5.00', '398.00', '2019-04-23 10:56:50', '2019-04-23 10:56:50'),
(104, 2, 'Pizza Capricaso 50 * 1 sell', 'Credit', '50.00', '9075.00', '2019-04-23 10:56:50', '2019-04-23 10:56:50'),
(105, 3, 'Pizza Capricaso 100 * 1 sell', 'Credit', '100.00', '8450.00', '2019-04-23 10:56:50', '2019-04-23 10:56:50'),
(106, 2, 'PATRON CHICKEN BURGER 25 * 1 sell', 'Credit', '25.00', '9050.00', '2019-04-23 10:56:50', '2019-04-23 10:56:50'),
(107, 1, 'PATRON CHICKEN BURGER 5 * 1 sell', 'Credit', '5.00', '393.00', '2019-04-23 10:56:50', '2019-04-23 10:56:50'),
(108, 3, 'PATRON CHICKEN BURGER 50 * 1 sell', 'Credit', '50.00', '8400.00', '2019-04-23 10:56:50', '2019-04-23 10:56:50');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2019_02_13_180643_create_users_table', 1),
(2, '2019_02_13_180720_create_password_resets_table', 1),
(3, '2019_02_13_180912_create_ingridients_table', 1),
(4, '2019_02_13_180944_create_food_types_table', 1),
(5, '2019_02_13_181020_create_foods_table', 1),
(6, '2019_02_13_181057_create_food_ingridients_table', 1),
(7, '2019_02_13_181144_create_food_images_table', 1),
(8, '2019_02_13_181212_create_food_comments_table', 1),
(9, '2019_02_13_181300_create_orders_table', 1),
(10, '2019_02_13_181325_create_order_items_table', 1),
(11, '2019_02_13_181345_create_tables_table', 1),
(13, '2019_02_15_093026_create_cards_table', 2),
(17, '2019_02_20_090751_create_ingridient_logs_table', 3);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `order_type` int(11) NOT NULL,
  `serve_type` int(11) NOT NULL,
  `order_status` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `order_type`, `serve_type`, `order_status`, `created_at`, `updated_at`) VALUES
(1, 7, 2, 0, 2, '2019-03-01 09:52:33', '2019-03-01 09:52:33'),
(2, 7, 2, 0, 2, '2019-03-03 09:53:14', '2019-03-03 09:53:14'),
(3, 7, 2, 0, 2, '2019-03-06 09:56:07', '2019-03-06 09:56:07'),
(4, 7, 2, 0, 2, '2019-03-11 11:37:21', '2019-03-11 11:37:21'),
(5, 7, 2, 0, 2, '2019-03-16 11:38:23', '2019-03-16 11:38:23'),
(6, 7, 2, 0, 2, '2019-03-22 11:44:15', '2019-03-22 11:44:15'),
(7, 7, 2, 0, 2, '2019-03-29 11:45:03', '2019-03-29 11:45:03'),
(8, 7, 2, 0, 2, '2019-04-08 11:46:04', '2019-04-08 11:46:04'),
(9, 7, 2, 0, 2, '2019-04-13 11:46:46', '2019-04-13 11:46:46'),
(10, 7, 2, 0, 2, '2019-04-20 11:47:48', '2019-04-20 11:47:48'),
(11, 5, 2, 0, 2, '2019-03-09 11:50:10', '2019-03-09 11:50:10'),
(12, 5, 2, 0, 2, '2019-04-03 11:53:37', '2019-04-03 11:53:37'),
(13, 5, 2, 0, 0, '2019-04-06 11:54:12', '2019-04-06 11:54:12'),
(14, 5, 2, 0, 0, '2019-04-11 11:54:50', '2019-04-11 11:54:50'),
(15, 5, 2, 0, 0, '2019-04-16 11:57:27', '2019-04-16 11:57:27'),
(16, 7, 2, 0, 0, '2019-04-18 11:01:51', '2019-04-18 11:01:51'),
(17, 2, 1, 0, 2, '2019-04-23 09:46:01', '2019-04-23 09:46:01'),
(18, 2, 1, 0, 0, '2019-04-23 10:56:50', '2019-04-23 10:56:50');

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `food_id` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `cook_status` int(11) NOT NULL,
  `serve_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`id`, `order_id`, `food_id`, `qty`, `cook_status`, `serve_status`) VALUES
(1, 1, 1, 2, 1, 1),
(2, 1, 3, 1, 1, 1),
(3, 2, 7, 1, 1, 1),
(4, 3, 15, 2, 1, 1),
(5, 4, 16, 1, 1, 1),
(6, 5, 17, 2, 1, 1),
(7, 6, 4, 1, 1, 1),
(8, 7, 6, 2, 1, 1),
(9, 8, 2, 1, 1, 1),
(10, 9, 3, 1, 1, 1),
(11, 9, 16, 1, 1, 1),
(12, 10, 7, 1, 1, 1),
(13, 11, 1, 2, 1, 1),
(14, 12, 4, 1, 1, 1),
(15, 12, 16, 1, 1, 1),
(16, 13, 6, 1, 0, 1),
(17, 14, 13, 2, 1, 1),
(18, 15, 15, 1, 1, 0),
(19, 16, 1, 1, 0, 0),
(20, 17, 1, 2, 1, 1),
(21, 17, 2, 2, 1, 1),
(22, 17, 3, 2, 1, 1),
(23, 18, 1, 1, 0, 0),
(24, 18, 2, 1, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tables`
--

CREATE TABLE `tables` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `person` int(11) NOT NULL,
  `order_id` int(11) DEFAULT NULL,
  `syn` int(11) NOT NULL,
  `checkout_status` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tables`
--

INSERT INTO `tables` (`id`, `name`, `person`, `order_id`, `syn`, `checkout_status`) VALUES
(1, 'Table 1', 4, NULL, 0, 0),
(2, 'Table 2', 4, 3, 0, 0),
(3, 'Table 3', 4, NULL, 0, 0),
(4, 'Table 4', 4, NULL, 0, 0),
(5, 'Table 5', 4, NULL, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `table_carts`
--

CREATE TABLE `table_carts` (
  `id` int(11) NOT NULL,
  `table_id` int(11) NOT NULL,
  `food_id` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `table_carts`
--

INSERT INTO `table_carts` (`id`, `table_id`, `food_id`, `qty`, `created_at`, `updated_at`) VALUES
(6, 1, 2, 1, '2019-04-22 04:51:36', '2019-04-22 04:51:36'),
(9, 1, 1, 1, '2019-04-22 06:08:19', '2019-04-22 06:08:19');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `user_type`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Administrator', 'admin@admin.com', NULL, '$2y$10$rpr4fhcH916QF/lMUbqqser72hfDhb.JTffbjqQB9riW1.K3gv62W', 'Admin', 'kFS1kObWzSBO2A1mHQL0B4DLLAp1IFGCC2AwOjELdfm4flWLRuHAmpUNjf0y', NULL, NULL),
(2, 'Kitchen Staff', 'kitchen@gmail.com', NULL, '$2y$10$rpr4fhcH916QF/lMUbqqser72hfDhb.JTffbjqQB9riW1.K3gv62W', 'Kitchen', NULL, NULL, NULL),
(3, 'Munira', 'munira@gmal.com', NULL, '$2y$10$rpr4fhcH916QF/lMUbqqser72hfDhb.JTffbjqQB9riW1.K3gv62W', 'Customer', NULL, NULL, NULL),
(4, 'Mahfuzur Rahman', 'mahfuz@gmail.com', NULL, '$2y$10$rpr4fhcH916QF/lMUbqqser72hfDhb.JTffbjqQB9riW1.K3gv62W', 'Customer', NULL, NULL, NULL),
(5, 'Amin Hossain', 'amin@gmail.com', NULL, '$2y$10$rpr4fhcH916QF/lMUbqqser72hfDhb.JTffbjqQB9riW1.K3gv62W', 'Customer', NULL, NULL, NULL),
(7, 'Ashikur Rahman', 'ashik@gmail.com', NULL, '$2y$10$rpr4fhcH916QF/lMUbqqser72hfDhb.JTffbjqQB9riW1.K3gv62W', 'Customer', 'sJXK0mgnvLlS4QltaucJrYKm2bUmLx5zlzmhKwifynuUzk9erd45rkI6WgQ0', '2019-02-13 08:04:00', '2019-02-13 08:04:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `carts`
--
ALTER TABLE `carts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `foods`
--
ALTER TABLE `foods`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `food_comments`
--
ALTER TABLE `food_comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `food_types`
--
ALTER TABLE `food_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ingridients`
--
ALTER TABLE `ingridients`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ingridient_logs`
--
ALTER TABLE `ingridient_logs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `tables`
--
ALTER TABLE `tables`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `table_carts`
--
ALTER TABLE `table_carts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `carts`
--
ALTER TABLE `carts`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `foods`
--
ALTER TABLE `foods`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `food_comments`
--
ALTER TABLE `food_comments`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `food_types`
--
ALTER TABLE `food_types`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `ingridients`
--
ALTER TABLE `ingridients`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `ingridient_logs`
--
ALTER TABLE `ingridient_logs`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=109;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `tables`
--
ALTER TABLE `tables`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `table_carts`
--
ALTER TABLE `table_carts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
