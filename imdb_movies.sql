-- phpMyAdmin SQL Dump
-- version 5.3.0-dev+20220530.a2456aa9a3
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: May 31, 2022 at 06:36 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `imdb_movies`
--

-- --------------------------------------------------------

--
-- Table structure for table `movies`
--

CREATE TABLE `movies` (
  `id` int(11) NOT NULL,
  `title` varchar(512) NOT NULL,
  `year` int(11) NOT NULL,
  `image` varchar(2048) DEFAULT NULL,
  `genre` mediumtext NOT NULL,
  `director` text NOT NULL,
  `actors` mediumtext NOT NULL,
  `rating` decimal(10,1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `movies`
--

INSERT INTO `movies` (`id`, `title`, `year`, `image`, `genre`, `director`, `actors`, `rating`) VALUES
(9, 'Inception', 2010, 'uploads/Inception.png', 'Action, Adventure, Sci-Fi', 'Christopher Nolan', 'Leonardo DiCaprio, Joseph Gordon-Levitt, Elliot Page', '8.8'),
(14, 'Titanic', 1997, 'uploads/Titanic.png', 'Drama, Romance', 'James Cameron', 'Leonardo DiCaprio, Kate Winslet, Billy Zane', '7.9'),
(15, 'Tenet', 2020, 'uploads/Tenet.png', 'Action, Adventure, Sci-Fi', 'Christopher Nolan', 'John David Washington, Robert Pattinson, Elizabeth Debicki', '7.3'),
(17, 'Sopranos', 2014, 'uploads/Sopranos.png', 'Drama', 'Mark Mos', 'Andrew Alden, Robert Allen Balder, Lada Bobrytska', '8.2'),
(19, 'Game of Thrones', 2011, 'uploads/GameofThrones.png', 'Action, Adventure, Drama', 'N/A', 'Emilia Clarke, Peter Dinklage, Kit Harington', '9.2'),
(20, 'Breaking Bad', 2008, 'uploads/BreakingBad.png', 'Crime, Drama, Thriller', 'N/A', 'Bryan Cranston, Aaron Paul, Anna Gunn', '9.5');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `movies`
--
ALTER TABLE `movies`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `movies`
--
ALTER TABLE `movies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;



