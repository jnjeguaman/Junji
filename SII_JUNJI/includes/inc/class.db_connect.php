<?php 

/**
 * Clase que permite la conexion a la base de datos
 * @author Freddy Varas Henriquez (fvaras@pradi.cl)
 */
class db_connect
{
	private $_dbpassword;
	private $_dbusername;
	function __construct()
	{
		//$this->_dbpassword = "ubnaeCFXqd4735PE";
		//$this->_dbusername = "usii";

		//$this->_dbpassword2 = "segfac.";
		//$this->_dbusername2 = "segfac";

		$this->_dbpassword = "Hol@1234";
		$this->_dbusername = "admin";

		$this->_dbpassword2 = "Hol@1234";
		$this->_dbusername2 = "admin";

	}

	/**
	* Método que permite la conexion establecer la conexion a la base de datos
	* @return Object
	**/
	public function getConnection()
	{
		try {
			$this->_mysqli = new mysqli("192.168.100.237", $this->_dbusername, $this->_dbpassword, "junji_sii");
			if ($this->_mysqli->connect_errno) {
				echo "Failed to connect to MySQL: (" . $_this->_mysqli->connect_errno . ") " . $mysqli->connect_error;
			}
			return $this->_mysqli;
		} catch (Exception $e) {
			throw new Exception("Error Processing Request", 1);
			echo "<br>Error : " . $e->getMessage();
			echo "<br>Error : " . $e->getCode();
			echo "<br>Error : " . $e->getFile();
			echo "<br>Error : " . $e->getLine();
		}
	}

		public function getConnection2()
	{
		try {
			$this->_mysqli = new mysqli("192.168.100.237", $this->_dbusername2, $this->_dbpassword2, "junji_segfac");
			if ($this->_mysqli->connect_errno) {
				echo "Failed to connect to MySQL: (" . $_this->_mysqli->connect_errno . ") " . $mysqli->connect_error;
			}
			return $this->_mysqli;
		} catch (Exception $e) {
			throw new Exception("Error Processing Request", 1);
			echo "<br>Error : " . $e->getMessage();
			echo "<br>Error : " . $e->getCode();
			echo "<br>Error : " . $e->getFile();
			echo "<br>Error : " . $e->getLine();
		}
	}

	public function getConnectionINEDIS()
	{
		try {
			$this->_mysqli = new mysqli("192.168.100.237", $this->_dbusername2, $this->_dbpassword2, "junji_inventario");
			if ($this->_mysqli->connect_errno) {
				echo "Failed to connect to MySQL: (" . $_this->_mysqli->connect_errno . ") " . $mysqli->connect_error;
			}
			return $this->_mysqli;
		} catch (Exception $e) {
			throw new Exception("Error Processing Request", 1);
			echo "<br>Error : " . $e->getMessage();
			echo "<br>Error : " . $e->getCode();
			echo "<br>Error : " . $e->getFile();
			echo "<br>Error : " . $e->getLine();
		}
	}

}

?>