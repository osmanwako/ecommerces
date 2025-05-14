<?php
session_start();
if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    header('Location:/ecommerces/logout.php');
    exit();
}
$id         = $_SESSION['user_id'] ?? '';
$product_id = trim($_POST['productid'] ?? '');
$price      = trim($_POST['price'] ?? '');
$quantity   = trim($_POST['quantity'] ?? '');
if ($id == '' || $product_id == '' || $price == '' || $quantity == '') {
   $_SESSION['error_message'] = "All fields are required.";
    header('Location:/ecommerces/customer.php');
    exit();
}
if (! is_numeric($price) || ! is_numeric($quantity)) {
   $_SESSION['error_message']= "Price and quantity should be numeric value.";
    header('Location:/ecommerces/customer.php');
    exit();
}

include_once './connection.php';
$price = $price * $quantity;
try {
    $insert = $pdo->prepare("
                INSERT INTO orders (product_id, user_id, quantity, price)
                VALUES (:product_id, :user_id, :quantity, :price)
            ");

    $insert->execute([
        ':product_id' => $product_id,
        ':user_id'    => $id,
        ':quantity'   => $quantity,
        ':price'      => $price,
    ]);
    $_SESSION['error_message'] = "You have ordered product successfully!";
    header('Location: /ecommerces/customer.php');
    exit();
} catch (PDOException $e) {
    $error_message = "Internal error when inserting data ";
}

try {
    $update = $pdo->prepare("
            UPDATE orders
            SET quantity = :quantity,
                price = :price
            WHERE user_id = :user_id AND product_id = :product_id
        ");

    $update->execute([
        ':user_id'    => $id,
        ':product_id' => $product_id,
        ':quantity'   => $quantity,
        ':price'      => $price,
    ]);
    $_SESSION['error_message'] = "Your product order have updated successfully!";
    header('Location:/ecommerces/customer.php');
    exit();
} catch (PDOException $e) {
    $error_message = "Internal error when inserting data ";

}

try {

    $checktable = $pdo->query("SHOW TABLES LIKE 'orders'")->rowCount();
    if ($checktable) {
        $_SESSION['error_message'] = "You have already ordered this product!";
        header('Location:/ecommerces/customer.php');
        exit();
    }

    $pdo->exec("
    CREATE TABLE orders (
        id INT AUTO_INCREMENT PRIMARY KEY,
        product_id INT NOT NULL,
        user_id INT NOT NULL,
        quantity INT NOT NULL,
        price DECIMAL(10,2) NOT NULL,
        status VARCHAR(20) DEFAULT 'Pending',
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
        FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
        FOREIGN KEY (product_id) REFERENCES products(id) ON DELETE CASCADE,
        UNIQUE KEY unique_user_product (user_id, product_id)
    ) ENGINE=InnoDB;
");
    $insert = $pdo->prepare("
                INSERT INTO orders (product_id, user_id, quantity, price)
                VALUES (:product_id, :user_id, :quantity, :price)
            ");

    $insert->execute([
        ':product_id' => $product_id,
        ':user_id'    => $id,
        ':quantity'   => $quantity,
        ':price'      => $price,
    ]);
    $_SESSION['error_message'] = "You have ordered product successfully!";
    header('Location:/ecommerces/customer.php');
    exit();
} catch (PDOException $e) {
    $error_message = "Internal Database errors.";

}

$_SESSION['error_message'] = "Internal Database errors";
header('Location:/ecommerces/customer.php');
exit();
