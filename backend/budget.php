<?php
session_start();
include "connection.php";

if($_SERVER['REQUEST_METHOD']=="POST"){
    $user_id = $_SESSION['user_id'];
    
    $incomequery="SELECT sum(amount) as total_income FROM transactions WHERE user_id=? AND type = 'income'";

    $incomeStmt = $connection->prepare($incomequery);

    $incomeStmt->bind_param("i", $user_id);
 
    $incomeStmt->execute();
 
    $incomeResult = $incomeStmt->get_result();
 
    $incomeRow = $incomeResult->fetch_assoc();
 
    $total_income = $incomeRow['total_income'] ?? 0;


    $expenseQuery = "SELECT SUM(amount) as total_expenses FROM transactions WHERE user_id = ? AND type = 'expense'";
    
    $expenseStmt = $connection->prepare($expenseQuery);
    
    $expenseStmt->bind_param("i", $user_id);
    
    $expenseStmt->execute();
    
    $expenseResult = $expenseStmt->get_result();
    
    $expenseRow = $expenseResult->fetch_assoc();
    
    $total_expenses = $expenseRow['total_expenses'] ?? 0;


    $current_budget = $total_income - $total_expenses;

    echo json_encode(["current_budget" => $current_budget]);
}else{
    $response = ["message" => "Empty result"];
    echo json_encode($response);
}