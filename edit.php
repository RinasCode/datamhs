<?php 
session_start();

if (!isset($_SESSION["login"])) {
    header("Location: login.php");
    exit;
}
require 'functions.php';

$id = $_GET['id'];
// var_dump($id);

$mhs = query("SELECT * FROM mahasiswa WHERE id = $id")[0];
// var_dump($mhs["nama"]);


if(isset($_POST['submit'])){
// cek apakah data berhasil di ubah atau tidak
    if(ubah($_POST) > 0){
        echo "<script>
        alert('Data berhasil diubah!');";
        echo "document.location.href = 'index.php';
        </script>";
    } else {
        echo "<script>";
        echo "alert('Data gagal diubah!');";
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
    <title>Ubah Data Mahasiswa</title>
    <!-- Bootstrap CSS -->
    <link 
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" 
        rel="stylesheet"
    />
</head>
<body class="bg-light">
    <div class="container mt-5">
        <h1 class="text-center mb-4">Ubah Data Mahasiswa</h1>

        <form action="" method="post" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?= $mhs["id"]; ?>">
            <input type="hidden" name="gambarLama" value="<?= $mhs["gambar"]; ?>">

            <div class="mb-3">
                <label for="nrp" class="form-label">NRP:</label>
                <input 
                    type="text" name="nrp" id="nrp" 
                    class="form-control" required 
                    value="<?= $mhs["nrp"]; ?>"
                />
            </div>

            <div class="mb-3">
                <label for="nama" class="form-label">Nama:</label>
                <input 
                    type="text" name="nama" id="nama" 
                    class="form-control" 
                    value="<?= $mhs["nama"]; ?>"
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
                    value="<?= $mhs["jurusan"]; ?>"
                />
            </div>

            <div class="mb-3">
                <label for="gambar" class="form-label">Gambar:</label>
                <div class="d-flex align-items-center mb-2">
                    <img 
                        src="../samsung/<?= $mhs["gambar"]; ?>" 
                        alt="Gambar Mahasiswa" width="50" class="me-3"
                    />
                    <input 
                        type="file" name="gambar" id="gambar" 
                        class="form-control"
                    />
                </div>
            </div>

            <button type="submit" name="submit" class="btn btn-success w-100">
                Ubah Data!
            </button>
        </form>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

