<?php
require_once "php/config_session.php";
require_once "php/signup_view.php";
require_once "php/login_view.php";
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
    <title>Sign in | Bookhub</title>
    <link rel="stylesheet" type="text/css" href="./signin.css">
    <link rel="stylesheet" type="text/css" href="../navbar.css">
    <link rel="stylesheet" type="text/css" href="../footer.css">
    <script
      src="https://kit.fontawesome.com/64d58efce2.js"
      crossorigin="anonymous"
    ></script>
    <link rel="apple-touch-icon" sizes="180x180" href="../signin/favicon_io/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="../signin/favicon_io/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="16x16" href="../signin/favicon_io/favicon-16x16.png">
    <link rel="manifest" href="../sigin/favicon_io/site.webmanifest">
    
</head>
<body>

  <!-- Navbar -->
  <nav class="navbar">
      <input type="checkbox" id="sidebar-active">
          <!-- New logo image that only appears when the navbar is collapsed -->
      <a href="../Bookhub.html"><img id="new-logo" src="../assets/BookHub.png" alt="New Logo"></a>

      <label for="sidebar-active" class="open-sidebar-button">
          <svg xmlns="http://www.w3.org/2000/svg" height="32" viewBox="0 -960 960 960" width="32" fill="#FFFFFF"><path d="M120-240v-80h720v80H120Zm0-200v-80h720v80H120Zm0-200v-80h720v80H120Z"/></svg>
      </label>

      <label id="overlay" for="sidebar-active"></label>

      <div class="link-container">
          <label for="sidebar-active" class="close-sidebar-button">
              <svg xmlns="http://www.w3.org/2000/svg" height="32" viewBox="0 -960 960 960" width="32" fill="#FFFFFF"><path d="m256-200-56-56 224-224-224-224 56-56 224 224 224-224 56 56-224 224 224 224-56 56-224-224-224 224Z"/></svg>
          </label>
          
          <a class="logo-link" href="../Bookhub.html"><img id="BookHub" src="../assets/logo.png" alt="BookHub"></a>
          <a class="globalnav-item" href="../Book_Store/bookstore.php">Bookstore</a>
          <a class="globalnav-item" href="../discuss/discuss.php">Thảo luận</a>
          <a class="globalnav-item" href="../signin/signin.php">Đăng nhập</a>
          <a class="globalnav-item" href="../search/search.html">Tìm kiếm</a>
          <a class="globalnav-item-show" href="../Account/AccountReceipts.html">Đơn hàng</a>
          <a class="globalnav-item-show" href="../Account/AccountCart.html">Mục đã lưu</a>
          <a class="globalnav-item-show" href="../Account/AccountSettings.html">Tài khoản</a>
          <a class="globalnav-item-show" href="../Account/AccountAssets/join.png">Đăng xuất</a>
          <button id="profile-button"><img id="profile-icon" src="../assets/account.png" alt="Profile Icon"></button>
      </div>
  </nav>

    <!-- Account options -->
    <div id="blur-overlay" class="hidden"></div>
    <div id="account-options" class="hidden">
        <p id="myprofile">Hồ sơ của tôi</p>
        <div style="background-color: #d9d9d9; width: 25%; height: 0.05vw; margin: 0; padding: 0;"></div>
        <ul>
            <li><img class="option-icons" src="../assets/orders.png"><a href="../account/orders.html">Đơn hàng</a></li>
            <li><img class="option-icons" src="../assets/saves.png"><a href="../account/saves.html">Mục đã lưu</a></li>
            <li><img class="option-icons" src="../assets/setting.png"><a href="../account/profile.html">Tài khoản</a></li>
            <li><img class="option-icons" src="../assets/join.png"><a href="../Bookhub.html">Đăng xuất</a></li>
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
  

    <div class="container">
      <div class="forms-container">
        <div class="signin-signup">
        <div style="text-align:center; margin:3vw">
                    <?php check_signup_errors();?>
                    <?php check_login_errors();?>
        </div>
          <form action="./php/login.php" class="sign-in-form" method="post">
            <h2 class="title">Đăng nhập</h2>
            <div class="input-field">
              <i class="fas fa-user"></i>
              <input type="text" placeholder="Username" name="username" required/>
            </div>
            <div class="input-field">
              <i class="fas fa-lock"></i>
              <input type="password" placeholder="Password" name="pwd" required/>
            </div>
            <input type="submit" value="Đăng nhập" class="btn solid" />
            <p class="social-text">Hoặc đăng nhập bằng: </p>
            <div class="social-media">
              <a href="#" class="social-icon">
                <i class="fab fa-facebook-f"></i>
              </a>
              <a href="#" class="social-icon">
                <i class="fab fa-twitter"></i>
              </a>
              <a href="#" class="social-icon">
                <i class="fab fa-google"></i>
              </a>
              <a href="#" class="social-icon">
                <i class="fab fa-linkedin-in"></i>
              </a>
            </div>
          </form>
          <form action="./php/signup.php" class="sign-up-form" method="post">
            <h2 class="title">Đăng ký</h2>
            <div class="input-field">
              <i class="fas fa-user"></i>
              <input type="text" placeholder="Username" name="username" required/>
            </div>
            <div class="input-field">
              <i class="fas fa-envelope"></i>
              <input type="email" placeholder="Email" name="email" required/>
            </div>
            <div class="input-field">
              <i class="fas fa-lock"></i>
              <input type="password" placeholder="Password" name="pwd" required/>
            </div>
            <input type="submit" class="btn" value="Đăng ký" />
            <p class="social-text">Hoặc đăng nhập bằng: </p>
            <div class="social-media">
              <a href="#" class="social-icon">
                <i class="fab fa-facebook-f"></i>
              </a>
              <a href="#" class="social-icon">
                <i class="fab fa-twitter"></i>
              </a>
              <a href="#" class="social-icon">
                <i class="fab fa-google"></i>
              </a>
              <a href="#" class="social-icon">
                <i class="fab fa-linkedin-in"></i>
              </a>
            </div>
          </form>
        </div>
      </div>

      <div class="panels-container">
        <div class="panel left-panel">
          <div class="content">
            <h2>Chưa có tài khoản?</h2>
            <p>
              Đăng ký và tham gia ngay với chúng tôi!
            </p>
            <button class="btn transparent" id="sign-up-btn">
              Đăng ký
            </button>
          </div>
        </div>
        <div class="panel right-panel">
          <div class="content">
            <h2>Đã có tài khoản?</h2>
            <p>
              Đăng nhập ngay bây giờ!
            </p>
            <button class="btn transparent" id="sign-in-btn">
              Đăng nhập
            </button>
          </div>
        </div>
      </div>
    </div>

    <script src="..\signin\app.js"></script>
    <footer>
        <div class="footer-bottom">
            <p class="copyright">&copy; 2024 BookHub. All rights reserved.</p>
        </div>
    </footer>
    
</body>
</html>