<?php
session_start();

include "header.php";
include "sidebar.php";
$obj = new  connection();
$con = $obj->connect();

$user_id = $_SESSION['user_id'];


if(isset($_POST['create_report'])){
    $emp_id = $_POST['emp_id'];
    $starttime = $_POST['start_time'];
    $jobsite = $_POST['job_site'];
    $equipment_id = $_POST['equipment_id'];
    $scope_work  = $_POST['scope_work'];
    $special_req = $_POST['special_req'];
    $trucks   = $_POST['trucks'];
    $material_id = $_POST['material_id'];
    $quantity = $_POST['quantity'];
    $project_id = $_POST['project_id'];
    $status = 'New';//$_POST['status'];
    
    $dispatch_qury_delete = "delete from dispatch_log where emp_id =".$emp_id." and dispatch_date = CURDATE()";
    $res_data_delete = mysqli_query($con,$dispatch_qury_delete);

    $dispatch_qury = "INSERT INTO dispatch_log (emp_id, start_time,job_site,equipment_id,scope_work,special_req,trucks,material_id,quantity,status,dispatch_date,Project_id)
    VALUES ('$emp_id', '$starttime','$jobsite','$equipment_id','$scope_work ','$special_req','$trucks','$material_id','$quantity','$status',CURDATE(),$project_id)";
  $res_data = mysqli_query($con,$dispatch_qury);
  if($res_data >0){
                
    header("Refresh:0");
    
}else{
    echo "<script>alert('somthing is wrong')</script>";
    
}
  
}

if(isset($_POST['update_report'])){
    $dispatch_id =$_POST['dispatch_id'];
    $emp_id = $_POST['emp_id'];
    $starttime = $_POST['start_time'];
    $jobsite = $_POST['job_site'];
    $equipment_id = $_POST['equipment_id'];
    $scope_work  = $_POST['scope_work'];
    $special_req = $_POST['special_req'];
    $trucks   = $_POST['trucks'];
    $material_id = $_POST['material_id'];
    $quantity = $_POST['quantity'];
    $project_id = $_POST['project_id'];
    $status = 'New';//$_POST['status'];
    
    $status_update = "UPDATE dispatch_log set emp_id=$emp_id, start_time='$starttime',job_site='$jobsite',equipment_id=$equipment_id,scope_work='$scope_work',special_req='$special_req',trucks='$trucks',material_id=$material_id,quantity=$quantity,status='$status',project_id=$project_id where id=$dispatch_id";
    
  $status_update = mysqli_query($con,$status_update);
  if($status_update >0){
                
    header("Refresh:0");
    
}else{
    echo "<script>alert('somthing is wrong')</script>";
    
}
  
}

if(isset($_POST['changstatus'])){
    $dispatch_id =$_POST['dispatch_id'];
    $status = 'New';//$_POST['status'];
    
    $dispatch_qury_update = "UPDATE dispatch_log set status='Dispatched' where id=$dispatch_id";
    
  $res_data_update = mysqli_query($con,$dispatch_qury_update);
  if($res_data_update >0){
               
    
    $insert_noti_update = "insert into notification(empl_id,text) 
    select dl.emp_id , 'Report has been dispatch for date ' from dispatch_log dl where id= $dispatch_id";
    
    $res_noti = mysqli_query($con,$insert_noti_update);

    header("Refresh:0");
    ?>
     
    <?php
    
}else{
    echo "<script>alert('somthing is wrong')</script>";
    
}


}

if(isset($_POST['changstatusall'])){
    // $dispatch_id =$_POST['dispatch_id'];
    $status = 'New';//$_POST['status'];
   $current_date = date("Y/m/d");
    $dispatch_qury_updateall = "UPDATE dispatch_log set status='Dispatched' where dispatch_date = CURDATE()";
    
  $res_data_updateall = mysqli_query($con,$dispatch_qury_updateall);
  if($res_data_updateall >0){
                
    header("Refresh:0");
    ?>
     
    <?php
    
}else{
    echo "<script>alert('somthing is wrong')</script>";
    
}
  
}



if(isset($_POST['delete_employee'])){
    $dispatch_id =$_POST['dispatch_id'];
    $sql = "DELETE FROM dispatch_log where id=$dispatch_id";
 $res_data = mysqli_query($con,$sql);
    }



?>
<style>
#customers {
  
  border-collapse: collapse;
  width: 100%;
}

#customers td, #customers th {
  border: 1px solid #ddd;
  padding: 8px;
}

#customers tr:nth-child(even){background-color: #f2f2f2;}

#customers tr:hover {background-color: #ddd;}

#customers th {
  padding-top: 12px;
  padding-bottom: 12px;
  text-align: left;
  background-color: #4CAF50;
  color: white;
}
</style>
<div class="page-wrapper">
                <div class="content container-fluid">

								<div class="row">
                        <div class="col-xs-4">
                            <h4 class="page-title">Dispatch</h4>
                                                    </div>
                        <div class="col-xs-8 text-right m-b-20">
                            <a href="#" class="btn btn-primary rounded pull-right" data-toggle="modal" data-target="#add_employee"><i class="fa fa-plus"></i> Add Dispatch Log</a>
                            <!-- <div class="view-icons">
                                <a href="employees.php" class="grid-view btn btn-link active"><i class="fa fa-th"></i></a>
                                <a href="employees-list.php" class="list-view btn btn-link"><i class="fa fa-bars"></i></a>
                            </div> -->
                        </div>
                    </div>

										<div class="row filter-row" style="margin-bottom:20px;">
                    <form action="" method="post" name="employee_search" class="ng-pristine ng-valid">
                           <div class="col-sm-3 col-xs-6">  
                           <input type="button" onclick="exporttoexcle()" name="empl_search" class="btn btn-info btn-block" value="Download Data">
                           </div>
													 <div class="col-sm-3 col-xs-6"> 

													 </div>
													 <div class="col-sm-3 col-xs-6"> 
                                                     <?php
                                                     $olddate= date('Y-m-d');
                                                 
                                                     if(isset($_POST['findbydate']) && !empty($_POST['findbydate'])) {
                                                     $olddate = $_POST['findbydate'];
                                                 } ?>
                                                     <div class="form-group form-focus">
                                    <!-- <label class="control-label">Select Date</label> -->
                                    <input name="findbydate" value="<?php echo $olddate ;?>" type="date" class="form-control floating" id="finddate">
                                </div> 
													 </div>
                           <!-- <div class="col-sm-3 col-xs-6">  
                                <div class="form-group form-focus">
                                    <label class="control-label">Employee Name</label>
                                    <input name="empl_find_name" type="text" class="form-control floating">
                                </div>
                           </div> -->
                           <!-- <div class="col-sm-3 col-xs-6">
                                <div class="form-group form-focus select-focus focused">
                                    <label class="control-label">Designation</label>
                                    <select name="empl_find_designation" class="select floating select2-hidden-accessible" tabindex="-1" aria-hidden="true">
                                        <option value="0">Select Designation</option>
                                        
                                                                            <option value="23">H.R</option>
                                        
                                        
                                                                        </select>
                                </div>
                           </div> -->
                           <div class="col-sm-3 col-xs-6">  
                           <input type="submit" name="empl_search" class="btn btn-success btn-block" value="search">
                          
						   <!-- <input type="submit" class="ref_page btn btn-info btn-block" value="Reset"> -->
                                <!-- <a href="#" class="btn btn-success btn-block"> Search </a>  -->
                           </div>  
                           </form>   
                    </div>

								<div class="row">
						<div class="col-md-12">
							<div class="table-responsive">
					
							
								<table class="table table-striped custom-table datatable">
								<thead>
								<tr>
							<th colspan="4"><p style="margin-top:10px;"><?php echo $olddate ;?>	</p></th>
								<th colspan="4"><h4 style="margin-top:10px;">Daily Dispatch Report </h4></th>
                                <th colspan="3">
                                <button  type="submit" id="submitbtn" onclick="addBlankDispatch()" name="changstatusall" class="btn btn-sm btn-info pull-right">Prefatch Employees</button>
								<th colspan="4"> <form class="emplyoee_info" method="post" action="" >
                                <!-- <input type="hidden" name="dispatch_id" value="<?php echo $rowemp['id']; ?>"> -->

                                <button  type="submit" id="submitbtn" name="changstatusall" class="btn btn-sm btn-info pull-right">Dispatch All</button>
                                
                                </form></th>
								
							<tr>
								</thead>
									<thead>
										<tr>
											<th>Employee</th>
											<th>Start Time</th>
											<th>Job Site</th>
											<th>Equipment</th>
											<th>Scope of Work</th>
											<th>Special Requirements</th>
											<th>Trucks</th>
											<th>Material</th>
											<th>Quantity</th>
											<th>Status</th>
											<th>Dispatch</th>
                                            <th>Action</th>
											<!-- <th class="text-right">Action</th> -->
										</tr>
									</thead>
								<tbody>


                                <?php

$where_condition = "dispatch_date = CURDATE()";

if(isset($_POST['empl_search'])){
    $get_date= $_POST['findbydate'];
    $where_condition = "dispatch_date = '$get_date'";     
}

                                $log_user_qury = "select dl.*, e.first_name, p.Project_name, m.machine_name,i.materials_name,p.Project_name from dispatch_log dl
                                inner join employee e on dl.emp_id = e.empl_id  
                                left join machine m on dl.equipment_id = m.machine_id
                                left join material i on dl.material_id = i.id
                                left join Project p on dl.Project_id = p.Project_id
                                where ".$where_condition." order by dl.Project_id desc";

                                $res_data = mysqli_query($con, $log_user_qury);
                                ?>						
                                <?php	if ($res_data->num_rows > 0) {
                                while ($rowemp = $res_data->fetch_assoc()) {
                                ?>

                                <tr>
								<td><?php echo $rowemp['first_name']; ?></td>
								<td><?php echo $rowemp['start_time']; ?></td>
								<td><?php echo $rowemp['Project_name']; ?></td>
								<td><?php echo $rowemp['machine_name']; ?></td>
								<td><?php echo $rowemp['scope_work']; ?></td>
								<td><?php echo $rowemp['special_req']; ?></td>
								<td><?php echo $rowemp['trucks']; ?></td>
								<td><?php echo $rowemp['materials_name']; ?></td>
								<td><?php echo $rowemp['quantity']; ?></td>
								<td><?php echo $rowemp['status']; ?></td>
								<td>
                                
                                <?php if($rowemp['status'] == 'New') {

                                ?>

                                <form  class="emplyoee_info" method="post" action="" >
                                <input type="hidden" name="dispatch_id" value="<?php echo $rowemp['id']; ?>">

                                <button onclick="sendnotification(<?php echo $rowemp['emp_id']; ?> , <?php echo $rowemp['dispatch_date']; ?>)"  type="submit" id="submitbtn<?php echo $rowemp['id']; ?>" name="changstatus" class="btn btn-sm btn-info pull-right">Dispatch </button>
                                
                                </form>
                                <?php } else { ?>

                                    <button disabled style="opacity:0.5;background-color:#999;border:1px solid #999"  type="submit" id="submitbtn<?php echo $rowemp['id']; ?>" name="changstatus" class="btn btn-sm btn-info pull-right">Dispatched </button>
                               
                                <?php  } ?>

                                </td>
								<td>
                                <div class="pull-right">
                                                           
                                                                <span data-toggle="modal" data-target="#edit_employee<?php echo $rowemp['id']; ?>" class="text-center" >
                                                                    <i style="margin-top:5px;font-size:18px;margin-right:10px;cursor: pointer;float:left" class="fa fa-edit text-success"></i>
                                                                </span>
                                                                <span style="margin-bottom:10px;" class="text-center "  data-toggle="modal" data-target="#delete_employee<?php echo $rowemp['id']; ?>">
                                                                    <i style="margin-top:5px;font-size:18px;margin-right:10px;cursor: pointer;" class="fa fa-trash text-danger"></i>
                                                                </span>
                                                            </div>

                                </td>
                                </tr>
                        <?php 
                            }}
                            ?>

								</tbody>
								</table>
						
						</div>
						</div>
					</div>

								</div>
								</div>


<!--Add Dispatch Report Modal-->


				<div id="add_employee" class="modal custom-modal fade" role="dialog">
                <div class="modal-dialog">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <div class="modal-content modal-lg">
                        <div class="modal-header">
                            <h4 class="modal-title">Add Dispatch Report   
                            <!-- <a href="" class="avatar">
												  <?php 
                                     $imgurl  = $row['img'];
												if($row['img'] == "")
													$imgurl  = "https://cdn4.vectorstock.com/i/1000x1000/12/13/construction-worker-icon-person-profile-avatar-vector-15541213.jpg";

													?> 


												<img id="add_emp" src="<?php echo $row['img'] ?>"  /> 

												</a></h4> -->
                        </div>
                        <div class="modal-body">
                        <form id="addclientform" name="add-employee" class="emplyoee_info" method="post" action="" enctype="multipart/form-data">
                            <form class="m-b-30">
                                <div class="row">
                                <!-- <div class="col-sm-12">
									<img id="loader_img_add" style="display:none"  src="https://loading.io/spinners/ellipsis/lg.discuss-ellipsis-preloader.gif" width="50">  
                               
                                         <input accept="image/jpg,image/svg,image/jpeg, image/png" type="file" value="Upload Image" id="empic">
                                        <input type="hidden" value="https://cdn4.vectorstock.com/i/1000x1000/12/13/construction-worker-icon-person-profile-avatar-vector-15541213.jpg" name="empfile" id="empfile">
                                  </div> -->
                                    <div class="col-sm-6" >
                                    <label class="control-label">Select Employee  <span class="text-danger">*</span></label>
                                   
                    <select class="select_pro form-control" id="emp_id" name="emp_id" >
                    
										<option value="">Select Employee</option>				
										<?php
					$selectemp = mysqli_query($con, "SELECT empl_id,first_name from employee");
					if(mysqli_num_rows($selectemp) > 0){
					while($res_selectemp = $selectemp->fetch_assoc()) {					
					?>
												<option value="<?php echo $res_selectemp['empl_id']; ?>"><?php echo $res_selectemp['first_name']; ?></option>
										<?php } }?>
									</select>

                                    
                   
                                    </div>
                                    <div class="col-sm-6" >
                                        <div class="form-group">
                                            <label class="control-label">Start Time  <span class="text-danger">*</span></label>
                                            <input class="form-control" type="time" name="start_time">
                                        </div>
                                    </div>
                                    <div class="col-sm-6" >
                                    <div class="form-group">
                                    <label class="control-label">Select Project  <span class="text-danger">*</span></label>
                    <select class="select_pro form-control" id="equipment" name="project_id" >
										<option value="">Select Project</option>				
										<?php
					$selectpro = mysqli_query($con, "SELECT Project_id,Project_name from Project");
					if(mysqli_num_rows($selectpro) > 0){
					while($res_selectemppro = $selectpro->fetch_assoc()) {					
					?>
												<option value="<?php echo $res_selectemppro['Project_id']; ?>"><?php echo $res_selectemppro['Project_name']; ?></option>
										<?php } }?>
									</select>
                                    </div>
                                    </div>

                                    
                                    <div class="col-sm-6">  
                                        <div class="form-group">
                                            <label class="control-label">Scope Of Work<span class="text-danger">*</span></label>
                                            <input class="form-control" type="text" name="scope_work">
                                            <!-- <div class="cal-icon"><input class="form-control datetimepicker" type="text" name="scope"></div> -->
                                        </div>
                                    </div>

                                    <div class="col-sm-6" >
                                    <div class="form-group">
                                    <label class="control-label">Select Equipment</label>
                    <select class="select_pro form-control" id="equipment" name="equipment_id" >
										<option value="">Select Equipment</option>				
										<?php
					$selectemp = mysqli_query($con, "SELECT machine_id,machine_name from machine");
					if(mysqli_num_rows($selectemp) > 0){
					while($res_selectemp = $selectemp->fetch_assoc()) {					
					?>
												<option value="<?php echo $res_selectemp['machine_id']; ?>"><?php echo $res_selectemp['machine_name']; ?></option>
										<?php } }?>
									</select>
                                    </div>
                                    </div>
                                    <div class="col-sm-6" >
                                        <div class="form-group">
                                            <label class="control-label">Special Requirements </label>
                                            <input class="form-control" type="text" name="special_req">
                                        </div>
                                    </div>
                                   
                                    <div class="col-sm-6" >
                                        <div class="form-group">
                                            <label class="control-label">Trucks</label>
                                            <input class="form-control" type="text" name="trucks">
                                        </div>
                                    </div>

                                    <div class="col-sm-6" >
                                    <div class="form-group">
                                    <label class="control-label">Select Material</label>
                    <select class="select_pro form-control" id="emp_id" name="material_id" >
										<option value="">Select Material</option>				
										<?php
					$selectemp = mysqli_query($con, "SELECT id,materials_name from material");
					if(mysqli_num_rows($selectemp) > 0){
					while($res_selectemp = $selectemp->fetch_assoc()) {					
					?>
												<option value="<?php echo $res_selectemp['id']; ?>"><?php echo $res_selectemp['materials_name']; ?></option>
										<?php } }?>
									</select>
                                    </div>
                                    </div>

                                    <div class="col-sm-6" >
                                        <div class="form-group">
                                            <label class="control-label">Quantity </label>
                                            <input class="form-control" type="number" name="quantity">
                                        </div>
                                    </div>

                                    <!-- <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="control-label">Status </label>
                                            <select class="select_pro form-control" name="status">
                                            <option value="new">New</option>
                                            <option value="complete">Complete</option>
                                            </select>
                                        </div>
                                    </div> -->
                                </div>
                               
                               
                                <div class="m-t-20 text-center">
                                    <button id="emply_id" type="submit" name="create_report" class="btn btn-primary">Create Report</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            






<!--Edit Dispatch Report Modal-->
<?php
    // $sel_query = "Select * from dispatch_log";
 $sel_query = "select dl.*, e.first_name, p.Project_name, m.machine_name,i.materials_name,p.Project_name 
 from dispatch_log dl
                             inner join employee e on dl.emp_id = e.empl_id  
                             left join machine m on dl.equipment_id = m.machine_id
                             left join material i on dl.material_id = i.id
                             left join Project p on dl.Project_id = p.Project_id";

$res_data = mysqli_query($con,$sel_query);	
while($rowData = mysqli_fetch_assoc($res_data)){ 
?>
<div id="edit_employee<?php echo $rowData['id']; ?>" class="modal custom-modal fade" role="dialog">
                <div class="modal-dialog">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <div class="modal-content modal-lg">
                        <div class="modal-header">
                            <h4 class="modal-title">Edit Dispatch Report   
                            <!-- <a href="" class="avatar">
												  <?php 
                                     $imgurl  = $row['img'];
												if($row['img'] == "")
													$imgurl  = "https://cdn4.vectorstock.com/i/1000x1000/12/13/construction-worker-icon-person-profile-avatar-vector-15541213.jpg";

													?> 


												<img id="add_emp" src="<?php echo $row['img'] ?>"  /> 

												</a></h4> -->
                        </div>
                        <div class="modal-body">
                        <form id="editclientform" name="edit-employee" class="emplyoee_info" method="post" action="" enctype="multipart/form-data">
                            <form class="m-b-30">
                                <div class="row">
                                <!-- <div class="col-sm-12">
									<img id="loader_img_add" style="display:none"  src="https://loading.io/spinners/ellipsis/lg.discuss-ellipsis-preloader.gif" width="50">  
                               
                                         <input accept="image/jpg,image/svg,image/jpeg, image/png" type="file" value="Upload Image" id="empic">
                                        <input type="hidden" value="https://cdn4.vectorstock.com/i/1000x1000/12/13/construction-worker-icon-person-profile-avatar-vector-15541213.jpg" name="empfile" id="empfile">
                                  </div> -->
                                    <div class="col-sm-6">
                                    <label class="control-label">Select Employee</label>
                    <select class="select_pro form-control" id="emp_id" name="emp_id">
										<option value="<?php echo $rowData['emp_id']; ?>"><?php echo $rowData['first_name'] ; ?></option>				
										<?php
					$selectemp = mysqli_query($con, "SELECT empl_id,first_name from employee");
					if(mysqli_num_rows($selectemp) > 0){
					while($res_selectemp = $selectemp->fetch_assoc()) {					
					?>
												<option value="<?php echo $res_selectemp['empl_id']; ?>"><?php echo $res_selectemp['first_name']; ?></option>
										<?php } }?>
									</select>

                                    
                   
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="control-label">Start Time</label>
                                            <input value="<?php echo $rowData['start_time'] ?>" class="form-control" type="time" name="start_time">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                    <div class="form-group">
                                    <label class="control-label">Select Project</label>
                    <select class="select_pro form-control" id="equipment" name="project_id" >
                    <option value="<?php echo $rowData['Project_id']; ?>"><?php echo $rowData['Project_name'] ; ?></option>				
										<?php
					$selectpro = mysqli_query($con, "SELECT Project_id,Project_name from Project");
					if(mysqli_num_rows($selectpro) > 0){
					while($res_selectemppro = $selectpro->fetch_assoc()) {					
					?>
												<option value="<?php echo $res_selectemppro['Project_id']; ?>"><?php echo $res_selectemppro['Project_name']; ?></option>
										<?php } }?>
									</select>
                                    </div>
                                    </div>

                                    <div class="col-sm-6">
                                    <div class="form-group">
                                    <label class="control-label">Select Equipment</label>
                    <select class="select_pro form-control" id="equipment" name="equipment_id" >
                    <option value="<?php echo $rowData['equipment_id']; ?>"><?php echo $rowData['machine_name'] ; ?></option>				
										<?php
					$selectemp = mysqli_query($con, "SELECT machine_id,machine_name from machine");
					if(mysqli_num_rows($selectemp) > 0){
					while($res_selectemp = $selectemp->fetch_assoc()) {					
					?>
												<option value="<?php echo $res_selectemp['machine_id']; ?>"><?php echo $res_selectemp['machine_name']; ?></option>
										<?php } }?>
									</select>
                                    </div>
                                    </div>
                                    <div class="col-sm-6">  
                                        <div class="form-group">
                                            <label class="control-label">Scope Of Work<span class="text-danger">*</span></label>
                                            <input value="<?php echo $rowData['scope_work'] ?>" class="form-control" type="text" name="scope_work">
                                            <!-- <div class="cal-icon"><input class="form-control datetimepicker" type="text" name="scope"></div> -->
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="control-label">Special Requirements </label>
                                            <input class="form-control" value="<?php echo $rowData['special_req'] ?>" type="text" name="special_req">
                                        </div>
                                    </div>
                                   
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="control-label">Trucks</label>
                                            <input class="form-control" value="<?php echo $rowData['trucks'] ?>" type="text" name="trucks">
                                        </div>
                                    </div>

                                    <div class="col-sm-6">
                                    <div class="form-group">
                                    <label class="control-label">Select Material</label>
                    <select class="select_pro form-control" id="emp_id" name="material_id" >
                    <option value="<?php echo $rowData['material_id']; ?>"><?php echo $rowData['materials_name'] ; ?></option>					
										<?php
					$selectemp = mysqli_query($con, "SELECT id,materials_name from material");
					if(mysqli_num_rows($selectemp) > 0){
					while($res_selectemp = $selectemp->fetch_assoc()) {					
					?>
												<option value="<?php echo $res_selectemp['id']; ?>"><?php echo $res_selectemp['materials_name']; ?></option>
										<?php } }?>
									</select>
                                    </div>
                                    </div>

                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="control-label">Quantity </label>
                                            <input class="form-control" value="<?php echo $rowData['quantity'] ?>" type="number" name="quantity">
                                        </div>
                                    </div>

                                    <!-- <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="control-label">Status </label>
                                            <select class="select_pro form-control" name="status">
                                            <option value="new">New</option>
                                            <option value="complete">Complete</option>
                                            </select>
                                        </div>
                                    </div> -->
                                </div>
                               
                               
                                <div class="m-t-20 text-center">
                                <input type="hidden" name="dispatch_id" value="<?php echo $rowData['id']; ?>">
                                    <button id="emply_id" type="submit" name="update_report" class="btn btn-primary">Update Report</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <?php } ?>




            <?php 
			
			$sel_query = "Select * from dispatch_log";

$res_data = mysqli_query($con,$sel_query);	
while($rowData = mysqli_fetch_assoc($res_data)){ 
?>
			<div id="delete_employee<?php echo $rowData['id']; ?>" class="modal custom-modal fade" role="dialog">
				<div class="modal-dialog">
					<div class="modal-content modal-md">
						<div class="modal-header">
							<h4 class="modal-title">Delete Dispatch Report</h4>
						</div>
						<form method="POST" action="">
							<div class="modal-body card-box">
								<p>Are you sure want to delete this?</p>
								<div class="m-t-20 text-left">
								
									<a href="#" class="btn btn-default" data-dismiss="modal">Close</a>
									<input type="hidden" name="dispatch_id" value="<?php echo $rowData['id']; ?>">
									<button type="submit" class="btn btn-danger" value="delete" name="delete_employee">Delete</button>
									
									
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
			
			<?php } ?>


<?php
include "footer.php";
?>

<script>

function exporttoexcle(){

    var fileData=[{
        id:1
    }];

// downloadCSV(fileData,{filename:'Dispatch_Report.csv'});

 callapi({ Data : { }, PRCID: 'DOWNLOADDATA' }).then((res) =>{
     downloadCSV(res,{filename:'Dispatch_Report.csv'});
 });

}

function downloadCSV(stockData,args) {
var data, filename, link;
var csv = convertArrayOfObjectsToCSV({
data: stockData
});
if (csv == null) return;

filename = args.filename || 'export.csv';

if (!csv.match(/^data:text\/csv/i)) {
csv = 'data:text/csv;charset=utf-8,' + csv;
}
data = encodeURI(csv);

link = document.createElement('a');
link.setAttribute('href', data);
link.setAttribute('download', filename);
link.click();
}


function convertArrayOfObjectsToCSV(args) {
var result, ctr, keys, columnDelimiter, lineDelimiter, data;

data = args.data || null;
if (data == null || !data.length) {
return null;
}

columnDelimiter = args.columnDelimiter || ',';
lineDelimiter = args.lineDelimiter || '\n';

keys = Object.keys(data[0]);

result = '';
result += keys.join(columnDelimiter);
result += lineDelimiter;

data.forEach(function (item) {
ctr = 0;
keys.forEach(function (key) {
if (ctr > 0) result += columnDelimiter;

result += item[key];
ctr++;
});
result += lineDelimiter;
});

return result;
}

function addBlankDispatch(){
  var finddate=  document.getElementById("finddate").value;
    
    callapi({ Data : { dispatch_date : finddate , dispatch_date1 : finddate }, PRCID: 'ADDBLANKDISPATCHLOG' }).then((res) =>{
							console.log(res);
                            window.location.reload();

    });
}

function sendnotification(empid , disdate){

    var apidata = {
	"Data":{
		"targetId" : empid,
	    "title" : "new notification",
	    "text" : "Report has been dispatch for date ",
	    "image" : "http://157.230.57.197/civilpro/assets/img/logo2.png",
	    "type" : "CHATMESSAGE",
	    "refData" : {
	    "GroupId" : disdate
    }
	},
"Method": "SAVENEWNOTIFICATION",
"PRCID": "Notification"
};

    callsharedapi(apidata).then((res) =>{
							console.log(res);
                            window.location.reload();

    });
}



$(document).ready(function() {
    jQuery("#addclientform").validate({
        rules: {
            emp_id: "required",
            start_time: "required",
            project_id: "required",
            scope_work: "required",
            // phone: {
            //     required: true,
            //     minlength: 10,
            //     maxlength: 11,
            // },
            // companyname: "required",
            // password: {
            //     required: true,
            //     minlength: 6,
            // },
            // confirmpass: {
            //     equalTo: "#pswrd",
            //     minlength: 6,
            // }
        },
        messages: {
            emp_id: "Please choose the Employee",
            start_time: "Please Select Start Time",
            project_id: "Please choose the project",
            scope_work: "Please Enter Your scope of work",
            // phone: {
            //     required: "Please Enter Your Contact Number",
            //     minlength: "Please enter at least 10 characters.",
            //     maxlength: "Please enter no more than 11 characters.",
            // },
            // companyname: "Please Enter Your Company Name",
            // password: {
            //     required: "The Password is Required"

            // }
        }
    });

    jQuery("#editclientform").validate({
        rules: {
           
            scope_work: "required"
            
        },
        messages: {
           
            scope_work: "Please Enter Your scope of work",
           
        }
    });
});


</script>