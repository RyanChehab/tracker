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


    $expenseQuery = "SELECT SUM(amount) as total_expenses FROM transactions WHERE user_id = ? AND type = 'expense'";
    
    $expenseStmt = $connection->prepare($expenseQuery);
    
    $expenseStmt->bind_param("i", $user_id);
    
    $expenseStmt->execute();
    
    $expenseResult = $expenseStmt->get_result();
    
    $expenseRow = $expenseResult->fetch_assoc();
    
    $total_expenses = $expenseRow['total_expenses'] ?? 0;


    $current_budget = $total_income - $total_expenses;

    echo json_encode(["current_budget"=> $current_budget]);
}