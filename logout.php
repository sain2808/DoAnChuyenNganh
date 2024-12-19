<?php
session_start(); // Khởi tạo session
$_SESSION = array(); // Xóa tất cả biến session
session_destroy(); // Hủy session
header("Location: login.php"); // Chuyển hướng đến trang login
exit;
?>