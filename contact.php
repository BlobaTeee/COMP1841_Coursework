<?php
session_start();

try {
    if (isset($_POST['submit'])) {
        include 'includes/DatabaseConnection.php';
        
        // Validate input
        if (empty($_POST['name']) || empty($_POST['email']) || empty($_POST['subject']) || empty($_POST['message'])) {
            throw new Exception('All fields are required');
        }
        
        if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
            throw new Exception('Invalid email format');
        }
        
        $name = $_POST['name'];
        $email = $_POST['email'];
        $subject = $_POST['subject'];
        $message = $_POST['message'];
        
        // Store the message in the database
        $sql = 'INSERT INTO Messages (name, email, subject, message) VALUES (:name, :email, :subject, :message)';
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            'name' => $name,
            'email' => $email,
            'subject' => $subject,
            'message' => $message
        ]);
        
        $_SESSION['success'] = 'Thank you for your message. We will get back to you soon.';
        header('location: contact.php');
        exit();
    }
    
    $title = 'Contact Us';
    ob_start();
    include 'templates/contact.html.php';
    $output = ob_get_clean();
} catch (PDOException $e) {
    error_log("Database error in contact.php: " . $e->getMessage());
    $_SESSION['error'] = 'Error sending message. Please try again later.';
    header('location: contact.php');
    exit();
} catch (Exception $e) {
    $_SESSION['error'] = $e->getMessage();
    header('location: contact.php');
    exit();
}

include 'templates/layout.html.php';
?>