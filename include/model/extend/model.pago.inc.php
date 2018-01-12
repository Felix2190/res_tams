<?php

	require FOLDER_MODEL_BASE . "model.base.pago.inc.php";
	require_once FOLDER_MODEL_EXTEND . 'model.turno.inc.php';
	require_once FOLDER_MODEL_EXTEND . 'model.ubicacion.inc.php';
	require_once FOLDER_MODEL_EXTEND . 'model.licencia.inc.php';
	require_once LIB_PDFRECIBOCAJA;

	class ModeloPago extends ModeloBasePago
	{
		#------------------------------------------------------------------------------------------------------#
		#----------------------------------------------Propiedades---------------------------------------------#
		#------------------------------------------------------------------------------------------------------#
		var $_nombreClase="ModeloBasePago";

		var $__ss=array();

		#------------------------------------------------------------------------------------------------------#
		#--------------------------------------------Inicializacion--------------------------------------------#
		#------------------------------------------------------------------------------------------------------#

		function __construct()
		{
			parent::__construct();
		}

		function __destruct()
		{
			
		}

		#------------------------------------------------------------------------------------------------------#
		#------------------------------------------------Setter------------------------------------------------#
		#------------------------------------------------------------------------------------------------------#
		
		public function setEstatusPagado()
		{
			parent::setEstatusPagado();
			$this->setFechaPago(_NOW_);
			$Turno=new ModeloTurno();
			$Turno->setIdTurno($this->idTurno);
			$query="SELECT orden FROM etapa WHERE descripcion='pago'";
			$result=mysqli_query($this->dbLink, $query);
			$r=mysqli_fetch_assoc($result);
			
			$query="SELECT idEtapa FROM etapa WHERE orden=" . ($r[orden]+1);
			$result=mysqli_query($this->dbLink, $query);
			$r=mysqli_fetch_assoc($result);
			
			
			$Turno->setIdEtapa($r['idEtapa']);
			$Turno->Guardar();
		}



		#------------------------------------------------------------------------------------------------------#
		#-----------------------------------------------Unsetter-----------------------------------------------#
		#------------------------------------------------------------------------------------------------------#



		#------------------------------------------------------------------------------------------------------#
		#------------------------------------------------Getter------------------------------------------------#
		#------------------------------------------------------------------------------------------------------#
		
		public function getPagoPendienteByIdTurno($idTurno)
		{
			$query="SELECT idPago FROM pago WHERE idTurno=" . $idTurno . " AND estatus='pendiente' ORDER BY idPago DESC LIMIT 1";
			$result=mysqli_query($this->dbLink,$query);
			if(!$result)
			{
				return $this->setSystemError("Ocurrio un error en la consulta de turno pendiente.", "[" . $this->_nombreClase . "LN49][" . $query . "][" . mysqli_error($this->dbLink) . "]");
			}
			if(mysqli_num_rows($result)>0)
			{
					
				$row=mysqli_fetch_assoc($result);
				$this->setIdPago($row['idPago']);
				return true;
			}
			return false;
		}
		
		public function existePago($idTurno)
		{
			$query="SELECT idPago FROM pago WHERE idTurno=" . $idTurno . " AND estatus='pagado'";
			$result=mysqli_query($this->dbLink,$query);
			if(!$result)
			{
				return $this->setSystemError("Ocurrio un error en la consulta de turno pagado.", "[" . $this->_nombreClase . "LN68][" . $query . "][" . mysqli_error($this->dbLink) . "]");
			}
			if(mysqli_num_rows($result)>0)
			{
			
				$row=mysqli_fetch_assoc($result);
				$this->setIdPago($row['idPago']);
				return true;
			}
			return false;
		}



		#------------------------------------------------------------------------------------------------------#
		#------------------------------------------------Querys------------------------------------------------#
		#------------------------------------------------------------------------------------------------------#

		#------------------------------------------------------------------------------------------------------#
		#------------------------------------------------Otras-------------------------------------------------#
		#------------------------------------------------------------------------------------------------------#
		
		public function generaPDF($strPath)
		{
			
			/*--------------------------------------------------------------*/
			/*--------------Calcular informacion desde el pago--------------*/
			/*--------------------------------------------------------------*/
			
			$Ubicacion=new ModeloUbicacion();
			$Ubicacion->setIdUbicacion($this->idUbicacion);
			
			
			$Turno=new ModeloTurno();
			$Turno->setIdTurno($this->idTurno);
			
			$Licencia=new ModeloLicencia();
			$Licencia->setIdLicencias($Turno->idLicencias);
			
			
			
			
			$query="SELECT
						CONCAT_WS(' ',P.primerAp,P.segundoAp, P.nombres) AS nombre,
						P.fechaNacimiento AS fechaNacimiento,
						P.CURP AS curp,
						E.tipoSangre AS tipoSangre,
						E.donaOrganos AS donador,
						D.nombreCalle AS calle,
						D.numeroExterior AS exterior,
						D.colonia AS colonia,
						D.codigoPostal AS postal,
						EN.NOM_ENT AS entidad,
						MU.NOM_MUN AS municipio,
						LO.NOM_LOC AS localidad,
						CO.telefeno AS telefonoAccidente
					FROM persona As P
					INNER JOIN persona_datos_extras AS E ON E.idPersona=P.idPersona
					INNER JOIN persona_domicilio AS PD ON PD.idPersona=P.idPersona AND  PD.estatus='vigente'
					INNER JOIN inegi_domicilio AS D ON D.idDomicilio=PD.idDomicilio
					INNER JOIN inegidomgeo_cat_estado AS EN ON EN.CVE_ENT=D.cveEnt
					INNER JOIN inegidomgeo_cat_municipio AS MU ON MU.CVE_ENT=D.cveEnt AND MU.CVE_MUN=D.cveMun
					INNER JOIN inegidomgeo_cat_localidad AS LO ON LO.CVE_ENT=D.cveEnt AND LO.CVE_MUN=D.cveMun AND LO.CVE_LOC=D.cveLoc
					INNER JOIN contacto_emergencia AS CO ON CO.idPersona=P.idPersona
					WHERE P.idPersona=" . $Turno->getIdPersona();
			$result=mysqli_query($this->dbLink, $query);
			if(!$result)
			{
				return $this->setSystemError("Ocurrio un error en la consulta de datos.", "[" . $this->_nombreClase . ":LN157][" . $query . "][" . mysqli_error($this->dbLink) . "]");
			}
			
			$datos=mysqli_fetch_assoc($result);
			
			
			
			
			
			
			/*--------------------------------------------------------------*/
			/*--------------------------------------------------------------*/
			
			
			
			
			$pdf=new PDFImpresionReciboCaja();
			$pdf->setNombreOficina("OFICINA FISCAL DE " . $Ubicacion->getNombre());
			
			$pdf->setFolioOperacion($this->folioRecaudacion);
			//$pdf->setCURP($datos["curp"]);
			$pdf->setCURP($_SESSION['curp']);
			$pdf->setNombreCompleto($datos["nombre"]);
			$pdf->setNumLicencia($Licencia->getNumero());
			
			
			$query="SELECT 1 AS cantidad, concepto, monto FROM pago_detalle WHERE idPago=" . $this->idPago;
			$result=mysqli_query($this->dbLink, $query);
			
			$conceptos=array();
			while($row=mysqli_fetch_array($result))
			{
				$conceptos[]=$row;
				
			}
			/*
			
			$conceptos=array(
				array("1","LICENCIA DE CHOFER","906.00"),
				array("1","CONDONACION LICENCIA DE MANEJO","-208.00"),
				array("1","SUBSIDIO FIN DE AÑO","-335.00")
			);
			*/
			
			$pdf->setConceptos($conceptos);
			$pdf->setTotal($this->total);
			
			
			$pdf->setDireccion($datos["calle"] . " " . $datos['exterior']);
			$pdf->setColonia($datos['colonia']);
			$pdf->setPostal($datos['postal']);
			$pdf->setLocalidad($datos['localidad']);
			$pdf->setMunicipio($datos['municipio']);
			$pdf->setFechaNacimiento($datos['fechaNacimiento']);
			$pdf->setTipoSangre($datos['tipoSangre']);
			$pdf->setTelAccidente($datos['telefonoAccidente']);
			$pdf->setAlergia("");
			$pdf->setDonador($datos['donador']==1?"SI":"NO");
			$pdf->setFinVigencia($Licencia->getFechaExpiracion());
			
			$pdf->generaPaginas();
			
			$pdf->Output("F", $strPath);
		}
		
		public function validarDatos()
		{
			return true;
		}


	}

