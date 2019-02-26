<?php
session_start();
ob_start();
include "header.php";
include "sidebar.php";
$obj = new connection();
$con = $obj->connect();

$user_id = $_SESSION['user_id'];



?>

<div class="page-wrapper" style="height:100%">
    <div class="chat-main-row">
        <div class="chat-main-wrapper">
            <div class="col-xs-7 message-view task-view">
                <div class="chat-window">
                    <div class="chat-header">
                        <div class="navbar">
                            <div class="pull-left">
                                <div class="add-task-btn-wrapper">
                                    <button data-toggle="modal" onclick="opentaskmodal()" data-target="#taskmodal" class="add-task-btn btn btn-default btn-xs">
                                        Add Task
                                    </button>
                                </div>
                            </div>
                            <ul class="nav navbar-nav pull-right chat-menu">
                                <li class="dropdown">
                                    <a href="" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-cog"></i></a>
                                    <ul class="dropdown-menu">
                                        <li><a href="javascript:void(0)">Pending Tasks</a></li>
                                        <li><a href="javascript:void(0)">Completed Tasks</a></li>
                                        <li><a href="javascript:void(0)">All Tasks</a></li>
                                    </ul>
                                </li>
                            </ul>
                            <a class="task-chat profile-rightbar pull-right" href="#task_window"><i class="fa fa fa-comment"></i></a>
                        </div>
                    </div>
                    <div class="chat-contents">
                        <div class="chat-content-wrap">
                            <div class="chat-wrap-inner">
                                <div class="chat-box">
                                    <div class="task-wrapper">
                                        <div class="task-list-container">
                                            <div class="task-list-body">
                                                <ul id="task-list">
                                                    <li class="task">
                                                        <div class="task-container">
                                                            <span class="task-action-btn task-check">
                                                                <span class="action-circle large complete-btn" title="Mark Complete">
                                                                    <i class="material-icons">check</i>
                                                                </span>
                                                            </span>
                                                            <span class="task-label" contenteditable="true">Patient appointment booking</span>
                                                            <span class="task-action-btn task-btn-right">
                                                                <span class="action-circle large" title="Assign">
                                                                    <i class="material-icons">person_add</i>
                                                                </span>
                                                                <span class="action-circle large delete-btn" title="Delete Task">
                                                                    <i class="material-icons">delete</i>
                                                                </span>
                                                            </span>
                                                        </div>
                                                    </li>
                                                    <li class="task">
                                                        <div class="task-container">
                                                            <span class="task-action-btn task-check">
                                                                <span class="action-circle large complete-btn" title="Mark Complete">
                                                                    <i class="material-icons">check</i>
                                                                </span>
                                                            </span>
                                                            <span class="task-label" contenteditable="true">Appointment booking with payment gateway</span>
                                                            <span class="task-action-btn task-btn-right">
                                                                <span class="action-circle large" title="Assign">
                                                                    <i class="material-icons">person_add</i>
                                                                </span>
                                                                <span class="action-circle large delete-btn" title="Delete Task">
                                                                    <i class="material-icons">delete</i>
                                                                </span>
                                                            </span>
                                                        </div>
                                                    </li>
                                                    <li class="completed task">
                                                        <div class="task-container">
                                                            <span class="task-action-btn task-check">
                                                                <span class="action-circle large complete-btn" title="Mark Complete">
                                                                    <i class="material-icons">check</i>
                                                                </span>
                                                            </span>
                                                            <span class="task-label">Doctor available module</span>
                                                            <span class="task-action-btn task-btn-right">
                                                                <span class="action-circle large" title="Assign">
                                                                    <i class="material-icons">person_add</i>
                                                                </span>
                                                                <span class="action-circle large delete-btn" title="Delete Task">
                                                                    <i class="material-icons">delete</i>
                                                                </span>
                                                            </span>
                                                        </div>
                                                    </li>
                                                    <li class="task">
                                                        <div class="task-container">
                                                            <span class="task-action-btn task-check">
                                                                <span class="action-circle large complete-btn" title="Mark Complete">
                                                                    <i class="material-icons">check</i>
                                                                </span>
                                                            </span>
                                                            <span class="task-label" contenteditable="true">Patient and Doctor video conferencing</span>
                                                            <span class="task-action-btn task-btn-right">
                                                                <span class="action-circle large" title="Assign">
                                                                    <i class="material-icons">person_add</i>
                                                                </span>
                                                                <span class="action-circle large delete-btn" title="Delete Task">
                                                                    <i class="material-icons">delete</i>
                                                                </span>
                                                            </span>
                                                        </div>
                                                    </li>
                                                    <li class="task">
                                                        <div class="task-container">
                                                            <span class="task-action-btn task-check">
                                                                <span class="action-circle large complete-btn" title="Mark Complete">
                                                                    <i class="material-icons">check</i>
                                                                </span>
                                                            </span>
                                                            <span class="task-label" contenteditable="true">Private chat module</span>
                                                            <span class="task-action-btn task-btn-right">
                                                                <span class="action-circle large" title="Assign">
                                                                    <i class="material-icons">person_add</i>
                                                                </span>
                                                                <span class="action-circle large delete-btn" title="Delete Task">
                                                                    <i class="material-icons">delete</i>
                                                                </span>
                                                            </span>
                                                        </div>
                                                    </li>
                                                    <li class="task">
                                                        <div class="task-container">
                                                            <span class="task-action-btn task-check">
                                                                <span class="action-circle large complete-btn" title="Mark Complete">
                                                                    <i class="material-icons">check</i>
                                                                </span>
                                                            </span>
                                                            <span class="task-label" contenteditable="true">Patient Profile add</span>
                                                            <span class="task-action-btn task-btn-right">
                                                                <span class="action-circle large" title="Assign">
                                                                    <i class="material-icons">person_add</i>
                                                                </span>
                                                                <span class="action-circle large delete-btn" title="Delete Task">
                                                                    <i class="material-icons">delete</i>
                                                                </span>
                                                            </span>
                                                        </div>
                                                    </li>
                                                </ul>
                                            </div>
                                            <div class="task-list-footer">
                                                <div class="new-task-wrapper">
                                                    <textarea id="new-task" placeholder="Enter new task here. . ."></textarea>
                                                    <span class="error-message hidden">You need to enter a task first</span>
                                                    <span class="add-new-task-btn btn" id="add-task">Add Task</span>
                                                    <span class="cancel-btn btn" id="close-task-panel">Close</span>
                                                </div>
                                            </div>
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


   

    <div id="create_project" class="modal custom-modal fade" role="dialog">
        <div class="modal-dialog">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <div class="modal-content modal-lg">
                <div class="modal-header">
                    <h4 class="modal-title">Create Project</h4>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Project Name</label>
                                    <input class="form-control" type="text">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Client</label>
                                    <select class="select">
                                        <option>Global Technologies</option>
                                        <option>Delta Infotech</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Start Date</label>
                                    <div class="cal-icon"><input class="form-control datetimepicker" type="text"></div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>End Date</label>
                                    <div class="cal-icon"><input class="form-control datetimepicker" style="" type="text"></div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Rate</label>
                                    <input placeholder="$50" class="form-control" type="text">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>&nbsp;</label>
                                    <select class="select">
                                        <option>Hourly</option>
                                        <option>Fixed</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Priority</label>
                                    <select class="select">
                                        <option>High</option>
                                        <option>Medium</option>
                                        <option>Low</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Add Project Leader</label>
                                    <input class="form-control" type="text">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Team Leader</label>
                                    <div class="project-members">
                                        <a href="#" data-toggle="tooltip" title="Jeffery Lalor">
                                            <img src="assets/img/user.jpg" class="avatar" alt="Jeffery Lalor" height="20" width="20">
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Add Team</label>
                                    <input class="form-control" type="text">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Team Members</label>
                                    <div class="project-members">
                                        <a href="#" data-toggle="tooltip" title="John Doe">
                                            <img src="assets/img/user.jpg" class="avatar" alt="John Doe" height="20" width="20">
                                        </a>
                                        <a href="#" data-toggle="tooltip" title="Richard Miles">
                                            <img src="assets/img/user.jpg" class="avatar" alt="Richard Miles" height="20" width="20">
                                        </a>
                                        <a href="#" data-toggle="tooltip" title="John Smith">
                                            <img src="assets/img/user.jpg" class="avatar" alt="John Smith" height="20" width="20">
                                        </a>
                                        <a href="#" data-toggle="tooltip" title="Mike Litorus">
                                            <img src="assets/img/user.jpg" class="avatar" alt="Mike Litorus" height="20" width="20">
                                        </a>
                                        <span class="all-team">+2</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Description</label>
                            <textarea rows="4" cols="5" class="form-control" placeholder="Enter your message here"></textarea>
                        </div>
                        <div class="m-t-20 text-center">
                            <button class="btn btn-primary">Create Project</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    
    <div id="assignee" class="modal custom-modal fade center-modal" role="dialog">
        <div class="modal-dialog">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title">Assign to this task</h3>
                </div>
                <div class="modal-body">
                    <div class="input-group m-b-30">
                        <input placeholder="Search to add" class="form-control search-input input-lg" type="text">
                        <span class="input-group-btn">
                            <button class="btn btn-primary btn-lg">Search</button>
                        </span>
                    </div>
                    <div>
                        <ul class="media-list media-list-linked chat-user-list">
                            <li class="media">
                                <a href="#" class="media-link">
                                    <div class="media-left"><span class="avatar">R</span></div>
                                    <div class="media-body media-middle text-nowrap">
                                        <div class="user-name">Richard Miles</div>
                                        <span class="designation">Web Developer</span>
                                    </div>
                                </a>
                            </li>
                            <li class="media">
                                <a href="#" class="media-link">
                                    <div class="media-left"><span class="avatar">J</span></div>
                                    <div class="media-body media-middle text-nowrap">
                                        <div class="user-name">John Smith</div>
                                        <span class="designation">Android Developer</span>
                                    </div>
                                </a>
                            </li>
                            <li class="media">
                                <a href="#" class="media-link">
                                    <div class="media-left">
                                        <span class="avatar">
                                            <img src="assets/img/user.jpg" alt="John Doe">
                                        </span>
                                    </div>
                                    <div class="media-body media-middle text-nowrap">
                                        <div class="user-name">Jeffery Lalor</div>
                                        <span class="designation">Team Leader</span>
                                    </div>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="m-t-50 text-center">
                        <button class="btn btn-primary btn-lg">Assign</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="task_followers" class="modal custom-modal fade center-modal" role="dialog">
        <div class="modal-dialog">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title">Add followers to this task</h3>
                </div>
                <div class="modal-body">
                    <div class="input-group m-b-30">
                        <input placeholder="Search to add" class="form-control search-input input-lg" id="btn-input" type="text">
                        <span class="input-group-btn">
                            <button class="btn btn-primary btn-lg">Search</button>
                        </span>
                    </div>
                    <div>
                        <ul class="media-list media-list-linked chat-user-list">
                            <li class="media">
                                <a href="#" class="media-link">
                                    <div class="media-left"><span class="avatar">J</span></div>
                                    <div class="media-body media-middle text-nowrap">
                                        <div class="user-name">Jeffery Lalor</div>
                                        <span class="designation">Team Leader</span>
                                    </div>
                                </a>
                            </li>
                            <li class="media">
                                <a href="#" class="media-link">
                                    <div class="media-left"><span class="avatar">C</span></div>
                                    <div class="media-body media-middle text-nowrap">
                                        <div class="user-name">Catherine Manseau</div>
                                        <span class="designation">Android Developer</span>
                                    </div>
                                </a>
                            </li>
                            <li class="media">
                                <a href="#" class="media-link">
                                    <div class="media-left"><span class="avatar">W</span></div>
                                    <div class="media-body media-middle text-nowrap">
                                        <div class="user-name">Wilmer Deluna</div>
                                        <span class="designation">Team Leader</span>
                                    </div>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="m-t-50 text-center">
                        <button class="btn btn-primary btn-lg">Add to Follow</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


</div>






<div id="taskmodal" class="modal" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button onclick="opentaskmodalclose()" type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Modal Header</h4>
      </div>
      <div class="modal-body">
        <p>Some text in the modal.</p>
      </div>
      <div class="modal-footer">
        <button onclick="opentaskmodalclose()" type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>

<script>
function opentaskmodal()
{
document.getElementById("taskmodal").style.display="block";
}
function opentaskmodalclose()
{
document.getElementById("taskmodal").style.display="none";
}
</script>

</body>


</html> 