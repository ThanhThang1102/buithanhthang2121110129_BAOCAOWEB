<?php

use App\Models\Product;

$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;

$limit = 8;

$offset = ($page - 1) * $limit;

$totalProducts = Product::where('status', '!=', 0)->count();

$product_list = Product::where('status', '!=', 0)
    ->offset($offset)
    ->limit($limit)
    ->get();

?>

<?php require_once "views/frontend/header.php"; ?>
<div class="container-md">
    <section>
        <div class="row">
            <h2 class="text-main fs-4 pt-4">Tất cả Sản phẩm</h2>
            <div class="product-category mt-3">
                <div class="row product-list">
                    <?php foreach ($product_list as $product) : ?>
                        <?php
                        // Tính giá sau khi giảm giá cho từng sản phẩm
                        $discountedPrice = $product->price * (1 - ($product->pricesale / 100));
                        ?>
                        <div class="col-6 col-md-3 mb-4">
                            <div class="product-item border">
                                <div class="product-item-image">
                                    <a href="index.php?option=product&slug=<?= $product->slug ?>">
                                        <img src="public/images/product/<?= $product->image ?>" class="img-fluid" alt="" id="img1">
                                        <img class="img-fluid" src="public/images/product/<?= $product->image ?>" alt="" id="img2">
                                    </a>
                                </div>
                                <h2 class="product-item-name text-main text-center fs-5 py-1">
                                    <a href="index.php?option=product&slug=<?= $product->slug ?>"><?= $product->name ?></a>
                                </h2>
                                <h3 class="product-item-price fs-6 p-2 d-flex">
                                    <div class="flex-fill"><del><?= number_format($product->price, 0, ',', '.') ?> VNĐ</del></div>
                                    <div class="flex-fill text-end text-main"><?= number_format($discountedPrice, 0, ',', '.') ?> VNĐ</div>
                                </h3>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
        <!-- phân trang -->
        <div class="pagination justify-content-center">
            <nav aria-label="Page navigation example">
                <ul class="pagination">
                    <?php
                    $totalPages = ceil($totalProducts / $limit);
                    for ($i = 1; $i <= $totalPages; $i++) :
                    ?>
                        <li class="page-item <?= ($i == $page) ? 'active' : '' ?>">
                            <a class="page-link" href="javascript:void(0);" onclick="changePage(<?= $i ?>)"><?= $i ?></a>
                        </li>
                    <?php endfor; ?>
                </ul>
            </nav>
        </div>
        <script>
            function changePage(page) {
                window.history.replaceState(null, null, '?page=' + page);

                $.ajax({
                    url: 'ajax_product_list.php?page=' + page,
                    success: function(data) {
                        $('#product-list-container').html(data);
                    }
                });

                document.getElementById('product-list-container').innerHTML = 'Sản phẩm trang ' + page;
            }
        </script>
    </section>
</div>
<?php require_once "views/frontend/footer.php"; ?>