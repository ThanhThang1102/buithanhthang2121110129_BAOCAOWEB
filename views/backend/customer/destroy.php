<?php

use App\Libraries\Mystring;
use App\Models\User;

$id = $_REQUEST['id'];
$row = User::find($id);
if ($row == null) {
    Mystring::set_flash('message', ['type' => 'danger', 'msg' => 'Lỗi trang 404']);
    header('location:index.php?option=customer&cat=trash');
}
$row->delete();
Mystring::set_flash('message', ['type' => 'success', 'msg' => 'Xóa vĩnh viễn thành công']);
header('location:index.php?option=customer&cat=trash');
