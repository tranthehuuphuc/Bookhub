-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 06, 2024 at 06:06 PM
-- Server version: 10.11.7-MariaDB
-- PHP Version: 8.1.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `rkzykryi_bookhub`
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
  `biography` text CHARACTER SET utf8mb4 COLLATE utf8mb4_vietnamese_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_vietnamese_ci;

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
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  `publication_year` int(11) DEFAULT NULL,
  `publisher` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  `available_quantity` int(11) DEFAULT NULL,
  `cover_image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  `rating` float DEFAULT NULL,
  `price` int(11) DEFAULT NULL,
  `book_file` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_vietnamese_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_vietnamese_ci;

--
-- Dumping data for table `books`
--

INSERT INTO `books` (`book_id`, `title`, `author_id`, `description`, `publication_year`, `publisher`, `available_quantity`, `cover_image`, `rating`, `price`, `book_file`) VALUES
(61, 'Thất lạc cõi người', 23, 'Nhân gian thất cách (人間失格にんげんしっかく Ningen Shikkaku?, n.đ.: \"Mất tư cách làm người\") là một tiểu thuyết ngắn mang yếu tố tự thuật năm 1948 của Dazai Osamu. Cuốn sách được xem là kiệt tác của tác giả và xếp thứ hai trong số những tiểu thuyết bán chạy nhất ở Nhật, chỉ sau Nỗi lòng của Natsume Sōseki. Tại Việt Nam, tiểu thuyết được phát hành dưới tên Thất lạc cõi người bởi nhà sách Phương Nam.', 2011, 'Hội Nhà Văn', 2, 'tlcn.jpg', 0, 80000, 'book.pdf'),
(62, 'Cho tôi xin một vé đi tuổi thơ', 22, 'Cho tôi xin một vé đi tuổi thơ là truyện ngắn của nhà văn Nguyễn Nhật Ánh. Tác phẩm là một trong những sáng tác thành công nhất của ông và nhận được Giải thưởng Văn học ASEAN của năm 2010.\r\n\r\nNguyễn Nhật Ánh viết ở mặt sau cuốn sách: \"Tôi viết cuốn sách này không dành cho trẻ em. Tôi viết cho những ai từng là trẻ em\". Trả lời phỏng vấn của báo Người lao động, ông nói \"đối tượng cảm thụ mà tôi muốn nhắm tới là người lớn\", với Cho tôi xin một vé đi tuổi thơ ông \"cho phép mình mở rộng biên độ đề tài và hình ảnh đến tối đa vì tôi viết về trẻ em nhưng là cho những ai từng là trẻ em đọc\".', 2008, 'NXB Trẻ', 5, '1vdtt.jpg', 4.66667, 80000, 'ctx1vd.pdf');

-- --------------------------------------------------------

--
-- Table structure for table `book_categories`
--

CREATE TABLE `book_categories` (
  `book_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_vietnamese_ci;

--
-- Dumping data for table `book_categories`
--

INSERT INTO `book_categories` (`book_id`, `category_id`) VALUES
(61, 24),
(61, 25),
(62, 24),
(62, 26);

-- --------------------------------------------------------

--
-- Table structure for table `book_chapters`
--

CREATE TABLE `book_chapters` (
  `chapter_id` int(11) NOT NULL,
  `book_id` int(11) NOT NULL,
  `chapter_title` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_vietnamese_ci;

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
  `language` varchar(255) DEFAULT NULL,
  `format` varchar(255) DEFAULT NULL,
  `ISBN` varchar(255) DEFAULT NULL,
  `chapters` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_vietnamese_ci;

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
  `cover_image` varchar(255) NOT NULL,
  `quantity` int(11) DEFAULT NULL,
  `price` int(11) DEFAULT NULL,
  `cart_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_vietnamese_ci;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`user_id`, `book_id`, `cover_image`, `quantity`, `price`, `cart_date`) VALUES
(1, 61, 'tlcn.jpg', 1, 80000, '2024-06-06 18:00:49'),
(1, 62, '1vdtt.jpg', 1, 80000, '2024-06-06 18:01:02'),
(3, 61, 'tlcn.jpg', 1, 80000, '2024-06-06 15:38:35'),
(5, 62, '1vdtt.jpg', 1, 80000, '2024-06-06 17:56:02');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `category_id` int(11) NOT NULL,
  `category_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_vietnamese_ci;

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
  `cover_image` varchar(255) DEFAULT NULL,
  `price` int(11) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_vietnamese_ci;

--
-- Dumping data for table `mybooks`
--

INSERT INTO `mybooks` (`user_id`, `book_id`, `cover_image`, `price`, `quantity`) VALUES
(1, 61, 'tlcn.jpg', 80000, 1),
(1, 62, '1vdtt.jpg', 80000, 1),
(3, 61, 'tlcn.jpg', 80000, 1),
(5, 62, '1vdtt.jpg', 80000, 1);

-- --------------------------------------------------------

--
-- Table structure for table `orderdetails`
--

CREATE TABLE `orderdetails` (
  `order_id` int(11) DEFAULT NULL,
  `book_id` int(11) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `price` int(11) DEFAULT NULL,
  `cover_image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_vietnamese_ci;

--
-- Dumping data for table `orderdetails`
--

INSERT INTO `orderdetails` (`order_id`, `book_id`, `quantity`, `price`, `cover_image`) VALUES
(1, 61, 1, 80000, 'tlcn.jpg'),
(2, 62, 1, 80000, '1vdtt.jpg'),
(3, 61, 1, 80000, 'tlcn.jpg'),
(4, 62, 1, 80000, '1vdtt.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `order_date` date DEFAULT NULL,
  `order_status` varchar(255) NOT NULL,
  `sum_price` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_vietnamese_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `user_id`, `order_date`, `order_status`, `sum_price`) VALUES
(1, 3, '2024-06-06', 'HoÃ n thÃ nh', 80000),
(2, 5, '2024-06-06', 'HoÃ n thÃ nh', 80000),
(3, 1, '2024-06-06', 'HoÃ n thÃ nh', 80000),
(4, 1, '2024-06-06', 'HoÃ n thÃ nh', 80000);

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `user_id` int(11) NOT NULL,
  `payment_email` varchar(255) DEFAULT NULL,
  `payment_phone` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_vietnamese_ci;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`user_id`, `payment_email`, `payment_phone`) VALUES
(1, 'tranthehuuphuc@icloud.com', '0977983302'),
(3, 'tranthehuuphuc@icloud.com', 'rokbyn8Toqqofimfoq');

-- --------------------------------------------------------

--
-- Table structure for table `quotes`
--

CREATE TABLE `quotes` (
  `id` int(11) NOT NULL,
  `quote` text NOT NULL,
  `source` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_vietnamese_ci;

--
-- Dumping data for table `quotes`
--

INSERT INTO `quotes` (`id`, `quote`, `source`) VALUES
(1, 'It is a truth universally acknowledged, that a single man in possession of a good fortune, must be in want of a wife.', 'Pride and Prejudice'),
(2, 'Happy families are all alike; every unhappy family is unhappy in its own way.', 'Anna Karenina'),
(3, 'It was the best of times, it was the worst of times, it was the age of wisdom, it was the age of foolishness...', 'A Tale of Two Cities'),
(4, 'Call me Ishmael.', 'Moby Dick'),
(5, 'All that is gold does not glitter, Not all those who wander are lost;', 'The Lord of the Rings: The Fellowship of the Ring'),
(6, 'There is no frigate like a book To take us lands away', 'Emily Dickinson'),
(7, 'It is a far, far better thing that I do, than I have ever done; it is a far, far better rest that I go to than I have ever known.', 'A Tale of Two Cities'),
(8, 'The woods are lovely, dark and deep, But I have promises to keep, And miles to go before I sleep.', 'Robert Frost'),
(9, 'Two roads diverged in a yellow wood, and sorry I could not travel both...', 'Robert Frost'),
(10, 'So we beat on, boats against the current, borne back ceaselessly into the past.', 'The Great Gatsby'),
(11, 'Whether I shall turn out to be the hero of my own life, or whether that station will be held by anybody else, these pages must show.', 'David Copperfield'),
(12, 'It is a sin to write this. It is a sin to think words no others think and to put them down upon a paper no others are to see.', 'Anthem'),
(13, 'You have brains in your head. You have feet in your shoes. You can steer yourself any direction you choose.', 'Oh, the Places You\'ll Go!'),
(14, 'I\'ll love you forever, I\'ll like you for always, As long as I\'m living, my baby you\'ll be.', 'Love You Forever'),
(15, 'You don\'t write because you want to say something, you write because you have something to say.', 'F. Scott Fitzgerald'),
(16, 'The man who does not read good books has no advantage over the man who can\'t read them.', 'Mark Twain'),
(17, 'I am no bird; and no net ensnares me; I am a free human being with an independent will.', 'Jane Eyre'),
(18, 'There are darknesses in life and there are lights, and you are one of the lights, the light of all lights.', 'Dracula'),
(19, 'There is nothing to writing. All you do is sit down at a typewriter and bleed.', 'Ernest Hemingway'),
(20, 'A room without books is like a body without a soul.', 'Marcus Tullius Cicero'),
(21, 'If you can make a woman laugh, you can make her do anything.', 'Marilyn Monroe'),
(22, 'Not all those who wander are lost.', 'J.R.R. Tolkien'),
(23, 'It does not do to dwell on dreams and forget to live.', 'Albus Dumbledore (Harry Potter and the Philosopher\'s Stone)'),
(24, 'The opposite of love is not hate, it\'s indifference.', 'Elie Wiesel'),
(25, 'We are all in the gutter, but some of us are looking at the stars.', 'Oscar Wilde'),
(26, 'The only way out of the labyrinth of suffering is to forgive.', 'John Green (Looking for Alaska)'),
(27, 'We accept the love we think we deserve.', 'The Perks of Being a Wallflower'),
(28, 'It\'s the possibility of having a dream come true that makes life interesting.', 'Paulo Coelho (The Alchemist)'),
(29, 'It\'s no use going back to yesterday because I was a different person then.', 'Alice\'s Adventures in Wonderland'),
(30, 'The only thing we have to fear is fear itself.', 'Franklin D. Roosevelt'),
(31, 'The unexamined life is not worth living.', 'Socrates'),
(32, 'Be kind, for everyone you meet is fighting a hard battle.', 'Plato'),
(33, 'To live is the rarest thing in the world. Most people exist, that is all.', 'Oscar Wilde'),
(34, 'There is only one happiness in this life, to love and be loved.', 'George Sand'),
(35, 'I have learned over the years that when one\'s mind is made up, this diminishes fear.', 'Rosa Parks'),
(36, 'I can resist everything except temptation.', 'Oscar Wilde'),
(37, 'We can easily forgive a child who is afraid of the dark; the real tragedy of life is when men are afraid of the light.', 'Plato'),
(38, 'Life isn\'t about finding yourself. Life is about creating yourself.', 'George Bernard Shaw'),
(39, 'To love oneself is the beginning of a lifelong romance.', 'Oscar Wilde'),
(40, 'Life is what we make it, always has been, always will be.', 'Grandma Moses'),
(41, 'The most beautiful things in the world cannot be seen or even touched, they must be felt with the heart.', 'Helen Keller'),
(42, 'You can\'t go back and change the beginning, but you can start where you are and change the ending.', 'C.S. Lewis'),
(43, 'The best way to predict the future is to create it.', 'Peter Drucker'),
(44, 'The mind is a powerful thing. When we fill it with positive thoughts, our lives start to change.', 'Buddha'),
(45, 'The only true wisdom is in knowing you know nothing.', 'Socrates'),
(46, 'You must be the change you wish to see in the world.', 'Mahatma Gandhi'),
(47, 'In a world where you can be anything, be kind.', 'Jennifer Dukes Lee'),
(48, 'Yesterday is history, tomorrow is a mystery, today is a gift of that\'s why we call it the present.', 'Bil Keane'),
(49, 'Success is not final, failure is not fatal: it is the courage to continue that counts.', 'Winston S. Churchill'),
(50, 'I have not failed. I\'ve just found 10,000 ways that won\'t work.', 'Thomas A. Edison'),
(51, 'A friend is someone who knows all about you and still loves you.', 'Elbert Hubbard'),
(52, 'The purpose of our lives is to be happy.', 'Dalai Lama'),
(53, 'Don\'t count the days, make the days count.', 'Muhammad Ali'),
(54, 'You only live once, but if you do it right, once is enough.', 'Mae West'),
(55, 'The only true wisdom is in knowing you know nothing.', 'Socrates'),
(56, 'The cave you fear to enter holds the treasure you seek.', 'Joseph Campbell'),
(57, 'The best way to find yourself is to lose yourself in the service of others.', 'Mahatma Gandhi'),
(58, 'Life shrinks or expands in proportion to one\'s courage.', 'Anais Nin'),
(59, 'The journey of a thousand miles begins with a single step.', 'Lao Tzu'),
(60, 'The only person you are destined to become is the person you decide to be.', 'Ralph Waldo Emerson'),
(61, 'And, when you want something, all the universe conspires in helping you to achieve it.', 'Paulo Coelho (The Alchemist)'),
(62, 'The flower that blooms in adversity is the most rare and beautiful of all.', 'Mulan'),
(63, 'Be the change you want to see in the world.', 'Mahatma Gandhi'),
(64, 'The difference between ordinary and extraordinary is that little extra.', 'Jimmy Johnson'),
(65, 'You can never be overdressed or overeducated.', 'Oscar Wilde'),
(66, 'The future belongs to those who believe in the beauty of their dreams.', 'Eleanor Roosevelt'),
(67, 'Love is not something you find, it is something that finds you.', 'Loretta Young'),
(68, 'Life is a journey, not a destination.', 'Ralph Waldo Emerson'),
(69, 'The world is a book and those who do not travel read only one page.', 'Saint Augustine'),
(70, 'To plant a garden is to believe in tomorrow.', 'Audrey Hepburn'),
(71, 'The only thing necessary for the triumph of evil is for good men to do nothing.', 'Edmund Burke'),
(72, 'Tell me and I forget. Teach me and I remember. Involve me and I learn.', 'Benjamin Franklin'),
(73, 'Happiness is not something ready made. It comes from your own actions.', 'Dalai Lama'),
(74, 'The greatest wealth is health.', 'Virgil'),
(75, 'The road to success and the road to failure are almost exactly the same.', 'Colin R. Davis'),
(76, 'Believe you can and you\'re halfway there.', 'Theodore Roosevelt'),
(77, 'What we think, we become.', 'Buddha'),
(78, 'A goal without a plan is just a wish.', 'Antoine de Saint-Exupéry'),
(79, 'Happiness depends upon ourselves.', 'Aristotle');

-- --------------------------------------------------------

--
-- Table structure for table `ratings`
--

CREATE TABLE `ratings` (
  `rating_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `book_id` int(11) DEFAULT NULL,
  `rating` decimal(3,2) DEFAULT NULL,
  `review` text DEFAULT NULL,
  `rating_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_vietnamese_ci;

--
-- Dumping data for table `ratings`
--

INSERT INTO `ratings` (`rating_id`, `user_id`, `book_id`, `rating`, `review`, `rating_date`) VALUES
(1, 1, 62, 5.00, 'hay', '2024-06-05 11:42:42'),
(2, 1, 62, 5.00, 'hay hay', '2024-06-05 12:03:44'),
(3, 5, 62, 4.00, '\"Cho Tôi Xin Một Vé Đi Tuổi Thơ\" không chỉ là một cuốn sách, mà còn là một hành trình sâu sắc đưa độc giả trở lại quá khứ, nơi mà những kỷ niệm đáng quý và những câu chuyện đầy ý nghĩa đang chờ đợi để được tái khám phá. \r\n\r\nTác giả đã tài tình khi tạo ra một tác phẩm đầy màu sắc và sâu sắc như thế này, nơi mà mỗi trang sách đều là một cánh cửa mở ra thế giới của tuổi thơ. Qua từng dòng chữ, bạn sẽ cảm nhận được sự tình cảm, kỳ vọng, và những thách thức mà tác giả đã trải qua trong quá trình trưởng thành.\r\n\r\nCuốn sách không chỉ đơn thuần là một hồi ký về quá khứ, mà còn là một lời nhắc nhở cho chúng ta giữ gìn và trân trọng những giá trị của tuổi thơ. Nó là một lời kêu gọi để ta nhớ lại những kỷ niệm đẹp đẽ, những buổi chiều dài chơi bên bạn bè, và những giấc mơ lớn lao mà chúng ta từng có.\r\n\r\nĐối với những người đọc, \"Cho Tôi Xin Một Vé Đi Tuổi Thơ\" sẽ không chỉ là một cuốn sách, mà còn là một nguồn cảm hứng để ta tưởng nhớ về quá khứ và tìm hiểu về bản thân mình hơn. Đó là một chuyến đi đầy ý nghĩa và đầy cảm xúc mà bạn không thể bỏ lỡ. \r\n\r\nNếu bạn đang tìm kiếm một cuốn sách để thả mình vào những kỷ niệm tuổi thơ và tìm kiếm sự lạc quan, \"Cho Tôi Xin Một Vé Đi Tuổi Thơ\" là sự lựa chọn hoàn hảo.\r\n\r\n**Điểm Mạnh:**\r\n1. Sự Tình Cảm: Tác giả đã truyền đạt được sự tình cảm một cách chân thành và sâu sắc, làm cho độc giả cảm nhận được mỗi cung bậc cảm xúc.\r\n2. Kỷ Niệm Sống Động: Những mảng ký ức và kỷ niệm trong cuốn sách được mô tả rất sống động và chân thực, khiến cho độc giả cảm thấy như mình đang sống lại những khoảnh khắc đó.\r\n3. Sự Lạc Quan: Dù gặp phải những thử thách và khó khăn, cuốn sách vẫn toát lên một tinh thần lạc quan và hy vọng, khuyến khích độc giả tin vào bản thân và giữ vững ước mơ.\r\n\r\n**Điểm Yếu:**\r\n1. Thiếu Thông Tin Về Tác Giả: Cuốn sách không cung cấp nhiều thông tin về tác giả hoặc nguồn gốc của câu chuyện, điều này có thể làm mất đi sự kết nối giữa độc giả và tác giả.\r\n\r\n**Kết Luận:**\r\n\r\n\"Cho Tôi Xin Một Vé Đi Tuổi Thơ\" không chỉ là một cuốn sách về quá khứ, mà còn là một cuốn sách về sự tình cảm và ý nghĩa của tuổi thơ. Với những câu chuyện chân thực và cảm động, cuốn sách này sẽ khiến bạn cảm thấy gần gũi và thấu hiểu hơn về bản thân và về cuộc sống. Đây thực sự là một cuốn sách đáng đọc và đáng trải nghiệm.', '2024-06-06 18:01:57');

-- --------------------------------------------------------

--
-- Table structure for table `shipping`
--

CREATE TABLE `shipping` (
  `user_id` int(11) NOT NULL,
  `shipping_email` varchar(255) DEFAULT NULL,
  `shipping_phone` varchar(255) DEFAULT NULL,
  `home_address` varchar(255) DEFAULT NULL,
  `ward` varchar(255) DEFAULT NULL,
  `district` varchar(255) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_vietnamese_ci;

--
-- Dumping data for table `shipping`
--

INSERT INTO `shipping` (`user_id`, `shipping_email`, `shipping_phone`, `home_address`, `ward`, `district`, `city`) VALUES
(1, 'tranthehuuphuc@icloud.com', '0977983302', 'XÃ³m 5, ThÃ´n Má»¹ Huá»‡ III', 'BÃ¬nh DÆ°Æ¡ng', 'BÃ¬nh SÆ¡n', 'Quáº£ng NgÃ£i'),
(3, 'dungtrt@uit.edu.vn', 'Náº¿u tháº§y thanh toÃ¡n thÃ¬ tháº§y dÃ¹ng tÃ i khoáº£n sandbox cá»§a chÃºng em bÃªn dÆ°á»›i nhÃ©!', 'University of Information Technology', 'Linh Trung', 'Thu Duc', 'Ho Chi Minh');

-- --------------------------------------------------------

--
-- Table structure for table `subscribe_list`
--

CREATE TABLE `subscribe_list` (
  `subscribe_id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `subscribed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_vietnamese_ci;

--
-- Dumping data for table `subscribe_list`
--

INSERT INTO `subscribe_list` (`subscribe_id`, `email`, `subscribed_at`) VALUES
(2, 'thuyvy.tranthi04@gmail.com', '2024-06-05 17:23:17'),
(3, '22521709@gm.uit.edu.vn', '2024-06-05 17:24:23');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `username` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL DEFAULT 'user',
  `phone` varchar(255) DEFAULT NULL,
  `birthday` varchar(255) DEFAULT NULL,
  `fullname` varchar(255) DEFAULT NULL,
  `avatar` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_vietnamese_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `email`, `password`, `role`, `phone`, `birthday`, `fullname`, `avatar`) VALUES
(1, 'tranthehuuphuc', 'tranthehuuphuc@icloud.com', '$2y$12$kmm4iXc7vAZEQWlX3x6mje9hS56McS1AAwpsQs/WquzIw5RsqJyQe', 'admin', '0977983302', '02/02/2004', 'Tráº§n Tháº¿ Há»¯u PhÃºc', ''),
(3, 'usertest', 'usertest@email.com', '$2y$12$KdFJy8EWs.lF.ljHVL4GoeTqvp5hyth62Wpr/SIDc9P1gtpFpr65C', 'user', '012345678', '01/01/2024', 'Tháº§y DÅ©ng', NULL),
(5, 'vy', 'thuyvy.tranthi04@gmail.com', '$2y$12$szbDq1jEJOacVof2b5KhyecvZYUqNcPIQ0Hr1GaEiR5ModGKlcGfq', 'user', '098765432', '19/09/2004', 'ThÃºy Vy', NULL);

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
-- Indexes for table `quotes`
--
ALTER TABLE `quotes`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `subscribe_list`
--
ALTER TABLE `subscribe_list`
  ADD PRIMARY KEY (`subscribe_id`),
  ADD UNIQUE KEY `email` (`email`);

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
-- AUTO_INCREMENT for table `quotes`
--
ALTER TABLE `quotes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=80;

--
-- AUTO_INCREMENT for table `ratings`
--
ALTER TABLE `ratings`
  MODIFY `rating_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `subscribe_list`
--
ALTER TABLE `subscribe_list`
  MODIFY `subscribe_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

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
