<?php
// Konfigurasi untuk lokal (XAMPP)
$host = 'localhost';          
$port = '3306';               
$username = 'root';           
$password = '';               
$database = 'phpdasar';     

// Membuat koneksi
$conn = new mysqli($host, $username, $password, $database, $port);

// Cek koneksi
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
echo "Connected successfully!";
?>
