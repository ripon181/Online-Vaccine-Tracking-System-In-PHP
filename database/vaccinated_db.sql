-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Sep 18, 2023 at 05:10 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `vaccinated_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `chat_messages`
--

CREATE TABLE `chat_messages` (
  `id` int(11) NOT NULL,
  `message` text NOT NULL,
  `sender_type` varchar(50) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp(),
  `sender_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `chat_messages`
--

INSERT INTO `chat_messages` (`id`, `message`, `sender_type`, `timestamp`, `sender_id`) VALUES
(1, 'Hi ', 'parent', '2023-09-17 10:30:40', 3),
(2, 'Is there anyone to chat?', 'parent', '2023-09-17 10:30:57', 3),
(4, 'Hello Rownok how are you today?', 'hospital', '2023-09-17 14:33:16', 1),
(5, 'I am Dr. Purnima to help you ', 'hospital', '2023-09-17 14:34:12', 1),
(6, 'I Need some suggestion ', 'parent', '2023-09-17 10:41:00', 3),
(8, 'Hi ', 'parent', '2023-09-18 11:08:49', 3),
(9, 'HI', 'hospital', '2023-09-18 15:09:11', 1);

-- --------------------------------------------------------

--
-- Table structure for table `general_user`
--

CREATE TABLE `general_user` (
  `id` int(11) NOT NULL,
  `Name` varchar(125) NOT NULL,
  `Email` varchar(125) NOT NULL,
  `Pass` varchar(255) NOT NULL,
  `NID` varchar(125) NOT NULL,
  `Phone` varchar(125) NOT NULL,
  `Gender` varchar(15) NOT NULL,
  `DOB` date NOT NULL,
  `address` varchar(254) NOT NULL,
  `fathersName` varchar(254) NOT NULL,
  `mothersName` varchar(254) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `general_user`
--

INSERT INTO `general_user` (`id`, `Name`, `Email`, `Pass`, `NID`, `Phone`, `Gender`, `DOB`, `address`, `fathersName`, `mothersName`) VALUES
(3, 'Rownok Ripon', 'mail.rownok@gmail.com', '76bbaf8c1cdd3d23b27d49686437d0d3', '1245638787', '+8801601424748', 'Male', '2023-06-04', '', '', ''),
(4, 'Rakib', 'rakib@gmail.com', '19ba1aecf200d8cbcda9b80947da3bf9', '645413216541', '01749475566', 'Male', '2023-07-05', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `hospital`
--

CREATE TABLE `hospital` (
  `id` int(11) NOT NULL,
  `hospitalName` varchar(125) NOT NULL,
  `hospitalUsername` varchar(125) NOT NULL,
  `password` varchar(125) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `hospital`
--

INSERT INTO `hospital` (`id`, `hospitalName`, `hospitalUsername`, `password`) VALUES
(1, 'Anwar khan medical college', 'anwarkhan123', '72219f7e3b4ccd857f572dd420b014dc'),
(2, 'Bardhaman hospital', 'bardhaman', '8f247d9ce4c48d05a02eb9a485bc5ea5'),
(3, 'BRB Hospitals Limited', 'brb123', 'a07408052f2c78a4de6dd6d82fedb82b');

-- --------------------------------------------------------

--
-- Table structure for table `individual_list`
--

CREATE TABLE `individual_list` (
  `id` int(30) NOT NULL,
  `tracking_code` varchar(50) NOT NULL,
  `Vaccine_type` varchar(30) NOT NULL,
  `firstname` text NOT NULL,
  `middlename` text NOT NULL,
  `lastname` text NOT NULL,
  `gender` varchar(50) NOT NULL,
  `dob` date NOT NULL,
  `contact` varchar(100) NOT NULL,
  `address` text NOT NULL,
  `status` int(3) NOT NULL DEFAULT 0,
  `date_created` datetime NOT NULL DEFAULT current_timestamp(),
  `date_updated` datetime DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `individual_list`
--

INSERT INTO `individual_list` (`id`, `tracking_code`, `Vaccine_type`, `firstname`, `middlename`, `lastname`, `gender`, `dob`, `contact`, `address`, `status`, `date_created`, `date_updated`) VALUES
(3, '1208231241086559', 'Baby Vaccine', 'Rahim', 'khan', 'mia', 'Male', '2023-06-04', '+8801601424748', 'Dhaka', 1, '2012-08-23 00:00:00', '2023-08-12 16:43:32'),
(4, '0507231420391999', 'Baby Vaccine', 'Rakib', 'hossain', 'Imran', 'Male', '2023-07-05', '01749475566', 'Dhaka', 1, '2005-07-23 00:00:00', '2023-08-02 11:49:27');

-- --------------------------------------------------------

--
-- Table structure for table `system_info`
--

CREATE TABLE `system_info` (
  `id` int(30) NOT NULL,
  `meta_field` text NOT NULL,
  `meta_value` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `system_info`
--

INSERT INTO `system_info` (`id`, `meta_field`, `meta_value`) VALUES
(1, 'name', 'Child Vaccination Management System'),
(6, 'short_name', 'CVMS'),
(11, 'logo', 'uploads/logo-1686214324.png'),
(13, 'user_avatar', 'uploads/user_avatar.jpg'),
(14, 'cover', 'uploads/cover-1691830083.png');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(50) NOT NULL,
  `firstname` varchar(250) NOT NULL,
  `lastname` varchar(250) NOT NULL,
  `username` text NOT NULL,
  `password` text NOT NULL,
  `avatar` text DEFAULT NULL,
  `last_login` datetime DEFAULT NULL,
  `type` tinyint(1) NOT NULL DEFAULT 0,
  `location_id` int(30) DEFAULT NULL,
  `date_added` datetime NOT NULL DEFAULT current_timestamp(),
  `date_updated` datetime DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `firstname`, `lastname`, `username`, `password`, `avatar`, `last_login`, `type`, `location_id`, `date_added`, `date_updated`) VALUES
(2, 'Rownok', 'Ripon', 'sadmin', 'c5edac1b8c1d58bad90a246d8f08f53b', 'uploads/avatar-2.png?v=1688543627', NULL, 1, 0, '2022-09-24 15:12:15', '2023-09-18 21:07:31');

-- --------------------------------------------------------

--
-- Table structure for table `vaccination_location_list`
--

CREATE TABLE `vaccination_location_list` (
  `id` int(30) NOT NULL,
  `location` text NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `date_created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `vaccination_location_list`
--

INSERT INTO `vaccination_location_list` (`id`, `location`, `status`, `date_created`) VALUES
(1, 'Dhaka Medical College & Hostipital', 1, '2022-09-24 15:13:04'),
(2, 'Sir salimullah medical college', 1, '2022-09-24 15:13:34'),
(3, 'Shaheed suhrawardy medical college', 1, '2022-09-24 15:13:46'),
(4, 'Anwar khan medical college\r\n', 1, '2022-09-24 15:14:01'),
(5, 'LABAID Specialized Hospital\r\n', 1, '2022-09-24 15:14:16'),
(6, 'Gonoshasthaya Nagar Hospital\r\n', 1, '2022-09-24 15:14:31'),
(7, 'Square Hospitals Ltd', 1, '2022-09-24 15:14:55'),
(8, 'Bardhaman hospital', 1, '2022-09-24 15:15:44'),
(9, 'Bongobondhu medical hospital', 1, '2022-09-24 15:15:59'),
(10, 'BRB Hospitals Limited', 1, '2022-09-24 15:16:20'),
(11, 'Samorita Hospital Ltd', 1, '2022-09-24 15:16:32');

-- --------------------------------------------------------

--
-- Table structure for table `vaccine_history_list`
--

CREATE TABLE `vaccine_history_list` (
  `id` int(30) NOT NULL,
  `user_id` int(30) DEFAULT NULL,
  `individual_id` int(30) NOT NULL,
  `vaccine_id` int(30) NOT NULL,
  `location_id` int(30) NOT NULL,
  `vaccination_type` varchar(50) NOT NULL,
  `vaccinated_by` text NOT NULL,
  `remarks` text NOT NULL,
  `date_created` datetime NOT NULL DEFAULT current_timestamp(),
  `date_updated` datetime DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `vaccine_history_list`
--

INSERT INTO `vaccine_history_list` (`id`, `user_id`, `individual_id`, `vaccine_id`, `location_id`, `vaccination_type`, `vaccinated_by`, `remarks`, `date_created`, `date_updated`) VALUES
(12, 2, 3, 9, 1, '6th Dose', 'Dr. Fatema', 'Good ', '2023-08-12 16:52:16', '2023-09-18 21:01:55');

-- --------------------------------------------------------

--
-- Table structure for table `vaccine_list`
--

CREATE TABLE `vaccine_list` (
  `id` int(30) NOT NULL,
  `name` varchar(250) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `Category` varchar(35) NOT NULL,
  `date_created` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `vaccine_list`
--

INSERT INTO `vaccine_list` (`id`, `name`, `status`, `Category`, `date_created`) VALUES
(9, 'Chickenpox ', 1, 'Baby Vaccine', '2023-06-08 16:26:14'),
(10, 'Polio ', 1, 'Baby Vaccine', '2023-06-08 16:26:34'),
(11, 'Hepatitis A', 1, 'Baby Vaccine', '2023-06-08 16:26:53'),
(12, 'Haemophilus influenzae type b', 1, 'Baby Vaccine', '2023-06-08 16:27:13'),
(13, 'Hepatitis B', 1, 'baby Vaccine', '2023-06-08 16:27:26');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `chat_messages`
--
ALTER TABLE `chat_messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `general_user`
--
ALTER TABLE `general_user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `Email` (`Email`),
  ADD UNIQUE KEY `NID` (`NID`);

--
-- Indexes for table `hospital`
--
ALTER TABLE `hospital`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `individual_list`
--
ALTER TABLE `individual_list`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `tracking_code` (`tracking_code`);

--
-- Indexes for table `system_info`
--
ALTER TABLE `system_info`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `location_id` (`location_id`);

--
-- Indexes for table `vaccination_location_list`
--
ALTER TABLE `vaccination_location_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vaccine_history_list`
--
ALTER TABLE `vaccine_history_list`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `vaccine_id` (`vaccine_id`),
  ADD KEY `location_id` (`location_id`),
  ADD KEY `individual_id` (`individual_id`);

--
-- Indexes for table `vaccine_list`
--
ALTER TABLE `vaccine_list`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `chat_messages`
--
ALTER TABLE `chat_messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `general_user`
--
ALTER TABLE `general_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `hospital`
--
ALTER TABLE `hospital`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `system_info`
--
ALTER TABLE `system_info`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `vaccination_location_list`
--
ALTER TABLE `vaccination_location_list`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `vaccine_history_list`
--
ALTER TABLE `vaccine_history_list`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `vaccine_list`
--
ALTER TABLE `vaccine_list`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `vaccine_history_list`
--
ALTER TABLE `vaccine_history_list`
  ADD CONSTRAINT `vaccine_history_list_ibfk_1` FOREIGN KEY (`vaccine_id`) REFERENCES `vaccine_list` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `vaccine_history_list_ibfk_3` FOREIGN KEY (`location_id`) REFERENCES `vaccination_location_list` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `vaccine_history_list_ibfk_6` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `vaccine_history_list_ibfk_7` FOREIGN KEY (`individual_id`) REFERENCES `individual_list` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
