<?php
session_start();
$filename='./product/addproduct.php';
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    include_once './database/connection.php';
    include_once './database/insertproduct.php';
}
$product=1;
$activeproduct=1;
include_once('getcompany.php');
