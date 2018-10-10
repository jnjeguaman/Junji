<?
require_once('Configuracion.class.php');
require_once('Utilidades.class.php');
require_once('MyException.class.php');
/**
 * @package
 * Archivo : BD.class.php
 * @link 
 * @copyright
 * @autor EDWIN GUAMAN
 * @since fecha 17/08/2016
 * version 1.0.1
 * Descripcion Clase que encapsula todo lo relacionado con la base de datos con PDO 
 
*/
class BDSegfac {
	private $_host;
	private $_dbName;
	private $_user;
	private $_pass;
	private $_db_insert;
	private $_db_select;	
	private $_db_server_name;
	public $myException;

	
	public function error($e,$query=null){
		$trace  = '<table border="1">';
		$trace .='<tr><td colspan="4">NOMBRE SERVER:'.$this->_db_server_name.'</td></tr>';
		$trace .='<tr><td colspan="4">QUERY:'.$query.'</td></tr>';
		$trace .='<tr><td colspan="4"><pre>'.print_r($e,true).'</pre></td></tr>';
		$trace .= '</table>';
		return $trace;
	}
	
	
	public function select($sql,array $parametros,$serverbd=null){
		#si server="master" la query se corre sobre el master
		try{
			$s_parametros="";
			if (strtoupper($serverbd)=="MASTER"){
				$consulta=$this->_db_insert->prepare($sql);
			}else{
				$consulta=$this->_db_select->prepare($sql);
			}
			$consulta->execute($parametros);
			return $consulta;
		}catch (PDOException $e){
			$this->myException->setEstado(1);
			$error=array(
				'user'=>'SE PRODUJO UN ERROR AL CONSULTAR LA BASE DE DATOS.',
				'admin'=>$this->error($e,$sql)
			);
			
			$this->myException->addError($error);
		}catch (Exception $e){
			$this->myException->setEstado(1);
			$error=array(
				'user'=>'SE PRODUJO UN ERROR. FAVOR COMUNICARSE CON EL ADMINISTRADOR DEL SISTEMA.',
				'admin'=>$e->getMessage()."<br>codigo: ".$e->getCode()."<br>linea: ".$e->getLine()."<br>archivo: ".$e->getFile()
			);
			$this->myException->addError($error);
		}
	}
	

	public function insert($tabla,array $parametros){
		try{
			$values="";
			$campos="";
			$linea="";
			$res=0;
			
			foreach ($parametros as $key => $value){				
				if ($values==""){
					if (strtoupper($key)=="CLAVE" or strtoupper($key)=="PASSWORD"){
				    	//$values=$key."=password(:".$key.")";
						$values="password(:".$key.")";
					}elseif (strtoupper($value)=="NOW()" || strtoupper($value)=="CURDATE()" || strtoupper($value)=="CURTIME()"){						
						//$values=$key."=".$value;
						$values=$value;
					}else{
						$values=":".$key;
					}
					$campos=$key;
				}else{
					if (strtoupper($key)=="CLAVE" or strtoupper($key)=="PASSWORD"){
				    	$values=$values.",password(:".$key.")";
					}elseif (strtoupper($value)=="NOW()" || strtoupper($value)=="CURDATE()" || strtoupper($value)=="CURTIME()"){
						$values=$values.",".$value; 							
					}else{
						$values=$values.",:".$key;
					}
					$campos=$campos.",".$key;
				}
												

				if (strtoupper($value)!="NOW()" && strtoupper($value)!="CURDATE()" && strtoupper($value)!="CURTIME()"){
					if ($linea==""){
						$linea='$stmt'."->bindValue(':".$key."', '".addslashes(utf8_decode($value))."');";
					}else{
						$linea=$linea.'$stmt'."->bindValue(':".$key."', '".addslashes(utf8_decode($value))."');";
					}
				}
			}
			
			$sql="insert into ".$tabla." (".$campos.") values (".$values.")";
			$stmt = $this->_db_insert->prepare($sql);
			eval($linea);
			$res=$stmt->execute();
			$err=$stmt->errorInfo();
			if ($err[0]=="00000"){
				return $res;
			}else{
				return 0;
			}
		}catch (PDOException $e){
			$this->myException->setEstado(1);
			$error=array(
			    'user'=>'SE PRODUJO UN ERROR AL INSERTAR EN LA BASE DE DATOS.',
				'admin'=>$this->error($e,$sql)
			);
			$this->myException->addError($error);
		}catch (Exception $e){
			$this->myException->setEstado(1);
			$error=array(
			    'user'=>'SE PRODUJO UN ERROR. FAVOR COMUNICARSE CON EL ADMINISTRADOR DEL SISTEMA.',
			    'admin'=>$e->getMessage()."<br>codigo: ".$e->getCode()."<br>linea: ".$e->getLine()."<br>archivo: ".$e->getFile()
			);
			$this->myException->addError($error);
		}
	}
	
	
	public function update($tabla,array $parametros,array $condicion){
		try{
			$values="";
			$linea="";
			$strwhere="";
			
			foreach ($parametros as $key => $value){
				if ($values==""){
					if (strtoupper($key)=="CLAVE" or strtoupper($key)=="PASSWORD"){
				    	$values=$key."=password(:".$key.")";
					}elseif (strtoupper($value)=="NOW()" || strtoupper($value)=="CURDATE()" || strtoupper($value)=="CURTIME()"){
						$values=$key."=".$value; 
					}else{
						$values=$key."=:".$key;
					}
				}else{
					if (strtoupper($key)=="CLAVE" or strtoupper($key)=="PASSWORD"){
				    	$values=$values.",".$key."=password(:".$key.")";
					}elseif (strtoupper($value)=="NOW()" || strtoupper($value)=="CURDATE()" || strtoupper($value)=="CURTIME()"){
						$values=$values.",".$key."=".$value; 					
					}else{
						$values=$values.",".$key."=:".$key;
					}
				}
				if (strtoupper($value)!="NOW()" && strtoupper($value)!="CURDATE()" && strtoupper($value)!="CURTIME()"){
					if ($linea==""){
							$linea='$stmt'."->bindValue(':".$key."', '".addslashes(utf8_decode($value))."');";
					}else{
							$linea=$linea.'$stmt'."->bindValue(':".$key."', '".addslashes(utf8_decode($value))."');";
					}
				}
			}
			
			foreach ($condicion as $key => $value){
				if ($strwhere==""){
					$strwhere=$key."=:c_".$key;
				}else{
				    $strwhere=$strwhere." and ".$key."=:c_".$key;
				}
				
				if ($linea==""){
					$linea='$stmt'."->bindValue(':c_".$key."', '".$value."');";
				}else{
				    $linea=$linea.'$stmt'."->bindValue(':c_".$key."', '".$value."');";
				}
			}
			
			$sql="update ".$tabla." set ".$values." where ".$strwhere;

			
			$stmt = $this->_db_insert->prepare($sql);
			eval($linea);
			
			
			$stmt->execute();
			$err=$stmt->errorInfo();
			if ($err[0]=="00000"){
				return $stmt->rowCount();
			}else{
				return 0;
			}
		}catch (PDOException $e){
		    $this->myException->setEstado(1);
			$error=array(
			    'user'=>'SE PRODUJO UN ERROR AL ACTUALIZAR EN LA BASE DE DATOS.',
				'admin'=>$this->error($e,$sql)
			);
			$this->myException->addError($error);
		}catch (Exception $e){
			$this->myException->setEstado(1);
			$error=array(
			    'user'=>'SE PRODUJO UN ERROR. FAVOR COMUNICARSE CON EL ADMINISTRADOR DEL SISTEMA.',
				'admin'=>$e->getMessage()."<br>codigo: ".$e->getCode()."<br>linea: ".$e->getLine()."<br>archivo: ".$e->getFile()
			);
			$this->myException->addError($error);
		}
	}

	
	public function delete($tabla,array $condicion){
		try{
			$linea="";
			$strwhere="";
			
			foreach ($condicion as $key => $value){
				if ($strwhere==""){
					$strwhere=$key."=:".$key;
				}else{
				    $strwhere=$strwhere." and ".$key."=:".$key;
				}
				
				if ($linea==""){
					$linea='$stmt'."->bindValue(':".$key."', '".$value."');";
				}else{
				    $linea=$linea.'$stmt'."->bindValue(':".$key."', '".$value."');";
				}
			}
			
			$sql="delete from ".$tabla." where ".$strwhere;
			$stmt = $this->_db_insert->prepare($sql);
			eval($linea);
			$stmt->execute();
			$err=$stmt->errorInfo();
			if ($err[0]=="00000"){
				return $stmt->rowCount();
			}else{
				return 0;
			}
		}catch (PDOException $e){
		    $this->myException->setEstado(1);
			$error=array(
			    'user'=>'SE PRODUJO UN ERROR AL ELIMINAR EN LA BASE DE DATOS.',
				'admin'=>$this->error($e,$sql)
			);
			$this->myException->addError($error);
		}catch (Exception $e){
			$this->myException->setEstado(1);
			$error=array(
			    'user'=>'SE PRODUJO UN ERROR. FAVOR COMUNICARSE CON EL ADMINISTRADOR DEL SISTEMA.',
				'admin'=>$e->getMessage()."<br>codigo: ".$e->getCode()."<br>linea: ".$e->getLine()."<br>archivo: ".$e->getFile()
			);
			$this->myException->addError($error);
		}
	}
	
	
	public function ejecutar($sql,array $parametros){
		try{
			$s_parametros="";
			$consulta=$this->_db_insert->prepare($sql);
			$consulta->execute($parametros);
			
			return $consulta;
		}catch (PDOException $e){
		    $this->myException->setEstado(1);
			$error=array(
			    'user'=>'SE PRODUJO UN ERROR AL CONSULTAR LA BASE DE DATOS.',
				'admin'=>$this->error($e,$sql)
			);
			$this->myException->addError($error);
		}catch (Exception $e){
			$this->myException->setEstado(1);
			$error=array(
			    'user'=>'SE PRODUJO UN ERROR. FAVOR COMUNICARSE CON EL ADMINISTRADOR DEL SISTEMA.',
				'admin'=>$e->getMessage()."<br>codigo: ".$e->getCode()."<br>linea: ".$e->getLine()."<br>archivo: ".$e->getFile()
			);
			$this->myException->addError($error);
		}
	}
	
	
	public function recupera_slave(){
		try{
			$sql="SET GLOBAL SQL_SLAVE_SKIP_COUNTER=1; START SLAVE;";
			$consulta=$this->_db_select->prepare($sql);
			$consulta->execute($parametros);
			return $consulta;
		}catch (PDOException $e){
		   $this->myException->setEstado(1);
			$error=array(
			    'user'=>'SE PRODUJO UN ERROR AL TRATAR DE RECUPERAR EL SLAVE.',
				'admin'=>$this->error($e,$sql)
			);
			$this->myException->addError($error);
		}catch (Exception $e){
			$this->myException->setEstado(1);
			$error=array(
			    'user'=>'SE PRODUJO UN ERROR. FAVOR COMUNICARSE CON EL ADMINISTRADOR DEL SISTEMA.',
				'admin'=>$e->getMessage()."<br>codigo: ".$e->getCode()."<br>linea: ".$e->getLine()."<br>archivo: ".$e->getFile()
			);
			$this->myException->addError($error);
		}
	}
	
	
	public function lastId(){
		try{
		    return $this->_db_insert->lastInsertId();
		}catch (PDOException $e){
		    $this->myException->setEstado(1);
			$error=array(
			    'user'=>'SE PRODUJO UN ERROR AL CONSULTAR EN LA BASE DE DATOS.',
				'admin'=>$this->error($e)
			);
			$this->myException->addError($error);
		}
	}
	
	
	public function rowCount($sql,array $parametros){
		try{
			$s_parametros="";
			
			$consulta=$this->_db_select->prepare($sql);
			$consulta->execute($parametros);
			$total = $consulta->rowCount();
			
			return $total;
		}catch (PDOException $e){
		    $this->myException->setEstado(1);
			$error=array(
			    'user'=>'SE PRODUJO UN ERROR AL CONSULTAR EN LA BASE DE DATOS.',
				'admin'=>$this->error($e,$sql)
			);
			$this->myException->addError($error);
		}catch (Exception $e){
			$this->myException->setEstado(1);
			$error=array(
		        'user'=>'SE PRODUJO UN ERROR. FAVOR COMUNICARSE CON EL ADMINISTRADOR DEL SISTEMA.',
				'admin'=>$e->getMessage()."<br>codigo: ".$e->getCode()."<br>linea: ".$e->getLine()."<br>archivo: ".$e->getFile()
			);
			$this->myException->addError($error);
		}
	}
	
	
	public function beginTransaction(){
		$this->_db_insert->beginTransaction();
	}
	
	
	public function commit(){
		$this->_db_insert->commit();
	}
	
	
	public function rollBack(){
		$this->_db_insert->rollBack();
	}
	
	
	public function conectaMaster(){
		$this->_db_insert=new PDO('mysql:host='.Configuracion::$host_bd_segfac.';port='.Configuracion::$port_bd_maestro_segfac.';dbname='.Configuracion::$name_bd_segfac, Configuracion::$user_bd_segfac, Configuracion::$pass_bd_segfac,array(PDO::ATTR_PERSISTENT=>true));
		$this->_db_insert->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$this->_db_insert->setAttribute(PDO::MYSQL_ATTR_USE_BUFFERED_QUERY,true);
	}
	
	
	public function conectaSlave(){
		$this->_db_select=new PDO('mysql:host='.Configuracion::$host_bd_segfac.';port='.Configuracion::$port_bd_replica_segfac.';dbname='.Configuracion::$name_bd_segfac, Configuracion::$user_bd_segfac, Configuracion::$pass_bd_segfac,array(PDO::ATTR_PERSISTENT=>true));						
		$this->_db_select->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$this->_db_select->setAttribute(PDO::MYSQL_ATTR_USE_BUFFERED_QUERY,true);
	
		
		$sql="select @@hostname as nombre_server";
		$res=$this->select($sql,array());
		if ($this->myException->getEstado()==0){
			if ($rs=$res->fetchAll()){
				$this->_db_server_name=$rs[0]["nombre_server"];
			}else{
				$this->_db_server_name="Error no se pudo rescatar el nombre del server.";
			}
		}else{
			$this->myException->setEstado(1);
			$error=array(
			    'user'=>'SE PRODUJO UN ERROR AL RESCATAR EL NOMBRE DEL SERVER.',
				'admin'=>''
			);
			$this->myException->addError($error);
		}
	}
	
	
	public function conectaSlavecomoMaster(){
		$this->_db_select=new PDO('mysql:host='.Configuracion::$host_bd_segfac.';port='.Configuracion::$port_bd_maestro_segfac.';dbname='.Configuracion::$name_bd_segfac, Configuracion::$user_bd_segfac, Configuracion::$pass_bd_segfac,array(PDO::ATTR_PERSISTENT=>true));
		$this->_db_select->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$this->_db_select->setAttribute(PDO::MYSQL_ATTR_USE_BUFFERED_QUERY,true);
	}
	
	
	public function __construct(){
		$this->myException=new MyException();
		try{
			$this->conectaMaster();
		}catch (PDOException $e){
			$this->myException->setEstado(1);
			$error=array(
			    'user'=>'SE PRODUJO UN ERROR. FAVOR COMUNICARSE CON EL ADMINISTRADOR DEL SISTEMA.',
				'admin'=>'ERROR DE CONEXION A MASTER\N'.$this->error($e)
			);
			$this->myException->addError($error);
		}
		if (Configuracion::$servidor_esclavo==0){
			try{
				$this->conectaSlavecomoMaster();
			}catch (PDOException $e){
				$this->myException->setEstado(1);
				$error=array(
					 'user'=>'SE PRODUJO UN ERROR. FAVOR COMUNICARSE CON EL ADMINISTRADOR DEL SISTEMA.',
					'admin'=>'ERROR DE CONEXION A MASTER\N'
				);
				$this->myException->addError($error);
			}
		}else{
			/**** OJO LUEGO DESCOMENTAREAR ESTOS OJINES **/
			//inyectar codigo que sacaste
			try{
				$this->conectaSlave();
				$sql="show slave status";
				$res=$this->select($sql,array());
				if ($this->myException->getEstado()==0){
					if ($rs=$res->fetchAll()){
						#logre leer el status del slave
						if ($rs[0]["Slave_SQL_Running"]=="No" || $rs[0]["Last_SQL_Errno"]!=0){
							$this->recupera_slave();
							$sql2="show slave status";
							$res2=$this->select($sql2,array());
							if ($this->myException->getEstado()==0){
								if ($rs2=$res->fetchAll()){
									#logre leer el status del slave
									if ($rs2[0]["Slave_SQL_Running"]=="No" || $rs2[0]["Last_SQL_Errno"]!=0){							
										#slave conecta pero no esta sincronizado.
										$this->myException->setEstado(1);
										$error=array(
											'user'=>'',
											'admin'=>'SERVER:'.Utilidades::nombreServer().' SE CONECTO CON EL SLAVE PERO ESTE ESTA DESCRONIZADO, FAVOR REVISAR<br>\n'.
											'<br>\nSlave_SQL_Running:'.$rs[0]["Slave_SQL_Running"].'<br>\nLast_SQL_Errno:'.$rs[0]["Last_SQL_Errno"].
											'<br>\nLast_SQL_Error'.$rs[0]["Last_SQL_Error"]
										);
										$this->myException->addError($error);
										#SI NO ES CAPAZ DE CONECTARSE CON EL SLAVE TRATAMOS DE DEJARLOS IGUAL CONECTADO CON EL MASTER
										$this->_db_select=null;
										try{
											$this->conectaSlavecomoMaster();
											$this->myException->setEstado(0);
										}catch (PDOException $e){
											$this->myException->setEstado(1);
											$error=array(
												'user'=>'SE PRODUJO UN ERROR. FAVOR COMUNICARSE CON EL ADMINISTRADOR DEL SISTEMA.',
												'admin'=>'SERVER:'.Utilidades::nombreServer().' NO PUEDO ESTABLECER LA CONEXION CON EL MASTER\N'
											);
											$this->myException->addError($error);
										}
									}
								}else{
									#no logree leer el status notifico error y dejo conectado al master.
									$this->myException->setEstado(1);
									$error=array(
										'user'=>'',
										'admin'=>'SERVER:'.Utilidades::nombreServer().' SE CONECTO CON EL SLAVE PERO NO FUE POSIBLE LEER ES SHOW STATUS SLAVE\n'
									);
									$this->myException->addError($error);
									#SI NO ES CAPAZ DE CONECTARSE CON EL SLAVE TRATAMOS DE DEJARLOS IGUAL CONECTADO CON EL MASTER
									try{
										$this->conectaSlavecomoMaster();
										$this->myException->setEstado(0);
									}catch (PDOException $e){
										$this->myException->setEstado(1);
										$error=array(
											'user'=>'SE PRODUJO UN ERROR. FAVOR COMUNICARSE CON EL ADMINISTRADOR DEL SISTEMA.',
											'admin'=>'SERVER:'.Utilidades::nombreServer().' NO PUEDO ESTABLECER LA CONEXION CON EL MASTER\N'
										);
										$this->myException->addError($error);
									}
								}
							}else{
								#se genero un error al leer el estado del slave notifico error y dejo conectado al master.
								$this->myException->setEstado(1);
								$error=array(
									'user'=>'',
									'admin'=>'SERVER:'.Utilidades::nombreServer().' SE GENERO UNA EXCEPCION AL LEER EL SHOW SLAVE STATUS\n'
								);
								$this->myException->addError($error);
								#SI NO ES CAPAZ DE CONECTARSE CON EL SLAVE TRATAMOS DE DEJARLOS IGUAL CONECTADO CON EL MASTER
								try{
									$this->conectaSlavecomoMaster();
									$this->myException->setEstado(0);
								}catch (PDOException $e){
									$this->myException->setEstado(1);
									$error=array(
										'user'=>'SE PRODUJO UN ERROR. FAVOR COMUNICARSE CON EL ADMINISTRADOR DEL SISTEMA.',
										'admin'=>'SERVER:'.Utilidades::nombreServer().' NO PUEDO ESTABLECER LA CONEXION CON EL MASTER\N'
									);
									$this->myException->addError($error);
								}								
							}
						}
					}else{
						#no logree leer el status notifico error y dejo conectado al master.
						$this->myException->setEstado(1);
						$error=array(
							'user'=>'',
							'admin'=>'SERVER:'.Utilidades::nombreServer().' SE CONECTO CON EL SLAVE PERO NO FUE POSIBLE LEER ES SHOW STATUS SLAVE\n'
						);
						$this->myException->addError($error);
						#SI NO ES CAPAZ DE CONECTARSE CON EL SLAVE TRATAMOS DE DEJARLOS IGUAL CONECTADO CON EL MASTER
						try{
							$this->conectaSlavecomoMaster();
							$this->myException->setEstado(0);
						}catch (PDOException $e){
							$this->myException->setEstado(1);
							$error=array(
								'user'=>'SE PRODUJO UN ERROR. FAVOR COMUNICARSE CON EL ADMINISTRADOR DEL SISTEMA.',
								'admin'=>'SERVER:'.Utilidades::nombreServer().' NO PUEDO ESTABLECER LA CONEXION CON EL MASTER\N'
							);
							$this->myException->addError($error);
						}
					}
				}else{
					#se genero un error al leer el estado del slave notifico error y dejo conectado al master.
					$this->myException->setEstado(1);
					$error=array(
						'user'=>'',
						'admin'=>'SERVER:'.Utilidades::nombreServer().' SE GENERO UNA EXCEPCION AL LEER EL SHOW SLAVE STATUS\n'
					);
					$this->myException->addError($error);
					#SI NO ES CAPAZ DE CONECTARSE CON EL SLAVE TRATAMOS DE DEJARLOS IGUAL CONECTADO CON EL MASTER
					try{
						$this->conectaSlavecomoMaster();
						$this->myException->setEstado(0);
					}catch (PDOException $e){
						$this->myException->setEstado(1);
						$error=array(
							'user'=>'SE PRODUJO UN ERROR. FAVOR COMUNICARSE CON EL ADMINISTRADOR DEL SISTEMA.',
							'admin'=>'SERVER:'.Utilidades::nombreServer().' NO PUEDO ESTABLECER LA CONEXION CON EL MASTER\N'
						);
						$this->myException->addError($error);
					}
				}
			}catch (PDOException $e){
				$this->myException->setEstado(1);
				$error=array(
					 'user'=>'',
					'admin'=>'SERVER:'.Utilidades::nombreServer().' NO PUDO CONECTARSE CON LOS SLAVES\n'
				);
				$this->myException->addError($error);
				#SI NO ES CAPAZ DE CONECTARSE CON EL SLAVE TRATAMOS DE DEJARLOS IGUAL CONECTADO CON EL MASTER
				try{
					$this->conectaSlavecomoMaster();
					$this->myException->setEstado(0);
				}catch (PDOException $e){
					$this->myException->setEstado(1);
					$error=array(
						 'user'=>'SE PRODUJO UN ERROR. FAVOR COMUNICARSE CON EL ADMINISTRADOR DEL SISTEMA.',
						'admin'=>'SERVER:'.Utilidades::nombreServer().' NO PUEDO ESTABLECER LA CONEXION CON EL MASTER\N'
					);
					$this->myException->addError($error);
				}
			}		
			##### OJO LUEGO DESCOMENTAREAR ESTOS OJINES ######
		}
	}
	
	
	public function __destruct(){
		$this->_db_insert=null;
		$this->_db_select=null;
    }
}
?>