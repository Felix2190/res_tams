<?php

	class ModeloBaseTicket_movimiento extends clsBasicCommon
	{
		#------------------------------------------------------------------------------------------------------#
		#----------------------------------------------Propiedades---------------------------------------------#
		#------------------------------------------------------------------------------------------------------#
		var $_nombreClase="base.ModeloBaseTicket_movimiento";

		
		var $id_tmovimiento=0;
		var $id_ticket='';
		var $fecha='';
		var $id_estatus='';
		var $id_origen='';
		var $id_asignado='';

		var $__s=array("id_tmovimiento","id_ticket","fecha","id_estatus","id_origen","id_asignado");
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

		
		public function setId_tmovimiento($id_tmovimiento)
		{
			if($id_tmovimiento==0||$id_tmovimiento==""||!is_numeric($id_tmovimiento)|| (is_string($id_tmovimiento)&&!ctype_digit($id_tmovimiento)))return $this->setError("Tipo de dato incorrecto para id_tmovimiento.");
			$this->id_tmovimiento=$id_tmovimiento;
			$this->getDatos();
		}
		public function setId_ticket($id_ticket)
		{
			$this->id_ticket=$id_ticket;
		}
		public function setFecha($fecha)
		{
			$this->fecha=$fecha;
		}
		public function setId_estatus($id_estatus)
		{
			$this->id_estatus=$id_estatus;
		}
		public function setId_origen($id_origen)
		{
			$this->id_origen=$id_origen;
		}
		public function setId_asignado($id_asignado)
		{
			$this->id_asignado=$id_asignado;
		}

		#------------------------------------------------------------------------------------------------------#
		#-----------------------------------------------Unsetter-----------------------------------------------#
		#------------------------------------------------------------------------------------------------------#

		

		#------------------------------------------------------------------------------------------------------#
		#------------------------------------------------Getter------------------------------------------------#
		#------------------------------------------------------------------------------------------------------#

		
		public function getId_tmovimiento()
		{
			return $this->id_tmovimiento;
		}
		public function getId_ticket()
		{
			return $this->id_ticket;
		}
		public function getFecha()
		{
			return $this->fecha;
		}
		public function getId_estatus()
		{
			return $this->id_estatus;
		}
		public function getId_origen()
		{
			return $this->id_origen;
		}
		public function getId_asignado()
		{
			return $this->id_asignado;
		}

		#------------------------------------------------------------------------------------------------------#
		#------------------------------------------------Querys------------------------------------------------#
		#------------------------------------------------------------------------------------------------------#

		#------------------------------------------------------------------------------------------------------#
		#------------------------------------------------Otras-------------------------------------------------#
		#------------------------------------------------------------------------------------------------------#

		

		protected function limpiarPropiedades()
		{
			
			$this->id_tmovimiento=0;
			$this->id_ticket='';
			$this->fecha='';
			$this->id_estatus='';
			$this->id_origen='';
			$this->id_asignado='';
		}

		

		
		protected function Insertar()
		{
			try
			{
				$SQL="INSERT INTO ticket_movimiento(id_ticket,fecha,id_estatus,id_origen,id_asignado)
						VALUES('" . mysqli_real_escape_string($this->dbLink,$this->id_ticket) . "','" . mysqli_real_escape_string($this->dbLink,$this->fecha) . "','" . mysqli_real_escape_string($this->dbLink,$this->id_estatus) . "','" . mysqli_real_escape_string($this->dbLink,$this->id_origen) . "','" . mysqli_real_escape_string($this->dbLink,$this->id_asignado) . "')";
				$result=mysqli_query($this->dbLink,$SQL);
				if(!$result)
					return $this->setSystemError("Error en la insercion de registro.","[" . $SQL . "][" . mysqli_error($this->dbLink) . "][ModeloBaseTicket_movimiento::Insertar]");
				
				$this->id_tmovimiento=mysqli_insert_id($this->dbLink);
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
				$SQL="UPDATE ticket_movimiento SET id_ticket='" . mysqli_real_escape_string($this->dbLink,$this->id_ticket) . "',fecha='" . mysqli_real_escape_string($this->dbLink,$this->fecha) . "',id_estatus='" . mysqli_real_escape_string($this->dbLink,$this->id_estatus) . "',id_origen='" . mysqli_real_escape_string($this->dbLink,$this->id_origen) . "',id_asignado='" . mysqli_real_escape_string($this->dbLink,$this->id_asignado) . "'
					WHERE id_tmovimiento=" . $this->id_tmovimiento;
				
				$result=mysqli_query($this->dbLink,$SQL);
				if(!$result)
					return $this->setSystemError("Error en la actualizacion de registro.","[" . $SQL . "][" . mysqli_error() . "][ModeloBaseTicket_movimiento::Update]");
				
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
				$SQL="DELETE FROM ticket_movimiento
				WHERE id_tmovimiento=" . mysqli_real_escape_string($this->dbLink,$this->id_tmovimiento);
				$result=mysqli_query($this->dbLink,$SQL);
				if(!$result)
					return $this->setSystemError("Error en el borrado de registro.","[" . $SQL . "][" . mysqli_error() . "][ModeloBaseTicket_movimiento::Borrar]");
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
						id_tmovimiento,id_ticket,fecha,id_estatus,id_origen,id_asignado
					FROM ticket_movimiento
					WHERE id_tmovimiento=" . mysqli_real_escape_string($this->dbLink,$this->id_tmovimiento);
					
				$result=mysqli_query($this->dbLink,$SQL);
				if(!$result)
					return $this->setSystemError("Error en la obtencion de detalles de registro.","[ModeloBaseTicket_movimiento::getDatos][" . $SQL . "][" . mysqli_error($this->dbLink) . "]");
				

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
			if($this->id_tmovimiento==0)
				$this->Insertar();
			else
				$this->Actualizar();
			if($this->getError())
				return false;
			return true;
		}
		
	}

?>