<?php

include "header.php";
include"sidebar.php";
$user_id =  $_SESSION['user_id'];
if(!isset($_SESSION['user_id'])){
	header('Location: http://$_SERVER[HTTP_HOST]/civilpro');
}
$obj = new  connection();
$con = $obj->connect();
$sel_query = "Select * from Project";
$res_data = mysqli_query($con,$sel_query);	
$num_rows = mysqli_num_rows($res_data);

$cle_query = "Select * from Client";
$client_data = mysqli_query($con,$cle_query);	
$num_rows12 = mysqli_num_rows($client_data);

$machine_query = "Select * from machine";
$machine_data = mysqli_query($con,$machine_query);	
$num_rows13 = mysqli_num_rows($machine_data);

$employee_query = "Select * from employee";
$employee_data = mysqli_query($con,$employee_query);	
$num_rows14 = mysqli_num_rows($employee_data);

if (isset($_POST['delete_id_data'])) {
$id= $_POST['delet_to_id'];				
$del="delete from Client where id= $id ";
$delete=mysqli_query($con,$del);
if($delete==true){
header('Location: dashbord.php');
 }
else{
 echo ('Error:'.mysqli_error);
    }	
}

if(isset($_POST['delete_project'])){
	$project_id = $_POST['project_id'];
	$sql = "DELETE FROM Project where Project_id=$project_id";
	$res_data = mysqli_query($con,$sql);

	if($res_data){ echo "Projects deleted successfully";

		//$redirect_url =  'http://112.196.9.211:8888/civilpro/projects.php'; ?>
		<!-- <script>
	       setTimeout(function(){window.location.href='<?php echo $redirect_url ?>'},3000);
	    </script> -->
	<?php 
		header('Location: http://$_SERVER[HTTP_HOST]/civilpro/dashbord.php');
	}
}

if(isset($_POST['update_project'])){
/* print_r($_POST); */
    $products_id  = $_POST['products_id'];
    $project_name = $_POST['project_name'];
    $client_id = $_POST['client_id1'];
    $start_date = $_POST['start_date'];
    $end_date = $_POST['end_date'];
    $rate = $_POST['rate'];
    $description = mysqli_real_escape_string($con,$_POST['description']);
	//$image = (isset($_FILES['image']['name']) ? $_FILES['image']['name'] : $_POST['hidden_image']);
	
	if(!empty($_FILES['image']['name']) && isset($_FILES['image']['name'])){
		$image = $_FILES['image']['name'];
	}else{
		$image = $_POST['hidden_image'];
	} 
	
	
	$target = "Upload/project/".basename($image);
	//$target_path = $target_path.basename( $_FILES['fileToUpload']['name']); 
	move_uploaded_file($_FILES['image']['tmp_name'], $target);	
  	$sql =  "UPDATE Project SET Project_name='$project_name', Client_id='$client_id',Start_date='$start_date',end_date='$end_date',Rate='$rate',decription='$description',images='$image' WHERE Project_id=$products_id";

/* echo $_POST['hidden_image'];
echo "asd" .$image;
echo $sql;
 die; */
	$res_data = mysqli_query($con, $sql);	
   
	if($res_data){ echo "Records updated successfully";

		//$redirect_url =  'http://112.196.9.211:8888/civilpro/projects.php'; ?>
		<!-- <script>
	       setTimeout(function(){window.location.href='<?php echo $redirect_url ?>'},3000);
	    </script> -->
	<?php 
		header('Location: http://$_SERVER[HTTP_HOST]/civilpro/dashbord.php');
	}
}

if (isset($_POST['updateform'])) {
	$editid  = $_POST['client_edit_id'];
    $firstname = (isset($_POST['firstname']) ? $_POST['firstname'] : "");
	$lastname = (isset($_POST['lastname']) ? $_POST['lastname'] : "");
    $username = (isset($_POST['username']) ? $_POST['username'] : ""); 
    $clientemail = (isset($_POST['clientemail']) ? $_POST['clientemail'] : ""); 
    $clientpass = (isset($_POST['clientpass']) ? $_POST['clientpass'] : ""); 
    $clientid = (isset($_POST['clientid']) ? $_POST['clientid'] : "");
    $clientph = (isset($_POST['clientph']) ? $_POST['clientph'] : ""); 	
    $company = (isset($_POST['company']) ? $_POST['company'] : "");	
	
	$sql ="UPDATE Client SET first_name='$firstname', last_name='$lastname', user_name='$username', email='$clientemail', password='$clientpass', client_id='$clientid', phone_no='$clientph', company='$company' WHERE id=$editid";
	
	$update=mysqli_query($con,$sql);
	if($update == true){
     header('Location: dashbord.php');
              }
    else{
     echo ('Error:'.mysqli_error);
        }	
	}

?>


 <script>
    	
    	/*$(document).ready(function(){

    		alert('<?php // echo $user_id;   ?>');

    	});*/

    </script>

            <div class="page-wrapper">
                <div class="content container-fluid">
					<div class="row desh-r">
						<div class="col-md-6 col-sm-6 col-lg-3">
							<div class="dash-widget clearfix card-box">
								<span class="dash-widget-icon"><i class="fa fa-cubes" aria-hidden="true"></i></span>
								<div class="dash-widget-info">
									<h3><?php echo $num_rows;  ?></h3>
									<span>Projects</span>
								</div>
							</div>
						</div>
						<div class="col-md-6 col-sm-6 col-lg-3">
							<div class="dash-widget clearfix card-box">
								<span class="dash-widget-icon"><i class="fa fa-usd" aria-hidden="true"></i></span>
								<div class="dash-widget-info">
									<h3><?php echo $num_rows12 ;?></h3>
									<span>Clients</span>
								</div>
							</div>
						</div>
						<div class="col-md-6 col-sm-6 col-lg-3">
							<div class="dash-widget clearfix card-box">
								<span class="dash-widget-icon"><i class="fa fa-cogs" aria-hidden="true"></i></span>
								<div class="dash-widget-info">
									<h3><?php echo $num_rows13; ?></h3>
									<span>Machines</span>
								</div>
							</div>
						</div>
						<div class="col-md-6 col-sm-6 col-lg-3">
							<div class="dash-widget clearfix card-box">
								<span class="dash-widget-icon"><i class="fa fa-diamond"></i></span>
								<div class="dash-widget-info">
									<h3>37</h3>
									<span>Tasks</span>
								</div>
							</div>
						</div>
						<div class="col-md-6 col-sm-6 col-lg-3">
							<div class="dash-widget clearfix card-box">
								<span class="dash-widget-icon"><i class="fa fa-user" aria-hidden="true"></i></span>
								<div class="dash-widget-info">
									<h3><?php echo $num_rows14;?></h3>
									<span>Employees</span>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12">
							<div class="row">
								<div class="col-sm-6 text-center">
									<div class="card-box">
										<div id="area-chart" ></div>
									</div>
								</div>
								<div class="col-sm-6 text-center">
									<div class="card-box">
										<div id="line-chart"></div>
									</div>
								</div>
								<div  class="col-md-4 col-sm-12 text-center">
									<div class="card-box">
										<div id="bar-chart" ></div>
									</div>
								</div>
								<div class="col-md-4 col-sm-12 text-center">
									<div class="card-box">
										<div id="stacked" ></div>
									</div>
								</div>
								<div class="col-md-4 col-sm-12 text-center">
									<div class="card-box">
										<div id="pie-chart" >
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12">
							<div class="panel panel-table">
								<div class="panel-heading">
									<h3 class="panel-title">Invoices</h3>
								</div>
								<div class="panel-body">
									<div class="table-responsive">
										<table class="table table-striped custom-table m-b-0">
											<thead>
												<tr>
													<th>Invoice ID</th>
													<th>Client</th>
													<th>Due Date</th>
													<th>Total</th>
													<th>Status</th>
												</tr>
											</thead>
											<tbody>
												<tr>
													<td><a href="invoice-view.html">#INV-0001</a></td>
													<td>
														<h2><a href="#">Hazel Nutt</a></h2>
													</td>
													<td>8 Aug 2017</td>
													<td>$380</td>
													<td>
														<span class="label label-warning-border">Partially Paid</span>
													</td>
												</tr>
												<tr>
													<td><a href="invoice-view.html">#INV-0002</a></td>
													<td>
														<h2><a href="#">Paige Turner</a></h2>
													</td>
													<td>17 Sep 2017</td>
													<td>$500</td>
													<td>
														<span class="label label-success-border">Paid</span>
													</td>
												</tr>
												<tr>
													<td><a href="invoice-view.html">#INV-0003</a></td>
													<td>
														<h2><a href="#">Ben Dover</a></h2>
													</td>
													<td>30 Nov 2017</td>
													<td>$60</td>
													<td>
														<span class="label label-danger-border">Unpaid</span>
													</td>
												</tr>
											</tbody>
										</table>
									</div>
								</div>
								<div class="panel-footer">
									<a href="invoices.html" class="text-primary">View all invoices</a>
								</div>
							</div>
						</div>
						</div>
						<div class="row">
						<div class="col-md-12">
							<div class="panel panel-table">
								<div class="panel-heading">
									<h3 class="panel-title">Payments</h3>
								</div>
								<div class="panel-body">
									<div class="table-responsive">	
										<table class="table table-striped custom-table m-b-0">
											<thead>
												<tr>
													<th>Invoice ID</th>
													<th>Client</th>
													<th>Payment Type</th>
													<th>Paid Date</th>
													<th>Paid Amount</th>
												</tr>
											</thead>
											<tbody>
												<tr>
													<td><a href="invoice-view.html">#INV-0004</a></td>
													<td>
														<h2><a href="#">Barry Cuda</a></h2>
													</td>
													<td>Paypal</td>
													<td>11 Jun 2017</td>
													<td>$380</td>
												</tr>
												<tr>
													<td><a href="invoice-view.html">#INV-0005</a></td>
													<td>
														<h2><a href="#">Tressa Wexler</a></h2>
													</td>
													<td>Paypal</td>
													<td>21 Jul 2017</td>
													<td>$500</td>
												</tr>
												<tr>
													<td><a href="invoice-view.html">#INV-0006</a></td>
													<td>
														<h2><a href="#">Ruby Bartlett</a></h2>
													</td>
													<td>Paypal</td>
													<td>28 Aug 2017</td>
													<td>$60</td>
												</tr>
												<tr>
													<td><a href="invoice-view.html">#INV-0006</a></td>
													<td>
														<h2><a href="#">Ruby Bartlett</a></h2>
													</td>
													<td>Paypal</td>
													<td>28 Aug 2017</td>
													<td>$60</td>
												</tr>
											</tbody>
										</table>
									</div>
								</div>
								<div class="panel-footer">
									<a href="payments.html" class="text-primary">View all payments</a>
								</div>
							</div>
						</div>
						<!-- <div class="col-md-6">
						  <div class="card-box text-center">
										<div id="pie-chart1" ><svg height="250" version="1.1" width="311" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" style="overflow: hidden; position: relative;"><desc style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">Created with Raphaël 2.1.2</desc><defs style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></defs><path fill="none" stroke="#0b62a4" d="M155.5,205.83333333333331A78.33333333333333,78.33333333333333,0,0,0,230.3045564620845,104.25372194044982" stroke-width="2" opacity="0" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); opacity: 0;"></path><path fill="#0b62a4" stroke="#ffffff" d="M155.5,208.83333333333331A81.33333333333333,81.33333333333333,0,0,0,233.16941181595155,103.36343895093513L262.932075770015,94.11438789319921A112.5,112.5,0,0,1,155.5,240Z" stroke-width="3" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></path><path fill="none" stroke="#3980b5" d="M230.3045564620845,104.25372194044982A78.33333333333333,78.33333333333333,0,0,0,178.76390282248855,52.700922889537466" stroke-width="2" opacity="0" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); opacity: 0;"></path><path fill="#3980b5" stroke="#ffffff" d="M233.16941181595155,103.36343895093513A81.33333333333333,81.33333333333333,0,0,0,179.65486080292428,49.836277383179336L188.91092426633995,20.07579351156977A112.5,112.5,0,0,1,262.932075770015,94.11438789319921Z" stroke-width="3" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></path><path fill="none" stroke="#679dc6" d="M178.76390282248855,52.700922889537466A78.33333333333333,78.33333333333333,0,0,0,107.04672167806044,189.0499060191628" stroke-width="2" opacity="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); opacity: 1;"></path><path fill="#679dc6" stroke="#ffffff" d="M179.65486080292428,49.836277383179336A81.33333333333333,81.33333333333333,0,0,0,105.19106421041168,191.40713646244987L82.82008251709064,219.82485902874419A117.5,117.5,0,0,1,190.39585423373282,15.301384334306192Z" stroke-width="3" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></path><path fill="none" stroke="#95bbd7" d="M107.04672167806044,189.0499060191628A78.33333333333333,78.33333333333333,0,0,0,155.47539085795168,205.8333294677383" stroke-width="2" opacity="0" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); opacity: 0;"></path><path fill="#95bbd7" stroke="#ffffff" d="M105.19106421041168,191.40713646244987A81.33333333333333,81.33333333333333,0,0,0,155.4744483801711,208.83332931969426L155.4646570832285,239.9999944483476A112.5,112.5,0,0,1,85.91284496317189,215.89614162326572Z" stroke-width="3" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></path><text x="155.5" y="117.5" text-anchor="middle" font-family="&quot;Arial&quot;" font-size="15px" stroke="none" fill="#000000" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); text-anchor: middle; font-family: Arial; font-size: 15px; font-weight: 800;" font-weight="800" transform="matrix(1.7803,0,0,1.7803,-121.3249,-100.2689)" stroke-width="0.5617021276595745"><tspan dy="6" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">Projects</tspan></text><text x="155.5" y="137.5" text-anchor="middle" font-family="&quot;Arial&quot;" font-size="14px" stroke="none" fill="#000000" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); text-anchor: middle; font-family: Arial; font-size: 14px;" transform="matrix(1.6319,0,0,1.6319,-98.3266,-81.8368)" stroke-width="0.6127659574468085"><tspan dy="5" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">45</tspan></text></svg></div>
						  </div>
						</div> -->  
					</div>
					<div class="row">
						<div class="col-md-6">
							<div class="panel panel-table">
								<div class="panel-heading">
									<h3 class="panel-title">Clients</h3>
								</div>
								<?php 
									$all_clients = "SELECT * FROM Client ORDER BY id DESC";
									$all_client = mysqli_query($con,$all_clients);
								?>
								<div class="panel-body">
									<div class="table-responsive">
										<table class="table table-striped custom-table m-b-0">
											<thead>
												<tr>
													<th style="min-width:200px;">Name</th>
													<th>Email</th>
													<th>Status</th>
													<th class="text-right">Action</th>
												</tr>
											</thead>
											<tbody>

											<?php	
											 if($all_client ->num_rows > 0){
												while($all_client_rows = mysqli_fetch_object($all_client)){ 

													/*echo "<pre>";
													print_r($all_client_rows);
													echo "</pre>";*/
												 ?>

													<tr>
													<td style="min-width:200px;">
														<a href="javascript:void(0);" class="avatar">B</a>
														<h2><a href="client-profile.php?id=<?php echo $all_client_rows->id;?>"><?php echo $all_client_rows->first_name." ".$all_client_rows->last_name ?> <span>CEO</span></a></h2>
													</td>
													<td><?php echo $all_client_rows->email; ?></td>
													<td>
														<div class="dropdown action-label">
															<!-- <a class="btn btn-white btn-sm rounded dropdown-toggle" href="#" data-toggle="dropdown" aria-expanded="false"> -->
															<a class="btn btn-white btn-sm rounded dropdown-toggle"><i class="fa fa-dot-circle-o text-success"></i> Active <i class="caret"></i>
															</a>
															<ul class="dropdown-menu pull-right">
																<li><a href="#"><i class="fa fa-dot-circle-o text-success"></i> Active</a></li>
																<li><a href="#"><i class="fa fa-dot-circle-o text-danger"></i> Inactive</a></li>
															</ul>
														</div>
													</td>
													<td class="text-right">
														<div class="dropdown">
															<a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
															<ul class="dropdown-menu pull-right">
																<!-- <li><a href="#" title="Edit"><i class="fa fa-pencil m-r-5"></i> Edit</a></li> -->
																<!-- <li><a href="#" data-toggle="modal" data-target="#edit_client" data-id="<?php echo $all_client_rows->id;?>" class="client_edit"><i class="fa fa-pencil m-r-5"></i> Edit</a></li> -->
																<li><a href="#" class="client_edit" data-edit="<?php echo $all_client_rows->id;?>"data-firstname="<?php echo $all_client_rows->first_name; ?>" data-lastname="<?php echo $all_client_rows->last_name; ?>" data-username="<?php echo $all_client_rows->user_name; ?>" data-email="<?php echo $all_client_rows->email; ?>" data-password="<?php echo $all_client_rows->password; ?>" data-clientid="<?php echo $all_client_rows->client_id; ?>" data-ph="<?php echo $all_client_rows->phone_no; ?>" data-company="<?php echo $all_client_rows->company; ?>"><i class="fa fa-pencil m-r-5"></i> Edit</a></li>


																<li><a href="#" data-toggle="modal" data-target="#delete_client<?php echo $all_client_rows->id;?>"><i class="fa fa-trash-o m-r-5"></i> Delete</a></li>
															</ul>
														</div>
													</td>
												</tr>
												<div id="delete_client<?php echo $all_client_rows->id;?>" class="modal custom-modal fade" role="dialog">
													<div class="modal-dialog">
											<div class="modal-content modal-md">
												<div class="modal-header">
													<h4 class="modal-title">Delete Employee</h4>
												</div>
												<form action="" method="post">
													<div class="modal-body card-box">
														<p>Are you sure want to delete this?</p>
														<input type="hidden" name="delet_to_id" value="<?php echo $all_client_rows->id;?>">
														<div class="m-t-20"> <a href="#" class="btn btn-default" data-dismiss="modal">Close</a>
															<button type="submit" name="delete_id_data" class="btn btn-danger">Delete</button>
														</div>
													</div>
												</form>
													</div>
												</div>
											</div>													
											<?php	}
												}
											?>										
											</tbody>
										</table>
									</div>
								</div>
								<div class="panel-footer">
									<a href="clients.php" class="text-primary">View all clients</a>
								</div>
							</div>
						</div>
						<div id="edit_client" class="modal custom-modal fade" role="dialog">
				<div class="modal-dialog">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<div class="modal-content modal-lg">
						<div class="modal-header">
							<h4 class="modal-title">Edit Client</h4>
						</div>
						<div class="modal-body">
							<div class="m-b-30">
								<form name="edit-client" id="editclientform" method="post">
									<div class="row">
										<div class="col-md-6">
											<div class="form-group">
												<label class="control-label">First Name <span class="text-danger">*</span></label>
												<input name="firstname" class="form-control" id="first_name" type="text">
												
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<label class="control-label">Last Name</label>
												<input name="lastname" class="form-control" id="last_name" type="text">
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<label class="control-label">Username <span class="text-danger">*</span></label>
												<input name="username" class="form-control" id="user_name" type="text">
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<label class="control-label">Email <span class="text-danger">*</span></label>
												<input name="clientemail" class="form-control floating" id="clientemail" type="email">
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<label class="control-label">Password</label>
												<input name="clientpass" class="form-control" id="clientpassword" type="password">
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<label class="control-label">Confirm Password</label>
												<input name="conpass" class="form-control" id="clientconpassword" type="password">
											</div>
										</div>
										<div class="col-md-6">  
											<div class="form-group">
												<label class="control-label">Client ID <span class="text-danger">*</span></label>
												<input name="clientid" class="form-control floating" id="client-id" type="text">
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<label class="control-label">Phone </label>
												<input name="clientph" class="form-control" id="clientph" type="text">
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<label class="control-label">Company Name</label>
												<input name="company" class="form-control" type="text" id="companyname">
											</div>
										</div>
									</div>
									<div class="table-responsive m-t-15">
										<table class="table table-striped custom-table">
											<thead>
												<tr>
													<th>Module Permission</th>
													<th class="text-center">Read</th>
													<th class="text-center">Write</th>
													<th class="text-center">Create</th>
													<th class="text-center">Delete</th>
													<th class="text-center">Import</th>
													<th class="text-center">Export</th>
												</tr>
											</thead>
											<tbody>
												<tr>
													<td>Projects</td>
													<td class="text-center">
														<input checked="" type="checkbox">
													</td>
													<td class="text-center">
														<input checked="" type="checkbox">
													</td>
													<td class="text-center">
														<input checked="" type="checkbox">
													</td>
													<td class="text-center">
														<input checked="" type="checkbox">
													</td>
													<td class="text-center">
														<input checked="" type="checkbox">
													</td>
													<td class="text-center">
														<input checked="" type="checkbox">
													</td>
												</tr>
												<tr>
													<td>Tasks</td>
													<td class="text-center">
														<input checked="" type="checkbox">
													</td>
													<td class="text-center">
														<input checked="" type="checkbox">
													</td>
													<td class="text-center">
														<input checked="" type="checkbox">
													</td>
													<td class="text-center">
														<input checked="" type="checkbox">
													</td>
													<td class="text-center">
														<input checked="" type="checkbox">
													</td>
													<td class="text-center">
														<input checked="" type="checkbox">
													</td>
												</tr>
												<tr>
													<td>Chat</td>
													<td class="text-center">
														<input checked="" type="checkbox">
													</td>
													<td class="text-center">
														<input checked="" type="checkbox">
													</td>
													<td class="text-center">
														<input checked="" type="checkbox">
													</td>
													<td class="text-center">
														<input checked="" type="checkbox">
													</td>
													<td class="text-center">
														<input checked="" type="checkbox">
													</td>
													<td class="text-center">
														<input checked="" type="checkbox">
													</td>
												</tr>
												<tr>
													<td>Estimates</td>
													<td class="text-center">
														<input checked="" type="checkbox">
													</td>
													<td class="text-center">
														<input checked="" type="checkbox">
													</td>
													<td class="text-center">
														<input checked="" type="checkbox">
													</td>
													<td class="text-center">
														<input checked="" type="checkbox">
													</td>
													<td class="text-center">
														<input checked="" type="checkbox">
													</td>
													<td class="text-center">
														<input checked="" type="checkbox">
													</td>
												</tr>
												<tr>
													<td>Invoices</td>
													<td class="text-center">
														<input checked="" type="checkbox">
													</td>
													<td class="text-center">
														<input checked="" type="checkbox">
													</td>
													<td class="text-center">
														<input checked="" type="checkbox">
													</td>
													<td class="text-center">
														<input checked="" type="checkbox">
													</td>
													<td class="text-center">
														<input checked="" type="checkbox">
													</td>
													<td class="text-center">
														<input checked="" type="checkbox">
													</td>
												</tr>
												<tr>
													<td>Timing Sheets</td>
													<td class="text-center">
														<input checked="" type="checkbox">
													</td>
													<td class="text-center">
														<input checked="" type="checkbox">
													</td>
													<td class="text-center">
														<input checked="" type="checkbox">
													</td>
													<td class="text-center">
														<input checked="" type="checkbox">
													</td>
													<td class="text-center">
														<input checked="" type="checkbox">
													</td>
													<td class="text-center">
														<input checked="" type="checkbox">
													</td>
												</tr>
											</tbody>
										</table>
									</div>
									<div class="m-t-20 text-center">
									<input type="hidden" name="client_edit_id" class="client_id" id="client_edit_id"/>
										<button class="savedetail" name="updateform" type="submit" class="btn btn-primary">Edit Client</button>
										 
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
						<div class="col-md-6">
							<div class="panel panel-table">
								<div class="panel-heading">
									<h3 class="panel-title">Recent Projects</h3>
								</div>
								<?php 
									$all_projects = "SELECT * FROM Project ORDER BY Project_id DESC";
									$all_project = mysqli_query($con,$all_projects);
								?>
								<div class="panel-body">
									<div class="table-responsive">
										<table class="table table-striped custom-table m-b-0">
											<thead>
												<tr>
													<th class="col-md-3">Project Name </th>
													<th class="col-md-3">Progress</th>
													<th class="text-right col-md-1">Action</th>
												</tr>
											</thead>
											<tbody>
											<?php	
											 if($all_project ->num_rows > 0){
												while($all_project_rows = mysqli_fetch_object($all_project)){ 

													// echo "<pre>";
													// print_r($all_project_rows);
													// echo "</pre>";
												 ?>
												<tr>
													<td>
														<h2><a href="project-view.php?id=<?php echo $all_project_rows->Project_id;?>""><?php echo $all_project_rows->Project_name; ?></a></h2>
														<!-- <small class="block text-ellipsis">
															<span class="text-xs">1</span> <span class="text-muted">open tasks, </span>
															<span class="text-xs">9</span> <span class="text-muted">tasks completed</span>
														</small> -->
													</td>
													<td>
														<?php 
															$end_date = strtotime($all_project_rows->end_date); 
															$start_date = strtotime($all_project_rows->Start_date);
															$day = $end_date - $start_date;										
															$cuurentdate = date('Y-m-d');
															$totalday = ceil(abs($end_date - $start_date) / 86400);
															if($all_project_rows->end_date <= $cuurentdate){
																$perday = 100;
															}else{
																$perday = round(100/$totalday);
															}
														?>
														<div class="progress progress-xs progress-striped">
															<div class="progress-bar bg-success" role="progressbar" data-toggle="tooltip" title="<?php echo $perday; ?>%" style="width: <?php echo $perday; ?>%"></div>
														</div>
													</td>
													<td class="text-right">
														<div class="dropdown">
															<a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
															<ul class="dropdown-menu pull-right">
																<li><a href="#" data-toggle="modal" data-target="#create_project1" data-id="<?php echo $all_project_rows->Project_id;?>" class="edit"><i class="fa fa-pencil m-r-5"></i> Edit</a></li>

																<!-- <li><a href="#" data-toggle="modal" data-target="#create_project1" data-id="<?php echo $all_project_rows->Project_id;?>" title="Edit" class="Edit"><i class="fa fa-pencil m-r-5"></i> Edit</a></li> -->
																<li><a href="#" data-toggle="modal" data-target="#delete_project<?php echo $all_project_rows->Project_id;?>" data-id="<?php echo $all_project_rows->Project_id; ?>" title="Delete"><i class="fa fa-trash-o m-r-5"></i> Delete</a></li>
															</ul>
														</div>
													</td>
												</tr>
												<div id="delete_project<?php echo $all_project_rows->Project_id;?>" class="modal custom-modal fade" role="dialog">
												<div class="modal-dialog">
													<div class="modal-content modal-md">
														<div class="modal-header">
															<h4 class="modal-title">Delete Project</h4>
														</div>
														<div class="modal-body card-box">
															<p>Are you sure want to delete this?</p>
															<div class="m-t-20"> <form action="" method="POST"><a href="#" class="btn btn-default" data-dismiss="modal">Close</a>
															
																<button type="submit" class="btn btn-danger delete_pro" value="delete" name="delete_project">Delete</button>
																<input type="hidden"  name="project_id" value="<?php echo $all_project_rows->Project_id;?>">
																</form>
															</div>
														</div>
													</div>
												</div>
											</div>
											<?php	}
												}
											?>		
												
											</tbody>
										</table>
									</div>
								</div>
								<div class="panel-footer">
									<a href="projects.php" class="text-primary">View all projects</a>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div id="create_project1" class="modal custom-modal fade" role="dialog">
				<div class="modal-dialog">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<div class="modal-content modal-lg">
						<div class="modal-header">
							<h4 class="modal-title">Edit Project</h4>
						</div>
						
						<div class="modal-body">
							<form action="" method="post" name="editform" enctype="multipart/form-data">
							<input type="hidden" name="products_id" id="products_id">
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label>Project Name</label>
											<input class="form-control" name="project_name" id="edit_project_name" type="text">
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label>Client</label>
											<select  name="client_id1" id="client_id1" class="form-control required">
											<?php
												$sel_query = "Select * from Client";
												$res_data = mysqli_query($con,$sel_query);	
												while($clientdata = mysqli_fetch_assoc($res_data)){
											?>
												<option value="<?php echo $clientdata['id'];?>"><?php echo $clientdata['first_name'] .'&nbsp;&nbsp;'.$clientdata['last_name'];?></option>
												<?php } ?>
											</select>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label>Start Date</label>
											<div class="cal-icon"><input class="form-control datetimepicker" id="edit_start_date" type="text" name="start_date"></div>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label>End Date</label>
											<div class="cal-icon"><input class="form-control datetimepicker" id="edit_end_date" type="text" name="end_date"></div>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-3">
										<div class="form-group">
											<label>Rate</label>
											<input placeholder="$50" class="form-control" id="edit_rate" name="rate" type="text">
										</div>
									</div>
									<div class="col-md-3">
										<div class="form-group">
											<label>&nbsp;</label>
											<select class="select form-control" name="billing_type">
												<option value="Hourly">Hourly</option>
												<option value="Fixed">Fixed</option>
											</select>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label>Priority</label>
											<select class="select form-control" name="Priority">
												<option value="1">High</option>
												<option value="2">Medium</option>
												<option value="3">Low</option>
											</select>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label>Add Project Leader</label>
											<input class="form-control" type="text" id="edit_project_leader">
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label>Team Leader</label>
											<div class="project-members">
												<a href="#" data-toggle="tooltip" title="Jeffery Lalor">
													<img src="assets/img/user.jpg" class="avatar" alt="Jeffery Lalor" height="20" width="20">
												</a>
											</div>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label>Add Team</label>
											<input class="form-control" type="text" id="edit_team">
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label>Team Members</label>
											<div class="project-members">
												<a href="#" data-toggle="tooltip" title="John Doe">
													<img src="assets/img/user.jpg" class="avatar" alt="John Doe" height="20" width="20">
												</a>
												<a href="#" data-toggle="tooltip" title="Richard Miles">
													<img src="assets/img/user.jpg" class="avatar" alt="Richard Miles" height="20" width="20">
												</a>
												<a href="#" data-toggle="tooltip" title="John Smith">
													<img src="assets/img/user.jpg" class="avatar" alt="John Smith" height="20" width="20">
												</a>
												<a href="#" data-toggle="tooltip" title="Mike Litorus">
													<img src="assets/img/user.jpg" class="avatar" alt="Mike Litorus" height="20" width="20">
												</a>
												<span class="all-team">+2</span>
											</div>
										</div>
									</div>
								</div>
								<div class="form-group">
									<label>Description</label>
									<textarea rows="4" cols="5" class="form-control summernote" id="edit_description" placeholder="Enter your message here" name="description"></textarea>
								</div>
								<div class="form-group">
									<label>Upload Files</label>
									<input class="form-control" type="file" name="image">
									<img id="edit_image" height="150" width="150">
									<input type="hidden" name="hidden_image" id="hidden_image">
								</div>
								<div class="m-t-20 text-center">
									<button class="btn btn-primary" name="update_project" value="update">Save Changes</button>
								</div>
							</form>
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
        </div>
		<div class="sidebar-overlay" data-reff="#sidebar"></div>
        <!-- <script type="text/javascript" src="assets/js/jquery-3.2.1.min.js"></script>
        <script type="text/javascript" src="assets/js/bootstrap.min.js"></script>
		<script type="text/javascript" src="assets/js/jquery.slimscroll.js"></script>
		<script type="text/javascript" src="assets/plugins/morris/morris.min.js"></script>
		<script type="text/javascript" src="assets/plugins/raphael/raphael-min.js"></script>
		<script type="text/javascript" src="assets/js/app.js"></script> -->
		<script type="text/javascript" src="assets/js/jquery-3.2.1.min.js"></script>
		<script type="text/javascript" src="assets/js/bootstrap.min.js"></script>
		<script type="text/javascript" src="assets/js/jquery.slimscroll.js"></script>
		<script type="text/javascript" src="assets/js/select2.min.js"></script>
		<script type="text/javascript" src="assets/js/moment.min.js"></script>
		<script type="text/javascript" src="assets/plugins/morris/morris.min.js"></script>
		<script type="text/javascript" src="assets/js/bootstrap-datetimepicker.min.js"></script>
		<script type="text/javascript" src="assets/plugins/raphael/raphael-min.js"></script>
		
		<script type="text/javascript" src="assets/plugins/summernote/dist/summernote.min.js"></script>
		<script src="https://cdn.jsdelivr.net/jquery.validation/1.15.1/jquery.validate.min.js"></script>
		<script type="text/javascript" src="assets/js/typeahead.js"></script>
		<script type="text/javascript" src="assets/js/app.js"></script>
		<script>
				var data = [
			  { y: '2014', a: 50, b: 90},
			  { y: '2015', a: 65,  b: 75},
			  { y: '2016', a: 50,  b: 50},
			  { y: '2017', a: 75,  b: 60},
			  { y: '2018', a: 80,  b: 65},
			  { y: '2019', a: 90,  b: 70},
			  { y: '2020', a: 100, b: 75},
			  { y: '2021', a: 115, b: 75},
			  { y: '2022', a: 120, b: 85},
			  { y: '2023', a: 145, b: 85},
			  { y: '2024', a: 160, b: 95}
			],
			config = {
			  data: data,
			  xkey: 'y',
			  ykeys: ['a', 'b'],
			  labels: ['Total Income', 'Total Outcome'],
			  fillOpacity: 0.6,
			  hideHover: 'auto',
			  behaveLikeLine: true,
			  resize: true,
			  pointFillColors:['#ffffff'],
			  pointStrokeColors: ['black'],
				gridLineColor: '#eef0f2',
			  lineColors:['gray','#00c5fb']
		  };
		config.element = 'area-chart';
		Morris.Area(config);
		config.element = 'line-chart';
		Morris.Line(config);
		config.element = 'bar-chart';
		Morris.Bar(config);
		config.element = 'stacked';
		config.stacked = true;
		Morris.Bar(config);
		Morris.Donut({
		  element: 'pie-chart',
		  data: [
		  	{label: "Employees", value: <?php echo $num_rows14; ?>},
			{label: "Clients", value: <?php echo $num_rows12; ?>},
			{label: "Projects", value: <?php echo $num_rows; ?>},
			{label: "Tasks", value: 10}
		  ]
		});


$(document).ready(function(){
    $(".edit").click(function(){
		var Proid = $(this).attr("data-id");
		Projectid = {project_id : Proid}
	    $.ajax({
	        url: "update_project.php",
	        type: 'POST',
			data: Projectid,
	        dataType: 'json', // added data type
	        success: function(res) {
			    if(res.status= "sucess"){
					$("#products_id").val(res.data.Project_id);
					$("#edit_project_name").val(res.data.Project_name);
					//$("#client_id_name").val(res.data.Client_id);
					$("#edit_start_date").val(res.data.Start_date);
					$("#edit_end_date").val(res.data.end_date);
					$("#edit_rate").val(res.data.Rate);
					$(".note-editable").html(res.data.decription);
					$("#edit_description").val(res.data.decription);
					$("#edit_project_leader").val(res.data.Project_leader);
					$("#edit_team").val(res.data.Team_member);
					$("#select2-Priority-d1-container").text(res.data.new_priority);
					$('#edit_image').attr('src', 'Upload/project/'+res.data.images);
					console.log(res.data.images);
					$("#hidden_image").val(res.data.images);
					$('#client_id1 option[value='+res.data.Client_id+']').attr('selected','selected');
					$("#select2-client_id1-container").text(res.data.client_name);
				}else{
				 alert('fail');
				}           
	     	}
	    });
	}); 

     $(".client_edit ").click(function(){
 		console.log("ok");
 		$('#edit_client').modal('show'); 
	  
	   var id = jQuery(this).attr("data-edit");
	   var firstname = jQuery(this).attr("data-firstname");
	   var lastname = jQuery(this).attr("data-lastname");
	   var username = jQuery(this).attr("data-username");
	   var email = jQuery(this).attr("data-email");
	   var password = jQuery(this).attr("data-password");
	   var conpassword = jQuery(this).attr("data-password");
	   var clientid = jQuery(this).attr("data-clientid");
	   var ph = jQuery(this).attr("data-ph");
	   var company = jQuery(this).attr("data-company");
	   
	  jQuery("#client_edit_id").val(id);
	  jQuery("#first_name").val(firstname);
	  jQuery("#last_name").val(lastname);
	  jQuery("#user_name").val(username);
	  jQuery("#clientemail").val(email);
	  jQuery("#clientpassword").val(password);
	  jQuery("#clientconpassword").val(conpassword);
	  jQuery("#client-id").val(clientid);
	  jQuery("#clientph").val(ph);
	  jQuery("#companyname").val(company);  
     }); 
	
});	
</script>
    </body>
</html>