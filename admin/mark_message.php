<?php
session_start();
include '../includes/DatabaseConnection.php';
include 'auth_check.php';

if (isset($_POST['message_id']) && isset($_POST['action'])) {
    try {
        $is_read = $_POST['action'] === 'read' ? 1 : 0;
        
        $sql = 'UPDATE Messages SET is_read = :is_read WHERE id = :id';
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            'id' => $_POST['message_id'],
            'is_read' => $is_read
        ]);
        
        $_SESSION['success'] = 'Message status updated successfully.';
    } catch (PDOException $e) {
        $_SESSION['error'] = 'Error updating message status.';
    }
}

header('location: messages.php');
exit();
?>