
<!DOCTYPE html>
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
          <p>BENVENUTI</p>

        </div>
       <ul class="topnav">
  <li><a class="active" href="http://localhost/StudioMedico/html/login.html">Accedi</a></li>
  <li><a href="http://localhost/StudioMedico/html/registrati.html">Registrati</a></li>
  <li><a href="http://localhost/StudioMedico/html/contatti.html">Contatti</a></li>
  <li class="right"><a href="http://localhost/StudioMedico/html/LoginMedico.html">Login Medici</a></li>
</ul>
</br>
</br>

<div class="container" >

<?php


require_once 'nusoap.php';
  header("Access-Control-Allow-Origin: *");
  $wsdl="http://localhost/StudioMedico/php/studioMedico.php?wsdl";
  $client=new nusoap_client($wsdl,true);
  $us = false;

//--------------------Chiamate Soap al server--------------------------
  


  function getLoginStato($utente,$password){
    global $client;
    if(isset($_POST['email'])&& isset($_POST['password'])){
            $result=$client->call('login',array('utente' => $utente, 'password' =>$password));
            if($result===true){
              echo "Autenticato";
              header("Location: http://localhost/StudioMedico/html/main.php?utente=".$utente);
              die();
			 
            }


          else{
          	//mi stampa l'errore
          	if ($client->fault) {
    		echo "<h2>Fault</h2><pre>";
    			print_r($result);
    			echo "</pre>";
			 } else {
    				$error = $client->getError();
    				if ($error) {
        				//echo "<h2>Error</h2><pre>" . $error . "</pre>";
                print "<font size='5px'>username o password errati</font>";
                print "<br/>";
    				 } 
			 }	
            print "<font size='5px'>login fallito</font>";

          }
    }
}

function getRegiStato($nome,$cognome,$codfiscp,$indirizzo,$tel,$codfiscm,$email,$password){
        global $client;
        if(isset($_POST['email'])&& isset($_POST['password']) && isset($_POST['password2'])){
        $passWord=$_POST['password'];
        if($passWord===$_POST['password2']){
          $email=$_POST['email'];
			echo "sono dentro alla funzione";
			echo $nome,$cognome,$codfiscp,$indirizzo,$tel,$codfiscm,$email,$password;
          $result=$client->call('registraUtente',array('nome'=>$nome, 'cognome'=>$cognome,'codFiscP'=>$codfiscp, 'indirizzo'=>$indirizzo, 'tel'=>$tel,'codFiscM'=>$codfiscm,'utente'=>$email,'password'=>$password));
          
            echo $codfiscm;
		  if($result===true){
		  	echo "Autenticato";
            header("Location: http://localhost/StudioMedico/html/main.php?utente=".$email);
            die();

          }else{
          	//mi stampa l'errore
          	if ($client->fault) {
    		echo "<h2>Fault</h2><pre>";
    			print_r($result);
    			echo "</pre>";
			 } else {
    				$error = $client->getError();
    				if ($error) {
        				echo "<h2>Error</h2><pre>" . $error . "</pre>";
    				 } 
			 }	

          }

        }
        else{
          echo 'Password non Inserita....';

        }

        }

}

function getDisdetta($codPrenotazione,$utente){
	global $client;
	$result=$client->call('getDisdetta',array('prenotazione'=>$codPrenotazione,'utente'=> $utente));
	if($result===true){
			 //$risposta=true;
              header("Location: http://localhost/StudioMedico/html/effettuata.php?risposta=true&utente=".$utente);
              die();
			 
            }


          else{
          	//mi stampa l'errore
          	if ($client->fault) {
    		echo "<h2>Fault</h2><pre>";
    			print_r($result);
    			echo "</pre>";
			 } else {
    				$error = $client->getError();
    				if ($error) {
        				echo "<h2>Error</h2><pre>" . $error . "</pre>";
    				 } 
			 }	
			 //$risposta=false;
			header("Location: http://localhost/StudioMedico/html/effettuata.php?risposta=false&utente=".$utente);
           
			
          }
	
}



function getPrenotazione($data,$motivo,$utente){
	global $client;
	$result=$client->call('getPrenotazione',array('data'=>$data, 'descrizione'=>$motivo,'utente'=> $utente));
	if($result===true){
              header("Location: http://localhost/StudioMedico/html/effettuata.php?risposta=true&utente=".$utente);
              die();
			 
            }
	  else{
          	//mi stampa l'errore
          	if ($client->fault) {
    		echo "<h2>Fault</h2><pre>";
    			print_r($result);
    			echo "</pre>";
			 } else {
    				$error = $client->getError();
    				if ($error) {
        				echo "<h2>Error</h2><pre>" . $error . "</pre>";
    				 } 
			 }	
            header("Location: http://localhost/StudioMedico/html/effettuata.php?risposta=false&utente=".$utente);

          }
	
}

/*
function getPrenota($utente){
	global $client;
	$result=$client->call('getPrenota',array('utente'=> $utente));
	print("*******************************************************************************************************************************************************************************************************************************");	
	foreach ($result as $i => $values) {
			print "</br>";
    		print "[$i] => {\n";
    foreach ($values as $key => $value) {
        print " [$key => $value ]  ";
    	}
    print "}\n";
	print "</br>";
	print("-------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------");
	}	
	//print_r($result);
	//header("Location: http://localhost/StudioMedico/html/disdetta.php?array=".$result."&utente=".$utente);
}*/
  	
	
function getLoginMedico($utente,$password){
    global $client;
    if(isset($_POST['emailm'])&& isset($_POST['passwordm'])){
            $result=$client->call('loginMedico',array('utente' => $utente, 'password' =>$password));
            if($result===true){
              echo "Autenticato";
              header("Location: http://localhost/StudioMedico/php/stampaM.php?medico=".$utente);
              die();
			 
            }


          else{
          	//mi stampa l'errore
          	if ($client->fault) {
    		echo "<h2>Fault</h2><pre>";
    			print_r($result);
    			echo "</pre>";
			 } else {
    				$error = $client->getError();
    				if ($error) {
        				//echo "<h2>Error</h2><pre>" . $error . "</pre>";
                print "<font size='5px'>username o password errati</font>";
                print "<br/>";
    				 } 
			 }	
            print "<font size='5px'>login fallito</font>";

          }
    }
}

	

	
	
	
	
 if(isset($_POST["name"])){
  		
  switch ($_POST["name"]) {
    case 'getLoginStato':
      getLoginStato($_POST['email'],$_POST['password']);
      break;
    case 'getRegiStato':
        getRegiStato($_POST['nome'], $_POST['cognome'], $_POST['codFiscP'], $_POST['indirizzo'], intval($_POST['tel']), $_POST['codFiscM'],$_POST['email'],$_POST['password']);
      break;
    case 'getDisdetta':
        getDisdetta($_POST['codPrenotazione'],$_GET['utente']);
        break;
    case 'getPrenotazione':
        getPrenotazione($_POST['mydatetime'],$_POST['descrizione'],$_GET['utente']);
        break;
	case 'getLoginMedico':
        getLoginMedico($_POST['emailm'],$_POST['passwordm']);
        break;
    default:
      # code...
      break;
  }
}





 ?>
 </div>
  </body>
</html>