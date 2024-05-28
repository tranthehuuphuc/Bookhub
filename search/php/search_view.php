<?php

// Kết nối tới cơ sở dữ liệu
// $servername = "localhost";
// $username = "root"; // Thay bằng username của bạn
// $password = ""; // Thay bằng password của bạn
// $dbname = "bookhub";

// $conn = new mysqli($servername, $username, $password, $dbname);

// // Kiểm tra kết nối
// if ($conn->connect_error) {
//     die("Kết nối thất bại: " . $conn->connect_error);
// }

// if (isset($_GET['query'])) {
//     $search = $conn->real_escape_string($_GET['query']);

//     // Câu truy vấn tìm kiếm sách theo tiêu đề
//     $sql = "SELECT * FROM books WHERE title LIKE '%$search%'";
//     $result = $conn->query($sql);

//     if ($result->num_rows > 0) {
//         // Hiển thị kết quả tìm kiếm
//         while ($row = $result->fetch_assoc()) {
//             echo "<div class='pro' onclick=\"window.location.href='../thao luan va chi tiet.html';\">";
//             echo "<img src='" . $row['cover_image'] . "' alt=''>";
//             echo "<div class='des'>";
//             echo "<span>Technology</span>";
//             echo "<h5>" . $row['title'] . "</h5>";
//             echo "<div class='star'>";
//             echo "<i class='fas fa-star'></i>";
//             echo "<i class='fas fa-star'></i>";
//             echo "<i class='fas fa-star'></i>";
//             echo "<i class='fas fa-star'></i>";
//             echo "<i class='fas fa-star'></i>";
//             echo "</div>";
//             echo "<h4>" . $row['price'] . " VND</h4>";
//             echo "</div>";
//             echo "</div>";
//         }
//     } else {
//         echo "Không tìm thấy kết quả nào.";
//     }
// }

// $conn->close();

// Kết nối tới cơ sở dữ liệu
// $servername = "localhost";
// $username = "root"; // Thay bằng username của bạn
// $password = ""; // Thay bằng password của bạn
// $dbname = "bookhub";

// $conn = new mysqli($servername, $username, $password, $dbname);

// // Kiểm tra kết nối
// if ($conn->connect_error) {
//     die("Kết nối thất bại: " . $conn->connect_error);
// }

// // Truy vấn dữ liệu từ bảng books
// $sql = "SELECT books.title, categories.category_name, books.price, books.cover_image FROM books JOIN categories ON books.category_id = categories.category_id";
// $result = $conn->query($sql);

// if ($result->num_rows > 0) {
//     // Tạo các thẻ div chứa sản phẩm
//     while ($row = $result->fetch_assoc()) {
//         echo "<div class='card " . strtolower(str_replace(' ', '_', $row['category_name'])) . " hide'>";
//         echo "<div class='image-container'>";
//         echo "<img src='" . $row['cover_image'] . "' alt=''>";
//         echo "</div>";
//         echo "<div class='container'>";
//         echo "<h4 class='product-name'>" . strtoupper($row['title']) . "</h4>";
//         echo "<h3>" . number_format($row['price'], 0, ',', '.') . "đ</h3>";
//         echo "</div>";
//         echo "</div>";
//     }
// } else {
//     echo "Không có sản phẩm nào.";
// }

// $conn->close();
//

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "bookhub";

// Tao ket noi
$conn = new mysqli($servername, $username, $password, $dbname);

// Kiem tra ket noi database
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$search_query = $_GET['query'];
$sql = "SELECT * FROM books WHERE title LIKE '%$search_query%' OR author LIKE '%$search_query%' OR publisher LIKE '%$search_query%'";

$result = $conn->query($sql);

$books = array();

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $books[] = $row;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
    <title>Search | Bookhub</title>
    <link rel="stylesheet" type="text/css" href="../../style.css">
    <link rel="stylesheet" type="text/css" href="../search.css">
    <link rel="stylesheet" type="text/css" href="../../footer.css">
    <link rel="stylesheet" type="text/css" href="../../navbar.css">
    <link rel="apple-touch-icon" sizes="180x180" href="../search/favicon_io/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="../search/favicon_io/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="../search/favicon_io/favicon-16x16.png">
    <link rel="manifest" href="../search/favicon_io/site.webmanifest">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" />
</head>
<body>
    <nav class="navbar">
        <input type="checkbox" id="sidebar-active">
        <label for="sidebar-active" class="open-sidebar-button">
            <svg xmlns="http://www.w3.org/2000/svg" height="32" viewBox="0 -960 960 960" width="32" fill="#FFFFFF">
                <path d="M120-240v-80h720v80H120Zm0-200v-80h720v80H120Zm0-200v-80h720v80H120Z" />
            </svg>
        </label>

        <label id="overlay" for="sidebar-active"></label>

        <div class="link-container">
            <label for="sidebar-active" class="close-sidebar-button">
                <svg xmlns="http://www.w3.org/2000/svg" height="32" viewBox="0 -960 960 960" width="32" fill="#FFFFFF">
                    <path
                        d="m256-200-56-56 224-224-224-224 56-56 224 224 224-224 56 56-224 224 224 224-56 56-224-224-224 224Z" />
                </svg>
            </label>

            <a class="logo-link" href="Bookhub.html"><img id="BookHub" src="../../assets/logo.png" alt="BookHub"></a>
            <a class="globalnav-item" href="../Book_Store/bookstore.php">Bookstore</a>
            <a class="globalnav-item" href="../Bookhub.html">Thể loại</a>
            <a class="globalnav-item" href="../discuss/discuss.php">Thảo luận</a>
            <a class="globalnav-item" href="../signin/signin.php">Đăng nhập</a>
            <a class="globalnav-item" href="../search/search.html">Tìm kiếm</a>
            <button id="profile-button" onclick="window.location.href='./Account/AccountProfile.html'"><img
                    id="profile-icon" src="../../Account/AccountAssets/account.png" alt="Profile Icon"></button>
        </div>
    </nav>

    <div class="wrapper" style="margin-top: 5vw;margin-bottom: 5vw;">
        <div id="search-container">
            <form action="./php/search_view.php" method="GET">
                <input type="search" id="search-input" name="search" placeholder="Tìm kiếm sách.." />
                <button id="search">Tìm kiếm</button>
            </form>
        </div>
        <div id="buttons">
            <button class="button-value" onclick="filterProduct('Sách')">Sách</button>
            <button class="button-value" onclick="filterProduct('Thể loại')">Thể loại</button>
            <button class="button-value" onclick="filterProduct('Tác giả')">Tác giả</button>
            <button class="button-value" onclick="filterProduct('Thảo luận')">Nhà xuất bản</button>
        </div>
        <div id="products"></div>
    </div>

    <section id="product1" class="section-p1">
        <div class="pro-container">
            <?php require_once 'search_model.php' ?>
            <?php require_once 'search_contr.php' ?>

            <?php 
            // Giả sử $pdo là đối tượng PDO đã được khởi tạo và kết nối thành công
            // và $title là tiêu đề được nhập từ ô tìm kiếm.
            $title = $_GET['search'] ?? ''; // Lấy giá trị từ ô tìm kiếm (GET parameter)
            $dsn = "mysql:host=localhost;dbname=bookhub;charset=utf8mb4";
            $pdo = new PDO($dsn, 'root', '');
            $books = get_books($pdo, $title);
            ?>

            <?php if (check_input($books)): ?>
                <?php foreach ($books as $book): ?>
                    <!-- <li>
                        <h2><?php echo $book['title']; ?></h2>
                        <p><?php echo $book['description']; ?></p>
                        <p>Author: <?php echo $book['author']; ?></p>
                        <p>Publisher: <?php echo $book['publisher']; ?></p>
                        <p>Price: $<?php echo $book['price']; ?></p>
                        <img src="<?php echo $book['cover_image']; ?>" alt="Cover Image">
                    </li> -->
                    <div class="pro">
                        <img src="<?php echo $book['cover_image']; ?>" alt="">
                        <div class="des">
                            <span><?php echo $book['publisher']; ?></span>
                            <h5><?php echo $book['title']; ?></h5>
                            <div class="star">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                            </div>
                        </div>
                    </div>

                <?php endforeach; ?>
            <?php else: ?>
                <p>No books found.</p>
            <?php endif; ?>
        </div>
    </section>

    <footer>
        <div class="footer-section footer-content">
            <p class="section-title">VỀ BOOKHUB</p>
            <div class="divider short-divider"></div>
            <p class="description">BookHub là nền tảng kết nối những người<br />có niềm yêu thích sách lại với nhau.</p>
            <div class="social-links">
                <a href="https://facebook.com" target="_blank"><img src="../../assets/facebook.png" alt="facebook"
                        class="social-icon"></a>
                <a href="https://instagram.com" target="_blank"><img src="../../assets/instagram.png" alt="instagram"
                        class="social-icon"></a>
            </div>
        </div>
        <div class="footer-section link_contact">
            <p class="section-title">ĐƯỜNG DẪN</p>
            <div class="divider"></div>
            <ul class="links-list">
                <li><a href="" class="myLink">Bookstore</a></li>
                <li><a href="" class="myLink">Thể loại</a></li>
                <li><a href="" class="myLink">Thảo luận</a></li>
                <li><a href="" class="myLink">Tìm kiếm</a></li>
            </ul>
        </div>
        <div class="footer-section contact">
            <p class="section-title">LIÊN HỆ</p>
            <div class="divider"></div>
            <table>
                <tr>
                    <td><img src="../../assets/phone-call.png" alt="phone" class="contact-icon"></td>
                    <td class="contact-info">016.161.6161</td>
                </tr>
                <tr>
                    <td><img src="../../assets/email.png" alt="mail" class="contact-icon"></td>
                    <td class="contact-info"><a href="mailto:group16@gmail.com" class="email-link">group16@gmail.com</a>
                    </td>
                </tr>
            </table>
        </div>
        <div class="footer-bottom">
            <p class="copyright">&copy; 2024 BookHub. All rights reserved.</p>
        </div>
    </footer>
</body>
</html>
