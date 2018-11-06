<div class="main-content" xmlns="http://www.w3.org/1999/html">
    <div class="main-content-inner">


        <div class="page-content">


            <div class="page-header">
                <h1>
                    Edit Store
                    <?php if(isset($message) && $message!= '')echo $message ;?>
                    <small>
                    </small>
                </h1>
            </div><!-- /.page-header -->

            <div class="row">
                <div class="col-xs-12">
                    <form class="form-horizontal" id="sample-form" method="post" action="<?php echo Request::$BASE_PATH.'stores/edit_store/'.$objData->id ;?>" enctype="multipart/form-data">
                        <div class="form-group has-info">
                            <label for="inputInfo" class="col-xs-12 col-sm-3 control-label no-padding-right">Name:</label>

                            <div class="col-xs-12 col-sm-5">
                                <span class="block input-icon input-icon-right">
                                    <input type="text" name="name" id="inputInfo" value="<?php echo $objData->name ;?>" class="width-100" required/>
                                     <input type=hidden name="id" value="<?php echo $objData->id ;?>" id="inputInfo" class="width-100" required/>

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
                                        <option class="option" value="<?php echo $key->name ;?>" <?php if($key->name==$objData->category)echo 'selected';?>><?php echo $key->name?></option>
                                    <?php  }?>
                                    </select>

                                </span>
                            </div>

                        </div>
                        <div class="form-group has-info">
                            <div class="col-xs-2 col-sm-0">
                                <input type="hidden" name="logo" id="inputInfo" value="<?php echo $objData->logo ;?>" class="width-100"/>
                            </div>
                            <div class="col-xs-2 col-sm-12 col-xs-12">
                                <span class="block input-icon" style="max-width: 200px;max-width: 200px;">
                                    <img src="<?php echo Request::$BASE_PATH.'images/stores/'.$objData->logo ;?>" class="img-thumbnail"/>

                                </span>
                            </div>
                        </div>
                        <div class="form-group has-info">
                            <label for="inputInfo" class="col-xs-12 col-sm-3 control-label no-padding-right">Change Logo:</label>

                            <div class="col-xs-12 col-sm-5">
                                <span class="block input-icon input-icon-right">
                                    <input type="file" name="image" id="inputInfo" accept="image/*" class="width-100"/>

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
                                        <option class="option" value="<?php echo $key->name ;?>" <?php if($key->name==$objData->network)echo 'selected';?>><?php echo $key->name?></option>
                                    <?php  }?>
                                    </select>

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
                        <div class="form-group has-info">
                            <label for="inputInfo" class="col-xs-12 col-sm-3 control-label no-padding-right">Perma Link:</label>

                            <div class="col-xs-12 col-sm-5">
                                <span class="block input-icon input-icon-right">
                                    <select name="permalink" class="form-control">
                                        <option class="option" value="coupon-code" <?php if($objData->permalink=='coupon-code')echo 'selected' ;?>>coupon-code</option>
                                        <option class="option" value="promo-code" <?php if($objData->permalink=='promo-code')echo 'selected' ;?>>promo-code</option>
                                        <option class="option" value="discount-code" <?php if($objData->permalink=='discount-code')echo 'selected' ;?>>discount-code</option>
                                        <option class="option" value="coupons" <?php if($objData->permalink=='coupons')echo 'selected' ;?>>coupons</option>
                                        <option class="option" value="coupon-codes" <?php if($objData->permalink=='coupon-codes')echo 'selected' ;?>>coupon-codes</option>
                                        <option class="option" value="promo-codes" <?php if($objData->permalink=='promo-codes')echo 'selected' ;?>>promo-codes</option>
                                        <option class="option" value="discount-codes" <?php if($objData->permalink=='discount-codes')echo 'selected' ;?>>discount-codes</option>

                                    </select>

                                </span>
                            </div>
                        </div>

                        <div class="form-group has-info">
                            <label for="inputInfo" class="col-xs-12 col-sm-3 control-label no-padding-right">Network Id:</label>

                            <div class="col-xs-12 col-sm-5">
                                <span class="block input-icon input-icon-right">
                                    <input type="text" name="net_store_id" id="inputInfo" value="<?php echo $objData->net_store_id ;?>" class="width-100" required/>

                                </span>
                            </div>

                        </div>
                        <div class="form-group has-info">
                            <label for="inputInfo" class="col-xs-12 col-sm-3 control-label no-padding-right">Network Store name:</label>

                            <div class="col-xs-12 col-sm-5">
                                <span class="block input-icon input-icon-right">
                                    <input type="text" name="net_store_name" id="inputInfo" value="<?php echo $objData->net_store_name ;?>" class="width-100" required/>

                                </span>
                            </div>

                        </div>

                        <div class="form-group has-info">
                            <label for="inputInfo" class="col-xs-12 col-sm-3 control-label no-padding-right">Network Store Link:</label>

                            <div class="col-xs-12 col-sm-5">
                                <span class="block input-icon input-icon-right">
                                    <input type="text" name="net_store_link" id="inputInfo" value="<?php echo $objData->net_store_link ;?>" class="width-100" required/>

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
                                    <input type="text" name="meta_title" value="<?php echo $objData->meta_title ;?>" id="inputInfo" class="width-100" required/>

                                </span>
                            </div>

                        </div>
                        <div class="form-group has-info">
                            <label for="inputInfo" class="col-xs-12 col-sm-3 control-label no-padding-right">Meta Detail:</label>

                            <div class="col-xs-12 col-sm-5">
                                <span class="block input-icon input-icon-right">
                                    <textarea rows="5" cols="20" name="meta_detail" id="inputInfo" class="width-100" required/><?php echo $objData->meta_detail ;?>"</textarea>

                                </span>
                            </div>

                        </div>

                        <div class="form-group has-info">
                            <label for="inputInfo" class="col-xs-12 col-sm-3 control-label no-padding-right">Network:</label>

                            <div class="col-xs-12 col-sm-5">
                                <span class="block input-icon input-icon-right">
                                    <select name="featured" class="form-control" required>
                                        <option class="option" <?php if($objData->featured==1)echo 'selected';?> value="1">Yes</option>
                                        <option class="option" <?php if($objData->featured==0)echo 'selected';?> value="0">No</option>

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

			