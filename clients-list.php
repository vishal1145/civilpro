<?php
session_start();
include "header.php";
include "sidebar.php";
$obj = new  connection();
$con = $obj->connect();

/**------ Add client ------- **/
if(isset ($_POST['addclient']))
{

    $firstname 	= $_POST['firstname'];
    $lastname 	= $_POST['lastname'];
    $username 	= $_POST['username'];
    $emailid 	= $_POST['emailid'];
    $password 	= $_POST['password'];
    $clientid 	= $_POST['clientid'];
    $phone 		= $_POST['phone'];
    $cname 		= $_POST['companyname'];	
    $time_set 	= time();

    $sql = "INSERT INTO client (img,first_name,last_name,user_name,email,password,client_id,phone_no,company,birthday,address,gender,state,country,pincode,time_set) VALUES ('','$firstname','$lastname','$username','$emailid','$password','$clientid','$phone','$cname','','','','','','',$time_set)";
   

    $insert_result = mysqli_query($con,$sql);
    	
    if($insert_result == true)
    {
	header("Location: clients-list.php");
    }
    else
	{
	echo ('Error:'.mysqli_error);
    }	
}  

/**------ Edit client  ------- **/
if (isset($_POST['updateform'])) 
{
	$editid  = $_POST['client_edit_id'];
    $firstname = (isset($_POST['firstname']) ? $_POST['firstname'] : "");
	$lastname = (isset($_POST['lastname']) ? $_POST['lastname'] : "");
    $username = (isset($_POST['username']) ? $_POST['username'] : ""); 
    $clientemail = (isset($_POST['clientemail']) ? $_POST['clientemail'] : ""); 
    $clientpass = (isset($_POST['clientpass']) ? $_POST['clientpass'] : ""); 
    $clientid = (isset($_POST['clientid']) ? $_POST['clientid'] : "");
    $clientph = (isset($_POST['clientph']) ? $_POST['clientph'] : ""); 	
    $company = (isset($_POST['company']) ? $_POST['company'] : "");	
	
	$sql = "UPDATE client SET first_name='$firstname', last_name='$lastname', user_name='$username', email='$clientemail', password='$clientpass', client_id='$clientid', phone_no='$clientph', company='$company' WHERE id=$editid";
	
	$update = mysqli_query($con,$sql);
	
	if($update == true)
	{
	header('Location: clients-list.php');
    }
    else
	{
	echo ('Error:'.mysqli_error);
    }	
} 	
						
/**------ Delete client  ------- **/						
if (isset($_POST['delete_id_data'])) 
{
    $id = $_POST['delet_to_id'];				
    $del ="DELETE FROM client where id= $id ";
    $delete = mysqli_query($con,$del);

    if($delete == true)
    {
    header('Location: clients-list.php');
    }
    else
    {
    echo ('Error:'.mysqli_error);
    }	
}	

/**------ Search client  ------- **/
if(isset($_REQUEST['searchclient']))
{							
    $clientid = $_POST['searchclientid'];
    $clientname = $_POST['searchclientname'];
	$companyname = $_POST['searchcompany'];
	
	$sql_serch =[];	
	
	if(!empty($clientid))
	{		
		$sql_serch[]=" client_id = '$clientid' ";
	}
	if(!empty($clientname))
	{		
		$sql_serch[]=" first_name like '%$clientname%' ";
	}
	if(!empty($companyname))
	{
		$sql_serch[]=" company like '%$companyname%' ";		
	}
	
    $makeQuery = implode("AND",$sql_serch);   
    $result= mysqli_query($con,"SELECT * FROM client WHERE $makeQuery");
 	
}

else
{		
    $result= mysqli_query($con,"SELECT * FROM client ORDER BY `client`.`time_set` DESC");						
}					
?>
<div class="page-wrapper">
                <div class="content container-fluid">
					<div class="row">
						<div class="col-sm-4 col-xs-3">
							<h4 class="page-title">Clients</h4>
						</div>
						<div class="col-sm-8 col-xs-9 text-right m-b-20">
							<a href="#" class="btn btn-primary rounded pull-right" data-toggle="modal" data-target="#add_client"><i class="fa fa-plus"></i> Add Client</a>
							<div class="view-icons">
								<a href="clients.php" class="grid-view btn btn-link"><i class="fa fa-th"></i></a>
								<a href="clients-list.php" class="list-view btn btn-link active"><i class="fa fa-bars"></i></a>
							</div>
						</div>
					</div>	
                  <div class="row filter-row">
					<form method="POST">

						<div class="col-sm-3 col-xs-6">  
							<div class="form-group form-focus">
								<label class="control-label">Client ID</label>
								<input type="text" name="searchclientid" class="form-control floating" />
							</div>
						</div>
						<div class="col-sm-3 col-xs-6">  
							<div class="form-group form-focus">
								<label class="control-label">Client Name</label>
								<input type="text" name="searchclientname" class="form-control floating" />
							</div>
						</div>
						
						<div class="col-sm-3 col-xs-6"> 
							<div class="form-group form-focus select-focus">
								<select name="searchcompany" class="select floating"> 
								 <option value="" disabled selected>Select Company</option>
								<?php 
								$selectcompany="SELECT DISTINCT company FROM Client";
                                 $getcompany = mysqli_query($con,$selectcompany);								
								while($rowcompany = mysqli_fetch_array($getcompany)){ ?>								
									<option value="<?php echo $rowcompany['company']?>"><?php echo $rowcompany['company']?></option>
								<?php } ?>
									
								</select>
							</div>
						</div>					
						<div class="col-sm-3 col-xs-6">  
							<input type="submit" name="searchclient" value="Search" class="btn btn-success btn-block"/>
							<input type="reset" class="ref_page btn btn-info btn-block" value="Reset">
						</div> 
</form>						
                    </div>							
					<div class="row">
						<div class="col-md-12">
							<div class="table-responsive">
								<table class="table table-striped custom-table datatable">
									<thead>
										<tr>
											<th style="display: none;">Time</th>
											<th>Comapny Name</th>
											<th>Client ID</th>
											<th>Contact Person</th>
											<th>Email</th>
											<th>Mobile</th>
											<th>Status</th>
											<th class="text-right">Action</th>
										</tr>
									</thead>									
									<tbody>
									<?php while($row = mysqli_fetch_array($result)){ ?>							
										<tr>
			<?php
			 $time_set = "SELECT * FROM client ORDER BY 'client'. `time_set` DESC";
				$time_setting = mysqli_query($con,$time_set);
				$time_setting_value = mysqli_fetch_array($time_setting);
			?>

											<td style="display: none;"><?php echo $time_setting['time_set']?></td>
											<td>
												<a href="client-profile.php?id=<?php echo $row['id'];?>"><img class="avatar" src="Upload/Client/<?php echo $row['img'];?> " alt=""></a>
												<h2><a href="client-profile.php?id=<?php echo $row['id'];?>"><?php echo $row['company']?></a></h2>
											</td>
											<td><?php echo $row['client_id']?></td>
											<td><?php echo $row['first_name'].' '.$row['last_name']?></td>
											<td><?php echo $row['email']?></td>
											<td><?php echo $row['phone_no']?></td>
											<td>
												<div class="dropdown action-label">
													<a class="btn btn-white btn-sm rounded dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-dot-circle-o text-success"></i> Active <i class="caret"></i></a>
													<ul class="dropdown-menu">
														<li><a href="#"><i class="fa fa-dot-circle-o text-success"></i> Active</a></li>
														<li><a href="#"><i class="fa fa-dot-circle-o text-danger"></i> Inactive</a></li>
													</ul>
												</div>
											</td>
											<td class="text-right">
												<div class="dropdown">
													<a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
													<ul class="dropdown-menu pull-right">
														<li><a href="#" class="edit" data-edit="<?php echo $row['id']?>"data-firstname="<?php echo $row['first_name']?>" data-lastname="<?php echo $row['last_name']?>" data-username="<?php echo $row['user_name']?>" data-email="<?php echo $row['email']?>" data-password="<?php echo $row['password']?>" data-clientid="<?php echo $row['client_id']?>" data-ph="<?php echo $row['phone_no']?>" data-company="<?php echo $row['company']?>"><i class="fa fa-pencil m-r-5"></i> Edit</a></li>
														<li><a href="#" data-toggle="modal" data-target="#delete_client<?php echo $row['id']; ?>"><i class="fa fa-trash-o m-r-5"></i> Delete</a>
														</li>
													</ul>
												</div>
											</td>
										</tr>											
			<div id="delete_client<?php echo $row['id']; ?>" class="modal custom-modal fade" role="dialog">
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
<?php } ?>
</tbody>
								</table>
							</div>
						</div>
					</div>
                </div>
				<?php include "notification-box.php";?>	
            </div>
			<div id="add_client" class="modal custom-modal fade" role="dialog">
				<div class="modal-dialog">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<div class="modal-content modal-lg">
						<div class="modal-header">
							<h4 class="modal-title">Add Client</h4>
						</div>
						<div class="modal-body">
							<div class="m-b-30">
								<form name="add-client" id="addclientform" action="" method="post">
									<div class="row">
										<div class="col-md-6">
											<div class="form-group">
												<label class="control-label">First Name <span class="text-danger">*</span></label>
												<input class="form-control" type="text" name="firstname" id="fname">
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<label class="control-label">Last Name</label>
												<input name="lastname" id="lname" class="form-control" type="text">
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<label class="control-label">Username <span class="text-danger">*</span></label>
												<input name="username" id="uname" class="form-control" type="text">
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<label class="control-label">Email <span class="text-danger">*</span></label>
												<input name="emailid" id="e-id" class="form-control floating" type="email">
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<label class="control-label">Password</label>
												<input name="password" id="pswrd" class="form-control" type="password">
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<label class="control-label">Confirm Password</label>
												<input name="confirmpass" class="form-control" type="password">
											</div>
										</div>
										<div class="col-md-6">  
											<div class="form-group">
												<label class="control-label">Client ID <span class="text-danger">*</span></label>
												<input name="clientid" id="cid" class="form-control floating" type="text">
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<label class="control-label">Phone </label>
												<input name="phone" id="ph" class="form-control" type="text">
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<label class="control-label">Company Name</label>
												<input name="companyname" id="cname" class="form-control" type="text">
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
										<button name="addclient" id="formsubmit" value="submitform" class="btn btn-primary">Create Client</button>
									</div>
								</form>
							</div>
						</div>
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
										<button class="savedetail btn btn-primary" name="updateform" type="submit" class="btn btn-primary">Edit Client</button>
										 
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>			
<script>

$(document).ready(function(){
 jQuery('.edit').click(function(){
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


$(document).ready(function(){
jQuery("#addclientform").validate({
	
rules: 
{
			firstname: "required",
            username: "required",
            emailid: "required",
            clientid: "required",
            phone: "required",
            companyname: "required", 
            password: 
			{ 
                required: true,
                minlength: 6
            } , 
            confirmpass: 
			{ 
                equalTo: "#pswrd",
                minlength: 6
            }
},
     
messages:
{
		 firstname: "Please Enter Your Name",
		 username: "Please Enter Your Username",
		 emailid: "Please Enter Your Email",
		 clientid: "Please Enter Your Client ID",
		 phone: "Please Enter Your Contact Number",
		 companyname: "Please Enter Your Company Name",
         password: 
		 { 
                required:"The Password is Required"

         }
}
});
});
			
$(document).ready(function(){
jQuery("#editclientform").validate({
	
rules: 
{
			firstname: "required",
            username: "required",
            clientid: "required",
            clientemail: "required",
            client_ph: "required",
            company: "required", 
            clientpass: 
			{ 
                required: true,
                minlength: 6,
            } , 
            conpass: 
			{ 
                equalTo: "#clientpassword",
                minlength: 6,
            }
},

messages:
{
		    firstname: "Please Enter Your Name",
		    username: "Please Enter Your Username",
		    clientemail: "Please Enter Your Email",
		    clientid: "Please Enter Your Client ID",
		    client_ph: "Please Enter Your Contact Number",
		    company: "Please Enter Your Company Name",
            clientpass: 
			{ 
                required:"The Password is Required"

            }
}
});
});
</script>
<?php include "footer.php";?>