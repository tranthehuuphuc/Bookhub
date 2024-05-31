<?php

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
    <title>Search | Bookhub</title>
    <link rel="stylesheet" type="text/css" href="../style.css">
    <link rel="stylesheet" type="text/css" href="../footer.css">
    <link rel="stylesheet" type="text/css" href="../navbar.css">
    <link rel="stylesheet" type="text/css" href="./search.css">
    <!-- <link rel="stylesheet" type="text/css" href="../Book_Store/style.css"> -->
    <!-- <link rel="stylesheet" type="text/css" href="../search.css"> -->
    <link rel="apple-touch-icon" sizes="180x180" href="../search/favicon_io/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="../search/favicon_io/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="../search/favicon_io/favicon-16x16.png">
    <link rel="manifest" href="../search/favicon_io/site.webmanifest">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" />
</head>

<body>
  <nav class="navbar">
    <input type="checkbox" id="sidebar-active">
        <!-- New logo image that only appears when the navbar is collapsed -->
    <a href="../index.html"><img id="new-logo" src="../assets/BookHub.png" alt="New Logo"></a>

    <label for="sidebar-active" class="open-sidebar-button">
        <svg xmlns="http://www.w3.org/2000/svg" height="32" viewBox="0 -960 960 960" width="32" fill="#FFFFFF"><path d="M120-240v-80h720v80H120Zm0-200v-80h720v80H120Zm0-200v-80h720v80H120Z"/></svg>
    </label>

    <label id="overlay" for="sidebar-active"></label>

    <div class="link-container">
        <label for="sidebar-active" class="close-sidebar-button">
            <svg xmlns="http://www.w3.org/2000/svg" height="32" viewBox="0 -960 960 960" width="32" fill="#FFFFFF"><path d="m256-200-56-56 224-224-224-224 56-56 224 224 224-224 56 56-224 224 224 224-56 56-224-224-224 224Z"/></svg>
        </label>
        
        <a class="logo-link" href="../index.html"><img id="BookHub" src="../assets/logo.png" alt="BookHub"></a>
        <a class="globalnav-item" href="../Book_Store/bookstore.php">Bookstore</a>
        <a class="globalnav-item" href="../discuss/discuss.php">Thảo luận</a>
        <a class="globalnav-item" href="../signin/signin.php">Đăng nhập</a>
        <a class="globalnav-item" href="../search/search.html">Tìm kiếm</a>
        <a class="globalnav-item-show" href="../account/AccountReceipts.html">Đơn hàng</a>
        <a class="globalnav-item-show" href="../account/AccountCart.html">Mục đã lưu</a>
        <a class="globalnav-item-show" href="../account/AccountSettings.html">Tài khoản</a>
        <a class="globalnav-item-show" href="../account/AccountAssets/join.png">Đăng xuất</a>
        <button id="profile-button"><img id="profile-icon" src="../assets/account.png" alt="Profile Icon"></button>
    </div>
  </nav>

  <div id="blur-overlay" class="hidden"></div>
  <div id="account-options" class="hidden">
      <p id="myprofile">Hồ sơ của tôi</p>
      <div style="background-color: #d9d9d9; width: 25%; height: 0.05vw; margin: 0; padding: 0;"></div>
      <ul>
          <li><img class="option-icons" src="../assets/orders.png"><a href="../account/orders.html">Đơn hàng</a></li>
          <li><img class="option-icons" src="../assets/saves.png"><a href="../account/saves.html">Mục đã lưu</a></li>
          <li><img class="option-icons" src="../assets/setting.png"><a href="../account/profile.html">Tài khoản</a></li>
          <li><img class="option-icons" src="../assets/join.png"><a href="../index.html">Đăng xuất</a></li>
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

    <div class="books">
        <!-- <div class="dropdown">
            <div class="select">
                <span class="selected">Programming Language</span>
                <div class="caret"></div>
            </div>
            <ul class="menu">
                <li>C/C++</li>
                <li>Python</li>
                <li>Java</li>
                <li>Golang</li>
                <li>CSharp</li>
            </ul>
        </div>

        <div class="dropdown">
            <div class="select">
                <span class="selected">Price</span>
                <div class="caret"></div>
            </div>
            <ul class="menu">
                <li>50.000d - 100.000d</li>
                <li>100.000d - 200.000d</li>
                <li>Trên 200.000d</li>
            </ul>
        </div>

        <div class="dropdown">
            <div class="select">
                <span class="selected">System Design</span>
                <div class="caret"></div>
            </div>
            <ul class="menu">
                <li>Design Tutorial</li>
                <li>Design Patterns</li>
                <li>Design Roadmap</li>
            </ul>
        </div> -->

    </div>

    <script src="./search.js"></script>

    <div class="wrapper" style="margin-top: 5vw;margin-bottom: 5vw;">
        <div id="search-container">
            <form action="./php/search_view.php" method="GET">
                <input type="search" id="search-input" name="search" placeholder="Tìm kiếm sách.." />
                <button id="search">Tìm kiếm</button>
            </form>
        </div>
        <div id="buttons">
            <button class="button-value" onclick="filterProduct('Sách')">Sách</button>
            <button class="button-value" onclick="filterProduct('Thể loại')">Thể loại</button>
            <button class="button-value" onclick="filterProduct('Tác giả')">Tác giả</button>
            <button class="button-value" onclick="filterProduct('Thảo luận')">Nhà xuất bản</button>
        </div>
        <div id="products"></div>
    </div>

    <section id="product1" class="section-p1">
        <div class="pro-container">
            <div class="pro" onclick="window.location.href='../thao luan va chi tiet.html';">
                <img src="../assets/etc.jpg" alt="">
                <div class="des">
                    <span>Technology</span>
                    <h5>abcd</h5>
                    <div class="star">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                    </div>
                </div>
            </div>

            <div class="pro" onclick="window.location.href='../thao luan va chi tiet.html';">
                <img src="../assets/etc.jpg" alt="">
                <div class="des">
                    <span>Technology</span>
                    <h5>C/C++ Programming</h5>
                    <div class="star">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                    </div>
                </div>
            </div>

            <div class="pro" onclick="window.location.href='../thao luan va chi tiet.html';">
                <img src="../assets/etc.jpg" alt="">
                <div class="des">
                    <span>Technology</span>
                    <h5>C/C++ Programming</h5>
                    <div class="star">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                    </div>
                </div>
            </div>

            <div class="pro" onclick="window.location.href='../thao luan va chi tiet.html';">
                <img src="../assets/etc.jpg" alt="">
                <div class="des">
                    <span>Technology</span>
                    <h5>C/C++ Programming</h5>
                    <div class="star">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                    </div>
                </div>
            </div>

            <div class="pro" onclick="window.location.href='../thao luan va chi tiet.html';">
                <img src="../assets/etc.jpg" alt="">
                <div class="des">
                    <span>Technology</span>
                    <h5>C/C++ Programming</h5>
                    <div class="star">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                    </div>
                </div>
            </div>

            <div class="pro" onclick="window.location.href='../thao luan va chi tiet.html';">
                <img src="../assets/etc.jpg" alt="">
                <div class="des">
                    <span>Technology</span>
                    <h5>C/C++ Programming</h5>
                    <div class="star">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                    </div>
                </div>
            </div>
        </div>
    </section>

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
                <li><a href="../discuss/discuss.php" class="myLink">Thảo luận</a></li>
                <li><a href="../signin/signin.php" class="myLink">Đăng nhập</a></li>
                <li><a href="../search/search.html" class="myLink">Tìm kiếm</a></li>
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

</body>

</html>