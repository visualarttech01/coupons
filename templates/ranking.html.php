<div class="main-content" xmlns="http://www.w3.org/1999/html">
				<div class="main-content-inner">
					

					<div class="page-content">
						
						
						<div class="page-header">
							<h1>
								<?php echo $objStore->name ;?> Coupons Ranking 
								<?php if(isset($message) && $message!= '')echo $message ;?>
								<small>
								</small>
							</h1>
						</div><!-- /.page-header -->

						<div class="row">
							<div class="col-xs-12">
								<form class="form-horizontal" id="sample-form" method="post" action="<?php echo Request::$BASE_PATH.'ranking/'.$objStore->id ;?>" enctype="multipart/form-data">
									<?php if($objData)
									    foreach($objData as $key){
									    ?>
									<div class="form-group has-info">
										<label for="inputInfo" class="col-xs-12 col-sm-3 control-label no-padding-right"><?php echo $key->name ;?>:</label>

										<div class="col-xs-12 col-sm-5">
											<span class="block input-icon input-icon-right">
												<input type="text" name="<?php echo $key->id ;?>" id="inputInfo" value="<?php echo $key->rank ;?>" class="width-100" required/>
												
											</span>
										</div>
										
									</div>
									<?php }?>
                                    

									
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

			