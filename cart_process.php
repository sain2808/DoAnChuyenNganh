<?php
// cart_process.php

 session_start(); // Xóa dòng này, vì session đã được start trong product_detail.php

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

    // Hàm lấy thông tin sản phẩm từ CSDL
    function get_product($conn, $product_id) {
        // Sử dụng prepared statements để ngăn chặn SQL Injection
        $stmt = $conn->prepare("SELECT * FROM sanpham WHERE id = ?");
        $stmt->bind_param("i", $product_id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $product = $result->fetch_assoc();
            return $product;
        } else {
            return false;
        }
    }

    // Xử lý thêm sản phẩm vào giỏ hàng
    if (isset($_POST['add_to_cart']) && isset($_POST['product_id'])) {
        $product_id = $_POST['product_id'];
        $quantity = isset($_POST['quantity']) ? $_POST['quantity'] : 1; 
        $product = get_product($conn, $product_id); 

        if ($product) {
            if (isset($_SESSION['cart'][$product_id])) {
                $_SESSION['cart'][$product_id]['quantity'] += $quantity;
            } else {
                $_SESSION['cart'][$product_id] = [
                    'id' => $product['id'],
                    'ten' => $product['ten'],
                    'gia' => $product['gia'],
                    'hinhanh' => $product['hinhanh'],
                    'quantity' => $quantity
                ];
            }
            echo "Thêm vào giỏ hàng thành công!"; 
        } else {
            echo "Thêm vào giỏ hàng thất bại!";
        }

        // In ra nội dung giỏ hàng để kiểm tra
        echo "<pre>";
        print_r($_SESSION['cart']);
        echo "</pre>";

        exit; // Kết thúc xử lý AJAX
    }
    // Xử lý cập nhật số lượng sản phẩm
    if (isset($_POST['update_cart'])) {
        foreach ($_POST['quantity'] as $product_id => $quantity) {
            if (isset($_SESSION['cart'][$product_id])) {
                if ($quantity > 0) {
                    $_SESSION['cart'][$product_id]['quantity'] = $quantity;
                } else {
                    // Xóa sản phẩm khỏi giỏ hàng nếu số lượng bằng 0
                    unset($_SESSION['cart'][$product_id]); 
                }
            }
        }
    }

    // Xử lý xóa sản phẩm khỏi giỏ hàng
    if (isset($_GET['remove']) && isset($_GET['product_id'])) {
        $product_id = $_GET['product_id'];
        if (isset($_SESSION['cart'][$product_id])) {
            unset($_SESSION['cart'][$product_id]);
        }
    }

} catch (Exception $e) {
    // Xử lý ngoại lệ
    echo "Lỗi: " . $e->getMessage();
}
?>