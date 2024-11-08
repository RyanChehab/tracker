<?php
include 'connection.php';

if($_SERVER["REQUEST_METHOD"]== "POST") {
    $user_id = $_POST['user_id'];
    $type = $_POST['type'];
    $amount = $_POST['amount'];
    $date = $_POST['date'];
    $notes = $_POST['notes'];

$sql = "INSERT INTO transactions (user_id, type, amount, date, notes) VALUES (?, ?, ?, ?, ?)";
$stmt = $connection->prepar($sql);
$stmt->bind_param("isdss",$user_id,$type,$amount,$date,$notes);

if ($stmt->execute()) {
    echo "Transaction added successfully!";
} else {
    echo "Error: " . $stmt->error;
}
}