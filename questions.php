<?php
session_start();
require_once 'includes/DatabaseConnection.php';
require_once 'includes/functions.php';
require_once 'includes/Comment.php';

try {
    // Fetch questions with user and module information
    $search = isset($_GET['search']) ? trim($_GET['search']) : '';
    
    if ($search !== '') {
        $sql = 'SELECT q.id, q.Questions, q.img, q.userid,
                       u.user, u.id as author_id, 
                       m.modules 
                FROM Questions q 
                JOIN Users u ON q.userid = u.id
                JOIN Modules m ON q.moduleid = m.id
                WHERE q.Questions LIKE :search 
                   OR m.modules LIKE :search 
                   OR u.user LIKE :search
                ORDER BY q.id DESC';
        $stmt = $pdo->prepare($sql);
        $stmt->execute(['search' => '%' . $search . '%']);
    } else {
        $sql = 'SELECT q.id, q.Questions, q.img, q.userid,
                       u.user, u.id as author_id, 
                       m.modules 
                FROM Questions q 
                JOIN Users u ON q.userid = u.id
                JOIN Modules m ON q.moduleid = m.id
                ORDER BY q.id DESC';
        $stmt = $pdo->query($sql);
    }
    
    $questions = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Create Comment instance
    $commentHandler = new Comment(
        $pdo,
        isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null,
        isset($_SESSION['role']) && $_SESSION['role'] === 'admin'
    );

    // Fetch comments for each question
    foreach ($questions as &$question) {
        $question['comments'] = $commentHandler->getCommentsByQuestionId($question['id']);
    }
    unset($question); // Break the reference
    
    $title = 'Questions';
    ob_start();
    include 'templates/questions.html.php';
    $output = ob_get_clean();
} catch (PDOException $e) {
    error_log('Database error: ' . $e->getMessage());
    die('Database error: ' . $e->getMessage());
} catch (Exception $e) {
    error_log('Error: ' . $e->getMessage());
    die('Error: ' . $e->getMessage());
}

include 'templates/layout.html.php';
?>