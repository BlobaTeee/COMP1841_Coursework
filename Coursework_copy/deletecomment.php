<?php
require_once 'includes/DatabaseConnection.php';
require_once 'includes/Comment.php';

// Start session if not already started
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Set JSON content type
header('Content-Type: application/json');

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    echo json_encode(['success' => false, 'error' => 'You must be logged in to delete comments']);
    exit();
}

try {
    // Validate input
    if (!isset($_POST['comment_id'])) {
        throw new Exception('Comment ID is required');
    }

    $comment_id = filter_input(INPUT_POST, 'comment_id', FILTER_VALIDATE_INT);
    if (!$comment_id) {
        throw new Exception('Invalid comment ID');
    }

    // Create Comment instance
    $commentHandler = new Comment(
        $pdo,
        $_SESSION['user_id'],
        isset($_SESSION['role']) && $_SESSION['role'] === 'admin'
    );

    // Delete comment
    $commentHandler->delete($comment_id);

    echo json_encode([
        'success' => true,
        'message' => 'Comment deleted successfully'
    ]);

} catch (Exception $e) {
    error_log('Error in deletecomment.php: ' . $e->getMessage());
    echo json_encode(['success' => false, 'error' => $e->getMessage()]);
} 