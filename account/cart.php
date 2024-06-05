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
                <a class="globalnav-item" href="../aboutUs/aboutUs.php">Về chúng tôi</a>
                <a class="globalnav-item" href="../search/search.php">Tìm kiếm</a>
                <a class="globalnav-item-show" href="./orders.php">Đơn hàng</a>
                <a class="globalnav-item-show" href="./cart.php">Giỏ hàng</a>
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
                <li><img class="option-icons" src="../assets/saves.png"><a href="./cart.php">Giỏ hàng</a></li>
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

        

       <main>
            <div class="title-bar">
                <p class="title">Giỏ hàng của bạn</p>
            </div>

            <!-- Start of Saves -->
            <div class="main">
                <div class="saves-intro">
                    <p class="intro-header">Giỏ hàng</p>
                </div>
                <div class="saves-intro">
                    <img class="intro-icon" src="../assets/saves.png">
                </div>
                <div class="saves-intro">
                    <p class="intro-properties">Tiếp tục mua sắm những sản phẩm bạn đã lưu trước đó.</p>
                </div>
                <div style="background-color: #d9d9d9; width: 100%; height: 1px; margin: 5px 0 5px 0; padding: 0;"></div>
                
                <div id="myCart">
                    <!-- Cart items will be displayed here -->
                </div>

                <div id="summary">
                    <p class="header" style="text-align: center;">Tổng giá trị sản phẩm bạn đã chọn là <span id="grand-total">0</span>đ</p>
                    <p class="properties" style="text-align: center;">Vận chuyển miễn phí đối với mọi đơn hàng</p>
                    
                    <div class="pay">
                        <button id="checkout-button">Thanh toán</button>
                    </div>
                </div>

                <div id="payment" class="hidden">
                    <div style="display: block">
                        <p class="payment-header">Thanh toán</p>
                        <div id="paypal-button-container"></div>
                        <div class="cancel-label">Huỷ</div>
                    </div>
                </div>
                
                <script>
                    $(document).ready(function() {
                        loadCart();
                    });

                    function loadCart() {
                        $.ajax({
                            url: './php/load_cart.php',
                            type: 'GET',
                            dataType: 'json',
                            success: function(response) {
                                if (response.status === 'success') {
                                    updateCart(response.cart);
                                } else {
                                    alert(response.message);
                                }
                            },
                            error: function(xhr, status, error) {
                                console.log(xhr.responseText);
                                alert('Đã xảy ra lỗi, vui lòng thử lại sau.');
                            }
                        });
                    }

                    function updateCart(cart) {
                        $('#myCart').empty();
                        if (cart.length > 0) {
                            $.each(cart, function(index, item) {
                                let book = '';
                                book += '<div class="saved">';
                                    book += '<img class="scaled-book" src="../admin/uploads/' + item.cover_image + '" alt="Book Cover">';
                                    book += '<div class="book-info">';
                                        book += '<div class="book-row">';
                                            book += ' <p class="book-price">' + item.price + 'đ</p>';
                                            book += '<div class="quantity-selector">';
                                                book += '<button class="quantity-button" onclick="decreaseQuantity(this)">-</button>';
                                                book += '<input type="text" class="quantity" value="0" onchange="updateTotal()">';
                                                book += '<button class="quantity-button" onclick="increaseQuantity(this)">+</button>';
                                            book += '</div>';
                                        book += '</div>';
                                        book += '<div style="background-color: #d9d9d9; width: 100%; height: 1px; margin: 5px 0 5px 0; padding: 0;"></div>';
                                        book += '<div class="book-row">';
                                            book += '<div class="remove-button" onclick="removeFromCart(' + item.book_id + ')">Xoá</div>';
                                            book += '<div class="total">';
                                                book += '<p>Tổng:</p> <p><span class="total-price">0</span>đ</p>';
                                            book += '</div>';
                                        book += '</div>';
                                    book += '</div>';
                                book += '</div>';
                                book += '<div style="background-color: #d9d9d9; width: 100%; height: 1px; margin: 5px 0 5px 0; padding: 0;"></div>';
                                $('#myCart').append(book);
                            });
                            updateTotal();  // Update total after updating cart
                        } else {
                            $('#myCart').append('<p class="properties" style="text-align: center; color: orange">Không có sản phẩm nào trong giỏ hàng của bạn.</p>');
                            $('#summary').empty();
                        }
                    }

                    function removeFromCart(book_id) {
                        $.ajax({
                            url: './php/remove_from_cart.php',
                            type: 'POST',
                            data: { book_id: book_id },
                            dataType: 'json',
                            success: function(response) {
                                if (response.status === 'success') {
                                    loadCart();
                                } else {
                                    alert(response.message);
                                }
                            },
                            error: function(xhr, status, error) {
                                console.log(xhr.responseText);
                                alert('Đã xảy ra lỗi, vui lòng thử lại sau.');
                            }
                        });
                    }

                    function decreaseQuantity(button) {
                        const input = button.nextElementSibling;
                        let currentValue = parseInt(input.value);
                        if (currentValue > 0) {
                            input.value = currentValue - 1;
                            updateTotal();
                        }
                    }

                    function increaseQuantity(button) {
                        const input = button.previousElementSibling;
                        let currentValue = parseInt(input.value);
                        input.value = currentValue + 1;
                        updateTotal();
                    }

                    function updateTotal() {
                        const products = document.querySelectorAll('.book-info');
                        let grandTotal = 0;

                        products.forEach(product => {
                            const price = parseInt(product.querySelector('.book-price').textContent.replace('đ', ''));
                            const quantity = parseInt(product.querySelector('.quantity').value);
                            const total = price * quantity;

                            product.querySelector(".total-price").textContent = total;
                            grandTotal += total;
                        });

                        document.getElementById("grand-total").textContent = grandTotal;
                    }

                    function addToOrders(grand_total) {
                        const products = document.querySelectorAll('.book-info');
                        var orderdetails = [];

                        products.forEach(product => {
                            const book_id = parseInt(product.parentElement.querySelector('.remove-button').getAttribute('onclick').match(/\d+/)[0]);
                            const quantity = parseInt(product.querySelector('.quantity').value);
                            const price = parseInt(product.querySelector('.book-price').textContent.replace('đ', '').replace(',', ''));
                            if (quantity > 0) {
                                orderdetails.push({ book_id: book_id, quantity: quantity, price: price });
                            }
                        });

                        $.ajax({
                            url: './php/create_order.php',
                            type: 'POST',
                            data: JSON.stringify({ 
                                sum_price: grand_total,
                                orderdetails: orderdetails
                            }),
                            contentType: 'application/json; charset=utf-8',
                            dataType: 'json',
                            success: function(response) {
                                if (response.status === 'success') {
                                    alert('Đã thêm đơn hàng thành công!');
                                } else {
                                    alert(response.message);
                                }
                            },
                            error: function(xhr, status, error) {
                                console.log(xhr.responseText);
                                alert('Đã xảy ra lỗi, vui lòng thử lại sau.');
                            }
                        });
                    }

                    function showPayment() {
                        document.getElementById("blur-overlay").classList.remove("hidden");
                        document.getElementById("blur-overlay").classList.add("show");
                        document.getElementById("payment").classList.remove("hidden");
                        document.getElementById("payment").classList.add("show");
                    }

                    function hidePayment() {
                        document.getElementById("blur-overlay").classList.remove("show");
                        document.getElementById("blur-overlay").classList.add("hidden");
                        document.getElementById("payment").classList.remove("show");
                        document.getElementById("payment").classList.add("hidden");
                    }

                    function removePayPalButton() {
                        const paypalButtonContainer = document.getElementById("paypal-button-container");
                        while (paypalButtonContainer.firstChild) {
                            paypalButtonContainer.removeChild(paypalButtonContainer.firstChild);
                        }
                    }

                    document.getElementById("checkout-button").addEventListener("click", function() {
                        const grandTotalVND = parseFloat(document.getElementById("grand-total").textContent.replace('đ', ''));
                        const exchangeRate = 0.00004;
                        const grandTotalUSD = (grandTotalVND * exchangeRate).toFixed(2);

                        if (grandTotalVND > 0) {
                            if (document.getElementById("paypal-button-container").children.length === 0) {
                                showPayment();

                                paypal.Buttons({
                                    createOrder: function(data, actions) {
                                        return actions.order.create({
                                            purchase_units: [{
                                                amount: {
                                                    value: grandTotalUSD
                                                }
                                            }]
                                        });
                                    },
                                    onApprove: function(data, actions) {
                                        return actions.order.capture().then(function(details) {
                                            alert('Transaction completed by ' + details.payer.name.given_name + '!');
                                            addToOrders(grandTotalVND);
                                            hidePayment();
                                        });
                                    },
                                    onError: function(err) {
                                        alert('Đã xảy ra lỗi, vui lòng thử lại!');
                                    }
                                }).render('#paypal-button-container');
                            }
                        } else {
                            alert("Vui lòng chọn sản phẩm trước khi thanh toán.");
                        }
                    });

                    document.getElementById("blur-overlay").addEventListener("click", () => {
                        hidePayment();
                        removePayPalButton();
                    });
                    document.querySelector(".cancel-label").addEventListener("click", () => {
                        hidePayment();
                        removePayPalButton();
                    });

                </script>
            </div>
            <!-- End of Saves -->

            <div class="gray-bar">
                <div class="pretty-box">
                    <p class="header-box">Tài khoản của bạn</p>
                    <p class="properties">Xem sản phẩm bạn đã mua, tuỳ chỉnh cài đặt tài khoản.</p>
                    <br>
                    <a href="./profile.php" class="box-link">Xem tài khoản của bạn ></a>
                </div>
                <div class="pretty-box">
                    <p class="header-box">Đơn hàng</p>
                    <p class="properties">Theo dõi, chỉnh sửa hoặc huỷ đơn hàng.</p>
                    <br>
                    <a href="./order.php" class="box-link">Xem lịch sử mua hàng của bạn ></a>
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
                <li><a href="../aboutUs/aboutUs.php" class="myLink">Về chúng tôi</a></li>
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