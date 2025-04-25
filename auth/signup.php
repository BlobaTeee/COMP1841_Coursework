<?php
session_start();

try {
    include '../includes/DatabaseConnection.php';
    
    if (isset($_POST['signup'])) {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $confirm_password = $_POST['confirm-password'];
        
        // Validate input
        if (empty($name) || empty($email) || empty($password) || empty($confirm_password)) {
            $_SESSION['error'] = 'Please fill in all fields';
        } elseif ($password !== $confirm_password) {
            $_SESSION['error'] = 'Passwords do not match';
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $_SESSION['error'] = 'Invalid email format';
        } else {
            // Check if email already exists
            $sql = 'SELECT id FROM Users WHERE email = :email';
            $stmt = $pdo->prepare($sql);
            $stmt->bindValue(':email', $email);
            $stmt->execute();
            
            if ($stmt->fetch()) {
                $_SESSION['error'] = 'Email already registered';
            } else {
                // Insert new user
                $sql = 'INSERT INTO Users (user, email, password) VALUES (:name, :email, :password)';
                $stmt = $pdo->prepare($sql);
                $stmt->bindValue(':name', $name);
                $stmt->bindValue(':email', $email);
                $stmt->bindValue(':password', password_hash($password, PASSWORD_DEFAULT));
                $stmt->execute();
                
                $_SESSION['success'] = 'Account created successfully. Please log in.';
                header('location: login.php');
                exit();
            }
        }
    }
    
    $title = 'Sign up';
    ob_start();
    include '../templates/signup.html.php';
    $output = ob_get_clean();
} catch (PDOException $e) {
    $title = 'An error has occurred';
    $output = 'Database error: ' . $e->getMessage();
}

include '../templates/layout.html.php';
?> 