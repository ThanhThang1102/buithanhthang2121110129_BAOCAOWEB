<?php

use App\Models\Product;
use App\Libraries\Mystring;

if (isset($_POST['THEM'])) {
    if (empty($_POST['name']) || empty($_POST['category_id']) || empty($_POST['brand_id']) || empty($_POST['qty']) || empty($_POST['price']) || empty($_POST['pricesale']) || empty($_POST['detail']) || empty($_POST['description']) || empty($_POST['status'])) {
        Mystring::set_flash('message', ['type' => 'danger', 'msg' => 'Vui lòng nhập đầy đủ thông tin']);
        header('location: index.php?option=product&cat=create');
        exit; // Đảm bảo dừng kịch bản sau khi chuyển hướng
    }
    $row = new Product;
    $slug = Mystring::str_slug($_POST['name']);
    $existProduct = Product::where('slug', $slug)->first();
    // var_dump($existProduct->slug);
    if ($existProduct->slug === $slug) {
        echo 'product already exists';
        Mystring::set_flash('message', ['type' => 'danger', 'msg' => 'Sản phẩm đã tồn tại']);
        header('location: index.php?option=product&cat=create');
    } else {

        $row->name = $_POST['name'];
        $row->slug = Mystring::str_slug($_POST['name']);
        $row->category_id = $_POST['category_id'];
        $row->brand_id = $_POST['brand_id'];
        $row->qty = $_POST['qty'];
        $row->price = $_POST['price'];
        $row->pricesale = $_POST['pricesale'];
        $row->detail = $_POST['detail'];
        $row->description = $_POST['description'];
        $row->status = $_POST['status'];
        $row->created_at = date('Y-m-d H:i:s');
        $row->created_by = $_SESSION['user_id'] ?? 0;
        //upload file
        $path_dir = "../public/images/product/";
        $file = $_FILES["image"];
        $path_file = $path_dir . basename($file["name"]);
        $file_extention = strtolower(pathinfo($path_file, PATHINFO_EXTENSION));
        if (in_array($file_extention, ['png', 'jpg', 'webp'])) {
            $path_file = $path_dir . $row->slug . "." . $file_extention;
            move_uploaded_file($file['tmp_name'], $path_file);
            $row->image = $row->slug . "." . $file_extention;
            $row->save();
            Mystring::set_flash('message', ['type' => 'success', 'msg' => 'Thêm thành công']);
            header('location:index.php?option=product');
        }
    }
}

if (isset($_POST['CAPNHAT'])) {

    $id = $_POST['idproduct']; // Sửa đổi thành 'idproduct'
    $row = Product::find($id);

    if ($row) {
        if (empty($_POST['name']) || empty($_POST['category_id']) || empty($_POST['brand_id']) || empty($_POST['qty']) || empty($_POST['price']) || empty($_POST['pricesale']) || empty($_POST['detail']) || empty($_POST['description']) || empty($_POST['status'])) {
            Mystring::set_flash('message', ['type' => 'danger', 'msg' => 'Vui lòng nhập đầy đủ thông tin']);
            header('location: index.php?option=Product&cat=edit&id=' . $id);
            exit;
        }

        $row->name = $_POST['name'];
        $row->slug = Mystring::str_slug($_POST['name']);
        $row->category_id = $_POST['category_id'];
        $row->brand_id = $_POST['brand_id'];
        $row->qty = $_POST['qty'];
        $row->price = $_POST['price'];
        $row->pricesale = $_POST['pricesale'];
        $row->detail = $_POST['detail'];
        $row->description = $_POST['description'];
        $row->status = $_POST['status'];
        $row->created_at = date('Y-m-d H:i:s');
        $row->created_by = $_SESSION['user_id'] ?? 0;

        //upload file
        if (strlen($_FILES["image"]["name"]) != 0) {
            $path_dir = "../public/images/Product/";
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
        header('location:index.php?option=Product');
        exit;
        echo 'co';
    } else {
        Mystring::set_flash('message', ['type' => 'danger', 'msg' => 'Sản phẩm này không tồn tại']);
        header('location: index.php?option=product&cat=edit&id=' . $id);
        exit;
    }
}
