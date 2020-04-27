<!-- login=pwdincorrect -->
<?php 
$error='';
  if(!isset($_GET['login'])){
  } else {
    $loginError = $_GET['login'];
    
    if($loginError == 'pwdincorrect'){
      $error =  "password incorrect";
    } 
    elseif ($loginError == 'nouser'){
      $error= "username not recognised";
    }
    elseif ($loginError == 'emptyfields'){
      $error= "please enter details";
    };
  }
