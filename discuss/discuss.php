<?php
    include 'dbh.php';
?>

<!DOCTYPE html>
<html>
<head>
    <title>Discuss | Bookhub</title>
    <link rel="stylesheet" type="text/css" href="../style.css">
    <link rel="stylesheet" type="text/css" href="discuss.css">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
    <link rel="apple-touch-icon" sizes="180x180" href="../favicon_io/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="../favicon_io/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="../favicon_io/favicon-16x16.png">
    <link rel="manifest" href="../favicon_io/site.webmanifest">

    <script src="https://code.jquery.com/jquery-3.7.1.min.js" 
    integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" 
    crossorigin="anonymous"></script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

    <script>
        $(document).ready(function(){
            var commentCount = 2;
            $("#loadBtn").click(function(){
                commentCount = commentCount + 2;
                $("#cmts").load("load-comments.php", {
                    commentNewCount: commentCount
                });
            });
        });
    </script>

    <script>
        $(document).ready(function() {
            $('#searchcmt').submit(function(event) {
                event.preventDefault(); // Prevent default form submission
                var query = $('#searchInput').val().trim();
                if (query !== '') {
                    $.ajax({
                        url: 'search.php',
                        method: 'GET',
                        data: { query: query },
                        success: function(response) {
                            $('#searchResults').html(response);
                        },
                        error: function(xhr, status, error) {
                            console.error(error);
                        }
                    });
                } else {
                    $('#searchResults').empty();
                }
            });
        });
    </script>

</head>
</html>
<body>
    <h1 class="visuallyhidden">BookHub</h1>

    <div id="globalheader">
        <a href="../Bookhub.html"><img id="BookHub" src="../assets/logo.png" alt="BookHub"></a>
        <nav id="globalnav">
            <a class= "globalnav-item" href="../Book_Store/Bookstore.html">Bookstore</a>
            <a class="globalnav-item" href="../Bookhub.html">Thể loại</a>
            <a class="globalnav-item" href="../thao luan va chi tiet.html">Thảo luận</a>
            <a class="globalnav-item" href="../signin/signin.php">Đăng nhập</a>
            <a href="../search/search.html" style="width: 3vw; height: 3vw;"><img src="../assets/search.png" alt="Search" style="width: 3vw; height: 3vw; margin: 0px;"></a>
        </nav>
        <button id="profile-button" onclick="window.location.href='../Account/AccountProfile.html'"><img id="profile-icon" src="../Account/AccountAssets/account.png" alt="Profile Icon"></button>
    </div>

    <main style="margin: 7vw 7vw;">
        <div style="display: flex;">
            <div class="book">
                <div class="book-image">
                    <a href="../thao luan va chi tiet.html"><img src="../assets/book3.jpg" alt="book1" style="width: auto;height: 30vw;"></a>
                </div>

                <div style="text-align: center;">
                    <a href="#" style="text-decoration: none;"><h3 style="background-color: #F08A5D; padding: 1vw; color: #ffffff;border-radius: 2vw;">Mua ngay</h3></a>
                    <a href="#" style="text-decoration: none;"><h3 style="border: 0.3vw solid #F08A5D;padding: 1vw;border-radius: 2vw;color: #F08A5D;">Thêm vào giỏ hàng</h3></a>
                </div>

            </div>

            <div class="disucss" style="margin-left: 8vw;margin-top: -2vw;">
                <h1 style="font-weight: 800;margin-bottom: -1vw;">Thảo luận và đánh giá</h1>
                <h1 style="font-weight: 300;"><i>Cho tôi xin một vé đi tuổi thơ</i></h1>
                <h3 style="font-weight: 500; margin-top: -1vw;">Tác giả: Nguyễn Nhật Ánh</h3>
                <div class="rating">
                    <div style="display: flex;">
                        <h3 style="font-weight: 500;margin-right: 2vw;">Đánh giá:</h3><h4 style="font-weight: 200;"><i>(100 lượt đánh giá, 100 bàn luận)</i></h4>
                    </div>
                    <div class="star" style="margin-top: -7vw;display: flex;">
                        <div><img src="./d_assets/stars.png" alt="star" style="width: auto;height: 16vw;"></div>
                        <div><h1 style="margin-top: 7vw;padding-left: 1vw;">5.00/5.00</h1></div>
                    </div>
                </div>

                <div id="searchcmt" style="display: flex;">
                    <form>
                        <input type="search" id="searchInput" placeholder="Tìm kiếm bình luận" style="outline: none;width: 30vw;height: 3vw;border: 0.2vw solid #F08A5D;border-radius: 2vw;padding: 1vw;">
                        <button type="submit" style="background-color: #F08A5D; padding: 0.75rem 2rem; font-family: 'MavenPro'; color: #ffffff;cursor:pointer;border:none;border-radius:2rem">Tìm kiếm</button>
                    </form>
                </div>

                <p><i>Kết quả tìm kiếm</i></p>
                <div id="searchResults"></div>
                <div style='width: 48vw; height: 0.75vw; background-color: #F08A5D;margin-bottom: 1vw;'></div>
                <p><i>Tất cả đánh giá</i></p>
                <br/>

                <div id="cmts">
                    <?php
                            $sql = "SELECT ratings.*, userprofiles.full_name
                            FROM ratings 
                            INNER JOIN userprofiles ON ratings.user_id = userprofiles.user_id 
                            LIMIT 2";
                        $result = mysqli_query($conn, $sql);
                        if (mysqli_num_rows($result) > 0) {
                            while ($row = mysqli_fetch_assoc($result)) {
                                echo "<div>";
                                echo "<img src='".'./d_assets/user.png'."' alt='User Image' style='width: 50px; height: 50px; border-radius: 50%; margin-right: 10px;'>";
                                echo "<p style='font-weight:800;font-size:1.5rem'>".$row['full_name']."</p>";
                                echo "<p><i>Rating: ".$row['rating'].'/5.00'."</i></p>";
                                echo "<p>Review: ".$row['review']."</p>";
                                echo "</div>";
                                echo "<div style='width: 48vw; height: 0.1vw; background-color: #F08A5D;margin-bottom: 1vw;'></div>";
                            }
                        } else {
                                echo "Không có bình luận nào.";
                        }
                    ?>
                </div>

                <button id="loadBtn" style="background-color: #F08A5D; padding: 0.75rem 2rem; font-family: 'MavenPro'; color: #ffffff;
                border-radius: 2rem;border: none; font-size: 1rem; font-weight: 500; margin-left: 18rem;cursor: pointer;">
                    Xem thêm
                </button>

            </div>
        </div>
    </main>

    <footer>
        <div class="footer-content">
            <p style="font-size: 1vw;">&copy; 2024 BookHub. All rights reserved.</p>
            <p style="font-size:2vw;font-weight:700;margin-bottom:1.1vw;">VỀ BOOKHUB</p>
            <div style="width: 100%; height: 0.1vw; background-color: #ffffff;margin-bottom: 1vw;"></div>
            <p style="font-size:1vw ; font-weight: 500;margin-bottom: 1vw;">BookHub là nền tảng kết nối những người
            <br/>có niềm yêu thích sách lại với nhau.</p>
            <a href="https://facebook.com" target="_blank" style="margin-right: 1vw;"><img src="../assets/facebook.png" alt="facebook" style="height: auto;width: 3vw;"></a>
            <a href="https://instagram.com" target="_blank"><img src="../assets/instagram.png" alt="instagram" style="height: auto;width: 3vw;"></a>
        </div>
        <div class="link_contact">
            <p style="font-size:2vw;font-weight:700;margin-bottom:1vw ;">ĐƯỜNG DẪN</p>
            <div style="width: 100%; height: 0.1vw; background-color: #ffffff;margin-bottom: 0vw;"></div>
            <ul style="list-style-type: none; font-size: 1.5vw;text-align: center;padding-left: 0;font-weight: 500;">
                <li style="margin-bottom: 0.7vw;"><a href="../Bookhub.html" style="color: white; text-decoration: none;" class="myLink">Bookstore</a></li>
                <li style="margin-bottom: 0.7vw;"><a href="../Bookhub.html" style="color: white; text-decoration: none;" class="myLink">Thể loại</a></li>
                <li style="margin-bottom: 0.7vw;"><a href="../Bookhub.html" style="color: white; text-decoration: none;" class="myLink">Thảo luận</a></li>
                <li style="margin-bottom: 0.7vw;"><a href="../signin/signin.html" style="color: white; text-decoration: none;" class="myLink">Đăng nhập</a></li>
            </ul>
        </div>
        <div class="contact" style="display:block">
            <p style="font-size:2vw;font-weight:700;margin-bottom:1vw;">LIÊN HỆ</p>
            <div style="width: 100%; height: 0.1vw; background-color: #ffffff;margin-bottom: 1vw;"></div>
            <table>
                <tr>
                    <td style="padding-right: 1vw;"><img src="../assets/phone-call.png" alt="phone" style="height: auto;width: 2vw;"></td>
                    <td style="font-size: 1.5vw;font-weight: 500;vertical-align: middle;">016.161.6161</td>
                </tr>
                <tr>
                    <td style="padding-right: 1vw;"><img src="../assets/email.png" alt="mail" style="height: auto;width: 2vw;"></td>
                    <td style="font-size: 1.5vw;font-weight: 500;vertical-align: middle;"><a alt="mail" href="https://gmail.com" target="_blank" 
                        style="text-decoration: none;color: #ffffff;">group16@gmail.com</td>
            </table>
        </div>
    </footer>
</body>