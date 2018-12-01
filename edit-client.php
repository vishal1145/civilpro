<?php
$objj = new  connection();
$conn = $objj->connect();
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
	
	$update=mysqli_query($conn,$sql);
						if($update== true){
	                     header('Location: clients.php');
                                  }
                        else{
	                     echo ('Error:'.mysqli_error);
                            }	
						}?>

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