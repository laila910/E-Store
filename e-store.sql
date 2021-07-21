-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 21, 2021 at 04:13 PM
-- Server version: 10.4.19-MariaDB
-- PHP Version: 7.3.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `e-store`
--

-- --------------------------------------------------------

--
-- Table structure for table `addtocard`
--

CREATE TABLE `addtocard` (
  `id` int(11) NOT NULL,
  `customerId` int(11) NOT NULL,
  `carditem` int(11) NOT NULL COMMENT 'related to productid',
  `created_at` date NOT NULL DEFAULT current_timestamp(),
  `modified_at` date NOT NULL DEFAULT current_timestamp(),
  `quantity` int(11) NOT NULL,
  `session` bit(1) NOT NULL COMMENT 'add to order or not ',
  `orderid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `usersid` int(11) NOT NULL,
  `productid` int(11) NOT NULL COMMENT 'to connect with product table to make change with the status of the product or add product or remove ',
  `permissions` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `brand`
--

CREATE TABLE `brand` (
  `brand_Id` int(11) NOT NULL,
  `brandName` varchar(50) NOT NULL,
  `brandDescription` text NOT NULL,
  `brandImage` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `categoreis`
--

CREATE TABLE `categoreis` (
  `id` int(11) NOT NULL,
  `categoryname` varchar(250) NOT NULL,
  `description` text NOT NULL,
  `ordering` tinyint(4) NOT NULL COMMENT 'order the category as I wish anytime',
  `Active` tinyint(4) NOT NULL DEFAULT 0 COMMENT 'make visible or not',
  `category_made_date` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` int(11) NOT NULL,
  `usersid` int(11) NOT NULL,
  `address` varchar(250) NOT NULL,
  `country` varchar(100) NOT NULL,
  `city` varchar(100) NOT NULL,
  `state` varchar(100) NOT NULL,
  `zipCode` int(11) NOT NULL,
  `anotheraddress` varchar(250) DEFAULT NULL,
  `creditcard` varchar(250) NOT NULL,
  `creditcardtypeid` int(11) NOT NULL,
  `cardExpMon` int(11) NOT NULL,
  `cardExpYr` int(11) NOT NULL,
  `shipaddress` varchar(250) NOT NULL,
  `shipcountry` varchar(100) NOT NULL,
  `shipcity` varchar(100) NOT NULL,
  `shipstate` varchar(100) NOT NULL,
  `shipzipcode` int(11) NOT NULL,
  `dateRegistered` date NOT NULL DEFAULT current_timestamp(),
  `billingaddress` varchar(250) NOT NULL,
  `billingcountry` varchar(100) NOT NULL,
  `billingcity` varchar(100) NOT NULL,
  `billingstate` varchar(100) NOT NULL,
  `billingzipcode` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `manager`
--

CREATE TABLE `manager` (
  `id_manager` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `noofproducts` int(11) NOT NULL COMMENT 'indicate the no of product to order from the suppliers ',
  `lackOfProducts` bit(1) NOT NULL COMMENT 'there is lack of no of products yes or no',
  `userid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='still will be added more columns for what the manger do ';

-- --------------------------------------------------------

--
-- Table structure for table `orderdetailes`
--

CREATE TABLE `orderdetailes` (
  `id` int(11) NOT NULL,
  `ordernumber` int(11) NOT NULL,
  `shippingcost` int(11) NOT NULL,
  `quntity` int(11) NOT NULL,
  `discount` int(11) NOT NULL,
  `totalprice` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `orderproducts`
--

CREATE TABLE `orderproducts` (
  `id` int(11) NOT NULL,
  `orderdetails_id` int(11) NOT NULL,
  `productdetails_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `paymentId` int(11) NOT NULL,
  `orderdate` date NOT NULL DEFAULT current_timestamp(),
  `shipdate` date NOT NULL,
  `requireddate` date NOT NULL COMMENT 'the time of order from order to delivery',
  `shipperId` int(11) NOT NULL,
  `salestax` int(11) NOT NULL,
  `paid` bit(1) NOT NULL COMMENT 'the paid is done or not',
  `paymentdate` date NOT NULL,
  `delivered` bit(1) NOT NULL COMMENT 'the order delivered or not',
  `orderlocation` text NOT NULL COMMENT 'the address to deliver the order',
  `ordercanceled` bit(1) NOT NULL COMMENT 'the customer canceled the order or not '
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `ordershipper`
--

CREATE TABLE `ordershipper` (
  `id` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `companyname` varchar(250) NOT NULL,
  `Shipping Method` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `paymentmethod`
--

CREATE TABLE `paymentmethod` (
  `id` int(11) NOT NULL,
  `paymentType` varchar(250) NOT NULL,
  `paymentAllowed` bit(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `product_Id` int(11) NOT NULL,
  `details_id` int(11) NOT NULL,
  `productname` varchar(250) NOT NULL,
  `product_cat_id` int(11) NOT NULL,
  `product_brand_id` int(11) NOT NULL,
  `product_status` varchar(100) NOT NULL COMMENT 'New ,Old ,used',
  `featured` tinyint(4) NOT NULL DEFAULT 0 COMMENT 'to make the product featured (1) or not (0)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `productcolor`
--

CREATE TABLE `productcolor` (
  `id` int(11) NOT NULL,
  `white` bit(1) NOT NULL,
  `black` bit(1) NOT NULL,
  `blue` bit(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `productcolorcheck`
--

CREATE TABLE `productcolorcheck` (
  `id` int(11) NOT NULL,
  `productcolor_id` int(11) NOT NULL,
  `productdetails_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `productdetails`
--

CREATE TABLE `productdetails` (
  `id` int(11) NOT NULL,
  `productPrice` int(11) NOT NULL,
  `productQuntity` int(11) NOT NULL,
  `product_Description` text NOT NULL,
  `product_Specificaton` text NOT NULL,
  `Review_id` int(11) NOT NULL,
  `unitsInStock` int(11) NOT NULL,
  `Discount` int(11) NOT NULL,
  `productAvailablity` bit(1) NOT NULL COMMENT 'yes or no',
  `discountAvailablity` bit(1) NOT NULL,
  `productMadeDate` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `productimges`
--

CREATE TABLE `productimges` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `firstimage` varchar(250) NOT NULL,
  `secondimage` varchar(250) NOT NULL,
  `thirdimage` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `productreview`
--

CREATE TABLE `productreview` (
  `id_review` int(11) NOT NULL,
  `ranking_review` int(11) NOT NULL,
  `reviewerName` varchar(250) NOT NULL,
  `reviewerEmail` varchar(250) NOT NULL,
  `reviewerComment` text NOT NULL,
  `review_Made_Date` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `productsizecheck`
--

CREATE TABLE `productsizecheck` (
  `id` int(11) NOT NULL,
  `size_id` int(11) NOT NULL,
  `productdetails_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `productsizes`
--

CREATE TABLE `productsizes` (
  `id_size` int(11) NOT NULL,
  `S` varchar(50) NOT NULL,
  `M` varchar(50) NOT NULL,
  `L` varchar(50) NOT NULL,
  `XL` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `suppliers`
--

CREATE TABLE `suppliers` (
  `id` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `companyname` varchar(250) NOT NULL,
  `firstaddress` text NOT NULL,
  `secondaddress` text NOT NULL,
  `city` varchar(100) NOT NULL,
  `state` varchar(100) NOT NULL,
  `zipCode` int(11) NOT NULL,
  `fax` int(11) NOT NULL,
  `URL` varchar(250) NOT NULL,
  `paymentmethods` varchar(250) NOT NULL,
  `discount` int(11) NOT NULL,
  `notes` text NOT NULL,
  `discountavailable` bit(1) NOT NULL,
  `logoimage` varchar(250) NOT NULL,
  `currentorder` text NOT NULL,
  `managerid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `firstName` varchar(50) NOT NULL,
  `lastName` varchar(50) NOT NULL,
  `email` varchar(250) NOT NULL,
  `mobileNo` int(11) NOT NULL,
  `password` text NOT NULL,
  `group_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `usersgroup`
--

CREATE TABLE `usersgroup` (
  `id` int(11) NOT NULL,
  `Group` varchar(100) NOT NULL COMMENT 'to identify the user Type '
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `whishlist`
--

CREATE TABLE `whishlist` (
  `id` int(11) NOT NULL,
  `productid` int(11) NOT NULL COMMENT 'to connect with the product details table ',
  `quantity` int(11) NOT NULL COMMENT 'the no of product that the user is wanted ',
  `customerid` int(11) NOT NULL,
  `addtocard` bit(1) NOT NULL COMMENT 'to add to card or not '
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `brand`
--
ALTER TABLE `brand`
  ADD PRIMARY KEY (`brand_Id`);

--
-- Indexes for table `categoreis`
--
ALTER TABLE `categoreis`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `usersid` (`usersid`);

--
-- Indexes for table `manager`
--
ALTER TABLE `manager`
  ADD PRIMARY KEY (`id_manager`),
  ADD KEY `userid` (`userid`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `orderdetailes`
--
ALTER TABLE `orderdetailes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ordernumber` (`ordernumber`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `paymentId` (`paymentId`),
  ADD KEY `shipperId` (`shipperId`);

--
-- Indexes for table `ordershipper`
--
ALTER TABLE `ordershipper`
  ADD PRIMARY KEY (`id`),
  ADD KEY `userid` (`userid`);

--
-- Indexes for table `paymentmethod`
--
ALTER TABLE `paymentmethod`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`product_Id`),
  ADD KEY `productdetails_id` (`details_id`);

--
-- Indexes for table `productcolor`
--
ALTER TABLE `productcolor`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `productdetails`
--
ALTER TABLE `productdetails`
  ADD PRIMARY KEY (`id`),
  ADD KEY `Review_id` (`Review_id`);

--
-- Indexes for table `productreview`
--
ALTER TABLE `productreview`
  ADD PRIMARY KEY (`id_review`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `group_id` (`group_id`);

--
-- Indexes for table `usersgroup`
--
ALTER TABLE `usersgroup`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `whishlist`
--
ALTER TABLE `whishlist`
  ADD PRIMARY KEY (`id`),
  ADD KEY `productid` (`productid`),
  ADD KEY `customerid` (`customerid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `brand`
--
ALTER TABLE `brand`
  MODIFY `brand_Id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `categoreis`
--
ALTER TABLE `categoreis`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `manager`
--
ALTER TABLE `manager`
  MODIFY `id_manager` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `orderdetailes`
--
ALTER TABLE `orderdetailes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ordershipper`
--
ALTER TABLE `ordershipper`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `paymentmethod`
--
ALTER TABLE `paymentmethod`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `product_Id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `productcolor`
--
ALTER TABLE `productcolor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `productdetails`
--
ALTER TABLE `productdetails`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `productreview`
--
ALTER TABLE `productreview`
  MODIFY `id_review` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `usersgroup`
--
ALTER TABLE `usersgroup`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `whishlist`
--
ALTER TABLE `whishlist`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `customers`
--
ALTER TABLE `customers`
  ADD CONSTRAINT `users type relation` FOREIGN KEY (`usersid`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `manager`
--
ALTER TABLE `manager`
  ADD CONSTRAINT `product Relationsss` FOREIGN KEY (`product_id`) REFERENCES `product` (`product_Id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `users types relation` FOREIGN KEY (`userid`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `orderdetailes`
--
ALTER TABLE `orderdetailes`
  ADD CONSTRAINT `order relation` FOREIGN KEY (`ordernumber`) REFERENCES `orders` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `payment relation` FOREIGN KEY (`paymentId`) REFERENCES `paymentmethod` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `shipper relation` FOREIGN KEY (`shipperId`) REFERENCES `ordershipper` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `ordershipper`
--
ALTER TABLE `ordershipper`
  ADD CONSTRAINT `user relationn` FOREIGN KEY (`userid`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `product Detailss Relation` FOREIGN KEY (`details_id`) REFERENCES `productdetails` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `productdetails`
--
ALTER TABLE `productdetails`
  ADD CONSTRAINT `Review Relation` FOREIGN KEY (`Review_id`) REFERENCES `productreview` (`id_review`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `Group Relation` FOREIGN KEY (`group_id`) REFERENCES `usersgroup` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `whishlist`
--
ALTER TABLE `whishlist`
  ADD CONSTRAINT `customer relation` FOREIGN KEY (`customerid`) REFERENCES `customers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `product details relationss` FOREIGN KEY (`productid`) REFERENCES `productdetails` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
