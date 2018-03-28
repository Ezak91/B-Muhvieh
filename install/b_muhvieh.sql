-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 28, 2018 at 01:46 PM
-- Server version: 5.7.21-0ubuntu0.16.04.1
-- PHP Version: 7.0.28-0ubuntu0.16.04.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `b_muhvieh`
--
CREATE DATABASE IF NOT EXISTS `b_muhvieh` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `b_muhvieh`;

-- --------------------------------------------------------

--
-- Table structure for table `actor`
--

CREATE TABLE `actor` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `profile_path` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `cast`
--

CREATE TABLE `cast` (
  `movie_id` int(11) NOT NULL,
  `actor_id` int(11) NOT NULL,
  `character` varchar(255) NOT NULL,
  `cast_order` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `crew`
--

CREATE TABLE `crew` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `profile_path` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `genre`
--

CREATE TABLE `genre` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `job`
--

CREATE TABLE `job` (
  `movie_id` int(11) NOT NULL,
  `crew_id` int(11) NOT NULL,
  `job` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `movie`
--

CREATE TABLE `movie` (
  `tmdb_id` int(11) NOT NULL,
  `imdb_id` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `original_title` varchar(255) NOT NULL,
  `release_date` date NOT NULL,
  `overview` text NOT NULL,
  `poster_path` varchar(255) NOT NULL,
  `original_language` varchar(2) NOT NULL,
  `backdrop_path` varchar(255) NOT NULL,
  `budget` int(11) NOT NULL,
  `revenue` int(11) NOT NULL,
  `runtime` int(11) NOT NULL,
  `vote_average` decimal(10,0) NOT NULL,
  `vote_count` int(11) NOT NULL,
  `trailer_id` varchar(255) NOT NULL,
  `adult` bit(1) NOT NULL,
  `homepage` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `movie_genre`
--

CREATE TABLE `movie_genre` (
  `tmdb_id` int(11) NOT NULL,
  `genre_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `recover`
--

CREATE TABLE `recover` (
  `user_id` int(11) NOT NULL,
  `token` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `username` varchar(50) NOT NULL,
  `registration_date` date NOT NULL,
  `active` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `user_movie`
--

CREATE TABLE `user_movie` (
  `user_id` int(11) NOT NULL,
  `tmdb_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `verified`
--

CREATE TABLE `verified` (
  `userID` int(11) NOT NULL,
  `token` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `watch`
--

CREATE TABLE `watch` (
  `user_id` int(11) NOT NULL,
  `tmdb_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `actor`
--
ALTER TABLE `actor`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cast`
--
ALTER TABLE `cast`
  ADD PRIMARY KEY (`movie_id`,`actor_id`),
  ADD KEY `cast_actor` (`actor_id`);

--
-- Indexes for table `crew`
--
ALTER TABLE `crew`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `genre`
--
ALTER TABLE `genre`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `job`
--
ALTER TABLE `job`
  ADD PRIMARY KEY (`movie_id`,`crew_id`),
  ADD KEY `job_crew` (`crew_id`);

--
-- Indexes for table `movie`
--
ALTER TABLE `movie`
  ADD PRIMARY KEY (`tmdb_id`),
  ADD UNIQUE KEY `UNIQUE` (`imdb_id`);

--
-- Indexes for table `movie_genre`
--
ALTER TABLE `movie_genre`
  ADD PRIMARY KEY (`tmdb_id`,`genre_id`),
  ADD KEY `movie_genre_genreid` (`genre_id`);

--
-- Indexes for table `recover`
--
ALTER TABLE `recover`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `user_movie`
--
ALTER TABLE `user_movie`
  ADD PRIMARY KEY (`user_id`,`tmdb_id`),
  ADD KEY `user_movie_movie` (`tmdb_id`);

--
-- Indexes for table `verified`
--
ALTER TABLE `verified`
  ADD PRIMARY KEY (`userID`),
  ADD UNIQUE KEY `UNIQUE` (`token`);

--
-- Indexes for table `watch`
--
ALTER TABLE `watch`
  ADD PRIMARY KEY (`user_id`,`tmdb_id`),
  ADD KEY `watch_movie` (`tmdb_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `cast`
--
ALTER TABLE `cast`
  ADD CONSTRAINT `cast_actor` FOREIGN KEY (`actor_id`) REFERENCES `actor` (`id`),
  ADD CONSTRAINT `cast_movie` FOREIGN KEY (`movie_id`) REFERENCES `movie` (`tmdb_id`);

--
-- Constraints for table `job`
--
ALTER TABLE `job`
  ADD CONSTRAINT `job_crew` FOREIGN KEY (`crew_id`) REFERENCES `crew` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `job_movie` FOREIGN KEY (`movie_id`) REFERENCES `movie` (`tmdb_id`) ON DELETE CASCADE;

--
-- Constraints for table `movie_genre`
--
ALTER TABLE `movie_genre`
  ADD CONSTRAINT `movie_genre_genreid` FOREIGN KEY (`genre_id`) REFERENCES `genre` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `movie_genre_movieid` FOREIGN KEY (`tmdb_id`) REFERENCES `movie` (`tmdb_id`) ON DELETE CASCADE;

--
-- Constraints for table `recover`
--
ALTER TABLE `recover`
  ADD CONSTRAINT `recover_user` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

--
-- Constraints for table `user_movie`
--
ALTER TABLE `user_movie`
  ADD CONSTRAINT `user_movie_movie` FOREIGN KEY (`tmdb_id`) REFERENCES `movie` (`tmdb_id`),
  ADD CONSTRAINT `user_movie_user` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

--
-- Constraints for table `verified`
--
ALTER TABLE `verified`
  ADD CONSTRAINT `fk_userID_id` FOREIGN KEY (`userID`) REFERENCES `user` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `watch`
--
ALTER TABLE `watch`
  ADD CONSTRAINT `watch_movie` FOREIGN KEY (`tmdb_id`) REFERENCES `movie` (`tmdb_id`),
  ADD CONSTRAINT `watch_user` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
