-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 16, 2024 at 04:35 PM
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
(101, 2, 42, 'test answer 3', '2024-05-15 20:54:09'),
(113, 2, 42, 'test', '2024-05-15 22:00:14'),
(114, 2, 42, 'test2', '2024-05-16 05:31:24'),
(115, 2, 41, 'Flexbox is a powerful layout mechanism, but aligning items as desired can sometimes be tricky. This issue can arise when the align-items or justify-content properties are not set correctly.Flexbox is a powerful layout mechanism, but aligning items as desired can sometimes be tricky. This issue can arise when the align-items or justify-content properties are not set correctly.Flexbox is a powerful layout mechanism, but aligning items as desired can sometimes be tricky. This issue can arise when the align-items or justify-content properties are not set correctly.Flexbox is a powerful layout mechanism, but aligning items as desired can sometimes be tricky. This issue can arise when the align-items or justify-content properties are not set correctly.Flexbox is a powerful layout mechanism, but aligning items as desired can sometimes be tricky. This issue can arise when the align-items or justify-content properties are not set correctly.Flexbox is a powerful layout mechanism, but aligning it', '2024-05-16 09:59:59');

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
(100, 2, 5, 'test add', 'test db ', '2024-05-15 13:10:40'),
(105, 2, 6, 'test db', 'qq', '2024-05-16 13:48:33');

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
(148, 2, 42, '2024-05-16 14:27:33'),
(149, 2, 105, '2024-05-16 14:27:39');

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
  MODIFY `AnswerId` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=116;

--
-- AUTO_INCREMENT for table `questions`
--
ALTER TABLE `questions`
  MODIFY `QuestionId` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=106;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `UserId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `votes`
--
ALTER TABLE `votes`
  MODIFY `VoteId` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=150;

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
