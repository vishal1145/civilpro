<?php
session_start();
ob_start();
include "header.php";
include "sidebar.php";
$obj = new  connection();
$con = $obj->connect();

/**------ Add client  ------- **/

if(isset ($_POST['addclient'])){
$firstname 	= $_POST['firstname'];
$lastname 	= $_POST['lastname'];
$username 	= $_POST['username'];
$emailid 	= $_POST['emailid'];
$password 	= $_POST['password'];
$clientid 	= $_POST['clientid'];
$phone 		= $_POST['phone'];
$cname 		= $_POST['companyname'];
$img_url    = $_POST['empfile'];
$time_set 	= time(); 

$sql="INSERT INTO Client (first_name,last_name,user_name,email,password,client_id,phone_no,img,company,birthday,address,gender,state,country,pincode,time_set) VALUES ('$firstname','$lastname','$username','$emailid','$password','$clientid','$phone','$img_url ','$cname','','','','','','',$time_set)";

$insert_result=mysqli_query($con,$sql);
if($insert_result == true)
{

	header("Location: clients.php");
}
else{
	echo ('Error:'.mysqli_error);
}	
} 

/**------ Edit client ------- **/

if (isset($_POST['updateform'])) {

	$editid  = $_POST['client_edit_id'];
    $firstname = (isset($_POST['firstname']) ? $_POST['firstname'] : "");
	$lastname = (isset($_POST['lastname']) ? $_POST['lastname'] : "");
    $username = (isset($_POST['username']) ? $_POST['username'] : ""); 
    $clientemail = (isset($_POST['clientemail']) ? $_POST['clientemail'] : ""); 
    $clientpass = (isset($_POST['clientpass']) ? $_POST['clientpass'] : ""); 
    $clientid = (isset($_POST['clientid']) ? $_POST['clientid'] : "");
    $clientph = (isset($_POST['clientph']) ? $_POST['clientph'] : ""); 	
    $company = (isset($_POST['company']) ? $_POST['company'] : "");	
	$img_url    = $_POST['empfile1'];

	$sql ="UPDATE Client SET first_name='$firstname', last_name='$lastname', user_name='$username', email='$clientemail', password='$clientpass', client_id='$clientid', phone_no='$clientph', company='$company', img='$img_url' WHERE id=$editid";
	
	$update=mysqli_query($con,$sql);
						if($update == true){
	                     header('Location: clients.php');
                                  }
                        else{
	                     echo ('Error:'.mysqli_error);
                            }	
						} 		

/**------ Delete client ------- **/

if (isset($_POST['delete_id_data'])) {
$id= $_POST['delet_to_id'];				
$del="delete from Client where id= $id ";
$delete=mysqli_query($con,$del);
if($delete==true){
header('Location: clients.php');
 }
                        else{
	                     echo ('Error:'.mysqli_error);
                            }	
						}	
						
/**------ Search client ------- **/

if(isset($_REQUEST['searchclient'])){							
    $clientid= $_POST['searchclientid'];
    $clientname= $_POST['searchclientname'];
	$companyname= $_POST['searchcompany'];	
	$sql_serch =[];	
	if(!empty($clientid)){		
		$sql_serch[]=" client_id = '$clientid' ";
	}
	if(!empty($clientname)){
		
			$sql_serch[]=" first_name like '%$clientname%' ";
	}
	if(!empty($companyname)){
			$sql_serch[]=" company like '%$companyname%' ";		
	}
  $makeQuery = implode("AND",$sql_serch);   
  $result= mysqli_query($con,"SELECT * FROM Client WHERE $makeQuery ORDER BY `Client`.`time_set` DESC");

}
    else{		
               $result= mysqli_query($con,"SELECT * FROM Client ORDER BY `Client`.`time_set` DESC");						
}
				
?>






<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js" type="text/javascript"></script>
			<script src = "https://sdk.amazonaws.com/js/aws-sdk-2.6.10.min.js"  type="text/javascript"> </script> 
			<script type="text/javascript">
    //password visible or hide case logic
    function visible() {
        var x = document.getElementById("clientpassword");
        if (x.type === "password") {
            x.type = "text";
            document.getElementById("show1").style.display = "block";
            document.getElementById("show2").style.display = "none";
        } else {
            document.getElementById("show1").style.display = "none";
            document.getElementById("show2").style.display = "block";
            x.type = "password";
        }
    }

function visible2() {
    var x = document.getElementById("pswrd");
    if (x.type === "password") {
        x.type = "text";
        document.getElementById("show3").style.display = "block";
        document.getElementById("show4").style.display = "none";
    } else {
        document.getElementById("show3").style.display = "none";
        document.getElementById("show4").style.display = "block";
        x.type = "password";
    }
}




$(document).ready(function() {
    jQuery('.edit').click(function() {
        $('#edit_client').modal('show');
debugger;
        var id = jQuery(this).attr("data-edit");
        var firstname = jQuery(this).attr("data-firstname");
        var lastname = jQuery(this).attr("data-lastname");
        var username = jQuery(this).attr("data-username");
        var email = jQuery(this).attr("data-email");
        var password = jQuery(this).attr("data-password");
        var conpassword = jQuery(this).attr("data-password");
        var clientid = jQuery(this).attr("data-clientid");
        var ph = jQuery(this).attr("data-ph");
        var company = jQuery(this).attr("data-company");
		var img_url = jQuery(this).attr("data-img-url");

        jQuery("#client_edit_id").val(id);
        jQuery("#first_name").val(firstname);
        jQuery("#last_name").val(lastname);
        jQuery("#user_name").val(username);
        jQuery("#clientemail").val(email);
        jQuery("#clientpassword").val(password);
        jQuery("#clientconpassword").val(conpassword);
        jQuery("#client-id").val(clientid);
        jQuery("#clientph").val(ph);
        jQuery("#companyname").val(company);
		jQuery("#empfile1").val(img_url);
    });
});

$(document).ready(function() {
    jQuery("#addclientform").validate({
        rules: {
            firstname: "required",
            username: "required",
            emailid: "required",
            clientid: "required",
            phone: {
                required: true,
                minlength: 10,
                maxlength: 11,
            },
            companyname: "required",
            password: {
                required: true,
                minlength: 6,
            },
            confirmpass: {
                equalTo: "#pswrd",
                minlength: 6,
            }
        },
        messages: {
            firstname: "Please Enter Your Name",
            username: "Please Enter Your Username",
            emailid: "Please Enter Your Email",
            clientid: "Please Enter Your Client ID",
            phone: {
                required: "Please Enter Your Contact Number",
                minlength: "Please enter at least 10 characters.",
                maxlength: "Please enter no more than 11 characters.",
            },
            companyname: "Please Enter Your Company Name",
            password: {
                required: "The Password is Required"

            }
        }
    });
});

$(document).ready(function() {
    jQuery("#editclientform").validate({
        rules: {
            firstname: "required",
            username: "required",
            clientid: "required",
            clientemail: "required",
            client_ph: "required",
            company: "required",
            clientpass: {
                required: true,
                minlength: 6,
            },
            conpass: {
                equalTo: "#clientpassword",
                minlength: 6,
            }
        },
        messages: {
            firstname: "Please Enter Your Name",
            username: "Please Enter Your Username",
            clientemail: "Please Enter Your Email",
            clientid: "Please Enter Your Client ID",
            client_ph: "Please Enter Your Contact Number",
            company: "Please Enter Your Company Name",
            clientpass: {
                required: "The Password is Required"

            }
        }
    });
});



function generateUUID() {
    var d = new Date().getTime();
    var uuid = 'xxxxxxxxxxxxxxxyxxxxxxxxxxxxxxx'.replace(/[xy]/g, function(c) {
        var r = (d + Math.random() * 16) % 16 | 0;
        d = Math.floor(d / 16);
        return (c == 'x' ? r : (r & 0x3 | 0x8)).toString(16);
    });
    return uuid;
};

$(document).ready(function() {


            callapi({
                PRCID: 'MAXEMP'
            }).then(function(res) {
                $("#eidcontrol").val(res.id)
            });

			function uploadTOAWS(that){
				var send_file = that.files[0];
                const fileName = send_file.name;
                const fileName1 = generateUUID() + fileName.substring(fileName.indexOf("."), fileName.length);
                let photoKey = fileName1;
                photoKey = "Quacck/" + "123" + "/" + photoKey;
                var albumBucketName = 'dolphino';
                var bucketRegion = 'us-west-2';
                var IdentityPoolId = 'us-west-2:ff182092-2a76-489c-9d58-45ba742d9e7d'
                AWS.config.update({
                    region: 'us-west-2', //'us-west-2',
                    credentials: new AWS.CognitoIdentityCredentials({
                        IdentityPoolId: IdentityPoolId
                    })
                });
                var aws = new AWS.S3({
                    apiVersion: '2012-10-17', //'2006-03-01',
                    params: {
                        Bucket: albumBucketName
                    }
                });
                aws.upload({
                    Key: photoKey,
                    Body: send_file,
                    ACL: "public-read"
                }, function(err, data) {
                    if (err) {
						
                        return alert("There was an error uploading your Image: ");
                    } else {

                        $("#empfile").val(data.Location);
						document.getElementById("loader_img2").style.display = "none";
						$("#empfile1").val(data.Location);
						document.getElementById("loader_img").style.display = "none";
                        console.log(data);
                    }
                });
			}

            $("#empic").change(function() {
				document.getElementById("loader_img2").style.display = "block";
                uploadTOAWS(this);
            });

			$("#empic1").change(function() {
				document.getElementById("loader_img").style.display = "block";
                uploadTOAWS(this);
            });

});

//$('#loader_img').show();

// main image loaded ?
//$('#empfile1').on('load', function(){
  // hide/remove the loading image
  $('#loader_img').hide();
//});
            </script>



<div class="page-wrapper">

                <div class="content container-fluid">
					<div class="row">
						<div class="col-sm-4 col-xs-3">
							<h4 class="page-title">Clients</h4>

						</div>
						<div class="col-sm-8 col-xs-9 text-right m-b-20">
							<a href="#" class="btn btn-primary rounded pull-right" data-toggle="modal" data-target="#add_client"><i class="fa fa-plus"></i> Add Client</a>
							<!-- <div class="view-icons">
								<a href="clients.php" class="grid-view btn btn-link active"><i class="fa fa-th"></i></a>
								<a href="clients-list.php" class="list-view btn btn-link"><i class="fa fa-bars"></i></a>
							</div> -->
						</div>
					</div>			
					
					
                    <div class="row filter-row">
					<form action="" method="post">

						<div class="col-sm-3 col-xs-6">  
							<div class="form-group form-focus">
								<label class="control-label">Client ID</label>
								<input type="text" name="searchclientid" class="form-control floating" />
							</div>
						</div>
						<div class="col-sm-3 col-xs-6">  
							<div class="form-group form-focus">
								<label class="control-label">Client Name</label>
								<input type="text" name="searchclientname" class="form-control floating" />
							</div>
						</div>
						
						<div class="col-sm-3 col-xs-6"> 
							<div class="form-group form-focus select-focus">
								<select name="searchcompany" class="select floating"> 
								 <option value="" disabled selected>Select Company</option>
								<?php 
								$selectcompany="SELECT DISTINCT company FROM Client";
                                 $getcompany = mysqli_query($con,$selectcompany);								
								while($rowcompany = mysqli_fetch_array($getcompany)){ ?>								
									<option value="<?php echo $rowcompany['company']?>"><?php echo $rowcompany['company']?></option>
								<?php } ?>
									
								</select>
							</div>
						</div>					
						<div class="col-sm-3 col-xs-6">  
							<input type="submit" name="searchclient" value="Search" class="btn btn-success btn-block"/>
							<input type="reset" class="ref_page btn btn-info btn-block" value="Reset">
						</div> 
</form>						
                    </div>							
					
					<div class="row staff-grid-row">
					<?php while($row = mysqli_fetch_array($result))
                    { 				
				    ?>
						<div class="col-md-4 col-sm-4 col-xs-6 col-lg-3">
							<div class="profile-widget">
								<div class="profile-img">									
								<a href="" class="avatar">
												<?php 
                                     $imgurl  = $row['img'];
												if($row['img'] == "")
													$imgurl  = "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSmRgVKJ4PxPoxFWVEVgKqJZ_f152FxwaboW-CsTXgZTz_fA_xqpg";

													?>


												<img src="<?php echo $imgurl; ?>"  />

												</a>
								</div>
								<div class="dropdown profile-action">
									<a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
									<ul class="dropdown-menu pull-right">
										<li><a href="#" class="edit" data-edit="<?php echo $row['id'];?>" data-img-url="<?php echo $imgurl; ?>" data-firstname="<?php echo $row['first_name'];?>" data-lastname="<?php echo $row['last_name']; ?>" data-username="<?php echo $row['user_name']; ?>" data-email="<?php echo $row['email']; ?>" data-password="<?php echo $row['password']; ?>" data-clientid="<?php echo $row['client_id']; ?>" data-ph="<?php echo $row['phone_no']; ?>" data-company="<?php echo $row['company']; ?>"><i class="fa fa-pencil m-r-5"></i> Edit</a></li>
										<li><a href="#" data-toggle="modal" data-target="#delete_client<?php echo $row['id']; ?>"><i class="fa fa-trash-o m-r-5"></i> Delete</a>		
										</li>
									</ul>
								</div>
								<h4 class="user-name m-t-10 m-b-0 text-ellipsis"><a href="client-profile.html"> </a></h4>
								<h5 class="user-name m-t-10 m-b-0 text-ellipsis"><a href="client-profile.php?id=<?php echo $row['id']; ?>"><?php echo $row['first_name']; ?></a></h5>
								<div class="small text-muted"><?php echo $row['company']; ?></div>
								<!-- <a href="chat.php" class="btn btn-default btn-sm m-t-10">Message</a> -->
								<a href="client-profile.php?id=<?php echo $row['id'];?>" class="btn btn-default btn-sm m-t-10">View Profile</a>
							</div>
						</div>						
			<div id="delete_client<?php echo $row['id']; ?>" class="modal custom-modal fade" role="dialog">
				<div class="modal-dialog">
					<div class="modal-content modal-md">
						<div class="modal-header">
							<h4 class="modal-title">Delete Employee</h4>
						</div>
						<form action="" method="post">
							<div class="modal-body card-box">
								<p>Are you sure want to delete this?</p>
								<input type="hidden" name="delet_to_id" value="<?php echo $row['id']; ?>">
								<div class="m-t-20"> <a href="#" class="btn btn-default" data-dismiss="modal">Close</a>
									<button type="submit" name="delete_id_data" class="btn btn-danger">Delete</button>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>				
						<?php 
						} 
						?>
					</div>				
                </div>
					
			<?php include "notification-box.php"; ?>	
            </div>
			<div id="add_client" class="modal custom-modal fade" role="dialog">
				<div class="modal-dialog">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<div class="modal-content modal-lg">
						<div class="modal-header">
							<h4 class="modal-title">Add Client</h4>
						</div>
						<div class="modal-body">
							<div class="m-b-30">
								<form name="add-client" id="addclientform" action="" method="post">

									<div class="row">
									<div class="col-sm-12">
									<img id="loader_img2" style="display:none"  src="https://loading.io/spinners/ellipsis/lg.discuss-ellipsis-preloader.gif" width="50">  
							   <input type="file" value="Upload Image" id="empic">
							  <input type="hidden" value="https://cdn4.vectorstock.com/i/1000x1000/12/13/construction-worker-icon-person-profile-avatar-vector-15541213.jpg" name="empfile" id="empfile">
						</div>
										<div class="col-md-6">
											<div class="form-group">
												<label class="control-label">First Name <span class="text-danger">*</span></label>
												<input class="form-control" type="text" name="firstname" id="fname">
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<label class="control-label">Last Name</label>
												<input name="lastname" id="lname" class="form-control" type="text">
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<label class="control-label">Username <span class="text-danger">*</span></label>
												<input name="username" id="uname" class="form-control" type="text">
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<label class="control-label">Email <span class="text-danger">*</span></label>
												<input name="emailid" id="e-id" class="form-control floating" type="email">
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group" style="position:relative">
												<label class="control-label">Password</label>
												<input style="padding-right:50px;" name="password" id="pswrd" class="form-control" type="password">
												<i style="position: absolute;position: absolute;top: 60%;right: 20px;font-size: 14px;" id="show3" onclick="visible2()" class="fa fa-eye"></i>
												<i style="position: absolute;position: absolute;top: 60%;right: 20px;font-size: 14px;" id="show4" onclick="visible2()" class="fa fa-eye-slash"></i>
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<label class="control-label">Confirm Password</label>
												<input name="confirmpass" class="form-control" type="password">
											</div>
										</div>
										<div class="col-md-6">  
											<div class="form-group">
												<label class="control-label">Client ID <span class="text-danger">*</span></label>
												<input readonly="readonly"  name="clientid" id="eidcontrol"  class="form-control floating" type="text">
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<label class="control-label">Phone </label>
												<input name="phone" id="ph" class="form-control" type="text">
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<label class="control-label">Company Name</label>
												<input name="companyname" id="cname" class="form-control" type="text">
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
													<td>Projects</td>
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
														<input checked="" type="checkbox">
													</td>
													<td class="text-center">
														<input checked="" type="checkbox">
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
														<input checked="" type="checkbox">
													</td>
													<td class="text-center">
														<input checked="" type="checkbox">
													</td>
												</tr>
												<tr>
													<td>Chat</td>
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
														<input checked="" type="checkbox">
													</td>
													<td class="text-center">
														<input checked="" type="checkbox">
													</td>
												</tr>
												<tr>
													<td>Estimates</td>
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
														<input checked="" type="checkbox">
													</td>
													<td class="text-center">
														<input checked="" type="checkbox">
													</td>
												</tr>
												<tr>
													<td>Invoices</td>
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
														<input checked="" type="checkbox">
													</td>
													<td class="text-center">
														<input checked="" type="checkbox">
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
														<input checked="" type="checkbox">
													</td>
													<td class="text-center">
														<input checked="" type="checkbox">
													</td>
												</tr>
											</tbody>
										</table>
									</div> -->
									<div class="m-t-20 text-center">
										<button name="addclient" id="formsubmit" value="submitform" class="btn btn-primary">Create Client</button>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>			
           <div id="edit_client" class="modal custom-modal fade" role="dialog">
				<div class="modal-dialog">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<div class="modal-content modal-lg">
						<div class="modal-header">
							<h4 class="modal-title">Edit Client</h4>
						</div>
						<div class="modal-body">
							<div class="m-b-30">
								<form name="edit-client" action="" id="editclientform" method="post">
									<div class="row">
									<div class="col-sm-12">
<!--                                
							   <input type="file" value="Upload Image" id="empic">
							  <input type="hidden" value="https://cdn4.vectorstock.com/i/1000x1000/12/13/construction-worker-icon-person-profile-avatar-vector-15541213.jpg" name="empfile" id="empfile"> -->

<img id="loader_img" style="display:none"  src="https://loading.io/spinners/ellipsis/lg.discuss-ellipsis-preloader.gif" width="50">
							  <input type="file" value="Upload Image" id="empic1">
							  <input type="hidden" name="empfile1" id="empfile1">

						</div>
										<div class="col-md-6">
											<div class="form-group">
												<label class="control-label">First Name <span class="text-danger">*</span></label>
												<input name="firstname" class="form-control" id="first_name" type="text">
												
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<label class="control-label">Last Name</label>
												<input name="lastname" class="form-control" id="last_name" type="text">
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<label class="control-label">Username <span class="text-danger">*</span></label>
												<input name="username" class="form-control" id="user_name" type="text">
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<label class="control-label">Email <span class="text-danger">*</span></label>
												<input name="clientemail" class="form-control floating" id="clientemail" type="email">
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group" style="position: relative;">
												<label class="control-label">Password</label>
												<input style="padding-right:50px;" name="clientpass" class="form-control" id="clientpassword" type="password">
												<i style="position: absolute;position: absolute;top: 60%;right: 20px;font-size: 14px;" id="show1" onclick="visible()" class="fa fa-eye"></i>
												<i style="position: absolute;position: absolute;top: 60%;right: 20px;font-size: 14px;" id="show2" onclick="visible()" class="fa fa-eye-slash"></i>
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<label class="control-label">Confirm Password</label>
												<input name="conpass" class="form-control" id="clientconpassword" type="password">
											</div>
										</div>
										<div class="col-md-6">  
											<div class="form-group">
												<label class="control-label">Client ID <span class="text-danger">*</span></label>
												<input disabled name="clientid" id="client-id" class="form-control floating"  type="text">
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<label class="control-label">Phone </label>
												<input name="clientph" class="form-control" id="clientph" type="text">
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<label class="control-label">Company Name</label>
												<input name="company" class="form-control" type="text" id="companyname">
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
													<td>Projects</td>
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
														<input checked="" type="checkbox">
													</td>
													<td class="text-center">
														<input checked="" type="checkbox">
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
														<input checked="" type="checkbox">
													</td>
													<td class="text-center">
														<input checked="" type="checkbox">
													</td>
												</tr>
												<tr>
													<td>Chat</td>
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
														<input checked="" type="checkbox">
													</td>
													<td class="text-center">
														<input checked="" type="checkbox">
													</td>
												</tr>
												<tr>
													<td>Estimates</td>
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
														<input checked="" type="checkbox">
													</td>
													<td class="text-center">
														<input checked="" type="checkbox">
													</td>
												</tr>
												<tr>
													<td>Invoices</td>
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
														<input checked="" type="checkbox">
													</td>
													<td class="text-center">
														<input checked="" type="checkbox">
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
														<input checked="" type="checkbox">
													</td>
													<td class="text-center">
														<input checked="" type="checkbox">
													</td>
												</tr>
											</tbody>
										</table>
									</div> -->
									<div class="m-t-20 text-center">
									<input type="hidden" name="client_edit_id" class="client_id" id="client_edit_id"/>
										<button class="savedetail btn btn-primary" name="updateform" type="submit" class="btn btn-primary">Save Changes</button>
										 
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>			





			

<?php include "footer.php";?>