-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 11, 2024 at 06:32 PM
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
-- Database: `inventory_management`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `CategoryID` int(11) NOT NULL,
  `CategoryName` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`CategoryID`, `CategoryName`) VALUES
(1, 'chips');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `CustomerID` int(11) NOT NULL,
  `CustomerName` varchar(255) DEFAULT NULL,
  `ContactNumber` varchar(20) DEFAULT NULL,
  `Email` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`CustomerID`, `CustomerName`, `ContactNumber`, `Email`) VALUES
(1, 'Walking', '23423423', 'walking@walk.com');

-- --------------------------------------------------------

--
-- Table structure for table `inventory`
--

CREATE TABLE `inventory` (
  `ProductID` int(11) NOT NULL,
  `ProductName` varchar(255) DEFAULT NULL,
  `Description` text DEFAULT NULL,
  `QuantityInStock` int(11) DEFAULT NULL,
  `UnitPrice` decimal(10,2) DEFAULT NULL,
  `ReorderLevel` int(11) DEFAULT NULL,
  `VendorID` int(11) DEFAULT NULL,
  `CategoryID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `inventory`
--

INSERT INTO `inventory` (`ProductID`, `ProductName`, `Description`, `QuantityInStock`, `UnitPrice`, `ReorderLevel`, `VendorID`, `CategoryID`) VALUES
(1, 'lays', 'lays', 134, 24.00, 0, 1, 1),
(8, 'Khalid', 'Khalid', 55, 1000.00, 0, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `purchasedetail`
--

CREATE TABLE `purchasedetail` (
  `PurchaseDetailID` int(11) NOT NULL,
  `PurchaseID` int(11) DEFAULT NULL,
  `ProductID` int(11) DEFAULT NULL,
  `QuantityPurchased` int(11) DEFAULT NULL,
  `UnitPrice` decimal(10,2) DEFAULT NULL,
  `Subtotal` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `purchasedetail`
--

INSERT INTO `purchasedetail` (`PurchaseDetailID`, `PurchaseID`, `ProductID`, `QuantityPurchased`, `UnitPrice`, `Subtotal`) VALUES
(1, 10, 1, 50, 50.00, 2500.00),
(2, 10, 1, 50, 60.00, 3000.00),
(3, 11, 8, 200, 800.00, 160000.00),
(4, 11, 1, 200, 10.00, 2000.00),
(5, 12, 1, 30, 50.00, 1500.00),
(6, 12, 8, 30, 10.00, 300.00);

-- --------------------------------------------------------

--
-- Table structure for table `purchasemaster`
--

CREATE TABLE `purchasemaster` (
  `PurchaseID` int(11) NOT NULL,
  `PurchaseDate` date DEFAULT current_timestamp(),
  `VendorID` int(11) DEFAULT NULL,
  `TotalAmount` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `purchasemaster`
--

INSERT INTO `purchasemaster` (`PurchaseID`, `PurchaseDate`, `VendorID`, `TotalAmount`) VALUES
(1, '2024-01-11', 1, 2500.00),
(2, '2024-01-11', 1, 2500.00),
(3, '2024-01-11', 1, 2500.00),
(4, '2024-01-11', 1, 2500.00),
(5, '2024-01-11', 1, 2500.00),
(6, '2024-01-11', 1, 2500.00),
(7, '2024-01-11', 1, 7500.00),
(8, '2024-01-11', 1, 12500.00),
(9, '2024-01-11', 1, 12500.00),
(10, '2024-01-11', 1, 5500.00),
(11, '2024-01-11', 1, 162000.00),
(12, '2024-01-11', 1, 1800.00);

-- --------------------------------------------------------

--
-- Table structure for table `salesdetail`
--

CREATE TABLE `salesdetail` (
  `SaleDetailID` int(11) NOT NULL,
  `SaleID` int(11) DEFAULT NULL,
  `ProductID` int(11) DEFAULT NULL,
  `QuantitySold` int(11) DEFAULT NULL,
  `UnitPrice` decimal(10,2) DEFAULT NULL,
  `Subtotal` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `salesdetail`
--

INSERT INTO `salesdetail` (`SaleDetailID`, `SaleID`, `ProductID`, `QuantitySold`, `UnitPrice`, `Subtotal`) VALUES
(1, 0, 1, 40, 30.00, 1200.00),
(2, 2, 1, 100, 20.00, 2000.00),
(3, 2, 8, 20, 30.00, 600.00),
(4, 3, 1, 1, 134.00, 134.00),
(5, 3, 8, 1, 135.00, 135.00),
(6, 4, 8, 50, 50.00, 2500.00),
(7, 4, 1, 30, 10.00, 300.00),
(8, 5, 8, 55, 55.00, 3025.00),
(9, 6, 8, 49, 30.00, 1470.00),
(10, 6, 1, 49, 30.00, 1470.00);

-- --------------------------------------------------------

--
-- Table structure for table `salesmaster`
--

CREATE TABLE `salesmaster` (
  `SaleID` int(11) NOT NULL,
  `SaleDate` date DEFAULT current_timestamp(),
  `CustomerID` int(11) DEFAULT NULL,
  `TotalAmount` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `salesmaster`
--

INSERT INTO `salesmaster` (`SaleID`, `SaleDate`, `CustomerID`, `TotalAmount`) VALUES
(1, NULL, 1, 2400.00),
(2, '2024-01-11', 1, 2600.00),
(3, '2024-01-11', 1, 269.00),
(4, '2024-01-11', 1, 2800.00),
(5, '2024-01-11', 1, 3025.00),
(6, '2024-01-11', 1, 2940.00);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `UserID` int(11) NOT NULL,
  `Username` varchar(255) DEFAULT NULL,
  `Password` varchar(255) DEFAULT NULL,
  `FirstName` varchar(255) DEFAULT NULL,
  `LastName` varchar(255) DEFAULT NULL,
  `Email` varchar(255) DEFAULT NULL,
  `UserRole` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`UserID`, `Username`, `Password`, `FirstName`, `LastName`, `Email`, `UserRole`) VALUES
(1, 'baghakhalid', '0311khalid', 'Khalid ', 'Bagha', 'khalidbaga222@gmail.com', 'admin'),
(2, 'asra', '12345', 'asra', 'muneeb', 'asra@a.com', 'admin'),
(3, 'adu', '12345', 'adeena', 'asif', 'adeena222@gmail.com', 'manager');

-- --------------------------------------------------------

--
-- Table structure for table `vendors`
--

CREATE TABLE `vendors` (
  `VendorID` int(11) NOT NULL,
  `VendorName` varchar(255) DEFAULT NULL,
  `ContactPerson` varchar(255) DEFAULT NULL,
  `ContactNumber` varchar(20) DEFAULT NULL,
  `Email` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `vendors`
--

INSERT INTO `vendors` (`VendorID`, `VendorName`, `ContactPerson`, `ContactNumber`, `Email`) VALUES
(1, 'Hilal', 'Qasim', '2342234243', 'asd@asd.com');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`CategoryID`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`CustomerID`);

--
-- Indexes for table `inventory`
--
ALTER TABLE `inventory`
  ADD PRIMARY KEY (`ProductID`),
  ADD KEY `VendorID` (`VendorID`),
  ADD KEY `CategoryID` (`CategoryID`);

--
-- Indexes for table `purchasedetail`
--
ALTER TABLE `purchasedetail`
  ADD PRIMARY KEY (`PurchaseDetailID`),
  ADD KEY `PurchaseID` (`PurchaseID`),
  ADD KEY `ProductID` (`ProductID`);

--
-- Indexes for table `purchasemaster`
--
ALTER TABLE `purchasemaster`
  ADD PRIMARY KEY (`PurchaseID`),
  ADD KEY `VendorID` (`VendorID`);

--
-- Indexes for table `salesdetail`
--
ALTER TABLE `salesdetail`
  ADD PRIMARY KEY (`SaleDetailID`),
  ADD KEY `SaleID` (`SaleID`),
  ADD KEY `ProductID` (`ProductID`);

--
-- Indexes for table `salesmaster`
--
ALTER TABLE `salesmaster`
  ADD PRIMARY KEY (`SaleID`),
  ADD KEY `CustomerID` (`CustomerID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`UserID`);

--
-- Indexes for table `vendors`
--
ALTER TABLE `vendors`
  ADD PRIMARY KEY (`VendorID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `CategoryID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `CustomerID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `inventory`
--
ALTER TABLE `inventory`
  MODIFY `ProductID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `purchasedetail`
--
ALTER TABLE `purchasedetail`
  MODIFY `PurchaseDetailID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `purchasemaster`
--
ALTER TABLE `purchasemaster`
  MODIFY `PurchaseID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `salesdetail`
--
ALTER TABLE `salesdetail`
  MODIFY `SaleDetailID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `salesmaster`
--
ALTER TABLE `salesmaster`
  MODIFY `SaleID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `UserID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `vendors`
--
ALTER TABLE `vendors`
  MODIFY `VendorID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `inventory`
--
ALTER TABLE `inventory`
  ADD CONSTRAINT `inventory_ibfk_1` FOREIGN KEY (`VendorID`) REFERENCES `vendors` (`VendorID`),
  ADD CONSTRAINT `inventory_ibfk_2` FOREIGN KEY (`CategoryID`) REFERENCES `categories` (`CategoryID`);

--
-- Constraints for table `purchasedetail`
--
ALTER TABLE `purchasedetail`
  ADD CONSTRAINT `purchasedetail_ibfk_1` FOREIGN KEY (`PurchaseID`) REFERENCES `purchasemaster` (`PurchaseID`),
  ADD CONSTRAINT `purchasedetail_ibfk_2` FOREIGN KEY (`ProductID`) REFERENCES `inventory` (`ProductID`);

--
-- Constraints for table `purchasemaster`
--
ALTER TABLE `purchasemaster`
  ADD CONSTRAINT `purchasemaster_ibfk_1` FOREIGN KEY (`VendorID`) REFERENCES `vendors` (`VendorID`);

--
-- Constraints for table `salesdetail`
--
ALTER TABLE `salesdetail`
  ADD CONSTRAINT `salesdetail_ibfk_1` FOREIGN KEY (`SaleID`) REFERENCES `salesmaster` (`SaleID`),
  ADD CONSTRAINT `salesdetail_ibfk_2` FOREIGN KEY (`ProductID`) REFERENCES `inventory` (`ProductID`);

--
-- Constraints for table `salesmaster`
--
ALTER TABLE `salesmaster`
  ADD CONSTRAINT `salesmaster_ibfk_1` FOREIGN KEY (`CustomerID`) REFERENCES `customers` (`CustomerID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
