<?php
require_once 'auth_check.php';
require_admin();

try {
    include '../includes/DatabaseConnection.php';
    
    // Get total questions count
    $sql = 'SELECT COUNT(*) as total_questions FROM Questions';
    $stmt = $pdo->query($sql);
    $totalQuestions = $stmt->fetchColumn();
    
    // Get total users count
    $sql = 'SELECT COUNT(*) as total_users FROM Users';
    $stmt = $pdo->query($sql);
    $totalUsers = $stmt->fetchColumn();
    
    // Get unread messages count
    $sql = 'SELECT COUNT(*) as unread_messages FROM Messages WHERE is_read = 0';
    $stmt = $pdo->query($sql);
    $unreadMessages = $stmt->fetchColumn();
    
    // Get recent questions with user and module info
    $sql = 'SELECT q.id, q.questions, q.img, u.user, m.modules 
            FROM Questions q 
            JOIN Users u ON q.userid = u.id 
            JOIN Modules m ON q.moduleid = m.id 
            ORDER BY q.id DESC LIMIT 5';
    $recentQuestions = $pdo->query($sql)->fetchAll();
    
    $title = 'Admin Dashboard';
    ob_start();
    include 'dashboard.html.php';
    $output = ob_get_clean();
    
} catch (PDOException $e) {
    $_SESSION['error'] = 'Database error: ' . $e->getMessage();
    header('location: dashboard.php');
    exit();
}

include 'layout.html.php';
?> 