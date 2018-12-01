<?php 
include "header.php";
include "sidebar.php";	
$obj = new connection();
$con = $obj->connect(); 

?>



			 <div class="page-wrapper">
                <div class="content container-fluid">
					<div class="row">
						<div class="col-sm-8">
							<h4 class="page-title"> Chat </h4>
						</div>
						
					</div>

						
						<?php
	
							$z = 1;
							$get_email = "SELECT * FROM employee";
					          $email_result = mysqli_query($con,$get_email);
					         if ($email_result->num_rows > 0) {
					   	     
						    	while($row = $email_result->fetch_assoc()) {
						    		 $employee_name = $row['username']."<br>";
						    		echo "<li class='employee'>".$z." 
						    			  <a href='".$row['empl_id']."'>". $employee_name. "</a></li>";
						    		$z++;
						    		
						   		 }
					   		 }
								
							?>


					</div>
				</div>

				