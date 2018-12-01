<?php

include "config/config.php";
$obj = new connection();
$con = $obj->connect();


$userid = $_POST['user_id1'];

$udata = " SELECT * from Users where user_id = '$userid'";
$queryudata = mysqli_query($con,$udata);
$fetchdata = mysqli_fetch_object($queryudata);

print_r($fetchdata);





?>