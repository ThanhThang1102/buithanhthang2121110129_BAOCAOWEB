<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng nhập Quản trị viên</title>
    <link rel="stylesheet" href="login.css">
    <link rel="stylesheet" href="../public/bootstrap/css/bootstrap.min.css">
</head>

<body>
    <div class="container login">
        <div class="login__container">
            <h1>Login Admin</h1>
            <form action="auth.php" method="post" enctype="multipart/form-data">
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Email or Username</label>
                    <input type="text" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                </div>
                <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label">Password</label>
                    <input type="password" name="password" class="form-control" id="exampleInputPassword1">
                </div>
                <button type="submit" name="LOGIN" class="btn btn-primary">Login</button>
            </form>
        </div>
    </div>
</body>

</html>