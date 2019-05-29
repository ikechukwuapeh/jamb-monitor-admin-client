-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 31, 2018 at 04:13 PM
-- Server version: 10.1.26-MariaDB
-- PHP Version: 7.1.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `jambmanager`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_id` bigint(20) NOT NULL,
  `fullname` text NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `branches`
--

CREATE TABLE `branches` (
  `branch_id` bigint(20) NOT NULL,
  `branch_name` text NOT NULL,
  `branch_location` text NOT NULL,
  `client_id` bigint(20) NOT NULL,
  `deleted` int(2) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



--
-- Table structure for table `branch_pin_allocated`
--

CREATE TABLE `branch_pin_allocated` (
  `pin_allocate_id` bigint(20) NOT NULL,
  `number_of_pins` text NOT NULL,
  `branch_id` bigint(20) NOT NULL,
  `amount_per_pin` text NOT NULL,
  `client_id` bigint(20) NOT NULL,
  `allocate_date` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


--
-- Table structure for table `branch_reconcile`
--

CREATE TABLE `branch_reconcile` (
  `reconcile_id` bigint(20) NOT NULL,
  `branch_id` bigint(20) NOT NULL,
  `client_id` bigint(20) NOT NULL,
  `amount_paid` text NOT NULL,
  `payment_date` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `clients`
--

CREATE TABLE `clients` (
  `client_id` bigint(20) NOT NULL,
  `fullname` text NOT NULL,
  `email` text NOT NULL,
  `phone` varchar(15) NOT NULL,
  `password` text NOT NULL,
  `company_name` text NOT NULL,
  `address` text NOT NULL,
  `register_date` text NOT NULL,
  `status` int(2) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



--
-- Table structure for table `client_pin_allocated`
--

CREATE TABLE `client_pin_allocated` (
  `pin_allocate_id` bigint(20) NOT NULL,
  `number_of_pins` text NOT NULL,
  `amount_per_pin` text NOT NULL,
  `branch_id` bigint(20) NOT NULL,
  `client_user_id` bigint(20) NOT NULL,
  `allocate_date` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `client_users`
--

CREATE TABLE `client_users` (
  `client_user_id` bigint(20) NOT NULL,
  `fullname` text NOT NULL,
  `email` text NOT NULL,
  `phone` varchar(20) NOT NULL,
  `password` text NOT NULL,
  `branch_id` bigint(20) NOT NULL,
  `register_date` text NOT NULL,
  `client_id` bigint(20) NOT NULL,
  `role` varchar(50) NOT NULL,
  `deleted` int(2) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Table structure for table `dealers`
--

CREATE TABLE `dealers` (
  `dealer_id` bigint(20) NOT NULL,
  `fullname` text NOT NULL,
  `phone` varchar(20) NOT NULL,
  `email` text NOT NULL,
  `password` text NOT NULL,
  `company_name` text NOT NULL,
  `address` text NOT NULL,
  `client_id` bigint(20) NOT NULL,
  `deleted` int(2) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


--
-- Table structure for table `dealer_pin_allocated`
--

CREATE TABLE `dealer_pin_allocated` (
  `pin_allocate_id` bigint(20) NOT NULL,
  `number_of_pins` text NOT NULL,
  `dealer_id` bigint(20) NOT NULL,
  `amount_per_pin` text NOT NULL,
  `client_id` bigint(20) NOT NULL,
  `allocate_date` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `dealer_reconcile`
--

CREATE TABLE `dealer_reconcile` (
  `reconcile_id` bigint(20) NOT NULL,
  `dealer_id` bigint(20) NOT NULL,
  `client_id` bigint(20) NOT NULL,
  `amount_paid` text NOT NULL,
  `payment_date` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `student_record`
--

CREATE TABLE `student_record` (
  `student_record_id` bigint(20) NOT NULL,
  `fullname` text,
  `phone` text,
  `jamb_profile_code` text,
  `ref_key` text NOT NULL,
  `pin_status` int(2) NOT NULL DEFAULT '0',
  `register_status` int(2) NOT NULL DEFAULT '0',
  `client_id` bigint(20) NOT NULL,
  `branch_id` bigint(20) NOT NULL,
  `key_date` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `branches`
--
ALTER TABLE `branches`
  ADD PRIMARY KEY (`branch_id`),
  ADD KEY `client_id` (`client_id`);

--
-- Indexes for table `branch_pin_allocated`
--
ALTER TABLE `branch_pin_allocated`
  ADD PRIMARY KEY (`pin_allocate_id`),
  ADD KEY `branch_id` (`branch_id`),
  ADD KEY `client_id` (`client_id`);

--
-- Indexes for table `branch_reconcile`
--
ALTER TABLE `branch_reconcile`
  ADD PRIMARY KEY (`reconcile_id`),
  ADD KEY `branch_id` (`branch_id`),
  ADD KEY `client_id` (`client_id`);

--
-- Indexes for table `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`client_id`);

--
-- Indexes for table `client_pin_allocated`
--
ALTER TABLE `client_pin_allocated`
  ADD PRIMARY KEY (`pin_allocate_id`),
  ADD KEY `branch_id` (`branch_id`),
  ADD KEY `client_user_id` (`client_user_id`);

--
-- Indexes for table `client_users`
--
ALTER TABLE `client_users`
  ADD PRIMARY KEY (`client_user_id`),
  ADD KEY `client_id` (`client_id`),
  ADD KEY `branch_id` (`branch_id`);

--
-- Indexes for table `dealers`
--
ALTER TABLE `dealers`
  ADD PRIMARY KEY (`dealer_id`),
  ADD KEY `client_id` (`client_id`);

--
-- Indexes for table `dealer_pin_allocated`
--
ALTER TABLE `dealer_pin_allocated`
  ADD PRIMARY KEY (`pin_allocate_id`),
  ADD KEY `dealer_id` (`dealer_id`),
  ADD KEY `client_id` (`client_id`);

--
-- Indexes for table `dealer_reconcile`
--
ALTER TABLE `dealer_reconcile`
  ADD PRIMARY KEY (`reconcile_id`),
  ADD KEY `client_id` (`client_id`),
  ADD KEY `dealer_id` (`dealer_id`);

--
-- Indexes for table `student_record`
--
ALTER TABLE `student_record`
  ADD PRIMARY KEY (`student_record_id`),
  ADD KEY `branch_id` (`branch_id`),
  ADD KEY `client_id` (`client_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `branches`
--
ALTER TABLE `branches`
  MODIFY `branch_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `branch_pin_allocated`
--
ALTER TABLE `branch_pin_allocated`
  MODIFY `pin_allocate_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `branch_reconcile`
--
ALTER TABLE `branch_reconcile`
  MODIFY `reconcile_id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `clients`
--
ALTER TABLE `clients`
  MODIFY `client_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `client_pin_allocated`
--
ALTER TABLE `client_pin_allocated`
  MODIFY `pin_allocate_id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `client_users`
--
ALTER TABLE `client_users`
  MODIFY `client_user_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `dealers`
--
ALTER TABLE `dealers`
  MODIFY `dealer_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `dealer_pin_allocated`
--
ALTER TABLE `dealer_pin_allocated`
  MODIFY `pin_allocate_id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `dealer_reconcile`
--
ALTER TABLE `dealer_reconcile`
  MODIFY `reconcile_id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `student_record`
--
ALTER TABLE `student_record`
  MODIFY `student_record_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2501;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `branches`
--
ALTER TABLE `branches`
  ADD CONSTRAINT `branches_ibfk_1` FOREIGN KEY (`client_id`) REFERENCES `clients` (`client_id`);

--
-- Constraints for table `branch_pin_allocated`
--
ALTER TABLE `branch_pin_allocated`
  ADD CONSTRAINT `branch_pin_allocated_ibfk_1` FOREIGN KEY (`branch_id`) REFERENCES `branches` (`branch_id`),
  ADD CONSTRAINT `branch_pin_allocated_ibfk_2` FOREIGN KEY (`client_id`) REFERENCES `clients` (`client_id`);

--
-- Constraints for table `branch_reconcile`
--
ALTER TABLE `branch_reconcile`
  ADD CONSTRAINT `branch_reconcile_ibfk_1` FOREIGN KEY (`branch_id`) REFERENCES `branches` (`branch_id`),
  ADD CONSTRAINT `branch_reconcile_ibfk_2` FOREIGN KEY (`client_id`) REFERENCES `clients` (`client_id`);

--
-- Constraints for table `client_pin_allocated`
--
ALTER TABLE `client_pin_allocated`
  ADD CONSTRAINT `client_pin_allocated_ibfk_1` FOREIGN KEY (`branch_id`) REFERENCES `branches` (`branch_id`),
  ADD CONSTRAINT `client_pin_allocated_ibfk_2` FOREIGN KEY (`client_user_id`) REFERENCES `clients` (`client_id`);

--
-- Constraints for table `client_users`
--
ALTER TABLE `client_users`
  ADD CONSTRAINT `client_users_ibfk_1` FOREIGN KEY (`client_id`) REFERENCES `clients` (`client_id`),
  ADD CONSTRAINT `client_users_ibfk_2` FOREIGN KEY (`branch_id`) REFERENCES `branches` (`branch_id`);

--
-- Constraints for table `dealers`
--
ALTER TABLE `dealers`
  ADD CONSTRAINT `dealers_ibfk_1` FOREIGN KEY (`client_id`) REFERENCES `clients` (`client_id`);

--
-- Constraints for table `dealer_pin_allocated`
--
ALTER TABLE `dealer_pin_allocated`
  ADD CONSTRAINT `dealer_pin_allocated_ibfk_1` FOREIGN KEY (`dealer_id`) REFERENCES `dealers` (`dealer_id`),
  ADD CONSTRAINT `dealer_pin_allocated_ibfk_2` FOREIGN KEY (`client_id`) REFERENCES `clients` (`client_id`);

--
-- Constraints for table `dealer_reconcile`
--
ALTER TABLE `dealer_reconcile`
  ADD CONSTRAINT `dealer_reconcile_ibfk_1` FOREIGN KEY (`client_id`) REFERENCES `clients` (`client_id`),
  ADD CONSTRAINT `dealer_reconcile_ibfk_2` FOREIGN KEY (`dealer_id`) REFERENCES `dealers` (`dealer_id`);

--
-- Constraints for table `student_record`
--
ALTER TABLE `student_record`
  ADD CONSTRAINT `student_record_ibfk_1` FOREIGN KEY (`branch_id`) REFERENCES `branches` (`branch_id`),
  ADD CONSTRAINT `student_record_ibfk_2` FOREIGN KEY (`client_id`) REFERENCES `clients` (`client_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
