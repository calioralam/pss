<?php
session_start();
require '../config/database.php'; // Pastikan ini adalah path yang benar

// Cek jika pengguna belum login
if (!isset($_SESSION['token'])) {
    header('Location: index.php');
    exit();
}

// Variabel pencarian dan hasil
$search = "";
$tasks = [];

// Cek koneksi dengan PDO (untuk debugging)
if (!$pdo) {
    die("Koneksi ke database gagal");
}

// Jika pencarian dilakukan
if (isset($_GET['search']) && !empty($_GET['search'])) {
    $search = htmlspecialchars($_GET['search']);

    // Query untuk mencari task berdasarkan kategori
    $stmt = $pdo->prepare("SELECT * FROM tasks WHERE category LIKE ?");
    $searchParam = "%" . $search . "%";
    $stmt->bindParam(1, $searchParam, PDO::PARAM_STR);
    $stmt->execute();

    // Ambil data hasil pencarian
    $tasks = $stmt->fetchAll(PDO::FETCH_ASSOC);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Tasks</title>
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
        table, th, td {
            border: 1px solid #ccc;
        }
        th, td {
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
        <h2>Search Tasks</h2>
        
        <!-- Form untuk pencarian -->
        <form action="" method="GET">
            <input type="text" name="search" placeholder="Search tasks by category..." 
                   value="<?php echo htmlspecialchars($search); ?>">
            <button type="submit">Search</button>
        </form>

        <!-- Hasil Pencarian -->
        <?php if (!empty($search)): ?>
            <?php if (count($tasks) > 0): ?>
                <h3>Results for "<?php echo htmlspecialchars($search); ?>"</h3>
                <table>
                    <tr>
                        <th>ID</th>
                        <th>Category</th>
                        <th>Description</th>
                    </tr>
                    <?php foreach ($tasks as $task): ?>
                        <tr>
                            <td><?php echo $task['id']; ?></td>
                            <td><?php echo htmlspecialchars($task['category']); ?></td>
                            <td><?php echo htmlspecialchars($task['description']); ?></td>
                        </tr>
                    <?php endforeach; ?>
                </table>
            <?php else: ?>
                <p>No tasks found for "<?php echo htmlspecialchars($search); ?>".</p>
            <?php endif; ?>
        <?php else: ?>
            <p>Enter a keyword to search for tasks.</p>
        <?php endif; ?>

        <!-- Link kembali -->
        <a href="task-list.php" class="back-link">Back to Task List</a>
    </div>
</body>
</html>
