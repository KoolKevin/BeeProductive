<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
    <center>
      <h1 id="kevin" style="color:red">Kevin non sa fare niente</h1>
    </center>
  </body>
  <script>
    var arr = ["0","1","2","3","4","5","6","7","8","9","a","b","c","d","e","f"];
    var app = "";

    function cambia(){
      app = "#";

      for(var i = 0;i < 6;i++){
        app += arr[parseInt(Math.random()*16)];
      }

      document.getElementById("kevin").style.color = app;
    }

    setInterval(cambia,500);

  </script>
</html>
