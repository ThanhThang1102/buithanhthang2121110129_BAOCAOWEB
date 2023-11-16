<?php
session_start();

require_once "../vendor/autoload.php";
require_once "../config/database.php";

if (!isset($_SESSION['loginadmin'])) {
    header("Location: login.php");
}

Route::route_admin();
