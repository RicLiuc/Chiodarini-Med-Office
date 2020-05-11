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
         <h2> <p>Lista  delle Prenotazioni</p></h2>
           <div style='text-align:right'>Hai effettuato l'accesso come: <?php echo  $_GET["medico"] ?>     &nbsp; </div>
        </div>
<ul class="topnav">
  <!--<li><a class="active" href="http://localhost/StudioMedico/html/main.php">News</a></li>-->
  <li class="right"><a href="http://localhost/StudioMedico/html/login.html">Logout</a></li>
  </ul>
</br>
</br><div class="container" style="color:#093">	

   
   <div class="bs-example">
   	
   </br>
   <h3>Indicare la data per stampare i pazienti giornalieri </br>
   	  oppure lascire vuoto per avere tutte le prenotazioni</h3>
  </br>  
  </br>
    <form method="post" action="http://localhost/StudioMedico/php/stampaM.php?medico=<?php echo  $_GET["medico"] ?>">
        <strong>Giorno:</strong> <input type="date" name="day">
         <input type="hidden" name="name"  value="getPrenotaM"/>
        <button type="submit" class="btn btn-primary navbar-btn btn-lg">Stampa</button>
    </form>



<?php
require_once 'nusoap.php';
  header("Access-Control-Allow-Origin: *");
  $wsdl="http://localhost/StudioMedico/php/studioMedico.php?wsdl";
  $client=new nusoap_client($wsdl,true);
  $us = false;


 		function getPrenotaM($day,$utente){
		global $client;
    $a = 1;
		$result=$client->call('getPrenotaM',array('utente'=> $utente,'day'=> $day));
		//print_r($result);
		print("*******************************************************************************************************************************************************************************************************************************");	
			print "</br>";
      print"<table border='3' width='100%'>";
      print"<tr> <td align='center' style='font-weight:bold'>Numero</td><td align='center' style='font-weight:bold'>Codice Prenotazione</td><td align='center' style='font-weight:bold'>Data</td><td align='center' style='font-weight:bold'>Nome</td><td align='center' style='font-weight:bold'>Cognome</td><td align='center' style='font-weight:bold'>Motivo</td> </tr>";
      foreach ($result as $i => $values) {
				 print "<tr> <td align='center'>".$a."</td><td align='center'>".$values['CodicePrenotazione']."</td><td align='center'>".$values['Giorno']."</td><td align='center'>".$values['Nome']."</td><td align='center'>".$values['Cognome']."</td><td align='center'>".$values['MotivoV']."</td> </tr>";
    			/*print "[$i] => {\n";
    		foreach ($values as $key => $value) {
        		print " [$key => $value \n]  ";
    		}*/
    	//print "}\n";
		//print("-------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------");
		$a++;
	 }
   print "</table>";
    print "</br>";
	
}



	if(isset($_POST["name"])){
  		
  		switch ($_POST["name"]) {
		
		case 'getPrenotaM':
        getPrenotaM($_POST['day'],$_GET['medico']);
       break;	
 		default:
      # code...
      break;
  }
	}
	
?>
</br>
</br>
 </div>
  </div>
</html>