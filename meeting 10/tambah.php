<?php

require 'functions.php';

//check whether the submit button has been press
if (isset($_POST['tambah'])) {
    if (tambah($_POST) > 0) {
        echo "<script>
            alert('data berhasil ditambahkan');
            document.location.href = 'latihan3.php';
            </script>";
    } else {
        echo "data gagal ditambahkan!";
    }
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Data Mahasiswa</title>
</head>

<body>
    <h3>Form Tambah Data Mahasiswa</h3>

    <form action="" method="POST">
        <ul>
            <li>
                <label>
                    Nama:
                    <input type="text" name="nama" autofocus required>
                </label>
            </li>
            <li>
                <label>
                    No Matriks:
                    <input type="text" name="noMatriks" required>
                </label>
            </li>

            <li>
                <label>
                    Email:
                    <input type="text" name="email" required>
                </label>
            </li>
            <li>
                <label>
                    Jurusan:
                    <input type="text" name="jurusan" required>
                </label>
            </li>
            <li>
                <label>
                    Gambar:
                    <input type="text" name="gambar" required>
                </label>
            </li>
            <li>
                <button type="submit" name="tambah">Tambah Data!</button>
            </li>
        </ul>
    </form>
</body>

</html>