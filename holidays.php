<!DOCTYPE html>
<?php
session_start();
include "header.php";
include "sidebar.php";
$obj = new  connection();
$con = $obj->connect();
$user_id = $_SESSION['user_id'];
if(isset($_SESSION['user_id'])){
if(isset($_POST['create_holiday'])){
 $holiday_name = $_POST['holiday_name'];
 $holiday_date = $_POST['holiday_date'];
 
 $log_user_qury = "INSERT INTO holidays (holiday_name, holiday_date)
     VALUES ('$holiday_name', '$holiday_date')";
   $res_data = mysqli_query($con,$log_user_qury);
   }
 if(isset($_POST['edit_holdiay'])){

    $holiday_name = $_POST['holiday_name'];
    $holiday_date = $_POST['holiday_date'];
    $holiday_id = $_POST['holiday_id'];	
	$sql =  "UPDATE holidays
SET holiday_name = '$holiday_name',holiday_date='$holiday_date'
WHERE holiday_id=$holiday_id";
	
	mysqli_query($con,$sql);

             
 }  
   
   
   if(isset($_POST['delete_holiday'])){
   $holiday_id =$_POST['holiday_id'];
   $sql = "DELETE FROM holidays where holiday_id=$holiday_id";
$res_data = mysqli_query($con,$sql);
   }
   


$sel_query = "Select * from holidays";

$res_data = mysqli_query($con,$sel_query);	
?>
            <div class="page-wrapper">
                <div class="content container-fluid">
					<div class="row">
						<div class="col-sm-8">
							<h4 class="page-title">Holidays 2017</h4>
						</div>
						<div class="col-sm-4 text-right m-b-30">
							<a href="#" class="btn btn-primary rounded" data-toggle="modal" data-target="#add_holiday"><i class="fa fa-plus"></i> Add New Holiday</a>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12">
							<div class="table-responsive">
								<table class="table table-striped custom-table m-b-0">
									<thead>
										<tr>
											<th>#</th>
											<th>Title </th>
											<th>Holiday Date</th>
											<th>Day</th>
											<th class="text-right">Action</th>
										</tr>
									</thead>
									<tbody>
									<?php 
									$i =1;
									while($rowData = mysqli_fetch_assoc($res_data)){ 
									
									?>
										<tr class="holiday-completed">
											<td><?php echo $i;?></td>
											<td><?php echo $rowData['holiday_name'];?></td>
											<td>
											<?php $date = date_create($rowData['holiday_date']);
											echo date_format($date, 'd M Y'); ?>
										     </td>
											<td> <?php $date = date_create($rowData['holiday_date']);
											echo date_format($date, 'l'); ?></td>
											<td class="text-right">
												<div class="dropdown">
													<a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
													<ul class="dropdown-menu pull-right">
														<li><a href="#" data-toggle="modal" data-target="#edit_holiday<?php echo $rowData['holiday_id']; ?>" data-id=<?php echo $rowData['holiday_id']; ?> title="Edit"><i class="fa fa-pencil m-r-5"></i> Edit</a></li>
														<li><a href="#" data-toggle="modal" data-target="#delete_holiday<?php echo $rowData['holiday_id']; ?>" title="Delete"><i class="fa fa-trash-o m-r-5"></i> Delete</a></li>
													</ul>
												</div>
											</td>
										</tr>
										<?php $i++; } ?>
										
										
									</tbody>
								</table>
							</div>
						</div>
					</div>
                </div>
			<?php include_once "notification-box.php"; ?>
            </div>
			
			<?php 
			
			$sel_query = "Select * from holidays";

$res_data = mysqli_query($con,$sel_query);	
while($rowData = mysqli_fetch_assoc($res_data)){ 
?>
			<div id="delete_holiday<?php echo $rowData['holiday_id']; ?>" class="modal custom-modal fade" role="dialog">
				<div class="modal-dialog">
					<div class="modal-content modal-md">
						<div class="modal-header">
							<h4 class="modal-title">Delete Holiday</h4>
						</div>
						<form method="POST">
							<div class="modal-body card-box">
								<p>Are you sure want to delete this?</p>
								<div class="m-t-20 text-left">
								
									<a href="#" class="btn btn-default" data-dismiss="modal">Close</a>
									<input type="hidden" name="holiday_id" value="<?php echo $rowData['holiday_id']; ?>">
									<button type="submit" class="btn btn-danger" value="delete" name="delete_holiday">Delete</button>
									
									
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
			
			<?php } ?>
			<div id="add_holiday" class="modal custom-modal fade" role="dialog">
				<div class="modal-dialog">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<div class="modal-content modal-md">
						<div class="modal-header">
							<h4 class="modal-title">Add Holiday</h4>
						</div>
						<div class="modal-body">
							<form method="POST">
								<div class="form-group">
									<label>Holiday Name <span class="text-danger">*</span></label>
									<input class="form-control" required="" name="holiday_name" type="text">
								</div>
								<div class="form-group">
									<label>Holiday Date <span class="text-danger">*</span></label>
									<div class="cal-icon"><input class="form-control datetimepicker"  name="holiday_date" type="text"></div>
								</div>
								<div class="m-t-20 text-center">
									<button class="btn btn-primary" name="create_holiday" value="create">Create Holiday</button>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
			<?php 
			
			$sel_query = "Select * from holidays";

$res_data = mysqli_query($con,$sel_query);	
while($rowData = mysqli_fetch_assoc($res_data)){ 
?>
			
			<div id="edit_holiday<?php echo $rowData['holiday_id']; ?>" class="modal custom-modal fade" role="dialog">
				<div class="modal-dialog">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<div class="modal-content modal-md">
						<div class="modal-header">
							<h4 class="modal-title">Edit Holiday</h4>
						</div>
						<div class="modal-body">
							<form method="post">
								<div class="form-group">
									<label>Holiday Name <span class="text-danger">*</span></label>
									<input class="form-control" value="<?php echo $rowData['holiday_name'];?>" name="holiday_name" required="" type="text">
								</div>
								<div class="form-group">
									<label>Holiday Date <span class="text-danger">*</span></label>
									<div class="cal-icon"><input class="form-control datetimepicker" value="<?php echo $rowData['holiday_date'];?>" required="" name="holiday_date" type="text"></div>
								</div>
								<input type="hidden" name="holiday_id" value="<?php echo $rowData['holiday_id']; ?>"> 
								<div class="m-t-20 text-center">
									<button class="btn btn-primary" name="edit_holdiay" value="update">Edit Holiday</button>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
			<?php } ?>
        </div>
		<div class="sidebar-overlay" data-reff="#sidebar"></div>
        <script type="text/javascript" src="assets/js/jquery-3.2.1.min.js"></script>
        <script type="text/javascript" src="assets/js/bootstrap.min.js"></script>
		<script type="text/javascript" src="assets/js/jquery.slimscroll.js"></script>
		<script type="text/javascript" src="assets/js/moment.min.js"></script>
		<script type="text/javascript" src="assets/js/bootstrap-datetimepicker.min.js"></script>
		<script type="text/javascript" src="assets/js/app.js"></script>
		<script>
		 $(".datetimepicker").datetimepicker({
        format: "YYYY-MM-DD"
        
    });

		</script>
    </body>
</html>
<?php } ?>