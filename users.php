<?php
include "header.php";
include "sidebar.php";

$obj = new connection();
$con = $obj->connect();
//$all_users = " SELECT * FROM Users WHERE User_role != '1'";
$all_users = "SELECT * FROM Users ORDER BY user_id DESC";
$get_users = mysqli_query($con,$all_users);
	

if(isset($_POST['update_usr'])){

$first_name = $_POST['first_name']; 
$last_name = $_POST['last_name']; 
$phone =  $_POST['phone']; 
$userid =  $_POST['user_id']; 
$rolss = $_POST['role121']; 

$updata_qury =  "UPDATE Users SET first_name = '$first_name',
 									last_name  = '$last_name',
 									phone = '$phone',
 									user_role = '$rolss'
 						where user_id = '$userid'";
$upd_res = mysqli_query($con,$updata_qury);
header("location:http://$_SERVER[HTTP_HOST]/civilpro/users.php");

}

if(isset($_POST['create_user'])){

//  echo "<pre>";
// print_r($_POST);
// echo "</pre>";
// die;

$firtname_crt = $_POST['firtname_crt'];
$lastname_crt = $_POST['lastname_crt'];
$username_crt = $_POST['username_crt'];
$email_crt = $_POST['email_crt'];
$pass_crt = md5($_POST['pass_crt']);
$passcrm_crt = $_POST['passcrm_crt'];
$phone_crt = $_POST['phone_crt'];
$role_crt = $_POST['role_crt'];
$user_employee_id = $_POST['user_employee_id'];
$user_company_id = $_POST['user_company_id'];



	$inst_qury = "INSERT INTO Users(user_name,first_name,last_name,phone,email,password,birthday,address,country,state,pin_code,gender, user_employee_id, user_company_id, pass_token,img,user_role) VALUES ('$username_crt','$firtname_crt','$lastname_crt','$phone_crt','$email_crt','$pass_crt','','','','','','', '$user_employee_id', '$user_company_id', '', '','$role_crt')";
	$res_query = mysqli_query($con,$inst_qury);	
	header("location:http://$_SERVER[HTTP_HOST]/civilpro/users.php");
}

if(isset($_POST['Deleterow'])){
	$deleteid = $_POST['deletehidden'];
	$del_row = "DELETE FROM Users where user_id = '$deleteid'";
	$del_res = mysqli_query($con,$del_row);
	header("location:http://$_SERVER[HTTP_HOST]/civilpro/users.php");
}
if(isset($_REQUEST['user_search'])){

//  echo "<pre>";
// print_r($_REQUEST);
// echo "</pre>";
// // die;
 
$find_user_name = $_POST['find_user_name'];

$find_user_role = $_POST['user_role'];

$find_user_company = $_POST['find_user_company'];

	$SearchArray = array();

	if(!empty($find_user_name)){
		$SearchArray[] = "first_name like '%$find_user_name%'";
	}


	if(!empty($find_user_role)){
		$SearchArray[] = "user_role like '%$find_user_role%'";
	}
	if($find_user_role == '0'){
	   $SearchArray[] = "user_role like '%$find_user_role%'";
	}

	if(!empty($find_user_company)){
  	$SearchArray[] = "user_company_id like '%$find_user_company%'";
  	}

	$searchQuery = implode(" AND ", $SearchArray);


	echo "SELECT * FROM Users where $searchQuery";
   	$get_user =("SELECT * FROM Users where $searchQuery");
    $get_users = mysqli_query($con,$get_user);

}

?>
            <div class="page-wrapper">
                <div class="content container-fluid">
					<div class="row">
						<div class="col-xs-4">
							<h4 class="page-title">Users</h4>
						</div>
						<div class="col-xs-8 text-right m-b-30">
							<a href="#" class="btn btn-primary rounded" data-toggle="modal" data-target="#add_user"><i class="fa fa-plus"></i> Add User</a>
						</div>
					</div>
					<div class="row filter-row">
						<form method="post" name="user_search">
						<div class="col-sm-3 col-xs-6">  
							<div class="form-group form-focus">
								<label class="control-label">Name</label>
								<input type="text" name="find_user_name" class="form-control floating" />
							</div>
						</div>
						<div class="col-sm-3 col-xs-6"> 
							<div class="form-group form-focus select-focus">
								<label class="control-label">Company</label>
								<select class="select floating" name="find_user_company"> 
									<option value="">Select Company</option>
									<option value="1">Global Technologies</option>
									<option value="2">Delta Infotech</option>
								</select>
							</div>
						</div>
						<div class="col-sm-3 col-xs-6"> 
							<div class="form-group form-focus select-focus">
								<label class="control-label">Role</label>

								<select class="select floating" name="user_role"> 
									<option value="">Select Role</option>
									 <?php 	
											$users_roles = "SELECT distinct user_role FROM Users";
											$users_role = mysqli_query($con,$users_roles);
											if($users_role->num_rows > 0){
												while($users_rows = mysqli_fetch_object($users_role)){ 
													$role = $users_rows->user_role;
									?>
												<option value="<?php echo $role; ?>"><?php if($role == 1) { echo "Admin"; }else{echo "User"; } ?></option>
									<?php 
												}
											}
									?>
									
								</select>
							</div>
						</div>
						<div class="col-sm-3 col-xs-6">  
							<!-- <a href="#" class="btn btn-success btn-block"> Search </a>   -->
							<input type="submit" name="user_search" class="btn btn-success btn-block" value="Search">
							<input type="button" class="ref_page btn btn-info btn-block" value="Reset">
						</div>  
						</form>   
                    </div>
					<div class="row">
						<div class="col-md-12">
							<div class="table-responsive">
								<table class="table table-striped custom-table datatable">
									<thead>
										<tr>
											<th style="width:30%;">Name</th>
											<th>Email</th>
											<th>Company</th>
											<th>Created Date</th>
											<th>Role</th>
											<th class="text-right">Action</th>
										</tr>
									</thead>
									<tbody>

			<?php
				if($get_users->num_rows > 0){
					while($users_rows = mysqli_fetch_object($get_users)){

						/*echo"<pre>";
						print_r($users_rows);
						echo"</pre>";*/
				?>
						<tr>
							<td>
							<a href="profile.php" class="avatar"><?php echo $users_rows->first_name[0] ;   ?></a>
							<h2><!-- <a href="profile.php"> --><?php echo $users_rows->first_name;   ?> <span>
								<?php 
								$role = $users_rows->user_role;
								if($role == 0) {
									echo "User";
								}
								else{
									echo "Admin";
								}
							?>
								
							</span><!-- </a> --></h2>
							</td>
							<td><?php echo $users_rows->email; ?></td>
							<td><?php 
								$user_company = $users_rows->user_company_id;
								if($user_company == 1) {
									echo "Global Technologies";
								}
								else{
									echo "Delta Infotech";
								}
							?>			</td>
							<td><?php echo date('M-d-Y', strtotime($users_rows->created_at)); ?></td>
							<td>
								<span class="label label-success-border">
							<?php 
								$role = $users_rows->user_role;
								if($role == 0) {
									echo "User";
								}
								else{
									echo "Admin";
								}
							?>								
							</span>
							</td>
							<td class="text-right">
								<div class="dropdown aa">
									<form method="POST">
									<a href="" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>

									<ul class="dropdown-menu pull-right">
										<li><a href="" data-toggle="modal" data-target="#edit_user" class='getid' aid='<?php echo $users_rows->user_id; ?>'><i class="fa fa-pencil m-r-5"></i> Edit </a></li>
										<li><a href="#" data-toggle="modal" data-target="#delete_user" class="did" delete_id ='<?php echo $users_rows->user_id; ?>'><i class="fa fa-trash-o m-r-5"></i> Delete</a></li>
										<input type="hidden"  name='reord_id'>
									</ul>
								</form>
								</div>
							</td>
						</tr>


<?php							}
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
			<div id="add_user" class="modal custom-modal fade" role="dialog">
				<div class="modal-dialog">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<div class="modal-content modal-lg">
						<div class="modal-header">
							<h4 class="modal-title">Add User</h4>
						</div>
						<div class="modal-body" method="POST">
							<form class="m-b-30" name="new_user_registration" id="new_user_registration" method="POST">
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label class="control-label">First Name <span class="text-danger">*</span></label>
											<input class="form-control" type="text" name="firtname_crt" id="firtname_crt" required>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label class="control-label">Last Name</label>
											<input class="form-control" type="text" name="lastname_crt">
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label class="control-label">Username <span class="text-danger">*</span></label>
											<input class="form-control" type="text" name="username_crt" id="username_crt" required>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label class="control-label">Email <span class="text-danger">*</span></label>
											<input class="form-control" type="email" id="email_crt" name="email_crt" required>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label class="control-label">Password<span class="text-danger">*</span></label>
											<input class="form-control" type="password" name="pass_crt" id="pass_crt" required>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label class="control-label">Confirm Password<span class="text-danger">*</span></label>
											<input class="form-control" type="password" name="passcrm_crt" id="passcrm_crt" required>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label class="control-label">Phone </label>
											<input class="form-control" type="text" name="phone_crt">
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label class="control-label">Role</label>
											<select class="select" name="role_crt">
												<option value="1">Admin</option>
												<option value="0" selected>User</option>						
											</select>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label class="control-label">Company</label>
											<select class="select" name="user_company_id">
												<option value="1" selected>Global Technologies</option>
												<option value="2">Delta Infotech</option>
											</select>
										</div>
									</div>
									<div class="col-md-6">  
										<div class="form-group">
											<label class="control-label">Employee ID <span class="text-danger">*</span></label>
											<input type="text" name="user_employee_id" id="user_employee_id" class="form-control floating" required>
										</div>
								   </div>
								</div>
								<!--<div class="table-responsive m-t-15">
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
												<td>Employee</td>
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
												<td>Holidays</td>
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
												<td>Leave Request</td>
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
												<td>Events</td>
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
									</table>-->
								</div>
								<div class="m-t-20 text-center">
									<input type="submit" class="btn btn-primary" value="Create User" name="create_user">
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>

<script type="text/javascript">
$(document).ready(function(){
    $(".getid").click(function() {
         var user_id = $(this).attr('aid');	
        $.ajax ({
        	type: "POST",
            url: "all_user.php",
            data: {uid : user_id }, 
            dataType: 'json',
            success: function( result ) {
           
          if(result.status = "sucess"){

				$("#first_name").val(result.data.first_name);
				$("#last_name").val(result.data.last_name);
				$("#phone").val(result.data.phone);
				$("#role1a").val(result.data.role);				
				$("#user_id").val(result.data.user_id);	

				}
				else{
				 alert('fail');
				}

            }
        });
    });

	$(".did").click(function() {
         var del_user_id = $(this).attr('delete_id');
         $("input[type=hidden][name=deletehidden]").val(del_user_id);
	});

});

</script>

			<div id="edit_user" class="modal custom-modal fade" role="dialog">
				<div class="modal-dialog">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<div class="modal-content modal-lg">
						<div class="modal-header">
							<h4 class="modal-title">Edit User</h4>
						</div>
						<div class="modal-body">
							<form class="m-b-30" method="POST">
								<input type='hidden' value='' name='hidden_id'>
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label class="control-label">First Name <span class="text-danger">*</span></label>
											<input class="form-control" name="first_name" type="text" id="first_name">
											</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label class="control-label">Last Name</label>
											<input class="form-control" id="last_name" name="last_name" type="text">
										</div>
									</div>
									<!--<div class="col-md-6">
										<div class="form-group">
											<label class="control-label">Username <span class="text-danger">*</span></label>
											<input class="form-control" value="johndoe" type="text">
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label class="control-label">Email <span class="text-danger">*</span></label>
											<input class="form-control" value="johndoe@example.com" type="email">
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label class="control-label">Password</label>
											<input class="form-control" type="password">
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label class="control-label">Confirm Password</label>
											<input class="form-control" type="password">
										</div>
									</div>-->
									<div class="col-md-6">
										<div class="form-group">
											<label class="control-label">Phone </label>
											<input class="form-control" id="phone" name="phone" type="text">
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label class="control-label">Role</label>
											<select  name="role121" class="select" id='role1a'>
												<option value='1'>Admin</option>
												<option value='0'>User</option>
												
											</select>
										</div>
									</div>
									<!--<div class="col-md-6">
										<div class="form-group">
											<label class="control-label">Company</label>
											<select class="select">
												<option>Global Technologies</option>
												<option>Delta Infotech</option>
											</select>
										</div>
									</div>
									<div class="col-md-6">  
										<div class="form-group">
											<label class="control-label">Employee ID <span class="text-danger">*</span></label>
											<input type="text" value="FT-0001" class="form-control floating">
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
												<td>Employee</td>
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
												<td>Holidays</td>
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
												<td>Leave Request</td>
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
												<td>Events</td>
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
									</table>-->
								</div>
								<div class="m-t-20 text-center">
									<input type="hidden" id="user_id"  name="user_id"> 
									<input type="submit" name="update_usr" value="Edit User" class="btn btn-primary">
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
			<div id="delete_user" class="modal custom-modal fade" role="dialog">
				<div class="modal-dialog">
					<div class="modal-content modal-md">
						<div class="modal-header">
							<h4 class="modal-title">Delete Employee</h4>
						</div>
						<form method="POST">
							<div class="modal-body card-box">
								<p>Are you sure want to delete this?</p>
								
							<div class="m-t-20"> <a href="#" class="btn btn-default" data-dismiss="modal">Close</a>
								<input type="hidden"  name="deletehidden">

								<input  type="submit" class="btn btn-danger" value="Delete" name="Deleterow" id="Deleterow">
							</div>
							</div>
						</form>
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
    </body>
</html>