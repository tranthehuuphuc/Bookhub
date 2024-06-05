<?php
session_start();

include './admin/dbh.php';
// Fetch all books from the database
$book_query = "SELECT * FROM books
                ORDER BY book_id DESC";
$book_result = $conn->query($book_query);

// Check if there are any books
if ($book_result->num_rows > 0) {
    // Fetch all rows and store them in an array
    $books = $book_result->fetch_all(MYSQLI_ASSOC);
}

// Updated SQL query to fetch the top 4 most ordered books
$book_query = "
    SELECT books.*, SUM(orderdetails.quantity) AS total_quantity
    FROM books
    JOIN orderdetails ON books.book_id = orderdetails.book_id
    GROUP BY books.book_id
    ORDER BY total_quantity DESC
    LIMIT 4
";

$book_result = $conn->query($book_query);

// Check if there are any books
if ($book_result->num_rows > 0) {
    // Fetch all rows and store them in an array
    $books_mostsold = $book_result->fetch_all(MYSQLI_ASSOC);
}

// Fetch top 5 categories by the number of books
$category_query = "
    SELECT c.category_id, c.category_name, COUNT(bc.book_id) as book_count
    FROM book_categories bc
    JOIN categories c ON bc.category_id = c.category_id
    GROUP BY bc.category_id
    ORDER BY book_count DESC
    LIMIT 5
";
$category_result = $conn->query($category_query);

$ratings_query = "
SELECT r.*, u.username
FROM ratings r
JOIN users u ON r.user_id = u.user_id
LIMIT 3";
$ratings_result = $conn->query($ratings_query);

// Check if there are any categories
if ($category_result->num_rows > 0) {
    // Fetch all rows and store them in an array
    $categories = $category_result->fetch_all(MYSQLI_ASSOC);
}

// Check if the user is logged in
$isLoggedIn = isset($_SESSION['user_id']);

// Function to render the navbar links based on user authentication status
function renderNavbarLinks($isLoggedIn) {
    if ($isLoggedIn) {
        // User is logged in
        echo '<a class="globalnav-item-show" href="./account/orders.php">Đơn hàng</a>';
        echo '<a class="globalnav-item-show" href="./account/cart.php">Giỏ hàng</a>';
        echo '<a class="globalnav-item-show" href="./account/profile.php">Tài khoản</a>';
        echo '<a class="globalnav-item-show" href="./signin/logout.php">Đăng xuất</a>';
        echo '<button id="profile-button"><img id="profile-icon" src="./assets/account.png" alt="Profile Icon"></button>';
    } else {
        // User is not logged in
        echo '<a class="globalnav-item" href="./signin/signin.php">Đăng nhập</a>';
    }
}
function renderfooterLinks($isLoggedIn) {
    if ($isLoggedIn) {
        echo '<li><a class="myLink" href="./account/profile.php">Tài khoản</a></li>';
        echo '<li><a class="myLink" href="./signin/logout.php">Đăng xuất</a></li>';
    } else {
        // User is not logged in
        echo '<li><a class="myLink" href="./signin/signin.php">Đăng nhập</a></li>';
    }
}
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
        <meta name="description" content="Explore, purchase, and engage in vibrant discussions about your favorite books on BookHub. Discover new reads and connect with fellow book lovers on our platform dedicated to fostering a thriving literary community.">
        <title>Home | BookHub</title>
        <link rel="stylesheet" type="text/css" href="./style.css">
        <link rel="stylesheet" type="text/css" href="./navbar.css">
        <link rel="stylesheet" type="text/css" href="./footer.css">
        <link rel="apple-touch-icon" sizes="180x180" href="./favicon_io/apple-touch-icon.png">
        <link rel="icon" type="image/png" sizes="32x32" href="./favicon_io/favicon-32x32.png">
        <link rel="icon" type="image/png" sizes="16x16" href="./favicon_io/favicon-16x16.png">
        <link rel="manifest" href="./favicon_io/site.webmanifest">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" />
    </head>
    
    <body>
        <h1 class="visuallyhidden">BookHub</h1>

        <!-- Navbar -->
        <nav class="navbar">
            <input type="checkbox" id="sidebar-active">
                <!-- New logo image that only appears when the navbar is collapsed -->
            <a href="./index.php"><img id="new-logo" src="./assets/BookHub.png" alt="New Logo"></a>

            <label for="sidebar-active" class="open-sidebar-button">
                <svg xmlns="http://www.w3.org/2000/svg" height="32" viewBox="0 -960 960 960" width="32" fill="#FFFFFF"><path d="M120-240v-80h720v80H120Zm0-200v-80h720v80H120Zm0-200v-80h720v80H120Z"/></svg>
            </label>

            <label id="overlay" for="sidebar-active"></label>

            <div class="link-container">
                <label for="sidebar-active" class="close-sidebar-button">
                    <svg xmlns="http://www.w3.org/2000/svg" height="32" viewBox="0 -960 960 960" width="32" fill="#FFFFFF"><path d="m256-200-56-56 224-224-224-224 56-56 224 224 224-224 56 56-224 224 224 224-56 56-224-224-224 224Z"/></svg>
                </label>
                
                <a class="logo-link" href="./index.php"><img id="BookHub" src="./assets/logo.png" alt="BookHub"></a>
                <a class="globalnav-item" href="./Book_Store/bookstore.php">Bookstore</a>
                <a class="globalnav-item" href="./aboutUs/aboutUs.php">Về Chúng Tôi</a>
                <a class="globalnav-item" href="./search/search.php">Tìm kiếm</a>
                <?php renderNavbarLinks($isLoggedIn); ?>
            </div>
        </nav>

         <!-- Account options -->
         <div id="blur-overlay" class="hidden"></div>
         <div id="account-options" class="hidden">
             <p id="myprofile">Hồ sơ của tôi</p>
             <div style="background-color: #d9d9d9; width: 25%; height: 0.05vw; margin: 0; padding: 0;"></div>
             <ul>
                 <li><img class="option-icons" src="./assets/orders.png"><a href="./account/orders.php">Đơn hàng</a></li>
                 <li><img class="option-icons" src="./assets/saves.png"><a href="./account/cart.php">Giỏ hàng</a></li>
                 <li><img class="option-icons" src="./assets/setting.png"><a href="./account/profile.php">Tài khoản</a></li>
                 <li><img class="option-icons" src="./assets/join.png"><a href="./signin/logout.php">Đăng xuất</a></li>
             </ul>
         </div>
         <script>
             function ShowAccountOptions() {
                 var overlay = document.getElementById("blur-overlay");
                 var accountOptions = document.getElementById("account-options");
                 overlay.classList.toggle("hidden");
 
                 if (overlay.classList.contains('hidden')) {
                     accountOptions.classList.remove("show");
                     setTimeout(() => accountOptions.classList.add("hidden"), 500);
                 } else {
                     accountOptions.classList.remove("hidden");
                     setTimeout(() => accountOptions.classList.add("show"), 0);
                 }
             }
 
             function CloseAccountOptions() {
                 var overlay = document.getElementById("blur-overlay");
                 var accountOptions = document.getElementById("account-options");
 
                 overlay.classList.toggle("hidden");
                 accountOptions.classList.remove("show");
                 setTimeout(() => accountOptions.classList.add("hidden"), 500);
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
        <div id="topimg">
                <div class="text">
                    <h2>Mua bán, trao đổi, thảo luận và cùng chia sẻ về những cuốn sách mà bạn yêu thích.</h2>
                    <div class="button-top">
                        <a href="./signin/signin.php" class="topbtn">Đăng ký ngay&nbsp;&#x276F;</a>
                        <a href="./aboutUs/aboutUs.php" class="more">Tìm hiểu thêm</a>
                    </div>
                </div>
            </div>

            <div style="margin-top: 2vw; margin-left:8vw;width: 85%; height: 1px; background-color: #F08A5D;"></div>
        
                <h2><a class="promotion-title" href="./index.php">SẢN PHẨM MỚI ></a></h2>
                <div class="scroll-container">
                    <div class="scroll-arrow left" onclick="scrollLeft()"><</div>
                    <div class="promotion-p">
                        <?php if (!empty($books)): ?>
                            <?php foreach ($books as $index => $book): ?>
                                <a class="promotionnav-item" href="./Book/BookDetail/BookDetail.php?book_id=<?php echo $book['book_id'] ?>">
                                    <img src="<?php echo './admin/uploads/' . $book['cover_image']; ?>" class="promotion-image"><br/>
                                    <div class="des">
                                        <span><?php echo htmlspecialchars($book['publisher']); ?></span>
                                        <h5><?php echo htmlspecialchars($book['price']); ?>đ</h5>
                                        <div class="star">
                                            <?php 
                                            $rating = floor($book['rating']);
                                            for ($i = 0; $i < 5; $i++): 
                                                if ($i < $rating): ?>
                                                    <i class="fas fa-star" style="color:gold"></i>
                                                <?php else: ?>
                                                    <i class="far fa-star" style="color:gold"></i>
                                                <?php endif; 
                                            endfor; 
                                            ?>
                                        </div>
                                    </div>
                                </a>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <p>No books found.</p>
                        <?php endif; ?>
                    </div>
                    <div class="scroll-arrow right" onclick="scrollRight()">></div>
                </div>
            </div>


            <script>
                function scrollLeft() {
                    const container = document.querySelector('.promotion-p');
                    container.scrollBy({
                        left: -200, // Adjust based on item width
                        behavior: 'smooth'
                    });
                }

                function scrollRight() {
                    const container = document.querySelector('.promotion-p');
                    container.scrollBy({
                        left: 200, // Adjust based on item width
                        behavior: 'smooth'
                    });
                }
                document.addEventListener('DOMContentLoaded', function() {
                    const container = document.querySelector('.promotion-p');

                    let isDown = false;
                    let startX;
                    let scrollLeft;

                    container.addEventListener('mousedown', (e) => {
                        isDown = true;
                        container.classList.add('active');
                        startX = e.pageX - container.offsetLeft;
                        scrollLeft = container.scrollLeft;
                    });

                    container.addEventListener('mouseleave', () => {
                        isDown = false;
                        container.classList.remove('active');
                    });

                    container.addEventListener('mouseup', () => {
                        isDown = false;
                        container.classList.remove('active');
                    });

                    container.addEventListener('mousemove', (e) => {
                        if(!isDown) return;
                        e.preventDefault();
                        const x = e.pageX - container.offsetLeft;
                        const walk = (x - startX) * 3; //scroll-fast
                        container.scrollLeft = scrollLeft - walk;
                    });

                    container.addEventListener('touchstart', (e) => {
                        isDown = true;
                        startX = e.touches[0].pageX - container.offsetLeft;
                        scrollLeft = container.scrollLeft;
                    });

                    container.addEventListener('touchend', () => {
                        isDown = false;
                    });

                    container.addEventListener('touchmove', (e) => {
                        if(!isDown) return;
                        const x = e.touches[0].pageX - container.offsetLeft;
                        const walk = (x - startX) * 3; //scroll-fast
                        container.scrollLeft = scrollLeft - walk;
                    });
                });

                function scrollLeft() {
                    const container = document.querySelector('.promotion-p');
                    container.scrollBy({
                        left: -200, // Adjust based on item width
                        behavior: 'smooth'
                    });
                }

                function scrollRight() {
                    const container = document.querySelector('.promotion-p');
                    container.scrollBy({
                        left: 200, // Adjust based on item width
                        behavior: 'smooth'
                    });
                }

            </script>

            <div style="margin-top: 2vw; margin-left:8vw;width: 85%; height: 1px; background-color: #F08A5D;"></div>
        
            <div id="promotion">
                <h2><a class="promotion-title" href="./index.php">SẢN PHẨM BÁN CHẠY ></a></h2>
                <div class="scroll-container">
                    <div class="scroll-arrow left" onclick="scrollLeft()"><</div>
                    <div class="promotion-p">
                        <?php if (!empty($books)): ?>
                            <?php foreach ($books_mostsold as $index => $book_mostsold): ?>
                                <a class="promotionnav-item" href="./Book/BookDetail/BookDetail.php?book_id=<?php echo $book_mostsold['book_id'] ?>">
                                    <img src="<?php echo './admin/uploads/' . $book_mostsold['cover_image']; ?>" class="promotion-image"><br/>
                                    <div class="des">
                                        <span><?php echo htmlspecialchars($book_mostsold['publisher']); ?></span>
                                        <h5><?php echo htmlspecialchars($book_mostsold['price']); ?>đ</h5>
                                        <div class="star">
                                            <?php 
                                            $rating = floor($book_mostsold['rating']);
                                            for ($i = 0; $i < 5; $i++): 
                                                if ($i < $rating): ?>
                                                    <i class="fas fa-star" style="color:gold"></i>
                                                <?php else: ?>
                                                    <i class="far fa-star" style="color:gold"></i>
                                                <?php endif; 
                                            endfor; 
                                            ?>
                                        </div>
                                    </div>
                                </a>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <p>No books found.</p>
                        <?php endif; ?>
                    </div>
                    <div class="scroll-arrow right" onclick="scrollRight()">></div>
                </div>
            </div>
                
            <div style="margin-top: 2vw; margin-left:8vw;width: 85%; height: 1px; background-color: #F08A5D;"></div>
            <div>     
                <h2><a class="promotion-title" href="./index.php">THỂ LOẠI NỔI BẬT ></a></h2>
                <div class="category-container">
                <?php if (!empty($categories)): ?>
                    <?php foreach ($categories as $category): ?>
                        <div class="category-item">
                            <a class="category-link" href="./Book_Store/bookstore.php">
                                <?php echo htmlspecialchars($category['category_name']); ?>
                            </a>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p>No categories found.</p>
                <?php endif; ?>
                </div>
            </div>
        
            <div style="margin-top: 2vw; margin-left:8vw;width: 85%; height: 1px; background-color: #F08A5D;"></div>
            <div class="ratings">
                <h2><a class="promotion-title" href="./index.php">ĐÁNH GIÁ MỚI NHẤT ></a></h2>
                <div class="rating-book">
                    <?php while ($rating = $ratings_result->fetch_assoc()): ?>
                        <?php 
                        // Assuming you have a column named 'avatar' in your ratings table
                        // and it stores the path to the user's avatar image
                        $avatar_path = !empty($rating['avatar']) ? htmlspecialchars($rating['avatar']) : "./discuss/d_assets/user.png"; 
                        
                        // Fetch the corresponding book title from the database using SQL query
                        $book_id = $rating['book_id'];
                        $sql = "SELECT title FROM books WHERE book_id = $book_id";
                        $result = $conn->query($sql);
                        $row = $result->fetch_assoc();
                        $book_title = $row['title'];
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
                                            <i class="fas fa-star" style="color: gold;"></i>
                                        <?php else: ?>
                                            <i class="far fa-star" style="color: gold;"></i>
                                        <?php endif; ?>
                                    <?php endfor; ?>
                                </div>
                                <div class="rating-comment">
                                    <p style="font-weight: 100;"><?php echo htmlspecialchars($rating['review']); ?></p>
                                </div>
                                <a class="book-title" href="./Book/BookDetail/BookDetail.php?book_id=<?php echo $rating['book_id'] ?>" >
                                    <p style="font-weight: bold;">Sách: <?php echo htmlspecialchars($book_title); ?></p>
                                </a>
                             </div>
                             <div style="margin-top: 2vw; margin-left:8vw;width: 85%; height: 1px; background-color: #F08A5D;"></div>
                        <?php endwhile; ?>
                    </div>
                </div>
            </div>

            <h2><a class="promotion-title" href="./index.php">CÂU NÓI HAY ></a></h2>
            <div class="container">
                <h1>Random Quotes</h1>
                <div id="quote-grid">
                    <!-- Quotes will be dynamically added here -->
                </div>
                <button id="refresh-btn">Refresh Quotes</button>
            </div>
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
            <script>
                $(document).ready(function(){
                    // Function to refresh quotes
                    function refreshQuotes() {
                        $.ajax({
                            type: 'GET',
                            url: 'fetch_quotes.php',
                            success: function(response){
                                $('#quote-grid').html(response);
                            }
                        });
                    }

                    // Initial page load
                    refreshQuotes();

                    // Refresh quotes when button is clicked
                    $('#refresh-btn').click(function(){
                        refreshQuotes();
                    });
                });

            </script>

        <div style="margin-top: 2vw; margin-left:8vw;width: 85%; height: 1px; background-color: #F08A5D;"></div>
        <h2><a class="promotion-title" href="./index.php">ĐỘI NGŨ BOOKHUB ></a></h2>
        <div class="team-section">
            <div class="team-grid">
                <div class="team-member">
                    <img src="./discuss/d_assets/user.png" alt="Team Member 1" class="team-member-img">
                    <div class="member-details">
                        <h3>Trần Thế Hữu Phúc</h3>
                        <p>Front-end, Back-end</p>
                        <p>Email: tranthehuuphuc@icloud.com</p>
                    </div>
                </div>
                <div class="team-member">
                    <img src="./discuss/d_assets/user.png" alt="Team Member 2" class="team-member-img">
                    <div class="member-details">
                        <h3>Nguyễn Thị Hồng Lam</h3>
                        <p>Front-end</p>
                    </div>
                </div>
                <div class="team-member">
                    <img src="./discuss/d_assets/user.png" alt="Team Member 3" class="team-member-img">
                    <div class="member-details">
                        <h3>Lê Thị Bích Tuyền</h3>
                        <p>Front-end</p>
                    </div>
                </div>
                <div class="team-member">
                    <img src="./discuss/d_assets/user.png" alt="Team Member 4" class="team-member-img">
                    <div class="member-details">
                        <h3>Trần Thị Thúy Vy</h3>
                        <p>Front-end, Back-end</p>
                    </div>
                </div>
            </div>
        </div>

            <div style="margin-top: 2vw; margin-left:8vw;width: 85%; height: 1px; background-color: #F08A5D;"></div>

            <div class="subscribe-form-container">
                <h2>Nhận thông báo mới nhất từ BookHub</h2>
                <form id="subscribe-form" action="subscribe.php" method="post">
                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" required>

                    <button type="submit">Subscribe</button>
                </form>
                <div id="subscribe-message" style="display: none;"></div>
            </div>
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
            <script>
            $(document).ready(function(){
                $('#subscribe-form').submit(function(e){
                    e.preventDefault(); // Prevent form submission
                    var formData = $(this).serialize(); // Serialize form data
                    $.ajax({
                        type: 'POST',
                        url: 'subscribe.php',
                        data: formData,
                        success: function(response){
                            // Show appropriate message based on response
                            if (response === 'subscribed') {
                                $('#subscribe-message').text('Bạn đã đăng ký nhận thông báo rồi.').css('color', 'red').show();
                            } else if (response === 'success') {
                                $('#subscribe-message').text('Đăng ký nhận thông báo thành công.').css('color', 'green').show();
                            } else {
                                $('#subscribe-message').text('An error occurred. Please try again later.').css('color', 'red').show();
                            }
                        }
                    });
                });
            });
            </script>

        </main>

        <footer>
            <div class="footer-section footer-content">
                <p class="section-title">VỀ BOOKHUB</p>
                <div class="divider short-divider"></div>
                <p class="description">BookHub là nền tảng kết nối những người<br/>có niềm yêu thích sách lại với nhau.</p>
                <div class="social-links">
                    <a href="https://facebook.com" target="_blank"><img src="./assets/facebook.png" alt="facebook" class="social-icon"></a>
                    <a href="https://instagram.com" target="_blank"><img src="./assets/instagram.png" alt="instagram" class="social-icon"></a>
                </div>
            </div>
            <div class="footer-section link_contact">
                <p class="section-title">ĐƯỜNG DẪN</p>
                <div class="divider"></div>
                <ul class="links-list">
                    <li><a href="./Book_Store/bookstore.php" class="myLink">Bookstore</a></li>
                    <li><a href="./aboutUs/aboutUs.php" class="myLink">Về Chúng Tôi</a></li>
                    <?php renderfooterLinks($isLoggedIn); ?>
                    <li><a href="./search/search.php" class="myLink">Tìm kiếm</a></li>
                </ul>
            </div>
            <div class="footer-section contact">
                <p class="section-title">LIÊN HỆ</p>
                <div class="divider"></div>
                <table>
                    <tr>
                        <td><img src="./assets/phone-call.png" alt="phone" class="contact-icon"></td>
                        <td class="contact-info">016.161.6161</td>
                    </tr>
                    <tr>
                        <td><img src="./assets/email.png" alt="mail" class="contact-icon"></td>
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
