<?php

require "config/config.php";
$obj = new connection();
$con = $obj->connect();

$password = $_POST['password'];
	$id = $_POST['id'];
 $Time_Card = "UPDATE employee SET password = md5('$password') WHERE empl_id = '$id'";
 $Time_Cardd = mysqli_query($con,$Time_Card);

 echo "password updated";
?>