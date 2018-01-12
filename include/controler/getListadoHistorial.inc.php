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
            $filtros .= " where  ah.fechaAlta  LIKE '".$valor."%' ";
          }
          else
          {
            $filtros .= " AND ah.fechaAlta  LIKE '".$valor."%' ";
          }
        }
        else if($clave==1)
        {
          if($filtros=='')
          {
            $filtros .= " where ah.tipo  LIKE '".$valor."%' ";
          }
          else
          {
            $filtros .= " AND ah.tipo LIKE '".$valor."%' ";
          }
        }
        else if($clave==2)
        {
          if($filtros=='')
          {
            $filtros .= " where p.codigo LIKE '".$valor."%' ";
          }
          else
          {
            $filtros .= " AND p.codigo LIKE '".$valor."%' ";
          }
        }
        else if($clave==3)
        {
          if($filtros=='')
          {
            $filtros .= " where ah.numeroSerie LIKE '".$valor."%' ";
          }
          else
          {
            $filtros .= " AND ah.numeroSerie  LIKE '".$valor."%' ";
          }
        }
        else if($clave==4)
        {
          if($filtros=='')
          {
            $filtros .= " where ah.mac LIKE '".$valor."%' ";
          }
          else
          {
            $filtros .= " AND ah.mac  LIKE '".$valor."%' ";
          }
        }
        else if($clave==5)
        {
        	if($filtros=='')
        	{
        		$filtros .= " where u.nombre LIKE '".$valor."%' ";
        	}
        	else
        	{
        		$filtros .= " AND u.nombre  LIKE '".$valor."%' ";
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
            $ordenar = ' ORDER BY fechaAlta  ASC ';
          }
          else
          {
            $ordenar = ' ORDER BY fechaAlta DESC ';
          }
        }
        else if($clave==1)
        {
          if($valor==0)
          {
            $ordenar = ' ORDER BY tipo ASC ';
          }
          else
          {
            $ordenar = ' ORDER BY tipo DESC ';
          }
        }
        else if($clave==2)
        {
          if($valor==0)
          {
            $ordenar = ' ORDER BY codigo ASC ';
          }
          else
          {
            $ordenar = ' ORDER BY codigo DESC ';
          }
        }
        else if($clave==3)
        {
          if($valor==0)
          {
            $ordenar = ' ORDER BY numeroSerie ASC ';
          }
          else
          {
            $ordenar = ' ORDER BY numeroSerie DESC ';
          }
        }
        else if($clave==4)
        {
          if($valor==0)
          {
            $ordenar = ' ORDER BY mac  ASC ';
          }
          else
          {
            $ordenar = ' ORDER BY mac  DESC ';
          }
        }
        else if($clave==5)
        {
        	if($valor==0)
        	{
        		$ordenar = ' ORDER BY ubicacion  ASC ';
        	}
        	else
        	{
        		$ordenar = ' ORDER BY ubicacion  DESC ';
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
    $query=" SELECT  ah.fechaAlta, ah.tipo, ah.idProducto, ah.numeroSerie, ah.mac, ah.idUbicacion, p.codigo, u.nombre as ubicacion  
    		FROM almacenhistorial as ah
			left join producto p on p.idProducto = ah.idProducto 
			left join ubicacion u on u.idUbicacion = ah.idUbicacion
          ".$filtros."
  			  ".$ordenar." LIMIT $inicial, $tamano";
    
    
  }
  else
  {
  $query="	SELECT  ah.fechaAlta, ah.tipo, ah.idProducto, ah.numeroSerie, ah.mac, ah.idUbicacion, p.codigo, u.nombre as ubicacion  FROM almacenHistorial as ah
			left join producto p on p.idProducto = ah.idProducto 
			left join ubicacion u on u.idUbicacion = ah.idUbicacion 
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
  				FROM almacenHistorial as ah
			left join producto p on p.idProducto = ah.idProducto 
			left join ubicacion u on u.idUbicacion = ah.idUbicacion
            ".$filtros."";
    }
    else
    {
      $query="SELECT COUNT(*) AS total 		   			      		
      		FROM almacenHistorial as ah
			left join producto p on p.idProducto = ah.idProducto 
			left join ubicacion u on u.idUbicacion = ah.idUbicacion 
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
