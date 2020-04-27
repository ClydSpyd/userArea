<?php

$connDB = new mysqli("localhost","root","","login_system");

if($connDB->connect_error){
  die("connection failed: " . $connDB->connect_error);

}

$result = array();


$users = $connDB->query("SELECT * FROM users");

while($row = $users->fetch_assoc()){
  $result['users'][] = $row;
}

$connDB->close();

header('Access-Control-Allow-Origin: *');
header('Content-type: application/json');

echo json_encode($result);