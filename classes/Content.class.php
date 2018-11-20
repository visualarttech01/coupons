<?php
	class Content {
		//======================================================== All Data ============================================
		static function All($table){
			global $DB;
			
			$sql="SELECT *
					FROM ".$table."
					ORDER BY id DESC";
			
			$objData=$DB->Select($sql);
			if($objData){
			
				return $objData;
			}else{
				return false;
			}
		}
		//======================================================== Find BY ID ============================================
		static function find_by_id($id,$table){
			global $DB;
			
			$sql="SELECT *
					FROM ".$table."
					WHERE id = '".$id."'
					ORDER BY id DESC";
			
			$objData=$DB->Select($sql);
			if($objData){
			
				return $objData[0];
			}else{
				return false;
			}
		}
        //======================================================== Count ============================================
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

        //======================================================== Count Repoert BY ID ============================================
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
        //======================================================== Select ============================================
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
        //======================================================== validate User BY Section ============================================
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
        //======================================================== Store ============================================
        static function stores(){
            global $DB;
            
            $sql="SELECT *
					FROM stores
					ORDER BY id DESC";
            
            $objData=$DB->Select($sql);
            if($objData){
                foreach ($objData as $key){
                    $sql="SELECT name
                    FROM  categories
					WHERE id ='".$key->category_id."'";
                    $cat=$DB->Select($sql);
              
                    if($cat){
                        $key->category=$cat[0]->name;
                    }else{
                        $key->category='Deleted';
                    }
                }
                foreach ($objData as $key){
                    $sql="SELECT name
                    FROM  networks
					WHERE id ='".$key->network_id."'";
                    $cat=$DB->Select($sql);
                    
                    if($cat){
                        $key->network=$cat[0]->name;
                    }else{
                        $key->network='Deleted';
                    }
                }
                foreach ($objData as $key){
                    $sql="SELECT count(*) as total
					FROM  coupons
					WHERE store_id ='".$key->id."'";
                    $cnt=$DB->Select($sql);
                    
                    if($cnt){
                        $key->coupon=$cnt[0]->total;
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
               }elseif($key->publisher==$id && $key->edited_by!==$id){
                  $sql="SELECT user_name from users where id='".$key->edited_by."'";
                   $editor=$DB->Select($sql);
                   
                   if($editor){
                       $key->status='Posted';
                       $key->editor='Edited by '.$editor[0]->user_name;
                   }else{
                       $key->status='Posted';
                       $key->editor='Not Yet Edited';
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
    //======================================================== publisher ============================================
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
    
    //======================================================== ranks ============================================
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
    //======================================================== validate Store Name ============================================
    static function validateStore($name){
        global $DB;
        
        $sql="SELECT id
					FROM stores
					WHERE name = '".$name."'
					AND is_active = 1
					ORDER BY id DESC";
        
        $objData=$DB->Select($sql);
        if($objData){
            
            return false;
        }else{
            return true;
        }
    }
    //======================================================== validate Store Edit ============================================
    static function validateStoreEdit($name,$id){
        global $DB;
        
        $sql="SELECT id
					FROM stores
					WHERE name = '".$name."'
					AND is_active = 1
					ORDER BY id DESC";
        
        $objData=$DB->Select($sql);
        if($objData){
            if($objData[0]->id==$id){
                return true;
            }else{
                return false;
            }
            
        }else{
            return true;
        }
    }
    //======================================================== validate Coupon ============================================
    static function validateCoupon($name,$store_id){
        global $DB;
        
        $sql="SELECT id
					FROM coupons
					WHERE name = '".$name."'
					AND store_id ='".$store_id."'
                    AND is_active = 1
					ORDER BY id DESC";
        
        $objData=$DB->Select($sql);
        
        if($objData){
            return false;
            
        }else{
            return true;
        }
    }
    
    //======================================================== validate Coupon edit ============================================
    static function validateCouponedit($name,$store_id,$id){
        global $DB;
        
        $sql="SELECT id
					FROM coupons
					WHERE name = '".$name."'
					AND store_id ='".$store_id."'
                    AND is_active = 1
					ORDER BY id DESC";
        
        $objData=$DB->Select($sql);
        if($objData){
            if($objData[0]->id==$id){
                return true;
            }else{
                return false;
            }
            
        }else{
            return true;
        }
    }
    //======================================================== clean ============================================
    static function clean($string) {
        $string = str_replace(' ', '-', $string); // Replaces all spaces with hyphens.
        $string = preg_replace('/[^A-Za-z0-9\-]/', '', $string); // Removes special chars.
        
        $string=preg_replace('/-+/', '-', $string); // Replaces multiple hyphens with single one.
        return $string=str_replace('-', ' ', $string);
    }
    
    //======================================================== getId ============================================
    static function getId($name,$table){
        global $DB;
        
        $sql="SELECT id
					FROM $table
					WHERE name = '".$name."'
					AND is_active = 1
					ORDER BY id DESC";
        
        $objData=$DB->Select($sql);
        if($objData){
            return $objData[0]->id;
            
            
        }else{
            return false;
        }
    }
    //======================================================== storeSpamCheck ============================================
    static function storeSpamCheck($id,$link){
        global $DB;
        
        $sql="SELECT network_id
					FROM networks
					WHERE id = '".$id."'
					ORDER BY id DESC";
        
        $objData=$DB->Select($sql);
        if($objData){
            
            if (strpos($link, $objData[0]->network_id) !== false) {
                $data='0';
            }else{
                $data='1';
            }
            
            return $data;
        }else{
            return false;
        }
    }
    
    //======================================================== coupon Spam Check ============================================
    static function couponSpamCheck($store_id,$link){
        global $DB;
        
        $sql="SELECT network_id
					FROM stores
					WHERE id = '".$store_id."'
					ORDER BY id DESC";
        
        $objData=$DB->Select($sql);
        $sql="SELECT network_id
					FROM networks
					WHERE id = '".$objData[0]->network_id."'
					ORDER BY id DESC";
        
        $objData=$DB->Select($sql);
        if($objData){
            if (strpos($link, $objData[0]->network_id) !== false) {
                $data='0';
            }else{
                $data='1';
            }
            return $data;
        }else{
            return false;
        }
    }
    //======================================================== getId ============================================
    static function validatelevel($id){
        global $DB;
        
        $sql="SELECT user_role_id
					FROM users
					WHERE id ='".$id."'
					AND is_active = 1
					ORDER BY id DESC";
        
        $objData=$DB->Select($sql);
        
        if($objData){
            $sql="SELECT level
					FROM user_roles
					WHERE id ='".$objData[0]->user_role_id."'
					ORDER BY id DESC";
            $repuser=$DB->Select($sql);
            if($repuser){
                $sql="SELECT level
					FROM user_roles
					WHERE id ='".Session::GetUser()->user_role_id."'
					ORDER BY id DESC";
                $user=$DB->Select($sql);
                if($repuser[0]->level>$user[0]->level){
                   return false;
                }else{
                    return true;
                }
            }
            
            
        }else{
            return false;
        }
    }

}

