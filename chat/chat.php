<?php
session_start();
$connDB = new mysqli("localhost","root","","test_chat");

if($connDB->connect_error){
  die("connection failed: " . $connDB->connect_error);

}

$result = array();
$message = isset($_POST['message']) ? $_POST['message'] : null;
$from = isset($_POST['from']) ? $_POST['from'] : null;

if(!empty($message) && !empty($from)){

  $sql = "INSERT INTO `chat01` (`message`, `from`) VALUES (?, ?)";
  $stmt = mysqli_stmt_init($connDB);
  if(!mysqli_stmt_prepare($stmt, $sql)){
    exit();
  }else{

  mysqli_stmt_bind_param($stmt, 'ss', $message, $from);
  $result['send_status'] = mysqli_stmt_execute($stmt);
  }

  
};

$start = isset($_GET['start']) ? intval($_GET['start']) : 0;
$active = $_SESSION['activeChat'];

$items = $connDB->query("SELECT * FROM `chat01` WHERE `from` = '".$active."' " );


while($row = $items->fetch_assoc()){
  $result['items'][] = $row;
}

$connDB->close();

header('Access-Control-Allow-Origin: *');
header('Content-type: application/json');

echo json_encode($result);