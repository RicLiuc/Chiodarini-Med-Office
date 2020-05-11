
<html>
  <head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="" media="screen" title="no title" charset="utf-8">
    <link rel="stylesheet" href="http://localhost/StudioMedico/bootstrap/css/bootstrap.css">
  </head>
  <body style="background-color:#b3ff99">
    <script src="http://localhost/StudioMedico/js/jquery-2.1.4.js"></script>
    <script src="http://localhost/StudioMedico/bootstrap/js/bootstrap.js"></script>
    <div class="jumbotron" style="background-color:#093;color:#fff;">
        <h1>Studio Medico Chiodarini</h1>
          <p>Non sempre una mela al giorno toglie il medico di torno</p>
          <div style='text-align:right'>Hai effettuato l'accesso come: <?php echo  $_GET["utente"] ?>     &nbsp; </div>
        </div>
<ul class="topnav">
  <li><a class="active" href="main.php?name=getPrenota&utente=<?php echo  $_GET["utente"] ?>">Home</a></li>
  <li class="right"><a href="login.html">Logout</a></li>
  <li><a href="prenotazione.php?utente=<?php echo  $_GET["utente"] ?>">Effettua Prenotazione</a></li>
  <li><a href="http://localhost/StudioMedico/php/studioMprintClient.php?name=getPrenota&utente=<?php echo  $_GET["utente"] ?>">Gestisci Prenotazioni</a></li>
  

</ul>
</br>
</br>

    <div class="container" align="center" style="color:#093;">

        <div class="jumbo">
        	<strong><h1>
           <p>Benvenuti nel</p> 
           <p>portale utente</p> 
           </br>
           <strong></h1>
        </div>
        

	<div align="center">
	<img title="stud" src="http://localhost/StudioMedico/images/ss.jpg" alt="Studio" width="620" height="435"/>
</div>
</br></br>
	
	


</div>
</div>
  
    </div>
  </div>

</body>
</html>
