 <?php 
include "header.php";
include "sidebar.php";					
?>
<?php

// insert Query in Add Machines
						$abc = new connection();
						$con = $abc->connect();
						if (isset($_POST['submit_data'])) {

						$machine_name = $_POST['machine_name'];
						$photo		  = $_FILES['myphoto']['name'];
						if($_FILES['myphoto']['name']) {

							$allowed =  array('gif','png' ,'jpg');
							$filename = $_FILES['myphoto']['name'];

							$ext = pathinfo($filename, PATHINFO_EXTENSION);
							if(!in_array($ext,$allowed) ) {
							    echo "Invalid file ";
							}else{

								$sql="insert into machine (machine_name,machine_image) values ('".$machine_name."', '".$photo."')";
									$db=mysqli_query($con,$sql);
									echo "successfully Add Machine";
								}
								$target = "Upload/Machines/".basename($filename);
								move_uploaded_file($_FILES['myphoto']['tmp_name'], $target);	
							}
						}
?>

 <div class="page-wrapper">
                <div class="content container-fluid">
					<div class="row">
						<div class="col-xs-4">
							<h4 class="page-title">Machines</h4>
						</div>
						<div class="col-xs-8 text-right m-b-20">
							<a href="#" class="btn btn-primary rounded pull-right" data-toggle="modal" data-target="#machine-list"><i class="fa fa-plus"></i> Add Machines</a>
							<div class="view-icons">
								<a href="machines.php" class="grid-view btn btn-link active"><i class="fa fa-th"></i></a>
								<a href="machines-list.php" class="list-view btn btn-link"><i class="fa fa-bars"></i></a>
							</div>
						</div>
					</div>
					<style>.error{color: red;}</style>
<!-- Fetch data query -->
<?php
$fetch="SELECT * FROM machine";
$i= 0;
$db=mysqli_query($con,$fetch);
?>

						<div class="row">

						<div class="col-md-12">
							<div class="table-responsive">
								<table class="table table-striped custom-table m-b-0 datatable">
									<thead>
										<tr>
											<th>#</th>
											<th>Machine Name</th>
											<th>Picture</th>
											<th class="text-right">Actions</th>
										</tr>
									</thead>
									<tbody>
									<?php   while($row=mysqli_fetch_array($db)){   
											$i++;
									 ?>
										<tr>
											<td><?php echo $i; //echo $row['machine_id']; ?></td>
											<td><a href="#"><?php echo $row['machine_name']; ?></a></td>
											<td><img src="Upload/Machines/<?php echo $row['machine_image'];?>" style="width:70px; height:70px;"></td>
											<td class="text-right">
												<div class="dropdown">
													<a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
													<ul class="dropdown-menu pull-right">
														<li><a href="#" data-toggle="modal" data-target="#machine-list_edit<?php echo $row['machine_id']; ?>"><i class="fa fa-pencil m-r-5"></i> Edit</a></li>

													<li><a href="#" data-toggle="modal" data-target="#delete_employee<?php echo $row['machine_id']; ?>"><i class="fa fa-trash-o m-r-5"></i> Delete</a></li>

													</ul>
												</div>
											</td>
										</tr>
<!-- Delete Query  -->
 <?php 
						$abc = new connection();
						$con = $abc->connect();
						if (isset($_POST['delete_button'])) {
						$id= $_POST['machine_id'];
						$del="delete from machine where machine_id= $id  ";
						$delete=mysqli_query($con,$del); 
						if($delete >0)
						{
							//echo "delete successfull";
							header("Refresh:0");
						}
						else
						{
							echo "Not delete";
						}
						}
										
?>

<div id="delete_employee<?php echo $row['machine_id']; ?>" class="modal custom-modal fade" role="dialog">
				<div class="modal-dialog">
					<div class="modal-content modal-md">
						<div class="modal-header">
							<h4 class="modal-title">Delete Employee</h4>
						</div>
						<form action="" method="post">
							<div class="modal-body card-box">

							<input type="hidden"  name="machine_id" value="<?php echo $row['machine_id']; ?>">
								<p>Are you sure want to delete this?</p>
								<div class="m-t-20"> <a href="#" class="btn btn-default" data-dismiss="modal">Close</a>
									<button type="submit" name="delete_button" class="btn btn-danger">Delete</button>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>

<!-- Update Query -->
 <?php 
						$abc = new connection();
						$con = $abc->connect();
						if (isset($_POST['update_button'])) {
						$id= $_POST['machine_id'];
						$machine_name=$_POST['machine_name'];
						$machine_image=$_FILES['machine_image']['name'];
						$target = "Upload/Machines/".basename($machine_image);
						move_uploaded_file($_FILES['machine_image']['tmp_name'], $target);

						if($_FILES['machine_image']['name']) {
						$allowed =  array('gif','png' ,'jpg');
						$filename = $_FILES['machine_image']['name'];
						$ext = pathinfo($filename, PATHINFO_EXTENSION);
						if(!in_array($ext,$allowed) ) {
						    echo "Invalid file ";
						}else{
 $update="UPDATE `machine` SET `machine_name`='".$machine_name."', `machine_image`='".$machine_image."' WHERE machine_id='".$id."' ";
	 $update_dataa = mysqli_query($con,$update);
	 echo "update data";
	header("Refresh:0");

						} 
						} 
						}
																
?>
			<div id="machine-list_edit<?php echo $row['machine_id']; ?>" class="modal custom-modal fade" role="dialog">
				<div class="modal-dialog">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<div class="modal-content modal-lg">
						<div class="modal-header">
							<h4 class="modal-title">Edit Machine</h4>
						</div>
						<div class="modal-body">
							<form action="" method="post" enctype="multipart/form-data">
								<div class="row">
									<div class="col-md-12">
									<input type="hidden"  name="machine_id" value="<?php echo $row['machine_id']; ?>">
										<div class="form-group">
											<label>Machine Name</label>
											<input class="form-control" type="text" name="machine_name" value="<?php echo $row['machine_name']; ?>" required>
										</div>									
										<div class="michine_img" style="text-align: center">
											<img src="Upload/Machines/<?php echo $row['machine_image'];?> " width="50%" >
										</div>
										<div class="form-group">
											<label>Upload Files</label>
											<input class="form-control" type="file" name="machine_image" value="<?php echo $row['machine_image']; ?>" required>
										</div>								
										<div class="m-t-20 text-center">
											<button type="submit" name="update_button" class="btn btn-primary">Update Michine</button>
										</div>
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
						
            </div>
            	 <?php } ?>
        </div>

<div id="machine-list" class="modal custom-modal fade" role="dialog">
				<div class="modal-dialog">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<div class="modal-content modal-lg">
						<div class="modal-header">
							<h4 class="modal-title">Add Machine</h4>
						</div>
						<div class="modal-body">
							<form action="" method="post" enctype="multipart/form-data" class="machineval"  name="machineval">
								<div class="row">
									<div class="col-md-12">
										<div class="form-group">
											<label>Machine Name</label>
											<input class="form-control" type="text" name="machine_name">
										</div>									
										<div class="michine_img" style="text-align: center">
											<img src="JCB.png" id="blah" width="40%" >
										</div>
										<div class="form-group">
											<label>Upload Files</label>
											<input class="form-control" type="file" name="myphoto" id="imgInp">
										</div>								
										<div class="m-t-20 text-center">
											<button type="submit" name="submit_data" class="btn btn-primary">Add Michine</button>
										</div>
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
			


<div class="sidebar-overlay" data-reff="#sidebar"></div>
        <script type="text/javascript" src="assets/js/jquery-3.2.1.min.js"></script>
        <script type="text/javascript" src="assets/js/bootstrap.min.js"></script>
		<script type="text/javascript" src="assets/js/jquery.slimscroll.js"></script>
		<script type="text/javascript" src="assets/js/select2.min.js"></script>
		<script type="text/javascript" src="assets/js/moment.min.js"></script>
		<script type="text/javascript" src="assets/js/bootstrap-datetimepicker.min.js"></script>
		<script type="text/javascript" src="assets/js/app.js"></script>
		 <script src="https://cdn.jsdelivr.net/jquery.validation/1.15.1/jquery.validate.min.js"></script>



<script>

jQuery(document).ready(function(){

  jQuery(".machineval").validate({
    // Specify validation rules
    rules: {
      machine_name: "required",
	  myphoto: "required",
     },
    // Specify validation error messages
    messages: {
     machine_name: "Please enter your machine name", 
	 myphoto :"choose the image",
      },
   
    submitHandler: function(form) {
      form.submit();
    }
  });

});
</script>
<script type="text/javascript">
function readURL(input) {

  if (input.files && input.files[0]) {
    var reader = new FileReader();

    reader.onload = function(e) {
      $('#blah').attr('src', e.target.result);

      $('#blah').hide();
      $('#blah').fadeIn(650);

    }

    reader.readAsDataURL(input.files[0]);
  }
}

$("#imgInp").change(function() {
  readURL(this);
});
</script> 


    </body>
</html>