<!DOCTYPE html>
<html>
  <head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="utf-8">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <style>
      html {
          font-family: Arial;
          display: inline-block;
          margin: 0px auto;
          text-align: center;
      }
      
      h1 { font-size: 2.0rem; color:#2980b9;}
      h2 { font-size: 1.25rem; color:#2980b9;}
      .img {
        width: 10rem;
      }
      .buttonON {
        font-size: 21px;
        color: white;
        margin: 2rem auto;
        padding: 1rem 2rem;
        border: none;
        background-color: #5CB85C;
        box-shadow: #175917 4px 4px 4px;
        border-radius: 10px;
        transition: transform 200ms, box-shadow 200ms;
      }
      .buttonON:hover {background-color: #80D680}
      .buttonOFF {
        font-size: 21px;
        color: white;
        margin: 2rem auto;
        padding: 1rem 2rem;
        border: none;
        background-color: #D9534F;
        box-shadow: #4B120F 4px 4px 4px;
        border-radius: 10px;
        transition: transform 200ms, box-shadow 200ms;
      }
      .buttonOFF:hover {background-color: #E58A85}
      .buttonON:active, .buttonOFF:active {
        transform: translateY(4px) translateX(4px);
        box-shadow: #094c66 0px 0px 0px;
      }
    </style>
  </head>
  <body>
    <div class="bg-dark p-3">
      <h1 class="display-4 text-center text-white">GROUP 5:</h1>
      <h3 class="display-6 text-center text-white">GET REQUEST(Turn LED On/Off)</h3>
    </div>
    
    <div class="container">   
      <div class="py-3">
        <img id="led" class="img" src="img/led-off.png" alt="">
      </div>
      <form action="update.php" method="post" id="LED_ON" onsubmit="myFunction()">
        <input type="hidden" name="status" value="1"/>    
      </form>
      
      <form action="update.php" method="post" id="LED_OFF">
        <input type="hidden" name="status" value="0"/>
      </form>
      <div>
        <button class="buttonON mx-4 fw-bold" name= "subject" type="submit" form="LED_ON" value="SubmitLEDON" >ON</button>
        <button class="buttonOFF mx-4 fw-bold" name= "subject" type="submit" form="LED_OFF" value="SubmitLEDOFF">OFF</button>
      </div>
      
    </div>
<script src="js/jquery.min.js"></script>
<script>
$(document).ready(function () {
  bulb();
});
function bulb() {
  {
    $.post("getleddata.php",
    function(data){
      var led_stat = [];

      for (var i in data) {
        led_stat.push(data[i].status);
      }
      var ledstatus = led_stat[0];
      if (ledstatus == 1) {
        $('#led').attr("src", "img/led-on.png");
      } else if (ledstatus == 0) {
        $('#led').attr("src", "img/led-off.png");
      }
    })
  }
}
</script>
  </body>
</html>