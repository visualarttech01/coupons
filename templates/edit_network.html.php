<div class="main-content" xmlns="http://www.w3.org/1999/html">
    <div class="main-content-inner">


        <div class="page-content">


            <div class="page-header">
                <h1>
                    Edit Network
                    <?php if(isset($message) && $message!= '')echo $message ;?>
                    <small>
                    </small>
                </h1>
            </div><!-- /.page-header -->

            <div class="row">
                <div class="col-xs-12">
                    <form class="form-horizontal" id="sample-form" method="post" action="<?php echo Request::$BASE_PATH.'networks/new_network/'.$objData->id ;?>" enctype="multipart/form-data">
                        <div class="form-group has-info">
                            <label for="inputInfo" class="col-xs-12 col-sm-3 control-label no-padding-right">Name:</label>

                            <div class="col-xs-12 col-sm-5">
                                <span class="block input-icon input-icon-right">
                                    <input type="text" name="name" id="inputInfo" value="<?php echo $objData->name?>" class="width-100" required/>
                                    <input type="hidden" name="id" id="inputInfo" class="width-100" value="<?php echo $objData->id?>" required/>
                                </span>
                            </div>

                        </div>

                        <div class="form-group has-info">
                            <label for="inputInfo" class="col-xs-12 col-sm-3 control-label no-padding-right">Url:</label>

                            <div class="col-xs-12 col-sm-5">
											<span class="block input-icon input-icon-right">
                                               <input type="text" name="address" value="<?php echo $objData->address ;?>" id="inputInfo" class="width-100" required/>

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

