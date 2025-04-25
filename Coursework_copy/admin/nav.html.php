<nav class="bg-white shadow-sm border-b border-gray-200">
    <div class="container px-4 md:px-6">
        <div class="flex justify-between h-16">
            <div class="flex">
                <div class="flex-shrink-0 flex items-center">
                    <a href="dashboard.php" class="text-xl font-bold text-blue-600 hover:text-blue-700 transition-colors">
                        Admin Panel
                    </a>
                </div>
                <div class="hidden sm:ml-6 sm:flex sm:space-x-8">
                    <a href="modules.php" class="<?= basename($_SERVER['PHP_SELF']) === 'modules.php' ? 'border-blue-500 text-gray-900' : 'border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700' ?> inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium">
                        Modules
                    </a>
                    <a href="questions.php" class="<?= basename($_SERVER['PHP_SELF']) === 'questions.php' ? 'border-blue-500 text-gray-900' : 'border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700' ?> inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium">
                        Questions
                    </a>
                    <a href="messages.php" class="<?= basename($_SERVER['PHP_SELF']) === 'messages.php' ? 'border-blue-500 text-gray-900' : 'border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700' ?> inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium">
                        Messages
                    </a>
                    <a href="users.php" class="<?= basename($_SERVER['PHP_SELF']) === 'users.php' ? 'border-blue-500 text-gray-900' : 'border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700' ?> inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium">
                        Users
                    </a>
                </div>
            </div>
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <a href="../auth/logout.php" class="btn btn-danger">
                        <i class="fas fa-sign-out-alt mr-2"></i> Logout
                    </a>
                </div>
            </div>
        </div>
    </div>
</nav> 