<html lang="en">


<head>
  <script src="https://code.jquery.com/jquery-3.5.0.min.js" integrity="sha256-xNzN2a4ltkB44Mc/Jz3pT4iU1cmeR0FkXs4pru/JxaQ=" crossorigin="anonymous"></script>
  <script>
    let from, userAnchors, start = 0,
      url = "http://localhost/php/login/chat/users.php";

    $(document).ready(function() {
      load();

      return false;
    });

    function load() {
      $.get(url, function(result) {
        if (result.users) {
          result.users.forEach(item => {
            $('#users').append(renderUser(item));
          })
        };
        userAnchors = Array.from(document.querySelectorAll('.userChatBtn'));

        userAnchors.forEach(a => a.addEventListener('click',function(e){
          console.log(e.target.id);
          activeChat = e.target.id;
          active = e.target.id;
          $.post(url, {
            activeChat: activeChat
          })
        }))
        
        // load();
      })
    }

    function renderUser(user) {
      console.log(user)
      return ` <div class="user"><p>${user.uid_users}
              <form id="chatForm" method="POST" action="./chatPage.php">
                <input type="hidden" name="id" value="${user.uid_users}">
                <button class="userChatBtn" type="submit" name="chatBtnSubmit">chat</button>
              </form>
              </div>`
    }
   
  </script>
</head>


</html>