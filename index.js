var app = require('express')();
var http = require('http').Server(app);

app.get('/', function(req, res){
  // res.send('<h1>Hello world</h1>');
  res.sendFile(__dirname + '/index.html');
});

let PORT = 3001;

http.listen(PORT, function(){
  console.log('listening on *:'+PORT);
});

var io = require('socket.io')(http);

io.on('connection', function(socket){
  socket.on('disconnect', function(){
    console.log('user disconnected');
  });
  socket.on('chat message', function(msg){
    console.log('message: ' + msg);
    // socket.broadcast.emit(msg);
    io.emit('chat message', msg);
  });
});