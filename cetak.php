<?php

require_once __DIR__ . '/../pertemuan20/vendor/autoload.php';

require 'functions.php';
$mahasiswa = query("SELECT * FROM mahasiswa");

$html = '<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Mahasiswa</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }

        table, th, td {
            border: 1px solid black;
            padding: 8px;
            text-align: center;
        }

        img {
            width: 50px;
            height: 50px;
        }
    </style>
</head>
<body>
    <h1>Daftar Mahasiswa</h1>

     <table border="1" cellpadding="10" cellspacing="0">
                    <tr>
                        <th>No.</th>
                        <th>Gambar</th>
                        <th>Nrp</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Jurusan</th>
                    </tr>';
    $i = 1; 
    foreach ($mahasiswa as $row) {
        $html .= '<tr>
                        <td>' . $i++ . '</td>
                        <td><img src="../samsung/' . $row["gambar"] . '" width="30"></td>
                        <td>' . $row["nrp"] . '</td>
                        <td>' . $row["nama"] . '</td>
                        <td>' . $row["email"] . '</td>
                        <td>' . $row["jurusan"] . '</td>
                    </tr>';
    }
$html .='</table>
</body>
</html>';

$mpdf = new \Mpdf\Mpdf();
$mpdf->WriteHTML($html);
$mpdf->Output('Daftar Mahasiswa.pdf', 'I');
