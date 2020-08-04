-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 04, 2020 at 08:49 PM
-- Server version: 10.4.13-MariaDB
-- PHP Version: 7.4.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cricket`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_matches`
--

CREATE TABLE `tbl_matches` (
  `id` bigint(20) NOT NULL,
  `team_one_id` bigint(20) NOT NULL,
  `team_two_id` bigint(20) NOT NULL,
  `match_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_matches`
--

INSERT INTO `tbl_matches` (`id`, `team_one_id`, `team_two_id`, `match_date`, `status`, `created_at`, `updated_at`) VALUES
(1, 2, 4, '2020-08-03 05:15:00', 1, '2020-08-02 10:51:58', '2020-08-02 10:51:58'),
(2, 2, 4, '2020-08-10 05:15:00', 1, '2020-08-02 11:04:05', '2020-08-02 11:04:05'),
(3, 2, 3, '2020-08-03 05:15:00', 1, '2020-08-02 11:31:23', '2020-08-02 11:31:23'),
(4, 1, 2, '2020-08-03 05:15:00', 1, '2020-08-02 11:56:33', '2020-08-02 11:56:33');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_player`
--

CREATE TABLE `tbl_player` (
  `id` bigint(20) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `profile_pic` varchar(255) NOT NULL,
  `team_id` int(11) NOT NULL,
  `jersey_number` int(11) NOT NULL,
  `country` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_player`
--

INSERT INTO `tbl_player` (`id`, `firstname`, `lastname`, `profile_pic`, `team_id`, `jersey_number`, `country`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Amit', 'Rawat', '1596354024.png', 1, 10, 'India', 1, '2020-08-02 02:10:24', '2020-08-02 02:10:24'),
(2, 'Mahendar Singh', 'Dhoni', '1596355972.jpg', 4, 7, 'India', 1, '2020-08-02 02:42:52', '2020-08-02 02:42:52'),
(3, 'Virat', 'Kohli', '1596355997.jpg', 3, 99, 'India', 1, '2020-08-02 02:43:17', '2020-08-02 02:43:17'),
(4, 'Gautam', 'Gambhir', '1596356036.jpg', 2, 8, 'India', 1, '2020-08-02 02:43:56', '2020-08-02 02:43:56');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_player_stats`
--

CREATE TABLE `tbl_player_stats` (
  `id` bigint(20) NOT NULL,
  `matches` int(11) NOT NULL,
  `runs` int(11) NOT NULL,
  `highest_score` int(11) NOT NULL,
  `fifties` int(11) DEFAULT NULL,
  `hundreds` int(11) DEFAULT NULL,
  `player_id` bigint(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_player_stats`
--

INSERT INTO `tbl_player_stats` (`id`, `matches`, `runs`, `highest_score`, `fifties`, `hundreds`, `player_id`, `created_at`, `updated_at`) VALUES
(1, 2, 150, 100, 1, 1, 1, '2020-08-02 02:37:31', '2020-08-02 02:37:31'),
(3, 2000, 200, 200, 18, 19, 3, '2020-08-02 12:16:04', '2020-08-02 12:16:04'),
(4, 2, 90, 80, 1, NULL, 4, '2020-08-02 12:17:59', '2020-08-02 12:17:59'),
(5, 15, 1000, 20, 1, 5, 2, '2020-08-02 12:43:19', '2020-08-02 12:44:46');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_points`
--

CREATE TABLE `tbl_points` (
  `id` bigint(20) NOT NULL,
  `team_id` bigint(20) NOT NULL,
  `points` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_points`
--

INSERT INTO `tbl_points` (`id`, `team_id`, `points`, `created_at`, `updated_at`) VALUES
(1, 2, 15, '2020-08-02 13:16:57', '2020-08-02 13:17:13'),
(2, 1, 21, '2020-08-02 13:20:04', '2020-08-02 13:20:15');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_teams`
--

CREATE TABLE `tbl_teams` (
  `id` bigint(20) NOT NULL,
  `team_name` varchar(255) NOT NULL,
  `team_logo` varchar(255) NOT NULL,
  `state` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_teams`
--

INSERT INTO `tbl_teams` (`id`, `team_name`, `team_logo`, `state`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Mumbai Indians', '1596351094.png', 'Maharashtra', 1, '2020-08-02 01:21:34', '2020-08-02 01:21:34'),
(2, 'Delhi Daredevils', '1596355832.png', 'Delhi', 1, '2020-08-02 02:40:33', '2020-08-02 02:40:33'),
(3, 'Royal Challengers Banglore', '1596355899.jpg', 'Karnataka', 1, '2020-08-02 02:41:39', '2020-08-02 02:41:39'),
(4, 'Chennai Superkings', '1596355933.jpg', 'Tamil Nadu', 1, '2020-08-02 02:42:13', '2020-08-02 02:42:13');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_matches`
--
ALTER TABLE `tbl_matches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_player`
--
ALTER TABLE `tbl_player`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_player_stats`
--
ALTER TABLE `tbl_player_stats`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_points`
--
ALTER TABLE `tbl_points`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_teams`
--
ALTER TABLE `tbl_teams`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_matches`
--
ALTER TABLE `tbl_matches`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_player`
--
ALTER TABLE `tbl_player`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_player_stats`
--
ALTER TABLE `tbl_player_stats`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tbl_points`
--
ALTER TABLE `tbl_points`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_teams`
--
ALTER TABLE `tbl_teams`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
