<?php 

use App\Libraries\Cart;

$id = $_REQUEST['deletecart'];
Cart::deletecart($id);
header('location:index.php?option=cart');

?>