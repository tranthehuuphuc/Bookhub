<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
    <title>Search | Bookhub</title>
    <link rel="stylesheet" type="text/css" href="../style.css">
    <link rel="stylesheet" type="text/css" href="./search.css">
    <link rel="stylesheet" type="text/css" href="../footer.css">
    <link rel="stylesheet" type="text/css" href="../navbar.css">
    <link rel="apple-touch-icon" sizes="180x180" href="./favicon_io/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="./favicon_io/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="./favicon_io/favicon-16x16.png">
    <link rel="manifest" href="./favicon_io/site.webmanifest">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" />
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
                <a class="globalnav-item" href="../discuss/discuss.php">Thảo luận</a>
                <a class="globalnav-item" href="../signin/signin.php">Đăng nhập</a>
                <a class="globalnav-item" href="../search/search.php">Tìm kiếm</a>
                <a class="globalnav-item-show" href="../account/orders.php">Đơn hàng</a>
                <a class="globalnav-item-show" href="../account/saves.php">Mục đã lưu</a>
                <a class="globalnav-item-show" href="../account/profile.php">Tài khoản</a>
                <a class="globalnav-item-show" href="../signin/logout.php">Đăng xuất</a>
                <button id="profile-button"><img id="profile-icon" src="../assets/account.png" alt="Profile Icon"></button>
            </div>
        </nav>

        <!-- account options -->
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
        <!-- End of account options -->

        <div class="wrapper" style="margin-top: 5vw;margin-bottom: 5vw;">
            <div id="search-container">
                <form id="search-form" action="./search.php" method="GET">
                    <input type="search" id="search-input" name="search" placeholder="Tìm kiếm sách.." />
                    <button id="search">Tìm kiếm</button>
                </form>
            </div>
            <div id="buttons">
                <button class="button-value" onclick="filterProduct('category', '1')">Thể loại</button>
                <button class="button-value" onclick="filterProduct('author', '1')">Tác giả</button>
                <button class="button-value" onclick="filterProduct('publisher', 'Nhà xuất bản')">Nhà xuất bản</button>
            </div>
            <div id="products"></div>
        </div>



        <section id="product1" class="section-p1">
            <div class="pro-container">
                <?php 
                require_once './php/search_model.php'; 
                require_once './php/search_contr.php';
                ?>

                <?php if (!empty($books)): ?>
                    <?php foreach ($books as $index => $book): ?>
                        <div class="pro" 
                            data-category="<?php echo htmlspecialchars($book['category_ids']); ?>" 
                            data-author="<?php echo htmlspecialchars($book['author_id']); ?>" 
                            data-publisher="<?php echo htmlspecialchars($book['publisher']); ?>">

                            <img src="<?php echo '../admin/uploads/' . htmlspecialchars($book['cover_image']); ?>" alt="<?php echo htmlspecialchars($book['title']); ?>">
                            <div class="des">
                                <span><?php echo htmlspecialchars($book['publisher']); ?></span>
                                <h5><?php echo htmlspecialchars($book['title']); ?></h5>
                                <div class="star">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p>No books found.</p>
                <?php endif; ?>
            </div>
        </section>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const params = new URLSearchParams(window.location.search);
        const isFirstBook = document.querySelector('.pro:first-of-type');
        const firstBookCategory = isFirstBook ? isFirstBook.getAttribute('data-category') : null;
        const firstBookAuthor = isFirstBook ? isFirstBook.getAttribute('data-author') : null;
        const firstBookPublisher = isFirstBook ? isFirstBook.getAttribute('data-publisher') : null;

        if (isFirstBook) {
            params.set('category', firstBookCategory);
            params.set('author', firstBookAuthor);
            params.set('publisher', firstBookPublisher);
            const newUrl = window.location.pathname + '?' + params.toString();
            window.history.replaceState({}, '', newUrl);
        }
    });


    function filterProduct(filterType, filterValue) {
        const params = new URLSearchParams();

        // Set the new filter parameter
        params.set(filterType, filterValue);

        // Get the corresponding attribute values from the first book element
        const isFirstBook = document.querySelector('.pro:first-of-type');
        let firstBookCategory = null;
        let firstBookAuthor = null;
        let firstBookPublisher = null;
        if (isFirstBook) {
            if (filterType === 'category') {
                firstBookCategory = isFirstBook.getAttribute('data-category');
            } else if (filterType === 'author') {
                firstBookAuthor = isFirstBook.getAttribute('data-author');
            } else if (filterType === 'publisher') {
                firstBookPublisher = isFirstBook.getAttribute('data-publisher');
            }
        }

        // Set the additional attributes if available
        if (firstBookCategory) {
            params.set('category', firstBookCategory);
        }
        if (firstBookAuthor) {
            params.set('author', firstBookAuthor);
        }
        if (firstBookPublisher) {
            params.set('publisher', firstBookPublisher);
        }

        // Construct the new URL
        const newUrl = window.location.pathname + '?' + params.toString();
        window.location.href = newUrl;
    }


</script>

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
</body>
</html>
