<?php
session_start();

try {
    include 'includes/DatabaseConnection.php';
    include 'includes/functions.php';
    
    if (isset($_POST['submitadd'])) {
        requireLogin();
        
        $imagePath = handleImageUpload($_FILES['image']);
        
        $sql = 'INSERT INTO Questions (Questions, userid, moduleid, img) 
                VALUES (:questiontext, :userid, :moduleid, :image)';
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':questiontext', $_POST['questiontext']);
        $stmt->bindValue(':userid', $_SESSION['user_id'], PDO::PARAM_INT);
        $stmt->bindValue(':moduleid', $_POST['moduleid'], PDO::PARAM_INT);
        $stmt->bindValue(':image', $imagePath);
        $stmt->execute();
        
        $_SESSION['success'] = 'Question added successfully!';
        header('location: questions.php');
        exit();
    }
    
    $modules = getModules($pdo);
    
    $title = 'Add Question';
    ob_start();
    include 'templates/addquestion.html.php';
    $output = ob_get_clean();
} catch (Exception $e) {
    handleError($e);
}

include 'templates/layout.html.php';
?>