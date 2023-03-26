<?php
session_start();

//check when the user is already login
if (isset($_SESSION['login'])) {
    header("Location: index.php");
    exit;
}

require 'functions.php';

//when login button is clicked
if (isset($_POST['login'])) {

    $login = adminLogin($_POST);
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
</head>

<body>
    <h3>Admin Login</h3>
    <?php if (isset($login['error'])) : ?>
        <p style="color:red; font-style:italic;"><?= $login['message']; ?></p>
    <?php endif; ?>
    <form action="" method="POST">
        <ul>
            <li>
                <label for="username">Username : </label>
                <input type="text" name="username" id="username" autocomplete="off" autofocus required>
            </li>
            <li>
                <label for="password">Password :</label>
                <input type="password" name="password" id="password" required>
            </li>
            <li>
                <button type="submit" name="login">Login</button>
            </li>
            <br>

            <a href="registration.php">Register</a>

        </ul>

    </form>
</body>

</html>