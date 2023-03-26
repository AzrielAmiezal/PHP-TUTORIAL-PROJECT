<?php
require 'functions.php';

if (isset($_POST['register'])) {

    if (adminRegister($_POST) > 0) {

        echo "<script>
                alert('You are successfully registered. Please login!');
                document.location.href = 'login.php';
            </script>";
    } else {
        echo "<script>
                alert('User failed to registered. Please try again later!');
                document.location.href = 'login.php';
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
    <title>Register User</title>
</head>

<body>
    <h3>Registration Form</h3>
    <form action="" method="POST">

        <ul>
            <li>
                <label for="username">Username :</label>
                <input type="text" name="username" id="username" autofocus autocomplete="off" required>
            </li>
            <li>
                <label for="password1">Password :</label>
                <input type="password" name="password1" id="password1" required>
            </li>
            <li>
                <label for="password2">Confirm Password :</label>
                <input type="password" name="password2" id="password2" required>
            </li>
            <li>
                <button type="submit" name="register">Register</button>
            </li>
        </ul>


    </form>
</body>

</html>