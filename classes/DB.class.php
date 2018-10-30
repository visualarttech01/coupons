
<?php
	class DB {
		var $_conn = NULL;
		var $_rs = NULL;
		var $_host = '';
		var $_user = '';
		var $_pwd  = '';
		var $_db   = '';
		
		function DB(){
			$Database = new DATABASE_CONFIG;
			$this->_host = $Database->default['host'];
			$this->_user = $Database->default['login'];
			$this->_pwd = $Database->default['password'];
			$this->_db = $Database->default['database'];
		}
		
		function IsConnected(){
			if (!is_null($this->_conn)) return true;
			else return false;
		}
		
		function OpenConnection(){
			$this->_conn = mysql_connect($this->_host,$this->_user,$this->_pwd); 
			mysql_unbuffered_query('SET NAMES utf8');
			if (!$this->_conn){ 
				$this->_conn = NULL;
				echo mysql_error(); exit; 
			}
			else{ 
				if (!mysql_select_db($this->_db,$this->_conn)){ 
					$this->_conn = NULL;
					echo mysql_error(); exit; 
				}
			}
		}
		
		function CloseConnection(){
			if ($this->IsConnected()){
				mysql_close($this->_conn);
				$this->_conn = NULL;
			}
		}
		
		function AutoIncrementID(){
			return mysql_insert_id($this->_conn);
		}
		
		function Save($table,$data,$key='id'){
			if (empty($table) || count($data) < 1) {
				$this->CloseConnection();
				trigger_error("DB:Save() Illegal SQL:\n", E_USER_ERROR);
				exit;
			}
			$sql = "";
			$columns = array_keys((array)$data);
			if (!$this->IsConnected()) $this->OpenConnection();
			$result = mysql_query("DESC ".$table,$this->_conn);
			$error_no = mysql_errno($this->_conn);
			if($error_no){
				$err_string = mysql_error($this->_conn);
				$this->CloseConnection();
				trigger_error("DB:Save() failed, err no ".$error_no.
				"\nMessage: ".$err_string."\n", E_USER_ERROR);
				exit;
			}else{
				while($row = mysql_fetch_object($result)){
					if($row->Field != $key && in_array($row->Field,$columns)){
						if($sql != "") $sql .= ", ";
						$sql .= "`" . $row->Field . "` = '" . addslashes($data->{$row->Field}) . "'";
					}
				}
				// echo "<pre>";
				// print_r($data);
				// exit;
				if(isset($data->{$key}) && $data->{$key} != ""){
					$sql = "UPDATE ".$table." SET ".$sql." WHERE ".$key." = '".$data->{$key}."' ";
					if($this->Update($sql)){
						return $data->{$key};
					}
					else{
						return false;
					}
				}
				else{
					$sql = "INSERT INTO ".$table." SET ".$sql;
					return $this->Insert($sql);
				}
			}
		}
		function Insert($sql){
			if (empty($sql) || !preg_match("/^INSERT/",$sql."")) {
				$this->CloseConnection();
				trigger_error("DB:Insert() Illegal SQL:\n".$sql, E_USER_ERROR);
				exit;
			}
			if (!$this->IsConnected()) $this->OpenConnection();
			$result = mysql_query($sql,$this->_conn);
			$error_no = mysql_errno($this->_conn);
			if($error_no){
				$err_string = mysql_error($this->_conn);
				$this->CloseConnection();
				trigger_error("DB:Insert() failed, err no ".$error_no.
							"\nMessage: ".$err_string.
							"\nSQL: ".$sql."\n", E_USER_ERROR);
				exit;
			}else{
				return $this->AutoIncrementID();
			}
		}
		
		function Update($sql){
			if (empty($sql) || !preg_match("/^UPDATE/",$sql."\n")) {
				$this->CloseConnection();
				trigger_error("DB:Update() Illegal SQL:\n".$sql, E_USER_ERROR);
				exit;
			}
			if (!$this->IsConnected()) $this->OpenConnection();
			$results = mysql_query($sql,$this->_conn) or die("Invalid query:<br/>".$sql."<br/>".mysql_error());
			if (!$results) return false;
			return true;
		}
		
		function Delete($sql) {
			if (empty($sql) || !preg_match("/^DELETE/",$sql."\n")) {
				$this->CloseConnection();
				trigger_error("DB:Delete() Illegal SQL:\n".$sql, E_USER_ERROR);
				exit;
			}
			if (!$this->IsConnected()) $this->OpenConnection();
			$results = mysql_query($sql,$this->_conn);
			if (!$results) return false;
			return true;
		}
		
		function Select($sql){
			if (empty($sql) || !preg_match("/^SELECT/",$sql."\n")) {
				$this->CloseConnection();
				trigger_error("DB:Select() Illegal SQL:\n".$sql, E_USER_ERROR);
				exit;
			}
			if (!$this->IsConnected()) $this->OpenConnection();
			$result = mysql_query($sql,$this->_conn); 
			$error_no = mysql_errno($this->_conn);
			if($error_no){
				$err_string = mysql_error($this->_conn);
				$this->CloseConnection();
				trigger_error("DB:Select() failed, err no ".$error_no.
							"\nMessage: ".$err_string.
							"\nSQL: ".$sql."\n", E_USER_ERROR);
				exit;
			}
			$returnObject = array();
			while($row = mysql_fetch_object($result)){
				$returnObject[] = $row;
			}
			return $returnObject;
		}
		
		function Execute($sql){
			if (empty($sql)) {
				$this->CloseConnection();
				trigger_error("DB:Execute() Illegal SQL:\n".$sql, E_USER_ERROR);
				exit;
			}
			if (!$this->IsConnected()) $this->OpenConnection();
			$result = mysql_query($sql,$this->_conn); 
			$error_no = mysql_errno($this->_conn);
			if($error_no){
				$err_string = mysql_error($this->_conn);
				$this->CloseConnection();
				trigger_error("DB:Execute() failed, err no ".$error_no.
							"\nMessage: ".$err_string.
							"\nSQL: ".$sql."\n", E_USER_ERROR);
				exit;
			}
			if($result == true){
				return true;
			}
			else{
				$returnObject = array();
				while($row = mysql_fetch_object($result)){
					$returnObject[] = $row;
				}
				return $returnObject;
			}
		}
		
		function SafeString($string){
			if (!$this->IsConnected()) $this->OpenConnection();
			return mysql_real_escape_string($string,$this->_conn);
		}
		
		function dateDifference($endDate, $startDate = ''){
			$dateDifference = '';
			
			if($startDate == '') $startDate = date("Y-m-d H:i:s");
			$startDate = strtotime($startDate);
			$endDate = strtotime($endDate);
			if($endDate > $startDate){
				$difference = $endDate - $startDate;
				if( $days = intval((floor($difference / 86400))) )
					$difference = $difference % 86400;
				if( $hours = intval((floor($difference / 3600))) )
					$difference = $difference % 3600;
				if( $minutes = intval((floor($difference / 60))) )
					$difference = $difference % 60;
				$difference = intval( $difference );
				
				//$dateDifference = $days.'days '.$hours.'hours '.$minutes.'minutes '.$difference.'s';
				if($days == '0'){
					$dateDifference = $hours.' hours ago';
				}else{
					$dateDifference = $days.' days and '.$hours.' hours ago';
				}
			}
			
			return $dateDifference;
		}
		
	}
