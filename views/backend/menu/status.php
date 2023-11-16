<?php

use App\Libraries\Mystring;
use App\Models\Menu;

$id = $_REQUEST['id'];
$row = Menu::find($id);

if ($row == null) {
    Mystring::set_flash('message', ['type' => 'danger', 'msg' => 'Lỗi 404']);
    header('location: index.php?option=menu');
}

$row->status = ($row['status'] == 1) ? 2 : 1;
$row->updated_at = date('Y-m-d H:i:s');
$row->updated_by = $_SESSION['user_id'] ?? 0;
$row->save();
Mystring::set_flash('message', ['type' => 'success', 'msg' => 'Thay đổi trạng thái thành công']);
header('location: index.php?option=menu');
