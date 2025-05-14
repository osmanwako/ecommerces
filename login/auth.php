<?php
session_start();

if (isset($_SESSION['user_id'],$_SESSION['role'], $_SESSION['login_time'])) {
    $currenttime = time();
    $logindelay = strtotime($_SESSION['login_time']); 
    $delayedminute = ($currenttime - $logindelay) / 60; 
    if ($delayedminute < 30) {
        $_SESSION['login_time'] = date('Y-m-d H:i:s');
        if ($_SESSION['role'] === 'company') {
            header('Location: ./company.php');
            exit();
        } 
        if ($_SESSION['role'] === 'customer') {
            header('Location: ./customer.php');
            exit();
        } 
    }
        session_unset();
        session_destroy();
}
?>
