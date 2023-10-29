-- Adminer 4.8.1 MySQL 10.11.2-MariaDB-1 dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

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
(1,	'admin',	'$2y$10$KKFV7E0T5D8t5B/LKHY3ousRnWbRVloYhYN2Gq/5/ITcforJETRle',	'admin@admin.com',	'admin');

DROP TABLE IF EXISTS `barrow_books`;
CREATE TABLE `barrow_books` (
  `sbid` int(11) NOT NULL AUTO_INCREMENT,
  `sid` int(11) NOT NULL,
  `bid` int(11) NOT NULL,
  `request_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `return_date` date NOT NULL DEFAULT '0000-00-00',
  `returned_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE current_timestamp(),
  `is_returned` int(11) NOT NULL,
  `role` varchar(10) NOT NULL,
  `remark` varchar(500) DEFAULT NULL,
  `status` int(11) NOT NULL,
  PRIMARY KEY (`sbid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;


DROP TABLE IF EXISTS `books`;
CREATE TABLE `books` (
  `bid` int(11) NOT NULL AUTO_INCREMENT,
  `bno` varchar(20) NOT NULL,
  `plan_id` int(11) NOT NULL,
  `bcode` varchar(26) NOT NULL,
  `title` varchar(150) NOT NULL,
  `aname` varchar(150) NOT NULL,
  `publication` varchar(150) NOT NULL,
  `price` varchar(150) NOT NULL,
  `year_of_publication` varchar(150) DEFAULT NULL,
  `language` varchar(150) DEFAULT NULL,
  `edition` varchar(24) DEFAULT NULL,
  `shelf_id` int(11) DEFAULT NULL,
  `remark` varchar(500) DEFAULT NULL,
  `status` int(11) NOT NULL,
  PRIMARY KEY (`bid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;


DROP TABLE IF EXISTS `department`;
CREATE TABLE `department` (
  `did` int(11) NOT NULL AUTO_INCREMENT,
  `dname` varchar(150) NOT NULL,
  PRIMARY KEY (`did`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

INSERT INTO `department` (`did`, `dname`) VALUES
(1,	'B.C.A.Computer application'),
(2,	'M.C.A.Computer application'),
(3,	'Ph.D.');

DROP TABLE IF EXISTS `designation`;
CREATE TABLE `designation` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `designation` varchar(150) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

INSERT INTO `designation` (`id`, `designation`) VALUES
(1,	'Professor'),
(2,	'Assistant Professor'),
(3,	'Lecturer'),
(4,	'Guest Lecture');

DROP TABLE IF EXISTS `lib_planning`;
CREATE TABLE `lib_planning` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category` varchar(45) NOT NULL,
  `year` varchar(17) NOT NULL,
  `plan_status` varchar(33) NOT NULL,
  `billno` varchar(99) NOT NULL,
  `noofbooks` int(11) NOT NULL,
  `amount` int(11) NOT NULL,
  `balance` int(11) NOT NULL DEFAULT 0,
  `remark` varchar(500) DEFAULT NULL,
  `status` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;


DROP TABLE IF EXISTS `pln_commands`;
CREATE TABLE `pln_commands` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `plan_id` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `command` varchar(999) NOT NULL,
  `status` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;


DROP TABLE IF EXISTS `request_mgs`;
CREATE TABLE `request_mgs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `requester_id` int(11) NOT NULL,
  `receiver_id` int(11) NOT NULL,
  `messagee` text NOT NULL,
  `bcode` varchar(26) NOT NULL,
  `is_seen` int(11) NOT NULL,
  `is_seen_admin` int(11) NOT NULL,
  `req_role` varchar(12) NOT NULL,
  `rec_role` varchar(12) NOT NULL,
  `rec_date` date NOT NULL DEFAULT '0000-00-00',
  `remark` varchar(500) DEFAULT NULL,
  `status` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;


DELIMITER ;;

CREATE TRIGGER `prevent_duplicate_roles` BEFORE INSERT ON `request_mgs` FOR EACH ROW
BEGIN
    DECLARE existing_role VARCHAR(12);
    SELECT `req_role` INTO existing_role FROM `request_mgs` WHERE `requester_id` = NEW.`requester_id` AND `receiver_id` = NEW.`receiver_id` AND `req_role` = NEW.`req_role` AND `BCODE` = NEW.`bcode`  AND `is_seen`!=1;
    IF existing_role IS NOT NULL THEN
        SIGNAL SQLSTATE '45000'
        SET MESSAGE_TEXT = 'Already Requested';
    END IF;
END;;

DELIMITER ;

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
(1,	'GAC-CA LMS',	'In principle and reality, libraries are life-enhancing palaces of wonder',	'assets/logo.png',	2,	10,	7,	'smtp.gmail.com',	'465',	'LMS@gmail.com',	'NNNNNNNNN',	'ssl');

DROP TABLE IF EXISTS `shelf`;
CREATE TABLE `shelf` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `alamara` varchar(10) NOT NULL,
  `rack` varchar(10) NOT NULL,
  `count` varchar(10) NOT NULL,
  `side` varchar(10) NOT NULL,
  `barrowed_list` varchar(512) NOT NULL,
  `status` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;


DROP TABLE IF EXISTS `staff`;
CREATE TABLE `staff` (
  `sid` int(11) NOT NULL AUTO_INCREMENT,
  `regno` varchar(24) NOT NULL,
  `spass` varchar(150) NOT NULL,
  `sname` varchar(150) NOT NULL,
  `semail` varchar(200) NOT NULL,
  `did` int(11) NOT NULL,
  `designid` int(11) NOT NULL,
  `contact` varchar(150) NOT NULL,
  `gender` enum('Male','Female') NOT NULL,
  `image` varchar(300) NOT NULL,
  `Validity` date DEFAULT NULL,
  `remark` varbinary(500) DEFAULT NULL,
  `role` char(20) NOT NULL,
  PRIMARY KEY (`sid`),
  KEY `id` (`designid`),
  KEY `did` (`did`),
  CONSTRAINT `staff_ibfk_2` FOREIGN KEY (`designid`) REFERENCES `designation` (`id`),
  CONSTRAINT `staff_ibfk_4` FOREIGN KEY (`did`) REFERENCES `department` (`did`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;


DROP TABLE IF EXISTS `staff_department`;
CREATE TABLE `staff_department` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `s_d_name` varchar(64) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

INSERT INTO `staff_department` (`id`, `s_d_name`) VALUES
(1,	'Computer Application');

DROP TABLE IF EXISTS `students`;
CREATE TABLE `students` (
  `st_id` int(11) NOT NULL AUTO_INCREMENT,
  `regno` varchar(24) NOT NULL,
  `sname` varchar(150) NOT NULL,
  `spass` varchar(150) NOT NULL,
  `gender` enum('boy','girl','male','female') NOT NULL,
  `stemail` varchar(200) DEFAULT NULL,
  `Contact` varchar(12) DEFAULT NULL,
  `did` int(11) NOT NULL,
  `year` varchar(20) NOT NULL,
  `shift` varchar(5) NOT NULL,
  `image` varchar(150) NOT NULL,
  `Validity` date DEFAULT NULL,
  `remark` varchar(500) DEFAULT NULL,
  `role` char(20) NOT NULL,
  PRIMARY KEY (`st_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;


DROP TABLE IF EXISTS `tbl_query`;
CREATE TABLE `tbl_query` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `query_id` varchar(22) NOT NULL,
  `user_id` int(11) NOT NULL,
  `query` varchar(999) NOT NULL,
  `role` varchar(22) NOT NULL,
  `is_resolved` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;


-- 2023-10-29 06:24:51
