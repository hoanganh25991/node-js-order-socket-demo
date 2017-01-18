<?php
$rooms = [
  [
    'id' => 'roomA',
    'name' => 'room A'
  ],
  [
    'id' => 'roomB',
    'name' => 'room B'
  ],
  [
    'id' => 'roomC',
    'name' => 'room C'
  ],
  [
    'id' => 'roomD',
    'name' => 'room D'
  ],
  [
    'id' => 'roomE',
    'name' => 'room E'
  ]        
];
?>
<!doctype html>
<html>
  <head>
    <title>List room</title>
  </head>
  <style>
    .booked {
      background-color: #00a65a;
    }
  </style>
  <body>
    <ul id="rooms">
      <?php foreach($rooms as $room): ?>
        <li id="<?php echo $room['id']; ?>"><span><?php echo $room['name']; ?></span><button room-id="<?php echo $room['id']; ?>">book</button></li>
      <?php endforeach; ?>
    </ul>
    <script src="http://reservation.tinker.press/socket.io/socket.io.js"></script>
    <script>
      var socket = io('reservation.tinker.press');

      let ul = document.querySelector('#rooms');
      ul.addEventListener('click', function(e){
        // console.log(e);
        let btn = e.target;
        let roomId = btn.getAttribute('room-id');

        socket.emit('chat message', roomId);
      });

      socket.on('chat message', function(roomId){
        console.log('room id:', roomId);
        let clickedElement = document.querySelector('#' + roomId);
        let btn = clickedElement.childNodes[1];
        if(clickedElement.classList.contains('booked')){
          clickedElement.classList = '';
          btn.innerText = 'book';
        }else{
          clickedElement.classList = 'booked';
          btn.innerText = 'unbook';
        }
      });
    </script>
  </body>
</html>