<?php
$id       = $_SESSION['user_id'] ?? '';
$name     = trim($_POST['name'] ?? '');
$brand    = trim($_POST['brand'] ?? '');
$model    = trim($_POST['model'] ?? '');
$size     = trim($_POST['size'] ?? '');
$price    = trim($_POST['price'] ?? '');
$quantity = trim($_POST['quantity'] ?? '');
$all           = [$id, $name, $brand, $model, $size, $price, $quantity];
if (in_array('', $all, true)) {
    $error_message = "All fields are required.";
}
else{
try {
    $insert = $pdo->prepare("
        INSERT INTO products (user_id, name, brand, model, size, price, quantity)
        VALUES (:user_id, :name, :brand, :model, :size, :price, :quantity)
    ");
    $insert->execute([
        ':user_id' => $id,
        ':name'       => ucfirst($name),
        ':brand'      => ucfirst($brand),
        ':model'      => ucfirst($model),
        ':size'       => $size,
        ':price'      => $price,
        ':quantity'   => $quantity,
    ]);

    $error_message = "Product added successfully";
} catch (PDOException $e) {
//    echo    $e->getMessage();
//    exit();
    $stmt = $pdo->query("SHOW TABLES LIKE 'products'");
    if ($stmt->rowCount() === 0) {
        try {
            $createTable = "
            CREATE TABLE products (
                id INT AUTO_INCREMENT PRIMARY KEY,
                user_id INT NOT NULL,
                name VARCHAR(50),
                brand VARCHAR(50),
                model VARCHAR(50),
                size VARCHAR(50),
                price DECIMAL(10,2),
                quantity INT,
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
            ) ENGINE=InnoDB;
        ";
            $pdo->exec($createTable);

            $insert = $pdo->prepare("
                INSERT INTO products (user_id, name, brand, model, size, price, quantity)
                VALUES (:user_id, :name, :brand, :model, :size, :price, :quantity)
            ");
            $insert->execute([
                ':user_id' => $id,
                ':name'       => $name,
                ':brand'      => $brand,
                ':model'      => $model,
                ':size'       => $size,
                ':price'      => $price,
                ':quantity'   => $quantity,
            ]);

            $error_message = "Product added successfully.";
        } catch (PDOException $e) {
            $error_message = "Fail to add product.";
        }
    } else {
        $error_message = "Fail to add product.";
    }

} 
}
