-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: May 22, 2023 at 07:54 AM
-- Server version: 8.0.31
-- PHP Version: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dbmypham`
--

-- --------------------------------------------------------

--
-- Table structure for table `chitiethoadon`
--

CREATE TABLE `chitiethoadon` (
  `mahd` int NOT NULL,
  `masp` int NOT NULL,
  `soluong` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `chitiethoadon`
--

INSERT INTO `chitiethoadon` (`mahd`, `masp`, `soluong`) VALUES
(4, 1, 2),
(4, 2, 2),
(4, 3, 5),
(4, 4, 1),
(5, 1, 1),
(5, 2, 3),
(5, 3, 2),
(5, 4, 1),
(6, 2, 5),
(6, 6, 1),
(6, 7, 1),
(7, 1, 4),
(7, 2, 3),
(8, 1, 1),
(8, 2, 1),
(9, 1, 2),
(9, 2, 1),
(9, 3, 3),
(10, 2, 1),
(10, 3, 2),
(10, 4, 1);

-- --------------------------------------------------------

--
-- Table structure for table `hoadon`
--

CREATE TABLE `hoadon` (
  `mahd` int NOT NULL,
  `username` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `ngaythanhtoan` date DEFAULT NULL,
  `thanhtien` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `hoadon`
--

INSERT INTO `hoadon` (`mahd`, `username`, `ngaythanhtoan`, `thanhtien`) VALUES
(4, 'user1', '2023-05-21', 3555000),
(5, 'user5', '2023-05-21', 3117000),
(6, 'user5', '2023-05-21', 3672000),
(7, 'user1', '2023-05-22', 4005000),
(8, 'user7', '2023-05-22', 1170000),
(9, 'user8', '2023-05-22', 2283000),
(10, 'user1', '2023-05-22', 1272000);

-- --------------------------------------------------------

--
-- Table structure for table `loai`
--

CREATE TABLE `loai` (
  `maloai` int NOT NULL,
  `tenloai` text COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `loai`
--

INSERT INTO `loai` (`maloai`, `tenloai`) VALUES
(1, 'Kem chống nắng'),
(2, 'Son môi'),
(3, 'Sữa rửa mặt'),
(4, 'Tẩy trang'),
(5, 'Kem dưỡng');

-- --------------------------------------------------------

--
-- Table structure for table `sanpham`
--

CREATE TABLE `sanpham` (
  `masp` int NOT NULL,
  `tensp` text COLLATE utf8mb4_general_ci NOT NULL,
  `hinhanh` text COLLATE utf8mb4_general_ci NOT NULL,
  `gia` int NOT NULL,
  `mota` text COLLATE utf8mb4_general_ci NOT NULL,
  `maloai` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sanpham`
--

INSERT INTO `sanpham` (`masp`, `tensp`, `hinhanh`, `gia`, `mota`, `maloai`) VALUES
(1, 'Kem Chống Nắng Mỏng Nhẹ Bảo Vệ Tối Ưu La Roche-Posay Anthelios UVMune400 Invisible Fluid SPF50+ 50Ml', 'KCN01.png', 495000, 'là dòng sản phẩm với màng lọc độc quyền MEXORYL 400 mới có khả năng chống nắng phổ rộng, bảo vệ da toàn diện trước tất cả tác hại từ tia UVA dài, UVB, IR-A.', 1),
(2, 'Gel Chống Nắng Dưỡng Sáng, Ngừa Thâm Nám Vichy Capital Soleil Uv Age Daily 50Ml', 'KCN02.png', 675000, 'Gel chống nắng dưỡng sáng, ngăn ngừa thâm nám đốm nâu Vichy Capital Soleil UV Age Daily kết hợp tối ưu công nghệ chống nắng độc đáo INUTEC giúp ngăn cản tia cực tím tối đa & có kết cấu mỏng nhẹ như nước. Sản phẩm là bước tiếp nối thành công của dòng dưỡng LIFTACTIV & thuộc Top sản phẩm bán chạy nhất.', 1),
(3, 'Kem Chống Nắng Solar Smart UV Protector Carasun 70Ml', 'KCN03.png', 206000, 'Kem chống nắng với SPF 45 PA++++ bảo vệ da dưới tác hại của tia UVA, UVB và ánh nắng mặt trời. Cung cấp dưỡng chất nuôi dưỡng da. Cấp ẩm cho da, giữ da luôn tươi trẻ', 1),
(4, 'Tinh Chất Chống Nắng Sunplay Skin Aqua Hiệu Chỉnh Sắc Da Tone Up UV Latte Beige SPF50+ PA++++ 50g', 'KCN04.png', 185000, 'Chống nắng hiệu quả với SPF50+, PA++++ giúp ngăn ngừa đen sạm, nám, nếp nhăn, đốm nâu... Hiệu chỉnh tông da tái xanh, che phủ khuyết điểm tự nhiên giúp da ửng hồng. Giữ ẩm và dưỡng sáng da. Không chứa cồn, có thể làm lớp lót trang điểm', 1),
(5, 'Son Kem Lì Merzy The First Velvet Tint Green Edition', 'SON01.jpg ', 159000, 'Son Kem Lì, Bền Màu, Lâu Trôi Merzy The First Velvet Tint V6 Xanh Lá Green Edition là son kem lì đến từ thương hiệu Merzy nằm trong phiên bản giới hạn mới mang vỏ màu xanh, son có kết cấu chất son nhung mềm,mướt mịn với thông điệp #beyourself chính là lời nhắn gửi tới một nửa xinh đẹp của thế giới. ', 2),
(6, 'Son Tint Nước Siêu Lì Romand Glasting Water Tint 4g', 'SON02.jpg ', 148000, 'Son Tint Nước Siêu Lì, Lâu Trôi Romand Glasting Water Tint là son tint lì của thương hiệu Romand có chất son tint bóng tự như một lớp màng nước lướt nhẹ trên môi, chứa nhiều dưỡng chất giúp nuôi dưỡng đôi môi, son lên môi nhẹ và mướt mịn, dễ tán đều cùng với bảng màu rực rỡ đa dạng mang đến cho bạn đôi môi căng mọng tràn đầy sức sống, tự tin cả ngày dài.', 2),
(7, 'Son Kem Lì Etude Crema Velvet Tint 3.6g', 'SON03.jpg ', 149000, 'Son Kem Lì, Mịn Mượt Như Nhung Etude Crema Velvet ', 2),
(8, 'Son Dưỡng Môi The Cocoon Ben Tre Coconut Lip Balm 5g', 'SON04.jpg ', 56000, 'Son Dưỡng Môi Chiết Xuất Dầu Dừa Bến Tre The Cocoon Ben Tre Coconut Lip Balm là son dưỡng thuộc thương hiệu Cocoon với thành phần chính là dầu dừa có nguồn gốc từ Bến Tre, được bổ sung chiết xuất bơ hạt mỡ và vitamin E giúp mang lại đôi môi mềm mượt, hồng hào, chống khô môi, nứt nẻ do thời tiết  thuộc thương hiệu mỹ phẩm thuần chay Cocoon đến từ Việt Nam.', 2),
(9, 'Son Dearmay California Cherry Velvet Tint 4.4g', 'SON05.jpg ', 199000, 'Son Kem Lì, Lên Màu Chuẩn Dearmay California Cherry Velvet Tint là son kem lì thuộc thương hiệu Dearmay với kết cấu son velvet tint mịn mượt mang đến một đôi môi mịn lì hoàn hảo, cho bạn đôi môi ngọt ngào, xinh xắn thu hút mọi ánh nhìn.', 2),
(10, 'Son Thỏi Cao Cấp G9Skin First V-Fit Lipstick', 'SON06.jpg ', 129000, 'Son Thỏi Lì Chất Siêu Mịn, Vỏ Vàng Cao Cấp G9Skin First V-Fit Lipstick là son thỏi đến từ thương hiệu G9Skin với thiết kế vẻ ngoài sang trọng cùng bảng màu quyến rũ, rạng rỡ lôi cuốn cho bạn vẻ đẹp tinh tế, thời thượng thu hút mọi ánh nhìn.', 2),
(11, 'Sữa Rửa Mặt Cosrx Low pH Good Morning Gel Cleanser', 'SRM01.jpg', 137000, 'Sữa Rửa Mặt Dạng Gel Cosrx Low PH Good Morning Gel Cleanser là dòng sữa rửa mặt dịu nhẹ, thuộc thương hiệu Cosrx. Có độ pH gần như là làn da tự nhiên có khả năng làm sạch mà không gây khô căng da, dễ dàng làm sạch bụi bẩn, bã nhờn và lớp trang điểm, mang đến làn da sạch mịn, thông thoáng lỗ chân lông.', 3),
(12, 'Sữa Rửa Cetaphil Gentle Skin Cleanser', 'SRM02.jpg', 568000, 'Sữa Rửa Mặt Cetaphil Gentle Skin Cleanser là sữa rửa mặt với công thức lành tính giúp làm sạch bụi bẩn một cách nhẹ nhàng. Bên cạnh đó, Cetaphil Skin Cleanser còn không gây bít tắc lỗ chân lông, có khả năng duy trì độ ẩm tự nhiên và phù hợp với mọi loại da, kể cả làn da mỏng manh của bé sơ sinh thuộc thương Cetaphil được bác sĩ da liễu khuyên dùng đến từ Canada.', 3),
(13, 'Sữa Rửa Mặt Nhật Bản Hatomugi Cleansing & Facial Washing 130g', 'SRM03.jpg', 38000, 'Sữa Rửa Mặt Tẩy Trang & Làm Sáng Da Nhật Bản Hatomugi Cleansing & Facial Washing 130g là sữa rửa mặt thuộc thương hiệu Hatomugi giúp làm sạch bụi bẩn, dầu nhờn và dưỡng sáng da từ những thành phần tự nhiên như chiết xuất Ý Dĩ, Trái Đào, Lô Hội và tinh dầu hoa Trà Nhật Bản, mang đến làn da mịn màng, sáng hồng tự nhiên. Sản phẩm có thể dùng thay thế tẩy trang.', 3),
(14, 'Sữa Rửa Mặt Caryophy Portulaca Cleansing Foam 150ml', 'SRM04.jpg', 239000, 'Sữa Rửa Mặt Làm Sạch Sâu, Phục Hồi Da Caryophy Portulaca Cleansing Foam  là sữa rửa mặt với công thức chứa các thành phần lành tính như rau má, rau sam và xô thơm giúp vừa làm sạch sâu lỗ chân lông, quản lí điều tiết dầu nhờn, đặc biệt giúp kháng khuẩn, làm dịu và thúc đẩy nhanh quá trình phục hồi các thương tổn cho làn da mụn thuộc thương thuộc thương hiệu Caryophy đến từ Hàn Quốc', 3),
(15, 'Sữa Rửa Mặt Meishoku Bigan Facial Wash  15ml', 'SRM05.jpg', 41000, 'Sữa Rửa Mặt Tạo Bọt Ngăn Ngừa Mụn Meishoku Bigan Facial Wash là sữa rửa mặt thuộc thương hiệu Meishoku với công thức đặc biệt cùng hoạt chất Acid Salicylic không chỉ giúp làm thông thoáng lỗ chân lông, loại bỏ dầu nhờn, tế bào chết già cỗi mà còn cải thiện da mụn hiệu quả. Kết cấu bọt dày, mịn, siêu nhỏ dễ dàng  làm sạch hoàn toàn bụi bẩn và lớp trang điểm còn sót lại', 3),
(16, 'Sữa Rửa Useemi Gluta Plus Brightening Foam Cleanser 150ml', 'SRM06.jpg', 159000, 'Sữa Rửa Mặt Tạo Bọt Làm Sáng Da Dưỡng Trắng Useemi Gluta Plus Brightening Foam Cleanser là sữa rửa mặt  Chứa thành phần Niacinamide, Glutathione và vitamin E có khả năng làm sạch mọi bụi bẩn, lớp trang điểm và các tạp chất, làm sáng da và dưỡng trắng thuộc thương hiệu Useemi đến từ Hàn Quốc', 3),
(17, 'Dầu Tẩy Trang Cho Mọi Loại Da Biore 150Ml', 'TT01.png', 159000, 'Dầu tẩy trang Biore với công thức đặc biệt sẽ hòa tan lớp trang điểm dày trên mặt, tẩy sạch bụi bẩn, bã nhờn bám trên da, kể cả mascara không trôi mà không để lại cảm giác nhờn rít, khó chịu sau khi sử dụng. Có thể sử dụng sản phẩm khi mặt và tay đang ướt mà không sợ ảnh hưởng tới hiệu quả tẩy trang. Sản phẩm được nhập khẩu trực tiếp từ Nhật Bản.\r\n', 4),
(18, 'Dầu Tẩy Trang Dưỡng Ẩm Advanced Nourish Hyaluronic Acid Cleansing Oil Hada Labo 200Ml', 'TT02.png', 181000, 'Advanced Nourish Hyaluron Cleansing Oil là sản phẩm tẩy trang với thành phần gồm Dầu Ô liu tinh khiết kết hợp cùng HA và SHA nhẹ nhàng làm sạch hiệu quả lớp trang điểm (kể cả mascara không trôi), giữ da luôn ẩm mượt và sáng mịn và khỏe mạnh hơn thấy rõ chỉ sau 4 tuần sử dụng đều đặn, đặc biệt an toàn và dịu nhẹ cho da, không gây cảm giác căng bóng, khó chịu sau khi sử dụng', 4),
(19, 'Dầu Tẩy Trang Dưỡng Ẩm Gokujyun Hada Labo 200Ml', 'TT03.png', 315000, 'Dầu Tẩy Trang Hada Labo Gokujyun Cleansing Oil là sản phẩm tẩy trang dạng dầu, sản phẩm sử dụng dầu Olive tinh khiết giúp nhanh chóng làm sạch lớp makeup kể cả sản phẩm lâu trôi & chống thấm nước, bổ sung thêm Super Hyaluronic Acid cấp nước và dưỡng ẩm sâu cho da mềm mịn, không khô căng sau khi tẩy trang. Công thức không chứa các thành phần có khả năng gây kích ứng, an toàn và dịu nhẹ cho mọi loại da', 4),
(20, 'Dầu Tẩy Trang Dưỡng Da dProgram 120Ml', 'TT04.png', 392000, 'Dầu Tẩy Trang Dưỡng Da dProgram 120Ml. Dầu tẩy trang dưỡng da dProgram được sản xuất tại Nhật Bản, dịu nhẹ làm sạch bụi bẩn ô nhiễm và lớp trang điểm khó trôi mà không gây ma sát lên da. Sản phẩm dịu nhẹ có thể dùng để tẩy trang mắt môi. Thích hợp cho mọi lọai da đặc biệt là da nhạy cảm', 4),
(21, 'Kem Dưỡng Dạng Gel Hatherine Morning Boost Clear Firming Cream 50ml', 'KEM01.jpg', 149000, 'Kem Dưỡng Dạng Gel Chống Lão Hóa, Đàn Hồi Da Hatherine Morning Boost Clear Firming Cream  là kem dưỡng với công thức không chứa dầu với kết cấu mỏng nhẹ có khả năng nạp đầy độ ẩm cho da. Chứa chiết xuất hoa cải dầu, Asparagus Officinalis Extract, và 3 loại Peptide giúp tăng sinh đàn hồi cho da, ngăn ngừa tình trạng lão hóa hiệu quả  thuộc thương hiệu Hatherine đến từ Hàn Quốc', 5),
(22, 'Kem Dưỡng Dạng Gel Hatherine Morning Boost Clear Firming Cream 50ml', 'KEM02.jpg', 337000, 'Gel Dưỡng Ẩm, Dưỡng Trắng Da Chiết Xuất Cây Hắc Mai Biển I\'m From Vitamin Tree Water Gel là dòng kem dưỡng dạng gel, với chiết xuất thành phần chính là lá Hắc Mai Biển, Niacinamide giúp dưỡng trắng da hiệu quả, dưỡng ẩm cho da luôn mềm mại, bảo vệ da khỏi các tác nhân bên ngoài môi trường thuộc thương hiệu mỹ phẩm I\'m From đến từ Hàn Quốc.', 5),
(23, 'Kem Dưỡng Ẩm, Cấp Nước Neutrogena Hydro Boost Water Gel', 'KEM03.jpg', 88000, 'Kem Dưỡng Ẩm, Cấp Nước Neutrogena Hydro Boost Water Gel là dòng kem dưỡng da thuộc thương hiệu dược mỹ phẩm Neutrogena đến từ Mỹ. Sở hữu công nghệ Hydro Boost độc quyền cùng các thành phần dưỡng chất thiết yếu giúp cấp nước và khóa ẩm suốt 72h, tăng cường hàng rào bảo vệ da tự nhên nuôi dưỡng làn da luôn khỏe đẹp.', 5),
(24, 'Kem Dưỡng Trắng Da, Mờ Thâm Nám Chỉ Trong 7 Ngày Angel\'s Liquid 7 Day Glutathione 700 V-Cream 50ml ', 'KEM04.jpg', 372000, 'Kem Dưỡng Trắng Da, Mờ Thâm Nám Chỉ Trong 7 Ngày Angel\'s Liquid 7 Day Glutathione 700 V-Cream là kem dưỡng trắng đặc trị thâm nám đến từ thương hiệu Angel\'s Liquid, sản phẩm giúp loại bỏ lớp da xỉn màu và cân bằng độ ẩm mang lại hiệu quả cải thiện tông màu da cũng như giữ ẩm giúp da mềm mại mịn màng chỉ sau vài lần sử dụng', 5),
(25, 'Kem Dưỡng Da Klairs Midnight Blue Calming Cream', 'KEM05.jpg', 367000, 'Kem Dưỡng Da Làm Dịu, Phục Hồi Da Ban Đêm Klairs Midnight Blue Calming Cream 60ml là kem dưỡng với thành phần chính là Guaiazulene có nguồn gốc từ hoa cúc  và chiết xuất rau má Giúp phục hồi và làm dịu các vùng da đang dị ứng hoặc sưng đỏ, làm giảm vết sưng tấy, phục hồi làn da bị tổn thương, hình thành hàng rào dưỡng ẩm bảo vệ da khỏe mạnh, àm dịu da và giảm các tác hại do tia UV thuộc thương hiệu Klairs đến từ Hàn Quốc.', 5),
(26, 'Kem Dưỡng  AHA-BHA-PHA 30 Days Miracle Cream 60g', 'KEM06.jpg', 289000, 'Kem Dưỡng \"Thần Kỳ\" Some By Mi AHA-BHA-PHA 30 Days Miracle Cream là kem dưỡng thuộc dòng AHA-BHA-PHA của thương hiệu Some By Mi kết hợp cả 3 thành phần AHA/BHA/PHA giúp loại bỏ tế bào chết, bổ sung độ ẩm và chứa chiết xuất rau má, tràm trà...giúp làm dịu và chăm sóc da mụn', 5),
(30, 'Dưỡng ẩm Hatomugi', 'image.jpg', 150000, 'Dưỡng ẩm giúp cấp ẩm', 1),
(31, 'Sữa dưỡng thể vaseline', 'image-1.jpg', 280000, 'Giữ ẩm da vừa ban đêm giúp khỏe khoắn ', 1);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `password` text COLLATE utf8mb4_general_ci NOT NULL,
  `role` text COLLATE utf8mb4_general_ci NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`password`, `role`, `username`) VALUES
('$2y$10$jxs7q5hiQQkKmoYWeM/AAepln0uLBJQS3O/DdS0xHLqOVrUM/UyVe', 'admin', 'admin1'),
('$2y$10$iccZCIJ.7qO2vLlSFTZ1Oush27eoGcezibwltDEsru0KgvE4YQEra', 'admin', 'admin2'),
('$2y$10$jxs7q5hiQQkKmoYWeM/AAepln0uLBJQS3O/DdS0xHLqOVrUM/UyVe', 'user', 'user1'),
('$2y$10$ulhVwAh8fp91v3..6SLZoeClx5eB.V751e46CjEoyqXJUzrjd3cLG', 'user', 'user2'),
('$2y$10$PSB08lzSk6XfX3JuOcOEK.LUwoHDiXlwqUlO.Ile4lenqUb4gcVcS', 'user', 'user3'),
('$2y$10$jlJZXEH3Xu5uGxNqQjB49.WlGV5GrTYkptUGdjVpTY7w6ThwsuJrq', 'user', 'user4'),
('$2y$10$OuZSy7WEvaqjMJlZvHLjpOFDLUMxFHPwQEGaQ/Arzfj8HF9U8n56i', 'user', 'user5'),
('$2y$10$4zk5m2H1L3HEi8eu20Ftcu84htd5voPSvT.D9b.w2fhlyEVgOK.HO', 'user', 'user6'),
('$2y$10$coLDAV0vdh4bfXQU12JepO.Thv2beTEM8bREvV7BnQJ/GQqoJHNXu', 'user', 'user7');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `chitiethoadon`
--
ALTER TABLE `chitiethoadon`
  ADD PRIMARY KEY (`mahd`,`masp`),
  ADD KEY `fk_sanpham_chitiethoadon` (`masp`);

--
-- Indexes for table `hoadon`
--
ALTER TABLE `hoadon`
  ADD PRIMARY KEY (`mahd`),
  ADD KEY `fk_user_hoadon` (`username`);

--
-- Indexes for table `loai`
--
ALTER TABLE `loai`
  ADD PRIMARY KEY (`maloai`);

--
-- Indexes for table `sanpham`
--
ALTER TABLE `sanpham`
  ADD PRIMARY KEY (`masp`),
  ADD KEY `fk_loai_sanpham` (`maloai`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `hoadon`
--
ALTER TABLE `hoadon`
  MODIFY `mahd` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `loai`
--
ALTER TABLE `loai`
  MODIFY `maloai` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `sanpham`
--
ALTER TABLE `sanpham`
  MODIFY `masp` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `chitiethoadon`
--
ALTER TABLE `chitiethoadon`
  ADD CONSTRAINT `fk_hoadon_chitiethoadon` FOREIGN KEY (`mahd`) REFERENCES `hoadon` (`mahd`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `fk_sanpham_chitiethoadon` FOREIGN KEY (`masp`) REFERENCES `sanpham` (`masp`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `sanpham`
--
ALTER TABLE `sanpham`
  ADD CONSTRAINT `fk_loai_sanpham` FOREIGN KEY (`maloai`) REFERENCES `loai` (`maloai`) ON DELETE RESTRICT ON UPDATE RESTRICT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
