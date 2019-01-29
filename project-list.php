<?php
session_start();
include "header.php";
include "sidebar.php";

$obj = new  connection();
$con = $obj->connect();

$user_id = $_SESSION['user_id'];
if(isset($_SESSION['user_id'])){

 if(isset($_POST['delete_project'])){
$project_id = $_POST['project_id'];
$sql = "DELETE FROM project where Project_id=$project_id";
$res_data = mysqli_query($con,$sql);
  }         

if(isset($_POST['create_project'])){
	
    $project_name = $_POST['project_name'];
    $client_id = $_POST['client_id'];
    $start_date = $_POST['start_date'];
    $end_date = $_POST['end_date'];
    $rate = $_POST['rate'];
    $billing_type = $_POST['billing_type'];
    $priority = $_POST['priority'];
    $proTotalHour = $_POST['pro_total_hour'];
    $consumption = $_POST['consumption'];
/* =========================== project leader save id ===================================== */

 	$newPro = str_replace(",","','",$_POST['project_leader']);
    $sql	= "SELECT * from employee WHERE `first_name` IN ('$newPro')";
    $res_data = mysqli_query($con,$sql);

		$NewProjName = array();
			while($rowData = mysqli_fetch_assoc($res_data)){
			$NewProjName[] = $rowData['empl_id'];
			}
     $employee_id = implode(",",$NewProjName);

/* ========================================================================================= */
/* =============================== team member save id ===================================== */

 	$newTeam = str_replace(",","','",$_POST['team_name']);
    $sql	= "SELECT * from employee WHERE `first_name` IN ('$newTeam')";
    $res_data = mysqli_query($con,$sql);

		$NewTeamName = array();
			while($rowData = mysqli_fetch_assoc($res_data)){
			$NewTeamName[] = $rowData['empl_id'];
			}
     $team_id = implode(",",$NewTeamName);

/* ========================================================================================= */
/* =============================== machine save id ===================================== */

 	$newMachine = str_replace(",","','",$_POST['machine']);
    $sql	= "SELECT * from machine WHERE `machine_name` IN ('$newMachine')";
    $res_data = mysqli_query($con,$sql);

		$NewMachineName = array();
			while($rowData = mysqli_fetch_assoc($res_data)){
			$NewMachineName[] = $rowData['machine_id'];
			}
     $machine = implode(",",$NewMachineName);	
     
/* ========================================================================================= */
/* =============================== materials save id ===================================== */

 	$materials_name = implode(",",$_POST['materials']);
 	$newMaterial = str_replace(",","','",$_POST['materials']);
    $sql	= "SELECT * from material WHERE `materials_name` IN ('$newMaterial')";
    $res_data = mysqli_query($con,$sql);

		$NewMaterialName = array();
			while($rowData = mysqli_fetch_assoc($res_data)){
			$NewMaterialName[] = $rowData['id'];
			}
     $materials = implode(",",$NewMaterialName);
     
/* ========================================================================================= */

    // $team_name = implode(",",$_POST['team_name']);
    // $machine = implode(",",$_POST['machine']);
    // $materials = implode(",",$_POST['materials']);
    $project_address = $_POST['project_address'];
    $description = mysqli_real_escape_string($con,$_POST['description']); 
	$image = $_FILES['image']['name'];
	$target = "Upload/project/".basename($image);

	

	for($i=0;$i < count($consumption);$i++){
         
        if(empty($consumption[$i])){
            $newconsumption[]=0;

        }
        else{
        	$newconsumption[]=$consumption[$i];
        }

}



	$data_filter = array_filter($newconsumption);
	$consmp_name = implode(",",$data_filter);

/*echo $consmp_name;
die;*/



	echo $log_user_qury = "INSERT INTO Project (Project_name, Client_id,Start_date,end_date,Rate,billing_type,Total_hours,Priority,Project_leader,Team_member,Project_Address,machine,material,consumption,decription,images)
     VALUES ('$project_name', '$client_id', '$start_date','$end_date','$rate','$billing_type','$proTotalHour','$priority','$employee_id','$team_id','$project_address','$machine','$materials','$consmp_name','$description','$image')";
     
    $res_data = mysqli_query($con,$log_user_qury);	

    if($res_data){
    	if($res_data){ echo "Records updated successfully";
			header('Location: '. $base_url .'project-list.php');
		}
    }
	if (move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
	}
}

if(isset($_POST['update_project'])){


    $Priority  = $_POST['Priority'];
    $products_id  = $_POST['products_id'];
    $project_name = $_POST['project_name'];
    $client_id = $_POST['client_id1'];
    $start_date = $_POST['start_date'];
    $end_date = $_POST['end_date'];
    $rate = $_POST['rate'];
    $billing_type= $_POST['billing_type'];
    $proTotalHour = $_POST['pro_total_hour'];
    $material = $_POST['edit_materials'];
    $consumption = $_POST['consumption'];
    /* =========================== project leader update id ===================================== */

 	$project_leader = implode(",",$_POST['edit_project_leader']);
 	$newPro = str_replace(",","','",$project_leader);

    $sql	= "SELECT * from employee WHERE `first_name` IN ('$newPro')";
    $res_data = mysqli_query($con,$sql);

		$NewProjName = array();
			while($rowData = mysqli_fetch_assoc($res_data)){
			$NewProjName[] = $rowData['empl_id'];
			}
     $edit_project_leader = implode(",",$NewProjName);

/* ========================================================================================= */

/* =============================== team member update id ===================================== */

 	$team_name = implode(",",$_POST['edit_team']);
 	$newTeam = str_replace(",","','",$team_name);
    $sql	= "SELECT * from employee WHERE `first_name` IN ('$newTeam')";
    $res_data = mysqli_query($con,$sql);

		$NewTeamName = array();
			while($rowData = mysqli_fetch_assoc($res_data)){
			$NewTeamName[] = $rowData['empl_id'];
			}
     $edit_team = implode(",",$NewTeamName);

/* ========================================================================================= */
/* =============================== machine update id ===================================== */

 	$machine_name = implode(",",$_POST['edit_machines']);
 	$newMachine = str_replace(",","','",$machine_name);
    $sql	= "SELECT * from machine WHERE `machine_name` IN ('$newMachine')";
    $res_data = mysqli_query($con,$sql);

		$NewMachineName = array();
			while($rowData = mysqli_fetch_assoc($res_data)){
			$NewMachineName[] = $rowData['machine_id'];
			}
     $edit_machines = implode(",",$NewMachineName);	
     
/* ========================================================================================= */
/* =============================== materials update id ===================================== */

 	/*$materials_name = implode(",",$_POST['edit_materials']);
 	$newMaterial = str_replace(",","','",$materials_name);
    $sql	= "SELECT * from material WHERE `materials_name` IN ('$newMaterial')";
    $res_data = mysqli_query($con,$sql);

		$NewMaterialName = array();
			while($rowData = mysqli_fetch_assoc($res_data)){
			$NewMaterialName[] = $rowData['id'];
			}
     $edit_materials = implode(",",$NewMaterialName);*/
/* ========================================================================================= */
    // $edit_project_leader = implode(",",$_POST['edit_project_leader']);
    // $edit_team = implode(",",$_POST['edit_team']);
    // $edit_machines = implode(",",$_POST['edit_machines']); 
    // $edit_materials = implode(",",$_POST['edit_materials']);
    $edit_project_address = $_POST['edit_project_address'];


    $description = mysqli_real_escape_string($con,$_POST['description']);
	//$image = (isset($_FILES['image']['name']) ? $_FILES['image']['name'] : $_POST['hidden_image']);
	
	if(!empty($_FILES['image']['name']) && isset($_FILES['image']['name'])){
		$image = $_FILES['image']['name'];
	}else{
		$image = $_POST['hidden_image'];
	} 
	
	$target = "Upload/project/".basename($image);
	//$target_path = $target_path.basename( $_FILES['fileToUpload']['name']); 
	move_uploaded_file($_FILES['image']['tmp_name'], $target);


	for($i=0;$i < count($consumption);$i++){
         
        if(empty($consumption[$i])){
            $newconsumption[]=0;
        }
        else{
        	$newconsumption[]=$consumption[$i];
        }

}

	$data_filter = array_filter($newconsumption);
	$consmp_name = implode(",",$data_filter);

	
	for($i=0;$i < count($material);$i++){
         
        if(empty($material[$i])){
            $newmaterial[]=0;
        }
        else{
        	$newmaterial[]=$material[$i];
        }

}

	$data_filter2 = array_filter($newmaterial);
	$material_value = implode(",",$data_filter2);


	
   $sql = "UPDATE project SET Project_name='$project_name', Client_id='$client_id',Start_date='$start_date',end_date='$end_date',Rate='$rate',billing_type='$billing_type',Total_hours='$proTotalHour',Priority='$Priority', Project_leader='$edit_project_leader',Team_member='$edit_team',material='$material_value',machine='$edit_machines',consumption='$consmp_name',Project_Address='$edit_project_address',decription='$description',images='$image' WHERE Project_id=$products_id";

	$res_data = mysqli_query($con, $sql);	
   
	if($res_data){ echo "Records updated successfully"; 

		header('Location: '. $base_url .'project-list.php');
	
	}
}

if(isset($_POST['search_project'])){

$project_name = $_POST['project_name'];
$project_id = $_POST['project_id'];
$role = $_POST['role'];
  $Sel_query = array();
  if(!empty($project_name )){
  
   $Sel_query[] = "Project_name like '%$project_name%'";

  }
  if(!empty($project_id)){
  	
   $Sel_query[] = "Project_id = '$project_id'";
  
  }
 if(!empty($role) || $role !=NULL){

  $Sel_query[] = "status = '$role'";

 }

$fullQuery = implode(" AND ",$Sel_query);

$sel_query = "Select * from Project WHERE $fullQuery";
}else{
$sel_query = "Select * from Project";
}
$res_data = mysqli_query($con,$sel_query);	


?> 

<link rel="stylesheet" href="https://cdn.jsdelivr.net/bootstrap.tagsinput/0.4.2/bootstrap-tagsinput.css" />
 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput-typeahead.css" />
<link rel="stylesheet" type="text/css" href="http://code.jquery.com/ui/1.10.4/themes/ui-lightness/jquery-ui.css"/>
<link rel="stylesheet" type="text/css" href="assets/autocomplete/css/style.css"/> 
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script> 
<script src="https://cdnjs.cloudflare.com/ajax/libs/typeahead.js/0.11.1/typeahead.bundle.min.js"></script> 
<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.4/jquery-ui.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.min.js"></script>
	
            <div class="page-wrapper">
                <div class="content container-fluid">
					<div class="row">
						<div class="col-sm-4">
							<h4 class="page-title">Projects</h4>
						</div>
						<div class="col-sm-8 text-right m-b-20">
							<a href="#" class="btn btn-primary rounded pull-right" data-toggle="modal" data-target="#create_project"><i class="fa fa-plus"></i> Create Project</a>
							<div class="view-icons">
								<a href="projects.php" class="grid-view btn btn-link"><i class="fa fa-th"></i></a>
								<a href="project-list.php" class="list-view btn btn-link active"><i class="fa fa-bars"></i></a>
							</div>
						</div>
					</div>
					<div class="row filter-row">
					<form action="" method="post">
						<div class="col-sm-3 col-xs-6">  
							<div class="form-group form-focus">
								<label class="control-label">Project Name</label>
								<input type="text" class="form-control floating" name="project_name"/>
							</div>
						</div>
						<div class="col-sm-3 col-xs-6">  
							<div class="form-group form-focus">
								<label class="control-label">Project Id</label>
								<input type="text" class="form-control floating" name="project_id"/>
							</div>
						</div>
						<div class="col-sm-3 col-xs-6"> 
							<div class="form-group form-focus select-focus">
							
								<select class="select floating" name="role"> 
									<option value="">Select Status</option>
									<option value="1">Active</option>
									<option value="0">Inactive</option>
								</select>
							</div>
						</div>
						<!-- <div class="col-sm-3 col-xs-6">  
							<div class="form-group form-focus">
								<label class="control-label">Employee Name</label>
								<input type="text" class="form-control floating" name="employee_name" id="coding_language"/>
							</div>
						</div>
						<div class="col-sm-3 col-xs-6"> 
							<div class="form-group form-focus select-focus">
								<label class="control-label">Designation</label>
								<select class="select floating" name="role"> 
									<option value="">Select Roll</option>
									<option value="">Web Developer</option>
									<option value="1">Web Designer</option>
									<option value="1">Android Developer</option>
									<option value="1">Ios Developer</option>
								</select>
							</div>
						</div> -->
						<div class="col-sm-3 col-xs-6">  
							<input type="submit" class="btn btn-success btn-block" value="Search" name="search_project">  
							<input type="button" class="ref_page btn btn-info btn-block" value="Reset">
						</div> 
						</form>						
                    </div>
					<div class="row">
						<div class="col-md-12">
							<div class="table-responsive">
								<table class="table table-striped custom-table datatable">
									<thead>
										<tr>
											<th>Project</th>
											<th>Project Id</th>
											<th>Leader</th>
											<th>Team</th>
											<th>Deadline</th>
											<th>Priority</th>
											<th>Status</th>
											<th class="text-right">Action</th>
										</tr>
									</thead>
									<tbody>
									
									<?php
					while($rowData = mysqli_fetch_assoc($res_data)){
					?>

			<div id="delete_project<?php echo $rowData['Project_id'];?>" class="modal custom-modal fade" role="dialog">
				<div class="modal-dialog">
					<div class="modal-content modal-md">
						<div class="modal-header">
							<h4 class="modal-title">Delete Project</h4>
						</div>
						<div class="modal-body card-box">
							<p>Are you sure want to delete this?</p>
							<div class="m-t-20"> <form action="" method="POST"><a href="#" class="btn btn-default" data-dismiss="modal">Close</a>
							<input type="hidden"  name="project_id" value="<?php echo $rowData['Project_id'];?>">
								<button type="submit" class="btn btn-danger delete_pro" value="delete" name="delete_project">Delete</button>
								
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
			
										<tr>
											<td>
												<h2><a href="<?php echo $base_url;?>projects.php"><?php echo $rowData['Project_name'];?></a></h2>
											</td>
											<td>PRO-<?php echo $rowData['Project_id'];?></td>
											<td>
												<ul class="team-members">
										<?php 
											$array_value = $rowData['Project_leader'];
											$array =  array_filter(explode(',', $array_value));
											foreach($array as $key1 => $value_data){ 
											 $sql = "select empl_id, first_name,img from employee where empl_id = $value_data";
											 $proj_leader = mysqli_query($con,$sql);
											 while($proLeaderDate = mysqli_fetch_assoc($proj_leader)){
										?>
										<li>
											<a href="#" data-toggle="tooltip" title="<?php echo $proLeaderDate['first_name']; ?> ">
											<img src="<?php echo $proLeaderDate['img']; ?>" alt="Jeffery Lalor">
											</a>
										</li>
									<?php } }?>
									</ul>
											</td>
											<td>
												<ul class="team-members">
												<?php
									$array_value = $rowData['Team_member'];
										$arraytemp =  explode(',', $array_value);
										if($arraytemp[0] == "")
										{
											$array = array();
										}
										else
										{
											$arraytemp = $array;
										}
										foreach($array as $key => $value_data){ 
										if($key <= 3){
											$sql = "select empl_id, first_name, img from employee where empl_id = $value_data";
											 $team_member = mysqli_query($con,$sql);
											 while($teamMemberDate = mysqli_fetch_assoc($team_member)){	
										?>
										<li>
										<a href="#" title="<?php echo $teamMemberDate['first_name']; ?>" data-toggle="tooltip"><img src="<?php echo $teamMemberDate['img']; ?>" alt="<?php echo $value_data; ?>"></a>
										</li>
										
										<?php } } }
										unset($array[0]);
										unset($array[1]);
										unset($array[2]);
										//unset($array[3]);
										if(count($array) != 0):
										?>
										<li>
										<a href="#" class="all-users">+<?php echo count($array); ?></a>
										</li>
										<?php endif;?>		
													
												</ul>
											</td>
											<td><?php echo $rowData['end_date'];?></td>
											<td>
												<div class="dropdown action-label worksheet_pg">
													<a class="btn btn-white btn-sm rounded dropdown-toggle" data-toggle="dropdown" aria-expanded="false"> 
														
													<?php
													if($rowData['Priority'] == 0){
													echo '<i class="fa fa-dot-circle-o text-success"></i><span class="change_heading"> High </span><i class="caret"></i></a>';
													}else if($rowData['Priority'] == 1){
													echo '<i class="fa fa-dot-circle-o text-danger"></i><span class="change_heading"> Medium </span><i class="caret"></i></a>';
													}else{
													echo '<i class="fa fa-dot-circle-o text-danger"></i><span class="change_heading"> Low </span><i class="caret"></i></a>';
													}
													?>
													<ul class="dropdown-menu">
														<li class="High" data-id="<?php echo $rowData['Project_id']; ?>"><a href="#"><i class="fa fa-dot-circle-o text-success"></i> High</a></li>
														<li class="Medium" data-id="<?php echo $rowData['Project_id']; ?>"><a href="#"><i class="fa fa-dot-circle-o text-danger"></i> Medium</a>
														</li>
														<li class="Low" data-id="<?php echo $rowData['Project_id']; ?>"><a href="#"><i class="fa fa-dot-circle-o text-danger"></i> Low</a>
														</li>
														
													</ul>
												</div>
											</td>
											
											<td>
													<div class="dropdown action-label worksheet_pg">
													<a class="btn btn-white btn-sm rounded dropdown-toggle" data-toggle="dropdown" aria-expanded="false"> 
														
													<?php
													if($rowData['status'] == 1){
													echo '<i class="fa fa-dot-circle-o text-success"></i><span class="change_heading"> Active </span><i class="caret"></i></a>';
													}else{
													echo '<i class="fa fa-dot-circle-o text-danger"></i><span class="change_heading"> Inactive </span><i class="caret"></i></a>';

													}
													?>
													<ul class="dropdown-menu">
														<li class="Approve" data-id="<?php echo $rowData['Project_id'];?>"><a href="#"><i class="fa fa-dot-circle-o text-success"></i> Active</a></li>
														<li class="Decline" data-id="<?php echo $rowData['Project_id'];?>"><a href="#"><i class="fa fa-dot-circle-o text-danger"></i> Inactive</a>
														</li>
														
													</ul>
												</div>									
											</td>
											<td class="text-right">
												<div class="dropdown">
													<a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
													<ul class="dropdown-menu pull-right">
														 <!-- <li><a href="#" data-toggle="modal" data-target="#create_project1" data-id="<?php echo $rowData['Project_id'];?>" class="edit"><i class="fa fa-pencil m-r-5"></i> Edit</a></li> -->
														 <li><a href="project_edit.php?val=<?php echo $rowData['Project_id'];?>"  data-id="<?php echo $rowData['Project_id'];?>" class="edit"><i class="fa fa-pencil m-r-5"></i> Edit</a></li> 
														<li><a href="#" data-toggle="modal" data-target="#delete_project<?php echo $rowData['Project_id'];?>"><i class="fa fa-trash-o m-r-5"></i> Delete</a></li>
													</ul>
												</div>
											</td>
										</tr>
										
										<?php } ?>
										
									</tbody>
								</table>
							</div>
						</div>
					</div>
                </div>
				<div class="notification-box">
					<div class="msg-sidebar notifications msg-noti">
						<div class="topnav-dropdown-header">
							<span>Messages</span>
						</div>
						<div class="drop-scroll msg-list-scroll">
							<ul class="list-box">
								<li>
									<a href="chat.html">
										<div class="list-item">
											<div class="list-left">
												<span class="avatar">R</span>
											</div>
											<div class="list-body">
												<span class="message-author">Richard Miles </span>
												<span class="message-time">12:28 AM</span>
												<div class="clearfix"></div>
												<span class="message-content">Lorem ipsum dolor sit amet, consectetur adipiscing</span>
											</div>
										</div>
									</a>
								</li>
								<li>
									<a href="chat.html">
										<div class="list-item new-message">
											<div class="list-left">
												<span class="avatar">J</span>
											</div>
											<div class="list-body">
												<span class="message-author">John Doe</span>
												<span class="message-time">1 Aug</span>
												<div class="clearfix"></div>
												<span class="message-content">Lorem ipsum dolor sit amet, consectetur adipiscing</span>
											</div>
										</div>
									</a>
								</li>
								<li>
									<a href="chat.html">
										<div class="list-item">
											<div class="list-left">
												<span class="avatar">T</span>
											</div>
											<div class="list-body">
												<span class="message-author"> Tarah Shropshire </span>
												<span class="message-time">12:28 AM</span>
												<div class="clearfix"></div>
												<span class="message-content">Lorem ipsum dolor sit amet, consectetur adipiscing</span>
											</div>
										</div>
									</a>
								</li>
								<li>
									<a href="chat.html">
										<div class="list-item">
											<div class="list-left">
												<span class="avatar">M</span>
											</div>
											<div class="list-body">
												<span class="message-author">Mike Litorus</span>
												<span class="message-time">12:28 AM</span>
												<div class="clearfix"></div>
												<span class="message-content">Lorem ipsum dolor sit amet, consectetur adipiscing</span>
											</div>
										</div>
									</a>
								</li>
								<li>
									<a href="chat.html">
										<div class="list-item">
											<div class="list-left">
												<span class="avatar">C</span>
											</div>
											<div class="list-body">
												<span class="message-author"> Catherine Manseau </span>
												<span class="message-time">12:28 AM</span>
												<div class="clearfix"></div>
												<span class="message-content">Lorem ipsum dolor sit amet, consectetur adipiscing</span>
											</div>
										</div>
									</a>
								</li>
								<li>
									<a href="chat.html">
										<div class="list-item">
											<div class="list-left">
												<span class="avatar">D</span>
											</div>
											<div class="list-body">
												<span class="message-author"> Domenic Houston </span>
												<span class="message-time">12:28 AM</span>
												<div class="clearfix"></div>
												<span class="message-content">Lorem ipsum dolor sit amet, consectetur adipiscing</span>
											</div>
										</div>
									</a>
								</li>
								<li>
									<a href="chat.html">
										<div class="list-item">
											<div class="list-left">
												<span class="avatar">B</span>
											</div>
											<div class="list-body">
												<span class="message-author"> Buster Wigton </span>
												<span class="message-time">12:28 AM</span>
												<div class="clearfix"></div>
												<span class="message-content">Lorem ipsum dolor sit amet, consectetur adipiscing</span>
											</div>
										</div>
									</a>
								</li>
								<li>
									<a href="chat.html">
										<div class="list-item">
											<div class="list-left">
												<span class="avatar">R</span>
											</div>
											<div class="list-body">
												<span class="message-author"> Rolland Webber </span>
												<span class="message-time">12:28 AM</span>
												<div class="clearfix"></div>
												<span class="message-content">Lorem ipsum dolor sit amet, consectetur adipiscing</span>
											</div>
										</div>
									</a>
								</li>
								<li>
									<a href="chat.html">
										<div class="list-item">
											<div class="list-left">
												<span class="avatar">C</span>
											</div>
											<div class="list-body">
												<span class="message-author"> Claire Mapes </span>
												<span class="message-time">12:28 AM</span>
												<div class="clearfix"></div>
												<span class="message-content">Lorem ipsum dolor sit amet, consectetur adipiscing</span>
											</div>
										</div>
									</a>
								</li>
								<li>
									<a href="chat.html">
										<div class="list-item">
											<div class="list-left">
												<span class="avatar">M</span>
											</div>
											<div class="list-body">
												<span class="message-author">Melita Faucher</span>
												<span class="message-time">12:28 AM</span>
												<div class="clearfix"></div>
												<span class="message-content">Lorem ipsum dolor sit amet, consectetur adipiscing</span>
											</div>
										</div>
									</a>
								</li>
								<li>
									<a href="chat.html">
										<div class="list-item">
											<div class="list-left">
												<span class="avatar">J</span>
											</div>
											<div class="list-body">
												<span class="message-author">Jeffery Lalor</span>
												<span class="message-time">12:28 AM</span>
												<div class="clearfix"></div>
												<span class="message-content">Lorem ipsum dolor sit amet, consectetur adipiscing</span>
											</div>
										</div>
									</a>
								</li>
								<li>
									<a href="chat.html">
										<div class="list-item">
											<div class="list-left">
												<span class="avatar">L</span>
											</div>
											<div class="list-body">
												<span class="message-author">Loren Gatlin</span>
												<span class="message-time">12:28 AM</span>
												<div class="clearfix"></div>
												<span class="message-content">Lorem ipsum dolor sit amet, consectetur adipiscing</span>
											</div>
										</div>
									</a>
								</li>
								<li>
									<a href="chat.html">
										<div class="list-item">
											<div class="list-left">
												<span class="avatar">T</span>
											</div>
											<div class="list-body">
												<span class="message-author">Tarah Shropshire</span>
												<span class="message-time">12:28 AM</span>
												<div class="clearfix"></div>
												<span class="message-content">Lorem ipsum dolor sit amet, consectetur adipiscing</span>
											</div>
										</div>
									</a>
								</li>
							</ul>
						</div>
						<div class="topnav-dropdown-footer">
							<a href="chat.html">See all messages</a>
						</div>
					</div>
				</div>
            </div>
			
			<div id="create_project" class="modal custom-modal fade" role="dialog">
				<div class="modal-dialog">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<div class="modal-content modal-lg">
						<div class="modal-header">
							<h4 class="modal-title">Create Project</h4>
						</div>
						<div class="modal-body">
							<form action="" method="post" enctype="multipart/form-data" name="projectsform">
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label>Project Name</label>
											<input class="form-control" type="text" name="project_name">
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label>Client</label>
											<select  name="client_id" id="client_id" class="select required">
											<?php
												$sel_query = "Select * from Client";
												$res_data = mysqli_query($con,$sel_query);	
												while($clientdata = mysqli_fetch_assoc($res_data)){
											?>
												<option value="<?php echo $clientdata['id'];?>"><?php echo $clientdata['first_name'] .'&nbsp;&nbsp;&nbsp;'.$clientdata['last_name'];?></option>
												<?php } ?>
											</select>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label>Start Date</label>
											<div class="cal-icon"><input class="form-control datetimepicker" type="text" name="start_date"></div>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label>End Date</label>
											<div class="cal-icon"><input class="form-control datetimepicker" style="" type="text" name="end_date"></div>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-3">
										<div class="form-group">
											<label>Rate</label>
											<input placeholder="$50" class="form-control" type="text" name="rate">
										</div>
									</div>
									<div class="col-md-3">
										<div class="form-group">
											<label>&nbsp;</label>
											<select class="select" name="billing_type">
												<option value="Hourly">Hourly</option>
												<option value="Fixed">Fixed</option>
											</select>
										</div>
									</div>
									<div class="form-group col-sm-3">
										<label>Total Hours <span class="text-danger">*</span></label>
										<input class="form-control digit_only" type="text" value="" name="pro_total_hour">
									</div>
									<div class="col-md-3">
										<div class="form-group">
											<label>Priority</label>
											<select class="select" name="priority">
												<option value="1">High</option>
												<option value="2">Medium</option>
												<option value="3">Low</option>
											</select>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label>Add Project Leader</label>
											<input class="form-control" type="text" name="project_leader" id="project_leader">
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label>Team Leader</label>
											<div class="project-members">
												<a href="#" data-toggle="tooltip" title="Jeffery Lalor">
													<img src="assets/img/user.jpg" class="avatar" alt="Jeffery Lalor" height="20" width="20">
												</a>
											</div>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label>Add Team</label>
											<input class="form-control" type="text" name="team_name" id="team_name">
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label>Team Members</label>
											<div class="project-members">
												<a href="#" data-toggle="tooltip" title="John Doe">
													<img src="assets/img/user.jpg" class="avatar" alt="John Doe" height="20" width="20">
												</a>
												<a href="#" data-toggle="tooltip" title="Richard Miles">
													<img src="assets/img/user.jpg" class="avatar" alt="Richard Miles" height="20" width="20">
												</a>
												<a href="#" data-toggle="tooltip" title="John Smith">
													<img src="assets/img/user.jpg" class="avatar" alt="John Smith" height="20" width="20">
												</a>
												<a href="#" data-toggle="tooltip" title="Mike Litorus">
													<img src="assets/img/user.jpg" class="avatar" alt="Mike Litorus" height="20" width="20">
												</a>
												<span class="all-team">+2</span>
											</div>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label>Project Address</label>
											<input class="form-control" type="text" name="project_address">
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label>Map Here</label>
											<div class="google_map_pr">
												<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d109741.0291293599!2d76.69348833302669!3d30.73506264415007!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x390fed0be66ec96b%3A0xa5ff67f9527319fe!2sChandigarh!5e0!3m2!1sen!2sin!4v1530000938881" width="100%" height="100%" frameborder="0" style="border:0" allowfullscreen></iframe>
											</div>
										</div>
									</div>
								</div>	
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label>Add Machines</label>
											<input id="machine" class="form-control" type="text" name="machine">
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label>Machines</label>
											<div class="project-members">
												<a href="#" data-toggle="tooltip" title="John Doe">
													<img src="assets/img/user.jpg" class="avatar" alt="John Doe" height="20" width="20">
												</a>
												<a href="#" data-toggle="tooltip" title="Richard Miles">
													<img src="assets/img/user.jpg" class="avatar" alt="Richard Miles" height="20" width="20">
												</a>
												<a href="#" data-toggle="tooltip" title="John Smith">
													<img src="assets/img/user.jpg" class="avatar" alt="John Smith" height="20" width="20">
												</a>
												<a href="#" data-toggle="tooltip" title="Mike Litorus">
													<img src="assets/img/user.jpg" class="avatar" alt="Mike Litorus" height="20" width="20">
												</a>
												<span class="all-team">+2</span>
											</div>
										</div>
									</div>
								</div>

								<div class="row material-sec">
						<label class="ad-merti">Add Materials</label>
						

				<?php

				$sql= "SELECT * from material";
				$res_data3 = mysqli_query($con,$sql);

				$NewMaterialName = array();
					while($rowData3 = mysqli_fetch_assoc($res_data3)){ ?>
						
						<?php //print_r($rowData3['materials_name']);  ?>
						<div class="col-md-3">
							<div class="form-group">

						<input type="checkbox" id="materials123" class="form-control123" name="materials[]" value="<?php echo $rowData3['materials_name']; ?>" ><span><?php echo $rowData3['materials_name']; ?></span><br>
							</div>
						</div>
					
						<div class="col-md-3">
							 <div class="form-group">
								<label>Total amount </label> <br>
								<p id="amounttotal<?php echo $rowData3['id']; ?>" class="amounttotal" value="<?php echo $rowData3['amount']; ?>" data-overlay="<?php echo $rowData3['amount']; ?>"><?php echo $rowData3['amount']; ?></p>
								<!-- <input id="amount" type="text" class="form-control" name="amount" readonly value="<?php echo $rowData3['amount']; ?>"> -->
							</div> 
						</div>

						<div class="col-md-3">
							<div class="form-group">
								<label>Consumption</label>
								<p style="display: none;"><?php echo $rowData3['amount']; ?></p>
								 <input id="consumption<?php echo $rowData3['id']; ?>" type="number" class="form-control consumption" name="consumption[]" > 
							</div>
						</div>

						<div class="col-md-3">
							<div class="form-group">
								<label>Remaining amount</label>
								
								<input id="remain_amount<?php echo $rowData3['id']; ?>" type="text" class="form-control remain_amount" name="remain_amount" readonly value="" >
							</div>
						</div>


<script>
$(document).ready(function(){

 var id = "<?php echo $rowData3['id']; ?>";
 var div_id = "<?php echo '#consumption'.$rowData3['id']; ?>";
 var nextcls = "<?php echo '#remain_amount'.$rowData3['id']; ?>";

$(div_id).on('keyup',function(){

     var consumation_qty = $(this).prev().text();
      var cons_val = $(this).val();
      
      var sum = consumation_qty - cons_val;
   
      var consumation_qty = $(this).next().text();
    

    $(nextcls).val(sum);
		
});






});
</script>



							
					 	<?php	}	?>




					 </div>
								<!-- <div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label>Add Materials</label>
											<input id="materials" class="form-control" type="text" name="materials">
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label>Materials</label>
											 <div class="project-members">
												<a href="#" data-toggle="tooltip" title="John Doe">
													<img src="assets/img/user.jpg" class="avatar" alt="John Doe" height="20" width="20">
												</a>
												<a href="#" data-toggle="tooltip" title="Richard Miles">
													<img src="assets/img/user.jpg" class="avatar" alt="Richard Miles" height="20" width="20">
												</a>
												<a href="#" data-toggle="tooltip" title="John Smith">
													<img src="assets/img/user.jpg" class="avatar" alt="John Smith" height="20" width="20">
												</a>
												<a href="#" data-toggle="tooltip" title="Mike Litorus">
													<img src="assets/img/user.jpg" class="avatar" alt="Mike Litorus" height="20" width="20">
												</a>
												<span class="all-team">+2</span>
											</div> 
										</div>
									</div>
								</div> -->
								<div class="form-group">
									<label>Description</label>
									<textarea rows="4" cols="5" class="form-control summernote" placeholder="Enter your message here" name="description"></textarea>
								</div>
								<div class="form-group">
									<label>Upload Files</label>
									<input class="form-control" type="file" name="image">
								</div>
								<div class="m-t-20 text-center">
									<button class="btn btn-primary" name="create_project">Create Project</button>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>		
<div id="create_project1" class="modal custom-modal fade" role="dialog">
	<div class="modal-dialog">
		<button type="button" class="close" data-dismiss="modal">&times;</button>
		<div class="modal-content modal-lg">
			<div class="modal-header">
				<h4 class="modal-title">Edit Project</h4>
			</div>
			
			<div class="modal-body">
				<form action="" method="post" name="editform" enctype="multipart/form-data">
				<input type="hidden" name="products_id" id="products_id">
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label>Project Name</label>
								<input class="form-control" name="project_name" id="edit_project_name" type="text">
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label>Client</label>
								<select  name="client_id1" id="client_id1" class="form-control required">
								<?php
									$sel_query = "Select * from Client";
									$res_data = mysqli_query($con,$sel_query);	
									while($clientdata = mysqli_fetch_assoc($res_data)){
										/*echo "<pre>";
										print_r($clientdata);*/
								?>
									<option value="<?php echo $clientdata['id'];?>"><?php echo $clientdata['first_name'] .'&nbsp;&nbsp;'.$clientdata['last_name'];?></option>
									<?php } ?>
								</select>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label>Start Date</label>
								<div class="cal-icon"><input class="form-control datetimepicker" id="edit_start_date" type="text" name="start_date"></div>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label>End Date</label>
								<div class="cal-icon"><input class="form-control datetimepicker" id="edit_end_date" type="text" name="end_date"></div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-3">
							<div class="form-group">
								<label>Rate</label>
								<input placeholder="$50" class="form-control" id="edit_rate" name="rate" type="text">
							</div>
						</div>
						<div class="col-md-3">
							<div class="form-group">
								<label>&nbsp;</label>
								<select class="select" name="billing_type">
									<option value="Hourly">Hourly</option>
									<option value="Fixed">Fixed</option>
								</select>
							</div>
						</div>
						<div class="form-group col-sm-3">
							<label>Total Hours <span class="text-danger">*</span></label>
							<input class="form-control digit_only" type="text" value="" name="pro_total_hour" id="pro_total_hour">
						</div>
						<div class="col-md-3">
							<div class="form-group">
								<label>Priority</label>
								<select class="form-control" name="Priority" id="edit_Priority">
									<option value="0">High</option>
									<option value="1">Medium</option>
									<option value="2">Low</option>
								</select>
							</div>
						</div>
					</div>
					<div class="row">

						<div class="col-md-6">
							<div class="form-group">
								<label>Add Project Leader</label>
								<input class="form-control" type="text" id="edit_project_leader" name="edit_project_leader[]">	
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label>Team Leader</label>
								<div class="project-members">
									<a href="#" data-toggle="tooltip" title="Jeffery Lalor">
										<img src="assets/img/user.jpg" class="avatar" alt="Jeffery Lalor" height="20" width="20">
									</a>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label>Add Team</label>
								<input class="form-control" type="text" id="edit_team" name="edit_team[]">
							</div>							
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label>Team Members</label>
								<div class="project-members">
									<a href="#" data-toggle="tooltip" title="John Doe">
										<img src="assets/img/user.jpg" class="avatar" alt="John Doe" height="20" width="20">
									</a>
									<a href="#" data-toggle="tooltip" title="Richard Miles">
										<img src="assets/img/user.jpg" class="avatar" alt="Richard Miles" height="20" width="20">
									</a>
									<a href="#" data-toggle="tooltip" title="John Smith">
										<img src="assets/img/user.jpg" class="avatar" alt="John Smith" height="20" width="20">
									</a>
									<a href="#" data-toggle="tooltip" title="Mike Litorus">
										<img src="assets/img/user.jpg" class="avatar" alt="Mike Litorus" height="20" width="20">
									</a>
									<span class="all-team">+2</span>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label>Project Address</label>
								<input class="form-control" type="text" name="edit_project_address" id="edit_project_address">
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label>Map Here</label>
								<div class="google_map_pr">
									<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d109741.0291293599!2d76.69348833302669!3d30.73506264415007!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x390fed0be66ec96b%3A0xa5ff67f9527319fe!2sChandigarh!5e0!3m2!1sen!2sin!4v1530000938881" width="100%" height="100%" frameborder="0" style="border:0" allowfullscreen></iframe>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label>Add Machines</label>
								<input class="form-control" type="text" name="edit_machines[]" id="edit_machines">
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label>Machines</label>
								<div class="project-members">
									<a href="#" data-toggle="tooltip" title="John Doe">
										<img src="assets/img/user.jpg" class="avatar" alt="John Doe" height="20" width="20">
									</a>
									<a href="#" data-toggle="tooltip" title="Richard Miles">
										<img src="assets/img/user.jpg" class="avatar" alt="Richard Miles" height="20" width="20">
									</a>
									<a href="#" data-toggle="tooltip" title="John Smith">
										<img src="assets/img/user.jpg" class="avatar" alt="John Smith" height="20" width="20">
									</a>
									<a href="#" data-toggle="tooltip" title="Mike Litorus">
										<img src="assets/img/user.jpg" class="avatar" alt="Mike Litorus" height="20" width="20">
									</a>
									<span class="all-team">+2</span>
								</div>
							</div>
						</div>
					</div>


					<div class="row material-sec">
						<label class="ad-merti">Add Materials</label>
						

				<?php

				$sql= "SELECT * from material";
				$res_data4 = mysqli_query($con,$sql);

				$NewMaterialName = array();
					while($rowData4 = mysqli_fetch_assoc($res_data4)){ ?>
						
						<?php
						//  echo"<pre>";
						// print_r($rowData3); 
						//  echo"</pre>";
						 ?>
						<div class="col-md-3">
							<div class="form-group">

						<input type="checkbox" id="edit_materials123" class="form-control123" name="edit_materials[]" value="<?php echo $rowData4['id']; ?>" ><span><?php echo $rowData4['materials_name']; ?></span><br>
							</div>
						</div>
					
						<div class="col-md-3">
							 <div class="form-group">
								<label>Total amount </label> <br>
								<p id="amounttotal_value<?php echo $rowData4['id']; ?>" class="amounttotal" value="<?php echo $rowData4['amount']; ?>" data-overlay="<?php echo $rowData4['amount']; ?>"><?php echo $rowData4['amount']; ?></p>
								<!-- <input id="amount" type="text" class="form-control" name="amount" readonly value="<?php echo $rowData3['amount']; ?>"> -->
							</div> 
						</div>


						

						<div class="col-md-3">
							<div class="form-group consvalue">
								<label>Consumption</label>
								<p style="display: none;"><?php echo $rowData4['amount']; ?></p>
								<input id="consumption_value<?php echo $rowData4['id']; ?>" type="number" class="form-control consumption" name="consumption[]" >
								<p id="consumption_value2"></p>
							</div>
						</div>

					

						<div class="col-md-3">
							<div class="form-group">
								<label>Remaining amount</label>
								
								<input id="remain_amount_value<?php echo $rowData4['id']; ?>" type="text" class="form-control remain_amount" name="remain_amount[]" readonly value="" >
							</div>
						</div>


<script>
$(document).ready(function(){

 var id = "<?php echo $rowData4['id']; ?>";
 var div_id = "<?php echo '#consumption_value'.$rowData4['id']; ?>";
 var nextcls = "<?php echo '#remain_amount_value'.$rowData4['id']; ?>";

$(div_id).on('keyup',function(){

     var consumation_qty = $(this).prev().text();
      var cons_val = $(this).val();
      
      var sum = consumation_qty - cons_val;
   
      var consumation_qty = $(this).next().text();
    

    $(nextcls).val(sum);
		
});






});
</script>

	


							
					 	<?php	}	?>

					 	
					<!-- <div class="row">

							<div class="form-group">
								<label>Edit Materials</label>
								<input class="form-control" type="text" name="edit_materials[]" id="edit_materials">
							</div>
						</div>
						 <div class="col-md-6"> 
							<div class="form-group">
								<label>Materials</label>

						


						<div class="col-md-6">
							<div class="form-group">
								<label>Add Materials</label>
								<input class="form-control" type="text" name="edit_materials[]" id="edit_materials">
							</div>
						</div> 
						<div class="col-md-6">
							<div class="form-group">
								<label>Materials</label>
								<div class="project-members">
									<a href="#" data-toggle="tooltip" title="John Doe">
										<img src="assets/img/user.jpg" class="avatar" alt="John Doe" height="20" width="20">
									</a>
									<a href="#" data-toggle="tooltip" title="Richard Miles">
										<img src="assets/img/user.jpg" class="avatar" alt="Richard Miles" height="20" width="20">
									</a>
									<a href="#" data-toggle="tooltip" title="John Smith">
										<img src="assets/img/user.jpg" class="avatar" alt="John Smith" height="20" width="20">
									</a>
									<a href="#" data-toggle="tooltip" title="Mike Litorus">
										<img src="assets/img/user.jpg" class="avatar" alt="Mike Litorus" height="20" width="20">
									</a>
									<span class="all-team">+2</span>
								</div>
							</div>
						</div>
					</div> -->
					<div class="form-group">
						<label>Description</label>
						<textarea rows="4" cols="5" class="form-control summernote" id="edit_description" placeholder="Enter your message here" name="description"></textarea>
					</div>
					<div class="form-group">
						<label>Upload Files</label>
						<input class="form-control" type="file" name="image">
						<img id="edit_image" height="150" width="150">
						<input type="hidden" name="hidden_image" id="hidden_image">
					</div>
					<div class="m-t-20 text-center">
						<button class="btn btn-primary" name="update_project" value="update" >Save Changes</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>			
		
		<div class="sidebar-overlay" data-reff="#sidebar"></div>
       <!-- <script type="text/javascript" src="assets/js/jquery-3.2.1.min.js"></script> -->
        <script type="text/javascript" src="assets/js/bootstrap.min.js"></script>
		<script type="text/javascript" src="assets/js/jquery.dataTables.min.js"></script>
		<script type="text/javascript" src="assets/js/dataTables.bootstrap.min.js"></script>
		<script type="text/javascript" src="assets/js/jquery.slimscroll.js"></script>
		<script type="text/javascript" src="assets/js/select2.min.js"></script>
		<script type="text/javascript" src="assets/js/moment.min.js"></script>
		<script type="text/javascript" src="assets/js/bootstrap-datetimepicker.min.js"></script>
		<script type="text/javascript" src="assets/js/app.js"></script>
			<script type="text/javascript" src="assets/plugins/summernote/dist/summernote.min.js"></script>
		<script src="https://cdn.jsdelivr.net/jquery.validation/1.15.1/jquery.validate.min.js"></script>
			<script type="text/javascript" src="assets/js/typeahead.js"></script>
		<script type="text/javascript">
			jQuery(function() {
				
				$('#project_leader').tagsinput({								 
				  typeahead: {
				    source: function(query) {

				    	return $.getJSON('/civilpro/teamleader.php?term=' + query);			
				    },
				    afterSelect: function() {
				    	this.$element[0].value = '';
				    }
				  },
				  onTagExists: function(item, $tag) {
				    $tag.hide().fadeIn();
				  }

				}); 

				$('#team_name').tagsinput({								 
				  typeahead: {
				    source: function(query) {
				    	return $.getJSON('/civilpro/teammember.php?term=' + query);			
				    },
				    afterSelect: function() {
				    	this.$element[0].value = '';
				    }
				  },
				  onTagExists: function(item, $tag) {
				    $tag.hide().fadeIn();
				  }

				}); 
				$('#machine').tagsinput({								 
				  typeahead: {
				    source: function(query) {
				    	return $.getJSON('/civilpro/automachine.php?term=' + query);			
				    },
				    afterSelect: function() {
				    	this.$element[0].value = '';
				    }
				  },
				  onTagExists: function(item, $tag) {
				    $tag.hide().fadeIn();
				  }

				}); 

				$('#materials').tagsinput({								 
				  typeahead: {
				    source: function(query) {
				    	return $.getJSON('/civilpro/automaterial.php?term=' + query);			
				    },
				    afterSelect: function() {
				    	this.$element[0].value = '';
				    }
				  },
				  onTagExists: function(item, $tag) {
				    $tag.hide().fadeIn();
				  }

				});

				$('#edit_project_leader').tagsinput({								 
				  typeahead: {
				    source: function(query) {
				    	return $.getJSON('/civilpro/teamleader.php?term=' + query);			
				    },
				    afterSelect: function() {
				    	this.$element[0].value = '';
				    }
				  },
				  onTagExists: function(item, $tag) {
				    $tag.hide().fadeIn();
				  }

				}); 
			   
			    $('#edit_team').tagsinput({								 
				  typeahead: {
				    source: function(query) {
				    	return $.getJSON('/civilpro/teammember.php?term=' + query);			
				    },
				    afterSelect: function() {
				    	this.$element[0].value = '';
				    }
				  },
				  onTagExists: function(item, $tag) {
				    $tag.hide().fadeIn();
				  }

				});

				$('#edit_machines').tagsinput({								 
				  typeahead: {
				    source: function(query) {
				    	return $.getJSON('/civilpro/automachine.php?term=' + query);			
				    },
				    afterSelect: function() {
				    	this.$element[0].value = '';
				    }
				  },
				  onTagExists: function(item, $tag) {
				    $tag.hide().fadeIn();
				  }

				}); 
				/*$('#edit_materials').tagsinput({								 
				  typeahead: {
				    source: function(query) {
				    	return $.getJSON('/civilpro/automaterial.php?term=' + query);			
				    },
				    afterSelect: function() {
				    	this.$element[0].value = '';
				    }
				  },
				  onTagExists: function(item, $tag) {
				    $tag.hide().fadeIn();
				  }

				}); */			
				
			});
		</script>
        <script>
		$(document).ready(function(){
			$('.summernote').summernote({
				height: 200,                 // set editor height
				minHeight: null,             // set minimum height of editor
				maxHeight: null,             // set maximum height of editor
				focus: false                 // set focus to editable area after initializing summernote
			});
		});
        </script>
		<script>
		// Wait for the DOM to be ready
$(function() {
  // Initialize form validation on the registration form.
  // It has the name attribute "registration"
  $("form[name='projectsform']").validate({
    // Specify validation rules
    rules: {
      // The key name on the left side is the name attribute
      // of an input field. Validation rules are defined
      // on the right side
      project_name: "required",
	  
	  start_date: "required",
	  end_date : "required",
	  rate : "required",
      project_leader : "required",
      machine : "required",
      materials : "required",
      team_name : "required",
     project_address : "required",
	 description : "required",
	 pro_total_hour:"required",
     },
    // Specify validation error messages
    messages: {
      project_name: "Please enter your project name",
	  client_id: {
      required: "Please select an option from the list, if none are appropriate please select 'Other'",
     },
	 start_date :"Please enter start date fields",
	 end_date : "Please enter end date fields",
	 rate : "Please enter rate fields",
	 pro_total_hour:"Please enter total Hours",
	 project_leader: "Please enter project leader",
	 team_name : "Please enter team name",
	 project_address : "Please enter Project Address",
	 machine : "Please enter machine name",
	 materials : "Please enter materials name",
	 description : "Please enter description",
      },
    // Make sure the form is submitted to the destination defined
    // in the "action" attribute of the form when valid
    submitHandler: function(form) {
      form.submit();
    }
  });
});

$(function() {
  // Initialize form validation on the registration form.
  // It has the name attribute "registration"
  $("form[name='editform']").validate({
    // Specify validation rules
    rules: {
      // The key name on the left side is the name attribute
      // of an input field. Validation rules are defined
      // on the right side
      project_name: "required",
	  start_date: "required",
	  end_date : "required",
	  rate : "required",
      project_leader : "required",
      machine : "required",
      materials : "required",
      team_name : "required",
     project_address : "required",
	 description : "required",
	 pro_total_hour:"required",
     },
    // Specify validation error messages
    messages: {
      project_name: "Please enter your project name",
	  client_id1: {
      required: "Please select an option from the list, if none are appropriate please select 'Other'",
     },
	 start_date :"Please enter start date fields",
	 end_date : "Please enter end date fields",
	 rate : "Please enter rate fields",
	 pro_total_hour:"Please enter total Hours",
	 project_leader: "Please enter project leader",
	 team_name : "Please enter team name",
	 project_address : "Please enter Project Address",
	 machine : "Please enter machine name",
	 materials : "Please enter materials name",
	 description : "Please enter description",
      },
    // Make sure the form is submitted to the destination defined
    // in the "action" attribute of the form when valid
    submitHandler: function(form) {
      form.submit();
    }
  });
});

 $(".datetimepicker").datetimepicker({
        format: "YYYY-MM-DD"
        
    });

$(document).ready(function(){
    $(".edit").click(function(){
    var Proid = $(this).attr("data-id");
	Projectid = {project_id : Proid}
    $.ajax({
        url: "teamleader_edit.php",
        type: 'POST',
		data: Projectid,
        dataType: 'json', // added data type
        success: function(res) {
		
		    if(res.status= "sucess"){
				$('#edit_Priority option[value='+res.data.Priority+']').attr('selected','selected');
				$("#products_id").val(res.data.Project_id);
				$("#edit_project_name").val(res.data.Project_name);
				//$("#client_id_name").val(res.data.Client_id);
				$("#edit_start_date").val(res.data.Start_date);
				$("#edit_end_date").val(res.data.end_date);
				$("#edit_rate").val(res.data.Rate);
				$('#pro_total_hour').val(res.data.Total_hours);
				$(".note-editable").html(res.data.decription);
				$("#edit_description").val(res.data.decription);
				$("#edit_project_address").val(res.data.Project_Address);
				//$("#edit_project_leader").val(res.data.Project_leader);
				var finalArry = res;

				//$("#edit_team").val(res.data.Team_member);
				//console.log(res.data.Team_member);
				if(res.data.Project_leader != ""){
					$.each(finalArry, function(index, value) {
				    $('#edit_project_leader').tagsinput('add', value.Project_leader);
				    //console.log(value.Project_leader);
				});
				}			
				
				if(res.data.Team_member != ""){
					$.each(finalArry, function(index, value) {
				    	$('#edit_team').tagsinput('add', value.Team_member);
				    	//console.log(value.Team_member);
					});
				}
				if(res.data.machine != ""){
					$.each(finalArry, function(index, value) {
				    	$('#edit_machines').tagsinput('add', value.machine);
				    	//console.log(value.Team_member);
					});
				}
				
				if(res.data.material != ""){
					$.each(finalArry, function(index, value) {
				    	$('').tagsinput('add', value.material);
				    	//console.log(value.Team_member);
					});
				}

				//alert(res.data.consumption);
				//alert('#consumption_value'+(res.data.Project_id));
				if(res.data.consumption != ""){
					$.each(finalArry, function(index, value) {
				    	$('#consumption_value2').tagsinput('add', value.consumption);
				    	//console.log(value.Team_member);
					});
				}

				//$("#edit_materials").val(res.data.material);
				
				$("#select2-Priority-d1-container").text(res.data.new_priority);
				$('#edit_image').attr('src', 'Upload/project/'+res.data.images);
				console.log(res.data.images);
				$("#hidden_image").val(res.data.images);
				$('#client_id1 option[value='+res.data.Client_id+']').attr('selected','selected');
				$("#select2-client_id1-container").text(res.data.client_name);
			}else{
			 alert('fail');
			}           
     	}
    });
    
});

$('#add_machine').typeahead({
    source: function (query, result) {
        $.ajax({
            url: "get_machine.php",
			data: 'query=' + query,            
            dataType: "json",
            type: "POST",
            success: function (data) {
				result($.map(data, function (item) {
					return item;
                }));
            }
        });
    }
});
		
$('#add_materials').typeahead({
    source: function (query, result) {
        $.ajax({
            url: "get_materials.php",
			data: 'query=' + query,            
            dataType: "json",
            type: "POST",
            success: function (data) {
				result($.map(data, function (item) {
					return item;
                }));
            }
        });
    }
});
	
	$('.Approve').click(function(event){
	var id = $(this).attr('data-id');
	var Approve = '1';
	var time_carddd = 'approve_project_act';
 $.ajax({
               url: "approve_ajax.php",
               data: {Approve: Approve, time_carddd: time_carddd, id: id},
               //dataType: "json",
               type: "POST",
               success: function (data) {
                   if(data == '1')
                   location.reload();
                   }
               });
           });

//active and deactive
$('.Decline').click(function(event){
	var id = $(this).attr('data-id');
	var Approve = '0';
	var time_carddd = 'approve_project_act';
	
$.ajax({
               url: "approve_ajax.php",
               data: {Approve: Approve, time_carddd: time_carddd, id: id},
               //dataType: "json",
               type: "POST",
               success: function (data) {
                   if(data == '1'){
                   location.reload();
                   }
               }
           });

});

	// High Medium Low
	$('.High').click(function(event){
	var id = $(this).attr('data-id');
	var Approve = '0';
	var approve_Priority = 'approve_Priority';
	
$.ajax({
               url: "approve_ajax.php",
               data: {Approve: Approve, approve_Priority: approve_Priority, id: id},
               //dataType: "json",
               type: "POST",
               success: function (data) {
				   
                   if(data == '1'){
                   location.reload();
                   }
               }
           });
});
	
	// High Medium Low
	$('.Medium').click(function(event){
		
	var id = $(this).attr('data-id');
	var Approve = '1';
	var approve_Priority = 'approve_Priority';
$.ajax({
               url: "approve_ajax.php",
               data: {Approve: Approve, approve_Priority: approve_Priority, id: id},
               
               type: "POST",
               success: function (data) {
                   if(data == '1'){
                   location.reload();
                   }
               }
           });
});
	//  Medium Low
	$('.Low').click(function(event){
	var id = $(this).attr('data-id');
	var Approve = '2';
	var approve_Priority = 'approve_Priority';
$.ajax({
               url: "approve_ajax.php",
               data: {Approve: Approve, approve_Priority: approve_Priority, id: id},
               //dataType: "json",
               type: "POST",
               success: function (data) {
                   if(data == '1'){
                   location.reload();
                   }
               }
           });
});
	
});	
	
</script>
<script type="text/javascript">
$(function() 
{
 $( "#coding_language" ).autocomplete({
  source: 'autocomplete.php'
 });

 	$('.digit_only').keypress(function(event){
       if(event.which != 8 && isNaN(String.fromCharCode(event.which))){
           event.preventDefault(); //stop character from entering input
       }
      });


});
</script>
	<style>
	.error{
	color:red;
	}
</style>	
    </body>
</html>	<?php } ?>
