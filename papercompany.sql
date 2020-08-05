-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: May 01, 2020 at 11:11 AM
-- Server version: 5.6.44-cll-lve
-- PHP Version: 7.2.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `papercompany`
--

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `custID` int(11) NOT NULL,
  `custName` varchar(64) NOT NULL,
  `custContact` varchar(64) DEFAULT NULL,
  `custPhone` varchar(32) NOT NULL,
  `custEmail` varchar(64) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`custID`, `custName`, `custContact`, `custPhone`, `custEmail`) VALUES
(1, 'Ajax', 'Randy', '601-123-4567', ''),
(2, 'Boure', 'John Currence', '662-555-4433', 'john@boure.com'),
(3, 'Ole Miss', 'Jay', '601-999-8888', 'jayfuller@gmail.com'),
(8, 'Kroger', 'Kenny Powers', '662-555-9874', ''),
(9, 'Noodle Bowl', 'Lina', '662-789-7890', ''),
(10, 'Ole Miss Football', 'Lane Kiffin', '555-444-7777', 'lkiffin@go.olemiss.edu'),
(11, 'Ole Miss Basketball', 'Kermit Davis', '662-111-1111', ''),
(12, 'Ole Miss Baseball', 'Mike Bianco', '601-333-3333', ''),
(4, 'Handy Andy\'s', 'Andy', '662-662-6262', 'andy@handyandy.com'),
(5, 'Old Venice', 'Alicia', '662-888-7799', ''),
(6, 'South Depot', 'Mark', '662-123-1231', '');

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE `employees` (
  `empID` int(11) NOT NULL,
  `empLName` varchar(64) NOT NULL,
  `empFName` varchar(64) NOT NULL,
  `empEmail` varchar(64) NOT NULL,
  `empPhone` varchar(32) NOT NULL,
  `empDOB` varchar(32) NOT NULL,
  `empPassword` varchar(255) NOT NULL,
  `empType` varchar(63) NOT NULL,
  `employeeAuth` varchar(36) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`empID`, `empLName`, `empFName`, `empEmail`, `empPhone`, `empDOB`, `empPassword`, `empType`, `employeeAuth`) VALUES
(1, 'Fuller', 'Jay', 'jmfuller@go.olemiss.edu', '601-988-7111', '10-30-1992', '$2y$10$nYMYamCwPlwx96ur4hg9E.vxgPLH9tCz2J.IuqYqxqhAKvGuII/q2', 'Owner', 'abc123'),
(3, 'Smith', 'Bobby', 'bobby@papercompany.com', '662-999-9999', '06-04-1979', '$2y$10$UzsD1MnPG.9Gnt0YboITx.2YieW52RYc0zGiPA63G8aGFKK7KBwCa', 'Sales', 'abc123'),
(4, 'Brown', 'Mark', 'mark@papercompany.com', '561-561-5610', '12-01-1980', '$2y$10$47J9lnzCPb8w2Yw/DSUCH.WA1DCn3RlMnxApOrKivS9rgORCm8X92', 'Clerk', 'abc123'),
(5, 'Parker', 'Peter', 'peter@papercompany.com', '561-111-2222', '07-01-1989', '$2y$10$tH6cgbmibuogliiRN3cyXeGDQPfqraMNXk6w.qW0Y6MvXvwNiuXca', 'Sales', 'abc123'),
(2, 'Stark', 'Tony', 'tony@papercompany.com', '601-333-4444', '04-21-1981', '$2y$10$sxcip0E23q1ZPLZ86DxuKO91yZNPhNhqkUbyK9p3ozpD3rpAMqzjO', 'Sales', 'abc123'),
(8, 'Jacob', 'Swanson', 'jacob@papercompany.com', '601-897-6767', '1975-01-14', '$2y$10$KyW50S/D/gqtJvVfjLYsJOyJ4ID2PBxnJAJLStcDEEnlITTarK4..', 'Accountant', 'abc123');

-- --------------------------------------------------------

--
-- Table structure for table `inventory`
--

CREATE TABLE `inventory` (
  `invID` int(11) NOT NULL,
  `invName` varchar(63) NOT NULL,
  `invPrice` decimal(10,2) NOT NULL,
  `invDescription` varchar(255) NOT NULL,
  `invRetail` decimal(10,2) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `inventory`
--

INSERT INTO `inventory` (`invID`, `invName`, `invPrice`, `invDescription`, `invRetail`) VALUES
(1, 'PT1', '4.85', 'single paper towel roll', '5.00'),
(2, 'LPT1', '5.15', 'large paper towel roll', '7.00');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `orderID` int(11) NOT NULL,
  `orderCust` int(11) NOT NULL,
  `orderDate` date NOT NULL,
  `orderNotes` varchar(255) NOT NULL,
  `orderTotals` decimal(10,2) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`orderID`, `orderCust`, `orderDate`, `orderNotes`, `orderTotals`) VALUES
(1, 4, '2020-04-22', 'urgent', '1000.00'),
(5, 1, '2020-04-27', 'no rush', '1200.00'),
(3, 4, '2020-04-27', 'paper towels', '2500.00'),
(4, 1, '2020-04-28', 'paper towels small rolls', '1600.00'),
(6, 6, '2020-04-08', 'delivered', '5000.00'),
(7, 10, '2020-05-01', 'football stuff', '1235.00'),
(8, 10, '2020-04-29', 'paper products', '333.00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`custID`);

--
-- Indexes for table `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`empID`);

--
-- Indexes for table `inventory`
--
ALTER TABLE `inventory`
  ADD PRIMARY KEY (`invID`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`orderID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `custID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
  MODIFY `empID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `inventory`
--
ALTER TABLE `inventory`
  MODIFY `invID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `orderID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
