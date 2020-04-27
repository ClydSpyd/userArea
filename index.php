<?php 
  require 'header.php'
?>
<main>
<div class="wrapperMain">
  
<?php
if(isset($_SESSION['userUid'])){
  $uid = $_SESSION['userUid'];
 echo "<p>welcome, " . $uid .  "</p>";
 include 'userArea.php';
} else {
  echo"<p>you are logged out</p>";
}
?>
  
</div>
</main>
<?php 
  require 'footer.php'
?>
