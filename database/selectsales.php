<?php
session_start();
if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    header('Location:/ecommerces/logout.php');
    exit();
}

$id      = $_SESSION['user_id'] ?? '';
$orderid = trim($_POST['orderid'] ?? $_POST['orderdelid'] ?? '');

if (empty($id) || empty($orderid)) {
    $_SESSION['error_message'] = "All fields are required.";
    header('Location:/ecommerces/company.php');
    exit();
}

if (! is_numeric($id) || ! is_numeric($orderid)) {
    $_SESSION['error_message'] = "User ID and Order ID should be numeric values.";
    header('Location:/ecommerces/company.php');
    exit();
}

include_once './connection.php';

try {
    if (isset($_POST['orderdelid'])) {
        $stmt = $pdo->prepare("UPDATE orders SET status = 'Declined' WHERE id = :orderid");
        $stmt->execute([':orderid' => $orderid]);

        $_SESSION['success_message'] = "Order has been successfully declined.";
        header('Location:/ecommerces/company.php');
        exit();
    }

    $pdo->beginTransaction();
    $order = $pdo->prepare("SELECT * FROM orders WHERE id = :orderid");
    $order->execute([':orderid' => $orderid]);
    $order = $order->fetch(PDO::FETCH_ASSOC);

    if (! $order) {
        throw new Exception("Order not found");
    }

    $product = $pdo->prepare("SELECT * FROM products WHERE id = :product_id");
    $product->execute([':product_id' => $order['product_id']]);
    $product = $product->fetch(PDO::FETCH_ASSOC);
    if (! $product) {
        throw new Exception("Order not found");
    }

    $customer = $pdo->prepare("SELECT * FROM users WHERE id = :user_id");
    $customer->execute([':user_id' => $order['user_id']]);
    $customer = $customer->fetch(PDO::FETCH_ASSOC);

    if (! $customer) {
        throw new Exception("Order not found");
    }
    $company = $pdo->prepare("SELECT * FROM company WHERE id = :id");
    $company->execute([':id' => $product['user_id']]);
    $company = $company->fetch(PDO::FETCH_ASSOC);
if (! $company) {
        throw new Exception("Order not found");
    }
    $pdo->exec("
        CREATE TABLE IF NOT EXISTS sales (
            id INT AUTO_INCREMENT PRIMARY KEY,
            order_id INT NOT NULL,
            company_name VARCHAR(255) NOT NULL,
            company_phone VARCHAR(50) NOT NULL,
            company_address TEXT NOT NULL,
            customer_name VARCHAR(255) NOT NULL,
            customer_phone VARCHAR(50) NOT NULL,
            customer_address TEXT NOT NULL,
            product_name VARCHAR(255) NOT NULL,
            brand VARCHAR(100),
            model VARCHAR(100),
            size VARCHAR(50),
            total_price DECIMAL(10,2) NOT NULL,
            quantity INT NOT NULL,
            order_date TIMESTAMP,
            sale_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            FOREIGN KEY (order_id) REFERENCES orders(id)
        ) ENGINE=InnoDB
    ");

    // 6. Insert into sales table
    $insert = $pdo->prepare("
        INSERT INTO sales (
            order_id, company_name, company_phone, company_address,
            customer_name, customer_phone, customer_address,
            product_name, brand, model, size,
            total_price, quantity, order_date
        ) VALUES (
            :order_id, :company_name, :company_phone, :company_address,
            :customer_name, :customer_phone, :customer_address,
            :product_name, :brand, :model, :size,
            :total_price, :quantity, :order_date
        )
    ");

    $insert->execute([
        ':order_id'         => $order['id'],
        ':company_name'     => $company['name'],
        ':company_phone'    => $company['phone'],
        ':company_address'  => $company['address'],
        ':customer_name'    => $customer['name'],
        ':customer_phone'   => $customer['phone'],
        ':customer_address' => $customer['address'],
        ':product_name'     => $product['name'],
        ':brand'            => $product['brand'],
        ':model'            => $product['model'],
        ':size'             => $product['size'],
        ':total_price'      => $order['price'],
        ':quantity'         => $order['quantity'],
        ':order_date'       => $order['created_at'],
    ]);

    $update = $pdo->prepare("UPDATE orders SET status = 'Completed' WHERE id = :orderid");
    $update->execute([':orderid' => $orderid]);
    $pdo->commit();
    $_SESSION['error_message'] = "Order has been approved and recorded in sales.";
    header('Location:/ecommerces/company.php');
    exit();

}catch (PDOException $e) {

    
    if (isset($pdo) && $pdo->inTransaction()) {
        $pdo->rollBack();
    }
    $_SESSION['error_message'] = "Error processing order: ";
    header('Location:/ecommerces/company.php');
    exit();
}

try{
    $stmt = $pdo->query("SHOW TABLES LIKE 'products'");
    if ($stmt->rowCount() === 0) {
        //create table
    }
}catch (PDOException $e) {

    
    if (isset($pdo) && $pdo->inTransaction()) {
        $pdo->rollBack();
    }
    $_SESSION['error_message'] = "Error processing order: ";
    header('Location:/ecommerces/company.php');
    exit();
}

 $_SESSION['error_message'] = "Order has been approved and recorded in sales.";
    header('Location:/ecommerces/company.php');
    exit();
