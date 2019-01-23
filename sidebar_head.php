<?php

include "url_file.php";
$connn = mysqli_connect('localhost','root','','civilpro');



?>   
     
           <div class="sidebar" id="sidebar">
                <div class="sidebar-inner slimscroll">
					<div id="sidebar-menu" class="sidebar-menu">
						<ul>
							<li class="active"> 
								<a href='<?php echo "$home_url"; ?>'>Dashboard</a>
							</li>
							<li class="submenu">
								<a href="#" class="noti-dot"><span> Employees</span> <span class="menu-arrow"></span></a>
								<ul class="list-unstyled" style="display: none;">
									<li><a href="employees.php">All Employees</a></li>
									<!-- <li class="active"><a href="holidays.php">Holidays</a></li>
									<li><a href="leaves.html"><span>Leave Requests</span> <span class="badge bg-primary pull-right">1</span></a></li>
									<li><a href="attendance.html">Attendance</a></li> -->
									<li><a href="departments.php">Departments</a></li>
									<li><a href="designations.php">Designations</a></li>
								</ul>
							</li>
							<!--<li> 
								<a href="leads.html">Leads</a>
							</li>-->
							<li> 
								<a href="clients.php">Clients</a>
							</li>
							<li> 
								<a href="machines.php">Machines</a>
							</li>
							</li>
							<li> 
								<a href="materials.php">Materials</a>
							</li>
							<li> 
								<a href="projects.php">Projects</a>
							</li>
							<!--<li> 
								<a href="tasks.html">Tasks</a>
							</li>-->
							<li> 
								<a href="worksheet.php">Time Cards</a>
							</li>
							<li>
								<a href="expense-reports.html">Field Report</a>
							</li>
							<li> 
								<a href="#">Excavator Daily Log</a>
							</li>
							<li> 
								<a href="#">Chat <span class="badge bg-primary pull-right">5</span></a>
							</li>
							<?php

								$user_id = $_SESSION['user_id'];
								$selct_user = "SELECT * FROM Users WHERE user_id = '$user_id'";
								$user_query = mysqli_query($connn,$selct_user);
								$get_user_role = mysqli_fetch_object($user_query);
								if($get_user_role->user_role == '1'){
									echo "<li> 
												<a href='users.php'>Users</a>
										  </li>";
								}
							?>
							
							<!--	<li> 
								<a href="activities.html">Activities</a>
							</li>-->
							<li class="submenu">
								<a href="#"><span> Calls</span> <span class="menu-arrow"></span></a>
								<ul class="list-unstyled" style="display: none;">
									<li><a href="voice-call.html">Voice Call</a></li>
									<li><a href="video-call.html">Video Call</a></li>
									<li><a href="incoming-call.html">Incoming Call</a></li>
								</ul>
							</li>
							<!--<li> 
								<a href="inbox.html">Email</a>
							</li>
							<li>
								<a href="events.html">Events</a>
							</li>-->
							<li> 
								<a href="contacts.html">Contacts</a>
							</li>
							<li> 
								<a href="tickets.html">Tickets</a>
							</li>
						<!--	<li class="submenu">
								<a href="#"><span> Payroll </span> <span class="menu-arrow"></span></a>
								<ul class="list-unstyled" style="display: none;">
									<li><a href="salary.html"> Employee Salary </a></li>
									<li><a href="salary-view.html"> Payslip </a></li>
								</ul>
							</li>-->
							<!--<li class="submenu">
								<a href="#"><span> Accounts </span> <span class="menu-arrow"></span></a>
								<ul class="list-unstyled" style="display: none;">
									<li><a href="estimates.html">Estimates</a></li>
									<li><a href="invoices.html">Invoices</a></li>
									<li><a href="payments.html">Payments</a></li>
									<li><a href="expenses.html">Expenses</a></li>
									<li><a href="provident-fund.html">Provident Fund</a></li>
									<li><a href="taxes.html">Taxes</a></li>
								</ul>
							</li>-->
							<!--<li> 
								<a href="assets.html">Assets</a>
							</li>-->
							<li> 
								<a href="settings.php">Settings</a>
							</li>
							<li class="submenu">
								<a href="#"><span> Pages </span> <span class="menu-arrow"></span></a>
								<ul class="list-unstyled" style="display: none;">
									<li><a href="login.php"> Login </a></li>
									<li><a href="register.php"> Register </a></li>
									<li><a href="forgot-password.php"> Forgot Password </a></li>
									<li><a href="profile.php"> Profile </a></li>
								</ul>
							</li>
						</ul>
					</div>
                </div>
            </div>