-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 04, 2024 at 05:31 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dearday`
--

-- --------------------------------------------------------

--
-- Table structure for table `daily_mood`
--

CREATE TABLE `daily_mood` (
  `mood_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `mood` varchar(255) NOT NULL,
  `time` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `daily_mood`
--

INSERT INTO `daily_mood` (`mood_id`, `user_id`, `mood`, `time`) VALUES
(1, 1, 'very good', '2023-12-31 17:00:00'),
(2, 1, 'good', '2024-01-04 17:00:00'),
(3, 1, 'pretty normal', '2024-01-09 17:00:00'),
(4, 1, 'bad', '2024-01-14 17:00:00'),
(5, 1, 'very bad', '2024-01-19 17:00:00'),
(6, 1, 'good', '2024-01-24 17:00:00'),
(7, 1, 'good', '2024-02-02 17:00:00'),
(8, 1, 'very bad', '2024-02-07 17:00:00'),
(9, 1, 'pretty normal', '2024-02-12 17:00:00'),
(10, 1, 'bad', '2024-02-17 17:00:00'),
(11, 1, 'very good', '2024-02-22 17:00:00'),
(12, 1, 'bad', '2024-03-01 17:00:00'),
(13, 1, 'pretty normal', '2024-03-05 17:00:00'),
(14, 1, 'good', '2024-03-10 17:00:00'),
(15, 1, 'very good', '2024-03-15 17:00:00'),
(16, 1, 'very bad', '2024-03-20 17:00:00'),
(17, 1, 'good', '2024-03-25 17:00:00'),
(18, 1, 'good', '2024-06-30 03:18:04'),
(19, 1, 'good', '2024-07-01 03:23:15'),
(20, 1, 'good', '2024-07-02 14:30:24'),
(21, 1, 'pretty normal', '2024-07-03 00:15:14'),
(22, 54, 'very bad', '2024-07-03 01:23:32'),
(23, 77, 'very good', '2024-07-03 03:56:01'),
(24, 78, 'good', '2024-07-03 04:10:57'),
(25, 1, 'bad', '2024-07-04 03:19:32');

-- --------------------------------------------------------

--
-- Table structure for table `face_results`
--

CREATE TABLE `face_results` (
  `record_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `angry` decimal(5,2) DEFAULT NULL,
  `disgusted` decimal(5,2) DEFAULT NULL,
  `fearful` decimal(5,2) DEFAULT NULL,
  `happy` decimal(5,2) DEFAULT NULL,
  `neutral` decimal(5,2) DEFAULT NULL,
  `sad` decimal(5,2) DEFAULT NULL,
  `surprised` decimal(5,2) DEFAULT NULL,
  `time_stamp` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `face_results`
--

INSERT INTO `face_results` (`record_id`, `user_id`, `angry`, `disgusted`, `fearful`, `happy`, `neutral`, `sad`, `surprised`, `time_stamp`) VALUES
(1, 1, 0.00, 0.00, 0.00, 0.00, 1.00, 0.00, 0.00, '2024-06-14 02:29:47'),
(2, 1, 0.05, 0.02, 0.00, 0.20, 0.33, 0.08, 0.32, '2024-06-14 02:30:47'),
(3, 54, 0.02, 0.00, 0.00, 0.19, 0.78, 0.01, 0.00, '2024-06-14 02:34:12'),
(4, 54, 0.00, 0.01, 0.00, 0.03, 0.88, 0.02, 0.06, '2024-06-14 04:09:04'),
(5, 1, 0.04, 0.01, 0.00, 0.13, 0.74, 0.05, 0.02, '2024-06-14 07:38:10'),
(6, 1, 0.11, 0.01, 0.00, 0.42, 0.44, 0.01, 0.01, '2024-06-14 07:42:36'),
(7, 1, 0.06, 0.00, 0.00, 0.49, 0.41, 0.03, 0.01, '2024-06-14 07:49:40'),
(8, 1, 0.01, 0.00, 0.00, 0.01, 0.83, 0.14, 0.02, '2024-06-18 21:06:54'),
(9, 1, 0.00, 0.00, 0.00, 0.47, 0.52, 0.00, 0.00, '2024-06-24 06:14:27'),
(10, 1, 0.00, 0.00, 0.00, 0.48, 0.52, 0.00, 0.00, '2024-06-24 06:14:27'),
(11, 1, 0.00, 0.00, 0.00, 0.29, 0.36, 0.20, 0.15, '2024-06-29 22:10:37'),
(12, 1, 0.00, 0.00, 0.00, 0.47, 0.45, 0.07, 0.00, '2024-06-30 22:21:28'),
(13, 1, 0.00, 0.01, 0.00, 0.46, 0.47, 0.04, 0.02, '2024-07-01 07:16:27'),
(14, 1, 0.00, 0.00, 0.00, 0.44, 0.53, 0.00, 0.02, '2024-07-01 12:09:49'),
(15, 1, 0.00, 0.00, 0.00, 0.01, 0.99, 0.00, 0.00, '2024-07-02 01:38:02'),
(16, 1, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '2024-07-02 01:40:58'),
(17, 1, 0.00, 0.00, 0.00, 0.02, 0.98, 0.00, 0.00, '2024-07-02 01:42:18'),
(18, 1, 0.03, 0.02, 0.01, 0.40, 0.49, 0.04, 0.01, '2024-07-02 02:35:08'),
(19, 1, 0.09, 0.01, 0.00, 0.45, 0.37, 0.03, 0.04, '2024-07-02 02:38:03'),
(20, 1, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '2024-07-02 02:38:26'),
(21, 1, 0.01, 0.00, 0.00, 0.08, 0.69, 0.22, 0.00, '2024-07-02 02:38:50'),
(22, 1, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '2024-07-02 02:39:28'),
(23, 1, 0.02, 0.03, 0.00, 0.08, 0.68, 0.10, 0.08, '2024-07-02 02:42:16'),
(24, 1, 0.00, 0.00, 0.00, 0.10, 0.86, 0.02, 0.01, '2024-07-02 02:46:21'),
(25, 1, 0.00, 0.00, 0.00, 0.30, 0.70, 0.00, 0.00, '2024-07-02 04:07:14'),
(26, 1, 0.01, 0.00, 0.00, 0.27, 0.65, 0.07, 0.00, '2024-07-02 04:35:16'),
(27, 1, 0.03, 0.00, 0.00, 0.38, 0.38, 0.16, 0.04, '2024-07-02 04:44:31'),
(28, 1, 0.04, 0.00, 0.00, 0.01, 0.94, 0.00, 0.01, '2024-07-02 04:50:28'),
(29, 1, 0.02, 0.02, 0.00, 0.47, 0.41, 0.08, 0.00, '2024-07-02 09:28:58'),
(30, 1, 0.03, 0.00, 0.00, 0.29, 0.53, 0.02, 0.12, '2024-07-02 09:29:25'),
(31, 1, 0.15, 0.05, 0.00, 0.34, 0.32, 0.12, 0.02, '2024-07-02 19:15:55'),
(32, 77, 0.01, 0.00, 0.00, 0.00, 0.99, 0.00, 0.00, '2024-07-03 03:58:29'),
(33, 77, 0.01, 0.00, 0.00, 0.00, 0.99, 0.00, 0.00, '2024-07-03 04:00:17'),
(34, 78, 0.01, 0.00, 0.00, 0.01, 0.96, 0.02, 0.00, '2024-07-03 04:29:25'),
(35, 1, 0.02, 0.00, 0.00, 0.75, 0.21, 0.02, 0.00, '2024-07-04 03:20:59');

-- --------------------------------------------------------

--
-- Table structure for table `quiz_results`
--

CREATE TABLE `quiz_results` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `depression` decimal(5,2) DEFAULT NULL,
  `generalized_anxiety` decimal(5,2) DEFAULT NULL,
  `social_anxiety` decimal(5,2) DEFAULT NULL,
  `adhd` decimal(5,2) DEFAULT NULL,
  `gender_dysphoria` decimal(5,2) DEFAULT NULL,
  `ptsd` decimal(5,2) DEFAULT NULL,
  `timestamp` datetime DEFAULT NULL,
  `quiz_id` varchar(7) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `quiz_results`
--

INSERT INTO `quiz_results` (`id`, `user_id`, `depression`, `generalized_anxiety`, `social_anxiety`, `adhd`, `gender_dysphoria`, `ptsd`, `timestamp`, `quiz_id`) VALUES
(1, 54, 45.00, 50.00, 45.00, 40.00, 40.00, 45.00, '2024-06-14 11:50:51', 'F000001'),
(2, 1, 40.00, 45.00, 40.00, 40.00, 40.00, 40.00, '2024-06-14 12:12:20', 'W000002'),
(3, 1, 50.00, 50.00, 45.00, 50.00, 45.00, 40.00, '2024-06-14 14:36:09', 'Z000003'),
(4, 1, 35.00, 40.00, 45.00, 40.00, 30.00, 40.00, '2024-06-14 14:44:15', 'M000004'),
(5, 1, 60.00, 60.00, 45.00, 50.00, 35.00, 45.00, '2024-06-19 04:08:17', 'S000005'),
(6, 1, 35.00, 40.00, 45.00, 60.00, 40.00, 35.00, '2024-06-19 04:09:31', 'C000006'),
(7, 1, 50.00, 45.00, 50.00, 30.00, 55.00, 50.00, '2024-07-01 05:24:07', 'P000007'),
(8, 1, 30.00, 30.00, 25.00, 35.00, 20.00, 30.00, '2024-07-03 02:19:01', 'C000008'),
(9, 77, 40.00, 35.00, 40.00, 45.00, 40.00, 35.00, '2024-07-03 10:59:23', 'L000009'),
(10, 78, 15.00, 30.00, 30.00, 30.00, 15.00, 30.00, '2024-07-03 11:44:37', 'J000010'),
(11, 78, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '2024-07-03 11:45:05', 'Y000011'),
(12, 78, 5.00, 0.00, 0.00, 0.00, 0.00, 0.00, '2024-07-03 11:45:21', 'P000012'),
(13, 78, 10.00, 10.00, 0.00, 5.00, 10.00, 5.00, '2024-07-03 11:47:49', 'L000013'),
(14, 78, 30.00, 30.00, 20.00, 20.00, 15.00, 20.00, '2024-07-03 11:58:50', 'P000014'),
(15, 1, 10.00, 20.00, 20.00, 10.00, 5.00, 10.00, '2024-07-04 10:22:18', 'W000015');

--
-- Triggers `quiz_results`
--
DELIMITER $$
CREATE TRIGGER `before_quiz_result_insert` BEFORE INSERT ON `quiz_results` FOR EACH ROW BEGIN
    DECLARE next_id INT;
    DECLARE next_char CHAR(1);

    -- Get the next auto-increment id
    SELECT AUTO_INCREMENT INTO next_id
    FROM information_schema.TABLES
    WHERE TABLE_SCHEMA = DATABASE() AND TABLE_NAME = 'quiz_results';

    -- Get the next character (A-Z)
    SET next_char = CHAR(FLOOR(RAND() * 26) + 65);

    -- Set the quiz_id
    SET NEW.quiz_id = CONCAT(next_char, LPAD(next_id, 6, '0'));
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_journal`
--

CREATE TABLE `tbl_journal` (
  `entry_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `timestamp` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_journal`
--

INSERT INTO `tbl_journal` (`entry_id`, `user_id`, `title`, `content`, `timestamp`) VALUES
(2, 2, 'Morning Thoughts', 'Woke up feeling fresh and positive. Looking forward to a productive day.', '2024-06-13 09:00:00'),
(3, 3, 'Busy Afternoon', 'The afternoon was hectic, but I managed to complete all my tasks.', '2024-06-13 14:00:00'),
(4, 4, 'Evening Relaxation', 'Spent the evening reading a book and unwinding. Felt very calm and peaceful.', '2024-06-13 20:00:00'),
(5, 5, 'Unexpected Joy', 'Had a surprise visit from an old friend, which made my day very special.', '2024-06-13 18:00:00'),
(6, 6, 'Morning Meditation', 'Started the day with meditation. Feeling refreshed and focused.', '2024-06-14 07:30:00'),
(7, 7, 'Team Meeting', 'Had an important meeting with the team. Discussed new project strategies.', '2024-06-14 10:00:00'),
(8, 8, 'Family Gathering', 'Spent the evening with family. Shared lots of laughter and stories.', '2024-06-14 19:00:00'),
(9, 9, 'Outdoor Adventure', 'Went hiking with friends. Enjoyed the beautiful nature and stunning views.', '2024-06-14 08:00:00'),
(10, 10, 'Cooking Experiment', 'Tried a new recipe for dinner. Surprisingly delicious!', '2024-06-14 18:30:00'),
(12, 2, 'Lunch with Friends', 'Had a great time catching up with old friends over lunch.', '2024-06-14 13:00:00'),
(13, 3, 'Late Night Coding', 'Worked on a coding project until late. Making good progress.', '2024-06-14 23:30:00'),
(14, 4, 'Movie Night', 'Watched a movie marathon with popcorn. Perfect way to unwind.', '2024-06-14 21:00:00'),
(15, 5, 'Art Workshop', 'Attended an art workshop and learned new techniques. Feeling inspired!', '2024-06-14 16:00:00'),
(16, 11, 'Morning Run', 'Started the day with a refreshing morning run in the park.', '2024-06-15 06:00:00'),
(17, 12, 'New Project Kickoff', 'Exciting kickoff meeting for a new project. Lots of brainstorming!', '2024-06-15 09:30:00'),
(18, 13, 'Guitar Practice', 'Practiced guitar for an hour. Music always lifts my spirits.', '2024-06-15 16:00:00'),
(19, 14, 'Beach Day', 'Spent the day at the beach with friends. Sun, sand, and good vibes!', '2024-06-15 11:00:00'),
(20, 15, 'Cooking Challenge', 'Challenged myself to cook a gourmet meal. Turned out better than expected!', '2024-06-15 19:00:00'),
(21, 6, 'Creative Writing', 'Wrote a short story inspired by a dream. Writing can be so therapeutic.', '2024-06-15 14:30:00'),
(22, 7, 'Workout Session', 'Hit the gym for a intense workout session. Feeling pumped!', '2024-06-15 07:30:00'),
(23, 8, 'Quiet Evening', 'Enjoyed a quiet evening reading my favorite book. Blissful.', '2024-06-15 20:00:00'),
(24, 9, 'Exploring Nature', 'Explored a nearby forest trail. Nature has a way of calming the mind.', '2024-06-15 10:00:00'),
(25, 10, 'DIY Project', 'Started a DIY project at home. Let\'s see how it turns out!', '2024-06-15 17:30:00'),
(27, 1, 'Hello', 'world hhhh0,.o,\n kl,sdlknsdfko ]\nlmpflcn ', '2024-06-19 04:10:15'),
(29, 54, 'jjjj', 'ddd', '2024-06-19 05:26:22'),
(31, 54, 'HHHHH', 'HHHHHHHHHHHHHHHHHHHHHHH', '2024-06-21 12:39:52'),
(34, 1, 'Ahmed', 'Alhwyji', '2024-06-24 15:44:16'),
(35, 1, 'Hello', 'iokbnjk ', '2024-06-29 09:52:35'),
(37, 1, 'nlkd', 'I was happy', '2024-07-03 02:16:39'),
(38, 1, 'ojmfd', 'dsfpmo', '2024-07-03 05:40:05'),
(39, 1, 'hellp', 'kd', '2024-07-03 05:49:40'),
(40, 1, 'hh', 'fd', '2024-07-02 23:51:03'),
(41, 1, 'jiohnio', 'adnoi', '2024-07-03 10:52:28'),
(42, 77, 'hi', 'I am happy today', '2024-07-03 10:57:42'),
(43, 77, 'knd', 'kl xvc', '2024-07-03 10:58:07'),
(44, 78, 'hh', 'gg', '2024-07-03 11:29:58'),
(45, 1, 'hh', 'hh', '2024-07-03 13:03:56');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user`
--

CREATE TABLE `tbl_user` (
  `user_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `birth_date` date NOT NULL,
  `city` varchar(255) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `timestamp` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_user`
--

INSERT INTO `tbl_user` (`user_id`, `name`, `username`, `password`, `birth_date`, `city`, `gender`, `timestamp`) VALUES
(1, 'Alhwyji', 'alhwyji@gmail.com', '32250170a0dca92d53ec9624f336ca24', '1990-01-01', 'Jakarta', 'Male', '2023-03-21 17:00:00'),
(2, 'Siti Nurhaliza', 'siti.nurhaliza@example.com', '73a054cc528f91ca1bbdda3589b6a22d', '1992-02-02', 'Surabaya', 'Female', '2024-10-27 17:00:00'),
(3, 'Agus Kurniawan', 'agus.kurniawan@example.com', 'ba1b5d9d26dd50164b5fb53a948e5cdf', '1988-03-03', 'Bandung', 'Male', '2023-06-21 17:00:00'),
(4, 'Rina Mariani', 'rina.mariani@example.com', '8be94dd00b806f02ba760b745f7294eb', '1995-04-04', 'Yogyakarta', 'Female', '2023-11-19 17:00:00'),
(5, 'Andi Pratama', 'andi.pratama@example.com', '21660a97bbe052789eb651de2200a4aa', '1985-05-05', 'Medan', 'Male', '2024-01-05 17:00:00'),
(6, 'Linda Wijaya', 'linda.wijaya@example.com', '83ed7a0f8480b8912cf5c858f64565eb', '1993-06-10', 'Semarang', 'Female', '2023-05-31 17:00:00'),
(7, 'Ahmad Abdullah', 'ahmad.abdullah@example.com', 'a2135aceebfa678a7e501e300dcb728f', '1987-09-15', 'Palembang', 'Male', '2024-01-11 17:00:00'),
(8, 'Dewi Susanti', 'dewi.susanti@example.com', 'baf012744ea7b9018da863b739b17a48', '1991-11-20', 'Makassar', 'Female', '2024-11-25 17:00:00'),
(9, 'Rudi Setiawan', 'rudi.setiawan@example.com', 'cae6c0e4ca5c7b588c562460aedf92ff', '1984-03-25', 'Balikpapan', 'Male', '2023-06-08 17:00:00'),
(10, 'Rina Fitriani', 'rina.fitriani@example.com', 'aaee926e9e4c88e994590c9a10abbe85', '1998-08-05', 'Padang', 'Female', '2023-06-20 17:00:00'),
(11, 'Rizky Pratama', 'rizky.pratama@example.com', '2345906eebef5fd57c36049e309014ff', '1990-12-12', 'Jakarta', 'Male', '2024-01-11 17:00:00'),
(12, 'Lina Susilo', 'lina.susilo@example.com', 'aa6b8b42b377435849ef6aca57e8c9c8', '1986-05-20', 'Surabaya', 'Female', '2024-10-01 17:00:00'),
(13, 'Hendra Gunawan', 'hendra.gunawan@example.com', 'c539dfc0368199dd4131d7139171c79f', '1993-08-17', 'Bandung', 'Male', '2024-09-03 17:00:00'),
(14, 'Siska Wijaya', 'siska.wijaya@example.com', 'd2feb20b125b5376aef0ead76092738b', '1998-02-28', 'Yogyakarta', 'Female', '2024-02-14 17:00:00'),
(15, 'Bayu Nugroho', 'bayu.nugroho@example.com', 'ab9b265c01c0f85f49350c099a3e0519', '1989-07-07', 'Medan', 'Male', '2023-08-02 17:00:00'),
(16, 'Dimas Wibowo', 'dimas.wibowo@example.com', '9bf565e511c9de931f2522f6287f0ea2', '1995-03-03', 'Semarang', 'Male', '2024-07-23 17:00:00'),
(17, 'Rina Anggraini', 'rina.anggraini@example.com', '40952ca8917197540dbabca15667fc61', '1994-11-11', 'Palembang', 'Female', '2023-01-18 17:00:00'),
(18, 'Doni Setiawan', 'doni.setiawan@example.com', '13e75e263ea9407c5b6dc204c92cfc5a', '1997-04-04', 'Makassar', 'Male', '2024-07-22 17:00:00'),
(19, 'Nisa Rahmawati', 'nisa.rahmawati@example.com', 'a02ec64cecaa5b3ca7f73995cbc3f8be', '1999-12-12', 'Pontianak', 'Female', '2024-08-26 17:00:00'),
(20, 'Bayu Setiawan', 'bayu.setiawan@example.com', '9f776095941badf4971a5da5780d869a', '1991-09-09', 'Banjarmasin', 'Male', '2024-08-07 17:00:00'),
(21, 'Ardi Wijaya', 'ardi.wijaya@example.com', '0bb43d439d4d8238272497c7bff470a9', '2000-06-06', 'Samarinda', 'Male', '2024-01-16 17:00:00'),
(22, 'Dinda Sari', 'dinda.sari@example.com', 'c43efc8da9461bb7d07cd34f79bcdca7', '1996-01-01', 'Manado', 'Female', '2023-05-31 17:00:00'),
(23, 'Fajar Putra', 'fajar.putra@example.com', 'e23681369d2713165a270ab8850da83f', '2002-08-08', 'Mataram', 'Male', '2023-12-08 17:00:00'),
(24, 'Rina Wulandari', 'rina.wulandari@example.com', '1b6df9e3a754ea7d8631626063b30e8e', '2001-05-05', 'Kupang', 'Female', '2024-06-10 17:00:00'),
(25, 'Andre Setiawan', 'andre.setiawan@example.com', '8279309a6fa82723da732043c3620f81', '1997-02-02', 'Ambon', 'Male', '2023-05-31 17:00:00'),
(26, 'Yuni Astuti', 'yuni.astuti@example.com', 'bdbc4dfaffcdb9582cf9f7ee23dd5455', '1992-10-10', 'Pekanbaru', 'Female', '2024-09-27 17:00:00'),
(27, 'Chandra Wijaya', 'chandra.wijaya@example.com', '9d89a313379eae58fd2f87393657fdc2', '1988-07-07', 'Banda Aceh', 'Male', '2024-06-18 17:00:00'),
(28, 'Megawati Sari', 'megawati.sari@example.com', '3e9898a9c46a58b4b08961eadd39285d', '2003-03-03', 'Jayapura', 'Female', '2023-02-09 17:00:00'),
(29, 'Agus Setiawan', 'agus.setiawan@example.com', '0c329dc3feaadf9aed4dcae036b49ca9', '1998-01-01', 'Denpasar', 'Male', '2023-02-24 17:00:00'),
(30, 'Intan Permata', 'intan.permata@example.com', 'f40266d7419bb504b4bf83143a40a385', '1990-04-04', 'Pangkal Pinang', 'Female', '2023-06-05 17:00:00'),
(31, 'Hendra Gunawan', 'hendra1.gunawan@example.com', '546dcaaa105a758b5072c9d04fc1b581', '1993-07-07', 'Surakarta', 'Male', '2024-09-06 17:00:00'),
(32, 'Siti Nurlela', 'siti.nurlela@example.com', 'f6bb0d5fe5c52586f75bca871ab902c2', '1995-08-08', 'Cirebon', 'Female', '2024-02-23 17:00:00'),
(33, 'Adi Nugroho', 'adi.nugroho@example.com', 'bfc2c9047ff61804d99ae8b44eef4fb4', '1989-09-09', 'Padang', 'Male', '2023-09-05 17:00:00'),
(34, 'Rini Susanti', 'rini.susanti@example.com', '88691bcead13c6914e9fbbc0bc30a0a8', '1991-10-10', 'Bandar Lampung', 'Female', '2024-12-16 17:00:00'),
(35, 'Dodi Pranoto', 'dodi.pranoto@example.com', '1814e951f37992862c13948080118973', '1987-11-11', 'Tanjungkarang', 'Male', '2024-10-05 17:00:00'),
(36, 'Lia Fitriani', 'lia.fitriani@example.com', 'b3ed48555a989b8ee27f613f7b5724dd', '1996-12-12', 'Medan', 'Female', '2023-12-08 17:00:00'),
(37, 'Bambang Santoso', 'bambang.santoso@example.com', '111f34713d8baa1e013c6257c44bbb7d', '1994-01-01', 'Bengkulu', 'Male', '2024-05-25 17:00:00'),
(38, 'Sari Dewi', 'sari.dewi@example.com', 'c438e61510437111fef084e10d30bdb1', '1990-02-02', 'Jambi', 'Female', '2023-03-09 17:00:00'),
(39, 'Arief Hidayat', 'arief.hidayat@example.com', '53804263176d1689755aca449091ec37', '1988-03-03', 'Pekalongan', 'Male', '2023-09-26 17:00:00'),
(40, 'Dewi Lestari', 'dewi.lestari@example.com', 'ab7229a90ce31c1dcebfc398088e0b32', '1992-04-04', 'Balikpapan', 'Female', '2024-02-15 17:00:00'),
(41, 'Joko Susilo', 'joko.susilo@example.com', '33ec3a0d64a99ecb1fd93b3d7dc85201', '1985-05-05', 'Semarang', 'Male', '2024-06-01 17:00:00'),
(42, 'Nina Mariani', 'nina.mariani@example.com', 'a532aceac8bc8a39728334e8abbd03d1', '1987-06-06', 'Yogyakarta', 'Female', '2024-09-20 17:00:00'),
(43, 'Budi Cahyono', 'budi.cahyono@example.com', '32c9f9160c532f7ff3b3d24c6aa39311', '1993-07-07', 'Malang', 'Male', '2023-05-11 17:00:00'),
(44, 'Ratna Dewi', 'ratna.dewi@example.com', 'bf604a61c2eb8d42ee59acda7897d2cc', '1991-08-08', 'Bandung', 'Female', '2023-08-18 17:00:00'),
(45, 'Eko Prasetyo', 'eko.prasetyo@example.com', '6cf19fd9826df7e313b9d96874445db7', '1989-09-09', 'Surabaya', 'Male', '2023-01-27 17:00:00'),
(46, 'Dewi Susanti', 'dewi.susanti1@example.com', '1d3b067b9311546b1782a9f2224819f1', '1995-10-10', 'Semarang', 'Female', '2023-06-25 17:00:00'),
(47, 'Ferianto Nugroho', 'ferianto.nugroho@example.com', '60dfbf6aeb29c6735cb3b5fa5c0f8878', '1992-11-11', 'Surabaya', 'Male', '2023-03-11 17:00:00'),
(48, 'Maya Fitri', 'maya.fitri@example.com', '07dd0947f79e70f599548cdb5ef4f10a', '1990-12-12', 'Bandung', 'Female', '2024-07-06 17:00:00'),
(49, 'Rudi Hartono', 'rudi.hartono@example.com', '697774cf6e19d858816faf50d425dd8c', '1988-01-01', 'Yogyakarta', 'Male', '2023-12-31 17:00:00'),
(50, 'Siska Amelia', 'siska.amelia@example.com', 'b17e6598ed4c70c77990147b89130d76', '1993-02-02', 'Malang', 'Female', '2023-06-15 17:00:00'),
(51, 'Hadi Santoso', 'hadi.santoso@example.com', 'd6a2b0d9f17a06a1fef1853022c2d8d0', '1989-03-03', 'Jakarta', 'Male', '2024-04-11 17:00:00'),
(52, 'Dewi Lestari', 'dewi12.lestari@example.com', '7594f1a1866456c779271af7f4dc6b8b', '1991-04-04', 'Surabaya', 'Female', '2024-01-14 17:00:00'),
(53, 'Firman Setiawan', 'firman.setiawan@example.com', 'a41efd235d2a90153fcfe74f8216d029', '1997-05-05', 'Bandung', 'Male', '2024-05-05 17:00:00'),
(54, 'Lina Anggraeni', 'lina.anggraeni@example.com', 'bb1f4de05a2e31acfa99c00028d69ab2', '1994-06-06', 'Medan', 'Female', '2024-08-11 17:00:00'),
(55, 'Rahmat Hidayat', 'rahmat.hidayat@example.com', '507a193c798cc27611bfc323f9a36ae3', '1996-07-07', 'Yogyakarta', 'Male', '2023-01-14 17:00:00'),
(56, 'Santi Wijaya', 'santi.wijaya@example.com', 'ce10502abd044ae3a15a12c8ca389b8c', '1998-08-08', 'Surabaya', 'Female', '2024-05-06 17:00:00'),
(57, 'Hendro Prasetyo', 'hendro.prasetyo@example.com', '812df3fcd9e7ae8f4c06db8647dd8ab2', '1990-09-09', 'Bandung', 'Male', '2023-08-17 17:00:00'),
(58, 'Siska Rahayu', 'siska.rahayu@example.com', 'bf5d744e2b3bdfeaafc08d9c5a5e0460', '1988-10-10', 'Jakarta', 'Female', '2024-02-04 17:00:00'),
(59, 'Joko Santoso', 'joko.santoso@example.com', 'c39713342bcedcb148216391e1a7598b', '1992-11-11', 'Surabaya', 'Male', '2024-08-06 17:00:00'),
(60, 'Dewi Cahyaningrum', 'dewi1.cahyaningrum@example.com', '8fb1c3b324e04afd3bb7ae8f17eb9529', '1994-12-12', 'Yogyakarta', 'Female', '2023-09-17 17:00:00'),
(61, 'Agus Setiawan', 'agus1.setiawan@example.com', '09ba6096ce412e1b5fcae3808c1e3a97', '1987-01-01', 'Bandung', 'Male', '2023-10-06 17:00:00'),
(62, 'Siti Rahmawati', 'siti.rahmawati@example.com', 'beab7df7bb370c0aa6a12dfd74b264c9', '1989-02-02', 'Surabaya', 'Female', '2024-09-08 17:00:00'),
(63, 'Bambang Wijaya', 'bambang.wijaya@example.com', 'a1056e27d672d5ffc4a4acbf40366f68', '1995-03-03', 'Jakarta', 'Male', '2023-02-27 17:00:00'),
(64, 'Rina Kartika', 'rina.kartika@example.com', 'a20ed44df7cafaf1be107916fe691c99', '1993-04-04', 'Bandung', 'Female', '2024-09-20 17:00:00'),
(65, 'Andi Kusuma', 'andi.kusuma@example.com', '48775b56d88433ed13f1b5fd64b9f4f1', '1990-05-05', 'Surabaya', 'Male', '2023-02-18 17:00:00'),
(66, 'Dewi Fitriani', 'dewi1.fitriani@example.com', 'c2c01283ec1e969f07e415efc04a27fd', '1997-06-06', 'Yogyakarta', 'Female', '2024-07-05 17:00:00'),
(67, 'Joko Susilo', 'joko3.susilo@example.com', 'f802363907c0fe72bafcfea2422772bd', '1992-07-07', 'Jakarta', 'Male', '2024-02-26 17:00:00'),
(68, 'Rini Astuti', 'rini.astuti@example.com', '6aec95cf09b02b32df911d11211c3123', '1988-08-08', 'Surabaya', 'Female', '2024-03-30 17:00:00'),
(69, 'Budi Santoso', 'budi3.santoso@example.com', '68d37fd86e3150fcb670471b8bfc37a9', '1994-09-09', 'Bandung', 'Male', '2023-10-07 17:00:00'),
(70, 'Lia Permata', 'lia.permata@example.com', '16bcfcdc644243172d81f1e03182575b', '1996-10-10', 'Yogyakarta', 'Female', '2023-02-04 17:00:00'),
(71, 'Ahmad Wijaya', 'ahmad.wijaya@example.com', 'dd004ca62c7e573ecf848995cd793c1d', '1991-11-11', 'Surabaya', 'Male', '2023-03-05 17:00:00'),
(72, 'Sari Susanti', 'sari.susanti@example.com', 'a24b7c62600fe202b174aa2816b97201', '1989-12-12', 'Jakarta', 'Female', '2023-08-06 17:00:00'),
(73, 'Eko Nugroho', 'eko.nugroho@example.com', '2433856a771c24523024c34a14045443', '1995-01-01', 'Bandung', 'Male', '2023-06-19 17:00:00'),
(74, 'Lina Setiawati', 'lina.setiawati@example.com', 'e830046eb4903149b7e92697435a6171', '1993-02-02', 'Surabaya', 'Female', '2023-07-12 17:00:00'),
(75, 'Hendra Pratama', 'hendra.pratama@example.com', 'a2eb94cdef408fb1fa0631dac8b70054', '1990-03-03', 'Yogyakarta', 'Male', '2024-04-01 17:00:00'),
(76, 'HH', 'hh@example.com', '80c9ef0fb86369cd25f90af27ef53a9e', '2024-07-12', 'Malang', 'female', '2023-09-03 17:00:00'),
(77, 'check', 'check@example.com', '80c9ef0fb86369cd25f90af27ef53a9e', '2024-07-24', 'Batam', 'male', '2024-08-13 17:00:00'),
(78, 'v', 'check1@example.com', '80c9ef0fb86369cd25f90af27ef53a9e', '2024-07-25', 'Malang', 'male', '2023-01-28 17:00:00'),
(79, 'hhhh', 'hhhh@example.com', '80c9ef0fb86369cd25f90af27ef53a9e', '2024-07-17', 'Medan', 'female', '2024-07-03 09:04:59'),
(80, 'test12', 'teast12@example.com', '80c9ef0fb86369cd25f90af27ef53a9e', '2024-07-18', 'Batam', 'female', '2024-07-03 09:15:11'),
(81, 'DALE', 'dale1@example.com', '80c9ef0fb86369cd25f90af27ef53a9e', '2024-07-18', 'Tasikmalaya', 'male', '2024-07-04 03:10:06');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `daily_mood`
--
ALTER TABLE `daily_mood`
  ADD PRIMARY KEY (`mood_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `face_results`
--
ALTER TABLE `face_results`
  ADD PRIMARY KEY (`record_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `quiz_results`
--
ALTER TABLE `quiz_results`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `tbl_journal`
--
ALTER TABLE `tbl_journal`
  ADD PRIMARY KEY (`entry_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `daily_mood`
--
ALTER TABLE `daily_mood`
  MODIFY `mood_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `face_results`
--
ALTER TABLE `face_results`
  MODIFY `record_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `quiz_results`
--
ALTER TABLE `quiz_results`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `tbl_journal`
--
ALTER TABLE `tbl_journal`
  MODIFY `entry_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=82;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `daily_mood`
--
ALTER TABLE `daily_mood`
  ADD CONSTRAINT `daily_mood_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `tbl_user` (`user_id`);

--
-- Constraints for table `face_results`
--
ALTER TABLE `face_results`
  ADD CONSTRAINT `face_results_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `tbl_user` (`user_id`);

--
-- Constraints for table `quiz_results`
--
ALTER TABLE `quiz_results`
  ADD CONSTRAINT `quiz_results_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `tbl_user` (`user_id`);

--
-- Constraints for table `tbl_journal`
--
ALTER TABLE `tbl_journal`
  ADD CONSTRAINT `tbl_journal_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `tbl_user` (`user_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
