<?php
include 'includes/DatabaseConnection.php';

try {
    if (isset($_POST['delete'])) {
        $sql = 'DELETE FROM Modules WHERE id = :id';
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':id', $_POST['id'], PDO::PARAM_INT);
        $stmt->execute();
    }
    
    if (isset($_POST['moduleName']) && !empty($_POST['moduleName'])) {
        $sql = 'INSERT INTO Modules (modules) VALUES (:moduleName)';
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':moduleName', $_POST['moduleName']);
        $stmt->execute();
    }

    if (isset($_POST['update']) && isset($_POST['moduleId']) && isset($_POST['updatedName'])) {
        $sql = 'UPDATE Modules SET modules = :moduleName WHERE id = :id';
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':moduleName', $_POST['updatedName']);
        $stmt->bindValue(':id', $_POST['moduleId'], PDO::PARAM_INT);
        $stmt->execute();
    }

    $sql = 'SELECT * FROM Modules ORDER BY modules';
    $modules = $pdo->query($sql);

    $title = 'Manage Modules';
    ob_start();
    include 'templates/modules.html.php';
    $output = ob_get_clean();

} catch (PDOException $e) {
    $title = 'An error has occurred';
    $output = 'Database error: ' . $e->getMessage();
}

include 'templates/layout.html.php';
?>