<?php

require 'functions.php';

//if no id at url
if (!isset($_GET['id'])) {
    header("Location: index.php");
    exit;
}

//get id from url
$id = $_GET['id'];

if (delete($id) > 0) {
    echo "<script>
            alert('data berhasil dipadam!');
            document.location.href = 'index.php';
            </script>";
} else {
    echo "data gagal ditambahkan!";
}
