<?php include 'nav.html.php'; ?>

<div class="py-12">
    <div class="container px-4 md:px-6">
        <div class="flex justify-between items-center mb-8">
            <div>
                <h1 class="text-3xl font-bold">Manage Modules</h1>
                <p class="text-gray-500">Add, edit, and delete course modules</p>
            </div>
        </div>

        <div class="grid gap-6 md:grid-cols-2">
            <!-- Add New Module Card -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-100 p-6">
                <h2 class="text-xl font-bold mb-4">Add New Module</h2>
                <form action="" method="post" class="space-y-4">
                    <div>
                        <label for="moduleName" class="block text-sm font-medium text-gray-700">Module Name</label>
                        <input type="text" name="moduleName" id="moduleName" required
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm"
                            placeholder="Enter module name">
                    </div>
                    <button type="submit" class="btn btn-primary w-full">
                        <i class="fas fa-plus mr-2"></i> Add Module
                    </button>
                </form>
            </div>

            <!-- Existing Modules Card -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-100 p-6">
                <h2 class="text-xl font-bold mb-4">Existing Modules</h2>
                <div class="space-y-4">
                    <?php foreach ($modules as $module): ?>
                        <div class="border border-gray-200 rounded-lg" id="module_<?= $module['id'] ?>">
                            <!-- Display View -->
                            <div class="p-4 flex justify-between items-center" id="display_<?= $module['id'] ?>">
                                <span class="text-gray-900"><?= htmlspecialchars($module['modules']) ?></span>
                                <div class="flex gap-2">
                                    <button onclick="showEdit(<?= $module['id'] ?>)" 
                                            class="text-blue-600 hover:text-blue-700">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <form action="" method="post" class="inline">
                                        <input type="hidden" name="id" value="<?= $module['id'] ?>">
                                        <button type="submit" name="delete" 
                                                class="text-red-600 hover:text-red-700"
                                                onclick="return confirm('Are you sure you want to delete this module?')">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </div>

                            <!-- Edit View -->
                            <div class="p-4 hidden" id="edit_<?= $module['id'] ?>">
                                <form action="" method="post" class="flex gap-2">
                                    <input type="hidden" name="moduleId" value="<?= $module['id'] ?>">
                                    <input type="hidden" name="update" value="1">
                                    <input type="text" name="updatedName" 
                                           value="<?= htmlspecialchars($module['modules']) ?>" required
                                           class="flex-1 rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
                                    <button type="submit" class="text-green-600 hover:text-green-700">
                                        <i class="fas fa-check"></i>
                                    </button>
                                    <button type="button" onclick="hideEdit(<?= $module['id'] ?>)" 
                                            class="text-gray-600 hover:text-gray-700">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </form>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</div>

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