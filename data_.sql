-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Oct 29, 2024 at 06:46 PM
-- Server version: 10.6.19-MariaDB
-- PHP Version: 8.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ankivnco_leaderboard_test`
--

-- --------------------------------------------------------

--
-- Table structure for table `leaderboard`
--

CREATE TABLE `leaderboard` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `reviews` int(11) NOT NULL DEFAULT 0,
  `time` float DEFAULT 0,
  `xp` float NOT NULL DEFAULT 0,
  `cards` int(11) NOT NULL DEFAULT 0,
  `retention` float NOT NULL DEFAULT 0,
  `day` int(11) NOT NULL,
  `type` varchar(18) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `leaderboard`
--

INSERT INTO `leaderboard` (`id`, `user_id`, `reviews`, `time`, `xp`, `cards`, `retention`, `day`, `type`) VALUES
(121, 85, 0, 0, 0, 0, 0, 1, 'today'),
(122, 85, 962, 298.17, 4243.45, 2660, 37.831, 8, 'week'),
(123, 85, 0, 0, 0, 0, 0, 0, 'challenge'),
(214, 116, 0, 0, 0, 0, 0, 1, 'today'),
(215, 116, 0, 0, 0, 0, 0, 0, 'week'),
(216, 116, 0, 0, 0, 0, 0, 0, 'challenge'),
(223, 119, 0, 0, 0, 0, 0, 1, 'today'),
(224, 119, 2568, 458.9, 14651.7, 3461, 72.7208, 13, 'week'),
(225, 119, 0, 0, 0, 0, 0, 0, 'challenge'),
(226, 120, 2, 14.52, 29.4, 41, 4.88, 1, 'today'),
(227, 120, 191, 338.6, 3103.2, 1350, 20.0787, 9, 'week'),
(228, 120, 0, 0, 0, 0, 0, 0, 'challenge'),
(232, 122, 0, 0.28, 0.01, 3, 0, 1, 'today'),
(233, 122, 1339, 249.75, 8353, 2406, 60.9695, 14, 'week'),
(234, 122, 0, 0, 0, 0, 0, 0, 'challenge'),
(235, 123, 0, 0, 0, 0, 0, 1, 'today'),
(236, 123, 1071, 315.87, 8074.44, 1857, 50.8475, 14, 'week'),
(237, 123, 0, 0, 0, 0, 0, 0, 'challenge'),
(241, 125, 0, 0, 0, 0, 0, 1, 'today'),
(242, 125, 310, 247.14, 1201.62, 627, 42.8928, 4, 'week'),
(243, 125, 0, 0, 0, 0, 0, 0, 'challenge'),
(274, 136, 42, 40.69, 271.87, 119, 35.29, 1, 'today'),
(275, 136, 1696, 1258.42, 26574.7, 4508, 32.8358, 17, 'week'),
(276, 136, 0, 0, 0, 0, 0, 0, 'challenge'),
(283, 139, 0, 0, 0, 0, 0, 1, 'today'),
(284, 139, 393, 173.62, 1566.62, 499, 75.2508, 6, 'week'),
(285, 139, 0, 0, 0, 0, 0, 0, 'challenge'),
(289, 141, 0, 1.89, 0.5, 4, 0, 1, 'today'),
(290, 141, 757, 268.24, 3123.44, 1914, 36.0523, 7, 'week'),
(291, 141, 0, 0, 0, 0, 0, 0, 'challenge'),
(292, 142, 0, 0, 0, 0, 0, 1, 'today'),
(293, 142, 0, 0, 0, 0, 0, 0, 'week'),
(294, 142, 0, 0, 0, 0, 0, 0, 'challenge'),
(298, 144, 261, 92.98, 1882.62, 645, 40.47, 1, 'today'),
(299, 144, 2338, 1382.3, 33350.9, 7752, 8.85714, 18, 'week'),
(300, 144, 0, 0, 0, 0, 0, 0, 'challenge'),
(313, 149, 0, 0.57, 0.04, 2, 0, 1, 'today'),
(314, 149, 1569, 604.27, 4831.16, 2384, 65.8138, 5, 'week'),
(315, 149, 0, 0, 0, 0, 0, 0, 'challenge'),
(316, 150, 0, 0, 0, 0, 0, 1, 'today'),
(317, 150, 286, 225.61, 1925.66, 5893, 3.17813, 7, 'week'),
(318, 150, 0, 0, 0, 0, 0, 0, 'challenge'),
(325, 153, 0, 0, 0, 0, 0, 1, 'today'),
(326, 153, 0, 293.33, 2262.83, 3106, 0, 9, 'week'),
(327, 153, 0, 0, 0, 0, 0, 0, 'challenge'),
(328, 154, 0, 0, 0, 0, 0, 1, 'today'),
(329, 154, 4995, 2016.36, 56798.1, 7200, 70.1195, 18, 'week'),
(330, 154, 0, 0, 0, 0, 0, 0, 'challenge'),
(343, 159, 0, 0, 0, 0, 0, 1, 'today'),
(344, 159, 0, 0, 0, 0, 0, 0, 'week'),
(345, 159, 0, 0, 0, 0, 0, 0, 'challenge'),
(346, 160, 0, 0, 0, 0, 0, 1, 'today'),
(347, 160, 611, 401.92, 4152.59, 1087, 57.696, 8, 'week'),
(348, 160, 0, 0, 0, 0, 0, 0, 'challenge'),
(349, 161, 0, 93.34, 1210.03, 507, 0, 1, 'today'),
(350, 161, 1227, 453.14, 2216.93, 2105, 88.5281, 3, 'week'),
(351, 161, 0, 0, 0, 0, 0, 0, 'challenge'),
(355, 163, 6, 7.67, 9.14, 20, 30, 1, 'today'),
(356, 163, 271, 462.31, 4263.25, 1339, 33.5727, 9, 'week'),
(357, 163, 0, 0, 0, 0, 0, 0, 'challenge'),
(376, 170, 0, 0, 0, 0, 0, 1, 'today'),
(377, 170, 0, 0, 0, 0, 0, 0, 'week'),
(378, 170, 0, 0, 0, 0, 0, 0, 'challenge'),
(379, 171, 0, 36.3, 183.05, 392, 0, 1, 'today'),
(380, 171, 0, 348.99, 2692.21, 3120, 0, 9, 'week'),
(381, 171, 0, 0, 0, 0, 0, 0, 'challenge'),
(382, 172, 0, 0, 0, 0, 0, 1, 'today'),
(383, 172, 0, 0, 0, 0, 0, 0, 'week'),
(384, 172, 0, 0, 0, 0, 0, 0, 'challenge'),
(385, 173, 0, 0, 0, 0, 0, 1, 'today'),
(386, 173, 0, 0, 0, 0, 0, 0, 'week'),
(387, 173, 0, 0, 0, 0, 0, 0, 'challenge'),
(388, 174, 0, 0, 0, 0, 0, 1, 'today'),
(389, 174, 0, 0, 0, 0, 0, 0, 'week'),
(390, 174, 0, 0, 0, 0, 0, 0, 'challenge'),
(391, 175, 0, 0, 0, 0, 0, 1, 'today'),
(392, 175, 90, 127.5, 405, 351, 26.1538, 3, 'week'),
(393, 175, 0, 0, 0, 0, 0, 0, 'challenge'),
(394, 176, 0, 0, 0, 0, 0, 1, 'today'),
(395, 176, 0, 0, 0, 0, 0, 0, 'week'),
(396, 176, 0, 0, 0, 0, 0, 0, 'challenge'),
(397, 177, 0, 0, 0, 0, 0, 1, 'today'),
(398, 177, 0, 0, 0, 0, 0, 0, 'week'),
(399, 177, 0, 0, 0, 0, 0, 0, 'challenge'),
(400, 178, 0, 0, 0, 0, 0, 1, 'today'),
(401, 178, 0, 0, 0, 0, 0, 0, 'week'),
(402, 178, 0, 0, 0, 0, 0, 0, 'challenge'),
(403, 179, 0, 0, 0, 0, 0, 1, 'today'),
(404, 179, 1549, 432.97, 8950.57, 3297, 44.7731, 11, 'week'),
(405, 179, 0, 0, 0, 0, 0, 0, 'challenge'),
(406, 180, 0, 0, 0, 0, 0, 1, 'today'),
(407, 180, 0, 0, 0, 0, 0, 0, 'week'),
(408, 180, 0, 0, 0, 0, 0, 0, 'challenge'),
(409, 181, 0, 0, 0, 0, 0, 1, 'today'),
(410, 181, 0, 0, 0, 0, 0, 0, 'week'),
(411, 181, 0, 0, 0, 0, 0, 0, 'challenge'),
(412, 182, 0, 0, 0, 0, 0, 1, 'today'),
(413, 182, 0, 0, 0, 0, 0, 0, 'week'),
(414, 182, 0, 0, 0, 0, 0, 0, 'challenge'),
(415, 183, 0, 0, 0, 0, 0, 1, 'today'),
(416, 183, 0, 0, 0, 0, 0, 0, 'week'),
(417, 183, 0, 0, 0, 0, 0, 0, 'challenge'),
(418, 184, 0, 0, 0, 0, 0, 1, 'today'),
(419, 184, 0, 0, 0, 0, 0, 0, 'week'),
(420, 184, 0, 0, 0, 0, 0, 0, 'challenge'),
(421, 185, 0, 0, 0, 0, 0, 1, 'today'),
(422, 185, 2919, 557.78, 5248.39, 4355, 67.0264, 4, 'week'),
(423, 185, 0, 0, 0, 0, 0, 0, 'challenge'),
(424, 186, 263, 75.56, 1882.82, 333, 78.98, 1, 'today'),
(425, 186, 4251, 1624.95, 44325.6, 5710, 73.6297, 17, 'week'),
(426, 186, 0, 0, 0, 0, 0, 0, 'challenge'),
(427, 187, 0, 0, 0, 0, 0, 1, 'today'),
(428, 187, 0, 0, 0, 0, 0, 0, 'week'),
(429, 187, 0, 0, 0, 0, 0, 0, 'challenge'),
(430, 188, 0, 0, 0, 0, 0, 1, 'today'),
(431, 188, 0, 0, 0, 0, 0, 0, 'week'),
(432, 188, 0, 0, 0, 0, 0, 0, 'challenge'),
(433, 189, 0, 0, 0, 0, 0, 1, 'today'),
(434, 189, 0, 0, 0, 0, 0, 0, 'week'),
(435, 189, 0, 0, 0, 0, 0, 0, 'challenge'),
(436, 190, 0, 0, 0, 0, 0, 1, 'today'),
(437, 190, 0, 0, 0, 0, 0, 0, 'week'),
(438, 190, 0, 0, 0, 0, 0, 0, 'challenge'),
(439, 191, 0, 0, 0, 0, 0, 1, 'today'),
(440, 191, 0, 0, 0, 0, 0, 0, 'week'),
(441, 191, 0, 0, 0, 0, 0, 0, 'challenge'),
(442, 192, 0, 0, 0, 0, 0, 1, 'today'),
(443, 192, 0, 0, 0, 0, 0, 0, 'week'),
(444, 192, 0, 0, 0, 0, 0, 0, 'challenge'),
(445, 193, 0, 0, 0, 0, 0, 1, 'today'),
(446, 193, 0, 38.97, 66.8057, 124, 0, 2, 'week'),
(447, 193, 0, 0, 0, 0, 0, 0, 'challenge'),
(451, 195, 0, 0, 0, 0, 0, 1, 'today'),
(452, 195, 0, 0, 0, 0, 0, 0, 'week'),
(453, 195, 0, 0, 0, 0, 0, 0, 'challenge'),
(454, 196, 0, 0, 0, 0, 0, 1, 'today'),
(455, 196, 0, 0, 0, 0, 0, 0, 'week'),
(456, 196, 0, 0, 0, 0, 0, 0, 'challenge'),
(457, 197, 0, 0, 0, 0, 0, 1, 'today'),
(458, 197, 0, 0, 0, 0, 0, 0, 'week'),
(459, 197, 0, 0, 0, 0, 0, 0, 'challenge'),
(460, 198, 0, 0, 0, 0, 0, 1, 'today'),
(461, 198, 0, 0, 0, 0, 0, 0, 'week'),
(462, 198, 0, 0, 0, 0, 0, 0, 'challenge');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(255) NOT NULL,
  `token` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `ip` varchar(25) NOT NULL,
  `fb_link` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `active` tinyint(1) DEFAULT 0,
  `verify` int(1) NOT NULL DEFAULT 0,
  `reg_token` varchar(255) NOT NULL,
  `reset_token` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `token`, `email`, `ip`, `fb_link`, `created_at`, `active`, `verify`, `reg_token`, `reset_token`) VALUES
(85, 'Frank', '$2y$10$CkEmX8JfqcdGN6nDthExheZLbDhHuJB32taHsse6qS2zbtNvZos/u', 'af5f09788f34b4a6962ad014cee00aa5', 'nqn9203@gmail.com', '58.186.29.26', 'https://www.facebook.com/Pi9203/', '2024-08-31 12:49:41', 1, 1, '', ''),
(116, 'Tiáº¿ng Trung Má»¹ H', '$2y$10$SIXoWQHIFPbznf3HWqZWEOvA.gIrl.A0FBg6AXRWt8G1r40uo74MK', '6e6fb047ca6833e5e8a975a65c2cb07d', 'timohire@gmail.com', '103.23.159.32', 'https://www.facebook.com/share/oWc72LFUQynNDj1s/?m', '2024-09-27 12:08:48', 1, 1, '', ''),
(119, 'PhÆ°Æ¡ng ThÆ°', '$2y$10$XXVsqLcd1nIdzXX8cKw20uWjnFYwJ/K992Go/y4GYyqG1Fhzz72su', '5d781a6da02891eda59f21c4c9b1ff12', 'tathiphuongthu2006@gmail.com', '1.53.82.22', 'https://www.facebook.com/profile.php?id=1000884907', '2024-09-27 15:32:47', 1, 1, '', ''),
(120, 'AnkiTracy', '$2y$10$8DZJsPFecllgEGI1YQSaAuOSqgp1KVHibmSxfIX1FwZKktB7cYWFG', 'f6b1924e1fe9bdba2484336ccc55192b', 'thuy.lt185411@gmail.com', '1.54.211.83', '', '2024-09-27 16:44:55', 1, 1, '', ''),
(122, 'Olive', '$2y$10$yBDf0pqUF/CBo2G9v9hnMeGYoy2NQue1veZXxqmIS2v.VViTahIb2', 'c607ad94a26961a3d44bfe248d92a9f9', 'thientrieu.ac@gmail.com', '14.191.254.168', 'https://www.facebook.com/thientrieu.2203/', '2024-09-28 04:55:55', 1, 1, '', ''),
(123, 'dovanngochung', '$2y$10$WYL1RCLGzdzDa8u97EzUd.0Muji8JHUf7vo74BzcFKfhaGe53WXk2', 'da1161725d0eefdad19d8e28050de1de', 'ngochungxt123@gmail.com', '42.113.157.253', 'https://www.facebook.com/ngochungdv/', '2024-09-28 06:13:08', 1, 1, '9ec3a7955558c3304f54626af490eb73', '34fba45de547562d69738653e37f282a'),
(125, 'taquynh', '$2y$10$os/yvW.UYucvO/xEnNn/6.GSWxl0cufMaUc5S.gAjHGY3o2T2AOTO', 'edbf882a5709e1483a7bab36f657ae6c', 'talenhuquynh8605@gmail.com', '14.191.112.60', 'https://www.facebook.com/profile.php?id=1000393544', '2024-09-28 13:35:57', 1, 1, 'efe407a8fcf179dde4f2e99a4eec1b16', '78fc1599ca1bc32d6434d9e59da96327'),
(136, 'ThaoThuTrinh', '$2y$10$TRKec.PNY/V8V6ugOyCa9.u05avKs2ZfX3TxgWQH65hzdOBShz3au', '62f3f8a9bcea0ca3ee9a5b33a12c44dd', 'trinhthuthao2905@gmail.com', '14.181.179.119', 'https://www.facebook.com/thao.trinh.10888938/?loca', '2024-09-30 03:45:20', 1, 1, '979c27a6363107cd80a7fafc6d2c3c71', '38c2edf66caa164fae6d885530712e39'),
(139, 'Äá»— Há»“ng QuÃ¢n', '$2y$10$klm8VKJ4LrOq9eNrX8wkVeOGztn9eM26LtSxVyPhONOlRrFfWche.', '9c7462f63b13a14589fd5cf5473f41f1', 'quandz12334@gmail.com', '171.250.165.98', 'https://www.facebook.com/profile.php?id=1000401350', '2024-10-01 15:43:12', 1, 1, '7add85d83a559ea771a39722af922ab4', ''),
(141, 'tuetam128', '$2y$10$YER42Sphz2EnJExWd.hu7O7J/4LZRgpYbLy7Cba8RkNFX5LxnJbcS', 'e1da17503c04517d928d5f4759ade273', 'tuetam128@gmail.com', '117.1.250.145', '', '2024-10-02 17:50:36', 1, 1, 'f276020d7d817a0ac8b893f39a1231a1', ''),
(142, 'QiQiChinese', '$2y$10$il9zdUN3EiFlTNxpudeafeqFi/HZN2h4/fG.EjHcNgvDktv68xpi.', '2bcd2726b4b5d5219dc14d16315f40b6', 'huyenphuongle17@gmail.com', '59.153.220.106', 'https://www.facebook.com/huyenphuong17/?locale=vi_', '2024-10-04 09:14:30', 1, 1, 'e1af1a4c77ec2b3a566756b1508cc623', ''),
(144, 'medstudent111', '$2y$10$fr5fb3UrqdHv.T7QnmY5eOwAne7j2SZ34pXzmpzSZUrxUpYvc.0xK', 'f7282b8e2c42213044e5f4689a9627d2', 'nsquang.1112006@gmail.com', '171.225.201.90', 'https://www.facebook.com/nsquang.1112006/', '2024-10-05 12:06:05', 1, 1, '343246e339815eabe08c17249ecbbcea', ''),
(149, 'ÄÄƒÌ£ng Minh AÌnh', '$2y$10$e8UKnZ50s2aQwkMQoLPT..OVxOY.qzc4EPWoJFRuduGCXBxCL7jR6', 'e43a8af50fa777f59ceccf17cca55ef9', 'minhanh02689@gmail.com', '1.52.219.210', 'https://www.facebook.com/profile.php?id=1000650438', '2024-10-07 12:09:14', 1, 1, 'f25f62d0ea6968a1d2477032ccd03c41', ''),
(150, 'lehoangphuc747', '$2y$10$4nbAWiCM85S0BGdnrTCvsOU62LJT66ZekwzyM.kgwW2eE.t0O2vcm', 'b484bf64d878588ba9defbef743f2750', 'lphc664@yahoo.com.vn', '14.240.149.101', 'https://fb.com/tuilaphuc747', '2024-10-08 06:11:39', 1, 1, '7e5f5f1b2f3ae5aab0968c45775734f5', ''),
(153, 'ThuongLe', '$2y$10$jPhN8r1QyxAiqdTAvYpXUOEbu0rO1gtT6m0Y6.5FzJh2VlFt66v5.', 'b7d5bd0cb30428c9671c9184dfd25d10', 'thuong18122002@gmail.com', '116.111.3.152', 'https://www.facebook.com/profile.php?id=1000122341', '2024-10-08 16:53:48', 1, 1, '19a348eff254358aca5f7d0c011cabad', ''),
(154, 'vanquocwww', '$2y$10$hx4ohExowBuvTkDiHskI9.nPuigxlmme.jxRwn33VcU98GGaZba3K', '7a52bef70481b475254e857512224dd3', 'aogiackim29@gmail.com', '27.72.62.155', 'https://www.facebook.com/profile.php?id=1000085161', '2024-10-08 17:22:05', 1, 1, '9ee273a5db245bb158fdf3aabf3c0a74', 'b176461167b0c1606dd8808426abf2a6'),
(159, 'ntuchamchi', '$2y$10$4JEEre35iywRXsiWCmaJN.kwE7LiM4PZ1CdRstQPjkV9rfDKpdV9W', '30028b0f8cee095fd8d43b43c7079d9d', 'ntuhocbai@gmail.com', '1.54.212.44', 'https://www.facebook.com/ntuchamchi/', '2024-10-09 09:37:14', 1, 1, 'e7cd589934d604ae90a8a315e873851d', ''),
(160, 'havanlong0965', '$2y$10$jDuM.pN/BtLXlNM8g8Aotef9UKw8an0gZjPVxgW43dlg1rUnG6CTC', '747103f0b1752158f10497ec9b752b7c', 'havanlong0965@gmail.com', '113.185.78.19', 'https://web.facebook.com/shenlong666/', '2024-10-09 12:07:06', 1, 1, 'fd0d9e1844811abe7dea398b2572e9ee', 'b8b040e2270fc3c1deb92a8930eb404e'),
(161, 'candysubby', '$2y$10$xRXd5h4DqCzWxGON.k/ZjuksgKrIdUhOC3fvPBhGiAuvyUC2kbOw2', 'd501bef9aefc03bcf6a534cd6ffde1cb', 'candysub02@gmail.com', '116.111.3.152', 'https://www.facebook.com/min.khue02/', '2024-10-09 14:12:32', 1, 1, '66755904731e81d4cc2c81d8feff5f74', ''),
(163, 'quanhzit', '$2y$10$2J4ApnQpEWkJTjEA2iYgOOx/16uVBy1Kvr0XvGs.13UOIQzMncKaW', '27abd2848ca07db751268ad331050af5', 'ngocmun2109@gmail.com', '14.167.28.12', 'https://www.facebook.com/hoangngocquynh1109/', '2024-10-09 14:59:18', 1, 1, '027559bd43777543acd0860f960b0eb1', ''),
(170, 'Thueanki', '$2y$10$0csAxwJbyQwNaNHQ.zOdGeDMtRN9rni50TqDsqeJbxr9zF2jYC3lG', 'eb49aa958d32c4f8de862f009ce47ddc', 'tran06032001@gmail.com', '113.178.132.73', 'https://www.facebook.com/profile.php?id=1000066826', '2024-10-09 17:08:18', 1, 1, '91c267aea3d74c402dac6d9bbcab984c', ''),
(171, 'rebirthflame', '$2y$10$JWtnmxRBFIhHNSeIy0WN6e4BDSVJj7RijqlEs4COGcXLp3du4U7di', '1ff599b04be9ca91760f742aec0b3557', 'rebirthflame22118@gmail.com', '116.96.46.108', 'https://www.facebook.com/nguyen.thanh.221188/', '2024-10-09 23:43:37', 1, 1, '1a3242af798bbef1a005c4d1a81cdfd8', ''),
(172, 'Hoangtien24h', '$2y$10$oUoVlRL.0SX2/1jMxXw4KOgg.0ktH6izZBfjBC6P4uEzW8BJ7XXV2', 'b8e8af733102fbf6211959581efe5b87', 'hoangtien24h@gmail.com', '49.97.30.78', 'https://www.facebook.com/htien24h', '2024-10-10 08:50:02', 0, 1, '3daac0d03eed4eca415f68a18f8a1ed9', ''),
(173, 'huypro', '$2y$10$9Yjy0oLs28ZlHqdDT8VJYOmHbRPQE9khwiaUsa.XXWbF5CpcBPbyS', '1f9f6a97d1c4ac5ef81175208fb0f6a9', 'huyn60820@gmail.com', '167.99.74.167', 'https://www.facebook.com/profile.php?id=1000304156', '2024-10-10 10:18:49', 0, 1, 'fe836b1c01faff38a9c9ba509a77cfdc', ''),
(174, 'nguyenkhacminh208', '$2y$10$Z23WzW7oj8th0HyToSZdpeTWoatDc0l6AwU2Fz3TN4EAAAH7ytyFi', 'd6dd48115cb3b139f9f41c895c0816a9', 'khacminh18308@gmail.com', '14.163.229.118', 'https://www.facebook.com/nguyenkhac.minh.397/', '2024-10-10 14:24:18', 0, 1, 'c4acfbf053021d0ce14d271fad25f2e2', ''),
(175, 'CrimmHocY', '$2y$10$Txm/FhfzLTDUBTh06Vphi.PmM64icCn.nqLQN0LCiyb3aLHNZelkq', '13efe5bd876a44ec59c75accbeccd6f4', 'hlongminer412@gmail.com', '115.77.245.235', 'https://www.facebook.com/Long.Crimm/', '2024-10-11 04:44:10', 1, 1, '60a11d0b97d2ee3f7fa4dfc83b88cda6', ''),
(176, 'Hieu', '$2y$10$fM7/iEZWKe8jPKuoniULJOa.knkwfjz.M..QnK2iwovZ07JwK3V3G', '6b00694752c4313a968b75ef61fd9ab2', 'minhhieu.vu161202@gmail.com', '116.96.44.119', 'https://www.facebook.com/profile.php?id=1000677012', '2024-10-11 05:07:42', 1, 1, 'b5b1d51dbcd9a7e35aa1bfd01473c23a', ''),
(177, 'phantrang', '$2y$10$KchzwCEB7FRYnl0FzfnDU.nmMtK6VOborcYT9zOKyY4V9GIvWmkye', '8550cd40fb8d5e628f049a50ccc9891a', 'phantrang19012004@gmail.com', '91.207.174.9', 'https://www.facebook.com/profile.php?id=1000533835', '2024-10-11 05:39:31', 0, 1, '0bacef81bb4855c6b07760d14d1c32ab', ''),
(178, 'khoahd7621', '$2y$10$uFlT7lBFe02UwMCokvxAXe2XVtSB69NWC1hHK/x8RdOd2ZXYN9D4e', '479d6146cd5a7c7350b80e8c092ea7d4', 'hoangdangkhoa7621@gmail.com', '113.161.57.181', 'https://www.facebook.com/khoahd7621', '2024-10-11 07:15:48', 0, 1, '9b975161d6002b4ef52813d59b7428aa', ''),
(179, 'Khanh Linh', '$2y$10$PcgLsNbPphLRpt6y8gf5POJfI9m0nqWPI1Ewvpllva6h9XZJeJTZi', '31d3f8e289cb61f519202f77327a9f67', 'khanhlinhahaha@gmail.com', '101.99.52.100', 'https://www.facebook.com/profile.php?id=1000171364', '2024-10-11 07:24:18', 1, 1, '22c7424053f4a8cf38d6779893e9c48d', ''),
(180, 'yenvy', '$2y$10$xRcSWHTZZOiLWDVaWxyJvuy9Qy3819je54puzcfWuiT2b3d8S/Mhm', '84176ef0577acb218154b0996c3655ad', 'nguyenyenvy15022004@gmail.com', '171.238.155.230', 'https://www.facebook.com/khaivy.nguyen.33?locale=v', '2024-10-11 14:07:42', 0, 1, '90c64c8c3641a0d005d63360309773aa', ''),
(181, 'vietle', '$2y$10$VXga2VmxlgU51RPLFqohjeUtcgd6VGZVasYkuOP6eHxrXxPsiODN2', '111cb00853538f0ef78be5347ef44dd2', 'leduyviet9009@gmail.com', '14.179.148.220', 'https://facebook.com/test', '2024-10-11 14:55:52', 1, 1, 'db9df21534766f3c8cd8bfc4baa46eb1', ''),
(182, 'quynhduong', '$2y$10$8f.GlAH9zooRCjkKYcasj.EoSZArz/ib3QCYjIgSb8kQIl.Qa9RPi', '699e459ea03281c38f411913f3c65ad5', 'quynhduong1112@gmail.com', '113.23.50.37', 'https://www.facebook.com/profile.php?id=1000224377', '2024-10-11 15:11:37', 0, 1, '1393d31b22c8911f6a390dddc3574ddf', ''),
(183, 'quynhbabe1112', '$2y$10$dix2Y4SBCUPu7yuYI/abFeEJC8ArKSEPR9OzmLd7S1XsLMo7/kAj6', 'acbd3aebf9312df0892b53a78445ac69', 'duongquynh1112@gmail.com', '113.23.50.37', 'https://www.facebook.com/profile.php?id=1000224377', '2024-10-11 15:19:18', 0, 1, 'a80f3d00f20cc189c33721c350c8e02b', ''),
(184, 'Tiáº¿n DÅ©ng', '$2y$10$4wD6HMOqhQ9fUG35/6qTD.LzNYNoIQmlFD3fTV2F6EV7KxRn9r3l.', '7069a4494278bcee81946f3fd87584f9', 'baconga160299@gmail.com', '14.169.36.38', 'https://www.facebook.com/profile.php?id=1000710633', '2024-10-11 15:51:03', 0, 1, '4a0670ad7217d548adff13765ca49202', ''),
(185, 'Pham Minh Trung', '$2y$10$GmUXF27yAVcQxUHKzDwyWu3yVfaV5Rr1pNNbIbHp.8v9vEgmJLPMW', 'a481be3e8fc5d8d7759133db8a6e6b68', 'trungpham45@gmail.com', '27.74.112.140', 'https://www.facebook.com/enkrateiamosin/', '2024-10-12 01:12:20', 1, 1, 'efbaf9e428aaddbd3bacd656eafc30f1', ''),
(186, 'Drace', '$2y$10$UUaRnsWf8BrDvdBoEg7W5edVzPcn6pFO1uKCjLihBJW1F8R7ijiVO', 'ac5b81fb1855bd847d8b10708bbf8b70', 'Vohuongcd1972@gmail.com', '125.235.237.102', 'https://www.facebool.com/Drace8/', '2024-10-12 04:22:09', 1, 1, '166abda590b0c00ae905c8fd741412a5', ''),
(187, 'Nguyentoan05', '$2y$10$/HGgMtSg1KmlZJaSycSTTOrvb2.Xr4yZrMiqrQ5dGJQqugbLSaSye', '6f01002fab48e59a62a5f419505dd525', 'meoconv11032005@gmail.com', '14.231.53.133', 'https://www.facebook.com/search/top/?q=tool%20th%C', '2024-10-13 04:09:34', 0, 1, 'd0dc05eaf2d7a0ba6d9563af9e452473', ''),
(188, 'dhthuytien', '$2y$10$jfJF.bVgToBGomSYODbvl.jidIIp3Pgkb/P7.4sAxh8a9/1vut.vW', '122dc01767b0c5360fd31a51cfc2c733', 'dinhhuynhthuytien@gmail.com', '108.17.29.15', 'https://www.facebook.com/profile.php?id=1000245577', '2024-10-14 19:42:30', 0, 1, 'eb9ee53bdda06eb0533d4f8e5bdb54f7', ''),
(189, 'Ngo Duy Thien', '$2y$10$Gs.sDRkiLOVdnCE1tIO/IeqHjoih777EHZobPFDd/W0Eulu4AKhwi', 'a4335c9781945aad1f9cd8aab399f33f', 'thienngo1993@hotmail.com', '101.53.42.1', 'https://www.facebook.com/ngo.andy.7393/', '2024-10-15 01:02:33', 0, 1, '42820c28e00da7b4cd3d2031f93ebdef', ''),
(190, 'Lequynh1311', '$2y$10$qFdjpoGST.1uveBVB5N9x.rs6dHQG5sPzJFzdd4Ygi/ywKyA9FkYO', '64ad8ae91105b7c64fb36bf343e480e3', 'quyenhdaica1311@gmail.com', '171.246.8.131', 'https://web.facebook.com/profile.php?id=1000144231', '2024-10-15 02:45:32', 0, 1, 'de4912e7215c89fad1ab01cb8a485701', ''),
(191, 'imiuimu', '$2y$10$d69hqN47KdArVm.14J/0GeddJyGeWFXZDWvBIpvNwC5.ts2ktGwqe', 'bf569fe9392384df1ee01e677930e24b', 'seidjelly4@gmail.com', '118.71.222.48', 'https://www.facebook.com/thnhv/', '2024-10-18 14:57:50', 0, 1, '99728cc3348e7c1e696ac3012d4ec3de', ''),
(192, 'Aiman', '$2y$10$hgkcUPWVDQ5z40TkKcwReeNVkNW38DdNvTmDuBueixJ75Xm9ugvIG', '5c903cd1e95983953398771948622164', 'aimanlanaali@gmail.com', '92.31.136.222', 'https://www.facebook.com/groups/389845498441780', '2024-10-20 08:23:25', 0, 1, 'f9131efa32ef076e845c9554264d01c3', ''),
(193, 'Binkhanh', '$2y$10$dJMBrVd97U.DpqP1jDG4nORGfstQzA.51fZfQTxohV/ZFkFnOu5BG', '2189acb308123dfb9f03c65478ef3b55', 'conan.shinichi2001@gmail.com', '42.113.160.167', 'https://www.facebook.com/binkhanhhh/', '2024-10-22 13:54:14', 1, 1, 'd09b4cdcd1573d9e770c95103f03c69c', '2129f447f1c85bf61c32dabbf276c840'),
(195, 'TrÆ°Æ¡ng Quang Háº£i', '$2y$10$jJcbCmxotQyBq8fdm6bMb.Kvu71QVdX0LHCj3IxyG/bovGF8n6RoG', '8c3bd6e398b6c98b98a4f9e3539f0c95', 'truongquanghai95@gmail.com', '115.76.51.118', 'https://www.facebook.com/hai.truongquang.108?mibex', '2024-10-24 14:52:33', 0, 1, 'cbbe6675edf41f968f9357ec876898af', ''),
(196, 'bokimeomeo', '$2y$10$yRfeie7EpqWkAaHUzzQ2a.Asy/.8GlvzvR9uQZRsxUoEtWqszBagW', 'e10b7066ff3bda27205ba5b26a0a5b87', 'khanhvy.nguyendiep0201@gmail.com', '118.68.84.161', 'https://www.facebook.com/khanhvy.nguyendiep.7/', '2024-10-25 07:16:03', 1, 1, 'ea74db9ac6ad208b91df745ccdc52b9e', ''),
(197, 'elizabethmyn', '$2y$10$rVSajiTUuXvk5OiP194hYeT1zeQZiN./4g3HEotEt7fxPlFEeW36u', 'b5ae9bff68620f1e097274e62765fc66', 'lethidiemmy961996@gmail.com', '14.234.144.60', 'https://www.facebook.com/my.lethidiem.9696', '2024-10-25 09:31:35', 1, 1, '249295f64c2312fa26e08deedf90aeda', ''),
(198, 'DrPhan65Ielts', '$2y$10$bZhb3jwN7gkyHLWdgS4TaO0FyvGEhdoj4luYbwa8BVLa.Zi8ydQE.', '3c81d22c592be891f8374fc792063357', 'phan_nguyen30@yahoo.com', '113.23.105.101', 'https://www.facebook.com/nguyen.phan.1504/', '2024-10-25 21:55:53', 0, 1, '0e0285b84d66ac27b0755a9fc4b8af39', '');

-- --------------------------------------------------------

--
-- Table structure for table `user_data`
--

CREATE TABLE `user_data` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `reviews` int(11) DEFAULT NULL,
  `streak_current` int(11) DEFAULT NULL,
  `streak_highest` int(11) DEFAULT NULL,
  `time` float DEFAULT NULL,
  `challengexp` float NOT NULL,
  `streak_date` varchar(50) NOT NULL,
  `first` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `user_data`
--

INSERT INTO `user_data` (`id`, `user_id`, `reviews`, `streak_current`, `streak_highest`, `time`, `challengexp`, `streak_date`, `first`) VALUES
(69, 85, 2726, 0, 8, 311.74, 0, '2024-10-24', 0),
(100, 116, 0, 0, 0, 0, 0, '2024-10-10', 0),
(103, 119, 3607, 18, 18, 477.49, 0, '2024-10-28', 0),
(104, 120, 1500, 3, 4, 397.29, 0, '2024-10-29', 1),
(106, 122, 2448, 8, 8, 254.93, 0, '2024-10-29', 1),
(107, 123, 1903, 6, 6, 320.98, 0, '2024-10-28', 0),
(109, 125, 665, 0, 2, 262.35, 0, '2024-10-25', 0),
(120, 136, 4658, 19, 19, 1308.89, 0, '2024-10-29', 1),
(123, 139, 735, 0, 4, 263.82, 0, '2024-10-27', 0),
(125, 141, 1955, 2, 3, 278.55, 0, '2024-10-29', 1),
(126, 142, 100, 0, 2, 30.53, 0, '2024-10-11', 0),
(128, 144, 13265, 19, 19, 1570.77, 0, '2024-10-29', 1),
(133, 149, 2393, 1, 6, 607.37, 0, '2024-10-29', 1),
(134, 150, 9222, 1, 5, 238.11, 0, '2024-10-28', 0),
(137, 153, 3852, 0, 6, 403.01, 0, '2024-10-26', 0),
(138, 154, 7200, 14, 14, 2016.36, 0, '2024-10-28', 0),
(143, 159, 0, 0, 0, 0, 0, '2024-10-10', 0),
(144, 160, 1163, 0, 9, 446.65, 0, '2024-10-27', 0),
(145, 161, 2635, 1, 2, 547.25, 0, '2024-10-29', 1),
(147, 163, 1359, 2, 6, 469.98, 0, '2024-10-29', 1),
(154, 170, 46, 2, 2, 53.7, 0, '2024-10-28', 0),
(155, 171, 3960, 1, 9, 430.74, 0, '2024-10-29', 1),
(156, 172, 0, 0, 0, 0, 0, '2024-10-10', 0),
(157, 173, 0, 0, 0, 0, 0, '2024-10-10', 0),
(158, 174, 0, 0, 0, 0, 0, '2024-10-10', 0),
(159, 175, 351, 0, 2, 127.5, 0, '2024-10-25', 0),
(160, 176, 0, 0, 0, 0, 0, '2024-10-11', 0),
(161, 177, 0, 0, 0, 0, 0, '2024-10-11', 0),
(162, 178, 0, 0, 0, 0, 0, '2024-10-11', 0),
(163, 179, 3341, 3, 6, 446.22, 0, '2024-10-28', 0),
(164, 180, 0, 0, 0, 0, 0, '2024-10-11', 0),
(165, 181, 37, 0, 1, 0.28, 0, '2024-10-11', 0),
(166, 182, 0, 0, 0, 0, 0, '2024-10-11', 0),
(167, 183, 0, 0, 0, 0, 0, '2024-10-11', 0),
(168, 184, 0, 0, 0, 0, 0, '2024-10-11', 0),
(169, 185, 4393, 1, 4, 563.9, 0, '2024-10-28', 0),
(170, 186, 6043, 18, 18, 1700.51, 0, '2024-10-29', 1),
(171, 187, 0, 0, 0, 0, 0, '2024-10-13', 0),
(172, 188, 0, 0, 0, 0, 0, '2024-10-14', 0),
(173, 189, 0, 0, 0, 0, 0, '2024-10-15', 0),
(174, 190, 0, 0, 0, 0, 0, '2024-10-15', 0),
(175, 191, 0, 0, 0, 0, 0, '2024-10-18', 0),
(176, 192, 0, 0, 0, 0, 0, '2024-10-20', 0),
(177, 193, 160, 0, 3, 44.65, 0, '2024-10-25', 0),
(179, 195, 0, 0, 0, 0, 0, '2024-10-24', 0),
(180, 196, 0, 0, 0, 0, 0, '2024-10-25', 0),
(181, 197, 0, 0, 0, 0, 0, '2024-10-25', 0),
(182, 198, 0, 0, 0, 0, 0, '2024-10-25', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `leaderboard`
--
ALTER TABLE `leaderboard`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_data`
--
ALTER TABLE `user_data`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `leaderboard`
--
ALTER TABLE `leaderboard`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=463;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=199;

--
-- AUTO_INCREMENT for table `user_data`
--
ALTER TABLE `user_data`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=183;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `leaderboard`
--
ALTER TABLE `leaderboard`
  ADD CONSTRAINT `leaderboard_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

--
-- Constraints for table `user_data`
--
ALTER TABLE `user_data`
  ADD CONSTRAINT `user_data_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
