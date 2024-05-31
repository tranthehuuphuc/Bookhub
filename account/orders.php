
<?php
    session_start();
    require_once "./php/connect.php";
    if (!isset($_SESSION["user_username"])) {
        header("Location: ../signin/signin.php");
        exit();
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
        <title>Profile</title>
        <link rel="stylesheet" type="text/css" href="./AccountStyle.css">
        <link rel="stylesheet" type="text/css" href="../navbar.css">
        <link rel="stylesheet" type="text/css" href="../footer.css">
        <link rel="apple-touch-icon" sizes="180x180" href="../favicon_io/apple-touch-icon.png">
        <link rel="icon" type="image/png" sizes="32x32" href="../favicon_io/favicon-32x32.png">
        <link rel="icon" type="image/png" sizes="16x16" href="../favicon_io/favicon-16x16.png">
        <link rel="manifest" href="../favicon_io/site.webmanifest">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" />
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
        <script src="https://www.paypal.com/sdk/js?client-id=AYeQLbENNd3RtNT3-NbYPKzLgzQB3QfESrSDOge_SH6VNEwpUJ4oKmN0grzc4OKKWIXIQFWNjRNwh9HZ&currency=USD"></script>
    </head>

    <body>
        <h1 class="visuallyhidden">Profile</h1>

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
                <a class="globalnav-item-show" href="./orders.php">Đơn hàng</a>
                <a class="globalnav-item-show" href="./saves.php">Mục đã lưu</a>
                <a class="globalnav-item-show" href="./profile.php">Tài khoản</a>
                <a class="globalnav-item-show" href="../signin/signin.php">Đăng xuất</a>
                <button id="profile-button"><img id="profile-icon" src="../assets/account.png" alt="Profile Icon"></button>
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
                <li><img class="option-icons" src="../assets/join.png"><a href="../signin/sigin.php">Đăng xuất</a></li>
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
            <div class="title-bar">
                <p class="title">Tài khoản</p>
                <div style="background-color: #d9d9d9; width: 100%; height: 1px; margin: 5px 0 0 0; padding: 0;"></div>
                <p class="sub-title">Xin chào Group 16!</p>
            </div>

            <!-- Start of My Books -->
            <div class="main">
                <p class="header">Sách của bạn</p>
                <div class="book-slider">
                    <div class="prev-button slider-button"><i class="fas fa-chevron-left"></i></div>
                    <div class="book-list">
                        <img class="book-thumb" src="../assets/book3.jpg">
                        <img class="book-thumb" src="../assets/book3.jpg">
                        <img class="book-thumb" src="../assets/book3.jpg">
                        <img class="book-thumb" src="../assets/book3.jpg">
                        <img class="book-thumb" src="../assets/book3.jpg">
                        <img class="book-thumb" src="../assets/book3.jpg">
                        <img class="book-thumb" src="../assets/book3.jpg">
                        <img class="book-thumb" src="../assets/book3.jpg">
                        <img class="book-thumb" src="../assets/book3.jpg">
                    </div>
                    <div class="next-button slider-button"><i class="fas fa-chevron-right"></i></div>
                </div>
                <script>
                    var bookSlider = document.querySelector('.book-slider');
                    var bookList = document.querySelector('.book-list');
                    var prevButton = document.querySelector('.prev-button');
                    var nextButton = document.querySelector('.next-button');
                    var bookThumbs = document.querySelectorAll('.book-thumb');
                    
                    var scrollAmount = 0;

                    prevButton.addEventListener('click', () => {
                        var direction = -1;
                        scrollAmount = bookList.clientWidth * direction;
                        bookList.scrollBy({left: scrollAmount, behavior: "smooth"})
                    });

                    nextButton.addEventListener('click', () => {
                        var direction = 1;
                        scrollAmount = bookList.clientWidth * direction;
                        bookList.scrollBy({left: scrollAmount, behavior: "smooth"})
                    });
                </script>
            </div>
            <!-- End of My Books -->

            <div class="gray-bar">
                <div class="pretty-box">
                    <p class="header-box">Đơn hàng của bạn</p>
                    <p class="properties">Theo dõi, chỉnh sửa hoặc huỷ đơn hàng.</p>
                    <br>
                    <a href="./orders.php" class="box-link">Xem lịch sử mua hàng của bạn ></a>
                </div>
                <div class="pretty-box">
                    <p class="header-box">Mục đã lưu</p>
                    <p class="properties">Hãy tập hợp và lưu lại các sản phẩm bạn quan tâm.</p>
                    <br>
                    <a href="./saves.php" class="box-link">Xem sản phẩm đã lưu ></a>
                </div>
            </div>

            <!-- Start of Account Settings -->
            <div class="main">
                <p class="header">Cài đặt tài khoản</p>
                <div class="row">
                    <div class="col1">
                        <p class="small-header">Vận chuyển</p>
                    </div>
                    <div class="col2">
                        <p class="bullet">Địa chỉ vận chuyển</p>
                        <p class="properties">Số nhà</p>
                        <p class="properties">Phường/Xã</p>
                        <p class="properties">Quận/Huyện</p>
                        <p class="properties">Tỉnh/Thành phố</p>
                        <a class="edit shipping-button">Chỉnh sửa</a>
                    </div>
                    <div class="col3">
                        <p class="bullet">Thông tin liên hệ</p>
                        <p class="properties">tranthehuuphuc@icloud.com</p>
                        <p class="properties">0977983302</p>
                        <a class="edit shipping-button">Chỉnh sửa</a>
                    </div>
                </div>
                <div id="shipping-settings" class="hidden">
                    <form action="./php/update_shipping.php" method="POST">
                        <div style="display: block; align-items: center; margin: 0; padding: 0;">
                            <p class="header" style="justify-content: center; display: flex; margin-top: 0; text-align: center;">Chỉnh sửa thông tin vận chuyển</p>
                            <p class="small-header" for="address">Địa chỉ vận chuyển</p>
                            <div class="input-field">
                                <p class="field-label">Số nhà</p>
                                <input type="text" class="input-box" id="home_number" name="home_number" placeholder="Số nhà">
                            </div>
                            <div class="input-field">
                                <p class="field-label">Phường/Xã</p>
                                <input type="text" class="input-box" id="ward" name="ward" placeholder="Phường/Xã">
                            </div>
                            <div class="input-field">
                                <p class="field-label">Quận/Huyện</p>
                                <input type="text" class="input-box" id="district" name="district" placeholder="Quận/Huyện">
                            </div>
                            <div class="input-field">
                                <p class="field-label">Tỉnh/Thành phố</p>
                                <input type="text" class="input-box" id="city" name="city" placeholder="Tỉnh/Thành phố">
                            </div>

                            <p class="small-header">Thông tin liên hệ</p>
                            <div class="input-field">
                                <p class="field-label">Email</p>
                                <input type="text" class="input-box" id="shipping_email" name="shipping_email" placeholder="Email">
                            </div>
                            <div class="input-field">
                                <p class="field-label">Số điện thoại</p>
                                <input type="text" class="input-box" id="shipping_phone" name="shipping_phone" placeholder="Số điện thoại">
                            </div>
                            <div class="submit-field">
                                <input type="submit" class="submit-button" value="Lưu">
                                <div class="cancel-button">Huỷ</div>
                            </div>
                        </div>
                    </form>
                </div>
                <script>
                    function EditShippingSettings() {
                        var shippingSettings = document.getElementById("shipping-settings");
                        var overlay = document.getElementById("blur-overlay");
                        overlay.classList.toggle("hidden");

                        if (overlay.classList.contains("hidden")) {
                            shippingSettings.classList.remove("show");
                            setTimeout(() => shippingSettings.classList.add("hidden"), 0);
                        } else {
                            shippingSettings.classList.remove("hidden");
                            setTimeout(() => shippingSettings.classList.add("show"), 0);
                        }
                    }

                    function CloseShippingSettings() {
                        var shippingSettings = document.getElementById("shipping-settings");
                        var overlay = document.getElementById("blur-overlay");

                        overlay.classList.remove("show");
                        overlay.classList.add("hidden");
                        
                        shippingSettings.classList.remove("show");
                        shippingSettings.classList.add("hidden");
                    }

                    document.addEventListener("DOMContentLoaded", () => {
                        var editButton = document.querySelectorAll(".shipping-button");
                        var overlay = document.getElementById("blur-overlay");

                        editButton.forEach(button => {
                            button.addEventListener("click", EditShippingSettings);
                        });
                        
                        overlay.addEventListener("click", CloseShippingSettings);
                        document.addEventListener('keydown', (event) => {
                            if (event.key === 'Escape') {
                                CloseShippingSettings();
                            }
                        });
                        document.getElementsByClassName("cancel-button")[0].addEventListener("click", CloseShippingSettings);
                    });
                </script>

                <div class="row">
                    <div class="col1">
                        <p class="small-header">Thanh toán</p>
                    </div>
                    <div class="col2">
                        <p class="bullet">Thông tin liên hệ thanh toán</p>
                        <a class="edit payment-button">Chỉnh sửa</a>
                    </div>
                    <div class="col3">
                        <p class="bullet">Phương thức thanh toán</p>
                        <a class="edit payment-button">Chỉnh sửa</a>
                    </div>
                </div>
                <div id="payment-settings" class="hidden">
                    <div style="display: block; align-items: center; margin: 0; padding: 0;">
                        <p class="header" style="justify-content: center; display: flex; margin-top: 0; text-align: center;">Chỉnh sửa thông tin thanh toán</p>
                        <p class="small-header" for="contact">Thông tin liên hệ thanh toán</p>
                        <div class="input-field">
                            <p class="field-label">Email</p>
                            <input type="text" class="input-box" name="contact" placeholder="Email">
                        </div>
                        <div class="input-field">
                            <p class="field-label">Số điện thoại</p>
                            <input type="text" class="input-box" name="contact" placeholder="Số điện thoại">
                        </div>

                        <p class="small-header" for="payment">Phương thức thanh toán</p>
                        <div class="input-field">
                            <p class="field-label">Phương thức thanh toán</p>
                            <input type="text" class="input-box" name="payment" placeholder="Phương thức thanh toán">
                        </div>
                        <div class="submit-field">
                            <div class="submit-button">Lưu</div>
                            <div class="cancel-button">Huỷ</div>
                        </div>
                    </div>
                </div>
                <script>
                    function EditPaymentSettings() {
                        var paymentSettings = document.getElementById("payment-settings");
                        var overlay = document.getElementById("blur-overlay");
                        overlay.classList.toggle("hidden");

                        if (overlay.classList.contains("hidden")) {
                            paymentSettings.classList.remove("show");
                            setTimeout(() => paymentSettings.classList.add("hidden"), 0);
                        } else {
                            paymentSettings.classList.remove("hidden");
                            setTimeout(() => paymentSettings.classList.add("show"), 0);
                        }
                    }

                    function ClosePaymentSettings() {
                        var paymentSettings = document.getElementById("payment-settings");
                        var overlay = document.getElementById("blur-overlay");

                        overlay.classList.remove("show");
                        overlay.classList.add("hidden");
                        
                        paymentSettings.classList.remove("show");
                        paymentSettings.classList.add("hidden");
                    }

                    document.addEventListener("DOMContentLoaded", () => {
                        var editButton = document.querySelectorAll(".payment-button");
                        var overlay = document.getElementById("blur-overlay");

                        editButton.forEach(button => {
                            button.addEventListener("click", EditPaymentSettings);
                        });
                        
                        overlay.addEventListener("click", ClosePaymentSettings);
                        document.addEventListener('keydown', (event) => {
                            if (event.key === 'Escape') {
                                ClosePaymentSettings();
                            }
                        });
                        
                        var cancelButton = document.querySelectorAll(".cancel-button");
                        cancelButton.forEach(button => {
                            button.addEventListener("click", ClosePaymentSettings);
                        });
                    });
                </script>

                <div class="row">
                    <div class="col1">
                        <p class="small-header">Thông tin cá nhân</p>
                    </div>
                    <div class="col2">
                        <p class="properties">Email: tranthehuuphuc@icloud.com</p>
                        <p class="properties">Số điện thoại: 0123456789</p>
                        <p class="properties">Ngày sinh: 02/02/2004</p>
                        <a class="edit account-button">Chỉnh sửa</a>
                    </div>
                </div>
                <div id="account-settings" class="hidden">
                    <div style="display: block; align-items: center; margin: 0; padding: 0;">
                        <p class="header" style="justify-content: center; display: flex; margin-top: 0; text-align: center;">Chỉnh sửa thông tin cá nhân</p>
                        <div class="input-field">
                            <p class="field-label">Email</p>
                            <input type="text" class="input-box" name="email" placeholder="Email">
                        </div>
                        <div class="input-field">
                            <p class="field-label">Số điện thoại</p>
                            <input type="text" class="input-box" name="phone" placeholder="Số điện thoại">
                        </div>
                        <div class="input-field">
                            <p class="field-label">Ngày sinh</p>
                            <input type="text" class="input-box" name="dob" placeholder="Ngày sinh">
                        </div>
                        <div class="submit-field">
                            <div class="submit-button">Lưu</div>
                            <div class="cancel-button">Huỷ</div>
                        </div>
                    </div>
                </div>
                <script>
                    function EditAccountSettings() {
                        var accountSettings = document.getElementById("account-settings");
                        var overlay = document.getElementById("blur-overlay");
                        overlay.classList.toggle("hidden");

                        if (overlay.classList.contains("hidden")) {
                            accountSettings.classList.remove("show");
                            setTimeout(() => accountSettings.classList.add("hidden"), 0);
                        } else {
                            accountSettings.classList.remove("hidden");
                            setTimeout(() => accountSettings.classList.add("show"), 0);
                        }
                    }

                    function CloseAccountSettings() {
                        var accountSettings = document.getElementById("account-settings");
                        var overlay = document.getElementById("blur-overlay");

                        overlay.classList.remove("show");
                        overlay.classList.add("hidden");
                        
                        accountSettings.classList.remove("show");
                        accountSettings.classList.add("hidden");
                    }

                    document.addEventListener("DOMContentLoaded", () => {
                        var editButton = document.querySelectorAll(".account-button");
                        var overlay = document.getElementById("blur-overlay");

                        editButton.forEach(button => {
                            button.addEventListener("click", EditAccountSettings);
                        });
                        
                        overlay.addEventListener("click", CloseAccountSettings);
                        document.addEventListener('keydown', (event) => {
                            if (event.key === 'Escape') {
                                CloseAccountSettings();
                            }
                        });
                        
                        var cancelButton = document.querySelectorAll(".cancel-button");
                        cancelButton.forEach(button => {
                            button.addEventListener("click", CloseAccountSettings);
                        });
                    });
                </script>

                <!-- <div id="paypal-button-container"></div>
                
                <script>
                paypal.Buttons({
                    createOrder: function(data, actions) {
                        return actions.order.create({
                            purchase_units: [{
                                amount: {
                                    value: '0.01'
                                }
                            }]
                        });
                    }
                    
                }).render('#paypal-button-container'); // Renders the PayPal button
                </script> -->
            </div>
            <!-- End of Account Settings-->
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