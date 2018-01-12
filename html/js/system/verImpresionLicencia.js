

      function imprimir(idLicencia,imprimir){
       
       if(imprimir!=0)
       {
        mostrarEspera('Procesando Solicitud...');
            
            	xajax_conectarImpresora(idLicencia);
        
        }
        else
        {
            mostrarDenegado("Faltan datos de la licencia que se desea imprimir.");
        }
      
	    	        
      }
      

      