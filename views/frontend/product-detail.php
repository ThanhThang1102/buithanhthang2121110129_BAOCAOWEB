<?php

use App\Models\Category;
use App\Models\Product;

require_once "views/frontend/header.php"; ?>

<?php

$slug = $_GET["slug"];
$check = [
   ["slug", $slug],
   ["status", "!=", 0],
];
$product = Product::where($check)->first();

$list_category_id = array();
array_push($list_category_id, $product->category_id);
$list_category1 = Category::where([['status', '=', 1], ['parent_id', '=', $product->category_id]])
   ->get();
if (count($list_category1) > 0) {
   foreach ($list_category1 as $row_cat1) {
      array_push($list_category_id, $row_cat1->id);
      $list_category2 = Category::where([['status', '=', 1], ['parent_id', '=', $row_cat1->id]])
         ->get();
      if (count($list_category2) > 0) {
         foreach ($list_category2 as $row_cat2) {
            array_push($list_category_id, $row_cat2->id);
            $list_category3 = Category::where([['status', '=', 1], ['parent_id', '=', $row_cat2->id]])
               ->get();
            if (count($list_category3) > 0) {
               foreach ($list_category3 as $row_cat3) {
                  array_push($list_category_id, $row_cat3->id);
               }
            }
         }
      }
   }
}


$product_list = Product::where([['status', '=', 1], ['slug', '!=', $product->slug]])
   ->whereIn('category_id', $list_category_id)
   ->take(8)
   ->orderBy('created_at', 'DESC')
   ->get();
?>
<section class="bg-light">
   <div class="container">
      <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
         <ol class="breadcrumb py-2 my-0">
            <li class="breadcrumb-item">
               <a class="text-main" href="index.php">Trang chủ</a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">
               Chi tiết sản phẩm
            </li>
         </ol>
      </nav>
   </div>
</section>
<section class="hdl-maincontent py-2">
   <div class="container">
      <div class="row">
         <div class="col-md-6">
            <div class="image mt-5">
               <img class="img-fluid w-50" src="public/images/product/<?= $product['image'] ?>" alt="">
            </div>
         </div>
         <div class="col-md-6">
            <h1 class="text-main">Tên sản phẩm</h1>
            <h3 class="fs-5">
               <?= $product['name'] ?>
            </h3>

            <p class="text-main">Giảm: <?= $product['pricesale'] ?> %</p>

            <?php
            // Tính giá sau khi giảm giá
            $discountedPrice = $product['price'] * (1 - ($product['pricesale'] / 100));
            ?>

            <h3 class="text-main">
               Giá:
               <del><?= number_format($product['price'], 0, ',', '.') ?> VNĐ</del>
               <?= number_format($discountedPrice, 0, ',', '.') ?> VNĐ
            </h3>
            <div class="mb-3">
               <label for="">Số lượng</label>
               <input type="number" value="1" name="qty" class="form-control" style="width:200px">
            </div>
            <div class="mb-3">
               <button class="btn btn-main" onclick="addcart(<?= $product->id; ?>)">Thêm vào giỏ hàng</button>
            </div>
         </div>
      </div>
      <div class="row">
         <h2 class="text-main fs-4 pt-4">Chi tiết sản phẩm</h2>
         <p>
            <?= $product['detail'] ?>
         </p>
      </div>
      <div class="row">
         <h2 class="text-main fs-4 pt-4">Sản phẩm khác</h2>
         <div class="product-category mt-3">
            <div class="row product-list">
               <?php foreach ($product_list as $product) : ?>
                  <div class="col-6 col-md-3 mb-4">
                     <div class="product-item border">
                        <div class="product-item-image">
                           <a href="index.php?option=product&slug=<?= $product['slug'] ?>">
                              <img src="public/images/product/<?= $product['image'] ?>" class="img-fluid" alt="" id="img1">
                              <img class="img-fluid" src="public/images/product/<?= $product['image'] ?>" alt="" id="img2">
                           </a>
                        </div>
                        <h2 class="product-item-name text-main text-center fs-5 py-1">
                           <a href="index.php?option=product&slug=<?= $product['slug'] ?>"><?= $product['name'] ?></a>
                        </h2>
                        <h3 class="product-item-price fs-6 p-2 d-flex">
                           <div class="flex-fill"><del><?= number_format($product['price'], 0, ',', '.') ?> VNĐ</del></div>
                           <div class="flex-fill text-end text-main"><?= number_format($discountedPrice, 0, ',', '.') ?> VNĐ</div>
                        </h3>
                     </div>
                  </div>
               <?php endforeach; ?>
            </div>
         </div>
      </div>
   </div>
</section>


<script>
   function addcart(id) {
      const qty = document.getElementById("qty").value;
      $.ajax({
         url: "index.php?option=cart&addcart=true",
         type: "GET",
         data: {
            id: id,
            qty: qty,
         },
         success: function(result) {
            $("#showcart").html(result);
         }
      });
   }
</script>


<?php require_once "views/frontend/footer.php"; ?>