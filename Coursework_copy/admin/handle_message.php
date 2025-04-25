<?php
session_start();
include '../includes/DatabaseConnection.php';
include 'auth_check.php';

header('Content-Type: application/json');

if (!isset($_POST['id']) || !isset($_POST['action'])) {
    http_response_code(400);
    echo json_encode(['error' => 'Missing required parameters']);
    exit();
}

try {
    $messageId = $_POST['id'];
    $action = $_POST['action'];
    
    switch ($action) {
        case 'mark_read':
            $sql = 'UPDATE Messages SET is_read = 1 WHERE id = :id';
            $stmt = $pdo->prepare($sql);
            $stmt->execute(['id' => $messageId]);
            echo json_encode(['success' => true, 'message' => 'Message marked as read']);
            break;
            
        case 'mark_unread':
            $sql = 'UPDATE Messages SET is_read = 0 WHERE id = :id';
            $stmt = $pdo->prepare($sql);
            $stmt->execute(['id' => $messageId]);
            echo json_encode(['success' => true, 'message' => 'Message marked as unread']);
            break;
            
        case 'delete':
            $sql = 'DELETE FROM Messages WHERE id = :id';
            $stmt = $pdo->prepare($sql);
            $stmt->execute(['id' => $messageId]);
            echo json_encode(['success' => true, 'message' => 'Message deleted successfully']);
            break;
            
        default:
            http_response_code(400);
            echo json_encode(['error' => 'Invalid action']);
            break;
    }
} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode(['error' => 'Database error: ' . $e->getMessage()]);
}
?> 