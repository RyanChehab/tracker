<?php
include 'connection.php';

if ($_SERVER["REQUEST_METHOD"]=="POST"){
    $sql="SELECT * FROM transactions";
    
    $query = $connection->prepare($sql);
    
    $query->excute();

    $result = $query->get_result();
}