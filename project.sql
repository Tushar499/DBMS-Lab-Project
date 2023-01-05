-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 02, 2023 at 02:33 AM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `project`
--

-- --------------------------------------------------------

--
-- Table structure for table `a_recruitment`
--

CREATE TABLE `a_recruitment` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `department` varchar(255) NOT NULL,
  `deadline` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `c_credit` varchar(255) NOT NULL,
  `grade` varchar(255) NOT NULL,
  `cgpa` varchar(255) NOT NULL,
  `trimester` varchar(255) NOT NULL,
  `excel` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `a_recruitment`
--

INSERT INTO `a_recruitment` (`id`, `title`, `department`, `deadline`, `description`, `c_credit`, `grade`, `cgpa`, `trimester`, `excel`) VALUES
(91, 'Undergraduate Assistant', 'Computer Science And Engineering', '2023-02-09', 'Student should have match each requirement for apply  ', '80', '4.0', '3.7', 'Fall', ''),
(92, 'Grader', 'Computer Science And Engineering', '2023-02-04', 'Student must apply before the deadline and should have match each requirement for apply . Best of luck', '80', '4.0', '3.7', 'Fall', '');

-- --------------------------------------------------------

--
-- Table structure for table `f_request`
--

CREATE TABLE `f_request` (
  `email` varchar(255) NOT NULL,
  `coursename` varchar(255) NOT NULL,
  `courseid` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `section` varchar(255) NOT NULL,
  `department` varchar(255) NOT NULL,
  `time` varchar(255) NOT NULL,
  `assistant` varchar(255) NOT NULL,
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `fromxl` varchar(255) NOT NULL,
  `trimester` varchar(255) NOT NULL,
  `aid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `f_request`
--

INSERT INTO `f_request` (`email`, `coursename`, `courseid`, `type`, `section`, `department`, `time`, `assistant`, `id`, `name`, `fromxl`, `trimester`, `aid`) VALUES
('ahassan@cse.uiu.ac.bd', 'Digital Logic Design Lab', 'CSE 1326', 'Undergraduate Assistant', 'A', 'Computer Science And Engineering', '2.00 - 4.00', 'Mahmudur Rahman Tushar', 27161, 'Md. Abir Hassan', '', 'Fall', 47),
('ahassan@cse.uiu.ac.bd', 'Electrical Circuit', 'EEE 2113', 'Grader', 'A', 'Computer Science And Engineering', '11.00 - 1.30', 'Pending', 27162, 'Md. Abir Hassan', '', 'Fall', 0),
('ahassan@cse.uiu.ac.bd', 'Electrical Circuit lab', 'EEE 2114', 'Undergraduate Assistant', 'D', 'Computer Science And Engineering', '9.00 - 10.30', 'Pending', 27163, 'Md. Abir Hassan', '', 'Fall', 0),
('tarek@cse.uiu.ac.bd', 'Data Structure and Algorithms I Laboratory', 'CSE 2216', 'Grader', 'D', 'Computer Science And Engineering', '2.00 - 4.00', 'Pending', 27164, 'Md Tarek Hasan', '', 'Fall', 0),
('tarek@cse.uiu.ac.bd', ' Data Structure and Algorithms II lab', 'CSE 2218', 'Undergraduate Assistant', 'B', 'Computer Science And Engineering', '2.00 - 4.00', 'Pending', 27165, 'Md Tarek Hasan', '', 'Fall', 0),
('tarek@cse.uiu.ac.bd', ' Data Structure and Algorithms II', 'CSE 2217', 'Grader', 'B', 'Computer Science And Engineering', '11.00 - 1.30', 'Pending', 27166, 'Md Tarek Hasan', '', 'Fall', 0);

-- --------------------------------------------------------

--
-- Table structure for table `f_users`
--

CREATE TABLE `f_users` (
  `name` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `github` varchar(255) NOT NULL,
  `linkedin` varchar(255) NOT NULL,
  `website` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `f_users`
--

INSERT INTO `f_users` (`name`, `type`, `email`, `password`, `github`, `linkedin`, `website`, `image`) VALUES
('ABHIJEET ACHARJEE JEET', 'Lecturer', 'abhijeet@ce.uiu.ac.bd', '$2y$10$QtHsXzlXmpa0FmfMbP64TuMth8RNM3YyElc89XRCWcDMAJ7vG08ZW', 'https://github.com', 'https://linkedin.com', 'https://google.com', 'Abhijeet-8-300x284.jpg'),
('Afzal Ahmed', 'Professor', 'afzal@ce.uiu.ac.bd', '$2y$10$.XTKfwTFnh4cV/gLxlaU.OipHWerJ0SzKpTNkE9fne4H20cIhkAya', 'https://github.com', 'https://linkedin.com', 'https://google.com', 'afsal.jpg'),
('Md. Abir Hassan', 'Lecturer', 'ahassan@cse.uiu.ac.bd', '$2y$10$h8Z8mhoKHxHc.ziL7hQ9CO3ngywXRfy94FEQtDtWIRz20TcfapRhG', 'https://github.com', 'https://linkedin.com', 'https://google.com', 'abir_cse.jpg'),
('Akib Zaman', 'Lecturer', 'akib@cse.uiu.ac.bd', '$2y$10$86kTAcQH8oVgFYQYFPdhMeXYOH2/EVy3xRksDgI1N0XpBADLZz7Pu', 'https://github.com', 'https://linkedin.com', 'https://gmail.com', 'clipped.jpg'),
('Farzana Rahman', 'Professor', 'farzana@ce.uiu.ac.bd', '$2y$10$9gENLIBHxony9y9i2mzd7.APYvr5otbM9nOE5iUSS87bpQUkoAtJm', 'https://github.com', 'https://linkedin.com', 'https://google.com', 'profile-300x273.jpeg'),
('Helena Bulbul', 'Lecturer', 'helena@eee.uiu.ac.bd', '$2y$10$mhK1fbsREj8XJVFKL/XIRuEwP25h0jjPwCBbmikxo.ifbFj.EYxI2', 'https://github.com', 'https://linkedin.com', 'https://google.com', 'Helena-Bulbul.jpg'),
('Farhan Anan Himu', 'Lecturer', 'himu@cse.uiu.ac.bd', '$2y$10$6MU2SGGMZ9uGoaMUFpPN.ec6YwduLh.yEEte3xu0TY5ThIlYf7vlS', 'https://github.com', 'https://linkedin.com', 'https://gmail.com', '298470273_5265036856937874_3444689359732436083_n.jpg'),
('Dr. Mohammad Nurul Huda', 'Professor', 'mnh@cse.uiu.ac.bd', '$2y$10$VAOFue4iFx6VKfiA6t4M2Oj93ko/fEXvy.ne3C.CM0Tvz5ZSYGxG.', 'https://github.com', 'https://linkedin.com', 'https://gmail.com', 'Passport-photo-latest.png'),
('Rumana Afrin', 'Professor', 'rumana@ce.uiu.ac.bd', '$2y$10$GQn31cYYzcywpfp1ZFjqBuzhQ7oxMFuikq3KJfUf7U2CwqDiRqvTO', 'https://github.com', 'https://linkedin.com', 'https://google.com', 'Picture_Rumana-768x512.jpg'),
('Sadia Islam', 'Lecturer', 'sadia@cse.uiu.ac.bd', '$2y$10$RThTIE2DT4lUDDHtvGR8JuSrtBGcPZ0ft70QAkkhCON/TzByQPwgK', 'https://github.com', 'https://linkedin.com', 'https://google.com', 'Screenshot_20211108-170213_Fotor-276x300.jpg'),
('Md. Shahriar Ahmed Chowdhury', 'Professor', 'shahriar@eee.uiu.ac.bd', '$2y$10$2L9JENyc9NPhdWPZiwJAUO13F6vSUEGrZi88/ocJDIdfkMQeBNkNG', 'https://github.com', 'https://linkedin.com', 'https://gmail.com', '1.-Profile-Photo-Shahriar-287x300.jpg'),
('SWAKKHAR SHATABDA', 'Professor', 'swakkhar@cse.uiu.ac.bd', '$2y$10$eWqKY/EmZRS1ZLQg6MMG.uLUQdKoYXYnwidG4GCcZzpG0lHVRHTOm', 'https://github.com', 'https://linkedin.com', 'https://google.com', 'IMG_3069-1-203x300.jpg'),
('Md Tarek Hasan', 'Lecturer', 'tarek@cse.uiu.ac.bd', '$2y$10$2nmpahq6Xoh6JHDuzaGW6.TSMzAtyMTc9tTvNUAr3S/0taf7KfEKC', 'https://github.com', 'https://linkedin.com', 'https://google.com', '1635750673078.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `job`
--

CREATE TABLE `job` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `sitelink` varchar(255) NOT NULL,
  `picture` varchar(255) NOT NULL,
  `date` varchar(255) NOT NULL,
  `time` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `job`
--

INSERT INTO `job` (`id`, `name`, `email`, `image`, `title`, `description`, `sitelink`, `picture`, `date`, `time`) VALUES
(14, 'Md. Abir Hassan', 'ahassan@cse.uiu.ac.bd', 'abir_cse.jpg', 'Software Engineer', ' What we are looking for:\r\n\r\nComputer Science (or related technical field) graduates or final semester students\r\nGood programming skills in at least one of the following languages: C/C++, C#, Java or Python\r\nKnowledge of Data Structures and Algorithms \r\nB', 'https://therap.hire.trakstar.com/jobs/fk0hw8r/?utm_campaign=google_jobs_apply&utm_source=google_jobs_apply&utm_medium=organic', '', '02-01-23', '03:37'),
(15, 'Md Tarek Hasan', 'tarek@cse.uiu.ac.bd', '1635750673078.jpg', 'Software Engineer', ' The fastest growing Cloud Based Marketplace Company, Field Nation is looking for a \"Software Engineer” for its development team. As we are rising day by day, our needs are evolving and to keep pace with the evolution we need experts like you to contribut', 'https://jobs.lever.co/fieldnation/42c567e7-f9de-4740-ae41-9ed6067fcdcc?utm_campaign=google_jobs_apply&utm_source=google_jobs_apply&utm_medium=organic', '', '02-01-23', '03:45'),
(16, 'UIU', '', '', 'SDE III or IV - Golang Engineer', ' How you’ll contribute:\r\n\r\nThe GoLang developer will be working closely with our solution architects and will be leading smaller pods/teams of engineers developing exciting features and products for release!\r\n\r\n\r\n\r\nHere is a selection of tasks you could b', 'https://shikho.freshteam.com/jobs/VkAdIKueKnM5/sde-iii-or-iv-golang-engineer?utm_campaign=google_jobs_apply&utm_source=google_jobs_apply&utm_medium=organic', '', '02-01-23', '03:47');

-- --------------------------------------------------------

--
-- Table structure for table `recommendation`
--

CREATE TABLE `recommendation` (
  `id` int(11) NOT NULL,
  `fid` int(11) NOT NULL,
  `sid` int(11) NOT NULL,
  `status` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `s_application`
--

CREATE TABLE `s_application` (
  `name` varchar(255) NOT NULL,
  `studentid` varchar(255) NOT NULL,
  `coursename` varchar(255) NOT NULL,
  `courseid` varchar(255) NOT NULL,
  `grade` varchar(255) NOT NULL,
  `cgpa` varchar(255) NOT NULL,
  `c_credit` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `department` varchar(255) NOT NULL,
  `trimester` varchar(255) NOT NULL,
  `recommendation` varchar(255) NOT NULL,
  `id` int(11) NOT NULL,
  `associated` varchar(255) NOT NULL,
  `time` varchar(255) NOT NULL,
  `section` varchar(255) NOT NULL,
  `aid` int(11) NOT NULL,
  `rid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `s_application`
--

INSERT INTO `s_application` (`name`, `studentid`, `coursename`, `courseid`, `grade`, `cgpa`, `c_credit`, `type`, `department`, `trimester`, `recommendation`, `id`, `associated`, `time`, `section`, `aid`, `rid`) VALUES
('Mahmudur Rahman Tushar', '011202080', 'Digital Logic Design Lab', 'CSE 1326', 'A', '3.81', '80', 'Undergraduate Assistant', 'Computer Science And Engineering', 'Fall', 'Md. Abir Hassan', 47, 'Md. Abir Hassan', '2.00 - 4.00', 'A', 27161, 27161),
('Mahmudur Rahman Tushar', '011202080', ' Data Structure and Algorithms II lab', 'CSE 2218', '4.0', '3.81', '80', 'Undergraduate Assistant', 'Computer Science And Engineering', 'Fall', 'No Recommendation', 48, 'Pending', '2.00 - 4.00', 'B', 0, 0),
('Rakibul Hasan', '011202106', ' Data Structure and Algorithms II lab', 'CSE 2218', '4.0', '3.8', '89', 'Undergraduate Assistant', 'Computer Science And Engineering', 'Fall', 'Md Tarek Hasan', 49, 'Pending', '2.00 - 4.00', 'B', 0, 27165);

-- --------------------------------------------------------

--
-- Table structure for table `s_users`
--

CREATE TABLE `s_users` (
  `name` varchar(255) NOT NULL,
  `studentid` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `gender` varchar(255) NOT NULL,
  `website` varchar(255) NOT NULL,
  `github` varchar(255) NOT NULL,
  `linkedin` varchar(255) NOT NULL,
  `facebook` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `department` varchar(255) NOT NULL,
  `cgpa` varchar(255) NOT NULL,
  `c_credit` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `s_users`
--

INSERT INTO `s_users` (`name`, `studentid`, `password`, `email`, `gender`, `website`, `github`, `linkedin`, `facebook`, `image`, `department`, `cgpa`, `c_credit`) VALUES
('Mahmudur Rahman Tushar', '011202080', '$2y$10$BivvRBjDAcuq6Arirf3mIOGqBtfbyYJmD3riAOdfaaVVMoyzTckA6', 'tushar202080@bscse.uiu.ac.bd', 'Male', 'https://tushar499.github.io/', 'https://github.com/tushar499', 'https://linkedin.com', 'https://facebook.com/Tushar499', 'Tushar499.png', 'Computer Science And Engineering', '3.81', '80'),
('Toushif Mahmud', '011202081', '$2y$10$PLm5IAch02FFxA1UwQ1z6efEpNEIKY3ko9awTGWi.zZOu3HWfwfwO', 'toushif202081@bscse.uiu.ac.bd', 'Male', 'https://google.com', 'https://github.com', 'https://linkedin.com', 'https://facebook.com', '285922021_3290930741190499_6897293914247026491_n.jpg', 'Computer Science And Engineering', '4.0', '98'),
('Zzaman Apu', '011202084', '$2y$10$wXtdWKbMyQA50oNquS.JkeVJUhITsFYFk/3IGOa4bCHXfQ3ChCJoO', 'apu202084@bscse.uiu.ac.bd', 'Male', 'https://google.com', 'https://github.com', 'https://linkedin.com', 'https://facebook.com', '280616298_1025225641450098_2625850131422786389_n.jpg', 'Computer Science And Engineering', '4.0', '91'),
('Rakibul Hasan', '011202106', '$2y$10$m49n6Zdb17Eja0oFz5G6gebQGwj0Ml/YOYdBTa93.NquSe8VHOX4y', 'rakib202106@bscse.uiu.ac.bd', 'Male', 'https://google.com', 'https://github.com', 'https://linkedin.com', 'https://facebook.com', '1E0A805C-1945-40E9-8005-EF85B80C8E41.jpg', 'Computer Science And Engineering', '3.8', '89'),
('Dipa Akter', '011202107', '$2y$10$/M8taSzRs5IJgc8gcG9Cr.EPzIzzcIe9VJRYUVerolwZ5OtdMoq8S', 'dipa202107@bscse.uiu.ac.bd', 'Female', 'https://google.com', 'https://github.com', 'https://linkedin.com', 'https://facebook.com', '270217294_891780958205404_5340427367965347363_n.jpg', 'Computer Science And Engineering', '3.89', '99'),
('Kazi Nazmul Hasan', '011202108', '$2y$10$phLMGR0V.rRO89R6PnvJK.W8m/AHLrw7eUo8ljt4mxL0hU/GpbGdW', 'nazmul202108@bscse.uiu.ac.bd', 'Male', 'https://google.com', 'https://github.com', 'https://linkedin.com', 'https://facebook.com', '305808019_174519268438071_5695738829000567932_n.jpg', 'Computer Science And Engineering', '3.8', '87'),
('Prapti Modumder', '011202112', '$2y$10$50H9bl.n0Aj4DBl9Q5D7TuI1eoT0/0GbcHqn1EOEDjGIp5CnRESXq', 'prapti202112@bscse.uiu.ac.bd', 'Female', 'https://google.com', 'https://github.com', 'https://linkedin.com', 'https://facebook.com', '321912599_1295403244335465_1072934083355058647_n.jpg', 'Computer Science And Engineering', '3.83', '88'),
('Sadman Sakib', '011202279', '$2y$10$6M72Mkhq7MiUEZ8t/RomL.dstl.j2nyMniwLDzE6n8GaSZD95HkvO', 'sadman202279@bscse.uiu.ac.bd', 'Male', 'https://google.com', 'https://github.com', 'https://linkedin.com', 'https://facebook.com', '271187999_3250893568474160_7036554719133763293_n.jpg', 'Computer Science And Engineering', '3.9', '92'),
('Lrk Hafez', '011202283', '$2y$10$.UVXQZgj5OzwNdO/Sfafkep2bR85HNhnqPLEWJPSZz67Zvi2LA8by', 'hafez202283@bscse.uiu.ac.bd', 'Male', 'https://google.com', 'https://github.com', 'https://linkedin.com', 'https://facebook.com', '281055538_2020926304753501_5963597316988344874_n.jpg', 'Computer Science And Engineering', '3.85', '90'),
('Munirah Anjum', '011202288', '$2y$10$fKwtNEwc16yrC2BfWKngFurmk7FcAXM4y28Et0QclS0ZMdMHaq91a', 'munirah202288@bscse.uiu.ac.bd', 'Female', 'https://google.com', 'https://github.com', 'https://linkedin.com', 'https://facebook.com', '131616897_390059332099478_4042470712268149855_n.jpg', 'Computer Science And Engineering', '3.83', '91');

-- --------------------------------------------------------

--
-- Table structure for table `task`
--

CREATE TABLE `task` (
  `id` int(11) NOT NULL,
  `tasktitle` varchar(255) NOT NULL,
  `topics` varchar(255) NOT NULL,
  `instructions` varchar(255) NOT NULL,
  `deadline` varchar(255) NOT NULL,
  `assessment` varchar(255) NOT NULL,
  `submittedassessment` varchar(255) NOT NULL,
  `submissioncomment` varchar(255) NOT NULL,
  `feedback` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `fid` int(11) NOT NULL,
  `sid` int(11) NOT NULL,
  `l_submission` varchar(255) NOT NULL,
  `l_feedback` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `thesis`
--

CREATE TABLE `thesis` (
  `studentid` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `details` varchar(255) NOT NULL,
  `p_time` varchar(255) NOT NULL,
  `p_date` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `req` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `thesis`
--

INSERT INTO `thesis` (`studentid`, `title`, `details`, `p_time`, `p_date`, `status`, `req`) VALUES
('011202106', 'Bayesian Bayesian networks using ML', 'The naming of Bayesian networks is somewhat misleading because there is nothing Bayesian in them per se; A Bayesian network is just a representation of a joint probability distribution. One can, of course, use a Bayesian network while doing Bayesian infer', '04:02', '02-01-23', 'done', 'swakkhar@cse.uiu.ac.bd');

-- --------------------------------------------------------

--
-- Table structure for table `thesis_group`
--

CREATE TABLE `thesis_group` (
  `leaderid` varchar(255) NOT NULL,
  `memberid` varchar(255) NOT NULL,
  `request` varchar(255) NOT NULL,
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `thesis_group`
--

INSERT INTO `thesis_group` (`leaderid`, `memberid`, `request`, `id`) VALUES
('011202106', '011202080', 'me', 59),
('011202106', '011202279', 'do', 60);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `a_recruitment`
--
ALTER TABLE `a_recruitment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `f_request`
--
ALTER TABLE `f_request`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `f_users`
--
ALTER TABLE `f_users`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `job`
--
ALTER TABLE `job`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `recommendation`
--
ALTER TABLE `recommendation`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `s_application`
--
ALTER TABLE `s_application`
  ADD PRIMARY KEY (`id`,`studentid`);

--
-- Indexes for table `s_users`
--
ALTER TABLE `s_users`
  ADD PRIMARY KEY (`studentid`);

--
-- Indexes for table `task`
--
ALTER TABLE `task`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `thesis`
--
ALTER TABLE `thesis`
  ADD PRIMARY KEY (`studentid`);

--
-- Indexes for table `thesis_group`
--
ALTER TABLE `thesis_group`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `a_recruitment`
--
ALTER TABLE `a_recruitment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=93;

--
-- AUTO_INCREMENT for table `f_request`
--
ALTER TABLE `f_request`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27167;

--
-- AUTO_INCREMENT for table `job`
--
ALTER TABLE `job`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `recommendation`
--
ALTER TABLE `recommendation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `s_application`
--
ALTER TABLE `s_application`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT for table `task`
--
ALTER TABLE `task`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `thesis_group`
--
ALTER TABLE `thesis_group`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
