<?php
session_start();

//check whether the user is login or not
if (!isset($_SESSION['login'])) {
    header("Location: login.php");
    exit;
}

require 'functions.php';

//check whether the submit button is press or not
if (isset($_POST['addStudent'])) {

    if (addStudents($_POST) > 0) {

        echo "<script>
                alert('Data has been added!');
                document.location.href = 'index.php';
                </script>";
    } else {
        echo "<script>
                alert('Data failed to add!');
                </script>";
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Students</title>
</head>

<body>
    <h3>Add new Student</h3>

    <form action="" method="POST" enctype="multipart/form-data">

        <ul>
            <li>
                <label for="stdNo">Student Registration No :</label>
                <input type="text" name="stdNo" id="stdNo" autofocus required>
            </li>
            <li>
                <label for="stdName">Student Name :</label>
                <input type="text" name="stdName" id="stdName" required>
            </li>
            <li>
                <label for="email">Email :</label>
                <input type="text" name="email" id="email" required>
            </li>
            <li>
                <label for="course">Course :</label>
                <input type="text" name="course" id="course" required>
            </li>
            <li>
                <label for="pictures">Pictures :</label>
                <input type="file" name="pictures" id="pictures" required>
            </li>
            <li>
                <button type="submit" name="addStudent">Add</button>
            </li>
        </ul>

    </form>
</body>

</html>