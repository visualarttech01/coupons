
<?php
	class Content {
		//======================================================== All COMPANIES ============================================
		static function All($table){
			global $DB;
			
			$sql="SELECT *
					FROM ".$table."
					WHERE is_active = 1
					ORDER BY id DESC";
			
			$objData=$DB->Select($sql);
			if($objData){
			
				return $objData;
			}else{
				return false;
			}
		}
		//======================================================== COMPANY BY ID ============================================
		static function find_by_id($id,$table){
			global $DB;
			
			$sql="SELECT *
					FROM ".$table."
					WHERE id = '".$id."'
					AND is_active = 1
					ORDER BY id DESC";
			
			$objData=$DB->Select($sql);
			if($objData){
			
				return $objData[0];
			}else{
				return false;
			}
		}
        //======================================================== COMPANY BY ID ============================================
        static function selectCount($table,$where,$id,$date,$name){
            global $DB;

            $sql="SELECT count(*) as ".$name."
					FROM ".$table."
					WHERE ".$where." = '".$id."'
					AND created='".$date."'";

            $objData=$DB->Select($sql);
            if($objData){

                return $objData[0];
            }else{
                return false;
            }
        }

        //======================================================== COMPANY BY ID ============================================
        static function reports($from,$to,$id){
            global $DB;

            $sql="SELECT count(*) as total
					FROM  coupons
					WHERE publisher = '".$id."'
					AND created between '".$from."' AND '".$to."'";

            $objData=$DB->Select($sql);
            if($objData){
                    if($objData[0]->total==0){
                        return $objData[0]->total='0';
                    }else{
                       return $objData[0]->total;
                    }

            }else{
                return false;
            }
        }
        //======================================================== COMPANY BY ID ============================================
        static function select($field,$table){
            global $DB;

            $sql="SELECT ".$field."
					FROM ".$table."
					WHERE is_active = 1
					ORDER BY id DESC";

            $objData=$DB->Select($sql);
            if($objData){

                return $objData;
            }else{
                return false;
            }
        }
        //======================================================== COMPANY BY ID ============================================
        static function validate($section,$control){
            if (Session::isUserOnline()){
                $role= Session::GetUser()->user_role_id;
                global $DB;

                $sql="SELECT *
					FROM role_permissions
					WHERE user_role_id= '".$role."' 
					And section ='".$section."'
					AND is_active = 1";

                $objData=$DB->Select($sql);
                if($objData){
                    if($objData[0]->$control=='1'){
                        return '1';
                    }else{
                        return '0';
                    }

                }else{
                    return false;
                }
            }

        }

        //======================================================== relation ============================================
        static function relation($field,$table,$otable,$ofield,$id){
            global $DB;

            $sql="SELECT ".$field."
					FROM ".$table."
					WHERE is_active = 1
					ORDER BY id DESC";

            $objData=$DB->Select($sql);
            if($objData){
                foreach ($objData as $key){
                    $sql="SELECT ".$ofield."
					FROM ".$otable."
					WHERE id= ".$key->$id."
					AND is_active = 1
					ORDER BY id DESC";
                    if($DB->Select($sql)){
                        $key->role=$DB->Select($sql);
                        $key->role=$key->role[0]->role;
                    }else{
                        $key->role='deleted';
                    }

                }

                return $objData;
            }else{
                return false;
            }
        }


        //======================================================== coupons ============================================
        static function coupons(){
            global $DB;

            $sql="SELECT *
					FROM coupons
					WHERE is_active = 1
					ORDER BY id DESC";

            $objData=$DB->Select($sql);
            if($objData){
                foreach ($objData as $key){
                    $sql="SELECT name
					FROM stores
					WHERE id='".$key->store_id."'
					AND is_active = 1
					ORDER BY id DESC";
                    if($DB->Select($sql)){
                        $key->store=$DB->Select($sql);
                        $key->store=$key->store[0]->name;
                    }else{
                        $key->store='deleted';
                    }

                }

                foreach ($objData as $key){
                    $sql="SELECT name
					FROM categories
					WHERE id='".$key->category_id."'
					AND is_active = 1
					ORDER BY id DESC";
                    if($DB->Select($sql)){
                        $key->category=$DB->Select($sql);
                        $key->category=$key->category[0]->name;
                    }else{
                        $key->category='deleted';
                    }

                }

                return $objData;
            }else{
                return false;
            }
        }

		//========================================================GLOBAL_SETTING============================================
		static function Global_Settings(){
			global $DB;
			$sql="SELECT *
					FROM global_settings
					WHERE id='1'";
			$objData=$DB->Select($sql);
			if($objData){
				return $objData[0];
			}
			else{
				return false;
			}
		}


		//======================================================== user ============================================

    static function user($id){
            global $DB;

            $sql="SELECT *
					FROM users
					WHERE id='".$id."'
					AND is_active = 1
					ORDER BY id DESC";

            $objData=$DB->Select($sql);
            if($objData){
                return $objData[0];
            }else{
                return false;
            }
        }

        //======================================================== reporting ============================================
    static function reporting($table,$id){
        global $DB;

        $sql="SELECT *
					FROM ".$table."
					WHERE is_active = 1
					AND publisher='".$id."'
					OR  edited_by='".$id."'
					ORDER BY id DESC";

        $objData=$DB->Select($sql);
        if($objData){

            foreach ($objData as $key){

                if ($key->edited_by==$id && $key->publisher==$id){
                    $key->status='Posted & Edited';
               }elseif($key->publisher==$id && $key->edited_by!=$id){
                  
                   $sql="SELECT user_name from users where id='".$key->edited_by."'";
                   $editor=$DB->Select($sql);
                   if($editor){
                       $key->status='Posted';
                       $key->editor='Edited by '.$editor[0]->user_name;
                   }
                    
               }elseif($key->publisher!=$id && $key->edited_by==$id ){
                  
                   $sql="SELECT user_name from users where id='".$key->publisher."'";
                    
                    $editor=$DB->Select($sql);

                    if($editor){
                        $key->status='Edited';
                        $key->editor='Posted by '.$editor[0]->user_name;
                    }
                    

                }

            }

          return $objData;
        }else{
            return false;
        }
    }
    //======================================================== reporting ============================================
    static function publisher($table,$id){
        global $DB;
        $sql="SELECT publisher
					FROM ".$table."
					WHERE is_active = 1
					AND id= '".$id."'
					ORDER BY id DESC";

        $objData=$DB->Select($sql);
        if($objData){

            return $objData[0];
        }else{
            return false;
        }
    }
    
    //======================================================== reporting ============================================
    static function ranks($store_id){
        global $DB;
        $sql="SELECT name,id,rank
					FROM coupons
					WHERE is_active = 1
					AND store_id= '".$store_id."'
					ORDER BY rank ASC";
        
        $objData=$DB->Select($sql);
        if($objData){
            
            return $objData;
        }else{
            return false;
        }
    }


}

