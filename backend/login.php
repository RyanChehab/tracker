<?php 
session_start();

include 'connection.php';

if($_SERVER['REQUEST_METHOD']== "POST"){
    $email =$_POST['email'];
    $password = $_POST['password'];

    $sql = "SELECT id, password FROM users WHERE email = ?";
    $stmt = $connection->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    if($stmt->num_rows == 1){
        $stmt->bind_result($user_id,$hashed_pass);
        $stmt->fetch();

        // verifying if the password is correct
        if(password_verify($password, $hashed_pass)){
            $_SESSION['user_id'] = $user_id;
            $_SESSION['username'] = $username;
            $_SESSION['logged_in'] = true;

            header('Location: ../content.html');
            exit;
        }else{
            echo"incorrect password";
        }  
    }else{
        echo"no user found";
    }

    
}