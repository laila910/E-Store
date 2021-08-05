-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 05, 2021 at 05:05 AM
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
  `quantity` int(11) NOT NULL DEFAULT 1,
  `session` varchar(50) DEFAULT 'no' COMMENT 'add to order or not yes or no '
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `addtocard`
--

INSERT INTO `addtocard` (`id`, `customerId`, `carditem`, `created_at`, `modified_at`, `quantity`, `session`) VALUES
(125, 4, 21, '2021-08-05 01:22:56', '2021-08-05 01:22:56', 1, 'no');

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
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
(1, 'FootWear', 'it contains alot of footwears like Athletic,sneakers,wedges,Ballerina,Boots,Sandals,Slippers and Socks.', 1, 1, '2021-07-23 01:02:27'),
(2, 'Clothing', 'it contains alot of Women clothing like T-Shirt,Blouses,Shirts,Dresses,Jeans&Pants,Leggings,Skirts,Swimwear,Sleepwear,Lingerie,Hoodies&Sweatshirts and Jackets&Coats.', 2, 1, '2021-07-23 01:02:27'),
(3, 'Watches', 'it contains alot of Watches like Casual Watches,Dress Watches,Stainless steel watches and Leather Watches.', 3, 1, '2021-07-23 01:04:27'),
(4, 'Jewelry', 'it contains alot of Earrings,Bracelets,Rings,Jewelry sets,Fine Jewelry and Necklaces.', 4, 1, '2021-07-23 01:02:27'),
(5, 'Bags & Accessories', 'it contains alot of Hand Bags,Cross Body bags,Clutches,BackPacks and Wallets.', 5, 1, '2021-07-23 01:02:27'),
(6, 'Eyewear', 'it contains alot of Sunglasses,Aviator,Cat Eye and Optical Frames.', 6, 1, '2021-07-23 01:02:27');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `cat_slug` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `name`, `cat_slug`) VALUES
(1, 'Laptops', 'laptops'),
(2, 'Desktop PC', 'desktop-pc'),
(3, 'Tablets', 'tablets'),
(4, 'Smart Phones', '');

-- --------------------------------------------------------

--
-- Table structure for table `contact`
--

CREATE TABLE `contact` (
  `id` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `subject` varchar(50) NOT NULL,
  `message` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `contact`
--

INSERT INTO `contact` (`id`, `userId`, `subject`, `message`) VALUES
(1, 4, 'kkkkksadddddddds', 'dfssssfffffffffcccccccccccccccccccccccccccccccccccccccccccccccccccccccccc');

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
  `creditcard` varchar(11) NOT NULL,
  `creditcardtypeid` int(11) NOT NULL,
  `cardExpMon` int(11) NOT NULL,
  `cardExpYr` int(11) NOT NULL,
  `cvc` int(11) NOT NULL,
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

INSERT INTO `customers` (`id`, `usersid`, `address`, `country`, `city`, `state`, `zipCode`, `anotheraddress`, `creditcard`, `creditcardtypeid`, `cardExpMon`, `cardExpYr`, `cvc`, `shipaddress`, `shipcountry`, `shipcity`, `shipstate`, `shipzipcode`, `dateRegistered`, `billingaddress`, `billingcountry`, `billingcity`, `billingstate`, `billingzipcode`) VALUES
(11, 4, '1 El Farz st , EL zawya el hamra', 'Egypt', 'Al Qahirah', 'Al Qahirah', 11311, '1st Mohamed Ali', 'Visa', 456, 9, 9, 345, '1st El-Game3', 'Egypt', 'Shubra', 'Cairo', 55678, '2021-08-03', '1st Magdy Ameen', 'Egypt', 'Shubra Elkhaima', 'Cairo', 23456);

-- --------------------------------------------------------

--
-- Table structure for table `manager`
--

CREATE TABLE `manager` (
  `id_manager` int(11) NOT NULL,
  `supplierid` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `noofproducts` int(11) NOT NULL COMMENT 'indicate the no of product to order from the suppliers ',
  `lackOfProducts` varchar(50) NOT NULL DEFAULT 'no' COMMENT 'there is lack of no of products yes or no',
  `userid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='still will be added more columns for what the manger do ';

-- --------------------------------------------------------

--
-- Table structure for table `orderdetailes`
--

CREATE TABLE `orderdetailes` (
  `id` int(11) NOT NULL,
  `ordernumber` int(11) NOT NULL,
  `shippingcost` int(11) NOT NULL DEFAULT 70,
  `quntity` int(11) NOT NULL DEFAULT 1,
  `discount` int(11) NOT NULL DEFAULT 0,
  `totalprice` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `orderdetailes`
--

INSERT INTO `orderdetailes` (`id`, `ordernumber`, `shippingcost`, `quntity`, `discount`, `totalprice`) VALUES
(17, 17, 70, 1, 0, 260);

-- --------------------------------------------------------

--
-- Table structure for table `orderproducts`
--

CREATE TABLE `orderproducts` (
  `id` int(11) NOT NULL,
  `orderdetails_id` int(11) NOT NULL,
  `productdetails_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `orderproducts`
--

INSERT INTO `orderproducts` (`id`, `orderdetails_id`, `productdetails_id`) VALUES
(15, 17, 21);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `card_id` int(11) NOT NULL,
  `orderdate` date NOT NULL DEFAULT current_timestamp(),
  `shipdate` date NOT NULL,
  `requireddate` date NOT NULL COMMENT 'the time of order from order to delivery',
  `shipperId` int(11) NOT NULL DEFAULT 8,
  `salestax` int(11) NOT NULL DEFAULT 70,
  `paid` varchar(10) NOT NULL DEFAULT 'no' COMMENT 'the paid is done yes or not no',
  `paymentdate` date NOT NULL,
  `delivered` varchar(10) NOT NULL DEFAULT 'no' COMMENT 'the order delivered or not ,yes for deliver, for not no ',
  `ordercanceled` varchar(50) NOT NULL DEFAULT 'no' COMMENT 'the customer no for not ,yes for canceled the order or not '
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `card_id`, `orderdate`, `shipdate`, `requireddate`, `shipperId`, `salestax`, `paid`, `paymentdate`, `delivered`, `ordercanceled`) VALUES
(17, 125, '2021-08-05', '2021-08-06', '2021-08-07', 8, 70, 'no', '2021-08-07', 'no', 'no');

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
(72, 'Faux-Leather Ribbon Detail Flat Ballerina', 1, 7, 'New', 'false'),
(73, 'Mini Focus Casual Watch For Women Analog Metal - MF0224L.03', 3, 6, 'New', 'true');

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
(14, 'Nude', ' Red', 'Navy'),
(15, 'Metal Silver', ' Null', 'Null');

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
  `unitsInStock` int(11) NOT NULL,
  `Discount` int(11) NOT NULL,
  `productAvailablity` varchar(50) NOT NULL COMMENT 'yes or no',
  `discountAvailablity` varchar(50) NOT NULL COMMENT 'there is discount yes or no',
  `productMadeDate` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `productdetails`
--

INSERT INTO `productdetails` (`id`, `product_Id`, `color_id`, `size_id`, `productPrice`, `productQuntity`, `product_Description`, `product_Specificaton`, `unitsInStock`, `Discount`, `productAvailablity`, `discountAvailablity`, `productMadeDate`) VALUES
(17, 61, 2, 1, 350, 1, 'Believe in yourself Long Sleeves T-Shirt', 'fffffffffffffffffffffffffggggggggggggggggggggggggsdgggggggggggggggggggg', 870, 50, 'true', 'false', '2021-07-20 00:46:37'),
(18, 62, 3, 2, 145, 1, 'Brand: Other Item Type: T-Shirt Material: Cotton', 'fffffffffffffffffffffffffggggggggggggggggggggggggsdgggggggggggggggggggg', 987, 50, 'true', 'false', '2021-07-31 00:47:11'),
(19, 63, 4, 3, 290, 1, 'Sneakers Chunky sole For Women Lace-up design', 'Package thickness29.6 centimeters Package weight in KGs712 grams MaterialFaux Leather Country of originEG StyleFashion Sneakers OccasionCasual Shoe', 200, 50, 'true', 'false', '2021-07-31 16:33:29'),
(20, 64, 5, 5, 130, 1, 'Grinta Leather Quilted Flat Round toe Ballerina Shoes for Women', 'Package thickness27.2 centimeters Package weight in KGs312 grams MaterialLeather Country of originEG Targeted GroupWomen StyleBallerina OccasionCasual Shoe', 345, 50, 'true', 'false', '2021-07-31 17:32:09'),
(21, 65, 6, 6, 260, 1, 'Type Slip-on shoes Low cut design Padded cuffs', 'Package thickness28 centimeters Package weight in KGs740 grams MaterialFaux Leather Country of originEG', 678, 100, 'true', 'true', '2021-07-31 19:16:15'),
(22, 66, 7, 1, 290, 1, 'Chunky sole Slip-on design Type Sneakers', 'Package thickness28.2 centimeters Package weight in KGs740 grams MaterialFaux Leather Country of originEG Targeted GroupWomen StyleFashion Sneakers', 345, 10, 'true', 'false', '2021-07-31 19:22:46'),
(23, 67, 8, 1, 129, 1, 'Type Lace up sneakers Two tone design Perforated upper Round toe', 'Package thickness31.8 centimeters Package weight in KGs740 grams MaterialFaux Leather Country of originEG  StyleFashion Sneakers', 469, 100, 'true', 'false', '2021-07-31 19:30:14'),
(24, 68, 9, 9, 290, 1, 'Type Sneakers Targeted Group Women Chunky sole Lace-up design', 'Package thickness28.2 centimeters Package weight in KGs716 grams MaterialTextile Country of originEG Size39 EU', 200, 100, 'true', 'true', '2021-07-31 19:33:59'),
(25, 69, 10, 10, 349, 1, 'Type Espadrille Shoes Flat design Front logo', 'Package thickness27.2 centimeters Package weight in KGs514 grams MaterialFaux Leather Country of originCN StyleEspadrille', 345, 100, 'true', 'false', '2021-07-31 19:38:56'),
(26, 70, 11, 11, 350, 1, 'Type Sneakers Tongue logo Stitched detail', 'Package thickness29.6 centimeters Package weight in KGs1050 grams MaterialNubuck Country of originEG', 987, 49, 'true', 'true', '2021-07-31 19:42:43'),
(27, 71, 12, 12, 289, 1, 'Type Ballerina shoes Square toe Upper contrast stone detail Flat design Side metal logo detail', 'Package thickness29.2 centimeters Package weight in KGs544 grams MaterialFaux Leather Country of originCN', 432, 150, 'true', 'false', '2021-07-31 19:47:17'),
(28, 71, 13, 12, 289, 1, 'Type Ballerina shoes Square toe Upper contrast stone detail Flat design Side metal logo detail', 'Package thickness29.2 centimeters Package weight in KGs544 grams MaterialFaux Leather Country of originCN', 345, 100, 'true', 'false', '2021-07-31 19:51:52'),
(29, 72, 14, 13, 339, 1, 'Ballerina shoes Round toe Stitched ribbon detail Flat design Gold metal detail Patent cap toe', 'Package thickness15.4 centimeters Package weight in KGs394 grams MaterialFaux Leather Country of originCN', 322, 49, 'true', 'true', '2021-07-31 19:55:14'),
(30, 73, 15, 14, 390, 200, 'Movement Type : Quartz Dial Case Diameter Size : 34 millimeters Targeted Group : Women Brand : Mini Focus Band Material : Metal Watch Shape : Round', 'Package thickness11 centimeters Package weight in KGs228 grams Watch ShapeRound Dial Case Diameter Size34 millimeters Movement TypeQuartz', 345, 50, 'true', 'false', '2021-08-05 01:55:04'),
(31, 73, 15, 14, 350, 200, 'Dial Case Diameter Size : 34 millimeters Targeted Group : Women Brand : Mini Focus Band Material : Metal Watch Shape : Round', 'Manufacturer NumberMF0224L.03 Package thickness11 centimeters Package weight in KGs228 grams Watch ShapeRound Dial Case Diameter Size34 millimeters Movement TypeQuartz', 345, 100, 'true', 'false', '2021-08-05 02:02:50'),
(32, 73, 15, 14, 350, 200, 'Movement Type : Quartz Dial Case Diameter Size : 34 millimeters Targeted Group : Women Brand : Mini Focus Band Material : Metal Watch Shape : Round', 'Manufacturer NumberMF0224L.03 Package thickness11 centimeters Package weight in KGs228 grams Watch ShapeRound Dial Case Diameter Size34 millimeters', 345, 100, 'true', 'false', '2021-08-05 02:06:03');

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
(23, 29, '9023477711627754162.jpg', '11374680511627754162.jpg', '11500181871627754162.jpg'),
(24, 30, '11426077451628121699.jpg', '16813672381628121699.jpg', '');

-- --------------------------------------------------------

--
-- Table structure for table `productreview`
--

CREATE TABLE `productreview` (
  `id_review` int(11) NOT NULL,
  `productreview` int(11) NOT NULL,
  `reviewerName` varchar(50) NOT NULL,
  `reviewerEmail` varchar(250) NOT NULL,
  `reviewerComment` text NOT NULL,
  `review_Made_Date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `productreview`
--

INSERT INTO `productreview` (`id_review`, `productreview`, `reviewerName`, `reviewerEmail`, `reviewerComment`, `review_Made_Date`) VALUES
(1, 17, 'Ahmed', 'ahmed123@yahoo.com', 'This product is wonderful', '2021-07-23 00:00:00'),
(3, 19, 'Laila', 'lailaibrahim798@gmail.com', 'This website is more helpful ,easier ,more professional and Its products more great', '2021-07-31 01:11:34');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `name` text NOT NULL,
  `description` text NOT NULL,
  `slug` varchar(200) NOT NULL,
  `price` double NOT NULL,
  `photo` varchar(200) NOT NULL,
  `date_view` date NOT NULL,
  `counter` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `category_id`, `name`, `description`, `slug`, `price`, `photo`, `date_view`, `counter`) VALUES
(1, 1, 'DELL Inspiron 15 7000 15.6', '<p>15-inch laptop ideal for gamers. Featuring the latest Intel&reg; processors for superior gaming performance, and life-like NVIDIA&reg; GeForce&reg; graphics and an advanced thermal cooling design.</p>\r\n', 'dell-inspiron-15-7000-15-6', 899, 'dell-inspiron-15-7000-15-6.jpg', '2018-07-09', 2),
(2, 1, 'MICROSOFT Surface Pro 4 & Typecover - 128 GB', '<p>Surface Pro 4 powers through everything you need to do, while being lighter than ever before</p>\r\n\r\n<p>The 12.3 PixelSense screen has extremely high contrast and low glare so you can work through the day without straining your eyes</p>\r\n\r\n<p>keyboard is not included and needed to be purchased separately</p>\r\n\r\n<p>Features an Intel Core i5 6th Gen (Skylake) Core,Wireless: 802.11ac Wi-Fi wireless networking; IEEE 802.11a/b/g/n compatible Bluetooth 4.0 wireless technology</p>\r\n\r\n<p>Ships in Consumer packaging.</p>\r\n', 'microsoft-surface-pro-4-typecover-128-gb', 799, 'microsoft-surface-pro-4-typecover-128-gb.jpg', '2018-05-10', 3),
(3, 1, 'DELL Inspiron 15 5000 15.6', '<p>Dell&#39;s 15.6-inch, midrange notebook is a bland, chunky block. It has long been the case that the Inspiron lineup lacks any sort of aesthetic muse, and the Inspiron 15 5000 follows this trend. It&#39;s a plastic, silver slab bearing Dell&#39;s logo in a mirror sheen.</p>\r\n\r\n<p>Lifting the lid reveals the 15.6-inch, 1080p screen surrounded by an almost offensively thick bezel and a plastic deck with a faux brushed-metal look. There&#39;s a fingerprint reader on the power button, and the keyboard is a black collection of island-style keys.</p>\r\n', 'dell-inspiron-15-5000-15-6', 599, 'dell-inspiron-15-5000-15-6.jpg', '2018-05-12', 1),
(4, 1, 'LENOVO Ideapad 320s-14IKB 14\" Laptop - Grey', '<p>- Made for portability with a slim, lightweight chassis design&nbsp;<br />\r\n<br />\r\n- Powerful processing helps you create and produce on the go&nbsp;<br />\r\n<br />\r\n- Full HD screen ensures crisp visuals for movies, web pages, photos and more&nbsp;<br />\r\n<br />\r\n- Enjoy warm, sparkling sound courtesy of two Harman speakers and Dolby Audio&nbsp;<br />\r\n<br />\r\n- Fast data transfer and high-quality video connection with USB-C and HDMI ports&nbsp;<br />\r\n<br />\r\nThe Lenovo&nbsp;<strong>IdeaPad 320s-14IKB 14&quot; Laptop</strong>&nbsp;is part of our Achieve range, which has the latest tech to help you develop your ideas and work at your best. It&#39;s great for editing complex documents, business use, editing photos, and anything else you do throughout the day.</p>\r\n', 'lenovo-ideapad-320s-14ikb-14-laptop-grey', 399, 'lenovo-ideapad-320s-14ikb-14-laptop-grey.jpg', '2018-05-10', 3),
(5, 3, 'APPLE 9.7\" iPad - 32 GB, Gold', '<p>9.7 inch Retina Display, 2048 x 1536 Resolution, Wide Color and True Tone Display</p>\r\n\r\n<p>Apple iOS 9, A9X chip with 64bit architecture, M9 coprocessor</p>\r\n\r\n<p>12 MP iSight Camera, True Tone Flash, Panorama (up to 63MP), Four-Speaker Audio</p>\r\n\r\n<p>Up to 10 Hours of Battery Life</p>\r\n\r\n<p>iPad Pro Supports Apple Smart Keyboard and Apple Pencil</p>\r\n', 'apple-9-7-ipad-32-gb-gold', 339, 'apple-9-7-ipad-32-gb-gold.jpg', '2018-07-09', 3),
(6, 1, 'DELL Inspiron 15 5000 15', '<p>15-inch laptop delivering an exceptional viewing experience, a head-turning finish and an array of options designed to elevate your entertainment, wherever you go.</p>\r\n', 'dell-inspiron-15-5000-15', 449.99, 'dell-inspiron-15-5000-15.jpg', '0000-00-00', 0),
(7, 3, 'APPLE 10.5\" iPad Pro - 64 GB, Space Grey (2017)', '<p>4K video recording at 30 fps</p>\r\n\r\n<p>12-megapixel camera</p>\r\n\r\n<p>Fingerprint resistant coating</p>\r\n\r\n<p>Antireflective coating</p>\r\n\r\n<p>Face Time video calling</p>\r\n', 'apple-10-5-ipad-pro-64-gb-space-grey-2017', 619, 'apple-10-5-ipad-pro-64-gb-space-grey-2017.jpg', '0000-00-00', 0),
(8, 1, 'ASUS Transformer Mini T102HA 10.1\" 2 in 1 - Silver', '<p>Versatile Windows 10 device with keyboard and pen included, 2-in-1 functionality: use as both laptop and tablet.Update Windows periodically to ensure that your applications have the latest security settings.</p>\r\n\r\n<p>All day battery life, rated up to 11 hours of video playback; 128GB Solid State storage. Polymer Battery.With up to 11 hours between charges, you can be sure that Transformer Mini T102HA will be right there whenever you need it. You can charge T102HA via its micro USB port, so you can use a mobile charger or any power bank with a micro USB connector.</p>\r\n', 'asus-transformer-mini-t102ha-10-1-2-1-silver', 549.99, 'asus-transformer-mini-t102ha-10-1-2-1-silver.jpg', '0000-00-00', 0),
(9, 2, 'PC SPECIALIST Vortex Core Lite Gaming PC', '<p>- Top performance for playing eSports and more&nbsp;<br />\r\n<br />\r\n- NVIDIA GeForce GTX graphics deliver smooth visuals&nbsp;<br />\r\n<br />\r\n- GeForce Experience delivers updates straight to your PC&nbsp;<br />\r\n<br />\r\nThe PC Specialist&nbsp;<strong>Vortex Core Lite&nbsp;</strong>is part of our Gaming range, bringing you the most impressive PCs available today. It has spectacular graphics and fast processing performance to suit the most exacting players.</p>\r\n', 'pc-specialist-vortex-core-lite-gaming-pc', 599.99, 'pc-specialist-vortex-core-lite-gaming-pc.jpg', '0000-00-00', 0),
(10, 2, 'DELL Inspiron 5675 Gaming PC - Recon Blue', '<p>All-new gaming desktop featuring powerful AMD Ryzen&trade; processors, graphics ready for VR, LED lighting and a meticulous design for optimal cooling.</p>\r\n', 'dell-inspiron-5675-gaming-pc-recon-blue', 599.99, 'dell-inspiron-5675-gaming-pc-recon-blue.jpg', '2018-05-10', 1),
(11, 2, 'HP Barebones OMEN X 900-099nn Gaming PC', '<p>What&#39;s inside matters.</p>\r\n\r\n<p>Without proper cooling, top tierperformance never reaches its fullpotential.</p>\r\n\r\n<p>Nine lighting zones accentuate theaggressive lines and smooth blackfinish of this unique galvanized steelcase.</p>\r\n', 'hp-barebones-omen-x-900-099nn-gaming-pc', 489.98, 'hp-barebones-omen-x-900-099nn-gaming-pc.jpg', '2018-05-12', 1),
(12, 2, 'ACER Aspire GX-781 Gaming PC', '<p>- GTX 1050 graphics card lets you play huge games in great resolutions&nbsp;<br />\r\n<br />\r\n- Latest generation Core&trade; i5 processor can handle demanding media software&nbsp;<br />\r\n<br />\r\n- Superfast SSD storage lets you load programs in no time&nbsp;<br />\r\n<br />\r\nThe Acer&nbsp;<strong>Aspire&nbsp;GX-781 Gaming PC&nbsp;</strong>is part of our Gaming range, which offers the most powerful PCs available today. It has outstanding graphics and processing performance to suit the most demanding gamer.</p>\r\n', 'acer-aspire-gx-781-gaming-pc', 749.99, 'acer-aspire-gx-781-gaming-pc.jpg', '2018-05-12', 3),
(13, 2, 'HP Pavilion Power 580-015na Gaming PC', '<p>Features the latest quad core Intel i5 processor and discrete graphics. With this power, you&rsquo;re ready to take on any activity from making digital art to conquering new worlds in VR.</p>\r\n\r\n<p>Choose the performance and storage you need. Boot up in seconds with to 128 GB SSD.</p>\r\n\r\n<p>Ditch the dull grey box, this desktop comes infused with style. A new angular bezel and bold green and black design give your workspace just the right amount of attitude.</p>\r\n\r\n<p>Up to 3 times faster performance - GeForce GTX 10-series graphics cards are powered by Pascal to deliver twice the performance of previous-generation graphics cards.</p>\r\n', 'hp-pavilion-power-580-015na-gaming-pc', 799.99, 'hp-pavilion-power-580-015na-gaming-pc.jpg', '2018-05-12', 1),
(14, 2, 'LENOVO Legion Y520 Gaming PC', '<p>- Multi-task with ease thanks to Intel&reg; i5 processor&nbsp;<br />\r\n<br />\r\n- Prepare for battle with NVIDIA GeForce GTX graphics card&nbsp;<br />\r\n<br />\r\n- VR ready for the next-generation of immersive gaming and entertainment<br />\r\n<br />\r\n- Tool-less upgrade helps you personalise your system to your own demands&nbsp;<br />\r\n<br />\r\nPart of our Gaming range, which features the most powerful PCs available today, the Lenovo&nbsp;<strong>Legion Y520 Gaming PC</strong>&nbsp;has superior graphics and processing performance to suit the most demanding gamer.</p>\r\n', 'lenovo-legion-y520-gaming-pc', 899.99, 'lenovo-legion-y520-gaming-pc.jpg', '2018-05-10', 13),
(15, 2, 'PC SPECIALIST Vortex Minerva XT-R Gaming PC', '<p>- NVIDIA GeForce GTX graphics for stunning gaming visuals<br />\r\n<br />\r\n- Made for eSports with a speedy 7th generation Intel&reg; Core&trade; i5 processor<br />\r\n<br />\r\n- GeForce technology lets you directly update drivers, record your gaming and more<br />\r\n<br />\r\nThe PC Specialist&nbsp;<strong>Vortex Minerva XT-R Gaming PC</strong>&nbsp;is part of our Gaming range, which offers the most powerful PCs available. Its high-performance graphics and processing are made to meet the needs of serious gamers.</p>\r\n', 'pc-specialist-vortex-minerva-xt-r-gaming-pc', 999.99, 'pc-specialist-vortex-minerva-xt-r-gaming-pc.jpg', '2018-07-09', 1),
(16, 2, 'PC SPECIALIST Vortex Core II Gaming PC', '<p>Processor: Intel&reg; CoreTM i3-6100 Processor- Dual-core- 3.7 GHz- 3 MB cache</p>\r\n\r\n<p>Memory (RAM): 8 GB DDR4 HyperX, Storage: 1 TB HDD, 7200 rpm</p>\r\n\r\n<p>Graphics card: NVIDIA GeForce GTX 950 (2 GB GDDR5), Motherboard: ASUS H110M-R</p>\r\n\r\n<p>USB: USB 3.0 x 3- USB 2.0 x 5, Video interface: HDMI x 1- DisplayPort x 1- DVI x 2, Audio interface: 3.5 mm jack, Optical disc drive: DVD/RW, Expansion card slot PCIe: (x1) x 2</p>\r\n\r\n<p>Sound: 5.1 Surround Sound support PSU Corsair: VS350, 350W, Colour: Black- Green highlights, Box contents: PC Specialist Vortex Core- AC power cable</p>\r\n', 'pc-specialist-vortex-core-ii-gaming-pc', 649.99, 'pc-specialist-vortex-core-ii-gaming-pc.jpg', '2018-05-10', 2),
(17, 3, 'AMAZON Fire 7 Tablet with Alexa (2017) - 8 GB, Black', '<p>The next generation of our best-selling Fire tablet ever - now thinner, lighter, and with longer battery life and an improved display. More durable than the latest iPad</p>\r\n\r\n<p>Beautiful 7&quot; IPS display with higher contrast and sharper text, a 1.3 GHz quad-core processor, and up to 8 hours of battery life. 8 or 16 GB of internal storage and a microSD slot for up to 256 GB of expandable storage.</p>\r\n', 'amazon-fire-7-tablet-alexa-2017-8-gb-black', 49.99, 'amazon-fire-7-tablet-alexa-2017-8-gb-black.jpg', '2018-05-12', 1),
(18, 3, 'AMAZON Fire HD 8 Tablet with Alexa (2017) - 16 GB, Black', '<p>Take your personal assistant with you wherever you go with this Amazon Fire HD 8 tablet featuring Alexa voice-activated cloud service. The slim design of the tablet is easy to handle, and the ample 8-inch screen is ideal for work or play. This Amazon Fire HD 8 features super-sharp high-definition graphics for immersive streaming.</p>\r\n', 'amazon-fire-hd-8-tablet-alexa-2017-16-gb-black', 79.99, 'amazon-fire-hd-8-tablet-alexa-2017-16-gb-black.jpg', '2018-05-12', 2),
(19, 3, 'AMAZON Fire HD 8 Tablet with Alexa (2017) - 32 GB, Black', '<p>The next generation of our best-reviewed Fire tablet, with up to 12 hours of battery life, a vibrant 8&quot; HD display, a 1.3 GHz quad-core processor, 1.5 GB of RAM, and Dolby Audio. More durable than the latest iPad.</p>\r\n\r\n<p>16 or 32 GB of internal storage and a microSD slot for up to 256 GB of expandable storage.</p>\r\n', 'amazon-fire-hd-8-tablet-alexa-2017-32-gb-black', 99.99, 'amazon-fire-hd-8-tablet-alexa-2017-32-gb-black.jpg', '2018-05-10', 1),
(20, 3, 'APPLE 9.7\" iPad - 32 GB, Space Grey', '<p>9.7-inch Retina display, wide color and true tone</p>\r\n\r\n<p>A9 third-generation chip with 64-bit architecture</p>\r\n\r\n<p>M9 motion coprocessor</p>\r\n\r\n<p>1.2MP FaceTime HD camera</p>\r\n\r\n<p>8MP iSight camera</p>\r\n\r\n<p>Touch ID</p>\r\n\r\n<p>Apple Pay</p>\r\n', 'apple-9-7-ipad-32-gb-space-grey', 339, 'apple-9-7-ipad-32-gb-space-grey.jpg', '2018-05-12', 1),
(27, 1, 'Dell XPS 15 9560', '<p>The world&rsquo;s smallest 15.6-inch performance laptop packs powerhouse performance and a stunning InfinityEdge display &mdash; all in our most powerful XPS laptop. Featuring the latest Intel&reg; processors.</p>\r\n\r\n<h2>Operating system</h2>\r\n\r\n<p><strong>Available with Windows 10 Home&nbsp;</strong>- Get the best combination of Windows features you know and new improvements you&#39;ll love.</p>\r\n\r\n<h2>Innovation that inspires.</h2>\r\n\r\n<p>When you&rsquo;re at the forefront of ingenuity, you get noticed. That&rsquo;s why it&rsquo;s no surprise the XPS 15 was honored. The winning streak continues.</p>\r\n\r\n<h2>Meet the smallest 15.6-inch laptop on the planet.</h2>\r\n\r\n<p><strong>The world&rsquo;s only 15.6-inch InfinityEdge display*:</strong>&nbsp;The virtually borderless display maximizes screen space by accommodating a 15.6-inch display inside a laptop closer to the size of a 14-inch, thanks to a bezel measuring just 5.7mm.<br />\r\n&nbsp;<br />\r\n<strong>Operating System: Windows 10 Pro.</strong><br />\r\n<br />\r\n<strong>One-of-a-kind design:</strong>&nbsp;Measuring in at a slim 11-17mm and starting at just 4 pounds (1.8 kg) with a solid state drive, the XPS 15 is one of the world&rsquo;s lightest 15-inch performance-class laptop.</p>\r\n\r\n<h2>A stunning view, wherever you go.</h2>\r\n\r\n<p><strong>Dazzling detail:</strong>&nbsp;With the UltraSharp 4K Ultra HD display (3840 x 2160), you can see each detail of every pixel without needing to zoom in. And with 6 million more pixels than Full HD and 3 million more than the MacBook Pro, you can edit images with pinpoint accuracy without worrying about blurriness or jagged lines.<br />\r\n<br />\r\n<strong>Industry-leading color:</strong>&nbsp;The XPS 15 is the only laptop with 100% Adobe RGB color, covering a wider color gamut and producing shades of color outside conventional panels so you can see more of what you see in real life. And with over 1 billion colors, images appear smoother and color gradients are amazingly lifelike with more depth and dimension. Included is Dell PremierColor software, which automatically remaps content not already in Adobe RGB format for onscreen colors that appear amazingly accurate and true to life.<br />\r\n<br />\r\n<strong>Easy collaboration:</strong>&nbsp;See your screen from nearly every angle with an IGZO IPS panel, providing a wide viewing angle of up to 170&deg;.&nbsp;<br />\r\n<br />\r\n<strong>Brighten your day:</strong>&nbsp;With 350 nit brightness, it&rsquo;s brighter than a typical laptop.<br />\r\n<br />\r\n<strong>Touch-friendly:</strong>&nbsp;Tap, swipe and pinch your way around the screen. The optional touch display lets you interact naturally with your technology.</p>\r\n', 'dell-xps-15-9560', 1599, 'dell-xps-15-9560.jpg', '2018-07-09', 9),
(28, 4, 'Samsung Note 8', '<p>See the bigger picture and communicate in a whole new way. With the Galaxy Note8 in your hand, bigger things are just waiting to happen.&nbsp;</p>\r\n\r\n<h3>The Infinity Display that&#39;s larger than life.&nbsp;</h3>\r\n\r\n<p>More screen means more space to do great things. Go big with the Galaxy Note8&#39;s 6.3&quot; screen. It&#39;s the largest ever screen on a Note device and it still fits easily in your hand.</p>\r\n\r\n<p>*Infinity Display: a near bezel-less, full-frontal glass, edge-to-edge screen.</p>\r\n\r\n<p>*Screen measured diagonally as a full rectangle without accounting for the rounded corners.</p>\r\n\r\n<p>Use the S Pen to express yourself in ways that make a difference. Draw your own emojis to show how you feel or write a message on a photo and send it as a handwritten note. Do things that matter with the S Pen.</p>\r\n\r\n<p>*Image simulated for illustration purpose only.</p>\r\n', 'samsung-note-8', 829, 'samsung-note-8.jpg', '0000-00-00', 0),
(29, 4, 'Samsung Galaxy S9+ [128 GB]', '<h2>The revolutionary camera that adapts like the human eye.&nbsp;</h2>\r\n\r\n<h3>Capture stunning pictures in bright daylight and super low light.</h3>\r\n\r\n<p>Our category-defining Dual Aperture lens adapts like the human eye. It&#39;s able to automatically switch between various lighting conditions with ease&mdash;making your photos look great whether it&#39;s bright or dark, day or night.</p>\r\n\r\n<p>*Dual Aperture supports F1.5 and F2.4 modes. Installed on the rear camera (Galaxy S9)/rear wide camera (Galaxy S9+).</p>\r\n\r\n<p><img alt=\"\" src=\"https://www.samsung.com/global/galaxy/galaxy-s9/images/galaxy-s9_slow_gif_visual_l.jpg\" style=\"height:464px; width:942px\" />Add music. Make GIFs. Get likes</p>\r\n\r\n<p>Super Slow-mo lets you see the things you could have missed in the blink of an eye. Set the video to music or turn it into a looping GIF, and share it with a tap. Then sit back and watch the reactions roll in.</p>\r\n', 'samsung-galaxy-s9-128-gb', 889.99, 'samsung-galaxy-s9-128-gb.jpg', '2018-07-09', 3);

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
(13, 'S', 'NULL', 'L', 'XL'),
(14, 'S', 'NULL', 'Null', 'Null');

-- --------------------------------------------------------

--
-- Table structure for table `savedorderforcustomer`
--

CREATE TABLE `savedorderforcustomer` (
  `id` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `orderNo` int(11) NOT NULL,
  `productName` varchar(100) NOT NULL,
  `firstImage` varchar(50) NOT NULL,
  `productPrice` int(11) NOT NULL,
  `shipDate` date NOT NULL,
  `deliveredDate` date NOT NULL,
  `SalesTax` int(11) NOT NULL,
  `Total Price` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `savedorderforcustomer`
--

INSERT INTO `savedorderforcustomer` (`id`, `userid`, `orderNo`, `productName`, `firstImage`, `productPrice`, `shipDate`, `deliveredDate`, `SalesTax`, `Total Price`) VALUES
(1, 4, 16, 'Contrast Stripe Textile Slip-On Shoes', '20590097841627752215.jpg', 290, '2021-08-05', '2021-08-06', 70, 360),
(2, 4, 17, 'Contrast Sole Embossed Faux Leather Slip-On Shoes', '18560048941627751885.jpg', 260, '2021-08-06', '2021-08-07', 70, 330);

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
(10, 'test root', 'Mahmoud', 'lailaibrahim798@gmail.com', 2147483647, 'f33e462219d100a8a98d81c464558ddba17ebd7b', 2),
(12, 'Hoda', 'Mahmoud', 'hodamahmoud123@yahoo.com', 1124193087, '123456789', 2);

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
(8, 'ordershipper'),
(9, 'suppliers'),
(10, 'manager');

-- --------------------------------------------------------

--
-- Table structure for table `whishlist`
--

CREATE TABLE `whishlist` (
  `id` int(11) NOT NULL,
  `productid` int(11) NOT NULL COMMENT 'to connect with the product details table ',
  `quantity` int(11) NOT NULL DEFAULT 1 COMMENT 'the no of product that the user is wanted ',
  `customerid` int(11) NOT NULL,
  `addtocard` varchar(50) NOT NULL DEFAULT 'no' COMMENT 'to add to card or not yes or no '
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `whishlist`
--

INSERT INTO `whishlist` (`id`, `productid`, `quantity`, `customerid`, `addtocard`) VALUES
(177, 25, 1, 4, 'no');

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
-- Indexes for table `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`id`),
  ADD KEY `userId` (`userId`);

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
  ADD KEY `shipperId` (`shipperId`),
  ADD KEY `card_id` (`card_id`);

--
-- Indexes for table `ordershipper`
--
ALTER TABLE `ordershipper`
  ADD PRIMARY KEY (`id`),
  ADD KEY `userid` (`userid`);

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
  ADD PRIMARY KEY (`id_review`),
  ADD KEY `productreview` (`productreview`);

--
-- Indexes for table `productsizes`
--
ALTER TABLE `productsizes`
  ADD PRIMARY KEY (`id_size`);

--
-- Indexes for table `savedorderforcustomer`
--
ALTER TABLE `savedorderforcustomer`
  ADD PRIMARY KEY (`id`),
  ADD KEY `usersrelationnnnnnnnn` (`userid`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=126;

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
-- AUTO_INCREMENT for table `contact`
--
ALTER TABLE `contact`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `manager`
--
ALTER TABLE `manager`
  MODIFY `id_manager` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `orderdetailes`
--
ALTER TABLE `orderdetailes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `orderproducts`
--
ALTER TABLE `orderproducts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `ordershipper`
--
ALTER TABLE `ordershipper`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=74;

--
-- AUTO_INCREMENT for table `productcolor`
--
ALTER TABLE `productcolor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `productdetails`
--
ALTER TABLE `productdetails`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `productimges`
--
ALTER TABLE `productimges`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `productreview`
--
ALTER TABLE `productreview`
  MODIFY `id_review` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `productsizes`
--
ALTER TABLE `productsizes`
  MODIFY `id_size` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `savedorderforcustomer`
--
ALTER TABLE `savedorderforcustomer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `suppliers`
--
ALTER TABLE `suppliers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `usersgroup`
--
ALTER TABLE `usersgroup`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `whishlist`
--
ALTER TABLE `whishlist`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=180;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `addtocard`
--
ALTER TABLE `addtocard`
  ADD CONSTRAINT `customer relationss` FOREIGN KEY (`customerId`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `productss Relationsss` FOREIGN KEY (`carditem`) REFERENCES `productdetails` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `contact`
--
ALTER TABLE `contact`
  ADD CONSTRAINT `usersrelation` FOREIGN KEY (`userId`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

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
  ADD CONSTRAINT `color relationsss` FOREIGN KEY (`color_id`) REFERENCES `productcolor` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `product Relationsssssssssssssssssssss` FOREIGN KEY (`product_Id`) REFERENCES `product` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `sizes relationss` FOREIGN KEY (`size_id`) REFERENCES `productsizes` (`id_size`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `productimges`
--
ALTER TABLE `productimges`
  ADD CONSTRAINT `productss relation` FOREIGN KEY (`product_id`) REFERENCES `productdetails` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `productreview`
--
ALTER TABLE `productreview`
  ADD CONSTRAINT `product Review` FOREIGN KEY (`productreview`) REFERENCES `productdetails` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `savedorderforcustomer`
--
ALTER TABLE `savedorderforcustomer`
  ADD CONSTRAINT `usersrelationnnnnnnnn` FOREIGN KEY (`userid`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

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
  ADD CONSTRAINT `customer relation` FOREIGN KEY (`customerid`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `product details relationss` FOREIGN KEY (`productid`) REFERENCES `productdetails` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
