<html>
  <head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="" media="screen" title="no title" charset="utf-8">
    <link rel="stylesheet" href="http://localhost/StudioMedico/bootstrap/css/bootstrap.css">
     <script src="js/jquery.js"></script>
        <script>
            function call(){
            	 alert("sto stmpando il risultato");
                $.post('http://localhost/StudioMedico/php/studioMedicoClient.php', {name: "getPrenota", utente:"<?php echo  $_GET["utente"] ?>"});
            };
        </script>
  </head>
  <body style="background-color:#b3ff99">
  	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="http://localhost/StudioMedico/js/jquery-2.1.4.js"></script>
    <script src="http://localhost/StudioMedico/bootstrap/js/bootstrap.js"></script>
    <div class="jumbotron" style="background-color:#093;color:#fff;">
        <h1>Studio Medico Chiodarini</h1>
          <p>Non sempre una mela al giorno toglie il medico di torno</p>
          <div style='text-align:right'>Hai effettuato l'accesso come: <?php echo  $_GET["utente"] ?>     &nbsp; </div>
        </div>
<ul class="topnav">
  <li><a href="http://localhost/StudioMedico/html/main.php?name=getPrenota&utente=<?php echo  $_GET["utente"] ?>">Home</a></li>
  <li class="right"><a href="http://localhost/StudioMedico/html/login.html">Logout</a></li>
  <li><a href="http://localhost/StudioMedico/html/prenotazione.php?utente=<?php echo  $_GET["utente"] ?>">Effettua Prenotazione</a></li>
  <li><a class ="active" href="http://localhost/StudioMedico/php/studioMprintClient.php?name=getPrenota&utente=<?php echo  $_GET["utente"] ?>">Gestisci Prenotazioni</a></li>
</ul>
</br>
</br>
 <div class="container" style="color:#093;">	
  <h2>Lista Prenotazioni Effettuate</h2>
  <p></p>            

        <div class="jumbo">
        	
    </head>
    <body>
        		<!--<strong>Lista Prenotazioni Fatte:</strong> -->
        		</br>
 <?php

require_once 'nusoap.php';
  header("Access-Control-Allow-Origin: *");
  $wsdl="http://localhost/StudioMedico/php/studioMedico.php?wsdl";
  $client=new nusoap_client($wsdl,true);
  $us = false;

//--------------------Chiamate Soap al server--------------------------

    function getPrenota($utente){
	global $client;
  $a=1;
	$result=$client->call('getPrenota',array('utente'=> $utente));
	//print("*******************************************************************************************************************************************************************************************************************************");	
  print "</br>";
  print"<table border='3' width='100%'>";
  print"<tr> <td align='center' style='font-weight:bold'>Numero</td><td align='center' style='font-weight:bold'>Codice Prenotazione</td><td align='center' style='font-weight:bold'>Data</td><td align='center' style='font-weight:bold'>Nome</td><td align='center' style='font-weight:bold'>Cognome</td><td align='center' style='font-weight:bold'>Motivo</td> </tr>";
  foreach ($result as $i => $values) {
     print "<tr> <td align='center'>".$a."</td><td align='center'>".$values['CodicePrenotazione']."</td><td align='center'>".$values['Giorno']."</td><td align='center'>".$values['Nome']."</td><td align='center'>".$values['Cognome']."</td><td align='center'>".$values['MotivoV']."</td> </tr>";
     $a++;
   }
   print "</table>";
   print "</br>";
	/*foreach ($result as $i => $values) {
			print "</br>";
    		print "[$i] => {\n";
    foreach ($values as $key => $value) {
        print " [$key => $value \n]  ";
    	}
    print "}\n";
	print "</br>";
	print("-------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------");
	}	*/
	//print_r($result);
	//header("Location: http://localhost/StudioMedico/html/disdetta.php?array=".$result."&utente=".$utente);
}
	

if (isset($_GET['name'])){
  $prenota= $_GET['name'];
  switch ($_GET['name']) {
  	case 'getPrenota':
      getPrenota($_GET['utente']);
      break;
    default:
      # code...
      break;
  }	
}
?>
</br>
          
        <div class="form-group">
  		<form method="post" action="http://localhost/StudioMedico/php/studioMedicoClient.php?utente=<?php echo  $_GET["utente"] ?>">
           <strong><label for="input">Inserisci il codice di prenotazione da Cancellare</label> </strong>
           <br/>
           <br/>
          <input type="number" class="form-control" required="true" placeholder="Codice prenotazione" name="codPrenotazione">
          <br/>
          <h1></h1></h1>
          <br/>
           <input type="hidden" name="name" value="getDisdetta"/>
          <button type="submit" class="btn btn-primary navbar-btn btn-lg">Cancella</button>
        </form>  
      </div>
      <br/>
      <br/>
        </div>
    </div>
  </div>
</html>