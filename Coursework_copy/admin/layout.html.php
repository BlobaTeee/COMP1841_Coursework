<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?> - AskAway Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
</head>
<body class="flex flex-col min-h-screen bg-gray-50">
    <main class="flex-1">
        <?php if (isset($_SESSION['success'])): ?>
            <div class="alert alert-success">
                <i class="fas fa-check-circle mr-2"></i>
                <?= htmlspecialchars($_SESSION['success']) ?>
            </div>
            <?php unset($_SESSION['success']); ?>
        <?php endif; ?>

        <?php if (isset($_SESSION['error'])): ?>
            <div class="alert alert-error">
                <i class="fas fa-exclamation-circle mr-2"></i>
                <?= htmlspecialchars($_SESSION['error']) ?>
            </div>
            <?php unset($_SESSION['error']); ?>
        <?php endif; ?>

        <?= $output ?>
    </main>

    <footer class="border-t border-gray-200 bg-white shadow-sm">
        <div class="container flex flex-col gap-2 py-6 px-4 md:px-6">
            <div class="flex flex-col gap-2 md:flex-row md:items-center md:justify-between">
                <div class="flex items-center gap-2 font-bold">
                    <i class="fas fa-user-shield h-5 w-5 text-blue-600"></i>
                    <span>AskAway Admin</span>
                </div>
            </div>
            <div class="text-sm text-gray-500">
                © <?= date('Y') ?> AskAway Admin. All rights reserved.
            </div>
        </div>
    </footer>
</body>
</html> 