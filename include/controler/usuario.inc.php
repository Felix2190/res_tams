<?php
	require_once FOLDER_MODEL . "extend/model.login_user.inc.php";
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
  
  function guardar($idUsuario,
              $txtNombre,
    					$txtApellidos,
    					$txtUsuario,
    					$txtEmail,
    					$txtContrasena,
    					$slcRecaudacion,
    					$slcRol,
              $estatus)
  {
  	global $_NOW_;
  	global $objSession;
  	global $dbLink;
  	
  	$r=new xajaxResponse();
  	//register     
  	$usuario = new ModeloLogin_user();
  	$usuario->transaccionIniciar();
    $usuario->setId_login($idUsuario);
    if($txtUsuario!=$usuario->getUser_name()){
      if($usuario->verificarUserName($txtUsuario)){
        $r->mostrarError("Usuario existente.");
    		return $r;
      }
    }
    $usuario->setFirst_name($txtNombre);
    $usuario->setLast_name($txtApellidos);
  	$usuario->setUser_name($txtUsuario);                          
    if($txtContrasena!=''){
    	$random_salt = hash('sha512', uniqid(mt_rand(1, mt_getrandmax()), true));
    	$passwordSalt = hash('sha512', $txtContrasena. $random_salt);
      $usuario->setPassword($passwordSalt);
      $usuario->setSalt($random_salt);
    }
    $usuario->setId_rol($slcRol);
    $usuario->setId_recaudacion($slcRecaudacion);
    $usuario->setEmail($txtEmail);
    $usuario->setEstatusActivo();  
  	$usuario->guardar();
  	if($usuario->getStrError()){
  		$r->mostrarError("Ha ocurrido un error, intente más tarde. ".$usuario->getStrError());
  		return $r;
  	}
  
  	$usuario->transaccionCommit();
  	$r->mostrarAviso("La informaci&oacute;n se almaceno correctamente.");
  	$r->redirect("listadoUsuarios.php",1);
  	return $r;
  
  }
  $xajax->registerFunction("guardar");
  
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

 