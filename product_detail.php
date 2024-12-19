<?php
// product_detail.php



include_once 'cart_process.php'; // Include file cart_process.php 

// Lấy ID sản phẩm từ URL
if (isset($_GET['id'])) {
    $product_id = $_GET['id'];
    $product = get_product($conn, $product_id); // Truyền $conn vào hàm

    if (!$product) {
        echo "Không tìm thấy sản phẩm.";
        exit;
    }
} else {
    echo "ID sản phẩm không hợp lệ.";
    exit;
}

// Lấy danh sách sản phẩm liên quan (ví dụ: cùng loại)
$loai_sanpham = $product['loai'];
$sql_related = "SELECT * FROM sanpham WHERE loai = '$loai_sanpham' AND id != $product_id LIMIT 4";
$result_related = $conn->query($sql_related);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Mô tả ngắn gọn về LDFISHSTORE"> 
    <meta name="keywords" content="cá cảnh, thủy sinh, bể cá, phụ kiện"> 
    <title>LDFISHSTORE</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Host+Grotesk:ital,wght@0,300..800;1,300..800&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css"> 
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous" defer></script> 
</head>
<body>
<div class="container-fluid p-3 marquee-container">
        <div class="marquee-text">LDFISHSTORE Mua Bán Cá Cảnh Uy Tín Số 1 Việt Nam </div>
    </div>

    <nav class="navbar navbar-expand-lg" id="navbar">
        <div class="container">
            <a class="navbar-brand" href="index.php" id="logo">
                <span>LD</span>FishStore
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mynavbar">
                <span class="fa-solid fa-bars"></span>
            </button>
            <div class="collapse navbar-collapse" id="mynavbar">
                <ul class="navbar-nav me-auto ">
                    <li class="nav-item">
                        <a class="nav-link" href="index.php">Trang Chủ</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="productDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Danh Sách Sản Phẩm
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="productDropdown">
                            <?php
                            // Truy vấn SQL để lấy danh sách DISTINCT các loại sản phẩm từ bảng sanpham
                            $sql_loai_sp = "SELECT DISTINCT loai FROM sanpham";
                            $result_loai_sp = $conn->query($sql_loai_sp);

                            // Kiểm tra xem có loại sản phẩm nào không
                            if ($result_loai_sp->num_rows > 0) {
                                // Lặp qua từng loại sản phẩm và tạo mục dropdown
                                while ($row_loai_sp = $result_loai_sp->fetch_assoc()) {
                                    $ten_loai = $row_loai_sp['loai'];
                                    // Loại bỏ khoảng trắng và chuyển thành chữ thường để tạo id
                                    $id_loai = strtolower(str_replace(' ', '', $ten_loai)); 
                                    echo '<li><a class="dropdown-item" href="#' . $id_loai . '">' . $ten_loai . '</a></li>';
                                }
                            } else {
                                // Hiển thị thông báo nếu không có loại sản phẩm nào
                                echo '<li><a class="dropdown-item" href="#">Chưa có loại sản phẩm nào</a></li>';
                            }
                            ?>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="blog.php">Blog</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="gioi-thieu.php">Giới thiệu</a>
                    </li>
                </ul>
                <form class="d-flex me-3" action="" method="GET"> 
                    <input class="form-control me-2" type="text" name="q" placeholder="Tìm Kiếm">
                    <button class="btn btn-primary" type="submit">
                        <i class="fa-solid fa-magnifying-glass"></i>
                    </button>
                </form>
                <a href="cart.php" class="btn-cart">
                    <i class="fa-solid fa-cart-shopping"></i>
                    <span class="cart-count">0</span> 
                </a>

                <a href="login.php" class="btn-user">
                    <i class="fa-solid fa-user"></i>
                </a>
            </div>
        </div>
    </nav>


    <div class="container product-detail-container">
        <div class="row">
            <div class="col-md-6">
                <img src="<?php echo $product['hinhanh']; ?>" alt="<?php echo $product['ten']; ?>" class="product-image">
            </div>
            <div class="col-md-6 product-info">
                <h1 class="product-title"><?php echo $product['ten']; ?></h1>
                <p class="product-price"><?php echo number_format($product['gia'], 0, ',', '.') . '₫'; ?></p>

                <div class="product-description">
                    <?php echo $product['mota']; ?>
                </div>

                <div class="quantity">
                    <button type="button" class="btn btn-secondary" onclick="decreaseQuantity()">-</button>
                    <input type="number" id="quantity" value="1" min="1">
                    <button type="button" class="btn btn-secondary" onclick="increaseQuantity()">+</button>
                </div>

                <button type="button" class="btn btn-primary add-to-cart" data-product-id="<?php echo $product['id']; ?>">Thêm vào giỏ hàng</button>
                
                <div id="message"></div>
            </div>
        </div>

        <div class="related-products mt-5">
            <h2>Sản phẩm liên quan</h2>
            <div class="row">
                <?php
                if ($result_related->num_rows > 0) {
                    while($row_related = $result_related->fetch_assoc()) {
                        // Hiển thị mỗi sản phẩm liên quan
                        echo "<div class='col-md-3'>";
                        echo "<div class='card'>";
                        echo "<a href='product_detail.php?id=" . $row_related["id"] . "'>";
                        if (!empty($row_related["hinhanh"])) {
                            echo "<img src='" . $row_related["hinhanh"] . "' alt='" . $row_related["ten"] . "' class='card-img-top'>";
                        }
                        echo "<div class='card-body'>";
                        echo "<h5 class='card-title'>" . $row_related["ten"] . "</h5>";
                        echo "<p class='card-text'>" . number_format($row_related["gia"], 0, ',', '.') . "₫</p>";
                        echo "</div>";
                        echo "</a>";
                        echo "</div>";
                        echo "</div>";
                    }
                } else {
                    echo "<p>Chưa có sản phẩm liên quan.</p>";
                }
                ?>
            </div>
        </div>

    </div>

    <script>
        function decreaseQuantity() {
            var quantityInput = document.getElementById('quantity');
            var quantity = parseInt(quantityInput.value);
            if (quantity > 1) {
                quantityInput.value = quantity - 1;
            }
        }

        function increaseQuantity() {
            var quantityInput = document.getElementById('quantity');
            var quantity = parseInt(quantityInput.value);
            quantityInput.value = quantity + 1;
        }

        const addToCartButton = document.querySelector('.add-to-cart');

        addToCartButton.addEventListener('click', function() {
            const productId = this.dataset.productId;
            const quantity = document.getElementById('quantity').value;

            const xhr = new XMLHttpRequest();
            xhr.open('POST', 'cart_process.php', true); 
            xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
            xhr.onload = function() {
                if (this.status == 200) {
                    // Xử lý kết quả trả về từ server (ví dụ: hiển thị thông báo)
                    console.log(this.responseText); 
                    // Cập nhật số lượng trong icon giỏ hàng
                    updateCartCount(); 
                }
            }
            xhr.send('add_to_cart=1&product_id=' + productId + '&quantity=' + quantity);
        });

        // Hàm cập nhật số lượng sản phẩm trong icon giỏ hàng
        function updateCartCount() {
            // Gửi AJAX request đến server để lấy số lượng sản phẩm trong giỏ hàng
            const xhr = new XMLHttpRequest();
            xhr.open('GET', 'get_cart_count.php', true); 
            xhr.onload = function() {
                if (this.status == 200) {
                    // Cập nhật số lượng vào thẻ <span>
                    document.querySelector('.cart-count').textContent = this.responseText; 
                }
            }
            xhr.send();
        }
    </script>


    <section>
    <footer class="footer bg-white">
        <div class="mid-footer">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12 col-md-6 col-lg-4 footer-click">

                        <h4 class="title-menu clicked">
                            Về Chúng Tôi
                        </h4>
                        <a class="navbar-brand" href="index.php" id="logo">
                            <span>LD</span>FishStore
                        </a>

                        <p>
                            Shop cá cảnh Online LDFISHSTORE chuyên cung cấp các dòng cá cảnh thủy sinh, cá cảnh
                            nhập khẩu, các loại phụ kiện đặc biệt
                        </p>
                        <div class="single-contact">
                            <i class="fa fa-map-marker-alt"></i>
                            <div class="content">Địa chỉ:
                                <span>1040/26 ấp 3 Lê Văn Lương, xã Phước Kiển, huyện Nhà Bè, Tp.HCM</span>

                            </div>
                        </div>
                        <div class="single-contact">
                            <i class="fa fa-map-marker-alt"></i>
                            <div class="content">
                                Làm việc 24/7
                            </div>
                        </div>
                        <div class="single-contact">
                            <i class="fa fa-mobile-alt"></i>
                            <div class="content">
                                Liên hệ: <a class="link" title="0982083608" href="tel:0982083608">0982083608</a>
                            </div>
                        </div>

                        <div class="single-contact">
                            <i class="fa fa-envelope"></i>
                            <div class="content">
                                Email: <a title="ldfishstore@gmail.com" class="link"
                                          href="mailto:ldfishstore@gmail.com">ldfishstore@gmail.com</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-12 col-md-6 col-lg-2 footer-click">
                        <h4 class="title-menu clicked">
                            Hỗ Trợ Khách Hàng <i class="fa fa-angle-down d-md-none d-inline-block"></i>
                        </h4>
                        <ul class="list-menu toggle-mn">

                            <li class="li_menu">
                                <a class="link" href="#" title="Tra cứu đơn hàng">Tra cứu đơn hàng</a>
                            </li>

                            <li class="li_menu">
                                <a class="link" href="#" title="Liên hệ">Liên hệ</a>
                            </li>

                            <li class="li_menu">
                                <a class="link" href="#" title="Chính sách vận chuyển">Chính sách vận chuyển</a>
                            </li>

                        </ul>
                    </div>
                    <div class="col-xs-12 col-md-6 col-lg-3 footer-click">
                        <h4 class="title-menu clicked">
                            Tìm Hiểu Thêm <i class="fa fa-angle-down d-md-none d-inline-block"></i>
                        </h4>
                        <ul class="list-menu toggle-mn">

                            <li class="li_menu">
                                <a class="link" href="#" title="Giới thiệu">Giới thiệu</a>
                            </li>

                            <li class="li_menu">
                                <a class="link" href="#" title="Sản phẩm">Sản phẩm</a>
                            </li>

                            <li class="li_menu">
                                <a class="link" href="#" title="Một số thành tích của trại">Một số thành tích của
                                    trại</a>
                            </li>

                            <li class="li_menu">
                                <a class="link" href="#" title="Quy Mô Trang Trại">Quy Mô Trang Trại</a>
                            </li>

                            <li class="li_menu">
                                <a class="link" href="#" title="Thông Tin Chung">Thông Tin Chung</a>
                            </li>

                        </ul>
                    </div>
                    <div class="col-xs-12 col-md-6 col-lg-3 footer-click">

                        <div class="social-footer">
                            <h4 class="title-menu">
                                Theo Dõi LDFISHSTORE Tại
                            </h4>
                            <div id="fb-root"></div>
                            <script async defer crossorigin="anonymous"
                                    src="https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v18.0"
                                    nonce="NRJWlcia"></script>
                            <div class="fb-page" data-href="https://www.facebook.com/datdom2808/" data-tabs=""
                                 data-width="" data-height="" data-small-header="false"
                                 data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true">
                                <blockquote cite="https://www.facebook.com/Cacanhthienduc/"
                                            class="fb-xfbml-parse-ignore"><a
                                          href="https://www.facebook.com/Cacanhthienduc/">Trại Cá Cảnh Thiên
                                    Đức</a></blockquote>
                            </div>

                            <div class="div-social">
                                <a href="https://www.facebook.com/datdom2808/" title="Facebook" target="_blank"
                                   rel="nofollow">
                                    <img width="35" height="35" alt="social"
                                         src="//bizweb.dktcdn.net/100/441/675/themes/925183/assets/icon_face.png?1730953248684"/>
                                </a>
                                <a href="https://www.youtube.com/c/%C4%90%E1%BA%A1ih%E1%BB%8DcC%C3%B4ngNgh%E1%BB%87S%C3%A0iG%C3%B2nSTU"
                                   title="Youtube" target="_blank" rel="nofollow">
                                    <img width="35" height="35" alt="social"
                                         src="//bizweb.dktcdn.net/100/441/675/themes/925183/assets/icon_you.png?1730953248684"/>
                                </a>

                                <a href="#" title="Tiktok" target="_blank" rel="nofollow">
                                    <img width="35" height="35" alt="social"
                                         src="//bizweb.dktcdn.net/100/441/675/themes/925183/assets/icon_tik_tok.png?1730953248684"/>
                                </a>
                                <a href="#" title="Instagram" target="_blank" rel="nofollow">
                                    <img width="35" height="35" alt="social"
                                         src="//bizweb.dktcdn.net/100/441/675/themes/925183/assets/icon_instar_color.png?1730953"/>
                                </a>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    </section>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <?php
    // Đóng kết nối CSDL
    $conn->close(); 
    ?>
</body>
</html>