<?php
session_start();

include './admin/dbh.php';
$book_query = "SELECT * FROM books";
$book_result = $conn->query($book_query);
$books = $book_result->fetch_assoc();

// Check if the user is logged in
$isLoggedIn = isset($_SESSION['user_id']);

// Function to render the navbar links based on user authentication status
function renderNavbarLinks($isLoggedIn) {
    if ($isLoggedIn) {
        // User is logged in
        echo '<a class="globalnav-item-show" href="./account/orders.php">Đơn hàng</a>';
        echo '<a class="globalnav-item-show" href="./account/saves.php">Mục đã lưu</a>';
        echo '<a class="globalnav-item-show" href="./account/profile.php">Tài khoản</a>';
        echo '<a class="globalnav-item-show" href="./signin/logout.php">Đăng xuất</a>';
        echo '<button id="profile-button"><img id="profile-icon" src="./assets/account.png" alt="Profile Icon"></button>';
    } else {
        // User is not logged in
        echo '<a class="globalnav-item" href="./signin/signin.php">Đăng nhập</a>';
    }
}
function renderfooterLinks($isLoggedIn) {
    if ($isLoggedIn) {
        echo '<li><a class="myLink" href="./account/profile.php">Tài khoản</a></li>';
        echo '<li><a class="myLink" href="./signin/logout.php">Đăng xuất</a></li>';
    } else {
        // User is not logged in
        echo '<li><a class="myLink" href="./signin/signin.php">Đăng nhập</a></li>';
    }
}
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
        <meta name="description" content="Explore, purchase, and engage in vibrant discussions about your favorite books on BookHub. Discover new reads and connect with fellow book lovers on our platform dedicated to fostering a thriving literary community.">
        <title>Home | BookHub</title>
        <link rel="stylesheet" type="text/css" href="./style.css">
        <link rel="stylesheet" type="text/css" href="./navbar.css">
        <link rel="stylesheet" type="text/css" href="./footer.css">
        <link rel="apple-touch-icon" sizes="180x180" href="./favicon_io/apple-touch-icon.png">
        <link rel="icon" type="image/png" sizes="32x32" href="./favicon_io/favicon-32x32.png">
        <link rel="icon" type="image/png" sizes="16x16" href="./favicon_io/favicon-16x16.png">
        <link rel="manifest" href="./favicon_io/site.webmanifest">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" />
    </head>
    
    <body>
        <h1 class="visuallyhidden">BookHub</h1>

        <!-- Navbar -->
        <nav class="navbar">
            <input type="checkbox" id="sidebar-active">
                <!-- New logo image that only appears when the navbar is collapsed -->
            <a href="./index.php"><img id="new-logo" src="./assets/BookHub.png" alt="New Logo"></a>

            <label for="sidebar-active" class="open-sidebar-button">
                <svg xmlns="http://www.w3.org/2000/svg" height="32" viewBox="0 -960 960 960" width="32" fill="#FFFFFF"><path d="M120-240v-80h720v80H120Zm0-200v-80h720v80H120Zm0-200v-80h720v80H120Z"/></svg>
            </label>

            <label id="overlay" for="sidebar-active"></label>

            <div class="link-container">
                <label for="sidebar-active" class="close-sidebar-button">
                    <svg xmlns="http://www.w3.org/2000/svg" height="32" viewBox="0 -960 960 960" width="32" fill="#FFFFFF"><path d="m256-200-56-56 224-224-224-224 56-56 224 224 224-224 56 56-224 224 224 224-56 56-224-224-224 224Z"/></svg>
                </label>
                
                <a class="logo-link" href="./index.php"><img id="BookHub" src="./assets/logo.png" alt="BookHub"></a>
                <a class="globalnav-item" href="./Book_Store/bookstore.php">Bookstore</a>
                <a class="globalnav-item" href="./aboutUs/aboutUs.php">Về Chúng Tôi</a>
                <a class="globalnav-item" href="./search/search.php">Tìm kiếm</a>
                <?php renderNavbarLinks($isLoggedIn); ?>
            </div>
        </nav>

         <!-- Account options -->
         <div id="blur-overlay" class="hidden"></div>
         <div id="account-options" class="hidden">
             <p id="myprofile">Hồ sơ của tôi</p>
             <div style="background-color: #d9d9d9; width: 25%; height: 0.05vw; margin: 0; padding: 0;"></div>
             <ul>
                 <li><img class="option-icons" src="./assets/orders.png"><a href="./account/orders.php">Đơn hàng</a></li>
                 <li><img class="option-icons" src="./assets/saves.png"><a href="./account/saves.php">Mục đã lưu</a></li>
                 <li><img class="option-icons" src="./assets/setting.png"><a href="./account/profile.php">Tài khoản</a></li>
                 <li><img class="option-icons" src="./assets/join.png"><a href="./signin/logout.php">Đăng xuất</a></li>
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
        
    
        <main>
        <div id="topimg">
                <div class="text">
                    <h2>Mua bán, trao đổi, thảo luận và cùng chia sẻ về những cuốn sách mà bạn yêu thích.</h2>
                    <div class="button-top">
                        <a href="./signin/signin.php" class="topbtn">Đăng ký ngay&nbsp;&#x276F;</a>
                        <a href="./aboutUs/aboutUs.php" class="more">Tìm hiểu thêm</a>
                    </div>
                </div>
            </div>

            <div style="margin-top: 2vw; margin-left:8vw;width: 85%; height: 1px; background-color: #F08A5D;"></div>
        
            <div id="promotion" style="display: flex;">
                <div class="promotion-p">
                    <div class="promotion-p1" style="margin-top: 2vw; margin-left: 3vw; width: 50vw; height: 0.3vw; background-color: #F08A5D;"></div>
                        <h2><a class="promotion-title" style="margin-left: 3vw;" href="./index.php">SẢN PHẨM NỔI BẬT ></a></h2>
                        <?php if (!empty($books)): ?>
                        <?php foreach ($books as $index => $book): ?>
                                <nav class="promotionnav">
                                <a class="promotionnav-item" href="./index.php" style="margin-left: 5vw;">
                                    <div class="promotionnav-item-1">
                                        <img src="./assets/etc.jpg" class="promotion-image"><br/>
                                        <p style="margin: 0; padding: 0; font-weight: 500; font-size: 1.75vw;"><?php echo $book['title'] ?></p>
                                        <p style="margin: 0; padding: 0; font-size: 1vw; font-size: 1.25vw;">4/5 <img src="./assets/star.png"></p>
                                        <p style="margin: 0; padding: 0; font-weight: 500; font-size: 1.5vw;">100.000 VND</p>
                                    </div>
                                </a>
                            </nav>
                            <?php endforeach; ?>
                        <?php else: ?>
                        <p>No books found.</p>
                    <?php endif; ?>
                    </div>
                    <div class="promotion-p2">
                        <div style="margin-top: 2vw; margin-left: 5vw; width: 20vw; height: 0.3vw; background-color: #F08A5D;"></div>
                        <h2><a class="promotion-title" style="margin-left: 7vw" href="./index.php">SẢN PHẨM TOP #1 ></a></h2>
                        <nav class="promotionnav" style="margin-left:2vw;">
                            <a class="promotionnav-item" href="./index.php" style="margin-left: 5vw;">
                                <div class="promotionnav-item-1">
                                    <img src="./assets/etc.jpg" class="promotion-image"><br/>
                                    <p style="margin: 0; padding: 0; font-weight: 500; font-size: 1.75vw;">HTML</p>
                                    <p style="margin: 0; padding: 0; font-size: 1vw; font-size: 1.25vw;">4/5 <img src="./assets/star.png"></p>
                                    <p style="margin: 0; padding: 0; font-weight: 500; font-size: 1.5vw;">100.000 VND</p>
                                </div>
                            </a>
                        </nav>
                    </div>
                </div>
                <div id="promotion" class="promotion-mobile">
                    <div style="margin-top: 2vw; margin-left: 3vw; width: 50vw; height: 0.3vw; background-color: #F08A5D;"></div>
                    <h2><a class="promotion-title" style="margin-left: 3vw;" href="./index.php">SẢN PHẨM ĐANG GIẢM GIÁ ></a></h2>
                    <nav class="promotionnav promotionnav1">
                        <a class="promotionnav-item" href="./index.php" style="margin-left: 5vw;">
                            <div class="promotionnav-item-1">
                                <img src="./assets/etc.jpg" class="promotion-image"><br/>
                                <p style="margin: 0; padding: 0; font-weight: 500; font-size: 1.75vw;">Book 1</p>
                                <p style="margin: 0; padding: 0; font-size: 1vw; font-size: 1.25vw;">4/5 <img src="./assets/star.png"></p>
                                <p style="margin: 0; padding: 0; font-weight: 400; font-size: 1.5vw; text-decoration-line: line-through; font-style: italic;">150.000 VND</p>
                                <p style="margin: 0; padding: 0; font-weight: 500; font-size: 2vw;">110.000 VND</p>
                            </div>
                            <!-- <img src="./assets/etc.jpg" class="promotion-image"><br/>
                            <p style="margin: 0; padding: 0; font-weight: 500; font-size: 1.75vw;">Book 1</p>
                            <p style="margin: 0; padding: 0; font-size: 1vw; font-size: 1.25vw;">4/5 <img src="./assets/star.png"></p>
                            <p style="margin: 0; padding: 0; font-weight: 400; font-size: 1.5vw; text-decoration-line: line-through; font-style: italic;">150.000 VND</p>
                            <p style="margin: 0; padding: 0; font-weight: 500; font-size: 2vw;">110.000 VND</p> -->
                        </a>
                        <a class="promotionnav-item" href="./index.php">
                            <div class="promotionnav-item-1">
                                <img src="./assets/etc.jpg" class="promotion-image"><br/>
                                <p style="margin: 0; padding: 0; font-weight: 500; font-size: 1.75vw;">Book 1</p>
                                <p style="margin: 0; padding: 0; font-size: 1vw; font-size: 1.25vw;">4/5 <img src="./assets/star.png"></p>
                                <p style="margin: 0; padding: 0; font-weight: 400; font-size: 1.5vw; text-decoration-line: line-through; font-style: italic;">200.000 VND</p>
                                <p style="margin: 0; padding: 0; font-weight: 500; font-size: 2vw;">135.000 VND</p>
                            </div>
                            <!-- <img src="./assets/etc.jpg" class="promotion-image"><br/>
                            <p style="margin: 0; padding: 0; font-weight: 500; font-size: 1.75vw;">Book 1</p>
                            <p style="margin: 0; padding: 0; font-size: 1vw; font-size: 1.25vw;">4/5 <img src="./assets/star.png"></p>
                            <p style="margin: 0; padding: 0; font-weight: 400; font-size: 1.5vw; text-decoration-line: line-through; font-style: italic;">200.000 VND</p>
                            <p style="margin: 0; padding: 0; font-weight: 500; font-size: 2vw;">135.000 VND</p> -->
                        </a>
                        <a class="promotionnav-item" href="./index.php">
                            <div class="promotionnav-item-1">
                                <img src="./assets/etc.jpg" class="promotion-image"><br/>
                                <p style="margin: 0; padding: 0; font-weight: 500; font-size: 1.75vw;">Book 1</p>
                                <p style="margin: 0; padding: 0; font-size: 1vw; font-size: 1.25vw;">4/5 <img src="./assets/star.png"></p>
                                <p style="margin: 0; padding: 0; font-weight: 400; font-size: 1.5vw; text-decoration-line: line-through; font-style: italic;">100.000 VND</p>
                                <p style="margin: 0; padding: 0; font-weight: 500; font-size: 2vw;">80.000 VND</p>
                            </div>
                            <!-- <img src="./assets/etc.jpg" class="promotion-image"><br/>
                            <p style="margin: 0; padding: 0; font-weight: 500; font-size: 1.75vw;">Book 1</p>
                            <p style="margin: 0; padding: 0; font-size: 1vw; font-size: 1.25vw;">4/5 <img src="./assets/star.png"></p>
                            <p style="margin: 0; padding: 0; font-weight: 400; font-size: 1.5vw; text-decoration-line: line-through; font-style: italic;">100.000 VND</p>
                            <p style="margin: 0; padding: 0; font-weight: 500; font-size: 2vw;">80.000 VND</p> -->
                        </a>
                    </nav> 
                </div>
            </div>
        
            <section id="best-seller" style="margin-left: 10vw;">
                <div style="margin-top: 2vw; margin-left: 2vw; width: 50vw; height: 0.3vw; background-color: #F08A5D;"></div>
                <h2><a class="promotion-title" style="margin-left: 2vw;" href="./index.php">THỂ LOẠI SÁCH BÁN CHẠY ></a></h2>
                <div class="details">
                    <!-- <div class="details-b1">
                        <span><a href="#">> Tình cảm</a></span>
                        <span><a href="#">> Bí ẩn</a></span>
                        <span><a href="#">> Giả tưởng và khoa học viễn tưởng</a></span>
                        <span><a href="#">> Kinh dị, giật gân</a></span>
                        <span><a href="#">> Self-help</a></span>
                        <span><a href="#">> Tiểu sử, tự truyện và hồi ký</a></span>
                    </div>
                    <div class="details-b2">
                        <span><a href="#">> Truyện ngắn</a></span>
                        <span><a href="#">> Nấu ăn</a></span>
                        <span><a href="#">> Bàn luận</a></span>
                        <span><a href="#">> Lịch sử</a></span>
                    </div> -->

                    <div class="details-b1">
                        <a href="#"><h5>> Tình cảm</h5></a>
                        <a href="#"><h5>> Bí ẩn</h5></a>
                        <a href="#"><h5>> Giả tưởng và khoa học viễn tưởng</h5></a>
                        <a href="#"><h5>> Kinh dị, giật gân</h5></a>
                        <a href="#"><h5>> Self-help</h5></a>
                        <a href="#"><h5>> Tiểu sử, tự truyện và hồi ký</h5></a>
                    </div>
                    <div class="details-b2">
                        <a href="#"><h5>> Truyện ngắn</h5></a>
                        <a href="#"><h5>> Nấu ăn</h5></a>
                        <a href="#"><h5>> Bàn luận</h5></a>
                        <a href="#"><h5>> Lịch sử</h5></a>
                    </div>
                </div>
            </section>
                
            <section id="post">
                <div style="display: flex; margin-left: 12vw">
                    <div class="post-mobile">
                        <div style="margin-top: 2vw; width: 50vw; height: 0.3vw; background-color: #F08A5D;"></div>
                        <h2><a class="promotion-title" style="margin-left: 0vw;" href="./index.php">BÀI VIẾT NỔI BẬT ></a></h2>
                        <div style="display:flex">
                            <nav class="postnav">
                                <a class="post-item" href="./index.php" style="margin-left: 0vw;">
                                    <img src="./assets/book2.jpg" class="promotion-image"><br/>
                                    <p style="margin: 0; padding: 0; font-weight: 1000; font-size: 1.5vw;">THẢO LUẬN VỀ SÁCH SỐ 2</p>
                                    <p style="margin: 0; padding: 0; font-weight: 500; font-size: 1.25vw;">Đăng bởi: user1</p>
                                    <p style="margin: 0; padding: 0; font-weight: 300; font-size: 1vw;">
                                        <br/>Lorem ipsum dolor sit amet, consectetuer adipiscing elit.
                                        Aenean commodo ligula eget dolor. Aenean massa. Cum sociis
                                        natoque penatibus et magnis dis parturient montes, nascetur
                                        ridiculus mus. Donec quam felis, ultricies nec, pellentesque
                                        eu, pretium quis, sem. Nulla consequat massa quis enim...
                                    </p>
                                </a>
                                <a class="post-item" href="./index.php" style="margin-left: 3vw;">
                                    <img src="./assets/book2.jpg" class="promotion-image"><br/>
                                    <p style="margin: 0; padding: 0; font-weight: 1000; font-size: 1.75vw;">THẢO LUẬN VỀ SÁCH SỐ 3</p>
                                    <p style="margin: 0; padding: 0; font-weight: 500; font-size: 1.25vw;">Đăng bởi: user2</p>
                                    <p style="margin: 0; padding: 0; font-weight: 300; font-size: 1vw;">
                                        <br/>Lorem ipsum dolor sit amet, consectetuer adipiscing elit.
                                        Aenean commodo ligula eget dolor. Aenean massa. Cum sociis
                                        natoque penatibus et magnis dis parturient montes, nascetur
                                        ridiculus mus. Donec quam felis, ultricies nec, pellentesque
                                        eu, pretium quis, sem. Nulla consequat massa quis enim...
                                    </p>
                                </a>
                            </nav>
                        </div>
                    </div>
                    <div>
                        <div style="margin-top: 2vw; margin-left: 5vw; width: 20vw; height: 0.3vw; background-color: #F08A5D;"></div>
                        <h2><a class="promotion-title" style="margin-left: 7vw" href="./index.php">BÀI VIẾT GẦN ĐÂY ></a></h2>
                        <nav class="postnav">
                            <span class="post1-item" href="./index.php" style="margin-left: 7vw;">
                                <a href="" style="text-decoration: none;color:#ffffff;"> <i>> Lorem ipsum dolor sit amet, consectetuer adipiscing elit.
                                    Aenean commodo ligula eget dolor.</i> - bởi user1</a>
                                <br/><br/><a href="" style="text-decoration: none;color:#ffffff;"> <i>> Lorem ipsum dolor sit amet, consectetuer adipiscing elit.
                                        Aenean commodo ligula eget dolor.</i> - bởi user2</a>
                                <br/><br/><a href="" style="text-decoration: none;color:#ffffff;"> <i>> Lorem ipsum dolor sit amet, consectetuer adipiscing elit.
                                            Aenean commodo ligula eget dolor.</i> - bởi user3</a>
                            </span>
                        </nav>
                    </div>
                </div>
            </section>
        
            <div style="display: flex; padding-bottom: 3vw; margin-left: 10vw;">     
                <div id="nomination">
                    <div style="margin-top: 2vw; margin-left: 2vw; width: 50vw; height: 0.3vw; background-color: #F08A5D;"></div>
                    <h2><a class="promotion-title" style="margin-left: 2vw;" href="./index.php">ĐỀ CỬ DÀNH CHO BẠN ></a></h2>
                    <nav class="promotionnav">
                        <a class="promotionnav-item" href="./index.php" style="margin-left: 5vw;">
                            <img class="promotion-image1" src="./assets/book2.jpg" align= "right" height="100" width= "100"<br/>
                            <p style="text-align: right; margin: 0; padding: 0; font-weight: 600; font-size: 1.75vw;">Book 1</p>
                        </a>
                        <a class="promotionnav-item" href="./index.php">
                            <img class="promotion-image1" src="./assets/book2.jpg" align= "right" height="100" width= "100"<br/>
                            <p style="text-align: right; margin: 0; padding: 0; font-weight: 600; font-size: 1.75vw;">Book 2</p>
                        </a>
                        <a class="promotionnav-item" href="./index.php">
                            <img class="promotion-image1" src="./assets/book2.jpg" align= "right" height="100" width= "100"<br/>
                            <p style="text-align: right; margin: 0; padding: 0; font-weight: 600; font-size: 1.75vw;">Book 3</p>
                        </a>
                    </nav>
                    <nav class="promotionnav" style="margin-top: 2vw;">
                        <a class="promotionnav-item" href="./index.php" style="margin-left: 5vw;">
                            <img class="promotion-image1" src="./assets/book2.jpg" align= "right" height="100" width= "100"<br/>
                            <p style="text-align: right; margin: 0; padding: 0; font-weight: 600; font-size: 1.75vw;">Book 4</p>
                        </a>
                        <a class="promotionnav-item" href="./index.php">
                            <img class="promotion-image1" src="./assets/book2.jpg" align= "right" height="100" width= "100"<br/>
                            <p style="text-align: right; margin: 0; padding: 0; font-weight: 600; font-size: 1.75vw;">Book 5</p>
                        </a>
                        <a class="promotionnav-item" href="./index.php">
                            <img class="promotion-image1" src="./assets/book2.jpg" align= "right" height="100" width= "100"<br/>
                            <p style="text-align: right; margin: 0; padding: 0; font-weight: 600; font-size: 1.75vw;">Book 6</p>
                        </a>
                    </nav>
                </div>
                <div>
                    <div style="margin-top: 2vw; margin-left: 5vw; width: 20vw; height: 0.3vw; background-color: #F08A5D;"></div>
                    <h2><a class="promotion-title" style="margin-left: 4.5vw" href="./index.php">CÂU NÓI HAY CỦA NGÀY ></a></h2>
                    <div class="promotionnav">
                        <a class="promotionnav-item1" href="./index.php" style="margin-left: 8vw; border: solid 3px; border-color: #F08A5D; padding-bottom: 2vw; padding-left: 2vw; padding-right: 2vw;">
                            <p style="font-size:1.1vw; text-align: justify;"><i>"Chỉ khi bạn có một khát khao, một ước mơ mãnh liệt cũng như cố gắng hết sức để đạt được ước mơ đó, thì vũ trụ sẽ đáp lại mong muốn sâu thẳm trong tâm hồn bạn."</i><br></p>
                            <p class="promotionnav-item1-p" style="text-align: right; font-weight: 500; font-size: 1.25vw;"><h5> - Nhà giả kim - </h5></p>
                        </a>
                    </div>
                </div>
            </div>
        
            <div id="notification">
                <div style="margin-left: 9vw; width: 50vw; height: 0.3vw; background-color: #F08A5D;"></div>
                <h2><a class="promotion-title" style="margin-top: 2vw; margin-left: 9vw;" href="./index.php">THÔNG BÁO MỚI ></a></h2>
                <div class="notification" style="background-color: #F08A5D; display: flex; padding: 3vw; margin-left: 9vw; border-radius: 1vw;">
                    <nav style="display: flex;">
                        <img src="./assets/book2.jpg" style="width: 50%; height: auto; padding: 0; margin: 0; border-radius: 4%;">
                        <span class="noti">
                            <a href="#">> Bảo trì web ngày .../...</a><br/>
                            <a href="#">> Sự cố về việc đăng nhập</a><br/>
                            <a href="#">> Thông báo về việc cập nhật sách mới</a><br/>
                            <a href="#">> Thông báo về việc cập nhật sách mới</a><br/>
                            <a href="#">> Thông báo về việc cập nhật sách mới</a><br/>
                            <a href="#">> Bảo trì web ngày .../...</a><br/>
                            <a href="#">> Giao hàng thành công</a><br/>
                            <a href="#">> Thông báo về việc cập nhật sách mới</a><br/>
                            <a href="#">> Cập nhật thanh toán</a><br/>
                            <a href="#">> Đơn hàng đã được cập nhật</a><br/>
                        </span>
                    </nav>
                </div>
                
            </div>
        </main>

        <footer>
            <div class="footer-section footer-content">
                <p class="section-title">VỀ BOOKHUB</p>
                <div class="divider short-divider"></div>
                <p class="description">BookHub là nền tảng kết nối những người<br/>có niềm yêu thích sách lại với nhau.</p>
                <div class="social-links">
                    <a href="https://facebook.com" target="_blank"><img src="./assets/facebook.png" alt="facebook" class="social-icon"></a>
                    <a href="https://instagram.com" target="_blank"><img src="./assets/instagram.png" alt="instagram" class="social-icon"></a>
                </div>
            </div>
            <div class="footer-section link_contact">
                <p class="section-title">ĐƯỜNG DẪN</p>
                <div class="divider"></div>
                <ul class="links-list">
                    <li><a href="./Book_Store/bookstore.php" class="myLink">Bookstore</a></li>
                    <li><a href="./aboutUs/aboutUs.php" class="myLink">Về Chúng Tôi</a></li>
                    <?php renderfooterLinks($isLoggedIn); ?>
                    <li><a href="./search/search.php" class="myLink">Tìm kiếm</a></li>
                </ul>
            </div>
            <div class="footer-section contact">
                <p class="section-title">LIÊN HỆ</p>
                <div class="divider"></div>
                <table>
                    <tr>
                        <td><img src="./assets/phone-call.png" alt="phone" class="contact-icon"></td>
                        <td class="contact-info">016.161.6161</td>
                    </tr>
                    <tr>
                        <td><img src="./assets/email.png" alt="mail" class="contact-icon"></td>
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
