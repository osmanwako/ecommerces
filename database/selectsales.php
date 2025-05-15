<?php
    $id = $_SESSION['user_id'] ?? '';
    $role = $_SESSION['role'] ?? '';
    $name ="Company: ".($_SESSION['name'] ?? '');
    $name="{$name}'s Sales";

if ($role=='customer') {
    $name="Customer: ".$_SESSION['firstname']. ' '.$_SESSION['middlename'].' '. $_SESSION['lastname'];
}

try {
    if ($role === 'customer') {
        $stmt = $pdo->prepare("SELECT * FROM sales WHERE customer_id = :id ORDER BY sale_date DESC");
        $stmt->execute([':id' => $id]);
    } else {
        $stmt = $pdo->prepare("SELECT * FROM sales WHERE company_id = :id ORDER BY sale_date DESC");
        $stmt->execute([':id' => $id]);
    }
    $sales = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    $error_message = "Internal database error: ";
}
?>