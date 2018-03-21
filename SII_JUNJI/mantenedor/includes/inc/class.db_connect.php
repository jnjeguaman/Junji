<?php 

/**
* 
*/
class db_connect
{
	private $_dbpassword;
	private $_dbusername;

	private $_dbpassword2;
	private $_dbusername2;

	function __construct()
	{
		$this->_dbpassword = "ubnaeCFXqd4735PE";
		$this->_dbusername = "usii";

		$this->_dbpassword2 = ".junji.db";
		$this->_dbusername2 = "root";
	}

	public function getConnection()
	{
		try {
			$this->_mysqli = new mysqli("localhost", $this->_dbusername, $this->_dbpassword, "junji_sii");
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
			$this->_mysqli = new mysqli("localhost", $this->_dbusername, $this->_dbpassword, "junji_segfac");
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