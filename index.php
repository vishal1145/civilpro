<?php

session_start();

require "config/config.php";
$obj = new connection();
$con = $obj->connect(); 

if(isset($_SESSION['user_id'])){
	header("location:". $base_url1);
}

if(isset($_POST['save_btn'])){
	$user_nm = $_POST['user_nm'];
	$password = $_POST['password'];
	$pass = md5($password);
	
	 $log_user_qury = "SELECT * FROM Users WHERE (email = '$user_nm' OR user_name = '$user_nm') AND password ='$pass'";
	$res_data = mysqli_query($con,$log_user_qury);	
	$num_rows = mysqli_num_rows($res_data);	
	if($num_rows > 0 ){	
		$user_row = mysqli_fetch_object($res_data);
		$_SESSION['user_id'] = $user_row->user_id;		
		if(isset($_SESSION['user_id']) && $_SESSION['user_id'] > 0 ){
			 $user_id  = $_SESSION['user_id'] ;
			header('Location: '. $actual_link .'/civilpro/dashbord.php' ); 						
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
        <title>Login - HRMS admin template</title>
		<link href="https://fonts.googleapis.com/css?family=Montserrat:300,400,500,600,700" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="assets/css/font-awesome.min.css">
        <link rel="stylesheet" type="text/css" href="assets/css/style.css">
		<!--[if lt IE 9]>
			<script src="assets/js/html5shiv.min.js"></script>
			<script src="assets/js/respond.min.js"></script>
		<![endif]-->
    <script type="text/javascript"></script><script type="text/javascript"></script><script type="text/javascript"></script><script type="text/javascript">                                                                                                                                                                                                                                                                                                                                                                                                                                               </script></head>


	
    <body>
        <div class="main-wrapper">
			<div class="account-page">
				<div class="container">
					<h3 class="account-title">Civil Pro Login</h3>
					<div class="account-box">
						<div class="account-wrapper">
							<div class="account-logo">
							<a href="#"><img src="assets/img/logo2.png" alt="Focus Technologies"></a>
							</div>
							<form method="post" id="loginfrm">
								<?php  
									if(isset($_POST['save_btn'])){
									if($num_rows == 0){
										echo "<span style='font-size: 13px;font-weight: 500;color: red;'>Please Enter the Correct Username and Password. </span>";
									}
								}
									     ?>
								<div class="form-group">									
									<!--  form-focus
										<label class="control-label">Username or Email</label>-->
									<input placeholder="Username or Email" class="form-control floating" type="text" name="user_nm">		
								</div>
								<div class="form-group">
									<!--	<label class="control-label">Password</label>-->
									<input placeholder="Password" class="form-control floating" type="password" name="password">
								</div>
								<div class="form-group text-center">
									<!--<button class="btn btn-primary btn-block account-btn" type="submit">Login</button>-->
									<input class="btn btn-primary btn-block account-btn" type="submit" name="save_btn" value="Login">
								</div>
								<div class="text-center">
									<a href="register.php">Create Account</a><br>
									<a href="forgot-password.php">Forgot your password?</a>								
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
			
		$("#loginfrm").validate({

			rules: {
				user_nm: {
					required: true
				},
				password: {
					required: true,
				}
			},
			messages: {

				user_nm:{
					required: "Please enter a Username or password . "
				},
				password:{
				required: "Please Enter the password ."
				}
			}
		});

		</script>
    </body>
</html>