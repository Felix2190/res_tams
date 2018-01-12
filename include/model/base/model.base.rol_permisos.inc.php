<?php

	class ModeloBaseRol_permisos extends clsBasicCommon
	{
		#------------------------------------------------------------------------------------------------------#
		#----------------------------------------------Propiedades---------------------------------------------#
		#------------------------------------------------------------------------------------------------------#
		var $_nombreClase="base.ModeloBaseRol_permisos";

		
		var $id_rol_permiso=0;
		var $id_rol=0;
		var $permisos=0;
		var $menu='';

		var $__s=array("id_rol_permiso","id_rol","permisos","menu");
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

		
		public function setId_rol_permiso($id_rol_permiso)
		{
			if($id_rol_permiso==0||$id_rol_permiso==""||!is_numeric($id_rol_permiso)|| (is_string($id_rol_permiso)&&!ctype_digit($id_rol_permiso)))return $this->setError("Tipo de dato incorrecto para id_rol_permiso.");
			$this->id_rol_permiso=$id_rol_permiso;
			$this->getDatos();
		}
		public function setId_rol($id_rol)
		{
			
			$this->id_rol=$id_rol;
		}
		public function setPermisos($permisos)
		{
			
			$this->permisos=$permisos;
		}
		public function setMenu($menu)
		{
			
			$this->menu=$menu;
		}

		#------------------------------------------------------------------------------------------------------#
		#-----------------------------------------------Unsetter-----------------------------------------------#
		#------------------------------------------------------------------------------------------------------#

		

		#------------------------------------------------------------------------------------------------------#
		#------------------------------------------------Getter------------------------------------------------#
		#------------------------------------------------------------------------------------------------------#

		
		public function getId_rol_permiso()
		{
			return $this->id_rol_permiso;
		}
		public function getId_rol()
		{
			return $this->id_rol;
		}
		public function getPermisos()
		{
			return $this->permisos;
		}
		public function getMenu()
		{
			return $this->menu;
		}

		#------------------------------------------------------------------------------------------------------#
		#------------------------------------------------Querys------------------------------------------------#
		#------------------------------------------------------------------------------------------------------#

		#------------------------------------------------------------------------------------------------------#
		#------------------------------------------------Otras-------------------------------------------------#
		#------------------------------------------------------------------------------------------------------#

		

		protected function limpiarPropiedades()
		{
			
			$this->id_rol_permiso=0;
			$this->id_rol=0;
			$this->permisos=0;
			$this->menu='';
		}

		

		
		protected function Insertar()
		{
			try
			{
				$SQL="INSERT INTO rol_permisos(id_rol,permisos,menu)
						VALUES('" . mysqli_real_escape_string($this->dbLink,$this->id_rol) . "','" . mysqli_real_escape_string($this->dbLink,$this->permisos) . "','" . mysqli_real_escape_string($this->dbLink,$this->menu) . "')";
				$result=mysqli_query($this->dbLink,$SQL);
				if(!$result)
					return $this->setSystemError("Error en la insercion de registro.","[" . $SQL . "][" . mysqli_error($this->dbLink) . "][ModeloBaseRol_permisos::Insertar]");
				
				$this->id_rol_permiso=mysqli_insert_id($this->dbLink);
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
				$SQL="UPDATE rol_permisos SET id_rol='" . mysqli_real_escape_string($this->dbLink,$this->id_rol) . "',permisos='" . mysqli_real_escape_string($this->dbLink,$this->permisos) . "',menu='" . mysqli_real_escape_string($this->dbLink,$this->menu) . "'
					WHERE id_rol_permiso=" . $this->id_rol_permiso;
				
				$result=mysqli_query($this->dbLink,$SQL);
				if(!$result)
					return $this->setSystemError("Error en la actualizacion de registro.","[" . $SQL . "][" . mysqli_error() . "][ModeloBaseRol_permisos::Update]");
				
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
				$SQL="DELETE FROM rol_permisos
				WHERE id_rol_permiso=" . mysqli_real_escape_string($this->dbLink,$this->id_rol_permiso);
				$result=mysqli_query($this->dbLink,$SQL);
				if(!$result)
					return $this->setSystemError("Error en el borrado de registro.","[" . $SQL . "][" . mysqli_error() . "][ModeloBaseRol_permisos::Borrar]");
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
						id_rol_permiso,id_rol,permisos,menu
					FROM rol_permisos
					WHERE id_rol_permiso=" . mysqli_real_escape_string($this->dbLink,$this->id_rol_permiso);
					
				$result=mysqli_query($this->dbLink,$SQL);
				if(!$result)
					return $this->setSystemError("Error en la obtencion de detalles de registro.","[ModeloBaseRol_permisos::getDatos][" . $SQL . "][" . mysqli_error($this->dbLink) . "]");
				

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
			if($this->id_rol_permiso==0)
				$this->Insertar();
			else
				$this->Actualizar();
			if($this->getError())
				return false;
			return true;
		}
		
	}

?>