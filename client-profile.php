<?php
session_start();

include "header.php";
include "sidebar.php";

$obj = new  connection();
$con = $obj->connect();

?>

<div class="page-wrapper">
                <div class="content container-fluid">

				<?php 					
$clientId  = $_GET['id'];
$showclientprofile= mysqli_query($con,"SELECT * FROM Client where id= $clientId");
while($row = mysqli_fetch_array($showclientprofile)){

	/*echo "<pre>"; print_r($row); echo "</pre>";*/

?>

					<div class="row">
						<div class="col-sm-8">
							<h4 class="page-title">My Profile</h4>
						</div>
						<div class="col-sm-4 text-right m-b-30">
							<a href="edit-client-profile.php?id=<?php echo $row['id'];?>" class="btn btn-primary rounded"><i class="fa fa-plus"></i> Edit Profile</a>
						</div>
					</div>					
				
					<div class="card-box m-b-0">
						<div class="row">
							<div class="col-md-12">
								<div class="profile-view">
									<div class="profile-img-wrap">
										<div class="profile-img">
											<a href=""><img class="avatar" src="upload_images/<?php echo $row['img'];?> " alt=""></a>
										</div>
									</div>								
									<div class="profile-basic">
										<div class="row">
											<div class="col-md-5">
												<div class="profile-info-left">
													<h3 class="user-name m-t-0"><?php echo $row['company'];?></h3>
													<h5 class="company-role m-t-0 m-b-0"><?php echo $row['first_name'].' '.$row['last_name']?></h5>
													<small class="text-muted">CEO</small>
													<div class="staff-id">Employee ID : <?php echo $row['client_id'];?></div>
													<div class="staff-msg"><a href="chat.html" class="btn btn-primary">Send Message</a></div>
												</div>
											</div>
											<div class="col-md-7">
												<ul class="personal-info">
													<li>
														<span class="title">Phone:</span>
														<span class="text"><a href="#"><?php echo $row['phone_no'];?></a></span>
													</li>
													<li>
														<span class="title">Email:</span>
														<span class="text"><a href="#"><?php echo $row['email'];?></a></span>
													</li>
													<li>
														<span class="title">Birthday:</span>
														<span class="text"><?php echo $row['birthday'];?></span>
													</li>
													<li>
														<span class="title">Address:</span>
														<span class="text"><?php echo $row['address'];?></span>
													</li>
													<li>
														<span class="title">Gender:</span>
														<span class="text"><?php echo $row['gender'];?></span>
													</li>
												</ul>
											</div>
										</div>
									</div>


								</div>
							</div>
						</div>
					</div>	
					<?php } ?>
					<div class="card-box tab-box">						
						<div class="row user-tabs">
							<div class="col-lg-12 col-md-12 col-sm-12 line-tabs">
								<ul class="nav nav-tabs tabs nav-tabs-bottom">
									<li class="active col-sm-3"><a data-toggle="tab" href="#myprojects">My Projects</a></li>
									<li class="col-sm-3"><a data-toggle="tab" href="#tasks">Tasks</a></li>
								</ul>
							</div>
						</div>
					</div>

					<?php

					$clientId2  = $_GET['id'];

					$get_project = "SELECT * FROM Project WHERE Client_id = $clientId2";
					$result_value = mysqli_query($con,$get_project);
					
					?>
					
                    <div class="row">
                        <div class="col-lg-12"> 
							<div class="tab-content  profile-tab-content">

								
								<div id="myprojects" class="tab-pane fade in active">


									<div class="row">
									<?php 
								while ($val = mysqli_fetch_array($result_value)) {
									/*echo "<pre>"; print_r($val); echo "</pre>";
									die('45');*/
								
								?>
										<div class="col-lg-3 col-sm-4">
											<div class="card-box project-box">
												<div class="dropdown profile-action">
													<a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
													<ul class="dropdown-menu pull-right">
														<li><a href="#" data-toggle="modal" data-target="#edit_project"><i class="fa fa-pencil m-r-5"></i> Edit</a></li>
														<li><a href="#" data-toggle="modal" data-target="#delete_project"><i class="fa fa-trash-o m-r-5"></i> Delete</a></li>
													</ul>
												</div>
												<h4 class="project-title"><a href="project-view.html"><?php echo $val['Project_name']; ?><!-- Food and Drinks --></a></h4>
												<small class="block text-ellipsis m-b-15">
													<span class="text-xs">1</span> <span class="text-muted">open tasks, </span>
													<span class="text-xs">9</span> <span class="text-muted">tasks completed</span>
												</small>
												<p class="text-muted"><?php echo $val['decription']; ?>
												</p>
												<div class="pro-deadline m-b-15">
													<div class="sub-title">
														Deadline:
													</div>
													<div class="text-muted">
														<?php echo $val['end_date']; ?>
													</div>
												</div>
												<div class="project-members m-b-15">
													<div>Project Leader :</div>
													<ul class="team-members">
														<li>
															<a href="#" data-toggle="tooltip" title="<?php echo $val['Project_leader']; ?>"><img src="assets/img/user.jpg" alt="Jeffery Lalor"></a>
														</li>
													</ul>
												</div>
												<div class="project-members m-b-15">
													<div>Team :</div>
													<ul class="team-members">
														<li>
															<a href="#" data-toggle="tooltip" title="<?php echo $val['Team_member']; ?>"><img src="assets/img/user.jpg" alt="John Doe"></a>
														</li>
														<!-- <li>
															<a href="#" data-toggle="tooltip" title="Richard Miles"><img src="assets/img/user.jpg" alt="Richard Miles"></a>
														</li>
														<li>
															<a href="#" data-toggle="tooltip" title="John Smith"><img src="assets/img/user.jpg" alt="John Smith"></a>
														</li>
														<li>
															<a href="#" data-toggle="tooltip" title="Mike Litorus"><img src="assets/img/user.jpg" alt="Mike Litorus"></a>
														</li> -->
														<li>
															<a href="#" class="all-users">+15</a>
														</li>
													</ul>
												</div>
												<p class="m-b-5">Progress <span class="text-success pull-right">40%</span></p>
												<div class="progress progress-xs m-b-0">
													<div class="progress-bar progress-bar-success" role="progressbar" data-toggle="tooltip" title="40%" style="width: 40%"></div>
												</div>
											</div>
										</div>

										<?php } ?>


										
										
										
									</div>
								</div>
								<div id="tasks" class="tab-pane fade">
									<div class="project-task">
										<div class="tabbable">
											<ul class="nav nav-tabs nav-tabs-top nav-justified m-b-0">
												<li class="active"><a href="#all_tasks" data-toggle="tab" aria-expanded="true">All Tasks</a></li>
												<li><a href="#pending_tasks" data-toggle="tab" aria-expanded="false">Pending Tasks</a></li>
												<li><a href="#completed_tasks" data-toggle="tab" aria-expanded="false">Completed Tasks</a></li>
											</ul>
											<div class="tab-content">
												<div class="tab-pane active" id="all_tasks">
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
																	<textarea  id="new-task" placeholder="Enter new task here. . ."></textarea>
																	<span class="error-message hidden">You need to enter a task first</span>
																	<span class="add-new-task-btn btn" id="add-task">Add Task</span>
																	<span class="cancel-btn btn" id="close-task-panel">Close</span>
																</div>
															</div>
														</div>
													</div>
												</div>
												<div class="tab-pane" id="pending_tasks"></div>
												<div class="tab-pane" id="completed_tasks"></div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="notification-box">
					<div class="msg-sidebar notifications msg-noti">
						<div class="topnav-dropdown-header">
							<span>Messages</span>
						</div>
						<div class="drop-scroll msg-list-scroll">
							<ul class="list-box">
								<li>
									<a href="chat.html">
										<div class="list-item">
											<div class="list-left">
												<span class="avatar">R</span>
											</div>
											<div class="list-body">
												<span class="message-author">Richard Miles </span>
												<span class="message-time">12:28 AM</span>
												<div class="clearfix"></div>
												<span class="message-content">Lorem ipsum dolor sit amet, consectetur adipiscing</span>
											</div>
										</div>
									</a>
								</li>
								<li>
									<a href="chat.html">
										<div class="list-item new-message">
											<div class="list-left">
												<span class="avatar">J</span>
											</div>
											<div class="list-body">
												<span class="message-author">John Doe</span>
												<span class="message-time">1 Aug</span>
												<div class="clearfix"></div>
												<span class="message-content">Lorem ipsum dolor sit amet, consectetur adipiscing</span>
											</div>
										</div>
									</a>
								</li>
								<li>
									<a href="chat.html">
										<div class="list-item">
											<div class="list-left">
												<span class="avatar">T</span>
											</div>
											<div class="list-body">
												<span class="message-author"> Tarah Shropshire </span>
												<span class="message-time">12:28 AM</span>
												<div class="clearfix"></div>
												<span class="message-content">Lorem ipsum dolor sit amet, consectetur adipiscing</span>
											</div>
										</div>
									</a>
								</li>
								<li>
									<a href="chat.html">
										<div class="list-item">
											<div class="list-left">
												<span class="avatar">M</span>
											</div>
											<div class="list-body">
												<span class="message-author">Mike Litorus</span>
												<span class="message-time">12:28 AM</span>
												<div class="clearfix"></div>
												<span class="message-content">Lorem ipsum dolor sit amet, consectetur adipiscing</span>
											</div>
										</div>
									</a>
								</li>
								<li>
									<a href="chat.html">
										<div class="list-item">
											<div class="list-left">
												<span class="avatar">C</span>
											</div>
											<div class="list-body">
												<span class="message-author"> Catherine Manseau </span>
												<span class="message-time">12:28 AM</span>
												<div class="clearfix"></div>
												<span class="message-content">Lorem ipsum dolor sit amet, consectetur adipiscing</span>
											</div>
										</div>
									</a>
								</li>
								<li>
									<a href="chat.html">
										<div class="list-item">
											<div class="list-left">
												<span class="avatar">D</span>
											</div>
											<div class="list-body">
												<span class="message-author"> Domenic Houston </span>
												<span class="message-time">12:28 AM</span>
												<div class="clearfix"></div>
												<span class="message-content">Lorem ipsum dolor sit amet, consectetur adipiscing</span>
											</div>
										</div>
									</a>
								</li>
								<li>
									<a href="chat.html">
										<div class="list-item">
											<div class="list-left">
												<span class="avatar">B</span>
											</div>
											<div class="list-body">
												<span class="message-author"> Buster Wigton </span>
												<span class="message-time">12:28 AM</span>
												<div class="clearfix"></div>
												<span class="message-content">Lorem ipsum dolor sit amet, consectetur adipiscing</span>
											</div>
										</div>
									</a>
								</li>
								<li>
									<a href="chat.html">
										<div class="list-item">
											<div class="list-left">
												<span class="avatar">R</span>
											</div>
											<div class="list-body">
												<span class="message-author"> Rolland Webber </span>
												<span class="message-time">12:28 AM</span>
												<div class="clearfix"></div>
												<span class="message-content">Lorem ipsum dolor sit amet, consectetur adipiscing</span>
											</div>
										</div>
									</a>
								</li>
								<li>
									<a href="chat.html">
										<div class="list-item">
											<div class="list-left">
												<span class="avatar">C</span>
											</div>
											<div class="list-body">
												<span class="message-author"> Claire Mapes </span>
												<span class="message-time">12:28 AM</span>
												<div class="clearfix"></div>
												<span class="message-content">Lorem ipsum dolor sit amet, consectetur adipiscing</span>
											</div>
										</div>
									</a>
								</li>
								<li>
									<a href="chat.html">
										<div class="list-item">
											<div class="list-left">
												<span class="avatar">M</span>
											</div>
											<div class="list-body">
												<span class="message-author">Melita Faucher</span>
												<span class="message-time">12:28 AM</span>
												<div class="clearfix"></div>
												<span class="message-content">Lorem ipsum dolor sit amet, consectetur adipiscing</span>
											</div>
										</div>
									</a>
								</li>
								<li>
									<a href="chat.html">
										<div class="list-item">
											<div class="list-left">
												<span class="avatar">J</span>
											</div>
											<div class="list-body">
												<span class="message-author">Jeffery Lalor</span>
												<span class="message-time">12:28 AM</span>
												<div class="clearfix"></div>
												<span class="message-content">Lorem ipsum dolor sit amet, consectetur adipiscing</span>
											</div>
										</div>
									</a>
								</li>
								<li>
									<a href="chat.html">
										<div class="list-item">
											<div class="list-left">
												<span class="avatar">L</span>
											</div>
											<div class="list-body">
												<span class="message-author">Loren Gatlin</span>
												<span class="message-time">12:28 AM</span>
												<div class="clearfix"></div>
												<span class="message-content">Lorem ipsum dolor sit amet, consectetur adipiscing</span>
											</div>
										</div>
									</a>
								</li>
								<li>
									<a href="chat.html">
										<div class="list-item">
											<div class="list-left">
												<span class="avatar">T</span>
											</div>
											<div class="list-body">
												<span class="message-author">Tarah Shropshire</span>
												<span class="message-time">12:28 AM</span>
												<div class="clearfix"></div>
												<span class="message-content">Lorem ipsum dolor sit amet, consectetur adipiscing</span>
											</div>
										</div>
									</a>
								</li>
							</ul>
						</div>
						<div class="topnav-dropdown-footer">
							<a href="chat.html">See all messages</a>
						</div>
					</div>
				</div>
            </div>
			<?php
include "footer.php";
?>