-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 12, 2022 at 05:27 PM
-- Server version: 10.4.18-MariaDB
-- PHP Version: 7.4.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `do_the_thao`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` int(11) NOT NULL DEFAULT 2 COMMENT '1: superadmin, 2: admin',
  `ins_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `upd_date` timestamp NULL DEFAULT NULL,
  `del_flag` char(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0' COMMENT 'deleted:1, active:0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `email`, `password`, `role`, `ins_date`, `upd_date`, `del_flag`) VALUES
(1, 'admin@gmail.com', '$2y$10$gT4jtvn8c1FSDSsa9k4VnebyBqdskFuraIv5eoSWEuzrcNDp2uDV2', 2, '2021-06-15 14:03:26', NULL, '0');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `amount` int(11) NOT NULL,
  `size` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ins_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `upd_date` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `parent_id` int(11) DEFAULT 0,
  `level` int(11) DEFAULT 1,
  `ins_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `upd_date` timestamp NULL DEFAULT NULL,
  `del_flag` char(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0' COMMENT 'deleted:1, active:0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `name`, `slug`, `parent_id`, `level`, `ins_date`, `upd_date`, `del_flag`) VALUES
(1, 'Đồ thể thao nam', 'do-the-thao-nam', 0, 1, '2021-06-15 14:03:26', NULL, '0'),
(2, 'Đồ thể thao nữ', 'do-the-thao-nu', 0, 1, '2021-06-15 14:03:26', NULL, '0'),
(3, 'Phụ kiện thể thao', 'phu-kien-the-thao', 0, 1, '2021-06-15 14:03:26', NULL, '0'),
(4, 'Gel năng lượng', 'gel-nang-luong', 0, 1, '2021-06-15 14:03:26', NULL, '0'),
(6, 'tesst', 'tesst', 0, 1, '2022-04-05 13:20:49', NULL, '0');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(8, '2021_04_20_000001_create_user_table', 1),
(9, '2021_04_20_000002_create_admin_table', 1),
(10, '2021_04_23_000001_create_category_table', 1),
(11, '2021_04_23_000003_create_product_table', 1),
(12, '2021_04_23_000004_create_order_table', 1),
(13, '2021_04_23_000005_create_order_detail_table', 1),
(15, '2022_04_10_120305_create_sizes_table', 2),
(17, '2021_05_17_000002_create_cart_table', 3);

-- --------------------------------------------------------

--
-- Table structure for table `order`
--

CREATE TABLE `order` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_money` decimal(16,2) NOT NULL,
  `status` int(11) DEFAULT 1 COMMENT '1 new, 2 success, 3: cancel by admin, 4: cancel by user',
  `ins_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `upd_date` timestamp NULL DEFAULT NULL,
  `del_flag` char(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0' COMMENT 'deleted:1, active:0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `order`
--

INSERT INTO `order` (`id`, `user_id`, `name`, `address`, `phone`, `total_money`, `status`, `ins_date`, `upd_date`, `del_flag`) VALUES
(1, 0, 'Sơn Nguyễn', 'Ha Noi', '0964047698', '598000.00', 2, '2022-02-22 13:40:21', NULL, '0'),
(2, 2, 'mot', 'HN', '0123456789', '864000.00', 4, '2022-02-22 13:41:55', NULL, '0'),
(3, 2, 'mot', 'HN', '0123456789', '539000.00', 1, '2022-02-22 13:43:45', NULL, '0'),
(4, 4, 'thanhdt', 'sadsad', '0123123123', '1163000.00', 1, '2022-04-09 09:12:11', NULL, '0'),
(9, 4, 'thanhdt', 'sadsad', '0123123123', '2027000.00', 1, '2022-04-09 09:26:16', NULL, '0'),
(10, 4, 'thanhdt', 'sadsad', '0123123123', '2027000.00', 1, '2022-04-09 09:28:22', NULL, '0'),
(15, 0, 'Đỗ Tất Thành', 'sad', '0123123123', '2027000.00', 1, '2022-04-09 09:35:17', NULL, '0'),
(16, 4, 'thanhdt', 'sadsad', '0123123123', '2027000.00', 2, '2022-04-09 09:35:55', NULL, '0'),
(17, 0, 'Đỗ Tất Thành', 'sadsad', '0123123123', '38000.00', 1, '2022-04-10 06:26:56', NULL, '0'),
(18, 0, 'Đỗ Tất Thành', 'sdasdsad', '0123123123', '883000.00', 1, '2022-04-10 06:28:33', NULL, '0'),
(19, 4, 'thanhdt', 'sadsad', '0123123123', '883000.00', 3, '2022-04-10 06:29:18', NULL, '0'),
(20, 4, 'thanhdt', 'sadsad', '0123123123', '883000.00', 1, '2022-04-10 06:53:05', NULL, '0'),
(21, 0, 'Đỗ Tất Thành', 'sad', '0123123123', '318000.00', 1, '2022-04-10 06:55:59', NULL, '0'),
(24, 0, 'Đỗ Tất Thành', 'sadsad', '0123123123', '883000.00', 1, '2022-04-10 06:57:52', NULL, '0'),
(25, 0, 'Đỗ Tất Thành', 'saddsads', '0123123123', '883000.00', 2, '2022-04-10 06:58:33', NULL, '0'),
(26, 0, 'Đỗ Tất Thành', 'sadsad', '0123123123', '652000.00', 1, '2022-04-11 12:50:55', NULL, '0'),
(27, 0, 'Đỗ Tất Thành', 'sadsad', '0123123123', '900000.00', 1, '2022-04-11 12:53:18', NULL, '0'),
(28, 4, 'thanhdt', 'sadsad', '0123123123', '900000.00', 1, '2022-04-11 12:54:25', NULL, '0'),
(29, 0, 'Đỗ Tất Thành', 'sadsa', '0123123123', '1090000.00', 1, '2022-04-11 13:05:44', NULL, '0'),
(30, 0, 'Đỗ Tất Thành', '213123123', '0123123123', '900000.00', 1, '2022-04-11 13:18:45', NULL, '0');

-- --------------------------------------------------------

--
-- Table structure for table `order_detail`
--

CREATE TABLE `order_detail` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `product_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_price_origin` decimal(16,2) NOT NULL,
  `product_price_sell` decimal(16,2) NOT NULL,
  `product_sale` int(11) DEFAULT NULL,
  `product_quantity` int(11) NOT NULL DEFAULT 1,
  `product_sort_describe` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ins_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `upd_date` timestamp NULL DEFAULT NULL,
  `del_flag` char(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0' COMMENT 'deleted:1, active:0',
  `product_avatar` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `size` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `order_detail`
--

INSERT INTO `order_detail` (`id`, `order_id`, `product_id`, `product_name`, `product_price_origin`, `product_price_sell`, `product_sale`, `product_quantity`, `product_sort_describe`, `ins_date`, `upd_date`, `del_flag`, `product_avatar`, `size`) VALUES
(1, 1, 87, 'QUẦN CHẠY BỘ LEEVVY DÁNG XẺ MS60', '299000.00', '299000.00', NULL, 1, NULL, '2022-02-22 13:40:21', NULL, '0', 'backend/uploads/product/1644676811_1.jpg', NULL),
(2, 1, 88, 'QUẦN CHẠY BỘ NAM LEEVY MS53', '299000.00', '299000.00', NULL, 1, NULL, '2022-02-22 13:40:21', NULL, '0', 'backend/uploads/product/1644676878_2.png', NULL),
(3, 2, 164, 'HỘP GEL - VỊ ĐẬU VANI', '960000.00', '864000.00', 10, 1, NULL, '2022-02-22 13:41:55', NULL, '0', 'backend/uploads/product/1644723381_Screenshot_16.png', NULL),
(4, 3, 88, 'QUẦN CHẠY BỘ NAM LEEVY MS53', '299000.00', '299000.00', NULL, 1, NULL, '2022-02-22 13:43:45', NULL, '0', 'backend/uploads/product/1644676878_2.png', NULL),
(5, 3, 89, 'ÁO BA LỖ CHẠY BỘ NAM LEEVY MS51 - SIÊU MỎNG - SIÊU NHẸ', '240000.00', '240000.00', NULL, 1, NULL, '2022-02-22 13:43:45', NULL, '0', 'backend/uploads/product/1644676900_3.jpg', NULL),
(6, 4, 164, 'HỘP GEL - VỊ ĐẬU VANI', '960000.00', '864000.00', 10, 1, NULL, '2022-04-09 09:12:11', NULL, '0', 'backend/uploads/product/1644723381_Screenshot_16.png', NULL),
(7, 4, 87, 'QUẦN CHẠY BỘ LEEVVY DÁNG XẺ MS60', '299000.00', '299000.00', NULL, 1, NULL, '2022-04-09 09:12:11', NULL, '0', 'backend/uploads/product/1644676811_1.jpg', NULL),
(8, 10, 164, 'HỘP GEL - VỊ ĐẬU VANI', '960000.00', '864000.00', 10, 2, NULL, '2022-04-09 09:28:22', NULL, '0', 'backend/uploads/product/1644723381_Screenshot_16.png', NULL),
(9, 10, 87, 'QUẦN CHẠY BỘ LEEVVY DÁNG XẺ MS60', '299000.00', '299000.00', NULL, 1, NULL, '2022-04-09 09:28:22', NULL, '0', 'backend/uploads/product/1644676811_1.jpg', NULL),
(10, 15, 164, 'HỘP GEL - VỊ ĐẬU VANI', '960000.00', '864000.00', 10, 2, NULL, '2022-04-09 09:35:17', NULL, '0', 'backend/uploads/product/1644723381_Screenshot_16.png', NULL),
(11, 15, 87, 'QUẦN CHẠY BỘ LEEVVY DÁNG XẺ MS60', '299000.00', '299000.00', NULL, 1, NULL, '2022-04-09 09:35:17', NULL, '0', 'backend/uploads/product/1644676811_1.jpg', NULL),
(12, 16, 164, 'HỘP GEL - VỊ ĐẬU VANI', '960000.00', '864000.00', 10, 1, NULL, '2022-04-09 09:35:55', NULL, '0', 'backend/uploads/product/1644723381_Screenshot_16.png', NULL),
(13, 16, 88, 'QUẦN CHẠY BỘ NAM LEEVY MS53', '299000.00', '299000.00', NULL, 1, NULL, '2022-04-09 09:35:55', NULL, '0', 'backend/uploads/product/1644676878_2.png', NULL),
(14, 17, 167, 'Đỗ Tất Thành', '20000.00', '19000.00', 5, 1, NULL, '2022-04-10 06:26:56', NULL, '0', NULL, NULL),
(15, 17, 165, 'Đỗ Tất Thành', '20000.00', '19000.00', 5, 1, NULL, '2022-04-10 06:26:56', NULL, '0', NULL, NULL),
(16, 18, 167, 'Đỗ Tất Thành', '20000.00', '19000.00', 5, 1, NULL, '2022-04-10 06:28:33', NULL, '0', NULL, 'das123'),
(17, 18, 164, 'HỘP GEL - VỊ ĐẬU VANI', '960000.00', '864000.00', 10, 1, NULL, '2022-04-10 06:28:33', NULL, '0', 'backend/uploads/product/1644723381_Screenshot_16.png', NULL),
(18, 19, 164, 'HỘP GEL - VỊ ĐẬU VANI', '960000.00', '864000.00', 10, 1, NULL, '2022-04-10 06:29:18', NULL, '0', 'backend/uploads/product/1644723381_Screenshot_16.png', NULL),
(19, 19, 167, 'Đỗ Tất Thành', '20000.00', '19000.00', 5, 1, NULL, '2022-04-10 06:29:18', NULL, '0', NULL, 'das123'),
(20, 20, 164, 'HỘP GEL - VỊ ĐẬU VANI', '960000.00', '864000.00', 10, 1, NULL, '2022-04-10 06:53:05', NULL, '0', 'backend/uploads/product/1644723381_Screenshot_16.png', NULL),
(21, 20, 167, 'Đỗ Tất Thành', '20000.00', '19000.00', 5, 1, NULL, '2022-04-10 06:53:05', NULL, '0', NULL, 'sadasd'),
(22, 21, 87, 'QUẦN CHẠY BỘ LEEVVY DÁNG XẺ MS60', '299000.00', '299000.00', NULL, 1, NULL, '2022-04-10 06:55:59', NULL, '0', 'backend/uploads/product/1644676811_1.jpg', NULL),
(23, 21, 167, 'Đỗ Tất Thành', '20000.00', '19000.00', 5, 1, NULL, '2022-04-10 06:55:59', NULL, '0', NULL, NULL),
(24, 24, 164, 'HỘP GEL - VỊ ĐẬU VANI', '960000.00', '864000.00', 10, 1, NULL, '2022-04-10 06:57:53', NULL, '0', 'backend/uploads/product/1644723381_Screenshot_16.png', NULL),
(25, 24, 167, 'Đỗ Tất Thành', '20000.00', '19000.00', 5, 1, NULL, '2022-04-10 06:57:53', NULL, '0', NULL, 'sadasd'),
(26, 25, 164, 'HỘP GEL - VỊ ĐẬU VANI', '960000.00', '864000.00', 10, 1, NULL, '2022-04-10 06:58:33', NULL, '0', 'backend/uploads/product/1644723381_Screenshot_16.png', NULL),
(27, 25, 167, 'Đỗ Tất Thành', '20000.00', '19000.00', 5, 1, NULL, '2022-04-10 06:58:33', NULL, '0', NULL, 'das123'),
(28, 26, 87, 'QUẦN CHẠY BỘ LEEVVY DÁNG XẺ MS60', '299000.00', '299000.00', NULL, 2, NULL, '2022-04-11 12:50:55', NULL, '0', 'backend/uploads/product/1644676811_1.jpg', NULL),
(29, 26, 170, 'test', '20000.00', '18000.00', 10, 3, NULL, '2022-04-11 12:50:55', NULL, '0', NULL, NULL),
(30, 27, 164, 'HỘP GEL - VỊ ĐẬU VANI', '960000.00', '864000.00', 10, 1, NULL, '2022-04-11 12:53:18', NULL, '0', 'backend/uploads/product/1644723381_Screenshot_16.png', NULL),
(31, 27, 170, 'test', '20000.00', '18000.00', 10, 2, NULL, '2022-04-11 12:53:18', NULL, '0', NULL, NULL),
(32, 28, 164, 'HỘP GEL - VỊ ĐẬU VANI', '960000.00', '864000.00', 10, 1, NULL, '2022-04-11 12:54:25', NULL, '0', 'backend/uploads/product/1644723381_Screenshot_16.png', NULL),
(33, 28, 170, 'test', '20000.00', '18000.00', 10, 2, NULL, '2022-04-11 12:54:25', NULL, '0', NULL, 'sadsad'),
(34, 29, 164, 'HỘP GEL - VỊ ĐẬU VANI', '960000.00', '864000.00', 10, 1, NULL, '2022-04-11 13:05:44', NULL, '0', 'backend/uploads/product/1644723381_Screenshot_16.png', NULL),
(35, 29, 171, 'test1', '200000.00', '190000.00', 5, 1, NULL, '2022-04-11 13:05:44', NULL, '0', NULL, NULL),
(36, 29, 170, 'test', '20000.00', '18000.00', 10, 2, NULL, '2022-04-11 13:05:44', NULL, '0', NULL, 'sadsad'),
(37, 30, 164, 'HỘP GEL - VỊ ĐẬU VANI', '960000.00', '864000.00', 10, 1, NULL, '2022-04-11 13:18:45', NULL, '0', 'backend/uploads/product/1644723381_Screenshot_16.png', NULL),
(38, 30, 170, 'test', '20000.00', '18000.00', 10, 2, NULL, '2022-04-11 13:18:45', NULL, '0', NULL, 'sadsad');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category_id` int(11) DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price_origin` decimal(16,2) DEFAULT NULL,
  `price_sell` decimal(16,2) DEFAULT NULL,
  `sale` int(11) DEFAULT 0,
  `avatar` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `hot` int(11) DEFAULT 0,
  `sort_describe` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ins_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `upd_date` timestamp NULL DEFAULT NULL,
  `del_flag` char(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0' COMMENT 'deleted:1, active:0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `category_id`, `name`, `price_origin`, `price_sell`, `sale`, `avatar`, `hot`, `sort_describe`, `ins_date`, `upd_date`, `del_flag`) VALUES
(87, 1, 'QUẦN CHẠY BỘ LEEVVY DÁNG XẺ MS60', '299000.00', '299000.00', NULL, 'backend/uploads/product/1644676811_1.jpg', 0, '- Chất liệu vải thể thao, thoáng khí không gây cọ xát khi luyện tập\r\n\r\n- Thiết kế dáng xẻ tăng khả năng lưu thông không khí, giữ cơ thể khô ráo\r\n\r\n- Túi ngang phía sau giúp bạn có thể bỏ 1 số vật dụng thiết yếu như chìa khóa, gel,..\r\n\r\n- Dải phản quang được thi', '2022-02-12 14:38:19', NULL, '0'),
(88, 1, 'QUẦN CHẠY BỘ NAM LEEVY MS53', '299000.00', '299000.00', NULL, 'backend/uploads/product/1644676878_2.png', 0, 'Được làm từ vải polyester, là chất liệu chuyên dụng cho đồ thể thao, mang đến cho bạn cảm giác thoải thoải mái trong khi hoạt động, Tin rằng nó sẽ giúp bạn vượt qua những buổi luyện tập bùng nổ trong mùa hè bỏng cháy này. Còn chờ gì nữa, cùng xỏ giày và', '2022-02-12 14:41:18', NULL, '0'),
(89, 1, 'ÁO BA LỖ CHẠY BỘ NAM LEEVY MS51 - SIÊU MỎNG - SIÊU NHẸ', '240000.00', '240000.00', NULL, 'backend/uploads/product/1644676900_3.jpg', 0, 'Mặc như không mặc, là điều bạn phải thốt lên khi sở hữu nó. Bạn tin tôi chứ. Cái cảm giác khi mặc quần áo ở nhà và cái cảm giác mang lên mình áo ba lỗ Leevy khi chạy bộ quả là hai trải nghiệm khác nhau. Bạn có muốn một chiếc áo siêu siêu nhẹ, khả năng th', '2022-02-12 14:41:40', NULL, '0'),
(90, 1, 'ÁO BA LỖ CHẠY BỘ LEEVY PHẢN QUANG MS87', '279000.00', '279000.00', NULL, 'backend/uploads/product/1644676925_4.jpg', 0, 'Mùa hè này mặc mấy kiểu áo ba lỗ siêu mát nhẹ thì cứ HM, FM hàng ngày được luôn ạ. Áo phối lưới giúp thoát mồ hôi nhanh chóng, tạo cảm giác dễ chịu cả khi chạy đường dài, kiểu áo ba lỗ giúp thoải mái khi vận động, có phản quang ở logo trước ngực, 2 bên s', '2022-02-12 14:42:05', NULL, '0'),
(91, 1, 'ÁO CHẠY BỘ NAM LEEVY RUNNING MS88', '270000.00', '270000.00', NULL, 'backend/uploads/product/1644677322_5.png', 0, '1 Áo siêu mỏng, siêu nhẹ giúp thoải mái khi hoạt động\r\n2 Logo áo: được thiết kế bằng chất liệu phản quang, an toàn hơn khi chạy vào ban đêm\r\n3 Chất vải polyester: đàn hồi, bền bỉ\r\n4 Vải có chức năng hút ẩm, thoáng khí, hút và thoát mồ hôi tốt', '2022-02-12 14:48:42', NULL, '0'),
(92, 1, 'ÁO THUN THỂ THAO LEEVY MS90', '300000.00', '297000.00', 1, 'backend/uploads/product/1644677360_6.png', 0, 'Áo siêu mỏng, siêu nhẹ giúp thoải mái khi hoạt động\r\nLogo áo: được thiết kế bằng chất liệu phản quang, an toàn hơn khi chạy vào ban đêm\r\nChất vải polyester: đàn hồi, bền bỉ\r\nVải có chức năng hút ẩm, thoáng khí, hút và thoát mồ hôi tốt\r\nChất vải dạng lưới, tă', '2022-02-12 14:49:20', NULL, '0'),
(93, 1, 'QUẦN CHẠY BỘ I LOVE RUNNING LỚN MS96 19001', '420000.00', '378000.00', 10, 'backend/uploads/product/1644677386_7.png', 0, 'Nghe cái tên thôi cũng muốn xỏ giày ra chạy rồi. Bạn đã nghe tới quần I Love Running rồi chứ? Không chỉ độc lạ về cái tên thôi đâu. Nó còn khiến cho các chân chạy vì sự tiện lợi đến mức bá đạo. Một thế giới thu nhỏ nằm trong đai lưng của quần. Bỏ hết vào', '2022-02-12 14:49:46', NULL, '0'),
(94, 1, 'QUẦN CHẠY BỘ NAM ARSUXEO MS04 - 2 LỚP (BOXER) - THIẾT KẾ 4 TÚI ĐA NĂNG', '299000.00', '284050.00', 5, 'backend/uploads/product/1644677411_8.png', 0, 'Đây là sản phẩm mới và bán chạy nhất của Arsuxeo tại thời điểm hiện tại, nhà sản xuất đã thêm 4% Spandex thay vì 8% thì giờ thành 12%, tạo độ mềm mại và mịn màng, bền hơn cho người sử dụng.', '2022-02-12 14:50:11', NULL, '0'),
(95, 1, 'QUẦN CHẠY BỘ NAM ARSUXEO MS01 - 2 LỚP (BOXER) - TÚI KHÓA KÉO SAU LƯNG', '500000.00', '250000.00', 50, 'backend/uploads/product/1644677531_9.png', 0, 'Chiếc quần short Asuseo giúp bạn luôn khô ráo và sẵn sàng trước mọi thử thách. Chất vải dệt cho cảm giác nhẹ nhàng và dễ chịu. Lớp lót trong tăng cường độ che chắn mà vẫn thoáng khí và nâng đỡ tốt.', '2022-02-12 14:52:11', NULL, '0'),
(96, 1, 'QUẦN CHẠY BỘ NAM ARSUXEO MS02 - 2 LỚP (BOXER) - TÚI SAU LƯNG ĐA NĂNG', '500000.00', '275000.00', 45, 'backend/uploads/product/1644677553_10.png', 0, 'Chất lượng vải cao: Với chất liệu Nylon Spandex, Mồ hôi thấm vào những lỗ nhỏ trên bề mặt giúp thấm và kiểm soát mồ hôi, độ thoáng khi tốt hơn. \r\n+ Cùng với đó là khả năng thấm hút mồ hôi nhanh, kháng khuẩn,loại bỏ mùi hôi hiệu quả giúp cơ thể luôn khô th', '2022-02-12 14:52:33', NULL, '0'),
(97, 1, 'QUẦN CHẠY BỘ NAM ARSUXEO MS03 - 2 LỚP (BOXER) - THIẾT KẾ 2 TÚI ĐA NĂNG', '500000.00', '345000.00', 31, 'backend/uploads/product/1644677579_11.png', 0, 'Chất liệu vải: Nylon Spandex (Polyester: 92%, Spandex : 8%)', '2022-02-12 14:52:59', NULL, '0'),
(98, 1, 'ÁO BA LỖ THỂ THAO NAM LULULEMON MS08 - SIÊU NHẸ - THOÁNG KHÍ', '250000.00', '250000.00', NULL, 'backend/uploads/product/1644677600_12.png', 0, 'Chất liệu: Vải thun co giãn 4 chiều. \r\n\r\n- Tốc độ thấm hút mồ hôi rất nhanh. Mồ hôi khi toát ra sẽ thấm đều ra bền mặt vải để thoát khí được nhanh từ đó làm khô nhanh hơn.', '2022-02-12 14:53:20', NULL, '0'),
(99, 1, 'ÁO GIỮ NHIỆT THỂ THAO NAM ARSUXEO MS05 - CO DÃN - THOÁNG KHÍ', '600000.00', '390000.00', 35, 'backend/uploads/product/1644677708_13.png', 0, 'Chất liệu: Poly + Spandex - Chất liệu phổ biến với trang phục thể thao cho áo được bền hơn, nhanh khô hơn và thoáng hơn. \r\n\r\nÁo thích hợp với nhiều môn thể thao như Đạp xe, leo núi, chạy bộ...', '2022-02-12 14:55:08', NULL, '0'),
(100, 1, 'ÁO CHẠY BỘ NAM LEEGO MS33 - ÁO THỂ THAO SIÊU NHẸ, THOÁNG KHÍ', '189000.00', '189000.00', NULL, 'backend/uploads/product/1644677730_14.png', 0, 'Chất liệu vải Polyester + spandex co giãn tốt và nhẹ.\r\n\r\nThiết kế chia ô nhỏ và có các lỗ nhỏ làm cho việc thoát mồ hôi nhanh hơn bao giờ hết.\r\n\r\nĐặc điểm của những chiếc áo chạy bộ là siêu mềm mại\r\n\r\nCố áo tròn giúp người tập thoải mái hơn', '2022-02-12 14:55:30', NULL, '0'),
(101, 1, 'QUẦN TẬP GYM NAM LEEGO MS42 - 2 LỚP BOXER - NHẸ VÀ THOÁNG KHÍ', '280000.00', '168000.00', 40, 'backend/uploads/product/1644677755_15.png', 0, 'Mẫu quần gym nam Leego sẵn sàng đồng hành cùng bạn. Mang đến cảm giác thoải mái nhờ chất liệu thể thao, lớp boxer phía trong giúp tăng hiệu suất buổi tập tối đa. Để mỗi lần đén với gym là một lần bạn bung hết chất mình, thỏa chí đam mê', '2022-02-12 14:55:55', NULL, '0'),
(102, 1, 'QUẦN CHẠY BỘ NAM LEEGO MS43 - QUẦN 2 LỚP MÙA HÈ NHẸ, THOÁNG KHÍ', '300000.00', '210000.00', 30, 'backend/uploads/product/1644677777_16.png', 0, 'Chất liệu vải thể thao: co giãn 4 chiều, để bạn thoải mái vận động.\r\nLớp bó phía trong: giúp ổn định các khối cơ, mang lại hiệu quả bài tập cao hơn. Đồng thời, thấm hút và thoát mồ hôi nhanh chóng.', '2022-02-12 14:56:17', NULL, '0'),
(103, 1, 'ÁO BA LỖ CHẠY BỘ NAM SẮC MÀU LEGO MS143', '309000.00', '309000.00', NULL, 'backend/uploads/product/1644677966_17.png', 0, 'Áo mềm mại, thoải mái và không bị bai dão - Áo không dễ bị phai màu - Tốc độ thấm hút mồ hôi nhanh - Viền áo ép nhiệt giảm cọ sát', '2022-02-12 14:59:26', NULL, '0'),
(104, 2, 'QUẦN CHẠY BỘ NỮ LEEVY MS82', '299000.00', '299000.00', NULL, 'backend/uploads/product/1644680008_Screenshot_1.png', 0, NULL, '2022-02-12 15:33:28', NULL, '0'),
(105, 2, 'QUẦN LEEVY NỮ MS94', '299000.00', '299000.00', NULL, 'backend/uploads/product/1644680028_Screenshot_2.png', 0, NULL, '2022-02-12 15:33:48', NULL, '0'),
(106, 2, 'BỘ THỂ THAO NỮ MS93', '350000.00', '350000.00', NULL, 'backend/uploads/product/1644680042_Screenshot_3.png', 0, NULL, '2022-02-12 15:34:02', NULL, '0'),
(107, 2, 'BỘ THỂ THAO BA LỖ NỮ MS92', '499000.00', '499000.00', NULL, 'backend/uploads/product/1644680059_Screenshot_4.png', 0, NULL, '2022-02-12 15:34:19', NULL, '0'),
(108, 2, 'ÁO BA LỖ THỂ THAO NỮ MS91', '299000.00', '299000.00', NULL, 'backend/uploads/product/1644680125_Screenshot_5.png', 0, 'Áo siêu mỏng, siêu nhẹ giúp thoải mái khi hoạt động, có hai kẻ vạch phản quang hai bên\r\nLogo áo: được thiết kế bằng chất liệu phản quang, an toàn hơn khi chạy vào ban đêm\r\nChất vải polyester: đàn hồi, bền bỉ\r\nVải có chức năng hút ẩm, thoáng khí, hút và thoá', '2022-02-12 15:35:25', NULL, '0'),
(109, 2, 'QUẦN CHẠY BỘ NỮ LULULEMON MS20 - 2 LỚP - CÓ VIỀN PHẢN QUANG', '600000.00', '300000.00', 50, 'backend/uploads/product/1644680144_Screenshot_6.png', 0, NULL, '2022-02-12 15:35:44', NULL, '0'),
(110, 2, 'QUẦN CHẠY BỘ NỮ LULULEMON MS22 - 2 LỚP - CÓ TÚI ĐỰNG ĐIỆN THOẠI', '500000.00', '395000.00', 21, 'backend/uploads/product/1644680164_Screenshot_7.png', 0, NULL, '2022-02-12 15:36:04', NULL, '0'),
(111, 2, 'QUẦN CHẠY BỘ NỮ LULULEMON MS21 - 2 LỚP - CÓ LỖ SIÊU THOÁNG KHÍ', '500000.00', '395000.00', 21, 'backend/uploads/product/1644680189_Screenshot_8.png', 0, 'Sử dụng vải chất lượng cao kết hợp thiết kế lỗ tạo phong cách thời trang khỏe khoắn kết hợp với hệ thống làm mát giúp chống bí khi tập luyện và thoát mồ hôi trên bề mặt và đẩy nhanh quá trình bay hơi, ngoài ra còn giúp làm mát cực nhanh.', '2022-02-12 15:36:29', NULL, '0'),
(112, 2, 'BỘ SET 3 SẢN PHẨM LULULEMON MS09 (ÁO CỘC TAY - QUẦN NGẮN - ÁO BRA)', '700000.00', '490000.00', 30, 'backend/uploads/product/1644680281_Screenshot_9.png', 0, 'Chất liệu: Nylon Spandex có độ bền, co giãn và chịu mài mòn tốt.\r\n\r\nBên cạnh đó chất vải thoáng mát không bí, mang đến sự khỏe khoắn và thoải mái cùng với khả năng thấm hút mồ hôi, khô nhanh chóng, chấm dứt cảm giác nóng bức khi tập luyện c', '2022-02-12 15:38:01', NULL, '0'),
(113, 2, 'QUẦN I LOVE RUNNING NỮ MS95', '420000.00', '420000.00', NULL, 'backend/uploads/product/1644680302_Screenshot_10.png', 0, 'Nghe cái tên thôi cũng muốn xỏ giày ra chạy rồi. Bạn đã nghe tới quần I Love Running rồi chứ? Không chỉ độc lạ về cái tên thôi đâu. Nó còn khiến cho các chân chạy vì sự tiện lợi đến mức bá đạo. Một thế giới thu nhỏ nằm trong đai lưng của quần. Bỏ hết vào', '2022-02-12 15:38:22', NULL, '0'),
(114, 2, 'BỘ SET 3 SẢN PHẨM LULULEMON MS10 (ÁO DÀI TAY - QUẦN LEGGING - ÁO BRA)', '1200000.00', '840000.00', 30, 'backend/uploads/product/1644680322_Screenshot_11.png', 0, 'Chất liệu vải: Nylon Spandex mang lại độ bền cao, khả năng co dãn cực tốt theo chuyển động cơ thể và rất ít nhăn ngay cả khi bạn vận động cường độ cao.\r\n\r\nBộ set 3 bao gồm: Áo Bra, quần dài, và áo dài tay.', '2022-02-12 15:38:42', NULL, '0'),
(115, 2, 'ÁO DÁNG BÓ DÀI TAY LULULEMON MS13 - THIẾT KẾ SIÊU SEXY', '600000.00', '450000.00', 25, 'backend/uploads/product/1644680344_Screenshot_12.png', 0, 'Độ đàn hồi cao, thoáng khí và nhanh khô. được pha trộn giữa Polyester và Spandex. Ưu điểm của loại vải này là khả năng co giãn tốt, tính thẩm mỹ cao, thoáng khí tuyệt vời.', '2022-02-12 15:39:04', NULL, '0'),
(116, 2, 'ÁO DÁNG BÓ DÀI TAY LULULEMON MS12 - MỀM MẠI - SEXY', '600000.00', '480000.00', 20, 'backend/uploads/product/1644680501_Screenshot_1.png', 0, 'Một sản phẩm nhất định cần có trong tủ đồ thể thao của phái đẹp vào mùa đông. Đặc biệt không thể thiếu khi tập luyện ngoài trời. Thiết kế tinh tế và trẻ trung cùng với chất liệu vải cao cấp mang lại sự thoải mái và tự tin nhất cho người mặc trong tập luy', '2022-02-12 15:41:41', NULL, '0'),
(117, 2, 'ÁO BRA THỂ THAO LULULEMON MS11 - 2 DÂY - SIÊU SEXY', '500000.00', '-199500000.00', 40000, 'backend/uploads/product/1644680530_Screenshot_2.png', 0, 'Sợi vải Polyester (85%) và hỗn hợp bông. Chất liệu vải cao cấp mang đến sự thoải mái khi vận động. Sợi vải mềm mại, đàn hồi cực tốt và rất thoáng khí.', '2022-02-12 15:42:10', NULL, '0'),
(118, 2, 'ÁO BRA THỂ THAO LULULEMON MS19 - MÀU LOANG KHÓI', '500000.00', '-199500000.00', 40000, 'backend/uploads/product/1644680558_Screenshot_3.png', 0, 'Chất vải mềm mại, thoải mái cùng với khả năng thấm hút mồ hôi tuyệt vời. Khả năng chống nhăn hiệu quả trong suốt quá trình tập luyện', '2022-02-12 15:42:38', NULL, '0'),
(119, 2, 'QUẦN LEGGING NỮ LULULEMON MS25 - CO DÃN 4 CHIỀU - MÀU LOANG KHÓI', '600000.00', '480000.00', 20, 'backend/uploads/product/1644680587_Screenshot_4.png', 0, 'Giúp co giãn 360 độ vận động cực thoải mái. Chất vải mềm mại, thoải mái cùng với khả năng thấm hút mồ hôi tuyệt vời. Khả năng chống nhăn hiệu quả trong suốt quá trình tập luyện.', '2022-02-12 15:43:07', NULL, '0'),
(120, 2, 'ÁO BRA THỂ THAO LULULEMON MS18 - MÀU LOANG', '500000.00', '360000.00', 28, 'backend/uploads/product/1644680608_Screenshot_5.png', 0, 'Chất liệu vải: 75% nyon 25% spandex. Chất liệu cao cấp đàn hồi tốt, thoát khí thông thoáng.\r\n\r\nHệ thống làm mát, độ co giãn và độ bám quanh ngực tốt, chắc chắn. Có tính thẩm mỹ cao và bắt mắt.', '2022-02-12 15:43:28', NULL, '0'),
(121, 2, 'QUẦN LEGGING NỮ LULULEMON MS24 - CO DÃN 4 CHIỀU - MÀU LOANG', '600000.00', '300000.00', 50, 'backend/uploads/product/1644680632_Screenshot_6.png', 0, 'Thành phần vải: 75% Lynon, 25% sợi Spandex\r\n\r\nSự kết hợp hoàn hảo giữ 2 chất liệu vải giúp sản phẩm bền hơn, có khả năng chống chầy xước, chống mài mòn vượt trội. Khả năng co dãn tốt cho sự vận động thoải mái với bất kì môn thể thao nào.', '2022-02-12 15:43:52', NULL, '0'),
(122, 2, 'ÁO BRA THỂ THAO LULULEMON MS17 - THIẾT KẾ LƯNG CÁCH ĐIỆU', '600000.00', '450000.00', 25, 'backend/uploads/product/1644680657_Screenshot_7.png', 0, 'Áo có độ nâng đỡ tối đa với cúp ngực đúc mềm mại thoải mái và độ ôm điều chỉnh được.\r\n\r\nThành phần: 73% nylon và 27% spandex vải mềm, dày dặn và đàn hồi rất tốt', '2022-02-12 15:44:17', NULL, '0'),
(123, 2, 'QUẦN LEGGING NỮ LULULEMON MS23 - CO DÃN 4 CHIỀU - THIẾT KẾ ĐỘC ĐÁO', '600000.00', '330000.00', 45, 'backend/uploads/product/1644680680_Screenshot_8.png', 0, 'Chất liệu vải: 73% nylon – 27% spandex: Co dãn rất tốt ôm trọn cơ thể và rất thoáng khí.\r\n\r\nThiết kế phần hông Sexy, với đường xẻ hình quả đào có tác dụng nâng hông giúp phần hông thêm tròn và sành điệu', '2022-02-12 15:44:40', NULL, '0'),
(124, 2, 'ÁO THUN THỂ THAO NỮ LULULEMON MS15 - THIẾT KẾ LƯNG CÁCH ĐIỆU - SEXY', '600000.00', '300000.00', 50, 'backend/uploads/product/1644680697_Screenshot_9.png', 0, NULL, '2022-02-12 15:44:57', NULL, '0'),
(125, 2, 'ÁO THUN THỂ THAO NỮ LULULEMON MS14 - SIÊU THOÁNG', '500000.00', '375000.00', 25, 'backend/uploads/product/1644680721_Screenshot_10.png', 0, 'Chất liệu: 85% Vải poly spandex, 25% vải nylon đây là loại vải được kết hợp từ vải spandex và sợi poly nó còn có tên gọi khác là nylon spandex. Vải có độ bề mặt trơn bóng đẹp, vải mềm mại thích hợp với chất liệu quần áo thể thao.', '2022-02-12 15:45:21', NULL, '0'),
(126, 2, 'ÁO TANK TOP CHẠY BỘ NỮ MS97', '220000.00', '220000.00', NULL, 'backend/uploads/product/1644680739_Screenshot_11.png', 0, NULL, '2022-02-12 15:45:39', NULL, '0'),
(127, 2, 'ÁO BA LỖ CHẠY BỘ XẺ LƯNG MS100', '249000.00', '249000.00', NULL, 'backend/uploads/product/1644680754_Screenshot_12.png', 0, NULL, '2022-02-12 15:45:54', NULL, '0'),
(128, 2, 'BỘ SET THỂ THAO NỮ LULULEMON MS120 ( QUẦN - ÁO ) KHÔNG CÓ ÁO BRA', '350000.00', '350000.00', NULL, 'backend/uploads/product/1644680851_Screenshot_13.png', 0, 'Chất liệu: Nylon Spandex có độ bền, co giãn và chịu mài mòn tốt.\r\n\r\nBên cạnh đó chất vải thoáng mát không bí, mang đến sự khỏe khoắn và thoải mái cùng với khả năng thấm hút mồ hôi, khô nhanh chóng, chấm dứt cảm giác nóng bức khi tập luyện c', '2022-02-12 15:47:31', NULL, '0'),
(129, 2, 'QUẦN THỂ THAO CHẠY BỘ NỮ MS117', '250000.00', '250000.00', NULL, 'backend/uploads/product/1644680871_Screenshot_14.png', 0, 'Quần có 2 lớp, một lớp tam giác trong \r\nChất vải polyester: đàn hồi, bền bỉ\r\nVải có chức năng hút ẩm, thoáng khí, hút và thoát mồ hôi tốt\r\nMàu sắc đơn giản,tươi mới tạo sức sống khỏe khoắn', '2022-02-12 15:47:51', NULL, '0'),
(130, 2, 'ÁO THỂ THAO CHẠY BỘ NỮ MS118', '360000.00', '270000.00', 25, 'backend/uploads/product/1644680889_Screenshot_15.png', 0, 'Áo siêu mỏng, siêu nhẹ giúp thoải mái khi hoạt động,đằng sau là lưới giúp thoáng hơn khi chạy bộ\r\nLogo áo: được thiết kế bằng chất liệu phản quang, an toàn hơn khi chạy vào ban đêm\r\nChất vải polyester: đàn hồi, bền bỉ\r\nVải có chức năng hút ẩm, thoáng khí, h', '2022-02-12 15:48:09', NULL, '0'),
(131, 2, 'ÁO CHẠY BỘ LEEGO NỮ MS142', '169000.00', '169000.00', NULL, 'backend/uploads/product/1644680905_Screenshot_16.png', 0, 'Vải có chức năng hút ẩm, thoáng khí, hút và thoát mồ hôi tốt\r\n\r\nChất vải dạng lưới, tăng cường khả năng lưu thông không khí khi hoạt động mạnh, giúp điều hòa nhiệt độ cơ thể', '2022-02-12 15:48:25', NULL, '0'),
(132, 3, 'ĐAI CHẠY BỘ MALEROADS MS32', '200000.00', '150000.00', 25, 'backend/uploads/product/1644681108_Screenshot_1.png', 0, NULL, '2022-02-12 15:51:48', NULL, '0'),
(133, 3, 'Đai chạy bộ có bình nước AONIJIE MS99', '230000.00', '230000.00', NULL, 'backend/uploads/product/1644681126_Screenshot_2.png', 0, NULL, '2022-02-12 15:52:06', NULL, '0'),
(134, 3, 'KHĂN ĐA NĂNG MS70', '70000.00', '70000.00', NULL, 'backend/uploads/product/1644681140_Screenshot_3.png', 0, 'Nhỏ mà có võ\r\n\r\nTưởng chỉ có trong phim, mà ngoài đời có thật. Khăn đa năng, nhỏ gọn mà có quá trời công dụng: chắn bụi, thấm mồ hôi, khắn chống nắng,...', '2022-02-12 15:52:20', NULL, '0'),
(135, 3, 'ỐNG TAY CHỐNG NẮNG GIVI MS58', '450000.00', '450000.00', NULL, 'backend/uploads/product/1644681163_Screenshot_4.png', 0, NULL, '2022-02-12 15:52:43', NULL, '0'),
(136, 3, 'ỐNG TAY CHỐNG NẮNG ARSUXEO MS47', '290000.00', '87000.00', 70, 'backend/uploads/product/1644681253_Screenshot_5.png', 0, NULL, '2022-02-12 15:54:13', NULL, '0'),
(137, 3, 'BĂNG CHẶN MỒ MÔI NỮ MS46', '240000.00', '168000.00', 30, 'backend/uploads/product/1644681269_Screenshot_6.png', 0, NULL, '2022-02-12 15:54:29', NULL, '0'),
(138, 3, 'KHĂN ĐA NĂNG ARSUXEO MS41', '169000.00', '135200.00', 20, 'backend/uploads/product/1644681289_Screenshot_7.png', 0, 'Khăn đa năng Arxuseo giúp bạn có buổi chạy tốt hơn trong thời tiết nắng nóng thế này. Bạn có thể dùng nó thấm mồ hôi, thậm chí ngăn cản tia UV làm hại da.', '2022-02-12 15:54:49', NULL, '0'),
(139, 3, 'MŨ MALEROADS CHẠY BỘ DÀNH CHO NỮ MS38', '260000.00', '221000.00', 15, 'backend/uploads/product/1644681310_Screenshot_8.png', 0, NULL, '2022-02-12 15:55:10', NULL, '0'),
(140, 3, 'ĐAI BÓ TAY CHẠY BỘ ZQK MS37', '250000.00', '187500.00', 25, 'backend/uploads/product/1644681327_Screenshot_9.png', 0, NULL, '2022-02-12 15:55:27', NULL, '0'),
(141, 3, 'ĐAI BÓ TAY CHẠY BỘ MALEROADS MS36', '250000.00', '75000.00', 70, 'backend/uploads/product/1644681346_Screenshot_10.png', 0, NULL, '2022-02-12 15:55:46', NULL, '0'),
(142, 3, 'TẤT THỂ THAO MEIKAN MS31', '149000.00', '149000.00', NULL, 'backend/uploads/product/1644681363_Screenshot_11.png', 0, NULL, '2022-02-12 15:56:03', NULL, '0'),
(143, 3, 'TẤT THỂ THAO XỎ NGÓN CHỐNG TRƯỢT MEIKAN MS30', '400000.00', '160000.00', 60, 'backend/uploads/product/1644681378_Screenshot_12.png', 0, NULL, '2022-02-12 15:56:18', NULL, '0'),
(144, 3, 'DỤNG CỤ TẬP BỤNG ĐA NĂNG CHỮ T MS107', '100000.00', '100000.00', NULL, 'backend/uploads/product/1644681443_Screenshot_13.png', 0, 'Chất liệu: thép cao cấp, siêu bền, chịu lực tốt, phù hợp nhiều đối tượng.\r\n- Thiết kế nhỏ gọn giúp bạn chủ động luyện tập mọi lúc, mọi nơi. \r\n- Công dụng: Dụng cụ hỗ trợ cho các bài tập mông eo bụng, Mang lại vóc dáng chuẩn, tác động tích cực lên phần vai,', '2022-02-12 15:57:23', NULL, '0'),
(145, 3, 'ỐNG LĂN MASSAGE FOARM ROLLER MS106', '199000.00', '159200.00', 20, 'backend/uploads/product/1644681467_Screenshot_14.png', 0, 'Ống Lăn Massage là 1 ống hình trụ dùng để massgae cơ bắp trước và sau tập, giúp máu lưu thông tốt hơn, cải thiện khả năng hồi phục cơ bắp', '2022-02-12 15:57:47', NULL, '0'),
(146, 3, 'DÂY KHÁNG LỰC POWERBAND PROCESS MS103     Đánh giá sản phẩm', '39000.00', '39000.00', NULL, 'backend/uploads/product/1644681486_Screenshot_15.png', 0, 'Bạn không nhất thiết phải đến phòng gym đâu. Bạn có thể tập được ở nhà với dây miniband. Thích hợp để tác động vào hầu hết các nhóm cơ trên cơ thể. Thì nó là một trợ thủ đắc lực trong tập luyện.', '2022-02-12 15:58:06', NULL, '0'),
(147, 3, 'DÂY KHÁNG LỰC MINBAND REDCORE MS102', '12000.00', '12000.00', NULL, 'backend/uploads/product/1644681509_Screenshot_16.png', 0, 'Bạn không nhất thiết phải đến phòng gym đâu. Bạn có thể tập được ở nhà với dây miniband. Thích hợp để tác động vào hầu hết các nhóm cơ trên cơ thể. Thì nó là một trợ thủ đắc lực trong tập luyện.', '2022-02-12 15:58:29', NULL, '0'),
(148, 3, 'DÂY KHÁNG LỰC VẢI AOLIKES MS101', '69000.00', '69000.00', NULL, 'backend/uploads/product/1644681531_Screenshot_17.png', 0, 'Bạn không nhất thiết phải đến phòng gym đâu. Bạn có thể tập được ở nhà với dây miniband. Thích hợp để tác động vào hầu hết các nhóm cơ trên cơ thể. Thì nó là một trợ thủ đắc lực trong tập luyện.', '2022-02-12 15:58:51', NULL, '0'),
(149, 4, 'Gói 4 Viên Điện Giải - Roctane Electrolyte', '40000.00', '35200.00', 12, 'backend/uploads/product/1644722910_Screenshot_1.png', 0, 'Viên điện giải GU Roctane giúp bổ sung và thay thế những gì bạn mất khi đổ mồ hôi, giữ cho bạn cảm thấy mạnh mẽ và tốt hơn. Mỗi viên nang cung cấp các chất điện giải (Natri, Magiê, Clorua) hỗ trợ quá trình hydrat hóa bằng cách duy trì sự cân bằng nước và', '2022-02-13 03:28:30', NULL, '0'),
(150, 4, 'TÚI GEL COLA ME HAPPY - Vị Coca', '45000.00', '40500.00', 10, 'backend/uploads/product/1644722932_Screenshot_2.png', 0, 'Gel năng lượng GU được chế tạo để cung cấp cả năng lượng và các chất dinh dưỡng chính như điện giải và axit amin để giữ cho bạn cảm thấy mạnh mẽ và tràn đầy năng lượng.', '2022-02-13 03:28:52', NULL, '0'),
(151, 4, 'TÚI GEL CAMPFIRE SMORES - Vị Bánh kẹp Sô Cô La', '45000.00', '40500.00', 10, 'backend/uploads/product/1644722955_Screenshot_3.png', 0, 'Gel năng lượng GU được chế tạo để cung cấp cả năng lượng và các chất dinh dưỡng chính như điện giải và axit amin để giữ cho bạn cảm thấy mạnh mẽ và tràn đầy năng lượng.', '2022-02-13 03:29:15', NULL, '0'),
(152, 4, 'TÚI GEL STRAWBERRY BANANA - Vị Dâu Chuối', '45000.00', '40500.00', 10, 'backend/uploads/product/1644723017_Screenshot_4.png', 0, 'Gel năng lượng GU được chế tạo để cung cấp cả năng lượng và các chất dinh dưỡng chính như điện giải và axit amin để giữ cho bạn cảm thấy mạnh mẽ và tràn đầy năng lượng.', '2022-02-13 03:30:17', NULL, '0'),
(153, 4, 'TÚI GEL LEMON SUBLIME - Vị Chanh', '50000.00', '45000.00', 10, 'backend/uploads/product/1644723112_Screenshot_5.png', 0, 'Gel năng lượng GU được chế tạo để cung cấp cả năng lượng và các chất dinh dưỡng chính như điện giải và axit amin để giữ cho bạn cảm thấy mạnh mẽ và tràn đầy năng lượng.', '2022-02-13 03:31:52', NULL, '0'),
(154, 4, 'TÚI GEL ESPRESSO LOVE - Vị Cà Phê Espresso', '50000.00', '45000.00', 10, 'backend/uploads/product/1644723131_Screenshot_6.png', 0, NULL, '2022-02-13 03:32:11', NULL, '0'),
(155, 4, 'TÚI GEL TRI BERRY - Vị Dâu tổng hợp', '50000.00', '45000.00', 10, 'backend/uploads/product/1644723152_Screenshot_7.png', 0, NULL, '2022-02-13 03:32:32', NULL, '0'),
(156, 4, 'TÚI GEL CHOCOLATE OUTRAGE - Vị Sô cô la nguyên chất', '50000.00', '45000.00', 10, 'backend/uploads/product/1644723172_Screenshot_8.png', 0, 'Gel năng lượng GU được chế tạo để cung cấp cả năng lượng và các chất dinh dưỡng chính như điện giải và axit amin để giữ cho bạn cảm thấy mạnh mẽ và tràn đầy năng lượng.', '2022-02-13 03:32:52', NULL, '0'),
(157, 4, 'TÚI GEL MANDARIN ORANGE - Vị Cam Quýt', '50000.00', '40000.00', 20, 'backend/uploads/product/1644723193_Screenshot_9.png', 0, 'Gel năng lượng GU được chế tạo để cung cấp cả năng lượng và các chất dinh dưỡng chính như điện giải và axit amin để giữ cho bạn cảm thấy mạnh mẽ và tràn đầy năng lượng.', '2022-02-13 03:33:13', NULL, '0'),
(158, 4, 'TÚI GEL SALTED CARAMEL -Vị Mạch Nha Mặn', '50000.00', '40000.00', 20, 'backend/uploads/product/1644723211_Screenshot_10.png', 0, 'Gel năng lượng GU được chế tạo để cung cấp cả năng lượng và các chất dinh dưỡng chính như điện giải và axit amin để giữ cho bạn cảm thấy mạnh mẽ và tràn đầy năng lượng.', '2022-02-13 03:33:31', NULL, '0'),
(159, 4, 'GEL HAMMER MS50', '50000.00', '44000.00', 12, 'backend/uploads/product/1644723228_Screenshot_11.png', 0, 'Những buổi chạy dài hay chạy giải, thì cơ thể khó mà đáp ứng nhu cầu năng lượng mà cơ thể cần. Và bạn sẽ bị cạn kiệt năng lượng trước khi kết thúc cuộc đua. Những gói gel năng lượng có thể giải quyết điều đó giúp bạn. Hãy lên kế hoạch dùng gel sao cho th', '2022-02-13 03:33:48', NULL, '0'),
(160, 4, 'HỘP ĐIỆN GIẢI GU ROCTANE 50 VIÊN', '400000.00', '352000.00', 12, 'backend/uploads/product/1644723249_Screenshot_12.png', 0, 'Viên điện giải GU Roctane giúp bổ sung và thay thế những gì bạn mất khi đổ mồ hôi, giữ cho bạn cảm thấy mạnh mẽ và tốt hơn. Mỗi viên nang cung cấp các chất điện giải (Natri, Magiê, Clorua) hỗ trợ quá trình hydrat hóa bằng cách duy trì sự cân bằng nước và', '2022-02-13 03:34:09', NULL, '0'),
(161, 4, 'HỘP GEL - VỊ SÔ CÔ LA NGUYÊN CHẤT', '960000.00', '864000.00', 10, 'backend/uploads/product/1644723316_Screenshot_13.png', 0, 'Gel năng lượng GU được chế tạo để cung cấp cả năng lượng và các chất dinh dưỡng chính như điện giải và axit amin để giữ cho bạn cảm thấy mạnh mẽ và tràn đầy năng lượng.', '2022-02-13 03:35:16', NULL, '0'),
(162, 4, 'HỘP GEL - VỊ MẠCH NHA MẶN', '960000.00', '864000.00', 10, 'backend/uploads/product/1644723343_Screenshot_14.png', 0, 'Gel năng lượng GU được chế tạo để cung cấp cả năng lượng và các chất dinh dưỡng chính như điện giải và axit amin để giữ cho bạn cảm thấy mạnh mẽ và tràn đầy năng lượng.', '2022-02-13 03:35:43', NULL, '0'),
(163, 4, 'HỘP GEL - VỊ DƯA HẤU MUỐI', '960000.00', '864000.00', 10, 'backend/uploads/product/1644723363_Screenshot_15.png', 0, 'Gel năng lượng GU được chế tạo để cung cấp cả năng lượng và các chất dinh dưỡng chính như điện giải và axit amin để giữ cho bạn cảm thấy mạnh mẽ và tràn đầy năng lượng.', '2022-02-13 03:36:03', NULL, '0'),
(164, 4, 'HỘP GEL - VỊ ĐẬU VANI', '960000.00', '864000.00', 10, 'backend/uploads/product/1644723381_Screenshot_16.png', 1, 'Với mỗi thanh gel cung cấp 100 calories thiết yếu cho các vận động viên. Hỗn hợp gel được nghiên cứu một cách kỹ lưỡng gồm các thành phần carbohydrates đơn và phức hợp theo phương pháp kép giúp chuyển hóa năng lượng một cách hiệu quả cho việc hấp thụ.', '2022-02-13 03:36:21', NULL, '0'),
(165, 1, 'Đỗ Tất Thành', '20000.00', '19000.00', 5, NULL, 0, 'asd', '2022-04-10 05:40:09', NULL, '0'),
(166, 1, 'Đỗ Tất Thành', '20000.00', '19000.00', 5, NULL, 0, 'asd', '2022-04-10 05:40:32', NULL, '0'),
(167, 1, 'Đỗ Tất Thành', '20000.00', '19000.00', 5, NULL, 0, 'asd', '2022-04-10 05:41:09', NULL, '0'),
(168, 1, 'gggg111', '333333.00', '323333.01', 3, NULL, 0, 'sad', '2022-04-10 05:43:09', NULL, '0'),
(169, 1, '1231111', '33333.00', '32333.01', 3, NULL, 0, 'sadsad', '2022-04-10 05:47:34', NULL, '0'),
(170, 1, 'test', '20000.00', '18000.00', 10, NULL, 0, 'dsadsa', '2022-04-11 12:48:24', NULL, '0'),
(171, 1, 'test1', '200000.00', '190000.00', 5, NULL, 0, 'sadasd', '2022-04-11 12:57:21', NULL, '0');

-- --------------------------------------------------------

--
-- Table structure for table `sizes`
--

CREATE TABLE `sizes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sizes`
--

INSERT INTO `sizes` (`id`, `product_id`, `name`) VALUES
(9, 167, 'das123'),
(10, 167, 'sadasd'),
(11, 170, 'dsadsadsa'),
(12, 170, 'sadsad');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ins_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `upd_date` timestamp NULL DEFAULT NULL,
  `del_flag` char(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0' COMMENT 'deleted:1, active:0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `email`, `password`, `address`, `phone`, `ins_date`, `upd_date`, `del_flag`) VALUES
(1, 'User', 'user@gmail.com', '$2y$10$gT4jtvn8c1FSDSsa9k4VnebyBqdskFuraIv5eoSWEuzrcNDp2uDV2', NULL, '1234567890', '2021-06-15 14:03:25', NULL, '0'),
(2, 'mot', 'mot@gmail.com', '$2y$10$gT4jtvn8c1FSDSsa9k4VnebyBqdskFuraIv5eoSWEuzrcNDp2uDV2', 'HN', '0123456789', '2022-02-13 03:40:28', NULL, '0'),
(3, 'dat', 'dat@gmail.com', '$2y$10$gT4jtvn8c1FSDSsa9k4VnebyBqdskFuraIv5eoSWEuzrcNDp2uDV2', 'HN', '0123456123', '2022-02-13 14:11:28', NULL, '0'),
(4, 'thanhdt', 'thanhbuon1910@gmail.com', '$2y$10$Gbj/P3S1L21jUthTw9XRJukIuj8X1EXnkEeauEkn8Y9qbAr8PUYNi', 'sadsad', '0123123123', '2022-04-04 06:54:41', NULL, '0');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order`
--
ALTER TABLE `order`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_detail`
--
ALTER TABLE `order_detail`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sizes`
--
ALTER TABLE `sizes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `order`
--
ALTER TABLE `order`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `order_detail`
--
ALTER TABLE `order_detail`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=172;

--
-- AUTO_INCREMENT for table `sizes`
--
ALTER TABLE `sizes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
