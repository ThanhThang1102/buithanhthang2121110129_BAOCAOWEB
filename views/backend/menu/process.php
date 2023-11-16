<?php

use App\Libraries\Mystring;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Menu;
use App\Models\Post;
use App\Models\Topic;

if (isset($_POST['ADDCATEGORY'])) {

    $list_id = $_POST['checkIdCategory'];

    foreach ($list_id as $id) {
        $category = Category::find($id);
        $menu = new Menu();
        $menu->name = $category->name;
        $menu->link = $category->slug;
        $menu->table_id = $id;
        $menu->parent_id = 0;
        $menu->sort_order = 1;
        $menu->type = 'category';
        $menu->position = $_POST['position'];
        $menu->status = $category->status;
        $menu->created_at = date('Y-m-d H:i:s');
        $menu->created_by = $_SESSION['user_id'] ?? 0;
        $menu->save();
    }
    Mystring::set_flash('message', ['type' => 'success', 'msg' => 'Thêm menu danh mục thành công']);
    header('location:index.php?option=menu');
}

if (isset($_POST['ADDRAND'])) {
    $list_id = $_POST['checkIdBrand'];

    foreach ($list_id as $id) {
        $brand = Brand::find($id);
        $menu = new Menu();
        $menu->name = $brand->name;
        $menu->link = $brand->slug;
        $menu->table_id = $id;
        $menu->parent_id = 0;
        $menu->sort_order = 1;
        $menu->type = 'brand';
        $menu->position = $_POST['position'];
        $menu->status = $brand->status;
        $menu->created_at = date('Y-m-d H:i:s');
        $menu->created_by = $_SESSION['user_id'] ?? 0;
        $menu->save();
    }
    Mystring::set_flash('message', ['type' => 'success', 'msg' => 'Thêm menu thương hiệu thành công']);
    header('location:index.php?option=menu');
}

if (isset($_POST['ADDTOPIC'])) {
    $list_id = $_POST['checkIdTopic'];

    foreach ($list_id as $id) {
        $topic = Topic::find($id);
        $menu = new Menu();
        $menu->name = $topic->name;
        $menu->link = $topic->slug;
        $menu->table_id = $id;
        $menu->parent_id = 0;
        $menu->sort_order = 1;
        $menu->type = 'topic';
        $menu->position = $_POST['position'];
        $menu->status = $topic->status;
        $menu->created_at = date('Y-m-d H:i:s');
        $menu->created_by = $_SESSION['user_id'] ?? 0;
        $menu->save();
    }
    Mystring::set_flash('message', ['type' => 'success', 'msg' => 'Thêm menu chủ đề thành công']);
    header('location:index.php?option=menu');
}

if (isset($_POST['ADDPOST'])) {
    $list_id = $_POST['checkIdPost'];

    foreach ($list_id as $id) {
        $post = Post::find($id);
        $menu = new Menu();
        $menu->name = $post->title;
        $menu->link = $post->slug;
        $menu->table_id = $id;
        $menu->parent_id = 0;
        $menu->sort_order = 1;
        $menu->type = 'post';
        $menu->position = $_POST['position'];
        $menu->status = $post->status;
        $menu->created_at = date('Y-m-d H:i:s');
        $menu->created_by = $_SESSION['user_id'] ?? 0;
        $menu->save();
    }
    Mystring::set_flash('message', ['type' => 'success', 'msg' => 'Thêm menu bài viết thành công']);
    header('location:index.php?option=menu');
}

if (isset($_POST['ADDCUSTOM'])) {
    $menu = new Menu();
    $menu->name = $_POST['name'];
    $menu->link = $_POST['link'];
    $menu->type = 'custom';
    $menu->parent_id = 0;
    $menu->sort_order = 1;
    $menu->position = $_POST['position'];
    $menu->status = 1;
    $menu->created_at = date('Y-m-d H:i:s');
    $menu->created_by = $_SESSION['user_id'] ?? 0;
    $menu->save();
    Mystring::set_flash('message', ['type' => 'success', 'msg' => 'Thêm menu tùy chỉnh thành công']);
    header('location:index.php?option=menu');
}


if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['action']) && $_POST['action'] == 'delete') {

    $selectedIds = isset($_POST['selectedIds']) ? explode(',', $_POST['selectedIds']) : [];

    if (!empty($selectedIds)) {
        foreach ($selectedIds as $id) {
            $item = Menu::find($id);
            $item->status = 0;
            $item->updated_at = date('Y-m-d H:i:s');
            $item->updated_by = $_SESSION['user_id'] ?? 0; // Id của người đăng nhập
            $item->save(); //Lưu
        }
        Mystring::set_flash('message', ['type' => 'success', 'msg' => 'Xóa thành công.']);
        header('location: index.php?option=menu');
        exit;
    } else {
        Mystring::set_flash('message', ['type' => 'danger', 'msg' => 'Xóa không thành công.']);
        header('location: index.php?option=menu');
    }
}