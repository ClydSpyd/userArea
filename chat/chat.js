
let from, start = 0, url = "http://localhost/main/chat/chat.php";


$(document).ready( function(){
  from = 'ME';
  load();

//   $('form').submit(function(e){
//     $.post(url, {
//       message: $('#message').val(),
//       from: from
//     });
//     console.log($('#message').val());
//     $('#message').val("");
//     return false;
//   })
})

function load(){
  $.get(url +'?start=' + start, function(result){
    if(result.items){
      result.items.forEach(item =>{
        start = item.id;
        $('.chatMain').append(renderMessage(item));
      })
      $('.chatMain').animate({scrollTop: $('.chatMain')[0].scrollHeight});
    };
    // load();
    })
}

function renderMessage(item){
  // console.log(item);
  let time = new Date(item.created);
  time = `${time.getHours()}:${time.getMinutes() < 10 ? 0 : ''}${time.getMinutes()}`;
  let from = item.from;
  console.log(from.toLowerCase() === logged.toLowerCase())
  console.log(from)
  return from.toLowerCase() === logged.toLowerCase() ? 
  `<div class="msg-me ${item.from}">
    <div class="msg">
      <p>${item.from}</p>${item.message}<span>${time}</span>
    </div>
  </div>`
   : `<div class="msg ${item.from}"><p>${item.from}</p>${item.message}<span>${time}</span></div>`
}
