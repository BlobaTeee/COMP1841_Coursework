<?php include 'nav.html.php'; ?>

<div class="py-12">
    <div class="container px-4 md:px-6">
        <div class="flex justify-between items-center mb-8">
            <div>
                <h1 class="text-3xl font-bold">Dashboard</h1>
                <p class="text-gray-500">Welcome to the admin dashboard</p>
            </div>
        </div>

        <?php if (isset($_SESSION['success'])): ?>
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                <span class="block sm:inline"><?= $_SESSION['success'] ?></span>
            </div>
            <?php unset($_SESSION['success']); ?>
        <?php endif; ?>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="bg-white rounded-lg shadow-sm border border-gray-100 p-6">
                <div class="flex items-center">
                    <div class="p-3 rounded-full bg-blue-100 text-blue-600">
                        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <div class="ml-4">
                        <h3 class="text-lg font-medium text-gray-900">Total Questions</h3>
                        <p class="text-2xl font-semibold text-gray-900"><?= $totalQuestions ?></p>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow-sm border border-gray-100 p-6">
                <div class="flex items-center">
                    <div class="p-3 rounded-full bg-green-100 text-green-600">
                        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                    </div>
                    <div class="ml-4">
                        <h3 class="text-lg font-medium text-gray-900">Total Users</h3>
                        <p class="text-2xl font-semibold text-gray-900"><?= $totalUsers ?></p>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow-sm border border-gray-100 p-6">
                <div class="flex items-center">
                    <div class="p-3 rounded-full bg-yellow-100 text-yellow-600">
                        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                        </svg>
                    </div>
                    <div class="ml-4">
                        <h3 class="text-lg font-medium text-gray-900">Unread Messages</h3>
                        <p class="text-2xl font-semibold text-gray-900"><?= $unreadMessages ?></p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Recent Questions Section -->
        <div class="bg-white rounded-lg shadow-sm border border-gray-100 mt-8">
            <div class="px-6 py-4 border-b border-gray-200">
                <h2 class="text-lg font-medium text-gray-900">Recent Questions</h2>
            </div>
            <div class="divide-y divide-gray-200">
                <?php if (empty($recentQuestions)): ?>
                    <div class="p-6 text-center text-gray-500">
                        No questions found.
                    </div>
                <?php else: ?>
                    <?php foreach ($recentQuestions as $question): ?>
                        <div class="p-6">
                            <div class="flex items-start justify-between">
                                <div class="flex-1">
                                    <h3 class="text-lg font-medium text-gray-900"><?= htmlspecialchars($question['questions']) ?></h3>
                                    <div class="mt-2 text-sm text-gray-500">
                                        <span class="font-medium">Posted by:</span> <?= htmlspecialchars($question['user']) ?>
                                        <span class="mx-2">•</span>
                                        <span class="font-medium">Module:</span> <?= htmlspecialchars($question['modules']) ?>
                                    </div>
                                </div>
                                <?php if ($question['img']): ?>
                                    <div class="ml-4 flex-shrink-0">
                                        <img src="/Coursework_copy/<?= htmlspecialchars($question['img']) ?>" alt="Question Image" class="h-20 w-20 object-cover rounded-lg">
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div> 