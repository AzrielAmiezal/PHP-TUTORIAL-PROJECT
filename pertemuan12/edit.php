<?php
session_start();

if (!isset($_SESSION['login'])) {
    header("Location: login.php");
    exit;
}

require 'functions.php';

//if no id at url
if (!isset($_GET['id'])) {
    header("Location: index.php");
    exit;
}

//get id from url
$id = $_GET['id'];

//query mahasiswa based on id
$m = query("SELECT * FROM mahasiswa WHERE id=$id");

//check whether the submit button has been press
if (isset($_POST['ubah'])) {
    if (ubah($_POST) > 0) {
        echo "<script>
            alert('data berhasil diubah');
            document.location.href = 'index.php';
            </script>";
    } else {
        echo "data gagal diubah!";
    }
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ubah Data Mahasiswa</title>
</head>

<body>
    <h3>Form Ubah Data Mahasiswa</h3>

    <form action="" method="POST">
        <input type="hidden" name="id" value="<?= $m['id']; ?>">
        <ul>
            <li>
                <label>
                    Nama:
                    <input type="text" name="nama" autofocus required value="<?= $m['nama']; ?>">
                </label>
            </li>
            <li>
                <label>
                    No Matriks:
                    <input type="text" name="noMatriks" required value="<?= $m['noMatriks']; ?>">
                </label>
            </li>

            <li>
                <label>
                    Email:
                    <input type="text" name="email" required value="<?= $m['email']; ?>">
                </label>
            </li>
            <li>
                <label>
                    Jurusan:
                    <input type="text" name="jurusan" required value="<?= $m['jurusan']; ?>">
                </label>
            </li>
            <li>
                <label>
                    Gambar:
                    <input type="text" name="gambar" required value="<?= $m['gambar']; ?>">
                </label>
            </li>
            <li>
                <button type="submit" name="ubah" onclick="return confirm('Are you confirm to edit?');">Edit</button>
            </li>
        </ul>
    </form>
</body>

</html>