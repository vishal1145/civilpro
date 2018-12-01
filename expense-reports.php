<?php 
include "header.php";
include "sidebar.php";	
$obj = new connection();
$con = $obj->connect(); 

?>
<?php 
if (isset($_POST['delete_id_data'])) {
						$id= $_POST['delet_to_id'];
				
					 $del="delete from field_report where id= $id  ";
					echo $delete = mysqli_query($con,$del); 
						if($delete > 0)
						{
							echo "jj";
							header("Refresh:0");

						}
						else
						{
							echo "Not delete";

						}

						}
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
	
	.lb_sel {
    display: inline-block;
}
.one_more {
    width: 270px;
    display: inline-block;
}
.maltiple_machine_display ul {
    padding: 0;
}
.row.maltiple_machine_display ul {
    border: 1px solid #ccc;
    padding: 20px;
    background: #fff;
    height: 200px;
    overflow: auto;
}


.avatar {
    background-color: #aaa;
    border-radius: 50%;
    color: #fff;
    display: inline-block;
    font-weight: 500;
    height: 25px;
    line-height: 38px;
    margin: 0 10px 0 0;
    overflow: hidden;
    text-align: center;
    text-decoration: none;
    text-transform: uppercase;
    vertical-align: middle;
    width: 25px;
    position: relative;
    white-space: nowrap;
}
ul.avtar-image-sec {
    list-style: none;
    padding: 0;
}
ul.avtar-image-sec li {
    display: inline-block;
    float: left;
}
.set_wtd_icon {
    display: inline-block !important;
    padding: 10px 0 !important;
    width: 165px !important;
}
.icon-ginti .all-users {
    background-color: #00c5fb;
    color: #fff;
    font-size: 13px;
    font-weight: 800;
    line-height: 34px;
    text-align: center;
    padding: 5px;
    border-radius: 50%;
}
li.icon-ginti {
    margin-top: -3px;
}
.avatar{
	line-height: 28px;
}
.form-group.form-focus.select-focus select {
    width: 100%;
    height: 50px;
}
.row.filter-row {
    margin-bottom: 30px;
}
.row.selectMachinesEdit {display: none;}
.row.export_section { margin-bottom: 15px;}
input.btn.btn-success.btn-block.exportButton {width: 150px;}
</style>
<?php


 

if(isset($_SESSION['user_id'])){
if(isset($_POST['Add_Timecard'])){
	

	$multiple_machine = $_POST['multiple_machine'];
	$machine_name = implode(",",$_POST["multiple_machine"]);
	$hours = $_POST["machine_multiple_add"];
	$machine = $_POST["multiple_machine"];
	$hours = array_intersect_key($hours, $machine);
	$hourss = implode(",",$hours);

    $project_name = $_POST['project_name'];
    $employee_id = $_POST['select_emp_nama'];
	$deadline = $_POST['deadline'];
	$total_hour = $_POST['total_hour'];
	$remain_hour = $_POST['remain_hour'];
	$work_type = $_POST['work_type'];
	$work_date = $_POST['work_date'];
	$work_hours = $_POST['work_hours'];
	$description = $_POST['description'];

   $log_user_quryy = "INSERT INTO time_card (project_name, employee_id, deadline, total_hours, remain_hours, work_type, card_date, hours, description, machine, machine_hours) VALUES ('$project_name','$employee_id' , '$deadline', '$total_hour','$remain_hour', '$work_type', '$work_date','$work_hours', '$description', '$machine_name', '$hourss')";

$res_dataaa = mysqli_query($con,$log_user_quryy);
//header('Location: http://www.example.com/');
if($res_dataaa){
    header("Refresh:0");
		}
	}

	}

?> 

<!-- ============================ searching ================================= -->
				<?php

					$Time_Card = "SELECT * FROM field_report ORDER BY `time_set` DESC ";
                    $Time_Cardd = mysqli_query($con,$Time_Card);
	

				?>

<!-- ===================================================================== -->
            <div class="page-wrapper">
                <div class="content container-fluid">
					<div class="row">
						<div class="col-sm-8">
							<h4 class="page-title">Field Reports</h4>
						</div>
						
					</div>
			 <!-- =======================  Searching section ============================== -->
					
					

         <!-- ================================================================================ --> 

         <!-- ============================= Export section =================================== -->

         		

         		 <div class="modal fade" id="myModalExport" role="dialog">
				    <div class="modal-dialog">
				    
				      <!-- Modal content-->
				      <div class="modal-content">
				        <div class="modal-header">
				          <button type="button" class="close" data-dismiss="modal">&times;</button>
				          <h4 class="modal-title">Export dates</h4>
				        </div>
				        <div class="modal-body">
				          <form action="export_time_card.php" method="post" class="exportForm" id="exportForm">
					         
								<label class="control-label">Start Date</label>
								<div class="form-group form-focus">
									<div class="cal-icon form-group form-focus">
										<input class="form-control datetimepicker floating" type="text" id="datetimepickerExportStart" name="start_date">
									</div>
								</div>
							  
								<label class="control-label">End Date</label>
								<div class="form-group form-focus">
									<div class="cal-icon form-group form-focus">
										<input class="form-control datetimepicker floating" type="text" id="datetimepickerExportEnd" name="end_date">
									</div>
								</div>
								  
								<input type="submit" name="export_button" class="btn btn-success btn-block exportButton" value="Export">
								

				          </form>		
				        </div>
				      </div>
				    </div>
				  </div>	
         <!-- ================================================================================ -->
					<div class="row worksheet">
						<div class="col-md-12">
							<div class="table-responsive" style="min-height: 200px;">
								<table class="table table-striped custom-table m-b-0 datatable" id="worksheet">
									<thead>
										<tr>
											<th style="display: none;">Time</th>
											<th>Employee</th>
											<th>Date</th>
											<th>Projects</th>
											<th class="text-center">Delay</th>
											<th class="text-center">Completed Scope of Work</th>
											<th class="text-center set_wtd_icon">Pictures</th>
											
											<th class="text-right">Actions</th>
										</tr>
									</thead>
									<tbody>
										<?php
										

			// $Time_Card = "SELECT * FROM Time_Card";
			// $Time_Cardd = mysqli_query($con,$Time_Card);
 			if ($Time_Cardd->num_rows > 0) {
				while($card_data = $Time_Cardd->fetch_assoc()) {
					// echo "<pre>";print_r($card_data);echo"</pre>";
							$employee_id = $card_data['employe_id']; 
										$proj_name = mysqli_query($con,"Select * from  employee where empl_id = '$employee_id'");
										$emp_name = $proj_name->fetch_assoc();
										$employee_name = $emp_name['first_name'];
								$card_projectid = $card_data['project'];
										$proj_name = mysqli_query($con,"Select * from  project where Project_id = '$card_projectid'");
										$res_proj_name = $proj_name->fetch_assoc();

				?>
				<tr>

		<?php
				
				$time_set = "SELECT * FROM `time_card` ORDER BY `time_set` DESC";
				$time_setting = mysqli_query($con,$time_set);
				$time_setting_value = mysqli_fetch_array($time_setting);
				//echo "<pre>"; print_r($time_setting_value);
			 ?>

			<td style="display: none;"><?php  // $time_setting_value['time_set']; ?></td>
				<td class="col-md-3">
				<a href="#" class="avatar">J</a>
											<h2><a href=""><?php echo $employee_name; ?></a></h2>
				</td>
											<td><?php echo $card_data['date']; ?></td>
											<td>
												<?php echo $res_proj_name['Project_name']; ?>
											</td>
											<td class="text-center col-md-2"><?php echo $card_data['delay']; ?></td>
											<td class="text-center"><?php echo $card_data['scope_work']; ?></td>
											<td class="col-md-4 set_wtd_icon" style="text-align: center;">
												<?php
												 $images_value = $card_data['picture']; 
												 $image_val = explode('#',$images_value);
												 foreach ($image_val as $key => $image1) { ?>
												 	
											 	<a class="fancybox" rel="gallery1" href="<?php echo $image1; ?>" >
													<img src="<?php echo $image1; ?>">
											</a>
											<?php	 }

												 ?>
											
											<!-- <a class="fancybox" rel="gallery1" href="assets/img/construction-image.jpg" >
												<img src="assets/img/construction-image.jpg" alt="" width="30" height="30"/>
											</a>
											<a class="fancybox" rel="gallery1" href="assets/img/cunstruction3.jpg" >
												<img src="assets/img/cunstruction3.jpg" alt="" width="30" height="30" />
											</a> -->		
											    <!-- <img class="" src="assets/img/user-03.jpg" width="30" alt="">
												<img class="" src="assets/img/user-03.jpg" width="30" alt="">
												<img class="" src="assets/img/user-03.jpg" width="30" alt=""></td>
											 -->
											
											<td class="text-right">
												<div class="dropdown">
													<a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
													<ul class="dropdown-menu pull-right">
														<li><a href="" id="editTimeC<?php echo $card_data['id']; ?>" title="Edit" data-toggle="modal" data-target="#edit_todaywork<?php echo $card_data['id']; ?>"><i class="fa fa-pencil m-r-5"></i> Edit</a></li>
														<li><a href="" title="Delete" data-toggle="modal" data-target="#delete_workdetail<?php echo $card_data['id']; ?>"><i class="fa fa-trash-o m-r-5"></i> Delete</a></li>
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
						$scope_work= $_POST['scope_work'];
							 
						$update="UPDATE field_report SET scope_work='".$scope_work."' WHERE id=".$idd;	 
						$updatee=mysqli_query($con,$update); 

						if($updatee >0)
						{ 
							header("Refresh:0"); 
						}else{
							echo "record not update";

						}

						}

					?>
					
<div id="edit_todaywork<?php echo $card_data['id']; ?>" class="modal custom-modal fade" role="dialog">
				<div class="modal-dialog">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<div class="modal-content modal-md">
						<div class="modal-header">
							<h4 class="modal-title">Edit Field Reports</h4>
							
						</div>
						<div class="modal-body">
							<form action="" method="post">
								<div class="form-group">
									<input class="form-control" name="save_i" value="<?php echo $card_data['id']; ?>" type="hidden" >
									<label>Completed Scope of Work <span class="text-danger">*</span></label>
									<input type="text" name="scope_work" value="<?php echo $card_data['scope_work'];?>">
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
 	echo "<h3>No Record found</h3>";
 } 
 ?>

									</tbody>
								</table>
							</div>
						</div>
					</div>
                </div>
				
            </div>
			
					<?php
			$log_user_qury = "SELECT * FROM project";
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
					<div class="form-group">
					<?php $selectemp = mysqli_query($con, "SELECT Project_leader,Team_member from project");
					?>
					<label>Employee <span class="text-danger">*</span></label>
					<select class="select_employee form-control" name="select_emp_nama" id="select_emp_nama_append">
					<option value="">Select Employee</option> 
					<!--<?php
					//if(mysqli_num_rows($selectemp) > 0)
					//{
					//while($res_selectemp = $selectemp->fetch_assoc()) {					
					?>
					<option value="<?php // echo $res_selectemp['Project_id']; ?>"><?php // echo $res_selectemp['Project_leader']; ?></option>
					<?php //} } ?>  -->
					</select>
					</div>
								<div class="row">
									<div class="form-group col-sm-4">
										<label>Deadline <span class="text-danger">*</span></label>
										<div class="cal-icon">
											<input class="form-control" type="text" id="datepicker" name="deadline">
										</div>
									</div>
									<!-- <div class="form-group col-sm-4">
										<label>Total Hours <span class="text-danger">*</span></label>
										<input class="form-control digit_only" type="text" value="" name="total_hour" id="addTimeCtotalHours" readonly>
									</div> -->
									<div class="form-group col-sm-4">
										<label>Remaining Hours<span class="text-danger">*</span></label>
										<input class="form-control digit_only" type="text" value="" name="remain_hour" readonly>
									</div>
								<div class="form-group col-sm-4">
									<label>Work Type <span class="text-danger">*</span></label>
									<select class="select_pro selectWorkType" name="work_type" id="selectWorkType">
										<option value="Machines">Machines</option>
										<option value="Labourer">Labourer</option>
										<option value="Foreman">Foreman</option>
									</select>
								</div>
								</div>
								<div class="row">
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
								<div class="row maltiple_machine_display selectMachines">
								    <div class="form-group col-sm-12">
										<label>Add Machines <span class="text-danger">*</span></label>
										<!--
										<span id="add_new_machine">
										<i class="fa fa-plus-square" aria-hidden="true"></i>
										</span>
										
										<input type="text" name="machine_name[]" placeholder="machine_name" class="typeahead tm-input form-control tm-input-info" id="search_machine" autocomplete="off" style="display: none;" />
										-->
								 <ul style="list-style: none;">
									<?php	
									if ($machin->num_rows > 0) { 
									while($roww = $machin->fetch_assoc()) {
										$id = $roww['machine_id'];

										?>
										
										    <li class="text_center-sec">
											<div class="one_more">
										   <input type="checkbox" name="multiple_machine[<?php echo $id; ?>]" value="<?php echo $roww['machine_id']; ?>">&nbsp;&nbsp;
										    	<label class="machin_n">
												<?php echo $roww['machine_name']; ?>
												</label>
												</div>
												<div class="lb_sel">
												&nbsp;&nbsp;<select class="machine_multiple_add text_center-dec " name="machine_multiple_add[<?php echo $id; ?>]"></select>&nbsp;&nbsp;<label class=""> Hours </label>
												</div>
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
      <!--  <script type="text/javascript" src="assets/js/jquery-3.2.1.min.js"></script> -->
        <script type="text/javascript" src="assets/js/bootstrap.min.js"></script>
		<script type="text/javascript" src="assets/js/jquery.slimscroll.js"></script>
		<script type="text/javascript" src="assets/js/select2.min.js"></script>
		<script type="text/javascript" src="assets/js/moment.min.js"></script>
		<script type="text/javascript" src="assets/js/bootstrap-datetimepicker.min.js"></script>
		<script type="text/javascript" src="assets/js/app.js"></script>
		<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
		<link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap.min.css">
		<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
		<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
		<script src="https://cdn.jsdelivr.net/jquery.validation/1.15.1/jquery.validate.min.js"></script>
		<script type="text/javascript" src="assets/js/typeahead.js"></script>
		<!--<script type="text/javascript" src="assets/js/dataTables.bootstrap.min.js"></script>-->
		<script type="text/javascript" src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap.min.js"></script>
		<script type="text/javascript" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>


	<script type="text/javascript" src="./lib/jquery.mousewheel.pack.js?v=3.1.3"></script>
	<!-- Add fancyBox main JS and CSS files -->
	<script type="text/javascript" src="./source/jquery.fancybox.pack.js?v=2.1.5"></script>
	<link rel="stylesheet" type="text/css" href="./source/jquery.fancybox.css?v=2.1.5" media="screen" />
	<!-- Add Button helper (this is optional) -->
	<link rel="stylesheet" type="text/css" href="./source/helpers/jquery.fancybox-buttons.css?v=1.0.5" />
	<script type="text/javascript" src="./source/helpers/jquery.fancybox-buttons.js?v=1.0.5"></script>
	<!-- Add Thumbnail helper (this is optional) -->
	<link rel="stylesheet" type="text/css" href="./source/helpers/jquery.fancybox-thumbs.css?v=1.0.7" />
	<script type="text/javascript" src="./source/helpers/jquery.fancybox-thumbs.js?v=1.0.7"></script>
	<!-- Add Media helper (this is optional) -->
	<script type="text/javascript" src="./source/helpers/jquery.fancybox-media.js?v=1.0.6"></script>

<script type="text/javascript">
	$(document).ready( function () {
		$('#worksheet').DataTable({
			"pagingType":"full_numbers"	,
			"bLengthChange": false,
			"bFilter": false,
			"bInfo": false,
			"bAutoWidth": false
		});
	} );
</script>	
	
<script type="text/javascript">
	
	$(document).ready(function(){
			$('.digit_only').keypress(function(event){

			       if(event.which != 8 && isNaN(String.fromCharCode(event.which))){
			           event.preventDefault(); //stop character from entering input
			       }
			      });

				$(function(){
			    $("#datepicker,#datepicker1,#datepickerr1,#datetimepickerExportStart,#datetimepickerExportEnd").datepicker();
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


$('.ApproveOld').click(function(event){
	var id = $(this).attr('data-id');
	alert(id);
	var Approve = '1';
	var time_card = 'approve_data_time_card';

 $.ajax({
               url: "approve_ajax.php",
               data: {Approve: Approve, time_card: time_card, id: id},
               //dataType: "json",
               type: "POST",
               success: function (data) {
              
               //    if(data == '1')
               //    location.reload();
                   }
               });
           });
$(document).on('click','.Approve',function(){
	var id = $(this).attr('data-id');
	var Approve = '1';
	var time_card = 'approve_data_time_card';

	$.ajax({
	   url: "approve_ajax.php",
	   data: {Approve: Approve, time_card: time_card, id: id},
	   //dataType: "json",
	   type: "POST",
	   success: function (data) {
	  
				if(data == '1'){
					//location.reload();
					$('span.approve-text-'+id).html('Approve');
					//$('i.approve-textmessage-'+id).toggleClass('text-danger text-success');
					$('i.approve-textmessage-'+id).removeClass('text-danger text-success');
					 //$('i.approve-textmessage-'+id).removeClass('');
					 $('i.approve-textmessage-'+id).addClass('text-success');
				}
		   }
	   });
});

$(document).on('click','.Decline',function(){
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
		    //   location.reload();
				 $('span.approve-text-'+id).html('Decline');	
				 $('i.approve-textmessage-'+id).removeClass('text-danger text-success');
				 //$('i.approve-textmessage-'+id).removeClass('text-success');
				 $('i.approve-textmessage-'+id).addClass('text-danger');
			   }
		   }
	   });
});

$('.DeclineOld').click(function(event){
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
              //     location.reload();
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


// $( "#add_project_name" ).change(function () {
// 	    var project_di = this.value;
// 	   $.ajax({
//                url: "project_assign_empolyee.php",
//                data: {project_di: project_di},
//                type: "POST",
//                success: function (data) {
//                	//alert(data);
//                	 $('.add_new_time_cr').html(data);
                   
//                }
//            });
//   });

 
$( "#add_project_name" ).change(function () {
	var project_di = this.value;
	$("#select_emp_nama_append").empty();
	$.ajax({
		url: "project_assign_empolyee.php",
		data: {'project_dia': project_di},
		type: "POST",
		dataType:'JSON',
		success: function (data) {
			
			if(data.msg == "success"){
				$("#select_emp_nama_append").append(data.empName);
				$("#addTimeCtotalHours").val(data.totalHours);
				$("input[name = remain_hour]").val(data.totalRemainHours);
			}
		}
	});
 });

/*=====================  remain hours ========================= */

// $("input[name = work_hours]").keyup(function(){
// 	var hours = $(this).val();
// 	var project_id  = $("#add_project_name").val();
// 	var total_hours = $("#addTimeCtotalHours").val();
// 	// alert(project_id)
// 	// alert(total_hours)
// 	$.ajax({
// 		url: "get_total_hours.php",
// 		data: {'project_id': project_id, total_hours:total_hours,hours:hours},
// 		type: "POST",
// 		dataType:'JSON',
// 		success: function (data) {
			
// 			if(data.msg == "success"){
// 				$("input[name = remain_hour]").val(data.totalHours);
// 			}
// 		}
// 	});
// });

/*=====================================================================*/

//end  add new time card = get team member 
$(function(){
    var $select = $(".machine_multiple_add");
    for (i=0;i<=10;i++){
        $select.append($('<option></option>').val(i).html(i))
    }
});

/* 
$('#add_new_machine').click(function(event){
	
$('#search_machine').css('display','block');

});

var tagApi = $(".tm-input").tagsManager();
    jQuery(".typeahead").typeahead({
      name: 'machine_name',
      displayKey: 'machine_name',
	  valueKey: 'machine_id',
      source: function (query, process) {
        return $.get('autocomplete/ajaxpro.php', { query: query }, function (data) {
			console.log(data);
          data = $.parseJSON(data);
          return process(data);
        });
      },
      afterSelect :function (item){
        tagApi.tagsManager("pushTag", item);
      }
    });
 */

$( ".add_project_name_edit" ).change(function () {
	var project_di = this.value;
	var emp_id = $(this).next().val();
	
	$(".select_emp_nama_append2").empty();
	$.ajax({
		url: "project_assign_empolyee_edit.php",
		data: {'project_dia': project_di,'emp_id':emp_id},
		type: "POST",
		dataType:'JSON',
		success: function (data) {

			if(data.msg == "success"){
				$(".select_emp_nama_append2").append(data.empName);
				$(".editTotalHours").val(data.totalHours);
				$(".editRemainHours").val(data.totalRemainHours);
			}
			// $(".select_emp_nama_append2").append(data);
		}
	});
 });


/* ========== jquery for show machine section on select work machine ==================== */

	$('.selectWorkType').change(function(){
		var work_type = $(this).val();
		if(work_type === "Machines"){
			$('.selectMachines').show(200);
			$('.selectMachinesEdit').show(200);
		}else{
			$('.selectMachines').hide(200);
			$('.selectMachinesEdit').hide(200);
			
		}
	});

/* ====================================================================================== */
	

});
$(document).ready(function() {
	$(".fancybox").fancybox({
		openEffect	: 'none',
		closeEffect	: 'none'
	});
});
</script>

    </body>
</html>

 
