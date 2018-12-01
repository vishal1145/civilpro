<?php
include('header.php');
include('sidebar.php');

$obj = new connection();
$con = $obj->connect();


?>


							

<div class="main-wrapper">
            <div class="page-wrapper">
                <div class="content container-fluid">
					<div class="row">
						<div class="col-xs-4">
							<h4 class="page-title">Excavator daily log list</h4>
						</div>


					</div>

					
							<!-- 	<option value="<?php echo $data_value['designation_id']; ?>"><?php echo $data_value['designation_name']; ?></option> -->

								
					
					<div class="row">
						<div class="col-md-12">
							<div class="table-responsive">
								<table class="table table-striped custom-table datatable">
									<thead>
										<tr>
											<th>Id</th>
											<th style="width:30%;">Operator</th>
											<th>Site Area</th>
											<th>Hour Start</th>
											<th>Hour Finish</th>
											<th>Date</th>
											
											
										</tr>
									</thead>
									<tbody>

								<?php
								$z = 0;
								$get_designation = 'SELECT * FROM excavator ORDER BY excavator_id DESC';
								$result_value = mysqli_query($con,$get_designation);
								while ($data_value = mysqli_fetch_array($result_value)) {		
								$z++;
								 
								?>
							
										<tr>
											<td><?php echo $z;?></td>
											<td><div class="excavator_list" data-toggle="modal" data-target="#myModal<?php echo $data_value['excavator_id'];?>"><?php echo ucfirst($data_value['operator']); ?></div>
											  <div class="modal fade" id="myModal<?php echo $data_value['excavator_id'];?>" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
<!--           <button type="button" class="close" data-dismiss="modal">&times;</button>
 -->          <h4 class="modal-title">Excavator daily log list</h4>
        </div>
        <div class="modal-body">
          
          <form action="">
                	<div class="row r-fm">
				      <div class="col-md-4 col-sm-4 col-xs-12 col-cf">
					   <label>Operator:</label>
					   <?php echo ucfirst($data_value['operator']); ?>
					  </div> 
					  
					  <div class="col-md-8 col-sm-8 col-xs-12 col-cf">
					   <label>Site Area:</label>
					   <?php echo ucfirst($data_value['site_area']); ?>
					  </div>
					</div>


					<div class="row r-fm2">
				      <div class="col-md-4 col-sm-4 col-xs-12 col-cf1">
					   <label>Hour Start:</label>
					   <?php echo ucfirst($data_value['hour_start']); ?>
					  </div> 
					  
					  <div class="col-md-4 col-sm-4 col-xs-12 cf2 col-cf1">
					   <label>Hour Finish:</label>
					   <?php echo ucfirst($data_value['hour_finish']); ?>
					  </div>
					  
					  <div class="col-md-4 col-sm-4 col-xs-12 col-cf3">
					   <label>Date:&nbsp;</label> 
					   <?php $date_val = $data_value['date']; 
					    $date_res = explode(" ",$date_val); print_r($date_res[0]);
					   ?>
					    </div>
					</div>


					<div class="row tabl">
					    <div class="col-md-12 col-sm-12 ccr">
					    	<h4>Fluid Levels</h4>
							<div class="row tabl">
					            <div class="col-md-4 col-sm-4">
									<span class="excavator_inner">
									<label>Fuel Lavel: </label><?php echo ucfirst($data_value['fuel_lavel']); ?><br></span>
									<span class="excavator_inner">
									<label>Engine Oil Lavel: </label><?php echo ucfirst($data_value['engine_oil_lavel']); ?><br></span>
								</div>
								<div class="col-md-4 col-sm-4">
									<span class="excavator_inner">
									<label>Oil Lavel: </label><?php echo ucfirst($data_value['oil_lavel']); ?><br></span>
									<span class="excavator_inner">
									<label>Radiator Lavel: </label><?php echo ucfirst($data_value['radiator_lavel']); ?><br></span>
								</div>
								<div class="col-md-4 col-sm-4">
									<span class="excavator_inner">
									<label>Transmission Lavel: </label><?php echo ucfirst($data_value['transmission_lavel']); ?><br></span>
									<span class="excavator_inner">
									<label>Fluids Leaks: </label><?php echo ucfirst($data_value['fluids_leak']); ?><br></span>
								</div>
							</div>
								<div class="row tabl">
									<div class="col-md-12 col-sm-12 span-full">
										<span class="excavator_inner">
										<label>Comments: </label><?php echo ucfirst($data_value['fluid_level_comment']); ?><br></span>
									</div>
                                </div>
                            
							<h4>Inspection List</h4>
							<div class="row tabl">
					            <div class="col-md-4 col-sm-4">
									<span class="excavator_inner">
									<label>Air Conditioning: </label><?php echo ucfirst($data_value['air_conditioning']); ?><br></span>
									<span class="excavator_inner">
									<label>Bucket Teeth / Pins: </label><?php echo ucfirst($data_value['bucket_teeth_pins']); ?><br></span>
									<span class="excavator_inner">
									<label>Cleaning Products: </label><?php echo ucfirst($data_value['cleaning_products']); ?><br></span>
									<span class="excavator_inner">
									<label>Damage Report: </label><?php echo ucfirst($data_value['damage_report']); ?><br></span>
									<span class="excavator_inner">
									<label>Fire Extinguisher: </label><?php echo ucfirst($data_value['fire_extinguisher']); ?><br></span>
									<span class="excavator_inner">
									<label>First Aid Kit: </label><?php echo ucfirst($data_value['first_aid_kit']); ?><br></span>
									<span class="excavator_inner">
									<label>General Defects: </label><?php echo ucfirst($data_value['general_defects']); ?><br></span>
								</div>
								<div class="col-md-4 col-sm-4">
									<span class="excavator_inner">
									<label>Grease Lines / Pins: </label><?php echo ucfirst($data_value['grease_lines_pins']); ?><br></span>
									<span class="excavator_inner">
									<label>Hand Rails / Door Handles: </label><?php echo ucfirst($data_value['hand_rails_door_handles']); ?><br></span>
									<span class="excavator_inner">
									<label>Horn: </label><?php echo ucfirst($data_value['horn']); ?><br></span>
									<span class="excavator_inner">
									<label>Hydraulic Hoses: </label><?php echo ucfirst($data_value['hydraulic_hoses']); ?><br></span>
									<span class="excavator_inner">
									<label>Lights: </label><?php echo ucfirst($data_value['lights']); ?><br></span>
									<span class="excavator_inner">
									<label>Mirrors: </label><?php echo ucfirst($data_value['mirrors']); ?><br></span>
									<span class="excavator_inner">
									<label>Panel Damage: </label><?php echo ucfirst($data_value['panel_damage']); ?><br></span>
								</div>
								<div class="col-md-4 col-sm-4">
									<span class="excavator_inner">
									<label>Radiator: </label><?php echo ucfirst($data_value['radiator']); ?><br></span>
									<span class="excavator_inner">
									<label>Radiator Hoses: </label><?php echo ucfirst($data_value['radiator_hoses']); ?><br></span>
									<span class="excavator_inner">
									<label>Seat / Seat Belts: </label><?php echo ucfirst($data_value['seat_seatbelts']); ?><br></span>
									<span class="excavator_inner">
									<label>Slew Motor Oil: </label><?php echo ucfirst($data_value['slew_motor_oil']); ?><br></span>
									<span class="excavator_inner">
									<label>Tracks / Chains / Shoes: </label><?php echo ucfirst($data_value['tracks_chains_shoes']); ?><br></span>
									<span class="excavator_inner">
									<label>Windows / Wipers: </label><?php echo ucfirst($data_value['windows_wipers']); ?><br></span>
								</div>
							</div>
							    <div class="row tabl">
									<div class="col-md-12 col-sm-12 span-full">
										<span class="excavator_inner">
										<label>Additional Notes: </label><?php echo ucfirst($data_value['additional_notes']); ?><br></span>
									</div>	
								</div>	
                            
						 </div>
				       </div>
                </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>
</td>
											<td><?php echo ucfirst($data_value['site_area']); ?></td>
											<td><?php echo $data_value['hour_start']; ?></td>
											<td><?php echo $data_value['hour_finish']; ?></td>
											<td><?php $date_val = $data_value['date']; 
											 $date_res = explode(" ",$date_val); print_r($date_res[0]);?></td>
											
											
										</tr>


				</div>
			</div>

										<?php
												}
										?>




									</tbody>
								</table>
							</div>
						</div>
					</div>
                </div>
			
			
        </div>
		<div class="sidebar-overlay" data-reff="#sidebar"></div>
        <script type="text/javascript" src="assets/js/jquery-3.2.1.min.js"></script>
        <script type="text/javascript" src="assets/js/bootstrap.min.js"></script>
		<script type="text/javascript" src="assets/js/jquery.dataTables.min.js"></script>
		<script type="text/javascript" src="assets/js/dataTables.bootstrap.min.js"></script>
		<script type="text/javascript" src="assets/js/jquery.slimscroll.js"></script>
		<script type="text/javascript" src="assets/js/select2.min.js"></script>
		<script type="text/javascript" src="assets/js/moment.min.js"></script>
		<script type="text/javascript" src="assets/js/bootstrap-datetimepicker.min.js"></script>
		<script type="text/javascript" src="assets/js/app.js"></script>