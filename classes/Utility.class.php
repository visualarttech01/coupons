
<?php
	class Utility {
	   	const VARIABLERANDOMLIST = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
	   	const DANISHLIST = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789 ";

		static function dateDifferencestatus($startDate ){
		    $dateDifference = '';
		    $today = date("Y-m-d");
		    $startDate = strtotime($startDate);
		    $today = strtotime($today);
		    echo $startDate.'<br>'.$endDate;
		    if($today > $startDate){
		      return 'yes';
		    }elseif($startDate>$today){
		        echo 'no';
		    }
		    
		    return $dateDifference;
		}
		
	}
