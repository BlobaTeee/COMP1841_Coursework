<?php
class Comment {
    private $pdo;
    private $user_id;
    private $is_admin;

    public function __construct($pdo, $user_id = null, $is_admin = false) {
        $this->pdo = $pdo;
        $this->user_id = $user_id;
        $this->is_admin = $is_admin;
    }

    /**
     * Add a new comment
     */
    public function add($question_id, $comment) {
        try {
            // Validate input
            if (empty($comment)) {
                throw new Exception('Comment cannot be empty');
            }

            // Check if question exists
            $stmt = $this->pdo->prepare('SELECT id FROM Questions WHERE id = ?');
            $stmt->execute([$question_id]);
            if (!$stmt->fetch()) {
                throw new Exception('Question not found');
            }

            // Insert comment
            $stmt = $this->pdo->prepare('
                INSERT INTO Comments (question_id, user_id, comment)
                VALUES (?, ?, ?)
            ');
            $stmt->execute([$question_id, $this->user_id, $comment]);

            return $this->getCommentById($this->pdo->lastInsertId());
        } catch (PDOException $e) {
            error_log('Database error in Comment::add: ' . $e->getMessage());
            throw new Exception('Failed to add comment');
        }
    }

    /**
     * Edit a comment
     */
    public function edit($comment_id, $new_comment) {
        try {
            // Validate input
            if (empty($new_comment)) {
                throw new Exception('Comment cannot be empty');
            }

            // Check if comment exists and user has permission
            $comment = $this->getCommentById($comment_id);
            if (!$comment) {
                throw new Exception('Comment not found');
            }

            if (!$this->canModify($comment)) {
                throw new Exception('You do not have permission to edit this comment');
            }

            // Update comment
            $stmt = $this->pdo->prepare('
                UPDATE Comments 
                SET comment = ?
                WHERE id = ?
            ');
            $stmt->execute([$new_comment, $comment_id]);

            return $this->getCommentById($comment_id);
        } catch (PDOException $e) {
            error_log('Database error in Comment::edit: ' . $e->getMessage());
            throw new Exception('Failed to edit comment');
        }
    }

    /**
     * Delete a comment
     */
    public function delete($comment_id) {
        try {
            // Check if comment exists and user has permission
            $comment = $this->getCommentById($comment_id);
            if (!$comment) {
                throw new Exception('Comment not found');
            }

            if (!$this->canModify($comment)) {
                throw new Exception('You do not have permission to delete this comment');
            }

            // Delete comment
            $stmt = $this->pdo->prepare('DELETE FROM Comments WHERE id = ?');
            $stmt->execute([$comment_id]);

            return true;
        } catch (PDOException $e) {
            error_log('Database error in Comment::delete: ' . $e->getMessage());
            throw new Exception('Failed to delete comment');
        }
    }

    /**
     * Get a comment by ID
     */
    public function getCommentById($comment_id) {
        try {
            $stmt = $this->pdo->prepare('
                SELECT c.*, u.user as comment_user
                FROM Comments c
                JOIN Users u ON c.user_id = u.id
                WHERE c.id = ?
            ');
            $stmt->execute([$comment_id]);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log('Database error in Comment::getCommentById: ' . $e->getMessage());
            return null;
        }
    }

    /**
     * Get all comments for a question
     */
    public function getCommentsByQuestionId($question_id) {
        try {
            $stmt = $this->pdo->prepare('
                SELECT c.*, u.user as comment_user
                FROM Comments c
                JOIN Users u ON c.user_id = u.id
                WHERE c.question_id = ?
                ORDER BY c.created_at DESC
            ');
            $stmt->execute([$question_id]);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log('Database error in Comment::getCommentsByQuestionId: ' . $e->getMessage());
            return [];
        }
    }

    /**
     * Check if user can modify a comment
     */
    private function canModify($comment) {
        return $this->is_admin || $comment['user_id'] == $this->user_id;
    }

    /**
     * Format comment for display
     */
    public function formatComment($comment) {
        if (!$comment) return null;

        return [
            'id' => $comment['id'],
            'comment' => $comment['comment'],
            'user_id' => $comment['user_id'],
            'comment_user' => $comment['comment_user'],
            'created_at' => date('M j, Y g:i A', strtotime($comment['created_at'])),
            'can_modify' => $this->canModify($comment)
        ];
    }
} 