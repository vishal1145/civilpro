<?php
include('header.php');
include('sidebar.php');
$obj = new connection();
$con = $obj->connect();

 $user_id = $_SESSION['user_id'];

 if(isset($_SESSION['user_id'])){
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
         $img_url = $_POST['empfile'];
         $time_set = time();
         //echo $employee_fname;
         $get_email = "SELECT * FROM employee where `email` = '$employee_email'";
          $email_result = mysqli_query($con,$get_email);
         if ($email_result->num_rows > 0) {
    // output data of each row
    while($row = $email_result->fetch_assoc()) {
      //print_r($row);
      echo "<script> alert('Email already exit!'); </script>";
     // alert("Email already exit!");
      //echo "hello";
    }
  }else{
           //if($emailrowscout = 0 ){



          $insert_emp = "INSERT INTO employee(first_name,last_name,username,email,password,confirm_pass,employee_id,joining_date,phone,img,company,designation,device_id,device_type,time_set) VALUES('$employee_fname','$img_url','$employee_lname','$employee_uname','$employee_email','".md5($employee_pass)."','".md5($employee_cpass)."','$employee_eid','$employee_jdate',$employee_phone,'','$employee_comp',$employee_desi,'','',$time_set)";
         //die;
        // die('here');
      
         $result_data = mysqli_query($con,$insert_emp);
         if($result_data > 0){
                
           
             $id_array = mysqli_query($con,"SELECT empl_id FROM employee where `email` = '$employee_email' limit 1");
             $emp_id_obj = mysqli_fetch_object($id_array);
             $emp_id = $emp_id_obj->empl_id;


    $data = '{  "PRCID":"ChatGroup" }';
     $options = array(
        'http' => array(
          'method'  => 'GET',
          'content' =>  $data ,
          'header'=>  "Content-Type: application/json\r\n" .
                      "Accept: application/json\r\n"
          )
      );
      
      $url = "http://157.230.57.197:9100/api/employee/".$emp_id;
      $context  = stream_context_create( $options );
      $result = file_get_contents( $url, false, $context );
      $response = json_decode( $result );
    $response2= $response;

    echo "<script>location.href='http://$_SERVER[HTTP_HOST]/civilpro/employees.php';</script>";

            }
      }
     }

            if(isset($_POST['delete_id_data'])){
            $id = $_POST['delete_id'];
            echo $delete = "DELETE FROM employee WHERE empl_id= $id ";
          
            $result = mysqli_query($con,$delete);
            
            if($result >0){
                
                header("Refresh:0");
                
            }else{
                echo "Not delete!";
                
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

if(isset($_REQUEST['empl-search'])){

		$find_id = $_POST['empl_find_id'];
		$find_name = $_POST['empl_find_name'];
	 
        $find_designation = $_POST['empl_find_designation'];

        $SearchArray = array();

          if(!empty($find_id)){
            $SearchArray[] = "employee_id = '$find_id'";
          }
          
          if(!empty($find_name)){
            $SearchArray[] = "first_name like '%$find_name%'";
          }

          if(!empty($find_designation)){
            $SearchArray[] = "designation = '$find_designation'";
          }

          $searchQuery = implode(" AND ",$SearchArray);

          $get_employee =("SELECT * FROM employee where $searchQuery ORDER BY `time_set` DESC");
          $result = mysqli_query($con,$get_employee);
          $rowscout = $result->num_rows;
          $rowscut = 1;
          if($rowscout > 0 ){
            echo "grater then 0 .";
          }else{
            $rowscut = $rowscout;

          }                
   }else {             
                 $get_employee = "SELECT * FROM employee ORDER BY `time_set` DESC";
                $result = mysqli_query($con,$get_employee);
        }

                $designation = "SELECT * FROM designation";
                $resulttt = mysqli_query($con,$designation);
            
       ?>

<script>
//password visible or hide case logic
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
  var x = document.getElementById("pswrd1");
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
   
</script>
            <div class="page-wrapper">
                <div class="content container-fluid">
                    <div class="row">
                        <div class="col-xs-4">
                            <h4 class="page-title">Employee</h4>
                            <?php
                            if(isset($_POST['empl-search'])){
                              if($rowscut == 0){
                                echo "<h4 style='color:red;'>Record not match. </h4>";
                              }
                            }
                            ?>
                        </div>
                        <div class="col-xs-8 text-right m-b-20">
                            <a href="#" class="btn btn-primary rounded pull-right" data-toggle="modal" data-target="#add_employee"><i class="fa fa-plus"></i> Add Employee</a>
                            <div class="view-icons">
                                <a href="employees.php" class="grid-view btn btn-link active"><i class="fa fa-th"></i></a>
                                <a href="employees-list.php" class="list-view btn btn-link"><i class="fa fa-bars"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="row filter-row">
                    <form action="" method="post" name="employee_search">
                           <div class="col-sm-3 col-xs-6">  
                                <div class="form-group form-focus">
                                    <label class="control-label">Employee ID</label>
                                    <input name="empl_find_id" type="text" class="form-control floating" />
                                </div>
                           </div>
                           <div class="col-sm-3 col-xs-6">  
                                <div class="form-group form-focus">
                                    <label class="control-label">Employee Name</label>
                                    <input name="empl_find_name" type="text" class="form-control floating" />
                                </div>
                           </div>
                           <div class="col-sm-3 col-xs-6">
                                <div class="form-group form-focus select-focus">
                                    <label class="control-label">Designation</label>
                                    <select name="empl_find_designation" class="select floating">
                                        <option value="0">Select Designation</option>
                                        
                                    <?php
                                    while($rowww = mysqli_fetch_array($resulttt))
                                        {
                                            ?>
                                        <option value="<?php echo $rowww['designation_id']; ?>"><?php echo $rowww['designation_name']; ?></option>
                                        
                                    <?php } ?>
                                    </select>
                                </div>
                           </div>
                           <div class="col-sm-3 col-xs-6">  
                           <input type="submit" name="empl-search" class="btn btn-success btn-block" value="search">
						   <input type="submit" class="ref_page btn btn-info btn-block" value="Reset">
                                <!-- <a href="#" class="btn btn-success btn-block"> Search </a>  -->
                           </div>  
                           </form>   
                    </div>


                    <?php

                        
                        ?>
             <div class="row staff-grid-row">
                    <?php while($row = mysqli_fetch_array($result))
                    {
						//designationa get
						 $desig = $row['designation'];
						  $get_desi = "SELECT * FROM designation where designation_id = $desig";
                       $get_designation = mysqli_query($con,$get_desi);
					   $designation_name = mysqli_fetch_array($get_designation);
                    $des_name = $designation_name['designation_name']; 
                    ?>

                    
                        <div class="col-md-4 col-sm-4 col-xs-6 col-lg-3">
                            <div class="profile-widget">
                                <div class="profile-img">
                                <a href="" class="avatar">
												 <?php 
                                     $imgurl  = $row['img'];
												if($row['img'] == "")
													$imgurl  = "https://cdn4.vectorstock.com/i/1000x1000/12/13/construction-worker-icon-person-profile-avatar-vector-15541213.jpg";

													?>


												<img src="<?php echo $imgurl; ?>"  /> 

												</a>
                                </div>
                                <div class="dropdown profile-action">
                                    <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
                                    <ul class="dropdown-menu pull-right">
                                        <li><a href="#" class="edit_click" data-toggle="modal" data-target="#edit_employee<?php echo $row['empl_id']; ?>"><i class="fa fa-pencil m-r-5"></i> Edit</a></li>
                                        <li><a href="#" data-toggle="modal" data-target="#delete_employee<?php echo $row['empl_id']; ?>"><i class="fa fa-trash-o m-r-5"></i> Delete</a></li>
                                    </ul>
                                </div>
                                <h4 class="user-name m-t-10 m-b-0 text-ellipsis"><a href="#"><?php echo $row['first_name'];?></a></h4>
                                <div class="small text-muted"><?php echo $des_name; ?></div>
                            </div>
                        </div>


                                
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

		
<div id="edit_employee<?php echo $row['empl_id']; ?>" class="modal custom-modal fade" role="dialog">
                <div class="modal-dialog">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
                    <div class="modal-content modal-md">
                        <div class="modal-header">
                            <h4 class="modal-title">Edit Employee</h4>
                        </div>
                        <form method="post" action="">
                           <form action="" method="post" class="employee_info_data">
                            
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="control-label">First Name <span class="text-danger">*</span></label>
                                            <input name="employee_data" value="<?php echo $row['empl_id']; ?>" type="hidden">
                                            <input name="fname" class="form-control" value="<?php echo $row["first_name"]; ?>" type="text">
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
                                        <div class="form-group" style="position: relative;">
                                            <label class="control-label">Password</label>
                                            <input style="padding-right:50px;" id="clientpassword" name="pass" class="form-control" value="<?php echo $row['password']; ?>" type="password">
                                            <i style="position: absolute;position: absolute;top: 60%;right: 20px;font-size: 14px;" id="show1" onclick="visible()" class="fa fa-eye"></i>
												<i style="position: absolute;position: absolute;top: 60%;right: 20px;font-size: 14px;" id="show2" onclick="visible()" class="fa fa-eye-slash"></i>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="control-label">Confirm Password</label>
                                            <input name="cpass" class="form-control" value="<?php echo $row['confirm_pass']; ?>" class="employeepassword" type="password">
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
                                            <div class="cal-icon"><input name="jdate" value="<?php echo $row['joining_date']; ?>" class="form-control datetimepicker" type="text"></div>
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
                                            <select name="company_cat" value="<?php echo $row['company']; ?>" class="select">
                                                 <option selected><?php echo $row['company']; ?></option>
                                                 <?php $select_val = $row['company']; ?>
                                                 <?php if($select_val == 'Global Technologies'){

                                                     }
                                                     else{
                                                         echo '<option>Global Technologies</option>';
                                                         } ?>

                                                         <?php if($select_val == 'Delta Infotech'){

                                                             }else{
                                                                 echo '<option>Delta Infotech</option>';
                                                                 } ?>

                                                         <?php if($select_val == 'International Software Inc'){

                                                             }else{
                                                                 echo '<option>International Software Inc</option>';
                                                                 } ?>
                                                 <!-->
                                                <!-- <option>Global Technologies</option>
                                                <option>Delta Infotech</option>
                                                <option >International Software Inc</option> -->
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="control-label">Designation</label>
                                            <select name="designation_cat" class="select">
                      <?php
                           $desig = $row['designation'];
                            $get_desi = "SELECT * FROM designation where designation_id = $desig";
                            $get_designation = mysqli_query($con,$get_desi);
                            $designation_name = mysqli_fetch_array($get_designation);
                            $des_name = $designation_name['designation_name']; 

                      ?>                   
                                            <option value="<?php echo $row['designation']; ?>"><?php echo $des_name; ?></option>
                                            <?php

                                            $designationnn = "SELECT * FROM designation";
                      			  $desi_value = mysqli_query($con,$designationnn);

                                    while($edit_data = mysqli_fetch_array($desi_value))
                                        {
                                            ?>
                                             <option value="<?php echo $edit_data['designation_id']; ?>"><?php echo $edit_data['designation_name']; ?></option>
                                            <?php } ?>
                                            
                                                <!-- <option>Web Developer</option>
                                                <option>Web Designer</option>
                                                <option>SEO Analyst</option> -->
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="table-responsive m-t-15">
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
                                </div>
                                <div class="m-t-20 text-center">
                                    <button type="submit" name="employee_update" class="btn btn-primary">Save Changes</button>
                                </div>
                        </form>
                    </div>
                </div>
            </div> 


<script type="text/javascript">
    
       /* $(document).ready(function(){
           
 
});*/

</script>







                        <?php
                            }
                            
                        ?>
                    
            <div id="add_employee" class="modal custom-modal fade" role="dialog">
                <div class="modal-dialog">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <div class="modal-content modal-lg">
                        <div class="modal-header">
                            <h4 class="modal-title">Add Employee</h4>
                        </div>
                        <div class="modal-body">
                        <form name="add-employee" class="emplyoee_info" method="post" action="" enctype="multipart/form-data">
                            <form class="m-b-30">
                                <div class="row">
                                <div class="col-sm-12">
                               
                                         <input type="file"  (change)="upload($event)" value="Upload Image" name="submit">
                                        <input type="text" value="https://cdn4.vectorstock.com/i/1000x1000/12/13/construction-worker-icon-person-profile-avatar-vector-15541213.jpg" name="empfile">
                                  </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="control-label">First Name <span class="text-danger">*</span></label>
                                            <input class="form-control" type="text" name="fname">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="control-label">Last Name</label>
                                            <input class="form-control" type="text" name="lname">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="control-label">Username <span class="text-danger">*</span></label>
                                            <input class="form-control" type="text" name="uname">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="control-label">Email <span class="text-danger">*</span></label>
                                            <input class="form-control" type="email" name="email">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group" style="position: relative;">
                                            <label class="control-label">Password</label>
                                            <input style="padding-right:50px;" class="form-control" type="password" id="pswrd1" name="pass">
                                            <i style="position: absolute;position: absolute;top: 60%;right: 20px;font-size: 14px;" id="show1" onclick="visible2()" class="fa fa-eye"></i>
											<i style="position: absolute;position: absolute;top: 60%;right: 20px;font-size: 14px;" id="show2" onclick="visible2()" class="fa fa-eye-slash"></i>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="control-label">Confirm Password</label>
                                            <input class="form-control" type="password" name="cpass">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">  
                                        <div class="form-group">
                                            <label class="control-label">Employee ID <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" name="eid">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">  
                                        <div class="form-group">
                                            <label class="control-label">Joining Date <span class="text-danger">*</span></label>
                                            <div class="cal-icon"><input class="form-control datetimepicker" type="text" name="jdate"></div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="control-label">Phone </label>
                                            <input class="form-control" type="text" name="phone">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="control-label">Company</label>
                                            <select name="company" class="select">
                                                <option>Global Technologies</option>
                                                <option>Delta Infotech</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="control-label">Designation</label>
                                            <select name="designation" class="select_design">
                                            <option value="">select Designation</option>
                                            <?php
                                            $abc = new connection();
                                            $con = $abc->connect();
                                            $designation = "SELECT * FROM designation";
                        $resulttt = mysqli_query($con,$designation);

                        while($rowww = mysqli_fetch_array($resulttt))
                                        {

                        ?>
                                            
                                            <option value="<?php echo $rowww['designation_id']; ?>"><?php echo $rowww['designation_name']; ?></option>

                                            <?php } ?>
                                                <!-- <option>Web Developer</option>
                                                <option>Web Designer</option>
                                                <option>SEO Analyst</option> -->
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
        <script type="text/javascript" src="assets/js/jquery.slimscroll.js"></script>
        <script type="text/javascript" src="assets/js/select2.min.js"></script>
        <script type="text/javascript" src="assets/js/moment.min.js"></script>
        <script type="text/javascript" src="assets/js/bootstrap-datetimepicker.min.js"></script>
        <script type="text/javascript" src="assets/js/app.js"></script>
    </body>
</html>
<?php } ?>

<style type="text/css">
    .error{
        color: red;
    }
</style>

<script src="https://cdn.jsdelivr.net/jquery.validation/1.15.1/jquery.validate.min.js"></script>


<script type="text/javascript">

 
        $(document).ready(function(){
 
         
            $( "#empfile" ).change(function() {
  alert( "Handler for .change() called." );
});

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
                          equalTo: "#pswrd1",
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


             $(".employee_info_data").validate({

                rules: {

                    fname: "required",
                    lname: "required",
                    uname: "required",
                    email: "required",
                    pass : {

                      required : true,
                      minlength : 6,
                    },

                    cpass: {

                        equalTo: ".employeepassword",
                        minlength : 6,
                    },

                    eid  : "required",
                    jdate: "required",
                    phone: "required",
                    company:"required",
                    designation:"required",
                },

                messages: {
                fname: "Please enter your First Name",
                  lname: "Please enter your Last Name",
                  uname: "Please enter your User Name",
                  email: "Please enter your Email",
                  password: { 
                 required:"The Password is Required"

               },
                  eid  : "Please enter your Employee ID",
                  jdate: "Please enter your Joining Date",
                  phone: "Please enter your Phone",
                  company: "Please enter your Company",
                  designation: "Please enter your Designation",

              },

              submitHandler: function(form) {
              form.submit();
                }

              

            });


 jQuery('#openmodal').click(function(){
	  $('#add_employee').modal('show'); 
 )};
             
 
});





    jQuery('.datetimepicker').datetimepicker({
        //alert('ddfd');
        format: 'YYYY-MM-DD',
       // timeFormat: 'HH:mm'
     });




     
</script>
