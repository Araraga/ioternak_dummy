<?php
session_start();
require 'koneksi.php';
$pesan = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = $_POST['password'];

    $query = "SELECT * FROM pengguna WHERE username='$username'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) === 1) {
        $row = mysqli_fetch_assoc($result);
        if (password_verify($password, $row['password'])) {
            $_SESSION['login'] = true;
            $_SESSION['username'] = $username;
            header("Location: dashboard.php");
            exit;
        } else {
            $pesan = "<div class='alert error'>Password yang dimasukkan salah!</div>";
        }
    } else {
        $pesan = "<div class='alert error'>Username tidak ditemukan!</div>";
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login - IoTernak</title>
    <style>
        body { font-family: 'Segoe UI', sans-serif; background: #2c3e50; display: flex; justify-content: center; align-items: center; height: 100vh; margin: 0; }
        .card { background: white; padding: 2rem; border-radius: 8px; box-shadow: 0 4px 15px rgba(0,0,0,0.2); width: 100%; max-width: 350px; }
        .form-group { margin-bottom: 15px; }
        input { width: 100%; padding: 10px; margin-top: 5px; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box; }
        button { width: 100%; padding: 10px; background: #2ecc71; color: white; border: none; border-radius: 4px; cursor: pointer; font-weight: bold; }
        button:hover { background: #27ae60; }
        .alert { padding: 10px; border-radius: 4px; margin-bottom: 15px; text-align: center; }
        .error { background: #f8d7da; color: #721c24; }
        .link { text-align: center; margin-top: 15px; font-size: 0.9em; }
    </style>
</head>
<body>
    <div class="card">
        <h2 style="text-align: center; color: #2c3e50;">Portal IoTernak</h2>
        <p style="text-align: center; color: #7f8c8d; font-size: 0.9em; margin-top: -10px;">Autentikasi Sistem Monitoring</p>
        <?php echo $pesan; ?>
        <form method="POST">
            <div class="form-group">
                <label>Username</label>
                <input type="text" name="username" required>
            </div>
            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" required>
            </div>
            <button type="submit">Masuk Sistem</button>
        </form>
        <div class="link">
            Belum memiliki akun? <a href="register.php">Daftar di sini</a>
        </div>
    </div>
</body>
</html>