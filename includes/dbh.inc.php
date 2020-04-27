<?php

  $dbservername = "localhost";
  $dbusername = 'root';
  $dbpassword = '';
  $dbname = 'login_system';

  $connDB = mysqli_connect($dbservername, $dbusername, $dbpassword, $dbname);

  if(!$connDB){
    die("failed to connect to database:". mysqli_connect_error());
  }


  if(isset($_SESSION['userUid'])){
    $DBuid = $_SESSION['userUid'];
  } 