<?php
$servername = "localhost";
$username = "root";
$password = "Rock@7861";
$dbname = "civil_pro";
// Create connection
$conn = new mysqli($servername, $username, $password,$dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
//echo "Connected successfully";
?>




<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
		<link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.png">
        <title>Password generate - HRMS admin template</title>
		<link href="https://fonts.googleapis.com/css?family=Montserrat:300,400,500,600,700" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="assets/css/font-awesome.min.css">
        <link rel="stylesheet" type="text/css" href="assets/css/style.css">
		<!--[if lt IE 9]>
			<script src="assets/js/html5shiv.min.js"></script>
			<script src="assets/js/respond.min.js"></script>
		<![endif]-->
    <script type="text/javascript"></script><script type="text/javascript"></script><script type="text/javascript"></script><script type="text/javascript">                                                                                                                                                                                                                                                                                                                                                                                                                       </script></head>
    <body>
        <div class="main-wrapper">
			<div class="account-page">
				<div class="container">
					<h3 class="account-title">Civil Pro </h3>
					<div class="account-box">
						<div class="account-wrapper">
							
							<div class="account-logo">
								<a href="#"><img src="assets/img/logo2.png" alt="Focus Technologies"></a>
							</div>


							<form method="post" id="loginfrm">
								<div class="form-group">									
									
									<input placeholder="Password" class="form-control floating" type="password" name="password" id="password">		
								</div>
								<div class="form-group">
									<input placeholder="Confirm Password" class="form-control floating" type="password" name="confirm_pass">
								</div>
								<div class="form-group text-center">
									
									<input class="btn btn-primary btn-block account-btn" type="submit" name="save_btn" value="submit">
								</div>
								
							</form>





	<?php

		if(isset($_GET['s'])){
			
			$abc = $_GET['s'];
			//echo $abc;die;
			$detail = 'SELECT * FROM users WHERE `otp_manage` = "'.$abc.'" ';
			$result_value = mysqli_query($conn,$detail);
			//print_r($result_value);
				while ($data_value = mysqli_fetch_array($result_value)) {		
				$res = $data_value['user_id'];
				//print_r($res);

				}
		
			
			}


		

		
	if(isset($_POST['save_btn'])){
	
		$npass = $_POST['password'];
		$cpass = $_POST['confirm_pass'];

		$pass_hash = md5($npass);

		$insert = 'UPDATE users SET `password` ="'.$pass_hash.'", `otp_manage` = ""  WHERE `user_id` = '.$res.' ';
		$update = mysqli_query($conn,$insert);
		//print_r($update);	
		if($update){
			echo "Password update successfully!";

		}else
		{
			echo "Password update failed!";
		}
		

	}
?>




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
                password: "required",
                confirm_pass: {
                    equalTo: "#password"
                }
            },
            messages: {
                password: "Enter Password",
                confirm_pass: " Enter Confirm Password Same as Password"
            }


		});

		</script>
    </body>
</html>