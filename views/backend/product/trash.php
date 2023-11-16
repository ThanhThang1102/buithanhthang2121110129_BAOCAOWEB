<?php

use App\Models\Product;

$list = Product::where('status', '=', '0')->orderBy('created_at', 'DESC')->get();
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
                        <form action="index.php?option=product&cat=restore" method="post">
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
                        <a class="btn btn-sm btn-info" href="index.php?option=product">
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
                            <th class="text-center" style="width:20px">
                                <input type="checkbox" class="select-all">
                            </th>
                            <th class="text-center">Hình ảnh</th>
                            <th class="text-center">Tên sản phẩm</th>
                            <th class="text-center">Slug</th>
                        </tr>

                    </thead>
                    <tbody>
                        <?php foreach ($list as $item) : ?>
                            <tr class="datarow">
                                <td>
                                    <input type="checkbox" class="select-item" data-id="<?= $item['id']; ?>">
                                </td>
                                <td>
                                    <img src="../public/images/product/<?= $item['image'] ?>" alt="<?= $item['image'] ?>" width="50">
                                </td>
                                <td>
                                    <div class="name">
                                        <?php echo $item->name; ?>
                                    </div>
                                    <div class="function_style">
                                        <a href="index.php?option=Product&cat=restore&id=<?= $item->id; ?>">Khôi phục</a> |

                                        <a href="index.php?option=Product&cat=destroy&id=<?= $item->id; ?>">Xoá</a>
                                    </div>
                                </td>
                                <td> <?php echo $item->slug; ?></td>
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