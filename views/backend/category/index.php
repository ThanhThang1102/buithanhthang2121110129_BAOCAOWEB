<?php

use App\Models\Category;

$list = Category::where('status', '!=', '0')->orderBy('created_at', 'DESC')->get();
$countTrash = Category::where('status', '=', 0)->count();

?>

<?php require_once('../views/backend/header.php') ?>
<!-- CONTENT -->
<form action="index.php?option=category&cat=process" method="post" enctype="multipart/form-data">
   <div class="content-wrapper" style="min-height: 576.281px;">
      <section class="content-header">
         <div class="container-fluid">
            <div class="row mb-2">
               <div class="col-sm-12">
                  <h1 class="d-inline">Tất cả danh mục</h1>
               </div>
            </div>
         </div>
      </section>
      <!-- Main content -->
      <section class="content">
         <div class="card">
            <div class="card-header">
               <div class="row">
                  <div class="col-12">
                     <select name="action" class="form-control d-inline" style="width:100px;">
                        <option value="delete">Xoá</option>
                     </select>
                     <input type="hidden" id="selectedIds" name="selectedIds" value="">
                     <button type="submit" class="btn btn-sm btn-success">Áp dụng</button>
                     <a href="index.php?option=category&cat=trash" class="btn btn-sm btn-danger">Thùng rác <span>(<?= $countTrash ?>)</span> </a>
                  </div>
               </div>
               <div class="row">
                  <div class="col-md-12 text-right">
                     <button class="btn btn-sm btn-success" type="submit" name="THEM">
                        <i class="fa fa-save" aria-hidden="true"></i>
                        Lưu
                     </button>
                  </div>
               </div>
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
               <div class="row">
                  <div class="col-md-4">
                     <div class="mb-3">
                        <label>Tên danh mục (*)</label>
                        <input type="text" name="name" class="form-control">
                     </div>
                     <div class="mb-3">
                        <label for="category">Danh mục cha</label>
                        <select id="category" name="parent_id" class="form-control">
                           <option value="0">Danh mục cha</option>
                           <?php foreach ($list as $category) : ?>
                              <option value="<?= $category->id; ?>">
                                 <?= $category->name; ?>
                              </option>
                           <?php endforeach; ?>
                        </select>
                     </div>
                     <div class="mb-3">
                        <label>Mô tả</label>
                        <input type="text" name="description" class="form-control">
                     </div>
                     <div class="mb-3">
                        <label>Hình đại diện</label>
                        <input type="file" name="image" class="form-control">
                     </div>
                     <div class="mb-3">
                        <label>Trạng thái</label>
                        <select name="status" class="form-control">
                           <option value="1">Xuất bản</option>
                           <option value="2">Chưa xuất bản</option>
                        </select>
                     </div>
                  </div>
                  <div class="col-md-8">
                     <table class="table table-bordered" id="myTable">
                        <thead>
                           <tr>
                              <th class="text-center" style="width:30px;">
                                 <input type="checkbox" class="select-all">
                              </th>
                              <th class="text-center" style="width:130px;">Hình ảnh</th>
                              <th>Tên thương hiệu</th>
                              <th>Tên slug</th>
                              <th>id</th>
                              <th>parent id</th>
                           </tr>
                        </thead>
                        <tbody>
                           <?php foreach ($list as $item) : ?>
                              <tr class="datarow">
                                 <td>
                                    <input type="checkbox" class="select-item" data-id="<?= $item['id']; ?>">
                                 </td>
                                 <td>
                                    <img src="../public/images/category/<?= $item['image'] ?>" alt="<?= $item['image'] ?>" width="50">
                                 </td>
                                 <td>
                                    <div class="name">
                                       <?php echo $item->name; ?>
                                    </div>
                                    <div class="function_style">
                                       <?php if ($item->status == 1) : ?>
                                          <a class="text-sucess" href="index.php?option=category&cat=status&id=<?= $item->id; ?>"> <i class="fas fa-toggle-on"></i> Hiện</a> |
                                       <?php else : ?>
                                          <a class="text-danger" href="index.php?option=category&cat=status&id=<?= $item->id; ?>"> <i class="fas fa-toggle-off"></i> Ẩn</a> |
                                       <?php endif; ?>

                                       <a class="text-info" href="index.php?option=category&cat=edit&id=<?= $item->id; ?>"> <i class="fas fa-edit"></i> Chỉnh sửa</a> |

                                       <a class="text-info" href="index.php?option=category&cat=show&id=<?= $item->id; ?>"> <i class="fas fa-eye"></i> Chi tiết</a> |

                                       <a class="text-danger" href="index.php?option=category&cat=delete&id=<?= $item->id; ?>"><i class="fas fa-trash"> </i> Xoá</a>
                                    </div>
                                 </td>
                                 <td> <?php echo $item->slug; ?></td>
                                 <td> <?php echo $item->id; ?></td>
                                 <td> <?php echo $item->parent_id; ?></td>
                              </tr>
                           <?php endforeach; ?>
                        </tbody>
                     </table>
                  </div>
               </div>
            </div>
         </div>
      </section>
   </div>
</form>
<!-- END CONTENT-->

<?php require_once('../views/backend/footer.php') ?>