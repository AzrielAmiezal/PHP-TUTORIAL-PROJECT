<?php

require 'functions.php';

if (isset($_POST['register'])) {
    if (registration($_POST) > 0) {
        echo "<script>
            alert('You are successfully register. Please Login!');
            document.location.href = 'login.php';
        </script>";
    } else {
        echo 'User fail to add!';
    }
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration</title>
</head>

<body>
    <h3>Registration Form</h3>
    <form action="" method="POST">
        <ul>
            <li>
                <label>
                    Username :
                    <input type="text" name="username" autofocus autocomplete="off" required>
                </label>
            </li>
            <li>
                <label>
                    Password :
                    <input type="password" name="password1" required>
                </label>
            </li>
            <li>
                <label>
                    Confirm Password :
                    <input type="password" name="password2" required>
                </label>
            </li>
            <li>
                <button type="submit" name="register">Register</button>
            </li>
        </ul>
    </form>
</body>

</html>