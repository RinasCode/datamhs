<?php
sleep(2);
require '../functions.php';

$keyword = $_GET["keyword"];
$query = "SELECT * FROM mahasiswa
    WHERE
    nama LIKE '%$keyword%' OR
    nrp LIKE '%$keyword%' OR
    email LIKE '%$keyword%' OR
    jurusan LIKE '%$keyword%'
    ";
$mahasiswa = query($query);


// var_dump($mahasiswa);
?>

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