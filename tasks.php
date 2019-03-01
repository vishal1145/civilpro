<?php
session_start();
ob_start();
include "header.php";



$obj = new connection();
$con = $obj->connect();

$user_id = $_SESSION['user_id'];



?>
<style>
    .task:hover
{
    overflow:hidden !important;
}
</style>
<style>

.data-id:hover{
  font-size: 20px;
  background-color: #7460ee;
}
.nameactive{
	font-size:120px;
	background: #253035;
}
.delete{
    color: red;
    opacity:0;
    transition:opacity 0.5s linear;
    -moz-transition: opacity 0.5s linear;
    -webkit-transition: opacity 0.5s linear;
}
.title:hover .delete {
   opacity: 1;
   transition:opacity 0.5s linear;
   -moz-transition: opacity 0.5s linear;
   -webkit-transition: opacity 0.5s linear;
}​

.delete:after{
    content: '';
    position: relative;
    bottom: 0;
    top: 27px;
    left: -30%;
    width: 0;
    height: 0;
    border: 8px solid transparent;
    border-top-color: #000000;
    border-bottom: 0;
    /* margin-left: -20px; */
    /* margin-bottom: -20px; */
}
.title:hover .delete {
   display:block  
}


</style>

<div class="sidebar" id="sidebar"  >
                <div class="sidebar-inner slimscroll">
					<div class="sidebar-menu">
					<ul>
					
					<li > 
						<a href="dashbord.php"  ><i class="fa fa-home"></i> Back to Home</a>
					</li>
					<li class="menu-title" style="text-transform: capitalize;">Projects </a>
                    
                    
                    </li>
                    <?php
                $log_user_qury = "select count(1) as counts, p.Project_id, max(p.Project_name) as Project_name from project_tasks pt inner join Project p on p.Project_id = pt.project_id group by p.Project_id order by p.Project_id";
                $res_data = mysqli_query($con, $log_user_qury);
                ?>
<?php	if ($res_data->num_rows > 0) {
    $counter =0;
                                while ($row = $res_data->fetch_assoc()) {

                                    $querystring = "-1";

                                    if($counter == 0){
                                    $querystring  = $row['Project_id'];
                                    }

                                    $counter++;

                                    $queries1 = array();
                                            parse_str($_SERVER['QUERY_STRING'], $queries1);


                                            if(sizeof($queries1) > 0){
                                                $querystring = $queries1['id'];
                                            }


                                    ?>

                                   
                    <li class="<?php if($row['Project_id'] === $querystring) { echo 'nameactive'; } ?>"
                    > 
					 <a href="?id=<?php echo $row['Project_id'] ?>" class = "active" >
					 <span style="cursor: pointer;text-transform: capitalize;"><?php echo $row['Project_name']; ?></span>
							<span class="badge bg-danger pull-right"> 
							<?php echo $row['counts']; ?>
							</span>
							<!-- {{group.GroupInfo.GroupName}} -->
					 </a>
					</li>

                    <?php 
                        }
                    } ?>

				
					 <li ng-repeat="group in []"> 
						<a href="chat.html"><span class="status offline"></span> Richard Miles <span class="badge bg-danger pull-right">18</span></a>
					</li>
					

				</ul>
					</div>
                </div>
            </div>

<div class="page-wrapper" style="height:100%">
    <div class="chat-main-row" style="overflow:unset">
        <div class="chat-main-wrapper">
            <div class="col-xs-7 message-view task-view">
                <div class="chat-window">
                    <div class="chat-header">
                        <div class="navbar">
                            <div class="pull-left">
                                <div class="add-task-btn-wrapper">
                                    <button onclick="opentaskmodal()" class="add-task-btn btn btn-default btn-xs">
                                        Add Task
                                    </button>
                                </div>
                            </div>

                            <a class="task-chat profile-rightbar pull-right" href="#task_window"><i class="fa fa fa-comment"></i></a>
                        </div>
                    </div>
                    <div class="chat-contents">
                        <div class="chat-content-wrap">
                            <div class="chat-wrap-inner" style="overflow:unset">
                                <div class="chat-box">
                                    <div class="task-wrapper">
                                        <div class="task-list-container">






							
                                        <table class="table table-striped custom-table datatable">
									<thead>

										<tr>
                                        <th>No.</th>
                                                                            <th>Task Name</th>
                                                                            <th>Task Description</th>
                                                                            <th>Created at</th>
                                                                            <th>Employees</th>
                                                                            <th>Status</th>
											<th class="text-right">Action</th>
										</tr>
									</thead>
									
                                    <tbody>

                                    <?php

$queries = array();
parse_str($_SERVER['QUERY_STRING'], $queries);

$base_query = "select distinct p.Project_id, p.Project_name from project_tasks pt inner join Project p on p.Project_id = pt.project_id";

if(sizeof($queries) > 0){
    $base_query = $base_query." where p.Project_id = ".$queries['id'];
}else {
    $base_query = $base_query." order by p.Project_id limit 1";
}
$res_data = mysqli_query($con, $base_query);

if ($res_data->num_rows > 0) {
    while ($row = $res_data->fetch_assoc()) {

        
                                            $task_qury = "select * from project_tasks pt where pt.project_id = " . $row['Project_id'];
                                            $task_data = mysqli_query($con, $task_qury);

                                            if ($task_data->num_rows > 0) {
                                                while ($task_row = $task_data->fetch_assoc()) {

                                                    ?>

										<tr>
                                        
                                        <input type="hidden" id="projectidhidden" value="<?php echo $row['Project_id']; ?>" />

											<td>
												1
											</td>
											<td><h2><a href="#"><?php echo $task_row['task_name']; ?></a></h2></td>
                                            <td><h2><a href="#"><?php echo $task_row['task_discription']; ?></a></h2></td>
											<td>8 Sep 2017 </td>
											<td>
												<ul class="team-members">

                                                <?php
                                                                            $log_user_qury = "select distinct img, first_name from task_employee te inner join employee e on e.empl_id = te.empl_id where te.task_id =".$task_row['id'];
                                                                            $res_data = mysqli_query($con, $log_user_qury);
                                                                            ?>						
                                                                            <?php	if ($res_data->num_rows > 0) {
                                                                            while ($rowemp = $res_data->fetch_assoc()) {
                                                                            ?>

													<li>
														<a href="#" title="<?php echo $rowemp['first_name']; ?>" data-toggle="tooltip"><img src="<?php echo $rowemp['img']; ?>" alt="John Doe"></a>
													</li>
													
                                                    <?php 
                                                                                }} 
                                                                                ?>	

												</ul>
											</td>
											<td>status </td>
											<td class="text-right">
                                            <div class="pull-right">
                                                            <span class="text-center" onclick="opentaskmodalemp(<?php echo $task_row['id'] ?>,'<?php echo $task_row['task_name'] ?>','<?php echo $task_row['task_discription'] ?>')">
                                                                    <i style="margin-top:5px;font-size:18px;margin-right:10px;cursor: pointer;" class="fa fa-plus-circle text-info"></i>
                                                                </span>
                                                                <span class="text-center" onclick="opentaskmodaledit(<?php echo $task_row['id'] ?>,'<?php echo $task_row['task_name'] ?>','<?php echo $task_row['task_discription'] ?>')">
                                                                    <i style="margin-top:5px;font-size:18px;margin-right:10px;cursor: pointer;" class="fa fa-edit text-success"></i>
                                                                </span>
                                                                <span style="margin-bottom:10px;" class="text-center " onclick="deleteconfirm(<?php echo $task_row['id'] ?>)">
                                                                    <i style="margin-top:5px;font-size:18px;margin-right:10px;cursor: pointer;" class="fa fa-trash text-danger"></i>
                                                                </span>
                                                            </div>
												<!-- <div class="dropdown">
													<a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
													<ul class="dropdown-menu pull-right">
														<li><a href="#" data-toggle="modal" data-target="#edit_project"><i class="fa fa-pencil m-r-5"></i> Edit</a></li>
														<li><a href="#" data-toggle="modal" data-target="#delete_project"><i class="fa fa-trash-o m-r-5"></i> Delete</a></li>
													</ul>
												</div> -->
											</td>
										</tr>
										
                                        <?php 
                                                                                } } } } 
                                                                                ?>

                                        </tbody>
								</table>
				


                                      

                                          

                                           



                                        </div>
                                    </div>
                                    <div class="notification-popup hide">
                                        <p>
                                            <span class="task"></span>
                                            <span class="notification-text"></span>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

</div>


</div>





<!--Add Task>-->
<div id="taskmodal" class="modal" role="dialog">
    <div class="modal-dialog" style="max-width:50%;margin:100px auto">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button onclick="opentaskmodalclose()" type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Add Task</h4>
            </div>
            <div class="modal-body" <div class="row">
                <!-- <?php
                $log_user_qury = "SELECT Project_id ,Project_name from Project";
                $res_data = mysqli_query($con, $log_user_qury);
                ?>
                <div class="row">
                    <div class="col-sm-12">
                        <select id="projectid" class="form-control" name="project_id">
                            <option value="<?php echo $row['Project_id']; ?>">Select project</option>
                            <?php	if ($res_data->num_rows > 0) {
                                while ($row = $res_data->fetch_assoc()) {
                                    ?>
                            <option value="<?php echo $row['Project_id']; ?>">
                                <?php echo $row['Project_name']; ?>
                            </option>
                            <?php 
                        }
                    } ?>
                        </select>
                    </div>

                </div> -->
                <div class="form-group" style="margin-top:5px;">
                    <label for="pwd">Title:</label>
                    <input type="text" class="form-control" id="tasktitle">
                </div>
                <div class="form-group" style="margin-top:10px;">
                    <label for="comment">Description:</label>
                    <textarea class="form-control" rows="5" id="desc"></textarea>
                </div>
            </div>
            <div class="modal-footer">
                <button onclick="addtask()" type="button" style="background:#5bc0de;border:none;color:#fff" class="btn btn-info" data-dismiss="modal">Save</button>
                <button onclick="opentaskmodalclose()" type="button" style="background:#f6f6f6;border:none;color:#000" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>

    </div>
</div>





<!--Edit Task>-->
<div id="taskmodaledit" class="modal" role="dialog">
    <div class="modal-dialog" style="max-width:50%;margin:100px auto">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button onclick="opentaskmodalcloseedit()" type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Edit Task</h4>
            </div>
            <div class="modal-body" <div class="row">
                <!-- <?php
                $log_user_qury = "SELECT Project_id ,Project_name from Project";
                $res_data = mysqli_query($con, $log_user_qury);
                ?>
                <div class="row">
                    <div class="col-sm-12">
                        <select id="projectid" class="form-control" name="project_id">
                            <option value="<?php echo $row['Project_id']; ?>">Select project</option>
                            <?php	if ($res_data->num_rows > 0) {
                                while ($row = $res_data->fetch_assoc()) {
                                    ?>
                            <option value="<?php echo $row['Project_id']; ?>">
                                <?php echo $row['Project_name']; ?>
                            </option>
                            <?php 
                        }
                    } ?>
                        </select>
                    </div>

                </div> -->
                <div class="form-group">
                    <label for="pwd">Title:</label>
                    <input type="hidden" class="form-control" id="taskidedit" value="<?php echo $task_row['task_name'] ?>">
                            
                    <input type="text" class="form-control" id="tasktitleedit" value="<?php echo $task_row['task_name'] ?>">
                    
                </div>
                <div class="form-group" style="margin-top:10px;">
                    <label for="comment">Description:</label>
                    <textarea class="form-control" rows="5" id="taskdescedit"></textarea>
                </div>
            </div>
            <div class="modal-footer">
                <button onclick="edittask()" type="button" style="background:#5bc0de;border:none;color:#fff" class="btn btn-info" data-dismiss="modal">Update</button>
                <button onclick="opentaskmodalcloseedit()" type="button" style="background:#f6f6f6;border:none;color:#000" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>

    </div>
</div>






<!--Add Employee-->
<div id="taskmodalemp" class="modal" role="dialog">
    <div class="modal-dialog" style="max-width:50%;margin:100px auto">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button onclick="opentaskmodalempclose()" type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Add Employee</h4>
            </div>
            <div class="modal-body" <div class="row">
                 <?php
                $log_user_qury = "SELECT Project_id ,Project_name from Project";
                $res_data = mysqli_query($con, $log_user_qury);
                ?>
                <div class="row">
                    <div class="col-sm-12">
                    <select class="select_pro form-control" id="emp_id" name="emp_id" onchange="addemployeelocal()">
										<option value="">Select Employee</option>				
										<?php
					$selectemp = mysqli_query($con, "SELECT empl_id,first_name from employee");
					if(mysqli_num_rows($selectemp) > 0){
					while($res_selectemp = $selectemp->fetch_assoc()) {					
					?>
												<option value="<?php echo $res_selectemp['empl_id']; ?>"><?php echo $res_selectemp['first_name']; ?></option>
										<?php } }?>
									</select>

                                    
                    </div>
                    <div class="row" >
                    <div class="col-sm-12" style="margin-left:10px;">
                     <ul class="team-members" id="liempimageui">

                                                <?php
                                                                            $log_user_qury = "select e.empl_id , e.first_name, e.last_name, e.img, pt.id as taskid , COALESCE(te.task_id ,0) as task_id from employee e join project_tasks pt left join task_employee te on e.empl_id = te.empl_id and te.task_id = pt.id";
                                                                            $res_data = mysqli_query($con, $log_user_qury);
                                                                            ?>						
                                                                            <?php	if ($res_data->num_rows > 0) {
                                                                            while ($rowemp = $res_data->fetch_assoc()) {
                                                                            ?>

													<li style="margin-bottom:15px;margin-top:10px;display: none;margin-right:15px" class="liempimage" id="<?php echo $rowemp['empl_id']; ?>|<?php echo $rowemp['taskid']; ?>|<?php echo $rowemp['task_id']; ?>">
														<a style="border:1px solid #999" href="#" title="John Doe" data-toggle="tooltip"><img src="<?php echo $rowemp['img']; ?>" alt="John Doe"></a>
                                                       <a onclick="removeemployeelocal(<?php echo $rowemp['empl_id']; ?>,<?php echo $rowemp['taskid']; ?>,<?php echo $rowemp['task_id']; ?>)" style="border-radius:0px;border:none;height:unset;width:unset;padding: 3px 5px 3px 5px !important;font-size:8px;margin-bottom: 3px;margin-top:5px;position:absolute;top:0px;" href="#" ><i style="color:red;font-size:18px;margin-left:18px" class="fa fa-times-circle-o" aria-hidden="true"></i></a>
													<p><?php echo $rowemp['first_name']; ?></p>
                                                    </li>
													
                                                    <?php 
                                                                                }} 
                                                                                ?>	

												</ul>
                    </div>
                    </div>
                </div> 

                <!-- <div class="form-group" style="margin-top:5px;">
                    <label for="pwd">Title:</label>
                    <input type="text" class="form-control" id="tasktitle">
                </div>
                <div class="form-group" style="margin-top:10px;">
                    <label for="comment">Description:</label>
                    <textarea class="form-control" rows="5" id="desc"></textarea>
                </div> -->
            </div>
            <div class="modal-footer">
                <button onclick="return add_employe();" type="button" style="background:#5bc0de;border:none;color:#fff" class="btn btn-info" data-dismiss="modal">Add</button>
                <button onclick="opentaskmodalempclose()" type="button" style="background:#f6f6f6;border:none;color:#000" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>

    </div>
</div>

<script>
    window.taskid = -1;
    function opentaskmodal() {
        document.getElementById("taskmodal").style.display = "block";
    }

    function addemployeelocal(){
        var eid = document.getElementById("emp_id").value;
        try{
        var id = eid+ "|"+ window.taskid + "|"+ window.taskid;
        document.getElementById(id).style.display = "block";
        }catch(err){
            var id = eid+ "|"+ window.taskid + "|0"
        document.getElementById(id).style.display = "block";
        }
    }

    function removeemployeelocal(eid , taskid, task_id){
        var id = eid + "|"+taskid + "|"+ task_id;
        document.getElementById(id).style.display = "none";
        // var eid = document.getElementById("emp_id").value;
        // try{
        //     var id = eid+ "|"+ window.taskid + "|"+ window.taskid;
        //     document.getElementById(id).style.display = "none";
        // }catch(err){
        //     var id = eid+ "|"+ window.taskid + "|0"
        //     document.getElementById(id).style.display = "none";
        // }
    }

    function manageList(){
        var list = document.getElementsByClassName('liempimage');
        if(list){
            for(var i=0;i< list.length; i++){
                var temps = list[i].id.split("|");
                if(window.taskid  == temps[1] && temps[2] == temps[1])
                document.getElementById(list[i].id).style.display = "block";
                else
                document.getElementById(list[i].id).style.display = "none";
            }
        }
    }

    function opentaskmodalemp(taskid,taskname) {
        window.taskid = taskid;
        document.getElementById("taskmodalemp").style.display = "block";
        manageList();
    }
    function opentaskmodalempclose() {
        document.getElementById("taskmodalemp").style.display = "none";
    }

    function opentaskmodaledit(id ,task_name, task_discription) {
        document.getElementById("taskmodaledit").style.display = "block";
       document.getElementById("tasktitleedit").value = task_name;
        document.getElementById("taskdescedit").value = task_discription;
        document.getElementById("taskidedit").value = id;
    }

    function opentaskmodalclose() {
        document.getElementById("taskmodal").style.display = "none";
    }
    function opentaskmodalcloseedit() {
        document.getElementById("taskmodaledit").style.display = "none";
    }
    //             var tasktitle = document.getElementById("tasktitle").value;
    // var desc = document.getElementById("desc").value;
    // var projectid = document.getElementById("projectid").value;

    // callapi({ PRCID: 'GETALLTASK' }).then((res) =>{
    //     for(var i=0;i<res.length;i++){
    //         document.getElementById("tasknamebind").innerHTML=res[i].task_name;

    //         // $('#tasknamebind').append(res[i].task_name)	
    //        }
    // });

    function deleteconfirm(id) {
        var yesvalue = confirm("do yuo really want to delete");
        if (yesvalue) {
            deletetask(id)
        }

    }

function getAddPromise(){

}

    function add_employe(){

        callapi({
            Data: { empl_id : -1 , taskid : window.taskid},
            PRCID: 'DELETEEMPLOYEEFROMTASK'
        }).then((res) => {
        
       var pms = [];
            var list = document.getElementsByClassName('liempimage');
        if(list){
            for(var i=0;i< list.length; i++){
                if(document.getElementById(list[i].id).style.display == "block")
                {
                 
                    var eid = list[i].id.split("|")[0];
                 
                 if(eid > 0) {  

                    var p = callapi({            Data: { empl_id : eid , taskid : window.taskid},            PRCID: 'ADDEMPLOYEETOTASK'        });
                    pms.push(p)
                 }
                }
            }
        }

        Promise.all(pms).then(function(values) {
            location.reload();
});


            
       return false;



        });

        var getempid = document.getElementById("emp_id").value;
        callapi({
            Data: { empl_id : getempid , taskid : window.taskid},
            PRCID: 'ADDEMPLOYEETOTASK'
        }).then((res) => {
            if (res) {
                document.getElementById("taskmodalemp").style.display = "none";
                location.reload();
            }

        });
    }

    function delete_employe(empl_id , taskid){

        var yesvalue1 = confirm("do yuo really want to delete");
        if (yesvalue1) {
        callapi({
            Data: { empl_id : empl_id , taskid : taskid},
            PRCID: 'DELETEEMPLOYEEFROMTASK'
        }).then((res) => {
        
            deletetask(empl_id , taskid)
            location.reload();
       

        });
        }
    }

    function addtask() {
        // add task 
        var tasktitle = document.getElementById("tasktitle").value;
        var desc = document.getElementById("desc").value;
        var projectid = document.getElementById("projectidhidden").value;
        var prcid = "ADDTASK";
        var data = {
            taskname: tasktitle,
            taskdiscription: desc,
            project_id: projectid
        };

        callapi({
            Data: data,
            PRCID: prcid
        }).then((res) => {
            if (res) {
                document.getElementById("taskmodal").style.display = "none";
                location.reload();
            }

        });


    }

    function edittask() {
        // add task 
        var prcid = "EDITTASK";
        var data = {
            taskname: document.getElementById("tasktitleedit").value,
            taskdiscription: document.getElementById("taskdescedit").value,
            taskid: document.getElementById("taskidedit").value
        };

        callapi({
            Data: data,
            PRCID: prcid
        }).then((res) => {
            document.getElementById("taskmodaledit").style.display = "none";
                location.reload();
        });
    }


    function deletetask(taskid) {
        // add task 
        var prcid = "DELETETASKBYID";
        var data = {
            taskid: taskid
        };

        callapi({
            Data: data,
            PRCID: prcid
        }).then((res) => {
            location.reload();
        });
    }
</script>

</body>


</html> 