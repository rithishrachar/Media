-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 07, 2023 at 06:24 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `nk`
--

-- --------------------------------------------------------

--
-- Table structure for table `advertisements`
--

CREATE TABLE `advertisements` (
  `no` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `number` varchar(100) NOT NULL,
  `title` varchar(100) NOT NULL,
  `artical` varchar(100) NOT NULL,
  `file` varchar(100) NOT NULL,
  `duration` varchar(100) NOT NULL,
  `amount` varchar(100) NOT NULL,
  `payment_mode` varchar(100) NOT NULL,
  `created_at` timestamp(6) NOT NULL DEFAULT current_timestamp(6) ON UPDATE current_timestamp(6),
  `remaining_days` int(100) NOT NULL,
  `expiry_date` date DEFAULT NULL,
  `payment_status` varchar(100) NOT NULL,
  `emp_id` int(100) NOT NULL,
  `bill` varchar(500) NOT NULL,
  `task_type` varchar(100) NOT NULL,
  `work_status` varchar(100) NOT NULL,
  `invoice_number` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `advertisements`
--

INSERT INTO `advertisements` (`no`, `name`, `email`, `number`, `title`, `artical`, `file`, `duration`, `amount`, `payment_mode`, `created_at`, `remaining_days`, `expiry_date`, `payment_status`, `emp_id`, `bill`, `task_type`, `work_status`, `invoice_number`) VALUES
(99, 'User', 'user@gmail.com', '8548034260', 'Commercial', 'congratulations ', 'n1.jpeg', '1 MONTH', '2000', 'CARD', '2023-07-05 09:42:01.315385', 31, '2023-08-05', 'Successful', 0, '', 'advertisement', '', 'INV627301'),
(100, 'User', 'user@gmail.com', '8548034260', 'Personal', 'wish', 'n2.jpeg', '1 MONTH', '2000', 'CARD', '2023-07-05 09:42:57.349522', 31, '2023-08-05', 'Successful', 0, '', 'advertisement', '', 'INV492315'),
(101, 'Charan', 'raicharan100@gmail.com', '1234567894', 'Personal', 'congratulations ', 'n1.jpeg', '1 MONTH', '2000', 'CARD', '2023-07-07 04:10:43.274527', 31, '2023-08-05', 'Successful', 166, '', 'advertisement', '', 'INV289437');

-- --------------------------------------------------------

--
-- Table structure for table `articals`
--

CREATE TABLE `articals` (
  `sno` int(11) NOT NULL,
  `name3` varchar(100) NOT NULL,
  `email3` varchar(100) NOT NULL,
  `number` varchar(100) NOT NULL,
  `title` varchar(100) NOT NULL,
  `artical` varchar(500) NOT NULL,
  `file` varchar(100) NOT NULL,
  `task_type` varchar(100) NOT NULL,
  `work_status` varchar(100) NOT NULL,
  `emp_id` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `articals`
--

INSERT INTO `articals` (`sno`, `name3`, `email3`, `number`, `title`, `artical`, `file`, `task_type`, `work_status`, `emp_id`) VALUES
(40, 'User', 'user@gmail.com', '8548034260', 'hello', 'how are you', 'n1.jpeg', 'artical', '', 0),
(41, 'Charan', 'raicharan100@gmail.com', '1234567894', 'hi', 'good', 'n3.jpeg', 'artical', 'Complete', 166);

-- --------------------------------------------------------

--
-- Table structure for table `card_details`
--

CREATE TABLE `card_details` (
  `no` int(100) NOT NULL,
  `card_number` varchar(100) NOT NULL,
  `card_holder` varchar(100) NOT NULL,
  `expiration_month` int(100) NOT NULL,
  `expiration_year` int(100) NOT NULL,
  `cvv` int(100) NOT NULL,
  `created_at` timestamp(6) NOT NULL DEFAULT current_timestamp(6) ON UPDATE current_timestamp(6),
  `invoice_number` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `card_details`
--

INSERT INTO `card_details` (`no`, `card_number`, `card_holder`, `expiration_month`, `expiration_year`, `cvv`, `created_at`, `invoice_number`) VALUES
(61, '4545454545454554', 'Charan', 8, 2030, 123, '2023-06-23 04:39:56.977578', 'INV829289'),
(62, '4545454545454554', 'Charan', 8, 2030, 123, '2023-06-23 04:44:38.916425', 'INV829289'),
(63, '1234567891234567', 'Charan rai b s', 12, 2023, 123, '2023-06-23 06:00:37.549180', 'INV310073'),
(64, '1452584596584526', 'User', 9, 2030, 123, '2023-07-05 09:27:54.164704', 'INV731782'),
(65, '1111111112222222', 'user', 11, 2030, 123, '2023-07-05 09:42:01.313206', 'INV627301'),
(66, '3333333656356356', 'user', 10, 2030, 123, '2023-07-05 09:42:57.347901', 'INV492315'),
(67, '1245689563568565', 'Charan rai bs', 10, 2030, 154, '2023-07-05 09:47:48.704602', 'INV289437');

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE `employee` (
  `id` int(11) NOT NULL,
  `firstName` varchar(100) NOT NULL,
  `lastName` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` text NOT NULL,
  `birthday` date NOT NULL,
  `gender` varchar(10) NOT NULL,
  `contact` varchar(20) NOT NULL,
  `address` varchar(100) DEFAULT NULL,
  `dept` varchar(100) NOT NULL,
  `degree` varchar(100) NOT NULL,
  `pic` text NOT NULL,
  `code` varchar(100) NOT NULL,
  `otp_expiry` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `lday` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`id`, `firstName`, `lastName`, `email`, `password`, `birthday`, `gender`, `contact`, `address`, `dept`, `degree`, `pic`, `code`, `otp_expiry`, `lday`) VALUES
(126, 'admin', 'a', 'admin@gmail.com', 'Admin1234@', '2023-04-13', 'male', '8548034260', 'karkala', 'cs', 'admin', 'IMG_20230306_081422.jpg', '0', '2023-06-23 05:40:28', 0),
(164, 'Rithish', 'Achar', 'rithish7353@gmail.com', 'Rithish123@', '2002-01-24', 'Male', '7829150482', 'Parapu', 'YOUTUBE STREAMER', 'employee', 'rithish.jpg', '', '2023-06-23 05:27:10', 0),
(165, 'Purushotm', 'Shenoy', 'kpurushothamshenoy@gmail.com', 'Puru123@', '2002-07-26', 'Male', '9380555507', 'Bandimata', 'ARTICLE EDITOR', 'employee', 'purushotam.jpg', '', '2023-06-23 05:34:12', 0),
(166, 'Prajwal', 'Kulal', 'kulalprajwal65@gmail.com', 'Pra8548@', '2002-10-19', 'Male', '8548034260', 'Jooduraste', 'ADVERTISER', 'employee', 'prajwal.jpg', '0', '2023-07-05 09:50:42', 0);

-- --------------------------------------------------------

--
-- Table structure for table `employee_leaves`
--

CREATE TABLE `employee_leaves` (
  `emp_id` int(100) NOT NULL,
  `emp_name` varchar(100) NOT NULL,
  `leave_reason` varchar(100) NOT NULL,
  `leave_start_date` date NOT NULL,
  `leave_end_date` date NOT NULL,
  `status` varchar(100) NOT NULL,
  `l_day` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `employee_leaves`
--

INSERT INTO `employee_leaves` (`emp_id`, `emp_name`, `leave_reason`, `leave_start_date`, `leave_end_date`, `status`, `l_day`) VALUES
(166, 'Prajwal', 'Fever', '2023-07-06', '2023-07-08', '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `poll`
--

CREATE TABLE `poll` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `email` text NOT NULL,
  `phone` varchar(100) NOT NULL,
  `feedback` text NOT NULL,
  `suggestions` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `poll`
--

INSERT INTO `poll` (`id`, `name`, `email`, `phone`, `feedback`, `suggestions`) VALUES
(17, 'user', 'user@gmail.com', '8548034260', 'very nice\r\n', 'Excellent'),
(18, 'user', 'user@gmail.com', '8548034260', 'nice', 'Excellent');

-- --------------------------------------------------------

--
-- Table structure for table `salary`
--

CREATE TABLE `salary` (
  `id` int(11) NOT NULL,
  `base` int(11) NOT NULL,
  `bonus` int(11) DEFAULT NULL,
  `total` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `salary`
--

INSERT INTO `salary` (`id`, `base`, `bonus`, `total`) VALUES
(164, 30000, 0, 30000),
(165, 25000, 0, 25000),
(166, 30000, 0, 30000);

-- --------------------------------------------------------

--
-- Table structure for table `task`
--

CREATE TABLE `task` (
  `task_id` int(100) NOT NULL,
  `sno` int(100) NOT NULL,
  `name1` varchar(100) NOT NULL,
  `email1` varchar(100) NOT NULL,
  `ev_date` date NOT NULL,
  `ev_name` varchar(100) NOT NULL,
  `number` varchar(100) NOT NULL,
  `address` varchar(100) NOT NULL,
  `pincode` int(100) NOT NULL,
  `employee_number` int(100) NOT NULL,
  `employee_email` varchar(100) NOT NULL,
  `task_status` varchar(100) NOT NULL,
  `task_type` varchar(100) NOT NULL,
  `artical` varchar(100) NOT NULL,
  `title` varchar(100) NOT NULL,
  `file` varchar(100) NOT NULL,
  `remaining_days` int(100) NOT NULL,
  `payment_status` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `task`
--

INSERT INTO `task` (`task_id`, `sno`, `name1`, `email1`, `ev_date`, `ev_name`, `number`, `address`, `pincode`, `employee_number`, `employee_email`, `task_status`, `task_type`, `artical`, `title`, `file`, `remaining_days`, `payment_status`) VALUES
(99, 41, 'Charan', 'raicharan100@gmail.com', '0000-00-00', '', '1234567894', '', 0, 166, '', '', 'artical', 'good', 'hi', 'n3.jpeg', 0, ''),
(100, 68, 'Charan', 'raicharan100@gmail.com', '2023-07-16', 'Kambala', '1234567894', 'karkala', 456456, 166, '', '', '', '', '', '', 0, ''),
(101, 101, 'Charan', 'raicharan100@gmail.com', '2023-08-05', '', '1234567894', '', 0, 166, '', '', 'advertisement', 'congratulations ', 'Personal', 'n1.jpeg', 31, 'Successful');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(100) NOT NULL,
  `firstName` varchar(100) NOT NULL,
  `address` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `degree` varchar(100) NOT NULL,
  `pic` varchar(100) NOT NULL,
  `code` varchar(100) NOT NULL,
  `otp_expiry` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `contact` varchar(100) NOT NULL,
  `lastName` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `firstName`, `address`, `email`, `password`, `degree`, `pic`, `code`, `otp_expiry`, `contact`, `lastName`) VALUES
(7, 'Charan', 'renjala', 'raicharan100@gmail.com', 'Charan123@', 'user', 'IMG_20230211_211508.jpg', '0', '2023-05-27 04:55:34', '0', 'rai'),
(15, 'Dixen', 'Renjala', 'dixenrodrigues2@gmail.com', 'Dixen123@', 'user', '', '', '2023-06-23 05:44:23', '', 'Jolvin'),
(16, 'User', 'karkala', 'user@gmail.com', 'User123@', 'user', '', '', '2023-06-23 05:46:44', '', 'User'),
(17, 'me', 'karkala', 'me@gmail.com', 'Pra8548@', 'user', '', '', '2023-07-05 09:49:49', '', 'me');

-- --------------------------------------------------------

--
-- Table structure for table `youtube`
--

CREATE TABLE `youtube` (
  `sno` int(11) NOT NULL,
  `name1` varchar(100) NOT NULL,
  `email1` varchar(100) NOT NULL,
  `ev_date` date NOT NULL,
  `ev_name` varchar(100) NOT NULL,
  `number` varchar(100) NOT NULL,
  `address` varchar(100) NOT NULL,
  `pincode` int(10) NOT NULL,
  `status` varchar(100) NOT NULL,
  `ev_status` varchar(100) NOT NULL,
  `work_status` varchar(100) NOT NULL,
  `employee_id` int(100) NOT NULL,
  `task_type` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `youtube`
--

INSERT INTO `youtube` (`sno`, `name1`, `email1`, `ev_date`, `ev_name`, `number`, `address`, `pincode`, `status`, `ev_status`, `work_status`, `employee_id`, `task_type`) VALUES
(66, 'User', 'user@gmail.com', '2023-07-08', 'Dance', '8548034260', 'karkala', 123123, '', '', '', 0, 'youtube'),
(67, 'User', 'user@gmail.com', '2023-07-15', 'Kola', '8548034261', 'karkala', 456456, '', '', '', 0, 'youtube'),
(68, 'Charan', 'raicharan100@gmail.com', '2023-07-16', 'Kambala', '1234567894', 'karkala', 456456, '', '', 'Complete', 166, 'youtube');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `advertisements`
--
ALTER TABLE `advertisements`
  ADD PRIMARY KEY (`no`);

--
-- Indexes for table `articals`
--
ALTER TABLE `articals`
  ADD PRIMARY KEY (`sno`);

--
-- Indexes for table `card_details`
--
ALTER TABLE `card_details`
  ADD PRIMARY KEY (`no`);

--
-- Indexes for table `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `poll`
--
ALTER TABLE `poll`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `salary`
--
ALTER TABLE `salary`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `task`
--
ALTER TABLE `task`
  ADD PRIMARY KEY (`task_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `youtube`
--
ALTER TABLE `youtube`
  ADD PRIMARY KEY (`sno`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `advertisements`
--
ALTER TABLE `advertisements`
  MODIFY `no` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=102;

--
-- AUTO_INCREMENT for table `articals`
--
ALTER TABLE `articals`
  MODIFY `sno` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `card_details`
--
ALTER TABLE `card_details`
  MODIFY `no` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;

--
-- AUTO_INCREMENT for table `employee`
--
ALTER TABLE `employee`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=170;

--
-- AUTO_INCREMENT for table `poll`
--
ALTER TABLE `poll`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `task`
--
ALTER TABLE `task`
  MODIFY `task_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=102;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `youtube`
--
ALTER TABLE `youtube`
  MODIFY `sno` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `salary`
--
ALTER TABLE `salary`
  ADD CONSTRAINT `salary_ibfk_1` FOREIGN KEY (`id`) REFERENCES `employee` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
