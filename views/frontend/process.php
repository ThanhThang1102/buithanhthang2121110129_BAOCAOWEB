<?php

use App\Libraries\Mystring;
use App\Models\User;

if (isset($_POST['REGISTER'])) {
    $name = $_POST['name'];
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $gender = $_POST['gender'];
    $address = $_POST['address'];
    $roles = $_POST['roles'];
    $status = $_POST['status'];

    $user = new User;
    $user->name = $name;
    $user->username = $username;
    $user->password = $password;
    $user->email = $email;
    $user->phone = $phone;
    $user->gender = $gender;
    $user->address = $address;
    $user->roles = 0;
    $user->status = 1;
    $user->created_at = date('Y-m-d H:i:s');
    $user->image = 'hong co anh';

    $user->save();

    Mystring::set_flash('message', ['type' => 'success', 'msg' => 'Đăng ký và đăng nhập thành công']);
    header('location: index.php?option=login');
    exit;
}


