<?php

function handleImageUpload($file) {
    if (!isset($file) || $file['error'] === 4) {
        return null;
    }
    
    $fileName = $file['name'];
    $fileSize = $file['size'];
    $fileType = $file['type'];
    
    $allowedTypes = ['image/jpeg', 'image/jpg', 'image/png'];
    if (!in_array($fileType, $allowedTypes)) {
        throw new Exception('Only JPEG, JPG and PNG files are allowed');
    }
    
    if ($fileSize > 5000000) {
        throw new Exception('File size must be less than 5MB');
    }
    
    if (!is_dir('uploads')) {
        mkdir('uploads');
    }
    
    $fileExt = pathinfo($fileName, PATHINFO_EXTENSION);
    $newFileName = uniqid() . '.' . $fileExt;
    $uploadPath = 'uploads/' . $newFileName;
    
    if (!move_uploaded_file($file['tmp_name'], $uploadPath)) {
        throw new Exception('Failed to upload image');
    }
    
    return $uploadPath;
}

function handleError($e, $redirect = 'questions.php') {
    if ($e instanceof PDOException) {
        $_SESSION['error'] = 'Database error: ' . $e->getMessage();
    } else {
        $_SESSION['error'] = $e->getMessage();
    }
    header('location: ' . $redirect);
    exit();
}

function requireLogin() {
    if (!isset($_SESSION['user_id'])) {
        throw new Exception('You must be logged in to perform this action');
    }
}

function getModules($pdo) {
    $sql = 'SELECT id, modules FROM Modules ORDER BY modules';
    $stmt = $pdo->query($sql);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
} 