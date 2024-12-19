<?php
// cart.php

include_once 'cart_process.php'; 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Host+Grotesk:ital,wght@0,300..800;1,300..800&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900&display=swap" rel="stylesheet">
    <title>Giỏ hàng</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

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
                                    // Loại bỏ khoảng trắng và chuyển thành chữ thường
                                    $ten_file = strtolower(str_replace(' ', '', $ten_loai)); 
                                    echo '<li><a class="dropdown-item" href="' . $ten_file . '.php">' . $ten_loai . '</a></li>';
                                }
                            } else {
                                // Hiển thị thông báo nếu không có loại sản phẩm nào
                                echo '<li><a class="dropdown-item" href="#">Chưa có loại sản phẩm nào</a></li>';
                            }
                            ?>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Mẫu Hồ Cá</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="blog.php">Blog</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="gioi-thieu.php">Giới thiệu</a>
                    </li>
                </ul>
                <form class="d-flex me-3">
                    <input class="form-control me-2" type="text" placeholder="Tìm Kiếm">
                    <button class="btn btn-primary" type="button">
                        <i class="fa-solid fa-magnifying-glass"></i>
                    </button>
                </form>
                <a href="cart.php" class="btn-cart">
                    <i class="fa-solid fa-cart-shopping"></i>
                    <span class="cart-count">
                        <?php 
                        // Hiển thị số lượng sản phẩm trong giỏ hàng
                        $cartCount = 0;
                        if (isset($_SESSION['cart'])) {
                            foreach ($_SESSION['cart'] as $item) {
                                $cartCount += $item['quantity'];
                            }
                        }
                        echo $cartCount; 
                        ?>
                    </span> 
                </a>

                <a href="login.php" class="btn-user">
                    <i class="fa-solid fa-user"></i>
                </a>

            </div>
        </div>
    </nav>

    <div class="container cart-container">
        <div class="cart-header">
            <h1>Giỏ hàng</h1>
        </div>

        <?php if (empty($_SESSION['cart'])): ?>
            <p>Giỏ hàng của bạn đang trống.</p>
        <?php else: ?>
            <form method="post" action="cart.php">
                <table class="cart-table">
                    <thead>
                    <tr>
                        <th>Sản phẩm</th>
                        <th>Giá</th>
                        <th>Số lượng</th>
                        <th>Thành tiền</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php 
                    $total = 0;
                    foreach ($_SESSION['cart'] as $item): 
                        $total += $item['gia'] * $item['quantity'];
                    ?>
                        <tr>
                            <td>
                                <img src="<?= $item['hinhanh'] ?>" alt="<?= $item['ten'] ?>" width="50">
                                <span class="cart-item-name"><?= $item['ten'] ?></span>
                            </td>
                            <td class="cart-item-price"><?= number_format($item['gia'], 0, ',', '.') ?>₫</td>
                            <td>
                                <input type="number" name="quantity[<?= $item['id'] ?>]" value="<?= $item['quantity'] ?>" min="1">
                            </td>
                            <td class="cart-item-total"><?= number_format($item['gia'] * $item['quantity'], 0, ',', '.') ?>₫</td>
                            <td class="cart-item-remove">
                                <a href="cart.php?remove=1&product_id=<?= $item['id'] ?>" class="btn btn-danger btn-sm">Xóa</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
                <button type="submit" class="btn btn-primary" name="update_cart">Cập nhật giỏ hàng</button>
            </form>

            <div class="cart-total">
                Tổng tiền: 
                <?php
                echo number_format($total, 0, ',', '.') . '₫';
                ?>
            </div>

            <a href="checkout.php" class="btn btn-success checkout-button">Tiến hành thanh toán</a>
        <?php endif; ?>
    </div>

    <section>
        <<footer class="footer bg-white">
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
    </footer>>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>