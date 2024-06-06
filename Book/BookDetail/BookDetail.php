<?php
    session_start();
    require_once '../../admin/dbh.php';

    if (isset($_GET['book_id'])) {
        $_SESSION['book_id'] = $_GET['book_id'];
        $book_id = $_SESSION['book_id'];
        $book_query = "SELECT * FROM books WHERE book_id = $book_id";
        $book_result = $conn->query($book_query);
        $book = $book_result->fetch_assoc();

        // Save book details to json file
        $json_book = json_encode($book);
        
        // Fetch author details
        $author_id = $book['author_id'];
        $author_query = "SELECT * FROM authors WHERE author_id = $author_id";
        $author_result = $conn->query($author_query);
        $author = $author_result->fetch_assoc();
        
        // Fetch book chapters
        $chapters_query = "SELECT * FROM book_chapters WHERE book_id = $book_id";
        $chapters_result = $conn->query($chapters_query);

        $bookinf_query = "SELECT * FROM book_information WHERE book_id = $book_id";
        $bookinf_result = $conn->query($bookinf_query);
        $bookinf = $bookinf_result->fetch_assoc();
        
        // Fetch categories
        $categories_query = "SELECT c.category_name FROM categories c
                             JOIN book_categories bc ON c.category_id = bc.category_id
                             WHERE bc.book_id = $book_id";
        $categories_result = $conn->query($categories_query);
        
        // Fetch ratings
        $ratings_query = "
        SELECT r.*, u.username
        FROM ratings r
        JOIN users u ON r.user_id = u.user_id
        WHERE r.book_id = $book_id
        LIMIT 3";
        $ratings_result = $conn->query($ratings_query);
    

        // Check if the user is logged in
        $isLoggedIn = isset($_SESSION['user_id']);
        $hasBook = false;
        if ($isLoggedIn) {
            $user_id = $_SESSION['user_id'];
            $mybooks_query = "SELECT * FROM mybooks WHERE user_id = $user_id AND book_id = $book_id";
            $mybooks_result = $conn->query($mybooks_query);
            if ($mybooks_result->num_rows > 0) {
                $hasBook = true;
            }
        }

        // Function to render the navbar links based on user authentication status
        function renderNavbarLinks($isLoggedIn) {
            if ($isLoggedIn) {
                // User is logged in
                echo '<a class="globalnav-item-show" href="../../account/orders.php">Đơn hàng</a>';
                echo '<a class="globalnav-item-show" href="../../account/cart.php">Giỏ hàng</a>';
                echo '<a class="globalnav-item-show" href="../../account/profile.php">Tài khoản</a>';
                echo '<a class="globalnav-item-show" href="../../signin/logout.php">Đăng xuất</a>';
                echo '<button id="profile-button"><img id="profile-icon" src="../../assets/account.png" alt="Profile Icon"></button>';
            } else {
                // User is not logged in
                echo '<a class="globalnav-item" href="../signin/signin.php">Đăng nhập</a>';
            }
        }
        function renderfooterLinks($isLoggedIn) {
            if ($isLoggedIn) {
                echo '<li><a class="myLink" href="../../account/profile.php">Tài khoản</a></li>';
                echo '<li><a class="myLink" href="../../signin/logout.php">Đăng xuất</a></li>';
            } else {
                // User is not logged in
                echo '<li><a class="myLink" href="../../signin/signin.php">Đăng nhập</a></li>';
            }
        }
    } else {
        // Handle the case where book_id is not set
        echo "No book ID provided.";
        header("Location: ../../index.php");
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
        <title>Book Detail | BookHub</title>
        <link rel="stylesheet" type="text/css" href="../../style.css">
        <link rel="stylesheet" type="text/css" href="../../navbar.css">
        <link rel="stylesheet" type="text/css" href="../../footer.css">
        <link rel="stylesheet" type="text/css" href="./BookDetail.css">
        <link rel="apple-touch-icon" sizes="180x180" href="../../favicon_io/apple-touch-icon.png">
        <link rel="icon" type="image/png" sizes="32x32" href="../../favicon_io/favicon-32x32.png">
        <link rel="icon" type="image/png" sizes="16x16" href="../../favicon_io/favicon-16x16.png">
        <link rel="manifest" href="../../favicon_io/site.webmanifest">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" />
        <link rel="stylesheet" type="text/css" href="../../navbar.css">
        <link rel="stylesheet" type="text/css" href="../../footer.css">
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <style>
            .hidden-chapter {
                display: none;
            }
        </style>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                var book = document.querySelector('.book');
                var footer = document.querySelector('footer');
        
                // Function to update the book position
                var updateBookPosition = function() {
                    var footerRect = footer.getBoundingClientRect();
                    var bookRect = book.getBoundingClientRect();
        
                    if (footerRect.top <= window.innerHeight) {
                        book.style.position = 'absolute';
                        book.style.top = (window.scrollY + footerRect.top - bookRect.height - 20) + 'px';
                    } else {
                        book.style.position = 'fixed';
                        book.style.top = '100px';
                    }
                };
        
                // Function to check the screen width and enable/disable script functionality
                var checkScreenWidth = function() {
                    var screenWidth = window.innerWidth;
                    if (screenWidth > 768) { // Set your desired width here
                        // Enable the script
                        window.addEventListener('scroll', updateBookPosition);
                        updateBookPosition(); // Initial check
                    } else {
                        // Disable the script
                        window.removeEventListener('scroll', updateBookPosition);
                        book.style.position = 'static'; // Reset to default
                    }
                };
        
                // Initial check on page load
                checkScreenWidth();
        
                // Listen for resize events to enable/disable the script as needed
                window.addEventListener('resize', checkScreenWidth);
            });
        </script>
        
    </head>

    
    <body>
        <h1 class="visuallyhidden">BookHub</h1>

    <!-- Navbar -->
    <nav class="navbar">
        <input type="checkbox" id="sidebar-active">
            <!-- New logo image that only appears when the navbar is collapsed -->
        <a href="../../index.php"><img id="new-logo" src="../../assets/BookHub.png" alt="New Logo"></a>

        <label for="sidebar-active" class="open-sidebar-button">
            <svg xmlns="http://www.w3.org/2000/svg" height="32" viewBox="0 -960 960 960" width="32" fill="#FFFFFF"><path d="M120-240v-80h720v80H120Zm0-200v-80h720v80H120Zm0-200v-80h720v80H120Z"/></svg>
        </label>

        <label id="overlay" for="sidebar-active"></label>

        <div class="link-container">
            <label for="sidebar-active" class="close-sidebar-button">
                <svg xmlns="http://www.w3.org/2000/svg" height="32" viewBox="0 -960 960 960" width="32" fill="#FFFFFF"><path d="m256-200-56-56 224-224-224-224 56-56 224 224 224-224 56 56-224 224 224 224-56 56-224-224-224 224Z"/></svg>
            </label>
            
            <a class="logo-link" href="../../index.php"><img id="BookHub" src="../../assets/logo.png" alt="BookHub"></a>
            <a class="globalnav-item" href="../../Book_Store/bookstore.php">Bookstore</a>
            <a class="globalnav-item" href="../../discuss/discuss.php">Về Chúng Tôi</a>
            <a class="globalnav-item" href="../../search/search.php">Tìm kiếm</a>
            <?php renderNavbarLinks($isLoggedIn); ?>
        </div>
    </nav>

    <!-- Account options -->
    <div id="blur-overlay" class="hidden"></div>
    <div id="account-options" class="hidden">
        <p id="myprofile">Hồ sơ của tôi</p>
        <div style="background-color: #d9d9d9; width: 25%; height: 0.05vw; margin: 0; padding: 0;"></div>
        <ul>
            <li><img class="option-icons" src="../../assets/orders.png"><a href="../../account/orders.php">Đơn hàng</a></li>
            <li><img class="option-icons" src="../../assets/saves.png"><a href="../../account/cart.php">Giỏ hàng</a></li>
            <li><img class="option-icons" src="../../assets/setting.png"><a href="../../account/profile.php">Tài khoản</a></li>
            <li><img class="option-icons" src="../../assets/join.png"><a href="../../signin/logout.php">Đăng xuất</a></li>
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

    <main>
        <div class="maindiv">
            <div class="book">
                <div class="book-image" style="display: flex; justify-content: center;">
                    <img src="<?php echo  '../../admin/uploads/' .  $book['cover_image']; ?>" alt="<?php echo $book['title']; ?>" style="width: auto; height: 400px; box-shadow: 2px 2px 2px 2px rgba(0, 0, 0, 0.4);">
                </div>
                <div style="text-align: center;">
                    <!-- <a href="#" style="text-decoration: none;">
                        <h3 style="background-color: #F08A5D; padding: 14px; color: #ffffff; border-radius: 30px;">Tìm hiểu thêm</h3>
                    </a> -->
                    <a href="#" style="text-decoration: none;">
                        <div id="add_to_cart"><h3 style="background-color: #F08A5D; padding: 14px; color: #ffffff; border-radius: 30px;">Thêm vào giỏ hàng</h3></div>
                        <?php if ($hasBook): ?>
                            <div id="readBtn" onclick="window.location.href='../BookReader/BookReader.php?book_id=<?php echo $book_id; ?>'"><h3 style="background-color: #fff; padding: 14px; color: #F08A5D; border-radius: 30px;border:solid 2px #F08A5D">Đọc sách</h3></div>
                        <?php endif; ?>
                        <p class="book-price"><?php echo $book['price'] ?>đ</p>
                                <!-- Render the "Read Book" button if the user has the book -->
                    </a>
                </div>
            </div>

            <!-- Ajax request to add the book to the cart -->
            <script>
                document.getElementById('add_to_cart').addEventListener('click', function() {
                    var book = <?php echo $json_book; ?>;
                    book.quantity = 1;

                    if (!book.book_id || !book.cover_image || !book.price) {
                        alert('Dữ liệu không hợp lệ');
                        return;
                    }
                    console.log(book.cover_image, book.price, book.book_id, book.quantity);
                    $.ajax({
                        url: 'add_to_cart.php',
                        type: 'POST',
                        dataType: 'json',
                        data: {
                            book_id: book.book_id,
                            cover_image: book.cover_image,
                            price: book.price,
                            quantity: book.quantity
                        },
                        success: function(response) {
                            // Show a success message
                            if (response.status === 'success') {
                                alert(response.message);
                            } else {
                                alert(response.message);
                            }
                        },
                        error: function(xhr, status, error) {
                            console.error(xhr.responseText); 
                            alert('Đã xảy ra lỗi: ' + error);
                        }
                    });
                });
            </script>

            <div class="book-detail" style="margin-left: 250px; margin-right: 100px;">
                <h1 style="font-weight: 700; margin-bottom: 0;"><i><?php echo $book['title']; ?></i></h1>
                
                <div style="display: inline-flex">
                    <h3 style="font-weight: 100">Tác giả:&#160</h3>
                    <a class="author-name" href="#" style="text-decoration: none;">
                        <h3 style="font-weight: 500; color: #F08A5D;"><?php echo $author['author_name']; ?></h3>
                    </a>
                </div>
                <br/>
                <hr>
                <div>
                    <h3 style="font-weight: 600;">Giới thiệu sách:</h3>
                    <p style="font-weight: 100; text-align: justify;"><?php echo $book['description']; ?></p>
                    <br/>
                    <div class="genres" style="display: inline-flex">
                        <h3 style="font-weight: 600;">Thể loại:&#160</h3>
                        <?php while ($category = $categories_result->fetch_assoc()) { ?>
                            <a href="#" style="text-decoration: none;">
                                <h4 style="font-weight: 100; color: #ffffff; background-color: #F08A5D; border-radius: 10px; padding: 4px;">
                                    <?php echo $category['category_name']; ?>
                                </h4>
                            </a>
                            <a href="#" style="text-decoration: none;"><h3>&#160</h3></a>
                        <?php } ?>
                    </div>
                    <h3 style="font-weight: 600;">Giới thiệu tác giả:</h3>
                    <div class="author-detail" style="display: inline-flex;">
                        <!-- <img src="path_to_author_image" alt="author1" style="width: 150px; height: 150px; border-radius: 50%; border: 5px solid #F08A5D;"> -->
                        <div style="margin-left: 20px;">
                            <h3 style="font-weight: 500;"><?php echo $author['author_name']; ?></h3>
                            <p style="font-weight: 100; text-align: justify;"><?php echo $author['biography']; ?></p>
                        </div>
                    </div>
                    <br/><br/>
                    <hr>
                    <div class="product-info">
                        <h3 style="font-weight: 600;">Thông tin sản phẩm:</h3>
                        <div style="display: inline-flex; flex-wrap: wrap;">
                            <table style="border-collapse: separate; margin-right: 100px;">
                                <tr class="tr-book">
                                    <td class="td-book"><h4 style="font-weight: 500;">Nhà xuất bản:&#160</h4></td>
                                    <td class="td-book"><h4 style="font-weight: 100;"><?php echo $book['publisher']; ?></h4></td>
                                </tr>
                                <tr class="tr-book">
                                    <td class="td-book"><h4 style="font-weight: 500;">Ngày xuất bản:&#160</h4></td>
                                    <td class="td-book"><h4 style="font-weight: 100;"><?php echo $book['publication_year']; ?></h4></td>
                                </tr>
                                <tr class="tr-book">
                                    <td class="td-book"><h4 style="font-weight: 500;">Số trang:&#160</h4></td>
                                    <td class="td-book"><h4 style="font-weight: 100;"><?php echo $bookinf['number_of_pages']; ?></h4></td>
                                </tr>
                                <tr class="tr-book">
                                    <td class="td-book"><h4 style="font-weight: 500;">Giá:&#160</h4></td>
                                    <td class="td-book"><h4 style="font-weight: 100;"><?php echo $book['price']; ?>.000đ</h4></td>
                                </tr>
                            </table>
                            <table style="border-collapse: separate;">
                                <tr class="tr-book">
                                    <td class="td-book"><h4 style="font-weight: 500;">Ngôn ngữ:&#160</h4></td>
                                    <td class="td-book"><h4 style="font-weight: 100;"><?php echo $bookinf['language']; ?></h4></td>
                                </tr>
                                <tr class="tr-book">
                                    <td class="td-book"><h4 style="font-weight: 500;">Hình thức:&#160</h4></td>
                                    <td class="td-book"><h4 style="font-weight: 100;"><?php echo $bookinf['format']; ?></h4></td>
                                </tr>
                                <tr class="tr-book">
                                    <td class="td-book"><h4 style="font-weight: 500;">ISBN:&#160</h4></td>
                                    <td class="td-book"><h4 style="font-weight: 100;"><?php echo $bookinf['ISBN']; ?></h4></td>
                                </tr>
                                <tr class="tr-book">
                                    <td class="td-book"><h4 style="font-weight: 500;"></h4></td>
                                    <td class="td-book"><h4 style="font-weight: 100;"></h4></td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    <br/>
                    <h3 style="font-weight: 600;">Danh sách chương:</h3>
                    <ul style="list-style-type:none">
                        <?php
                        $counter = 0;
                        while ($chapter = $chapters_result->fetch_assoc()) {
                            $counter++;
                            $hidden_class = ($counter > 5) ? 'hidden-chapter' : '';
                        ?>
                            <li class="<?php echo $hidden_class; ?>">
                                <h4 style="font-weight: 100;"><?php echo $counter . '. ' . $chapter['chapter_title']; ?></h4>
                            </li>
                        <?php
                        }
                        ?>
                        <?php if ($counter > 5) { ?>
                            <li>
                                <button id="showMoreChapters" onclick="showMoreChapters()">Show More Chapters</button>
                            </li>
                        <?php } ?>
                    </ul>


                    <script>
                        function showMoreChapters() {
                            var hiddenChapters = document.querySelectorAll('.hidden-chapter');
                            hiddenChapters.forEach(function(chapter) {
                                chapter.classList.remove('hidden-chapter');
                            });
                            document.getElementById('showMoreChapters').style.display = 'none';
                        }
                    </script>

                </div>
                <hr>
                <div class="same-author">
                    <h3 style="font-weight: 600;">Sách cùng tác giả &#x203A;</h3>
                    <div class="row" style="display:flex;" >
                        <?php
                        // Assuming $author_id holds the ID of the current author
                        $author_id = $book['author_id'];
                        $current_book_id = $book['book_id']; // Assuming 'id' is the primary key of the books table

                        // Query to fetch books with the same author excluding the current book
                        $same_author_query = "SELECT * FROM books WHERE author_id = $author_id AND book_id != $current_book_id LIMIT 4";
                        $same_author_result = $conn->query($same_author_query);

                        // Loop through the result set and display cover images
                        while ($same_author_book = $same_author_result->fetch_assoc()) {
                            ?>
                            <div class="col-md-3">
                                <?php
                                // Generating the URL with the book_id as a parameter
                                $book_id = $same_author_book['book_id'];
                                $url = 'BookDetail.php?book_id=' . $book_id;
                                ?>
                                <a href="<?php echo $url; ?>">
                                    <img src="<?php echo '../../admin/uploads/' . htmlspecialchars($same_author_book['cover_image']); ?>" alt="Book Cover" class="book-cover" height="80%">
                                </a>
                            </div>
                            <?php
                        }
                        ?>
                    </div>
                </div>



                <hr>
                <div class="rating-book">
                    <h3 style="font-weight: 600;">Đánh giá:</h3>
                    <?php while ($rating = $ratings_result->fetch_assoc()): ?>
                        <?php 
                        // Assuming you have a column named 'avatar' in your ratings table
                        // and it stores the path to the user's avatar image
                        $avatar_path = !empty($rating['avatar']) ? htmlspecialchars($rating['avatar']) : "../../discuss/d_assets/user.png"; 
                        ?>
                        <div class="rating">
                            <div class="user">
                                <img src="<?php echo $avatar_path; ?>" alt="User Avatar" class="avatar" width="50px">
                                <h4 class="user-name">@<?php echo htmlspecialchars($rating['username']); ?></h4>
                                <h4 class="rating-time"><?php echo htmlspecialchars($rating['rating_date']); ?></h4>
                            </div>
                            <div class="star">
                                <?php for ($i = 0; $i < 5; $i++): ?>
                                    <?php if ($i < (int)$rating['rating']): ?>
                                        <i class="fas fa-star" style="color: gold"></i>
                                    <?php else: ?>
                                        <i class="far fa-star" style="color:gold"></i>
                                    <?php endif; ?>
                                <?php endfor; ?>
                            </div>
                            <div class="rating-comment">
                                <p style="font-weight: 100;"><?php echo htmlspecialchars($rating['review']); ?></p>
                            </div>
                        </div>
                        <hr />
                    <?php endwhile; ?>
                </div>



                <a href="../../discuss/discuss.php" style="text-decoration: none;color: #F08A5D;font-style: italic;text-align: right;"><h3 style="font-weight: 600;">Xem tất cả đánh giá</h3></a>

            </div>
        </div>
    </main>
    

    <footer>
        <div class="footer-section footer-content">
            <p class="section-title">VỀ BOOKHUB</p>
            <div class="divider short-divider"></div>
            <p class="description">BookHub là nền tảng kết nối những người<br/>có niềm yêu thích sách lại với nhau.</p>
            <div class="social-links">
                <a href="https://facebook.com" target="_blank"><img src="../../assets/facebook.png" alt="facebook" class="social-icon"></a>
                <a href="https://instagram.com" target="_blank"><img src="../../assets/instagram.png" alt="instagram" class="social-icon"></a>
            </div>
        </div>
        <div class="footer-section link_contact">
            <p class="section-title">ĐƯỜNG DẪN</p>
            <div class="divider"></div>
            <ul class="links-list">
                <li><a href="../../Book_Store/bookstore.php" class="myLink">Bookstore</a></li>
                <li><a href="../../discuss/discuss.php" class="myLink">Về Chúng Tôi</a></li>
                <?php renderfooterLinks($isLoggedIn); ?>
                <li><a href="../../search/search.php" class="myLink">Tìm kiếm</a></li>
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
                    <td class="contact-info"><a href="mailto:group16@gmail.com" class="email-link">group16@gmail.com</a></td>
                </tr>
            </table>
        </div>
        <div class="footer-bottom">
            <p class="copyright">&copy; 2024 BookHub. All rights reserved.</p>
        </div>
    </footer>
    </body>
</html>