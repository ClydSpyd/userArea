<?php

  $dbservername='localhost';
  $dbusername='root';
  $dbpassword='';
  $dbname='readingList';

  // $dbservername='https://databases-auth.000webhost.com/';
  // $dbusername='id13380199_admin';
  // $dbpassword='gzU&87NnVr1C%k8|';
  // $dbname='id13380199_books';

  $connDB = mysqli_connect($dbservername, $dbusername, $dbpassword, $dbname);