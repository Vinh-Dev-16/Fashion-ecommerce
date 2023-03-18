-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th2 21, 2023 lúc 11:25 AM
-- Phiên bản máy phục vụ: 10.4.24-MariaDB
-- Phiên bản PHP: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `vsh_movie`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `account`
--

CREATE TABLE `account` (
  `id` int(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `otp` text NOT NULL,
  `uname` varchar(255) NOT NULL,
  `pwd` varchar(255) NOT NULL,
  `role` int(2) NOT NULL,
  `accdate` date NOT NULL,
  `fullname` varchar(255) NOT NULL,
  `avatar` text NOT NULL,
  `address` varchar(255) NOT NULL,
  `birthday` date NOT NULL,
  `gender` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `account`
--

INSERT INTO `account` (`id`, `email`, `otp`, `uname`, `pwd`, `role`, `accdate`, `fullname`, `avatar`, `address`, `birthday`, `gender`) VALUES
(1, 'vinhhttt@gmail.com', '', 'admin', '$2y$10$ma.fblXIiZdzJ.GqjHarg.592gnXxMHre8bpgoVDgiKHj2NeXluOu', 1, '2022-09-16', 'Đào Xuân Vinh', 'beauty_20220420161448.jpg', 'Cửu Việt 2', '2001-12-06', 'Nam'),
(2, '', '', 'sinhlvs', '$2y$10$y1pCnIeAG4239vZTmHtQjO0n.Q7uVh.AD0F4JVK45nq7oNaSK5z3y', 1, '2022-11-16', 'Lê Văn Sinh', '', '', '0000-00-00', ''),
(3, 'vinhdev16@gmail.com', '', 'vinh', '$2y$10$rMjM/Xjb5NIE8xzgh9zfC.00QcFCQ7LoQ./UosljWREmycD4/4Nfa', 2, '2022-12-04', 'Đào Xuân Vinh', 'beauty_20220420161448.jpg', 'Nam Định', '2001-06-16', 'Nam'),
(4, '', '', 'nhung', '$2y$10$ReTWuZQlhlC2rrg3kESE5uOP.IUuaP1XmN0lHD320uAmi89vPIttq', 2, '2022-12-08', '', '', '', '0000-00-00', '');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `actor`
--

CREATE TABLE `actor` (
  `id` int(255) NOT NULL,
  `mv_id` int(255) NOT NULL,
  `actor_id` int(255) NOT NULL,
  `actor_name` varchar(255) NOT NULL,
  `actor_birthday` varchar(255) NOT NULL,
  `actor_location` varchar(255) NOT NULL,
  `actor_img` text NOT NULL,
  `actor_info` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `category`
--

CREATE TABLE `category` (
  `id` int(50) NOT NULL,
  `category_id` int(50) NOT NULL,
  `category_name` varchar(255) NOT NULL,
  `post` int(255) NOT NULL,
  `cat_name_ascii` varchar(255) NOT NULL,
  `cat_name_tag` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `category`
--

INSERT INTO `category` (`id`, `category_id`, `category_name`, `post`, `cat_name_ascii`, `cat_name_tag`) VALUES
(1, 1, 'Hành động', 0, 'phim hanh dong, action', 'phimhanhdong, action'),
(2, 2, 'Anime', 0, 'anime', 'anime,catoon,phimhoat hinh'),
(3, 3, 'Tình cảm', 0, ' tinh cam', ' tinh cam,love,drama'),
(4, 4, 'Ma-Kinh dị', 0, 'ma-kinh di', 'ma,kinh di,gosht,thriller'),
(5, 5, 'Võ thuật', 0, 'phim vo thuat', 'phimvothuat'),
(6, 6, 'Phiêu lưu', 0, 'Phim phieu luu', 'phimphieuluu,'),
(7, 7, 'Khoa hoc', 0, 'khoa hoc', 'phimkhoahoc'),
(8, 8, 'Chiến tranh', 0, 'phim chien tranh', 'phimchientranh');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `cat_mv`
--

CREATE TABLE `cat_mv` (
  `id_cat` int(255) NOT NULL,
  `mv_id` int(255) NOT NULL,
  `category_id` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `cat_mv`
--

INSERT INTO `cat_mv` (`id_cat`, `mv_id`, `category_id`) VALUES
(1, 1, 2),
(2, 1, 3),
(3, 2, 2),
(4, 2, 6),
(5, 3, 2),
(6, 3, 6),
(7, 4, 1),
(8, 4, 6),
(9, 5, 4),
(10, 5, 5),
(11, 6, 5),
(12, 7, 1),
(13, 7, 6),
(14, 8, 3),
(15, 9, 6),
(16, 10, 5),
(17, 1, 2);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `complete`
--

CREATE TABLE `complete` (
  `id` int(255) NOT NULL,
  `uname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `complete_date` date NOT NULL,
  `message` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `complete`
--

INSERT INTO `complete` (`id`, `uname`, `email`, `complete_date`, `message`) VALUES
(1, 'vinh', 'vinhhttt@gmail.com', '1970-01-01', 'test lần 3'),
(2, 'vinh', 'vinhhttt@gmail.com', '1970-01-01', 'test thử');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `contact`
--

CREATE TABLE `contact` (
  `id` int(255) NOT NULL,
  `uname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `msg_date` date NOT NULL,
  `message` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `contact`
--

INSERT INTO `contact` (`id`, `uname`, `email`, `msg_date`, `message`) VALUES
(2, 'a', 'vinhhttt@gmail.com', '2022-12-08', 'a'),
(3, 'a', 'vinhhttt@gmail.com', '2022-12-08', 'a'),
(4, 'aaaa', 'vinhhttt@gmail.com', '2022-12-16', '1'),
(5, 'aaa', 'vinhhttt@gmail.com', '2022-12-07', '1'),
(6, 'qqqq', 'vinhhttt@gmail.com', '2022-12-14', '1');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `episode`
--

CREATE TABLE `episode` (
  `id` int(255) NOT NULL,
  `es_id` int(255) NOT NULL,
  `mv_id` int(255) NOT NULL,
  `es_name` varchar(255) NOT NULL,
  `es_url` text NOT NULL,
  `es_sub` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `episode`
--

INSERT INTO `episode` (`id`, `es_id`, `mv_id`, `es_name`, `es_url`, `es_sub`) VALUES
(1, 0, 1, 'Tập 1', 'https://drive.google.com/file/d/1YhwDvEVHeLVJvC-OmjUDzvTxsvXOFBIb/preview', ''),
(2, 0, 1, 'Tập 2', 'https://drive.google.com/file/d/16rBbZK-O3TtOl1kVIBU-tH4ILigozAyI/preview', ''),
(3, 0, 1, 'Tập 3', 'https://drive.google.com/file/d/16rBbZK-O3TtOl1kVIBU-tH4ILigozAyI/preview', ''),
(4, 0, 29, 'Tập 1', 'https://drive.google.com/file/d/1YhwDvEVHeLVJvC-OmjUDzvTxsvXOFBIb/preview', ''),
(5, 0, 2, 'tập 1', 'https://drive.google.com/file/d/1ZT0PXltsMETVd-IvZM6KpjvnUOsTJ-iT/preview', ''),
(6, 0, 2, 'tập 2', 'https://drive.google.com/file/d/1Z-hDBziqzSFhkW9Kj6uUC_KQK0lC097o/preview', ''),
(7, 0, 2, 'tập 3', 'https://drive.google.com/file/d/1ZEOcTkp7EDtS5iCUyCGvcycoJ2wG5W9w/preview', ''),
(8, 0, 3, 'tập 1', 'https://drive.google.com/file/d/1FGBMwNQDDNsGNPwbp26pELCn2PHN1g3E/preview', ''),
(9, 0, 3, 'tập 3', 'https://drive.google.com/file/d/16LjbkNFbsK4MKOSLc2IY_V6a_tKkih6h/preview', ''),
(10, 0, 4, 'tập 1', 'https://drive.google.com/file/d/1uMe-VwuZjh-pFbu4cyZ5IdIXUEdxUTmz/preview', ''),
(11, 0, 6, 'tập 1', 'https://drive.google.com/file/d/1uMe-VwuZjh-pFbu4cyZ5IdIXUEdxUTmz/preview	', ''),
(13, 0, 7, 'Full', 'https://drive.google.com/file/d/1uMe-VwuZjh-pFbu4cyZ5IdIXUEdxUTmz/preview', ''),
(14, 0, 6, 'tập 2', 'https://drive.google.com/file/d/1uMe-VwuZjh-pFbu4cyZ5IdIXUEdxUTmz/preview	', ''),
(15, 0, 6, 'tập 3', 'https://drive.google.com/file/d/1uMe-VwuZjh-pFbu4cyZ5IdIXUEdxUTmz/preview	', ''),
(16, 0, 8, 'tập 1', 'https://drive.google.com/file/d/1uMe-VwuZjh-pFbu4cyZ5IdIXUEdxUTmz/preview	', ''),
(17, 0, 8, 'tập 2', 'https://drive.google.com/file/d/1uMe-VwuZjh-pFbu4cyZ5IdIXUEdxUTmz/preview	', ''),
(18, 0, 8, 'tập 3', 'https://drive.google.com/file/d/1uMe-VwuZjh-pFbu4cyZ5IdIXUEdxUTmz/preview	', ''),
(19, 0, 9, 'Full', 'https://drive.google.com/file/d/1uMe-VwuZjh-pFbu4cyZ5IdIXUEdxUTmz/preview	', ''),
(20, 0, 9, 'Full', 'https://drive.google.com/file/d/1uMe-VwuZjh-pFbu4cyZ5IdIXUEdxUTmz/preview	', ''),
(21, 0, 10, 'Full', 'https://drive.google.com/file/d/1uMe-VwuZjh-pFbu4cyZ5IdIXUEdxUTmz/preview	', ''),
(22, 0, 11, 'Full', 'https://drive.google.com/file/d/1uMe-VwuZjh-pFbu4cyZ5IdIXUEdxUTmz/preview	', ''),
(23, 0, 12, 'Full', 'https://drive.google.com/file/d/1uMe-VwuZjh-pFbu4cyZ5IdIXUEdxUTmz/preview	', ''),
(24, 0, 13, 'Full', 'https://drive.google.com/file/d/1uMe-VwuZjh-pFbu4cyZ5IdIXUEdxUTmz/preview	', ''),
(25, 0, 14, 'Full', 'https://drive.google.com/file/d/1uMe-VwuZjh-pFbu4cyZ5IdIXUEdxUTmz/preview	', ''),
(26, 0, 15, 'tập 1', 'https://drive.google.com/file/d/1uMe-VwuZjh-pFbu4cyZ5IdIXUEdxUTmz/preview	', ''),
(27, 0, 15, 'tập 2', 'https://drive.google.com/file/d/1uMe-VwuZjh-pFbu4cyZ5IdIXUEdxUTmz/preview	', ''),
(28, 0, 15, 'tập 3', 'https://drive.google.com/file/d/1uMe-VwuZjh-pFbu4cyZ5IdIXUEdxUTmz/preview	', ''),
(29, 0, 16, 'tập 1', 'https://drive.google.com/file/d/1uMe-VwuZjh-pFbu4cyZ5IdIXUEdxUTmz/preview	', ''),
(30, 0, 16, 'tập 2', 'https://drive.google.com/file/d/1uMe-VwuZjh-pFbu4cyZ5IdIXUEdxUTmz/preview	', ''),
(31, 0, 16, 'tập 3', 'https://drive.google.com/file/d/1uMe-VwuZjh-pFbu4cyZ5IdIXUEdxUTmz/preview	', ''),
(32, 0, 17, 'Full', 'https://drive.google.com/file/d/1uMe-VwuZjh-pFbu4cyZ5IdIXUEdxUTmz/preview	', ''),
(33, 0, 18, 'tập 1', 'https://drive.google.com/file/d/1uMe-VwuZjh-pFbu4cyZ5IdIXUEdxUTmz/preview	', ''),
(34, 0, 18, 'tập 2', 'https://drive.google.com/file/d/1uMe-VwuZjh-pFbu4cyZ5IdIXUEdxUTmz/preview	', ''),
(35, 0, 18, 'tập 3', 'https://drive.google.com/file/d/1uMe-VwuZjh-pFbu4cyZ5IdIXUEdxUTmz/preview	', ''),
(36, 0, 19, 'Full', 'https://drive.google.com/file/d/1uMe-VwuZjh-pFbu4cyZ5IdIXUEdxUTmz/preview	', ''),
(37, 0, 20, 'tập 1', 'https://drive.google.com/file/d/1uMe-VwuZjh-pFbu4cyZ5IdIXUEdxUTmz/preview	', ''),
(38, 0, 20, 'tập 2', 'https://drive.google.com/file/d/1uMe-VwuZjh-pFbu4cyZ5IdIXUEdxUTmz/preview	', ''),
(39, 0, 20, 'tập 3', 'https://drive.google.com/file/d/1uMe-VwuZjh-pFbu4cyZ5IdIXUEdxUTmz/preview	', ''),
(40, 0, 21, 'tập 1', 'https://drive.google.com/file/d/1uMe-VwuZjh-pFbu4cyZ5IdIXUEdxUTmz/preview	', ''),
(41, 0, 21, 'tập 2', 'https://drive.google.com/file/d/1uMe-VwuZjh-pFbu4cyZ5IdIXUEdxUTmz/preview	', ''),
(42, 0, 21, 'tập 3', 'https://drive.google.com/file/d/1uMe-VwuZjh-pFbu4cyZ5IdIXUEdxUTmz/preview	', ''),
(43, 0, 22, 'tập 1', 'https://drive.google.com/file/d/1uMe-VwuZjh-pFbu4cyZ5IdIXUEdxUTmz/preview	', ''),
(44, 0, 22, 'tập 2', 'https://drive.google.com/file/d/1uMe-VwuZjh-pFbu4cyZ5IdIXUEdxUTmz/preview	', ''),
(45, 0, 22, 'tập 3', 'https://drive.google.com/file/d/1uMe-VwuZjh-pFbu4cyZ5IdIXUEdxUTmz/preview	', '');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `favorite`
--

CREATE TABLE `favorite` (
  `id` int(255) NOT NULL,
  `mv_id_fav` int(255) NOT NULL,
  `id_user` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `favorite`
--

INSERT INTO `favorite` (`id`, `mv_id_fav`, `id_user`) VALUES
(2, 14, 1),
(8, 1, 4),
(9, 30, 3);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `genre`
--

CREATE TABLE `genre` (
  `id` int(255) NOT NULL,
  `genre_name` varchar(255) NOT NULL,
  `category_id` int(255) NOT NULL,
  `genreid` int(255) NOT NULL,
  `post` int(255) NOT NULL,
  `genre_name_ascii` varchar(255) NOT NULL,
  `genre_name_tag` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `genre`
--

INSERT INTO `genre` (`id`, `genre_name`, `category_id`, `genreid`, `post`, `genre_name_ascii`, `genre_name_tag`) VALUES
(1, 'Phim bộ', 1, 1, 0, '', ''),
(2, 'Phim lẻ', 2, 2, 0, '', ''),
(3, 'Phim chiếu rạp', 3, 3, 0, '', ''),
(4, 'Phim hoạt hình', 4, 4, 0, '', '');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `movie`
--

CREATE TABLE `movie` (
  `id` int(255) NOT NULL,
  `cat_id` varchar(255) NOT NULL,
  `genre_id` int(255) NOT NULL,
  `mv_nation` int(255) NOT NULL,
  `mv_year` int(255) NOT NULL,
  `mv_date` date NOT NULL,
  `mv_name` varchar(255) NOT NULL,
  `mv_actor` varchar(255) NOT NULL,
  `mv_des` varchar(255) NOT NULL,
  `mv_img` text NOT NULL,
  `mv_bg` text NOT NULL,
  `mv_quality` text NOT NULL,
  `mv_duration` text NOT NULL,
  `mv_tag` varchar(255) NOT NULL,
  `mv_status` varchar(255) NOT NULL,
  `mv_trailer` varchar(255) NOT NULL,
  `mv_favorite` varchar(255) NOT NULL,
  `IMDb` text NOT NULL,
  `mv_role` varchar(255) NOT NULL,
  `mv_request` varchar(255) NOT NULL,
  `mv_deces` text NOT NULL,
  `mv_view` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `movie`
--

INSERT INTO `movie` (`id`, `cat_id`, `genre_id`, `mv_nation`, `mv_year`, `mv_date`, `mv_name`, `mv_actor`, `mv_des`, `mv_img`, `mv_bg`, `mv_quality`, `mv_duration`, `mv_tag`, `mv_status`, `mv_trailer`, `mv_favorite`, `IMDb`, `mv_role`, `mv_request`, `mv_deces`, `mv_view`) VALUES
(1, 'Array', 4, 2, 1, '2022-09-20', 'Conan-Thám tử lừng danh trung học', 'Edogawa Conan, Mouri Kogori , Ran Mouri, Haibara AI ,  Agasa Hirosi , Yoshida Ayumi, Tsuburaya Misuhiko, Kojima Genta,Suzuki Sonoko', 'Kodama Kenjj', 'https://i.pinimg.com/564x/d8/53/20/d85320e13f8f37ed0d78b139b0d934cb.jpg', 'https://th.bing.com/th/id/R.38aa179447e0a2aa129b8156b2ef7f1b?rik=Uf0TvgKjDGfpsA&pid=ImgRaw&r=0', 'HD', '24 phút/ 1 tập', 'conan, tham tu lung danh, shinichi', 'Phim đang chiếu', 'https://www.youtube.com/embed/iR2l9M0KzuQ', '', '8.9', 'VIP', '13 tuổi đổ lên', 'Mở đầu câu truyện, cậu học sinh trung học 17 tuổi Shinichi Kudo bị biến thành cậu bé Conan Edogawa. Shinichi trong phần đầu của Thám tử lừng danh Conan được miêu tả là một thám tử học đường xuất sắc. Trong một lần đi chơi công viên ', 247),
(2, '2', 4, 2, 10, '2022-09-21', 'Doraemon-Chú mèo máy đến từ tương lai', 'Doraemon, Nobi Nobita, Minamoto Shizuka, Honekawa Suneo, Gouda Takeshi', 'Kusuba Kouzou', 'https://i.pinimg.com/564x/f7/aa/91/f7aa91ec120e833804ec0d38eb7dfe87.jpg', 'https://th.bing.com/th/id/R.bf03df1cbd62184fa5bcb1d3ad43ed9f?rik=9RqSeAE3BBpOuw&riu=http%3a%2f%2fwallpapercave.com%2fwp%2fwc1673672.jpg&ehk=zsVO8nu5YRNNwRKixVbieudh5blVyTntF3Zhjhljp3k%3d&risl=&pid=ImgRaw&r=0', 'HD', '24 phút /1 tập', 'doraemon, nobita, meo may', 'Phim đang chiếu', 'https://www.youtube.com/embed/hPsDgOvumsc', '', '7.8', '', '5 tuổi trở lên', 'Các câu chuyện trong Doraemon thường có một công thức chung, đó là xoay quanh những rắc rối hay xảy ra với cậu bé Nobita học lớp bốn, nhân vật chính thứ nhì của bộ truyện. Doraemon có một chiếc túi thần kỳ trước bụng với đủ loại bảo bối của tương lai. Cốt truyện thường gặp nhất sẽ là Nobita trở về nhà khóc lóc với những rắc rối mà cậu gặp phải ở trường hoặc với bạn bè. Sau khi bị cậu bé van nài hoặc thúc giục, Doraemon sẽ đưa ra một bảo bối giúp Nobita giải quyết những rắc rối của mình, hoặc là để trả đũa hay khoe khoang với bạn bè của cậu. Nobita sẽ lại thường đi quá xa so với dự định ban đầu của Doraemon, thậm chí với những bảo bối mới cậu còn gặp rắc rối lớn hơn trước đó. Đôi khi những người bạn của Nobita, thường là Suneo (Xêkô) hoặc Jaian (Chaien) lại lấy trộm những bảo bối và sử dụng chúng không đúng mục đích. Tuy nhiên thường thì ở cuối mỗi câu chuyện, những ai sử dụng sai mục đích bảo bối sẽ phải chịu hậu quả do mình gây ra, và người đọc sẽ rút ra được bài học từ đó', 24),
(3, '2', 4, 2, 4, '2022-09-27', 'One Piece-Đảo Hải Tặc', 'Monkey.D.Luffy, Roronoa Zoro, Nami, Usopp, Sanji, TonyTony Chopper, Nico Robin, Brook,...', 'Uda Kounosuke, Ishitami Megumi', 'https://i.pinimg.com/564x/89/30/9b/89309bb23bfe0c2afe809c1fff5ac81f.jpg', 'http://cdn.animevietsub.cc/data/banner/2022/07/31/animevsub-NxQxhIAgug.png', 'HD', '24 phút /1 tập', 'one-piece, luffy, dao hai tac, zoro', 'Phim đang chiếu', 'https://www.youtube.com/embed/S8_YwFLCh4U', '', '8.9', 'VIP', '13 tuổi đổ lên', 'Là chuyện về cậu bé Monkey D. Luffy do ăn nhầm Trái Ác Quỷ, bị biến thành người cao su và sẽ không bao giờ biết bơi. 10 năm sau sự việc đó, cậu rời quê mình và kiếm đủ 10 thành viên để thành một băng hải tặc, biệt hiệu Hải tặc Mũ Rơm. Khi đó của phiêu lưu tìm kiếm kho báu One Piece bắt đầu. Trong cuộc phiêu lưu tìm kiếm One Piece, băng Hải tặc mũ rơm phải chiến đấu với nhiều băng hải tặc xấu khác cũng muốn độc chiếm One Piece và Hải quân của Chính phủ muốn diệt trừ hải tặc. Băng Hải tặc Mũ Rơm phải trải qua biết bao nhiêu khó khăn, không lùi bước với ước mơ ', 33),
(4, '1', 1, 1, 27, '2022-09-23', 'House of the Dragon-Gia Tộc Rồng', 'Paddy Considine, Matt Smith, Emma D*Arcy, Olivia Cooke', 'Miguel Sapocchnik', 'https://i.pinimg.com/564x/97/16/a5/9716a5b683ccc618bd6ea8b785633df6.jpg', 'https://i.pinimg.com/564x/6a/00/e8/6a00e89062bf4aefe4d730488388d179.jpg', 'HD-Vietsub', '10 tập', 'gia toc rong, house of dragon', 'Phim đang chiếu', 'https://www.youtube.com/embed/DotnJ7tTA34?html5=1&autoplay=0&controls=0&showinfo=0&rel=0&modestbranding=0&playsinline=1&origin=https%3A%2F%2Fphimmoichills.net&enablejsapi=1&widgetid=1', '', '8.7', 'VIP', '15 tuổi đổ lên', 'Là một phần tiền truyện sắp ra mắt của Game of Thrones . Bộ phim này được HBO công bố vào tháng 10 năm 2019. Phần tiền truyện quay trở lại khoảng 200 năm xoay quanh sự khởi đầu của sự kết thúc của triều đại toàn năng từng thống trị Bảy Vương quốc Westeros.Phần tiền truyện Trò chơi vương quyền cho thấy triều đại Targaryen đang ở đỉnh cao sức mạnh thịnh vượng, với hơn 15 con rồng dưới ách của triều đại. Hầu hết các đế chế - có thật và trong tưởng tượng - đều sụp đổ từ những đỉnh cao như vậy. Trong trường hợp của nhà Targaryens, sự sụp đổ chậm chạp của họ bắt đầu từ gần năm 193 nhiều năm trước các sự kiện của Game of Thrones , khi Vua Viserys Targaryen phá vỡ truyền thống thế kỷ bằng cách đặt tên con gái mình là Rhaenyra người thừa kế ngai vàng. Nhưng khi Viserys sau này có một đứa con trai, cả triều đình đã bị sốc khi Rhaenyra vẫn giữ tư cách là người thừa kế của ông. , và hạt giống của sự chia rẽ gieo rắc xích mích trên toàn cõi', 57),
(5, '4', 3, 3, 27, '2022-09-26', 'The Lake-Quái vật sông Mekong', 'Sushar Manaying, Teerapat Satjakul, Vithaya Pansringarm, Wanmai Chatborirak, Lamyai Haithongkham, Thanachart Tulyachart, Eed Ponglang,', 'Lee Thongkham', 'https://www.cgv.vn/media/catalog/product/cache/3/image/1800x/71252117777b696995f01934522c402d/t/h/the_lake_700_x_1000_px_.jpg', 'https://www.cgv.vn/media/catalog/product/cache/3/small_image/600x314/a134659ca47b28f7b266e1777fbf870f/t/h/the_lake_1920x1080-2_1_.jpg', 'HD-Trailer', '105 phút', 'the lake, quai vat,mekong', 'Phim sắp chiếu', 'https://www.youtube.com/embed/orcxSddIA4s?html5=1&autoplay=0&controls=0&showinfo=0&rel=0&modestbranding=0&playsinline=1&origin=https%3A%2F%2Fphimmoichills.net&enablejsapi=1&widgetid=1', '', '5', '', '16 tuổi đổ lên', 'Việc lớn có khởi đầu nhỏ. Một cô gái nông thôn nhỏ bé tìm thấy một quả trứng bí ẩn trên một cánh đồng và mang nó đến thị trấn của cô Giờ đây, một con quái vật khổng lồ cao 9 mét trỗi dậy từ hồ gây ra sự tàn phá chỉ để tìm quả trứng của cô. The Lake , còn được gọi là บึงกาฬ hoặc Bueng Kan trong tiếng Thái, được chỉ đạo bởi nhà làm phim Thái Lan Lee Thongkham , đạo diễn của các bộ phim Tears of Remedy , The Last One và The Maid trước đây', 22),
(6, '1', 1, 4, 27, '2022-09-29', 'Ma Thổi Đèn-Thần Cung Côn Luân', ' Khương Siêu Lý, Phan Việt Minh, Trương Vũ Kỳ,', 'Phí Chấn Tường,', 'https://th.bing.com/th/id/R.85caf0233123ee10724379c69fd1c0bb?rik=2TiHtgg51mM1DQ&pid=ImgRaw&r=0', 'https://vozer.vn/storage/images/ma-thoi-den-thanh-co-tinh-tuyet-48702058.jpg', 'HD', '16', 'ma thoi den, con lon', 'Phim đang chiếu', 'https://www.youtube.com/embed/nXLBwGMvOpc?html5=1&autoplay=0&controls=0&showinfo=0&rel=0&modestbranding=0&playsinline=1&origin=https%3A%2F%2Fphimmoichills.net&enablejsapi=1&widgetid=1', '', '6.6', '', '15 tuổi đổ lên', 'Nhà buôn đồ cổ Hong Kong Ming Shu giao Hu Ba Yi, Wang Kai Xuan và Shirley Yang đi tìm xác chết trên sông băng trong vương quốc ma quỷ từ truyền thuyết về Vua Gesar. Vừa thoát khỏi thung lũng ', 183),
(7, '1', 2, 1, 27, '2022-10-09', 'Ma Sói Trong Đêm', 'Gael García Bernal, Laura Donnelly, Harriet Sansom Harris,', 'Michael Giacchino,', 'https://hit.edu.vn/cac-nhan-vat-trong-ma-soi/imager_25_10214_700.jpg', 'https://cdn.nguyenkimmall.com/images/companies/_1/tin-tuc/kinh-nghiem-meo-hay/laptop/tro-choi-ma-soi.jpg', 'Full HD Vietsub', '52 phút', 'Ma soi trong dem', 'Đang công chiếu', 'https://www.youtube.com/embed/bLEFqhS5WmI', '', '8.1', 'VIP', '18+', 'Là một tập phim truyền hình đặc biệt của đạo diễn Michael Giacchino phát hành trên dịch vụ phát trực tuyến Disney+, dựa trên nhân vật cùng tên của Marvel Comics. Đây là chương trình truyền hình đặc biệt đầu tiên trong Vũ trụ Điện ảnh Marvel nối tiếp các phần khác trong MCU do Marvel Studios sản xuất.Vào một đêm tối tăm và u ám, một đoàn thợ săn quái vật bí mật xuất hiện từ trong bóng tối và tập hợp tại Đền Bloodstone điềm báo sau cái chết của thủ lĩnh của họ. Trong một đài tưởng niệm kỳ lạ và rùng rợn về cuộc đời của nhà lãnh đạo, những người tham dự bị đẩy vào một cuộc cạnh tranh bí ẩn và chết chóc để giành lấy một di vật quyền năng - một cuộc săn lùng cuối cùng sẽ đưa họ đối mặt với một con quái vật nguy hiểm. Lấy cảm hứng từ những bộ phim kinh dị của những năm 1930 và 1940, đặc biệt làm lạnh nhằm mục đích gợi lên cảm giác sợ hãi và rùng rợn, với nhiều hồi hộp và sợ hãi trên đường đi khi chúng ta khám phá một góc mới của Vũ trụ Điện ảnh Marvel.', 24),
(8, '3', 1, 5, 27, '2022-10-10', 'Hãy Nói Cho Tôi Điều Ước Của Bạn', 'Won Ji Ahn, Yang Hee Kyung, Gil Hae Yeon, Yoo Soon Woon, Jeon Chae Eun,', ' Kim Yong Wan,', 'https://static2.vieon.vn/vieplay-image/poster_v4/2022/08/09/ugirmy90_660x946-haynoichotoidieuuoccuaban-3.jpg', 'https://media.saodaily.com/resize/1200x627/storage/files/quynhtrang/2022/09/30/4wfdvv12_1920x1080-haynoichotoid-201931.jpg', 'HD Vietsub', '16 tập', 'haynoichotoidieuuoccuaban', 'Đang công chiếu', 'https://www.youtube.com/embed/3zwi55rvcLo', '', '6.7', '', '18+', 'Yoon Kyeo Re là một thanh niên không biết gì ngoài sự khốn khổ kể từ khi còn là một đứa trẻ. Anh ta đã bị lạm dụng khi vẫn còn là một cậu bé và đã có một khoảng thời gian tồi tệ tại trại trẻ mồ côi nơi anh ta được nuôi dưỡng. Sau đó anh ta ở trong một trung tâm giam giữ trẻ vị thành niên. Và khi trưởng thành, mọi thứ không khá hơn, dẫn đến việc anh ta phải ngồi tù. Đánh bại và đau khổ là tất cả những gì anh ta biết, và anh ta tìm thấybản thân anh ấy cuối cùng của dây buộc của mình, cuối cùng đối mặt với khoảng trống… Nhưng khi anh ấy được lệnh của tòa án để phục vụ cộng đồng của mình tại một cơ sở chăm sóc cuối đời cho người bệnh nan y, mọi thứ bắt đầu thay đổi đối với anh ấy. Tại đây, anh gặp Kang Tae Shik không biết mệt mỏi, một người đàn ông trung niên, người dẫn đầu đội tình nguyện tại cơ sở. Kang Tae Shik đã thành lập một đơn vị có tên là Team Genie, chuyên cung cấp cho những bệnh nhân sắp chết điều ước cuối cùng của họ. Bất kể mọi người yêu cầu điều gì, Đội Genie sẽ làm việc chăm chỉ nhất để biến những điều ước cuối cùng quý giá đó thành hiện thực. Anh cũng gặp Seo Yeon Joo, một y tá trẻ không chịu từ bỏ bệnh nhân của mình và cố gắng giữ cho họ hoạt động thể chất mọi lúc. Liệu làm việc tại cơ sở này có giúp xoay chuyển cuộc đời của Yoon Gyeo Ree? Hay là đã quá muộn để thay đổi vận mệnh của anh ta?', 9),
(9, '6', 2, 1, 11, '2022-10-12', 'Chuyến Đi Thú Vị', ' Robin Williams, Cheryl Hines, Josh Hutcherson, Jeff Daniels, Kristin Chenoweth, Hunter Parrish, Alex Ferris, Will Arnett, Tony Hale, Brian Howe, Richard Ian Cox, Jojo, Chloe Sonnenfeld, Erika-Shaye Gair, Veronika Sztopa,', 'Barry Sonnenfeld,', 'https://i.imgur.com/eGyXXPGm.jpg', 'https://th.bing.com/th/id/R.2eb11bce6d35e8c4d100dda5179bd530?rik=%2bApqTNobheptjA&pid=ImgRaw&r=0', 'HD Vietsub', '99 phút', 'chuyendithuvi', 'phim sắp chiếu', 'https://www.youtube.com/embed/x2a_HjC0fBc', '', '7.2', '', '13+', 'Gia đình Munro kỳ quặc trải qua một kỳ nghỉ thảm hại, Bob (Robin Williams) là một giám đốc điều hành căng thẳng và bị ngược đãi bởi người đứng đầu tự mãn của mình, Todd Mallory (Will Arnett). Người cha đi cùng gia đình, mẹ (Cheryl Hines) và các con trai, cô con gái tuổi teen và cậu con trai nhỏ để bắt đầu các kỳ nghỉ, thuê một chiếc RV. Nhưng Bob thực sự cố gắng có một cuộc họp kinh doanh với các chủ sở hữu của một công ty đối thủ và chuyến đi đến Colorado Rocky. Sau một số sự cố đầy khó khăn và vấn đề, khi RV không bị hỏng và tàn phá và toa xe ga gia đình vui nhộn mất kiểm soát. Họ đi đến một khu vực đậu xe, nơi tìm thấy gia đình Gornicke bị rối loạn chức năng (Jeff Daniels, Kristin Chenoweth và hai con trai). Sau đó, họ chạy trốn khỏi Gornickes và tiếp tục cuộc hành trình mạo hiểm.', 10),
(10, '5', 2, 4, 27, '2022-10-13', 'Tiểu long nữ', 'Bunny Zhang, KEE, Zhang Di,', 'Lin Yun Xiang,', 'https://i.pinimg.com/564x/9f/2a/e1/9f2ae13e18857692a59678ca604fc921.jpg', 'https://i.pinimg.com/564x/e5/5a/43/e55a432553150712809716bc526ab6f9.jpg', 'HD Vietsub', '1 giờ 17 phút', 'tieulongnu', 'Đang công chiếu', 'https://www.youtube.com/embed/rm8jS6kaCP4', '', '0', '', '18+', 'Từ xa xưa, người ta nói rằng con người và yêu quái không thể ở bên nhau, khi cô gái rồng, Bai Xi lần đầu tiên du hành đến thế giới loài người, cô đã vô tình gặp Hong Ji, một người chăm sóc ngôi đền. cùng nhau đến kinh đô để tìm kiếm em gái thất lạc của bạch long, cô gái rồng đen.', 16),
(11, '6', 2, 1, 27, '2022-10-13', 'Kỷ nguyên sinh tồn', ' Raffiella Chapman, Eddie Marsan, Rosy McEwen,', 'Kristina Buozyte, Bruno Samper,', 'https://s198.imacdn.com/ff/2022/10/03/ca755385aab0848b_5a669e9d4ec46674_337271664779130516068.jpg', 'https://i.pinimg.com/564x/c8/2e/25/c82e25ca875287683f1c124593094d7b.jpg', 'HD Vietsub', '112 phút', 'kynguyensinhton', 'Đang công chiếu', 'https://www.youtube.com/embed/qvSkTAA0Igw', '', '6.3', '', '18+', 'Trong tương lai, các hệ sinh thái đã sụp đổ. Trong số những người sống sót, một vài người có đặc quyền đã trú ẩn trong những thành quách bị chia cắt khỏi thế giới, trong khi những người khác đang cố gắng tồn tại trong một thiên nhiên đã trở nên thù địch với con người. Sống trong rừng cùng cha, cô gái trẻ Vesper mơ ước có một tương lai khác, nhờ vào tài năng của cô là một hacker sinh học, rất quý giá trong thế giới này, nơi không có gì có thể phát triển được nữa. Vào ngày một con tàu từ lâu đài gặp nạn với một hành khách bí ẩn trên tàu, cô tự nhủ rằng số phận cuối cùng cũng gõ cửa cô ...', 11),
(12, '7', 2, 1, 27, '2022-10-13', 'Quả cầu đen tối', 'Claudia Black, Richard Blackwood, Phil Davis,', 'Steve Stone,', 'https://i.pinimg.com/564x/01/10/06/011006de77b24ed67e45568eb8b06e7f.jpg', 'https://i.ytimg.com/vi/hf_akjoJz3U/maxresdefault.jpg', 'HD Vietsub', '1 giờ 30 phút', 'quacaudentoi, The Dark Sphere ', 'Đang công chiếu', 'https://www.youtube.com/embed/foOWHKmEZ64', '', '4.1', '', '18+', 'Một quả cầu đen bí ẩn được phát hiện trên quỹ đạo của sao Hỏa. Achilles được cử đi điều tra. Sau khi phi hành đoàn sáu người ốm yếu thức dậy sau tám tháng ngủ đông, Sphere đang truyền tải một từ duy nhất trong mọi ngôn ngữ Trái đất từng được biết đến - Deus.', 11),
(13, '8', 2, 1, 27, '2022-10-13', 'Lính Bắn Tỉa: Quạ Trắng', ' Maryna Koshkina, Andrey Mostrenko, Roman Semysal, Zachary Shadrin,', 'Marian Bushan,', 'https://2.bp.blogspot.com/-Gi5cxqNVW6w/YuTp6GVI6wI/AAAAAAAAWO0/1RSjDaVG6uQhzNAzlxOXtZfyQ90WedpHwCNcBGAsYHQ/s360/unnamed.png=s360', 'https://m.media-amazon.com/images/M/MV5BNzU4YTZhNGItYWU2MS00MDU5LWFkMTUtZDVmNDM2N2NlNjk0XkEyXkFqcGdeQXVyMzk3OTUyMDY@._V1_.jpg', 'HD Vietsub', '1 giờ 51 phút', 'linhbantia, phimchientranh', 'Đang công chiếu', 'https://www.youtube.com/embed/yVGqTUu2OX0', '', '4.4', '', '18+', 'Sau khi hứng chịu thảm kịch vô nghĩa dưới bàn tay của những người lính xâm lược ở vùng Donbas vào năm 2014, một cựu giáo viên vật lý người Ukraine đã từ bỏ lối sống yên bình của mình và tìm cách trả thù. Khi gia nhập quân đội và kiếm được một vị trí bắn tỉa thèm muốn, anh ta để mắt đến một tay súng bắn tỉa ưu tú của Nga, người mà việc loại bỏ có thể thay đổi cục diện của cuộc xung đột.', 9),
(14, '3', 2, 4, 27, '2022-10-28', 'Ai Cũng Biết Anh Yêu Em', 'Cung Uyển Di, Tống Thiến, Hứa Ngụy Châu, Cao Duệ Phỉ Nhi, Cao Nhân, Quách Thước Kiệt, Nhâm Bân,', 'Đới Tiểu Triết,', 'https://img1.daumcdn.net/thumb/R800x0/?scode=mtistory2&fname=https:%2F%2Fblog.kakaocdn.net%2Fdn%2F18SLy%2FbtqNF9XWSt4%2FCobTr76j2U12nve7eyfS3k%2Fimg.png', 'https://pic3.zhimg.com/v2-5acd671176dcfc8868170aef0c28b7da_r.jpg', 'HD Vietsub', '45 phút 1 tập', 'aicungbietanhyeuem, ai cung biet anh yeu em, Almost Lover (2022)', 'Đang công chiếu', 'https://www.youtube.com/embed/gOeLk_7IBRs', '', '5.6', '', '18+', 'Ai Cũng Biết Anh Yêu Em Almost Lover He Xiao Ran là MC của một chương trình radio đêm khuya. Nhưng những biến cố xảy ra trong vài năm cuối đời khi còn là sinh viên vẫn ám ảnh cô. Cô thầm yêu Xiao Shang Qi, một người bạn thân khác giới. Nhưng thay vì tiến đến với anh, cô phải bất lực nhìn anh theo đuổi giấc mơ tình yêu của mình với một người phụ nữ khác - người bạn chung của họ là Chen Fei Er. Cô ấy bị cưỡng bức chịu đựng sự đau lòng khi chứng kiến ​​người đàn ông cô yêu bắt đầu mối quan hệ với bạn thân của cô. Và vì tình bạn mà cô ấy quý trọng, cô ấy giữ kín tình cảm của mình. Cuối cùng, cô chuyển đi và bắt đầu làm DJ trên đài phát thanh. Nhưng quá khứ quay trở lại cắn xé cô 8 năm sau khi Xiao Shang Qi đến thị trấn sau một thời gian dài ở nước ngoài. Anh được giao nhiệm vụ xoay chuyển tình thế của một khách sạn độc quyền đã rơi vào thời kỳ khó khăn. Con đường của họ lại giao nhau, và lần này Xiao Shang Qi tỏ ra quyết tâm sửa chữa những sai lầm trước đây của mình. Anh nói với cô rằng anh chưa bao giờ ngừng nghĩ về cô. Nhưng liệu có quá muộn để hòa giải? Hay thần Cupid có thể tìm cách quay ngược kim đồng hồ về một mối quan hệ không bao giờ có ... nhưng lẽ ra luôn nên có?', 32),
(15, '3', 1, 5, 27, '2022-10-28', 'Tình Yêu Và Pháp Luật', ' Lee Seung Gi, Lee Se Young,', ' Lee Eun Jin,', 'https://subnhanh.cdn-img.net/tinh-yeu-va-phap-luat_1.jpg', 'https://vietphim.co/wp-content/uploads/2022/09/Tinh-Yeu-Va-Phap-Luat-Love-By-Law-2022-1-650x366.jpg', ' HD Vietsub', 'N/A', 'tinhyeuvaphapluat, Love By Law (2022)', 'Đang công chiếu', 'https://youtu.be/XXxXK5z9dWc', '', '0', '', '18+', 'Tình Yêu Và Pháp Luật Love By Law Bộ phim ** Love By Law ** xoay quanh quanh các nhân vật Jung Ho, Yu Ri, Se Yeon và Jin Ki đã là bạn của nhau được 17 năm kể từ trường Seoyeon High.Jung Ho là một địa chủ từng được mệnh danh là Thiên tài quái vật của ngành công tố. Bất chấp sự vụng về của mình, anh ấy là một chàng trai tuyệt vời với một sức hấp dẫn bí ẩn. Yu Ri là một luật sư lập dị, người đã giành chiến thắng trong cuộc thi Hoa hậu Hàn Quốc vừa qua với vẻ ngoài nổi bật của mình. Tính cách nóng nảy, không thể chịu đựng được sự bất công đã khiến cô ấy từ bỏ công ty của mình và bắt đầu mở một quán cà phê luật của riêng mình. Khi cô đến gặp chủ nhà để làm hợp đồng, cô phát hiện ra rằng anh ta chính là Jung Ho, bạn cũ của cô. Từ đó, một mối quan hệ điên rồ phát triển từ tình bạn thành tình yêu bắt đầu. ', 10),
(16, '4', 1, 6, 26, '2022-10-28', 'Xác Sống Phần 11', ' Norman Reedus, Melissa Mcbride, Andrew Lincoln, Danai Gurira, Lauren Cohan,', 'Frank Darabont, Angela Kang,', 'https://phimyeuthich.com/uploads/movie/The%20Walking%20Dead%20s119902.jpg', 'https://th.bing.com/th/id/R.23df4de91925d39fac820f0d3df220e8?rik=uEMtpxVy0KD8tA&pid=ImgRaw&r=0', 'HD Vietsub', '24 tập', 'Xác Sống Phần 11', 'Đang công chiếu', 'https://www.youtube.com/embed/qwOWJ8pPgk8', '', '8.2', 'VIP', '18+', 'Xác Sống Phần 11 The Walking Dead Season 11 2021 Full HD Vietsub Thuyết Minh Hai tập đầu tiên của The Walking Dead season 11 khá ổn. Nó không có cách nào là không thể truy cập được. Nhưng họ cảm thấy giống như bất kỳ tập nào khác của ', 23),
(17, '5', 2, 4, 27, '2022-10-28', 'Tiên Kiếm Phong Vân', 'Benny Chan, Raquel, Zhang Ming Ming,', 'Kenyeung,', 'data:image/jpeg;base64,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', 'https://th.bing.com/th/id/R.644688c8d36bc54cee08a8fbf466bf7d?rik=h09mdVCpdpJT1w&pid=ImgRaw&r=0', 'HD Vietsub', '1 giờ 21 phút', 'Tiên Kiếm Phong Vân,The Whirlwind of Sword and Fairy (2022)', 'Đang công chiếu', 'https://www.youtube.com/embed/0Y7Efktj4Zw', '', '5.6', '', '18+', 'Tiên Kiếm Phong Vân The Whirlwind of Sword and Fairy 2022 Full HD Vietsub Thuyết Minh Một trăm năm trước, hậu duệ của Tiên Kiếm Môn, Trương Chủng đã chiến đấu chống lại thủ lĩnh Dị Nhân U Hoàng bảy ngày bảy đêm, phong ấn binh khí của Dị Nhân trong Tiên Kiếm Môn. U Hoàng sau khi bị thương nặng thì bại trận. Nhân lúc trong trấn đang bùng phát dịch bệnh, Trương Chi Lâm lên kế hoạch bắt thuộc hạ của U Hoàng ăn trộm Tử Thanh Song Kiếm giả để khôi phục nguyên lực.Cửu Lê tan vỡ khi đối phương quá mạnh, nhưng chú của Trương Chi Lâm đã đại chiến với U Hoàng. Cửa của Trương Chi Lâm và Thần Vân bị đóng lại vì tình thế cấp bách. Sau nhiều lần nghi ngờ, thấy Trương Chi Lâm đã hi sinh thân mình giúp đỡ, hai người tôn trọng lẫn nhau, cuối cùng thành công dùng hai thanh kiếm đánh bại U Hoàng!', 13),
(18, '4', 1, 6, 27, '2022-10-28', 'Cư Dân Ma Quái', 'Leslie Bibb, Dermot Mulroney,', 'Jerren Lauder,', 'data:image/jpeg;base64,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', 'https://cdn.nguyenkimmall.com/images/companies/_1/tin-tuc/review/phim/chu-he-ma-quai.jpg', 'HD Vietsub', '97 phút', 'Cư Dân Ma Quái', 'The Inhabitant (2022)', 'https://www.youtube.com/embed/FpO37i1ZvwM', '', '4.9', '', '18+', 'Cư Dân Ma Quái The Inhabitant 2022 Full HD Vietsub Thuyết Minh Một hậu duệ tuổi teen của Lizzie Borden bị kẹt giữa những ảo ảnh hoang tưởng và chứng tâm thần phân liệt mưng mủ giữa hàng loạt vụ giết người ở một thị trấn nhỏ.', 11);
INSERT INTO `movie` (`id`, `cat_id`, `genre_id`, `mv_nation`, `mv_year`, `mv_date`, `mv_name`, `mv_actor`, `mv_des`, `mv_img`, `mv_bg`, `mv_quality`, `mv_duration`, `mv_tag`, `mv_status`, `mv_trailer`, `mv_favorite`, `IMDb`, `mv_role`, `mv_request`, `mv_deces`, `mv_view`) VALUES
(19, '4', 3, 6, 27, '2022-11-02', 'Nghi Thức Cấm KumanThong Dont Look at the Demon (2022)', ' Harris Dickinson, Fiona Dourif, Randy Wayne, Malin Crépin, Jordan Belfi,', 'Brando Lee,', 'data:image/jpeg;base64,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', 'https://img.phimmoichilly.net/images/film/nghi-thuc-cam-kuman-thong.jpg', 'HD Trailer', '93 phút', 'nghithuccam, kumathon', 'phim sắp chiếu', 'https://www.youtube.com/embed/NY4_yNJoKWU', '', '5.4', '', '18+', 'Nghi Thức Cấm KumanThong Dont Look at the Demon 2022 Full HD Vietsub Thuyết Minh Phim kể về một nhân vật tên là Jules, người có khả năng ngoại cảm. Cô kiếm tiền bằng cách quay các chương trình thực tế tại những địa điểm ma ám cùng một nhóm bạn. Cả nhóm nhận được lời kêu cứu từ Ian và Martha, chủ nhân của một ngôi nhà cổ ở vùng núi Malaysia, khi họ đang tìm kiếm chủ đề cho tập tiếp theo. Những câu chuyện bí ẩn thực sự bắt đầu từ đây. Có một bí mật kinh hoàng liên quan đến một nghi lễ cổ xưa đã bị cấm từ lâu. Khi lực lượng này được kết nối với quá khứ của Jules, sự thật ngày càng trở nên đáng sợ hơn. Cuối cùng của tác phẩm đầy ám ảnh này sẽ đi về đâu? Bạn có thể theo dõi phim moi để hóng bộ phim rùng rợn về thế thời tâm linh nha.', 8),
(20, '5', 1, 4, 23, '2022-11-02', 'Đấu La Đại Lục', 'Đang cập nhật,', 'Đang cập nhật,', 'https://upload.wikimedia.org/wikipedia/vi/a/a2/Poster_%C4%90%E1%BA%A5u_La_%C4%90%E1%BA%A1i_L%E1%BB%A5c.jpg', 'https://1.bp.blogspot.com/-S_jL8jcSCUw/XGjrzYj8NPI/AAAAAAAAEX4/mJyLnJOTxIEoTdWpxcL0Jx24ECBXrRQdwCLcBGAs/s0/van-gioi-than-chu-background.jpg', 'HD Vietsub', '20 phút/ tập', 'dauladailuc, soul land', 'Đang công chiếu', 'https://www.youtube.com/embed/HpNtjIWSSEA', '', '5.4', '', '18+', 'Đấu La Đại Lục Soul Land 2018‏ Full HD Vietsub Thuyết Minh Đấu La Đại Lục là một trong những tác phẩm đặc sắc của Đường Gia Tam Thiếu. Tác phẩm thuộc thể loại truyện Huyền Hiệp, mang đến cho người đọc một góc nhìn mới, một cảm nhận mới về thế giới huyền huyễn kiếm hiệp. Câu chuyện với nhân vật chính là con trai của một người thợ rèn trở thành ác thần, vì con trai mà chết, sẵn sàng thu hút độc giả ngay từ những chương đầu tiên. Du La giới, một đại lục rộng lớn, dân cư đông đúc. Nghề cao quý ở đây được gọi là Soul Master. Mỗi người sinh ra đều mang trong mình một linh hồn bẩm sinh. Vũ hồn có thể là cái cày, cái cuốc, cái dao giáo ... thuộc khối công cụ, một cành cúc, một cành mai ... thuộc hệ thực vật của các hồn mạnh như Tuyết Ảnh Ma Hùng, Tát Phong Ma Lang .... phimmoizz Trong để trở thành hồn sư, ngoài linh hồn lực của vũ kỹ còn phải dùng linh lực để sử dụng linh hồn vũ đó, vũ hồn càng lớn thì vũ hồn càng cao, uy lực càng lớn. tinh thần đại diện trong cuộc đấu. la đại lục. Cứ mỗi 10 cấp sức mạnh linh hồn, vũ hồn có thể thêm một linh hồn hoàn mỹ, thu được từ việc giết thần thú, thần thú mạnh mẽ, đã được tu luyện hàng nghìn năm. Hành trình tu luyện, tìm hiểu bí ẩn về cái chết của mẹ, bí mật của cha, truyện sẽ mang đến cho độc giả những trải nghiệm thú vị.', 21),
(21, '1', 1, 5, 27, '2022-11-06', 'Công lý mù', 'Ok Taec Yeon, Ok Taec Yeon, Ok Taec Yeon, Park Ji Bin, Jung Eui Wook, Kang Na Eon, Baek Seung Hee, Yoon Jung Hyuk,', 'Shin Yong Hwi,', 'data:image/jpeg;base64,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', 'https://static.fptplay.net/static/img/share/video/OTT/VOD/2022/09/07/toi-ac-vo-hinh-16-tap-fpt-play-1662522711376_Landscape.jpg', 'HD Vietsub', '22 tập', 'conglymu, blind', 'Đang công chiếu', 'https://www.youtube.com/embed/2Cjd3WiOEw0', '', '67.', '', '18+', 'Công Lý Mù Blind 2022 Full HD Vietsub Thuyết Minh Ryu Sung Joon, Ryu Sung Hoon và Jo Eun Ki tham gia phá án một vụ giết người hàng loạt liên quan đến các thành viên bồi thẩm đoàn là nạn nhân. Ba người này cố gắng khám phá sự thật đằng sau những cái chết.', 12),
(22, '2', 4, 2, 16, '2022-11-06', 'Lạc Vào Khu Rừng Đom Đóm', ' Ayane Sakura, Izumi Sawada, Koki Uchiyama, Kanehira Yamamoto, Hiroki Goto, Taya Jun, Asami Imai, Kumiko Tashiro,', 'Takahiro Ômori,', 'https://kyty.vn/wp-content/uploads/2021/07/hotarubi-no-mori-e-khu-rung-dom-dom.jpg', 'https://revelogue.com/wp-content/uploads/2020/02/Gin-hon-hotaru-khi-mua-ha-ket-thuc-e1581210135501.jpg', 'HD Vietsub', '45 phút', 'lacvaokhurungdomdom, hotarubi no Mori e', 'Đang công chiếu', 'https://www.youtube.com/embed/TFvezWFnaHw', '', '7.9', '', '13+', 'Lạc Vào Khu Rừng Đom Đóm Into the Forest of Fireflies Light 2011 Full HD Vietsub Thuyết Minh Được chuyển thể từ manga cùng tên, Hotarubi no Mori e kể về Hotaru, trong một lần cô bé đi lạc vào rừng thì gặp được Gin, một chàng trai trẻ kì lạ mà khi bị con người chạm vào thì cậu ta sẽ biến mất, Gin dẫn Hotaru rời khỏi khu rừng và câu chuyện bắt đầu từ đó...', 28),
(23, '3', 1, 4, 27, '2022-11-08', 'Tỏa Sáng Trong Đêm Đông Của Em', 'Kiều Hân, Mã Tư Siêu, Chu Dực Nhiên, Vương Vi, Diệp Tiểu Vĩ, Nhâm Soái, Hách Dương,', 'Điền Vũ,', 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSc7VeiGOiiEzhmxtONQKIIXA63FgsU2auXt22wHu2f-iotMnOUC5pRNufwAIMnntbhQ5c&usqp=CAU', 'https://filmthreat.com/wp-content/uploads/2019/04/REV-WintersNight-1A.jpg', 'HD Vietsub', '45 phút 1 tập', 'demdong, winter night.', 'hd vietsub', 'https://www.youtube.com/embed/-s2cay8CLvE', '', '7.2', '', '18+', 'Đêm Đông Winter Night 2022 Full HD Vietsub Thuyết Minh Trịnh Đạt Tiền đã bị giáng hai đòn vào sự nghiệp và cuộc sống tình cảm khi cô ấy vật lộn ở thành phố lớn. Tình cờ, cô ấy trở thành người nhận gói chuyển nhà. Sau khi trở về quê hương của mình, cô ấy bị cuốn vào một cơn bão từ một thiên thạch cầu lửa gây ra và kết thúc ở một không gian và thời gian song song. Những gì đã là một gia đình tan vỡ là toàn bộ một lần nữa. Mối tình đầu của cô Mu Zi Li xuất hiện trở lại một cách kỳ diệu. Không thể trở lại thế giới của mình, Trịnh Đạt Tiền nắm bắt cơ hội để bù đắp những hối tiếc trong quá khứ. Tuy nhiên, ngay khi cuộc sống của cô chuyển sang hướng tốt đẹp hơn thì quả cầu lửa lại xuất hiện. Trịnh Đạt Tiền và Mu Zi Li sắp trở thành hai người tình bị chia cắt bởi hai thế giới.', 66),
(24, '2', 4, 2, 26, '2022-11-08', 'Thanh Gươm Diệt Quỷ', 'Đang câp nhật', 'Đang câp nhật', 'https://product.hstatic.net/200000343865/product/1_c75fb8f63dd542c6896796e00a0f170f_master.jpg', 'https://media.comicbook.com/2020/09/demon-slayer-100-million-1237331.jpeg?auto=webp&width=1200&height=628&crop=1200:628,smart', ' HD Vietsub', '25 phút/ tập', 'luoiguomdietquy, thanhguomdietquy, demon slayer,', 'Đang công chiếu', 'https://www.youtube.com/embed/5mXIac5c6V8', '', '9', 'VIP', '10+', 'Thanh Gươm Diệt Quỷ: Phố Đèn Đỏ (Kỹ Viện Trấn) Kimetsu no Yaiba: Yuukaku-hen 2021 Full HD Vietsub Thuyết Minh Thanh Gươm Diệt Quỷ: Phố Đèn Đỏ (Kỹ Viện Trấn) sẽ tiếp tục theo dòng thời gian của các phần phim, sau khi thiếu niên Tanjiro cùng em gái quỷ của mình vượt qua bao nguy hiểm ở mùa phim truyền hình đầu tiên (2019), hành trình của họ giờ đây không còn đơn độc nữa mà sẽ cùng những người bạn khác chiến đấu trong phần phim Thanh Gươm Diệt Quỷ: Phố Đèn Đỏ để bảo vệ con người và đấu lại quỷ nữ ở phố đèn đỏ. Nơi đây còn có ba cô vợ của một trụ cột trong đội diệt quỷ, họ đang tích cực hoạt động để nắm hành tung của quỷ. Giờ đây nhiệm vụ của Tanjiro sẽ là tìm hiểu những vụ mất tích của phụ nữ ở khu đèn đỏ phức tạp, nơi có nhiều quỷ dữ và tội phạm hoành hành nhất. Tưởng chừng Tanjiro sẽ bất lực và từ bỏ thì anh gặp được một đồng minh mới có mối liên hệ cá nhân với bí ẩn này, điều này khiến nam chính trong Thanh Gươm Diệt Quỷ: Phố Đèn Đỏ (Kỷ Viện Trấn) có thêm động lực hơn bao giờ hết để tìm hiểu tận cùng của tất cả những bí ẩn này.', 25),
(25, '2', 4, 2, 27, '2022-11-08', 'Bleach: Sennen Kessen-hen', 'Masakazu Morita, Noriaki Sugiyama, Fumihiko Tachiki,', 'Đang cập nhật', 'https://cdn.myanimelist.net/images/anime/1764/126627.jpg', 'https://th.bing.com/th/id/R.fb18414588c5cd2adb032f1e32f73c13?rik=4a1seuUNumnc0w&riu=http%3a%2f%2fimages2.fanpop.com%2fimages%2fphotos%2f8200000%2fbleach-bleach-anime-8281854-1024-768.jpg&ehk=0aDCohzYCSaqD3EhJgnIKFT7%2feGf8spVax4H8Py0kEc%3d&risl=&pid=ImgRaw&r=0', 'HD Vietsub', '13 tập', 'Bleach: Sennen Kessen-hen', 'Đang công chiếu', 'https://www.youtube.com/embed/KTsk54HlftI', '', '9.5', 'VIP', '10+', 'Bleach: Sennen Kessen-hen Bleach: Thousand-Year Blood War 2022 Full HD Vietsub Thuyết Minh Sau một thập kỷ trôi qua, Bleach cuối cùng đã trở lại để chuyển thể phần cuối cùng của loạt manga. Huyết Chiến Ngàn Năm là chương trình mới nhất trong xu hướng các phần tiếp theo của “giấc mơ viễn vông” gần đây đã được cắt xén bao gồm A Nhất định Chỉ số Ma thuật 3, Tiger & Bunny 2 , và Devil is a Part-Timer 2 . Bất chấp những lo ngại hợp lý rằng phép thuật có thể đã tiêu tan, niềm vui thực sự của Bleach vẫn không thay đổi. Các phân cảnh chiến đấu vẫn được cách điệu vô cùng. Giai điệu của nhà soạn nhạc Shirō Sagisu vẫn còn tát. Có một bộ lọc mới trên chương trình, cung cấp bóng mờ giống như phim. Huyết Chiến Ngàn Năm là Bleach ở đỉnh cao của nó.Tất nhiên, Bleach tập trung vào một thiếu niên tên là Ichigo Kurosaki, người có khả năng nhìn thấy các linh hồn. Anh ấy sáng lên mặt trăng với tư cách là một Soul Reaper, một người được chỉ định để hỗ trợ dòng chảy của các linh hồn từ Trái đất sang thế giới bên kia. Ngoài những nỗ lực vị tha của họ, Soul Reapers còn đóng vai trò là một lực lượng quân sự để ngăn chặn các nhóm có vẻ ngoài xấu xa kiểm soát bình diện tâm linh. Vòng cung Cuộc chiến Ngàn năm Huyết chiến khiến các Soul Reaper chống lại một nhóm quân nhân tâm linh khác được gọi là Quincy.', 22),
(26, '2', 4, 2, 27, '2022-11-08', 'Học Viện Anh Hùng 6', 'Daiki Yamashita, Yuki Kaji, Nobuhiko Okamoto,', ' Kenji Nagasaki,', 'https://product.hstatic.net/200000343865/product/6_2677c6193f754e109c2fb3c2c1f78a97_master.jpg', 'https://th.bing.com/th/id/R.c6c888f966b37b20b6e24f4e6e2596c9?rik=mbbuTnyTn9jGJg&riu=http%3a%2f%2fstarpressvn.net%2fwp-content%2fuploads%2f2019%2f01%2fH%E1%BB%8CC-VI%E1%BB%86N-SI%C3%8AU-ANH-H%C3%99NG-1.jpg&ehk=AGzPjm6v1xEI9n1whIlkGbRBLsv5N9gtd59BuFRvlX8%3d&risl=&pid=ImgRaw&r=0', 'HD Vietsub', '25 phút/ tập', 'hocvienanhhung6', 'Đang công chiếu', 'https://www.youtube.com/embed/lFeNpFO5_Bc', '', '8.4', '', '10+', 'Học Viện Anh Hùng 6 Boku no Hero Academia 6th Season 2022 Full HD Vietsub Thuyết Minh kể về một vị anh hùng muốn vượt lên đứng đầu trong tất cả! Izuku có một ước mở trở thành anh hùng từ khi còn nhỏ - là một mục tiêu cao nhất mà ai cũng muốn đạt được - nhưng đó là lại là một thách thức đối với một cậu bé không hề có tý năng lực siêu nhiên nào. Đúng thế, ở một cái thế giới mà hơn 80% dân số đều có một loại siêu năng lực ', 14),
(27, '2', 4, 2, 27, '2022-11-08', 'Hắc Quản Gia', ' Ono Daisuke, Sakamoto Maaya, Kato Emiri', ' Shinohara Toshiya,', 'https://upload.wikimedia.org/wikipedia/vi/0/06/Kuroshitsuji_DVD_cover.jpg', 'https://web5s.com.vn/ket-thuc-cua-hac-quan-gia/imager_31560.jpg', 'HD Vietsub', '24 tập', 'hacquangia', 'Đang công chiếu', 'https://www.youtube.com/embed/S8j5iEklHyI', '', '9.0', 'VIP', '10+', 'Hắc Quản Gia Kuroshitsuji 2009 Full HD Vietsub Thuyết Minh quá khứ của Ciel là một bi kịch. Những điều ẩn giấu bao trùm cậu bé trong bóng tối  - một trong những khoảnh khắc đau khổ nhất của mình, cậu ta đã lập giao ước với Sebastian, một con quỷ, mặc cả linh hồn của mình để đổi lấy sự trả thù những kẻ đã đối xử tàn nhẫn với cậu ta.', 24),
(28, '3', 3, 6, 27, '2022-11-22', 'Amsterdam: Vụ Án Mạng Kì Bí', 'Christian Bale, Margot Robbie, John David Washington,', 'David O Russell,', 'https://upload.wikimedia.org/wikipedia/en/3/3c/Amsterdam_(2022_film).jpg', 'https://mwdentallab.org/wp-content/uploads/2022/09/Amsterdam-2022-movie-release-date-cast-etc.jpg', 'HD-Vietsub', '2 giờ 14 phút', 'amsterdam, án mạng kì bí', 'Phim ngoài rạp', 'https://www.youtube.com/embed/GLs2xxM0e78', '', '6.1', '', '16 tuổi đổ lên', 'Bộ phim hài bí ẩn mới nhất của đạo diễn David O.Russell ( Silver Linings Playbook, American Hustle) , phim quy tụ nhiều ngôi sao lớn.Lấy bối cảnh những năm 1930 tại Mỹ. Phim tập trung vào 3 nhân vật chính của phim. Cụ thể là bác sĩ tên Burt Berendsen (Bale), y tá tên Valerie Voze (Robbie) và luật sư Harold Woodsman (Washington).Ba người họ, như chúng ta thấy lại trong trailer , là bạn cũ.Và từ đó tình bạn của ba người này gắn bó với nhau. Họ ngay lập tức hứa sẽ bảo vệ nhau bất kể điều gì.Chà, lời hứa của ba người này sau đó đã được thử thách khi họ trở thành nghi phạm chính. Cụ thể hơn, là nghi phạm chính trong vụ sát hại Thượng nghị sĩ Hoa Kỳ Bill Meekins (Ed Begley Jr.).Cùng phimmoichilly.net theo dõi xem rồi liệu kẻ giết Meekins có thực sự là một trong ba người bạn thân? Hoặc có thể cả ba? Hay họ chỉ là nạn nhân của một âm mưu?', 13),
(29, '1', 3, 6, 27, '2022-11-22', 'Black Adam', 'Dwayne Johnson, Sarah Shahi, Pierce Brosnan,', 'Jaume Collet-Serra,', 'https://th.bing.com/th/id/R.a4a6753dd8f35cefd29b05e27c96fbee?rik=Ve2bowgOz%2bCBVA&pid=ImgRaw&r=0', 'https://th.bing.com/th/id/R.738af1fea9d371daa6342066abe462ca?rik=iDUaCkBw7aRs8A&pid=ImgRaw&r=0', 'HD-Vietsub', '2 giờ 5 phút', 'black adam', 'Phim ngoài rạp', 'https://www.youtube.com/embed/uAop-vMrggI', '', '7', '', '13 tuổi đổ lên', 'Phim kể về người đàn ông Black Adam đã bị giam cầm sau gần 5000 năm, giờ đây anh được các vị thần Ai Cập bang cho những sức mạnh đầy quyền năng, và từ đó anh đã thoát ra khỏi sự giam cầm. Từ đây, anh đã tận dụng sức mạnh này để bắt đầu một cuộc sống công lý độc nhất trên thế giới hiện đại hóa này. Không những thế anh còn phải đối mặt với những kẻ thù hung ác mới.Black Adam là một bộ phim điện ảnh siêu anh hùng của Hoa Kỳ ra mắt năm 2022, dựa trên nhân vật cùng tên của DC Comics. Được sản xuất bởi New Line Cinema, DC Films, Seven Bucks Productions và Flynn Picture, đây là phần phim ngoại truyện của Shazam!, và là phim thứ 11 trong Vũ trụ Mở rộng DC.', 36),
(30, '', 1, 1, 27, '2022-11-30', 'Ông Trùm Giang Hồ', 'Sylvester Stallone, Andrea Savage, Martin Starr,', 'Taylor Sheridan,', 'https://m.media-amazon.com/images/M/MV5BYmI3N2EzOWQtZjFiMi00MjgwLTgzN2UtZGI0ZGY1ZDQyOTRiXkEyXkFqcGdeQXVyMTUzMTg2ODkz._V1_FMjpg_UX1000_.jpg', 'https://img.phimmoichilli.net/images/film/ong-trum-giang-ho.jpg', 'HD Vietsub', '45 phút', 'ongtrumgiangho, Tulsaking', 'Đang công chiếu', 'https://www.youtube.com/embed/aaQSScwZPbA', '', '6.4', 'VIP', '18+', 'Ông Trùm vùng Tulsa - Tulsa King (2022) là phim Vừa ra tù sau 25 năm, trùm mafia New York Dwight “The General” Manfredi bị ông chủ trục xuất bất ngờ để thành lập cửa hàng ở Tulsa, Okla. Nhận ra rằng gia đình băng đảng của anh ta có thể không quan tâm đến lợi ích tốt nhất của anh ta, Dwight từ từ xây dựng một “phi hành đoàn” từ một nhóm các nhân vật không có khả năng xảy ra, để giúp anh ta thiết lập một đế chế tội phạm mới ở một nơi mà đối với anh ta cũng có thể là một hành tinh khác.', 8),
(32, '', 3, 6, 26, '2022-12-01', 'Lyle, Chú Cá Sấu biết hát', 'Javier Bardem, Constance Wu, Winslow Fegley, Shawn Mendes, Scoot McNairy,', 'Will Speck, Josh Gordon,', 'https://m.media-amazon.com/images/M/MV5BODVhODBjYjAtOGUwZS00ZDFlLWFhZTEtZTM5OGNiNDAxYTFkXkEyXkFqcGdeQXVyMDA4NzMyOA@@._V1_.jpg', 'https://toquoc.mediacdn.vn/280518851207290880/2022/10/27/avatar1666846352709-16668463539552039327989.jpg', 'HD Vietsub', '107 phút', 'lyle,chucasaubiethat', 'Đang công chiếu', 'https://www.youtube.com/embed/J14BfxOUxIs', '', '5', '', '14+', 'Lyle, chú cá sấu biết hát (tiếng Anh: Lyle, Lyle, Crocodile) là một bộ phim điện ảnh hoạt họa máy tính người đóng của Mỹ thuộc thể loại hài nhạc kịch - chính kịch công chiếu năm 2022 do Will Speck và Josh Gordon đồng đạo diễn và sản xuất từ phần kịch bản của William Davies.', 17),
(33, '1', 2, 6, 27, '2022-12-03', 'Thế Giới Khủng Long: Cuộc Phiêu Lưu Chưa Kể', 'Paul-Mikél Williams, Jenna Ortega, Bill Nye,', 'Leore Berris,', 'https://occ-0-2433-2430.1.nflxso.net/dnm/api/v6/oQyw8Fv9eE41UPapt7zHvdUdzrE/AAAABdXHQaogcdM-oXlIVX8N13BcdLJLtcPs2Am9kYk0oBKA3K8LKbQEKbZnTFiRND6uqJV4SSxRr8pe1gvz_3yuWeUYIkXR29be5vFM_oeVwFTC694PeamDjjxfEO2zCupVOVZyA9pHLQL4fpByRbBzMMtAAoLAMzWLPXMYRqtzBBIA3N1LUqjcTqz1GLBDJeSLEq3RGaU-bIvEiwI23lQHBqMScAPnQ1OgWsg0VJ2mwLloi48ibTpq6f13zRh152L38xCOR4khDbx7_QItgipY8pHExf5U45u_kZ4VaTSEK9DFVkKF68hZova7xA.jpg', 'https://occ-0-325-395.1.nflxso.net/dnm/api/v6/E8vDc_W8CLv7-yMQu8KMEC7Rrr8/AAAABaSs_KsJCwxcCNhuMimfbxSCEqU7R7yJKLyEoL6n46FypALw1FLVGcJW3WhDlYqJDyrjs6uiViBF3TMoqIbc0vCQY6TK21eUgj-E.jpg?r=f9f', 'HD Trailer', '120 phút', 'Thế Giới Khủng Long: Cuộc Phiêu Lưu Chưa Kể,Jurassic World Camp Cretaceous: Hidden Adventure (2022)', 'phim sắp chiếu', 'https://www.youtube.com/embed/yGQZp_1EUZ8', '', '7.4', 'VIP', '14+', 'Thế Giới Khủng Long: Cuộc Phiêu Lưu Chưa Kể Jurassic World Camp Cretaceous: Hidden Adventure 2022 Full HD Vietsub Thuyết Minh Netflix đang bổ sung một sản phẩm tương tác đặc biệt khác vào kho vũ khí đang phát triển của mình với việc phát hành dự kiến ​​Jurassic World Camp Cretaceous: Hidden Adventure, sẽ ra mắt trên dịch vụ vào tháng 11 năm 2022.Sê-ri phim hoạt hình đến từ thỏa thuận dài hạn giữa Netflix và DreamWorks Tivi, đã chứng kiến ​​​​hơn một chục chương trình đến với Netflix kể từ năm 2013. Loạt phim đến từ các nhà sản xuất điều hành Steven Spielberg, Colin Trevorrow, Frank Marshall và Scott Kreamer.“Trong một cuộc phiêu lưu tương tác độc lập, những người cắm trại, khao khát thức ăn, hợp tác với nhau để tìm một kho dự trữ ẩn. Họ phải mạo hiểm mọi thứ để tìm ra manh mối nhằm tìm kiếm vị trí của nó, cuối cùng phơi bày những bí mật chưa biết trước đây về Isla Nublar.”', 5),
(34, '', 2, 6, 27, '2022-12-03', 'Cuộc chơi mạo hiểm', 'Russell Crowe, Liam Hemsworth, RZA,', 'Russell Crowe,', 'https://xemphimviet.net/uploads/cuoc-choi-mao-hiem-poker-face.jpg?v=1669119853', 'https://xemphimviet.net/uploads/cuoc-choi-mao-hiem-poker-face_banner_.jpg?v=1669119862', 'HD Vietsub', '2 giờ', 'cuocchoimaohiem, Poker Face(2022)', 'Đang công chiếu', 'https://www.youtube.com/embed/dFhPexVP1xU', '', '6.5', '0', '18+', 'Cuộc Chơi Mạo Hiểm Poker Face 2022 Full HD Vietsub Thuyết Minh Tài tử hạng A Russel Crowe vào vai tỷ phú công nghệ kiêm tay cờ bạc Jake Foley (Crowe) tổ chức một trò chơi poker có tỷ lệ cược cao giữa những người bạn thời thơ ấu, mang đến cho họ cơ hội giành được nhiều tiền hơn cả những gì họ từng mơ ước. Buổi tối thay đổi khi anh ấy tiết lộ kế hoạch công phu của mình để trả thù cho sự phản bội của họ và để chơi, họ sẽ phải từ bỏ một điều mà họ đã dành cả đời để cố gắng giữ... bí mật của mình. Khi trò chơi mở ra, những tên trộm đột nhập và chúng phải liên kết với nhau để sống sót qua đêm kinh hoàng.\r\n', 0),
(35, '', 4, 2, 21, '2022-12-03', 'Your Name', 'Shinta Takagi, Tsukasa Fujii, Futaha Miyamizu,', 'Shinkai Makoto,', 'https://upload.wikimedia.org/wikipedia/vi/thumb/b/b3/Your_Name_novel.jpg/275px-Your_Name_novel.jpg', 'https://genk.mediacdn.vn/2017/011-1484298377268.jpg', 'HD Vietsub', '107 phút', 'your name, tencaulagi', 'Đang công chiếu', 'https://www.youtube.com/embed/HpNtjIWSSEA', '', '9.0', '0', '10+', 'Tên Cậu Là Gì? Your Name 2016 Full HD Vietsub Thuyết Minh Your Name 2016 - Tên Của Bạn kể về Mitsuha - một nữ sinh trung học sống tại một thị trấn nhỏ thuộc vùng Itomori. Luôn chán nản với cuộc sống nhàm chán ở nông thôn, Mitsuha mong muốn kiếp sau được trở thành một anh chàng đẹp trai sống ở Tokyo sôi động. Trong khi đó ở Tokyo, Taki rất hài lòng với cuộc sống của mình và công việc bán thời gian tại một nhà hàng Ý sau giờ học. Tuy nhiên, hàng đêm anh vẫn mơ thấy mình trong thân xác của một cô gái quê. Cho đến một ngày khi sự kiện ngàn năm mới có một lần là Sao chổi đến gần Trái đất, Taki và Mitsuha đột ngột hoán đổi thân xác. Mỗi ngày, Taki trở thành Mitsuha khám phá cuộc sống nông thôn và ngược lại, Mitsuha khiến một cậu bé Tokyo háo hức với cuộc sống ở thành phố ồn ào. Cứ như vậy, câu chuyện của Mitsuha và Taki mở ra dẫn dắt khán giả đến những tình huống đặc biệt, dù cả hai chưa từng gặp mặt hay thậm chí biết tên nhau.\r\n', 17),
(36, '', 4, 2, 26, '2022-12-03', 'Hiệp sĩ Sidonia', ' Ryôta Ôsaka, Aya Suzaki, Aki Toyosaki, Hisako Kanemoto, Takahiro Sakurai, Ayane Sakura, Eri Kitamura, Sayaka Ôhara, Tomohiro Tsuboi,', ' Hiroyuki Seshita,', 'https://phimmoit.net/wp-content/uploads/2022/10/haunytb-38802-200x250.webp', 'https://vehoathinhcartoon.com/wp-content/uploads/2020/07/Knights-of-Sidonia-Ra-M%E1%BA%AFt-2021-Phim-V%E1%BB%9Bi-C%C3%A2u-Chuy%E1%BB%87n-Ho%C3%A0n-To%C3%A0n-M%E1%BB%9Bi-vehoathinhcartoon-com.jpg', 'HD Vietsub', '110 phút', 'hiepsisidonia, Knights of sidonia', 'Đang công chiếu', 'https://www.youtube.com/embed/2PU7Kosj4Bc', '', '8.0', 'VIP', '10+', 'Hiệp Sĩ Sidonia Knights Of Sidonia: Love Woven In The Stars 2021 Full HD Vietsub Thuyết Minh Đã 10 năm trôi qua kể từ tập cuối của bộ phim truyền hình, phi hành đoàn của Sidonia đã chuẩn bị kỹ lưỡng cho cuộc chiến lớn với sinh vật không tương tác, Gauna, để định cư ở hành tinh thứ bảy trong hệ sao Lem. Át chủ bài Nagate yêu Tsumugi tha thiết. Tuy nhiên, ác ý của một nhà khoa học già ẩn náu trong một chàng trai đã thay đổi toàn bộ tình hình.', 3),
(37, '1', 3, 6, 27, '2022-12-03', 'Sinh Vật Huyền Bí, Những Bí Mật của Dumbledore', 'Eddie Redmayne, Jude Law, Ezra Miller, Dan Fogler, Alison Sudol, Callum Turner,', 'David Yates,', 'https://upload.wikimedia.org/wikipedia/commons/3/3c/Sinh_v%E1%BA%ADt_huy%E1%BB%81n_b%C3%AD-_Nh%E1%BB%AFng_b%C3%AD_m%E1%BA%ADt_c%E1%BB%A7a_Dumbledore.jpg', 'https://images.kienthuc.net.vn/1200x630/Uploaded/2022/wtpe.1opz.hz/2022/04/07/sinh-vat-huyen-bi.jpg', 'Full HD - Vietsub', '142 phút', 'sinhvathuyenbii,dumbledore', 'Đang công chiếu', 'https://www.youtube.com/embed/DaM_wL1ZOM4', '', '7.2', '0', '18+', 'Sinh Vật Huyền Bí: Những Bí Mật Của Dumbledore Fantastic Beasts: The Secrets of Dumbledore 2022 Full HD Vietsub Thuyết Minh Lấy bối cảnh những năm 1930, câu chuyện dẫn đến việc Thế giới Phù thủy tham gia vào Thế chiến thứ hai và sẽ khám phá các cộng đồng phép thuật ở Bhutan, Đức và Trung Quốc cũng như các địa điểm đã thành lập trước đó bao gồm Hoa Kỳ và Vương quốc Anh. Liệu Dumbledore có đứng bên lề trong cuộc chiến sắp tới?', 4),
(38, '9', 3, 5, 27, '2022-12-03', 'Bỗng Dưng Trúng Số', 'Ko Kyoung-pyo, Lee Yi-kyung, Eum Mun-suk, Park Se-wan, Kwak Dong-yeon, Lee Soon-won, Kim Min-ho,', ' Park Gyu-tae,', 'https://upload.wikimedia.org/wikipedia/vi/e/ef/Bong_dung_trung_so.jpeg', 'https://afamilycdn.com/thumb_w/600/150157425591193600/2022/9/26/avatar1664180064937-16641800657271531592719-1-0-315-600-crop-16641801825181798239891.jpg', 'HD Vietsub', '113 phút', 'bong dung trung so, ', 'Đang công chiếu', 'https://www.youtube.com/embed/D3KbO3QF-lg', '', '6.0', '0', '10+', 'Bỗng Dưng Trúng Số 6/45 2022 Full HD Vietsub Thuyết Minh May mắn nhặt được một tờ vé số trúng thưởng trị giá hàng triệu đô la, nhưng một người lính Hàn Quốc đã để chiếc vé bay qua biên giới và cuối cùng nó đã rơi vào tay một người lính Triều Tiên. Khi biết rằng mình là người chiến thắng lớn, Yong Ho đã thay mặt Chun Woo đến nhận giải thưởng. Yong Ho đã không thể đến Hàn Quốc nhận giải vì muốn lấy lại vé số. Khi đồng đội của hai anh chàng biết được sự việc và yêu cầu họ tham gia vào cuộc đàm phán về số phận của giải thưởng, mọi chuyện trở nên phức tạp. Sau nhiều lần thương lượng, hai bên đã thống nhất chia đôi giải thưởng.Một thỏa thuận được đưa ra là phía Triều Tiên sẽ trả lại tờ vé số và phía Hàn Quốc sẽ chịu trách nhiệm đổi. Hai bên sẽ đổi một người lính để lấy số tiền được trả lại sau đó. Hai người được chọn để làm nhiệm vụ này là Yong Ho và Chun Woo. Hai người lính phải thích nghi với môi trường quân đội mới mà không được tiết lộ danh tính thật là một trong những câu chuyện hài hước nhất của cuộc hoán đổi quốc tịch.Theo dõi bỗng dưng trúng số 6/45 trên phimmoi để có những cảm xúc hài hước nhất mà phim mang đến', 72),
(39, '1', 3, 6, 23, '2022-12-03', 'Chiến Binh Báo Đen', 'Michael B. Jordan, Forest Whitaker, Martin Freeman, Andy Serkis, Chadwick Boseman, Lupita Nyong&#039;o, Daniel Kaluuya, Angela Bassett, Danai Gurira,', 'Ryan Coogler,', 'https://upload.wikimedia.org/wikipedia/vi/9/9f/Black_Panther_OS_Vol_1_2.png', 'https://www.cgv.vn/media/catalog/product/cache/1/image/1800x/71252117777b696995f01934522c402d/b/l/black-panther-2-poster-1.jpg', 'HD Vietsub thuyết minh', '120 phút', 'Chienbinhbaoden, black panther', 'Đang công chiếu', 'https://www.youtube.com/embed/xjDjIWPwcPU', '', '9.2', '', '14+', 'Chiến Binh Báo Đen (Black Panther) bao gồm cả hai bản vietsub và thuyết minh trên phimmoi. Phim kể về người chiến binh báo đen dũng cảm tên là Challa. Anh là người thừa kế ngai vàng khi vua cha băng hà. Thế nhưng các thế lực tà ác đứng phía sau quyết tâm không cho anh làm được điều đó. Chúng rắp tâm bày mưu hãm hại để độc chiếm vương quyền. Và Challa buộc phải chiến đấu để bào vệ ngôi báu không rơi vào tay kẻ xấu. Cũng như bảo vệ dân chúng trong toàn vương quốc.', 6),
(40, '', 3, 6, 20, '2022-12-03', 'Thế Giới Khủng Long', 'Judy Greer, Chris Pratt, Colin Trevorrow, Ty Simpkins,', 'Colin Trevorrow,', 'https://upload.wikimedia.org/wikipedia/vi/a/a6/Poster_phim_Th%E1%BA%BF_gi%E1%BB%9Bi_kh%E1%BB%A7ng_long_-_V%C6%B0%C6%A1ng_qu%E1%BB%91c_s%E1%BB%A5p_%C4%91%E1%BB%95.jpg', 'https://i.ytimg.com/vi/dDchspFUnnU/maxresdefault.jpg', 'HD Vietsub thuyết minh', '124 phút', 'thegioikhunglomg, jurasssic world', 'Đang công chiếu', '<iframe width=\"560\" height=\"315\" src=\"https://www.youtube.com/embed/RFinNxS5KN4\" title=\"YouTube video player\" frameborder=\"0\" allow=\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture\" allowfullscreen></iframe>', '', '6.2', '0', '14+', 'Thế Giới Khủng Long Jurassic World 2015 Full HD Vietsub Thuyết Minh Jurassic World, Jurassic World 4, Jurassic World 2015 Hai mươi hai năm sau Công viên kỷ Jura, Isla Nublar hiện là một công viên khủng long thực sự, được gọi là Jurassic World, do John Hammond hình dung ban đầu. Công viên mới thuộc sở hữu của Tập đoàn Masrani. Owen (Chris Pratt), một nhân viên công viên tại chỗ, đang nghiên cứu hành vi của Velociraptor. Nhiều năm sau, xếp hạng khách truy cập của Jurassic World giảm dần và một điểm thu hút mới, được tạo ra để thu hút lại sự chú ý của khách truy cập, đã phản tác dụng.\r\n', 1),
(41, '4', 3, 6, 23, '2022-12-03', 'Đại Dịch Thây Ma', 'Marco Albrecht, Trine Dyrholm, Gro Swantje Kohlhof, Maja Lehrer, Barbara Philipp, Yûho Yamashita,', 'Carolina Hellsgård,', 'https://i.imgur.com/eFiyeyd.jpg', 'https://th.bing.com/th/id/R.e651b7142c0cb714000daa706fa0d88f?rik=y1BtjktEI7%2fJlg&pid=ImgRaw&r=0', 'HD Vietsub', '90 phút', 'dai dich thay ma', 'Đang công chiếu', 'https://www.youtube.com/embed/d_nPQ4Inzbw', '', '5.0', '0', '18+', 'Đại Dịch Thây Ma Endzeit: Ever After 2018 Full HD Vietsub Thuyết Minh Đã hai năm trôi qua kể từ khi đại dịch virus zombie lây nhiễm tất cả trừ hai thành phố của Đức. Vivi và Eva chạy trốn khỏi cộng đồng đang gặp khó khăn ở Weimar để đến một nơi trú ẩn an toàn khác: Jena.', 3),
(42, '', 0, 0, 0, '1970-01-01', 'aaaa', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `nation`
--

CREATE TABLE `nation` (
  `id` int(255) NOT NULL,
  `mv_id` int(255) NOT NULL,
  `nation_id` int(255) NOT NULL,
  `nation_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `nation`
--

INSERT INTO `nation` (`id`, `mv_id`, `nation_id`, `nation_name`) VALUES
(1, 0, 1, 'Mỹ'),
(2, 0, 2, 'Nhật Bản'),
(3, 0, 3, 'Thái Lan'),
(4, 0, 4, 'Trung Quốc'),
(5, 0, 5, 'Hàn Quốc'),
(6, 0, 6, 'Phim âu mĩ');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `view`
--

CREATE TABLE `view` (
  `view_page` int(255) NOT NULL,
  `view_mv` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `view`
--

INSERT INTO `view` (`view_page`, `view_mv`) VALUES
(291, 0),
(287, 0);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `year`
--

CREATE TABLE `year` (
  `id` int(255) NOT NULL,
  `mv_id` int(255) NOT NULL,
  `year` varchar(255) NOT NULL,
  `year_id` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `year`
--

INSERT INTO `year` (`id`, `mv_id`, `year`, `year_id`) VALUES
(1, 0, '1996', 1),
(2, 0, '1997', 2),
(3, 0, '1998', 3),
(4, 0, '1999', 4),
(5, 0, '2000', 5),
(6, 0, '2001', 6),
(7, 0, '2002', 7),
(8, 0, '2003', 8),
(9, 0, '2004', 9),
(10, 0, '2005', 10),
(11, 0, '2006', 11),
(12, 0, '2007', 12),
(13, 0, '2008', 13),
(14, 0, '2009', 14),
(15, 0, '2010', 15),
(16, 0, '2011', 16),
(17, 0, '2012', 17),
(18, 0, '2013', 18),
(19, 0, '2014', 19),
(20, 0, '2015', 20),
(21, 0, '2016', 21),
(22, 0, '2017', 22),
(23, 0, '2018', 23),
(24, 0, '2019', 24),
(25, 0, '2020', 25),
(26, 0, '2021', 26),
(27, 0, '2022', 27);

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `account`
--
ALTER TABLE `account`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `cat_mv`
--
ALTER TABLE `cat_mv`
  ADD PRIMARY KEY (`id_cat`);

--
-- Chỉ mục cho bảng `complete`
--
ALTER TABLE `complete`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `episode`
--
ALTER TABLE `episode`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `favorite`
--
ALTER TABLE `favorite`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `genre`
--
ALTER TABLE `genre`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `movie`
--
ALTER TABLE `movie`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `nation`
--
ALTER TABLE `nation`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `year`
--
ALTER TABLE `year`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `account`
--
ALTER TABLE `account`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT cho bảng `category`
--
ALTER TABLE `category`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT cho bảng `cat_mv`
--
ALTER TABLE `cat_mv`
  MODIFY `id_cat` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT cho bảng `complete`
--
ALTER TABLE `complete`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT cho bảng `contact`
--
ALTER TABLE `contact`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT cho bảng `episode`
--
ALTER TABLE `episode`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT cho bảng `favorite`
--
ALTER TABLE `favorite`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT cho bảng `genre`
--
ALTER TABLE `genre`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT cho bảng `movie`
--
ALTER TABLE `movie`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=124;

--
-- AUTO_INCREMENT cho bảng `nation`
--
ALTER TABLE `nation`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT cho bảng `year`
--
ALTER TABLE `year`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
