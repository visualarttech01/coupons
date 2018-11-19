
<?php
	class Session {
		const SESSION_VARIABLE = 'SESSION_MANSSOL';
		
		static function Create () {
			session_start();
			
			if(isset($_SESSION[Session::SESSION_VARIABLE])) {
				$_SESSION[Session::SESSION_VARIABLE]['LastUpdated'] = date("Y-m-d H:i:s");
			} else {
				$_SESSION[Session::SESSION_VARIABLE] = array();
				$_SESSION[Session::SESSION_VARIABLE]['ID'] = session_id();
				$_SESSION[Session::SESSION_VARIABLE]['FirstLogin'] = date("Y-m-d H:i:s");
				$_SESSION[Session::SESSION_VARIABLE]['Language'] = NULL;
				$_SESSION[Session::SESSION_VARIABLE]['User'] = NULL;
			}
		}
		
		static function Load () {
			if(isset($_SESSION[Session::SESSION_VARIABLE])) {
				return $_SESSION;  
			} else {
				return false;
			}
		}
		
		static function ID () {
			return $_SESSION[Session::SESSION_VARIABLE]['ID'];
		}
		

		
		static function AddUser ($objUser) {
			$_SESSION[Session::SESSION_VARIABLE]['User'] = $objUser;
		}
		
		static function GetUser () {
			return $_SESSION[Session::SESSION_VARIABLE]['User'];
		}
		
		static function RemoveUser () {
			$_SESSION[Session::SESSION_VARIABLE]['User'] = NULL;
		}
		
		static function isUserOnline () {
			if($_SESSION[Session::SESSION_VARIABLE]['User']){
				return true;
			}
			else{
				return false;
			}
		}
		
		static function AddParameter ($key, $value) {
			$_SESSION[Session::SESSION_VARIABLE][$key] = $value;
		}
		
		static function GetParameter ($key) {
			if(in_array($key, array("User", "FirstLogin", "LastUpdated"))) {
				throw new Exception ("INVALID_KEY_PROVIDED", 1);
			}

			return $_SESSION[Session::SESSION_VARIABLE][$key];
		}
		

		
		static function Destroy () {
			$_SESSION[Session::SESSION_VARIABLE]['User'] = NULL;
			$_SESSION[Session::SESSION_VARIABLE]['CaptchaImage'] = NULL;
			$imageFile = 'captcha/'.Session::ID().'.jpg';
			@unlink($imageFile);
			session_destroy();
		}

	}
