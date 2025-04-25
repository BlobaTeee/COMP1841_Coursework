<?php
session_start();

try {
    include 'includes/DatabaseConnection.php';
    include 'includes/functions.php';
    
    requireLogin();
    
    if (isset($_POST['submitedit'])) {
        if (!isset($_POST['id'])) {
            throw new Exception('Question ID not provided');
        }
        
        $imagePath = handleImageUpload($_FILES['image']);
        
        $sql = 'UPDATE Questions SET Questions = :questiontext, moduleid = :moduleid';
        if ($imagePath) {
            $sql .= ', img = :image';
        }
        $sql .= ' WHERE id = :id AND userid = :userid';
        
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':questiontext', $_POST['questiontext']);
        $stmt->bindValue(':moduleid', $_POST['moduleid'], PDO::PARAM_INT);
        $stmt->bindValue(':id', $_POST['id'], PDO::PARAM_INT);
        $stmt->bindValue(':userid', $_SESSION['user_id'], PDO::PARAM_INT);
        
        if ($imagePath) {
            $stmt->bindValue(':image', $imagePath);
        }
        
        $stmt->execute();
        
        $_SESSION['success'] = 'Question updated successfully!';
        header('location: questions.php');
        exit();
    }
    
    if (!isset($_GET['id'])) {
        throw new Exception('Question ID not provided');
    }
    
    $sql = 'SELECT * FROM Questions WHERE id = :id AND userid = :userid';
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['id' => $_GET['id'], 'userid' => $_SESSION['user_id']]);
    $question = $stmt->fetch();
    
    if (!$question) {
        throw new Exception('Question not found or you do not have permission to edit it');
    }
    
    $modules = getModules($pdo);
    
    $title = 'Edit Question';
    ob_start();
    include 'templates/editquestion.html.php';
    $output = ob_get_clean();
} catch (Exception $e) {
    handleError($e);
}

include 'templates/layout.html.php';
?>