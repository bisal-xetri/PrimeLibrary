-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 07, 2024 at 12:30 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `primelibrary`
--

-- --------------------------------------------------------

--
-- Table structure for table `book`
--

CREATE TABLE `book` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `author` varchar(255) NOT NULL,
  `publication` varchar(100) NOT NULL,
  `category` varchar(255) NOT NULL,
  `isbn` int(10) UNSIGNED NOT NULL,
  `copies` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `book`
--

INSERT INTO `book` (`id`, `title`, `image`, `author`, `publication`, `category`, `isbn`, `copies`) VALUES
(12, 'Database Management System', 'book678.jpg', 'indra chaudary', 'KEC', '9', 10090, 10),
(13, 'Operating System', 'book795.jpg', 'Bishal', 'KEC', '10', 19019, 12),
(14, 'Data Warehouse', 'book848.jpg', 'manoj', 'KEC', '9', 9096, 70),
(15, 'Principle Of Mangement', 'book938.jpg', 'Narendra', 'Asmita Publication', '9', 9090, 10);

-- --------------------------------------------------------

--
-- Table structure for table `issuebook`
--

CREATE TABLE `issuebook` (
  `id` int(11) NOT NULL,
  `userid` int(10) UNSIGNED NOT NULL,
  `book_id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `bookname` varchar(255) NOT NULL,
  `issuedate` datetime NOT NULL,
  `issuereturn` datetime NOT NULL,
  `fine` decimal(10,2) DEFAULT 0.00,
  `remaining_days` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `issuebook`
--

INSERT INTO `issuebook` (`id`, `userid`, `book_id`, `username`, `bookname`, `issuedate`, `issuereturn`, `fine`, `remaining_days`) VALUES
(10, 5, 15, 'Suni Bhandari', 'Principle Of Mangement', '2024-06-05 20:49:11', '2024-07-05 20:49:11', 0.00, 28),
(14, 5, 14, 'Suni Bhandari', 'Data Warehouse', '2024-06-06 12:08:01', '2024-07-06 12:08:01', 0.00, 28),
(15, 5, 13, 'Suni Bhandari', 'Operating System', '2024-06-06 12:08:02', '2024-07-06 12:08:02', 0.00, 28),
(17, 7, 12, 'Jubina Khatri', 'Database Management System', '2024-06-06 12:37:46', '2024-07-06 12:37:46', 0.00, 28),
(18, 7, 14, 'Jubina Khatri', 'Data Warehouse', '2024-06-06 12:37:47', '2024-07-06 12:37:47', 0.00, 28),
(22, 7, 13, 'Jubina Khatri', 'Operating System', '2024-06-07 15:59:35', '2024-07-07 15:59:35', 0.00, 29),
(23, 6, 14, 'Bishal Dhakal', 'Data Warehouse', '2024-06-07 16:03:46', '2024-07-07 16:03:46', 0.00, 29),
(24, 6, 13, 'Bishal Dhakal', 'Operating System', '2024-06-07 16:03:47', '2024-07-07 16:03:47', 0.00, 29),
(25, 6, 15, 'Bishal Dhakal', 'Principle Of Mangement', '2024-06-07 16:03:48', '2024-07-07 16:03:48', 0.00, 29);

-- --------------------------------------------------------

--
-- Table structure for table `requestbook`
--

CREATE TABLE `requestbook` (
  `id` int(10) UNSIGNED NOT NULL,
  `userid` int(10) UNSIGNED NOT NULL,
  `book_id` int(10) UNSIGNED NOT NULL,
  `username` varchar(255) NOT NULL,
  `phone` varchar(100) NOT NULL,
  `bookname` varchar(255) NOT NULL,
  `request_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `returnbook`
--

CREATE TABLE `returnbook` (
  `id` int(10) UNSIGNED NOT NULL,
  `studentname` varchar(255) NOT NULL,
  `bookname` varchar(255) NOT NULL,
  `returndate` datetime NOT NULL,
  `issuedate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `returnbook`
--

INSERT INTO `returnbook` (`id`, `studentname`, `bookname`, `returndate`, `issuedate`) VALUES
(5, 'Bishal Dhakal', 'Principle Of Mangement', '2024-06-07 15:44:46', '2024-06-07 15:32:38');

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `id` int(10) UNSIGNED NOT NULL,
  `fullname` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `image` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `faculty` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`id`, `fullname`, `username`, `image`, `email`, `phone`, `password`, `faculty`) VALUES
(5, 'Suni Bhandari', 'sunil', 'book239.jpg', 'demo@gmail.com', '2147483647', '3eaa7035e78e5eca849aa1e8ea4aaf97b4588601', 'BIM'),
(6, 'Bishal Dhakal', 'bishal', 'book319.jpg', 'bishaldkl56@gmail.com', '9810041459', '91fc2cf70b2db55c4ce32e7f9dc30d5032e10cc3', 'BIM'),
(7, 'Jubina Khatri', 'jkjkjkjkjk', '', 'jkkhatri013@gmail.com', '9861767718', '2463d786c22e288f8298f89ef9a8138e0e09275d', 'BIM');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_admin`
--

CREATE TABLE `tbl_admin` (
  `id` int(10) UNSIGNED NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_admin`
--

INSERT INTO `tbl_admin` (`id`, `full_name`, `username`, `password`) VALUES
(2, 'Bishal Dhakal', 'bishal', '91fc2cf70b2db55c4ce32e7f9dc30d5032e10cc3');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_category`
--

CREATE TABLE `tbl_category` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(100) NOT NULL,
  `image` varchar(255) NOT NULL,
  `feature` varchar(100) NOT NULL,
  `active` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_category`
--

INSERT INTO `tbl_category` (`id`, `title`, `image`, `feature`, `active`) VALUES
(9, 'BIM', 'Book_category_587.jpg', 'Yes', 'Yes'),
(10, 'BscCSIT', 'Book_category_644.jpg', 'Yes', 'Yes'),
(12, 'BBM', 'Book_category_265.png', 'Yes', 'Yes'),
(13, 'BBA', 'Book_category_775.png', 'Yes', 'Yes'),
(14, 'BBS', 'Book_category_947.png', 'Yes', 'Yes'),
(15, 'Others', 'Book_category_223.png', 'Yes', 'Yes');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `book`
--
ALTER TABLE `book`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `issuebook`
--
ALTER TABLE `issuebook`
  ADD PRIMARY KEY (`id`),
  ADD KEY `userid` (`userid`);

--
-- Indexes for table `requestbook`
--
ALTER TABLE `requestbook`
  ADD PRIMARY KEY (`id`),
  ADD KEY `userid` (`userid`),
  ADD KEY `book_id` (`book_id`);

--
-- Indexes for table `returnbook`
--
ALTER TABLE `returnbook`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_category`
--
ALTER TABLE `tbl_category`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `book`
--
ALTER TABLE `book`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `issuebook`
--
ALTER TABLE `issuebook`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `requestbook`
--
ALTER TABLE `requestbook`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `returnbook`
--
ALTER TABLE `returnbook`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `student`
--
ALTER TABLE `student`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_category`
--
ALTER TABLE `tbl_category`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `issuebook`
--
ALTER TABLE `issuebook`
  ADD CONSTRAINT `issuebook_ibfk_1` FOREIGN KEY (`userid`) REFERENCES `student` (`id`);

--
-- Constraints for table `requestbook`
--
ALTER TABLE `requestbook`
  ADD CONSTRAINT `requestbook_ibfk_1` FOREIGN KEY (`userid`) REFERENCES `student` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
