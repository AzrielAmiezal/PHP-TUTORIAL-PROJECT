<?php
session_start();

if (!isset($_SESSION['login'])) {
    header("Location: login.php");
    exit;
}

require 'functions.php';

//get id from url
$id = $_GET['id'];

//query mahasiswa based on id
$m = query("SELECT * FROM mahasiswa WHERE id = $id");

?>




<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Mahasiswa</title>
</head>

<body>
    <h3>Detail Mahasiswa</h3>
    <ul>
        <li><img src="img/<?= $m['gambar']; ?>"></li>
        <li>No Matriks: <?= $m['noMatriks']; ?></li>
        <li>Nama: <?= $m['nama']; ?></li>
        <li>Email: <?= $m['email']; ?></li>
        <li>Jurusan: <?= $m['jurusan']; ?></li>
        <li><a href="edit.php?id=<?= $m['id']; ?>">Ubah</a> | <a href="delete.php?id=<?= $m['id']; ?>" onclick="return confirm('Are you confirm to delete?');">Padam</a></li>
        <li><a href="index.php">Kembali ke daftar mahasiswa</a></li>
    </ul>
</body>

</html>