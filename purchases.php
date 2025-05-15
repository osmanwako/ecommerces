<?php
session_start();
include_once './database/connection.php';
if ($_SERVER["REQUEST_METHOD"] === "POST") {
$filename='./product/saledetail.php';
include_once './database/salelist.php';
}else{
$filename='./product/sales_table.php';
include_once './database/selectsales.php';
}
$product=1;
$activepurchase=1;
include_once('./getcustomer.php');