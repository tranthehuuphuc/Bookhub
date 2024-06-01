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
            <a class="globalnav-item" href="../../discuss/discuss.php">Thảo luận</a>
            <a class="globalnav-item" href="../../signin/signin.php">Đăng nhập</a>
            <a class="globalnav-item" href="../../search/search.php">Tìm kiếm</a>
            <a class="globalnav-item-show" href="../../account/AccountReceipts.php">Đơn hàng</a>
            <a class="globalnav-item-show" href="../../account/AccountCart.php">Mục đã lưu</a>
            <a class="globalnav-item-show" href="../../account/AccountSettings.php">Tài khoản</a>
            <a class="globalnav-item-show" href="../../account/AccountAssets/join.png">Đăng xuất</a>
            <button id="profile-button"><img id="profile-icon" src="../../assets/account.png" alt="Profile Icon"></button>
        </div>
    </nav>

    <!-- Account options -->
    <div id="blur-overlay" class="hidden"></div>
    <div id="account-options" class="hidden">
        <p id="myprofile">Hồ sơ của tôi</p>
        <div style="background-color: #d9d9d9; width: 25%; height: 0.05vw; margin: 0; padding: 0;"></div>
        <ul>
            <li><img class="option-icons" src="../../assets/orders.png"><a href="../../account/orders.php">Đơn hàng</a></li>
            <li><img class="option-icons" src="../../assets/saves.png"><a href="../../account/saves.php">Mục đã lưu</a></li>
            <li><img class="option-icons" src="../../assets/setting.png"><a href="../../account/profile.php">Tài khoản</a></li>
            <li><img class="option-icons" src="../../assets/join.png"><a href="../../index.php">Đăng xuất</a></li>
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
                    <img src="../../assets/book3.jpg" alt="book1" style="width: auto; height: 400px;box-shadow: 2px 2px 2px 2px rgba(0, 0, 0, 0.4);">
                </div>
                <div style="text-align: center;">
                    <a href="#" style="text-decoration: none;"><h3 style="background-color: #F08A5D; padding: 14px; color: #ffffff; border-radius: 30px;">Tìm hiểu thêm</h3></a>
                    <a href="#" style="text-decoration: none;"><h3 style="border: 3px solid #F08A5D; padding: 14px; border-radius: 30px; color: #F08A5D;">Thêm vào giỏ hàng</h3></a>
                </div>
            </div>
    
            <div class="book-detail" style="margin-left: 250px; margin-right: 100px;">
                <h1 style="font-weight: 700;margin-bottom: 0;"><i>Cho tôi xin một vé đi tuổi thơ</i></h1>
                
                <div style="display: inline-flex">
                    <h3 style="font-weight: 100">Tác giả:&#160</h3>
                    <a class="author-name" href="#" style="text-decoration: none;"><h3 style="font-weight: 500;color: #F08A5D;">Nguyễn Nhật Ánh</h3></a>
                </div>
                <br/>
                <hr>
                <div>
                    <h3 style="font-weight: 600;">Giới thiệu sách:</h3>
                    <p style="font-weight: 100; text-align: justify;">"Cho tôi xin một vé đi tuổi thơ" là một trong những tác phẩm nổi tiếng của nhà văn Nguyễn Nhật Ánh. Sách kể về những kỷ niệm tuổi thơ của nhân vật chính - cậu bé Nguyên. 
                        Câu chuyện đưa chúng ta trở lại với những kỷ niệm đẹp nhất của tuổi thơ, những kỷ niệm mà mỗi người đều muốn lưu giữ mãi trong lòng.</p>
                    <br/>
                    <div class="genres" style="display: inline-flex">
                        <h3 style="font-weight: 600;">Thể loại:&#160</h3>
                        <a href="#" style="text-decoration: none;"><h4 style="font-weight: 100; color: #ffffff;background-color: #F08A5D;border-radius: 10px;padding: 4px;">Văn học thiếu nhi</h4></a>
                        <a href="#" style="text-decoration: none;"><h3>&#160</h3></a>
                        <a href="#" style="text-decoration: none;"><h4 style="font-weight: 100; color: #ffffff;background-color: #F08A5D;border-radius: 10px;padding: 4px;">Tiểu thuyết</h4></a>
                    </div>
                    <h3 style="font-weight: 600;">Giới thiệu tác giả:</h3>
                    <div class="author-detail" style="display: inline-flex; ">
                        <img src="../../assets/book2.jpg" alt="author1" style="width: 150px; height: 150px; border-radius: 50%; border: 5px solid #F08A5D;">
                        <div style="margin-left: 20px;">
                            <h3 style="font-weight: 500;">Nguyễn Nhật Ánh</h3>
                            <p style="font-weight: 100; text-align: justify;">Nguyễn Nhật Ánh sinh ngày 7 tháng 5 năm 1955 tại Thái Bình, là một nhà văn nổi tiếng của Việt Nam. Ông được biết đến với những tác phẩm văn học dành cho thiếu nhi, nhưng cũng đã viết nhiều tác phẩm dành cho người lớn.</p>
                        </div>
                    </div>
                    <br/><br/>
                    <hr>
                    <div class="product-info">
                        <h3 style="font-weight: 600;">Thông tin sản phẩm:</h3>
                        <div style="display: inline-flex; flex-wrap: wrap;">
                            <table style="border-collapse: separate;margin-right: 100px;">
                                <tr class="tr-book">
                                    <td class="td-book"><h4 style="font-weight: 500;">Nhà xuất bản:&#160</h4></td>
                                    <td class="td-book"><h4 style="font-weight: 100;">Nhà Xuất Bản Trẻ</h4></td>
                                </tr>
                                <tr class="tr-book">
                                    <td class="td-book"><h4 style="font-weight: 500;">Ngày xuất bản:&#160</h4></td>
                                    <td class="td-book"><h4 style="font-weight: 100;">20/10/2010</h4></td>
                                </tr>
                                <tr class="tr-book">
                                    <td class="td-book"><h4 style="font-weight: 500;">Số trang:&#160</h4></td>
                                    <td class="td-book"><h4 style="font-weight: 100;">207</h4></td>
                                </tr>
                                <tr class="tr-book">
                                    <td class="td-book"><h4 style="font-weight: 500;">Giá:&#160</h4></td>
                                    <td class="td-book"><h4 style="font-weight: 100;">100.000đ</h4></td>
                                </tr>
                            </table>
                            <table style="border-collapse: separate;">
                                <tr class="tr-book">
                                    <td class="td-book"><h4 style="font-weight: 500;">Ngôn ngữ:&#160</h4></td>
                                    <td class="td-book"><h4 style="font-weight: 100;">Tiếng Việt</h4></td>
                                </tr>
                                <tr class="tr-book">
                                    <td class="td-book"><h4 style="font-weight: 500;">Hình thức:&#160</h4></td>
                                    <td class="td-book"><h4 style="font-weight: 100;">Bìa mềm, Ebook</h4></td>
                                </tr>
                                <tr class="tr-book">
                                    <td class="td-book"><h4 style="font-weight: 500;">ISBN:&#160</h4></td>
                                    <td class="td-book"><h4 style="font-weight: 100;">9786041004757</h4></td>
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
                    <ul>
                        <li><h4 style="font-weight: 100;">Chương 1: Một ngày đẹp trời</h4></li>
                        <li><h4 style="font-weight: 100;">Chương 2: Những kỷ niệm tuổi thơ</h4></li>
                        <li><h4 style="font-weight: 100;">Chương 3: Hồi ức</h4></li>
                        <li><h4 style="font-weight: 100;">Chương 4:...</h4></li>
                        <a href="#" class="book-btn">
                            <h4>Tất cả chương</h4>
                        </a>
                    </ul>
                </div>
                <hr>
                <div class="same-author">
                    <h3 style="font-weight: 600;">Sách cùng tác giả &#x203A;</h3>
                    <nav class="promotionnav">
                        <a class="promotionnav-item" href="#">
                            <img src="../../assets/etc.jpg" class="promotion-image"><br/>
                            <p style="margin: 0; padding: 0; font-weight: 500; font-size: 20px;">Python</p>
                            <p style="margin: 0; padding: 0; font-size: 15px;">4/5 <img src="../../assets/star.png"></p>
                            <p style="margin: 0; padding: 0; font-weight: 500; font-size: 15px;">100.000 VND</p>
                        </a>
                    </nav>
                </div>
                <hr>
                <a href="../../discuss/discuss.php" style="text-decoration: none;color:black ;"><h3 style="font-weight: 600;">Đánh giá từ người dùng &#x203A;</h3></a>
                <div>
                    <div class="user-rating">
                        <div id="cmts" style="display: inline-flex;">
                            <img src="../../assets/user.png" alt="User Image" style="width: 50px; height: 50px; border-radius: 50%; margin-right: 20px;">
                            <div style="margin-top: -15px;">
                                <p style="font-weight:800;font-size:1.5rem">Anh A</p>
                                <div style="display: inline-flex;">
                                    <p><i>Rating:&#160</i></p>
                                    <p><i>Rating:</i></p>
                                </div>
                                <br/>
                                <div style="display: inline-flex;">
                                    <p>Review:&#160</p>
                                    <p>Review:</p>
                                </div>
                                <div class="line-rating"></div>
                            </div>
                            <br/>
                        </div>
                    </div>
                    <div class="user-rating">
                        <div id="cmts" style="display: inline-flex;">
                            <img src="../../assets/user.png" alt="User Image" style="width: 50px; height: 50px; border-radius: 50%; margin-right: 20px;">
                            <div style="margin-top: -15px;">
                                <p style="font-weight:800;font-size:1.5rem">Anh A</p>
                                <div style="display: inline-flex;">
                                    <p><i>Rating:&#160</i></p>
                                    <p><i>Rating:</i></p>
                                </div>
                                <br/>
                                <div style="display: inline-flex;">
                                    <p>Review:&#160</p>
                                    <p>Review:</p>
                                </div>
                                <div class="line-rating"></div>
                            </div>
                            <br/>
                        </div>
                    </div>
                    <div class="user-rating">
                        <div id="cmts" style="display: inline-flex;">
                            <img src="../../assets/user.png" alt="User Image" style="width: 50px; height: 50px; border-radius: 50%; margin-right: 20px;">
                            <div style="margin-top: -15px;">
                                <p style="font-weight:800;font-size:1.5rem">Anh A</p>
                                <div style="display: inline-flex;">
                                    <p><i>Rating:&#160</i></p>
                                    <p><i>Rating:</i></p>
                                </div>
                                <br/>
                                <div style="display: inline-flex;">
                                    <p>Review:&#160</p>
                                    <p>Review:</p>
                                </div>
                                
                            </div>
                            <br/>
                        </div>
                    </div>
                    <a href="../../discuss/discuss.php" style="text-decoration: none;color: #F08A5D;font-style: italic;text-align: right;"><h3 style="font-weight: 600;">Xem tất cả đánh giá</h3></a>
                </div>
                <hr>
                <div class="same-genre">
                    <h3 style="font-weight: 600;">Sách cùng thể loại &#x203A;</h3>
                    <nav class="promotionnav">
                        <a class="promotionnav-item" href="#">
                            <img src="../../assets/etc.jpg" class="promotion-image"><br/>
                            <p style="margin: 0; padding: 0; font-weight: 500; font-size: 20px;">Python</p>
                            <p style="margin: 0; padding: 0; font-size: 15px;">4/5 <img src="../../assets/star.png"></p>
                            <p style="margin: 0; padding: 0; font-weight: 500; font-size: 15px;">100.000 VND</p>
                        </a>
                    </nav>
                </div>
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
                <li><a href="../../discuss/discuss.php" class="myLink">Thảo luận</a></li>
                <li><a href="../../signin/signin.php" class="myLink">Đăng nhập</a></li>
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