<?php
include_once('../config/database.php');

function createTask($category, $description, $userId) {
    global $pdo;
    $stmt = $pdo->prepare("INSERT INTO tasks (category, description, user_id) VALUES (:category, :description, :user_id)");
    $stmt->execute([
        'category' => $category,
        'description' => $description,
        'user_id' => $userId
    ]);
}

function getTasks($userId) {
    global $pdo;
    $stmt = $pdo->prepare("SELECT * FROM tasks WHERE user_id = :user_id");
    $stmt->execute(['user_id' => $userId]);
    return $stmt->fetchAll();
}

function updateTask($id, $category, $description) {
    global $pdo;
    $stmt = $pdo->prepare("UPDATE tasks SET category = :category, description = :description WHERE id = :id");
    $stmt->execute(['category' => $category, 'description' => $description, 'id' => $id]);
}

function deleteTask($id) {
    global $pdo;
    $stmt = $pdo->prepare("DELETE FROM tasks WHERE id = :id");
    $stmt->execute(['id' => $id]);
}
?>
