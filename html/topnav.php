<?php
	$AccCurr = $objSession->getCurrencyName();
	if($AccCurr == 'MXN')
	{
		setlocale(LC_MONETARY, 'es_MX');
	}	
	else
	{
		setlocale(LC_MONETARY, 'en_US');
	}                     
?>
		<header id="header-main">
            	<div class="header-main-top">
	            		<div class="text-right"><strong>
	            		<?php
			            	require_once FOLDER_MODEL . "extend/model.turno.inc.php";
			            	global $objSession;    			                          	
			            	$ubicacion=new ModeloUbicacion();
			            	$ubicacion->setIdUbicacion($objSession->getIdUbicacion());
			            	echo $ubicacion->getNombre();
			            	?>&nbsp;</strong>
		            	</div>
						<div class="text-right" style="with:300px; float: right;">
							<strong>
							<?php
			            	require_once FOLDER_MODEL . "extend/model.turno.inc.php";
							$oturno=new ModeloTurno();
							$oturno->setIdTurno($_SESSION['turno']);
                         	
			            	
			            	echo "Atendiendo Turno: " . $oturno->getTurnoExterno();   ?>&nbsp;</strong>
							
							<button class="btn btn-success btn-xs" id="btnSiguiente" name="btnSiguiente"> Siguiente </button>
							<button class="btn btn-primary btn-xs" id="btnSaltar" name="btnSaltar"> Saltar </button>
		            	</div>
                    </div>
                	<div class="pull-left">
                    	<a href="dashboard.php" id="logo-small"><h4>Planet</h4> <h5>CRM</h5></a>
                    </div>
                    
                    <div class="pull-right saldoTopBlock">
                    	
                </div>

                <div class="header-main-bottom">
                	<div>
                    	<ul class="breadcrumb"> 
                    	
                    	<?php $__permisos=array("Inicio","licencias","turnos","reportes","Soporte","Ventas","reglas","impresion");?>
                            <li <?php if ($seccion=="inicio"){ echo 'class="active"'; }?>><a href="dashboard.php">Inicio</a></li>                                                                                                         
                    	
                    		<?php if(in_array("turnos", $__permisos)){?><li <?php if ($seccion=="turnos"){ echo 'class="active"'; }?> ><a href="generarTurnos.php">Proceso Licencias</a></li><?php } ?>
							<?php // if(in_array("licencias", $__permisos)):?> <!-- <li <?php // if ($seccion=="licencias"){ echo 'class="active"'; }?>><a href="biograficos.php">Licencias</a></li><?php // endif;?> -->
							<?php if(in_array("reportes", $__permisos)):?><li <?php if ($seccion=="reportes"){ echo 'class="active"'; }?>><a href="poa.php">Reportes</a></li><?php endif;?>							
							                                                                                                                                    
              				<?php                      
                        if($permisos_roles>0 || $permisos_reglas>0 || $permisos_descuentos>0 || $permisos_usuarios>0){   
                          if($permisos_reglas>0){                   
                            if(in_array("licencias", $__permisos)):?><li <?php if ($seccion=="licencias"){ echo 'class="active"'; }?>><a href="listadoReglasLicencia.php">Configuraci&oacute;n</a></li><?php endif;
                          }else if($permisos_roles>0){
                            if(in_array("licencias", $__permisos)):?><li <?php if ($seccion=="roles"){ echo 'class="active"'; }?>><a href="listadoRoles.php">Reglas</a></li><?php endif;
                          }else if($permisos_descuentos>0){
                            if(in_array("licencias", $__permisos)):?><li <?php if ($seccion=="descuentos"){ echo 'class="active"'; }?>><a href="listadoReglasDescuento.php">Reglas</a></li><?php endif;
                          }else if($permisos_usuarios>0){
                            if(in_array("licencias", $__permisos)):?><li <?php if ($seccion=="usuarios"){ echo 'class="active"'; }?>><a href="listadoUsuarios.php">Reglas</a></li><?php endif;
                          }                          
                        }                                            
                      ?>
							
							<?php if(in_array("Soporte", $__permisos)):?><li <?php if ($seccion=="soporte"){ echo 'class="active"'; }?>><a href="ticket.php">Soporte</a></li><?php endif;?>							                      
                        
                        <!-- End .breadcrumb -->
                        
                    </div>
                    
                    </ul> 
                </div>
            </header>