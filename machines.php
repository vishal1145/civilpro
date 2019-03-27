<?php 
include "header.php";
include "sidebar.php";					

//Indert query in Add Machines
						$abc = new connection();
						$con = $abc->connect();
						if (isset($_POST['submit_data1'])) {
					
							$machine_name=$_POST['machine_name'];
						$photo= $_FILES['myphoto']['name'];
						if($_FILES['myphoto']['name']) {
						$allowed =  array('gif','png' ,'jpg','jpeg');
						$filename = $_FILES['myphoto']['name'];
						$ext = pathinfo($filename, PATHINFO_EXTENSION);

						if(!in_array($ext,$allowed) ) {
						    echo "Invalid file ";
						    
						}else{
						$sql="INSERT INTO machine (machine_name,machine_image) VALUES ('".$machine_name."', '".$photo."')";
						echo $sql;
							$db=mysqli_query($con,$sql);
							echo "successfully Add Machine";
						}
							$target = "Upload/Machines/".basename($filename);
							move_uploaded_file($_FILES['myphoto']['tmp_name'], $target);	
						}

						}





						if (isset($_POST['submit_data'])) {
							$machine_name=$_POST['machine_name'];
							$photo=$_POST['myphoto1'];
							$sql="INSERT INTO machine (machine_name,machine_image) VALUES ('".$machine_name."', '".$photo."')";
							echo $sql;
								$db=mysqli_query($con,$sql);
								echo "successfully Add Machine";
	
							}
?>
<style>.error{color: red;}</style>


<!-- Delete query -->
<?php 
						$abc = new connection();
						$con = $abc->connect();
						if (isset($_POST['delete_button'])) {
						$id= $_POST['machine_id'];
						$del="DELETE FROM machine WHERE machine_id= $id";
						$delete=mysqli_query($con,$del); 
						if($delete == true)
						{
							//echo "delete successfull";
							header('Refresh:0');
							//alert("successfully delete");
						}
						else
						{
							echo "Not delete";
						}
						}					
?>
<!-- Fectch data  -->
<?php
$fetch="SELECT * FROM machine";
$db=mysqli_query($con,$fetch);

?>
			  <div class="page-wrapper">
                <div class="content container-fluid">
					<div class="row">
						<div class="col-xs-4">
							<h4 class="page-title">Machines</h4>
						</div>
						<div class="col-xs-8 text-right m-b-20">
							<a href="#" class="btn btn-primary rounded pull-right" data-toggle="modal" data-target="#machine-list2"><i class="fa fa-plus"></i> Add New Machine</a>
							<div class="view-icons">
								<a href="machines.php" class="grid-view btn btn-link active"><i class="fa fa-th"></i></a>
								<a href="machines-list.php" class="list-view btn btn-link"><i class="fa fa-bars"></i></a>
							</div>
						</div>
					</div>

					<div class="row staff-grid-row">
					
					<?php   while($row=mysqli_fetch_array($db)){    ?>

						<div class="col-md-4 col-sm-4 col-xs-6 col-lg-3">

							<div class="profile-widget">
								<div class="profile-img">
									<a href="#"><img class="avatar" src="<?php echo $row['machine_image'];?> " alt=""></a>
								</div>
								<div class="dropdown profile-action">
									<a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
									<ul class="dropdown-menu pull-right">
										<li><a href="#" data-toggle="modal" data-target="#machine-list_edit<?php echo $row['machine_id']; ?>"><i class="fa fa-pencil m-r-5"></i> Edit</a></li>
										<li><a href="#" data-toggle="modal" data-target="#delete_employee<?php echo $row['machine_id']; ?>"><i class="fa fa-trash-o m-r-5"></i> Delete</a></li>
									</ul>
								</div>
								<h4 class="user-name m-t-10 m-b-0 text-ellipsis"><a href="#"><?php echo $row['machine_name']; ?></a></h4>
							</div>
						</div>



				<div id="delete_employee<?php echo $row['machine_id']; ?>" class="modal custom-modal fade" role="dialog">
				<div class="modal-dialog">
					<div class="modal-content modal-md">
						<div class="modal-header">
							<h4 class="modal-title">Delete Employee</h4>
						</div>
						<form action="" method="post">
							<div class="modal-body card-box">

							<input type="hidden"  name="machine_id" value="<?php echo $row['machine_id']; ?>">
								<p>Are you sure want to delete this?</p>
								<div class="m-t-20"> <a href="#" class="btn btn-default" data-dismiss="modal">Close</a>
									<button type="submit" name="delete_button" class="btn btn-danger">Delete</button>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>

<!-- Update Query -->
			 <?php 
						$abc = new connection();
						$con = $abc->connect();
						if (isset($_POST['update_button'])) {
						$id= $_POST['machine_id'];
						$machine_name=$_POST['machine_name'];
						$machine_image=$_POST['myphoto1'];
						$update="UPDATE `machine` SET `machine_name`='".$machine_name."', `machine_image`='".$machine_image."' WHERE machine_id='".$id."' ";
 
 	 $update_dataa = mysqli_query($con,$update);
 	 echo "update data";
 	header("Refresh:0");
						// $machine_image=$_FILES['machine_image']['name'];
						// $target = "Upload/Machines/".basename($machine_image);
						// move_uploaded_file($_FILES['machine_image']['tmp_name'], $target);
// 						if($_FILES['machine_image']['name']) {
// 						$allowed =  array('gif','png' ,'jpg','jpeg');
// 						$filename = $_FILES['machine_image']['name'];
// 						$ext = pathinfo($filename, PATHINFO_EXTENSION);
// 						if(!in_array($ext,$allowed) ) {
// 						    echo "Invalid file ";
// 						}else{
//  $update="UPDATE `machine` SET `machine_name`='".$machine_name."', `machine_image`='".$machine_image."' WHERE machine_id='".$id."' ";
 
// 	 $update_dataa = mysqli_query($con,$update);
// 	 //echo "update data";
// 	header("Refresh:0");

// } 
// } 
}										
?>

			<div id="machine-list_edit<?php echo $row['machine_id']; ?>" class="modal custom-modal fade" role="dialog">
				<div class="modal-dialog">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<div class="modal-content modal-lg">
						<div class="modal-header">
							<h4 class="modal-title">Edit Machine</h4>
						</div>
						<div class="modal-body">
							<form action="" method="post" enctype="multipart/form-data">
								<div class="row">
									<div class="col-md-12">
									<input type="hidden"  name="machine_id" value="<?php echo $row['machine_id']; ?>">
										<div class="form-group">
											<label>Machine Name</label>

											<input class="form-control" type="text" name="machine_name" value="<?php echo $row['machine_name']; ?>" required>
										</div>									
										<div class="michine_img" style="text-align: center">
											<img type="hidden"  src="<?php echo $row['machine_image'];?> " width="50%" id="empfile2<?php echo $row['machine_id']; ?>">
											<input type="hidden" value="JCB.png"  name="myphoto1" id="empfile3<?php echo $row['machine_id']; ?>">
										</div>
										<div class="form-group">
											<label>Upload Files</label>
											<!-- <input class="form-control" type="file" name="machine_image" value="<?php echo $row['machine_image']; ?>" > -->
											<img id="loader_img<?php echo $row['machine_id']; ?>" style="display:none"  src="https://loading.io/spinners/ellipsis/lg.discuss-ellipsis-preloader.gif" width="50"> 

								<!-- <input accept="image/jpg,image/svg,image/jpeg, image/png" type="file" value="Upload Image" onChange="readempic1File(this,<?php echo $row['empl_id']; ?>);" id="empic1"> -->

										 <input accept="image/jpg,image/svg,image/jpeg, image/png" type="file" value="Upload Image" onChange="readempic1File(this,<?php echo $row['machine_id']; ?>);" name="machine_image" id="empic1" >

										</div>								
										<div class="m-t-20 text-center">
											<button type="submit" name="update_button" class="btn btn-primary">Update Michine</button>
										</div>
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		<?php } ?>
		</div>
		
<div id="machine-list2" class="modal custom-modal fade" role="dialog">
				<div class="modal-dialog">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<div class="modal-content modal-lg">
						<div class="modal-header">
							<h4 class="modal-title">Add Machine</h4>
						</div>
						<div class="modal-body">
							<form action="" method="post" enctype="multipart/form-data" class="machineval"  name="machineval">
								<div class="row">
									<div class="col-md-12">
										<div class="form-group">
											<label>Machine Name</label>
											<input class="form-control" type="text" name="machine_name" >
										</div>									
										<div class="michine_img" style="text-align: center">
										 
											<img type="hidden" src="JCB.png"  name="myphoto" width="40%" id="empfile">
											<input type="hidden" value="JCB.png"  name="myphoto1" id="empfile1">
										</div>	

										<div class="form-group">
											<label>Upload Files</label>
											<img id="loader_img2" style="display:none"  src="https://loading.io/spinners/ellipsis/lg.discuss-ellipsis-preloader.gif" width="50"> 
											<input class="form-control" type="file" id="empic" >
										</div>	


										<div class="m-t-20 text-center">
											<button type="submit" name="submit_data" class="btn btn-primary">Add Michine</button>
										</div>
									</div>
								</div>
							</form>
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
		 <script src="https://cdn.jsdelivr.net/jquery.validation/1.15.1/jquery.validate.min.js"></script>

			<script src = "https://sdk.amazonaws.com/js/aws-sdk-2.6.10.min.js"  type="text/javascript"> </script> 

<script>

$(document).ready(function(){

  $(".machineval").validate({
    // Specify validation rules
    rules: {
      machine_name: "required",
	  myphoto: "required",
     },
    // Specify validation error messages
    messages: {
     machine_name: "Please enter your machine name", 
	 myphoto :"choose the image",
      },
   
    submitHandler: function(form) {
      form.submit();
    }
  });

});
</script>
<script type="text/javascript">
function readURL(input) {

  if (input.files && input.files[0]) {
    var reader = new FileReader();

    reader.onload = function(e) {
      $('#blah').attr('src', e.target.result);

      $('#blah').hide();
      $('#blah').fadeIn(650);

    }

    reader.readAsDataURL(input.files[0]);
  }
}

$("#imgInp").change(function() {
  readURL(this);
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


function readempic1File(input,machineid){
		document.getElementById("loader_img"+ machineid).style.display = "block";
    uploadTOAWS(input,machineid);
}


			function uploadTOAWS(that ,machineid){
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
												$("#empfile").attr('src',data.Location);
												$("#empfile1").val(data.Location);

												$("#empfile2"+ machineid).val(data.Location);
												$("#empfile3"+ machineid).val(data.Location);
												document.getElementById("loader_img" + machineid).style.display = "none";
												$("#empfile2"+ machineid).attr('src',data.Location);
                        console.log(data);

											
                    }
                });
			}

$(document).ready(function() {


            callapi({
                PRCID: 'MAXEMP'
            }).then(function(res) {
                $("#eidcontrol").val(res.id)
            });

					

            $("#empic").change(function() {
				document.getElementById("loader_img2").style.display = "block";
                uploadTOAWS(this);
            });

						$("#empic1").change(function() {
				document.getElementById("loader_img").style.display = "block";
                uploadTOAWS(this);
            });
		
						$('#loader_img2').hide();
});


</script>


    </body>
</html>

 
