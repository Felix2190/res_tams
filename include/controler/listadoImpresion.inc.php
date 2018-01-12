<?php

	#-----------------------------------------------------------------------------------------------------------------#
	#---------------------------------------Archivos necesarios Require Include---------------------------------------#
	#-----------------------------------------------------------------------------------------------------------------#

require_once FOLDER_MODEL_EXTEND . "model.turno.inc.php";
require_once FOLDER_MODEL_EXTEND . "model.persona.inc.php";
require_once FOLDER_MODEL_EXTEND . "model.tipolicencia.inc.php";
require_once FOLDER_MODEL_EXTEND . "model.ubicacion.inc.php";
require_once FOLDER_MODEL_EXTEND . "model.impresion.inc.php";
require_once FOLDER_MODEL_EXTEND . "model.licencia.inc.php";

	#-----------------------------------------------------------------------------------------------------------------#
	#--------------------------------------------Inicializacion de control--------------------------------------------#
	#-----------------------------------------------------------------------------------------------------------------#



	#-----------------------------------------------------------------------------------------------------------------#
	#-----------------------------------------------------------------------------------------------------------------#

	#-----------------------------------------------------------------------------------------------------------------#
	#----------------------------------------------------Funciones----------------------------------------------------#
	#-----------------------------------------------------------------------------------------------------------------#
    function insertImpresion($idTurno,$ip)
    {
                
        $objImpresion = new ModeloImpresion();
        $objImpresion->setIdTurno($idTurno);
        $objImpresion->setEstatusImprimir();
        $objImpresion->setIP($ip);
        $objImpresion->setNombreEquipo(gethostbyaddr($ip));
        $objImpresion->setFechaHora(date('Y-m-d H:i:s'));
        if(!$objImpresion->Guardar())
        {    //return '';
         if($objImpresion->getError())
            return $objImpresion->getStrError();
         }
         else{   
            //return '';
           /*$objTurno = new ModeloTurno();
           $objTurno->setIdTurno($idTurno);     
           $objLicencia = new ModeloLicencia();
           $objLicencia->setIdPersona($objTurno->getIdPersona());
           $objLicencia->setIdTipoLicencia($objTurno->getIdTipoLicencia());
           $objLicencia->setIdUbicacion($objTurno->getIdUbicacion());
           $objLicencia->setEstatusEnTramite();
           if(!$objLicencia->Guardar())
            { 
             if($objLicencia->getError())
                return $objLicencia->getStrError();    
             }
             else{
                
                $objLicencia->setNumero($objLicencia->calcularNumero());
                if(!$objLicencia->Guardar())
                { 
                 if($objLicencia->getError())
                    return $objLicencia->getStrError();    
                 }
                 else{
                    
                    $objTurno->setIdLicencias($objLicencia->getIdLicencias());
                    $objTurno->Guardar();
                 }
             }
             }*/
             }
         return '';
    }
    
    function get_client_ip() {
        $ipaddress = '';
        if (getenv('HTTP_CLIENT_IP'))
            $ipaddress = getenv('HTTP_CLIENT_IP');
        else if(getenv('HTTP_X_FORWARDED_FOR'))
            $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
        else if(getenv('HTTP_X_FORWARDED'))
            $ipaddress = getenv('HTTP_X_FORWARDED');
        else if(getenv('HTTP_FORWARDED_FOR'))
            $ipaddress = getenv('HTTP_FORWARDED_FOR');
        else if(getenv('HTTP_FORWARDED'))
           $ipaddress = getenv('HTTP_FORWARDED');
        else if(getenv('REMOTE_ADDR'))
            $ipaddress = getenv('REMOTE_ADDR');
        else
            $ipaddress = 'UNKNOWN';
        return $ipaddress;
    }
    
    function getDatos()
    {
        $idEtapa = 11;//Etapa de  Impresion
    
        $objTurno = new ModeloTurno();
        $arrDatos=$objTurno->getListadoExamenes($idEtapa);
        
        
    	if (count($arrDatos)>0){
        	foreach ($arrDatos as $dato){
        	   $objTurno = $dato['turno'];
        	   $objPersona = new ModeloPersona();
               $objPersona = $dato['persona'];
               $objTipoLicencia = new ModeloTipolicencia();
               $objTipoLicencia = $dato['tipoLicencia'];
               $objUbicacion = new ModeloUbicacion();
               $objUbicacion = $dato['ubicacion'];
               
               $opciones='<a href="javascript:imprimir('.$objTurno->getIdTurno().');"class="btn btn-default" name="btnExamen"><i class="fa fa-print" title="Imprimir Licencia"></i></a>';
               
                $listado .= '<tr>
        						<td>'.$objPersona->getIdPersona().'</td>
        						<td>'.utf8_encode($objPersona->getNombres()).'</td>
        						<td>'.utf8_encode($objPersona->getPrimerAp().' '.$objPersona->getSegundoAp()).'</td>
                                <td>'.$objUbicacion->getNombre().'</td>
                                <td>'.$objTipoLicencia->getDescripcion().'</td>
                                <td>'.$objTipoLicencia->getTipoTramite().'</td>
                                <td>'.$objTipoLicencia->getPeriodo().'</td>
        						<td>'.$opciones.'</td>
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
    					<td>&nbsp;</td>
    		              <td>&nbsp;</td>
    				</tr>';
    	
    	}
        return $listado;
    }
    
    function getTabla()
    {
        $tabla = '<table class="table" id="tablesorting-1">
											<thead>
												<tr>
													<th >Id Persona</th>
													<th>Nombre(s)</th>
													<th>Apellidos</th>
													<th>Ubicaci&oacute;n</th>
													<th>Tipo Licencia</th>
                                                    <th>Tipo Tr&aacute;mite</th>
                                                    <th>Periodo (meses)</th>
													<th>Opciones</th>
												</tr>
											</thead>
											<tbody>'
                                                .getDatos().'
											</tbody>
											<tfoot>
												<tr>
													<td colspan="8" class="pager form-horizontal">
														<button class="btn first"><i class="fa fa-step-backward"></i></button>
														<button class="btn prev"><i class="fa fa-arrow-left"></i></button>
														<span class="pagedisplay"></span> <!-- this can be any element, including an input -->
														<button class="btn next"><i class="fa fa-arrow-right"></i></button>
														<button class="btn last"><i class="fa fa-step-forward"></i></button>
														<select class="pagesize input-xs" title="Select page size">
															<option value="10">10</option>
															<option value="20">20</option>
															<option value="30">30</option>
															<option selected="selected" value="40">40</option>
														</select>
														<select class="pagenum input-xs" title="Seleccione P&aacute;gina"></select>
													</td>
												</tr>
											</tfoot>
								</table>';
                                return $tabla;

    }

	#-----------------------------------------------------------------------------------------------------------------#
	#-----------------------------------------------------------------------------------------------------------------#


	#-----------------------------------------------------------------------------------------------------------------#
	#---------------------------------------------------Seccion AJAX--------------------------------------------------#
	#-----------------------------------------------------------------------------------------------------------------#

	$xajax=new xajax();
	

function imprimirLicencia($idTurno,$ip)
{
    $r = new xajaxResponse();
    $error =insertImpresion($idTurno,$ip);
    if(strlen($error))
        $r->mostrarError($error);
    else
        $r->mostrarAviso(utf8_encode('Solicitud de impresión procesada...'));
    
    $r->redirect('listadoImpresion.php',2);
    //echo $error;
  //  $r->call("styleTabla",getTabla());
    
    // $r->assign('divListado',"innerHTML",$error);
     //$r->assign('tablesorting-1', "class", "table");    
    return $r;
}
$xajax->registerFunction("imprimirLicencia");
$xajax->processRequest();
	#-----------------------------------------------------------------------------------------------------------------#
	#-----------------------------------------------------------------------------------------------------------------#

	#-----------------------------------------------------------------------------------------------------------------#
	#-------------------------------------------Inicializacion de variables-------------------------------------------#
	#-----------------------------------------------------------------------------------------------------------------#

    $tabla =getTabla();
    
    

    /*else {
    header("Location: examen.php");
    die();
}*/
