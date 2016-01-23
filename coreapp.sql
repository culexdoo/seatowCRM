-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jan 21, 2016 at 08:12 PM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `coreapp`
--

-- --------------------------------------------------------

--
-- Table structure for table `boats_entries`
--

CREATE TABLE IF NOT EXISTS `boats_entries` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `boat_brand` varchar(255) NOT NULL,
  `boat_name` varchar(255) NOT NULL,
  `year` int(10) NOT NULL,
  `registration_no` varchar(255) NOT NULL,
  `federal_doc_no` varchar(255) NOT NULL,
  `boat_color` varchar(255) NOT NULL,
  `lenght` decimal(5,2) NOT NULL,
  `description` text NOT NULL,
  `hull_id` int(11) NOT NULL,
  `make_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL,
  `updated_at` timestamp NOT NULL,
  `engine_type_id` int(11) NOT NULL,
  `fuel_type` varchar(30) NOT NULL,
  `membership_id` varchar(30) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=28 ;

--
-- Dumping data for table `boats_entries`
--

INSERT INTO `boats_entries` (`id`, `boat_brand`, `boat_name`, `year`, `registration_no`, `federal_doc_no`, `boat_color`, `lenght`, `description`, `hull_id`, `make_id`, `created_at`, `updated_at`, `engine_type_id`, `fuel_type`, `membership_id`) VALUES
(24, 'Brod Sail TEST', 'Njemačka Krstarica', 0, '', '', '', '0.00', 'Deskripšn', 14, 9, '2016-01-19 10:44:41', '2016-01-19 18:44:48', 4, 'Gasoline', '601-109'),
(25, 'Gasoline', 'Jet', 0, '', '', '', '0.00', '', 14, 9, '2016-01-19 11:14:10', '2016-01-19 18:28:56', 5, 'Diesel', '601-109'),
(26, 'Diesel', 'Diesel', 0, '', '', '', '0.00', '', 14, 9, '2016-01-19 11:20:01', '2016-01-19 11:20:01', 1, 'Diesel', '601-109'),
(27, 'BMW', 'Youllene', 1999, 'KZ44454QQ', '51115AAAA1', 'RED', '19.00', 'Brod je zakon!', 12, 7, '2016-01-20 17:55:48', '2016-01-20 17:55:48', 4, 'Diesel', '601-015');

-- --------------------------------------------------------

--
-- Table structure for table `boat_hull`
--

CREATE TABLE IF NOT EXISTS `boat_hull` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `hull_name` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL,
  `updated_at` timestamp NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=15 ;

--
-- Dumping data for table `boat_hull`
--

INSERT INTO `boat_hull` (`id`, `hull_name`, `created_at`, `updated_at`) VALUES
(11, 'Hull 2', '2016-01-18 18:12:28', '2016-01-18 20:09:57'),
(12, 'Hull 1', '2016-01-18 19:11:26', '2016-01-18 20:09:52'),
(13, 'Hull 3', '2016-01-18 20:35:39', '2016-01-18 20:35:39'),
(14, 'Hull 5', '2016-01-18 20:43:51', '2016-01-18 20:43:51');

-- --------------------------------------------------------

--
-- Table structure for table `boat_make`
--

CREATE TABLE IF NOT EXISTS `boat_make` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `make_name` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL,
  `updated_at` timestamp NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `boat_make`
--

INSERT INTO `boat_make` (`id`, `make_name`, `created_at`, `updated_at`) VALUES
(7, 'Make 2', '2016-01-18 18:13:49', '2016-01-18 20:09:44'),
(8, 'Make 1', '2016-01-18 19:11:34', '2016-01-18 20:09:38'),
(9, 'Make 3', '2016-01-18 20:35:49', '2016-01-18 20:35:49');

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
  `material` varchar(256) NOT NULL,
  `color` varchar(256) NOT NULL,
  `short_description` varchar(255) NOT NULL,
  `category_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL,
  `updated_at` timestamp NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=23 ;

--
-- Dumping data for table `classifiedoffer_entries`
--

INSERT INTO `classifiedoffer_entries` (`id`, `title`, `content`, `image`, `material`, `color`, `short_description`, `category_id`, `user_id`, `created_at`, `updated_at`) VALUES
(14, 'LOLO', 'asdfasdfasdf', '', '1', '', '', 0, 1, '2016-01-13 11:38:32', '2016-01-13 16:10:44'),
(15, 'Jovo', 'Cigla', '', '1', '', '', 0, 1, '2016-01-13 12:12:22', '2016-01-13 16:10:26'),
(16, 'asdf', 'asdf', '', '1', 'asdf', 'asdf', 0, 1, '2016-01-13 15:16:00', '2016-01-13 16:07:26'),
(17, 'asdf', 'asdfasd', '', '1', 'asdfasdfasdfa', 'asd', 0, 1, '2016-01-13 15:29:23', '2016-01-13 16:07:31'),
(18, 'asdfasfasdfasdf', 'asdfas', '', '1', 'asdfasdfasdfasd', 'asdf', 0, 1, '2016-01-13 15:36:42', '2016-01-13 16:07:39'),
(19, 'TITO', 'TATA', '', '1', 'TUTU', 'TETE', 0, 1, '2016-01-13 16:11:35', '2016-01-13 16:11:46'),
(20, 'aaaaaaaaa', 'aaaaaaaaaaa', '', 'aaaaaaaaaaaaaa', 'aaaaaaaaaaa', 'aaaaaaaaaaa', 1, 1, '2016-01-13 16:12:59', '2016-01-13 16:22:27'),
(21, '1111111111', '1111111111', '', '1', '111111111', '1111111111111', 1111111111, 1, '2016-01-13 16:13:39', '2016-01-13 16:20:23'),
(22, 'şdfasdfa', 'sdfasdfasdfasdfa', '', '1', 'asdfasdfasdf', 'asdfasdfasdfa333', 0, 1, '2016-01-13 16:19:04', '2016-01-13 16:19:39');

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
-- Table structure for table `countries`
--

CREATE TABLE IF NOT EXISTS `countries` (
  `id` int(11) NOT NULL,
  `country_name` varchar(80) NOT NULL,
  `created_at` timestamp NOT NULL,
  `updated_at` timestamp NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `countries`
--

INSERT INTO `countries` (`id`, `country_name`, `created_at`, `updated_at`) VALUES
(1, 'Afghanistan', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(2, 'Albania', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(3, 'Algeria', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(4, 'American Samoa', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(5, 'Andorra', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(6, 'Angola', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(7, 'Anguilla', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(8, 'Antarctica', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(9, 'Antigua and Barbuda', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(10, 'Argentina', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(11, 'Armenia', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(12, 'Aruba', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(13, 'Australia', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(14, 'Austria', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(15, 'Azerbaijan', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(16, 'Bahamas', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(17, 'Bahrain', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(18, 'Bangladesh', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(19, 'Barbados', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(20, 'Belarus', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(21, 'Belgium', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(22, 'Belize', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(23, 'Benin', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(24, 'Bermuda', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(25, 'Bhutan', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(26, 'Bolivia', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(27, 'Bosnia and Herzegovina', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(28, 'Botswana', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(29, 'Bouvet Island', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(30, 'Brazil', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(31, 'British Indian Ocean Territory', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(32, 'Brunei Darussalam', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(33, 'Bulgaria', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(34, 'Burkina Faso', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(35, 'Burundi', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(36, 'Cambodia', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(37, 'Cameroon', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(38, 'Canada', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(39, 'Cape Verde', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(40, 'Cayman Islands', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(41, 'Central African Republic', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(42, 'Chad', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(43, 'Chile', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(44, 'China', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(45, 'Christmas Island', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(46, 'Cocos (Keeling) Islands', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(47, 'Colombia', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(48, 'Comoros', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(49, 'Congo', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(50, 'Congo, the Democratic Republic of the', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(51, 'Cook Islands', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(52, 'Costa Rica', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(53, 'Cote D''Ivoire', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(54, 'Croatia', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(55, 'Cuba', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(56, 'Cyprus', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(57, 'Czech Republic', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(58, 'Denmark', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(59, 'Djibouti', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(60, 'Dominica', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(61, 'Dominican Republic', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(62, 'Ecuador', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(63, 'Egypt', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(64, 'El Salvador', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(65, 'Equatorial Guinea', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(66, 'Eritrea', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(67, 'Estonia', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(68, 'Ethiopia', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(69, 'Falkland Islands (Malvinas)', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(70, 'Faroe Islands', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(71, 'Fiji', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(72, 'Finland', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(73, 'France', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(74, 'French Guiana', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(75, 'French Polynesia', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(76, 'French Southern Territories', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(77, 'Gabon', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(78, 'Gambia', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(79, 'Georgia', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(80, 'Germany', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(81, 'Ghana', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(82, 'Gibraltar', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(83, 'Greece', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(84, 'Greenland', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(85, 'Grenada', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(86, 'Guadeloupe', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(87, 'Guam', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(88, 'Guatemala', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(89, 'Guinea', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(90, 'Guinea-Bissau', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(91, 'Guyana', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(92, 'Haiti', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(93, 'Heard Island and Mcdonald Islands', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(94, 'Holy See (Vatican City State)', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(95, 'Honduras', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(96, 'Hong Kong', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(97, 'Hungary', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(98, 'Iceland', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(99, 'India', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(100, 'Indonesia', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(101, 'Iran, Islamic Republic of', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(102, 'Iraq', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(103, 'Ireland', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(104, 'Israel', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(105, 'Italy', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(106, 'Jamaica', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(107, 'Japan', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(108, 'Jordan', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(109, 'Kazakhstan', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(110, 'Kenya', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(111, 'Kiribati', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(112, 'Korea, Democratic People''s Republic of', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(113, 'Korea, Republic of', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(114, 'Kuwait', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(115, 'Kyrgyzstan', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(116, 'Lao People''s Democratic Republic', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(117, 'Latvia', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(118, 'Lebanon', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(119, 'Lesotho', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(120, 'Liberia', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(121, 'Libyan Arab Jamahiriya', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(122, 'Liechtenstein', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(123, 'Lithuania', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(124, 'Luxembourg', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(125, 'Macao', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(126, 'Macedonia, the Former Yugoslav Republic of', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(127, 'Madagascar', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(128, 'Malawi', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(129, 'Malaysia', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(130, 'Maldives', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(131, 'Mali', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(132, 'Malta', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(133, 'Marshall Islands', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(134, 'Martinique', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(135, 'Mauritania', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(136, 'Mauritius', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(137, 'Mayotte', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(138, 'Mexico', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(139, 'Micronesia, Federated States of', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(140, 'Moldova, Republic of', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(141, 'Monaco', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(142, 'Mongolia', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(143, 'Montserrat', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(144, 'Morocco', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(145, 'Mozambique', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(146, 'Myanmar', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(147, 'Namibia', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(148, 'Nauru', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(149, 'Nepal', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(150, 'Netherlands', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(151, 'Netherlands Antilles', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(152, 'New Caledonia', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(153, 'New Zealand', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(154, 'Nicaragua', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(155, 'Niger', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(156, 'Nigeria', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(157, 'Niue', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(158, 'Norfolk Island', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(159, 'Northern Mariana Islands', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(160, 'Norway', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(161, 'Oman', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(162, 'Pakistan', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(163, 'Palau', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(164, 'Palestinian Territory, Occupied', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(165, 'Panama', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(166, 'Papua New Guinea', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(167, 'Paraguay', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(168, 'Peru', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(169, 'Philippines', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(170, 'Pitcairn', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(171, 'Poland', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(172, 'Portugal', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(173, 'Puerto Rico', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(174, 'Qatar', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(175, 'Reunion', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(176, 'Romania', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(177, 'Russian Federation', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(178, 'Rwanda', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(179, 'Saint Helena', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(180, 'Saint Kitts and Nevis', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(181, 'Saint Lucia', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(182, 'Saint Pierre and Miquelon', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(183, 'Saint Vincent and the Grenadines', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(184, 'Samoa', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(185, 'San Marino', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(186, 'Sao Tome and Principe', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(187, 'Saudi Arabia', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(188, 'Senegal', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(189, 'Serbia and Montenegro', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(190, 'Seychelles', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(191, 'Sierra Leone', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(192, 'Singapore', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(193, 'Slovakia', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(194, 'Slovenia', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(195, 'Solomon Islands', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(196, 'Somalia', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(197, 'South Africa', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(198, 'South Georgia and the South Sandwich Islands', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(199, 'Spain', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(200, 'Sri Lanka', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(201, 'Sudan', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(202, 'Suriname', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(203, 'Svalbard and Jan Mayen', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(204, 'Swaziland', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(205, 'Sweden', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(206, 'Switzerland', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(207, 'Syrian Arab Republic', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(208, 'Taiwan, Province of China', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(209, 'Tajikistan', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(210, 'Tanzania, United Republic of', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(211, 'Thailand', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(212, 'Timor-Leste', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(213, 'Togo', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(214, 'Tokelau', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(215, 'Tonga', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(216, 'Trinidad and Tobago', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(217, 'Tunisia', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(218, 'Turkey', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(219, 'Turkmenistan', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(220, 'Turks and Caicos Islands', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(221, 'Tuvalu', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(222, 'Uganda', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(223, 'Ukraine', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(224, 'United Arab Emirates', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(225, 'United Kingdom', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(226, 'United States', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(227, 'United States Minor Outlying Islands', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(228, 'Uruguay', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(229, 'Uzbekistan', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(230, 'Vanuatu', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(231, 'Venezuela', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(232, 'Viet Nam', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(233, 'Virgin Islands, British', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(234, 'Virgin Islands, U.s.', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(235, 'Wallis and Futuna', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(236, 'Western Sahara', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(237, 'Yemen', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(238, 'Zambia', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(239, 'Zimbabwe', '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `employee_franchisee`
--

CREATE TABLE IF NOT EXISTS `employee_franchisee` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `employee_id` int(11) NOT NULL,
  `franchisee_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL,
  `updated_at` timestamp NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=29 ;

--
-- Dumping data for table `employee_franchisee`
--

INSERT INTO `employee_franchisee` (`id`, `employee_id`, `franchisee_id`, `created_at`, `updated_at`) VALUES
(1, 3241, 1010, '2016-01-17 17:22:01', '2016-01-17 17:22:01'),
(2, 2016002, 331, '2016-01-17 18:00:45', '2016-01-17 18:00:45'),
(3, 555555, 328, '2016-01-17 18:01:54', '2016-01-17 18:01:54'),
(4, 2222111, 325, '2016-01-17 18:06:24', '2016-01-17 18:06:24'),
(5, 333, 331, '2016-01-17 18:07:55', '2016-01-17 18:07:55'),
(6, 323232, 2016002, '2016-01-17 18:09:36', '2016-01-17 18:09:36'),
(7, 69, 500045, '2016-01-17 18:10:25', '2016-01-17 18:10:25'),
(8, 693, 2016002, '2016-01-17 18:40:38', '2016-01-17 18:40:38'),
(9, 692, 2016002, '2016-01-17 18:40:48', '2016-01-17 18:40:48'),
(10, 69232, 2016002, '2016-01-17 18:40:57', '2016-01-17 18:40:57'),
(11, 2147483647, 2016002, '2016-01-17 18:41:19', '2016-01-17 18:41:19'),
(13, 11, 2016002, '2016-01-17 18:42:36', '2016-01-17 18:42:36'),
(14, 112, 2016002, '2016-01-17 18:43:23', '2016-01-17 18:43:23'),
(15, 1122, 2016002, '2016-01-17 18:44:29', '2016-01-17 18:44:29'),
(16, 333, 2016002, '2016-01-17 19:16:10', '2016-01-17 19:16:10'),
(22, 4, 500045, '2016-01-18 20:19:55', '2016-01-18 20:19:55'),
(23, 15, 50010014, '2016-01-20 17:56:46', '2016-01-20 17:56:46'),
(24, 52500, 50010014, '2016-01-20 18:01:49', '2016-01-20 18:01:49'),
(25, 213, 50010014, '2016-01-20 18:03:19', '2016-01-20 18:03:19'),
(28, 15, 50010014, '2016-01-20 18:21:44', '2016-01-20 18:21:44');

-- --------------------------------------------------------

--
-- Table structure for table `franchisee_entries`
--

CREATE TABLE IF NOT EXISTS `franchisee_entries` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `franchisee_id` int(11) NOT NULL,
  `city` varchar(255) NOT NULL,
  `country` int(11) NOT NULL,
  `zip` int(11) NOT NULL,
  `franchisee_short` text NOT NULL,
  `franchisee_long` text NOT NULL,
  `created_at` timestamp NOT NULL,
  `updated_at` timestamp NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=334 ;

--
-- Dumping data for table `franchisee_entries`
--

INSERT INTO `franchisee_entries` (`id`, `franchisee_id`, `city`, `country`, `zip`, `franchisee_short`, `franchisee_long`, `created_at`, `updated_at`) VALUES
(325, 20010014, 'BRIJEST', 0, 31440, 'NE ZNAMAAA', 'IMA', '2016-01-14 15:00:44', '2016-01-20 17:53:35'),
(332, 50010015, 'Gradec', 0, 31340, 'Tko se vuka boji još?', 'Nikola :D', '2016-01-17 19:42:25', '2016-01-20 17:53:27'),
(333, 50010014, 'Osijek', 0, 31000, 'Ova franšiza pripada gradu Osijek', 'Opis franšize je jednostavan. Nema ga.', '2016-01-20 13:10:13', '2016-01-20 17:53:16');

-- --------------------------------------------------------

--
-- Table structure for table `membership_entries`
--

CREATE TABLE IF NOT EXISTS `membership_entries` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `normal_price` decimal(5,2) NOT NULL,
  `promo_price_1` decimal(5,2) NOT NULL,
  `promo_price_2` decimal(5,2) NOT NULL,
  `created_at` timestamp NOT NULL,
  `updated_at` timestamp NOT NULL,
  `promo_period_1_from` varchar(30) NOT NULL,
  `promo_period_1_to` varchar(30) NOT NULL,
  `promo_period_2_from` varchar(30) NOT NULL,
  `promo_period_2_to` varchar(30) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `membership_entries`
--

INSERT INTO `membership_entries` (`id`, `title`, `description`, `normal_price`, `promo_price_1`, `promo_price_2`, `created_at`, `updated_at`, `promo_period_1_from`, `promo_period_1_to`, `promo_period_2_from`, `promo_period_2_to`) VALUES
(3, 'Ivo', 'ALF ASDF ASDF ASDF ASDF ASDF ASDF', '102.00', '11.00', '0.00', '2016-01-14 11:07:42', '2016-01-14 11:07:42', '', '', '', ''),
(6, 'Platinum', 'This is platinum membership.', '50.00', '45.00', '35.00', '2016-01-21 18:34:08', '2016-01-21 18:34:08', '01-01-2016', '01-02-2016', '01-03-2016', '01-05-2016');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(255) NOT NULL,
  `email_2` varchar(255) NOT NULL,
  `username` varchar(30) NOT NULL,
  `first_name` varchar(30) NOT NULL,
  `last_name` varchar(30) NOT NULL,
  `company` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `country_id` int(11) NOT NULL,
  `state` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `zip` int(20) NOT NULL,
  `mobile_number` int(30) NOT NULL,
  `mobile_number_2` int(30) NOT NULL,
  `password` varchar(100) NOT NULL,
  `profile_image` varchar(255) NOT NULL,
  `employee_id` varchar(255) NOT NULL,
  `membership_id` varchar(30) NOT NULL,
  `employee_description` text NOT NULL,
  `remember_token` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `home_number` int(30) NOT NULL,
  `bus_no` int(30) NOT NULL,
  `summer_no` int(30) NOT NULL,
  `fax_no` int(30) NOT NULL,
  `homeport` varchar(255) NOT NULL,
  `additional_city` varchar(255) NOT NULL,
  `additional_state` varchar(255) NOT NULL,
  `additional_notes` varchar(255) NOT NULL,
  `notes` text NOT NULL,
  `user_group` varchar(20) NOT NULL,
  `title` varchar(255) NOT NULL,
  `status` varchar(30) NOT NULL,
  `franchisee_id` varchar(30) NOT NULL,
  `member_since` varchar(20) NOT NULL,
  `member_type` varchar(255) NOT NULL,
  `event` varchar(255) NOT NULL,
  `mailing_title` varchar(255) DEFAULT NULL,
  `mailing_first_name` varchar(255) DEFAULT NULL,
  `mailing_last_name` varchar(255) DEFAULT NULL,
  `mailing_company` varchar(255) DEFAULT NULL,
  `mailing_address` varchar(255) DEFAULT NULL,
  `mailing_country` varchar(255) DEFAULT NULL,
  `mailing_state` varchar(255) DEFAULT NULL,
  `mailing_city` varchar(255) DEFAULT NULL,
  `mailing_zip` varchar(255) DEFAULT NULL,
  `mailing_mobile_number` varchar(255) DEFAULT NULL,
  `mailing_email` varchar(255) DEFAULT NULL,
  `short_team_member` int(11) NOT NULL,
  `membership_from` varchar(30) NOT NULL,
  `membership_to` varchar(30) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=50 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `email_2`, `username`, `first_name`, `last_name`, `company`, `address`, `country_id`, `state`, `city`, `zip`, `mobile_number`, `mobile_number_2`, `password`, `profile_image`, `employee_id`, `membership_id`, `employee_description`, `remember_token`, `created_at`, `updated_at`, `home_number`, `bus_no`, `summer_no`, `fax_no`, `homeport`, `additional_city`, `additional_state`, `additional_notes`, `notes`, `user_group`, `title`, `status`, `franchisee_id`, `member_since`, `member_type`, `event`, `mailing_title`, `mailing_first_name`, `mailing_last_name`, `mailing_company`, `mailing_address`, `mailing_country`, `mailing_state`, `mailing_city`, `mailing_zip`, `mailing_mobile_number`, `mailing_email`, `short_team_member`, `membership_from`, `membership_to`) VALUES
(1, 'nikola.papratovic@gmail.com', '', '', 'Nikola', 'Papratović', 'culex', 'os', 0, 'bla', 'kikii', 213, 32402340, 23043043, '$2y$10$31xGJpSAQ7nYIW4mdTy81OoN9XyJ8nSQXumI2NlK8qGHFitVxKq26', '', '', '', '', 'VE905fli7DsLKMDbD9IFjNPrVDGjJ6k906RV89MEtT8wj9x6fzjluKQP07cy', '2015-10-09 11:40:24', '2016-01-21 17:27:16', 23323232, 32323, 232323, 232323, 'asdfasdf', 'asdfasdf', 'asdfasdfasdf', 'asdfasdfasdf', 'asdfasfdasd', '', '2', '1', '500045\n', '0', '2', '', '', '', '', '', '', '', '', '', '', '', '', 0, '', ''),
(39, 'test@test.com', 'maleni@tko.ja', '', 'Josip', 'Anić', 'Zgubidan', 'Test', 0, 'Baranja', 'Osijek', 21000, 993332232, 2147483647, '', '', '', '724-109', '', '', '2016-01-19 20:04:18', '2016-01-20 16:00:42', 32111111, 2147483647, 2147483647, 31111111, 'Bjeloruisja', 'Osijek', 'baranja', 'I ovo je nota', 'Ovo je nota', 'client', '7', '1', '500045', '1996', '3', '', '', '', '', '', '', '', '', '', '', '', '', 0, '', ''),
(44, 'm.vucak@gmail.com', 'm.vucak@hotmail.com', '', 'Mario', 'Mikić - Vučak', 'Culex d.o.o.', 'Zagorska 128', 54, 'Baranja', 'Grabovac', 31309, 992546881, 917046681, '', '', '', '601-015', '', '', '2016-01-20 17:42:37', '2016-01-21 18:04:14', 31705466, 252177747, 1457787, 31705466, 'Luka Osijek', 'Osijek', 'Slavonija', 'Kvar na motoru, dizna otišla. Popravljeno.', '"Egu je neophodno da bude u sukobu sa nekim ili nečim. To objašnjava zašto težite miru, radosti i ljubavi, ali ne možete da ih podnosite dugo vremena. Vi kažete da želite da budete sretni a u stvari ste ovisnik o svojoj nesreći."', 'client', '1', '1', '50010014', '15-04-2012', '5', '3', '8', 'Davor', 'Šuker', 'Šuker INC', 'Bugarska 12', '33', 'Bugasrka', 'Neki city', '13215', '321513', 'šuker@mail.com', 50, '01-01-2012', '01-01-2016'),
(45, 'josip@mail.com', '', '', 'Josip', 'Lukić', '', '', 0, '', '', 0, 999814484, 0, '', '', '15-30', '', '', '', '2016-01-20 18:56:46', '2016-01-20 18:56:46', 0, 0, 0, 0, '', '', '', '', '', 'employee', '', '', '', '0', '1', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, '', ''),
(46, '', '', '', 'Teata', 'atsdtasdt', '', '', 0, '', '', 0, 0, 0, '', '', '52500', '', '', '', '2016-01-20 19:01:49', '2016-01-20 19:01:49', 0, 0, 0, 0, '', '', '', '', '', '', '', '', '', '0', '2', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, '', ''),
(47, '', '', '', 'asdfa', 'asdfasdf', '', '', 0, '', '', 0, 0, 0, '', '', '213', '', '', '', '2016-01-20 19:03:19', '2016-01-20 19:03:19', 0, 0, 0, 0, '', '', '', '', '', '', '', '', '', '0', '2', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, '', ''),
(48, '', '', '', 'Andrija', 'Lukičevančević', '', '', 0, '', '', 0, 992225154, 0, '', '', '15-40', '', '', '', '2016-01-20 19:05:51', '2016-01-20 19:21:44', 0, 0, 0, 0, '', '', '', '', '', 'employee', '', '', '', '0', '1', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, '22-01-1999', '15-01-2015'),
(49, 'anaconda@big.deal', 'snake@small.deal', '', 'Geodora', 'Muncher', 'None', 'Alberta Gudare 12', 54, 'Zagreb', 'Zagreb', 10000, 995144447, 995448887, '', '', '', '601-017', '', '', '2016-01-21 16:34:00', '2016-01-21 17:13:26', 13332312, 2147483647, 2147483647, 122313213, 'Bjelovar', 'Županja', 'Baranja', 'Ovo je test 2', 'Nota mala nota.', 'client', '4', '1', '50010015', '17-03-2013', '3', '', '1', 'Ronaldo', 'Kurić', 'Kung Ko', 'Ivaniševac 12', '59', 'Rundek', 'Rim', '31241', '12341234', 'email@mail.com', 0, '15-08-2012', '15-08-2013');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
