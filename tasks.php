<?php
session_start();
ob_start();
include "header.php";
include "sidebar.php";
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
<div class="page-wrapper" style="height:100%">
    <div class="chat-main-row" style="overflow:unset">
        <div class="chat-main-wrapper">
            <div class="col-xs-7 message-view task-view">
                <div class="chat-window">
                    <div class="chat-header">
                        <div class="navbar">
                            <div class="pull-left">
                                <div class="add-task-btn-wrapper">
                                    <button onclick="opentaskmodal()"  class="add-task-btn btn btn-default btn-xs">
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


<?php 

$prject_qury = "select distinct p.Project_id, p.Project_name from project_tasks pt inner join Project p on p.Project_id = pt.project_id";
$res_data = mysqli_query($con,$prject_qury);

?>

<?php	if ($res_data->num_rows > 0) { 
											while($row = $res_data->fetch_assoc()) {

										


                                          ?>   
                                                <h5 style="margin-top:5px;padding:5px;margin-bottom:0px"><?php echo $row['Project_name'];?></h5>
                                                <?php
                                             $task_qury = "select * from project_tasks pt where pt.project_id = ".$row['Project_id'];
                                             $task_data = mysqli_query($con,$task_qury);

                                             if ($task_data->num_rows > 0) { 
                                                while($task_row = $task_data->fetch_assoc()) {

                                             ?>
                                            
                                            <div class="task-list-body">
                                                <ul id="task-list" >
                                                   
                                                    <li class="task" >
                                                  
                                                        <div class="task-container" >
                                                            <!-- <span class="task-action-btn task-check">
                                                                <span class="action-circle large complete-btn" title="Mark Complete">
                                                                    <i class="fa fa-check"></i>
                                                                </span>
                                                            </span> -->
                                                            <span class="task-label">
                                                            <?php echo $task_row['task_name'] ?>
                                                            </span>
                                                            <div class="pull-right">
                                                            <span class="text-center">
                                                                    <i style="margin-top:5px;font-size:18px;margin-right:10px;cursor: pointer;" class="fa fa-edit text-success"></i>
                                                            </span>
                                                            <span style="margin-bottom:10px;"  class="text-center " onclick="deleteconfirm(<?php echo $task_row['id'] ?>)">
                                                                    <i style="margin-top:5px;font-size:18px;margin-right:10px;cursor: pointer;" class="fa fa-trash text-danger"></i>
                                                            </span>
                                                            </div>
                                                        </div>
                                                    </li>
                                                </ul>
                                            </div>


                                            <?php } } } }?>

                                           
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






<div id="taskmodal" class="modal" role="dialog">
    <div class="modal-dialog" style="max-width:50%;margin:100px auto">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button onclick="opentaskmodalclose()" type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Add Task</h4>
            </div>
            <div class="modal-body" 
                <div class="row">
                    <?php
                    $log_user_qury = "SELECT Project_id ,Project_name from Project";
                    $res_data = mysqli_query($con, $log_user_qury);
                    ?>
                    <div class="row">
                        <div class="col-sm-12">
                            <select id="projectid"  class="form-control"  name="project_id">
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
                        
                        </div>
                        <div class="form-group">
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

        <script>
            function opentaskmodal() {
                document.getElementById("taskmodal").style.display = "block";
            }

            function opentaskmodalclose() {
                document.getElementById("taskmodal").style.display = "none";
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

            function deleteconfirm(id){
              var yesvalue =   confirm("do yuo really want to delete");
if(yesvalue) {
    deletetask(id)
}

            }

function addtask(){
// add task 
var tasktitle = document.getElementById("tasktitle").value;
var desc = document.getElementById("desc").value;
var projectid = document.getElementById("projectid").value;
var prcid = "ADDTASK";
var data = { taskname : tasktitle , taskdiscription:desc ,  project_id : projectid };

    callapi({ Data : data, PRCID: prcid }).then((res) =>{
                 if(res){
                    document.getElementById("taskmodal").style.display = "none";
                    location.reload();
                }

            });

           
}

function edittask(){
// add task 
var prcid = "EDITTASK";
var data = { taskname : "tastdsagdsagd" , taskdiscription:"sdjsadhskjhdj" ,  taskid : 1 };

            callapi({ Data : data, PRCID: prcid }).then((res) =>{

            });
}


function deletetask(taskid){
// add task 
var prcid = "DELETETASKBYID";
var data = {  taskid : taskid };

            callapi({ Data : data, PRCID: prcid }).then((res) =>{
                location.reload();
            });
}



        </script>

        </body>


        </html> 