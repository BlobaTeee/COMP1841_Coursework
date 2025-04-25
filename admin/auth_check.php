<?php
session_start();

function require_admin() {
    if (!isset($_SESSION['user_id']) || !isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
        $_SESSION['error'] = 'Please log in as an admin to access this page';
        header('location: /Coursework_copy/admin/login.php');
        exit();
    }
}
?> 