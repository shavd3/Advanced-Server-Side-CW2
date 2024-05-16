-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 15, 2024 at 11:53 PM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `holi`
--

-- --------------------------------------------------------

--
-- Table structure for table `answers`
--

CREATE TABLE `answers` (
  `AnswerId` int(255) NOT NULL,
  `UserId` int(255) NOT NULL,
  `QuestionId` int(255) NOT NULL,
  `AnswerBody` varchar(1000) NOT NULL,
  `Timestamp` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `answers`
--

INSERT INTO `answers` (`AnswerId`, `UserId`, `QuestionId`, `AnswerBody`, `Timestamp`) VALUES
(1, 2, 31, 'sample answer', '2024-05-11 12:44:51'),
(2, 2, 31, 'sample answer', '2024-05-11 12:44:57'),
(3, 2, 40, 'sample answer', '2024-05-12 02:28:09'),
(4, 2, 40, 'sample answer', '2024-05-12 02:37:44'),
(5, 5, 40, 'sample answer', '2024-05-12 03:37:24'),
(6, 2, 40, 'sample answer', '2024-05-12 05:26:27'),
(7, 5, 39, 'Responsive web design is an approach to building websites that ensures optimal viewing and interaction experiences across various devices and screen sizes.', '2024-05-12 16:36:36'),
(8, 3, 39, 'It involves using flexible layouts, fluid grids, and media queries to adapt the layout and design of a website dynamically based on the device\'s screen size, orientation, and capabilities.', '2024-05-12 16:36:43'),
(9, 2, 39, 'Responsive web design helps improve user experience, reduces bounce rates, and ensures that websites look and function well on desktops, laptops, tablets, and smartphones.', '2024-05-13 04:00:18'),
(10, 2, 41, 'Double-check the spelling and scope of the variable. Ensure it\'s declared before being accessed.', '2024-05-14 02:18:21'),
(11, 2, 41, 'Use error reporting tools like error_reporting(E_ALL) to catch undefined variable errors during development.', '2024-05-14 02:18:29'),
(12, 2, 41, 'Use isset() or empty() functions to check if a variable is defined before accessing it to avoid errors.', '2024-05-14 02:18:38'),
(13, 2, 42, 'test answer', '2024-05-15 01:26:23'),
(100, 2, 42, 'test answer 2', '2024-05-15 20:53:48'),
(101, 2, 42, 'test answer 3', '2024-05-15 20:54:09');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `CommentId` int(11) NOT NULL,
  `UserId` int(11) NOT NULL,
  `PostId` int(11) NOT NULL,
  `CommentBody` varchar(1000) NOT NULL,
  `Timestamp` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`CommentId`, `UserId`, `PostId`, `CommentBody`, `Timestamp`) VALUES
(1, 2, 31, 'sample answer', '2024-05-11 18:14:51'),
(2, 2, 31, 'sample answer', '2024-05-11 18:14:57'),
(3, 2, 40, 'sample answer', '2024-05-12 07:58:09'),
(4, 2, 40, 'sample answer', '2024-05-12 08:07:44'),
(5, 5, 40, 'sample answer', '2024-05-12 09:07:24'),
(6, 2, 40, 'sample answer', '2024-05-12 10:56:27'),
(7, 5, 39, 'Responsive web design is an approach to building websites that ensures optimal viewing and interaction experiences across various devices and screen sizes.', '2024-05-12 22:06:36'),
(8, 3, 39, 'It involves using flexible layouts, fluid grids, and media queries to adapt the layout and design of a website dynamically based on the device\'s screen size, orientation, and capabilities.', '2024-05-12 22:06:43'),
(9, 2, 39, 'Responsive web design helps improve user experience, reduces bounce rates, and ensures that websites look and function well on desktops, laptops, tablets, and smartphones.', '2024-05-13 09:30:18'),
(10, 2, 41, 'Double-check the spelling and scope of the variable. Ensure it\'s declared before being accessed.', '2024-05-14 07:48:21'),
(11, 2, 41, 'Use error reporting tools like error_reporting(E_ALL) to catch undefined variable errors during development.', '2024-05-14 07:48:29'),
(12, 2, 41, 'Use isset() or empty() functions to check if a variable is defined before accessing it to avoid errors.', '2024-05-14 07:48:38'),
(13, 2, 42, 'test answer', '2024-05-15 06:56:23');

-- --------------------------------------------------------

--
-- Table structure for table `following`
--

CREATE TABLE `following` (
  `FollowId` int(11) NOT NULL,
  `UserId` int(11) NOT NULL,
  `IsFollowing` int(11) NOT NULL,
  `Timestamp` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `following`
--

INSERT INTO `following` (`FollowId`, `UserId`, `IsFollowing`, `Timestamp`) VALUES
(1, 1, 1, '2024-05-10 17:55:00'),
(3, 2, 1, '2024-05-11 14:08:03'),
(4, 4, 1, '2024-05-11 18:19:34'),
(5, 4, 4, '2024-05-11 19:42:06'),
(6, 6, 2, '2024-05-12 10:58:56');

-- --------------------------------------------------------

--
-- Table structure for table `likes`
--

CREATE TABLE `likes` (
  `LikeId` int(11) NOT NULL,
  `UserId` int(11) NOT NULL,
  `PostId` int(11) NOT NULL,
  `Timestamp` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `likes`
--

INSERT INTO `likes` (`LikeId`, `UserId`, `PostId`, `Timestamp`) VALUES
(29, 2, 38, '2024-05-13 16:20:38'),
(38, 2, 42, '2024-05-15 13:23:26'),
(52, 7, 41, '2024-05-15 13:47:28'),
(56, 7, 42, '2024-05-15 13:48:51');

-- --------------------------------------------------------

--
-- Table structure for table `location`
--

CREATE TABLE `location` (
  `LocationId` int(11) NOT NULL,
  `LocationName` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `location`
--

INSERT INTO `location` (`LocationId`, `LocationName`) VALUES
(1, 'Java'),
(2, 'Python'),
(3, 'C#'),
(4, 'C++'),
(5, 'Data Science'),
(6, 'Artificial Intelligence'),
(7, 'Cybersecurity'),
(8, 'Mobile Development'),
(9, 'Cloud Computing'),
(10, 'Database Management'),
(11, 'Frontend Development'),
(12, 'Backend Development'),
(13, 'Game Development'),
(14, 'DevOps'),
(15, 'Embedded Systems'),
(16, 'Internet of Things (IoT)'),
(17, 'Blockchain'),
(18, 'Robotics'),
(19, 'Networking'),
(20, 'Operating Systems'),
(21, 'UI/UX Design'),
(22, 'Big Data'),
(23, 'AR/VR Development'),
(24, 'Quantum Computing'),
(25, 'Bioinformatics'),
(26, 'Cryptocurrency'),
(27, 'Computer Graphics'),
(28, 'Natural Language Processing (NLP)'),
(29, 'Software Testing'),
(30, 'API Development'),
(31, 'Microservices'),
(32, 'Parallel Computing'),
(33, 'Compiler Design'),
(34, 'Version Control Systems'),
(35, 'Web Scraping'),
(36, 'GIS (Geographic Information Systems)'),
(37, 'Image Processing'),
(38, 'Signal Processing'),
(39, 'Embedded Programming'),
(40, 'Information Security'),
(41, 'Wireless Communication'),
(42, 'Cloud Security'),
(43, 'Data Mining'),
(44, 'E-commerce'),
(45, 'Computer Vision'),
(46, 'Distributed Systems'),
(47, 'Mobile Security'),
(48, 'AR/VR Security'),
(49, 'Data Visualization'),
(50, 'Software Architecture'),
(51, 'Agile Methodology'),
(52, 'Bioinformatics'),
(53, 'Compiler Theory'),
(54, 'Computer Architecture'),
(55, 'Computer Networks'),
(56, 'Computer Security'),
(57, 'Continuous Integration (CI)'),
(58, 'Data Engineering'),
(59, 'Data Warehousing'),
(60, 'Digital Marketing'),
(61, 'Distributed Computing'),
(62, 'Embedded Hardware'),
(63, 'Enterprise Resource Planning (ERP)'),
(64, 'Fintech'),
(65, 'Functional Programming'),
(66, 'Game Design'),
(67, 'Genetic Algorithms'),
(68, 'Geographic Information Systems (GIS)'),
(69, 'Human-Computer Interaction (HCI)'),
(70, 'Information Retrieval'),
(71, 'Internet Security'),
(72, 'IT Service Management (ITSM)'),
(73, 'Machine Vision'),
(74, 'Microcontrollers'),
(75, 'Middleware Technologies'),
(76, 'Mobile App Design'),
(77, 'Mobile App Development'),
(78, 'Mobile Gaming'),
(79, 'Natural Language Understanding (NLU)'),
(80, 'Network Security'),
(81, 'Object-Oriented Programming (OOP)'),
(82, 'Parallel Processing'),
(83, 'Pattern Recognition'),
(84, 'Predictive Analytics'),
(85, 'Quality Assurance (QA)'),
(86, 'Quantitative Finance'),
(87, 'Real-Time Systems'),
(88, 'Risk Management'),
(89, 'Robot Programming'),
(90, 'Search Engine Optimization (SEO)'),
(91, 'Semantic Web'),
(92, 'Serverless Computing'),
(93, 'Simulation Software'),
(94, 'Social Media Marketing'),
(95, 'Software Development Lifecycle (SDLC)'),
(96, 'Systems Analysis'),
(97, 'Systems Design'),
(98, 'Systems Programming'),
(99, 'Telecommunications'),
(100, 'User Experience (UX) Design');

-- --------------------------------------------------------

--
-- Table structure for table `notification`
--

CREATE TABLE `notification` (
  `NotifId` int(11) NOT NULL,
  `UserId` int(11) NOT NULL,
  `FromUser` int(11) NOT NULL,
  `PostId` int(11) DEFAULT NULL,
  `CommentBody` varchar(50) DEFAULT NULL,
  `Notification` varchar(100) NOT NULL,
  `Timestamp` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `notification`
--

INSERT INTO `notification` (`NotifId`, `UserId`, `FromUser`, `PostId`, `CommentBody`, `Notification`, `Timestamp`) VALUES
(1, 1, 1, NULL, NULL, 'Followed you!', '2024-05-10 17:55:00'),
(3, 1, 2, NULL, NULL, 'Followed you!', '2024-05-11 14:08:03'),
(4, 2, 2, 31, ' nbzf ', 'Commented on your post!', '2024-05-11 18:14:51'),
(5, 2, 2, 31, '        f   ferfr', 'Commented on your post!', '2024-05-11 18:14:57'),
(8, 1, 4, NULL, NULL, 'Followed you!', '2024-05-11 18:19:34'),
(9, 4, 4, NULL, NULL, 'Followed you!', '2024-05-11 19:42:06'),
(11, 2, 2, 40, 'moda isuru', 'Commented on your post!', '2024-05-12 07:58:09'),
(12, 2, 2, 40, 'modayaaa', 'Commented on your post!', '2024-05-12 08:07:44'),
(13, 2, 5, 40, 'pissa', 'Commented on your post!', '2024-05-12 09:07:24'),
(14, 2, 2, 40, 'thanhawa', 'Commented on your post!', '2024-05-12 10:56:27'),
(15, 2, 6, NULL, NULL, 'Followed you!', '2024-05-12 10:58:56'),
(26, 2, 2, 39, 'hi there', 'Commented on your post!', '2024-05-12 22:06:36'),
(27, 2, 2, 39, 'helloooooooo', 'Commented on your post!', '2024-05-12 22:06:43'),
(36, 2, 2, 39, 'Responsive web design helps improve user experienc', 'Commented on your post!', '2024-05-13 09:30:18'),
(44, 1, 2, 38, NULL, 'Liked your post!', '2024-05-13 16:20:38'),
(47, 5, 2, 41, 'Double-check the spelling and scope of the variabl', 'Commented on your post!', '2024-05-14 07:48:21'),
(48, 5, 2, 41, 'Use error reporting tools like error_reporting(E_A', 'Commented on your post!', '2024-05-14 07:48:29'),
(49, 5, 2, 41, 'Use isset() or empty() functions to check if a var', 'Commented on your post!', '2024-05-14 07:48:38'),
(55, 2, 2, 42, 'test answer', 'Commented on your post!', '2024-05-15 06:56:23'),
(59, 5, 7, 41, NULL, 'Liked your post!', '2024-05-15 13:47:28'),
(61, 2, 7, 42, NULL, 'Liked your post!', '2024-05-15 13:48:51'),
(66, 2, 2, 42, NULL, 'Liked your post!', '2024-05-15 19:36:15'),
(79, 5, 2, 41, NULL, 'Liked your post!', '2024-05-15 20:05:43'),
(82, 2, 2, 100, NULL, 'Liked your post!', '2024-05-15 20:06:34'),
(83, 2, 2, 42, '42', 'Commented on your post!', '2024-05-15 21:37:51');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `PostId` int(11) NOT NULL,
  `UserId` int(11) NOT NULL,
  `TagId` int(255) NOT NULL DEFAULT 1,
  `Title` varchar(100) NOT NULL,
  `Caption` varchar(1000) DEFAULT '',
  `Timestamp` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`PostId`, `UserId`, `TagId`, `Title`, `Caption`, `Timestamp`) VALUES
(31, 2, 34, 'What is version control and why is it important in software development?', 'Explain the concept of version control and its significance in managing codebases and collaborating on software projects.', '2024-05-11 18:12:14'),
(32, 4, 1, 'Question 2', 'dddddddd', '2024-05-11 18:44:25'),
(33, 4, 1, 'Question 3', 'swwwwww', '2024-05-11 18:53:22'),
(34, 4, 30, 'What are RESTful APIs?', 'Describe RESTful APIs and their key principles for designing web services.', '2024-05-11 18:54:35'),
(35, 4, 1, 'Question 5', 'nhtdn', '2024-05-11 18:57:20'),
(36, 4, 1, 'Question 6', 'seeeeeeeeeaaaaa', '2024-05-11 19:17:40'),
(37, 4, 1, 'What is the difference between Java and JavaScript?', 'Explain the key differences between Java and JavaScript, including their use cases, syntax, and execution environments.', '2024-05-11 20:48:59'),
(38, 1, 12, 'What is the difference between SQL and NoSQL databases?', 'Differentiate between SQL (relational) and NoSQL (non-relational) databases, highlighting their characteristics, use cases, and advantages.', '2024-05-12 07:00:04'),
(39, 2, 11, 'What is responsive web design?', 'Define responsive web design and explain its importance in modern web development.', '2024-05-12 07:09:08'),
(40, 6, 12, 'Undefined variable: variable_name\' in PHP', 'This error typically occurs when trying to access a variable that has not been defined or is out of scope within a PHP script. It can happen due to misspelling variable names or accessing variables outside their scope.', '2024-05-12 07:10:32'),
(41, 5, 14, 'CSS Flexbox not Aligning Items Properly', 'Flexbox is a powerful layout mechanism, but aligning items as desired can sometimes be tricky. This issue can arise when the align-items or justify-content properties are not set correctly.', '2024-05-13 12:23:49'),
(42, 2, 4, 'Test Category', 'tags', '2024-05-15 06:35:02'),
(43, 2, 8, 'Hi Devs', 'developer content', '2024-05-15 07:23:32'),
(44, 2, 3, 'Check Add', 'added tag', '2024-05-15 09:35:15'),
(45, 2, 16, 'Check Tag Save', 'added tag to db', '2024-05-15 09:49:37');

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

CREATE TABLE `questions` (
  `QuestionId` int(255) NOT NULL,
  `UserId` int(255) NOT NULL,
  `TagId` int(255) NOT NULL DEFAULT 1,
  `Title` varchar(100) NOT NULL,
  `Description` varchar(1000) DEFAULT '',
  `Timestamp` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `questions`
--

INSERT INTO `questions` (`QuestionId`, `UserId`, `TagId`, `Title`, `Description`, `Timestamp`) VALUES
(31, 2, 34, 'What is version control and why is it important in software development?', 'Explain the concept of version control and its significance in managing codebases and collaborating on software projects.', '2024-05-11 12:42:14'),
(32, 4, 1, 'Question 2', 'dddddddd', '2024-05-11 13:14:25'),
(33, 4, 1, 'Question 3', 'swwwwww', '2024-05-11 13:23:22'),
(34, 4, 30, 'What are RESTful APIs?', 'Describe RESTful APIs and their key principles for designing web services.', '2024-05-11 13:24:35'),
(35, 4, 1, 'Question 5', 'nhtdn', '2024-05-11 13:27:20'),
(36, 4, 1, 'Question 6', 'seeeeeeeeeaaaaa', '2024-05-11 13:47:40'),
(37, 4, 1, 'What is the difference between Java and JavaScript?', 'Explain the key differences between Java and JavaScript, including their use cases, syntax, and execution environments.', '2024-05-11 15:18:59'),
(38, 1, 12, 'What is the difference between SQL and NoSQL databases?', 'Differentiate between SQL (relational) and NoSQL (non-relational) databases, highlighting their characteristics, use cases, and advantages.', '2024-05-12 01:30:04'),
(39, 2, 11, 'What is responsive web design?', 'Define responsive web design and explain its importance in modern web development.', '2024-05-12 01:39:08'),
(40, 6, 12, 'Undefined variable: variable_name\' in PHP', 'This error typically occurs when trying to access a variable that has not been defined or is out of scope within a PHP script. It can happen due to misspelling variable names or accessing variables outside their scope.', '2024-05-12 01:40:32'),
(41, 5, 14, 'CSS Flexbox not Aligning Items Properly', 'Flexbox is a powerful layout mechanism, but aligning items as desired can sometimes be tricky. This issue can arise when the align-items or justify-content properties are not set correctly.', '2024-05-13 06:53:49'),
(42, 2, 4, 'Test Category', 'tags', '2024-05-15 01:05:02'),
(100, 2, 5, 'test add', 'test db ', '2024-05-15 13:10:40');

-- --------------------------------------------------------

--
-- Table structure for table `tags`
--

CREATE TABLE `tags` (
  `TagId` int(255) NOT NULL,
  `TagName` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tags`
--

INSERT INTO `tags` (`TagId`, `TagName`) VALUES
(1, 'Java'),
(2, 'Python'),
(3, 'C#'),
(4, 'C++'),
(5, 'Data Science'),
(6, 'Artificial Intelligence'),
(7, 'Cybersecurity'),
(8, 'Mobile Development'),
(9, 'Cloud Computing'),
(10, 'Database Management'),
(11, 'Frontend Development'),
(12, 'Backend Development'),
(13, 'Game Development'),
(14, 'DevOps'),
(15, 'Embedded Systems'),
(16, 'Internet of Things (IoT)'),
(17, 'Blockchain'),
(18, 'Robotics'),
(19, 'Networking'),
(20, 'Operating Systems'),
(21, 'UI/UX Design'),
(22, 'Big Data'),
(23, 'AR/VR Development'),
(24, 'Quantum Computing'),
(25, 'Bioinformatics'),
(26, 'Cryptocurrency'),
(27, 'Computer Graphics'),
(28, 'Natural Language Processing (NLP)'),
(29, 'Software Testing'),
(30, 'API Development'),
(31, 'Microservices'),
(32, 'Parallel Computing'),
(33, 'Compiler Design'),
(34, 'Version Control Systems'),
(35, 'Web Scraping'),
(36, 'GIS (Geographic Information Systems)'),
(37, 'Image Processing'),
(38, 'Signal Processing'),
(39, 'Embedded Programming'),
(40, 'Information Security'),
(41, 'Wireless Communication'),
(42, 'Cloud Security'),
(43, 'Data Mining'),
(44, 'E-commerce'),
(45, 'Computer Vision'),
(46, 'Distributed Systems'),
(47, 'Mobile Security'),
(48, 'AR/VR Security'),
(49, 'Data Visualization'),
(50, 'Software Architecture'),
(51, 'Agile Methodology'),
(52, 'Bioinformatics'),
(53, 'Compiler Theory'),
(54, 'Computer Architecture'),
(55, 'Computer Networks'),
(56, 'Computer Security'),
(57, 'Continuous Integration (CI)'),
(58, 'Data Engineering'),
(59, 'Data Warehousing'),
(60, 'Digital Marketing'),
(61, 'Distributed Computing'),
(62, 'Embedded Hardware'),
(63, 'Enterprise Resource Planning (ERP)'),
(64, 'Fintech'),
(65, 'Functional Programming'),
(66, 'Game Design'),
(67, 'Genetic Algorithms'),
(68, 'Geographic Information Systems (GIS)'),
(69, 'Human-Computer Interaction (HCI)'),
(70, 'Information Retrieval'),
(71, 'Internet Security'),
(72, 'IT Service Management (ITSM)'),
(73, 'Machine Vision'),
(74, 'Microcontrollers'),
(75, 'Middleware Technologies'),
(76, 'Mobile App Design'),
(77, 'Mobile App Development'),
(78, 'Mobile Gaming'),
(79, 'Natural Language Understanding (NLU)'),
(80, 'Network Security'),
(81, 'Object-Oriented Programming (OOP)'),
(82, 'Parallel Processing'),
(83, 'Pattern Recognition'),
(84, 'Predictive Analytics'),
(85, 'Quality Assurance (QA)'),
(86, 'Quantitative Finance'),
(87, 'Real-Time Systems'),
(88, 'Risk Management'),
(89, 'Robot Programming'),
(90, 'Search Engine Optimization (SEO)'),
(91, 'Semantic Web'),
(92, 'Serverless Computing'),
(93, 'Simulation Software'),
(94, 'Social Media Marketing'),
(95, 'Software Development Lifecycle (SDLC)'),
(96, 'Systems Analysis'),
(97, 'Systems Design'),
(98, 'Systems Programming'),
(99, 'Telecommunications'),
(100, 'User Experience (UX) Design');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `UserId` int(11) NOT NULL,
  `Username` varchar(255) NOT NULL,
  `Name` varchar(255) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `UserBio` varchar(120) DEFAULT '',
  `UserImage` varchar(255) NOT NULL DEFAULT 'default.jpg'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`UserId`, `Username`, `Name`, `Email`, `Password`, `UserBio`, `UserImage`) VALUES
(1, '@aaa', 'shav', 'aaa@gmail.com', '$2y$10$bCXEr80Fas30kyiT1jaEAeVv1eAc9FEyCQ27/UKYpv3SKJB7Ele7e', '', 'default.jpg'),
(2, '@Shav_D3', 'Shavin Fernando', 'shavin2001d@gmail.com', '$2y$10$HnVSdsqMe77IaRqx0agfE.GTl0DsRuQKqa5xQtUYCz1xsI3YTW48C', 'Hello Developers!', '20240318_220340.jpg'),
(3, '@test1', 'test1', 'aaa@gmail.com', '$2y$10$X6zL0PtPA1IPoeFspSUdieA9KaQsCTqXT9ocHkLF4mtRyMAHoLEri', '', 'default.jpg'),
(4, '@bbbbb', 'bbb', 'aaa@gmail.com', '$2y$10$JNrMSjTfNVUUHtIYUeYRgu07U.eCiv7xwDszrgIxea78xMukcQNa.', '', 'default.jpg'),
(5, '@abc', 'abc', 'aaa@gmail.com', '$2y$10$WvBCLoezByEESsS6FLp68OktAB5RYWrMhDmRe36e8xumvhzTqkKwa', '', 'default.jpg'),
(6, '@test2', 'aaa', 'aaa@gmail.com', '$2y$10$34T0ZYHkdUV31zrPRyuqouzW0Rhl9LEIX4Y0Q8ViqbyliKVKMcvqS', '', 'default.jpg'),
(7, '@test', 'test', 'aaa@gmail.com', '$2y$10$wLkPYTRxZRXJwXkgklzh4.0HMvQdZv0jCnZ.TlN1vUghWnbhcjguu', '', 'default.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `votes`
--

CREATE TABLE `votes` (
  `VoteId` int(255) NOT NULL,
  `UserId` int(255) NOT NULL,
  `QuestionId` int(255) NOT NULL,
  `Timestamp` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `votes`
--

INSERT INTO `votes` (`VoteId`, `UserId`, `QuestionId`, `Timestamp`) VALUES
(104, 2, 42, '2024-05-15 19:36:15'),
(117, 2, 41, '2024-05-15 20:05:43'),
(120, 2, 100, '2024-05-15 20:06:34');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `answers`
--
ALTER TABLE `answers`
  ADD PRIMARY KEY (`AnswerId`),
  ADD KEY `FK_AnswerUser` (`UserId`),
  ADD KEY `FK_AnswerQuestion` (`QuestionId`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`CommentId`),
  ADD KEY `FK_CommentUser` (`UserId`),
  ADD KEY `FK_CommentPost` (`PostId`);

--
-- Indexes for table `following`
--
ALTER TABLE `following`
  ADD PRIMARY KEY (`FollowId`),
  ADD KEY `FK_FollowUser` (`UserId`),
  ADD KEY `FK_FollowIsFollowing` (`IsFollowing`);

--
-- Indexes for table `likes`
--
ALTER TABLE `likes`
  ADD PRIMARY KEY (`LikeId`),
  ADD KEY `FK_LikeUser` (`UserId`),
  ADD KEY `FK_LikePost` (`PostId`);

--
-- Indexes for table `location`
--
ALTER TABLE `location`
  ADD PRIMARY KEY (`LocationId`);

--
-- Indexes for table `notification`
--
ALTER TABLE `notification`
  ADD PRIMARY KEY (`NotifId`),
  ADD KEY `FK_NotifUser` (`UserId`),
  ADD KEY `FK_NotifFromUser` (`FromUser`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`PostId`),
  ADD KEY `FK_PostUser` (`UserId`),
  ADD KEY `FK_PostLocation` (`TagId`);

--
-- Indexes for table `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`QuestionId`),
  ADD KEY `FK_QuestionUser` (`UserId`),
  ADD KEY `FK_QuestionTag` (`TagId`);

--
-- Indexes for table `tags`
--
ALTER TABLE `tags`
  ADD PRIMARY KEY (`TagId`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`UserId`),
  ADD UNIQUE KEY `Username` (`Username`);

--
-- Indexes for table `votes`
--
ALTER TABLE `votes`
  ADD PRIMARY KEY (`VoteId`),
  ADD KEY `FK_VoteUser` (`UserId`),
  ADD KEY `FK_VoteQuestion` (`QuestionId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `answers`
--
ALTER TABLE `answers`
  MODIFY `AnswerId` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=113;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `CommentId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `following`
--
ALTER TABLE `following`
  MODIFY `FollowId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `likes`
--
ALTER TABLE `likes`
  MODIFY `LikeId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT for table `notification`
--
ALTER TABLE `notification`
  MODIFY `NotifId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=84;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `PostId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `questions`
--
ALTER TABLE `questions`
  MODIFY `QuestionId` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=101;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `UserId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `votes`
--
ALTER TABLE `votes`
  MODIFY `VoteId` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=121;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `answers`
--
ALTER TABLE `answers`
  ADD CONSTRAINT `FK_AnswerQuestion` FOREIGN KEY (`QuestionId`) REFERENCES `questions` (`QuestionId`),
  ADD CONSTRAINT `FK_AnswerUser` FOREIGN KEY (`UserId`) REFERENCES `users` (`UserId`);

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `FK_CommentPost` FOREIGN KEY (`PostId`) REFERENCES `posts` (`PostId`),
  ADD CONSTRAINT `FK_CommentUser` FOREIGN KEY (`UserId`) REFERENCES `users` (`UserId`);

--
-- Constraints for table `following`
--
ALTER TABLE `following`
  ADD CONSTRAINT `FK_FollowIsFollowing` FOREIGN KEY (`IsFollowing`) REFERENCES `users` (`UserId`),
  ADD CONSTRAINT `FK_FollowUser` FOREIGN KEY (`UserId`) REFERENCES `users` (`UserId`);

--
-- Constraints for table `likes`
--
ALTER TABLE `likes`
  ADD CONSTRAINT `FK_LikePost` FOREIGN KEY (`PostId`) REFERENCES `posts` (`PostId`),
  ADD CONSTRAINT `FK_LikeUser` FOREIGN KEY (`UserId`) REFERENCES `users` (`UserId`);

--
-- Constraints for table `notification`
--
ALTER TABLE `notification`
  ADD CONSTRAINT `FK_NotifFromUser` FOREIGN KEY (`FromUser`) REFERENCES `users` (`UserId`),
  ADD CONSTRAINT `FK_NotifUser` FOREIGN KEY (`UserId`) REFERENCES `users` (`UserId`);

--
-- Constraints for table `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `FK_PostUser` FOREIGN KEY (`UserId`) REFERENCES `users` (`UserId`);

--
-- Constraints for table `questions`
--
ALTER TABLE `questions`
  ADD CONSTRAINT `FK_QuestionTag` FOREIGN KEY (`TagId`) REFERENCES `tags` (`TagId`),
  ADD CONSTRAINT `FK_QuestionUser` FOREIGN KEY (`UserId`) REFERENCES `users` (`UserId`);

--
-- Constraints for table `votes`
--
ALTER TABLE `votes`
  ADD CONSTRAINT `FK_VoteQuestion` FOREIGN KEY (`QuestionId`) REFERENCES `questions` (`QuestionId`),
  ADD CONSTRAINT `FK_VoteUser` FOREIGN KEY (`UserId`) REFERENCES `users` (`UserId`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
