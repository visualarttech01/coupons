	

			<div class="main-content">
				<div class="main-content-inner">
					

					<div class="page-content">
						

						<div class="page-header">
							<h1>
								Add New Permission
								<?php if(isset($message) && $message!= '')echo $message ;?>
								<small>
								</small>
							</h1>
						</div><!-- /.page-header -->

						<div class="row">
							<div class="col-xs-12">
								<form class="form-horizontal" id="sample-form" method="post" action="<?php echo Request::$BASE_PATH.'permissions/new_permission/' ;?>" enctype="multipart/form-data">

                                        <div class="form-group has-info">
                                            <label for="inputInfo" class="col-xs-12 col-sm-3 control-label no-padding-right">Role:</label>

                                            <div class="col-xs-12 col-sm-5">
                                                <span class="block input-icon input-icon-right">
                                                    <select name="user_role_id" class="form-control" required>
                                                        <?php if($objroles)
                                                            foreach ($objroles as $key){?>
                                                        <option class="option" value="<?php echo $key->role?>"><?php echo $key->role?></option>
                                                        <?php  }?>

                                                    </select>

                                                </span>
                                            </div>

                                        </div>

                                    <div class="form-group has-info">
                                        <label for="inputInfo" class="col-xs-12 col-sm-3 control-label no-padding-right">Section:</label>

                                        <div class="col-xs-12 col-sm-5">
											<span class="block input-icon input-icon-right">
                                                <select name="section" class="form-control" required>
                                            <?php if($objsection)
                                                foreach ($objsection as $key){?>
                                                    <option class="option" value="<?php echo $key->name ;?>"><?php echo $key->name?></option>
                                                <?php  }?>
                                                </select>

											</span>
                                        </div>

                                    </div>

                                    <div class="form-group has-info">
                                        <label for="inputInfo" class="col-xs-12 col-sm-3 control-label no-padding-right">Add:</label>

                                        <div class="col-xs-12 col-sm-5">
											<span class="block input-icon input-icon-right">
                                                 <select name="p_add" class="form-control" required>
                                                    <option class="option" value="1">Yes</option>
                                                    <option class="option" value="0">No</option>

                                                </select>
											</span>
                                        </div>

                                    </div>

                                    <div class="form-group has-info">
                                        <label for="inputInfo" class="col-xs-12 col-sm-3 control-label no-padding-right">Edit:</label>

                                        <div class="col-xs-12 col-sm-5">
											<span class="block input-icon input-icon-right">
                                                 <select name="p_edit" class="form-control" required>
                                                    <option class="option" value="1">Yes</option>
                                                    <option class="option" value="0">No</option>

                                                </select>
											</span>
                                        </div>

                                    </div>

                                    <div class="form-group has-info">
                                        <label for="inputInfo" class="col-xs-12 col-sm-3 control-label no-padding-right">View:</label>

                                        <div class="col-xs-12 col-sm-5">
											<span class="block input-icon input-icon-right">
                                                 <select name="p_view" class="form-control">
                                                    <option class="option" value="1">Yes</option>
                                                    <option class="option" value="0">No</option>

                                                </select>
											</span>
                                        </div>

                                    </div>

                                    <div class="form-group has-info">
                                        <label for="inputInfo" class="col-xs-12 col-sm-3 control-label no-padding-right">Delete:</label>

                                        <div class="col-xs-12 col-sm-5">
											<span class="block input-icon input-icon-right">
                                                 <select name="p_delete" class="form-control">
                                                    <option class="option" value="1">Yes</option>
                                                    <option class="option" value="0">No</option>

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

			