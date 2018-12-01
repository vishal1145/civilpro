<?php

include "config/config.php";
$obj = new connection();
$con = $obj->connect();

$user_id = $_POST['uid'];

	$select_query = "SELECT * FROM Users where user_id = '$user_id'";
	$select_data = mysqli_query($con,$select_query);
	$fetchdata = mysqli_fetch_assoc($select_data);
	//print_r($fetchdata);
if(!empty($fetchdata)){

$return = array('status'=>'sucess','data'=>$fetchdata);
print_r(json_encode($return));

}
?>