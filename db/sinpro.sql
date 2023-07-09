-- Adminer 4.8.1 MySQL 10.11.2-MariaDB-1 dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

DROP DATABASE IF EXISTS `sinpro`;
CREATE DATABASE `sinpro` /*!40100 DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci */;
USE `sinpro`;

DROP TABLE IF EXISTS `admin`;
CREATE TABLE `admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `aname` varchar(100) NOT NULL,
  `apass` varchar(100) NOT NULL,
  `a_mail` varchar(200) NOT NULL,
  `role` char(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

INSERT INTO `admin` (`id`, `aname`, `apass`, `a_mail`, `role`) VALUES
(2,	'admin',	'$2y$10$kHNQZ3amlRdadIUSt3pSsuTqkvHhSzN8pEsmjcFtr7urjXIuL9tNa',	'admin@admin.com',	'admin');

DROP TABLE IF EXISTS `barrow_books`;
CREATE TABLE `barrow_books` (
  `sbid` int(11) NOT NULL AUTO_INCREMENT,
  `sid` int(11) NOT NULL,
  `bid` int(11) NOT NULL,
  `request_date` date NOT NULL,
  `return_date` date NOT NULL,
  `returned_date` date NOT NULL,
  `is_returned` int(11) NOT NULL,
  `role` varchar(10) NOT NULL,
  `status` int(11) NOT NULL,
  PRIMARY KEY (`sbid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;


DROP TABLE IF EXISTS `books`;
CREATE TABLE `books` (
  `bid` int(11) NOT NULL AUTO_INCREMENT,
  `sno` varchar(150) NOT NULL,
  `bno` varchar(20) NOT NULL,
  `bcode` varchar(50) DEFAULT NULL,
  `title` varchar(150) NOT NULL,
  `aname` varchar(150) NOT NULL,
  `publication` varchar(150) NOT NULL,
  `price` varchar(150) NOT NULL,
  `alamara` varchar(150) NOT NULL,
  `rack` varchar(150) NOT NULL,
  `status` int(11) NOT NULL,
  `sstatus` int(11) NOT NULL,
  PRIMARY KEY (`bid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;


DROP TABLE IF EXISTS `department`;
CREATE TABLE `department` (
  `did` int(11) NOT NULL AUTO_INCREMENT,
  `dname` varchar(150) NOT NULL,
  PRIMARY KEY (`did`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

INSERT INTO `department` (`did`, `dname`) VALUES
(1,	'B.Sc.Computer Science'),
(2,	'M.Sc.Computer Science'),
(3,	'BCA.Computer application'),
(4,	'B.Sc.Physics'),
(5,	'B.Sc.Zoology'),
(6,	'B.A.Tamil'),
(7,	'B.A.English'),
(8,	'B.Sc.Statistics'),
(9,	'B.Sc.Mathematics'),
(10,	'B.Sc.Agriculture'),
(11,	'B.Sc.Economics'),
(12,	'B.Sc.Botany'),
(13,	'B.Sc.Chemistry'),
(14,	'B.Sc.Microbiology'),
(15,	'B.A.History'),
(16,	'B.A.Business Administration'),
(17,	'B.A.Commerce');

DROP TABLE IF EXISTS `designation`;
CREATE TABLE `designation` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `designation` varchar(150) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

INSERT INTO `designation` (`id`, `designation`) VALUES
(1,	'Professor'),
(2,	'Assistant Professor'),
(3,	'Lecturer');

DROP TABLE IF EXISTS `settings`;
CREATE TABLE `settings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `app_name` varchar(30) NOT NULL,
  `app_decp` varchar(300) DEFAULT NULL,
  `app_logo` varchar(80) NOT NULL,
  `fine` int(11) NOT NULL,
  `fine_stf_days` int(11) NOT NULL,
  `fine_std_days` int(11) NOT NULL,
  `smtp_host` varchar(33) NOT NULL,
  `smtp_port` varchar(10) NOT NULL,
  `smtp_user` varchar(30) NOT NULL,
  `smtp_pass` varchar(30) NOT NULL,
  `smtp_sec_type` enum('ssl','tls') NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

INSERT INTO `settings` (`id`, `app_name`, `app_decp`, `app_logo`, `fine`, `fine_stf_days`, `fine_std_days`, `smtp_host`, `smtp_port`, `smtp_user`, `smtp_pass`, `smtp_sec_type`) VALUES
(1,	'GAS-7 LMS',	'In principle and reality, libraries are life-enhancing palaces of wonder',	'/assets/logo.png',	2,	60,	30,	'smtp.gmail.com',	'587',	'computersearch4@gmail.com',	'happycomputer',	'ssl');

DROP TABLE IF EXISTS `staff`;
CREATE TABLE `staff` (
  `sid` int(11) NOT NULL AUTO_INCREMENT,
  `regno` varchar(150) NOT NULL,
  `spass` varchar(150) NOT NULL,
  `sname` varchar(150) NOT NULL,
  `semail` varchar(200) NOT NULL,
  `did` int(11) NOT NULL,
  `id` int(11) NOT NULL,
  `contact` varchar(150) NOT NULL,
  `gender` enum('male','female') NOT NULL,
  `image` varchar(300) NOT NULL,
  `role` char(20) NOT NULL,
  PRIMARY KEY (`sid`),
  KEY `id` (`id`),
  KEY `did` (`did`),
  CONSTRAINT `staff_ibfk_2` FOREIGN KEY (`id`) REFERENCES `designation` (`id`),
  CONSTRAINT `staff_ibfk_4` FOREIGN KEY (`did`) REFERENCES `department` (`did`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;


DROP TABLE IF EXISTS `staff_department`;
CREATE TABLE `staff_department` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `s_d_name` varchar(64) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

INSERT INTO `staff_department` (`id`, `s_d_name`) VALUES
(1,	'Computer Science'),
(2,	'Physics'),
(3,	'Zoology'),
(4,	'Tamil'),
(5,	'English'),
(6,	'Statistics'),
(7,	'Mathematics'),
(8,	'Agriculture'),
(9,	'Economics'),
(10,	'Botany'),
(11,	'Chemistry'),
(12,	'Microbiology'),
(13,	'History'),
(14,	'Business Administration'),
(15,	'Commerce');

DROP TABLE IF EXISTS `students`;
CREATE TABLE `students` (
  `st_id` int(11) NOT NULL AUTO_INCREMENT,
  `regno` varchar(150) NOT NULL,
  `sname` varchar(150) NOT NULL,
  `spass` varchar(150) NOT NULL,
  `gender` enum('male','female') NOT NULL,
  `stemail` varchar(200) DEFAULT NULL,
  `Contact` varchar(12) DEFAULT NULL,
  `did` int(11) NOT NULL,
  `year` varchar(150) NOT NULL,
  `shift` varchar(150) NOT NULL,
  `img` varchar(150) NOT NULL,
  `role` char(20) NOT NULL,
  PRIMARY KEY (`st_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;


-- 2023-07-09 16:51:10
