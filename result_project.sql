-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 29, 2024 at 09:30 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `result_project`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`) VALUES
(3, 'abdi', 'abdi2003'),
(8, 'ibra', 'ibra');

-- --------------------------------------------------------

--
-- Table structure for table `classes`
--

CREATE TABLE `classes` (
  `classesID` int(10) UNSIGNED NOT NULL,
  `classes` varchar(60) NOT NULL,
  `classes_numeric` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `classes`
--

INSERT INTO `classes` (`classesID`, `classes`, `classes_numeric`) VALUES
(1, 'computer_sceince', 1),
(2, 'Telecom', 2),
(3, 'Engineering', 3),
(4, 'Public Health', 4),
(5, 'BIT', 5),
(6, 'Dibloma', 6);

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `studentID` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `sex` varchar(10) NOT NULL,
  `classesID` int(11) NOT NULL,
  `registerNO` varchar(50) DEFAULT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`studentID`, `name`, `sex`, `classesID`, `registerNO`, `username`, `password`) VALUES
(1, 'apdirisak apdikadir hassen', 'male', 1, '4775', '5577', '$2y$10$8h47u3jJ6wdgBu6jEWTJp.MdXwX2fC36Zdpqs2gv.rh/SJs3GCOjq'),
(2, 'ibraahim ahmed hassan', 'male', 1, '5054', '5054', '$2y$10$8h47u3jJ6wdgBu6jEWTJp.MdXwX2fC36Zdpqs2gv.rh/SJs3GCOjq'),
(3, 'abdiasiis farah', 'male', 2, '5011', '5011', '');

-- --------------------------------------------------------

--
-- Table structure for table `terminal_report`
--

CREATE TABLE `terminal_report` (
  `id` int(11) NOT NULL,
  `ClassID` int(11) NOT NULL,
  `report_card` text NOT NULL,
  `student_name` varchar(255) NOT NULL,
  `exam_year` varchar(255) NOT NULL,
  `exam_term` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `terminal_report`
--

INSERT INTO `terminal_report` (`id`, `ClassID`, `report_card`, `student_name`, `exam_year`, `exam_term`) VALUES
(68, 1, '2779961719411227.png', 'ibraahim ahmed hassan', 'Freshman', '2nd_term'),
(69, 1, '9221701719411281.png', 'apdirisak apdikadir hassen', 'Freshman', '2nd_term'),
(70, 1, '4573991719411294.png', 'apdirisak apdikadir hassen', 'Sophomore', '1st_term'),
(71, 1, '396411719411308.png', 'apdirisak apdikadir hassen', 'Sophomore', '2nd_term'),
(72, 1, '1354951719411324.png', 'apdirisak apdikadir hassen', 'Junior', '1st_term'),
(73, 1, '3167551719508027.png', 'apdirisak apdikadir hassen', 'Freshman', '1st_term'),
(74, 1, '8861281719513612.pdf', 'ibraahim ahmed hassan', 'Senior', '2nd_term'),
(75, 2, '5052231719522195.pdf', 'abdiasiis farah', 'Freshman', '1st_term');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `classes`
--
ALTER TABLE `classes`
  ADD PRIMARY KEY (`classesID`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`studentID`);

--
-- Indexes for table `terminal_report`
--
ALTER TABLE `terminal_report`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `classes`
--
ALTER TABLE `classes`
  MODIFY `classesID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `student`
--
ALTER TABLE `student`
  MODIFY `studentID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `terminal_report`
--
ALTER TABLE `terminal_report`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=76;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
