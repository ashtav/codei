-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Jun 02, 2019 at 01:21 PM
-- Server version: 5.7.23
-- PHP Version: 7.2.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_example`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_login`
--

CREATE TABLE `tb_login` (
  `user_id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `token` varchar(50) NOT NULL,
  `signin_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tb_login`
--

INSERT INTO `tb_login` (`user_id`, `email`, `password`, `token`, `signin_at`) VALUES
(1, 'admin@gmail.com', '$2y$12$L5G3t18of1XPr4qlHxkbAOXhenCen/y8Vklg7arpzKE3D7b5il0Km', '', '2019-05-27 17:11:18');

-- --------------------------------------------------------

--
-- Table structure for table `tb_product`
--

CREATE TABLE `tb_product` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `category` varchar(50) NOT NULL,
  `price` int(11) NOT NULL,
  `stock` int(11) NOT NULL,
  `image` varchar(30) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tb_product`
--

INSERT INTO `tb_product` (`id`, `name`, `category`, `price`, `stock`, `image`, `created_at`) VALUES
(4, 'Ibanez', 'Gitar', 2400000, 5, '1559456006.jpg', '2019-06-02 06:13:25'),
(5, 'Rolland', 'Piano', 8500000, 3, '1559456236.jpg', '2019-06-02 06:17:15'),
(6, 'Yamaha P45', 'Piano', 5300000, 2, '1559456287.jpg', '2019-06-02 06:18:06'),
(7, 'Accoustic Echo', 'Gitar', 1700000, 8, '1559456329.jpg', '2019-06-02 06:18:48'),
(9, 'Yamaha Dx888', 'Drum', 9800000, 2, '1559460951.jpg', '2019-06-02 07:35:50'),
(10, 'Rolland D4443', 'Piano', 110500000, 2, '1559461011.jpg', '2019-06-02 07:36:50'),
(12, 'Drum Electric', 'Drum', 5500000, 3, '1559461831.jpg', '2019-06-02 07:50:30'),
(13, 'Ukulele Nx8', 'Ukulele', 700000, 17, '0', '2019-06-02 09:24:38'),
(14, 'Drum Complete', 'Drum', 20500000, 3, '0', '2019-06-02 09:25:19'),
(15, 'Violin', 'Gitar', 3000000, 5, '0', '2019-06-02 09:25:57'),
(16, 'Test', 'Gitar', 9090, 9, '0', '2019-06-02 09:27:36');

-- --------------------------------------------------------

--
-- Table structure for table `tb_users`
--

CREATE TABLE `tb_users` (
  `user_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `photo` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tb_users`
--

INSERT INTO `tb_users` (`user_id`, `name`, `address`, `phone`, `photo`) VALUES
(1, 'Lorem Ipsum Name', 'Jl. Lorem Ipsum, Dolor', '081999000000', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_login`
--
ALTER TABLE `tb_login`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `tb_product`
--
ALTER TABLE `tb_product`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_users`
--
ALTER TABLE `tb_users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_login`
--
ALTER TABLE `tb_login`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tb_product`
--
ALTER TABLE `tb_product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
