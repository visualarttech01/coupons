				
<?php
	if(isset($Message) && $Message!= ''){
                  		
                  	}  
					$objuser = Session::GetUser();
					
					
                   ?>
<div class="main-content">
	<div class="main-content-inner">
			<div class="page-content">
			

			<div class="page-header">
				<h1>
					User Profile Page
					<small>
						
						
					</small>
				</h1>
			</div><!-- /.page-header -->

			<div class="row">
				<div class="col-xs-12">
					<!-- PAGE CONTENT BEGINS -->
					<div>
						<div id="user-profile-1" class="user-profile row">
							<div class="col-xs-12 col-sm-3 center">
								<div>
									<span class="profile-picture">
										<img id="avatar" class="editable img-responsive" alt="<?php echo $objuser->name ;?>" src="<?php if($objuser->image != ''){ echo Request::$BASE_PATH.'images/users/profiles/'.$objuser->image; }else{ echo Request::$BASE_PATH.'images/users/profiles/default.jpg'; }?>" />
									</span>

									<div class="space-4"></div>

									<div class="width-80 label label-info label-xlg arrowed-in arrowed-in-right">
										<div class="inline position-relative">
											<a href="#" class="user-title-label dropdown-toggle" data-toggle="dropdown">
												<i class="ace-icon fa fa-circle light-green"></i>
												&nbsp;
												<span class="white"><?php echo $objuser->name ;?></span>
											</a>

											
										</div>
									</div>
								</div>

								<div class="space-6"></div>
								<div class="hr hr16 dotted"></div>
								<div class="profile-contact-info">
									
									<div class="profile-contact-links align-left">
										<a href="#" class="btn btn-link">
											<i class="ace-icon fa fa-envelope bigger-120 pink"></i>
											<?php echo $objuser->email ;?>
										</a>
										<?php if($objuser->phone != ''){ ?>
										<a href="#" class="btn btn-link">
											<i class="ace-icon fa fa-phone"></i>
											<?php echo $objuser->phone ;?>
										</a>
										<?php }else{ ?>
										<a href="#" class="btn btn-link">
											<i class="ace-icon fa fa-phone"></i>
											Add Your phone Number
										</a>
										<?php }?>
									</div>
									<div class="space-6"></div>
								</div>
								<div class="hr hr16 dotted"></div>
							</div>

							<div class="col-xs-12 col-sm-9">
								<div class="space-12"></div>
								<?php if(isset($Message) && $Message!= '')echo $Message ;?>
								<form class="form-horizontal" id="sample-form" method="post" action="<?php echo Request::$BASE_PATH.'profile/';?>" enctype="multipart/form-data">
									<div class="form-group has-info">
										<label for="inputInfo" class="col-xs-12 col-sm-3 control-label no-padding-right">Name:</label>

										<div class="col-xs-12 col-sm-5">
											<span class="block input-icon input-icon-right">
												<input type="text" name="name" id="inputInfo" value="<?php echo $objuser->name ;?>" class="width-100"/>
											</span>
										</div>
										
									</div>
									<div class="form-group has-info">
										<label for="inputInfo" class="col-xs-12 col-sm-3 control-label no-padding-right">Phone:</label>

										<div class="col-xs-12 col-sm-5">
											<span class="block input-icon input-icon-right">
												<input type="text" name="phone" id="inputInfo" value="<?php if($objuser->phone != '0')echo $objuser->phone ;?>" class="width-100"/>
											</span>
										</div>
										
									</div>
									<div class="form-group has-info">
										<label for="inputInfo" class="col-xs-12 col-sm-3 control-label no-padding-right">Profile:</label>

										<div class="col-xs-12 col-sm-5">
											<span class="block input-icon input-icon-right">
												<input type="file" name="image" id="inputInfo" value="<?php echo $objuser->image ;?>" class="width-100"/>
											</span>
										</div>
										
									</div>
									<!--
									<div class="form-group has-info">
										<label for="inputInfo" class="col-xs-12 col-sm-3 control-label no-padding-right">Password:</label>

										<div class="col-xs-12 col-sm-5">
											<span class="block input-icon input-icon-right">
												<input type="password" name="password" id="inputInfo" class="width-100" required/>
												
											</span>
										</div>
										
									</div>
									<div class="form-group has-info">
										<label for="inputInfo" class="col-xs-12 col-sm-3 control-label no-padding-right">Confirm Password:</label>

										<div class="col-xs-12 col-sm-5">
											<span class="block input-icon input-icon-right">
												<input type="password" name="c_password" id="inputInfo" class="width-100" required/>
												
											</span>
										</div>
										
									</div>-->
									
									<div class="form-group">
										<label class="control-label col-xs-12 col-sm-3 no-padding-right" for=""></label>

										<div class="col-xs-12 col-sm-9">
											<button  type="submit" class="btn btn-success">
												Submit
											</button>
										</div>
									</div>

										
								</form>
							

								<div class="space-20"></div>

							</div>
						</div>
					</div>

					


					<!-- PAGE CONTENT ENDS -->
				</div><!-- /.col -->
			</div><!-- /.row -->
		</div><!-- /.page-content -->
	</div>
</div><!-- /.main-content -->

			