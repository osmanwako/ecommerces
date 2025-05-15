<?php
 if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    header('Location:/ecommerces/logout.php');
    exit();
}

$id = $_POST['saleid'] ?? '';

if (empty($id)) {
    $error_message = "sales ID is required.";
}

else if (! is_numeric($id) ) {
    $error_message= "Sales ID should be numeric values.";
}
else{
    try {
        $stmt = $pdo->prepare("SELECT * FROM sales WHERE id = :id");
        $stmt->execute([':id' => $id]);
    $sale = $stmt->fetch(PDO::FETCH_ASSOC);;
} catch (PDOException $e) {
    $error_message = "Internal database error: ";
}
}


?>