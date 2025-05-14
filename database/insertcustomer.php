<?php

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $data = ['username', 'newpassword', 'checkpassword', 'firstname', 'middlename', 'lastname', 'phone', 'address'];
    if (! array_diff($data, array_keys($_POST))) {
        $username      = trim($_POST['username']);
        $newpassword   = trim($_POST['newpassword']);
        $checkpassword = trim($_POST['checkpassword']);
        $firstname      = trim($_POST['firstname']);
        $middlename    = trim($_POST['middlename']);
        $lastname      = trim($_POST['lastname']);
        $phone         = trim($_POST['phone']);
        $address       = trim($_POST['address']);
        $all           = [$username, $newpassword, $checkpassword, $firstname, $middlename, $lastname, $phone, $address];
        if (in_array('', $all, true)) {
            $error_message = "All fields are required.";
        } else if ($newpassword !== $checkpassword) {
            $error_message = "Passwords do not match.";
        } else {
            $password = md5($newpassword);

            try {
                $pdo->beginTransaction();
                $stmtUser = $pdo->prepare("INSERT INTO users (username, password, role) VALUES (:username, :password, :role)");
                $stmtUser->execute([
                    ':username' => $username,
                    ':password' => $password,
                    ':role'     => 'customer',
                ]);

                $userId       = $pdo->lastInsertId();
                $stmtCustomer = $pdo->prepare("INSERT INTO customers (user_id, firstname, middlename, lastname, phone, address)
                                           VALUES (:user_id, :firstname, :middlename, :lastname, :phone, :address)");
                $stmtCustomer->execute([
                    ':user_id'    => $userId,
                    ':firstname'  => $firstname,
                    ':middlename' => $middlename,
                    ':lastname'   => $lastname,
                    ':phone'      => $phone,
                    ':address'    => $address,
                ]);

                $pdo->commit();
                session_start();
                $_SESSION['user_id'] = $userId;
                $_SESSION['role'] = 'customer';
                $_SESSION['firstname'] = $firstname;
                $_SESSION['middlename'] = $middlename;
                $_SESSION['lastname'] = $lastname;
                $_SESSION['login_time'] = date('Y-m-d H:i:s');
                header("Location: ./customer.php");
                exit();
            } catch (PDOException $e) {
                $pdo->rollBack();
                if ($e->errorInfo[1] == 1062) {
                    $error_message = "Username or phone number already exists.";
                } else {
                    $error_message = "Internal Database error";
                    //$e->getMessage());
                }
            }
        }
    } else {
        $error_message = "Invalid form submission.";
    }
}
