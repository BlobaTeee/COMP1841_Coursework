<?php include 'nav.html.php'; ?>

<div class="flex flex-col min-h-screen">
    <main class="flex-1">
        <!-- Hero Section -->
        <div class="container mx-auto px-4 md:px-6 py-16">
            <div class="grid md:grid-cols-2 gap-8 items-center">
                <div>
                    <h1 class="text-4xl font-bold mb-4">Welcome to AskAway</h1>
                    <p class="text-gray-600 text-lg mb-8">Access a comprehensive collection of questions and modules to enhance your learning experience.</p>
                    <div class="flex gap-4">
                        <a href="questions.php" class="inline-flex items-center px-6 py-3 bg-blue-600 text-white rounded-md hover:bg-blue-700">
                            Browse Questions
                            <i class="fas fa-arrow-right ml-2"></i>
                        </a>
                        <?php if (!isset($_SESSION['user_id'])): ?>
                            <a href="auth/signup.php" class="inline-flex items-center px-6 py-3 border border-gray-300 rounded-md text-gray-700 hover:bg-gray-50">
                                Create an Account
                            </a>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="flex justify-center">
                    <div class="bg-blue-50 p-12 rounded-lg">
                        <i class="fas fa-book text-8xl text-blue-400"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Features Section -->
        <div class="bg-gray-50 py-20">
            <div class="container mx-auto px-4 md:px-6">
                <div class="text-center mb-16">
                    <h2 class="text-4xl font-bold mb-6">Features</h2>
                    <p class="text-gray-600 text-lg">Explore the powerful features of our question database platform.</p>
                </div>

                <div class="grid md:grid-cols-3 gap-12 max-w-7xl mx-auto">
                    <!-- Feature 1 -->
                    <div class="bg-white p-8 rounded-lg shadow-sm hover:shadow-md transition-shadow">
                        <div class="mb-6">
                            <i class="fas fa-book text-4xl text-blue-400"></i>
                        </div>
                        <h3 class="text-2xl font-semibold mb-4">Comprehensive Modules</h3>
                        <p class="text-gray-600 text-lg">Access a wide range of question modules covering various topics and difficulty levels.</p>
                    </div>

                    <!-- Feature 2 -->
                    <div class="bg-white p-8 rounded-lg shadow-sm hover:shadow-md transition-shadow">
                        <div class="mb-6">
                            <i class="fas fa-list text-4xl text-blue-400"></i>
                        </div>
                        <h3 class="text-2xl font-semibold mb-4">Organized Content</h3>
                        <p class="text-gray-600 text-lg">Questions are organized into modules for easy navigation and structured learning.</p>
                    </div>

                    <!-- Feature 3 -->
                    <div class="bg-white p-8 rounded-lg shadow-sm hover:shadow-md transition-shadow">
                        <div class="mb-6">
                            <i class="fas fa-question-circle text-4xl text-blue-400"></i>
                        </div>
                        <h3 class="text-2xl font-semibold mb-4">Support</h3>
                        <p class="text-gray-600 text-lg">Get help and support through our contact page whenever you need assistance.</p>
                    </div>
                </div>
            </div>
        </div>
    </main>
</div>
