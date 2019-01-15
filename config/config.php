<?php

class connection {	
	
	private $servername;
	private $username;
	private $password;
	private $dbname;
	
	function connect(){		
		// $this->servername = "45.114.79.179";
		// $this->username = "attodayi_civil";
		// $this->password = "civilpro@123";
		// $this->dbname = "attodayi_civilpro";
			
		$this->servername = "localhost";
		$this->username = "root";
		$this->password = "Ithours_123";
		$this->dbname = "attodayi_civilpro";

		$con = mysqli_connect($this->servername,$this->username,$this->password,$this->dbname);	
		if(mysqli_connect_error()){			
			echo "Your connection failed .". mysqli_connect_error();
		}
		else{

			return $con;			
			
		}
		
	}
	function simple(){
		echo "This is a simple function";
	}
}


$actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]";
$base_url = $actual_link ."/civilpro/";
$base_url1 = $actual_link ."/civilpro/dashbord.php";

?>