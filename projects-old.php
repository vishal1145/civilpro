<!-- <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css"> -->
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

$sql = "DELETE FROM Project where Project_id=$project_id";
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
    $project_leader = $_POST['project_leader'];
    $team_name = $_POST['team_name'];
    $project_address = $_POST['project_address'];
    $machine = $_POST['machine'];
    $materials = $_POST['materials'];
    $description = mysqli_real_escape_string($con,$_POST['description']); 
	$image = $_FILES['image']['name'];
	$target = "Upload/project/".basename($image);
	 $log_user_qury = "INSERT INTO Project (Project_name, Client_id,Start_date,end_date,Rate,billing_type,Priority,Project_leader,Team_member,Project_Address,machine,material,decription,images)
     VALUES ('$project_name', '$client_id', '$start_date','$end_date','$rate','$billing_type','$priority','$project_leader','$team_name','$project_address','$machine','$materials','$description','$image')";
	 
	/*  echo $log_user_qury; */
	 
    $res_data = mysqli_query($con,$log_user_qury);	
	if (move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
	}
}

if(isset($_POST['update_project'])){
/* print_r($_POST); */
    $products_id  = $_POST['products_id'];
    $project_name = $_POST['project_name'];
    $client_id = $_POST['client_id1'];
    $start_date = $_POST['start_date'];
    $end_date = $_POST['end_date'];
    $rate = $_POST['rate'];
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
	
    
    
	
	
  $sql =  "UPDATE Project
SET Project_name='$project_name', Client_id='$client_id',Start_date='$start_date',end_date='$end_date',Rate='$rate',decription='$description',images='$image' WHERE Project_id=$products_id";

/* echo $_POST['hidden_image'];
echo "asd" .$image;
echo $sql;
 die; */
$res_data = mysqli_query($con, $sql);	
   
	if($res_data){ echo "Records updated successfully";

		//$redirect_url =  'http://112.196.9.211:8888/civilpro/projects.php'; ?>
		<!-- <script>
	       setTimeout(function(){window.location.href='<?php //echo $redirect_url ?>'},3000);
	    </script> -->
	<?php 
		header('Location: http://112.196.9.211:8888/civilpro/projects.php');
	}
}


if(isset($_POST['search_project'])){
$project_name = $_POST['project_name'];
$employee_name = $_POST['employee_name'];
$role = $_POST['role'];
  $Sel_query = array();
  if(!empty($project_name )){
  
  $Sel_query[] = " Project_name like '%$project_name%'";
  }
  if(!empty($employee_name)){
   $Sel_query[] = " employee_name like '%$employee_name%'";
  
  }
if(!empty($role)){

 $Sel_query[] = " designation like '%$role%'";
}



$fullQuery = implode(" OR ",$Sel_query);

echo $fullQuery; 
$sel_query = "Select * from Project WHERE Project_name LIKE '%$project_name%'";
}else{
$sel_query = "Select * from Project";
}
$res_data = mysqli_query($con,$sel_query);	

	


?>
         
            <div class="page-wrapper">
                <div class="content container-fluid">
					<div class="row">
						<div class="col-xs-4">
							<h4 class="page-title">Projects</h4>
						</div>
						<div class="col-xs-8 text-right m-b-30">
							<a href="#" class="btn btn-primary rounded pull-right" data-toggle="modal" data-target="#create_project"><i class="fa fa-plus"></i> Create Project</a>
							<div class="view-icons">
								<a href="projects.php" class="grid-view btn btn-link active"><i class="fa fa-th"></i></a>
								<a href="project-list.php" class="list-view btn btn-link"><i class="fa fa-bars"></i></a>
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
								<label class="control-label">Employee Name</label>
								<input type="text" class="form-control floating" name="employee_name" />
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
						</div>
						<div class="col-sm-3 col-xs-6">  
							<input type="submit" class="btn btn-success btn-block" value="Search" name="search_project">  
						</div> 
						</form>						
                    </div>
					<div class="row">
					<?php
					while($rowData = mysqli_fetch_assoc($res_data)){
                         
                    
?><div id="delete_project<?php echo $rowData['Project_id'];?>" class="modal custom-modal fade" role="dialog">
				<div class="modal-dialog">
					<div class="modal-content modal-md">
						<div class="modal-header">
							<h4 class="modal-title">Delete Project</h4>
						</div>
						<div class="modal-body card-box">
							<p>Are you sure want to delete this?</p>
							<div class="m-t-20"> <form action="" method="POST"><a href="#" class="btn btn-default" data-dismiss="modal">Close</a>
							
								<button type="submit" class="btn btn-danger delete_pro" value="delete" name="delete_project">Delete</button>
								<input type="hidden"  name="project_id" value="<?php echo $rowData['Project_id'];?>">
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
						<div class="col-lg-3 col-sm-4">
					
							<div class="card-box project-box">
								<div class="dropdown profile-action">
									<a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
									<ul class="dropdown-menu pull-right">
										<li><a href="#" data-toggle="modal" data-target="#create_project1" data-id="<?php echo $rowData['Project_id'];?>" class="edit"><i class="fa fa-pencil m-r-5"></i> Edit</a></li>
										<li><a href="#" data-toggle="modal" data-target="#delete_project<?php echo $rowData['Project_id'];?>" data-id="<?php echo $rowData['Project_id'];?>" id="delete"><i class="fa fa-trash-o m-r-5"></i> Delete</a></li>
									</ul>
								</div>
								<h4 class="project-title"><a href="project-view.html"><?php echo $rowData['Project_name'];?></a></h4>
								<small class="block text-ellipsis m-b-15">
									<span class="text-xs">1</span> <span class="text-muted">open tasks, </span>
									<span class="text-xs">9</span> <span class="text-muted">tasks completed</span>
								</small>
								<p class="text-muted"><?php echo substr(strip_tags($rowData['decription']),0,200); ?>
								</p>
								<div class="pro-deadline m-b-15">
									<div class="sub-title">
										Deadline:
									</div>
									<div class="text-muted">
										8 Sep 2017
									</div>
								</div>
								<div class="project-members m-b-15">
									<div>Project Leader :</div>
									<ul class="team-members">
										<li>
											<a href="#" data-toggle="tooltip" title="Jeffery Lalor"><img src="assets/img/user.jpg" alt="Jeffery Lalor"></a>
										</li>
									</ul>
								</div>
								<div class="project-members m-b-15">
									<div>Team :</div>
									<ul class="team-members">
										<li>
											<a href="#" data-toggle="tooltip" title="John Doe"><img src="assets/img/user.jpg" alt="John Doe"></a>
										</li>
										<li>
											<a href="#" data-toggle="tooltip" title="Richard Miles"><img src="assets/img/user.jpg" alt="Richard Miles"></a>
										</li>
										<li>
											<a href="#" data-toggle="tooltip" title="John Smith"><img src="assets/img/user.jpg" alt="John Smith"></a>
										</li>
										<li>
											<a href="#" data-toggle="tooltip" title="Mike Litorus"><img src="assets/img/user.jpg" alt="Mike Litorus"></a>
										</li>
										<li>
											<a href="#" class="all-users">+15</a>
										</li>
									</ul>
								</div>
								<p class="m-b-5">Progress <span class="text-success pull-right">40%</span></p>
								<div class="progress progress-xs m-b-0">
									<div class="progress-bar progress-bar-success" role="progressbar" data-toggle="tooltip" title="40%" style="width: 40%"></div>
								</div>
							</div>
						</div>
						
						
						<?php } ?>
					</div>
                </div>
				<?php include_once "notification-box.php"; ?>
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
									<div class="col-md-6">
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
											<input class="form-control" type="text" name="project_leader">
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
											<input class="form-control" type="text" name="team_name">
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
											<input class="form-control typeahead" type="text" name="machine" id="add_machine" autocomplete="off">
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
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label>Add Materials</label>
											<input class="form-control" type="text" name="materials" id="add_materials">
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
								</div>
								<div class="form-group">
									<label>Description</label>
									<textarea rows="4" cols="5" class="form-control summernote" placeholder="Enter your message here" name="description"></textarea>
								</div>
								<div class="form-group">
									<label>Upload Files</label>
									<input class="form-control" type="file" name="image">
								</div>
								<div class="m-t-20 text-center">
									<button class="btn btn-primary" name="create_project" value="create">Create Project</button>
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
									<div class="col-md-6">
										<div class="form-group">
											<label>Priority</label>
											<select class="select" name="Priority">
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
											<input class="form-control" type="text" id="edit_project_leader">
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
											<input class="form-control" type="text" id="edit_team">
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
									<button class="btn btn-primary" name="update_project" value="update">Save Changes</button>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>


<!-- 	<link rel="stylesheet" type="text/css" href="http://code.jquery.com/ui/1.10.4/themes/ui-lightness/jquery-ui.css"/>
	<link rel="stylesheet" type="text/css" href="assets/autocomplete/css/style.css"/>	
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script> 
	<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.4/jquery-ui.min.js"></script>
	<script src="assets/autocomplete/css/autocomplete.multiselect.js"></script>
<div class="main-div">
	<h2>Autocomplete multiselect jquery Example</h2>
	<input id="myAutocompleteMultiple" type="text" />
</div>

<script type="text/javascript">
	$(function(){
		var availableTags = [
		    "Laravel",
		    "Bootstrap",
		    "Server",
		    "JavaScript",
		    "JQuery",
		    "Perl",
		    "PHP",
		    "Python",
		    "Ruby",
		    "API",
		    "Scheme"
		];

		$('#myAutocompleteMultiple').autocomplete({
			source: availableTags,
			multiselect: true
		});
	});
</script> -->


































			
   
		<div class="sidebar-overlay" data-reff="#sidebar"></div>
        <script type="text/javascript" src="assets/js/jquery-3.2.1.min.js"></script>			
        <script type="text/javascript" src="assets/js/bootstrap.min.js"></script>
		<script type="text/javascript" src="assets/js/jquery.slimscroll.js"></script>
		<script type="text/javascript" src="assets/js/select2.min.js"></script>
		<script type="text/javascript" src="assets/js/moment.min.js"></script>
		<script type="text/javascript" src="assets/js/bootstrap-datetimepicker.min.js"></script>
		<script type="text/javascript" src="assets/js/app.js"></script>
		<script type="text/javascript" src="assets/plugins/summernote/dist/summernote.min.js"></script>
		<script src="https://cdn.jsdelivr.net/jquery.validation/1.15.1/jquery.validate.min.js"></script>
		<script type="text/javascript" src="assets/js/typeahead.js"></script>
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
		// Wait for the DOM to be ready
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

$(document).ready(function(){
    $(".edit").click(function(){
    var Proid = $(this).attr("data-id");
	Projectid = {project_id : Proid}
    $.ajax({
        url: "update_project.php",
        type: 'POST',
		data: Projectid,
        dataType: 'json', // added data type
        success: function(res) {
		    if(res.status= "sucess"){
				$("#products_id").val(res.data.Project_id);
				$("#edit_project_name").val(res.data.Project_name);
				//$("#client_id_name").val(res.data.Client_id);
				$("#edit_start_date").val(res.data.Start_date);
				$("#edit_end_date").val(res.data.end_date);
				$("#edit_rate").val(res.data.Rate);
				$(".note-editable").html(res.data.decription);
				$("#edit_description").val(res.data.decription);
				$("#edit_project_leader").val(res.data.Project_leader);
				$("#edit_team").val(res.data.Team_member);
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
   
});




 $(".datetimepicker").datetimepicker({
        format: "YYYY-MM-DD"
        
    });
</script>


	<style>	.error{	color:red;	}</style>	

    </body>
</html>

<?php } ?>