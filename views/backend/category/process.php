<?php

use App\Models\category;
use App\Libraries\Mystring;

if (isset($_POST['THEM'])) {
    $row = new category;
    if ($row == null) {
        Mystring::set_flash('message', ['type' => 'danger', 'msg' => 'Lỗi 404']);
        header('location: index.php?option=category');
    }
    $row->name = $_POST['name'];
    $row->description = $_POST['description'];
    $row->status = $_POST['status'];
    $row->parent_id = $_POST['parent_id'];

    $row->slug = Mystring::str_slug($_POST['name']);
    $row->created_at = date('Y-m-d H:i:s');
    $row->created_by = 1;
    //upload file
    $path_dir = "../public/images/category/";
    $file = $_FILES["image"];
    $path_file = $path_dir . basename($file["name"]);
    $file_extention = strtolower(pathinfo($path_file, PATHINFO_EXTENSION));
    if (in_array($file_extention, ['png', 'jpg', 'webp'])) {
        $path_file = $path_dir . $row->slug . "." . $file_extention;
        move_uploaded_file($file['tmp_name'], $path_file);
        $row->image = $row->slug . "." . $file_extention;
        $row->save();
        Mystring::set_flash('message', ['type' => 'success', 'msg' => 'Thêm thành công']);
        header('location:index.php?option=category');
    }
}

if (isset($_POST['CAPNHAT'])) {

    $id = $_POST['idcategory'];
    $row = category::find($id);

    if ($row) {
        $row->name = $_POST['name'];
        $row->description = $_POST['description'];
        $row->parent_id = $_POST['parent_id'];
        $row->status = $_POST['status'];
        $row->slug = Mystring::str_slug($_POST['name']);
        $row->created_at = date('Y-m-d H:i:s');
        $row->created_by = 1;

        //upload file
        if (strlen($_FILES["image"]["name"]) != 0) {
            $path_dir = "../public/images/category/";
            $file = $_FILES["image"];
            $path_file = $path_dir . basename($file["name"]);
            $file_extention = strtolower(pathinfo($path_file, PATHINFO_EXTENSION));
            $path_file = $path_dir . $row->slug . "." . $file_extention;
            $path_delete = $path_dir . $row->image;
            if (file_exists($path_delete)) {
                unlink($path_delete);
            }
            move_uploaded_file($file['tmp_name'], $path_file);
            $row->image = $row->slug . "." . $file_extention;
        }
        $row->save();
        Mystring::set_flash('message', ['type' => 'success', 'msg' => 'Cập nhật thành công']);
        header('location:index.php?option=category');
        exit;
    } else {
        Mystring::set_flash('message', ['type' => 'danger', 'msg' => 'Lỗi 404']);
        header('location: index.php?option=category');
        exit;
    }
}



if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['action']) && $_POST['action'] == 'delete') {

    $selectedIds = isset($_POST['selectedIds']) ? explode(',', $_POST['selectedIds']) : [];

    if (!empty($selectedIds)) {
        foreach ($selectedIds as $id) {
            $item = Category::find($id);
            $item->status = 0;
            $item->updated_at = date('Y-m-d H:i:s');
            $item->updated_by = $_SESSION['user_id'] ?? 0; // Id của người đăng nhập
            $item->save(); //Lưu
        }
        Mystring::set_flash('message', ['type' => 'success', 'msg' => 'Xóa thành công.']);
        header('location: index.php?option=category');
        exit;
    } else {
        Mystring::set_flash('message', ['type' => 'danger', 'msg' => 'Xóa không thành công.']);
        header('location: index.php?option=category');
    }
}