<?php
// Menghubungkan ke controller dan database
include_once('../config/database.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);  // Meng-hash password

    // Mengecek apakah username sudah ada di database
    $stmt = $pdo->prepare("SELECT * FROM users WHERE username = :username");
    $stmt->execute(['username' => $username]);
    if ($stmt->rowCount() > 0) {
        echo "Username sudah terdaftar. Silakan pilih username lain.";
    } else {
        // Jika username belum ada, masukkan user baru ke dalam tabel users
        $stmt = $pdo->prepare("INSERT INTO users (username, password) VALUES (:username, :password)");
        $stmt->execute(['username' => $username, 'password' => $hashedPassword]);
        echo "Pendaftaran berhasil! Sekarang silakan login.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar</title>
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
    </style>    </head>
<body>
    <div class="search-task-container">
    <h2>Daftar</h2>
    <!-- Form pendaftaran -->
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
            <button type="submit">Daftar</button>
        </div>
    </form>
    <p>Sudah punya akun? <a href="login.php" class="back-link">Login</a>
</div>
</body>
</html>
