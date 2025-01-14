<?php
// Menghubungkan ke database
include_once('../config/database.php');

function validateToken($token) {
    global $pdo;
    $stmt = $pdo->prepare("SELECT * FROM user_sessions WHERE token = :token");
    $stmt->execute(['token' => $token]);
    return $stmt->fetch();
}

function login($username, $password) {
    global $pdo;
    // Memeriksa apakah username ada di dalam database
    $stmt = $pdo->prepare("SELECT * FROM users WHERE username = :username");
    $stmt->execute(['username' => $username]);
    $user = $stmt->fetch();

    // Verifikasi password yang dimasukkan dengan password yang tersimpan di database
    if ($user && password_verify($password, $user['password'])) {
        // Membuat token unik untuk pengguna
        $token = bin2hex(random_bytes(32)); // Token random sepanjang 64 karakter
        setcookie('auth_token', $token, time() + 3600, '/');  // Menyimpan token di cookies selama 1 jam

        // Menyimpan token dalam sesi pengguna di database
        $stmt = $pdo->prepare("INSERT INTO user_sessions (user_id, token) VALUES (:user_id, :token)");
        $stmt->execute(['user_id' => $user['id'], 'token' => $token]);

        return $token;  // Mengembalikan token
    }

    return false;  // Jika login gagal
}
?>
