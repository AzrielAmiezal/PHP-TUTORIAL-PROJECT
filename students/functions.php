<?php

function connection()
{

    return mysqli_connect('localhost', 'root', '', 'basicphp');
}

function query($query)
{

    $conn = connection();
    $result = mysqli_query($conn, $query);

    //if only have 1 data
    if (mysqli_num_rows($result) == 1) {
        return mysqli_fetch_assoc($result);
    }

    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }

    return $rows;
}

function upload()
{
    $file_name = $_FILES['pictures']['name'];
    $file_type = $_FILES['pictures']['type'];
    $file_size = $_FILES['pictures']['size'];
    $file_error = $_FILES['pictures']['error'];
    $file_tmp = $_FILES['pictures']['tmp_name'];

    //when no picture is choose
    if ($file_error == 4) {
        echo "<script>
            alert('Please upload student picture!');
        </script>";

        return false;
    }

    //check file extension
    $file_register = ['jpg', 'jpeg', 'png'];
    $file_extension = explode('.', $file_name);
    $file_extension = strtolower(end($file_extension));

    //check valid file extension
    if (!in_array($file_extension, $file_register)) {
        echo "<script>
            alert('Please upload a valid format such as JPG, JPEG & PNG only!');
        </script>";

        return false;
    }

    //check file type
    if ($file_type != 'image/jpeg' && $file_type != 'image/png') {

        echo "<script>
            alert('Please upload a valid format such as JPG, JPEG & PNG only!');
        </script>";

        return false;
    }

    //check file size
    //maximum 5MB == 5000000
    if ($file_size > 5000000) {

        echo "<script>
            alert('File too large. Please upload minimum file size 5MB only! ');
        </script>";

        return false;
    }

    //pass file checking. ready to upload file
    //generate new file name
    $new_file_name = uniqid();
    $new_file_name .= '.';
    $new_file_name .= $file_extension;

    move_uploaded_file($file_tmp, 'img/' . $new_file_name);
    return $new_file_name;
}

function addStudents($data)
{
    $conn = connection();

    $stdNo = htmlspecialchars($data['stdNo']);
    $stdName = htmlspecialchars($data['stdName']);
    $email = htmlspecialchars($data['email']);
    $course = htmlspecialchars($data['course']);
    //$pictures = htmlspecialchars($data['pictures']);

    //upload pictures
    $pictures = upload();
    if (!$pictures) {
        return false;
    }

    $query = "INSERT INTO students
                VALUES
                (null,'$stdNo','$stdName','$email','$course','$pictures');
                ";
    mysqli_query($conn, $query) or die(mysqli_error($conn));
    return mysqli_affected_rows($conn);
}

function deleteStudents($id)
{
    $conn = connection();
    mysqli_query($conn, "DELETE FROM students WHERE id = $id") or die(mysqli_error($conn));
    return mysqli_affected_rows($conn);
}

function edit($data)
{
    $conn = connection();

    $id = $data['id'];
    $stdNo = htmlspecialchars($data['stdNo']);
    $stdName = htmlspecialchars($data['stdName']);
    $email = htmlspecialchars($data['email']);
    $course = htmlspecialchars($data['course']);
    $pictures = htmlspecialchars($data['pictures']);

    $query = "UPDATE students SET
                stdNo = '$stdNo',
                stdName = '$stdName',
                email = '$email',
                course = '$course',
                pictures = '$pictures'
            WHERE id = $id";

    mysqli_query($conn, $query) or die(mysqli_error($conn));
    return mysqli_affected_rows($conn);
}

function search($keyword)
{
    $conn = connection();

    $query = "SELECT * FROM students
                WHERE 
            stdNo LIKE '%$keyword%' OR
            stdName LIKE '%$keyword%'";

    $result = mysqli_query($conn, $query);

    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }

    return $rows;
}

function adminLogin($data)
{
    $conn = connection();

    $username = htmlspecialchars($data['username']);
    $password = htmlspecialchars($data['password']);

    //check username
    if ($user = query("SELECT * FROM user WHERE username = '$username'")) {
        //check password
        if (password_verify($password, $user['password'])) {
            //set session
            $_SESSION['login'] = true;

            header("Location: index.php");
        }
    }
    return [
        'error' => true,
        'message' => 'Wrong Username / Password!'
    ];
}

function adminRegister($data)
{
    $conn = connection();

    $username = htmlspecialchars(strtolower($data['username']));
    $password1 = mysqli_real_escape_string($conn, $data['password1']);
    $password2 = mysqli_real_escape_string($conn, $data['password2']);

    //if username or password is empty
    if (empty($username) || empty($password1) || empty($password2)) {

        echo "<script>
                alert('Username/password cannot empty!');
                document.location.href = 'registration.php';
            </script>";

        return false;
    }

    //if username if already register
    if (query("SELECT * FROM user WHERE username = '$username'")) {

        echo "<script>
                alert('Username already registered!');
                document.location.href = 'registration.php';
            </script>";

        return false;
    }

    //check password confirmation
    if ($password1 !== $password2) {

        echo "<script>
                alert('Password not matched!');
                document.location.href = 'registration.php';
            </script>";

        return false;
    }

    //if password < 5 digit
    if (strlen($password1 < 5)) {

        echo "<script>
                alert('Password too short!');
                document.location.href = 'registration.php';
            </script>";

        return false;
    }

    //if username and password is suitable
    //encrypt password
    $new_password = password_hash($password1, PASSWORD_DEFAULT);
    //insert to table user
    $query = "INSERT INTO user
                VALUES
                (null,'$username','$new_password')";

    mysqli_query($conn, $query) or die(mysqli_error($conn));
    return mysqli_affected_rows($conn);
}
