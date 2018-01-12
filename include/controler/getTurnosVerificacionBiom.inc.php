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
				$filtros .= " AND estatus LIKE '".$valor."%' ";
			}else if($clave==2)
			{
				$filtros .= " AND fecha LIKE '".$valor."%' ";
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
					$ordenar = ' ORDER BY estatus ASC ';
				}
				else
				{
					$ordenar = ' ORDER BY estatus DESC ';
				}
			}
			else if($clave==3)
			{
				if($valor==0)
				{
					$ordenar = ' ORDER BY fecha ASC ';
				}
				else
				{
					$ordenar = ' ORDER BY fecha DESC ';
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
  
   $query="SELECT idVerificacionBiografica, idTurno, if(estatus='no_valido', 'No v&aacute;lido', 'V&aacute;lido') as estatus, entrada, fecha from verificacion_biografica 
   		where verificacion='pendiente' AND fecha BETWEEN '" . $fechaInicial . "' AND '". $fechaFin."' ".$filtros." 
  			  ".$ordenar." LIMIT $inicial, $tamano";
     	
  
    
///echo $query;
  mysqli_query($dbLink,"SET NAMES 'utf8'");// solucion en linux
  $result=mysqli_query($dbLink,$query);
	if(!$result)
		die("Ocurrio un error en la consulta. ".$query);

	while($row = $result->fetch_array(MYSQL_ASSOC)) {
    $arreglo_filas[] = $row;
  }

  if(isset($arreglo_filas))
  {
      $query="SELECT COUNT(*) AS total  from verificacion_biografica 
   		where verificacion='pendiente' AND fecha BETWEEN '" . $fechaInicial . "' AND '". $fechaFin."'
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
