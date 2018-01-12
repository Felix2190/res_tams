    <div class="sidebar-module">
    	<nav class="sidebar-nav-v2">
    		<ul>
    			<li class="menu-open <?php if($modulo_activo == 1){ echo 'page-arrow active-page'; } ?>">
    				<a href="generarTurnos.php">
    				<i class="fa fa-ticket"></i> Turno
    				</a>
    
    			</li>
    
    			
    			<li class="menu-open <?php if($modulo_activo == 2){ echo 'page-arrow active-page'; } ?>">
    				<a href="#">
    				<i class="fa fa-money"></i> Pago
    				</a>
    	      <ul>
    					<li>
    						<a class="<?php if($pagina_activa == 'resumen'){ echo 'text-success'; } ?>" href="#">
    						Resumen
    						</a>
    					</li>
    					<li>
    						<a class="<?php if($pagina_activa == 'impresion_pago'){ echo 'text-success'; } ?>" href="#">
    						Impresi&oacute;n de pago
    						</a>
    					</li>
    					
    				</ul>
    			</li> 
          
    			<li class="menu-open <?php if($modulo_activo == 3){ echo 'page-arrow active-page'; } ?>">
    				<a href="generarTurnos.php">
    				<i class="fa fa-user"></i> Captura de Datos
    				</a>
    	      <ul>
    					<li>
    						<a class="<?php if($pagina_activa == 'biograficos_generales'){ echo 'text-success'; } ?>" href="#">
    						 Biogr&aacute;ficos Generales
    						</a>
    					</li>
    					<li>
    						<a class="<?php if($pagina_activa == 'domicilio'){ echo 'text-success'; } ?>" href="#">
    						Domicilio
    						</a>
    					</li>
    					<li>
    						<a class="<?php if($pagina_activa == 'biometrico_huellas'){ echo 'text-success'; } ?>" href="#">
    						Biom&eacute;trico Huellas
    						</a>
    					</li>
              <li>
    						<a class="<?php if($pagina_activa == 'biometrico_rostro'){ echo 'text-success'; } ?>" href="#">
    						Biom&eacute;trico Rostro
    						</a>
    					</li>
              <li>
    						<a class="<?php if($pagina_activa == 'biometrico_iris'){ echo 'text-success'; } ?>" href="#">
    						Biom&eacute;trico Iris
    						</a>
    					</li>
    				</ul>
    			</li>       
          
    			<li class="menu-open <?php if($modulo_activo == 4){ echo 'page-arrow active-page'; } ?>">
    				<a href="#">
    				<i class="fa fa-files-o"></i> Documentos
    				</a>
    	      <ul>
    					<li class="<?php if($pagina_activa == 'captura_doctos'){ echo 'text-success'; } ?>">
    						<a href="#">
    						Captura de Doctos.
    						</a>
    					</li>
    					
    				</ul>
    			</li> 
          
    			<li class="menu-open <?php if($modulo_activo == 5){ echo 'page-arrow active-page'; } ?>">
    				<a href="#">
    				<i class="fa fa-check"></i> Verificaci&oacute;n
    				</a>
    	      <ul>
    					<li>
    						<a class="<?php if($pagina_activa == 'verificacion_datos'){ echo 'text-success'; } ?>" href="#">
    						Verificaci&oacute;n de Datos
    						</a>
    					</li>
    					<li>
    						<a class="<?php if($pagina_activa == 'captura_firma'){ echo 'text-success'; } ?>" href="#">
    						Captura de Firma
    						</a>
    					</li>
    				</ul>
    			</li>
          
          <li class="menu-open <?php if($modulo_activo == 6){ echo 'page-arrow active-page'; } ?>">
    				<a href="#">
    				<i class="fa fa-list-ol"></i> Examen
    				</a>
    	      <ul>
    					<li>
    						<a class="<?php if($pagina_activa == 'upload_examen'){ echo 'text-success'; } ?>" href="#">
    						Upload de Examen
    						</a>
    					</li>
    				</ul>
            
          </li>
          
          <li class="menu-open <?php if($modulo_activo == 7){ echo 'page-arrow active-page'; } ?>">
    				<a href="#">
    				<i class="fa fa-print"></i> Impresi&oacute;n
    				</a>
            
          </li>
        </ul>
       </nav>
     </div>  