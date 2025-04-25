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
    echo json_encode(['success' => false, 'error' => 'You must be logged in to edit comments']);
    exit();
}

try {
    // Validate input
    if (!isset($_POST['comment_id']) || !isset($_POST['comment'])) {
        throw new Exception('Missing required fields');
    }

    $comment_id = filter_input(INPUT_POST, 'comment_id', FILTER_VALIDATE_INT);
    $new_comment = trim(filter_input(INPUT_POST, 'comment', FILTER_SANITIZE_STRING));

    if (!$comment_id || empty($new_comment)) {
        throw new Exception('Invalid input data');
    }

    // Create Comment instance
    $commentHandler = new Comment(
        $pdo,
        $_SESSION['user_id'],
        isset($_SESSION['role']) && $_SESSION['role'] === 'admin'
    );

    // Edit comment
    $updatedComment = $commentHandler->edit($comment_id, $new_comment);
    
    // Format comment for response
    $formattedComment = $commentHandler->formatComment($updatedComment);

    echo json_encode([
        'success' => true,
        'comment' => $formattedComment
    ]);

} catch (Exception $e) {
    error_log('Error in editcomment.php: ' . $e->getMessage());
    echo json_encode(['success' => false, 'error' => $e->getMessage()]);
} 