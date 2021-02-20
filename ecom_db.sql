-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 20, 2021 at 07:13 PM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ecom_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `cat_id` int(11) NOT NULL,
  `cat_title` varchar(255) NOT NULL,
  `cat_image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`cat_id`, `cat_title`, `cat_image`) VALUES
(33, 'بطاقات ستور', ''),
(34, 'حسابات العاب بلايستيشن', ''),
(40, 'نتفلكس وشاهد', '');

-- --------------------------------------------------------

--
-- Table structure for table `count`
--

CREATE TABLE `count` (
  `count_id` int(11) NOT NULL,
  `counts` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `count`
--

INSERT INTO `count` (`count_id`, `counts`) VALUES
(1, 1192);

-- --------------------------------------------------------

--
-- Table structure for table `log_users`
--

CREATE TABLE `log_users` (
  `id` int(11) NOT NULL,
  `usernameg` varchar(50) NOT NULL,
  `passwordg` varchar(255) DEFAULT NULL,
  `product_1` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `log_users`
--

INSERT INTO `log_users` (`id`, `usernameg`, `passwordg`, `product_1`, `created_at`) VALUES
(1, 'saoode11', '$2y$10$fjXls7LVPLuHLepDReN3kedz8MAIViBEhYkso7O.8mehoiJyj/NqW', '', '2021-01-27 21:51:11'),
(10, 'saeedd', '$2y$10$vbH7HCRkky05Ug48M2yWo.7k8gV8xbVFjVu9yxVeqcW7SPGHFS1Fa', '', '2021-02-16 21:54:06'),
(11, 'ali', '$2y$10$TEWU2AxEaYO8eKqYp/5l7umwi8kH3XnKLYHY6YpSZC0y7Zfq/W.C6', '', '2021-02-17 17:26:39'),
(12, 'ali12', '$2y$10$eqaDaKSWt5162IY3O1KeR.oaeqTDyEE1pqyoQR5032ABez7G1zBFi', '', '2021-02-17 17:27:16');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `order_amount` float NOT NULL,
  `order_transaction` varchar(255) NOT NULL,
  `order_status` varchar(255) NOT NULL,
  `order_currency` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `payers`
--

CREATE TABLE `payers` (
  `payers_id` int(11) NOT NULL,
  `name_account` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `name2` varchar(255) NOT NULL,
  `name3` varchar(255) NOT NULL,
  `name_v` varchar(255) NOT NULL,
  `name_v2` varchar(255) NOT NULL,
  `name_v3` varchar(255) NOT NULL,
  `serial_number` varchar(255) NOT NULL,
  `serial_number2` varchar(255) NOT NULL,
  `first_mobile` varchar(255) NOT NULL,
  `secound_mobile` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email2` varchar(255) NOT NULL,
  `pass` varchar(11) NOT NULL,
  `price` float NOT NULL,
  `price_sec` float NOT NULL,
  `prices` float NOT NULL,
  `price_minus` float NOT NULL,
  `money` float NOT NULL,
  `code_note` varchar(255) NOT NULL,
  `date` varchar(11) NOT NULL,
  `time` varchar(11) NOT NULL,
  `date2` varchar(11) NOT NULL,
  `time2` varchar(11) NOT NULL,
  `us_store` varchar(11) NOT NULL,
  `payment_method` varchar(11) NOT NULL,
  `payment_method2` varchar(11) NOT NULL,
  `payer_photo` varchar(255) NOT NULL,
  `user_show` varchar(255) NOT NULL,
  `valueimg` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `created_at_2` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `payers`
--

INSERT INTO `payers` (`payers_id`, `name_account`, `name`, `name2`, `name3`, `name_v`, `name_v2`, `name_v3`, `serial_number`, `serial_number2`, `first_mobile`, `secound_mobile`, `email`, `email2`, `pass`, `price`, `price_sec`, `prices`, `price_minus`, `money`, `code_note`, `date`, `time`, `date2`, `time2`, `us_store`, `payment_method`, `payment_method2`, `payer_photo`, `user_show`, `valueimg`, `created_at`, `created_at_2`) VALUES
(21, '', 'Last of us lI', '', '', 'Last of us lI', '', '', '03-27452461-6216319', 'F10B01XW412390188', '595445988', '569902081', 'rackanassli290@outlook.sa', 'rackanassli290@outlook.sa', 'Aa101010a', 130, 120, 0, 150, 1474, 'dfrhgbrujh', '2020-11-30', '09:32', '2020-12-30', '22:49', '40', 'Al Rajhi Ba', 'STC PAY', '130363015.jpg', '', '', '2020-11-30 06:32:10', '2020-12-30 07:49:00'),
(40, '', 'fifa 21 Beckham', '', '', 'fifa 21 Beckham', '', '', '03-27452334-7505608', '...', '0552272117', '0555926410', 'alfisalawi1994@hotmail.com', 'alfisalawi1994@hotmail.com', 'Aa101010a', 140, 140, 0, 225, 0, '', '2020-12-02', '19:05', '2020-12-23', '02:10', '60', 'Al Rajhi Ba', 'Bank Al-Ahl', 'fifa.jpg', '', '', '2020-12-02 04:05:41', '2021-12-22 23:10:00'),
(42, '', 'call of duty 17', '', '', '', '', '', '...', 'none', '561302010', '', 'almansoori190@outlook.sa', '', 'Aa101010axx', 170, 0, 0, 274, 0, '\r\n    TvfWdL\r\n    GBaWZ9\r\n    CxJZNJ\r\n    Sa64Xk\r\n    dt75FN\r\n    RU3y3s\r\n    VA6LvK\r\n    BQkWFf\r\n    3YxpA6\r\n    seRQhh\r\n', '2020-11-26', '16:56', '', '', '75', 'STC PAY', '', '01eKgHyqSkMPNKkTptRAgHt-1.1604071118.fit_lim.fit_lim.size_956x.jpg', '', '', '2020-11-26 01:56:27', '2000-01-03 22:16:23'),
(44, '', 'fifa 21 champeions', '', '', 'fifa 21 champeions', '', '', 'F10601XW411285030 ', '03-27452573-5811381', '0546625865', '0545192877', 'saoodealsam2@gmail.com', 'saoodealsam2@gmail.com', 'Aa101010a', 140, 145, 0, 132, 0, '', '2021-01-03', '23:42', '2021-01-04', '22:39', '35', 'STC PAY', 'Al Rajhi Ba', 'fifa.jpg', '', '', '2021-01-03 08:42:27', '2021-01-04 07:39:00'),
(45, '', 'money out', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 100, 0, '', '2021-01-06', '16:00', '', '', '', 'money Out', '', '', '', '', '2021-01-06 01:00:47', '2021-01-29 22:05:39'),
(57, '', 'codpen bought', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 46, 0, '', '2021-01-10', '02:44', '', '', '', '', '', '', '', '', '2021-01-09 23:44:27', '2021-01-29 22:05:39'),
(58, '', 'copoun udacity', '', '', '', '', '', '6U8WF7VTNDYXGE3P', '', '', '', '', '', '', 0, 0, 0, 0, 0, '', '', '', '', '', '', '', '', '', '', '', '2021-01-28 21:00:00', '2021-01-29 22:05:39'),
(63, '', 'Fifa 21', '', '', 'fifa21', '', '', 'F10B01XW412428793', '', '0566664113', '532913126', 'saoodenbn77@outlook.sa', 'saoodenbn@outlook.sa', 'Aa101010a', 140, 140, 0, 225, 0, 'bL77Tc\r\nUuxkRG\r\nJpp57V\r\nGkP8jX\r\nWnrrQR\r\n3hDvBS\r\ngEcSWh\r\nbSWKRF\r\nc93KH2\r\nab7JHD', '2021-01-11', '09:18', '2021-01-29', '22:26', '60', 'Stc Pay', 'Al_Readh', 'fifa.jpg', '', '', '2021-01-11 06:18:27', '2021-01-29 22:05:39'),
(79, '', 'Crash 4', 'Tax', '', 'Crash 4', '', '', '03-27452246-8191349', 'unknown persion', '546309000', '0', 'dashbreek2020@gmail.com', 'dashbreek2020@gmail.com', 'Aa101010a', 130, 0, 0, 0, 0, '', '2021-01-18', '21:41', '2021-01-18', '22:09', '60', 'Al-Riadh', 'unknown', 'kjfjfjf.jpg', '', '', '2021-01-18 07:41:27', '2021-01-29 22:05:39'),
(88, '', 'adverticement on harag', '', '', '', '', '', '', '', '598662787', '', '', '', '', 100, 0, 0, 0, 0, '', '2021-01-21', '20:42', '', '', '', 'AL-Rajhy ', '', '', '', '', '2021-01-29 11:33:27', '2021-01-29 22:05:39'),
(125, '', 'fifa 21', '', '', 'fifa 21', '', '', '02-27452355-2000108', '', '509806763', '501511955', 'moodeanwar2020@gmail.com', 'moodeanwar2020@gmail.com', 'Aa101010a', 100, 100, 0, 94, 0, '\r\n    uQAjHj\r\n    9hMAJF\r\n    cnC2NY\r\n    yN92em\r\n    8WpZCc\r\n    5kAbep\r\n    NkuYZU\r\n    rD7g6g\r\n    QbXxYw\r\n    hBd32P\r\n', '2021-02-02', '08:39', '2021-02-02', '21:01', '25', 'Al-rajehy', 'Al-Rajehy', 'pre-order-fifa-21-today-for-xbox-one.jpg', '', '', NULL, '2021-02-02 18:10:11'),
(126, '', 'fifa 21', '', '', 'Fifa 21', '', '', 'spacial number - 140 SR', '...._ 130 SR', '507247455', '543314490', 'alamoodimoon15@outlook.sa', 'alamoodimoon15@outlook.sa', 'Aa101010a', 140, 130, 0, 94, 0, '', '2021-02-02', '18:50', '2021-02-10', '21:39', '25', 'Al-Rajehy', '', 'fifa.jpg', '', '', NULL, '2021-02-02 18:35:45'),
(131, '', 'CAT ', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 117, 0, '', '2021-02-04', '17:04', '2021-02-04', '16:56', '', 'Westren', '', '', '', '', NULL, '2021-02-04 22:02:28'),
(132, '', 'ENTERNET SADAD', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, '', '2021-02-07', '17:06', '', '', '', '', '', '', '', '', NULL, '2021-02-07 22:05:51'),
(137, '', '', '', '', '', '', '', '03-27452231-648003', '', '540222933', '', 'alsamery100@hotmail.com', '', '', 0, 0, 0, 0, 0, 'sMjxtT\r\nvAKqKZ\r\nct4tqH\r\nNq28TF\r\nFWksCU\r\n6EW9sq\r\nX66LKt\r\nvA2tDp\r\nYeJrEA\r\nY6HdqW\r\n', '2020-10-13', '', '', '', '', '??????', '', 'fifa.jpg', '', '', '2021-02-11 16:06:30', '2021-02-11 16:06:30'),
(229, '', 'shahid', '', '', '', '', '', '', '', '500020628', '', 'y.alamery100@hotmail.com', '', 'Aa101010a', 160, 0, 0, 140, 0, '', '2021-01-30', '16:04', '', '', '6 monthes', '', '', 'ssssss.jpg', '', '', '2021-02-16 12:34:11', '2021-02-16 12:34:11'),
(302, '', 'spider-man mailes', '', '', '', '', '', '02-274525743456185', '', '541117033', '', 'almanoori224@outlook.sa', '', 'Aa101010a', 145, 0, 0, 179, 0, 'p4f7ZU xyE4vX TaJhFj AuSRq7 CzHM6c wMKQRf Qa5w7B RzRjLY y9fDG7 8Jgmcg', '2021-02-19', '21:55', '', '', '50', 'Al-Rajhey S', '', 'T45iRN1bhiWcJUzST6UFGBvO.webp', '', '', '2021-02-19 19:42:01', '2021-02-19 19:42:01'),
(303, 'saeedd', 'The Last Of Us II ', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, '', '', '', '', '', '', '', '', '', '', '', '2021-02-19 22:42:40', '2021-02-19 22:42:40'),
(304, 'saeedd', 'The Last Of Us II ', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, '', '', '', '', '', '', '', '', '', '', '', '2021-02-19 22:42:40', '2021-02-19 22:42:40'),
(305, 'saeedd', 'Fifa 21', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, '', '', '', '', '', '', '', '', '', '', '', '2021-02-19 23:20:40', '2021-02-19 23:20:40'),
(306, 'saeedd', 'Fifa 21', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, '', '', '', '', '', '', '', '', '', '', '', '2021-02-19 23:20:40', '2021-02-19 23:20:40'),
(307, 'saeedd', 'The Last Of Us II ', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, '', '', '', '', '', '', '', '', '', '', '', '2021-02-19 23:45:34', '2021-02-19 23:45:34'),
(308, 'saeedd', 'The Last Of Us II ', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, '', '', '', '', '', '', '', '', '', '', '', '2021-02-19 23:45:34', '2021-02-19 23:45:34'),
(309, 'saeedd', 'Fifa 21', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, '', '', '', '', '', '', '', '', '', '', '', '2021-02-20 00:37:09', '2021-02-20 00:37:09'),
(310, 'saeedd', 'Fifa 21', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, '', '', '', '', '', '', '', '', '', '', '', '2021-02-20 00:37:09', '2021-02-20 00:37:09'),
(311, 'ali', 'Crash 4', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, '', '', '', '', '', '', '', '', '', '', '', '2021-02-20 00:49:23', '2021-02-20 00:49:23'),
(312, 'ali', 'Crash 4', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, '', '', '', '', '', '', '', '', '', '', '', '2021-02-20 00:49:23', '2021-02-20 00:49:23');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `product_id` int(11) NOT NULL,
  `product_title` varchar(255) NOT NULL,
  `product_category_id` int(11) NOT NULL,
  `product_price` float NOT NULL,
  `product_quantity` int(11) NOT NULL,
  `product_description` text NOT NULL,
  `short_desc` text NOT NULL,
  `product_image` varchar(255) NOT NULL,
  `product_image_top` varchar(255) NOT NULL,
  `name_comment` varchar(11) NOT NULL,
  `text_comment` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `product_title`, `product_category_id`, `product_price`, `product_quantity`, `product_description`, `short_desc`, `product_image`, `product_image_top`, `name_comment`, `text_comment`) VALUES
(4662, 'Call Of Duty Cold War', 34, 170, 1, ' نسخ تحميل لجهاز واحد فقط سوني 4 او سوني 5 لك الأختيارنسخة الأجيال المشتركة ', 'نسخ تحميل لجهاز...', 'Black_Ops_Cold_War.jpg', '01eKgHyqSkMPNKkTptRAgHt-1.1604071118.fit_lim.fit_lim.size_956x.jpg', '', ''),
(4663, 'Fifa 21', 34, 140, 1, ' نسخ تحميل لجهاز واحد فقط سوني 4 او سوني 5 لك الأختيار', 'نسخ تحميل لجهاز واحد...', 'fifa.jpg', '', '', ''),
(4664, 'Crash 4', 34, 125, 1, ' نسخ تحميل لجهاز واحد فقط سوني 4 او سوني 5 لك الأختيار ', 'نسخ تحميل لجهاز واحد... ', 'kjfjfjf.jpg', '', '', ''),
(4665, 'The Last Of Us II ', 34, 125, 1, ' نسخ تحميل لجهاز واحد فقط سوني 4 او سوني 5 لك الأختيار ', 'نسخ تحميل لجهاز واحد... ', 'images.jpg', 'The-Last-of-Us-Part-1280x720-1.jpg', 'saeed', 'any text');

-- --------------------------------------------------------

--
-- Table structure for table `reports`
--

CREATE TABLE `reports` (
  `report_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `product_price` float NOT NULL,
  `product_title` varchar(255) NOT NULL,
  `product_quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `slides`
--

CREATE TABLE `slides` (
  `slide_id` int(11) NOT NULL,
  `slide_title` text NOT NULL,
  `slide_image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `slides`
--

INSERT INTO `slides` (`slide_id`, `slide_title`, `slide_image`) VALUES
(83, 'thae last 2', '130363015.jpg'),
(84, 'gta5', 'gta.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_show` varchar(255) NOT NULL,
  `users_id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `user_photo` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_show`, `users_id`, `username`, `email`, `password`, `user_photo`) VALUES
('', 3, 'saoode', 'saoodezx99@gmail.com', '1122', 'Capture (1).JPG'),
('', 15, 'ahmed', 'hamoode99@gmail.com', '1122', 'Scan0003.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `userss`
--

CREATE TABLE `userss` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`cat_id`);

--
-- Indexes for table `count`
--
ALTER TABLE `count`
  ADD PRIMARY KEY (`count_id`);

--
-- Indexes for table `log_users`
--
ALTER TABLE `log_users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `password` (`passwordg`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `payers`
--
ALTER TABLE `payers`
  ADD PRIMARY KEY (`payers_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `reports`
--
ALTER TABLE `reports`
  ADD PRIMARY KEY (`report_id`);

--
-- Indexes for table `slides`
--
ALTER TABLE `slides`
  ADD PRIMARY KEY (`slide_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`users_id`);

--
-- Indexes for table `userss`
--
ALTER TABLE `userss`
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `cat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `count`
--
ALTER TABLE `count`
  MODIFY `count_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `log_users`
--
ALTER TABLE `log_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=112;

--
-- AUTO_INCREMENT for table `payers`
--
ALTER TABLE `payers`
  MODIFY `payers_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=313;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4667;

--
-- AUTO_INCREMENT for table `reports`
--
ALTER TABLE `reports`
  MODIFY `report_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=96;

--
-- AUTO_INCREMENT for table `slides`
--
ALTER TABLE `slides`
  MODIFY `slide_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=85;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `users_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
