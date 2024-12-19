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

// Xử lý tìm kiếm nếu có dữ liệu được gửi lên
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["q"])) {
    $tuKhoa = $_GET["q"];

    // Truy vấn SQL để tìm kiếm sản phẩm theo tên hoặc mô tả
    $sql_timkiem = "SELECT * FROM sanpham WHERE ten LIKE '%$tuKhoa%' OR mota LIKE '%$tuKhoa%'";
    $result_timkiem = $conn->query($sql_timkiem); // Sửa lỗi chính tả ở đây
}
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
    <div id="carouselExampleInterval" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active" data-bs-interval="10000">
                <img src="image/banner 1.jpg" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item" data-bs-interval="2000">
                <img src="image/banner 2.jpg" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
                <img src="image/banner 3.jpg" class="d-block w-100" alt="...">
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleInterval" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleInterval" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>


    <?php if (isset($result_timkiem)): ?>
        <div class="container mt-5"> 
            <h2>Kết quả tìm kiếm cho "<?php echo $tuKhoa; ?>"</h2>
            <?php if ($result_timkiem->num_rows > 0): ?>
                <div class="row">
                    <?php while($row_sanpham = $result_timkiem->fetch_assoc()): ?>
                        <div class="col-sm-6 col-md-4 col-lg-3 mb-4">
                            <div class="card">
                                <?php
                                // Tạo liên kết đến trang chi tiết sản phẩm, 
                                // sử dụng switch case để xử lý tên file và loại bỏ khoảng trắng
                                $ten_file = "";
                                switch ($row_sanpham["ten"]) { // Dựa trên tên sản phẩm
                                    case "Cá Neon":
                                        $ten_file = "caneon"; 
                                        break;
                                    case "Cá Neon Hoàng Đế":
                                        $ten_file = "caneon_hoangde";
                                        break;
                                    case "Cá Koi Nhật Bản":
                                        $ten_file = "cakoi_nhatban";
                                        break;
                                    // ... các trường hợp khác cho các sản phẩm khác
                                    default:
                                        $ten_file = strtolower(str_replace(' ', '', $row_sanpham["ten"]));
                                        break;
                                }
                                ?>
                                <a href='product_detail.php?id=<?php echo $row_sanpham["id"]; ?>'> 
                                    <?php if (!empty($row_sanpham["hinhanh"])): ?>
                                        <img src='<?php echo $row_sanpham["hinhanh"]; ?>' alt='<?php echo $row_sanpham["ten"]; ?>' class='w-100 imgcrop'>
                                    <?php endif; ?>
                                    <div class='card-body'>
                                        <h5 class='card-title'><?php echo $row_sanpham["ten"]; ?></h5>
                                        <p class='card-text'><?php echo $row_sanpham["mota_ngan"]; ?></p>
                                        <p class='card-text text-danger fw-bold'><?php echo number_format($row_sanpham["gia"], 0, ',', '.') . "₫"; ?></p>
                                        <p class='card-text'>Số lượng: <?php echo $row_sanpham["soluong"]; ?></p>
                                        <?php if ($row_sanpham["soluong"] > 0): ?>
                                            <p class='card-text text-success'>Còn hàng</p>
                                        <?php else: ?>
                                            <p class='card-text text-danger'>Hết hàng</p>
                                        <?php endif; ?>
                                        <a href='product_detail.php?id=<?php echo $row_sanpham["id"]; ?>' class='btn btn-primary'>Xem chi tiết</a>
                                    </div>
                                </a>
                            </div>
                        </div>
                    <?php endwhile; ?>
                </div>
            <?php else: ?>
                <p>Không tìm thấy sản phẩm nào.</p>
            <?php endif; ?>
        </div> 
    <?php endif; ?>


    <div class="container mt-5">
        <?php
        // Lấy danh sách loại sản phẩm (từ trường loai)
        $sql_loai = "SELECT DISTINCT loai FROM sanpham"; 
        $result_loai = $conn->query($sql_loai);

        // Kiểm tra kết quả
        if ($result_loai->num_rows > 0) {
            // Lặp qua từng loại sản phẩm
            while($row_loai = $result_loai->fetch_assoc()) {
                $ten_loai = $row_loai["loai"]; 
                // Loại bỏ khoảng trắng và chuyển thành chữ thường để tạo id
                $id_loai = strtolower(str_replace(' ', '', $ten_loai)); 

                // Lấy danh sách sản phẩm thuộc loại này
                $sql_sanpham = "SELECT * FROM sanpham WHERE loai = '$ten_loai'";
                $result_sanpham = $conn->query($sql_sanpham);

                // Hiển thị tiêu đề loại sản phẩm với id tương ứng
                echo "<h2 id='$id_loai' class='ten-loai'>$ten_loai</h2>"; 

                // Hiển thị danh sách sản phẩm
                if ($result_sanpham->num_rows > 0) {
                    echo "<div class='row'>";
                    while($row_sanpham = $result_sanpham->fetch_assoc()) {
                        // Hiển thị mỗi sản phẩm
                        echo "<div class='col-sm-6 col-md-4 col-lg-3 mb-4'>";
                        echo "<div class='card'>";

                        // Tạo liên kết đến trang chi tiết sản phẩm, 
                        // sử dụng switch case để xử lý tên file và loại bỏ khoảng trắng
                        $ten_file = "";
                        switch ($row_sanpham["ten"]) { // Dựa trên tên sản phẩm
                            case "Cá Neon":
                                $ten_file = "caneon"; 
                                break;
                            case "Cá Neon Hoàng Đế":
                                $ten_file = "caneon_hoangde";
                                break;
                            case "Cá Koi Nhật Bản":
                                $ten_file = "cakoi_nhatban";
                                break;
                            // ... các trường hợp khác cho các sản phẩm khác
                            default:
                                $ten_file = strtolower(str_replace(' ', '', $row_sanpham["ten"]));
                                break;
                        }

                        echo "<a href='product_detail.php?id=" . $row_sanpham["id"] . "'>"; 

                        if (!empty($row_sanpham["hinhanh"])) {
                            echo "<img src='" . $row_sanpham["hinhanh"] . "' alt='" . $row_sanpham["ten"] . "' class='w-100 imgcrop'>";
                        }
                        echo "<div class='card-body'>";
                        echo "<h5 class='card-title'>" . $row_sanpham["ten"] . "</h5>";

                        // Thêm mô tả sản phẩm (sử dụng trường "mota" hoặc "mota_ngan")
                        echo "<p class='card-text'>" . $row_sanpham["mota_ngan"] . "</p>"; 

                        // Thêm giá tiền
                        echo "<p class='card-text text-danger fw-bold'>" . number_format($row_sanpham["gia"], 0, ',', '.') . "₫</p>";

                        // Hiển thị số lượng
                        echo "<p class='card-text'>Số lượng: " . $row_sanpham["soluong"] . "</p>";

                        // Hiển thị trạng thái còn hàng/hết hàng
                        if ($row_sanpham["soluong"] > 0) {
                            echo "<p class='card-text text-success'>Còn hàng</p>";
                        } else {
                            echo "<p class='card-text text-danger'>Hết hàng</p>";
                        }

                        echo "<a href='product_detail.php?id=" . $row_sanpham["id"] . "' class='btn btn-primary'>Xem chi tiết</a>"; 

                        echo "</div>";
                        echo "</a>"; // Đóng thẻ </a>
                        echo "</div>";
                        echo "</div>";
                    }
                    echo "</div>";
                    echo "<a href='#' class='xem-tat-ca'>Xem tất cả ></a>"; 
                } else {
                    echo "<p>Chưa có sản phẩm nào trong loại này.</p>";
                }
            }
        } else {
            echo "Không có loại sản phẩm nào.";
        }
        ?>
    </div>


    <section class="featured-blog-post">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <img src="image/deep-wonder-fish-header-2064-1024x300.jpg-nggid041064-ngg0dyn-1280x385x100-00f0w010c010r110f110r010t010.jpg" class="card-img-top" alt="Blog Post Image">
                        <div class="card-body">
                            <h2 class="card-title">Blog Cá Cảnh</h2>
                            <a><p class="card-text">LDFISHSTORE -  Nơi Bạn Có Thể Tìm Thấy Những Loại Cá Cảnh Đẹp, Dễ Nuôi Với Giá Rẻ</p> 
                            <p>
                                LDFISHSTORE  
                            </p></a>
                            <a href="blog.php" class="btn btn-primary">Chi Tiết</a>
                        </div>
                    </div>
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

</body>
</html>