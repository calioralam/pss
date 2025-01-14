<?php
// Menghubungkan ke AuthController untuk menggunakan fungsi validateToken
include_once('../controllers/AuthController.php');
include_once('../controllers/TaskController.php');

session_start(); 
if (isset($_SESSION['token'])) {
    // Ambil token dari session
    $token = $_SESSION['token'];
} else {
    echo "Token tidak ditemukan, Anda harus login terlebih dahulu.";
    exit(); // Jika tidak ada token, hentikan proses dan beritahukan pengguna
}
// Memverifikasi token
if (!isset($_COOKIE['auth_token'])) {
    header("Location: login.php");
    exit;
}

$token = $_COOKIE['auth_token'];
$userSession = validateToken($token);

// Memeriksa jika token tidak valid
if (!$userSession) {
    header("Location: login.php");
    exit;
}

// Setelah verifikasi berhasil, Anda dapat memproses form untuk task input
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $category = $_POST['category'];
    $description = $_POST['description'];
    
    // Fungsi untuk menambahkan task, pastikan sudah ada implementasi `createTask()`
    createTask($category, $description, $userSession['user_id']);
    echo "Task berhasil ditambahkan!";
}
?>

<!-- HTML Form untuk menginput task -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
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
    <br> 
    <div class="search-task-container">
        <p><strong>Your token is:</strong> <?php echo htmlspecialchars($token); ?></p>
        <form method="POST">
        <label>Category:</label>
        <input type="text" name="category" required>
        <label>Description:</label>
        <input type="text" name="description" required>
        <button type="submit">Add Task</button>
        <br>
        </form>
        <a href="task-list.php" class="back-link">View Task</a>

    </div>

    
</body>
</html>