<div class="main-content" xmlns="http://www.w3.org/1999/html">
				<div class="main-content-inner">
					

					<div class="page-content">
						

						<div class="page-header">
							<h1>
								Add New Coupon
								<?php if(isset($message) && $message!= '')echo $message ;?>
								<small>
								</small>
							</h1>
						</div><!-- /.page-header -->

						<div class="row">
							<div class="col-xs-12">
								<form class="form-horizontal" id="sample-form" method="post" action="<?php echo Request::$BASE_PATH.'codes/new_code/' ;?>" enctype="multipart/form-data">
									<div class="form-group has-info">
										<label for="inputInfo" class="col-xs-12 col-sm-3 control-label no-padding-right">Name:</label>

										<div class="col-xs-12 col-sm-5">
											<span class="block input-icon input-icon-right">
												<input type="text" name="name" id="inputInfo" class="width-100" required/>
												
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
                                        <label for="inputInfo" class="col-xs-12 col-sm-3 control-label no-padding-right">Discount Value:</label>

                                        <div class="col-xs-12 col-sm-5">
											<span class="block input-icon input-icon-right">
                                                <input type="text" name="discount" id="inputInfo" class="width-100" required/>
                                              
											</span>
                                        </div>

                                    </div>

                                    <div class="form-group has-info">
                                        <label for="inputInfo" class="col-xs-12 col-sm-3 control-label no-padding-right">Code:</label>

                                        <div class="col-xs-12 col-sm-5">
											<span class="block input-icon input-icon-right">
												<input type="text" name="code" id="inputInfo" class="width-100" />

											</span>
                                        </div>

                                    </div>

                                    <div class="form-group has-info">
                                        <label for="inputInfo" class="col-xs-12 col-sm-3 control-label no-padding-right">Type:</label>

                                        <div class="col-xs-12 col-sm-5">
											<span class="block input-icon input-icon-right">
												<select name="type" class="form-control" required>
                                                    <option class="option" value="coupon">Coupon</option>
                                                    <option class="option" value="deal">Deal</option>

                                                </select>

											</span>
                                        </div>

                                    </div>

                                    <div class="form-group has-info">
                                        <label for="inputInfo" class="col-xs-12 col-sm-3 control-label no-padding-right">URL:</label>

                                        <div class="col-xs-12 col-sm-5">
											<span class="block input-icon input-icon-right">
												<input type="text" name="address" id="inputInfo" class="width-100" />

											</span>
                                        </div>

                                    </div>

                                    <div class="form-group has-info">
                                        <label for="inputInfo" class="col-xs-12 col-sm-3 control-label no-padding-right">Category:</label>

                                        <div class="col-xs-12 col-sm-5">
											<span class="block input-icon input-icon-right">
												<select name="category_id" class="form-control" required>
                                                <option class="option" value="0" selected> </option>
                                                    <?php if($objcategories)
                                                foreach ($objcategories as $key){?>
                                                    <option class="option" value="<?php echo $key->id ;?>"><?php echo $key->name?></option>
                                                <?php  }?>
                                                </select>

											</span>
                                        </div>

                                    </div>

                                    <div class="form-group has-info">
                                        <label for="inputInfo" class="col-xs-12 col-sm-3 control-label no-padding-right">Store:</label>

                                        <div class="col-xs-12 col-sm-5">
											<span class="block input-icon input-icon-right">
												<select name="store_id" class="form-control" required>
                                            <?php if($objstores)
                                                foreach ($objstores as $key){?>
                                                    <option class="option" value="<?php echo $key->id ;?>"><?php echo $key->name?></option>
                                                <?php  }?>
                                                </select>

											</span>
                                        </div>

                                    </div>



                                    <div class="form-group has-info">
                                        <label for="inputInfo" class="col-xs-12 col-sm-3 control-label no-padding-right">Active Date:</label>

                                        <div class="col-xs-12 col-sm-5">
											<span class="block input-icon input-icon-right">
												<input type="date" name="active_date" id="inputInfo" value="<?php echo date("Y-m-d")?>" class="width-100" required/>

											</span>
                                        </div>

                                    </div>

                                    <div class="form-group has-info">
                                        <label for="inputInfo" class="col-xs-12 col-sm-3 control-label no-padding-right">features:</label>

                                        <div class="col-xs-12 col-sm-5">
											<span class="block input-icon input-icon-right">
												<select name="is_top" class="form-control" required>
                                                    <option class="option" value="0">No</option>
                                                    <option class="option" value="1">Yes</option>


                                                </select>

											</span>
                                        </div>

                                    </div>

                                    <div class="form-group has-info">
                                        <label for="inputInfo" class="col-xs-12 col-sm-3 control-label no-padding-right">Expire Date:</label>

                                        <div class="col-xs-12 col-sm-5">
											<span class="block input-icon input-icon-right">
												<input type="date" name="expire_date" id="inputInfo" class="width-100" />

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

			