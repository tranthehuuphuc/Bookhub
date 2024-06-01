<?php
    include 'dbh.php';
    session_start();

    // Check if the user is logged in
    $isLoggedIn = isset($_SESSION['user_id']);

    if (isset($_SESSION['book_id'])) {
        $book_id = $_SESSION['book_id'];
        $book_query = "SELECT * FROM books WHERE book_id = $book_id";
        $book_result = $conn->query($book_query);
        $book = $book_result->fetch_assoc();
        
        // Fetch author details
        $author_id = $book['author_id'];
        $author_query = "SELECT * FROM authors WHERE author_id = $author_id";
        $author_result = $conn->query($author_query);
        $author = $author_result->fetch_assoc();

        // Fetch ratings
        $ratings_query = "SELECT * FROM ratings WHERE book_id = $book_id";
        $ratings_result = $conn->query($ratings_query);
        $num_ratings = $ratings_result->num_rows;

        function calculateAverageRating($conn, $book_id)
        {
            // Query to calculate average rating
            $average_query = "SELECT AVG(rating) AS average_rating FROM ratings WHERE book_id = $book_id";
            
            // Execute the query
            $average_result = $conn->query($average_query);
            
            // Check if query executed successfully
            if ($average_result && $average_result->num_rows > 0) {
                // Fetch the average rating
                $row = $average_result->fetch_assoc();
                $average_rating = $row['average_rating'];
                
                // Return the average rating
                return $average_rating;
            } else {
                // Return 0 if no ratings found
                return 0;
            }
        }
        $average_rating = calculateAverageRating($conn, $book_id);

    // Function to render the navbar links based on user authentication status
    function renderNavbarLinks($isLoggedIn) {
        if ($isLoggedIn) {
            // User is logged in
            echo '<a class="globalnav-item-show" href="../account/orders.php">Đơn hàng</a>';
            echo '<a class="globalnav-item-show" href="../account/saves.php">Mục đã lưu</a>';
            echo '<a class="globalnav-item-show" href="../account/profile.php">Tài khoản</a>';
            echo '<a class="globalnav-item-show" href="../signin/logout.php">Đăng xuất</a>';
            echo '<button id="profile-button"><img id="profile-icon" src="../assets/account.png" alt="Profile Icon"></button>';
        } else {
            // User is not logged in
            echo '<a class="globalnav-item" href="../signin/signin.php">Đăng nhập</a>';
        }
    }

    function renderfooterLinks($isLoggedIn) {
        if ($isLoggedIn) {
            echo '<li><a class="myLink" href="../account/profile.php">Tài khoản</a></li>';
            echo '<li><a class="myLink" href="../signin/logout.php">Đăng xuất</a></li>';
        } else {
            // User is not logged in
            echo '<li><a class="myLink" href="../signin/signin.php">Đăng nhập</a></li>';
        }
    }

    }else {
        // Handle the case where book_id is not set
        echo "No book ID provided.";
        header("Location: ../index.php");
    }
?>

<!DOCTYPE html>
<html>
<head>
    <title>Discuss | Bookhub</title>
    <link rel="stylesheet" type="text/css" href="../style.css">
    <link rel="stylesheet" type="text/css" href="../navbar.css">
    <link rel="stylesheet" type="text/css" href="../footer.css">
    <link rel="stylesheet" type="text/css" href="./discuss.css">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
    <link rel="apple-touch-icon" sizes="180x180" href="../favicon_io/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="../favicon_io/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="../favicon_io/favicon-16x16.png">
    <link rel="manifest" href="../favicon_io/site.webmanifest">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" />

    <script src="https://code.jquery.com/jquery-3.7.1.min.js" 
    integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" 
    crossorigin="anonymous"></script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <style>
        label.error {
        font-weight: 700;
        display: block;
        color: #f85759;
        font-size: 14px;
        font-style: italic;
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

    <script>
    $(document).ready(function(){
        var commentCount = 5;
        $("#loadBtn").click(function(){
            commentCount = commentCount + 5;
            $.ajax({
                url: "load-comments.php",
                method: "POST",
                data: { commentNewCount: commentCount },
                success: function(response) {
                    $("#cmts").html(response);
                },
                error: function(xhr, status, error) {
                    console.error(error);
                }
            });
        });
    });
    </script>

    <?php
        if ($isLoggedIn) {
            echo '<script>
            $(document).ready(function() {
                // Gắn sự kiện submit cho form
                $("#validateForm").submit(function(event) {
                    // Ngăn chặn hành động mặc định của form (tải lại trang)
                    event.preventDefault();
                    
                    // Lấy dữ liệu từ form
                    var formData = $(this).serialize();
                    
                    // Thực hiện AJAX request
                    $.ajax({
                        url: "submit-comment.php", // Đường dẫn đến file xử lý dữ liệu
                        method: "POST", // Phương thức gửi dữ liệu
                        data: formData, // Dữ liệu cần gửi đi, ở đây là dữ liệu từ form
                        success: function(response) {
                            console.log("Dữ liệu đã được gửi thành công:", response);
                            // Xóa dữ liệu trong form sau khi gửi đi
                            $("#validateForm")[0].reset();
                        },
                        error: function(xhr, status, error) {
                            console.error("Có lỗi xảy ra:", error);
                        }
                    });
                });
            });
            </script>';
        }
        else {
            echo '<script>
            $(document).ready(function() {
                // Gắn sự kiện submit cho form
                $("#validateForm").submit(function(event) {
                    // Ngăn chặn hành động mặc định của form (tải lại trang)
                    event.preventDefault();
                    
                    // Thông báo người dùng cần đăng nhập
                    alert("You need to log in to submit the form.");
        
                    // Xóa dữ liệu trong form
                    $("#validateForm")[0].reset();
                });
            });
            </script>';
        }

    ?>

    <script>
        $(document).ready(function() {
            $('#searchcmt').submit(function(event) {
                event.preventDefault(); // Prevent default form submission
                var query = $('#searchInput').val().trim();
                if (query !== '') {
                    $.ajax({
                        url: 'search.php',
                        method: 'GET',
                        data: { query: query },
                        success: function(response) {
                            $('#searchResults').html(response);
                        },
                        error: function(xhr, status, error) {
                            console.error(error);
                        }
                    });
                } else {
                    $('#searchResults').empty();
                }
            });
        });
    </script>



</head>
</html>
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
                <a class="globalnav-item" href="../aboutUs/aboutUs.php">Về Chúng Tôi</a>
                <a class="globalnav-item" href="../search/search.php">Tìm kiếm</a>
                <?php renderNavbarLinks($isLoggedIn); ?>
                
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

    <main>
    <div class="maindiv">
        <div class="book">
            <div class="book-image" style="display: flex; justify-content: center;">
            <img src="<?php echo  '../admin/uploads/' .  $book['cover_image']; ?>" alt="<?php echo $book['title']; ?>" style="width: auto; height: 400px; box-shadow: 2px 2px 2px 2px rgba(0, 0, 0, 0.4);">
            </div>
            <div style="text-align: center;">
                <a href="#" style="text-decoration: none;"><h3 style="background-color: #F08A5D; padding: 14px; color: #ffffff; border-radius: 30px;">Thêm vào giỏ hàng</h3></a>
            </div>
        </div>
    
        <div class="book-detail" style="margin-left: 300px; margin-right: 50px;">
                <h1 style="font-weight: 800;margin-bottom: -1vw;">Thảo luận và đánh giá</h1>
                <h1 style="font-weight: 300;"><i><?php echo $book['title']; ?></i></h1>
                <h3 style="font-weight: 500; margin-top: -1vw;">Tác giả: <?php echo $author['author_name']; ?></h3>
                <div class="rating">
                    <div style="display: flex;">
                        <h3 style="font-weight: 500;margin-right: 2vw;">Đánh giá:</h3><h4 style="font-weight: 200;"><i>(<?php echo $num_ratings; ?> lượt đánh giá)</i></h4>
                    </div>
                    <div class="star" style="margin: 10px 0;display:flex;align-items:center;">
                        <div style="padding-right:10px">
                            <?php
                            // Calculate the number of filled stars
                            $filled_stars = floor($average_rating);

                            // Calculate the number of half-filled stars
                            $half_star = $average_rating - $filled_stars >= 0.5 ? 1 : 0;

                            // Calculate the number of empty stars
                            $empty_stars = 5 - $filled_stars - $half_star;

                            // Output the filled stars
                            for ($i = 0; $i < $filled_stars; $i++) {
                                echo '<i class="fas fa-star" style="color: gold"></i>';
                            }

                            // Output the half-filled star
                            if ($half_star) {
                                echo '<i class="fas fa-star-half-alt" style="color: gold"></i>';
                            }

                            // Output the empty stars
                            for ($i = 0; $i < $empty_stars; $i++) {
                                echo '<i class="far fa-star" style="color: gold"></i>';
                            }
                            ?>
                        </div>
                        <h4 style="font-weight: 500"><i><?php echo number_format($average_rating, 2); ?>/5.00</i></h4>
                    </div>

                </div>

            <div id="postcmt" style="display: flex;">
                <form id="validateForm">
                    <div>
                        <textarea name="review" id="review" placeholder="Đăng bình luận"required></textarea>
                        <br/>
                    </div>
                    <br/>
                    <label for="rating">Nhập điểm đánh giá: </label>
                    <input type="text" id="rating" name="rating"><br/>
                    
                    <br/>
                    <button id="post_cmt" type="submit" style="background-color: #F08A5D; padding: 0.75rem 2rem; font-family: 'MavenPro'; color: #ffffff;cursor:pointer;border:none;border-radius:2rem">Đăng</button>
                    <div id="responseMessage"></div>
                </form>
            </div>

            <div style='width: 100%; height: 0.75vw; background-color: #F08A5D;margin-bottom: 1vw; margin-top: 2vw;'></div>

            <div id="searchcmt" style="display: flex;">
                <form>
                    <input type="search" id="searchInput" placeholder="Tìm kiếm bình luận" style="">
                    <button type="submit" style="background-color: #F08A5D; padding: 0.75rem 2rem; font-family: 'MavenPro'; color: #ffffff;cursor:pointer;border:none;border-radius:2rem">Tìm kiếm</button>
                </form>
            </div>

            <p><i>Kết quả tìm kiếm</i></p>
            <div id="searchResults"></div>
            <div style='width: 100%; height: 0.75vw; background-color: #F08A5D;margin-bottom: 1vw;'></div>
            <p><i>Tất cả đánh giá</i></p>
            <br/>

            <div id="cmts">
            <?php    
                $sql = "SELECT ratings.*, users.username
                        FROM ratings 
                        INNER JOIN users ON ratings.user_id = users.user_id 
                        WHERE ratings.book_id = $book_id
                        LIMIT 5";

                $result = mysqli_query($conn, $sql);

                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<div>";
                        // Display user avatar if available, else use default avatar
                        if (!empty($row['avatar'])) {
                            echo "<img src='" . htmlspecialchars($row['avatar']) . "' alt='User Avatar' style='width: 50px; height: 50px; border-radius: 50%; margin-right: 10px;'>";
                        } else {
                            echo "<img src='./d_assets/user.png' alt='User Avatar' style='width: 50px; height: 50px; border-radius: 50%; margin-right: 10px;'>";
                        }
                        echo "<p style='font-weight:800;font-size:1.5rem'>@".$row['username']."</p>";
                        echo "<p><i>Rating: ".$row['rating'].'/5.00'."</i></p>";
                        echo "<p>Review: ".$row['review']."</p>";
                        echo "</div>";
                        echo "<div style='width: 100%; height: 0.1vw; background-color: #F08A5D;margin-bottom: 1vw;'></div>";
                    }
                } else {
                    echo "Không có bình luận nào.";
                }
            ?>


            </div>

            <button id="loadBtn" style="margin:10px 0">
                Xem thêm
            </button>

        </div>
        </div>
    </main>

    <footer>
        <div class="footer-section footer-content">
            <p class="section-title">VỀ BOOKHUB</p>
            <div class="divider short-divider"></div>
            <p class="description">BookHub là nền tảng kết nối những người<br />có niềm yêu thích sách lại với nhau.</p>
            <div class="social-links">
                <a href="https://facebook.com" target="_blank"><img src="../assets/facebook.png" alt="facebook"
                        class="social-icon"></a>
                <a href="https://instagram.com" target="_blank"><img src="../assets/instagram.png" alt="instagram"
                        class="social-icon"></a>
            </div>
        </div>
        <div class="footer-section link_contact">
            <p class="section-title">ĐƯỜNG DẪN</p>
            <div class="divider"></div>
            <ul class="links-list">
                <li><a href="../Book_Store/bookstore.php" class="myLink">Bookstore</a></li>
                <li><a href="../aboutUs/aboutUs.php" class="myLink">Về Chúng Tôi</a></li>
                <?php renderfooterLinks($isLoggedIn); ?>
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
                    <td class="contact-info"><a href="mailto:group16@gmail.com" class="email-link">group16@gmail.com</a>
                    </td>
                </tr>
            </table>
        </div>
        <div class="footer-bottom">
            <p class="copyright">&copy; 2024 BookHub. All rights reserved.</p>
        </div>
    </footer>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"></script>

    <script>
        // Add a custom validation method for number range from 0 to 5
        $.validator.addMethod("range0to5", function(value, element) {
            return this.optional(element) || (parseFloat(value) >= 0 && parseFloat(value) <= 5);
        }, "Vui lòng nhập số từ 0 đến 5.");

        $("#validateForm").validate({
        rules: {
            review: {
                minlength: 2,
                required: true // Added required rule
            },
            rating: {
                required: true,
                range0to5: true
            }
        },
        messages: {
            review: {
                required: "Vui lòng nhập đánh giá",
                minlength: "Đánh giá phải từ 2 ky tự trở lên."
            },
            rating: {
                required: "Vui lòng nhập số điểm đánh giá.",
                range0to5: "Vui lòng nhập số từ 0 đến 5."
            }
        },
    });
    </script>
</body>