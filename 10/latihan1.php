<?php
// database connection and choose database
$conn = mysqli_connect('localhost', 'azrielamiezal', '991006@azriel', 'php2020');

//query table mahasiswa
$result = mysqli_query($conn, "SELECT * FROM mahasiswa");

//change data into array
//$row = mysqli_fetch_row($result); //array numeric
// $row = mysqli_fetch_assoc($result); //array associative
// $row = mysqli_fetch_array($result); //both above

$rows = [];
while ($row = mysqli_fetch_assoc($result)) {
    $rows[] = $row;
}

//save to variable mahasiswa
$mahasiswa = $rows;



?>






<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Mahasiswa</title>
</head>

<body>
    <h3>Daftar Mahasiswa</h3>

    <table border="1" cellpadding="10" cellspacing="0">
        <tr>
            <th>#</th>
            <th>Gambar</th>
            <th>No Matriks</th>
            <th>Nama</th>
            <th>Email</th>
            <th>Jurusan</th>
            <th>Tindakan</th>
        </tr>

        <?php $i = 1;
        foreach ($mahasiswa as $m) : ?>
            <tr>
                <td><?= $i++; ?></td>
                <td><img src="img/<?= $m['gambar']; ?>" width="60"></td>
                <td><?= $m['noMatriks']; ?></td>
                <td><?= $m['nama']; ?></td>
                <td><?= $m['email']; ?></td>
                <td><?= $m['jurusan']; ?></td>
                <td>
                    <a href="">Ubah</a> | <a href="">Padam</a>
                </td>
            </tr>
        <?php endforeach; ?>

    </table>
</body>

</html>