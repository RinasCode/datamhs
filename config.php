<?php
$host = getenv('DB_HOST');   // Ambil dari environment variable
$port = getenv('DB_PORT');   // Ambil dari environment variable
$username = getenv('DB_USER'); // Ambil dari environment variable
$password = getenv('DB_PASS'); // Ambil dari environment variable
$database = getenv('DB_NAME'); // Ambil dari environment variable

// Membuat koneksi
$conn = new mysqli($host, $username, $password, $database, $port);

// Cek koneksi
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
echo "Connected successfully!";
?>
