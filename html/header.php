<?php 
		foreach($_SESSION['rol_permisos'] as $row){    
      if($row['menu']=='turnos'){ $permisos_turnos = $row['permisos']; }
      if($row['menu']=='verificacion'){ $permisos_verificacion = $row['permisos']; }
      if($row['menu']=='modulo1'){ $permisos_modulo1 = $row['permisos']; }
      if($row['menu']=='modulo2'){ $permisos_modulo2 = $row['permisos']; }
      if($row['menu']=='modulo3'){ $permisos_modulo3 = $row['permisos']; }
      if($row['menu']=='reportes'){ $permisos_reportes = $row['permisos']; }
      if($row['menu']=='usuarios'){ $permisos_usuarios = $row['permisos']; }
      if($row['menu']=='roles'){ $permisos_roles = $row['permisos']; }
      if($row['menu']=='reglas'){ $permisos_reglas = $row['permisos']; }
      if($row['menu']=='descuentos'){ $permisos_descuentos = $row['permisos']; }
      if($row['menu']=='soporte'){ $permisos_soporte = $row['permisos']; }
      if($row['menu']=='recaudacion'){ $permisos_recaudacion = $row['permisos']; }
    }  
?>
			<div class="sidebar-logo">
            	<a href="dashboard.php" id="logo-big">
            		<h1><img src="images/theme/logobw.png" alt="DRIVE ID" title="DRIVE ID" /></h1>
            	</a>
            </div><!-- End .sidebar-logo -->
                    
            <div class="sidebar-module"> 
                <div class="sidebar-profile">
                	<div class="dropdown ext-dropdown-profile">
						<a class="btn btn-default dropdown-toggle" data-toggle="dropdown" href="#">
						<img src="images/users/user-1.jpg" alt="" class="avatar"/>
							Hola, <strong><?php echo $objSession->getFirstName() ?></strong>
							<i class="fa fa-caret-down pull-right"></i>
						</a>
						<ul role="menu" class="dropdown-menu">
							<li>
								<a href="dashboard.php"><i class="fa fa-home"></i> Inicio</a>
							</li>
							<li>
								<a href="preferencias.php"><i class="fa fa-cogs"></i> Preferencias</a>
							</li>
							<li class="divider"></li>
							<li>
								<a href="logout.php"><i class="fa fa-sign-out"></i> Salir</a>
							</li>
						</ul>
	                </div>
                </div>
            </div><!-- /sidebar -->
                    
            <div class="sidebar-line"><!-- A seperator line --></div>