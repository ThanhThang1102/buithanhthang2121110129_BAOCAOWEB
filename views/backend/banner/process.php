<?php

use App\Models\Banner;
use App\Libraries\Mystring;

if (isset($_POST['THEM'])) {
    $row = new Banner;
    if ($row == null) {
        Mystring::set_flash('message', ['type' => 'danger', 'msg' => 'Lỗi 404']);
        header('location: index.php?option=Banner');
    }
    $row->name = $_POST['name'];
    $row->description = $_POST['description'];
    $row->status = $_POST['status'];
    $row->slug = Mystring::str_slug($_POST['name']);
    $row->created_at = date('Y-m-d H:i:s');
    $row->created_by = 1;
    //upload file
    $path_dir = "../public/images/Banner/";
    $file = $_FILES["image"];
    $path_file = $path_dir . basename($file["name"]);
    $file_extention = strtolower(pathinfo($path_file, PATHINFO_EXTENSION));
    if (in_array($file_extention, ['png', 'jpg', 'webp'])) {
        $path_file = $path_dir . $row->slug . "." . $file_extention;
        move_uploaded_file($file['tmp_name'], $path_file);
        $row->image = $row->slug . "." . $file_extention;
        $row->save();
        Mystring::set_flash('message', ['type' => 'success', 'msg' => 'Thêm thành công']);
        header('location:index.php?option=Banner');
    }
}

if (isset($_POST['CAPNHAT'])) {
    $id = $_POST['id'];
    $row = Banner::find($id);
    if ($row == null) {
        Mystring::set_flash('message', ['type' => 'danger', 'msg' => 'Lỗi 404']);
        header('location: index.php?option=Banner');
    }
    $row->name = $_POST['name'];
    $row->description = $_POST['description'];
    $row->status = $_POST['status'];
    $row->slug = Mystring::str_slug($_POST['name']);
    $row->created_at = date('Y-m-d H:i:s');
    $row->created_by = 1;

    //upload file
    if (strlen($_FILES["image"]["name"]) != 0) {
        $path_dir = "../public/images/Banner/";
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
    header('location:index.php?option=Banner');
}
