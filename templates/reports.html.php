
<div class="main-content">
	<div class="main-content-inner">
        <div class="page-content">
            <div class="page-header">
                <h1>
                    User Report
                    <small>


                    </small>
                </h1>
            </div><!-- /.page-header -->
            <div class="row">
                <div class="col-xs-12">
                        <!-- PAGE CONTENT BEGINS -->
                    <div class="row">
                        <div class="space-6"></div>
                        <div class="vspace-12-sm"></div>
                        <div class="left">
                            <a href="<?php echo Request::$BASE_PATH.'reporting/networks/'.$objUser->id ;?>" class="btn btn-round btn-lg btn-yellow no-hover">
                                <span class="line-height-1 smaller-90">Networks</span>
                            </a>
                            <a href="<?php echo Request::$BASE_PATH.'reporting/categories/'.$objUser->id ;?>" class="btn btn-round btn-lg btn-inverse no-hover">
                                <span class="line-height-1 smaller-90">Categories</span>
                            </a>
                            <a href="<?php echo Request::$BASE_PATH.'reporting/stores/'.$objUser->id ;?>" class="btn btn-round btn-lg btn-grey no-hover">
                                <span class="line-height-1 smaller-90">Stores</span>
                            </a>
                            <a href="<?php echo Request::$BASE_PATH.'reporting/stores/'.$objUser->id ;?>" class="btn btn-round btn-lg btn-success no-hover">
                                <span class="line-height-1 smaller-90">Coupons</span>
                            </a>
<!--                            <span class="btn btn-app btn-sm btn-success no-hover">-->
<!--                                <span class="line-height-1 bigger-170"> --><?php //echo $objUser->today ;?><!-- </span>-->
<!--                                <br>-->
<!--                                <span class="line-height-1 smaller-90">Today</span>-->
<!--                            </span>-->
<!--                            <span class="btn btn-app btn-sm btn-success no-hover">-->
<!--                                <span class="line-height-1 bigger-170"> --><?php //echo $objUser->today ;?><!-- </span>-->
<!--                                <br>-->
<!--                                <span class="line-height-1 smaller-90">Today</span>-->
<!--                            </span>-->
<!---->
<!--                            <span class="btn btn-app btn-sm btn-grey no-hover">-->
<!--                                <span class="line-height-1 bigger-170"> --><?php //echo $objUser->yesterday ;?><!-- </span>-->
<!---->
<!--                                <br>-->
<!--                                <span class="line-height-1 smaller-90"> Yesterday </span>-->
<!--                            </span>-->
                        </div>

                        <div class="space-6"></div>
                        <div class="width-35 label label-info label-xlg arrowed-in arrowed-in-right" style="margin-left:2.5%">
                            <div class="inline position-relative">
                                <a href="#" class="user-title-label dropdown-toggle" data-toggle="dropdown">
                                    <span class="white"><?php echo $objUser->user_name ;?> </span>
                                </a>

                            </div>
                        </div>
                        <div class="space-6"></div>
                    </div>
                    <!-- PAGE CONTENT ENDS -->
                </div><!-- /.col -->
            </div><!-- /.row -->

           <div class="row">
               <div class="col-sm-5">
                   <form class="form-horizontal" id="sample-form">
                       <div class="form-group has-info">
                           <div class="col-xs-12 col-sm-12">
                               <label for="inputInfo" class="col-xs-12 col-sm-4 control-label no-padding-right">Start date:</label>
                                <span class="block input-icon input-icon-right">
                                    <input type="date"  name="start" id="inputInfo start" class="width-100" required/>
                                    <input type="hidden" name="id" id="id" class="width-100" value="<?php echo $objUser->id ;?>" required/>

                                </span>
                           </div>

                       </div>
                       <div class="form-group has-info">
                           <div class="col-xs-12 col-sm-12">
                               <label for="inputInfo" class="col-xs-12 col-sm-4 control-label no-padding-right">End date:</label>

                               <span class="block input-icon input-icon-right">
                                    <input type="date" name="end" id="inputInfo end" class="width-100" />

                                </span>
                           </div>

                       </div>



                       <div class="form-group">
                           <div class="col-xs-12 col-sm-9">
                               <a id="submit" class="btn btn-success">
                                   Submit
                               </a>
                           </div>
                       </div>


                   </form>
               </div>
               <div class="col-sm-7">
                   <div class="space-20"></div>

                   <div class="left">
                            <span class="btn btn-app btn-sm btn-success no-hover">
                                <span class="line-height-1 bigger-170 data">
                                </span>
                                <br>
                                <span class="line-height-1 smaller-90">Total</span>
                            </span>


                   </div>


               </div>
           </div>



        </div><!-- /.page-content -->
	</div>
</div><!-- /.main-content -->



<script src="<?php echo Request::$BASE_PATH; ?>assets/js/jquery.dataTables.min.js"></script>
<script src="<?php echo Request::$BASE_PATH; ?>assets/js/jquery.dataTables.bootstrap.min.js"></script>
<script src="<?php echo Request::$BASE_PATH; ?>assets/js/dataTables.buttons.min.js"></script>
<script src="<?php echo Request::$BASE_PATH; ?>assets/js/buttons.flash.min.js"></script>
<script src="<?php echo Request::$BASE_PATH; ?>assets/js/buttons.html5.min.js"></script>
<script src="<?php echo Request::$BASE_PATH; ?>assets/js/buttons.print.min.js"></script>
<script src="<?php echo Request::$BASE_PATH; ?>assets/js/buttons.colVis.min.js"></script>
<script src="<?php echo Request::$BASE_PATH; ?>assets/js/dataTables.select.min.js"></script>

<script src="<?php echo Request::$BASE_PATH.'assets/js/bootbox.js'; ?>"></script>
<script>
    $("#submit").click(function() {
        console.log('awais');
         var id=$("input[name=id]").val();
         var start=$("input[name=start]").val();
         var end=$("input[name=end]").val();

        if(id!='' && start!='' &&  end!=''){
            $.post("<?php echo Request::$BASE_PATH.'report-range' ?>", {
                id: id,
                start: start,
                end: end,
            }).done(function(data,status){
                if(status=='success'){
                    $('.data').text(data);
                }else{
                    alert('Error in remove User');
                }
            });
        }else {
            alert('Please enter Start And End Date')
        }

    });

</script>