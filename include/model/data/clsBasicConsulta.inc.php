<?php
abstract class clsBasicConsulta extends clsBasicCommon
{
	#-----------------------------------------------------------------------------------------------#
	#-------------------------------------------Variables-------------------------------------------#
	#-----------------------------------------------------------------------------------------------#

	var $Pagina=1;
	var $Cantidad=20;
	var $Total=0;
	var $CampoOrden;
	var $Orden="ASC";
	var $Datos=array();



	#-----------------------------------------------------------------------------------------------#
	#------------------------------------Constructor Destructor-------------------------------------#
	#-----------------------------------------------------------------------------------------------#

	public function __construct()
	{
		$__ss=array("Pagina","Cantidad","Total","CampoOrden","Orden","Datos");

		foreach($__ss as $k=>$i)
			$this->__s[]=$i;

		parent::__construct();
	}

	public function __destruct()
	{
		parent::__destruct();
	}

	#-----------------------------------------------------------------------------------------------#
	#-----------------------------------------Setter Getter-----------------------------------------#
	#-----------------------------------------------------------------------------------------------#

	public function setDatos($Datos)
	{
	    $this->Datos = $Datos;
	}

	public function getDatos()
	{
	    return $this->Datos;
	}



	public function getTotalPaginas()
	{
		return ceil($this->Total/$this->Cantidad);
	}

	public function setPagina($Pagina)
	{
		$this->Pagina = $Pagina;
	}

	public function getPagina()
	{
		return $this->Pagina;
	}

	public function setCantidad($Cantidad)
	{
		$this->Cantidad = $Cantidad;
	}

	public function getCantidad()
	{
		return $this->Cantidad;
	}

	public function setTotal($Total)
	{
		$this->Total = $Total;
	}

	public function getTotal()
	{
		return $this->Total;
	}

	public function setCampoOrden($CampoOrden)
	{
		$this->CampoOrden = $CampoOrden;
	}

	public function getCampoOrden()
	{
		return $this->CampoOrden;
	}

	public function setOrden($Orden)
	{
		$this->Orden = $Orden;
	}

	public function setOrdenAsc()
	{
		$this->setOrden("ASC");
	}

	public function setOrdenDesc()
	{
		$this->setOrden("DESC");
	}

	public function getOrden()
	{
		return $this->Orden;
	}

	#-----------------------------------------------------------------------------------------------#
	#-------------------------------------------Acciones--------------------------------------------#
	#-----------------------------------------------------------------------------------------------#



	public function getMostrarTexto()
	{

		return "Mostrando registros del " . ((($this->Pagina-1)*$this->Cantidad)+1) . " al " . ($this->Pagina*$this->Cantidad>$this->Total?$this->Total:$this->Pagina*$this->Cantidad) . " de " . $this->Total;
	}

	public function getMostrarTextoSiguiente()
	{
		return "Mostrando " . ($this->Pagina*$this->Cantidad>$this->Total?$this->Total:$this->Pagina*$this->Cantidad) . " de " . $this->Total;
	}

	abstract public function execute();
	abstract public function getHTML();
	abstract public function getHTMLPaginacion();

}