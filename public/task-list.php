<?php
// Menghubungkan ke AuthController untuk memvalidasi token
include_once('../controllers/AuthController.php');
include_once('../controllers/TaskController.php'); // Pastikan task controller juga di-include


if (isset($_POST['delete'])) {
    // Menghapus task
    $taskId = $_POST['task_id'];
    
    // Prepare query untuk menghapus task berdasarkan task ID
    $stmt = $pdo->prepare("DELETE FROM tasks WHERE id = :task_id");
    $stmt->execute(['task_id' => $taskId]);
    
    // Setelah menghapus, refresh halaman
    header("Location: task-list.php");
    exit;
}

// Verifikasi token
if (!isset($_COOKIE['auth_token'])) {
    header("Location: login.php");
    exit;
}

$token = $_COOKIE['auth_token'];
$userSession = validateToken($token); // Memastikan token valid

if (!$userSession) {
    header("Location: login.php");
    exit;
}

// Mengambil daftar task milik user
$userId = $userSession['user_id'];
$stmt = $pdo->prepare("SELECT * FROM tasks WHERE user_id = :user_id");
$stmt->execute(['user_id' => $userId]);
$tasks = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Task List</title>
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
    <div class="search-task-container">

    <h2>Task List</h2>

    <!-- Menampilkan daftar task -->
    <table>
        <tr>
            <th>Category</th>
            <th>Description</th>
            <th>Actions</th>
        </tr>
        <?php foreach ($tasks as $task): ?>
        <tr>
            <td><?php echo htmlspecialchars($task['category']); ?></td>
            <td><?php echo htmlspecialchars($task['description']); ?></td>
            <td>
                <!-- Link untuk Edit -->
                <a href="edit-task.php?id=<?php echo $task['id']; ?>">Edit</a> 
                <!-- Form untuk Hapus -->
                <form action="task-list.php" method="POST" style="display:inline;">
                    <input type="hidden" name="task_id" value="<?php echo $task['id']; ?>">
                    <button type="submit" name="delete" onclick="return confirm('Are you sure you want to delete this task?')">Delete</button>
                </form>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
            <a href="task-input.php" class="back-link">Input Task</a><br>
            <a href="search_task.php" class="back-link">Search Task</a>
    </div>
</body>
</html>
