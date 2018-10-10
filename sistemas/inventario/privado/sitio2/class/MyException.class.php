<?php
require_once('Configuracion.class.php');
require_once('Utilidades.class.php');
/**
 * @package
 * Archivo : MyException.class.php
 * @link 
 * @copyright
 * @autor EDWIN GUAMAN
 * @since fecha 17/08/2016
 * version 1.0.1
 * Descripcion Clase que encapsula y controla todo lo relacionado con las excepciones

*/
class MyException{
	private $_estado;
	private $_mensaje;
	
	public function getEstado(){
		return $this->_estado;
	}
	
	public function getMensaje(){
		return $this->_mensaje;
	}
    
	public function setEstado($estado){
		$this->_estado=$estado;
		return true;
	}
	
	public function addError($value){
		$this->_mensaje[] = $value;
		if (Configuracion::$debug==1){
			if (strlen($value["admin"])!=0){
				Utilidades::enviarCorreo(Configuracion::$debug_user,array(),Utilidades::nombreServer()." - ".Configuracion::$debug_titulo,$value["admin"],"","","","milano");
			}
		}
	}
	
	public function __construct() {
        $_estado=0;
		$_mensaje=array();
	}

}?>