<?php
$DesigID = $_POST['Desig_ID'];
require "config/config.php";
$obj = new  connection();
$con = $obj->connect();
$sel_query = "Select * from designation where designation_id=$DesigID";

$res_data = mysqli_query($con,$sel_query);
$row = mysqli_fetch_assoc($res_data);


$dept_id = $row['department_name'];

$client_query ="Select * from department WHERE department_id=$dept_id";
$cl_data = mysqli_query($con,$client_query);
$clrow = mysqli_fetch_assoc($cl_data);

$row['department_id'] = $clrow['department_id'];
$row['department_name'] = $clrow['department_name'];

if(!empty($row)){

$return = array('status'=>'sucess','data'=>$row);
print_r(json_encode($return));

}
?>