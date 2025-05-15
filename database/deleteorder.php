<?php
session_start();
if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    header('Location:/ecommerces/logout.php');
    exit();
}

$id      = $_SESSION['user_id'] ?? '';
$orderid = trim($_POST['orderid'] ?? $_POST['orderdelid']);

if ($id == '' || $orderid == '') {
    $_SESSION['error_message'] = "All fields are required.";
    header('Location:/ecommerces/order.php');
    exit();
}
if (! is_numeric($orderid) || ! is_numeric($id)) {
    $_SESSION['error_message'] = "Order ID and User ID should be numeric value.";
    header('Location:/ecommerces/order.php');
    exit();
}

include_once './connection.php';

try {
    $delete = $pdo->prepare("
            DELETE FROM orders
            WHERE id = :id
        ");
    $delete->execute([':id' => $orderid]);
    if ($delete->rowCount() > 0) {
        $_SESSION['error_message'] = "You have deleted order successfully!";
    } else {
        $_SESSION['error_message'] = "Selected order does not exist!";
    }

} catch (PDOException $e) {
    $_SESSION['error_message'] = "Internal Database errors";
    header('Location:/ecommerces/order.php');
    exit();
}
header('Location:/ecommerces/order.php');
exit();
