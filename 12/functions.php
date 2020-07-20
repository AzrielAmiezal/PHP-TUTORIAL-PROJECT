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

function login($data)
{
    $conn = connection();

    $username = htmlspecialchars($data['username']);
    $password = htmlspecialchars($data['password']);

    //check username first
    if ($user = query("SELECT * FROM user WHERE username = '$username'")) {
        //check password
        if (password_verify($password, $user['password'])) {
            //set session
            $_SESSION['login'] = true;
            header("Location: index.php");
            exit;
        }
    }
    return [
        'error' => true,
        'message' => 'Username / Password Salah!'
    ];
}

function registration($data)
{
    $conn = connection();

    $username = htmlspecialchars(strtolower($data['username']));
    $password1 = mysqli_real_escape_string($conn, $data['password1']);
    $password2 = mysqli_real_escape_string($conn, $data['password2']);

    //if username or password empty
    if (empty($username) || empty($password1) || empty($password2)) {
        echo "<script>
                alert('username / password tidak boleh kosong!');
                document.location.href = 'registration.php';
            </script>";
        return false;
    }

    //if username already register
    if (query("SELECT * FROM user WHERE username = '$username'")) {
        echo "<script>
            alert('username already registered. Please Login!');
            document.location.href = 'registration.php';
        </script>";
        return false;
    }

    //if password and password confirmation are not same
    if ($password1 !== $password2) {
        echo "<script>
            alert('Password are not match!');
            document.location.href = 'registration.php';
        </script>";
        return false;
    }

    //if password < 5 digit
    if (strlen($password1) < 5) {
        echo "<script>
            alert('Password too short!');
            document.location.href = 'registration.php';
        </script>";
        return false;
    }

    //if username and password suit
    $new_password = password_hash($password1, PASSWORD_DEFAULT);
    //insert to table user
    $query = "INSERT INTO user
                VALUES
                (null,'$username', '$new_password')
                ";
    mysqli_query($conn, $query) or die(mysqli_error($conn));
    return mysqli_affected_rows($conn);
}
