<?php

session_start();

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
            if ($user['roles'] == 1) {
                // Đăng nhập thành công cho quản trị viên
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['user_name'] = $user['name'];
                $_SESSION['user_email'] = $user['email'];
                $_SESSION['loginadmin'] = true;

                header("Location: index.php");
                exit;
            } else {
                // Người dùng không phải là quản trị viên
                echo "Bạn không có quyền truy cập trang quản trị";
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
