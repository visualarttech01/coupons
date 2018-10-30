
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
                    $objall =Content::All('role_permissions');
                    $objPresenter->AddParameter('objall', $objall);
                    if (!isset($parameters[1]) && $parameters[1]= ' '){
                        $objPresenter->AddTemplate('permissions');
                    }else {
                        switch ($parameters[1]){
                            case 'new_permission':
                                if(Session::GetUser()->user_role_id == '1'){
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
				case 'logout':
							if (Session::isUserOnline()){
								Session::Destroy();
								header ( "Location: " . Request::$BASE_PATH );
							}else {
								header ( "Location: " . Request::$BASE_PATH );
							}
							break;
                case 'users':
                    $objall_users =Content::all_users();
                    $objPresenter->AddParameter('objall_users', $objall_users);
                    if (!isset($parameters[1]) && $parameters[1]=''){
                        $objPresenter->AddTemplate('users');
                    }else {
                        switch ($parameters[1]){
                            case 'new_user':
                                if(Session::GetUser()->user_role_id == '1'){
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
                            case 'delete':
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

                                exit;
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
