<?php
session_start();

// Kiểm tra xem người dùng đã đăng nhập chưa
if (!isset($_SESSION['username'])) {
    header('Location: login.php'); // Chuyển hướng đến trang đăng nhập nếu chưa đăng nhập
    exit();
}

// Kết nối cơ sở dữ liệu
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "doan"; 

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}

// Lấy thông tin đơn hàng từ session (nếu có)
if (isset($_SESSION['order'])) {
    $order = $_SESSION['order'];
    $order_id = $order['id'];
    $fullname = $order['fullname'];
    $address = $order['address'];
    $phone = $order['phone'];
    $total = $order['total'];

    // Xóa thông tin đơn hàng khỏi session
    unset($_SESSION['order']); 
} else {
    // Chuyển hướng về trang chủ nếu không có thông tin đơn hàng
    header('Location: index.php');
    exit();
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

<div class="container">
    <h1>Cảm ơn bạn đã đặt hàng!</h1>
    <p>Đơn hàng của bạn đã được đặt thành công.</p>

    <h3>Thông tin đơn hàng:</h3>
    <p>Mã đơn hàng: #<?php echo $order_id; ?></p>
    <p>Họ và tên: <?php echo $fullname; ?></p>
    <p>Địa chỉ: <?php echo $address; ?></p>
    <p>Số điện thoại: <?php echo $phone; ?></p>
    <p>Tổng tiền: <?php echo number_format($total, 0, ',', '.') . '₫'; ?></p>

    <p>Bạn sẽ nhận được email xác nhận chi tiết đơn hàng trong ít phút nữa.</p>

    <p>Cảm ơn bạn đã mua sắm tại LDFishStore!</p>

    <a href="index.php" class="btn btn-primary">Tiếp tục mua sắm</a>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>