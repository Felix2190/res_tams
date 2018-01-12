<?php

	class ModeloBaseAlmacentraslado extends clsBasicCommon
	{
		#------------------------------------------------------------------------------------------------------#
		#----------------------------------------------Propiedades---------------------------------------------#
		#------------------------------------------------------------------------------------------------------#
		var $_nombreClase="base.ModeloBaseAlmacentraslado";

		
		var $idalmacenTraslado=0;
		var $idalmacen=0;
		var $fechaAlta='';
		var $folio='';
		var $idLoginMemberSalida=0;
		var $nombreLoginMemberSalida='';
		var $tipo='salida';
		var $idUbicacion=0;
		var $idUbicacionNueva=0;
		var $comentariosSalida='';
		var $comentariosEntrada='';
		var $estatus='disponible';
		var $idLoginMemberRecepcion=0;
		var $nombreLoginMemberRecepcion='';
		var $fechaRecepcion='';

		var $__s=array("idalmacenTraslado","idalmacen","fechaAlta","folio","idLoginMemberSalida","nombreLoginMemberSalida","tipo","idUbicacion","idUbicacionNueva","comentariosSalida","comentariosEntrada","estatus","idLoginMemberRecepcion","nombreLoginMemberRecepcion","fechaRecepcion");
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

		
		public function setIdalmacenTraslado($idalmacenTraslado)
		{
			if($idalmacenTraslado==0||$idalmacenTraslado==""||!is_numeric($idalmacenTraslado)|| (is_string($idalmacenTraslado)&&!ctype_digit($idalmacenTraslado)))return $this->setError("Tipo de dato incorrecto para idalmacenTraslado.");
			$this->idalmacenTraslado=$idalmacenTraslado;
			$this->getDatos();
		}
		public function setIdalmacen($idalmacen)
		{
			
			$this->idalmacen=$idalmacen;
		}
		public function setFechaAlta($fechaAlta)
		{
			$this->fechaAlta=$fechaAlta;
		}
		public function setFolio($folio)
		{
			
			$this->folio=$folio;
		}
		public function setIdLoginMemberSalida($idLoginMemberSalida)
		{
			
			$this->idLoginMemberSalida=$idLoginMemberSalida;
		}
		public function setNombreLoginMemberSalida($nombreLoginMemberSalida)
		{
			
			$this->nombreLoginMemberSalida=$nombreLoginMemberSalida;
		}
		public function setTipo($tipo)
		{
			
			$this->tipo=$tipo;
		}
		public function setTipoSalida()
		{
			$this->tipo='salida';
		}
		public function setTipoEntrada()
		{
			$this->tipo='entrada';
		}
		public function setIdUbicacion($idUbicacion)
		{
			
			$this->idUbicacion=$idUbicacion;
		}
		public function setIdUbicacionNueva($idUbicacionNueva)
		{
			
			$this->idUbicacionNueva=$idUbicacionNueva;
		}
		public function setComentariosSalida($comentariosSalida)
		{
			$this->comentariosSalida=$comentariosSalida;
		}
		public function setComentariosEntrada($comentariosEntrada)
		{
			$this->comentariosEntrada=$comentariosEntrada;
		}
		public function setEstatus($estatus)
		{
			
			$this->estatus=$estatus;
		}
		public function setEstatusDisponible()
		{
			$this->estatus='disponible';
		}
		public function setEstatusBaja()
		{
			$this->estatus='baja';
		}
		public function setEstatusTraslado()
		{
			$this->estatus='traslado';
		}
		public function setIdLoginMemberRecepcion($idLoginMemberRecepcion)
		{
			
			$this->idLoginMemberRecepcion=$idLoginMemberRecepcion;
		}
		public function setNombreLoginMemberRecepcion($nombreLoginMemberRecepcion)
		{
			
			$this->nombreLoginMemberRecepcion=$nombreLoginMemberRecepcion;
		}
		public function setFechaRecepcion($fechaRecepcion)
		{
			$this->fechaRecepcion=$fechaRecepcion;
		}

		#------------------------------------------------------------------------------------------------------#
		#-----------------------------------------------Unsetter-----------------------------------------------#
		#------------------------------------------------------------------------------------------------------#

		

		#------------------------------------------------------------------------------------------------------#
		#------------------------------------------------Getter------------------------------------------------#
		#------------------------------------------------------------------------------------------------------#

		
		public function getIdalmacenTraslado()
		{
			return $this->idalmacenTraslado;
		}
		public function getIdalmacen()
		{
			return $this->idalmacen;
		}
		public function getFechaAlta()
		{
			return $this->fechaAlta;
		}
		public function getFolio()
		{
			return $this->folio;
		}
		public function getIdLoginMemberSalida()
		{
			return $this->idLoginMemberSalida;
		}
		public function getNombreLoginMemberSalida()
		{
			return $this->nombreLoginMemberSalida;
		}
		public function getTipo()
		{
			return $this->tipo;
		}
		public function getIdUbicacion()
		{
			return $this->idUbicacion;
		}
		public function getIdUbicacionNueva()
		{
			return $this->idUbicacionNueva;
		}
		public function getComentariosSalida()
		{
			return $this->comentariosSalida;
		}
		public function getComentariosEntrada()
		{
			return $this->comentariosEntrada;
		}
		public function getEstatus()
		{
			return $this->estatus;
		}
		public function getIdLoginMemberRecepcion()
		{
			return $this->idLoginMemberRecepcion;
		}
		public function getNombreLoginMemberRecepcion()
		{
			return $this->nombreLoginMemberRecepcion;
		}
		public function getFechaRecepcion()
		{
			return $this->fechaRecepcion;
		}

		#------------------------------------------------------------------------------------------------------#
		#------------------------------------------------Querys------------------------------------------------#
		#------------------------------------------------------------------------------------------------------#

		#------------------------------------------------------------------------------------------------------#
		#------------------------------------------------Otras-------------------------------------------------#
		#------------------------------------------------------------------------------------------------------#

		

		protected function limpiarPropiedades()
		{
			
			$this->idalmacenTraslado=0;
			$this->idalmacen=0;
			$this->fechaAlta='';
			$this->folio='';
			$this->idLoginMemberSalida=0;
			$this->nombreLoginMemberSalida='';
			$this->tipo='salida';
			$this->idUbicacion=0;
			$this->idUbicacionNueva=0;
			$this->comentariosSalida='';
			$this->comentariosEntrada='';
			$this->estatus='disponible';
			$this->idLoginMemberRecepcion=0;
			$this->nombreLoginMemberRecepcion='';
			$this->fechaRecepcion='';
		}

		

		
		protected function Insertar()
		{
			try
			{
				$SQL="INSERT INTO almacentraslado(idalmacen,fechaAlta,folio,idLoginMemberSalida,nombreLoginMemberSalida,tipo,idUbicacion,idUbicacionNueva,comentariosSalida,comentariosEntrada,estatus,idLoginMemberRecepcion,nombreLoginMemberRecepcion,fechaRecepcion)
						VALUES('" . mysqli_real_escape_string($this->dbLink,$this->idalmacen) . "','" . mysqli_real_escape_string($this->dbLink,$this->fechaAlta) . "','" . mysqli_real_escape_string($this->dbLink,$this->folio) . "','" . mysqli_real_escape_string($this->dbLink,$this->idLoginMemberSalida) . "','" . mysqli_real_escape_string($this->dbLink,$this->nombreLoginMemberSalida) . "','" . mysqli_real_escape_string($this->dbLink,$this->tipo) . "','" . mysqli_real_escape_string($this->dbLink,$this->idUbicacion) . "','" . mysqli_real_escape_string($this->dbLink,$this->idUbicacionNueva) . "','" . mysqli_real_escape_string($this->dbLink,$this->comentariosSalida) . "','" . mysqli_real_escape_string($this->dbLink,$this->comentariosEntrada) . "','" . mysqli_real_escape_string($this->dbLink,$this->estatus) . "','" . mysqli_real_escape_string($this->dbLink,$this->idLoginMemberRecepcion) . "','" . mysqli_real_escape_string($this->dbLink,$this->nombreLoginMemberRecepcion) . "','" . mysqli_real_escape_string($this->dbLink,$this->fechaRecepcion) . "')";
				$result=mysqli_query($this->dbLink,$SQL);
				if(!$result)
					return $this->setSystemError("Error en la insercion de registro.","[" . $SQL . "][" . mysqli_error($this->dbLink) . "][ModeloBaseAlmacentraslado::Insertar]");
				
				$this->idalmacenTraslado=mysqli_insert_id($this->dbLink);
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
				$SQL="UPDATE almacentraslado SET idalmacen='" . mysqli_real_escape_string($this->dbLink,$this->idalmacen) . "',fechaAlta='" . mysqli_real_escape_string($this->dbLink,$this->fechaAlta) . "',folio='" . mysqli_real_escape_string($this->dbLink,$this->folio) . "',idLoginMemberSalida='" . mysqli_real_escape_string($this->dbLink,$this->idLoginMemberSalida) . "',nombreLoginMemberSalida='" . mysqli_real_escape_string($this->dbLink,$this->nombreLoginMemberSalida) . "',tipo='" . mysqli_real_escape_string($this->dbLink,$this->tipo) . "',idUbicacion='" . mysqli_real_escape_string($this->dbLink,$this->idUbicacion) . "',idUbicacionNueva='" . mysqli_real_escape_string($this->dbLink,$this->idUbicacionNueva) . "',comentariosSalida='" . mysqli_real_escape_string($this->dbLink,$this->comentariosSalida) . "',comentariosEntrada='" . mysqli_real_escape_string($this->dbLink,$this->comentariosEntrada) . "',estatus='" . mysqli_real_escape_string($this->dbLink,$this->estatus) . "',idLoginMemberRecepcion='" . mysqli_real_escape_string($this->dbLink,$this->idLoginMemberRecepcion) . "',nombreLoginMemberRecepcion='" . mysqli_real_escape_string($this->dbLink,$this->nombreLoginMemberRecepcion) . "',fechaRecepcion='" . mysqli_real_escape_string($this->dbLink,$this->fechaRecepcion) . "'
					WHERE idalmacenTraslado=" . $this->idalmacenTraslado;
				
				$result=mysqli_query($this->dbLink,$SQL);
				if(!$result)
					return $this->setSystemError("Error en la actualizacion de registro.","[" . $SQL . "][" . mysqli_error() . "][ModeloBaseAlmacentraslado::Update]");
				
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
				$SQL="DELETE FROM almacentraslado
				WHERE idalmacenTraslado=" . mysqli_real_escape_string($this->dbLink,$this->idalmacenTraslado);
				$result=mysqli_query($this->dbLink,$SQL);
				if(!$result)
					return $this->setSystemError("Error en el borrado de registro.","[" . $SQL . "][" . mysqli_error() . "][ModeloBaseAlmacentraslado::Borrar]");
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
						idalmacenTraslado,idalmacen,fechaAlta,folio,idLoginMemberSalida,nombreLoginMemberSalida,tipo,idUbicacion,idUbicacionNueva,comentariosSalida,comentariosEntrada,estatus,idLoginMemberRecepcion,nombreLoginMemberRecepcion,fechaRecepcion
					FROM almacentraslado
					WHERE idalmacenTraslado=" . mysqli_real_escape_string($this->dbLink,$this->idalmacenTraslado);
					
				$result=mysqli_query($this->dbLink,$SQL);
				if(!$result)
					return $this->setSystemError("Error en la obtencion de detalles de registro.","[ModeloBaseAlmacentraslado::getDatos][" . $SQL . "][" . mysqli_error($this->dbLink) . "]");
				

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
			if($this->idalmacenTraslado==0)
				$this->Insertar();
			else
				$this->Actualizar();
			if($this->getError())
				return false;
			return true;
		}
		
	}

?>