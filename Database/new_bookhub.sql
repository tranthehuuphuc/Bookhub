-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Jun 05, 2024 at 02:58 PM
-- Server version: 5.7.39
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bookhub`
--

-- --------------------------------------------------------

--
-- Table structure for table `authors`
--

CREATE TABLE `authors` (
  `author_id` int(11) NOT NULL,
  `author_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_vietnamese_ci NOT NULL,
  `birth_date` date DEFAULT NULL,
  `nationality` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  `biography` text CHARACTER SET utf8mb4 COLLATE utf8mb4_vietnamese_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_vietnamese_ci;

--
-- Dumping data for table `authors`
--

INSERT INTO `authors` (`author_id`, `author_name`, `birth_date`, `nationality`, `biography`) VALUES
(22, 'Nguyễn Nhật Ánh', '1955-05-07', 'Việt Nam', 'Nguyễn Nhật Ánh (sinh ngày 7 tháng 5 năm 1955)[1] là một nam nhà văn người Việt Nam. Được xem là một trong những nhà văn hiện đại xuất sắc nhất Việt Nam hiện nay, ông được biết đến qua nhiều tác phẩm văn học về đề tài tuổi trẻ. Nhiều tác phẩm của ông được độc giả và giới chuyên môn đánh giá cao, đa số đều đã được chuyển thể thành phim.\n\nÔng lần lượt viết về sân khấu, phụ trách mục tiểu phẩm, phụ trách trang thiếu nhi và hiện nay là bình luận viên thể thao trên báo Sài Gòn Giải phóng Chủ nhật với bút danh Chu Đình Ngạn. Ngoài ra, ông còn có những bút danh khác như Anh Bồ Câu, Lê Duy Cật, Đông Phương Sóc, Sóc Phương Đông.'),
(23, 'Dazai Osamu', '0000-00-00', 'Nhật Bản', 'Dazai Osamu (太宰だざい 治おさむ (Thái Tể - Trị) sinh 19 tháng 6 năm 1909 – mất 13 tháng 6 năm 1948?) là một nhà văn Nhật Bản tiêu biểu cho thời kỳ vừa chấm dứt Thế chiến thứ Hai ở Nhật. Dazai sống và viết cùng một nghĩa như nhau, thành thực mà bi đát.\r\n\r\nÔng thường được nhắc tới như một thành viên tiêu biểu trong văn phái Buraiha (Vô Lại Phái) của Nhật Bản.');

-- --------------------------------------------------------

--
-- Table structure for table `books`
--

CREATE TABLE `books` (
  `book_id` int(11) NOT NULL,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_vietnamese_ci NOT NULL,
  `author_id` int(11) DEFAULT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_vietnamese_ci,
  `publication_year` int(11) DEFAULT NULL,
  `publisher` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  `available_quantity` int(11) DEFAULT NULL,
  `cover_image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  `rating` float DEFAULT NULL,
  `price` int(11) DEFAULT NULL,
  `book_file` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_vietnamese_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_vietnamese_ci;

--
-- Dumping data for table `books`
--

INSERT INTO `books` (`book_id`, `title`, `author_id`, `description`, `publication_year`, `publisher`, `available_quantity`, `cover_image`, `rating`, `price`, `book_file`) VALUES
(61, 'Thất lạc cõi người', 23, 'Nhân gian thất cách (人間失格にんげんしっかく Ningen Shikkaku?, n.đ.: \"Mất tư cách làm người\") là một tiểu thuyết ngắn mang yếu tố tự thuật năm 1948 của Dazai Osamu. Cuốn sách được xem là kiệt tác của tác giả và xếp thứ hai trong số những tiểu thuyết bán chạy nhất ở Nhật, chỉ sau Nỗi lòng của Natsume Sōseki. Tại Việt Nam, tiểu thuyết được phát hành dưới tên Thất lạc cõi người bởi nhà sách Phương Nam.', 2011, 'Hội Nhà Văn', 2, 'tlcn.jpg', 0, 80000, 'book.pdf'),
(62, 'Cho tôi xin một vé đi tuổi thơ', 22, 'Cho tôi xin một vé đi tuổi thơ là truyện ngắn của nhà văn Nguyễn Nhật Ánh. Tác phẩm là một trong những sáng tác thành công nhất của ông và nhận được Giải thưởng Văn học ASEAN của năm 2010.\r\n\r\nNguyễn Nhật Ánh viết ở mặt sau cuốn sách: \"Tôi viết cuốn sách này không dành cho trẻ em. Tôi viết cho những ai từng là trẻ em\". Trả lời phỏng vấn của báo Người lao động, ông nói \"đối tượng cảm thụ mà tôi muốn nhắm tới là người lớn\", với Cho tôi xin một vé đi tuổi thơ ông \"cho phép mình mở rộng biên độ đề tài và hình ảnh đến tối đa vì tôi viết về trẻ em nhưng là cho những ai từng là trẻ em đọc\".', 2008, 'NXB Trẻ', 5, '1vdtt.jpg', 0, 80000, 'Lab 04 - Working with Web Server in C.pdf');

-- --------------------------------------------------------

--
-- Table structure for table `book_categories`
--

CREATE TABLE `book_categories` (
  `book_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_vietnamese_ci;

--
-- Dumping data for table `book_categories`
--

INSERT INTO `book_categories` (`book_id`, `category_id`) VALUES
(61, 24),
(62, 24),
(61, 25),
(62, 26);

-- --------------------------------------------------------

--
-- Table structure for table `book_chapters`
--

CREATE TABLE `book_chapters` (
  `chapter_id` int(11) NOT NULL,
  `book_id` int(11) NOT NULL,
  `chapter_title` varchar(255) COLLATE utf8_vietnamese_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_vietnamese_ci;

--
-- Dumping data for table `book_chapters`
--

INSERT INTO `book_chapters` (`chapter_id`, `book_id`, `chapter_title`) VALUES
(18, 61, 'Quyển sổ ghi chép thứ nhất'),
(19, 61, 'Quyển sổ ghi chép thứ hai'),
(20, 61, 'Quyển sổ ghi chép thứ ba'),
(21, 62, 'Chương 1: Tóm lại là đã hết một ngày'),
(22, 62, 'Chương 2: Bố mẹ tuyệt vời'),
(23, 62, 'Chương 3: Ðặt tên cho thế giới'),
(24, 62, 'Chương 4: Buồn ơi là sầu'),
(25, 62, 'Chương 5: Khi người ta lớn'),
(26, 62, 'Chương 6: Tôi là thằng cu Mùi'),
(27, 62, 'Chương 7: Tôi ngoan trong bao lâu'),
(28, 62, 'Chương 8: Chúng tôi trở thành lũ giết người như thế nào?'),
(29, 62, 'Chương 9: Ai có biết bây giờ là mấy giờ rồi không?'),
(30, 62, 'Chương 10: Và tôi đã chìm'),
(31, 62, 'Chương 11: Trang trại chó hoang'),
(32, 62, 'Chương 12: Cuối cùng là chuyến tàu không có người soát vé');

-- --------------------------------------------------------

--
-- Table structure for table `book_information`
--

CREATE TABLE `book_information` (
  `book_id` int(11) NOT NULL,
  `number_of_pages` int(11) DEFAULT NULL,
  `language` varchar(255) COLLATE utf8_vietnamese_ci DEFAULT NULL,
  `format` varchar(255) COLLATE utf8_vietnamese_ci DEFAULT NULL,
  `ISBN` varchar(255) COLLATE utf8_vietnamese_ci DEFAULT NULL,
  `chapters` text COLLATE utf8_vietnamese_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_vietnamese_ci;

--
-- Dumping data for table `book_information`
--

INSERT INTO `book_information` (`book_id`, `number_of_pages`, `language`, `format`, `ISBN`, `chapters`) VALUES
(61, 265, 'Tiếng Việt', 'Bìa mềm, Ebook', '9786045301289', 'Quyển sổ ghi chép thứ nhất\r\nQuyển sổ ghi chép thứ hai\r\nQuyển sổ ghi chép thứ ba'),
(62, 218, 'Tiếng Việt', 'Bìa mềm, Ebook', '978-604-1-00475-7', 'Chương 1: Tóm lại là đã hết một ngày\r\n Chương 2: Bố mẹ tuyệt vời\r\n Chương 3: Ðặt tên cho thế giới\r\n Chương 4: Buồn ơi là sầu\r\n Chương 5: Khi người ta lớn\r\n Chương 6: Tôi là thằng cu Mùi\r\n Chương 7: Tôi ngoan trong bao lâu\r\n Chương 8: Chúng tôi trở thành lũ giết người như thế nào?\r\n Chương 9: Ai có biết bây giờ là mấy giờ rồi không?\r\n Chương 10: Và tôi đã chìm\r\n Chương 11: Trang trại chó hoang\r\n Chương 12: Cuối cùng là chuyến tàu không có người soát vé');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `user_id` int(11) NOT NULL,
  `book_id` int(11) NOT NULL,
  `cover_image` varchar(255) COLLATE utf8_vietnamese_ci NOT NULL,
  `quantity` int(11) DEFAULT NULL,
  `price` int(11) DEFAULT NULL,
  `cart_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_vietnamese_ci;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`user_id`, `book_id`, `cover_image`, `quantity`, `price`, `cart_date`) VALUES
(1, 61, 'tlcn.jpg', 1, 80000, '2024-06-05 14:48:18'),
(1, 62, '1vdtt.jpg', 1, 80000, '2024-06-05 14:48:24');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `category_id` int(11) NOT NULL,
  `category_name` varchar(255) COLLATE utf8_vietnamese_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_vietnamese_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`category_id`, `category_name`) VALUES
(21, 'Khoa học viễn tưởng'),
(22, 'Kinh dị'),
(23, 'Lãng mạn'),
(24, 'Tiểu thuyết'),
(25, 'Văn học nước ngoài'),
(26, 'Văn học thiếu nhi');

-- --------------------------------------------------------

--
-- Table structure for table `mybooks`
--

CREATE TABLE `mybooks` (
  `user_id` int(11) NOT NULL,
  `book_id` int(11) NOT NULL,
  `cover_image` varchar(255) COLLATE utf8_vietnamese_ci DEFAULT NULL,
  `price` int(11) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_vietnamese_ci;

--
-- Dumping data for table `mybooks`
--

INSERT INTO `mybooks` (`user_id`, `book_id`, `cover_image`, `price`, `quantity`) VALUES
(1, 61, 'tlcn.jpg', 80000, 2);

-- --------------------------------------------------------

--
-- Table structure for table `orderdetails`
--

CREATE TABLE `orderdetails` (
  `order_id` int(11) DEFAULT NULL,
  `book_id` int(11) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `price` int(11) DEFAULT NULL,
  `cover_image` varchar(255) COLLATE utf8_vietnamese_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_vietnamese_ci;

--
-- Dumping data for table `orderdetails`
--

INSERT INTO `orderdetails` (`order_id`, `book_id`, `quantity`, `price`, `cover_image`) VALUES
(1, 62, 1, 80000, '1vdtt.jpg'),
(1, 61, 1, 80000, 'tlcn.jpg'),
(2, 62, 1, 80000, '1vdtt.jpg'),
(3, 61, 1, 80000, 'tlcn.jpg'),
(4, 61, 1, 80000, 'tlcn.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `order_date` date DEFAULT NULL,
  `order_status` varchar(255) COLLATE utf8_vietnamese_ci NOT NULL,
  `sum_price` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_vietnamese_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `user_id`, `order_date`, `order_status`, `sum_price`) VALUES
(1, 1, '2024-06-04', 'Hoàn thành', 160000),
(2, 1, '2024-06-05', 'Hoàn thành', 80000),
(3, 1, '2024-06-05', 'Hoàn thành', 80000),
(4, 1, '2024-06-05', 'Hoàn thành', 80000);

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `user_id` int(11) NOT NULL,
  `payment_email` varchar(255) COLLATE utf8_vietnamese_ci DEFAULT NULL,
  `payment_phone` varchar(255) COLLATE utf8_vietnamese_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_vietnamese_ci;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`user_id`, `payment_email`, `payment_phone`) VALUES
(1, 'tranthehuuphuc@icloud.com', '0977983302');

-- --------------------------------------------------------

--
-- Table structure for table `ratings`
--

CREATE TABLE `ratings` (
  `rating_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `book_id` int(11) DEFAULT NULL,
  `rating` decimal(3,2) DEFAULT NULL,
  `review` text COLLATE utf8_vietnamese_ci,
  `rating_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_vietnamese_ci;

-- --------------------------------------------------------

--
-- Table structure for table `shipping`
--

CREATE TABLE `shipping` (
  `user_id` int(11) NOT NULL,
  `shipping_email` varchar(255) COLLATE utf8_vietnamese_ci DEFAULT NULL,
  `shipping_phone` varchar(255) COLLATE utf8_vietnamese_ci DEFAULT NULL,
  `home_address` varchar(255) COLLATE utf8_vietnamese_ci DEFAULT NULL,
  `ward` varchar(255) COLLATE utf8_vietnamese_ci DEFAULT NULL,
  `district` varchar(255) COLLATE utf8_vietnamese_ci DEFAULT NULL,
  `city` varchar(255) COLLATE utf8_vietnamese_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_vietnamese_ci;

--
-- Dumping data for table `shipping`
--

INSERT INTO `shipping` (`user_id`, `shipping_email`, `shipping_phone`, `home_address`, `ward`, `district`, `city`) VALUES
(1, 'tranthehuuphuc@icloud.com', '0977983302', 'Xóm 5, thôn Mỹ Huệ III', 'Bình Dương', 'Bình Sơn', 'Quảng Ngãi');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `username` varchar(255) COLLATE utf8_vietnamese_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_vietnamese_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_vietnamese_ci NOT NULL,
  `role` varchar(255) COLLATE utf8_vietnamese_ci NOT NULL DEFAULT 'user',
  `phone` varchar(255) COLLATE utf8_vietnamese_ci DEFAULT NULL,
  `birthday` varchar(255) COLLATE utf8_vietnamese_ci DEFAULT NULL,
  `fullname` varchar(255) COLLATE utf8_vietnamese_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_vietnamese_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `email`, `password`, `role`, `phone`, `birthday`, `fullname`) VALUES
(1, 'tranthehuuphuc', 'tranthehuuphuc@icloud.com', '$2y$12$kmm4iXc7vAZEQWlX3x6mje9hS56McS1AAwpsQs/WquzIw5RsqJyQe', 'admin', '0977983302', '02/02/2004', 'Trần Thế Hữu Phúc');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `authors`
--
ALTER TABLE `authors`
  ADD PRIMARY KEY (`author_id`);

--
-- Indexes for table `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`book_id`),
  ADD KEY `author_id` (`author_id`);

--
-- Indexes for table `book_categories`
--
ALTER TABLE `book_categories`
  ADD PRIMARY KEY (`book_id`,`category_id`),
  ADD KEY `fk_book_cat_cat_id` (`category_id`);

--
-- Indexes for table `book_chapters`
--
ALTER TABLE `book_chapters`
  ADD PRIMARY KEY (`chapter_id`),
  ADD KEY `fk_book_chapter_id` (`book_id`);

--
-- Indexes for table `book_information`
--
ALTER TABLE `book_information`
  ADD PRIMARY KEY (`book_id`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`user_id`,`book_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `mybooks`
--
ALTER TABLE `mybooks`
  ADD PRIMARY KEY (`user_id`,`book_id`),
  ADD KEY `mybooks_ibfk_1` (`book_id`);

--
-- Indexes for table `orderdetails`
--
ALTER TABLE `orderdetails`
  ADD KEY `order_id` (`order_id`),
  ADD KEY `orderdetails_ibfk_2` (`book_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `ratings`
--
ALTER TABLE `ratings`
  ADD PRIMARY KEY (`rating_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `ratings_ibfk_2` (`book_id`);

--
-- Indexes for table `shipping`
--
ALTER TABLE `shipping`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `authors`
--
ALTER TABLE `authors`
  MODIFY `author_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `books`
--
ALTER TABLE `books`
  MODIFY `book_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;

--
-- AUTO_INCREMENT for table `book_chapters`
--
ALTER TABLE `book_chapters`
  MODIFY `chapter_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `ratings`
--
ALTER TABLE `ratings`
  MODIFY `rating_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `books`
--
ALTER TABLE `books`
  ADD CONSTRAINT `books_ibfk_1` FOREIGN KEY (`author_id`) REFERENCES `authors` (`author_id`);

--
-- Constraints for table `book_categories`
--
ALTER TABLE `book_categories`
  ADD CONSTRAINT `fk_book_cat_book_id` FOREIGN KEY (`book_id`) REFERENCES `books` (`book_id`),
  ADD CONSTRAINT `fk_book_cat_cat_id` FOREIGN KEY (`category_id`) REFERENCES `categories` (`category_id`);

--
-- Constraints for table `book_chapters`
--
ALTER TABLE `book_chapters`
  ADD CONSTRAINT `fk_book_chapter_id` FOREIGN KEY (`book_id`) REFERENCES `books` (`book_id`);

--
-- Constraints for table `book_information`
--
ALTER TABLE `book_information`
  ADD CONSTRAINT `fk_book_info_id` FOREIGN KEY (`book_id`) REFERENCES `books` (`book_id`);

--
-- Constraints for table `mybooks`
--
ALTER TABLE `mybooks`
  ADD CONSTRAINT `mybooks_ibfk_1` FOREIGN KEY (`book_id`) REFERENCES `books` (`book_id`),
  ADD CONSTRAINT `mybooks_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `orderdetails`
--
ALTER TABLE `orderdetails`
  ADD CONSTRAINT `fk_order_id` FOREIGN KEY (`order_id`) REFERENCES `orders` (`order_id`),
  ADD CONSTRAINT `orderdetails_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`order_id`),
  ADD CONSTRAINT `orderdetails_ibfk_2` FOREIGN KEY (`book_id`) REFERENCES `books` (`book_id`);

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `payment`
--
ALTER TABLE `payment`
  ADD CONSTRAINT `payment_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `ratings`
--
ALTER TABLE `ratings`
  ADD CONSTRAINT `ratings_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `ratings_ibfk_2` FOREIGN KEY (`book_id`) REFERENCES `books` (`book_id`);

--
-- Constraints for table `shipping`
--
ALTER TABLE `shipping`
  ADD CONSTRAINT `shipping_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
