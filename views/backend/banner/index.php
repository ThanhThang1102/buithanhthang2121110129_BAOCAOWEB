<?php

use App\Models\Banner;

$list = Banner::where('status', '!=', '0')->orderBy('created_at', 'DESC')->get();
?>

<?php require_once('../views/backend/header.php') ?>
<!-- CONTENT -->
<form action="index.php?option=Banner&cat=process" method="post" enctype="multipart/form-data">
   <div class="content-wrapper" style="min-height: 576.281px;">
      <section class="content-header">
         <div class="container-fluid">
            <div class="row mb-2">
               <div class="col-sm-12">
                  <h1 class="d-inline">Tất cả thương hiệu</h1>
               </div>
            </div>
         </div>
      </section>
      <!-- Main content -->
      <section class="content">
         <div class="card">
            <div class="card-header">
               <div class="row">
                  <div class="col-md-6">
                     <a href="index.php?option=Banner&cat=trash">Thùng rác</a>
                  </div>
                  <div class="col-md-6 text-right">
                     <button class="btn btn-sm btn-success" type="submit" name="THEM">
                        <i class="fa fa-save" aria-hidden="true"></i>
                        Lưu
                     </button>
                  </div>
               </div>
            </div>
            <!-- <?php include_once('../views/backend/message.php'); ?> -->
            <div class="card-body">
               <div class="row">
                  <div class="col-md-4">
                     <div class="mb-3">
                        <label>Tên thương hiệu (*)</label>
                        <input type="text" name="name" class="form-control">
                     </div>
                     <div class="mb-3">
                        <label>Slug</label>
                        <input type="text" name="slug" class="form-control">
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
                     <table class="table table-bordered">
                        <thead>
                           <tr>
                              <th class="text-center" style="width:30px;">
                                 <input type="checkbox">
                              </th>
                              <th class="text-center" style="width:130px;">Hình ảnh</th>
                              <th>Tên thương hiệu</th>
                              <th>Tên slug</th>
                           </tr>
                        </thead>
                        <tbody>
                           <?php foreach ($list as $item) : ?>
                              <tr class="datarow">
                                 <td>
                                    <input type="checkbox">
                                 </td>
                                 <td>
                                    <img App="../public/images/Banner/<?= $item['image'] ?>" alt="Banner.jpg">
                                 </td>
                                 <td>
                                    <div class="name">
                                       <?php echo $item->name; ?>
                                    </div>
                                    <div class="function_style">
                                       <?php if ($item->status == 1) : ?>
                                          <a class="text-sucess" href="index.php?option=Banner&cat=status&id=<?= $item->id; ?>"> <i class="fas fa-toggle-on"></i> Hiện</a> |
                                       <?php else : ?>
                                          <a class="text-danger" href="index.php?option=Banner&cat=status&id=<?= $item->id; ?>"> <i class="fas fa-toggle-off"></i> Ẩn</a> |
                                       <?php endif; ?>

                                       <a class="text-info" href="index.php?option=Banner&cat=edit&id=<?= $item->id; ?>"> <i class="fas fa-edit"></i> Chỉnh sửa</a> |

                                       <a class="text-info" href="index.php?option=Banner&cat=show&id=<?= $item->id; ?>"> <i class="fas fa-eye"></i> Chi tiết</a> |

                                       <a class="text-danger" href="index.php?option=Banner&cat=delete&id=<?= $item->id; ?>"><i class="fas fa-trash"> </i> Xoá</a>
                                    </div>
                                 </td>
                                 <td> <?php echo $item->slug; ?></td>
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