<?php
    class Gateway {
        static function Process($parameters = NULL){
            if(!isset($parameters[0]) || $parameters[0] == '') $parameters[0] = 'Home';
            $objPresenter = new Presenter();
            $objPresenter->AddParameter('parameters', $parameters);
            

            if(Session::isUserOnline()){
                $objPresenter->AddTemplate('header');
            }
			switch ($parameters[0]){
			    case 'ranking':
			        if(Content::validate('ranking','p_view')){
			            if (!isset($parameters[1]) && $parameters[1]= ''){
			                header('Location:'.Request::$BASE_PATH);
			            }else {
			                if(Request::hasPostVariables()){
			                    if (Content::validate('ranking','p_edit')){
    			                    $objData=Request::getPostVariables();
    			                    foreach($objData as $key => $value){
    			                        $sql="UPDATE coupons SET rank='".$value."' where id='".$key."'";
    			                        global $DB;
    			                        if($DB->Execute($sql)){
    			                        }
    			                    }
			                    }else{header('Location:'.Request::$BASE_PATH);}
			                }
			                $store_id=intval($parameters[1]);
			                $objStore=Content::find_by_id($store_id, 'stores');
			                $objPresenter->AddParameter('objStore', $objStore);
			                $objData=Content::ranks($store_id);
			                $objPresenter->AddParameter('objData', $objData);
			                $objPresenter->AddTemplate('ranking');
			            }
			        }
			       break;
			    case 'reporting':
                    if (Content::validate('reports','p_view')){
                        if (!isset($parameters[1]) && $parameters[1]= ''){
                            header('Location:'.Request::$BASE_PATH);
                        }else {
                            if(Content::validatelevel(intval($parameters[2]))){
                                
                                switch ($parameters[1]){
                                    case 'networks':
                                        if(Content::validate('network report','p_view')) {
                                            if (isset($parameters[1]) && $parameters[1] != '') {
                                                $id=intval($parameters[2]);
                                                $objUser=Content::user($id);
                                                $objPresenter->AddParameter('objUser',$objUser);
                                                $objall=Content::reporting('networks',$id);
                                                $objPresenter->AddParameter('objall',$objall);
                                                $objPresenter->AddTemplate('network-report');
                                            }else{ header ( "Location: " . Request::$BASE_PATH.'reporting' );}
                                        }
                                        break;
                                    case 'categories':
                                        if(Content::validate('category report','p_view')) {
                                            if (isset($parameters[1]) && $parameters[1] != '') {
                                                $id=intval($parameters[2]);
                                                $objUser=Content::user($id);
                                                $objPresenter->AddParameter('objUser',$objUser);
                                                $objall=Content::reporting('categories',$id);
                                                $objPresenter->AddParameter('objall',$objall);
                                                $objPresenter->AddTemplate('categories-report');
                                            }
                                        }
                                        break;
                                    case 'stores':
                                        if(Content::validate('store report','p_view')) {
                                            if (isset($parameters[1]) && $parameters[1] != '') {
                                                $id=intval($parameters[2]);
                                                $objUser=Content::user($id);
                                                $objPresenter->AddParameter('objUser',$objUser);
                                                $objall=Content::reporting('stores',$id);
                                                $objPresenter->AddParameter('objall',$objall);
                                                $objPresenter->AddTemplate('stores-report');
                                            }
                                        }
                                        break;
                                    case 'coupons':
                                        if(Content::validate('coupon report','p_view')) {
                                            if (isset($parameters[1]) && $parameters[1] != '') {
                                                $id=intval($parameters[2]);
                                                $objUser=Content::user($id);
                                                $objPresenter->AddParameter('objUser',$objUser);
                                                $objall=Content::reporting('coupons',$id);
                                                $objPresenter->AddParameter('objall',$objall);
                                                
                                                $objPresenter->AddTemplate('coupons-report');
                                            }
                                        }
                                        break;
                                    default:
                                        header ( "Location: " . Request::$BASE_PATH.'reporting' );
                                        break;
                                }
                            }else{
                                header ( "Location: " . Request::$BASE_PATH.'access');
                            }
                            
                        }
                    }else{
                        header ( "Location: " . Request::$BASE_PATH );
                    }
                    break;
                case 'stores':
                    if (Content::validate('stores','p_view')){
                        $objall =Content::stores();
                        $objPresenter->AddParameter('objall', $objall);
                        if (!isset($parameters[1]) && $parameters[1]= ' '){
                            $objPresenter->AddTemplate('stores');
                        }else {
                            switch ($parameters[1]){
                                case 'new_store':
                                    if(Content::validate('stores','p_add')){
                                        $objcategories=Content::select('*','categories');
                                        $objPresenter->AddParameter('objcategories',$objcategories);
                                        $objnetworks=Content::select('*','networks');
                                        $objPresenter->AddParameter('objnetworks',$objnetworks);
                                        if(Request::hasPostVariables()){
                                            $objData = Request::getPostVariables();
                                            $setting=Content::select('*', 'global_settings');
                                            $setting=$setting[0];
                                            if(isset($objData->meta_title) && $objData->meta_title==''){
                                                $objData->meta_title=$objData->name.' '.$setting->meta_title;
                                            }
                                            if(isset($objData->meta_detail) && $objData->meta_detail==''){
                                                $objData->meta_detail=$objData->name.' '.$setting->meta_detail;
                                            }
                                            if(Content::validateStore($objData->name)){
                                                if (isset ( $_FILES ['image'] ['name'] ) && $_FILES ['image'] ['name'] != '') {
                                                    // ===========================Get file information=======================
                                                    $filename = pathinfo ( $_FILES ['image'] ['name'], PATHINFO_FILENAME );
                                                    $file_ext = pathinfo ( $_FILES ['image'] ['name'], PATHINFO_EXTENSION );
                                                    $file_size = $_FILES ['image'] ['size'];
                                                    // ==========================update file path name ======================
                                                    $filename = $filename . '_' . uniqid ();
                                                    // echo $filename;
                                                    $filename = $filename . '.' . $file_ext;
                                                    // ============================= validations ============================
                                                    if ($file_ext == 'jpeg' || $file_ext == 'jpg' || $file_ext == 'png' || $file_ext == 'gif') {
                                                        $target_path = 'images/stores/';
                                                        $target_path = $target_path . $filename;
                                                        if (move_uploaded_file ( $_FILES ['image'] ['tmp_name'], $target_path )) {
                                                            $objData->spam=Content::storeSpamCheck($objData->network_id,$objData->net_store_link);
                                                            $objData->name=Content::clean($objData->name);
                                                            $objData->logo = $filename;
                                                            $objData->publisher = Session::GetUser()->id;
                                                            $objData->created = date ( 'Y-m-d H:i:s' );
                                                            $objData->is_active = '1';
                                                            global $DB;
                                                            $DB->Save ( 'stores', $objData );
                                                            $objPresenter->AddParameter ( 'add_message', '<strong>Success</strong>Added' );
                                                            header ( "Location: " . Request::$BASE_PATH.'stores/' );
                                                        } else {
                                                            $objPresenter->AddParameter ( 'add_message', '<strong>Please upload Image png/jpg/jpeg/gif</strong>');
                                                        }
                                                    }
                                                }else{
                                                    $objPresenter->AddParameter ( 'add_message', '<strong>Please upload Store Logo</strong>' );
                                                }
                                            }else{
                                                $objPresenter->AddParameter ( 'add_message', '<strong>Store Already Exsist</strong>');
                                            }
                                        }
                                    }else{
                                        header ( "Location: " . Request::$BASE_PATH );
                                    }
                                    $objPresenter->AddTemplate('add_store');
                                    break;
                                case 'edit_store':
                                    if(Content::validate('stores','p_edit')){
                                        $objcategories=Content::select('*','categories');
                                        $objPresenter->AddParameter('objcategories',$objcategories);
                                        $objnetworks=Content::select('*','networks');
                                        $objPresenter->AddParameter('objnetworks',$objnetworks);
                                        if($parameters[2] !='' && isset($parameters[2])){
                                            if(Request::hasPostVariables()){
                                                $objData = Request::getPostVariables();
                                                if(Content::validateStoreEdit($objData->name,$objData->id)){
                                                    $setting=Content::select('*', 'global_settings');
                                                    $setting=$setting[0];
                                                    if(isset($objData->meta_title) && $objData->meta_title==''){
                                                        $objData->meta_title=$objData->name.' '.$setting->meta_title;
                                                    }
                                                    if(isset($objData->meta_detail) && $objData->meta_detail==''){
                                                        $objData->meta_detail=$objData->name.' '.$setting->meta_detail;
                                                    }
                                                    if (isset ( $_FILES ['image'] ['name'] ) && $_FILES ['image'] ['name'] != '') {
                                                        // ===========================Get file information=======================
                                                        $filename = pathinfo ( $_FILES ['image'] ['name'], PATHINFO_FILENAME );
                                                        $file_ext = pathinfo ( $_FILES ['image'] ['name'], PATHINFO_EXTENSION );
                                                        $file_size = $_FILES ['image'] ['size'];
                                                        // ==========================update file path name ======================
                                                        $filename = $filename . '_' . uniqid ();
                                                        // echo $filename;
                                                        $filename = $filename . '.' . $file_ext;
                                                        // ============================= validations ============================
                                                        if ($file_ext == 'jpeg' || $file_ext == 'jpg' || $file_ext == 'png' || $file_ext == 'gif') {
                                                            $target_path = 'images/stores/';
                                                            $target_path = $target_path . $filename;
                                                            if (move_uploaded_file ( $_FILES ['image'] ['tmp_name'], $target_path )) {
                                                                $objData->spam=Content::storeSpamCheck($objData->network_id,$objData->net_store_link);
                                                                $olddata = $objData->logo;
                                                                $objData->name=Content::clean($objData->name);
                                                                $objData->logo = $filename;
                                                                $id=intval($parameters[2]);
                                                                $objold=Content::publisher('stores',$id);
                                                                $objData->publisher=$objold->publisher;
                                                                $objData->edited_by=Session::GetUser()->id;
                                                                $objData->updated = date('Y-m-d H:i:s');
                                                                global $DB;
                                                                $DB->Save ( 'stores', $objData );
                                                                unlink ( 'images/stores/'.$olddata );
                                                                $objPresenter->AddParameter ( 'add_message', '<strong>Success</strong> Updated' );
                                                                header ( "Location: " . Request::$BASE_PATH.'stores/' );
                                                            } else {
                                                                $objPresenter->AddParameter ( 'Message', '<strong>Error</strong> Uploading Image Try Again Later!' );
                                                            }
                                                        } else {
                                                            $objPresenter->AddParameter ( 'Message', '<strong>Error</strong>Please upload Image png/jpg/jpeg/gif!' );
                                                        }
                                                    }else{
                                                        $id=intval($parameters[2]);
                                                        $objold=Content::publisher('stores',$id);
                                                        $objData->spam=Content::storeSpamCheck($objData->network_id,$objData->net_store_link);
                                                        $objData->name=Content::clean($objData->name);
                                                        $objData->publisher= $objold->publisher;
                                                        $objData->edited_by=Session::GetUser()->id;
                                                        $objData->updated = date('Y-m-d H:i:s');
                                                        global $DB;
                                                        if($DB->Save ( 'stores', $objData )){
                                                            $objPresenter->AddParameter ( 'add_message', '<strong>Success</strong> Updated' );
                                                            header ( "Location: " . Request::$BASE_PATH.'stores/' );
                                                        }
                                                    }
                                                }else{
                                                    ?>
                                                    <script type="text/javascript">
                                                        window.alert('Error! Store Already Exsist');
                                                        window.location.href='<?php echo  Request::$BASE_PATH.'stores/edit_store/'.$objData->id ;?>';
                                                    </script>
                                                    <?php 
                                                }
                                            }else{
                                                $id=intval($parameters[2]);
                                                $objData =Content::find_by_id($id,'stores');
                                                $objPresenter->AddParameter('objData',$objData);
                                            }
                                        }
                                        $objPresenter->AddTemplate('edit_store');
                                    }else{
                                        header ( "Location: " . Request::$BASE_PATH );
                                    }
                                    break;
                                case 'delete_store':
                                    if(Content::validate('stores','p_delete')){
                                        if(Request::hasPostVariables()){
                                            $objData = Request::getPostVariables();
                                            if(Session::GetUser()->user_role_id == '1'){
                                                global $DB;
                                                if($DB->Delete("DELETE FROM stores WHERE id = ".$objData->id)){
                                                    echo 'Success';
                                                }else{
                                                    echo 'Fail';
                                                }
                                            }else{
                                                echo "You are not Admin.";
                                            }
                                            exit;
                                        }
                                    }else{
                                        header ( "Location: " . Request::$BASE_PATH );
                                    }
                                    exit;
                                    break;
                                default:
                                    header ( "Location: ".Request::$BASE_PATH );
                                    break;
                            }
                        }
                    }else{
                        header ( "Location: " . Request::$BASE_PATH );
                    }
                    break;
                case 'codes':
                    if(Content::validate('coupons','p_view')){
                        $objall =Content::coupons();
                        $objPresenter->AddParameter('objall', $objall);
                        if (!isset($parameters[1]) && $parameters[1]= ' '){
                            $objPresenter->AddTemplate('codes');
                        }else {
                            switch ($parameters[1]){
                                case 'new_code':
                                    if(Content::validate('coupons','p_add')){
                                        if(Request::hasPostVariables()){
                                            $objData = Request::getPostVariables();
                                            if(Content::validateCoupon($objData->name, $objData->store_id)){
                                                if ($objData->address==''){
                                                    $objDstore =Content::find_by_id($objData->store_id,'stores');
                                                    if ($objDstore->net_store_link!==''){
                                                        $objData->address=$objDstore->net_store_link;
                                                    }else{
                                                        $objData->address=$objDstore->address;
                                                    }
                                                }
                                                
                                                if ($objData->code!=''){
                                                    $objData->type='coupon';
                                                }else{
                                                    $objData->type='deal';
                                                }
                                                $objData->spam=Content::couponSpamCheck($objData->store_id,$objData->address);
                                                $objData->created = date ( 'Y-m-d' );
                                                $objData->is_active = '1';
                                                $objData->publisher = Session::GetUser()->id;
                                                global $DB;
                                                $DB->Save ( 'coupons', $objData );
                                                $objPresenter->AddParameter ( 'add_message', '<strong>Success</strong> Added' );
                                                header ( "Location: " . Request::$BASE_PATH.'codes/' );
                                            }else{
                                                $objPresenter->AddParameter ( 'add_message', '<strong>Coupon Already Exsist</strong>');
                                            }
                                        }
                                        $objcategories=Content::select('*','categories');
                                        $objPresenter->AddParameter('objcategories',$objcategories);
                                        $objstores=Content::select('*','stores');
                                        $objPresenter->AddParameter('objstores',$objstores);
                                        $objPresenter->AddTemplate('add_code');
                                    }else{
                                        header ( "Location: " . Request::$BASE_PATH );
                                    }
                                    break;
                                case 'edit_code':
                                    if(Content::validate('coupons','p_edit')){
                                        if($parameters[2] !='' && isset($parameters[2])){
                                            if(Request::hasPostVariables()){
                                                $objData = Request::getPostVariables();
                                                if(Content::validateCouponedit($objData->name,$objData->store_id,$objData->id)){
                                                    if ($objData->address==''){
                                                        $objDstore =Content::find_by_id($objData->store_id,'stores');
                                                        if ($objDstore->net_store_link!==''){
                                                            $objData->address=$objDstore->net_store_link;
                                                        }else{
                                                            $objData->address=$objDstore->address;
                                                        }
                                                    }
                                                    if ($objData->code!=''){
                                                        $objData->type='coupon';
                                                    }else{
                                                        $objData->type='deal';
                                                    }
                                                    $id=intval($parameters[2]);
                                                    $objold=Content::publisher('coupons',$id);
                                                    $objData->spam=Content::couponSpamCheck($objData->store_id,$objData->address);
                                                    $objData->publisher=$objold->publisher;
                                                    $objData->edited_by = Session::GetUser()->id;
                                                    $objData->updated = date ( 'Y-m-d' );
                                                    global $DB;
                                                    $DB->Save ( 'coupons', $objData );
                                                    $objPresenter->AddParameter ( 'add_message', '<strong>Success</strong> Updated' );
                                                    header ( "Location: " . Request::$BASE_PATH.'codes/' );
                                                }else{
                                                    ?>
                                                    <script type="text/javascript">
                                                        window.alert('Error! Store Already Exsist');
                                                        window.location.href='<?php echo  Request::$BASE_PATH.'codes/edit_code/'.$objData->id ;?>';
                                                    </script>
                                                    <?php 
                                                }
                                            }else{
                                                $id=intval($parameters[2]);
                                                $objData =Content::find_by_id($id,'coupons');
                                                $objPresenter->AddParameter('objData',$objData);
                                                $objcategories=Content::select('*','categories');
                                                $objPresenter->AddParameter('objcategories',$objcategories);
                                                $objstores=Content::select('*','stores');
                                                $objPresenter->AddParameter('objstores',$objstores);
                                            }
                                        }
                                        $objPresenter->AddTemplate('edit_code');
                                    }else{
                                        header ( "Location: " . Request::$BASE_PATH );
                                    }
                                    break;
                                case 'delete_code':
                                    if(Content::validate('coupons','p_delete')){
                                        if(Request::hasPostVariables()){
                                            $objData = Request::getPostVariables();
                                            if(Session::GetUser()->user_role_id == '1'){
                                                global $DB;
                                                if($DB->Delete("DELETE FROM coupons WHERE id = ".$objData->id)){
                                                    echo 'Success';
                                                }else{
                                                    echo 'Fail';
                                                }
                                            }else{
                                                echo "You are not Admin.";
                                            }
                                            exit;
                                        }
                                    }else{
                                        header ( "Location: " . Request::$BASE_PATH );
                                    }
                                    exit;
                                    break;
                                default:
                                    $objPresenter->AddTemplate('new_code');
                                    break;
                            }
                        }
                    }else{
                        header ( "Location: " . Request::$BASE_PATH.'access' );
                    }
                    break;
                case 'roles':
                    if(Content::validate('roles','p_view')){
                        $objroles =Content::All('user_roles');
                        $objPresenter->AddParameter('objroles', $objroles);
                        if (!isset($parameters[1]) && $parameters[1]= ' '){
                            $objPresenter->AddTemplate('roles');
                        }else {
                            switch ($parameters[1]){
                                case 'new_role':
                                    if(Session::GetUser()->user_role_id == '1'){
                                        if(Request::hasPostVariables()){
                                            $objData = Request::getPostVariables();
                                            $objData->created = date ( 'Y-m-d H:i:s' );
                                            $objData->is_active = '1';
                                            global $DB;
                                            $DB->Save ( 'user_roles', $objData );
                                            $objPresenter->AddParameter ( 'add_message', '<strong>Success</strong> Added' );
                                            header ( "Location: " . Request::$BASE_PATH.'roles/' );
                                        }
                                    }else{
                                        header ( "Location: " . Request::$BASE_PATH );
                                    }
                                    $objPresenter->AddTemplate('add_role');
                                    break;
                                case 'edit_role':
                                    if(Session::GetUser()->user_role_id == '1' && Session::isUserOnline()){
                                        if($parameters[2] !='' && isset($parameters[2])){
                                            if(Request::hasPostVariables()){
                                                $objData = Request::getPostVariables();
                                                global $DB;
                                                $DB->Save ( 'user_roles', $objData );
                                                $objPresenter->AddParameter ( 'add_message', '<strong>Success</strong> Updated' );
                                                header ( "Location: " . Request::$BASE_PATH.'roles/' );
                                            }else{
                                                $id=intval($parameters[2]);
                                                $objData =Content::find_by_id($id,'user_roles');
                                                $objPresenter->AddParameter('objData',$objData);
                                            }
                                        }
                                        $objPresenter->AddTemplate('edit_role');
                                    }else{
                                        header ( "Location: " . Request::$BASE_PATH );
                                    }
                                    break;
                                case 'delete_role':
                                    if(Session::isUserOnline()){
                                        if(Request::hasPostVariables()){
                                            $objData = Request::getPostVariables();
                                            if(Session::GetUser()->user_role_id == '1'){
                                                global $DB;
                                                if($DB->Delete("DELETE FROM user_roles WHERE id = ".$objData->id)){
                                                    echo 'Success';
                                                }else{
                                                    echo 'Fail';
                                                }
                                            }else{
                                                echo "You are not Admin.";
                                            }
                                            exit;
                                        }
                                    }else{
                                        header ( "Location: " . Request::$BASE_PATH );
                                    }
                                    exit;
                                    break;
                                default:
                                    $objPresenter->AddTemplate('new_role');
                                    break;
                            }
                        }
                    }else{
                        header ( "Location: " . Request::$BASE_PATH.'access' );
                    }
                    break;
                case 'permissions':
                    if(Content::validate('permissions','p_view')){
                        $objall=Content::relation('*','role_permissions','user_roles','role','user_role_id');
                        $objPresenter->AddParameter('objall', $objall);
                        if (!isset($parameters[1]) && $parameters[1]= ' '){
                            $objPresenter->AddTemplate('permissions');
                        }else {
                            switch ($parameters[1]){
                                case 'new_permission':
                                    if(Content::validate('permissions','p_add')){
                                        $objroles=Content::select('*','user_roles');
                                        $objPresenter->AddParameter('objroles',$objroles);
                                        $objsection=Content::select('name','sections');
                                        $objPresenter->AddParameter('objsection',$objsection);
                                        if(Request::hasPostVariables()){
                                            $objData = Request::getPostVariables();
                                            $objData->created = date ( 'Y-m-d H:i:s' );
                                            $objData->is_active = '1';
                                            global $DB;
                                            $DB->Save ( 'role_permissions', $objData );
                                            $objPresenter->AddParameter ( 'add_message', '<strong>Success</strong> Added' );
                                            header ( "Location: " . Request::$BASE_PATH.'permissions/' );
                                        }
                                    }else{
                                        header ( "Location: " . Request::$BASE_PATH );
                                    }
                                    $objPresenter->AddTemplate('add_permission');
                                    break;
                                case 'edit_permission':
                                    if(Content::validate('permissions','p_edit')){
                                        if($parameters[2] !='' && isset($parameters[2])){
                                            if(Request::hasPostVariables()){
                                                $objData = Request::getPostVariables();
                                                global $DB;
                                                $DB->Save ( 'role_permissions', $objData );
                                                $objPresenter->AddParameter ( 'add_message', '<strong>Success</strong> Updated' );
                                                header ( "Location: " . Request::$BASE_PATH.'permissions/' );
                                            }else{
                                                $id=intval($parameters[2]);
                                                $objData =Content::find_by_id($id,'role_permissions');
                                                $objPresenter->AddParameter('objData',$objData);
                                            }
                                        }
                                        $objroles=Content::select('*','user_roles');
                                        $objPresenter->AddParameter('objroles',$objroles);
                                        $objsection=Content::select('name','sections');
                                        $objPresenter->AddParameter('objsection',$objsection);
                                        $objPresenter->AddTemplate('edit_permission');
                                    }else{
                                        header ( "Location: " . Request::$BASE_PATH );
                                    }
                                    break;
                                case 'delete_permission':
                                    if(Content::validate('permissions','p_delete')){
                                        if(Request::hasPostVariables()){
                                            $objData = Request::getPostVariables();
                                            if(Session::GetUser()->user_role_id == '1'){
                                                global $DB;
                                                if($DB->Delete("DELETE FROM role_permissions WHERE id = ".$objData->id)){
                                                    echo 'Success';
                                                }else{
                                                    echo 'Fail';
                                                }
                                            }else{
                                                echo "You are not Admin.";
                                            }
                                            exit;
                                        }
                                    }else{
                                        header ( "Location: " . Request::$BASE_PATH );
                                    }
                                    exit;
                                    break;
                                default:
                                    $objPresenter->AddTemplate('new_role');
                                    break;
                            }
                        }
                    }else{
                        header ( "Location: " . Request::$BASE_PATH.'access' );
                    }
                    break;
                case 'global_settings':
                    if(Content::validate('global settings','p_view')){
                        $objall =Content::All('global_settings');
                        $objPresenter->AddParameter('objall', $objall);
                        if (!isset($parameters[1]) && $parameters[1]= ' '){
                            $objPresenter->AddTemplate('settings');
                        }else {
                            switch ($parameters[1]){
                                case 'edit_settings':
                                    if(Content::validate('global settings','p_edit')){
                                        if($parameters[2] !=' ' && isset($parameters[2])){
                                            if(Request::hasPostVariables()){
                                                $objData = Request::getPostVariables();
                                                global $DB;
                                                $DB->Save ( 'global_settings', $objData );
                                                $objPresenter->AddParameter ( 'add_message', '<strong>Success</strong> Updated' );
                                                header ( "Location: " . Request::$BASE_PATH.'global_settings/' );
                                            }else{
                                                $id=intval($parameters[2]);
                                                $objData =Content::find_by_id($id,'global_settings');
                                                $objPresenter->AddParameter('objData',$objData);
                                            }
                                        }
                                        $objPresenter->AddTemplate('edit_settings');
                                    }else{
                                        header ( "Location: " . Request::$BASE_PATH );
                                    }
                                    break;
                                default:
                                    header ( "Location: " . Request::$BASE_PATH.'global_settings' );
                                    break;
                            }
                        }
                    }else{
                        header ( "Location: " . Request::$BASE_PATH.'access' );
                    }
                break;
                case 'categories':
                    if(Content::validate('categories','p_view')){
                        $objall =Content::All('categories');
                        $objPresenter->AddParameter('objall', $objall);
                        if (!isset($parameters[1]) && $parameters[1]= ' '){
                            $objPresenter->AddTemplate('categories');
                        }else {
                            switch ($parameters[1]){
                                case 'new_category':
                                    if(Content::validate('categories','p_add')){
                                        if(Request::hasPostVariables()){
                                            $objData = Request::getPostVariables();
                                            $objData->name=Content::clean($objData->name);
                                            $setting=Content::select('*', 'global_settings');
                                            $setting=$setting[1];
                                            if(isset($objData->meta_title) && $objData->meta_title==''){
                                                $objData->meta_title=$objData->name.' '.$setting->meta_title;
                                            }
                                            if(isset($objData->meta_detail) && $objData->meta_detail==''){
                                                $objData->meta_detail=$objData->name.' '.$setting->meta_detail;
                                            }
                                            $objData->publisher = Session::GetUser()->id;
                                            $objData->created = date ( 'Y-m-d H:i:s' );
                                            $objData->is_active = '1';
                                            global $DB;
                                            $DB->Save ( 'categories', $objData );
                                            $objPresenter->AddParameter ( 'add_message', '<strong>Success</strong> Added' );
                                            header ( "Location: " . Request::$BASE_PATH.'categories/' );
                                        }
                                    }else{
                                        header ( "Location: " . Request::$BASE_PATH );
                                    }
                                    $objPresenter->AddTemplate('add_category');
                                    break;
                                case 'edit_category':
                                    if(Content::validate('categories','p_edit')){
                                        if($parameters[2] !='' && isset($parameters[2])){
                                            if(Request::hasPostVariables()){
                                                $objData =Request::getPostVariables();
                                                $id=intval($parameters[2]);
                                                $objData->name=Content::clean($objData->name);
                                                $setting=Content::select('*', 'global_settings');
                                                $setting=$setting[1];
                                                if(isset($objData->meta_title) && $objData->meta_title==''){
                                                    $objData->meta_title=$objData->name.' '.$setting->meta_title;
                                                }
                                                if(isset($objData->meta_detail) && $objData->meta_detail==''){
                                                    $objData->meta_detail=$objData->name.' '.$setting->meta_detail;
                                                }
                                                $objold=Content::publisher('categories',$id);
                                                $objData->publisher=$objold->publisher;
                                                $objData->edited_by=Session::GetUser()->id;
                                                $objData->updated = date('Y-m-d H:i:s');
                                                global $DB;
                                                $DB->Save ( 'categories', $objData );
                                                $objPresenter->AddParameter ( 'add_message', '<strong>Success</strong> Updated' );
                                                header ( "Location: " . Request::$BASE_PATH.'categories/' );
                                            }else{
                                                $id=intval($parameters[2]);
                                                $objData =Content::find_by_id($id,'categories');
                                                $objPresenter->AddParameter('objData',$objData);
                                            }
                                        }
                                        $objPresenter->AddTemplate('edit_category');
                                    }else{
                                        header ( "Location: " . Request::$BASE_PATH );
                                    }
                                    break;
                                case 'delete_category':
                                    if(Content::validate('categories','p_delete')){
                                        if(Request::hasPostVariables()){
                                            $objData = Request::getPostVariables();
                                            if(Session::GetUser()->user_role_id == '1'){
                                                global $DB;
                                                if($DB->Delete("DELETE FROM categories WHERE id = ".$objData->id)){
                                                    echo 'Success';
                                                }else{
                                                    echo 'Fail';
                                                }
                                            }else{
                                                echo "You are not Admin.";
                                            }
                                            exit;
                                        }
                                    }else{
                                        header ( "Location: " . Request::$BASE_PATH );
                                    }
                                    exit;
                                    break;
                                default:
                                    $objPresenter->AddTemplate('new_category');
                                    break;
                            }
                        }
                    }else{
                        header ( "Location: " . Request::$BASE_PATH.'access' );
                    }
                    break;
                case 'networks':
                    if(Content::validate('networks','p_view')){
                        $objall =Content::All('networks');
                        $objPresenter->AddParameter('objall', $objall);
                        if (!isset($parameters[1]) && $parameters[1]= ' '){
                            $objPresenter->AddTemplate('networks');
                        }else {
                            switch ($parameters[1]){
                                case 'new_network':
                                    if(Content::validate('networks','p_add')){
                                        if(Request::hasPostVariables()){
                                            $objData = Request::getPostVariables();
                                            $objData->publisher = Session::GetUser()->id;
                                            $objData->created = date ( 'Y-m-d H:i:s' );
                                            $objData->is_active = '1';
                                            global $DB;
                                            $DB->Save ( 'networks', $objData );
                                            $objPresenter->AddParameter ( 'add_message', '<strong>Success</strong> Added' );
                                            header ( "Location: " . Request::$BASE_PATH.'networks/' );
                                        }
                                    }else{
                                        header ( "Location: " . Request::$BASE_PATH );
                                    }
                                    $objPresenter->AddTemplate('add_network');
                                    break;
                                case 'edit_network':
                                    if(Content::validate('networks','p_edit')){
                                        if($parameters[2]!=' ' && isset($parameters[2])){
                                            if(Request::hasPostVariables()){
                                                $objData =Request::getPostVariables();
                                                $id=intval($parameters[2]);
                                                $objold=Content::publisher('networks',$id);
                                                $objData->publisher=$objold->publisher;
                                                $objData->edited_by=Session::GetUser()->id;
                                                $objData->updated = date('Y-m-d H:i:s');
                                                global $DB;
                                                $DB->Save ( 'networks', $objData );
                                                $objPresenter->AddParameter ( 'add_message', '<strong>Success</strong>Updated' );
                                                header ( "Location: " . Request::$BASE_PATH.'networks/' );
                                            }else{
                                                $id=intval($parameters[2]);
                                                $objData =Content::find_by_id($id,'networks');
                                                $objPresenter->AddParameter('objData',$objData);
                                            }
                                        }
                                        $objPresenter->AddTemplate('edit_network');
                                    }else{
                                        header ( "Location: " . Request::$BASE_PATH );
                                    }
                                    break;
                                case 'delete_network':
                                    if(Content::validate('networks','p_delete')){
                                        if(Request::hasPostVariables()){
                                            $objData = Request::getPostVariables();
                                            if(Session::GetUser()->user_role_id == '1'){
                                                global $DB;
                                                if($DB->Delete("DELETE FROM networks WHERE id = ".$objData->id)){
                                                    echo 'Success';
                                                }else{
                                                    echo 'Fail';
                                                }
                                            }else{
                                                echo "You are not Admin.";
                                            }
                                            exit;
                                        }
                                    }else{
                                        header ( "Location: " . Request::$BASE_PATH );
                                    }
                                    exit;
                                    break;
                                default:
                                    $objPresenter->AddTemplate('new_network');
                                    break;
                            }
                        }
                    }else{
                        header ( "Location: " . Request::$BASE_PATH.'access' );
                    }
                    break;
                case 'sections':
                    if(Content::validate('sections','p_view')){
                        $objall =Content::All('sections');
                        $objPresenter->AddParameter('objall', $objall);
                        if (!isset($parameters[1]) && $parameters[1]= ' '){
                            $objPresenter->AddTemplate('sections');
                        }else {
                            switch ($parameters[1]){
                                case 'new_section':
                                    if(Content::validate('sections','p_add')){
                                        if(Request::hasPostVariables()){
                                            $objData = Request::getPostVariables();
                                            $objData->created = date ( 'Y-m-d H:i:s' );
                                            $objData->is_active = '1';
                                            global $DB;
                                            $DB->Save ( 'sections', $objData );
                                            $objPresenter->AddParameter ( 'add_message', '<strong>Success</strong>Added ' );
                                            header ( "Location: " . Request::$BASE_PATH.'sections/' );
                                        }
                                    }else{
                                        header ( "Location: " . Request::$BASE_PATH );
                                    }
                                    $objPresenter->AddTemplate('add_section');
                                    break;
                                case 'edit_section':
                                    if(Content::validate('sections','p_edit')){
                                        if($parameters[2] !='' && isset($parameters[2])){
                                            if(Request::hasPostVariables()){
                                                $objData = Request::getPostVariables();
                                                global $DB;
                                                $DB->Save ( 'sections', $objData );
                                                $objPresenter->AddParameter ( 'add_message', '<strong>Success</strong>Updated ' );
                                                header ( "Location: " . Request::$BASE_PATH.'sections/' );
                                            }else{
                                                $id=intval($parameters[2]);
                                                $objData =Content::find_by_id($id,'sections');
                                                $objPresenter->AddParameter('objData',$objData);
                                            }
                                        }
                                        $objPresenter->AddTemplate('edit_section');
                                    }else{
                                        header ( "Location: " . Request::$BASE_PATH );
                                    }
                                    break;
                                case 'delete_section':
                                    if(Content::validate('sections','p_delete')){
                                        if(Request::hasPostVariables()){
                                            $objData = Request::getPostVariables();
                                            if(Session::GetUser()->user_role_id == '1'){
                                                global $DB;
                                                if($DB->Delete("DELETE FROM sections WHERE id = ".$objData->id)){
                                                    echo 'Success';
                                                }else{
                                                    echo 'Fail';
                                                }
                                            }else{
                                                echo "You are not Admin.";
                                            }
                                            exit;
                                        }
                                    }else{
                                        header ( "Location: " . Request::$BASE_PATH );
                                    }
                                    exit;
                                    break;
                                default:
                                    $objPresenter->AddTemplate('new_section');
                                    break;
                            }
                        }
                    }else{
                        header ( "Location: " . Request::$BASE_PATH.'access' );
                    }

                    break;

				case 'login':
							if(!Session::isUserOnline()){
								if(Request::hasPostVariables()){
			            			$objData = Request::getPostVariables();

			            			if(User::Validate($objData)){
			            				header ( "Location: " . Request::$BASE_PATH );
			            			}
									$objPresenter->AddParameter ( 'Message', '<div class="alert alert-danger"><strong>Error</strong> Not a valid user. Please Try again.</div>' );
								}
								$objPresenter->AddTemplate('login');
							}else{
								header ( "Location: " . Request::$BASE_PATH );
							}
							break;
                case 'reports':
                    if(Content::validate('reports','p_view')){
                        if(Content::validatelevel(intval($parameters[1]))){
                            $last_date= date('Y-m-d', strtotime(' -1 day'));
                            $date=date('Y-m-d');
                            if($parameters[1] !='' && isset($parameters[1])){
                                $id=intval($parameters[1]);
                                $objUser=Content::user($id);
                                $objData=Content::selectCount('coupons','publisher',$id,$date,'today');
                                $objUser->today=$objData->today;
                                $objData=Content::selectCount('coupons','publisher',$id,$last_date,'last');
                                $objUser->yesterday=$objData->last;
                                $objPresenter->AddParameter('objUser',$objUser);
                            }else{
                                header ( "Location: " . Request::$BASE_PATH.'' );
                            }
                            $objPresenter->AddTemplate('reports');
                        }else{
                            header ( "Location: " . Request::$BASE_PATH.'access' );
                        }
                        
                    }else{
                        header ( "Location: " . Request::$BASE_PATH.'access' );
                    }
                    break;
                case 'report-range':
                    if(Content::validate('reports','p_view')){
                        if(Request::hasPostVariables()){
                            $objData= Request::getPostVariables();
                            $result= Content::reports($objData->start,$objData->end,$objData->id);
                            echo $result;
                            exit;
                        }
                    }else{
                        header ( "Location: " . Request::$BASE_PATH );
                    }
                    break;
				case 'logout':
							if (Session::isUserOnline()){
								Session::Destroy();
								header ( "Location: " . Request::$BASE_PATH );
							}else {
								header ( "Location: " . Request::$BASE_PATH );
							}
							break;
                case 'users':
                    if(Content::validate('users','p_view')){
                    $objall_users =Content::relation('*','users','user_roles','role','user_role_id');
                    $objPresenter->AddParameter('objall_users', $objall_users);
                    if (!isset($parameters[1]) && $parameters[1]=' '){
                        $objPresenter->AddTemplate('users');
                    }else {
                        switch ($parameters[1]){
                            case 'new_user':
                                if(Content::validate('users','p_add')){
                                    $objroles=Content::select('*','user_roles');
                                    $objPresenter->AddParameter('objroles',$objroles);
                                    if(Request::hasPostVariables()){
                                        $objData = Request::getPostVariables();
                                        if(User::CheckEmail($objData->email)){
                                            $objData->created = date ( 'Y-m-d H:i:s' );
                                            $objData->is_active = '1';
                                            $objData->password = md5($objData->password);
                                            global $DB;
                                            $DB->Save ( 'users', $objData );
                                            $objPresenter->AddParameter ( 'add_message', '<div class="alert alert-success"><strong>Success</strong> User Added</div>' );
                                            header ( "Location: " . Request::$BASE_PATH.'users/' );
                                        }else {
                                            $objPresenter->AddParameter ( 'add_message', '<div class="alert alert-danger"><strong>Error</strong> Email Already exsist!</div>' );
                                        }
                                    }
                                }else{
                                    header ( "Location: " . Request::$BASE_PATH );
                                }
                                $objPresenter->AddTemplate('add_user');
                                break;
                            case 'delete_user':
                                if(Content::validate('users','p_delete')){
                                    if(Request::hasPostVariables()){
                                        $objData = Request::getPostVariables();
                                        if(Session::GetUser()->id == $objData->id){
                                            echo "User cannot delete it self.";
                                        }else{
                                            global $DB;
                                            if($DB->Delete("DELETE FROM users WHERE id = ".$objData->id)){
                                                //echo 'Success';
                                            }else{
                                                echo 'Fail';
                                            }
                                        }
                                        exit;
                                    }
                                }else{
                                    header ( "Location: " . Request::$BASE_PATH );
                                }
                                break;
                            case 'edit_user':

                                if(Content::validate('users','p_edit')){

                                    if($parameters[2] !='' && isset($parameters[2])){
                                        $objroles=Content::select('*','user_roles');
                                        $objPresenter->AddParameter('objroles',$objroles);

                                        if(Request::hasPostVariables()){
                                            $objData = Request::getPostVariables();
                                            if(isset($objData->n_password) && $objData->n_password!==''){
                                                $objData->password=md5($objData->n_password);
                                            }
                                            global $DB;
                                            $DB->Save ( 'users', $objData );
                                            $objPresenter->AddParameter ( 'add_message', '<div class="alert alert-success"><strong>Success</strong> Updated Record </div>' );
                                            header ( "Location: " . Request::$BASE_PATH.'users/' );
                                        }else{
                                            $id=intval($parameters[2]);
                                            $objData =Content::find_by_id($id,'users');
                                            $objPresenter->AddParameter('objData',$objData);
                                        }
                                    }

                                    $objPresenter->AddTemplate('edit_user');
                                }else{
                                    header ( "Location: " . Request::$BASE_PATH );
                                }

                                break;
                            default:
                                break;
                        }
                    }
                    }else{
                        header ( "Location: " . Request::$BASE_PATH.'access' );
                    }
                    break;

                case 'access':
                    if(Session::isUserOnline()){
                    $objPresenter->AddTemplate('access');
                    }else {
                        $objPresenter->AddTemplate('login');
                    }
                    break;
                case 'import':
                    if (Content::validate('upload','p_add')) {
                        if(isset($_FILES ['file']['name']) && $_FILES ['file']['name']!=''){
                            $file=$_FILES ['file']['name'];
                            $file_ext = pathinfo ( $_FILES ['file'] ['name'], PATHINFO_EXTENSION );
                            if($file_ext=='csv'){
                                $target_path = 'uploads/cvs/';
                                $target_path = $target_path.$file;
                                if (move_uploaded_file ( $_FILES ['file'] ['tmp_name'], $target_path )) {
                                    $handle = fopen($target_path, "r");
                                    $data = fgetcsv($handle, 1000, ",");
                                    $row = 1;
                                    if ( $handle !== FALSE) {
                                        while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
                                            global $DB;
                                            $objData = new stdClass();
                                            if(isset($data[0]) && $data[0] !=''){
                                                $objData->name=$data[0];
                                            }else {
                                                exit();
                                            }
                                            if(isset($data[1]) && $data[1] !=''){
                                                $objData->detail=$data[1];
                                            }
                                            if(isset($data[2]) && $data[2] !=''){
                                                $objData->discount=$data[2];
                                            }else{
                                                exit();
                                            }
                                            if(isset($data[3]) && $data[3] !=''){
                                                $objData->code=$data[3];
                                            }
                                            if(isset($data[4]) && $data[4] !=''){
                                                $objData->type=$data[4];
                                            }else {
                                                exit();
                                            }
                                            if(isset($data[5]) && $data[5] !=''){
                                                $objData->store_id=Content::getId($data[5], 'stores');
                                            }
                                            if(isset($data[6]) && $data[6] !=''){
                                                $objData->address=$data[6];
                                            }
                                            if(isset($data[7]) && $data[7] !=''){
                                                $objData->category_id=Content::getId($data[7], 'categories');
                                            }
                                            if(isset($data[8]) && $data[8] !=''){
                                                $objData->rank=$data[8];
                                            }
                                            if(isset($data[9]) && $data[9] !=''){
                                                $myDateTime = DateTime::createFromFormat('m/d/Y', $data[9]);
                                                $myDateTime = $myDateTime->format('Y-m-d');
                                                $objData->active_date=$myDateTime;
                                            }else {
                                                exit();
                                            }
                                            if(isset($data[10]) && $data[10] !=''){
                                                $myDateTime = DateTime::createFromFormat('m/d/Y', $data[9]);
                                                $myDateTime = $myDateTime->format('Y-m-d');
                                                $objData->expire_date=$myDateTime;
                                            }else {
                                                exit();
                                            }
                                            if ($objData->address==''){
                                                $objDstore =Content::find_by_id($objData->store_id,'stores');
                                                if ($objDstore->net_store_link!==''){
                                                    $objData->address=$objDstore->net_store_link;
                                                }else{
                                                    $objData->address=$objDstore->address;
                                                }
                                            }
                                            if ($objData->code!==''){
                                                $objData->type='coupon';
                                            }else{
                                                $objData->type='deal';
                                            }
                                            $objData->spam=Content::couponSpamCheck($objData->store_id,$objData->address);
                                            $objData->publisher=Session::GetUser()->id;
                                            $objData->created = date( 'Y-m-d H:i:s' );
                                            $objData->is_active = '1';
                                            $DB->Save('coupons', $objData);
                                            $row++;
                                        }
                                        fclose($handle);
                                    }
                                    @unlink($target_path);
                                    header('Location:'.Request::$BASE_PATH.'codes/');
                                    }
                            }else{
                                $objPresenter->AddParameter ( 'msg', '<strong> Faild! </strong>      Please upload CSV format only    ' );
                            }
                        }
                       $objPresenter->AddTemplate('import');
                    }else{
                       header('Location:' . Request::$BASE_PATH . 'access');
                    }
                    break;
                default:
                    if(Session::isUserOnline()){
                        if (Content::validate('coupons','p_view')) {
                            header('Location:' . Request::$BASE_PATH .'codes');
                        }else{
                            header('Location:' . Request::$BASE_PATH .'access');
                        }
                    }else {
                        $objPresenter->AddTemplate('login');
                    }
                    break;
            }
            
	        if(Session::isUserOnline()){
				$objPresenter->AddTemplate('footer');
	        }
            $objPresenter->Publish();
        }
    }
