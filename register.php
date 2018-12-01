<?php

session_start();
include "config/config.php";
$obj = new connection();
$con = $obj->connect();

if(isset($_SESSION['user_id'])){
	header("location:". $base_url1);
}


if(isset($_POST['Register'])){

	$user_nam = $_POST['user_nam'];
	$user_email = $_POST['user_email'];
	$user_pas = md5($_POST['user_pas']);
	$user_re_pass = $_POST['user_re_pass'];

	$check_email_exist = "SELECT * FROM Users WHERE email = '$user_email' OR first_name = '$user_nam'";
	$all_rows = mysqli_query($con,$check_email_exist);
	$rows_res = mysqli_num_rows($all_rows);

		if($rows_res == 1){

			//echo "Enter the Unique Email and Username .";
		}
		else{
			if($rows_res != 1){
		 $add_users = "INSERT INTO users 
		(user_name,first_name,last_name,phone,email,password,birthday,address,country,state,pin_code,gender,user_employee_id,pass_token,img,user_role) Values 
		('$user_nam','$user_nam','last name','0','$user_email','$user_pas','Birthday','Address','Country','State','Pin Code','Male','','','','0')";
		$inst_user = mysqli_query($con,$add_users);
		$record = mysqli_insert_id($con);
				//echo'<pre>';print_r($record);echo'</pre>';die('here');
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
        <title>Register - HRMS admin template</title>
		<link href="https://fonts.googleapis.com/css?family=Montserrat:300,400,500,600,700" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="assets/css/font-awesome.min.css">
        <link rel="stylesheet" type="text/css" href="assets/css/style.css">
		<!--[if lt IE 9]>
			<script src="assets/js/html5shiv.min.js"></script>
			<script src="assets/js/respond.min.js"></script>
		<![endif]-->
    <script type="text/javascript"></script><script type="text/javascript"></script></head>
    <body>
        <div class="main-wrapper">
			<div class="account-page">
				<div class="container">
					<h3 class="account-title">Management Registration</h3>
					<div class="account-box">
						<div class="account-wrapper">
							<div class="account-logo">
								<a href="index.html"><img src="assets/img/logo2.png" alt="Focus Technologies"></a>
							</div>
							<form method="post" id="Registerfrm">
							
							<?php

								if($rows_res == 1){

									echo "<span style='font-weight:600;color:red;font-size: 14px;	'>Enter the Unique Email and Username .</span>";

								}
								else{

									if($record > 0){
										echo "<span style='font-weight:600;color:Green;font-size: 14px;	'>New Account created successfully </span>";
								}

						}								
							?>

								<div class="form-group">
									<!-- form-focus <label class="control-label">Username</label>-->		
									<input placeholder="Username" class="form-control floating" type="text" name="user_nam" id="user_nam">
								</div>
								<div class="form-group">
								<!-- form-focus <label class="control-label">Email</label>-->				
									<input placeholder="Email" class="form-control floating" type="text" name="user_email">
								</div>
								<div class="form-group">
								<!--  form-focus <label class="control-label">Password</label>-->		
									<input placeholder="Password" class="form-control floating" type="password" name="user_pas" id="user_pas">
								</div>
								<div class="form-group">
								<!-- form-focus <label class="control-label">Repeat Password</label>-->	
									<input placeholder="Repeat Password" class="form-control floating" type="password" name="user_re_pass">
								</div>
								<div class="form-group text-center">
									<input type="submit" class="btn btn-primary btn-block account-btn" value="Register" name="Register">
								</div>
								<div class="text-center">
									<a href="<?php echo "$base_url"; ?>">Already have an account?</a>
									<!--<a href="#">Already have an account?</a>-->
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
			
		$("#Registerfrm").validate({

			rules: {
				user_nam: {
					required: true
				},
				user_email: {
					required: true,
					email: true	
				},
				user_pas: {
					required: true,
					minlength: 5

				},
				user_re_pass: {
					required: true,
					equalTo: "#user_pas"
				}
			},
			messages: {

				user_nam:{
					required: "Please enter a Username"
				},
				user_email:{
					required: "Please enter a Email",
					email: "Please enter the email id" 
				},
				user_pas:{
					required: "Please Enter the password",
					minlength: "Your password must be at least 5 characters long",
					equalTo: "Please enter the same password as above"

				},
				user_re_pass: {
					required:  "Please Enter the Confirm Password",
					equalTo: "Please enter the same password as above"
				}
			}
		});

		</script>

    </body>
</html>