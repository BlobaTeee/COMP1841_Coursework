<?php
session_start();

try {
    include '../includes/DatabaseConnection.php';
    
    if (isset($_POST['login'])) {
        $email = $_POST['email'];
        $password = $_POST['password'];
        
        $sql = 'SELECT id, user, password, role, is_active FROM Users WHERE email = :email';
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':email', $email);
        $stmt->execute();
        $user = $stmt->fetch();
        
        if ($user && password_verify($password, $user['password'])) {
            if (!$user['is_active']) {
                $_SESSION['error'] = 'This account has been disabled. Please contact an administrator.';
                header('location: login.php');
                exit();
            }
            
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user'] = $user['user'];
            $_SESSION['role'] = $user['role'];
            header('location: ../questions.php');
            exit();
        } else {
            $_SESSION['error'] = 'Invalid email or password';
        }
    }
    
    $title = 'Log in';
    ob_start();
    include '../templates/login.html.php';
    $output = ob_get_clean();
} catch (PDOException $e) {
    $title = 'An error has occurred';
    $output = 'Database error: ' . $e->getMessage();
}

include '../templates/layout.html.php';
?>