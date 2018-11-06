<div class="main-content" xmlns="http://www.w3.org/1999/html">
				<div class="main-content-inner">
					

					<div class="page-content">
						

						<div class="page-header">
							<h1>
								Edit Category
								<?php if(isset($message) && $message!= '')echo $message ;?>
								<small>
								</small>
							</h1>
						</div><!-- /.page-header -->

						<div class="row">
							<div class="col-xs-12">
								<form class="form-horizontal" id="sample-form" method="post" action="<?php echo Request::$BASE_PATH.'categories/new_category/'.$objData->id ;?>" enctype="multipart/form-data">
									<div class="form-group has-info">
										<label for="inputInfo" class="col-xs-12 col-sm-3 control-label no-padding-right">Name:</label>

										<div class="col-xs-12 col-sm-5">
											<span class="block input-icon input-icon-right">
												<input type="text" name="name" id="inputInfo" value="<?php echo $objData->name ;?>" class="width-100" required/>
												<input type="hidden" name="id" id="inputInfo" value="<?php echo $objData->id ;?>" class="width-100" required/>
											</span>
										</div>
										
									</div>

                                    <div class="form-group has-info">
                                        <label for="inputInfo" class="col-xs-12 col-sm-3 control-label no-padding-right">Detail:</label>

                                        <div class="col-xs-12 col-sm-5">
											<span class="block input-icon input-icon-right">
                                                <textarea rows="5" cols="20" name="detail" id="inputInfo" class="width-100" required/><?php echo $objData->detail ;?></textarea>

											</span>
                                        </div>

                                    </div>

                                    <div class="form-group has-info">
                                        <label for="inputInfo" class="col-xs-12 col-sm-3 control-label no-padding-right">Meta Title:</label>

                                        <div class="col-xs-12 col-sm-5">
											<span class="block input-icon input-icon-right">
												<input type="text" name="meta_title" id="inputInfo" value="<?php echo $objData->meta_title ;?>" class="width-100" required/>

											</span>
                                        </div>

                                    </div>
                                    <div class="form-group has-info">
                                        <label for="inputInfo" class="col-xs-12 col-sm-3 control-label no-padding-right">Meta Detail:</label>

                                        <div class="col-xs-12 col-sm-5">
											<span class="block input-icon input-icon-right">
                                                <textarea rows="5" cols="20" name="meta_detail" id="inputInfo" class="width-100" required/><?php echo $objData->meta_detail ;?></textarea>

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

			