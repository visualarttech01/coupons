
<?php
	class User {
		
		static function CheckEmail($email){
			global $DB;
			
			$sql = "SELECT id 
						FROM users
						WHERE email = '".$email."' ";

			$objData = $DB->Select($sql);
			if($objData){
				return false;
			}
			else{
				return true;
			}
		}

		
		static function Validate($objData){
			global $DB;
			
			$sql = "SELECT id 
						FROM users 
						WHERE email = '".$objData->email."' 
						AND password = '".md5($objData->password)."' 
						AND is_active = '1' ";
			$objData = $DB->Select($sql);
			if($objData){
				$objUser = User::Load($objData[0]->id);
				Session::AddUser($objUser);
				return true;
			}
			else{
				return false;
			}
		}
		
		static function Logout(){
			Session::Destroy();
			return true;
		}
		
		static function LoadByCode($code,$type=''){
			global $DB;
			
			if($code != ''){
				$sql = "SELECT id 
							FROM users
							WHERE MD5(CONCAT(id,email)) = '".$code."' ";
				if($type == 'Login'){
					$sql .= "AND last_login IS NOT NULL ";
				}
				$objData = $DB->Select($sql);
				if($objData){
					return $objData[0];
				}
				else{
					return false;
				}
			}
			else{
				return false;
			}
		}
		
		static function Load($ID){
			global $DB;
			

			$sql = "SELECT *
						FROM users
						WHERE is_active = '1' 
						AND id = '".$ID."' ";
			$objData = $DB->Select($sql);
			if($objData){
                 return $objUser = $objData[0];
            }
			else{
				return false;
			}
		}

		
	static function GetUserData($id) {
			global $DB;
			
			$sql = "SELECT * 
						FROM users
						WHERE id = '".$id."' ";
			$objData = $DB->Select($sql);

			if($objData){
				return $objData[0];
			}
			else{
				return false;
			}
		}

	}
