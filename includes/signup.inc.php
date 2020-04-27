<?php

if (isset($_POST['signupSubmit'])) {

  require 'dbh.inc.php';

  $uid = $_POST['uid'];
  $mail = $_POST['mail'];
  $pwd = $_POST['pwd'];
  $pwd2 = $_POST['pwd2'];

  //VALIDATE FEILDS
  if (empty($uid) || empty($mail) || empty($pwd) || empty($pwd2)) {
    header("location: ../signup.php?signup=emptyfields&uid=$uid&mail=$mail");
    exit();
  } elseif (!filter_var($mail, FILTER_VALIDATE_EMAIL) && !preg_match("/^[a-zA-Z0-9]*$/", $uid)) {
    header("location: ../signup.php?signup=emailuser");
    exit();
  } elseif (!filter_var($mail, FILTER_VALIDATE_EMAIL)) {
    header("location: ../signup.php?signup=email&uid=$uid");
    exit();
  } elseif (!preg_match("/^[a-zA-Z0-9]*$/", $uid)) {
    header("location: ../signup.php?signup=username&mail=$mail");
    exit();
  } elseif ($pwd !== $pwd2) {
    header("location: ../signup.php?signup=pwdmatch&uid=$uid&mail=$mail");
    exit();
  }

  //FEILDS VALIDATED, CHECK AVAILABILITY OF USERNAME
  else {
    $sql = "SELECT uid_users FROM users WHERE uid_users = ?";
    $stmt = mysqli_stmt_init($connDB);

    if (!mysqli_stmt_prepare($stmt, $sql)) {
      header("location: ../signup.php?signup=sqlerror");
      exit();

    } else {
      mysqli_stmt_bind_param($stmt, 's', $uid);
      mysqli_stmt_execute($stmt);
      mysqli_stmt_store_result($stmt);

      $resultCheck = mysqli_stmt_num_rows($stmt);

      //USERNAME UNAVAILABLE, SEND ERROR
      if ($resultCheck != 0) {
        header("location: ../signup.php?signup=nametaken&mail=$mail");
        exit();
      }

      //USERNAME AVAILABLE, SIGN USER UP
      else {
        
        $sql = "INSERT INTO users (uid_users, email_users, pwd_users) VALUES (?, ?, ?)";
        $stmt = mysqli_stmt_init($connDB);
        
        if (!mysqli_stmt_prepare($stmt, $sql)) {
          header("location: ../signup.php?signup=sqlerror");
          exit();
        } 
        else {
          $hashedPwd = password_hash($pwd, PASSWORD_DEFAULT); //HASH PASSWORD
          mysqli_stmt_bind_param($stmt, 'sss', $uid, $mail, $hashedPwd);
          mysqli_stmt_execute($stmt);
          header("location: ../signup.php?signup=success");
          

           //CREATE USER BOOKS TABLE IN DATABASE
           $sql = "CREATE TABLE readingList.books_".$uid."(
            id int(11) NOT null PRIMARY KEY AUTO_INCREMENT,
            title varchar(128) NOT null,
            author varchar(128) NOT null
           )
           ";
           
           $sqlB="INSERT INTO readingList.books_".$uid." (title, author) VALUES ('The End of Eternity', 'Isaac Asimov')";

           $stmt = mysqli_stmt_init($connDB);

           if (!mysqli_stmt_prepare($stmt, $sql)) {
             header("location: ../signup.php?signup=sqlerrorCREATE");
             exit();
             
           } else {
             mysqli_stmt_execute($stmt);
             $result = $connDB->query($sqlB);
             header("location: ../signup.php?signup=success");
          exit();
        }
        }
      }
    }
  }
  mysqli_stmt_close($stmt);
  mysqli_close($connDB);
}
else{
  header("location: ../signup.php");
  exit();
}
