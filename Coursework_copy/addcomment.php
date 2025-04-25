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
    echo json_encode(['success' => false, 'error' => 'You must be logged in to add comments']);
    exit();
}

try {
    // Validate input
    if (!isset($_POST['question_id']) || !isset($_POST['comment'])) {
        throw new Exception('Missing required fields');
    }

    $question_id = filter_input(INPUT_POST, 'question_id', FILTER_VALIDATE_INT);
    $comment = trim(filter_input(INPUT_POST, 'comment', FILTER_SANITIZE_STRING));

    if (!$question_id || empty($comment)) {
        throw new Exception('Invalid input data');
    }

    // Create Comment instance
    $commentHandler = new Comment(
        $pdo,
        $_SESSION['user_id'],
        isset($_SESSION['role']) && $_SESSION['role'] === 'admin'
    );

    // Add comment
    $newComment = $commentHandler->add($question_id, $comment);
    
    // Format comment for response
    $formattedComment = $commentHandler->formatComment($newComment);

    echo json_encode([
        'success' => true,
        'comment' => $formattedComment
    ]);

} catch (Exception $e) {
    error_log('Error in addcomment.php: ' . $e->getMessage());
    echo json_encode(['success' => false, 'error' => $e->getMessage()]);
} 