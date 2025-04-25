<div class="max-w-7xl mx-auto">
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        <?php foreach ($modules as $module): ?>
            <div class="bg-white overflow-hidden shadow rounded-lg">
                <div class="p-6">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="text-xl font-bold text-gray-900">
                            <?= htmlspecialchars($module['modules']) ?>
                        </h3>
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                            <?= count($module['questions']) ?> Questions
                        </span>
                    </div>
                    
                    <p class="text-gray-600 mb-4">
                        <?= htmlspecialchars($module['description'] ?? 'No description available.') ?>
                    </p>

                    <div class="mt-4">
                        <h4 class="text-sm font-medium text-gray-900 mb-2">Recent Questions</h4>
                        <div class="space-y-2">
                            <?php foreach (array_slice($module['questions'], 0, 3) as $question): ?>
                                <div class="flex items-start">
                                    <div class="flex-shrink-0">
                                        <i class="fas fa-question-circle text-blue-500"></i>
                                    </div>
                                    <div class="ml-3">
                                        <p class="text-sm text-gray-600">
                                            <?= htmlspecialchars($question['Questions']) ?>
                                        </p>
                                        <p class="text-xs text-gray-500 mt-1">
                                            By <?= htmlspecialchars($question['user']) ?>
                                        </p>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>

                    <div class="mt-6 flex justify-between items-center">
                        <a href="questions.php?module=<?= urlencode($module['modules']) ?>" 
                           class="text-sm font-medium text-blue-600 hover:text-blue-500">
                            View all questions
                        </a>
                        <?php if (isset($_SESSION['user_id'])): ?>
                            <a href="addquestion.php?module=<?= urlencode($module['modules']) ?>" 
                               class="btn btn-primary">
                                Ask Question
                            </a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<style>
.module-list {
    margin-top: 20px;
}

.module-item {
    border: 1px solid #ddd;
    margin-bottom: 10px;
    padding: 10px;
    border-radius: 4px;
}

.module-display {
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.module-actions {
    display: flex;
    gap: 10px;
}

.module-edit form {
    display: flex;
    gap: 10px;
    margin-top: 10px;
}

.edit-btn, .delete-btn, .save-btn, .cancel-btn {
    padding: 5px 15px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
}

.edit-btn {
    background-color: #4CAF50;
    color: white;
}

.delete-btn {
    background-color: #f44336;
    color: white;
}

.save-btn {
    background-color: #2196F3;
    color: white;
}

.cancel-btn {
    background-color: #607D8B;
    color: white;
}

.edit-actions {
    display: flex;
    gap: 10px;
}
</style>

<script>
function showEdit(id) {
    document.getElementById('display_' + id).style.display = 'none';
    document.getElementById('edit_' + id).style.display = 'block';
}

function hideEdit(id) {
    document.getElementById('display_' + id).style.display = 'flex';
    document.getElementById('edit_' + id).style.display = 'none';
}
</script>