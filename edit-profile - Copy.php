<?php

include "header.php";
include "sidebar.php";
$obj = new connection();
$con = $obj->connect();

if(isset($_SESSION['user_id'])){
	$user_id = $_SESSION['user_id'];
	$user_data = "SELECT * FROM Users WHERE  user_id = '$user_id'";
	$user_data_res = mysqli_query($con,$user_data);
	$user_data_fetch = mysqli_fetch_object($user_data_res);

}


if(isset($_POST['Save_update'])){

	$img = $_FILES['upload_img']['name'];
	$img_tmp = $_FILES['upload_img']['tmp_name'];
	$first_name = $_POST['first_name'];
	$last_name = $_POST['last_name'];	
	$birthday = $_POST['birthday'];
	$address = $_POST['address'];
	$country = $_POST['country'];
	$state = $_POST['state'];
	$pin_code = $_POST['pin_code'];
	$gender = $_POST['gender'];
	$phone = $_POST['phone'];

	$path_parts = pathinfo($_FILES["upload_img"]["name"]);	 
	if(!empty($img)){
		$image_path1 = $path_parts['filename'].'_'.time().'.'.$path_parts['extension'];			
	}
	else
	{					
		$image_path1 = $user_data_fetch->img;
	}
	$image_path = $image_path1;	
    move_uploaded_file($img_tmp,'upload_images/'.$image_path);
	$upd_uer_detail = "UPDATE Users set first_name = '$first_name',
										last_name = '$last_name',
										phone = '$phone',
										birthday = '$birthday',
										address = '$address',
										country = '$country',
										state = '$state',
										pin_code = '$pin_code',
										gender = '$gender',
										img = '$image_path'
							WHERE user_id = '$user_id'";
	$upd_res = mysqli_query($con,$upd_uer_detail);	
	$affect_row = mysqli_affected_rows($con);
		header("location:". $actual_link ."/civilpro/edit-profile.php");	
	}
	


?>
            <div class="page-wrapper">
                <div class="content container-fluid">
					<div class="row">
						<div class="col-sm-8">
							<h4 class="page-title">Edit Profile</h4>
						</div>
					</div>
					<form method="POST" enctype="multipart/form-data">
						<div class="card-box">
							<h3 class="card-title">Basic Informations</h3>
							<div class="row">
								<div class="col-md-12">
									<div class="profile-img-wrap">
										<img class="inline-block" src='upload_images/<?php if(isset($user_data_fetch->img) && !empty($user_data_fetch->img)){ echo $user_data_fetch->img; } else { echo "user.jpg";  }  ?>'  alt='user'>
										<div class="fileupload btn btn-default">
											<span class="btn-text">edit</span>
											<input class="upload" type="file" name="upload_img">
										</div>
									</div>
									<div class="profile-basic">
										<div class="row">
											<div class="col-md-6">
												<div class="form-group form-focus">
													<label class="control-label">First Name</label>
													<input type="text" class="form-control floating" name="first_name" value="<?php echo $user_data_fetch->first_name; ?>"/>
												</div>
											</div>
											<div class="col-md-6">
												<div class="form-group form-focus">
													<label class="control-label">Last Name</label>
													<input type="text" class="form-control floating"
													name="last_name" value="<?php echo $user_data_fetch->last_name; ?>"/>
												</div>
											</div>
											<div class="col-md-6">
												<div class="form-group form-focus">
													<label class="control-label">Birthday</label>
													<div class="cal-icon"><input class="form-control floating datetimepicker" type="text" value="<?php echo $user_data_fetch->birthday; ?>" name="birthday"></div>
												</div>
											</div>
											<div class="col-md-6">
												<div class="form-group form-focus select-focus">
													<label class="control-label">Gendar</label>
													<select class="select form-control floating" name="gender">
														<option value="<?php echo $user_data_fetch->gender ; ?>"><?php echo $user_data_fetch->gender; ?></option>
														<option value="Male">Male</option>
														<option value="Female">Female</option>
													</select>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="card-box">
							<h3 class="card-title">Contact Informations</h3>
							<div class="row">
								<div class="col-md-12">
									<div class="form-group form-focus">
										<label class="control-label">Address</label>
										<input type="text" class="form-control floating" value="<?php echo $user_data_fetch->address; ?>" name="address"/>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group form-focus">
										<label class="control-label">State</label>
										<input type="text" class="form-control floating" value="<?php echo $user_data_fetch->state; ?>" name="state"/>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group form-focus">
										<label class="control-label">Country</label>
										<input type="text" class="form-control floating" value="<?php echo $user_data_fetch->country; ?>" name="country"/>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group form-focus">
										<label class="control-label">Pin Code</label>
										<input type="text" class="form-control floating" value="<?php echo $user_data_fetch->pin_code; ?>" name="pin_code" />
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group form-focus">
										<label class="control-label">Phone</label>
										<input type="text" class="form-control floating" value="<?php echo $user_data_fetch->phone; ?>" name="phone"/>
									</div>
								</div>
							</div>
						</div>
						<!--<div class="card-box">
							<h3 class="card-title">Education Informations</h3>
							<div class="row">
								<div class="col-md-6">
									<div class="form-group form-focus">
										<label class="control-label">Institution</label>
										<input type="text" class="form-control floating" />
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group form-focus">
										<label class="control-label">Subject</label>
										<input type="text" class="form-control floating" />
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group form-focus">
										<label class="control-label">Starting Date</label>
										<input type="text" class="form-control floating" />
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group form-focus">
										<label class="control-label">Complete Date</label>
										<input type="text" class="form-control floating" />
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group form-focus">
										<label class="control-label">Degree</label>
										<input type="text" class="form-control floating" />
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group form-focus">
										<label class="control-label">Grade</label>
										<input type="text" class="form-control floating" />
									</div>
								</div>
							</div>
							<div class="add-more">
								<a href="#" class="btn btn-primary"><i class="fa fa-plus"></i> Add More Institute</a>
							</div>
						</div>
						<div class="card-box">
							<h3 class="card-title">Experience Informations</h3>
							<div class="row">
								<div class="col-md-6">
									<div class="form-group form-focus">
										<label class="control-label">Company Name</label>
										<input type="text" class="form-control floating" />
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group form-focus">
										<label class="control-label">Location</label>
										<input type="text" class="form-control floating" />
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group form-focus">
										<label class="control-label">Job Position</label>
										<input type="text" class="form-control floating" />
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group form-focus">
										<label class="control-label">Period From</label>
										<input type="text" class="form-control floating" />
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group form-focus">
										<label class="control-label">Period To</label>
										<input type="text" class="form-control floating" />
									</div>
								</div>
							</div>
							<div class="add-more">
								<a href="#" class="btn btn-primary"><i class="fa fa-plus"></i> Add More Experience</a>
							</div>
						</div> -->
						<div class="text-center m-t-20">
							<input class="btn btn-primary btn-lg" type="submit"  value="Save &amp; update" name="Save_update">
						</div>
					</form>
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
        <script type="text/javascript" src="assets/js/jquery-3.2.1.min.js"></script>
        <script type="text/javascript" src="assets/js/bootstrap.min.js"></script>
        <script type="text/javascript" src="assets/js/jquery.slimscroll.js"></script>
		<script type="text/javascript" src="assets/js/select2.min.js"></script>
		<script type="text/javascript" src="assets/js/moment.min.js"></script>
		<script type="text/javascript" src="assets/js/bootstrap-datetimepicker.min.js"></script>
		<script type="text/javascript" src="assets/js/app.js"></script>
    </body>
</html>