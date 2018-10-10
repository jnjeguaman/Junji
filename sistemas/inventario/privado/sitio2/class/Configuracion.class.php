<?php
class Configuracion{
	

  	static $host_bd_segfac='192.168.100.237';
  	static $name_bd_segfac='junji_segfac';
	static $user_bd_segfac='admin';
	static $pass_bd_segfac='Hol@1234';
	static $port_bd_maestro_segfac='3306';
	static $port_bd_replica_segfac='3306';

	static $host_bd_inventario='192.168.100.237';
  	static $name_bd_inventario='junji_inventario';
	static $user_bd_inventario='admin';
	static $pass_bd_inventario='Hol@1234';
	static $port_bd_maestro_inventario='3306';
	static $port_bd_replica_inventario='3306';
		
	#Datos del server de correo milano
	static $mail_milano_Host='192.168.100.34';
	static $mail_milano_User='inedis_junji@junji.cl';
	static $mail_milano_Pass='';
	static $mail_milano_From_name ='***** SINSEGUN *****';
	static $mail_milano_From='inedis_junji@junji.cl';
	
	#Depuración del sistema
	static $debug=0;  /* 1 indica que se envian notificaciones via email 0 no envia nada. */
	static $debug_titulo="SINGEJUN - Debug Report";
	static public $debug_user=array(
		array("email"=>"eguaman@plataformagroup.cl","nombre"=>"Edwin Guaman")
	);

	#slave
	static $servidor_esclavo=0;  /* 1 indica que se usan los slaves 0 no se usan los slaves. */

	
	#Paginadores
	static public $MAXREGSPERPAGE   = 3; #Cantidad Maxima de registros por pagina
  	static public $MAXPAGESPERPAGER = 10; #Cantidad Maxima de paginas mostradas por el paginador
	static public $MAXREGSPERPAGE_portal   = 7; #Cantidad Maxima de registros por pagina
  	static public $MAXPAGESPERPAGER_portal = 10; #Cantidad Maxima de paginas mostradas por el paginador

}
?>
