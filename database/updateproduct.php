<?php
session_start();
if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    header('Location:/ecommerces/logout.php');
    exit();
}

$id         = $_SESSION['user_id'] ?? '';
$product_id = trim($_POST['productid'] ?? $_POST['productdelid']);
$price      = trim($_POST['price'] ?? '');
$quantity   = trim($_POST['quantity'] ?? '');

if ($id == '' || $product_id == '' || $price == '' || $quantity == '') {
    $_SESSION['error_message'] = "All fields are required.";
    header('Location:/ecommerces/company.php');
    exit();
}
if (! is_numeric($price) || ! is_numeric($quantity)) {
    $_SESSION['error_message'] = "Price and quantity should be numeric value.";
    header('Location:/ecommerces/company.php');
    exit();
}

include_once './connection.php';

try {
    if (isset($_POST['productdelid'])) {
        $delete = $pdo->prepare("
            DELETE FROM products
            WHERE user_id = :user_id AND id = :product_id
        ");

        $delete->execute([
            ':user_id'    => $id,
            ':product_id' => $product_id,
        ]);
        $_SESSION['error_message'] = "You have deleted product successfully!";
        header('Location:/ecommerces/company.php');
        exit();
    }
    $update = $pdo->prepare("
            UPDATE products
            SET quantity = :quantity,
                price = :price
            WHERE user_id = :user_id AND id = :product_id
        ");

    $update->execute([
        ':user_id'    => $id,
        ':product_id' => $product_id,
        ':quantity'   => $quantity,
        ':price'      => $price,
    ]);

    $_SESSION['error_message'] = "You have updated the product successfully!";
    header('Location:/ecommerces/company.php');
    exit();
} catch (PDOException $e) {
    $error_message = "Internal error when inserting data ";
}
$_SESSION['error_message'] = "Internal Database errors";
header('Location:/ecommerces/company.php');
exit();
