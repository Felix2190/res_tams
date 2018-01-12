<?php

	class ModeloBaseProducto extends clsBasicCommon
	{
		#------------------------------------------------------------------------------------------------------#
		#----------------------------------------------Propiedades---------------------------------------------#
		#------------------------------------------------------------------------------------------------------#
		var $_nombreClase="base.ModeloBaseProducto";

		
		var $idproducto=0;
		var $idLoginMember=0;
		var $codigo='';
		var $nombre='';
		var $descripcion='';
		var $brochure='';
		var $foto='';
		var $tipo='producto';
		var $costoOrigen='';
		var $costoFOBMXUS='';
		var $CostoMXN='';
		var $margenPesos='';
		var $margenPorcentaje=0;
		var $precioVenta='';
		var $Inventariable='si';
		var $comisionMaxima=0;
		var $descuentoMaximo='';
		var $estatus='disponible';
		var $unidadesDisponibles=0;
		var $numeroSerie='';
		var $idUbicacion=0;
		var $fechaBaja='';

		var $__s=array("idproducto","idLoginMember","codigo","nombre","descripcion","brochure","foto","tipo","costoOrigen","costoFOBMXUS","CostoMXN","margenPesos","margenPorcentaje","precioVenta","Inventariable","comisionMaxima","descuentoMaximo","estatus","unidadesDisponibles","numeroSerie","idUbicacion","fechaBaja");
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

		
		public function setIdproducto($idproducto)
		{
			if($idproducto==0||$idproducto==""||!is_numeric($idproducto)|| (is_string($idproducto)&&!ctype_digit($idproducto)))return $this->setError("Tipo de dato incorrecto para idproducto.");
			$this->idproducto=$idproducto;
			$this->getDatos();
		}
		public function setIdLoginMember($idLoginMember)
		{
			
			$this->idLoginMember=$idLoginMember;
		}
		public function setCodigo($codigo)
		{
			
			$this->codigo=$codigo;
		}
		public function setNombre($nombre)
		{
			
			$this->nombre=$nombre;
		}
		public function setDescripcion($descripcion)
		{
			
			$this->descripcion=$descripcion;
		}
		public function setBrochure($brochure)
		{
			
			$this->brochure=$brochure;
		}
		public function setFoto($foto)
		{
			
			$this->foto=$foto;
		}
		public function setTipo($tipo)
		{
			
			$this->tipo=$tipo;
		}
		public function setTipoProducto()
		{
			$this->tipo='producto';
		}
		public function setTipoServicio()
		{
			$this->tipo='servicio';
		}
		public function setCostoOrigen($costoOrigen)
		{
			$this->costoOrigen=$costoOrigen;
		}
		public function setCostoFOBMXUS($costoFOBMXUS)
		{
			$this->costoFOBMXUS=$costoFOBMXUS;
		}
		public function setCostoMXN($CostoMXN)
		{
			$this->CostoMXN=$CostoMXN;
		}
		public function setMargenPesos($margenPesos)
		{
			$this->margenPesos=$margenPesos;
		}
		public function setMargenPorcentaje($margenPorcentaje)
		{
			
			$this->margenPorcentaje=$margenPorcentaje;
		}
		public function setPrecioVenta($precioVenta)
		{
			$this->precioVenta=$precioVenta;
		}
		public function setInventariable($Inventariable)
		{
			
			$this->Inventariable=$Inventariable;
		}
		public function setInventariableSi()
		{
			$this->Inventariable='si';
		}
		public function setInventariableNo()
		{
			$this->Inventariable='no';
		}
		public function setComisionMaxima($comisionMaxima)
		{
			
			$this->comisionMaxima=$comisionMaxima;
		}
		public function setDescuentoMaximo($descuentoMaximo)
		{
			$this->descuentoMaximo=$descuentoMaximo;
		}
		public function setEstatus($estatus)
		{
			
			$this->estatus=$estatus;
		}
		public function setEstatusDisponible()
		{
			$this->estatus='disponible';
		}
		public function setEstatusAgotado()
		{
			$this->estatus='agotado';
		}
		public function setEstatusBaja()
		{
			$this->estatus='baja';
		}
		public function setUnidadesDisponibles($unidadesDisponibles)
		{
			
			$this->unidadesDisponibles=$unidadesDisponibles;
		}
		public function setNumeroSerie($numeroSerie)
		{
			
			$this->numeroSerie=$numeroSerie;
		}
		public function setIdUbicacion($idUbicacion)
		{
			
			$this->idUbicacion=$idUbicacion;
		}
		public function setFechaBaja($fechaBaja)
		{
			$this->fechaBaja=$fechaBaja;
		}

		#------------------------------------------------------------------------------------------------------#
		#-----------------------------------------------Unsetter-----------------------------------------------#
		#------------------------------------------------------------------------------------------------------#

		

		#------------------------------------------------------------------------------------------------------#
		#------------------------------------------------Getter------------------------------------------------#
		#------------------------------------------------------------------------------------------------------#

		
		public function getIdproducto()
		{
			return $this->idproducto;
		}
		public function getIdLoginMember()
		{
			return $this->idLoginMember;
		}
		public function getCodigo()
		{
			return $this->codigo;
		}
		public function getNombre()
		{
			return $this->nombre;
		}
		public function getDescripcion()
		{
			return $this->descripcion;
		}
		public function getBrochure()
		{
			return $this->brochure;
		}
		public function getFoto()
		{
			return $this->foto;
		}
		public function getTipo()
		{
			return $this->tipo;
		}
		public function getCostoOrigen()
		{
			return $this->costoOrigen;
		}
		public function getCostoFOBMXUS()
		{
			return $this->costoFOBMXUS;
		}
		public function getCostoMXN()
		{
			return $this->CostoMXN;
		}
		public function getMargenPesos()
		{
			return $this->margenPesos;
		}
		public function getMargenPorcentaje()
		{
			return $this->margenPorcentaje;
		}
		public function getPrecioVenta()
		{
			return $this->precioVenta;
		}
		public function getInventariable()
		{
			return $this->Inventariable;
		}
		public function getComisionMaxima()
		{
			return $this->comisionMaxima;
		}
		public function getDescuentoMaximo()
		{
			return $this->descuentoMaximo;
		}
		public function getEstatus()
		{
			return $this->estatus;
		}
		public function getUnidadesDisponibles()
		{
			return $this->unidadesDisponibles;
		}
		public function getNumeroSerie()
		{
			return $this->numeroSerie;
		}
		public function getIdUbicacion()
		{
			return $this->idUbicacion;
		}
		public function getFechaBaja()
		{
			return $this->fechaBaja;
		}

		#------------------------------------------------------------------------------------------------------#
		#------------------------------------------------Querys------------------------------------------------#
		#------------------------------------------------------------------------------------------------------#

		#------------------------------------------------------------------------------------------------------#
		#------------------------------------------------Otras-------------------------------------------------#
		#------------------------------------------------------------------------------------------------------#

		

		protected function limpiarPropiedades()
		{
			
			$this->idproducto=0;
			$this->idLoginMember=0;
			$this->codigo='';
			$this->nombre='';
			$this->descripcion='';
			$this->brochure='';
			$this->foto='';
			$this->tipo='producto';
			$this->costoOrigen='';
			$this->costoFOBMXUS='';
			$this->CostoMXN='';
			$this->margenPesos='';
			$this->margenPorcentaje=0;
			$this->precioVenta='';
			$this->Inventariable='si';
			$this->comisionMaxima=0;
			$this->descuentoMaximo='';
			$this->estatus='disponible';
			$this->unidadesDisponibles=0;
			$this->numeroSerie='';
			$this->idUbicacion=0;
			$this->fechaBaja='';
		}

		

		
		protected function Insertar()
		{
			try
			{
				$SQL="INSERT INTO producto(idLoginMember,codigo,nombre,descripcion,brochure,foto,tipo,costoOrigen,costoFOBMXUS,CostoMXN,margenPesos,margenPorcentaje,precioVenta,Inventariable,comisionMaxima,descuentoMaximo,estatus,unidadesDisponibles,numeroSerie,idUbicacion,fechaBaja)
						VALUES('" . mysqli_real_escape_string($this->dbLink,$this->idLoginMember) . "','" . mysqli_real_escape_string($this->dbLink,$this->codigo) . "','" . mysqli_real_escape_string($this->dbLink,$this->nombre) . "','" . mysqli_real_escape_string($this->dbLink,$this->descripcion) . "','" . mysqli_real_escape_string($this->dbLink,$this->brochure) . "','" . mysqli_real_escape_string($this->dbLink,$this->foto) . "','" . mysqli_real_escape_string($this->dbLink,$this->tipo) . "','" . mysqli_real_escape_string($this->dbLink,$this->costoOrigen) . "','" . mysqli_real_escape_string($this->dbLink,$this->costoFOBMXUS) . "','" . mysqli_real_escape_string($this->dbLink,$this->CostoMXN) . "','" . mysqli_real_escape_string($this->dbLink,$this->margenPesos) . "','" . mysqli_real_escape_string($this->dbLink,$this->margenPorcentaje) . "','" . mysqli_real_escape_string($this->dbLink,$this->precioVenta) . "','" . mysqli_real_escape_string($this->dbLink,$this->Inventariable) . "','" . mysqli_real_escape_string($this->dbLink,$this->comisionMaxima) . "','" . mysqli_real_escape_string($this->dbLink,$this->descuentoMaximo) . "','" . mysqli_real_escape_string($this->dbLink,$this->estatus) . "','" . mysqli_real_escape_string($this->dbLink,$this->unidadesDisponibles) . "','" . mysqli_real_escape_string($this->dbLink,$this->numeroSerie) . "','" . mysqli_real_escape_string($this->dbLink,$this->idUbicacion) . "','" . mysqli_real_escape_string($this->dbLink,$this->fechaBaja) . "')";
				$result=mysqli_query($this->dbLink,$SQL);
				if(!$result)
					return $this->setSystemError("Error en la insercion de registro.","[" . $SQL . "][" . mysqli_error($this->dbLink) . "][ModeloBaseProducto::Insertar]");
				
				$this->idproducto=mysqli_insert_id($this->dbLink);
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
				$SQL="UPDATE producto SET idLoginMember='" . mysqli_real_escape_string($this->dbLink,$this->idLoginMember) . "',codigo='" . mysqli_real_escape_string($this->dbLink,$this->codigo) . "',nombre='" . mysqli_real_escape_string($this->dbLink,$this->nombre) . "',descripcion='" . mysqli_real_escape_string($this->dbLink,$this->descripcion) . "',brochure='" . mysqli_real_escape_string($this->dbLink,$this->brochure) . "',foto='" . mysqli_real_escape_string($this->dbLink,$this->foto) . "',tipo='" . mysqli_real_escape_string($this->dbLink,$this->tipo) . "',costoOrigen='" . mysqli_real_escape_string($this->dbLink,$this->costoOrigen) . "',costoFOBMXUS='" . mysqli_real_escape_string($this->dbLink,$this->costoFOBMXUS) . "',CostoMXN='" . mysqli_real_escape_string($this->dbLink,$this->CostoMXN) . "',margenPesos='" . mysqli_real_escape_string($this->dbLink,$this->margenPesos) . "',margenPorcentaje='" . mysqli_real_escape_string($this->dbLink,$this->margenPorcentaje) . "',precioVenta='" . mysqli_real_escape_string($this->dbLink,$this->precioVenta) . "',Inventariable='" . mysqli_real_escape_string($this->dbLink,$this->Inventariable) . "',comisionMaxima='" . mysqli_real_escape_string($this->dbLink,$this->comisionMaxima) . "',descuentoMaximo='" . mysqli_real_escape_string($this->dbLink,$this->descuentoMaximo) . "',estatus='" . mysqli_real_escape_string($this->dbLink,$this->estatus) . "',unidadesDisponibles='" . mysqli_real_escape_string($this->dbLink,$this->unidadesDisponibles) . "',numeroSerie='" . mysqli_real_escape_string($this->dbLink,$this->numeroSerie) . "',idUbicacion='" . mysqli_real_escape_string($this->dbLink,$this->idUbicacion) . "',fechaBaja='" . mysqli_real_escape_string($this->dbLink,$this->fechaBaja) . "'
					WHERE idproducto=" . $this->idproducto;
				
				$result=mysqli_query($this->dbLink,$SQL);
				if(!$result)
					return $this->setSystemError("Error en la actualizacion de registro.","[" . $SQL . "][" . mysqli_error() . "][ModeloBaseProducto::Update]");
				
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
				$SQL="DELETE FROM producto
				WHERE idproducto=" . mysqli_real_escape_string($this->dbLink,$this->idproducto);
				$result=mysqli_query($this->dbLink,$SQL);
				if(!$result)
					return $this->setSystemError("Error en el borrado de registro.","[" . $SQL . "][" . mysqli_error() . "][ModeloBaseProducto::Borrar]");
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
						idproducto,idLoginMember,codigo,nombre,descripcion,brochure,foto,tipo,costoOrigen,costoFOBMXUS,CostoMXN,margenPesos,margenPorcentaje,precioVenta,Inventariable,comisionMaxima,descuentoMaximo,estatus,unidadesDisponibles,numeroSerie,idUbicacion,fechaBaja
					FROM producto
					WHERE idproducto=" . mysqli_real_escape_string($this->dbLink,$this->idproducto);
					
				$result=mysqli_query($this->dbLink,$SQL);
				if(!$result)
					return $this->setSystemError("Error en la obtencion de detalles de registro.","[ModeloBaseProducto::getDatos][" . $SQL . "][" . mysqli_error($this->dbLink) . "]");
				

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
			if($this->idproducto==0)
				$this->Insertar();
			else
				$this->Actualizar();
			if($this->getError())
				return false;
			return true;
		}
		
	}

?>