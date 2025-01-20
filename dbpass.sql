-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 19, 2025 at 11:23 AM
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
-- Database: `dbpass`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `admin_id` int(11) NOT NULL,
  `admin_username` varchar(250) NOT NULL,
  `admin_pass` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`admin_id`, `admin_username`, `admin_pass`) VALUES
(7, 'RiteshThakare', 'RiteshPassMate@2024'),
(8, 'YashBanait', 'YashPassMate@202418'),
(9, 'MainAdminPassMate@2024', 'MainAdmin@2024');

-- --------------------------------------------------------

--
-- Table structure for table `bus_forms`
--

CREATE TABLE `bus_forms` (
  `bus_form_id` int(11) NOT NULL,
  `full_name` varchar(250) NOT NULL,
  `phone` int(20) NOT NULL,
  `email` varchar(250) NOT NULL,
  `dob` date NOT NULL,
  `age` int(11) NOT NULL,
  `cast` varchar(250) NOT NULL,
  `address` text NOT NULL,
  `sem` varchar(200) NOT NULL,
  `department` varchar(250) NOT NULL,
  `gender` varchar(250) NOT NULL,
  `departure` varchar(250) NOT NULL,
  `destination` varchar(250) NOT NULL,
  `months` int(11) NOT NULL,
  `profile_pic` text NOT NULL,
  `adhar_card` text NOT NULL,
  `fees_receipt` text NOT NULL,
  `i_card` text NOT NULL,
  `rationcard` text NOT NULL,
  `signature` text NOT NULL,
  `form_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `status` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bus_forms`
--

INSERT INTO `bus_forms` (`bus_form_id`, `full_name`, `phone`, `email`, `dob`, `age`, `cast`, `address`, `sem`, `department`, `gender`, `departure`, `destination`, `months`, `profile_pic`, `adhar_card`, `fees_receipt`, `i_card`, `rationcard`, `signature`, `form_date`, `status`) VALUES
(13, 'Ritesh Thakare', 2147483647, 'riteshthakare315@gmail.com', '2022-02-01', 2, 'OBC', 'Surat , Gujrat', '3', 'Mechanical', 'M', 'Valsad', 'Surat', 3, 'DALL·E 2025-01-16 17.31.58 - A default profile picture image for a website providing student passes for efficient travel to and from college. The image should be a simple and mode.webp', 'delete_accounts.jpg', 'delete_procss.png', 'vk.jpg', 'WhatsApp Image 2025-01-13 at 20.25.06_12e2785e.jpg', 'WhatsApp Image 2025-01-09 at 20.01.16_8822bbe2.jpg', '2025-01-17 15:45:23', 'pending');

-- --------------------------------------------------------

--
-- Table structure for table `complets_train_forms`
--

CREATE TABLE `complets_train_forms` (
  `complete_train_form_id` int(11) NOT NULL,
  `train_form_id` int(11) NOT NULL,
  `bus_form_id` int(11) NOT NULL,
  `full_name` varchar(250) NOT NULL,
  `phone` int(11) NOT NULL,
  `email` varchar(250) NOT NULL,
  `dob` date NOT NULL,
  `age` int(11) NOT NULL,
  `cast` varchar(250) NOT NULL,
  `address` text NOT NULL,
  `sem` varchar(200) NOT NULL,
  `department` varchar(250) NOT NULL,
  `gender` varchar(250) NOT NULL,
  `departure` varchar(250) NOT NULL,
  `destination` varchar(250) NOT NULL,
  `months` int(11) NOT NULL,
  `profile_pic` text NOT NULL,
  `adhar_card` text NOT NULL,
  `fees_receipt` text NOT NULL,
  `i_card` text NOT NULL,
  `ration_card` text NOT NULL,
  `signature` text NOT NULL,
  `form_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `status` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `complets_train_forms`
--

INSERT INTO `complets_train_forms` (`complete_train_form_id`, `train_form_id`, `bus_form_id`, `full_name`, `phone`, `email`, `dob`, `age`, `cast`, `address`, `sem`, `department`, `gender`, `departure`, `destination`, `months`, `profile_pic`, `adhar_card`, `fees_receipt`, `i_card`, `ration_card`, `signature`, `form_date`, `status`) VALUES
(23, 22, 0, 'Rohit Sharma', 2147483647, 'riteshthakare315@gmail.com', '2002-02-05', 22, 'OPEN', 'C-505 ,SMC AWAS SUNANDHAM SOCIETY, NAVAGAAM-DINDOLI ROAD, UDHNA, SURAT', '6', 'I.T', 'M', 'Valsad', 'Surat', 3, '30 DAYS.png', 'adhar.jpg', 'fess.jpg', 'college-id-card.jpg', '', 'signature.jpg', '2024-12-11 03:48:05', 'Expired'),
(24, 0, 10, 'Shaksi Mehta', 2147483647, 'riteshthakare315@gmail.com', '1999-03-03', 25, 'SC/ST', 'Verda Nagare , Chennai', '', 'Mechanical Eng.', 'F', 'Surat', 'Bharuch', 3, 'GOAT...jpeg', 'adhar.jpg', 'fess.jpg', 'college-id-card.jpg', '', 'signature.jpg', '2025-01-10 03:49:21', 'Expired'),
(25, 0, 11, 'Round Men', 2147483647, 'riteshthakare315@gmail.com', '2015-02-03', 9, 'OBC', 'Verd Road , Surat', '6', 'Mechanical', 'F required>                    </div>                    <div class=', 'Surat', 'Valsad', 6, '30 DAYS.png', 'adhar.jpg', 'fess.jpg', 'college-id-card.jpg', '', 'hardik_sign.png', '2025-01-10 03:49:21', 'Expired'),
(26, 28, 0, 'Ritesh Thakare', 2147483647, 'riteshthakare315@gmail.com', '2019-06-04', 5, 'sc/st', 'Surat , Gujrat', '6', 'Chemical', 'M', 'Chemical', 'Surat', 3, 'Screenshot_2023-01-25-15-20-19-264_com.miui.gallery.jpg', 'OneGrowth (1).png', 'fess.jpg', 'ration_card.avif', '', 'signature.jpg', '2025-01-14 13:40:42', 'Expired'),
(27, 29, 0, 'Kailasbhai Bapubhai Thakare', 2147483647, 'riteshthakare315@gmail.com', '2023-10-25', 1, 'open', 'C-505 ,SMC AWAS SUNANDHAM SOCIETY, NAVAGAAM-DINDOLI ROAD, UDHNA, SURAT', '2', 'Mechanical', 'M', 'Valsad', 'Surat', 6, 'WhatsApp Image 2025-01-09 at 20.01.16_8822bbe2 (1).jpg', '30 DAYS.png', 'college-id-card.jpg', 'land_image.webp', '', 'hardik_sign.png', '2025-01-18 13:21:05', 'Expired'),
(28, 30, 0, 'Kailasbhai Bapubhai Thakare', 2147483647, 'riteshthakare315@gmail.com', '2023-01-31', 1, 'OPEN', 'C-505 ,SMC AWAS SUNANDHAM SOCIETY, NAVAGAAM-DINDOLI ROAD, UDHNA, SURAT', '1', 'Civil', 'M', 'Valsad', 'Surat', 3, 'DALL·E 2025-01-16 17.31.58 - A default profile picture image for a website providing student passes for efficient travel to and from college. The image should be a simple and mode.webp', 'P.png', 'fess.jpg', 'adhar.jpg', '', 'signature.jpg', '2025-01-18 13:21:05', 'Expired'),
(29, 31, 0, 'Vamika Gabbi', 2147483647, 'riteshthakare315@gmail.com', '2002-02-27', 22, 'open', 'C-505 ,SMC AWAS SUNANDHAM SOCIETY, NAVAGAAM-DINDOLI ROAD, UDHNA, SURAT', '4', 'Mechanical', 'F', 'Mumbai', 'Surat', 3, 'a5b18a37db574e45ce7db02c31861b70.jpg', 'Himachal_Pradesh_ration_card_model.jpg', 'fess.jpg', 'delete_accounts.jpg', '', 'hardik_sign.png', '2025-01-19 06:57:58', 'Expired'),
(30, 32, 0, 'Hardik Pandya', 2147483647, 'riteshthakare315@gmail.com', '2021-02-02', 3, 'open', 'Surat , Gujrat', '4', 'Mechanical', 'M', 'Valsad', 'Surat', 3, 'user_img.jpg', 'adhar.jpg', 'fess.jpg', 'Himachal_Pradesh_ration_card_model.jpg', '', 'hardik_sign.png', '2025-01-19 06:57:58', 'Expired'),
(31, 0, 12, 'Hardik Pandya', 2147483647, 'riteshthakare315@gmail.com', '2016-02-02', 8, 'sc/st', 'Surat , Gujrat', '3', 'Plastic', 'M', 'Valsad', 'Surat', 3, 'a5b18a37db574e45ce7db02c31861b70.jpg', 'user_img.jpg', 'fess.jpg', 'college-id-card.jpg', '', 'P.png', '2025-01-19 07:02:28', 'Expired'),
(32, 40, 0, 'Manisha Thakare', 2147483647, 'riteshthakare315@gmail.com', '1986-06-05', 38, 'OPEN', 'Surat , Gujrat', '4', 'I.T', 'F', 'Surat', 'Jalgoan', 3, 'user_img.jpg', 'adhar.jpg', 'fess.jpg', 'college-id-card.jpg', '', 'signature.jpg', '2025-01-17 18:40:46', 'success'),
(33, 41, 0, 'Manisha Thakare', 2147483647, 'riteshthakare315@gmail.com', '1986-06-05', 38, 'OPEN', 'Surat , Gujrat', '4', 'I.T', 'M', 'Surat', 'Jalgoan', 3, 'user_img.jpg', 'adhar.jpg', 'fess.jpg', 'college-id-card.jpg', '', 'hardik_sign.png', '2025-01-17 18:40:47', 'success'),
(34, 33, 0, 'Ritesh Thakare', 2147483647, 'riteshthakare315@gmail.com', '2019-01-29', 5, 'OPEN', 'Surat , Gujrat', '1', 'Mechanical', 'M', 'Mumbai', 'Surat', 1, 'WhatsApp Image 2025-01-09 at 20.01.16_8822bbe2 (1).jpg', 'OneGrowth (1).png', 'fess.jpg', 'college-id-card.jpg', '', 'signature.jpg', '2025-01-19 10:01:46', 'success');

-- --------------------------------------------------------

--
-- Table structure for table `contacts_forms`
--

CREATE TABLE `contacts_forms` (
  `contacts_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `email` varchar(250) NOT NULL,
  `msg` text NOT NULL,
  `reply` text NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `contacts_forms`
--

INSERT INTO `contacts_forms` (`contacts_id`, `user_id`, `email`, `msg`, `reply`, `date`) VALUES
(9, 5, 'riteshthakare315@gmail.com', 'Hii , Sir i have error in my profile like do not change full name... please solve them', 'we are solve your problem soon then will inform you', '2025-01-16 14:18:17'),
(25, 5, 'riteshthakare315@gmail.com', 'gay', 'great', '2025-01-16 15:13:53'),
(26, 5, 'riteshthakare315@gmail.com', 'hi\r\n', 'i love you', '2025-01-16 15:27:03'),
(27, 5, 'riteshthakare315@gmail.com', 'love ', 'vamika', '2025-01-16 15:28:20'),
(28, 5, 'riteshthakare315@gmail.com', 'i have error in this platform', 'please mention clear problem', '2025-01-16 15:29:07'),
(29, 5, 'riteshthakare315@gmail.com', 'hii\r\n', 'greate people we mett', '2025-01-16 15:35:05'),
(30, 5, 'riteshthakare315@gmail.com', 'hhii\r\n', 'ha boll na bhai', '2025-01-16 15:35:32'),
(31, 5, 'riteshthakare315@gmail.com', 'ha bolna bhai tu', 'kuch nahui bhai chalegha ', '2025-01-16 15:35:53'),
(32, 5, 'riteshthakare315@gmail.com', 'hiii', 'i love 2', '2025-01-17 04:23:08'),
(33, 5, 'riteshthakare315@gmail.com', 'hii', 'hii bro i loveyou', '2025-01-19 07:39:35'),
(34, 5, 'riteshthakare315@gmail.com', 'hi\r\n', 'we are solve your problem soon then will inform you', '2025-01-19 10:00:53');

-- --------------------------------------------------------

--
-- Table structure for table `delete_procceses`
--

CREATE TABLE `delete_procceses` (
  `delete_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `email` varchar(250) NOT NULL,
  `phone` varchar(250) NOT NULL,
  `reason` text NOT NULL,
  `status` varchar(250) NOT NULL DEFAULT 'process',
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `delete_procceses`
--

INSERT INTO `delete_procceses` (`delete_id`, `user_id`, `email`, `phone`, `reason`, `status`, `date`) VALUES
(14, 5, 'riteshthakare315@gmail.com', '2147483647', 'college completed', 'delete', '2025-01-17 04:28:50');

-- --------------------------------------------------------

--
-- Table structure for table `notification`
--

CREATE TABLE `notification` (
  `notifi_id` int(11) NOT NULL,
  `user` varchar(250) NOT NULL,
  `message` text NOT NULL,
  `sender` varchar(250) NOT NULL,
  `remark` text NOT NULL,
  `form_id` int(11) NOT NULL,
  `forms` varchar(250) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp(),
  `is_read` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `notification`
--

INSERT INTO `notification` (`notifi_id`, `user`, `message`, `sender`, `remark`, `form_id`, `forms`, `date`, `is_read`) VALUES
(56, 'riteshthakare315@gmail.com', 'hii bro i loveyou', 'ByPAdmin', '', 0, '', '2025-01-19 07:39:35', 1),
(57, 'riteshthakare315@gmail.com', 'we are solve your problem soon then will inform you', 'ByPAdmin', '', 0, '', '2025-01-19 10:00:53', 1);

-- --------------------------------------------------------

--
-- Table structure for table `train_forms`
--

CREATE TABLE `train_forms` (
  `train_form_id` int(11) NOT NULL,
  `full_name` varchar(250) NOT NULL,
  `phone` int(11) NOT NULL,
  `email` varchar(250) NOT NULL,
  `dob` date NOT NULL,
  `age` int(11) NOT NULL,
  `cast` varchar(250) NOT NULL,
  `address` text NOT NULL,
  `sem` varchar(200) NOT NULL,
  `department` varchar(250) NOT NULL,
  `gender` varchar(250) NOT NULL,
  `departure` varchar(250) NOT NULL,
  `destination` varchar(250) NOT NULL,
  `months` int(11) NOT NULL,
  `profile_pic` text NOT NULL,
  `adhar_card` text NOT NULL,
  `fees_receipt` text NOT NULL,
  `i_card` text NOT NULL,
  `signature` text NOT NULL,
  `form_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `status` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `train_forms`
--

INSERT INTO `train_forms` (`train_form_id`, `full_name`, `phone`, `email`, `dob`, `age`, `cast`, `address`, `sem`, `department`, `gender`, `departure`, `destination`, `months`, `profile_pic`, `adhar_card`, `fees_receipt`, `i_card`, `signature`, `form_date`, `status`) VALUES
(34, 'Rohit Shrama', 2147483647, 'rohit45@gmail.com', '1987-04-15', 37, 'OPEN', 'Borivali , Mumbai', '7', 'Chemical', 'M', 'Mumbai', 'Surat', 6, 'a5b18a37db574e45ce7db02c31861b70.jpg', 'images.jpeg', 'WhatsApp Image 2025-01-13 at 20.25.06_12e2785e.jpg', '432a737b9915a452f7e91fcc1d5edd2f.jpg', 'signature.jpg', '2025-01-17 07:17:08', 'pending'),
(39, 'Bhumi Patel', 2147483647, 'riteshthakare315@gmail.com', '2002-02-15', 22, 'OPEN', 'Surat , Gujrat', '8', 'I.T', 'F', 'Surat', 'Billimora', 3, 'user_img.jpg', 'college-id-card.jpg', 'fess.jpg', 'adhar.jpg', 'hardik_sign.png', '2025-01-17 15:18:55', 'pending');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `email` varchar(250) NOT NULL,
  `phone` varchar(250) NOT NULL,
  `password` varchar(300) NOT NULL,
  `user_pic` text NOT NULL,
  `name` varchar(250) NOT NULL,
  `gender` varchar(200) NOT NULL,
  `birthdate` varchar(250) NOT NULL,
  `age` varchar(250) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `email`, `phone`, `password`, `user_pic`, `name`, `gender`, `birthdate`, `age`, `date`) VALUES
(5, 'riteshthakare315@gmail.com', '2147483647', 'Ritesh12345#', '', 'hardik ', 'M', '2024-06-12', '20', '2015-01-09 11:56:22'),
(6, 'rohit45@gmail.com', '9327500387', '454545', '', 'Rohit Sharma', 'M', '1987-04-24', '', '2015-01-09 11:56:22'),
(12, 'hardik@gmail.com', '2147483647', 'Hardik#@33', '', 'Hardik Pandya', 'F', '', '', '2015-01-22 12:13:34'),
(13, 'viratkohli18@gmail.com', '11856235891', 'Virat@018', '', '', '', '', '', '2025-01-16 11:56:22'),
(15, 'garenapersonal2031@gmail.com', '9327500387', 'Garena', '', '', '', '', '', '2025-01-17 08:09:21');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `bus_forms`
--
ALTER TABLE `bus_forms`
  ADD PRIMARY KEY (`bus_form_id`);

--
-- Indexes for table `complets_train_forms`
--
ALTER TABLE `complets_train_forms`
  ADD PRIMARY KEY (`complete_train_form_id`);

--
-- Indexes for table `contacts_forms`
--
ALTER TABLE `contacts_forms`
  ADD PRIMARY KEY (`contacts_id`);

--
-- Indexes for table `delete_procceses`
--
ALTER TABLE `delete_procceses`
  ADD PRIMARY KEY (`delete_id`);

--
-- Indexes for table `notification`
--
ALTER TABLE `notification`
  ADD PRIMARY KEY (`notifi_id`);

--
-- Indexes for table `train_forms`
--
ALTER TABLE `train_forms`
  ADD PRIMARY KEY (`train_form_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `bus_forms`
--
ALTER TABLE `bus_forms`
  MODIFY `bus_form_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `complets_train_forms`
--
ALTER TABLE `complets_train_forms`
  MODIFY `complete_train_form_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `contacts_forms`
--
ALTER TABLE `contacts_forms`
  MODIFY `contacts_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `delete_procceses`
--
ALTER TABLE `delete_procceses`
  MODIFY `delete_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `notification`
--
ALTER TABLE `notification`
  MODIFY `notifi_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT for table `train_forms`
--
ALTER TABLE `train_forms`
  MODIFY `train_form_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
