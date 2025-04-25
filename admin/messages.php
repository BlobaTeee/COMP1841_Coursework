<?php
session_start();
include '../includes/DatabaseConnection.php';
include 'auth_check.php';

try {
    // Handle message actions
    if (isset($_POST['action'])) {
        switch ($_POST['action']) {
            case 'mark_read':
                $sql = 'UPDATE Messages SET is_read = 1 WHERE id = :id';
                $stmt = $pdo->prepare($sql);
                $stmt->execute(['id' => $_POST['id']]);
                $_SESSION['success'] = 'Message marked as read';
                break;
                
            case 'mark_unread':
                $sql = 'UPDATE Messages SET is_read = 0 WHERE id = :id';
                $stmt = $pdo->prepare($sql);
                $stmt->execute(['id' => $_POST['id']]);
                $_SESSION['success'] = 'Message marked as unread';
                break;
                
            case 'delete':
                $sql = 'DELETE FROM Messages WHERE id = :id';
                $stmt = $pdo->prepare($sql);
                $stmt->execute(['id' => $_POST['id']]);
                $_SESSION['success'] = 'Message deleted successfully';
                break;
        }
        header('location: messages.php');
        exit();
    }
    
    // Get all messages
    $sql = 'SELECT * FROM Messages ORDER BY created_at DESC';
    $stmt = $pdo->query($sql);
    $messages = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    $title = 'Contact Messages';
    ob_start();
    include 'messages.html.php';
    $output = ob_get_clean();
} catch (PDOException $e) {
    $_SESSION['error'] = 'Database error: ' . $e->getMessage();
    header('location: dashboard.php');
    exit();
}

include 'layout.html.php';
?> 