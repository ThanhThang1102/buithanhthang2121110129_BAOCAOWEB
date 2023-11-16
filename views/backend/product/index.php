<?php

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;

$list = Product::where('status', '!=', 0)
   ->select('status', 'category_id', 'brand_id', 'id', 'image', 'name', 'slug')
   ->orderBy('created_at', 'DESC')
   ->get();

$list_category = Category::where('status', '!=', '0')->orderBy('created_at', 'DESC')->get();
$list_brand = Brand::where('status', '!=', '0')->orderBy('created_at', 'DESC')->get();

$countTrash = Product::where('status', '=', 0)->count();

?>



<?php require_once '../views/backend/header.php'; ?>
<!-- CONTENT -->
<div class="content-wrapper">
   <section class="content-header">
      <div class="container-fluid">
         <div class="row mb-2">
            <div class="col-sm-12">
               <h1 class="d-inline">Tất cả sản phẩm</h1>
               <a href="index.php?option=product&cat=create" class="btn btn-sm btn-primary">Thêm sản phẩm</a>
            </div>
         </div>
      </div>
   </section>
   <!-- Main content -->
   <section class="content">
      <div class="card">
         <div class="card-header">
            <form action="index.php?option=product&cat=delete" method="post">
               <select name="action" class="form-control d-inline" style="width:100px;">
                  <option value="delete">Xoá</option>
               </select>
               <input type="hidden" id="selectedIds" name="selectedIds" value="">
               <button type="submit" class="btn btn-sm btn-success">Áp dụng</button>
               <a href="index.php?option=product&cat=trash" class="btn btn-sm btn-danger">Thùng rác <span>(<?= $countTrash ?>)</span></a>
            </form>
         </div>
         <?php if (isset($_SESSION["message"])) : ?>
            <div class="alert alert-<?php echo $_SESSION["message"]["type"]; ?>">
               <?php echo $_SESSION["message"]["msg"]; ?>
            </div>

            <?php
            unset($_SESSION["message"]);
            ?>
         <?php endif; ?>
         <div class="card-body">
            <table class="table table-bordered display" id="myTable">
               <thead>
                  <tr>
                     <th class="text-center" style="width:30px;">
                        <input type="checkbox" class="select-all">
                     </th>
                     <th class="text-center" style="width:130px;">Hình ảnh</th>
                     <th>Tên sản phẩm</th>
                     <th>Tên danh mục</th>
                     <th>Tên thương hiệu</th>
                     <th class="text-center">Thao tác</th>
                  </tr>
               </thead>
               <tbody>
                  <?php if (count($list) > 0) : ?>
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
                                 <?= $item['name']; ?>
                              </div>
                           </td>
                           <td>
                              <?php
                              $category = $list_category->where('id', $item['category_id'])->first();
                              echo $category ? $category->name : 'Không có';
                              ?>
                           </td>
                           <td>
                              <?php
                              $brand = $list_brand->where('id', $item['brand_id'])->first();
                              echo $brand ? $brand->name : 'Không có';
                              ?>
                           </td>
                           <td>
                              <div class="function_style">
                                 <?php if ($item['status'] == 1) : ?>
                                    <a class="text-success" href="index.php?option=product&cat=status&id=<?= $item['id']; ?>">Hiện</a> |
                                 <?php else : ?>
                                    <a class="text-danger" href="index.php?option=product&cat=status&id=<?= $item['id']; ?>">Ẩn</a> |
                                 <?php endif; ?>
                                 <a href="index.php?option=product&cat=show&id=<?= $item['id']; ?>">Chi tiết</a> |
                                 <a href="index.php?option=product&cat=delete&id=<?= $item['id']; ?>">Xoá</a>
                              </div>
                           </td>
                        </tr>
                     <?php endforeach; ?>
                  <?php endif; ?>
               </tbody>
            </table>

         </div>
      </div>
   </section>
</div>
<!-- END CONTENT-->
<?php require_once '../views/backend/footer.php'; ?>