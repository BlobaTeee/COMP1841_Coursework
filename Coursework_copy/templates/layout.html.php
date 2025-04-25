<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?> - AskAway</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

</head>
<body class="flex flex-col min-h-screen bg-gray-50">
    <?php 
    $current_page = basename($_SERVER['PHP_SELF']);
    $auth_pages = ['login.php', 'signup.php'];
    $is_admin_page = strpos($_SERVER['PHP_SELF'], '/admin/') !== false;
    
    if (!$is_admin_page && !in_array($current_page, $auth_pages)): 
    ?>
    <header class="border-b border-gray-200 bg-white shadow-sm">
        <div class="container flex h-16 items-center justify-between px-4 md:px-6">
            <div class="flex items-center gap-2 font-bold">
                <i class="fas fa-book-open h-6 w-6 text-blue-600"></i>
                <span>AskAway</span>
            </div>
            <nav class="hidden md:flex gap-6">
                <a href="/Coursework_copy/index.php" class="text-sm font-medium flex items-center gap-1 hover:text-blue-600 transition-colors">
                    <i class="fas fa-home h-4 w-4"></i>
                    Home
                </a>
                <a href="/Coursework_copy/questions.php" class="text-sm font-medium flex items-center gap-1 hover:text-blue-600 transition-colors">
                    <i class="fas fa-list h-4 w-4"></i>
                    Questions
                </a>
                <a href="/Coursework_copy/contact.php" class="text-sm font-medium flex items-center gap-1 hover:text-blue-600 transition-colors">
                    <i class="fas fa-question-circle h-4 w-4"></i>
                    Contact
                </a>
            </nav>
            <div class="flex items-center gap-3">
                <?php if (isset($_SESSION['user_id'])): ?>
                    <span class="text-sm text-gray-600">Welcome, <?= htmlspecialchars($_SESSION['user']) ?></span>
                    <a href="/Coursework_copy/auth/logout.php" class="btn btn-danger">
                        <i class="fas fa-sign-out-alt mr-2"></i> Logout
                    </a>
                <?php else: ?>
                    <div class="flex items-center gap-3">
                        <a href="/Coursework_copy/auth/login.php" class="btn btn-secondary">
                            <i class="fas fa-sign-in-alt mr-2"></i> Log in
                        </a>
                        <a href="/Coursework_copy/auth/signup.php" class="btn btn-primary">
                            <i class="fas fa-user-plus mr-2"></i> Sign up
                        </a>
                        <?php if ($current_page === 'login.php'): ?>
                            <a href="/Coursework_copy/admin/login.php" class="btn btn-secondary">
                                <i class="fas fa-user-shield mr-2"></i> Admin Login
                            </a>
                        <?php endif; ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </header>
    <?php endif; ?>

    <main class="flex-1">
        <?= $output ?>
    </main>

    <!-- Notifications Section -->
    <?php if (isset($_SESSION['success']) || isset($_SESSION['error'])): ?>
    <div class="fixed bottom-4 right-4 z-50 w-96 max-w-[calc(100vw-2rem)]">
        <?php if (isset($_SESSION['success'])): ?>
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg shadow-lg relative mb-2" role="alert">
                <span class="block sm:inline"><?= htmlspecialchars($_SESSION['success']) ?></span>
                <button type="button" class="absolute top-0 bottom-0 right-0 px-4 py-3" onclick="this.parentElement.remove()">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <?php unset($_SESSION['success']); ?>
        <?php endif; ?>

        <?php if (isset($_SESSION['error'])): ?>
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg shadow-lg relative" role="alert">
                <span class="block sm:inline"><?= htmlspecialchars($_SESSION['error']) ?></span>
                <button type="button" class="absolute top-0 bottom-0 right-0 px-4 py-3" onclick="this.parentElement.remove()">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <?php unset($_SESSION['error']); ?>
        <?php endif; ?>
    </div>
    <?php endif; ?>

    <?php if (!$is_admin_page && !in_array($current_page, $auth_pages)): ?>
    <footer class="border-t border-gray-200 bg-white shadow-sm">
        <div class="container flex flex-col gap-2 py-6 px-4 md:px-6">
            <div class="flex flex-col gap-2 md:flex-row md:items-center md:justify-between">
                <div class="flex items-center gap-2 font-bold">
                    <i class="fas fa-book-open h-5 w-5 text-blue-600"></i>
                    <span>AskAway</span>
                </div>
            </div>
            <div class="text-sm text-gray-500">
                © <?= date('Y') ?> AskAway. All rights reserved.
            </div>
        </div>
    </footer>
    <?php endif; ?>

    <script>
    // Auto-hide notifications after 5 seconds with slide-up animation
    document.addEventListener('DOMContentLoaded', function() {
        setTimeout(function() {
            const notifications = document.querySelectorAll('[role="alert"]');
            notifications.forEach(function(notification) {
                notification.style.transition = 'all 0.5s ease-in-out';
                notification.style.opacity = '0';
                notification.style.transform = 'translateY(100%)';
                setTimeout(function() {
                    notification.remove();
                }, 500);
            });
        }, 5000);
    });
    </script>
</body>
</html>