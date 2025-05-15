<?php

$id = $_SESSION['user_id'] ?? '';
$role = $_SESSION['role'] ?? '';
$name = "Company: " . ($_SESSION['name'] ?? '');
$name = "{$name}'s Products";
$title = "Are you sure to replay order?";
$update = "Decline";

if ($role == 'customer') {
    $name = "Customer: " . ($_SESSION['firstname'] ?? '') . ' ' . 
            ($_SESSION['middlename'] ?? '') . ' ' . 
            ($_SESSION['lastname'] ?? '');
    $title = "Are you sure to remove order?";
    $update = "Delete";
}

try {
    if ($role === 'company') {
        $stmt = $pdo->prepare("
            SELECT 
                p.id,
                p.name,
                p.brand,
                p.model,
                o.id as orderid,
                o.quantity,
                o.price,
                o.status
            FROM products p inner JOIN 
                orders o ON p.user_id = :user_id AND p.id = o.product_id
              ORDER BY o.created_at DESC
        ");
        $stmt->execute([':user_id' => $id]);
    } else {
        $stmt = $pdo->prepare("
                SELECT 
                p.id,
                p.name,
                p.brand,
                p.model,
                o.quantity,
                o.id as orderid,
                o.price,
                o.status
                FROM products p inner JOIN 
                 orders o ON o.user_id = :user_id AND p.id = o.product_id 
            WHERE p.quantity > 0 ORDER BY o.created_at DESC");
        $stmt->execute([':user_id' => $id]);
    }
    
    $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
} catch (PDOException $e) {
    $error_message = "Internal database error: ";
}
?>