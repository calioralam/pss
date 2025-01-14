<?php
// Menghubungkan ke AuthController dan TaskController
include_once('../controllers/AuthController.php');
include_once('../controllers/TaskController.php'); // Memastikan fungsi createTask ada

// Verifikasi token
if (!isset($_COOKIE['auth_token'])) {
    header("Location: login.php");
    exit;
}

$token = $_COOKIE['auth_token'];
$userSession = validateToken($token);

if (!$userSession) {
    header("Location: login.php");
    exit;
}

// Mendapatkan ID task yang akan diubah
if (isset($_GET['id'])) {
    $taskId = $_GET['id'];

    // Mengambil task dari database untuk di-edit
    $stmt = $pdo->prepare("SELECT * FROM tasks WHERE id = :id AND user_id = :user_id");
    $stmt->execute(['id' => $taskId, 'user_id' => $userSession['user_id']]);
    $task = $stmt->fetch();

    if (!$task) {
        echo "Task tidak ditemukan.";
        exit;
    }
}

// Proses pengubahan task
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $category = $_POST['category'];
    $description = $_POST['description'];

    // Update task di database
    $stmt = $pdo->prepare("UPDATE tasks SET category = :category, description = :description WHERE id = :id AND user_id = :user_id");
    $stmt->execute([
        'category' => $category,
        'description' => $description,
        'id' => $taskId,
        'user_id' => $userSession['user_id']
    ]);
    header("Location: task-list.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Task</title>
    <style>
         body {
     font-family: Arial, sans-serif;
     margin: 0;
     padding: 20px;
     background-color: #f4f4f4;
 }

 .search-task-container {
     max-width: 800px;
     margin: 0 auto;
     background: white;
     padding: 20px;
     border-radius: 5px;
     box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
 }

 h2 {
     color: #333;
 }

 table {
     width: 100%;
     border-collapse: collapse;
     margin-top: 20px;
 }

 table,
 th,
 td {
     border: 1px solid #ccc;
 }

 th,
 td {
     padding: 10px;
     text-align: left;
 }

 th {
     background-color: #f4f4f4;
 }

 .no-results {
     text-align: center;
     color: #888;
 }

 form {
     display: flex;
     gap: 10px;
 }

 input[type="text"] {
     flex: 1;
     padding: 10px;
     font-size: 16px;
     border: 1px solid #ccc;
     border-radius: 5px;
 }

 button {
     background-color: #28a745;
     color: white;
     padding: 10px 20px;
     border: none;
     border-radius: 5px;
     cursor: pointer;
     font-size: 16px;
 }

 button:hover {
     background-color: #218838;
 }

 .back-link {
     display: inline-block;
     margin-top: 20px;
     text-decoration: none;
     color: #007bff;
 }

 .back-link:hover {
     text-decoration: underline;
 }
    </style>
</head>
<body>
    <h2>Edit Task</h2>

    <!-- Form untuk mengedit task -->
    <form method="POST">
        <label for="category">Category:</label>
        <input type="text" name="category" value="<?php echo htmlspecialchars($task['category']); ?>" required>

        <label for="description">Description:</label>
        <input type="text" name="description" value="<?php echo htmlspecialchars($task['description']); ?>" required></input>

        <button type="submit">Update Task</button>
    </form>
</body>
</html>
