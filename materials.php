<?php
session_start();
ob_start();
include "header.php";
include "sidebar.php";
$obj = new connection();
$con = $obj->connect(); 

 $user_id = $_SESSION['user_id'];

if(isset($_SESSION['user_id'])){
if(isset($_POST['add_met'])){
     $material_name = $_POST['material_name'];
	 $material_amount = $_POST['amount'];
	 $material_unit = $_POST['unit'];
	 $time_set = time();
    

 $log_user_qury = "INSERT INTO material (materials_name, amount, unit,time_set)
VALUES ('$material_name', '$material_amount', '$material_unit',$time_set)";

	$res_data = mysqli_query($con,$log_user_qury);	

}

}


?>
<style>.error{color: red;}</style>

            <div class="page-wrapper">
                <div class="content container-fluid">
					<div class="row">
						<div class="col-xs-4">
							<h4 class="page-title">Materials</h4>
						</div>
						<div class="col-xs-8 text-right m-b-20">
							<a href="#" class="btn btn-primary rounded pull-right" data-toggle="modal" data-target="#materials-list"><i class="fa fa-plus"></i> Add New Materials</a>
							<div class="view-icons">
								<a href="materials.php" class="grid-view btn btn-link active"><i class="fa fa-th"></i></a>
								<a href="materials-list.php" class="list-view btn btn-link"><i class="fa fa-bars"></i></a>
							</div>
						</div>
					</div>
					<?php 
		$log_user_qury = "SELECT * FROM material ORDER BY `time_set` DESC";
			$res_data = mysqli_query($con,$log_user_qury);
					echo '<div class="row staff-grid-row">';

                       

                     if ($res_data->num_rows > 0) {
					    // output data of each row
					    while($row = $res_data->fetch_assoc()) {
					    	//echo "<pre>"; print_r($row); echo "</pre>";
					    	?>
					        <div class="col-md-4 col-sm-4 col-xs-6 col-lg-3">
							<div class="profile-widget">
								<div class="profile-img">
									<a href="#"><img class="avatar" src="assets/img/user.jpg" alt=""></a>
								</div>
								<div class="dropdown profile-action">
									<a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
									<ul class="dropdown-menu pull-right">
										<li><a href="#" data-toggle="modal" class="edit_click" data-target="#machine-list_edit<?php echo $row['id']; ?>"><i class="fa fa-pencil m-r-5"></i> Edit</a>
										<!-- <input type="button" class="edit_mat" data-id="<?php echo $row['id']; ?>"> -->
										</li>
										<li>
											<!-- <input type="button" class="delete_mat" data-id="<?php echo $row['id']; ?>"> -->
											<a href="#" data-toggle="modal" data-target="#delete_employee<?php echo $row['id']; ?>"><i class="fa fa-trash-o m-r-5"></i> Delete</a></li>
									</ul>
								</div>
								<h4 class="user-name m-t-10 m-b-0 text-ellipsis"><a href="#"><?php echo $row['materials_name']; ?></a></h4>
															
							</div>
						</div>


<!--   edit form data   -->
<?php

$abc = new connection();
						$con = $abc->connect();
						
						/*$aa = $_POST['edit_save'];
						$vvv = $aa.$row['id'];*/
						if (isset($_POST['edit_save'])) {
						$idd = $_POST['save_i'];
						$name= $_POST['material_name'];
						$amount= $_POST['amount'];
						$unit= $_POST['unit'];
				//material_name	amount	 unit
						
						 $update="UPDATE `material` SET  `materials_name`='".$name."', `amount`='".$amount."' , `unit`='".$unit."' WHERE id='".$idd."' ";

						$updatee=mysqli_query($con,$update); 

						if($updatee >0)
						{
							//echo "delete successfull";
							header("Refresh:0");

						}

						else
						{
							echo "record not update";

						}


						}


						?>

<div id="machine-list_edit<?php echo $row['id']; ?>" class="modal custom-modal fade" role="dialog">
				<div class="modal-dialog">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<div class="modal-content modal-lg">
						<div class="modal-header">
							<h4 class="modal-title">Edit Materials</h4>
						</div>
						<div class="modal-body">
							<form action="" id="edit_update_up<?php echo $row['id']; ?>" method="post" enctype="multipart/form-data">
								<div class="row">
									<div class="col-md-12">
										<div class="form-group">
											<label>Materials Name</label>
											<input class="form-control" name="save_i" value="<?php echo $row['id']; ?>" type="hidden" >

											<input class="form-control" name="material_name" value="<?php echo $row['materials_name']; ?>" type="text" />
										</div>									
										<div class="form-group">
											<label>Materials Amount</label>
											<input class="form-control" name="amount" value="<?php echo $row['amount']; ?>" type="text">
										</div>	
										<div class="form-group">
											<label>Materials Unit</label>
											<input class="form-control" name="unit" value="<?php echo $row['unit']; ?>" type="text">
										</div>								
										<div class="m-t-20 text-center">
											<button type="submit" name="edit_save" class="btn btn-primary">Edit Materials</button>
										</div>
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
<!--   end edit form data   -->

						<?php

$abc = new connection();
						$con = $abc->connect();
						if (isset($_POST['delete_id_data'])) {
						$id= $_POST['delet_to_id'];
				
						$del="delete from material where id= $id  ";
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


<!--  delete model  --->
<div id="delete_employee<?php echo $row['id']; ?>" class="modal custom-modal fade" role="dialog">
				<div class="modal-dialog">
					<div class="modal-content modal-md">
						<div class="modal-header">
							<h4 class="modal-title">Delete Employee</h4>
						</div>
						<form action="" method="post" name="add-material">
							<div class="modal-body card-box">
								<p>Are you sure want to delete this?</p>
								<input type="hidden" name="delet_to_id" value="<?php echo $row['id']; ?>">
								<div class="m-t-20"> <a href="#" class="btn btn-default" data-dismiss="modal">Close</a>
									<button type="submit" name="delete_id_data" class="btn btn-danger">Delete</button>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
<!--
<script type="text/javascript" src="assets/js/jquery-3.2.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.15.1/jquery.validate.min.js"></script>-->
<script>

$(document).ready(function(){
 var get_id = "<?php echo $row['id']; ?>";
 
  $("#edit_update_up"+"<?php echo $row['id']; ?>").validate({
    // Specify validation rules
  
    rules: {
      material_name: "required",
	  amount: "required",
	  unit : "required",
     },
    // Specify validation error messages
    messages: {
     material_name: "Please enter your material name", 
	 amount :"Please enter amount",
	 unit : "Please enter unit",
      },
   
    submitHandler: function(form) {
      form.submit();
    }
  });

});
</script>



					       <?php
					    }
					} else {
					    echo "0 results";
					}
?>

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
			<div id="materials-list" class="modal custom-modal fade" role="dialog">
				<div class="modal-dialog">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<div class="modal-content modal-lg">
						<div class="modal-header">
							<h4 class="modal-title">Add Materials</h4>
						</div>
						<div class="modal-body">
							<form class="add_material"  name="add-material" method="post" >
								<div class="row">
									<div class="col-md-12">
										<div class="form-group">
											<label>Materials Name</label>
											<input name="material_name" class="form-control" type="text">
									
										</div>									
										<div class="form-group">
											<label>Materials Amount</label>
											<input name="amount" class="form-control" type="text">
											 
										</div>	
										<div class="form-group">
											<label>Materials Unit</label>
											<input name="unit" class="form-control" type="text">
											
										</div>								
										<div class="m-t-20 text-center">
											<input type="submit" name="add_met" value="Add Materials" class="btn btn-primary"/>
											
										</div>
									</div>
								</div>
							</form>
						</div>
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

$(document).ready(function(){

  $(".add_material").validate({
    // Specify validation rules
    rules: {
      material_name: "required",
	  amount: "required",
	  unit : "required",
     },
    // Specify validation error messages
    messages: {
     material_name: "Please enter your material name", 
	 amount :"Please enter amount",
	 unit : "Please enter unit",
      },
   
    submitHandler: function(form) {
      form.submit();
    }
  });

});
</script>




	</body>
</html>