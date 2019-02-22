<?php 

include "header.php";
include "sidebar.php";	
$obj = new connection();
$con = $obj->connect(); 

?>
<?php 
if (isset($_POST['delete_id_data'])) {
						$id= $_POST['delet_to_id'];
				
					 $del="delete from time_card where id= $id  ";
					echo $delete = mysqli_query($con,$del); 
						if($delete > 0)
						{
							//echo "jj";
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




.loader {
		border: 3px solid transparent;
		/* position: absolute;
		top:50%;
		left:45%; */
		border-radius: 50%;
		border-top: 3px solid #3498db;
		width: 30px;
		height: 30px;
		-webkit-animation: spin 2s linear infinite; / Safari /
		animation: spin 2s linear infinite;
	}
	
	/ Safari /
	@-webkit-keyframes spin {
		0% { -webkit-transform: rotate(0deg); }
		100% { -webkit-transform: rotate(360deg); }
	}
	
	@keyframes spin {
		0% { transform: rotate(0deg); }
		100% { transform: rotate(360deg); }
	}
</style>
<?php


 

if(isset($_SESSION['user_id'])){
if(isset($_POST['Add_Timecard'])){
	
	try{
		$multiple_machine = $_POST['multiple_machine'];
	}
	catch(Exception $e)
	{
	   //You are here means that the exception occurred now do something else here.
	}
	
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
	$created_date = date("Y-m-d");
	$time_set=time();

    $log_user_quryy = "INSERT INTO time_card (project_name, employee_id, deadline, total_hours, remain_hours, work_type, card_date, hours, description, machine, machine_hours,created_date,time_set) VALUES ('$project_name','$employee_id' , '$deadline', '$total_hour','$remain_hour', '$work_type', '$work_date','$work_hours', '$description', '$machine_name', '$hourss','$created_date','$time_set')";
   	

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

	if(isset($_POST['rearch_res'])){
		
		$find_emp_name = $_POST['employee_name'];
         
        $find_project_id = $_POST['project_id'];
		// $find_date = $_POST['search_date'];
		$start_date = $_POST['start_date'];
		$end_date = $_POST['end_date'];
        $find_status = $_POST['status'];

$SearchArray = array();
  if(!empty($find_emp_name)){
  $SearchArray[] = "e.first_name like '%$find_emp_name%'";
  }
   if(!empty($find_project_id)){
  $SearchArray[] = "u.project_name like '%$find_project_id%'";
  }
//    if(!empty($find_date)){
//   $SearchArray[] = "u.card_date like '%$find_date%'";
//   }

if(!empty($start_date)){
	 $SearchArray[] = "STR_TO_DATE(u.card_date,'%m/%d/%Y') >= STR_TO_DATE('$start_date','%m/%d/%Y')";
   }

   if(!empty($end_date)){
	$SearchArray[] = "STR_TO_DATE(u.card_date,'%m/%d/%Y') <= STR_TO_DATE('$end_date','%m/%d/%Y')";
  }

   if(!empty($find_status) || $find_status != NULL ){
		 if($find_status != "all")
		 {
			$SearchArray[] = "u.status like '%$find_status%'";

		 }
		 
 
  }
//   if(!empty($start_date) || $find_status != NULL ){
// 	$SearchArray[] = "u.status like '%$find_status%'";
// 	}

   $searchQuery = implode(" AND ",$SearchArray);
 //echo "SELECT * FROM employee where $searchQuery";

   	        // echo "<pre>";
            // print_r($searchQuery);
            // echo "</pre>"; die;
if($searchQuery == "")
{
	$Time_Card =("SELECT * FROM `time_card` AS u INNER JOIN `employee` AS e ON e.empl_id = u.employee_id ");		 
	$Time_Cardd = mysqli_query($con,$Time_Card);
       
}
else{
  $Time_Card =("SELECT * FROM `time_card` AS u INNER JOIN `employee` AS e ON e.empl_id = u.employee_id where $searchQuery ");		 
				 $Time_Cardd = mysqli_query($con,$Time_Card);
}		
		//echo $Time_Card;

	}else{
					$Time_Card = "SELECT * FROM `time_card` AS u INNER JOIN `employee` AS e ON e.empl_id = u.employee_id ORDER BY `id` DESC" ;
                    $Time_Cardd = mysqli_query($con,$Time_Card);
	}
	$olddate=null;
	$oldenddate=null;

	if(isset($_POST['start_date']) && !empty($_POST['start_date'])) {
    $olddate = $_POST['start_date'];
}

if(isset($_POST['end_date']) && !empty($_POST['end_date'])) {
	$oldenddate = $_POST['end_date'];
}

?>
<script>

function projectcall()
{
	//$('#projectnamecheck').is(":checked")
    if($('#projectnamecheck').is(":checked"))   
				$("#projectname").show();
				
    else
				$("#projectname").hide();
				$("#emplname").hide();
}
function emplcall()
{
    if($('#emplcheckmark').is(":checked"))   
				$("#emplname").show();
			
    else
				$("#emplname").hide();
				$("#projectname").hide();
}

// if($('#projectnamecheck').is(':checked'))
// {
// 	$("#projectname").css('display','block');
// }
</script>

<!-- ===================================================================== -->
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
			 <!-- =======================  Searching section ============================== -->
					
					<div class="row filter-row">
					   <form method="post" action="" name="employee_search">
						<div class="col-sm-2 col-xs-6">  
							<div class="form-group form-focus">
								<label class="control-label">Employee name</label>
								<input type="text" name="employee_name" class="form-control floating" />
							</div>
						</div>
						<div class="col-sm-2 col-xs-6"> 
							<div class="form-group form-focus select-focus">
								
							<?php
										$log_user_qury = "SELECT Project_id ,Project_name from Project";
										$res_data = mysqli_query($con,$log_user_qury);
										?>
									<select class="select_pro" name="project_id" >
										<option value="">Select project</option>				
										<?php	if ($res_data->num_rows > 0) { 
											while($row = $res_data->fetch_assoc()) {
										?>
												<option value="<?php echo $row['Project_id']; ?>"><?php echo $row['Project_name']; ?></option>
										<?php } }?>
									</select>
							</div>
						</div>
						<!-- <div class="col-sm-2 col-xs-6"> 
							<div class="form-group form-focus">
										<label class="control-label">Date</label>
										<div class="cal-icon form-group form-focus">
											<input class="form-control datetimepicker floating" type="text" id="datepickerr1" name="search_date">
										</div>
									</div>
						</div> -->


						<div class="col-sm-2 col-xs-6"> 
							<div class="form-group form-focus">
								<label class="control-label">Start Date</label>
								<div class="cal-icon form-group form-focus">
								
								<input class="form-control datetimepicker floating" value="<?php echo $olddate; ?>" autocomplete="off" type="text" id="datetimepickerExportStart" name="start_date">
								
								</div>
							</div>
						</div>

						<div class="col-sm-2 col-xs-6"> 
							<div class="form-group form-focus">
								<label class="control-label">End Date</label>
								<div class="cal-icon form-group form-focus">
								<input autocomplete="off" value="<?php echo $oldenddate; ?>" class="form-control datetimepicker floating" type="text" id="datetimepickerExportEnd" name="end_date">
								</div>
							</div>
						</div>



						<div class="col-sm-2 col-xs-6"> 
							<div class="form-group form-focus select-focus">
								
								<select name="status" class="select floating "> 
									<option value="all">Select status</option>
									<option value="1">Approve</option>
									<option value="0">Decline</option>
								</select>
							</div>
						</div>
						<div class="col-sm-2 col-xs-6">  
						    <input type="submit" name="rearch_res" class="btn btn-success btn-block" value="Search">
							<input type="button" class="ref_page btn btn-info btn-block" value="Reset">
						</div> 

					  </form>     
                    </div>

         <!-- ================================================================================ --> 

         <!-- ============================= Export section =================================== -->

         			<div class="row export_section">
         				  <div class="col-sm-2 col-xs-6">  
						    <button type="button" class="btn btn-info btn-lg btn-success btn-block" data-toggle="modal" data-target="#myModalExport">Export Payroll</button>
						  </div>	
         			</div>

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
										<input class="form-control datetimepicker floating" value="02/1/2019" autocomplete="off"  type="text" id="datetimepickerExportStart2" name="start_date">
									</div>
								</div>
							  
								<label class="control-label">End Date</label>
								<div class="form-group form-focus">
									<div class="cal-icon form-group form-focus">
										<input class="form-control datetimepicker floating" value="02/28/2019" autocomplete="off"  type="text" id="datetimepickerExportEnd2" name="end_date">
									</div>
								</div>

								<div class="form-check form-check-inline pull-left">
  <input class="form-check-input" checked="checked" onchange="emplcall()" type="radio" name="exportcheck"  value="1">
  <label class="form-check-label" for="inlineCheckbox1">Export by Person</label>
</div>
<div class="form-check form-check-inline ">
  <input class="form-check-input"  onchange="projectcall()" style="margin-left:40px;" type="radio" name="exportcheck"  value="2">
  <label class="form-check-label" for="inlineCheckbox2">Export by Project</label>
</div>

<div class="form-check form-check-inline pull-left " style="margin-top:10px;margin-right:25px;">
  <input class="form-check-input" checked="checked" onchange="emplcall()" type="radio" name="downloadtype" value="1">
  <label class="form-check-label"  for="inlineCheckbox1">Download xls</label>
</div>
<div class="form-check form-check-inline " style="margin-top:10px;">
  <input class="form-check-input"  onchange="projectcall()" style="margin-left:40px;" type="radio" name="downloadtype" value="2">
  <label class="form-check-label" for="inlineCheckbox2">Download Pdf</label>
</div>
<?php
										$log_user_qury = "SELECT Project_id ,Project_name from Project";
										$res_data = mysqli_query($con,$log_user_qury);
										?>
										<!-- <div class="row">
										<div class="col-sm-5" id="projectname" style="display:none;">
                    <select class="select_pro" name="project_id" >
										<option value="">Select project</option>				
										<?php	if ($res_data->num_rows > 0) { 
											while($row = $res_data->fetch_assoc()) {
										?>
												<option value="<?php echo $row['Project_id']; ?>"><?php echo $row['Project_name']; ?></option>
										<?php } }?>
									</select>
									</div>
									<?php
										$log_user_qury = "SELECT Project_id ,Project_name from Project";
										$res_data = mysqli_query($con,$log_user_qury);
										?>
									<div class="col-sm-5" id="emplname" style="display:none;">
                    <select class="select_pro" name="project_id" >
										<option value="">Select Employee</option>				
										<?php
					$selectemp = mysqli_query($con, "SELECT empl_id,first_name from employee");
					if(mysqli_num_rows($selectemp) > 0){
					while($res_selectemp = $selectemp->fetch_assoc()) {					
					?>
												<option <?php echo $res_selectemp['empl_id']; ?>"><?php echo $res_selectemp['first_name']; ?></option>
										<?php } }?>
									</select>
									</div>
								  </div> -->
								<div style="margin-left: 20px;margin-top: 20px;" id="loaderview" class="loader" style="transform:scale(0.5)"></div>

								<input type="button" onclick="exportData()" style="margin-top:30px;"  id="exportdata" class="btn btn-success btn-block exportButton" value="Export">

				          </form>		
				        </div>
				      </div>
				    </div>
				  </div>	
         <!-- ================================================================================ -->
					<div class="row worksheet">
						<div class="col-md-12">
							<div class="table-responsive" style="min-height: 153px;">
								<table class="table table-striped custom-table m-b-0 datatable" id="worksheet">
									<thead>
										<tr>
											<th style="display: none;">Time</th>
											<th>Employee</th>
											<th>Date</th>
											<th>Projects</th>
											<th class="text-center">Work Type</th>
											<th class="text-center">Hours</th>
											<th class="text-center set_wtd_icon">Description</th>
											<th class="text-center">Machines</th>
											<th class="text-center">Status</th>
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
				$card_projectid = $card_data['project_name']; 
				$proj_name = mysqli_query($con,"Select * from  Project where Project_id = '$card_projectid'");
				$res_proj_name = $proj_name->fetch_assoc();
										

				$card_data_emp_id  = $card_data['empl_id'];	
				// $card_data_emp_id  = $card_data['employee_id'];	
				$selectempnam = mysqli_query($con, "SELECT * from employee where empl_id ='$card_data_emp_id'");
				if($selectempnam->num_rows > 0 ){
					$emp_name = $selectempnam->fetch_assoc();
				}				

				?>
				<tr>
		<?php
		$time_set = "SELECT * FROM time_card ORDER BY `time_set` DESC";
		$time_connect = mysqli_query($con,$time_set);
		$time_records = mysqli_fetch_array($time_connect);
		//echo "<pre>"; print_r($time_records);
		?>

				<td style="display: none;"><?php  $time_records; ?></td>
				<td class="col-md-3">
				<a href="<?php  echo $base_url .'worksheet.php'; ?>" class="avatar"><?php  echo  $emp_name['first_name'][0];   ?></a>
				<h2><a href="<?php  echo $base_url .'worksheet.php'; ?>"><?php echo  $emp_name['first_name']; ?> <span><?php echo  $emp_name['designation']; ?></span></a></h2>
				</td>
											<td><?php echo $card_data['card_date']; ?></td>
											<td>
												<h2><?php echo $res_proj_name['Project_name']; ?></h2>
											</td>
											<td class="text-center col-md-2"><?php echo $card_data['work_type']; ?></td>
											<td class="text-center"><?php echo $card_data['hours']; ?></td>
											<td class="col-md-4 set_wtd_icon" style="text-align: center;"><?php echo $card_data['description']; ?></td>
											<td class="col-md-3">
											<ul class="avtar-image-sec">
			<?php
			$array_value = $card_data['machine'];
			$array =  explode(',', $array_value);
			$string_version = implode(',', $array);
			
			$get_machine = "select * from machine WHERE `machine_id` IN ($string_version) ";
			$get_machinee = mysqli_query($con,$get_machine);
			//print_r($get_machinee);
			
			$NewArrayname = array();
			@$row=mysqli_fetch_assoc($get_machinee);
			
			//print_r($row); 
			
			while(@$row=mysqli_fetch_assoc($get_machinee))
			{
			$NewArrayname[] = $row['machine_name'];
			}
			
										
										$array_value = $card_data['machine'];
										$array =  explode(',', $array_value);
									
									
										$hour = $card_data['machine_hours'];
										$hoursss =  explode(',', $hour);
											foreach($hoursss as $key1 => $hours){ 
											if($key1 <= 3 && Sizeof($NewArrayname)){
											?>
										
										<li>
											<a href='' data-toggle='tooltip' title='<?php echo $NewArrayname[$key1] ." &nbsp;:&nbsp; ".$hours."&nbsp; Hours"; ?>'>
												<img src='assets/img/user.jpg' class='avatar'  height='20' width='20'>
										</a></li>
										<?php } }
										//} 
										unset($hoursss[0]);
										unset($hoursss[1]);
										unset($hoursss[2]);
										unset($hoursss[3]);
										if(count($hoursss) != 0):
										?>
										
										<li class="icon-ginti"><a href="" class="all-users">+<?php echo count($hoursss); ?></a></li>
										
										<?php endif;?>	

</ul>
											</td>
											<td class="col-md-2">
												<div class="dropdown action-label worksheet_pg">
													<a class="btn btn-white btn-sm rounded dropdown-toggle" data-toggle="dropdown" aria-expanded="false"> 
													
									<?php
									if($card_data['status'] == 1){
									echo '<i class="fa fa-dot-circle-o text-success approve-textmessage-'.$card_data['id'].'"></i><span class="change_heading approve-text-'.$card_data['id'].'"> Approve </span><i class="caret"></i></a>';
									}else{
									echo '<i class="fa fa-dot-circle-o text-danger approve-textmessage-'.$card_data['id'].'"></i><span class="change_heading approve-text-'.$card_data['id'].'"> Decline </span><i class="caret"></i></a>';
									}
									?>
													<ul class="dropdown-menu">
														<li class="Approve" data-id="<?php echo $card_data['id']; ?>"><a href="javascript:void(0);"><i class="fa fa-dot-circle-o text-success"></i> Approve</a></li>
														<li class="Decline" data-id="<?php echo $card_data['id']; ?>"><a href="javascript:void(0);"><i class="fa fa-dot-circle-o text-danger"></i> Decline</a>
														</li>
														
													</ul>
												</div>
											</td>
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
						$project_name= $_POST['project_name'];

						$select_emp_namaup = $_POST['select_emp_nama'];

						$deadline = $_POST['deadline'];
						$total_hours = $_POST['total_hours'];
						$remain_hours = $_POST['remain_hours'];
						$work_type = $_POST['work_type'];
						$work_date= $_POST['work_date'];
						$work_hours= $_POST['work_hours'];
						
						$machine_nameup = implode(",",$_POST["multiple_machineup"]);
						
						$hours = $_POST["machine_multiple_addup"];
					 	$machine = $_POST["multiple_machineup"];
					
						$hours = array_intersect_key($hours, $machine);
						$hourss1 = implode(",",$hours);
						
						$machine_multiple_add = implode(",",$_POST["machine_multiple_addup"]);												
						$description= $_POST['description'];			
						
						  $update="UPDATE `time_card` SET  
						 `project_name`='".$project_name."',
						 `employee_id`='".$select_emp_namaup."',
						 `deadline`='".$deadline."',
						 `total_hours`='".$total_hours."',
						 `remain_hours`='".$remain_hours."',
						 `work_type`='".$work_type."',
						 `card_date`='".$work_date."' ,
						 `hours`='".$work_hours."' ,
						 `description`='".$description."',
						 `machine`='".$machine_nameup."',						 
						 `machine_hours`='".$hourss1."'

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

						 // echo"<pre>";
							// print_r($_POST);
							// echo"</pre>";
							// echo $update."<br>";
							// print_r($select_emp_namaup);
							// die;
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
							<h4 class="modal-title">Edit Time Card Details</h4>
							
						</div>
						<div class="modal-body">
							<form action="" method="post">
								<div class="form-group">
									<input class="form-control" name="save_i" value="<?php echo $card_data['id']; ?>" type="hidden" >
									<label>Project <span class="text-danger">*</span></label>
									<?php

									// for project name
									//echo "<pre>"; print_r($card_data); echo "<pre>";
										$card_projectid = $card_data['project_name']; 
									
										$proj_name = mysqli_query($con,"Select * from  Project where Project_id = '$card_projectid'");
										$res_proj_name = $proj_name->fetch_assoc();

									// for employe selected
										 $employee_id = $card_data['empl_id']; 
										$proj_name = mysqli_query($con,"Select * from  employee where empl_id = '$employee_id'");
										$emp_name = $proj_name->fetch_assoc();
 	//echo "<pre>"; print_r($emp_name['empl_id']); echo "</pre>";
										?>
									<select class="select_pro add_project_name_edit" name="project_name" id="add_project_name_edit" required="required">
										<option value="<?php echo $res_proj_name['Project_id']; ?>"><?php echo $res_proj_name['Project_name']; ?></option>						
										<?php	if ($res_data->num_rows > 0) { 
											while($row = $res_data->fetch_assoc()) {
										?>
												<option value="<?php echo $row['Project_id']; ?>"><?php echo $row['Project_name']; ?></option>
										<?php } } ?>
									</select>
									<input type="hidden" name="emp_id" value="<?php echo $card_data['empl_id'];?>">
								</div>
					<div class="form-group">					
					<label>Employee<span class="text-danger">*</span></label>
					<select class="select_employee form-control select_emp_nama_append2" name="select_emp_nama" id="select_emp_nama_append2">
					<option value="<?php echo $emp_name['empl_id']; ?>"><?php echo $emp_name['first_name']; ?></option> 

					</select>

				<!-- 	<select class="select_employee form-control" name="select_emp_namaup" id="select_emp_nama">
					<option value="<?php echo $emp_name['empl_id'];  ?>"><?php echo  $emp_name['first_name']; ?></option> 
					<?php
					$selectemp = mysqli_query($con, "SELECT empl_id,first_name from employee");
					if(mysqli_num_rows($selectemp) > 0){
					while($res_selectemp = $selectemp->fetch_assoc()) {					
					?>
					<option value="<?php echo $res_selectemp['empl_id']; ?>"><?php  echo $res_selectemp['first_name']; ?></option>

					<?php } } ?>
					</select> -->
					</div>
					<div class="row">
									<div class="form-group col-sm-4">
										<label>Deadline <span class="text-danger">*</span></label>
										<div class="cal-icon">
											<input class="form-control" value="<?php echo $card_data['deadline']; ?>" type="text" id="datepicrr<?php echo $card_data['id']; ?>" name="deadline" required="required">
										</div>
									</div>
									<!-- <div class="form-group col-sm-4">
										<label>Total Hours <span class="text-danger">*</span></label>
										<input class="form-control digit_only editTotalHours" type="text" value="<?php echo $card_data['total_hours']; ?>" name="total_hours" required="required" readonly >
									</div> -->
									<div class="form-group col-sm-4">
										<label>Remaining Hours<span class="text-danger">*</span></label>
										<input class="form-control digit_only editRemainHours" type="text" value="<?php echo $card_data['remain_hours']; ?>" name="remain_hours"  required="required" readonly>
									</div>
								<div class="form-group col-sm-4">
									<label>Work Type <span class="text-danger">*</span></label>									
									<select class="select_pro selectWorkType " name="work_type" id="selectWorkType" required="required">
										<option selected value="<?php echo $card_data['work_type']; ?>"><?php echo $card_data['work_type']; ?></option>
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
											<input class="form-control" value="<?php echo $card_data['card_date']; ?>" type="text" id="datepickerr<?php echo $card_data['id']; ?>" name="work_date" required="required">
										</div>
									</div>
									<div class="form-group col-sm-6">
										<label>Hours <span class="text-danger">*</span></label>
										<input class="form-control" type="text" value="<?php echo $card_data['hours']; ?>" name="work_hours" required="required">
									</div>
								</div>
								
								<div class="form-group">
									<label>Description <span class="text-danger">*</span></label>
									<textarea rows="4" cols="5" class="form-control" name="description" required="required"><?php echo $card_data['description']; ?></textarea>
								</div>
								<?php 
										if($card_data['work_type'] == "Machines"){
											$editClass = "";
										}else{
											$editClass = "selectMachinesEdit";
										}
								?>
								<div class="row maltiple_machine_display selectMachines <?php echo $editClass; ?>">
									<div class="form-group col-sm-12">
										<label>Add Machines <span class="text-danger">*</span></label>
								 <ul style="list-style:none;">
									<?php 
										
										//get all machine select data from timecard
											$machin_qury = "SELECT * FROM time_card where id = ".$card_data['id'];
											$get_machin = mysqli_query($con,$machin_qury);
											$NewArrayname = array();
											$row=mysqli_fetch_assoc($get_machin);
										 $chekced_id_array = explode(',' , $row['machine']);
										 $chekced_hours = explode(',' , $row['machine_hours']);
										//echo "<pre>"; print_r($chekced_id_array); echo "</pre>";
										
										
										// get all machine data here from machine
										$log_user_qury = "SELECT * FROM Project";
										$res_data = mysqli_query($con,$log_user_qury);
										$machin_qury = "SELECT * FROM machine";
										$machin = mysqli_query($con,$machin_qury);
											
										if ($machin->num_rows > 0) { 
											while($roww = $machin->fetch_assoc()) {
												//echo "<pre>"; print_r($chekced_id_array); echo "</pre>";
												//echo "<pre>"; print_r($chekced_hours); echo "</pre>";
												
												$makevalueinkey = array_combine($chekced_id_array, $chekced_hours);
													$id = $roww['machine_id'];
												if (array_key_exists($id,$makevalueinkey))
												{
													$abc =  $makevalueinkey[$id];
												}
												else{
													$abc = 0;
												}
												$id = $roww['machine_id'];
												if (in_array($id, $chekced_id_array))
													  {
													   $checkbox_chk = "checked";
													  }
													else
													  {
													   $checkbox_chk="";
													  }
													$mac_id = $roww["machine_id"];
													echo " <div class='one_more'><li><input type='checkbox' name='multiple_machineup[$id]'  value='$mac_id' $checkbox_chk >";
												?>
												 &nbsp;&nbsp;
													<label class="machin_n">
													<?php echo $roww['machine_name']; ?>
													</label>
													</div>
													<div class="lb_sel">
													&nbsp;&nbsp;<select class="multiple_machineup" name="machine_multiple_addup[<?php echo $id; ?>]">
													<option value="<?php echo $abc; ?>"><?php echo  $abc; ?></option>
													<option value="">0</option>
													<option value="1">1</option>
													<option value="2">2</option>
													<option value="3">3</option>
													<option value="4">4</option>
													<option value="5">5</option>
													<option value="6">6</option>
													<option value="7">7</option>
													<option value="8">8</option>
													<option value="9">9</option>
													<option value="10">10</option>
													</select>&nbsp;&nbsp;<label class=""> Hours </label></div>
												</li>
										<?php		
											} 
										} ?>
										
										
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
					<div class="form-group">
					<?php $selectemp = mysqli_query($con, "SELECT Project_leader,Team_member from Project");
					?>
					<label>Employee <span class="text-danger">*</span></label>
					<select class="select_employee form-control" name="select_emp_nama" id="select_emp_nama_append">
					<option value="">Select Employee</option> 
					

					<!-- <?php
					if(mysqli_num_rows($selectemp) > 0)
					{
					while($res_selectemp = $selectemp->fetch_assoc()) {	
						//print_r($res_selectemp);
					?>
					<option value="<?php echo $res_selectemp['Project_id']; ?>"><?php  echo $res_selectemp['Project_leader']; ?></option>
					<?php } } ?>   -->


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

		
		<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.14.1/xlsx.core.min.js"></script>
    <!-- <script src="https://code.jquery.com/jquery-3.3.1.min.js"
            integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
            crossorigin="anonymous">
    </script> -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/underscore.js/1.8.3/underscore-min.js"></script>

		
<script type="text/javascript">
	$(document).ready( function () {
		$('#worksheet').DataTable({
			"pagingType":"full_numbers"	,
			"bLengthChange": false,
			"bFilter": false,
			"bInfo": false,
			"bAutoWidth": false,
			"order": [[ 0, "asc" ]]
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
			    $("#datepicker,#datepicker1,#datepickerr1,#datetimepickerExportStart,#datetimepickerExportEnd,#datetimepickerExportStart2,#datetimepickerExportEnd2").datepicker();
				    showButtonPanel: true
				});

	
				  $(".card_save").validate({
			    rules: {
			      project_name: "required",
				  deadline: "required",
				  total_hour : "required",
				  // remain_hour: "required",
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
				   //remain_hour: "required",
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

               	//alert('123');
              
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
	   	//alert('123');
	  
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
		   	//alert('123');
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
               dataType:'json',
               data: {project_id: project_id, project_member: project_member},
               type: "POST",
               success: function (data) {
               //	alert('123');
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
			//alert(data);
			if(data.msg == "success"){
				$("#select_emp_nama_append").append(data.empName);
				$("#addTimeCtotalHours").val(data.totalHours);
				$("input[name = remain_hour]").val(data.totalRemainHours);
			}
		},
		error:function(err){
console.log(err);
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

</script>


<script>


 document.getElementById("loaderview").style.display="none"
function exportData(){

	var date = document.getElementById("datetimepickerExportStart2").value;
	var date2 = document.getElementById("datetimepickerExportEnd2").value;

var allfileds = date && date2;
if(date>=date2)
{
	alert("Please enter the correct date");
	return;
  if(!allfileds)
	{
		alert("Please Complete the Date fields");
		return;
	}
}
        var selValue = $('input[name=exportcheck]:checked').val(); 

				var selValue1 = $('input[name=downloadtype]:checked').val(); 
				document.getElementById("loaderview").style.display="block"
        // $('p').html('<br/>Selected Radio Button Value is : <b>' + selValue + '</b>');
		//

	var start_date = "11-12-2019";
	var end_date = "11-12-208";


if(selValue1 === "1")
downloadXLX(start_date, end_date, selValue);
else
		downloadPdf(start_date, end_date, selValue);


}
        var employees = [];
        function downloadXLX(start, end, type) {

			var data_range = 		{
	start_date : start,
	end_date : end
}

					
            var settings = {
							"async": true,
  "crossDomain": true,
  "url": "http://157.230.57.197:9100/api/xlsx-download/" + type,
  "method": "POST",
  "headers": {
    "Content-Type": "application/json",
    "cache-control": "no-cache",
    "Postman-Token": "baf3f5c0-68b1-4f09-b1c3-f49896e2cdcf"
  },
  "processData": false,
  "data":JSON.stringify(data_range)
            }


				

            $.ajax(settings).done(function (response) {
                console.log(response);
                let data = response

                
                for (var j = 0; j < data.length; j++) {
                    var index = _.findIndex(
                        employees,
                        g => g.employee_id === data[j].employee_id
                    );

                    var obj = {
                        date: data[j].card_date, client: data[j].first_name + " " + data[j].last_name, project: data[j].Project_name,
                        task: data[j].work_type, notes: data[j].description, hours: data[j].hours, billes: data[j].billed
                    }

                    if (index >= 0) {
                        employees[index].total = employees[index].total + Number(data[j].hours)
                        employees[index].dates = employees[index].dates || [];
                        employees[index].dates.push(obj);
                    } else {
                        var group = {
                            name: data[j].first_name + " " + data[j].last_name,
                            employee_id: data[j].employee_id,
                            dates: [obj],
                            total: Number(data[j].hours)
                        };
                        employees.push(group);
                    }
                }
                console.log(employees)
                getXlX();
								document.getElementById("loaderview").style.display="none"
            });

            

            function getXlX() {
                var header = [{
                    date: " ",
                    client: "Client",
                    project: "Project",
                    task: "Task",
                    notes: "Notes",
                    hours: "Hours",
                    billes: 'Billed'
                }]
                var ws = XLSX.utils.json_to_sheet([{ heading: "Timesheet Details by Project" }], { skipHeader: true, origin: "A" + 1 });
                var row_no = 2;

                XLSX.utils.sheet_add_json(ws, [{ heading: "Silver Stone Industry" }], { skipHeader: true, origin: "A" + row_no });
                row_no++;

                XLSX.utils.sheet_add_json(ws, [{ heading: "Between January 26,2019 and Feburary 09, 2019" }], { skipHeader: true, origin: "A" + row_no });
                row_no++;

                XLSX.utils.sheet_add_json(ws, header, { skipHeader: true, origin: "A" + row_no });
                row_no++;
                //lopp on employees
                for (let i = 0; i < employees.length; i++) {

                    XLSX.utils.sheet_add_json(ws, [{ name: employees[i].name }], { skipHeader: true, origin: "A" + row_no });
                    row_no++;

                    let init = 1
                    let l = 0
                    if (i > 0) {
                        l = employees[i].dates.length;
                    }

                    XLSX.utils.sheet_add_json(ws, employees[i].dates, { skipHeader: true, origin: "A" + row_no });
                    row_no = row_no + employees[i].dates.length;

                    XLSX.utils.sheet_add_json(ws, [{ total: "Total", value: employees[i].total }], { skipHeader: true, origin: "A" + row_no });
                    row_no++;
                }


                /* add to workbook */
                var wb = XLSX.utils.book_new();
                XLSX.utils.book_append_sheet(wb, ws, "People");

                /* generate an XLSX file */
                XLSX.writeFile(wb, "sheetjs.xlsx");
            }

        };

				function downloadPdf(start, end, type){

            var settings = {
							"async": true,
  "crossDomain": true,
  "url": "https://rentalant.com/api/pdf-download/" + type,
  "method": "POST",
  "headers": {
    "Content-Type": "application/json",
    "cache-control": "no-cache",
    "Postman-Token": "baf3f5c0-68b1-4f09-b1c3-f49896e2cdcf"
  },
  "processData": false,
  "data":JSON.stringify(data_range)
            }



            $.ajax(settings).done(function (response) {
console.log(response);
    var aTag = document.createElement('a');
    aTag.setAttribute('href',response.url);
		aTag.setAttribute('download',"download");
    document.body.appendChild(aTag);
		aTag.click();
document.getElementById("loaderview").style.display="none"
		

						});
				}
		

    </script>

    </body>
</html>

 
