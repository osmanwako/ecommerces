<?php
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        include_once './database/connection.php';
        include_once './database/insertcustomer.php';
    }
    $filename="./signup/scustomer.php";
    $home=1;
    $activecustomer=1;
    include_once './home.php';

?>


