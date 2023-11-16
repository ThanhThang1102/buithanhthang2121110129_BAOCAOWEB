<?php

use App\Models\Category;
use App\Libraries\Mystring;

$id = $_REQUEST['id'];
$row = Category::find($id);
if ($row == null) {
    Mystring::set_flash('message', ['type' => 'danger', 'msg' => 'Lỗi trang 404']);
    header('location:index.php?option=category&cat=trash');
}
$row->delete();
Mystring::set_flash('message', ['type' => 'success', 'msg' => 'Xóa vĩnh viễn thành công']);
header('location:index.php?option=category&cat=trash');
