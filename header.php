<?php

session_start();
require "config/config.php";
$obj = new connection();
$con = $obj->connect();

$user_id = $_SESSION['user_id'];
$user_log = "SELECT * FROM Users where user_id = '$user_id'";
$ueser_d = mysqli_query($con, $user_log);
$fetch_data = mysqli_fetch_object($ueser_d);



if(!isset($_SESSION['user_id'])){
	echo "<script>location.href='http://$_SERVER[HTTP_HOST]/civilpro/';</script>";
	//header('Location: http://$_SERVER[HTTP_HOST]/civilpro/');
}

?>
<!DOCTYPE html>
<html  >
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
        <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.png">
        <title>Dashboard - HRMS admin template</title>
		<link href="https://fonts.googleapis.com/css?family=Montserrat:300,400,500,600,700" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="assets/css/font-awesome.min.css">
		<link rel="stylesheet" type="text/css" href="assets/css/select2.min.css">
        <link rel="stylesheet" type="text/css" href="assets/css/style.css">
		<link rel="stylesheet" type="text/css" href="assets/css/dataTables.bootstrap.min.css">	
		<link rel="stylesheet" type="text/css" href="assets/css/bootstrap-datetimepicker.min.css">
		<link rel="stylesheet" type="text/css" href="assets/plugins/summernote/dist/summernote.css">
		<script src="http://157.230.57.197:9200/socket.io/socket.io.js"></script>
		<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.9/angular.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.2/moment.min.js">

		<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-timeago/1.6.3/jquery.timeago.min.js"></script>
		 <script type="text/javascript" src="assets/js/jquery-3.2.1.min.js"></script>
		 <script type="text/javascript" src="lib/chat.js?id=1.1"></script>
		<!--[if lt IE 9]>
			<script src="assets/js/html5shiv.min.js"></script>
			<script src="assets/js/respond.min.js"></script>
		<![endif]-->

		<script>
		function reloadGroup(id){
			window.chatAPIAddress="http://157.230.57.197:9100";

			localStorage.setItem("USERID", id);

			userId = localStorage.getItem("USERID");
    if(userId){
		
		var xmlHttp = new XMLHttpRequest();
    xmlHttp.onreadystatechange = function() { 
        if (xmlHttp.readyState == 4 && xmlHttp.status == 200)
            {
				try{
				var res={
					data : JSON.parse(xmlHttp.responseText)
				}
				     localStorage.setItem("GROUPS", JSON.stringify(res.data.groups));
			 localStorage.setItem("MESSAGES", JSON.stringify(res.data.messages));
			}catch(err){
			console.log(err);	
			}
			}
    }
    xmlHttp.open("GET", window.chatAPIAddress+'/GETUSERCHATGROUPS/' + userId, true); // true for asynchronous 
	xmlHttp.send(null);
	
	}
	
		}
		</script>

<?php
		if(!isset($_SESSION['user_id'])){
	echo "<script>location.href='http://$_SERVER[HTTP_HOST]/civilpro/';</script>";
	//header('Location: http://$_SERVER[HTTP_HOST]/civilpro/');
}else{
	echo '<script>reloadGroup('.$user_id.')</script>';
}

?>
    </head>
	 <body class="deshboard-1" ng-app="data" ng-controller="mainController">
        <div class="main-wrapper">
            <div class="header">
                <div class="header-left">
                    <a href="<?php echo  $base_url1; ?>" class="logo">
						<img src="assets/img/logo.png" width="40" height="40" alt="">
					</a>
                </div>
                <div class="page-title-box pull-left">
					<h3>Civil Pro</h3>
                </div>
				<a id="mobile_btn" class="mobile_btn pull-left" href="#sidebar"><i class="fa fa-bars" aria-hidden="true"></i></a>
				<ul class="nav navbar-nav navbar-right user-menu pull-right">
					<li class="dropdown hidden-xs">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-bell-o"></i> <span class="badge bg-purple pull-right">3</span></a>
						<div class="dropdown-menu notifications">
							<div class="topnav-dropdown-header">
								<span>Notifications</span>
							</div>
							<div class="drop-scroll">
								<ul class="media-list">
									<li class="media notification-message">
										<a href="#">
											<div class="media-left">
												<span class="avatar">
													<img alt="John Doe" src="assets/img/user.jpg" class="img-responsive img-circle">
												</span>
											</div>
											<div class="media-body">
												<p class="m-0 noti-details"><span class="noti-title">John Doe</span> added new task <span class="noti-title">Patient appointment booking</span></p>
												<p class="m-0"><span class="notification-time">4 mins ago</span></p>
											</div>
										</a>
									</li>
									<li class="media notification-message">
										<a href="#">
											<div class="media-left">
												<span class="avatar">V</span>
											</div>
											<div class="media-body">
												<p class="m-0 noti-details"><span class="noti-title">Tarah Shropshire</span> changed the task name <span class="noti-title">Appointment booking with payment gateway</span></p>
												<p class="m-0"><span class="notification-time">6 mins ago</span></p>
											</div>
										</a>
									</li>
									<li class="media notification-message">
										<a href="#">
											<div class="media-left">
												<span class="avatar">L</span>
											</div>
											<div class="media-body">
												<p class="m-0 noti-details"><span class="noti-title">Misty Tison</span> added <span class="noti-title">Domenic Houston</span> and <span class="noti-title">Claire Mapes</span> to project <span class="noti-title">Doctor available module</span></p>
												<p class="m-0"><span class="notification-time">8 mins ago</span></p>
											</div>
										</a>
									</li>
									<li class="media notification-message">
										<a href="#">
											<div class="media-left">
												<span class="avatar">G</span>
											</div>
											<div class="media-body">
												<p class="m-0 noti-details"><span class="noti-title">Rolland Webber</span> completed task <span class="noti-title">Patient and Doctor video conferencing</span></p>
												<p class="m-0"><span class="notification-time">12 mins ago</span></p>
											</div>
										</a>
									</li>
									<li class="media notification-message">
										<a href="#">
											<div class="media-left">
												<span class="avatar">V</span>
											</div>
											<div class="media-body">
												<p class="m-0 noti-details"><span class="noti-title">Bernardo Galaviz</span> added new task <span class="noti-title">Private chat module</span></p>
												<p class="m-0"><span class="notification-time">2 days ago</span></p>
											</div>
										</a>
									</li>
								</ul>
							</div>
							<div class="topnav-dropdown-footer">
								<a href="#">View all Notifications</a>
							</div>
						</div>
					</li>
					<li class="dropdown hidden-xs">
						<a href="javascript:;" id="open_msg_box" class="hasnotifications"><i class="fa fa-comment-o"></i> <span class="badge bg-purple pull-right">8</span></a>
					</li>	
					<li class="dropdown">
						<a href="profile.php" class="dropdown-toggle user-link" data-toggle="dropdown" title="Admin">

			<span class="user-img"><img style="height:54px;width:54px;" class="img-circle" src="upload_images/<?php if(isset($fetch_data->img) && !empty($fetch_data->img)){ echo $fetch_data->img; } else { echo "user.jpg"; }?>" width="40" alt="img">
							<span class="status online"></span></span>
							<span><?php echo ucfirst($fetch_data->first_name); ?></span>
							<i class="caret"></i>
						</a>
						<ul class="dropdown-menu">
							<li><a href="profile.php">My Profile</a></li>
							<li><a href="edit-profile.php">Edit Profile</a></li>
							<li><a href="settings.php">Settings</a></li>
							<li><a href="logout.php">Logout</a></li>
						</ul>
					</li>
				</ul>
				<div class="dropdown mobile-user-menu pull-right">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
					<ul class="dropdown-menu pull-right">
						<li><a href="profile.php">My Profile</a></li>
						<li><a href="edit-profile.php">Edit Profile</a></li>
						<li><a href="settings.php">Settings</a></li>
						<li><a href="logout.php">Logout</a></li>
					</ul>
				</div>
            </div>
			
			 <script type="text/javascript">
			 $(document).ready(function(){
			 $(".ref_page").click(function(){
			 var pageURL = $(location).attr("href");
			window.location.href = pageURL;
			 //location.reload();
			 
			 });
			 });
			 
            	/*$(document).ready(function(){

					$('.sidebar-menu > ul > li').click(function(){
            			 
       					 $(this).addClass('active');

            		});


			$(function() {
			      var pgurl = window.location.href.substr(window.location.href
			         .lastIndexOf("/") + 1);

			      $(".sidebar-menu > ul > li").each(function() {

			         if ($(this).attr("href") == pgurl || $(this).attr("href") == '')
			            $(this).addClass("active");
			      })
			   });




            	});*/
            </script>



			<script>
     
     var groupId = "5bdc29dafecffb0a1cbf450f";
      var userId = "-1";

     $(function () {
      
     

      $("#f").click(function(){
        
      });

      $("#s").click(function(){
        userId ="5bd6b7e295e9346be0ce5d03";
        localStorage.setItem("USERID",userId )
        socket.emit('connectUser', { UserId: userId });
      });
     
   

      $("#d").click(function(value){
       var msg = "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSl2ibKfw9K6ntYDgzFx55xcEiOZSO7YBASCruP5R5ckNE2Sv5K";
        socket.emit('mediaMessage', { GroupId: groupId, SenderId: localStorage.getItem("USERID"), MsgText: msg, ClientMessageId: -1, TaggedMessge: "defaultMessage", MediaType: 0, VideoImage: "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSl2ibKfw9K6ntYDgzFx55xcEiOZSO7YBASCruP5R5ckNE2Sv5K" });
      });


       $("#msgbtn").click(function(){
         
         var msg = $("#msgtext").val();
        socket.emit('textMessage', { GroupId: groupId, SenderId: localStorage.getItem("USERID"), MsgText: msg, ClientMessageId: "-1", isNotification: false });
      });

$("#creategrp").click(function(){
         
         var members =["5bd6b84495e9346be0ce5d48","5bd6b7e295e9346be0ce5d03"];
        socket.emit('createGroup', { GroupName: "professionals gang", ProfileURLOfGroup:"https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQ28Oh0cPaHHL2bGVU-vDd-9fIOE3ZGOQUXx-pj6XKoSDbpKYfa", SenderId: localStorage.getItem("USERID"),Members: members});
      });

$("#addMember").click(function(){
         
         var members =["5bd6b84495e9346be0ce5d48","5bd6b7e295e9346be0ce5d03"];
        socket.emit('addMemberToGroup', { GroupId: groupId, SenderId: localStorage.getItem("USERID"), Members: members});
      });

$("#deleteMember").click(function(){
         
         var members =["5bd6b84495e9346be0ce5d48"];
        socket.emit('deleteMemberFromGroup', { GroupId: groupId, SenderId: localStorage.getItem("USERID"), Members: members});
      });



      

   
    socket.on('onTextMessage', function (data) {
         console.log(data);
        socket.emit('readNotification', {GroupId: groupId, SenderId: localStorage.getItem("USERID")});  
      });
    
      socket.on('onTyping', function (data) {
         console.log(data);
      });
      socket.on('onStopTyping', function (data) {
                console.log(data);
                });
    
      socket.on('onMediaMessage', function (data) {
         console.log(data);
      });




  socket.on('ondeliverNotification', function (data) {
         console.log(data);
      });

       socket.on('onReadNotification', function (data) {
         console.log(data);
      });
      socket.on('oncreateGroup', function (data) {
         console.log(data);
      });
      socket.on('onaddMember', function (data) {
         console.log(data);
      });
      socket.on('ondeleteMember', function (data) {
         console.log(data);
      });
      
      var aaa = $("#msgtext");
      console.log('sadsadsa' + aaa);

      $("#msgtext").keypress(function($event) {
        if ($event.keyCode == 13) {
            sendMessage(message)
        }
        else {
          
         updateTyping() ;
        }
       });

      TYPING_TIMER_LENGTH = 700;
      lastTypingTime = null;
      function updateTyping() {
        lastTypingTime = (new Date()).getTime();
        socket.emit('typing', { GroupId: groupId, SenderId: localStorage.getItem("USERID") });
        setTimeout(function () {
            var typingTimer = (new Date()).getTime();
            var timeDiff = typingTimer - lastTypingTime;
            if (timeDiff >= self.TYPING_TIMER_LENGTH) {
              socket.emit('stopTyping', { GroupId: groupId, SenderId: localStorage.getItem("USERID") });
            }
        }, TYPING_TIMER_LENGTH)
    }
   
    });
   </script>