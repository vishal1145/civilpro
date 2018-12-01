<?php
session_start();
include "config/config.php";
$obj = new connection();
$con = $obj->connect();

if(isset($_GET['id'])){

	$otp =  $_GET['id'];
	$otp_chenck = "SELECT * FROM Users WHERE pass_token = '$otp' ";
	$data_otp = mysqli_query($con,$otp_chenck);
	$rows = mysqli_num_rows($data_otp);
	//$log_data = mysqli_fetch_assoc($data_otp);
	//print_r($log_data);
	//echo $log_data['user_id'];
	
	if($rows > 0 ){

		$log_data = mysqli_fetch_assoc($data_otp);

		$_SESSION['user_id'] = $log_data['user_id'];
		header("location:".$base_url1);
	}

}


?>