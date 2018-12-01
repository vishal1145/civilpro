<?php

/*session_start();
require "config/config.php";
$obj = new connection();
$con = $obj->connect();


 function checkuserslog($user_nm,$pass){
	global $con ;	
	$log_user_qury = "SELECT * FROM Users WHERE email = '$user_nm' AND password ='$pass'";
	$res_data = mysqli_query($con,$log_user_qury);	
	$num_rows = mysqli_num_rows($res_data);	
	if($num_rows > 0 ){	
		$user_row = mysqli_fetch_object($res_data);
		$_SESSION['user_id'] = $user_row->user_id ;		
		if(isset($_SESSION['user_id']) && $_SESSION['user_id'] > 0 ){
			header('Location: http://192.168.1.252/civilpro/dashbord.php' ); 			
		}		
	}
}
function getdata_user_log($user_log_id){
	global $con;
	$log_user_qury = "SELECT * FROM Users WHERE user_id = '$user_log_id'";
	$res_data = mysqli_query($con,$log_user_qury);	
	$num_rows = mysqli_num_rows($res_data);	
	if($num_rows > 0 ){	
		$user_row = mysqli_fetch_object($res_data);
		
	} 
	
	
	
}		
*/




?>