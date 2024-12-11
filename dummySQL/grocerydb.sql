-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 10, 2024 at 03:06 PM
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
-- Database: `grocerydb`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `adminID` varchar(60) NOT NULL,
  `email` varchar(60) DEFAULT NULL,
  `salary` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`adminID`, `email`, `salary`) VALUES
('ADM001', 'admin@example.com', 50000.00),
('ADM002', 'admin2@example.com', 0.00);

-- --------------------------------------------------------

--
-- Table structure for table `carts`
--

CREATE TABLE `carts` (
  `productId` int(11) NOT NULL,
  `customeremail` varchar(60) NOT NULL,
  `productname` varchar(60) NOT NULL,
  `productamount` decimal(7,2) DEFAULT NULL,
  `price` decimal(10,2) NOT NULL,
  `selleremail` varchar(60) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `carts`
--

INSERT INTO `carts` (`productId`, `customeremail`, `productname`, `productamount`, `price`, `selleremail`) VALUES
(1, 'duck@duck.com', 'Fresh Tomato', 1.00, 2.99, 'seller1@example.com'),
(1, 'ducks@ducks', 'Fresh Tomato', 5.00, 2.99, 'seller1@example.com'),
(2, 'ducks@ducks', 'Crispy Lettuce', 1.00, 1.49, 'seller2@example.com'),
(14, 'duck@duck.com', 'Ripe Banana', 12.00, 0.99, 'seller2@example.com'),
(20, 'ducks@ducks', 'Chocolate Chip Cookies', 1.00, 3.49, 'seller2@example.com');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `customerID` varchar(60) NOT NULL,
  `email` varchar(60) DEFAULT NULL,
  `points` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`customerID`, `email`, `points`) VALUES
('CUS004', 'duck@duck.com', 14);

-- --------------------------------------------------------

--
-- Table structure for table `feedbacks`
--

CREATE TABLE `feedbacks` (
  `feedback_id` int(11) NOT NULL,
  `admin_email` varchar(60) NOT NULL,
  `message` text NOT NULL,
  `receiver_email` varchar(60) NOT NULL,
  `time` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `feedbacks`
--

INSERT INTO `feedbacks` (`feedback_id`, `admin_email`, `message`, `receiver_email`, `time`) VALUES
(1, 'admin1@example.com', 'Thank you for your report. We have resolved the issue.', 'john.doe@example.com', '2024-12-06 19:02:35'),
(2, 'admin2@example.com', 'We appreciate your feedback on the website performance.', 'jane.smith@example.com', '2024-12-06 19:02:35'),
(3, 'admin1@example.com', 'Thank you for bringing this to our attention.', 'alice.j@example.com', '2024-12-06 19:02:35');

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `transactionID` char(20) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `paid_amount` decimal(12,2) NOT NULL,
  `list_of_items` text NOT NULL,
  `payment_date` datetime NOT NULL,
  `expiry` date NOT NULL,
  `cvc` char(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`transactionID`, `email`, `paid_amount`, `list_of_items`, `payment_date`, `expiry`, `cvc`) VALUES
('0ab957508c4322f370a3', 'duck@duck.com', 75.70, 'Fresh Tomato ( 2.00 Kg ) 5.98$ ,Crispy Lettuce ( 2.00 Kg ) 2.98$ ,Organic Potato ( 2.00 Kg ) 6.98$ ,Sweet Orange ( 24.00 Pieces ) 59.76$ ,', '2024-12-05 18:29:51', '2025-10-21', '123'),
('51558eee1a63a12ea862', 'duck@duck.com', 15.94, 'Fresh Tomato ( 2.00 Kg ) 5.98$ ,Crispy Lettuce ( 2.00 Kg ) 2.98$ ,Organic Potato ( 2.00 Kg ) 6.98$ ,', '2024-12-05 18:17:07', '2025-10-21', '123'),
('6ad72eeb359aba42b4a3', 'duck@duck.com', 32.50, 'Fresh Tomato ( 4.00 Kg ) 11.96$ ,Crispy Lettuce ( 2.00 Kg ) 2.98$ ,Red Bell Pepper ( 2.00 Kg ) 6.58$ ,Whole Wheat Bread ( 1.50 Pounds ) 7.49$ ,Chocolate Chip Cookies ( 1.00 Pounds ) 3.49$ ,', '2024-12-05 18:15:00', '2025-10-21', '123'),
('9f6b58f66bcc6cbc6862', 'duck@duck.com', 1.49, 'Crispy Lettuce ( 1.00 Kg ) 1.49$ ,', '2024-12-05 18:28:40', '2025-10-21', '123'),
('b681295336703c5cfa67', 'duck@duck.com', 2.99, 'Fresh Tomato ( 1.00 Kg ) 2.99$ ,', '2024-12-05 18:27:48', '2025-10-21', '123'),
('bd8f9c1cdd844d2cec75', 'duck@duck.com', 11.02, 'Crispy Lettuce ( 0.50 Kg ) 0.75$ ,Organic Potato ( 2.00 Kg ) 6.98$ ,Red Bell Pepper ( 1.00 Kg ) 3.29$ ,', '2024-12-04 11:42:23', '2025-10-21', '123'),
('f6a0df9d8f1f66c7d6d7', 'duck@duck.com', 15.94, 'Fresh Tomato ( 2.00 Kg ) 5.98$ ,Crispy Lettuce ( 2.00 Kg ) 2.98$ ,Organic Potato ( 2.00 Kg ) 6.98$ ,', '2024-12-05 18:24:26', '2025-10-21', '123');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `productId` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `imgurl` varchar(60) DEFAULT NULL,
  `price` decimal(10,2) NOT NULL,
  `ammount` text DEFAULT NULL,
  `publishdate` date NOT NULL,
  `selleremail` varchar(60) DEFAULT NULL,
  `cartcount` int(11) DEFAULT NULL,
  `category` varchar(50) NOT NULL,
  `status` varchar(20) DEFAULT NULL,
  `rating` float DEFAULT NULL,
  `numOfPeople` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`productId`, `name`, `imgurl`, `price`, `ammount`, `publishdate`, `selleremail`, `cartcount`, `category`, `status`, `rating`, `numOfPeople`) VALUES
(1, 'Fresh Tomato', 'https://i.ibb.co/C1LWMsR/tomato.jpg', 2.99, 'wk,0.5,1,2', '2024-03-29', 'seller1@example.com', 59, 'Vegetables', 'published', 5, 179),
(2, 'Crispy Lettuce', 'https://i.ibb.co/MNGLvtk/lettuce.jpg', 1.49, 'wk,0.5,1,2', '2024-03-28', 'seller2@example.com', 15, 'Vegetables', 'published', 3.66, 39),
(3, 'Organic Potato', 'https://i.ibb.co/vqmQk8Z/potato.jpg', 3.49, 'wk,0.5,1,2', '2024-03-27', 'seller1@example.com', 7, 'Vegetables', 'published', 3, 657),
(13, 'Juicy Apple', 'https://i.ibb.co.com/JtCFHR3/apple.png', 1.99, 'p,4,10,12', '2024-03-25', 'seller2@example.com', 13, 'Fruits', 'published', 4, 169),
(14, 'Ripe Banana', 'https://i.ibb.co.com/Q62h0L4/banana.jpg', 0.99, 'p,4,10,12', '2024-03-24', 'seller2@example.com', 15, 'Fruits', 'published', 4.11, 874),
(15, 'Sweet Orange', 'https://i.ibb.co.com/9nGwsb2/orange.jpg', 2.49, 'p,4,10,12', '2024-03-23', 'seller1@example.com', 12, 'Fruits', 'published', 1.66667, 3),
(16, 'Fresh Carrot', 'https://i.ibb.co/BzC19cb/carrot.jpg', 1.49, 'wk,0.5,1,2', '2024-03-22', 'seller2@example.com', 21, 'Vegetables', 'published', 5, 695),
(17, 'Green Broccoli', 'https://i.ibb.co/N71pydr/broccoli.jpg', 2.99, 'wk,0.5,1,2', '2024-03-21', 'seller1@example.com', 18, 'Vegetables', 'pending', 4, 882),
(18, 'Red Bell Pepper', 'https://i.ibb.co/W6MQ5j2/pepper.jpg', 3.29, 'wk,0.5,1,2', '2024-03-20', 'seller1@example.com', 28, 'Vegetables', 'published', 1, 327),
(19, 'Whole Wheat Bread', 'https://i.ibb.co/pxxMTsK/bread.jpg', 4.99, 'wp,0.5,1,1.5', '2024-03-19', 'seller2@example.com', 9, 'Bakery', 'published', 1, 988),
(20, 'Chocolate Chip Cookies', 'https://i.ibb.co/Nmrv15C/cookies.jpg', 3.49, 'wp,0.5,1,1.5', '2024-03-18', 'seller2@example.com', 32, 'Bakery', 'published', 3, 958);

-- --------------------------------------------------------

--
-- Table structure for table `reports`
--

CREATE TABLE `reports` (
  `report_id` int(11) NOT NULL,
  `reporter_name` varchar(100) NOT NULL,
  `reporter_email` varchar(60) NOT NULL,
  `message` text NOT NULL,
  `time` datetime DEFAULT current_timestamp(),
  `replymessage` text DEFAULT '',
  `status` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reports`
--

INSERT INTO `reports` (`report_id`, `reporter_name`, `reporter_email`, `message`, `time`, `replymessage`, `status`) VALUES
(1, 'John Doe', 'john.doe@example.com', 'There is an issue with my order.', '2024-12-01 10:15:00', '', 1),
(2, 'Jane Smith', 'jane.smith@example.com', 'The website is loading slowly.', '2024-12-02 14:30:00', '', 1),
(3, 'Alice Johnson', 'alice.j@example.com', 'I found a bug in the payment page.', '2024-12-03 09:45:00', '', 0),
(4, 'duck', 'duck@duck.com', 'dgsdfgsdfg', '2024-12-06 21:48:54', '', 0),
(5, 'duck', 'duck@duck.com', 'nigga black heheh', '2024-12-06 21:51:34', '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `sellers`
--

CREATE TABLE `sellers` (
  `sellerID` varchar(60) NOT NULL,
  `email` varchar(60) DEFAULT NULL,
  `revenue` decimal(10,2) DEFAULT NULL,
  `numOfApproved` int(11) DEFAULT 0,
  `numOfReject` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sellers`
--

INSERT INTO `sellers` (`sellerID`, `email`, `revenue`, `numOfApproved`, `numOfReject`) VALUES
('SLR001', 'seller1@example.com', 10212.85, 4, 1),
('SLR002', 'seller2@example.com', 15097.02, 3, 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `role` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(60) NOT NULL,
  `password` varchar(20) NOT NULL,
  `phone_number` varchar(20) DEFAULT NULL,
  `gender` enum('Male','Female') DEFAULT NULL,
  `profileurl` varchar(100) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `ban_status` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`role`, `username`, `email`, `password`, `phone_number`, `gender`, `profileurl`, `address`, `ban_status`) VALUES
('admin', 'Admin two', 'admin2@example.com', 'aaa', '564654654654', 'Male', 'https://i.ibb.co.com/nbttrDz/PROFILE.png', 'Some where in planet earth', 1),
('admin', 'admin_user', 'admin@example.com', 'adminpass', '011001100112', 'Male', 'https://i.ibb.co.com/nbttrDz/PROFILE.png', '1234 Elm Street, Springfield, IL 62704, USA', 1),
('customer', 'duck', 'duck@duck.com', 'lol', '23155665478', 'Male', 'https://i.ibb.co.com/nbttrDz/PROFILE.png', '1234 Elm Street, Springfield, IL 62704, USA', 1),
('customer', 'duck', 'ducks@ducks', 'aaa', '23155665478', 'Male', 'https://i.ibb.co.com/nbttrDz/PROFILE.png', '1234 Elm Street, Springfield, IL 62704, USA', 1),
('seller', 'seller1', 'seller1@example.com', 'sellerpass', '565665563', 'Male', 'https://i.ibb.co.com/nbttrDz/PROFILE.png', '1234 Elm Street, Springfield, IL 62704, USA', 1),
('seller', 'seller2', 'seller2@example.com', 'sellerpass', '011001100112', 'Male', 'https://i.ibb.co.com/nbttrDz/PROFILE.png', '1234 Elm Street, Springfield, IL 62704, USA', 1);

-- --------------------------------------------------------

--
-- Table structure for table `wishlist`
--

CREATE TABLE `wishlist` (
  `productId` int(11) DEFAULT NULL,
  `customer_email` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `wishlist`
--

INSERT INTO `wishlist` (`productId`, `customer_email`) VALUES
(1, 'duck@duck.com'),
(14, 'duck@duck.com');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`adminID`),
  ADD KEY `email` (`email`);

--
-- Indexes for table `carts`
--
ALTER TABLE `carts`
  ADD PRIMARY KEY (`productId`,`customeremail`),
  ADD KEY `customeremail` (`customeremail`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`customerID`),
  ADD KEY `email` (`email`);

--
-- Indexes for table `feedbacks`
--
ALTER TABLE `feedbacks`
  ADD PRIMARY KEY (`feedback_id`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`transactionID`),
  ADD KEY `email` (`email`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`productId`),
  ADD KEY `selleremail` (`selleremail`);

--
-- Indexes for table `reports`
--
ALTER TABLE `reports`
  ADD PRIMARY KEY (`report_id`);

--
-- Indexes for table `sellers`
--
ALTER TABLE `sellers`
  ADD PRIMARY KEY (`sellerID`),
  ADD KEY `email` (`email`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `wishlist`
--
ALTER TABLE `wishlist`
  ADD KEY `productId` (`productId`),
  ADD KEY `customer_email` (`customer_email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `feedbacks`
--
ALTER TABLE `feedbacks`
  MODIFY `feedback_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `productId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `reports`
--
ALTER TABLE `reports`
  MODIFY `report_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `admins`
--
ALTER TABLE `admins`
  ADD CONSTRAINT `admins_ibfk_1` FOREIGN KEY (`email`) REFERENCES `users` (`email`);

--
-- Constraints for table `carts`
--
ALTER TABLE `carts`
  ADD CONSTRAINT `carts_ibfk_1` FOREIGN KEY (`productId`) REFERENCES `products` (`productId`),
  ADD CONSTRAINT `carts_ibfk_2` FOREIGN KEY (`customeremail`) REFERENCES `users` (`email`);

--
-- Constraints for table `customers`
--
ALTER TABLE `customers`
  ADD CONSTRAINT `customers_ibfk_1` FOREIGN KEY (`email`) REFERENCES `users` (`email`);

--
-- Constraints for table `payment`
--
ALTER TABLE `payment`
  ADD CONSTRAINT `payment_ibfk_1` FOREIGN KEY (`email`) REFERENCES `users` (`email`);

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`selleremail`) REFERENCES `users` (`email`);

--
-- Constraints for table `sellers`
--
ALTER TABLE `sellers`
  ADD CONSTRAINT `sellers_ibfk_1` FOREIGN KEY (`email`) REFERENCES `users` (`email`);

--
-- Constraints for table `wishlist`
--
ALTER TABLE `wishlist`
  ADD CONSTRAINT `wishlist_ibfk_1` FOREIGN KEY (`productId`) REFERENCES `products` (`productId`),
  ADD CONSTRAINT `wishlist_ibfk_2` FOREIGN KEY (`customer_email`) REFERENCES `users` (`email`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
