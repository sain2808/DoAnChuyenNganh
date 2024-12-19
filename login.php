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

// Xử lý khi form được submit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $email = $_POST["email"];
  $password = $_POST["password"]; 

  // Truy vấn CSDL để kiểm tra thông tin đăng nhập
  $sql = "SELECT * FROM users WHERE email = '$email'"; // Thay `users` bằng tên bảng của bạn
  $result = $conn->query($sql);

  if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    // Kiểm tra mật khẩu (trong thực tế, cần so sánh với mật khẩu đã mã hóa)
    if (password_verify($password, $row["password"])) { 
      // Đăng nhập thành công
      session_start(); // Bắt đầu session
      $_SESSION["loggedin"] = true;
      $_SESSION["id"] = $row["id"]; 
      $_SESSION["username"] = $row["username"]; 
      $_SESSION["role"] = $row["role"]; // Lấy vai trò của người dùng
      // ... (Lưu thêm thông tin người dùng vào session nếu cần)
      if ($_SESSION["role"] == 'admin') {
        header("Location: admin.php"); 
      } else {
        header("Location: index.php"); 
      }
      exit; // Dừng thực thi mã sau khi chuyển hướng
    } else {
      $error_message = "Mật khẩu không đúng!"; 
    }
  } else {
    $error_message = "Email không tồn tại!"; 
  }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <title>Login Form</title>
  <link rel="stylesheet" href="login.css">
</head>
<body>

<div class="container d-flex justify-content-center align-items-center vh-100">
  <div class="card p-4 shadow" style="width: 100%; max-width: 400px;">
    <h3 class="card-title text-center mb-4">Login</h3>
    
    <?php if ($_SERVER["REQUEST_METHOD"] == "POST"): ?>
    <div class="table-responsive">
      <table class="table">
        <?php if (isset($error_message)): ?>
        <tr>
          <td class="text-danger"><?php echo $error_message; ?></td>
        </tr>
        <?php endif; ?>
      </table>
    </div>
    <?php endif; ?>

    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
      <div class="mb-3">
        <label for="email" class="form-label">Email address</label>
        <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email" required>
      </div>
      
      <div class="mb-3">
        <label for="password" class="form-label">Password</label>
        <input type="password" class="form-control" id="password" name="password" placeholder="Enter your password" required>
      </div>
      
      <div class="mb-3 form-check">
        <input type="checkbox" class="form-check-input" id="rememberMe">
        <label class="form-check-label" for="rememberMe">Remember Me</label>
      </div>
      
      <button type="submit" class="btn btn-primary w-100">Login</button>
      
      <div class="text-center mt-3">
        <a href="#" class="text-decoration-none">Forgot Password?</a>
      </div>

      <div class="text-center mt-3"> 
        <p>Don't have an account? <a href="register.php" class="text-decoration-none">Register</a></p> 
      </div>
    </form>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous"></script>
</body>
</html>