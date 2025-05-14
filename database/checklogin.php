<?php
if (isset($_POST['username'], $_POST['password'])) {
    $username = trim($_POST['username']);
    $password = md5(trim($_POST['password']));

    if (empty($username) || empty($password)) {
        $error_message = empty($username) ? "Username is required" : "Password is required";
    } else {
        try {
            $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ? AND password = ?");
            $stmt->execute([$username, $password]);

            if ($user = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $_SESSION = [
                    'user_id'    => $user['id'],
                    'role'       => $user['role'],
                    'login_time' => date('Y-m-d H:i:s'),
                ];

                $table = ($user['role'] === 'customer') ? 'customers' : 'company';
                $stmt  = $pdo->prepare("SELECT * FROM $table  WHERE user_id = ?");
                $stmt->execute([$user['id']]);
                $details = $stmt->fetch(PDO::FETCH_ASSOC);
                if ($user['role'] == 'customer') {
                    $_SESSION['firstname']  = $details['firstname'];
                    $_SESSION['middlename'] = $details['middlename'];
                    $_SESSION['lastname']   = $details['lastname'];
                } else if ($user['role'] == 'company') {
                    $_SESSION['name'] = $details['name'];
                } else {
                    header("Location: ./logout.php");
                    exit();
                }
                header("Location: ./{$user['role']}.php");

            }
            $error_message = "Username or Password error";
        } catch (PDOException $e) {
            $error_message = "Database error";
        }
    }
} else {
    $error_message = "Invalid request";
}
