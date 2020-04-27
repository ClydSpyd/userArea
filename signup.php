<?php 
  require 'header.php'
?>
<main>
<div class="wrapperMain">
  
<section class="signupFormMain">
  <h3>signup</h3>
  <form action="includes/signup.inc.php" method="POST">

  <?php 
  // <!-- CHECK URL FOR SUBMITTED DATA, ECHO FILLED OUT INPUT FEILDS IF FOUND -->
  if(isset($_GET['uid'])){
    $uid=$_GET['uid'];
    echo '<input type="text" name="uid" placeholder="username" value="' . $uid . '">';
  } else {
    echo '<input type="text" name="uid" placeholder="username">';
  };

  if(isset($_GET['mail'])){
    $mail=$_GET['mail'];
    echo '<input type="text" name="mail" placeholder="email" value="' . $mail . '">';
  } else {
    echo '<input type="text" name="mail" placeholder="email">';
  };
  ?>
  <input type="password" name="pwd" placeholder="password">
  <input type="password" name="pwd2" placeholder="repeat password">
  <button type="submit" name="signupSubmit">submit</button>
  </form>

  <!-- CHECK URL FOR 'SIGNUP' PARAMETER, DISPLAY ERROR MESSAGES IF FOUND -->
  <h5>
  <?php if(!isset($_GET['signup'])){
      exit();
    } else {
      $signupCheck = $_GET['signup'];
      
      // if($_GET['signup'] == 'emptyfields'){
      if($signupCheck == 'emptyfields'){
        echo " Please complete all fields";
        exit();
      } 
      elseif($signupCheck == 'email'){
        echo "Please enter a valid email";
        exit();
      } elseif($signupCheck == 'username'){
        echo "Please enter a valid username";
        exit();
      } elseif($signupCheck == 'emailuser'){
        echo "Please enter a valid username and email address";
        exit();
      } elseif($signupCheck == 'pwdmatch'){
        echo "passwords did not match, please try again";
        exit();
      } elseif($signupCheck == 'sqlerror'){
        echo "error communicating with database :(";
        exit();
      } elseif($signupCheck == 'nametaken'){
        echo "username taken, please select another";
        exit();
      } elseif($signupCheck == 'success'){
        echo "<span class='success'>Signed up successfully!</span>";
        exit();
      }
    }
    ?>
    </h5>
</section>
  
</div>
</main>
<?php 
  require 'footer.php'
?>
