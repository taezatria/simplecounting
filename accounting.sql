-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jun 21, 2017 at 07:10 AM
-- Server version: 10.1.13-MariaDB
-- PHP Version: 5.6.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `accounting`
--

-- --------------------------------------------------------

--
-- Table structure for table `coa`
--

CREATE TABLE `coa` (
  `ref` int(4) NOT NULL,
  `name` varchar(30) NOT NULL,
  `val` varchar(6) NOT NULL,
  `type` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `coa`
--

INSERT INTO `coa` (`ref`, `name`, `val`, `type`) VALUES
(101, 'Cash', 'debit', 1),
(201, 'Inventory', 'debit', 2),
(202, 'Account Receivable', 'debit', 2),
(301, 'Account Payable', 'credit', 3),
(401, 'Sales Revenue', 'credit', 4),
(501, 'Purchase Expense', 'debit', 5),
(502, 'COGS', 'debit', 5),
(601, 'Capital', 'credit', 6);

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `id` int(11) NOT NULL,
  `name` varchar(30) NOT NULL,
  `address` varchar(50) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `email` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`id`, `name`, `address`, `phone`, `email`) VALUES
(1, 'PT. Plastik Corp.', 'Sriwulandari XXI', '032-1234567', 'hr@plastik.corp'),
(2, 'Semens Tigas', 'Soekar Sekali', '032-1234567', 'custom@soekar'),
(3, 'Tambahan', 'Kucing Anjing Tikus 35', '943-324569', 'tambahan@dummy');

-- --------------------------------------------------------

--
-- Table structure for table `det_purchases`
--

CREATE TABLE `det_purchases` (
  `id` int(11) NOT NULL,
  `amount` int(11) NOT NULL,
  `subtotal` int(11) NOT NULL,
  `received` int(11) NOT NULL,
  `id_po` int(11) NOT NULL,
  `id_invent` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `det_purchases`
--

INSERT INTO `det_purchases` (`id`, `amount`, `subtotal`, `received`, `id_po`, `id_invent`) VALUES
(1, 5, 5000, 0, 1, 1),
(2, 10, 10000, 0, 1, 2),
(3, 2, 10000, 2, 2, 1),
(4, 4, 20000, 4, 2, 2);

-- --------------------------------------------------------

--
-- Table structure for table `det_sales`
--

CREATE TABLE `det_sales` (
  `id` int(11) NOT NULL,
  `amount` int(11) NOT NULL,
  `subtotal` int(11) NOT NULL,
  `sent` int(11) NOT NULL,
  `id_so` int(11) NOT NULL,
  `id_invent` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `det_sales`
--

INSERT INTO `det_sales` (`id`, `amount`, `subtotal`, `sent`, `id_so`, `id_invent`) VALUES
(1, 2, 5000, 2, 1, 1),
(2, 4, 10000, 4, 1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `inventory`
--

CREATE TABLE `inventory` (
  `id` int(11) NOT NULL,
  `name` varchar(30) NOT NULL,
  `stock` int(11) NOT NULL,
  `price` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `inventory`
--

INSERT INTO `inventory` (`id`, `name`, `stock`, `price`) VALUES
(1, 'Masakok', 3, 2000),
(2, 'Mericak', 6, 1500);

-- --------------------------------------------------------

--
-- Table structure for table `journal`
--

CREATE TABLE `journal` (
  `id` int(11) NOT NULL,
  `tgl` datetime NOT NULL,
  `ref` int(11) NOT NULL,
  `det` varchar(50) DEFAULT NULL,
  `debit` int(11) DEFAULT NULL,
  `credit` int(11) DEFAULT NULL,
  `id_so` int(11) DEFAULT NULL,
  `id_po` int(11) DEFAULT NULL,
  `posted` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `journal`
--

INSERT INTO `journal` (`id`, `tgl`, `ref`, `det`, `debit`, `credit`, `id_so`, `id_po`, `posted`) VALUES
(2, '2017-06-06 00:00:00', 101, 'mopdal awal', 100000, NULL, NULL, NULL, 1),
(3, '2017-06-06 00:00:00', 601, 'modal', NULL, 100000, NULL, NULL, 1),
(12, '2017-06-21 11:38:19', 301, 'Pembayaran Pembelian', 30000, 0, NULL, 2, 1),
(13, '2017-06-21 11:38:19', 101, 'Pembayaran Pembelian', 0, 30000, NULL, 2, 1),
(14, '2017-06-21 11:45:32', 101, 'Pembayaran Pembelian', 15000, 0, NULL, 1, 1),
(15, '2017-06-21 11:45:32', 202, 'Pembayaran Pembelian', 0, 15000, NULL, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `parameter`
--

CREATE TABLE `parameter` (
  `id` varchar(30) NOT NULL,
  `ref` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `parameter`
--

INSERT INTO `parameter` (`id`, `ref`) VALUES
('1', 401),
('2', 202),
('3', 201),
('4', 502),
('5', 301),
('6', 101);

-- --------------------------------------------------------

--
-- Table structure for table `purchases_order`
--

CREATE TABLE `purchases_order` (
  `id` int(11) NOT NULL,
  `tgl` datetime NOT NULL,
  `id_sup` int(11) NOT NULL,
  `total` int(11) NOT NULL,
  `status` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `purchases_order`
--

INSERT INTO `purchases_order` (`id`, `tgl`, `id_sup`, `total`, `status`) VALUES
(1, '2017-05-16 00:00:00', 1, 15000, 'pending'),
(2, '2017-06-13 00:00:00', 1, 30000, 'done');

-- --------------------------------------------------------

--
-- Table structure for table `sales_order`
--

CREATE TABLE `sales_order` (
  `id` int(11) NOT NULL,
  `tgl` datetime NOT NULL,
  `id_cust` int(11) NOT NULL,
  `total` int(11) NOT NULL,
  `status` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sales_order`
--

INSERT INTO `sales_order` (`id`, `tgl`, `id_cust`, `total`, `status`) VALUES
(1, '2017-05-31 00:00:00', 1, 15000, 'done');

-- --------------------------------------------------------

--
-- Table structure for table `supplier`
--

CREATE TABLE `supplier` (
  `id` int(11) NOT NULL,
  `name` varchar(30) NOT NULL,
  `address` varchar(50) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `email` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `supplier`
--

INSERT INTO `supplier` (`id`, `name`, `address`, `phone`, `email`) VALUES
(1, 'Badja Hitam', 'Barat Daya no 90', '012-4331234', 'sadtria@badja.htm'),
(2, 'Emas Mulya', 'Suka Darma', '093-2345432', 'cs@bangun.kar');

-- --------------------------------------------------------

--
-- Table structure for table `type`
--

CREATE TABLE `type` (
  `id` int(11) NOT NULL,
  `name` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `type`
--

INSERT INTO `type` (`id`, `name`) VALUES
(1, 'Cash'),
(2, 'Asset'),
(3, 'Liability'),
(4, 'Revenue'),
(5, 'Expense'),
(6, 'Capital');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `coa`
--
ALTER TABLE `coa`
  ADD PRIMARY KEY (`ref`),
  ADD KEY `type_coa` (`type`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `det_purchases`
--
ALTER TABLE `det_purchases`
  ADD PRIMARY KEY (`id`),
  ADD KEY `detpo_id` (`id_po`),
  ADD KEY `inventpo_id` (`id_invent`);

--
-- Indexes for table `det_sales`
--
ALTER TABLE `det_sales`
  ADD PRIMARY KEY (`id`),
  ADD KEY `detso_id` (`id_so`),
  ADD KEY `inventso_id` (`id_invent`);

--
-- Indexes for table `inventory`
--
ALTER TABLE `inventory`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `journal`
--
ALTER TABLE `journal`
  ADD PRIMARY KEY (`id`),
  ADD KEY `coa_id` (`ref`),
  ADD KEY `so_id` (`id_so`),
  ADD KEY `po_id` (`id_po`);

--
-- Indexes for table `parameter`
--
ALTER TABLE `parameter`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `purchases_order`
--
ALTER TABLE `purchases_order`
  ADD PRIMARY KEY (`id`),
  ADD KEY `supp_id` (`id_sup`);

--
-- Indexes for table `sales_order`
--
ALTER TABLE `sales_order`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cust_id` (`id_cust`);

--
-- Indexes for table `supplier`
--
ALTER TABLE `supplier`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `type`
--
ALTER TABLE `type`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `det_purchases`
--
ALTER TABLE `det_purchases`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `det_sales`
--
ALTER TABLE `det_sales`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `inventory`
--
ALTER TABLE `inventory`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `journal`
--
ALTER TABLE `journal`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `purchases_order`
--
ALTER TABLE `purchases_order`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `sales_order`
--
ALTER TABLE `sales_order`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `supplier`
--
ALTER TABLE `supplier`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `coa`
--
ALTER TABLE `coa`
  ADD CONSTRAINT `type_coa` FOREIGN KEY (`type`) REFERENCES `type` (`id`);

--
-- Constraints for table `det_purchases`
--
ALTER TABLE `det_purchases`
  ADD CONSTRAINT `detpo_id` FOREIGN KEY (`id_po`) REFERENCES `purchases_order` (`id`),
  ADD CONSTRAINT `inventpo_id` FOREIGN KEY (`id_invent`) REFERENCES `inventory` (`id`);

--
-- Constraints for table `det_sales`
--
ALTER TABLE `det_sales`
  ADD CONSTRAINT `detso_id` FOREIGN KEY (`id_so`) REFERENCES `sales_order` (`id`),
  ADD CONSTRAINT `inventso_id` FOREIGN KEY (`id_invent`) REFERENCES `inventory` (`id`);

--
-- Constraints for table `journal`
--
ALTER TABLE `journal`
  ADD CONSTRAINT `coa_id` FOREIGN KEY (`ref`) REFERENCES `coa` (`ref`),
  ADD CONSTRAINT `po_id` FOREIGN KEY (`id_po`) REFERENCES `purchases_order` (`id`),
  ADD CONSTRAINT `so_id` FOREIGN KEY (`id_so`) REFERENCES `sales_order` (`id`);

--
-- Constraints for table `purchases_order`
--
ALTER TABLE `purchases_order`
  ADD CONSTRAINT `supp_id` FOREIGN KEY (`id_sup`) REFERENCES `supplier` (`id`);

--
-- Constraints for table `sales_order`
--
ALTER TABLE `sales_order`
  ADD CONSTRAINT `cust_id` FOREIGN KEY (`id_cust`) REFERENCES `customer` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
