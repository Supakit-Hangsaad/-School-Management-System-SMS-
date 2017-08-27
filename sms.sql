-- phpMyAdmin SQL Dump
-- version 4.6.6
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Aug 26, 2017 at 02:50 AM
-- Server version: 10.1.26-MariaDB
-- PHP Version: 7.0.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `sms`
--

-- --------------------------------------------------------

--
-- Table structure for table `rp_category`
--

CREATE TABLE `rp_category` (
  `id` int(11) UNSIGNED NOT NULL,
  `type` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `category_id` int(11) UNSIGNED NOT NULL,
  `topic` text COLLATE utf8_unicode_ci NOT NULL,
  `color` varchar(16) COLLATE utf8_unicode_ci DEFAULT NULL,
  `published` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `rp_category`
--

INSERT INTO `rp_category` (`id`, `type`, `category_id`, `topic`, `color`, `published`) VALUES
(13, 'position', 1, 'a:2:{s:2:\"th\";s:57:\"ผู้อำนวยการโรงเรียน\";s:2:\"en\";s:8:\"Director\";}', NULL, 1),
(14, 'position', 2, 'a:2:{s:2:\"th\";s:66:\"รองผู้อำนวยการโรงเรียน\";s:2:\"en\";s:13:\"Vice-Director\";}', NULL, 1),
(15, 'position', 3, 'a:2:{s:2:\"th\";s:9:\"ครู\";s:2:\"en\";s:7:\"Teacher\";}', NULL, 1),
(16, 'position', 4, 'a:2:{s:2:\"th\";s:30:\"ครูผู้ช่วย\";s:2:\"en\";s:17:\"Assistant teacher\";}', NULL, 1),
(81, 'class', 3, 'a:2:{s:2:\"en\";s:7:\"Class 3\";s:2:\"th\";s:47:\"มัธยมศึกษาปีที่ 3\";}', NULL, 1),
(80, 'class', 2, 'a:2:{s:2:\"en\";s:7:\"Class 2\";s:2:\"th\";s:47:\"มัธยมศึกษาปีที่ 2\";}', NULL, 1),
(79, 'class', 1, 'a:2:{s:2:\"en\";s:7:\"Class 1\";s:2:\"th\";s:47:\"มัธยมศึกษาปีที่ 1\";}', NULL, 1),
(35, 'repairstatus', 0, 'แจ้งซ่อม', '#660000', 1),
(36, 'repairstatus', 0, 'กำลังดำเนินการ', '#339900', 1),
(37, 'repairstatus', 0, 'รออะไหล่', '#FF3300', 1),
(68, 'room', 9, 'a:2:{s:2:\"th\";s:21:\"ทวิภาคี\";s:2:\"en\";s:21:\"ทวิภาคี\";}', NULL, 1),
(67, 'room', 4, 'a:2:{s:2:\"th\";s:1:\"4\";s:2:\"en\";s:1:\"4\";}', NULL, 1),
(66, 'room', 3, 'a:2:{s:2:\"th\";s:1:\"3\";s:2:\"en\";s:1:\"3\";}', NULL, 1),
(65, 'room', 2, 'a:2:{s:2:\"th\";s:1:\"2\";s:2:\"en\";s:1:\"2\";}', NULL, 1),
(64, 'room', 1, 'a:2:{s:2:\"th\";s:1:\"1\";s:2:\"en\";s:1:\"1\";}', NULL, 1),
(78, 'department', 2, 'a:2:{s:2:\"en\";s:36:\"ช่างกลโรงงาน\";s:2:\"th\";s:36:\"ช่างกลโรงงาน\";}', NULL, 1),
(77, 'department', 1, 'a:2:{s:2:\"en\";s:24:\"ช่างยนต์\";s:2:\"th\";s:24:\"ช่างยนต์\";}', NULL, 1),
(82, 'class', 4, 'a:2:{s:2:\"en\";s:7:\"Class 4\";s:2:\"th\";s:47:\"มัธยมศึกษาปีที่ 4\";}', NULL, 1),
(83, 'class', 5, 'a:2:{s:2:\"en\";s:7:\"Class 5\";s:2:\"th\";s:47:\"มัธยมศึกษาปีที่ 5\";}', NULL, 1),
(84, 'class', 6, 'a:2:{s:2:\"en\";s:7:\"Class 6\";s:2:\"th\";s:47:\"มัธยมศึกษาปีที่ 6\";}', NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `rp_course`
--

CREATE TABLE `rp_course` (
  `id` int(11) NOT NULL,
  `course_name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `course_code` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `teacher_id` int(11) NOT NULL,
  `class` int(11) NOT NULL,
  `period` int(11) NOT NULL,
  `credit` decimal(2,1) NOT NULL,
  `type` tinyint(1) NOT NULL,
  `year` int(4) NOT NULL,
  `term` tinyint(1) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `rp_course`
--

INSERT INTO `rp_course` (`id`, `course_name`, `course_code`, `teacher_id`, `class`, `period`, `credit`, `type`, `year`, `term`) VALUES
(34, 'วิทยาศาสตร์', 'ว21101', 0, 1, 0, '1.5', 1, 0, 0),
(35, 'สังคมศึกษา', 'ส21101', 0, 1, 0, '1.5', 1, 0, 0),
(36, 'ประวัติศาสตร์ 1', 'ส21103', 0, 1, 0, '0.5', 1, 0, 0),
(37, 'สุขศึกษา 1', 'พ21101', 0, 1, 0, '0.5', 1, 0, 0),
(39, 'ศิลปะ', 'ศ21101', 0, 1, 0, '1.0', 1, 0, 0),
(40, 'การงานอาชีพและเทคโนโลยี', 'ง21101', 0, 1, 0, '0.5', 1, 0, 0),
(42, 'การงานอาชีพและเทคโนโลยี', 'ง21102', 0, 1, 0, '0.5', 1, 0, 0),
(46, 'ภาษาอังกฤษ', 'อ21101', 0, 1, 0, '1.5', 1, 0, 0),
(48, 'ภาษาไทย', 'ท21101', 0, 1, 0, '1.5', 1, 0, 0),
(54, 'สุขศึกษา 1', 'พ21103', 0, 1, 0, '0.5', 1, 0, 0),
(57, 'คอมพิวเตอร์ 1', 'ง20247', 0, 1, 0, '1.0', 1, 0, 0),
(59, 'พิมพืดีดไทย', 'ง20201', 0, 1, 0, '0.5', 1, 0, 0),
(60, 'ฟัง - พูด', 'อ20201', 0, 1, 0, '0.5', 1, 0, 0),
(61, 'ภาษาจีน1', 'จ20201', 0, 1, 0, '0.5', 1, 0, 0),
(64, 'ภาษาไทย', 'ท21101', 0, 1, 0, '1.5', 1, 2556, 1),
(65, 'คณิตศาสตร์', 'ค21101', 0, 1, 0, '1.5', 1, 2556, 1),
(66, 'วิทยาศาสตร์', 'ว21101', 0, 1, 0, '1.5', 1, 2556, 1),
(67, 'สังคมศึกษา', 'ส21101', 0, 1, 0, '1.5', 1, 2556, 1),
(68, 'ประวัติศาสตร์ 1', 'ส21103', 0, 1, 0, '0.5', 1, 2556, 1),
(69, 'สุขศึกษา 1', 'พ21101', 0, 1, 0, '0.5', 1, 2556, 1),
(70, 'สุขศึกษา 1', 'พ21103', 0, 1, 0, '0.5', 1, 2556, 1),
(71, 'ศิลปะ', 'ศ21101', 0, 1, 0, '1.0', 1, 2556, 1),
(72, 'การงานอาชีพและเทคโนโลยี', 'ง21101', 0, 1, 0, '0.5', 1, 2556, 1),
(73, 'คอมพิวเตอร์ 1', 'ง20247', 0, 1, 0, '1.0', 1, 2556, 1),
(74, 'การงานอาชีพและเทคโนโลยี', 'ง21102', 0, 1, 0, '0.5', 1, 2556, 1),
(80, 'พิมพืดีดไทย', 'ง20201', 0, 1, 0, '0.5', 1, 2556, 1),
(76, 'ฟัง - พูด', 'อ20201', 0, 1, 0, '0.5', 1, 2556, 1),
(77, 'ภาษาจีน1', 'จ20201', 0, 1, 0, '0.5', 1, 2556, 1),
(81, 'คณิตศาสตร์', 'ค21101', 0, 1, 0, '1.5', 1, 0, 1),
(79, 'ภาษาอังกฤษ', 'อ21101', 0, 1, 0, '1.5', 1, 2556, 1);

-- --------------------------------------------------------

--
-- Table structure for table `rp_edocument`
--

CREATE TABLE `rp_edocument` (
  `id` int(11) UNSIGNED NOT NULL,
  `sender_id` int(11) UNSIGNED NOT NULL,
  `reciever` text COLLATE utf8_unicode_ci NOT NULL,
  `last_update` int(11) UNSIGNED NOT NULL,
  `document_no` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `detail` text COLLATE utf8_unicode_ci NOT NULL,
  `topic` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `ext` varchar(4) COLLATE utf8_unicode_ci NOT NULL,
  `size` double UNSIGNED NOT NULL,
  `file` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `ip` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `rp_edocument_download`
--

CREATE TABLE `rp_edocument_download` (
  `id` int(10) UNSIGNED NOT NULL,
  `document_id` int(10) UNSIGNED NOT NULL,
  `member_id` int(10) UNSIGNED NOT NULL,
  `downloads` int(10) UNSIGNED NOT NULL,
  `last_update` int(10) UNSIGNED NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `rp_grade`
--

CREATE TABLE `rp_grade` (
  `id` int(11) NOT NULL,
  `student_id` bigint(20) NOT NULL,
  `course_id` int(11) NOT NULL,
  `number` tinyint(3) NOT NULL,
  `room` int(11) NOT NULL,
  `grade` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `rp_personnel`
--

CREATE TABLE `rp_personnel` (
  `id` int(11) UNSIGNED NOT NULL,
  `position` int(11) UNSIGNED NOT NULL,
  `department` int(11) NOT NULL,
  `order` tinyint(3) UNSIGNED NOT NULL,
  `custom` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `id_card` varchar(13) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `rp_student`
--

CREATE TABLE `rp_student` (
  `id` int(11) NOT NULL,
  `student_id` varchar(13) COLLATE utf8_unicode_ci DEFAULT NULL,
  `address` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `parent` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `parent_phone` varchar(32) COLLATE utf8_unicode_ci DEFAULT NULL,
  `department` int(11) NOT NULL,
  `class` int(11) NOT NULL,
  `room` int(11) NOT NULL,
  `number` tinyint(3) NOT NULL,
  `id_card` varchar(13) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `rp_user`
--

CREATE TABLE `rp_user` (
  `id` int(11) NOT NULL,
  `username` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `birthday` date DEFAULT NULL,
  `phone` varchar(32) COLLATE utf8_unicode_ci DEFAULT NULL,
  `sex` varchar(1) COLLATE utf8_unicode_ci DEFAULT NULL,
  `picture` varchar(40) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `permission` text COLLATE utf8_unicode_ci NOT NULL,
  `visited` int(11) NOT NULL,
  `lastvisited` int(11) NOT NULL,
  `session_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ip` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `create_date` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `rp_user` (`id`, `username`, `password`, `status`, `permission`, `name`) VALUES
(1, 'admin@localhost', 'b620e8b83d7fcf7278148d21b088511917762014', 1, 'can_config,can_handle_all_edocument,can_upload_edocument', 'แอดมิน');
--
-- Indexes for dumped tables
--

--
-- Indexes for table `rp_category`
--
ALTER TABLE `rp_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rp_course`
--
ALTER TABLE `rp_course`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rp_edocument`
--
ALTER TABLE `rp_edocument`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rp_edocument_download`
--
ALTER TABLE `rp_edocument_download`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rp_grade`
--
ALTER TABLE `rp_grade`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rp_personnel`
--
ALTER TABLE `rp_personnel`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_card` (`id_card`);

--
-- Indexes for table `rp_student`
--
ALTER TABLE `rp_student`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_card` (`id_card`),
  ADD KEY `student_id` (`student_id`);

--
-- Indexes for table `rp_user`
--
ALTER TABLE `rp_user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `rp_category`
--
ALTER TABLE `rp_category`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `rp_course`
--
ALTER TABLE `rp_course`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `rp_edocument`
--
ALTER TABLE `rp_edocument`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `rp_edocument_download`
--
ALTER TABLE `rp_edocument_download`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `rp_grade`
--
ALTER TABLE `rp_grade`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `rp_user`
--
ALTER TABLE `rp_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;