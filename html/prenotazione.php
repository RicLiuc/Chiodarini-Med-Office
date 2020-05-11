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
  <li><a href="main.php?name=getPrenota&utente=<?php echo  $_GET["utente"] ?>">Home</a></li>
  <li class="right"><a href="login.html">Logout</a></li>
  <li><a class="active" href="prenotazione.php?utente=<?php echo  $_GET["utente"] ?>">Effettua Prenotazione</a></li>
  <li><a href="http://localhost/StudioMedico/php/studioMprintClient.php?name=getPrenota&utente=<?php echo  $_GET["utente"] ?>">Gestisci Prenotazioni</a></li>
</ul>
</br>
</br>

    <div class="container">
    	<div class="jumbo">
    	<form method="post" action="http://localhost/StudioMedico/php/studioMedicoClient.php?utente=<?php echo  $_GET["utente"] ?>">
    	 <div class="form-group">
    	 	</br>
    	 	</br>
			</br>
            <label for="inputName">Descrizione:</label>
            </br>
			</br>
            <strong><textarea name="descrizione" required="true" rows="6" cols="30"></textarea></strong><br/>
		(facci sapere il motivo della prenotazione)
            
</br>
</br>
      
  <label> Scegli Giorno:
    <input type="date" required="true" name="mydatetime">
    <br/>
  </label>
</br>
  <input type="reset"  class="btn btn-primary navbar-btn btn-lg" value="Resetta il form">
 </br>
</br>
		  <input type="hidden" name="name"  value="getPrenotazione"/>
        <button type="submit" class="btn btn-primary navbar-btn btn-lg">Prenota</button>
    </form>
    
</br>
</br>    
           
        </div>
    </div>
  </div>
</body>
</html>