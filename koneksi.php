<?php
$host = "localhost";
$user = "root";
$pass = "1234"; 
$db   = "ioternak_db";

$conn = mysqli_connect($host, $user, $pass, $db);

if (!$conn) {
    die("Koneksi basis data gagal: " . mysqli_connect_error());
}
?>