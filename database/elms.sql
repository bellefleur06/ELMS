-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 28, 2022 at 10:11 AM
-- Server version: 10.4.16-MariaDB
-- PHP Version: 7.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `elms`
--

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE `departments` (
  `id` int(11) NOT NULL,
  `department_acronym` varchar(255) NOT NULL,
  `department_name` varchar(255) NOT NULL,
  `creation_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`id`, `department_acronym`, `department_name`, `creation_date`) VALUES
(1, 'A/O', 'Administration/Operations', '2022-03-01 10:40:53'),
(2, 'R&D', 'Research and Development', '2022-03-01 10:41:27'),
(3, 'M&S', 'Marketing and Sales', '2022-03-01 10:41:59'),
(4, 'HR', 'Human Resources', '2022-03-01 10:42:27'),
(5, 'CS', 'Customer Service', '2022-03-01 10:43:01'),
(6, 'A&F', 'Accounting and Finance', '2022-03-01 10:43:35');

-- --------------------------------------------------------

--
-- Table structure for table `designations`
--

CREATE TABLE `designations` (
  `id` int(11) NOT NULL,
  `designation_name` varchar(255) NOT NULL,
  `designation_description` varchar(255) NOT NULL,
  `creation_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `designations`
--

INSERT INTO `designations` (`id`, `designation_name`, `designation_description`, `creation_date`) VALUES
(1, 'General Manager', 'Manager', '2022-03-01 12:01:47'),
(2, 'Bookkeeper/Accountant', 'Accountant', '2022-03-01 12:08:22'),
(3, 'Marketing Guru', 'Guru', '2022-03-01 12:11:22'),
(4, 'Administrative Assistant', 'Assistant', '2022-03-01 12:20:35'),
(5, 'IT Technician', 'Technician', '2022-03-01 12:21:03'),
(6, 'Human Resource Manager', 'Manager', '2022-03-01 12:21:26');

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE `employees` (
  `id` int(11) NOT NULL,
  `employee_id` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `middle_name` varchar(255) NOT NULL,
  `age` varchar(255) NOT NULL,
  `gender` varchar(255) NOT NULL,
  `email_address` varchar(255) NOT NULL,
  `contact_number` varchar(255) NOT NULL,
  `department_id` varchar(255) NOT NULL,
  `designation_id` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `avatar` varchar(255) NOT NULL,
  `account_status` varchar(255) NOT NULL,
  `registration_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`id`, `employee_id`, `last_name`, `first_name`, `middle_name`, `age`, `gender`, `email_address`, `contact_number`, `department_id`, `designation_id`, `username`, `password`, `avatar`, `account_status`, `registration_date`) VALUES
(1, 'EMP-799', 'Bandola', 'Patrick Ail', 'Balonzo', '21', 'Male', 'pbandola06@gmail.com', '09503638031', '3', '3', 'tapps', '$2y$10$WlGT2Y1yK5m1qGSV22EF3.a7xhf.9TGQnpC79.dgoyYY0JbHkJLnq', 'Bandola, Patrick Ail B_2x2pic.jpeg', '1', '2022-03-10 19:43:40'),
(2, 'EMP-727', 'Doe', 'John', '', '30', 'Male', 'johndoe@gmail.com', '09735273521', '3', '3', 'john', '$2y$10$hAWrKVlZv3QTd3Ygm6Fo4eLSiGSW8sb5LPqYt6V3FhsZDwuqLZiMe', 'mehrad-vosoughi-iUQmEFtfdLw-unsplash.jpg', '1', '2022-03-10 19:53:19');

-- --------------------------------------------------------

--
-- Table structure for table `leave_applications`
--

CREATE TABLE `leave_applications` (
  `id` int(11) NOT NULL,
  `reference_number` varchar(255) NOT NULL,
  `employee_id` varchar(255) NOT NULL,
  `leave_type_id` varchar(255) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `date_applied` datetime NOT NULL DEFAULT current_timestamp(),
  `attachment` varchar(255) NOT NULL,
  `notification_status` varchar(255) NOT NULL,
  `leave_status` varchar(255) NOT NULL,
  `remarks` varchar(255) NOT NULL,
  `date_approved` datetime NOT NULL,
  `date_declined` datetime NOT NULL,
  `user_id` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `leave_applications`
--

INSERT INTO `leave_applications` (`id`, `reference_number`, `employee_id`, `leave_type_id`, `start_date`, `end_date`, `date_applied`, `attachment`, `notification_status`, `leave_status`, `remarks`, `date_approved`, `date_declined`, `user_id`) VALUES
(1, '917633', '1', '5', '2022-03-10', '2022-03-17', '2022-03-10 19:47:41', '', '1', '1', 'Approved', '2022-03-28 10:08:41', '0000-00-00 00:00:00', '3'),
(2, '994623', '1', '2', '2022-03-10', '2022-03-25', '2022-03-10 19:58:02', '', '1', '2', 'Declined', '0000-00-00 00:00:00', '2022-03-28 10:08:58', '3'),
(3, '889401', '2', '5', '2022-03-10', '2022-03-17', '2022-03-10 20:20:20', '', '1', '0', 'Waiting For Approval', '0000-00-00 00:00:00', '0000-00-00 00:00:00', ''),
(4, '687478', '1', '1', '2022-03-22', '2022-04-06', '2022-03-22 09:52:40', '', '1', '0', 'Waiting For Approval', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '');

-- --------------------------------------------------------

--
-- Table structure for table `leave_types`
--

CREATE TABLE `leave_types` (
  `id` int(11) NOT NULL,
  `leave_type` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `days_allowed` varchar(255) NOT NULL,
  `creation_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `leave_types`
--

INSERT INTO `leave_types` (`id`, `leave_type`, `description`, `days_allowed`, `creation_date`) VALUES
(1, 'Sick Leave', 'Recover from an illness and take care of your health.', '15', '2022-03-05 08:40:26'),
(2, 'Casual Leave', 'Travel, Vacation, Rest and Family Events.', '8-15', '2022-03-05 08:52:12'),
(3, 'Maternity Leave', 'Taking care of the newborn and recovering from the delivery.', '98', '2022-03-05 08:58:39'),
(4, 'Paternity Leave', 'Taking care of your newborn.', '14', '2022-03-05 09:00:48'),
(5, 'Bereavement Leave', 'Take time to grieve for a loved one\'s lost and manage responsibilities for the dead. ', '3-7', '2022-03-05 09:18:14');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `avatar` varchar(255) NOT NULL,
  `fullname` varchar(255) NOT NULL,
  `contact` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `user_category` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `registration_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `avatar`, `fullname`, `contact`, `email`, `user_category`, `status`, `registration_date`) VALUES
(1, 'admin', '$2y$10$iUK5iqHs3e6B1OAsQEbz3uEFQzDRG./4U766dapMB5CrxWGaJYo9e', 'Bandola, Patrick Ail B_2x2pic.jpeg', 'Patrick Ail B. Bandola', '09503638031', 'pbandola06@gmail.com', 'Admin', '1', '2022-02-24 21:31:04'),
(3, 'staff', '$2y$10$OSxnjbDKIyt2angzU8RGk.vVygmMbDoO7U8YVpL2464d1IIrSk606', 'construction worker.jpg', 'John Doe', '09854725284', 'johndoe@gmail.com', 'Staff', '1', '2022-03-11 08:57:28');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `designations`
--
ALTER TABLE `designations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `leave_applications`
--
ALTER TABLE `leave_applications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `leave_types`
--
ALTER TABLE `leave_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `departments`
--
ALTER TABLE `departments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `designations`
--
ALTER TABLE `designations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `leave_applications`
--
ALTER TABLE `leave_applications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `leave_types`
--
ALTER TABLE `leave_types`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
