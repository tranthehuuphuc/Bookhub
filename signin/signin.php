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
    <meta name="description" content="Đăng nhập hoặc đăng ký để trở thành thành viên của BookHub. Tham gia cộng đồng yêu sách và khám phá những cuốn sách mới mỗi ngày.">
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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>

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
          <a class="globalnav-item" href="../signin/signin.php">Đăng nhập</a>
      </div>
  </nav>
  

    <div class="container">
      <div class="forms-container">
        <div class="signin-signup">
        <div style="text-align:center; margin:3vw">
                    <?php check_signup_errors();?>
                    <?php check_login_errors();?>
        </div>
          <form class="sign-in-form" method="post">
            <h2 class="title">Đăng nhập</h2>
            <div class="input-field">
              <i class="fas fa-user"></i>
              <input type="text" placeholder="Username" name="username" required/>
            </div>
            <div class="input-field">
              <i class="fas fa-lock"></i>
              <input type="password" placeholder="Password" name="pwd" required/>
            </div>
            <input id="login-btn" type="submit" value="Đăng nhập" class="btn solid" />
          </form>

          <script>
            document.getElementById("login-btn").addEventListener("click", function() {
              event.preventDefault();
              login_request();
            });

            function login_request() {
              $.ajax({
                url: "./php/login.php",
                type: "POST",
                dataType: "json",
                data: {
                  username: $("input[name='username']").val(),
                  pwd: $("input[name='pwd']").val()
                },
                success: function(response) {
                  if (response.status === "success") {
                    if (response.message === "admin") {
                      window.location.href = "../admin/admin.php";
                    } else {
                      window.location.href = "../index.php";
                    }
                  } else {
                    alert(response.message);
                  }
                }
              });
            }

          </script>

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