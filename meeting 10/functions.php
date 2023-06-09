<?php

function connection()
{
    return mysqli_connect('localhost', 'azrielamiezal', '991006@azriel', 'php2020');
}

function query($query)
{
    $conn = connection();

    $result = mysqli_query($conn, $query);

    //jika hasilnya 1 data
    if (mysqli_num_rows($result) == 1) {
        return mysqli_fetch_assoc($result);
    }

    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }

    return $rows;
}

function tambah($data)
{
    $conn = connection();

    $gambar = htmlspecialchars($data['gambar']);
    $noMatriks = htmlspecialchars($data['noMatriks']);
    $nama = htmlspecialchars($data['nama']);
    $email = htmlspecialchars($data['email']);
    $jurusan = htmlspecialchars($data['jurusan']);

    $query = "INSERT INTO
                mahasiswa
                VALUES
                (null, '$gambar', '$noMatriks', '$nama', '$email', '$jurusan')
                ";
    mysqli_query($conn, $query);
    echo mysqli_error($conn);
    return mysqli_affected_rows($conn);
}
