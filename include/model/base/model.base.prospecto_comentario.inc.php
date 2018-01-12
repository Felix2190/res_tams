<?php

	class ModeloBaseProspecto_comentario extends clsBasicCommon
	{
		#------------------------------------------------------------------------------------------------------#
		#----------------------------------------------Propiedades---------------------------------------------#
		#------------------------------------------------------------------------------------------------------#
		var $_nombreClase="base.ModeloBaseProspecto_comentario";

		
		var $idProspectoComentario=0;
		var $idProspecto=0;
		var $idUsuario=0;
		var $fecha='';
		var $comentario='';
		var $sistema='N';

		var $__s=array("idProspectoComentario","idProspecto","idUsuario","fecha","comentario","sistema");
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

		
		public function setIdProspectoComentario($idProspectoComentario)
		{
			if($idProspectoComentario==0||$idProspectoComentario==""||!is_numeric($idProspectoComentario)|| (is_string($idProspectoComentario)&&!ctype_digit($idProspectoComentario)))return $this->setError("Tipo de dato incorrecto para idProspectoComentario.");
			$this->idProspectoComentario=$idProspectoComentario;
			$this->getDatos();
		}
		public function setIdProspecto($idProspecto)
		{
			
			$this->idProspecto=$idProspecto;
		}
		public function setIdUsuario($idUsuario)
		{
			
			$this->idUsuario=$idUsuario;
		}
		public function setFecha($fecha)
		{
			$this->fecha=$fecha;
		}
		public function setComentario($comentario)
		{
			$this->comentario=$comentario;
		}
		public function setSistema($sistema)
		{
			
			$this->sistema=$sistema;
		}
		public function setSistemaY()
		{
			$this->sistema='Y';
		}
		public function setSistemaN()
		{
			$this->sistema='N';
		}

		#------------------------------------------------------------------------------------------------------#
		#-----------------------------------------------Unsetter-----------------------------------------------#
		#------------------------------------------------------------------------------------------------------#

		

		#------------------------------------------------------------------------------------------------------#
		#------------------------------------------------Getter------------------------------------------------#
		#------------------------------------------------------------------------------------------------------#

		
		public function getIdProspectoComentario()
		{
			return $this->idProspectoComentario;
		}
		public function getIdProspecto()
		{
			return $this->idProspecto;
		}
		public function getIdUsuario()
		{
			return $this->idUsuario;
		}
		public function getFecha()
		{
			return $this->fecha;
		}
		public function getComentario()
		{
			return $this->comentario;
		}
		public function getSistema()
		{
			return $this->sistema;
		}

		#------------------------------------------------------------------------------------------------------#
		#------------------------------------------------Querys------------------------------------------------#
		#------------------------------------------------------------------------------------------------------#

		#------------------------------------------------------------------------------------------------------#
		#------------------------------------------------Otras-------------------------------------------------#
		#------------------------------------------------------------------------------------------------------#

		

		protected function limpiarPropiedades()
		{
			
			$this->idProspectoComentario=0;
			$this->idProspecto=0;
			$this->idUsuario=0;
			$this->fecha='';
			$this->comentario='';
			$this->sistema='N';
		}

		

		
		protected function Insertar()
		{
			try
			{
				$SQL="INSERT INTO prospecto_comentario(idProspecto,idUsuario,fecha,comentario,sistema)
						VALUES(	'" . mysqli_real_escape_string($this->dbLink,$this->idProspecto) . "',
								'" . mysqli_real_escape_string($this->dbLink,$this->idUsuario) . "',
								'" . mysqli_real_escape_string($this->dbLink,$this->fecha) . "',
								'" . mysqli_real_escape_string($this->dbLink,$this->comentario) . "',
								'" . mysqli_real_escape_string($this->dbLink,$this->sistema) . "')";
				$result=mysqli_query($this->dbLink,$SQL);
				if(!$result)
					return $this->setSystemError("Error en la insercion de registro.","[" . $SQL . "][" . mysqli_error($this->dbLink) . "][ModeloBaseProspecto_comentario::Insertar]");
				
				$this->idProspectoComentario=mysqli_insert_id($this->dbLink);
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
				$SQL="UPDATE prospecto_comentario SET idProspecto='" . mysqli_real_escape_string($this->dbLink,$this->idProspecto) . "',idUsuario='" . mysqli_real_escape_string($this->dbLink,$this->idUsuario) . "',fecha='" . mysqli_real_escape_string($this->dbLink,$this->fecha) . "',comentario='" . mysqli_real_escape_string($this->dbLink,$this->comentario) . "',sistema='" . mysqli_real_escape_string($this->dbLink,$this->sistema) . "'
					WHERE idProspectoComentario=" . $this->idProspectoComentario;
				
				$result=mysqli_query($this->dbLink,$SQL);
				if(!$result)
					return $this->setSystemError("Error en la actualizacion de registro.","[" . $SQL . "][" . mysqli_error() . "][ModeloBaseProspecto_comentario::Update]");
				
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
				$SQL="DELETE FROM prospecto_comentario
				WHERE idProspectoComentario=" . mysqli_real_escape_string($this->dbLink,$this->idProspectoComentario);
				$result=mysqli_query($this->dbLink,$SQL);
				if(!$result)
					return $this->setSystemError("Error en el borrado de registro.","[" . $SQL . "][" . mysqli_error() . "][ModeloBaseProspecto_comentario::Borrar]");
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
						idProspectoComentario,idProspecto,idUsuario,fecha,comentario,sistema
					FROM prospecto_comentario
					WHERE idProspectoComentario=" . mysqli_real_escape_string($this->dbLink,$this->idProspectoComentario);
					
				$result=mysqli_query($this->dbLink,$SQL);
				if(!$result)
					return $this->setSystemError("Error en la obtencion de detalles de registro.","[ModeloBaseProspecto_comentario::getDatos][" . $SQL . "][" . mysqli_error($this->dbLink) . "]");
				

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
			if($this->idProspectoComentario==0)
				$this->Insertar();
			else
				$this->Actualizar();
			if($this->getError())
				return false;
			return true;
		}
		
	}

?>