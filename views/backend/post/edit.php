<?php

use App\Models\Post;

$id = $_REQUEST['id'];
$row = Post::find($id);
$list = Post::where('status', '!=', '0')->get();
$html_parent_id = '';
$html_sort_order = '';
foreach ($list as $item) {
    $html_parent_id .= "<option value='" . $item->id . "'>" . $item->name . "</option>";
    $html_sort_order .= "<option value='" . $item->oder . "'>Sau :" . $item->name . "</option>";
}
?>

<?php require_once('../views/backend/header.php') ?>

<form action="index.php?option=Post&cat=process" method="post" enctype="multipart/form-data">
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Sửa bài viết</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="index.php">Bảng điều khiển</a></li>
                            <li class="breadcrumb-item active">Sửa bài viết</li>
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
                            <button name="CAPNHAT" type="submit" class="btn btn-sm btn-success">
                                <i class="fas fa-save"></i> Lưu[Sửa]
                            </button>
                            <a class="btn btn-sm btn-info" href="index.php?option=Post">
                                <i class="fas fa-arrow-left"></i> Quay về danh sách
                            </a>
                        </div>
                    </div>
                </div>
                <!-- <?php include_once('../views/backend/message.php'); ?> -->
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <input type="hidden" name="id" value="<?= $row['id']; ?>">
                            <div class="mb-3">
                                <label for="name">Tên chủ đề</label>
                                <input name="name" id="name" type="text" value="<?= $row['name']; ?>" class="form-control" require>
                            </div>
                            <div class=" mb-3">
                                <label for="slug">Slug</label>
                                <input name="slug" id="slug" class="form-control" require value="<?= $row['slug']; ?>"></input>

                            </div>
                            <div class="mb-3">
                                <label for="description">Mô tả</label>
                                <textarea name="description" id="description" class="form-control" require><?= $row['description']; ?></textarea>
                            </div>

                            <div class="mb-3">
                                <label for="image">Hình ảnh</label>
                                <input name="image" id="image" type="file" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label for="status">Trang thái</label>
                                <select name="status" id="status" class="form-control">
                                    <option value="2">--Chưa xuất bản--</option>
                                    <option value="1">--Đã xuất bản--</option>

                                </select>
                            </div>
                        </div>
                    </div>
                </div>
        </section>
    </div>

</form>
<?php require_once('../views/backend/footer.php') ?>