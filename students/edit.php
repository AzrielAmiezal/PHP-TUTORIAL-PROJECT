<?php
session_start();

//check whether the user is login or not
if (!isset($_SESSION['login'])) {
    header("Location: login.php");
    exit;
}
require 'functions.php';

//if no id in url
if (!isset($_GET['id'])) {
    header("Location: index.php");
    exit;
}

//get id from url
$id = $_GET['id'];

//query students based on id
$std = query("SELECT * FROM students WHERE id = $id");

//check whether the edit button is press or not
if (isset($_POST['edit'])) {

    if (edit($_POST) > 0) {

        echo "<script>
                alert('Data has been edited!');
                document.location.href = 'index.php';
                </script>";
    } else {
        echo "<script>
                alert('Data failed to edit!');
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
    <title>Edit Students Information</title>
</head>

<body>
    <h3>Edit Student Information</h3>

    <form action="" method="POST">

        <input type="hidden" name="id" value="<?= $std['id']; ?>">

        <ul>
            <li>
                <label for="stdNo">Student Registration No :</label>
                <input type="text" name="stdNo" id="stdNo" value="<?= $std['stdNo']; ?>" autofocus required>
            </li>
            <li>
                <label for="stdName">Student Name :</label>
                <input type="text" name="stdName" id="stdName" value="<?= $std['stdName']; ?>" required>
            </li>
            <li>
                <label for="email">Email :</label>
                <input type="text" name="email" id="email" value="<?= $std['email']; ?>" required>
            </li>
            <li>
                <label for="course">Course :</label>
                <input type="text" name="course" id="course" value="<?= $std['course']; ?>" required>
            </li>
            <li>
                <label for="pictures">Pictures :</label>
                <input type="text" name="pictures" id="pictures" value="<?= $std['pictures']; ?>" required>
            </li>
            <li>
                <button type="submit" name="edit">Edit</button>
            </li>
        </ul>

    </form>
</body>

</html>