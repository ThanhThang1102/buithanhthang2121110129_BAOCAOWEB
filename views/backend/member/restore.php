<?php

use App\Models\User;
use App\Libraries\Mystring;


if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['action']) && $_POST['action'] == 'restore') {

    $selectedIds = isset($_POST['selectedIds']) ? explode(',', $_POST['selectedIds']) : [];

    if (!empty($selectedIds)) {
        foreach ($selectedIds as $id) {
            $item = User::find($id);
            $item->status = 1;
            $item->updated_at = date('Y-m-d H:i:s');
            $item->updated_by = $_SESSION['user_id'] ?? 0; // Id của người đăng nhập
            $item->save(); //Lưu
        }
        Mystring::set_flash('message', ['type' => 'success', 'msg' => 'Khôi phục thành công.']);
        header('location: index.php?option=member');
        exit;
    } else {
        Mystring::set_flash('message', ['type' => 'danger', 'msg' => 'Khôi phục không thành công.']);
        header('location: index.php?option=member');
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['action']) && $_POST['action'] == 'destroy') {

    $selectedIds = isset($_POST['selectedIds']) ? explode(',', $_POST['selectedIds']) : [];

    if (!empty($selectedIds)) {
        foreach ($selectedIds as $id) {
            $item = User::find($id);
            $item->delete();
        }
        Mystring::set_flash('message', ['type' => 'success', 'msg' => 'Xóa vĩnh viễn thành công.']);
        header('location: index.php?option=member&cat=trash');
        exit;
    } else {
        Mystring::set_flash('message', ['type' => 'danger', 'msg' => 'Xóa vĩnh viễn không thành công.']);
        header('location: index.php?option=member&cat=trash');
    }
}


$id = $_REQUEST['id'];
$row = User::find($id);
$row->status = 1;
$row->updated_at = date('Y-m-d H:i:s');
$row->updated_by = $_SESSION['user_id'] ?? 0;
$row->save();
Mystring::set_flash('message', ['type' => 'success', 'msg' => 'Khôi phục thành công']);
header('location:index.php?option=member&cat=trash');
