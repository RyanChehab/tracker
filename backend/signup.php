<?php
include 'connection.php';

if ($_SERVER['REQUEST_METHOD'] == "POST"){
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    $hashed_pass = password_hash($password, PASSWORD_DEFAULT);

    $sql = "INSERT INTO users(username,email,password) VALUES (?,?,?)";
    
    $stmt = $connection->prepare($sql);

    $stmt->bind_param("sss", $username,$email,$hashed_pass);

    if($stmt->execute()){
        header("Location:../index.html");
        
    }else {
        echo "error: " . $stmt->error;
    }
}