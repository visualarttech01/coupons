
<div class="main-content">
    <div class="main-content-inner">
        <div class="page-content">
            <div class="page-header">
                <h1>
                   CSV Upload
                    <small>


                    </small>
                </h1>
            </div><!-- /.page-header -->
            <div class="row">
                <div class="col-xs-12">
                    <!-- PAGE CONTENT BEGINS -->
                    <div class="row">
                        <div class="col-xs-12">
								<!-- PAGE CONTENT BEGINS -->
								<?php if(isset($msg) && $msg!==''){?>
								<div class="alert alert-info">
									<i class="ace-icon fa fa-hand-o-right"></i>

									<?php echo $msg ;?>
									<button class="close" data-dismiss="alert">
										<i class="ace-icon fa fa-times"></i>
									</button>
								</div>
								<?php }?>
								
								<form class="form-horizontal" id="sample-form" method="post" action="<?php echo Request::$BASE_PATH.'import/'?>" method='POST' enctype='multipart/form-data'>
									<div class="form-group has-info">
										<label class="ace-file-input col-xs-12 col-sm-3">
										<input type="file" name="file" id="id-input-file-2">
										<span class="ace-file-container" data-title="Choose">
    										<span class="ace-file-name" data-title="No File ..."><i class=" ace-icon fa fa-upload"></i>
    										</span>
										</span>
										<a class="remove" href="#"><i class=" ace-icon fa fa-times"></i>
										</a>
										</label>

									</div>
                                    
                                    <div class="form-group">
										<div class="col-xs-12 col-sm-9">
											<button  type="submit" class="btn btn-success">
												Submit
											</button>
										</div>
									</div>

										
								</form>
								
							</div>

								<!-- PAGE CONTENT ENDS -->
							</div>

                        <div class="space-6"></div>
                    </div>
                    <!-- PAGE CONTENT ENDS -->
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.page-content -->
    </div>
</div><!-- /.main-content -->



