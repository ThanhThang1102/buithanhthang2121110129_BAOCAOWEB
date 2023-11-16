<?php

use App\Libraries\Mystring;
use App\Models\User;

if (isset($_POST['THEM'])) {

    $name = $_POST['name'];
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Hash the password
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $gender = $_POST['gender'];
    $address = $_POST['address'];
    $roles = $_POST['roles'];
    $status = $_POST['status'];

    $existUserName = User::where('username', $username)->first();
    if ($existUserName) {
        Mystring::set_flash('message', ['type' => 'danger', 'msg' => 'Username đã tồn tại']);
        header('location: index.php?option=customer&cat=create');
        exit;
    }

    $existUserEmail = User::where('email', $email)->first();
    if ($existUserEmail) {
        Mystring::set_flash('message', ['type' => 'danger', 'msg' => 'Email đã tồn tại']);
        header('location: index.php?option=customer&cat=create');
        exit;
    }

    $user = new User;
    $user->name = $name;
    $user->username = $username;
    $user->password = $password;
    $user->email = $email;
    $user->phone = $phone;
    $user->gender = $gender;
    $user->address = $address;
    $user->roles = $roles;
    $user->status = $status;
    $user->created_at = date('Y-m-d H:i:s');
    $user->created_by = $_SESSION['user_id'] ?? 0;

    $path_dir = "../public/images/user/";
    $file = $_FILES["image"];
    $path_file = $path_dir . basename($file["name"]);
    $file_extension = strtolower(pathinfo($path_file, PATHINFO_EXTENSION));

    if (in_array($file_extension, ['png', 'jpg', 'webp'])) {
        $path_file = $path_dir . $user->username . "." . $file_extension;
        move_uploaded_file($file['tmp_name'], $path_file);
        $user->image = $user->username . "." . $file_extension;
        $user->save();
        Mystring::set_flash('message', ['type' => 'success', 'msg' => 'Thêm thành công']);
        header('location:index.php?option=customer');
        exit;
    }
}



if (isset($_POST['CAPNHAT'])) {
    $id = $_POST['idcustomer'];
    $row = User::find($id);

    if ($row) {
        if (empty($_POST['password'])) {
            Mystring::set_flash('message', ['type' => 'danger', 'msg' => 'Vui lòng nhập mật khẩu mới']);
            header('location: index.php?option=customer&cat=edit&id=' . $id);
            exit;
        }

        $row->name = $_POST['name'];
        $row->username = $_POST['username'];
        $row->password = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $row->email = $_POST['email'];
        $row->phone = $_POST['phone'];
        $row->address = $_POST['address'];
        $row->gender = $_POST['gender'];
        $row->roles = $_POST['roles'];
        $row->status = $_POST['status'];
        $row->created_at = date('Y-m-d H:i:s');
        $row->created_by = $_SESSION['user_id'] ?? 0;

        if (strlen($_FILES["image"]["name"]) != 0) {
            $path_dir = "../public/images/user/";
            $file = $_FILES["image"];
            $path_file = $path_dir . basename($file["name"]);
            $file_extension = strtolower(pathinfo($path_file, PATHINFO_EXTENSION));
            $path_file = $path_dir . $row->username . "." . $file_extension;
            $path_delete = $path_dir . $row->image;
            if (file_exists($path_delete)) {
                unlink($path_delete);
            }
            move_uploaded_file($file['tmp_name'], $path_file);
            $row->image = $row->username . "." . $file_extension;
        }

        $row->save();
        Mystring::set_flash('message', ['type' => 'success', 'msg' => 'Cập nhật thành công']);
        header('location:index.php?option=customer');
        exit;
    } else {
        Mystring::set_flash('message', ['type' => 'danger', 'msg' => 'Khách hàng này không tồn tại']);
        header('location: index.php?option=customer&cat=edit&id=' . $id);
        exit;
    }
}
