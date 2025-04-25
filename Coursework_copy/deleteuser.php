<?php
session_start();

if (!isset($_SESSION['loggedin']) || !isset($_SESSION['is_admin'])) {
    header('Location: auth/login.php');
    exit;
}

if (!isset($_GET['id'])) {
    header('Location: admin/users.php');
    exit;
}

include 'includes/DatabaseConnection.php';

$stmt = $pdo->prepare('DELETE FROM Users WHERE id = ?');
$stmt->execute([$_GET['id']]);

$_SESSION['success'] = 'User deleted successfully';
header('Location: admin/users.php');
exit;
?>