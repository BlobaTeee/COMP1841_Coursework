<?php
session_start();

// Clear admin session variables
unset($_SESSION['admin_id']);
unset($_SESSION['admin_email']);

// Redirect to admin login
header('location: login.php');
exit();
?>