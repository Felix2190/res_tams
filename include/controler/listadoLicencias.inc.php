<?php

	#-----------------------------------------------------------------------------------------------------------------#
	#---------------------------------------Archivos necesarios Require Include---------------------------------------#
	#-----------------------------------------------------------------------------------------------------------------#

require 'adminLicencias.php';


	#-----------------------------------------------------------------------------------------------------------------#
	#--------------------------------------------Inicializacion de control--------------------------------------------#
	#-----------------------------------------------------------------------------------------------------------------#



	#-----------------------------------------------------------------------------------------------------------------#
	#-----------------------------------------------------------------------------------------------------------------#

	#-----------------------------------------------------------------------------------------------------------------#
	#----------------------------------------------------Funciones----------------------------------------------------#
	#-----------------------------------------------------------------------------------------------------------------#


	#-----------------------------------------------------------------------------------------------------------------#
	#-----------------------------------------------------------------------------------------------------------------#


	#-----------------------------------------------------------------------------------------------------------------#
	#---------------------------------------------------Seccion AJAX--------------------------------------------------#
	#-----------------------------------------------------------------------------------------------------------------#

	$xajax=new xajax();
	
//	require LIB_REVISAR_PENDIENTES_XAJAX;
	
	
	
function verLicencia($idLicencia)
	{
		$r=new xajaxResponse();
		$_SESSION['idLicencia']=$idLicencia;
		
		$r->redirect("verImpresionLicencia.php",2);
	
		return $r;
	
	}
	$xajax->registerFunction("verLicencia");
	

	//$xajax->processRequest();

function capturarHuella($idLicencia)
{
    	$r=new xajaxResponse();
		$_SESSION['idLicencia']=$idLicencia;
		
		$r->redirect("capturaHuellas.php",2);
	
		return $r;
	
    
}

$xajax->registerFunction("capturarHuella");

function aplicarExamen($idLicencia)
{
    	$r=new xajaxResponse();
      $r->mostrarEspera('Procesando solicitud...');
		$_SESSION['idLicencia']=$idLicencia;
		
		$r->redirect("examen.php",2);
	
		return $r;
	
    
}

$xajax->registerFunction("aplicarExamen");

		$xajax->processRequest();
	#-----------------------------------------------------------------------------------------------------------------#
	#-----------------------------------------------------------------------------------------------------------------#

	#-----------------------------------------------------------------------------------------------------------------#
	#-------------------------------------------Inicializacion de variables-------------------------------------------#
	#-----------------------------------------------------------------------------------------------------------------#
if(isset($_SESSION['idLicencia'])){unset($_SESSION['idLicencia']);}
	
    if($_GET['estatus']=='enTramite')
    {
	   $tipo = 'en tr&aacute;mite';
    }
    else if ($_GET['estatus']=='pagada')
    {
        $tipo = 'pagadas';
    }
	$arrTickets=obtenerLicencias($_GET['estatus']);
	if (count($arrTickets)>0){
	foreach ($arrTickets as $licencia){
	       
		if($_GET['estatus']=='pagada')
        {
            $opciones='<a href="javascript:abrirLicencia('.$licencia['idLicencia'].');"class="btn btn-default" name="btnPreview"><i class="fa fa-print" title="Imprimir Licencia"></i></a>';
        }
        else
        {
            $opciones='<a href="javascript:capturaHuella('.$licencia['idLicencia'].');"class="btn btn-default" name="btnCaptura"><i class="fa fa-hand-o-up" title="Capturar Huellas"></i></a>
                    <a href="javascript:aplicarExamen('.$licencia['idLicencia'].');"class="btn btn-default" name="btnExamen"><i class="fa fa-file-text-o" title="Aplicar examen"></i></a>						';
        }
		$listado .= '<tr>
						<td>'.$licencia['idLicencia'].'</td>
						<td>'.$licencia['numero'].'</td>
						<td>'.$licencia['nombres'].'</td>
						<td>'.$licencia['primerAp'].' '.$licencia['segundoAp'].'</td>
                        <td>'.$licencia['tipoLicencia'].'</td>
                        
						<td>
            		
                        '.$opciones.'
                    </td>
					</tr>';
		
	}
	}else {
		$listado .= '<tr>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					
          
				</tr>';
	
	}