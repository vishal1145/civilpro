<?php
$project_id = $_POST['project_id'];
require "config/config.php";
$obj = new  connection();
$con = $obj->connect();
$sel_query = "Select * from Project where Project_id=$project_id";

$res_data = mysqli_query($con,$sel_query);
$row = mysqli_fetch_assoc($res_data);
$Client_id = $row['Client_id'];
$client_query ="Select * from Client WHERE id=$Client_id";
$cl_data = mysqli_query($con,$client_query);
$clrow = mysqli_fetch_assoc($cl_data);
$row['client_name'] = $clrow['first_name']." ".$clrow['last_name'];

if($row['Priority']==0){

$row['new_priority'] = "High";
}
if($row['Priority']==1){

$row['new_priority'] = "Medium";
}if($row['Priority']==2){

$row['new_priority'] = "Low";
}

if(!empty($row)){

$return = array('status'=>'sucess','data'=>$row);
print_r(json_encode($return));

}

?>