<?php
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        include_once './database/connection.php';
        include_once './database/insertcompany.php';
    }
    $filename="./signup/scompany.php";
    $home=1;
    $activecompany=1;
    include_once './home.php';

?>