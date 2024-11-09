<?php
session_start();
include 'connection.php';
$user_id=$_SESSION['user_id'];

if ($_SERVER["REQUEST_METHOD"]=="POST"){
    $sql="SELECT * FROM transactions where user_id = ?";
    
    $stmt = $connection->prepare($sql);

    $stmt->bind_param('i',$user_id);

    $stmt->execute();

    $result = $stmt->get_result();
    
} else{
    $response = ["message" => "Empty result"];
    echo json_encode($response);
}