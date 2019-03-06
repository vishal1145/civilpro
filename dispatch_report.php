<?php
session_start();

include "header.php";
include "sidebar.php";





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
                            <a href="#" class="btn btn-primary rounded pull-right" data-toggle="modal" data-target="#add_employee"><i class="fa fa-plus"></i> Dispatch Log</a>
                            <!-- <div class="view-icons">
                                <a href="employees.php" class="grid-view btn btn-link active"><i class="fa fa-th"></i></a>
                                <a href="employees-list.php" class="list-view btn btn-link"><i class="fa fa-bars"></i></a>
                            </div> -->
                        </div>
                    </div>

										<div class="row filter-row" style="margin-bottom:20px;">
                    <form action="" method="post" name="employee_search" class="ng-pristine ng-valid">
                           <div class="col-sm-3 col-xs-6">  
                                <div class="form-group form-focus">
                                    <!-- <label class="control-label">Select Date</label> -->
                                    <input name="empl_find_id" value="<?php echo date('Y-m-d');?>" type="date" class="form-control floating" id="empl_find_id">
                                </div>
                           </div>
													 <div class="col-sm-3 col-xs-6"> 

													 </div>
													 <div class="col-sm-3 col-xs-6">  
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
                           <input type="submit" name="empl-search" class="btn btn-success btn-block" value="search">
                          
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
							<th colspan="4"><p style="margin-top:10px;"><?php echo date('Y-m-d');?>	</p></th>
								<th colspan="4"><h4 style="margin-top:10px;">Daily Dispatch Report </h4></th>
								<th colspan="4"><button type="buttton" class="btn btn-sm btn-info pull-right">Dispatch All</button></th>
								
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
											<!-- <th class="text-right">Action</th> -->
										</tr>
									</thead>
								<tbody>
								<tr>
								<td>Tom</td>
								<td>7:00</td>
								<td>47-17 (Duffy East contract)</td>
								<td>7:00</td>
								<td>TV380</td>
								<td>slab prep</td>
								<td>7:00</td>
								<td>7:00</td>
								<td>7:00</td>
								<td>7:00</td>
								<td><button type="buttton" class="btn btn-sm btn-info pull-right">Dispatch </button></td>
								</tr>

                                <tr>
								<td>Tom 2</td>
								<td>7:00</td>
								<td>47-17 (Duffy East contract)</td>
								<td>7:00</td>
								<td>TV380</td>
								<td>slab prep</td>
								<td>7:00</td>
								<td>7:00</td>
								<td>7:00</td>
								<td>7:00</td>
								<td><button type="buttton" class="btn btn-sm btn-info pull-right">Dispatch </button></td>
								</tr>

                                <tr>
								<td>Tom 3</td>
								<td>7:00</td>
								<td>47-17 (Duffy East contract)</td>
								<td>7:00</td>
								<td>TV380</td>
								<td>slab prep</td>
								<td>7:00</td>
								<td>7:00</td>
								<td>7:00</td>
								<td>7:00</td>
								<td><button type="buttton" class="btn btn-sm btn-info pull-right">Dispatch </button></td>
								</tr>
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
                        <form name="add-employee" class="emplyoee_info" method="post" action="" enctype="multipart/form-data">
                            <form class="m-b-30">
                                <div class="row">
                                <!-- <div class="col-sm-12">
									<img id="loader_img_add" style="display:none"  src="https://loading.io/spinners/ellipsis/lg.discuss-ellipsis-preloader.gif" width="50">  
                               
                                         <input accept="image/jpg,image/svg,image/jpeg, image/png" type="file" value="Upload Image" id="empic">
                                        <input type="hidden" value="https://cdn4.vectorstock.com/i/1000x1000/12/13/construction-worker-icon-person-profile-avatar-vector-15541213.jpg" name="empfile" id="empfile">
                                  </div> -->
                                    <div class="col-sm-6">
                                    <label class="control-label">Select Employee</label>
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
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="control-label">Start Time</label>
                                            <input class="form-control" type="time" name="starttime">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="control-label">Job Site <span class="text-danger">*</span></label>
                                            <input class="form-control" type="text" name="jobsite">
                                        </div>
                                    </div>

                                    <div class="col-sm-6">
                                    <div class="form-group">
                                    <label class="control-label">Select Equipment</label>
                    <select class="select_pro form-control" id="equipment" name="equipment" >
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
                                    <div class="col-sm-6">  
                                        <div class="form-group">
                                            <label class="control-label">Scope Of Work<span class="text-danger">*</span></label>
                                            <input class="form-control" type="text" name="scope">
                                            <!-- <div class="cal-icon"><input class="form-control datetimepicker" type="text" name="scope"></div> -->
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="control-label">Special Requirements </label>
                                            <input class="form-control" type="text" name="spec_req">
                                        </div>
                                    </div>
                                   
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="control-label">Trucks</label>
                                            <input class="form-control" type="text" name="trucks">
                                        </div>
                                    </div>

                                    <div class="col-sm-6">
                                    <div class="form-group">
                                    <label class="control-label">Select Material</label>
                    <select class="select_pro form-control" id="emp_id" name="emp_id" >
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

                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="control-label">Quantity </label>
                                            <input class="form-control" type="text" name="quantity">
                                        </div>
                                    </div>

                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="control-label">Status </label>
                                            <select class="select_pro form-control">
                                            <option>New</option>
                                            <option>Complete</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                               
                               
                                <div class="m-t-20 text-center">
                                    <button id="emply_id" type="submit" name="create_employe" class="btn btn-primary">Create Report</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

<?php
include "footer.php";
?>