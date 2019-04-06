<?php
session_start();
require "config/config.php";
$obj = new connection();
$con = $obj->connect();

if($_POST['time_card'] == "approve_data_time_card"){
	$status = $_POST['Approve'];
	$id = $_POST[id];
 $Time_Card = "UPDATE time_card SET status = '$status' WHERE id = '$id'";
echo $Time_Cardd = mysqli_query($con,$Time_Card);
}

if($_POST['time_card'] == "approve_data_time_card"){
	$readstatus = $_POST['readstatus'];
	$id = $_POST[id];
 $Time_Card = "UPDATE time_card SET status = '$readstatus' WHERE id = '$id'";
echo $Time_Cardd = mysqli_query($con,$Time_Card);
}

if($_POST['time_carddd'] == "approve_project_act"){
 $status = $_POST['Approve'];
 $id = $_POST[id];
 $Time_Card = "UPDATE Project SET status = '$status' WHERE Project_id = '$id'";
echo $Time_Cardd = mysqli_query($con,$Time_Card);
}

if($_POST['task'] == "task"){
	$project_id = $_POST['project_id'];
	$query = "select * from project_tasks where project_id = ".$project_id;
    //$query_res = mysqli_query($con,$query);

//    $rows = array();
// while($r = mysqli_fetch_assoc($query_res)) {
//     $rows[] = $r;
// }

// echo json_encode($rows);



$result1=mysql_query($con,$query);
$json = array();
while($row1 = mysql_fetch_array($result1))     
 {
    $json[]= $row1;
}

$jsonstring = json_encode($json);
 echo $jsonstring;


}



if($_POST['approve_Priority'] == "approve_Priority"){
  $status = $_POST['Approve'];
 
$id = $_POST[id];
$Time_Card = "UPDATE Project SET Priority = '$status' WHERE Project_id = '$id'";
echo $Time_Cardd = mysqli_query($con,$Time_Card);
}

// time card get project member
if($_POST['project_member'] == "project_member"){
 $project_id = $_POST['project_id'];
 $id = $_POST[id];

$Time_Card = "SELECT Team_member FROM Project WHERE Project_id = '$project_id'";
$Time_Cardd = mysqli_query($con,$Time_Card);
$row = $Time_Cardd->fetch_assoc();
//print_r($row);

//die('here');


$array_value = $row['Team_member'];
$array =  explode(',', $array_value);

echo "<label>Team Members</label><br>";
foreach($array as $key => $value_data){
	if($key <= 3){
 ?>

  <a href='#'' data-toggle='tooltip' title='<?php echo $value_data ?>'>
	<img src='assets/img/user.jpg' class='avatar' alt='<?php echo $value_data ?>' height='20' width='20'>
</a> 

<?php
}


$empl_id = "SELECT first_name FROM employee WHERE empl_id = '$value_data'";
$empl_detail = mysqli_query($con,$empl_id);
$empl_data = $empl_detail->fetch_assoc();
//print_r($empl_data);

$employee_name[] = $empl_data;

}
//print_r($employee_name);





unset($array[0]);
unset($array[1]);
unset($array[2]);
unset($array[3]);

if(count($array) != 0):
	?>
 <span class="all-users">+<?php echo count($array); ?></span> 

<?php
endif;
}
// time card get project member



?>