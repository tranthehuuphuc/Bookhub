<?php
session_start();

if ($_SESSION['user_role'] !== 'admin') {
    header("Location: ../signin/signin.php");
    exit();
}

include 'dbh.php';
?>


<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard | BookHub</title>
    <link rel="stylesheet" type="text/css" href="./admin.css">
    <link rel="stylesheet" type="text/css" href="../style.css">
    <link rel="stylesheet" type="text/css" href="../navbar.css">
    <link rel="stylesheet" type="text/css" href="../footer.css">
    <link rel="apple-touch-icon" sizes="180x180" href="../favicon_io/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="../favicon_io/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="../favicon_io/favicon-16x16.png">
    <link rel="manifest" href="../../favicon_io/site.webmanifest">

    <!-- First, include jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <!-- Then, include Select2 -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.1.0-beta.1/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.1.0-beta.1/js/select2.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#categories').select2({
                tags: false // Disable the "add more" option
            });
        });
    </script>

</head>
<body>
    <h1 class="visuallyhidden">BookHub</h1>

        <!-- Navbar -->
        <nav class="navbar">
            <input type="checkbox" id="sidebar-active">
                <!-- New logo image that only appears when the navbar is collapsed -->
            <a href="../index.php"><img id="new-logo" src="../assets/BookHub.png" alt="New Logo"></a>

            <label for="sidebar-active" class="open-sidebar-button">
                <svg xmlns="http://www.w3.org/2000/svg" height="32" viewBox="0 -960 960 960" width="32" fill="#FFFFFF"><path d="M120-240v-80h720v80H120Zm0-200v-80h720v80H120Zm0-200v-80h720v80H120Z"/></svg>
            </label>

            <label id="overlay" for="sidebar-active"></label>

            <div class="link-container">
                <label for="sidebar-active" class="close-sidebar-button">
                    <svg xmlns="http://www.w3.org/2000/svg" height="32" viewBox="0 -960 960 960" width="32" fill="#FFFFFF"><path d="m256-200-56-56 224-224-224-224 56-56 224 224 224-224 56 56-224 224 224 224-56 56-224-224-224 224Z"/></svg>
                </label>
                
                <a class="logo-link" href="../index.php"><img id="BookHub" src="../assets/logo.png" alt="BookHub"></a>
                <a class="globalnav-item" href="../Book_Store/bookstore.php">Bookstore</a>
                <a class="globalnav-item" href="../discuss/discuss.php">Thảo luận</a>
                <a class="globalnav-item" href="../search/search.php">Tìm kiếm</a>
                <a class="globalnav-item-show" href="../account/AccountReceipts.php">Đơn hàng</a>
                <a class="globalnav-item-show" href="../account/AccountCart.php">Mục đã lưu</a>
                <a class="globalnav-item-show" href="../account/AccountSettings.php">Tài khoản</a>
                <a class="globalnav-item-show" href="../signin/logout.php">Đăng xuất</a>
                <button id="profile-button"><img id="profile-icon" src="../assets/account.png" alt="Profile Icon"></button>
            </div>
        </nav>

        <!-- Account options -->
        <div id="blur-overlay" class="hidden"></div>
        <div id="account-options" class="hidden">
            <p id="myprofile">Hồ sơ của tôi</p>
            <div style="background-color: #d9d9d9; width: 25%; height: 0.05vw; margin: 0; padding: 0;"></div>
            <ul>
                <li><img class="option-icons" src="../assets/orders.png"><a href="../account/orders.php">Đơn hàng</a></li>
                <li><img class="option-icons" src="../assets/saves.png"><a href="../account/saves.php">Mục đã lưu</a></li>
                <li><img class="option-icons" src="../assets/setting.png"><a href="../account/profile.php">Tài khoản</a></li>
                <li><img class="option-icons" src="../assets/join.png"><a href="../signin/logout.php">Đăng xuất</a></li>
            </ul>
        </div>
        <script>
            function ShowAccountOptions() {
                var overlay = document.getElementById("blur-overlay");
                var accountOptions = document.getElementById("account-options");
                overlay.classList.toggle("hidden");

                if (overlay.classList.contains("hidden")) {
                    accountOptions.classList.remove("show");
                    setTimeout(() => accountOptions.classList.add("hidden"), 0);
                } else {
                    accountOptions.classList.remove("hidden");
                    setTimeout(() => accountOptions.classList.add("show"), 0);
                }
            }

            function CloseAccountOptions() {
                var overlay = document.getElementById("blur-overlay");
                var accountOptions = document.getElementById("account-options");

                overlay.classList.remove("show");
                overlay.classList.add("hidden");
                accountOptions.classList.remove("show");
                accountOptions.classList.add("hidden");
            }

            document.addEventListener("DOMContentLoaded", () => {
                var profileButton = document.getElementById("profile-button");
                var overlay = document.getElementById("blur-overlay");

                profileButton.addEventListener("click", ShowAccountOptions);
                overlay.addEventListener("click", CloseAccountOptions);
                document.addEventListener('keydown', (event) => {
                    if (event.key === 'Escape') {
                        CloseAccountOptions();
                    }
                });
            });
        </script>
        <!-- End of Account options -->

    <main class="form-class">
        <div class="container">
            <h1>Admin Dashboard</h1>
            <h3>Xin chào, <?php echo htmlspecialchars($_SESSION["user_username"]); ?>!</h3>
            <?php
            // Check if success parameter is present in URL
            if (isset($_GET['success']) && $_GET['success'] == 1) {
                // Show JavaScript alert for success message
                echo '<script>alert("Thao tác thành công!");</script>';
            }
            ?>
            <p>Đây là trang quản trị của BookHub. Bạn có thể thực hiện các thao tác quản trị ở đây.</p>
            <!-- Panels -->
            <div class="tabs">
                <button class="tab active" data-target="#addBookPanel">Thêm sách</button>
                <button class="tab" data-target="#addCategoryPanel">Thêm thể loại</button>
                <button class="tab" data-target="#addAuthorPanel">Thêm tác giả</button>
            </div>
            <div id="addBookPanel" class="panel active">
                <!-- Form for adding a book -->
                <h3>Thêm sách</h3>
                <form action="publish_book.php" method="post" enctype="multipart/form-data">
                    <!-- Form fields for adding a book -->
                    <div class="form-group">
                        <label for="title">Tên sách:</label>
                        <input type="text" id="title" name="title" required>
                    </div>
                    <div class="form-group">
                        <label for="author">Tác giả:</label>
                        <select id="author" name="author_id" required>
                            <!-- Options fetched from the database -->
                            <?php
                            require '../admin/dbh.php';
                            $result = $conn->query("SELECT author_id, author_name FROM authors");
                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    echo "<option value='{$row['author_id']}'>{$row['author_name']}</option>";
                                }
                            } else {
                                echo "<option value=''>Không có tác giả nào</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="categories">Thể loại:</label>
                        <select id="categories" name="categories[]" multiple required>
                            <!-- Options fetched from the database -->
                            <?php
                            $result = $conn->query("SELECT category_id, category_name FROM categories");
                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    echo "<option value='{$row['category_id']}'>{$row['category_name']}</option>";
                                }
                            } else {
                                echo "<option value=''>Không có thể loại nào</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="publication_year">Năm xuất bản:</label>
                        <input type="number" id="publication_year" name="publication_year" required>
                    </div>
                    <div class="form-group">
                        <label for="publisher">Nhà xuất bản:</label>
                        <input type="text" id="publisher" name="publisher" required>
                    </div>
                    <div class="form-group">
                        <label for="price">Giá:</label>
                        <input type="number" step="0.01" id="price" name="price" required>
                    </div>
                    <div class="form-group">
                        <label for="quantity">Số lượng còn lại:</label>
                        <input type="number" id="quantity" name="quantity" required>
                    </div>
                    <div class="form-group">
                        <label for="cover_image">Bìa sách:</label>
                        <input type="file" id="cover_image" name="cover_image" required>
                    </div>
                    <div class="form-group">
                        <label for="description">Mô tả sách:</label>
                        <textarea rows="10" id="description" name="description" required></textarea>
                    </div>
                    <!-- Additional book information -->
                    <div class="form-group">
                        <label for="pages">Số trang:</label>
                        <input type="number" id="pages" name="pages" required>
                    </div>
                    <div class="form-group">
                        <label for="language">Ngôn ngữ:</label>
                        <input type="text" id="language" name="language" required>
                    </div>
                    <div class="form-group">
                        <label for="format">Hình thức:</label>
                        <input type="text" id="format" name="format" required>
                    </div>
                    <div class="form-group">
                        <label for="isbn">ISBN:</label>
                        <input type="text" id="isbn" name="isbn" required>
                    </div>
                    <div class="form-group">
                        <label for="chapters">Danh sách chương:</label>
                        <textarea rows="5" id="chapters" name="chapters" required></textarea>
                    </div>
                    <button type="submit"><p>Thêm sách</p></button>
                </form>
            </div>

            <div id="addCategoryPanel" class="panel">
                <h3>Thêm thể loại</h3>
                <form action="publish_category.php" method="post">
                    <div class="form-group">
                        <label for="category_name">Tên thể loại:</label>
                        <input type="text" id="category_name" name="category_name" required>
                    </div>
                    <button type="submit"><p>Thêm thể loại</p></button>
                </form>
            </div>

            <div id="addAuthorPanel" class="panel">
                <h3>Thêm tác giả</h3>
                <form action="publish_author.php" method="post">
                    <div class="form-group">
                        <label for="author_name">Tên tác giả:</label>
                        <input type="text" id="author_name" name="author_name" required>
                    </div>
                    <div class="form-group">
                        <label for="birth_date">Ngày sinh:</label>
                        <input type="date" id="birth_date" name="birth_date">
                    </div>
                    <div class="form-group">
                        <label for="nationality">Quốc tịch:</label>
                        <input type="text" id="nationality" name="nationality">
                    </div>
                    <div class="form-group">
                        <label for="biography">Tiểu sử:</label>
                        <textarea rows="5" id="biography" name="biography"></textarea>
                    </div>
                    <button type="submit"><p>Thêm tác giả</p></button>
                </form>
            </div>
        </div>
    </main>




    <footer style="background-image: url('../assets/footer.png')">
        <div class="footer-section footer-content">
            <p class="section-title">VỀ BOOKHUB</p>
            <div class="divider short-divider"></div>
            <p class="description">BookHub là nền tảng kết nối những người<br/>có niềm yêu thích sách lại với nhau.</p>
            <div class="social-links">
                <a href="https://facebook.com" target="_blank"><img src="../assets/facebook.png" alt="facebook" class="social-icon"></a>
                <a href="https://instagram.com" target="_blank"><img src="../assets/instagram.png" alt="instagram" class="social-icon"></a>
            </div>
        </div>
        <div class="footer-section link_contact">
           
        <p class="section-title">ĐƯỜNG DẪN</p>
            <div class="divider"></div>
            <ul class="links-list">
                <li><a href="../Book_Store/bookstore.php" class="myLink">Bookstore</a></li>
                <li><a href="../discuss/discuss.php" class="myLink">Thảo luận</a></li>
                <li><a href="../signin/signin.php" class="myLink">Đăng nhập</a></li>
                <li><a href="../search/search.php" class="myLink">Tìm kiếm</a></li>
            </ul>
        </div>
        <div class="footer-section contact">
            <p class="section-title">LIÊN HỆ</p>
            <div class="divider"></div>
            <table>
                <tr>
                    <td><img src="../assets/phone-call.png" alt="phone" class="contact-icon"></td>
                    <td class="contact-info">016.161.6161</td>
                </tr>
                <tr>
                    <td><img src="../assets/email.png" alt="mail" class="contact-icon"></td>
                    <td class="contact-info"><a href="mailto:group16@gmail.com" class="email-link">group16@gmail.com</a></td>
                </tr>
            </table>
        </div>
        <div class="footer-bottom">
            <p class="copyright">&copy; 2024 BookHub. All rights reserved.</p>
        </div>
    </footer>
 
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('.tab').forEach(tab => {
                tab.addEventListener('click', function() {
                    // Remove 'active' class from all tabs and panels
                    document.querySelectorAll('.tab').forEach(t => t.classList.remove('active'));
                    document.querySelectorAll('.panel').forEach(p => p.classList.remove('active'));

                    // Add 'active' class to the clicked tab and corresponding panel
                    this.classList.add('active');
                    document.querySelector(this.dataset.target).classList.add('active');
                });
            });
        });
    </script>

</body>
</html>
