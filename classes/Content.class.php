
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

        //======================================================== All USERS ============================================
		static function all_users(){
			global $DB;
			
			$sql="SELECT *
					FROM users
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
		
	}

