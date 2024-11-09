<?php
session_start();
include 'connection.php';

if($_SERVER["REQUEST_METHOD"]== "POST") {

    $user_id = $_SESSION['user_id'];

    $data = json_decode(file_get_contents("php://input"));
    if($data){ 
        $type = $data->type;
        $amount = $data->amount;
        $date = $data->date;
        $notes = $data->description;
    }
   
$sql = "INSERT INTO transactions (user_id,type, amount, date, notes) VALUES (? ,?, ?, ?, ?)";
$stmt = $connection->prepare($sql);
$stmt->bind_param("isdss",$user_id,$type,$amount,$date,$notes);

if ($stmt->execute()) {
    echo json_encode(["message" => "Transaction added successfully!"]);
} 
else {
    echo json_encode("Error:") ;
}
}