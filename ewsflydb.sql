-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jun 16, 2019 at 07:25 AM
-- Server version: 5.5.24-log
-- PHP Version: 5.3.13

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `ewsflydb`
--

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE IF NOT EXISTS `items` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(500) COLLATE utf8_unicode_ci DEFAULT NULL,
  `price` int(10) DEFAULT NULL,
  `company_id` int(10) NOT NULL,
  `tag` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `hits` int(10) NOT NULL,
  `date` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=11 ;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`id`, `name`, `description`, `price`, `company_id`, `tag`, `hits`, `date`) VALUES
(8, 'sprin 100 mg', 'dkjdskjfsdf ', 20, 21, 'sprin', 5, '2019-06-12'),
(9, 'sprin 100 mg', 'dlkdsklsdkf dsfkjdsfkj', 30, 22, 'sprin;headake', 5, '2019-06-12'),
(10, 'congestal', 'fdlkdslkfklsdf sddsf', 100, 22, 'congestal;infulenza', 0, '2019-06-12');

-- --------------------------------------------------------

--
-- Table structure for table `location_info`
--

CREATE TABLE IF NOT EXISTS `location_info` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `company_id` int(10) NOT NULL,
  `new_lat` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `new_lng` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `photo` varchar(100) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'no_image.png',
  `address` varchar(500) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` varchar(1000) COLLATE utf8_unicode_ci DEFAULT NULL,
  `rating` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=17 ;

--
-- Dumping data for table `location_info`
--

INSERT INTO `location_info` (`id`, `company_id`, `new_lat`, `new_lng`, `photo`, `address`, `description`, `rating`) VALUES
(15, 21, '31.044274377137054', '31.36541973996077', 'a6469e3a4906faacbb2b5d0f44b2bca1.jpg', 'jehan street', 'dskjdfkjds sdfsdf', 0),
(16, 22, '31.031759546875016', '31.378492648307656', 'Logo-Seif Pharmacies.png', 'abd-elsalam-aref street', 'kjdskfjskjdf flfllsdf sdfsksdf', 0);

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE IF NOT EXISTS `messages` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `sender_id` int(10) NOT NULL,
  `receiver_id` int(10) NOT NULL,
  `message` varchar(1000) COLLATE utf8_unicode_ci NOT NULL,
  `date` date NOT NULL DEFAULT '0000-00-00',
  `time` time NOT NULL DEFAULT '00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=19 ;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `sender_id`, `receiver_id`, `message`, `date`, `time`) VALUES
(17, 23, 22, 'hi, please i need sprin, what is the price of it-q-', '2019-06-12', '10:01:00'),
(18, 22, 23, 'ok, price =30', '2019-06-12', '10:03:00');

-- --------------------------------------------------------

--
-- Table structure for table `search`
--

CREATE TABLE IF NOT EXISTS `search` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `item_id` int(10) NOT NULL,
  `user_id` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `service`
--

CREATE TABLE IF NOT EXISTS `service` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) CHARACTER SET utf8 NOT NULL,
  `lat` float NOT NULL,
  `lng` float NOT NULL,
  `address` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `rating` int(5) NOT NULL,
  `type` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=205 ;

--
-- Dumping data for table `service`
--

INSERT INTO `service` (`id`, `name`, `lat`, `lng`, `address`, `rating`, `type`) VALUES
(168, 'Misr Pharmacies', 31.0506, 31.3946, 'El-Gaish St, Mansoura Qism 2, Mansoura, Dakahlia Governorate, Egypt', 4, 'pharmacy'),
(169, 'Ahmed Atef Pharmacy', 31.0372, 31.3662, 'Koliet Al Adaab St, Mansoura Qism 2, Mansoura, Dakahlia Governorate, Egypt', 3, 'pharmacy'),
(170, 'Sally Pharmacy', 31.0371, 31.3601, '???????? (?? ??????? - ????? ????? ?????? ????????? )? ?????????? Dakahlia Governorate, Egypt', 4, 'pharmacy'),
(171, 'El Ezaby Pharmacy', 31.046, 31.3649, 'Sofliah, Mashaya, Hosni Mubarak St EL Mashaya El, Dakahlia Governorate 35511, Egypt', 4, 'pharmacy'),
(172, 'Roshdy Pharmacies', 31.0455, 31.3845, '28 El-Thawra, Mansoura Qism 2, Mansoura, Dakahlia Governorate 35511, Egypt', 0, 'pharmacy'),
(173, '?????? ????', 31.0374, 31.3686, 'El Nakhla St, Mansoura Qism 2, Mansoura, Dakahlia Governorate, Egypt', 5, 'pharmacy'),
(174, 'Dr. Nahla El Tantawy Pharmacy', 31.0379, 31.3894, '8 ? ??????? Mansoura Qism 2, Mansoura, Dakahlia Governorate, Egypt', 4, 'pharmacy'),
(175, 'Al Doha Pharmacy', 31.0563, 31.4035, '?????? ???? ????? Mansoura Qism 2, Mansoura, Dakahlia Governorate, Egypt', 4, 'pharmacy'),
(176, 'El Araby Pharmacy', 31.0367, 31.3893, '25 ? ????????? Mansoura Qism 2, Mansoura, Dakahlia Governorate, Egypt', 5, 'pharmacy'),
(177, 'El-Battah Pharmacy', 31.0453, 31.3858, 'El-Thawra, Mansoura Qism 2, Mansoura, Dakahlia Governorate, Egypt', 5, 'pharmacy'),
(178, '?????? ???? ??????? _ ?.????? ????? Osama Ma3rof Pharmacies', 31.0616, 31.3773, 'Belkas St, Talkha City, Talkha, Dakahlia Governorate, Egypt', 5, 'pharmacy'),
(179, 'Dr. Mohamed Hamada Pharmacy', 31.0345, 31.3878, '21 Abd El-Salam Aref, Mansoura Qism 2, EL DAKAHLEYA? Dakahlia Governorate, Egypt', 3, 'pharmacy'),
(180, '??????? ??????? - MS Group', 31.0186, 31.4417, '14 ???? ??????? ?????? -??? ????? Mansoura, Dakahlia Governorate, Egypt', 4, 'pharmacy'),
(181, 'Nasef Pharmacy', 31.053, 31.4016, '?????? ???? ????? Mansoura Qism 2, Mansoura, Dakahlia Governorate, Egypt', 4, 'pharmacy'),
(182, 'Tiba Pharmacy', 31.0448, 31.3647, 'El Gomhouria St, Mit Khamis WA Kafr Al Mougi, Mansoura, Dakahlia Governorate, Egypt', 4, 'pharmacy'),
(183, 'Welson Pharmacy', 31.0572, 31.4036, '29 ? ???? ??? ????? Mansoura Qism 2, Mansoura, Dakahlia Governorate, Egypt', 4, 'pharmacy'),
(184, '?????? ????', 31.0374, 31.3686, 'El Nakhla St, Mansoura Qism 2, Mansoura, Dakahlia Governorate, Egypt', 5, 'pharmacy'),
(185, '?????? ???? ??????? _ ?.????? ????? Osama Ma3rof Pharmacies', 31.0616, 31.3773, 'Belkas St, Talkha City, Talkha, Dakahlia Governorate, Egypt', 5, 'pharmacy'),
(186, 'Osama Ma3rof pharmacies', 31.0617, 31.3774, '????? ????? ?????? Dakahlia Governorate, Egypt', 5, 'pharmacy'),
(187, 'Chest Hospital', 31.0325, 31.3729, 'Mostashfa Al Sadr, Mansoura Qism 2, Mansoura, Dakahlia Governorate, Egypt', 4, 'hospital'),
(188, 'Nabarouh Central Hospital', 31.1051, 31.3088, '.? Nabaroh, Talkha, Dakahlia Governorate, Egypt', 3, 'hospital'),
(189, 'El Mansoura Old General Hospital', 31.0441, 31.3663, '???????? ?????? ????????? Mansoura, Dakahlia Governorate, Egypt', 4, 'hospital'),
(190, '?????? ??????', 31.1435, 31.477, '??? ????? ??????? ?????????? ?????????? Egypt', 5, 'hospital'),
(191, '?????? ???? ??? ??? ?????? ????????', 31.1612, 31.2884, '??? ?????? ????? ??? ??????? Egypt', 0, 'hospital'),
(192, '???? ?????? ?????? ????????', 31.1612, 31.2884, '??? ?????? ????? ??? ??????? Egypt', 0, 'hospital'),
(193, 'Biyala Central Hospital', 31.1777, 31.2274, '?? ??????? Madinet Biyala, ??? ?????? Kafr El Sheikh Governorate, Egypt', 4, 'hospital'),
(194, 'Talkha Central Hospital', 31.0501, 31.3721, '????? Mansoura, Dakahlia Governorate, Egypt', 3, 'hospital'),
(195, '???? ??? ?? ????', 31.0121, 31.1827, 'Qebli,Al, Kafr Al Geneinah Al Qebli, El Mahalla El Kubra, Gharbia Governorate, Egypt', 0, 'hospital'),
(196, 'El Delta Hospital', 31.0427, 31.3651, 'Gehan Al Sadat, EL MANSOURA? Mansoura, Dakahlia Governorate, Egypt', 3, 'hospital'),
(197, 'El Khair Hospital', 31.052, 31.407, '153 ? ???? ??????? Mansoura Qism 2, Mansoura, Dakahlia Governorate, Egypt', 4, 'hospital'),
(198, 'El Mansoura International Hospital', 31.032, 31.391, '????? ?? ?? Abd El-Salam Aref, Dakahlia Governorate, Egypt', 4, 'hospital'),
(199, 'Fever Babila Hospital', 31.1818, 31.2258, 'Al Mostashfa, Madinet Biyala, Biyala, Kafr El Sheikh Governorate, Egypt', 3, 'hospital'),
(200, '??????????? ??????? ???? ????? ????', 31.008, 31.1633, '???? ?? ??????? ??? ????? ????? ?????? ??????? ????????? Egypt', 3, 'hospital'),
(201, 'Mansoura University Hospital', 31.0445, 31.3638, 'El Gomhouria St, Mit Khamis WA Kafr Al Mougi, Mansoura, Dakahlia Governorate, Egypt', 4, 'hospital'),
(202, 'Praise Hospital Specialist', 31.055, 31.3668, 'Talkha Sherbeen St, Talkha City, Talkha, Dakahlia Governorate, Egypt', 4, 'hospital'),
(203, 'Urology and Nephrology Center', 31.0441, 31.3656, 'Gehan Al Sadat, Mit Khamis WA Kafr Al Mougi, Mansoura, Dakahlia Governorate, Egypt', 4, 'hospital'),
(204, '?????? ???? ???? ?????? ????? ???????', 31.0661, 31.4149, '???????? - ??????? - ????? ??? ????? ???????? Mansoura, Dakahlia Governorate, Egypt', 5, 'hospital');

-- --------------------------------------------------------

--
-- Table structure for table `tags`
--

CREATE TABLE IF NOT EXISTS `tags` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `company_id` int(10) NOT NULL,
  `item_id` int(10) NOT NULL,
  `tag` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=28 ;

--
-- Dumping data for table `tags`
--

INSERT INTO `tags` (`id`, `company_id`, `item_id`, `tag`) VALUES
(23, 21, 8, 'sprin'),
(24, 22, 9, 'sprin'),
(25, 22, 9, 'headake'),
(26, 22, 10, 'congestal'),
(27, 22, 10, 'infulenza');

-- --------------------------------------------------------

--
-- Table structure for table `user_info`
--

CREATE TABLE IF NOT EXISTS `user_info` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `email` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `phone` int(12) NOT NULL,
  `ip` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `location` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `date` date NOT NULL DEFAULT '0000-00-00',
  `name` varchar(50) CHARACTER SET utf8 NOT NULL,
  `type` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `reg_as` int(2) NOT NULL,
  `view` int(10) NOT NULL,
  `rate` int(10) NOT NULL,
  `num_rate` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=24 ;

--
-- Dumping data for table `user_info`
--

INSERT INTO `user_info` (`id`, `email`, `password`, `phone`, `ip`, `location`, `date`, `name`, `type`, `reg_as`, `view`, `rate`, `num_rate`) VALUES
(21, 'tarshoby@gmail.com', '123456789', 1919, '154.189.7.225', '31.0306896;31.3754317', '2019-06-12', 'tarshoby', 'pharmacy', 1, 2, 4, 1),
(22, 'seif@gmail.com', '123456789', 1818, '154.189.7.225', '31.0307115;31.375454599999998', '2019-06-12', 'seif pharmcy', 'pharmacy', 1, 5, 3, 1),
(23, 'elgayar@gmail.com', '123456789', 2147483647, '154.189.7.225', '31.030704799999995;31.3754485', '2019-06-12', 'mostafa', 'none', 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `voting_ip`
--

CREATE TABLE IF NOT EXISTS `voting_ip` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `ip_add` varchar(100) NOT NULL,
  `user_id` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=16 ;

--
-- Dumping data for table `voting_ip`
--

INSERT INTO `voting_ip` (`id`, `ip_add`, `user_id`) VALUES
(14, '154.189.7.225', 22),
(15, '154.189.7.225', 21);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
