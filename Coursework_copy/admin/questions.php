<?php
session_start();
require_once 'auth_check.php';
require_admin();

try {
    include '../includes/DatabaseConnection.php';
    
    // List all questions with user and module info
    $sql = 'SELECT q.id, q.Questions, q.img, u.user, m.modules 
            FROM Questions q 
            JOIN Users u ON q.userid = u.id 
            JOIN Modules m ON q.moduleid = m.id 
            ORDER BY q.id DESC';
    $questions = $pdo->query($sql)->fetchAll();
    
    $title = 'Manage Questions';
    ob_start();
    include 'questions.html.php';
    $output = ob_get_clean();

} catch (PDOException $e) {
    $_SESSION['error'] = 'Database error: ' . $e->getMessage();
    header('location: questions.php');
    exit();
}

include 'layout.html.php';
?> 