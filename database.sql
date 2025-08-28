-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 27, 2025 at 06:11 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bca-6th-sem`
--

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `category_name` varchar(100) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `category_name`, `status`) VALUES
(1, 'test', 0),
(2, 'Mobile', 1),
(3, 'Laptops', 1),
(4, 'PC', 0),
(5, 'Harddrive', 0),
(6, 'Pen drive', 1);

-- --------------------------------------------------------

--
-- Table structure for table `post`
--

CREATE TABLE `post` (
  `id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `heading` varchar(500) NOT NULL,
  `sub_heading` varchar(100) NOT NULL,
  `published_date` datetime NOT NULL DEFAULT current_timestamp(),
  `description` text NOT NULL,
  `keywords` varchar(100) NOT NULL,
  `post_by` varchar(50) NOT NULL,
  `status` int(20) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `post`
--

INSERT INTO `post` (`id`, `category_id`, `heading`, `sub_heading`, `published_date`, `description`, `keywords`, `post_by`, `status`) VALUES
(2, 1, 'test heading', 'test sub heading', '2025-04-23 07:44:19', 'test description', 'test', 'Farhan Alam', 0),
(3, 1, 'test heading', 'test sub heading', '2025-04-23 07:45:27', 'test description', 'test', 'Farhan Alam', 0);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `category` int(11) NOT NULL,
  `product_name` varchar(100) NOT NULL,
  `price` int(11) NOT NULL,
  `short_description` varchar(200) NOT NULL,
  `description` varchar(500) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `image_url` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `category`, `product_name`, `price`, `short_description`, `description`, `status`, `image_url`) VALUES
(43, 2, 'iPhone 15 Pro Max', 194990, 'Flagship iPhone with A17 Pro', 'iPhone 15 Pro Max features a titanium design, A17 Pro chip, 5x telephoto camera, and all-day battery.', 1, 'assets/iphone15.jpg'),
(44, 2, 'Samsung Galaxy S23 Ultra', 169999, '6.8-inch AMOLED, 200MP camera', 'Top-tier Samsung phone with S Pen, Snapdragon 8 Gen 2, and advanced camera setup.', 1, 'assets/s23ultra.jpg'),
(45, 2, 'OnePlus 11 5G', 99999, 'Snapdragon 8 Gen 2, Hasselblad Camera', 'Flagship OnePlus with AMOLED display, 100W charging, and Hasselblad-tuned cameras.', 1, 'assets/oneplus11.jpg'),
(46, 3, 'MacBook Air M2 (2022)', 152000, 'Lightweight with Apple M2 chip', 'MacBook Air with M2 chip, 13.6-inch Liquid Retina display, and MagSafe charging.', 1, 'assets/macbookair.jpg'),
(47, 3, 'Dell XPS 15', 210000, '15.6” FHD+, Intel i7, 16GB RAM', 'Premium ultrabook with stunning display, strong build, and excellent battery life.', 1, 'assets/xps15.jpg'),
(48, 3, 'HP Pavilion x360', 88000, '2-in-1 convertible laptop', 'Touchscreen laptop with 11th Gen Intel CPU and pen support, perfect for students.', 1, 'assets/pavilionx360.jpg'),
(49, 6, 'SanDisk Ultra Flair 64GB', 999, 'USB 3.0 flash drive', 'Compact, fast USB 3.0 flash drive with durable metal casing and secure access software.', 1, 'assets/sandisk.jpg'),
(50, 6, 'HP USB 2.0 16GB Pen Drive', 749, 'Basic pen drive for daily use', 'Reliable 16GB HP USB drive with sleek design and plug-and-play support.', 1, 'assets/hp236.jpg'),
(51, 6, 'Kingston 64GB DataTraveler Exodia', 1199, 'USB 3.2 Gen 1 performance', 'Durable, high-speed storage solution with cap protection and keyring loop.', 1, 'assets/kingston.jpg'),
(52, 2, 'Realme GT 2 Pro', 84999, 'Snapdragon 8 Gen 1, 2K Display', 'Flagship Realme phone with bio-polymer design, 120Hz AMOLED, and great cameras.', 1, 'assets/realmegt.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `id` int(11) NOT NULL,
  `Name` varchar(100) NOT NULL,
  `Age` int(11) NOT NULL,
  `Address` varchar(150) NOT NULL,
  `Roll_no` int(11) NOT NULL,
  `Status` int(11) NOT NULL DEFAULT 1,
  `Email` varchar(50) NOT NULL,
  `Phone` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id`, `Name`, `Age`, `Address`, `Roll_no`, `Status`, `Email`, `Phone`) VALUES
(1, 'Farhan Alam', 21, 'Kamalnagar, Bharatpur , Chitwan', 6, 0, 'thefarhanalam01@gmail.com', '9807225586'),
(2, 'Citiz Shrestha', 20, 'Gaindakot,Nawalparasi', 5, 0, 'citizshrestha@gmail.com', '9800000000'),
(3, 'Aarav Sharma', 20, 'Kathmandu, Nepal', 101, 1, 'aarav.sharma@example.com', '9800000001'),
(4, 'Sita Thapa', 19, 'Pokhara, Nepal', 102, 1, 'sita.thapa@example.com', '9800000002'),
(5, 'Bibek Koirala', 21, 'Biratnagar, Nepal', 103, 1, 'bibek.koirala@example.com', '9800000003'),
(6, 'Anita Gurung', 22, 'Lalitpur, Nepal', 104, 1, 'anita.gurung@example.com', '9800000004'),
(7, 'Manish Bhandari', 20, 'Dharan, Nepal', 105, 1, 'manish.bhandari@example.com', '9800000005'),
(8, 'Pujan Simkhada', 19, 'Bhaktapur, Nepal', 106, 1, 'puja.shrestha@example.com', '9800000006'),
(9, 'Ravi Khadka', 21, 'Chitwan, Nepal', 107, 1, 'ravi.khadka@example.com', '9800000007');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(16) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `status`) VALUES
(1, 'Farhan Alam', 'thefarhanalam01@gmail.com', '$2y$10$hJVwpcAQz', 1),
(2, 'Farhan Alam', 'thefarhanalam01@gmail.com', '$2y$10$JrAJyAhRd', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `post`
--
ALTER TABLE `post`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category` (`category`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
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
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `post`
--
ALTER TABLE `post`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `post`
--
ALTER TABLE `post`
  ADD CONSTRAINT `post_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`);

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`category`) REFERENCES `category` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
