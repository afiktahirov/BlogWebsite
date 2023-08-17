-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 09, 2023 at 04:28 PM
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
-- Database: `social`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `email`, `password`, `name`) VALUES
(1, 'afik.t38@gmail.com', '$2y$10$gyskgatqmlzbekpceoLZu.gAQ6vguR..rk3dVcgFWdaW3iIVaweBy', 'Afik Tahirov');

-- --------------------------------------------------------

--
-- Table structure for table `comment`
--

CREATE TABLE `comment` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `comment` varchar(255) NOT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `post_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `comment`
--

INSERT INTO `comment` (`id`, `user_id`, `comment`, `parent_id`, `post_id`) VALUES
(9, 1, 'Beyenib paylaşmağı unutmayın:)', NULL, 6),
(10, 4, 'Ela paylaşım', NULL, 6),
(11, 3, 'Salam :::::::D', NULL, 6),
(12, 10, '(-_-)', NULL, 6),
(13, 1, ':(', NULL, 7);

-- --------------------------------------------------------

--
-- Table structure for table `friendships`
--

CREATE TABLE `friendships` (
  `friendship_id` int(11) NOT NULL,
  `user_id_1` int(11) NOT NULL,
  `user_id_2` int(11) NOT NULL,
  `accept_f` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `friendships`
--

INSERT INTO `friendships` (`friendship_id`, `user_id_1`, `user_id_2`, `accept_f`) VALUES
(1, 4, 1, 1),
(2, 5, 1, 1),
(3, 8, 1, 1),
(4, 7, 1, 0),
(5, 6, 1, 0),
(6, 2, 1, 1),
(7, 3, 1, 1),
(8, 7, 8, 0),
(9, 4, 8, 1),
(10, 7, 8, 0),
(11, 4, 8, 1),
(12, 7, 8, 0),
(13, 6, 8, 0),
(14, 7, 8, 0),
(15, 2, 8, 1),
(16, 3, 8, 1),
(17, 4, 2, 1),
(18, 5, 2, 0),
(19, 7, 1, 0),
(20, 10, 1, 1),
(21, 9, 1, 0),
(22, 6, 1, 0),
(23, 12, 3, 0),
(24, 11, 3, 0);

-- --------------------------------------------------------

--
-- Table structure for table `post_liked`
--

CREATE TABLE `post_liked` (
  `id` int(11) NOT NULL,
  `liked_user_id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `post_like` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `post_liked`
--

INSERT INTO `post_liked` (`id`, `liked_user_id`, `post_id`, `post_like`) VALUES
(4, 1, 6, 0),
(5, 4, 6, 0),
(6, 4, 7, 0),
(7, 3, 6, 0),
(8, 10, 6, 0),
(9, 5, 6, 0),
(11, 1, 7, 0),
(12, 1, 8, 0);

-- --------------------------------------------------------

--
-- Table structure for table `post_photos`
--

CREATE TABLE `post_photos` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `tmp_name` varchar(255) NOT NULL,
  `post_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `post_photos`
--

INSERT INTO `post_photos` (`id`, `user_id`, `tmp_name`, `post_id`) VALUES
(6, 1, '16887667271250.jpg', 6),
(7, 4, '16887668962334.jpg', 7),
(8, 1, '16888962903835.jpg', 8);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `gender` int(11) NOT NULL,
  `country` varchar(255) NOT NULL,
  `bio` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `age` varchar(255) NOT NULL,
  `photo` varchar(255) NOT NULL DEFAULT 'user_images/no_images/no.png',
  `is_blocked` varchar(255) NOT NULL DEFAULT '0',
  `is_online` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `name`, `password`, `gender`, `country`, `bio`, `email`, `phone`, `age`, `photo`, `is_blocked`, `is_online`) VALUES
(1, 'Afik22', 'Afik Tahirov', '$2y$10$kPcNd.laJ65AA.vqPDxoEO5KjvO8WPnTVDSH50plPvjTKXI4DT8ga', 1, 'Azerbaijan', 'Sagray juvanbur', 'afik.t38@gmail.com', '0707380142', '2000-11-22', 'user_images/20210514_165618.jpg', '0', 0),
(2, 'zus123', 'Zaur Lacinov', '$2y$10$xAJ.TpqTz7f.O7AMzqt/qunhJ2COHZn.DVA8Ae2awOWji/2yrorUO', 1, 'Azərbaycan', 'Salam Dostlar men teze geldim', '', '', '2001-06-15', 'user_images/WhatsApp Image 2023-06-26 at 19.09.05.jpeg', '0', 0),
(3, 'turabcik', 'Turab Saruxanov', '$2y$10$/dIhM2FcStkk3WDrOk/nrO92qxTvWaXhBR1nYQDfCtz9piugouVyO', 1, 'Azərbaycan', 'Salam Lezgiyar hikya cun', 'turab_lezgi@mail.ru', '', '2001-06-11', 'user_images/WhatsApp Image 2023-06-26 at 19.04.25.jpeg', '0', 0),
(4, 'Firuz123', 'Firuz Tarlanov', '$2y$10$yYqEnCHYZuKa6Q4hFfK.Y.EtA9.YtiRQVI4aAbZpWdacfdFgJ..x2', 1, 'Azərbaycan', 'Salam cavanar', 'firuz@gmail.com', '', '2001-05-14', 'user_images/IMG-20230228-WA0005.jpg', '0', 0),
(5, 'orxi123', 'Orxan Novruzaliyev', '$2y$10$dOSS7O6NgLq6xvGyQ2Ht9OHc7bE9/pRL5Dr5PELdk1THjRAxOVo72', 1, 'Azərbaycan', '', '', '', '2023-06-07', 'user_images/WhatsApp Image 2023-06-26 at 19.12.50.jpeg', '0', 0),
(6, 'mehemmed123', 'Məhəmməd Tağıyev', '$2y$10$9siVnc3u76jr9DP5CqVc5.fWzmyO5UzEZw8k45BgvTTrdDfa.iRVS', 1, 'Azərbaycan', 'Azmiu 3/4 Uiiiiii', 'mehemmed@gmail.com', '', '2005-05-28', 'user_images/Screenshot_6.png', '0', 0),
(7, 'mila123', 'Milanə Babazadə', '$2y$10$U40qLSmoDewlw2/XsSioz.aXGAhWURhGwlISCIqoMH0YwMe1UESmS', 1, 'Azərbaycan', '', '', '', '', 'user_images/no_images/no.png', '0', 0),
(8, 'samus123', 'Samir Agabalayev', '$2y$10$njd/ulA6RYZS2Hl9nNihDeLxoxiKQOxFg2bjQ4J1oHrv/El7ONtES', 1, 'Azərbaycan', 'Men Zabitem', 'samir.agabalayev123@gmail.com', '', '2001-01-01', 'user_images/20220106_194619.jpg', '0', 0),
(9, 'erzi123', 'Ərziman Vəlibəyov', '$2y$10$3053.Es9eOb3j1jTAEiYJ.mHvhyABJFTG0bocDHXpzKa2etxZlRYK', 1, 'Azərbaycan', 'S - E - L - A - M', 'velibeyov123@gmail.com', '', '1995-06-14', 'user_images/Screenshot_7.png', '0', 0),
(10, 'lemos123', 'Ləman Talibova', '$2y$10$8x56mvoo1cfCS5bnWb0tB.jMTQt5RpCCTE/OJD2hYpsYyKPIxSZ8G', 2, 'Azərbaycan', '', 'lemon123@gmail.com', '', '2001-01-11', 'user_images/Screenshot_8.png', '0', 0),
(11, 'elmis123', 'Elmira Cəbrayılova', '$2y$10$GabAYKRSBBYj5HkJILagN.LHoHj4p2g2fwkSg7r.bwDyoLUvraPZW', 2, 'Azərbaycan', '', 'elmira123@gmail.com', '', '2004-05-10', 'user_images/Screenshot_9.png', '0', 0),
(12, 'rauf123', 'Rauf Cebrayilov', '$2y$10$yOJjqGrWTbM/2pRYS.5Y4OxxiOE2IKZM3KzVFjP1bWW61z5lsyDJm', 1, 'Azərbaycan', '', 'rauftarlan@gmail.com', '', '2003-01-21', 'user_images/Screenshot_14.png', '0', 0),
(13, 'ramis', 'Ramin Cəbrayilov', '$2y$10$vlQ1Emks920gRhYNKUAFsuEUTymX7K5l9wHsWKP75TdtZv4vN65H2', 1, 'Azərbaycan', '', '', '', '2003-06-08', 'user_images/Screenshot_11.png', '0', 0),
(14, 'qumus', 'Qumral Laçınov', '$2y$10$URGX5OhLGRQH4nagv8Vv8eo3cev1j8gcnQa933YG8tLoy5Lz/UxzW', 1, 'Azərbaycan', '', '', '', '1998-12-09', 'user_images/Screenshot_12.png', '0', 0),
(15, 'fedo123', 'Fedik İmalov', '$2y$10$sIX/rFsiubcm0nWPaTgPreDJuNNRuzYMd.J44bo5ha5El8h1b8GFi', 1, 'Azərbaycan', '', '', '', '', 'user_images/no_images/no.png', '0', 0),
(16, 'fidis123', 'Fuad Tahirli', '$2y$10$cCL5HyAIu/MfSN/F1DXnTOoCqI5ceeyoQC2K9WYhdRT8eRXqYvwLu', 1, 'Azərbaycan', '', '', '', '', 'user_images/no_images/no.png', '0', 0),
(17, 'oruclu123', 'İlham Oruclu', '$2y$10$jfrjy7kGx4rBkuJigWnBzuCuoex5hH0TOiE8o9yFwQC2AfphpEgW.', 1, 'Azərbaycan', '', '', '', '', 'user_images/no_images/no.png', '0', 0),
(18, 'seyyo123', 'Səyyad İsmayılov', '$2y$10$5i.PMpheBlgUFiniPrnYO.ml7lq233/rqL9D0Nk/ntsDlrH0N4xS.', 1, 'Azərbaycan', '', '', '', '', 'user_images/no_images/no.png', '0', 0);

-- --------------------------------------------------------

--
-- Table structure for table `user_posts`
--

CREATE TABLE `user_posts` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `text` text NOT NULL,
  `post_photo` varchar(255) NOT NULL,
  `post_likeq` int(11) NOT NULL,
  `liked` int(11) NOT NULL,
  `post_comment` int(11) NOT NULL,
  `post_time` time NOT NULL,
  `user_id` int(11) NOT NULL,
  `accept` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_posts`
--

INSERT INTO `user_posts` (`id`, `title`, `text`, `post_photo`, `post_likeq`, `liked`, `post_comment`, `post_time`, `user_id`, `accept`) VALUES
(6, 'Azmiu ', 'Azmiudan salamlar :)', '', 0, 0, 0, '00:00:00', 1, 1),
(7, 'Dramatik an :D', 'Jurnalda birinci olanlar bilər :D', '', 0, 0, 0, '00:00:00', 4, 1),
(8, 'sadasdasd', 'asdasdasdasdasd', '', 0, 0, 0, '00:00:00', 1, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `friendships`
--
ALTER TABLE `friendships`
  ADD PRIMARY KEY (`friendship_id`);

--
-- Indexes for table `post_liked`
--
ALTER TABLE `post_liked`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `post_photos`
--
ALTER TABLE `post_photos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_posts`
--
ALTER TABLE `user_posts`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `comment`
--
ALTER TABLE `comment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `friendships`
--
ALTER TABLE `friendships`
  MODIFY `friendship_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `post_liked`
--
ALTER TABLE `post_liked`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `post_photos`
--
ALTER TABLE `post_photos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `user_posts`
--
ALTER TABLE `user_posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
