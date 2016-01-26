-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jan 25, 2016 at 12:58 PM
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
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `is_active` int(11) NOT NULL DEFAULT '1',
  `email` varchar(255) NOT NULL,
  `email_2` varchar(255) NOT NULL,
  `username` varchar(30) NOT NULL,
  `first_name` varchar(30) NOT NULL,
  `last_name` varchar(30) NOT NULL,
  `company` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `country_id` int(11) NOT NULL,
  `country_name` varchar(50) NOT NULL,
  `state` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `zip` int(20) NOT NULL,
  `mobile_number` int(30) NOT NULL,
  `mobile_number_2` int(30) NOT NULL,
  `password` varchar(100) NOT NULL,
  `profile_image` varchar(255) NOT NULL,
  `employee_id` varchar(255) NOT NULL,
  `membership_id` varchar(30) DEFAULT NULL,
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
  `additional_notes` varchar(255) DEFAULT NULL,
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
  `membership_from` varchar(30) DEFAULT NULL,
  `membership_to` varchar(30) DEFAULT NULL,
  `image` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=57 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `is_active`, `email`, `email_2`, `username`, `first_name`, `last_name`, `company`, `address`, `country_id`, `country_name`, `state`, `city`, `zip`, `mobile_number`, `mobile_number_2`, `password`, `profile_image`, `employee_id`, `membership_id`, `employee_description`, `remember_token`, `created_at`, `updated_at`, `home_number`, `bus_no`, `summer_no`, `fax_no`, `homeport`, `additional_city`, `additional_state`, `additional_notes`, `notes`, `user_group`, `title`, `status`, `franchisee_id`, `member_since`, `member_type`, `event`, `mailing_title`, `mailing_first_name`, `mailing_last_name`, `mailing_company`, `mailing_address`, `mailing_country`, `mailing_state`, `mailing_city`, `mailing_zip`, `mailing_mobile_number`, `mailing_email`, `short_team_member`, `membership_from`, `membership_to`, `image`) VALUES
(1, 1, 'nikola.papratovic@gmail.com', '', '', 'Nikola', 'Papratović', 'culex', 'os', 0, '', 'bla', 'kikii', 213, 32402340, 23043043, '$2y$10$31xGJpSAQ7nYIW4mdTy81OoN9XyJ8nSQXumI2NlK8qGHFitVxKq26', '', '', '', '', 'KcJLx52DYPvJRlrKVYJalqgtH2oHt3UUqsR5E0LiPPSRYuXEr7mL2NOu7NGY', '2015-10-09 11:40:24', '2016-01-24 22:56:44', 23323232, 32323, 232323, 232323, 'asdfasdf', 'asdfasdf', 'asdfasdfasdf', 'asdfasdfasdf', 'asdfasfdasd', 'admin', '2', '1', '500045\n', '0', '2', '', '', '', '', '', '', '', '', '', '', '', '', 0, '', '', 'd624a1aa4c96ca3de611-2016-01-24.jpg'),
(44, 1, 'm.vucak@gmail.com', 'm.vucak@hotmail.com', '', 'Mario', 'Mikić - Vučak', 'Culex d.o.o.', 'Zagorska 128', 54, 'Afghanistan', 'Baranja', 'Grabovac', 31309, 992546881, 917, '$2y$10$31xGJpSAQ7nYIW4mdTy81OoN9XyJ8nSQXumI2NlK8qGHFitVxKq26', '', '', '601-015', '', '', '2016-01-20 17:42:37', '2016-01-24 22:57:46', 31705466, 252177747, 1457787, 31705466, 'Luka Osijek', 'Osijek', 'Slavonija', NULL, '"Egu je neophodno da bude u sukobu sa nekim ili nečim. To objašnjava zašto težite miru, radosti i ljubavi, ali ne možete da ih podnosite dugo vremena. Vi kažete da želite da budete sretni a u stvari ste ovisnik o svojoj nesreći."', 'client', '1', '1', '50010014', '15-04-2012', '5', '', '8', 'Davor', 'Šuker', 'Šuker INC', 'Bugarska 12', 'Afghanistan', 'Bugasrka', 'Neki city', '13215', '321513', 'šuker@mail.com', 50, '01-15-2012', '02-15-2013', 'c14fabc078dd2b5b1c9b-2016-01-23.jpg'),
(49, 1, 'anaconda@big.deal', 'snake@small.deal', '', 'Gefufna', 'Muncher', 'None', 'Alberta Gudare 12', 54, 'Afghanistan', 'Zagreb', 'Zagreb', 10000, 995144447, 995448887, '', '', '', '601-017', '', '', '2016-01-21 16:34:00', '2016-01-24 19:07:28', 13332312, 2147483647, 2147483647, 122313213, 'Bjelovar', 'Baranja', 'Baranja', NULL, 'Nota mala nota.', 'client', '4', '1', '50010015', '17-03-2013', '3', '', '1', 'Ronaldo', 'Kurić', 'Kung Ko', 'Ivaniševac 12', 'Afghanistan', 'Rundek', 'Rim', '31241', '12341234', 'email@mail.com', 0, '15-08-2012', '16-09-2013', 'd624a1aa4c96ca3de611-2016-01-24.jpg'),
(53, 0, '', '', '', 'Davor', 'Šuker', '', '', 0, 'Afghanistan', '', '', 0, 0, 0, '', '', '', '1911-11', '', '', '2016-01-24 21:44:16', '2016-01-24 21:55:15', 0, 0, 0, 0, '', '', '', NULL, '', 'client', '1', '1', '50010014', '', '1', '', '1', '', '', '', '', 'Afghanistan', '', '', '', '', '', 0, '', '', ''),
(54, 1, '', '', '', 'Rudimir', 'Lovas', '', '', 0, 'Afghanistan', '', '', 0, 0, 0, '', '', '', '2000-150', '', '', '2016-01-24 22:57:27', '2016-01-24 23:20:55', 0, 0, 0, 0, 'Osijek', '', '', NULL, '', 'client', '1', '1', '50501000', '', '1', '', '1', '', '', '', '', 'Afghanistan', '', '', '', '', '', 0, '', '', '');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
