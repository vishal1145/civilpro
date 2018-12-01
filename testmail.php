<?php
$to = "qa75741@gmail.com"; 	//--------------------------    
				    $subject = "Your Recovered Password";
				    $message = "<h3> Please use this password to login </h3>";
				    $headers = "From : a1professionals.com";
				    
				    $headers = "MIME-Version: 1.0" . "\n";
				    $headers .= "Content-type:text/html;charset=UTF-8" . "\n";
	    			if(mail($to, $subject, $message, $headers)){
							echo "Please check the email id  .";
					    }
					    else{
					    	echo "Please Enter the valid Email id .";
					    }

?>