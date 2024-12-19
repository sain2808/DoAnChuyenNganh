<?php
session_start();
include_once 'cart_process.php';

function get_cart_popup_content($conn, $product_id, $quantity) {
    // Kiểm tra và validate dữ liệu
    if (!is_numeric($product_id) || !is_numeric($quantity)) {
        return "<p>Thông tin sản phẩm không hợp lệ.</p>";
    }

    $product = get_product($conn, $product_id);

    if (!$product) {
        return "<p>Không tìm thấy sản phẩm.</p>";
    }

    // Tính tổng số lượng sản phẩm trong giỏ hàng
    $cartCount = 0;
    foreach ($_SESSION['cart'] as $item) {
        $cartCount += $item['quantity'];
    }

    // Tạo dữ liệu cho popup
    $data = [
        'product' => $product,
        'quantity' => $quantity,
        'cartCount' => $cartCount
    ];

    // Trả về dữ liệu
    return $data;
}

if (isset($_GET['product_id']) && isset($_GET['quantity'])) {
    $product_id = $_GET['product_id'];
    $quantity = $_GET['quantity'];

    $data = get_cart_popup_content($conn, $product_id, $quantity);

    if (is_array($data)) {
        // Hiển thị HTML (bạn có thể sử dụng template engine ở đây)
        ?>
        <div class="product-info">
            <img src="<?php echo $data['product']['hinhanh']; ?>" alt="<?php echo $data['product']['ten']; ?>" width="100">
            <div>
                <h5><?php echo $data['product']['ten']; ?></h5>
                <p>Giá: <?php echo number_format($data['product']['gia'], 0, ',', '.') . '₫'; ?></p>
                <p>Số lượng: <?php echo $data['quantity']; ?></p>
            </div>
        </div>
        <p>Giỏ hàng có sẵn (<?php echo $data['cartCount']; ?>) sản phẩm</p>
        <?php
    } else {
        echo $data; // Hiển thị thông báo lỗi
    }
} else {
    echo "<p>Thông tin sản phẩm không hợp lệ.</p>";
}
?>