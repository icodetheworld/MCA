-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jul 16, 2019 at 01:04 PM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 7.3.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `abc`
--

-- --------------------------------------------------------

--
-- Table structure for table `atd_backup`
--

CREATE TABLE `atd_backup` (
  `id` int(11) NOT NULL,
  `stud_id` int(11) DEFAULT NULL,
  `state` enum('on','') DEFAULT NULL,
  `day` date DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `room` int(11) DEFAULT NULL,
  `sms` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `atd_backup`
--

INSERT INTO `atd_backup` (`id`, `stud_id`, `state`, `day`, `created_by`, `created_at`, `updated_at`, `room`, `sms`) VALUES
(4, 6, NULL, '2019-06-10', NULL, '2019-06-02 06:52:26', '2019-06-02 06:52:31', 1, 0),
(5, 6, NULL, '2019-06-16', NULL, '2019-06-02 06:57:22', '2019-06-02 06:58:30', 2, 0),
(6, 6, NULL, '2019-06-17', NULL, '2019-06-02 06:58:56', '2019-06-02 06:59:19', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `atd_room`
--

CREATE TABLE `atd_room` (
  `id` int(11) NOT NULL,
  `room_id` int(11) NOT NULL,
  `day` date NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `atd_room`
--

INSERT INTO `atd_room` (`id`, `room_id`, `day`, `created_at`, `updated_at`) VALUES
(1, 1, '2019-05-30', '2019-05-29 18:52:10', NULL),
(2, 2, '2019-05-15', '2019-05-30 07:03:00', NULL),
(3, 2, '2019-05-14', '2019-05-30 07:06:42', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `attendance`
--

CREATE TABLE `attendance` (
  `id` int(11) NOT NULL,
  `stud_id` int(11) NOT NULL,
  `state` enum('on','') DEFAULT NULL,
  `day` date NOT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `room` int(11) DEFAULT NULL,
  `sms` int(11) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Triggers `attendance`
--
DELIMITER $$
CREATE TRIGGER `atd_log` BEFORE DELETE ON `attendance` FOR EACH ROW INSERT INTO `atd_backup`  VALUES (OLD.id, OLD.stud_id, OLD.state, OLD.day, OLD.created_by, OLD.created_at, OLD.updated_at, OLD.room, OLD.sms)
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `bday`
--

CREATE TABLE `bday` (
  `id` int(11) NOT NULL,
  `name` varchar(191) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `month` varchar(100) NOT NULL,
  `day` varchar(100) NOT NULL,
  `stud_id` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `wished` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bday`
--

INSERT INTO `bday` (`id`, `name`, `phone`, `month`, `day`, `stud_id`, `created_at`, `updated_at`, `wished`) VALUES
(5, 'jjj jjj', '8888', '06', '12', 6, '2019-06-02 06:50:39', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `class`
--

CREATE TABLE `class` (
  `id` int(11) NOT NULL,
  `class` varchar(30) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `class`
--

INSERT INTO `class` (`id`, `class`, `created_at`, `updated_at`) VALUES
(1, '10', '2019-05-29 18:47:03', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `exam_schedule`
--

CREATE TABLE `exam_schedule` (
  `id` int(11) NOT NULL,
  `class` int(11) NOT NULL,
  `subject` int(11) NOT NULL,
  `date` date NOT NULL,
  `time` time DEFAULT NULL,
  `hall` varchar(191) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `house`
--

CREATE TABLE `house` (
  `id` int(11) NOT NULL,
  `name` varchar(191) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `house`
--

INSERT INTO `house` (`id`, `name`, `created_at`, `updated_at`) VALUES
(3, 'Green', '2019-05-25 16:11:30', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `marks`
--

CREATE TABLE `marks` (
  `id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `subject_id` int(11) NOT NULL,
  `mark` int(11) NOT NULL,
  `class` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Triggers `marks`
--
DELIMITER $$
CREATE TRIGGER `mark_log` BEFORE DELETE ON `marks` FOR EACH ROW insert into `mark_backup` values(OLD.id, OLD.student_id, OLD.subject_id, OLD.mark, OLD.class, OLD.created_at, OLD.updated_at)
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `mark_backup`
--

CREATE TABLE `mark_backup` (
  `id` int(11) NOT NULL,
  `student_id` int(11) DEFAULT NULL,
  `subject_id` int(11) DEFAULT NULL,
  `mark` int(11) DEFAULT NULL,
  `class` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mark_backup`
--

INSERT INTO `mark_backup` (`id`, `student_id`, `subject_id`, `mark`, `class`, `created_at`, `updated_at`) VALUES
(2, 6, 1, 800, 1, '2019-06-02 07:04:06', '2019-06-02 07:05:51');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_06_25_071851_create_table_fuck', 2);

-- --------------------------------------------------------

--
-- Table structure for table `notice`
--

CREATE TABLE `notice` (
  `id` int(11) NOT NULL,
  `title` varchar(191) NOT NULL,
  `content` varchar(300) NOT NULL,
  `i_date` date DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `notice`
--

INSERT INTO `notice` (`id`, `title`, `content`, `i_date`, `created_at`, `updated_at`) VALUES
(3, 'This is a sample notice for a particular date', 'The date is given above is not publishing date,', '2019-01-01', '2019-05-18 08:22:27', NULL),
(4, 'This is a sample notice without date', 'No date mentioned in notice', NULL, '2019-05-18 08:22:47', NULL),
(5, 'testttttt', 'hgfdduyfuygiuygliygi', '2019-04-06', '2019-05-30 07:26:23', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `parents`
--

CREATE TABLE `parents` (
  `id` int(11) NOT NULL,
  `name` varchar(191) NOT NULL,
  `job` varchar(191) NOT NULL,
  `address` varchar(300) NOT NULL,
  `gender` enum('Male','Female','Others') DEFAULT NULL,
  `phone` varchar(15) NOT NULL,
  `phone2` varchar(15) NOT NULL,
  `email` varchar(191) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `parents`
--

INSERT INTO `parents` (`id`, `name`, `job`, `address`, `gender`, `phone`, `phone2`, `email`, `created_at`, `updated_at`) VALUES
(10, 'sajid', 'business', '123', 'Male', '8606065566', 'password', 'abc@abc.com', '2019-05-25 18:59:46', '2019-05-26 05:47:48'),
(11, 'Ashique N S', '111', '111', 'Male', '12345678', '123', '111@111.com', '2019-05-25 19:00:21', '2019-05-30 02:50:53');

-- --------------------------------------------------------

--
-- Table structure for table `parent_relation`
--

CREATE TABLE `parent_relation` (
  `student_id` int(11) NOT NULL,
  `parent_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `room`
--

CREATE TABLE `room` (
  `id` int(11) NOT NULL,
  `class` int(11) NOT NULL,
  `division` varchar(10) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `room`
--

INSERT INTO `room` (`id`, `class`, `division`, `created_at`, `updated_at`) VALUES
(1, 1, 'A', '2019-05-29 18:47:04', NULL),
(2, 1, 'B', '2019-05-29 20:02:08', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` int(11) NOT NULL,
  `field` varchar(191) DEFAULT NULL,
  `value` varchar(3000) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `field`, `value`, `created_at`, `updated_at`) VALUES
(1, 'sms_bal', '362.55', '2019-05-22 06:53:05', '2019-06-25 07:13:42');

-- --------------------------------------------------------

--
-- Table structure for table `sms_failed`
--

CREATE TABLE `sms_failed` (
  `id` int(11) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `message` varchar(300) NOT NULL,
  `day` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `id` int(11) NOT NULL,
  `ad_no` varchar(30) DEFAULT NULL,
  `f_name` varchar(191) NOT NULL,
  `l_name` varchar(191) NOT NULL,
  `gender` enum('Male','Female','Others') DEFAULT NULL,
  `name_of_father` varchar(191) DEFAULT NULL,
  `name_of_mother` varchar(191) DEFAULT NULL,
  `dob` date NOT NULL,
  `religion` varchar(191) DEFAULT NULL,
  `cast` varchar(191) DEFAULT NULL,
  `email` varchar(191) DEFAULT NULL,
  `date_of_admission` date NOT NULL,
  `house` int(11) DEFAULT NULL,
  `phone` varchar(15) NOT NULL,
  `address` varchar(300) NOT NULL,
  `room` int(11) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `class` int(11) NOT NULL,
  `bus` enum('No','Yes') DEFAULT 'No'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id`, `ad_no`, `f_name`, `l_name`, `gender`, `name_of_father`, `name_of_mother`, `dob`, `religion`, `cast`, `email`, `date_of_admission`, `house`, `phone`, `address`, `room`, `created_by`, `updated_by`, `created_at`, `updated_at`, `class`, `bus`) VALUES
(6, 'jjjj', 'jjj', 'jjj', 'Male', 'jj', 'jjj', '2019-06-12', 'jjj', 'jjj', 'jjj@jjj.com', '2019-06-01', 3, '8888', '9999', 2, 12, NULL, '2019-06-02 06:50:39', '2019-06-02 06:57:48', 1, 'Yes');

--
-- Triggers `students`
--
DELIMITER $$
CREATE TRIGGER `student_log` BEFORE DELETE ON `students` FOR EACH ROW INSERT INTO `students_backup`  VALUES (OLD.id, OLD.ad_no, OLD.f_name, OLD.l_name, OLD.gender, OLD.name_of_father, OLD.name_of_mother, OLD.dob, OLD.religion, OLD.cast, OLD.email, OLD.date_of_admission, OLD.house,OLD.address,OLD.phone,OLD.room,OLD.class, OLD.created_by,OLD.updated_by, CURRENT_TIMESTAMP, NULL)
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `students_backup`
--

CREATE TABLE `students_backup` (
  `id` int(11) NOT NULL,
  `ad_no` varchar(30) DEFAULT NULL,
  `f_name` varchar(191) DEFAULT NULL,
  `l_name` varchar(191) DEFAULT NULL,
  `gender` enum('Male','Female','Others') DEFAULT NULL,
  `name_of_father` varchar(191) DEFAULT NULL,
  `name_of_mother` varchar(191) DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `religion` varchar(191) DEFAULT NULL,
  `cast` varchar(191) DEFAULT NULL,
  `email` varchar(191) DEFAULT NULL,
  `date_of_admission` date DEFAULT NULL,
  `house` int(11) DEFAULT NULL,
  `address` varchar(300) DEFAULT NULL,
  `phone` varchar(15) DEFAULT NULL,
  `room` int(11) DEFAULT NULL,
  `class` int(11) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `students_backup`
--

INSERT INTO `students_backup` (`id`, `ad_no`, `f_name`, `l_name`, `gender`, `name_of_father`, `name_of_mother`, `dob`, `religion`, `cast`, `email`, `date_of_admission`, `house`, `address`, `phone`, `room`, `class`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(2, '', 'Shagal', 'sajid', 'Male', 'Sajid a Salam', 'Ayisha P P', '2019-05-02', 'Muslim', 'Islam', 'i.code.the.world@gmail.com', '2019-05-23', 3, 'abc', '8606065566', 1, 1, 1, 1, '2019-05-29 20:01:03', NULL),
(3, '', '890', '890', 'Male', '890', '809', '2019-05-08', '890', '890', '890@890', '2019-05-22', 3, '890', '890890', 1, 1, 1, NULL, '2019-05-29 19:32:24', NULL),
(4, '', '890', '890', 'Male', '890', '809', '2019-05-08', '890', '890', '890@890', '2019-05-22', 3, '890', '890890', 1, 1, 1, NULL, '2019-05-29 20:01:03', NULL),
(5, '12160239', 'asd', 'asd', 'Male', 'jkl', 'jkl', '2019-05-06', 'jkl', 'jkl', 'jkl@jkl', '2019-05-08', 3, '999', '8606065566', 2, 1, 1, 1, '2019-06-01 14:43:32', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `subjects`
--

CREATE TABLE `subjects` (
  `id` int(11) NOT NULL,
  `code` varchar(30) NOT NULL,
  `class_id` int(11) DEFAULT NULL,
  `subject` varchar(30) NOT NULL,
  `max` int(6) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `subjects`
--

INSERT INTO `subjects` (`id`, `code`, `class_id`, `subject`, `max`, `created_at`, `updated_at`) VALUES
(1, '11', 1, 'Maths', 100, '2019-05-29 18:52:49', '2019-05-29 19:19:27');

-- --------------------------------------------------------

--
-- Table structure for table `table_fuck`
--

CREATE TABLE `table_fuck` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `idd` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `teachers`
--

CREATE TABLE `teachers` (
  `id` int(11) NOT NULL,
  `name` varchar(191) NOT NULL,
  `image` varchar(300) DEFAULT NULL,
  `qualification` varchar(191) DEFAULT NULL,
  `gender` enum('Male','Female','Others') DEFAULT NULL,
  `dob` date NOT NULL,
  `doj` date NOT NULL,
  `email` varchar(191) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `address` varchar(300) NOT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `room_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `teachers`
--

INSERT INTO `teachers` (`id`, `name`, `image`, `qualification`, `gender`, `dob`, `doj`, `email`, `phone`, `address`, `created_by`, `created_at`, `updated_at`, `room_id`) VALUES
(5, 'Anitha Chacko', NULL, 'm.tech', 'Male', '2019-05-07', '2019-05-06', 'anitha@anitha.com', '8606065566', '123', 1, '2019-05-25 18:57:12', '2019-05-30 01:28:44', 2),
(8, 'Shagal', NULL, 'adsa', 'Male', '2019-06-11', '2019-06-11', 'acd@dcv.com', '8111902589', '123', 1, '2019-06-25 07:13:23', NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `timetable`
--

CREATE TABLE `timetable` (
  `id` int(11) NOT NULL,
  `day` enum('monday','tuesday','wednessday','thursday','friday') NOT NULL,
  `section` enum('1','2','3','4','5','6','7') NOT NULL,
  `subject` int(11) NOT NULL,
  `room` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `role` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'guest',
  `parent_id` int(11) DEFAULT NULL,
  `teacher_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `role`, `parent_id`, `teacher_id`, `created_at`, `updated_at`, `by`) VALUES
(1, 'Developers', 'i.code.the.world@gmail.com', NULL, '$2y$10$.iAc0KgKVyfdMLmKd6Mn1usa/schhVdGi3VPbS9dlibDq22jMC7e6', NULL, 'admin', NULL, NULL, '2019-06-02 07:17:42', '2019-06-02 07:18:07', NULL),
(2, 'Principal', 'principal@admin.com', NULL, '$2y$10$VLUyid6Vy43Lk3wWamoMqOUphgDpJsLL88VZb.IqR1L9Y1NMPWQgi', NULL, 'admin', NULL, NULL, NULL, '2019-06-02 07:26:40', NULL),
(3, 'Office staff', 'office@admin.com', NULL, '$2y$10$MqMlYqvPp4R7q/f3zgIxGOZ471cvoDRUVaaU0hFqeC0lD1VFAt2g6', NULL, 'admin', NULL, NULL, '2019-05-30 06:44:00', '2019-06-02 07:25:17', 1),
(9, 'Anitha Chacko', 'anitha@anitha.com', NULL, '$2y$10$7bQTEwMU447xB95NWyJq9OMPV7GHvDJEpB4PS17YWxU6j7ixzPb7.', NULL, 'teacher', NULL, 5, '2019-05-25 18:57:12', NULL, 1),
(10, 'sajid', 'abc@abc.com', NULL, '$2y$10$NLmL7SDlIV1iRbKKu1srP.DiRRHS9Selkv8fTILVHMqXUM0B0NSu.', NULL, 'parent', 10, NULL, '2019-05-25 18:59:46', NULL, 1),
(11, '111', '111@111.com', NULL, '$2y$10$xn2wJN3wURE/rHkv4CVg1.vHNzbCdEa/GMRB7OL.mnzzDjC36MX/m', NULL, 'parent', 11, NULL, '2019-05-25 19:00:21', NULL, 1),
(14, 'Staff Admin', 'staff@admin.com', NULL, '$2y$10$Cb5mZEwy/GKLfT7nokpEqOHbVoEiIG/o/FA2uD8FAc5IFE1GoVF1i', NULL, 'admin', NULL, NULL, '2019-05-30 06:44:28', NULL, 1),
(16, 'Shagal', 'acd@dcv.com', NULL, '$2y$10$iYh5u9yIaCbAnpS9IngtRe0q9mngo.ElVxsNhsrCwSKccfZbERXj6', NULL, 'teacher', NULL, 8, '2019-06-25 07:13:23', NULL, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `atd_backup`
--
ALTER TABLE `atd_backup`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `atd_room`
--
ALTER TABLE `atd_room`
  ADD PRIMARY KEY (`id`),
  ADD KEY `room_id` (`room_id`);

--
-- Indexes for table `attendance`
--
ALTER TABLE `attendance`
  ADD PRIMARY KEY (`id`),
  ADD KEY `stud_id` (`stud_id`),
  ADD KEY `room` (`room`);

--
-- Indexes for table `bday`
--
ALTER TABLE `bday`
  ADD PRIMARY KEY (`id`),
  ADD KEY `stud_id` (`stud_id`);

--
-- Indexes for table `class`
--
ALTER TABLE `class`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `class` (`class`);

--
-- Indexes for table `exam_schedule`
--
ALTER TABLE `exam_schedule`
  ADD PRIMARY KEY (`id`),
  ADD KEY `class` (`class`),
  ADD KEY `subject` (`subject`);

--
-- Indexes for table `house`
--
ALTER TABLE `house`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `marks`
--
ALTER TABLE `marks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `student_id` (`student_id`),
  ADD KEY `subject_id` (`subject_id`),
  ADD KEY `class` (`class`);

--
-- Indexes for table `mark_backup`
--
ALTER TABLE `mark_backup`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notice`
--
ALTER TABLE `notice`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `parents`
--
ALTER TABLE `parents`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `parent_relation`
--
ALTER TABLE `parent_relation`
  ADD UNIQUE KEY `student_id` (`student_id`),
  ADD KEY `parent_id` (`parent_id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `room`
--
ALTER TABLE `room`
  ADD PRIMARY KEY (`id`),
  ADD KEY `class` (`class`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sms_failed`
--
ALTER TABLE `sms_failed`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `ad_no` (`ad_no`),
  ADD KEY `house` (`house`),
  ADD KEY `room` (`room`),
  ADD KEY `class` (`class`);

--
-- Indexes for table `students_backup`
--
ALTER TABLE `students_backup`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`),
  ADD KEY `email` (`email`);

--
-- Indexes for table `subjects`
--
ALTER TABLE `subjects`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `code` (`code`),
  ADD KEY `class_id` (`class_id`);

--
-- Indexes for table `table_fuck`
--
ALTER TABLE `table_fuck`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `teachers`
--
ALTER TABLE `teachers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `phone` (`phone`),
  ADD KEY `room_id` (`room_id`);

--
-- Indexes for table `timetable`
--
ALTER TABLE `timetable`
  ADD PRIMARY KEY (`id`),
  ADD KEY `subject` (`subject`),
  ADD KEY `room` (`room`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `parent_id` (`parent_id`),
  ADD KEY `teacher_id` (`teacher_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `atd_room`
--
ALTER TABLE `atd_room`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `attendance`
--
ALTER TABLE `attendance`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `bday`
--
ALTER TABLE `bday`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `class`
--
ALTER TABLE `class`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `exam_schedule`
--
ALTER TABLE `exam_schedule`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `house`
--
ALTER TABLE `house`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `marks`
--
ALTER TABLE `marks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `notice`
--
ALTER TABLE `notice`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `parents`
--
ALTER TABLE `parents`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `room`
--
ALTER TABLE `room`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `sms_failed`
--
ALTER TABLE `sms_failed`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `subjects`
--
ALTER TABLE `subjects`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `table_fuck`
--
ALTER TABLE `table_fuck`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `teachers`
--
ALTER TABLE `teachers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `timetable`
--
ALTER TABLE `timetable`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `atd_room`
--
ALTER TABLE `atd_room`
  ADD CONSTRAINT `atd_room_ibfk_1` FOREIGN KEY (`room_id`) REFERENCES `room` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `attendance`
--
ALTER TABLE `attendance`
  ADD CONSTRAINT `attendance_ibfk_1` FOREIGN KEY (`stud_id`) REFERENCES `students` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `attendance_ibfk_2` FOREIGN KEY (`room`) REFERENCES `room` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `bday`
--
ALTER TABLE `bday`
  ADD CONSTRAINT `bday_ibfk_1` FOREIGN KEY (`stud_id`) REFERENCES `students` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `exam_schedule`
--
ALTER TABLE `exam_schedule`
  ADD CONSTRAINT `exam_schedule_ibfk_1` FOREIGN KEY (`class`) REFERENCES `class` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `exam_schedule_ibfk_2` FOREIGN KEY (`subject`) REFERENCES `subjects` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `marks`
--
ALTER TABLE `marks`
  ADD CONSTRAINT `marks_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `marks_ibfk_2` FOREIGN KEY (`subject_id`) REFERENCES `subjects` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `marks_ibfk_3` FOREIGN KEY (`class`) REFERENCES `class` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `parent_relation`
--
ALTER TABLE `parent_relation`
  ADD CONSTRAINT `parent_relation_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `parent_relation_ibfk_2` FOREIGN KEY (`parent_id`) REFERENCES `parents` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `room`
--
ALTER TABLE `room`
  ADD CONSTRAINT `room_ibfk_1` FOREIGN KEY (`class`) REFERENCES `class` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `students`
--
ALTER TABLE `students`
  ADD CONSTRAINT `students_ibfk_1` FOREIGN KEY (`house`) REFERENCES `house` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `students_ibfk_2` FOREIGN KEY (`room`) REFERENCES `room` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `students_ibfk_3` FOREIGN KEY (`class`) REFERENCES `class` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `subjects`
--
ALTER TABLE `subjects`
  ADD CONSTRAINT `subjects_ibfk_1` FOREIGN KEY (`class_id`) REFERENCES `class` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `teachers`
--
ALTER TABLE `teachers`
  ADD CONSTRAINT `teachers_ibfk_1` FOREIGN KEY (`room_id`) REFERENCES `room` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `timetable`
--
ALTER TABLE `timetable`
  ADD CONSTRAINT `timetable_ibfk_1` FOREIGN KEY (`subject`) REFERENCES `subjects` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `timetable_ibfk_2` FOREIGN KEY (`room`) REFERENCES `room` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`parent_id`) REFERENCES `parents` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `users_ibfk_2` FOREIGN KEY (`teacher_id`) REFERENCES `teachers` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
