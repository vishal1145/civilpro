<?php 
include "header.php";
// include "sidebar.php";	
$obj = new connection();
$con = $obj->connect(); 

?>
<style>
.chat-main-row {
    bottom: 0;
    left: 0;
    overflow: auto;
    padding-bottom: inherit;
    padding-top: inherit;
    position: absolute;
    right: 0;
    top: 0;
    margin-left: 250px;
	margin-top: 63px;
</style>
<div ng-controller="chatController">
 <div class="sidebar" id="sidebar"  >
                <div class="sidebar-inner slimscroll">
					<div class="sidebar-menu">
						<ul>
					
							<li > 
								<a href="dashbord.php"  ><i class="fa fa-home"></i> Back to Home</a>
							</li>
							<li class="menu-title">project Groups <a href="#" data-toggle="modal" data-target="#add_group"><i class="fa fa-plus"></i></a></li>
						
							<li ng-repeat="group in groups" ng-if="group.GroupInfo.GroupType == '2'"> 
							 <a ng-click="openGroup(group)">{{group.GroupInfo.GroupName}}</a>
							</li>
							

							<li class="menu-title">Direct Chats <a href="#" data-toggle="modal" data-target="#add_chat_user"><i class="fa fa-plus"></i></a></li>
							
							<li ng-repeat="group in groups" ng-if="group.GroupInfo.GroupType == '1'"> 
								<a ng-click="openGroup(group)">
								<span class="status online"></span> 
								<span>{{group.GroupInfo.GroupName}}</span>
									<span class="badge bg-danger pull-right" ng-if="group.unreadCount > 0">{{group.unreadCount}}</span>
								</a>
							</li>

							 <li ng-repeat="group in []"> 
								<a href="chat.html"><span class="status offline"></span> Richard Miles <span class="badge bg-danger pull-right">18</span></a>
							</li>
							

						</ul>
					</div>
                </div>
            </div>
		

<div class="chat-main-row">
					<div class="chat-main-wrapper">
						<div class="col-xs-9 message-view task-view">
							<div class="chat-window">
								<div class="chat-header">
									<div class="navbar">
										<div class="user-details" >
											<div class="pull-left user-img m-r-10">
												<a href="profile.html" title="Mike Litorus"><img ng-src={{currentGroup.GroupInfo.ProfileURLOfGroup}} alt="" class="w-40 img-circle"><span class="status online"></span></a>
											</div>
											<div class="user-info pull-left">
												<a href="profile.html" title="Mike Litorus"><span class="font-bold">{{currentGroup.GroupInfo.GroupName}}</span> <i class="typing-text">
												<span  ng-if="currentGroup.isTyping" >
												Typing...
												<span>
												</i></a>
												<span class="last-seen">Last seen today at 7:50 AM</span>
											</div>
										</div>
										<ul class="nav navbar-nav pull-right chat-menu">
											<li class="dropdown">
												<a href="" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false" style ="display:none"><i class="fa fa-cog"></i></a>
												<ul class="dropdown-menu">
													<li><a href="javascript:void(0)">Delete Conversations</a></li>
													<li><a href="javascript:void(0)">Settings</a></li>
												</ul>
											</li>
										</ul>
										<a href="#task_window" class="task-chat profile-rightbar pull-right"><i class="fa fa-user" aria-hidden="true"></i></a>
										<div class="message-search pull-right">
											<div class="input-group input-group-sm">
												<input ng-model="searchText" type="text" class="form-control" placeholder="Search" required="" ng-keyup="searchMessage(searchText)">
												<span class="input-group-btn">
													<button class="btn" type="button"><i class="fa fa-search"></i></button>
												</span>
											</div>
										</div>
									</div>
								</div>
								<div class="chat-contents">
									<div class="chat-content-wrap">
										<div class="chat-wrap-inner" id="chatContent">
											<div class="chat-box">
												<div class="chats">
													
												<div ng-repeat="msg in messages" ng-if="msg.GroupId === currentGroup._id && !msg.hideOnUI">
													
													<div class="chat chat-right" ng-if="msg.SenderId == userId && !msg.isMedia" >
														<div class="chat-body">
															<div class="chat-bubble">
																<div class="chat-content">
																	<p>{{msg.TextMessage}}</p>
																	<span class="chat-time">{{msg.SendTime | date:'dd-MMM-yyyy HH:mm'}}</span>
																</div>
																<div class="chat-action-btns" style = "display:none">
																	<ul>
																		<li><a href="#" class="share-msg" title="Share"><i class="fa fa-share-alt"></i></a></li>
																		<li style= "display:none"><a href="#" class="edit-msg" title="Edit"><i class="fa fa-pencil"></i></a></li>
																		<li><a href="#" class="del-msg" title="Delete"><i class="fa fa-trash-o"></i></a></li>
																	</ul>
																</div>
															</div>
														</div>
													</div>
													
													<div class="chat chat-left" ng-if="msg.SenderId != userId && !msg.isMedia">
														<div class="chat-avatar">
															<a href="profile.html" class="avatar">
																<img alt="John Doe" src={{currentGroup.GroupInfo.ProfileURLOfGroup}} class="img-responsive img-circle">
															</a>
														</div>
														<div class="chat-body" >
															<div class="chat-bubble">
																<div class="chat-content">
																	<p>{{msg.TextMessage}}</p>
																	<span class="chat-time">{{msg.SendTime}}</span>
																</div>
																<div class="chat-action-btns"  style = "display:none">
																	<ul>
																		<li><a href="#" class="share-msg" title="Share"><i class="fa fa-share-alt"></i></a></li>
																		<li><a href="#" class="edit-msg" title="Edit"><i class="fa fa-pencil"></i></a></li>
																		<li><a href="#" class="del-msg" title="Delete"><i class="fa fa-trash-o"></i></a></li>
																	</ul>
																</div>
															</div>															
															</div>
													</div>
													


													

													
													<div class="chat chat-right" ng-if="msg.SenderId == userId && msg.isMedia">
														<div class="chat-body">
															<div class="chat-bubble">
																<div class="chat-content img-content">
																	<div class="chat-img-group clearfix">
																		<p>Uploaded a Images</p>
																		<a class="chat-img-attach" href="#">
																			<img width="182" height="137" alt="" ng-src={{msg.TextMessage}}>
																			 <div class="chat-placeholder" style="display:none">
																				<div class="chat-img-name" >placeholder.png</div>
																				<div class="chat-file-desc" >842 KB</div>
																			</div> 
																	</div>
																	<span class="chat-time">{{msg.SendTime}}</span>
																</div>
																<div class="chat-action-btns" style = "display:none">
																	<ul>
																		<li><a href="#" class="share-msg" title="Share"><i class="fa fa-share-alt"></i></a></li>
																		<li><a href="#" class="edit-msg" title="Edit"><i class="fa fa-pencil"></i></a></li>
																		<li><a href="#" class="del-msg" title="Delete"><i class="fa fa-trash-o"></i></a></li>
																	</ul>
																</div>
															</div>
														</div>
													</div>

<div class="chat chat-left" ng-if="msg.SenderId != userId && msg.isMedia">
														<div class="chat-avatar">
															<a href="profile.html" class="avatar">
															<img alt="John Doe" src={{currentGroup.GroupInfo.ProfileURLOfGroup}} class="img-responsive img-circle">
															</a>
														</div>
														<div class="chat-body">
															
															<div class="chat-bubble">
																<div class="chat-content img-content">
																	<div class="chat-img-group clearfix">
																		<p>Uploaded a Images</p>
																		<a class="chat-img-attach" href="#">
																			<img width="182" height="137" alt="" ng-src={{msg.TextMessage}}>
																		 <div class="chat-placeholder" style = "display:none">
																				<div class="chat-img-name">placeholder.png</div>
																				<div class="chat-file-desc">842 KB</div>
																			</div> 
																		</a>
																	</div>
																	<span class="chat-time">{{msg.SendTime | date:'dd-MMM-yyyy HH:mm'}}</span>
																</div>
																<div class="chat-action-btns"  style = "display:none">
																	<ul>
																		<li><a href="#" class="share-msg" title="Share"><i class="fa fa-share-alt"></i></a></li>
																		<li><a href="#" class="edit-msg" title="Edit"><i class="fa fa-pencil"></i></a></li>
																		<li><a href="#" class="del-msg" title="Delete"><i class="fa fa-trash-o"></i></a></li>
																	</ul>
																</div>
															</div>
														</div>
													</div>

													</div>

													


													<div class="chat-line" style = "display:none">
														<span class="chat-date">October 8th, 2015</span>
													</div>

													
													
													


													<div class="chat chat-left" ng-if="isdDcoument">
														<div class="chat-avatar">
															<a href="profile.html" class="avatar">
																<img alt="John Doe" src={{currentGroup.GroupInfo.ProfileURLOfGroup}} class="img-responsive img-circle">
															</a>
														</div>
														<div class="chat-body">
															<div class="chat-bubble">
																<div class="chat-content">
																	<ul class="attach-list">
																		<li class="pdf-file"><i class="fa fa-file-pdf-o"></i> <a href="#">Document_2016.pdf</a></li>
																	</ul>
																	<span class="chat-time">9:00 am</span>
																</div>
																
														      <div class="chat-action-btns"   style = "display:none">
																	<ul>
																		<li><a href="#" class="share-msg" title="Share"><i class="fa fa-share-alt"></i></a></li>
																		<li><a href="#" class="edit-msg" title="Edit"><i class="fa fa-pencil"></i></a></li>
																		<li><a href="#" class="del-msg" title="Delete"><i class="fa fa-trash-o"></i></a></li>
																	</ul>
																</div>
															</div>
														</div>
													</div>	
													<div class="chat chat-right" ng-if="isdDcoument">
														<div class="chat-body">
															<div class="chat-bubble">
																<div class="chat-content">
																	<ul class="attach-list">
																		<li class="pdf-file"><i class="fa fa-file-pdf-o"></i> <a href="#">Document_2016.pdf</a></li>
																	</ul>
																	<span class="chat-time">9:00 am</span>
																</div>
																<div class="chat-action-btns">
																	<ul>
																		<li><a href="#" class="share-msg" title="Share"><i class="fa fa-share-alt"></i></a></li>
																		<li><a href="#" class="edit-msg" title="Edit"><i class="fa fa-pencil"></i></a></li>
																		<li><a href="#" class="del-msg" title="Delete"><i class="fa fa-trash-o"></i></a></li>
																	</ul>
																</div>
															</div>
														</div>
													</div>


													<div class="chat chat-left" ng-if="currentGroup.isTyping">
														<div class="chat-avatar" >
															<a href="profile.html" class="avatar">
																<img alt="John Doe" src={{currentGroup.GroupInfo.ProfileURLOfGroup}} class="img-responsive img-circle">
															</a>
														</div>
														<div class="chat-body"  >
													
													        <div class="chat-bubble" >
																<div class="chat-content" >
																<p>Typing...</p>
																</div>
															</div>
														</div>
													</div>

												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="chat-footer">
									<div class="message-bar">
										<div class="message-inner">
											<input type="file" id ="img" style="display:none;" onchange="angular.element(this).scope().mediaMessage(this)">
											<a class="link attach-icon" href="#" data-toggle="modal" data-target="#drag_files" 
											ng-click="openFile()"
											><img src="assets/img/attachment.png" alt=""></a>
											<div class="message-area"><div class="input-group">
												<textarea class="form-control" placeholder="Type message..." ng-model="typedmessage" ng-keypress="valuechange($event)"></textarea>
												<span class="input-group-btn">
													<button class="btn btn-primary" type="button"  ><i class="fa fa-send" ng-click="sendMessage()"></i></button>
												</span>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-xs-3 profile-right fixed-sidebar-right chat-profile-view" id="task_window">
							<div class="display-table profile-right-inner">
								<div class="table-row">
									<div class="table-body">
										<div class="table-content">
											<div class="chat-profile-img">
												<div class="edit-profile-img">
													<img class="avatar" ng-src={{currentGroup.GroupInfo.ProfileURLOfGroup}} alt="">
													<span class="change-img">Change Image</span>
												</div>
												<h3 class="user-name m-t-10 m-b-0">{{currentGroup.GroupInfo.username}}</h3>
												<small class="text-muted">Web Designer</small>
												<a href="edit-profile.html" class="btn btn-primary edit-btn" style="display:none"><i class="fa fa-pencil"></i></a>
											</div>
											<div class="chat-profile-info">
												<ul class="user-det-list">
													<li>
														<span>Username:</span>
														<span class="pull-right text-muted">{{currentGroup.GroupInfo.GroupName}}</span>
													</li>
													<li>
														<span>Hiredate:</span>
														<span class="pull-right text-muted">{{currentGroup.GroupInfo.DOB}}</span>
													</li>
													<li>
														<span>Email:</span>
														<span class="pull-right text-muted">{{currentGroup.GroupInfo.Email}}</span>
													</li>
													<li>
														<span>Phone:</span>
														<span class="pull-right text-muted">{{currentGroup.GroupInfo.Phone}}</span>
													</li>
												</ul>
											</div>
											<div class="tabbable">
												<ul class="nav nav-tabs nav-tabs-solid nav-justified m-b-0">
												
													<li id="liall" class="active" ng-click="highlight(1)"><a data-toggle="tab" style="cursor: pointer;" >All Files</a></li>
													<li id="limy" ng-click="highlight(2)" ><a data-toggle="tab" style="cursor: pointer;" >My Files</a></li>
												</ul>
												<div class="tab-content">
													<div class="tab-pane active" id="all_files">
														<ul class="files-list">
															<li ng-repeat="msg in messages" ng-if="msg.GroupId === currentGroup._id && msg.isMedia" >
																<div class="files-cont">
																	<div class="file-type">
																		<span class="files-icon"><i class="fas fa-file"></i></span>
																	</div>
																	<div class="files-info">
																		<span class="file-name text-ellipsis">Uploaded file and recive file </span>
																		<span class="file-author" style = "display:none"><a href="#">Loren Gatlin</a></span> <span class="file-date">{{msg.SendTime}}</span>
																	</div>
																	          
																	<ul class="files-action">
																		<li class="dropdown">
																			<a href="" class="dropdown-toggle btn btn-default btn-xs" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-h"></i></a>
																			<ul class="dropdown-menu">
																				<li><a href="javascript:void(0)">Download</a></li>
																				<li><a href="#" data-toggle="modal" data-target="#share_files">Share</a></li>
																			</ul>
																		</li>
																	</ul>
																</div>
															</li>

															
														</ul>
													</div>
													<div class="tab-pane" id="my_files">
														<ul class="files-list">
															<li  ng-repeat="msg in messages" ng-if="msg.GroupId === currentGroup._id && msg.isMedia && msg.SenderId === userId && msg.isMedia"  >
																<div class="files-cont">
																	<div class="file-type">
																		<span class="files-icon"><i class="fas fa-file"></i></span>
																	</div>
																	<div class="files-info">
																		<span class="file-name text-ellipsis"> Uploaded file</span>
																		<span class="file-author"><a href="#" style="display:none">John Doe</a></span> <span class="file-date">{{ msg.SendTime | date:'dd-MMM-yyyy HH:mm'}}</span>
																	</div>
																	<ul class="files-action">
																		<li class="dropdown">
																			<a href="" class="dropdown-toggle btn btn-default btn-xs" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-h"></i></a>
																			<ul class="dropdown-menu">
																				<li><a href="javascript:void(0)">Download</a></li>
																				<li><a href="#" data-toggle="modal" data-target="#share_files">Share</a></li>
																			</ul>
																		</li>
																	</ul>
																</div>
															</li>
														</ul>
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


					