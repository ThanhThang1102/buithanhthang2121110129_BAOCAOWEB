<?php
require_once "views/frontend/header.php"; ?>

<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "buithanhthang_ltw_ccq2211ab2";

// Tạo kết nối
$conn = new mysqli($servername, $username, $password, $dbname);

// Kiểm tra kết nối
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
if (isset($_POST['LOGIN'])) {
    $loginCredential = $_POST['email']; // Thay đổi thành tên trường người dùng nhập (email hoặc username)
    $password = $_POST['password'];

    // Thực hiện truy vấn để kiểm tra thông tin đăng nhập
    $query = "SELECT * FROM `0129_user` WHERE `email` = '$loginCredential' OR `username` = '$loginCredential'";
    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();

        if (password_verify($password, $user['password'])) {
            // Kiểm tra roles của người dùng
            if ($user['roles'] == 0) {
                // Đăng nhập thành công cho quản trị viên
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['user_name'] = $user['name'];
                $_SESSION['user_email'] = $user['email'];
                $_SESSION['loginsite'] = true;
                header("Location: index.php");
                exit;
            }
        } else {
            // Mật khẩu không đúng
            echo "Mật khẩu không đúng";
        }
    } else {
        // Người dùng không tồn tại
        echo "Người dùng không tồn tại";
    }
}


?>

<section class="hdl-maincontent py-2">
   <form action="" method="post" name="logincustomer">
      <div class="container">
         <div class="row">
            <div class="col-md-4">
               <p>Để gửi bình luận, liên hệ hay để mua hàng cần phải có tài khoản</p>
            </div>
            <div class="col-md-8">
               <div class="mb-3">
                  <label for="username" class="text-main">Tên tài khoản (*)</label>
                  <input type="text" name="email" id="username" class="form-control" placeholder="Nhập tài khoản đăng nhập" required>
               </div>
               <div class="mb-3">
                  <label for="password" class="text-main">Mật khẩu (*)</label>
                  <input type="password" name="password" id="password" class="form-control" placeholder="Mật khẩu" required>
               </div>
               <div class="mb-3">
                  <button class="btn btn-main" name="LOGIN">Đăng nhập</button>
               </div>
               <p><u class="text-main">Chú ý</u>: (*) Thông tin bắt buộc phải nhập</p>
            </div>
         </div>
      </div>
   </form>
</section>
<?php require_once "views/frontend/footer.php"; ?>