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

if (deleteStudents($id) > 0) {
    echo "<script>
            alert('Data has been deleted!');
            document.location.href = 'index.php';
            </script>";
} else {
    echo "<script>
            alert('Data failed to delete!');
        </script>";
}
