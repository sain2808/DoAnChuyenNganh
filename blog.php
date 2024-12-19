<?php
$servername = "localhost";
$username = "root"; // Thay bằng tên đăng nhập MySQL của bạn
$password = ""; // Thay bằng mật khẩu MySQL của bạn
$dbname = "doan"; // Thay bằng tên cơ sở dữ liệu của bạn

// Tạo kết nối
$conn = new mysqli($servername, $username, $password, $dbname);

// Kiểm tra kết nối
if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" 
 href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>   

    <link href="https://fonts.googleapis.com/css2?family=Host+Grotesk:ital,wght@0,300..800;1,300..800&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900&display=swap" rel="stylesheet">
    <title>LDFISHSTORE</title>
    <link rel="stylesheet" href="style.css">
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
                        <a class="nav-link dropdown-toggle" href="#"id="productDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
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
                    <span class="badge">0</span> </a>

                <a href="login.php" class="btn-user">
                    <i class="fa-solid fa-user"></i>
                </a>

            </div>
        </div>
    </nav>
    <h1>--- Blog LDFISHSTORE ---</h1>
    
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <article class="blog-post">
                    <a href="blog.php"> 
                        <img src="image/blog-1.png" alt="Hình ảnh 1">
                    </a>
                    <h2><a href="blog.php">Tuyển dụng Nhân viên kinh doanh</a></h2>
                    <p><p>
**Quyền lợi:**<br>
- Thu nhập trung bình từ 10 - 20 triệu theo năng lực (chính sách lương rõ ràng bao gồm: lương cứng, lương hoàn thành KPI, thưởng KPI)<br>
- Được hưởng lương tháng 13 theo kết quả công việc<br>
- Hưởng đầy đủ chế độ nghỉ lễ, nghỉ tết<br>
- Làm việc trong môi trường trẻ trung, năng động, thân thiện<br>
- Tham gia các buổi party và du lịch của công ty, đãi ngộ cho người thân du lịch hàng năm<br>
- Hưởng đầy đủ chế độ BHXH, BHYT, BHTN theo đúng quy định của nhà nước<br>
- Nhân viên có thâm niên từ 1 năm trở lên sẽ có thêm bảo hiểm Tai nạn và Sức khỏe 24/7<br>
- Thưởng thâm niên cho những nhân viên gắn bó<br>
<br>
**Yêu cầu:**<br>
- Ưu tiên có kinh nghiệm Tư vấn, CSKH, Sales …<br>
- Có kinh nghiệm về phần mềm là một lợi thế.<br>
- Có khả năng giao tiếp, khả năng thuyết phục<br>
- Tính cách cá nhân mạnh mẽ, năng động, nhiệt huyết, có định hướng đạt mục tiêu, chủ động, tích cực<br>
- Khả năng làm việc dưới áp lực, thích nghi và phát triển trong môi trường di chuyển nhanh<br>
<br>
**Mô tả công việc:**<br>
- Chủ động tìm kiếm, giới thiệu, tư vấn, thuyết phục khách hàng sử dụng sản phẩm của công ty<br>
- Phát triển doanh thu đến từ những khách hàng hiện có của công ty theo dự án công ty<br>
- Tư vấn sản phẩm, dịch vụ công ty dựa trên nhu cầu khách hàng<br>
- Phân tích nhu cầu, đề xuất giải pháp nâng cao doanh thu cho công ty<br>
- Sử dụng linh hoạt các công cụ & phối hợp với các phòng ban để giải quyết các vấn đề từ khách hàng một cách kịp thời & chuyên nghiệp.<br>
- Thực hiện các công việc khác theo chỉ đạo của Quản lý trực tiếp.<br>
</p> </p>
                   
                </article>
            </div>
            <div class="col-md-4">
                <article class="blog-post">
                    <a href="blog.php"> 
                        <img src="image/blog-2.jpg" alt="Hình ảnh 2">
                    </a>
                    <h2><a href="blog.php">Có nên mở cửa hàng kinh doanh cá cảnh?</a></h2>
                    <p>Cùng với sự phát triển mạnh mẽ của nền kinh tế cũng như mức thu nhập của người dân ngày càng cao thì nhu cầu mua cá cảnh trang trí cho không gian nhà ngày càng trở nên phổ biến. Nhờ vào công nghệ hiện đại, có nhiều loại cá với màu sắc độc đáo được lai tạo khiến cho việc nuôi và sưu tầm cá cảnh ngày càng trở nên thu hút hơn. Có thể nói, thị trường kinh doanh cá cảnh đang ngày càng trở nên màu mỡ và mang lại nhiều tiềm năng thu về lợi nhuận cao. </p>
                    
                </article>
            </div>
            <div class="col-md-4">
                <article class="blog-post">
                    <a href="blog.php"> 
                        <img src="image/blog-3.jpg" alt="Hình ảnh 3">
                    </a>
                    <h2><a href="blog.php">Kinh doanh cá cảnh cần bao nhiêu vốn?</a></h2>
                    <p>Vốn mở cửa hàng kinh doanh cá cảnh là bao nhiêu? Để xác định cụ thể được số vốn thì sẽ còn tùy thuộc vào khả năng, điều kiện tài chính của từng người. Bởi khi đăng ký kinh doanh thì pháp luật không có quy định về mức vốn tối đa hay tối thiểu cần có. Nhưng thông thường thì bạn sẽ cần có tối thiểu 50 - 100 triệu đồng thì mới có thể thuận lợi mở cửa hàng. </p>
                    
                </article>
            </div>
        </div>
    </div>

<br> </br
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

</body>
</html>