<?php require_once "views/frontend/header.php"; ?>

<section class="bg-light">
   <div class="container">
      <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
         <ol class="breadcrumb py-2 my-0">
            <li class="breadcrumb-item">
               <a class="text-main" href="index.html">Trang chủ</a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">Thông tin tài khoản</li>
         </ol>
      </nav>
   </div>
</section>
<section class="hdl-maincontent py-2">
   <div class="container">
      <div class="row">
         <div class="col-md-3 order-2 order-md-1">
            <ul class="list-group mb-3 list-category">
               <li class="list-group-item bg-main py-3">Thông tin tài khoản</li>
               <li class="list-group-item">
                  <a href="profile.html">Thông tin tài khoản</a>
               </li>
            </ul>
         </div>
         <div class="col-md-9 order-1 order-md-2">
            <h1 class="fs-2 text-main">Thông tin tài khoản</h1>
            <table class="table table-borderless">
               <tr>
                  <td style="width:20%;">Tên tài khoản</td>
                  <td>Hồ Diên Lợi</td>
               </tr>
               <tr>
                  <td style="width:20%;">Tên đăng nhập</td>
                  <td>hodienloi</td>
               </tr>
               <tr>
                  <td style="width:20%;">Email</td>
                  <td>dienloisoft@gmail.com</td>
               </tr>
               <tr>
                  <td style="width:20%;">Điện thoại</td>
                  <td>0987654321</td>
               </tr>
               <tr>
                  <td style="width:20%;">Địa chỉ</td>
                  <td>Số 20 - Tăng Nhơn Phú - Phước Long B - Quận 9 </td>
               </tr>
            </table>
         </div>
      </div>
   </div>
</section>
<?php require_once "views/frontend/footer.php"; ?>