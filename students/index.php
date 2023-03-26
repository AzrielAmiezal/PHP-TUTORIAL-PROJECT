<?php
session_start();

//check whether the user is login or not
if (!isset($_SESSION['login'])) {
    header("Location: login.php");
    exit;
}

require 'functions.php';
$students = query("SELECT * FROM students");

//when search button is clicked
if (isset($_POST['search'])) {

    $students = search($_POST['keyword']);
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Students Registration</title>
</head>

<body>
    <a href="logout.php">Logout</a>
    <h3>Student Registration</h3>

    <a href="addStudent.php">Add new student</a>
    <br><br>

    <!-- <form action="" method="POST">

        <input type="text" name="keyword" size="40" placeholder="Enter search" autocomplete="off" autofocus>
        <button type="submit" name="search">Search</button>

    </form> -->

    <form action="" method="POST">

        <input type="text" name="keyword" size="40" placeholder="Enter search" autocomplete="off" autofocus class="keyword">
        <button type="submit" name="search" class="search-button">Search</button>

    </form>
    <br>

    <div class="container">
        <table border="1" cellpadding="10" cellspacing="0">
            <tr>
                <th>No.</th>
                <th>Picture</th>
                <th>Student No</th>
                <th>Student Name</th>
                <th>Action</th>
            </tr>

            <?php if (empty($students)) : ?>
                <tr>
                    <td colspan="5">
                        <p style="color: red; font-style:italic; text-align:center;">Student information not available</p>
                    </td>
                </tr>
            <?php endif; ?>
            <?php $i = 1;

            foreach ($students as $std) : ?>
                <tr>
                    <td><?= $i++; ?></td>
                    <td><img src="img/<?= $std['pictures']; ?>" width="60"></td>
                    <td><?= $std['stdNo']; ?></td>
                    <td><?= $std['stdName']; ?></td>
                    <td>
                        <a href="details.php?id=<?= $std['id']; ?>">view details</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
    </div>

    <script src="js/script.js"></script>
</body>

</html>