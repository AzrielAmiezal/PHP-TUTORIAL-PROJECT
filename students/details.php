<?php
session_start();

//check whether the user is login or not
if (!isset($_SESSION['login'])) {
    header("Location: login.php");
    exit;
}

require 'functions.php';

//take id from url
$id = $_GET['id'];

//query students based on id
$std = query("SELECT * FROM students WHERE id = $id");


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Students Information</title>
</head>

<body>
    <h3>Student Information</h3>
    <ul>
        <li><img src="img/<?= $std['pictures']; ?>" width="60"></li>
        <li><?= $std['stdNo']; ?></li>
        <li><?= $std['stdName']; ?></li>
        <li><?= $std['email']; ?></li>
        <li><?= $std['course']; ?></li>
        <li><a href="edit.php?id=<?= $std['id']; ?>">edit</a> | <a href="delete.php?id=<?= $std['id']; ?>" onclick="return confirm('Confirm to delete this?');">delete</a></li>
        <li><a href="index.php">back</a></li>
    </ul>
</body>

</html>