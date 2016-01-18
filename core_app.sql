-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jan 13, 2016 at 11:44 AM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `core_app`
--

-- --------------------------------------------------------

--
-- Table structure for table `classifieddemand_entries`
--

CREATE TABLE IF NOT EXISTS `classifieddemand_entries` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `image` varchar(255) NOT NULL,
  `category_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL,
  `updated_at` timestamp NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `classifiedoffer_entries`
--

CREATE TABLE IF NOT EXISTS `classifiedoffer_entries` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `image` varchar(255) NOT NULL,
  `category_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL,
  `updated_at` timestamp NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=14 ;

--
-- Dumping data for table `classifiedoffer_entries`
--

INSERT INTO `classifiedoffer_entries` (`id`, `title`, `content`, `image`, `category_id`, `user_id`, `created_at`, `updated_at`) VALUES
(13, 'Svježe borovnice', 'Sed mattis, tellus quis porta pellentesque, ligula turpis ornare lorem, vel pulvinar sapien enim a magna. Suspendisse eu mollis ante, non efficitur nunc. Proin rhoncus dictum dictum. Duis dictum commodo erat, in tincidunt sapien. Nulla tempus, ligula vitae auctor sollicitudin, nibh mauris tristique purus, at ullamcorper mi justo vel justo. Nulla id congue dolor. Phasellus at turpis ex.', 'c57177ea8a36bece3b9b-2015-10-10.jpg', 1, 1, '2015-10-10 21:07:18', '2015-10-10 21:07:18');

-- --------------------------------------------------------

--
-- Table structure for table `classifieds_categories`
--

CREATE TABLE IF NOT EXISTS `classifieds_categories` (
  `category_id` int(11) NOT NULL AUTO_INCREMENT,
  `category_name` varchar(255) NOT NULL,
  `category_image` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL,
  `updated_at` timestamp NOT NULL,
  PRIMARY KEY (`category_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `classifieds_categories`
--

INSERT INTO `classifieds_categories` (`category_id`, `category_name`, `category_image`, `created_at`, `updated_at`) VALUES
(1, 'Bobičasto voće', 'bobicastovoce.jpg', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(2, 'Gomoljasto povrće', 'gomoljastopovrce.jpg', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(3, 'Zeljasto povrće', 'zeljastopovrce.gif', '2015-10-10 12:11:05', '2015-10-10 12:11:05'),
(4, 'Orašasti plodovi', 'orasastiplodovi.jpg', '2015-10-10 12:11:05', '2015-10-10 12:11:05');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(255) NOT NULL,
  `username` varchar(30) NOT NULL,
  `first_name` varchar(30) NOT NULL,
  `last_name` varchar(30) NOT NULL,
  `password` varchar(100) NOT NULL,
  `profile_image` varchar(255) NOT NULL,
  `remember_token` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `username`, `first_name`, `last_name`, `password`, `profile_image`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'nikola.papratovic@gmail.com', '', 'Nikola', 'Papratović', '$2y$10$31xGJpSAQ7nYIW4mdTy81OoN9XyJ8nSQXumI2NlK8qGHFitVxKq26', '', 'eLAUbkuBkccnucG74MFlAhuCfjpPqE34R2ZQvFQJ67QNNqtOxO3hBfMtz5il', '2015-10-09 11:40:24', '2015-10-11 04:07:29'),
(2, 'nikola.papratovic@betaware.hr', '', 'Petar Veliki', 'Knežević', '$2y$10$2vdKaIz.BOhK8rNk6lKc.uYBXVCFOTxx21.IQ2h5DU99slYPJ9wuu', '', 'cyIMvkhoLj30Nyr5jltMOJUMSeuu7ryhBsRudMlxXOM9uYIAeNARzAGPlCsu', '2015-10-10 16:24:20', '2015-10-10 21:08:35'),
(5, 'marko.markovic@gmail.com', '', 'Marko', 'Marković', '$2y$10$ByjIPDoNVxoQj0V1ncnq1eI8lus3Z.X3.zi/lj01T0AOOaSHsIyDS', '', 'w4lYkHstFujbaeCMwnW13RAUsypvhnTJi2GvedtvMZMImZ08yLvyfg15QHde', '2015-10-10 16:35:01', '2015-10-10 16:35:20');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
