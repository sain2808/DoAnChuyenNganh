<?php
$servername = "localhost";
$username = "root"; 
$password = ""; 
$dbname = "doan"; 

// Tạo kết nối
$conn = new mysqli($servername, $username, $password, $dbname);

// Kiểm tra kết nối
if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Mô tả ngắn gọn về LDFISHSTORE"> 
    <meta name="keywords" content="cá cảnh, thủy sinh, bể cá, phụ kiện"> 
    <title>Giới thiệu về LDFISHSTORE</title>
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
        <div class="marquee-text">LDFISHSTORE Mua Bán Cá Cảnh Tuy Tín Số 1 Việt Nam </div>
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
                <form class="d-flex me-3">
                    <input class="form-control me-2" type="text" placeholder="Tìm Kiếm">
                    <button class="btn btn-primary" type="button">
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
    <section class="gioi-thieu">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h1>Giới thiệu về LDFISHSTORE</h1>
                    <p>LDFISHSTORE là cửa hàng cá cảnh trực tuyến uy tín hàng đầu tại Việt Nam, chuyên cung cấp đa dạng các loại cá cảnh nước ngọt, cá cảnh biển, thủy sinh và phụ kiện. Với phương châm "Chất lượng là trên hết", chúng tôi cam kết mang đến cho khách hàng những sản phẩm chất lượng cao, dịch vụ tận tâm và giá cả cạnh tranh.</p>

                    <h2>Tầm nhìn</h2>
                    <p>Trở thành thương hiệu cá cảnh số 1 tại Việt Nam, được khách hàng tin yêu và lựa chọn.</p>

                    <h2>Sứ mệnh</h2>
                    <p>Mang đến cho khách hàng những trải nghiệm mua sắm cá cảnh tuyệt vời nhất, góp phần làm phong phú thêm đời sống tinh thần của cộng đồng yêu cá cảnh.</p>

                    <h2>Giá trị cốt lõi</h2>
                    <ul>
                        <li>Chất lượng: Cam kết cung cấp sản phẩm chất lượng cao, khỏe mạnh.</li>
                        <li>Uy tín: Luôn đặt chữ tín lên hàng đầu, đảm bảo sự hài lòng của khách hàng.</li>
                        <li>Tận tâm: Phục vụ khách hàng tận tình, chu đáo.</li>
                        <li>Cải tiến: Không ngừng học hỏi, cải tiến để mang đến những sản phẩm và dịch vụ tốt nhất.</li>
                    </ul>

                    <h2>Cam kết</h2>
                    <ul>
                        <li>Cung cấp cá cảnh khỏe mạnh, được kiểm dịch kỹ càng.</li>
                        <li>Đa dạng về chủng loại, đáp ứng nhu cầu của mọi khách hàng.</li>
                        <li>Giá cả cạnh tranh, nhiều chương trình khuyến mãi hấp dẫn.</li>
                        <li>Giao hàng nhanh chóng, an toàn.</li>
                        <li>Tư vấn tận tình, hỗ trợ khách hàng 24/7.</li>
                    </ul>

                    <p>Hãy đến với LDFISHSTORE để trải nghiệm thế giới cá cảnh đầy màu sắc và thú vị!</p>
                </div>
            </div>
        </div>
    </section>

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

    <?php 
    // Đóng kết nối CSDL 
    $conn->close(); 
    ?>
</body>

</html>