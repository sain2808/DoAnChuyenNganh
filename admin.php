<?php
session_start();

// Kiểm tra xem người dùng đã đăng nhập chưa và có phải admin không
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true || $_SESSION["role"] !== 'admin') {
    header("location: login.php");
    exit;
}

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

// Xử lý khi form thêm sản phẩm được submit
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["add_product"])) {
    // Lấy dữ liệu từ form 
    $ten = $_POST["ten"];
    $gia = $_POST["gia"];
    $mota = $_POST["mota"];
    $id_danhmuc = $_POST["id_danhmuc"];
    $soluong = $_POST["soluong"];
    $trangthai = $_POST["trangthai"];
    $loai = $_POST["loai"]; // Lấy loại sản phẩm từ dropdown

    // Xử lý upload hình ảnh
    $hinhanh = ""; // Khởi tạo biến $hinhanh
    $target_dir = "image/"; // Thư mục lưu trữ ảnh
    $target_file = $target_dir . basename($_FILES["hinhanh"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

    // Kiểm tra xem file có phải là ảnh không
    $check = getimagesize($_FILES["hinhanh"]["tmp_name"]);
    if($check !== false) {
        $uploadOk = 1;
    } else {
        $error_message = "File không phải là ảnh.";
        $uploadOk = 0;
    }

    // Kiểm tra dung lượng file (ví dụ: giới hạn 5MB)
    if ($_FILES["hinhanh"]["size"] > 5000000) {
        $error_message = "Dung lượng file quá lớn.";
        $uploadOk = 0;
    }

    // Cho phép một số định dạng ảnh
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
    && $imageFileType != "gif" ) {
        $error_message = "Chỉ cho phép các định dạng JPG, JPEG, PNG & GIF.";
        $uploadOk = 0;
    }

    // Kiểm tra nếu $uploadOk = 0 thì có lỗi
    if ($uploadOk == 0) {
        $error_message = "Upload ảnh thất bại.";
    } else {
        // Nếu mọi thứ ok, thử upload file
        if (move_uploaded_file($_FILES["hinhanh"]["tmp_name"], $target_file)) {
            // Lưu đường dẫn ảnh vào biến $hinhanh
            $hinhanh = $target_file; 
        } else {
            $error_message = "Đã xảy ra lỗi khi upload ảnh.";
        }
    }

    // Thêm sản phẩm vào CSDL (sử dụng prepared statements)
    $stmt = $conn->prepare("INSERT INTO sanpham (ten, gia, mota, hinhanh, id_danhmuc, soluong, trangthai, loai) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");

    if (!$stmt) {
        die("Lỗi prepare (INSERT): " . $conn->error);
    }

    $stmt->bind_param("sdssiiss", $ten, $gia, $mota, $hinhanh, $id_danhmuc, $soluong, $trangthai, $loai);

    if (!$stmt->execute()) {
        $error_message = "Lỗi: " . $stmt->error;
    } else {
        $success_message = "Thêm sản phẩm thành công!";
    }

    $stmt->close();
}

// Lấy danh sách sản phẩm từ CSDL (sử dụng prepared statements)
$stmt = $conn->prepare("SELECT * FROM sanpham");

if (!$stmt) {
    die("Lỗi prepare (SELECT): " . $conn->error);
}

if (!$stmt->execute()) {
    die("Lỗi execute (SELECT): " . $stmt->error);
}

$result = $stmt->get_result();
$stmt->close();

// Lấy danh sách danh mục từ CSDL (sử dụng prepared statements)
$stmt = $conn->prepare("SELECT * FROM danhmuc");

if (!$stmt) {
    die("Lỗi prepare (SELECT danhmuc): " . $conn->error);
}

if (!$stmt->execute()) {
    die("Lỗi execute (SELECT danhmuc): " . $stmt->error);
}

$result_danhmuc = $stmt->get_result();
$stmt->close();

// Lấy danh sách loại sản phẩm từ CSDL (sử dụng prepared statements và GROUP BY)
$stmt = $conn->prepare("SELECT loai FROM sanpham GROUP BY loai");

if (!$stmt) {
    die("Lỗi prepare (SELECT loai): " . $conn->error);
}

if (!$stmt->execute()) {
    die("Lỗi execute (SELECT loai): " . $stmt->error);
}

$result_loai = $stmt->get_result();
$stmt->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Admin Panel</title>
    <link rel="stylesheet" href="login.css">
</head>

<body>

    <div class="container">
        <h1>Trang Admin</h1>
        <p>Chào mừng, <b><?php echo htmlspecialchars($_SESSION["username"]); ?></b>! <a href="logout.php"
                class="btn btn-danger ml-3">Đăng xuất</a></p>

        <h2>Quản lý sản phẩm</h2>

        <?php if (isset($success_message)): ?>
            <div class="alert alert-success">
                <?php echo $success_message; ?>
            </div>
        <?php endif; ?>

        <?php if (isset($error_message)): ?>
            <div class="alert alert-danger">
                <?php echo $error_message; ?>
            </div>
        <?php endif; ?>

        <h3>Thêm sản phẩm mới</h3>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="loai" class="form-label">Loại sản phẩm:</label>
                <select class="form-control" id="loai" name="loai" required>
                    <?php
                    // Hiển thị các loại sản phẩm trong dropdown list
                    if ($result_loai->num_rows > 0) {
                        while ($row_loai = $result_loai->fetch_assoc()) {
                            echo "<option value='" . $row_loai["loai"] . "'>" . $row_loai["loai"] . "</option>";
                        }
                    } else {
                        echo "<option value=''>Chưa có loại sản phẩm nào</option>";
                    }
                    ?>
                </select>
            </div>

            <div class="mb-3">
                <label for="ten" class="form-label">Tên sản phẩm:</label>
                <input type="text" class="form-control" id="ten" name="ten" required>
            </div>
            <div class="mb-3">
                <label for="gia" class="form-label">Giá:</label>
                <input type="number" class="form-control" id="gia" name="gia" required>
            </div>
            <div class="mb-3">
                <label for="mota" class="form-label">Mô tả:</label>
                <textarea class="form-control" id="mota" name="mota"></textarea>
            </div>
            <div class="mb-3">
                <label for="hinhanh" class="form-label">Hình ảnh:</label>
                <input type="file" class="form-control" id="hinhanh" name="hinhanh" accept="image/*">
            </div>
            <div class="mb-3">
                <label for="id_danhmuc" class="form-label">Danh mục:</label>
                <select class="form-control" id="id_danhmuc" name="id_danhmuc">
                    <?php
                    if ($result_danhmuc->num_rows > 0) {
                        while ($row_danhmuc = $result_danhmuc->fetch_assoc()) {
                            echo "<option value='" . $row_danhmuc["id"] . "'>" . $row_danhmuc["ten"] . "</option>";
                        }
                    } else {
                        echo "<option value=''>Không có danh mục nào</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="mb-3">
                <label for="soluong" class="form-label">Số lượng:</label>
                <input type="number" class="form-control" id="soluong" name="soluong" required>
            </div>
            <div class="mb-3">
                <label for="trangthai" class="form-label">Trạng thái:</label>
                <select class="form-control" id="trangthai" name="trangthai">
                    <option value="Còn hàng">Còn hàng</option>
                    <option value="Hết hàng">Hết hàng</option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary" name="add_product">Thêm sản phẩm</button>
            <a href="index.php" class="btn btn-secondary">Quay lại trang chủ</a>
        </form>

        <h3>Danh sách sản phẩm</h3>
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Tên</th>
                    <th>Giá</th>
                    <th>Mô tả</th>
                    <th>Hình ảnh</th>
                    <th>Danh mục</th>
                    <th>Số lượng</th>
                    <th>Trạng thái</th>
                    <th>Loại</th>
                    <th>Hành động</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row["id"] . "</td>";
                        echo "<td>" . $row["ten"] . "</td>";
                        echo "<td>" . $row["gia"] . "</td>";
                        echo "<td>" . $row["mota"] . "</td>";
                        echo "<td>" . $row["hinhanh"] . "</td>";
                        // Lấy tên danh mục từ bảng danhmuc
                        $id_danhmuc = $row["id_danhmuc"];
                        if (is_numeric($id_danhmuc) && $id_danhmuc > 0) {
                            $sql_ten_danhmuc = "SELECT ten FROM danhmuc WHERE id = $id_danhmuc";
                            $result_ten_danhmuc = $conn->query($sql_ten_danhmuc);
                            if ($result_ten_danhmuc && $result_ten_danhmuc->num_rows > 0) {
                                $ten_danhmuc = $result_ten_danhmuc->fetch_assoc()["ten"];
                                echo "<td>" . $ten_danhmuc . "</td>";
                            } else {
                                echo "<td>Không tìm thấy danh mục</td>";
                            }
                        } else {
                            echo "<td>ID danh mục không hợp lệ</td>";
                        }
                        echo "<td>" . $row["soluong"] . "</td>";
                        echo "<td>" . $row["trangthai"] . "</td>";
                        echo "<td>" . $row["loai"] . "</td>"; // Hiển thị loại sản phẩm
                        echo "<td>";
                        echo "<a href='edit_product.php?id=" . $row["id"] . "' class='btn btn-warning btn-sm'>Sửa</a> ";
                        echo "<a href='delete_product.php?id=" . $row["id"] . "' class='btn btn-danger btn-sm'>Xóa</a>";
                        echo "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='10'>Không có sản phẩm nào.</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm"
            crossorigin="anonymous"></script>
</body>

</html>