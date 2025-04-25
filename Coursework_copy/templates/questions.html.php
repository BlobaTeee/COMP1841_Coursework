<?php include 'templates/header.html.php'; ?>

<div class="py-12">
    <div class="container px-4 md:px-6 mx-auto max-w-7xl">
        <div class="flex flex-col gap-8 items-center">
            <div class="flex flex-col items-center text-center gap-2">
                <h1 class="text-3xl font-bold">Questions</h1>
                <p class="text-gray-500">Browse through our collection of questions</p>
                <?php if (isset($_SESSION['user_id'])): ?>
                    <a href="addquestion.php" class="btn btn-primary mt-4">
                        <i class="fas fa-plus mr-2"></i> Add Question
                    </a>
                <?php endif; ?>
            </div>
            
            <form action="" method="GET" class="w-full flex justify-center">
                <div class="flex w-full max-w-sm items-center space-x-2">
                    <input type="search" name="search" placeholder="Search questions..." 
                           class="form-input flex-grow"
                           value="<?= isset($_GET['search']) ? htmlspecialchars($_GET['search']) : '' ?>">
                    <button type="submit" class="btn btn-primary btn-icon">
                        <i class="fas fa-search"></i>
                    </button>
                </div>
            </form>

            <?php if (isset($_GET['search']) && trim($_GET['search']) !== ''): ?>
                <div class="w-full flex justify-center">
                    <div class="flex items-center space-x-2">
                        <span class="text-sm text-gray-500">
                            Search results for: "<?= htmlspecialchars($_GET['search']) ?>"
                        </span>
                        <a href="?" class="text-sm text-blue-600 hover:text-blue-800">
                            <i class="fas fa-times"></i> Clear search
                        </a>
                    </div>
                </div>
            <?php endif; ?>

            <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-3 w-full">
                <?php foreach ($questions as $question): ?>
                    <div class="bg-white rounded-lg shadow-sm overflow-hidden border border-gray-100 hover:shadow-md transition-shadow flex flex-col h-full"
                         data-question-id="<?= $question['id'] ?>">
                        <?php if ($question['img']): ?>
                            <img src="<?= htmlspecialchars($question['img']) ?>" alt="Question image" class="w-full h-48 object-cover">
                        <?php endif; ?>
                        <div class="p-4 flex-grow flex flex-col">
                            <div class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800 mb-2">
                                <?= htmlspecialchars($question['modules']) ?>
                            </div>
                            <p class="text-gray-700 mb-2"><?= htmlspecialchars($question['Questions']) ?></p>
                            <div class="flex justify-between items-center text-sm text-gray-500 w-full">
                                <span>By: <?= htmlspecialchars($question['user']) ?></span>
                            </div>

                            <!-- Comments Section -->
                            <div class="w-full mt-4 border-t border-gray-100 pt-4 flex-grow">
                                <h3 class="text-sm font-medium text-gray-900 mb-2">Comments</h3>
                                
                                <div id="comments-container-<?= $question['id'] ?>" class="space-y-3">
                                    <?php if (!empty($question['comments'])): ?>
                                        <?php foreach ($question['comments'] as $comment): ?>
                                            <div class="bg-gray-50 p-3 rounded-lg text-left" id="comment-<?= $comment['id'] ?>">
                                                <div class="flex justify-between items-start">
                                                    <div class="flex-grow">
                                                        <p class="text-sm text-gray-700" id="comment-text-<?= $comment['id'] ?>">
                                                            <?= htmlspecialchars($comment['comment']) ?>
                                                        </p>
                                                        <div class="mt-1 flex items-center justify-between text-xs text-gray-500">
                                                            <span>By: <?= htmlspecialchars($comment['comment_user']) ?></span>
                                                            <span><?= date('M j, Y', strtotime($comment['created_at'])) ?></span>
                                                        </div>
                                                    </div>
                                                    <?php if (isset($_SESSION['user_id']) && ($_SESSION['user_id'] == $comment['user_id'] || isset($_SESSION['role']) && $_SESSION['role'] === 'admin')): ?>
                                                        <div class="flex space-x-2 ml-2">
                                                            <button type="button" 
                                                                onclick="editComment(<?= $comment['id'] ?>, '<?= htmlspecialchars(addslashes($comment['comment'])) ?>')"
                                                                class="text-blue-600 hover:text-blue-800 transition-colors">
                                                                <i class="fas fa-edit"></i>
                                                            </button>
                                                            <button type="button"
                                                                onclick="return deleteComment(<?= $comment['id'] ?>);"
                                                                class="text-red-600 hover:text-red-800 transition-colors">
                                                                <i class="fas fa-trash"></i>
                                                            </button>
                                                        </div>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <p class="text-sm text-gray-500">No comments yet</p>
                                    <?php endif; ?>
                                </div>

                                <?php if (isset($_SESSION['user_id'])): ?>
                                    <form onsubmit="return addComment(event, <?= $question['id'] ?>)" class="mt-3">
                                        <div class="flex flex-col space-y-2">
                                            <textarea name="comment" rows="2" 
                                                class="form-input resize-none text-sm" 
                                                placeholder="Add a comment..."
                                                required></textarea>
                                            <button type="submit" 
                                                class="btn btn-primary btn-sm self-end">
                                                <i class="fas fa-paper-plane mr-1"></i>
                                                Comment
                                            </button>
                                        </div>
                                    </form>
                                <?php endif; ?>
                            </div>
                        </div>
                        <?php if (isset($_SESSION['user_id']) && $_SESSION['user_id'] == $question['userid']): ?>
                            <div class="bg-gray-50 px-4 py-3 flex justify-center space-x-2 border-t border-gray-100">
                                <a href="editquestion.php?id=<?= $question['id'] ?>" 
                                   class="text-blue-600 hover:text-blue-800 transition-colors">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <button type="button" 
                                        onclick="handleDelete(<?= $question['id'] ?>)"
                                        class="text-red-600 hover:text-red-800 transition-colors">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                        <?php endif; ?>
                    </div>
                <?php endforeach; ?>
            </div>

            <?php if (empty($questions)): ?>
                <div class="text-center py-12">
                    <p class="text-gray-500 mb-4">No questions found.</p>
                    <?php if (isset($_SESSION['user_id'])): ?>
                        <a href="addquestion.php" class="btn btn-primary">
                            <i class="fas fa-plus mr-2"></i> Add the First Question
                        </a>
                    <?php endif; ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<script>
function handleDelete(questionId) {
    if (confirm('Are you sure you want to delete this question? This action cannot be undone.')) {
        const form = document.createElement('form');
        form.method = 'POST';
        form.action = 'deletequestion.php';
        form.style.display = 'none';

        const input = document.createElement('input');
        input.type = 'hidden';
        input.name = 'id';
        input.value = questionId;

        form.appendChild(input);
        document.body.appendChild(form);
        form.submit();
    }
}

// Add Comment Function
function addComment(event, questionId) {
    event.preventDefault();
    const form = event.target;
    const textarea = form.querySelector('textarea');
    const comment = textarea.value.trim();
    
    if (!comment) return;

    fetch('addcomment.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: 'question_id=' + encodeURIComponent(questionId) + '&comment=' + encodeURIComponent(comment)
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            location.reload(); // Reload to show new comment
        } else {
            alert(data.error || 'Error adding comment');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Error adding comment. Please try again.');
    });

    textarea.value = ''; // Clear textarea
    return false;
}

// Edit Comment Function
function editComment(commentId, currentComment) {
    const commentElement = document.getElementById('comment-' + commentId);
    const commentText = document.getElementById('comment-text-' + commentId);
    
    if (!commentElement || !commentText) return;
    
    // Create edit form
    const editForm = document.createElement('form');
    editForm.className = 'mt-2';
    editForm.innerHTML = `
        <textarea class="form-input w-full text-sm" rows="2">${currentComment}</textarea>
        <div class="flex justify-end space-x-2 mt-2">
            <button type="button" class="btn btn-sm btn-secondary" onclick="cancelEdit(${commentId})">Cancel</button>
            <button type="submit" class="btn btn-sm btn-primary">Save</button>
        </div>
    `;
    
    // Hide original comment and show edit form
    commentText.style.display = 'none';
    commentElement.appendChild(editForm);
    
    // Handle form submission
    editForm.onsubmit = function(e) {
        e.preventDefault();
        const newComment = this.querySelector('textarea').value.trim();
        
        if (!newComment || newComment === currentComment) {
            cancelEdit(commentId);
            return;
        }
        
        fetch('editcomment.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: 'comment_id=' + encodeURIComponent(commentId) + '&comment=' + encodeURIComponent(newComment)
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                commentText.textContent = newComment;
                cancelEdit(commentId);
            } else {
                alert(data.error || 'Error updating comment');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Error updating comment. Please try again.');
        });
    };
}

// Cancel Edit Function
function cancelEdit(commentId) {
    const commentElement = document.getElementById('comment-' + commentId);
    const commentText = document.getElementById('comment-text-' + commentId);
    const editForm = commentElement.querySelector('form');
    
    if (!commentElement || !commentText || !editForm) return;
    
    commentText.style.display = 'block';
    editForm.remove();
}

// Delete Comment Function
function deleteComment(commentId) {
    if (!confirm('Are you sure you want to delete this comment?')) {
        return false;
    }

    fetch('deletecomment.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: 'comment_id=' + encodeURIComponent(commentId)
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            const commentElement = document.getElementById('comment-' + commentId);
            if (commentElement) {
                commentElement.remove();
            }
        } else {
            alert(data.error || 'Error deleting comment');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Error deleting comment. Please try again.');
    });

    return false;
}
</script> 