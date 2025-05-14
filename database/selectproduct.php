<?php

    $id = $_SESSION['user_id'] ?? '';
    $role = $_SESSION['role'] ?? '';
    $name ="Company: ".($_SESSION['name'] ?? '');
    $name="{$name}'s Products";
    $title = "Edit Selected Product";
    $update = "Update";

if ($role=='customer') {
    $name="Customer: ".$_SESSION['firstname']. ' '.$_SESSION['middlename'].' '. $_SESSION['lastname'];
    $title = "Selected Product Order";
    $update = "Order";
}

try {
    if ($role === 'customer') {
        $stmt = $pdo->prepare("SELECT * FROM products WHERE quantity > 0 ORDER BY LOWER(name)");
        $stmt->execute();
    } else {
        
        $stmt = $pdo->prepare("SELECT * FROM products WHERE user_id = :id ORDER BY LOWER(name)");
        $stmt->execute([':id' => $id]);
    }
    
    $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
} catch (PDOException $e) {
    $error_message = "Internal database error: " . $e->getMessage();
}
?>