<?php
ob_start();
include('header.php');
include('sidebar.php');

$obj = new connection();
$con = $obj->connect();

	$user_id = $_SESSION['user_id'];

 //if(isset($_SESSION['user_id'])){
     /*if(isset($_POST['create_employe'])){
         $employee_fname = $_POST['fname'];
         $employee_lname = $_POST['lname'];
         $employee_uname = $_POST['uname'];
         $employee_email = $_POST['email'];
         $employee_pass  = $_POST['pass'];
         $employee_cpass = $_POST['cpass'];
         $employee_eid   = $_POST['eid'];
         $employee_jdate = $_POST['jdate'];
         $employee_phone = $_POST['phone'];
         $employee_comp  = $_POST['company'];
         $employee_desi  = $_POST['designation'];

         $get_email = "SELECT * FROM employee where `email` = '$employee_email'";
          $email_result = mysqli_query($con,$get_email);
         if ($email_result->num_rows > 0) {
    
    while($row = $email_result->fetch_assoc()) {
      //print_r($row);
      echo "<script> alert('Email already exit!'); </script>";
     // alert("Email already exit!");
      
    }
  }else{

        $insert_emp = "INSERT INTO employee(first_name,last_name,username,email,password,confirm_pass,employee_id,joining_date,phone,img,company,designation,device_id,device_type) VALUES('$employee_fname','$employee_lname','$employee_uname','$employee_email','".md5($employee_pass)."','".md5($employee_cpass)."','$employee_eid','$employee_jdate',$employee_phone,'','$employee_comp',$employee_desi,'','')";
       
         $result_data = mysqli_query($con,$insert_emp);
         if($result_data > 0){

        	 header("Refresh:0");
         }

         print_r($result_data);die;
     }
 }*/



	

	if(isset($_POST['create_employe'])){
         $employee_fname = $_POST['fname'];
         $employee_lname = $_POST['lname'];
         $employee_uname = $_POST['uname'];
         $employee_email = $_POST['email'];
         $employee_pass  = $_POST['pass'];
         $employee_cpass = $_POST['cpass'];
         $employee_eid   = $_POST['eid'];
         $employee_jdate = $_POST['jdate'];
         $employee_phone = $_POST['phone'];
         $employee_comp  = $_POST['company'];
         $employee_desi  = $_POST['designation'];
         $time_set  = time();

         $get_email = "SELECT * FROM employee where `email` = '$employee_email'";
          $email_result = mysqli_query($con,$get_email);
         if ($email_result->num_rows > 0) {
    
    while($row = $email_result->fetch_assoc()) {
      //print_r($row);
      echo "<script> alert('Email already exit!'); </script>";
     // alert("Email already exit!");
      
    }
  }else{

      echo  $insert_emp = "INSERT INTO employee(first_name,last_name,username,email,password,confirm_pass,employee_id,joining_date,phone,img,company,designation,device_id,device_type,time_set) VALUES('$employee_fname','$employee_lname','$employee_uname','$employee_email','".md5($employee_pass)."','".md5($employee_cpass)."','$employee_eid','$employee_jdate',$employee_phone,'','$employee_comp',$employee_desi,'','',$time_set)";
       
      
         $result_data = mysqli_query($con,$insert_emp);
         if($result_data > 0){
         		
         		echo "Employee add successfully!";
        	 header("Refresh:0");
         }

        // print_r($result_data);die;
     }
 }



     if(isset($_POST['employee_update'])){

     $idd = $_POST['employee_data'];
    $emp_fname = $_POST['fname'];
    $emp_lname = $_POST['lname'];
    $emp_uname = $_POST['uname'];
    $emp_email = $_POST['email'];
    $emp_pass  = $_POST['pass'];
    $emp_cpass = $_POST['cpass'];
    $emp_phone = $_POST['phone'];
    $emp_jdate = $_POST['jdate'];
    $company_cat = $_POST['company_cat'];
    $emp_designation = $_POST['designation_cat'];
    $emp_employee_id = $_POST['eid'];

     $update = "UPDATE employee SET first_name='$emp_fname',last_name='$emp_lname',username='$emp_uname',email='$emp_email',password=md5('$emp_pass'),confirm_pass=md5('$emp_cpass'),phone='$emp_phone',employee_id='$emp_employee_id',joining_date='$emp_jdate',company='$company_cat',designation='$emp_designation' where empl_id= '$idd' ";

    $get_data = mysqli_query($con,$update);

    

    if($get_data >0){

        header('Refresh:0');
        
    }
    else{
        echo "No update!";
    }

  }

	if(isset($_POST['search_project'])){

		/*echo "<pre>";
        print_r($_POST);
        echo "</pre>";*/
		$find_id = $_POST['employee_id'];
         $find_name = $_POST['employee_nameee'];
     $find_designation = $_POST['desig'];

$SearchArray = array();
  if(!empty($find_id)){
  $SearchArray[] = "employee_id = '$find_id' ";
  }
   if(!empty($find_name)){
  $SearchArray[] = "first_name like '%$find_name%' ";
  }
   if(!empty($find_designation)){
  $SearchArray[] = "designation = '$find_designation'";
  }

   $searchQuery = implode(" AND ",$SearchArray);
 //echo "SELECT * FROM employee where $searchQuery";

         $get_employee =("SELECT * FROM employee where $searchQuery ORDER BY `time_set` DESC");
        $result = mysqli_query($con,$get_employee);


	}else{
					$get_employee = "SELECT * FROM employee ORDER BY `time_set` DESC";
                        $result = mysqli_query($con,$get_employee);
	}
					

?>

<div class="main-wrapper">
            <div class="page-wrapper">
                <div class="content container-fluid">
					<div class="row">
						<div class="col-xs-4">
							<h4 class="page-title">Employee</h4>
						</div>
						<div class="col-xs-8 text-right m-b-30">
							<a href="#" class="btn btn-primary pull-right rounded" data-toggle="modal" data-target="#add_employee"><i class="fa fa-plus"></i> Add Employee</a>
							<div class="view-icons">
								<a href="employees.php" class="grid-view btn btn-link"><i class="fa fa-th"></i></a>
								<a href="employees-list.php" class="list-view btn btn-link active"><i class="fa fa-bars"></i></a>
							</div>
						</div>
					</div>
					<div class="row filter-row">
						  <form action="" method="post">
						<div class="col-sm-3 col-xs-6">  
							<div class="form-group form-focus">
								<label class="control-label">Employee ID</label>
								<input type="text" class="form-control floating" name="employee_id" />
							</div>
						</div>
						<div class="col-sm-3 col-xs-6">  
							<div class="form-group form-focus">
								<label class="control-label">Employee Name</label>
								<input type="text" class="form-control floating" name="employee_nameee" />
							</div>
						</div>
						<div class="col-sm-3 col-xs-6"> 
							<div class="form-group form-focus select-focus">
								<label class="control-label">Designation</label>
								<select class="select floating" name="desig">
								<option value="">Select Designation</option>

								<?php
								$get_designation = 'SELECT * FROM designation';
								$result_value = mysqli_query($con,$get_designation);
								while ($data_value = mysqli_fetch_array($result_value)) {								/*echo '<pre>'; print_r($data_value); echo '</pre>';*/

								?>
								<option value="<?php echo $data_value['designation_id']; ?>"><?php echo $data_value['designation_name']; ?></option>

								<?php } ?>
									
								</select>
							</div>
						</div>
						<div class="col-sm-3 col-xs-6">  
							 <!-- <input type="button" name="rearch_res" class="ref_page btn btn-success btn-block" value="Search"> -->

							 <input type="submit" class="btn btn-success btn-block" value="Search" name="search_project">  

							  <input type="button" class="ref_page btn btn-info btn-block" value="Reset">
							
						</div>  
						</form>   
                    </div>
					<div class="row">
						<div class="col-md-12">
							<div class="table-responsive">
								<table class="table table-striped custom-table datatable">
									<thead>
										
										<tr>
											<!-- <th style="display: none;">Time</th> -->
											<th style="display: none">Time</th>
											<th style="width:30%;">Name</th>
											<th>Employee ID</th>
											<th>Email</th>
											<th>Mobile</th>
											<th>Join Date</th>
											<th>Role</th>
											<th class="text-right">Action</th>
										</tr>
									</thead>
									<tbody>

							<?php
							
                        while($row = mysqli_fetch_array($result))
							{
								$desig = $row['designation'];
								$get_desi = "SELECT * FROM designation where designation_id = $desig";
								$get_designation = mysqli_query($con,$get_desi);
								$designation_name = mysqli_fetch_array($get_designation);
								$des_name = $designation_name['designation_name']; 
							
                                               
								?>
										<tr>
											
				<?php
				//$time_set = $row['designation'];
				$time_set = "SELECT * FROM employee ORDER BY `time_set` DESC";
				$time_setting = mysqli_query($con,$time_set);
				$time_setting_value = mysqli_fetch_array($time_setting);
				//print_r($time_setting_value);
				 ?>




											<td style="display: none"><?php echo $time_setting_value['time_set']; ?></td>
											<td>
												<a href="" class="avatar">
												<?php 
$imgurl  = $row['img'];
												if($row['img'] == "")
													$imgurl  = "https://serving.plexop.net/media/4/1/87288.jpg";

													?>


												<img src="<?php echo $imgurl; ?>"  />

												</a>

												<h2>
											
													<a href="#"><?php echo $row['first_name']; ?> 
													<span>
														<?php echo $des_name; ?>
													</span>
													</a>
												</h2>
											</td>
											<td><?php echo $row['employee_id']; ?></td>
											<td><?php echo $row['email']; ?></td>
											<td><?php echo $row['phone']; ?></td>
											<td><?php echo $row['joining_date']; ?></td>
											<td>
												<?php  $desi_value = $row['designation']; ?>
											<?php
                                            $abc = new connection();
                                            $con = $abc->connect();
                                            $designation = "SELECT * FROM designation WHERE designation_id = $desi_value";
					                        $resulttt = mysqli_query($con,$designation);

					                        while($rowww = mysqli_fetch_array($resulttt))
					                                        {

					                        ?>

												<div class="dropdown">
													<a class="btn btn-white btn-sm rounded dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><?php echo $rowww['designation_name']; ?><i class="caret"></i></a>
													<!--<ul class="dropdown-menu">
														<li><a href="#"><?php echo $row['designation']; ?></a></li>
														
													</ul>-->
												</div>
											<?php } ?>
											</td>
											<td class="text-right">
												<div class="dropdown">
													<a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
													<ul class="dropdown-menu pull-right">
														<li><a href="#" data-toggle="modal" data-target="#edit_employee<?php echo $row['empl_id']; ?>"><i class="fa fa-pencil m-r-5"></i> Edit</a></li>
														<li><a href="#" data-toggle="modal" data-target="#delete_employee<?php echo $row['empl_id']; ?>"><i class="fa fa-trash-o m-r-5"></i> Delete</a></li>
													</ul>
												</div>
											</td>
										</tr>


			

			<!--  edit data employee   -->


<div id="edit_employee<?php echo $row['empl_id']; ?>" class="modal custom-modal fade" role="dialog"><form action="" method="post" class="edit_form_validation">
				<div class="modal-dialog">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<div class="modal-content modal-md">
						<div class="modal-header">
						
							<h4 class="modal-title">Edit Employee</h4>
						</div>
				
							<div class="row">
									<div class="col-sm-6">
										<div class="form-group">
											<label class="control-label">First Name <span class="text-danger">*</span></label>
											<input type="hidden" name="employee_data" value="<?php echo $row['empl_id']; ?>" class="form-control" >
											<input name="fname" class="form-control" value="<?php echo $row['first_name']; ?>" type="text">
										</div>
									</div>
									<div class="col-sm-6">
										<div class="form-group">
											<label class="control-label">Last Name</label>
											<input name="lname" class="form-control" value="<?php echo $row['last_name']; ?>" type="text">
										</div>
									</div>
									<div class="col-sm-6">
										<div class="form-group">
											<label class="control-label">Username <span class="text-danger">*</span></label>
											<input name="uname" class="form-control" value="<?php echo $row['username']; ?>" type="text">
										</div>
									</div>
									<div class="col-sm-6">
										<div class="form-group">
											<label class="control-label">Email <span class="text-danger">*</span></label>
											<input name="email" class="form-control" value="<?php echo $row['email']; ?>" type="email">
										</div>
									</div>
									<div class="col-sm-6">
										<div class="form-group" style="position:relative">
											<label class="control-label">Password</label>
											<input id="clientpassword" style="padding-right:50px;" name="pass" class="form-control" value="<?php echo $row['password']; ?>" type="password">
											<i style="position: absolute;position: absolute;top: 60%;right: 20px;font-size: 14px;" id="show1" onclick="visible()" class="fa fa-eye"></i>
											<i style="position: absolute;position: absolute;top: 60%;right: 20px;font-size: 14px;" id="show2" onclick="visible()" class="fa fa-eye-slash"></i>
										</div>
									</div>
									<div class="col-sm-6">
										<div class="form-group">
											<label class="control-label">Confirm Password</label>
											<input name="cpass" class="form-control" value="<?php echo $row['confirm_pass']; ?>" type="password">
										</div>
									</div>
									<div class="col-sm-6">  
										<div class="form-group">
											<label class="control-label">Employee ID <span class="text-danger">*</span></label>
											<input name="eid" type="text" value="<?php echo $row['employee_id']; ?>" readonly="" class="form-control floating">
										</div>
									</div>
									<div class="col-sm-6">  
										<div class="form-group">
											<label class="control-label">Joining Date <span class="text-danger">*</span></label>
											<div class="cal-icon"><input class="form-control datetimepicker" value="<?php echo $row['joining_date']; ?>" type="text" name="jdate"></div>
										</div>
									</div>
									<div class="col-sm-6">
										<div class="form-group">
											<label class="control-label">Phone </label>
											<input name="phone" class="form-control" value="<?php echo $row['phone']; ?>" type="text">
										</div>
									</div>
									<div class="col-sm-6">
										<div class="form-group">
											<label class="control-label">Company</label>
											<select name="company_cat" class="select">
												<option value="">Global Technologies</option>
												<option value="1">Delta Infotech</option>
											</select>
										</div>
									</div>
									<div class="col-sm-6">
										<div class="form-group">
											<label class="control-label">Designation</label>
											<select name="designation_cat" class="select">
											<option>Select Designation</option>
                                        <?php
								$get_designation = 'SELECT * FROM designation';
								$result_value = mysqli_query($con,$get_designation);
								while ($data_value = mysqli_fetch_array($result_value)) {?>
<option value="<?php echo $data_value['designation_id'];?>" <?php if($row['designation'] == $data_value['designation_id']){ echo "selected";}  ?>><?php echo $data_value['designation_name'];?> </option>
												
												<?php } ?>
											</select>
										</div>
									</div>
								</div>
								
								
								<div class="m-t-20 text-center">
                                    <button type="submit" name="employee_update" class="btn btn-primary">Save Changes</button>
                                </div>

                          </form>     
					</div>

				</div>
			</div>

			<?php
			if(isset($_POST['delete_id_data'])){
				$request_id = $_POST['delete_id'];

				$delete = "DELETE FROM employee WHERE empl_id= $request_id";
				$final = mysqli_query($con,$delete);

				if($final >0){
					header("Refresh:0");
				}
				else{
					echo "Not Delete!";
				}
			}

			?>

<div id="delete_employee<?php echo $row['empl_id']; ?>" class="modal custom-modal fade" role="dialog">
                <div class="modal-dialog">
                    <div class="modal-content modal-md">
                        <div class="modal-header">
                            <h4 class="modal-title">Delete Employee</h4>
                        </div>
                        <form method="post" action="">
                            <div class="modal-body card-box">
                                <p>Are you sure want to delete this?</p>
                                <input type="hidden" name="delete_id" value="<?php echo $row['empl_id'];?>" >
                                <div class="m-t-20"> <a href="#" class="btn btn-default" data-dismiss="modal">Close</a>
                                    <button name="delete_id_data" type="submit" class="btn btn-danger">Delete</button>
                                    
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

			<!--  edit data employee   -->


										<?php
												}
										?>




									</tbody>
								</table>
							</div>
						</div>
					</div>
                </div>
				











<div id="add_employee" class="modal custom-modal fade" role="dialog">
				<div class="modal-dialog">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<div class="modal-content modal-lg">
						<div class="modal-header">
							<h4 class="modal-title">Add Employee</h4>
						</div>
						<div class="modal-body">

						<form name="add-employee" class="emplyoee_info" method="post" action="" enctype="multipart/form-data">
							
								<div class="row">
									<div class="col-sm-6">
										<div class="form-group">
											<label class="control-label">First Name <span class="text-danger">*</span></label>
											<input name="fname" class="form-control" type="text">
										</div>
									</div>
									<div class="col-sm-6">
										<div class="form-group">
											<label class="control-label">Last Name</label>
											<input name="lname" class="form-control" type="text">
										</div>
									</div>
									<div class="col-sm-6">
										<div class="form-group">
											<label class="control-label">Username <span class="text-danger">*</span></label>
											<input name="uname" class="form-control" type="text">
										</div>
									</div>
									<div class="col-sm-6">
										<div class="form-group">
											<label class="control-label">Email <span class="text-danger">*</span></label>
											<input name="email" class="form-control" type="email">
										</div>
									</div>
									<div class="col-sm-6">
										<div class="form-group" style="position: relative;">
											<label class="control-label">Password</label>
											<input style="padding-right:50px;" name="pass" id="pswrd" class="form-control" type="password">
											<i style="position: absolute;position: absolute;top: 60%;right: 20px;font-size: 14px;" id="show1" onclick="visible2()" class="fa fa-eye"></i>
											<i style="position: absolute;position: absolute;top: 60%;right: 20px;font-size: 14px;" id="show2" onclick="visible2()" class="fa fa-eye-slash"></i>
										</div>
									</div>
									<div class="col-sm-6">
										<div class="form-group">
											<label class="control-label">Confirm Password</label>
											<input name="cpass" class="form-control" type="password">
										</div>
									</div>
									<div class="col-sm-6">  
										<div class="form-group">
											<label class="control-label">Employee ID <span class="text-danger">*</span></label>
											<input name="eid" type="text" class="form-control">
										</div>
									</div>
									<div class="col-sm-6">  
										<div class="form-group">
											<label class="control-label">Joining Date <span class="text-danger">*</span></label>
											<div class="cal-icon"><input name="jdate" class="form-control datetimepicker" type="text"></div>
										</div>
									</div>
									<div class="col-sm-6">
										<div class="form-group">
											<label class="control-label">Phone </label>
											<input name="phone" class="form-control" type="text">
											<!-- min="10" max="11" -->
										</div>
									</div>
									<div class="col-sm-6">
										<div class="form-group">
											<label class="control-label">Company</label>
											<select name="company" class="select">


												<option value="">Global Technologies</option>
												<option value="1">Delta Infotech</option>
											</select>
										</div>
									</div>
									<div class="col-sm-6">
										<div class="form-group">
											<label class="control-label">Designation</label>

											<select name="designation" class="select">
												<option value="">select Designation</option>
													
					 <?php 
					 $designation = "SELECT * FROM designation";
                        $resulttt = mysqli_query($con,$designation);

 					while($rowwww = mysqli_fetch_array($resulttt))
                    {
                    ?>
					<option value="<?php echo $rowwww['designation_id']; ?>"><?php echo $rowwww['designation_name']; ?></option>
								<?php } ?>				
												
											</select>
										</div>
									</div>
								</div>
								<!-- <div class="table-responsive m-t-15">
									<table class="table table-striped custom-table">
										<thead>
											<tr>
												<th>Module Permission</th>
												<th class="text-center">Read</th>
												<th class="text-center">Write</th>
												<th class="text-center">Create</th>
												<th class="text-center">Delete</th>
												<th class="text-center">Import</th>
												<th class="text-center">Export</th>
											</tr>
										</thead>
										<tbody>
											<tr>
												<td>Holidays</td>
												<td class="text-center">
													<input checked="" type="checkbox">
												</td>
												<td class="text-center">
													<input type="checkbox">
												</td>
												<td class="text-center">
													<input type="checkbox">
												</td>
												<td class="text-center">
													<input type="checkbox">
												</td>
												<td class="text-center">
													<input type="checkbox">
												</td>
												<td class="text-center">
													<input type="checkbox">
												</td>
											</tr>
											<tr>
												<td>Leave Request</td>
												<td class="text-center">
													<input checked="" type="checkbox">
												</td>
												<td class="text-center">
													<input checked="" type="checkbox">
												</td>
												<td class="text-center">
													<input checked="" type="checkbox">
												</td>
												<td class="text-center">
													<input type="checkbox">
												</td>
												<td class="text-center">
													<input type="checkbox">
												</td>
												<td class="text-center">
													<input type="checkbox">
												</td>
											</tr>
											<tr>
												<td>Clients</td>
												<td class="text-center">
													<input checked="" type="checkbox">
												</td>
												<td class="text-center">
													<input checked="" type="checkbox">
												</td>
												<td class="text-center">
													<input checked="" type="checkbox">
												</td>
												<td class="text-center">
													<input type="checkbox">
												</td>
												<td class="text-center">
													<input type="checkbox">
												</td>
												<td class="text-center">
													<input type="checkbox">
												</td>
											</tr>
											<tr>
												<td>Projects</td>
												<td class="text-center">
													<input checked="" type="checkbox">
												</td>
												<td class="text-center">
													<input type="checkbox">
												</td>
												<td class="text-center">
													<input type="checkbox">
												</td>
												<td class="text-center">
													<input type="checkbox">
												</td>
												<td class="text-center">
													<input type="checkbox">
												</td>
												<td class="text-center">
													<input type="checkbox">
												</td>
											</tr>
											<tr>
												<td>Tasks</td>
												<td class="text-center">
													<input checked="" type="checkbox">
												</td>
												<td class="text-center">
													<input checked="" type="checkbox">
												</td>
												<td class="text-center">
													<input checked="" type="checkbox">
												</td>
												<td class="text-center">
													<input checked="" type="checkbox">
												</td>
												<td class="text-center">
													<input type="checkbox">
												</td>
												<td class="text-center">
													<input type="checkbox">
												</td>
											</tr>
											<tr>
												<td>Chats</td>
												<td class="text-center">
													<input checked="" type="checkbox">
												</td>
												<td class="text-center">
													<input checked="" type="checkbox">
												</td>
												<td class="text-center">
													<input checked="" type="checkbox">
												</td>
												<td class="text-center">
													<input checked="" type="checkbox">
												</td>
												<td class="text-center">
													<input type="checkbox">
												</td>
												<td class="text-center">
													<input type="checkbox">
												</td>
											</tr>
											<tr>
												<td>Assets</td>
												<td class="text-center">
													<input checked="" type="checkbox">
												</td>
												<td class="text-center">
													<input checked="" type="checkbox">
												</td>
												<td class="text-center">
													<input checked="" type="checkbox">
												</td>
												<td class="text-center">
													<input checked="" type="checkbox">
												</td>
												<td class="text-center">
													<input type="checkbox">
												</td>
												<td class="text-center">
													<input type="checkbox">
												</td>
											</tr>
											<tr>
												<td>Timing Sheets</td>
												<td class="text-center">
													<input checked="" type="checkbox">
												</td>
												<td class="text-center">
													<input checked="" type="checkbox">
												</td>
												<td class="text-center">
													<input checked="" type="checkbox">
												</td>
												<td class="text-center">
													<input checked="" type="checkbox">
												</td>
												<td class="text-center">
													<input type="checkbox">
												</td>
												<td class="text-center">
													<input type="checkbox">
												</td>
											</tr>
										</tbody>
									</table>
								</div> -->
								<div class="m-t-20 text-center">
									<button id="emply_id" type="submit" name="create_employe" class="btn btn-primary">Create Employee</button>
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
		<script type="text/javascript" src="assets/js/jquery.dataTables.min.js"></script>
		<script type="text/javascript" src="assets/js/dataTables.bootstrap.min.js"></script>
		<script type="text/javascript" src="assets/js/jquery.slimscroll.js"></script>
		<script type="text/javascript" src="assets/js/select2.min.js"></script>
		<script type="text/javascript" src="assets/js/moment.min.js"></script>
		<script type="text/javascript" src="assets/js/bootstrap-datetimepicker.min.js"></script>
		<script type="text/javascript" src="assets/js/app.js"></script>
   

   <style type="text/css">
   .error{
   	color: red;
   }
   </style>

   <script src="https://cdn.jsdelivr.net/jquery.validation/1.15.1/jquery.validate.min.js"></script>


<script type="text/javascript">

function visible() {
  var x = document.getElementById("clientpassword");
  if (x.type === "password") {
    x.type = "text";
	document.getElementById("show1").style.display="block";
	document.getElementById("show2").style.display="none";
  } else {
	document.getElementById("show1").style.display="none";
	document.getElementById("show2").style.display="block";
    x.type = "password";
  }
}

//password visible or hide case logic
function visible2() {
  var x = document.getElementById("pswrd");
  if (x.type === "password") {
    x.type = "text";
	document.getElementById("show1").style.display="block";
	document.getElementById("show2").style.display="none";
  } else {
	document.getElementById("show1").style.display="none";
	document.getElementById("show2").style.display="block";
    x.type = "password";
  }
}

    
        $(document).ready(function(){
            $(".emplyoee_info").validate({

                rules: {

                    fname: "required",
                    lname: "required",
                    uname: "required",
                    email: "required",
                    pass :{ 
                    		required: true,
                    		minlength: 6,
                    	}, 
			        cpass: { 
			        			required: true,
			                    equalTo: "#pswrd",
			                     minlength: 6,
			               },
                    eid  : "required",
                    jdate: "required",
                    phone:
			          {
			            required: true,
			            minlength: 10, 
			          },
                    company:"required",
                    designation:"required",
                },

                messages: {
                fname: "Please enter your First Name",
                  lname: "Please enter your Last Name",
                  uname: "Please enter your User Name",
                  email: "Please enter your Email",
                  pass : { 
                			 required:"Please enter your password",
                			 minlength: "Your password must be at least 6 characters",	
              				 },
       					  //minlength: "Your password must be at least 6 characters long"
       					
                  cpass: { 
                			 required:"Please enter your password",
                			// minlength: "Your confirm password must be at least 6 characters",	
              				 },
                  eid  : "Please enter your Employee ID",
                  jdate: "Please enter your Joining Date",
                  phone: {required: "Please enter your Phone",
       					  minlength: "Your Phone must be at least 10 characters long"},
                  company: "Please enter your Company",
                  designation: "Please enter your Designation",

              },

              submitHandler: function(form) {
              form.submit();
                }

              

            });
            $(".edit_form_validationqwee").validate({

                rules: {

                    fname: "required",
                    
                    uname: "required",
                    email: "required",
                    pass : "required",
                    cpass: "required",
                    eid  : "required",
                    jdate: "required",
                    
                },

                messages: {
                fname: "Please enter your First Name",
                  
                  uname: "Please enter your User Name",
                  email: "Please enter your Email",
                  pass : "Please enter your Password",
                  cpass: "Please enter your Confirm Password",
                  eid  : "Please enter your Employee ID",
                  jdate: "Please enter your Joining Date",
                 

              },

              submitHandler: function(form) {
              form.submit();
                }

              

            });
 
});




    jQuery('.datetimepicker').datetimepicker({
        //alert('ddfd');
        format: 'YYYY-MM-DD',
       // timeFormat: 'HH:mm'
     });

</script>
<script type="text/javascript">
	$(document).ready(function() {
    $('#example').DataTable( {
        "order": [[ 0, "desc" ]]
    } );

});

</script>
