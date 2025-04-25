<?php
session_start();

try {
    include '../includes/DatabaseConnection.php';
    
    if (isset($_POST['admin_login'])) {
        $email = $_POST['email'];
        $password = $_POST['password'];
        
        // Verify admin credentials using the Users table
        $sql = 'SELECT id, user, password, role, is_active FROM Users WHERE email = :email';
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':email', $email);
        $stmt->execute();
        $admin = $stmt->fetch();
        
        if ($admin && password_verify($password, $admin['password']) && $admin['role'] === 'admin') {
            if (!$admin['is_active']) {
                $_SESSION['error'] = 'This account has been disabled. Please contact the administrator.';
                header('location: /Coursework_copy/admin/login.php');
                exit();
            }
            
            $_SESSION['user_id'] = $admin['id'];
            $_SESSION['user'] = $admin['user'];
            $_SESSION['role'] = $admin['role'];
            
            // Use absolute path for redirection with correct directory name
            header('location: /Coursework_copy/admin/dashboard.php');
            exit();
        } else {
            $_SESSION['error'] = 'Invalid email or password';
            header('location: /Coursework_copy/admin/login.php');
            exit();
        }
    }
    
    $title = 'Admin Login';
    ob_start();
    include 'login.html.php';
    $output = ob_get_clean();
} catch (PDOException $e) {
    $_SESSION['error'] = 'Database error: ' . $e->getMessage();
    header('location: /Coursework_copy/admin/login.php');
    exit();
} catch (Exception $e) {
    $_SESSION['error'] = $e->getMessage();
    header('location: /Coursework_copy/admin/login.php');
    exit();
}

include 'layout.html.php';
?> 