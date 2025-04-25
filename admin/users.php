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
    // Handle account status update
    if (isset($_POST['update_status'])) {
        // First check if the user is an admin
        $checkSql = 'SELECT role FROM Users WHERE id = :id';
        $checkStmt = $pdo->prepare($checkSql);
        $checkStmt->execute(['id' => $_POST['user_id']]);
        $userRole = $checkStmt->fetchColumn();

        if ($userRole === 'admin' && $_POST['status'] === '0') {
            $_SESSION['error'] = 'Admin accounts cannot be disabled';
            header('location: users.php');
            exit();
        }

        $sql = 'UPDATE Users SET is_active = :status WHERE id = :id AND id != :current_user';
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            'status' => $_POST['status'] === '1' ? 1 : 0,
            'id' => $_POST['user_id'],
            'current_user' => $_SESSION['user_id']
        ]);
        $_SESSION['success'] = 'User account status updated successfully';
        header('location: users.php');
        exit();
    }

    // Handle role update
    if (isset($_POST['update_role'])) {
        $sql = 'UPDATE Users SET role = :role WHERE id = :id AND id != :current_user';
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            'role' => $_POST['role'],
            'id' => $_POST['user_id'],
            'current_user' => $_SESSION['user_id']
        ]);
        $_SESSION['success'] = 'User role updated successfully';
        header('location: users.php');
        exit();
    }

    // Get all users
    $sql = 'SELECT id, user, email, role, is_active FROM Users ORDER BY id DESC';
    $stmt = $pdo->query($sql);
    $users = $stmt->fetchAll();

    $title = 'User Management';
    ob_start();
    include 'users.html.php';
    $output = ob_get_clean();
} catch (Exception $e) {
    handleError($e, 'dashboard.php');
}

include 'layout.html.php';
?> 