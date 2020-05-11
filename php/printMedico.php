<html>
  <head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="" media="screen" title="no title" charset="utf-8">
    <link rel="stylesheet" href="http://localhost/StudioMedico/bootstrap/css/bootstrap.css">
  </head>
  <body style="background-color:#7fffd4">
    <script src="http://localhost/StudioMedico/js/jquery-2.1.4.js"></script>
    <script src="http://localhost/StudioMedico/bootstrap/js/bootstrap.js"></script>
    <div class="jumbotron" style="background-color:#004f7c;color:#fff;">
        <h1>Studio Medico Chiodarini</h1>
          <p>Non sempre una mela al giorno toglie il medico di torno</p>
           Medico: <?php echo  $_GET["medico"] ?>
        </div>
<ul class="topnav">
  <!--<li><a class="active" href="http://localhost/StudioMedico/html/main.php">News</a></li>-->
  <li><a href="http://localhost/StudioMedico/html/login.html">Logout</a></li>
  </ul>
</br>
</br>
  
   <div class="container">

    <div class="bs-example">
    <form method="post" action="http://localhost/StudioMedico/php/stampaM.php?medico=<?php echo  $_GET["medico"] ?>">
         <input type="date" name="day">
         <input type="hidden" name="name"  value="getPrenotaM"/>
        <button type="submit" class="btn btn-primary navbar-btn btn-lg">Stampa</button>
    </form>
</div></div>

  </body>
</html>
