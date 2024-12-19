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
  $username = $_POST["username"];
  $password = password_hash($_POST["password"], PASSWORD_DEFAULT); // Mã hóa mật khẩu
  $email = $_POST["email"];
  $full_name = $_POST["full_name"];
  $phone = $_POST["phone"];
  $address = $_POST["address"];

  // Kiểm tra xem username hoặc email đã tồn tại chưa
  $sql = "SELECT * FROM users WHERE username = '$username' OR email = '$email'";
  $result = $conn->query($sql);

  if ($result->num_rows > 0) {
    $error_message = "Tên đăng nhập hoặc email đã tồn tại!";
  } else {
    // Thêm người dùng mới vào CSDL
    $sql = "INSERT INTO users (username, password, email, full_name, phone, address) 
            VALUES ('$username', '$password', '$email', '$full_name', '$phone', '$address')";

    if ($conn->query($sql) === TRUE) {
      $success_message = "Đăng ký thành công!";
    } else {
      $error_message = "Lỗi: " . $sql . "<br>" . $conn->error;
    }
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
  <title>Register Form</title>
  <link rel="stylesheet" href="login.css">
</head>
<body>

<div class="container d-flex justify-content-center align-items-center vh-100">
  <div class="card p-4 shadow" style="width: 100%; max-width: 500px;"> 
    <h3 class="card-title text-center mb-4">Register</h3>
    
    <?php if ($_SERVER["REQUEST_METHOD"] == "POST"): ?>
    <div class="table-responsive">
      <table class="table">
        <?php if (isset($success_message)): ?>
        <tr>
          <td class="text-success"><?php echo $success_message; ?></td>
        </tr>
        <?php endif; ?>
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
        <label for="username" class="form-label">Username</label>
        <input type="text" class="form-control" id="username" name="username" placeholder="Enter your username" required>
      </div>

      <div class="mb-3">
        <label for="password" class="form-label">Password</label>
        <input type="password" class="form-control" id="password" name="password" placeholder="Enter your password" required>
      </div>

      <div class="mb-3">
        <label for="email" class="form-label">Email address</label>
        <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email" required>
      </div>
      
      <div class="mb-3">
        <label for="full_name" class="form-label">Full Name</label>
        <input type="text" class="form-control" id="full_name" name="full_name" placeholder="Enter your full name">
      </div>

      <div class="mb-3">
        <label for="phone" class="form-label">Phone</label>
        <input type="tel" class="form-control" id="phone" name="phone" placeholder="Enter your phone number">
      </div>

      <div class="mb-3">
        <label for="address" class="form-label">Address</label>
        <textarea class="form-control" id="address" name="address" rows="3" placeholder="Enter your address"></textarea>
      </div>
      
      <button type="submit" class="btn btn-primary w-100">Register</button>
      
      <div class="text-center mt-3">
        <p>Already have an account? <a href="login.php" class="text-decoration-none">Login</a></p> 
      </div>

    </form>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous"></script>
</body>
</html>