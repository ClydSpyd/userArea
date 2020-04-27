<?php

if(isset($_POST['loginSubmit'])){
  require 'dbh.inc.php';

  $mailuid = $_POST['mailUID'];
  $pwd = $_POST['pwd'];

  if( empty($mailuid) || empty($pwd)){
    header("location: ../index.php?login=emptyfields");
    exit();
  }
  else {
    $sql = "SELECT * FROM users WHERE uid_users = ? OR email_users = ?";
    $stmt = mysqli_stmt_init($connDB);
    
    if (!mysqli_stmt_prepare($stmt, $sql)) {
      header("location: ../index.php?login=sqlerror");
      exit();
    } 
    else {
      mysqli_stmt_bind_param($stmt, 'ss', $mailuid, $mailuid);
      mysqli_stmt_execute($stmt);
      
      $result = mysqli_stmt_get_result($stmt);
      
      if($row = mysqli_fetch_assoc($result)){
        $pwdCheck = password_verify($pwd, $row['pwd_users']);
        if($pwdCheck == false){
          header("location: ../index.php?login=pwdincorrect");
          exit();
        }
        elseif($pwdCheck == true){
          session_start();
          $_SESSION['userId'] = $row['id_users'];
          $_SESSION['userUid'] = $row['uid_users'];
          header("location: ../index.php?login=success");

        }
        else {
          header("location: ../index.php?login=pwdincorrect");
        }

      }
      else{
        header("location: ../index.php?login=nouser");
      }
    }
  }

}
else {
  header("location: ../index.php");
  exit();
}

?>