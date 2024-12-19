<?php
session_start();

// Kiểm tra xem giỏ hàng có trống hay không
if (empty($_SESSION['cart'])) {
    header("Location: cart.php");
    exit;
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

// Lấy thông tin sản phẩm từ cơ sở dữ liệu
$product_ids = array_column($_SESSION['cart'], 'id');
$products = [];

if (count($product_ids) > 0) {
    $placeholders = implode(',', array_fill(0, count($product_ids), '?'));
    $stmt = $conn->prepare("SELECT id, ten, gia, hinhanh FROM sanpham WHERE id IN ($placeholders)"); // Lấy các cột cần thiết

    if (!$stmt) {
        die("Lỗi prepare (SELECT): " . $conn->error);
    }

    $stmt->bind_param(str_repeat('i', count($product_ids)), ...$product_ids);
    
    if (!$stmt->execute()) {
        die("Lỗi execute (SELECT): " . $stmt->error);
    }

    $result = $stmt->get_result();
    
    while ($row = $result->fetch_assoc()) {
        $products[$row['id']] = $row;
    }

    $stmt->close();
}

// Xử lý khi form thanh toán được submit
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["place_order"])) {
    // Lấy thông tin giao hàng từ form
    $fullname = $_POST["fullname"];
    $email = $_POST["email"];
    $address = $_POST["address"];
    $phone = $_POST["phone"];

    // Lưu thông tin đơn hàng vào CSDL
    $username = $_SESSION['username']; // Lấy username từ session
    $status = 'Pending'; // Trạng thái đơn hàng là "Chờ xử lý"

    // Tính tổng giá trị đơn hàng
    $total = 0;
    foreach ($_SESSION['cart'] as $item) {
        $total += $products[$item['id']]['gia'] * $item['quantity'];
    }

    // Thêm đơn hàng vào bảng donhang
    $stmt = $conn->prepare("INSERT INTO donhang (username, fullname, email, address, phone, total_amount, status) VALUES (?, ?, ?, ?, ?, ?, ?)");
    
    if (!$stmt) {
        die("Lỗi prepare (INSERT donhang): " . $conn->error); 
    }

    $stmt->bind_param("sssssds", $username, $fullname, $email, $address, $phone, $total, $status);  

    if (!$stmt->execute()) {
        die("Lỗi execute (INSERT donhang): " . $stmt->error);
    }

    $order_id = $stmt->insert_id; // Lấy ID đơn hàng vừa tạo

    $stmt->close();


    // Thêm chi tiết đơn hàng vào bảng chitietdonhang
    $stmt = $conn->prepare("INSERT INTO chitietdonhang (order_id, product_id, product_name, quantity, price, total) VALUES (?, ?, ?, ?, ?, ?)");
    
    if (!$stmt) {
        die("Lỗi prepare (INSERT chitietdonhang): " . $conn->error); 
    }

    foreach ($_SESSION['cart'] as $item) {
        $product_id = $item['id'];
        $product_name = $item['ten'];
        $quantity = $item['quantity'];
        $price = $products[$item['id']]['gia'];
        $total_item = $price * $quantity;

        $stmt->bind_param("iissdd", $order_id, $product_id, $product_name, $quantity, $price, $total_item);
        
        if (!$stmt->execute()) {
            die("Lỗi execute (INSERT chitietdonhang): " . $stmt->error);
        }
    }

    $stmt->close(); // Đóng stmt sau khi thêm tất cả chi tiết đơn hàng


    // Lưu thông tin đơn hàng vào session để hiển thị trên trang complete.php
    $_SESSION['order'] = [
        'id' => $order_id,
        'fullname' => $fullname,
        'address' => $address,
        'phone' => $phone,
        'total' => $total
    ];

    // Xóa giỏ hàng sau khi thanh toán thành công
    unset($_SESSION['cart']);

    // Chuyển hướng đến trang hoàn tất đơn hàng
    header("Location: complete.php");
    exit;
}

// Đóng kết nối cơ sở dữ liệu
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Thanh toán</title>
    <link rel="stylesheet" href="style.css"> 
</head>
<body>

<div class="container checkout-container"> 
    <div class="checkout-header">
        <h1>Thanh toán</h1>
    </div>

    <div class="row"> 
        <div class="col-md-6"> 
            <h2>Thông tin đơn hàng</h2>
            <table class="table checkout-table">
                <thead>
                <tr>
                    <th>Sản phẩm</th>
                    <th>Giá</th>
                    <th>Số lượng</th>
                    <th>Thành tiền</th>
                </tr>
                </thead>
                <tbody>
                <?php
                $total = 0;
                foreach ($_SESSION['cart'] as $item):
                    $total_item = $products[$item['id']]['gia'] * $item['quantity'];
                    $total += $total_item;
                    ?>
                    <tr>
                        <td>
                            <img src="<?= $products[$item['id']]['hinhanh'] ?>" alt="<?= $products[$item['id']]['ten'] ?>" width="50">
                            <span class="checkout-item-name"><?= $products[$item['id']]['ten'] ?></span> 
                        </td>
                        <td class="checkout-item-price"><?= number_format($products[$item['id']]['gia'], 0, ',', '.') ?>₫</td>
                        <td><?= $item['quantity'] ?></td>
                        <td class="checkout-item-total"><?= number_format($total_item, 0, ',', '.') ?>₫</td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>

            <div class="checkout-total">Tổng tiền: <?= number_format($total, 0, ',', '.') ?>₫</div>
        </div> 
        <div class="col-md-6"> 
            <h2>Thông tin giao hàng</h2>
            <form method="post" action="checkout.php" class="checkout-form"> 
                <div class="mb-3">
                    <label for="fullname" class="form-label">Họ và tên:</label>
                    <input type="text" class="form-control" id="fullname" name="fullname" required>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email:</label>
                    <input type="email" class="form-control" id="email" name="email" required>
                </div>
                <div class="mb-3">
                    <label for="address" class="form-label">Địa chỉ:</label>
                    <input type="text" class="form-control" id="address" name="address" required>
                </div>
                <div class="mb-3">
                    <label for="phone" class="form-label">Số điện thoại:</label>
                    <input type="tel" class="form-control" id="phone" name="phone" required>
                </div>
                <button type="submit" class="btn btn-primary place-order-button" name="place_order">Đặt hàng</button>
            </form>
        </div> 
    </div> 
</div> 

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm"
        crossorigin="anonymous"></script>
</body>
</html>