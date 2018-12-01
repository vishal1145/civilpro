<?php
session_start();
include "header.php";
include "sidebar.php";
$obj = new  connection();
$con = $obj->connect();
?>
<style type="text/css">
	
#imagePreview {
    width: 120px;
    height: 120px;
    background-position: center center;
    background-size: cover;
    -webkit-box-shadow: 0 0 1px 1px rgba(0, 0, 0, .3);
    display: inline-block;
}

</style>

 <div class="page-wrapper">
 <?php 
	$clientId  = $_GET['id'];
	$user_data = "SELECT * FROM Client where id= $clientId";
	$user_data_res = mysqli_query($con,$user_data);
	$user_data_fetch = mysqli_fetch_object($user_data_res);
	
	
if(isset($_POST['editclientprofile'])){

		$img = $_FILES['upload_img']['name'];
		$img_tmp = $_FILES['upload_img']['tmp_name'];
	$editid  = $_POST['editclientprofileid'];
    $firstname = (isset($_POST['firstname']) ? $_POST['firstname'] : "");
	$lastname = (isset($_POST['lastname']) ? $_POST['lastname'] : "");
	$birthday = (isset($_POST['birthday']) ? $_POST['birthday'] : "");
	$gender = (isset($_POST['gender']) ? $_POST['gender'] : "");
	$address = (isset($_POST['address']) ? $_POST['address'] : "");
	$state = (isset($_POST['state']) ? $_POST['state'] : "");
	$country = (isset($_POST['country']) ? $_POST['country'] : "");
	$pincode = (isset($_POST['pincode']) ? $_POST['pincode'] : "");
	$phno = (isset($_POST['phno']) ? $_POST['phno'] : "");

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
	/* $upd_uer_detail = "UPDATE Users set first_name = '$first_name',
										last_name = '$last_name',
										phone = '$phone',
										birthday = '$birthday',
										address = '$address',
										country = '$country',
										state = '$state',
										pin_code = '$pin_code',
										gender = '$gender',
										img = '$image_path'
							WHERE user_id = '$user_id'"; */
							
	 $upd_uer_detail = "UPDATE Client SET img='$image_path', first_name='$firstname', last_name='$lastname',birthday='$birthday',gender='$gender',address='$address',state='$state',country='$country',pincode='$pincode',phone_no='$phno' WHERE id= '$editid'";				
							
	$upd_res = mysqli_query($con,$upd_uer_detail);	
	$affect_row = mysqli_affected_rows($con);
	?>
<script type="text/javascript">
			 $(document).ready(function(){
	window.location.reload(true);
	 </script>
	 <?php
		//header( "refresh:3;url=". $actual_link ."/civilpro/edit-profile.php" );
		//header('Location: http://112.196.9.211:8888/civilpro/edit-client-profile.php?id=44');
	}
	
	
	
	
						
$clientId  = $_GET['id'];
$showclientprofile= mysqli_query($con,"SELECT * FROM Client where id= $clientId");
while($row = mysqli_fetch_array($showclientprofile)){
?>
                <div class="content container-fluid">
					<div class="row">
						<div class="col-sm-8">
							<h4 class="page-title">Edit Profile</h4>
						</div>
					</div>
					<form action="" method="post" enctype="multipart/form-data">
						<div class="card-box">
							<h3 class="card-title">Basic Informations</h3>
							<div class="row">
								<div class="col-md-12">
									<div class="profile-img-wrap" id="imagePreview">
										<img class="inline-block" src='upload_images/<?php if(isset($row['img']) && !empty($row['img'])){ echo $row['img']; } else { echo "user.jpg";  }  ?>'  alt='user' id="none_image">
										<div class="fileupload btn btn-default">
											<span class="btn-text">edit</span>
											<input class="upload" type="file" name="upload_img" id="uploadFile"/>
										</div>
									</div>
									<div class="profile-basic">
										<div class="row">
											<div class="col-md-6">
												<div class="form-group form-focus">
													<label class="control-label">First Name</label>
													<input name="firstname" type="text" value="<?php echo $row['first_name'];?>" class="form-control floating" required/>
												</div>
											</div>
											<div class="col-md-6">
												<div class="form-group form-focus">
													<label class="control-label">Last Name</label>
													<input name="lastname" value="<?php echo $row['last_name'];?>" type="text" class="form-control floating" required />
												</div>
											</div>
											<div class="col-md-6">
												<div class="form-group form-focus">
													<label class="control-label">Birth Date</label>
													<div class="cal-icon"><input name="birthday" value="<?php echo $row['birthday'];?>" class="form-control floating datetimepicker"  type="text" required></div>
												</div>
											</div>
											<div class="col-md-6">
												<div class="form-group form-focus select-focus">
													<label class="control-label">Gendar</label>
													<select value="<?php echo $row['gender'];?>" name="gender" class="select form-control floating" required>
														<option value="" disabled selected>Select Gendar</option>
														<option <?php if ($row['gender'] == Male ) echo 'selected' ; ?> value="Male">Male</option>
														<option <?php if ($row['gender'] == Female ) echo 'selected' ; ?> value="Female">Female</option>
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
										<input name="address" value="<?php echo $row['address'];?>" type="text" class="form-control floating" required />
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group form-focus">
										<label class="control-label">State</label>
										<input name="state" value="<?php echo $row['state'];?>"type="text" class="form-control floating" required/>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group form-focus">
										<label class="control-label">Country</label>
										<input name="country" value="<?php echo $row['country'];?>"type="text" class="form-control floating" required/>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group form-focus">
										<label class="control-label">Pin Code</label>
										<input name="pincode" value="<?php echo $row['pincode'];?>"type="text" class="form-control floating" required/>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group form-focus">
										<label class="control-label">Phone Number</label>
										<input name="phno" value="<?php echo $row['phone_no'];?>" type="text" class="form-control floating" required/>
									</div>
								</div>
							</div>
						</div>
						<!-- <div class="card-box">
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
						</div> --->
						<div class="text-center m-t-20">
						<input type="hidden" name="editclientprofileid" value="<?php echo $row['id'];?>" required/>
							<button name="editclientprofile" class="btn btn-primary btn-lg" type="submit">Save &amp; update</button>
						</div>
					</form>
				</div> 
<?php } ?>
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
			<script type="text/javascript">
		$(function() {
    $("#uploadFile").on("change", function()
    {
        var files = !!this.files ? this.files : [];
        if (!files.length || !window.FileReader) return; // no file selected, or no FileReader support

        if (/^image/.test( files[0].type)){ // only image file
            var reader = new FileReader(); // instance of the FileReader
            reader.readAsDataURL(files[0]); // read the local file

            reader.onloadend = function(){ // set image data as background of div
            	$('#none_image').css('display','none');
                $("#imagePreview").css("background-image", "url("+this.result+")");
            }
        }
    });
});
		</script>
			
			
			
<?php
include "footer.php";
?>
