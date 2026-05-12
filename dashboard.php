<?php
session_start();

// Validasi akses
if (!isset($_SESSION['login'])) {
    header("Location: index.php");
    exit;
}

// Proses Logout
if (isset($_POST['logout'])) {
    session_destroy();
    header("Location: index.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard - IoTernak</title>
    <style>
        body { font-family: 'Segoe UI', sans-serif; background: #f4f7f6; margin: 0; }
        header { background: #2c3e50; color: white; padding: 1.5rem 2rem; display: flex; justify-content: space-between; align-items: center; box-shadow: 0 2px 5px rgba(0,0,0,0.1); }
        .header-title h2 { margin: 0; font-size: 1.5rem; }
        .header-title small { color: #bdc3c7; }
        .btn-logout { background: #e74c3c; color: white; border: none; padding: 8px 16px; border-radius: 4px; cursor: pointer; font-weight: bold; }
        .btn-logout:hover { background: #c0392b; }
        .container { padding: 2rem; max-width: 1000px; margin: auto; }
        .status-badge { display: inline-block; padding: 5px 10px; background: #2ecc71; color: white; border-radius: 20px; font-size: 0.85rem; font-weight: bold; margin-bottom: 20px; }
        
        /* Tambahan CSS untuk Form Pencarian */
        .search-section { background: white; padding: 20px; border-radius: 8px; box-shadow: 0 2px 8px rgba(0,0,0,0.05); margin-bottom: 20px; border-left: 4px solid #f39c12; }
        .search-section input[type="text"] { width: 60%; padding: 10px; border: 1px solid #ccc; border-radius: 4px; font-size: 1rem; }
        .search-section button { padding: 10px 20px; background: #f39c12; color: white; border: none; border-radius: 4px; cursor: pointer; font-weight: bold; font-size: 1rem; }
        .search-section button:hover { background: #e67e22; }
        .search-result { margin-top: 15px; padding: 10px; background: #fdfefe; border: 1px dashed #bdc3c7; }
        
        .grid { display: flex; gap: 20px; flex-wrap: wrap; }
        .card { background: white; padding: 20px; border-radius: 8px; box-shadow: 0 2px 8px rgba(0,0,0,0.05); flex: 1; min-width: 250px; border-top: 4px solid #3498db; }
        .card h3 { margin-top: 0; color: #7f8c8d; font-size: 1rem; text-transform: uppercase; letter-spacing: 1px; }
        .card .value { font-size: 2.5rem; color: #2c3e50; font-weight: bold; margin: 10px 0; }
        .card .desc { font-size: 0.9rem; color: #95a5a6; }
    </style>
</head>
<body>
    <header>
        <div class="header-title">
            <h2>Dashboard Utama</h2>
            <small>Sistem Pemantauan Smart Kandang (IoTernak)</small>
        </div>
        <form method="POST" style="margin: 0;">
            <button type="submit" name="logout" class="btn-logout">Keluar (Logout)</button>
        </form>
    </header>

    <div class="container">
        <h2 style="color: #2c3e50;">Selamat datang, <?php echo htmlspecialchars($_SESSION['username']); ?>!</h2>
        <div class="status-badge">● Node ESP32 Terhubung</div>
        
        <div class="search-section">
            <h3 style="margin-top: 0; color: #2c3e50;">Pencarian Log Sensor</h3>
            <form action="" method="GET">
                <input type="text" name="query" placeholder="Masukkan ID Sensor" required>
                <button type="submit">Cari Data</button>
            </form>

            <?php
            // Menangkap input pencarian dan mencetaknya secara mentah untuk memicu IDS
            if (isset($_GET['query'])) {
                $query = $_GET['query'];
                echo "<div class='search-result'>";
                // PERINGATAN: Variabel $query tidak disanitasi (tanpa htmlspecialchars) 
                // untuk keperluan pengujian kerentanan XSS pada Suricata.
                echo "<strong>Hasil pencarian untuk:</strong> " . $query;
                echo "<p style='color: #7f8c8d; font-size: 0.9rem;'><em>Data tidak ditemukan di dalam arsip log.</em></p>";
                echo "</div>";  
            }
            ?>
        </div>
        <div class="grid">
            <div class="card" style="border-top-color: #e67e22;">
                <h3>Suhu Ruangan</h3>
                <div class="value">28.5 °C</div>
                <div class="desc">Sensor: DHT22 | Status: Normal</div>
            </div>
            <div class="card" style="border-top-color: #3498db;">
                <h3>Kelembapan Udara</h3>
                <div class="value">65 %</div>
                <div class="desc">Sensor: DHT22 | Status: Optimal</div>
            </div>
            <div class="card" style="border-top-color: #9b59b6;">
                <h3>Kadar Gas Amonia</h3>
                <div class="value">12 PPM</div>
                <div class="desc">Sensor: MQ-135 | Status: Aman</div>
            </div>
        </div>
    </div>
</body>
</html>