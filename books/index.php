<?php 
  include 'dblink.inc.php';
  include 'books.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <style>
    body{
      font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
      font-weight: 100;
    }
    .wrapper{
      width:100vw;
    }
    .innerWrapper{
      text-align: center;
      width:40%;
      margin: 0 auto;
    }
    .listWrapper{
      padding:0 25px;
      margin: 0 auto;
      width:450px;
      margin-top:20px;
      border:1px solid #8080804d;
    }
    .bookRow, .bookRowEdit {
      font-size: 13px;
        height: 18px;
        display: flex;
        flex-direction: row;
        justify-content: space-between;
        align-items: center;
        margin: 10px 0;
    }
    .bookInfo{
      text-align: left;
      width:64%;
    }
    .symbols{
      width:35%;
      display: flex;
      flex-direction: row;
      justify-content: center;
    }
    .deleteButton, .editButton, .doneButton {
        cursor: pointer;
        color: white;
        border: none;
        font-size: 18px;
        line-height: 18px;
        font-weight: 100;
        margin-left: 5px;
        font-size: 12px;
    }
    .editButton, .doneButton {
    }
    .doneButton{
      margin:0 auto;
      width:92%;
      position: relative;
      left:2px;
    }
    .hidden{
      margin-left: 5px;
      display: none;
    }
  </style>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>BOOKS</title>
</head>
<body>
  <div class="wrapper">
    <div class="innerWrapper">
      <form method="POST" action="<?php addBook($connDB,$DBuid)?>">
        <input type="hidden" name="isbn" value="9780345444387">
        <input type="hidden" name="date" value="2020-04-17 01:06:55">
        <input name="title" placeholder="book title"></input>
        <input name="author" placeholder="author"></input>
        <button type="submit" name="bookSubmit">add</button>
      </form>
      <div class="listWrapper">
        <?php getBooks($connDB,$DBuid) ?>
      </div>
    </div>
  </div>
</body>
</html>

<script>

var edits = Array.from(document.querySelectorAll('.editButton'));
var dones = Array.from(document.querySelectorAll('.doneButton'));


//HIDE DETAILS, SHOW EDIT ON CLICK
edits.forEach(x => x.addEventListener('click', function(e){
  e.preventDefault(); 
  x.parentElement.parentElement.parentElement.classList.add('hidden');
  x.parentElement.parentElement.parentElement.nextElementSibling.classList.remove('hidden');
  x.parentElement.parentElement.parentElement.nextElementSibling.children[0].children[0].children[0].select()
  console.log(x)
}));

//HIDE EDIT, SHOW DETAILS ON CLICK
dones.forEach(x => x.addEventListener('click', function(e){
  x.parentElement.previousElementSibling.classList.remove('hidden');
  x.parentElement.classList.add('hidden');
}))

// SUBMIT EDIT FORM ON HITTING RETURN / CANCEL INPUT ON HITTING ESCAPE
function retSub(event){
  console.log(event.which)
  if (event.which == 13) {
    event.preventDefault();
    event.target.parentElement.parentElement.nextElementSibling.children[1].click();
  } else if(event.which == 27){
    event.target.parentElement.parentElement.parentElement.previousElementSibling.classList.remove('hidden');
    event.target.parentElement.parentElement.parentElement.classList.add('hidden');
    console.log(event.target.parentElement)
  }
}
</script>
