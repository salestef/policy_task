-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: May 24, 2019 at 05:21 PM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `insurance_policy`
--

-- --------------------------------------------------------

--
-- Table structure for table `group_users`
--

CREATE TABLE IF NOT EXISTS `group_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `policy_id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `last_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `birth_date` date NOT NULL,
  `passport_number` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `policy_id` (`policy_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=91 ;

--
-- Dumping data for table `group_users`
--

INSERT INTO `group_users` (`id`, `policy_id`, `name`, `last_name`, `birth_date`, `passport_number`) VALUES
(73, 106, 'Katarina', '', '1978-02-11', '786521'),
(75, 106, 'Milena', '', '1977-02-17', '998877'),
(78, 109, 'Ognjen', '', '1987-07-21', '020305'),
(79, 109, 'Anja', '', '1989-06-15', '902041'),
(81, 111, 'Luka', '', '1982-04-21', '986752'),
(83, 111, 'Bosko', '', '1974-08-22', '236423'),
(84, 112, 'Olga', '', '1995-05-05', '776655'),
(85, 113, 'Milos', '', '2014-07-24', '008877'),
(86, 115, 'Irina', '', '1997-10-04', '290782'),
(87, 115, 'Mira', '', '1998-08-28', '024213'),
(88, 116, 'Petra', '', '1993-10-30', '118809'),
(89, 116, 'Mita', '', '1991-09-14', '008865'),
(90, 117, 'Bogdan', '', '1997-06-24', '008871');

-- --------------------------------------------------------

--
-- Table structure for table `policies`
--

CREATE TABLE IF NOT EXISTS `policies` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `last_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `birth_date` date NOT NULL,
  `passport_number` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `date_from` date NOT NULL,
  `date_to` date NOT NULL,
  `policy_type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `phone_number` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `num_of_days` int(255) NOT NULL,
  `created` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=118 ;

--
-- Dumping data for table `policies`
--

INSERT INTO `policies` (`id`, `name`, `last_name`, `birth_date`, `passport_number`, `email`, `date_from`, `date_to`, `policy_type`, `phone_number`, `num_of_days`, `created`) VALUES
(106, 'Marko', 'Markovic', '1986-05-04', '29328', 'marko@marko.com', '2019-05-09', '2019-05-18', 'grupno', '0642312421', 9, '2019-05-24 16:19:36'),
(107, 'Milan', 'Milanovic', '1994-11-12', '887755', 'milan@milan.com', '2019-05-22', '2019-06-15', 'individualno', '063112233', 24, '2019-05-24 16:22:59'),
(109, 'Jovana', 'Jovanovic', '1976-11-02', '90806', 'jovana@jovana.com', '2019-05-03', '2019-05-25', 'grupno', '0617788991', 22, '2019-05-24 16:30:22'),
(111, 'Ilija', 'Ilic', '1991-12-01', '757908', 'ilija@ilija.com', '2019-05-18', '2019-05-21', 'grupno', '06588990', 3, '2019-05-24 16:33:49'),
(112, 'Ana', 'Anic', '1988-06-18', '689067', 'ana@ana.com', '2019-05-15', '2019-06-22', 'grupno', '063778999', 38, '2019-05-24 16:45:34'),
(113, 'Stefan', 'Stefanovic', '1991-04-04', '786543', 'stefan@stefan.com', '2019-05-09', '2019-05-17', 'grupno', '063998866', 8, '2019-05-24 16:56:03'),
(114, 'David', 'Davidovic', '1982-04-21', '992200', 'david@david.com', '2019-05-09', '2019-06-22', 'individualno', '062142424', 44, '2019-05-24 17:01:57'),
(115, 'Vuk', 'Vuckovic', '1969-09-19', '007722', 'vuk@vuk.com', '2019-05-08', '2019-05-25', 'grupno', '011432343', 17, '2019-05-24 17:04:21'),
(116, 'Vera', 'Veric', '1972-03-12', '068462', 'vera@vera.com', '2019-05-01', '2019-06-07', 'grupno', '011923323', 37, '2019-05-24 17:11:58'),
(117, 'Veljko', 'Veljkovic', '1986-11-22', '986479', 'veljko@veljko.com', '2019-05-09', '2019-05-18', 'grupno', '011997755', 9, '2019-05-24 17:18:10');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `group_users`
--
ALTER TABLE `group_users`
  ADD CONSTRAINT `fk_policy1` FOREIGN KEY (`policy_id`) REFERENCES `policies` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
