-- phpMyAdmin SQL Dump
-- version 4.9.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Dec 06, 2020 at 04:47 PM
-- Server version: 10.3.27-MariaDB-log-cll-lve
-- PHP Version: 7.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `glazpmck_ics370`
--

-- --------------------------------------------------------

--
-- Table structure for table `company`
--
-- Creation: Nov 11, 2020 at 10:53 PM
--

CREATE TABLE `company` (
  `id` int(11) NOT NULL,
  `companyName` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `company`
--

INSERT INTO `company` (`id`, `companyName`) VALUES
(1, 'Glazed Productions');

-- --------------------------------------------------------

--
-- Table structure for table `coupons`
--
-- Creation: Nov 11, 2020 at 10:53 PM
--

CREATE TABLE `coupons` (
  `id` int(11) NOT NULL,
  `code` varchar(45) NOT NULL,
  `couponDesc` varchar(255) NOT NULL,
  `company` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `coupons`
--

INSERT INTO `coupons` (`id`, `code`, `couponDesc`, `company`) VALUES
(1, 'Test1234', 'This is a test coupon', NULL),
(7, 'test4', 'This is a test Coupon change', 'Glazed Productions'),
(8, 'test5', 'Changing the description', 'Glazed Productions'),
(9, 'Add15', 'Use this Coupon to add 15% to your order! >:-{ )', 'Glazed Productions');

-- --------------------------------------------------------

--
-- Table structure for table `pwdreset`
--
-- Creation: Nov 11, 2020 at 10:53 PM
--

CREATE TABLE `pwdreset` (
  `pwdResetID` int(11) NOT NULL,
  `pwdResetEmail` text NOT NULL,
  `pwdResetSelector` text NOT NULL,
  `pwdResetToken` longtext NOT NULL,
  `pwdResetExpires` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `retailers`
--
-- Creation: Nov 11, 2020 at 10:53 PM
--

CREATE TABLE `retailers` (
  `id` int(11) NOT NULL,
  `Email` varchar(72) DEFAULT NULL,
  `Psword` varchar(45) DEFAULT NULL,
  `FName` varchar(24) DEFAULT NULL,
  `LName` varchar(24) DEFAULT NULL,
  `AccountCreated` datetime DEFAULT current_timestamp(),
  `Company` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `retailers`
--

INSERT INTO `retailers` (`id`, `Email`, `Psword`, `FName`, `LName`, `AccountCreated`, `Company`) VALUES
(1, 'nick@glazedproductions.com', '436fa63a99242faee7cbaf566dbf14c3', 'Nick', 'Okonek', '2020-10-13 20:33:24', 'Glazed Productions');

-- --------------------------------------------------------

--
-- Table structure for table `sitemap`
--
-- Creation: Nov 11, 2020 at 10:53 PM
--

CREATE TABLE `sitemap` (
  `pageID` int(11) NOT NULL,
  `pageTitle` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pageName` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `content` blob DEFAULT NULL,
  `url` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `isNavItem` tinyint(4) DEFAULT NULL,
  `bgImg` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bgImgAlt` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sitemap`
--

INSERT INTO `sitemap` (`pageID`, `pageTitle`, `pageName`, `content`, `url`, `isNavItem`, `bgImg`, `bgImgAlt`) VALUES
(1, 'Welcome to Project Foolery', 'Home', NULL, 'index', 1, 'bghome.jpg', 'Happy Shopper'),
(4, 'Login to your account', 'Login', NULL, 'login', 1, 'bghome.jpg', 'Happy Shopper'),
(5, 'New user registration', 'Register', NULL, 'register', 1, 'bghome.jpg', 'Happy Shopper'),
(6, 'Welcome', 'My Account', NULL, 'account', 1, 'bghome.jpg', 'Happy Shopper');

-- --------------------------------------------------------

--
-- Table structure for table `state`
--
-- Creation: Nov 11, 2020 at 10:53 PM
--

CREATE TABLE `state` (
  `code` varchar(2) NOT NULL,
  `name` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `state`
--

INSERT INTO `state` (`code`, `name`) VALUES
('AK', 'Alaska'),
('AL', 'Alabama'),
('AR', 'Arkansas'),
('AZ', 'Arizona'),
('CA', 'California'),
('CO', 'Colorado'),
('CT', 'Connecticut'),
('DC', 'District of Columbia'),
('DE', 'Delaware'),
('FL', 'Florida'),
('GA', 'Georgia'),
('HI', 'Hawaii'),
('IA', 'Iowa'),
('ID', 'Idaho'),
('IL', 'Illinois'),
('IN', 'Indiana'),
('KS', 'Kansas'),
('KY', 'Kentucky'),
('LA', 'Louisiana'),
('MA', 'Massachusetts'),
('MD', 'Maryland'),
('ME', 'Maine'),
('MI', 'Michigan'),
('MN', 'Minnesota'),
('MO', 'Missouri'),
('MS', 'Mississippi'),
('MT', 'Montana'),
('NC', 'North Carolina'),
('ND', 'North Dakota'),
('NE', 'Nebraska'),
('NH', 'New Hampshire'),
('NJ', 'New Jersey'),
('NM', 'New Mexico'),
('NV', 'Nevada'),
('NY', 'New York'),
('OH', 'Ohio'),
('OK', 'Oklahoma'),
('OR', 'Oregon'),
('PA', 'Pennsylvania'),
('PR', 'Puerto Rico'),
('RI', 'Rhode Island'),
('SC', 'South Carolina'),
('SD', 'South Dakota'),
('TN', 'Tennessee'),
('TX', 'Texas'),
('UT', 'Utah'),
('VA', 'Virginia'),
('VT', 'Vermont'),
('WA', 'Washington'),
('WI', 'Wisconsin'),
('WV', 'West Virginia'),
('WY', 'Wyoming');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--
-- Creation: Nov 11, 2020 at 10:53 PM
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `Email` varchar(72) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Psword` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `FName` varchar(24) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `LName` varchar(24) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `DOB` date DEFAULT NULL,
  `AccountCreated` datetime DEFAULT current_timestamp(),
  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `city` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `state` varchar(2) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `Email`, `Psword`, `FName`, `LName`, `DOB`, `AccountCreated`, `address`, `city`, `state`) VALUES
(2, 'nicholas.okonek@my.metrostate.edu', '436fa63a99242faee7cbaf566dbf14c3', 'Nick', 'Okonek', '1984-08-06', '2020-10-12 21:34:45', '649 North Street', 'St. Paul', 'MN'),
(15, 'tigerking@oklahomastate.pen', '731b9b2056081c69bd32f4f64230e71d', 'Joe', 'Exotic', '1973-03-15', '2020-11-05 21:55:19', '1234 county jail road', 'nowhere', 'OK'),
(16, 'mikej@gmail.com', 'b4af804009cb036a4ccdc33431ef9ac9', 'Mike', 'Johnson', '1900-10-27', '2020-11-18 20:14:05', '2040 east road', 'North st paul', 'MN'),
(17, 'irmedia@gmail.com', 'b4af804009cb036a4ccdc33431ef9ac9', 'IR-Manager', 'Media-House', '2000-03-24', '2020-11-18 20:19:23', '2040 north road', 'Minneapolis', 'MN');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `company`
--
ALTER TABLE `company`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `companyName_UNIQUE` (`companyName`);

--
-- Indexes for table `coupons`
--
ALTER TABLE `coupons`
  ADD PRIMARY KEY (`id`),
  ADD KEY `distributingCo_idx` (`company`);

--
-- Indexes for table `pwdreset`
--
ALTER TABLE `pwdreset`
  ADD PRIMARY KEY (`pwdResetID`);

--
-- Indexes for table `retailers`
--
ALTER TABLE `retailers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `company_idx` (`Company`);

--
-- Indexes for table `sitemap`
--
ALTER TABLE `sitemap`
  ADD PRIMARY KEY (`pageID`);

--
-- Indexes for table `state`
--
ALTER TABLE `state`
  ADD PRIMARY KEY (`code`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `state_idx` (`state`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `company`
--
ALTER TABLE `company`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `coupons`
--
ALTER TABLE `coupons`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `pwdreset`
--
ALTER TABLE `pwdreset`
  MODIFY `pwdResetID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `retailers`
--
ALTER TABLE `retailers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `coupons`
--
ALTER TABLE `coupons`
  ADD CONSTRAINT `distributingCo` FOREIGN KEY (`company`) REFERENCES `company` (`companyName`);

--
-- Constraints for table `retailers`
--
ALTER TABLE `retailers`
  ADD CONSTRAINT `company` FOREIGN KEY (`Company`) REFERENCES `company` (`companyName`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
