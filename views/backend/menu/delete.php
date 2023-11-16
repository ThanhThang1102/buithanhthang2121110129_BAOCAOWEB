<?php

use App\Models\User;
use App\Libraries\Mystring;
use App\Models\Menu;

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


$id = $_REQUEST['id'];
$row = Menu::find($id);

if ($row == null) {
    Mystring::set_flash('message', ['type' => 'danger', 'msg' => 'Lỗi 404']);
    header('location:index.php?option=menu&cat=trash');
}
$row->status = 0;
$row->updated_at = date('Y-m-d H:i:s');
$row->updated_by = $_SESSION['user_id'] ?? 0; // Id của người đăng nhập
$row->save(); //Lưu
Mystring::set_flash('message', ['type' => 'success', 'msg' => 'Xóa sản phẩm <strong class="text-dark"> ' . $row->name . '</strong> thành công']);
header('location:index.php?option=menu');
