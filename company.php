<?php
session_start();
if (isset($_SESSION["error_message"])) {
    $error_message = $_SESSION["error_message"];
    unset($_SESSION["error_message"]);
}
$filename='./product/product_table.php';
$address="./database/updateproduct.php";
include_once './database/connection.php';
include_once './database/selectproduct.php';
include_once('./getcompany.php');