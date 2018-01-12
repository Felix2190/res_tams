     $(document).ready(function(){inicializarControles()});
     
 var inicializarControles=function()
	{
    $(".numeric").numeric({integers:true,negative : false});
		$(".cp").change(function(){existeCodigo=false;});

		$("#txtMoneda").attr('disabled','disabled');

		$("#frmLogin").submit(altaUsuario);
		$("#btnAltaUsuario").click(function(){
			altaUsuario();
  		});

		$("#txtUserName").change(function(){
			$('#respUserName').html('<div><input type="hidden" name="bol_user" value="false" /></div>');
	  		});

		$("#txtTel").change(function(){
			validarTel('');
			var tel=$("#txtTel").val().trim();
		});
		$("#txtFTel").change(function(){
			validarTel('F');
		});
		
    $('#chckFact').change(function(){
    	if($("#chckFact").is(':checked'))
    		$("#divFact").hide();
    	else
    		$("#divFact").show();
       });


    $('#slcPais').change(function(){
        if($('#slcPais').val()=='129'){
        	$(".otros").hide();
        	$(".mexico").show();
       		mostrarEstados('');
        }
        else{
        	$(".mexico").hide();
        	$(".otros").show();
        	$('#txtEstado').val('');
        	$('#txtCiudad').val('');
        }
        
    });
    $('#slcFPais').change(function(){
       
       if($('#slcFPais').val()=='129'){
       	$(".otrosF").hide();
       	$(".mexicoF").show();
      		mostrarEstados('F');
       }
       else{
       	$(".mexicoF").hide();
       	$(".otrosF").show();
       	$('#txtFEstado').val('');
       	$('#txtFCiudad').val('');
       }
       
    });
    function mostrarEstados(slc){
        var pais= $('#slc'+slc+'Pais').val();
        if(pais!=''){
        	$.ajax(
                    {
                    	method:"post",
            					url: "getCombos.php",  					
            					data: 
            					{  						
                        idPais : pais              
            					},
            					success: function(data) 
            					{
                					
            	          $('#slc'+slc+'Estado').html(data);
            	          $('#slc'+slc+'Estado').removeAttr('disabled');
            	        
            	   		}
          		    });
        }
        else{
        	$('#slc'+slc+'Estado').html('<option value="">Seleccione una opci&oacute;n</option>');
        	$('#slc'+slc+'Estado').attr('disabled', 'disabled');
        	
        }
        $('#slc'+slc+'Municipio').html('<option value="">Seleccione una opci&oacute;n</option>');
     	$('#slc'+slc+'Municipio').attr('disabled', 'disabled');
     	$('#slc'+slc+'Ciudad').attr('disabled', 'disabled');
     	$('#slc'+slc+'Ciudad').html('<option value="">Seleccione una opci&oacute;n</option>');
    	$('#slc'+slc+'Colonia').attr('disabled', 'disabled');
    	$('#slc'+slc+'Colonia').html('<option value="">Seleccione una opci&oacute;n</option>');
    }


    $('#slcEstado').change(function(){
        mostrarMunicipios('');
     });
     $('#slcFEstado').change(function(){
        mostrarMunicipios('F');
     });
     function mostrarMunicipios(slc){
         var opc= $('#slc'+slc+'Estado').val();
         if(opc!=''){
         	$.ajax(
                     {
                     	method:"post",
             					url: "getCombos.php",  					
             					data: 
             					{  						
                         idEst : opc              
             					},
             					success: function(data) 
             					{
                 					
             	          $('#slc'+slc+'Municipio').html(data);
             	          $('#slc'+slc+'Municipio').removeAttr('disabled');
             	        
             	   		}
           		    });

         	$.ajax(
                    {
                    	method:"post",
            					url: "getCombos.php",  					
            					data: 
            					{  						
                        nombre : 'est',
                        idE : opc              
            					},
            					success: function(data) 
            					{
            						$('#txt'+slc+'EstadoN').val(data);
            	   		}
          		    });  
         }
         else{
         	$('#slc'+slc+'Municipio').html('<option value="">Seleccione una opci&oacute;n</option>');
         	$('#slc'+slc+'Municipio').attr('disabled', 'disabled');
         }
      	$('#slc'+slc+'Colonia').attr('disabled', 'disabled');
     	$('#slc'+slc+'Colonia').html('<option value="">Seleccione una opci&oacute;n</option>');
    
     }

     $('#slcMunicipio').change(function(){
         mostrarColonias('');
      });
      $('#slcFMunicipio').change(function(){
         mostrarColonias('F');
      });
      function mostrarColonias(slc){
          var opcE= $('#slc'+slc+'Estado').val();
          var opcM= $('#slc'+slc+'Municipio').val();
          
          if(opcM!=''){
          	$.ajax(
                      {
                      	method:"post",
              					url: "getCombos.php",  					
              					data: 
              					{  						
                          idEst : opcE,
                          idMun: opcM              
              					},
              					success: function(data) 
              					{
              	          $('#slc'+slc+'Colonia').html(data);
              	          $('#slc'+slc+'Colonia').removeAttr('disabled');
              	        
              	   		}
            		    });


         	$.ajax(
                    {
                    	method:"post",
            					url: "getCombos.php",  					
            					data: 
            					{  						
                        nombre : 'mun',
                        idM : opcM,
                        idE : opcE          
            					},
            					success: function(data) 
            					{
            						$('#txt'+slc+'MunicipioN').val(data);
            	   		}
          		    });  
		    
          }
          else{
          	$('#slc'+slc+'Colonia').html('<option value="">Seleccione una opci&oacute;n</option>');
          	$('#slc'+slc+'Colonia').attr('disabled', 'disabled');
          }
      }
         

      $('#slcColonia').change(function(){
    	  var cp= $('#slcColonia').val().split('_');
    	  $('#txtCP').val(cp[1]);
       	$.ajax(
                {
                	method:"post",
        					url: "getCombos.php",  					
        					data: 
        					{  						
                    nombre : 'col',
                    idP : cp[0]               
        					},
        					success: function(data) 
        					{
        						$('#txtColoniaN').val(data);
        	   		}
      		    });  
	  
       });

      $('#slcFColonia').change(function(){
    	  var cp= $('#slcFColonia').val().split('_');
    	  $('#txtFCP').val(cp[1]);
         	$.ajax(
                    {
                    	method:"post",
            					url: "getCombos.php",  					
            					data: 
            					{  						
                        nombre : 'col',
                        idP : cp[0]               
            					},
            					success: function(data) 
            					{
            						$('#txtFColoniaN').val(data);
            	   		}
          		    });  
       });


      $('#slcFPlan').change(function(){
          if($('#slcFPlan').val()==''){
          	$("#txtMoneda").val('');
          }
          else{
        	  $.ajax(
                      {
                      	method:"post",
              					url: "getCombos.php",  					
              					data: 
              					{  		
                          moneda : $('#slcFPlan').val()               
              					},
              					success: function(data) 
              					{ 
              						var datos = JSON.parse(data);
              					$('#txtMoneda').val(datos['name']);
              					$('#txtMonedaN').val(datos['name']);
             					$('#txtMonedaID').val(datos['id']);
              	   		}
            		    });
          }
          
      });

      cargarPaises('');
      cargarPaises('F'); 
      cargarPlanes();
      cargarEstatus();
      cargarRutas();
      cargarIdiomas('Fac');

      cargarIdiomas('CRM');

      cargarDatos();

	}

 function buscarCP(slc){
 	var cp = $('#txt'+slc+'CP').val();
 	if(cp.length==5){
 		$.ajax(
               {
               	method:"post",
       					url: "getCombos.php",  					
       					data: 
       					{  						
                   CP: cp
                   		},
       					success: function(data) 
       					{ 
       				var datos = JSON.parse(data);
       				$(".mexico"+slc).show();
       				$('#slc'+slc+'Municipio').html('<option value="'+datos['c_mnpio']+'">'+datos['D_mnpio']+'</option>');
                  	$('#slc'+slc+'Colonia').html('<option value="'+datos['idPostal']+'_'+datos['d_codigo']+'">'+datos['d_asenta']+'</option>');
                  	$('#slc'+slc+'Pais').val('129');
      	          $('#slc'+slc+'Estado').val(datos['c_estado']);
            	      $('#slc'+slc+'Estado').removeAttr('disabled');
            	   $('#slc'+slc+'Municipio').removeAttr('disabled');
            	   $('#slc'+slc+'Colonia').removeAttr('disabled');
            		//$('#slc'+slc+'Municipio').attr('disabled', 'disabled');
              	//$('#slc'+slc+'Colonia').attr('disabled', 'disabled');
              	$('#txt'+slc+'Ciudad').val('');
              	$('#txt'+slc+'EstadoN').val(datos['NOM_ENT']);
              	$('#txt'+slc+'MunicipioN').val(datos['NOM_MUN']);
              	$('#txt'+slc+'ColoniaN').val(datos['d_asenta']);
       	   		}
     		    });
 	}
	}

function validarTel(txt){
	  var tel=$("#txt"+txt+"Tel").val().trim();
		if(tel.length!=12){
			$('#tel'+txt+'_longitud').val('false');
		}else{
			$('#tel'+txt+'_longitud').val('true');
		}
//		alert($('#tel'+txt+'_longitud').val());
}

function buscarUserName(){
	var user = $('#txtUserName').val();
	if(user.length>4){
		$.ajax(
             {
             	method:"post",
     					url: "admincuentas.php",  					
     					data: 
     					{  						
                 username: user
                 		},
     					success: function(data) 
     					{
         				if(data){
         					$('#respUserName').html('<div class="btn btn-default btn-circle btn-success"><i class="fa fa-check "></i><input type="hidden" id="bol_user" value="true" /></div>');
         				}
         				else
         					$('#respUserName').html('<a class="btn btn-default btn-circle btn-danger"><i class="fa fa-times "></i></a><input type="hidden" id="bol_user" value="false" />');
			}
   		    });
	}
	else{
		$('#respUserName').html('<a class="btn btn-default btn-circle btn-danger"><i class="fa fa-times "></i></a><input type="hidden" name="bol_user" value="false" />');
	}
}

function cargarPaises(slc){
	$.ajax(
         {
         	method:"post",
 					url: "getCombos.php",  					
 					data: 
 					{  		
             arrPaises : $('#h'+slc+'Pais').val()               
 					},
 					success: function(data) 
 					{ 
					$('#slc'+slc+'Pais').html(data);
 	   		}
		    });
}

function cargarPlanes(){
	$.ajax(
         {
         	method:"post",
 					url: "getCombos.php",  					
 					data: 
 					{  		
             arrPlan : $('#hPlan').val()               
 					},
 					success: function(data) 
 					{ 
					$('#slcFPlan').html(data);
 	   		}
		    });
}
function cargarRutas(){
	$.ajax(
         {
         	method:"post",
 					url: "getCombos.php",  					
 					data: 
 					{  		
             arrRutas : $('#hRuta').val()               
 					},
 					success: function(data) 
 					{ 
					$('#slcRuta').html(data);
 	   		}
		    });
}

function cargarEstatus(){
	$.ajax(
         {
         	method:"post",
 					url: "getCombos.php",  					
 					data: 
 					{  		
             arrEstatus : $('#hEstatus').val()               
 					},
 					success: function(data) 
 					{ 
					$('#slcEstatus').html(data);
 	   		}
		    });
}

function cargarIdiomas(op){
	$.ajax(
         {
         	method:"post",
 					url: "getCombos.php",  					
 					data: 
 					{  		
             arrIdioma : $('#hIdioma'+op).val()               
 					},
 					success: function(data) 
 					{ 
					$('#slcIdioma'+op).html(data);
 	   		}
		    });
}


function cargarDatos(){
	
	if($('#adminUCC').val())
	$.ajax(
         {
         	method:"post",
 					url: "getCombos.php",  					
 					data: 
 					{  		
             getDatos : null               
 					},
 					success: function(data) 
 					{
 						var datos = JSON.parse(data);
 						$('#slcFPlan').val(datos['PlanId']);
 						$('#slcRuta').val(datos['RouteId']);
 						$('#slcIdiomaCRM').val(datos['language_id']);
 						$('#slcIdiomaFac').val(datos['language_id']);
     			
		//			$('#slcEstatus').html(data);
 	   		}
		    });
}

function altaUsuario(){
	var datos  = {};
		
	datos['Cnombre'] = $('#txtNombres').val().trim();
	if(datos['Cnombre']== ''){
		msgC = ' Por favor agregue el nombre.';
		mostrarAviso(msgC);
		return false;
	}
	
	datos['Capaterno'] = $('#txtPaterno').val().trim();
	if(datos['Capaterno']== ''){
		msgC = ' Por favor agregue el apellido paterno.';
	mostrarAviso(msgC);
	return false;
	}
	
	datos['Camaterno'] = $('#txtMaterno').val().trim();
	if(datos['Camaterno']== ''){
		msgC = ' Por favor agregue el apellido materno.';
		mostrarAviso(msgC);
		return false;
	}
	
	datos['Ccorreo'] = $('#txtEmail').val().trim();
	if(datos['Ccorreo']== ''){
		msgC = ' Por favor agregue el correo electr&oacute;nico.';
		mostrarAviso(msgC);
		return false;
	}
	
	datos['Crazon'] = $('#txtRazon').val().trim();
	if(datos['Crazon']== ''){
		msgC = ' Por favor agregue la raz&oacute;n social.';
		mostrarAviso(msgC);
		return false;
	}
	
	datos['Cpais'] = $('#slcPais').val();
	if(datos['Cpais']== '') {
		msgC = ' Por favor seleccione un pa&iacute;s ';
		mostrarAviso(msgC);
		return false;
	} else {
		if(datos['Cpais'] == '129') {

			datos['Cestado'] = $('#slcEstado').val();
			if(datos['Cestado']== ''){
				msgC = ' Por favor seleccione el estado.';
				mostrarAviso(msgC);
				return false;
			}
			
			datos['CestadoN'] = $('#txtEstadoN').val().trim();
				
			datos['Cmunicipio'] = $('#slcMunicipio').val();
			
			if(datos['Cmunicipio']== ''){
				msgC = ' Por favor seleccione el municipio ';
				mostrarAviso(msgC);
				return false;
			}
			
			datos['CmunicipioN'] = $('#txtMunicipioN').val().trim();
			
			datos['Cciudad'] = $('#txtCiudad').val().trim();
			if(datos['Cciudad']== ''){
				msgC = ' Por favor agregue la ciudad.';
				mostrarAviso(msgC);
				return false;
			}
			
			datos['Ccolonia'] = $('#slcColonia').val();
			if(datos['Ccolonia']== ''){
				msgC = ' Por favor seleccione la colonia ';
				mostrarAviso(msgC);
				return false;
			}
			datos['CcoloniaN'] = $('#txtColoniaN').val().trim();
			
		} else {

			datos['Cestado'] = $('#txtEstado2').val().trim();
			if(datos['Cestado']== ''){
				msgC = ' Por favor agregue el estado.';
				mostrarAviso(msgC);
				return false;
			}
				datos['CestadoN'] = $('#txtEstado2').val().trim();
				
			datos['Cciudad'] = $('#txtCiudad2').val().trim();
			if(datos['Cciudad']== ''){
				msgC = ' Por favor agregue la ciudad.';
				mostrarAviso(msgC);
				return false;
			}
			datos['CciudadN'] = $('#txtCiudad2').val().trim();
		}
	}
	
	datos['Ccodigo'] = $('#txtCP').val().trim();
	if(datos['Ccodigo']== ''){
		msgC = ' Por favor agregue el c&oacute;digo postal.';
		mostrarAviso(msgC);
		return false;
	}
	
	datos['Ccalle'] = $('#txtCalle').val().trim();
	if(datos['Ccalle']== ''){
		msgC = ' Por favor agregue la calle.';
		mostrarAviso(msgC);
		return false;
	}
	
	datos['Cnumext'] = $('#txtExt').val().trim();
	if(datos['Cnumext']== ''){
		msgC = ' Por favor agregue el n&uacute;mero exterior.';
	mostrarAviso(msgC);
	return false;
	}
	
	datos['Ctelefono'] = $('#txtTel').val().trim();
	if(datos['Ctelefono']== ''){
		msgC = ' Por favor agregue el tel&eacute;fono.';
		mostrarAviso(msgC);
		return false;
	}else {
		if(datos['Ctelefono'].length<10){
			msgC = ' El tel&eacute;fono es inv&aacute;lido.';
			mostrarAviso(msgC);
			return false;
		}
	}
		
	datos['Fempresa'] = $('#txtFEmpresa').val().trim();
	if(datos['Fempresa']== ''){
			msgF = ' Por favor agregue la empresa.';
			mostrarAviso(msgF);
			return false;
		}

	if(!$("#chckFact").is(':checked')){
		datos['Fnombre'] = $('#txtFNombres').val().trim();
		if(datos['Fnombre']== ''){
			msgF = ' Por favor agregue el nombre.';
			mostrarAviso(msgF);
			return false;
		}
		
		datos['Fapaterno'] = $('#txtFPaterno').val().trim();
		if(datos['Fapaterno']== ''){
			msgF = ' Por favor agregue el apellido paterno.';
			mostrarAviso(msgF);
			return false;
		}
		
		datos['Famaterno'] = $('#txtFMaterno').val().trim();
		if(datos['Famaterno']== ''){
			msgF = ' Por favor agregue el apellido materno.';
			mostrarAviso(msgF);
			return false;
		}
		
		datos['Fcorreo'] = $('#txtFEmail').val().trim();
		if(datos['Fcorreo']== ''){
			msgF = ' Por favor agregue el correo electr&oacute;nico.';
			mostrarAviso(msgF);
			return false;
		}
	
		datos['Frazon'] = $('#txtFRazon').val().trim();
		if(datos['Frazon']== ''){
			msgF = ' Por favor agregue la raz&oacute;n social.';
			mostrarAviso(msgF);
			return false;
		}
		
		datos['Fpais'] = $('#slcFPais').val();
		if(datos['Fpais']== '') {
			msgF = ' Por favor seleccione un pa&iacute;s ';
			mostrarAviso(msgF);
			return false;
		} else {
			if(datos['Fpais'] == '129') {

				datos['Festado'] = $('#slcFEstado').val(); 
				if(datos['Festado']== ''){
					msgF = ' Por favor seleccione el estado.';
					mostrarAviso(msgF);
					return false;
				}
					datos['FestadoN'] = $('#txtFEstadoN').val().trim();
					
				datos['Fmunicipio'] = $('#slcFMunicipio').val();
				if(datos['Fmunicipio']== ''){
					msgF = ' Por favor seleccione el municipio ';
					mostrarAviso(msgF);
					return false;
				}
					datos['FmunicipioN'] = $('#txtFMunicipioN').val().trim();
						
				datos['Fciudad'] = $('#txtFCiudad').val().trim(); 
				if(datos['Fciudad']== ''){
					msgF = ' Por favor agregue la ciudad.';
					mostrarAviso(msgF);
					return false;
				}
				
				datos['Fcolonia'] = $('#slcFColonia').val();
				if(datos['Fcolonia']== ''){
					msgF = ' Por favor seleccione la colonia ';
					mostrarAviso(msgF);
					return false;
				}
					datos['FcoloniaN'] = $('#txtFColoniaN').val().trim();
			} else {

				datos['Festado'] = $('#txtFEstado2').val().trim();
				if(datos['Festado']== ''){
					msgF = ' Por favor agregue el estado.';
					mostrarAviso(msgF);
					return false;
				}
				datos['FestadoN'] = $('#txtFEstado2').val().trim();
				
				datos['Fciudad'] = $('#txtFCiudad2').val().trim();
				if(datos['Fciudad']== ''){
					msgF = ' Por favor agregue la ciudad.';
					mostrarAviso(msgF);
					return false;
				}
				
				datos['FciudadN'] = $('#txtFCiudad2').val().trim();
			}
		}
		datos['Fcodigo'] = $('#txtFCP').val().trim();
		if(datos['Fcodigo']== ''){
			msgF = ' Por favor agregue el c&oacute;digo postal.';
			mostrarAviso(msgF);
			return false;
		}
		
		datos['Fcalle'] = $('#txtFCalle').val().trim();
		if(datos['Fcalle']== ''){
			msgF = ' Por favor agregue la calle.';
			mostrarAviso(msgF);
			return false;
		}
		
		datos['Fnumext'] = $('#txtFExt').val().trim();
		if(datos['Fnumext']== ''){
			msgF = ' Por favor agregue el n&uacute;mero exterior.';
			mostrarAviso(msgF);
			return false;
		}

		datos['Ftelefono'] = $('#txtFTel').val().trim();
		if(datos['Ftelefono']== ''){
			msgF = ' Por favor agregue el tel&eacute;fono.';
			mostrarAviso(msgF);
			return false;
		}else {
			if(datos['Ftelefono'].length<10){
				msgF = ' El tel&eacute;fono es inv&aacute;lido.';
				mostrarAviso(msgF);
				return false;
			}
			}
			
		datosFact = false;
	} else {
		// --------
		datos['Fnombre'] = $('#txtNombres').val().trim();
		datos['Fapaterno'] = $('#txtPaterno').val().trim();
		datos['Famaterno'] = $('#txtMaterno').val().trim();
		datos['Fcorreo'] = $('#txtEmail').val().trim();
		datos['Frazon'] = $('#txtRazon').val().trim();
		datos['Fpais'] = $('#slcPais').val();
			if(datos['Fpais'] == '129') {
				datos['Festado'] = $('#slcEstado').val();
				datos['Fmunicipio'] = $('#slcMunicipio').val();
				datos['Fciudad'] = $('#txtCiudad').val().trim();
				datos['Fcolonia'] = $('#slcColonia').val();
			} else {

				datos['Festado'] = $('#txtEstado2').val().trim();
				datos['Fciudad'] = $('#txtCiudad2').val().trim();
			}
			datos['FestadoN']= datos['CestadoN'];
			datos['FmunicipioN'] = datos['CmunicipioN'];
			datos['FcoloniaN'] = datos['CcoloniaN'];
			
		datos['Fcodigo'] = $('#txtCP').val().trim();
		datos['Fcalle'] = $('#txtCalle').val().trim();
		datos['Fnumext'] = $('#txtExt').val().trim();
		datos['Fnumint'] = $('#txtInt').val().trim();
		datos['Ftelefono'] = $('#txtTel').val().trim();
		datos['Fextension'] = $('#txtExtension').val().trim();
		
	}
	
	datos['Frfc'] = $('#txtFRFC').val().trim();
	if(datos['Frfc']== ''){
		msgF = ' Por favor agregue el RFC.';
	mostrarAviso(msgF);
	return false;
	}
	else{
	var r;	
		$.ajax(
		         {
		         	method:"post",
		 					url: "admincuentas.php",  					
		 					data: 
		 					{  		
		             RFC : datos['Frfc']                
		 					},
		 					success: function(data) 
		 					{
		 					if(!data){
		 						msgF = ' El RFC es inv&aacute;lido.';
		 						mostrarError(msgF);
		 						return false;
		 						}
		 	   		}
				    });
	}

	datos['UserName'] = $('#txtUserName').val().trim();
	if(datos['UserName']== ''){
		msgU = ' Por favor agregue el username.';
		mostrarAviso(msgU);
		return false;
	}
	
	if($('#bol_user').val()=='false'){
			msgU = ' Por favor compruebe el username.';
			mostrarAviso(msgU);
			return false;
		}
	
	datos['Fplan'] = $('#slcFPlan').val().trim();
	if(datos['Fplan']== ''){
		msgCo = ' Por favor agregue el plan.';
		mostrarAviso(msgCo);
		return false;
	}
	
	datos['Cruta'] = $('#slcRuta').val().trim();
	if(datos['Cruta']== ''){
		msgCo = ' Por favor seleccione la ruta ';
		mostrarAviso(msgCo);
		return false;
	}
	
	datos['Cestatus'] = $('#slcEstatus').val().trim();
	if(datos['Cestatus']== ''){
		msgCo = ' Por favor seleccione el estatus.';
		mostrarAviso(msgCo);
		return false;
	}
		datos['CidiomaCRM'] = $('#slcIdiomaCRM').val().trim();
		if(datos['CidiomaCRM']== ''){
			msgU = ' Por favor seleccione el idioma CRM.';
			mostrarAviso(msgU);
			return false;
		}
			datos['CidiomaFact'] = $('#slcIdiomaFac').val().trim();
			if(datos['CidiomaFact']== ''){
				msgU = ' Por favor seleccione el idioma de factura.';
				mostrarAviso(msgU);
				return false;
			}
	datos['CmonedaN'] = $('#txtMonedaN').val().trim();
	mostrarEspera('Enviando informaci&oacute;n');
	xajax_agregarUsuario(datos);
	return false;
	}
 