<?php

session_start();
require "config/config.php";
$obj = new connection();
$con = $obj->connect();

  $project_id  = $_POST['project_id'];
  $total_hours = $_POST['total_hours'];
  $currentHours = $_POST['hours'];
  $selectPro = mysqli_query($con, "SELECT * FROM Time_Card WHERE project_name = '$project_id'");
  $rowcount=mysqli_num_rows($selectPro);

  if($rowcount > 0){
        $remainHours = 0;
        $balanceHours = 0;
    		while($recode = mysqli_fetch_assoc($selectPro)){	
     
          $hours = $recode['hours'];
          $remainHours = $remainHours + $recode['hours']; 
             
        }
         // $balanceHours = $remainHours + $currentHours; 
        $totalRemainHours = $total_hours - $remainHours;
          
  }
                  $retData = array(
                              'msg'         => "success",
                              // 'empName'     => $empName,
                              'totalHours'  => $totalHours,
                              );
                  echo json_encode($retData);

?>