<?php

	class ModeloBaseListadoscortos extends clsBasicCommon
	{
		#------------------------------------------------------------------------------------------------------#
		#----------------------------------------------Propiedades---------------------------------------------#
		#------------------------------------------------------------------------------------------------------#
		var $_nombreClase="base.ModeloBaseListadoscortos";

		
		var $idListado=0;
		var $listado='ojos';
		var $valor='';

		var $__s=array("idListado","listado","valor");
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

		
		public function setIdListado($idListado)
		{
			if($idListado==0||$idListado==""||!is_numeric($idListado)|| (is_string($idListado)&&!ctype_digit($idListado)))return $this->setError("Tipo de dato incorrecto para idListado.");
			$this->idListado=$idListado;
			$this->getDatos();
		}
		public function setListado($listado)
		{
			
			$this->listado=$listado;
		}
		public function setListadoOjos()
		{
			$this->listado='ojos';
		}
		public function setListadoPelo()
		{
			$this->listado='pelo';
		}
		public function setListadoSangre()
		{
			$this->listado='sangre';
		}
		public function setListadoGenero()
		{
			$this->listado='genero';
		}
		public function setListadoParentezco()
		{
			$this->listado='parentezco';
		}
		public function setValor($valor)
		{
			
			$this->valor=$valor;
		}

		#------------------------------------------------------------------------------------------------------#
		#-----------------------------------------------Unsetter-----------------------------------------------#
		#------------------------------------------------------------------------------------------------------#

		

		#------------------------------------------------------------------------------------------------------#
		#------------------------------------------------Getter------------------------------------------------#
		#------------------------------------------------------------------------------------------------------#

		
		public function getIdListado()
		{
			return $this->idListado;
		}
		public function getListado()
		{
			return $this->listado;
		}
		public function getValor()
		{
			return $this->valor;
		}

		#------------------------------------------------------------------------------------------------------#
		#------------------------------------------------Querys------------------------------------------------#
		#------------------------------------------------------------------------------------------------------#

		#------------------------------------------------------------------------------------------------------#
		#------------------------------------------------Otras-------------------------------------------------#
		#------------------------------------------------------------------------------------------------------#

		

		protected function limpiarPropiedades()
		{
			
			$this->idListado=0;
			$this->listado='ojos';
			$this->valor='';
		}

		

		
		protected function Insertar()
		{
			try
			{
				$SQL="INSERT INTO listadoscortos(listado,valor)
						VALUES('" . mysqli_real_escape_string($this->dbLink,$this->listado) . "','" . mysqli_real_escape_string($this->dbLink,$this->valor) . "')";
				$result=mysqli_query($this->dbLink,$SQL);
				if(!$result)
					return $this->setSystemError("Error en la insercion de registro.","[" . $SQL . "][" . mysqli_error($this->dbLink) . "][ModeloBaseListadoscortos::Insertar]");
				
				$this->idListado=mysqli_insert_id($this->dbLink);
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
				$SQL="UPDATE listadoscortos SET listado='" . mysqli_real_escape_string($this->dbLink,$this->listado) . "',valor='" . mysqli_real_escape_string($this->dbLink,$this->valor) . "'
					WHERE idListado=" . $this->idListado;
				
				$result=mysqli_query($this->dbLink,$SQL);
				if(!$result)
					return $this->setSystemError("Error en la actualizacion de registro.","[" . $SQL . "][" . mysqli_error() . "][ModeloBaseListadoscortos::Update]");
				
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
				$SQL="DELETE FROM listadoscortos
				WHERE idListado=" . mysqli_real_escape_string($this->dbLink,$this->idListado);
				$result=mysqli_query($this->dbLink,$SQL);
				if(!$result)
					return $this->setSystemError("Error en el borrado de registro.","[" . $SQL . "][" . mysqli_error() . "][ModeloBaseListadoscortos::Borrar]");
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
						idListado,listado,valor
					FROM listadoscortos
					WHERE idListado=" . mysqli_real_escape_string($this->dbLink,$this->idListado);
					
				$result=mysqli_query($this->dbLink,$SQL);
				if(!$result)
					return $this->setSystemError("Error en la obtencion de detalles de registro.","[ModeloBaseListadoscortos::getDatos][" . $SQL . "][" . mysqli_error($this->dbLink) . "]");
				

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
			if($this->idListado==0)
				$this->Insertar();
			else
				$this->Actualizar();
			if($this->getError())
				return false;
			return true;
		}
		
	}

?>