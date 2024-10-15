<?php
session_start();

if (!isset($_SESSION["login"])) {
    header("Location: login.php");
    exit;
}

require 'functions.php';

// Pagination
$jumlahDataPerHalaman = 3;
$halamanAktif = isset($_GET["halaman"]) ? (int)$_GET["halaman"] : 1;
$awalData = ($jumlahDataPerHalaman * $halamanAktif) - $jumlahDataPerHalaman;

$keyword = isset($_GET["keyword"]) ? $_GET["keyword"] : '';

if ($keyword) {
    // Pencarian dengan pagination
    $mahasiswa = query("SELECT * FROM mahasiswa WHERE 
        nama LIKE '%$keyword%' OR 
        nrp LIKE '%$keyword%' OR 
        email LIKE '%$keyword%' OR 
        jurusan LIKE '%$keyword%' 
        LIMIT $awalData, $jumlahDataPerHalaman");

    $jumlahData = count(query("SELECT * FROM mahasiswa WHERE 
        nama LIKE '%$keyword%' OR 
        nrp LIKE '%$keyword%' OR 
        email LIKE '%$keyword%' OR 
        jurusan LIKE '%$keyword%'"));
} else {
    // Query biasa tanpa pencarian
    $mahasiswa = query("SELECT * FROM mahasiswa LIMIT $awalData, $jumlahDataPerHalaman");
    $jumlahData = count(query("SELECT * FROM mahasiswa"));
}

$jumlahHalaman = ceil($jumlahData / $jumlahDataPerHalaman);
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Admin</title>
    <style>
        .loader {
            width: 70px;
            height: 70px;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            z-index: 1;
            display: none;
        }

        @media print {
            #logout, #tambah, #tombol-cari {
                display: none;
            }
        }
    </style>
    <!-- Bootstrap CSS -->
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
        rel="stylesheet" />
</head>

<body class="bg-light">
    <div class="container mt-5">
        <h1 class="text-center mb-4">Daftar Mahasiswa</h1>

        <a class="btn btn-primary" href="logout.php" role="button" id="logout">Logout</a> | <a class="btn btn-secondary" href="cetak.php" target="_blank" role="button" id="cetak">Cetak</a>
        <br><br>

        <div class="mb-3 d-flex justify-content-between">
            <a href="tambah.php" class="btn btn-primary" id="tambah">Tambah Data Mahasiswa</a>
            <form action="" method="get" class="d-flex">
                <input
                    type="text" name="keyword" size="40"
                    class="form-control me-2"
                    placeholder="Masukkan keyword pencarian..."
                    value="<?= htmlspecialchars($keyword) ?>"
                    autofocus autocomplete="off" id="keyword" />
                <button type="submit" class="btn btn-success" id="tombol-cari">Cari!</button>
                <img src="img/loader.gif" class="loader">
            </form>
        </div>
        <div id="container">
            <table class="table table-bordered table-striped">
                <thead class="table-dark">
                    <tr>
                        <th>No.</th>
                        <th>Aksi</th>
                        <th>Gambar</th>
                        <th>Nrp</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Jurusan</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1; ?>
                    <?php foreach ($mahasiswa as $row) : ?>
                        <tr>
                            <td><?= $i; ?></td>
                            <td>
                                <a href="edit.php?id=<?= $row["id"]; ?>" class="btn btn-warning btn-sm">Ubah</a>
                                <a href="hapus.php?id=<?= $row["id"]; ?>"
                                    class="btn btn-danger btn-sm"
                                    onclick="return confirm('Yakin hapus data?');">Hapus</a>
                            </td>
                            <td>
                                <img src="../samsung/<?= $row["gambar"]; ?>" width="50" class="img-thumbnail" alt="gambar">
                            </td>
                            <td><?= $row["nrp"] ?></td>
                            <td><?= $row["nama"] ?></td>
                            <td><?= $row["email"] ?></td>
                            <td><?= $row["jurusan"] ?></td>
                        </tr>
                        <?php $i++; ?>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <nav aria-label="Page navigation">
            <ul class="pagination justify-content-center">
                <?php if ($halamanAktif > 1): ?>
                    <li class="page-item">
                        <a class="page-link" href="?halaman=<?= $halamanAktif - 1 ?>&keyword=<?= urlencode($keyword) ?>">Previous</a>
                    </li>
                <?php endif; ?>

                <?php for ($i = 1; $i <= $jumlahHalaman; $i++): ?>
                    <li class="page-item <?= $i == $halamanAktif ? 'active' : '' ?>">
                        <a class="page-link" href="?halaman=<?= $i ?>&keyword=<?= urlencode($keyword) ?>"><?= $i ?></a>
                    </li>
                <?php endfor; ?>

                <?php if ($halamanAktif < $jumlahHalaman): ?>
                    <li class="page-item">
                        <a class="page-link" href="?halaman=<?= $halamanAktif + 1 ?>&keyword=<?= urlencode($keyword) ?>">Next</a>
                    </li>
                <?php endif; ?>
            </ul>
        </nav>

    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="js/jquery-3.7.1.min.js "></script>
    <script src="js/script.js">

    </script>
</body>

</html>