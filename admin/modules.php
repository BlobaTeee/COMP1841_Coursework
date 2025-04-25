<?php
session_start();
require_once 'auth_check.php';
require_admin();

try {
    include '../includes/DatabaseConnection.php';
    
    if (isset($_POST['delete'])) {
        $sql = 'DELETE FROM Modules WHERE id = :id';
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':id', $_POST['id'], PDO::PARAM_INT);
        $stmt->execute();
        $_SESSION['success'] = 'Module deleted successfully';
        header('location: modules.php');
        exit();
    }
    
    if (isset($_POST['moduleName']) && !empty($_POST['moduleName'])) {
        $sql = 'INSERT INTO Modules (modules) VALUES (:moduleName)';
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':moduleName', $_POST['moduleName']);
        $stmt->execute();
        $_SESSION['success'] = 'Module added successfully';
        header('location: modules.php');
        exit();
    }

    if (isset($_POST['update']) && isset($_POST['moduleId']) && isset($_POST['updatedName'])) {
        $sql = 'UPDATE Modules SET modules = :moduleName WHERE id = :id';
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':moduleName', $_POST['updatedName']);
        $stmt->bindValue(':id', $_POST['moduleId'], PDO::PARAM_INT);
        $stmt->execute();
        $_SESSION['success'] = 'Module updated successfully';
        header('location: modules.php');
        exit();
    }

    $sql = 'SELECT * FROM Modules ORDER BY modules';
    $modules = $pdo->query($sql)->fetchAll();

    $title = 'Manage Modules';
    ob_start();
    include 'modules.html.php';
    $output = ob_get_clean();

} catch (PDOException $e) {
    $title = 'Error';
    $output = 'Database error: ' . $e->getMessage();
}

include 'layout.html.php';
?> 