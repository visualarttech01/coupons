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
								<form class="form-horizontal" id="sample-form" method="post" action="<?php echo Request::$BASE_PATH.'users/edit_user/'.$objData->id ;?>" enctype="multipart/form-data">
									<div class="form-group has-info">
										<label for="inputInfo" class="col-xs-12 col-sm-3 control-label no-padding-right">Name:</label>

										<div class="col-xs-12 col-sm-5">
											<span class="block input-icon input-icon-right">
												<input type="text" name="user_name" value="<?php echo $objData->user_name ;?>" id="inputInfo" class="width-100" required/>
												<input type="hidden" name="id" value="<?php echo $objData->id ;?>" id="inputInfo" class="width-100" required/>

											</span>
										</div>
										
									</div>
									<div class="form-group has-info">
										<label for="inputInfo" class="col-xs-12 col-sm-3 control-label no-padding-right">Email:</label>

										<div class="col-xs-12 col-sm-5">
											<span class="block input-icon input-icon-right">
												<input type="email" name="email" value="<?php echo $objData->email ;?>" id="inputInfo" class="width-100" required/>
												
											</span>
										</div>
										
									</div>
									<div class="form-group has-info">
										<label for="inputInfo" class="col-xs-12 col-sm-3 control-label no-padding-right">New Password:</label>

										<div class="col-xs-12 col-sm-5">
											<span class="block input-icon input-icon-right">
												<input type="hidden" name="password" value="<?php echo $objData->password ;?>" id="inputInfo" class="width-100" required/>
												<input type="password" name="n_password" id="inputInfo" class="width-100" />
											</span>
										</div>
										
									</div>

                                    <div class="form-group has-info">
                                        <label for="inputInfo" class="col-xs-12 col-sm-3 control-label no-padding-right">Role:</label>

                                        <div class="col-xs-12 col-sm-5">
                                            <span class="block input-icon input-icon-right">
                                                <select name="user_role_id" class="form-control" required>
                                                    <?php if($objroles)
                                                        foreach ($objroles as $key){?>
                                                            <option class="option" value="<?php echo $key->id?>"<?php if($key->id==$objData->user_role_id)echo 'selected' ;?>><?php echo $key->role?></option>
                                                        <?php  }?>

                                                </select>

                                            </span>
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

			