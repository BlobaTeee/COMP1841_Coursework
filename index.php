<?php
session_start();

try {
    include 'includes/DatabaseConnection.php';
    
    $sql = 'SELECT q.id, q.Questions, q.img, u.user, m.modules 
            FROM Questions q 
            JOIN Users u ON q.userid = u.id
            JOIN Modules m ON q.moduleid = m.id
            ORDER BY q.id DESC';
    $stmt = $pdo->query($sql);
    $questions = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    $title = 'Home';
    ob_start();
    include 'templates/home.html.php';
    $output = ob_get_clean();
} catch (PDOException $e) {
    $_SESSION['error'] = 'Database error: ' . $e->getMessage();
    header('location: index.php');
    exit();
} catch (Exception $e) {
    $_SESSION['error'] = $e->getMessage();
    header('location: index.php');
    exit();
}

include 'templates/layout.html.php';
?>