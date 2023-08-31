-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 29, 2023 at 11:04 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cmsproject`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `cat_id` int(3) NOT NULL,
  `cat_title` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`cat_id`, `cat_title`) VALUES
(1, 'HTML & CSS'),
(2, 'Javascript'),
(6, 'Frameworks'),
(8, 'Backend'),
(10, 'Development Tools');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `comment_id` int(3) NOT NULL,
  `comment_post_id` int(3) NOT NULL,
  `comment_author` varchar(255) NOT NULL,
  `comment_email` varchar(255) NOT NULL,
  `comment_content` text NOT NULL,
  `comment_status` varchar(255) NOT NULL,
  `comment_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`comment_id`, `comment_post_id`, `comment_author`, `comment_email`, `comment_content`, `comment_status`, `comment_date`) VALUES
(1, 1, 'YK Chia', 'cyk0129@gmail.com', 'This crash course allows me to grasp the concept of web development, particularly structuring web pages at the initial stage, perking me up in continuing this marvelous journey.', 'approved', '2023-03-22'),
(2, 1, 'Loh WB', 'lwb1130@gmail.com', 'Such beguiling content! I\'m mesmerized by the crash course.', 'approved', '2023-03-22'),
(4, 1, 'Rahim', 'rahim0525@gmail.com', 'Thanks to this HTML Crash Course, I have learned in depth the fundamental knowledge of HTML. Definitely will continue to enhance my skills in it.', 'approved', '2023-03-22'),
(14, 1, 'Rui Zhe', 'orz0624@gmail.com', 'Yearning to see more informative content from you soon!', 'approved', '2023-03-22'),
(15, 3, 'Jing Yi', 'ojy0107@gmail.com', 'I got exposed to the essential knowledge of JS throughout this course, and I firmly believe that this helps me continue exploring more enchanting features of JS.', 'approved', '2023-03-22'),
(18, 9, 'YK Chia', 'cyk0129@gmail.com', 'Throughout this tutorial, I have learned storing, tracking, and collaborating on software projects. It dawned upon me that Github makes it so easy for developers to share code files and collaborate with fellow developers on open-source projects.', 'approved', '2023-03-25'),
(19, 6, 'Rahim', 'rahim0525@gmail.com', 'This React JS course indubitably harnesses my skills in building interactive user interfaces and web applications in a more efficient way with significantly less code, thanks to the help of reusable components created.', 'approved', '2023-03-28'),
(20, 7, 'Loh WB', 'lwb1130@gmail.com', 'This beginner-friendly course taught me all the fundamental knowledge used to style and lay out web pages. I couldn\'t believe that I got completely hooked!', 'approved', '2023-03-28'),
(21, 8, 'Jing Yi', 'ojy0107@gmail.com', 'Learning Sass facilitates me to write clean, easy, and less CSS in a programming construct, allowing me to write CSS quicker. I get to know the BEM methodology as well, commonly used naming convention for writing classes in HTML.', 'approved', '2023-03-28'),
(22, 8, 'Rui Zhe', 'orz0624@gmail.com', 'I came into realization that Sass is such a useful and robust preprocessor, fonding of their nested syntax. Definitely will register for your full course!', 'approved', '2023-03-28');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `post_id` int(3) NOT NULL,
  `post_category_id` int(3) NOT NULL,
  `post_title` varchar(255) NOT NULL,
  `post_author` varchar(255) NOT NULL,
  `post_date` date NOT NULL,
  `post_image` text NOT NULL,
  `post_content` text NOT NULL,
  `post_tags` varchar(255) NOT NULL,
  `post_status` varchar(255) NOT NULL DEFAULT 'draft',
  `post_views_count` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`post_id`, `post_category_id`, `post_title`, `post_author`, `post_date`, `post_image`, `post_content`, `post_tags`, `post_status`, `post_views_count`) VALUES
(1, 1, 'HTML Crash Course for Absolute Beginners', 'Traversy Media', '2023-03-22', 'htmlcrashcourse.jpg', 'In this crash course, I will cram as much about HTML as I can. This is meant for absolute beginners. If you are interested in learning HTML but know nothing, then you are in the right place. We will be creating a cheat sheet with all of the common HTML5 tags, attributes, semantic markup, etc. We will not be focusing on CSS in this video. The CSS crash course will be released shortly after.', 'traversymedia, html, beginner', 'published', 0),
(3, 2, 'JS Crash Course for Absolute Beginners', 'Traversy Media', '2023-03-24', 'jscrashcourse.jpg', 'In this crash course we will go over the fundamentals of JavaScript including more modern syntax such as classes, arrow functions, etc. This is the starting point on my channel for learning JS.', 'traversymedia, javascript, fundamental', 'published', 2),
(4, 6, 'Bootstrap 5 Crash Course', 'Web Dev Simplified', '2023-03-22', 'bootstrap5crashcourse.jpg', 'Bootstrap is one of the most widely used CSS frameworks, but it can be quite complex to learn since there are so many features in Bootstrap. In this video, I will be breaking down everything you need to know about Bootstrap by covering the entire grid system, 6 popular components, and 6 categories of utility classes.', 'webdevsimplified, bootstrap, framework', 'published', 0),
(6, 6, 'React JS Crash Course', 'Traversy Media', '2023-03-28', 'reactcrashcourse.jpg', 'Get started with React in this crash course. We will be building a task tracker app and look at components, props, state, hooks, working with an API and more.', 'traversymedia, react, framework, api', 'published', 14),
(7, 1, 'CSS Crash Course For Absolute Beginners', 'Traversy Media', '2023-03-24', 'csscrashcourse.jpg', 'In this video, I will cram as much as possible about CSS. We will be looking at styles, selectors, declarations, etc. We will build a CSS cheat sheet that you can keep as a resource and we will also create a basic website layout. We are using CSS3 but mostly the basics. I will be creating an advanced CSS course with animations,  etc. I do have a Flexbox in 20 minutes video as well if you want to learn flexbox.', 'traversymedia, css, beginner', 'published', 0),
(8, 1, 'Sass and BEM for beginners', 'Coder Coder', '2023-03-22', 'sassfulltutorial.jpg', 'In this video I\'ll walk you through the basics of Sass, BEM (block-element-modifier), and the principles of responsive design. This is a standalone course in Sass that\'s taken from my full course, Responsive Design for Beginners.', 'codercoder, sass, bem', 'published', 0),
(9, 10, 'Git, GitHub, & GitHub Desktop for beginners', 'Coder Coder', '2023-03-25', 'gitgithubcodercoder.jpg', 'In this video, we\'ll be going through the basics of Git, GitHub, and GitHub Desktop app -- how to set them up and use them to track your code changes. These are important tools for all developers to understand. Git and GitHub make it easier to manage different software versions and make it easier for multiple people to work on the same software project.', 'git, github, version control', 'published', 2),
(13, 10, 'What is NPM, and why do we need it? | Tutorial for beginners', 'Coder Coder', '2023-03-27', 'npmcodercoder.jpg', '<p>What is npm? This 15 minute beginners tutorial to npm (Node Package Manager) will walk you through how to install npm on your computer, and how to install and update packages for your projects.<br></p>', 'codercoder, npm, package', 'published', 3);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(3) NOT NULL,
  `username` varchar(255) NOT NULL,
  `user_password` varchar(255) NOT NULL,
  `user_firstname` varchar(255) NOT NULL,
  `user_lastname` varchar(255) NOT NULL,
  `user_email` varchar(255) NOT NULL,
  `user_image` text NOT NULL,
  `user_role` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `user_password`, `user_firstname`, `user_lastname`, `user_email`, `user_image`, `user_role`) VALUES
(14, 'cyk0129', '$2y$12$keH.tU6Sog7th8UE3NLPReJk62LOwJTgbRsXfe9XYEmJ3A/ZaZH62', 'Yee Kin', 'Chia', 'cyk0129@gmail.com', '', 'admin'),
(15, 'lwb1130', '$2y$10$GKSDCH.WMWnhcQJDbRWC8uJKZcfbd5YwrKMaoVNZSHmdsVLxwc9C.', 'Wei Bin', 'Loh', 'lwb1130@gmail.com', '', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `users_online`
--

CREATE TABLE `users_online` (
  `online_id` int(11) NOT NULL,
  `session` varchar(255) NOT NULL,
  `time` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users_online`
--

INSERT INTO `users_online` (`online_id`, `session`, `time`) VALUES
(4, 'mkjok6o7hgtqf807jghe418f0e', 1680080674),
(5, 'eohna061b3qdhlmjjo4j0ie8g7', 1679991405),
(6, 'm12qcbud4idtqubtnhdullnq68', 1679992625),
(7, '3diguqh5k6sonv1j1f0cc5mjd8', 1679994353);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`cat_id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`comment_id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`post_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `users_online`
--
ALTER TABLE `users_online`
  ADD PRIMARY KEY (`online_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `cat_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `comment_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `post_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `users_online`
--
ALTER TABLE `users_online`
  MODIFY `online_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
