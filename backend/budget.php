<?php
session_start();
include "connection.php";

if($_SESSION['REQUEST_METHOD']=="POST"){
    
    $incomequery="SELECT sum(amount) as total_income FROM transactions WHERE user_id=? AND type = 'income'";

    $incomeStmt = $connection->prepare($incomeQuery);

    $incomeStmt->bind_param("i", $user_id);
 
    $incomeStmt->execute();
 
    $incomeResult = $incomeStmt->get_result();
 
    $incomeRow = $incomeResult->fetch_assoc();
 
    $total_income = $incomeRow['total_income'] ?? 0;
}