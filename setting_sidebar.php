<?php

$actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]";

$home = $actual_link ."/civilpro/dashbord.php"




?>
            <div class="sidebar" id="sidebar">
                <div class="sidebar-inner slimscroll">
					<div class="sidebar-menu">
						<ul>
							<li> 
							<a href="<?php echo $home; ?>"><i class="fa fa-home"></i> Back to Home</a>
							</li>
							<li class="menu-title">Settings</li>
							<li class="Company_Settings"> 
								<a href="settings.php">Company Settings</a>
							</li>
							<li> 
								<!--<a href="localization.html">Localization</a>-->
								<a href="#">Localization</a>
							</li>
							<li> 
								<!--<a href="theme-settings.html">Theme Settings</a>-->
								<a href="#">Theme Settings</a>
							</li>
							<li> 
								<a href="#">Roles & Permissions</a> <!-- roles-permissions.html -->
							</li>
							<li> 
								<!--<a href="email-settings.html">Email Settings</a>-->
								<a href="#">Email Settings</a>
							</li>
							<li> 
								<!--<a href="invoice-settings.html">Invoice Settings</a>-->

								<a href="#">Invoice Settings</a>
							</li>
							<li> 
								<a href="#">Salary Settings</a>
								<!--<a href="salary-settings.html">Salary Settings</a>-->
							</li>
							<li> 
								<!--<a href="notifications-settings.html">Notifications</a>-->

								<a href="#">Notifications</a>
							</li>
							<li class="change-password"> 
								<a href="change-password.php">Change Password</a>
							</li>
							<li class="leave-type"> 
								<!--<a href="leave-type.html">Leave Type</a>-->
								<a href="#">Leave Type</a>
							</li>
						</ul>
					</div>
                </div>
            </div>

             <script type="text/javascript">
         $(document).ready(function(){
         	
	var pgurl = window.location.href.substr(window.location.href.lastIndexOf("/") + 1);
	
	if(pgurl == 'change-password.php'){
	$('.sidebar-menu > ul > li.change-password').addClass('active');
						}
	if(pgurl == 'machines.php'){
	$('.sidebar-menu > ul > li.leave-type').addClass('active');
						}					
	if(pgurl == 'settings.php'){
	$('.sidebar-menu > ul > li.Company_Settings').addClass('active');
						}
						/*
	if(pgurl == 'projects.php'){
	$('.sidebar-menu > ul > li.Projects').addClass('active');
						}
						
	if(pgurl == 'users.php'){
	$('.sidebar-menu > ul > li.Users').addClass('active');
						}*/


            	});
            </script>