<?php
// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

header('Content-Type: application/json');
session_start();

require_once 'includes/DatabaseConnection.php';

// Log the request
error_log('Delete question request received. POST data: ' . print_r($_POST, true));

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    $_SESSION['error'] = 'Please log in to perform this action.';
    header('Location: questions.php');
    exit();
}

// Check if question ID is provided
if (!isset($_POST['id']) || !is_numeric($_POST['id'])) {
    $_SESSION['error'] = 'Invalid question ID provided.';
    header('Location: questions.php');
    exit();
}

$questionId = (int)$_POST['id'];

try {
    // Start transaction
    $pdo->beginTransaction();
    
    // First get the question data to check ownership and image
    $stmt = $pdo->prepare('SELECT userid, img FROM Questions WHERE id = ?');
    $stmt->execute([$questionId]);
    $question = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if (!$question) {
        $_SESSION['error'] = 'Question not found.';
        header('Location: questions.php');
        exit();
    }
    
    // Check if user has permission to delete
    $isAdmin = isset($_SESSION['role']) && $_SESSION['role'] === 'admin';
    $isOwner = $question['userid'] == $_SESSION['user_id'];
    
    if (!$isAdmin && !$isOwner) {
        $_SESSION['error'] = 'You do not have permission to delete this question.';
        header('Location: questions.php');
        exit();
    }
    
    // Delete the question (comments will be deleted automatically due to CASCADE)
    $stmt = $pdo->prepare('DELETE FROM Questions WHERE id = ?');
    $stmt->execute([$questionId]);
    
    // If question had an image, delete it
    if ($question['img'] && file_exists($question['img'])) {
        unlink($question['img']);
    }
    
    // Commit transaction
    $pdo->commit();
    
    $_SESSION['success'] = 'Question deleted successfully.';
    
} catch (Exception $e) {
    // Rollback transaction on error
    if ($pdo->inTransaction()) {
        $pdo->rollBack();
    }
    
    $_SESSION['error'] = 'Error deleting question: ' . $e->getMessage();
}

// Get the referring page, fallback to questions.php if not available
$redirectLocation = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : ($isAdmin ? 'admin/questions.php' : 'questions.php');

// Redirect back to the referring page
header('Location: ' . $redirectLocation);
exit();
?>