<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>SOCKET IO APP</title>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/socket.io/2.0.1/socket.io.js"></script>

    <script>

      var socket = io (":6001");

      socket.on('message',function(data){
        console.log("From server: ", data);
      }).on('server-info', function(data){
        console.log(data);
      });

    </script>

  </head>

  <body>

  </body>
</html>
