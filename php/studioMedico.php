<?php
    require_once 'nusoap.php';

    $soap = new soap_server;
    $soap->configureWSDL('studioMedico', 'http://localhost/StudioMedico/php/studioMedico');
    $soap->wsdl->schemaTargetNamespace = 'http://soapinterop.org/xsd/';



    $soap->wsdl->addComplexType(
        'ArrayOfString',
        'complexType',
        'array',
        'sequence',
        '',
        array(
        'itemName' => array(
          'name' => 'itemName',
          'type' => 'xsd:string',
          'minOccurs' => '0',
          'maxOccurs' => 'unbounded'
        ),
        'itemName2' => array(
          'name' => 'itemName2',
          'type' => 'xsd:string',
          'minOccurs' => '0',
          'maxOccurs' => 'unbounded'
        )
        )
    );

   $soap->wsdl->addComplexType(
				'Row',
				'complexType',
				'struct',
				'all',
				'',
				array(
				'codPrenotazione' => array('name' => 'codPrenotazione','type' => 'xsd:integer'),
				'codFiscP'=>array('name'=>'codFiscP','type'=>'xsd:string'),
        'nome'=>array('name'=>'nome','type'=>'xsd:string'),
        'cognome'=>array('name'=>'cognome','type'=>'xsd:string'),
        'giorno'=>array('name'=>'giorno','type'=>'xsd:date'),
        'utente'=>array('name'=>'utente','type'=>'xsd:string'),
        'motivo'=>array('name'=>'motivo','type'=>'xsd:string')
				)
		);

    $soap->wsdl->addComplexType('RData',
      'complexType',
      'array',
      '',
      'SOAP-ENC:Array',
        //array('RData' =>  array('name' =>'RData' ,'type' =>'tns:Row' )),
        array(),
        array(
            array(
                "ref" => "SOAP-ENC:arrayType",
                "wsdl:arrayType" => "tns:Row[]"
            )
        ),"tns:Row"
);
    //---------------- registro le funzioni-------------------------------------
    $soap->register(
    'hashing',
    array('password'=> 'xsd:string'),
    array('hash'=> 'xsd:string'),
    'http://soapinterop.org/'

    );
     $soap->register(
    'login',
    array('utente'=> 'xsd:string','password'=> 'xsd:string'),
    array('stato'=> 'xsd:boolean'),
    'http://soapinterop.org/'

    );
	
	 $soap->register(
    'loginMedico',
    array('utente'=> 'xsd:string','password'=> 'xsd:string'),
    array('stato'=> 'xsd:boolean'),
    'http://soapinterop.org/'

    );
	
    $soap->register(
    'registraUtente',
    array('nome'=>'xsd:string', 'cognome'=>'xsd:string','codFiscP'=>'xsd:string','indirizzo'=>'xsd:string','tel'=>'xsd:integer','codFiscM'=>'xsd:string','utente'=> 'xsd:string','password'=> 'xsd:string'),
    array('stato'=> 'xsd:boolean'),
    'http://soapinterop.org/'

    );

   $soap->register(
            'getPrenota',
            array('utente'=> 'xsd:string'),
            array('result'=> 'tns:ArrayOfString'),
            'http://soapinterop.org/'
);

   $soap->register(
            'getPrenotaM',
            array('utente'=> 'xsd:string','day'=>'xsd:date'),
            array('result'=> 'tns:ArrayOfString'),
            'http://soapinterop.org/'
);


   $soap->register(
            'getPrenotazione',
            array('data'=>'xsd:dateTime', 'descrizione'=>'xsd:string', 'utente'=> 'xsd:string'),
            array('stato'=> 'xsd:boolean'),
            'http://soapinterop.org/'
);


  $soap->register(
                'getDisdetta',
                array('prenotazione'=> 'xsd:integer','utente'=> 'xsd:string'),
            	array('stato'=> 'xsd:boolean'),
                'http://soapinterop.org/'

                );
				
				// array('input'=> 'xsd:null'),
                //array('result'=> 'tns:RData'),
               
        
        $soap->service(file_get_contents("php://input"));
        //$soap->service(isset($HTTP_RAW_POST_DATA) ?
        //$HTTP_RAW_POST_DATA : '');
    // ---------------------funzioni del webservice-----------------------------

    
    //permette la connessione al database
    function connetiDatabase(){
      $username="root";
      $password="";
      $database="studiomedico";
      $servername="localhost";
      $conn = new mysqli($servername, $username, $password,$database);
      if ($conn->connect_error) {
          die("Connection failed: " . $conn->connect_error);

        }
      return $conn;
    }
	
    function hashing($password){

      return hash('ripemd160',$password);
    }
	
	//funzione permette il login paziente se lo stato è true allora ha trovato il medico con le cedenziali inserite.
    function login($utente,$password){
        $stato=false;
        //$hash1="";
        $conn=connetiDatabase();
        //$hash2=hashing($password);
        $query="select * from pazienti where Email='$utente' and PasswordP = '$password'";
        $ris=$conn->query($query);
        if ($ris->num_rows > 1) {
            $stato=false;
			echo "più account trovati!";
		}elseif($ris->num_rows ==0){
      $stato=false;
      echo "account non trovato!";
    }else{
			$stato=true;
		}
      return $stato;
    }
	
	//funzione permette il login al medico se lo stato è true allora ha trovato il medico con le cedenziali inserite.
	function loginMedico($utente,$password){
        $stato=false;
        //$hash1="";
        $conn=connetiDatabase();
        //$hash2=hashing($password);
        $query="select * from medici where EmailM='$utente' and PasswordM = '$password'";
        $ris=$conn->query($query);
        if ($ris->num_rows > 1) {
            $stato=false;
        echo "più account trovati!";
        }elseif($ris->num_rows ==0){
          $stato=false;
          echo "account non trovato!";
        }
		else{
			$stato=true;
		}
      return $stato;
    }
	
	
 //permetta l'inserimento di un nuovo paziente  nel database
    function registraUtente($nome,$cognome,$codFiscP,$indirizzo,$tel,$codFiscM,$utente,$password){
        $stato=false;
        $conn=connetiDatabase();
        //$hash=hashing($password);
		    $temp="null";
        //error_log($hash);
        $query="insert into `pazienti` (`CodicefiscaleP`, `Nome`, `Cognome`, `Indirizzo`, `Comune`, `Email`, `UserP`, `PasswordP`, `Telefono`, `CodicefiscaleM`) values('".$codFiscP."','".$nome."','".$cognome."','".$indirizzo."','".$temp."','".$utente."','".$temp."','".$password."','".$tel."','".$codFiscM."');";
        //error_log($query);
        if(mysqli_query($conn, $query)){
          $stato=true;
          //error_log('hey');

        }


        return $stato;
    }

 // permete all'utente una volta registrato di prenotare una visita
function getPrenotazione($data,$motivo,$utente){
	  $stato=false;
		$conn=connetiDatabase();
		$query1= "select CodicefiscaleM, CodicefiscaleP from pazienti where email='$utente';";
        $result1=$conn->query($query1);
         while ($row = $result1->fetch_assoc()) {
         	//creo un codice progressivo 
				$CodPren=rand(0, 1100);
				$query="insert into `prenotazionepazienti` (`CodicefiscaleP`, `CodicefiscaleM`, `CodicePrenotazione`,`Giorno`, `utente`, `MotivoV`) values('".$row['CodicefiscaleP']."','".$row['CodicefiscaleM']."','".$CodPren."','".$data."','".$utente."','".$motivo."');";
				//error_log($query);
        		if(mysqli_query($conn, $query)){
          			$stato=true;
        		}

      }
	 return $stato;
	}


//funione che stampa tutte le visite prenotate dal paziente che ha fatto il login
    function getPrenota($utente){
      $conn=connetiDatabase();
      $query= "select prenotazionepazienti.CodicePrenotazione, prenotazionepazienti.CodiceFiscaleP, pazienti.Nome, pazienti.Cognome, prenotazionepazienti.Giorno, prenotazionepazienti.utente, prenotazionepazienti.MotivoV from prenotazionepazienti, pazienti where prenotazionepazienti.CodiceFiscaleP=pazienti.CodicefiscaleP and prenotazionepazienti.utente='".$utente."';";
      $result=$conn->query($query);
      $row;
      $res=array();
        while ($row = $result->fetch_assoc()) {

            array_push($res,$row);
            //error_log(print_R($res,TRUE));

        }
        //error_log(json_encode($res)."disdetta");
		//print_r($res);
        return $res;

    }
	
//funione che stampa tutte le visite prenotate dal paziente che ha fatto il login
    function getPrenotaM($utente, $day){
      $conn=connetiDatabase();
      $query= "select prenotazionepazienti.CodicePrenotazione, prenotazionepazienti.CodiceFiscaleP, pazienti.Nome, pazienti.Cognome, prenotazionepazienti.Giorno, prenotazionepazienti.utente, prenotazionepazienti.MotivoV from prenotazionepazienti, pazienti, medici where prenotazionepazienti.CodiceFiscaleP=pazienti.CodicefiscaleP and  prenotazionepazienti.CodiceFiscaleM=medici.CodicefiscaleM  and  prenotazionepazienti.Giorno like '$day%'  and medici.EmailM='$utente';";
      $result=$conn->query($query);
      $row;
      $res=array();
        while ($row = $result->fetch_assoc()) {

            array_push($res,$row);
            //error_log(print_R($res,TRUE));

        }
        //error_log(json_encode($res)."disdetta");
		//print_r($res);
        return $res;

    }
	
	

//permette la cancellazioen di una prenotazioen effettuata.
 function getDisdetta($codPrenotazione,$utente){
	  $stato=FALSE;
      $conn=connetiDatabase();
       $query= "delete from prenotazionepazienti where CodicePrenotazione='".$codPrenotazione."';";
 	  	error_log($query);
      	if(mysqli_query($conn, $query)){
          		   $stato=true;
          		//error_log('hey');
          		//getPrenota($utente);
        		}
	 	return $stato;


    }
 




 ?>
