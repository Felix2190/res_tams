<?php

	class ModeloBaseProspecto extends clsBasicCommon
	{
		#------------------------------------------------------------------------------------------------------#
		#----------------------------------------------Propiedades---------------------------------------------#
		#------------------------------------------------------------------------------------------------------#
		var $_nombreClase="base.ModeloBaseProspecto";

		
		var $idProspecto=0;
		var $idUsuarioAlta=0;
		var $fechaAlta='';
		var $folio='';
		var $contactoNombre='';
		var $RFC='';
		var $razonSocial='';
		var $comentarios='';
		var $estatus='nuevo';
		var $latitud='';
		var $longitud='';
		var $idUsuarioAsignado=0;
		var $categoria='empresarial';
		var $valorAnualEstimado=0;
		var $mesCierreEsperado='';
		var $probabilidadExito=0;
		var $fechaUltimaModificacion='';
		var $fechaRetomar='';
		var $filePropuesta='';

		var $__s=array("idProspecto","idUsuarioAlta","fechaAlta","folio","contactoNombre","RFC","razonSocial","comentarios","estatus","latitud","longitud","idUsuarioAsignado","categoria","valorAnualEstimado","mesCierreEsperado","probabilidadExito","fechaUltimaModificacion","fechaRetomar","filePropuesta");
		var $__ss=array();

		#------------------------------------------------------------------------------------------------------#
		#--------------------------------------------Inicializacion--------------------------------------------#
		#------------------------------------------------------------------------------------------------------#

		function __construct()
		{
			global $dbLink;
			if(is_null($dbLink))
			{
				trigger_error("La coneccion a la base de datos no esta establecida.",E_ERROR);
				return;
			}
			$this->dbLink=$dbLink;
			$this->link=$dbLink;
		}

		function __destruct()
		{
			
		}

		#------------------------------------------------------------------------------------------------------#
		#------------------------------------------------Setter------------------------------------------------#
		#------------------------------------------------------------------------------------------------------#

		
		public function setIdProspecto($idProspecto)
		{
			if($idProspecto==0||$idProspecto==""||!is_numeric($idProspecto)|| (is_string($idProspecto)&&!ctype_digit($idProspecto)))return $this->setError("Tipo de dato incorrecto para idProspecto.");
			$this->idProspecto=$idProspecto;
			$this->getDatos();
		}
		public function setIdUsuarioAlta($idUsuarioAlta)
		{
			
			$this->idUsuarioAlta=$idUsuarioAlta;
		}
		public function setFechaAlta($fechaAlta)
		{
			$this->fechaAlta=$fechaAlta;
		}
		public function setFolio($folio)
		{
			
			$this->folio=$folio;
		}
		public function setContactoNombre($contactoNombre)
		{
			
			$this->contactoNombre=$contactoNombre;
		}
		public function setRFC($RFC)
		{
			
			$this->RFC=$RFC;
		}
		public function setRazonSocial($razonSocial)
		{
			
			$this->razonSocial=$razonSocial;
		}
		public function setComentarios($comentarios)
		{
			$this->comentarios=$comentarios;
		}
		public function setEstatus($estatus)
		{
			
			$this->estatus=$estatus;
		}
		public function setEstatusNuevo()
		{
			$this->estatus='nuevo';
		}
		public function setEstatusAutorizado()
		{
			$this->estatus='autorizado';
		}
		public function setEstatusReasignado()
		{
			$this->estatus='reasignado';
		}
		public function setEstatusCancelado()
		{
			$this->estatus='cancelado';
		}
		public function setEstatusCliente()
		{
			$this->estatus='cliente';
		}
		public function setEstatusInformacion()
		{
			$this->estatus='informacion';
		}
		public function setEstatusPropuesta()
		{
			$this->estatus='propuesta';
		}
		public function setEstatusContrato()
		{
			$this->estatus='contrato';
		}
		public function setEstatusDenegado()
		{
			$this->estatus='denegado';
		}
		public function setEstatusPospuesto()
		{
			$this->estatus='pospuesto';
		}
		public function setLatitud($latitud)
		{
			
			$this->latitud=$latitud;
		}
		public function setLongitud($longitud)
		{
			
			$this->longitud=$longitud;
		}
		public function setIdUsuarioAsignado($idUsuarioAsignado)
		{
			
			$this->idUsuarioAsignado=$idUsuarioAsignado;
		}
		public function setCategoria($categoria)
		{
			
			$this->categoria=$categoria;
		}
		public function setCategoriaEmpresarial()
		{
			$this->categoria='empresarial';
		}
		public function setCategoriaGobiernoFederal()
		{
			$this->categoria='gobiernoFederal';
		}
		public function setCategoriaGobiernoMunicipalEstatal()
		{
			$this->categoria='gobiernoMunicipalEstatal';
		}
		public function setValorAnualEstimado($valorAnualEstimado)
		{
			
			$this->valorAnualEstimado=$valorAnualEstimado;
		}
		public function setMesCierreEsperado($mesCierreEsperado)
		{
			
			$this->mesCierreEsperado=$mesCierreEsperado;
		}
		public function setProbabilidadExito($probabilidadExito)
		{
			
			$this->probabilidadExito=$probabilidadExito;
		}
		public function setFechaUltimaModificacion($fechaUltimaModificacion)
		{
			$this->fechaUltimaModificacion=$fechaUltimaModificacion;
		}
		public function setFechaRetomar($fechaRetomar)
		{
			$this->fechaRetomar=$fechaRetomar;
		}
		public function setFilePropuesta($filePropuesta)
		{
			
			$this->filePropuesta=$filePropuesta;
		}

		#------------------------------------------------------------------------------------------------------#
		#-----------------------------------------------Unsetter-----------------------------------------------#
		#------------------------------------------------------------------------------------------------------#

		

		#------------------------------------------------------------------------------------------------------#
		#------------------------------------------------Getter------------------------------------------------#
		#------------------------------------------------------------------------------------------------------#

		
		public function getIdProspecto()
		{
			return $this->idProspecto;
		}
		public function getIdUsuarioAlta()
		{
			return $this->idUsuarioAlta;
		}
		public function getFechaAlta()
		{
			return $this->fechaAlta;
		}
		public function getFolio()
		{
			return $this->folio;
		}
		public function getContactoNombre()
		{
			return $this->contactoNombre;
		}
		public function getRFC()
		{
			return $this->RFC;
		}
		public function getRazonSocial()
		{
			return $this->razonSocial;
		}
		public function getComentarios()
		{
			return $this->comentarios;
		}
		public function getEstatus()
		{
			return $this->estatus;
		}
		public function getLatitud()
		{
			return $this->latitud;
		}
		public function getLongitud()
		{
			return $this->longitud;
		}
		public function getIdUsuarioAsignado()
		{
			return $this->idUsuarioAsignado;
		}
		public function getCategoria()
		{
			return $this->categoria;
		}
		public function getValorAnualEstimado()
		{
			return $this->valorAnualEstimado;
		}
		public function getMesCierreEsperado()
		{
			return $this->mesCierreEsperado;
		}
		public function getProbabilidadExito()
		{
			return $this->probabilidadExito;
		}
		public function getFechaUltimaModificacion()
		{
			return $this->fechaUltimaModificacion;
		}
		public function getFechaRetomar()
		{
			return $this->fechaRetomar;
		}
		public function getFilePropuesta()
		{
			return $this->filePropuesta;
		}

		#------------------------------------------------------------------------------------------------------#
		#------------------------------------------------Querys------------------------------------------------#
		#------------------------------------------------------------------------------------------------------#

		#------------------------------------------------------------------------------------------------------#
		#------------------------------------------------Otras-------------------------------------------------#
		#------------------------------------------------------------------------------------------------------#

		

		protected function limpiarPropiedades()
		{
			
			$this->idProspecto=0;
			$this->idUsuarioAlta=0;
			$this->fechaAlta='';
			$this->folio='';
			$this->contactoNombre='';
			$this->RFC='';
			$this->razonSocial='';
			$this->comentarios='';
			$this->estatus='nuevo';
			$this->latitud='';
			$this->longitud='';
			$this->idUsuarioAsignado=0;
			$this->categoria='empresarial';
			$this->valorAnualEstimado=0;
			$this->mesCierreEsperado='';
			$this->probabilidadExito=0;
			$this->fechaUltimaModificacion='';
			$this->fechaRetomar='';
			$this->filePropuesta='';
		}

		

		
		protected function Insertar()
		{
			try
			{
				$SQL="INSERT INTO prospecto(idUsuarioAlta,fechaAlta,folio,contactoNombre,RFC,razonSocial,comentarios,estatus,latitud,longitud,idUsuarioAsignado,categoria,valorAnualEstimado,mesCierreEsperado,probabilidadExito,fechaUltimaModificacion,fechaRetomar,filePropuesta)
						VALUES('" . mysqli_real_escape_string($this->dbLink,$this->idUsuarioAlta) . "','" . mysqli_real_escape_string($this->dbLink,$this->fechaAlta) . "','" . mysqli_real_escape_string($this->dbLink,$this->folio) . "','" . mysqli_real_escape_string($this->dbLink,$this->contactoNombre) . "','" . mysqli_real_escape_string($this->dbLink,$this->RFC) . "','" . mysqli_real_escape_string($this->dbLink,$this->razonSocial) . "','" . mysqli_real_escape_string($this->dbLink,$this->comentarios) . "','" . mysqli_real_escape_string($this->dbLink,$this->estatus) . "','" . mysqli_real_escape_string($this->dbLink,$this->latitud) . "','" . mysqli_real_escape_string($this->dbLink,$this->longitud) . "','" . mysqli_real_escape_string($this->dbLink,$this->idUsuarioAsignado) . "','" . mysqli_real_escape_string($this->dbLink,$this->categoria) . "','" . mysqli_real_escape_string($this->dbLink,$this->valorAnualEstimado) . "','" . mysqli_real_escape_string($this->dbLink,$this->mesCierreEsperado) . "','" . mysqli_real_escape_string($this->dbLink,$this->probabilidadExito) . "','" . mysqli_real_escape_string($this->dbLink,$this->fechaUltimaModificacion) . "','" . mysqli_real_escape_string($this->dbLink,$this->fechaRetomar) . "','" . mysqli_real_escape_string($this->dbLink,$this->filePropuesta) . "')";
				$result=mysqli_query($this->dbLink,$SQL);
				if(!$result)
					return $this->setSystemError("Error en la insercion de registro.","[" . $SQL . "][" . mysqli_error($this->dbLink) . "][ModeloBaseProspecto::Insertar]");
				
				$this->idProspecto=mysqli_insert_id($this->dbLink);
				return true;
			}
			catch (Exception $e)
			{
				return $this->setErrorCatch($e);
			}
		}
		

		
		protected function Actualizar()
		{
			try
			{
				$SQL="UPDATE prospecto SET idUsuarioAlta='" . mysqli_real_escape_string($this->dbLink,$this->idUsuarioAlta) . "',fechaAlta='" . mysqli_real_escape_string($this->dbLink,$this->fechaAlta) . "',folio='" . mysqli_real_escape_string($this->dbLink,$this->folio) . "',contactoNombre='" . mysqli_real_escape_string($this->dbLink,$this->contactoNombre) . "',RFC='" . mysqli_real_escape_string($this->dbLink,$this->RFC) . "',razonSocial='" . mysqli_real_escape_string($this->dbLink,$this->razonSocial) . "',comentarios='" . mysqli_real_escape_string($this->dbLink,$this->comentarios) . "',estatus='" . mysqli_real_escape_string($this->dbLink,$this->estatus) . "',latitud='" . mysqli_real_escape_string($this->dbLink,$this->latitud) . "',longitud='" . mysqli_real_escape_string($this->dbLink,$this->longitud) . "',idUsuarioAsignado='" . mysqli_real_escape_string($this->dbLink,$this->idUsuarioAsignado) . "',categoria='" . mysqli_real_escape_string($this->dbLink,$this->categoria) . "',valorAnualEstimado='" . mysqli_real_escape_string($this->dbLink,$this->valorAnualEstimado) . "',mesCierreEsperado='" . mysqli_real_escape_string($this->dbLink,$this->mesCierreEsperado) . "',probabilidadExito='" . mysqli_real_escape_string($this->dbLink,$this->probabilidadExito) . "',fechaUltimaModificacion='" . mysqli_real_escape_string($this->dbLink,$this->fechaUltimaModificacion) . "',fechaRetomar='" . mysqli_real_escape_string($this->dbLink,$this->fechaRetomar) . "',filePropuesta='" . mysqli_real_escape_string($this->dbLink,$this->filePropuesta) . "'
					WHERE idProspecto=" . $this->idProspecto;
				
				$result=mysqli_query($this->dbLink,$SQL);
				if(!$result)
					return $this->setSystemError("Error en la actualizacion de registro.","[" . $SQL . "][" . mysqli_error() . "][ModeloBaseProspecto::Update]");
				
				return true;
			}
			catch (Exception $e)
			{
				return $this->setErrorCatch($e);
			}
		}
		

		
		public function Borrar()
		{
			if($this->getError())
				return false;
			try
			{
				$SQL="DELETE FROM prospecto
				WHERE idProspecto=" . mysqli_real_escape_string($this->dbLink,$this->idProspecto);
				$result=mysqli_query($this->dbLink,$SQL);
				if(!$result)
					return $this->setSystemError("Error en el borrado de registro.","[" . $SQL . "][" . mysqli_error() . "][ModeloBaseProspecto::Borrar]");
			}
			catch (Exception $e)
			{
				return $this->setErrorCatch($e);
			}
		}
		

		
		public function getDatos()
		{
			try
			{
				$SQL="SELECT
						idProspecto,idUsuarioAlta,fechaAlta,folio,contactoNombre,RFC,razonSocial,comentarios,estatus,latitud,longitud,idUsuarioAsignado,categoria,valorAnualEstimado,mesCierreEsperado,probabilidadExito,fechaUltimaModificacion,fechaRetomar,filePropuesta
					FROM prospecto
					WHERE idProspecto=" . mysqli_real_escape_string($this->dbLink,$this->idProspecto);
					
				$result=mysqli_query($this->dbLink,$SQL);
				if(!$result)
					return $this->setSystemError("Error en la obtencion de detalles de registro.","[ModeloBaseProspecto::getDatos][" . $SQL . "][" . mysqli_error($this->dbLink) . "]");
				

				if(mysqli_num_rows($result)==0)
				{
					$this->limpiarPropiedades();
				}
				else
				{
					$datos=mysqli_fetch_assoc($result);
					foreach($datos as $k=>$v)
					{
						$campo="" . $k;
						$this->$campo=$v;
					}
				}
				return true;
			}
			catch (Exception $e)
			{
				return $this->setErrorCatch($e);
			}
		}
		

		
		public function Guardar()
		{
			if(!$this->validarDatos())
				return false;
			if($this->getError())
				return false;
			if($this->idProspecto==0)
				$this->Insertar();
			else
				$this->Actualizar();
			if($this->getError())
				return false;
			return true;
		}
		
	}

?>