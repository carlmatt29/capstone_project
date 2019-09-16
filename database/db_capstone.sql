-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Sep 04, 2019 at 05:40 AM
-- Server version: 10.1.16-MariaDB
-- PHP Version: 7.0.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_capstone`
--

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE `departments` (
  `id` bigint(20) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  `parent_id` bigint(20) NOT NULL,
  `approver_id` bigint(20) NOT NULL,
  `payroll_group_id` bigint(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `education_level`
--

CREATE TABLE `education_level` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `education_level`
--

INSERT INTO `education_level` (`id`, `name`, `description`, `is_deleted`) VALUES
(1, 'Degree Holder', 'Degree Holder', 0),
(2, 'College Level', 'College Level', 1),
(3, 'Masters Degree', 'Masters Degree', 0),
(4, 'College Level', 'College Level', 0);

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE `employees` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `code` varchar(255) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `middle_name` varchar(255) DEFAULT '',
  `last_name` varchar(255) NOT NULL,
  `nationality` varchar(255) NOT NULL,
  `birthday` date NOT NULL DEFAULT '0000-00-00',
  `gender` varchar(255) NOT NULL,
  `civil_status` varchar(255) CHARACTER SET utf8 NOT NULL,
  `sss_no` varchar(255) DEFAULT '',
  `tin` varchar(255) DEFAULT '',
  `philhealth` varchar(255) DEFAULT '',
  `pagibig` varchar(255) DEFAULT '',
  `employment_status_id` bigint(20) NOT NULL DEFAULT '0',
  `job_title_id` bigint(20) NOT NULL DEFAULT '0',
  `pay_grade_id` bigint(20) NOT NULL DEFAULT '0',
  `address1` varchar(255) NOT NULL,
  `address2` varchar(255) DEFAULT '',
  `city` varchar(255) NOT NULL,
  `province` varchar(255) NOT NULL,
  `country` varchar(255) NOT NULL,
  `postal_code` varchar(50) NOT NULL DEFAULT '',
  `contact_no` varchar(50) NOT NULL DEFAULT '',
  `work_contact_no` varchar(50) NOT NULL DEFAULT '',
  `private_email` varchar(255) NOT NULL DEFAULT '',
  `work_email` varchar(255) NOT NULL DEFAULT '',
  `joined_date` date NOT NULL DEFAULT '0000-00-00',
  `department_id` bigint(20) NOT NULL DEFAULT '0',
  `supervisor_id` varchar(255) NOT NULL DEFAULT '0',
  `is_terminated` tinyint(1) NOT NULL DEFAULT '0',
  `termination_date` date DEFAULT '0000-00-00',
  `basic_salary` double NOT NULL DEFAULT '0',
  `ecola` double NOT NULL,
  `tax_status_id` bigint(20) NOT NULL DEFAULT '0',
  `acu_id` varchar(10) NOT NULL DEFAULT '',
  `bond_date` date NOT NULL DEFAULT '0000-00-00',
  `image` varchar(255) DEFAULT '',
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  `is_regular` tinyint(1) NOT NULL DEFAULT '0',
  `payroll_group_id` bigint(20) DEFAULT NULL,
  `regularization_date` date DEFAULT '0000-00-00',
  `card_number` varchar(100) DEFAULT NULL,
  `w_sss` tinyint(1) DEFAULT '0',
  `w_philhealth` tinyint(1) DEFAULT '0',
  `w_hdmf` tinyint(1) DEFAULT '0',
  `branch_id` bigint(20) DEFAULT NULL,
  `whitelist_ip` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`id`, `code`, `first_name`, `middle_name`, `last_name`, `nationality`, `birthday`, `gender`, `civil_status`, `sss_no`, `tin`, `philhealth`, `pagibig`, `employment_status_id`, `job_title_id`, `pay_grade_id`, `address1`, `address2`, `city`, `province`, `country`, `postal_code`, `contact_no`, `work_contact_no`, `private_email`, `work_email`, `joined_date`, `department_id`, `supervisor_id`, `is_terminated`, `termination_date`, `basic_salary`, `ecola`, `tax_status_id`, `acu_id`, `bond_date`, `image`, `is_deleted`, `is_regular`, `payroll_group_id`, `regularization_date`, `card_number`, `w_sss`, `w_philhealth`, `w_hdmf`, `branch_id`, `whitelist_ip`) VALUES
(1, '201500001', 'Aaron Spencer', 'V', 'Villamor', 'Filipino', '1996-11-30', 'Female', 'Single', '12-3456789', '123-456-789-011', '12-345678901-1', '2345-6789-0111', 1, 51, 4, '20 Diego Silang St', '20 Diego Silang St', 'Marikina', 'Cubao', 'Ph', '1801', '09199403122', '09199403122', 'aaron@gmail.com', 'aaron@gmail.com', '2019-06-03', 13, '0', 0, '2017-02-07', 12000, 0, 1, '1234', '2019-01-01', '', 0, 1, 1, '2019-05-04', '11111111111111', 1, 1, 1, 1, 1),
(95, 'Example01', 'Example', 'Example', 'Example', 'Example', '1999-09-01', 'Male', 'Single', '11-1111111-1', '123-123-123-123', '12-312312321-3', '1231-2312-3123', 1, 0, 0, 'Example', 'Example', 'Example', 'Example', 'Example', '1231', '09123456789', '09123456789', 'sample@gmail.com', 'sample@gmail.com', '0000-00-00', 1, '0', 0, '0000-00-00', 0, 0, 0, '1234', '0000-00-00', '', 0, 0, NULL, '0000-00-00', '1234', 0, 0, 0, NULL, 0),
(96, 'Sample01', 'Sample', 'Sample', 'Sample', 'Sample', '1999-10-01', 'Male', 'Single', '11-1111111-1', '123-123-123-213', '21-312312312-3', '1231-2312-3123', 0, 0, 0, 'Sample', 'Sample', 'Sample', 'Sample', 'Sample', '1231', '09123456789', '09123456789', 'sample@gmail.com', 'sample@gmail.com', '0000-00-00', 0, '0', 0, '0000-00-00', 0, 0, 0, '1234', '0000-00-00', '', 0, 0, NULL, '0000-00-00', '1234', 0, 0, 0, NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `employees_education`
--

CREATE TABLE `employees_education` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `employee_id` bigint(20) NOT NULL,
  `educ_level_id` bigint(20) NOT NULL,
  `institute` varchar(255) NOT NULL,
  `course` varchar(255) NOT NULL,
  `date_start` date NOT NULL,
  `date_end` date NOT NULL,
  `remarks` varchar(255) DEFAULT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `employees_education`
--

INSERT INTO `employees_education` (`id`, `employee_id`, `educ_level_id`, `institute`, `course`, `date_start`, `date_end`, `remarks`, `is_deleted`) VALUES
(1, 77, 1, 'Mapua Institute of Technology', 'BSCS', '1999-06-01', '2003-04-01', 'Graduate with honors', 0),
(2, 95, 1, 'Test', 'Test', '2019-03-01', '2019-03-22', 'edaga', 0);

-- --------------------------------------------------------

--
-- Table structure for table `employees_emergency_contacts`
--

CREATE TABLE `employees_emergency_contacts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `employee_id` bigint(20) NOT NULL,
  `remarks` varchar(255) DEFAULT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  `first_name` varchar(255) NOT NULL,
  `middle_name` varchar(255) NOT NULL DEFAULT '',
  `last_name` varchar(255) NOT NULL,
  `contact_no` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `employees_trainings`
--

CREATE TABLE `employees_trainings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `employee_id` bigint(20) NOT NULL,
  `training_id` bigint(20) NOT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `employees_trainings`
--

INSERT INTO `employees_trainings` (`id`, `employee_id`, `training_id`, `is_deleted`) VALUES
(1, 111, 1, 0),
(2, 113, 1, 0),
(3, 105, 2, 0),
(4, 105, 1, 0),
(5, 113, 2, 0);

-- --------------------------------------------------------

--
-- Table structure for table `employment_status`
--

CREATE TABLE `employment_status` (
  `id` bigint(20) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  `is_regular` tinyint(1) NOT NULL DEFAULT '0',
  `payroll_include` int(5) NOT NULL DEFAULT '0',
  `is_special` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `job_title`
--

CREATE TABLE `job_title` (
  `id` bigint(20) NOT NULL,
  `code` varchar(100) NOT NULL,
  `process_id` int(11) NOT NULL,
  `description` varchar(255) NOT NULL,
  `employee_process_id` varchar(100) NOT NULL,
  `is_available` int(11) NOT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `job_title`
--

INSERT INTO `job_title` (`id`, `code`, `process_id`, `description`, `employee_process_id`, `is_available`, `is_deleted`) VALUES
(1, 'Haha', 1, 'haha', '103', 1, 0),
(2, 'Test', 2, 'Test', '1', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `payroll_groups`
--

CREATE TABLE `payroll_groups` (
  `payroll_group_id` bigint(20) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `website` varchar(255) DEFAULT NULL,
  `mobile_no` varchar(255) DEFAULT NULL,
  `telephone_no` varchar(255) DEFAULT NULL,
  `fax_no` varchar(255) DEFAULT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  `set_rates` tinyint(1) DEFAULT '0',
  `bank_account_number` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pay_grade`
--

CREATE TABLE `pay_grade` (
  `id` bigint(20) NOT NULL,
  `level` varchar(255) NOT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  `can_apply_for_meal_transpo` tinyint(1) NOT NULL DEFAULT '0',
  `allow_overtime` tinyint(1) NOT NULL DEFAULT '0',
  `view_employee_leave_calendar` tinyint(1) DEFAULT '0',
  `access_project_management` tinyint(1) DEFAULT '0',
  `apply_for_subordinates` tinyint(1) DEFAULT '0',
  `can_manage_projects` tinyint(1) DEFAULT '0',
  `allow_offset` tinyint(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `perm_id` bigint(20) NOT NULL,
  `user_id` bigint(20) DEFAULT NULL,
  `user_access_id` varchar(1000) DEFAULT NULL,
  `system_id` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`perm_id`, `user_id`, `user_access_id`, `system_id`) VALUES
(0, 2, NULL, 1),
(2, 61, '1,2,3,4,5,6,7,8,9,10,11,12,67', 1),
(15, 60, '1,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,41,42,69', 1),
(16, 62, '70,71,72,73,74,75,76,77,78,79,80,81,82,83,84,85,86,87,88,89,90,91,92,93,94,95,96,97,98,99,100,101,102,103,104,105,106,107,108,109,110,111,112', 2),
(27, 74, '1', 1),
(28, 74, '70,71,72,73,74,75,76,77,78,79,80,81,82,83,84,85,86,87,88,89,90,91,92,93,94,95,96,97,98,99,100,101,102,103,104,105,106,107,108,109,110,111,112', 2),
(29, 65, '1,2,3,4', 1),
(31, 67, '1', 1),
(32, 67, '70,71,72,73,74,75,76,77,78,79,80,81,82,83,84,85,86,87,88,89,90,91,92,93,94,95,96,97,98,99,101,102,103,104,105,106,107,108,109,110,111,112', 2),
(65, NULL, '1', 1),
(66, NULL, '71,72,73,74', 2),
(75, 91, '1', 1),
(76, 91, '70,71,72,73,74,75,76', 2),
(97, 92, '1', 1),
(98, 92, '71,72,73,75', 2),
(101, 64, '1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30,31,32,33,34,35,36,37,38,39,40,41,42,43,44,45,46,47,48,49,50,51,52,53,54,55,56,57,58,59,60,61,62,63,64,65,66,67,68,69,113,114,115,116,118', 1),
(102, 64, '70,71,72,73,74,75,76,77,78,79,80,81,82,83,84,85,86,87,88,89,90,91,92,93,94,95,96,97,98,99,100,101,102,103,104,105,106,107,108,109,110,111,112', 2),
(106, 94, '1,2,3,4,5,6', 1),
(107, 95, '1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17', 1),
(124, 93, '1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30,31,32,33,34,35,36,37,38,39,40,41,42,43,44,45,46,47,48,49,50,51,52,53,54,55,56,57,58,59,60,61,62,63,64,65,66,67,68,69,113,114,115,116,118,119', 1),
(129, 96, '1,11,12,13,14,15,16,17,18,22,23,24,25,26,27,28,29,30,31,32,33,34,35,36,37,38,39,40,41,116,119', 1),
(130, 96, '70,71,72,73,74,75', 2),
(149, 63, '1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18', 1),
(152, 97, NULL, 1),
(153, 98, NULL, 1),
(161, 99, '1,11,12,13,14,15,16,17,18', 1),
(169, 101, '1', 1),
(170, 101, '70,71,72,73,91,92,93,94,95,96,97,98,99,100,101,112', 2),
(175, 102, '11,12,13,14,15,16,17,18,19,20,21,40,41,116', 1),
(206, 110, '1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30,31,32,33,34,35,36,37,38,39,40,41,42,43,44,45,47,48,49,50,51,52,53,54,55,56,57,58,59,60,61,62,63,64,65,66,67,68,69,113,114,115,116,118,119', 1),
(207, 110, '70,71,72,73,74,75,76,77,78,79,80,81,82,83,84,85,86,87,88,89,90,91,92,93,94,95,96,97,98,99,100,101,102,103,104,105,106,107,108,109,110,111,112', 2),
(208, 107, '1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30,31,32,33,34,35,36,37,38,39,40,41,42,43,44,45,47,48,49,50,51,52,53,54,55,56,57,58,59,60,61,62,63,64,65,66,67,68,69,113,114,115,116,118,119', 1),
(209, 107, '70,71,72,73,74,75,76,77,78,79,80,81,82,83,84,85,86,87,88,89,90,91,92,93,94,95,96,97,98,99,100,101,102,103,104,105,106,107,108,109,110,111,112', 2),
(210, 108, '1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30,31,32,33,34,35,36,37,38,39,40,41,42,43,44,45,47,48,49,50,51,52,53,54,55,56,57,58,59,60,61,62,63,64,65,66,67,68,69,113,114,115,116,118,119', 1),
(211, 108, '70,71,72,73,74,75,76,77,78,79,80,81,82,83,84,85,86,87,88,89,90,91,92,93,94,95,96,97,98,99,100,101,102,103,104,105,106,107,108,109,110,111,112', 2),
(212, 109, '1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30,31,32,33,34,35,36,37,38,39,40,41,42,43,44,45,47,48,49,50,51,52,53,54,55,56,57,58,59,60,61,62,63,64,65,66,67,68,69,113,114,115,116,118,119', 1),
(213, 109, '70,71,72,73,74,75,76,77,78,79,80,81,82,83,84,85,86,87,88,89,90,91,92,93,94,95,96,97,98,99,100,101,102,103,104,105,106,107,108,109,110,111,112', 2),
(220, 104, '1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30,31,32,33,34,35,36,37,38,39,40,41,42,43,44,45,47,48,49,50,51,52,53,54,55,57,58,59,60,61,62,63,64,65,66,67,68,69,113,114,115,116,118,119', 1),
(221, 106, '1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30,31,32,33,34,35,36,37,38,39,40,41,42,43,44,45,47,48,49,50,51,52,53,54,55,56,57,58,59,60,61,62,63,64,65,66,67,68,69,113,114,115,116,118,119', 1),
(222, 106, '70,71,72,73,74,75,76,77,78,79,80,81,82,83,84,85,86,87,88,89,90,91,92,93,94,95,96,97,98,99,100,101,102,103,104,105,106,107,108,109,110,111,112', 2),
(223, 111, '1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30,31,32,33,34,35,36,37,38,39,40,41,42,43,44,45,47,48,49,50,51,52,53,54,55,56,57,58,59,60,61,62,63,64,65,66,67,68,69,113,114,115,116,118,119,120,121', 1),
(224, 111, '70,71,72,73,74,75,76,77,78,79,80,81,82,83,84,85,86,87,88,89,90,91,92,93,94,95,96,97,98,99,100,101,102,103,104,105,106,107,108,109,110,111,112', 2),
(225, 105, '1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30,31,32,33,34,35,36,37,38,39,40,41,42,43,44,45,47,48,49,50,51,52,53,54,55,56,57,58,59,60,61,62,63,64,65,66,67,68,69,113,114,115,116,118,119,120,121', 1),
(226, 105, '70,71,72,73,74,75,76,77,78,79,80,81,82,83,84,85,86,87,88,89,90,91,92,93,94,95,96,97,98,99,100,101,102,103,104,105,106,107,108,109,110,111,112', 2),
(228, 103, '1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30,31,32,33,34,35,36,37,38,39,40,41,42,43,44,45,47,48,49,50,51,52,53,54,55,56,57,58,59,60,61,62,63,64,65,66,67,68,69,113,114,115,116,118,119,120,121', 1),
(229, 103, '70,71,72,73,74,75,76,77,78,79,80,81,82,83,84,85,86,87,88,89,90,91,92,93,94,95,96,97,98,99,100,101,102,103,104,105,106,107,108,109,110,111,112', 2),
(232, 100, '2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30,31,32,33,34,35,36,37,38,39,40,41,42,43,44,45,47,48,49,50,51,52,53,54,55,57,58,59,60,61,62,64,65,66,67,68,69,113,116,118,119', 1),
(233, 112, '1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30,31,32,33,34,35,36,37,38,39,40,41,42,43,44,45,46,47,48,49,50,51,52,53,54,55,57,58,59,60,61,62,64,65,66,67,68,69,113,116,118,119,120,121', 1),
(238, 114, 'Array', 1),
(239, 114, 'Array', 2),
(243, 114, '1,11,12,13,14,15,16,17,18,19,20,21,40,41,116', 1),
(246, 119, '1,11,12,13,14,15,16,17,18,19,20,21,40,41,116', 1),
(247, 120, '1,11,12,13,14,15,16,17,18,19,20,21,40,41,116', 1),
(249, 122, '1,11,12,13,14,15,16,17,18,19,20,21,40,41,116', 1),
(251, 124, '1,11,12,13,14,15,16,17,18,19,20,21,40,41,116', 1),
(252, 125, '1,11,12,13,14,15,16,17,18,19,20,21,40,41,116', 1),
(254, 128, '1,11,12,13,14,15,16,17,18,19,20,21,40,41,116', 1),
(255, 129, '1,11,12,13,14,15,16,17,18,19,20,21,40,41,116', 1),
(257, 131, '1,11,12,13,14,15,16,17,18,19,20,21,40,41,116', 1),
(258, 132, '1,11,12,13,14,15,16,17,18,19,20,21,40,41,116', 1),
(259, 133, '1,11,12,13,14,15,16,17,18,19,20,21,40,41,116', 1),
(260, 134, '1,11,12,13,14,15,16,17,18,19,20,21,40,41,116', 1),
(261, 135, '1,11,12,13,14,15,16,17,18,19,20,21,40,41,116', 1),
(262, 136, '1,11,12,13,14,15,16,17,18,19,20,21,40,41,116', 1),
(263, 137, '1,11,12,13,14,15,16,17,18,19,20,21,40,41,116', 1),
(264, 138, '1,11,12,13,14,15,16,17,18,19,20,21,40,41,116', 1),
(265, 139, '1,11,12,13,14,15,16,17,18,19,20,21,40,41,116', 1),
(266, 140, '1,11,12,13,14,15,16,17,18,19,20,21,40,41,116', 1),
(267, 141, '1,11,12,13,14,15,16,17,18,19,20,21,40,41,116', 1),
(268, 142, '1,11,12,13,14,15,16,17,18,19,20,21,40,41,116', 1),
(269, 143, '1,11,12,13,14,15,16,17,18,19,20,21,40,41,116', 1),
(270, 144, '1,11,12,13,14,15,16,17,18,19,20,21,40,41,116', 1),
(271, 145, '1,11,12,13,14,15,16,17,18,19,20,21,40,41,116', 1),
(272, 146, '1,11,12,13,14,15,16,17,18,19,20,21,40,41,116', 1),
(273, 147, '1,11,12,13,14,15,16,17,18,19,20,21,40,41,116', 1),
(274, 148, '1,11,12,13,14,15,16,17,18,19,20,21,40,41,116', 1),
(275, 149, '1,11,12,13,14,15,16,17,18,19,20,21,40,41,116', 1),
(276, 150, '1,11,12,13,14,15,16,17,18,19,20,21,40,41,116', 1),
(277, 151, '1,11,12,13,14,15,16,17,18,19,20,21,40,41,116', 1),
(295, 130, '1,11,12,13,14,15,16,17,18,19,20,21,40,41,116', 1),
(298, 113, '1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30,31,32,33,34,35,36,37,38,39,40,41,42,43,44,45,46,47,48,49,50,51,52,53,54,55,56,57,58,59,60,61,62,63,64,65,66,67,68,69,113,114,115,116,118,119,120,121', 1),
(299, 113, '70,71,72,73,74,75,76,77,78,79,80,81,82,83,84,85,86,87,88,89,90,91,92,93,94,95,96,97,98,99,100,101,102,103,104,105,106,107,108,109,110,111,112', 2),
(308, 155, '1,11,12,13,14,15,16,17,18,19,20,21,40,41,116', 1),
(310, 153, '1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30,31,32,33,34,35,36,37,38,39,40,41,42,43,44,45,46,47,48,49,50,51,52,53,54,55,56,57,58,59,60,61,62,63,64,65,66,67,68,69,113,114,115,116,118,119,120,121', 1),
(311, 153, '70,71,72,73,74,75,76,77,78,79,80,81,82,83,84,85,86,87,88,89,90,91,92,93,94,95,96,97,98,99,100,101,102,103,104,105,106,107,108,109,110,111,112', 2),
(312, 154, '1,11,12,13,14,15,16,17,18,19,20,21,40,41,116', 1),
(313, 156, '1,11,12,13,14,15,16,17,18,19,20,21,40,41,116', 1),
(315, 158, '1,11,12,13,14,15,16,17,18,19,20,21,40,41,116', 1),
(316, 159, '1,11,12,13,14,15,16,17,18,19,20,21,40,41,116', 1),
(317, 160, '1,11,12,13,14,15,16,17,18,19,20,21,40,41,116', 1),
(318, 161, '1,11,12,13,14,15,16,17,18,19,20,21,40,41,116', 1),
(319, 162, '1,11,12,13,14,15,16,17,18,19,20,21,40,41,116', 1),
(321, 127, '1,11,12,13,14,15,16,17,18,19,20,21,41,116', 1),
(328, 165, 'Array', 1),
(329, 165, 'Array', 2),
(336, 126, '1,11,12,13,14,15,16,17,18,19,20,21,33,40,41,116', 1),
(347, 121, '1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30,31,32,33,34,35,36,37,38,39,40,41,42,43,44,45,46,47,48,49,50,51,52,53,54,55,56,57,58,59,60,61,62,63,64,65,66,67,68,69,113,114,115,116,118,119,120,121,122,123', 1),
(348, 121, '70,71,72,73,74,75,76,77,78,79,80,81,82,83,84,85,86,87,88,89,90,91,92,93,94,95,96,97,98,99,100,101,102,103,104,105,106,107,108,109,110,111,112', 2),
(349, 123, '1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,40,41,116', 1),
(350, 118, '1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,40,41,116', 1),
(357, 115, '1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,31,32,33,34,35,36,37,38,39,40,41,116,123', 1),
(358, 152, '1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30,31,32,33,34,35,36,37,38,39,40,41,42,43,44,45,46,47,48,49,50,51,52,53,54,55,56,57,58,59,60,61,62,63,64,65,66,67,68,69,113,114,115,116,118,119,120,121,122,123', 1),
(359, 164, '1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30,31,32,33,34,35,36,37,38,39,40,41,42,43,44,45,46,47,48,49,50,51,52,53,54,55,56,57,58,59,60,61,62,63,64,65,66,67,68,69,113,114,115,116,118,119,120,121,122,123', 1),
(360, 163, '1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30,31,32,33,34,35,36,37,38,39,40,41,42,43,44,45,46,47,48,49,50,51,52,53,54,55,57,58,59,60,61,62,63,64,65,66,67,68,69,113,116,118,119,120,121,122,123', 1),
(362, 157, '1,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,40,41,116', 1),
(363, 116, '1,11,12,13,14,15,16,17,18,19,20,21,40,41,116', 1),
(366, 117, '1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30,31,32,33,34,35,36,37,38,39,40,41,42,43,44,45,46,47,48,49,50,51,52,53,54,55,56,57,58,59,60,61,62,63,64,65,66,67,68,69,113,114,115,116,118,119,120,121,122,123', 1);

-- --------------------------------------------------------

--
-- Table structure for table `skills`
--

CREATE TABLE `skills` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tax_status`
--

CREATE TABLE `tax_status` (
  `id` bigint(20) NOT NULL,
  `code` varchar(100) NOT NULL,
  `description` varchar(255) NOT NULL,
  `is_deleted` varchar(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_applicant`
--

CREATE TABLE `tbl_applicant` (
  `id` int(11) NOT NULL,
  `applicant_id` int(11) NOT NULL,
  `application_number` varchar(255) NOT NULL,
  `application_status_id` int(11) NOT NULL,
  `is_viewed` int(11) NOT NULL,
  `is_assessed` int(11) NOT NULL,
  `assessed_by` varchar(255) DEFAULT NULL,
  `interviewer_id` int(11) NOT NULL,
  `assessment_result` int(11) DEFAULT NULL,
  `working_id` int(11) NOT NULL,
  `working_datetime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `working` varchar(255) NOT NULL,
  `pending_interview_status` int(11) NOT NULL,
  `position_applied` varchar(225) NOT NULL,
  `desired_monthly_salary` varchar(225) NOT NULL,
  `date_available_for_work` date NOT NULL,
  `date_of_contact` date NOT NULL,
  `interview_date` datetime NOT NULL,
  `date_applied` datetime NOT NULL,
  `last_status_update` date NOT NULL,
  `note` varchar(225) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_applicant`
--

INSERT INTO `tbl_applicant` (`id`, `applicant_id`, `application_number`, `application_status_id`, `is_viewed`, `is_assessed`, `assessed_by`, `interviewer_id`, `assessment_result`, `working_id`, `working_datetime`, `working`, `pending_interview_status`, `position_applied`, `desired_monthly_salary`, `date_available_for_work`, `date_of_contact`, `interview_date`, `date_applied`, `last_status_update`, `note`) VALUES
(1, 1, 'APPLICANT-20190903-rnSTX', 1, 1, 0, NULL, 0, NULL, 2, '2019-09-04 03:37:56', 'Example, Example', 0, '1', '20000', '2019-01-01', '0000-00-00', '0000-00-00 00:00:00', '2019-09-03 00:00:00', '0000-00-00', '');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_applicant_character_reference`
--

CREATE TABLE `tbl_applicant_character_reference` (
  `id` int(11) NOT NULL,
  `reference_name` varchar(255) NOT NULL,
  `reference_contact` varchar(255) NOT NULL,
  `reference_address` varchar(255) NOT NULL,
  `reference_position` varchar(255) NOT NULL,
  `applicant_id` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_applicant_education`
--

CREATE TABLE `tbl_applicant_education` (
  `id` int(11) NOT NULL,
  `applicant_id` int(11) DEFAULT NULL,
  `education_level_id` int(11) DEFAULT NULL,
  `school_name` varchar(255) DEFAULT NULL,
  `school_address` varchar(255) DEFAULT NULL,
  `school_year_attended_from` varchar(225) DEFAULT NULL,
  `school_year_attended_to` varchar(225) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_applicant_profile`
--

CREATE TABLE `tbl_applicant_profile` (
  `id` int(11) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `middle_name` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `present_address` varchar(255) NOT NULL,
  `contact_number` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `state_province_region` varchar(255) NOT NULL,
  `postal_code` varchar(255) NOT NULL,
  `country` varchar(255) NOT NULL,
  `gender` varchar(255) NOT NULL,
  `age` int(11) NOT NULL,
  `date_of_birth` date NOT NULL,
  `place_of_birth` varchar(255) NOT NULL,
  `citizenship` varchar(255) NOT NULL,
  `marital_status` varchar(255) NOT NULL,
  `educational_attainment` int(11) NOT NULL,
  `work_experiences` int(11) NOT NULL,
  `character_references` int(11) NOT NULL,
  `sss` varchar(255) NOT NULL,
  `pagibig` varchar(255) NOT NULL,
  `tin` varchar(255) NOT NULL,
  `philhealth` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_applicant_profile`
--

INSERT INTO `tbl_applicant_profile` (`id`, `first_name`, `middle_name`, `last_name`, `email`, `present_address`, `contact_number`, `city`, `state_province_region`, `postal_code`, `country`, `gender`, `age`, `date_of_birth`, `place_of_birth`, `citizenship`, `marital_status`, `educational_attainment`, `work_experiences`, `character_references`, `sss`, `pagibig`, `tin`, `philhealth`) VALUES
(1, 'Test', 'Test', 'Test', 'Test@gmail.com', 'Test', '09123456789', 'Test', 'Test', '1801', 'PH', 'other', 18, '1999-03-16', 'Test', 'Test', 'single', 0, 0, 0, '', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_applicant_work_experience`
--

CREATE TABLE `tbl_applicant_work_experience` (
  `id` int(11) NOT NULL,
  `applicant_id` int(11) NOT NULL,
  `company_name` varchar(255) NOT NULL,
  `date_range_from` date NOT NULL,
  `date_range_to` date NOT NULL,
  `is_present` int(11) NOT NULL,
  `company_address` varchar(255) DEFAULT NULL,
  `nature_of_work` varchar(255) DEFAULT NULL,
  `monthly_salary` bigint(20) DEFAULT NULL,
  `reason_for_leaving` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_application_history`
--

CREATE TABLE `tbl_application_history` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `date_of_activity` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `activity` varchar(255) NOT NULL,
  `activity_type` int(11) NOT NULL,
  `module` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_application_status`
--

CREATE TABLE `tbl_application_status` (
  `id` int(11) NOT NULL,
  `status_name` varchar(225) NOT NULL,
  `description` varchar(255) NOT NULL,
  `is_deleted` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_application_status`
--

INSERT INTO `tbl_application_status` (`id`, `status_name`, `description`, `is_deleted`) VALUES
(1, 'new_applicant', 'New Applicant', 0),
(2, 'accepted', 'Accepted', 0),
(3, 'rejected', 'Rejected', 0),
(4, 'shortlisted', 'Shortlisted', 0),
(5, 'passed', 'Passed', 0),
(6, 'failed', 'Failed', 0),
(7, 'cancelled', 'Cancelled', 0),
(8, 'hired', 'Hired', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_education_level`
--

CREATE TABLE `tbl_education_level` (
  `id` int(11) NOT NULL,
  `is_tertiary` int(11) NOT NULL,
  `education_type` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_education_level`
--

INSERT INTO `tbl_education_level` (`id`, `is_tertiary`, `education_type`) VALUES
(1, 0, 'Primary'),
(2, 0, 'Secondary'),
(3, 0, 'Senior Secondary'),
(4, 0, 'Tertiary'),
(5, 1, 'Associate Degree'),
(6, 1, 'Bachelor''s Degree'),
(7, 1, 'Masteral Degree'),
(8, 1, 'Doctorate Degree');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_employee`
--

CREATE TABLE `tbl_employee` (
  `id` int(11) NOT NULL,
  `employee_type_id` int(11) NOT NULL,
  `employee_number` varchar(225) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `middle_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_interview`
--

CREATE TABLE `tbl_interview` (
  `id` int(11) NOT NULL,
  `applicant_id` int(11) NOT NULL,
  `process_owner_id` int(11) NOT NULL,
  `interview_date` datetime DEFAULT NULL,
  `interview_status` int(11) DEFAULT NULL,
  `remarks` varchar(255) DEFAULT NULL,
  `status_date_change` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_interview`
--

INSERT INTO `tbl_interview` (`id`, `applicant_id`, `process_owner_id`, `interview_date`, `interview_status`, `remarks`, `status_date_change`) VALUES
(1, 6, 1, '2019-09-04 11:32:00', 5, 'HAHA', '2019-09-03 23:32:30');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_interview_process`
--

CREATE TABLE `tbl_interview_process` (
  `id` int(11) NOT NULL,
  `process_id` int(11) NOT NULL,
  `process_name` varchar(255) NOT NULL,
  `employee_process_id` varchar(1000) NOT NULL,
  `datetime_created` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_interview_process`
--

INSERT INTO `tbl_interview_process` (`id`, `process_id`, `process_name`, `employee_process_id`, `datetime_created`) VALUES
(1, 1, 'Programmer', '1,71,72', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_position`
--

CREATE TABLE `tbl_position` (
  `id` int(11) NOT NULL,
  `process_id` int(11) NOT NULL,
  `position_name` varchar(225) NOT NULL,
  `is_available` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_position`
--

INSERT INTO `tbl_position` (`id`, `process_id`, `position_name`, `is_available`) VALUES
(1, 1, 'Software Engineer', 1),
(2, 2, 'Business Analyst', 1),
(3, 3, 'Systems Analyst', 1),
(4, 4, 'Technical Support', 1),
(5, 5, 'Network Administrator', 1);

-- --------------------------------------------------------

--
-- Table structure for table `trainings`
--

CREATE TABLE `trainings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `location` varchar(255) NOT NULL,
  `topic` varchar(255) NOT NULL,
  `training_date` date NOT NULL,
  `bond_months` int(11) NOT NULL DEFAULT '0',
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `trainings`
--

INSERT INTO `trainings` (`id`, `name`, `location`, `topic`, `training_date`, `bond_months`, `is_deleted`) VALUES
(1, 'Basic Supervisory Skills', 'Marikina City', 'Supervisory skills training is essential because becoming a supervisor or manager demands new skills, you must now learn how to lead and accomplish tasks through others. This one day seminar is excellent for the new supervisor or manager and also for thos', '2019-04-24', 0, 0),
(2, 'Advanced Supervisory Skills', 'Marikina City', 'Supervisors and managers are tasked to make sure that things are done correctly and at the right time. However, managing people has gradually evolved, and most experienced supervisors must learn to adapt to the change. Some â€œoldâ€ supervisory technique', '2019-06-03', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) NOT NULL,
  `employee_id` bigint(20) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `password_decrypted` varchar(255) DEFAULT NULL,
  `user_type_id` bigint(20) NOT NULL,
  `password_question` varchar(255) NOT NULL DEFAULT '',
  `password_answer` varchar(255) NOT NULL DEFAULT '',
  `is_login` tinyint(1) NOT NULL DEFAULT '0',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  `last_activity` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `employee_id`, `username`, `password`, `password_decrypted`, `user_type_id`, `password_question`, `password_answer`, `is_login`, `is_active`, `is_deleted`, `last_activity`) VALUES
(1, 1, 'admin', 'fH7MOXC7+Yh5IxWYWILiZw==', 'P@ssw0rd', 4, 'Sino pinaka gwapo?', 'Ako', 0, 1, 0, '2019-09-04 03:39:52'),
(2, 95, 'example1', '1rXBbo3Bo180n60ou3D1Zg==', 'example', 2, 'example1', 'example1', 0, 1, 0, '2019-09-04 03:39:43');

-- --------------------------------------------------------

--
-- Table structure for table `user_access`
--

CREATE TABLE `user_access` (
  `user_access_id` bigint(20) NOT NULL,
  `feature` varchar(255) DEFAULT NULL,
  `system_id` bigint(20) DEFAULT NULL,
  `maintenance_of` varchar(255) DEFAULT NULL,
  `user_type_id` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_access`
--

INSERT INTO `user_access` (`user_access_id`, `feature`, `system_id`, `maintenance_of`, `user_type_id`) VALUES
(42, 'Administrator', 1, NULL, '4'),
(43, 'Audit Log', 1, NULL, '4'),
(44, 'Employees', 1, NULL, '4'),
(52, 'Job Titles', 1, NULL, '2,4'),
(119, 'Applicant', 1, NULL, '2,4');

-- --------------------------------------------------------

--
-- Table structure for table `user_type`
--

CREATE TABLE `user_type` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `description` varchar(255) NOT NULL,
  `is_deleted` int(5) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_type`
--

INSERT INTO `user_type` (`id`, `description`, `is_deleted`) VALUES
(2, 'Employee', 0),
(4, 'Admin', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `education_level`
--
ALTER TABLE `education_level`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `employees_education`
--
ALTER TABLE `employees_education`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `employees_emergency_contacts`
--
ALTER TABLE `employees_emergency_contacts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `employees_trainings`
--
ALTER TABLE `employees_trainings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `employment_status`
--
ALTER TABLE `employment_status`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `job_title`
--
ALTER TABLE `job_title`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pay_grade`
--
ALTER TABLE `pay_grade`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`perm_id`);

--
-- Indexes for table `skills`
--
ALTER TABLE `skills`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tax_status`
--
ALTER TABLE `tax_status`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_applicant`
--
ALTER TABLE `tbl_applicant`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_applicant_character_reference`
--
ALTER TABLE `tbl_applicant_character_reference`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_applicant_education`
--
ALTER TABLE `tbl_applicant_education`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_applicant_profile`
--
ALTER TABLE `tbl_applicant_profile`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_applicant_work_experience`
--
ALTER TABLE `tbl_applicant_work_experience`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_application_history`
--
ALTER TABLE `tbl_application_history`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_application_status`
--
ALTER TABLE `tbl_application_status`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_education_level`
--
ALTER TABLE `tbl_education_level`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_employee`
--
ALTER TABLE `tbl_employee`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_interview`
--
ALTER TABLE `tbl_interview`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_interview_process`
--
ALTER TABLE `tbl_interview_process`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_position`
--
ALTER TABLE `tbl_position`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `trainings`
--
ALTER TABLE `trainings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_access`
--
ALTER TABLE `user_access`
  ADD PRIMARY KEY (`user_access_id`);

--
-- Indexes for table `user_type`
--
ALTER TABLE `user_type`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `departments`
--
ALTER TABLE `departments`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `education_level`
--
ALTER TABLE `education_level`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=97;
--
-- AUTO_INCREMENT for table `employees_education`
--
ALTER TABLE `employees_education`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `employees_emergency_contacts`
--
ALTER TABLE `employees_emergency_contacts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;
--
-- AUTO_INCREMENT for table `employees_trainings`
--
ALTER TABLE `employees_trainings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `employment_status`
--
ALTER TABLE `employment_status`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `job_title`
--
ALTER TABLE `job_title`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `pay_grade`
--
ALTER TABLE `pay_grade`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `skills`
--
ALTER TABLE `skills`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tax_status`
--
ALTER TABLE `tax_status`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_applicant`
--
ALTER TABLE `tbl_applicant`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `tbl_applicant_character_reference`
--
ALTER TABLE `tbl_applicant_character_reference`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_applicant_education`
--
ALTER TABLE `tbl_applicant_education`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_applicant_profile`
--
ALTER TABLE `tbl_applicant_profile`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `tbl_applicant_work_experience`
--
ALTER TABLE `tbl_applicant_work_experience`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_application_history`
--
ALTER TABLE `tbl_application_history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_application_status`
--
ALTER TABLE `tbl_application_status`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `tbl_education_level`
--
ALTER TABLE `tbl_education_level`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `tbl_employee`
--
ALTER TABLE `tbl_employee`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_interview`
--
ALTER TABLE `tbl_interview`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `tbl_interview_process`
--
ALTER TABLE `tbl_interview_process`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `tbl_position`
--
ALTER TABLE `tbl_position`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `trainings`
--
ALTER TABLE `trainings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `user_type`
--
ALTER TABLE `user_type`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
