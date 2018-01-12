<?php
	require_once FOLDER_MODEL . "extend/model.rol.inc.php";
  require_once FOLDER_MODEL . "extend/model.rol_permisos.inc.php";
	require 'admincuentas.php';
	#----------------------------------------------------------------------------------------------------------------------#
	#-------------------------------------------------------Includes-------------------------------------------------------#
	#----------------------------------------------------------------------------------------------------------------------#

	#----------------------------------------------------------------------------------------------------------------------#
	#-------------------------------------------------------Funciones------------------------------------------------------#
	#----------------------------------------------------------------------------------------------------------------------#


  
  #----------------------------------------------------------------------------------------------------------------------#
	#-----------------------------------------------------Seccion AJAX-----------------------------------------------------#
	#----------------------------------------------------------------------------------------------------------------------#
  //$xajax=new xajax();
  $xajax=new xajax();
  
  function actualizar($idRol,
    					$txtNombre,
    					$turnos,
              $verificacion,
              $modulo1,
              $modulo2,
              $modulo3,
              $reportes,
              $usuarios,
              $roles,
              $recaudaciones,
              $reglas,
              $descuentos,
              $soporte,              
              $estatus)
  {
  	global $_NOW_;
  	global $objSession;
  	global $dbLink;
  	
  	$r=new xajaxResponse();
  	//register 
  	$rol = new ModeloRol();
  	$rol->transaccionIniciar();
    $rol->setId_rol($idRol);
    $rol->setNombre($txtNombre);
    $rol->setEstatusActivo();  
  	$rol->guardar();
  	if($rol->getStrError()){
  		$r->mostrarError("Ha ocurrido un error, intente más tarde. ".$rol->getStrError());
  		return $r;
  	}
  	$rol->transaccionCommit();
    
  	$query = "DELETE FROM rol_permisos WHERE id_rol = '".$idRol."'";
  	$result = mysqli_query ( $dbLink, $query );

  	$rolPermisos = new ModeloRol_permisos();
  	$rolPermisos->transaccionIniciar();
    $rolPermisos->setId_rol($rol->getId_rol());
    $rolPermisos->setPermisos($turnos);
    $rolPermisos->setMenu('turnos');   
  	$rolPermisos->guardar();
    
  	$rolPermisos = new ModeloRol_permisos();
  	$rolPermisos->transaccionIniciar();
    $rolPermisos->setId_rol($rol->getId_rol());
    $rolPermisos->setPermisos($verificacion);
    $rolPermisos->setMenu('verificacion');   
  	$rolPermisos->guardar();    
    
  	$rolPermisos = new ModeloRol_permisos();
  	$rolPermisos->transaccionIniciar();
    $rolPermisos->setId_rol($rol->getId_rol());
    $rolPermisos->setPermisos($modulo1);
    $rolPermisos->setMenu('modulo1');   
  	$rolPermisos->guardar();    
    
  	$rolPermisos = new ModeloRol_permisos();
  	$rolPermisos->transaccionIniciar();
    $rolPermisos->setId_rol($rol->getId_rol());
    $rolPermisos->setPermisos($modulo2);
    $rolPermisos->setMenu('modulo2');   
  	$rolPermisos->guardar();    
    
  	$rolPermisos = new ModeloRol_permisos();
  	$rolPermisos->transaccionIniciar();
    $rolPermisos->setId_rol($rol->getId_rol());
    $rolPermisos->setPermisos($modulo3);
    $rolPermisos->setMenu('modulo3');   
  	$rolPermisos->guardar();    
    
  	$rolPermisos = new ModeloRol_permisos();
  	$rolPermisos->transaccionIniciar();
    $rolPermisos->setId_rol($rol->getId_rol());
    $rolPermisos->setPermisos($reportes);
    $rolPermisos->setMenu('reportes');   
  	$rolPermisos->guardar();    
    
  	$rolPermisos = new ModeloRol_permisos();
  	$rolPermisos->transaccionIniciar();
    $rolPermisos->setId_rol($rol->getId_rol());
    $rolPermisos->setPermisos($usuarios);
    $rolPermisos->setMenu('usuarios');   
  	$rolPermisos->guardar();    
    
  	$rolPermisos = new ModeloRol_permisos();
  	$rolPermisos->transaccionIniciar();
    $rolPermisos->setId_rol($rol->getId_rol());
    $rolPermisos->setPermisos($roles);
    $rolPermisos->setMenu('roles');   
  	$rolPermisos->guardar();
    
  	$rolPermisos = new ModeloRol_permisos();
  	$rolPermisos->transaccionIniciar();
    $rolPermisos->setId_rol($rol->getId_rol());
    $rolPermisos->setPermisos($recaudaciones);
    $rolPermisos->setMenu('recaudacion');   
  	$rolPermisos->guardar();           
    
  	$rolPermisos = new ModeloRol_permisos();
  	$rolPermisos->transaccionIniciar();
    $rolPermisos->setId_rol($rol->getId_rol());
    $rolPermisos->setPermisos($reglas);
    $rolPermisos->setMenu('reglas');   
  	$rolPermisos->guardar();    
                            
  	$rolPermisos = new ModeloRol_permisos();
  	$rolPermisos->transaccionIniciar();
    $rolPermisos->setId_rol($rol->getId_rol());
    $rolPermisos->setPermisos($descuentos);
    $rolPermisos->setMenu('descuentos');   
  	$rolPermisos->guardar();    
                           
  	$rolPermisos = new ModeloRol_permisos();
  	$rolPermisos->transaccionIniciar();
    $rolPermisos->setId_rol($rol->getId_rol());
    $rolPermisos->setPermisos($soporte);
    $rolPermisos->setMenu('soporte');   
  	$rolPermisos->guardar();    
                                                      
  	if($rolPermisos->getStrError()){
  		$r->mostrarError("Ha ocurrido un error, intente más tarde. ".$rolPermisos->getStrError());
  		return $r;
  	}
  	$rolPermisos->transaccionCommit();    
  	$r->mostrarAviso("La informaci&aacute;n se almaceno correctamente.");
  	$r->redirect("listadoRoles.php",1);
  	return $r;
  
  }
  $xajax->registerFunction("actualizar");
  
  $xajax->processRequest();

	#----------------------------------------------------------------------------------------------------------------------#
	#---------------------------------------------Procesamiento de formulario----------------------------------------------#
	#----------------------------------------------------------------------------------------------------------------------#




	#----------------------------------------------------------------------------------------------------------------------#
	#---------------------------------------------Inicializacion de variables----------------------------------------------#
	#----------------------------------------------------------------------------------------------------------------------#

	#----------------------------------------------------------------------------------------------------------------------#
	#-------------------------------------------------Salida de Javascript-------------------------------------------------#
	#----------------------------------------------------------------------------------------------------------------------#

 