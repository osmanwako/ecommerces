<?php
// session_start();
$filename='./login/loginpage.php';
include_once('./login/auth.php');
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    include_once './database/connection.php';
    include_once './database/checklogin.php';
}
$home=1;
$activelogin=1;
include_once('home.php');