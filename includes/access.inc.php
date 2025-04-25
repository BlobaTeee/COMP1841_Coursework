<?php
// Start session if not already started
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

/**
 * Check if the current user is logged in
 * @return bool True if user is logged in, false otherwise
 */
function isLoggedIn(): bool {
    return isset($_SESSION['user_id']);
}

/**
 * Check if the current user is an administrator
 * @return bool True if user is an admin, false otherwise
 */
function userIsAdmin(): bool {
    return isset($_SESSION['is_admin']) && $_SESSION['is_admin'] === true;
}

/**
 * Require user to be logged in to access a page
 * Redirects to login page if not logged in
 */
function requireLogin(): void {
    if (!isLoggedIn()) {
        header('Location: login.php');
        exit();
    }
}

/**
 * Require user to be an administrator to access a page
 * Redirects to home page if not an admin
 */
function requireAdmin(): void {
    if (!userIsAdmin()) {
        header('Location: index.php');
        exit();
    }
} 