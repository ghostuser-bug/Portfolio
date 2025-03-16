-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 11, 2025 at 06:48 PM
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
-- Database: `gadget_store`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `cart_id` int(11) NOT NULL,
  `session_id` varchar(255) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `color_id` int(11) NOT NULL,
  `selected_color` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`cart_id`, `session_id`, `product_id`, `quantity`, `color_id`, `selected_color`) VALUES
(1, 'a7svf5ijkcoibgon43vpr24a1s', 2, 1, 2, ''),
(2, 'a7svf5ijkcoibgon43vpr24a1s', 2, 1, 2, ''),
(3, 'a7svf5ijkcoibgon43vpr24a1s', 5, 1, 2, ''),
(0, 'bs4tne5tkdsv1j8hgn19v28oe4', 4, 1, 1, '');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `description`) VALUES
(1, 'Phones', 'Smartphones and mobile devices'),
(2, 'Laptops', 'Gaming and productivity laptops'),
(3, 'Smartwatches', 'Wearable smart devices');

-- --------------------------------------------------------

--
-- Table structure for table `colors`
--

CREATE TABLE `colors` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `colors`
--

INSERT INTO `colors` (`id`, `name`) VALUES
(1, 'Red'),
(2, 'Blue'),
(3, 'Green'),
(4, 'Black'),
(5, 'White');

-- --------------------------------------------------------

--
-- Table structure for table `deals`
--

CREATE TABLE `deals` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `price` varchar(50) NOT NULL,
  `old_price` varchar(50) NOT NULL,
  `image_url` varchar(255) NOT NULL,
  `product_link` varchar(255) NOT NULL,
  `deadline` datetime NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `deals`
--

INSERT INTO `deals` (`id`, `title`, `price`, `old_price`, `image_url`, `product_link`, `deadline`, `created_at`) VALUES
(1, 'iPHONE 16', '$599', '$799', '16.jpg', 'product.php?id=1', '2025-01-10 23:59:59', '2025-01-06 07:36:47'),
(2, 'HP Victus 15.6 inch Gaming Laptop', '$1,199', '$1,499', 'victus.jpg', 'product.php?id=2', '2025-01-12 23:59:59', '2025-01-06 07:36:47'),
(3, 'Smartwatch Pro', '$199', '$299', 'https://www.valdus.com/wp-content/uploads/2023/05/2023052407360759d3a5430a1d9cc8.jpg', 'product.php?id=3', '2025-01-15 23:59:59', '2025-01-06 07:36:47'),
(4, 'iPHONE 15 Pro', '$499', '$699', 'https://hips.hearstapps.com/hmg-prod/images/index2-660d8cf65cd7f.jpg?crop=0.5xw:1xh;center,top&resize=640:*', 'product.php?id=8', '2025-01-07 23:59:59', '2025-01-06 07:36:47'),
(5, 'Smartwatch Pro Special Edition', '$249', '$349', 'https://example.com/smartwatch-special.jpg', 'product.php?id=9', '2025-01-20 23:59:59', '2025-01-06 07:36:47');

-- --------------------------------------------------------

--
-- Table structure for table `login_attempts`
--

CREATE TABLE `login_attempts` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `login_status` enum('Success','Failure') NOT NULL,
  `login_time` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `session_id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `address` text NOT NULL,
  `total_price` decimal(10,2) NOT NULL,
  `payment_method` enum('credit_card','fpx') NOT NULL,
  `status` enum('Ordered','Shipped','Out for Delivery','Delivered','Cancelled') NOT NULL DEFAULT 'Ordered',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `email` varchar(255) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `order_date` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `session_id`, `name`, `address`, `total_price`, `payment_method`, `status`, `created_at`, `email`, `phone`, `user_id`, `order_date`) VALUES
(3, 'o7mpvdsraia6fb0tv54ncqj5vg', 'Nur Adam', 'NO.49 JALAN TPS 4/1, TAMAN PELANGI SEMENYIH, SEMENYIH, SELAN', 599.00, '', 'Delivered', '2025-01-10 12:04:09', 'nuradam0407@gmail.com', '0103620638', 4, '2025-01-10 20:04:09'),
(4, 'o7mpvdsraia6fb0tv54ncqj5vg', 'Nur Adam', 'NO.49 JALAN TPS 4/1, TAMAN PELANGI SEMENYIH, SEMENYIH, SELAN', 1199.00, '', 'Delivered', '2025-01-10 12:15:47', 'adam.zaferizam@s.unikl.edu.my', '0103620638', 4, '2025-01-10 20:15:47'),
(5, 'o7mpvdsraia6fb0tv54ncqj5vg', 'Nur Adam', 'NO.49 JALAN TPS 4/1, TAMAN PELANGI SEMENYIH, SEMENYIH, SELAN', 3000.00, '', 'Delivered', '2025-01-10 12:19:29', 'albab@gmail.com', '0103620638', 4, '2025-01-10 20:19:29');

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `order_item_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `total_price` decimal(10,2) NOT NULL,
  `product_id` int(11) NOT NULL,
  `image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`order_item_id`, `order_id`, `product_name`, `quantity`, `price`, `total_price`, `product_id`, `image`) VALUES
(1, 3, 'iPhone 16', 1, 599.00, 599.00, 1, NULL),
(2, 4, 'HP Victus 15.6 inch Gaming Laptop', 1, 1199.00, 1199.00, 2, NULL),
(3, 5, 'IPHONE 14 PRO MAX', 1, 3000.00, 3000.00, 3, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `category_id` int(10) UNSIGNED NOT NULL,
  `image_url` varchar(255) DEFAULT NULL,
  `original_price` float NOT NULL,
  `discounted_price` float NOT NULL,
  `price` decimal(10,2) NOT NULL DEFAULT 0.00,
  `color_id` int(11) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `deal_end_time` datetime DEFAULT NULL,
  `is_new_arrival` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `description`, `category_id`, `image_url`, `original_price`, `discounted_price`, `price`, `color_id`, `image`, `deal_end_time`, `is_new_arrival`, `created_at`) VALUES
(1, 'iPhone 16', 'Latest Apple smartphone with advanced features.', 1, '16.jpg', 799, 599, 0.00, NULL, NULL, NULL, 1, '2025-01-06 19:48:56'),
(2, 'HP Victus 15.6 inch Gaming Laptop', 'High-performance gaming laptop.', 2, 'victus.jpg', 1499, 1199, 0.00, NULL, NULL, NULL, 0, '2025-01-06 19:48:56'),
(3, 'IPHONE 14 PRO MAX', 'iPhone 14 Pro Max – The Ultimate Smartphone Experience\r\n\r\nThe iPhone 14 Pro Max is Apple’s flagship device, offering an unrivaled combination of power, performance, and elegance. Featuring a stunning 6.7-inch Super Retina XDR display, it provides incredible clarity and color accuracy, whether you\'re streaming, gaming, or browsing. The ProMotion technology offers an ultra-smooth 120Hz refresh rate for an enhanced visual experience.', 1, 'https://cdsassets.apple.com/live/SZLF0YNV/images/sp/111846_sp875-sp876-iphone14-pro-promax.png', 3199, 3000, 0.00, NULL, NULL, NULL, 0, '2025-01-06 19:48:56'),
(4, 'Iphone 15 pro', 'The iPhone 15 is Apple’s latest flagship smartphone, offering a perfect blend of cutting-edge technology, elegant design, and powerful performance. Featuring a sleek aerospace-grade aluminum and glass body, the iPhone 15 is available in vibrant new colors. Equipped with advanced features, it delivers a next-level user experience for photography, entertainment, and connectivity', 1, 'https://hips.hearstapps.com/hmg-prod/images/index2-660d8cf65cd7f.jpg?crop=0.5xw:1xh;center,top&resize=640:*', 699, 499, 0.00, NULL, NULL, NULL, 0, '2025-01-06 19:48:56'),
(5, 'Smartwatch Pro', 'The Smartwatch Pro combines style, durability, and advanced technology in a sleek wearable. With its always-on display, fitness tracking, heart rate monitoring, and long-lasting battery life, it’s designed for both everyday use and intense workouts. Stay connected with notifications, music control, and GPS, all packed into a water-resistant, lightweight design. Perfect for those who want to elevate their lifestyle while staying on top of their health.', 3, 'https://www.valdus.com/wp-content/uploads/2023/05/2023052407360759d3a5430a1d9cc8.jpg', 299, 199, 0.00, NULL, NULL, NULL, 0, '2025-01-06 19:48:56'),
(6, 'Macbook Pro 16 inch', 'MacBook Pro 16-inch (M2 Pro / M2 Max)\r\nThe MacBook Pro 16-inch is a powerhouse designed for professionals who demand cutting-edge performance and unmatched portability. Built with Apple’s revolutionary M2 Pro or M2 Max chip, it delivers blazing-fast speeds, efficient multitasking, and incredible graphics performance for intensive tasks like video editing, 3D rendering, and software development.\r\n\r\nKey Features:\r\n16-inch Liquid Retina XDR Display: Stunning visuals with 1000 nits sustained brightness, P3 wide color gamut, and True Tone technology for true-to-life color accuracy.\r\nApple M2 Pro / M2 Max Chip: Up to a 12-core CPU and up to a 38-core GPU for ultimate performance.\r\nUnified Memory: Configurable up to 96GB, ensuring seamless performance even with demanding apps.\r\nFast Storage: Up to 8TB SSD for ultra-fast load times and ample storage.\r\nBattery Life: Up to 21 hours of video playback on a single charge, making it perfect for all-day work and travel.\r\nConnectivity: Includes three Thunderbolt 4 ports, an HDMI port, MagSafe 3 charging, and an SDXC card slot.\r\nAdvanced Audio System: Six-speaker sound system with force-cancelling woofers for immersive audio.\r\nmacOS: Experience the smooth, secure, and efficient operating system with regular updates and new features.', 2, 'https://macfinder.co.uk/product-images/Macbook/A2485/MacBook-Pro-Retina-16-Inch-41411.jpg', 2599, 2199, 0.00, NULL, NULL, NULL, 1, '2025-01-06 22:20:20');

-- --------------------------------------------------------

--
-- Table structure for table `product_colors`
--

CREATE TABLE `product_colors` (
  `id` int(10) UNSIGNED NOT NULL,
  `product_id` int(10) UNSIGNED DEFAULT NULL,
  `color` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `return_exchange_requests`
--

CREATE TABLE `return_exchange_requests` (
  `id` int(11) NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `product_id` int(10) UNSIGNED NOT NULL,
  `request_type` enum('Return','Exchange') NOT NULL,
  `reason` text NOT NULL,
  `status` enum('Pending','Approved','Rejected') DEFAULT 'Pending',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `return_exchange_requests`
--

INSERT INTO `return_exchange_requests` (`id`, `user_id`, `product_id`, `request_type`, `reason`, `status`, `created_at`) VALUES
(1, 4, 1, 'Exchange', 'want to return because the u giving me the wrong one..i buy for color red but I get yellow ', 'Approved', '2025-01-11 17:22:47');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('customer','admin') DEFAULT 'customer',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `password_hash` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `role`, `created_at`, `updated_at`, `password_hash`) VALUES
(1, 'NUR AIMAN FARIZZUAN', 'aimanfarizzuan1@gmail.com', '$2y$10$TxE.jbf/3AyCxO2QFw5XB.xqJM9ILs8q2XYlGhxDqU.Ap3Ejg.pTe', 'customer', '2024-12-18 19:24:10', '2024-12-18 19:24:10', ''),
(2, 'razin bin roslan', 'abdrais70@gmail.com', '$2y$10$hxSjhs2tLphccnO41Fx.eeKpbiJDustR2NkCctN/HtFLhJ2CxXfim', 'customer', '2025-01-02 19:09:20', '2025-01-02 19:09:20', ''),
(3, 'Adam', 'nuradam831@gmail.com', '$2y$10$.zvy61Lg1btz5adv7mnLEO7nXakK7ST5I1sB4kpI1/ge7Wgsso/8K', 'customer', '2025-01-10 02:04:27', '2025-01-10 02:04:27', ''),
(4, 'Nur Adam', 'nuradam0407@gmail.com', '$2y$10$U38bg9/7BHDUglzJXOs1oesX07FafC8A.w4xedSowzRvrxLUqCpJ2', 'customer', '2025-01-10 18:44:57', '2025-01-10 18:44:57', '');

-- --------------------------------------------------------

--
-- Table structure for table `verification_requests`
--

CREATE TABLE `verification_requests` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `request_type` varchar(100) DEFAULT NULL,
  `status` varchar(50) DEFAULT 'Pending',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`order_item_id`),
  ADD KEY `order_id` (`order_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `return_exchange_requests`
--
ALTER TABLE `return_exchange_requests`
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
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `order_item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `return_exchange_requests`
--
ALTER TABLE `return_exchange_requests`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`order_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
