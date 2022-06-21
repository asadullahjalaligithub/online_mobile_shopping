-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 19, 2022 at 03:58 AM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 7.4.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mobile`
--

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `customerid` int(11) NOT NULL,
  `userid` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`customerid`, `userid`) VALUES
(112, 18),
(113, 19);

-- --------------------------------------------------------

--
-- Table structure for table `purchase`
--

CREATE TABLE `purchase` (
  `purchaseid` int(11) NOT NULL,
  `purchasedate` date NOT NULL,
  `purchaseamount` int(11) NOT NULL,
  `purchaseprice` int(11) NOT NULL,
  `mobileid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `purchase`
--

INSERT INTO `purchase` (`purchaseid`, `purchasedate`, `purchaseamount`, `purchaseprice`, `mobileid`) VALUES
(1, '2022-06-09', 50, 200, 29),
(2, '2022-06-10', 30, 150, 25),
(3, '2022-06-15', 50, 250, 25);

-- --------------------------------------------------------

--
-- Table structure for table `sale`
--

CREATE TABLE `sale` (
  `saleid` int(11) NOT NULL,
  `saledate` date NOT NULL,
  `saleamount` int(11) NOT NULL,
  `saleprice` int(11) NOT NULL,
  `mobileid` int(11) NOT NULL,
  `customerid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sale`
--

INSERT INTO `sale` (`saleid`, `saledate`, `saleamount`, `saleprice`, `mobileid`, `customerid`) VALUES
(1, '2222-06-18', 12, 260, 25, 113),
(2, '2222-06-18', 12, 260, 25, 113),
(3, '2222-06-18', 10, 210, 29, 113),
(4, '2222-06-18', 30, 210, 29, 112);

-- --------------------------------------------------------

--
-- Table structure for table `stock`
--

CREATE TABLE `stock` (
  `stockid` int(11) NOT NULL,
  `mobileid` int(11) NOT NULL,
  `amount` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `stock`
--

INSERT INTO `stock` (`stockid`, `mobileid`, `amount`) VALUES
(1, 29, 10),
(2, 25, 56);

-- --------------------------------------------------------

--
-- Table structure for table `tblmobile`
--

CREATE TABLE `tblmobile` (
  `mobileid` int(11) NOT NULL,
  `mobilebrand` varchar(50) NOT NULL,
  `mobileseries` varchar(50) NOT NULL,
  `mobilemodel` varchar(50) NOT NULL,
  `mobilecolor` varchar(50) NOT NULL,
  `mobileimage` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tblmobile`
--

INSERT INTO `tblmobile` (`mobileid`, `mobilebrand`, `mobileseries`, `mobilemodel`, `mobilecolor`, `mobileimage`) VALUES
(25, 'Apple', 'X13', '2021', 'Silver', '1655536816.jpg'),
(27, 'Samsung', 'Note', '2018', 'Black', '1655536846.jpg'),
(29, 'Huwai', 'w', '2022', 'silver', '1655537083.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `tblorder`
--

CREATE TABLE `tblorder` (
  `orderid` int(11) NOT NULL,
  `mobileid` int(11) NOT NULL,
  `orderamount` int(11) NOT NULL,
  `orderprice` int(11) NOT NULL,
  `orderdate` date NOT NULL,
  `customerid` int(11) NOT NULL,
  `status` varchar(20) NOT NULL DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tblorder`
--

INSERT INTO `tblorder` (`orderid`, `mobileid`, `orderamount`, `orderprice`, `orderdate`, `customerid`, `status`) VALUES
(1, 25, 12, 260, '2222-06-18', 113, 'approved'),
(2, 29, 10, 210, '2222-06-18', 113, 'approved'),
(3, 29, 30, 210, '2222-06-18', 112, 'approved');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `userid` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `name` varchar(50) NOT NULL,
  `surname` varchar(50) NOT NULL,
  `address` varchar(100) NOT NULL,
  `dob` date DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `privilage` varchar(50) NOT NULL DEFAULT 'customer',
  `status` varchar(50) NOT NULL DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`userid`, `username`, `password`, `name`, `surname`, `address`, `dob`, `email`, `privilage`, `status`) VALUES
(1, 'marzia.rahimi', 'marzia', 'Marzia', '', 'Badakhsan, Afghanistan', '2000-12-05', 'marzia.rahimi@gmail.com', 'admin', 'enable'),
(18, 'ahmadullah.sharifi', 'ahmadullah', 'ahmadullah', 'sharifi', 'kabul, Afghanistan', '2001-06-01', 'ahmadullah@gmail.com', 'customer', 'enable'),
(19, 'karimullah.khorami', 'karimullah', 'karimullah', 'khorami', 'herat, AFghanistan', '2005-03-06', 'karimullah@gmail.com', 'customer', 'enable');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`customerid`),
  ADD KEY `customer_user_relation` (`userid`);

--
-- Indexes for table `purchase`
--
ALTER TABLE `purchase`
  ADD PRIMARY KEY (`purchaseid`),
  ADD KEY `mobile_purchase_relation` (`mobileid`);

--
-- Indexes for table `sale`
--
ALTER TABLE `sale`
  ADD PRIMARY KEY (`saleid`),
  ADD KEY `sale_mobile_relation` (`mobileid`),
  ADD KEY `sale_customer_relation` (`customerid`);

--
-- Indexes for table `stock`
--
ALTER TABLE `stock`
  ADD PRIMARY KEY (`stockid`),
  ADD KEY `mobile_stock_relation` (`mobileid`);

--
-- Indexes for table `tblmobile`
--
ALTER TABLE `tblmobile`
  ADD PRIMARY KEY (`mobileid`),
  ADD UNIQUE KEY `mobilebrand` (`mobilebrand`);

--
-- Indexes for table `tblorder`
--
ALTER TABLE `tblorder`
  ADD PRIMARY KEY (`orderid`),
  ADD KEY `order_mobile_relation` (`mobileid`),
  ADD KEY `order_customer_relation` (`customerid`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userid`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `customerid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=114;

--
-- AUTO_INCREMENT for table `purchase`
--
ALTER TABLE `purchase`
  MODIFY `purchaseid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `sale`
--
ALTER TABLE `sale`
  MODIFY `saleid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `stock`
--
ALTER TABLE `stock`
  MODIFY `stockid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tblmobile`
--
ALTER TABLE `tblmobile`
  MODIFY `mobileid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `tblorder`
--
ALTER TABLE `tblorder`
  MODIFY `orderid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `userid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `customer`
--
ALTER TABLE `customer`
  ADD CONSTRAINT `customer_user_relation` FOREIGN KEY (`userid`) REFERENCES `users` (`userid`);

--
-- Constraints for table `purchase`
--
ALTER TABLE `purchase`
  ADD CONSTRAINT `mobile_purchase_relation` FOREIGN KEY (`mobileid`) REFERENCES `tblmobile` (`mobileid`);

--
-- Constraints for table `sale`
--
ALTER TABLE `sale`
  ADD CONSTRAINT `sale_customer_relation` FOREIGN KEY (`customerid`) REFERENCES `customer` (`customerid`),
  ADD CONSTRAINT `sale_mobile_relation` FOREIGN KEY (`mobileid`) REFERENCES `tblmobile` (`mobileid`);

--
-- Constraints for table `stock`
--
ALTER TABLE `stock`
  ADD CONSTRAINT `mobile_stock_relation` FOREIGN KEY (`mobileid`) REFERENCES `tblmobile` (`mobileid`);

--
-- Constraints for table `tblorder`
--
ALTER TABLE `tblorder`
  ADD CONSTRAINT `order_customer_relation` FOREIGN KEY (`customerid`) REFERENCES `customer` (`customerid`),
  ADD CONSTRAINT `order_mobile_relation` FOREIGN KEY (`mobileid`) REFERENCES `tblmobile` (`mobileid`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
