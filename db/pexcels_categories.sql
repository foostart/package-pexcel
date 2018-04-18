-- phpMyAdmin SQL Dump
-- version 4.5.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Mar 03, 2017 at 03:32 AM
-- Server version: 5.7.11
-- PHP Version: 7.0.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dev_laravel_v53`
--

-- --------------------------------------------------------

--
-- Table structure for table `pexcels_categories`
--

DROP TABLE IF EXISTS `pexcels_categories`;
CREATE TABLE `pexcels_categories` (
  `pexcel_category_id` int(11) NOT NULL,
  `pexcel_category_name` varchar(55) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `pexcels_categories`
--

INSERT INTO `pexcels_categories` (`pexcel_category_id`, `pexcel_category_name`) VALUES
(1, 'Foo'),
(2, 'Var'),
(3, 'List'),
(4, 'Get'),
(5, 'Post');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `pexcels_categories`
--
ALTER TABLE `pexcels_categories`
  ADD PRIMARY KEY (`pexcel_category_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `pexcels_categories`
--
ALTER TABLE `pexcels_categories`
  MODIFY `pexcel_category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
