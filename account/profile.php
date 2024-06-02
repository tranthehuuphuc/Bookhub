
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
            <a href="Bookhub.php"><img id="new-logo" src="../assets/BookHub.png" alt="New Logo"></a>

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
                <li><img class="option-icons" src="../assets/join.png"><a href="../signin/signin.php">Đăng xuất</a></li>
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

        <?php
            $user_id = $_SESSION["user_id"];
            $sql = "SELECT * FROM users WHERE user_id = :user_id";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
        ?>

       <main>
            <div class="title-bar">
                <p class="title">Tài khoản</p>
                <div style="background-color: #d9d9d9; width: 100%; height: 1px; margin: 5px 0 0 0; padding: 0;"></div>
                <?php
                    if ($result["fullname"]) {
                        echo "<p class='sub-title'>Xin chào " . $result["fullname"] . "!</p>";
                    }
                    else {
                        echo "<p class='sub-title'>Xin chào " . $_SESSION["user_username"] . "!</p>";
                    }
                ?>
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
            <div id="loading-spinner" style="display: none;">
                <div class="spinner"></div>
            </div>
                <p class="header">Cài đặt tài khoản</p>
                <div class="row">
                    <div class="col1">
                        <p class="small-header">Vận chuyển</p>
                    </div>
                    <div class="col2">
                        <p class="bullet">Địa chỉ vận chuyển</p>
                        <?php
                            $user_id = $_SESSION["user_id"];
                            $sql = "SELECT * FROM shipping WHERE user_id = :user_id";
                            $stmt = $pdo->prepare($sql);
                            $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
                            $stmt->execute();
                            $result = $stmt->fetch(PDO::FETCH_ASSOC);

                            if ($result) {
                                echo "<p class='properties'>" . $result['home_address'] . "</p>";
                                echo "<p class='properties'>" . $result['ward'] . "</p>";
                                echo "<p class='properties'>" . $result['district'] . "</p>";
                                echo "<p class='properties'>" . $result['city'] . "</p>";
                            } else {
                                echo "<p class='properties'>Số nhà</p>";
                                echo "<p class='properties'>Phường/Xã</p>";
                                echo "<p class='properties'>Quận/Huyện</p>";
                                echo "<p class='properties'>Tỉnh/Thành phố</p>";
                            }
                        ?>
                        <a class="edit shipping-button">Chỉnh sửa</a>
                    </div>
                    <div class="col3">
                        <p class="bullet">Thông tin liên hệ</p>
                        <?php
                            if ($result) {
                                echo "<p class='properties'>" . $result['shipping_email'] . "</p>";
                                echo "<p class='properties'>" . $result['shipping_phone'] . "</p>";
                            } else {
                                echo "<p class='properties'>Email</p>";
                                echo "<p class='properties'>Số điện thoại</p>";
                            }
                        ?>
                        <a class="edit shipping-button">Chỉnh sửa</a>
                    </div>
                </div>
                <div id="shipping-settings" class="hidden">
                    <form id="update-shipping" method="POST">
                        <div style="display: block; align-items: center; margin: 0; padding: 0;">
                            <p class="header" style="justify-content: center; display: flex; margin-top: 0; text-align: center;">Chỉnh sửa thông tin vận chuyển</p>
                            <p class="small-header" for="address">Địa chỉ vận chuyển</p>
                            <div class="input-field">
                                <p class="field-label">Số nhà</p>
                                <?php
                                    if ($result) {
                                        echo "<input type='text' class='input-box' id='home_address' name='home_address' value='" . $result['home_address'] . "'>";
                                    } else {
                                        echo "<input type='text' class='input-box' id='home_address' name='home_address' placeholder='Số nhà'>";
                                    }
                                ?>
                                
                            </div>
                            <div class="input-field">
                                <p class="field-label">Phường/Xã</p>
                                <?php
                                    if ($result) {
                                        echo "<input type='text' class='input-box' id='ward' name='ward' value='" . $result['ward'] . "'>";
                                    } else {
                                        echo "<input type='text' class='input-box' id='ward' name='ward' placeholder='Phường/Xã'>";
                                    }
                                ?>
                            </div>
                            <div class="input-field">
                                <p class="field-label">Quận/Huyện</p>
                                <?php
                                    if ($result) {
                                        echo "<input type='text' class='input-box' id='district' name='district' value='" . $result['district'] . "'>";
                                    } else {
                                        echo "<input type='text' class='input-box' id='district' name='district' placeholder='Quận/Huyện'>";
                                    }
                                ?>
                            </div>
                            <div class="input-field">
                                <p class="field-label">Tỉnh/Thành phố</p>
                                <?php
                                    if ($result) {
                                        echo "<input type='text' class='input-box' id='city' name='city' value='" . $result['city'] . "'>";
                                    } else {
                                        echo "<input type='text' class='input-box' id='city' name='city' placeholder='Tỉnh/Thành phố'>";
                                    }
                                ?>
                            </div>

                            <p class="small-header">Thông tin liên hệ</p>
                            <div class="input-field">
                                <p class="field-label">Email</p>
                                <?php
                                    if ($result) {
                                        echo "<input type='text' class='input-box' id='shipping_email' name='shipping_email' value='" . $result['shipping_email'] . "'>";
                                    } else {
                                        echo "<input type='text' class='input-box' id='shipping_email' name='shipping_email' placeholder='Email'>";
                                    }
                                ?>
                            </div>
                            <div class="input-field">
                                <p class="field-label">Số điện thoại</p>
                                <?php
                                    if ($result) {
                                        echo "<input type='text' class='input-box' id='shipping_phone' name='shipping_phone' value='" . $result['shipping_phone'] . "'>";
                                    } else {
                                        echo "<input type='text' class='input-box' id='shipping_phone' name='shipping_phone' placeholder='Số điện thoại'>";
                                    }
                                ?>
                            </div>
                            <div class="submit-field">
                                <input type="submit" class="submit-button" value="Lưu">
                                <div class="cancel-button">Huỷ</div>
                            </div>
                        </div>
                    </form>
                </div>

                <script>
                    document.getElementById("update-shipping").addEventListener("submit", function(event) {
                    event.preventDefault();

                    var shipping_email = document.getElementById("shipping_email").value;
                    var shipping_phone = document.getElementById("shipping_phone").value;
                    var home_address = document.getElementById("home_address").value;
                    var ward = document.getElementById("ward").value;
                    var district = document.getElementById("district").value;
                    var city = document.getElementById("city").value;

                    var data = {
                        shipping_email: shipping_email,
                        shipping_phone: shipping_phone,
                        home_address: home_address,
                        ward: ward,
                        district: district,
                        city: city
                    };

                    document.getElementById("loading-spinner").style.display = "flex";

                    fetch("./php/update_shipping.php", {
                        method: "POST",
                        headers: {
                            "Content-Type": "application/x-www-form-urlencoded"
                        },
                        body: new URLSearchParams(data)
                    })
                    .then(response => response.json())
                    .then(data => {
                        document.getElementById("loading-spinner").style.display = "none";

                        if (data.status === "success") {
                            alert(data.message);
                            window.location.reload();
                        } else {
                            alert(data.message);
                        }
                    })
                    .catch((error) => {
                        document.getElementById("loading-spinner").style.display = "none";
                        
                        console.error("Error:", error);
                    });
                });

                </script>
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
                    <form id="update-payment" method="POST">
                        <div style="display: block; align-items: center; margin: 0; padding: 0;">
                            <p class="header" style="justify-content: center; display: flex; margin-top: 0; text-align: center;">Chỉnh sửa thông tin thanh toán</p>
                            <p class="small-header" for="contact">Thông tin liên hệ thanh toán</p>
                            <div class="input-field">
                                <p class="field-label">Email</p>
                                <?php
                                    $user_id = $_SESSION["user_id"];
                                    $sql = "SELECT * FROM payment WHERE user_id = :user_id";
                                    $stmt = $pdo->prepare($sql);
                                    $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
                                    $stmt->execute();
                                    $result = $stmt->fetch(PDO::FETCH_ASSOC);

                                    if ($result) {
                                        echo "<input type='text' class='input-box' id='payment_email' name='payment_email' value='" . $result['payment_email'] . "'>";
                                    } else {
                                        echo "<input type='text' class='input-box' id='payment_email' name='payment_email' placeholder='Email'>";
                                    }
                                ?>
                            </div>
                            <div class="input-field">
                                <p class="field-label">Số điện thoại</p>
                                <?php
                                    if ($result) {
                                        echo "<input type='text' class='input-box' id='payment_phone' name='payment_phone' value='" . $result['payment_phone'] . "'>";
                                    } else {
                                        echo "<input type='text' class='input-box' id='payment_phone' name='payment_phone' placeholder='Số điện thoại'>";
                                    }
                                ?>
                            </div>
                            <p class="small-header" for="payment">Phương thức thanh toán</p>
                            <p class="properties" style="color: green;"><i>Hiện tại trang web chỉ hỗ trợ thanh toán với PayPal</i></p>

                            <div class="submit-field">
                                <input type="submit" class="submit-button" value="Lưu">
                                <div class="cancel-button">Huỷ</div>
                            </div>
                        </div>
                    </form>
                </div>

                <script>
                    document.getElementById("update-payment").addEventListener("submit", function(event) {
                    event.preventDefault();
                    var payment_email = document.getElementById("payment_email").value;
                    var payment_phone = document.getElementById("payment_phone").value;

                    var data = {
                        payment_email: payment_email,
                        payment_phone: payment_phone
                    };

                    document.getElementById("loading-spinner").style.display = "flex";

                    fetch("./php/update_payment.php", {
                        method: "POST",
                        headers: {
                            "Content-Type": "application/x-www-form-urlencoded"
                        },
                        body: new URLSearchParams(data)
                    })
                    .then(response => response.json())
                    .then(data => {
                        document.getElementById("loading-spinner").style.display = "none";

                        if (data.status === "success") {
                            alert(data.message);
                            window.location.reload();
                        } else {
                            alert(data.message);
                        }
                    })
                    .catch((error) => {
                        document.getElementById("loading-spinner").style.display = "none";
                        
                        console.error("Error:", error);
                    });
                });
                </script>

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
                        <?php
                            $user_id = $_SESSION["user_id"];
                            $sql = "SELECT * FROM users WHERE user_id = :user_id";
                            $stmt = $pdo->prepare($sql);
                            $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
                            $stmt->execute();
                            $result = $stmt->fetch(PDO::FETCH_ASSOC);

                            echo "<p class='properties'>Họ tên: " . $result['fullname'] . "</p>";
                            echo "<p class='properties'>Email: " . $result['email'] . "</p>";
                            echo "<p class='properties'>Số điện thoại: " . $result['phone'] . "</p>";
                            echo "<p class='properties'>Ngày sinh: " . $result['birthday'] . "</p>";
                        ?>
                        <a class="edit account-button">Chỉnh sửa</a>
                        <a class="edit pwd-button" style="margin-left: 20px;">Đổi mật khẩu</a>
                    </div>
                </div>
                <div id="account-settings" class="hidden">
                    <form id="update-accountinfo" method="POST">
                        <div style="display: block; align-items: center; margin: 0; padding: 0;">
                            <p class="header" style="justify-content: center; display: flex; margin-top: 0; text-align: center;">Chỉnh sửa thông tin cá nhân</p>
                            <div class="input-field">
                                <p class="field-label">Họ tên</p>
                                <input type='text' class='input-box max-width' id='fullname' name='fullname' value='<?php echo $result['fullname']; ?>'>
                            </div>
                            <div class="input-field">
                                <p class="field-label">Tên người dùng</p>
                                <input type='text' class='input-box max-width' id='username' name='username' value='<?php echo $_SESSION["user_username"]; ?>'>
                            </div>
                            <div class="input-field">
                                <p class="field-label">Email</p>
                                <input type='text' class='input-box max-width' id='email' name='email' value='<?php echo $result['email']; ?>'>
                            </div>
                            <div class="input-field">
                                <p class="field-label">Số điện thoại</p>
                                <input type='text' class='input-box max-width' id='phone' name='phone' value='<?php echo $result['phone']; ?>'>
                            </div>
                            <div class="input-field">
                                <p class="field-label">Ngày sinh</p>
                                <input type='text' class='input-box max-width' id='birthday' name='birthday' value='<?php echo $result['birthday']; ?>'>
                            </div>
                            <div class="submit-field">
                                <input type="submit" class="submit-button" value="Lưu">
                                <div class="cancel-button">Huỷ</div>
                            </div>
                        </div>
                    </form>
                </div>

                <script>
                    document.getElementById("update-accountinfo").addEventListener("submit", function(event) {
                    event.preventDefault();
                    var fullname = document.getElementById("fullname").value;
                    var username = document.getElementById("username").value;
                    var email = document.getElementById("email").value;
                    var phone = document.getElementById("phone").value;
                    var birthday = document.getElementById("birthday").value;

                    if (fullname === "" || username === "" || email === "" || phone === "" || birthday === "") {
                        alert("Vui lòng điền đầy đủ thông tin");
                        return;
                    }

                    var data = {
                        fullname: fullname,
                        username: username,
                        email: email,
                        phone: phone,
                        birthday: birthday
                    };

                    document.getElementById("loading-spinner").style.display = "flex";

                    fetch("./php/update_accountinfo.php", {
                        method: "POST",
                        headers: {
                            "Content-Type": "application/x-www-form-urlencoded"
                        },
                        body: new URLSearchParams(data)
                    })
                    .then(response => response.json())
                    .then(data => {
                        document.getElementById("loading-spinner").style.display = "none";

                        if (data.status === "success") {
                            alert(data.message);
                            window.location.reload();
                        } else {
                            alert(data.message);
                        }
                    })
                    .catch((error) => {
                        document.getElementById("loading-spinner").style.display = "none";
                        console.error("Error:", error);
                    });
                });
                </script>

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
                
                <div id="password-settings" class="hidden">
                    <form id="update-pwd" method="POST">
                        <div style="display: block; align-items: center; margin: 0; padding: 0;">
                            <p class="header" style="justify-content: center; display: flex; margin-top: 0; text-align: center;">Đổi mật khẩu</p>
                            <div class="input-field">
                                <p class="field-label">Mật khẩu cũ</p>
                                <input type="password" class="input-box" id="old_pwd" name="old_pwd" placeholder="Mật khẩu cũ">
                            </div>
                            <div class="input-field">
                                <p class="field-label">Mật khẩu mới</p>
                                <input type="password" class="input-box" id="new_pwd" name="new_pwd" placeholder="Mật khẩu mới">
                            </div>
                            <div class="input-field">
                                <p class="field-label">Nhập lại mật khẩu mới</p>
                                <input type="password" class="input-box" id="confirm_pwd" name="confirm_pwd" placeholder="Nhập lại mật khẩu mới">
                            </div>
                            <div class="submit-field">
                                <input type="submit" class="submit-button" value="Lưu">
                                <div class="cancel-button">Huỷ</div>
                            </div>
                        </div>
                    </form>
                </div>

                <script>
                    document.getElementById("update-pwd").addEventListener("submit", function(event) {
                        event.preventDefault();
                        var old_pwd = document.getElementById("old_pwd").value;
                        var new_pwd = document.getElementById("new_pwd").value;
                        var confirm_pwd = document.getElementById("confirm_pwd").value;

                        if (new_pwd !== confirm_pwd) {
                            alert("Mật khẩu mới không khớp");
                            return;
                        }
                        else if (old_pwd === new_pwd) {
                            alert("Mật khẩu mới không được trùng với mật khẩu cũ");
                            return;
                        }
                        else if (new_pwd.length < 8) {
                            alert("Mật khẩu mới phải chứa ít nhất 8 ký tự");
                            return;
                        }
                        else if (new_pwd.search(/[a-z]/) < 0) {
                            alert("Mật khẩu mới phải chứa ít nhất 1 ký tự thường");
                            return;
                        }
                        else if (new_pwd.search(/[A-Z]/) < 0) {
                            alert("Mật khẩu mới phải chứa ít nhất 1 ký tự hoa");
                            return;
                        }
                        else if (new_pwd.search(/[0-9]/) < 0) {
                            alert("Mật khẩu mới phải chứa ít nhất 1 số");
                            return;
                        }
                        else if (new_pwd.search(/[!@#$%^&*]/) < 0) {
                            alert("Mật khẩu mới phải chứa ít nhất 1 ký tự đặc biệt");
                            return;
                        }
                        else if (new_pwd.search(/\s/) >= 0) {
                            alert("Mật khẩu mới không được chứa khoảng trắng");
                            return;
                        }
                        else if (old_pwd === "" || new_pwd === "" || confirm_pwd === "") {
                            alert("Vui lòng nhập đầy đủ thông tin");
                            return;
                        }

                        document.getElementById("loading-spinner").style.display = "flex";

                        var data = {
                            current_pwd: old_pwd,
                            new_pwd: new_pwd,
                            confirm_pwd: confirm_pwd
                        };

                        fetch("./php/update_pwd.php", {
                            method: "POST",
                            headers: {
                                "Content-Type": "application/x-www-form-urlencoded"
                            },
                            body: new URLSearchParams(data)
                        })
                        .then(response => response.json())
                        .then(data => {
                            document.getElementById("loading-spinner").style.display = "none";

                            if (data.status === "success") {
                                alert(data.message);
                                document.getElementById("update-pwd").reset();
                                ClosePwd();
                            } else {
                                alert(data.message);
                            }
                        })
                        .catch(error => {
                            document.getElementById("loading-spinner").style.display = "none";

                            console.error("Error:", error);
                        });
                    });
                </script>

                <script>
                    function EditPwd() {
                        var pwd = document.getElementById("password-settings");
                        var overlay = document.getElementById("blur-overlay");
                        
                        pwd.classList.remove("hidden");
                        pwd.classList.add("show");

                        overlay.classList.remove("hidden");
                        overlay.classList.add("show");
                    }

                    function ClosePwd() {
                        var pwd = document.getElementById("password-settings");
                        var overlay = document.getElementById("blur-overlay");

                        overlay.classList.remove("show");
                        overlay.classList.add("hidden");
                        
                        pwd.classList.remove("show");
                        pwd.classList.add("hidden");
                    }

                    document.addEventListener("DOMContentLoaded", () => {
                        var editButton = document.querySelector(".pwd-button");
                        var overlay = document.getElementById("blur-overlay");

                        editButton.addEventListener("click", EditPwd);
                        
                        overlay.addEventListener("click", ClosePwd);
                        document.addEventListener('keydown', (event) => {
                            if (event.key === 'Escape') {
                                ClosePwd();
                            }
                        });
                        
                        var cancelButton = document.querySelectorAll(".cancel-button");
                        cancelButton.forEach(button => {
                            button.addEventListener("click", ClosePwd);
                        });
                    });
                </script>
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