<?php

	class ModeloBaseServicio_planet_voice extends clsBasicCommon
	{
		#------------------------------------------------------------------------------------------------------#
		#----------------------------------------------Propiedades---------------------------------------------#
		#------------------------------------------------------------------------------------------------------#
		var $_nombreClase="base.ModeloBaseServicio_planet_voice";

		
		var $idServicioPlanetVoice=0;
		var $id_usuario=0;
		var $codigo='';
		var $fecha_solicitud='';
		var $estatus='solicitado';
		var $descripcion='';
		var $tipo='';
		var $plan='';
		var $cantidad=0;
		var $total_numeros=0;
		var $c_ciudad='';
		var $c_pais='';
		var $c_pais_av='';
		var $c_cuidad_av='';
		var $gasto_instalacion='';
		var $descuento_instalacion='';
		var $renta_mensual=0;
		var $plazo='';
		var $terminos_condiciones='';
		var $observaciones='';

		var $__s=array("idServicioPlanetVoice","id_usuario","codigo","fecha_solicitud","estatus","descripcion","tipo","plan","cantidad","total_numeros","c_ciudad","c_pais","c_pais_av","c_cuidad_av","gasto_instalacion","descuento_instalacion","renta_mensual","plazo","terminos_condiciones","observaciones");
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

		
		public function setIdServicioPlanetVoice($idServicioPlanetVoice)
		{
			if($idServicioPlanetVoice==0||$idServicioPlanetVoice==""||!is_numeric($idServicioPlanetVoice)|| (is_string($idServicioPlanetVoice)&&!ctype_digit($idServicioPlanetVoice)))return $this->setError("Tipo de dato incorrecto para idServicioPlanetVoice.");
			$this->idServicioPlanetVoice=$idServicioPlanetVoice;
			$this->getDatos();
		}
		public function setId_usuario($id_usuario)
		{
			
			$this->id_usuario=$id_usuario;
		}
		public function setCodigo($codigo)
		{
			
			$this->codigo=$codigo;
		}
		public function setFecha_solicitud($fecha_solicitud)
		{
			$this->fecha_solicitud=$fecha_solicitud;
		}
		public function setEstatus($estatus)
		{
			
			$this->estatus=$estatus;
		}
		public function setEstatusSolicitado()
		{
			$this->estatus='solicitado';
		}
		public function setEstatusActivado()
		{
			$this->estatus='activado';
		}
		public function setDescripcion($descripcion)
		{
			$this->descripcion=$descripcion;
		}
		public function setTipo($tipo)
		{
			
			$this->tipo=$tipo;
		}
		public function setTipoTroncal()
		{
			$this->tipo='Troncal';
		}
		public function setTipoNumeracion()
		{
			$this->tipo='Numeracion';
		}
		public function setPlan($plan)
		{
			
			$this->plan=$plan;
		}
		public function setPlanEMP_MX()
		{
			$this->plan='EMP-MX';
		}
		public function setPlanEMP_MX_ILM()
		{
			$this->plan='EMP-MX-ILM';
		}
		public function setPlanCC_MX_01()
		{
			$this->plan='CC-MX-01';
		}
		public function setCantidad($cantidad)
		{
			
			$this->cantidad=$cantidad;
		}
		public function setTotal_numeros($total_numeros)
		{
			
			$this->total_numeros=$total_numeros;
		}
		public function setC_ciudad($c_ciudad)
		{
			
			$this->c_ciudad=$c_ciudad;
		}
		public function setC_pais($c_pais)
		{
			
			$this->c_pais=$c_pais;
		}
		public function setC_pais_av($c_pais_av)
		{
			
			$this->c_pais_av=$c_pais_av;
		}
		public function setC_cuidad_av($c_cuidad_av)
		{
			
			$this->c_cuidad_av=$c_cuidad_av;
		}
		public function setGasto_instalacion($gasto_instalacion)
		{
			$this->gasto_instalacion=$gasto_instalacion;
		}
		public function setDescuento_instalacion($descuento_instalacion)
		{
			$this->descuento_instalacion=$descuento_instalacion;
		}
		public function setRenta_mensual($renta_mensual)
		{
			
			$this->renta_mensual=$renta_mensual;
		}
		public function setPlazo($plazo)
		{
			
			$this->plazo=$plazo;
		}
		public function setPlazo6()
		{
			$this->plazo='6';
		}
		public function setPlazo12()
		{
			$this->plazo='12';
		}
		public function setPlazo24()
		{
			$this->plazo='24';
		}
		public function setPlazo36()
		{
			$this->plazo='36';
		}
		public function setPlazo48()
		{
			$this->plazo='48';
		}
		public function setPlazoNA()
		{
			$this->plazo='NA';
		}
		public function setTerminos_condiciones($terminos_condiciones)
		{
			
			$this->terminos_condiciones=$terminos_condiciones;
		}
		public function setObservaciones($observaciones)
		{
			$this->observaciones=$observaciones;
		}

		#------------------------------------------------------------------------------------------------------#
		#-----------------------------------------------Unsetter-----------------------------------------------#
		#------------------------------------------------------------------------------------------------------#

		

		#------------------------------------------------------------------------------------------------------#
		#------------------------------------------------Getter------------------------------------------------#
		#------------------------------------------------------------------------------------------------------#

		
		public function getIdServicioPlanetVoice()
		{
			return $this->idServicioPlanetVoice;
		}
		public function getId_usuario()
		{
			return $this->id_usuario;
		}
		public function getCodigo()
		{
			return $this->codigo;
		}
		public function getFecha_solicitud()
		{
			return $this->fecha_solicitud;
		}
		public function getEstatus()
		{
			return $this->estatus;
		}
		public function getDescripcion()
		{
			return $this->descripcion;
		}
		public function getTipo()
		{
			return $this->tipo;
		}
		public function getPlan()
		{
			return $this->plan;
		}
		public function getCantidad()
		{
			return $this->cantidad;
		}
		public function getTotal_numeros()
		{
			return $this->total_numeros;
		}
		public function getC_ciudad()
		{
			return $this->c_ciudad;
		}
		public function getC_pais()
		{
			return $this->c_pais;
		}
		public function getC_pais_av()
		{
			return $this->c_pais_av;
		}
		public function getC_cuidad_av()
		{
			return $this->c_cuidad_av;
		}
		public function getGasto_instalacion()
		{
			return $this->gasto_instalacion;
		}
		public function getDescuento_instalacion()
		{
			return $this->descuento_instalacion;
		}
		public function getRenta_mensual()
		{
			return $this->renta_mensual;
		}
		public function getPlazo()
		{
			return $this->plazo;
		}
		public function getTerminos_condiciones()
		{
			return $this->terminos_condiciones;
		}
		public function getObservaciones()
		{
			return $this->observaciones;
		}

		#------------------------------------------------------------------------------------------------------#
		#------------------------------------------------Querys------------------------------------------------#
		#------------------------------------------------------------------------------------------------------#

		#------------------------------------------------------------------------------------------------------#
		#------------------------------------------------Otras-------------------------------------------------#
		#------------------------------------------------------------------------------------------------------#

		

		protected function limpiarPropiedades()
		{
			
			$this->idServicioPlanetVoice=0;
			$this->id_usuario=0;
			$this->codigo='';
			$this->fecha_solicitud='';
			$this->estatus='solicitado';
			$this->descripcion='';
			$this->tipo='';
			$this->plan='';
			$this->cantidad=0;
			$this->total_numeros=0;
			$this->c_ciudad='';
			$this->c_pais='';
			$this->c_pais_av='';
			$this->c_cuidad_av='';
			$this->gasto_instalacion='';
			$this->descuento_instalacion='';
			$this->renta_mensual=0;
			$this->plazo='';
			$this->terminos_condiciones='';
			$this->observaciones='';
		}

		

		
		protected function Insertar()
		{
			try
			{
				$SQL="INSERT INTO servicio_planet_voice(id_usuario,codigo,fecha_solicitud,estatus,descripcion,tipo,plan,cantidad,total_numeros,c_ciudad,c_pais,c_pais_av,c_cuidad_av,gasto_instalacion,descuento_instalacion,renta_mensual,plazo,terminos_condiciones,observaciones)
						VALUES('" . mysqli_real_escape_string($this->dbLink,$this->id_usuario) . "','" . mysqli_real_escape_string($this->dbLink,$this->codigo) . "','" . mysqli_real_escape_string($this->dbLink,$this->fecha_solicitud) . "','" . mysqli_real_escape_string($this->dbLink,$this->estatus) . "','" . mysqli_real_escape_string($this->dbLink,$this->descripcion) . "','" . mysqli_real_escape_string($this->dbLink,$this->tipo) . "','" . mysqli_real_escape_string($this->dbLink,$this->plan) . "','" . mysqli_real_escape_string($this->dbLink,$this->cantidad) . "','" . mysqli_real_escape_string($this->dbLink,$this->total_numeros) . "','" . mysqli_real_escape_string($this->dbLink,$this->c_ciudad) . "','" . mysqli_real_escape_string($this->dbLink,$this->c_pais) . "','" . mysqli_real_escape_string($this->dbLink,$this->c_pais_av) . "','" . mysqli_real_escape_string($this->dbLink,$this->c_cuidad_av) . "','" . mysqli_real_escape_string($this->dbLink,$this->gasto_instalacion) . "','" . mysqli_real_escape_string($this->dbLink,$this->descuento_instalacion) . "','" . mysqli_real_escape_string($this->dbLink,$this->renta_mensual) . "','" . mysqli_real_escape_string($this->dbLink,$this->plazo) . "','" . mysqli_real_escape_string($this->dbLink,$this->terminos_condiciones) . "','" . mysqli_real_escape_string($this->dbLink,$this->observaciones) . "')";
				$result=mysqli_query($this->dbLink,$SQL);
				if(!$result)
					return $this->setSystemError("Error en la insercion de registro.","[" . $SQL . "][" . mysqli_error($this->dbLink) . "][ModeloBaseServicio_planet_voice::Insertar]");
				
				$this->idServicioPlanetVoice=mysqli_insert_id($this->dbLink);
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
				$SQL="UPDATE servicio_planet_voice SET id_usuario='" . mysqli_real_escape_string($this->dbLink,$this->id_usuario) . "',codigo='" . mysqli_real_escape_string($this->dbLink,$this->codigo) . "',fecha_solicitud='" . mysqli_real_escape_string($this->dbLink,$this->fecha_solicitud) . "',estatus='" . mysqli_real_escape_string($this->dbLink,$this->estatus) . "',descripcion='" . mysqli_real_escape_string($this->dbLink,$this->descripcion) . "',tipo='" . mysqli_real_escape_string($this->dbLink,$this->tipo) . "',plan='" . mysqli_real_escape_string($this->dbLink,$this->plan) . "',cantidad='" . mysqli_real_escape_string($this->dbLink,$this->cantidad) . "',total_numeros='" . mysqli_real_escape_string($this->dbLink,$this->total_numeros) . "',c_ciudad='" . mysqli_real_escape_string($this->dbLink,$this->c_ciudad) . "',c_pais='" . mysqli_real_escape_string($this->dbLink,$this->c_pais) . "',c_pais_av='" . mysqli_real_escape_string($this->dbLink,$this->c_pais_av) . "',c_cuidad_av='" . mysqli_real_escape_string($this->dbLink,$this->c_cuidad_av) . "',gasto_instalacion='" . mysqli_real_escape_string($this->dbLink,$this->gasto_instalacion) . "',descuento_instalacion='" . mysqli_real_escape_string($this->dbLink,$this->descuento_instalacion) . "',renta_mensual='" . mysqli_real_escape_string($this->dbLink,$this->renta_mensual) . "',plazo='" . mysqli_real_escape_string($this->dbLink,$this->plazo) . "',terminos_condiciones='" . mysqli_real_escape_string($this->dbLink,$this->terminos_condiciones) . "',observaciones='" . mysqli_real_escape_string($this->dbLink,$this->observaciones) . "'
					WHERE idServicioPlanetVoice=" . $this->idServicioPlanetVoice;
				
				$result=mysqli_query($this->dbLink,$SQL);
				if(!$result)
					return $this->setSystemError("Error en la actualizacion de registro.","[" . $SQL . "][" . mysqli_error() . "][ModeloBaseServicio_planet_voice::Update]");
				
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
				$SQL="DELETE FROM servicio_planet_voice
				WHERE idServicioPlanetVoice=" . mysqli_real_escape_string($this->dbLink,$this->idServicioPlanetVoice);
				$result=mysqli_query($this->dbLink,$SQL);
				if(!$result)
					return $this->setSystemError("Error en el borrado de registro.","[" . $SQL . "][" . mysqli_error() . "][ModeloBaseServicio_planet_voice::Borrar]");
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
						idServicioPlanetVoice,id_usuario,codigo,fecha_solicitud,estatus,descripcion,tipo,plan,cantidad,total_numeros,c_ciudad,c_pais,c_pais_av,c_cuidad_av,gasto_instalacion,descuento_instalacion,renta_mensual,plazo,terminos_condiciones,observaciones
					FROM servicio_planet_voice
					WHERE idServicioPlanetVoice=" . mysqli_real_escape_string($this->dbLink,$this->idServicioPlanetVoice);
					
				$result=mysqli_query($this->dbLink,$SQL);
				if(!$result)
					return $this->setSystemError("Error en la obtencion de detalles de registro.","[ModeloBaseServicio_planet_voice::getDatos][" . $SQL . "][" . mysqli_error($this->dbLink) . "]");
				

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
			if($this->idServicioPlanetVoice==0)
				$this->Insertar();
			else
				$this->Actualizar();
			if($this->getError())
				return false;
			return true;
		}
		
	}

?>