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
            $filtros .= " where costoOrigen  LIKE '".$valor."%' ";
          }
          else
          {
            $filtros .= " AND costoOrigen  LIKE '".$valor."%' ";
          }
        }
        else if($clave==3)
        {
          if($filtros=='')
          {
            $filtros .= " where costoFOBMXUS  LIKE '".$valor."%' ";
          }
          else
          {
            $filtros .= " AND costoFOBMXUS   LIKE '".$valor."%' ";
          }
        }
        else if($clave==4)
        {
          if($filtros=='')
          {
            $filtros .= " where CostoMXN LIKE '".$valor."%' ";
          }
          else
          {
            $filtros .= " AND CostoMXN  LIKE '".$valor."%' ";
          }
        }
        else if($clave==5)
        {
        	if($filtros=='')
        	{
        		$filtros .= " where precioVenta LIKE '".$valor."%' ";
        	}
        	else
        	{
        		$filtros .= " AND precioVenta  LIKE '".$valor."%' ";
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
            $ordenar = ' ORDER BY costoOrigen ASC ';
          }
          else
          {
            $ordenar = ' ORDER BY costoOrigen DESC ';
          }
        }
        else if($clave==3)
        {
          if($valor==0)
          {
            $ordenar = ' ORDER BY costoFOBMXUS ASC ';
          }
          else
          {
            $ordenar = ' ORDER BY costoFOBMXUS DESC ';
          }
        }
        else if($clave==4)
        {
          if($valor==0)
          {
            $ordenar = ' ORDER BY CostoMXN  ASC ';
          }
          else
          {
            $ordenar = ' ORDER BY CostoMXN  DESC ';
          }
        }
        else if($clave==5)
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
      }
    }
    return $ordenar;
  }

	#----------------------------------------------------------------------------------------------------------------------#
	#-----------------------------------------------------Seccion AJAX-----------------------------------------------------#
	#----------------------------------------------------------------------------------------------------------------------#


	#----------------------------------------------------------------------------------------------------------------------#
	#---------------------------------------------Procesamiento de formulario----------------------------------------------#
	#----------------------------------------------------------------------------------------------------------------------#




	#----------------------------------------------------------------------------------------------------------------------#
	#---------------------------------------------Inicializacion de variables----------------------------------------------#
	#----------------------------------------------------------------------------------------------------------------------#

  $pagina =  $_GET["page"];
  $tamano =  $_GET["size"];
  $filtros="";
  $ordenar="";
  $filtros = armar_filtros();
  $ordenar = ordenar();


  $inicial = (($pagina) * $tamano);
  if($filtros!='')
  {
    $query=" SELECT idproducto, nombre,codigo, costoOrigen, costoFOBMXUS, CostoMXN, precioVenta, comisionMaxima, unidadesDisponibles FROM producto
          ".$filtros."
  			  ".$ordenar." LIMIT $inicial, $tamano";
    
    
  }
  else
  {
  $query="	SELECT idproducto, nombre,codigo,  costoOrigen, costoFOBMXUS, CostoMXN, precioVenta, comisionMaxima, unidadesDisponibles FROM producto 
  	where estatus <> 'baja'  ".$ordenar." LIMIT $inicial, $tamano"; 	
  }
 //echo $query ;
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
    			FROM producto where estatus <> 'baja' 
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

	#----------------------------------------------------------------------------------------------------------------------#
	#-------------------------------------------------Salida de Javascript-------------------------------------------------#
	#----------------------------------------------------------------------------------------------------------------------#
