<?php 
include "header.php";
include "sidebar.php";	
$obj = new connection();
$con = $obj->connect(); 				
?>
<style type="text/css">
	.select_pro{width: 100%;
    height: 38px;
    font-size: 14px;
    padding: 0 30px 0 15px;
    border: 1px solid #ccc;}
    .error{color: red;}
    .table-responsive {
    min-height: auto;
    overflow-x: unset;}
</style>
<?php
if(isset($_SESSION['user_id'])){
if(isset($_POST['Add_Timecard'])){
	
	 $multiple_machine = $_POST['multiple_machine'];
	$machine_name = implode(",",$_POST["multiple_machine"]);
	//echo "<pre>"; print_r($_POST["multiple_machine"]);
 

$hours = $_POST["machine_multiple_add"];
$machine = $_POST["multiple_machine"];
$hours = array_intersect_key($hours, $machine);
$hourss = implode(",",$hours);

     $project_name = $_POST['project_name'];
	 $deadline = $_POST['deadline'];
	 $total_hour = $_POST['total_hour'];
	 $remain_hour = $_POST['remain_hour'];
	  $work_type = $_POST['work_type'];
	   $work_date = $_POST['work_date'];
	 $work_hours = $_POST['work_hours'];
	 $description = $_POST['description'];
	 
	
             

  $log_user_quryy = "INSERT INTO Time_Card (project_name, deadline, total_hours, remain_hours, work_type, card_date, hours, description, machine, machine_hours) VALUES ('$project_name', '$deadline', '$total_hour','$remain_hour', '$work_type', '$work_date','$work_hours', '$description', '$machine_name', '$hourss')";

$res_dataaa = mysqli_query($con,$log_user_quryy);
//header('Location: http://www.example.com/');
if($res_dataaa){
    header("Refresh:0");
		}
	}

	}

?>
 
            <div class="page-wrapper">
                <div class="content container-fluid">
					<div class="row">
						<div class="col-sm-8">
							<h4 class="page-title">Time Cards</h4>
						</div>
						<div class="col-sm-4 text-right m-b-30">
							<a href="#" class="btn btn-primary rounded" data-toggle="modal" data-target="#add_todaywork"><i class="fa fa-plus"></i> Add Time Card</a>
						</div>
					</div>
					<div class="row worksheet">
						<div class="col-md-12">
							<div class="table-responsive" style="min-height: 153px;">
								<table class="table table-striped custom-table m-b-0 datatable">
									<thead>
										<tr>
											<th>Employee</th>
											<th>Date</th>
											<th>Projects</th>
											<th class="text-center">Work Type</th>
											<th class="text-center">Hours</th>
											<th class="text-center">Description</th>
											<th class="text-center">Machines</th>
											<th class="text-center">Status</th>
											<th class="text-right">Actions</th>
										</tr>
									</thead>
									<tbody>
										<?php

			$Time_Card = "SELECT * FROM Time_Card";
			$Time_Cardd = mysqli_query($con,$Time_Card);
 			if ($Time_Cardd->num_rows > 0) {
					    while($card_data = $Time_Cardd->fetch_assoc()) {
										?>
										
										<tr>
											<td class="col-md-3">
												<a href="profile.html" class="avatar">J</a>
												<h2><a href="profile.html">John Doe <span>Web Designer</span></a></h2>
											</td>
											<td><?php echo $card_data['card_date']; ?></td>
											<td>
												<h2><?php echo $card_data['project_name']; ?></h2>
											</td>
											<td class="text-center col-md-2"><?php echo $card_data['work_type']; ?></td>
											<td class="text-center"><?php echo $card_data['hours']; ?></td>
											<td class="col-md-4" style="text-align: center;"><?php echo $card_data['description']; ?></td>
											<td class="col-md-3">
									<?php
			$array_value = $card_data['machine'];
			$array =  explode(',', $array_value);
			$string_version = implode(',', $array);
			$get_machine = "select * from machine WHERE `machine_id` IN ($string_version) ";
			$get_machinee = mysqli_query($con,$get_machine);
			
			$NewArrayname = array();
			while($row=mysqli_fetch_assoc($get_machinee)){
			$NewArrayname[] = $row['machine_name'];
			}
			
										
										$array_value = $card_data['machine'];
										$array =  explode(',', $array_value);
										$array = $NewArrayname;
										$hour = $card_data['machine_hours'];
										$hoursss =  explode(',', $hour);
											foreach($hoursss as $key1 => $hours){ 
											if($key1 <=3 ){
											?>
										
											<a href='#'' data-toggle='tooltip' title='<?php echo $NewArrayname[$key1] .":".$hours."Hours"; ?>'>
												<img src='assets/img/user.jpg' class='avatar' alt='<?php echo $value_data."-".$hours; ?>' height='20' width='20'>
										</a>
										<?php } }//} 
										unset($hoursss[0]);
										unset($hoursss[1]);
										unset($hoursss[2]);
										unset($hoursss[3]);
										if(count($hoursss) != 0):
										?>
										<li>
										<a href="#" class="all-users">+<?php echo count($hoursss); ?></a>
										
										<?php endif;?>	






												
											</td>
											<td class="col-md-2">
												<div class="dropdown action-label worksheet_pg">
													<a class="btn btn-white btn-sm rounded dropdown-toggle" data-toggle="dropdown" aria-expanded="false"> 
													
									<?php
									if($card_data['status'] == 1){
									echo '<i class="fa fa-dot-circle-o text-success"></i><span class="change_heading"> Approve </span><i class="caret"></i></a>';
									}else{
									echo '<i class="fa fa-dot-circle-o text-danger"></i><span class="change_heading"> Decline </span><i class="caret"></i></a>';
									}
									?>

													<ul class="dropdown-menu">
														<li class="Approve" data-id="<?php echo $card_data['id']; ?>"><a href="#"><i class="fa fa-dot-circle-o text-success"></i> Approve</a></li>
														<li class="Decline" data-id="<?php echo $card_data['id']; ?>"><a href="#"><i class="fa fa-dot-circle-o text-danger"></i> Decline</a>
														</li>
														
													</ul>
												</div>
											</td>
											<td class="text-right">
												<div class="dropdown">
													<a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
													<ul class="dropdown-menu pull-right">
														<li><a href="#" title="Edit" data-toggle="modal" data-target="#edit_todaywork<?php echo $card_data['id']; ?>"><i class="fa fa-pencil m-r-5"></i> Edit</a></li>
														<li><a href="#" title="Delete" data-toggle="modal" data-target="#delete_workdetail<?php echo $card_data['id']; ?>"><i class="fa fa-trash-o m-r-5"></i> Delete</a></li>
													</ul>
												</div>
											</td>
										</tr>

	<!-------------------------start---------------------------->
										<?php

$abc = new connection();
						$con = $abc->connect();
						
						/*$aa = $_POST['edit_save'];
						$vvv = $aa.$row['id'];*/
						if (isset($_POST['edit_save'])) {
						$idd = $_POST['save_i'];
						$project_name= $_POST['project_name'];
						$deadline = $_POST['deadline'];
						$total_hours = $_POST['total_hours'];
						$remain_hours = $_POST['remain_hours'];
						$work_type = $_POST['work_type'];
						$work_date= $_POST['work_date'];
						$work_hours= $_POST['work_hours'];
						$description= $_POST['description'];
				
						
						 $update="UPDATE `Time_Card` SET  
						 `project_name`='".$project_name."',
						 `deadline`='".$deadline."',
						 `total_hours`='".$total_hours."',
						 `remain_hours`='".$remain_hours."',
						 `work_type`='".$work_type."',
						 `card_date`='".$work_date."' ,
						 `hours`='".$work_hours."' ,
						 `description`='".$description."'

						 WHERE id='".$idd."' ";

						/* project_name------
						deadline
						total_hours
						remain_hours
						work_type
						card_date
						hours
						description-------
						status
						machine */
						 
						 
						 
						 
						 
						 
						 
						$updatee=mysqli_query($con,$update); 

						if($updatee >0)
						{ 
							header("Refresh:0"); 
						}else{
							echo "record not update";

						}


						}

           
			$log_user_qury = "SELECT * FROM Project";
			$res_data = mysqli_query($con,$log_user_qury);
           

					?>
<div id="edit_todaywork<?php echo $card_data['id']; ?>" class="modal custom-modal fade" role="dialog">
				<div class="modal-dialog">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<div class="modal-content modal-md">
						<div class="modal-header">
							<h4 class="modal-title">Edit Work Details</h4>
						</div>
						<div class="modal-body">
							<form action="" method="post">
								<div class="form-group">
									<input class="form-control" name="save_i" value="<?php echo $card_data['id']; ?>" type="hidden" >
									<label>Project <span class="text-danger">*</span></label>
									<select class="select_pro" name="project_name" required="required">

					<option value="<?php echo $card_data['project_name']; ?>"><?php echo $card_data['project_name']; ?></option>					
										<?php	if ($res_data->num_rows > 0) { 
									while($row = $res_data->fetch_assoc()) {
										?>
					<option value="<?php echo $row['Project_name']; ?>"><?php echo $row['Project_name']; ?></option>
										<?php } }?>
									</select>
								</div>
								<div class="row">
									<div class="form-group col-sm-4">
										<label>Deadline <span class="text-danger">*</span></label>
										<div class="cal-icon">
											<input class="form-control" value="<?php echo $card_data['deadline']; ?>" type="text" id="datepicrr<?php echo $card_data['id']; ?>" name="deadline" required="required">
										</div>
									</div>
									<div class="form-group col-sm-4">
										<label>Total Hours <span class="text-danger">*</span></label>
										<input class="form-control digit_only" type="text" value="<?php echo $card_data['total_hours']; ?>" name="total_hours">
									</div>
									<div class="form-group col-sm-4">
										<label>Remaining Hours<span class="text-danger">*</span></label>
										<input class="form-control digit_only" type="text" value="<?php echo $card_data['remain_hours']; ?>" name="remain_hours">
									</div>
								</div>
								<div class="row">
									<div class="form-group col-sm-6">
										<label>Date <span class="text-danger">*</span></label>
										<div class="cal-icon">
											<input class="form-control" value="<?php echo $card_data['card_date']; ?>" type="text" id="datepickerr<?php echo $card_data['id']; ?>" name="work_date" required="required">
										</div>
									</div>
									<div class="form-group col-sm-6">
										<label>Hours <span class="text-danger">*</span></label>
										<input class="form-control" type="text" value="<?php echo $card_data['hours']; ?>" name="work_hours" required="required">
									</div>
								</div>
								<div class="row">
								<div class="form-group col-sm-6">
									<label>Work Type <span class="text-danger">*</span></label>									
									<select class="select_pro" name="work_type" required="required">
										<option value="Labourer">Labourer</option>
										<option value="Foreman">Foreman</option>
									</select>
								</div>
								</div>
								<div class="form-group">
									<label>Description <span class="text-danger">*</span></label>
									<textarea rows="4" cols="5" class="form-control" name="description"><?php echo $card_data['description']; ?></textarea>
								</div>
								<div class="row">
									<div class="form-group col-sm-6">
										<label>Add Machines <span class="text-danger">*</span></label>
								 <ul>
									<?php
									$array_value = $card_data['machine'];
										$array =  explode(',', $array_value);
										foreach($array as $key => $value_data){ 
										
										?>
										<li> <?php echo $value_data;  ?>
										    <select class="machine_multiple_add" name="machine_multiple_add"></select> Hours <input type="checkbox" name="multiple_machine[]" value="<?php echo $roww['machine_name']; ?>">
										    </li>
										
										<?php } ?>	
								</ul>
									</div>
								</div>
								<div class="m-t-20 text-center">
									
									<button type="submit" name="edit_save" class="btn btn-primary">Save Changes</button>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>

<script type="text/javascript">
	var get_id = "<?php echo $card_data['id']; ?>";
	$(function(){
    $("#datepickerr"+"<?php echo $card_data['id']; ?>").datepicker();
    showButtonPanel: true,
	
	$("#datepicrr"+"<?php echo $card_data['id']; ?>").datepicker();
    showButtonPanel: true
	
});
</script>
<!-------------end ------------>

<?php 


if (isset($_POST['delete_id_data'])) {
						$id= $_POST['delet_to_id'];
				
					 $del="delete from Time_Card where id= $id  ";
						
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


		<div id="delete_workdetail<?php echo $card_data['id']; ?>" class="modal custom-modal fade" role="dialog">
				<div class="modal-dialog">
					<div class="modal-content modal-md">
						<form action="" method="post">
						<div class="modal-header">
							<h4 class="modal-title">Delete Work Details</h4>
						</div>
						<div class="modal-body card-box">
							<input type="hidden" name="delet_to_id" value="<?php echo $card_data['id']; ?>">
							<p>Are you sure want to delete this?</p>
							<div class="m-t-20"> <a href="#" class="btn btn-default" data-dismiss="modal">Close</a>
								<button type="submit" name="delete_id_data" class="btn btn-danger">Delete</button>
							</div>
						</div>
						</form>
					</div>
				</div>
			</div>




<?php

 }
 }else{ 
 	echo "No Record found";
 } 



 ?>









										
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
			
					<?php
				
           
			$log_user_qury = "SELECT * FROM Project";
			$res_data = mysqli_query($con,$log_user_qury);
            $machin_qury = "SELECT * FROM machine";
			$machin = mysqli_query($con,$machin_qury);


					?>


			<div id="add_todaywork" class="modal custom-modal fade" role="dialog">
				<div class="modal-dialog">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<div class="modal-content modal-md">
						<div class="modal-header">
							<h4 class="modal-title">Add Time Card Details</h4>



						</div>
						<div class="modal-body">
							<form method="post" action="" class="card_save" enctype="multipart/form-data">
								<div class="form-group">
									<label>Project <span class="text-danger">*</span></label>
									<select class="select_pro" name="project_name" id="add_project_name">
									<option value="">Select Project</option> 
									<?php	if ($res_data->num_rows > 0) { 
									while($row = $res_data->fetch_assoc()) {
										?>
					<option value="<?php echo $row['Project_id']; ?>"><?php echo $row['Project_name']; ?></option>
										
										

										<?php } }?>
									</select>
								</div>
								<div class="row">
									<div class="form-group col-sm-4">
										<label>Deadline <span class="text-danger">*</span></label>
										<div class="cal-icon">
											<input class="form-control" type="text" id="datepicker" name="deadline">
										</div>
									</div>
									<div class="form-group col-sm-4">
										<label>Total Hours <span class="text-danger">*</span></label>
										<input class="form-control digit_only" type="text" value="" name=total_hour">
									</div>
									<div class="form-group col-sm-4">
										<label>Remaining Hours<span class="text-danger">*</span></label>
										<input class="form-control digit_only" type="text" value="" name="remain_hour">
									</div>
								</div>
								<div class="row">
								<div class="form-group col-sm-6">
									<label>Work Type <span class="text-danger">*</span></label>
									<select class="select_pro" name="work_type">
										<option value="Labourer">Labourer</option>
										<option value="Foreman">Foreman</option>
									</select>
								</div>
								</div>
								<div class="row">
									<div class="form-group col-sm-6">
										<label>Date <span class="text-danger">*</span></label>
										<div class="cal-icon">
											<input class="form-control datetimepicker" type="text" id="datepicker1" name="work_date">
										</div>
									</div>
									<div class="form-group col-sm-6">
										<label>Hours <span class="text-danger">*</span></label>
										<input class="form-control digit_only" type="text" name="work_hours">
									</div>
								</div>
								<div class="form-group">
									<label>Description <span class="text-danger">*</span></label>
									<textarea rows="4" cols="5" class="form-control" name="description"></textarea>
								</div>
								<div class="row">
								    <div class="form-group col-sm-6">
										<label>Add Machines <span class="text-danger">*</span>
										<span id="add_new_machine">
										<i class="fa fa-plus-square" aria-hidden="true"></i>
										</span>
										<!--<input class="form-control" type="text" id="search_machine" name="edit_team[]" style="display: none;">-->
										<input type="text" name="typeahead" id="search_machine" style="display: none !important;" class="typeahead tt-query" autocomplete="off" spellcheck="false" >
										</label>
								 <ul>
									<?php	
									
									if ($machin->num_rows > 0) { 
									while($roww = $machin->fetch_assoc()) {
										$id = $roww['machine_id'];

										?>
										
										    <li> 
										   
										    	<?php echo $roww['machine_name']; ?><select class="machine_multiple_add" name="machine_multiple_add[<?php echo $id; ?>]"></select> Hours <input type="checkbox" name="multiple_machine[<?php echo $id; ?>]" value="<?php echo $roww['machine_id']; ?>">
										    <input type="hidden" name="machine_hours" id="machine_hours">	
										    </li>
										 
										<?php } }else{
											?>
											 </ul>
									<option value=''>No Machine</option>					
										<?php } ?>
									</div>
<!--
<div id="checkboxes" class="form-group col-sm-6">
 <label>Add Machines <span class="text-danger">*</span></label>
  <ul>
    <li> checkbox 1 <select class="1-100"></select> hours <input type="checkbox" name="vehicle" value="Bike"></li>
  </ul>
</div>
 -->








									<div class="col-md-6">
										<div class="form-group">
											
											<div class="project-members add_new_time_cr">
												
											</div>
										</div>
									</div>
								</div>	
								<div class="m-t-20 text-center">
									<button type="submit" name="Add_Timecard" class="btn btn-primary" value="create">Save</button>
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
       <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

		 <script src="https://cdn.jsdelivr.net/jquery.validation/1.15.1/jquery.validate.min.js"></script>
		 <script type="text/javascript" src="assets/js/typeahead.js"></script>
<script type="text/javascript">
	$(document).ready(function(){
			$('.digit_only').keypress(function(event){

			       if(event.which != 8 && isNaN(String.fromCharCode(event.which))){
			           event.preventDefault(); //stop character from entering input
			       }
			      });

				$(function(){
			    $("#datepicker,#datepicker1").datepicker();
			    showButtonPanel: true
			});
	
				  $(".card_save").validate({
			    rules: {
			      project_name: "required",
				  deadline: "required",
				  total_hour : "required",
				   remain_hour: "required",
				  work_type: "required",
				  work_date : "required",
				   work_hours: "required",
				  description: "required",
				  machine_name : "required",
			     },
			    
			    messages: {
			    roject_name: "required",
				  deadline: "required",
				  total_hour : "required",
				   remain_hour: "required",
				  work_type: "required",
				  work_date : "required",
				   work_hours: "required",
				  description: "required",
				  machine_name : "required",
			      },
			   
			    submitHandler: function(form) {
			      form.submit();
			    }
			  });


$('.Approve').click(function(event){
	var id = $(this).attr('data-id');
	var Approve = '1';
	var time_card = 'approve_data_time_card';

 $.ajax({
               url: "approve_ajax.php",
               data: {Approve: Approve, time_card: time_card, id: id},
               //dataType: "json",
               type: "POST",
               success: function (data) {
              
                   if(data == '1')
                   location.reload();
                   }
               });
           });


$('.Decline').click(function(event){
	var id = $(this).attr('data-id');
	var Approve = '0';
	var time_card = 'approve_data_time_card';
$.ajax({
               url: "approve_ajax.php",
               data: {Approve: Approve, time_card: time_card, id: id},
               //dataType: "json",
               type: "POST",
               success: function (data) {
                   if(data == '1'){
                   location.reload();
                   }
               }
           });


});


//add new time card = get team member 
$('#add_project_name').on('change', function (e) {
    var project_id = this.value;
    var project_member = 'project_member';
    $.ajax({
               url: "approve_ajax.php",
               data: {project_id: project_id, project_member: project_member},
               type: "POST",
               success: function (data) {
               	//alert(data);
               	 $('.add_new_time_cr').html(data);
                   
               }
           });

});
//end  add new time card = get team member 
$(function(){
    var $select = $(".machine_multiple_add");
    for (i=0;i<=10;i++){
        $select.append($('<option></option>').val(i).html(i))
    }
});


$('#add_new_machine').click(function(event){
	
$('#search_machine').css('display','block');
});

});
</script>

<!---- This is my autocomplate start ------->
<script src="search/typeahead.min.js"></script>
 <script>
    $(document).ready(function(){		
    $('input.typeahead').typeahead({
		name: 'typeahead',
        remote:'search/search.php?key=%QUERY',
        limit : 4 		
    });	
});
    </script>
    <style type="text/css">
.bs-example{
	font-family: sans-serif;
	position: relative;
	margin: 50px;
}
.typeahead, .tt-query, .tt-hint {	
	font-size: 10px;
	height: 30px;
	line-height: 30px;
	outline: medium none;
	padding: 8px 12px;
	width: 396px;
}
.typeahead {
	background-color: #FFFFFF;
}
.typeahead:focus {
	border: 2px solid #0097CF;
}
<!--.tt-query {
	box-shadow: 0 1px 1px rgba(0, 0, 0, 0.075) inset;
}-->
.tt-hint {
	color: #999999;
}
.tt-dropdown-menu {
	background-color: #FFFFFF;
	border: 1px solid rgba(0, 0, 0, 0.2);
	border-radius: 8px;
	box-shadow: 0 5px 10px rgba(0, 0, 0, 0.2);
	margin-top: 12px;
	padding: 8px 0;
	width: 422px;
}
.tt-suggestion {
	font-size: 10px;
	line-height: 24px;
	padding: 3px 20px;
}
.tt-suggestion.tt-is-under-cursor {
	background-color: #0097CF;
	color: #FFFFFF;
}
.tt-suggestion p {
	margin: 0;
}
</style>
<!---- This is my autocomplate end ------->


    </body>
</html>

 
