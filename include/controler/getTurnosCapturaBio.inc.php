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
				$filtros .= " AND idTurno LIKE '".$valor."%' ";
			}else if($clave==1)
			{
				$filtros .= " AND turrnoExterno LIKE '".$valor."%' ";
			}else if($clave==2)
			{
				$filtros .= " AND (nombres LIKE '".$valor."%' or primerAp LIKE '".$valor."%' or segundoAp LIKE '".$valor."%' )";
			}
			else if($clave==3)
			{
				$filtros .= " AND fechaHora LIKE '".$valor."%' ";
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
					$ordenar = ' ORDER BY idTurno ASC ';
				}
				else
				{
					$ordenar = ' ORDER BY idTurno DESC ';
				}
			}
			else if($clave==1)
			{
				if($valor==0)
				{
					$ordenar = ' ORDER BY turnoExterno ASC ';
				}
				else
				{
					$ordenar = ' ORDER BY turnoExterno DESC ';
				}
			}else if($clave==2)
			{
				if($valor==0)
				{
					$ordenar = ' ORDER BY nombres ASC ';
				}
				else
				{
					$ordenar = ' ORDER BY nombres DESC ';
				}
			}else if($clave==3)
			{
				if($valor==0)
				{
					$ordenar = ' ORDER BY fechaHora ASC ';
				}
				else
				{
					$ordenar = ' ORDER BY fechaHora DESC ';
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
  $fechaInicial = date('Y-m-d') ." 00:00:00";
  $fechaFin = date('Y-m-d')." 23:59:59";
  

  $inicial = (($pagina) * $tamano);
  
   $query="SELECT t.idTurno,t.turnoExterno, concat_ws(' ', nombres, primerAp, segundoAp) as nombre,t.fechaHora FROM turno as t	
   		inner join persona as p on t.idPersona=p.idPersona
        WHERE  t.idUbicacion=" . $objSession->getIdUbicacion(). " AND t.idEtapa=6 
        		AND t.fechaHora BETWEEN '" . $fechaInicial . "' AND '". $fechaFin."' 
  			  ".$filtros." ".$ordenar." LIMIT $inicial, $tamano";
     	
  
    
/// echo $query;
  mysqli_query($dbLink,"SET NAMES 'utf8'");// solucion en linux
  $result=mysqli_query($dbLink,$query);
	if(!$result)
		die("Ocurrio un error en la consulta. ".$query);

	while($row = $result->fetch_array(MYSQL_ASSOC)) {
    $arreglo_filas[] = $row;
  }

  if(isset($arreglo_filas))
  {
      $query="SELECT count(*) as total FROM turno as t		
   		inner join persona as p on t.idPersona=p.idPersona
        WHERE  t.idUbicacion=" . $objSession->getIdUbicacion(). " AND t.idEtapa=6
        		AND t.fechaHora BETWEEN '" . $fechaInicial . "' AND '". $fechaFin."' 
  			  ".$filtros;
    
    $result=mysqli_query($dbLink,$query);
    if(!$result)
    	die("Ocurrio un error en la consulta ".$query);
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
