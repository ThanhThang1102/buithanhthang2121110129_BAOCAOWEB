<?php
// Tính giá sau khi giảm giá
$discountedPrice = $product['price'] * (1 - ($product['pricesale'] / 100));

?>

<div class="product-item border">
    <div class="product-item-image">
        <a href="index.php?option=product&slug=<?= $product->slug; ?>">
            <img src="public/images/product/<?= $product->image; ?>" class="img-fluid" alt="<?= $product->image; ?>" id="img1">
            <img class="img-fluid" src="public/images/product/<?= $product->image; ?>" alt="<?= $product->image; ?>" id="img2">
        </a>
    </div>
    <h2 class="product-item-name text-main text-center fs-5 py-1">
        <a href="index.php?option=product&slug=<?= $product->slug; ?>"><?= $product->name; ?></a>
    </h2>
    <h3 class="product-item-price fs-6 p-2 d-flex">
        <p class="text-main">Giảm: <?= $product['pricesale'] ?> %</p>
        <div class="flex-fill"><del><?= number_format($product['price'], 0, ',', '.') ?> VNĐ</del></div>
        <div class="flex-fill text-end text-main"><?= number_format($discountedPrice, 0, ',', '.') ?> VNĐ</div>
    </h3>
</div>