<?php
session_start();
ob_start(); 
include "header.php";
include "sidebar.php";
$obj = new  connection();
$con = $obj->connect();

/**------ Add Department  ------- **/
if(isset ($_POST['adddepartment']))
{	
    $departmentname=$_POST['departmentname'];
    $time_set = time();
    $createdepartment="INSERT INTO department (department_name,time_set) VALUES ('$departmentname',$time_set)";
    $createdepartment_result=mysqli_query($con,$createdepartment);

if($createdepartment_result == true)
{
	header("Refresh:0");
}
else
{
	echo ('Error:'.mysqli_error);
}	
}
  
/**------ Delete Department  ------- **/
if (isset($_POST['delete_dpt_data'])) 
{
$id= $_POST['delete_dpt'];				
$deldpt="delete from department where department_id= $id";
$deletedpt=mysqli_query($con,$deldpt);

if($deletedpt==true)
{
ob_start(); 
header("Location:departments.php");
}
else
{
echo ('Error:'.mysqli_error);
}	
}	 
 
/**------ Edit Department  ------- **/
if (isset($_POST['updatedptform'])) 
{
$editdptid  = $_POST['dpt_id'];
$dptname = (isset($_POST['dptname']) ? $_POST['dptname'] : "");	
$editdptdata ="UPDATE department SET department_name='$dptname' WHERE department_id=$editdptid";
$updatedptresult=mysqli_query($con,$editdptdata);
	
if($updatedptresult == true)
{

header("Location:departments.php");
}
else
{
echo ("Error:".mysqli_error);
}	
} 	
?>
   <div class="page-wrapper">
                <div class="content container-fluid">
					<div class="row">
						<div class="col-sm-8">
							<h4 class="page-title">Department</h4>
						</div>
						<div class="col-sm-4 text-right m-b-30">
							<a href="#" class="btn btn-primary rounded" data-toggle="modal" data-target="#add_department"><i class="fa fa-plus"></i> Add New Department</a>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12">
							<div>
								<table class="table table-striped custom-table m-b-0 datatable">
									<thead>
										<tr>
											<th>Sr. No.</th>
											<th>Department Name</th>
											<th class="text-right">Action</th>
										</tr>
									</thead>
									<tbody>
									<?php 
									$showdepartment= mysqli_query($con,"SELECT * FROM department ORDER BY `time_set` DESC");		
									$i = 1;		
									while($dpt = mysqli_fetch_array($showdepartment))
                                    { 				
				                     ?>									
										<tr>
											<td><?php echo $i++; ?></td>
											<!--<td><?php //echo $dpt['department_id'];?></td>-->
											<td><?php echo $dpt['department_name'];?></td>
											<td class="text-right">
												<div class="dropdown">
													<a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
													<ul class="dropdown-menu pull-right">
														<li><a href="#" class="dptedit" data-dptedit="<?php echo $dpt['department_id'];?>"data-dptname="<?php echo $dpt['department_name'];?>" data-toggle="modal" title="Edit"><i class="fa fa-pencil m-r-5"></i> Edit</a></li>
														<li><a href="#" data-toggle="modal" data-target="#delete_department<?php echo $dpt['department_id'];?>" title="Delete"><i class="fa fa-trash-o m-r-5"></i> Delete</a></li>														
													</ul>
												</div>
											</td>
										</tr>										
										<div id="delete_department<?php echo $dpt['department_id'];?>" class="modal custom-modal fade" role="dialog">
				<div class="modal-dialog">
					<div class="modal-content modal-md">
						<div class="modal-header">
							<h4 class="modal-title">Delete Department</h4>
						</div>
						<form action="" method="post">
						<div class="modal-body card-box">
							<p>Are you sure want to delete this?</p>
							<input type="hidden" name="delete_dpt" value="<?php echo $dpt['department_id'];?>">
							<div class="m-t-20 text-left">
								<a href="#" class="btn btn-default" data-dismiss="modal">Close</a>
								<button type="submit" name="delete_dpt_data" class="btn btn-danger">Delete</button>
							</div>
						</div>
						</form>
					</div>
				</div>
			</div>							
									<?php } ?>										
									</tbody>
								</table>
							</div>
						</div>
					</div>
                </div>
				<?php include "notification-box.php"?>	
            </div>			
			<div id="add_department" class="modal custom-modal fade" role="dialog">
				<div class="modal-dialog">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<div class="modal-content modal-md">
						<div class="modal-header">
							<h4 class="modal-title">Add Department</h4>
						</div>
						<div class="modal-body">
							<form class="adddptform" action="" method="POST">
								<div class="form-group">
									<label>Department Name <span class="text-danger">*</span></label>
									<input class="form-control" name="departmentname" required="" type="text">
								</div>
								<div class="m-t-20 text-center">
									<button type="submit" name="adddepartment" class="btn btn-primary">Create Department</button>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
			<div id="edit_department" class="modal custom-modal fade" role="dialog">
				<div class="modal-dialog">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<div class="modal-content modal-md">
						<div class="modal-header">
							<h4 class="modal-title">Edit Department</h4>
						</div>
						<div class="modal-body">
							<form class="editdptform" method="POST">
								<div class="form-group">
									<label>Department Name <span class="text-danger">*</span></label>
									<input name="dptname" id="dpt_name" class="form-control" type="text">
								</div>
								<div class="m-t-20 text-center">
								<input type="hidden" name="dpt_id" class="dpt_id" id="dpt_edit_id"/>
									<button name="updatedptform" type="submit" class="btn btn-primary">Save Changes</button>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
<script>
$(document).ready(function(){
jQuery(".adddptform").validate({
	
rules: 
{
	departmentname: "required",
},

messages:
{
	departmentname: "Department Name is Required",
}

});
});

$(document).ready(function(){
jQuery(".editdptform").validate({
	
rules: 
{
	dptname: "required",
},

messages:
{
    dptname: "Department Name is Required",
}

});
});

$(document).ready(function(){	
jQuery('.dptedit').click(function(){
	
$('#edit_department').modal('show'); 
	  
var id = jQuery(this).attr("data-dptedit");
var dptname = jQuery(this).attr("data-dptname");
   
jQuery("#dpt_edit_id").val(id);
jQuery("#dpt_name").val(dptname);
   
});
});
</script>
<?php include "footer.php";?>