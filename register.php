<?php
require 'koneksi.php';
$pesan = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $cek_user = mysqli_query($conn, "SELECT * FROM pengguna WHERE username='$username'");
    
    if (mysqli_num_rows($cek_user) > 0) {
        $pesan = "<div class='alert error'>Username sudah terdaftar!</div>";
    } else {
        $query = "INSERT INTO pengguna (username, password) VALUES ('$username', '$password')";
        if (mysqli_query($conn, $query)) {
            $pesan = "<div class='alert success'>Registrasi berhasil. Silakan <a href='index.php'>Login</a></div>";
        } else {
            $pesan = "<div class='alert error'>Terjadi kesalahan sistem.</div>";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Registrasi - IoTernak</title>
    <style>
        body { font-family: 'Segoe UI', sans-serif; background: #f0f2f5; display: flex; justify-content: center; align-items: center; height: 100vh; margin: 0; }
        .card { background: white; padding: 2rem; border-radius: 8px; box-shadow: 0 4px 12px rgba(0,0,0,0.1); width: 100%; max-width: 350px; }
        .form-group { margin-bottom: 15px; }
        input { width: 100%; padding: 10px; margin-top: 5px; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box; }
        button { width: 100%; padding: 10px; background: #3498db; color: white; border: none; border-radius: 4px; cursor: pointer; font-weight: bold; }
        button:hover { background: #2980b9; }
        .alert { padding: 10px; border-radius: 4px; margin-bottom: 15px; text-align: center; }
        .success { background: #d4edda; color: #155724; }
        .error { background: #f8d7da; color: #721c24; }
        .link { text-align: center; margin-top: 15px; font-size: 0.9em; }
    </style>
</head>
<body>
    <div class="card">
        <h2 style="text-align: center; color: #2c3e50;">Buat Akun Baru</h2>
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
            <button type="submit">Daftar</button>
        </form>
        <div class="link">
            Sudah memiliki akun? <a href="index.php">Masuk di sini</a>
        </div>
    </div>
</body>
</html>