<?php
session_start();
include 'includes/headerError.inc.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="styles.css">
  <title>LOGIN</title>
</head>

<body>
  <nav>
    <div class="navLeft">
      <a href="index.php">
        <img src="assets/logo.png" alt="logo" class="nav-logo">
      </a>
      <ul>
        <li><a href="#">home</a></li>
        <li><a href="#">media</a></li>
        <li><a href="#">blog</a></li>
        <li><a href="#">contact</a></li>
      </ul>
    </div>
    <?php
    if (!isset($_SESSION['userUid'])) {
      $herror = 'hemlo';
      // $error = showError();
      echo '
        <div class="loginWrapper">
        <div class="loginForm">
          <form action="includes/login.inc.php" method="POST">
            <input type="text" name="mailUID" placeholder="username/email">
            <input type="password" name="pwd" placeholder="password">
            <button type="submit" name="loginSubmit">login</button>
            </form>
            <a href="signup.php">sign up</a>
        </div>
        <div class="errorMsg">'. $error .'</div>
        </div>
        ';
    } else {
      echo '
        <form action="includes/logout.inc.php" method="POST">
        <button class="logoutBtn" type="submit" name="logoutSubmit">logout</button>
        </form>
        ';
    }
    ?>
  </nav>

  <!-- <div class="loginWrapper">
    <div class="loginForm">
      <form action="includes/login.inc.php" method="POST">
        <input type="text" name="mailUID" placeholder="username/email">
        <input type="password" name="pwd" placeholder="password">
        <button type="submit" name="loginSubmit">login</button>
      </form>
      <a href="signup.php">sign up</a>
    </div>
    <div class="errorMsg">hai</div>
  </div> -->