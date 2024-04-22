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
    <link rel="stylesheet" type="text/css" href="../signin/signin.css">
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

    <div id="globalheader">
        <a href="../Bookhub.html"><img id="BookHub" src="../assets/logo.png" alt="BookHub"></a>
        <nav id="globalnav">
            <a class="globalnav-item" href="../Book_Store/bookstore.html">Bookstore</a>
            <a class="globalnav-item" href="../Bookhub.html">Thể loại</a>
            <a class="globalnav-item" href="../thao luan va chi tiet.html">Thảo luận</a>
            <a class="globalnav-item" href="../signin/signin.php">Đăng nhập</a>
            <a href="../search/search.html" style="width: 3vw; height: 3vw;"><img src="../assets/search.png" alt="Search" style="width: 3vw; height: 3vw; margin: 0px;"></a>
        </nav>
        <button id="profile-button" onclick="window.location.href='signin.php'"><img id="profile-icon" src="../Account/AccountAssets/account.png" alt="Profile Icon"></button>
    </div>

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
            <h3>Chưa có tài khoản?</h3>
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
            <h3>Đã có tài khoản?</h3>
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
        <div class="footer-content1" style="padding: 0.7vw;">
            <p style="font-size: 1vw;">&copy; 2024 BookHub. All rights reserved.</p>
    </footer>
    
</body>
</html>