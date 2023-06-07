-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3307
-- Generation Time: Jun 03, 2023 at 06:23 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `webshop`
--
-- --------------------------------------------------------

--
-- Table structure for table `country`
--

CREATE TABLE IF NOT EXISTS `country` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(60) NOT NULL,
  `phone-prefix` int(11) NOT NULL,
  `local-currency` varchar(10) NOT NULL,
  `created_at` timestamp DEFAULT current_timestamp() ,
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `country` (`name`, `phone-prefix`, `local-currency`)
VALUES ('Colombia', 57, 'COP'), ('United States', 1, 'USD'), ('Spain', 34, 'EUR');

-- --------------------------------------------------------

--
-- Table structure for table `company`
--

CREATE TABLE IF NOT EXISTS `company` (
  `NIT` int(30) NOT NULL,
  `NIT-DV` tinyint(1) NOT NULL,
  `id_country` int(11) NOT NULL,
  `name` varchar(60) NOT NULL,
  `address` varchar(50) NOT NULL,
  `phone` int(11) NOT NULL,
  `state` varchar(10) NOT NULL,
  `created_at` timestamp DEFAULT current_timestamp() ,
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`NIT`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `rol`
--

CREATE TABLE IF NOT EXISTS `rol` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(30) NOT NULL,
  `created_at` timestamp DEFAULT current_timestamp() ,
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `rol` (`name`)
VALUES ('Admin'), ('Client');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_rol` int(11) NOT NULL,
  `id_country` int(11) NOT NULL,
  `name` varchar(80) NOT NULL,
  `last_name` varchar(80) NOT NULL,
  `email` varchar(120) NOT NULL,
  `cell_phone` int(11) NOT NULL,
  `password` varchar(500) NOT NULL,
  `created_at` timestamp DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


INSERT INTO `user` (`id_rol`, `id_country`, `name`, `last_name`, `email`, `cell_phone`, `password`)
VALUES (1, 1, 'Admin', 'Ator', 'michaelorejuelaramirez@gmail.com', 123456789, 'e1553510fed1991704d85ba82cc2750de6978109');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE IF NOT EXISTS `category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(80) NOT NULL,
  `created_at` timestamp DEFAULT current_timestamp() ,
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `category` (`name`)
VALUES ('Accessories'), ('Electronics'), ('Health'), ('Home'), ('Pets'), ('Sport');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE IF NOT EXISTS `product` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_company` int(11) NOT NULL,
  `name` varchar(80) NOT NULL,
  `description` varchar(500) NOT NULL,
  `stock` int(20) NOT NULL,
  `price` varchar(20) NOT NULL,
  `state` varchar(10) NOT NULL,
  `created_at` timestamp DEFAULT current_timestamp() ,
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `product_category`
--

CREATE TABLE IF NOT EXISTS `product_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_product` int(11) NOT NULL,
  `id_category` int(11) NOT NULL,
  `created_at` timestamp DEFAULT current_timestamp() ,
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `order`
--

CREATE TABLE IF NOT EXISTS `order` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NOT NULL,
  `number` varchar(80) NOT NULL,
  `created_at` timestamp DEFAULT current_timestamp() ,
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `order_product`
--

CREATE TABLE IF NOT EXISTS `order_product` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_order` int(11) NOT NULL,
  `id_product` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `created_at` timestamp DEFAULT current_timestamp() ,
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Indexes for table `company`
--
ALTER TABLE `company`
ADD FOREIGN KEY (`id_country`) REFERENCES `country`(`id`);

-- --------------------------------------------------------

--
-- Indexes for table `user`
--
ALTER TABLE `user`
ADD FOREIGN KEY (`id_rol`) REFERENCES `rol`(`id`);

ALTER TABLE `user`  
ADD FOREIGN KEY (`id_country`) REFERENCES `country`(`id`);

-- --------------------------------------------------------

--
-- Indexes for table `product`
--
ALTER TABLE `product`
ADD FOREIGN KEY (`id_company`) REFERENCES `company`(`NIT`);

-- --------------------------------------------------------

--
-- Indexes for table `product_category`
--
ALTER TABLE `product_category`
ADD FOREIGN KEY (`id_product`) REFERENCES `product`(`id`);

ALTER TABLE `product_category`
ADD FOREIGN KEY (`id_category`) REFERENCES `category`(`id`);

-- --------------------------------------------------------

--
-- Indexes for table `order`
--
ALTER TABLE `order`
ADD FOREIGN KEY (`id_user`) REFERENCES `user`(`id`);

-- --------------------------------------------------------

--
-- Indexes for table `order_product`
--
ALTER TABLE `order_product`
ADD FOREIGN KEY (`id_order`) REFERENCES `order`(`id`);

ALTER TABLE `order_product`
ADD FOREIGN KEY (`id_product`) REFERENCES `product`(`id`);

-- --------------------------------------------------------

COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
