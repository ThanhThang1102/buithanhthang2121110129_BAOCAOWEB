<?php

?>

<?php require_once('../views/backend/header.php') ?>

<form action="index.php?option=member&cat=process" method="post" enctype="multipart/form-data">
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Thêm tài khoản quản trị viên</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="index.php">Bảng điều khiển</a></li>
                            <li class="breadcrumb-item active">Thêm tài quản trị viên</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>
        <!-- Main content -->
        <section class="content">
            <?php if (isset($_SESSION["message"])) : ?>
                <div class="alert alert-<?php echo $_SESSION["message"]["type"]; ?>">
                    <?php echo $_SESSION["message"]["msg"]; ?>
                </div>

                <?php
                // Clear the session message after displaying it
                unset($_SESSION["message"]);
                ?>
            <?php endif; ?>
            <!-- Default box -->
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-12 text-right">
                            <button name="THEM" type="submit" class="btn btn-sm btn-success">
                                <i class="fas fa-save"></i> Lưu[Sửa]
                            </button>
                            <a class="btn btn-sm btn-info" href="index.php?option=customer">
                                <i class="fas fa-arrow-left"></i> Quay về danh sách
                            </a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label for="name">Tên khách hàng</label>
                                <input name="name" id="name" type="text" value="" class="form-control" require>
                            </div>
                            <div class="mb-3">
                                <label for="username">Username</label>
                                <input name="username" id="username" class="form-control" require></input>
                            </div>
                            <div class="mb-3">
                                <label for="password">Mật khẩu</label>
                                <input name="password" type="password" id="password" class="form-control" require></input>
                            </div>
                            <div class="mb-3">
                                <label for="email">Email</label>
                                <input name="email" type="email" value="" id="email" class="form-control" require></input>
                            </div>
                            <div class="mb-3">
                                <label for="phone">Điện thoại</label>
                                <input name="phone" maxlength="10" max="10" type="number" value="" id="phone" class="form-control" require></input>
                            </div>
                            <div class="mb-3">
                                <label for="address">Địa chỉ</label>
                                <textarea name="address" id="address" class="form-control" require></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="gender">Giới tính</label>
                                <select name="gender" id="gender" class="form-control">
                                    <option value="1">Nam</option>
                                    <option value="2">Nữ</option>
                                    <option value="3">Khác</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="roles">Quyền (roles)</label>
                                <select name="roles" id="roles" class="form-control">
                                    <option value="1">Quản trị viên</option>
                                    <option value="0">Người dùng</option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="image">Hình ảnh</label>
                                <input name="image" id="image" type="file" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label for="status">Trang thái</label>
                                <select name="status" id="status" class="form-control">
                                    <option value="1">--Đã xuất bản--</option>
                                    <option value="2">--Chưa xuất bản--</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
        </section>
    </div>

</form>
<?php require_once('../views/backend/footer.php') ?>