<?php

$host = 'localhost';
$username = 'root';
$pass = '';
$db = 'tracker';

$connection = new mysqli($host,$username,$pass,$db);

// if ($connection->connect_error){
//     die("error conncting to db");
// }
// else{
//     echo("connected succesfully");
// }