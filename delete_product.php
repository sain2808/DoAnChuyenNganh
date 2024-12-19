<?php
session_start();

// Kiểm tra xem người dùng đã đăng nhập chưa và có phải admin không
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true || $_SESSION["role"] !== 'admin') {
    header("location: login.php");
    exit;
}

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "doan";

try {
    // Tạo kết nối
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Kiểm tra kết nối
    if ($conn->connect_error) {
        throw new Exception("Kết nối thất bại: " . $conn->connect_error);
    }

    // Lấy ID sản phẩm từ URL
    if (isset($_GET['id'])) {
        $id = $_GET['id'];

        // Kiểm tra quyền xóa (nếu cần)
        // ...

        // Sử dụng prepared statements để ngăn chặn SQL injection
        $stmt = $conn->prepare("DELETE FROM sanpham WHERE id = ?");
        $stmt->bind_param("i", $id);

        if ($stmt->execute()) {
            // Xóa sản phẩm thành công
            $message = "Xóa sản phẩm thành công!";
            $message_type = "success";
        } else {
            // Xóa sản phẩm thất bại
            $message = "Lỗi: " . $stmt->error;
            $message_type = "danger";
        }
        $stmt->close();
    } else {
        // ID sản phẩm không hợp lệ
        $message = "ID sản phẩm không hợp lệ.";
        $message_type = "danger";
    }
} catch (Exception $e) {
    // Xử lý ngoại lệ
    $message = "Lỗi: " . $e->getMessage();
    $message_type = "danger";
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Xóa sản phẩm</title>
</head>
<body>
    <div class="container">
        <?php if (isset($message)): ?>
            <div class="alert alert-<?php echo $message_type; ?>">
                <?php echo $message; ?>
            </div>
        <?php endif; ?>
        <a href="admin.php" class="btn btn-secondary">Quay lại trang Admin</a>
    </div>
</body>
</html>