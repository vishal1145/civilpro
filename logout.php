<?php

$base_url= "http://$_SERVER[HTTP_HOST]/civilpro";

session_start();
unset($_SESSION['user_id']);
header("location:".$base_url);


?>