<?php
include_once('../controllers/TaskController.php');
include_once('../controllers/AuthController.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_GET['action']) && $_GET['action'] == 'create') {
    $token = $_POST['token'];
    $taskData = $_POST['task']; 
    $userSession = validateToken($token);
    
    if ($userSession) {
        createTask($taskData['category'], $taskData['description'], $userSession['user_id']);
        echo json_encode(['message' => 'Task created']);
    } else {
        echo json_encode(['message' => 'Invalid token']);
    }
}
