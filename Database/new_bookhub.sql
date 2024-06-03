-- MySQL dump 10.13  Distrib 5.7.39, for osx11.0 (x86_64)
--
-- Host: localhost    Database: bookhub
-- ------------------------------------------------------
-- Server version	5.7.39

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+07:00";

-- -------------------------------------------------------------------------------------
--                                       OVERVIEW
--                         THERE ARE 14 TABLES IN THE DATABASE

--  authors, books, book_categories, book_chapters, book_information, cart, categories, 
--          mybooks, orderdetails, orders, payment, ratings, shipping, users
--
-- -------------------------------------------------------------------------------------


USE `bookhub`;


-- ------------------------------------------------------
--                        AUTHORS
-- ------------------------------------------------------

--
-- Table structure for table `authors`
--

DROP TABLE IF EXISTS `authors`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `authors` (
  `author_id` int(11) NOT NULL AUTO_INCREMENT,
  `author_name` varchar(255) COLLATE utf8mb4_vietnamese_ci NOT NULL,
  `birth_date` date DEFAULT NULL,
  `nationality` varchar(255) COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  `biography` text COLLATE utf8mb4_vietnamese_ci,
  PRIMARY KEY (`author_id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8 COLLATE=utf8mb4_vietnamese_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `authors`
--

INSERT INTO `authors` (`author_id`, `author_name`, `birth_date`, `nationality`, `biography`) VALUES
(22, 'Nguyễn Nhật Ánh', '1955-05-07', 'Việt Nam', 'Nguyễn Nhật Ánh (sinh ngày 7 tháng 5 năm 1955)[1] là một nam nhà văn người Việt Nam. Được xem là một trong những nhà văn hiện đại xuất sắc nhất Việt Nam hiện nay, ông được biết đến qua nhiều tác phẩm văn học về đề tài tuổi trẻ. Nhiều tác phẩm của ông được độc giả và giới chuyên môn đánh giá cao, đa số đều đã được chuyển thể thành phim.\n\nÔng lần lượt viết về sân khấu, phụ trách mục tiểu phẩm, phụ trách trang thiếu nhi và hiện nay là bình luận viên thể thao trên báo Sài Gòn Giải phóng Chủ nhật với bút danh Chu Đình Ngạn. Ngoài ra, ông còn có những bút danh khác như Anh Bồ Câu, Lê Duy Cật, Đông Phương Sóc, Sóc Phương Đông.'),
(23, 'Dazai Osamu', '0000-00-00', 'Nhật Bản', 'Dazai Osamu (太宰だざい 治おさむ (Thái Tể - Trị) sinh 19 tháng 6 năm 1909 – mất 13 tháng 6 năm 1948?) là một nhà văn Nhật Bản tiêu biểu cho thời kỳ vừa chấm dứt Thế chiến thứ Hai ở Nhật. Dazai sống và viết cùng một nghĩa như nhau, thành thực mà bi đát.\r\n\r\nÔng thường được nhắc tới như một thành viên tiêu biểu trong văn phái Buraiha (Vô Lại Phái) của Nhật Bản.'),


-- ------------------------------------------------------
--                        BOOKS
-- ------------------------------------------------------

--
-- Table structure for table `books`
--

DROP TABLE IF EXISTS `books`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `books` (
  `book_id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_vietnamese_ci NOT NULL,
  `author_id` int(11) DEFAULT NULL,
  `description` text COLLATE utf8mb4_vietnamese_ci,
  `publication_year` int(11) DEFAULT NULL,
  `publisher` varchar(255) COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  `available_quantity` int(11) DEFAULT NULL,
  `cover_image` varchar(255) COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  `rating` float DEFAULT NULL,
  `price` int(11) DEFAULT NULL,
  PRIMARY KEY (`book_id`),
  KEY `author_id` (`author_id`),
  CONSTRAINT `books_ibfk_1` FOREIGN KEY (`author_id`) REFERENCES `authors` (`author_id`)
) ENGINE=InnoDB AUTO_INCREMENT=56 DEFAULT CHARSET=utf8 COLLATE=utf8mb4_vietnamese_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `books`
--

INSERT INTO `books` (`book_id`, `title`, `author_id`, `description`, `publication_year`, `publisher`, `price`, `available_quantity`, `cover_image`, `rating`, `book_file`) VALUES
(61, 'Thất lạc cõi người', 23, 'Nhân gian thất cách (人間失格にんげんしっかく Ningen Shikkaku?, n.đ.: \"Mất tư cách làm người\") là một tiểu thuyết ngắn mang yếu tố tự thuật năm 1948 của Dazai Osamu. Cuốn sách được xem là kiệt tác của tác giả và xếp thứ hai trong số những tiểu thuyết bán chạy nhất ở Nhật, chỉ sau Nỗi lòng của Natsume Sōseki. Tại Việt Nam, tiểu thuyết được phát hành dưới tên Thất lạc cõi người bởi nhà sách Phương Nam.', 2011, 'Hội Nhà Văn', 80, 2, 'tlcn.jpg', 0, 'book.pdf'),
(62, 'Cho tôi xin một vé đi tuổi thơ', 22, 'Cho tôi xin một vé đi tuổi thơ là truyện ngắn của nhà văn Nguyễn Nhật Ánh. Tác phẩm là một trong những sáng tác thành công nhất của ông và nhận được Giải thưởng Văn học ASEAN của năm 2010.\r\n\r\nNguyễn Nhật Ánh viết ở mặt sau cuốn sách: \"Tôi viết cuốn sách này không dành cho trẻ em. Tôi viết cho những ai từng là trẻ em\". Trả lời phỏng vấn của báo Người lao động, ông nói \"đối tượng cảm thụ mà tôi muốn nhắm tới là người lớn\", với Cho tôi xin một vé đi tuổi thơ ông \"cho phép mình mở rộng biên độ đề tài và hình ảnh đến tối đa vì tôi viết về trẻ em nhưng là cho những ai từng là trẻ em đọc\".', 2008, 'NXB Trẻ', 80, 5, '1vdtt.jpg', 0, 'Lab 04 - Working with Web Server in C.pdf');


-- ------------------------------------------------------
--                   BOOK_CATEGORIES
-- ------------------------------------------------------

--
-- Table structure for table `book_categories`
--

DROP TABLE IF EXISTS `book_categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `book_categories` (
  `book_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  PRIMARY KEY (`book_id`,`category_id`),
  KEY `fk_book_cat_cat_id` (`category_id`),
  CONSTRAINT `fk_book_cat_book_id` FOREIGN KEY (`book_id`) REFERENCES `books` (`book_id`),
  CONSTRAINT `fk_book_cat_cat_id` FOREIGN KEY (`category_id`) REFERENCES `categories` (`category_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8mb4_vietnamese_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `book_categories`
--

INSERT INTO `book_categories` (`book_id`, `category_id`) VALUES
(61, 24),
(61, 25),
(62, 24),
(62, 26);


-- ----------------------------------------------------
--                    BOOK_CHAPTERS
-- ----------------------------------------------------

--
-- Table structure for table `book_chapters`
--

DROP TABLE IF EXISTS `book_chapters`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `book_chapters` (
  `chapter_id` int(11) NOT NULL AUTO_INCREMENT,
  `book_id` int(11) NOT NULL,
  `chapter_title` varchar(255) COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  PRIMARY KEY (`chapter_id`),
  KEY `fk_book_chapter_id` (`book_id`),
  CONSTRAINT `fk_book_chapter_id` FOREIGN KEY (`book_id`) REFERENCES `books` (`book_id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8 COLLATE=utf8mb4_vietnamese_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

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


-- ----------------------------------------------------
--                    BOOK_INFORMATION
-- ----------------------------------------------------

--
-- Table structure for table `book_information`
--

DROP TABLE IF EXISTS `book_information`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `book_information` (
  `book_id` int(11) NOT NULL,
  `number_of_pages` int(11) DEFAULT NULL,
  `language` varchar(255) COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  `format` varchar(255) COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  `ISBN` varchar(255) COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  `chapters` text COLLATE utf8mb4_vietnamese_ci,
  PRIMARY KEY (`book_id`),
  CONSTRAINT `fk_book_info_id` FOREIGN KEY (`book_id`) REFERENCES `books` (`book_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8mb4_vietnamese_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `book_information`
--

INSERT INTO `book_information` (`book_id`, `number_of_pages`, `language`, `format`, `ISBN`, `chapters`) VALUES
(61, 265, 'Tiếng Việt', 'Bìa mềm, Ebook', '9786045301289', 'Quyển sổ ghi chép thứ nhất\r\nQuyển sổ ghi chép thứ hai\r\nQuyển sổ ghi chép thứ ba'),
(62, 218, 'Tiếng Việt', 'Bìa mềm, Ebook', '978-604-1-00475-7', 'Chương 1: Tóm lại là đã hết một ngày\r\n Chương 2: Bố mẹ tuyệt vời\r\n Chương 3: Ðặt tên cho thế giới\r\n Chương 4: Buồn ơi là sầu\r\n Chương 5: Khi người ta lớn\r\n Chương 6: Tôi là thằng cu Mùi\r\n Chương 7: Tôi ngoan trong bao lâu\r\n Chương 8: Chúng tôi trở thành lũ giết người như thế nào?\r\n Chương 9: Ai có biết bây giờ là mấy giờ rồi không?\r\n Chương 10: Và tôi đã chìm\r\n Chương 11: Trang trại chó hoang\r\n Chương 12: Cuối cùng là chuyến tàu không có người soát vé');


-- ----------------------------------------------------
--                        CART
-- ----------------------------------------------------

--
-- Table structure for table `cart`
--

DROP TABLE IF EXISTS `cart`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cart` (
  `user_id` int(11) NOT NULL,
  `book_id` int(11) NOT NULL,
  `cover_image` varchar(255) COLLATE utf8mb4_vietnamese_ci NOT NULL,
  `quantity` int(11) DEFAULT NULL,
  `price` int(11) DEFAULT NULL,
  PRIMARY KEY (`user_id`,`book_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8mb4_vietnamese_ci;
/*!40101 SET character_set_client = @saved_cs_client */;


-- ----------------------------------------------------
--                      CATEGORIES
-- ----------------------------------------------------

--
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `categories` (
  `category_id` int(11) NOT NULL AUTO_INCREMENT,
  `category_name` varchar(255) COLLATE utf8mb4_vietnamese_ci NOT NULL,
  PRIMARY KEY (`category_id`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8 COLLATE=utf8mb4_vietnamese_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

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


-- ----------------------------------------------------
--                        MYBOOKS
-- ----------------------------------------------------
--
-- Table structure for table `mybooks`
--

DROP TABLE IF EXISTS `mybooks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mybooks` (
  `user_id` int(11) NOT NULL,
  `book_id` int(11) NOT NULL,
  `cover_image` varchar(255) COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  `price` int(11) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  PRIMARY KEY (`user_id`,`book_id`),
  CONSTRAINT `mybooks_ibfk_1` FOREIGN KEY (`book_id`) REFERENCES `books` (`book_id`),
  CONSTRAINT `mybooks_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8mb4_vietnamese_ci;


-- ----------------------------------------------------
--                    ORDERDETAILS
-- ----------------------------------------------------
--
-- Table structure for table `orderdetails`
--

DROP TABLE IF EXISTS `orderdetails`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `orderdetails` (
  `order_id` int(11) DEFAULT NULL,
  `book_id` int(11) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `price` int(11) DEFAULT NULL,
  `cover_image` varchar(255) COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  KEY `order_id` (`order_id`),
  KEY `orderdetails_ibfk_2` (`book_id`),
  CONSTRAINT `fk_order_id` FOREIGN KEY (`order_id`) REFERENCES `orders` (`order_id`),
  CONSTRAINT `orderdetails_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`order_id`),
  CONSTRAINT `orderdetails_ibfk_2` FOREIGN KEY (`book_id`) REFERENCES `books` (`book_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8mb4_vietnamese_ci;
/*!40101 SET character_set_client = @saved_cs_client */;


-- ----------------------------------------------------
--                        ORDERS
-- ----------------------------------------------------

--
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `order_date` date DEFAULT NULL,
  `order_status` varchar(255) COLLATE utf8mb4_vietnamese_ci NOT NULL,
  `sum_price` int(11) DEFAULT NULL,
  PRIMARY KEY (`order_id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COLLATE=utf8mb4_vietnamese_ci;
/*!40101 SET character_set_client = @saved_cs_client */;


-- ----------------------------------------------------
--                        PAYMENT
-- ----------------------------------------------------

--
-- Table structure for table `payment`
--

DROP TABLE IF EXISTS `payment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `payment` (
  `user_id` int(11) NOT NULL,
  `payment_email` varchar(255) COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  `payment_phone` varchar(255) COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  PRIMARY KEY (`user_id`)
  CONSTRAINT `payment_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8mb4_vietnamese_ci;
/*!40101 SET character_set_client = @saved_cs_client */;


-- ----------------------------------------------------
--                        RATINGS
-- ----------------------------------------------------

--
-- Table structure for table `ratings`
--

DROP TABLE IF EXISTS `ratings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ratings` (
  `rating_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `book_id` int(11) DEFAULT NULL,
  `rating` decimal(3,2) DEFAULT NULL,
  `review` text COLLATE utf8mb4_vietnamese_ci,
  `rating_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`rating_id`),
  KEY `user_id` (`user_id`),
  KEY `ratings_ibfk_2` (`book_id`),
  CONSTRAINT `ratings_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`),
  CONSTRAINT `ratings_ibfk_2` FOREIGN KEY (`book_id`) REFERENCES `books` (`book_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8mb4_vietnamese_ci;
/*!40101 SET character_set_client = @saved_cs_client */;


-- ----------------------------------------------------
--                        SHIPPING
-- ----------------------------------------------------

--
-- Table structure for table `shipping`
--

DROP TABLE IF EXISTS `shipping`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `shipping` (
  `user_id` int(11) NOT NULL,
  `shipping_email` varchar(255) COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  `shipping_phone` varchar(255) COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  `home_address` varchar(255) COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  `ward` varchar(255) COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  `district` varchar(255) COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  `city` varchar(255) COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  PRIMARY KEY (`user_id`)
  CONSTRAINT `shipping_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8mb4_vietnamese_ci;
/*!40101 SET character_set_client = @saved_cs_client */;


-- ----------------------------------------------------
--                        USERS
-- ----------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_vietnamese_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_vietnamese_ci NOT NULL,
  `role` varchar(255) COLLATE utf8mb4_vietnamese_ci NOT NULL DEFAULT 'user',
  `phone` varchar(255) COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  `birthday` varchar(255) COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  `fullname` varchar(255) COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=utf8 COLLATE=utf8mb4_vietnamese_ci;
/*!40101 SET character_set_client = @saved_cs_client */;


-- ------------------------------------------------------
-- ------------------------------------------------------

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-06-03 20:56:05
