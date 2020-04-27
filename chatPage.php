
<script
  src="https://code.jquery.com/jquery-3.5.0.min.js"
  integrity="sha256-xNzN2a4ltkB44Mc/Jz3pT4iU1cmeR0FkXs4pru/JxaQ="
  crossorigin="anonymous">
</script>

<script src="./chat/chat.js"></script>

<?php 
  require 'header.php';
  echo 'hai';
  $_SESSION['activeChat'] = $_POST['id'];
?>

<main>
<div class="wrapperMain">
<div class="chatWrapper">
  <?php
  if(isset($_SESSION['userUid'])){
    //  $uid = $_SESSION['userUid'];
     echo "<input type='hidden' class='activeHidden' data-active=".$_SESSION['activeChat']."  data-logged= ".$_SESSION['userUid']." >";
    } else {
        echo"<p>you are logged out</p>";
      }
    ?>

  <section class="chatLeft">
  </section>
  
  <section class="chatRight">
  <div class="chatMain"></div>
  <?php echo $_SESSION['activeChat'] ?>
  <?php echo $_SESSION['userUid'];
  

  ?>
  
  <div class="chatMsgBox"></div>
  </section> 
   
</div> 
</div>
</main>
<?php 
  require 'footer.php'
?>
<script>
 let activeChat =  $('.activeHidden')[0].dataset.active;
 let logged = $('.activeHidden')[0].dataset.logged;
// let activeChat = $('.activeHidden')[0].id;
</script>
