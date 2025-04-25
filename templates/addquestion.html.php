<div class="min-h-screen bg-gray-50 py-12">
    <div class="container px-4 md:px-6 mx-auto">
        <div class="mx-auto max-w-3xl">
            <!-- Main Form -->
            <div class="bg-white rounded-lg shadow-sm">
                <form action="" method="POST" enctype="multipart/form-data" class="p-6">
                    <!-- Question Text -->
                    <div class="mb-6">
                        <label for="questiontext" class="block text-sm font-medium text-gray-700 mb-2">
                            Question Text <span class="text-red-500">*</span>
                        </label>
                        <textarea 
                            id="questiontext" 
                            name="questiontext" 
                            rows="6" 
                            required
                            class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm resize-none"
                            placeholder="Type your question here..."
                        ></textarea>
                    </div>

                    <!-- Module Selection -->
                    <div class="mb-6">
                        <label for="moduleid" class="block text-sm font-medium text-gray-700 mb-2">
                            Module <span class="text-red-500">*</span>
                        </label>
                        <select 
                            id="moduleid" 
                            name="moduleid" 
                            required
                            class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm"
                        >
                            <option value="">Select a module</option>
                            <?php foreach ($modules as $module): ?>
                                <option value="<?= htmlspecialchars($module['id']) ?>">
                                    <?= htmlspecialchars($module['modules']) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <!-- Image Section -->
                    <div class="mb-6">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Question Image</label>
                        <div class="mt-4">
                            <label for="image" class="block text-sm text-gray-500 mb-2">
                                Upload image (optional):
                            </label>
                            <input 
                                type="file" 
                                id="image" 
                                name="image" 
                                accept="image/jpeg,image/jpg,image/png"
                                class="block w-full text-sm text-gray-500
                                    file:mr-4 file:py-2 file:px-4
                                    file:rounded-md file:border-0
                                    file:text-sm file:font-semibold
                                    file:bg-blue-50 file:text-blue-700
                                    hover:file:bg-blue-100
                                    cursor-pointer"
                            >
                            <p class="mt-2 text-xs text-gray-500">
                                Accepted formats: JPEG, JPG, PNG (max. 5MB)
                            </p>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex items-center justify-end space-x-4 pt-4 border-t border-gray-200">
                        <a href="questions.php" 
                           class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                            <i class="fas fa-arrow-left mr-2"></i>
                            Back to Questions
                        </a>
                        <button type="submit" 
                                name="submitadd" 
                                class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                            <i class="fas fa-plus mr-2"></i>
                            Add Question
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>