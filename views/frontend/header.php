<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Trang chủ</title>
   <link rel="stylesheet" href="public/bootstrap/css/bootstrap.min.css">
   <link rel="stylesheet" href="public/fontawesome/css/all.min.css">
   <link rel="stylesheet" href="public/css/frontend.css">
   <link rel="stylesheet" href="public/css/nav.css">
   <script src="public/bootstrap/js/bootstrap.bundle.min.js"></script>
</head>

<body>
   <section class="hdl-header">
      <div class="container">
         <div class="row">
            <div class="col-6 col-sm-6 col-md-2 py-1">
               <a href="index.php">
                  <img src="public/images/logo2.jpg" class="img-fluid" alt="Logo">
               </a>
            </div>
            <div class="col-12 col-sm-9 d-none d-md-block col-md-5 py-3">
               <form action="index.php?option=search" method="post">
                  <div class="input-group mb-3">
                     <input type="text" class="form-control" name="keyword" placeholder="Nhập nội dung tìm kiếm" aria-label="Recipient's username" aria-describedby="basic-addon2">
                     <button type="submit" name="SEARCH" class="input-group-text bg-main" id="basic-addon2">
                        <i class="fa fa-search" aria-hidden="true"></i>
                     </button>
                  </div>
               </form>

            </div>

            <div class="col-12 col-sm-12 d-none d-md-block col-md-4 text-center py-2">
               <div class="call-login--register border-bottom">
                  <ul class="nav nav-fill py-0 my-0">
                     <li class="nav-item">
                        <a class="nav-link" href="tel:0987654321">
                           <i class="fa fa-phone-square" aria-hidden="true"></i>
                           0987654321
                        </a>
                     </li>

                     <?php if (!isset($_SESSION['loginsite'])) : ?>
                        <li class="nav-item">
                           <a class="nav-link" href="index.php?option=login">Đăng nhập</a>
                        </li>
                        <li class="nav-item">
                           <a class="nav-link" href="index.php?option=register">Đăng ký</a>
                        </li>
                     <?php else : ?>
                        <li class="nav-item">
                           <a class="nav-link" href="index.php?option=profile"><?= $_SESSION['user_name'] ?? '' ?></a>
                        </li>
                        <?php
                        if (isset($_POST['LOGOUT'])) {
                           session_destroy();
                           header("Location: index.php");
                           exit;
                        }
                        ?>
                        <li class="nav-item">
                           <form method="post" action="">
                              <button type="submit" class="btn btn-link nav-link" name="LOGOUT">
                                 <i class="fas fa-power-off"></i>
                                 Đăng xuất
                              </button>
                           </form>
                        </li>
                     <?php endif; ?>
                  </ul>

               </div>
               <div class="fs-6 py-2">
                  ĐỔI TRẢ HÀNG HOẶC HOÀN TIỀN <span class="text-main">TRONG 3 NGÀY</span>
               </div>
            </div>
            <div class="col-6 col-sm-6 col-md-1 text-end py-4 py-md-2">
               <a href="index.php?option=cart">
                  <div class="box-cart float-end">
                     <i class="fa fa-shopping-bag" aria-hidden="true"></i>
                     <span id="showcart">
                        <?php echo isset($_SESSION['cart']) ? count($_SESSION['cart']) : 0;  ?>
                     </span>
                  </div>
               </a>
            </div>
         </div>
      </div>
   </section>
   <section class="hdl-mainmenu bg-main">
      <div class="container">
         <div class="row">
            <div class="col-12 d-none d-md-block col-md-2 d-none d-md-block">
               <?php require_once 'views/frontend/mod-menu-listcategory.php'; ?>
            </div>
            <div class="col-12 col-md-9">
               <?php require_once 'views/frontend/mod-mainmenu.php'; ?>
            </div>
         </div>
      </div>
   </section>