<?php
include 'connection.php';

if ($_SERVER['REQUEST_METHOD'] == "POST"){
    $email = $_POST['email'];
    $password = $_POST['password'];

    $hashed_pass = password_hash($password, PASSWORD_DEFAULT);

}