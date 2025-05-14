<?php
if (empty($_SESSION['user_id']) || empty($_SESSION['role']) || empty($_SESSION['login_time'])) {
    header('Location: ./logout.php');
    exit();
}

if ($_SESSION['role'] !== 'customer') {
    header('Location: ./logout.php');
    exit();
}

$currentTimestamp = time();
$loginTimestamp = strtotime($_SESSION['login_time']);
$sessionDurationMinutes = ($currentTimestamp - $loginTimestamp) / 60;

if ($sessionDurationMinutes > 30) {
    header('Location: ./logout.php');
    exit();
}

$_SESSION['login_time'] = date('Y-m-d H:i:s');

?>