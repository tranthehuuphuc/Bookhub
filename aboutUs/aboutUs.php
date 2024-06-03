<?php
session_start();

require_once '../admin/dbh.php';

// Check if the user is logged in
$isLoggedIn = isset($_SESSION['user_id']);

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
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
        <meta name="description" content="Tìm hiểu về BookHub - nơi cung cấp và thảo luận về những cuốn sách yêu thích. Khám phá sứ mệnh và giá trị của chúng tôi trong việc kết nối cộng đồng yêu sách.">
        <title>Profile</title>
        <link rel="stylesheet" type="text/css" href="../style.css">
        <link rel="stylesheet" type="text/css" href="../navbar.css">
        <link rel="stylesheet" type="text/css" href="../footer.css">
        <link rel="stylesheet" type="text/css" href="./aboutUs.css">
        <link rel="apple-touch-icon" sizes="180x180" href="../favicon_io/apple-touch-icon.png">
        <link rel="icon" type="image/png" sizes="32x32" href="../favicon_io/favicon-32x32.png">
        <link rel="icon" type="image/png" sizes="16x16" href="../favicon_io/favicon-16x16.png">
        <link rel="manifest" href="../favicon_io/site.webmanifest">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" />
    </head>

    <body>
        <h1 class="visuallyhidden">Profile</h1>

        <!-- Navbar -->
        <nav class="navbar">
            <input type="checkbox" id="sidebar-active">
                <!-- New logo image that only appears when the navbar is collapsed -->
            <a href="./index.php"><img id="new-logo" src="../assets/BookHub.png" alt="New Logo"></a>

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
                <li><img class="option-icons" src="../assets/orders.png"><a href="./orders.php">Đơn hàng</a></li>
                <li><img class="option-icons" src="../assets/saves.png"><a href="./saves.php">Mục đã lưu</a></li>
                <li><img class="option-icons" src="../assets/setting.png"><a href="./profile.php">Tài khoản</a></li>
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
        <div id="topimg" style="height:50%">
                <div class="text">
                    <h2>Mua bán, trao đổi, thảo luận và cùng chia sẻ về những cuốn sách mà bạn yêu thích.</h2>
                    <div class="button-top">
                        <a href="../signin/signin.php" class="topbtn">Đăng ký ngay&nbsp;&#x276F;</a>
                    </div>
                </div>
            </div>

            <div class="maindiv">
            <section class="mision">
                <div class="container">
                    <h1>Về BookHub</h1>
                    <p>Chào mừng đến với BookHub, điểm đến cho mọi thứ về sách!</p>
                </div>
            </section>
        
            <section class="mission">
                <div class="container">
                    <h2>Sứ Mệnh Của Chúng Tôi</h2>
                    <p>Tại BookHub, chúng tôi đam mê kết nối những người yêu sách và tạo ra một cộng đồng độc đáo của những người đọc. Sứ mệnh của chúng tôi là cung cấp một nền tảng nơi mọi người có thể khám phá, mua bán, chia sẻ những cuốn sách yêu thích của họ với người khác.</p>
                    <p>Chúng tôi tin vào sức mạnh của việc đọc sách để giáo dục, truyền cảm hứng và giải trí, và chúng tôi luôn cố gắng làm cho thế giới sách trở nên dễ tiếp cận hơn đối với mọi người.</p>
                </div>
            </section>
        
            <section class="history">
                <div class="container">
                    <h2>Lịch Sử Của Chúng Tôi</h2>
                    <p>BookHub được thành lập vào năm 2024 bởi một nhóm người đọc nhiệt huyết muốn tạo ra một nơi mà những người yêu sách có thể tụ tập để khám phá và tôn vinh tình yêu của họ dành cho văn học.</p>
                    <p>Kể từ đó, chúng tôi đã phát triển thành một cộng đồng phát triển mạnh mẽ với hàng nghìn thành viên từ khắp nơi trên thế giới. Chúng tôi tiếp tục mở rộng các dịch vụ của mình và tối ưu hóa nền tảng của mình để phục vụ người dùng tốt hơn.</p>
                </div>
            </section>
        
            <section class="team">
                <div class="container">
                    <h2>Đội Ngũ Của Chúng Tôi</h2>
                    <p>Đằng sau BookHub là một đội ngũ đầy cam kết với những người yêu sách, những người đam mê công nghệ và tư duy sáng tạo, cam kết mang lại trải nghiệm thú vị và đáng giá cho bạn.</p>
                    <p>Từ các nhà phát triển và nhà thiết kế của chúng tôi đến các đại diện hỗ trợ khách hàng, mỗi thành viên của đội ngũ chúng tôi đều đóng vai trò quan trọng trong việc mang BookHub trở thành hiện thực.</p>
                </div>
            </section>
        
            <section class="community">
                <div class="container">
                    <h2>Tham Gia Cộng Đồng</h2>
                    <p>Tại BookHub, chúng tôi tin vào việc trao lại cho cộng đồng và hỗ trợ những nguyên tắc thúc đẩy sự đọc và giáo dục.</p>
                    <p>Chúng tôi thường xuyên hợp tác với các trường học, thư viện và tổ chức phi lợi nhuận để quyên góp sách, tổ chức sự kiện đọc sách và tài trợ các chương trình về học vấn.</p>
                    <p>Thông qua các hoạt động cộng đồng của chúng tôi, chúng tôi nhằm mục tiêu lan tỏa niềm vui từ việc đọc sách và tạo ra ảnh hưởng tích cực trong cuộc sống của mọi người.</p>
                </div>
            </section>
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