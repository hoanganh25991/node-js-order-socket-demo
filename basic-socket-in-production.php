<?php
$rooms = ['room A', 'room B', 'room C', 'room D'];
?>
<!doctype html>
<html>
  <head>
    <title>List room</title>
  </head>
  <body>
    <ul id="rooms">
      <?php foreach($rooms as $room): ?>
        <li><span><?php echo $room; ?></span><button>book</button></li>
      <?php endforeach; ?>
    </ul>
    <script src="http://reservation.tinker.press/socket.io/socket.io.js"></script>
    <script src="http://code.jquery.com/jquery-1.11.1.js"></script>
    <script>
      var socket = io('reservation.tinker.press');
      $('form').submit(function(){
        socket.emit('chat message', $('#m').val());
        // socket.broadcast.emit('chat message', $('#m').val());
        $('#m').val('');
        return false;
      });

      socket.on('chat message', function(msg){
        console.log(msg);
        $('#messages').append($('<li>').text(msg));
      });
    </script>
  </body>
</html>