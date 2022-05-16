-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th5 16, 2022 lúc 05:37 PM
-- Phiên bản máy phục vụ: 10.4.19-MariaDB
-- Phiên bản PHP: 8.0.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `duanmau_v2`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `cart`
--

CREATE TABLE `cart` (
  `cart_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL COMMENT 'Giỏ hàng của thành viên',
  `product_id` int(11) NOT NULL COMMENT 'Sản phẩm',
  `cart_quantity` int(3) NOT NULL COMMENT 'Số lượng',
  `cart_price` int(11) NOT NULL COMMENT 'Giá sản phẩm'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `cart`
--

INSERT INTO `cart` (`cart_id`, `user_id`, `product_id`, `cart_quantity`, `cart_price`) VALUES
(97, 1, 30, 1, 249000);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `categories`
--

CREATE TABLE `categories` (
  `cat_id` int(11) NOT NULL,
  `cat_name` varchar(50) NOT NULL COMMENT 'Tên danh mục',
  `cat_active` int(1) NOT NULL DEFAULT 1 COMMENT 'Trạng thái hoạt dộng',
  `created_at` datetime NOT NULL COMMENT 'Thời gian tạo'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `categories`
--

INSERT INTO `categories` (`cat_id`, `cat_name`, `cat_active`, `created_at`) VALUES
(1, 'Áo Phông', 1, '2021-10-08 20:11:12'),
(2, 'Phụ Kiện', 1, '2021-10-08 20:11:17'),
(3, 'Áo Khoác', 1, '2021-10-08 21:07:32'),
(4, 'Áo Nỉ', 1, '2021-10-08 21:09:28'),
(5, 'Quần Jogger', 0, '2021-10-28 09:15:30');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `comments`
--

CREATE TABLE `comments` (
  `cmt_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL COMMENT 'Người bình luận',
  `product_id` int(11) NOT NULL COMMENT 'Sản phẩm bình luận',
  `content` text NOT NULL COMMENT 'Nội dung bình luận',
  `create_at` datetime NOT NULL COMMENT 'Thời gian bình luận',
  `ip_address` varchar(50) NOT NULL COMMENT 'Địa chỉ IP'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `comments`
--

INSERT INTO `comments` (`cmt_id`, `user_id`, `product_id`, `content`, `create_at`, `ip_address`) VALUES
(32, 1, 20, 'hihihi', '2021-10-08 22:18:54', '127.0.0.1'),
(34, 1, 4, 'vjp quá', '2021-10-08 22:19:12', '127.0.0.1'),
(35, 1, 5, 'nghĩ mà buồn', '2021-10-08 22:19:20', '127.0.0.1'),
(36, 1, 23, 'hihihihihihi', '2021-10-08 22:32:43', '127.0.0.1'),
(37, 1, 31, 'hihihi', '2021-10-09 14:01:08', '127.0.0.1'),
(38, 1, 24, 'ohhhhhhh', '2021-10-10 23:25:04', '127.0.0.1'),
(39, 1, 19, 'hhhhhhhhhhhh', '2021-10-10 23:25:29', '127.0.0.1'),
(40, 1, 31, 'hhihihi', '2021-10-16 02:02:59', '127.0.0.1'),
(41, 1, 31, 'hihihi', '2021-10-16 14:53:34', '127.0.0.1'),
(42, 1, 31, 'hohohoh', '2021-10-16 14:57:35', '127.0.0.1'),
(43, 1, 31, 'êhhehhehe', '2021-10-16 15:02:57', '127.0.0.1'),
(47, 1, 30, 'hhhhhhhhhhhhhhhh', '2021-10-19 23:32:03', '127.0.0.1'),
(48, 1, 30, 'oooooooooo', '2021-10-19 23:32:12', '127.0.0.1'),
(50, 1, 27, 'hhhhhhhhh', '2021-10-26 16:15:17', '127.0.0.1'),
(51, 1, 31, 'testtt', '2021-10-28 09:34:26', '127.0.0.1'),
(52, 1, 32, 'okkkkkkkkkkk', '2021-11-08 21:58:12', '127.0.0.1'),
(53, 1, 31, 'hihihihi', '2021-11-22 18:38:12', '127.0.0.1');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `images`
--

CREATE TABLE `images` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL COMMENT 'Sản phẩm',
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `images`
--

INSERT INTO `images` (`id`, `product_id`, `image`) VALUES
(1, 1, 'JHAPX-20-17-09.jpg'),
(2, 1, 'WL5Py-20-17-09.jpg'),
(3, 2, 'IVqs5-20-19-44.jpg'),
(4, 2, 'kPBI5-20-19-44.jpg'),
(7, 4, 'umzgU-20-25-33.jpg'),
(8, 4, '6O2Q4-20-25-33.jpg'),
(9, 4, 'p1JUq-20-25-33.jpg'),
(10, 5, 'N1PX4-20-26-14.jpg'),
(11, 5, 'aKIRD-20-26-14.jpg'),
(14, 7, 'ypK8I-20-28-16.jpg'),
(15, 7, 'eXLzT-20-28-16.jpg'),
(16, 8, 'XCjd9-20-28-58.jpg'),
(17, 8, 'ucR8Q-20-28-58.jpg'),
(18, 8, 'AB9Ry-20-28-58.jpg'),
(19, 9, '2vXtm-20-29-38.jpg'),
(20, 9, '0EMWr-20-29-38.jpg'),
(21, 10, '82JES-20-30-28.jpg'),
(22, 10, '2uPiD-20-30-28.jpg'),
(23, 11, 'ZoUau-20-31-10.jpg'),
(24, 11, 'QPpr6-20-31-10.jpg'),
(25, 11, 'NXfhZ-20-31-10.jpg'),
(26, 11, 'HFEn8-20-31-10.jpg'),
(27, 12, 'DxHrg-20-31-52.jpg'),
(28, 12, 'ipmA1-20-31-52.jpg'),
(29, 12, '1M7ut-20-31-52.jpg'),
(30, 12, '2ziZL-20-31-52.jpg'),
(31, 13, 'DeUwI-20-33-03.jpg'),
(32, 13, '8cCp3-20-33-03.jpg'),
(33, 13, 'VgzdF-20-33-03.jpg'),
(34, 13, '2iXlP-20-33-03.jpg'),
(35, 13, 'DmBVg-20-33-03.jpg'),
(36, 13, 'unHAJ-20-33-03.jpg'),
(37, 14, 'n5zDG-20-34-04.jpg'),
(38, 14, '96DaQ-20-34-04.jpg'),
(39, 14, 'cIkOC-20-34-04.jpg'),
(40, 15, 'NhavW-20-34-57.jpg'),
(41, 15, 'bgrzp-20-34-57.jpg'),
(42, 15, 'qGbJF-20-34-57.jpg'),
(43, 15, 'QSLCI-20-34-57.jpg'),
(44, 16, '12mwn-20-36-06.jpg'),
(45, 16, 'neDrB-20-36-06.jpg'),
(46, 16, 'hn7aw-20-36-06.jpg'),
(47, 16, 'w2MI8-20-36-06.jpg'),
(48, 17, 'cOBoZ-20-37-04.jpg'),
(49, 17, '6efaQ-20-37-04.jpg'),
(50, 17, 'HU0MN-20-37-04.jpg'),
(51, 17, 'fO9gs-20-37-04.jpg'),
(52, 18, 'nNP5e-20-38-35.jpg'),
(53, 18, 'sJGCm-20-38-35.jpg'),
(54, 18, 'ztNeu-20-38-35.jpg'),
(55, 18, 'Lb5kH-20-38-35.jpg'),
(56, 18, 'Nwr2C-20-38-35.jpg'),
(57, 18, 'QoZfB-20-38-35.jpg'),
(58, 18, 'jwDM3-20-38-35.jpg'),
(59, 18, 'bLslm-20-38-35.jpg'),
(60, 19, 'vF7IE-20-39-25.jpg'),
(61, 19, 'O80G4-20-39-25.jpg'),
(62, 19, 'gWMcG-20-39-25.jpg'),
(63, 19, 'tMsX6-20-39-25.jpg'),
(64, 20, 'eyUJT-21-02-41.jpg'),
(65, 20, 'OT7aE-21-02-41.jpg'),
(66, 20, 'xdofp-21-02-41.jpg'),
(67, 20, 'R7qA3-21-02-41.jpg'),
(68, 20, '5tx0p-21-02-41.jpg'),
(69, 20, 'B2cab-21-02-41.jpg'),
(70, 20, 'gM8Ko-21-02-41.jpg'),
(71, 20, 'AEja8-21-02-41.jpg'),
(72, 21, 'iojZl-21-03-53.jpg'),
(73, 21, 'aoCtx-21-03-53.jpg'),
(74, 21, 'TJ6K7-21-03-53.jpg'),
(75, 21, 'I51Fw-21-03-53.jpg'),
(76, 21, 'shc08-21-03-53.jpg'),
(77, 21, 'X3ezT-21-03-53.jpg'),
(78, 21, 'M7gDI-21-03-53.jpg'),
(79, 21, 'cKTQb-21-03-53.jpg'),
(80, 22, 'nHGpo-21-05-08.jpg'),
(81, 22, '56aT9-21-05-08.jpg'),
(82, 23, 'C06dp-21-08-27.jpg'),
(83, 23, 'UB1I2-21-08-27.jpg'),
(84, 23, 'EMngh-21-08-27.jpg'),
(85, 23, 'g472H-21-08-27.jpg'),
(86, 24, 'UEaTF-21-10-06.jpg'),
(87, 24, 'gJM6y-21-10-06.jpg'),
(88, 24, 'n8QZP-21-10-06.jpg'),
(89, 24, 'tfVGd-21-10-06.jpg'),
(90, 25, 'hiFPE-21-11-39.jpg'),
(91, 25, 'UT90v-21-11-39.jpg'),
(92, 25, 'mCnQO-21-11-39.jpg'),
(93, 25, 'Yxj1a-21-11-39.jpg'),
(94, 26, 'SxJLa-21-12-56.jpg'),
(95, 26, '6qd8B-21-12-56.jpg'),
(96, 26, 'tWJpe-21-12-56.jpg'),
(97, 26, 'ir81o-21-12-56.jpg'),
(98, 27, 'YwtMn-21-15-00.jpg'),
(99, 27, 'BxKvf-21-15-00.jpg'),
(100, 27, 'YwqiU-21-15-00.jpg'),
(101, 27, 'XiP6V-21-15-00.jpg'),
(102, 27, 'JQED4-21-15-00.jpg'),
(103, 27, 'aTcJ0-21-15-00.jpg'),
(104, 27, 'bcqiW-21-15-00.jpg'),
(105, 27, '4RzmP-21-15-00.jpg'),
(106, 28, 'Tnj1L-21-17-36.jpg'),
(107, 28, 'DxCbd-21-17-36.jpg'),
(108, 28, 'Zwsy9-21-17-36.jpg'),
(109, 28, 'g1JoX-21-17-36.jpg'),
(110, 28, 'PjrUW-21-17-36.jpg'),
(111, 28, 'LVaKs-21-17-36.jpg'),
(112, 28, '94FNa-21-17-36.jpg'),
(113, 29, 'mIuR7-21-19-33.jpg'),
(114, 29, 'dCDf7-21-19-33.jpg'),
(115, 29, 'H75qN-21-19-33.jpg'),
(116, 29, '8kr94-21-19-33.jpg'),
(117, 30, 'DNjuG-21-21-10.jpg'),
(118, 30, 'A3Vwn-21-21-10.jpg'),
(119, 30, 'Vb61k-21-21-10.jpg'),
(120, 30, 'k2ZIF-21-21-10.jpg'),
(121, 30, 'ucCKi-21-21-10.jpg'),
(122, 30, 'tUShW-21-21-10.jpg'),
(123, 30, 'ixhUz-21-21-10.jpg'),
(124, 30, 'RGe6D-21-21-10.jpg'),
(125, 31, '3QYnd-21-22-14.jpg'),
(126, 31, 'qPh3r-21-22-14.jpg'),
(127, 31, '6ulyY-21-22-14.jpg'),
(128, 31, 'lp7kN-21-22-14.jpg'),
(129, 31, 'HDPzt-09-13-05.jpg'),
(130, 31, 'maGN9-09-13-05.jpg'),
(131, 31, 'KVrkT-09-13-05.jpg'),
(132, 31, '3CbVL-09-13-05.jpg'),
(133, 32, 'BuWO9-09-14-47.jpg'),
(134, 32, '8KBNZ-09-14-47.jpg'),
(135, 32, 'yLdoD-09-14-47.jpg'),
(136, 32, 'MDuA1-09-14-47.jpg'),
(137, 33, 'e6UWQ-19-34-22.jpg'),
(138, 33, '7q8WO-19-34-22.jpg'),
(139, 33, 'rKIxO-19-34-22.jpg'),
(140, 33, 'cx34E-19-34-22.jpg');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `information`
--

CREATE TABLE `information` (
  `id` int(11) NOT NULL,
  `web_name` varchar(50) NOT NULL COMMENT 'Tiêu đề cửa hàng',
  `logo` varchar(255) NOT NULL COMMENT 'Logo cửa hàng',
  `address` varchar(255) NOT NULL COMMENT 'Địa chỉ cửa hàng',
  `email` varchar(50) NOT NULL COMMENT 'Email liên hệ',
  `phone` varchar(50) NOT NULL COMMENT 'SĐT liên hệ'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `information`
--

INSERT INTO `information` (`id`, `web_name`, `logo`, `address`, `email`, `phone`) VALUES
(1, 'NFashion Shopp', 'logo-00-49-50.png', 'Hà Nội - Việt Nam', 'admin@nfashion.vn', '0123456789');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL COMMENT 'Người mua hàng',
  `fullname` varchar(255) NOT NULL COMMENT 'Họ và tên',
  `phone` varchar(11) NOT NULL COMMENT 'Số điện thoại',
  `email` varchar(50) NOT NULL COMMENT 'Địa chỉ email',
  `address` varchar(255) DEFAULT NULL COMMENT 'Địa chỉ',
  `note` varchar(255) DEFAULT NULL COMMENT 'Ghi chú mua hàng',
  `status` int(1) DEFAULT 1 COMMENT 'Trạng thái đơn hàng',
  `created_at` datetime NOT NULL COMMENT 'Ngày đặt hàng'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `orders`
--

INSERT INTO `orders` (`order_id`, `user_id`, `fullname`, `phone`, `email`, `address`, `note`, `status`, `created_at`) VALUES
(10, 1, 'Nhat Nguyen', '0987685868', 'ndnhat1@gmail.com', 'Nhat - Xã An Hòa Thịnh - Huyện Hương Sơn - Hà Tĩnh', '', 0, '2021-10-11 21:50:42'),
(12, 1, 'Nhat Nguyen', '0987654321', 'ndnhat1@gmail.com', 'xxx - Xã Thạch Thắng - Huyện Thạch Hà - Hà Tĩnh', '', 0, '2021-10-11 22:17:33'),
(13, 1, 'Nhat Nguyen', '0987654321', 'ndnhat1@gmail.com', 'Nhat - Phường Kỳ Trinh - Thị xã Kỳ Anh - Hà Tĩnh', '', 0, '2021-10-11 22:31:09'),
(14, 1, 'Nhat Nguyen', '0987654321', 'ndnhat1@gmail.com', 'Nhat - Xã An Hòa Thịnh - Huyện Hương Sơn - Hà Tĩnh', '', 1, '2021-10-11 22:32:53'),
(15, 1, 'Nguyễn Đăng Nhật', '0328082102', 'ndnhat1@gmail.com', 'Nhat - Phường Xuân Phương - Quận Nam Từ Liêm - Hà Nội', '', 0, '2021-10-26 15:20:04'),
(16, 1, 'Nhat Nguyen', '0987654321', 'ndnhat1@gmail.com', '1A - Xã Tiền Phong - Huyện Mê Linh - Hà Nội', '', 0, '2021-10-27 00:04:30');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `orders_detail`
--

CREATE TABLE `orders_detail` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL COMMENT 'Đơn hàng',
  `product_id` int(11) DEFAULT NULL COMMENT 'Sản phẩm',
  `order_quantity` int(3) NOT NULL COMMENT 'Số lượng',
  `order_price` int(11) NOT NULL COMMENT 'Giá sản phẩm'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `orders_detail`
--

INSERT INTO `orders_detail` (`id`, `order_id`, `product_id`, `order_quantity`, `order_price`) VALUES
(12, 10, 30, 1, 249000),
(13, 10, 31, 1, 49500),
(16, 12, 29, 1, 159000),
(17, 12, 30, 1, 249000),
(18, 13, 27, 1, 1399000),
(19, 14, 30, 1, 249000),
(20, 15, 30, 3, 249000),
(21, 15, 27, 1, 1399000),
(22, 16, 30, 1, 249000);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `products`
--

CREATE TABLE `products` (
  `product_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL COMMENT 'Tên sản phẩm',
  `price` int(11) NOT NULL COMMENT 'Giá sản phẩm',
  `discount` int(11) NOT NULL COMMENT 'Phần trăm giảm giá',
  `special` int(1) NOT NULL COMMENT 'Hàng đặc biệt',
  `view` int(11) NOT NULL DEFAULT 0 COMMENT 'Lượt xem',
  `description` text DEFAULT NULL COMMENT 'Mô tả sản phẩm',
  `keyword` varchar(255) DEFAULT NULL COMMENT 'Từ khóa sản phẩm',
  `cat_id` int(11) DEFAULT NULL COMMENT 'Loại danh mục',
  `created_at` datetime NOT NULL COMMENT 'Ngày tạo sản phẩm',
  `is_hidden` int(1) NOT NULL DEFAULT 0 COMMENT 'Ẩn hiện'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `products`
--

INSERT INTO `products` (`product_id`, `name`, `price`, `discount`, `special`, `view`, `description`, `keyword`, `cat_id`, `created_at`, `is_hidden`) VALUES
(1, 'Croptop Pattern Mickey Go Vietnam Boozilla', 499000, 0, 0, 3, '<p>&Aacute;o ph&ocirc;ng MICKEY go SG thuộc Collection Mickey Go Vietnam<br />\n- &Aacute;o in tr&agrave;n logo Mickey Go Vietnam gi&uacute;p outfit th&ecirc;m nổi bật.<br />\n- H&igrave;nh in được mua bản quyền trực tiếp từ Disney. Chất liệu in cao su bền bảo h&agrave;nh 1 năm.<br />\n- Form &aacute;o croptop d&aacute;ng rộng gi&uacute;p outfit của bạn nữ th&ecirc;m nữ t&iacute;nh v&agrave; kh&ocirc;ng k&eacute;m phần c&aacute; t&iacute;nh.<br />\n- Chất liệu: 100% cotton</p>', 'nfashion,fashion,thời trang,quần áo,croptop,pattern,mickey,go,vietnam,boozilla', 1, '2021-10-08 20:17:09', 0),
(2, 'Áo Phông Oversized Un Pattern Mickey Go Vietnam Boozilla', 649000, 20, 0, 5, '<p>&Aacute;o thun d&agrave;nh cho nam v&agrave; nữ của thương hiệu BOOZilla<br />\n- D&aacute;ng &aacute;o rộng c&ugrave;ng chất cotton tho&aacute;ng m&aacute;t, thấm h&uacute;t mồ h&ocirc;i tốt<br />\n- H&igrave;nh in logo Mickey được in tr&agrave;n gi&uacute;p outfit th&ecirc;m nổi bật</p>', 'nfashion,fashion,thời trang,quần áo,Áo,phông,oversized,un,pattern,mickey,go,vietnam,boozilla', 1, '2021-10-08 20:19:44', 0),
(4, 'Áo Phông Oversized Boolaab', 499000, 10, 0, 1, '<p>&Aacute;o ph&ocirc;ng BOOLAAB phối gi&oacute; vai lưng<br />\n- &Aacute;o ph&ocirc;ng BOOLAAB d&aacute;ng oversize l&agrave; một trong những item đang được y&ecirc;u th&iacute;ch nhất trong giới trẻ hiện nay. &Aacute;o được thiết kế kiểu d&aacute;ng rộng r&atilde;i, th&iacute;ch hợp cho cả nam v&agrave; nữ.<br />\n- &Aacute;o thun unisex form rộng c&oacute; thể phối nhiều item kh&aacute;c nhau (demim, flannel, short, jogger.....) mang tới phong c&aacute;ch năng động, c&aacute; t&iacute;nh cho người mặc.<br />\n- Sản phẩm 100% cotton, đường may tinh tế chắc chắn với bề mặt vải mềm mại, thấm h&uacute;t mồ h&ocirc;i tốt tạo cảm gi&aacute;c tho&aacute;ng m&aacute;t cho người mặc.<br />\n- Kh&ocirc;ng ra m&agrave;u, kh&ocirc;ng bai, kh&ocirc;ng x&ugrave;, kh&ocirc;ng b&aacute;m d&iacute;nh</p>', 'nfashion,fashion,thời trang,quần áo,Áo,phông,oversized,boolaab', 1, '2021-10-08 20:25:33', 0),
(5, 'Áo Phông Nữ In Hình Boolaab', 499000, 30, 1, 4, '<p>&Aacute;o ph&ocirc;ng nữ BOOLAAB d&aacute;ng crop<br />\n- Chiếc &aacute;o được thiết kế d&aacute;ng rộng v&agrave; ngắn gi&uacute;p kh&eacute;o l&eacute;o khoe được đường con nữ t&iacute;nh m&agrave; vẫn kh&ocirc;ng thiếu phần năng động c&aacute; t&iacute;nh<br />\n- Sản phẩm 100% cotton, đường may tinh tế chắc chắn với bề mặt vải mềm mại, thấm h&uacute;t mồ h&ocirc;i tốt tạo cảm gi&aacute;c tho&aacute;ng m&aacute;t cho người mặc.<br />\n- Kh&ocirc;ng ra m&agrave;u, kh&ocirc;ng bai, kh&ocirc;ng x&ugrave;, kh&ocirc;ng b&aacute;m d&iacute;nh</p>', 'nfashion,fashion,thời trang,quần áo,Áo,phông,nữ,in,hình,boolaab', 1, '2021-10-08 20:26:14', 0),
(7, 'Áo Phông Nữ In Hình Boolaab', 499000, 0, 1, 4, '<p>&Aacute;O PH&Ocirc;NG NỮ IN H&Igrave;NH BOOLAAB<br />\n- Croptop l&agrave; kiểu &aacute;o c&oacute; độ d&agrave;i ngắn lửng đến eo hoặc d&agrave;i hơn một ch&uacute;t để lộ phần eo. Ch&iacute;nh v&igrave; độ d&agrave;i tương đối ngắn n&agrave;y m&agrave; croptop chỉ trở n&ecirc;n phổ biến trong l&agrave;ng thời trang nữ.<br />\n- Với sự đa về kiểu d&aacute;ng, chất liệu v&agrave; họa tiết, &aacute;o croptop l&agrave; một item thời trang l&yacute; tưởng với nhiều c&aacute;ch kết hợp kh&aacute;c nhau d&agrave;nh cho những chị em theo đuổi phong c&aacute;ch trẻ trung, năng động v&agrave; quyến rũ.<br />\n- Rất dễ d&agrave;ng để nh&igrave;n thấy tr&ecirc;n đường một c&ocirc; g&aacute;i năng động v&agrave; ph&oacute;ng kho&aacute;ng với &aacute;o croptop mix c&ugrave;ng quần jean hay v&aacute;y cạp cao. Điều n&agrave;y cho thấy croptop đang dần bước v&agrave;o giai đoạn ho&agrave;ng kim v&agrave; được rất nhiều c&aacute;c t&iacute;n đồ thời trang ưa chuộng.<br />\n- Sản phẩm 100% cotton, đường may tinh tế chắc chắn với bề mặt vải mềm mại, thấm h&uacute;t mồ h&ocirc;i tốt tạo cảm gi&aacute;c tho&aacute;ng m&aacute;t cho người mặc.<br />\n- Kh&ocirc;ng ra m&agrave;u, kh&ocirc;ng bai, kh&ocirc;ng x&ugrave;, kh&ocirc;ng b&aacute;m d&iacute;nh</p>', 'nfashion,fashion,thời trang,quần áo,Áo,phông,nữ,in,hình,boolaab', 1, '2021-10-08 20:28:16', 0),
(8, 'Áo Phông Nữ Croptop Boolaab 2', 399000, 15, 1, 1, '<p>&Aacute;O PH&Ocirc;NG NỮ CROPTOP BOOLAAB 2<br />\n- Croptop l&agrave; kiểu &aacute;o c&oacute; độ d&agrave;i ngắn lửng đến eo hoặc d&agrave;i hơn một ch&uacute;t để lộ phần eo. Ch&iacute;nh v&igrave; độ d&agrave;i tương đối ngắn n&agrave;y m&agrave; croptop chỉ trở n&ecirc;n phổ biến trong l&agrave;ng thời trang nữ.<br />\n- Với sự đa về kiểu d&aacute;ng, chất liệu v&agrave; họa tiết, &aacute;o croptop l&agrave; một item thời trang l&yacute; tưởng với nhiều c&aacute;ch kết hợp kh&aacute;c nhau d&agrave;nh cho những chị em theo đuổi phong c&aacute;ch trẻ trung, năng động v&agrave; quyến rũ.<br />\n- Rất dễ d&agrave;ng để nh&igrave;n thấy tr&ecirc;n đường một c&ocirc; g&aacute;i năng động v&agrave; ph&oacute;ng kho&aacute;ng với &aacute;o croptop mix c&ugrave;ng quần jean hay v&aacute;y cạp cao. Điều n&agrave;y cho thấy croptop đang dần bước v&agrave;o giai đoạn ho&agrave;ng kim v&agrave; được rất nhiều c&aacute;c t&iacute;n đồ thời trang ưa chuộng.<br />\n- Sản phẩm 100% cotton, đường may tinh tế chắc chắn với bề mặt vải mềm mại, thấm h&uacute;t mồ h&ocirc;i tốt tạo cảm gi&aacute;c tho&aacute;ng m&aacute;t cho người mặc.<br />\n- Kh&ocirc;ng ra m&agrave;u, kh&ocirc;ng bai, kh&ocirc;ng x&ugrave;, kh&ocirc;ng b&aacute;m d&iacute;nh</p>', 'nfashion,fashion,thời trang,quần áo,Áo,phông,nữ,croptop,boolaab,2', 1, '2021-10-08 20:28:58', 0),
(9, 'Áo Phông Croptop Nữ Trơn Boolaab', 399000, 0, 0, 0, '<p>&Aacute;o ph&ocirc;ng nữ croptop BOOLAAB phối chun bụng<br />\n- Croptop l&agrave; kiểu &aacute;o c&oacute; độ d&agrave;i ngắn lửng đến eo hoặc d&agrave;i hơn một ch&uacute;t để lộ phần eo. Ch&iacute;nh v&igrave; độ d&agrave;i tương đối ngắn n&agrave;y m&agrave; croptop chỉ trở n&ecirc;n phổ biến trong l&agrave;ng thời trang nữ.<br />\n- Với sự đa về kiểu d&aacute;ng, chất liệu v&agrave; họa tiết, &aacute;o croptop l&agrave; một item thời trang l&yacute; tưởng với nhiều c&aacute;ch kết hợp kh&aacute;c nhau d&agrave;nh cho những chị em theo đuổi phong c&aacute;ch trẻ trung, năng động v&agrave; quyến rũ.<br />\n- Rất dễ d&agrave;ng để nh&igrave;n thấy tr&ecirc;n đường một c&ocirc; g&aacute;i năng động v&agrave; ph&oacute;ng kho&aacute;ng với &aacute;o croptop mix c&ugrave;ng quần jean hay v&aacute;y cạp cao. Điều n&agrave;y cho thấy croptop đang dần bước v&agrave;o giai đoạn ho&agrave;ng kim v&agrave; được rất nhiều c&aacute;c t&iacute;n đồ thời trang ưa chuộng.<br />\n- Sản phẩm 100% cotton, đường may tinh tế chắc chắn với bề mặt vải mềm mại, thấm h&uacute;t mồ h&ocirc;i tốt tạo cảm gi&aacute;c tho&aacute;ng m&aacute;t cho người mặc.<br />\n- Kh&ocirc;ng ra m&agrave;u, kh&ocirc;ng bai, kh&ocirc;ng x&ugrave;, kh&ocirc;ng b&aacute;m d&iacute;nh</p>', 'nfashion,fashion,thời trang,quần áo,Áo,phông,croptop,nữ,trơn,boolaab', 1, '2021-10-08 20:29:38', 0),
(10, 'Áo Phông Nữ Tiedye Hồng Trắng', 499000, 0, 0, 0, '<p>&Aacute;o ph&ocirc;ng nữ BOOLAAB croptop phối họa tiết Tie-dye hồng trắng<br />\n- Croptop l&agrave; kiểu &aacute;o c&oacute; độ d&agrave;i ngắn lửng đến eo hoặc d&agrave;i hơn một ch&uacute;t để lộ phần eo. Ch&iacute;nh v&igrave; độ d&agrave;i tương đối ngắn n&agrave;y m&agrave; croptop chỉ trở n&ecirc;n phổ biến trong l&agrave;ng thời trang nữ.<br />\n- Với sự đa về kiểu d&aacute;ng, chất liệu v&agrave; họa tiết, &aacute;o croptop l&agrave; một item thời trang l&yacute; tưởng với nhiều c&aacute;ch kết hợp kh&aacute;c nhau d&agrave;nh cho những chị em theo đuổi phong c&aacute;ch trẻ trung, năng động v&agrave; quyến rũ.<br />\n- Rất dễ d&agrave;ng để nh&igrave;n thấy tr&ecirc;n đường một c&ocirc; g&aacute;i năng động v&agrave; ph&oacute;ng kho&aacute;ng với &aacute;o croptop mix c&ugrave;ng quần jean hay v&aacute;y cạp cao. Điều n&agrave;y cho thấy croptop đang dần bước v&agrave;o giai đoạn ho&agrave;ng kim v&agrave; được rất nhiều c&aacute;c t&iacute;n đồ thời trang ưa chuộng.<br />\n- Sản phẩm 100% cotton, đường may tinh tế chắc chắn với bề mặt vải mềm mại, thấm h&uacute;t mồ h&ocirc;i tốt tạo cảm gi&aacute;c tho&aacute;ng m&aacute;t cho người mặc.<br />\n- Kh&ocirc;ng ra m&agrave;u, kh&ocirc;ng bai, kh&ocirc;ng x&ugrave;, kh&ocirc;ng b&aacute;m d&iacute;nh</p>', 'nfashion,fashion,thời trang,quần áo,Áo,phông,nữ,tiedye,hồng,trắng', 1, '2021-10-08 20:30:28', 0),
(11, 'Croptop Fit Logo Star Wars Boozilla', 399000, 50, 1, 1, '<p>&Aacute;o thun nữ d&aacute;ng croptop, dễ d&agrave;ng mix match c&ugrave;ng shorts, quần jeans,...<br />\nChất vải 100%cotton thấm h&uacute;t mồ hồi<br />\nH&igrave;nh in logo StarWars được in &eacute;p hologram ph&iacute;a sau lưng c&ugrave;ng patch logo: BOO x Marvel tr&ecirc;n tay &aacute;o<br />\n- Chất liệu: Cotton</p>', 'nfashion,fashion,thời trang,quần áo,croptop,fit,logo,star,wars,boozilla', 1, '2021-10-08 20:31:10', 0),
(12, 'Áo Phông Regular Un Mickey Go Saigon Boozilla', 399000, 50, 1, 0, '<p>&Aacute;o ph&ocirc;ng MICKEY go SG thuộc Collection Mickey Go Vietnam<br />\n- &Aacute;o in pattern chữ Vịt lộn - Vịt dữa - C&uacute;t lộn ở tay &aacute;o gi&uacute;p set đồ nổi bật hơn, nhấn th&ecirc;m h&igrave;nh ch&uacute; chuột Mickey b&ecirc;n cạnh l&agrave;m nổi bật l&ecirc;n đặc trưng của BST. Ngực &aacute;o in chữ &quot;SAIGON&quot;.<br />\n- H&igrave;nh in được mua bản quyền trực tiếp từ Disney. Chất liệu in cao su bền bảo h&agrave;nh 1 năm.<br />\n- Form &aacute;o oversize cả nam v&agrave; nữ đều c&oacute; thể mặc được v&agrave; kết hợp được với nhiều loại trang phục v&agrave; phong c&aacute;ch kh&aacute;c nhau.<br />\n- Chất liệu: 100% cotton</p>', 'nfashion,fashion,thời trang,quần áo,Áo,phông,regular,un,mickey,go,saigon,boozilla', 1, '2021-10-08 20:31:52', 0),
(13, 'Áo Phông Regular Un Mickey Tết Boozilla', 499000, 0, 0, 0, '<p>&Aacute;o ph&ocirc;ng thuộc BST Mickey - BOOZilla<br />\n- &Aacute;o thun in h&igrave;nh một trong những item đang được y&ecirc;u th&iacute;ch nhất trong giới trẻ hiện nay. &Aacute;o được thiết kế kiểu d&aacute;ng rộng r&atilde;i, th&iacute;ch hợp cho cả nam v&agrave; nữ.<br />\n- Form &aacute;o rộng c&oacute; thể phối nhiều item kh&aacute;c nhau (demim, flannel, short, jogger.....) mang tới phong c&aacute;ch năng động, c&aacute; t&iacute;nh cho người mặc.<br />\n- Sản phẩm 100% cotton, đường may tinh tế chắc chắn với bề mặt vải mềm mại, thấm h&uacute;t mồ h&ocirc;i tốt tạo cảm gi&aacute;c tho&aacute;ng m&aacute;t cho người mặc.<br />\n- Kh&ocirc;ng ra m&agrave;u, kh&ocirc;ng bai, kh&ocirc;ng x&ugrave;, kh&ocirc;ng b&aacute;m d&iacute;nh<br />\n- Họa tiết được in l&ecirc;n trước ngực &aacute;o, c&oacute; độ bền cao.</p>', 'nfashion,fashion,thời trang,quần áo,Áo,phông,regular,un,mickey,tết,boozilla', 1, '2021-10-08 20:33:03', 0),
(14, 'Áo Phông Oversized Un Pattern Logo Star Wars Boozilla', 599000, 0, 1, 0, '<p>&Aacute;o ph&ocirc;ng in tr&agrave;n thuộc BST Star Wars - BOOZilla<br />\n- &Aacute;o thun in h&igrave;nh một trong những item đang được y&ecirc;u th&iacute;ch nhất trong giới trẻ hiện nay. &Aacute;o được thiết kế kiểu d&aacute;ng rộng r&atilde;i, th&iacute;ch hợp cho cả nam v&agrave; nữ.<br />\n- Form &aacute;o rộng c&oacute; thể phối nhiều item kh&aacute;c nhau (demim, flannel, short, jogger.....) mang tới phong c&aacute;ch năng động, c&aacute; t&iacute;nh cho người mặc.<br />\n- Sản phẩm 100% cotton, đường may tinh tế chắc chắn với bề mặt vải mềm mại, thấm h&uacute;t mồ h&ocirc;i tốt tạo cảm gi&aacute;c tho&aacute;ng m&aacute;t cho người mặc.<br />\n- Kh&ocirc;ng ra m&agrave;u, kh&ocirc;ng bai, kh&ocirc;ng x&ugrave;, kh&ocirc;ng b&aacute;m d&iacute;nh<br />\n- Họa tiết được in l&ecirc;n trước ngực &aacute;o, c&oacute; độ bền cao.</p>', 'nfashion,fashion,thời trang,quần áo,Áo,phông,oversized,un,pattern,logo,star,wars,boozilla', 1, '2021-10-08 20:34:04', 0),
(15, 'Áo Phông Oversized Un Logo Comics Marvel Boozilla', 499000, 0, 0, 0, '<p>&Aacute;o thun d&agrave;nh cho nam v&agrave; nữ của thương hiệu BOOZilla<br />\n- D&aacute;ng &aacute;o rộng, chất vải cotton thấm h&uacute;t mồ h&ocirc;i tốt<br />\n- H&igrave;nh in logo Marvel trước ngực</p>', 'nfashion,fashion,thời trang,quần áo,Áo,phông,oversized,un,logo,comics,marvel,boozilla', 1, '2021-10-08 20:34:57', 0),
(16, 'Croptop Logo Hologram Star Wars Boozilla', 449000, 20, 0, 3, '<p>&Aacute;o ph&ocirc;ng nữ croptop Star Wars d&aacute;ng rộng<br />\n- Croptop l&agrave; kiểu &aacute;o c&oacute; độ ngắn đến eo hoặc d&agrave;i hơn một ch&uacute;t để lộ phần eo. Ch&iacute;nh v&igrave; độ d&agrave;i tương đối ngắn n&agrave;y m&agrave; croptop chỉ trở n&ecirc;n phổ biến trong l&agrave;ng thời trang nữ.<br />\n- Với sự đa về kiểu d&aacute;ng, chất liệu v&agrave; họa tiết, &aacute;o croptop l&agrave; một item thời trang l&yacute; tưởng với nhiều c&aacute;ch kết hợp kh&aacute;c nhau d&agrave;nh cho những chị em theo đuổi phong c&aacute;ch trẻ trung, năng động v&agrave; quyến rũ.<br />\n- Rất dễ d&agrave;ng để nh&igrave;n thấy tr&ecirc;n đường một c&ocirc; g&aacute;i năng động v&agrave; ph&oacute;ng kho&aacute;ng với &aacute;o croptop mix c&ugrave;ng quần jean hay v&aacute;y cạp cao. Điều n&agrave;y cho thấy croptop đang dần bước v&agrave;o giai đoạn ho&agrave;ng kim v&agrave; được rất nhiều c&aacute;c t&iacute;n đồ thời trang ưa chuộng.<br />\n- Sản phẩm 100% cotton, đường may tinh tế chắc chắn với bề mặt vải mềm mại, thấm h&uacute;t mồ h&ocirc;i tốt tạo cảm gi&aacute;c tho&aacute;ng m&aacute;t cho người mặc.<br />\n- Kh&ocirc;ng ra m&agrave;u, kh&ocirc;ng bai, kh&ocirc;ng x&ugrave;, kh&ocirc;ng b&aacute;m d&iacute;nh</p>', 'nfashion,fashion,thời trang,quần áo,croptop,logo,hologram,star,wars,boozilla', 1, '2021-10-08 20:36:06', 0),
(17, 'Áo Phông Regular Un Doraemon Boozilla', 449000, 0, 0, 0, '<p>&Aacute;o ph&ocirc;ng thuộc BST Doraemon của thương hiệu BOOZilla<br />\n- &Aacute;o được in h&igrave;nh Nobita v&agrave; c&aacute;c bạn khủng long mới ở mặt sau, v&agrave; phối th&ecirc;m 1 chiếc logo nhỏ ph&iacute;a trước<br />\n- Với thiết kế &aacute;o d&aacute;ng Regular gi&uacute;p trang phục th&ecirc;m gọn g&agrave;ng nhưng vẫn kh&ocirc;ng k&eacute;m phần thoải m&aacute;i<br />\n- Chất liệu: 100% cotton</p>', 'nfashion,fashion,thời trang,quần áo,Áo,phông,regular,un,doraemon,boozilla', 1, '2021-10-08 20:37:04', 0),
(18, 'Áo Phông Regular Un Mickey Go Hanoi Boozilla', 499000, 10, 0, 0, '<p>&Aacute;o thun d&agrave;nh cho nam v&agrave; nữ của thương hiệu BOOZilla<br />\n- H&igrave;nh in trước ngực với một g&oacute;c phố cổ H&agrave; Nội v&agrave; ch&uacute; chuột Mickey<br />\n- D&aacute;ng &aacute;o rộng, c&ugrave;ng chất vải cotton tho&aacute;ng m&aacute;t, thấm h&uacute;t mồ h&ocirc;i tốt<br />\n- H&igrave;nh in được BOO mua bản quyền từ Disney. Chất liệu in cao su bền với thời gian bảo h&agrave;nh 1 năm</p>', 'nfashion,fashion,thời trang,quần áo,Áo,phông,regular,un,mickey,go,hanoi,boozilla', 1, '2021-10-08 20:38:35', 0),
(19, 'Áo Phông Regular Un Logo Comics Marvel Boozilla', 399000, 0, 0, 2, '<p>&Aacute;o thun d&agrave;nh cho nam v&agrave; nữ của thương hiệu BOOZilaa<br />\n- D&aacute;ng &aacute;o regular, vừa với d&aacute;ng người mặc, dễ d&agrave;ng mix c&ugrave;ng &aacute;o sơ mi<br />\n- H&igrave;nh in Logo Marvel trước ngực v&agrave; patch BooxMarvel ở tay &aacute;o<br />\n- H&igrave;nh in được BOO mua bản quyền từ Disney<br />\n- Chất liệu: Cotton</p>', 'nfashion,fashion,thời trang,quần áo,Áo,phông,regular,un,logo,comics,marvel,boozilla', 1, '2021-10-08 20:39:25', 0),
(20, 'Áo Phông Oversized Un Spiderman Marvel Boozilla', 499000, 0, 0, 5, '<p>- &Aacute;O PH&Ocirc;NG UN SPIDER MAN MARVEL<br />\nH&Igrave;NH IN TO SAU LƯNG<br />\n- H&Igrave;NH IN CHỮ NHỎ TRƯỚC NGỰC</p>', 'nfashion,fashion,thời trang,quần áo,Áo,phông,oversized,un,spiderman,marvel,boozilla', 1, '2021-10-08 21:02:41', 0),
(21, 'Áo Phông Oversized Un Black Panther Marvel Boozilla', 499000, 0, 0, 12, '<p>- &Aacute;O PH&Ocirc;NG UN BLACK PANTHER MARVEL<br />\n- H&Igrave;NH IN TO SAU LƯNG<br />\n- H&Igrave;NH IN NHỎ B&Ecirc;N TR&Aacute;I NGỰC &Aacute;O</p>', 'nfashion,fashion,thời trang,quần áo,Áo,phông,oversized,un,black,panther,marvel,boozilla', 1, '2021-10-08 21:03:53', 0),
(22, 'Áo Phông Nữ License 1 - Marvel Loose Venom', 499000, 0, 0, 1, '<p>&Aacute;o ph&ocirc;ng nữ thuộc BST Marvel<br />\n- &Aacute;o d&aacute;ng loose, rộng r&atilde;i v&agrave; kh&ocirc;ng qu&aacute; d&agrave;i, chất vải cotton thấm h&uacute;t mồ h&ocirc;i tốt<br />\n- H&igrave;nh in logo VENOM trước ngực<br />\n- Sản phẩm 100% cotton, đường may tinh tế chắc chắn với bề mặt vải mềm mại, thấm h&uacute;t mồ h&ocirc;i tốt tạo cảm gi&aacute;c tho&aacute;ng m&aacute;t cho người mặc.<br />\n- Form &aacute;o cơ bản, vừa vặn cơ thể, thoải m&aacute;i theo từng cử động.<br />\n- Kh&ocirc;ng ra m&agrave;u, kh&ocirc;ng bai, kh&ocirc;ng x&ugrave;, kh&ocirc;ng b&aacute;m d&iacute;nh</p>', 'nfashion,fashion,thời trang,quần áo,Áo,phông,nữ,license,1,-,marvel,loose,venom', 1, '2021-10-08 21:05:08', 0),
(23, 'Áo Khoác Lông Cùn Boolaab', 2699000, 20, 0, 7, '<p>&Aacute;o kho&aacute;c l&ocirc;ng c&ugrave;n phối tay vải nhung tăm Boo, đ&iacute;nh logo ph&iacute;a sau lưng. Tặng k&egrave;m bộ sticker<br />\n<br />\n- Ch&acirc;t liệu: L&ocirc;ng c&ugrave;n v&agrave; Nhung tam</p>', 'nfashion,fashion,thời trang,quần áo,Áo,khoác,lông,cùn,boolaab', 3, '2021-10-08 21:08:27', 0),
(24, 'Áo Nỉ Không Mũ Experimental Boolaab', 699000, 0, 0, 4, '<p>&bull; &Aacute;o sweater l&agrave; một trong những items thường được mix theo phong c&aacute;ch street style, &aacute;o cũng l&agrave; một trong những items unisex (d&ugrave;ng được cho cả nam v&agrave; nữ).<br />\n&bull; &Aacute;o sweater l&agrave; loại &aacute;o chui đầu, c&ugrave;ng thiết kế ống tay d&agrave;i v&agrave; kh&ocirc;ng c&oacute; mũ (ph&acirc;n biệt với hoodie)<br />\n&bull; Quần short jean hoặc kaki ngắn kết hợp c&ugrave;ng &aacute;o sweater l&agrave; set đồ cực đẹp v&agrave; chất cho c&aacute;c bạn nữ xinh xắn. 1 chiếc quần jean skinny, 1 chiếc &aacute;o sweater s&aacute;ng m&agrave;u, 1 đ&ocirc;i giầy converse gi&uacute;p bạn c&oacute; ngay 1 set đồ dạo phố cực k&igrave; đơn giản kh&ocirc;ng k&eacute;m phần c&aacute; t&iacute;nh.<br />\n&bull; Sản phẩm 100% cotton, đường may tinh tế chắc chắn với bề mặt vải mềm mại, thấm h&uacute;t mồ h&ocirc;i tốt tạo cảm gi&aacute;c tho&aacute;ng m&aacute;t cho người mặc.<br />\n&bull; Chất liệu vải mềm mịn, kh&ocirc;ng nhăn, kh&ocirc;ng x&ugrave; l&ocirc;ng, giữ d&aacute;ng, kh&ocirc;ng phai m&agrave;u.<br />\n&bull; Họa tiết được in l&ecirc;n trước ngực &aacute;o, c&oacute; độ bền cao.</p>', 'nfashion,fashion,thời trang,quần áo,Áo,nỉ,không,mũ,experimental,boolaab', 4, '2021-10-08 21:10:06', 0),
(25, 'Áo Nỉ Không Mũ Doraemon Boozilla', 699000, 0, 0, 2, '<p>&Aacute;o&nbsp;nỉ kh&ocirc;ng mũ in h&igrave;nh Doraemon<br />\n- Chất liệu: Nỉ b&ocirc;ng<br />\n- Size mẫu mặc: M<br />\n- Số đo mẫu: Nữ: 165cm, 45kg. Nam: 179cm, 65kg</p>', 'nfashion,fashion,thời trang,quần áo,Áo,nỉ,không,mũ,doraemon,boozilla', 4, '2021-10-08 21:11:39', 0),
(26, 'Balo In Monogram Aa Boolaab', 1399000, 0, 0, 13, '<p>BALO IN MONOGRAM AA BOOLAAB<br />\n- Balo được phối nhiều ngăn nhỏ tiện lợi v&agrave; kh&ocirc;ng k&eacute;m phần c&aacute; t&iacute;nh, th&iacute;ch hợp cho cả đi học v&agrave; đi chơi<br />\n- T&uacute;i được in họa tiết pattern AA - một chi tiết đặc trưng của thương hiệu BOOLAAB, v&agrave; đ&iacute;nh k&egrave;m một t&uacute;i nhỏ c&oacute; thể th&aacute;o rời để đeo ri&ecirc;ng.<br />\n- M&agrave;u sắc trendy th&iacute;ch hợp với nhiều loại outfit kh&aacute;c nhau<br />\n- Chất liệu: Cordura<br />\n- Vải cordura được biết đến như một loại vải nylon v&agrave; l&agrave; 1 loại vải cao cấp . Với cấu tr&uacute;c đặc biệt, sợi cordura rất bền v&agrave; chống m&agrave;i m&ograve;n tốt.&nbsp;<br />\n- Vải c&oacute; trọng lượng nhẹ, t&iacute;nh thẩm mỹ cao. Khi được ng&acirc;m tẩm đặc biệt trong một số giai đoạn, loại vải n&agrave;y c&oacute; khả năng chống thấm nước rất tốt<br />\n- K&iacute;ch thước: 38x20x42cm</p>', 'nfashion,fashion,thời trang,quần áo,balo,in,monogram,aa,boolaab', 2, '2021-10-08 21:12:56', 0),
(27, 'Balo Phối Màu Boolaab', 1399000, 0, 0, 18, '<p>BALO PHỐI M&Agrave;U BOOLAAB<br />\n- Balo được phối nhiều ngăn nhỏ tiện lợi v&agrave; kh&ocirc;ng k&eacute;m phần c&aacute; t&iacute;nh, th&iacute;ch hợp cho cả đi học v&agrave; đi chơi<br />\n- Mặt trước được phối t&uacute;i plastic trong suốt, v&agrave; đ&iacute;nh k&egrave;m một t&uacute;i nhỏ c&oacute; thể th&aacute;o rời để đeo ri&ecirc;ng.<br />\n- M&agrave;u sắc trendy th&iacute;ch hợp với nhiều loại outfit kh&aacute;c nhau<br />\n- Chất liệu : Poly 600D<br />\n- Chất liệu poly canavas 600D c&oacute; khả năng chống thấm nước tốt , chống nhăn v&agrave; tạo độ đứng form cho sản phẩm<br />\n- K&iacute;ch thước: 56x43x12cm</p>', 'nfashion,fashion,thời trang,quần áo,balo,phối,màu,boolaab', 2, '2021-10-08 21:15:00', 0),
(28, 'Balo Star Wars Boozilla', 899000, 0, 0, 7, '<p>BALO STAR WARS BOOZILLA<br />\nSản phẩm bản quyền ch&iacute;nh thức của Disney<br />\n- C&oacute; ngăn đựng laptop<br />\n- C&oacute; c&aacute;c ngăn nhỏ v&agrave; t&uacute;i phụ đựng phụ kiện, b&igrave;nh nước.<br />\n- Lưng balo chống xốc, d&acirc;y quai đeo c&oacute; đệm tr&aacute;nh đau vai.<br />\n- Chất liệu: Poly 600D<br />\n- K&iacute;ch thước: Cao 41cm x Ngang 39cm x Rộng 20cm</p>', 'nfashion,fashion,thời trang,quần áo,balo,star,wars,boozilla', 2, '2021-10-08 21:17:36', 0),
(29, 'Hộp Bút Marvel Boozilla', 159000, 0, 0, 13, '<p>HỘP B&Uacute;T MARVEL BOOZILLA<br />\nSản phẩm bản quyền ch&iacute;nh thức của Disney<br />\n- C&oacute; thể đựng số lượng b&uacute;t v&agrave; dụng cụ học tập lớn.<br />\n- Miếng patch Marvel<br />\n- H&igrave;nh in bảo h&agrave;nh 1 năm<br />\n- Chất liệu: Poly 600D<br />\n- K&iacute;ch thước: 21 x 10 x 6 cm</p>', 'nfashion,fashion,thời trang,quần áo,hộp,bút,marvel,boozilla', 2, '2021-10-08 21:19:33', 0),
(30, 'Phụ Kiện Ví Bắn Tim', 249000, 0, 1, 68, '<p>Phụ kiện v&iacute; bắn tim in graphic</p>', 'nfashion,fashion,thời trang,quần áo,phụ,kiện,ví,bắn,tim', 2, '2021-10-08 21:21:10', 0),
(31, 'Combo 2 Khẩu Trang Boo', 99000, 50, 0, 35, '<p>&bull; Kh&ocirc;ng chỉ gi&uacute;p bảo vệ đường h&ocirc; hấp của bố mẹ, khẩu trang vải kh&aacute;ng khuẩn người lớn c&ograve;n gi&uacute;p tr&aacute;nh được những t&aacute;c hại g&acirc;y bệnh từ m&ocirc;i trường kh&oacute;i bụi, &ocirc; nhiễm hoặc do thời tiết chuyển m&ugrave;a.<br />\n&bull; Sản phẩm khẩu trang được sản xuất theo quy tr&igrave;nh đạt ti&ecirc;u chuẩn của Viện Dệt May.<br />\n&bull; Vải line kh&aacute;ng khuẩn v&agrave; chống thấm. Được thiết kế &ocirc;m k&iacute;n to&agrave;n bộ khu&ocirc;n mặt<br />\n&bull; Duy tr&igrave;nh khả năng kh&aacute;ng khuẩn tới 20 lần giặt</p>', 'nfashion,fashion,thời trang,quần áo,combo,2,khẩu,trang,boo', 2, '2021-10-08 21:22:14', 0),
(32, 'Áo Phông Oversized Essential2', 399000, 0, 1, 10, '<p>&Aacute;O PH&Ocirc;NG OVERSIZED ESSENTIAL2<br />\n- &Aacute;o được in logo BOO basic c&ugrave;ng với h&igrave;nh in sau lưng: KIND OF BASIC BUT STILL MF COOL<br />\n- &Aacute;o thun unisex th&iacute;ch hợp với cả nam v&agrave; nữ. Mặc l&agrave;m &aacute;o thun cặp, &aacute;o nh&oacute;m rất ph&ugrave; hợp.<br />\n- Sản phẩm 100% cotton, đường may tinh tế chắc chắn với bề mặt vải mềm mại, thấm h&uacute;t mồ h&ocirc;i tốt tạo cảm gi&aacute;c tho&aacute;ng m&aacute;t cho người mặc.<br />\n- Form &aacute;o cơ bản, vừa vặn cơ thể, thoải m&aacute;i theo từng cử động.<br />\n- Kh&ocirc;ng ra m&agrave;u, kh&ocirc;ng bai, kh&ocirc;ng x&ugrave;, kh&ocirc;ng b&aacute;m d&iacute;nh.<br />\n- Size mẫu mặc: M<br />\n- Số đo mẫu: 165cm, 45kg</p>', 'nfashion,fashion,thời trang,quần áo,Áo,phông,oversized,essential2', 1, '2021-10-28 09:14:47', 0),
(33, 'Áo Khoác Dạ Varsity Oversized Un Marvel Boozilla', 1000000, 0, 0, 4, '<p>&Aacute;O KHO&Aacute;C DẠ VARSITY OVERSIZED UN MARVEL BOOZILLA<br />\n- &Aacute;o kho&aacute;c thuộc BST Marvel - Thương hiệu BOOZilla<br />\n- &Aacute;o kho&aacute;c varsity l&agrave; d&aacute;ng &aacute;o kho&aacute;c trendy nhất của giới trẻ hiện nay, th&iacute;ch hợp phối c&ugrave;ng &aacute;o ph&ocirc;ng, &aacute;o sơ mi mix layer, hoặc &aacute;o hoodie...<br />\n- Ngực &aacute;o th&ecirc;u logo Marvel Comic Group<br />\n- Tay &aacute;o được phối kh&aacute;c m&agrave;u, th&ecirc;u logo c&aacute;c nh&acirc;n vật của Marvel<br />\n- Chất liệu: Dạ cao cấp. Ưu điểm của chất liệu n&agrave;y l&agrave; mặc l&ecirc;n đứng form, giữ ấm tốt, bền, m&agrave;u sản phẩm l&ecirc;n đậm v&agrave; đẹp<br />\n- Size mẫu mặc: Nam: M, Nữ: S<br />\n- Số đo mẫu: Nam: 1m75, 65kg, Nữ: 1m64, 48 kg</p>', 'nfashion,fashion,thời trang,quần áo,Áo,khoác,dạ,varsity,oversized,un,marvel,boozilla', 3, '2021-11-27 19:34:22', 0);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `slides`
--

CREATE TABLE `slides` (
  `slide_id` int(11) NOT NULL,
  `slide_image` varchar(255) NOT NULL COMMENT 'Ảnh slide',
  `slide_title` varchar(255) NOT NULL COMMENT 'Tiêu đề slide',
  `slide_url` varchar(255) NOT NULL COMMENT 'Đường dẫn slide'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `slides`
--

INSERT INTO `slides` (`slide_id`, `slide_image`, `slide_title`, `slide_url`) VALUES
(4, 'slide-01-05-22.jpg', 'Đồ Nam Thời Trang', 'do-nam');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `fullname` varchar(255) NOT NULL COMMENT 'Họ và tên',
  `username` varchar(255) NOT NULL COMMENT 'Tên đăng nhập',
  `password` varchar(255) NOT NULL COMMENT 'Mật khẩu',
  `email` varchar(50) NOT NULL COMMENT 'Địa chỉ email',
  `avatar` varchar(255) NOT NULL COMMENT 'Ảnh đại diện',
  `active` int(1) NOT NULL DEFAULT 0 COMMENT 'Kích hoạt',
  `address` varchar(255) NOT NULL COMMENT 'Địa chỉ',
  `permission` int(1) NOT NULL COMMENT 'Quyền quản trị',
  `verify_code` varchar(10) NOT NULL COMMENT 'Mã kích hoạt',
  `created_at` datetime NOT NULL COMMENT 'Ngày đăng ký'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `users`
--

INSERT INTO `users` (`user_id`, `fullname`, `username`, `password`, `email`, `avatar`, `active`, `address`, `permission`, `verify_code`, `created_at`) VALUES
(1, 'Nguyễn Đăng Nhậtt', 'ndnhat1', '$2y$10$7P572M7pIEarJf.SOkiBt.q3gjtr1B3aeATdtD6C4S5DNmErzQWmS', 'ndnhat1@gmail.com', 'kpdjy-08-10-2021.jpg', 1, 'Hà Tĩnh', 2, 'qdv1Q', '2021-10-08 20:10:35'),
(6, 'Linh Loi', 'linhloi2k2', '$2y$10$PQ/AmBgz7TVRLh98nUh1qe/Qh97C1psbXYhaVylpN2oFbf7/UxT6e', 'linhloi2k2@gmail.com', 'default.png', 1, 'Ha Tinh', 1, '7geOs', '2021-10-21 14:29:03'),
(7, 'Huy Toàn Nguyễn', 'huytoannguyen43', '$2y$10$Lrsz1L/RnN88utUD40Xkl.KOxhXrgnWTKmtcO/hZ/rTHa4WErO3Qq', 'huytoannguyen43@gmail.com', 'default.png', 1, 'Hà Tĩnh', 1, 'bBu73', '2021-10-27 21:32:48'),
(8, 'Lan Anh Pham Thi', 'anhptlph15859', '$2y$10$8GLoikiLzDwzdK8Ukf3Qr.f3e48UeE/NF/T65BS5mr9SA1GL/wTQm', 'anhptlph15859@fpt.edu.vn', 'default.png', 1, 'Ha Noi', 2, 'IXj7L', '2021-10-28 09:16:08');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`cart_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Chỉ mục cho bảng `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`cat_id`);

--
-- Chỉ mục cho bảng `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`cmt_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Chỉ mục cho bảng `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`);

--
-- Chỉ mục cho bảng `information`
--
ALTER TABLE `information`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Chỉ mục cho bảng `orders_detail`
--
ALTER TABLE `orders_detail`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Chỉ mục cho bảng `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`),
  ADD KEY `cat_id` (`cat_id`);

--
-- Chỉ mục cho bảng `slides`
--
ALTER TABLE `slides`
  ADD PRIMARY KEY (`slide_id`);

--
-- Chỉ mục cho bảng `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `cart`
--
ALTER TABLE `cart`
  MODIFY `cart_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=98;

--
-- AUTO_INCREMENT cho bảng `categories`
--
ALTER TABLE `categories`
  MODIFY `cat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT cho bảng `comments`
--
ALTER TABLE `comments`
  MODIFY `cmt_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT cho bảng `images`
--
ALTER TABLE `images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=141;

--
-- AUTO_INCREMENT cho bảng `information`
--
ALTER TABLE `information`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT cho bảng `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT cho bảng `orders_detail`
--
ALTER TABLE `orders_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT cho bảng `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT cho bảng `slides`
--
ALTER TABLE `slides`
  MODIFY `slide_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT cho bảng `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `cart_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `comments_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `images`
--
ALTER TABLE `images`
  ADD CONSTRAINT `images_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `orders_detail`
--
ALTER TABLE `orders_detail`
  ADD CONSTRAINT `orders_detail_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`order_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `orders_detail_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`cat_id`) REFERENCES `categories` (`cat_id`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
