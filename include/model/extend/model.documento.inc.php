<?php
require FOLDER_MODEL_BASE . "model.base.documento.inc.php";

class ModeloDocumento extends ModeloBaseDocumento
{

    // ------------------------------------------------------------------------------------------------------#
    // ----------------------------------------------Propiedades---------------------------------------------#
    // ------------------------------------------------------------------------------------------------------#
    var $_nombreClase = "ModeloBaseDocumento";

    var $__ss = array();

    // ------------------------------------------------------------------------------------------------------#
    // --------------------------------------------Inicializacion--------------------------------------------#
    // ------------------------------------------------------------------------------------------------------#
    function __construct()
    {
        parent::__construct();
    }

    function __destruct()
    {}

    // ------------------------------------------------------------------------------------------------------#
    // ------------------------------------------------Setter------------------------------------------------#
    // ------------------------------------------------------------------------------------------------------#
    
    // ------------------------------------------------------------------------------------------------------#
    // -----------------------------------------------Unsetter-----------------------------------------------#
    // ------------------------------------------------------------------------------------------------------#
    
    // ------------------------------------------------------------------------------------------------------#
    // ------------------------------------------------Getter------------------------------------------------#
    // ------------------------------------------------------------------------------------------------------#
    
    // ------------------------------------------------------------------------------------------------------#
    // ------------------------------------------------Querys------------------------------------------------#
    // ------------------------------------------------------------------------------------------------------#
    
    // ------------------------------------------------------------------------------------------------------#
    // ------------------------------------------------Otras-------------------------------------------------#
    // ------------------------------------------------------------------------------------------------------#
    public function validarDatos()
    {
        return true;
    }

    public function getListadoDocumentos()
    {
        $SQL = "SELECT iddocumento,descripcion,clave FROM documento ";
        
        $arrDocs = array();
        
        $result = mysqli_query($this->dbLink, $SQL);
        if (! $result)
            return $this->setSystemError("Error en la obtencion de detalles de registro.", "[ModeloDocumento::][" . $SQL . "][" . mysqli_error($this->dbLink) . "]");
        
        if (mysqli_num_rows($result) > 0) {
            while ($row_inf = mysqli_fetch_assoc($result))
                $arrDocs[$row_inf['clave']] = array(
                    'id' => $row_inf['iddocumento'],
                    'nombre' => $row_inf['descripcion']
                );
        }
        
        return $arrDocs;
    }
}
