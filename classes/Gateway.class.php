
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

                case 'stores':
                    $objall =Content::All('stores');
                    $objPresenter->AddParameter('objall', $objall);
                    if (!isset($parameters[1]) && $parameters[1]= ' '){
                        $objPresenter->AddTemplate('stores');
                    }else {
                        switch ($parameters[1]){
                            case 'new_store':
                                if(Session::GetUser()->user_role_id == '1'){
                                    $objcategories=Content::select('name','categories');
                                    $objPresenter->AddParameter('objcategories',$objcategories);
                                    $objnetworks=Content::select('name','networks');
                                    $objPresenter->AddParameter('objnetworks',$objnetworks);
                                    if(Request::hasPostVariables()){
                                        $objData = Request::getPostVariables();
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
                                                    $objData->logo = $filename;
                                                    $objData->created = date ( 'Y-m-d' );
                                                    $objData->is_active = '1';
                                                    global $DB;
                                                    $DB->Save ( 'stores', $objData );
                                                    $objPresenter->AddParameter ( 'add_message', '<div class="alert alert-success"><strong>Success</strong></div>' );
                                                    header ( "Location: " . Request::$BASE_PATH.'stores/' );

                                                } else {
                                                    $objPresenter->AddParameter ( 'add_message', '<div class="alert alert-danger"><strong>Pleas upload Image png/jpg/jpeg/gif</strong></div>' );

                                                }
                                            }
                                        }else{
                                            $objPresenter->AddParameter ( 'add_message', '<div class="alert alert-danger"><strong>Please upload Store Logo</strong></div>' );
                                        }

                                    }
                                }else{
                                    header ( "Location: " . Request::$BASE_PATH );
                                }
                                $objPresenter->AddTemplate('add_store');
                                break;
                            case 'edit_store':

                                if(Session::GetUser()->user_role_id == '1' && Session::isUserOnline()){
                                    $objcategories=Content::select('name','categories');
                                    $objPresenter->AddParameter('objcategories',$objcategories);
                                    $objnetworks=Content::select('name','networks');
                                    $objPresenter->AddParameter('objnetworks',$objnetworks);
                                    if($parameters[2] !='' && isset($parameters[2])){
                                        if(Request::hasPostVariables()){
                                            $objData = Request::getPostVariables();


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
                                                        $olddata = $objData->logo;
                                                        $objData->logo = $filename;
                                                        global $DB;
                                                        $DB->Save ( 'stores', $objData );
                                                        unlink ( 'images/stores/'.$olddata );
                                                        $objPresenter->AddParameter ( 'add_message', '<div class="alert alert-success"><strong>Success</strong></div>' );
                                                        header ( "Location: " . Request::$BASE_PATH.'stores/' );

                                                    } else {
                                                        $objPresenter->AddParameter ( 'Message', '<div class="alert alert-danger"><strong>Error</strong> Uploading Image Try Again Later!</div>' );

                                                    }
                                                } else {
                                                    $objPresenter->AddParameter ( 'Message', '<div class="alert alert-danger"><strong>Error</strong>Please upload Image png/jpg/jpeg/gif!</div>' );

                                                }
                                            }else{

                                                global $DB;
                                                if($DB->Save ( 'stores', $objData )){
                                                    $objPresenter->AddParameter ( 'add_message', '<div class="alert alert-success"><strong>Success</strong> Updated Record </div>' );
                                                    header ( "Location: " . Request::$BASE_PATH.'stores/' );
                                                }
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
                                if(Session::isUserOnline()){
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
                                $objPresenter->AddTemplate('new_role');
                                break;
                        }
                    }

                    break;

                case 'codes':
                    $objall =Content::coupons();
                    $objPresenter->AddParameter('objall', $objall);
                    if (!isset($parameters[1]) && $parameters[1]= ' '){
                        $objPresenter->AddTemplate('codes');
                    }else {
                        switch ($parameters[1]){
                            case 'new_code':
                                if(Session::GetUser()->user_role_id == '1'){
                                    if(Request::hasPostVariables()){
                                        $objData = Request::getPostVariables();
                                        $objData->created = date ( 'Y-m-d' );
                                        $objData->is_active = '1';
                                        $objData->publisher = Session::GetUser()->id;
                                        global $DB;
                                        $DB->Save ( 'coupons', $objData );
                                        $objPresenter->AddParameter ( 'add_message', '<div class="alert alert-success"><strong>Success</strong></div>' );
                                        header ( "Location: " . Request::$BASE_PATH.'codes/' );
                                    }
                                }else{
                                    header ( "Location: " . Request::$BASE_PATH );
                                }
                                $objcategories=Content::select('*','categories');
                                $objPresenter->AddParameter('objcategories',$objcategories);
                                $objstores=Content::select('*','stores');
                                $objPresenter->AddParameter('objstores',$objstores);
                                $objPresenter->AddTemplate('add_code');
                                break;
                            case 'edit_code':

                                if(Session::GetUser()->user_role_id == '1' && Session::isUserOnline()){
                                    if($parameters[2] !='' && isset($parameters[2])){
                                        if(Request::hasPostVariables()){
                                            $objold=Content::select('publisher','coupons');
                                            $objData = Request::getPostVariables();
                                            $objData->publisher=$objold[0]->publisher;
                                            $objData->edited_by = Session::GetUser()->id;
                                            $objData->updated = date ( 'Y-m-d' );
                                            global $DB;
                                            $DB->Save ( 'coupons', $objData );
                                            $objPresenter->AddParameter ( 'add_message', '<div class="alert alert-success"><strong>Success</strong> Updated Record </div>' );
                                            header ( "Location: " . Request::$BASE_PATH.'codes/' );
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
                                if(Session::isUserOnline()){
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

                    break;

                case 'roles':
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
                                        $objPresenter->AddParameter ( 'add_message', '<div class="alert alert-success"><strong>Success</strong> Company Added</div>' );
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
                                            $objPresenter->AddParameter ( 'add_message', '<div class="alert alert-success"><strong>Success</strong> Updated Record </div>' );
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

                    break;

                case 'permissions':
                    $objall=Content::relation('*','role_permissions','user_roles','role','user_role_id');
                    $objPresenter->AddParameter('objall', $objall);
                    if (!isset($parameters[1]) && $parameters[1]= ' '){
                        $objPresenter->AddTemplate('permissions');
                    }else {
                        switch ($parameters[1]){
                            case 'new_permission':
                                if(Session::GetUser()->user_role_id == '1'){
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
                                        $objPresenter->AddParameter ( 'add_message', '<div class="alert alert-success"><strong>Success</strong> Company Added</div>' );
                                        header ( "Location: " . Request::$BASE_PATH.'permissions/' );
                                    }
                                }else{
                                    header ( "Location: " . Request::$BASE_PATH );
                                }
                                $objPresenter->AddTemplate('add_permission');
                                break;
                            case 'edit_permission':

                                if(Session::GetUser()->user_role_id == '1' && Session::isUserOnline()){
                                    if($parameters[2] !='' && isset($parameters[2])){
                                        if(Request::hasPostVariables()){
                                            $objData = Request::getPostVariables();
                                            global $DB;
                                            $DB->Save ( 'role_permissions', $objData );
                                            $objPresenter->AddParameter ( 'add_message', '<div class="alert alert-success"><strong>Success</strong> Updated Record </div>' );
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
                                if(Session::isUserOnline()){
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

                    break;

                case 'global_settings':
                $objall =Content::All('global_settings');
                $objPresenter->AddParameter('objall', $objall);
                if (!isset($parameters[1]) && $parameters[1]= ' '){
                    $objPresenter->AddTemplate('settings');
                }else {
                    switch ($parameters[1]){
                        case 'edit_settings':

                            if(Session::GetUser()->user_role_id == '1' && Session::isUserOnline()){
                                if($parameters[2] !='' && isset($parameters[2])){
                                    if(Request::hasPostVariables()){
                                        $objData = Request::getPostVariables();
                                        global $DB;
                                        $DB->Save ( 'global_settings', $objData );
                                        $objPresenter->AddParameter ( 'add_message', '<div class="alert alert-success"><strong>Success</strong> Updated Record </div>' );
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

                break;

                case 'categories':
                    $objall =Content::All('categories');
                    $objPresenter->AddParameter('objall', $objall);
                    if (!isset($parameters[1]) && $parameters[1]= ' '){
                        $objPresenter->AddTemplate('categories');
                    }else {
                        switch ($parameters[1]){
                            case 'new_category':
                                if(Session::GetUser()->user_role_id == '1'){

                                    if(Request::hasPostVariables()){
                                        $objData = Request::getPostVariables();
                                        $objData->created = date ( 'Y-m-d H:i:s' );
                                        $objData->is_active = '1';
                                        global $DB;
                                        $DB->Save ( 'categories', $objData );
                                        $objPresenter->AddParameter ( 'add_message', '<div class="alert alert-success"><strong>Success</strong> Company Added</div>' );
                                        header ( "Location: " . Request::$BASE_PATH.'categories/' );
                                    }
                                }else{
                                    header ( "Location: " . Request::$BASE_PATH );
                                }
                                $objPresenter->AddTemplate('add_category');
                                break;
                            case 'edit_category':

                                if(Session::GetUser()->user_role_id == '1' && Session::isUserOnline()){
                                    if($parameters[2] !='' && isset($parameters[2])){
                                        if(Request::hasPostVariables()){
                                            $objData = Request::getPostVariables();
                                            global $DB;
                                            $DB->Save ( 'categories', $objData );
                                            $objPresenter->AddParameter ( 'add_message', '<div class="alert alert-success"><strong>Success</strong> Updated Record </div>' );
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
                                if(Session::isUserOnline()){
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

                    break;

                case 'networks':
                    $objall =Content::All('networks');
                    $objPresenter->AddParameter('objall', $objall);
                    if (!isset($parameters[1]) && $parameters[1]= ' '){
                        $objPresenter->AddTemplate('networks');
                    }else {
                        switch ($parameters[1]){
                            case 'new_network':
                                if(Session::GetUser()->user_role_id == '1'){

                                    if(Request::hasPostVariables()){
                                        $objData = Request::getPostVariables();
                                        $objData->created = date ( 'Y-m-d H:i:s' );
                                        $objData->is_active = '1';
                                        global $DB;
                                        $DB->Save ( 'networks', $objData );
                                        $objPresenter->AddParameter ( 'add_message', '<div class="alert alert-success"><strong>Success</strong> Company Added</div>' );
                                        header ( "Location: " . Request::$BASE_PATH.'networks/' );
                                    }
                                }else{
                                    header ( "Location: " . Request::$BASE_PATH );
                                }
                                $objPresenter->AddTemplate('add_network');
                                break;
                            case 'edit_network':

                                if(Session::GetUser()->user_role_id == '1' && Session::isUserOnline()){
                                    if($parameters[2] !='' && isset($parameters[2])){
                                        if(Request::hasPostVariables()){
                                            $objData = Request::getPostVariables();
                                            global $DB;
                                            $DB->Save ( 'networks', $objData );
                                            $objPresenter->AddParameter ( 'add_message', '<div class="alert alert-success"><strong>Success</strong> Updated Record </div>' );
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
                                if(Session::isUserOnline()){
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

                    break;

                case 'sections':
                    $objall =Content::All('sections');
                    $objPresenter->AddParameter('objall', $objall);
                    if (!isset($parameters[1]) && $parameters[1]= ' '){
                        $objPresenter->AddTemplate('sections');
                    }else {
                        switch ($parameters[1]){
                            case 'new_section':
                                if(Session::GetUser()->user_role_id == '1'){

                                    if(Request::hasPostVariables()){
                                        $objData = Request::getPostVariables();
                                        $objData->created = date ( 'Y-m-d H:i:s' );
                                        $objData->is_active = '1';
                                        global $DB;
                                        $DB->Save ( 'sections', $objData );
                                        $objPresenter->AddParameter ( 'add_message', '<div class="alert alert-success"><strong>Success</strong> Company Added</div>' );
                                        header ( "Location: " . Request::$BASE_PATH.'sections/' );
                                    }
                                }else{
                                    header ( "Location: " . Request::$BASE_PATH );
                                }
                                $objPresenter->AddTemplate('add_section');
                                break;
                            case 'edit_section':

                                if(Session::GetUser()->user_role_id == '1' && Session::isUserOnline()){
                                    if($parameters[2] !='' && isset($parameters[2])){
                                        if(Request::hasPostVariables()){
                                            $objData = Request::getPostVariables();
                                            global $DB;
                                            $DB->Save ( 'sections', $objData );
                                            $objPresenter->AddParameter ( 'add_message', '<div class="alert alert-success"><strong>Success</strong> Updated Record </div>' );
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
                                if(Session::isUserOnline()){
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
                    if(Session::isUserOnline()){
                        if($parameters[1] !='' && isset($parameters[1])){
                            $id=intval($parameters[1]);
                            $objData=Content::selectCount('coupons','publisher',$id);
                            print_r($objData->total);
                            exit;
                        }else{
                            header ( "Location: " . Request::$BASE_PATH.'' );
                        }
                        $objPresenter->AddTemplate('reports');
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
                    $objall_users =Content::relation('*','users','user_roles','role','user_role_id');
                    $objPresenter->AddParameter('objall_users', $objall_users);
                    if (!isset($parameters[1]) && $parameters[1]=''){
                        $objPresenter->AddTemplate('users');
                    }else {
                        switch ($parameters[1]){
                            case 'new_user':
                                if(Session::GetUser()->user_role_id == '1'){
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
                                            $objPresenter->AddParameter ( 'message', '<div class="alert alert-danger"><strong>Error</strong> Email Already exsist!</div>' );
                                        }
                                    }
                                }else{
                                    header ( "Location: " . Request::$BASE_PATH );
                                }
                                $objPresenter->AddTemplate('add_user');
                                break;
                            case 'delete_user':
                                if(Session::isUserOnline()){
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

                                if(Session::GetUser()->user_role_id == '1' && Session::isUserOnline()){

                                    if($parameters[2] !='' && isset($parameters[2])){
                                        $objroles=Content::select('*','user_roles');
                                        $objPresenter->AddParameter('objroles',$objroles);

                                        if(Request::hasPostVariables()){
                                            $objData = Request::getPostVariables();
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
                                $objPresenter->AddTemplate('users');
                                break;
                        }
                    }

                    break;

                default:
                    if(Session::isUserOnline()){


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
