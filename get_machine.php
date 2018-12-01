<?php
$machine_id = $_REUEST['query'];
require "config/config.php";
$obj = new  connection();
$con = $obj->connect();
$sel_query = "SELECT * FROM `machine` where machine_name like '%$machine_id%'";

$res_data = mysqli_query($con,$sel_query);
$MachineArray = array();
$num_rows = mysqli_num_rows($res_data);	
	if($num_rows > 0 ){	
while($row = mysqli_fetch_assoc($res_data)){

$NewArray[]  = $row['machine_name'];

}print_r(json_encode($NewArray));
}

?>