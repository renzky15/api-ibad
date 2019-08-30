-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 30, 2019 at 09:04 AM
-- Server version: 10.1.36-MariaDB
-- PHP Version: 7.2.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ibadcommy_ibaddb`
--

-- --------------------------------------------------------

--
-- Table structure for table `applicant`
--

CREATE TABLE `applicant` (
  `applicant_id` int(50) NOT NULL,
  `firstName` varchar(50) NOT NULL,
  `lastName` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `resume` blob NOT NULL,
  `address` varchar(50) NOT NULL,
  `contact_num` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `applicant`
--

INSERT INTO `applicant` (`applicant_id`, `firstName`, `lastName`, `email`, `resume`, `address`, `contact_num`) VALUES
(1, 'John', 'Wick', 'test@gmail.com', '', 'Somewhere', 90900000),
(2, 'Joy', 'Maligaya', 'test@gmail.com', '', 'Somewhere', 909000002);

-- --------------------------------------------------------

--
-- Table structure for table `app_job_letter`
--

CREATE TABLE `app_job_letter` (
  `app_job_id` int(50) NOT NULL,
  `jb_letter_id` int(50) NOT NULL,
  `app_id` int(50) NOT NULL,
  `status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `company`
--

CREATE TABLE `company` (
  `company_id` int(50) NOT NULL,
  `emplyr_id` int(50) NOT NULL,
  `org_id` int(50) NOT NULL,
  `company_name` varchar(50) NOT NULL,
  `mission` varchar(50) NOT NULL,
  `vision` varchar(50) NOT NULL,
  `address` varchar(50) NOT NULL,
  `business_num` varchar(50) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `logo` blob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `company`
--

INSERT INTO `company` (`company_id`, `emplyr_id`, `org_id`, `company_name`, `mission`, `vision`, `address`, `business_num`, `date`, `logo`) VALUES
(1, 0, 0, 'RENZ LTD', 'test mission', 'test mvision', 'anywhere', '1213', '2019-08-23 06:01:55', ''),
(2, 0, 0, '', '', '', '', '', '2019-08-23 14:56:38', ''),
(3, 0, 0, '', '', '', '', '', '2019-08-23 14:59:20', ''),
(4, 0, 0, '', '', '', '', '', '2019-08-23 15:00:42', '');

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

CREATE TABLE `department` (
  `dept_id` int(50) NOT NULL,
  `org_id` int(50) NOT NULL,
  `dept_in_charge` varchar(50) NOT NULL,
  `dept_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `department`
--

INSERT INTO `department` (`dept_id`, `org_id`, `dept_in_charge`, `dept_name`) VALUES
(1, 1, '', 'Marketing'),
(2, 1, '', 'Marketing'),
(6, 0, '', 'Test'),
(7, 0, '', 'Sales');

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE `employee` (
  `e_id` int(11) NOT NULL,
  `org_id` int(11) NOT NULL,
  `firstName` varchar(50) NOT NULL,
  `lastName` varchar(50) NOT NULL,
  `position` varchar(50) NOT NULL,
  `address` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`e_id`, `org_id`, `firstName`, `lastName`, `position`, `address`, `email`) VALUES
(1, 1, 'Jackie ', 'Wick', 'Marketing Head', 'Somewhere', 'test@gmail.com'),
(2, 1, 'Renz Owen', 'Santillan', 'Manager', 'Bago City', 'thegreekfreak@gmail.com'),
(3, 0, 'Renz Owen', 'Marco', 'Office Clerk', 'Somewhere', 'test@gmail.com'),
(4, 0, 'Raul', 'Bang', 'Test', 'test', 'test@gmail.com'),
(5, 0, 'Test', 'test', 'test', 'test', 'test@gmail.com'),
(6, 0, 'Mark', 'Marco', 'Dishwasher', 'Somewhere', 'test@gmail.com'),
(7, 0, 'Owne', 'Marudo', 'test', 'teest', 'test@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `employer`
--

CREATE TABLE `employer` (
  `emplyr_id` int(50) NOT NULL,
  `firstName` varchar(50) NOT NULL,
  `lastName` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `job`
--

CREATE TABLE `job` (
  `job_id` int(50) NOT NULL,
  `job_desc` varchar(50) NOT NULL,
  `job_title` varchar(50) NOT NULL,
  `job_role` varchar(50) NOT NULL,
  `job_status` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `job`
--

INSERT INTO `job` (`job_id`, `job_desc`, `job_title`, `job_role`, `job_status`, `email`, `date_created`) VALUES
(1, 'Clerk', 'Sales Clerk', 'To sell', 'open', 'test@gmail.com', '2019-08-22 14:59:28'),
(5, 'Java Developer', 'Java', 'Write code', 'open', 'test@gmail.com', '2019-08-30 02:02:10'),
(6, 'ReactJS', 'ReactJS', 'Hello World', 'open', 'test@gmail.com', '2019-08-30 02:41:10');

--
-- Triggers `job`
--
DELIMITER $$
CREATE TRIGGER `after_job_insert` AFTER INSERT ON `job` FOR EACH ROW INSERT INTO job_applicant VALUES(ja_id, NEW.job_id, 1, 'open', LPAD(FLOOR(RAND() * 999999.99), 6, '0'))
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `job_applicant`
--

CREATE TABLE `job_applicant` (
  `ja_id` int(50) NOT NULL,
  `job_id` int(50) NOT NULL,
  `applicant_id` int(50) NOT NULL,
  `job_status` varchar(50) NOT NULL,
  `job_code` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `job_applicant`
--

INSERT INTO `job_applicant` (`ja_id`, `job_id`, `applicant_id`, `job_status`, `job_code`) VALUES
(1, 1, 1, 'open', '213'),
(2, 5, 2, 'opened', '942713'),
(4, 6, 1, 'open', '608457');

-- --------------------------------------------------------

--
-- Table structure for table `job_letter`
--

CREATE TABLE `job_letter` (
  `jb_letter_id` int(50) NOT NULL,
  `emplyr_id` int(50) NOT NULL,
  `job_desc` varchar(50) NOT NULL,
  `recipient` varchar(50) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `org_chart`
--

CREATE TABLE `org_chart` (
  `org_id` int(50) NOT NULL,
  `dept_id` int(50) NOT NULL,
  `company_id` int(50) NOT NULL,
  `e_id` int(50) NOT NULL,
  `description` varchar(50) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `org_chart`
--

INSERT INTO `org_chart` (`org_id`, `dept_id`, `company_id`, `e_id`, `description`, `date`) VALUES
(1, 2, 1, 1, 'saa', '2019-08-24 13:59:31');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `applicant`
--
ALTER TABLE `applicant`
  ADD PRIMARY KEY (`applicant_id`);

--
-- Indexes for table `app_job_letter`
--
ALTER TABLE `app_job_letter`
  ADD PRIMARY KEY (`app_job_id`);

--
-- Indexes for table `company`
--
ALTER TABLE `company`
  ADD PRIMARY KEY (`company_id`);

--
-- Indexes for table `department`
--
ALTER TABLE `department`
  ADD PRIMARY KEY (`dept_id`);

--
-- Indexes for table `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`e_id`);

--
-- Indexes for table `employer`
--
ALTER TABLE `employer`
  ADD PRIMARY KEY (`emplyr_id`);

--
-- Indexes for table `job`
--
ALTER TABLE `job`
  ADD PRIMARY KEY (`job_id`);

--
-- Indexes for table `job_applicant`
--
ALTER TABLE `job_applicant`
  ADD PRIMARY KEY (`ja_id`),
  ADD KEY `applicant_id` (`applicant_id`),
  ADD KEY `job_id` (`job_id`);

--
-- Indexes for table `job_letter`
--
ALTER TABLE `job_letter`
  ADD PRIMARY KEY (`jb_letter_id`);

--
-- Indexes for table `org_chart`
--
ALTER TABLE `org_chart`
  ADD PRIMARY KEY (`org_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `applicant`
--
ALTER TABLE `applicant`
  MODIFY `applicant_id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `app_job_letter`
--
ALTER TABLE `app_job_letter`
  MODIFY `app_job_id` int(50) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `company`
--
ALTER TABLE `company`
  MODIFY `company_id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `department`
--
ALTER TABLE `department`
  MODIFY `dept_id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `employee`
--
ALTER TABLE `employee`
  MODIFY `e_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `employer`
--
ALTER TABLE `employer`
  MODIFY `emplyr_id` int(50) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `job`
--
ALTER TABLE `job`
  MODIFY `job_id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `job_applicant`
--
ALTER TABLE `job_applicant`
  MODIFY `ja_id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `job_letter`
--
ALTER TABLE `job_letter`
  MODIFY `jb_letter_id` int(50) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `org_chart`
--
ALTER TABLE `org_chart`
  MODIFY `org_id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `job_applicant`
--
ALTER TABLE `job_applicant`
  ADD CONSTRAINT `job_applicant_ibfk_1` FOREIGN KEY (`applicant_id`) REFERENCES `applicant` (`applicant_id`),
  ADD CONSTRAINT `job_applicant_ibfk_2` FOREIGN KEY (`job_id`) REFERENCES `job` (`job_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
