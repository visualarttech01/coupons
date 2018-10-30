
<?php
	// Display Errors
	ini_set('display_errors', '1');
	
	// Configurations
	define("DEFAULT_LANGUAGE",1);
	
	// Set Turkish Time Zone
	date_default_timezone_set('Asia/Karachi');
	
	/*****************************************/
	/**********		DON'T EDIT		**********/
	/*****************************************/
	define("BASE_URL",dirname(__FILE__));
	function __autoload ($class_name) {
		$class_name = 'classes/' . $class_name . '.class.php';
		include_once ($class_name);
	}
	// Database
  include("database/database.php");
	//Start Session
	Session::Create();
	// Connect Database
	$DB = new DB();
	global $DB;
	//Process Request
	Gateway::Process(Request::Parameters());
?>
