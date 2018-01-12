<?php

	class ModeloBaseRespuesta extends clsBasicCommon
	{
		#------------------------------------------------------------------------------------------------------#
		#----------------------------------------------Propiedades---------------------------------------------#
		#------------------------------------------------------------------------------------------------------#
		var $_nombreClase="base.ModeloBaseRespuesta";

		
		var $idRespuesta=0;
		var $idPregunta=0;
		var $respuesta='';
		var $respuestaImagen='';
		var $esCorrecta='0';

		var $__s=array("idRespuesta","idPregunta","respuesta","respuestaImagen","esCorrecta");
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

		
		public function setIdRespuesta($idRespuesta)
		{
			if($idRespuesta==0||$idRespuesta==""||!is_numeric($idRespuesta)|| (is_string($idRespuesta)&&!ctype_digit($idRespuesta)))return $this->setError("Tipo de dato incorrecto para idRespuesta.");
			$this->idRespuesta=$idRespuesta;
			$this->getDatos();
		}
		public function setIdPregunta($idPregunta)
		{
			
			$this->idPregunta=$idPregunta;
		}
		public function setRespuesta($respuesta)
		{
			
			$this->respuesta=$respuesta;
		}
		public function setRespuestaImagen($respuestaImagen)
		{
			
			$this->respuestaImagen=$respuestaImagen;
		}
		public function setEsCorrecta()
		{
			$this->esCorrecta=1;
		}

		#------------------------------------------------------------------------------------------------------#
		#-----------------------------------------------Unsetter-----------------------------------------------#
		#------------------------------------------------------------------------------------------------------#

		
		public function unsetEsCorrecta()
		{
			$this->esCorrecta=0;
		}

		#------------------------------------------------------------------------------------------------------#
		#------------------------------------------------Getter------------------------------------------------#
		#------------------------------------------------------------------------------------------------------#

		
		public function getIdRespuesta()
		{
			return $this->idRespuesta;
		}
		public function getIdPregunta()
		{
			return $this->idPregunta;
		}
		public function getRespuesta()
		{
			return $this->respuesta;
		}
		public function getRespuestaImagen()
		{
			return $this->respuestaImagen;
		}
		public function getEsCorrecta()
		{
			return $this->esCorrecta;
		}

		#------------------------------------------------------------------------------------------------------#
		#------------------------------------------------Querys------------------------------------------------#
		#------------------------------------------------------------------------------------------------------#

		#------------------------------------------------------------------------------------------------------#
		#------------------------------------------------Otras-------------------------------------------------#
		#------------------------------------------------------------------------------------------------------#

		

		protected function limpiarPropiedades()
		{
			
			$this->idRespuesta=0;
			$this->idPregunta=0;
			$this->respuesta='';
			$this->respuestaImagen='';
			$this->esCorrecta='0';
		}

		

		
		protected function Insertar()
		{
			try
			{
				$SQL="INSERT INTO respuesta(idPregunta,respuesta,respuestaImagen,esCorrecta)
						VALUES('" . mysqli_real_escape_string($this->dbLink,$this->idPregunta) . "','" . mysqli_real_escape_string($this->dbLink,$this->respuesta) . "','" . mysqli_real_escape_string($this->dbLink,$this->respuestaImagen) . "','" . mysqli_real_escape_string($this->dbLink,$this->esCorrecta) . "')";
				$result=mysqli_query($this->dbLink,$SQL);
				if(!$result)
					return $this->setSystemError("Error en la insercion de registro.","[" . $SQL . "][" . mysqli_error($this->dbLink) . "][ModeloBaseRespuesta::Insertar]");
				
				$this->idRespuesta=mysqli_insert_id($this->dbLink);
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
				$SQL="UPDATE respuesta SET idPregunta='" . mysqli_real_escape_string($this->dbLink,$this->idPregunta) . "',respuesta='" . mysqli_real_escape_string($this->dbLink,$this->respuesta) . "',respuestaImagen='" . mysqli_real_escape_string($this->dbLink,$this->respuestaImagen) . "',esCorrecta='" . mysqli_real_escape_string($this->dbLink,$this->esCorrecta) . "'
					WHERE idRespuesta=" . $this->idRespuesta;
				
				$result=mysqli_query($this->dbLink,$SQL);
				if(!$result)
					return $this->setSystemError("Error en la actualizacion de registro.","[" . $SQL . "][" . mysqli_error() . "][ModeloBaseRespuesta::Update]");
				
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
				$SQL="DELETE FROM respuesta
				WHERE idRespuesta=" . mysqli_real_escape_string($this->dbLink,$this->idRespuesta);
				$result=mysqli_query($this->dbLink,$SQL);
				if(!$result)
					return $this->setSystemError("Error en el borrado de registro.","[" . $SQL . "][" . mysqli_error() . "][ModeloBaseRespuesta::Borrar]");
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
						idRespuesta,idPregunta,respuesta,respuestaImagen,esCorrecta
					FROM respuesta
					WHERE idRespuesta=" . mysqli_real_escape_string($this->dbLink,$this->idRespuesta);
					
				$result=mysqli_query($this->dbLink,$SQL);
				if(!$result)
					return $this->setSystemError("Error en la obtencion de detalles de registro.","[ModeloBaseRespuesta::getDatos][" . $SQL . "][" . mysqli_error($this->dbLink) . "]");
				

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
			if($this->idRespuesta==0)
				$this->Insertar();
			else
				$this->Actualizar();
			if($this->getError())
				return false;
			return true;
		}
		
	}

?>