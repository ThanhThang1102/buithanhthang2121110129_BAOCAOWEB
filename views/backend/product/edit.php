<?php

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;

$id = $_REQUEST['id'];
$row = Product::find($id);

$list_category = Category::where('status', '!=', '0')->orderBy('created_at', 'DESC')->get();
$list_brand = Brand::where('status', '!=', '0')->orderBy('created_at', 'DESC')->get();

?>

<?php require_once('../views/backend/header.php') ?>

<form action="index.php?option=product&cat=process" method="post" enctype="multipart/form-data">
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Sửa sản phẩm</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="index.php">Bảng điều khiển</a></li>
                            <li class="breadcrumb-item active">Sửa sản phẩm</li>
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
                            <input type="hidden" id="idproduct" name="idproduct" value="<?= $row['id']?>">
                            <button name="CAPNHAT" type="submit" class="btn btn-sm btn-success">
                                <i class="fas fa-save"></i> Lưu[Sửa]
                            </button>
                            <a class="btn btn-sm btn-info" href="index.php?option=Product">
                                <i class="fas fa-arrow-left"></i> Quay về danh sách
                            </a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <input type="hidden" name="id" value="" />
                            <div class="mb-3">
                                <label for="name">Tên sản phẩm</label>
                                <input name="name" id="name" type="text" value="<?= $row['name'] ?>" class="form-control" require>
                            </div>
                            <div class="mb-3">
                                <label for="category">Danh mục </label>
                                <select id="category" name="category_id" class="form-control">
                                    <option value="0">Danh mục </option>
                                    <?php foreach ($list_category as $category) : ?>
                                        <option value="<?= $category->id; ?>" <?php echo ($row['category_id'] == $category->id) ? 'selected' : ''; ?>>
                                            <?= $category->name; ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="brand">Thương hiệu</label>
                                <select id="brand" name="brand_id" class="form-control">
                                    <option value="">Thương hiệu</option>
                                    <?php foreach ($list_brand as $brand) : ?>
                                        <option value="<?= $brand->id; ?>" <?php echo ($row['brand_id'] == $brand->id) ? 'selected' : ''; ?>>
                                            <?= $brand->name; ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="description">Chi tiết sản phẩm</label>
                                <textarea name="detail" id="detail" class="form-control" require><?= $row['detail'] ?></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="description">Số lượng sản phẩm</label>
                                <input min="1" name="qty" type="number" id="qty" value="<?= $row['qty'] ?>" class="form-control" require></input>
                            </div>

                            <div class="mb-3">
                                <label for="description">Giá</label>
                                <input name="price" type="number" value="<?= $row['price'] ?>" id="price" class="form-control" require></input>
                            </div>
                            <div class="mb-3">
                                <label for="description">Giảm giá %</label>
                                <input name="pricesale" maxlength="3" type="number" value="<?= $row['pricesale'] ?>" id="pricesale" class="form-control" require></input>
                            </div>
                            <div class="mb-3">
                                <label for="description">Mô tả</label>
                                <textarea name="description" id="description" value="" class="form-control" require><?= $row['description'] ?></textarea>
                            </div>

                            <div class="mb-3">
                                <label for="image">Hình ảnh</label>
                                <input name="image" id="image" type="file" class="form-control">
                                <?php if (!empty($row['image'])) : ?>
                                    <img src="../public/images/product/<?= $row['image']; ?>" alt="Ảnh hiện tại" style="max-width: 100px; max-height: 100px;">
                                <?php endif; ?>
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