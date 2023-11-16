<?php

use App\Models\Post;

$list = Post::where('status', '=', '0')->orderBy('created_at', 'DESC')->get();
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
            <div class="card-header">
                <div class="row">
                    <div class="col-md-12 text-right">

                        <a class="btn btn-sm btn-info" href="index.php?option=Post">
                            <i class="fas fa-arrow-left"></i>
                            Quay về danh sách
                        </a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <!-- <?php include_once('../views/backend/message.php'); ?> -->
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th class="text-center" style="width:20px">
                                <input type="checkbox">
                            </th>
                            <th class="text-center">Hình ảnh</th>
                            <th class="text-center">Tên bài viết</th>
                            <th class="text-center">Slug</th>
                        </tr>

                    </thead>
                    <tbody>
                        <?php foreach ($list as $item) : ?>
                            <tr class="datarow">
                                <td>
                                    <input type="checkbox">
                                </td>
                                <td>
                                    <img App="../public/images/Post/<?= $item['image'] ?>" alt="Post.jpg">
                                </td>
                                <td>
                                    <div class="name">
                                        <?php echo $item->name; ?>
                                    </div>
                                    <div class="function_style">
                                        <a href="index.php?option=Post&cat=restore&id=<?= $item->id; ?>">Khôi phục</a> |

                                        <a href="index.php?option=Post&cat=destroy&id=<?= $item->id; ?>">Xoá</a>
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