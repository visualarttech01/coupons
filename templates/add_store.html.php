<div class="main-content" xmlns="http://www.w3.org/1999/html">
				<div class="main-content-inner">
					

					<div class="page-content">
						

						<div class="page-header">
							<h1>
								Add New Store
								<?php if(isset($message) && $message!= '')echo $message ;?>
								<small>
								</small>
							</h1>
						</div><!-- /.page-header -->

						<div class="row">
							<div class="col-xs-12">
								<form class="form-horizontal" id="sample-form" method="post" action="<?php echo Request::$BASE_PATH.'stores/new_store/' ;?>" enctype="multipart/form-data">
									<div class="form-group has-info">
										<label for="inputInfo" class="col-xs-12 col-sm-3 control-label no-padding-right">Name:</label>

										<div class="col-xs-12 col-sm-5">
											<span class="block input-icon input-icon-right">
												<input type="text" name="name" id="inputInfo" class="width-100" required/>
												
											</span>
										</div>
										
									</div>

                                    <div class="form-group has-info">
                                        <label for="inputInfo" class="col-xs-12 col-sm-3 control-label no-padding-right">Category:</label>

                                        <div class="col-xs-12 col-sm-5">
											<span class="block input-icon input-icon-right">
												<select name="category" class="form-control" required>
                                            <?php if($objcategories)
                                                foreach ($objcategories as $key){?>
                                                    <option class="option" value="<?php echo $key->name ;?>"><?php echo $key->name?></option>
                                                <?php  }?>
                                                </select>

											</span>
                                        </div>

                                    </div>
                                    <div class="form-group has-info">
                                        <label for="inputInfo" class="col-xs-12 col-sm-3 control-label no-padding-right">Network:</label>

                                        <div class="col-xs-12 col-sm-5">
											<span class="block input-icon input-icon-right">
												<select name="network" class="form-control" required>
                                            <?php if($objnetworks)
                                                foreach ($objnetworks as $key){?>
                                                    <option class="option" value="<?php echo $key->name ;?>"><?php echo $key->name?></option>
                                                <?php  }?>
                                                </select>

											</span>
                                        </div>

                                    </div>
                                    <div class="form-group has-info">
                                        <label for="inputInfo" class="col-xs-12 col-sm-3 control-label no-padding-right">Url:</label>

                                        <div class="col-xs-12 col-sm-5">
											<span class="block input-icon input-icon-right">
												<input type="file" name="image" id="inputInfo" accept="image/*" class="width-100" required/>

											</span>
                                        </div>

                                    </div>
                                    <div class="form-group has-info">
                                        <label for="inputInfo" class="col-xs-12 col-sm-3 control-label no-padding-right">Url:</label>

                                        <div class="col-xs-12 col-sm-5">
											<span class="block input-icon input-icon-right">
												<input type="text" name="address" id="inputInfo" class="width-100" required/>

											</span>
                                        </div>

                                    </div>

                                    <div class="form-group has-info">
                                        <label for="inputInfo" class="col-xs-12 col-sm-3 control-label no-padding-right">Network Id:</label>

                                        <div class="col-xs-12 col-sm-5">
											<span class="block input-icon input-icon-right">
												<input type="text" name="net_store_id" id="inputInfo" class="width-100" required/>

											</span>
                                        </div>

                                    </div>
                                    <div class="form-group has-info">
                                        <label for="inputInfo" class="col-xs-12 col-sm-3 control-label no-padding-right">Network Store name:</label>

                                        <div class="col-xs-12 col-sm-5">
											<span class="block input-icon input-icon-right">
												<input type="text" name="net_store_name" id="inputInfo" class="width-100" required/>

											</span>
                                        </div>

                                    </div>

                                    <div class="form-group has-info">
                                        <label for="inputInfo" class="col-xs-12 col-sm-3 control-label no-padding-right">Network Store Link:</label>

                                        <div class="col-xs-12 col-sm-5">
											<span class="block input-icon input-icon-right">
												<input type="text" name="net_store_link" id="inputInfo" class="width-100" required/>

											</span>
                                        </div>

                                    </div>

                                    <div class="form-group has-info">
                                        <label for="inputInfo" class="col-xs-12 col-sm-3 control-label no-padding-right">Detail:</label>

                                        <div class="col-xs-12 col-sm-5">
											<span class="block input-icon input-icon-right">
                                                <textarea rows="5" cols="20" name="detail" id="inputInfo" class="width-100" required/></textarea>

											</span>
                                        </div>

                                    </div>

                                    <div class="form-group has-info">
                                        <label for="inputInfo" class="col-xs-12 col-sm-3 control-label no-padding-right">Meta Title:</label>

                                        <div class="col-xs-12 col-sm-5">
											<span class="block input-icon input-icon-right">
												<input type="text" name="meta_title" id="inputInfo" class="width-100" required/>

											</span>
                                        </div>

                                    </div>
                                    <div class="form-group has-info">
                                        <label for="inputInfo" class="col-xs-12 col-sm-3 control-label no-padding-right">Meta Detail:</label>

                                        <div class="col-xs-12 col-sm-5">
											<span class="block input-icon input-icon-right">
                                                <textarea rows="5" cols="20" name="meta_detail" id="inputInfo" class="width-100" required/></textarea>

											</span>
                                        </div>

                                    </div>

                                    <div class="form-group has-info">
                                        <label for="inputInfo" class="col-xs-12 col-sm-3 control-label no-padding-right">Network:</label>

                                        <div class="col-xs-12 col-sm-5">
											<span class="block input-icon input-icon-right">
												<select name="featured" class="form-control" required>
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

			