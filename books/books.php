<?php 

  function getBooks($connDB, $DBuid){
    $sql = "SELECT * FROM books_".$DBuid;
    $result = $connDB->query($sql);

    while($row = mysqli_fetch_assoc($result)){ 

  
      
    echo '
    
    <div class="bookRow">
      <div class="bookInfo">
        <p>' . $row['title'] . ' - ' . $row['author'] . '</p>
      </div>
      <div class="symbols">
        <form method="POST" action="">
          <input type="hidden" name="id" value="' . $row['id'] . '">
          <button class="editButton" type="submit" name="edit">edit</button>
        </form>
        <form method="POST" action="' . removeBook($connDB, $DBuid) . '">
          <input type="hidden" name="id" value="' . $row['id'] . '">
          <button class="deleteButton" type="submit" name="removeSubmit">delete</button>
        </form>
      </div>
    </div>
    
    <div class="bookRowEdit hidden">
      <div  class="bookInfo">
        <form  method="POST" action="'. editBook($connDB, $DBuid) . '">
          <input onkeydown="retSub(event)" name="title" value="'. $row['title'] .'">
          <input onkeypress="retSub(event)" name="author" value="'. $row['author'] .'"> 
        </div>
        <div class="symbols">
          <input type="hidden" name="id" value="'. $row['id'].'">
          <button class="doneButton" type="submit" name="editSubmit">done</button>
      </form>
      </div>
    </div>
    ';

    }
  };

  function addBook($connDB, $DBuid){
    if(isset($_POST['bookSubmit'])){
      $title = $_POST['title'];
      $author = $_POST['author'];

    $sql = "INSERT INTO books_". $DBuid ." (title, author) VALUES (?, ?)";
    $stmt = mysqli_stmt_init($connDB);
    if(!mysqli_stmt_prepare($stmt, $sql)){
      header("location: index.php?sqlFail");
      exit();
    }else{

    mysqli_stmt_bind_param($stmt, 'ss', $title, $author);
    mysqli_stmt_execute($stmt);

    header("location: index.php?comment=success");}
    }
  }

  function removeBook($connDB, $DBuid){
    if(isset($_POST['removeSubmit'])){
      $id=$_POST['id'];

      $sql = "DELETE FROM books_". $DBuid ." WHERE id=$id";

      $stmt = mysqli_stmt_init($connDB);
      mysqli_stmt_prepare($stmt, $sql);

      mysqli_stmt_execute($stmt);

      header("location: index.php?remove=$id");
    }
  }
  
  function editBook($connDB, $DBuid){
    if(isset($_POST['editSubmit'])){
      $author = $_POST['author'];
      $title = $_POST['title'];
      $id = $_POST['id'];
      
      $sql="UPDATE books_". $DBuid ." SET author='$author', title='$title' WHERE id=$id";
      $result = $connDB->query($sql); 
      header("location: index.php?edit=$id");
      // print $id;   
      
    }
  };