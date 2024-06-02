
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
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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
                <p class="title">Đơn hàng của bạn</p>
                <div style="background-color: #d9d9d9; width: 100%; height: 1px; margin: 5px 0 0 0; padding: 0;"></div>
            </div>

            <!-- Start of My Books -->
            <div class="main">
                <p class="header">Tất cả đơn hàng của bạn</p>
                <div style="background-color: #d9d9d9; width: 100%; height: 1px; margin: 5px 0 5px 0; padding: 0;"></div>
                <div class="list-row">
                    <div class="id_col">
                        <p class="list-header">ID</p>
                    </div>
                    <div class="date_col">
                        <p class="list-header">Ngày đặt hàng</p>
                    </div>
                    <div class="total_col">
                        <p class="list-header">Tổng tiền</p>
                    </div>
                    <div class="status_col">
                        <p class="list-header">Trạng thái</p>
                    </div>
                </div>
                <div style="background-color: #d9d9d9; width: 100%; height: 1px; margin: 5px 0 5px 0; padding: 0;"></div>
                <div id="orderList">
                    <!-- Orders list will appear hear -->
                </div>
                <script>
                    $(document).ready(function() {
                        loadOrders();

                        function loadOrders() {
                            $.ajax({
                                url: './php/load_orders.php',
                                type: 'GET',
                                success: function(response) {
                                    if (response.status === 'success') {
                                        updateOrderList(response.orders);
                                    } else {
                                        alert(response.message);
                                    }
                                }
                            });
                        }
                        
                        function updateOrderList(orders) {
                            $('#orderList').empty();
                            if (orders.length > 0) {
                                $.each(orders, function(index, order) {
                                    var orderHtml = '<div class="list-row order" data-order-id="' + order.order_id + '">';
                                    orderHtml += '<div class="id_col"><p class="list-item">' + order.order_id + '</p></div>';
                                    orderHtml += '<div class="date_col"><p class="list-item">' + order.order_date + '</p></div>';
                                    orderHtml += '<div class="total_col"><p class="list-item">' + order.sum_price + '</p></div>';
                                    orderHtml += '<div class="status_col"><p class="list-item">' + order.order_status + '</p></div>';
                                    orderHtml += '</div>';
                                    orderHtml += '<div class="order-details"></div>';
                                    orderHtml += '<div style="background-color: #d9d9d9; width: 100%; height: 1px; margin: 5px 0 5px 0; padding: 0;"></div>';
                                    $('#orderList').append(orderHtml);
                                });
                            } else {
                                $('#orderList').append('<p>Không có đơn hàng nào.</p>');
                            }
                        }
                    });

                    function loadOrderDetails(orderId, orderElement) {
                        $.ajax({
                            url: './php/get_order_details.php',
                            type: 'GET',
                            data: { order_id: orderId },
                            success: function(response) {
                                if (response.status === 'success') {
                                    updateOrderDetails(response.order_details, orderElement);
                                } else {
                                    alert(response.message);
                                }
                            }
                        });
                    }

                    function updateOrderDetails(details, orderElement) {
                        var detailsContent = '';
                        $.each(details, function(index, detail) {
                            detailsContent += '<div class="list-row"><img src="../../admin/uploads/' + detail.cover_image + '" alt="Cover Image" width="50px"><p class="bullet">' + detail.book_id + '<p class="bullet">' + detail.quantity + '<p class="bullet">' + detail.price + '</p></div>';
                        });
                        orderElement.find('.order-details').html(detailsContent).slideDown();
                    }

                    $('#orderList').on('click', '.order', function() {
                        var orderId = $(this).data('order-id');
                        var orderElement = $(this);
                        if (orderElement.find('.order-details').is(':visible')) {
                            orderElement.find('.order-details').slideUp();
                        } else {
                            loadOrderDetails(orderId, orderElement);
                        }
                    });
                </script>

            </div>

            <div class="gray-bar">
                <div class="pretty-box">
                    <p class="header-box">Mục đã lưu</p>
                    <p class="properties">Hãy tập hợp và lưu lại các sản phẩm bạn quan tâm.</p>
                    <br>
                    <a href="./saves.php" class="box-link">Xem sản phẩm đã lưu ></a>
                </div>
                <div class="pretty-box">
                    <p class="header-box">Tài khoản của bạn</p>
                    <p class="properties">Xem sản phẩm bạn đã mua, tuỳ chỉnh cài đặt tài khoản.</p>
                    <br>
                    <a href="./profile.php" class="box-link">Xem tài khoản của bạn ></a>
                </div>
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