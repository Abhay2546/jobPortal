-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 15, 2022 at 07:02 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

--
-- Database: `jpms_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `job_id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `company` varchar(50) NOT NULL,
  `location` varchar(20) NOT NULL,
  `description` text NOT NULL,
  `responsibilities` text NOT NULL,
  `skills` text NOT NULL,
  `perks` text NOT NULL,
  `salary_min` int(11) NOT NULL,
  `salary_max` int(11) NOT NULL,
  `contact_email` varchar(255) NOT NULL,
  `duration` enum('Full time','Part time') NOT NULL,
  `expires` date NOT NULL,
  `created_by` int(11) NOT NULL,
  `deleted` enum('no','yes') NOT NULL,
  `date_created` datetime NOT NULL,
  `date_modified` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `jobs`
--

INSERT INTO `jobs` (`job_id`, `title`, `company`, `location`, `description`, `responsibilities`, `skills`, `perks`, `salary_min`, `salary_max`, `contact_email`, `duration`, `expires`, `created_by`, `deleted`, `date_created`, `date_modified`) VALUES
(1, 'Job 101', 'Our Company Corp', 'Washington', 'Sample Job Order Only', '<ul class=\'bullets\'><li>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean nisl nisi, aliquam at scelerisque id, aliquam auctor lacus. Fusce hendrerit ligula non ex bibendum ultricies condimentum vel metus. Proin sit amet fringilla sem, ut accumsan dolor.</li></ul>', '<ul class=\'bullets\'><li>Maecenas ut vehicula elit, quis vulputate orci. Pellentesque et rutrum erat. Curabitur vel orci fringilla, vestibulum dui non, maximus ante. Suspendisse dapibus ex a dolor tempor sodales</li></ul>', '<ul class=\'bullets\'><li>Aenean tempor, dui at vulputate viverra, quam leo varius lacus, eleifend aliquam eros augue nec lacus. Sed venenatis luctus quam.</li></ul>', 35000, 45000, 'info@ourcompanycorp.com', 'Full time', '2022-06-30', 1, 'no', '2022-06-15 07:18:24', '2022-06-15 08:23:08'),
(2, 'Job 2', 'Company 2', 'Detroit', 'Mauris non mauris est. Curabitur consequat ante sed egestas blandit. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas.', '<ul class=\'bullets\'><li>Morbi in consequat quam. Proin vel neque hendrerit, ultricies diam id, blandit enim. Pellentesque dapibus id nibh in suscipit. Vivamus faucibus sit amet sapien eget vulputate. Integer non est auctor, consequat leo eget, facilisis lectus. Quisque aliquam augue eu odio scelerisque, eget tincidunt elit pulvinar.</li></ul>', '<ul class=\'bullets\'><li>uspendisse eget est quis libero dapibus egestas quis quis sapien. Donec fermentum nulla velit, a tempus mi posuere ac.</li></ul>', '<ul class=\'bullets\'><li>In hac habitasse platea dictumst. Nam tristique vehicula nulla, eu placerat massa dictum a. Sed fermentum accumsan magna quis pretium.</li></ul>', 48000, 55000, 'hr@company2.com', 'Full time', '2022-07-16', 1, 'no', '2022-06-15 08:58:18', '0000-00-00 00:00:00'),
(3, 'Job 103', 'Company 3', 'Detroit', 'Quisque quam orci, condimentum quis blandit a, ultricies nec arcu. Nulla eu lacus nunc. Donec tempor viverra sem at eleifend. Curabitur maximus dolor vitae nisl semper.', '<ul class=\'bullets\'><li>Mauris scelerisque lorem quis eros consectetur vestibulum. Morbi vel nisi a tellus luctus semper vitae non quam. Nullam convallis lorem a est faucibus rhoncus.</li></ul>', '<ul class=\'bullets\'><li>Praesent sed magna sed nibh gravida lacinia. Praesent varius, est ut eleifend mattis, velit odio volutpat enim, non pretium metus magna nec erat.</li></ul>', '<ul class=\'bullets\'><li>Donec porta a nulla vel finibus. Integer nec urna non metus volutpat cursus id in diam.</li></ul>', 35000, 50000, 'hr@company3.com', 'Full time', '2022-08-18', 2, 'no', '2022-06-15 10:29:27', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `email` varchar(45) CHARACTER SET latin1 COLLATE latin1_general_cs NOT NULL,
  `password` varchar(64) NOT NULL,
  `name` varchar(50) NOT NULL,
  `date_created` datetime NOT NULL,
  `date_modified` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `email`, `password`, `name`, `date_created`, `date_modified`) VALUES
(1, 'mcooper@mail.com', '044f414bd17887bf6e3f45a414d71002', 'Mark Cooper', '2022-06-15 07:16:08', '0000-00-00 00:00:00'),
(2, 'sam23@gmail.com', '114c56cdbc052d1e89cad1c108f21599', 'Samantha', '2022-06-15 10:27:42', '0000-00-00 00:00:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`job_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `job_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;
