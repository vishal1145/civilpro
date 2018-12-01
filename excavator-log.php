<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
		<link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.png">
        <title>Excavator daily log - Civilpro</title>
		<link href="https://fonts.googleapis.com/css?family=Montserrat:300,400,500,600,700" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="assets/css/font-awesome.min.css">
        <link rel="stylesheet" type="text/css" href="assets/css/style.css">
		<!--[if lt IE 9]>
			<script src="assets/js/html5shiv.min.js"></script>
			<script src="assets/js/respond.min.js"></script>
		<![endif]-->
    <script type="text/javascript"></script><script type="text/javascript"></script><script type="text/javascript"></script><script type="text/javascript"></script>
	</head>
	<style>
	form.inner-form {
    width: 70%;
    margin: auto;
    box-shadow: 0 0 5px 4px #ccc;
    padding: 20px;
}
form.inner-form .r-fm input {
    width: 74%;
    height: 24px;
}
.col-cf label {
    margin-right: 10px;
}
form.inner-form input{
     border-bottom: 1px solid #ccc;
    border-top: none;
    border-right: none;
    border-left: none;
    border-radius: 2px;
}
.inner-form .account-title {
    margin-top: 0;
    font-weight: 600;
    font-size: 30px;
}
.col-cf1, .col-cf3 {
    padding-right: 0;
    margin-top: 20px;
}
.col-cf1 input[type="text"] {
    width: 54%;
    margin-left: 9px;
}
.col-cf3 input {
    width: 71%;
    margin-left: 6px;
}
.ccr {
    margin: 26px 0px;
}
.row.last.r-txt input, .row.last1.r-txt input {
    width: 100%;
    height: 95px;
    border: 1px solid #ccc;
    background: transparent;
}
form.inner-form table tr:first-child td {
    width: 70%;
}
form.inner-form table tr td:not(:first-child), form.inner-form table tr th:not(:first-child) {
    text-align: center;
}
form.inner-form table tbody tr td {
    padding-top: 5px;
}
form.inner-form table thead tr th {
    padding: 6px 6px;
    line-height: 21px;
}
form.inner-form table thead {
    background: #13beec;
    color: #fff;
    border: 1px solid #13beec;
}
.inner-form img.logo {
    width: 12%;
    margin: 0 auto 12px;
}
button.btn-sub {
    background: #13beec;
    border: none;
    color: #fff;
    height: 40px;
    padding: 0 33px;
    font-size: 15px;
    float: right;
    margin-top: 19px;
    border-radius: 5px;
}
	</style>
    <body>

<?php

$dbhost = 'localhost';
$dbuser = 'root';
$dbpass = 'Rock@7861';
$dbname = "civil_pro";
$conn = mysqli_connect($dbhost, $dbuser, $dbpass,$dbname);

?>


    	<?php
    		if(isset($_POST['excavator_form'])){
    		
    		$operator 			    = $_POST['operator'];
    		$site_area 			    = $_POST['site_area'];
        $hour_start         = $_POST['hour_start'];
    		$min_start  		    = $_POST['min_start'];
        $hour_finish        = $_POST['hour_finish'];
    		$min_finish 		    = $_POST['min_finish'];
    		$fuel_lavel 		    = $_POST['fuel_lavel'];
    		$engine_oil_lavel	  = $_POST['engine_oil_lavel'];
    		$oil_lavel 			    = $_POST['oil_lavel'];
    		$radiator_lavel 	  = $_POST['radiator_lavel'];
    		$transmission_lavel = $_POST['transmission_lavel'];
    		$fluids_leak		    = $_POST['fluids_leak'];
    		$fluid_level_comment= $_POST['fluid_level_comment'];
    		$air_conditioning	  = $_POST['air_conditioning'];
    		$bucket_teeth_pins	= $_POST['bucket_teeth_pins'];
    		$cleaning_products	= $_POST['cleaning_products'];
    		$damage_report		  = $_POST['damage_report'];
    		$fire_extinguisher	= $_POST['fire_extinguisher'];
    		$first_aid_kit		  = $_POST['first_aid_kit'];
    		$general_defects	  = $_POST['general_defects'];
    		$grease_lines_pins	= $_POST['grease_lines_pins'];
    		$hand_rails_door_handles= $_POST['hand_rails_door_handles'];
    		$horn 			       	= $_POST['horn'];
    		$hydraulic_hoses	  = $_POST['hydraulic_hoses'];
    		$lights 			      = $_POST['lights'];
    		$mirrors 			      = $_POST['mirrors'];
    		$panel_damage 	   	= $_POST['panel_damage'];
    		$radiator 			    = $_POST['radiator'];
    		$radiator_hoses 	  = $_POST['radiator_hoses'];
    		$seat_seatbelts 	  = $_POST['seat_seatbelts'];
    		$slew_motor_oil 	  = $_POST['slew_motor_oil'];
    		$tracks_chains_shoes= $_POST['tracks_chains_shoes'];
    		$windows_wipers 	  = $_POST['windows_wipers'];
    		$additional_notes 	= $_POST['additional_notes'];
        $final_start_hour   = $hour_start.$min_start;
        $final_end_hour   = $hour_finish.$min_finish;

        if($final_end_hour <= $final_start_hour){

          echo "<script type='text/javascript'>alert('Enter a valid time!')</script>";

        }else{
    		$sql = "INSERT INTO excavator (operator,site_area,hour_start,hour_finish,fuel_lavel,engine_oil_lavel,oil_lavel,radiator_lavel,transmission_lavel,fluids_leak,fluid_level_comment,air_conditioning,bucket_teeth_pins,cleaning_products,damage_report,fire_extinguisher,first_aid_kit,general_defects,grease_lines_pins,hand_rails_door_handles,horn,hydraulic_hoses,lights,mirrors,panel_damage,radiator,radiator_hoses,seat_seatbelts,slew_motor_oil,tracks_chains_shoes,windows_wipers,additional_notes) values('$operator','$site_area','$final_start_hour','$final_end_hour','$fuel_lavel','$engine_oil_lavel','$oil_lavel','$radiator_lavel','$transmission_lavel','$fluids_leak','$fluid_level_comment','$air_conditioning','$bucket_teeth_pins','$cleaning_products','$damage_report','$fire_extinguisher','$first_aid_kit','$general_defects','$grease_lines_pins','$hand_rails_door_handles','$horn','$hydraulic_hoses','$lights','$mirrors','$panel_damage','$radiator','$radiator_hoses','$seat_seatbelts','$slew_motor_oil','$tracks_chains_shoes','$windows_wipers','$additional_notes')";

    		 $result_data = mysqli_query($conn,$sql);

        		if($sql){
        			echo "<script type='text/javascript'>alert('Done successfully!')</script>";
        		}
        		else
        		{
        			echo "Fail";
        		}
       }


    		}
    	?>


        <div class="main-wrapper">
			<div class="account-page">
				<div class="container">
				<form action="" class="inner-form" id="excavator_log" method="post">
				    <img src="logo2.png" class="logo" alt="image">
					<h3 class="account-title">Excavator daily log</h3>
					
    <div class="row r-fm">
      <div class="col-md-6 col-sm-6 col-xs-12 col-cf">
	   <label>Operator:</label>
	   <input type="text" name="operator">
	  </div> 
	  
	  <div class="col-md-6 col-sm-6 col-xs-12 col-cf">
	   <label>Site Area:</label>
	   <input type="text" name="site_area">
	  </div>
	</div>  
	
	
	<div class="row r-fm2">
      <div class="col-md-4 col-sm-4 col-xs-12 col-cf1">
	   <label>Hour Start:</label>
	  <!--  <input type="text" name="hour_start"> -->
     <span class="start_time">Hour:</span><select name="hour_start">
      <?php 
      for($a= 1;$a<= 24;$a++ ){

       ?>
       <option value="<?php echo $a.':'; ?>"><?php echo $a; ?></option>
     <?php }     ?>
     </select>
     <span class="start_time">Min:</span><select name="min_start">
      <?php 
      for($b= 1;$b<= 60;$b++ ){

       ?>
       <option value="<?php echo $b; ?>"><?php echo $b; ?></option>
     <?php }     ?>
     </select>
     <?php echo date(); ?>
	  </div> 
	  
	  <div class="col-md-4 col-sm-4 col-xs-12 cf2 col-cf1">
	   <label>Hour Finish:</label>
	   <!-- <input type="text" name="hour_finish"> -->
     <span class="start_time">Hour:</span><select name="hour_finish">
      <?php 
      for($x= 1;$x<= 24;$x++){

       ?>
       <option value="<?php echo $x.':'; ?>"><?php echo $x; ?></option>
     <?php }     ?>
     </select>
     <span class="start_time">Min:</span><select name="min_finish">
      <?php 
      for($y= 1;$y<= 60;$y++){

       ?>
       <option value="<?php echo $y; ?>"><?php echo $y; ?></option>
     <?php }     ?>
     </select>
     
	  </div>
	  
	  <div class="col-md-4 col-sm-4 col-xs-12 col-cf3">
	   <label>Date:&nbsp;</label><?php echo date('d/m/Y'); ?>
	  </div>
	</div> 
	
	<div class="row tabl">
	    <div class="col-md-12 col-sm-12 ccr">
		<table style="width:100%">
		   <thead>
		     <tr>
			   <th>Fluid Levels</th>
			   <th>Pass</th>
			   <th>Fail</th>
			 </tr>
             </thead>
            <tbody>
             <tr>
              <td>Fuel Lavel</td>
              <td><input type="radio" name="fuel_lavel" value="pass" checked></td>
			  <td><input type="radio" name="fuel_lavel" value="fail"></td>
			 </tr>

             <tr>
              <td>Engine Oil Lavel</td>
              <td><input type="radio" name="engine_oil_lavel" value="pass"></td>
			  <td><input type="radio" name="engine_oil_lavel" value="fail" checked></td>
			 </tr>

              <tr>
              <td>Oil Lavel</td>
              <td><input type="radio" name="oil_lavel" value="pass" checked></td>
			  <td><input type="radio" name="oil_lavel" value="fail"></td>
			 </tr>

              <tr>
              <td>Radiator Lavel</td>
              <td><input type="radio" name="radiator_lavel" value="pass"></td>
			  <td><input type="radio" name="radiator_lavel" value="fail" checked></td>
			 </tr>	

             <tr>
              <td>Transmission Lavel</td>
              <td><input type="radio" name="transmission_lavel" value="pass" checked></td>
			  <td><input type="radio" name="transmission_lavel" value="fail"></td>
			 </tr>	
             
              <tr>
              <td>Fluids Leaks</td>
              <td><input type="radio" name="fluids_leak" value="pass"></td>
			  <td><input type="radio" name="fluids_leak" value="fail" checked></td>
			 </tr>	
           </tbody>
          </table>
		 </div>
       </div>
  
     <div class="row last r-txt">
	  <div class="col-md-12">
         <label class="area">Comments:</label>
         <input type="textarea" name="fluid_level_comment">
	  </div></div>	 
          		 
		<div class="row t2 tabl">
	    <div class="col-md-12 col-sm-12 ccr">
		<table style="width:100%">
		   <thead>
		     <tr>
			   <th>Inspection List</th>
			   <th>Pass</th>
			   <th>Fail</th>
			 </tr>
             </thead>
            <tbody>
             <tr>
              <td>Air Conditioning</td>
              <td><input type="radio" name="air_conditioning" value="pass"></td>
			  <td><input type="radio" name="air_conditioning" value="fail" checked></td>
			 </tr>

             <tr>
              <td>Bucket Teeth / Pins</td>
              <td><input type="radio" name="bucket_teeth_pins" value="pass" checked></td>
			  <td><input type="radio" name="bucket_teeth_pins" value="fail"></td>
			 </tr>

              <tr>
              <td>Cleaning Products</td>
              <td><input type="radio" name="cleaning_products" value="pass"></td>
			  <td><input type="radio" name="cleaning_products" value="fail" checked></td>
			 </tr>

              <tr>
              <td>Damage Report</td>
              <td><input type="radio" name="damage_report" value="pass" checked></td>
			  <td><input type="radio" name="damage_report" value="fail"></td>
			 </tr>	

             <tr>
              <td>Fire Extinguisher</td>
              <td><input type="radio" name="fire_extinguisher" value="pass"></td>
			  <td><input type="radio" name="fire_extinguisher" value="fail" checked></td>
			 </tr>	
             
              <tr>
              <td>First Aid Kit</td>
              <td><input type="radio" name="first_aid_kit" value="pass" checked></td>
			  <td><input type="radio" name="first_aid_kit" value="fail"></td>
			 </tr>	
			  <tr>
              <td>General Defects </td>
              <td><input type="radio" name="general_defects" value="pass" checked></td>
			  <td><input type="radio" name="general_defects" value="fail"></td>
			 </tr>
			  <tr>
              <td>Grease Lines / Pins</td>
              <td><input type="radio" name="grease_lines_pins" value="pass"></td>
			  <td><input type="radio" name="grease_lines_pins" value="fail" checked></td>
			 </tr>
			  <tr>
              <td>Hand Rails / Door Handles</td>
              <td><input type="radio" name="hand_rails_door_handles" value="pass"></td>
			  <td><input type="radio" name="hand_rails_door_handles" value="fail" checked></td>
			 </tr>
			  <tr>
              <td>Horn</td>
              <td><input type="radio" name="horn" value="pass" checked></td>
			  <td><input type="radio" name="horn" value="fail"></td>
			 </tr>
			  <tr>
              <td>Hydraulic Hoses</td>
              <td><input type="radio" name="hydraulic_hoses" value="pass" checked></td>
			  <td><input type="radio" name="hydraulic_hoses" value="fail"></td>
			 </tr>
			  <tr>
              <td>Lights</td>
              <td><input type="radio" name="lights" value="pass"></td>
			  <td><input type="radio" name="lights" value="fail" checked></td>
			 </tr>
			 <tr>
              <td>Mirrors</td>
              <td><input type="radio" name="mirrors" value="pass"></td>
			  <td><input type="radio" name="mirrors" value="fail" checked></td>
			 </tr>
			 <tr>
              <td>Panel Damage</td>
              <td><input type="radio" name="panel_damage" value="pass" checked></td>
			  <td><input type="radio" name="panel_damage" value="fail"></td>
			 </tr>
			 <tr>
              <td>Radiator</td>
              <td><input type="radio" name="radiator" value="pass" checked></td>
			  <td><input type="radio" name="radiator" value="fail"></td>
			 </tr>
			 <tr>
              <td>Radiator Hoses</td>
              <td><input type="radio" name="radiator_hoses" value="pass"></td>
			  <td><input type="radio" name="radiator_hoses" value="fail" checked></td>
			 </tr>
			 <tr>
              <td>Seat / Seat Belts</td>
              <td><input type="radio" name="seat_seatbelts" value="pass" checked></td>
			  <td><input type="radio" name="seat_seatbelts" value="fail"></td>
			 </tr>
			 <tr>
              <td>Slew Motor Oil</td>
              <td><input type="radio" name="slew_motor_oil" value="pass"></td>
			  <td><input type="radio" name="slew_motor_oil" value="fail" checked></td>
			 </tr>
			 <tr>
              <td>Tracks / Chains / Shoes</td>
              <td><input type="radio" name="tracks_chains_shoes" value="pass" checked></td>
			  <td><input type="radio" name="tracks_chains_shoes" value="fail"></td>
			 </tr>
			 <tr>
              <td>Windows / Wipers</td>
              <td><input type="radio" name="windows_wipers" value="pass" checked></td>
			  <td><input type="radio" name="windows_wipers" value="fail"></td>
			 </tr>
           </tbody>
          </table>
		 </div>
       </div>  
        	
<div class="row last1 r-txt">
	  <div class="col-md-12">
         <label class="area">Additional Notes:</label>
         <input type="textarea" name="additional_notes">
	  </div>
	   <div class="col-md-12">
	  <button type="submit" name="excavator_form" class="btn-sub">Submit</button>
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




<style type="text/css">
    .error{
        color: red;
    }
</style>


<script type="text/javascript">
		
 jQuery(document).ready(function(){
 
         

            jQuery("#excavator_log").validate({

                rules: {

                    operator: "required",
                    site_area: "required",
                    hour_start: "required",
                    hour_finish: "required",
                    fluid_level_comment: "required",
                    additional_notes: "required",
                },
                messages: {
                operator: "Please enter your Operator value",
                site_area: "Please enter your Site Area value",
                hour_start: "Please enter your Hour Start value",
                fluid_level_comment: "Please enter your Fluid Level Comment",
                additional_notes: "Please enter your Additional Notes",

            	},

            	submitHandler: function(form) {
              	form.submit();
                }	


            });
});
</script>


    </body>
</html>