<?php

use App\Models\Category;

$mod_menu_listcategory = Category::where([['parent_id', '=', 0], ['status', '=', 1]])
   ->orderBy('sort_order', 'ASC')
   ->get();

?>
<div class="custom-dropdown-category">
   <div class="custom-dropdown-category-toggle w-100" data-bs-toggle="dropdown" aria-expanded="false">
      Danh mục sản phẩm
   </div>
   <ul class="custom-dropdown-category-menu w-100">
      <?php foreach ($mod_menu_listcategory as $rowcat) : ?>
         <li class="custom-category-item">
            <a class="custom-category-item-link" href="index.php?option=product&cat=<?php echo $rowcat->slug; ?>"><?php echo $rowcat->name; ?></a>

            <?php
            // Lấy danh sách các danh mục con của danh mục cha hiện tại
            $subcategories = Category::where('parent_id', '=', $rowcat->id)
               ->orderBy('sort_order', 'ASC')
               ->get();

            // Hiển thị danh sách danh mục con nếu có
            if ($subcategories->count() > 0) :
            ?>
               <ul class="custom-dropdown-submenu">
                  <?php foreach ($subcategories as $subcat) : ?>
                     <li class="custom-submenu-item">
                        <a class="custom-submenu-item-link" href="index.php?option=product&cat=<?php echo $subcat->slug; ?>"><?php echo $subcat->name; ?></a>
                     </li>
                  <?php endforeach; ?>
               </ul>
            <?php endif; ?>
         </li>
      <?php endforeach; ?>
   </ul>
</div>
