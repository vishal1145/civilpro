<?php
$project_id = $_POST['project_id'];
require "config/config.php";
$obj = new  connection();
$con = $obj->connect();
$sel_query = "Select * from Project where Project_id=$project_id";

$res_data = mysqli_query($con,$sel_query);
$row = mysqli_fetch_assoc($res_data);

//echo "<pre>"; print_r($row); echo "</pre>";die;
// get project leader name from id base 
$pro_leader_id = explode("," , $row['Project_leader']);
$string_version = implode(',', $pro_leader_id);
$get_machine = "select first_name from employee WHERE `empl_id` IN ($string_version) ";
$get_machinee = mysqli_query($con,$get_machine);
$newArray = array();
while($roww=mysqli_fetch_assoc($get_machinee)){
	$newArray[] = $roww['first_name'];
		$row['Project_leader'] = implode(",",$newArray);
		}	
// end get project leader name from id base 

// get project leader name from id base 
$Team_member = explode("," , $row['Team_member']);
$string_member = implode(',', $Team_member);
$get_member = "select first_name from employee WHERE `empl_id` IN ($string_member) ";
$get_mem = mysqli_query($con,$get_member);
$newArrayy = array();
while($roww=mysqli_fetch_assoc($get_mem)){
	$newArrayy[] = $roww['first_name'];
		$row['Team_member'] = implode(",",$newArrayy);
		}	
// end get project leader name from id base	

// get machine name from id base 
$machinee = explode("," , $row['machine']);
 $machinee_name = implode(',', $machinee);
 $get_machinee_name = "select machine_name from machine WHERE `machine_id` IN ($machinee_name) ";
$get_machinee = mysqli_query($con,$get_machinee_name);
$newArrayyy = array();
while($roww=mysqli_fetch_assoc($get_machinee)){
	$newArrayyy[] = $roww['machine_name'];
		$row['machine'] = implode(",",$newArrayyy);
		}	
// get machine name from id base 

// get material name from id base 
$material = explode("," , $row['material']);
 $material_name = implode(',', $material);
 $get_material_name = "select materials_name from material WHERE `id` IN ($material_name) ";
$get_material_name = mysqli_query($con,$get_material_name);
$newArrayyy = array();
while($roww=mysqli_fetch_assoc($get_material_name)){
	$newArrayyyyy[] = $roww['materials_name'];
		//$row['material'] = implode(",",$newArrayyyyy);
		$row['material'] = $row['consumption'];
		}	
// get material name from id base 		
//echo "<pre>"; print_r($row); echo "</pre>";
//die;

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