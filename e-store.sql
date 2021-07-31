-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 31, 2021 at 10:30 PM
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
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `modified_at` datetime NOT NULL DEFAULT current_timestamp(),
  `quantity` int(11) NOT NULL,
  `session` varchar(50) DEFAULT 'no' COMMENT 'add to order or not yes or no '
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `brand`
--

CREATE TABLE `brand` (
  `brand_Id` int(11) NOT NULL,
  `brandName` varchar(50) NOT NULL,
  `brandImage` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `brand`
--

INSERT INTO `brand` (`brand_Id`, `brandName`, `brandImage`) VALUES
(3, 'IndiaCapital', '19052986471627678539.png'),
(4, 'Paprlinx', '10902880711627678560.png'),
(5, 'InfraRed', '4878565531627678610.png'),
(6, 'Erlang', '18571771751627678630.png'),
(7, 'SportEngland', '11426993731627678665.png'),
(8, 'QUINTILES', '4728845621627731876.png');

-- --------------------------------------------------------

--
-- Table structure for table `categoreis`
--

CREATE TABLE `categoreis` (
  `id` int(11) NOT NULL,
  `categoryname` varchar(250) NOT NULL,
  `description` text NOT NULL,
  `ordering` tinyint(4) NOT NULL COMMENT 'order the category as I wish anytime',
  `Active` tinyint(4) NOT NULL DEFAULT 1 COMMENT 'make visible 1 or not 2',
  `category_made_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `categoreis`
--

INSERT INTO `categoreis` (`id`, `categoryname`, `description`, `ordering`, `Active`, `category_made_date`) VALUES
(1, 'FootWear', 'it contains alot of footwears like Athletic,sneakers,wedges,Ballerina,Boots,Sandals,Slippers and Socks.', 1, 0, '2021-07-23 01:02:27'),
(2, 'Clothing', 'it contains alot of Women clothing like T-Shirt,Blouses,Shirts,Dresses,Jeans&Pants,Leggings,Skirts,Swimwear,Sleepwear,Lingerie,Hoodies&Sweatshirts and Jackets&Coats.', 2, 0, '2021-07-23 01:02:27'),
(3, 'Watches', 'it contains alot of Watches like Casual Watches,Dress Watches,Stainless steel watches and Leather Watches.', 3, 0, '2021-07-23 01:04:27'),
(4, 'Jewelry', 'it contains alot of Earrings,Bracelets,Rings,Jewelry sets,Fine Jewelry and Necklaces.', 4, 0, '2021-07-23 01:02:27'),
(5, 'Bags & Accessories', 'it contains alot of Hand Bags,Cross Body bags,Clutches,BackPacks and Wallets.', 5, 0, '2021-07-23 01:02:27'),
(6, 'Eyewear', 'it contains alot of Sunglasses,Aviator,Cat Eye and Optical Frames.', 6, 0, '2021-07-23 01:02:27');

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

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `usersid`, `address`, `country`, `city`, `state`, `zipCode`, `anotheraddress`, `creditcard`, `creditcardtypeid`, `cardExpMon`, `cardExpYr`, `shipaddress`, `shipcountry`, `shipcity`, `shipstate`, `shipzipcode`, `dateRegistered`, `billingaddress`, `billingcountry`, `billingcity`, `billingstate`, `billingzipcode`) VALUES
(1, 3, 'dsdsssss', 'egypt', 'cairo', 'cairo', 1234, 'sssssssssss', 'visa', 1234, 9, 2022, 'st1 shubra', 'egypt', 'cairo', 'cairo', 1234, '0000-00-00', 'shubra', 'Egypt', 'cairo', 'egypt', 987),
(2, 3, 'ddddddddddd', 'ffffffffff', 'dffffffffffff', 'gggggggggggg', 1234, 'Null', 'paypal', 1234, 9, 2023, 'fffffffffff', 'Egypt', 'cairo', 'shubra', 1234, '0000-00-00', 'shubra 1 st m7md ali', 'egypt', 'cairo', 'Giza', 987),
(4, 3, '1st Shubra', 'Egypt', 'El-Nour City', 'Cairo', 12345, '1st Mohamed Ali', 'Visa', 456, 9, 2022, '1st Magdy Ameen', 'Egypt', 'Shubra Elkhaima', 'Cairo', 23456, '2021-07-30', '1st El-Game3', 'Egypt', 'Shubra', 'Cairo', 55678);

-- --------------------------------------------------------

--
-- Table structure for table `manager`
--

CREATE TABLE `manager` (
  `id_manager` int(11) NOT NULL,
  `supplierid` int(11) NOT NULL,
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
  `card_id` int(11) NOT NULL,
  `paymentId` int(11) NOT NULL,
  `orderdate` datetime NOT NULL DEFAULT current_timestamp(),
  `shipdate` date NOT NULL,
  `requireddate` date NOT NULL COMMENT 'the time of order from order to delivery',
  `shipperId` int(11) NOT NULL,
  `salestax` int(11) NOT NULL,
  `paid` varchar(10) NOT NULL DEFAULT 'no' COMMENT 'the paid is done yes or not no',
  `paymentdate` date NOT NULL,
  `delivered` varchar(10) NOT NULL DEFAULT 'no' COMMENT 'the order delivered or not ,yes for deliver, for not no ',
  `ordercanceled` varchar(50) NOT NULL DEFAULT 'no' COMMENT 'the customer no for not ,yes for canceled the order or not '
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `ordershipper`
--

CREATE TABLE `ordershipper` (
  `id` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `companyname` varchar(250) NOT NULL,
  `ShippingMethod` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ordershipper`
--

INSERT INTO `ordershipper` (`id`, `userid`, `companyname`, `ShippingMethod`) VALUES
(8, 8, 'deliveryE-store', 'overland'),
(9, 8, 'RoyalShipping', 'overland');

-- --------------------------------------------------------

--
-- Table structure for table `paymentmethod`
--

CREATE TABLE `paymentmethod` (
  `id` int(11) NOT NULL,
  `paymentType` varchar(250) NOT NULL,
  `paymentAllowed` varchar(1) NOT NULL COMMENT 'yes or no'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `paymentmethod`
--

INSERT INTO `paymentmethod` (`id`, `paymentType`, `paymentAllowed`) VALUES
(2, 'Visa', 'Y'),
(3, 'Paypal', 'y');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `productname` varchar(250) NOT NULL,
  `product_cat_id` int(11) NOT NULL,
  `product_brand_id` int(11) NOT NULL,
  `product_status` varchar(100) NOT NULL COMMENT 'New ,Old ,used',
  `featured` varchar(50) NOT NULL COMMENT 'to make the product featured (1)True or not (0)false'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `productname`, `product_cat_id`, `product_brand_id`, `product_status`, `featured`) VALUES
(61, 'man T-shirt', 2, 5, 'New', 'true'),
(62, 'man T-shirt', 2, 4, 'New', 'true'),
(63, 'High-Cuff Textile Lace-Up', 1, 6, 'New', 'true'),
(64, 'Ballerina Shoes', 1, 5, 'New', 'false'),
(65, 'Contrast Sole Embossed Faux Leather Slip-On Shoes', 1, 3, 'New', 'true'),
(66, 'Contrast Stripe Textile Slip-On Shoes', 1, 3, 'New', 'true'),
(67, 'Salerno Two-Tone Faux-Leather Lace-up Sneakers', 1, 4, 'New', 'false'),
(68, 'Patterned Textile Lace-Up Sneakers', 1, 6, 'New', 'false'),
(69, 'Braided Raffia Sole Faux Leather Espadrille Shoes', 1, 7, 'New', 'true'),
(70, 'Chunky Sole Nubuck Lace-Up Sneakers', 1, 7, 'New', 'false'),
(71, 'Faux-Leather Stone Detail Ballerina Shoes', 1, 8, 'New', 'false'),
(72, 'Faux-Leather Ribbon Detail Flat Ballerina', 1, 7, 'New', 'false');

-- --------------------------------------------------------

--
-- Table structure for table `productcolor`
--

CREATE TABLE `productcolor` (
  `id` int(11) NOT NULL,
  `firstcolor` varchar(50) NOT NULL,
  `secondcolor` varchar(50) NOT NULL,
  `thirdcolor` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `productcolor`
--

INSERT INTO `productcolor` (`id`, `firstcolor`, `secondcolor`, `thirdcolor`) VALUES
(2, 'red', ' brown', 'white'),
(3, 'blue', 'white', 'black'),
(4, 'white', ' pink', 'Black'),
(5, 'Black', ' Havan', 'Light Purple'),
(6, 'Beige', ' Pink', 'white'),
(7, 'Beige', ' white', 'Black'),
(8, 'White and Mint', ' White and Cashmere', 'White and Purple'),
(9, 'Beige', ' white', 'Black'),
(10, 'Blue', ' Dark Blue', 'Red'),
(11, 'Light Grey and Blue', ' Rose', 'white'),
(12, 'Nude', ' Camel', 'Black'),
(13, 'Nude', ' Camel', 'Black'),
(14, 'Nude', ' Red', 'Navy');

-- --------------------------------------------------------

--
-- Table structure for table `productdetails`
--

CREATE TABLE `productdetails` (
  `id` int(11) NOT NULL,
  `product_Id` int(11) NOT NULL,
  `color_id` int(11) NOT NULL,
  `size_id` int(11) NOT NULL,
  `productPrice` int(11) NOT NULL,
  `productQuntity` int(11) NOT NULL,
  `product_Description` text NOT NULL,
  `product_Specificaton` text NOT NULL,
  `Review_id` int(11) NOT NULL DEFAULT 1,
  `unitsInStock` int(11) NOT NULL,
  `Discount` int(11) NOT NULL,
  `productAvailablity` varchar(50) NOT NULL COMMENT 'yes or no',
  `discountAvailablity` varchar(50) NOT NULL COMMENT 'there is discount yes or no',
  `productMadeDate` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `productdetails`
--

INSERT INTO `productdetails` (`id`, `product_Id`, `color_id`, `size_id`, `productPrice`, `productQuntity`, `product_Description`, `product_Specificaton`, `Review_id`, `unitsInStock`, `Discount`, `productAvailablity`, `discountAvailablity`, `productMadeDate`) VALUES
(17, 61, 2, 1, 350, 1, 'Believe in yourself Long Sleeves T-Shirt', 'fffffffffffffffffffffffffggggggggggggggggggggggggsdgggggggggggggggggggg', 1, 870, 50, 'true', 'false', '2021-07-20 00:46:37'),
(18, 62, 3, 2, 145, 1, 'Brand: Other Item Type: T-Shirt Material: Cotton', 'fffffffffffffffffffffffffggggggggggggggggggggggggsdgggggggggggggggggggg', 1, 987, 50, 'true', 'false', '2021-07-31 00:47:11'),
(19, 63, 4, 3, 290, 1, 'Sneakers Chunky sole For Women Lace-up design', 'Package thickness29.6 centimeters Package weight in KGs712 grams MaterialFaux Leather Country of originEG StyleFashion Sneakers OccasionCasual Shoe', 1, 200, 50, 'true', 'false', '2021-07-31 16:33:29'),
(20, 64, 5, 5, 130, 1, 'Grinta Leather Quilted Flat Round toe Ballerina Shoes for Women', 'Package thickness27.2 centimeters Package weight in KGs312 grams MaterialLeather Country of originEG Targeted GroupWomen StyleBallerina OccasionCasual Shoe', 1, 345, 50, 'true', 'false', '2021-07-31 17:32:09'),
(21, 65, 6, 6, 260, 1, 'Type Slip-on shoes Low cut design Padded cuffs', 'Package thickness28 centimeters Package weight in KGs740 grams MaterialFaux Leather Country of originEG', 1, 678, 100, 'true', 'true', '2021-07-31 19:16:15'),
(22, 66, 7, 1, 290, 1, 'Chunky sole Slip-on design Type Sneakers', 'Package thickness28.2 centimeters Package weight in KGs740 grams MaterialFaux Leather Country of originEG Targeted GroupWomen StyleFashion Sneakers', 1, 345, 10, 'true', 'false', '2021-07-31 19:22:46'),
(23, 67, 8, 1, 129, 1, 'Type Lace up sneakers Two tone design Perforated upper Round toe', 'Package thickness31.8 centimeters Package weight in KGs740 grams MaterialFaux Leather Country of originEG  StyleFashion Sneakers', 1, 469, 100, 'true', 'false', '2021-07-31 19:30:14'),
(24, 68, 9, 9, 290, 1, 'Type Sneakers Targeted Group Women Chunky sole Lace-up design', 'Package thickness28.2 centimeters Package weight in KGs716 grams MaterialTextile Country of originEG Size39 EU', 1, 200, 100, 'true', 'true', '2021-07-31 19:33:59'),
(25, 69, 10, 10, 349, 1, 'Type Espadrille Shoes Flat design Front logo', 'Package thickness27.2 centimeters Package weight in KGs514 grams MaterialFaux Leather Country of originCN StyleEspadrille', 1, 345, 100, 'true', 'false', '2021-07-31 19:38:56'),
(26, 70, 11, 11, 350, 1, 'Type Sneakers Tongue logo Stitched detail', 'Package thickness29.6 centimeters Package weight in KGs1050 grams MaterialNubuck Country of originEG', 1, 987, 49, 'true', 'true', '2021-07-31 19:42:43'),
(27, 71, 12, 12, 289, 1, 'Type Ballerina shoes Square toe Upper contrast stone detail Flat design Side metal logo detail', 'Package thickness29.2 centimeters Package weight in KGs544 grams MaterialFaux Leather Country of originCN', 1, 432, 150, 'true', 'false', '2021-07-31 19:47:17'),
(28, 71, 13, 12, 289, 1, 'Type Ballerina shoes Square toe Upper contrast stone detail Flat design Side metal logo detail', 'Package thickness29.2 centimeters Package weight in KGs544 grams MaterialFaux Leather Country of originCN', 1, 345, 100, 'true', 'false', '2021-07-31 19:51:52'),
(29, 72, 14, 13, 339, 1, 'Ballerina shoes Round toe Stitched ribbon detail Flat design Gold metal detail Patent cap toe', 'Package thickness15.4 centimeters Package weight in KGs394 grams MaterialFaux Leather Country of originCN', 1, 322, 49, 'true', 'true', '2021-07-31 19:55:14');

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

--
-- Dumping data for table `productimges`
--

INSERT INTO `productimges` (`id`, `product_id`, `firstimage`, `secondimage`, `thirdimage`) VALUES
(11, 17, '14253344431627737103.jpg', '5165310111627734098.jpg', '10247205551627734098.jpg'),
(12, 18, '6294961701627737093.jpg', '9165054581627737078.jpg', '11987179041627737078.jpg'),
(13, 19, '9707370681627742077.jpg', '6063026741627742077.jpg', '9725716451627742077.jpg'),
(14, 20, '18428586911627745578.jpg', '15099004531627745578.jpg', '400956201627745578.jpg'),
(15, 21, '18560048941627751885.jpg', '6982966771627751885.jpg', '10883085171627751885.jpg'),
(16, 22, '20590097841627752215.jpg', '10865420141627752215.jpg', '20572242491627752215.jpg'),
(17, 23, '20023171811627752663.jpg', '15276802351627752663.jpg', '15794825731627752663.jpg'),
(18, 24, '6760038351627752895.jpg', '971048831627752895.jpg', '1214071791627752895.jpg'),
(19, 25, '430171091627753166.jpg', '6953543441627753166.jpg', '12961021251627753166.jpg'),
(20, 26, '12547127201627753412.jpg', '7709748401627753412.jpg', '19079576781627753412.jpg'),
(21, 27, '2247261961627753686.jpg', '14285976311627753686.jpg', '21123510811627753686.jpg'),
(23, 29, '9023477711627754162.jpg', '11374680511627754162.jpg', '11500181871627754162.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `productreview`
--

CREATE TABLE `productreview` (
  `id_review` int(11) NOT NULL,
  `ranking_review` int(11) NOT NULL,
  `reviewerName` varchar(50) NOT NULL,
  `reviewerEmail` varchar(250) NOT NULL,
  `reviewerComment` text NOT NULL,
  `review_Made_Date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `productreview`
--

INSERT INTO `productreview` (`id_review`, `ranking_review`, `reviewerName`, `reviewerEmail`, `reviewerComment`, `review_Made_Date`) VALUES
(1, 1, 'Ahmed', 'ahmed123@yahoo.com', 'This product is wonderful', '2021-07-23 00:00:00'),
(3, 2, 'Laila', 'lailaibrahim798@gmail.com', 'This website is more helpful ,easier ,more professional and Its products more great', '2021-07-31 01:11:34');

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

--
-- Dumping data for table `productsizes`
--

INSERT INTO `productsizes` (`id_size`, `S`, `M`, `L`, `XL`) VALUES
(1, 'S', 'M', 'Null', 'XL'),
(2, 'S', 'M', 'L', 'Null'),
(3, 'S', 'NULL', 'L', 'XL'),
(5, 'S', 'M', 'L', 'XL'),
(6, 'S', 'M', 'L', 'Null'),
(7, 'S', 'M', 'L', 'XL'),
(8, 'S', 'M', 'L', 'XL'),
(9, 'S', 'M', 'Null', 'XL'),
(10, 'S', 'M', 'L', 'XL'),
(11, 'S', 'M', 'L', 'XL'),
(12, 'S', 'M', 'L', 'XL'),
(13, 'S', 'NULL', 'L', 'XL');

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
  `currentorder` text NOT NULL
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

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `firstName`, `lastName`, `email`, `mobileNo`, `password`, `group_id`) VALUES
(3, 'Laila', 'Ibrahim', 'lailaibrahim798@gmail.com', 2147483647, '123456789', 3),
(4, 'Omran', 'Ahmed', 'Omar87@yahoo.com', 1147483647, '12345670999', 3),
(6, 'Laila', 'Ibrahim', 'laila_ebrahim975@yahoo.com', 1124173098, '123456', 2),
(7, 'Mohamed', 'Alaa', 'mohamed7@gmail.com', 1124173089, '123456', 2),
(8, 'Ahmed', 'Gamal', 'ahmed09@gmail.com', 1124173089, '123456', 3),
(9, 'Mohamed', 'Ali', 'mohamed98@yahoo.com', 1124188089, '123456', 8),
(10, 'test root', 'Mahmoud', 'lailaibrahim798@gmail.com', 2147483647, 'f33e462219d100a8a98d81c464558ddba17ebd7b', 2);

-- --------------------------------------------------------

--
-- Table structure for table `usersgroup`
--

CREATE TABLE `usersgroup` (
  `id` int(11) NOT NULL,
  `Group` varchar(100) NOT NULL COMMENT 'to identify the user Type '
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `usersgroup`
--

INSERT INTO `usersgroup` (`id`, `Group`) VALUES
(2, 'Admin'),
(3, 'customers'),
(4, 'manager'),
(6, 'suppliers'),
(8, 'ordershipper');

-- --------------------------------------------------------

--
-- Table structure for table `whishlist`
--

CREATE TABLE `whishlist` (
  `id` int(11) NOT NULL,
  `productid` int(11) NOT NULL COMMENT 'to connect with the product details table ',
  `quantity` int(11) NOT NULL COMMENT 'the no of product that the user is wanted ',
  `customerid` int(11) NOT NULL,
  `addtocard` varchar(50) NOT NULL DEFAULT 'no' COMMENT 'to add to card or not yes or no '
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `addtocard`
--
ALTER TABLE `addtocard`
  ADD PRIMARY KEY (`id`),
  ADD KEY `customerId` (`customerId`),
  ADD KEY `carditem` (`carditem`);

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
  ADD KEY `product_id` (`product_id`),
  ADD KEY `supplierid` (`supplierid`);

--
-- Indexes for table `orderdetailes`
--
ALTER TABLE `orderdetailes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ordernumber` (`ordernumber`);

--
-- Indexes for table `orderproducts`
--
ALTER TABLE `orderproducts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `orderdetails_id` (`orderdetails_id`),
  ADD KEY `productdetails_id` (`productdetails_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `paymentId` (`paymentId`),
  ADD KEY `shipperId` (`shipperId`),
  ADD KEY `card_id` (`card_id`);

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
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_cat_id` (`product_cat_id`),
  ADD KEY `product_brand_id` (`product_brand_id`);

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
  ADD KEY `Review_id` (`Review_id`),
  ADD KEY `product_Id` (`product_Id`),
  ADD KEY `color_id` (`color_id`),
  ADD KEY `size_id` (`size_id`);

--
-- Indexes for table `productimges`
--
ALTER TABLE `productimges`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `productreview`
--
ALTER TABLE `productreview`
  ADD PRIMARY KEY (`id_review`);

--
-- Indexes for table `productsizes`
--
ALTER TABLE `productsizes`
  ADD PRIMARY KEY (`id_size`);

--
-- Indexes for table `suppliers`
--
ALTER TABLE `suppliers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `userid` (`userid`);

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
-- AUTO_INCREMENT for table `addtocard`
--
ALTER TABLE `addtocard`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `brand`
--
ALTER TABLE `brand`
  MODIFY `brand_Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `categoreis`
--
ALTER TABLE `categoreis`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `manager`
--
ALTER TABLE `manager`
  MODIFY `id_manager` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `orderdetailes`
--
ALTER TABLE `orderdetailes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `orderproducts`
--
ALTER TABLE `orderproducts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `ordershipper`
--
ALTER TABLE `ordershipper`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `paymentmethod`
--
ALTER TABLE `paymentmethod`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;

--
-- AUTO_INCREMENT for table `productcolor`
--
ALTER TABLE `productcolor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `productdetails`
--
ALTER TABLE `productdetails`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `productimges`
--
ALTER TABLE `productimges`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `productreview`
--
ALTER TABLE `productreview`
  MODIFY `id_review` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `productsizes`
--
ALTER TABLE `productsizes`
  MODIFY `id_size` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `suppliers`
--
ALTER TABLE `suppliers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `usersgroup`
--
ALTER TABLE `usersgroup`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `whishlist`
--
ALTER TABLE `whishlist`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `addtocard`
--
ALTER TABLE `addtocard`
  ADD CONSTRAINT `customer relationss` FOREIGN KEY (`customerId`) REFERENCES `customers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `productss Relationsss` FOREIGN KEY (`carditem`) REFERENCES `productdetails` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `customers`
--
ALTER TABLE `customers`
  ADD CONSTRAINT `users type relation` FOREIGN KEY (`usersid`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `manager`
--
ALTER TABLE `manager`
  ADD CONSTRAINT `product Relationsss` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `shipper relationss` FOREIGN KEY (`supplierid`) REFERENCES `suppliers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `users types relation` FOREIGN KEY (`userid`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `orderdetailes`
--
ALTER TABLE `orderdetailes`
  ADD CONSTRAINT `order relation` FOREIGN KEY (`ordernumber`) REFERENCES `orders` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `orderproducts`
--
ALTER TABLE `orderproducts`
  ADD CONSTRAINT `orderdetails relations` FOREIGN KEY (`orderdetails_id`) REFERENCES `orderdetailes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `productdetails Relationssss` FOREIGN KEY (`productdetails_id`) REFERENCES `productdetails` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `card relation` FOREIGN KEY (`card_id`) REFERENCES `addtocard` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
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
  ADD CONSTRAINT `brand category` FOREIGN KEY (`product_brand_id`) REFERENCES `brand` (`brand_Id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `category relation` FOREIGN KEY (`product_cat_id`) REFERENCES `categoreis` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `productdetails`
--
ALTER TABLE `productdetails`
  ADD CONSTRAINT `Review Relation` FOREIGN KEY (`Review_id`) REFERENCES `productreview` (`id_review`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `color relationsss` FOREIGN KEY (`color_id`) REFERENCES `productcolor` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `product Relationsssssssssssssssssssss` FOREIGN KEY (`product_Id`) REFERENCES `product` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `sizes relationss` FOREIGN KEY (`size_id`) REFERENCES `productsizes` (`id_size`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `productimges`
--
ALTER TABLE `productimges`
  ADD CONSTRAINT `productss relation` FOREIGN KEY (`product_id`) REFERENCES `productdetails` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `suppliers`
--
ALTER TABLE `suppliers`
  ADD CONSTRAINT `Group user Relation` FOREIGN KEY (`userid`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

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
