<?php
// Menghubungkan ke controller untuk login
include_once('../controllers/AuthController.php');
    // Cek apakah data username dan password ada

function generate_token($user_id) {
    $random_string = bin2hex(random_bytes(32));  // Membuat string acak
    return hash('sha256', $random_string . $user_id);  // Hash untuk menghasilkan token yang aman
}
session_start(); // Mulai sesi


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $token = login($username, $password);
    
     if (isset($_POST['username']) && isset($_POST['password'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];

        // Query untuk mencari username
        require_once '../config/database.php';
        $stmt = $pdo->prepare("SELECT * FROM users WHERE username = :username");
        $stmt->execute(['username' => $username]);
        $user = $stmt->fetch();

        if ($user && password_verify($password, $user['password'])) {
            // Membuat token setelah login berhasil
            $token = generate_token($user['id']); // Sesuaikan fungsi generate_token()

            // Menyimpan token dalam session
            $_SESSION['token'] = $token;

            // Arahkan ke halaman task-input.php setelah login sukses
            header('Location: task-input.php');
            exit();
        } else {
            echo "Username atau password salah.";
        }
    }
    // Mengecek apakah login berhasil dan memberikan token
    if ($token) {
        // Setelah login sukses, alihkan ke task-input.php
        header("Location: task-input.php");
        exit;  // Pastikan kode berikutnya tidak dieksekusi setelah redirect
    } else {
        echo "Username atau password salah. Silakan coba lagi.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
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

    <h2>Login</h2>
    <!-- Form login -->
    <form method="POST">
        <div>
            <label for="username">Username:</label>
            <input type="text" name="username" id="username" required>
        </div>
        <div>
            <label for="password">Password:</label>
            <input type="password" name="password" id="password" required>
        </div>
        <div>
            <button type="submit">Login</button>
        </div>
    </form>

    <p>Belum punya akun? <a href="register.php" class="back-link">Daftar</a>
</p>
</div>
</body>
</html>
