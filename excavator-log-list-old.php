<?php
include('header.php');
include('sidebar.php');

$obj = new connection();
$con = $obj->connect();


echo "hello";
?>


							

<div class="main-wrapper">
            <div class="page-wrapper">
                <div class="content container-fluid">
					<div class="row">
						<div class="col-xs-4">
							<h4 class="page-title">Excavator daily log list</h4>
						</div>


					</div>

					
								<!--<option value="<?php echo $data_value['designation_id']; ?>"><?php echo $data_value['designation_name']; ?></option>-->

								
					
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
											<!-- <th>Fuel Lavel</th>
											<th>Engine Oil Lavel</th>
											<th>Oil Lavel</th>
											<th>Radiator Lavel</th>
											<th>Transmission Lavel</th>
											<th>Fluids Leaks</th>
											<th>Comments</th>
											<th>Air Conditioning</th>
											<th>Bucket Teeth / Pins</th>
											<th>Cleaning Products</th>
											<th>Damage Report</th>
											<th>Fire Extinguisher</th>
											<th>First Aid Kit</th>
											<th>General Defects</th>
											<th>Grease Lines / Pins</th>
											<th>Hand Rails / Door Handles</th>
											<th>Horn</th>
											<th>Hydraulic Hoses</th>
											<th>Lights</th> -->
										
											<th class="text-right">Action</th>
										</tr>
									</thead>
									<tbody>

								<?php
								$z = 0;
								$get_designation = 'SELECT * FROM excavator ORDER BY excavator_id DESC';
								$result_value = mysqli_query($con,$get_designation);
								while ($data_value = mysqli_fetch_array($result_value)) {		 //echo '<pre>'; print_r($data_value); echo '</pre>';
								$z++;
								?>
							
										<tr>
											<td><?php echo $z;?></td>
											<td><div id="element" class="show-modal"><?php echo $data_value['operator'];$data_value['excavator_id']; ?></div></td>
											<td><div id="element" class="show-modal"><?php echo $data_value['site_area']; ?></div></td>
											<td><?php echo $data_value['hour_start']; ?></td>
											<td><?php echo $data_value['hour_finish']; ?></td>
											<td><?php echo $data_value['date']; ?></td>
											<!-- <td><?php echo $data_value['fuel_lavel']; ?></td>
											<td><?php echo $data_value['engine_oil_lavel']; ?></td>
											<td><?php echo $data_value['oil_lavel']; ?></td>
											<td><?php echo $data_value['radiator_lavel']; ?></td>
											<td><?php echo $data_value['transmission_lavel']; ?></td>
											<td><?php echo $data_value['fluids_leak']; ?></td>
											<td><?php echo $data_value['air_conditioning']; ?></td>
											<td><?php echo $data_value['bucket_teeth_pins']; ?></td>
											<td><?php echo $data_value['cleaning_products']; ?></td>
											<td><?php echo $data_value['damage_report']; ?></td>
											<td><?php echo $data_value['fire_extinguisher']; ?></td>
											<td><?php echo $data_value['first_aid_kit']; ?></td>
											<td><?php echo $data_value['general_defects']; ?></td>
											<td><?php echo $data_value['grease_lines_pins']; ?></td>
											<td><?php echo $data_value['hand_rails_door_handles']; ?></td>
											<td><?php echo $data_value['horn']; ?></td>
											<td><?php echo $data_value['hydraulic_hoses']; ?></td>
											<td><?php echo $data_value['lights']; ?></td>
											<td><?php echo $data_value['mirrors']; ?></td> -->
											<!-- <td>
												<div class="dropdown">
													<a class="btn btn-white btn-sm rounded dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><?php echo $row['designation']; ?><i class="caret"></i></a>
													<!--<ul class="dropdown-menu">
														<li><a href="#"><?php echo $row['designation']; ?></a></li>
														
													</ul>
												</div>
											</td> -->
											<td class="text-right">
												<div class="dropdown">
													<a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
													<ul class="dropdown-menu pull-right">
														<li><a href="#" data-toggle="modal" data-target="#edit_employee<?php echo $row['empl_id']; ?>"><i class="fa fa-pencil m-r-5"></i> Edit</a></li>
														<li><a href="#" data-toggle="modal" data-target="#delete_employee<?php echo $row['empl_id']; ?>"><i class="fa fa-trash-o m-r-5"></i> Delete</a></li>
													</ul>
												</div>
											</td>
										</tr>


			

			<!--  edit data employee   -->




				</div>
			</div>

		



			<!--  edit data employee   -->


										<?php
												}
										?>




		<div id="testmodal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Confirmation</h4>
            </div>
            <div class="modal-body">
                <form action="">
                	<div class="row r-fm">
				      <div class="col-md-6 col-sm-6 col-xs-12 col-cf">
					   <label>Operator:</label>
					   <input type="text" name="operator">
					  </div> 
					  
					  <div class="col-md-6 col-sm-6 col-xs-12 col-cf">
					   <label>Site Area:</label>
					   <input type="text" name="site_area">
					  </div>
					</div>


					<div class="row r-fm2">
				      <div class="col-md-4 col-sm-4 col-xs-12 col-cf1">
					   <label>Hour Start:</label>
					   <input type="text" name="hour_start">
					  </div> 
					  
					  <div class="col-md-4 col-sm-4 col-xs-12 cf2 col-cf1">
					   <label>Hour Finish:</label>
					   <input type="text" name="hour_finish">
					  </div>
					  
					  <div class="col-md-4 col-sm-4 col-xs-12 col-cf3">
					   <label>Date:&nbsp;</label>01/09/2018	  </div>
					</div>


					<div class="row tabl">
					    <div class="col-md-12 col-sm-12 ccr">
							<label>Fuel Lavel:</label><br>
							<label>Engine Oil Lavel:</label><br>
							<label>Oil Lavel:</label>

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
<!-- <div id="testmodal-1" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Confirmation</h4>
            </div>
            <div class="modal-body">
                <p>Do you want to save changes you made to document before closing?</p>
                <p class="text-warning"><small>If you don't save, your changes will be lost.</small></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div> -->
<!-- <div id="element" class="btn btn-default show-modal">show modal</div> -->
<!-- <div class="btn btn-default key-disable">show  modal whith keyboard disabled</div> -->




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

		

		<script type="text/javascript">
				$(document).ready(function(){
					var show_btn=$('.show-modal');
					var show_btn=$('.show-modal');
					//$("#testmodal").modal('show');

				show_btn.click(function(){
					$("#testmodal").modal('show');
					})
					});

				$(function() {
					$('#element').on('click', function( e ) {
						Custombox.open({
						target: '#testmodal-1',
						effect: 'fadein'
						});
						e.preventDefault();
					});
				});
		</script>