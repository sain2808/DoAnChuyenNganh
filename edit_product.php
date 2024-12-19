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

// Lấy ID sản phẩm từ URL
if (isset($_GET["id"])) {
    $id = $_GET["id"];

    // Lấy thông tin sản phẩm từ CSDL
    $sql = "SELECT * FROM sanpham WHERE id = $id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $product = $result->fetch_assoc();
    } else {
        echo "Không tìm thấy sản phẩm.";
        exit;
    }
} else {
    echo "ID sản phẩm không hợp lệ.";
    exit;
}

// Xử lý khi form sửa sản phẩm được submit
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["edit_product"])) {
    // Lấy dữ liệu từ form (chưa xử lý upload hình ảnh)
    $ten = $_POST["ten"];
    $gia = $_POST["gia"];
    $mota = $_POST["mota"];
    $hinhanh = $_POST["hinhanh"];
    $id_danhmuc = $_POST["id_danhmuc"];
    $soluong = $_POST["soluong"];
    $trangthai = $_POST["trangthai"];

    // Cập nhật sản phẩm trong CSDL
    $sql = "UPDATE sanpham SET 
            ten = '$ten', 
            gia = '$gia', 
            mota = '$mota', 
            hinhanh = '$hinhanh', 
            id_danhmuc = '$id_danhmuc', 
            soluong = '$soluong', 
            trangthai = '$trangthai' 
            WHERE id = $id";

if ($conn->query($sql) === TRUE) {
    $success_message = "Cập nhật sản phẩm thành công!";
    // Chuyển hướng về trang admin.php
    header("Location: admin.php");
    exit; // Dừng thực thi mã sau khi chuyển hướng
} else {
    $error_message = "Lỗi: " . $sql . "<br>" . $conn->error;
}
}

// Lấy danh sách danh mục từ CSDL
$sql_danhmuc = "SELECT * FROM danhmuc";
$result_danhmuc = $conn->query($sql_danhmuc);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Sửa sản phẩm</title>
    <link rel="stylesheet" href="login.css">
</head>

<body>
    <div class="container">
        <h1>Sửa sản phẩm</h1>

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

        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"] . "?id=" . $id); ?>">
            <div class="mb-3">
                <label for="ten" class="form-label">Tên sản phẩm:</label>
                <input type="text" class="form-control" id="ten" name="ten" value="<?php echo $product["ten"]; ?>"
                    required>
            </div>
            <div class="mb-3">
                <label for="gia" class="form-label">Giá:</label>
                <input type="number" class="form-control" id="gia" name="gia" value="<?php echo $product["gia"]; ?>"
                    required>
            </div>
            <div class="mb-3">
                <label for="mota" class="form-label">Mô tả:</label>
                <textarea class="form-control" id="mota" name="mota"><?php echo $product["mota"]; ?></textarea>
            </div>
            <div class="mb-3">
                <label for="hinhanh" class="form-label">Hình ảnh:</label>
                <input type="text" class="form-control" id="hinhanh" name="hinhanh"
                    value="<?php echo $product["hinhanh"]; ?>">
            </div>
            <div class="mb-3">
                <label for="id_danhmuc" class="form-label">Danh mục:</label>
                <select class="form-control" id="id_danhmuc" name="id_danhmuc">
                    <?php
                    if ($result_danhmuc->num_rows > 0) {
                        while ($row_danhmuc = $result_danhmuc->fetch_assoc()) {
                            $selected = ($row_danhmuc["id"] == $product["id_danhmuc"]) ? "selected" : "";
                            echo "<option value='" . $row_danhmuc["id"] . "' $selected>" . $row_danhmuc["ten"] . "</option>";
                        }
                    } else {
                        echo "<option value=''>Không có danh mục nào</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="mb-3">
                <label for="soluong" class="form-label">Số lượng:</label>
                <input type="number" class="form-control" id="soluong" name="soluong"
                    value="<?php echo $product["soluong"]; ?>" required>
            </div>
            <div class="mb-3">
                <label for="trangthai" class="form-label">Trạng thái:</label>
                <select class="form-control" id="trangthai" name="trangthai">
                    <option value="Còn hàng" <?php if ($product["trangthai"] == "Còn hàng") echo "selected"; ?>>Còn hàng
                    </option>
                    <option value="Hết hàng" <?php if ($product["trangthai"] == "Hết hàng") echo "selected"; ?>>Hết hàng
                    </option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary" name="edit_product">Lưu thay đổi</button>
        </form>
    </div>

    <script src="https://cdn.