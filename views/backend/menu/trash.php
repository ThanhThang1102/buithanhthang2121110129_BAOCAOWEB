<?php

use App\Models\Menu;

$check = [
    [
        'status', '=', 0
    ],
];

$list_menu = Menu::where($check)->orderBy('created_at', 'DESC')->get();

?>

<?php require_once('../views/backend/header.php') ?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Thùng rác</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="index.php">Bảng điều khiển</a></li>
                        <li class="breadcrumb-item active">Tất cả thùng rác</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <!-- Main content -->
    <section class="content">

        <!-- Default box -->
        <div class="card">
            <?php if (isset($_SESSION["message"])) : ?>
                <div class="alert alert-<?php echo $_SESSION["message"]["type"]; ?>">
                    <?php echo $_SESSION["message"]["msg"]; ?>
                </div>

                <?php
                // Clear the session message after displaying it
                unset($_SESSION["message"]);
                ?>
            <?php endif; ?>
            <div class="card-header">
                <div class="row">
                    <div class="col-12-md">
                        <form action="index.php?option=menu&cat=restore" method="post">
                            <select name="action" class="form-control d-inline p-2" style="width: 150px;">
                                <option value="restore">Khôi phục</option>
                                <option value="destroy">Xóa vĩnh viễn</option>
                            </select>
                            <input type="hidden" id="selectedIds" name="selectedIds" value="">
                            <button type="submit" class="btn btn-sm btn-success">Áp dụng</button>
                        </form>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 text-right">
                        <a class="btn btn-sm btn-info" href="index.php?option=menu">
                            <i class="fas fa-arrow-left"></i>
                            Quay về danh sách
                        </a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <table class="table table-bordered" id="myTable">
                    <thead>
                        <tr>
                            <th>
                                <input type="checkbox" class="select-all" id="checkbox">
                            </th>
                            <th>Tên Menu</th>
                            <th>Liên Kết</th>
                            <th>Vị trí</th>
                            <th>Chức năng</th>
                            <th>Mã</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($list_menu as $menu) : ?>
                            <tr>
                                <td>
                                    <input type="checkbox" class="select-item" data-id="<?= $menu['id']; ?>">
                                </td>
                                <td><?= $menu->name; ?></td>
                                <td><?= $menu->link; ?></td>
                                <td><?= $menu->position; ?></td>
                                <td>
                                    <a href="index.php?option=menu&cat=restore&id=<?= $menu->id; ?>" class="btn btn-sm btn-primary">Khôi phục</a> |
                                    <a href="index.php?option=menu&cat=destroy&id=<?= $menu->id; ?>" class="btn btn-sm btn-primary">Xoá</a>
                                </td>
                                <td><?= $menu->id; ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            <!-- /.card-body -->
            <div class="card-footer">
                Footer
            </div>
            <!-- /.card-footer-->
        </div>
        <!-- /.card -->

    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<?php require_once('../views/backend/footer.php') ?>