<?php
session_start();
include '../includes/DatabaseConnection.php';
include 'auth_check.php';

if (isset($_POST['message_id'])) {
    try {
        $sql = 'DELETE FROM Messages WHERE id = :id';
        $stmt = $pdo->prepare($sql);
        $stmt->execute(['id' => $_POST['message_id']]);
        
        $_SESSION['success'] = 'Message deleted successfully.';
    } catch (PDOException $e) {
        $_SESSION['error'] = 'Error deleting message.';
    }
}

header('location: messages.php');
exit();
?>