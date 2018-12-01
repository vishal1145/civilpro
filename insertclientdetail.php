<?php
$obj = new  connection();
$con = $obj->connect();

$firstname=$_POST['clientfname'];
$lastname=$_POST['clientlname'];
$username=$_POST['clientuname'];
$emailid=$_POST['clientmail'];
$password=$_POST['clientpass'];
$conpassword=$_POST['clientcpass'];
$clientid=$_POST['clientid'];
$phone=$_POST['clientph'];
$cname=$_POST['clientcompanyname'];	

$sql="INSERT INTO Client (first_name,last_name,user_name,email,password,client_id,phone_no,company) VALUES ('$firstname','$lastname','$username','$emailid','$password','$clientid','$phone','$cname')";

$insert_result=mysqli_query($con,$sql);
if($insert_result)
{
	echo ('Data inserted successfully');
}
else{
	echo ('Error:'.mysqli_error);
}	  