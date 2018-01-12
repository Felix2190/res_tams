<?php

	class ModeloBaseRespuestacorrecta extends clsBasicCommon
	{
		#------------------------------------------------------------------------------------------------------#
		#----------------------------------------------Propiedades---------------------------------------------#
		#------------------------------------------------------------------------------------------------------#
		var $_nombreClase="base.ModeloBaseRespuestacorrecta";

		
		var $idRespuestaCorrecta=0;
		var $idRespuesta=0;

		var $__s=array("idRespuestaCorrecta","idRespuesta");
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

		
		public function setIdRespuestaCorrecta($idRespuestaCorrecta)
		{
			if($idRespuestaCorrecta==0||$idRespuestaCorrecta==""||!is_numeric($idRespuestaCorrecta)|| (is_string($idRespuestaCorrecta)&&!ctype_digit($idRespuestaCorrecta)))return $this->setError("Tipo de dato incorrecto para idRespuestaCorrecta.");
			$this->idRespuestaCorrecta=$idRespuestaCorrecta;
			$this->getDatos();
		}
		public function setIdRespuesta($idRespuesta)
		{
			
			$this->idRespuesta=$idRespuesta;
		}

		#------------------------------------------------------------------------------------------------------#
		#-----------------------------------------------Unsetter-----------------------------------------------#
		#------------------------------------------------------------------------------------------------------#

		

		#------------------------------------------------------------------------------------------------------#
		#------------------------------------------------Getter------------------------------------------------#
		#------------------------------------------------------------------------------------------------------#

		
		public function getIdRespuestaCorrecta()
		{
			return $this->idRespuestaCorrecta;
		}
		public function getIdRespuesta()
		{
			return $this->idRespuesta;
		}

		#------------------------------------------------------------------------------------------------------#
		#------------------------------------------------Querys------------------------------------------------#
		#------------------------------------------------------------------------------------------------------#

		#------------------------------------------------------------------------------------------------------#
		#------------------------------------------------Otras-------------------------------------------------#
		#------------------------------------------------------------------------------------------------------#

		

		protected function limpiarPropiedades()
		{
			
			$this->idRespuestaCorrecta=0;
			$this->idRespuesta=0;
		}

		

		
		protected function Insertar()
		{
			try
			{
				$SQL="INSERT INTO respuestacorrecta(idRespuesta)
						VALUES('" . mysqli_real_escape_string($this->dbLink,$this->idRespuesta) . "')";
				$result=mysqli_query($this->dbLink,$SQL);
				if(!$result)
					return $this->setSystemError("Error en la insercion de registro.","[" . $SQL . "][" . mysqli_error($this->dbLink) . "][ModeloBaseRespuestacorrecta::Insertar]");
				
				$this->idRespuestaCorrecta=mysqli_insert_id($this->dbLink);
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
				$SQL="UPDATE respuestacorrecta SET idRespuesta='" . mysqli_real_escape_string($this->dbLink,$this->idRespuesta) . "'
					WHERE idRespuestaCorrecta=" . $this->idRespuestaCorrecta;
				
				$result=mysqli_query($this->dbLink,$SQL);
				if(!$result)
					return $this->setSystemError("Error en la actualizacion de registro.","[" . $SQL . "][" . mysqli_error() . "][ModeloBaseRespuestacorrecta::Update]");
				
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
				$SQL="DELETE FROM respuestacorrecta
				WHERE idRespuestaCorrecta=" . mysqli_real_escape_string($this->dbLink,$this->idRespuestaCorrecta);
				$result=mysqli_query($this->dbLink,$SQL);
				if(!$result)
					return $this->setSystemError("Error en el borrado de registro.","[" . $SQL . "][" . mysqli_error() . "][ModeloBaseRespuestacorrecta::Borrar]");
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
						idRespuestaCorrecta,idRespuesta
					FROM respuestacorrecta
					WHERE idRespuestaCorrecta=" . mysqli_real_escape_string($this->dbLink,$this->idRespuestaCorrecta);
					
				$result=mysqli_query($this->dbLink,$SQL);
				if(!$result)
					return $this->setSystemError("Error en la obtencion de detalles de registro.","[ModeloBaseRespuestacorrecta::getDatos][" . $SQL . "][" . mysqli_error($this->dbLink) . "]");
				

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
			if($this->idRespuestaCorrecta==0)
				$this->Insertar();
			else
				$this->Actualizar();
			if($this->getError())
				return false;
			return true;
		}
		
	}

?>