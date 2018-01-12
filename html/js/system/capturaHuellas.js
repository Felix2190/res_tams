function getHuella(idBiometrico,imgID)
	{
	  //mostrarError('No funciona');
	mostrarEspera('Conectando lector...');
    
	xajax_obtenerHuella(idBiometrico,imgID);
	
  	 }
 
 function guardar()
 {
    idPersona = $('#idPersona').val();
  
    mostrarEspera('Procesando Solicitud...');
   // mostrarEspera(idPersona);
    xajax_guardarHuellas(idPersona);
	
 }
     
