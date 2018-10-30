

			<div class="main-content">
				<div class="main-content-inner">
					

					<div class="page-content">
						

						<div class="page-header">
							<h1>
								Add New User
								<?php if(isset($message) && $message!= '')echo $message ;?>
								<small>
								</small>
							</h1>
						</div><!-- /.page-header -->

						<div class="row">
							<div class="col-xs-12">
								<form class="form-horizontal" id="sample-form" method="post" action="<?php echo Request::$BASE_PATH.'users/new_user/' ;?>" enctype="multipart/form-data">
									<div class="form-group has-info">
										<label for="inputInfo" class="col-xs-12 col-sm-3 control-label no-padding-right">Name:</label>

										<div class="col-xs-12 col-sm-5">
											<span class="block input-icon input-icon-right">
												<input type="text" name="name" id="inputInfo" class="width-100" required/>
												
											</span>
										</div>
										
									</div>
									<div class="form-group has-info">
										<label for="inputInfo" class="col-xs-12 col-sm-3 control-label no-padding-right">Email:</label>

										<div class="col-xs-12 col-sm-5">
											<span class="block input-icon input-icon-right">
												<input type="email" name="email" id="inputInfo" class="width-100" required/>
												
											</span>
										</div>
										
									</div>
									<div class="form-group has-info">
										<label for="inputInfo" class="col-xs-12 col-sm-3 control-label no-padding-right">Password:</label>

										<div class="col-xs-12 col-sm-5">
											<span class="block input-icon input-icon-right">
												<input type="password" name="password" id="inputInfo" class="width-100" required/>
												
											</span>
										</div>
										
									</div>
									
									<div class="form-group">
										<label class="control-label col-xs-12 col-sm-3 no-padding-right" for="state">Role</label>

										<div class="col-xs-12 col-sm-9">
											<select id="state" name="role" class="select2">
												<option value="user">User</option>
												<option value="admin">Admin</option>
											
											</select>
										</div>
									</div>
									<div class="form-group">
										<label class="control-label col-xs-12 col-sm-3 no-padding-right" for="state"></label>

										<div class="col-xs-12 col-sm-9">
											<button  type="submit" class="btn btn-success">
												Submit
											</button>
										</div>
									</div>

										
								</form>
								<!--<div class="hr hr32 hr-dotted"></div>-->

								<!-- PAGE CONTENT ENDS -->
							</div><!-- /.col -->
						</div><!-- /.row -->
					</div><!-- /.page-content -->
				</div>
			</div><!-- /.main-content -->

			