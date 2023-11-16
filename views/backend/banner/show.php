<?php

use App\Models\Banner;

$list = Banner::where('status', '!=', '0')->orderBy('created_at', 'DESC')->get();

$id = $_REQUEST['id'];
$row = Banner::find($id);
?>

<?php require_once('../views/backend/header.php') ?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Thương hiệu</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="index.php">Bảng điều khiển</a></li>
                        <li class="breadcrumb-item active">Thương hiệu</li>
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
                        <a class="btn btn-sm btn-success" href="index.php?option=Banner">
                            <i class="fas fa-step-backward"></i>Quay về danh sách
                        </a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th class="text-center">#</th>
                            <th class="text-center">Hình ảnh</th>
                            <th>Tên thương hiệu</th>
                            <th class="text-center">Slug</th>
                        </tr>

                    </thead>
                    <tbody>
                        <tr class="datarow">
                            <td>
                                <input type="checkbox">
                            </td>
                            <td>
                                <img App="../public/images/Banner/<?= $row['image'] ?>" alt="Banner.jpg">
                            </td>
                            <td>
                                <div class="name">
                                    <?php echo $row->name; ?>
                                </div>
                                <div class="function_style">
                                    <?php if ($row->status == 1) : ?>
                                        <a class="text-sucess" href="index.php?option=Banner&cat=status&id=<?= $row->id; ?>"> <i class="fas fa-toggle-on"></i> Hiện</a> |
                                    <?php else : ?>
                                        <a class="text-danger" href="index.php?option=Banner&cat=status&id=<?= $row->id; ?>"> <i class="fas fa-toggle-off"></i> Ẩn</a> |
                                    <?php endif; ?>

                                    <a class="text-info" href="index.php?option=Banner&cat=edit&id=<?= $row->id; ?>"> <i class="fas fa-edit"></i> Chỉnh sửa</a> |

                                    <a class="text-info" href="index.php?option=Banner&cat=show&id=<?= $row->id; ?>"> <i class="fas fa-eye"></i> Chi tiết</a> |

                                    <a class="text-danger" href="index.php?option=Banner&cat=delete&id=<?= $row->id; ?>"><i class="fas fa-trash"> </i> Xoá</a>
                                </div>
                            </td>
                            <td> <?php echo $row->slug; ?></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<?php require_once('../views/backend/footer.php') ?>