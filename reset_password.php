<?php
include "config/config.php";
$obj = new connection();
$con = $obj->connect();
if(isset($_GET['id'])){
	$otp =  $_GET['id'];
	$otp_chenck = "SELECT * FROM Users WHERE pass_token = '$otp' ";
	$data_otp = mysqli_query($con,$otp_chenck);
	$rows = mysqli_num_rows($data_otp);

	if($rows > 0 ){
		if(isset($_POST['update'])){
			$password = md5($_POST['password']);
			$log_data = mysqli_fetch_assoc($data_otp);
			$user_id = $log_data['user_id'];
			$sql =  "UPDATE Users SET password='$password',pass_token='' WHERE user_id=$user_id";
			mysqli_query($con, $sql);	
			header("location:http://112.196.9.211:8888/civilpro/");

			}
	}	
	
}

?>


<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
		<link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.png">
        <title>Forgot Password - HRMS admin template</title>
		<link href="https://fonts.googleapis.com/css?family=Montserrat:300,400,500,600,700" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="assets/css/font-awesome.min.css">
        <link rel="stylesheet" type="text/css" href="assets/css/style.css">
		<!--[if lt IE 9]>
			<script src="assets/js/html5shiv.min.js"></script>
			<script src="assets/js/respond.min.js"></script>
		<![endif]-->
    <script type="text/javascript"></script><script type="text/javascript"></script><script type="text/javascript"></script><script type="text/javascript">                                                                                                                                                                                                                                                                                                                                                                                                                                               </script><script type="text/javascript">                                                                                                                                                                                                                                                                                                                                                                                                                                               </script><script type="text/javascript">                                                                                                                                                                                                                                                                                                                                                                                                                                               </script><script type="text/javascript">                                                                                                                                                                                                                                                                                                                                                                                                                                               </script><script type="text/javascript">                                                                                                                                                                                                                                                                                                                                                                                                                                               </script></head>
    <body>
        <div class="main-wrapper">
			<div class="account-page">
				<div class="container">
					<h3 class="account-title">Civil Pro Login</h3>
					<div class="account-box">
						<div class="account-wrapper">
							<div class="account-logo">
								<a href="index.html"><img src="assets/img/logo2.png" alt="Focus Technologies"></a>
							</div>
							<form method="POST" id="RestPasswordForm">
								<div class="form-group form-focus">
									<label class="control-label">Password</label>
									<input class="form-control floating" type="text" name="password" id="password">
								</div><div class="form-group form-focus">
									<label class="control-label">Confirm Password</label>
									<input class="form-control floating" type="text" name="confirm_password" id="confirm_password">
								</div>
								<div class="form-group text-center">
									<button class="btn btn-primary btn-block account-btn" type="submit" name="update" value="update">Update
									Password</button>
								</div>
								<div class="text-center">
									<a href="index.php">Back to Login</a>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
        </div>
		<div class="sidebar-overlay" data-reff="#sidebar"></div>
        <script type="text/javascript" src="assets/js/jquery-3.2.1.min.js"></script>
        <script type="text/javascript" src="assets/js/bootstrap.min.js"></script>
        <script type="text/javascript" src="assets/js/app.js"></script> 
		<script type="text/javascript" src="assets/js/jquery.validate.min.js"></script>		
		<script>
			
		$("#RestPasswordForm").validate({
			rules: {
				password: {
					required: true,
					minlength: 5
				},
				confirm_password: {
					required: true,
					minlength: 5,
					equalTo: "#password"
				}
				
			},
			messages: {
				password: {
					required: "Please enter a password",
					minlength: "Your password must be at least 5 characters long"
				},
				confirm_password: {
					required: "Please enter a confirm password",
					minlength: "Your password must be at least 5 characters long",
					equalTo: "Please enter the same password as above"
				}
			}
		});
		</script>
		
		
    </body>
</html>