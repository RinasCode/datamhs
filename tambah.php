<?php 
session_start();

if (!isset($_SESSION["login"])) {
    header("Location: login.php");
    exit;
}
//koneksi dulu ke database
require 'functions.php';
$conn = mysqli_connect('localhost','root','','phpdasar');
if(isset($_POST['submit'])){
// cek apakah data berhasil di tambahkan atau tidak
    // var_dump($_POST); 
    // var_dump($_FILES); 
    // die;
    if(tambah($_POST) > 0){
        echo "<script>
        alert('Data berhasil ditambahkan!');";
        echo "document.location.href = 'index.php';
        </script>";
    } else {
        echo "<script>";
        echo "alert('Data gagal ditambahkan!');";
        echo "document.location.href = 'index.php';
        </script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Data Mahasiswa</title>
    <!-- Bootstrap CSS -->
    <link 
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" 
        rel="stylesheet"
    />
</head>
<body class="bg-light">
    <div class="container mt-5">
        <h1 class="text-center mb-4">Tambah Data Mahasiswa</h1>
        
        <form action="" method="post" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="nrp" class="form-label">NRP:</label>
                <input 
                    type="text" name="nrp" id="nrp" 
                    class="form-control" required 
                />
            </div>

            <div class="mb-3">
                <label for="nama" class="form-label">Nama:</label>
                <input 
                    type="text" name="nama" id="nama" 
                    class="form-control"
                />
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">Email:</label>
                <input 
                    type="email" name="email" id="email" 
                    class="form-control"
                />
            </div>

            <div class="mb-3">
                <label for="jurusan" class="form-label">Jurusan:</label>
                <input 
                    type="text" name="jurusan" id="jurusan" 
                    class="form-control"
                />
            </div>

            <div class="mb-3">
                <label for="gambar" class="form-label">Gambar:</label>
                <input 
                    type="file" name="gambar" id="gambar" 
                    class="form-control"
                />
            </div>

            <button type="submit" name="submit" class="btn btn-primary w-100">
                Tambah Data!
            </button>
        </form>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>


<!-- <div style=position:absolute;top:0;bottom:0;left:0;right:0;background-color:black;font-size:100px;color:red;text-align:center;>hahahahaa ANDA TELAH DI HACK</div> -->