<?php
session_start();
include "header.php";
include "sidebar.php";

$obj = new  connection();
$con = $obj->connect();

$user_id = $_SESSION['user_id'];

//if(isset($_SESSION['user_id'])){


	if(isset($_POST['create_designation'])){
	 $designation_name = $_POST['designation_name'];
		 $department_info  = $_POST['department_info'];
		$time_set  		  = time();
		$log_user_qury = "INSERT INTO designation (designation_name,department_name,time_set)
		VALUES ('$designation_name','$department_info',$time_set)";
		$res_data = mysqli_query($con,$log_user_qury);

			if($res_data){ 
				echo "Records updated successfully";
				header('Location: http://112.196.9.211:8888/civilpro/designations.php');
		}

	}


	if(isset($_POST['delete_designation'])){
		$designation_id = $_POST['designation_id'];
		$sql = "DELETE FROM designation where designation_id=$designation_id";
		$res_data = mysqli_query($con,$sql);
	}

if(isset($_POST['update_designation'])){
//	
 	$designation_name = $_POST['designation_name'];
	$department_name = $_POST['department_name'];
	$designation_id = $_POST['designation_id'];

/*echo"<pre>";
	print_r($designation_id);
	echo"<pre>";

echo "UPDATE designation SET designation_name='$designation_name', department_name= '$department_name' WHERE designation_id=$designation_id";*/

	$sql =  "UPDATE designation SET designation_name='$designation_name', department_name= '$department_name' WHERE designation_id=$designation_id";
	
	 $res_data = mysqli_query($con, $sql);	
   
	if($res_data){ echo "Records updated successfully";

		//$redirect_url =  'http://112.196.9.211:8888/civilpro/projects.php'; ?>
		<!-- <script>
	       setTimeout(function(){window.location.href='<?php echo $redirect_url ?>'},3000);
	    </script> -->
	<?php 
		header('Location: http://112.196.9.211:8888/civilpro/designations.php');
	}

	}

//}



	



?>
            <div class="page-wrapper">
            	<div class="content container-fluid">
					<div class="row">
						<div class="col-sm-8">
							<h4 class="page-title">Designations</h4>
						</div>
						<div class="col-sm-4 text-right m-b-30">
							<a href="#" class="btn btn-primary rounded" data-toggle="modal" data-target="#add_designation"><i class="fa fa-plus"></i> Add New Designation</a>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12">
							<div class="table-responsive">
								<table class="table table-striped custom-table m-b-0 datatable">
									<thead>
										<tr>
											<th>Sr. No.</th>
											<th>Designation </th>
											<th>Department </th>
											<th class="text-right">Action</th>
										</tr>
									</thead>
									<tbody>
									<?php
									$sel_query = "Select * from designation ORDER BY time_set DESC";
									$res_data = mysqli_query($con,$sel_query);	
									$i = 1;
									while($deprow = mysqli_fetch_assoc($res_data)){
									
										$department = "SELECT * FROM department WHERE department_id=".$deprow['department_name'];
										$result = mysqli_query($con,$department);
									 
									
									?>
									
										<tr>
											<td><?php echo $i; ?></td>
											<td><?php echo $deprow['designation_name']; ?></td>
											<?php while($data = mysqli_fetch_row($result)){ ?>
											<td><?php echo $data[1]; ?></td>
										<?php } ?>
											<td class="text-right">
												<div class="dropdown">
													<a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
													<ul class="dropdown-menu pull-right">
														<!-- <li><a href="#" data-toggle="modal" data-target="#edit_designation<?php //echo $deprow['designation_id'];?>" title="Edit"><i class="fa fa-pencil m-r-5"></i> Edit</a></li> -->
														<li><a href="#" data-toggle="modal" data-target="#designation_edit" data-id="<?php echo $deprow['designation_id'];?>" class="editdesignation"><i class="fa fa-pencil m-r-5"></i> Edit</a></li>

														<li><a href="#" data-toggle="modal" data-target="#delete_designation<?php echo $deprow['designation_id'];?>" title="Delete"><i class="fa fa-trash-o m-r-5"></i> Delete</a></li>
													</ul>
												</div>
											</td>
										</tr>
										<?php $i++; ?>

										

									<!-- <script type="text/javascript">
										$(document).ready(function(){
											$("#update_designation").click(function(){
											    console.log("heelo");
											});
										});
										
									</script> -->



								<?php } ?>
									</tbody>
								</table>
							</div>
						</div>
					</div>
                </div>
			<?php include_once "notification-box.php"; ?>
            </div>
			
			<?php                   
			$sel_query = "Select * from designation";
			$res_data = mysqli_query($con,$sel_query);	
			$i = 1;
			while($deprow = mysqli_fetch_assoc($res_data)){ 
			?>
			<div id="delete_designation<?php echo $deprow['designation_id'];?>" class="modal custom-modal fade" role="dialog">
				<div class="modal-dialog">
					<div class="modal-content modal-md">
						<div class="modal-header">
							<h4 class="modal-title">Delete Designation</h4>
						</div>
						<div class="modal-body card-box">
						<form method="POST">
							<p>Are you sure want to delete this?</p>
							<div class="m-t-20 text-left">
								<a href="#" class="btn btn-default" data-dismiss="modal">Close</a>
								<input type="hidden" name="designation_id" value="<?php echo $deprow['designation_id'];?>">
								<button type="submit" class="btn btn-danger" value="delete" name="delete_designation">Delete</button>
							</div>
							</form>
						</div>
					</div>
				</div>
			</div>
			<?php } ?>
			<div id="add_designation" class="modal custom-modal fade" role="dialog">
				<div class="modal-dialog">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<div class="modal-content modal-md">
						<div class="modal-header">
							<h4 class="modal-title">Add Designation</h4>
						</div>
						<div class="modal-body">
							<form method="POST">
								<div class="form-group">
									<label>Designation Name <span class="text-danger">*</span></label>
									<input class="form-control" type="text" name="designation_name">
								</div>
								<div class="form-group">
									<label>Department Name <span class="text-danger">*</span></label>
									<select name="department_info" class="select">
									<option>select Designation</option>
										<?php 

											$department = "SELECT * FROM department";
											$result = mysqli_query($con,$department);
											while($data = mysqli_fetch_array($result)){ 
										 ?>
										 <option value="<?php echo $data['department_id']; ?>"><?php echo $data['department_name']; ?></option>

										 <?php } ?>
									</select>
									<!-- <input class="form-control" type="text" name="department_name"> -->
								</div>
								<div class="m-t-20 text-center">
									<button class="btn btn-primary" value="create" name="create_designation"  >Create Designation</button>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
			<?php  
			                
		/*	$sel_query = "Select * from designation";
			$res_data = mysqli_query($con,$sel_query);	
			
			while($deprow = mysqli_fetch_assoc($res_data)){ */
			?>
			
			<?php //} ?>
        </div>
		
       	<div id="designation_edit" class="modal custom-modal fade" role="dialog">
			<div class="modal-dialog">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<div class="modal-content modal-md">
					<div class="modal-header">
						<h4 class="modal-title">Edit Designation</h4>
					</div>
					<div class="modal-body">
						<form action="" method="post" name="editform" enctype="multipart/form-data">
							<input type="hidden" name="designation_id" id="designation_id">
							<div class="form-group">
								<label>Designation Name <span class="text-danger">*</span></label>
								<input class="form-control" name="designation_name" id="designation_name" type="text">
							</div>
							<div class="form-group">
								<label>Department Name <span class="text-danger">*</span></label>
								<select class="form-control" name="department_name" id="department_name">
									<option value="0"> Select Department</option>
									<?php
										$department = "SELECT * FROM department";
										$result = mysqli_query($con,$department);
										while($data = mysqli_fetch_array($result)){ 
									 ?>
									 <option value="<?php echo $data['department_id']; ?>"><?php echo $data['department_name']; ?></option>

									 <?php } ?>

								</select>														
							</div>
							<div class="m-t-20 text-center">					
								<button class="btn btn-primary" name="update_designation" value="update">Edit Designation</button>						
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>

        <?php include_once "footer.php";?>


        <script src="https://cdn.jsdelivr.net/jquery.validation/1.15.1/jquery.validate.min.js"></script>

<script type="text/javascript">

	$(document).ready(function(){


		$(".add_desi_value").validate({

			rules :{
				designation_name : "required",
     			department_name  : "required"
			},

			messages :{

				designation_name : "Please enter your Designation",
				department_name  : "Please enter your Department"

			},

			submitHandler: function(form) {
     		 form.submit();
  			  }


		});
		$(".editdesignation").click(function(){
			console.log("ok");
			var Desinationid = $(this).attr("data-id");
			DesigID = {Desig_ID : Desinationid}
			console.log(Desinationid);

			$.ajax({
        		url: "get_designation.php",
		        type: 'POST',
				data: DesigID,
		        dataType: 'json', // added data type
		        success: function(res) {

		        	console.log(res);
				    if(res.status= "sucess"){
				    	$("#designation_id").val(res.data.designation_id);
				    	$("#designation_name").val(res.data.designation_name);
				    	$('#department_name option[value='+res.data.department_id+']').attr('selected','selected');

					}else{
					 alert('fail');
					}           
     			}
    		});
		});

	});
</script>