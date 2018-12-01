<?php
session_start();
include "config/config.php";
if(isset($_SESSION['user_id'])){
	header("location:". $base_url1);
}
$obj = new connection();
$con = $obj->connect();

$actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]";
$base_url = $actual_link."/civilpro";

if(isset($_POST['forgot_password'])){

 		$email = $_POST['user_emailid'];

 		$user_data = "SELECT email from Users where (email = '$email' or user_name = '$email')";
		$uesr_row = mysqli_query($con,$user_data);
		$fetch_usernm_email = mysqli_fetch_assoc($uesr_row);	
		$send_Uers_mail = $fetch_usernm_email['email'];   
		$row_count = mysqli_num_rows($uesr_row);
		$password = rand(999, 99999);
		$url = $actual_link ."/civilpro/reset_password.php?id=". $password ;
		if($row_count > 0 ){

				$user_upd = "UPDATE Users SET pass_token = '$password' WHERE (email = '$email' OR user_name = '$email')";
		    	$uesr_upd = mysqli_query($con,$user_upd);

		    	$id = mysqli_affected_rows($con);
		    	if( $id > 0 ){
		    		
		    		$to = $send_Uers_mail; 	//--------------------------    
				    $subject = "Reset Password";
				    $message = "<span style='font-weight:600;font-size:20px;'> To reset the password, click on this link :-  </h3><a href='". $url ."'> Click here </a>";
				    $headers = "From : a1professionals.com";
				    
				    $headers = "MIME-Version: 1.0" . "\n";
				    $headers .= "Content-type:text/html;charset=UTF-8" . "\n";
	    			if(mail($to, $subject, $message, $headers)){
							$message= '1';
					    }
					    else{
					    	$message= '0';
					    }
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
    </head>
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
							<form method="post" id="forgotPassfrm">
								<?php

									if(isset($_POST['forgot_password']))
									{
										if($message == '1'){
											echo "<span style='color:green;font-size:13px;font-weight: 500;'>An Email hasbeen send to your email id. </span>";
										}else{
											echo "<span style='color:red;font-weight: 600;'>Please Enter the Correct Username or Email </span>";	
										}
									}


								?>


								<div class="form-group">
									<!--form-focus
										<label class="control-label">Username or Email</label>
									-->
									
									<input placeholder="Username or Email" class="form-control floating" type="text" name="user_emailid">
								</div>
								<div class="form-group text-center">
								<input type="submit" class="btn btn-primary btn-block account-btn"  value="Reset Password" name="forgot_password">
								</div>
								<div class="text-center">
									<a href="<?php echo $base_url; ?>">Back to Login</a>
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
			
		$("#forgotPassfrm").validate({

			rules: {
				user_emailid: {
					required: true
				}
			},
			messages: {

				user_emailid:{
					required: "Please enter a Email id . "
				}
			}
		});

		</script>
    </body>
</html>