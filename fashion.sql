-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th3 31, 2023 lúc 08:57 AM
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
-- Cơ sở dữ liệu: `fashion`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `accounts`
--

CREATE TABLE `accounts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `attribute`
--

CREATE TABLE `attribute` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `value` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `attribute`
--

INSERT INTO `attribute` (`id`, `value`, `created_at`, `updated_at`) VALUES
(1, 'Size', '2023-03-09 03:48:53', '2023-03-09 03:50:33'),
(2, 'Color', '2023-03-09 04:32:17', '2023-03-09 04:33:39');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `attribute_value`
--

CREATE TABLE `attribute_value` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `value` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `attribute_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `attribute_value`
--

INSERT INTO `attribute_value` (`id`, `value`, `attribute_id`, `created_at`, `updated_at`) VALUES
(1, 'M', 1, '2023-03-09 07:47:12', '2023-03-09 07:47:12'),
(2, 'red', 2, '2023-03-10 00:54:47', '2023-03-10 00:54:47'),
(3, 'L', 1, '2023-03-10 02:03:24', '2023-03-10 02:03:24'),
(4, 'yellow', 2, '2023-03-10 02:03:36', '2023-03-10 02:09:30'),
(5, 'S', 1, '2023-03-15 22:48:52', '2023-03-15 22:48:52'),
(6, 'XL', 1, '2023-03-15 22:49:00', '2023-03-15 22:49:00'),
(7, 'XXL', 1, '2023-03-15 22:49:08', '2023-03-15 22:49:08'),
(8, 'blue', 2, '2023-03-15 22:49:19', '2023-03-15 22:49:19'),
(9, 'green', 2, '2023-03-15 22:49:33', '2023-03-15 22:49:33'),
(10, 'black', 2, '2023-03-15 22:49:43', '2023-03-15 22:49:43'),
(11, 'white', 2, '2023-03-15 22:49:54', '2023-03-15 22:49:54'),
(12, 'orange', 2, '2023-03-15 22:50:10', '2023-03-15 22:50:27');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `brands`
--

CREATE TABLE `brands` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `logo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `brands`
--

INSERT INTO `brands` (`id`, `name`, `logo`, `created_at`, `updated_at`) VALUES
(1, 'CollMate', 'https://img.ws.mms.shopee.vn/02cc55b581a1da07745c4e19070c0f16_tn', '2023-01-13 07:02:13', '2023-01-13 07:02:13'),
(2, 'Owen', 'https://img.ws.mms.shopee.vn/57342653dc9b639f5848dc52c99d94b0_tn', NULL, '2023-03-09 07:03:39'),
(3, 'Ivy Moda', 'https://cf.shopee.vn/file/ef90220417fe3b7e0a3ffe7c3bbc986c_tn', '2023-03-15 22:54:26', '2023-03-15 22:54:26'),
(4, 'Quốc Tế', 'https://cf.shopee.vn/file/b131de3bfa30b0d2322b495cb0b51be4_tn', '2023-03-16 07:43:55', '2023-03-16 07:43:55');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `parent_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `categories`
--

INSERT INTO `categories` (`id`, `name`, `created_at`, `updated_at`, `parent_id`) VALUES
(1, 'Áo thun nam', '2023-11-01 16:49:40', '2023-03-09 09:02:20', 8),
(2, 'Áo khoác nam', '2023-01-11 17:15:31', '2023-03-09 09:13:01', 8),
(3, 'Áo khoác nữ', '2023-01-11 22:30:27', '2023-03-09 09:13:44', 9),
(4, 'Áo thun nữ', '2023-01-12 08:56:14', '2023-03-09 09:13:55', 9),
(5, 'Giày Nam', '2023-01-12 08:56:28', '2023-03-09 09:14:10', 8),
(6, 'Kính nam', '2023-01-12 08:56:54', '2023-03-09 09:14:25', 8),
(7, 'Kính nữ', '2023-01-12 08:57:15', '2023-03-09 09:14:50', 9),
(8, 'Nam', '2023-03-09 08:58:09', '2023-03-09 08:58:09', 0),
(9, 'Nữ', '2023-03-09 09:13:21', '2023-03-09 09:13:21', 0);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `category_products`
--

CREATE TABLE `category_products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_product` bigint(20) NOT NULL,
  `id_category` bigint(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `category_products`
--

INSERT INTO `category_products` (`id`, `id_product`, `id_category`, `created_at`, `updated_at`) VALUES
(1, 1, 1, '2023-01-11 17:06:22', '2023-01-11 17:05:33'),
(2, 2, 2, '2023-01-11 17:17:02', '2023-01-11 17:17:02'),
(3, 3, 4, '2023-01-12 10:38:48', '2023-01-12 10:38:48'),
(4, 3, 1, '2023-01-12 10:39:23', '2023-01-12 10:39:23'),
(21, 5, 4, '2023-03-15 23:07:09', '2023-03-15 23:07:09'),
(22, 6, 2, '2023-03-16 07:39:28', '2023-03-16 07:39:28'),
(23, 7, 3, '2023-03-16 07:42:30', '2023-03-16 07:42:30'),
(24, 8, 3, '2023-03-18 08:15:06', '2023-03-18 08:15:06'),
(25, 9, 2, '2023-03-18 08:39:12', '2023-03-18 08:39:12');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `feedbacks`
--

CREATE TABLE `feedbacks` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `content` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `rate` int(255) NOT NULL,
  `product_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `feedbacks`
--

INSERT INTO `feedbacks` (`id`, `name`, `email`, `title`, `image`, `content`, `rate`, `product_id`, `created_at`, `updated_at`) VALUES
(1, 'test', 'test@gmail.com', 'Đánh giá', 'storage/review/1679386463.jpg', 'Sản phẩm tốt lắm nha', 5, 1, '2023-03-21 01:27:44', '2023-03-21 01:27:44'),
(2, 'vinh', 'vinhhttt@gmail.com', 'Nhận xét', NULL, 'Sản phẩm tạm ổn', 5, 1, '2023-03-22 08:02:17', '2023-03-22 08:02:17'),
(3, 'vinh', 'vinhhttt@gmail.com', 'Nhận xét lại', NULL, 'Cũng ok', 5, 1, '2023-03-22 08:03:28', '2023-03-22 08:03:28'),
(4, 'vinh', 'vinhhttt@gmail.com', 'Đánh giá', 'storage/review/1679497549.png', 'ok chưa', 5, 1, '2023-03-22 08:05:50', '2023-03-22 08:05:50'),
(9, 'vinh', 'vinhhttt@gmail.com', 'Ok chưa', NULL, 'test', 5, 9, '2023-03-22 08:35:22', '2023-03-22 08:35:22'),
(10, 'vinh', 'vinhhttt@gmail.com', 'Test2', NULL, 'ok chưa', 5, 9, '2023-03-22 08:37:24', '2023-03-22 08:37:24'),
(11, 'vinh', 'vinhhttt@gmail.com', 'Vụ Án D', 'storage/review/1679499548.jpg', 'Test lại', 5, 9, '2023-03-22 08:39:08', '2023-03-22 08:39:08'),
(12, 'vinh', 'vinhhttt@gmail.com', 'ABC', NULL, 'đasad', 5, 9, '2023-03-22 08:43:04', '2023-03-22 08:43:04'),
(13, 'vinh', 'vinhhttt@gmail.com', 'đasada', NULL, 'đasadsad', 5, 9, '2023-03-22 08:43:43', '2023-03-22 08:43:43'),
(14, 'vinh', 'vinhhttt@gmail.com', 'đâsda', 'storage/review/1679499910.jpg', 'đasadsad', 5, 9, '2023-03-22 08:45:10', '2023-03-22 08:45:10'),
(15, 'vinh', 'vinhhttt@gmail.com', 'dasdad', NULL, 'dassadads', 5, 9, '2023-03-22 08:46:18', '2023-03-22 08:46:18'),
(16, 'vinh', 'vinhhttt@gmail.com', 'dasdsada', NULL, 'dasdsada', 5, 9, '2023-03-22 08:48:21', '2023-03-22 08:48:21'),
(17, 'vinh', 'vinhhttt@gmail.com', 'dasdsa', NULL, 'dasdada', 5, 9, '2023-03-22 08:52:32', '2023-03-22 08:52:32'),
(18, 'vinh', 'vinhhttt@gmail.com', 'sadadad', NULL, 'dasddada', 5, 9, '2023-03-22 08:58:50', '2023-03-22 08:58:50'),
(19, 'vinh', 'vinhhttt@gmail.com', 'dsadsada', 'storage/review/1679500786.png', 'dasdadada', 5, 9, '2023-03-22 08:59:46', '2023-03-22 08:59:46'),
(20, 'vinh', 'vinhhttt@gmail.com', 'ABC', NULL, 'dsadsadsa', 5, 9, '2023-03-22 09:00:42', '2023-03-22 09:00:42'),
(25, 'vinh', 'vinhhttt@gmail.com', 'Case', 'storage/review/1679669504.jpg', 'abc', 5, 6, '2023-03-24 07:51:44', '2023-03-24 07:51:44'),
(26, 'vinh', 'vinhhttt@gmail.com', 'nnnnnn', NULL, 'aaaa', 5, 6, '2023-03-24 07:52:00', '2023-03-24 07:52:00'),
(27, 'vinh', 'vinhhttt@gmail.com', 'đasadad', NULL, 'ádadadsa', 5, 6, '2023-03-24 07:53:34', '2023-03-24 07:53:34'),
(33, 'test', 'test@gmail.com', 'dada', NULL, 'dasad', 3, 6, '2023-03-25 03:01:01', '2023-03-25 03:01:01'),
(34, 'vinh', 'vinhhttt@gmail.com', 'Vụ Án', NULL, 'baby', 5, 7, '2023-03-26 01:50:56', '2023-03-26 01:50:56');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `images`
--

CREATE TABLE `images` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `path` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `images`
--

INSERT INTO `images` (`id`, `path`, `product_id`, `created_at`, `updated_at`) VALUES
(1, 'https://cf.shopee.vn/file/7692991141cbc2cb5c540d40dc38a041', 2, '2023-03-09 22:08:37', '2023-03-15 22:40:29'),
(2, 'https://cf.shopee.vn/file/sg-11134201-22110-0bq09o61jxjv2d', 1, '2023-03-12 23:48:38', '2023-03-14 22:27:36'),
(3, 'https://cf.shopee.vn/file/vn-11134201-23030-jlkmn1ldvmovd7', 3, '2023-03-15 05:32:49', '2023-03-15 05:32:49'),
(4, 'https://cf.shopee.vn/file/sg-11134201-22110-fp9pk361jxjv84', 1, '2023-03-15 22:32:57', '2023-03-15 22:32:57'),
(5, 'https://cf.shopee.vn/file/sg-11134201-22110-zmylg761jxjv94', 1, '2023-03-15 22:38:40', '2023-03-15 22:38:59'),
(6, 'https://cf.shopee.vn/file/ede76c6d79cadc752a268e2476156170', 2, '2023-03-15 22:41:32', '2023-03-15 22:42:37'),
(7, 'https://cf.shopee.vn/file/634a4c77c439d0477f40fff2fc202fd7', 2, '2023-03-15 22:42:27', '2023-03-15 22:42:27'),
(8, 'https://cf.shopee.vn/file/vn-11134201-23020-dzeciom2z3nv2a', 3, '2023-03-15 22:45:25', '2023-03-15 22:45:25'),
(9, 'https://cf.shopee.vn/file/vn-11134201-23020-jykurym2z3nvc1', 3, '2023-03-15 22:45:49', '2023-03-15 22:45:49'),
(10, 'https://cf.shopee.vn/file/6d79c2a6c418b06f8071e9e6d9575b3c', 5, '2023-03-15 23:40:11', '2023-03-15 23:40:11'),
(11, 'https://cf.shopee.vn/file/44ec4d2bfdf45bbdb54c2fbdc2f233cd', 5, '2023-03-16 03:43:43', '2023-03-16 03:43:43'),
(12, 'https://cf.shopee.vn/file/d80ba91ef2677e6ecfa8fbbf0e28b1e9', 5, '2023-03-16 03:44:11', '2023-03-16 03:44:11'),
(13, 'https://down-vn.img.susercontent.com/file/sg-11134201-22110-3j9cmiuan0jvb8', 6, '2023-03-16 07:47:02', '2023-03-16 07:47:02'),
(14, 'https://down-vn.img.susercontent.com/file/sg-11134201-22110-1ky7xluan0jv27', 6, '2023-03-16 07:47:29', '2023-03-16 07:47:29'),
(15, 'https://down-vn.img.susercontent.com/file/sg-11134201-22110-8jo2jpuan0jv2d', 6, '2023-03-16 07:47:56', '2023-03-16 07:47:56'),
(16, 'https://down-vn.img.susercontent.com/file/73ee387de6749a8426f9e5061ef8d186', 7, '2023-03-16 07:48:39', '2023-03-16 07:48:39'),
(17, 'https://down-vn.img.susercontent.com/file/b6ae62438643e4995f6495fa403086aa', 7, '2023-03-16 07:49:08', '2023-03-16 07:49:08'),
(18, 'https://down-vn.img.susercontent.com/file/11add0cccf0280f3053cd7bac44c007f', 7, '2023-03-16 07:49:32', '2023-03-16 07:49:32'),
(19, 'https://down-vn.img.susercontent.com/file/sg-11134201-22100-9mp4prq6d2iv8f', 8, '2023-03-18 08:16:02', '2023-03-18 08:16:02'),
(20, 'https://down-vn.img.susercontent.com/file/sg-11134201-22100-eulcd2x6d2ivd2', 8, '2023-03-18 08:16:37', '2023-03-18 08:16:37'),
(21, 'https://down-vn.img.susercontent.com/file/sg-11134201-22100-9yuvg4f7d2iv42', 8, '2023-03-18 08:18:17', '2023-03-18 08:18:17'),
(22, 'https://down-vn.img.susercontent.com/file/vn-11134201-23030-zd27d7bn2jovff', 9, '2023-03-18 08:45:15', '2023-03-18 08:45:15'),
(23, 'https://down-vn.img.susercontent.com/file/vn-11134201-23030-99pzdbcn2jov5a', 9, '2023-03-18 08:45:55', '2023-03-18 08:45:55'),
(24, 'https://down-vn.img.susercontent.com/file/vn-11134201-23030-nol528bn2jove0', 9, '2023-03-18 08:46:21', '2023-03-18 08:46:21');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `infoaccounts`
--

CREATE TABLE `infoaccounts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_account` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `birthday` date NOT NULL,
  `gender` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `hobbies` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `images_url` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2023_01_02_091253_create_products_table', 2),
(6, '2023_01_06_124131_create_accounts_table', 3),
(8, '2023_01_06_124325_create_infoaccounts_table', 4),
(9, '2023_01_06_150400_create_products_table', 5),
(12, '2023_01_07_113047_alter_products_add_id_branch_column', 6),
(13, '2023_01_07_114310_create_categories_table', 6),
(15, '2023_01_07_140024_create_brands_table', 7),
(16, '2023_01_07_141002_alter_products_add_made_day_column', 8),
(18, '2023_01_07_141329_create_feedbacks_table', 9),
(19, '2023_01_07_142823_create_orders_table', 10),
(20, '2023_01_07_144641_create_order_details_table', 11),
(21, '2023_01_08_124611_create_accounts_table', 12),
(22, '2023_01_11_155127_create_category_products_table', 13),
(23, '2023_03_06_060007_add_role_to_users_table', 14),
(24, '2023_03_07_085358_add_parent_id_to_categories_table', 15),
(25, '2023_03_07_085542_create_attribute_value_table', 15),
(26, '2023_03_07_085650_create_product_attribute_value_table', 15),
(27, '2023_03_07_090130_create_attribute_table', 16),
(29, '2023_03_09_091554_edit_role_to_users_table', 17),
(30, '2023_03_09_092600_create_roles_table', 18),
(31, '2023_03_10_035713_create_images_table', 19),
(32, '2023_03_12_035636_add_soft_delete_to_users_table', 20),
(33, '2023_03_12_035801_add_soft_delete_to_products_table', 20),
(34, '2023_03_15_034914_create_rating_table', 21),
(35, '2023_03_18_145636_add_sale_to_products_table', 22),
(36, '2023_03_24_143124_create_wishlist_table', 23),
(37, '2023_03_31_035216_add_user_id_to_wishlist_table', 24);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `fullname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `note` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `order_date` date NOT NULL,
  `status` int(11) NOT NULL,
  `total_money` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `order_details`
--

CREATE TABLE `order_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `number` int(11) NOT NULL,
  `total_money` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `personal_access_tokens`
--

INSERT INTO `personal_access_tokens` (`id`, `tokenable_type`, `tokenable_id`, `name`, `token`, `abilities`, `last_used_at`, `created_at`, `updated_at`) VALUES
(1, 'App\\Models\\User', 2, 'token', '0a33c0b658c12da7d825489d79ff664dd80b7c6d6812256d49f95de7adcab5ca', '[\"*\"]', NULL, '2023-02-22 03:10:42', '2023-02-22 03:10:42'),
(2, 'App\\Models\\User', 2, 'token', 'e04246d5546a1a9d5d8ca6a74fd894ac17bea6fd2932aa5e45965ea87da85f09', '[\"*\"]', NULL, '2023-02-22 03:11:34', '2023-02-22 03:11:34'),
(3, 'App\\Models\\User', 2, 'token', '0e49f783c313d8aca3fb2ba44bc987ebebb97503c8197c20cfbe00ae62424de7', '[\"*\"]', NULL, '2023-02-22 03:11:40', '2023-02-22 03:11:40'),
(4, 'App\\Models\\User', 2, 'token', '7469c08b40b8909fd71b46e5fcfd5a1e1ee8319498707d0dbcaa128c2cbbf1b1', '[\"*\"]', '2023-02-22 03:22:08', '2023-02-22 03:21:40', '2023-02-22 03:22:08');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` float NOT NULL,
  `brand_id` int(11) NOT NULL,
  `discount` float DEFAULT NULL,
  `sale` int(11) NOT NULL DEFAULT 0,
  `stock` int(11) NOT NULL,
  `desce` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `products`
--

INSERT INTO `products` (`id`, `name`, `slug`, `price`, `brand_id`, `discount`, `sale`, `stock`, `desce`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Áo Khoác Cardigan Viền Xanh Nâu FRMLK Form Rộng', 'ao-khoac-cardigan-vien-xanh-nau-frmlk-form-rong', 800000, 1, 40, 1, 12, 'abc', '2023-01-11 05:09:46', '2023-03-15 22:37:34', NULL),
(2, 'Áo thun phông logo PINK tay lỡ  SANJATI Unisex', 'a', 105000, 1, 20, 0, 59, 'Chất liệu : thun cotton dày dặn, hình in nhiệt chắc chắc🔻Form : 3 Size ( Áo đã được cải tiến về Số Đo , Form Dáng & Mẫu Mã đẹp hơn ạ ✔️M : < 45kg , Cao < 1.6m✔️L : 46kg _ 65kg , Cao 1.6m _ 1.7m ✔️XL : 66kg _ 75kg , Cao 1.7m _ 1.75m', '2023-01-12 10:13:33', '2023-03-14 06:54:25', NULL),
(3, 'Áo thun nam Care & Share cotton compact in Mặt Trời', 'ao-thun-nam-care-share-cotton-compact-in-mat-troi', 259000, 1, NULL, 0, 90, 'Một công ty không cần phải lớn mới làm điều ý nghĩa\" - Coolmate đã nghĩ và tin như thế khi khởi xướng chương trình Care & Share này. Sức nhỏ làm việc nhỏ, có ít đóng góp ít, có nhiều đóng góp nhiều. Ít nhất chúng ta đã bắt tay vào làm và lan toả điều tích cực. \r\n\r\n\r\nHiểu một cách đơn giản, \"Care & Share: For A Better Childhood\" là một chương trình được xây dựng và duy trì bởi Coolmate nhằm góp sức mình giúp đỡ những trẻ em kém may mắn, giúp các em đến trường và có cuộc sống tốt hơn. Coolmate cam kết sẽ dành 10% doanh thu từ tất cả những sản phẩm trong danh mục \"Care & Share\" để đóng góp vào quỹ dành cho trẻ em có hoàn cảnh khó khăn. Coolmate mong muốn là một cầu nối để viết tiếp những ước mơ con trẻ còn dang dở, hướng tới một tương lai tốt đẹp hơn.', '2023-03-15 05:31:11', '2023-03-15 05:31:11', NULL),
(5, 'Áo thun nữ trơn cổ V IVY moda MS 57P0155', 'ao-thun-nu-tron-co-v-ivy-moda-ms-57p0155', 490000, 3, 8, 0, 200, 'Áo thun cổ V, cộc tay, form suông basic phù hợp với mọi vóc dáng.Sản phẩm được tạo ra từ chất liệu Thun cao cấp, với những tính năng vượt trội như thấm hút mồ hôi tốt và có độ co dãn giúp người mặc vô cùng thoải mái. Hơn hết có thể dễ dàng mix&match được với nhiều kiểu quần khác nhau. Đấy chính là lý do để phái nữ nên có ít nhất một chiếc áo thun trong tủ đồ của bạn.', '2023-03-15 23:07:09', '2023-03-15 23:07:17', NULL),
(6, 'Áo khoác bò, áo khoác thu đông nam Việt Nam cá tính năng động mã N51', 'ao-khoac-bo-ao-khoac-thu-dong-nam-viet-nam-ca-tinh-nang-dong-ma-n51', 500000, 2, 8, 0, 160, '- Phong cách Việt Nam\r\n- Form dáng : Slim Fitl\r\n- mùa thích hơp : Mùa Thu đông\r\n- Thành phần chính của vải  bò\r\n- Đặc tính của Vải : chất vải lai kaki thân thiện với môi trường, mặc tạo cảm giác thoải mái.\r\n- Độ dày : vừa phải.', '2023-03-16 07:39:27', '2023-03-16 07:39:27', NULL),
(7, 'Áo khoác lông dáng dài của nữ phong cách sang trọng khí chất thanh lịch hàng Quảng Châu cao cấp', 'ao-khoac-long-dang-dai-cua-nu-phong-cach-sang-trong-khi-chat-thanh-lich-hang-quang-chau-cao-cap', 701000, 4, NULL, 0, 56, '❗❗❗  Để đảm bảo hàng về kịp Tết, quý khách hàng vui lòng đặt đơn trước 23h59 ngày 01/01/2022⚜KÍCH THƯỚC⚜Chiều rộng vai 55    Ngực 134      Chiều dài áo 109       Tay áo dài 50(Đơn vị: cm, lát gạch và đo bằng tay, có thể sai số 1-2cm, chỉ mang tính chất tham khảo)✔Thời gian giao hàng của sản phẩm này là 7-15 ngày✔Khuyến khích khách hàng nhắn tin cho shop trước khi đặt hàng‼‼KHÔNG NHẬN ĐƠN NẾU BẠN CẦN GẤP💥Lưu ý:💭Đảm bảo khi nhận hàng bạn sẽ không thất vọng💭Hotline: 0937768275💌 Chúc bạn có một buổi mua sắm vui vẻ', '2023-03-16 07:42:30', '2023-03-16 07:46:17', NULL),
(8, 'BEAUTEBYV - Áo khoác Trench Coat 2022', 'beautebyv-ao-khoac-trench-coat-2022', 1200000, 4, 30, 1, 300, '1. Giặt tay bằng nước lạnh.\r\n\r\n2. Trước khi giặt phải phân loại màu; cài khuy, kéo hết khóa và lộn trái sản phẩm. Tránh đổ trực tiếp xà phòng lên quần áo.\r\n\r\n3. Tuyệt đối không ngâm, không dùng chất tẩy (đặc biệt đối với vải màu).\r\n\r\n4. Đối với các sản phẩm phối màu: giặt nhanh bằng tay, không ngâm, để an toàn nhất có thể giặt bằng nước rửa chén.\r\n\r\n5. Đối với các sản phẩm có đính hoa cố định, các chất liệu len, dạ nên giặt khô.', '2023-03-18 08:15:06', '2023-03-18 08:15:06', NULL),
(9, 'Áo khoác nam 100% cotton Tum Machines TUMS NVSCVR TEAM JACKET – BLACK', 'ao-khoac-nam-100-cotton-tum-machines-tums-nvscvr-team-jacket-–-black', 680000, 2, 30, 1, 200, '_ THÀNH PHẦN VẢI : 100% COTTON ( COTTON TWILL NHẬP KHẨU ), PHẦN LÓT ÁO 100% POLYESTER MANG LẠI SỰ THOÁNG MÁT TỐT NHẤT.\r\n\r\n_ TẤT CẢ HỌA TIẾT TRÊN ÁO ĐỀU ĐƯỢC DÙNG QUY CÁCH IN, THÊU MẢNG VÀ NÉT CAO CẤP, CHO SỰ SẮC NÉT, KHÔNG BONG TRÓC.\r\n\r\n_ ÁO DÙNG NÚT ĐÓNG BẰNG NHÔM CHỐNG GHỈ, 2 TÚI ÁO ĐƯỢC MAY Ở 2 BÊN SƯỜN ÁO\r\n\r\n” SAU SỰ THÀNH CÔNG CỦA WE’RE BADASS JACKET, TEAM TUMS LUÔN MUỐN TẠO RA THÊM MỘT CHIẾC JACKET MANG HƠI HƯỚNG CỦA NASCAR VỚI GIÁ THÀNH PHẢI CHĂNG, BỀN BỈ, ĐA DỤNG VÀ DỄ MẶC. VÀ TUM RACING TEAM JACKET RA ĐỜI. “\r\n\r\n_XUẤT XỨ: VIỆT NAM', '2023-03-18 08:39:12', '2023-03-18 08:39:12', NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `product_attribute_value`
--

CREATE TABLE `product_attribute_value` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` int(11) NOT NULL,
  `attribute_value_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `product_attribute_value`
--

INSERT INTO `product_attribute_value` (`id`, `product_id`, `attribute_value_id`, `created_at`, `updated_at`) VALUES
(3, 1, 1, '2023-03-10 02:02:21', '2023-03-10 02:02:21'),
(4, 1, 2, '2023-03-10 02:02:21', '2023-03-10 02:02:21'),
(5, 2, 1, '2023-03-10 02:03:09', '2023-03-10 02:03:09'),
(6, 2, 2, '2023-03-10 02:03:09', '2023-03-10 02:03:09'),
(7, 3, 1, '2023-03-15 05:31:11', '2023-03-15 05:31:11'),
(8, 3, 3, '2023-03-15 05:31:11', '2023-03-15 05:31:11'),
(9, 3, 2, '2023-03-15 05:31:11', '2023-03-15 05:31:11'),
(10, 3, 4, '2023-03-15 05:31:11', '2023-03-15 05:31:11'),
(11, 5, 1, '2023-03-15 23:07:09', '2023-03-15 23:07:09'),
(19, 5, 3, '2023-03-15 23:08:36', '2023-03-15 23:08:36'),
(20, 5, 5, '2023-03-15 23:08:36', '2023-03-15 23:08:36'),
(21, 5, 6, '2023-03-15 23:08:36', '2023-03-15 23:08:36'),
(22, 5, 7, '2023-03-15 23:08:36', '2023-03-15 23:08:36'),
(23, 5, 8, '2023-03-15 23:08:36', '2023-03-15 23:08:36'),
(24, 5, 10, '2023-03-15 23:08:36', '2023-03-15 23:08:36'),
(25, 5, 11, '2023-03-15 23:08:36', '2023-03-15 23:08:36'),
(26, 6, 1, '2023-03-16 07:39:28', '2023-03-16 07:39:28'),
(27, 6, 3, '2023-03-16 07:39:28', '2023-03-16 07:39:28'),
(28, 6, 5, '2023-03-16 07:39:28', '2023-03-16 07:39:28'),
(29, 6, 6, '2023-03-16 07:39:28', '2023-03-16 07:39:28'),
(30, 6, 7, '2023-03-16 07:39:28', '2023-03-16 07:39:28'),
(31, 6, 8, '2023-03-16 07:39:28', '2023-03-16 07:39:28'),
(32, 7, 6, '2023-03-16 07:42:30', '2023-03-16 07:42:30'),
(33, 7, 2, '2023-03-16 07:42:30', '2023-03-16 07:42:30'),
(34, 8, 1, '2023-03-18 08:15:06', '2023-03-18 08:15:06'),
(35, 8, 5, '2023-03-18 08:15:06', '2023-03-18 08:15:06'),
(36, 8, 4, '2023-03-18 08:15:06', '2023-03-18 08:15:06'),
(37, 9, 1, '2023-03-18 08:39:12', '2023-03-18 08:39:12'),
(38, 9, 3, '2023-03-18 08:39:12', '2023-03-18 08:39:12'),
(39, 9, 5, '2023-03-18 08:39:12', '2023-03-18 08:39:12'),
(40, 9, 10, '2023-03-18 08:39:12', '2023-03-18 08:39:12');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `rating`
--

CREATE TABLE `rating` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` int(11) NOT NULL,
  `rate_star` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `roles`
--

INSERT INTO `roles` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'User', '2023-03-09 09:27:17', '2023-03-09 09:27:17'),
(2, 'Admin', '2023-03-09 09:27:56', '2023-03-09 09:27:56'),
(3, 'Editor', '2023-03-09 09:28:16', '2023-03-09 09:28:16');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `role_id` int(10) UNSIGNED NOT NULL DEFAULT 1,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `users`
--

INSERT INTO `users` (`id`, `role_id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 2, 'vinh', 'vinhhttt@gmail.com', NULL, '$2y$10$RQcRNRMQIfjzEFklr2EEIeIOKmWmhMwd0jOVow8wGvn5ezoAnzlUG', NULL, '2023-02-05 08:18:25', '2023-02-05 08:18:25', NULL),
(2, 1, 'a', 'a@gmail.com', NULL, '$2y$10$iCqUB6O.ooamGhE5X9DnLeT0XvW70Wlrnw5Zb2qOzljVH8/0pDcFm', NULL, '2023-02-22 02:52:54', '2023-02-22 02:52:54', NULL),
(3, 3, '0', 'b@gmail.com', NULL, '$2y$10$28J1kQJq6OMOfELOeIpgEuuExankw2MaKI9tL4ks6hxLhe0weJx3C', NULL, '2023-03-05 23:06:38', '2023-03-06 06:42:35', NULL),
(4, 1, 'test', 'test@gmail.com', NULL, '$2y$10$FK0S5rj.kNYKul4xinWcrOYAyTKS0svzOxxa8kPXPrkVYvj99SgoW', NULL, '2023-03-09 02:14:11', '2023-03-09 02:14:11', NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `wishlist`
--

CREATE TABLE `wishlist` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `wishlist`
--

INSERT INTO `wishlist` (`id`, `product_id`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 2, 1, '2023-03-30 21:25:39', '2023-03-30 21:25:39'),
(2, 8, 1, '2023-03-30 21:27:19', '2023-03-30 21:27:19'),
(3, 7, 1, '2023-03-30 21:31:24', '2023-03-30 21:31:24'),
(4, 1, 1, '2023-03-30 21:31:53', '2023-03-30 21:31:53');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `accounts`
--
ALTER TABLE `accounts`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `attribute`
--
ALTER TABLE `attribute`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `attribute_value`
--
ALTER TABLE `attribute_value`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `category_products`
--
ALTER TABLE `category_products`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Chỉ mục cho bảng `feedbacks`
--
ALTER TABLE `feedbacks`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `infoaccounts`
--
ALTER TABLE `infoaccounts`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `order_details`
--
ALTER TABLE `order_details`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Chỉ mục cho bảng `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Chỉ mục cho bảng `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `products_name_unique` (`name`);

--
-- Chỉ mục cho bảng `product_attribute_value`
--
ALTER TABLE `product_attribute_value`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `rating`
--
ALTER TABLE `rating`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Chỉ mục cho bảng `wishlist`
--
ALTER TABLE `wishlist`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `accounts`
--
ALTER TABLE `accounts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `attribute`
--
ALTER TABLE `attribute`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT cho bảng `attribute_value`
--
ALTER TABLE `attribute_value`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT cho bảng `brands`
--
ALTER TABLE `brands`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT cho bảng `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT cho bảng `category_products`
--
ALTER TABLE `category_products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT cho bảng `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `feedbacks`
--
ALTER TABLE `feedbacks`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT cho bảng `images`
--
ALTER TABLE `images`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT cho bảng `infoaccounts`
--
ALTER TABLE `infoaccounts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT cho bảng `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `order_details`
--
ALTER TABLE `order_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT cho bảng `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT cho bảng `product_attribute_value`
--
ALTER TABLE `product_attribute_value`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT cho bảng `rating`
--
ALTER TABLE `rating`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT cho bảng `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT cho bảng `wishlist`
--
ALTER TABLE `wishlist`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
