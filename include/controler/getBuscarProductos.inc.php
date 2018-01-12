<?php

	#----------------------------------------------------------------------------------------------------------------------#
	#-------------------------------------------------------Includes-------------------------------------------------------#
	#----------------------------------------------------------------------------------------------------------------------#

	#----------------------------------------------------------------------------------------------------------------------#
	#-------------------------------------------------------Funciones------------------------------------------------------#
	#----------------------------------------------------------------------------------------------------------------------#

  function armar_filtros()
  {
    $filtros = '';
    if(isset($_GET['filter']) && $_GET['filter']!='')
    {
      foreach ($_GET['filter'] as $clave => $valor)
      {
        if($clave==0)
        {
          if($filtros=='')
          {
            $filtros .= " where  codigo  LIKE '".$valor."%' ";
          }
          else
          {
            $filtros .= " AND codigo  LIKE '".$valor."%' ";
          }
        }
        else if($clave==1)
        {
          if($filtros=='')
          {
            $filtros .= " where nombre  LIKE '".$valor."%' ";
          }
          else
          {
            $filtros .= " AND nombre LIKE '".$valor."%' ";
          }
        }
        else if($clave==2)
        {
          if($filtros=='')
          {
            $filtros .= " where precioVenta LIKE '".$valor."%' ";
          }
          else
          {
            $filtros .= " AND precioVenta LIKE '".$valor."%' ";
          }
        }
        else if($clave==3)
        {
          if($filtros=='')
          {
            $filtros .= " where comisionMaxima LIKE '".$valor."%' ";
          }
          else
          {
            $filtros .= " AND comisionMaxima  LIKE '".$valor."%' ";
          }
        }
        else if($clave==4)
        {
          if($filtros=='')
          {
            $filtros .= " where unidadesDisponibles LIKE '".$valor."%' ";
          }
          else
          {
            $filtros .= " AND unidadesDisponibles comisionMaxima LIKE '".$valor."%' ";
          }
        }
       
      }
    }
    return $filtros;
  }

  function ordenar()
  {
    $ordenar = '';
    if(isset($_GET['col']) && $_GET['col']!='')
    {
      foreach ($_GET['col'] as $clave => $valor)
      {
        if($clave==0)
        {
          if($valor==0)
          {
            $ordenar = ' ORDER BY codigo  ASC ';
          }
          else
          {
            $ordenar = ' ORDER BY codigo DESC ';
          }
        }
        else if($clave==1)
        {
          if($valor==0)
          {
            $ordenar = ' ORDER BY nombre ASC ';
          }
          else
          {
            $ordenar = ' ORDER BY nombre DESC ';
          }
        }
        else if($clave==2)
        {
          if($valor==0)
          {
            $ordenar = ' ORDER BY precioVenta ASC ';
          }
          else
          {
            $ordenar = ' ORDER BY precioVenta DESC ';
          }
        }
        else if($clave==3)
        {
          if($valor==0)
          {
            $ordenar = ' ORDER BY comisionMaxima ASC ';
          }
          else
          {
            $ordenar = ' ORDER BY comisionMaxima DESC ';
          }
        }
        else if($clave==4)
        {
          if($valor==0)
          {
            $ordenar = ' ORDER BY unidadesDisponibles  ASC ';
          }
          else
          {
            $ordenar = ' ORDER BY unidadesDisponibles  DESC ';
          }
        }
        
      }
    }
    return $ordenar;
  }

	#----------------------------------------------------------------------------------------------------------------------#
	#-----------------------------------------------------Seccion AJAX-----------------------------------------------------#
	#----------------------------------------------------------------------------------------------------------------------#
  //$xajax=new xajax();
  $xajax=new xajax();
  
  require LIB_REVISAR_PENDIENTES_XAJAX;
  
  function buscar($nombre,$numSerie,$estatus,$codigo,$tipo,$existencias)
  {
  	$r=new xajaxResponse();
//   	  $pagina =  $_GET["page"];
//   	  $tamano =  $_GET["size"];
//   	  $filtros="";
//   	  $ordenar="";
//   	  $filtros = armar_filtros();
//   	  $ordenar = ordenar();
  	global $dbLink;
  	$filtros ="";
  	   	  $pagina =  0;
  	  	  $tamano =  50;
  	  $inicial = (($pagina) * $tamano);
      mysqli_query($dbLink,"SET NAMES 'utf8'");
  	  if($filtros!='')
  		  {
  		    $query=" SELECT idproducto, nombre,foto,codigo, precioVenta, comisionMaxima, unidadesDisponibles FROM producto
  		          ".$filtros."
  		  			  ".$ordenar." LIMIT $inicial, $tamano";
  	
  	
  		  }
  	  else
  		  {
  		  $query="	SELECT idproducto, nombre,foto,codigo, precioVenta, comisionMaxima, unidadesDisponibles FROM producto
  		  	".$ordenar." LIMIT $inicial, $tamano";
  		  }
  	  echo $query;
  	  $result=mysqli_query($dbLink,$query);
  		if(!$result)
  				die("Ocurrio un error en la consulta de Llamadas.");
  	
  			while($row = $result->fetch_array(MYSQL_ASSOC)) {
  		    $arreglo_filas[] = $row;
  		  }
  	
  		  if(isset($arreglo_filas))
  			  {
  			    if($filtros!='')
  				    {
  				      $query="SELECT COUNT(*) AS total
  				  				FROM producto
  				            ".$filtros."";
  				    }
  			    else
  				    {
  				      $query="SELECT COUNT(*) AS total
  				    			FROM producto
  				      		";
  				    }
  			    $result=mysqli_query($dbLink,$query);
  			    if(!$result)
  				    	die("Ocurrio un error en la consulta de listado de Llamadas.");
  				    while($re=mysqli_fetch_assoc($result)){
  				    	$total = $re['total'];
  				    }
  				    $r->call();
  				    $r->call("cargar", json_encode(array($total, $arreglo_filas)));
  				  }
  		  else
  			  {
  			    $r->call("cargar", json_encode(''));
  			  }
  	  
  	
  	return $r;
  }
  $xajax->registerFunction("buscar");
  $xajax->processRequest();

	#----------------------------------------------------------------------------------------------------------------------#
	#---------------------------------------------Procesamiento de formulario----------------------------------------------#
	#----------------------------------------------------------------------------------------------------------------------#




	#----------------------------------------------------------------------------------------------------------------------#
	#---------------------------------------------Inicializacion de variables----------------------------------------------#
	#----------------------------------------------------------------------------------------------------------------------#
 if(isset($_POST)){
//  	$txtFechaInicio=$_POST['txtFechaInicio'];
  $nombre=$_POST['nombre'];
  $numSerie=$_POST['numSerie'];  
  $codigo=$_POST['codigo'];
  
  $estatus=$_POST['estatus'];
  $tipo=$_POST['tipo'];
  $existencias=$_POST['existencias'];
  
  $pagina =  $_GET["page"];
  $tamano =  $_GET["size"];
  
  $filtros="";
  $ordenar="";
  $filtros = armar_filtros();
  $ordenar = ordenar();
  
  if ($nombre!=""){
  	if($filtros==""){
  		$filtros.=" where nombre LIKE  '". $nombre."%'";
  	}else{
  		$filtros.=" and nombre LIKE '". $nombre."%'";
  	}
  }
  
  if ($numSerie!=""){
  	if($filtros==""){
  		$filtros.=" where numeroSerie LIKE '". $numSerie."%'";
  	}else {
  		$filtros.=" and numeroSerie LIKE '". $numSerie."%'";
  	}
  }
  if ($codigo!=""){
  	if($filtros==""){
  		$filtros.=" where numeroSerie LIKE '". $codigo."%'";
  	}else{
  		$filtros.=" and numeroSerie LIKE '". $codigo."%'";
  	}
  }
  ////////////
  if ($estatus!=""){
  	if($filtros==""){
  		$filtros.=" where estatus = '". $estatus."'";
  	}else{
  		$filtros.=" and estatus =  '". $estatus."'";
  	}
  }
  
  if ($tipo!=""){
  	if($filtros==""){
  		$filtros.=" where tipo = '". $tipo."'";
  	}else {
  		$filtros.=" and tipo = '". $tipo."'";
  	}
  }
  if ($existencias=="si"){
  	if($filtros==""){
  		$filtros.=" where unidadesDisponibles > 0 " ;
  	}else{
  		$filtros.=" and unidadesDisponibles > 0 ";
  	}
  }
  
  
  $inicial = (($pagina) * $tamano);
  if($filtros!='')
  {//Código, foto, nombre, existencia, estatus, MAC*, opciones (ver detalle)
  	$query=" SELECT idproducto, nombre,foto,codigo, precioVenta, comisionMaxima, unidadesDisponibles, estatus, numeroSerie, tipo FROM producto 
  			 
          ".$filtros."
  			  ".$ordenar." LIMIT $inicial, $tamano";
  
  
  }
  else
  {
  	$query="	SELECT idproducto, nombre,foto, codigo, precioVenta, comisionMaxima, unidadesDisponibles, estatus, numeroSerie, tipo FROM producto
  	".$ordenar." LIMIT $inicial, $tamano";
  }
  //echo $query;
  mysqli_query($dbLink,"SET NAMES 'utf8'");// solucion en linux
  $result=mysqli_query($dbLink,$query);
  if(!$result)
  	die("Ocurrio un error en la consulta de Llamadas.");
  
  	while($row = $result->fetch_array(MYSQL_ASSOC)) {
  		$arreglo_filas[] = $row;
  	}
  
  	if(isset($arreglo_filas))
  	{
  		if($filtros!='')
  		{
  			$query="SELECT COUNT(*) AS total
  				FROM producto
            ".$filtros."";
  		}
  		else
  		{
  			$query="SELECT COUNT(*) AS total
    			FROM producto
      		";
  		}
  		$result=mysqli_query($dbLink,$query);
  		if(!$result)
  			die("Ocurrio un error en la consulta de listado de Llamadas.");
  			while($r=mysqli_fetch_assoc($result)){
  				$total = $r['total'];
  			}
  			echo json_encode(array($total, $arreglo_filas));
  	}
  	else
  	{
  		echo json_encode('');
  	}
  
  }else{
			echo json_encode('');
}  	
	#----------------------------------------------------------------------------------------------------------------------#
	#-------------------------------------------------Salida de Javascript-------------------------------------------------#
	#----------------------------------------------------------------------------------------------------------------------#
