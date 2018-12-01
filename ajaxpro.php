<?php


	define (DB_USER, "root");
	define (DB_PASSWORD, "");
	define (DB_DATABASE, "civilpro");
	define (DB_HOST, "localhost");


	$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE);


	$sql = "SELECT * FROM machine 
			WHERE machine_name LIKE '%".$_GET['query']."%'
			LIMIT 10"; 


	$result = $mysqli->query($sql);


	$json = [];
	while($row = $result->fetch_assoc()){
	     // $nnn['machine_name'] = $row['machine_name'];
	      $json[] =$row['machine_name'];
	}
    //print_r($json);

	 echo json_encode($json);
?>