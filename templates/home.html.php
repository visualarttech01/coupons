


			<div class="main-content">
				<div class="main-content-inner">
					<div class="breadcrumbs ace-save-state" id="breadcrumbs">
						<ul class="breadcrumb">
							<li>
								<i class="ace-icon fa fa-home home-icon"></i>
								<a href="<?php echo Request::$BASE_PATH; ?>">Home</a>
							</li>
							<li class="active">Dashboard</li>
						</ul><!-- /.breadcrumb -->

<!-- 						<div class="nav-search" id="nav-search"> -->
<!-- 							<form class="form-search"> -->
<!-- 								<span class="input-icon"> -->
<!-- 									<input type="text" placeholder="Search ..." class="nav-search-input" id="nav-search-input" autocomplete="off" /> -->
<!-- 									<i class="ace-icon fa fa-search nav-search-icon"></i> -->
<!-- 								</span> -->
<!-- 							</form> -->
<!-- 						</div> -->
						<!-- /.nav-search -->
					</div>

					<div class="page-content">
						

							
						<div class="page-header">
							<h1>
								Dashboard
								<small>
									<i class="ace-icon fa fa-angle-double-right"></i>
									overview &amp; stats
								</small>
							</h1>
						</div><!-- /.page-header -->

						<div class="row">
							<div class="col-xs-12">
								<!-- PAGE CONTENT BEGINS -->
								<!-- <div class="alert alert-block alert-success">
									<button type="button" class="close" data-dismiss="alert">
										<i class="ace-icon fa fa-times"></i>
									</button>

									<i class="ace-icon fa fa-check green"></i>

									Welcome to
									<strong class="green">
										Ace
										<small>(v1.4)</small>
									</strong>,
	лёгкий, многофункциональный и простой в использовании шаблон для админки на bootstrap 3.3.6. Загрузить исходники с <a href="<?php echo Request::$BASE_PATH; ?>https://github.com/bopoda/ace">github</a> (with minified ace js/css files).
								</div> -->

								<div class="row">
									<div class="space-6"></div>
									<div class="col-sm-6 infobox-container">
										<div class="widget-box">
											<div class="widget-header">
												<h4 class="widget-title lighter smaller">
													<i class="ace-icon fa fa-bell blue"></i>
													Notifications
												</h4>
											</div>

											<div class="widget-body">
												<div class="widget-main no-padding">
													<div class="dialogs">
														
														<?php if($objNotifications){
															foreach ($objNotifications as $noti){ ?>
														<div class="itemdiv dialogdiv">
															<div class="user">
																<?php if($noti->sender){ ?>
																	<img alt="" src="<?php echo Request::$BASE_PATH.'images/users/profiles/'.$noti->sender->image; ?>" />
																<?php }else{ ?>
																	<img alt="Avatar" src="<?php echo Request::$BASE_PATH; ?>assets/images/avatars/avatar.png" />
																<?php } ?>
																
															</div>

															<div class="body">
																<div class="time">
																	<i class="ace-icon fa fa-clock-o"></i>
																	<span class="green"><?php echo Utility::dateDifference($noti->notification->created); ?></span>
																</div>
																<?php if($noti->sender){ ?>	
																<div class="name">
																	<a href="<?php echo Request::$BASE_PATH; ?>"><?php echo $noti->sender->name; ?></a>
																</div>
																<?php } ?>
																<div class="text">
																	<?php if($noti->sender){ ?>	
																	<span class="blue"><?php echo $noti->sender->name ?>: </span>
																	<?php } ?>
																	<?php echo $noti->notification->notification;
																	if($noti->contact){
																		echo ' <span class="blue">'.$noti->contact->name.'</span>';
																	} ?>
																	</div>
																<?php if($noti->contact){ ?>
																<div class="tools">
																	<a href="<?php echo Request::$BASE_PATH.'contact/'.$noti->contact->id; ?>" class="btn btn-minier btn-info">
																		<i id="<?php echo $noti->notification->id ?>" class="notification icon-only ace-icon fa fa-share"></i>
																	</a>
																</div>
																<?php } ?>
															</div>
														</div>
														<?php }
														}else{
															
															?>
															<div class="itemdiv dialogdiv">
																<div class="body" style="background-color: #82AF6F">
																	<div class="text">
																		<h4 style="color: #fff;"><li class="fa fa-thumbs-up"></li> No notification for you. </h4>
																	</div>
																</div>	
																
															</div>
															
														<?php } ?>
														
														<!-- <div class="itemdiv dialogdiv">
															<div class="user">
																<img alt="John's Avatar" src="<?php echo Request::$BASE_PATH; ?>assets/images/avatars/avatar.png" />
															</div>

															<div class="body">
																<div class="time">
																	<i class="ace-icon fa fa-clock-o"></i>
																	<span class="blue">38 sec</span>
																</div>

																<div class="name">
																	<a href="<?php echo Request::$BASE_PATH; ?>">John</a>
																</div>
																<div class="text">Raw denim you probably haven&#39;t heard of them jean shorts Austin.</div>

																<div class="tools">
																	<a href="<?php echo Request::$BASE_PATH; ?>" class="btn btn-minier btn-info">
																		<i class="icon-only ace-icon fa fa-share"></i>
																	</a>
																</div>
															</div>
														</div>

														<div class="itemdiv dialogdiv">
															<div class="user">
																<img alt="Bob's Avatar" src="<?php echo Request::$BASE_PATH; ?>assets/images/avatars/user.jpg" />
															</div>

															<div class="body">
																<div class="time">
																	<i class="ace-icon fa fa-clock-o"></i>
																	<span class="orange">2 min</span>
																</div>

																<div class="name">
																	<a href="<?php echo Request::$BASE_PATH; ?>">Bob</a>
																	<span class="label label-info arrowed arrowed-in-right">admin</span>
																</div>
																<div class="text">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque commodo massa sed ipsum porttitor facilisis.</div>

																<div class="tools">
																	<a href="<?php echo Request::$BASE_PATH; ?>" class="btn btn-minier btn-info">
																		<i class="icon-only ace-icon fa fa-share"></i>
																	</a>
																</div>
															</div>
														</div>

														<div class="itemdiv dialogdiv">
															<div class="user">
																<img alt="Jim's Avatar" src="<?php echo Request::$BASE_PATH; ?>assets/images/avatars/avatar4.png" />
															</div>

															<div class="body">
																<div class="time">
																	<i class="ace-icon fa fa-clock-o"></i>
																	<span class="grey">3 min</span>
																</div>

																<div class="name">
																	<a href="<?php echo Request::$BASE_PATH; ?>">Jim</a>
																</div>
																<div class="text">Raw denim you probably haven&#39;t heard of them jean shorts Austin.</div>

																<div class="tools">
																	<a href="<?php echo Request::$BASE_PATH; ?>" class="btn btn-minier btn-info">
																		<i class="icon-only ace-icon fa fa-share"></i>
																	</a>
																</div>
															</div>
														</div>

														<div class="itemdiv dialogdiv">
															<div class="user">
																<img alt="Alexa's Avatar" src="<?php echo Request::$BASE_PATH; ?>assets/images/avatars/avatar1.png" />
															</div>

															<div class="body">
																<div class="time">
																	<i class="ace-icon fa fa-clock-o"></i>
																	<span class="green">4 min</span>
																</div>

																<div class="name">
																	<a href="<?php echo Request::$BASE_PATH; ?>">Alexa</a>
																</div>
																<div class="text">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</div>

																<div class="tools">
																	<a href="<?php echo Request::$BASE_PATH; ?>" class="btn btn-minier btn-info">
																		<i class="icon-only ace-icon fa fa-share"></i>
																	</a>
																</div>
															</div>
														</div> -->
													</div>

													<form>
														<div class="form-actions">
															<!-- <div class="input-group">
																<input placeholder="Type your message here ..." type="text" class="form-control" name="message" />
																<span class="input-group-btn">
																	<button class="btn btn-sm btn-info no-radius" type="button">
																		<i class="ace-icon fa fa-share"></i>
																		Send
																	</button>
																</span>
															</div> -->
														</div>
													</form>
												</div><!-- /.widget-main -->
											</div><!-- /.widget-body -->
										</div><!-- /.widget-box -->
									</div>
									<!-- 
									<div class="col-sm-7 infobox-container">
										<div class="infobox infobox-green">
											<div class="infobox-icon">
												<i class="ace-icon fa fa-comments"></i>
											</div>

											<div class="infobox-data">
												<span class="infobox-data-number">32</span>
												<div class="infobox-content">comments + 2 reviews</div>
											</div>

											<div class="stat stat-success">8%</div>
										</div>

										<div class="infobox infobox-blue">
											<div class="infobox-icon">
												<i class="ace-icon fa fa-twitter"></i>
											</div>

											<div class="infobox-data">
												<span class="infobox-data-number">11</span>
												<div class="infobox-content">new followers</div>
											</div>

											<div class="badge badge-success">
												+32%
												<i class="ace-icon fa fa-arrow-up"></i>
											</div>
										</div>

										<div class="infobox infobox-pink">
											<div class="infobox-icon">
												<i class="ace-icon fa fa-shopping-cart"></i>
											</div>

											<div class="infobox-data">
												<span class="infobox-data-number">8</span>
												<div class="infobox-content">new orders</div>
											</div>
											<div class="stat stat-important">4%</div>
										</div>

										<div class="infobox infobox-red">
											<div class="infobox-icon">
												<i class="ace-icon fa fa-flask"></i>
											</div>

											<div class="infobox-data">
												<span class="infobox-data-number">7</span>
												<div class="infobox-content">experiments</div>
											</div>
										</div>

										<div class="infobox infobox-orange2">
											<div class="infobox-chart">
												<span class="sparkline" data-values="196,128,202,177,154,94,100,170,224"></span>
											</div>

											<div class="infobox-data">
												<span class="infobox-data-number">6,251</span>
												<div class="infobox-content">pageviews</div>
											</div>

											<div class="badge badge-success">
												7.2%
												<i class="ace-icon fa fa-arrow-up"></i>
											</div>
										</div>

										<div class="infobox infobox-blue2">
											<div class="infobox-progress">
												<div class="easy-pie-chart percentage" data-percent="42" data-size="46">
													<span class="percent">42</span>%
												</div>
											</div>

											<div class="infobox-data">
												<span class="infobox-text">traffic used</span>

												<div class="infobox-content">
													<span class="bigger-110">~</span>
													58GB remaining
												</div>
											</div>
										</div>

										<div class="space-6"></div>

										<div class="infobox infobox-green infobox-small infobox-dark">
											<div class="infobox-progress">
												<div class="easy-pie-chart percentage" data-percent="61" data-size="39">
													<span class="percent">61</span>%
												</div>
											</div>

											<div class="infobox-data">
												<div class="infobox-content">Task</div>
												<div class="infobox-content">Completion</div>
											</div>
										</div>

										<div class="infobox infobox-blue infobox-small infobox-dark">
											<div class="infobox-chart">
												<span class="sparkline" data-values="3,4,2,3,4,4,2,2"></span>
											</div>

											<div class="infobox-data">
												<div class="infobox-content">Earnings</div>
												<div class="infobox-content">$32,000</div>
											</div>
										</div>

										<div class="infobox infobox-grey infobox-small infobox-dark">
											<div class="infobox-icon">
												<i class="ace-icon fa fa-download"></i>
											</div>

											<div class="infobox-data">
												<div class="infobox-content">Downloads</div>
												<div class="infobox-content">1,205</div>
											</div>
										</div>
									</div> -->

									<div class="vspace-12-sm"></div>

									<div class="col-sm-6">
										<div class="widget-box">
											<div class="widget-header widget-header-flat widget-header-small">
												<h5 class="widget-title">
													<i class="ace-icon fa fa-signal"></i>
													Contact Types
												</h5>
												<input type=hidden id="citywise" name="citywise" value='<?php echo json_encode($objCitywise); ?>'>
													
											</div>

											<div class="widget-body">
												<div class="widget-main">
													<div id="piechart-placeholder"></div>

													<div class="hr hr8 hr-double"></div>

													<div class="clearfix">
														
														
													<div class="grid3">
														<span class="grey">
															<i class="ace-icon fa fa-rocket fa-2x blue"></i>
															&nbsp; Subscribers
														</span>
														<h4 class="bigger pull-right"><?php echo $objStatus->subscriber->contacts; ?></h4>
													</div>
													<div class="grid3">
														<span class="grey">
															<i class="ace-icon fa fa-user fa-2x purple"></i>
															&nbsp; Members
														</span>
														<h4 class="bigger pull-right"><?php echo $objStatus->member->contacts; ?></h4>
													</div>
												
													<div class="grid3">
														<span class="grey">
															<i class="ace-icon fa fa-user fa-2x red"></i>
															&nbsp; Barabri Eagles
														</span>
														<h4 class="bigger pull-right"><?php echo $objStatus->barabri_eagle->contacts; ?></h4>
													</div>
														
														

														
													</div>
												</div><!-- /.widget-main -->
											</div><!-- /.widget-body -->
										</div><!-- /.widget-box -->
									</div><!-- /.col -->
								</div><!-- /.row -->


								</div>

								<!-- PAGE CONTENT ENDS -->
							</div><!-- /.col -->
						</div><!-- /.row -->
					</div><!-- /.page-content -->
				</div>
			</div><!-- /.main-content -->
			