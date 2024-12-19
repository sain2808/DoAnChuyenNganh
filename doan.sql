-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1:3306
-- Thời gian đã tạo: Th12 09, 2024 lúc 03:50 PM
-- Phiên bản máy phục vụ: 9.1.0
-- Phiên bản PHP: 8.3.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `doan`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `chitietdonhang`
--

DROP TABLE IF EXISTS `chitietdonhang`;
CREATE TABLE IF NOT EXISTS `chitietdonhang` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_donhang` int DEFAULT NULL,
  `id_sanpham` int DEFAULT NULL,
  `soluong` int NOT NULL,
  `order_id` int DEFAULT NULL,
  `product_id` int DEFAULT NULL,
  `product_name` varchar(255) DEFAULT NULL,
  `quantity` int DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `total` decimal(10,2) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_donhang` (`id_donhang`),
  KEY `id_sanpham` (`id_sanpham`)
) ENGINE=MyISAM AUTO_INCREMENT=36 DEFAULT CHARSET=utf8mb3;

--
-- Đang đổ dữ liệu cho bảng `chitietdonhang`
--

INSERT INTO `chitietdonhang` (`id`, `id_donhang`, `id_sanpham`, `soluong`, `order_id`, `product_id`, `product_name`, `quantity`, `price`, `total`) VALUES
(1, NULL, NULL, 0, 15, 14, 'Cá Hắc Kỳ', 3, 8000.00, 24000.00),
(2, NULL, NULL, 0, 15, 16, 'Neon Ruby', 3, 8000.00, 24000.00),
(3, NULL, NULL, 0, 16, 23, 'Hồ Tròn', 3, 350000.00, 1050000.00),
(4, NULL, NULL, 0, 16, 21, 'Cá Dĩa Man Đỏ - Marlboro Red Discus: Viên ngọc đỏ rực trong thế giới thủy sinh', 2, 160000.00, 320000.00),
(5, NULL, NULL, 0, 17, 20, 'Cá Dĩa Bông Xanh - Viên Ngọc Biển trong Thủy Cung', 1, 160000.00, 160000.00),
(6, NULL, NULL, 0, 18, 20, 'Cá Dĩa Bông Xanh - Viên Ngọc Biển trong Thủy Cung', 1, 160000.00, 160000.00),
(7, NULL, NULL, 0, 19, 21, 'Cá Dĩa Man Đỏ - Marlboro Red Discus: Viên ngọc đỏ rực trong thế giới thủy sinh', 1, 160000.00, 160000.00),
(8, NULL, NULL, 0, 20, 21, 'Cá Dĩa Man Đỏ - Marlboro Red Discus: Viên ngọc đỏ rực trong thế giới thủy sinh', 1, 160000.00, 160000.00),
(9, NULL, NULL, 0, 21, 21, 'Cá Dĩa Man Đỏ - Marlboro Red Discus: Viên ngọc đỏ rực trong thế giới thủy sinh', 1, 160000.00, 160000.00),
(10, NULL, NULL, 0, 22, 21, 'Cá Dĩa Man Đỏ - Marlboro Red Discus: Viên ngọc đỏ rực trong thế giới thủy sinh', 1, 160000.00, 160000.00),
(11, NULL, NULL, 0, 23, 20, 'Cá Dĩa Bông Xanh - Viên Ngọc Biển trong Thủy Cung', 1, 160000.00, 160000.00),
(12, NULL, NULL, 0, 24, 21, 'Cá Dĩa Man Đỏ - Marlboro Red Discus: Viên ngọc đỏ rực trong thế giới thủy sinh', 1, 160000.00, 160000.00),
(13, NULL, NULL, 0, 25, 21, 'Cá Dĩa Man Đỏ - Marlboro Red Discus: Viên ngọc đỏ rực trong thế giới thủy sinh', 1, 160000.00, 160000.00),
(14, NULL, NULL, 0, 26, 18, 'Cá Dĩa Bồ Câu Đỏ', 3, 16000.00, 48000.00),
(15, NULL, NULL, 0, 27, 18, 'Cá Dĩa Bồ Câu Đỏ', 1, 16000.00, 16000.00),
(16, NULL, NULL, 0, 27, 20, 'Cá Dĩa Bông Xanh - Viên Ngọc Biển trong Thủy Cung', 1, 160000.00, 160000.00),
(17, NULL, NULL, 0, 28, 21, 'Cá Dĩa Man Đỏ - Marlboro Red Discus: Viên ngọc đỏ rực trong thế giới thủy sinh', 4, 160000.00, 640000.00),
(18, NULL, NULL, 0, 29, 21, 'Cá Dĩa Man Đỏ - Marlboro Red Discus: Viên ngọc đỏ rực trong thế giới thủy sinh', 1, 160000.00, 160000.00),
(19, NULL, NULL, 0, 30, 21, 'Cá Dĩa Man Đỏ - Marlboro Red Discus: Viên ngọc đỏ rực trong thế giới thủy sinh', 5, 160000.00, 800000.00),
(20, NULL, NULL, 0, 30, 15, 'While Tetra', 3, 16000.00, 48000.00),
(21, NULL, NULL, 0, 31, 20, 'Cá Dĩa Bông Xanh - Viên Ngọc Biển trong Thủy Cung', 1, 160000.00, 160000.00),
(22, NULL, NULL, 0, 32, 21, 'Cá Dĩa Man Đỏ - Marlboro Red Discus: Viên ngọc đỏ rực trong thế giới thủy sinh', 1, 160000.00, 160000.00),
(23, NULL, NULL, 0, 33, 21, 'Cá Dĩa Man Đỏ - Marlboro Red Discus: Viên ngọc đỏ rực trong thế giới thủy sinh', 1, 160000.00, 160000.00),
(24, NULL, NULL, 0, 34, 21, 'Cá Dĩa Man Đỏ - Marlboro Red Discus: Viên ngọc đỏ rực trong thế giới thủy sinh', 1, 160000.00, 160000.00),
(25, NULL, NULL, 0, 35, 21, 'Cá Dĩa Man Đỏ - Marlboro Red Discus: Viên ngọc đỏ rực trong thế giới thủy sinh', 1, 160000.00, 160000.00),
(26, NULL, NULL, 0, 36, 21, 'Cá Dĩa Man Đỏ - Marlboro Red Discus: Viên ngọc đỏ rực trong thế giới thủy sinh', 1, 160000.00, 160000.00),
(27, NULL, NULL, 0, 37, 24, 'Ali Thái - African Prince Cichlid', 1, 50000.00, 50000.00),
(28, NULL, NULL, 0, 37, 29, 'Cá Ali Thái - Haplochromis Johnstoni', 1, 50000.00, 50000.00),
(29, NULL, NULL, 0, 37, 23, 'Hồ Tròn', 1, 350000.00, 350000.00),
(30, NULL, NULL, 0, 38, 21, 'Cá Dĩa Man Đỏ - Marlboro Red Discus: Viên ngọc đỏ rực trong thế giới thủy sinh', 2, 160000.00, 320000.00),
(31, NULL, NULL, 0, 38, 16, 'Neon Ruby', 2, 8000.00, 16000.00),
(32, NULL, NULL, 0, 39, 21, 'Cá Dĩa Man Đỏ - Marlboro Red Discus: Viên ngọc đỏ rực trong thế giới thủy sinh', 1, 160000.00, 160000.00),
(33, NULL, NULL, 0, 40, 21, 'Cá Dĩa Man Đỏ - Marlboro Red Discus: Viên ngọc đỏ rực trong thế giới thủy sinh', 1, 160000.00, 160000.00),
(34, NULL, NULL, 0, 41, 29, 'Cá Ali Thái - Haplochromis Johnstoni', 1, 50000.00, 50000.00),
(35, NULL, NULL, 0, 41, 24, 'Ali Thái - African Prince Cichlid', 1, 50000.00, 50000.00);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `danhmuc`
--

DROP TABLE IF EXISTS `danhmuc`;
CREATE TABLE IF NOT EXISTS `danhmuc` (
  `id` int NOT NULL AUTO_INCREMENT,
  `ten` varchar(255) NOT NULL,
  `mota` text,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb3;

--
-- Đang đổ dữ liệu cho bảng `danhmuc`
--

INSERT INTO `danhmuc` (`id`, `ten`, `mota`) VALUES
(1, 'Cá', NULL),
(2, 'Bể cá', NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `donhang`
--

DROP TABLE IF EXISTS `donhang`;
CREATE TABLE IF NOT EXISTS `donhang` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_khachhang` int DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  `fullname` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `total_amount` decimal(10,2) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_khachhang` (`id_khachhang`)
) ENGINE=MyISAM AUTO_INCREMENT=42 DEFAULT CHARSET=utf8mb3;

--
-- Đang đổ dữ liệu cho bảng `donhang`
--

INSERT INTO `donhang` (`id`, `id_khachhang`, `username`, `fullname`, `address`, `phone`, `email`, `total_amount`, `status`) VALUES
(39, NULL, 'admin', 'khoi', '1040011/32 aaa', '2323231451515', 'sain2808@gmail.com', 160000.00, 'Pending'),
(40, NULL, 'admin', 'hoangdat', 'dadad/2323', '0982083608', 'hoangdat753@gmail.com', 160000.00, 'Pending'),
(41, NULL, 'datdom', 'dat', 'đâ', '2232323', 'sain2808@gmail.com', 100000.00, 'Pending');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `hinhanhsanpham`
--

DROP TABLE IF EXISTS `hinhanhsanpham`;
CREATE TABLE IF NOT EXISTS `hinhanhsanpham` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_sanpham` int DEFAULT NULL,
  `duongdan` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_sanpham` (`id_sanpham`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `khachhang`
--

DROP TABLE IF EXISTS `khachhang`;
CREATE TABLE IF NOT EXISTS `khachhang` (
  `id` int NOT NULL AUTO_INCREMENT,
  `ten` varchar(255) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `diachi` text,
  `sodienthoai` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `sanpham`
--

DROP TABLE IF EXISTS `sanpham`;
CREATE TABLE IF NOT EXISTS `sanpham` (
  `id` int NOT NULL AUTO_INCREMENT,
  `ten` varchar(255) NOT NULL,
  `mota` text,
  `gia` decimal(10,2) NOT NULL,
  `hinhanh` varchar(255) DEFAULT NULL,
  `loai` varchar(255) DEFAULT NULL,
  `khuyenmai` tinyint(1) DEFAULT NULL,
  `id_danhmuc` int DEFAULT NULL,
  `soluong` int DEFAULT NULL,
  `trangthai` varchar(255) DEFAULT NULL,
  `thuonghieu` varchar(255) DEFAULT NULL,
  `mota_ngan` text,
  `loaisanpham` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_danhmuc` (`id_danhmuc`)
) ENGINE=MyISAM AUTO_INCREMENT=44 DEFAULT CHARSET=utf8mb3;

--
-- Đang đổ dữ liệu cho bảng `sanpham`
--

INSERT INTO `sanpham` (`id`, `ten`, `mota`, `gia`, `hinhanh`, `loai`, `khuyenmai`, `id_danhmuc`, `soluong`, `trangthai`, `thuonghieu`, `mota_ngan`, `loaisanpham`) VALUES
(18, 'Cá Dĩa Bồ Câu Đỏ', 'Hình dáng: Thân hình dẹt, tròn như chiếc đĩa.\r\nMàu sắc: Có nhiều biến thể màu sắc, nhưng phổ biến nhất là màu đỏ tươi, đỏ cam hoặc đỏ đậm.\r\nKích thước: Có thể đạt kích thước 15-20cm khi trưởng thành.\r\nVây: Vây lưng và vây hậu môn dài, tạo nên vẻ uyển chuyển khi bơi.', 16000.00, 'image/bocaudo.png', 'Cá Dĩa', NULL, 1, 100, 'Còn hàng', NULL, NULL, NULL),
(9, 'Cá Neon Hoàng Đế Xanh - Blue Emperor Tetra', 'Hình dáng: Cơ thể thon dài, dẹt hai bên.\r\nMàu sắc:\r\nThân: Màu xanh lam óng ánh, chuyển dần sang màu bạc ở phần bụng.\r\nVây: Vây lưng và vây hậu môn có màu xanh lam đậm, vây đuôi dài và có màu xanh lam với viền trắng hoặc trong suốt.\r\nKích thước: Cá trưởng thành có thể đạt kích thước khoảng 4-5cm.\r\nVây: Vây lưng cao và nhọn, vây đuôi dài và chia thùy.\r\nNguồn gốc: Cá Neon Hoàng Đế Xanh có nguồn gốc từ các con sông ở Colombia và Venezuela.', 14000.00, 'image/ca-neon-hoang-de-tim.webp', 'Cá Neon', NULL, 1, 236, 'Còn hàng', NULL, NULL, NULL),
(36, 'Cá Lemon Tetra', 'Màu sắc: Đúng như tên gọi, cá Lemon Tetra sở hữu một màu vàng chanh tươi sáng, nổi bật trên nền xanh của bể thủy sinh. Vây lưng của chúng thường có màu đen, tạo nên sự tương phản độc đáo.\r\nKích thước: Cá Lemon Tetra tương đối nhỏ, khi trưởng thành chỉ đạt khoảng 5-7 cm.\r\nHình dáng: Cơ thể cá thon dài, dẹt hai bên, mắt to và tròn.\r\nTập tính: Cá Lemon Tetra là loài cá sống theo đàn, hòa bình và ưa hoạt động. Bạn nên nuôi ít nhất 6 con trong một bể để chúng cảm thấy thoải mái và thể hiện hết vẻ đẹp tự nhiên.', 15000.00, 'image/Screenshot 2024-12-09 220854.png', 'Cá Neon', NULL, 1, 76, 'Còn hàng', NULL, NULL, NULL),
(16, 'Cá Neon Hoàng Đế Đuôi Kiếm (Emperor Tetra)', 'Hình dáng: Thân hình thon dài, dẹt hai bên.\r\nMàu sắc:\r\nThân: Màu xanh đen óng ánh, chuyển dần sang màu bạc ở phần bụng. Có một sọc đen nổi bật chạy dọc theo thân.\r\nVây: Vây lưng có hình lưỡi liềm, vây hậu môn và vây ngực có màu vàng nhạt. Đuôi dài, xẻ thùy sâu, tạo hình dáng như một thanh kiếm.\r\nKích thước: Cá trưởng thành đạt kích thước khoảng 3-5 cm.\r\nVây: Vây lưng cao và nhọn, vây đuôi dài và chia thùy sâu.\r\nNguồn gốc: Cá Neon Hoàng Đế Đuôi Kiếm có nguồn gốc từ lưu vực sông Atrato và San Juan ở phía Tây Colombia.', 18000.00, 'image/neon-hoang-de-1.webp', 'Cá Neon', NULL, 1, 100, 'Còn hàng', NULL, NULL, NULL),
(20, 'Cá Dĩa Bông Xanh - Viên Ngọc Biển trong Thủy Cung', 'Nguồn gốc: Xuất xứ từ các con sông ở Nam Mỹ, đặc biệt là sông Amazon.\r\nKích thước: Khi trưởng thành, cá dĩa bông xanh có thể đạt kích thước từ 15-20cm.\r\nMôi trường sống lý tưởng\r\nĐể cá dĩa bông xanh phát triển khỏe mạnh và khoe sắc, bạn cần tạo ra một môi trường sống giống với tự nhiên nhất:\r\n\r\nĐộ pH: 7\r\nNhiệt độ: 28-30 độ C\r\nChất lượng nước: Nước cần sạch, ổn định và giàu oxy.\r\nÁnh sáng: Ánh sáng dịu nhẹ, không quá chói.\r\nCây thủy sinh: Một số loại cây thủy sinh có thể giúp cải thiện chất lượng nước và tạo không gian sống tự nhiên cho cá.\r\nMàu sắc: Màu xanh lam là màu chủ đạo, kết hợp với các hoa văn và đốm xanh ngọc đặc trưng.', 160000.00, 'image/diaxanh.png', 'Cá Dĩa', NULL, 1, 100, 'Còn hàng', NULL, NULL, NULL),
(30, 'Cá Dĩa Hoa Hồng - Pink Rose Discus', 'Hình dáng: Thân hình tròn dẹt đặc trưng của cá dĩa.\r\nMàu sắc: Chủ đạo là màu hồng, có thể có các sắc độ hồng khác nhau từ nhạt đến đậm, đôi khi pha lẫn các màu khác như đỏ, vàng.\r\nKích thước: Cá trưởng thành có thể đạt kích thước 15-20 cm.\r\nVây: Vây lưng và vây hậu môn dài, tạo nên vẻ uyển chuyển khi bơi.', 160000.00, 'image/Screenshot 2024-12-09 215341.png', 'Cá Dĩa', NULL, 1, 62, 'Còn hàng', NULL, NULL, NULL),
(21, 'Cá Dĩa Man Đỏ - Marlboro Red Discus: Viên ngọc đỏ rực trong thế giới thủy sinh', 'Cá dĩa Man Đỏ hay Marlboro Red Discus là một trong những biến thể cá dĩa được yêu thích nhất bởi màu đỏ tươi nổi bật và độ bóng mượt của vảy. Cái tên \"Marlboro Red\" được đặt theo thương hiệu thuốc lá nổi tiếng, thể hiện màu đỏ đặc trưng của loài cá này.\r\nĐể cá dĩa Man Đỏ phát triển khỏe mạnh và màu sắc rực rỡ nhất, bạn cần tạo ra một môi trường sống ổn định và phù hợp:\r\n\r\nĐộ pH: 7\r\nNhiệt độ: 28-30 độ C\r\nChất lượng nước: Nước cần sạch, ổn định và giàu oxy.\r\nÁnh sáng: Ánh sáng dịu nhẹ, không quá chói để làm nổi bật màu sắc của cá.', 160000.00, 'image/diado.png', 'Cá Dĩa', NULL, 1, 100, 'Còn hàng', NULL, NULL, NULL),
(24, 'Ali Thái - African Prince Cichlid', 'Hình dáng: Thân hình thuôn dài, dẹt bên.\r\nMàu sắc: Cá đực thường có màu sắc sặc sỡ, nổi bật với màu vàng, cam, đỏ, xanh dương. Cá cái thường có màu sắc nhạt hơn, thường là màu xám bạc hoặc nâu.\r\nKích thước: Cá đực có thể đạt kích thước 12-15cm, cá cái nhỏ hơn, khoảng 8-10cm.\r\nVây: Vây lưng dài, vây đuôi xẻ thùy.', 50000.00, 'image/alivang.png', 'Cá Ali', NULL, 1, 47, 'Còn hàng', NULL, NULL, NULL),
(28, 'Ali Thái - Pundamilia Nyererei', 'Cá Ali Thái - Pundamilia Nyererei là loài cá Cichlid nhỏ, có nguồn gốc từ Hồ Victoria ở Châu Phi. Cá đực nổi bật với màu xanh lam óng ánh và sọc đỏ, trong khi cá cái có màu xám bạc. Chúng thích sống theo đàn ở tầng nước giữa và tầng đáy.', 250000.00, 'image/ali7mau.png', 'Cá Ali', NULL, 1, 10, 'Còn hàng', NULL, NULL, NULL),
(29, 'Cá Ali Thái - Haplochromis Johnstoni', 'Cá Ali Thái - Haplochromis Johnstoni là loài cá Cichlid có nguồn gốc từ hồ Malawi ở Châu Phi. Cá đực trưởng thành có màu sắc rực rỡ với thân hình xanh dương đậm và viền vây màu cam hoặc đỏ nổi bật.', 50000.00, 'image/ali hoi vang.png', 'Cá Ali', NULL, 1, 0, 'Hết hàng', NULL, NULL, NULL),
(26, 'Ali Thái - Albino Pseudotropheus Ice Blue', 'Hình dáng: Thân hình thuôn dài, dẹt bên, tương tự như các loài cá Cichlid khác.\r\nMàu sắc:\r\nCá thể bình thường: Có màu xanh lam nhạt hoặc xám bạc.\r\nBiến thể Albino: Thân màu trắng hoặc hồng nhạt, đôi khi có ánh xanh rất nhạt. Vây có thể có màu vàng nhạt hoặc cam.\r\nKích thước: Cá đực có thể đạt kích thước 10-12cm, cá cái nhỏ hơn, khoảng 8-10cm.\r\nVây: Vây lưng dài, vây đuôi xẻ thùy.', 50000.00, 'image/aliice.png', 'Cá Ali', NULL, 1, 23, 'Còn hàng', NULL, NULL, NULL),
(31, 'Hồ 1', '', 35000.00, 'image/Screenshot 2024-12-09 215550.png', 'Hồ Cá', NULL, 2, 10, 'Còn hàng', NULL, NULL, NULL),
(32, 'Hồ 2', '', 450000.00, 'image/Screenshot 2024-12-09 215602.png', 'Hồ Cá', NULL, 1, 10, 'Còn hàng', NULL, NULL, NULL),
(33, 'Hồ 3', '', 1000000.00, 'image/Screenshot 2024-12-09 215626.png', 'Hồ Cá', NULL, 2, 5, 'Còn hàng', NULL, NULL, NULL),
(34, 'Hồ 4', '', 375000.00, 'image/Screenshot 2024-12-09 215608.png', 'Hồ Cá', NULL, 2, 3, 'Còn hàng', NULL, NULL, NULL),
(35, 'White Fin Tetra ', 'Hình dáng: Thân hình thon dài, dẹt hai bên.\r\nMàu sắc:\r\nThân: Màu bạc hoặc xám bạc.\r\nVây: Vây lưng và vây hậu môn có màu trắng nổi bật, các vây khác thường trong suốt hoặc có màu vàng nhạt.\r\nKích thước: Cá trưởng thành có thể đạt kích thước khoảng 5-6 cm.\r\nVây: Vây lưng cao và nhọn, vây đuôi xẻ thùy.\r\nNguồn gốc: White Fin Tetra có nguồn gốc từ các con sông ở Nam Mỹ, bao gồm Paraguay, Uruguay, Argentina và Brazil.', 32000.00, 'image/Screenshot 2024-12-09 220726.png', 'Cá Neon', NULL, 1, 23, 'Còn hàng', NULL, NULL, NULL),
(41, 'Cá Betta Dragon Red', 'Màu sắc: Toàn thân cá Betta Dragon Red được bao phủ bởi sắc đỏ rực rỡ, nổi bật. Màu đỏ này có thể có nhiều sắc thái khác nhau, từ đỏ tươi, đỏ cam đến đỏ đậm, tùy thuộc vào từng cá thể.\r\nVảy: Lớp vảy rồng dày, óng ánh đặc trưng của dòng cá Dragon càng thêm phần nổi bật trên nền đỏ rực rỡ. Khi cá di chuyển dưới ánh sáng, lớp vảy này lấp lánh, tạo nên hiệu ứng thị giác vô cùng ấn tượng.\r\nVây: Vây của cá Dragon Red thường dài và rủ xuống, có thể là dạng Halfmoon, Crowntail hoặc các dạng khác. Vây cá chuyển động uyển chuyển, mềm mại, góp phần tạo nên vẻ đẹp kiêu sa, lộng lẫy.\r\nThần thái: Cá Dragon Red thường có thần thái mạnh mẽ, năng động, toát lên vẻ kiêu hãnh, tự tin.', 80000.00, 'image/Screenshot 2024-12-09 222026.png', 'Cá Betta', NULL, 1, 12, 'Còn hàng', NULL, NULL, NULL),
(40, 'Cá Betta Dragon Black', 'Màu sắc: Đúng như tên gọi, toàn thân cá Betta Dragon Black được bao phủ bởi một màu đen tuyền, đậm và sâu thẳm. Màu đen này có thể thay đổi sắc độ dưới ánh sáng khác nhau, tạo nên vẻ đẹp lấp lánh, huyền ảo.\r\nVảy: Đặc trưng của dòng cá Rồng là lớp vảy dày, óng ánh, phản chiếu ánh sáng mạnh mẽ. Ở cá Dragon Black, lớp vảy này càng thêm nổi bật trên nền đen tuyền, tạo hiệu ứng thị giác vô cùng ấn tượng.\r\nVây: Vây của cá Dragon Black thường dài và rủ xuống, có thể là dạng Halfmoon, Crowntail hoặc các dạng khác. Khi cá di chuyển, vây chuyển động uyển chuyển, mềm mại, tạo nên vẻ đẹp uy nghi, lộng lẫy.\r\nThần thái: Cá Dragon Black thường có thần thái mạnh mẽ, kiêu hãnh, toát lên vẻ uy nghiêm, quyền lực.', 80000.00, 'image/Screenshot 2024-12-09 222052.png', 'Cá Betta', NULL, 1, 14, 'Còn hàng', NULL, NULL, NULL),
(42, 'Cá Betta Dragon Yellow', 'Màu sắc: Toàn thân cá Betta Dragon Yellow được bao phủ bởi sắc vàng tươi sáng, rực rỡ. Màu vàng này có thể có nhiều sắc thái khác nhau, từ vàng chanh, vàng cam đến vàng đậm, tùy thuộc vào từng cá thể.\r\nVảy: Lớp vảy rồng dày, óng ánh đặc trưng của dòng cá Dragon càng thêm phần nổi bật trên nền vàng tươi sáng. Khi cá di chuyển dưới ánh sáng, lớp vảy này lấp lánh, tạo nên hiệu ứng thị giác vô cùng ấn tượng.\r\nVây: Vây của cá Dragon Yellow thường dài và rủ xuống, có thể là dạng Halfmoon, Crowntail hoặc các dạng khác. Vây cá chuyển động uyển chuyển, mềm mại, góp phần tạo nên vẻ đẹp thướt tha, uyển chuyển.\r\nThần thái: Cá Dragon Yellow thường có thần thái mạnh mẽ, năng động, toát lên vẻ quý phái, sang trọng.', 80000.00, 'image/Screenshot 2024-12-09 222035.png', 'Cá Betta', NULL, 1, 12, 'Còn hàng', NULL, NULL, NULL),
(43, 'Cá Betta Dumbo Halfmoon', 'Vây tai: Đặc trưng của dòng Dumbo là cặp vây ngực (vây tai) cực kỳ lớn, xòe rộng như tai voi. Điều này tạo nên vẻ ngoài độc đáo, dễ thương cho cá.\r\nĐuôi: Đuôi của cá Betta Dumbo Halfmoon xòe rộng 180 độ khi xòe hết cỡ, tạo thành hình bán nguyệt hoàn hảo. Vây lưng và vây hậu môn cũng rất dài và rủ xuống.\r\nMàu sắc: Đa dạng, từ đỏ, xanh, vàng, cam đến các màu pastel, thậm chí có cả những con mang nhiều màu sắc kết hợp.\r\nKích thước: Tương đương với các dòng Betta khác, khoảng 5-7cm khi trưởng thành.', 70000.00, 'image/Screenshot 2024-12-09 222044.png', 'Cá Betta', NULL, 1, 15, 'Còn hàng', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `full_name` varchar(255) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `address` text,
  `role` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb3;

--
-- Đang đổ dữ liệu cho bảng `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `email`, `full_name`, `phone`, `address`, `role`, `created_at`, `updated_at`) VALUES
(1, 'hoang dat', '123', 'hoangdat753@gmail.com', NULL, NULL, NULL, NULL, '2024-11-28 12:20:31', '2024-11-28 12:20:31'),
(2, '', 'datcon123', 'datdom113@gmail.com', NULL, NULL, NULL, NULL, '2024-11-28 12:22:53', '2024-11-28 12:22:53'),
(3, 'datdom', '$2y$10$leGk3NWkrNqh6XzC7dqFKeW8auAMGIKyopx7fbWWvHGFamO/n.7u.', 'sain2808@gmail.com', 'datdommm', '0982083608', 'dâdadadad', NULL, '2024-11-28 12:38:52', '2024-11-28 12:38:52'),
(7, 'admin', '$2y$10$EcofC8qLJaJiuYXl8h6cmejNgTYcMoJEcadRMonT9v9hmXd.Kfay6', 'admin@gmail.com', 'admin', '0982083608', 'dâd', 'admin', '2024-12-07 04:57:12', '2024-12-07 04:57:33'),
(6, 'cuc cung', '$2y$10$VrGpdka9UIPEAWfalwJR5eYR/tJzl2ywBbg/FotfvUgW7rLXt0sf.', 'datdom115@gmail.com', 'cuc dang', '0982083608', '232323dada', NULL, '2024-12-07 04:52:50', '2024-12-07 04:52:50');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
