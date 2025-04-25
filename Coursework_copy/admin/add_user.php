<?php
session_start();
include '../includes/DatabaseConnection.php';
include '../includes/functions.php';

// Check if user is admin
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header('location: login.php');
    exit();
}

try {
    if (isset($_POST['add_user'])) {
        // Validate input
        if (empty($_POST['username']) || empty($_POST['email']) || empty($_POST['password'])) {
            throw new Exception('All fields are required');
        }

        if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
            throw new Exception('Invalid email format');
        }

        // Check if username or email already exists
        $sql = 'SELECT COUNT(*) FROM Users WHERE username = :username OR email = :email';
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            'username' => $_POST['username'],
            'email' => $_POST['email']
        ]);
        
        if ($stmt->fetchColumn() > 0) {
            throw new Exception('Username or email already exists');
        }

        // Hash password
        $hashedPassword = password_hash($_POST['password'], PASSWORD_DEFAULT);

        // Insert new user
        $sql = 'INSERT INTO Users (username, email, password, role) VALUES (:username, :email, :password, :role)';
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            'username' => $_POST['username'],
            'email' => $_POST['email'],
            'password' => $hashedPassword,
            'role' => $_POST['role']
        ]);

        $_SESSION['success'] = 'User added successfully';
        header('location: users.php');
        exit();
    }

    $title = 'Add New User';
    ob_start();
    include 'add_user.html.php';
    $output = ob_get_clean();
} catch (Exception $e) {
    handleError($e, 'users.php');
}

include 'layout.html.php';
?> 