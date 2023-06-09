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
    mysqli_query($conn, $query) or die(mysqli_error($conn));
    return mysqli_affected_rows($conn);
}

function delete($id)
{
    $conn = connection();
    mysqli_query($conn, "DELETE FROM mahasiswa WHERE id = $id") or die(mysqli_error($conn));
    return mysqli_affected_rows($conn);
}

function ubah($data)
{
    $conn = connection();

    $id = $data['id'];
    $gambar = htmlspecialchars($data['gambar']);
    $noMatriks = htmlspecialchars($data['noMatriks']);
    $nama = htmlspecialchars($data['nama']);
    $email = htmlspecialchars($data['email']);
    $jurusan = htmlspecialchars($data['jurusan']);

    $query = "UPDATE mahasiswa SET
                gambar = '$gambar',
                noMatriks = '$noMatriks',
                nama = '$nama',
                email = '$email',
                jurusan = '$jurusan'
            WHERE id = $id";

    mysqli_query($conn, $query) or die(mysqli_error($conn));
    return mysqli_affected_rows($conn);
}

function cari($keyword)
{
    $conn = connection();

    $query = "SELECT * FROM mahasiswa
                WHERE 
                nama LIKE '%$keyword%' OR
                noMatriks LIKE '%$keyword%'
                ";

    $result = mysqli_query($conn, $query);

    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }

    return $rows;
}
