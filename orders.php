<?php
session_start();
if (isset($_SESSION["error_message"])) {
    $error_message = $_SESSION["error_message"];
    unset($_SESSION["error_message"]);
}
$filename='./order/order_table.php';
$address="./database/updateorder.php";
include_once './database/connection.php';
include_once './database/selectorder.php';
$product=1;
$activeorder=1;
include_once('./getcompany.php');