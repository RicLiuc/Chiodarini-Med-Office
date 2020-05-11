$(document).ready(function(){
                $('.stampa').click(function(event){
                  event.preventDefault();
                     $.post("http://localhost/StudioMedico/php/studioMedicoClient.php",{name:"getPrenota"}){
                     };
			});
  });
     
 
