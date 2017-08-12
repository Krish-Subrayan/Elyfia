-- phpMyAdmin SQL Dump
-- version 4.4.10
-- http://www.phpmyadmin.net
--
-- Host: localhost:3306
-- Generation Time: Aug 10, 2017 at 08:27 AM
-- Server version: 5.5.42
-- PHP Version: 7.0.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `elyfia`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_users`
--

CREATE TABLE `admin_users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `status` enum('Active','Inactive') NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `level` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin_users`
--

INSERT INTO `admin_users` (`id`, `name`, `email`, `password`, `status`, `created`, `level`) VALUES
(4, 'Raj', 'rajvinothananthan@gmail.com', 'e8037ee0926f88d92544974bc2643fc7', 'Active', '2017-08-10 05:49:35', 1),
(5, 'Ilan', 'ilanlieberman@mac.com', 'e8037ee0926f88d92544974bc2643fc7', 'Active', '2017-08-10 06:12:11', 1),
(7, 'Ilam', 'ilam@thecoding.company', 'e8037ee0926f88d92544974bc2643fc7', 'Active', '2017-08-10 05:49:25', 1),
(21, 'Anand', 'anand@grinfotech.com', 'e8037ee0926f88d92544974bc2643fc7', 'Active', '2017-08-10 06:13:52', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_users`
--
ALTER TABLE `admin_users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_users`
--
ALTER TABLE `admin_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=22;