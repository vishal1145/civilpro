<?php

session_start();
require "config/config.php";
$obj = new connection();
$con = $obj->connect();

  $project_id = $_POST['project_dia'];
  $selectemp = mysqli_query($con, "SELECT * FROM project WHERE Project_id = '$project_id'");
  $rowcount=mysqli_num_rows($selectemp);

  if($rowcount > 0){
        $empName = "";
    		while($recode = mysqli_fetch_assoc($selectemp)){	
     
          $totalHours = $recode['Total_hours'];

			    $data = explode(",",$recode['Project_leader'].','.$recode['Team_member']);
         
            for($i=0; $i<count($data);$i++){
          	
          	  $empNameId = mysqli_query($con, "SELECT * FROM employee WHERE empl_id = '$data[$i]'");
              $rowcount=mysqli_num_rows($empNameId);
              // $empName = "";
              while($emp = mysqli_fetch_assoc($empNameId)){
                  $empName .= "<option value=".$emp['empl_id'].">".$emp['first_name']."</option>";
              }
            } 
        }
  }

  $selectPro = mysqli_query($con, "SELECT * FROM time_card WHERE project_name = '$project_id'");
  $rowcount=mysqli_num_rows($selectPro);

  if($rowcount > 0){
        $remainHours = 0;
        $balanceHours = 0;
        while($recode = mysqli_fetch_assoc($selectPro)){  
     
          $remainHours = $remainHours + $recode['hours']; 
             
        }
         // $balanceHours = $remainHours + $currentHours; 
         $totalRemainHours = $totalHours - $remainHours;
          
  }else{
        $totalRemainHours = $totalHours;
  }
                  $retData = array(
                              'msg'              => "success",
                              'empName'          => $empName,
                              'totalHours'       => $totalHours,
                              'totalRemainHours' => $totalRemainHours,
                              );
                  echo json_encode($retData);

?>