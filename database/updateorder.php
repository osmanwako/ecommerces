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
    header('Location:/ecommerces/orders.php');
    exit();
}

if (! is_numeric($id) || ! is_numeric($orderid)) {
    $_SESSION['error_message'] = "User ID and Order ID should be numeric values.";
    header('Location:/ecommerces/orders.php');
    exit();
}

include_once './connection.php';

try {
    if (isset($_POST['orderdelid'])) {
        $stmt = $pdo->prepare("UPDATE orders SET status = 'Declined' WHERE id = :orderid");
        $stmt->execute([':orderid' => $orderid]);

        $_SESSION['success_message'] = "Order has been successfully declined.";
        header('Location:/ecommerces/orders.php');
        exit();
    }

    $order = $pdo->prepare("SELECT * FROM orders WHERE id = :orderid");
    $order->execute([':orderid' => $orderid]);
    $order = $order->fetch(PDO::FETCH_ASSOC);

    if (! $order) {
        $_SESSION['error_message'] = "Fail to fetch company";
        header('Location:/ecommerces/orders.php');
        exit();
    }

    $product = $pdo->prepare("SELECT * FROM products WHERE id = :product_id");
    $product->execute([':product_id' => $order['product_id']]);
    $product = $product->fetch(PDO::FETCH_ASSOC);
    if (! $product) {
        $_SESSION['error_message'] = "Fail to fetch product";
        header('Location:/ecommerces/orders.php');
        exit();
    }

    if ($order['quantity'] > $product['quantity']) {
        $_SESSION['error_message'] = "An ordered Product is greater than product in stock";
        header('Location:/ecommerces/orders.php');
        exit();
    }

    $customer = $pdo->prepare("SELECT * FROM customers WHERE user_id = :user_id");
    $customer->execute([':user_id' => $order['user_id']]);
    $customer = $customer->fetch(PDO::FETCH_ASSOC);

    if (! $customer) {
        $_SESSION['error_message'] = "Fail to fetch customer";
        header('Location:/ecommerces/orders.php');
        exit();
    }

    $company = $pdo->prepare("SELECT * FROM company WHERE user_id = :company_id");
    $company->execute([':company_id' => $product['user_id']]);
    $company = $company->fetch(PDO::FETCH_ASSOC);
    if (! $company) {
        $_SESSION['error_message'] = "Fail to fetch company";
        header('Location:/ecommerces/orders.php');
        exit();
    }
    $fullname = $customer['firstname'] . " " . $customer['middlename'] . " " . $customer['lastname'];
    $pdo->beginTransaction();
    $insert = $pdo->prepare("
        INSERT INTO sales (
            order_id, company_id,company_name, company_phone, company_address,
            customer_id,customer_name, customer_phone, customer_address,
            product_name, brand, model, size,
            quantity,price,order_date
        ) VALUES (
            :order_id, :company_id,:company_name, :company_phone, :company_address,
            :customer_id,:customer_name, :customer_phone, :customer_address,
            :product_name, :brand, :model, :size,
            :quantity,:price,:order_date
        )
    ");

    $insert->execute([
        ':order_id'         => $order['id'],
        ':company_id'       => $company['user_id'],
        ':company_name'     => $company['name'],
        ':company_phone'    => $company['phone'],
        ':company_address'  => $company['address'],
        ':customer_id'      => $customer['user_id'],
        ':customer_name'    => $fullname,
        ':customer_phone'   => $customer['phone'],
        ':customer_address' => $customer['address'],
        ':product_name'     => $product['name'],
        ':brand'            => $product['brand'],
        ':model'            => $product['model'],
        ':size'             => $product['size'],
        ':quantity'         => $order['quantity'],
        ':price'            => $order['price'],
        ':order_date'       => $order['created_at'],
    ]);

    $delete = $pdo->prepare("DELETE FROM orders  WHERE id = :orderid");
    $delete->execute([':orderid' => $orderid]);
    $update = $pdo->prepare("UPDATE products SET quantity = quantity-:quantity WHERE id = :productid");
    $update->execute([':productid' => $product['id'],
        ':quantity'                    => $order['quantity'],
    ]);
    $pdo->commit();
    $_SESSION['error_message'] = "Order has been approved and recorded in sales.";
    header('Location:/ecommerces/orders.php');
    exit();

} catch (PDOException $e) {
    print_r($e->getMessage());
    exit();
    if (isset($pdo) && $pdo->inTransaction()) {
        $pdo->rollBack();
    }
    $_SESSION['error_message'] = "Error processing order: ";
}

try {
    $checktable = $pdo->query("SHOW TABLES LIKE 'sales'")->rowCount() > 0;
    if ($checktable) {
        $_SESSION['error_message'] = "Error processing order: ";
        header('Location:/ecommerces/orders.php');
        exit();
    }
    $pdo->beginTransaction();
    $pdo->exec("
        CREATE TABLE IF NOT EXISTS sales (
            id INT AUTO_INCREMENT PRIMARY KEY,
            order_id INT NOT NULL,
            company_id INT NOT NULL,
            company_name VARCHAR(255) NOT NULL,
            company_phone VARCHAR(50) NOT NULL,
            company_address VARCHAR(255) NOT NULL,
            customer_id INT NOT NULL,
            customer_name VARCHAR(255) NOT NULL,
            customer_phone VARCHAR(50) NOT NULL,
            customer_address VARCHAR(255) NOT NULL,
            product_name VARCHAR(255) NOT NULL,
            brand VARCHAR(100),
            model VARCHAR(100),
            size VARCHAR(255) NOT NULL,
            price DECIMAL(10,2) NOT NULL,
            quantity INT NOT NULL,
            order_date TIMESTAMP,
            sale_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        ) ENGINE=InnoDB
    ");
    $insert = $pdo->prepare("
        INSERT INTO sales (
            order_id,company_id,company_name, company_phone, company_address,
            customer_id,customer_name, customer_phone, customer_address,
            product_name, brand, model, size,
            quantity, price,order_date
        ) VALUES (
            :order_id, :company_id,:company_name, :company_phone, :company_address,
            :customer_id,:customer_name,:customer_phone, :customer_address,
            :product_name,:brand, :model,:size,
             :quantity,:price,:order_date
        )
    ");

    $insert->execute([
        ':order_id'         => $order['id'],
        ':company_id'       => $company['user_id'],
        ':company_name'     => $company['name'],
        ':company_phone'    => $company['phone'],
        ':company_address'  => $company['address'],
        ':customer_id'      => $customer['user_id'],
        ':customer_name'    => $fullname,
        ':customer_phone'   => $customer['phone'],
        ':customer_address' => $customer['address'],
        ':product_name'     => $product['name'],
        ':brand'            => $product['brand'],
        ':model'            => $product['model'],
        ':size'             => $product['size'],
        ':price'            => $order['price'],
        ':quantity'         => $order['quantity'],
        ':order_date'       => $order['created_at'],
    ]);

    $delete = $pdo->prepare("DELETE FROM orders WHERE id = :orderid");
    $delete->execute([':orderid' => $orderid]);
    $update = $pdo->prepare("UPDATE products SET quantity = quantity-:quantity WHERE id = :productid");
    $update->execute([':productid' => $product['id'],
        ':quantity'                    => $order['quantity'],
    ]);
    $pdo->commit();

} catch (PDOException $e) {
    print_r($e->getMessage());
    exit();
    if (isset($pdo) && $pdo->inTransaction()) {
        $pdo->rollBack();
    }
    $_SESSION['error_message'] = "Error processing order: ";
    header('Location:/ecommerces/orders.php');
    exit();
}

$_SESSION['error_message'] = "Order has been approved and recorded in sales.";
header('Location:/ecommerces/orders.php');
exit();
