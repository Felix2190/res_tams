<?php

	class ModeloBasePersona_documento extends clsBasicCommon
	{
		#------------------------------------------------------------------------------------------------------#
		#----------------------------------------------Propiedades---------------------------------------------#
		#------------------------------------------------------------------------------------------------------#
		var $_nombreClase="base.ModeloBasePersona_documento";

		
		var $idpersona_documento=0;
		var $idpersona=0;
		var $iddocumento=0;
		var $documentoimagen='';
		var $estatus='vigente';
		var $fechacaptura='';
		var $historico=0;

		var $__s=array("idpersona_documento","idpersona","iddocumento","documentoimagen","estatus","fechacaptura","historico");
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

		
		public function setIdpersona_documento($idpersona_documento)
		{
			if($idpersona_documento==0||$idpersona_documento==""||!is_numeric($idpersona_documento)|| (is_string($idpersona_documento)&&!ctype_digit($idpersona_documento)))return $this->setError("Tipo de dato incorrecto para idpersona_documento.");
			$this->idpersona_documento=$idpersona_documento;
			$this->getDatos();
		}
		public function setIdpersona($idpersona)
		{
			
			$this->idpersona=$idpersona;
		}
		public function setIddocumento($iddocumento)
		{
			
			$this->iddocumento=$iddocumento;
		}
		public function setDocumentoimagen($documentoimagen)
		{
			
			$this->documentoimagen=$documentoimagen;
		}
		public function setEstatus($estatus)
		{
			
			$this->estatus=$estatus;
		}
		public function setEstatusVigente()
		{
			$this->estatus='vigente';
		}
		public function setEstatusBaja()
		{
			$this->estatus='baja';
		}
		public function setFechacaptura($fechacaptura)
		{
			$this->fechacaptura=$fechacaptura;
		}
		public function setHistorico($historico)
		{
			
			$this->historico=$historico;
		}

		#------------------------------------------------------------------------------------------------------#
		#-----------------------------------------------Unsetter-----------------------------------------------#
		#------------------------------------------------------------------------------------------------------#

		

		#------------------------------------------------------------------------------------------------------#
		#------------------------------------------------Getter------------------------------------------------#
		#------------------------------------------------------------------------------------------------------#

		
		public function getIdpersona_documento()
		{
			return $this->idpersona_documento;
		}
		public function getIdpersona()
		{
			return $this->idpersona;
		}
		public function getIddocumento()
		{
			return $this->iddocumento;
		}
		public function getDocumentoimagen()
		{
			return $this->documentoimagen;
		}
		public function getEstatus()
		{
			return $this->estatus;
		}
		public function getFechacaptura()
		{
			return $this->fechacaptura;
		}
		public function getHistorico()
		{
			return $this->historico;
		}

		#------------------------------------------------------------------------------------------------------#
		#------------------------------------------------Querys------------------------------------------------#
		#------------------------------------------------------------------------------------------------------#

		#------------------------------------------------------------------------------------------------------#
		#------------------------------------------------Otras-------------------------------------------------#
		#------------------------------------------------------------------------------------------------------#

		

		protected function limpiarPropiedades()
		{
			
			$this->idpersona_documento=0;
			$this->idpersona=0;
			$this->iddocumento=0;
			$this->documentoimagen='';
			$this->estatus='vigente';
			$this->fechacaptura='';
			$this->historico=0;
		}

		

		
		protected function Insertar()
		{
			try
			{
				$SQL="INSERT INTO persona_documento(idpersona,iddocumento,documentoimagen,estatus,fechacaptura,historico)
						VALUES('" . mysqli_real_escape_string($this->dbLink,$this->idpersona) . "','" . mysqli_real_escape_string($this->dbLink,$this->iddocumento) . "','" . mysqli_real_escape_string($this->dbLink,$this->documentoimagen) . "','" . mysqli_real_escape_string($this->dbLink,$this->estatus) . "','" . mysqli_real_escape_string($this->dbLink,$this->fechacaptura) . "','" . mysqli_real_escape_string($this->dbLink,$this->historico) . "')";
				$result=mysqli_query($this->dbLink,$SQL);
				if(!$result)
					return $this->setSystemError("Error en la insercion de registro.","[" . $SQL . "][" . mysqli_error($this->dbLink) . "][ModeloBasePersona_documento::Insertar]");
				
				$this->idpersona_documento=mysqli_insert_id($this->dbLink);
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
				$SQL="UPDATE persona_documento SET idpersona='" . mysqli_real_escape_string($this->dbLink,$this->idpersona) . "',iddocumento='" . mysqli_real_escape_string($this->dbLink,$this->iddocumento) . "',documentoimagen='" . mysqli_real_escape_string($this->dbLink,$this->documentoimagen) . "',estatus='" . mysqli_real_escape_string($this->dbLink,$this->estatus) . "',fechacaptura='" . mysqli_real_escape_string($this->dbLink,$this->fechacaptura) . "',historico='" . mysqli_real_escape_string($this->dbLink,$this->historico) . "'
					WHERE idpersona_documento=" . $this->idpersona_documento;
				
				$result=mysqli_query($this->dbLink,$SQL);
				if(!$result)
					return $this->setSystemError("Error en la actualizacion de registro.","[" . $SQL . "][" . mysqli_error() . "][ModeloBasePersona_documento::Update]");
				
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
				$SQL="DELETE FROM persona_documento
				WHERE idpersona_documento=" . mysqli_real_escape_string($this->dbLink,$this->idpersona_documento);
				$result=mysqli_query($this->dbLink,$SQL);
				if(!$result)
					return $this->setSystemError("Error en el borrado de registro.","[" . $SQL . "][" . mysqli_error() . "][ModeloBasePersona_documento::Borrar]");
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
						idpersona_documento,idpersona,iddocumento,documentoimagen,estatus,fechacaptura,historico
					FROM persona_documento
					WHERE idpersona_documento=" . mysqli_real_escape_string($this->dbLink,$this->idpersona_documento);
					
				$result=mysqli_query($this->dbLink,$SQL);
				if(!$result)
					return $this->setSystemError("Error en la obtencion de detalles de registro.","[ModeloBasePersona_documento::getDatos][" . $SQL . "][" . mysqli_error($this->dbLink) . "]");
				

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
			if($this->idpersona_documento==0)
				$this->Insertar();
			else
				$this->Actualizar();
			if($this->getError())
				return false;
			return true;
		}
		
	}

?>