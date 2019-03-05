<?php

include "url_file.php";
$connn = mysqli_connect('157.230.57.197','root','Ithours_123','attodayi_civilpro');

$current_url = basename($_SERVER['PHP_SELF']);
$active = "class=\"active\"";
$activeClass = "active";

$removeClass = "";

?>        
<!-- <style type="text/css">
	 li.submenu.employeesphp a{color:red;}
</style>  --> 
           <div class="sidebar" id="sidebar">
                <div class="sidebar-inner slimscroll">
					<div id="sidebar-menu" class="sidebar-menu">
						<ul>
							<li <?php echo ($current_url == "dashbord.php") ? $active : ''?> > 
								<a href='<?php echo "$home_url"; ?>'>Dashboard</a>
							</li>
								<li class="submenu employeesphp">
								<a href="#" class="noti-dot"><span> Employees</span> <span class="menu-arrow"></span></a>


								<ul class="list-unstyled All_Employee allEmployeeUl" <?php if(($current_url != "employees.php") || ($current_url != "holidays.php") || ($current_url != "departments.php") || ($current_url != "designations.php") ) { ?> style="display: none;" <?php } ?> >

									<li <?php echo ($current_url == "employees.php") ? $active : ''?> ><a <?php echo ($current_url == "employees.php") ? $active : ''?> href="employees.php">All Employees</a></li>

									 <li <?php echo ($current_url == "holidays.php") ? $active : ''?>><a <?php echo ($current_url == "holidays.php") ? $active : ''?> href="holidays.php">Holidays</a></li>
									<!--<li><a href="#"><span>Leave Requests</span> <span class="badge bg-primary pull-right">1</span></a></li>
									<li><a href="#">Attendance</a></li> -->
									<li <?php echo ($current_url == "departments.php") ? $active : ''?>><a <?php echo ($current_url == "departments.php") ? $active : ''?> href="departments.php">Departments</a></li>
									<li <?php echo ($current_url == "designations.php") ? $active : ''?>><a <?php echo ($current_url == "designations.php") ? $active : ''?> href="designations.php">Designations</a></li>
								</ul>
							</li>
					<!--	<li class="leads"> 
								<a href="leads.html">Leads</a>
								<a href="#">Leads</a>
							</li>-->
							<li <?php echo ($current_url == "clients.php") ? 'class="Clients '.$activeClass.'"' : 'class="Clients '.$removeClass.'"' ?>> 
								<a href="clients.php">Clients</a>
							</li>
							<li <?php echo ($current_url == "machines.php") ? 'class="Machines '.$activeClass.'"' : 'class="Machines '.$removeClass.'"' ?>> 
								<a href="machines.php">Machines</a>							
							</li>
							<li <?php echo ($current_url == "materials.php") ? 'class="materials '.$activeClass.'"' : 'class="materials '.$removeClass.'"' ?>> 
								<a href="materials.php">Materials</a>
							</li>
							<li  <?php echo ($current_url == "projects.php") ? 'class="Projects '.$activeClass.'"' : 'class="Projects '.$removeClass.'"' ?>> 
								<a href="projects.php">Projects</a>
									<!-- <?php
                $log_user_qury = "SELECT Project_id ,Project_name from Project";
                $res_data = mysqli_query($con, $log_user_qury);
                ?>
                        <ul class="list-unstyled " id="projectid" class="form-control"style="display: none;" name="project_id">
                            
                            <?php	if ($res_data->num_rows > 0) {
                                while ($row = $res_data->fetch_assoc()) {
                                    ?>
                            <li  style="color:#fff" value="<?php echo $row['Project_id']; ?>">
                                <a href=""><?php echo $row['Project_name']; ?></a>
                            </li>
                            <?php 
                        }
                    } ?>
                        </ul> -->

							</li>
							<li <?php echo ($current_url == "tasks.php") ? 'class="Projects '.$activeClass.'"' : 'class="Projects '.$removeClass.'"' ?>> 
								<a href="tasks.php">Tasks</a>
							</li>
							<!--<li class="Tasks"> 
								<a href="tasks.html">Tasks</a>
								<a href="#">Tasks</a>
							</li>-->
							<li <?php echo ($current_url == "worksheet.php") ? 'class="Cards '.$activeClass.'"' : 'class="Cards '.$removeClass.'"' ?>> 
								<a href="worksheet.php">Time Cards</a>
							</li>
							<li class="Field">
								<!--<a href="expense-reports.html">Field Report</a>-->
								<a href="expense-reports.php">Field Report</a>
							</li>
							<li class="Excavator"> 
								<!--<a href="excavator-daily-log.html">Excavator Daily Log</a>-->
								<a href="excavator-log-list.php">Excavator Daily Log</a>
							</li>
							<li class="Chatt"> 
								<a href="chat_list.php">
								Chat 
								<span class="badge bg-primary pull-right " id="unreadcount" ></span></a>

							</li>
							<?php

								$user_id = $_SESSION['user_id'];
								$selct_user = "SELECT * FROM Users WHERE user_id = '$user_id'";
								$user_query = mysqli_query($connn,$selct_user);
								$get_user_role = mysqli_fetch_object($user_query);
								if($get_user_role->user_role == '1'){
									echo "<li class='Users'> 
												<a href='users.php'>Users</a>
										  </li>";
								}
							?>
							
						<!--	<li class="Activities"> 
								<a href="activities.html">Activities</a>
								<a href="#">Activities</a>
							</li>-->
							<!--	<li class="submenu">
								<a href="#"><span> Calls</span> <span class="menu-arrow"></span></a>
								<ul class="list-unstyled" style="display: none;">
									<li><a href="voice-call.html">Voice Call</a></li>
									<li><a href="video-call.html">Video Call</a></li>
									<li><a href="incoming-call.html">Incoming Call</a></li>

									<li><a href="#">Voice Call</a></li>
									<li><a href="#">Video Call</a></li>
									<li><a href="#">Incoming Call</a></li>
								</ul>
							</li>-->
						<!--	<li class="Email"> 
								<a href="inbox.html">Email</a>
								<a href="#">Email</a>
							</li>
							<li class="Events">
								<a href="events.html">Events</a>
								<a href="#">Events</a>
							</li>
							<li class="Contacts"> 
								<a href="contacts.html">Contacts</a>
								<a href="#">Contacts</a>
							</li>
							<li class="Tickets"> 
								<a href="tickets.html">Tickets</a>
								<a href="#">Tickets</a>
							</li>
							<li class="submenu">
								<a href="#"><span> Payroll </span> <span class="menu-arrow"></span></a>
								<ul class="list-unstyled" style="display: none;">
									<li><a href="#"> Employee Salary </a></li>
									<li><a href="#"> Payslip </a></li>

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

									<li><a href="#">Estimates</a></li>
									<li><a href="#">Invoices</a></li>
									<li><a href="#">Payments</a></li>
									<li><a href="#">Expenses</a></li>
									<li><a href="#">Provident Fund</a></li>
									<li><a href="#">Taxes</a></li>
								</ul>
							</li>-->
							<!--<li class="Assets"> 
								<a href="assets.html">Assets</a>
								<a href="#">Assets</a>
							</li>-->
							<li class="Settings"> 
								<a href="settings.php">Settings</a>
							</li>
							<li class="submenu">
								<a href="#"><span> Pages </span> <span class="menu-arrow"></span></a>
								<ul class="list-unstyled" <?php if(($current_url != "login.php") || ($current_url != "register.php") || ($current_url != "forgot-password.php") || ($current_url != "profile.php") ) { ?> style="display: none;" <?php } ?> >
									<li <?php echo ($current_url == "login.php") ? $active : ''?> ><a <?php echo ($current_url == "login.php") ? $active : ''?> href="login.php"> Login </a></li>
									<li <?php echo ($current_url == "register.php") ? $active : ''?> ><a <?php echo ($current_url == "register.php") ? $active : ''?> href="register.php"> Register </a></li>
									<li <?php echo ($current_url == "forgot-password.php") ? $active : ''?> ><a <?php echo ($current_url == "forgot-password.php") ? $active : ''?> href="forgot-password.php"> Forgot Password </a></li>
									<li <?php echo ($current_url == "profile.php") ? $active : ''?> ><a <?php echo ($current_url == "profile.php") ? $active : ''?> href="profile.php"> Profile </a></li>
								</ul>
							</li>
						</ul>
					</div>
                </div>
            </div>

            
      <script type="text/javascript">
         $(document).ready(function(){

	     /*	$('.allEmployeeUl li a').click(function(e) {
		        e.preventDefault();
		        $('a').removeClass('active');
		        $(this).addClass('active');
	    	});
*/
         	/*$('li.submenu.employees.php').removeClass('active');

         	
	var pgurl = window.location.href.substr(window.location.href.lastIndexOf("/") + 1);
	
	if(pgurl == 'clients.php'){
	$('.sidebar-menu > ul > li.Clients').addClass('active');
						}
	if(pgurl == 'machines.php'){
	$('.sidebar-menu > ul > li.Machines').addClass('active');
						}					
	if(pgurl == 'materials.php'){
	$('.sidebar-menu > ul > li.materials').addClass('active');
						}
	if(pgurl == 'projects.php'){
	$('.sidebar-menu > ul > li.Projects').addClass('active');
						}
						
	if(pgurl == 'users.php'){
	$('.sidebar-menu > ul > li.Users').addClass('active');
						}
						//kjhfdkjfhj
	if(pgurl == 'settings.php'){
	$('.sidebar-menu > ul > li.Settings').addClass('active');
						}
	if(pgurl == 'employees.php'){
	$('li.employee_all').addClass('active');
	$('#sidebar-menu ul ul').css('display','block');
		}else{
			$('#sidebar-menu ul ul').css('display','none');
			//$('li.submenu.employeesphp').removeClass('active');
		}
	if(pgurl == 'worksheet.php'){
	$('.sidebar-menu > ul > li.Cards').addClass('active');
						}
	if(pgurl == 'dashbord.php'){
	$('li.submenu.employeesphp').removeClass('active');
					}*/
						
						/*
	if(pgurl == 'change-password.php'){
	$('.sidebar-menu > ul > li.materials').addClass('active');
						}					
	if(pgurl == 'materials.php'){
	$('.sidebar-menu > ul > li.materials').addClass('active');
						}
	if(pgurl == 'materials.php'){
	$('.sidebar-menu > ul > li.materials').addClass('active');
						}
	if(pgurl == 'materials.php'){
	$('.sidebar-menu > ul > li.materials').addClass('active');
						}
	if(pgurl == 'materials.php'){
	$('.sidebar-menu > ul > li.materials').addClass('active');
						}
	if(pgurl == 'materials.php'){
	$('.sidebar-menu > ul > li.materials').addClass('active');
						}	*/				


            	});
            </script>