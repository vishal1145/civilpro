<?php

session_start();
include "header.php";
include "setting_sidebar.php";
$obj = new connection();
$con = $obj->connect();
$user_id =  $_SESSION['user_id'];

if(isset($_POST['Updatebtn'])){	
	$oldpassword = $_POST['old_pass'];
 	$old_pass = md5($oldpassword);

	$newpassword = $_POST['new_pass'];

 	$confirmpassword =$_POST['confirm_pass'];
	$user_updata_pass_qeury  = "SELECT * From Users where user_id = $user_id AND password = '$old_pass'";
	$user_pass_match = mysqli_query($con,$user_updata_pass_qeury);
	$user_rows = $user_pass_match->num_rows;

	if($user_rows > 0){
			if($newpassword != "" && $confirmpassword != ""){
				if($newpassword == $confirmpassword){
				$newpassword = md5($newpassword);
			$user_password_upd = "UPDATE Users SET	password = '$newpassword' 
										  WHERE  user_id = '$user_id'";
			$reset_pass = mysqli_query($con, $user_password_upd);
			$upd_quey = mysqli_affected_rows($con);
				} 
				/*else{ echo "Your new password is not match the Confirm password ";	}*/
			}
			/*else{ echo "Enter the value in New password field and Confirm password"; }*/
	}
	/*else{ echo "Your old Password is not match . ";	}*/
}


?>
            <div class="page-wrapper">
                <div class="content container-fluid">
					<div class="row">
						<div class="col-md-6 col-md-offset-3">
							<h4 class="page-title">Change Password</h4>
							<?php if(isset($_POST['Updatebtn'])){
										if($upd_quey > 0){
												echo "<span style='color:green'>Your Password is Change Successfully. </span>";
											}else{
												echo "<span style='color:red'>Your Old password is not match. </span>";
											}


									} ?>
							<form method="post" id="changepassform">
								<div class="row">
									<div class="col-xs-12 col-sm-12">
										<div class="form-group">
											<label>Old password</label>
											<input type="password" class="form-control"  name="old_pass"
											id="old_pass" />
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-xs-12 col-sm-6">
										<div class="form-group">
											<label>New password</label>
											<input type="password" class="form-control" name="new_pass" id="new_pass" />
										</div>
									</div>
									<div class="col-xs-12  col-sm-6">
										<div class="form-group">
											<label>Confirm password</label>
											<input type="password" class="form-control" name="confirm_pass" id="confirm_pass" />
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-sm-12 text-center m-t-20">
										<!--<button type="button" class="btn btn-primary">Update Password</button>-->
										<input type="submit"   class="btn btn-primary value="Update Password" name="Updatebtn">
									</div>
								</div>
							</form>
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
        <script type="text/javascript" src="assets/js/jquery-3.2.1.min.js"></script>
        <script type="text/javascript" src="assets/js/bootstrap.min.js"></script>
        <script type="text/javascript" src="assets/js/jquery.slimscroll.js"></script>
		<script type="text/javascript" src="assets/js/app.js"></script>
		<script type="text/javascript" src="assets/js/jquery.validate.min.js"></script>
		<script>
			
		$("#changepassform").validate({
			rules: {

				old_pass: {
					required: true
				},
				new_pass: {
					required: true,
					minlength: 5
				},
				confirm_pass: {
					required: true,					
					equalTo: "#new_pass"
				}				
			},
			messages: {
					old_pass: {
					required: "Please enter a password"
					},
				new_pass: {
					required: "Please enter a password",
					minlength: "Your password must be at least 5 characters long."
				},
				confirm_pass: {
					required: "Please enter a confirm password",
					minlength: "Your password must be at least 5 characters long.",
					equalTo: "Please enter the same password as previous."
				}
			}
		});
		</script>

    </body>
</html>